-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 12 2024 г., 23:13
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cakeland`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `title`) VALUES
(1, 'Торт'),
(2, 'Булочка');

-- --------------------------------------------------------

--
-- Структура таблицы `confectioner`
--

CREATE TABLE `confectioner` (
  `id` int UNSIGNED NOT NULL,
  `inn` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `userId` int UNSIGNED NOT NULL,
  `organizationTypeId` int UNSIGNED NOT NULL,
  `statusId` int UNSIGNED NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `confectioner`
--

INSERT INTO `confectioner` (`id`, `inn`, `userId`, `organizationTypeId`, `statusId`, `createdAt`) VALUES
(1, '123123123112', 7, 2, 1, '2024-05-12 05:34:24'),
(3, '129412312312', 9, 1, 1, '2024-05-12 09:33:22');

-- --------------------------------------------------------

--
-- Структура таблицы `confectioner_file`
--

CREATE TABLE `confectioner_file` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `confectionerId` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `confectioner_file`
--

INSERT INTO `confectioner_file` (`id`, `name`, `confectionerId`) VALUES
(1, 'lftLn2zXr36Nu-ejuC3idpi_sVPCmzAv.docx', 3),
(2, 'C7jNMYif8Pws5340qUx5ZKZVaFOP6bGl.docx', 3),
(3, '47-3AePOCR4wfJPtrj9wwi21rc_lYSMd.docx', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `order_product`
--

CREATE TABLE `order_product` (
  `id` int UNSIGNED NOT NULL,
  `orderId` int UNSIGNED NOT NULL,
  `productId` int UNSIGNED NOT NULL,
  `amount` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `organization_type`
--

CREATE TABLE `organization_type` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `organization_type`
--

INSERT INTO `organization_type` (`id`, `title`) VALUES
(1, 'Тип 1'),
(2, 'Тип 3'),
(3, 'Тип 4'),
(4, 'Тип 5'),
(5, 'Тип 6');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` int UNSIGNED NOT NULL,
  `quantity` int UNSIGNED NOT NULL,
  `categoryId` int UNSIGNED NOT NULL,
  `statusId` int UNSIGNED NOT NULL,
  `userId` int UNSIGNED NOT NULL,
  `imageId` int UNSIGNED NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `title`, `description`, `price`, `quantity`, `categoryId`, `statusId`, `userId`, `imageId`, `createdAt`) VALUES
(1, 'Тест проверка', ' тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тес212112т тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест\r\n', 13371, 13, 2, 3, 9, 14, '2024-05-12 14:24:43'),
(2, 'Тест', ' тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест тест тест Тест тест тест\r\n', 1337, 69, 1, 1, 9, 10, '2024-05-12 14:24:52');

-- --------------------------------------------------------

--
-- Структура таблицы `product_image`
--

CREATE TABLE `product_image` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `product_image`
--

INSERT INTO `product_image` (`id`, `name`) VALUES
(2, 'pY2uSQrzzbIKNLn1PwJMQWGMGEI126Lo.png'),
(3, 'knC3nNPI4IKPHeJXYG5DQueD3HRb50KJ.png'),
(4, 'TSujlmV4JwvSZvGNgD78ttPp5bRYxZra.png'),
(5, 'Yv6ZXVkB0WV7xm2_DuIbdv4haFM68bql.png'),
(6, 'kuIlHCNfjXo3ruNoFGM0tEbCijpv8dOh.png'),
(7, 'THaWq0sV5Dld7wjhd6lisDffmqaHp8aF.png'),
(8, 'QUhxuOMCjWGLa9FKtVKuAtLPgV7_RDYk.png'),
(9, 'Nw3Gc2SfdjDmKFkwTFnAWnEHVLfxHdCE.png'),
(10, 'aOGxjrLi3uCyLyq8ZSZTOTO6xhD1gErp.png'),
(11, 'MwCP199LrUAOygYlHknGXVfBbJ_RhVXV.png'),
(12, 'HW16NAK16w2b_-XtDY3JOkmGMjFJ7Jo_.png'),
(13, 'Z4UufmH_UV35RtFfcC_u8wvOItNIfbI_.png'),
(14, 'acJQNgwMu0YM_LbzmgnIJrJsowRJKe1G.png');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `title`) VALUES
(1, 'user'),
(2, 'admin'),
(3, 'confectioner');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `title`) VALUES
(1, 'На модерации'),
(2, 'На продаже'),
(3, 'Снят с продажи');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int UNSIGNED NOT NULL,
  `fullName` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `roleId` int UNSIGNED NOT NULL,
  `passwordHash` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `authKey` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `fullName`, `login`, `email`, `roleId`, `passwordHash`, `createdAt`, `authKey`) VALUES
