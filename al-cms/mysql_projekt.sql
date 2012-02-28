-- --------------------------------------------------------
--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `GID` int(11) UNSIGNED NOT NULL,
  `username` varchar(30),
  `passwort` varchar(50),
  `passwort_salt` varchar(50),
  `session_id` varchar(50),
  `ip_adresse` varchar(50),
  `mail` varchar(45),
  PRIMARY KEY (`UID`)
);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `GID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(45),
  `definition` text,
  PRIMARY KEY (`GID`)
); 

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `plugin_funktion`
--

CREATE TABLE IF NOT EXISTS `plugin_funktion` (
  `PLFID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `funktionsname` varchar(30),
  `data` varchar(100),
  `definition` text,
  `parent_id` int(1),
  `parent` int(1),
  `aktiv` int(1),
  PRIMARY KEY (`PLFID`)
);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `head_plugin_lower_plugin`
--

CREATE TABLE IF NOT EXISTS `head_plugin_lower_plugin` (
  `HPLID` int(11) UNSIGNED NOT NULL,
  `LPLID` int(11) UNSIGNED NOT NULL
);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `head_plugin_funktion`
--

CREATE TABLE IF NOT EXISTS `head_plugin_funktion` (
  `HPLID` int(11) UNSIGNED NOT NULL,
  `PLFID` int(11) UNSIGNED NOT NULL
);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lower_plugin_funktion`
--

CREATE TABLE IF NOT EXISTS `lower_plugin_funktion` (
  `LPLID` int(11) UNSIGNED NOT NULL,
  `PLFID` int(11) UNSIGNED NOT NULL
);


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `plugin_funktion_rights`
--

CREATE TABLE IF NOT EXISTS `plugin_funktion_rights` (
  `PLFID` int(11) UNSIGNED NOT NULL,
  `GID` int(11) UNSIGNED NOT NULL,
  `Y_N` int(1)
); 

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `design`
--

CREATE TABLE IF NOT EXISTS `design` (
  `DID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(45),
  `data` varchar(100),
  `mobile` int(1),
  `standart` int(1),
  `aktiv` int(1) UNSIGNED NOT NULL,
   PRIMARY KEY (`DID`)
); 

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `design_head_plugin_order`
--

CREATE TABLE IF NOT EXISTS `design_head_plugin_order` (
  `DID` int(11) UNSIGNED NOT NULL,
  `HPLID` int(11) UNSIGNED NOT NULL
);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `design_lower_plugin_order`
--

CREATE TABLE IF NOT EXISTS `design_lower_plugin_order` (
  `DID` int(11) UNSIGNED NOT NULL,
  `LPLID` int(11) UNSIGNED NOT NULL
);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `design_plugin_funktion_order`
--

CREATE TABLE IF NOT EXISTS `design_plugin_funktion_order` (
  `DID` int(11) UNSIGNED NOT NULL,
  `PLFID` int(11) UNSIGNED NOT NULL
); 

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `design_mobile_head_plugin_order`
--

CREATE TABLE IF NOT EXISTS `design_mobile_head_plugin_order` (
  `DID` int(11) UNSIGNED NOT NULL,
  `HPLID` int(11) UNSIGNED NOT NULL
);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `design_mobile_lower_plugin_order`
--

CREATE TABLE IF NOT EXISTS `design_mobile_lower_plugin_order` (
  `DID` int(11) UNSIGNED NOT NULL,
  `LPLID` int(11) UNSIGNED NOT NULL
);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `design_mobile_plugin_funktion_order`
--

CREATE TABLE IF NOT EXISTS `design_mobile_plugin_funktion_order` (
  `DID` int(11) UNSIGNED NOT NULL,
  `PLFID` int(11) UNSIGNED NOT NULL
); 

 
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `panel`
--

CREATE TABLE IF NOT EXISTS `panel` (
  `PID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(45),
  `aktiv` int(1) UNSIGNED NOT NULL,
   PRIMARY KEY (`PID`)
); 


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `al_config`
--

CREATE TABLE IF NOT EXISTS `al_config` (
  `CID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(45),
  `funktion` varchar(100),
  `aktiv` int(1) UNSIGNED NOT NULL,
	PRIMARY KEY (`CID`)
); 

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `plugin_funktion_meta`
--

CREATE TABLE IF NOT EXISTS `plugin_funktion_meta` (
  `PLFID` int(11) UNSIGNED NOT NULL,
  `metad` varchar(100)
  ); 

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `plugin_funktion_title`
--

CREATE TABLE IF NOT EXISTS `plugin_funktion_title` (
  `PLFID` int(11) UNSIGNED NOT NULL,
  `titled` varchar(100)
  ); 

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `head_plugin_meta`
--

