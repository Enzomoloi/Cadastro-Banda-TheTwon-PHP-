CREATE DATABASE TheTown;

USE TheTown;

CREATE TABLE musicas
(
	cod_musica INT NOT NULL AUTO_INCREMENT primary key,
	nome_musica VARCHAR(64) NOT NULL,
	durac_musica VARCHAR(64) NOT NULL,
	tipo_musica VARCHAR(64) NOT NULL,
	nome_banda VARCHAR(64) NOT NULL
	
);


CREATE TABLE artistas
(
	cod_artista INT NOT NULL AUTO_INCREMENT primary key,
	nome_artista VARCHAR(64) NOT NULL,
	email VARCHAR(64)NOT NULL,
	idade SMALLINT NOT NULL,
	sexo VARCHAR(1) NOT NULL,
	estadocivil VARCHAR(16) NOT NULL,
	nome_banda VARCHAR(64) NOT NULL
);


CREATE TABLE banda
(
	cod_banda INT NOT NULL AUTO_INCREMENT primary key,
	nome_banda VARCHAR(64) NOT NULL,
	DiaShow DATE NOT NULL,
	DuracaoShow TIME NOT NULL,
	HorarioShowInicio TIME NOT NULL,
	HorarioShowFinal TIME NOT NULL, 
	NomePalco VARCHAR(64)NOT NULL,
);


CREATE TABLE loguinho
(
	usuario VARCHAR(32) NOT NULL,
	senha VARCHAR(32) NOT NULL
);