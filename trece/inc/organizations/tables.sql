SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `inconceivable_organizations`;
CREATE TABLE `inconceivable_organizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_status` tinyint(1) NOT NULL DEFAULT '0',
  `id_approved` tinyint(1) NOT NULL DEFAULT '0',
  `id_approver` int(11) NOT NULL DEFAULT '0',
  `id_disapprover` int(11) NOT NULL DEFAULT '0',
  `id_delegate` int(11) NOT NULL DEFAULT '0',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contact_person_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person_surname` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person_email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intro` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_region` tinyint(1) NOT NULL DEFAULT '0',
  `first_message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatwedo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ids_labels` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phones` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_reg` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_upd` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_upd` varchar(39) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `ref` char(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `loops_ref` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `url_name` (`url_name`),
  UNIQUE KEY `ref` (`ref`),
  UNIQUE KEY `contact_person_email` (`contact_person_email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `inconceivable_organizations` (`id`, `id_status`, `id_approved`, `id_approver`, `id_disapprover`, `id_delegate`, `name`, `url_name`, `contact_person_name`, `contact_person_surname`, `contact_person_email`, `intro`, `id_region`, `first_message`, `whatwedo`, `ids_labels`, `website`, `phones`, `date_reg`, `date_upd`, `ip_upd`, `ref`, `loops_ref`) VALUES
(1, 1,  1,  1,  0,  1,  'Fixing.es',  'fixing', '', '', '', '', 0,  '', '', '', '', '', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1);

