-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Час створення: Жов 27 2016 р., 16:14
-- Версія сервера: 5.7.14
-- Версія PHP: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `dashboard`
--

-- --------------------------------------------------------

--
-- Структура таблиці `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `pageName` varchar(255) NOT NULL,
  `pageDescription` text NOT NULL,
  `coordinates` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `data`
--

INSERT INTO `data` (`id`, `userId`, `pageName`, `pageDescription`, `coordinates`) VALUES
(1, 1, 'Page name', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\n            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\n            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n            proident, sunt in culpa qui ', '{"top": 545, "left": 302}');

-- --------------------------------------------------------

--
-- Структура таблиці `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `hash`) VALUES
(1, 'Alex', 'email@mail.com', '$2y$10$7twkWL2ndPDy0VEq3czciuRGDXTsMycngaLFE1KQAfskuqH/.fwxO');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
