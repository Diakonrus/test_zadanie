-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.27 - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              7.0.0.4390
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица test.authors
DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test.authors: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
INSERT INTO `authors` (`id`, `firstname`, `lastname`, `created_at`) VALUES
	(1, 'Иван', 'Пронин', '2016-01-06 16:47:58'),
	(2, 'Василий', 'Темный', '2016-01-06 16:48:08'),
	(3, 'Петр', 'Смирнов', '2016-01-06 16:48:15'),
	(4, 'Степан', 'Сивый', '2016-01-06 16:48:26'),
	(5, 'Алексей', 'Самсонов', '2016-01-06 16:48:37');
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;


-- Дамп структуры для таблица test.books
DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `author_id` int(10) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `preview` varchar(150) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_books_authors` (`author_id`),
  CONSTRAINT `FK_books_authors` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test.books: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` (`id`, `author_id`, `name`, `date_create`, `date_update`, `preview`, `date`) VALUES
	(1, 3, 'Преступление и Наказание', '2016-01-07 16:12:23', '2016-01-06 21:07:55', 'uploads/Fire (13).jpg', '2014-03-08'),
	(2, 1, 'Гари Потный', '2016-01-06 16:36:20', '2016-01-06 21:16:58', 'uploads/Fire (3).jpg', '2016-01-14');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
