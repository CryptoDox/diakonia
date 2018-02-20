CREATE TABLE `tdmtchat_tchat` (
  `tchat_id` mediumint(8) unsigned NOT NULL auto_increment,
  `tchat_pid` mediumint(8) unsigned NOT NULL default '0',
  `tchat_from` varchar(255) NOT NULL DEFAULT '',
  `tchat_to` varchar(255) default NULL,
  `tchat_message` TEXT NOT NULL,
   `tchat_sent` int(10) unsigned NOT NULL default '0',
   `tchat_recd` INTEGER UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`tchat_id`),
  KEY `from` (`tchat_from`),
  KEY `to` (`tchat_to`)
) TYPE=MyISAM;