CREATE TABLE IF NOT EXISTS `head_plugin_meta` (
  `HPLID` int(11) UNSIGNED NOT NULL,
  `metad` varchar(100)
  ); 


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `head_plugin_title`
--

CREATE TABLE IF NOT EXISTS `head_plugin_title` (
  `HPLID` int(11) UNSIGNED NOT NULL,
  `titled` varchar(100)
  ); 


-- --------------------------------------------------------
--
-- Tabellenstruktur für Tabelle `lower_plugin_meta`
--

CREATE TABLE IF NOT EXISTS `lower_plugin_meta` (
  `LPLID` int(11) UNSIGNED NOT NULL,
  `metad` varchar(100)
  ); 


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lower_plugin_title`
--

CREATE TABLE IF NOT EXISTS `lower_plugin_title` (
  `LPLID` int(11) UNSIGNED NOT NULL,
  `titled` varchar(100)
  ); 


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `head_plugin_rights`
--

CREATE TABLE IF NOT EXISTS `head_plugin_rights` (
	`HPLID` int(11) UNSIGNED NOT NULL,
  `GID` int(11) UNSIGNED NOT NULL,
  `Y_N` int(1)
); 

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lower_plugin_rights`
--

CREATE TABLE IF NOT EXISTS `lower_plugin_rights` (
	`LPLID` int(11) UNSIGNED NOT NULL,
  `GID` int(11) UNSIGNED NOT NULL,
  `Y_N` int(1)
); 

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `head_plugins`
--

