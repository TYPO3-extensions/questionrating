#
# Table structure for table 'tx_questionrating_domain_model_question'
#
CREATE TABLE tx_questionrating_domain_model_question (
  uid int(11) NOT NULL auto_increment,
  pid int(11) DEFAULT '0' NOT NULL,
  tstamp int(11) DEFAULT '0' NOT NULL,
  crdate int(11) DEFAULT '0' NOT NULL,
  cruser_id int(11) DEFAULT '0' NOT NULL,
  deleted tinyint(4) DEFAULT '0' NOT NULL,
  hidden tinyint(4) DEFAULT '0' NOT NULL,
  xml_id varchar(255) DEFAULT '' NOT NULL,
  status varchar(7) DEFAULT '' NOT NULL,
  active tinyint(3) DEFAULT '0' NOT NULL,
  questiontext text,
  answer1text text,
  answer2text text,
  answer3text text,
  answer4text text,
  answer5text text,
  answer6text text,
  answer7text text,
  answer8text text,
  answer9text text,
  answer10text text,
  correctanswer varchar(255) DEFAULT '' NOT NULL,
  ratings int(11) unsigned DEFAULT '0' NOT NULL,
  
  discussions int(11) unsigned DEFAULT '0' NOT NULL,
  
  PRIMARY KEY (uid),
  KEY parent (pid)
);

#
# Table structure for table 'tx_questionrating_domain_model_rating'
#
CREATE TABLE tx_questionrating_domain_model_rating (
  uid int(11) NOT NULL auto_increment,
  pid int(11) DEFAULT '0' NOT NULL,
  tstamp int(11) DEFAULT '0' NOT NULL,
  crdate int(11) DEFAULT '0' NOT NULL,
  cruser_id int(11) DEFAULT '0' NOT NULL,
  deleted tinyint(4) DEFAULT '0' NOT NULL,
  hidden tinyint(4) DEFAULT '0' NOT NULL,
  user int(255) DEFAULT '0' NOT NULL,
  question int(255) DEFAULT '0' NOT NULL,
  rating_value int(11) DEFAULT '0' NOT NULL,
  final_rating tinyint(3) DEFAULT '0' NOT NULL,
  final_rating_value int(11) DEFAULT '0' NOT NULL,
  
  PRIMARY KEY (uid),
  KEY parent (pid)
);

#
# Table structure for table 'tx_questionrating_domain_model_discussion'
#
CREATE TABLE tx_questionrating_domain_model_discussion (
  uid int(11) NOT NULL auto_increment,
  pid int(11) DEFAULT '0' NOT NULL,
  tstamp int(11) DEFAULT '0' NOT NULL,
  crdate int(11) DEFAULT '0' NOT NULL,
  cruser_id int(11) DEFAULT '0' NOT NULL,
  deleted tinyint(4) DEFAULT '0' NOT NULL,
  hidden tinyint(4) DEFAULT '0' NOT NULL,
  from_user int(255) DEFAULT '0' NOT NULL,
  from_leader tinyint(3) DEFAULT '0' NOT NULL,
  to_user int(255) DEFAULT '0' NOT NULL,
  to_leader tinyint(3) DEFAULT '0' NOT NULL,
  question int(255) DEFAULT '0' NOT NULL,
  message text,
  
  PRIMARY KEY (uid),
  KEY parent (pid)
);


#
# Table structure for table 'tx_questionrating_domain_model_review'
#
CREATE TABLE tx_questionrating_domain_model_review (
    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,
    tstamp int(11) DEFAULT '0' NOT NULL,
    crdate int(11) DEFAULT '0' NOT NULL,
    cruser_id int(11) DEFAULT '0' NOT NULL,
    deleted tinyint(4) DEFAULT '0' NOT NULL,
    hidden tinyint(4) DEFAULT '0' NOT NULL,
    xml_id tinytext,
    headline text,
    status tinytext,
    votes int(11) DEFAULT '0' NOT NULL,
    reviewcomments int(11) DEFAULT '0' NOT NULL,
    
    PRIMARY KEY (uid),
    KEY parent (pid)
);



#
# Table structure for table 'tx_questionrating_domain_model_reviewcomment'
#
CREATE TABLE tx_questionrating_domain_model_reviewcomment (
    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,
    tstamp int(11) DEFAULT '0' NOT NULL,
    crdate int(11) DEFAULT '0' NOT NULL,
    cruser_id int(11) DEFAULT '0' NOT NULL,
    deleted tinyint(4) DEFAULT '0' NOT NULL,
    hidden tinyint(4) DEFAULT '0' NOT NULL,
    message text,
    review int(11) DEFAULT '0' NOT NULL,
    user int(11) DEFAULT '0' NOT NULL,
    
    PRIMARY KEY (uid),
    KEY parent (pid)
);

