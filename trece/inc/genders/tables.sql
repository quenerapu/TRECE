SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `inconceivable_genders`;
CREATE TABLE `inconceivable_genders` (
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

INSERT INTO `inconceivable_genders` (`id`, `id_status`, `name`, `letter`, `date_reg`, `date_upd`, `ip_upd`, `ref`, `loops_ref`) VALUES
(1,  1,  'Male',  'm',  NOW(),  NOW(),  '0.0.0.0',  LEFT(UUID(),8), 0),
(2,  1,  'Female', 'f',  NOW(),  NOW(),  '0.0.0.0',  LEFT(UUID(),8), 0);

