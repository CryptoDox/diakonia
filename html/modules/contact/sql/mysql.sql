CREATE TABLE contact (
	contact_id int(10) unsigned NOT NULL auto_increment,
	contact_uid int(10) NOT NULL,
	contact_cid int(10) NOT NULL,
	contact_create int(10) NOT NULL,
	contact_subject varchar(255) NOT NULL,
	contact_name varchar(255) NOT NULL,
	contact_mail varchar(255) NOT NULL,
   contact_url varchar(255) NOT NULL,
   contact_icq varchar(255) NOT NULL,
   contact_company varchar(255) NOT NULL,
   contact_location varchar(255) NOT NULL,
	contact_department varchar(60) NOT NULL,
	contact_ip varchar(20) NOT NULL,
	contact_phone varchar(20) NOT NULL,
	contact_message text NOT NULL,
	contact_address text NOT NULL,
	contact_reply tinyint(1) NOT NULL,
	contact_platform enum('Android','Ios','Web') NOT NULL DEFAULT 'Web',
	contact_type enum('Contact','Phone','Mail') NOT NULL DEFAULT 'Contact',
   PRIMARY KEY  (contact_id),
   KEY (contact_uid),
   KEY (contact_cid),
   KEY (contact_create),
   KEY (contact_mail),
   KEY (contact_phone),
   KEY (contact_platform),
   KEY (contact_type)
) ENGINE=MyISAM;