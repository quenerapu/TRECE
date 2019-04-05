-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `inconceivable_uhierarchy`;
CREATE TABLE `fodechinchos_uhierarchy` (
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

INSERT INTO `fodechinchos_uhierarchy` (`id`, `id_status`, `ids_privileges`, `sort`, `name`, `color`, `date_reg`, `date_upd`, `ip_upd`, `ref`, `loops_ref`) VALUES
(1, 1,  '1',  1,  'Admin',  '800000', NOW(),  NOW(),  '0.0.0.0',  LEFT(UUID(),8), 0),
(2, 1,  '', 10, 'User', '008000', NOW(),  NOW(),  '0.0.0.0',  LEFT(UUID(),8), 0);
