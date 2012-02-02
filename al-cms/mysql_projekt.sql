-- --------------------------------------------------------
--
-- Tabellenstruktur für Tabelle `Benutzer`
--

CREATE TABLE IF NOT EXISTS `benutzer` (
  `UID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `GID` int(11) UNSIGNED NOT NULL,
  `Username` varchar(25),
  `Passwort` varchar(50),
  `Passwort_Salt` varchar(50),
  `Session_ID` varchar(50),
  `IP_Adresse` varchar(50),
  `Mail` varchar(45),
  PRIMARY KEY (`UID`)
);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Gruppen`
--

CREATE TABLE IF NOT EXISTS `gruppen` (
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

CREATE TABLE IF NOT EXISTS `design` (
  `DID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `DName` varchar(45),
  `DDatei` varchar(100),
  `aktiv` int(1) UNSIGNED NOT NULL,
   PRIMARY KEY (`DID`)
); 

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Panel-Design`
--

CREATE TABLE IF NOT EXISTS `panel_design` (
  `PDID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pdname` varchar(45),
  `pdatei` varchar(100),
  `aktiv` int(1) UNSIGNED NOT NULL,
   PRIMARY KEY (`PDID`)
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

CREATE TABLE IF NOT EXISTS `rechte_plugins` (
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
  `sysp` int(1) NOT NULL,
  `aktiv` int(1) NOT NULL,
  PRIMARY KEY (`PLID`)
); 


-- --------------------------------------------------------


--
-- Fremdschlüssel setzen
--

ALTER TABLE benutzer 
add foreign key (GID) REFERENCES gruppen (GID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE rechte_plugins
add foreign key (GID) REFERENCES gruppen (GID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE rechte_plugins
add foreign key (PLID) REFERENCES plugins (PLID)ON DELETE cascade ON UPDATE cascade;

ALTER TABLE plugin_funktion
add foreign key (PLID) REFERENCES plugins (PLID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE plugin_funktion_rechte
add foreign key (GID) REFERENCES gruppen (GID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE plugin_funktion_rechte
add foreign key (PLFID) REFERENCES plugin_funktion (PLFID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE plugin_title
add foreign key (PLID) REFERENCES plugins (PLID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE plugin_meta
add foreign key (PLID) REFERENCES plugins (PLID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE plugin_funktion_title
add foreign key (PLFID) REFERENCES plugin_funktion (PLFID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE plugin_funktion_meta
add foreign key (PLFID) REFERENCES plugin_funktion (PLFID) ON DELETE cascade ON UPDATE cascade;
-- --------------------------------------------------------


--
-- Standart Gruppen setzen
--

INSERT INTO `gruppen` (
`GName` ,
`GBeschreibung`
)
VALUES (
'anonym', 'Anonymer User der noch uneingeloggt ist.'
);

INSERT INTO `gruppen` (
`GName` ,
`GBeschreibung`
)
VALUES (
'user', 'Normaler Benutzer.'
);
INSERT INTO `gruppen` (
`GName` ,
`GBeschreibung`
)
VALUES (
'mod', 'Moderrator'
);
INSERT INTO `gruppen` (
`GName` ,
`GBeschreibung`
)
VALUES (
'admin', 'Administrator'
);


