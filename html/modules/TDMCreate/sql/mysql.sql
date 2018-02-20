CREATE TABLE  `tdmcreate_modules` (
  `modules_id` int(5) NOT NULL  auto_increment,
  `modules_name` varchar(255) NOT NULL,
  `modules_version` decimal(12,2) NOT NULL default '0.00',
  `modules_description` text,
  `modules_author` varchar(255) default NULL,
  `modules_author_website_url` varchar(255) default NULL,
  `modules_author_website_name` varchar(255) default NULL,
  `modules_credits` varchar(255) default NULL,
  `modules_license` varchar(255) default NULL,
  `modules_release_info` varchar(255) default NULL,
  `modules_release_file` varchar(255) default NULL,
  `modules_manual` varchar(255) default NULL,
  `modules_manual_file` varchar(255) default NULL,
  `modules_image` varchar(255) default NULL,
  `modules_demo_site_url` varchar(255) default NULL,
  `modules_demo_site_name` varchar(255) default NULL,
  `modules_module_website_url` varchar(255) default NULL,
  `modules_module_website_name` varchar(255) default NULL,
  `modules_release` int(8) NOT NULL default '0',  
  `modules_module_status` varchar(255) default NULL,
  `modules_display_menu` tinyint(1) NOT NULL default '1',
  `modules_display_admin` tinyint(1) NOT NULL default '1',
  `modules_active_search` tinyint(1) NOT NULL default '1',
  PRIMARY KEY (`modules_id`)
) ENGINE=MyISAM;


CREATE TABLE  `tdmcreate_tables` (
  `tables_id` int(5) NOT NULL  auto_increment,
  `tables_modules` int(5) NOT NULL default '0', 
  `tables_module_table` varchar(255) default NULL,
  `tables_name` varchar(255) default NULL,
  `tables_img` varchar(255) default NULL,
  `tables_nb_champs` int(5) NOT NULL default '0', 
  `tables_champs` text,
  `tables_parametres` text,
  `tables_blocs` tinyint(1) NOT NULL default '1',
  `tables_display_admin` tinyint(1) NOT NULL default '1',
  `tables_search` tinyint(1) NOT NULL default '0',
  `tables_coms` tinyint(1) NOT NULL default '0',
  PRIMARY KEY (`tables_id`)
) ENGINE=MyISAM;