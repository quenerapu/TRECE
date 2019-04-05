-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

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
(1, 1,  'Rule the planet',  'rule-the-planet',  NOW(),  NOW(),  '0.0.0.0',  LEFT(UUID(),8), 1);