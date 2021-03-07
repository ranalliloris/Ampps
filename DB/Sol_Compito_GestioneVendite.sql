CREATE DATABASE IF NOT EXISTS GestioneVendite;

USE GestioneVendite;

CREATE TABLE IF NOT EXISTS Aliquote
(
    ID_aliquota_IVA INT NOT NULL AUTO_INCREMENT,
    aliquota_perc FLOAT NOT NULL,
    descrizione_breve VARCHAR(100) NOT NULL,
    PRIMARY KEY(ID_aliquota_IVA)
);

CREATE TABLE IF NOT EXISTS Località
(
    ID_Località INT NOT NULL AUTO_INCREMENT,
    nome_località VARCHAR(30) NOT NULL,
    CAP VARCHAR(5) NOT NULL,
    Provincia VARCHAR(2) NOT NULL,
    PRIMARY KEY(ID_Località)
);

CREATE TABLE IF NOT EXISTS Articoli
(
    ID_Articolo INT NOT NULL AUTO_INCREMENT,
    descrizione VARCHAR(100) NOT NULL,
    prezzo_vendita FLOAT NOT NULL,
    prezzo_acquisto FLOAT NOT NULL,
    ID_aliquota_IVA INT NOT NULL,
    disponibilità INT NOT NULL,
    unità_di_misura INT NOT NULL,
    scorta_minima INT NOT NULL,
    quantità_riordino INT NOT NULL,
    CONSTRAINT articoli-pvendita CHECK (prezzo_vendita>100.00), /* VINCOLO INTRARELAZIONALE*/
    PRIMARY KEY(ID_Articolo), /* VINCOLO INTRARELAZIONALE*/
    CONSTRAINT  FOREIGN KEY (ID_aliquota_IVA) REFERENCES Aliquote(ID_aliquota_IVA) /* VINCOLO DI INTEGRITA' REFERENZIALE */
    
);

CREATE TABLE IF NOT EXISTS Clienti
(
    ID_cliente INT NOT NULL AUTO_INCREMENT,
    ragione_sociale VARCHAR (20) NOT NULL,
    indirizzo VARCHAR (40) NOT NULL,
    id_località INT NOT NULL,
    partita_iva VARCHAR (11) NOT NULL,
    fido FLOAT NOT NULL,
    telefono VARCHAR(12),
    fax VARCHAR(12),
    mail VARCHAR(40) NOT NULL,
    PRIMARY KEY(ID_cliente),
    FOREIGN KEY(id_località) REFERENCES Località(ID_Località)
);

CREATE TABLE IF NOT EXISTS Fatture
(
    n_fattura INT NOT NULL AUTO_INCREMENT,
    data_fattura DATE NOT NULL,
    id_cliente INT NOT NULL,
    PRIMARY KEY(n_fattura),
    FOREIGN KEY(id_cliente) REFERENCES Clienti(ID_cliente)

);

CREATE TABLE IF NOT EXISTS Righe
(
    n_fattura INT NOT NULL,
    id_articolo INT NOT NULL,
    quantità INT NOT NULL,
    PRIMARY KEY(n_fattura, id_articolo),
    CONSTRAINT righe-n_fattura FOREIGN KEY(n_fattura) REFERENCES Fatture(n_fattura) /**** no virgola ****/
    ON DELETE CASCADE /**** no virgola ****/
    ON UPDATE CASCADE,
    
    CONSTRAINT righe-id_articolo FOREIGN KEY(id_articolo) REFERENCES Articoli(ID_Articolo) 
    ON DELETE CASCADE 
    ON UPDATE SET NULL 
    
);
