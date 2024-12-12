// chatbot.js

let chatOpen = false;
let isExpanded = false; // Add a flag for expanded state
let msgDisplayed = false;
let lastQuery = '';

const markdownConverter = new showdown.Converter();
markdownConverter.setOption('simplifiedAutoLink',true)

// const UrlRegex = /[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)/gi;
const UrlRegex = /\b(?:https?:\/\/|www\.)\S+\b/;

function handleURl(response) {
    const hasHttps = response.search('http|https') > 0;
    const regRes = UrlRegex.exec(response)
    if (regRes) {
        const hrefStr = response.replace(regRes[0], `<a href='${!hasHttps ? 'https://' : ''}${regRes[0]}'>${regRes[0]}</a>`)
        return hrefStr;
    }

    return response
}


document.addEventListener('DOMContentLoaded', (event) => {
    const openChatbotBtn = document.getElementById('openChatbotBtn');
    const chatbotPopup = document.getElementById('chatbotPopup');
    const sendButton = document.getElementById('sendButton');
    const input = document.getElementById('input');
    const enlargeChatbotBtn = document.getElementById('enlargeChatbotBtn');
    const floatingGreeting = document.getElementById('floatingGreeting');

    chatbotPopup.style.display = 'none';

    // Show the chatbot popup
    openChatbotBtn.addEventListener('click', function() {
        chatOpen = !chatOpen;
        chatbotPopup.style.display = chatOpen ? 'flex' : 'none';
        input.focus();
        floatingGreeting.style.display = 'none'; // Hide the floating greeting
        if (chatOpen && !msgDisplayed) {
            addGreetingMessage();
            msgDisplayed = true

            // Display pre-framed questions only once when chat opens
            displayPreFramedAnswers(['How to retake a course?', 'Who can I contact for support?', 'What is the college address?']);

        }
    });

    // Handle send button click
    sendButton.addEventListener('click', function() {
        sendMessage(false); // Explicitly pass `false` to indicate it's not a regenerated response
    });

    // Handle Enter key press
    input.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();  // Prevent the default action of Enter key
            sendMessage(false);
        }
    });

    // Handle enlarge button click
    enlargeChatbotBtn.addEventListener('click', function() {
        isExpanded = !isExpanded;
        chatbotPopup.classList.toggle('expanded', isExpanded);
        if (isExpanded) {
            enlargeChatbotBtn.innerHTML = '<i class="fas fa-compress-arrows-alt"></i>'; // Change to compress icon
        } else {
            enlargeChatbotBtn.innerHTML = '<i class="fas fa-expand-arrows-alt"></i>'; // Change to expand icon
        }
    });

    function sendMessage(isRegenerated = false) {
        const message = input.value;
        if (message.trim() === '') return;

        lastQuery = message; // Store the last query
        //Disable input and send button to prevent further input
        // Only disable input and button if they are not disabled
        if (!input.disabled && !sendButton.disabled) {
            input.disabled = true;
            sendButton.disabled = true;
        }

        // Only add the user's message if it's not a regenerated response
        if (!isRegenerated) {
            addMessageToChatbox('User', message, 'user-message');
        }

        input.value = '';

        const { typingIndicator, funFactInterval } = addTypingIndicator(); // Get the typing indicator and interval

        fetch(`http://${backendIP}:8080/ai`, {
               method: 'POST',
               headers: {
                   'Content-Type': 'application/json'
               },
               body: JSON.stringify({ message: message })
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (!data || !data.response) {
                    throw new Error('Invalid response from the server');
                }
            
                removeTypingIndicator({ typingIndicator, funFactInterval }); // Remove the typing indicator
            
                // Extract the response text from the data object
                const botResponse = data.response;
                
                // Pass only the botResponse to the markdownConverter
                const formattedResponse = markdownConverter.makeHtml(botResponse);
            
                // Add the bot's formatted response to the chatbox
                addMessageToChatbox('Bot', formattedResponse, 'bot-message');
            
                // Clear any previous feedback options and add new ones
                clearPreviousFeedbackOptions();
                addFeedbackOptions();
            })
            .catch(error => {
                removeTypingIndicator({ typingIndicator, funFactInterval }); // Remove the typing indicator
                addMessageToChatbox(
                    'Bot',
                    `Sorry, I don't have the information you're looking for at the moment. Please try rephrasing your question, or you can contact our support team for further assistance.`,
                    'bot-message');
            })
            .finally(() => {
              // Enable input and send button
              input.disabled = false;
              sendButton.disabled = false;
              input.focus();  
            });
    }


    function addMessageToChatbox(sender, message, className) {
        console.log(`Sender: ${sender}, Message: "${message}"`);
        const chatbox = document.getElementById('chatbox');
        const messageElement = document.createElement('div');
        messageElement.className = `message ${className}`;
        const avatarSrc = sender === 'User' ? 'images/user.png' : 'images/bot.png';
        messageElement.innerHTML = `
            <img src="${avatarSrc}" alt="${sender} icon">
            <div class="small mb-0">${message}</div>
        `;
        chatbox.appendChild(messageElement);
        chatbox.scrollTop = chatbox.scrollHeight;
    }


    // Function to clear previous feedback options
    function clearPreviousFeedbackOptions() {
        const feedbackContainers = document.querySelectorAll('.feedback-container');
        feedbackContainers.forEach(container => container.remove());
    }

    // addFeedbackOptions function
    function addFeedbackOptions(){
        clearPreviousFeedbackOptions();
        const chatbox = document.getElementById('chatbox');
        const feedbackContainer = document.createElement('div');
        feedbackContainer.className = 'feedback-container';

        const helpfulButton = document.createElement('button');
        helpfulButton.className = 'feedback-btn helpful-btn';
        helpfulButton.innerText = 'Helpful';
        helpfulButton.addEventListener('click', () => {
            if (!helpfulButton.disabled) { // Only proceed if the button is enabled
                sendFeedback(lastQuery, true);
                showFeedbackMessage(feedbackContainer, "Thanks for the feedback.", helpfulButton, true);
            }
        });

        const notHelpfulButton = document.createElement('button');
        notHelpfulButton.className = 'feedback-btn not-helpful-btn';
        notHelpfulButton.innerText = 'Not Helpful';
        notHelpfulButton.addEventListener('click', () => {
            if (!notHelpfulButton.disabled) { // Only proceed if the button is enabled
                sendFeedback(lastQuery, false);
                showFeedbackMessage(feedbackContainer, "We'll try to improve!", notHelpfulButton, false);
            }
        });

        feedbackContainer.appendChild(helpfulButton);
        feedbackContainer.appendChild(notHelpfulButton);
        chatbox.appendChild(feedbackContainer);
        chatbox.scrollTop = chatbox.scrollHeight;
    }

    function showFeedbackMessage(container,message, button, isHelpful){

         // Remove any existing feedback messages
         const existingMessages = container.querySelectorAll('.feedback-message');
         existingMessages.forEach(msg => msg.remove());
         
         const messageElement = document.createElement('div');
         messageElement.className = `feedback-message ${isHelpful ? 'helpful' : 'not-helpful'}`;
         messageElement.innerText = message;
         container.appendChild(messageElement);
 
         button.disabled = true;
 
         setTimeout(() => {
             messageElement.remove();
             button.disabled = false;
         }, 7500);
    }

    // Sample feedback submission function in the frontend
    function sendFeedback(query, isHelpful){
        fetch(`http://${backendIP}:8080/feedback`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ query: query, isHelpful: isHelpful })
        })
        .then(response => response.json())
        .then(data => {

            //automatically generate response if the feedback was "not helpful"
            if (!isHelpful) {
                clearPreviousFeedbackOptions();
                clearLastBotMessage(); // Remove the previous bot response
                regenerateResponse(query); // Call function to regenerate the response
            }
        })
        .catch(error => console.error('Error:', error));
            // Add feedback message to the chatbox
    }

    function clearLastBotMessage() {
        const chatbox = document.getElementById('chatbox');
        const botMessages = chatbox.getElementsByClassName('bot-message');
        if (botMessages.length > 0) {
            botMessages[botMessages.length - 1].remove(); // Remove the last bot message
        }
    }

    function regenerateResponse(query) {
        // Display the previous query and trigger sendMessage to regenerate
        input.value = query;
        sendMessage(true);
    }
    function addTypingIndicator() {
        const chatbox = document.getElementById('chatbox');
        const typingIndicator = document.createElement('div');
        typingIndicator.className = 'message bot-message typing-indicator-container';
        typingIndicator.innerHTML = `<img src="images/typingIndicator.gif" alt="Bot icon" class="typing-indicator-avatar-large">`;
        
        const factParagraph = document.createElement('p'); // Create a new paragraph for the fun fact
        typingIndicator.appendChild(factParagraph);
        chatbox.appendChild(typingIndicator);
        chatbox.scrollTop = chatbox.scrollHeight;
    
        // Function to update the fun fact
        const updateFunFact = () => {
            factParagraph.textContent = "Did you know? " + funFacts[Math.floor(Math.random() * funFacts.length)];
        };
        
        updateFunFact(); // Show an initial fun fact
        const funFactInterval = setInterval(updateFunFact, 6500);
    
        return { typingIndicator, funFactInterval }; // Return both the typing indicator and the interval
    }


    const funFacts = [
        "Loyalist College has over 100 programs for students!",
        "That Loyalist College offers hands-on learning opportunities?",
        "Loyalist College was established in 1967!",
        "The average college student spends 1,020 hours studying over four years.",
        "Loyalist College has over 25,000 students enrolled in 2022!",
        "The word 'college' comes from the Latin word 'collegium' meaning 'community' or 'society'.",
        "The most popular college major in the US is Business, followed by Health Professions.",
        "The average college student consumes about 34 GB of data per month.",
        "Taking handwritten notes can improve memory retention by up to 23% compared to typing.",
        "Students who study with background music can improve their test scores by up to 12%.",
        "The optimal nap length for college students is 10-20 minutes for a quick boost in alertness.",
        "The average college student checks their phone 85 times a day.",
        "E-textbooks can save students up to 50% compared to traditional textbooks.",
        "College graduates earn an average of 84% more over their lifetime compared to high school graduates.",
        "About 30% of college students participate in internships before graduation.",
        "Toronto is one of the most multicultural cities in the world, with over 160 ethnic groups and more than 140 languages spoken.",
        "Loyalist College has partnerships with industry leaders to help students gain real-world experience!",
        "The college campus spans over 200 acres, providing ample space for learning and recreation.",
        "Loyalist College offers several online programs for flexible, remote learning.",
        "Approximately 70% of college students work while enrolled to help cover their expenses.",
        "Students who volunteer during college are 27% more likely to secure employment after graduation.",
        "College students who participate in study abroad programs are 20% more likely to complete their degree.",
        "On average, college graduates are 45% more likely to own a home compared to non-graduates.",
        "Loyalist College has over 70 student clubs and organizations!",
        "The first known college, founded in 859 AD, is the University of al-Qarawiyyin in Morocco.",
        "Exercise has been shown to improve students' memory and learning speed by up to 12%.",
        "Around 40% of college students use tutoring resources provided by their college.",
        "Students who set clear study goals tend to perform 25% better than those who don't.",
        "Canada is home to over 100 universities and colleges, with some of the top-ranked institutions globally.",
        "Over 80% of Loyalist College graduates find employment within six months of graduation.",
        "Studying for just 25-30 minutes with breaks (Pomodoro Technique) has been proven to enhance focus and productivity.",
        "Loyalist College offers over 40 scholarships and awards to help students finance their education.",
        "College students who engage in extracurricular activities report higher satisfaction with their college experience.",
        "International students at Loyalist College come from over 20 different countries, fostering a diverse community.",
        "Studies show that mindfulness and meditation practices improve college students' stress management by 60%.",
        "The average starting salary for Loyalist College graduates is competitive with industry standards, helping them quickly establish their careers.",
    ];

    function removeTypingIndicator({ typingIndicator, funFactInterval }) {
        clearInterval(funFactInterval); // Clear the interval
        typingIndicator.remove(); // Remove the typing indicator from the chatbox
    }

    function addGreetingMessage() {
        addMessageToChatbox('Bot', 'Welcome! How can I assist you today?', 'bot-message');
    }

    function displayPreFramedAnswers(preFramedAnswers){
        const chatbox = document.getElementById('chatbox');
        const preFramedContainer = document.createElement('div');
        preFramedContainer.className = 'preframed-container';

        preFramedAnswers.forEach(answer => {
            const answerBtn = document.createElement('button');
            answerBtn.className = 'preframed-answer';
            answerBtn.innerText = answer;

            answerBtn.addEventListener('click', () =>{
                input.value = answer;
                sendMessage();
            });

            preFramedContainer.appendChild(answerBtn);
        });

        chatbox.appendChild(preFramedContainer);
        //chatbox.insertBefore(preFramedContainer, chatbox.firstChild);
        chatbox.scrollTop = chatbox.scrollHeight;
    }
});