CREATE TABLE IF NOT EXISTS `head_plugins` (
  `HPLID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(45),
  `data` varchar(100),
  `definition` text,
  `sysp` int(1) NOT NULL,
  `aktiv` int(1) NOT NULL,
  PRIMARY KEY (`HPLID`)
); 

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lower_plugins`
--

CREATE TABLE IF NOT EXISTS `lower_plugins` (
  `LPLID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(45),
  `data` varchar(100),
  `definition` text,
  `aktiv` int(1) NOT NULL,
  PRIMARY KEY (`LPLID`)
); 


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `al_version`
--

CREATE TABLE IF NOT EXISTS `al_version` (
  `name` varchar(45) NOT NULL,
  `definition` text,
  `version` varchar(40) NOT NULL
); 


-- --------------------------------------------------------


--
-- Fremdschlüssel setzen
--

ALTER TABLE user 
add foreign key (GID) REFERENCES groups (GID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE head_plugin_rights
add foreign key (GID) REFERENCES groups (GID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE lower_plugin_rights
add foreign key (GID) REFERENCES groups (GID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE head_plugin_rights
add foreign key (HPLID) REFERENCES head_plugins (HPLID)ON DELETE cascade ON UPDATE cascade;

ALTER TABLE lower_plugin_rights
add foreign key (LPLID) REFERENCES lower_plugins (LPLID)ON DELETE cascade ON UPDATE cascade;

ALTER TABLE head_plugin_funktion
add foreign key (HPLID) REFERENCES head_plugins (HPLID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE head_plugin_funktion
add foreign key (PLFID) REFERENCES plugin_funktion (PLFID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE lower_plugin_funktion
add foreign key (LPLID) REFERENCES lower_plugins (LPLID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE lower_plugin_funktion
add foreign key (PLFID) REFERENCES plugin_funktion (PLFID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE plugin_funktion_rights
add foreign key (GID) REFERENCES groups (GID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE plugin_funktion_rights
add foreign key (PLFID) REFERENCES plugin_funktion (PLFID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE head_plugin_title
add foreign key (HPLID) REFERENCES head_plugins (HPLID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE head_plugin_meta
add foreign key (HPLID) REFERENCES head_plugins (HPLID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE lower_plugin_title
add foreign key (LPLID) REFERENCES lower_plugins (LPLID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE lower_plugin_meta
add foreign key (LPLID) REFERENCES lower_plugins (LPLID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE plugin_funktion_title
add foreign key (PLFID) REFERENCES plugin_funktion (PLFID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE plugin_funktion_meta
add foreign key (PLFID) REFERENCES plugin_funktion (PLFID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE design_head_plugin_order
add foreign key (DID) REFERENCES design (DID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE design_head_plugin_order
add foreign key (HPLID) REFERENCES head_plugins (HPLID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE design_lower_plugin_order
add foreign key (DID) REFERENCES design (DID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE design_lower_plugin_order
add foreign key (LPLID) REFERENCES lower_plugins (LPLID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE design_plugin_funktion_order
add foreign key (DID) REFERENCES design (DID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE design_plugin_funktion_order
add foreign key (PLFID) REFERENCES plugin_funktion (PLFID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE design_mobile_head_plugin_order
add foreign key (DID) REFERENCES design (DID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE design_mobile_head_plugin_order
add foreign key (HPLID) REFERENCES head_plugins (HPLID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE design_mobile_lower_plugin_order
add foreign key (DID) REFERENCES design (DID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE design_mobile_lower_plugin_order
add foreign key (LPLID) REFERENCES lower_plugins (LPLID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE design_mobile_plugin_funktion_order
add foreign key (DID) REFERENCES design (DID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE design_mobile_plugin_funktion_order
add foreign key (PLFID) REFERENCES plugin_funktion (PLFID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE head_plugin_lower_plugin
add foreign key (HPLID) REFERENCES head_plugins (HPLID) ON DELETE cascade ON UPDATE cascade;

ALTER TABLE head_plugin_lower_plugin
add foreign key (LPLID) REFERENCES lower_plugins (LPLID) ON DELETE cascade ON UPDATE cascade;

-- --------------------------------------------------------


--
-- Standart groups settings
--

INSERT INTO `groups` (
`name` ,
`definition`
)
VALUES (
'anonym', 'Anonymer User der noch uneingeloggt ist.'
);

INSERT INTO `groups` (
`name` ,
`definition`
)
VALUES (
'user', 'Normaler user.'
);
INSERT INTO `groups` (
`name` ,
`definition`
)
VALUES (
'mod', 'Moderator'
);
INSERT INTO `groups` (
`name` ,
`definition`
)
VALUES (
'admin', 'Administrator'
);

INSERT INTO `head_plugins` (
`name` ,
`data`,
`definition`,
`sysp`,
`aktiv`
)
VALUES (
'AL-CMS', '', '', '1', '1'
);

INSERT INTO `plugin_funktion` (
`funktionsname`,
`data`,
`definition`,
`parent_id`,
`parent`,
`aktiv`
)
VALUES (
'On', '', '', '', '', '1'
);

INSERT INTO `plugin_funktion` (
`funktionsname`,
`data`,
`definition`,
`parent_id`,
`parent`,
`aktiv`
)
VALUES (
'login', 'login/login.php', '', '', '', '1'
);

INSERT INTO `plugin_funktion` (
`funktionsname`,
`data`,
`definition`,
`parent_id`,
`parent`,
`aktiv`
)
VALUES (
'logout', 'login/logout.php', '', '', '', '1'
);

INSERT INTO `plugin_funktion` (
`funktionsname`,
`data`,
`definition`,
`parent_id`,
`parent`,
`aktiv`
)
VALUES (
'register', 'register/index.php', '', '', '', '1'
);

INSERT INTO `plugin_funktion` (
`funktionsname`,
`data`,
`definition`,
`parent_id`,
`parent`,
`aktiv`
)
VALUES (
'mobile', '', '', '', '', '0'
);


INSERT INTO `head_plugin_funktion` (
`HPLID`,
`PLFID`
)
VALUES (
'1', '1'
);

INSERT INTO `head_plugin_funktion` (
`HPLID`,
`PLFID`
)
VALUES (
'1', '2'
);

INSERT INTO `head_plugin_funktion` (
`HPLID`,
`PLFID`
)
VALUES (
'1', '3'
);

INSERT INTO `head_plugin_funktion` (
`HPLID`,
`PLFID`
)
VALUES (
'1', '4'
);

INSERT INTO `head_plugin_funktion` (
`HPLID`,
`PLFID`
)
VALUES (
'1', '5'
);


INSERT INTO `head_plugin_rights` (
`HPLID` ,
`GID`,
`Y_N`
)
VALUES (
'1', '1', '1'
);

INSERT INTO `head_plugin_rights` (
`HPLID` ,
`GID`,
`Y_N`
)
VALUES (
'1', '2', '1'
);

INSERT INTO `head_plugin_rights` (
`HPLID` ,
`GID`,
`Y_N`
)
VALUES (
'1', '3', '1'
);

INSERT INTO `head_plugin_rights` (
`HPLID` ,
`GID`,
`Y_N`
)
VALUES (
'1', '4', '1'
);

INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'1', '1', '1'
);

INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'1', '2', '1'
);

INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'1', '3', '1'
);

INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'1', '4', '1'
);

INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'2', '1', '1'
);

INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'3', '1', '0'
);


INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'3', '2', '1'
);

INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'3', '3', '1'
);

INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'3', '4', '1'
);

INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'4', '1', '1'
);

INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'4', '2', '0'
);

INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'4', '3', '0'
);

INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'4', '4', '0'
);

INSERT INTO `alcms3`.`al_version` (
`name`, 
`definition`, 
`version`) 
VALUES (
'AL-CMS Alpha v0.3', 'This is a Alpha Version.', '0.3'
);
