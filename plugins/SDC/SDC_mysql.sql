-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `SDC`
--

CREATE TABLE IF NOT EXISTS `SDC` (
  `SDCID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `DataName` varchar(100) NOT NULL,
  `DataPath` varchar(100) NOT NULL,
  `SHA1SUM` varchar(50) NOT NULL,
  `EDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CheckDate` varchar(40),
  PRIMARY KEY (`SCDID`)
);  



-- --------------------------------------------------------