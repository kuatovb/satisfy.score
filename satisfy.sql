-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 28 2021 г., 14:29
-- Версия сервера: 5.5.62
-- Версия PHP: 7.4.14


-- CREATE DATABASE satisfy;
-- USE satisfy;


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `satisfy`
--

-- --------------------------------------------------------

--
-- Структура таблицы `catalog_flowers`
--

CREATE TABLE `catalog_flowers` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `catalog_flowers`
--

INSERT INTO `catalog_flowers` (`id`, `category_name`) VALUES
(1, 'Цветы в коробках'),
(2, 'Весенняя коллекция букетов'),
(3, 'Авторские букеты');

-- --------------------------------------------------------

--
-- Структура таблицы `flowers`
--

CREATE TABLE `flowers` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `flowers`
--

INSERT INTO `flowers` (`id`, `title`, `text`, `img_name`, `price`, `date`, `author_id`, `category_id`) VALUES
(2, 'Композиция в коробку \"Кападокия\"', 'Состав выдерживается в полном соответствии с указанным составом композиции. При покупке евробукета, возможно, несовпадение цветовой гаммы букета, представленного на фотографии.  © https://aktau.zakazbuketov.kz/catalog/flowers/avtorskie_bukety/kompozitsiya_kapadokiya/ ZakazBuketov.KZ', '61c1148940ca3ce9aba4637d220100a7.jpg', '30,25', '2021-05-27 05:00:19', 1, 3),
(3, '25 голландских тюльпанов', 'Состав выдерживается в полном соответствии с указанным составом композиции. При покупке евробукета, возможно, несовпадение цветовой гаммы букета, представленного на фотографии.  © https://aktau.zakazbuketov.kz/catalog/flowers/vesennyaya_kollektsiya/25_gollandskikh_tyulpanov/ ZakazBuketov.KZ', 'f922167471ac3fc505b29f9c33f8f0b7c8ee1d41ffd25fc971d52e98d7bb5718.jpg', '53,00', '2021-05-27 06:39:23', 1, 2),
(4, 'Композиция \"Дейнерис\"', 'Состав выдерживается в полном соответствии с указанным составом композиции. При покупке евробукета, возможно, несовпадение цветовой гаммы букета, представленного на фотографии.  © https://aktau.zakazbuketov.kz/catalog/flowers/tsvety_v_korobkakh/kompozitsiya_deyneris/ ZakazBuketov.KZ', '7caadbbfb825722923ba41b0361d70208933f4b7f1aa86f4c25c81c6e6729240.png', '16,01', '2021-05-27 06:50:16', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'Administrator', '{\"admin\": 1, \"moderator\": 1, \"author\": 1, \"participant\": 1}'),
(2, 'Moderator', '{\"moderator\": 1, \"author\": 1, \"participant\": 1}'),
(3, 'Author', '{\"author\": 1, \"participant\": 1}'),
(4, 'Participant', '{\"participant\": 1}');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_addet` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `full_name`, `tel`, `date_addet`, `product_id`) VALUES
(1, 'asdsadsa', '8777777777', '2021-05-28 06:32:19', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `full_name`, `login`, `password`, `salt`, `joined`, `group_id`) VALUES
(1, 'Kuatov Bagdat', 'kuatovb', '0b08dc79a0a9d1c38c5c3ea6dfd64842f03e30f4dab92074dc5875ab39093963', '84a1fa482a8d6434a37e227941c3fce9', '2020-12-11 05:42:35', 1),
(2, 'Nurzhan Kalmensheev', 'nurzhan', 'b1fa813948d1e1747c240155fb8358cc12b8cf085d1ddbec8dc6c6446ac8c97b', '589299040b2a6d3aff4dd85e91e6670d', '2020-12-14 05:07:28', 2),
(3, 'Максат Омаров', 'momarov', '9e5b4d25eb930f1b70c1ce6413fcb246aed0a9b1d850c05c1f45e65833979234', 'f9753394757fa1e5d8a1ef027290a4fc', '2020-12-29 11:43:58', 3),
(4, 'Попов Максим', '_1maaxim', 'fc68fda210d723cdab95d7080dfacc97062c5d3e28d7d9b8fe05989c616f3610', '585a3e5029e9341880e3b5818e5f77b9', '2020-12-30 03:37:18', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `users_session`
--

CREATE TABLE `users_session` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `catalog_flowers`
--
ALTER TABLE `catalog_flowers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `flowers`
--
ALTER TABLE `flowers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`group_id`);

--
-- Индексы таблицы `users_session`
--
ALTER TABLE `users_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `catalog_flowers`
--
ALTER TABLE `catalog_flowers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `flowers`
--
ALTER TABLE `flowers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users_session`
--
ALTER TABLE `users_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `flowers`
--
ALTER TABLE `flowers`
  ADD CONSTRAINT `flowers_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `flowers_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `catalog_flowers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
