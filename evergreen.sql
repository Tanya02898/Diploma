-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Май 14 2025 г., 20:59
-- Версия сервера: 5.7.24
-- Версия PHP: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `evergreen`
--

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text,
  `type` varchar(50) DEFAULT NULL,
  `diameter` varchar(20) DEFAULT NULL,
  `temperature` varchar(20) DEFAULT NULL,
  `light` varchar(50) DEFAULT NULL,
  `watering` varchar(50) DEFAULT NULL,
  `origin` varchar(50) DEFAULT NULL,
  `package_type` varchar(50) DEFAULT NULL,
  `package_detail` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `description`, `type`, `diameter`, `temperature`, `light`, `watering`, `origin`, `package_type`, `package_detail`) VALUES
(1, 'Barberton Daisy', '119.00', 'images/item1.svg', 'Опис товару...', 'Тип 1', '12 см', '18–24°C', 'Сонячне', 'Помірний', 'Україна', 'Картон', 'Індивідуальна'),
(2, 'Angel Wing Begonia', '169.00', 'images/item2.svg', 'Красива декоративна рослина...', 'Тип 2', '10 см', '16–24°C', 'Яскраве розсіяне', 'Помірний', 'Україна', 'Картон', 'Індивідуальна'),
(3, 'African Violet', '199.00', 'images/item3.svg', 'Популярна квітуча рослина...', 'Тип 3', '9 см', '18–22°C', 'Півтінь', 'Легкий', 'Польща', 'Пластик', 'Індивідуальна'),
(4, 'Beach Spider Lily', '229.00', 'images/item.svg', 'Екзотична рослина...', 'Тип 4', '14 см', '20–25°C', 'Сонячне', 'Регулярний', 'Голландія', 'Картон', 'Подарункова'),
(5, 'Blushing Bromeliad', '139.00', 'images/item5.svg', 'Яскраве доповнення до дому...', 'Тип 5', '11 см', '18–26°C', 'Розсіяне світло', 'Рідкий', 'Україна', 'Папір', 'Індивідуальна'),
(6, 'Aluminum Plant', '179.00', 'images/item6.svg', 'Невибаглива рослина...', 'Тип 6', '13 см', '20–24°C', 'Півтінь', 'Помірний', 'Німеччина', 'Картон', 'Індивідуальна'),
(7, 'Bird\'s Nest Fern', '299.00', 'images/item7.svg', 'Опис товару...', 'Тип 1', '12 см', '18–24°C', 'Сонячне', 'Помірний', 'Україна', 'Картон', 'Індивідуальна'),
(8, 'Broadleaf Lady Palm', '259.00', 'images/item8.svg', 'Рослина з великим листям...', 'Тип 7', '15 см', '16–28°C', 'Сонячне/тінь', 'Частий', 'Китай', 'Пластик', 'Колективна'),
(9, 'Chinese Evergreen', '339.00', 'images/item9.svg', 'Тіньолюбна, ідеальна для офісів...', 'Тип 8', '12 см', '18–24°C', 'Тінь', 'Рідкий', 'Тайланд', 'Картон', 'Індивідуальна'),
(10, 'Fiddle Leaf', '299.00', 'images/item10.svg', 'Опис товару...', 'Тип 1', '14 см', '20–25°C', 'Яскраве розсіяне', 'Рясний', 'Україна', 'Картон', 'Індивідуальна'),
(11, 'Peace Lily', '189.00', 'images/item11.svg', 'Опис товару...', 'Тип 2', '13 см', '18–27°C', 'Розсіяне світло', 'Помірний', 'Україна', 'Картон', 'Індивідуальна'),
(12, 'Calathea Orbifolia', '269.00', 'images/item12.svg', 'Опис товару...', 'Тип 2', '15 см', '18–24°C', 'Півтінь', 'Регулярний', 'Україна', 'Картон', 'Індивідуальна'),
(13, 'Добриво універсальне', '119.00', 'images/item13.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'Добриво для овочів ', '270.00', 'images/item14.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Добриво для дерев та кущів', '235.00', 'images/item15.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Добриво для газону', '215.00', 'images/item16.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Добриво для листових рослин', '270.00', 'images/item17.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Добриво для ягід', '270.00', 'images/item18.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'Віола вітроока', '270.00', 'images/item19.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'Гвоздика периста', '270.00', 'images/item20.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'Лізімахія точкова', '270.00', 'images/item21.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'Дзвіночки персиколисті', '270.00', 'images/item22.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'Мак альпійський', '270.00', 'images/item23.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'Гайлардія Арізона', '270.00', 'images/item24.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'Еустома Маріачі F1', '270.00', 'images/item25.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'Календула лікарська', '270.00', 'images/item26.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'Петунія Лімбо F1', '270.00', 'images/item27.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'Роза в горщику Mimi Eden 3', '270.00', 'images/item28.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'Клематіс у горщику', '270.00', 'images/item29.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'Клематіс Red Star', '270.00', 'images/item30.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'Клематіс Nelly Moser', '270.00', 'images/item31.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'Роза в горщику Indigoletta', '270.00', 'images/item32.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'Роза в горщику Pomponella', '270.00', 'images/item33.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'Півонія у горщику Festiva Maxima', '270.00', 'images/item34.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'Півонія в горщику Patio Peony', '270.00', 'images/item35.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 'Роза Ascot саджанець', '270.00', 'images/item36.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 'Вазон Serinova Colorful ', '270.00', 'images/item37.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'Горщик Lamela Frida', '270.00', 'images/item38.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 'Вазон Serinova Ruby', '270.00', 'images/item39.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 'Вазон Terraneo ', '270.00', 'images/item40.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 'Вазон Lamela Roma', '270.00', 'images/item41.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 'Горщик Prosperplast ', '270.00', 'images/item42.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 'Кашпо для квітів Edelman', '270.00', 'images/item43.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 'Грут Groot горщик', '270.00', 'images/item44.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 'Глиняний вазон Teraplast', '1119.00', 'images/item45.svg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `gmail` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `gmail`, `pass`) VALUES
(17, 'Таня', '123@gmail.com', '111'),
(24, '111', 'qwe@gmail.com', '$2y$12$PYUZmNZMJwg1N.cOBTcGgeOEom/nnAtf.7EZELX2S.1wOckZansdO');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
