SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `inconceivable_provinces`;
CREATE TABLE `inconceivable_provinces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL DEFAULT '0',
  `id_status` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_reg` datetime NOT NULL DEFAULT NOW(),
  `date_upd` datetime NOT NULL DEFAULT NOW(),
  `ip_upd` varchar(39) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `ref` char(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loops_ref` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `inconceivable_provinces` (`id`, `id_parent`, `id_status`, `name`, `date_reg`, `date_upd`, `ip_upd`, `ref`, `loops_ref`) VALUES
(1, 1,  1,  'A Coruña', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(2, 1,  1,  'Lugo', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(3, 1,  1,  'Ourense',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(4, 1,  1,  'Pontevedra', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1);

