CREATE TABLE Propietarios (
    ci VARCHAR(15) PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    telefono VARCHAR(15),
    rol ENUM('propietario', 'funcionario') DEFAULT 'propietario' NOT NULL
);

CREATE TABLE Catastro (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    ci VARCHAR(15),
    zona VARCHAR(50) NOT NULL,
    area DECIMAL(10, 2) NOT NULL,
    Xini DECIMAL(10, 2),
    Yini DECIMAL(10, 2),
    Xfin DECIMAL(10, 2),
    Yfin DECIMAL(10, 2),
    codigo_catastral INT,
    FOREIGN KEY (ci) REFERENCES Propietarios(ci)
);
