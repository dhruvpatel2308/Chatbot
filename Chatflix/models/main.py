#importing necessary libraries
import os
import re
import pickle
from time import time
from datetime import datetime
from configparser import ConfigParser
import psycopg2
import logging
from logging.handlers import RotatingFileHandler
from cachetools import LRUCache
from sklearn.metrics.pairwise import cosine_similarity
from fastapi import FastAPI, Request, File, Form, UploadFile, HTTPException
from fastapi.responses import JSONResponse
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel
from langchain_community.vectorstores.pgvector import PGVector
from langchain_community.llms import Ollama
from langchain_community.embeddings import OllamaEmbeddings
from langchain.chains import RetrievalQA
from langchain.prompts import PromptTemplate
from langchain.text_splitter import RecursiveCharacterTextSplitter
from langchain_community.document_loaders import PyMuPDFLoader


#load configuration
config_path = os.path.join(os.path.dirname(__file__), '..', 'config.ini')

if not os.path.exists(config_path):
    raise FileNotFoundError(f"Config file not found at:{config_path}")


    
config = ConfigParser()
config.read(config_path)

db_config = config['database']

CACHE_FILE = "cache.pkl"


#Initialize FastAPI
app = FastAPI()

#CORS middleware
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

#logging configuration
LOG_DIR = "logs"
os.makedirs(LOG_DIR,exist_ok=True)

log_file = os.path.join(LOG_DIR, "app.log")
logging.basicConfig(
    level=logging.INFO,
    format="%(asctime)s [%(levelname)s] %(message)s",
    handlers=[
        RotatingFileHandler(log_file, maxBytes=5 * 1024 * 1024, backupCount=5),
        logging.StreamHandler()
    ]
)

logger = logging.getLogger("FastAPI_App")


#database and embedding configuration
COLLECTION_NAME = 'loyalist_student_support'
embedding_function = OllamaEmbeddings(model="nomic-embed-text") #embedding_function = OllamaEmbeddings(model = 'llama3.2')
query_cache = LRUCache(maxsize=1000) #Create the LRUCache with a specified max size

CONNECTION_STRING = f"postgresql+psycopg2://{db_config['username']}:{db_config['password']}@{db_config.get('host','localhost')}:{db_config.get('port',5432)}/{db_config['dbname']}"

# Initialize PGVector using the existing data in PostgreSQL
db = PGVector(
    connection_string=CONNECTION_STRING,
    collection_name=COLLECTION_NAME,
    embedding_function=embedding_function,
)


#Create and configure the language model
llama3_llm=Ollama(model="llama3.2")
llama3_retriever = db.as_retriever(search_kwargs={"k":5})

DATA_DIR = '../admin/'   # change required

# Define the prompt template for generating responses
prompt_template = """
You are Giri, an assistant bot for students at Loyalist College or LCIT (Loyalist College in Toronto), which is under TBC (Toronto Business College). Your role is to provide accurate and relevant information strictly based on the provided context from official college documents. These documents cover academic policies, program details, student services, campus facilities, and more.

### Guidelines:
1. Always prioritize factual and specific information from the context before giving general guidance. Avoid guessing or providing information beyond the context.
2. Directly answer questions as concisely as possible. Be detailed only if specifically requested or if the question clearly requires a detailed response.
3. For vague or unclear questions:
   - Politely ask the user to clarify or provide more details.
   - If no clarification is possible, respond with a friendly prompt to guide the user toward asking specific questions.
4. If no relevant information is found in the context, respond: 
   "Sorry, I couldn't find specific information on that topic. For further details, please contact academics or student success."
5. Avoid answering any questions related to coding, project management, SQL, web development, or other study resources unrelated to the provided context.
6. You may engage in brief casual conversation, but ensure it aligns with your professional role as a student assistant.

### Examples of the types of questions you might encounter:
- "What are the rules for retaking a course?"
- "How do I extend my study permit?"
- "Can you explain the parking policy on campus?"
- "What should I do if I lose my student ID card?"
- "Tell me about the refund policy for withdrawing from a program."
- "How can I start a new club on campus?"
- "What are the library services available to students?"
- "What happens if I miss an exam due to illness?"
- "What is the process for submitting a complaint?"
- "What are the eligibility criteria for the cybersecurity program?"

### If no relevant information is found:
"Sorry, I couldn't find specific information on that topic. For further details, please contact academics or student success."

### For retrieved context:
When answering questions, include specific references (e.g., document title, section name, or page number) to help the student locate the information.

### CONVERSATION FORMAT:
CONTEXT: {context}

QUESTION: {question}
"""

