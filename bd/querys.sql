

create table usuarios (
	idUsuario SERIAL PRIMARY KEY,
	mail varchar(254) not null unique,
	contra varchar(255),
	tipo varchar(50), --pa q es este?
	fechaRegistro timestamp default current_timestamp
)

--drop table usuarios

--insert into usuarios (mail,contra,tipo) 
values ('a2@a.com','1234','tipo1')

select * from usuarios


--for dump 
--C:\Program Files\PostgreSQL\<ver>\bin
--pg_dump -U postgres -d cass > C:\Users\sonia\Downloads\cass_backup.sql


--uno d estos debe d funcionar
--psql -U username -d dbname -f /path/to/backup.sql

--psql -U user db_name < /directory/archive.sql