(1, 'Иванов Иван Иванович', 'asd', 'asd@asd.asd', 1, '$2y$13$wJIhqdUvUj.E5El.fRRkv.Mfi9drjjyL2IKefGoHfZ0C8AxUuIU0m', '2024-05-11 15:11:07', 'uRm_u5x-C0SzXNWWq0C7COx62Da307zM'),
(2, 'Васильев Владимир Аркадьевич', 'vva0303', 'v@v.v', 1, '$2y$13$fOWqUbqZnpfhMKWmGivcm.5PpisvG.0pETRZEYW4LDxYGyfGGa5VW', '2024-05-11 15:12:27', 'YnhyKXC82XnV10mAtNiiQ8VL6kmNNIwW'),
(3, 'Иванов Иван Иванович', 'as', 'as@as.as', 1, '$2y$13$G5XzL3n9qHGA/7L6bLrYlepYKKHp9FiH6J3U8p6.HrYLfJFhmQ2PK', '2024-05-12 05:14:55', '4C_qm9Fd4Ja8BnIRP66_ej7jgRAQeJFa'),
(7, 'Иван Иванович Иванов', 'ss', 'ss@ss.ss', 3, '$2y$13$OGWcRa.aW3ImuGFT.9LfUO9Rv9uXUEOFnAsTF756Ec3RlfwkSECxa', '2024-05-12 05:34:24', 'rb7eJC9Kggf0S9iwfxApHVbDT63InBij'),
(9, 'Иван Иванович Иванов', 'test', 'test@test.test', 3, '$2y$13$TF0Aik/YOzxt4/Br8lIS9OWPLGrPovxOyXmZR48sWfc1K3ZrdwlNu', '2024-05-12 09:33:22', 'SZjbn7thd9ifjVUJ9uDf0aSsWHCaAPBV');

-- --------------------------------------------------------

--
-- Структура таблицы `user_order`
--

CREATE TABLE `user_order` (
  `id` int UNSIGNED NOT NULL,
  `userId` int UNSIGNED NOT NULL,
  `statusId` int UNSIGNED NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `confectioner`
--
ALTER TABLE `confectioner`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inn` (`inn`),
  ADD KEY `organizationTypeId` (`organizationTypeId`),
  ADD KEY `statusId` (`statusId`),
  ADD KEY `userId` (`userId`);

--
-- Индексы таблицы `confectioner_file`
--
ALTER TABLE `confectioner_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `confectionerId` (`confectionerId`);

--
-- Индексы таблицы `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderId` (`orderId`),
  ADD KEY `productId` (`productId`);

--
-- Индексы таблицы `organization_type`
--
ALTER TABLE `organization_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryId` (`categoryId`),
  ADD KEY `statusId` (`statusId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `imageId` (`imageId`);

--
-- Индексы таблицы `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `roleId` (`roleId`);

--
-- Индексы таблицы `user_order`
--
ALTER TABLE `user_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `confectioner`
--
ALTER TABLE `confectioner`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `confectioner_file`
--
ALTER TABLE `confectioner_file`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `organization_type`
--
ALTER TABLE `organization_type`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `user_order`
--
ALTER TABLE `user_order`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `confectioner`
--
ALTER TABLE `confectioner`
  ADD CONSTRAINT `confectioner_ibfk_1` FOREIGN KEY (`organizationTypeId`) REFERENCES `organization_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `confectioner_ibfk_2` FOREIGN KEY (`statusId`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `confectioner_ibfk_3` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `confectioner_file`
--
ALTER TABLE `confectioner_file`
  ADD CONSTRAINT `confectioner_file_ibfk_1` FOREIGN KEY (`confectionerId`) REFERENCES `confectioner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `user_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`statusId`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_4` FOREIGN KEY (`imageId`) REFERENCES `product_image` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`roleId`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
