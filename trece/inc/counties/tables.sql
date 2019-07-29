SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `inconceivable_counties`;
CREATE TABLE `inconceivable_counties` (
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

INSERT INTO `inconceivable_counties` (`id`, `id_parent`, `id_status`, `name`, `date_reg`, `date_upd`, `ip_upd`, `ref`, `loops_ref`) VALUES
(1,  1,  1,  'A Barcala',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(2,  1,  1,  'A Coruña', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(3,  1,  1,  'Arzúa',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(4,  1,  1,  'Barbanza', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(5,  1,  1,  'Bergantiños',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(6,  1,  1,  'Betanzos', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(7,  1,  1,  'Eume', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(8,  1,  1,  'Ferrol', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(9,  1,  1,  'Fisterra', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(10, 1,  1,  'Muros',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(11, 1,  1,  'Noia', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(12, 1,  1,  'O Sar',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(13, 1,  1,  'Ordes',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(14, 1,  1,  'Ortegal',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(15, 1,  1,  'Santiago', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(16, 1,  1,  'Terra de Melide',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(17, 1,  1,  'Terra de Soneira', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(18, 1,  1,  'Xallas', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(19, 2,  1,  'A Fonsagrada', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(20, 2,  1,  'A Mariña Central', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(21, 2,  1,  'A Mariña Occidental',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(22, 2,  1,  'A Mariña Oriental',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(23, 2,  1,  'A Ulloa',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(24, 2,  1,  'Chantada', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(25, 2,  1,  'Lugo', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(26, 2,  1,  'Meira',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(27, 2,  1,  'Os Ancares', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(28, 2,  1,  'Quiroga',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(29, 2,  1,  'Sarria', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(30, 2,  1,  'Terra Chá',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(31, 2,  1,  'Terra de Lemos', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(32, 3,  1,  'A Limia',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(33, 3,  1,  'Allariz-Maceda', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(34, 3,  1,  'Baixa Limia',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(35, 3,  1,  'O Carballiño', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(36, 3,  1,  'O Ribeiro',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(37, 3,  1,  'Ourense',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(38, 3,  1,  'Terra de Caldelas',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(39, 3,  1,  'Terra de Celanova',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(40, 3,  1,  'Terra de Trives',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(41, 3,  1,  'Valdeorras', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(42, 3,  1,  'Verín',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(43, 3,  1,  'Viana',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(44, 4,  1,  'A Paradanta',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(45, 4,  1,  'Caldas', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(46, 4,  1,  'Deza', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(47, 4,  1,  'O Baixo Miño', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(48, 4,  1,  'O Condado',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(49, 4,  1,  'O Morrazo',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(50, 4,  1,  'O Salnés', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(51, 4,  1,  'Pontevedra', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(52, 4,  1,  'Tabeirós - Terra de Montes', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(53, 4,  1,  'Vigo', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1);

