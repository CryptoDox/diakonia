CREATE TABLE `tad_gallery` (
  `sn` smallint(5) unsigned NOT NULL auto_increment,
  `csn` smallint(5) unsigned NOT NULL,
  `title` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  `filename` varchar(255) NOT NULL default '',
  `size` mediumint(8) unsigned NOT NULL,
  `type` varchar(255) NOT NULL default '',
  `width` smallint(5) unsigned NOT NULL,
  `height` smallint(5) unsigned NOT NULL,
  `dir` varchar(255) NOT NULL,
  `uid` smallint(5) unsigned NOT NULL,
  `post_date` varchar(255) NOT NULL default '',
  `counter` smallint(5) unsigned NOT NULL,
  `exif` text NOT NULL,
  `tag` varchar(255) NOT NULL default '',
  `good` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`sn`),
  FULLTEXT KEY `tag` (`tag`)
) TYPE=MyISAM ;



CREATE TABLE `tad_gallery_cate` (
  `csn` smallint(5) unsigned NOT NULL auto_increment,
  `of_csn` smallint(5) unsigned NOT NULL,
  `title` varchar(255) NOT NULL default '',
  `passwd` varchar(255) NOT NULL,
  `enable_group` varchar(255) NOT NULL default '',
  `enable_upload_group` varchar(255) NOT NULL,
  `sort` smallint(5) unsigned NOT NULL,
  `mode` varchar(255) NOT NULL,
  `show_mode` varchar(255) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `no_hotlink` varchar(255) NOT NULL,
  `uid` smallint(5) NOT NULL,
  PRIMARY KEY  (`csn`)
) TYPE=MyISAM ;
