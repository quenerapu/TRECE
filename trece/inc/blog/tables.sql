SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `inconceivable_blog`;
CREATE TABLE `inconceivable_blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_status` tinyint(1) NOT NULL DEFAULT '0',
  `id_author` int(11) NOT NULL DEFAULT '0',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `intro` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post` text COLLATE utf8mb4_unicode_ci,
  `ids_labels` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_reg` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_upd` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_upd` varchar(39) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `ref` char(8) COLLATE utf8_unicode_ci NOT NULL,
  `loops_ref` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `inconceivable_blog` (`id`, `id_status`, `id_author`, `date`, `title`, `url_title`, `intro`, `post`, `ids_labels`, `date_reg`, `date_upd`, `ip_upd`, `ref`, `loops_ref`) VALUES
(1, 1,  1,  NOW(), 'Welcome to TRECE! :)', CONCAT(CURDATE(),'-welcome-to-trece'),  'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin hendrerit dui et elit blandit, viverra vestibulum sem auctor. Quisque felis dui, bibendum sit.',  '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin hendrerit dui et elit blandit, viverra vestibulum sem auctor. Quisque felis dui, bibendum sit amet auctor viverra, tincidunt a ipsum. Maecenas consequat ornare tellus. Aenean mollis egestas congue. Duis felis magna, elementum vel sollicitudin et, sodales quis mi. Ut vitae libero tempus, faucibus nibh vel, elementum nisl. Cras pharetra imperdiet tellus ac posuere.</p><p>Suspendisse facilisis placerat turpis, vitae rhoncus sem fermentum quis. Nulla vitae tortor at nisl porta luctus nec quis diam. Maecenas dolor lorem, fermentum sed fermentum varius, pulvinar at metus. Maecenas sed rutrum ligula, quis placerat risus. Curabitur finibus metus diam, non finibus justo luctus in. Vestibulum quis nibh eget velit iaculis molestie consectetur sed diam. Aliquam augue felis, dictum et molestie eleifend, varius vel enim. Proin porttitor sapien porttitor mollis congue. Etiam vitae volutpat nunc, vitae finibus lectus. Quisque lacinia neque lectus, vitae iaculis turpis sagittis ut. Ut volutpat quis enim dictum porta. Vestibulum lorem odio, dictum et rutrum sit amet, mattis in quam. Aenean at accumsan quam, id vehicula turpis.</p><p>Ut eget egestas enim. Vivamus risus erat, vestibulum nec faucibus euismod, mattis ornare libero. Duis ut consequat ex. Suspendisse at erat dolor. Mauris ac lacus ut ipsum tempor egestas at ut elit. Praesent nec lectus convallis, dictum velit sit amet, feugiat massa. Vivamus aliquet, lorem nec eleifend eleifend, justo arcu lobortis justo, cursus porttitor velit ipsum vitae odio. Curabitur a scelerisque diam. Suspendisse in felis eu libero iaculis mattis sed nec ante. Praesent sollicitudin vulputate neque id dapibus. Cras sagittis mi sed velit venenatis posuere. Sed aliquam nisi euismod lacus sollicitudin vulputate. Mauris sed magna cursus, facilisis magna non, feugiat tortor. Nullam quis orci dapibus, posuere sapien ut, tristique nulla. Integer congue sagittis aliquam.</p><p>Vivamus convallis ut arcu non faucibus. Curabitur efficitur quam a ipsum congue pretium. Nullam nec magna ac lorem scelerisque pulvinar at non nibh. Praesent porta dui ligula, eu tincidunt neque scelerisque a. Nulla ex risus, dictum non varius id, gravida a velit. Donec placerat urna nec diam lacinia, eu egestas purus convallis. Ut fermentum imperdiet nisl, ac facilisis libero dignissim quis. Quisque leo mauris, eleifend at porttitor non, pretium vel libero. Morbi malesuada nisl leo, vel sagittis lectus porta in. Curabitur vel velit eu urna placerat cursus eget eget tortor.</p><p>Sed tempus ut dolor semper hendrerit. Sed porta luctus congue. Cras congue urna non nulla sollicitudin, viverra blandit ligula pretium. Aenean efficitur lorem quis sem semper venenatis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce tristique hendrerit lectus, a euismod lectus eleifend suscipit. Aenean iaculis sapien quis enim mollis, sed euismod ipsum vehicula. In condimentum cursus blandit. Suspendisse quis commodo arcu, ut ullamcorper lorem. Integer ac eros fermentum neque ornare laoreet et ut turpis. Nam tempor sem eget consequat vestibulum. Sed non iaculis risus. Praesent est mauris, tincidunt nec lorem at, malesuada viverra dui. Etiam pharetra ultrices dolor sagittis aliquet.</p>',  '1'  , NOW(),  NOW(),  '0.0.0.0', '3KhjdE4q', 1);

