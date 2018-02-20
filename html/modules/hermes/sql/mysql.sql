CREATE TABLE `her_archive` (
  `idArchive` bigint(20) NOT NULL auto_increment,
  `idLettre` bigint(20) NOT NULL default '0',
  `nom` varchar(30) default NULL,
  `libelle` varchar(80) default NULL,
  `chemin` longtext,
  `nomFichier` varchar(250) default NULL,
  `cheminArchivage` varchar(255) default NULL,
  `delaiArchivage` int(10) unsigned default '12',
  `noteCumulee` int(10) unsigned default '0',
  `noteNombre` int(10) unsigned default '0',
  `noteMoyenne` float default '0',
  `dateParution` datetime default NULL,
  `mode` int(10) unsigned default '0',
  `envois` int(10) unsigned default '0',
  `groupes` varchar(80) NOT NULL default '',
  `chronoArchive` bigint(20) NOT NULL default '0',
  `test` tinyint(1) unsigned default '0',
  PRIMARY KEY  (`idArchive`,`idLettre`)
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_archive`
##

INSERT INTO `her_archive` (`idArchive`, `idLettre`, `nom`, `libelle`, `chemin`, `nomFichier`, `cheminArchivage`, `delaiArchivage`, `noteCumulee`, `noteNombre`, `noteMoyenne`, `dateParution`, `mode`, `envois`, `groupes`, `chronoArchive`, `test`) VALUES
(64, 12, 'Hermes - v 4.00', 'Présentation des nouvelles fonctionalités de Hermes copy', NULL, 'Hermes - v 4.00_12_2008-06-19_11-06-55.html', '', 12, 0, 0, 0, '2008-06-19 11:06:55', 3, 0, '0,1,5,0', 1, 1);

## ########################################################

##
## Structure de la table `her_bonus`
##

CREATE TABLE `her_bonus` (
  `idListe` int(10) unsigned NOT NULL auto_increment,
  `liste` text,
  `nom` varchar(60) default NULL,
  PRIMARY KEY  (`idListe`)
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_bonus`
##

INSERT INTO `her_bonus` (`idListe`, `liste`, `nom`) VALUES
(1, 'blogphil@free.fr\r\nlilou@kiolo.com\r\njjdelalandre@gmail.com', 'testHTML'),
(2, 'lilou@kiolo.com\r\njjdelalandre@gmail.com\r\njjd@kiolo.com\r\nshinai@kiolo.com\r\njjdelalandre@wanadoo.fr\r\neparcyl92@gmail.com\r\nbesatanas@gmail.com', 'jjd');

## ########################################################

##
## Structure de la table `her_cession`
##

CREATE TABLE `her_cession` (
  `idCession` bigint(20) NOT NULL auto_increment,
  `idLettre` bigint(20) default NULL,
  `idArchive` bigint(20) default NULL,
  `fullNameArchive` varchar(255) default NULL,
  `libelle` varchar(255) default NULL,
  `personnalisable` tinyint(3) unsigned default NULL,
  `nbDestinataire` int(10) unsigned default NULL,
  `lot` int(10) unsigned default '3',
  `listeComplementaire` longtext,
  `listeComplementaire2` longtext,
  `countListeComplementaire` int(10) unsigned default '0',
  `emailSender` varchar(60) NOT NULL default '',
  PRIMARY KEY  (`idCession`)
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_cession`
##


## ########################################################

##
## Structure de la table `her_deco`
##

CREATE TABLE `her_deco` (
  `idDeco` bigint(20) NOT NULL auto_increment,
  `name` varchar(60) NOT NULL default '',
  `decoModele` varchar(60) NOT NULL default '',
  PRIMARY KEY  (`idDeco`)
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_deco`
##

INSERT INTO `her_deco` (`idDeco`, `name`, `decoModele`) VALUES
(4, 'Sondage jaune', 'frame'),
(2, 'inverse', 'frame'),
(3, 'Titre principal', 'bandeau'),
(35, 'qqqq inverse', 'frame'),
(6, 'defilement', 'marquee'),
(7, 'bleu simple', 'frame'),
(8, 'block d''entete', 'frame'),
(34, 'Sondage', 'frame'),
(11, 'bleu simple copy', 'frame'),
(12, 'terre', 'hRow'),
(20, 'Logo-Hermes', 'image'),
(21, 'Terres', 'image');

## ########################################################

##
## Structure de la table `her_decomodele`
##

CREATE TABLE `her_decomodele` (
  `decoModele` varchar(60) NOT NULL default '',
  `property` varchar(60) NOT NULL default '',
  `typeName` varchar(30) NOT NULL default '',
  `rupture` tinyint(4) NOT NULL default '0',
  `ordre` int(11) NOT NULL default '0',
  `params` varchar(255) NOT NULL default '',
  `defaut` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`decoModele`,`property`)
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_decomodele`
##

INSERT INTO `her_decomodele` (`decoModele`, `property`, `typeName`, `rupture`, `ordre`, `params`, `defaut`) VALUES
('frame', 'alignement', 'list', 0, 50, 'left|center|right', ''),
('frame', 'borderWidth', 'spin', 0, 20, '0|16', '1'),
('frame', 'borderColorDark', 'color', 0, 30, '', ''),
('hRow', 'imgFrise', 'image', 0, 30, 'frise', ''),
('image', 'frame', 'frame', 99, 999, '', '0'),
('image', 'link5', 'text', 5, 503, '', ''),
('image', 'repetition5', 'spin', 5, 502, '1|16', '1'),
('image', 'alerte5', 'text', 5, 501, '', ''),
('image', 'image5', 'image', 5, 500, 'frise', ''),
('image', 'link4', 'text', 4, 403, '', ''),
('image', 'repetition4', 'spin', 4, 402, '1|16', '1'),
('image', 'alerte4', 'text', 4, 401, '', ''),
('image', 'image4', 'image', 4, 400, 'frise', ''),
('image', 'link3', 'text', 3, 303, '', ''),
('image', 'repetition3', 'spin', 3, 302, '1|16', '1'),
('image', 'alerte3', 'text', 3, 301, '', ''),
('bandeau', 'height', 'spin', 0, 11, '0|200', '0'),
('bandeau', 'alignement', 'list', 0, 12, 'left|center|right', 'left'),
('bandeau', 'bgColor', 'color', 0, 13, '', ''),
('bandeau', 'image', 'image', 0, 14, '', ''),
('bandeau', 'borderColorLight', 'color', 0, 20, '', ''),
('flagH', 'width', 'text', 0, 8, '', '650px'),
('flagH', 'alignement', 'list', 0, 9, 'left|center|right', 'center'),
('flagH', 'height1', 'spin', 0, 10, '0|16', '1'),
('flagV', 'bgColor4', 'color', 0, 41, '', ''),
('flagV', 'bgColor3', 'color', 0, 31, '', ''),
('flagV', 'height', 'spin', 0, 1, '0|255', '32'),
('flagV', 'width', 'text', 0, 2, '', '100%'),
('marquee', 'fontItalic', 'yesno', 0, 120, '', '0'),
('marquee', 'behavior', 'list', 0, 10, 'slide|alternate', 'slide'),
('marquee', 'direction', 'list', 0, 20, 'right|left|down|up', 'right'),
('marquee', 'height', 'spin', 0, 30, '0|300', ''),
('marquee', 'loop', 'spin', 0, 40, '0|100', '0'),
('image', 'image3', 'image', 3, 300, 'frise', ''),
('image', 'link2', 'text', 2, 203, '', ''),
('image', 'repetition2', 'spin', 2, 202, '1|16', '1'),
('flagH', 'bgColor4', 'color', 0, 41, '', ''),
('flagV', 'bgColor5', 'color', 0, 51, '', ''),
('frame', 'borderColorLight', 'color', 0, 40, '', ''),
('marquee', 'frame', 'frame', 0, 130, '', '0'),
('bandeau', 'width', 'text', 0, 10, '', '100%'),
('flagH', 'height3', 'spin', 0, 30, '0|16', '1'),
('flagV', 'fontName', 'text', 0, 60, '', ''),
('bandeau', 'fontName', 'text', 0, 60, '', ''),
('image', 'image2', 'image', 2, 200, 'frise', ''),
('bandeau', 'fontColor', 'color', 0, 80, '', ''),
('bandeau', 'fontSize', 'fontSize', 0, 70, '', ''),
('flagH', 'bgColor3', 'color', 0, 31, '', ''),
('flagH', 'height4', 'spin', 0, 40, '0|16', '1'),
('flagV', 'fontColor', 'color', 0, 80, '', ''),
('flagV', 'fontBold', 'yesno', 0, 90, '', '1'),
('flagV', 'fontSize', 'fontSize', 0, 70, '', ''),
('hardtext', 'type', 'list', 0, 2, '|css|html|text', ''),
('image', 'alerte2', 'text', 2, 201, '', ''),
('image', 'link1', 'text', 1, 103, '', ''),
('image', 'repetition1', 'spin', 1, 102, '1|16', '1'),
('image', 'alerte1', 'text', 1, 101, '', ''),
('image', 'image1', 'image', 1, 100, 'frise', ''),
('marquee', 'fontName', 'text', 0, 80, '', ''),
('marquee', 'bgcolor', 'color', 0, 70, '', '0'),
('marquee', 'scrolldelay', 'spin', 0, 50, '0|100', '10'),
('marquee', 'width', 'spin', 0, 60, '0|600', '0'),
('bandeau', 'borderColorDark', 'color', 0, 20, '', ''),
('bandeau', 'borderWidth', 'spin', 0, 30, '0|16', '0'),
('bandeau', 'fontAlignement', 'list', 0, 60, 'left|center|right', 'left'),
('flagH', 'bgColor2', 'color', 0, 21, '', ''),
('flagH', 'height2', 'spin', 0, 20, '0|16', '1'),
('flagH', 'bgColor1', 'color', 0, 11, '', ''),
('flagV', 'bgColor1', 'color', 0, 11, '', ''),
('flagV', 'alignement', 'list', 0, 3, 'left|center|right', 'center'),
('flagV', 'bgColor2', 'color', 0, 21, '', ''),
('frame', 'width', 'text', 0, 60, '', ''),
('frame', 'bgColor', 'color', 0, 10, '', ''),
('hardtext', 'content', 'multiline', 0, 1, '12', ''),
('hRow', 'drawWidth', 'spin', 0, 20, '0|16', '0'),
('hRow', 'color', 'color', 0, 10, '', ''),
('image', 'intervale', 'enum', 99, 910, 'Images horizontales jointes|Images horizontales disjointes|Images verticales jointes|Images verticales disjointes', '0'),
('marquee', 'fontColor', 'color', 0, 100, '', ''),
('marquee', 'fontBold', 'yesno', 0, 100, '', '1'),
('marquee', 'fontSize', 'fontSize', 0, 90, '', ''),
('bandeau', 'fontBold', 'yesno', 0, 90, '', '1'),
('bandeau', 'fontItalic', 'yesno', 0, 100, '', '0'),
('flagH', 'height5', 'spin', 0, 50, '0|16', '1'),
('flagH', 'bgColor5', 'color', 0, 51, '', ''),
('flagV', 'fontItalic', 'yesno', 0, 100, '', '0'),
('frame', 'incrustation', 'spin', 0, 70, '0|16', '0');

## ########################################################

##
## Structure de la table `her_decopp`
##

CREATE TABLE `her_decopp` (
  `idDecopp` bigint(20) NOT NULL auto_increment,
  `idDeco` bigint(20) NOT NULL default '0',
  `property` varchar(60) NOT NULL default '',
  `value` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`idDecopp`)
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_decopp`
##

INSERT INTO `her_decopp` (`idDecopp`, `idDeco`, `property`, `value`) VALUES
(355, 4, 'incrustation', '2'),
(354, 4, 'width', '100%'),
(353, 4, 'alignement', 'left'),
(352, 4, 'borderColorLight', 'FF0000'),
(351, 4, 'borderColorDark', '0066FF'),
(350, 4, 'borderWidth', '3'),
(348, 2, 'incrustation', '3'),
(347, 2, 'width', '100%'),
(346, 2, 'alignement', 'center'),
(345, 2, 'borderColorLight', '0000CC'),
(344, 2, 'borderColorDark', '0066FF'),
(343, 2, 'borderWidth', '2'),
(333, 8, 'width', '700px'),
(371, 3, 'fontItalic', '0'),
(370, 3, 'fontBold', '1'),
(369, 3, 'fontColor', '996600'),
(368, 3, 'fontSize', '6'),
(367, 3, 'fontName', ''),
(366, 3, 'fontAlignement', 'right'),
(365, 3, 'borderWidth', '0'),
(364, 3, 'borderColorLight', 'COLOR'),
(363, 3, 'borderColorDark', 'COLOR'),
(362, 3, 'image', 'frise/sunbannA.gif'),
(361, 3, 'bgColor', '000099'),
(360, 3, 'alignement', 'center'),
(359, 3, 'width', '100%'),
(342, 2, 'bgColor', '00FF99'),
(349, 4, 'bgColor', 'FFFF99'),
(709, 35, 'incrustation', '-8'),
(708, 35, 'width', '600px'),
(707, 35, 'alignement', '2'),
(706, 35, 'borderColorDark', '0066FF'),
(705, 35, 'borderColorLight', '0000CC'),
(704, 35, 'borderWidth', '2'),
(334, 8, 'incrustation', '5'),
(327, 6, 'frame', '7'),
(325, 6, 'fontBold', '1'),
(326, 6, 'fontItalic', '1'),
(324, 6, 'fontColor', '0000FF'),
(323, 6, 'fontSize', '6'),
(322, 6, 'fontName', ''),
(313, 7, 'width', '100%'),
(310, 7, 'borderColorDark', '0066FF'),
(311, 7, 'borderColorLight', '0000CC'),
(312, 7, 'alignement', 'left'),
(309, 7, 'borderWidth', '1'),
(308, 7, 'bgColor', '66FFFF'),
(332, 8, 'alignement', 'center'),
(331, 8, 'borderColorLight', 'FF0000'),
(330, 8, 'borderColorDark', '0066FF'),
(329, 8, 'borderWidth', '1'),
(328, 8, 'bgColor', 'CC99FF'),
(702, 34, 'incrustation', '3'),
(701, 34, 'width', '600px'),
(700, 34, 'alignement', '2'),
(699, 34, 'borderColorDark', '0066FF'),
(698, 34, 'borderColorLight', 'FF0000'),
(697, 34, 'borderWidth', '3'),
(703, 35, 'bgColor', '00FF99'),
(321, 6, 'bgcolor', '000000'),
(320, 6, 'width', '0'),
(319, 6, 'scrolldelay', '10'),
(318, 6, 'loop', '0'),
(314, 7, 'incrustation', '1'),
(317, 6, 'height', ''),
(315, 6, 'behavior', 'alternate'),
(316, 6, 'direction', 'left'),
(307, 11, 'incrustation', '1'),
(306, 11, 'width', '100%'),
(305, 11, 'alignement', 'left'),
(304, 11, 'borderColorLight', '0000CC'),
(303, 11, 'borderColorDark', '0066FF'),
(302, 11, 'borderWidth', '1'),
(301, 11, 'bgColor', 'COLOR'),
(356, 12, 'color', 'COLOR'),
(357, 12, 'drawWidth', '0'),
(358, 12, 'imgFrise', 'ligne/ligne_terre002.gif'),
(696, 34, 'bgColor', '33FFFF'),
(580, 20, 'intervale', '0'),
(579, 20, 'link5', ''),
(578, 20, 'repetition5', '1'),
(577, 20, 'alerte5', ''),
(576, 20, 'image5', ''),
(575, 20, 'link4', ''),
(574, 20, 'repetition4', '1'),
(573, 20, 'alerte4', ''),
(572, 20, 'image4', ''),
(571, 20, 'link3', ''),
(570, 20, 'repetition3', '1'),
(569, 20, 'alerte3', ''),
(568, 20, 'image3', ''),
(567, 20, 'link2', ''),
(566, 20, 'repetition2', '1'),
(565, 20, 'alerte2', ''),
(564, 20, 'image2', ''),
(562, 20, 'repetition1', '1'),
(563, 20, 'link1', 'http://xoops.kiolo.com'),
(561, 20, 'alerte1', ''),
(560, 20, 'image1', 'caducee2a.gif'),
(632, 21, 'repetition4', '1'),
(631, 21, 'alerte4', ''),
(630, 21, 'image4', ''),
(629, 21, 'link3', ''),
(628, 21, 'repetition3', '1'),
(627, 21, 'alerte3', ''),
(626, 21, 'image3', ''),
(625, 21, 'link2', ''),
(624, 21, 'repetition2', '1'),
(623, 21, 'alerte2', ''),
(622, 21, 'image2', ''),
(581, 20, 'frame', '2'),
(621, 21, 'link1', 'http://frxoops.org'),
(620, 21, 'repetition1', '2'),
(619, 21, 'alerte1', ''),
(618, 21, 'image1', 'ligne/ligne_terre002.gif'),
(633, 21, 'link4', ''),
(634, 21, 'image5', ''),
(635, 21, 'alerte5', ''),
(636, 21, 'repetition5', '1'),
(637, 21, 'link5', ''),
(638, 21, 'intervale', '0'),
(639, 21, 'frame', '0');

## ########################################################

##
## Structure de la table `her_element`
##

CREATE TABLE `her_element` (
  `idElement` bigint(20) NOT NULL default '0',
  `nom` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`idElement`)
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_element`
##

INSERT INTO `her_element` (`idElement`, `nom`) VALUES
(0, 'system'),
(1, 'Plugin'),
(2, 'Texte'),
(4, 'Bannners');

## ########################################################

##
## Structure de la table `her_fluxrss`
##

CREATE TABLE `her_fluxrss` (
  `idFluxrss` bigint(20) NOT NULL auto_increment,
  `nom` varchar(255) NOT NULL default '',
  `url` varchar(255) default NULL,
  `description` varchar(255) default NULL,
  `colonnes` varchar(255) default NULL,
  `max` int(10) unsigned default NULL,
  `options` bigint(20) unsigned default NULL,
  PRIMARY KEY  (`idFluxrss`)
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_fluxrss`
##

INSERT INTO `her_fluxrss` (`idFluxrss`, `nom`, `url`, `description`, `colonnes`, `max`, `options`) VALUES
(1, 'Documentation Fr', 'http://www.ladocumentationfrancaise.fr/catalogue/rss/droit-institutions.xml', 'Documentation francaise', 'author,description,pubDate', 5, 2),
(2, 'Conv. collectives', 'http://www.ladocumentationfrancaise.fr/catalogue/rss/conventions-collectives.xml', 'Conventions collectves', 'title', 12, 1),
(3, 'Xul', 'http://www.xul.fr/rss/rss.xml', 'Xul', 'title,author,description', 0, 1);

## ########################################################

##
## Structure de la table `her_frame`
##

CREATE TABLE `her_frame` (
  `idFrame` bigint(20) NOT NULL auto_increment,
  `nom` varchar(80) NOT NULL default '',
  `bgColor` varchar(7) default NULL,
  `borderWidth` int(10) unsigned default '0',
  `borderColorLight` varchar(7) default NULL,
  `borderColorDark` varchar(7) default NULL,
  `alignement` int(10) unsigned default '2',
  `width` varchar(5) default '100',
  `incrustation` int(11) default '0',
  PRIMARY KEY  (`idFrame`)
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_frame`
##

INSERT INTO `her_frame` (`idFrame`, `nom`, `bgColor`, `borderWidth`, `borderColorLight`, `borderColorDark`, `alignement`, `width`, `incrustation`) VALUES
(1, 'Sondage', '33FFFF', 3, 'FF0000', '0066FF', 2, '600px', 3),
(3, 'qqqq inverse', '00FF99', 2, '0000CC', '0066FF', 2, '600px', -8);

## ########################################################

##
## Structure de la table `her_groupe`
##

CREATE TABLE `her_groupe` (
  `idGroupe` bigint(20) NOT NULL default '0',
  `idLettre` bigint(20) default NULL
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_groupe`
##

INSERT INTO `her_groupe` (`idGroupe`, `idLettre`) VALUES
(5, 5),
(8, 1),
(1, 1),
(3, 3),
(2, 3),
(1, 3),
(1, 5),
(5, 12),
(1, 12);

## ########################################################

##
## Structure de la table `her_lecture`
##

CREATE TABLE `her_lecture` (
  `idLettre` bigint(20) NOT NULL default '0',
  `idArchive` bigint(20) NOT NULL default '0',
  `idUser` bigint(20) NOT NULL default '0',
  `dateLecture` int(10) NOT NULL default '0',
  `compteur` tinyint(4) NOT NULL default '1',
  `quantieme` int(10) NOT NULL default '0',
  `flag` tinyint(4) NOT NULL default '0',
  `email` varchar(60) NOT NULL default '',
  `ip` varchar(25) NOT NULL default '',
  KEY `hermes_lecture` (`idArchive`,`email`)
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_lecture`
##

INSERT INTO `her_lecture` (`idLettre`, `idArchive`, `idUser`, `dateLecture`, `compteur`, `quantieme`, `flag`, `email`, `ip`) VALUES
(1, 38, 1, 1210425684, 1, 1, 1, 'jjd@kiolo.com', '83.114.229.186'),
(1, 38, 1, 1210425687, 1, 1, 1, 'jjd@kiolo.com', '83.114.229.186'),
(1, 38, 1, 1210425688, 1, 1, 1, 'jjd@kiolo.com', '83.114.229.186'),
(1, 38, 2217, 1210425733, 1, 1, 1, 'hermes@kiolo.com', '83.114.229.186'),
(1, 37, 2, 1210425738, 1, 1, 1, 'jjd@kiolo.com', '83.114.229.186'),
(1, 37, 6, 1210425739, 1, 1, 1, 'jjd@kiolo.com', '83.114.229.186'),
(1, 39, 2, 1210425750, 1, 1, 1, 'jjd@kiolo.com', '83.114.229.186'),
(1, 39, 1, 1210425751, 1, 1, 1, 'jjd@kiolo.com', '83.114.229.186'),
(1, 39, 6, 1210425753, 1, 1, 1, 'jjd@kiolo.com', '83.114.229.186'),
(1, 39, 2217, 1210425756, 1, 1, 1, 'hermes@kiolo.com', '83.114.229.186'),
(1, 39, 2217, 1210425837, 1, 1, 1, 'hermes@kiolo.com', '83.114.229.186'),
(1, 40, 2217, 1210425838, 1, 1, 1, 'hermes@kiolo.com', '83.114.229.186'),
(1, 40, 1, 1210425840, 1, 1, 1, 'jjd@kiolo.com', '83.114.229.186'),
(1, 40, 2217, 1210425841, 1, 1, 1, 'hermes@kiolo.com', '83.114.229.186'),
(1, 40, 1, 1210425842, 1, 1, 1, 'jjd@kiolo.com', '83.114.229.186'),
(1, 40, 2217, 1210425843, 1, 1, 1, 'hermes@kiolo.com', '83.114.229.186'),
(1, 40, 1, 1210425844, 1, 1, 1, 'jjd@kiolo.com', '83.114.229.186'),
(1, 41, 2217, 1210426208, 1, 1, 1, 'hermes@kiolo.com', '83.114.229.186'),
(1, 41, 2217, 1210426249, 1, 1, 1, 'hermes@kiolo.com', '83.114.229.186'),
(1, 41, 2217, 1210426371, 1, 1, 1, 'hermes@kiolo.com', '83.114.229.186'),
(1, 41, 1, 1210426576, 1, 1, 1, 'jjd@kiolo.com', '83.114.229.186'),
(1, 41, 1, 1210426576, 1, 1, 1, 'jjd@kiolo.com', '83.114.229.186'),
(1, 41, 1, 1210427792, 1, 1, 1, 'jjd@kiolo.com', '83.114.229.186'),
(1, 39, 2217, 1210455944, 1, 1, 1, 'hermes@kiolo.com', '83.114.229.186'),
(2, 32, 25, 1210663273, 1, 7, 1, 'jean-jacques.delalandre@amj-groupe.com', '83.206.81.161'),
(2, 31, 25, 1210663279, 1, 7, 1, 'jean-jacques.delalandre@amj-groupe.com', '83.206.81.161'),
(2, 31, 25, 1210663589, 1, 7, 1, 'jean-jacques.delalandre@amj-groupe.com', '83.206.81.161'),
(2, 32, 25, 1210663591, 1, 7, 1, 'jean-jacques.delalandre@amj-groupe.com', '83.206.81.161'),
(12, 64, 0, 1213923910, 1, 1, 0, 'eparcyl92@gmail.com', '87.91.3.80'),
(12, 64, 0, 1213912596, 1, 1, 0, 'besatanas@gmail.com', '62.235.225.222'),
(12, 64, 0, 1213910207, 1, 1, 0, 'jjdelalandre@wanadoo.fr', '82.121.27.175'),
(2, 32, 25, 1210663668, 1, 7, 1, 'jean-jacques.delalandre@amj-groupe.com', '83.206.81.161'),
(2, 31, 25, 1210663669, 1, 7, 1, 'jean-jacques.delalandre@amj-groupe.com', '83.206.81.161'),
(2, 31, 2084, 1210711231, 1, 7, 1, 'patriick@wanadoo.fr', '90.61.37.201'),
(2, 32, 2104, 1210739719, 1, 8, 1, 'webmaster@arabeo.com', '89.59.109.197'),
(12, 64, 0, 1213910177, 1, 1, 0, 'jjd@kiolo.com', '82.121.27.175'),
(2, 31, 2110, 1210786673, 1, 8, 1, 'pierre@sevile.net', '80.236.36.24'),
(2, 42, 2194, 1213338325, 1, 0, 0, 'p.colin@netcourrier.com', '213.56.41.150'),
(2, 31, 2146, 1210928560, 1, 10, 1, 'guismo45@orange.fr', '62.210.228.93'),
(2, 31, 2039, 1210968462, 1, 10, 1, 'kdl@swing.be', '85.201.116.235'),
(2, 43, 2102, 1213199164, 1, 0, 0, 'staline@sovietquebec.net', '205.237.62.134'),
(2, 43, 2185, 1213194482, 1, 0, 0, 'zic.puce@laposte.net', '82.246.225.175'),
(2, 32, 2185, 1213194478, 1, 0, 0, 'zic.puce@laposte.net', '82.246.225.175'),
(2, 42, 2042, 1212871443, 1, 0, 0, 'sem.per@orange.fr', '92.128.92.197'),
(4, 47, 0, 1212489354, 1, 1, 0, 'blogphil@free.fr', '195.167.231.117'),
(4, 46, 0, 1212489007, 1, 1, 0, 'blogphil@free.fr', '195.167.231.117'),
(4, 47, 0, 1212486947, 1, 1, 0, 'jjdelalandre@gmail.com', '83.206.81.161'),
(2, 31, 2213, 1211666680, 1, 18, 1, 'dmetre@gmail.com', '92.128.112.192'),
(2, 32, 2213, 1211666687, 1, 18, 1, 'dmetre@gmail.com', '92.128.112.192'),
(2, 31, 2200, 1211736074, 1, 19, 1, 'francis.drake@aliceadsl.fr', '90.36.254.154'),
(4, 47, 0, 1212486919, 1, 1, 0, 'jjdelalandre@gmail.com', '83.206.81.161'),
(1, 35, 1, 1212085595, 1, 20, 1, 'jjd@kiolo.com', '86.218.82.166'),
(1, 35, 2217, 1212085597, 1, 20, 1, 'hermes@kiolo.com', '86.218.82.166'),
(4, 0, 0, 1212486795, 1, 0, 0, 'jjd@kiolo.com', '83.206.81.161'),
(4, 0, 0, 1212486532, 1, 0, 0, 'jjd@kiolo.com', '83.206.81.161'),
(4, 0, 0, 1212486249, 1, 0, 0, 'jjd@kiolo.com', '83.206.81.161'),
(4, 45, 0, 1212485993, 1, 1, 0, 'jjdelalandre@gmail.com', '83.206.81.161');

## ########################################################

##
## Structure de la table `her_lettre`
##

CREATE TABLE `her_lettre` (
  `idLettre` bigint(20) NOT NULL auto_increment,
  `nom` varchar(30) NOT NULL default '',
  `libelle` varchar(80) default NULL,
  `description` longtext NOT NULL,
  `idFrame` bigint(20) NOT NULL default '0',
  `avertissement` longtext NOT NULL,
  `periodicite` int(10) unsigned default NULL,
  `jour` int(10) unsigned default NULL,
  `dateParution` datetime default NULL,
  `prochaineParution` datetime default NULL,
  `cheminArchivage` varchar(255) default NULL,
  `delaiArchivage` int(11) default '12',
  `background` varchar(7) default NULL,
  `affichage` int(10) unsigned default '255',
  `personnalisable` int(10) unsigned default '1',
  `feuilleDeStyle` varchar(255) default NULL,
  `idListe` int(10) unsigned NOT NULL default '0',
  `pageWidth` varchar(8) default NULL,
  `bgImg` varchar(50) default NULL,
  `bgImgMode` tinyint(3) unsigned default NULL,
  `bgImgRepeat` tinyint(3) unsigned default NULL,
  `bgImgPosH` tinyint(3) unsigned default NULL,
  `bgImgPosV` tinyint(3) unsigned default NULL,
  `emailSender` varchar(60) NOT NULL default '',
  `idLettreConfirmation` bigint(20) NOT NULL default '0',
  `typeLettre` tinyint(2) NOT NULL default '0',
  `send2Author` tinyint(1) NOT NULL default '0',
  `groupes` varchar(80) NOT NULL default '',
  `idListeTest` bigint(20) NOT NULL default '0',
  `chronoArchive` bigint(20) NOT NULL default '0',
  `statLecture` tinyint(4) NOT NULL default '0',
  `statImg0` varchar(255) NOT NULL default '',
  `statImg1` varchar(255) NOT NULL default '',
  `statImgAlign` tinyint(4) NOT NULL default '1',
  `tplBody` varchar(60) NOT NULL default '',
  `tplHeader` varchar(60) NOT NULL default '',
  `tplFooter` varchar(60) NOT NULL default '',
  PRIMARY KEY  (`idLettre`)
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_lettre`
##

INSERT INTO `her_lettre` (`idLettre`, `nom`, `libelle`, `description`, `idFrame`, `avertissement`, `periodicite`, `jour`, `dateParution`, `prochaineParution`, `cheminArchivage`, `delaiArchivage`, `background`, `affichage`, `personnalisable`, `feuilleDeStyle`, `idListe`, `pageWidth`, `bgImg`, `bgImgMode`, `bgImgRepeat`, `bgImgPosH`, `bgImgPosV`, `emailSender`, `idLettreConfirmation`, `typeLettre`, `send2Author`, `groupes`, `idListeTest`, `chronoArchive`, `statLecture`, `statImg0`, `statImg1`, `statImgAlign`, `tplBody`, `tplHeader`, `tplFooter`) VALUES
(1, 'Sondage', 'Test pour sondage et template', '<div align="center"><strong>zid = [idLettre] - [idArchive]<br /><font color="#ff0000">Lettre de test des templatee et des sondages<br /><br /><em><font color="#0000ff">Merci de ne pas m''en tenir rigueur si je spam certains d''entre vous.<br />Merci pour votre soutien</font></em></font></strong></div>', 0, 'Si vous ne visualisez pas correctement le message qui suit, suivez ce lien [urlArchive]', 4, 1, '2008-06-15 09:06:27', '2008-07-01 00:00:00', '', 12, 'FFFFFF', 15, 1, 'young_leaves', 2, '', '', 0, 0, 0, 0, 'webmaster@localhost', 2, 0, 0, '0,1,8,0', 2, 44, 2, 'gobelin.gif', 'sumo.gif', 1, 'body_121-650-a.htm', 'header_standard.htm', 'footer_standard.htm'),
(2, 'confirmation', '', '', 0, 'Si vous ne visualisez pas correctement le message qui suit, suivez ce lien [urlArchive]', 0, 0, NULL, '0000-00-00 00:00:00', '', 0, 'FFFFFF', 15, 1, 'default', 0, '650', '', 0, 0, 0, 0, '', 0, 1, 0, '0,,0', 0, 0, 0, '', '', 0, '', '', ''),
(3, 'zzzzzzz', 'zzzzzzzzzzzzzzzzzzzzz copy', '<div align="center"><strong>zid = [idLettre] - [idArchive]</strong></div>', 2, 'Si vous ne visualisez pas correctement le message qui suit, suivez ce lien [urlArchive]', 4, 1, '2008-05-07 05:05:43', '2008-06-01 00:00:00', '', 12, 'FFFFFF', 15, 1, 'young_leaves', 0, '', '', 0, 0, 0, 0, 'webmaster@localhost', 2, 0, 0, '0,1,2,3,0', 0, 0, 2, 'gobelin.gif', 'sumo.gif', 1, '', '', ''),
(4, 'test HTML', 'Lettre de test de réception HTML avec HERMES', 'Suite au poste dans le forum de [_site.homepage], j''envoie une lettre de test de r&eacute;ception en HTML &agrave; ceux qui ont des probl&egrave;mes de r&eacute;ception du code au lieu de la mise en forme.<br /><font color="#ff0000">Merci de r&eacute;pondre au sondage ci dessous, si cela est possible &eacute;videmment.</font><br /><hr width="100%" size="2" />[sondage.Resultat HTML-2]<br /><hr width="100%" size="2" />', 1, 'Si vous ne visualisez pas correctement le message qui suit, suivez ce lien [urlArchive]', 4, 1, '2008-06-03 11:06:04', '2008-07-01 12:07:00', '', 12, 'FFFFFF', 15, 1, '7dana-rose', 1, '650px', '', 0, 0, 0, 0, 'webmaster@xoops.kiolo.com', 2, 0, 0, '0,,0', 2, 2, 1, 'sumo.gif', 'troll.gif', 1, '', '', ''),
(5, 'Hermes - v 3.5.1', 'Présentation des nouvelles fonctionalités de Hermes', '<div align="center"><font color="#0000ff"><strong>Bonjour &agrave; tous:</strong></font></div><font color="#0000ff">Je vous pr&eacute;sente les nouvelles fonctionalit&eacute;s du module HERMES.<br />Cette version porte ne n&deg; 4.00 car elle comporte quelques &eacute;volutions majeurs.</font>', 8, 'Si vous ne visualisez pas correctement le message qui suit, suivez ce lien [urlArchive]', 4, 1, NULL, '2008-06-17 00:00:00', '', 12, 'FFFFFF', 15, 1, 'art', 0, '700px', '06_bois.jpg', 0, 0, 0, 0, 'webmaster@xoops.kiolo.com', 2, 0, 0, '0,1,5,0', 0, 0, 1, 'sumo.gif', 'troll.gif', 1, 'body_121-100-a.htm', 'header_standard.htm', 'footer_standard.htm'),
(12, 'Hermes - v 4.00', 'Présentation des nouvelles fonctionalités de Hermes copy', '<div align="center"><font color="#0000ff"><strong>Bonjour &agrave; tous:</strong></font></div><font color="#0000ff">Je vous pr&eacute;sente les nouvelles fonctionalit&eacute;s du module HERMES.<br />Cette version porte ne n&deg; 4.00 car elle comporte quelques &eacute;volutions majeurs.</font>', 8, 'Si vous ne visualisez pas correctement le message qui suit, suivez ce lien [urlArchive]', 4, 1, '0000-00-00 00:00:00', '2008-06-17 00:00:00', '', 12, 'FFFFFF', 15, 1, 'art', 0, '700px', '06_bois.jpg', 0, 0, 0, 0, 'webmaster@xoops.kiolo.com', 2, 0, 0, '0,1,5,0', 2, 0, 1, 'sumo.gif', 'troll.gif', 1, 'body_12121-100%-a.htm', 'header_standard.htm', 'footer_standard.htm');

## ########################################################

##
## Structure de la table `her_libelle`
##

CREATE TABLE `her_libelle` (
  `idLibelle` bigint(30) NOT NULL auto_increment,
  `code` varchar(60) NOT NULL default '',
  `constant` varchar(30) NOT NULL default '',
  `texte` varchar(255) NOT NULL default '',
  `allowUpdate` tinyint(2) NOT NULL default '1',
  `perso` tinyint(2) NOT NULL default '0',
  `locked` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`idLibelle`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_libelle`
##

INSERT INTO `her_libelle` (`idLibelle`, `code`, `constant`, `texte`, `allowUpdate`, `perso`, `locked`) VALUES
(1, '_souscribe.revokeAllLetters', 'REVOKE_ALL_LETTERS', 'Résiliez l''abonnement à toutes les lettres de ce site.', 0, 1, 0),
(2, '_souscribe.revokeThisLetter', 'REVOKE_THIS_LETTER', 'Confirmez la résiliation à cette lettre d''information du site', 0, 1, 0),
(3, '_souscribe.confirmRevokeAllLetters', 'REVOKE_ALL_LETTERS_CONF', 'Résiliez l''abonnement à toutes les lettres de ce site. Une lettre de confirmation vous sera envoyée.', 0, 1, 0),
(4, '_souscribe.confirmRevokeThisLetter', 'REVOKE_THIS_LETTER_CONF', 'Si vous ne souhaitez plus recevoir cette lettre d''information du site. Une lettre de confirmation vous sera envoyée', 0, 1, 0),
(5, '_souscribe.subscribeThisLetter', 'SUBSCRIBE_THIS_LETTER', 'Souscrire à cette lettre.', 0, 1, 0),
(6, '_souscribe.revokeAllLettersConfirmed', 'CONFREVOKE_ALL_LETTERS', 'Résiliez toutes les lettres de diffusion de ce site', 0, 1, 0),
(7, '_souscribe.revokeThisLetterConfirmed', 'CONFREVOKE_THIS_LETTER', 'Confirmez la résiliation de cette lettre.', 0, 1, 0),
(8, 'urlArchiveLink', 'ARCHIVE', 'Archive', 1, 1, 0),
(9, 'adresse', '', '13 rue des Lilas\r\nTrifouillis les oies', 1, 0, 0),
(10, 'Copy Right', '', 'Copy Right : Jean-Jacques DELALANDRE - juin 2007', 1, 0, 1),
(11, 'Hermes', '', 'Lettre réalisée avec le module HERMES pour XOOPS', 0, 0, 1);

## ########################################################

##
## Structure de la table `her_params`
##

CREATE TABLE `her_params` (
  `idPlugin` bigint(20) NOT NULL default '0',
  `nom` varchar(30) NOT NULL default '',
  `valeur` text NOT NULL,
  `description` varchar(255) default NULL,
  `idStructure` bigint(20) NOT NULL default '0',
  `flag` tinyint(1) unsigned default '0',
  KEY `her_params_index1267` (`idPlugin`)
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_params`
##

INSERT INTO `her_params` (`idPlugin`, `nom`, `valeur`, `description`, `idStructure`, `flag`) VALUES
(1, 'listIdItem', '', '', 0, 1),
(1, 'listIdCategorie', '', '', 0, 1),
(1, 'template', '', '', 0, 1),
(1, 'optionsAffichage', '255', '', 0, 1),
(1, 'nom', '', '', 0, 1),
(1, 'periode', '2', '', 0, 1),
(1, 'maxItem', '15', '', 0, 1),
(1, 'catSize', '+1', '', 0, 1),
(1, 'smartyTag_width', '', '', 0, 1),
(1, 'smartyTag_cols', '', '', 0, 1),
(1, 'smartyTag_rows', '', '', 0, 1),
(1, 'smartyTag_colwidth', '', '', 0, 1),
(1, 'smartyTag_colheight', '', '', 0, 1),
(1, 'smartyTag_00', '', '', 0, 1),
(1, 'smartyTag_01', '', '', 0, 1),
(1, 'smartyTag_02', '', '', 0, 1),
(1, 'smartyTag_03', '', '', 0, 1),
(1, 'smartyTag_04', '', '', 0, 1),
(1, 'modeAffichage', '1', '', 0, 1),
(1, 'imgCategorie', '1', '', 0, 1),
(1, 'imgAnnonce', '1', '', 0, 1),
(1, 'ordre', '0', '', 0, 1),
(1, 'ordreTitle', '20', '', 0, 1),
(1, 'ordreDescription', '30', '', 0, 1),
(1, 'ordrePrice', '40', '', 0, 1),
(1, 'ordreTown', '50', '', 0, 1),
(1, 'ordreDateCreation', '60', '', 0, 1),
(1, 'ordreDatePublication', '70', '', 0, 1),
(1, 'ordreDateExpiration', '80', '', 0, 1),
(1, 'ordreCategorie', '90', '', 0, 1),
(2, 'listIdItem', '', '', 0, 1),
(2, 'listIdCategorie', '', '', 0, 1),
(2, 'template', '', '', 0, 1),
(2, 'optionsAffichage', '255', '', 0, 1),
(2, 'nom', '', '', 0, 1),
(2, 'periode', '2', '', 0, 1),
(2, 'maxItem', '15', '', 0, 1),
(2, 'catSize', '+1', '', 0, 1),
(2, 'smartyTag_width', '', '', 0, 1),
(2, 'smartyTag_cols', '', '', 0, 1),
(2, 'smartyTag_rows', '', '', 0, 1),
(2, 'smartyTag_colwidth', '', '', 0, 1),
(2, 'smartyTag_colheight', '', '', 0, 1),
(2, 'smartyTag_00', '', '', 0, 1),
(2, 'smartyTag_01', '', '', 0, 1),
(2, 'smartyTag_02', '', '', 0, 1),
(2, 'smartyTag_03', '', '', 0, 1),
(2, 'smartyTag_04', '', '', 0, 1),
(2, 'url', '', '', 0, 1),
(2, 'description', '', '', 0, 1),
(2, 'colonnes', 'author,description,pubDate', '', 0, 1),
(2, 'max', '15', '', 0, 1),
(2, 'ordre', '0', '', 0, 1),
(3, 'listIdItem', '', '', 0, 1),
(3, 'listIdCategorie', '', '', 0, 1),
(3, 'template', '', '', 0, 1),
(3, 'optionsAffichage', '255', '', 0, 1),
(3, 'nom', '', '', 0, 1),
(3, 'periode', '2', '', 0, 1),
(3, 'maxItem', '15', '', 0, 1),
(3, 'catSize', '+1', '', 0, 1),
(3, 'smartyTag_width', '', '', 0, 1),
(3, 'smartyTag_cols', '', '', 0, 1),
(3, 'smartyTag_rows', '', '', 0, 1),
(3, 'smartyTag_colwidth', '', '', 0, 1),
(3, 'smartyTag_colheight', '', '', 0, 1),
(3, 'smartyTag_00', '', '', 0, 1),
(3, 'smartyTag_01', '', '', 0, 1),
(3, 'smartyTag_02', '', '', 0, 1),
(3, 'smartyTag_03', '', '', 0, 1),
(3, 'smartyTag_04', '', '', 0, 1),
(3, 'url', '', '', 0, 1),
(3, 'description', '', '', 0, 1),
(3, 'imgMode', '1', '', 0, 1),
(3, 'ruptureMaitre', '1', '', 0, 1),
(3, 'ordre', '0', '', 0, 1),
(3, 'col_title', '20', '', 0, 1),
(3, 'col_author', '30', '', 0, 1),
(3, 'col_pubDate', '40', '', 0, 1),
(3, 'col_description', '50', '', 0, 1),
(3, 'col_img', '60', '', 0, 1),
(3, 'col_guid', '70', '', 0, 1),
(4, 'listIdItem', '', '', 0, 1),
(4, 'listIdCategorie', '', '', 0, 1),
(4, 'template', '', '', 0, 1),
(4, 'optionsAffichage', '255', '', 0, 1),
(4, 'nom', '', '', 0, 1),
(4, 'periode', '2', '', 0, 1),
(4, 'maxItem', '15', '', 0, 1),
(4, 'catSize', '+1', '', 0, 1),
(4, 'smartyTag_width', '', '', 0, 1),
(4, 'smartyTag_cols', '', '', 0, 1),
(4, 'smartyTag_rows', '', '', 0, 1),
(4, 'smartyTag_colwidth', '', '', 0, 1),
(4, 'smartyTag_colheight', '', '', 0, 1),
(4, 'smartyTag_00', '', '', 0, 1),
(4, 'smartyTag_01', '', '', 0, 1),
(4, 'smartyTag_02', '', '', 0, 1),
(4, 'smartyTag_03', '', '', 0, 1),
(4, 'smartyTag_04', '', '', 0, 1),
(4, 'ordre', '0', '', 0, 1),
(4, 'ordreLexique', '20', '', 0, 1),
(4, 'ordreDescription', '30', '', 0, 1),
(4, 'ordreDateCreation', '40', '', 0, 1),
(4, 'ordreDateModification', '50', '', 0, 1),
(5, 'listIdItem', '', '', 0, 1),
(5, 'listIdCategorie', '', '', 0, 1),
(5, 'template', '', '', 0, 1),
(5, 'optionsAffichage', '255', '', 0, 1),
(5, 'nom', '', '', 0, 1),
(5, 'periode', '2', '', 0, 1),
(5, 'maxItem', '15', '', 0, 1),
(5, 'catSize', '+1', '', 0, 1),
(5, 'smartyTag_width', '', '', 0, 1),
(5, 'smartyTag_cols', '', '', 0, 1),
(5, 'smartyTag_rows', '', '', 0, 1),
(5, 'smartyTag_colwidth', '', '', 0, 1),
(5, 'smartyTag_colheight', '', '', 0, 1),
(5, 'smartyTag_00', '', '', 0, 1),
(5, 'smartyTag_01', '', '', 0, 1),
(5, 'smartyTag_02', '', '', 0, 1),
(5, 'smartyTag_03', '', '', 0, 1),
(5, 'smartyTag_04', '', '', 0, 1),
(5, 'ordre', '0', '', 0, 1),
(5, 'ordreTerme', '20', '', 0, 1),
(8, 'template', 'template-generique/generique-info-01a.html', NULL, 9, 1),
(5, 'ordreLexique', '40', '', 0, 1),
(5, 'ordreDateModification', '50', '', 0, 1),
(6, 'listIdItem', '', '', 0, 1),
(6, 'listIdCategorie', '', '', 0, 1),
(6, 'template', '', '', 0, 1),
(6, 'optionsAffichage', '255', '', 0, 1),
(6, 'nom', '', '', 0, 1),
(6, 'periode', '2', '', 0, 1),
(6, 'maxItem', '15', '', 0, 1),
(6, 'catSize', '+1', '', 0, 1),
(6, 'smartyTag_width', '', '', 0, 1),
(6, 'smartyTag_cols', '', '', 0, 1),
(6, 'smartyTag_rows', '', '', 0, 1),
(6, 'smartyTag_colwidth', '', '', 0, 1),
(6, 'smartyTag_colheight', '', '', 0, 1),
(6, 'smartyTag_00', '', '', 0, 1),
(6, 'smartyTag_01', '', '', 0, 1),
(6, 'smartyTag_02', '', '', 0, 1),
(6, 'smartyTag_03', '', '', 0, 1),
(6, 'smartyTag_04', '', '', 0, 1),
(6, 'ordre', '0', '', 0, 1),
(6, 'ordreTitle', '20', '', 0, 1),
(6, 'ordreHomepage', '30', '', 0, 1),
(6, 'ordreVersion', '40', '', 0, 1),
(6, 'ordreDate', '50', '', 0, 1),
(6, 'ordreDescription', '60', '', 0, 1),
(7, 'listIdItem', '', '', 0, 1),
(7, 'listIdCategorie', '', '', 0, 1),
(7, 'template', '', '', 0, 1),
(7, 'optionsAffichage', '255', '', 0, 1),
(7, 'nom', '', '', 0, 1),
(7, 'periode', '2', '', 0, 1),
(7, 'maxItem', '15', '', 0, 1),
(7, 'catSize', '+1', '', 0, 1),
(7, 'smartyTag_width', '', '', 0, 1),
(7, 'smartyTag_cols', '', '', 0, 1),
(7, 'smartyTag_rows', '', '', 0, 1),
(7, 'smartyTag_colwidth', '', '', 0, 1),
(7, 'smartyTag_colheight', '', '', 0, 1),
(7, 'smartyTag_00', '', '', 0, 1),
(7, 'smartyTag_01', '', '', 0, 1),
(7, 'smartyTag_02', '', '', 0, 1),
(7, 'smartyTag_03', '', '', 0, 1),
(7, 'smartyTag_04', '', '', 0, 1),
(7, 'ordre', '0', '', 0, 1),
(7, 'ordreTitle', '20', '', 0, 1),
(7, 'ordreTime', '30', '', 0, 1),
(7, 'ordreHits', '40', '', 0, 1),
(8, 'listIdItem', '', '', 0, 1),
(8, 'listIdCategorie', '', '', 0, 1),
(8, 'template', '', '', 0, 1),
(8, 'optionsAffichage', '255', '', 0, 1),
(8, 'nom', '', '', 0, 1),
(8, 'periode', '2', '', 0, 1),
(8, 'maxItem', '15', '', 0, 1),
(8, 'catSize', '+1', '', 0, 1),
(8, 'smartyTag_width', '', '', 0, 1),
(8, 'smartyTag_cols', '', '', 0, 1),
(8, 'smartyTag_rows', '', '', 0, 1),
(8, 'smartyTag_colwidth', '', '', 0, 1),
(8, 'smartyTag_colheight', '', '', 0, 1),
(8, 'smartyTag_00', '', '', 0, 1),
(8, 'smartyTag_01', '', '', 0, 1),
(8, 'smartyTag_02', '', '', 0, 1),
(8, 'smartyTag_03', '', '', 0, 1),
(8, 'smartyTag_04', '', '', 0, 1),
(8, 'ruptureMaitre', '1', '', 0, 1),
(8, 'ordre', '0', '', 0, 1),
(8, 'ordreTitle', '20', '', 0, 1),
(8, 'ordreHometext', '30', '', 0, 1),
(8, 'ordreAuthor', '40', '', 0, 1),
(8, 'ordreCategorie', '50', '', 0, 1),
(8, 'ordreDatePublication', '60', '', 0, 1),
(9, 'listIdItem', '', '', 0, 1),
(9, 'listIdCategorie', '', '', 0, 1),
(9, 'template', '', '', 0, 1),
(9, 'optionsAffichage', '255', '', 0, 1),
(9, 'nom', '', '', 0, 1),
(9, 'periode', '2', '', 0, 1),
(9, 'maxItem', '15', '', 0, 1),
(9, 'catSize', '+1', '', 0, 1),
(9, 'smartyTag_width', '', '', 0, 1),
(9, 'smartyTag_cols', '', '', 0, 1),
(9, 'smartyTag_rows', '', '', 0, 1),
(9, 'smartyTag_colwidth', '', '', 0, 1),
(9, 'smartyTag_colheight', '', '', 0, 1),
(9, 'smartyTag_00', '', '', 0, 1),
(9, 'smartyTag_01', '', '', 0, 1),
(9, 'smartyTag_02', '', '', 0, 1),
(9, 'smartyTag_03', '', '', 0, 1),
(9, 'smartyTag_04', '', '', 0, 1),
(9, 'ordre', '0', '', 0, 1),
(9, 'ordreQuestion', '20', '', 0, 1),
(9, 'ordreDescription', '30', '', 0, 1),
(9, 'ordreDateDebut', '40', '', 0, 1),
(9, 'ordreDateFin', '50', '', 0, 1),
(9, 'ordreVotes', '60', '', 0, 1),
(10, 'listIdItem', '', '', 0, 1),
(10, 'listIdCategorie', '', '', 0, 1),
(10, 'template', '', '', 0, 1),
(10, 'optionsAffichage', '255', '', 0, 1),
(10, 'nom', '', '', 0, 1),
(10, 'periode', '2', '', 0, 1),
(10, 'maxItem', '15', '', 0, 1),
(10, 'catSize', '+1', '', 0, 1),
(10, 'smartyTag_width', '', '', 0, 1),
(10, 'smartyTag_cols', '', '', 0, 1),
(10, 'smartyTag_rows', '', '', 0, 1),
(10, 'smartyTag_colwidth', '', '', 0, 1),
(10, 'smartyTag_colheight', '', '', 0, 1),
(10, 'smartyTag_00', '', '', 0, 1),
(10, 'smartyTag_01', '', '', 0, 1),
(10, 'smartyTag_02', '', '', 0, 1),
(10, 'smartyTag_03', '', '', 0, 1),
(10, 'smartyTag_04', '', '', 0, 1),
(10, 'ruptureMaitre', '1', '', 0, 1),
(10, 'show_title', '1', '', 0, 1),
(10, 'show_categorie', '1', '', 0, 1),
(10, 'ordre', '0', '', 0, 1),
(10, 'ordreTitle', '20', '', 0, 1),
(10, 'ordreSommaire', '30', '', 0, 1),
(10, 'ordreDatePublication', '40', '', 0, 1),
(10, 'ordreLecture', '50', '', 0, 1),
(10, 'ordreCatCreation', '60', '', 0, 1),
(10, 'ordreCatLecture', '70', '', 0, 1),
(10, 'ordreCategorie', '80', '', 0, 1),
(11, 'listIdItem', '', '', 0, 1),
(11, 'listIdCategorie', '', '', 0, 1),
(11, 'template', '', '', 0, 1),
(11, 'optionsAffichage', '255', '', 0, 1),
(11, 'nom', '', '', 0, 1),
(11, 'periode', '2', '', 0, 1),
(11, 'maxItem', '15', '', 0, 1),
(11, 'catSize', '+1', '', 0, 1),
(11, 'smartyTag_width', '', '', 0, 1),
(11, 'smartyTag_cols', '', '', 0, 1),
(11, 'smartyTag_rows', '', '', 0, 1),
(11, 'smartyTag_colwidth', '', '', 0, 1),
(11, 'smartyTag_colheight', '', '', 0, 1),
(11, 'smartyTag_00', '', '', 0, 1),
(11, 'smartyTag_01', '', '', 0, 1),
(11, 'smartyTag_02', '', '', 0, 1),
(11, 'smartyTag_03', '', '', 0, 1),
(11, 'smartyTag_04', '', '', 0, 1),
(11, 'affichage', '1', '', 0, 1),
(11, 'ordre', '0', '', 0, 1),
(11, 'ordreTitle', '20', '', 0, 1),
(11, 'ordreSommaire', '30', '', 0, 1),
(11, 'ordreDatePublication', '40', '', 0, 1),
(11, 'ordreLecture', '50', '', 0, 1),
(11, 'ordreCategorie', '60', '', 0, 1),
(11, 'ordreCatLecture', '70', '', 0, 1),
(11, 'ordreCatCreation', '80', '', 0, 1),
(12, 'listIdItem', '', '', 0, 1),
(12, 'listIdCategorie', '', '', 0, 1),
(12, 'template', '', '', 0, 1),
(12, 'optionsAffichage', '255', '', 0, 1),
(12, 'nom', '', '', 0, 1),
(12, 'periode', '2', '', 0, 1),
(12, 'maxItem', '15', '', 0, 1),
(12, 'catSize', '+1', '', 0, 1),
(12, 'smartyTag_width', '', '', 0, 1),
(12, 'smartyTag_cols', '', '', 0, 1),
(12, 'smartyTag_rows', '', '', 0, 1),
(12, 'smartyTag_colwidth', '', '', 0, 1),
(12, 'smartyTag_colheight', '', '', 0, 1),
(12, 'smartyTag_00', '', '', 0, 1),
(12, 'smartyTag_01', '', '', 0, 1),
(12, 'smartyTag_02', '', '', 0, 1),
(12, 'smartyTag_03', '', '', 0, 1),
(12, 'smartyTag_04', '', '', 0, 1),
(12, 'header', '', '', 0, 1),
(12, 'footer', '', '', 0, 1),
(12, 'query', '', '', 0, 1),
(12, 'hasRupture', '', '', 0, 1),
(12, 'ordre', '0', '', 0, 1),
(13, 'periode', '2', '', 0, 1),
(13, 'maxItem', '15', '', 0, 1),
(13, 'message', '15', '', 0, 1),
(14, 'listIdItem', '', '', 0, 1),
(14, 'listIdCategorie', '', '', 0, 1),
(14, 'template', '', '', 0, 1),
(14, 'optionsAffichage', '255', '', 0, 1),
(14, 'nom', '', '', 0, 1),
(14, 'periode', '2', '', 0, 1),
(14, 'maxItem', '15', '', 0, 1),
(14, 'catSize', '+1', '', 0, 1),
(14, 'smartyTag_width', '', '', 0, 1),
(14, 'smartyTag_cols', '', '', 0, 1),
(14, 'smartyTag_rows', '', '', 0, 1),
(14, 'smartyTag_colwidth', '', '', 0, 1),
(14, 'smartyTag_colheight', '', '', 0, 1),
(14, 'smartyTag_00', '', '', 0, 1),
(14, 'smartyTag_01', '', '', 0, 1),
(14, 'smartyTag_02', '', '', 0, 1),
(14, 'smartyTag_03', '', '', 0, 1),
(14, 'smartyTag_04', '', '', 0, 1),
(14, 'lastAnnonces', '15', '', 0, 1),
(14, 'message', 'JÝJÝD', '', 0, 1),
(14, 'ordre', '0', '', 0, 1),
(14, 'ordreSujet', '20', '', 0, 1),
(14, 'ordreDescription', '30', '', 0, 1),
(14, 'ordreAnnonce', '40', '', 0, 1),
(14, 'ordreDateModification', '50', '', 0, 1),
(15, 'listIdItem', '', '', 0, 1),
(15, 'listIdCategorie', '', '', 0, 1),
(15, 'template', '', '', 0, 1),
(15, 'optionsAffichage', '255', '', 0, 1),
(15, 'nom', '', '', 0, 1),
(15, 'periode', '2', '', 0, 1),
(15, 'maxItem', '15', '', 0, 1),
(15, 'catSize', '+1', '', 0, 1),
(15, 'smartyTag_width', '', '', 0, 1),
(15, 'smartyTag_cols', '', '', 0, 1),
(15, 'smartyTag_rows', '', '', 0, 1),
(15, 'smartyTag_colwidth', '', '', 0, 1),
(15, 'smartyTag_colheight', '', '', 0, 1),
(15, 'smartyTag_00', '', '', 0, 1),
(15, 'smartyTag_01', '', '', 0, 1),
(15, 'smartyTag_02', '', '', 0, 1),
(15, 'smartyTag_03', '', '', 0, 1),
(15, 'smartyTag_04', '', '', 0, 1),
(15, 'Age du capitaine', '', '', 0, 1),
(15, 'Sexe des anges', '2', '', 0, 1),
(15, 'pages', '', '', 0, 1),
(15, 'ordre', '0', '', 0, 1),
(15, 'ordreSujet', '20', '', 0, 1),
(15, 'ordreAnnonce', '30', '', 0, 1),
(15, 'ordreAuthor', '40', '', 0, 1),
(15, 'ordreDateCreation', '50', '', 0, 1),
(15, 'ordreDateModification', '60', '', 0, 1),
(16, 'listIdItem', '', '', 0, 1),
(16, 'listIdCategorie', '', '', 0, 1),
(16, 'template', '', '', 0, 1),
(16, 'optionsAffichage', '255', '', 0, 1),
(16, 'nom', '', '', 0, 1),
(16, 'periode', '2', '', 0, 1),
(16, 'maxItem', '15', '', 0, 1),
(16, 'catSize', '+1', '', 0, 1),
(16, 'smartyTag_width', '', '', 0, 1),
(16, 'smartyTag_cols', '', '', 0, 1),
(16, 'smartyTag_rows', '', '', 0, 1),
(16, 'smartyTag_colwidth', '', '', 0, 1),
(16, 'smartyTag_colheight', '', '', 0, 1),
(16, 'smartyTag_00', '', '', 0, 1),
(16, 'smartyTag_01', '', '', 0, 1),
(16, 'smartyTag_02', '', '', 0, 1),
(16, 'smartyTag_03', '', '', 0, 1),
(16, 'smartyTag_04', '', '', 0, 1),
(16, 'ruptureMaitre', '1', '', 0, 1),
(16, 'show_title', '1', '', 0, 1),
(16, 'show_categorie', '1', '', 0, 1),
(16, 'ordre', '0', '', 0, 1),
(16, 'ordreTitle', '20', '', 0, 1),
(16, 'ordreSommaire', '30', '', 0, 1),
(16, 'ordreDatePublication', '40', '', 0, 1),
(16, 'ordreLecture', '50', '', 0, 1),
(16, 'ordreCatCreation', '60', '', 0, 1),
(16, 'ordreCatLecture', '70', '', 0, 1),
(16, 'ordreCategorie', '80', '', 0, 1),
(5, 'ordreShortDef', '30', '', 0, 1),
(5, 'ordreDefinition1', '40', '', 0, 1),
(8, 'optionsAffichage', '127', NULL, 9, 1),
(8, 'nom', '', NULL, 9, 1),
(8, 'periode', '2', NULL, 9, 1),
(8, 'maxItem', '15', NULL, 9, 1),
(8, 'catSize', '+1', NULL, 9, 1),
(8, 'smartyTag_width', '', NULL, 9, 1),
(8, 'smartyTag_cols', '', NULL, 9, 1),
(8, 'smartyTag_rows', '', NULL, 9, 1),
(8, 'smartyTag_colwidth', '', NULL, 9, 1),
(8, 'smartyTag_colheight', '', NULL, 9, 1),
(8, 'smartyTag_00', '', NULL, 9, 1),
(8, 'smartyTag_01', '', NULL, 9, 1),
(8, 'smartyTag_02', '', NULL, 9, 1),
(8, 'smartyTag_03', '', NULL, 9, 1),
(8, 'smartyTag_04', '', NULL, 9, 1),
(8, 'ruptureMaitre', '1', NULL, 9, 1),
(8, 'ordre', '', NULL, 9, 1),
(8, 'ordreTitle', '20', NULL, 9, 1),
(8, 'ordreHometext', '30', NULL, 9, 1),
(8, 'ordreAuthor', '40', NULL, 9, 1),
(8, 'ordreCategorie', '50', NULL, 9, 1),
(8, 'ordreDatePublication', '60', NULL, 9, 1),
(8, 'listIdCategorie', '', NULL, 9, 1),
(8, 'listIdItem', '', NULL, 9, 1);

## ########################################################

##
## Structure de la table `her_piece`
##

CREATE TABLE `her_piece` (
  `idPiece` int(10) unsigned NOT NULL auto_increment,
  `idLettre` bigint(20) default NULL,
  `nomFichier` varchar(255) default NULL,
  `libelle` varchar(80) default NULL,
  `state` int(10) unsigned default NULL,
  PRIMARY KEY  (`idPiece`)
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_piece`
##


## ########################################################

##
## Structure de la table `her_plugin`
##

CREATE TABLE `her_plugin` (
  `idPlugin` bigint(20) NOT NULL auto_increment,
  `nomFichier` varchar(100) default NULL,
  `nom` varchar(30) default NULL,
  `description` longtext,
  `compteur` int(10) unsigned default NULL,
  `module` varchar(30) default NULL,
  `version` varchar(30) default NULL,
  `affichage` tinyint(1) unsigned default '255',
  `flag` tinyint(1) unsigned default '0',
  `state` tinyint(1) unsigned default '0',
  `template` varchar(250) NOT NULL default '',
  PRIMARY KEY  (`idPlugin`)
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_plugin`
##

INSERT INTO `her_plugin` (`idPlugin`, `nomFichier`, `nom`, `description`, `compteur`, `module`, `version`, `affichage`, `flag`, `state`, `template`) VALUES
(1, 'catads/catads.php', 'Annonces', 'Les dernières annonces du site', 0, 'catads', '1.02.01', 255, 1, 3, ''),
(2, 'fluxrss/fluxrss.php', 'Hermes Flux RSS', 'Gestion de flux RSS', 0, 'hermes', '1.02.01', 255, 1, 3, ''),
(3, 'fluxrss/fluxrss2.php', 'Hermes Flux RSS classic', 'Gestion de flux RSS', 0, 'hermes', '1.02.01', 255, 1, 3, ''),
(4, 'lexique/Lex_Lexique.php', 'Nouveaux lexiques', 'Liste des derniers lexiques crées', 0, 'lexique', '1.02.01', 255, 1, 3, ''),
(5, 'lexique/Lex_Termes.php', 'Nouvelles entrées dans les lex', 'Derniers termes créés dans les lexiques', 0, 'lexique', '1.02.01', 255, 1, 3, ''),
(6, 'mydownloads/mydownloads.php', 'Téléchargements', 'Ce plugin présentes les derniers télèchragement mis à disposition', 0, 'mydownloads', '1.02.01', 255, 1, 3, ''),
(7, 'mylinks/mylinks.php', 'My Links', '', 0, 'mylinks', '1.02.01', 255, 1, 0, ''),
(8, 'news/news.php', 'Nouvelles', 'Les dernières nouvelles du site', 0, 'news', '1.02.01', 255, 1, 3, ''),
(9, 'polls/polls.php', 'Sondages', 'Ce plugin recupères les derniers derniers sondages du site', 0, 'xoopspoll', '1.02.01', 255, 1, 0, ''),
(10, 'smartsection/smartsection.php', 'SmartSection', 'Les derniers articles site', 0, 'smartsection', '1.01.01', 255, 1, 3, ''),
(11, 'smartsection/smartsectionCat.php', 'Catégorie', 'Les derniers articles site', 0, 'smartsection', '1.01.01', 255, 1, 3, ''),
(12, 'sqlplugin/sqlplugin.php', 'Hermes query SQL', 'Execution de requete directe pour insertion dans la lettre.', 0, 'hermes', '1.02.01', 255, 1, 3, ''),
(13, 'test_plugins/test_Plugin_actu.php', 'Hermes query SQL', 'Execution de requete directe pour insertion dans la lettre.', 0, 'hermes', '1.02.01', 255, 1, 0, ''),
(14, 'test_plugins/test_plugin_annonces.php', 'Annonce', 'test - les dernieres annonces', 0, 'testPlugin', '1.02.01', 255, 1, 0, ''),
(15, 'test_plugins/test_plugin_pasglop.php', 'Pas glop', 'test d''un plugin sur un module non valide', 0, 'testPlugin', '1.02.01', 255, 1, 0, ''),
(16, 'weblinks/weblinks.php', '_WLINKS_NAME', '_WLINKS_PLUGIN_DESC', 0, 'weblinks', '1.01.01', 255, 1, 3, '');

## ########################################################

##
## Structure de la table `her_reponse`
##

CREATE TABLE `her_reponse` (
  `idReponse` bigint(20) NOT NULL auto_increment,
  `idSondage` bigint(20) NOT NULL default '0',
  `nom` varchar(255) NOT NULL default '',
  `image` varchar(255) NOT NULL default '',
  `ordre` tinyint(4) NOT NULL default '0',
  `resultat` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`idReponse`)
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_reponse`
##

INSERT INTO `her_reponse` (`idReponse`, `idSondage`, `nom`, `image`, `ordre`, `resultat`) VALUES
(1, 1, 'Oui je l''utilise féquemment', '', 10, 0),
(2, 1, 'Oui je l''utilise de temps en temps', '', 20, 0),
(3, 1, 'Non mais je l''ai testé et il ne convient pas à mon besoin', '', 30, 0),
(4, 1, 'Non je ne l''utilise pas', '', 40, 0),
(5, 2, 'C''est ok je recois bien du HTML', '', 10, 0),
(6, 2, 'C''est pas ok , je recois le code et non la mise en forme', '', 20, 0),
(7, 1, 'Quézaquo Hermes', '', 50, 0);

## ########################################################

##
## Structure de la table `her_resultat`
##

CREATE TABLE `her_resultat` (
  `idResultat` bigint(20) NOT NULL auto_increment,
  `idReponse` bigint(20) NOT NULL default '0',
  `email` varchar(60) NOT NULL default '',
  `reponse` bigint(20) NOT NULL default '0',
  `dateReponse` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`idResultat`)
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_resultat`
##

INSERT INTO `her_resultat` (`idResultat`, `idReponse`, `email`, `reponse`, `dateReponse`) VALUES
(1, 2, '[user.email]', 1, '0000-00-00 00:00:00'),
(2, 3, '[user.email]', 1, '0000-00-00 00:00:00'),
(7, 5, '[user.email]', 1, '0000-00-00 00:00:00'),
(8, 7, '[user.email]', 1, '0000-00-00 00:00:00'),
(11, 1, '[user.email]', 1, '0000-00-00 00:00:00');

## ########################################################

##
## Structure de la table `her_sondage`
##

CREATE TABLE `her_sondage` (
  `idSondage` bigint(20) NOT NULL auto_increment,
  `nom` varchar(60) NOT NULL default '',
  `categorie` varchar(60) NOT NULL default '',
  `description` longtext NOT NULL,
  `dateDebut` datetime NOT NULL default '0000-00-00 00:00:00',
  `dateFin` datetime NOT NULL default '0000-00-00 00:00:00',
  `disposition` tinyint(4) NOT NULL default '0',
  `groupes` varchar(255) NOT NULL default '',
  `mode` tinyint(4) NOT NULL default '2',
  PRIMARY KEY  (`idSondage`)
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_sondage`
##

INSERT INTO `her_sondage` (`idSondage`, `nom`, `categorie`, `description`, `dateDebut`, `dateFin`, `disposition`, `groupes`, `mode`) VALUES
(1, 'Deploiement HERMES', 'hermes', 'Afin de connaitre le nombre d''utilisateurs du module HERMES de lettre de diffusion, merci de bien vouloir r&eacute;pondre en cliquant sur l''une des r&eacute;ponses propos&eacute;es.', '1999-11-30 00:00:00', '1999-11-30 00:00:00', 1, '0,1,2,4,5,7,8,0', 2),
(2, 'Resultat HTML', 'test', 'Test de r&eacute;ception de la lettre de diffusion en HTML.<br />Merci de cliquer sur une des r&eacute;ponse ci-dessous:', '2000-11-01 00:00:00', '2009-11-30 00:00:00', 1, '0,1,2,4,6,7,8,0', 2);

## ########################################################

##
## Structure de la table `her_structure`
##

CREATE TABLE `her_structure` (
  `idStructure` bigint(20) NOT NULL auto_increment,
  `idLettre` bigint(20) default NULL,
  `idElement` bigint(20) NOT NULL default '0',
  `nom` varchar(50) NOT NULL default '',
  `cadreBorderWidth` int(10) unsigned default '0',
  `ordre` int(10) unsigned default NULL,
  `idItem` bigint(20) default NULL,
  `cadreBorderColor` varchar(7) default '0',
  `editBeforeSend` int(10) unsigned default '0',
  `miseEnForme` int(10) unsigned default '0',
  `lineBeforeWidth` int(10) unsigned default '0',
  `lineBeforeColor` varchar(7) default NULL,
  `lineAfterWidth` int(10) unsigned default '0',
  `lineAfterColor` varchar(7) default NULL,
  `params` varchar(255) NOT NULL default '',
  `flag` tinyint(2) NOT NULL default '0',
  `blockSmarty` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`idStructure`),
  KEY `her_structure_index1271` (`idLettre`,`idElement`)
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_structure`
##

INSERT INTO `her_structure` (`idStructure`, `idLettre`, `idElement`, `nom`, `cadreBorderWidth`, `ordre`, `idItem`, `cadreBorderColor`, `editBeforeSend`, `miseEnForme`, `lineBeforeWidth`, `lineBeforeColor`, `lineAfterWidth`, `lineAfterColor`, `params`, `flag`, `blockSmarty`) VALUES
(1, 1, 0, 'ci-joint ......', 0, 80, 3, '0', 0, 0, 0, '', 0, '', '1', 0, 'z1_footer'),
(2, 2, 2, '', 0, 10, 5, '0', 0, 0, 0, 'COLOR', 0, 'COLOR', '1', 0, ''),
(3, 3, 0, 'tttttt', 0, 10, 3, '0', 0, 0, 0, 'COLOR', 0, 'COLOR', '', 0, ''),
(6, 4, 2, '', 0, 10, 1, '0', 0, 0, 0, 'COLOR', 0, 'COLOR', '1', 0, ''),
(5, 1, 2, '', 0, 30, 17, '0', 0, 0, 0, '', 0, '', '1', 0, 'b1a_left'),
(7, 4, 2, '', 0, 20, 20, '0', 0, 0, 0, 'COLOR', 0, 'COLOR', '1', 0, ''),
(8, 1, 6, 'test de bandeau', 0, 60, 3, '0', 0, 0, 0, '', 0, '', '1', 0, 'b1b_right'),
(9, 1, 1, '', 0, 70, 8, '0', 0, 0, 0, '', 0, '', '1', 0, 'b1b_right'),
(10, 1, 2, '', 0, 10, 1, '0', 0, 0, 0, '', 0, '', '1', 0, 'a1a_top'),
(11, 1, 2, '', 0, 90, 6, '0', 0, 0, 0, '', 0, '', '1', 0, 'z1_footer'),
(12, 1, 2, '', 0, 20, 8, '0', 0, 0, 0, '', 0, '', '1', 0, 'a1a_top'),
(13, 1, 2, '', 0, 50, 13, '0', 0, 0, 0, '', 0, '', '1', 0, 'b1b_right'),
(14, 1, 6, 'info', 0, 40, 3, '0', 0, 0, 0, '', 0, '', '1', 0, 'b1b_right'),
(15, 1, 6, 'BONJOUR', 0, 100, 6, '0', 0, 0, 0, '', 0, '', '1', 0, 'a1a_top'),
(16, 5, 2, '', 0, 80, 23, '0', 0, 0, 0, '', 0, '', '1', 0, 'b1b_right'),
(17, 5, 2, '', 0, 30, 21, '0', 0, 0, 0, '', 0, '', '1', 0, 'b1a_left'),
(18, 5, 2, '', 0, 40, 22, '0', 0, 0, 0, '', 0, '', '1', 0, 'b1a_left'),
(23, 5, 2, '', 0, 170, 17, '0', 0, 0, 0, '', 0, '', '1', 0, 'b9a_bottom'),
(20, 5, 2, '', 0, 150, 20, '0', 0, 0, 0, '', 0, '', '1', 0, 'b9a_bottom'),
(21, 5, 6, 'Liste de test', 0, 70, 3, '0', 0, 0, 0, '', 0, '', '1', 0, 'b1b_right'),
(22, 5, 2, '', 0, 140, 7, '0', 0, 0, 0, '', 0, '', '1', 0, 'b1b_right'),
(24, 5, 6, 'Sondage sur l''utilisation de HERMES', 0, 160, 3, '0', 0, 0, 0, '', 0, '', '1', 0, 'b9a_bottom'),
(25, 5, 6, 'Noter la lettre', 0, 130, 3, '0', 0, 0, 0, '', 0, '', '1', 0, 'b1b_right'),
(26, 5, 6, 'Menu', 0, 20, 3, '0', 0, 0, 0, '', 0, '', '1', 0, 'b1a_left'),
(27, 5, 6, '<br>HERMES v 4.00<br>', 0, 10, 6, '0', 0, 0, 0, '', 0, '', '1', 0, 'a1a_top'),
(28, 5, 2, '', 0, 120, 26, '0', 0, 0, 0, '', 0, '', '1', 0, 'b1b_right'),
(29, 5, 2, '', 0, 100, 25, '0', 0, 0, 0, '', 0, '', '1', 0, 'b1b_right'),
(30, 5, 2, '', 0, 60, 24, '0', 0, 0, 0, '', 0, '', '1', 0, 'b1b_right'),
(31, 5, 6, 'Sondage', 0, 90, 3, '0', 0, 0, 0, '', 0, '', '1', 0, 'b1b_right'),
(32, 5, 6, 'Décorations', 0, 110, 3, '0', 0, 0, 0, '', 0, '', '1', 0, 'b1b_right'),
(33, 5, 6, 'Template', 0, 50, 3, '0', 0, 0, 0, '', 0, '', '1', 0, 'b1b_right'),
(73, 12, 2, '', 0, 240, 29, '0', 0, 0, 0, '', 0, '', '1', 0, 'b1b_right'),
(72, 12, 2, '', 0, 70, 28, '0', 0, 0, 0, '', 0, '', '1', 0, 'b1b_right'),
(71, 12, 6, '', 0, 220, 21, '0', 0, 0, 0, '', 0, '', '1', 0, 'z1z_footer'),
(70, 12, 6, '', 0, 30, 20, '0', 0, 0, 0, '', 0, '', '1', 0, 'b1a_left'),
(69, 12, 6, '', 0, 230, 12, '0', 0, 0, 0, '', 0, '', '1', 0, 'z1z_footer'),
(68, 12, 2, '', 0, 160, 27, '0', 0, 0, 0, '', 0, '', '1', 0, 'd1a_left'),
(67, 12, 6, 'Présentation', 0, 50, 3, '0', 0, 0, 0, '', 0, '', '1', 0, 'b1b_right'),
(50, 12, 2, '', 0, 110, 23, '0', 0, 0, 0, '', 0, '', '1', 0, 'c1a_middle'),
(51, 12, 2, '', 0, 60, 21, '0', 0, 0, 0, '', 0, '', '1', 0, 'b1b_right'),
(52, 12, 2, '', 0, 40, 22, '0', 0, 0, 0, '', 0, '', '1', 0, 'b1a_left'),
(53, 12, 2, '', 0, 180, 17, '0', 0, 0, 0, '', 0, '', '1', 0, 'd1b_right'),
(54, 12, 2, '', 0, 210, 20, '0', 0, 0, 0, '', 0, '', '1', 0, 'z1z_footer'),
(55, 12, 2, '', 0, 200, 7, '0', 0, 0, 0, '', 0, '', '1', 0, 'z1a_bottom'),
(56, 12, 2, '', 0, 150, 26, '0', 0, 0, 0, '', 0, '', '1', 0, 'c1a_middle'),
(57, 12, 2, '', 0, 130, 25, '0', 0, 0, 0, '', 0, '', '1', 0, 'c1a_middle'),
(58, 12, 2, '', 0, 90, 24, '0', 0, 0, 0, '', 0, '', '1', 0, 'c1a_middle'),
(59, 12, 6, 'Liste de test', 0, 100, 3, '0', 0, 0, 0, '', 0, '', '1', 0, 'c1a_middle'),
(60, 12, 6, 'Sondage sur l''utilisation de HERMES', 0, 170, 3, '0', 0, 0, 0, '', 0, '', '1', 0, 'd1b_right'),
(61, 12, 6, 'Noter la lettre', 0, 190, 3, '0', 0, 0, 0, '', 0, '', '1', 0, 'z1a_bottom'),
(62, 12, 6, 'Menu', 0, 20, 3, '0', 0, 0, 0, '', 0, '', '1', 0, 'b1a_left'),
(63, 12, 6, '<br>HERMES v 4.00<br>', 0, 10, 6, '0', 0, 0, 0, '', 0, '', '1', 0, 'a1a_top'),
(64, 12, 6, 'Sondage', 0, 120, 3, '0', 0, 0, 0, '', 0, '', '1', 0, 'c1a_middle'),
(65, 12, 6, 'Décorations', 0, 140, 3, '0', 0, 0, 0, '', 0, '', '1', 0, 'c1a_middle'),
(66, 12, 6, 'Template', 0, 80, 3, '0', 0, 0, 0, '', 0, '', '1', 0, 'c1a_middle');

## ########################################################

##
## Structure de la table `her_style`
##

CREATE TABLE `her_style` (
  `idStyle` bigint(20) NOT NULL auto_increment,
  `nom` varchar(30) default NULL,
  `css` longtext NOT NULL,
  `typeBalise` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`idStyle`)
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_style`
##


## ########################################################

##
## Structure de la table `her_syndication`
##

CREATE TABLE `her_syndication` (
  `idUrl` bigint(20) NOT NULL default '0',
  `idLettre` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`idUrl`,`idLettre`)
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_syndication`
##


## ########################################################

##
## Structure de la table `her_temp`
##

CREATE TABLE `her_temp` (
  `idTemp` bigint(20) NOT NULL auto_increment,
  `idCession` bigint(20) default NULL,
  `idUser` bigint(20) default NULL,
  `name` varchar(50) default NULL,
  `pseudo` varchar(50) default NULL,
  `email` varchar(50) default NULL,
  `format` int(10) unsigned default '0',
  `flag` int(10) unsigned default '0',
  PRIMARY KEY  (`idTemp`),
  UNIQUE KEY `her_temp_email` (`idCession`,`email`)
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_temp`
##

INSERT INTO `her_temp` (`idTemp`, `idCession`, `idUser`, `name`, `pseudo`, `email`, `format`, `flag`) VALUES
(1, 0, 1, 'jjd@kiolo.com', 'jjd', 'jjd@kiolo.com', 1, 1),
(2, 0, 2, 'toto@kiolo.com', 'toto', 'toto@kiolo.com', 1, 1),
(3, 0, 3, 'togodo@kiolo.com', 'togodo', 'togodo@kiolo.com', 1, 1),
(4, 0, 7, 'ddd', 'ddd', 'ddd', 1, 1),
(5, 0, 4, 'sss', 'sss', 'sss', 1, 1),
(6, 0, 5, 'aaaa', 'aaaa', 'aaaa', 1, 1),
(7, 0, 8, 'xddd', 'xddd', 'xddd', 1, 1),
(8, 0, 9, 'xfff', 'xfff', 'xfff', 1, 1),
(9, 0, 10, 'xggggg', 'xggggg', 'xggggg', 1, 1),
(10, 0, 11, 'xggg', 'xggg', 'xggg', 1, 1),
(11, 0, 12, 'xccc', 'xccc', 'xccc', 1, 1),
(12, 0, 13, 'xbbb', 'xbbb', 'xbbb', 1, 1),
(13, 0, 14, 'xbbbb', 'xbbbb', 'xbbbb', 1, 1),
(14, 1, 1, 'jjd@kiolo.com', 'gepeto', 'jjd@kiolo.com', 1, 1),
(15, 1, 4, 'boken', 'shinai', 'shinai@wanadoo.fr', 1, 1),
(16, 1, 2099, 'shinai@kiolo.com', 'aaallo', 'shinai@kiolo.com', 1, 1),
(17, 1, 2217, 'hermes@kiolo.com', 'jjd_hermes', 'hermes@kiolo.com', 1, 1),
(18, 1, 27, 'jjd_gMail', 'jjd_gMail', 'jjdelalandre@gmail.com', 1, 1),
(19, 2, 1, 'jjd@kiolo.com', 'gepeto', 'jjd@kiolo.com', 1, 1),
(20, 2, 4, 'boken', 'shinai', 'shinai@wanadoo.fr', 1, 1),
(21, 2, 2099, 'shinai@kiolo.com', 'aaallo', 'shinai@kiolo.com', 1, 1),
(22, 2, 2217, 'hermes@kiolo.com', 'jjd_hermes', 'hermes@kiolo.com', 1, 1),
(23, 2, 27, 'jjd_gMail', 'jjd_gMail', 'jjdelalandre@gmail.com', 1, 1),
(24, 3, 1, 'jjd@kiolo.com', 'gepeto', 'jjd@kiolo.com', 1, 1),
(25, 3, 4, 'boken', 'shinai', 'shinai@wanadoo.fr', 1, 1),
(26, 3, 2099, 'shinai@kiolo.com', 'aaallo', 'shinai@kiolo.com', 1, 1),
(27, 3, 2217, 'hermes@kiolo.com', 'jjd_hermes', 'hermes@kiolo.com', 1, 1),
(28, 3, 27, 'jjd_gMail', 'jjd_gMail', 'jjdelalandre@gmail.com', 1, 1),
(29, 4, 0, 'blogphil@free.fr', 'blogphil@free.fr', 'blogphil@free.fr', 0, 1),
(30, 4, 0, 'lilou@kiolo.com', 'lilou@kiolo.com', 'lilou@kiolo.com', 0, 1),
(31, 4, 0, 'jean-jacques.delalandret@amj-groupe.com', 'jean-jacques.delalandret@amj-groupe.com', 'jean-jacques.delalandret@amj-groupe.com', 0, 1),
(32, 5, 0, 'blogphil@free.fr', 'blogphil@free.fr', 'blogphil@free.fr', 0, 1),
(33, 5, 0, 'lilou@kiolo.com', 'lilou@kiolo.com', 'lilou@kiolo.com', 0, 1),
(34, 5, 0, 'jjdelalandre@gmail.com', 'jjdelalandre@gmail.com', 'jjdelalandre@gmail.com', 0, 1),
(35, 6, 1, 'jjd@kiolo.com', 'gepeto', 'jjd@kiolo.com', 1, 1),
(36, 6, 4, 'boken', 'shinai', 'shinai@wanadoo.fr', 1, 1),
(37, 6, 2099, 'shinai@kiolo.com', 'aaallo', 'shinai@kiolo.com', 1, 1),
(38, 6, 2217, 'hermes@kiolo.com', 'jjd_hermes', 'hermes@kiolo.com', 1, 1),
(39, 6, 27, 'jjd_gMail', 'jjd_gMail', 'jjdelalandre@gmail.com', 1, 1),
(40, 6, 0, 'lilou@kiolo.com', 'lilou@kiolo.com', 'lilou@kiolo.com', 0, 1),
(41, 7, 1, 'jjd@kiolo.com', 'gepeto', 'jjd@kiolo.com', 1, 1),
(42, 7, 4, 'boken', 'shinai', 'shinai@wanadoo.fr', 1, 1),
(43, 7, 2099, 'shinai@kiolo.com', 'aaallo', 'shinai@kiolo.com', 1, 1),
(44, 7, 2217, 'hermes@kiolo.com', 'jjd_hermes', 'hermes@kiolo.com', 1, 1),
(45, 7, 27, 'jjd_gMail', 'jjd_gMail', 'jjdelalandre@gmail.com', 1, 1),
(46, 7, 0, 'lilou@kiolo.com', 'lilou@kiolo.com', 'lilou@kiolo.com', 0, 1),
(47, 7, 0, 'jjdelalandre@wanadoo.fr', 'jjdelalandre@wanadoo.fr', 'jjdelalandre@wanadoo.fr', 0, 1),
(48, 8, 1, 'jjd@kiolo.com', 'gepeto', 'jjd@kiolo.com', 1, 1),
(49, 8, 4, 'boken', 'shinai', 'shinai@wanadoo.fr', 1, 1),
(50, 8, 2099, 'shinai@kiolo.com', 'aaallo', 'shinai@kiolo.com', 1, 1),
(51, 8, 2217, 'hermes@kiolo.com', 'jjd_hermes', 'hermes@kiolo.com', 1, 1),
(52, 8, 27, 'jjd_gMail', 'jjd_gMail', 'jjdelalandre@gmail.com', 1, 1),
(53, 8, 0, 'lilou@kiolo.com', 'lilou@kiolo.com', 'lilou@kiolo.com', 0, 1),
(54, 8, 0, 'jjdelalandre@wanadoo.fr', 'jjdelalandre@wanadoo.fr', 'jjdelalandre@wanadoo.fr', 0, 1),
(55, 9, 1, 'jjd@kiolo.com', 'gepeto', 'jjd@kiolo.com', 1, 1),
(56, 9, 4, 'boken', 'shinai', 'shinai@wanadoo.fr', 1, 1),
(57, 9, 2099, 'shinai@kiolo.com', 'aaallo', 'shinai@kiolo.com', 1, 1),
(58, 9, 2217, 'hermes@kiolo.com', 'jjd_hermes', 'hermes@kiolo.com', 1, 1),
(59, 9, 27, 'jjd_gMail', 'jjd_gMail', 'jjdelalandre@gmail.com', 1, 1),
(60, 9, 0, 'lilou@kiolo.com', 'lilou@kiolo.com', 'lilou@kiolo.com', 0, 1),
(61, 9, 0, 'jjdelalandre@wanadoo.fr', 'jjdelalandre@wanadoo.fr', 'jjdelalandre@wanadoo.fr', 0, 1),
(62, 10, 1, 'jjd@kiolo.com', 'gepeto', 'jjd@kiolo.com', 1, 1),
(63, 10, 4, 'boken', 'shinai', 'shinai@wanadoo.fr', 1, 1),
(64, 10, 2099, 'shinai@kiolo.com', 'aaallo', 'shinai@kiolo.com', 1, 1),
(65, 10, 2217, 'hermes@kiolo.com', 'jjd_hermes', 'hermes@kiolo.com', 1, 1),
(66, 10, 27, 'jjd_gMail', 'jjd_gMail', 'jjdelalandre@gmail.com', 1, 1),
(67, 10, 0, 'lilou@kiolo.com', 'lilou@kiolo.com', 'lilou@kiolo.com', 0, 1),
(68, 10, 0, 'jjdelalandre@wanadoo.fr', 'jjdelalandre@wanadoo.fr', 'jjdelalandre@wanadoo.fr', 0, 1);

## ########################################################

##
## Structure de la table `her_texte`
##

CREATE TABLE `her_texte` (
  `idTexte` bigint(20) NOT NULL auto_increment,
  `nom` varchar(80) NOT NULL default '',
  `categorie` varchar(60) NOT NULL default '',
  `texte` longtext,
  `affichage` int(10) unsigned default '255',
  `bgColor` varchar(7) default NULL,
  `borderWidth` int(10) unsigned default '0',
  `borderColorLight` varchar(7) default NULL,
  `borderColorDark` varchar(7) default NULL,
  `alignement` int(10) unsigned default '2',
  `width` varchar(5) default '100',
  `incrustation` int(11) default '0',
  `editBeforeSend` int(10) unsigned default '0',
  `idFrame` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`idTexte`)
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_texte`
##

INSERT INTO `her_texte` (`idTexte`, `nom`, `categorie`, `texte`, `affichage`, `bgColor`, `borderWidth`, `borderColorLight`, `borderColorDark`, `alignement`, `width`, `incrustation`, `editBeforeSend`, `idFrame`) VALUES
(1, 'Intro idLettre - idArchive', '', '<p align="center"><strong>Lettre de difusion n° [idLettre] / [idArchive] du [dateParution].</strong></p>', 4, 'FFCC99', 4, 'FF9900', '996600', 2, '100%', 0, 0, 0),
(2, 'salutations', '', '<p>En attendants la nouvelle année, je vous souhaite de bonnes fètes.</p>', 7, '00FFCC', 3, '0066FF', '000099', 2, '100%', 0, 1, 0),
(3, '-o-o-O-O-O-O-o-o-', '', '<p align="center">-o-o-O-O-O-O-o-o-</p> ', 2, 'COLOR', 0, 'COLOR', 'COLOR', 2, '90%', 0, 0, 2),
(4, 'ligne de séparation', '', '<p><hr /></p>', 4, 'COLOR', 0, 'COLOR', 'COLOR', 2, '100%', 0, 0, 0),
(5, 'Revoquer l''abonnement', '', '<hr />Si vos ne souhaiter plus recevoir cette lettre d''information du site [_site.homepage], cliquer sur le lien ci-dessous:<br />[_souscribe.revokeThisLetter]<br /><br />Si vos ne souhaiter plus recevoir aucune information du site [_site.homepage], cliquer sur le lien ci-dessous:<br />[_souscribe.revokeAllLetters]. <hr /><p>Si vos ne souhaiter vus réabonner aux lettres d''information du site [_site.homepage], cliquer sur le lien ci-dessous:<br />[_souscribe.subscribeThisLetter]. </p><hr />   ', 7, 'FFFF66', 4, 'FFCC00', 'CC9900', 2, '90%', 0, 0, 0),
(6, 'Avertissement - Incompatibilit', '', '<p>Attention les derni&egrave;eres versions (v 2.01) des modules &quot;lexique&quot;, &quot;hermes&quot;, &quot;jjd_tools&quot; mis en t&eacute;l&eacute;chargements sont incompatibles avec les pr&eacute;c&eacute;dentes.</p><p>Je n&#39;ai pas encore officialis&eacute; leur sortie pour les tester encore quelques temps.</p><p>Si vous avez d&eacute;j&agrave; install&eacute; ces modules et que vous rencontr&eacute; des probl&egrave;mes dans leur utilisation, conctatez-moi.</p><p>Cela concerne notamment de nouveaux champs dans les tables.</p><p>Merci de vos retours si vous les essayez. <br />Par ailleurs, m&ecirc;me sil les fichers de langues sont pr&eacute;sents, seule la version fran&ccedil;aise est  correcte, les autres traductions sont soient incompl&egrave;tes, soit pas forc&eacute;ment correctes. Je suis preneur de toute aide pour les traductions anglaise, allemande, ...</p><p align="center"><font size="3"><strong>J&deg;J&deg;D <br /></strong></font></p>  ', 7, 'FF9999', 4, 'COLOR', 'COLOR', 2, '90%', 0, 0, 0),
(7, 'Noter la lettre', '', '<p>Avez vous appr&eacute;ci&eacute; cette lettre, <br />Quelle note lui donneriez-vous ? [note0]-[note1]-[note2]-[note3]-[note4]-[note5]-[note6]-[note7]-[note8]-[note9]-[note10]</p> ', 4, '99FFFF', 4, '3366FF', '000099', 2, '100%', 0, 0, 0),
(8, 'Home Page', '', '<p align="center">Page d''accueille site [_site.homepage] </p>', 4, 'COLOR', 0, 'COLOR', 'COLOR', 2, '50%', 0, 0, 1),
(9, 'test de colonnes', '', '<p><table style="height: 100px" cellspacing="1" cellpadding="1" border="1"><tr><td>sfsdfsd</td><td>sdfdsfsd<br />sfdsfsd<br />sdfsd<br />fsdfsdf</td><td>sdfsdfdsfsdfsd</td></tr></table></p>', 7, 'FFFF99', 5, '009900', 'CCFF00', 2, '100%', -4, 0, 0),
(10, 'Test d''insertion des codes de', '', '<p><table border="1"><tr><td>_site.adminmail</td><td>[_site.adminmail]</td></tr><tr><td>_site.homepage</td><td>[_site.homepage]</td></tr><tr><td>_site.language</td><td>[_site.language]</td></tr><tr><td>_site.sitename</td><td>[_site.sitename]</td></tr><tr><td>_site.siteurl</td><td>[_site.siteurl]</td></tr><tr><td>_site.slogan</td><td>[_site.slogan]</td></tr><tr><td>_site.url</td><td>[_site.url]</td></tr><tr><td>_souscribe.revokeAllLetters</td><td>[_souscribe.revokeAllLetters]</td></tr><tr><td>_souscribe.revokeThisLetter</td><td>[_souscribe.revokeThisLetter]</td></tr><tr><td>_souscribe.subscribeThisLetters</td><td>[_souscribe.subscribeThisLetters]</td></tr><tr><td>_user.email</td><td>[_user.email]</td></tr><tr><td>_user.idUser</td><td>[_user.idUser]</td></tr><tr><td>_user.login</td><td>[_user.login]</td></tr><tr><td>_user.mail</td><td>[_user.mail]</td></tr><tr><td>_user.name</td><td>[_user.name]</td></tr><tr><td>_user.pseudo</td><td>[_user.pseudo]</td></tr><tr><td>caption</td><td>[caption]</td></tr><tr><td>dateParution</td><td>[dateParution]</td></tr><tr><td>description</td><td>[description]</td></tr><tr><td>idArchive</td><td>[idArchive]</td></tr><tr><td>idElement</td><td>[idElement]</td></tr><tr><td>idItem</td><td>[idItem]</td></tr><tr><td>idLettre</td><td>[idLettre]</td></tr><tr><td>jour</td><td>[jour]</td></tr><tr><td>libelle</td><td>[libelle]</td></tr><tr><td>nom</td><td>[nom]</td></tr><tr><td>periodicite</td><td>[periodicite]</td></tr><tr><td>prochaineParution</td><td>[prochaineParution]</td></tr><tr><td>shortDateParution</td><td>[shortDateParution]</td></tr><tr><td>strDateParution</td><td>[strDateParution]</td></tr></table></p>', 7, '00FF99', 4, '00CC00', '336600', 2, '100%', 0, 0, 0),
(11, 'salutations courantes', '', '<p>J''espère que vous aurez beaucoup de plaisir à utiliser les modules mis à disposition.</p> ', 4, '00FFCC', 3, '0066FF', '000099', 2, '90%', 0, 0, 0),
(12, 'Made with Hermes', '', '<div align="center">Cette lettre &agrave; &eacute;t&eacute; r&eacute;alis&eacute;e avec le module &quot;<strong>Hermes</strong>&quot; disponible sur [_site.homepage].   </div> ', 4, 'FFCC00', 2, 'FF6600', 'FF0000', 2, '90%', 0, 0, 0),
(13, 'Info de dernière minute', '', '<div align="center"></div><div align="center"><img border="0" alt="" src="/uploads/smil3dbd4dbc14f3f.gif" /><font face="times new roman,times"><em><font size="3"> J''esp&egrave;re que vous prendrez beauoup de plaisir &agrave; utiliser ces modules..   </font></em></font><img border="0" alt="" src="/uploads/smil3dbd4dbc14f3f.gif" /> </div>   ', 7, '00FFCC', 3, '0066FF', '000099', 2, '90%', 0, 1, 0),
(14, 'catads', '', 'Ca yest il est en t&eacute;l&eacute;chargement sur le site la version 2.04.<br />Pas besoin de mettre &agrave; jour le module &quot; jjd_tools&quot;<br /><br /><div align="center"><strong>Merci de vos retours et de votre aide. J&deg;J&deg;D<br /><br />[_site.siteurl]</strong></div> ', 7, 'FFCC66', 3, 'COLOR', 'COLOR', 2, '100%', 0, 1, 0),
(15, 'test image', '', '<p>&nbsp;</p><p><img src="http://ace.wakasensei.fr/_aikido/livres/TechniquedeBudoEnAikido.jpg" alt="  " /></p><p>version 2.02 </p><p>&nbsp;</p><p>blablakoee erpit e</p><p>roeri toieru<img src="/uploads/smil3dbd4dcd7b9f4.gif" border="0" alt="" /></p><p>&nbsp;</p><p>fgdfgfdgdffghfghfg[_site.adminmail]</p><p>JJD&nbsp;</p>                                                                 ', 7, 'COLOR', 0, 'COLOR', 'COLOR', 2, '100%', 0, 1, 0),
(16, 'test image copy', 'Test', '<p> </p><p><img src="http://ace.wakasensei.fr/_aikido/livres/TechniquedeBudoEnAikido.jpg" alt="  " /></p><p>version 2.02 </p><p> </p><p>blablakoee erpit e</p><p>roeri toieru<img src="/uploads/smil3dbd4dcd7b9f4.gif" border="0" alt="" /></p><p> </p><p>fgdfgfdgdffghfghfg[_site.adminmail]</p><p>JJD </p>                                                                  copy', 7, 'COLOR', 0, 'COLOR', 'COLOR', 2, '100%', 0, 1, 0),
(17, 'sondage HERMES', 'Hermes v 4.00', 'Vous avez t&eacute;l&eacute;charg&eacute; le module HERMES &agrave; un moment ou un autre.<br />Je suhaiterais connaitre le nombre d''utilisateur afin d''en permettre la p&eacute;r&eacute;nit&eacute;.<br />Je vous propose donc le petit sondage si dessous.<br /><font color="#0000ff"></font><div align="center"><font color="#0000ff">[sondage.Deploiement HERMES-1]</font></div><br /><strong>Je vous remercie de votre partipation J&deg;J&deg;D</strong>', 4, 'COLOR', 0, 'COLOR', 'COLOR', 2, '100%', 0, 0, 4),
(18, 'Intro idLettre - idArchive copy', '', '<p align="center"><strong>Lettre de difusion n° [idLettre] / [idArchive] du [dateParution].</strong></p>', 4, 'FFCC99', 4, 'FF9900', '996600', 2, '100%', 0, 0, 0),
(19, 'résultat HTML', 'Sondage', '[sondage.Resultat HTML-2]', 7, 'COLOR', 0, 'COLOR', 'COLOR', 2, '100%', 0, 0, 1),
(20, 'Cordialement', 'Politesse', '<div align="center"><strong>Cordialement, JJD</strong></div>', 4, 'COLOR', 0, 'COLOR', 'COLOR', 2, '100%', 0, 0, 8),
(21, 'présentation générale', 'Hermes v 4.00', '<font size="+1">Voici un exemple de pr&eacute;sentation avec un template qui d&eacute;fini un bloc de haut de page, un deuxi&egrave;me block avec une partie gauche pour un menu par exemple et une partie droite pour les informations, et pour finir un pied de page.<br />Excusez mon manque d''esth&eacute;tique dans les choix de couleurs ou autres. mon objectif &eacute;tant de montrer la capacit&eacute; du module HERMES.<br /><br /><br /><br /><br /></font>', 4, 'COLOR', 0, 'COLOR', 'COLOR', 2, '100%', 0, 0, 2),
(23, 'Présentation - Liste de test', 'Hermes v 4.00', '<strong>Liste de test :</strong><span>  </span>Dans une lettre il est possible maintenant d''indiquer une "liste compl&eacute;mentaire de test". Lors de l''envoi un bouton permet de n''envoyer la lettre qu''&agrave; cette liste de test, bien pratique pour la pr&eacute;paration de la lettre en plus de la pr&eacute;visualisation.<o:p></o:p><br /><p class="MsoNormal"><strong>Mise en oeuvre :</strong> Dans les liste compl&eacute;mentaires cr&eacute;er une liste avec les emails destinataires. S&eacute;lectionner "envoi de la lettre" dans la liste des lettres, S&eacute;lectionner dans la liste d&eacute;roulante "liste de test" la liste que vous venez de cr&eacute;er et cliquer sur le bouton "envoi &agrave; la liste de <span ;="" roman="" new="" times="" style="font-size: 12pt;">test".</span></p>', 4, 'COLOR', 0, 'COLOR', 'COLOR', 2, '100%', 0, 0, 7),
(22, 'Menu de gauche', 'Hermes v 4.00', '<div align="center"><font color="#0000ff"><em><strong>Mes sites pr&eacute;f&eacute;r&eacute;s :</strong></em></font><br /><a href="http://frxoops.org/">Xoops France</a><br /><a href="http://xoops.kiolo.com/">Mon site de test</a><br /><a href="http://ace.wakasensei.fr">Mon club</a><br /><br /><font color="#ff00ff"><em><strong>Mes modules :</strong></em></font><br /><a href="http://xoops.kiolo.com/modules/mydownloads/viewcat.php?cid=5">Hermes</a><br /><a href="http://xoops.kiolo.com/modules/mydownloads/viewcat.php?cid=7">Lexique</a><br /><a href="http://xoops.kiolo.com/modules/mydownloads/viewcat.php?cid=6">jjd_tools</a></div>', 4, 'COLOR', 0, 'COLOR', 'COLOR', 2, '100%', 0, 0, 2),
(28, 'présentation générale bis', 'Hermes v 4.00', '<div align="center"><font size="+1" color="#0000ff">Block vide<br />pour test template</font></div>', 4, 'COLOR', 0, 'COLOR', 'COLOR', 2, '100%', 0, 0, 2),
(27, 'menu niveau  sondage', 'Hermes v 4.00', 'Voici un exemple de sondage.<br />Je vous remercie de votre participation.<br />Les r&eacute;sulat pour l''instant ne sont visible que dans l''administration du module.<br />La prochaine version proposera une pr&eacute;sentation des sondages c&ocirc;t&eacute; internaute.<br /><a href="http://xoops.kiolo.com/modules/mydownloads/viewcat.php?cid=6"></a>', 7, 'COLOR', 0, 'COLOR', 'COLOR', 2, '100%', 0, 0, 2),
(24, 'Présentation - Template', 'Hermes v 4.00', '<strong>Template de lettre:</strong> Il y avait d&eacute;j&agrave; les templates pour les<br /><p align="left" class="MsoNormal">plugins, maintenant il y a les templates pour la lettre principale. Il est<br />possible d&eacute;sormais de d&eacute;finir une structure simple avec par exemple un bloc en<br />haut, un bloc &agrave; gauche, un bloc central et un bloc de pied.<o:p></o:p></p><div align="left">Il suffit de d&eacute;finir les blocs dans le template avec un tableau par exemple, et d''y ins&eacute;rer une balise "Smarty". Ensuite dans la structure de la lettre affecter chaque &eacute;l&eacute;ment &agrave; un des blocs d&eacute;finis dans le template.<o:p></o:p></div><p align="left" class="MsoNormal">La pr&eacute;sente lettre donne un aper&ccedil;u de cette nouvelle possibilit&eacute;.<o:p></o:p></p><div align="left">Le dossier "modules/templates/letter/" contient des exemples de template.<span style="font-size: 12pt;" times="" new="" roman="" ;=""></span></div>', 4, 'COLOR', 0, 'COLOR', 'COLOR', 0, '100%', 0, 0, 7),
(25, 'Présentation - Sondage', 'Hermes v 4.00', '<strong>Sondage : </strong>Il est maintenant possible de faire des sondages.<br />Ils consiste en une question , un texte de pr&eacute;sentation et un ensemble de r&eacute;ponses.<o:p></o:p><br /><p class="MsoNormal">Chaque fois qu''un destinataire cliquera sur un des liens de r&eacute;ponse, il sera comptabilis&eacute;. L''onglet sondage permet de visualiser les r&eacute;sultats dans l''administration.</p><p class="MsoNormal">Les r&eacute;sultats sont aussi accessibles dans le menu de Hermes sur la page d''accueil.<br /><o:p></o:p></p>Dans le pied de cette lettre vous pourrez y voir un exemple (Merci de cliquer sur une des r&eacute;ponses).<br /><strong>Pour la mise en oeuvre</strong> : Dans l''onglet sondage cr&eacute;er en un nouveau sans oublier d''ajouter plusieurs r&eacute;ponses. Ensuite cr&eacute;er une zone de texte (onglet "texte") et ins&eacute;rer le sondage &agrave; l''aide des codes situ&eacute;s sous la zone de texte. Pour finir dans la structure de la lettre ajouter le texte qui vient d''&ecirc;tre cr&eacute;er<span style="font-size: 12pt;" times="" new="" roman="" ;=""></span>', 4, 'COLOR', 0, 'COLOR', 'COLOR', 2, '100%', 0, 0, 7),
(29, 'présentation générale ter', 'Hermes v 4.00', '<div align="center"><font size="+1" color="#0000ff">Un autre Block vide pour test template</font></div>', 4, 'COLOR', 0, 'COLOR', 'COLOR', 2, '100%', 0, 0, 2),
(26, 'Présentation - Décoration', 'Hermes v 4.00', '<strong>D&eacute;coration :</strong> Dans la version pr&eacute;c&eacute;dente j''avais introduit la notion de mod&egrave;le de cadre pour &eacute;viter de les red&eacute;finir pour chaque texte. Cette notion existe toujours mais a &eacute;t&eacute; remplacer par une fonctionnalit&eacute; plus riches dans l''onglet "D&eacute;coration". Il est possible de cr&eacute;er des mod&egrave;les de cadre, mais aussi des bandeaux, des lignes de s&eacute;parations, ect..<br />Les bandeaux d&eacute;finissent une bande de couleur avec un cadre &eacute;ventuellement, qui reprends le nom d&eacute;fini dans la structure de la lettre. Cela permet par exemple de faire des titres de paragraphes.<o:p></o:p><br /><p class="MsoNormal">Les "marquee" permettent aussi de faire la m&ecirc;me chose, mais avec le texte qui d&eacute;file de droite &agrave; gauche par exemple.</p><p class="MsoNormal"><strong>Mise en oeuvre:</strong> Dans l''onglet d&eacute;coration cr&eacute;er un bandeau<br />par exemple, avec les options ad&eacute;quates, puis ins&eacute;rer dans la structure de la<br />lettre.<o:p></o:p></p><strong>Note </strong>: Les lignes de s&eacute;paration dans la structure de la lettre ont &eacute;t&eacute; supprim&eacute;es au profit de ces d&eacute;corations plus souple et plus compl&egrave;tes.<span style="font-size: 12pt;" times="" new="" roman="" ;=""></span>', 4, 'COLOR', 0, 'COLOR', 'COLOR', 0, '100%', 0, 0, 7);

## ########################################################

##
## Structure de la table `her_url`
##

CREATE TABLE `her_url` (
  `idUrl` bigint(20) NOT NULL auto_increment,
  `url` varchar(255) default NULL,
  `description` varchar(255) default NULL,
  `categorie` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`idUrl`)
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_url`
##


## ########################################################

##
## Structure de la table `her_users`
##

CREATE TABLE `her_users` (
  `idUsers` bigint(20) NOT NULL auto_increment,
  `idUser` int(10) unsigned NOT NULL default '0',
  `idLettre` bigint(20) NOT NULL default '0',
  `state` int(10) unsigned default NULL,
  `email` varchar(60) NOT NULL default '',
  `dateMaj` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`idUsers`)
) ENGINE=MyISAM; ;

##
## Contenu de la table `her_users`
##



CREATE TABLE `her_souscription` (
  `idSouscription` bigint(20) NOT NULL default '0',
  `email` varchar(60) NOT NULL,
  `name` varchar(60) NOT NULL,
  PRIMARY KEY  (`idSouscription`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM; ;


# ########################################################

INSERT INTO `jjd_versions` (`module`, `code`, `version`, `dateVersion`, `libelle`) VALUES
('hermes', 'her_3_04a.php', '3.04a', '2008-05-22 12:12:12', 'Gestion es sondages'),
('hermes', 'her_2_09.php', '2.09', '2008-01-30 12:12:12', 'creation des tables cession, temp, ...'),
('hermes', 'her_2_10.php', '2.10', '2008-01-25 12:12:12', 'Test version 2.10'),
('hermes', 'her_2_19a.php', '2.19a', '2008-03-18 12:12:12', 'Misà jour : Libelle,Archive,Cession,FluxRss,Lettre,Params,Plugin,Structure,Style,Texte,Users'),
('hermes', 'her_2_10a.php', '2.10a', '2008-01-25 12:12:12', 'Test version 2.10a'),
('hermes', 'her_2_13a.php', '2.13a', '2008-02-16 12:12:12', 'Ajout de la table <subscription>'),
('hermes', 'her_2_14a.php', '2.14a', '2008-01-25 12:12:12', 'Ajout de la table fluxrss'),
('hermes', 'her_2_17a.php', '2.17a', '2008-03-05 12:12:12', 'Modification de la l ''index unique de her_temp sur idCession et eMail'),
('hermes', 'her_2_21a.php', '2.21a', '2008-04-05 12:12:12', 'Mis a jour des tables du module'),
('hermes', 'her_2_18a.php', '2.18a', '2008-03-05 12:12:12', 'Mise à jour : style'),
('hermes', 'her_2_20a.php', '2.20a', '2008-04-03 12:12:12', 'Misà jour : Ajout d''une liste ''email de test dans lettre'),
('hermes', 'her_2_26a.php', '2.26a', '2008-04-30 12:12:12', 'Gestion des statistiques'),
('hermes', 'her_2_26b.php', '2.26b', '2008-05-09 12:12:12', 'A jout du champ listecomplementaire2 dans cession'),
('hermes', 'her_3_05a.php', '3.05a', '2008-06-01 12:12:12', 'Gestion des templates de lettres'),
('hermes', 'her_4_07a.php', '4.07a', '2008-09-25 12:12:12', 'Ajout des souscriptions');



  