-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2023 年 5 月 17 日 17:57
-- サーバのバージョン： 5.7.39
-- PHP のバージョン: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `Schmee`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT '学校通信ID',
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'タイトル',
  `body` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '本文',
  `articleImg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '画像のパス',
  `schools_id` bigint(20) UNSIGNED NOT NULL COMMENT '学校ID',
  `users_id` bigint(20) UNSIGNED NOT NULL COMMENT 'ユーザーID',
  `grade` int(11) NOT NULL DEFAULT '0' COMMENT '学年',
  `class` int(11) NOT NULL DEFAULT '0' COMMENT 'クラス',
  `del_fg` int(11) NOT NULL DEFAULT '0' COMMENT '0:表示 1:非表示',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `articles`
--

INSERT INTO `articles` (`id`, `title`, `body`, `articleImg`, `schools_id`, `users_id`, `grade`, `class`, `del_fg`, `created_at`, `updated_at`) VALUES
(15, 'Schmeeについて', '保護者の皆様、本日よりこのSchmeeというSNSを活用し、コミュニケーションをとっていきたいと思っております。\r\nこのSNSは学校通信等を私たち教師が投稿いたします。\r\nそれに対し保護者の皆様はコメントやいいねをすることができますのでぜひ使用していただければと思います。', NULL, 4, 5, 0, 0, 0, '2023-05-14 09:55:54', '2023-05-14 09:55:54'),
(16, 'ダイレクトメッセージについて', 'このSNSはダイレクトメッセージもできますのでもし何か聞きたいことや困ったことがあった際はぜひご活用ください。', NULL, 4, 5, 0, 0, 0, '2023-05-14 09:58:39', '2023-05-17 03:05:58');

-- --------------------------------------------------------

--
-- テーブルの構造 `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'コメントID',
  `articles_id` bigint(20) UNSIGNED NOT NULL COMMENT '学校通信ID',
  `users_id` bigint(20) UNSIGNED NOT NULL COMMENT 'ユーザーID',
  `body` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'コメント本文',
  `del_fg` int(11) NOT NULL COMMENT '0:表示 1:非表示',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'いいねID',
  `users_id` bigint(20) UNSIGNED NOT NULL COMMENT 'ユーザーID',
  `articles_id` bigint(20) UNSIGNED NOT NULL COMMENT '学校通信ID',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'メッセージID',
  `rooms_id` bigint(20) UNSIGNED NOT NULL COMMENT 'ルームID',
  `users_id` bigint(20) UNSIGNED NOT NULL COMMENT 'ユーザーID',
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'メッセージ本文',
  `del_fg` int(11) NOT NULL COMMENT '論理削除',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2023_04_14_092110_create_schools_table', 1),
(2, '2014_10_12_000000_create_users_table', 2),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(4, '2023_04_14_083956_create_articles_table', 2),
(5, '2023_04_16_030958_create_users_detail_table', 2),
(6, '2023_04_16_033604_create_teachers_detail_table', 2),
(7, '2023_04_16_033852_create_comments_table', 2),
(8, '2023_04_16_035332_create_likes_table', 2),
(9, '2023_04_16_035617_create_rooms_table', 2),
(11, '2023_04_16_035928_create_messages_table', 2),
(12, '2023_04_16_035748_create_room_user_table', 3),
(13, '2023_05_09_113330_create_user_tokens_table', 4);

-- --------------------------------------------------------

--
-- テーブルの構造 `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'ルームID',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ルーム名',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `room_user`
--

CREATE TABLE `room_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL COMMENT 'ルームID',
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'ユーザーID',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `schools`
--

