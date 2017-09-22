DROP TABLE IF EXISTS `entries`;

CREATE TABLE `entries` (
  `idEntry` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `headline` VARCHAR(100) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `body` TEXT COLLATE utf8_slovenian_ci,
  `email` VARCHAR(100) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `weburl` VARCHAR(250) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `idUser` INT(11) DEFAULT NULL,
  `datestamp` DATETIME NOT NULL,
  `deleted` TINYINT(1) NOT NULL,
  PRIMARY KEY (`idEntry`)
) ENGINE=INNODB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `idRole` INT(10) UNSIGNED NOT NULL,
  `ShortDesc` VARCHAR(25) COLLATE utf8_slovenian_ci NOT NULL,
  `Description` VARCHAR(150) COLLATE utf8_slovenian_ci DEFAULT NULL,
  PRIMARY KEY (`idRole`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

INSERT  INTO `roles`(`idRole`,`ShortDesc`,`Description`) VALUES (0,'admin','Microblog administrator'),(1,'pisec','Pisec objav'),(2,'bralec','Bralec objav');

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(25) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `password` VARCHAR(25) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `userLevelId` INT(1) UNSIGNED ZEROFILL NOT NULL,
  `deleted` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

INSERT  INTO `users`(`id`,`username`,`password`,`userLevelId`,`deleted`) VALUES (1,'demo','demo',0,0);

DROP TABLE IF EXISTS `emails`;

CREATE TABLE `emails` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email_address` VARCHAR(180) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `datestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;