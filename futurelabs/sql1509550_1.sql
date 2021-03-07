-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Gen 15, 2021 alle 09:56
-- Versione del server: 8.0.18
-- Versione PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sql1509550_1`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `corso`
--

CREATE TABLE `corso` (
  `cod_corso` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `max_partecipanti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `corso`
--

INSERT INTO `corso` (`cod_corso`, `nome`, `max_partecipanti`) VALUES
('FLCOD01', 'Coding', 3),
('FLROB01', 'Robotica', 3),
('FLSTEAM01', 'STEAM', 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `iscrizione`
--

CREATE TABLE `iscrizione` (
  `cf` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `cod_corso` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `data_iscrizione` date NOT NULL,
  `codice_iscrizione` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `iscrizione`
--

INSERT INTO `iscrizione` (`cf`, `cod_corso`, `data_iscrizione`, `codice_iscrizione`) VALUES
('bbbccc89t27eaaaa', 'FLCOD01', '2021-01-14', ''),
('rnllsm89t27e453u', 'FLCOD01', '2021-01-12', ''),
('rnllsm89t27e453u', 'FLROB01', '2021-01-06', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `persona`
--

CREATE TABLE `persona` (
  `cf` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `cognome` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `nome` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `cellulare` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `materia_insegnamento` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `classe_concorso` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `istituto` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `meccanografico` varchar(11) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `persona`
--

INSERT INTO `persona` (`cf`, `cognome`, `nome`, `email`, `cellulare`, `materia_insegnamento`, `classe_concorso`, `istituto`, `meccanografico`) VALUES
('bbbccc89t27eaaaa', 'PIEMONTESE', 'MARILINA', 'lorisranalli@isisdavinci.eu', '3494602940', 'Informatica', 'A041', 'IIS L. Da Vinci', 'FIIS01700A'),
('rnllsm89t27e453u', 'RANALLI', 'LORIS', 'lorisranalli@isisdavinci.eu', '3494602940', 'INFORMATICA', 'B016', 'IIS L. DA VINCI', 'FIIS01700A');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `username` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `cognome` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `nome` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `ruolo` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `corso`
--
ALTER TABLE `corso`
  ADD PRIMARY KEY (`cod_corso`);

--
-- Indici per le tabelle `iscrizione`
--
ALTER TABLE `iscrizione`
  ADD PRIMARY KEY (`cf`,`cod_corso`),
  ADD KEY `cod_corso_iscrizione` (`cod_corso`);

--
-- Indici per le tabelle `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`cf`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`username`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `iscrizione`
--
ALTER TABLE `iscrizione`
  ADD CONSTRAINT `cf_iscrizione` FOREIGN KEY (`cf`) REFERENCES `persona` (`cf`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cod_corso_iscrizione` FOREIGN KEY (`cod_corso`) REFERENCES `corso` (`cod_corso`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
