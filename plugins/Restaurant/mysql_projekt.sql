--
-- Tabellenstruktur für Tabelle `Benutzer`
--

CREATE TABLE IF NOT EXISTS `Benutzer` (
  `UID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `GID` int(11) UNSIGNED NOT NULL,
  `Username` varchar(25),
  `Passwort` varchar(50),
  `Passwort_Salt` varchar(50),
  `Session_ID` varchar(50),
  `IP_Adresse` varchar(50),
  `Mail` varchar(45),
  `Name` varchar(25),
  `Vorname` varchar(25),
  `Ort` varchar(40),
  `PLZ` varchar(25),
  `Adresse` varchar(25),
  `Geburtsdatum` varchar(40),
  PRIMARY KEY (`UID`)
);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Reservierungen`
--

CREATE TABLE IF NOT EXISTS `Reservierungen` (
  `RID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `UID` int(11) UNSIGNED NOT NULL,
  `BAID` int(11) UNSIGNED NOT NULL,
  `Session_ID` varchar(50),
  `IP_Adresse` varchar(50),
  `maxtime` varchar(40),
  `U_N` init(1),
  PRIMARY KEY (`RID`)
);  


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Reservierungen`
--

CREATE TABLE IF NOT EXISTS `Reservierungen_User` (
  `RID` int(11) UNSIGNED NOT NULL,
  `UID` int(11) UNSIGNED NOT NULL
);  



-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Reservierungen_Tisch`
--

CREATE TABLE IF NOT EXISTS `Reservierungen_Tisch` (
  `RID` int(11) UNSIGNED NOT NULL,
  `TID` int(11) UNSIGNED NOT NULL
); 

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Reservierungen_Rauume`
--

CREATE TABLE IF NOT EXISTS `Reservierungen_Rauume` (
  `RID` int(11) UNSIGNED NOT NULL,
  `RAID` int(11) UNSIGNED NOT NULL
); 

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Tische`
--

CREATE TABLE IF NOT EXISTS `Tische` (
  `TID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `RAID` int(11) UNSIGNED NOT NULL,
  `TBezeichnung` text,
  `TMaxPersonen` int(2),
  PRIMARY KEY (`TID`)
); 


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Räume`
--

CREATE TABLE IF NOT EXISTS `Rauume` (
  `RAID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `RBeschreibung` text,
  PRIMARY KEY (`RAID`)
); 


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Gruppen`
--

CREATE TABLE IF NOT EXISTS `Gruppen` (
  `GID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `GName` varchar(45),
  `GBeschreibung` text,
  PRIMARY KEY (`GID`)
); 



-- --------------------------------------------------------
--
-- Tabellenstruktur für Tabelle `Information_Pages`
--

CREATE TABLE IF NOT EXISTS `Information_Pages` (
  `IPID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IPTitel` varchar(45),
  `IPInhalt` text,
  PRIMARY KEY (`IPID`)
); 


-- --------------------------------------------------------
--
-- Tabellenstruktur für Tabelle `Bezahlung_Arten`
--

