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
  `Mail` varchar(45)
  PRIMARY KEY (`UID`)
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

ALTER TABLE rechte_plugins
add foreign key (GID) REFERENCES Gruppen (GID) ON DELETE restrict ON UPDATE restrict;

ALTER TABLE rechte_plugins
add foreign key (PLID) REFERENCES Plugins (PLID) ON DELETE restrict ON UPDATE restrict;

ALTER TABLE Plugin_Funktion
add foreign key (PLID) REFERENCES Plugins (PLID) ON DELETE restrict ON UPDATE restrict;

ALTER TABLE Plugin_Funktion_Rechte
add foreign key (GID) REFERENCES Gruppen (GID) ON DELETE restrict ON UPDATE restrict;

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


