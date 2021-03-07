-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: 89.46.111.209
-- Generato il: Lug 20, 2020 alle 14:16
-- Versione del server: 5.7.25-28-log
-- Versione PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Sql1449495_2`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `appuntamento`
--

CREATE TABLE IF NOT EXISTS `appuntamento` (
  `codice` varchar(30) NOT NULL,
  `data_app` date NOT NULL,
  `cf_stud` varchar(18) NOT NULL,
  `id_fascia` int(11) NOT NULL,
  PRIMARY KEY (`codice`),
  KEY `cf_stud` (`cf_stud`),
  KEY `id_fascia` (`id_fascia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `appuntamento`
--

INSERT INTO `appuntamento` (`codice`, `data_app`, `cf_stud`, `id_fascia`) VALUES
('00d297f3', '2020-07-08', 'MNFGAI06R42D612D', 1400),
('037f13f5', '2020-07-16', 'DGLMTT06C23D612D', 1645),
('068c7f36', '2020-07-03', 'SCTMNL05B24D612I', 1030),
('0c74781f', '2020-07-10', 'MBSHNT05SO5Z236A', 1130),
('0ded8c92', '2020-07-02', 'DNEJRA06R27A564E', 1445),
('0e7cc27c', '2020-07-06', 'RIOVNI06D16D612A', 1200),
('10287775', '2020-07-06', 'PCNVNI06P16D612X', 930),
('155eb2b3', '2020-07-09', 'MZZSML06M24B036N', 1030),
('159fb2fa', '2020-07-03', 'CLNNDR06R31D612L', 930),
('18b45aec', '2020-07-02', 'SCPFNC06A16A564S', 945),
('1b10e9fa', '2020-07-09', 'BTTFRC06E59G999R', 100),
('1c590453', '2020-07-13', 'STRCST06T27B036C', 1030),
('1ff41ae6', '2020-07-04', 'BNDLNZ06R31B036K', 915),
('22db88da', '2020-07-16', 'BLDGRL06P19D612V', 1530),
('264826a3', '2020-07-02', 'MNZSLV06C01B791G', 930),
('26675523', '2020-07-01', 'CMPDRD06S15D612N', 1530),
('284324cd', '2020-07-16', 'ZGHLNZ06B23G713T', 1730),
('2ec21d12', '2020-07-09', 'CCCLSNO6P05D61R', 1415),
('300e9728', '2020-07-02', 'RLNLRD06M16A564A', 1500),
('30d34d19', '2020-07-06', 'MGNGRL06D18G999E', 900),
('317a73a6', '2020-07-03', 'BLDMNL06B25D612D', 1100),
('32416131', '2020-07-24', 'CPCGDU06B25D612A', 1200),
('34de7571', '2020-07-22', 'CMMLRD06H18D612V', 1100),
('360b536e', '2020-07-20', 'CNNPRL06C47D612Z', 1300),
('36974f86', '2020-07-22', 'GLLSRA06P65D612F', 1745),
('36e0f4f6', '2020-07-01', 'SCRLSN06D14D423Z', 1100),
('3be7944a', '2020-07-04', 'CRBLSI06D54B036X', 915),
('3dfe80bc', '2020-07-04', 'BKCKVS05B21B036D', 1230),
('3edb69ca', '2020-07-06', 'BLNCRS07A19D612K', 1100),
('3f835099', '2020-07-01', 'GRNFRC06C10A564F', 100),
('440231a0', '2020-07-01', 'BDYRNB06R31D612D', 1115),
('468c7612', '2020-07-03', 'RGAMMD05H21D612T', 900),
('4c1c5535', '2020-07-03', 'CLLRMO06L26A564V', 900),
('4cc0ba50', '2020-07-11', 'CPNMTT06D06G999P', 900),
('4ed175b2', '2020-07-06', 'GNNTMS06D39B036E', 1300),
('503b7b9c', '2020-07-16', 'BRSGRL06M16D612P', 100),
('50d8d6c6', '2020-07-13', 'CRPSFO06A70A564K', 930),
('50dcc78f', '2020-07-04', 'PPLDGI06T23B036U', 1100),
('53b475e1', '2020-07-02', 'LOIPTR06B15A564C', 900),
('58dde053', '2020-07-02', 'BNDVNT06R31D612S', 1445),
('5df8b095', '2020-07-16', 'TNRGVR06S56B036X', 1745),
('5f9b6b95', '2020-07-06', 'CMPSRG06RO7B036A', 930),
('5fc31360', '2020-07-09', 'MRTMRG06A69D612E', 1700),
('668f07fe', '2020-07-08', 'MRLFNC06S26D612W', 100),
('68b3514f', '2020-07-02', 'BTTGRL06H05I158X', 1130),
('6a82f569', '2020-07-06', 'PRIDLY06T30A564T', 900),
('6db02ea3', '2020-07-10', 'LNCLNZ06P03D612P', 100),
('72010f9a', '2020-07-16', 'RRGHFPP06A12D612', 1645),
('7231c098', '2020-07-02', 'MRGMCS06R17612M', 1645),
('72d48c22', '2020-07-11', 'GDTLSS05T30D612R', 900),
('7454c32f', '2020-07-01', 'BUANTN06M03D612N', 945),
('76186b52', '2020-07-01', 'MGLSRI06P60D612Z', 900),
('77c0e2c6', '2020-07-06', 'CMRLRD06R22D612P', 915),
('78ec18f0', '2020-07-24', 'FCCTSE06A24D612U', 1130),
('7aad8874', '2020-07-01', 'MSTLNZ05D18G999O', 1100),
('7ba76adb', '2020-07-22', 'NRELNZ06E12D612S', 1600),
('7ed67e1d', '2020-07-08', 'CRTFRC06S21A564W', 1430),
('7f0283ed', '2020-07-11', 'SCRRCC06L15B036N', 100),
('82a73107', '2020-07-10', 'MNLFPP06P03Z154K', 945),
('85429f0e', '2020-07-02', 'NNNRRT06T20A564T', 1030),
('871c44d8', '2020-07-09', 'CCTDDP06P01D612C', 1100),
('87b41247', '2020-07-01', 'DLGJLU06C61G999L', 945),
('8872b573', '2007-07-20', 'LSTCST06T59D612K', 1100),
('8b0053da', '2020-07-09', 'KHNYRR05R28Z249M', 900),
('8bef482d', '2020-07-04', 'BNCDRD06T13G999O', 900),
('8e2641a1', '2020-07-04', 'CRSLRD06L25D612C', 945),
('8e49fb21', '2020-07-20', 'NSTRRT06H20D612R', 1045),
('92c6bd4d', '2020-07-01', 'DMRSML06H29D612P', 1745),
('93d4e7f9', '2020-07-07', 'DNILPA07D02A564X', 1030),
('9473f152', '2020-07-01', 'LCURSB06H24A564L', 1530),
('9494c2d4', '2020-07-02', 'PSTLRD05C02A564X', 1630),
('94dbbb9d', '2020-07-04', 'PLTCSR06B17D612E', 930),
('980c2b30', '2020-07-01', 'PLLDNY06D12D612F', 900),
('9a6ce431', '2020-07-02', 'FLDCRS06D20D612W', 1630),
('9dd1b4c7', '2020-07-04', 'RDCLCU06B02D612K', 1045),
('9ebbd767', '2020-07-02', 'SPNSMN06C04A564P', 1100),
('9ff4beeb', '2020-07-02', 'ZNAGLI07B17D612B', 100),
('a0d2f170', '2020-07-03', 'LSHLLI04P15Z138B', 1300),
('a0f494af', '2020-07-15', 'PCCMSM06H22D612X', 1715),
('a147af0d', '2020-07-10', 'GSNLNZ06M16G999Z', 945),
('a3a7e9f4', '2020-07-01', 'MRTMLD06S69D612I', 1015),
('a4a2d453', '2020-07-03', 'LSMHRD06A67D612J', 1115),
('a5e5eeb4', '2020-07-02', 'NNCDGI06D17D612Q', 1045),
('a916f9b8', '2020-07-02', 'BHYMDL06S60Z249M', 915),
('b03cbd7c', '2020-07-11', 'CCCMLD06B47D403A', 100),
('b045b7b0', '2020-07-01', 'PSTMLN06T71C351C', 100),
('b0bdd728', '2020-07-03', 'PNNDTT06A55B036O', 915),
('b2311351', '2020-07-06', 'SREDRD06P13A564U', 1015),
('b6afb3a9', '2020-07-06', 'LKHZKR06D16D612Z', 1100),
('b8a0db40', '2020-07-06', 'LNVLRD06L25D403Q', 915),
('b8a0f461', '2020-07-01', 'HSALND06P18Z100W', 915),
('bb63447d', '2020-07-07', 'GRNNDR06B06D612F', 930),
('bba81ebb', '2020-07-04', 'CMNCST06D13D612M', 900),
('bdd917ab', '2020-07-08', 'HJDSBN06A20D612V', 930),
('be30c2fa', '2020-07-01', 'ZHASFN05H19D612O', 1200),
('c3f99082', '2020-07-16', 'CPRLPA06S22D403J', 1600),
('c60fa00c', '2020-07-04', 'DCRCRS06C24D612O', 1100),
('c752cb93', '2020-07-07', 'MGEMTT05M20D612Z', 100),
('c9bb03ff', '2020-07-01', 'SVRNDR06R11D612O', 930),
('ca2402b9', '2020-07-11', 'LVITMS06R24B036P', 1145),
('cbbfeb1a', '2020-07-07', 'TRLTMS06A01D612S', 900),
('ce2438dc', '2020-07-01', 'CRCTMS06L05D612A', 930),
('ce9d846b', '2020-07-03', 'ZHASFN05H19D612O', 1200),
('cfb2ddfa', '2020-07-15', 'MZZGVR06L47D612Z', 1430),
('cfd5ade8', '2020-07-02', 'SNTSFN06B15D612Y', 1745),
('d72735ce', '2020-07-02', 'MZZLNZ06L21A564H', 1030),
('de7c7d17', '2020-07-03', 'VLTNDR06E19A564I', 1200),
('e1647ff3', '2020-07-17', 'BRGMTT06M17D612O', 1030),
('e3d11610', '2020-07-07', 'DNGMTT06B15D612V', 930),
('e56855f1', '2020-07-09', 'PLLRCR07C14D612A', 1715),
('e5928d17', '2020-07-02', 'RCNLNZ06M19Z140H', 100),
('e73125ec', '2020-07-07', 'CSCDGI06H29D612V', 1030),
('e774420d', '2020-07-10', 'LCHNTH06D27Z208J', 1130),
('f3cc2892', '2020-07-10', 'PRSLSN06P17A564U', 930),
('f7ca7616', '2020-07-07', 'CRMLRD06L27D612M', 1215),
('f8f5626f', '2020-07-07', 'SRFGLI06B11D612O', 900),
('fa47c4d8', '2020-07-04', 'SPGNDR06C18A564J', 930),
('fc761398', '2020-07-15', 'HUXNDR06R27G999I', 930),
('fd0b8ada', '2020-07-02', 'STTNRC05P08Z129O', 1100),
('ffe83e94', '2020-07-02', 'MNSMTT06S29A564C', 900);

