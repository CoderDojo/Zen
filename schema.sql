SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS `dojos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `creator` int(20) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `verified` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `need_mentors` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `stage` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `time` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `country` varchar(2) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `location` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `coordinates` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `notes` text CHARACTER SET utf8 COLLATE utf8_bin,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `twitter` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `google_group` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `eb_id` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `supporter_image` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `creator` (`creator`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `level` int(10) NOT NULL DEFAULT '0',
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

CREATE TABLE IF NOT EXISTS `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role` int(10) NOT NULL DEFAULT '1',
  `dojo` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dojo` (`dojo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

-- Table structure for table `countries`

CREATE TABLE IF NOT EXISTS `countries` (
  `code` varchar(2) NOT NULL COMMENT 'Country Code, such as US, GB, IE, etc.',
  `name` varchar(100) NOT NULL COMMENT 'Country Name',
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Reference table used to translate Country Codes into names.';

-- Insert Data for table `countries`
-- INSERT IGNORE is used to prevent the statements from failing if a Country with
-- the same Code already exists in the database. This method is a "quick and dirty"
-- solution and should be improved.
SET FOREIGN_KEY_CHECKS=0;
SET AUTOCOMMIT=0;
START TRANSACTION;

INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('AD', 'Andorra');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('AE', 'United Arab Emirates');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('AF', 'Afghanistan');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('AG', 'Antigua And Barbuda');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('AI', 'Anguilla');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('AL', 'Albania');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('AM', 'Armenia');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('AN', 'Netherlands Antilles');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('AO', 'Angola');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('AQ', 'Antarctica');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('AR', 'Argentina');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('AS', 'American Samoa');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('AT', 'Austria');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('AU', 'Australia');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('AW', 'Aruba');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('AZ', 'Azerbaijan');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('BA', 'Bosnia And Herzegowina');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('BB', 'Barbados');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('BD', 'Bangladesh');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('BE', 'Belgium');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('BF', 'Burkina Faso');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('BG', 'Bulgaria');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('BH', 'Bahrain');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('BI', 'Burundi');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('BJ', 'Benin');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('BM', 'Bermuda');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('BN', 'Brunei Darussalam');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('BO', 'Bolivia');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('BR', 'Brazil');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('BS', 'Bahamas');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('BT', 'Bhutan');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('BV', 'Bouvet Island');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('BW', 'Botswana');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('BY', 'Belarus');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('BZ', 'Belize');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('CA', 'Canada');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('CC', 'Cocos (Keeling) Islands');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('CD', 'Congo, The Democratic Republic Of The');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('CF', 'Central African Republic');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('CG', 'Congo');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('CH', 'Switzerland');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('CI', 'Cote D''Ivoire');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('CK', 'Cook Islands');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('CL', 'Chile');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('CM', 'Cameroon');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('CN', 'China');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('CO', 'Colombia');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('CR', 'Costa Rica');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('CU', 'Cuba');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('CV', 'Cape Verde');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('CX', 'Christmas Island');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('CY', 'Cyprus');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('CZ', 'Czech Republic');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('DE', 'Germany');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('DJ', 'Djibouti');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('DK', 'Denmark');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('DM', 'Dominica');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('DO', 'Dominican Republic');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('DZ', 'Algeria');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('EC', 'Ecuador');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('EE', 'Estonia');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('EG', 'Egypt');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('EH', 'Western Sahara');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('ER', 'Eritrea');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('ES', 'Spain');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('ET', 'Ethiopia');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('FI', 'Finland');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('FJ', 'Fiji');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('FK', 'Falkland Islands (Malvinas)');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('FM', 'Micronesia, Federated States Of');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('FO', 'Faroe Islands');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('FR', 'France');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('FX', 'France, Metropolitan');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('GA', 'Gabon');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('GB', 'United Kingdom');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('GD', 'Grenada');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('GE', 'Georgia');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('GF', 'French Guiana');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('GH', 'Ghana');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('GI', 'Gibraltar');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('GL', 'Greenland');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('GM', 'Gambia');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('GN', 'Guinea');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('GP', 'Guadeloupe');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('GQ', 'Equatorial Guinea');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('GR', 'Greece');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('GS', 'South Georgia, South Sandwich Islands');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('GT', 'Guatemala');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('GU', 'Guam');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('GW', 'Guinea-Bissau');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('GY', 'Guyana');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('HK', 'Hong Kong');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('HM', 'Heard And Mc Donald Islands');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('HN', 'Honduras');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('HR', 'Croatia (Local Name: Hrvatska)');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('HT', 'Haiti');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('HU', 'Hungary');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('ID', 'Indonesia');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('IE', 'Ireland');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('IL', 'Israel');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('IN', 'India');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('IO', 'British Indian Ocean Territory');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('IQ', 'Iraq');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('IR', 'Iran (Islamic Republic Of)');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('IS', 'Iceland');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('IT', 'Italy');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('JM', 'Jamaica');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('JO', 'Jordan');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('JP', 'Japan');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('KE', 'Kenya');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('KG', 'Kyrgyzstan');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('KH', 'Cambodia');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('KI', 'Kiribati');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('KM', 'Comoros');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('KN', 'Saint Kitts And Nevis');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('KP', 'Korea, Democratic People''s Republic Of');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('KR', 'Korea, Republic Of');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('KW', 'Kuwait');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('KY', 'Cayman Islands');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('KZ', 'Kazakhstan');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('LA', 'Lao People''s Democratic Republic');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('LB', 'Lebanon');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('LC', 'Saint Lucia');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('LI', 'Liechtenstein');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('LK', 'Sri Lanka');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('LR', 'Liberia');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('LS', 'Lesotho');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('LT', 'Lithuania');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('LU', 'Luxembourg');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('LV', 'Latvia');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('LY', 'Libyan Arab Jamahiriya');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('MA', 'Morocco');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('MC', 'Monaco');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('MD', 'Moldova, Republic Of');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('MG', 'Madagascar');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('MH', 'Marshall Islands');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('MK', 'Macedonia, Former Yugoslav Republic Of');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('ML', 'Mali');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('MM', 'Myanmar');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('MN', 'Mongolia');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('MO', 'Macau');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('MP', 'Northern Mariana Islands');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('MQ', 'Martinique');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('MR', 'Mauritania');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('MS', 'Montserrat');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('MT', 'Malta');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('MU', 'Mauritius');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('MV', 'Maldives');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('MW', 'Malawi');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('MX', 'Mexico');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('MY', 'Malaysia');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('MZ', 'Mozambique');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('NA', 'Namibia');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('NC', 'New Caledonia');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('NE', 'Niger');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('NF', 'Norfolk Island');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('NG', 'Nigeria');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('NI', 'Nicaragua');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('NL', 'Netherlands');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('NO', 'Norway');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('NP', 'Nepal');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('NR', 'Nauru');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('NU', 'Niue');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('NZ', 'New Zealand');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('OM', 'Oman');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('PA', 'Panama');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('PE', 'Peru');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('PF', 'French Polynesia');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('PG', 'Papua New Guinea');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('PH', 'Philippines');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('PK', 'Pakistan');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('PL', 'Poland');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('PM', 'St. Pierre And Miquelon');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('PN', 'Pitcairn');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('PR', 'Puerto Rico');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('PT', 'Portugal');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('PW', 'Palau');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('PY', 'Paraguay');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('QA', 'Qatar');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('RE', 'Reunion');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('RO', 'Romania');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('RU', 'Russian Federation');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('RW', 'Rwanda');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('SA', 'Saudi Arabia');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('SB', 'Solomon Islands');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('SC', 'Seychelles');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('SD', 'Sudan');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('SE', 'Sweden');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('SG', 'Singapore');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('SH', 'St. Helena');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('SI', 'Slovenia');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('SJ', 'Svalbard And Jan Mayen Islands');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('SK', 'Slovakia (Slovak Republic)');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('SL', 'Sierra Leone');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('SM', 'San Marino');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('SN', 'Senegal');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('SO', 'Somalia');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('SR', 'Suriname');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('ST', 'Sao Tome And Principe');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('SV', 'El Salvador');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('SY', 'Syrian Arab Republic');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('SZ', 'Swaziland');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('TC', 'Turks And Caicos Islands');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('TD', 'Chad');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('TF', 'French Southern Territories');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('TG', 'Togo');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('TH', 'Thailand');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('TJ', 'Tajikistan');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('TK', 'Tokelau');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('TM', 'Turkmenistan');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('TN', 'Tunisia');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('TO', 'Tonga');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('TP', 'East Timor');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('TR', 'Turkey');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('TT', 'Trinidad And Tobago');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('TV', 'Tuvalu');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('TW', 'Taiwan');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('TZ', 'Tanzania, United Republic Of');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('UA', 'Ukraine');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('UG', 'Uganda');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('UM', 'United States Minor Outlying Islands');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('US', 'United States');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('UY', 'Uruguay');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('UZ', 'Uzbekistan');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('VA', 'Holy See (Vatican City State)');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('VC', 'Saint Vincent And The Grenadines');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('VE', 'Venezuela');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('VG', 'Virgin Islands (British)');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('VI', 'Virgin Islands (U.S.)');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('VN', 'Viet Nam');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('VU', 'Vanuatu');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('WF', 'Wallis And Futuna Islands');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('WS', 'Samoa');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('YE', 'Yemen');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('YT', 'Mayotte');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('YU', 'Yugoslavia');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('ZA', 'South Africa');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('ZM', 'Zambia');
INSERT IGNORE INTO `countries` (`code`, `name`) VALUES('ZW', 'Zimbabwe');
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
