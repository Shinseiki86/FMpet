--
-- PostgreSQL database dump
--

-- Dumped from database version 10.7
-- Dumped by pg_dump version 10.7

-- Started on 2019-05-11 10:54:20

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 2915 (class 1262 OID 16397)
-- Name: FMPet; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE "FMPet" WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Spanish_Spain.1252' LC_CTYPE = 'Spanish_Spain.1252';


ALTER DATABASE "FMPet" OWNER TO postgres;

\connect "FMPet"

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 12924)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2917 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 202 (class 1259 OID 16447)
-- Name: barrio; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.barrio (
    id integer NOT NULL,
    nombre character varying(50) DEFAULT NULL::character varying,
    id_ciudad integer NOT NULL
);


ALTER TABLE public.barrio OWNER TO postgres;

--
-- TOC entry 199 (class 1259 OID 16429)
-- Name: ciudad; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ciudad (
    id integer NOT NULL,
    nombre character varying(50) DEFAULT NULL::character varying,
    id_departamento integer NOT NULL
);


ALTER TABLE public.ciudad OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 16465)
-- Name: comentario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.comentario (
    id integer NOT NULL,
    descripcion character varying(50) DEFAULT NULL::character varying,
    id_publicacion integer NOT NULL
);


ALTER TABLE public.comentario OWNER TO postgres;

--
-- TOC entry 201 (class 1259 OID 16441)
-- Name: departamento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.departamento (
    id integer NOT NULL,
    nombre character varying(50) DEFAULT NULL::character varying,
    id_pais integer NOT NULL
);


ALTER TABLE public.departamento OWNER TO postgres;

--
-- TOC entry 203 (class 1259 OID 16453)
-- Name: estado; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.estado (
    id integer NOT NULL,
    nombre character varying(50) DEFAULT NULL::character varying
);


ALTER TABLE public.estado OWNER TO postgres;

--
-- TOC entry 209 (class 1259 OID 16488)
-- Name: itempublicacioncomentarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.itempublicacioncomentarios (
    id integer NOT NULL,
    url character varying(50) DEFAULT NULL::character varying,
    id_tipoarchivo integer NOT NULL,
    id_publicacion_comentario integer NOT NULL,
    id_tipotabla integer NOT NULL
);


ALTER TABLE public.itempublicacioncomentarios OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 16417)
-- Name: mascota; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.mascota (
    id integer NOT NULL,
    nombre character varying(50) DEFAULT NULL::character varying,
    edad integer,
    id_persona integer
);


ALTER TABLE public.mascota OWNER TO postgres;

--
-- TOC entry 200 (class 1259 OID 16435)
-- Name: pais; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pais (
    id integer NOT NULL,
    nombre character varying(50) DEFAULT NULL::character varying
);


ALTER TABLE public.pais OWNER TO postgres;

--
-- TOC entry 196 (class 1259 OID 16398)
-- Name: persona; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.persona (
    id integer NOT NULL,
    numeroidentificacion integer,
    nombre character varying(50),
    apellido character varying(50),
    telefono integer,
    direccion character varying(20) DEFAULT NULL::character varying,
    correo character varying(50) DEFAULT NULL::character varying,
    id_tipopersona integer
);


ALTER TABLE public.persona OWNER TO postgres;

--
-- TOC entry 206 (class 1259 OID 16471)
-- Name: publicacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.publicacion (
    id integer NOT NULL,
    titulo character varying(50),
    descripcion character varying(50),
    latitud double precision,
    longitud double precision,
    "fechaRegistro" timestamp without time zone,
    "fechaActualizacion" timestamp without time zone,
    id_persona integer NOT NULL,
    id_mascota integer NOT NULL,
    id_estado integer NOT NULL,
    id_barrio integer NOT NULL,
    id_tipopublicacion integer NOT NULL
);


ALTER TABLE public.publicacion OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 16476)
-- Name: tipoarchivo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipoarchivo (
    id integer NOT NULL,
    nombre character varying(50) DEFAULT NULL::character varying
);


ALTER TABLE public.tipoarchivo OWNER TO postgres;

--
-- TOC entry 198 (class 1259 OID 16423)
-- Name: tipopersona; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipopersona (
    id integer NOT NULL,
    nombre character varying(50) DEFAULT NULL::character varying
);


ALTER TABLE public.tipopersona OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 16459)
-- Name: tipopublicacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipopublicacion (
    id integer NOT NULL,
    nombre character varying(50) DEFAULT NULL::character varying
);


ALTER TABLE public.tipopublicacion OWNER TO postgres;

--
-- TOC entry 208 (class 1259 OID 16482)
-- Name: tipotabla; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipotabla (
    id integer NOT NULL,
    nombre character varying(50) DEFAULT NULL::character varying
);


ALTER TABLE public.tipotabla OWNER TO postgres;

