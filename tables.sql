-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';






DROP TABLE IF EXISTS `inconceivable_log`;
CREATE TABLE `inconceivable_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` tinyint(1) NOT NULL DEFAULT '0',
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






DROP TABLE IF EXISTS `inconceivable_uprivileges`;
CREATE TABLE `inconceivable_uprivileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_status` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `name_url` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `date_reg` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_upd` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_upd` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `ref` char(8) COLLATE utf8_unicode_ci NOT NULL,
  `loops_ref` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_url` (`name_url`),
  UNIQUE KEY `ref` (`ref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `inconceivable_uprivileges` (`id`, `id_status`, `name`, `name_url`, `date_reg`, `date_upd`, `ip_upd`, `ref`, `loops_ref`) VALUES
(1, 1,  'Rule the planet',  'rule-the-planet',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1);

DELIMITER ;;

CREATE TRIGGER `serialize_privilege_name_url` BEFORE INSERT ON `inconceivable_uprivileges` FOR EACH ROW
BEGIN
     DECLARE original_name_url varchar(150);
     DECLARE name_url_counter int;
     SET original_name_url = new.name_url;
     SET name_url_counter = 1;
     WHILE EXISTS (SELECT true FROM `inconceivable_uprivileges` WHERE name_url = new.name_url) DO
        SET new.name_url = CONCAT(original_name_url, '-', name_url_counter);
        SET name_url_counter = name_url_counter + 1;
     END WHILE;

  END;;

DELIMITER ;






