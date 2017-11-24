CREATE DATABASE FieldGame1 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE FieldGame1;

CREATE TABLE Jugadores (
    id_Jugador INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(255) NULL,
    clave BLOB NULL,
    PRIMARY KEY (id_Jugador)
);
    

CREATE TABLE Nivel(
	id_nivel INT NOT NULL AUTO_INCREMENT,
    descripcionivel VARCHAR (244) NULL,
    PRIMARY KEY (id_nivel)
    
);


CREATE TABLE Palabras1(
	id_Palabras INT NOT NULL AUTO_INCREMENT,
    palabra VARCHAR (255) NULL,
    valor INT,
    PRIMARY KEY (id_Palabras)
);

CREATE TABLE PalabrasResueltas1(
	id_PalabrasResueltas INT NOT NULL AUTO_INCREMENT,
	tiempo TIME,
    id_Palabras INT NULL ,
    id_Jugador INT NULL,
    PRIMARY KEY (id_PalabrasResueltas),
	FOREIGN KEY (id_Palabras) REFERENCES Palabras1(id_Palabras),
    FOREIGN KEY (id_Jugador) REFERENCES Jugadores(id_Jugador)
);

CREATE TABLE PalabraNivel1(
	id_PalabraNivel INT NOT NULL AUTO_INCREMENT,
    id_Palabras INT NULL,
    id_nivel INT NULL,
    PRIMARY KEY (id_PalabraNivel),
    FOREIGN KEY (id_Palabras) REFERENCES Palabras1(id_Palabras),
    FOREIGN KEY (id_nivel) REFERENCES Nivel(id_nivel)
);
/*RELACIONAR DOS TABLAS */

INSERT INTO Jugador (nombre,clave) VALUES ('Martha', aes_encrypt('mi clave','SECRETO'));
INSERT INTO Jugador (nombre,clave) VALUES ('Maria', aes_encrypt('secreta','SECRETO'));
INSERT INTO Jugador (nombre,clave) VALUES ('Alena', aes_encrypt('mi ultra','SECRETO'));
INSERT INTO Jugador (nombre,clave) VALUES ('Micaela', aes_encrypt('mi clave ultra secreta','SECRETO'));
INSERT INTO Jugador (nombre,clave) VALUES ('James', aes_encrypt('mi clave secreta','SECRETO'));
INSERT INTO PalabrasResueltas(tiempo,id_Palabras,idJugador) VALUES ('00:00:00',1,1);
SELECT count(*) from Jugador;
SELECT count(*) from DatosJugador;


