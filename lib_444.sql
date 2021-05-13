-- phpMyAdmin SQL Dump
-- version 4.1.13
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 13 2021 г., 19:59
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `lib_444`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accepted_books`
--

CREATE TABLE IF NOT EXISTS `accepted_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `accepted_books`
--

INSERT INTO `accepted_books` (`id`, `id_user`, `id_book`, `date`) VALUES
(1, 1, 1, '2021-05-06 19:19:08'),
(2, 1, 6, '2021-05-06 21:43:38'),
(3, 1, 5, '2021-05-06 21:43:38'),
(4, 1, 7, '2021-05-06 21:43:38'),
(5, 1, 4, '2021-05-06 21:43:38'),
(6, 1, 1, '2021-05-12 19:22:27'),
(7, 1, 0, '2021-05-12 19:30:17'),
(8, 1, 1, '2021-05-12 19:33:28'),
(9, 1, 5, '2021-05-12 19:35:24'),
(10, 1, 4, '2021-05-12 19:39:20'),
(11, 1, 6, '2021-05-12 19:40:16'),
(12, 1, 7, '2021-05-12 19:43:52'),
(13, 1, 6, '2021-05-12 19:44:22'),
(14, 1, 1, '2021-05-12 19:44:46');

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `name`) VALUES
(1, 'Купанов Л.В'),
(2, 'Алексеев.Ф.В'),
(3, 'Ульянов.Р.К'),
(4, 'Панфилов.В.Д'),
(5, 'Соловьёв.Р.Д'),
(6, 'Варшавсий.А.И');

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_num` int(11) NOT NULL,
  `date` date NOT NULL,
  `info` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `id_3` (`id`),
  UNIQUE KEY `id_4` (`id`),
  UNIQUE KEY `id_5` (`id`),
  UNIQUE KEY `id_6` (`id`),
  UNIQUE KEY `id_7` (`id`),
  UNIQUE KEY `id_8` (`id`),
  UNIQUE KEY `id_9` (`id`),
  UNIQUE KEY `id_10` (`id`),
  KEY `id_2` (`id`),
  KEY `id_11` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `author_id`, `subject_id`, `class_num`, `date`, `info`) VALUES
(1, 1, 1, 1, '2021-05-06', 'Книга'),
(4, 4, 3, 8, '0000-00-00', 'Книга_1'),
(5, 2, 1, 8, '0000-00-00', 'Книга_2'),
(6, 5, 2, 10, '0000-00-00', 'Книга_3'),
(7, 1, 2, 4, '0000-00-00', 'Вата'),
(8, 1, 1, 5, '0000-00-00', ''),
(9, 1, 2, 3, '0000-00-00', ''),
(10, 1, 5, 3, '0000-00-00', ''),
(11, 5, 4, 3, '0000-00-00', ''),
(12, 2, 4, 3, '0000-00-00', '');

-- --------------------------------------------------------

--
-- Структура таблицы `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(7) NOT NULL,
  `num` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `classes`
--

INSERT INTO `classes` (`id`, `name`, `num`) VALUES
(1, '1А', 1),
(2, '1Б', 1),
(3, '1В', 1),
(4, '2А', 2),
(5, '2Б', 2),
(6, '2В', 2),
(7, '3А', 3),
(8, '3Б', 3),
(9, '3В', 3),
(10, '4А', 4),
(11, '4Б', 4),
(12, '4В', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `subjects`
--

INSERT INTO `subjects` (`id`, `name`) VALUES
(1, 'Алгебра'),
(2, 'Физика'),
(3, 'Информатика'),
(4, 'Литература'),
(5, 'Русский'),
(6, 'Геометрия');

-- --------------------------------------------------------

--
-- Структура таблицы `taked_books`
--

CREATE TABLE IF NOT EXISTS `taked_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Дамп данных таблицы `taked_books`
--

INSERT INTO `taked_books` (`id`, `id_user`, `id_book`, `date`) VALUES
(53, 0, 6, '2021-05-07 19:58:46'),
(54, 0, 2, '2021-05-12 19:28:57'),
(55, 0, 3, '2021-05-12 19:28:57'),
(56, 2, 1, '2021-05-12 19:29:22'),
(57, 2, 2, '2021-05-12 19:29:22');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class_id` int(11) NOT NULL,
  `take_count` int(11) NOT NULL DEFAULT '0',
  `wait_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `is_admin`, `name`, `class_id`, `take_count`, `wait_count`) VALUES
(1, 'werf', 'qq', 0, 'Алексей Васютко', 8, 0, 0),
(2, 'admin', 'admin', 1, 'admin', 3, 0, 0),
(3, 'qwerty', 'qq', 0, 'qwerty', 5, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `waited_books`
--

CREATE TABLE IF NOT EXISTS `waited_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `waited_books`
--

INSERT INTO `waited_books` (`id`, `id_user`, `id_book`, `date`) VALUES
(11, 1, 6, '2021-05-06 22:19:33'),
(13, 1, 7, '2021-05-06 22:32:41'),
(15, 0, 1, '2021-05-07 19:59:55'),
(16, 1, 4, '2021-05-12 19:21:41');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