DROP TABLE IF EXISTS `inconceivable_ugender`;
CREATE TABLE `inconceivable_ugender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_status` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `letter` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_reg` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_upd` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_upd` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `ref` char(8) COLLATE utf8_unicode_ci NOT NULL,
  `loops_ref` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `ref` (`ref`),
  UNIQUE KEY `letter` (`letter`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `inconceivable_ugender` (`id`, `id_status`, `name`, `letter`, `date_reg`, `date_upd`, `ip_upd`, `ref`, `loops_ref`) VALUES
(1,  1,  'Male',  'm',  NOW(),  NOW(),  '0.0.0.0',  LEFT(UUID(),8), 0),
(2,  1,  'Female', 'f',  NOW(),  NOW(),  '0.0.0.0',  LEFT(UUID(),8), 0);


DELIMITER ;;

CREATE TRIGGER `serialize_gender_name` BEFORE INSERT ON `inconceivable_ugender` FOR EACH ROW
BEGIN
     DECLARE original_name varchar(255);
     DECLARE name_counter int;
     SET original_name = new.name;
     SET name_counter = 1;
     WHILE EXISTS (SELECT true FROM `inconceivable_ugender` WHERE name = new.name) DO
        SET new.name = CONCAT(original_name, ' ', name_counter);
        SET name_counter = name_counter + 1;
     END WHILE;

  END;;

DELIMITER ;






DROP TABLE IF EXISTS `inconceivable_uhierarchy`;
CREATE TABLE `inconceivable_uhierarchy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_status` tinyint(4) NOT NULL DEFAULT '0',
  `ids_privileges` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color` char(6) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ffffff',
  `date_reg` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_upd` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_upd` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `ref` char(8) COLLATE utf8_unicode_ci NOT NULL,
  `loops_ref` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `ref` (`ref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `inconceivable_uhierarchy` (`id`, `id_status`, `ids_privileges`, `sort`, `name`, `color`, `date_reg`, `date_upd`, `ip_upd`, `ref`, `loops_ref`) VALUES
(1, 1,  '1',  1, 'Admin',  '800000', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 0),
(2, 1,  '',  10, 'User',  '008000', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 0);


DELIMITER ;;

CREATE TRIGGER `serialize_hierarchy_name` BEFORE INSERT ON `inconceivable_uhierarchy` FOR EACH ROW
BEGIN
     DECLARE original_name varchar(255);
     DECLARE name_counter int;
     SET original_name = new.name;
     SET name_counter = 1;
     WHILE EXISTS (SELECT true FROM `inconceivable_uhierarchy` WHERE name = new.name) DO
        SET new.name = CONCAT(original_name, '_', name_counter);
        SET name_counter = name_counter + 1;
     END WHILE;

  END;;

DELIMITER ;






DROP TABLE IF EXISTS `inconceivable_users`;
CREATE TABLE `inconceivable_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_status` tinyint(1) NOT NULL DEFAULT '0',
  `signed_in` tinyint(1) NOT NULL DEFAULT '0',
  `uhierarchy` tinyint(2) NOT NULL DEFAULT '0',
  `id_language` tinyint(1) NOT NULL,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ugender` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hash_pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_change_hash` char(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_change_timestamp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `password_change_ip` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `password_strength` tinyint(1) NOT NULL DEFAULT '0',
  `bio` text COLLATE utf8_unicode_ci NOT NULL,
  `date_reg` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_upd` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_upd` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `ref` char(8) COLLATE utf8_unicode_ci NOT NULL,
  `loops_ref` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `ref` (`ref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `inconceivable_users` (`id`, `id_status`, `signed_in`, `uhierarchy`, `id_language`, `name`, `surname`, `username`, `ugender`, `email`, `hash_pass`, `password_change_hash`, `password_change_timestamp`, `password_change_ip`, `password_strength`, `bio`, `date_reg`, `date_upd`, `ip_upd`, `ref`, `loops_ref`) VALUES
(1, 1,  0,  1,  0,  'The Boss',  'Is In The House',  'theboss',  'm',  'email@domain.com',  '', NULL, NOW(),  '0.0.0.0',  5,  '', NOW(),  NOW(),  '0.0.0.0',  LEFT(UUID(),8), 0);

DELIMITER ;;

CREATE TRIGGER `serialize_username` BEFORE INSERT ON `inconceivable_users` FOR EACH ROW
BEGIN
     DECLARE original_username varchar(255);
     DECLARE username_counter int;
     SET original_username = new.username;
     SET username_counter = 1;
     WHILE EXISTS (SELECT true FROM `inconceivable_users` WHERE username = new.username) DO
        SET new.username = CONCAT(original_username, '_', username_counter);
        SET username_counter = username_counter + 1;
     END WHILE;

  END;;

DELIMITER ;






DROP TABLE IF EXISTS `inconceivable_example`;
CREATE TABLE `inconceivable_example` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_status` tinyint(1) NOT NULL DEFAULT '0',
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_es` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_gal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description_es` text COLLATE utf8_unicode_ci NOT NULL,
  `description_gal` text COLLATE utf8_unicode_ci NOT NULL,
  `description_en` text COLLATE utf8_unicode_ci NOT NULL,
  `ids_users` text COLLATE utf8_unicode_ci NOT NULL,
  `date_reg` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_upd` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_upd` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `ref` char(8) COLLATE utf8_unicode_ci NOT NULL,
  `loops_ref` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `inconceivable_example` (`id`, `id_status`, `code`, `title_es`, `title_gal`, `title_en`, `description_es`, `description_gal`, `description_en`, `ids_users`, `date_reg`, `date_upd`, `ip_upd`, `ref`, `loops_ref`) VALUES
(1,	1,	'DALEK',	'Doctor Who',	'Doutor Who',	'Doctor Who',	'Serie de televisión británica producida por la BBC.',	'Serie de televisión británica producida pola BBC.',	'A British television programme produced by the BBC.',	'',	'2019-02-15 14:26:59',	'2019-02-15 14:41:42',	'91.117.90.147',	'yXpDnAGv',	1),
(2,	1,	'DONT-PANIC',	'Guía del autoestopista galáctico',	'Guía do autoestopista galáctico',	'The Hitchhiker\'s Guide to the Galaxy',	'Película británica-estadounidense de comedia y ciencia ficción, estrenada en 2005 y basada en el libro homónimo, obra de Douglas Adams.',	'Película británica-estadounidense de comedia e ciencia ficción, estrenada no 2005 e baseada no libro homónimo, obra de Douglas Adams.',	'A 2005 British-American science fiction comedy film directed by Garth Jennings, based upon previous works in the media franchise of the same name, created by Douglas Adams.',	'',	'2019-02-15 14:34:41',	'2019-02-15 14:41:13',	'91.117.90.147',	'yb6XtPqR',	1),
(3,	1,	'CYCLOP',	'Krull',	'Krull',	'Krull',	'Película estadounidense fantástica de 1983 dirigida por Peter Yates.',	'Película estadounidense de fantasía dirixida no 1983 por Peter Yates.',	'A 1983 British-American science fantasy swashbuckler film directed by Peter Yates.',	'',	'2019-02-15 14:43:24',	'2019-02-15 14:46:54',	'91.117.90.147',	'Q2Gy3sUn',	1);

DELIMITER ;;

CREATE TRIGGER `serialize_example_code` BEFORE INSERT ON `inconceivable_example` FOR EACH ROW
BEGIN
     DECLARE original_code varchar(250);
     DECLARE code_counter int;
     SET original_code = new.code;
     SET code_counter = 1;
     WHILE EXISTS (SELECT true FROM `inconceivable_example` WHERE code = new.code) DO
        SET new.code = CONCAT(original_code, '-', code_counter);
        SET code_counter = code_counter + 1;
     END WHILE;

  END;;

DELIMITER ;






-- 2019-02-15 11:33:59
