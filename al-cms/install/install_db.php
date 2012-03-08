<?php
/*
 * AL-CMS -- Gernal Information --
 * 
 * Copyright (C) Dennis Falkenberg (http://www.sunrising-network.de) Email: DFalkenberg@gmx.de
 * 
 * AL-CMS is a free software, you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 *(at your option) any later version.  
 *   
 */

 	include('../data/config/dbcon.php');
 	db_con();
	$install2=mysql_query("
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
");
echo "<br><font color=green>User Table ready!</font>";
	$install3=mysql_query("
CREATE TABLE IF NOT EXISTS `groups` (
  `GID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(45),
  `definition` text,
  PRIMARY KEY (`GID`)
); 
");
echo "<br><font color=green>Group Table ready!</font>";
	$install4=mysql_query("
CREATE TABLE IF NOT EXISTS `plugin_funktion` (
  `PLFID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `funktionsname` varchar(30),
  `data` varchar(100),
  `nf` int(1),
  `definition` text,
  `parent_id` int(1),
  `parent` int(1),
  `aktiv` int(1),
  PRIMARY KEY (`PLFID`)
);
");
echo "<br><font color=green>Plugin_Funktion Table ready!</font>";
	$install5=mysql_query("
CREATE TABLE IF NOT EXISTS `head_plugin_lower_plugin` (
  `HPLID` int(11) UNSIGNED NOT NULL,
  `LPLID` int(11) UNSIGNED NOT NULL
);
");
echo "<br><font color=green>Head_Plugin_Lower_Plugin Table ready!</font>";
	$install6=mysql_query("
CREATE TABLE IF NOT EXISTS `head_plugin_funktion` (
  `HPLID` int(11) UNSIGNED NOT NULL,
  `PLFID` int(11) UNSIGNED NOT NULL
);
");
echo "<br><font color=green>Head_Plugin_Funktion Table ready!</font>";
	$install7=mysql_query("
CREATE TABLE IF NOT EXISTS `lower_plugin_funktion` (
  `LPLID` int(11) UNSIGNED NOT NULL,
  `PLFID` int(11) UNSIGNED NOT NULL
);
");
echo "<br><font color=green>Lower_Plugin_Funktion Table ready!</font>";
	$install8=mysql_query("
CREATE TABLE IF NOT EXISTS `plugin_funktion_rights` (
  `PLFID` int(11) UNSIGNED NOT NULL,
  `GID` int(11) UNSIGNED NOT NULL,
  `Y_N` int(1)
);
"); 
echo "<br><font color=green>Plugin_Funktion_Rights Table ready!</font>";
	$install9=mysql_query("
CREATE TABLE IF NOT EXISTS `design` (
  `DID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(45),
  `data` varchar(100),
  `mobile` int(1),
  `standart` int(1),
  `aktiv` int(1) UNSIGNED NOT NULL,
   PRIMARY KEY (`DID`)
); 
");
echo "<br><font color=green>Design Table ready!</font>";
	$install10=mysql_query("
CREATE TABLE IF NOT EXISTS `design_head_plugin_order` (
  `DID` int(11) UNSIGNED NOT NULL,
  `HPLID` int(11) UNSIGNED NOT NULL
);
");
echo "<br><font color=green>Design_Head_Plugin Table ready!</font>";
	$install11=mysql_query("
CREATE TABLE IF NOT EXISTS `design_lower_plugin_order` (
  `DID` int(11) UNSIGNED NOT NULL,
  `LPLID` int(11) UNSIGNED NOT NULL
);
");
echo "<br><font color=green>Design_Lower_Plugin_Order Table ready!</font>";
	$install12=mysql_query("
CREATE TABLE IF NOT EXISTS `design_plugin_funktion_order` (
  `DID` int(11) UNSIGNED NOT NULL,
  `PLFID` int(11) UNSIGNED NOT NULL
); 
");
echo "<br><font color=green>Design_Plugin_Funktion_Order Table ready!</font>";
	$install13=mysql_query("
CREATE TABLE IF NOT EXISTS `design_mobile_head_plugin_order` (
  `DID` int(11) UNSIGNED NOT NULL,
  `HPLID` int(11) UNSIGNED NOT NULL
);
");
echo "<br><font color=green>Design_Mobile_Head_Plugin_Order Table ready!</font>";
	$install4=mysql_query("
CREATE TABLE IF NOT EXISTS `design_mobile_lower_plugin_order` (
  `DID` int(11) UNSIGNED NOT NULL,
  `LPLID` int(11) UNSIGNED NOT NULL
);
");
echo "<br><font color=green>Design_Mobile_Lower_Plugin_Order Table ready!</font>";
	$install5=mysql_query("
CREATE TABLE IF NOT EXISTS `design_mobile_plugin_funktion_order` (
  `DID` int(11) UNSIGNED NOT NULL,
  `PLFID` int(11) UNSIGNED NOT NULL
); 
");
 echo "<br><font color=green>Design_Mobile_Plugin_Funktion_Order Table ready!</font>";
	$install6=mysql_query("
CREATE TABLE IF NOT EXISTS `panel` (
   `PID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `LPLID` int(11) UNSIGNED NOT NULL,
  `name` varchar(45),
  `data` varchar(80),
  `sp` int(1),
  `aktiv` int(1) UNSIGNED NOT NULL,
   PRIMARY KEY (`PID`)
); 
");
echo "<br><font color=green>Panel Table ready!</font>";
	$install7=mysql_query("
CREATE TABLE IF NOT EXISTS `al_config` (
  `CID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(45),
  `funktion` varchar(100),
  `aktiv` int(1) UNSIGNED NOT NULL,
	PRIMARY KEY (`CID`)
);
"); 
echo "<br><font color=green>AL_Config Table ready!</font>";
	$install8=mysql_query("
CREATE TABLE IF NOT EXISTS `plugin_funktion_meta` (
  `PLFID` int(11) UNSIGNED NOT NULL,
  `metad` varchar(100)
  ); 
");
echo "<br><font color=green>Plugin_Funktion_Meta Table ready!</font>";
	$install9=mysql_query("
CREATE TABLE IF NOT EXISTS `plugin_funktion_title` (
  `PLFID` int(11) UNSIGNED NOT NULL,
  `titled` varchar(100)
  ); 
  ");
echo "<br><font color=green>Plugin_Funktion_Title Table ready!</font>";
	$install20=mysql_query("
CREATE TABLE IF NOT EXISTS `head_plugin_meta` (
  `HPLID` int(11) UNSIGNED NOT NULL,
  `metad` varchar(100)
  ); 
");
echo "<br><font color=green>Head_Plugin_Meta Table ready!</font>";
	$instal21=mysql_query("
CREATE TABLE IF NOT EXISTS `head_plugin_title` (
  `HPLID` int(11) UNSIGNED NOT NULL,
  `titled` varchar(100)
  ); 
  ");
echo "<br><font color=green>Head_Plugin_Title Table ready!</font>";
	$instal22=mysql_query("
CREATE TABLE IF NOT EXISTS `lower_plugin_meta` (
  `LPLID` int(11) UNSIGNED NOT NULL,
  `metad` varchar(100)
  ); 
");
echo "<br><font color=green>Lower_Plugin_Meta Table ready!</font>";
	$install23=mysql_query("
  CREATE TABLE IF NOT EXISTS `lower_plugin_title` (
  `LPLID` int(11) UNSIGNED NOT NULL,
  `titled` varchar(100)
  ); 
");
echo "<br><font color=green>Lower_plugin_Title Table ready!</font>";
	$install24=mysql_query("
CREATE TABLE IF NOT EXISTS `head_plugin_rights` (
	`HPLID` int(11) UNSIGNED NOT NULL,
  `GID` int(11) UNSIGNED NOT NULL,
  `Y_N` int(1)
); 
");
echo "<br><font color=green>Head_Plugin_Rights Table ready!</font>";
	$install25=mysql_query("
CREATE TABLE IF NOT EXISTS `lower_plugin_rights` (
	`LPLID` int(11) UNSIGNED NOT NULL,
  `GID` int(11) UNSIGNED NOT NULL,
  `Y_N` int(1)
); 
");
echo "<br><font color=green>Lower_Plugin_Rights Table ready!</font>";
	$install26=mysql_query("
CREATE TABLE IF NOT EXISTS `head_plugins` (
  `HPLID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(45),
  `data` varchar(100),
  `definition` text,
  `sysp` int(1) NOT NULL,
  `aktiv` int(1) NOT NULL,
  PRIMARY KEY (`HPLID`)
); 
");
echo "<br><font color=green>Head_Plugins Table ready!</font>";
	$install27=mysql_query("
CREATE TABLE IF NOT EXISTS `lower_plugins` (
  `LPLID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(45),
  `data` varchar(100),
  `definition` text,
  `aktiv` int(1) NOT NULL,
  PRIMARY KEY (`LPLID`)
); 
");
echo "<br><font color=green>User Table ready!</font>";
	$install28=mysql_query("
CREATE TABLE IF NOT EXISTS `al_version` (
  `name` varchar(45) NOT NULL,
  `definition` text,
  `version` varchar(40) NOT NULL
); ");
$instalpmh=mysql_query("
CREATE TABLE IF NOT EXISTS `panel_menu_head` (
  `PMHID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(45),
   PRIMARY KEY (`PMHID`)
);
");
$installpmhh=mysql_query("
CREATE TABLE IF NOT EXISTS `panel_menu_head_hp` (
  `PMHID` int(11) UNSIGNED NOT NULL,
  `name` varchar(45),
  `url` varchar(50) NOT NULL,
  `class` varchar(20)
);
"); 
$installpmhp=mysql_query("
CREATE TABLE IF NOT EXISTS `panel_menu_head_plugin` (
  `PMHID` int(11) UNSIGNED NOT NULL,
  `LPLID` int(11) UNSIGNED NOT NULL
); 
");
$installpg=mysql_query("
CREATE TABLE IF NOT EXISTS `panel_group` (
  `PID` int(11) UNSIGNED NOT NULL,
  `GID` int(11) UNSIGNED NOT NULL
);
");
$installpp=mysql_query("
CREATE TABLE IF NOT EXISTS `panel_plf` (
  `PPLFID` int(11) UNSIGNED NOT NULL,
  `name` varchar(45),
  `data` varchar(50) NOT NULL,
  `funktion` varchar(50) NOT NULL
);
");
$installppo=mysql_query("
CREATE TABLE IF NOT EXISTS `panel_plf_order` (
`PLFID` int(11) UNSIGNED NOT NULL,
`PPLFID` int(11) UNSIGNED NOT NULL
);
");
echo "<br><font color=green>AL_Version Table ready!</font>";
echo "<br><font color=green>Tables are all ready!<br>------------------------------<p></font>";
	$install29=mysql_query("
ALTER TABLE user 
add foreign key (GID) REFERENCES groups (GID) ON DELETE cascade ON UPDATE cascade;
");
	$install30=mysql_query("
ALTER TABLE head_plugin_rights
add foreign key (GID) REFERENCES groups (GID) ON DELETE cascade ON UPDATE cascade;
");
	$install31=mysql_query("

ALTER TABLE lower_plugin_rights
add foreign key (GID) REFERENCES groups (GID) ON DELETE cascade ON UPDATE cascade;
");
	$install32=mysql_query("

ALTER TABLE head_plugin_rights
add foreign key (HPLID) REFERENCES head_plugins (HPLID)ON DELETE cascade ON UPDATE cascade;
");
	$install33=mysql_query("

ALTER TABLE lower_plugin_rights
add foreign key (LPLID) REFERENCES lower_plugins (LPLID)ON DELETE cascade ON UPDATE cascade;
");
	$install34=mysql_query("

ALTER TABLE head_plugin_funktion
add foreign key (HPLID) REFERENCES head_plugins (HPLID) ON DELETE cascade ON UPDATE cascade;
");
	$install35=mysql_query("

ALTER TABLE head_plugin_funktion
add foreign key (PLFID) REFERENCES plugin_funktion (PLFID) ON DELETE cascade ON UPDATE cascade;
");
	$install36=mysql_query("

ALTER TABLE lower_plugin_funktion
add foreign key (LPLID) REFERENCES lower_plugins (LPLID) ON DELETE cascade ON UPDATE cascade;
");
	$install37=mysql_query("

ALTER TABLE lower_plugin_funktion
add foreign key (PLFID) REFERENCES plugin_funktion (PLFID) ON DELETE cascade ON UPDATE cascade;
");
	$install38=mysql_query("

ALTER TABLE plugin_funktion_rights
add foreign key (GID) REFERENCES groups (GID) ON DELETE cascade ON UPDATE cascade;
");
	$install39=mysql_query("

ALTER TABLE plugin_funktion_rights
add foreign key (PLFID) REFERENCES plugin_funktion (PLFID) ON DELETE cascade ON UPDATE cascade;
");
	$install40=mysql_query("

ALTER TABLE head_plugin_title
add foreign key (HPLID) REFERENCES head_plugins (HPLID) ON DELETE cascade ON UPDATE cascade;
");
	$install50=mysql_query("

ALTER TABLE head_plugin_meta
add foreign key (HPLID) REFERENCES head_plugins (HPLID) ON DELETE cascade ON UPDATE cascade;
");
	$install51=mysql_query("
ALTER TABLE lower_plugin_title
add foreign key (LPLID) REFERENCES lower_plugins (LPLID) ON DELETE cascade ON UPDATE cascade;
");
	$install52=mysql_query("

ALTER TABLE lower_plugin_meta
add foreign key (LPLID) REFERENCES lower_plugins (LPLID) ON DELETE cascade ON UPDATE cascade;
");
	$install53=mysql_query("

ALTER TABLE plugin_funktion_title
add foreign key (PLFID) REFERENCES plugin_funktion (PLFID) ON DELETE cascade ON UPDATE cascade;
");
	$install54=mysql_query("

ALTER TABLE plugin_funktion_meta
add foreign key (PLFID) REFERENCES plugin_funktion (PLFID) ON DELETE cascade ON UPDATE cascade;
");
	$install55=mysql_query("

ALTER TABLE design_head_plugin_order
add foreign key (DID) REFERENCES design (DID) ON DELETE cascade ON UPDATE cascade;
");
	$install56=mysql_query("

ALTER TABLE design_head_plugin_order
add foreign key (HPLID) REFERENCES head_plugins (HPLID) ON DELETE cascade ON UPDATE cascade;
");
	$install57=mysql_query("

ALTER TABLE design_lower_plugin_order
add foreign key (DID) REFERENCES design (DID) ON DELETE cascade ON UPDATE cascade;
");
	$install58=mysql_query("

ALTER TABLE design_lower_plugin_order
add foreign key (LPLID) REFERENCES lower_plugins (LPLID) ON DELETE cascade ON UPDATE cascade;
");
	$install59=mysql_query("

ALTER TABLE design_plugin_funktion_order
add foreign key (DID) REFERENCES design (DID) ON DELETE cascade ON UPDATE cascade;
");
	$install60=mysql_query("

ALTER TABLE design_plugin_funktion_order
add foreign key (PLFID) REFERENCES plugin_funktion (PLFID) ON DELETE cascade ON UPDATE cascade;
");
	$install61=mysql_query("

ALTER TABLE design_mobile_head_plugin_order
add foreign key (DID) REFERENCES design (DID) ON DELETE cascade ON UPDATE cascade;
");
	$install62=mysql_query("
ALTER TABLE design_mobile_head_plugin_order
add foreign key (HPLID) REFERENCES head_plugins (HPLID) ON DELETE cascade ON UPDATE cascade;
");
	$install63=mysql_query("

ALTER TABLE design_mobile_lower_plugin_order
add foreign key (DID) REFERENCES design (DID) ON DELETE cascade ON UPDATE cascade;
");
	$install64=mysql_query("

ALTER TABLE design_mobile_lower_plugin_order
add foreign key (LPLID) REFERENCES lower_plugins (LPLID) ON DELETE cascade ON UPDATE cascade;
");
	$install65=mysql_query("

ALTER TABLE design_mobile_plugin_funktion_order
add foreign key (DID) REFERENCES design (DID) ON DELETE cascade ON UPDATE cascade;
");
	$install66=mysql_query("

ALTER TABLE design_mobile_plugin_funktion_order
add foreign key (PLFID) REFERENCES plugin_funktion (PLFID) ON DELETE cascade ON UPDATE cascade;
");
	$install67=mysql_query("

ALTER TABLE head_plugin_lower_plugin
add foreign key (HPLID) REFERENCES head_plugins (HPLID) ON DELETE cascade ON UPDATE cascade;
");
	$install68=mysql_query("

ALTER TABLE head_plugin_lower_plugin
add foreign key (LPLID) REFERENCES lower_plugins (LPLID) ON DELETE cascade ON UPDATE cascade;
");
	$install69=mysql_query("
INSERT INTO `groups` (
`name` ,
`definition`
)
VALUES (
'anonym', 'Anonymer User der noch uneingeloggt ist.'
);
");
	$install70=mysql_query("

INSERT INTO `groups` (
`name` ,
`definition`
)
VALUES (
'user', 'Normaler user.'
);
");
	$install71=mysql_query("

INSERT INTO `groups` (
`name` ,
`definition`
)
VALUES (
'mod', 'Moderator'
);
");
	$install72=mysql_query("

INSERT INTO `groups` (
`name` ,
`definition`
)
VALUES (
'admin', 'Administrator'
);
");
	$install73=mysql_query("

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
");
	$install74=mysql_query("

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
");
	$install75=mysql_query("

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
");
	$install76=mysql_query("

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
");
	$install77=mysql_query("

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
");
	$install78=mysql_query("

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
");
	$install79=mysql_query("

INSERT INTO `head_plugin_funktion` (
`HPLID`,
`PLFID`
)
VALUES (
'1', '1'
);
");
	$install80=mysql_query("

INSERT INTO `head_plugin_funktion` (
`HPLID`,
`PLFID`
)
VALUES (
'1', '2'
);
");
	$install81=mysql_query("

INSERT INTO `head_plugin_funktion` (
`HPLID`,
`PLFID`
)
VALUES (
'1', '3'
);
");
	$install82=mysql_query("

INSERT INTO `head_plugin_funktion` (
`HPLID`,
`PLFID`
)
VALUES (
'1', '4'
);
");
	$install83=mysql_query("

INSERT INTO `head_plugin_funktion` (
`HPLID`,
`PLFID`
)
VALUES (
'1', '5'
);
");
	$install84=mysql_query("


INSERT INTO `head_plugin_rights` (
`HPLID` ,
`GID`,
`Y_N`
)
VALUES (
'1', '1', '1'
);
");
	$install85=mysql_query("

INSERT INTO `head_plugin_rights` (
`HPLID` ,
`GID`,
`Y_N`
)
VALUES (
'1', '2', '1'
);
");
	$install86=mysql_query("

INSERT INTO `head_plugin_rights` (
`HPLID` ,
`GID`,
`Y_N`
)
VALUES (
'1', '3', '1'
);
");
	$install87=mysql_query("

INSERT INTO `head_plugin_rights` (
`HPLID` ,
`GID`,
`Y_N`
)
VALUES (
'1', '4', '1'
);
");
	$install88=mysql_query("

INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'1', '1', '1'
);
");
	$install89=mysql_query("

INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'1', '2', '1'
);
");
$install90=mysql_query("
INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'1', '3', '1'
);
");
$install91=mysql_query("
INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'1', '4', '1'
);
");
$install92=mysql_query("
INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'2', '1', '1'
);
");
$install93=mysql_query("
INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'3', '1', '0'
);
");
$install94=mysql_query("
INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'3', '2', '1'
);
");
$install95=mysql_query("
INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'3', '3', '1'
);
");
$install96=mysql_query("
INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'3', '4', '1'
);
");
$install97=mysql_query("
INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'4', '1', '1'
);
");
$install98=mysql_query("
INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'4', '2', '0'
);
");
$install99=mysql_query("
INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'4', '3', '0'
);
");
$install100=mysql_query("
INSERT INTO `plugin_funktion_rights` (
`PLFID` ,
`GID`,
`Y_N`
)
VALUES (
'4', '4', '0'
);
");
$install101=mysql_query("
INSERT INTO `al_version` (
`name`, 
`definition`, 
`version`) 
VALUES (
'AL-CMS Alpha v0.0.3', 'This is a Alpha Version.', '0.0.3'
);
");
 echo "<font color=green>Database ready!</font>";
echo '<form method="post" action="'; print $_SERVER['PHP_SELF']; echo'">';
	echo '
		<input type="submit" value="Go" name="senttings">
		</form>
'; 
 ?>