PROMPT = PromptTemplate(template=prompt_template, input_variables=["context", "question"])
chain_type_kwargs = {"prompt": PROMPT}

# Create a RetrievalQA chain with the language model and retriever
llama3_chain = RetrievalQA.from_chain_type(
    llm=llama3_llm,
    chain_type="stuff",
    retriever=llama3_retriever,
    input_key="query",
    return_source_documents=True,
    chain_type_kwargs=chain_type_kwargs
)



#function to connect to the database
def connect_to_db():
    try:
        connection = psycopg2.connect(
            user=db_config['username'],
            password=db_config['password'],
            host=db_config.get('host','localhost'),
            port=db_config.get('port',5432),
            database=db_config['dbname']
        )
        logger.info(f"Database {db_config['dbname']} connection successful!")
        print(f"Database {db_config['dbname']} connection successful!")
        return connection
    except psycopg2.Error as e:
        logger.error(f"Error connecting to the database: {e}")
        print(f"Error connecting to the database: {e}")
        return None

def save_cache_to_file():
    try:
        with open(CACHE_FILE, 'wb') as f:
            pickle.dump(query_cache, f)
        logger.info("Cache saved to file successfully.")
    
    except Exception as e:
        logger.error(f"Error saving cache to file: {e}")


def load_cache_from_file():
    if os.path.exists(CACHE_FILE):
        try:
            with open(CACHE_FILE,'rb') as f:
                global query_cache
                query_cache = pickle.load(f)
            logger.info("Cache loaded from file successfully.")
        except Exception as e:
            logger.error(f"Error loading cache from file: {e}")


def get_embedding(query):
    return embedding_function.embed_query(query)

# Function to load PDF documents
def load_pdf_with_langchain(pdf_path):
    """Loads a PDF document using the PyMuPDFLoader and returns a list of langchain.Document objects.

    Args:
        pdf_path (str): The path to the PDF file to load

    Returns:
        List[Document]: A list of langchain.Document objects, each representing a page in the PDF.
    """
    loader = PyMuPDFLoader(pdf_path)
    documents = loader.load()
    return documents



def find_similar_query(query_embedding):
    for cached_query, (cached_embedding, cached_result) in query_cache.items():
        similarity_score = cosine_similarity([query_embedding], [cached_embedding])[0][0]
        if similarity_score > 0.8:
                logger.info(f"Returning cached result for a similar query: {cached_query}")
                return cached_result
    return None 

# Function to initialize or update the database schema
def initialize_database():
    # Path to the SQL file
    sql_file_path = './Create_Update_database.sql'

    # Establish database connection
    connection = connect_to_db()
    if connection is None:
        logger.error(f"Error connecting to the database")
        return

    try:
        cursor = connection.cursor()
        
        # Read the SQL file
        with open(sql_file_path, 'r') as file:
            sql_content = file.read()

        # Split by semicolons to handle multiple statements
        sql_statements = sql_content.split(';')
        
        # Execute each SQL statement
        for statement in sql_statements:
            if statement.strip():  # Skip empty statements
                cursor.execute(statement)
        
        # Commit the changes
        connection.commit()
        logger.info(f"Database initialized or updated successfully!")

    except Exception as e:
        logger.error(f"Error initializing database: {e}")
    finally:
        cursor.close()
        connection.close()