-- --------------------------------------------------------

--
-- Struttura della tabella `fasciaoraria`
--

CREATE TABLE IF NOT EXISTS `fasciaoraria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ora_inizio` time NOT NULL,
  `ora_fine` time NOT NULL,
  `meridian` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1746 ;

--
-- Dump dei dati per la tabella `fasciaoraria`
--

INSERT INTO `fasciaoraria` (`id`, `ora_inizio`, `ora_fine`, `meridian`) VALUES
(100, '10:00:00', '10:15:00', 'am'),
(900, '09:00:00', '09:15:00', 'am'),
(915, '09:15:00', '09:30:00', 'am'),
(930, '09:30:00', '09:45:00', 'am'),
(945, '09:45:00', '10:00:00', 'am'),
(1015, '10:15:00', '10:30:00', 'am'),
(1030, '10:30:00', '10:45:00', 'am'),
(1045, '10:45:00', '11:00:00', 'am'),
(1100, '11:00:00', '11:15:00', 'am'),
(1115, '11:15:00', '11:30:00', 'am'),
(1130, '11:30:00', '11:45:00', 'am'),
(1145, '11:45:00', '12:00:00', 'am'),
(1200, '12:00:00', '12:15:00', 'am'),
(1215, '12:15:00', '12:30:00', 'am'),
(1230, '12:30:00', '12:45:00', 'am'),
(1245, '12:45:00', '13:00:00', 'am'),
(1300, '13:00:00', '13:15:00', 'am'),
(1400, '14:00:00', '14:15:00', 'pm'),
(1415, '14:15:00', '14:30:00', 'pm'),
(1430, '14:30:00', '14:45:00', 'pm'),
(1445, '14:45:00', '15:00:00', 'pm'),
(1500, '15:00:00', '15:15:00', 'pm'),
(1515, '15:15:00', '15:30:00', 'pm'),
(1530, '15:30:00', '15:45:00', 'pm'),
(1545, '15:45:00', '16:00:00', 'pm'),
(1600, '16:00:00', '16:15:00', 'pm'),
(1615, '16:15:00', '16:30:00', 'pm'),
(1630, '16:30:00', '16:45:00', 'pm'),
(1645, '16:45:00', '17:00:00', 'pm'),
(1700, '17:00:00', '17:15:00', 'pm'),
(1715, '17:15:00', '17:30:00', 'pm'),
(1730, '17:30:00', '17:45:00', 'pm'),
(1745, '17:45:00', '18:00:00', 'pm');