--
-- TOC entry 2902 (class 0 OID 16447)
-- Dependencies: 202
-- Data for Name: barrio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.barrio (id, nombre, id_ciudad) FROM stdin;
\.


--
-- TOC entry 2899 (class 0 OID 16429)
-- Dependencies: 199
-- Data for Name: ciudad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ciudad (id, nombre, id_departamento) FROM stdin;
\.


--
-- TOC entry 2905 (class 0 OID 16465)
-- Dependencies: 205
-- Data for Name: comentario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.comentario (id, descripcion, id_publicacion) FROM stdin;
\.


--
-- TOC entry 2901 (class 0 OID 16441)
-- Dependencies: 201
-- Data for Name: departamento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.departamento (id, nombre, id_pais) FROM stdin;
\.


--
-- TOC entry 2903 (class 0 OID 16453)
-- Dependencies: 203
-- Data for Name: estado; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.estado (id, nombre) FROM stdin;
\.


--
-- TOC entry 2909 (class 0 OID 16488)
-- Dependencies: 209
-- Data for Name: itempublicacioncomentarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.itempublicacioncomentarios (id, url, id_tipoarchivo, id_publicacion_comentario, id_tipotabla) FROM stdin;
\.


--
-- TOC entry 2897 (class 0 OID 16417)
-- Dependencies: 197
-- Data for Name: mascota; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.mascota (id, nombre, edad, id_persona) FROM stdin;
\.


--
-- TOC entry 2900 (class 0 OID 16435)
-- Dependencies: 200
-- Data for Name: pais; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pais (id, nombre) FROM stdin;
\.


--
-- TOC entry 2896 (class 0 OID 16398)
-- Dependencies: 196
-- Data for Name: persona; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.persona (id, numeroidentificacion, nombre, apellido, telefono, direccion, correo, id_tipopersona) FROM stdin;
\.


--
-- TOC entry 2906 (class 0 OID 16471)
-- Dependencies: 206
-- Data for Name: publicacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.publicacion (id, titulo, descripcion, latitud, longitud, "fechaRegistro", "fechaActualizacion", id_persona, id_mascota, id_estado, id_barrio, id_tipopublicacion) FROM stdin;
\.


--
-- TOC entry 2907 (class 0 OID 16476)
-- Dependencies: 207
-- Data for Name: tipoarchivo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipoarchivo (id, nombre) FROM stdin;
\.


--
-- TOC entry 2898 (class 0 OID 16423)
-- Dependencies: 198
-- Data for Name: tipopersona; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipopersona (id, nombre) FROM stdin;
\.


--
-- TOC entry 2904 (class 0 OID 16459)
-- Dependencies: 204
-- Data for Name: tipopublicacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipopublicacion (id, nombre) FROM stdin;
\.


--
-- TOC entry 2908 (class 0 OID 16482)
-- Dependencies: 208
-- Data for Name: tipotabla; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipotabla (id, nombre) FROM stdin;
\.


--
-- TOC entry 2747 (class 2606 OID 16452)
-- Name: barrio barrio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.barrio
    ADD CONSTRAINT barrio_pkey PRIMARY KEY (id);


--
-- TOC entry 2741 (class 2606 OID 16434)
-- Name: ciudad ciudad_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ciudad
    ADD CONSTRAINT ciudad_pkey PRIMARY KEY (id);


--
-- TOC entry 2753 (class 2606 OID 16470)
-- Name: comentario comentario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.comentario
    ADD CONSTRAINT comentario_pkey PRIMARY KEY (id);


--
-- TOC entry 2745 (class 2606 OID 16446)
-- Name: departamento departamento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.departamento
    ADD CONSTRAINT departamento_pkey PRIMARY KEY (id);


--
-- TOC entry 2749 (class 2606 OID 16458)
-- Name: estado estado_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estado
    ADD CONSTRAINT estado_pkey PRIMARY KEY (id);


--
-- TOC entry 2761 (class 2606 OID 16493)
-- Name: itempublicacioncomentarios itemPublicacionComentarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.itempublicacioncomentarios
    ADD CONSTRAINT "itemPublicacionComentarios_pkey" PRIMARY KEY (id);


--
-- TOC entry 2737 (class 2606 OID 16422)
-- Name: mascota mascota_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mascota
    ADD CONSTRAINT mascota_pkey PRIMARY KEY (id);


--
-- TOC entry 2743 (class 2606 OID 16440)
-- Name: pais pais_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pais
    ADD CONSTRAINT pais_pkey PRIMARY KEY (id);


--
-- TOC entry 2735 (class 2606 OID 16405)
-- Name: persona persona_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.persona
    ADD CONSTRAINT persona_pkey PRIMARY KEY (id);


--
-- TOC entry 2755 (class 2606 OID 16475)
-- Name: publicacion publicacion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.publicacion
    ADD CONSTRAINT publicacion_pkey PRIMARY KEY (id);


