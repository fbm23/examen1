CREATE TABLE Distritos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

CREATE TABLE Zonas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    distrito_id INT,
    FOREIGN KEY (distrito_id) REFERENCES Distritos(id)
);

-- Insertar distritos
INSERT INTO Distritos (nombre) VALUES ('Distrito 1'), ('Distrito 2'), ('Distrito 3');

-- Insertar zonas
INSERT INTO Zonas (nombre, distrito_id) VALUES 
('Zona A', 1), 
('Zona B', 1), 
('Zona C', 2), 
('Zona D', 2), 
('Zona E', 3);