

CREATE TABLE `tdmnotify_block` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `pid` text,
  `title` varchar(255) NOT NULL DEFAULT '',
  `text` text,
  `img` varchar(100) default NULL,
  `style` varchar(255) NOT NULL DEFAULT '',
  `alt` varchar(255) NOT NULL DEFAULT '',
   `indate` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY (`id`)
) TYPE=MyISAM;

CREATE TABLE `tdmnotify_notif` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `block` int(10) unsigned NOT NULL default '0',
  `url`  varchar(255) NOT NULL DEFAULT '',
  `ip` int(10) unsigned NOT NULL DEFAULT '0', 
  `indate` int(10) unsigned NOT NULL default '0',
  `poster` int(10) unsigned NOT NULL default '0',
  `inread` int(1) unsigned NOT NULL default '0',
  `form` text,
  PRIMARY KEY (`id`)
) TYPE=MyISAM;

CREATE TABLE `tdmnotify_form` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `champ` varchar(255) NOT NULL DEFAULT '',
  `size` smallint(5) unsigned NOT NULL DEFAULT '0',
  `limit` smallint(5) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `option` text,
  `label` text,  
  PRIMARY KEY (`id`)
) TYPE=MyISAM;