--
-- TOC entry 2739 (class 2606 OID 16428)
-- Name: tipopersona tipoPersona_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipopersona
    ADD CONSTRAINT "tipoPersona_pkey" PRIMARY KEY (id);


--
-- TOC entry 2751 (class 2606 OID 16464)
-- Name: tipopublicacion tipoPublicacion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipopublicacion
    ADD CONSTRAINT "tipoPublicacion_pkey" PRIMARY KEY (id);


--
-- TOC entry 2757 (class 2606 OID 16481)
-- Name: tipoarchivo tipoarchivo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipoarchivo
    ADD CONSTRAINT tipoarchivo_pkey PRIMARY KEY (id);


--
-- TOC entry 2759 (class 2606 OID 16487)
-- Name: tipotabla tipotabla_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipotabla
    ADD CONSTRAINT tipotabla_pkey PRIMARY KEY (id);


--
-- TOC entry 2766 (class 2606 OID 16494)
-- Name: barrio fk_barrio_idciudad; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.barrio
    ADD CONSTRAINT fk_barrio_idciudad FOREIGN KEY (id_ciudad) REFERENCES public.ciudad(id);


--
-- TOC entry 2764 (class 2606 OID 16499)
-- Name: ciudad fk_ciudad_iddepartamento; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ciudad
    ADD CONSTRAINT fk_ciudad_iddepartamento FOREIGN KEY (id_departamento) REFERENCES public.departamento(id);


--
-- TOC entry 2767 (class 2606 OID 16519)
-- Name: comentario fk_comentario_idpublicacion; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.comentario
    ADD CONSTRAINT fk_comentario_idpublicacion FOREIGN KEY (id_publicacion) REFERENCES public.publicacion(id);


--
-- TOC entry 2765 (class 2606 OID 16504)
-- Name: departamento fk_departamento_idpais; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.departamento
    ADD CONSTRAINT fk_departamento_idpais FOREIGN KEY (id_pais) REFERENCES public.pais(id);


--
-- TOC entry 2773 (class 2606 OID 16524)
-- Name: itempublicacioncomentarios fk_itempublicacioncomentarios_idtipoarchivo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.itempublicacioncomentarios
    ADD CONSTRAINT fk_itempublicacioncomentarios_idtipoarchivo FOREIGN KEY (id_tipoarchivo) REFERENCES public.tipoarchivo(id);


--
-- TOC entry 2774 (class 2606 OID 16529)
-- Name: itempublicacioncomentarios fk_itempublicacioncomentarios_idtipotabla; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.itempublicacioncomentarios
    ADD CONSTRAINT fk_itempublicacioncomentarios_idtipotabla FOREIGN KEY (id_tipotabla) REFERENCES public.tipotabla(id);


--
-- TOC entry 2763 (class 2606 OID 16514)
-- Name: mascota fk_mascota_idpersona; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mascota
    ADD CONSTRAINT fk_mascota_idpersona FOREIGN KEY (id_persona) REFERENCES public.persona(id);


--
-- TOC entry 2762 (class 2606 OID 16509)
-- Name: persona fk_persona_idtipopersona; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.persona
    ADD CONSTRAINT fk_persona_idtipopersona FOREIGN KEY (id_tipopersona) REFERENCES public.tipopersona(id);


--
-- TOC entry 2772 (class 2606 OID 16554)
-- Name: publicacion fk_publicacion_idbarrio; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.publicacion
    ADD CONSTRAINT fk_publicacion_idbarrio FOREIGN KEY (id_barrio) REFERENCES public.barrio(id);


--
-- TOC entry 2771 (class 2606 OID 16549)
-- Name: publicacion fk_publicacion_idestado; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.publicacion
    ADD CONSTRAINT fk_publicacion_idestado FOREIGN KEY (id_estado) REFERENCES public.estado(id);


--
-- TOC entry 2770 (class 2606 OID 16544)
-- Name: publicacion fk_publicacion_idmascota; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.publicacion
    ADD CONSTRAINT fk_publicacion_idmascota FOREIGN KEY (id_mascota) REFERENCES public.mascota(id);


--
-- TOC entry 2768 (class 2606 OID 16534)
-- Name: publicacion fk_publicacion_idpersona; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.publicacion
    ADD CONSTRAINT fk_publicacion_idpersona FOREIGN KEY (id_persona) REFERENCES public.persona(id);


--
-- TOC entry 2769 (class 2606 OID 16539)
-- Name: publicacion fk_publicacion_idtipopublicacion; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.publicacion
    ADD CONSTRAINT fk_publicacion_idtipopublicacion FOREIGN KEY (id_tipopublicacion) REFERENCES public.tipopublicacion(id);


-- Completed on 2019-05-11 10:54:21

--
-- PostgreSQL database dump complete
--

