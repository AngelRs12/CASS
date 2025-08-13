

create table usuarios (
	idUsuario SERIAL PRIMARY KEY,
	mail varchar(254) not null unique,
	contra varchar(255),
	tipo varchar(50), --pa q es este?
	fechaRegistro timestamp default current_timestamp
)


SELECT idusuario FROM usuarios WHERE mail = 'a@cd.te.mx'

--drop table usuarios

--insert into usuarios (mail,contra,tipo) 
values ('a2@a.com','1234','tipo1')

select * from usuarios


--for dump 
--C:\Program Files\PostgreSQL\17\bin
--pg_dump -U postgres -d cass > C:\xampp\htdocs\CASS\bd\cass_backup.sql
-- 


--uno d estos debe d funcionar
--psql -U username -d dbname -f /path/to/backup.sql

--psql -U postgres -d cass < C:\xampp\htdocs\CASS\bd\cass_backup.sql


CREATE TABLE solicitudes (
    folio SERIAL PRIMARY KEY,
    idUsuario INT NOT NULL,
    tipo VARCHAR(100),
    fechaSolicitud TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado VARCHAR(50) DEFAULT 'Pendiente',
    comentarios TEXT
);

--drop table solicitudes

--insert into solicitudes (usuarioMail, tipo, comentarios ) 
values ('a@cd.te.mx','Soporte','Comentario Comentario Comentario Comentario Comentario Comentario Comentario Comentario')


select * from solicitudes

