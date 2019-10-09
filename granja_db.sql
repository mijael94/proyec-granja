CREATE DATABASE granja_db;

USE granja_db;

CREATE TABLE galpon1
(
	id_galpon  INT PRIMARY KEY AUTO_INCREMENT,
	nom_galpon VARCHAR(50)

);

CREATE TABLE gastos
(
	id_gastos INT PRIMARY KEY AUTO_INCREMENT,
	nro_documento INT(100),
	fecha DATE,
	detalle VARCHAR(50),
	importe INT(11),
	observacion VARCHAR(50), 
	id_galpon INT

);

SELECT * FROM gastos;

CREATE TABLE alimentos
(
	id_alimentos INT PRIMARY KEY AUTO_INCREMENT,
	cod_alimento INT,
	hora TIMESTAMP,
	cantidad INT,
	producto VARCHAR(50),
	fecha_venc DATE,
	precio INT
	
);

SELECT * FROM alimentos;

CREATE TABLE peso
(
	id_peso INT PRIMARY KEY AUTO_INCREMENT,
	fecha DATE,
	peso INT,
	uni_medida VARCHAR(50)

);

CREATE TABLE medicina 
(
	id_medicina INT PRIMARY KEY AUTO_INCREMENT,
	cod_medicina INT,
	fecha_llegada DATE,
	cantidad INT,
	descripcion_med VARCHAR(50),
	fecha_venc DATE,
	precio INT
	
);

CREATE TABLE usuario
(
	id_usuario INT PRIMARY KEY AUTO_INCREMENT
	email VARCHAR(50),
	PASSWORD VARCHAR(50) 

);
