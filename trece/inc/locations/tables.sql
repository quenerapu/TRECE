SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `inconceivable_locations`;
CREATE TABLE `inconceivable_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL DEFAULT '0',
  `id_status` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_reg` datetime NOT NULL DEFAULT NOW(),
  `date_upd` datetime NOT NULL DEFAULT NOW(),
  `ip_upd` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `ref` char(8) COLLATE utf8_unicode_ci NOT NULL,
  `loops_ref` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `inconceivable_locations` (`id`, `id_parent`, `id_status`, `name`, `date_reg`, `date_upd`, `ip_upd`, `ref`, `loops_ref`) VALUES
(1,   1, 1,  'A Baña', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(2,   1, 1,  'Negreira', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(3,   2, 1,  'A Coruña', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(4,   2, 1,  'Abegondo', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(5,   2, 1,  'Arteixo',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(6,   2, 1,  'Bergondo', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(7,   2, 1,  'Cambre', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(8,   2, 1,  'Carral', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(9,   2, 1,  'Culleredo',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(10,  2, 1,  'Oleiros',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(11,  2, 1,  'Sada', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(12,  3, 1,  'A Fonsagrada', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(13,  3, 1,  'Baleira',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(14,  3, 1,  'Negueira de Muñiz',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(15,  4, 1,  'Baltar', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(16,  4, 1,  'Calvos de Randín', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(17,  4, 1,  'Os Blancos', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(18,  4, 1,  'Porqueira',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(19,  4, 1,  'Rairiz de Veiga',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(20,  4, 1,  'Sandiás',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(21,  4, 1,  'Sarreaus', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(22,  4, 1,  'Trasmiras',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(23,  4, 1,  'Vilar de Barrio',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(24,  4, 1,  'Vilar de Santos',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(25,  4, 1,  'Xinzo de Limia', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(26,  5, 1,  'Alfoz',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(27,  5, 1,  'Burela', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(28,  5, 1,  'Foz',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(29,  5, 1,  'Lourenzá', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(30,  5, 1,  'Mondoñedo',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(31,  5, 1,  'O Valadouro',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(32,  6, 1,  'Cervo',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(33,  6, 1,  'O Vicedo', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(34,  6, 1,  'Ourol',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(35,  6, 1,  'Viveiro',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(36,  6, 1,  'Xove', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(37,  7, 1,  'A Pontenova',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(38,  7, 1,  'Barreiros',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(39,  7, 1,  'Ribadeo',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(40,  7, 1,  'Trabada',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(41,  8, 1,  'A Cañiza', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(42,  8, 1,  'Arbo', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(43,  8, 1,  'Covelo', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(44,  8, 1,  'Crecente', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(45,  9, 1,  'Antas de Ulla',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(46,  9, 1,  'Monterroso', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(47,  9, 1,  'Palas de Rei', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(48,  10, 1,  'Allariz',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(49,  10, 1,  'Baños de Molgas',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(50,  10, 1,  'Maceda', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(51,  10, 1,  'Paderne de Allariz', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(52,  10, 1,  'Xunqueira de Ambía', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(53,  10, 1,  'Xunqueira de Espadanedo',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(54,  11, 1,  'Arzúa',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(55,  11, 1,  'Boimorto', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(56,  11, 1,  'O Pino', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(57,  11, 1,  'Touro',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(58,  12, 1,  'Bande',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(59,  12, 1,  'Entrimo',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(60,  12, 1,  'Lobeira',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(61,  12, 1,  'Lobios', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(62,  12, 1,  'Muíños', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(63,  13, 1,  'A Pobra do Caramiñal', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(64,  13, 1,  'Boiro',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(65,  13, 1,  'Rianxo', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(66,  13, 1,  'Ribeira',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(67,  14, 1,  'A Laracha',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(68,  14, 1,  'Cabana de Bergantiños',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(69,  14, 1,  'Carballo', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(70,  14, 1,  'Coristanco', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(71,  14, 1,  'Laxe', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(72,  14, 1,  'Malpica de Bergantiños', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(73,  14, 1,  'Ponteceso',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(74,  15, 1,  'Aranga', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(75,  15, 1,  'Betanzos', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(76,  15, 1,  'Coirós', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(77,  15, 1,  'Curtis', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(78,  15, 1,  'Irixoa', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(79,  15, 1,  'Miño', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(80,  15, 1,  'Oza-Cesuras',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(81,  15, 1,  'Paderne',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(82,  15, 1,  'Vilarmaior', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(83,  15, 1,  'Vilasantar', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(84,  16, 1,  'Caldas de Reis', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(85,  16, 1,  'Catoira',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(86,  16, 1,  'Cuntis', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(87,  16, 1,  'Moraña', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(88,  16, 1,  'Pontecesures', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(89,  16, 1,  'Portas', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(90,  16, 1,  'Valga',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(91,  17, 1,  'Carballedo', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(92,  17, 1,  'Chantada', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(93,  17, 1,  'Taboada',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(94,  18, 1,  'Agolada',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(95,  18, 1,  'Dozón',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(96,  18, 1,  'Lalín',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(97,  18, 1,  'Rodeiro',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(98,  18, 1,  'Silleda',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(99,  18, 1,  'Vila de Cruces', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(100, 19, 1,  'A Capela', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(101, 19, 1,  'As Pontes de García Rodríguez',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(102, 19, 1,  'Cabanas',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(103, 19, 1,  'Monfero',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(104, 19, 1,  'Pontedeume', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(105, 20, 1,  'Ares', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(106, 20, 1,  'As Somozas', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(107, 20, 1,  'Cedeira',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(108, 20, 1,  'Fene', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(109, 20, 1,  'Ferrol', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(110, 20, 1,  'Moeche', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(111, 20, 1,  'Mugardos', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(112, 20, 1,  'Narón',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(113, 20, 1,  'Neda', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(114, 20, 1,  'San Sadurniño',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(115, 20, 1,  'Valdoviño',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(116, 21, 1,  'Cee',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(117, 21, 1,  'Corcubión',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(118, 21, 1,  'Dumbría',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(119, 21, 1,  'Fisterra', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(120, 21, 1,  'Muxía',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(121, 22, 1,  'Castroverde',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(122, 22, 1,  'Friol',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(123, 22, 1,  'Guntín', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(124, 22, 1,  'Lugo', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(125, 22, 1,  'O Corgo',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(126, 22, 1,  'Outeiro de Rei', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(127, 22, 1,  'Portomarín', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(128, 22, 1,  'Rábade', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(129, 23, 1,  'Meira',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(130, 23, 1,  'Pol',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(131, 23, 1,  'Ribeira de Piquín',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(132, 23, 1,  'Riotorto', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(133, 24, 1,  'Carnota',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(134, 24, 1,  'Muros',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(135, 25, 1,  'Lousame',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(136, 25, 1,  'Noia', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(137, 25, 1,  'Outes',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(138, 25, 1,  'Porto do Son', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(139, 26, 1,  'A Guarda', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(140, 26, 1,  'O Rosal',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(141, 26, 1,  'Oia',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(142, 26, 1,  'Tomiño', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(143, 26, 1,  'Tui',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(144, 27, 1,  'Beariz', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(145, 27, 1,  'Boborás',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(146, 27, 1,  'Maside', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(147, 27, 1,  'O Carballiño', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(148, 27, 1,  'O Irixo',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(149, 27, 1,  'Piñor',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(150, 27, 1,  'Punxín', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(151, 27, 1,  'San Amaro',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(152, 27, 1,  'San Cristovo de Cea',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(153, 28, 1,  'As Neves', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(154, 28, 1,  'Mondariz', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(155, 28, 1,  'Mondariz-Balneario', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(156, 28, 1,  'Ponteareas', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(157, 28, 1,  'Salvaterra de Miño', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(158, 29, 1,  'Bueu', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(159, 29, 1,  'Cangas', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(160, 29, 1,  'Marín',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(161, 29, 1,  'Moaña',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(162, 30, 1,  'A Arnoia', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(163, 30, 1,  'Avión',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(164, 30, 1,  'Beade',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(165, 30, 1,  'Carballeda de Avia', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(166, 30, 1,  'Castrelo de Miño', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(167, 30, 1,  'Cenlle', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(168, 30, 1,  'Cortegada',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(169, 30, 1,  'Leiro',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(170, 30, 1,  'Melón',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(171, 30, 1,  'Ribadavia',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(172, 31, 1,  'A Illa de Arousa', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(173, 31, 1,  'Cambados', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(174, 31, 1,  'Meaño',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(175, 31, 1,  'Meis', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(176, 31, 1,  'O Grove',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(177, 31, 1,  'Ribadumia',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(178, 31, 1,  'Sanxenxo', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(179, 31, 1,  'Vilagarcía de Arousa', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(180, 31, 1,  'Vilanova de Arousa', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(181, 32, 1,  'Dodro',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(182, 32, 1,  'Padrón', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(183, 32, 1,  'Rois', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(184, 33, 1,  'Cerceda',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(185, 33, 1,  'Frades', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(186, 33, 1,  'Mesía',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(187, 33, 1,  'Ordes',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(188, 33, 1,  'Oroso',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(189, 33, 1,  'Tordoia',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(190, 33, 1,  'Trazo',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(191, 34, 1,  'Cariño', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(192, 34, 1,  'Cerdido',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(193, 34, 1,  'Mañón',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(194, 34, 1,  'Ortigueira', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(195, 35, 1,  'As Nogais',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(196, 35, 1,  'Baralla',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(197, 35, 1,  'Becerreá', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(198, 35, 1,  'Cervantes',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(199, 35, 1,  'Navia de Suarna',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(200, 35, 1,  'Pedrafita do Cebreiro',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(201, 36, 1,  'A Peroxa', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(202, 36, 1,  'Amoeiro',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(203, 36, 1,  'Barbadás', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(204, 36, 1,  'Coles',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(205, 36, 1,  'Esgos',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(206, 36, 1,  'Nogueira de Ramuín', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(207, 36, 1,  'O Pereiro de Aguiar',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(208, 36, 1,  'Ourense',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(209, 36, 1,  'San Cibrao das Viñas', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(210, 36, 1,  'Taboadela',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(211, 36, 1,  'Toén', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(212, 36, 1,  'Vilamarín',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(213, 37, 1,  'A Lama', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(214, 37, 1,  'Barro',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(215, 37, 1,  'Campo Lameiro',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(216, 37, 1,  'Poio', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(217, 37, 1,  'Ponte Caldelas', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(218, 37, 1,  'Pontevedra', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(219, 37, 1,  'Vilaboa',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(220, 38, 1,  'Folgoso do Courel',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(221, 38, 1,  'Quiroga',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(222, 38, 1,  'Ribas de Sil', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(223, 39, 1,  'Ames', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(224, 39, 1,  'Boqueixón',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(225, 39, 1,  'Brión',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(226, 39, 1,  'Santiago de Compostela', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(227, 39, 1,  'Teo',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(228, 39, 1,  'Val do Dubra', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(229, 39, 1,  'Vedra',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(230, 40, 1,  'Láncara',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(231, 40, 1,  'O Incio',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(232, 40, 1,  'O Páramo', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(233, 40, 1,  'Paradela', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(234, 40, 1,  'Samos',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(235, 40, 1,  'Sarria', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(236, 40, 1,  'Triacastela',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(237, 41, 1,  'A Estrada',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(238, 41, 1,  'Cerdedo-Cotobade', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(239, 41, 1,  'Forcarei', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(240, 42, 1,  'A Pastoriza',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(241, 42, 1,  'Abadín', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(242, 42, 1,  'Begonte',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(243, 42, 1,  'Castro de Rei',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(244, 42, 1,  'Cospeito', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(245, 42, 1,  'Guitiriz', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(246, 42, 1,  'Muras',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(247, 42, 1,  'Vilalba',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(248, 42, 1,  'Xermade',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(249, 43, 1,  'A Teixeira', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(250, 43, 1,  'Castro Caldelas',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(251, 43, 1,  'Montederramo', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(252, 43, 1,  'Parada de Sil',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(253, 44, 1,  'A Bola', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(254, 44, 1,  'A Merca',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(255, 44, 1,  'Cartelle', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(256, 44, 1,  'Celanova', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(257, 44, 1,  'Gomesende',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(258, 44, 1,  'Padrenda', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(259, 44, 1,  'Pontedeva',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(260, 44, 1,  'Quintela de Leirado',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(261, 44, 1,  'Ramirás',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(262, 44, 1,  'Verea',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(263, 45, 1,  'A Pobra do Brollón', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(264, 45, 1,  'Bóveda', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(265, 45, 1,  'Monforte de Lemos',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(266, 45, 1,  'O Saviñao',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(267, 45, 1,  'Pantón', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(268, 45, 1,  'Sober',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(269, 46, 1,  'Melide', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(270, 46, 1,  'Santiso',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(271, 46, 1,  'Sobrado',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(272, 46, 1,  'Toques', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(273, 47, 1,  'Camariñas',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(274, 47, 1,  'Vimianzo', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(275, 47, 1,  'Zas',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(276, 48, 1,  'A Pobra de Trives',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(277, 48, 1,  'Chandrexa de Queixa',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(278, 48, 1,  'Manzaneda',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(279, 48, 1,  'San Xoán de Río',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(280, 49, 1,  'A Rúa',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(281, 49, 1,  'A Veiga',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(282, 49, 1,  'Carballeda de Valdeorras', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(283, 49, 1,  'Larouco',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(284, 49, 1,  'O Barco de Valdeorras',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(285, 49, 1,  'O Bolo', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(286, 49, 1,  'Petín',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(287, 49, 1,  'Rubiá',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(288, 49, 1,  'Vilamartín de Valdeorras', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(289, 50, 1,  'Castrelo do Val',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(290, 50, 1,  'Cualedro', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(291, 50, 1,  'Laza', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(292, 50, 1,  'Monterrei',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(293, 50, 1,  'Oímbra', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(294, 50, 1,  'Riós', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(295, 50, 1,  'Verín',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(296, 50, 1,  'Vilardevós', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(297, 51, 1,  'A Gudiña', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(298, 51, 1,  'A Mezquita', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(299, 51, 1,  'Viana do Bolo',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(300, 51, 1,  'Vilariño de Conso',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(301, 52, 1,  'Baiona', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(302, 52, 1,  'Fornelos de Montes', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(303, 52, 1,  'Gondomar', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(304, 52, 1,  'Mos',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(305, 52, 1,  'Nigrán', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(306, 52, 1,  'O Porriño',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(307, 52, 1,  'Pazos de Borbén',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(308, 52, 1,  'Redondela',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(309, 52, 1,  'Salceda de Caselas', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(310, 52, 1,  'Soutomaior', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(311, 52, 1,  'Vigo', NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(312, 53, 1,  'Mazaricos',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1),
(313, 53, 1,  'Santa Comba',  NOW(),  NOW(),  '0.0.0.0', LEFT(UUID(),8), 1);