# Function to store conversation in the PostgreSQL table
def store_conversation(user_message, bot_response):
    """
    Stores a conversation in the PostgreSQL table 'chatbot_conversations'.
    Args:
        user_message (str): The user's message.
        bot_response (str): The bot's response.
    """
    connection = connect_to_db()
    if connection is None:
        logger.error("Error connecting to the database")
        return
    
    try:
        cursor = connection.cursor()
        insert_query = '''
        INSERT INTO chatbot_conversations (user_message, bot_response, timestamp)
        VALUES (%s, %s, %s);
        '''
        cursor.execute(insert_query, (user_message, bot_response, datetime.now()))
        connection.commit()
        cursor.close()
    except Exception as e:
        logger.error(f"Error storing conversation: {e}")
    finally:
        connection.close()


def updateDocumentsMetaData(documents, knowledge_id):
    """
    Updates the metadata of each document in the documents list with the given knowledge_id.
    """
    for document in documents:
        document.metadata["knowledge_id"] = knowledge_id



def process_query(query, knowledge_id=None):
    """
    This function processes a query by obtaining the query embedding, checking for a cached similar query result, and querying the LLM model for a response. 
    It cleans the response text and handles source documents if available.
    """
    start_time = time()
    query_embedding = get_embedding(query)
    end_time = time()       
    logger.info(f"Time taken to execute get embedding: {end_time - start_time} seconds")


    retrieved_docs = llama3_retriever.invoke(query)

    # Print the retrieved documents
    if retrieved_docs:
        print("Retrieved Documents:")
        # for i, doc in enumerate(retrieved_docs, start=1):
        #     print(f"\nDocument {i}:")
        #     print(f"Content: {doc.page_content}")
        #     print(f"Metadata: {doc.metadata}")
    else:
        print("No relevant documents found for the query.")
    # Check if a similar query is cached
    cached_result = find_similar_query(query_embedding)
    if cached_result:
        logger.info("Returning cached result")
        return cached_result

    # Query the LLM model
    start_time = time()
    result = llama3_chain.invoke(query)
    source_docs = result.get('source_documents', [])
    response_text = result.get('result') 

    # Remove variations of the phrase "According to the provided context"
    cleaned_response = re.sub(r'According to the (provided )?context[:,.]?', '', response_text).strip()
    logger.info("Cleaned response: " + cleaned_response)

    end_time = time()
    logger.info(f"Time taken to get the response: {end_time - start_time} seconds")

    # Handle source documents
    if source_docs:
        knowledge_id = source_docs[0].metadata.get("knowledge_id")
        query_cache[(knowledge_id, query)] = (query_embedding, cleaned_response)
        logger.info(f"Storing query in cache. Knowledge ID :{knowledge_id} , query:{ query} , cleaned_response:{ cleaned_response}")
        save_cache_to_file()
    else:
        cleaned_response = "Sorry, I couldn't find any relevant information in the provided context. Please try again with different keywords."
    store_conversation(query,cleaned_response)
    return cleaned_response
    

# Route to handle AI queries
@app.post("/ai")
async def aiPost(request: Request):
    try:
        json_content = await request.json()
        if "message" not in json_content:
            raise HTTPException(status_code=400, detail="Missing 'message' in request body")
        message = json_content["message"]
        response = process_query(message)
        return JSONResponse(content={"response": response})
    except Exception as e:
        logger.error(f"Error in /ai route: {str(e)}", exc_info=True)
        raise HTTPException(status_code=500, detail="Internal Server Error")

