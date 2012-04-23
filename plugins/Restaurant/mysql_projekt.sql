-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Reservierungen`
--

CREATE TABLE IF NOT EXISTS `reservierungen` (
  `RID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Session_ID` varchar(50),
  `IP_Adresse` varchar(50),
  `maxtime` varchar(40),
  `U_N` int(1),
  PRIMARY KEY (`RID`)
);  


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Reservierungen_User`
--

CREATE TABLE IF NOT EXISTS `reservierungen_user` (
  `RID` int(11) UNSIGNED NOT NULL,
  `UID` int(11) UNSIGNED NOT NULL
);  



-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Reservierungen_Tisch`
--

CREATE TABLE IF NOT EXISTS `reservierungen_tisch` (
  `RID` int(11) UNSIGNED NOT NULL,
  `TID` int(11) UNSIGNED NOT NULL
); 

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Reservierungen_Raeume`
--

CREATE TABLE IF NOT EXISTS `reservierungen_raeume` (
  `RID` int(11) UNSIGNED NOT NULL,
  `RAID` int(11) UNSIGNED NOT NULL
); 

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Tische`
--

CREATE TABLE IF NOT EXISTS `tische` (
  `TID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `RAID` int(11) UNSIGNED NOT NULL,
  `TBezeichnung` text,
  `TMaxPersonen` int(2),
  PRIMARY KEY (`TID`)
); 


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Raeume`
--

CREATE TABLE IF NOT EXISTS `raeume` (
  `RAID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Name` varchar(40),
  `RBeschreibung` text,
  PRIMARY KEY (`RAID`)
); 

-- --------------------------------------------------------
--
-- Tabellenstruktur für Tabelle `Information_Pages`
--

CREATE TABLE IF NOT EXISTS `information_pages` (
  `IPID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IPTitel` varchar(45),
  `IPInhalt` text,
  PRIMARY KEY (`IPID`)
); 


-- --------------------------------------------------------
--
-- Tabellenstruktur für Tabelle `Bezahlung_Arten`
--

CREATE TABLE IF NOT EXISTS `bezahlung_arten` (
  `BAID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `BAName` varchar(45),
  `BADatei` varchar(100),
  `BABeschreibung` text,
  `BAImage` varchar(60),
  PRIMARY KEY (`BAID`)
); 


-- --------------------------------------------------------
--
-- Tabellenstruktur für Tabelle `Reservierung_Essen`
--

CREATE TABLE IF NOT EXISTS `reservierung_essen` (
  `RID` int(11) UNSIGNED NOT NULL,
  `SPID` int(11) UNSIGNED NOT NULL
); 


-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- Tabellenstruktur für Tabelle `Reservierung_Bezahlung`
--

CREATE TABLE IF NOT EXISTS `reservierung_bezahlung` (
  `RID` int(11) UNSIGNED NOT NULL,
  `BAID` int(11) UNSIGNED NOT NULL,
  `bz1` varchar(40),
  `bz2` varchar(40)
); 


-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Speisekarte`
--

CREATE TABLE IF NOT EXISTS `speisekarte` (
  `SPID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `SPName` varchar(45),
  `SPBeschreibung` text,
  `SPPreis` decimal(4.2),
  PRIMARY KEY (`SPID`)
); 


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Reservierungen_Non_Reg`
--

CREATE TABLE IF NOT EXISTS `reservierungen_non_reg` (
  `RID` int(11) UNSIGNED NOT NULL,
  `RName` varchar(25),
  `RVorname` varchar(25),
  `ROrt` varchar(40),
  `RPLZ` varchar(25),
  `RAdresse` varchar(25),
  `Email` varchar(45)
); 




-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `nid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `UID` int(11) UNSIGNED NOT NULL,
  `title` varchar(50),
  `text` text,
  `newsdate` varchar(40),
  PRIMARY KEY (`nid`)
);

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `site`
--

CREATE TABLE IF NOT EXISTS `site` (
  `STID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(50),
  `text` text,
  `date` varchar(40),
  PRIMARY KEY (`STID`)
);


--
-- Tabellenstruktur für Tabelle `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `PCOID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `NID` int(11) UNSIGNED NOT NULL,
  `UID` int(11) UNSIGNED NOT NULL,
  `comment` text,
  `ctime` varchar(40),
  PRIMARY KEY (`PCOID`)
);

-- --------------------------------------------------------


--
-- Fremdschlüssel setzen
--
ALTER TABLE reservierungen_non_reg 
add foreign key (RID) REFERENCES reservierungen (RID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE reservierung_bezahlung
add foreign key (RID) REFERENCES reservierungen (RID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE reservierung_bezahlung
add foreign key (BAID) REFERENCES bezahlung_arten (BAID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE reservierungen_user 
add foreign key (RID) REFERENCES reservierungen (RID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE reservierungen_user 
add foreign key (RID) REFERENCES user (UID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE reservierungen_raeume
add foreign key (RID) REFERENCES reservierungen (RID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE reservierungen_raeume
add foreign key (RAID) REFERENCES raeume (RAID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE reservierungen_tisch
add foreign key (RID) REFERENCES reservierungen (RID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE reservierungen_tisch
add foreign key (TID) REFERENCES tische (TID) ON DELETE cascade ON UPDATE cascade;


ALTER TABLE reservierung_essen
add foreign key (RID) REFERENCES reservierungen (RID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE reservierung_essen
add foreign key (SPID) REFERENCES speisekarte (SPID) ON DELETE cascade ON UPDATE cascade;
-- --------------------------------------------------------