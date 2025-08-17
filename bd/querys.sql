--for dump 
--C:\Program Files\PostgreSQL\17\bin
--pg_dump -U postgres -d cass > C:\xampp\htdocs\CASS\bd\cass_backup.sql
-- 

--for restore
--uno d estos debe d funcionar
--psql -U username -d dbname -f /path/to/backup.sql

--psql -U postgres -d cass < C:\xampp\htdocs\CASS\bd\cass_backup.sql

/*
create table usuarios (
	idUsuario SERIAL PRIMARY KEY,
	mail varchar(254) not null unique,
	contra varchar(255),
	tipo varchar(50), --pa q es este?
	fechaRegistro timestamp default current_timestamp
)
*/

create table usuarios (
	idUsuario SERIAL primary key,
	mail varchar(254) not null unique,
	contra varchar(255) not null,
	nombre varchar(50) not null,
	ap_pat varchar(50) not null,
	ap_mat varchar(50),
	tipo varchar(50), 
	activo char default ('1'), 
	--campous char, 
	fechaRegistro timestamp default current_timestamp
)


SELECT idusuario FROM usuarios WHERE mail = 'a@cd.te.mx'

--drop table usuarios

--insert into usuarios (mail,contra,tipo,nombre,ap_pat,ap_mat) 
values ('a2@a.com','1234','1')

select * from usuarios




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

