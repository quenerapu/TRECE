SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `inconceivable_bloglabels`;
CREATE TABLE `inconceivable_bloglabels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_status` tinyint(1) NOT NULL DEFAULT '0',
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_name_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_gal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_name_gal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_es` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_name_es` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_reg` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_upd` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_upd` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `ref` char(8) COLLATE utf8_unicode_ci NOT NULL,
  `loops_ref` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_en` (`name_en`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `inconceivable_bloglabels` (`id`, `id_status`, `name_en`, `url_name_en`, `name_gal`, `url_name_gal`, `name_es`, `url_name_es`, `date_reg`, `date_upd`, `ip_upd`, `ref`, `loops_ref`) VALUES
(1, 1,  'Demo label EN', 'demo-label-en', 'Demo label GAL', 'demo-label-gal', 'Demo label ES', 'demo-label-es', NOW(),  NOW(),  '0.0.0.0',  LEFT(UUID(),8), 1);

