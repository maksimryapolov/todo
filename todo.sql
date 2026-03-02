-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.0:3306
-- Время создания: Фев 08 2026 г., 13:22
-- Версия сервера: 8.0.44
-- Версия PHP: 8.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `todo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int NOT NULL DEFAULT '100',
  `active` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `name`, `code`, `sort`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Новый', 'new', 100, 'Y', '2026-02-05 20:48:47', '2026-02-05 20:48:47'),
(3, 'В работе', 'progress', 200, 'Y', '2026-02-05 20:49:51', '2026-02-05 20:49:51'),
(4, 'Завершён', 'completed', 300, 'Y', '2026-02-05 20:51:23', '2026-02-05 20:51:31');

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE `task` (
  `id` int NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int NOT NULL DEFAULT '100',
  `active` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status_id` int NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `task`
--

INSERT INTO `task` (`id`, `title`, `code`, `sort`, `active`, `created_at`, `updated_at`, `status_id`, `description`) VALUES
(1, 'test', NULL, 100, 1, '2026-09-15 21:00:00', '2026-02-08 10:21:16', 1, '123123');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_code` (`code`),
  ADD KEY `idx_sort_active` (`sort`,`active`),
  ADD KEY `idx_name` (`name`);

--
-- Индексы таблицы `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_code` (`code`),
  ADD KEY `idx_title` (`title`),
  ADD KEY `idx_sort_active` (`sort`,`active`),
  ADD KEY `status_id` (`status_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `task`
--
ALTER TABLE `task`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
