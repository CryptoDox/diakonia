#
# Table structure for table `liaise_forms`
#
CREATE TABLE `liaise_forms` (
  `form_id` smallint(5) NOT NULL auto_increment,
  `form_send_method` char(1) NOT NULL default 'e',
  `form_send_to_group` smallint(3) NOT NULL default '0',
  `form_order` smallint(3) NOT NULL default '0',
  `form_delimiter` char(1) NOT NULL default 's',
  `form_title` varchar(255) NOT NULL default '',
  `form_submit_text` varchar(50) NOT NULL default '',
  `form_desc` text NOT NULL,
  `form_intro` text NOT NULL,
  `form_whereto` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`form_id`),
  KEY `form_order` (`form_order`)
) ENGINE=MyISAM;

#
# Dumping data for table `liaise_forms`
#
INSERT INTO `liaise_forms` VALUES (1, 'e', 0, 1, 'b', 'Send feedback', 'Submit', 'Tell us about your comments for this site.', 'Contact us by filling out this form.', '');

#
# Table structure for table `liaise_formelements`
#
CREATE TABLE `liaise_formelements` (
  `ele_id` smallint(5) unsigned NOT NULL auto_increment,
  `form_id` smallint(5) NOT NULL default '0',
  `ele_type` varchar(10) NOT NULL default '',
  `ele_caption` varchar(255) NOT NULL default '',
  `ele_order` smallint(2) NOT NULL default '0',
  `ele_req` tinyint(1) NOT NULL default '1',
  `ele_value` text NOT NULL,
  `ele_display` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`ele_id`),
  KEY `ele_display` (`ele_display`),
  KEY `ele_order` (`ele_order`)
) ENGINE=MyISAM;

#
# Dumping data for table `liaise_formelements`
#
INSERT INTO liaise_formelements VALUES (1, 1, 'checkbox', 'Was sind deine Hobbies?', 11, 1, 'a:7:{s:38:"Ich bin zu traege um Hobbies zu haben.";i:1;s:39:"Inhalte fuer Erwachsene im Netz suchen.";i:0;s:63:"Ueber sinnlose Diskussionen in Diskussionsforen zu diskutieren.";i:0;s:26:"Nach Seriennummern suchen.";i:0;s:5:"Reden";i:0;s:32:"Massenvernichtungswaffen basteln";i:0;s:10:"{OTHER|30}";i:0;}', 1);
INSERT INTO liaise_formelements VALUES (2, 1, 'text', 'Dein Name', 0, 1, 'a:3:{i:0;i:30;i:1;i:255;i:2;s:7:"{UNAME}";}', 1);
INSERT INTO liaise_formelements VALUES (3, 1, 'text', 'Email', 1, 1, 'a:3:{i:0;i:30;i:1;i:255;i:2;s:7:"{EMAIL}";}', 1);
INSERT INTO liaise_formelements VALUES (4, 1, 'text', 'Webseite', 3, 0, 'a:3:{i:0;i:30;i:1;i:255;i:2;s:7:"http://";}', 1);
INSERT INTO liaise_formelements VALUES (5, 1, 'text', 'Firma', 4, 0, 'a:3:{i:0;i:30;i:1;i:255;i:2;s:0:"";}', 1);
INSERT INTO liaise_formelements VALUES (6, 1, 'text', 'Ort', 5, 0, 'a:3:{i:0;i:30;i:1;i:255;i:2;s:0:"";}', 1);
INSERT INTO liaise_formelements VALUES (7, 1, 'textarea', 'Kommentar', 6, 1, 'a:3:{i:0;s:0:"";i:1;i:5;i:2;i:35;}', 1);
INSERT INTO liaise_formelements VALUES (8, 1, 'select', 'Wie geht es dir heute?', 7, 0, 'a:3:{i:0;i:1;i:1;i:0;i:2;a:6:{s:11:"Grossartig!";i:0;s:7:"Ist ok.";i:1;s:9:"Soso lala";i:0;s:10:"Nicht gut.";i:0;s:10:"Bin krank.";i:0;s:6:"Bitte?";i:0;}}', 1);
INSERT INTO liaise_formelements VALUES (9, 1, 'text', 'Deine Kreditkartennummer', 14, 0, 'a:3:{i:0;i:30;i:1;i:255;i:2;s:19:"Bist Du verrueckt!?";}', 1);
INSERT INTO liaise_formelements VALUES (10, 1, 'radio', 'Wie alt bist Du?', 9, 0, 'a:8:{s:3:"0-9";i:0;s:5:"10-19";i:1;s:5:"20-29";i:0;s:5:"30-39";i:0;s:5:"40-49";i:0;s:5:"50-59";i:0;s:3:"60+";i:0;s:24:"Geht dich gar nichts an.";i:0;}', 1);
INSERT INTO liaise_formelements VALUES (11, 1, 'checkbox', 'foo', 13, 0, 'a:1:{s:3:"bar";i:0;}', 0);
INSERT INTO liaise_formelements VALUES (12, 1, 'select', 'Warum hast Du einen Computer gekauft?', 8, 1, 'a:3:{i:0;i:10;i:1;i:1;i:2;a:6:{s:43:"Mein Zimmer ist zu gross fuer mich alleine.";i:1;s:24:"Ich habe keine Freundin.";i:0;s:34:"Meine Frau ist eine Quasselstrippe";i:0;s:18:"Ich mag Spam mails";i:0;s:29:"Laesst mich smart erscheinen.";i:0;s:18:"Hab ich vergessen.";i:0;}}', 1);
INSERT INTO liaise_formelements VALUES (13, 1, 'radio', 'Geschlecht', 2, 0, 'a:3:{s:9:"Maennlich";i:1;s:8:"Weiblich";i:0;s:13:"Sag ich nicht";i:0;}', 1);
INSERT INTO liaise_formelements VALUES (14, 1, 'yn', 'Glaubst Du deiner Regierung?', 12, 0, 'a:2:{s:4:"_YES";i:1;s:3:"_NO";i:0;}', 1);
INSERT INTO liaise_formelements VALUES (15, 1, 'html', '', 10, 0, 'a:3:{i:0;s:206:"Ich habe keine Ahnung was hier rein koennte. Vielleicht ein Kapitel aus der Bibel? [url=http://www.randomwebsearch.com/cgi-bin/randomWebSearch.pl?mode=generate]Klicke hier[/url] wenn Du zuviel Zeit hast ...";i:1;i:10;i:2;i:50;}', 1);