CREATE TABLE `schools` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT '学校ID',
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '学校コード',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '学校名',
  `address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '学校住所',
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '学校電話番号',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `schools`
--

INSERT INTO `schools` (`id`, `code`, `name`, `address`, `tel`, `created_at`, `updated_at`) VALUES
(1, 'A000000000000', 'admin', 'admin', 'admin', NULL, NULL),
(4, 'B114221820072', '綾瀬市立北の台小学校', '神奈川県綾瀬市大上9-14-1', '0467775807', '2023-05-05 06:11:37', '2023-05-05 06:11:37'),
(5, 'C114221820043', '綾瀬市立北の台中学校', '神奈川県綾瀬市蓼川1-2-1', '0467778430', '2023-05-05 06:22:48', '2023-05-05 06:22:48');

-- --------------------------------------------------------

--
-- テーブルの構造 `teachers_detail`
--

CREATE TABLE `teachers_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL COMMENT 'ユーザーID',
  `jobs` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '役職',
  `grade` int(11) NOT NULL DEFAULT '0' COMMENT '学年',
  `class` int(11) NOT NULL DEFAULT '0' COMMENT 'クラス',
  `imgPath` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'img/user.png' COMMENT '画像のパス',
  `introduction` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '自己紹介',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `teachers_detail`
--

INSERT INTO `teachers_detail` (`id`, `users_id`, `jobs`, `grade`, `class`, `imgPath`, `introduction`, `created_at`, `updated_at`) VALUES
(1, 5, '校長', 0, 0, 'img/DI8LdyWb96hip99ZCal27GU5L8jNzHYMcIespC5I.png', '皆さん、こんにちは。\r\n綾瀬市立北の台小学校で校長をしております、樋口瑛大と申します。\r\nお子様方の学校での様子を見ていると、挨拶はしっかりできて、行事にも部活動にも真剣に取り組んでいて、ご家庭でのご指導の賜物だなと感じることばかりです。\r\nこれから家庭学習の進め方や勉強法なども含め、自分の目指す進路に向かって努力するお子様を精一杯バックアップしたいと考えておりますので、ぜひ一緒に見守っていただけたらと思います。\r\nこれからどうぞよろしくお願いいたします。', '2023-05-05 06:12:41', '2023-05-14 09:26:42'),
(2, 8, '校長', 0, 0, 'img/user.png', 'プラトン', '2023-05-05 06:26:06', '2023-05-05 06:26:06'),
(4, 10, '担任', 2, 1, 'img/O2NEFGzWaQuVDnZHvWj9BLWtVfqZjkb5OzhA8jjR.png', '保護者の皆様こんにちは。\r\n2年1組担任の田辺 花子でございます。\r\n私はお子様に2年1組として生活をしていく中で、約束してもらいたいことを1つお話ししました。\r\nそれは、「ヒトやモノを傷付けない」ということ。\r\n私は2年1組全員が安全で安心して過ごせるクラスにしていきたいと思っています。\r\nこのクラスで誰一人として、何一つとして傷つけてほしくありません。\r\n一緒に見守っていければと思っております。\r\nよろしくお願いいたします。', '2023-05-05 09:52:50', '2023-05-14 09:40:44'),
(5, 14, '担任', 3, 1, 'img/2gx6nWy1lvKrrudPCPFpJR33unngKIhHGHTD0OBI.png', '保護者の皆様こんにちは。\r\n3年1組担任の木村 充です。\r\n実は私は中学生の頃は数学の授業が大嫌いで、テストでいい点を取れたことがありませんでした。\r\nですが、ある勉強法に出会ったおかげで、数学がどんどん好きになって、今では数学の先生をしております。\r\nこれからの授業の中で、その勉強法をお子様方に少しずつ教えていければと思います。\r\nよろしくお願いします。', '2023-05-05 09:53:38', '2023-05-14 09:34:18');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'ユーザーID',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ユーザーネーム',
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'メールアドレス',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'パスワード',
  `schools_id` bigint(20) UNSIGNED NOT NULL COMMENT '学校ID',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'トークン',
  `role` int(11) NOT NULL DEFAULT '0' COMMENT '0:保護者 1:関係者 2:代表者 3:運営者',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `schools_id`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$GdnIzl93TUs7E.P8MBw4N.7d3EpOL5lgZg2hz6xsn4r06BOCtfntm', 1, NULL, 3, '2023-05-05 04:51:44', '2023-05-05 04:51:44'),
