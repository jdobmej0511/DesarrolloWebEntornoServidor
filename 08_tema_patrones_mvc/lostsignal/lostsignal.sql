CREATE DATABASE IF NOT EXISTS lostsignal
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE lostsignal;

CREATE TABLE senal (
    identificador INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(20) NOT NULL UNIQUE,
    estacion VARCHAR(100) NOT NULL,
    frecuencia DECIMAL(12, 3) NOT NULL CHECK (frecuencia > 0),
    intensidad INT NOT NULL CHECK (intensidad BETWEEN 1 AND 100),
    estado CHAR(1) NOT NULL DEFAULT 'P' CHECK (estado IN ('P', 'C', 'D'))
);

INSERT INTO senal (codigo, estacion, frecuencia, intensidad, estado) VALUES
    ('LS001', 'Orion', 1420.405, 95, 'P'),
    ('LS002', 'Vega', 408.250, 62, 'C'),
    ('LS003', 'Altair', 327.125, 34, 'D'),
    ('LS004', 'Orion', 1612.231, 80, 'P'),
    ('LS005', 'Sirius', 1665.402, 79, 'P'),
    ('LS006', 'Vega', 1420.410, 91, 'C'),
    ('LS007', 'Altair', 610.500, 88, 'D'),
    ('LS008', 'Sirius', 115.750, 45, 'P'),
    ('LS009', 'Orion', 2300.125, 100, 'P'),
    ('LS010', 'Vega', 325.500, 1, 'D'),
    ('LS011', 'Vega', 157.525, 36, 'D'),
    ('LS012', 'Sirius', 613.385, 95, 'P'),
    ('LS013', 'Vega', 1656.409, 70, 'C'),
    ('LS014', 'Vega', 1458.133, 5, 'D'),
    ('LS015', 'Orion', 315.499, 30, 'P'),
    ('LS016', 'Orion', 1390.864, 92, 'C'),
    ('LS017', 'Rigel', 607.013, 76, 'D'),
    ('LS018', 'Polaris', 1961.690, 1, 'P'),
    ('LS019', 'Altair', 1705.721, 44, 'C'),
    ('LS020', 'Polaris', 457.603, 98, 'D'),
    ('LS021', 'Antares', 335.084, 49, 'P'),
    ('LS022', 'Vega', 925.653, 45, 'C'),
    ('LS023', 'Polaris', 1956.395, 94, 'D'),
    ('LS024', 'Deneb', 1333.325, 49, 'P'),
    ('LS025', 'Vega', 1369.693, 81, 'C'),
    ('LS026', 'Antares', 1427.910, 91, 'D'),
    ('LS027', 'Vega', 205.396, 30, 'P'),
    ('LS028', 'Polaris', 2366.009, 30, 'C'),
    ('LS029', 'Vega', 974.290, 59, 'D'),
    ('LS030', 'Antares', 474.104, 46, 'P'),
    ('LS031', 'Sirius', 1641.403, 90, 'C'),
    ('LS032', 'Vega', 1501.001, 22, 'D'),
    ('LS033', 'Sirius', 475.826, 49, 'P'),
    ('LS034', 'Polaris', 2375.904, 82, 'C'),
    ('LS035', 'Sirius', 1674.613, 99, 'D'),
    ('LS036', 'Orion', 626.811, 5, 'P'),
    ('LS037', 'Antares', 1022.679, 9, 'C'),
    ('LS038', 'Sirius', 2200.213, 73, 'D'),
    ('LS039', 'Antares', 589.041, 64, 'P'),
    ('LS040', 'Rigel', 2134.771, 83, 'C');