-- phpMyAdmin SQL Dump
-- version 4.1.13
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 24 2021 г., 06:46
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `name`) VALUES
(1, 'Купанов Л.В'),
(2, 'Алексеев.Ф.В'),
(3, 'Ульянов.Р.К'),
(4, 'Панфилов.В.Д'),
(5, 'Соловьёв.Р.Д'),
(6, 'Варшавсий.А.И'),
(7, 'Иванов К.С.'),
(8, 'Звонилин Р.Т.'),
(9, 'Севернов А.Б.'),
(10, 'Светлов.В.Р.');

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_num` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `author_id`, `subject_id`, `class_num`, `date`, `info`) VALUES
(13, 1, 10, 6, '0000-00-00 00:00:00', ''),
(14, 1, 7, 6, '0000-00-00 00:00:00', ''),
(15, 2, 9, 7, '0000-00-00 00:00:00', ''),
(16, 4, 9, 7, '0000-00-00 00:00:00', ''),
(17, 3, 8, 8, '0000-00-00 00:00:00', ''),
(18, 3, 6, 8, '0000-00-00 00:00:00', ''),
(19, 4, 7, 9, '0000-00-00 00:00:00', ''),
(20, 4, 8, 9, '0000-00-00 00:00:00', ''),
(21, 5, 6, 10, '0000-00-00 00:00:00', ''),
(22, 5, 2, 10, '0000-00-00 00:00:00', ''),
(23, 6, 5, 11, '0000-00-00 00:00:00', ''),
(24, 6, 7, 11, '0000-00-00 00:00:00', ''),
(25, 7, 4, 4, '0000-00-00 00:00:00', ''),
(26, 7, 9, 10, '0000-00-00 00:00:00', ''),
(27, 8, 3, 4, '0000-00-00 00:00:00', ''),
(28, 8, 6, 7, '0000-00-00 00:00:00', ''),
(29, 9, 2, 7, '0000-00-00 00:00:00', ''),
(30, 9, 4, 1, '0000-00-00 00:00:00', ''),
(31, 10, 1, 1, '0000-00-00 00:00:00', ''),
(32, 10, 7, 4, '0000-00-00 00:00:00', ''),
(33, 4, 3, 7, '2021-05-24 01:58:05', '');

-- --------------------------------------------------------

--
-- Структура таблицы `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(7) NOT NULL,
  `num` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

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
(8, '3Б', 3),
(9, '3В', 3),
(10, '7В', 7),
(11, '4Б', 4),
(12, '4В', 4),
(13, '5А', 5),
(14, '5Б', 5),
(15, '5В', 5),
(16, '6А', 6),
(17, '6Б', 6),
(18, '6В', 6),
(19, '7А', 7),
(20, '7Б', 7);

-- --------------------------------------------------------

--
-- Структура таблицы `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Дамп данных таблицы `subjects`
--

INSERT INTO `subjects` (`id`, `name`) VALUES
(1, 'Алгебра'),
(2, 'Физика'),
(3, 'Информатика'),
(4, 'Литература'),
(5, 'Русский'),
(6, 'Геометрия'),
(7, 'История'),
(8, 'Черчение'),
(9, 'Биология'),
(10, 'Английский');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=93 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `is_admin`, `name`, `class_id`, `take_count`, `wait_count`) VALUES
(2, 'admin', 'admin', 1, 'admin', 3, 0, 0),
(5, 'one', 'one', 0, 'one one', 5, 0, 0),
(6, 'two', 'two', 0, 'two two', 8, 0, 0),
(7, 'three', 'three', 0, 'three three', 1, 0, 0),
(8, 'four', 'four', 0, 'four four', 19, 0, 0),
(9, 'five', 'five', 0, 'five five', 19, 0, 0),
(10, 'six', 'six', 0, 'six six', 17, 0, 0),
(11, 'seven', 'seven', 0, 'seven seven', 17, 0, 0),
(12, 'eight', 'eight', 0, 'eight eight', 19, 0, 0),
(13, 'nine', 'nine', 0, 'nine nine', 16, 0, 0),
(14, 'ten', 'ten', 0, 'ten ten', 16, 0, 0),
(15, 'eleven', 'eleven', 0, 'eleven eleven', 1, 0, 0),
(16, 'twelve', 'twelve', 0, 'twelve twelve', 16, 0, 0),
(17, 'thirty', 'thirty', 0, 'thirty thirty', 17, 0, 0),
(18, 'fourty', 'fourty', 0, 'fourty fourty', 14, 0, 0),
(19, 'fifty', 'fifty', 0, 'fifty fifty', 1, 0, 0),
(20, 'sixty', 'sixty', 0, 'sixty sixty', 1, 0, 0),
(21, 'seventy', 'seventy', 0, 'seventy seventy', 10, 0, 0),
(22, 'eighty', 'eighty', 0, 'eighty', 1, 0, 0),
(23, 'ninty', 'ninty', 0, 'ninty ninty', 15, 0, 0),
(24, 'twenty', 'twenty', 0, 'twenty twenty', 1, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
