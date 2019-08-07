SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `inconceivable_pages`;
CREATE TABLE `inconceivable_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL DEFAULT '0',
  `ids_breadcrumb_trail` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `level` tinyint(1) NOT NULL DEFAULT '0',
  `id_status` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_title` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `intro` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post` text COLLATE utf8mb4_unicode_ci,
  `date_reg` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_upd` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_upd` varchar(39) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `ref` char(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `loops_ref` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_parent_url_title` (`id_parent`,`url_title`),
  UNIQUE KEY `ids_breadcrumb_trail` (`ids_breadcrumb_trail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `inconceivable_pages` (`id`, `id_parent`, `ids_breadcrumb_trail`, `level`, `id_status`, `title`, `url_title`, `intro`, `post`, `date_reg`, `date_upd`, `ip_upd`, `ref`, `loops_ref`) VALUES
(1, 0,  '1',  0,  1,  'Cookie policy',  'cookie-policy',  'Intro about Cookie policy.', '<p>All about the cookie policy.</p>',  NOW(),  NOW(),  '0.0.0.0',  LEFT(UUID(),8), 1),
(2, 0,  '2',  0,  1,  'Privacy policy', 'privacy-policy', 'Intro about privacy policy.',  '<p>More about privacy policy.</p>',  NOW(),  NOW(),  '0.0.0.0',  LEFT(UUID(),8), 1);

