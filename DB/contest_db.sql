-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: mysql:3306
-- Время создания: Окт 03 2023 г., 20:15
-- Версия сервера: 8.0.34
-- Версия PHP: 8.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `contest_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_09_21_144920_create_tasks_groups_table', 1),
(6, '2023_09_21_144933_create_tasks_table', 1),
(7, '2023_09_21_230005_create_previous_solutions_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `previous_solutions`
--

CREATE TABLE `previous_solutions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `task_id` bigint UNSIGNED NOT NULL,
  `code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `result` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `tasks_group_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tests` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `active`, `tasks_group_id`, `title`, `type`, `description`, `tests`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Описание', '', '# Описание\r\nЗдесь описывается задание в формате MarkDown и формулы в формате LaTeX\r\n___\r\n# Типография\r\n\r\n*Курсивный текст*\r\n\r\n**Жирный текст**\r\n\r\n***Жирный + курсивный текст***\r\n\r\n~~Зачёркнутый текст~~\r\n\r\n**~~Жирный, зачёркнутый текст~~**\r\n\r\n# H1\r\n## H2\r\n### H3\r\n#### H4\r\n##### H5\r\n###### H6\r\n___\r\n## Код\r\n\r\nМожно выделять `отдельные` слова\r\n\r\nИли вставлять части кода\r\n```python\r\n# Python\r\na, b = map(int, input().split())\r\nprint(a + b)\r\n```\r\n___\r\n## Таблицы\r\n\r\n| # |      Город      |    человек |\r\n|:--|:---------------:|-----------:|\r\n| 1 |     Москва      | 13 010 112 |\r\n| 2 | Санкт-Петербург |  5 601 911 |\r\n| 3 |   Новосибирск   |  1 633 595 |\r\n| 4 |  Екатеринбург   |  1 588 665 |\r\n___\r\n## Картинки\r\n\r\n![img](https://sun9-10.userapi.com/impg/TQsEbfb5EXFnt-oFzGHf5FgZswuf2Cr_4ODvLw/rIegWoduBNE.jpg?size=500x500&quality=96&sign=dc2a80d8d4f7447b00f943a08935c17c&type=album)\r\n\r\n###### [или ссылки](/assets/img/Contest.png)\r\n___\r\n## Формулы (LaTeX)\r\n### $$ e^{i\\Pi} + 1 = 0 $$\r\n\r\n___\r\nОписание хранится в базе данных MySQL в типе **Text** - 65,535 (2^16 − 1) байт\r\n\r\nСлишком большое описание может не вместиться в базу данных', '{\r\n    \"maxtime\": 1,\r\n    \"memory_size\": 256,\r\n    \"tests\": [\r\n        {\r\n            \"stdin\": \"0\",\r\n            \"stdout\": \"0\"\r\n        }\r\n    ]\r\n}', '2023-09-23 10:17:29', '2023-09-28 12:59:32'),
