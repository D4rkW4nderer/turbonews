-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 27 2021 г., 07:32
-- Версия сервера: 10.4.11-MariaDB
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `turbonews`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `comment_text` mediumtext NOT NULL,
  `comment_news_id` int(11) NOT NULL,
  `comment_user_id` int(11) NOT NULL,
  `comment_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_date`, `comment_text`, `comment_news_id`, `comment_user_id`, `comment_type`) VALUES
(1, '2021-02-15 20:00:00', '12312323123231231231231231213', 6, 10, NULL),
(2, '2021-02-16 20:00:00', '312132132123132312312132123', 6, 14, NULL),
(3, '2021-02-28 20:00:00', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 6, 10, NULL),
(4, '2021-03-01 10:44:07', 'Donec lobortis dignissim metus. Maecenas sed congue nibh. Maecenas porttitor accumsan ligula. Integer porttitor, urna ut ullamcorper pulvinar, felis erat tempus libero, at eleifend lacus mi ut lectus. Vivamus ornare, massa at bibendum placerat, velit diam placerat turpis, eu gravida lectus magna et ex. Cras ornare, ex non maximus porttitor, elit magna gravida mauris, sit amet consequat nunc ipsum at leo. Quisque eu justo eu velit tincidunt placerat at at lorem. Aenean finibus, sapien eget faucibus sagittis, lacus nunc tempor turpis, efficitur aliquam quam lacus nec metus', 6, 10, NULL),
(5, '2021-03-01 11:45:04', 'dfsdfssdffdsfdsfdsjhert565646546', 6, 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `complaints`
--

CREATE TABLE `complaints` (
  `complaint_id` int(11) NOT NULL,
  `complaint_reason` varchar(75) NOT NULL,
  `complaint_description` mediumtext NOT NULL,
  `complaint_user_id` int(11) NOT NULL,
  `complaint_news_id` int(11) NOT NULL,
  `complaint_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `complaint_status` varchar(50) NOT NULL DEFAULT 'unchecked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `complaints`
--

INSERT INTO `complaints` (`complaint_id`, `complaint_reason`, `complaint_description`, `complaint_user_id`, `complaint_news_id`, `complaint_date`, `complaint_status`) VALUES
(2, 'опечатки', 'фвыфы', 1, 6, '2021-03-17 11:43:21', 'checked'),
(3, 'запрещенное', 'фывфывфывфывцйуцу', 1, 7, '2021-03-25 08:35:24', 'unchecked'),
(4, 'другое', 'asdwqerhgfjfccbn dxh', 1, 6, '2021-03-25 08:54:31', 'unchecked');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `news_title` mediumtext NOT NULL,
  `news_text` longtext NOT NULL,
  `news_image` mediumtext DEFAULT NULL,
  `news_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `news_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`news_id`, `news_title`, `news_text`, `news_image`, `news_date`, `news_type`) VALUES
(6, ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac ultrices velit, ac placerat nisi. ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac ultrices velit, ac placerat nisi. Ut consequat, nisl ac consectetur elementum, dui nisi aliquet tellus, a consectetur nibh purus in tellus. Proin sed mauris id nulla tempor facilisis ac mollis dolor. Maecenas varius massa vestibulum, semper est a, volutpat elit. Nunc finibus neque in consequat dictum. Nam id fermentum magna. Maecenas sollicitudin vulputate nisl, quis congue lectus ornare non. Praesent egestas est id viverra porta. Nullam bibendum sodales mollis. Maecenas id dapibus metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor placerat semper. Nam eget dui justo. Praesent nec nulla quis purus fermentum consectetur a vel eros.\r\n<br>\r\nMorbi sem ligula, consequat eu enim et, condimentum rhoncus nibh. Vestibulum laoreet libero ac tortor luctus, a congue odio suscipit. Vestibulum consectetur non ex sed ultrices. Mauris volutpat ante a elit pellentesque, vel mollis augue varius. Interdum et malesuada fames ac ante ipsum primis in faucibus. In vehicula vehicula efficitur. Maecenas vel libero orci. Ut vulputate enim quis luctus faucibus. Praesent tincidunt aliquet purus. Ut vitae tortor enim. Sed tincidunt sem non odio sollicitudin, at hendrerit nisi gravida. Cras facilisis quis ligula ac mollis. Ut quam orci, lobortis quis massa sed, mollis imperdiet velit.\r\n<br>\r\nCras eu nisi quis augue cursus tristique. Aenean eget imperdiet turpis, quis cursus velit. Ut lacus lacus, vulputate ac libero eu, ultrices finibus nibh. Suspendisse faucibus, velit consectetur ultricies vehicula, risus lectus accumsan felis, vel pretium felis eros sit amet metus. Etiam eu urna ante. Praesent cursus tortor ac dui congue imperdiet. Etiam et sem nec ligula malesuada fringilla. Phasellus ultrices lobortis consequat. Sed ipsum libero, faucibus luctus purus et, tincidunt maximus justo. Aliquam ultrices orci sed congue consequat. Nunc luctus dictum nunc, nec suscipit nisi ultrices sed. Cras egestas lectus ipsum, vel blandit tortor facilisis maximus. Vestibulum at erat eu nisl cursus efficitur. Vestibulum id nisl faucibus, congue libero et, aliquet purus. Vivamus imperdiet euismod nisl id pulvinar.\r\n<br>\r\nNunc efficitur dui sit amet nisl rutrum vulputate. Maecenas auctor lacinia neque, eget blandit metus mattis eget. Curabitur elementum felis mollis maximus varius. Ut pulvinar, metus a porttitor placerat, purus orci porta eros, et ornare magna eros et odio. Aliquam gravida nulla eget quam malesuada tincidunt condimentum sit amet sem. Ut sodales ligula eu justo sollicitudin, eget elementum nisi efficitur. Suspendisse non ante dolor. Vivamus at velit eget dolor posuere finibus. Suspendisse dictum nec nibh a imperdiet. Cras venenatis, lorem eu efficitur convallis, felis lorem semper purus, nec eleifend felis magna eget nunc. Cras ultricies posuere sem, in feugiat arcu euismod et. In et metus orci. Donec ultrices in orci at placerat. Sed mattis congue egestas.', '20210125_12072.jpg', '2021-01-24 20:00:00', 'entertainment'),
(7, 'Morbi sem ligula, consequat eu enim et, condimentum rhoncus nibh.', 'Morbi sem ligula, consequat eu enim et, condimentum rhoncus nibh. Vestibulum laoreet libero ac tortor luctus, a congue odio suscipit. Vestibulum consectetur non ex sed ultrices. Mauris volutpat ante a elit pellentesque, vel mollis augue varius. Interdum et malesuada fames ac ante ipsum primis in faucibus. In vehicula vehicula efficitur. Maecenas vel libero orci. Ut vulputate enim quis luctus faucibus. Praesent tincidunt aliquet purus. Ut vitae tortor enim. Sed tincidunt sem non odio sollicitudin, at hendrerit nisi gravida. Cras facilisis quis ligula ac mollis. Ut quam orci, lobortis quis massa sed, mollis imperdiet velit.\r\n&lt;br&gt;\r\nCras eu nisi quis augue cursus tristique. Aenean eget imperdiet turpis, quis cursus velit. Ut lacus lacus, vulputate ac libero eu, ultrices finibus nibh. Suspendisse faucibus, velit consectetur ultricies vehicula, risus lectus accumsan felis, vel pretium felis eros sit amet metus. Etiam eu urna ante. Praesent cursus tortor ac dui congue imperdiet. Etiam et sem nec ligula malesuada fringilla. Phasellus ultrices lobortis consequat. Sed ipsum libero, faucibus luctus purus et, tincidunt maximus justo. Aliquam ultrices orci sed congue consequat. Nunc luctus dictum nunc, nec suscipit nisi ultrices sed. Cras egestas lectus ipsum, vel blandit tortor facilisis maximus. Vestibulum at erat eu nisl cursus efficitur. Vestibulum id nisl faucibus, congue libero et, aliquet purus. Vivamus imperdiet euismod nisl id pulvinar.\r\n&lt;br&gt;\r\nNunc efficitur dui sit amet nisl rutrum vulputate. Maecenas auctor lacinia neque, eget blandit metus mattis eget. Curabitur elementum felis mollis maximus varius. Ut pulvinar, metus a porttitor placerat, purus orci porta eros, et ornare magna eros et odio. Aliquam gravida nulla eget quam malesuada tincidunt condimentum sit amet sem. Ut sodales ligula eu justo sollicitudin, eget elementum nisi efficitur. Suspendisse non ante dolor. Vivamus at velit eget dolor posuere finibus. Suspendisse dictum nec nibh a imperdiet. Cras venenatis, lorem eu efficitur convallis, felis lorem semper purus, nec eleifend felis magna eget nunc. Cras ultricies posuere sem, in feugiat arcu euismod et. In et metus orci. Donec ultrices in orci at placerat. Sed mattis congue egestas. ', '20210301_9562.jpg', '2021-02-28 20:00:00', 'tech');

-- --------------------------------------------------------

--
-- Структура таблицы `user_list`
--

CREATE TABLE `user_list` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_image` mediumtext DEFAULT NULL,
  `user_type` varchar(50) NOT NULL,
  `user_date` date NOT NULL,
  `user_info` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `user_list`
--

INSERT INTO `user_list` (`user_id`, `user_name`, `user_password`, `user_image`, `user_type`, `user_date`, `user_info`) VALUES
(1, 'super_admin', '3bsAdminPS', '20210115_34398.png', 'admin', '2021-01-09', NULL),
(10, 'just_user', 'userpass', NULL, 'user', '2021-01-11', NULL),
(11, 'super_moder', '12momomoder13', NULL, 'moderator', '2021-01-11', NULL),
(14, 'test-user', 'asdf123', '20210115_17867.png', 'banned', '2021-01-15', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment_news_id` (`comment_news_id`),
  ADD KEY `comment_user_id` (`comment_user_id`);

--
-- Индексы таблицы `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `complaint_user_id` (`complaint_user_id`),
  ADD KEY `complaint_news_id` (`complaint_news_id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Индексы таблицы `user_list`
--
ALTER TABLE `user_list`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `user_list`
--
ALTER TABLE `user_list`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`comment_news_id`) REFERENCES `news` (`news_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`comment_user_id`) REFERENCES `user_list` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`complaint_user_id`) REFERENCES `user_list` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complaints_ibfk_2` FOREIGN KEY (`complaint_news_id`) REFERENCES `news` (`news_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
