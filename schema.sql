SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) collate utf8_bin NOT NULL default '0',
  `ip_address` varchar(16) collate utf8_bin NOT NULL default '0',
  `user_agent` varchar(150) collate utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL default '0',
  `user_data` text collate utf8_bin NOT NULL,
  PRIMARY KEY  (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `dojos`
--

DROP TABLE IF EXISTS `dojos`;
CREATE TABLE IF NOT EXISTS `dojos` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(100) character set utf8 collate utf8_bin NOT NULL,
  `creator` int(20) NOT NULL,
  `created` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `verified` tinyint(1) unsigned NOT NULL default '0',
  `verified_at` timestamp NULL default NULL,
  `verified_by` int(20) default NULL,
  `need_mentors` tinyint(1) unsigned NOT NULL default '0',
  `stage` tinyint(1) unsigned NOT NULL default '0',
  `time` varchar(100) character set utf8 collate utf8_bin default NULL,
  `country` varchar(2) character set utf8 collate utf8_bin default NULL,
  `location` varchar(200) character set utf8 collate utf8_bin default NULL,
  `coordinates` varchar(50) character set utf8 collate utf8_bin default NULL,
  `notes` text character set utf8 collate utf8_bin,
  `email` varchar(100) character set utf8 collate utf8_bin default NULL,
  `website` varchar(200) character set utf8 collate utf8_bin default NULL,
  `twitter` varchar(100) character set utf8 collate utf8_bin default NULL,
  `google_group` varchar(200) character set utf8 collate utf8_bin default NULL,
  `eb_id` varchar(25) character set utf8 collate utf8_bin default NULL,
  `supporter_image` varchar(200) character set utf8 collate utf8_bin default NULL,
  `deleted` tinyint(1) NOT NULL default '0',
  `deleted_by` int(11) default NULL,
  `deleted_at` timestamp NULL default NULL,
  PRIMARY KEY  (`id`),
  KEY `creator` (`creator`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL auto_increment,
  `ip_address` varchar(40) collate utf8_bin NOT NULL,
  `login` varchar(50) collate utf8_bin NOT NULL,
  `time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(50) collate utf8_bin NOT NULL,
  `password` varchar(255) collate utf8_bin NOT NULL,
  `email` varchar(100) collate utf8_bin NOT NULL,
  `level` int(10) NOT NULL default '0',
  `activated` tinyint(1) NOT NULL default '1',
  `banned` tinyint(1) NOT NULL default '0',
  `ban_reason` varchar(255) collate utf8_bin default NULL,
  `new_password_key` varchar(50) collate utf8_bin default NULL,
  `new_password_requested` datetime default NULL,
  `new_email` varchar(100) collate utf8_bin default NULL,
  `new_email_key` varchar(50) collate utf8_bin default NULL,
  `last_ip` varchar(40) collate utf8_bin NOT NULL,
  `last_login` datetime NOT NULL default '0000-00-00 00:00:00',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_autologin`
--

DROP TABLE IF EXISTS `user_autologin`;
CREATE TABLE IF NOT EXISTS `user_autologin` (
  `key_id` char(32) collate utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL default '0',
  `user_agent` varchar(150) collate utf8_bin NOT NULL,
  `last_ip` varchar(40) collate utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_dojos`
--

DROP TABLE IF EXISTS `user_dojos`;
CREATE TABLE IF NOT EXISTS `user_dojos` (
  `user_id` int(11) NOT NULL default '0',
  `dojo_id` int(10) unsigned NOT NULL default '0',
  `owner` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`user_id`,`dojo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

DROP TABLE IF EXISTS `user_profiles`;
CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(10) unsigned NOT NULL,
  `role` int(10) NOT NULL default '1',
  `dojo` int(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `dojo` (`dojo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;