CREATE TABLE `tdmspot_newblocks` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `bid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `options` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `side` varchar(255) NOT NULL DEFAULT '',
  `weight` smallint(5) unsigned NOT NULL DEFAULT '0',
  `visible` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) TYPE=MyISAM;

CREATE TABLE `tdmspot_page` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL DEFAULT '',
  `weight` smallint(5) unsigned NOT NULL DEFAULT '0',
  `visible` tinyint(1) unsigned NOT NULL DEFAULT '0',  
  `cat` text, 
  `limit` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) TYPE=MyISAM;

CREATE TABLE `tdmspot_cat` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `pid` int(11) unsigned NOT NULL default '0',
  `title` varchar(50) NOT NULL default '',
  `date` int(11) NOT NULL default '0',
  `text` text,
  `img` varchar(100) default NULL,
  `weight` int(11) unsigned NOT NULL default '0',
  `display` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE `tdmspot_item` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `cat` int(10) unsigned NOT NULL default '0',
  `title` varchar(50) NOT NULL default '',
  `text` text,
  `display` int(1) NOT NULL default '0',
  `file` text,
  `indate` int(10) unsigned NOT NULL default '0',
  `hits` int(10) unsigned NOT NULL default '0',
  `votes` int(10) unsigned NOT NULL default '0',
  `counts` int(10) unsigned NOT NULL default '0',
  `comments` int(11) unsigned NOT NULL default '0',
  `poster` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE `tdmspot_vote` (
  `vote_id` int(8) unsigned NOT NULL auto_increment,
  `vote_file` int(10) unsigned NOT NULL default '0',
  `vote_album` int(10) unsigned NOT NULL default '0',
  `vote_artiste` int(10) unsigned NOT NULL default '0',
  `vote_ip` varchar(20) default NULL,
  PRIMARY KEY  (`vote_id`)
) TYPE=MyISAM;