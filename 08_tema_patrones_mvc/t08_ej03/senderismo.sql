SET NAMES utf8mb4 ;

CREATE DATABASE IF NOT EXISTS senderismo
	CHARACTER SET utf8mb4
	COLLATE utf8mb4_general_ci ;

USE senderismo ;

DROP TABLE IF EXISTS ruta ;

CREATE TABLE ruta (
	idRuta int NOT NULL AUTO_INCREMENT,
	nombre varchar(100) NOT NULL,
	localidad varchar(100) NOT NULL,
	distancia decimal(5,2) NOT NULL,
	desnivel int NOT NULL,
	dificultad enum('baja','media','alta') NOT NULL,
	PRIMARY KEY (idRuta)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ;

INSERT INTO ruta (nombre, localidad, distancia, desnivel, dificultad) VALUES
	('Caminito del Rey', 'Ardales', 7.70, 100, 'baja'),
	('Senda Litoral', 'Rincón de la Victoria', 6.50, 30, 'baja'),
	('Río Chíllar', 'Nerja', 12.00, 350, 'media'),
	('Pico del Cielo', 'Nerja', 13.50, 1300, 'alta'),
	('La Maroma', 'Sedella', 16.00, 1350, 'alta'),
	('Cerro del Hijar', 'Alhaurín de la Torre', 8.20, 450, 'media'),
	('Lagunas de Campillos', 'Campillos', 10.00, 60, 'baja'),
	('Pico Mijas', 'Mijas', 9.40, 750, 'media'),
	('Torrecilla', 'Tolox', 18.70, 1500, 'alta'),
	('Gran Senda de Málaga: Etapa 1', 'Málaga', 13.20, 220, 'baja'),
	('Tajo de Ronda', 'Ronda', 5.30, 180, 'baja'),
	('Desfiladero de los Gaitanes', 'Álora', 11.00, 600, 'media') ;
