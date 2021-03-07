#archivio-fotografico-popolamento.sql
USE archiviofotografico;

/*#1° MODO
INSERT INTO luogo (citta, cod_luogo, descrizione)
VALUES 
('FIRENZE','50127_FI','IIS L.Da Vinci'),
('ROMA','872781_RO','Colosseo');

#2° MODO 
INSERT INTO sede
VALUES ('Via del Terzolle, 91','Ranalli Loris','09:00:00','33401826347');

#3° MODO
INSERT INTO foto SET
cod_foto='A1234',
dimensione='1920x960',
conservazione= 'BUONO',
tipo_stampa=null,
colore=false,
indirizzo='Via del Terzolle, 91';
*/

/*CREATE TABLE IF NOT EXISTS luogo
(
    #dichiarazione di tutti i campi della tabella
    cod_luogo VARCHAR(10) NOT NULL,
    citta VARCHAR(20) NOT NULL,
    descrizione VARCHAR(300),

    #Definizione della PK e delle eventuali FK
    PRIMARY KEY(cod_luogo)      #PRIMARY KEY(KEY1, KEY2, ...)
);*/
INSERT luogo(cod_luogo, citta, descrizione)
VALUES
('RM_0081_1',"ROMA","Piazza San Pietro"),
('PI_55023_2',"PISA","Torre di Pisa");


/*
CREATE TABLE IF NOT EXISTS sede
(
    indirizzo VARCHAR(30) NOT NULL,
    responsabile VARCHAR(30) NOT NULL,
    orario TIME NOT NULL,
    numero_telefonico VARCHAR(15) NOT NULL,
    PRIMARY KEY(indirizzo)
);*/
# aaaa-mm-gg
INSERT sede (indirizzo, responsabile, orario, numero_telefonico)
VALUES
("Via Ranalli","Ranalli Loris","9:00:00","3263517282"),
("Via Piemontese","Piemontese Marilina", "8:30:00","3");


/*
CREATE TABLE IF NOT EXISTS artista
(
    cod_personaggio VARCHAR(10) NOT NULL,
    nominativo VARCHAR(15) NOT NULL,
    sesso CHAR NOT NULL,
    data_nascita DATE NOT NULL,
    data_morte DATE,
    attivita VARCHAR(20) NOT NULL,

    PRIMARY KEY(cod_personaggio)
);
*/

INSERT artista(cod_personaggio,nominativo,sesso,data_nascita,data_morte,attivita)
VALUES
("GV1923","GIUSEPPE VERDI","M","1896-01-12","1935-06-23","MUSICISTA"),
("EN17283","EMILIANO NUTI","M","1896-01-12","1935-06-23","CASINISTA");


/*
CREATE TABLE IF NOT EXISTS foto
(
    cod_foto VARCHAR(24) NOT NULL,
    dimensione VARCHAR(20) NOT NULL,
    conservazione VARCHAR(10) NOT NULL,
    tipo_stampa VARCHAR(6),
    colore BOOLEAN NOT NULL,
    indirizzo VARCHAR(30) NOT NULL,

    PRIMARY KEY(cod_foto),
    FOREIGN KEY(indirizzo) REFERENCES sede(indirizzo)
    #UNA RIGA FOREIGN KEY PER OGNI CHIAVE ESTERNA   
);*/

INSERT INTO foto(cod_foto, dimensione, conservazione, tipo_stampa, colore, indirizzo)
VALUES
("FCOL32","1024x1080","buono","opaco",TRUE,"Via Ranalli"),
("FBN31","2048X1325","precario",null,FALSE,"Via Piemontese"),
("FBN30","2048X1325","ottimo",null,FALSE,"Via Ranalli");

/*INSERIRE ALMENO DUE RIGHE DI VALORI PER OGNI TABELLA DEL DATABASE archivio-fotografico*/















