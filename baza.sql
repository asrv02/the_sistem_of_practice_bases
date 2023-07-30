-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 19 2023 г., 07:35
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
-- База данных: `diplom`
--

-- --------------------------------------------------------

--
-- Структура таблицы `application`
--

CREATE TABLE `application` (
  `id` int UNSIGNED NOT NULL,
  `status_id` int UNSIGNED NOT NULL,
  `student_id` int UNSIGNED NOT NULL,
  `employer_id` int UNSIGNED NOT NULL,
  `organization_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `application`
--

INSERT INTO `application` (`id`, `status_id`, `student_id`, `employer_id`, `organization_id`) VALUES
(24, 1, 9, 27, 1),
(27, 2, 9, 32, 2),
(28, 1, 22, 27, 1),
(29, 1, 22, 27, 1),
(30, 1, 22, 34, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `applicationstud`
--

CREATE TABLE `applicationstud` (
  `id` int UNSIGNED NOT NULL,
  `status_id` int UNSIGNED NOT NULL,
  `employer_id` int UNSIGNED NOT NULL,
  `employer_lists_id` int UNSIGNED NOT NULL,
  `specialization_id` int UNSIGNED NOT NULL,
  `student_id` int UNSIGNED NOT NULL,
  `organization_name_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', 2, 1681396530),
('employer', 27, 1683707264),
('employer', 32, 1684872833),
('employer', 33, 1685909030),
('employer', 34, 1687028989),
('practice_manager', 3, 1682455051),
('student', 9, 1682616453),
('student', 10, 1682616535),
('student', 11, 1682937839),
('student', 12, 1682937908),
('student', 13, 1682937963),
('student', 14, 1682938018),
('student', 15, 1682938061),
('student', 16, 1682938099),
('student', 17, 1682938141),
('student', 18, 1682938191),
('student', 19, 1682938232),
('student', 20, 1682938288),
('student', 21, 1682938347),
('student', 22, 1682938404),
('student', 23, 1682938451),
('student', 24, 1682938494),
('student', 25, 1682938541);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` smallint NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `rule_name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'Администраор', NULL, NULL, 1681396530, 1681396530),
('can_admin', 2, 'Все разрешения + создавать пользователей, изменять их удалять.', NULL, NULL, 1681396530, 1681396530),
('employer', 1, 'Работодатель', NULL, NULL, 1681396530, 1681396530),
('per_employer', 2, 'Доступ в личный аккаунт. Добавить задачу. Просмотреть задачи. Редактировать задачу. Удалить задачу. Добавить предмет к задаче.', NULL, NULL, 1681396530, 1681396530),
('per_practice_manager', 2, 'Создать группу. Изменить группу. Удалить группу. Добавить студента в группу. Удалить студента из группы. Создать предмет. Удалить предмет. Добавить задачу для студентов. Изменить задачу. Удалить задачу. Просмотреть ответы студентов на задачу.', NULL, NULL, 1681396530, 1681396530),
('per_student', 2, 'Отправить ответ на задачу. Изменить ответ. Отменить ответ.', NULL, NULL, 1681396530, 1681396530),
('practice_manager', 1, 'Руководитель практики', NULL, NULL, 1681396530, 1681396530),
('student', 1, 'Студент', NULL, NULL, 1681396530, 1681396530);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `child` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'can_admin'),
('employer', 'per_employer'),
('practice_manager', 'per_practice_manager'),
('student', 'per_student');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `documents`
--

