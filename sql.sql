DROP TABLE IF EXISTS `checking_emails`;
CREATE TABLE `checking_emails` (
  `email` varchar(255) NOT NULL,
  `started` datetime NOT NULL,
  `pid` int(12) unsigned NOT NULL,
  PRIMARY KEY (`email`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `emails`;
CREATE TABLE `emails` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `checked` tinyint(1) NOT NULL DEFAULT 0,
  `valid` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `sending_emails`;
CREATE TABLE `sending_emails` (
  `email` varchar(255) NOT NULL,
  `started` datetime NOT NULL,
  `pid` int(12) unsigned NOT NULL,
  `done` tinyint(1) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`email`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `validts` int(11) unsigned DEFAULT NULL,
  `confirmed` tinyint(1) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

