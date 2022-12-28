-- Adminer 4.8.1 MySQL 5.7.33 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `friends_requests`;
CREATE TABLE `friends_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user` int(11) NOT NULL,
  `to_user` int(11) NOT NULL,
  `send_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user` int(11) NOT NULL,
  `to_user` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `messages` (`id`, `from_user`, `to_user`, `content`, `send_date`) VALUES
(1,	3,	4,	'Привет!',	'2022-12-14 20:45:51'),
(2,	4,	3,	'Здарова!',	'2022-12-14 20:53:25');

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `posted_date` datetime NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `posts` (`id`, `user_id`, `posted_date`, `content`) VALUES
(6,	4,	'2022-12-14 12:07:22',	'123'),
(7,	4,	'2022-12-14 12:08:54',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis at lectus ut risus lacinia iaculis. Nam non nisl eu dolor tristique tristique vel sed enim. Sed sollicitudin, lacus id iaculis consectetur, nunc urna feugiat tellus, sit amet posuere felis eros eu leo.'),
(8,	3,	'2022-12-14 12:22:42',	'123');

DROP TABLE IF EXISTS `responses`;
CREATE TABLE `responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `response_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `responses` (`id`, `user_id`, `owner_id`, `post_id`, `response_date`) VALUES
(1,	3,	4,	7,	'2022-12-14 12:16:08'),
(2,	4,	3,	8,	'2022-12-14 12:22:59');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text COLLATE utf8mb4_unicode_ci,
  `userlastname` text COLLATE utf8mb4_unicode_ci,
  `login` text COLLATE utf8mb4_unicode_ci,
  `password` text COLLATE utf8mb4_unicode_ci,
  `role` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `friends` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `username`, `userlastname`, `login`, `password`, `role`, `description`, `friends`) VALUES
(3,	'Николай',	'Петров',	'cristy',	'c4ca4238a0b923820dcc509a6f75849b',	'2',	'Разработчик',	''),
(4,	'Иван',	'Сидоров',	'ivan',	'c4ca4238a0b923820dcc509a6f75849b',	'2',	'SEO-специалист',	'');

-- 2022-12-14 17:56:10
