CREATE DATABASE IF NOT EXISTS symfony_master;
USE symfony_master;

CREATE TABLE IF NOT EXISTS users(
id  int(255) auto_increment not null,
role  varchar (50),
name  varchar (100),
surname varchar (200),
email varchar (255),
password  varchar (255),
created_at datetime,
CONSTRAINT pk_users PRIMARY KEY (id)
)ENGINE=InnoDb;

INSERT INTO users VALUES(NULL, 'ROLE_USER','Vicente', 'Peralta', 'viper@gmail.com', 'password',CURTIME());
INSERT INTO users VALUES(NULL, 'ROLE_USER','Belén', 'Peralta Nasiff', 'bper@gmail.com', 'password',CURTIME());
INSERT INTO users VALUES(NULL, 'ROLE_USER','Eduardo', 'Peralta', 'eper@gmail.com', 'password',CURTIME());

CREATE TABLE IF NOT EXISTS managers(
id  int(255) auto_increment not null,
role  varchar (50),
name  varchar (100),
surname varchar (200),
email varchar (255),
password  varchar (255),
created_at datetime,
CONSTRAINT pk_users PRIMARY KEY (id)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS fichas(
id  int(255) auto_increment not null,
user_id int(255) not null,
type  varchar (255),
title varchar (255),
content text,
priority  varchar (20),
rut varchar (20),
diagnostico varchar (255),
created_at  datetime,
CONSTRAINT pk_fichas PRIMARY KEY (id),
CONSTRAINT fk_ficha_user FOREIGN KEY (user_id)REFERENCES users(id)
)ENGINE=InnoDb;

INSERT INTO fichas VALUES(NULL, 1,'Ficha de Ingreso', 'Ficha 1', 'Contenido rapido de ficha 1', 'alta','16.370.212-6','sobrepeso',CURTIME());
INSERT INTO fichas VALUES(NULL, 2,'Ficha de Ingreso', 'Ficha 1', 'Contenido rapido de ficha 1', 'alta','17.404.354-k','dolor de espalda',CURTIME());
INSERT INTO fichas VALUES(NULL, 3,'Ficha de Ingreso', 'Ficha 1', 'Contenido rapido de ficha 1', 'alta','16.370.212-6','gota',CURTIME());

CREATE TABLE IF NOT EXISTS fichasmedicas(
id  int(255) auto_increment not null,
user_id int(255) not null,
manager_id int(255) not null,
type  varchar (255),
title varchar (255),
content text,
priority  varchar (20),
rut varchar (20),
diagnostico varchar (255),
created_at  datetime,
CONSTRAINT pk_fichasmedicas PRIMARY KEY (id),
CONSTRAINT fk_fichamedica_user FOREIGN KEY (user_id) REFERENCES users(id),
CONSTRAINT fk_fichamedica_manager FOREIGN KEY (manager_id) REFERENCES managers(id)
)ENGINE=InnoDb;