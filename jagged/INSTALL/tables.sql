CREATE DATABASE jagged;
USE jagged;
-- MySQL dump 9.07
--
-- Host: localhost    Database: jagged
---------------------------------------------------------
-- Server version	4.0.12-log

--
-- Table structure for table 'jagged_sessions'
--

CREATE TABLE jagged_sessions (
  SID varchar(32) NOT NULL default '',
  expiration int(11) NOT NULL default '0',
  value text NOT NULL,
  PRIMARY KEY  (SID)
) TYPE=MyISAM;

--
-- Table structure for table 'jagged_users'
--

CREATE TABLE jagged_users (
  uname varchar(255) NOT NULL default '',
  passwd varchar(32) NOT NULL default '',
  sid1 varchar(32) default NULL,
  sid2 varchar(32) default NULL,
  alias varchar(255) default NULL,
  email varchar(255) NOT NULL default '',
  theme varchar(255) NOT NULL default 'default',
  PRIMARY KEY  (uname),
  UNIQUE KEY uname (uname)
) TYPE=MyISAM;