(5, '樋口 瑛大', 'higuchi@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4, NULL, 2, '2023-05-05 06:12:23', '2023-05-14 11:01:32'),
(8, 'プラトン', 'Plato@gmail.com', '$2y$10$xdi7XUXuprGucn3J1ol4PuteSYEb14nNBCPf0ee.yULJrfcNZXXgS', 5, NULL, 2, '2023-05-05 06:25:37', '2023-05-05 06:25:37'),
(10, '田辺 花子', 'murayama.naoto@example.org', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4, NULL, 1, '2023-05-05 09:01:15', '2023-05-14 09:40:44'),
(11, '藤本 美加子', 'hanako.kanou@example.net', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4, NULL, 0, '2023-05-05 09:01:15', '2023-05-05 09:01:15'),
(12, '小林 充', 'yuki.koizumi@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4, NULL, 0, '2023-05-05 09:01:15', '2023-05-05 09:01:15'),
(13, '宮沢 拓真', 'qmurayama@example.net', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4, NULL, 0, '2023-05-05 09:01:15', '2023-05-05 09:01:15'),
(14, '木村 充', 'kimura.osamu@example.org', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4, NULL, 1, '2023-05-05 09:01:15', '2023-05-14 09:34:18'),
(15, '井高 里佳', 'hanako32@example.org', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4, NULL, 0, '2023-05-05 09:01:15', '2023-05-05 09:01:15'),
(16, '吉田 零', 'sasada.yasuhiro@example.org', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4, NULL, 0, '2023-05-05 09:01:15', '2023-05-05 09:01:15'),
(17, '津田 直人', 'yui35@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4, NULL, 0, '2023-05-05 09:01:15', '2023-05-05 09:01:15'),
(18, '若松 知実', 'ryosuke27@example.net', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4, NULL, 0, '2023-05-05 09:01:15', '2023-05-05 09:01:15'),
(24, 'test', 'test@test.test', '$2y$04$HHaISzT9KrcXdKL5k86NAOou/07vbow1LbCJOTLfXKq6nINY92aTa', 4, NULL, 0, '2023-05-12 04:01:40', '2023-05-12 04:01:40');

-- --------------------------------------------------------

--
-- テーブルの構造 `users_detail`
--

CREATE TABLE `users_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL COMMENT 'ユーザーID',
  `grade` int(11) NOT NULL DEFAULT '0' COMMENT '学年',
  `class` int(11) NOT NULL DEFAULT '0' COMMENT 'クラス',
  `onething` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ひとこと',
  `imgPath` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'img/user.png' COMMENT '画像のパス',
  `tel` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '電話番号',
  `address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '住所',
  `emergency` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '緊急連絡先',
  `relationship` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '続柄',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `users_detail`
--

INSERT INTO `users_detail` (`id`, `users_id`, `grade`, `class`, `onething`, `imgPath`, `tel`, `address`, `emergency`, `relationship`, `created_at`, `updated_at`) VALUES
(1, 11, 3, 3, 'よろしくお願いします。', 'img/user.png', '0788097226', '2903302  山形県中村市中央区杉山町津田4-1-8', '0417185309', '母', '2023-05-05 09:42:03', '2023-05-05 09:42:03'),
(2, 12, 3, 2, 'よろしくお願いします。', 'img/user.png', '0483280999', '6676677  山口県田中市北区松本町中村4-8-6 ハイツ吉本103号', '09025165978', '母', '2023-05-05 09:42:03', '2023-05-05 09:42:03'),
(3, 13, 1, 2, 'よろしくお願いします。', 'img/user.png', '0732645444', '8537164  秋田県中村市西区井上町渚7-10-1 コーポ中島101号', '09066029495', '母', '2023-05-05 09:42:03', '2023-05-05 09:42:03'),
(4, 15, 3, 3, 'よろしくお願いします。', 'img/user.png', '0089735483', '2096971  岐阜県宮沢市中央区野村町山田6-6-4 コーポ山田104号', '09022942873', '母', '2023-05-05 09:42:03', '2023-05-05 09:42:03'),
(5, 16, 3, 2, 'よろしくお願いします。', 'img/user.png', '09045985267', '4214075  香川県木村市西区西之園町原田5-4-2', '0280202682', '母', '2023-05-05 09:42:03', '2023-05-05 09:42:03'),
(6, 17, 2, 2, 'よろしくお願いします。', 'img/user.png', '0585990191', '4859042  福岡県三宅市北区浜田町杉山9-6-9', '0230540900', '母', '2023-05-05 09:42:03', '2023-05-05 09:42:03'),
(7, 18, 1, 1, 'よろしくお願いします。', 'img/user.png', '0829211346', '2041156  京都府浜田市北区田中町喜嶋6-3-10 ハイツ山本101号', '09026215413', '母', '2023-05-05 09:42:03', '2023-05-05 09:42:03');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_tokens`
--

CREATE TABLE `user_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'ID',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'トークン',
  `expire_at` datetime DEFAULT NULL COMMENT 'トークンの有効期限',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `articles_id_unique` (`id`),
  ADD KEY `articles_schools_id_foreign` (`schools_id`),
  ADD KEY `articles_users_id_foreign` (`users_id`);

--
-- テーブルのインデックス `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_articles_id_foreign` (`articles_id`),
  ADD KEY `comments_users_id_foreign` (`users_id`);

--
-- テーブルのインデックス `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_users_id_foreign` (`users_id`),
  ADD KEY `likes_articles_id_foreign` (`articles_id`);

--
-- テーブルのインデックス `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_rooms_id_foreign` (`rooms_id`),
  ADD KEY `messages_users_id_foreign` (`users_id`);

--
-- テーブルのインデックス `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `room_user`
--
ALTER TABLE `room_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_user_room_id_foreign` (`room_id`),
  ADD KEY `room_user_user_id_foreign` (`user_id`);

--
-- テーブルのインデックス `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schools_id_unique` (`id`),
  ADD UNIQUE KEY `schools_code_unique` (`code`),
  ADD UNIQUE KEY `schools_name_unique` (`name`),
  ADD UNIQUE KEY `schools_address_unique` (`address`),
  ADD UNIQUE KEY `schools_tel_unique` (`tel`);

--
-- テーブルのインデックス `teachers_detail`
--
ALTER TABLE `teachers_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teachers_detail_users_id_foreign` (`users_id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_id_unique` (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_schools_id_foreign` (`schools_id`);

--
-- テーブルのインデックス `users_detail`
--
ALTER TABLE `users_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_detail_users_id_foreign` (`users_id`);

--
-- テーブルのインデックス `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_tokens_token_unique` (`token`),
  ADD KEY `user_tokens_user_id_foreign` (`user_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '学校通信ID', AUTO_INCREMENT=28;

--
-- テーブルの AUTO_INCREMENT `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'コメントID', AUTO_INCREMENT=10;

--
-- テーブルの AUTO_INCREMENT `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'いいねID', AUTO_INCREMENT=26;

--
-- テーブルの AUTO_INCREMENT `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'メッセージID', AUTO_INCREMENT=7;

--
-- テーブルの AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- テーブルの AUTO_INCREMENT `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ルームID', AUTO_INCREMENT=13;

--
-- テーブルの AUTO_INCREMENT `room_user`
--
ALTER TABLE `room_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- テーブルの AUTO_INCREMENT `schools`
--
ALTER TABLE `schools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '学校ID', AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `teachers_detail`
--
ALTER TABLE `teachers_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ユーザーID', AUTO_INCREMENT=25;

--
-- テーブルの AUTO_INCREMENT `users_detail`
--
ALTER TABLE `users_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- テーブルの AUTO_INCREMENT `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=2;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_schools_id_foreign` FOREIGN KEY (`schools_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `articles_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_articles_id_foreign` FOREIGN KEY (`articles_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_articles_id_foreign` FOREIGN KEY (`articles_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_rooms_id_foreign` FOREIGN KEY (`rooms_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `room_user`
--
ALTER TABLE `room_user`
  ADD CONSTRAINT `room_user_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `room_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `teachers_detail`
--
ALTER TABLE `teachers_detail`
  ADD CONSTRAINT `teachers_detail_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_schools_id_foreign` FOREIGN KEY (`schools_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `users_detail`
--
ALTER TABLE `users_detail`
  ADD CONSTRAINT `users_detail_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- テーブルの制約 `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD CONSTRAINT `user_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
