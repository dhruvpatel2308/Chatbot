
-- Create the sequence if it does not already exist
CREATE SEQUENCE IF NOT EXISTS admin_tbl_admin_id_seq
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 2147483647
    CACHE 1;

-- Create the table if it does not already exist, linking it to the sequence
CREATE TABLE IF NOT EXISTS admin_tbl (
    admin_id integer NOT NULL DEFAULT nextval('admin_tbl_admin_id_seq'::regclass),
    admin_username character varying(1000) COLLATE pg_catalog."default",
    admin_password character varying(1000) COLLATE pg_catalog."default",
    admin_name character varying(1000) COLLATE pg_catalog."default",
    admin_email character varying(1000) COLLATE pg_catalog."default",
    admin_contact character varying(1000) COLLATE pg_catalog."default",
    admin_pic character varying(1000) COLLATE pg_catalog."default",
    admin_location character varying(1000) COLLATE pg_catalog."default",
    created_at timestamp without time zone
)
TABLESPACE pg_default;

-- Alter the sequence to associate it with the table column
ALTER SEQUENCE admin_tbl_admin_id_seq
    OWNED BY admin_tbl.admin_id;

-- Set ownership of the table and sequence to the 'postgres' user
ALTER TABLE IF EXISTS admin_tbl
    OWNER TO postgres;

ALTER SEQUENCE admin_tbl_admin_id_seq
    OWNER TO postgres;

CREATE SEQUENCE IF NOT EXISTS knowledge_base_kb_id_seq
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 2147483647
    CACHE 1;
CREATE TABLE IF NOT EXISTS knowledge_base
(
    kb_id integer NOT NULL DEFAULT nextval('knowledge_base_kb_id_seq'::regclass),
    admin_id character varying(1000) COLLATE pg_catalog."default",
    kb_title character varying(1000) COLLATE pg_catalog."default",
    kb_type character varying(1000) COLLATE pg_catalog."default",
    kb_status character varying(1000) COLLATE pg_catalog."default",
    kb_desc character varying(1000) COLLATE pg_catalog."default",
    kb_created_at timestamp without time zone,
    kb_file character varying(1000) COLLATE pg_catalog."default",
    CONSTRAINT knowledge_base_pkey PRIMARY KEY (kb_id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS knowledge_base
    OWNER to postgres;
ALTER SEQUENCE knowledge_base_kb_id_seq
    OWNED BY knowledge_base.kb_id;

ALTER SEQUENCE knowledge_base_kb_id_seq
    OWNER TO postgres;
	
CREATE SEQUENCE IF NOT EXISTS users_tbl_user_id_seq
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 2147483647
    CACHE 1;

CREATE TABLE IF NOT EXISTS users_tbl
(
    user_id integer NOT NULL DEFAULT nextval('users_tbl_user_id_seq'::regclass),
    user_name character varying(1000) COLLATE pg_catalog."default",
    user_email character varying(1000) COLLATE pg_catalog."default",
    user_username character varying(1000) COLLATE pg_catalog."default",
    user_password character varying(1000) COLLATE pg_catalog."default",
    user_contact character varying(1000) COLLATE pg_catalog."default",
    user_pic character varying(1000) COLLATE pg_catalog."default",
    user_location character varying(1000) COLLATE pg_catalog."default",
    user_created_at timestamp without time zone,
    CONSTRAINT users_tbl_pkey PRIMARY KEY (user_id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS users_tbl
    OWNER to postgres;

ALTER SEQUENCE users_tbl_user_id_seq
    OWNED BY users_tbl.user_id;

ALTER SEQUENCE users_tbl_user_id_seq
    OWNER TO postgres;
	
CREATE SEQUENCE IF NOT EXISTS public.chatbot_conversations_id_seq
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9223372036854775807
    CACHE 1;
	
CREATE TABLE IF NOT EXISTS chatbot_conversations
(
    id integer NOT NULL DEFAULT nextval('chatbot_conversations_id_seq'::regclass),
    student_id text COLLATE pg_catalog."default",
    user_message text COLLATE pg_catalog."default" NOT NULL,
    bot_response text COLLATE pg_catalog."default" NOT NULL,
    "timestamp" timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT chatbot_conversations_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS chatbot_conversations
    OWNER to postgres;

ALTER SEQUENCE chatbot_conversations_id_seq
    OWNER TO postgres;