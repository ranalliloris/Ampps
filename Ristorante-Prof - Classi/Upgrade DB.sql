USE ristorantemarconi;

CREATE TABLE IF NOT EXISTS UTENTE
(
    username VARCHAR(20) NOT NULL,
    password VARCHAR(15) NOT NULL,
    cognome VARCHAR(50) NOT NULL,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    indirizzo VARCHAR(50) NOT NULL,
    numeroCivico VARCHAR(10),
    cap CHAR(5),
    citta VARCHAR(20) NOT NULL,
    provincia CHAR(2) NOT NULL,
    PRIMARY KEY(username)
);

CREATE TABLE IF NOT EXISTS CARRELLO
(
    idCarrello INT NOT NULL AUTO_INCREMENT, 
    username VARCHAR(20) NOT NULL,
    idVino INT(11) NOT NULL,
    ora TIME NOT NULL,
    data DATE NOT NULL,
    PRIMARY KEY(idCarrello),
    CONSTRAINT idVino FOREIGN KEY(idVino) REFERENCES VINO(idVino)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
    CONSTRAINT username FOREIGN KEY(username) REFERENCES UTENTE(username)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);
