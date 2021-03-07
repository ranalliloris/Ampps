 CREATE DATABASE IF NOT EXISTS futurelabs; 
        
USE futurelabs;   



 CREATE TABLE IF NOT EXISTS persona
 (
     cf VARCHAR(16) NOT NULL,
     cognome VARCHAR(60) NOT NULL,
     nome VARCHAR(60) NOT NULL,
     email VARCHAR(60) NOT NULL,
     cellulare VARCHAR(15),
     materia_insegnamento VARCHAR(60) NOT NULL,
     classe_concorso VARCHAR(30) NOT NULL,
     istituto VARCHAR(60) NOT NULL,
     meccanografico VARCHAR(11) NOT NULL,
     PRIMARY KEY(cf)
 );
 
 CREATE TABLE IF NOT EXISTS corso
 (
     cod_corso VARCHAR(20) NOT NULL,
     nome VARCHAR(100) NOT NULL,
     max_partecipanti INT NOT NULL,
     PRIMARY KEY(cod_corso)     
 );
 
 CREATE TABLE IF NOT EXISTS iscrizione
 (
     cf VARCHAR(16) NOT NULL,
     cod_corso VARCHAR(20) NOT NULL,
     data_iscrizione DATE NOT NULL,
     PRIMARY KEY(cf, cod_corso),
     constraint cf_iscrizione FOREIGN KEY(cf) REFERENCES persona(cf) ON DELETE CASCADE ON UPDATE CASCADE,
     constraint cod_corso_iscrizione FOREIGN KEY(cod_corso) REFERENCES corso(cod_corso) ON DELETE CASCADE ON UPDATE CASCADE
 );


CREATE TABLE IF NOT EXISTS utente
(
    username VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL,
    cognome VARCHAR(30) NOT NULL,
    nome VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    ruolo VARCHAR(30),
    PRIMARY KEY(username)
);
