-- Crear base de datos discografia
CREATE DATABASE IF NOT EXISTS discografia CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE discografia;

-- Tabla Álbum
CREATE TABLE IF NOT EXISTS album (
    codigo VARCHAR(7) PRIMARY KEY,
    titulo VARCHAR(50) NOT NULL,
    discografica VARCHAR(25) NOT NULL,
    formato ENUM('vinilo', 'cd', 'dvd', 'mp3') NOT NULL,
    fechaLanzamiento DATE NOT NULL,
    fechaCompra DATE,
    precio DECIMAL(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla Canción
CREATE TABLE IF NOT EXISTS cancion (
    titulo VARCHAR(50) NOT NULL,
    album VARCHAR(7) NOT NULL,
    posicion INT(2) NOT NULL,
    duracion TIME NOT NULL,
    genero ENUM('Clásica', 'BSO', 'Blues', 'Electrónica', 'Jazz', 'Metal', 'Pop', 'Rock') NOT NULL,
    PRIMARY KEY (titulo, album),
    CONSTRAINT fk_cancion_album FOREIGN KEY (album) REFERENCES album(codigo) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Datos de ejemplo
INSERT INTO album (codigo, titulo, discografica, formato, fechaLanzamiento, fechaCompra, precio) VALUES
('ALB0001', 'Abbey Road', 'Apple Records', 'vinilo', '1969-09-26', '2023-01-15', 29.99),
('ALB0002', 'The Dark Side of the Moon', 'Harvest Records', 'cd', '1973-03-01', '2023-02-20', 15.99),
('ALB0003', 'Thriller', 'Epic Records', 'cd', '1982-11-30', '2023-03-10', 12.99);

INSERT INTO cancion (titulo, album, posicion, duracion, genero) VALUES
('Come Together', 'ALB0001', 1, '00:04:20', 'Rock'),
('Something', 'ALB0001', 2, '00:03:03', 'Rock'),
('Here Comes the Sun', 'ALB0001', 3, '00:03:05', 'Rock'),
('Speak to Me', 'ALB0002', 1, '00:01:13', 'Rock'),
('Breathe', 'ALB0002', 2, '00:02:43', 'Rock'),
('Time', 'ALB0002', 3, '00:06:53', 'Rock'),
('Wanna Be Startin Somethin', 'ALB0003', 1, '00:06:03', 'Pop'),
('Thriller', 'ALB0003', 2, '00:05:57', 'Pop'),
('Beat It', 'ALB0003', 3, '00:04:18', 'Pop');
