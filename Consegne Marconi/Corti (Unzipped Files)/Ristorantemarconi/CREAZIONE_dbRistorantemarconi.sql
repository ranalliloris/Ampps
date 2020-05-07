CREATE DATABASE IF NOT EXISTS RistoranteMarconi;

USE RistoranteMarconi;

CREATE TABLE IF NOT EXISTS PROVINCE (  
sigla VARCHAR(4) NOT NULL PRIMARY KEY,
provincia VARCHAR(50) NOT NULL, 
regione VARCHAR(30) NOT NULL
);


CREATE TABLE IF NOT EXISTS CANTINA ( 
id INT NOT NULL PRIMARY KEY,
nome VARCHAR(50) NOT NULL, 
provincia VARCHAR(4) NOT NULL,
CONSTRAINT provincia FOREIGN KEY (provincia) REFERENCES PROVINCE(sigla) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS VINO ( 
idVino INT NOT NULL PRIMARY KEY,
nomeVino VARCHAR(50) NOT NULL, 
tipoVino VARCHAR(6) NOT NULL, 
annata INT NOT NULL, 
idCantina INT NOT NULL,
CONSTRAINT idCantina FOREIGN KEY (idCantina) REFERENCES CANTINA(id) ON DELETE CASCADE ON UPDATE CASCADE
);


INSERT INTO PROVINCE VALUES 
("SI","Siena","Toscana"), 
("AV","Avellino","Campania"), 
("VR","Verona","Veneto"), 
("RA","Ravenna","Emilia Romagna"), 
("BS","Brescia","Lombardia"), 
("PE","Pescara","Abruzzo"), 
("CN","Cuneo","Piemonte"), 
("BZ","Bolzano","Trentino Alto Adige"), 
("GO","Gorizia","Friuli Venezia Giulia"), 
("AT","Asti","Piemonte"), 
("CT","Catania","Sicilia");


INSERT INTO CANTINA VALUES
(001,"Siro Pacenti","SI"), 
(002,"Piccariello","AV"),
(003,"Dal Forno Romano","VR"), 
(004,"Costa D'Archi","RA"), 
(005,"Bellavista","BS"), 
(006,"Valentini","PE"), 
(007,"Conterno","CN"), 
(008,"Mayr Josephus","BZ"), 
(009,"Gravner","GO"), 
(010,"Spinetta – Rivetti","AT"),
(011,"Tenuta delle Terre Nere","CT"), 
(012,"Radoer","BZ"), 
(013,"Lieselehof","BZ"), 
(014,"Allegrini","VR"),
(015,"Gottardi","BZ");


INSERT INTO VINO VALUES
(001,"Brunello di Montalcino", "Rosso",2014,001),
(002,"Irpinia Fiano","Bianco",2012,002), 
(003,"Amarone Riserva","Rosso",2000,003), 
(004,"Sangiovese di Romagna Assiolo","Rosso",2012,004),
(005,"Franciacorta Cuvée Sigillo Teatro alla Scala","Bianco",2000,005), 
(006,"Trebbiano d' Abruzzo","Bianco",2001,006),
(007,"Barolo Cascina Francia","Rosso",2007,007),
(008,"Lamarein","Rosso",2005,008), 
(009,"Ribolla Gialla","Bianco",2,009),
(010,"Barbaresco Starderi","Rosso",2004,010), 
(011,"Etna Guardiola","Rosso",2006,011), 
(012,"Kerner","Bianco",2012,012), 
(013,"Gewurztraminer","Bianco",2013,013),
(014,"La Poja","Rosso",2000,014),
(015,"Pinot Nero riserva","Rosso",2004,015);



