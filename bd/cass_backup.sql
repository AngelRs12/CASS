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
-- Name: departamentos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.departamentos (
    iddepto integer NOT NULL,
    nombre character varying(255),
    descripcion text,
    horario character varying(50),
    contacto character varying(255),
    ubicacion character varying(255),
    imagen text,
    fecharegistro timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    lastedit timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.departamentos OWNER TO postgres;

--
-- Name: departamentos_iddepto_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.departamentos_iddepto_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.departamentos_iddepto_seq OWNER TO postgres;

--
-- Name: departamentos_iddepto_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.departamentos_iddepto_seq OWNED BY public.departamentos.iddepto;


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
-- Name: departamentos iddepto; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.departamentos ALTER COLUMN iddepto SET DEFAULT nextval('public.departamentos_iddepto_seq'::regclass);


--
-- Name: solicitudes folio; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitudes ALTER COLUMN folio SET DEFAULT nextval('public.solicitudes_folio_seq'::regclass);


--
-- Name: usuarios idusuario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios ALTER COLUMN idusuario SET DEFAULT nextval('public.usuarios_idusuario_seq'::regclass);


--
-- Data for Name: departamentos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.departamentos (iddepto, nombre, descripcion, horario, contacto, ubicacion, imagen, fecharegistro, lastedit) FROM stdin;
2	important photo					/cass/assets/Img/departamentos/depto_68b270c31975a.jpg	2025-08-29 21:26:23.261276	2025-08-29 21:32:19.10569
\.


--
-- Data for Name: solicitudes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.solicitudes (folio, idusuario, tipo, fechasolicitud, estado, comentarios, atendidopor) FROM stdin;
5	2	Soporte	2025-08-20 17:44:16.561435	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
6	2	Soporte	2025-08-20 17:44:19.208276	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	0
7	2	Soporte	2025-08-20 17:44:19.380612	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	0
19	2	Soporte	2025-08-22 21:07:23.121797	Aprobado	sabhfjhbsfjhsf	1
4	2	Soporte	2025-08-20 17:44:16.333445	Pendiente	Comentario Comentario Comentario Comentario \r\nComentario Comentario Comentario Comentario	1
2	2	Soporte	2025-08-20 17:42:54.911188	Aprobado	chsm to	1
1	2	Soporte	2025-08-20 17:42:53.028898	Rechazado	a	1
3	2	Soporte	2025-08-20 17:44:14.94248	Rechazado	test	1
8	1	Descarga Office	2025-08-22 14:16:37.239409	Pendiente	safsdff	0
9	2	Soporte	2025-08-22 21:07:21.709867	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
10	2	Soporte	2025-08-22 21:07:21.831796	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
11	2	Soporte	2025-08-22 21:07:21.976726	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
12	2	Soporte	2025-08-22 21:07:22.109568	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
13	2	Soporte	2025-08-22 21:07:22.244125	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
14	2	Soporte	2025-08-22 21:07:22.379324	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
15	2	Soporte	2025-08-22 21:07:22.527253	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
16	2	Soporte	2025-08-22 21:07:22.687867	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
17	2	Soporte	2025-08-22 21:07:22.799989	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
18	2	Soporte	2025-08-22 21:07:22.958409	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
20	2	Soporte	2025-08-22 21:07:23.247009	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
21	2	Soporte	2025-08-22 21:07:23.393358	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
22	2	Soporte	2025-08-22 21:07:23.534322	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
23	2	Soporte	2025-08-22 21:07:23.67065	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
24	2	Soporte	2025-08-22 21:07:56.839278	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
25	2	Soporte	2025-08-22 21:07:56.975759	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
26	2	Soporte	2025-08-22 21:07:57.118966	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
27	2	Soporte	2025-08-22 21:07:57.251744	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
28	2	Soporte	2025-08-22 21:07:57.398185	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
29	2	Soporte	2025-08-22 21:07:57.543265	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
30	2	Soporte	2025-08-22 21:07:57.686551	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
31	2	Soporte	2025-08-22 21:07:57.840976	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
32	2	Soporte	2025-08-22 21:07:57.969142	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
33	2	Soporte	2025-08-22 21:07:58.136212	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
34	2	Soporte	2025-08-22 21:07:58.264934	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
35	2	Soporte	2025-08-22 21:07:58.41064	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
36	2	Soporte	2025-08-22 21:07:58.564572	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
37	2	Soporte	2025-08-22 21:07:58.720177	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
38	2	Soporte	2025-08-22 21:07:58.876027	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
39	2	Soporte	2025-08-22 21:07:59.029344	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
40	2	Soporte	2025-08-22 21:07:59.180385	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
41	2	Soporte	2025-08-22 21:07:59.31459	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
42	2	Soporte	2025-08-22 21:07:59.464129	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
43	2	Soporte	2025-08-22 21:07:59.612635	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
44	2	Soporte	2025-08-22 21:07:59.743416	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
45	2	Soporte	2025-08-22 21:07:59.896017	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
46	2	Soporte	2025-08-22 21:08:00.000943	Pendiente	Comentario Comentario Comentario Comentario \nComentario Comentario Comentario Comentario	3
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
-- Name: departamentos_iddepto_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.departamentos_iddepto_seq', 2, true);


--
-- Name: solicitudes_folio_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.solicitudes_folio_seq', 46, true);


--
-- Name: usuarios_idusuario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuarios_idusuario_seq', 3, true);


--
-- Name: departamentos departamentos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.departamentos
    ADD CONSTRAINT departamentos_pkey PRIMARY KEY (iddepto);


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