-- --------------------------------------------------------

--
-- Struttura della tabella `studente`
--

CREATE TABLE IF NOT EXISTS `studente` (
  `cf_stud` varchar(18) NOT NULL,
  `cognome_stud` varchar(80) NOT NULL,
  `nome_stud` varchar(80) NOT NULL,
  `cognome_gen` varchar(80) NOT NULL,
  `nome_gen` varchar(80) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cellulare` varchar(15) NOT NULL,
  PRIMARY KEY (`cf_stud`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `studente`
--

INSERT INTO `studente` (`cf_stud`, `cognome_stud`, `nome_stud`, `cognome_gen`, `nome_gen`, `email`, `cellulare`) VALUES
('BDYRNB06R31D612D', 'BAIDYA', 'ARNOB', 'BAIDYA', 'PRADIP KUMAR ', 'baidyababa@hotmail.it', '3480334637'),
('BHYMDL06S60Z249M', 'BHUIYAN ', 'MRIDULA ', 'MASUD', 'BHUIYAN', 'masudbhuiyan34@gmail.com', '3287048337'),
('BKCKVS05B21B036D', 'BUKACI', 'KLEVIS', 'PRENDI', 'LINDITA', 'l.prendi@outlook.it', '3279824250'),
('BLDGRL06P19D612V', 'BALDACCI', 'GABRIEL', 'STRIANESE', 'VINCENZA', 'vincenzastrianese80@libero.it', '3480991181'),
('BLDMNL06B25D612D', 'BALDINI', 'MANUEL', 'BALDINI', 'ALBERTO ', 'abogiordy2013@gmail.com', '3291068993'),
('BLNCRS07A19D612K', 'BLANDINO', 'CHRISTIAN ', 'NICCOLI ', 'SABRINA', 'niccolisabrina@libero.it', '3338042047'),
('BNCDRD06T13G999O', 'BONCONPAGNI ', 'EDOARDO ', 'BRANCA ', 'ELISA', 'elisabranca1973@gmail.com', '3384321247'),
('BNDLNZ06R31B036K', 'BANDINI', 'LORENZO', 'CLAUDI', 'LAURA', 'minumetsnc@libero.it', '3495422554'),
('BNDVNT06R31D612S', 'BENEDETTI', 'VALENTINO', 'BERLINCIONI', 'BEATRICE', 'beatriceberlincioni@gmail.com', '3383819785'),
('BRGMTT06M17D612O', 'BRAGGIOTTI', 'MATTEO', 'CECCHI', 'BARBARA', 'barbaracecchi77@gmail.com', '3288420488'),
('BRSGRL06M16D612P', 'BARSOTTI', 'GABRIELE', 'ORSI', 'GIADA', 'giadaorsi.14@gmail.com', '3663682313'),
('BTTFRC06E59G999R', 'BETTAZZI ', 'FEDERICA ', 'MATI', 'ILARIA ', 'ilariamati@libero.it', '392 2352215 '),
('BTTGRL06H05I158X', 'BOTTALICO', 'GABRIELE', 'DI LULLO ', 'MARIATERESA', 'dilullo2@alice.it', '3807926959'),
('BUANTN06M03D612N', 'BUA', 'ANTONIO', 'BUA', 'LEONARDO', 'info@leonardobua.it', '3295971241'),
('CCCLSNO6P05D61R', 'CECCHI', 'ALESSANDRO', 'TOZZI', 'ILARIA', 'ilariatozzi73@gmail.com', '3384628147'),
('CCCMLD06B47D403A', 'CECCHI', 'MATILDE', 'GENNAI', 'MANUELA', 'manuela.gennai@gmail.com', '3395374467'),
('CCTDDP06P01D612C', 'CICATELLI', 'DAVIDE PIO ', 'PARATORE', 'LUISA', 'luisaparatore5@gmail.com', '3333825285'),
('CLLRMO06L26A564V', 'CELLAI', 'ROMEO ', 'CASALI', 'CHIARA', 'chiaracasali71@gmail.com', '3384579787'),
('CLNNDR06R31D612L', 'CALONE', 'ANDREA', 'CICCARELLI', 'VALERIA', 'ciccarelli-valeria@alice.it', '3335871804'),
('CMMLRD06H18D612V', 'CIMMINO', 'LEONARDO', 'CIARELLA', 'CARMINA', 'D4n1l4@libero.it', '3208968181'),
('CMNCST06D13D612M', 'CIMINELLI', 'CRISTIAN', 'PECCHIOLI', 'ANNAMARIA', 'annamaria.pecchioli@gmail.com', '3477692610'),
('CMPDRD06S15D612N', 'COMPARINI', 'EDOARDO', 'CIRINEI', 'SARA', 'sara.cirinei@gmail.com', '3338342762'),
('CMPSRG06RO7B036A', 'COMPARINI', 'OSCAR GABRIEL', 'RÃ–NNFELDT', 'STEPHANIE', 'st.ronnfeldt@gmail.com', '3498124875'),
('CMRLRD06R22D612P', 'CAMERANO', 'LEONARDO', 'CHIARLITTI', 'SABRINA', 'sabrinachiarlitti1@gmail.com', '3292828909'),
('CNNPRL06C47D612Z', 'CANNONE', 'PERLA', 'CANNONE', 'DOMENICO', 'zorbas17 gmail.com', '3472611248'),
('CPCGDU06B25D612A', 'CAPECCHI', 'GUIDO', 'CHERICI', 'BARBARA', 'barbara.cherici@pec.it', '+393477116290'),
('CPNMTT06D06G999P', 'CIAPINI', 'MATTEO', 'GORI', 'STEFANIA', 'stefygorina1975@gmail.com', '3884004097'),
('CPRLPA06S22D403J', 'CIPRIANI', 'LAPO', 'MALINCONI', 'BARBARA', 'malinconi2017@gmail.com', '3389225925'),
('CRBLSI06D54B036X', 'CERBAI', 'LISA', 'GALLORINI ', 'LAURA', 'laurg69@alice.it', '3335662597'),
('CRCTMS06L05D612A', 'CARACCI ', 'TOMMASO', 'CRIVELLARI ', 'DENISE ', 'denisecrivellari@yahoo.it', '3471277082'),
('CRMLRD06L27D612M', 'CARMIGNANI', 'LEONARDO', 'CARMIGNANI', 'ROBERTO', 'roberto.carmignani@virgilio.it', '3393937979'),
('CRPSFO06A70A564K', 'CARPINELLI', 'SOFIA', 'FANFANI', 'SERENA', 'tonicarpi@hotmail.it', '3384137353'),
('CRSLRD06L25D612C', 'CORSI', 'LEONARDO ', 'CORSI ', 'STEFANO', 'stefanocorsi36@gmail.com', '3382859096'),
('CRTFRC06S21A564W', 'CORTI', 'FEDERICO ', 'CORTI', 'MASSIMILIANO', 'massimiliano@metalprecious.it', '3382791806'),
('CSCDGI06H29D612V', 'CASUCCI', 'DIEGO', 'CASUCCI', 'MASSIMILIANO', 'adriana.forlani@gmail.com', '3280427016'),
('DCRCRS06C24D612O', 'DE CRISTOFARO ', 'CHRISTIAN ', 'DE CRISTOFARO ', 'FEDERICO', 'bagnidalia@gmail.com', '3346335432'),
('DGLMTT06C23D612D', 'DEGLI INNOCENTI', 'MATTIA', 'MORANDI', 'FEDERICA', 'federicamorand@hotmail.com', '3496644574'),
('DLGJLU06C61G999L', 'DI LUIGI ', 'JULIA', 'DI LUIGI', 'ISIDORO', 'gabrieleidiluigi@gmail.com', '3392023989'),
('DMRSML06H29D612P', 'DI MARTINO', 'SAMUELE', 'Dâ€™ANGELO', 'LAURA', 'carmen.di.martino.4@gmail.com', '3338992147'),
('DNEJRA06R27A564E', 'DEIANA', 'JARI', 'ORDANO', 'NADIA', 'nadia.ordano@gmail.com', '3395842137'),
('DNGMTT06B15D612V', 'D''ANGELO', 'MATTIA', 'PINCITORE', 'ROMINA', 'rominapincitore@libero.it', '3295952302'),
('DNILPA07D02A564X', 'DINI', 'LAPO', 'BROGI', 'GIULIA', 'g.brogi81@gmail.com', '3470874979'),
('FCCTSE06A24D612U', 'FACCHINI', 'TESEO', 'STADERINI', 'ELISA', 'elisastaderini76@gmail.com', '3289613106'),
('FLDCRS06D20D612W', 'FILIDDANI ', 'CHRISTIAN ', 'BOMBACCI', 'ERICA', 'ericabombacci@gmail.com', '3496983770'),
('GDTLSS05T30D612R', 'GUIDOTTI', 'ALESSIO', 'GUIDOTTI', 'GIANLUCA ', 'joannakucaba@gmail.com', '3318173131'),
('GLLSRA06P65D612F', 'GALLI', 'SARA', 'GALLI', 'ALESSANDRO', 'a.galli64@gmail.com', '3292454183'),
('GNNTMS06D39B036E', 'GIANNINI', 'TOMMASO ', 'GIANNINI', 'ALESSIO', 'rdesist@tin.it', '3392334614'),
('GRNFRC06C10A564F', 'GUARNIERI', 'FEDERICO', 'GUARNIERI', 'LUCA', 'lucag99@libero.it', '3286854281'),
('GRNNDR06B06D612F', 'GUARNIERI', 'ANDREA', 'GUARNIERI', 'MARCO', 'guarni70@gmail.com', '3355269747'),
('GSNLNZ06M16G999Z', 'GISONNI', 'LORENZO PAOLO', 'GISONNI', 'ENZO', 'probestofcinelli@gmail.com', '3398034379'),
('HJDSBN06A20D612V', 'HAJDERASI', 'SHABAN', 'HAJDERASI', 'MAJLINDA', 'keltrina94@gmail.com', '3429423350'),
('HSALND06P18Z100W', 'HASA', 'ALESANDRO', 'HASA', 'BEDRI', 'hbedri75@gmail.com', '3290948326'),
('HUXNDR06R27G999I', 'HU', 'ANDREA', 'CHEN ', 'ZHOUTAO ', '2905623280@qq.com', '3288986619'),
('KHNYRR05R28Z249M', 'KHAN', 'YEASIR ARAFAT', 'KHAN', 'ABDUR RAHIM', 'abdurrahimkhan285@gmail.com', '3283584077'),
('LCHNTH06D27Z208J', 'LACHI', 'NAVUTH', 'MACCIANTI', 'FRANCESCA', 'macciantifra@gmail.com', '3395423286'),
('LCURSB06H24A564L', 'LUCIU', 'RAUL EUSEBIO ', 'BUDIS', 'RAMONA ARONICA ', 'salva_monique@yahoo.com', '3206666601'),
('LKHZKR06D16D612Z', 'EL KHAYYARI ', 'ZAKARIA ', 'EL KHYYARI ', 'SAAOD ', 'saaidelkhayyari22@gmail.com', '3881243318'),
('LNCLNZ06P03D612P', 'LENCIONI', 'LORENZO LAPO', 'LENCIONI', 'GIOVANNI', 'giovanni@studiolencioni.it', '3395477857'),
('LNVLRD06L25D403Q', 'LA NEVE', 'LEONARDO', 'BONECHI ', 'LUCIA', 'bonechi.lucia76@gmail.com', ' +39334 9979925'),
('LOIPTR06B15A564C', 'OLIA', 'PIETRO ', 'PERINI', 'SILVIA ', 'silviaperini72@gmail.com', '3478144461'),
('LSHLLI04P15Z138B', 'LIASHCHUK ', 'ILLIA', 'MOSKALENKO ', 'OLENA ', 'liaschuklena@gmail.com', '3891776377'),
('LSMHRD06A67D612J', 'LUIS MUSTELIER', 'HILARIA DE LA CARIDAD', 'MUSTELIER ORDAZ', 'ORIETA', 'mustelierorieta@gmail.com', ' +39 3713046811'),
('LSTCST06T59D612K', 'LASTRI', 'CELESTE', 'LASTRI', 'DANIELE', 'sabrina_gambini@baxter.com', '3395932599'),
('LVITMS06R24B036P', 'LIVI', 'TOMMASO', 'LIVI', 'ALESSANDRO', 'barbara.raspanti@gmail.com', '3397014082'),
('MBSHNT05SO5Z236A', 'MUBASHAR ', 'HASNAT ', 'ALI', 'MUBASHAR ', 'mubasharali8630@gmai.com', '3292117711'),
('MGEMTT05M20D612Z', 'MEGA', 'MATTIA', 'MONTINARO', 'LUIGIA', 'ginanto_2007@libero.it', '055419049'),
('MGLSRI06P60D612Z', 'AMEGLIO', 'SIRIA', 'AMEGLIO', 'STEFANO', 'stefano.ameglio@alice.it', '3457120603'),
('MGNGRL06D18G999E', 'MAGNOLFI', 'GABRIELE', 'MATTEI', 'TANIA', 'taniamattei1@gmail.com', '3929903500'),
('MNFGAI06R42D612D', 'MANFREDI', 'GAIA', 'POIDOMANI', 'DEBORA', 'deborapoidomani@libero.it', '3408000419'),
('MNLFPP06P03Z154K', 'MINELLI', 'FILIPPO', 'ROVETI', 'MARINA', 'marinaroveti@gmail.com', '3200412379'),
('MNSMTT06S29A564C', 'MONSANI', 'MATTIA', 'DI STEFANO', 'ROSALBA', 'rosydisti@gmail.com', '3396595391'),
('MNZSLV06C01B791G', 'MANZILLO ', 'SILVIO', 'MANZILLO', 'EMILIO', 'manzilloemilio@libero.it', '3396851541'),
('MRGMCS06R17612M', 'MARGINEAN ', 'MARCUS ', 'GLIGA', 'ROZALIA ELISABETA ', 'rozalia.gliga@gmail.com', '3206951958'),
('MRLFNC06S26D612W', 'MORELLI', 'FRANCESCO', 'TAVERNI', 'SILVIA', 'silfraleo@libero.it', '3337620287'),
('MRTMLD06S69D612I', 'MARIOTTI ', 'MATILDE', 'MARIOTTI', 'MATTEO', 'madrix78@gmail.com', '3406143103'),
('MRTMRG06A69D612E', 'MARTINELLI', 'MARGÃ² ', 'MARTINELLI', 'MORIS', 'martinellimoris@icloud.com', '3402764349'),
('MSTLNZ05D18G999O', 'MASTI', 'LORENZO', 'BISPO  DOS SANTOS', 'SILVANA', 'marcoesilvana18@gmail.com', '3299176288'),
('MZZGVR06L47D612Z', 'MAZZONI', 'GINEVRA', 'TORRIGIANI', 'CLAUDIA', 'claudia@torrigianisrl.com', '3398541222'),
('MZZLNZ06L21A564H', 'MAZZOCCHI', 'LORENZO', 'MIGLIORINI ', 'SILVIA', 'silviamigliorini71@gmail.com', '3398589468'),
('MZZSML06M24B036N', 'MOZZATO', 'SAMUELE', 'DISARÃ²', 'SABRINA', 'disa.s@libero.it', '3387726551'),
('NNCDGI06D17D612Q', 'INNOCENTI', 'DIEGO', 'BATI', 'VALENTINA', 'valebati80@gmail.com', '3289573364'),
('NNNRRT06T20A564T', 'NINNI', 'ROBERTO', 'SALVADORI', 'MONICA', 'monsal@outlook.it', '3332524450'),
('NRELNZ06E12D612S', 'NERI', 'LORENZO ', 'NERI', 'MARCO', 'neri1965@email.it', '3384077672'),
('NSTRRT06H20D612R', 'NESTI', 'ROBERTO', 'BROCCUCCI', 'MANUELA', 'manuelabroccucci@libero.it', '3385614599'),
('PCCMSM06H22D612X', 'PICCHIANTI', 'MASSIMO', 'PICCHIANTI', 'RICCARDO', 'riccardo.picchianti@hotmail.it', '+393482598137'),
('PCNVNI06P16D612X', 'PICONE ', 'IVAN', 'TORRINI', 'SERENA', 'studioamministrazioni.torrini@gmail.com', '3282307697'),
('PLLDNY06D12D612F', 'PELLEGRINO ', 'DANNY', 'PELLEGRINO ', 'ANGELO', 'angelo.pellegrino9@gmail.com', '3923365153'),
('PLLRCR07C14D612A', 'PALLI', 'RICCARDO', 'RINGRESSI', 'TAMARA', 'tamy20778@gmail.com', '3383696319'),
('PLTCSR06B17D612E', 'PAOLETTI', 'CESARE', 'PAOLETTI', 'SIMONE', 'paoletti_simone@virgilio.it', '3474153783'),
('PNNDTT06A55B036O', 'PENNI', 'DILETTA', 'NENCINI', 'NADA', 'nadanencini@gmail.com', '3333074194'),
('PPLDGI06T23B036U', 'IOPPOLO', 'DIEGO', 'IOPPOLO', 'LUIGI', 'salviwissia@gmail.com', '3406039079'),
('PRIDLY06T30A564T', 'PIRO', 'DANIELE YUKI', 'TAKAHASHI', 'MIEKO', 'mico_dannyuki@yahoo.co.jp', '3337257960'),
('PRSLSN06P17A564U', 'PARASCA', 'ALESSANDRO', 'PARASCA', 'AURELIA', 'aureliaparasca@yahho.it', '3895573033'),
('PSTLRD05C02A564X', 'PASTORINI', ' LEONARDO', ' TOMBERLI', 'RACHELE', 'rachele.tomberli@gmail.com', '3476936496'),
('PSTMLN06T71C351C', 'PASTORE', 'MERALIN KEIDY ', 'CARBONE', 'ROSITA', 'rositacarbo71@gmail.com', '3470632101'),
('RCNLNZ06M19Z140H', 'RACANELLI', 'LORENZO', 'COVALI', 'MARIANA', 'mariana.74covali@gmail.com', '3357699125'),
('RDCLCU06B02D612K', 'RADICCHI ', 'LUCA ', 'BARONCINI ', 'CLAUDIA ', 'clau.2006.cb@gmail.com', '3471812605 '),
('RGAMMD05H21D612T', 'ARGUI', 'MOHAMED ROCHDI', 'MEJRI', 'SONIA', 'soniamejri28@gmail.com', '3293679914'),
('RIOVNI06D16D612A', 'IORIO', 'IVAN', 'TORCETTA', 'ANNA', 'bartycorsini@hotmail.it', '3290156399'),
('RLNLRD06M16A564A', 'ORLANDINI ', 'LEONARDO ', 'ZACCHERINI ', 'MICHELA ', 'michelazaccherini@libero.it', '3470621351'),
('RRGHFPP06A12D612', 'RIGHESCHI', 'FILIPPO', 'ZANI', 'CLAUDIA', 'c.zani73@gmail.com', '3286991468'),
('SCPFNC06A16A564S', 'SCOPELLITI', 'FRANCESCO', 'GHERI', 'SIMONA', 'sgheri7@gmail.com', '3475605390'),
('SCRLSN06D14D423Z', 'SCIORTINO', 'ALESSANDRO', 'SCIORTINO ', 'MASSIMO', 'sciortino74@gmail.com', '3388416353'),
('SCRRCC06L15B036N', 'SCORRETTI', 'ROCCO ', 'COLLINI ', 'SONIA', 'soniacollini@live.it', '3389253471'),
('SCTMNL05B24D612I', 'SCIUTO', 'EMANUELE', 'MACCARONE', 'ROSA MARIA', 'rosy.stella69@gmail.com', '3477534999'),
('SNTSFN06B15D612Y', 'SANTINI', 'STEFANO', 'VALENTINI', 'MONICA', 'mony.valentini74@gmail.com', '3476366213'),
('SPGNDR06C18A564J', 'SPAGNI', 'ANDREA', 'SPAGNI', 'SIMONE', 'simone.spagni@alice.it', '3481330952'),
('SPNSMN06C04A564P', 'SPINELLO', 'SIMONE', 'SABATONI', 'DONATELLA', 'dona.sabatini@gmail.com', '3478427433'),
('SREDRD06P13A564U', 'SERIO', 'EDUARD', 'LLESHI', 'ROZINA', 'rozinaserio@yahoo.it', '3202632818'),
('SRFGLI06B11D612O', 'SERAFINELLI', 'GIULIO', 'AIAZZI', 'SILVIA', 'silviaaiazzi@libero.it', '3478449127'),
('STRCST06T27B036C', 'STROIA', 'CRISTIAN ANDREI', 'STROIA', 'ALINA', 'alinastroia83@yahoo.it', '3663314300'),
('STTNRC05P08Z129O', 'STATE', 'ANDREI CRISTIAN MARIO ', 'POPESCU ', 'ALINA ANDREEA ', 'aliande14@yahoo.com', '3774777479'),
('SVRNDR06R11D612O', 'SIVIERO ', 'ANDREA', 'SIVIERO ', 'SAMUELE ', 'katygabry80@gmail.com', '393383643108'),
('TNRGVR06S56B036X', 'TONERINI ', 'GINEVRA ', 'GIUSTI', 'VALENTINA ', 'V.77@libero.it', '3392099534'),
('TRLTMS06A01D612S', 'TARLINI', 'TOMMASO', 'TARLINI', 'FRANCO', 'franco.tarlini@elletitelecomunicazioni.com', '3351228895'),
('VLTNDR06E19A564I', 'VOLTA', 'ANDREA', 'FRESCHI ', 'CLARA', 'clarafreschi2@gmail.com', '3473319098'),
('ZGHLNZ06B23G713T', 'ZOGHERI', 'LORENZO', 'ZOGHERI', 'FRANCESCO', 'francescozogheri@gmail.com', '3403328214'),
('ZHASFN05H19D612O', 'ZHAO', 'STEFANO ', 'ZHAO ', 'JUN SHUAI ', 'elyingying@icloud.com', '3387973852'),
('ZNAGLI07B17D612B', 'ZANI', 'GIULIO', 'ALESSIA', 'ASTUTI', 'astutiale@hotmail.it', '3939350513');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE IF NOT EXISTS `utente` (
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ruolo` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`username`, `password`, `cognome`, `nome`, `email`, `ruolo`) VALUES
('didattica', '$2y$10$c.EqtKhn5CWB6bFZeABwg.3k.YbRzfKfOTva3FO2amxKQ4xR57DdG', 'Segreteria', 'Didattica', 'segreteriadidattica@isisdavinci.eu', 'segreteria'),
('lorisranalli', '$2y$10$Old7iZOgZjEJLMQqJJUExOD2v0IaslJYlFOCRe/VI03Zx9uFzQAGi', 'Ranalli', 'Loris', 'lorisranalli@isisdavinci.eu', 'admin');

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `appuntamento`
--
ALTER TABLE `appuntamento`
  ADD CONSTRAINT `cf_stud` FOREIGN KEY (`cf_stud`) REFERENCES `studente` (`cf_stud`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_fascia` FOREIGN KEY (`id_fascia`) REFERENCES `fasciaoraria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