CREATE TABLE `documents` (
  `id` int UNSIGNED NOT NULL,
  `doki` varchar(255) NOT NULL,
  `view_practice_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `documents`
--

INSERT INTO `documents` (`id`, `doki`, `view_practice_id`) VALUES
(13, '/uploads/_dcQ1zxk5Bqch1687080321.zip', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `educational_institution`
--

CREATE TABLE `educational_institution` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `educational_institution`
--

INSERT INTO `educational_institution` (`id`, `title`) VALUES
(1, 'СПБ ГБ ПОУ \"Радиотехнический колледж\"');

-- --------------------------------------------------------

--
-- Структура таблицы `education_received`
--

CREATE TABLE `education_received` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `education_received`
--

INSERT INTO `education_received` (`id`, `title`) VALUES
(1, 'Среднее профессиональное образование ');

-- --------------------------------------------------------

--
-- Структура таблицы `entry`
--

CREATE TABLE `entry` (
  `id` int UNSIGNED NOT NULL,
  `specialization_id` int UNSIGNED NOT NULL,
  `organization_name_id` int UNSIGNED NOT NULL,
  `quantity` bigint NOT NULL,
  `contacts` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `group`
--

CREATE TABLE `group` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `specialization_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `group`
--

INSERT INTO `group` (`id`, `title`, `specialization_id`) VALUES
(1, '301', 4),
(2, '303', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `holiday`
--

CREATE TABLE `holiday` (
  `id` int UNSIGNED NOT NULL,
  `day` int UNSIGNED NOT NULL,
  `year_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1681394426),
('m140506_102106_rbac_init', 1681394437),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1681394437),
('m180523_151638_rbac_updates_indexes_without_prefix', 1681394437),
('m200409_110543_rbac_update_mssql_trigger', 1681394437);

-- --------------------------------------------------------

--
-- Структура таблицы `organization`
--

CREATE TABLE `organization` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `organization`
--

INSERT INTO `organization` (`id`, `title`, `address`, `email`, `phone`) VALUES
(1, 'ПМК \"Патриот\"', 'ул. Курская д.50', 'patriot@yandex.ru', 89210320560),
(2, 'ПМК \"Искатели\"', 'ул. Коллонтай д.41', 'iskately@yande.ru', 89211560780),
(3, 'ПМК \"Белый медведь\"', 'ул. Пролетарская д.30', 'whitebear@yande.ru', 89210540320);

-- --------------------------------------------------------

--
-- Структура таблицы `placepractice`
--

CREATE TABLE `placepractice` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `date` timestamp NOT NULL,
  `group_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `placepractice`
--

INSERT INTO `placepractice` (`id`, `title`, `link`, `date`, `group_id`) VALUES
(1, 'практика', 'https://docs.google.com/document/d/1YpqfBHt3zcwM8js4qwFt_dP86hmBmECCXvb_iWZmGrM/edit', '2020-05-19 21:00:00', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `post`
--

CREATE TABLE `post` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `post`
--

INSERT INTO `post` (`id`, `title`) VALUES
(1, 'Директор'),
(2, 'Зам. директора');

-- --------------------------------------------------------

--
-- Структура таблицы `practice_group`
--

CREATE TABLE `practice_group` (
  `id` int UNSIGNED NOT NULL,
  `view_practice_id` int UNSIGNED NOT NULL,
  `group_id` int UNSIGNED NOT NULL,
  `begin_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `documents_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `practice_group`
--

INSERT INTO `practice_group` (`id`, `view_practice_id`, `group_id`, `begin_date`, `end_date`, `documents_id`) VALUES
(5, 1, 1, '2023-06-01 09:26:27', '2023-06-29 09:26:27', 13),
(6, 1, 1, '2023-01-09 21:00:00', '2023-01-19 21:00:00', 13);

-- --------------------------------------------------------

--
-- Структура таблицы `resume`
--

CREATE TABLE `resume` (
  `id` int UNSIGNED NOT NULL,
  `specialization_id` int UNSIGNED NOT NULL,
  `surname` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `patronymic` varchar(255) NOT NULL,
  `phone` bigint NOT NULL,
  `email` varchar(255) NOT NULL,
  `education_received_id` int UNSIGNED NOT NULL,
  `educational_institution_id` int UNSIGNED NOT NULL,
  `faculty` text,
  `specialization` text,
  `training_form_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `resume`
--

INSERT INTO `resume` (`id`, `specialization_id`, `surname`, `name`, `patronymic`, `phone`, `email`, `education_received_id`, `educational_institution_id`, `faculty`, `specialization`, `training_form_id`) VALUES
(6, 4, 'Смирнова', 'Ангелина', 'Сергеевна', 89210460373, 'q@q.q', 1, 1, NULL, NULL, 1),
(7, 4, 'Егоров', 'Иван', 'Дмитриевич', 89210320501, 'egorov@yandex.ru', 1, 1, NULL, NULL, 1),
(8, 4, 'Хренова', 'Анастасия', 'Евгеньевна', 89210460898, 'kull@yandex.ru', 1, 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `semester`
--

CREATE TABLE `semester` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `semester_date`
--

CREATE TABLE `semester_date` (
  `id` int UNSIGNED NOT NULL,
  `begin_date` int UNSIGNED NOT NULL,
  `end_date` int UNSIGNED NOT NULL,
  `group_id` int UNSIGNED NOT NULL,
  `semester_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `semester_year`
--

CREATE TABLE `semester_year` (
  `id` int UNSIGNED NOT NULL,
  `year_id` int UNSIGNED NOT NULL,
  `semester_id` int UNSIGNED NOT NULL,
  `begin_date` int UNSIGNED NOT NULL,
  `end_date` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `specialization`
--

CREATE TABLE `specialization` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `specialization`
--

INSERT INTO `specialization` (`id`, `title`) VALUES
(3, '09.02.06 Сетевое и системное администрирование'),
(4, '09.02.07 Информационные системы и программирование'),
(5, '11.02.16 Монтаж, техническое обслуживание и ремонт электронных приборов и устройств'),
(6, '09.01.01 Наладчик аппаратного и программного обеспечения'),
(7, '11.01.01 Монтажник радиоэлектронной аппаратуры и приборов');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `title`) VALUES
(1, 'Активен'),
(2, 'Одобрен'),
(3, 'Отклонен');

-- --------------------------------------------------------

--
-- Структура таблицы `status_loading`
--

CREATE TABLE `status_loading` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `status_loading`
--

INSERT INTO `status_loading` (`id`, `title`) VALUES
(1, 'Загружено '),
(2, 'Не загружено ');

-- --------------------------------------------------------

--
-- Структура таблицы `student_group`
--

CREATE TABLE `student_group` (
  `id` int UNSIGNED NOT NULL,
  `student_id` int UNSIGNED NOT NULL,
  `group_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `student_group`
--

INSERT INTO `student_group` (`id`, `student_id`, `group_id`) VALUES
(2, 10, 1),
(3, 15, 1),
(4, 20, 2),
(5, 22, 1),
(6, 23, 1),
(7, 24, 2),
(8, 25, 1),
(12, 9, 1),
(13, 11, 1),
(14, 12, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `student_lists`
--

CREATE TABLE `student_lists` (
  `id` int UNSIGNED NOT NULL,
  `student_id` int UNSIGNED NOT NULL,
  `specialization_id` int UNSIGNED NOT NULL,
  `practice_date_from` timestamp NOT NULL,
  `practice_date_to` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `student_lists`
--

INSERT INTO `student_lists` (`id`, `student_id`, `specialization_id`, `practice_date_from`, `practice_date_to`) VALUES
(4, 10, 4, '2023-05-03 21:00:00', '2023-05-17 21:00:00'),
(5, 14, 4, '2023-05-03 21:00:00', '2023-05-17 21:00:00'),
(6, 13, 4, '2023-05-09 21:00:00', '2023-05-24 21:00:00'),
(7, 15, 4, '2023-05-02 21:00:00', '2023-05-24 21:00:00'),
(8, 12, 4, '2023-05-31 21:00:00', '2023-06-25 21:00:00'),
(9, 16, 4, '2023-05-31 21:00:00', '2023-06-25 21:00:00'),
(10, 17, 4, '2023-05-31 21:00:00', '2023-06-24 21:00:00'),
(11, 18, 4, '2023-05-31 21:00:00', '2023-06-24 21:00:00'),
(12, 9, 4, '2023-06-05 07:40:44', '2023-06-05 07:40:44'),
(13, 11, 4, '2023-05-31 21:00:00', '2023-06-20 21:00:00'),
(14, 21, 4, '2023-05-31 21:00:00', '2023-06-28 21:00:00'),
(15, 19, 4, '2023-05-31 21:00:00', '2023-06-28 21:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `student_practice`
--

CREATE TABLE `student_practice` (
  `id` int UNSIGNED NOT NULL,
  `student_id` int UNSIGNED NOT NULL,
  `practice_group_id` int UNSIGNED NOT NULL,
  `organization_id` int UNSIGNED DEFAULT NULL,
  `place_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `report` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_loading_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `student_practice`
--

INSERT INTO `student_practice` (`id`, `student_id`, `practice_group_id`, `organization_id`, `place_title`, `report`, `status_loading_id`) VALUES
(16, 10, 5, 1, NULL, NULL, NULL),
(17, 15, 5, NULL, 'Кубик', NULL, NULL),
(18, 22, 5, 3, NULL, '22_1687086417_Характеристика.docx', NULL),
(19, 23, 5, 2, NULL, NULL, NULL),
(20, 25, 5, 2, NULL, NULL, NULL),
(23, 10, 6, 2, NULL, NULL, NULL),
(24, 15, 6, 2, NULL, NULL, NULL),
(25, 22, 6, 2, NULL, NULL, NULL),
(26, 23, 6, 2, NULL, NULL, NULL),
(27, 25, 6, 2, NULL, NULL, NULL),
(31, 9, 5, 2, NULL, 'uploads/9_1687128899_Характеристика.docx', NULL),
(33, 11, 5, NULL, NULL, NULL, NULL),
(35, 9, 6, NULL, NULL, NULL, NULL),
(36, 11, 6, NULL, NULL, NULL, NULL),
(37, 12, 5, NULL, NULL, NULL, NULL),
(38, 12, 6, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `student_resume`
--

CREATE TABLE `student_resume` (
  `id` int UNSIGNED NOT NULL,
  `resume_id` int UNSIGNED NOT NULL,
  `student_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `student_resume`
--

INSERT INTO `student_resume` (`id`, `resume_id`, `student_id`) VALUES
(5, 6, 9),
(6, 7, 16),
(7, 8, 22);

-- --------------------------------------------------------

--
-- Структура таблицы `training_form`
--

CREATE TABLE `training_form` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `training_form`
--

INSERT INTO `training_form` (`id`, `title`) VALUES
(1, 'ОЧНАЯ'),
(2, 'ЗАОЧНАЯ');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `patronymic` varchar(255) DEFAULT NULL,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `auth_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `course` int UNSIGNED DEFAULT NULL,
  `specialization_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `patronymic`, `login`, `email`, `password`, `auth_key`, `course`, `specialization_id`) VALUES
(2, 'admin', 'admin', 'admin', 'admin', 'admin@a.a', '$2y$13$Oo1n9iOMb/kdqftP1itNJ.xqHi1HJ0riBT3fKNpwdWMnhs9Tks1NS', '0', 0, NULL),
(3, 'Игорь', 'Сергеев', 'Петрович', 'w', 'w@w.w', '$2y$13$wrQw49gJ.j5fthH47jzeLO3hbc43ul9ufLzBnFvUGLKv09FHizCDC', '0', NULL, NULL),
(9, 'Ангелина', 'Смирнова', 'Сергеевна', 'a.srv02', '3010group@yandex.ru', '$2y$13$jZDTMZ5Wy5lEyYOzGwdu.e8b/dYWPPeWrTdMUuUa0Cz2Sf8BHNTBC', '5', 3, 4),
(10, 'Анастасия', 'Писукова', 'Вадимовна', 'acova', '3011group@yandex.ru', '$2y$13$eLlwrl7zK1oZ8C0lZjy.zOtjelwNT70YcJlfWZvjTyQ06wRFM7mIC', '0', 3, 4),
(11, 'Радван ', 'Баракат', 'Ахмад', 'barakat', '3012group@yandex.ru', '$2y$13$PeIefs.kEu/b0H0dexMRfuvyrFteKai5uF5WIOOGzRugXXD6x5KQu', '0', 3, 4),
(12, 'Анастасия', 'Бритвина', 'Николаевна', 'britvina', '3013group@yandex.ru', '$2y$13$KXjGl.Mt.42YXmgauvWLzuujhTOzhGIwL20hVnwJcFzMypuh2Re9.', '0', 3, 4),
(13, 'Виктория', 'Валтахова', 'Викторовна', 'valtahova', '3014group@yandex.ru', '$2y$13$DiOsqFaZqVv6vpgEw8wXeuKuMkqH3h90C7R5M92m2mHQL6ucN7K1q', '0', 3, 4),
(14, 'Артём', 'Вернидуб', 'Дмитриевич', 'vernidub', '3015group@yandex.ru', '$2y$13$FUViLd7JTYrfudtEIunvtO/AbRT9yLgsWHScJY8MysjISP8dvU7ii', '0', 3, 4),
(15, 'Анна ', 'Галкина', 'Игоревна ', 'galkina', '3016group@yandex.ru', '$2y$13$aCpGgWaNQp/W6OzVYE6uk.Plnzk5LrdLeOY2hvbeHu.lB5tqPUkSq', '0', 3, 4),
(16, 'Иван ', 'Егоров', 'Дмитриевич', 'egorov', '3016group@yandex.ru', '$2y$13$ph5S1mPYDzfIbiKfVhD8/uUso7ztTG3un4mYht2LPrNC8wU1zLT3S', '0', 3, 4),
(17, 'Даниил ', 'Коробченко', 'Олегович', 'korobchenko', '3017group@yandex.ru', '$2y$13$5lb.msPW32n/ftMLddRhxucxlXVCVVMhYQzOvjjBweHVN7SNp5Ls.', '0', 3, 4),
(18, 'Гаррик ', 'Левин', 'Олегович', 'levin', '3018group@yandex.ru', '$2y$13$u0hj7Nv58UdlNublg5jncOkCufhhNAgTIlR7Fh83zgA5hqBr6KOLu', '0', 3, 4),
(19, 'Даниил ', 'Савочкин', 'Максимович', 'savochkin', '3019group@yandex.ru', '$2y$13$uwGFwZe725ANCZfIdm9aSey21/nIdXno7kdEdzQocPqCPl0M1znBm', '0', 3, 4),
(20, 'Денис ', 'Сафин', 'Ринатович', 'safin', '30110group@yandex.ru', '$2y$13$vAxdr.Z6l1hTeVSCA8MEquWtqvcwRWEfEyDuGs5cjXF9wyAVllk2G', '0', 3, 4),
(21, 'Полина ', 'Старцева', 'Андреевна', 'starzeva', '30111group@yandex.ru', '$2y$13$emfazBaBzvYhmaqd23YjrOSC/qrAezbhZMonNMJHK7KbGOwn32wwe', '0', 3, 4),
(22, 'Анастасия ', 'Хренова', 'Евгеньевна', 'hrenova', '30112group@yandex.ru', '$2y$13$5geWQSjGHTnRqBj0b1lETOHsgV/pyf9X0YbkmdkJ6OU36B8P8BR/G', '0', 3, 4),
(23, 'Никита ', 'Шакарун', 'Рабихович', 'shakarun', '30113group@yandex.ru', '$2y$13$O5gPZ9JMZaxd.DyNH17Hw.G1OLbsKti4buzeQV2vz06Zq7gBxu32.', '0', 3, 4),
(24, 'Анастасия ', 'Шестакова', 'Андреевна ', 'shestakova', '30114group@yandex.ru', '$2y$13$8mWyOKxxmr2G7omDBsnNyOE6lZR78N7PPAvct89UKUZxbsCzjxRni', '0', 3, 4),
(25, 'Евгения ', 'Юрьева', 'Константиновна', 'ureva', '30115group@yandex.ru', '$2y$13$ftWQirmJ8gmjw83dtZXTB.iIi5zHCsJfe6JUbRDw1h/4B4pzBHRPK', '0', 3, 4),
(27, 'Игорь', 'Сергеевич', 'Петров', 'уу', 'yy@k.k', '$2y$13$KwckJaRQOKm4oOZ8KesnW.zDVpL.N42m/nfh33nFVPChsLT6xEdmW', '0', NULL, NULL),
(32, 'Илья', 'Андреевич', 'Иванов', 'z', 'z@z.z', '$2y$13$dN11FjshvU6gUqkT/Ack7.yElhIMQUu9hzjREqqxQN18dfzXWk0y6', '0', NULL, NULL),
(33, 'Петр', 'Петров', 'Петрович', 'Iskateli', 'qwerty@q.q', '$2y$13$e3c1/kvosXlqISqjX06fQedZuHbBViEOe.mNLCw9csvzZt7qXWJ.K', '0', NULL, NULL),
(34, 'Игорь', 'Петров', 'Сергеевич', 'qwerty', 'qwerty11@q.q', '$2y$13$9mAVHySa8F6CbutSGLwqR.qeGt/gmw52NQUWZVnkaYl5VazWOrphW', '0', NULL, NULL),
(35, 'Мария', 'Самойленко', 'Сергеевна', 'samoilenko', 'samoilenko@yandex.ru', '$2y$13$HIBmGsDu.jpJtKabFN57L.BU7jjz4.c2iTzdwNZx9n006dVRBG26G', '0', 2, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `user_interprise`
--

CREATE TABLE `user_interprise` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `organization_id` int UNSIGNED NOT NULL,
  `post_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user_interprise`
--

INSERT INTO `user_interprise` (`id`, `user_id`, `organization_id`, `post_id`) VALUES
(1, 27, 1, 1),
(2, 32, 2, 1),
(3, 34, 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `view_practice`
--

CREATE TABLE `view_practice` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `view_practice`
--

INSERT INTO `view_practice` (`id`, `title`) VALUES
(1, 'ПП.05'),
(2, 'ПП.08'),
(3, 'ПП.09'),
(4, 'УП05'),
(5, 'УП08');

-- --------------------------------------------------------

--
-- Структура таблицы `year`
--

CREATE TABLE `year` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `begin_date` int UNSIGNED NOT NULL,
  `end_date` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `employer_id` (`employer_id`),
  ADD KEY `organization_id` (`organization_id`);

--
-- Индексы таблицы `applicationstud`
--
ALTER TABLE `applicationstud`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employer_id` (`employer_id`),
  ADD KEY `employer_list` (`employer_lists_id`),
  ADD KEY `specialization_id` (`specialization_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `organization_name_id` (`organization_name_id`);

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `view_practice_id` (`view_practice_id`);

--
-- Индексы таблицы `educational_institution`
--
ALTER TABLE `educational_institution`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `education_received`
--
ALTER TABLE `education_received`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `entry`
--
ALTER TABLE `entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organization_name_id` (`organization_name_id`),
  ADD KEY `specialization_id` (`specialization_id`);

--
-- Индексы таблицы `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specialization_id` (`specialization_id`);

--
-- Индексы таблицы `holiday`
--
ALTER TABLE `holiday`
  ADD PRIMARY KEY (`id`),
  ADD KEY `year_id` (`year_id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `placepractice`
--
ALTER TABLE `placepractice`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `practice_group`
--
ALTER TABLE `practice_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `view_practice_id` (`view_practice_id`),
  ADD KEY `documents_id` (`documents_id`);

--
-- Индексы таблицы `resume`
--
ALTER TABLE `resume`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specialization_id` (`specialization_id`),
  ADD KEY `education_received_id` (`education_received_id`),
  ADD KEY `training_form_id` (`training_form_id`),
  ADD KEY `educational_institution_id` (`educational_institution_id`);

--
-- Индексы таблицы `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `semester_date`
--
ALTER TABLE `semester_date`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Индексы таблицы `semester_year`
--
ALTER TABLE `semester_year`
  ADD PRIMARY KEY (`id`),
  ADD KEY `year_id` (`year_id`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Индексы таблицы `specialization`
--
ALTER TABLE `specialization`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `status_loading`
--
ALTER TABLE `status_loading`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `student_group`
--
ALTER TABLE `student_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Индексы таблицы `student_lists`
--
ALTER TABLE `student_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specialization_id` (`specialization_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Индексы таблицы `student_practice`
--
ALTER TABLE `student_practice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `practice_group_id` (`practice_group_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `place_enterprises_id` (`organization_id`),
  ADD KEY `status_loading_id` (`status_loading_id`);

--
-- Индексы таблицы `student_resume`
--
ALTER TABLE `student_resume`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resume_id` (`resume_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Индексы таблицы `training_form`
--
ALTER TABLE `training_form`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specialization_id` (`specialization_id`);

--
-- Индексы таблицы `user_interprise`
--
ALTER TABLE `user_interprise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `place_interprise_id` (`organization_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Индексы таблицы `view_practice`
--
ALTER TABLE `view_practice`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `application`
--
ALTER TABLE `application`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `applicationstud`
--
ALTER TABLE `applicationstud`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `educational_institution`
--
ALTER TABLE `educational_institution`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `education_received`
--
ALTER TABLE `education_received`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `entry`
--
ALTER TABLE `entry`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `group`
--
ALTER TABLE `group`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `holiday`
--
ALTER TABLE `holiday`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `organization`
--
ALTER TABLE `organization`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `placepractice`
--
ALTER TABLE `placepractice`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `post`
--
ALTER TABLE `post`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `practice_group`
--
ALTER TABLE `practice_group`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `resume`
--
ALTER TABLE `resume`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `semester_date`
--
ALTER TABLE `semester_date`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `semester_year`
--
ALTER TABLE `semester_year`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `specialization`
--
ALTER TABLE `specialization`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `status_loading`
--
ALTER TABLE `status_loading`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `student_group`
--
ALTER TABLE `student_group`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `student_lists`
--
ALTER TABLE `student_lists`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `student_practice`
--
ALTER TABLE `student_practice`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT для таблицы `student_resume`
--
ALTER TABLE `student_resume`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `training_form`
--
ALTER TABLE `training_form`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT для таблицы `user_interprise`
--
ALTER TABLE `user_interprise`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `view_practice`
--
ALTER TABLE `view_practice`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `year`
--
ALTER TABLE `year`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `application_ibfk_4` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `application_ibfk_5` FOREIGN KEY (`employer_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `application_ibfk_6` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `applicationstud`
--
ALTER TABLE `applicationstud`
  ADD CONSTRAINT `applicationstud_ibfk_1` FOREIGN KEY (`employer_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applicationstud_ibfk_3` FOREIGN KEY (`specialization_id`) REFERENCES `specialization` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applicationstud_ibfk_4` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applicationstud_ibfk_5` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_assignment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`view_practice_id`) REFERENCES `view_practice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `entry`
--
ALTER TABLE `entry`
  ADD CONSTRAINT `entry_ibfk_2` FOREIGN KEY (`specialization_id`) REFERENCES `specialization` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `group_ibfk_1` FOREIGN KEY (`specialization_id`) REFERENCES `specialization` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `holiday`
--
ALTER TABLE `holiday`
  ADD CONSTRAINT `holiday_ibfk_1` FOREIGN KEY (`year_id`) REFERENCES `year` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `practice_group`
--
ALTER TABLE `practice_group`
  ADD CONSTRAINT `practice_group_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `practice_group_ibfk_2` FOREIGN KEY (`view_practice_id`) REFERENCES `view_practice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `practice_group_ibfk_3` FOREIGN KEY (`documents_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `resume`
--
ALTER TABLE `resume`
  ADD CONSTRAINT `resume_ibfk_1` FOREIGN KEY (`specialization_id`) REFERENCES `specialization` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resume_ibfk_2` FOREIGN KEY (`education_received_id`) REFERENCES `education_received` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resume_ibfk_3` FOREIGN KEY (`training_form_id`) REFERENCES `training_form` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resume_ibfk_4` FOREIGN KEY (`educational_institution_id`) REFERENCES `educational_institution` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `semester_date`
--
ALTER TABLE `semester_date`
  ADD CONSTRAINT `semester_date_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `semester_date_ibfk_2` FOREIGN KEY (`semester_id`) REFERENCES `semester_year` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `semester_year`
--
ALTER TABLE `semester_year`
  ADD CONSTRAINT `semester_year_ibfk_1` FOREIGN KEY (`year_id`) REFERENCES `year` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `semester_year_ibfk_2` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `student_group`
--
ALTER TABLE `student_group`
  ADD CONSTRAINT `student_group_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_group_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `student_lists`
--
ALTER TABLE `student_lists`
  ADD CONSTRAINT `student_lists_ibfk_1` FOREIGN KEY (`specialization_id`) REFERENCES `specialization` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_lists_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `student_practice`
--
ALTER TABLE `student_practice`
  ADD CONSTRAINT `student_practice_ibfk_1` FOREIGN KEY (`practice_group_id`) REFERENCES `practice_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_practice_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_practice_ibfk_3` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_practice_ibfk_4` FOREIGN KEY (`status_loading_id`) REFERENCES `status_loading` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `student_resume`
--
ALTER TABLE `student_resume`
  ADD CONSTRAINT `student_resume_ibfk_1` FOREIGN KEY (`resume_id`) REFERENCES `resume` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_resume_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`specialization_id`) REFERENCES `specialization` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_interprise`
--
ALTER TABLE `user_interprise`
  ADD CONSTRAINT `user_interprise_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_interprise_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_interprise_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
