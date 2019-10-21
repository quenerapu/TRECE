SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `inconceivable_pages`;
CREATE TABLE `inconceivable_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `level` tinyint(1) NOT NULL DEFAULT '0',
  `id_status` tinyint(1) NOT NULL DEFAULT '0',
  `title_en` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_gal` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_es` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_title` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(900) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `intro_en` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intro_gal` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intro_es` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_gal` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_es` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_reg` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_upd` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_upd` varchar(39) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `ref` char(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `loops_ref` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_parent_url_title` (`parent_id`,`url_title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `inconceivable_pages` (`id`, `parent_id`, `level`, `id_status`, `title_en`, `title_gal`, `title_es`, `url_title`, `path`, `intro_en`, `intro_gal`, `intro_es`, `post_en`, `post_gal`, `post_es`, `date_reg`, `date_upd`, `ip_upd`, `ref`, `loops_ref`) VALUES
(1,  0,  1,  1,  'Cookie policy',  'Política de cookies',  'Política de cookies',  'cookies',  'cookies',  '',  '',  '',  '<p>About the cookie policy.</p>',  '<p>Acerca da política de cookies.</p>',  '<p>Acerca de la política de cookies.</p>',  NOW(),  NOW(),  '0.0.0.0',  LEFT(UUID(),8),  1),
(2,  0,  1,  1,  'Privacy policy',  'Política de privacidade',  'Política de privacidad',  'privacy',  'privacy',  '',  '',  '',  '<p>About the privacy policy.</p>',  '<p>Acerca da política de privacidade.</p>',  '<p>Acerca de la política de privacidad.</p>',  NOW(),  NOW(),  '0.0.0.0',  LEFT(UUID(),8),  1);