(2, 1, 1, 'Тесты', '', '# Описание тестов\r\n\r\nТесты задаются в формате JSON\r\n\r\nОбезательные поля:\r\n* maxtime - максмвальное время выполнения программы в секундах (целое положительное число)\r\n* memory_size - максимальная память для программы в мегабайтах (целое положительное число)\r\n* tests - список тестов\r\n\r\nОбезательные поля для теста:\r\n* stdin - ввод\r\n* stdout - правильный ответ\r\n\r\n```\r\n{\r\n    \"maxtime\": 1,\r\n    \"memory_size\": 256,\r\n    \"tests\": [\r\n        {\r\n            \"stdin\": \"1 2\",\r\n            \"stdout\": \"3\"\r\n        },\r\n        {\r\n            \"stdin\": \"14 26\\n56\",\r\n            \"stdout\": \"40\"\r\n        }\r\n    ]\r\n}\r\n```\r\n\r\n*Количество тестов может быть любым, в разумных пределах.*\r\n___\r\nТесты хранятся в базе данных MySQL в типе **Text** - 65,535 (2^16 − 1) байт\r\n\r\nСлишком большое количество тестов может не вместиться в базу данных', '{\r\n    \"maxtime\": 1,\r\n    \"memory_size\": 256,\r\n    \"tests\": [\r\n        {\r\n            \"stdin\": \"1 2\",\r\n            \"stdout\": \"3\"\r\n        },\r\n        {\r\n            \"stdin\": \"14 26\",\r\n            \"stdout\": \"40\"\r\n        }\r\n    ]\r\n}', '2023-09-23 23:59:17', '2023-09-25 22:42:50'),
(9, 1, 1, 'Математика', '', '# Математика\r\n\r\nЗдесь представлены различны математические формулы для демонстрации\r\n___\r\n\r\n$$ y = mx + b^4 $$\r\n___\r\n$$ x = {-b \\pm \\sqrt{b^2-4ac} \\over 2a} $$\r\n___\r\n$$\\left( \\sum_{k<1}^n a_k b_k \\right)^2 \\leq \\left( \\sum_{k=1}^n a_k^2 \\right) \\left( \\sum_{k=1}^n b_k^2 \\right)$$\r\n___\r\n$$\r\n\\operatorname{ker} f=\\{g\\in G:f(g)=e_{H}\\}{\\mbox{.}}\r\n$$\r\n___\r\n\\begin{equation*}\r\nl ( \\theta ) = \\sum _ { i = 1 } ^ { m } \\log p ( x , \\theta )\r\n\\end{equation*}\r\n___\r\n\\begin{align*}\r\nt _ { 1 } + t _ { 2 } = \\frac { ( 2 L / c ) \\sqrt { 1 - u ^ { 2 } / c ^ { 2 } } } { 1 - u ^ { 2 } / c ^ { 2 } } = \\frac { 2 L / c } { \\sqrt { 1 - u ^ { 2 } / c ^ { 2 } } }\r\n\\end{align*}\r\n___\r\n\r\n$$A_{m,n} =\r\n\\begin{pmatrix}\r\na_{1,1} & a_{1,2} & \\cdots & a_{1,n} \\\\\\\\\r\na_{2,1} & a_{2,2} & \\cdots & a_{2,n} \\\\\\\\\r\n\\vdots  & \\vdots  & \\ddots & \\vdots  \\\\\\\\\r\na_{m,1} & a_{m,2} & \\cdots & a_{m,n}\r\n\\end{pmatrix}\r\n$$\r\n ___\r\n$$\r\nM = \\begin{bmatrix}\r\n       \\frac{5}{6} & \\frac{1}{6} & 0           \\\\\\\\[0.3em]\r\n       \\frac{5}{6} & 0           & \\frac{1}{6} \\\\\\\\[0.3em]\r\n       0           & \\frac{5}{6} & \\frac{1}{6}\r\n     \\end{bmatrix}\r\n     $$     \r\n___\r\n$$\r\nf(n) =\r\n  \\begin{cases}\r\n    n/2       & \\quad \\text{if } n \\text{ is even}\\\\\\\\\r\n    -(n+1)/2  & \\quad \\text{if } n \\text{ is odd}\r\n  \\end{cases}\r\n\\\r\n$$\r\n___\r\n$$\r\n\\left(\r\n    \\begin{array}{c}\r\n      n \\\\\\\\\r\n      r\r\n    \\end{array}\r\n  \\right) = \\frac{n!}{r!(n-r)!}\r\n$$', '{\r\n    \"maxtime\": 1,\r\n    \"memory_size\": 256,\r\n    \"tests\": [\r\n        {\r\n            \"stdin\": \"0\",\r\n            \"stdout\": \"0\"\r\n        }\r\n    ]\r\n}', '2023-09-25 20:07:13', '2023-09-25 22:18:33'),
(18, 1, 1, 'Пример задания', '', '# Пример оформления задания\r\nНаписать программу, которая суммирует n введённых чисел\r\n$$\r\n	N = \\sum_{i=1}^n a_i\r\n$$\r\n\r\n**Формат входных данных**\r\n\r\nВ первой строке входного файла дано целое число n — количество чисел\r\n$$\r\n(1 ≤ n ≤ 1000)\r\n$$\r\n\r\n**Формат выходных данных**\r\n\r\nВывести одно целое число N - сумму введённых чисел\r\n\r\n\r\n___\r\n#### Примеры данных:\r\n\r\n##### Пример 1\r\n**Ввод**\r\n```\r\n3\r\n5 5 5\r\n```\r\n\r\n**Вывод**\r\n```\r\n15\r\n```\r\n___\r\n\r\n##### Пример 2\r\n**Ввод**\r\n```\r\n4\r\n1 2 3 4\r\n```\r\n\r\n**Вывод**\r\n```\r\n10\r\n```\r\n\r\n___\r\n**Примечание**\r\n\r\nПример кода на языке программирования Python\r\n```Python\r\n# Python\r\nn = input()\r\nprint(sum(map(int, input().split())))\r\n```', '{\r\n    \"maxtime\": 1,\r\n    \"memory_size\": 256,\r\n    \"tests\": [\r\n        {\r\n            \"stdin\": \"3\\n5 5 5\",\r\n            \"stdout\": \"15\"\r\n        }\r\n    ]\r\n}', '2023-09-25 22:19:20', '2023-09-25 22:43:31'),
(20, 1, 7, 'Рулет', '', '*Задание взято с [tinkoff.contest](https://edu.tinkoff.ru/selection/76378fbd-1998-48fa-944e-eb736d321f11/exam/244?task=2)*\r\n\r\nВаня принес на кухню рулет, который он хочет разделить с коллегами. Для этого он хочет разрезать рулет на N равных частей. Разумеется, рулет можно резать только поперек. Соотвественно, Костя сделает\r\nN−1 разрез ножом через равные промежутки.\r\n\r\nПо возвращению с кофе-брейка Ваня задумался — а можно ли было обойтись меньшим числом движений, будь нож Вани бесконечно длинным (иначе говоря, если он мог бы сделать сколько угодно разрезов за раз, если эти разрезы лежат на одной прямой)? Считается, что места для разрезов намечены заранее, и все разрезы делаются с ювелирной точностью.\r\n\r\nОказывается, что можно. Например, если Ваня хотел бы разделить рулет на\r\n4 части, он мог бы обойтись двумя разрезами — сначала он разделил бы рулет на две половинки, а потом совместил бы две половинки и разрезал обе пополам одновременно.\r\n\r\nВам дано число N, требуется сказать, каким минимальным числом разрезов можно обойтись.\r\n\r\n**Формат входных данных**\r\n\r\nДано одно натуральное число N\r\n$$\r\n(1 ≤ N ≤ 2 * 10^9)\r\n$$\r\n— количество людей на кофе-брйке.\r\n\r\n\r\n**Формат выходных данных**\r\n\r\nВыведите одно число — минимальное число движений, которое придется сделать Косте.\r\n\r\n**Замечание**\r\n\r\nЧтобы разрезать рулет на 6 частей, Ване сначала придется разрезать его на две равные части, после чего совместить две половинки и сделать два разреза.\r\n\r\nЧтобы разрезать рулет на 5 частей, Ване понадобится разделить его в соотношении \r\n2 : 3, после чего совместить два рулета по левому краю и разрезать бОльший рулет на одинарные кусочки — меньший тоже разделится на одинарные.\r\n\r\n___\r\n#### Примеры данных:\r\n\r\n##### Пример 1\r\n**Ввод**\r\n```\r\n6\r\n```\r\n\r\n**Вывод**\r\n```\r\n3\r\n```\r\n___\r\n\r\n##### Пример 2\r\n**Ввод**\r\n```\r\n5\r\n```\r\n\r\n**Вывод**\r\n```\r\n3\r\n```', '{\r\n    \"maxtime\": 1,\r\n    \"memory_size\": 256,\r\n    \"tests\": [\r\n        {\r\n            \"stdin\": \"6\",\r\n            \"stdout\": \"3\"\r\n        },\r\n     	{\r\n            \"stdin\": \"5\",\r\n            \"stdout\": \"3\"\r\n        }\r\n    ]\r\n}', '2023-09-25 23:26:52', '2023-09-28 11:20:52'),
(21, 1, 6, 'Сумма A + B', '', 'Даны два числа A и B. Вам нужно вычислить их сумму A+B. В этой задаче для работы с входными и выходными данными вы можете использовать и файлы и потоки на ваше усмотрение.\r\n\r\n**Формат входных данных**\r\n\r\nПервая строка входа содержит числа A и B (−2⋅10^9≤A,B≤2⋅10^9) разделенные пробелом\r\n\r\n**Формат выходных данных**\r\n\r\nВ единственной строке выхода выведите сумму чисел A+B\r\n\r\n___\r\n#### Примеры данных:\r\n\r\n##### Пример 1\r\n**Ввод**\r\n```\r\n1 2\r\n```\r\n\r\n**Вывод**\r\n```\r\n3\r\n```\r\n___\r\n\r\n##### Пример 2\r\n**Ввод**\r\n```\r\n5 -13\r\n```\r\n\r\n**Вывод**\r\n```\r\n-8\r\n```', '{\r\n    \"maxtime\": 1,\r\n    \"memory_size\": 256,\r\n    \"tests\": [\r\n        {\r\n            \"stdin\": \"1 2\",\r\n            \"stdout\": \"3\"\r\n        },\r\n        {\r\n            \"stdin\": \"5 -13\",\r\n            \"stdout\": \"-8\"\r\n        }\r\n    ]\r\n}', '2023-09-28 12:00:06', '2023-09-28 18:59:25'),
(22, 1, 7, 'Камни и украшения', '', '*Задание взято с [yandex.contest](https://contest.yandex.ru/contest/3/problems/G/)*\r\n\r\nДаны две строки строчных латинских символов: строка J и строка S. Символы, входящие в строку J, — «драгоценности», входящие в строку S — «камни». Нужно определить, какое количество символов из S одновременно являются «драгоценностями». Проще говоря, нужно проверить, какое количество символов из S входит в J.\r\nЭто разминочная задача, к которой мы размещаем готовые решения. Она очень простая и нужна для того, чтобы вы могли познакомиться с нашей автоматической системой проверки решений. Ввод и вывод осуществляется через файлы, либо через стандартные потоки ввода-вывода, как вам удобнее.\r\n\r\n**Формат входных данных**\r\n\r\nНа двух первых строках входного файла содержатся две строки строчных латинских символов: строка J и строка S. Длина каждой не превосходит 100 символов.\r\n\r\n**Формат выходных данных**\r\n\r\nВыходной файл должен содержать единственное число — количество камней, являющихся драгоценностями.\r\n\r\n___\r\n#### Примеры данных:\r\n\r\n##### Пример 1\r\n**Ввод**\r\n```\r\nab\r\naabbccd\r\n```\r\n\r\n**Вывод**\r\n```\r\n4\r\n```', '{\r\n    \"maxtime\": 1,\r\n    \"memory_size\": 256,\r\n    \"tests\": [\r\n        {\r\n            \"stdin\": \"ab\\naabbccd\",\r\n            \"stdout\": \"4\"\r\n        }\r\n    ]\r\n}', '2023-09-28 12:05:29', '2023-09-28 12:17:55'),
(23, 1, 7, 'Лифт', '', '*Задание взято с [tinkoff.contest](https://edu.tinkoff.ru/selection/76378fbd-1998-48fa-944e-eb736d321f11/exam/244?task=3)*\r\n\r\nУ Кати насыщенный день на работе. Ей надо передать n разных договоров коллегам. Все встре- чи происходят на разных этажах, а между этажами можно перемещаться только по лестничным пролетам — считается, что это улучшает физическую форму сотрудников. Прохождение каждого пролета занимает ровно 1 минуту.\r\n\r\nСейчас Катя на парковочном этаже, планирует свой маршрут. Коллег можно посетить в любом порядке, но один из них покинет офис через t минут. С парковочного этажа лестницы нет — только лифт, на котором можно подняться на любой этаж.\r\n\r\nВ итоге план Кати следующий:\r\n1. Подняться на лифте на произвольный этаж. Считается, что лифт поднимается на любой этаж за 0 минут.\r\n2. Передать всем коллегам договоры, перемещаясь между этажами по лестнице. Считается, что договоры на этаже передаются мгновенно.\r\n3. В первые t минут передать договор тому коллеге, который планирует уйти.\r\n4. Пройти минимальное количество лестничных пролетов.\r\n\r\nПомогите Кате выполнить все пункты ее плана.\r\n\r\n**Формат входных данных**\r\n\r\nВ первой строке вводятся целые положительные числа n и t (2≤n,t≤100) — количество сотрудников и время, когда один из сотрудников покинет офис (в минутах). В следующей строке n чисел — номера этажей, на которых находятся сотрудники. Все числа различны и по абсолютной величине не превосходят 100. Номера этажей даны в порядке возрастания. В следующей строке записан номер сотрудника, который уйдет через t минут.\r\n\r\n\r\n**Формат выходных данных**\r\n\r\nВыведите одно число — минимально возможное число лестничных пролетов, которое понадобится пройти Кате.\r\n\r\n**Замечание**\r\n\r\nВ первом примере времени достаточно, чтобы Катя поднялась по этажам по порядку.\r\n\r\nВо втором примере Кате понадобится подняться к уходящему сотруднику, а потом пройти всех остальных — \r\nнапример, в порядке {1, 2, 3, 4, 6}\r\n\r\n\r\n___\r\n#### Примеры данных:\r\n\r\n##### Пример 1\r\n**Ввод**\r\n```\r\n5 5\r\n1 4 9 16 25\r\n2\r\n```\r\n\r\n**Вывод**\r\n```\r\n24\r\n```\r\n___\r\n\r\n##### Пример 2\r\n**Ввод**\r\n```\r\n6 4\r\n1 2 3 6 8 25\r\n5\r\n```\r\n\r\n**Вывод**\r\n```\r\n31\r\n```', '{\r\n    \"maxtime\": 1,\r\n    \"memory_size\": 256,\r\n    \"tests\": [\r\n        {\r\n            \"stdin\": \"6 4\\n1 2 3 6 8 25\\n5\",\r\n            \"stdout\": \"24\"\r\n        },\r\n        {\r\n            \"stdin\": \"5 5\\n1 4 9 16 25\\n2\",\r\n            \"stdout\": \"31\"\r\n        }\r\n    ]\r\n}', '2023-09-28 12:09:50', '2023-09-28 12:50:15'),
(26, 0, 6, 'Умножатор', '', 'Дано число N. Вам нужно вычислить произведение N * 2.\r\n\r\n**Формат входных данных**\r\n\r\nПервая строка входа содержит числа N (−2⋅10^9≤N≤2⋅10^9)\r\n\r\n**Формат выходных данных**\r\n\r\nВ единственной строке выхода выведите произведение N * 2\r\n\r\n___\r\n#### Примеры данных:\r\n\r\n##### Пример 1\r\n**Ввод**\r\n```\r\n5\r\n```\r\n\r\n**Вывод**\r\n```\r\n10\r\n```\r\n___\r\n\r\n##### Пример 2\r\n**Ввод**\r\n```\r\n6\r\n```\r\n\r\n**Вывод**\r\n```\r\n12\r\n```', '{\r\n    \"maxtime\": 2,\r\n    \"memory_size\": 512,\r\n    \"tests\": [\r\n        {\r\n            \"stdin\": \"5\",\r\n            \"stdout\": \"10\"\r\n        },\r\n        {\r\n            \"stdin\": \"6\",\r\n            \"stdout\": \"12\"\r\n        }\r\n    ]\r\n}', '2023-09-28 19:09:54', '2023-09-28 19:11:25');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks_groups`
--

CREATE TABLE `tasks_groups` (
  `id` bigint UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tasks_groups`
