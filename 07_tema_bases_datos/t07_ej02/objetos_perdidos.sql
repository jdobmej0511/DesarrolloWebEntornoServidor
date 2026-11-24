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
	('Escopeta táctica', 'Escopeta de rareza épica con el cargador vacío', 'Pisos Picados', '2026-09-03'),
	('Pico recolector', 'Pico por defecto con el mango algo desgastado', 'Pueblo Tomate', '2026-09-12'),
	('Poción de escudo', 'Poción azul que da 50 puntos de escudo', 'Parque Placentero', '2026-09-20'),
	('Botiquín', 'Botiquín de primeros auxilios que cura toda la vida', 'Lago Botín', '2026-10-01'),
	('Granada de impulso', 'Granada morada que lanza por los aires a quien está cerca', 'Zona Comercial', '2026-10-05'),
	('Fusil de asalto', 'Fusil de rareza legendaria de color dorado', 'Pisos Picados', '2026-10-11'),
	('Planeador', 'Planeador plegado con estampado de llamas', 'Autobús de batalla', '2026-10-18'),
	('Llama de suministros', 'Llama de piñata llena de munición y materiales', 'Parque Placentero', '2026-10-27'),
	('Cofre del tesoro', 'Cofre dorado que todavía brilla y hace ruido', 'Pueblo Tomate', '2026-11-04'),
	('Plátano de pescado', 'Pez saltarín amarillo que cura 15 puntos de vida', 'Lago Botín', '2026-11-15') ;
