SET NAMES utf8mb4 ;

CREATE DATABASE IF NOT EXISTS objetos_perdidos
	CHARACTER SET utf8mb4
	COLLATE utf8mb4_general_ci ;

USE objetos_perdidos ;

DROP TABLE IF EXISTS objeto ;

CREATE TABLE objeto (
	idObjeto int NOT NULL AUTO_INCREMENT,
	nombre varchar(100) NOT NULL,
	descripcion varchar(255) DEFAULT NULL,
	lugar varchar(100) NOT NULL,
	fecha date NOT NULL,
	PRIMARY KEY (idObjeto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ;

INSERT INTO objeto (nombre, descripcion, lugar, fecha) VALUES
	('Paraguas', 'Paraguas negro plegable con mango de madera', 'Estación de autobuses', '2026-09-03'),
	('Cartera', 'Cartera de piel marrón sin documentación', 'Parque Central', '2026-09-12'),
	('Llaves', 'Juego de tres llaves con llavero rojo', 'Biblioteca municipal', '2026-09-20'),
	('Teléfono móvil', 'Móvil con funda azul y la pantalla rota', 'Polideportivo', '2026-10-01'),
	('Gafas de sol', 'Gafas de sol con montura negra en su funda', 'Playa de la Malagueta', '2026-10-05'),
	('Mochila', 'Mochila escolar verde con libros de texto', 'Parada de metro', '2026-10-11'),
	('Bufanda', 'Bufanda de lana gris de rayas', 'Teatro Cervantes', '2026-10-18'),
	('Reloj', 'Reloj de pulsera plateado con correa de cuero negra', 'Mercado de Atarazanas', '2026-10-27'),
	('Bicicleta', 'Bicicleta infantil roja con cesta', 'Paseo del Parque', '2026-11-04'),
	('Auriculares', 'Auriculares inalámbricos blancos en su estuche', 'Autobús línea 11', '2026-11-15') ;