--

INSERT INTO `tasks_groups` (`id`, `active`, `title`, `img`, `created_at`, `updated_at`) VALUES
(1, 1, 'Введение', '/assets/img/tests/info.jpg', '2023-09-23 10:16:41', '2023-09-25 23:21:15'),
(6, 1, 'Проверочные задания', '/assets/img/tests/2+2.jpg', '2023-09-25 21:50:35', '2023-09-25 23:36:41'),
(7, 1, 'Алгоритмы', '/assets/img/tests/algorithm.png', '2023-09-25 22:01:57', '2023-09-30 09:43:11');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@test.com', NULL, '$2y$10$m17UZ1aAZc/HOzUWSi0aUewjjzjzxmkxolWCLL6pQ5Kjj5JmfXSxW', 'admin', NULL, '2023-09-23 07:16:33', '2023-09-23 07:16:33'),
(2, 'user', 'user@test.com', NULL, '$2y$10$DOe.NKx1BN07KihnjoNDpO/cMp8g.KpTy5qdJRAmMkjUuhuQOQIee', 'user', NULL, '2023-09-24 11:26:07', '2023-09-24 11:26:07');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `previous_solutions`
--
ALTER TABLE `previous_solutions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `previous_solutions_user_id_foreign` (`user_id`),
  ADD KEY `previous_solutions_task_id_foreign` (`task_id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_tasks_group_id_foreign` (`tasks_group_id`);

--
-- Индексы таблицы `tasks_groups`
--
ALTER TABLE `tasks_groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `previous_solutions`
--
ALTER TABLE `previous_solutions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `tasks_groups`
--
ALTER TABLE `tasks_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `previous_solutions`
--
ALTER TABLE `previous_solutions`
  ADD CONSTRAINT `previous_solutions_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `previous_solutions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_tasks_group_id_foreign` FOREIGN KEY (`tasks_group_id`) REFERENCES `tasks_groups` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
