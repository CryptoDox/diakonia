# wsProject - database structur
# Version 1.0


#
# Table structure for table 'ws_restrictions'
#

CREATE TABLE ws_restrictions (
  res_id tinyint(3) unsigned NOT NULL auto_increment,
  user_id tinyint(3) unsigned default '0',
  group_id tinyint(3) unsigned default '0',
  task_id tinyint(3) unsigned default '0',
  project_id tinyint(3) unsigned default '0',
  user_rank tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (res_id),
  UNIQUE KEY res_id (res_id),
  KEY res_id_2 (res_id)
) ENGINE=MyISAM;

#
# Table structure for table 'project'
# This table contains your configuration
#

CREATE TABLE ws_project (
  conf_id tinyint(3) unsigned NOT NULL auto_increment,
  conf_name varchar(20) NOT NULL default '0',
  conf_value varchar(20) NOT NULL default '0',
  UNIQUE KEY conf_id (conf_id),
  KEY conf_id_2 (conf_id)
) ENGINE=MyISAM COMMENT='Config for wsProject';

#
# Table structure for table 'projects'
# This table contains your projects
#

CREATE TABLE ws_projects (
  project_id int(10) unsigned NOT NULL auto_increment,
  name varchar(100) default NULL,
  startdate date default NULL,
  enddate date default NULL,
  description text,
  completed tinyint(1) default '0',
  completed_date date default NULL,
  deleted tinyint(1) unsigned default '0',
  PRIMARY KEY  (project_id)
) ENGINE=MyISAM;



#
# Table structure for table 'tasks'
#

CREATE TABLE ws_tasks (
  task_id int(10) unsigned NOT NULL auto_increment,
  project_id int(10) unsigned NOT NULL default '1',
  user_id mediumint(8) unsigned NOT NULL default '0',  
  title varchar(100) default NULL,
  hours decimal(4,2) NOT NULL default '1.00',
  startdate datetime default NULL,
  enddate datetime default NULL,
  description text,
  status int(3) unsigned default '0',  
  public tinyint(1) unsigned NOT NULL default '1',
  parent_id int(10) NOT NULL default '0',
  image varchar(50) NOT NULL default 'none',
  deleted tinyint(1) unsigned default '0',
  PRIMARY KEY  (task_id),
  KEY project_id (project_id),
  KEY user_id (user_id)
) ENGINE=MyISAM;

