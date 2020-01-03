SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `inconceivable_users`;
CREATE TABLE `inconceivable_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_status` tinyint(1) NOT NULL DEFAULT '0',
  `id_organization` int(11) NOT NULL,
  `signed_in` tinyint(1) NOT NULL DEFAULT '0',
  `uhierarchy` tinyint(2) NOT NULL DEFAULT '0',
  `id_language` tinyint(1) NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `ugender` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `hash_pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_change_hash` char(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_change_timestamp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `password_change_ip` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `password_strength` tinyint(1) NOT NULL DEFAULT '0',
  `bio` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_reg` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_upd` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_upd` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `ref` char(8) COLLATE utf8_unicode_ci NOT NULL,
  `loops_ref` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `inconceivable_users` (`id`, `id_status`, `id_organization`, `signed_in`, `uhierarchy`, `id_language`, `name`, `surname`, `username`, `ugender`, `email`, `hash_pass`, `password_change_hash`, `password_change_timestamp`, `password_change_ip`, `password_strength`, `bio`, `date_reg`, `date_upd`, `ip_upd`, `ref`, `loops_ref`) VALUES
(1, 1,  1,  1,  1,  0,  'The Boss', 'Is In The House',  'theboss',  'w',  'email@domain.com', '', NULL, '0000-00-00 00:00:00',  '0.0.0.0',  0,  '', NOW(),  NOW(),  '0.0.0.0',  LEFT(UUID(),8), 1);

DROP TABLE IF EXISTS `inconceivable_log`;
CREATE TABLE `inconceivable_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` tinyint(1) NOT NULL DEFAULT '0',
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
