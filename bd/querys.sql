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

--update usuarios set tipo = '2'
where idusuario= 3

--update usuarios set nombre  = 'bonk',ap_pat = 'bonk'
where idusuario= 1

CREATE TABLE solicitudes (
    folio SERIAL PRIMARY KEY,
    idUsuario INT NOT NULL,
    tipo VARCHAR(100),
    fechaSolicitud TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado VARCHAR(50) DEFAULT 'Pendiente',
    comentarios TEXT,
	atendidopor int default 0 
);

SELECT s.folio, s.tipo, TO_CHAR(s.fechaSolicitud, 'YYYY-MM-DD') as fecha, s.estado, 
                       COALESCE(s.comentarios, '') as comentarios, concat(u.nombre,' ', u.ap_pat) as atendido
                FROM solicitudes s inner join usuarios u on u.idusuario = s.atendidopor
				
--drop table solicitudes

--insert into solicitudes (idusuario, tipo, comentarios, atendidopor ) 
values (2,'Soporte','Comentario Comentario Comentario Comentario 
Comentario Comentario Comentario Comentario','3')

--insert into solicitudes (idusuario, tipo, comentarios ) 
values (2,'Soporte','Comentario Comentario Comentario Comentario 
Comentario Comentario Comentario Comentario')



select * from solicitudes
where idusuario = 2
----------------------------------------------------------


create table departamentos (
	idDepto SERIAL primary key,
	nombre varchar(255),
	descripcion text,
	horario varchar(50),
	contacto  varchar(255),
	ubicacion  varchar(255),
	imagen text,
	fechaRegistro timestamp default current_timestamp,
	lastEdit timestamp default current_timestamp
)
--drop table departamentos


select * from departamentos 


