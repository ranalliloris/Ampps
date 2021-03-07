#COMMENTO
/*
COMMENTO MULTILINEA
*/

#CREAZIONE DEL DB (STEP 1)
CREATE DATABASE IF NOT EXISTS archiviofotografico; 
            #IF NOT EXISTS quando si esegue più volte lo script sql
            #evita di creare il database se già presente

#UTILIZZO DEL DB (STEP 2)
USE archiviofotografico;   #Tutto quello che è indicato sotto
                            #viene eseguito nel database indicato dopo USE

#CREAZIONE DELLE TABELLE (STEP 3)



#Luogo(Cod_luogo(PK), città, descrizione)
CREATE TABLE IF NOT EXISTS luogo
(
    #dichiarazione di tutti i campi della tabella
    cod_luogo VARCHAR(10) NOT NULL,
    citta VARCHAR(20) NOT NULL,
    descrizione VARCHAR(300),

    #Definizione della PK e delle eventuali FK
    PRIMARY KEY(cod_luogo)      #PRIMARY KEY(KEY1, KEY2, ...)
); #fine istruzione di creazione tabella

#Sede(indirizzo(PK), responsabile, orario, numero_telefonico)

CREATE TABLE IF NOT EXISTS sede
(
    indirizzo VARCHAR(30) NOT NULL,
    responsabile VARCHAR(30) NOT NULL,
    orario TIME NOT NULL,
    numero_telefonico VARCHAR(15) NOT NULL,
    PRIMARY KEY(indirizzo)
);

#Foto(Cod_foto(PK), dimensione, conservazione, tipo_stampa, colore, indirizzo(FK))
#indirizzo references Sede

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
);

#Descrizione(Cod_luogo(PK)(FK), Cod_foto(PK)(FK))	
#	Cod_luogo references Luogo
#	Cod_foto references Foto

CREATE TABLE IF NOT EXISTS descrizione
(
    cod_luogo VARCHAR(10) NOT NULL,
    cod_foto VARCHAR(24) NOT NULL,

    PRIMARY KEY(cod_luogo,cod_foto),
    FOREIGN KEY(cod_luogo) REFERENCES luogo(cod_luogo),
    FOREIGN KEY(cod_foto) REFERENCES foto(cod_foto)
);

#Artista(Cod_personaggio(PK), nome, sesso, data_nascita, data_morte, attività)
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

#Descrizione_artista(Cod_artista(PK)(FK), Cod_foto(PK)(FK))
#	Cod_artista references Artista
CREATE TABLE IF NOT EXISTS descrizione_artista
(
    cod_artista VARCHAR(10) NOT NULL,
    cod_foto VARCHAR(24) NOT NULL,
    PRIMARY KEY(cod_artista, cod_foto),
    FOREIGN KEY (cod_artista) REFERENCES artista(cod_personaggio),
    FOREIGN KEY (cod_foto) REFERENCES foto(cod_foto)
);

#Sportivo(Cod_personaggio(PK), nome, sesso, data_nascita, 
#data_morte, squadra, sport)
CREATE TABLE IF NOT EXISTS sportivo
(
    cod_personaggio VARCHAR(10) NOT NULL,
    nominativo VARCHAR(15) NOT NULL,
    sesso CHAR NOT NULL,
    data_nascita DATE NOT NULL,
    data_morte DATE,
    squadra VARCHAR(20),
    sport VARCHAR(20) NOT NULL,

    PRIMARY KEY(cod_personaggio)
); 


#Descrizione_sportivo(Cod_sportivo(PK)(FK), Cod_foto(PK)(FK))
#	Cod_sportivo references Sportivo
#	Cod_foto references Foto
CREATE TABLE IF NOT EXISTS descrizione_sportivo
(
    cod_sportivo VARCHAR(10) NOT NULL,
    cod_foto VARCHAR(24) NOT NULL,
    PRIMARY KEY(cod_sportivo, cod_foto),
    FOREIGN KEY (cod_sportivo) REFERENCES sportivo(cod_personaggio),
    FOREIGN KEY (cod_foto) REFERENCES foto(cod_foto)
);

#Politico(Cod_personaggio(PK), nome, sesso, data_nascita, data_morte, 
#partito, periodo_appartenenza)
CREATE TABLE IF NOT EXISTS politico
(
    cod_personaggio VARCHAR(10) NOT NULL,
    nominativo VARCHAR(15) NOT NULL,
    sesso CHAR NOT NULL,
    data_nascita DATE NOT NULL,
    data_morte DATE,
    partito VARCHAR(20) NOT NULL,
    periodo_appartenenza VARCHAR(40) NOT NULL,
    PRIMARY KEY(cod_personaggio)
); 

#Descrizione_politico(Cod_politico(PK)(FK), Cod_foto(PK)(FK))
#	Cod_politico references Politico
#	Cod_foto references Foto
CREATE TABLE IF NOT EXISTS descrizione_politico
(
    cod_politico VARCHAR(10) NOT NULL,
    cod_foto VARCHAR(24) NOT NULL,
    PRIMARY KEY(cod_politico, cod_foto),
    FOREIGN KEY (cod_politico) REFERENCES politico(cod_personaggio),
    FOREIGN KEY (cod_foto) REFERENCES foto(cod_foto)
);


