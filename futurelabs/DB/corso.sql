-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: 31.11.39.30
-- Generato il: Gen 16, 2021 alle 18:34
-- Versione del server: 5.7.32-3-log
-- Versione PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Sql1509550_1`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `corso`
--

CREATE TABLE IF NOT EXISTS `corso` (
  `cod_corso` varchar(20) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `max_partecipanti` int(11) NOT NULL,
  PRIMARY KEY (`cod_corso`),
  KEY `cod_corso` (`cod_corso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `corso`
--

INSERT INTO `corso` (`cod_corso`, `nome`, `max_partecipanti`) VALUES
('FLAVVR01', 'AV_VR Gruppo 1 (A2)', 3),
('FLAVVR02', 'AV_VR Gruppo 2 (A2)', 3),
('FLAVVR03', 'AV_VR Gruppo 3 (B1)', 3),
('FLAVVR04', 'AV_VR Gruppo 4 (B1)', 3),
('FLAVVR05', 'AV_VR Gruppo 5 (B2)', 3),
('FLAVVR06', 'AV_VR Gruppo 6 (B2)', 3),
('FLBES01', 'App e ICT per BES Gruppo 1 (A2)', 3),
('FLBES02', 'App e ICT per BES Gruppo 2 (A2)', 3),
('FLBES03', 'App e ICT per BES Gruppo 3', 3),
('FLBES04', 'App e ICT per BES Gruppo 4', 3),
('FLBES05', 'App e ICT per BES Gruppo 5', 3),
('FLBES06', 'App e ICT per BES Gruppo 6', 3),
('FLCOD01', 'Coding e Robotica Gruppo 1 (A2)', 3),
('FLCOD02\n', 'Coding e Robotica Gruppo 2 (A2)', 3),
('FLCOD03\n', 'Coding e robotica Gruppo 3 (B1)\n\n', 3),
('FLCOD04\n', 'Coding e robotica Gruppo 4 (B2)\n', 3),
('FLCOD05', 'Coding e robotica Gruppo 5', 3),
('FLCOD06', 'Coding e robotica Gruppo 6', 3),
('FLCOOP01', 'Cooperative Learning Gruppo 1 (A2)', 3),
('FLCOOP02', 'Cooperative Learning Gruppo 2 (A2)', 3),
('FLCOOP03', 'Cooperative Learning Gruppo 3', 3),
('FLCOOP04', 'Cooperative Learning Gruppo 4', 3),
('FLCOOP05', 'Cooperative Learning Gruppo 5', 3),
('FLCOOP06', 'Cooperative Learning Gruppo 6', 3),
('FLGAME01', 'Gamification Gruppo 1 (A2)', 3),
('FLGAME02', 'Gamification Gruppo 2 (A2)', 3),
('FLGAME03', 'Gamification Gruppo 3 (B1)', 3),
('FLGAME04', 'Gamification Gruppo 4 (B1)', 3),
('FLGAME05', 'Gamification Gruppo 5', 3),
('FLGAME06', 'Gamification Gruppo 6', 3),
('FLSTEAM01', 'STEAM Gruppo 1 (A2)', 3),
('FLSTEAM02', 'STEAM Gruppo 2 (A2)', 3),
('FLSTEAM03', 'STEAM Gruppo 3', 3),
('FLSTEAM04', 'STEAM Gruppo 4', 3),
('FLSTEAM05', 'STEAM Gruppo 5', 3),
('FLSTEAM06', 'STEAM Gruppo 6', 3),
('FLSTEM01', 'STEM Gruppo 1 (A2)', 3),
('FLSTEM02', 'STEM Gruppo 2 (A2)', 3),
('FLSTEM03', 'STEM Gruppo 3', 3),
('FLSTEM04', 'STEM Gruppo 4', 3),
('FLSTEM05', 'STEM Gruppo 5', 3),
('FLSTEM06', 'STEM Gruppo 6', 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