# Route to handle PDF uploads and processing
@app.post("/pdf")
async def pdfPost(file: UploadFile = File(...),
                  knowledge_id: str = Form(...)):
    try:
        file_name = file.filename
        save_path = os.path.join(DATA_DIR, file_name)
        with open(save_path, "wb") as f:
            f.write(await file.read())
        logger.info(f"File saved successfully: {save_path}")
            
        #load PDF content and split into documents
        whole_data = load_pdf_with_langchain(save_path) 
        data_splits = RecursiveCharacterTextSplitter(chunk_size=1250, chunk_overlap=100).split_documents(whole_data)
        updateDocumentsMetaData(data_splits, knowledge_id)

        #Store embeddings in the database with the knowledge_id
        # Create embeddings for the uploaded file
        db = PGVector.from_documents(
            embedding=OllamaEmbeddings(model="nomic-embed-text"),
            documents=data_splits, 
            collection_name=COLLECTION_NAME,
            connection_string=CONNECTION_STRING,
        )

        logger.info("Data embedded into database")
        #refresh cache for every cached query across all knowledge bases
        all_cached_queries = list(query_cache.items())
        print(all_cached_queries)
        for (knowledge_id, query), (query_embedding, _) in all_cached_queries:
            del query_cache[(knowledge_id, query)]

            new_response = process_query(query, knowledge_id)
            logger.info(f"Updated cache for query: {query} with new response")

            #add updated cache entry
            query_cache[(knowledge_id, query)] = (query_embedding, new_response)

            return JSONResponse(content={"status": "Successfully Uploaded"})       
    except Exception as e:
        logger.error(f"Unexpected error in /pdf route: {str(e)}", exc_info=True)
        raise HTTPException(status_code=500, detail="Internal Server Error")
        

# Route to handle feedback on the AI response
@app.post("/feedback")
async def feedbackPost(request: Request):
    try:
        json_content = await request.json()
        query = json_content.get("query") # original query asked
        previous_response = json_content.get("previousResponse")
        is_helpful = json_content.get("isHelpful") # feedback from the user
        
        if not query or is_helpful is None:
            raise HTTPException(status_code=400, detail="Missing 'query' or 'isHelpful' in request body")
        
        if not is_helpful:
            # If feedback is negative, remove similar queries from cache
            print(query)
            query_embedding = get_embedding(query)
            keys_to_remove = [key for key in query_cache.keys() if cosine_similarity([query_embedding], [query_cache[key][0]])[0][0] > 0.8]
            for key in keys_to_remove:
                del query_cache[key]
                logger.info(f"Removed cached query due to negative feedback: {key}")

            # Reprocess the query with the previous response
            feedback_prompt = f"""
            The following response was not helpful: "{previous_response}".
            Please provide a better and more specific answer to the user's query based on the provided context.

            Query: {query}
            """
            new_response = process_query(feedback_prompt)

            logger.info(f"Processed feedback. Updated response: {new_response}")

            return JSONResponse(content={"message": "Feedback processed", "new_response": new_response})

        return JSONResponse(content={"message": "Feedback received"})
    except Exception as e:
        logger.error(f"Unexpected error in /feedback route: {str(e)}")
        raise HTTPException(status_code=500, detail="Internal Server Error")




@app.post("/reset-cache")
async def reset_cache(knowledge_id: str = Form(...)):
    try:
        keys_to_remove = [key for key in query_cache.keys() if key[0] == knowledge_id]
        print(keys_to_remove)
        for key in keys_to_remove:
            del query_cache[key]
            logger.info(f"Removed cached query related to knowledge_id: {knowledge_id}")

        return JSONResponse(content={"message": f"Cache reset successfully for knowledge_id: {knowledge_id}"})
    
    except Exception as e:
        logger.error(f"Unexpected error in /reset-cache route: {str(e)}")
        raise HTTPException(status_code=500, detail="Internal Server Error")


# Ensure the database schema is initialized before starting the app
initialize_database()

load_cache_from_file()

@app.get("/")
async def home():
    logger.info("Home route accessed.")
    return {"message": "Welcome to the FastAPI app!"}

@app.on_event("shutdown")
def on_shutdown():
    save_cache_to_file()


if __name__ == "__main__":
    import uvicorn
    uvicorn.run(app, host="0.0.0.0", port=8080)