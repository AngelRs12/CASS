--
-- PostgreSQL database dump
--

-- Dumped from database version 17.4
-- Dumped by pg_dump version 17.4

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: solicitudes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.solicitudes (
    folio integer NOT NULL,
    idusuario integer NOT NULL,
    tipo character varying(100),
    fechasolicitud timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    estado character varying(50) DEFAULT 'Pendiente'::character varying,
    comentarios text,
    atendidopor integer DEFAULT 0
);


ALTER TABLE public.solicitudes OWNER TO postgres;

--
-- Name: solicitudes_folio_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.solicitudes_folio_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.solicitudes_folio_seq OWNER TO postgres;

--
-- Name: solicitudes_folio_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.solicitudes_folio_seq OWNED BY public.solicitudes.folio;


--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuarios (
    idusuario integer NOT NULL,
    mail character varying(254) NOT NULL,
    contra character varying(255) NOT NULL,
    nombre character varying(50) NOT NULL,
    ap_pat character varying(50) NOT NULL,
    ap_mat character varying(50),
    tipo character varying(50),
    activo character(1) DEFAULT '1'::bpchar,
    fecharegistro timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.usuarios OWNER TO postgres;

--
-- Name: usuarios_idusuario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuarios_idusuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.usuarios_idusuario_seq OWNER TO postgres;

--
-- Name: usuarios_idusuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.usuarios_idusuario_seq OWNED BY public.usuarios.idusuario;


--
-- Name: solicitudes folio; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitudes ALTER COLUMN folio SET DEFAULT nextval('public.solicitudes_folio_seq'::regclass);


--
-- Name: usuarios idusuario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios ALTER COLUMN idusuario SET DEFAULT nextval('public.usuarios_idusuario_seq'::regclass);


--
-- Data for Name: solicitudes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.solicitudes (folio, idusuario, tipo, fechasolicitud, estado, comentarios, atendidopor) FROM stdin;
5	2	Soporte	2025-08-20 17:44:16.561435	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
6	2	Soporte	2025-08-20 17:44:19.208276	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	0
7	2	Soporte	2025-08-20 17:44:19.380612	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	0
4	2	Soporte	2025-08-20 17:44:16.333445	Pendiente	Comentario Comentario Comentario Comentario \r\nComentario Comentario Comentario Comentario	1
2	2	Soporte	2025-08-20 17:42:54.911188	Aprobado	chsm to	1
1	2	Soporte	2025-08-20 17:42:53.028898	Rechazado	a	1
3	2	Soporte	2025-08-20 17:44:14.94248	Rechazado	test	1
8	1	Descarga Office	2025-08-22 14:16:37.239409	Pendiente	safsdff	0
\.


--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuarios (idusuario, mail, contra, nombre, ap_pat, ap_mat, tipo, activo, fecharegistro) FROM stdin;
2	a1@cd.te.mx	$2y$10$Q9GBPn18fuNQRCVGajPxSOG4PC34Ii5EfvJyBM55O3Z9GXL.KEGLa	a	a	a	3	1	2025-08-15 12:37:41.151135
3	a3@cd.te.mx	$2y$10$8IoS5z3F0a7B4f0MyvyLues4C6orbUG7dutcbSsau02WlrVw8pCVC	test	test	test	2	1	2025-08-20 11:59:50.495605
1	a@cd.te.mx	$2y$10$LjFqS4yjeKO6GZ3YufPD8Odo4SQXzwhbPm8yUS3guDZjMa72NQEYC	bonk	bonk	a	1	1	2025-08-15 12:37:13.269073
\.


--
-- Name: solicitudes_folio_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.solicitudes_folio_seq', 8, true);


--
-- Name: usuarios_idusuario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuarios_idusuario_seq', 3, true);


--
-- Name: solicitudes solicitudes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitudes
    ADD CONSTRAINT solicitudes_pkey PRIMARY KEY (folio);


--
-- Name: usuarios usuarios_mail_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_mail_key UNIQUE (mail);


--
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (idusuario);


--
-- PostgreSQL database dump complete
--