CREATE TABLE IF NOT EXISTS `Bezahlung_Arten` (
  `BAID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `BAName` varchar(45),
  `BABeschreibung` text,
  `BAImage` varchar(50),
  PRIMARY KEY (`BAID`)
); 


-- --------------------------------------------------------
--
-- Tabellenstruktur für Tabelle `Reservierung_Essen`
--

CREATE TABLE IF NOT EXISTS `Reservierung_Essen` (
  `RID` int(11) UNSIGNED NOT NULL,
  `SPID` int(11) UNSIGNED NOT NULL
); 


-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Speisekarte`
--

CREATE TABLE IF NOT EXISTS `Speisekarte` (
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

CREATE TABLE IF NOT EXISTS `Reservierungen_Non_Reg` (
  `RID` int(11) UNSIGNED NOT NULL,
  `Session_ID` varchar(45),
  `Email` varchar(45),
  `IP_Adresse` varchar(45),
  `RName` varchar(25),
  `RVorname` varchar(25),
  `ROrt` varchar(40),
  `RPLZ` varchar(25),
  `RAdresse` varchar(25),
  `Geburtsdatum` varchar(40)
); 



-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Plugin_Funktion`
--

CREATE TABLE IF NOT EXISTS `plugin_funktion` (
  `PLFID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `PLID` int(11) UNSIGNED NOT NULL,
  `Funktionsname` varchar(30),
  `hdatei` varchar(100),
  `Beschreibung` text,
  `parent_id` int(1),
  `parent` int(1),
  `aktiv` int(1),
  PRIMARY KEY (`PLFID`)
); 

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Plugin_Funktion_Rechte`
--

CREATE TABLE IF NOT EXISTS `plugin_funktion_rechte` (
  `PLFID` int(11) UNSIGNED NOT NULL,
  `GID` int(11) UNSIGNED NOT NULL,
  `Y_N` int(1)
); 

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Design`
--

CREATE TABLE IF NOT EXISTS `Design` (
  `DID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `DName` varchar(45),
  `DDatei` varchar(100),
  `aktiv` int(1) UNSIGNED NOT NULL,
	PRIMARY KEY (`DID`)
); 

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `al_config`
--

CREATE TABLE IF NOT EXISTS `al_config` (
  `CID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `CName` varchar(45),
  `funktion` varchar(100),
  `aktiv` int(1) UNSIGNED NOT NULL,
	PRIMARY KEY (`CID`)
); 

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `plugin_funktion_meta`
--

CREATE TABLE IF NOT EXISTS `plugin_funktion_meta` (
  `PLFID` int(11) UNSIGNED NOT NULL,
  `metad` varchar(100)
  ); 

-- --------------------------------------------------------


-- --------------------------------------------------------
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `plugin_funktion_title`
--

CREATE TABLE IF NOT EXISTS `plugin_funktion_title` (
  `PLFID` int(11) UNSIGNED NOT NULL,
  `titled` varchar(100)
  ); 

-- --------------------------------------------------------

-- --------------------------------------------------------
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `plugin_meta`
--

CREATE TABLE IF NOT EXISTS `plugin_meta` (
  `PLID` int(11) UNSIGNED NOT NULL,
  `metad` varchar(100)
  ); 

-- --------------------------------------------------------


-- --------------------------------------------------------
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `plugin_title`
--

CREATE TABLE IF NOT EXISTS `plugin_title` (
  `PLID` int(11) UNSIGNED NOT NULL,
  `titled` varchar(100)
  ); 

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Rechte_Plugins`
--

CREATE TABLE IF NOT EXISTS `Rechte_Plugins` (
	`PLID` int(11) UNSIGNED NOT NULL,
  `GID` int(11) UNSIGNED NOT NULL,
  `Y_N` int(1)
); 


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Plugins`
--

CREATE TABLE IF NOT EXISTS `plugins` (
  `PLID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `PLName` varchar(45),
  `hdatei` varchar(100),
  `PLBeschreibung` text,
  `aktiv` int(1) NOT NULL,
  PRIMARY KEY (`PLID`)
); 


-- --------------------------------------------------------


--
-- Fremdschlüssel setzen
--

ALTER TABLE Benutzer 
add foreign key (GID) REFERENCES Gruppen (GID) ON DELETE restrict ON UPDATE restrict;


ALTER TABLE Reservierungen 
add foreign key (UID) REFERENCES Benutzer (UID) ON DELETE restrict ON UPDATE restrict;


ALTER TABLE Reservierungen 
add foreign key (BAID) REFERENCES Bezahlung_Arten (BAID) ON DELETE restrict ON UPDATE restrict;


ALTER TABLE Reservierungen_Tisch_Räume
add foreign key (RID) REFERENCES Reservierungen (RID) ON DELETE restrict ON UPDATE restrict;


ALTER TABLE Reservierungen_Tisch_Räume
add foreign key (TID) REFERENCES Tische (TID) ON DELETE restrict ON UPDATE restrict;


ALTER TABLE Reservierungen_Tisch_Räume
add foreign key (RAID) REFERENCES Räume (RAID) ON DELETE restrict ON UPDATE restrict;

ALTER TABLE Tische
add foreign key (RAID) REFERENCES Räume (RAID) ON DELETE restrict ON UPDATE restrict;

ALTER TABLE rechte_plugins
add foreign key (GID) REFERENCES Gruppen (GID) ON DELETE restrict ON UPDATE restrict;

ALTER TABLE rechte_plugins
add foreign key (PLID) REFERENCES Plugins (PLID) ON DELETE restrict ON UPDATE restrict;

ALTER TABLE Plugin_Funktion
add foreign key (PLID) REFERENCES Plugins (PLID) ON DELETE restrict ON UPDATE restrict;

ALTER TABLE Plugin_Funktion_Rechte
add foreign key (GID) REFERENCES Gruppen (GID) ON DELETE restrict ON UPDATE restrict;

ALTER TABLE Reservierung_Essen
add foreign key (RID) REFERENCES Reservierungen (RID) ON DELETE restrict ON UPDATE restrict;

ALTER TABLE Reservierung_Essen
add foreign key (SPID) REFERENCES Speisekarte (SPID) ON DELETE restrict ON UPDATE restrict;

ALTER TABLE Reservierung_Vorab
add foreign key (TID) REFERENCES Tische (TID) ON DELETE restrict ON UPDATE restrict;

ALTER TABLE Reservierung_Vorab
add foreign key (SPID) REFERENCES Speisekarte (SPID) ON DELETE restrict ON UPDATE restrict;

-- --------------------------------------------------------


--
-- Standart Gruppen setzen
--

INSERT INTO `Gruppen` (
`GName` ,
`GBeschreibung`
)
VALUES (
'anonym', 'Anonymer User der noch uneingeloggt ist.'
);

INSERT INTO `Gruppen` (
`GName` ,
`GBeschreibung`
)
VALUES (
'user', 'Normaler Benutzer.'
);
INSERT INTO `Gruppen` (
`GName` ,
`GBeschreibung`
)
VALUES (
'mod', 'Moderrator'
);
INSERT INTO `Gruppen` (
`GName` ,
`GBeschreibung`
)
VALUES (
'admin', 'Administrator'
);


