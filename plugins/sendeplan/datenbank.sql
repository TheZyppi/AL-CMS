-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Sendeplan`
--

CREATE TABLE IF NOT EXISTS `Sendeplan` (
  `SAID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dj` varchar(25),
  `showname` varchar(30),
  `time` varchar(40),
  `end` varchar(40),
  `date` varchar(40),
  PRIMARY KEY (`SAID`)
);  