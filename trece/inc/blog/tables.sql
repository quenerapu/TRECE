SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `inconceivable_blog`;
CREATE TABLE `inconceivable_blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_status` tinyint(1) NOT NULL DEFAULT '0',
  `id_author` int(11) NOT NULL DEFAULT '0',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `url_title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `intro` varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  `post` text COLLATE utf8_unicode_ci,
  `ids_labels` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_reg` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_upd` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_upd` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `ref` char(8) COLLATE utf8_unicode_ci NOT NULL,
  `loops_ref` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `inconceivable_blog` (`id`, `id_status`, `id_author`, `date`, `title`, `url_title`, `intro`, `post`, `ids_labels`, `date_reg`, `date_upd`, `ip_upd`, `ref`, `loops_ref`) VALUES
(1, 1,  0,  NOW(), 'New post', CONCAT(CURDATE(),'-new-post'),  'About this new post.',  '<p>More about this new post.</p>',  '1'  , NOW(),  NOW(),  '0.0.0.0', '3KhjdE4q', 1);

