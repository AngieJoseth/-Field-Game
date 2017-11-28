CREATE DATABASE FIELDGAME DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE FIELDGAME;

CREATE TABLE Jugador(
	idJugador INT NOT NULL AUTO_INCREMENT,
    idDatos INT NULL,
    nombre VARCHAR(225) NULL,
    PRIMARY KEY (idJugador));
    
CREATE TABLE DatosJugador(
	idDatos INT NOT NULL AUTO_INCREMENT,
    clave BLOB NULL,
    tiempo TIME,
    PRIMARY KEY (idDatos));
    
CREATE TABLE Palabra(
	idPalabra INT NOT NULL AUTO_INCREMENT,
    palabra VARCHAR(225) NULL,
    valor  INT NULL,
    PRIMARY KEY(idPalabra));

CREATE TABLE Nivel(
	idNivel INT NOT NULL AUTO_INCREMENT,
    descripcion VARCHAR(225) NULL,
	PRIMARY KEY (idNivel));
	    
 CREATE TABLE PalabrasResueltas(
	idPalaResuelta INT NOT NULL AUTO_INCREMENT,
    idJugador INT NULL,
    idPalabra INT NULL,    
    PRIMARY KEY (idPalaResuelta));

CREATE TABLE PalabrasNivel(
	idPalaNivel INT NOT NULL AUTO_INCREMENT,
    idPalabra INT NULL,
    idNivel INT NULL,
    PRIMARY KEY (idPalaNivel));

ALTER TABLE PalabrasResueltas ADD CONSTRAINT R_1 FOREIGN KEY (idJugador) REFERENCES Jugador (idJugador);
ALTER TABLE PalabrasResueltas ADD constraint R_2 FOREIGN KEY (idPalabra) REFERENCES Palabra (idPalabra);
ALTER TABLE PalabrasNivel ADD CONSTRAINT R_3 FOREIGN KEY (idPalabra) REFERENCES Palabra (idPalabra);
ALTER TABLE PalabrasNivel ADD CONSTRAINT R_4 FOREIGN KEY (idNivel) REFERENCES Nivel (idNivel);
ALTER TABLE Jugador ADD CONSTRAINT R_5 FOREIGN KEY (idDatos) REFERENCES DatosJugador (idDatos);