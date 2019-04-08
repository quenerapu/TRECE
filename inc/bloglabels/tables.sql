-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `inconceivable_bloglabels`;
CREATE TABLE `inconceivable_bloglabels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_status` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_reg` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_upd` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_upd` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `ref` char(8) COLLATE utf8_unicode_ci NOT NULL,
  `loops_ref` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `inconceivable_bloglabels` (`id`, `id_status`, `name`, `url_name`, `date_reg`, `date_upd`, `ip_upd`, `ref`, `loops_ref`) VALUES
(1, 1,  'Demo label', 'demo-label', '2019-04-05 02:11:34',  '2019-04-05 02:11:34',  '0.0.0.0',  '22efeec0', 1);

DELIMITER ;;

CREATE TRIGGER `serialize_bloglabel_name` BEFORE INSERT ON `inconceivable_bloglabels` FOR EACH ROW
BEGIN
     DECLARE original_name varchar(255);
     DECLARE original_url_name varchar(255);
     DECLARE name_counter int;
     SET original_name = new.title;
     SET original_url_name = new.url_name;
     SET name_counter = 1;
     WHILE EXISTS (SELECT true FROM `inconceivable_bloglabels` WHERE title = new.title) DO
        SET new.title = CONCAT(original_name, '_', name_counter);
        SET new.url_name = CONCAT(original_url_name, '_', name_counter);
        SET name_counter = name_counter + 1;
     END WHILE;

  END;;

DELIMITER ;
