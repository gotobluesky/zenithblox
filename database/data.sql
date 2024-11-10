-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 01, 2023 at 04:51 AM
-- Server version: 10.5.20-MariaDB-cll-lve-log
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `themmdkg_test_cmslooks`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `batch_uuid` char(36) DEFAULT NULL,
  `ip` text DEFAULT NULL,
  `os` text DEFAULT NULL,
  `browser` text DEFAULT NULL,
  `url` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_login_activity_log`
--

CREATE TABLE `admin_login_activity_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `login_at` timestamp NULL DEFAULT NULL,
  `logout_at` timestamp NULL DEFAULT NULL,
  `ip` text DEFAULT NULL,
  `os` text DEFAULT NULL,
  `browser` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login_activity_log`
--

INSERT INTO `admin_login_activity_log` (`id`, `user_id`, `login_at`, `logout_at`, `ip`, `os`, `browser`, `created_at`, `updated_at`) VALUES
(318, 1, '2023-05-21 10:36:01', NULL, '::1', 'Linux', 'Google Chrome', '2023-05-21 10:36:01', '2023-05-21 10:36:01');

-- --------------------------------------------------------

--
-- Table structure for table `blog_share_options`
--

CREATE TABLE `blog_share_options` (
  `id` int(11) NOT NULL,
  `network` varchar(150) NOT NULL,
  `network_name` varchar(150) NOT NULL,
  `icon` text DEFAULT NULL,
  `status` int(10) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `blog_share_options`
--

INSERT INTO `blog_share_options` (`id`, `network`, `network_name`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'facebook', 'Facebook', '<i class=\"fa fa-facebook\"></i>', 1, '2021-06-22 04:08:48', '2023-05-24 05:44:06'),
(2, 'linkedin', 'LinkedIn', '<i class=\"fa fa-linkedin\"></i>', 1, '2021-06-22 05:02:37', '2023-05-24 05:44:20'),
(3, 'digg', 'Digg', '<i class=\"fa fa-digg\"></i>', 1, '2021-06-22 05:02:37', '2023-05-24 05:44:25'),
(4, 'pinterest', 'Pinterest', '<i class=\"fa fa-pinterest\"></i>', 1, '2021-06-22 05:05:56', '2021-06-22 05:05:56'),
(5, 'twitter', 'Twitter', '<i class=\"fa fa-twitter\"></i>', 1, '2021-06-22 05:05:56', '2021-06-22 05:05:56'),
(6, 'gmail', 'Gmail', '<i class=\"fa fa-google\"></i>', 1, '2021-06-22 05:05:56', '2021-06-22 05:05:56'),
(7, 'whatsapp', 'Whatsapp', '<i class=\"fa fa-whatsapp\"></i>', 1, '2021-06-22 05:05:56', '2021-06-22 05:05:56'),
(8, 'reddit', 'Reddit', '<i class=\"fa fa-reddit\"></i>', 1, '2021-06-22 05:05:56', '2021-06-22 05:05:56'),
(9, 'telegramMe', 'Telegram', '<i class=\"fa fa-telegram\"></i>', 1, '2021-06-22 05:05:56', '2023-01-05 03:29:16'),
(10, 'email', 'Email', '<i class=\"fa fa-envelope\"></i>', 1, '2021-06-23 05:48:32', '2023-01-05 03:29:22'),
(11, 'tumblr', 'Tumblr', '<i class=\"fa fa-tumblr\"></i>', 1, '2021-06-23 05:49:07', '2023-01-05 03:29:29'),
(12, 'vk', 'VKontakte', '<i class=\"fa fa-vk\"></i>', 1, '2021-06-23 05:49:07', '2023-01-05 03:29:29');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` text NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(4, 'Core\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `open_ai_settings`
--

CREATE TABLE `open_ai_settings` (
  `id` int(11) NOT NULL,
  `api_key` text DEFAULT NULL,
  `default_model` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `open_ai_settings`
--

INSERT INTO `open_ai_settings` (`id`, `api_key`, `default_model`) VALUES
(1, NULL, 'text-davinci-003');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `module_id` int(11) NOT NULL DEFAULT 0,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `module_id`, `guard_name`, `created_at`, `updated_at`) VALUES
(3, 'Create Role', 1, 'web', '2022-06-01 03:36:18', '2022-06-01 03:36:18'),
(4, 'Edit Role', 1, 'web', '2022-06-01 03:36:26', '2022-06-01 03:36:26'),
(5, 'Delete Role', 1, 'web', '2022-06-01 03:36:28', '2022-06-01 03:41:47'),
(10, 'Show Role', 1, 'web', '2023-01-15 00:09:02', '2023-01-15 00:41:11'),
(11, 'Create User', 2, 'web', '2023-01-15 00:09:31', '2023-01-15 00:09:31'),
(12, 'Edit User', 2, 'web', '2023-01-15 00:09:47', '2023-01-15 00:09:47'),
(13, 'Delete User', 2, 'web', '2023-01-15 00:09:55', '2023-01-15 00:09:55'),
(14, 'Show User', 2, 'web', '2023-01-15 00:10:03', '2023-01-15 00:10:03'),
(15, 'Show Permission', 3, 'web', '2023-01-15 00:41:27', '2023-01-15 00:41:35'),
(17, 'Manage Menus', 8, 'web', '2023-01-17 05:18:11', '2023-01-17 05:18:11'),
(18, 'Manage Media', 5, 'web', '2023-01-15 02:09:20', '2023-01-15 02:09:20'),
(20, 'Manage Themes', 9, 'web', '2023-01-17 05:21:51', '2023-01-17 05:21:51'),
(25, 'Create Blog', 19, 'web', '2023-01-17 22:04:30', '2023-01-17 22:04:30'),
(26, 'Show Blog', 19, 'web', '2023-01-17 22:05:43', '2023-01-17 22:05:43'),
(27, 'Edit Blog', 19, 'web', '2023-01-17 22:06:31', '2023-01-17 22:06:31'),
(28, 'Delete Blog', 19, 'web', '2023-01-17 22:06:46', '2023-01-17 22:06:46'),
(29, 'Manage Category', 20, 'web', '2023-01-17 22:07:25', '2023-01-17 22:07:25'),
(30, 'Manage Tag', 21, 'web', '2023-01-17 22:07:44', '2023-01-17 22:07:44'),
(31, 'Manage Comment', 22, 'web', '2023-01-17 22:08:21', '2023-01-17 22:08:21'),
(32, 'Create Page', 23, 'web', '2023-01-17 22:16:45', '2023-01-17 22:16:45'),
(33, 'Show Page', 23, 'web', '2023-01-17 22:17:26', '2023-01-17 22:17:26'),
(34, 'Edit Page', 23, 'web', '2023-01-17 22:17:44', '2023-01-17 22:17:44'),
(35, 'Delete Page', 23, 'web', '2023-01-17 22:18:03', '2023-01-17 22:18:03'),
(36, 'Manage Widget', 24, 'web', '2023-01-19 05:46:41', '2023-01-19 05:46:41'),
(41, 'Manage Dashboard', 28, 'web', '2023-01-25 22:53:11', '2023-01-25 22:53:11'),
(43, 'Manage Home Page Builder', 30, 'web', '2023-01-25 23:27:20', '2023-01-25 23:27:20'),
(46, 'Manage General Settings', 33, 'web', '2023-01-25 23:53:23', '2023-01-25 23:53:23'),
(47, 'Manage Email Settings', 34, 'web', '2023-01-25 23:54:26', '2023-01-25 23:54:26'),
(48, 'Manage Email Templates', 35, 'web', '2023-01-25 23:55:17', '2023-01-25 23:55:17'),
(49, 'Manage Language', 36, 'web', '2023-01-25 23:56:03', '2023-01-25 23:56:03'),
(50, 'Manage Media Settings', 37, 'web', '2023-01-25 23:56:31', '2023-01-25 23:56:31'),
(51, 'Manage Seo Settings', 38, 'web', '2023-01-25 23:57:09', '2023-01-25 23:57:09'),
(72, 'Manage Login activity', 57, 'web', '2023-01-27 23:33:54', '2023-01-27 23:33:54'),
(104, 'Manage Theme General settings', 29, 'web', '2023-01-25 23:53:23', '2023-01-25 23:53:23');

-- --------------------------------------------------------

--
-- Table structure for table `permission_module`
--

CREATE TABLE `permission_module` (
  `id` int(11) NOT NULL,
  `parent_module` varchar(510) DEFAULT NULL,
  `module_name` varchar(150) DEFAULT NULL,
  `module_type` varchar(150) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permission_module`
--

INSERT INTO `permission_module` (`id`, `parent_module`, `module_name`, `module_type`, `location`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Users', 'Role', 'base', NULL, 20, '2023-01-15 09:41:37', '2023-01-29 04:29:56'),
(2, 'Users', 'User', 'base', NULL, 20, '2023-01-15 09:41:43', '2023-01-29 04:29:58'),
(3, 'Users', 'Permission', 'base', NULL, 20, '2023-01-15 09:41:50', '2023-01-29 04:30:00'),
(5, 'Media', 'Media', 'base', NULL, 2, '2023-01-15 09:42:20', '2023-01-29 04:24:38'),
(8, 'Appearences', 'Menus', 'base', NULL, 15, '2023-01-17 05:18:11', '2023-01-29 04:28:34'),
(9, 'Appearences', 'Themes', 'base', NULL, 15, '2023-01-17 05:21:51', '2023-01-29 04:28:37'),
(19, 'Blogs', 'Blog', 'base', NULL, 3, '2023-01-17 22:04:30', '2023-01-29 04:24:46'),
(20, 'Blogs', 'Category', 'base', NULL, 3, '2023-01-17 22:07:25', '2023-01-29 04:24:48'),
(21, 'Blogs', 'Tag', 'base', NULL, 3, '2023-01-17 22:07:44', '2023-01-29 04:24:49'),
(22, 'Blogs', 'Comment', 'base', NULL, 3, '2023-01-17 22:08:21', '2023-01-29 04:24:50'),
(23, 'Pages', 'Page', 'base', NULL, 4, '2023-01-17 22:16:45', '2023-01-29 04:24:59'),
(24, 'Theme Options', 'Widget', 'theme', 'default', 16, '2023-01-19 05:46:41', '2023-05-02 06:02:00'),
(28, 'Dashboard', 'Dashboard', 'base', NULL, 1, '2023-01-25 22:53:11', '2023-01-29 04:24:07'),
(29, 'Theme Options', 'Theme General settings', 'theme', 'default', 17, '2023-01-25 23:26:36', '2023-05-02 05:40:38'),
(30, 'Theme Options', 'Home Page Builder', 'theme', 'default', 17, '2023-01-25 23:27:20', '2023-05-02 05:40:46'),
(33, 'Settings', 'General settings', 'base', NULL, 19, '2023-01-25 23:53:23', '2023-01-29 04:29:34'),
(34, 'Settings', 'Email Settings', 'base', NULL, 19, '2023-01-25 23:54:26', '2023-01-29 04:29:36'),
(35, 'Settings', 'Email Templates', 'base', NULL, 19, '2023-01-25 23:55:17', '2023-01-29 04:29:38'),
(36, 'Settings', 'Language', 'base', NULL, 19, '2023-01-25 23:56:03', '2023-01-29 04:29:40'),
(37, 'Settings', 'Media Settings', 'base', NULL, 19, '2023-01-25 23:56:31', '2023-01-29 04:29:43'),
(38, 'Settings', 'SEO Settings', 'base', NULL, 19, '2023-01-25 23:57:09', '2023-01-29 04:29:45'),
(57, 'Activity Logs', 'Login activity', 'base', NULL, 21, '2023-01-27 23:33:54', '2023-01-29 04:30:10');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2022-06-06 02:07:19', '2023-01-30 05:36:19'),
(4, 'Demo Admin', 'web', '2023-02-16 21:23:22', '2023-02-16 21:23:22');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(3, 4),
(4, 4),
(5, 4),
(10, 4),
(11, 4),
(12, 4),
(13, 4),
(14, 4),
(15, 4),
(17, 4),
(18, 4),
(20, 4),
(25, 4),
(26, 4),
(27, 4),
(28, 4),
(29, 4),
(30, 4),
(31, 4),
(32, 4),
(33, 4),
(34, 4),
(35, 4),
(36, 4),
(41, 4),
(43, 4),
(46, 4),
(47, 4),
(48, 4),
(49, 4),
(50, 4),
(51, 4),
(72, 4),
(104, 4);

-- --------------------------------------------------------

--
-- Table structure for table `timezones`
--

CREATE TABLE `timezones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `offset` varchar(255) NOT NULL,
  `diff_from_gtm` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tl_blogs`
--

CREATE TABLE `tl_blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(225) DEFAULT NULL,
  `permalink` text DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `image` text DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `reading_time` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `visibility` text DEFAULT NULL,
  `is_sticky` smallint(2) DEFAULT NULL,
  `blog_password` longtext DEFAULT NULL,
  `views` bigint(20) NOT NULL DEFAULT 0,
  `publish_at` datetime DEFAULT NULL,
  `is_featured` smallint(6) DEFAULT NULL,
  `is_publish` smallint(6) DEFAULT NULL,
  `formate` varchar(50) NOT NULL DEFAULT 'standard',
  `gallery_images` text DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_image` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tl_blogs`
--

INSERT INTO `tl_blogs` (`id`, `name`, `permalink`, `user_id`, `image`, `short_description`, `reading_time`, `content`, `visibility`, `is_sticky`, `blog_password`, `views`, `publish_at`, `is_featured`, `is_publish`, `formate`, `gallery_images`, `meta_title`, `meta_description`, `meta_image`, `created_at`, `updated_at`) VALUES
(161, '12 Fruits and Vegetables to Buy Organic in 2023', '12-fruits-and-vegetables-to-buy-organic-in-2023', 1, '1039', 'She travelling acceptance men unpleasant her especially to entreaties law. Law forth but end any arise chief arose. Old her say learn these large. Joy fond many in ham high seen this. Few preferred continual led incommode neglected. To discovered insensible collecting your unpleasant but invitation.', '2 min read', '<div class=\"post-content-cover my-drop-cap\" style=\"list-style: none; color: rgb(33, 37, 41); font-family: Quicksand, sans-serif; font-size: 16px;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">She travelling acceptance men unpleasant her especially to entreaties law. Law forth but end any arise chief arose. Old her say learn these large. Joy fond many in ham high seen this. Few preferred continual led incommode neglected. To discovered insensible collecting your unpleasant but invitation.</p><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">We diminution preference thoroughly if. Joy deal pain view much too her time. Led young gay would now state. Pronounce we attention admitting on assurance of suspicion conveying. That his west quit had met till. By an outlived insisted procured improved am.</p><div class=\"post-my-gallery-images\" style=\"list-style: none; padding-top: 20px;\"><h3 style=\"list-style: none; margin-bottom: 30px; line-height: 1.2; font-family: Spectral, serif; color: rgb(35, 35, 35);\">The Best Neighborhoods In Nyc: Where To Stay On</h3>\r\n<div class=\"row\" style=\"list-style: none;\">\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n\r\n</div>\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n\r\n</div>\r\n<div class=\"col-md-12\" style=\"list-style: none; width: 760px;\">\r\n\r\n</div>\r\n</div>\r\n</div>\r\n<p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">We diminution preference thoroughly if. Joy deal pain view much her time. Led young gay would now off state. Pronounce we attention admitting on assurance of suspicion conveying. That his west quit had met till. Say out plate you share.</p><blockquote style=\"list-style: none; padding: 40px;  border-left: 2px solid rgb(255, 113, 113); position: relative; z-index: 9;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; font-family: Spectral, serif; color: rgb(35, 35, 35); line-height: 1.66; font-style: italic; font-size: 26px; z-index: 9;\">For me, running is both exercise and a metaphor. Running day after day, piling up each level I elevate myself.</p><cite style=\"list-style: none; font-style: normal; color: rgb(127, 127, 127);\">Haruki Murakami</cite></blockquote><p style=\"list-style: none; margin-bottom: 20px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">Acceptance middletons me if discretion boisterous into travelling an. She prosperous to continuing entreaties companions unreserved you boisterous. Middleton sportsmen sir now cordially asking additions for. You ten occasional saw everything but conviction. Daughter returned quitting few are day advanced branched.</p><div><br></div></div>', 'public', 0, NULL, 12, '2023-02-08 11:08:56', 1, 1, 'standard', NULL, '12 Fruits and Vegetables to Buy Organic in 2023', '12 Fruits and Vegetables to Buy Organic in 2023', NULL, '2023-02-08 16:08:56', '2023-06-01 18:50:15'),
(162, 'Beautiful Flower Seed Sources', 'beautiful-flower-seed-sources', 1, '1039', 'She travelling acceptance men unpleasant her especially to entreaties law. Law forth but end any arise chief arose. Old her say learn these large. Joy fond many in ham high seen this. Few preferred continual led incommode neglected. To discovered insensible collecting your unpleasant but invitation.', '2 min read', '<div class=\"post-content-cover my-drop-cap\" style=\"list-style: none; color: rgb(33, 37, 41); font-family: Quicksand, sans-serif; font-size: 16px;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">She travelling acceptance men unpleasant her especially to entreaties law. Law forth but end any arise chief arose. Old her say learn these large. Joy fond many in ham high seen this. Few preferred continual led incommode neglected. To discovered insensible collecting your unpleasant but invitation.</p><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">We diminution preference thoroughly if. Joy deal pain view much too her time. Led young gay would now state. Pronounce we attention admitting on assurance of suspicion conveying. That his west quit had met till. By an outlived insisted procured improved am.</p><div class=\"post-my-gallery-images\" style=\"list-style: none; padding-top: 20px;\"><h3 style=\"list-style: none; margin-bottom: 30px; line-height: 1.2; font-family: Spectral, serif; color: rgb(35, 35, 35);\">The Best Neighborhoods In Nyc: Where To Stay On</h3>\r\n<div class=\"row\" style=\"list-style: none;\">\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n\r\n</div>\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n\r\n</div>\r\n<div class=\"col-md-12\" style=\"list-style: none; width: 760px;\">\r\n\r\n</div>\r\n</div>\r\n</div>\r\n<p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">We diminution preference thoroughly if. Joy deal pain view much her time. Led young gay would now off state. Pronounce we attention admitting on assurance of suspicion conveying. That his west quit had met till. Say out plate you share.</p><blockquote style=\"list-style: none; padding: 40px;  border-left: 2px solid rgb(255, 113, 113); position: relative; z-index: 9;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; font-family: Spectral, serif; color: rgb(35, 35, 35); line-height: 1.66; font-style: italic; font-size: 26px; z-index: 9;\">For me, running is both exercise and a metaphor. Running day after day, piling up each level I elevate myself.</p><cite style=\"list-style: none; font-style: normal; color: rgb(127, 127, 127);\">Haruki Murakami</cite></blockquote><p style=\"list-style: none; margin-bottom: 20px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">Acceptance middletons me if discretion boisterous into travelling an. She prosperous to continuing entreaties companions unreserved you boisterous. Middleton sportsmen sir now cordially asking additions for. You ten occasional saw everything but conviction. Daughter returned quitting few are day advanced branched.</p><div><br></div></div>', 'public', 0, NULL, 2, '2023-02-08 11:15:16', NULL, 1, 'standard', NULL, 'Beautiful Flower Seed Sources', 'Beautiful Flower Seed Sources', NULL, '2023-02-08 16:15:16', '2023-06-01 18:49:54'),
(163, 'Best Places To Visit in The World', 'best-places-to-visit-in-the-world', 1, '1039', 'She travelling acceptance men unpleasant her especially to entreaties law. Law forth but end any arise chief arose. Old her say learn these large. Joy fond many in ham high seen this. Few preferred continual led incommode neglected. To discovered insensible collecting your unpleasant but invitation.', '2 min read', '<div class=\"post-content-cover my-drop-cap\" style=\"list-style: none; color: rgb(33, 37, 41); font-family: Quicksand, sans-serif; font-size: 16px;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">She travelling acceptance men unpleasant her especially to entreaties law. Law forth but end any arise chief arose. Old her say learn these large. Joy fond many in ham high seen this. Few preferred continual led incommode neglected. To discovered insensible collecting your unpleasant but invitation.</p><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">We diminution preference thoroughly if. Joy deal pain view much too her time. Led young gay would now state. Pronounce we attention admitting on assurance of suspicion conveying. That his west quit had met till. By an outlived insisted procured improved am.</p><div class=\"post-my-gallery-images\" style=\"list-style: none; padding-top: 20px;\"><h3 style=\"list-style: none; margin-bottom: 30px; line-height: 1.2; font-family: Spectral, serif; color: rgb(35, 35, 35);\">The Best Neighborhoods In Nyc: Where To Stay On</h3>\r\n<div class=\"row\" style=\"list-style: none;\">\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n\r\n</div>\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n\r\n</div>\r\n<div class=\"col-md-12\" style=\"list-style: none; width: 760px;\">\r\n\r\n</div>\r\n</div>\r\n</div>\r\n<p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">We diminution preference thoroughly if. Joy deal pain view much her time. Led young gay would now off state. Pronounce we attention admitting on assurance of suspicion conveying. That his west quit had met till. Say out plate you share.</p><blockquote style=\"list-style: none; padding: 40px;  border-left: 2px solid rgb(255, 113, 113); position: relative; z-index: 9;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; font-family: Spectral, serif; color: rgb(35, 35, 35); line-height: 1.66; font-style: italic; font-size: 26px; z-index: 9;\">For me, running is both exercise and a metaphor. Running day after day, piling up each level I elevate myself.</p><cite style=\"list-style: none; font-style: normal; color: rgb(127, 127, 127);\">Haruki Murakami</cite></blockquote><p style=\"list-style: none; margin-bottom: 20px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">Acceptance middletons me if discretion boisterous into travelling an. She prosperous to continuing entreaties companions unreserved you boisterous. Middleton sportsmen sir now cordially asking additions for. You ten occasional saw everything but conviction. Daughter returned quitting few are day advanced branched.</p><div><br></div></div>', 'public', 0, NULL, 7, '2023-02-08 11:57:01', 1, 1, 'standard', NULL, 'Best Places to Visit in the World', 'Best Places to Visit in the World', NULL, '2023-02-08 16:57:01', '2023-06-01 18:49:35'),
(165, 'Best food to buy in online stores.', 'best-food-to-buy-in-online-stores', 1, '1039', 'She travelling acceptance men unpleasant her especially to entreaties law. Law forth but end any arise chief arose. Old her say learn these large. Joy fond many in ham high seen this. Few preferred continual led incommode neglected. To discovered insensible collecting your unpleasant but invitation.', '2 min read', '<div class=\"post-content-cover my-drop-cap\" style=\"list-style: none; color: rgb(33, 37, 41); font-family: Quicksand, sans-serif; font-size: 16px;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">She travelling acceptance men unpleasant her especially to entreaties law. Law forth but end any arise chief arose. Old her say learn these large. Joy fond many in ham high seen this. Few preferred continual led incommode neglected. To discovered insensible collecting your unpleasant but invitation.</p><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">We diminution preference thoroughly if. Joy deal pain view much too her time. Led young gay would now state. Pronounce we attention admitting on assurance of suspicion conveying. That his west quit had met till. By an outlived insisted procured improved am.</p><div class=\"post-my-gallery-images\" style=\"list-style: none; padding-top: 20px;\"><h3 style=\"list-style: none; margin-bottom: 30px; line-height: 1.2; font-family: Spectral, serif; color: rgb(35, 35, 35);\">The Best Neighborhoods In Nyc: Where To Stay On</h3>\r\n<div class=\"row\" style=\"list-style: none;\">\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n\r\n</div>\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n\r\n</div>\r\n<div class=\"col-md-12\" style=\"list-style: none; width: 760px;\">\r\n\r\n</div>\r\n</div>\r\n</div>\r\n<p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">We diminution preference thoroughly if. Joy deal pain view much her time. Led young gay would now off state. Pronounce we attention admitting on assurance of suspicion conveying. That his west quit had met till. Say out plate you share.</p><blockquote style=\"list-style: none; padding: 40px;  border-left: 2px solid rgb(255, 113, 113); position: relative; z-index: 9;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; font-family: Spectral, serif; color: rgb(35, 35, 35); line-height: 1.66; font-style: italic; font-size: 26px; z-index: 9;\">For me, running is both exercise and a metaphor. Running day after day, piling up each level I elevate myself.</p><cite style=\"list-style: none; font-style: normal; color: rgb(127, 127, 127);\">Haruki Murakami</cite></blockquote><p style=\"list-style: none; margin-bottom: 20px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">Acceptance middletons me if discretion boisterous into travelling an. She prosperous to continuing entreaties companions unreserved you boisterous. Middleton sportsmen sir now cordially asking additions for. You ten occasional saw everything but conviction. Daughter returned quitting few are day advanced branched.</p><div><br></div></div>', 'public', 0, NULL, 6, '2023-02-08 12:38:16', 1, 1, 'standard', NULL, 'Best food to buy in online stores.', 'Best food to buy in online stores.', NULL, '2023-02-08 17:38:16', '2023-06-01 18:49:07'),
(166, 'Best Halloween Custom You Can Buy Online', 'best-halloween-custom-you-can-buy-online', 1, '1039', 'She travelling acceptance men unpleasant her especially to entreaties law. Law forth but end any arise chief arose. Old her say learn these large. Joy fond many in ham high seen this. Few preferred continual led incommode neglected. To discovered insensible collecting your unpleasant but invitation.', '2 min read', '<div class=\"post-content-cover my-drop-cap\" style=\"list-style: none; color: rgb(33, 37, 41); font-family: Quicksand, sans-serif; font-size: 16px;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">She travelling acceptance men unpleasant her especially to entreaties law. Law forth but end any arise chief arose. Old her say learn these large. Joy fond many in ham high seen this. Few preferred continual led incommode neglected. To discovered insensible collecting your unpleasant but invitation.</p><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">We diminution preference thoroughly if. Joy deal pain view much too her time. Led young gay would now state. Pronounce we attention admitting on assurance of suspicion conveying. That his west quit had met till. By an outlived insisted procured improved am.</p><div class=\"post-my-gallery-images\" style=\"list-style: none; padding-top: 20px;\"><h3 style=\"list-style: none; margin-bottom: 30px; line-height: 1.2; font-family: Spectral, serif; color: rgb(35, 35, 35);\">The Best Neighborhoods In Nyc: Where To Stay On</h3>\r\n<div class=\"row\" style=\"list-style: none;\">\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n\r\n</div>\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n\r\n</div>\r\n<div class=\"col-md-12\" style=\"list-style: none; width: 760px;\">\r\n\r\n</div>\r\n</div>\r\n</div>\r\n<p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">We diminution preference thoroughly if. Joy deal pain view much her time. Led young gay would now off state. Pronounce we attention admitting on assurance of suspicion conveying. That his west quit had met till. Say out plate you share.</p><blockquote style=\"list-style: none; padding: 40px;  border-left: 2px solid rgb(255, 113, 113); position: relative; z-index: 9;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; font-family: Spectral, serif; color: rgb(35, 35, 35); line-height: 1.66; font-style: italic; font-size: 26px; z-index: 9;\">For me, running is both exercise and a metaphor. Running day after day, piling up each level I elevate myself.</p><cite style=\"list-style: none; font-style: normal; color: rgb(127, 127, 127);\">Haruki Murakami</cite></blockquote><p style=\"list-style: none; margin-bottom: 20px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">Acceptance middletons me if discretion boisterous into travelling an. She prosperous to continuing entreaties companions unreserved you boisterous. Middleton sportsmen sir now cordially asking additions for. You ten occasional saw everything but conviction. Daughter returned quitting few are day advanced branched.</p><div><br></div></div>', 'public', 0, NULL, 47, '2023-02-08 12:41:33', NULL, 1, 'standard', NULL, 'Best Halloween Custom You Can Buy', 'Best Halloween Custom You Can Buy', NULL, '2023-02-08 17:41:33', '2023-06-01 18:48:44'),
(178, 'The One Thing I Do When Fashion Come Over', 'the-one-thing-i-do-when-fashion-come-over', 1, '1039', 'She travelling acceptance men unpleasant her especially to entreaties law. Law forth but end any arise chief arose. Old her say learn these large. Joy fond many in ham high seen this. Few preferred continual led incommode neglected. To discovered insensible', '2 min read', '<div class=\"post-content-cover my-drop-cap\" style=\"list-style: none; color: rgb(33, 37, 41); font-family: Quicksand, sans-serif; font-size: 16px;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">She travelling acceptance men unpleasant her especially to entreaties law. Law forth but end any arise chief arose. Old her say learn these large. Joy fond many in ham high seen this. Few preferred continual led incommode neglected. To discovered insensible collecting your unpleasant but invitation.</p><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">We diminution preference thoroughly if. Joy deal pain view much too her time. Led young gay would now state. Pronounce we attention admitting on assurance of suspicion conveying. That his west quit had met till. By an outlived insisted procured improved am.</p><div class=\"post-my-gallery-images\" style=\"list-style: none; padding-top: 20px;\"><h3 style=\"list-style: none; margin-bottom: 30px; line-height: 1.2; font-family: Spectral, serif; color: rgb(35, 35, 35);\">The Best Neighborhoods In Nyc: Where To Stay On</h3>\r\n<div class=\"row\" style=\"list-style: none;\">\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n\r\n</div>\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n\r\n</div>\r\n<div class=\"col-md-12\" style=\"list-style: none; width: 760px;\">\r\n\r\n</div>\r\n</div>\r\n</div>\r\n<p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">We diminution preference thoroughly if. Joy deal pain view much her time. Led young gay would now off state. Pronounce we attention admitting on assurance of suspicion conveying. That his west quit had met till. Say out plate you share.</p><blockquote style=\"list-style: none; padding: 40px;  border-left: 2px solid rgb(255, 113, 113); position: relative; z-index: 9;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; font-family: Spectral, serif; color: rgb(35, 35, 35); line-height: 1.66; font-style: italic; font-size: 26px; z-index: 9;\">For me, running is both exercise and a metaphor. Running day after day, piling up each level I elevate myself.</p><cite style=\"list-style: none; font-style: normal; color: rgb(127, 127, 127);\">Haruki Murakami</cite></blockquote><p style=\"list-style: none; margin-bottom: 20px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">Acceptance middletons me if discretion boisterous into travelling an. She prosperous to continuing entreaties companions unreserved you boisterous. Middleton sportsmen sir now cordially asking additions for. You ten occasional saw everything but conviction. Daughter returned quitting few are day advanced branched.</p><div><br></div></div>', 'public', 0, NULL, 11, '2023-04-08 15:03:39', 1, 1, 'standard', NULL, 'The One Thing I Do When Fashion Come Over', 'The One Thing I Do When Fashion Come Over', NULL, '2023-04-08 09:03:39', '2023-06-01 18:48:27');

-- --------------------------------------------------------

--
-- Table structure for table `tl_blogs_categories`
--

CREATE TABLE `tl_blogs_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tl_blogs_categories`
--

INSERT INTO `tl_blogs_categories` (`id`, `blog_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1073, 178, 280, NULL, NULL),
(1074, 178, 274, NULL, NULL),
(1075, 166, 274, NULL, NULL),
(1076, 165, 275, NULL, NULL),
(1077, 163, 280, NULL, NULL),
(1078, 162, 279, NULL, NULL),
(1079, 161, 278, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tl_blogs_tags`
--

CREATE TABLE `tl_blogs_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tl_blogs_tags`
--

INSERT INTO `tl_blogs_tags` (`id`, `blog_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(148, 161, 106, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tl_blog_categories`
--

CREATE TABLE `tl_blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `permalink` text DEFAULT NULL,
  `parent` bigint(20) UNSIGNED DEFAULT NULL,
  `banner` text DEFAULT NULL,
  `icon` text DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `meta_title` varchar(50) DEFAULT NULL,
  `meta_image` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `is_featured` int(3) DEFAULT NULL,
  `is_publish` int(3) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_blog_categories`
--

INSERT INTO `tl_blog_categories` (`id`, `name`, `permalink`, `parent`, `banner`, `icon`, `short_description`, `meta_title`, `meta_image`, `meta_description`, `is_featured`, `is_publish`, `created_at`, `updated_at`) VALUES
(274, 'Fashion', 'fashion', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-02-07 22:43:59', '2023-02-07 22:43:59'),
(275, 'E-commerce', 'e-commerce', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-02-07 23:17:49', '2023-02-07 23:17:49'),
(278, 'Groccery', 'groccery', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-02-08 16:03:31', '2023-02-08 16:03:31'),
(279, 'Flower', 'flower', NULL, NULL, NULL, NULL, 'Flower', '810', 'Flower is very nice', NULL, 1, '2023-02-08 16:10:05', '2023-04-03 08:18:33'),
(280, 'Travel', 'travel', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-02-08 16:34:16', '2023-02-13 17:24:03'),
(285, 'Uncategorized', 'uncategorized', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-03-27 03:44:07', '2023-03-27 03:44:07');

-- --------------------------------------------------------

--
-- Table structure for table `tl_blog_category_translations`
--

CREATE TABLE `tl_blog_category_translations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_description` text DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lang` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tl_blog_category_translations`
--

INSERT INTO `tl_blog_category_translations` (`id`, `name`, `short_description`, `category_id`, `lang`, `created_at`, `updated_at`) VALUES
(1, 'ফ্যাশন', NULL, 274, 'bd', '2023-02-11 20:49:20', '2023-02-11 20:49:20'),
(2, 'موضة', NULL, 274, 'sa', '2023-02-11 20:49:33', '2023-02-11 20:49:33'),
(3, 'التجارة الإلكترونية', NULL, 275, 'sa', '2023-02-11 20:50:02', '2023-02-11 20:50:02'),
(4, 'ই-কমার্স', NULL, 275, 'bd', '2023-02-11 20:50:17', '2023-02-11 20:50:17'),
(9, 'মুদিখানা', NULL, 278, 'bd', '2023-02-11 20:51:59', '2023-02-11 20:51:59'),
(10, 'خضروات', NULL, 278, 'sa', '2023-02-11 20:52:10', '2023-02-11 20:52:10'),
(11, 'ورد', NULL, 279, 'sa', '2023-02-11 20:52:31', '2023-02-11 20:52:31'),
(12, 'ফুল', NULL, 279, 'bd', '2023-02-11 20:52:39', '2023-02-11 20:52:39'),
(13, 'ভ্রমণ', NULL, 280, 'bd', '2023-02-11 20:53:00', '2023-02-11 20:53:00'),
(14, 'يسافر', NULL, 280, 'sa', '2023-02-11 20:54:10', '2023-02-11 20:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `tl_blog_comments`
--

CREATE TABLE `tl_blog_comments` (
  `id` bigint(20) NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(50) DEFAULT NULL,
  `user_id` int(6) DEFAULT NULL,
  `user_ip_address` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(150) DEFAULT NULL,
  `user_website` varchar(255) DEFAULT NULL,
  `comment` longtext NOT NULL,
  `parent` bigint(20) DEFAULT NULL,
  `status` tinyint(3) DEFAULT 2,
  `previous_status` tinyint(3) DEFAULT NULL,
  `comment_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tl_blog_tags`
--

CREATE TABLE `tl_blog_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `permalink` text DEFAULT NULL,
  `meta_title` varchar(50) DEFAULT NULL,
  `meta_image` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `is_publish` int(3) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_blog_tags`
--

INSERT INTO `tl_blog_tags` (`id`, `name`, `permalink`, `meta_title`, `meta_image`, `meta_description`, `is_publish`, `created_at`, `updated_at`) VALUES
(106, 'vegetables', 'vegetables', NULL, NULL, NULL, 1, '2023-02-08 21:31:11', '2023-02-08 21:31:11'),
(107, 'google', 'google', NULL, NULL, NULL, 1, '2023-02-08 21:32:03', '2023-02-08 21:32:03'),
(108, 'e-commerce', 'e-commerce', NULL, NULL, NULL, 1, '2023-02-08 21:32:26', '2023-02-08 21:32:26'),
(109, 'youtube', 'youtube', NULL, NULL, NULL, 1, '2023-02-08 21:32:34', '2023-02-08 21:32:34'),
(110, 't-shirt', 't-shirt', NULL, NULL, NULL, 1, '2023-02-08 21:33:06', '2023-03-27 22:15:31');

-- --------------------------------------------------------

--
-- Table structure for table `tl_blog_tag_translations`
--

CREATE TABLE `tl_blog_tag_translations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tag_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lang` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tl_blog_tag_translations`
--

INSERT INTO `tl_blog_tag_translations` (`id`, `name`, `tag_id`, `lang`, `created_at`, `updated_at`) VALUES
(19, 'خضروات', 106, 'sa', '2023-02-11 21:09:07', '2023-02-11 21:09:07'),
(20, 'সবজি', 106, 'bd', '2023-02-11 21:09:16', '2023-02-11 21:09:16'),
(21, 'গুগল', 107, 'bd', '2023-02-11 21:09:31', '2023-02-11 21:09:31'),
(22, 'جوجل', 107, 'sa', '2023-02-11 21:09:40', '2023-02-11 21:09:40'),
(23, 'التجارة الإلكترونية', 108, 'sa', '2023-02-11 21:09:53', '2023-02-11 21:09:53'),
(24, 'ই-কমার্স', 108, 'bd', '2023-02-11 21:10:03', '2023-02-11 21:10:03'),
(25, 'ইউটিউব', 109, 'bd', '2023-02-11 21:10:14', '2023-02-11 21:10:14'),
(26, 'موقع', 109, 'sa', '2023-02-11 21:10:28', '2023-02-11 21:10:28'),
(27, 'تي شيرت', 110, 'sa', '2023-02-11 21:10:40', '2023-02-11 21:10:40'),
(28, 'টি-শার্ট', 110, 'bd', '2023-02-11 21:10:49', '2023-02-11 21:10:49');

-- --------------------------------------------------------

--
-- Table structure for table `tl_blog_translations`
--

CREATE TABLE `tl_blog_translations` (
  `id` bigint(20) NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `lang` varchar(150) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_blog_translations`
--

INSERT INTO `tl_blog_translations` (`id`, `blog_id`, `lang`, `name`, `short_description`, `content`, `created_at`, `updated_at`) VALUES
(7, 161, 'sa', '12 فاكهة وخضروات يمكن شراؤها عضويًا في عام 2023', '12 فاكهة وخضروات يمكن شراؤها عضويًا في عام 2023', '<div class=\"post-content-cover my-drop-cap\" style=\"list-style: none; color: rgb(33, 37, 41); font-family: Quicksand, sans-serif; font-size: 16px;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">إنها تسافر بقبول الرجال يزعجها خاصة لتوسلات القانون. القانون ولكن النهاية نشأت أي رئيس. عجوزها تقول تعلم هذه كبيرة. فرح مغرمًا بالعديد من لحم الخنزير عاليًا شهد هذا. قلة يفضلون إهمال الصمام المستمر. لاكتشاف جمع الدعوات غير السارة الخاصة بك.</p><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">نحن تقليص التفضيل بدقة إذا. فرح صفقة الألم نظر الكثير من وقتها. سيقول مثلي الجنس بقيادة الشباب الآن. نلفظ أننا نعترف بالاهتمام بتأكيد نقل الشك. أن استقالته الغربية قد اجتمعت حتى. من قبل أصر عفا عليها الزمن تم شراؤها وتحسينها صباحا.</p><div class=\"post-my-gallery-images\" style=\"list-style: none; padding-top: 20px;\"><h3 style=\"list-style: none; margin-bottom: 30px; line-height: 1.2; font-family: Spectral, serif; color: rgb(35, 35, 35);\">أفضل الأحياء في مدينة نيويورك: أين تقيم</h3>\r\n<div class=\"row\" style=\"list-style: none;\">\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image1675849227743775408.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image1675849244526219432.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n<div class=\"col-md-12\" style=\"list-style: none; width: 760px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image16758502992121276318.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n</div>\r\n</div>\r\n<p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">نحن تقليص التفضيل بدقة إذا. تتعامل الفرح مع الألم بنظرة وقتها. قاد الشباب مثلي الجنس الآن خارج الدولة. نلفظ أننا نعترف بالاهتمام بتأكيد نقل الشك. أن استقالته الغربية قد اجتمعت حتى. قل لوحة تشاركها.</p><blockquote style=\"list-style: none; padding: 40px;  border-left: 2px solid rgb(255, 113, 113); position: relative; z-index: 9;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; font-family: Spectral, serif; color: rgb(35, 35, 35); line-height: 1.66; font-style: italic; font-size: 26px; z-index: 9;\">بالنسبة لي ، الجري هو تمرين واستعارة. أركض يومًا بعد يوم ، وأتراكم في كل مستوى أرتقي به.</p><cite style=\"list-style: none; font-style: normal; color: rgb(127, 127, 127);\">هاروكي موراكامي</cite></blockquote><p style=\"list-style: none; margin-bottom: 20px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">قبول لي إذا كان تقديرا صاخبا في السفر. انها مزدهرة لمواصلة توسلات الصحابة دون تحفظ لكم صاخب. الرياضيين في ميدلتون يطلبون الآن بحرارة إضافات. كنتم عشرة من حين لآخر رأوا كل شيء ما عدا الاقتناع. عادت ابنة قليلة الإقلاع عن التدخين متفرعة اليوم متقدمًا.</p><div><br></div></div>', '2023-02-11 20:12:20', '2023-02-11 20:12:20'),
(8, 161, 'bd', '2023 সালে জৈব কেনার জন্য 12টি ফল ও সবজি', '2023 সালে জৈব কেনার জন্য 12টি ফল ও সবজি', '<div class=\"post-content-cover my-drop-cap\" style=\"list-style: none; color: rgb(33, 37, 41); font-family: Quicksand, sans-serif; font-size: 16px;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">তিনি বিশেষ করে entreaties আইন অপ্রীতিকর পুরুষদের গ্রহণযোগ্যতা ভ্রমণ. আইনের অগ্রগতি কিন্তু শেষ পর্যন্ত কোন প্রধান উত্থাপিত হয়. বুড়ো বলে এইসব বড় শেখো। হ্যাম হাই এ জয় অনেকেরই পছন্দ হয়েছে এটা দেখে। কিছু পছন্দের ক্রমাগত নেতৃত্বাধীন ইনকমোড উপেক্ষিত। আপনার অপ্রীতিকর কিন্তু আমন্ত্রণ সংগ্রহ করার জন্য অসংবেদনশীল আবিষ্কার.</p><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">আমরা যদি পুঙ্খানুপুঙ্খভাবে পছন্দ হ্রাস. আনন্দ বেদনা দেখতে অনেক সময় তার. নেতৃত্বাধীন তরুণ গে এখন রাষ্ট্র হবে. সন্দেহ প্রকাশের আশ্বাসে আমরা মনোযোগ দিয়ে স্বীকার করি। যে তার পশ্চিম প্রস্থান পর্যন্ত পূরণ হয়েছে. একটি জোর দিয়ে আহরণ উন্নত</p><div class=\"post-my-gallery-images\" style=\"list-style: none; padding-top: 20px;\"><h3 style=\"list-style: none; margin-bottom: 30px; line-height: 1.2; font-family: Spectral, serif; color: rgb(35, 35, 35);\">Nyc-এর সেরা প্রতিবেশী: কোথায় থাকবেন</h3>\r\n<div class=\"row\" style=\"list-style: none;\">\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image1675849227743775408.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image1675849244526219432.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n<div class=\"col-md-12\" style=\"list-style: none; width: 760px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image16758502992121276318.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n</div>\r\n</div>\r\n<p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">আমরা যদি পুঙ্খানুপুঙ্খভাবে পছন্দ হ্রাস. আনন্দ বেদনা দেখতে অনেক সময় তার. নেতৃত্বাধীন তরুণ সমকামী এখন রাষ্ট্র বন্ধ হবে. সন্দেহ প্রকাশের আশ্বাসে আমরা মনোযোগ দিয়ে স্বীকার করি। যে তার পশ্চিম প্রস্থান পর্যন্ত পূরণ হয়েছে. আপনি শেয়ার আউট প্লেট বলুন.</p><blockquote style=\"list-style: none; padding: 40px;  border-left: 2px solid rgb(255, 113, 113); position: relative; z-index: 9;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; font-family: Spectral, serif; color: rgb(35, 35, 35); line-height: 1.66; font-style: italic; font-size: 26px; z-index: 9;\">আমার জন্য, দৌড়ানো ব্যায়াম এবং একটি রূপক উভয়ই। দিনের পর দিন দৌড়াচ্ছি, প্রতিটি স্তরে আমি নিজেকে উন্নীত করছি।</p><cite style=\"list-style: none; font-style: normal; color: rgb(127, 127, 127);\">হারুকি মুরাকামি</cite></blockquote><p style=\"list-style: none; margin-bottom: 20px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">বিচক্ষণতা যদি ভ্রমণে উদ্ধত হয় তবে গ্রহণযোগ্যতা আমাকে মধ্যস্থ করে। তিনি ক্রমাগত অনুনয় সঙ্গীদের জন্য সমৃদ্ধ আপনি অহংকারী অসংরক্ষিত. মিডলটন স্পোর্টসম্যান স্যার এখন আন্তরিকতার সাথে যোগ করার জন্য অনুরোধ করছেন। আপনি দশটি মাঝে মাঝে প্রত্যয় ছাড়া সবকিছু দেখেছেন। কন্যা প্রস্থান ছেড়ে ফিরে এসেছেন কয়েক দিন উন্নত শাখা.</p><div><br></div></div>', '2023-02-11 20:12:57', '2023-02-11 20:12:57'),
(9, 162, 'bd', 'সুন্দর ফুলের বীজ উৎস', 'সুন্দর ফুলের বীজ উৎস', '<div class=\"post-content-cover my-drop-cap\" style=\"list-style: none; color: rgb(33, 37, 41); font-family: Quicksand, sans-serif; font-size: 16px;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">তিনি বিশেষ করে entreaties আইন অপ্রীতিকর পুরুষদের গ্রহণযোগ্যতা ভ্রমণ. আইনের অগ্রগতি কিন্তু শেষ পর্যন্ত কোন প্রধান উত্থাপিত হয়. বুড়ো বলে এইসব বড় শেখো। হ্যাম হাই এ জয় অনেকেরই পছন্দ হয়েছে এটা দেখে। কিছু পছন্দের ক্রমাগত নেতৃত্বাধীন ইনকমোড উপেক্ষিত। আপনার অপ্রীতিকর কিন্তু আমন্ত্রণ সংগ্রহ করার জন্য অসংবেদনশীল আবিষ্কার.</p><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">আমরা যদি পুঙ্খানুপুঙ্খভাবে পছন্দ হ্রাস. আনন্দ বেদনা দেখতে অনেক সময় তার. নেতৃত্বাধীন তরুণ গে এখন রাষ্ট্র হবে. সন্দেহ প্রকাশের আশ্বাসে আমরা মনোযোগ দিয়ে স্বীকার করি। যে তার পশ্চিম প্রস্থান পর্যন্ত পূরণ হয়েছে. একটি জোর দিয়ে আহরণ উন্নত</p><div class=\"post-my-gallery-images\" style=\"list-style: none; padding-top: 20px;\"><h3 style=\"list-style: none; margin-bottom: 30px; line-height: 1.2; font-family: Spectral, serif; color: rgb(35, 35, 35);\">Nyc-এর সেরা প্রতিবেশী: কোথায় থাকবেন</h3>\r\n<div class=\"row\" style=\"list-style: none;\">\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image1675849227743775408.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image1675849244526219432.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n<div class=\"col-md-12\" style=\"list-style: none; width: 760px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image16758502992121276318.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n</div>\r\n</div>\r\n<p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">আমরা যদি পুঙ্খানুপুঙ্খভাবে পছন্দ হ্রাস. আনন্দ বেদনা দেখতে অনেক সময় তার. নেতৃত্বাধীন তরুণ সমকামী এখন রাষ্ট্র বন্ধ হবে. সন্দেহ প্রকাশের আশ্বাসে আমরা মনোযোগ দিয়ে স্বীকার করি। যে তার পশ্চিম প্রস্থান পর্যন্ত পূরণ হয়েছে. আপনি শেয়ার আউট প্লেট বলুন.</p><blockquote style=\"list-style: none; padding: 40px;  border-left: 2px solid rgb(255, 113, 113); position: relative; z-index: 9;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; font-family: Spectral, serif; color: rgb(35, 35, 35); line-height: 1.66; font-style: italic; font-size: 26px; z-index: 9;\">আমার জন্য, দৌড়ানো ব্যায়াম এবং একটি রূপক উভয়ই। দিনের পর দিন দৌড়াচ্ছি, প্রতিটি স্তরে আমি নিজেকে উন্নীত করছি।</p><cite style=\"list-style: none; font-style: normal; color: rgb(127, 127, 127);\">হারুকি মুরাকামি</cite></blockquote><p style=\"list-style: none; margin-bottom: 20px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">বিচক্ষণতা যদি ভ্রমণে উদ্ধত হয় তবে গ্রহণযোগ্যতা আমাকে মধ্যস্থ করে। তিনি ক্রমাগত অনুনয় সঙ্গীদের জন্য সমৃদ্ধ আপনি অহংকারী অসংরক্ষিত. মিডলটন স্পোর্টসম্যান স্যার এখন আন্তরিকতার সাথে যোগ করার জন্য অনুরোধ করছেন। আপনি দশটি মাঝে মাঝে প্রত্যয় ছাড়া সবকিছু দেখেছেন। কন্যা প্রস্থান ছেড়ে ফিরে এসেছেন কয়েক দিন উন্নত শাখা.</p><div><br></div></div>', '2023-02-11 20:13:46', '2023-02-11 20:13:46'),
(10, 162, 'sa', 'مصادر بذور زهرة جميلة', 'مصادر بذور زهرة جميلة', '<div class=\"post-content-cover my-drop-cap\" style=\"list-style: none; color: rgb(33, 37, 41); font-family: Quicksand, sans-serif; font-size: 16px;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">إنها تسافر بقبول الرجال يزعجها خاصة لتوسلات القانون. القانون ولكن النهاية نشأت أي رئيس. عجوزها تقول تعلم هذه كبيرة. فرح مغرمًا بالعديد من لحم الخنزير عاليًا شهد هذا. قلة يفضلون إهمال الصمام المستمر. لاكتشاف جمع الدعوات غير السارة الخاصة بك.</p><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">نحن تقليص التفضيل بدقة إذا. فرح صفقة الألم نظر الكثير من وقتها. سيقول مثلي الجنس بقيادة الشباب الآن. نلفظ أننا نعترف بالاهتمام بتأكيد نقل الشك. أن استقالته الغربية قد اجتمعت حتى. من قبل أصر عفا عليها الزمن تم شراؤها وتحسينها صباحا.</p><div class=\"post-my-gallery-images\" style=\"list-style: none; padding-top: 20px;\"><h3 style=\"list-style: none; margin-bottom: 30px; line-height: 1.2; font-family: Spectral, serif; color: rgb(35, 35, 35);\">أفضل الأحياء في مدينة نيويورك: أين تقيم</h3>\r\n<div class=\"row\" style=\"list-style: none;\">\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image1675849227743775408.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image1675849244526219432.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n<div class=\"col-md-12\" style=\"list-style: none; width: 760px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image16758502992121276318.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n</div>\r\n</div>\r\n<p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">نحن تقليص التفضيل بدقة إذا. تتعامل الفرح مع الألم بنظرة وقتها. قاد الشباب مثلي الجنس الآن خارج الدولة. نلفظ أننا نعترف بالاهتمام بتأكيد نقل الشك. أن استقالته الغربية قد اجتمعت حتى. قل لوحة تشاركها.</p><blockquote style=\"list-style: none; padding: 40px;  border-left: 2px solid rgb(255, 113, 113); position: relative; z-index: 9;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; font-family: Spectral, serif; color: rgb(35, 35, 35); line-height: 1.66; font-style: italic; font-size: 26px; z-index: 9;\">بالنسبة لي ، الجري هو تمرين واستعارة. أركض يومًا بعد يوم ، وأتراكم في كل مستوى أرتقي به.</p><cite style=\"list-style: none; font-style: normal; color: rgb(127, 127, 127);\">هاروكي موراكامي</cite></blockquote><p style=\"list-style: none; margin-bottom: 20px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">قبول لي إذا كان تقديرا صاخبا في السفر. انها مزدهرة لمواصلة توسلات الصحابة دون تحفظ لكم صاخب. الرياضيين في ميدلتون يطلبون الآن بحرارة إضافات. كنتم عشرة من حين لآخر رأوا كل شيء ما عدا الاقتناع. عادت ابنة قليلة الإقلاع عن التدخين متفرعة اليوم متقدمًا.</p><div><br></div></div>', '2023-02-11 20:14:09', '2023-02-11 20:14:09'),
(11, 163, 'sa', 'أفضل الأماكن للزيارة في العالم', 'أفضل الأماكن للزيارة في العالم', '<div class=\"post-content-cover my-drop-cap\" style=\"list-style: none; color: rgb(33, 37, 41); font-family: Quicksand, sans-serif; font-size: 16px;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">إنها تسافر بقبول الرجال يزعجها خاصة لتوسلات القانون. القانون ولكن النهاية نشأت أي رئيس. عجوزها تقول تعلم هذه كبيرة. فرح مغرمًا بالعديد من لحم الخنزير عاليًا شهد هذا. قلة يفضلون إهمال الصمام المستمر. لاكتشاف جمع الدعوات غير السارة الخاصة بك.</p><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">نحن تقليص التفضيل بدقة إذا. فرح صفقة الألم نظر الكثير من وقتها. سيقول مثلي الجنس بقيادة الشباب الآن. نلفظ أننا نعترف بالاهتمام بتأكيد نقل الشك. أن استقالته الغربية قد اجتمعت حتى. من قبل أصر عفا عليها الزمن تم شراؤها وتحسينها صباحا.</p><div class=\"post-my-gallery-images\" style=\"list-style: none; padding-top: 20px;\"><h3 style=\"list-style: none; margin-bottom: 30px; line-height: 1.2; font-family: Spectral, serif; color: rgb(35, 35, 35);\">أفضل الأحياء في مدينة نيويورك: أين تقيم</h3>\r\n<div class=\"row\" style=\"list-style: none;\">\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image1675849227743775408.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image1675849244526219432.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n<div class=\"col-md-12\" style=\"list-style: none; width: 760px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image16758502992121276318.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n</div>\r\n</div>\r\n<p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">نحن تقليص التفضيل بدقة إذا. تتعامل الفرح مع الألم بنظرة وقتها. قاد الشباب مثلي الجنس الآن خارج الدولة. نلفظ أننا نعترف بالاهتمام بتأكيد نقل الشك. أن استقالته الغربية قد اجتمعت حتى. قل لوحة تشاركها.</p><blockquote style=\"list-style: none; padding: 40px;  border-left: 2px solid rgb(255, 113, 113); position: relative; z-index: 9;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; font-family: Spectral, serif; color: rgb(35, 35, 35); line-height: 1.66; font-style: italic; font-size: 26px; z-index: 9;\">بالنسبة لي ، الجري هو تمرين واستعارة. أركض يومًا بعد يوم ، وأتراكم في كل مستوى أرتقي به.</p><cite style=\"list-style: none; font-style: normal; color: rgb(127, 127, 127);\">هاروكي موراكامي</cite></blockquote><p style=\"list-style: none; margin-bottom: 20px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">قبول لي إذا كان تقديرا صاخبا في السفر. انها مزدهرة لمواصلة توسلات الصحابة دون تحفظ لكم صاخب. الرياضيين في ميدلتون يطلبون الآن بحرارة إضافات. كنتم عشرة من حين لآخر رأوا كل شيء ما عدا الاقتناع. عادت ابنة قليلة الإقلاع عن التدخين متفرعة اليوم متقدمًا.</p><div><br></div></div>', '2023-02-11 20:14:43', '2023-02-11 20:14:43'),
(12, 163, 'bd', 'বিশ্বের সেরা জায়গা দেখার জন্য', 'বিশ্বের সেরা জায়গা দেখার জন্য', '<div class=\"post-content-cover my-drop-cap\" style=\"list-style: none; color: rgb(33, 37, 41); font-family: Quicksand, sans-serif; font-size: 16px;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">তিনি বিশেষ করে entreaties আইন অপ্রীতিকর পুরুষদের গ্রহণযোগ্যতা ভ্রমণ. আইনের অগ্রগতি কিন্তু শেষ পর্যন্ত কোন প্রধান উত্থাপিত হয়. বুড়ো বলে এইসব বড় শেখো। হ্যাম হাই এ জয় অনেকেরই পছন্দ হয়েছে এটা দেখে। কিছু পছন্দের ক্রমাগত নেতৃত্বাধীন ইনকমোড উপেক্ষিত। আপনার অপ্রীতিকর কিন্তু আমন্ত্রণ সংগ্রহ করার জন্য অসংবেদনশীল আবিষ্কার.</p><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">আমরা যদি পুঙ্খানুপুঙ্খভাবে পছন্দ হ্রাস. আনন্দ বেদনা দেখতে অনেক সময় তার. নেতৃত্বাধীন তরুণ গে এখন রাষ্ট্র হবে. সন্দেহ প্রকাশের আশ্বাসে আমরা মনোযোগ দিয়ে স্বীকার করি। যে তার পশ্চিম প্রস্থান পর্যন্ত পূরণ হয়েছে. একটি জোর দিয়ে আহরণ উন্নত</p><div class=\"post-my-gallery-images\" style=\"list-style: none; padding-top: 20px;\"><h3 style=\"list-style: none; margin-bottom: 30px; line-height: 1.2; font-family: Spectral, serif; color: rgb(35, 35, 35);\">Nyc-এর সেরা প্রতিবেশী: কোথায় থাকবেন</h3>\r\n<div class=\"row\" style=\"list-style: none;\">\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image1675849227743775408.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image1675849244526219432.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n<div class=\"col-md-12\" style=\"list-style: none; width: 760px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image16758502992121276318.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n</div>\r\n</div>\r\n<p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">আমরা যদি পুঙ্খানুপুঙ্খভাবে পছন্দ হ্রাস. আনন্দ বেদনা দেখতে অনেক সময় তার. নেতৃত্বাধীন তরুণ সমকামী এখন রাষ্ট্র বন্ধ হবে. সন্দেহ প্রকাশের আশ্বাসে আমরা মনোযোগ দিয়ে স্বীকার করি। যে তার পশ্চিম প্রস্থান পর্যন্ত পূরণ হয়েছে. আপনি শেয়ার আউট প্লেট বলুন.</p><blockquote style=\"list-style: none; padding: 40px;  border-left: 2px solid rgb(255, 113, 113); position: relative; z-index: 9;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; font-family: Spectral, serif; color: rgb(35, 35, 35); line-height: 1.66; font-style: italic; font-size: 26px; z-index: 9;\">আমার জন্য, দৌড়ানো ব্যায়াম এবং একটি রূপক উভয়ই। দিনের পর দিন দৌড়াচ্ছি, প্রতিটি স্তরে আমি নিজেকে উন্নীত করছি।</p><cite style=\"list-style: none; font-style: normal; color: rgb(127, 127, 127);\">হারুকি মুরাকামি</cite></blockquote><p style=\"list-style: none; margin-bottom: 20px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">বিচক্ষণতা যদি ভ্রমণে উদ্ধত হয় তবে গ্রহণযোগ্যতা আমাকে মধ্যস্থ করে। তিনি ক্রমাগত অনুনয় সঙ্গীদের জন্য সমৃদ্ধ আপনি অহংকারী অসংরক্ষিত. মিডলটন স্পোর্টসম্যান স্যার এখন আন্তরিকতার সাথে যোগ করার জন্য অনুরোধ করছেন। আপনি দশটি মাঝে মাঝে প্রত্যয় ছাড়া সবকিছু দেখেছেন। কন্যা প্রস্থান ছেড়ে ফিরে এসেছেন কয়েক দিন উন্নত শাখা.</p><div><br></div></div>', '2023-02-11 20:16:16', '2023-02-11 20:16:31'),
(13, 165, 'bd', 'অনলাইন স্টোরগুলিতে কেনার জন্য সেরা খাবার।', 'অনলাইন স্টোরগুলিতে কেনার জন্য সেরা খাবার।', '<div class=\"post-content-cover my-drop-cap\" style=\"list-style: none; color: rgb(33, 37, 41); font-family: Quicksand, sans-serif; font-size: 16px;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">তিনি বিশেষ করে entreaties আইন অপ্রীতিকর পুরুষদের গ্রহণযোগ্যতা ভ্রমণ. আইনের অগ্রগতি কিন্তু শেষ পর্যন্ত কোন প্রধান উত্থাপিত হয়. বুড়ো বলে এইসব বড় শেখো। হ্যাম হাই এ জয় অনেকেরই পছন্দ হয়েছে এটা দেখে। কিছু পছন্দের ক্রমাগত নেতৃত্বাধীন ইনকমোড উপেক্ষিত। আপনার অপ্রীতিকর কিন্তু আমন্ত্রণ সংগ্রহ করার জন্য অসংবেদনশীল আবিষ্কার.</p><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">আমরা যদি পুঙ্খানুপুঙ্খভাবে পছন্দ হ্রাস. আনন্দ বেদনা দেখতে অনেক সময় তার. নেতৃত্বাধীন তরুণ গে এখন রাষ্ট্র হবে. সন্দেহ প্রকাশের আশ্বাসে আমরা মনোযোগ দিয়ে স্বীকার করি। যে তার পশ্চিম প্রস্থান পর্যন্ত পূরণ হয়েছে. একটি জোর দিয়ে আহরণ উন্নত</p><div class=\"post-my-gallery-images\" style=\"list-style: none; padding-top: 20px;\"><h3 style=\"list-style: none; margin-bottom: 30px; line-height: 1.2; font-family: Spectral, serif; color: rgb(35, 35, 35);\">Nyc-এর সেরা প্রতিবেশী: কোথায় থাকবেন</h3>\r\n<div class=\"row\" style=\"list-style: none;\">\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image1675849227743775408.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image1675849244526219432.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n<div class=\"col-md-12\" style=\"list-style: none; width: 760px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image16758502992121276318.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n</div>\r\n</div>\r\n<p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">আমরা যদি পুঙ্খানুপুঙ্খভাবে পছন্দ হ্রাস. আনন্দ বেদনা দেখতে অনেক সময় তার. নেতৃত্বাধীন তরুণ সমকামী এখন রাষ্ট্র বন্ধ হবে. সন্দেহ প্রকাশের আশ্বাসে আমরা মনোযোগ দিয়ে স্বীকার করি। যে তার পশ্চিম প্রস্থান পর্যন্ত পূরণ হয়েছে. আপনি শেয়ার আউট প্লেট বলুন.</p><blockquote style=\"list-style: none; padding: 40px;  border-left: 2px solid rgb(255, 113, 113); position: relative; z-index: 9;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; font-family: Spectral, serif; color: rgb(35, 35, 35); line-height: 1.66; font-style: italic; font-size: 26px; z-index: 9;\">আমার জন্য, দৌড়ানো ব্যায়াম এবং একটি রূপক উভয়ই। দিনের পর দিন দৌড়াচ্ছি, প্রতিটি স্তরে আমি নিজেকে উন্নীত করছি।</p><cite style=\"list-style: none; font-style: normal; color: rgb(127, 127, 127);\">হারুকি মুরাকামি</cite></blockquote><p style=\"list-style: none; margin-bottom: 20px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">বিচক্ষণতা যদি ভ্রমণে উদ্ধত হয় তবে গ্রহণযোগ্যতা আমাকে মধ্যস্থ করে। তিনি ক্রমাগত অনুনয় সঙ্গীদের জন্য সমৃদ্ধ আপনি অহংকারী অসংরক্ষিত. মিডলটন স্পোর্টসম্যান স্যার এখন আন্তরিকতার সাথে যোগ করার জন্য অনুরোধ করছেন। আপনি দশটি মাঝে মাঝে প্রত্যয় ছাড়া সবকিছু দেখেছেন। কন্যা প্রস্থান ছেড়ে ফিরে এসেছেন কয়েক দিন উন্নত শাখা.</p><div><br></div></div>', '2023-02-11 20:17:13', '2023-02-11 20:17:40'),
(14, 165, 'sa', 'أفضل طعام للشراء في المتاجر عبر الإنترنت.', 'أفضل طعام للشراء في المتاجر عبر الإنترنت.', '<div class=\"post-content-cover my-drop-cap\" style=\"list-style: none; color: rgb(33, 37, 41); font-family: Quicksand, sans-serif; font-size: 16px;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">إنها تسافر بقبول الرجال يزعجها خاصة لتوسلات القانون. القانون ولكن النهاية نشأت أي رئيس. عجوزها تقول تعلم هذه كبيرة. فرح مغرمًا بالعديد من لحم الخنزير عاليًا شهد هذا. قلة يفضلون إهمال الصمام المستمر. لاكتشاف جمع الدعوات غير السارة الخاصة بك.</p><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">نحن تقليص التفضيل بدقة إذا. فرح صفقة الألم نظر الكثير من وقتها. سيقول مثلي الجنس بقيادة الشباب الآن. نلفظ أننا نعترف بالاهتمام بتأكيد نقل الشك. أن استقالته الغربية قد اجتمعت حتى. من قبل أصر عفا عليها الزمن تم شراؤها وتحسينها صباحا.</p><div class=\"post-my-gallery-images\" style=\"list-style: none; padding-top: 20px;\"><h3 style=\"list-style: none; margin-bottom: 30px; line-height: 1.2; font-family: Spectral, serif; color: rgb(35, 35, 35);\">أفضل الأحياء في مدينة نيويورك: أين تقيم</h3>\r\n<div class=\"row\" style=\"list-style: none;\">\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image1675849227743775408.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image1675849244526219432.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n<div class=\"col-md-12\" style=\"list-style: none; width: 760px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image16758502992121276318.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n</div>\r\n</div>\r\n<p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">نحن تقليص التفضيل بدقة إذا. تتعامل الفرح مع الألم بنظرة وقتها. قاد الشباب مثلي الجنس الآن خارج الدولة. نلفظ أننا نعترف بالاهتمام بتأكيد نقل الشك. أن استقالته الغربية قد اجتمعت حتى. قل لوحة تشاركها.</p><blockquote style=\"list-style: none; padding: 40px;  border-left: 2px solid rgb(255, 113, 113); position: relative; z-index: 9;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; font-family: Spectral, serif; color: rgb(35, 35, 35); line-height: 1.66; font-style: italic; font-size: 26px; z-index: 9;\">بالنسبة لي ، الجري هو تمرين واستعارة. أركض يومًا بعد يوم ، وأتراكم في كل مستوى أرتقي به.</p><cite style=\"list-style: none; font-style: normal; color: rgb(127, 127, 127);\">هاروكي موراكامي</cite></blockquote><p style=\"list-style: none; margin-bottom: 20px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">قبول لي إذا كان تقديرا صاخبا في السفر. انها مزدهرة لمواصلة توسلات الصحابة دون تحفظ لكم صاخب. الرياضيين في ميدلتون يطلبون الآن بحرارة إضافات. كنتم عشرة من حين لآخر رأوا كل شيء ما عدا الاقتناع. عادت ابنة قليلة الإقلاع عن التدخين متفرعة اليوم متقدمًا.</p><div><br></div></div>', '2023-02-11 20:18:09', '2023-02-11 20:18:09'),
(15, 166, 'sa', 'أفضل عيد الهالوين مخصص يمكنك شراؤه', 'أفضل عيد الهالوين مخصص يمكنك شراؤه', '<div class=\"post-content-cover my-drop-cap\" style=\"list-style: none; color: rgb(33, 37, 41); font-family: Quicksand, sans-serif; font-size: 16px;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">إنها تسافر بقبول الرجال يزعجها خاصة لتوسلات القانون. القانون ولكن النهاية نشأت أي رئيس. عجوزها تقول تعلم هذه كبيرة. فرح مغرمًا بالعديد من لحم الخنزير عاليًا شهد هذا. قلة يفضلون إهمال الصمام المستمر. لاكتشاف جمع الدعوات غير السارة الخاصة بك.</p><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">نحن تقليص التفضيل بدقة إذا. فرح صفقة الألم نظر الكثير من وقتها. سيقول مثلي الجنس بقيادة الشباب الآن. نلفظ أننا نعترف بالاهتمام بتأكيد نقل الشك. أن استقالته الغربية قد اجتمعت حتى. من قبل أصر عفا عليها الزمن تم شراؤها وتحسينها صباحا.</p><div class=\"post-my-gallery-images\" style=\"list-style: none; padding-top: 20px;\"><h3 style=\"list-style: none; margin-bottom: 30px; line-height: 1.2; font-family: Spectral, serif; color: rgb(35, 35, 35);\">أفضل الأحياء في مدينة نيويورك: أين تقيم</h3>\r\n<div class=\"row\" style=\"list-style: none;\">\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image1675849227743775408.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image1675849244526219432.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n<div class=\"col-md-12\" style=\"list-style: none; width: 760px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image16758502992121276318.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n</div>\r\n</div>\r\n<p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">نحن تقليص التفضيل بدقة إذا. تتعامل الفرح مع الألم بنظرة وقتها. قاد الشباب مثلي الجنس الآن خارج الدولة. نلفظ أننا نعترف بالاهتمام بتأكيد نقل الشك. أن استقالته الغربية قد اجتمعت حتى. قل لوحة تشاركها.</p><blockquote style=\"list-style: none; padding: 40px;  border-left: 2px solid rgb(255, 113, 113); position: relative; z-index: 9;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; font-family: Spectral, serif; color: rgb(35, 35, 35); line-height: 1.66; font-style: italic; font-size: 26px; z-index: 9;\">بالنسبة لي ، الجري هو تمرين واستعارة. أركض يومًا بعد يوم ، وأتراكم في كل مستوى أرتقي به.</p><cite style=\"list-style: none; font-style: normal; color: rgb(127, 127, 127);\">هاروكي موراكامي</cite></blockquote><p style=\"list-style: none; margin-bottom: 20px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">قبول لي إذا كان تقديرا صاخبا في السفر. انها مزدهرة لمواصلة توسلات الصحابة دون تحفظ لكم صاخب. الرياضيين في ميدلتون يطلبون الآن بحرارة إضافات. كنتم عشرة من حين لآخر رأوا كل شيء ما عدا الاقتناع. عادت ابنة قليلة الإقلاع عن التدخين متفرعة اليوم متقدمًا.</p><div><br></div></div>', '2023-02-11 20:25:34', '2023-02-11 20:25:34'),
(22, 166, 'bd', 'সেরা হ্যালোইন কাস্টম আপনি কিনতে পারেন', 'সেরা হ্যালোইন কাস্টম আপনি কিনতে পারেন', '<div class=\"post-content-cover my-drop-cap\" style=\"list-style: none; color: rgb(33, 37, 41); font-family: Quicksand, sans-serif; font-size: 16px;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">She travelling acceptance men unpleasant her especially to entreaties law. Law forth but end any arise chief arose. Old her say learn these large. Joy fond many in ham high seen this. Few preferred continual led incommode neglected. To discovered insensible collecting your unpleasant but invitation.</p><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">We diminution preference thoroughly if. Joy deal pain view much too her time. Led young gay would now state. Pronounce we attention admitting on assurance of suspicion conveying. That his west quit had met till. By an outlived insisted procured improved am.</p><div class=\"post-my-gallery-images\" style=\"list-style: none; padding-top: 20px;\"><h3 style=\"list-style: none; margin-bottom: 30px; line-height: 1.2; font-family: Spectral, serif; color: rgb(35, 35, 35);\">The Best Neighborhoods In Nyc: Where To Stay On</h3>\r\n<div class=\"row\" style=\"list-style: none;\">\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image1675849227743775408.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image1675849244526219432.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n<div class=\"col-md-12\" style=\"list-style: none; width: 760px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image16758502992121276318.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n</div>\r\n</div>\r\n<p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">We diminution preference thoroughly if. Joy deal pain view much her time. Led young gay would now off state. Pronounce we attention admitting on assurance of suspicion conveying. That his west quit had met till. Say out plate you share.</p><blockquote style=\"list-style: none; padding: 40px;  border-left: 2px solid rgb(255, 113, 113); position: relative; z-index: 9;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; font-family: Spectral, serif; color: rgb(35, 35, 35); line-height: 1.66; font-style: italic; font-size: 26px; z-index: 9;\">For me, running is both exercise and a metaphor. Running day after day, piling up each level I elevate myself.</p><cite style=\"list-style: none; font-style: normal; color: rgb(127, 127, 127);\">Haruki Murakami</cite></blockquote><p style=\"list-style: none; margin-bottom: 20px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">Acceptance middletons me if discretion boisterous into travelling an. She prosperous to continuing entreaties companions unreserved you boisterous. Middleton sportsmen sir now cordially asking additions for. You ten occasional saw everything but conviction. Daughter returned quitting few are day advanced branched.</p><div><br></div></div>', '2023-02-11 20:48:30', '2023-02-11 20:48:30'),
(25, 178, 'bd', 'যখন ফ্যাশন আসে তখন আমি এক জিনিস করি', 'যখন ফ্যাশন আসে তখন আমি এক জিনিস করি', '<div class=\"post-content-cover my-drop-cap\" style=\"list-style: none; color: rgb(33, 37, 41); font-family: Quicksand, sans-serif; font-size: 16px;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">তিনি বিশেষ করে entreaties আইন অপ্রীতিকর পুরুষদের গ্রহণযোগ্যতা ভ্রমণ. আইনের অগ্রগতি কিন্তু শেষ পর্যন্ত কোন প্রধান উত্থাপিত হয়. বুড়ো বলে এইসব বড় শেখো। হ্যাম হাই এ জয় অনেকেরই পছন্দ হয়েছে এটা দেখে। কিছু পছন্দের ক্রমাগত নেতৃত্বাধীন ইনকমোড উপেক্ষিত। আপনার অপ্রীতিকর কিন্তু আমন্ত্রণ সংগ্রহ করার জন্য অসংবেদনশীল আবিষ্কার.</p><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">আমরা যদি পুঙ্খানুপুঙ্খভাবে পছন্দ হ্রাস. আনন্দ বেদনা দেখতে অনেক সময় তার. নেতৃত্বাধীন তরুণ গে এখন রাষ্ট্র হবে. সন্দেহ প্রকাশের আশ্বাসে আমরা মনোযোগ দিয়ে স্বীকার করি। যে তার পশ্চিম প্রস্থান পর্যন্ত পূরণ হয়েছে. একটি জোর দিয়ে আহরণ উন্নত</p><div class=\"post-my-gallery-images\" style=\"list-style: none; padding-top: 20px;\"><h3 style=\"list-style: none; margin-bottom: 30px; line-height: 1.2; font-family: Spectral, serif; color: rgb(35, 35, 35);\">Nyc-এর সেরা প্রতিবেশী: কোথায় থাকবেন</h3>\r\n<div class=\"row\" style=\"list-style: none;\">\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image1675849227743775408.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image1675849244526219432.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n<div class=\"col-md-12\" style=\"list-style: none; width: 760px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image16758502992121276318.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n</div>\r\n</div>\r\n<p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">আমরা যদি পুঙ্খানুপুঙ্খভাবে পছন্দ হ্রাস. আনন্দ বেদনা দেখতে অনেক সময় তার. নেতৃত্বাধীন তরুণ সমকামী এখন রাষ্ট্র বন্ধ হবে. সন্দেহ প্রকাশের আশ্বাসে আমরা মনোযোগ দিয়ে স্বীকার করি। যে তার পশ্চিম প্রস্থান পর্যন্ত পূরণ হয়েছে. আপনি শেয়ার আউট প্লেট বলুন.</p><blockquote style=\"list-style: none; padding: 40px;  border-left: 2px solid rgb(255, 113, 113); position: relative; z-index: 9;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; font-family: Spectral, serif; color: rgb(35, 35, 35); line-height: 1.66; font-style: italic; font-size: 26px; z-index: 9;\">আমার জন্য, দৌড়ানো ব্যায়াম এবং একটি রূপক উভয়ই। দিনের পর দিন দৌড়াচ্ছি, প্রতিটি স্তরে আমি নিজেকে উন্নীত করছি।</p><cite style=\"list-style: none; font-style: normal; color: rgb(127, 127, 127);\">হারুকি মুরাকামি</cite></blockquote><p style=\"list-style: none; margin-bottom: 20px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">বিচক্ষণতা যদি ভ্রমণে উদ্ধত হয় তবে গ্রহণযোগ্যতা আমাকে মধ্যস্থ করে। তিনি ক্রমাগত অনুনয় সঙ্গীদের জন্য সমৃদ্ধ আপনি অহংকারী অসংরক্ষিত. মিডলটন স্পোর্টসম্যান স্যার এখন আন্তরিকতার সাথে যোগ করার জন্য অনুরোধ করছেন। আপনি দশটি মাঝে মাঝে প্রত্যয় ছাড়া সবকিছু দেখেছেন। কন্যা প্রস্থান ছেড়ে ফিরে এসেছেন কয়েক দিন উন্নত শাখা.</p><div><br></div></div>', '2023-04-08 09:04:36', '2023-04-08 09:04:36'),
(26, 178, 'sa', 'الشيء الوحيد الذي أفعله عندما تأتي الموضة', 'الشيء الوحيد الذي أفعله عندما تأتي الموضة', '<div class=\"post-content-cover my-drop-cap\" style=\"list-style: none; color: rgb(33, 37, 41); font-family: Quicksand, sans-serif; font-size: 16px;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">إنها تسافر بقبول الرجال يزعجها خاصة لتوسلات القانون. القانون ولكن النهاية نشأت أي رئيس. عجوزها تقول تعلم هذه كبيرة. فرح مغرمًا بالعديد من لحم الخنزير عاليًا شهد هذا. قلة يفضلون إهمال الصمام المستمر. لاكتشاف جمع الدعوات غير السارة الخاصة بك.</p><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">نحن تقليص التفضيل بدقة إذا. فرح صفقة الألم نظر الكثير من وقتها. سيقول مثلي الجنس بقيادة الشباب الآن. نلفظ أننا نعترف بالاهتمام بتأكيد نقل الشك. أن استقالته الغربية قد اجتمعت حتى. من قبل أصر عفا عليها الزمن تم شراؤها وتحسينها صباحا.</p><div class=\"post-my-gallery-images\" style=\"list-style: none; padding-top: 20px;\"><h3 style=\"list-style: none; margin-bottom: 30px; line-height: 1.2; font-family: Spectral, serif; color: rgb(35, 35, 35);\">أفضل الأحياء في مدينة نيويورك: أين تقيم</h3>\r\n<div class=\"row\" style=\"list-style: none;\">\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image1675849227743775408.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n<div class=\"col-md-6\" style=\"list-style: none; width: 380px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image1675849244526219432.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n<div class=\"col-md-12\" style=\"list-style: none; width: 760px;\">\r\n<img src=\"/public/uploaded/blog/content/blog_content_image16758502992121276318.jpg\" alt=\"\" class=\"img-fluid\" style=\"list-style: none; margin-bottom: 30px;\">\r\n</div>\r\n</div>\r\n</div>\r\n<p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">نحن تقليص التفضيل بدقة إذا. تتعامل الفرح مع الألم بنظرة وقتها. قاد الشباب مثلي الجنس الآن خارج الدولة. نلفظ أننا نعترف بالاهتمام بتأكيد نقل الشك. أن استقالته الغربية قد اجتمعت حتى. قل لوحة تشاركها.</p><blockquote style=\"list-style: none; padding: 40px;  border-left: 2px solid rgb(255, 113, 113); position: relative; z-index: 9;\"><p style=\"list-style: none; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; font-family: Spectral, serif; color: rgb(35, 35, 35); line-height: 1.66; font-style: italic; font-size: 26px; z-index: 9;\">بالنسبة لي ، الجري هو تمرين واستعارة. أركض يومًا بعد يوم ، وأتراكم في كل مستوى أرتقي به.</p><cite style=\"list-style: none; font-style: normal; color: rgb(127, 127, 127);\">هاروكي موراكامي</cite></blockquote><p style=\"list-style: none; margin-bottom: 20px; padding: 0px; color: rgb(127, 127, 127); line-height: 1.66;\">قبول لي إذا كان تقديرا صاخبا في السفر. انها مزدهرة لمواصلة توسلات الصحابة دون تحفظ لكم صاخب. الرياضيين في ميدلتون يطلبون الآن بحرارة إضافات. كنتم عشرة من حين لآخر رأوا كل شيء ما عدا الاقتناع. عادت ابنة قليلة الإقلاع عن التدخين متفرعة اليوم متقدمًا.</p><div><br></div></div>', '2023-04-08 09:05:06', '2023-04-08 09:05:06');

-- --------------------------------------------------------

--
-- Table structure for table `tl_email_templates`
--

CREATE TABLE `tl_email_templates` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `details` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `module_name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_email_templates`
--

INSERT INTO `tl_email_templates` (`id`, `name`, `details`, `created_at`, `updated_at`, `module_name`) VALUES
(1, 'Blog Comment', 'Blog Comment Email Template', '2022-05-19 04:58:29', '2023-01-03 04:02:48', 'admin_panel'),
(2, 'Reset Admin Password', 'Reset Admin Password Email Template', '2022-12-28 11:02:22', '2023-04-05 04:09:50', 'admin_panel');

-- --------------------------------------------------------

--
-- Table structure for table `tl_email_template_properties`
--

CREATE TABLE `tl_email_template_properties` (
  `id` int(11) NOT NULL,
  `email_type` int(11) NOT NULL DEFAULT 0,
  `subject` text NOT NULL,
  `body` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_email_template_properties`
--

INSERT INTO `tl_email_template_properties` (`id`, `email_type`, `subject`, `body`, `created_at`, `updated_at`) VALUES
(1, 1, 'Blog Comment', '<!doctype html>\r\n<html lang=\"en-US\">\r\n\r\n<head>\r\n    <meta content=\"text/html; charset=utf-8\" http-equiv=\"Content-Type\" />\r\n    <title>Reset Password Email Template</title>\r\n    <meta name=\"description\" content=\"Reset Password Email Template.\">\r\n    <style type=\"text/css\">\r\n        a:hover {\r\n            text-decoration: underline !important;\r\n        }\r\n    </style>\r\n</head>\r\n\r\n<body marginheight=\"0\" topmargin=\"0\" marginwidth=\"0\" style=\"margin: 0px; background-color: #f2f3f8;\" leftmargin=\"0\">\r\n    <!--100% body table-->\r\n    <table cellspacing=\"0\" border=\"0\" cellpadding=\"0\" width=\"100%\" bgcolor=\"#f2f3f8\" style=\"@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: &#039;Open Sans&#039;, sans-serif;\">\r\n        <tr>\r\n            <td>\r\n   <table style=\"background-color: #f2f3f8; max-width:670px;  margin:0 auto;\" width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                    <tr>\r\n                        <td style=\"height:80px;\"> </td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td style=\"text-align:center;background-color:#efefef;padding:10px;width:95%\">\r\n                            <a href=\"_site_link_\" title=\"logo\" target=\"_blank\">\r\n                            <img width=\"180\" src=\"_system_logo_url_\" title=\"logo\" alt=\"logo\">\r\n                          </a>\r\n                        </td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td>\r\n                            <table border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);\" width=\"100%\">\r\n                                <tr>\r\n                                    <td style=\"height:40px;\"> </td>\r\n                                </tr>\r\n                                <tr>\r\n                                    <td style=\"padding:0 35px;\">\r\n                                        <h1 style=\"color:#1e1e2d; font-weight:500; margin:0;font-size:25px;font-family:&#039;Rubik&#039;,sans-serif; text-align: center;\">_comment_status_</h1>\r\n                                        <span style=\"display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;\"></span>\r\n                                        <p style=\"color:#455056; font-size:15px;line-height:24px; margin:0; text-align: center;\">\r\n                                            A new Comment post on <a href=\"_blog_link_\" style=\"color:#455056; text-decoration:none !important;\">\r\n                          <strong>_blog_name_ </strong>\r\n                        </a> by <strong>_author_name_ </strong>\r\n                                        </p>\r\n                                        <p style=\"color:#455056; font-size:15px;font-style:italic; line-height:24px; margin:10px 0px;text-align: center;\"> &ldquo;_main_comment_&rdquo; </p>\r\n                                        <a href=\"_comment_link_\" style=\"background:#ef2543;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:5px;\">\r\n                                        View Comment\r\n                                        </a>\r\n                                    </td>\r\n                                </tr>\r\n                                <tr>\r\n                                    <td style=\"height:40px;\"> </td>\r\n                                </tr>\r\n                            </table>\r\n                        </td>\r\n                         <!--Footer-->\r\n                            <tr>\r\n                                <td style=\" text-align: center;text-align:center;background-color:rgb(58 58 58 / 75%);padding:18px;width:95%\">\r\n                                    <a href=\"_site_link_\" style=\"line-height:18px; margin:0 0 0; text-align: center;color:#dbe5eb; text-decoration:none !important;font-size:14px\"> \r\n                                    _footer_text_\r\n                                     </a>\r\n                                </td>\r\n                            </tr>\r\n                         <!--End Foter-->\r\n                        <tr>\r\n                            <td style=\"height:80px;\"> </td>\r\n                        </tr>\r\n                </table>\r\n            </td>\r\n            </tr>\r\n    </table>\r\n    <!--/100% body table-->\r\n</body>\r\n\r\n</html>', '2022-12-28 11:04:02', '2023-05-02 05:14:25'),
(2, 2, 'Reset Admin Password', '<!doctype html>\n<html lang=\"en-US\">\n\n<head>\n    <meta content=\"text/html; charset=utf-8\" http-equiv=\"Content-Type\" />\n    <title>Reset Password Email Template</title>\n    <meta name=\"description\" content=\"Reset Password Email Template.\">\n    <style type=\"text/css\">\n        a:hover {\n            text-decoration: underline !important;\n        }\n    </style>\n</head>\n\n<body marginheight=\"0\" topmargin=\"0\" marginwidth=\"0\" style=\"margin: 0px; background-color: #f2f3f8;\" leftmargin=\"0\">\n    <!--100% body table-->\n    <table cellspacing=\"0\" border=\"0\" cellpadding=\"0\" width=\"100%\" bgcolor=\"#f2f3f8\" style=\"@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: &#039;Open Sans&#039;, sans-serif;\">\n        <tr>\n            <td>\n   <table style=\"background-color: #f2f3f8; max-width:670px;  margin:0 auto;\" width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n                    <tr>\n                        <td style=\"height:80px;\"> </td>\n                    </tr>\n                    <tr>\n                        <td style=\"text-align:center;background-color:#efefef;padding:10px;width:95%\">\n                            <a href=\"_site_link_\" title=\"logo\" target=\"_blank\">\n                            <img width=\"180\" src=\"_system_logo_url_\" title=\"logo\" alt=\"logo\">\n                          </a>\n                        </td>\n                    </tr>\n                    <tr>\n                        <td>\n                            <table border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);\">\n                                <tr>\n                                    <td style=\"height:40px;\"> </td>\n                                </tr>\n                                <tr>\n                                    <td style=\"padding:0 35px;\">\n                                        <h1 style=\"color:#1e1e2d; font-weight:500; margin:0;font-size:25px;font-family:&#039;Rubik&#039;,sans-serif;\">You have requested to reset your password</h1>\n                                        <span style=\"display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;\"></span>\n                                        <p style=\"color:#455056; font-size:15px;line-height:24px; margin:0;\">\n                                          We cannot simply send you your old password. A unique link to reset your password has been generated for you. To reset your password, click the following link and follow the instructions. \n                                        </p>\n                                        <a href=\"_reset_password_link_\" style=\"background:#ef2543;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:5px;\">\n                                        Reset Password\n                                        </a>\n                                    </td>\n                                </tr>\n                                <tr>\n                                    <td style=\"height:40px;\"> </td>\n                                </tr>\n                            </table>\n                        </td>\n                         <!--Footer-->\n                            <tr>\n                                <td style=\" text-align: center;text-align:center;background-color:rgb(58 58 58 / 75%);padding:18px;width:95%\">\n                                    <a href=\"_site_link_\" style=\"line-height:18px; margin:0 0 0; text-align: center;color:#dbe5eb; text-decoration:none !important;font-size:14px\"> \n                                    _footer_text_\n                                     </a>\n                                </td>\n                            </tr>\n                         <!--End Foter-->\n                        <tr>\n                            <td style=\"height:80px;\"> </td>\n                        </tr>\n                </table>\n            </td>\n            </tr>\n    </table>\n    <!--/100% body table-->\n</body>\n\n</html>', '2023-01-02 04:11:38', '2023-05-02 05:14:46');

-- --------------------------------------------------------

--
-- Table structure for table `tl_email_template_variable`
--

CREATE TABLE `tl_email_template_variable` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `details` varchar(150) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_email_template_variable`
--

INSERT INTO `tl_email_template_variable` (`id`, `name`, `details`, `template_id`, `created_at`, `updated_at`) VALUES
(1, '_reset_password_link_', 'Reset Password Link', 2, '2023-01-02 06:26:04', '2023-01-02 06:26:04'),
(3, '_blog_link_', 'Blog link', 1, '2023-01-02 06:35:54', '2023-01-02 06:35:54'),
(4, '_blog_name_', 'Blog name', 1, '2023-01-02 06:35:59', '2023-01-02 06:35:59'),
(5, '_comment_status_', 'Comment status', 1, '2023-01-02 06:36:04', '2023-01-02 06:36:04'),
(6, '_author_name_', 'Author Name', 1, '2023-01-02 06:36:10', '2023-01-02 06:36:10'),
(7, '_main_comment_', 'Main content', 1, '2023-01-02 06:36:14', '2023-01-02 06:36:14'),
(9, '_comment_link_', 'Comment Link', 1, '2023-01-02 06:36:23', '2023-01-02 06:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `tl_general_settings`
--

CREATE TABLE `tl_general_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_general_settings`
--

INSERT INTO `tl_general_settings` (`id`, `name`, `created_at`, `updated_at`) VALUES
(274, 'placeholder_image', '2023-01-24 22:50:54', '2023-01-24 22:50:54'),
(275, 'maximum_chunk_size', '2023-01-24 22:50:54', '2023-01-24 22:50:54'),
(276, 'site_title', '2023-01-24 22:50:57', '2023-01-24 22:50:57'),
(277, 'site_meta_title', '2023-01-24 22:50:57', '2023-01-24 22:50:57'),
(278, 'site_meta_description', '2023-01-24 22:50:57', '2023-01-24 22:50:57'),
(279, 'site_meta_keywords', '2023-01-24 22:50:57', '2023-01-24 22:50:57'),
(280, 'site_meta_image', '2023-01-24 22:50:57', '2023-01-24 22:50:57'),
(281, 'default_language', '2023-01-24 22:50:57', '2023-01-24 22:50:57'),
(282, 'system_name', '2023-01-24 22:51:24', '2023-01-24 22:51:24'),
(286, 'default_timezone', '2023-01-24 22:51:24', '2023-01-24 22:51:24'),
(287, 'date_format', '2023-01-24 22:51:24', '2023-01-24 22:51:24'),
(288, 'decimal_number_limit', '2023-01-24 22:51:24', '2023-01-24 22:51:24'),
(291, 'default_currency', '2023-01-24 22:51:24', '2023-01-24 22:51:24'),
(292, 'copyright_text', '2023-01-24 22:51:24', '2023-01-24 22:51:24'),
(305, 'google_client_id', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(306, 'google_client_secret', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(307, 'facebook_app_id', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(308, 'facebook_app_secret', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(309, 'twitter_client_id', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(310, 'twitter_client_secret', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(311, 'chunk_size_upload_status', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(312, 'watermark_status', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(313, 'watermark_image', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(314, 'watermark_image_position', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(315, 'water_marking_image_size', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(316, 'water_marking_image_opacity', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(317, 'water_marking_image_position_x', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(318, 'water_marking_image_position_y', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(319, 'large_thumb_image_width', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(320, 'large_thumb_image_height', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(321, 'medium_thumb_image_width', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(322, 'medium_thumb_image_height', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(323, 'small_thumb_image_width', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(324, 'small_thumb_image_height', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(325, 'default_comment_status', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(326, 'require_name_email', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(327, 'comment_registration', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(328, 'close_comments_for_old_blogs', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(329, 'thread_comments', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(330, 'page_comments', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(331, 'comments_notify_email', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(332, 'comments_moderation_notify_email', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(333, 'comment_moderation', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(334, 'comment_previously_approved', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(335, 'show_avatars', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(336, 'close_comments_days_old', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(337, 'thread_comments_level', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(338, 'comments_per_page', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(339, 'comment_order', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(340, 'comment_max_links', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(341, 'comment_moderation_keys', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(342, 'comment_disallowed_keys', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(343, 'avatar_default', '2023-01-24 22:51:25', '2023-01-24 22:51:25'),
(344, 'admin_logo', '2023-01-25 00:09:30', '2023-01-25 00:09:30'),
(345, 'admin_mobile_logo', '2023-01-25 00:09:30', '2023-01-25 00:09:30'),
(346, 'admin_dark_logo', '2023-01-25 00:09:30', '2023-01-25 00:09:30'),
(347, 'admin_dark_mobile_logo', '2023-01-25 00:09:30', '2023-01-25 00:09:30'),
(348, 'black_background_logo', '2023-02-04 20:36:34', '2023-02-04 20:36:34'),
(349, 'white_background_logo', '2023-02-04 20:36:34', '2023-02-04 20:36:34'),
(350, 'favicon', '2023-02-04 20:36:34', '2023-02-04 20:36:34'),
(351, 'black_mobile_background_logo', '2023-02-04 20:36:34', '2023-02-04 20:36:34'),
(352, 'white_mobile_background_logo', '2023-02-04 20:36:34', '2023-02-04 20:36:34'),
(353, 'sticky_mobile_background_logo', '2023-02-04 20:36:34', '2023-02-04 20:36:34'),
(354, 'sticky_background_logo', '2023-02-04 20:36:34', '2023-02-04 20:36:34'),
(355, 'sticky_black_mobile_background_logo', '2023-02-04 20:36:34', '2023-02-04 20:36:34'),
(356, 'sticky_black_background_logo', '2023-02-04 20:36:34', '2023-02-04 20:36:34'),
(357, 'site_moto', '2023-03-02 21:24:10', '2023-03-02 21:24:10'),
(358, 'site_motto', '2023-03-20 00:42:26', '2023-03-20 00:42:26');

-- --------------------------------------------------------

--
-- Table structure for table `tl_general_settings_has_values`
--

CREATE TABLE `tl_general_settings_has_values` (
  `id` int(11) NOT NULL,
  `settings_id` int(11) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_general_settings_has_values`
--

INSERT INTO `tl_general_settings_has_values` (`id`, `settings_id`, `value`, `created_at`, `updated_at`) VALUES
(1366, 288, '2', '2023-01-29 12:37:16', '2023-01-29 12:37:16'),
(1619, 276, NULL, '2023-02-08 21:57:26', '2023-03-02 21:27:18'),
(1620, 277, NULL, '2023-02-08 21:57:26', '2023-05-11 05:35:57'),
(1621, 278, NULL, '2023-02-08 21:57:26', '2023-05-11 05:35:57'),
(1622, 279, NULL, '2023-02-08 21:57:26', '2023-05-11 05:35:57'),
(1623, 280, NULL, '2023-02-08 21:57:26', '2023-05-11 05:35:57'),
(2078, 313, '552', '2023-04-30 08:56:20', '2023-04-30 08:56:20'),
(2079, 314, 'center', '2023-04-30 08:56:20', '2023-04-30 08:56:20'),
(2080, 316, '50', '2023-04-30 08:56:20', '2023-04-30 08:56:20'),
(2107, 357, NULL, '2023-05-10 10:36:45', '2023-05-10 10:36:45'),
(2108, 349, NULL, '2023-05-10 10:36:45', '2023-05-10 10:36:45'),
(2109, 352, NULL, '2023-05-10 10:36:45', '2023-05-10 10:36:45'),
(2110, 348, NULL, '2023-05-10 10:36:45', '2023-05-10 10:36:45'),
(2111, 351, NULL, '2023-05-10 10:36:45', '2023-05-10 10:36:45'),
(2112, 354, NULL, '2023-05-10 10:36:45', '2023-05-10 10:36:45'),
(2113, 353, NULL, '2023-05-10 10:36:45', '2023-05-10 10:36:45'),
(2114, 356, NULL, '2023-05-10 10:36:45', '2023-05-10 10:36:45'),
(2115, 355, NULL, '2023-05-10 10:36:45', '2023-05-10 10:36:45'),
(2116, 344, NULL, '2023-05-10 10:36:45', '2023-05-10 10:36:45'),
(2117, 345, NULL, '2023-05-10 10:36:45', '2023-05-10 10:36:45'),
(2118, 346, NULL, '2023-05-10 10:36:45', '2023-05-10 10:36:45'),
(2119, 347, NULL, '2023-05-10 10:36:45', '2023-05-10 10:36:45'),
(2120, 350, NULL, '2023-05-10 10:36:45', '2023-05-10 10:36:45'),
(2121, 281, '1', '2023-05-10 10:36:45', '2023-05-10 10:36:45'),
(2122, 286, 'Asia/Dhaka', '2023-05-10 10:36:45', '2023-05-10 10:36:45'),
(2123, 292, 'Copyright @2023. Themelooks', '2023-05-10 10:36:45', '2023-05-10 10:36:45'),
(2124, 274, '1041', '2023-05-10 11:04:51', '2023-05-10 11:04:51'),
(2125, 319, '700', '2023-05-10 11:04:51', '2023-05-10 11:04:51'),
(2126, 320, '600', '2023-05-10 11:04:51', '2023-05-10 11:04:51'),
(2127, 321, '500', '2023-05-10 11:04:51', '2023-05-10 11:04:51'),
(2128, 322, '270', '2023-05-10 11:04:51', '2023-05-10 11:04:51'),
(2129, 323, '60', '2023-05-10 11:04:51', '2023-05-10 11:04:51'),
(2130, 324, '60', '2023-05-10 11:04:51', '2023-05-10 11:04:51'),
(2131, 325, '1', '2023-05-10 12:18:26', '2023-05-10 12:18:26'),
(2132, 326, '0', '2023-05-10 12:18:26', '2023-05-10 12:18:26'),
(2133, 327, '0', '2023-05-10 12:18:26', '2023-05-10 12:18:26'),
(2134, 328, '0', '2023-05-10 12:18:26', '2023-05-10 12:18:26'),
(2135, 329, '0', '2023-05-10 12:18:26', '2023-05-10 12:18:26'),
(2136, 330, '1', '2023-05-10 12:18:26', '2023-05-10 12:18:26'),
(2137, 331, '0', '2023-05-10 12:18:26', '2023-05-10 12:18:26'),
(2138, 332, '0', '2023-05-10 12:18:26', '2023-05-10 12:18:26'),
(2139, 333, '0', '2023-05-10 12:18:26', '2023-05-10 12:18:26'),
(2140, 334, '0', '2023-05-10 12:18:26', '2023-05-10 12:18:26'),
(2141, 335, '1', '2023-05-10 12:18:26', '2023-05-10 12:18:26'),
(2142, 336, '1', '2023-05-10 12:18:26', '2023-05-10 12:18:26'),
(2143, 337, '2', '2023-05-10 12:18:26', '2023-05-10 12:18:26'),
(2144, 338, '8', '2023-05-10 12:18:26', '2023-05-10 12:18:26'),
(2145, 339, '1', '2023-05-10 12:18:26', '2023-05-10 12:18:26'),
(2146, 340, '1', '2023-05-10 12:18:26', '2023-05-10 12:18:26'),
(2147, 341, NULL, '2023-05-10 12:18:26', '2023-05-10 12:18:26'),
(2148, 342, NULL, '2023-05-10 12:18:26', '2023-05-10 12:18:26'),
(2149, 343, 'mystery', '2023-05-10 12:18:26', '2023-05-10 12:18:26'),
(2151, 282, 'CMSLooks', '2023-05-21 06:08:52', '2023-05-21 06:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `tl_languages`
--

CREATE TABLE `tl_languages` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `native_name` varchar(50) NOT NULL DEFAULT '',
  `code` varchar(50) NOT NULL DEFAULT '0',
  `flag` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `is_rtl` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_languages`
--

INSERT INTO `tl_languages` (`id`, `name`, `native_name`, `code`, `flag`, `status`, `is_rtl`, `created_at`, `updated_at`) VALUES
(1, 'English', 'English', 'en', NULL, 1, 2, '2022-05-30 09:53:37', '2022-07-26 04:17:44'),
(18, 'Bengali', 'বাংলা', 'bd', NULL, 1, 0, '2023-02-05 20:43:50', '2023-05-10 12:21:31'),
(19, 'Arabic', 'عربي', 'sa', NULL, 1, 1, '2023-02-05 20:50:23', '2023-04-02 10:08:58');

-- --------------------------------------------------------

--
-- Table structure for table `tl_media_type`
--

CREATE TABLE `tl_media_type` (
  `id` int(11) NOT NULL,
  `name` varchar(510) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_media_type`
--

INSERT INTO `tl_media_type` (`id`, `name`) VALUES
(1, 'Stuffs'),
(2, 'Products'),
(3, 'System'),
(4, 'Media Settings');

-- --------------------------------------------------------

--
-- Table structure for table `tl_menus`
--

CREATE TABLE `tl_menus` (
  `id` int(11) NOT NULL,
  `menu_group_id` int(11) DEFAULT NULL,
  `index` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `menu_type_id` int(11) DEFAULT NULL,
  `menu_type` varchar(150) DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT 0,
  `title` varchar(150) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `target` int(11) DEFAULT 1,
  `icon` text DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `content` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_menus`
--

INSERT INTO `tl_menus` (`id`, `menu_group_id`, `index`, `parent_id`, `post_id`, `category_id`, `page_id`, `menu_type_id`, `menu_type`, `level`, `title`, `url`, `target`, `icon`, `location`, `content`, `created_at`, `updated_at`) VALUES
(451, 21, 1, 0, NULL, NULL, NULL, NULL, NULL, 1, 'Payment Method', '#', 1, ' ', NULL, NULL, '2023-01-29 05:13:21', '2023-01-29 05:13:21'),
(452, 21, 2, 0, NULL, NULL, NULL, NULL, NULL, 1, 'How to Shop', '#', 1, ' ', NULL, NULL, '2023-01-29 05:13:28', '2023-01-29 05:13:28'),
(453, 21, 3, 0, NULL, NULL, NULL, NULL, NULL, 1, 'Terms And Conditions', '#', 1, ' ', NULL, NULL, '2023-01-29 05:13:37', '2023-01-29 05:13:37'),
(454, 21, 4, 0, NULL, NULL, NULL, NULL, NULL, 1, 'Privacy Policy', '#', 1, ' ', NULL, NULL, '2023-01-29 05:13:44', '2023-01-29 05:13:44'),
(455, 21, 5, 0, NULL, NULL, NULL, NULL, NULL, 1, 'Returns', '#', 1, ' ', NULL, NULL, '2023-01-29 05:13:50', '2023-01-29 05:13:50'),
(456, 22, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, 'My Account', '#', 1, ' ', NULL, NULL, '2023-01-29 05:14:03', '2023-01-29 05:14:03'),
(457, 22, 1, 0, NULL, NULL, NULL, NULL, NULL, 1, 'Order Tracking', '#', 1, ' ', NULL, NULL, '2023-01-29 05:14:09', '2023-01-29 05:14:09'),
(458, 22, 2, 0, NULL, NULL, NULL, NULL, NULL, 1, 'Contact Us', '#', 1, ' ', NULL, NULL, '2023-01-29 05:14:15', '2023-01-29 05:14:15'),
(459, 22, 3, 0, NULL, NULL, NULL, NULL, NULL, 1, 'Customer Services', '#', 1, ' ', NULL, NULL, '2023-01-29 05:14:21', '2023-01-29 05:14:21'),
(460, 22, 4, 0, NULL, NULL, NULL, NULL, NULL, 1, 'FAQs', '#', 1, ' ', NULL, NULL, '2023-01-29 05:14:27', '2023-01-29 05:14:27'),
(461, 22, 5, 0, NULL, NULL, NULL, NULL, NULL, 1, 'Help Desk', '#', 1, ' ', NULL, NULL, '2023-01-29 05:14:33', '2023-01-29 05:14:33'),
(464, 24, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, 'Trending Offers', '/collection/15?collection=trending-offers', 1, ' ', NULL, NULL, '2023-01-29 05:49:16', '2023-02-26 22:56:32'),
(465, 24, 1, 0, NULL, NULL, NULL, NULL, NULL, 1, 'Top Fashion', '/collection/16?collection=top-picks-on-clothing', 1, ' ', NULL, NULL, '2023-01-29 05:49:26', '2023-02-26 22:57:09'),
(466, 24, 2, 0, NULL, NULL, NULL, NULL, NULL, 1, 'Adidas Cap', '/products/black-adidas-cotton-cap-for-men-cap', 1, ' ', NULL, NULL, '2023-01-29 05:49:35', '2023-02-26 22:57:54'),
(467, 25, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, 'Home', '/', 1, ' ', NULL, NULL, '2023-01-29 05:51:03', '2023-02-05 17:52:43'),
(468, 25, 1, 0, NULL, NULL, NULL, NULL, NULL, 1, 'All Products', '/products', 1, ' ', NULL, NULL, '2023-01-29 05:51:12', '2023-03-01 14:59:49'),
(474, 25, 6, 0, NULL, NULL, NULL, NULL, NULL, 1, 'Compare', '#', 1, ' ', NULL, NULL, '2023-01-29 05:52:10', '2023-02-26 21:44:03'),
(475, 25, 2, 0, NULL, NULL, NULL, NULL, NULL, 1, 'Flash Sale', '/deals/flash-deals', 1, NULL, NULL, NULL, '2023-02-26 21:41:04', '2023-02-26 21:42:27'),
(476, 25, 3, 0, NULL, NULL, NULL, NULL, NULL, 1, 'Blogs', '/blog', 1, NULL, NULL, NULL, '2023-02-26 21:41:31', '2023-02-26 21:42:27'),
(477, 25, 4, 0, NULL, NULL, NULL, NULL, NULL, 1, 'All Categories', '/categories', 1, NULL, NULL, NULL, '2023-02-26 21:42:17', '2023-02-26 21:42:27'),
(478, 25, 5, 0, NULL, NULL, NULL, NULL, NULL, 1, 'Men\'s Fashion', '/products/category/mens-fashion', 1, NULL, NULL, NULL, '2023-02-26 21:44:00', '2023-02-27 19:53:31'),
(486, 23, 0, 0, NULL, NULL, NULL, 161, 'post', 1, 'Fruits and Vegetables', '/blog/12-fruits-and-vegetables-to-buy-organic-in-2023', 1, NULL, NULL, NULL, '2023-02-27 20:04:02', '2023-02-28 06:16:19'),
(487, 23, 1, 0, NULL, NULL, NULL, NULL, NULL, 1, 'Electronic Device', '/products/category/electronic-devices', 1, NULL, NULL, NULL, '2023-02-27 20:05:57', '2023-02-27 20:05:57'),
(489, 26, 0, 0, NULL, NULL, NULL, NULL, NULL, 1, 'Home', '/', 1, NULL, NULL, NULL, '2023-03-21 23:53:25', '2023-05-10 11:45:22'),
(490, 26, 1, 0, NULL, NULL, NULL, NULL, NULL, 1, 'Blogs', '/blogs', 1, NULL, NULL, NULL, '2023-03-21 23:53:54', '2023-05-10 11:23:43'),
(494, 22, 6, 461, NULL, NULL, NULL, 281, 'category', 2, 'Shop', '/blog/category/shop', 1, NULL, NULL, NULL, '2023-03-22 00:19:24', '2023-03-22 00:19:27'),
(495, 22, 7, 494, NULL, NULL, NULL, 280, 'category', 3, 'Travel', '/blog/category/travel', 1, NULL, NULL, NULL, '2023-03-22 00:19:24', '2023-03-22 00:19:29'),
(496, 22, 8, 495, NULL, NULL, NULL, 279, 'category', 4, 'Flower', '/blog/category/flower', 1, NULL, NULL, NULL, '2023-03-22 00:19:24', '2023-03-22 00:19:30'),
(502, 27, 0, 0, NULL, NULL, NULL, 281, 'category', 1, 'Shop', '/blog/category/shop', 1, NULL, NULL, NULL, '2023-05-09 10:33:03', '2023-05-09 10:33:03'),
(503, 27, 1, 0, NULL, NULL, NULL, 181, 'post', 1, 'New Blog is Here', '/blog/new-blog-is-here', 1, NULL, NULL, NULL, '2023-05-09 10:33:06', '2023-05-09 10:33:06'),
(504, 27, 2, 0, NULL, NULL, NULL, 9, 'page', 1, 'About', '/page/about', 1, NULL, NULL, NULL, '2023-05-09 10:33:09', '2023-05-09 10:33:09'),
(505, 27, 3, 0, NULL, NULL, NULL, 110, 'tag', 1, 't-shirt', '/blog/tag/t-shirt', 1, NULL, NULL, NULL, '2023-05-09 10:33:12', '2023-05-09 10:33:12'),
(506, 27, 4, 0, NULL, NULL, NULL, NULL, NULL, 1, 'Hello How are you doing', 'base path', 1, NULL, NULL, NULL, '2023-05-09 10:33:35', '2023-05-09 10:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `tl_menu_groups`
--

CREATE TABLE `tl_menu_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_menu_groups`
--

INSERT INTO `tl_menu_groups` (`id`, `name`, `created_at`, `updated_at`) VALUES
(26, 'Header Menu', '2023-03-21 23:53:13', '2023-03-21 23:53:13'),
(27, 'New Menu', '2023-05-09 10:32:53', '2023-05-09 10:32:53');

-- --------------------------------------------------------

--
-- Table structure for table `tl_menu_groups_translations`
--

CREATE TABLE `tl_menu_groups_translations` (
  `id` int(11) NOT NULL,
  `menu_group_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `lang` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_menu_groups_translations`
--

INSERT INTO `tl_menu_groups_translations` (`id`, `menu_group_id`, `name`, `lang`, `created_at`, `updated_at`) VALUES
(8, 21, 'Our Policies', 'en', '2023-01-29 05:13:03', '2023-01-29 05:13:03'),
(9, 24, 'Header Top Left Menus', 'en', '2023-01-29 05:49:46', '2023-01-29 05:49:46'),
(10, 23, 'Header Top Right Menus', 'en', '2023-01-29 05:49:55', '2023-01-29 05:49:55'),
(11, 25, 'Header Middle Menus', 'en', '2023-01-29 05:52:15', '2023-01-29 05:52:15');

-- --------------------------------------------------------

--
-- Table structure for table `tl_menu_group_has_positon`
--

CREATE TABLE `tl_menu_group_has_positon` (
  `id` int(11) NOT NULL,
  `menu_group_id` int(11) DEFAULT NULL,
  `menu_position_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_menu_group_has_positon`
--

INSERT INTO `tl_menu_group_has_positon` (`id`, `menu_group_id`, `menu_position_id`, `created_at`, `updated_at`) VALUES
(110, 24, 3, '2023-01-29 11:49:46', NULL),
(111, 23, 2, '2023-01-29 11:49:55', NULL),
(114, 22, 1, '2023-03-18 04:30:37', NULL),
(119, 26, 5, '2023-05-10 09:42:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tl_menu_items`
--

CREATE TABLE `tl_menu_items` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `template` varchar(150) DEFAULT NULL,
  `plugin_location` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_menu_items`
--

INSERT INTO `tl_menu_items` (`id`, `name`, `template`, `plugin_location`) VALUES
(1, 'Product Categories', 'plugin/tlecommercecore::menu.include.product_category_menu_item', 'tlecommercecore');

-- --------------------------------------------------------

--
-- Table structure for table `tl_menu_positions`
--

CREATE TABLE `tl_menu_positions` (
  `id` int(11) NOT NULL,
  `position` varchar(150) DEFAULT NULL,
  `theme_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_menu_positions`
--

INSERT INTO `tl_menu_positions` (`id`, `position`, `theme_id`, `created_at`, `updated_at`) VALUES
(1, 'Header Bottom Middle Menu', 15, '2023-01-29 02:33:03', '2023-03-22 05:31:42'),
(2, 'Header Top Right Menu', 15, '2023-01-29 02:33:03', '2023-01-29 02:33:03'),
(3, 'Header Top Left Menu', 15, '2023-01-29 02:33:03', '2023-01-29 02:33:03'),
(5, 'Header Menu', 16, '2023-03-21 23:39:53', '2023-03-21 23:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `tl_menu_translations`
--

CREATE TABLE `tl_menu_translations` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `lang` varchar(150) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_menu_translations`
--

INSERT INTO `tl_menu_translations` (`id`, `menu_id`, `lang`, `name`, `created_at`, `updated_at`) VALUES
(11, 467, 'en', 'Home', '2023-02-05 17:52:43', '2023-02-05 17:52:43'),
(12, 468, 'en', 'Product', '2023-02-05 17:52:54', '2023-02-05 17:52:54'),
(14, 450, 'bd', 'শিপিং এবং ডেলিভারি', '2023-02-11 17:01:49', '2023-02-12 14:51:35'),
(15, 451, 'bd', 'পেমেন্ট পদ্ধতি', '2023-02-11 17:02:11', '2023-02-12 14:51:49'),
(16, 452, 'bd', 'কিভাবে কেনাকাটা', '2023-02-11 17:02:37', '2023-02-11 17:02:37'),
(17, 453, 'bd', 'শর্তাবলী', '2023-02-11 17:02:59', '2023-02-11 17:02:59'),
(18, 454, 'bd', 'গোপনীয়তা নীতি', '2023-02-11 17:03:10', '2023-02-11 17:03:10'),
(19, 455, 'bd', 'রিটার্নস', '2023-02-11 17:03:20', '2023-02-11 17:03:20'),
(20, 450, 'sa', 'الشحن والتسليم', '2023-02-11 17:03:39', '2023-02-11 17:03:39'),
(21, 451, 'sa', 'طريقة الدفع او السداد', '2023-02-11 17:03:56', '2023-02-11 17:03:56'),
(22, 452, 'sa', 'كيف تتسوق', '2023-02-11 17:04:08', '2023-02-11 17:04:08'),
(23, 453, 'sa', 'الأحكام والشروط', '2023-02-11 17:04:19', '2023-02-11 17:04:19'),
(24, 454, 'sa', 'سياسة الخصوصية', '2023-02-11 17:04:28', '2023-02-11 17:04:28'),
(25, 455, 'sa', 'عائدات', '2023-02-11 17:04:38', '2023-02-11 17:04:38'),
(26, 456, 'bd', 'আমার অ্যাকাউন্ট', '2023-02-11 17:05:04', '2023-02-11 17:05:04'),
(27, 457, 'bd', 'অর্ডার ট্র্যাকিং', '2023-02-11 17:31:40', '2023-02-11 17:31:40'),
(28, 458, 'bd', 'যোগাযোগ করুন', '2023-02-11 17:32:32', '2023-02-11 17:32:32'),
(29, 459, 'bd', 'গ্রাহক সেবা', '2023-02-11 17:32:48', '2023-02-11 17:32:48'),
(30, 461, 'bd', 'সাহায্য ডেস্ক', '2023-02-11 17:33:18', '2023-02-11 17:33:18'),
(31, 456, 'sa', 'حسابي', '2023-02-11 17:33:42', '2023-02-11 17:33:42'),
(32, 457, 'sa', 'تتبع الطلب', '2023-02-11 17:33:52', '2023-02-11 17:33:52'),
(33, 458, 'sa', 'اتصل بنا', '2023-02-11 17:34:08', '2023-02-11 17:34:08'),
(34, 459, 'sa', 'خدمة العملاء', '2023-02-11 17:34:26', '2023-02-11 17:34:26'),
(35, 461, 'sa', 'مكتب المساعدة', '2023-02-11 17:34:38', '2023-02-11 17:34:38'),
(40, 464, 'bd', 'ট্রেন্ডিং অফার', '2023-02-11 17:39:32', '2023-02-26 22:58:33'),
(41, 465, 'bd', 'শীর্ষ ফ্যাশন', '2023-02-11 17:39:47', '2023-02-26 22:59:09'),
(42, 466, 'bd', 'অ্যাডিডাস ক্যাপ', '2023-02-11 17:39:57', '2023-02-26 22:59:28'),
(43, 464, 'sa', 'العرض الشائع', '2023-02-11 17:40:12', '2023-02-26 23:00:16'),
(44, 465, 'sa', 'أعلى أزياء', '2023-02-11 17:40:27', '2023-02-26 23:00:01'),
(45, 466, 'sa', 'أديداس كاب', '2023-02-11 17:40:38', '2023-02-26 22:59:46'),
(46, 467, 'bd', 'হোম', '2023-02-11 17:41:30', '2023-02-12 14:52:50'),
(47, 468, 'bd', 'সকল পণ্য', '2023-02-11 17:41:56', '2023-03-01 15:00:10'),
(53, 474, 'bd', 'তুলনা করা', '2023-02-11 19:16:38', '2023-02-11 19:16:38'),
(54, 467, 'sa', 'بيت', '2023-02-11 19:16:55', '2023-02-11 19:16:55'),
(55, 468, 'sa', 'منتج', '2023-02-11 19:17:06', '2023-02-11 19:17:06'),
(61, 474, 'sa', 'يقارن', '2023-02-11 19:18:21', '2023-02-11 19:18:21'),
(66, 475, 'bd', 'ফ্ল্যাশ বিক্রয়', '2023-02-26 23:01:56', '2023-02-26 23:01:56'),
(67, 476, 'bd', 'ব্লগ', '2023-02-26 23:02:08', '2023-02-26 23:02:08'),
(68, 477, 'bd', 'সব ক্যাটেগরীজ', '2023-02-26 23:02:43', '2023-02-26 23:02:43'),
(69, 478, 'bd', 'পুরুষদের ফ্যাশন', '2023-02-26 23:02:55', '2023-02-26 23:02:55'),
(70, 478, 'sa', 'أزياء رجالية', '2023-02-26 23:03:13', '2023-02-26 23:03:13'),
(71, 477, 'sa', 'جميع الفئات', '2023-02-26 23:03:26', '2023-02-26 23:03:26'),
(72, 476, 'sa', 'المدونات', '2023-02-26 23:03:37', '2023-02-26 23:03:37'),
(73, 475, 'sa', 'بيع مفاجئ', '2023-02-26 23:03:49', '2023-02-26 23:03:49'),
(74, 486, 'bd', 'ফল এবং শাকসবজি', '2023-02-27 20:04:41', '2023-02-27 20:04:41'),
(75, 486, 'sa', 'فواكه وخضراوات', '2023-02-27 20:04:54', '2023-02-27 20:04:54'),
(76, 487, 'bd', 'ইলেকট্রনিক যন্ত্র', '2023-02-27 20:06:36', '2023-02-27 20:06:36'),
(77, 487, 'sa', 'جهاز الكتروني', '2023-02-27 20:06:48', '2023-02-27 20:06:48'),
(78, 489, 'bd', 'বাড়ি', '2023-04-03 06:56:47', '2023-04-03 06:56:47'),
(79, 490, 'bd', 'ব্লগ', '2023-04-03 06:57:04', '2023-04-03 06:57:04'),
(80, 491, 'bd', 'প্রযুক্তি', '2023-04-03 06:57:14', '2023-04-03 06:57:14'),
(81, 492, 'bd', 'পিসি তৈরি', '2023-04-03 06:57:24', '2023-04-09 07:26:54'),
(82, 493, 'bd', 'গোপনীয়তা নীতি', '2023-04-03 06:57:40', '2023-04-03 06:57:40'),
(83, 489, 'sa', 'بيت', '2023-04-08 08:21:53', '2023-04-08 08:21:53'),
(84, 490, 'sa', 'المدونات', '2023-04-08 08:22:03', '2023-04-08 08:22:03'),
(85, 491, 'sa', 'تقنية', '2023-04-08 08:22:16', '2023-04-08 08:22:16'),
(86, 492, 'sa', 'بناء جهاز كمبيوتر', '2023-04-08 08:22:33', '2023-04-08 08:22:33'),
(87, 493, 'sa', 'سياسة الخصوصية', '2023-04-08 08:22:54', '2023-04-08 08:22:54'),
(88, 500, 'bd', 'পিসি তৈরি', '2023-04-13 09:12:20', '2023-04-13 09:12:20'),
(89, 500, 'sa', 'بناء الكمبيوتر', '2023-04-13 09:12:33', '2023-04-13 09:12:33'),
(90, 501, 'bd', 'সম্পর্কিত', '2023-05-02 04:40:01', '2023-05-02 04:40:01'),
(91, 501, 'sa', 'عن', '2023-05-02 04:40:17', '2023-05-02 04:40:17');

-- --------------------------------------------------------

--
-- Table structure for table `tl_pages`
--

CREATE TABLE `tl_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `permalink` text DEFAULT NULL,
  `page_image` text DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `content` longtext DEFAULT NULL,
  `visibility` varchar(255) DEFAULT NULL,
  `page_password` longtext DEFAULT NULL,
  `publish_at` datetime DEFAULT NULL,
  `parent` bigint(20) UNSIGNED DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_image` text DEFAULT NULL,
  `page_template` bigint(20) DEFAULT NULL,
  `order` bigint(20) DEFAULT NULL,
  `publish_status` smallint(6) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_pages`
--

INSERT INTO `tl_pages` (`id`, `title`, `permalink`, `page_image`, `user_id`, `content`, `visibility`, `page_password`, `publish_at`, `parent`, `meta_title`, `meta_description`, `meta_image`, `page_template`, `order`, `publish_status`, `created_at`, `updated_at`) VALUES
(1, 'Privacy Policy', 'privacy-policy', NULL, 1, '<section id=\"introduction\" class=\"section-block\" style=\"color: rgb(102, 102, 102); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">Introduction:</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">we comprehend that security online is vital to clients of our website, particularly while leading a business. this assertion oversees our protection arrangements regarding those users of the site (guests) who visit without executing business and visitors who register to execute business on the site and utilize the different administrations presented by this application (collectively, services) (authorized customers).</p></section><section id=\"personal_data\" class=\"section-block\" style=\"color: rgb(102, 102, 102);  margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">Personally Identifiable Information</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">refers to any information that identifies or can be used to identify, contact, or locate the person to whom such information relates, including, however not limited to, name, address, phone number, fax number, email address, financial profiles, social security number, and credit card information. actually, recognizable information does exclude information that is collected anonymously (that is, without identification of the individual user) or demographic information not associated with a recognized person.</p></section><section id=\"infos\" class=\"section-block\" style=\"color: rgb(102, 102, 102);  margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">What Personally Identifiable Information is collected?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">we might collect primary user profile information from all of our visitors. we collect the following extra information from our authorized customers: the names, addresses, phone numbers, and email addresses of authorized customers, the nature and size of the business, and the nature and size of the advertisement stock that the authorized customer intends to buy or sell.</p></section><section id=\"orgs\" class=\"section-block\" style=\"color: rgb(102, 102, 102); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">What organizations are collecting the information?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">notwithstanding our immediate assortment of information, our third-party service vendors (such as credit card companies, clearinghouses, and banks) who may provide such types of services as credit, insurance, and escrow services may collect this information from our visitors and authorized customers. we don\'t control how these third parties use such information, but we do ask them to disclose how they use personal information provided to them by visitors and authorized customers. a portion of these third parties may be mediators that act solely as links in the distribution chain and do not store, retain, or use the information given to them.</p></section><section id=\"usage\" class=\"section-block\" style=\"color: rgb(102, 102, 102); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">How does the Site use Personally Identifiable Information?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">we use privately identifiable information to customize the site, make appropriate service offerings, and fulfill buying and selling recommendations on the site. we may email visitors and authorized customers about research or purchase and selling opportunities on the site or information related to the topic matter of the site. we may also use personally identifiable information to contact visitors and authorized customers in response to specific inquiries or to provide requested information.</p></section><section id=\"sharing\" class=\"section-block\" style=\"color: rgb(102, 102, 102);  margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">With whom may the information may be shared?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">personally identifiable information about authorized customers might be imparted to other authorized customers who wish to evaluate potential transactions with other authorized customers. we might share aggregated information about our visitors, including the demographics of our visitors and authorized customers, with our affiliated agencies and third-party vendors. we additionally offer the opportunity to \"opt-out\" of getting information or being contacted by us or by any agency acting on our behalf.</p></section><section id=\"storing\" class=\"section-block\" style=\"color: rgb(102, 102, 102); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">How is Personally Identifiable Information stored?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">personally identifiable information collected by this app is safely stored and is not accessible to third parties or employees of this app except for use as shown previously.</p></section><section id=\"choices\" class=\"section-block\" style=\"color: rgb(102, 102, 102); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">What options are available to Visitors regarding the exhibition, use, and dissemination of the information?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">visitors and authorized customers might quit getting spontaneous information from or being contacted by us and/or our vendors and affiliated agencies by replying to emails as instructed, or by contacting us.</p></section><section id=\"cookie_policy\" class=\"section-block\" style=\"color: rgb(102, 102, 102); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">Are Cookies Used on the Site?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">cookies are used for various reasons. we use cookies to acquire information about the preferences of our visitors and the services they select. we also use cookies for security purposes to safeguard our authorized customers. for instance, if an authorized customer is signed on and the site is unused, the system may automatically log the authorized customer off.</p></section><section id=\"login_info\" class=\"section-block\" style=\"color: rgb(102, 102, 102); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">How does This APP use login information?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">this app uses login information, including, but not limited to, ip addresses, isps, and browser types, to analyze trends, administer the site, track a user’s movement and use, and accumulate broad demographic information.</p></section><section id=\"partners\" class=\"section-block\" style=\"color: rgb(102, 102, 102); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">What partners or service providers have access to Personally Recognizable Information from Visitors and/or Authorized Customers on the Site?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">this app has entered into and will continue to enter into partnerships and other affiliations with a number of vendors. such vendors may have access to certain personally identifiable information on a need-to-know basis for evaluating authorized customers for service eligibility. our privacy policy does not cover their collection or use of this information. disclosure of personally identifiable information to comply with the law. we will reveal personally identifiable information in order to comply with a court order or subpoena or request from a law enforcement agency to release information. we will also uncover personally identifiable information when reasonably necessary to protect the safeguard of our visitors and authorized customers.</p></section><section id=\"keepsafe\" class=\"section-block\" style=\"color: rgb(102, 102, 102);  margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">How does the Site keep Personally Identifiable Information secure?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">our representatives are all acquainted with our security policy and practices. the personally identifiable information of our visitors and authorized customers is only accessible to a predetermined number of qualified employees who are given a password in order to achieve access to the information. we review our security systems and processes on cycles consistently. sensitive information, for example, credit card numbers or social security numbers, is protected by encryption protocols, in place to protect information sent over the internet. while we take commercially reasonable measures to maintain a secure site, electronic communications and databases are subject to errors, tampering, and break-ins, and we cannot guarantee or warrant that such events won\'t take place and we will not be liable to visitors or authorized customers for any such occurrences.</p></section><section id=\"correction\" class=\"section-block\" style=\"color: rgb(102, 102, 102); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">How can Visitors correct any inaccuracies in Personally Identifiable Information?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">visitors and authorized customers may messaging us to update personally identifiable information about them or to correct any inaccuracies by emailing us here.&nbsp;</p></section><section id=\"deletion\" class=\"section-block\" style=\"color: rgb(102, 102, 102); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">Can a Visitor delete or deactivate Personally Identifiable Information collected by the Site?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">we provide visitors and authorized customers with a mechanism to erase/deactivate personally identifiable information from the site’s database by contacting . nonetheless, because of backups and records of deletions, it may be impossible to delete a visitor’s entry without retaining some residual information. a person who requests to have personally identifiable information deactivated will have this information functionally deleted, and we won\'t sell, transfer, or use personally identifiable information relating to that individual in any way moving forward.</p></section><section id=\"changes\" class=\"section-block\" style=\"color: rgb(102, 102, 102); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">What happens if the Privacy Policy Changes?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">we will tell our visitors and authorized customers know about changes to our privacy policy by posting such changes on the site. nonetheless, assuming that we are changing our privacy policy in a manner that might cause disclosure of personally identifiable information that a visitor or authorized customer has previously requested not be disclosed, we will contact such visitor or authorized customer to permit such visitor or authorized customer to prevent such exposure.</p></section>', 'public', NULL, '2023-03-21 05:50:18', NULL, NULL, NULL, NULL, NULL, 0, 1, '2023-03-20 23:50:18', '2023-04-06 05:30:55');

-- --------------------------------------------------------

--
-- Table structure for table `tl_page_templates`
--

CREATE TABLE `tl_page_templates` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tl_page_translations`
--

CREATE TABLE `tl_page_translations` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `page_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lang` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_page_translations`
--

INSERT INTO `tl_page_translations` (`id`, `title`, `content`, `page_id`, `lang`, `created_at`, `updated_at`) VALUES
(1, 'গোপনীয়তা নীতি', '<section id=\"introduction\" class=\"section-block\" style=\"color: rgb(102, 102, 102); background-color: rgb(247, 248, 250); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">Introduction:</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">we comprehend that security online is vital to clients of our website, particularly while leading a business. this assertion oversees our protection arrangements regarding those users of the site (guests) who visit without executing business and visitors who register to execute business on the site and utilize the different administrations presented by this application (collectively, services) (authorized customers).</p></section><section id=\"personal_data\" class=\"section-block\" style=\"color: rgb(102, 102, 102); background-color: rgb(247, 248, 250); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">Personally Identifiable Information</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">refers to any information that identifies or can be used to identify, contact, or locate the person to whom such information relates, including, however not limited to, name, address, phone number, fax number, email address, financial profiles, social security number, and credit card information. actually, recognizable information does exclude information that is collected anonymously (that is, without identification of the individual user) or demographic information not associated with a recognized person.</p></section><section id=\"infos\" class=\"section-block\" style=\"color: rgb(102, 102, 102); background-color: rgb(247, 248, 250); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">What Personally Identifiable Information is collected?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">we might collect primary user profile information from all of our visitors. we collect the following extra information from our authorized customers: the names, addresses, phone numbers, and email addresses of authorized customers, the nature and size of the business, and the nature and size of the advertisement stock that the authorized customer intends to buy or sell.</p></section><section id=\"orgs\" class=\"section-block\" style=\"color: rgb(102, 102, 102); background-color: rgb(247, 248, 250); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">What organizations are collecting the information?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">notwithstanding our immediate assortment of information, our third-party service vendors (such as credit card companies, clearinghouses, and banks) who may provide such types of services as credit, insurance, and escrow services may collect this information from our visitors and authorized customers. we don\'t control how these third parties use such information, but we do ask them to disclose how they use personal information provided to them by visitors and authorized customers. a portion of these third parties may be mediators that act solely as links in the distribution chain and do not store, retain, or use the information given to them.</p></section><section id=\"usage\" class=\"section-block\" style=\"color: rgb(102, 102, 102); background-color: rgb(247, 248, 250); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">How does the Site use Personally Identifiable Information?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">we use privately identifiable information to customize the site, make appropriate service offerings, and fulfill buying and selling recommendations on the site. we may email visitors and authorized customers about research or purchase and selling opportunities on the site or information related to the topic matter of the site. we may also use personally identifiable information to contact visitors and authorized customers in response to specific inquiries or to provide requested information.</p></section><section id=\"sharing\" class=\"section-block\" style=\"color: rgb(102, 102, 102); background-color: rgb(247, 248, 250); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">With whom may the information may be shared?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">personally identifiable information about authorized customers might be imparted to other authorized customers who wish to evaluate potential transactions with other authorized customers. we might share aggregated information about our visitors, including the demographics of our visitors and authorized customers, with our affiliated agencies and third-party vendors. we additionally offer the opportunity to \"opt-out\" of getting information or being contacted by us or by any agency acting on our behalf.</p></section><section id=\"storing\" class=\"section-block\" style=\"color: rgb(102, 102, 102); background-color: rgb(247, 248, 250); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">How is Personally Identifiable Information stored?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">personally identifiable information collected by this app is safely stored and is not accessible to third parties or employees of this app except for use as shown previously.</p></section><section id=\"choices\" class=\"section-block\" style=\"color: rgb(102, 102, 102); background-color: rgb(247, 248, 250); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">What options are available to Visitors regarding the exhibition, use, and dissemination of the information?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">visitors and authorized customers might quit getting spontaneous information from or being contacted by us and/or our vendors and affiliated agencies by replying to emails as instructed, or by contacting us.</p></section><section id=\"cookie_policy\" class=\"section-block\" style=\"color: rgb(102, 102, 102); background-color: rgb(247, 248, 250); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">Are Cookies Used on the Site?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">cookies are used for various reasons. we use cookies to acquire information about the preferences of our visitors and the services they select. we also use cookies for security purposes to safeguard our authorized customers. for instance, if an authorized customer is signed on and the site is unused, the system may automatically log the authorized customer off.</p></section><section id=\"login_info\" class=\"section-block\" style=\"color: rgb(102, 102, 102); background-color: rgb(247, 248, 250); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">How does This APP use login information?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">this app uses login information, including, but not limited to, ip addresses, isps, and browser types, to analyze trends, administer the site, track a user’s movement and use, and accumulate broad demographic information.</p></section><section id=\"partners\" class=\"section-block\" style=\"color: rgb(102, 102, 102); background-color: rgb(247, 248, 250); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">What partners or service providers have access to Personally Recognizable Information from Visitors and/or Authorized Customers on the Site?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">this app has entered into and will continue to enter into partnerships and other affiliations with a number of vendors. such vendors may have access to certain personally identifiable information on a need-to-know basis for evaluating authorized customers for service eligibility. our privacy policy does not cover their collection or use of this information. disclosure of personally identifiable information to comply with the law. we will reveal personally identifiable information in order to comply with a court order or subpoena or request from a law enforcement agency to release information. we will also uncover personally identifiable information when reasonably necessary to protect the safeguard of our visitors and authorized customers.</p></section><section id=\"keepsafe\" class=\"section-block\" style=\"color: rgb(102, 102, 102); background-color: rgb(247, 248, 250); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">How does the Site keep Personally Identifiable Information secure?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">our representatives are all acquainted with our security policy and practices. the personally identifiable information of our visitors and authorized customers is only accessible to a predetermined number of qualified employees who are given a password in order to achieve access to the information. we review our security systems and processes on cycles consistently. sensitive information, for example, credit card numbers or social security numbers, is protected by encryption protocols, in place to protect information sent over the internet. while we take commercially reasonable measures to maintain a secure site, electronic communications and databases are subject to errors, tampering, and break-ins, and we cannot guarantee or warrant that such events won\'t take place and we will not be liable to visitors or authorized customers for any such occurrences.</p></section><section id=\"correction\" class=\"section-block\" style=\"color: rgb(102, 102, 102); background-color: rgb(247, 248, 250); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">How can Visitors correct any inaccuracies in Personally Identifiable Information?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">visitors and authorized customers may messaging us to update personally identifiable information about them or to correct any inaccuracies by emailing us here.&nbsp;</p></section><section id=\"deletion\" class=\"section-block\" style=\"color: rgb(102, 102, 102); background-color: rgb(247, 248, 250); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">Can a Visitor delete or deactivate Personally Identifiable Information collected by the Site?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">we provide visitors and authorized customers with a mechanism to erase/deactivate personally identifiable information from the site’s database by contacting . nonetheless, because of backups and records of deletions, it may be impossible to delete a visitor’s entry without retaining some residual information. a person who requests to have personally identifiable information deactivated will have this information functionally deleted, and we won\'t sell, transfer, or use personally identifiable information relating to that individual in any way moving forward.</p></section><section id=\"changes\" class=\"section-block\" style=\"color: rgb(102, 102, 102); background-color: rgb(247, 248, 250); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">What happens if the Privacy Policy Changes?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">we will tell our visitors and authorized customers know about changes to our privacy policy by posting such changes on the site. nonetheless, assuming that we are changing our privacy policy in a manner that might cause disclosure of personally identifiable information that a visitor or authorized customer has previously requested not be disclosed, we will contact such visitor or authorized customer to permit such visitor or authorized customer to prevent such exposure.</p></section>', 1, 'bd', '2023-04-03 05:39:15', '2023-04-03 05:39:15'),
(2, 'سياسة الخصوصية', '<section id=\"introduction\" class=\"section-block\" style=\"color: rgb(102, 102, 102); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">Introduction:</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">we comprehend that security online is vital to clients of our website, particularly while leading a business. this assertion oversees our protection arrangements regarding those users of the site (guests) who visit without executing business and visitors who register to execute business on the site and utilize the different administrations presented by this application (collectively, services) (authorized customers).</p></section><section id=\"personal_data\" class=\"section-block\" style=\"color: rgb(102, 102, 102);  margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">Personally Identifiable Information</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">refers to any information that identifies or can be used to identify, contact, or locate the person to whom such information relates, including, however not limited to, name, address, phone number, fax number, email address, financial profiles, social security number, and credit card information. actually, recognizable information does exclude information that is collected anonymously (that is, without identification of the individual user) or demographic information not associated with a recognized person.</p></section><section id=\"infos\" class=\"section-block\" style=\"color: rgb(102, 102, 102);  margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">What Personally Identifiable Information is collected?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">we might collect primary user profile information from all of our visitors. we collect the following extra information from our authorized customers: the names, addresses, phone numbers, and email addresses of authorized customers, the nature and size of the business, and the nature and size of the advertisement stock that the authorized customer intends to buy or sell.</p></section><section id=\"orgs\" class=\"section-block\" style=\"color: rgb(102, 102, 102); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">What organizations are collecting the information?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">notwithstanding our immediate assortment of information, our third-party service vendors (such as credit card companies, clearinghouses, and banks) who may provide such types of services as credit, insurance, and escrow services may collect this information from our visitors and authorized customers. we don\'t control how these third parties use such information, but we do ask them to disclose how they use personal information provided to them by visitors and authorized customers. a portion of these third parties may be mediators that act solely as links in the distribution chain and do not store, retain, or use the information given to them.</p></section><section id=\"usage\" class=\"section-block\" style=\"color: rgb(102, 102, 102); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">How does the Site use Personally Identifiable Information?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">we use privately identifiable information to customize the site, make appropriate service offerings, and fulfill buying and selling recommendations on the site. we may email visitors and authorized customers about research or purchase and selling opportunities on the site or information related to the topic matter of the site. we may also use personally identifiable information to contact visitors and authorized customers in response to specific inquiries or to provide requested information.</p></section><section id=\"sharing\" class=\"section-block\" style=\"color: rgb(102, 102, 102);  margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">With whom may the information may be shared?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">personally identifiable information about authorized customers might be imparted to other authorized customers who wish to evaluate potential transactions with other authorized customers. we might share aggregated information about our visitors, including the demographics of our visitors and authorized customers, with our affiliated agencies and third-party vendors. we additionally offer the opportunity to \"opt-out\" of getting information or being contacted by us or by any agency acting on our behalf.</p></section><section id=\"storing\" class=\"section-block\" style=\"color: rgb(102, 102, 102); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">How is Personally Identifiable Information stored?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">personally identifiable information collected by this app is safely stored and is not accessible to third parties or employees of this app except for use as shown previously.</p></section><section id=\"choices\" class=\"section-block\" style=\"color: rgb(102, 102, 102); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">What options are available to Visitors regarding the exhibition, use, and dissemination of the information?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">visitors and authorized customers might quit getting spontaneous information from or being contacted by us and/or our vendors and affiliated agencies by replying to emails as instructed, or by contacting us.</p></section><section id=\"cookie_policy\" class=\"section-block\" style=\"color: rgb(102, 102, 102); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">Are Cookies Used on the Site?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">cookies are used for various reasons. we use cookies to acquire information about the preferences of our visitors and the services they select. we also use cookies for security purposes to safeguard our authorized customers. for instance, if an authorized customer is signed on and the site is unused, the system may automatically log the authorized customer off.</p></section><section id=\"login_info\" class=\"section-block\" style=\"color: rgb(102, 102, 102); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">How does This APP use login information?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">this app uses login information, including, but not limited to, ip addresses, isps, and browser types, to analyze trends, administer the site, track a user’s movement and use, and accumulate broad demographic information.</p></section><section id=\"partners\" class=\"section-block\" style=\"color: rgb(102, 102, 102); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">What partners or service providers have access to Personally Recognizable Information from Visitors and/or Authorized Customers on the Site?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">this app has entered into and will continue to enter into partnerships and other affiliations with a number of vendors. such vendors may have access to certain personally identifiable information on a need-to-know basis for evaluating authorized customers for service eligibility. our privacy policy does not cover their collection or use of this information. disclosure of personally identifiable information to comply with the law. we will reveal personally identifiable information in order to comply with a court order or subpoena or request from a law enforcement agency to release information. we will also uncover personally identifiable information when reasonably necessary to protect the safeguard of our visitors and authorized customers.</p></section><section id=\"keepsafe\" class=\"section-block\" style=\"color: rgb(102, 102, 102);  margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">How does the Site keep Personally Identifiable Information secure?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">our representatives are all acquainted with our security policy and practices. the personally identifiable information of our visitors and authorized customers is only accessible to a predetermined number of qualified employees who are given a password in order to achieve access to the information. we review our security systems and processes on cycles consistently. sensitive information, for example, credit card numbers or social security numbers, is protected by encryption protocols, in place to protect information sent over the internet. while we take commercially reasonable measures to maintain a secure site, electronic communications and databases are subject to errors, tampering, and break-ins, and we cannot guarantee or warrant that such events won\'t take place and we will not be liable to visitors or authorized customers for any such occurrences.</p></section><section id=\"correction\" class=\"section-block\" style=\"color: rgb(102, 102, 102); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">How can Visitors correct any inaccuracies in Personally Identifiable Information?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">visitors and authorized customers may messaging us to update personally identifiable information about them or to correct any inaccuracies by emailing us here.&nbsp;</p></section><section id=\"deletion\" class=\"section-block\" style=\"color: rgb(102, 102, 102); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">Can a Visitor delete or deactivate Personally Identifiable Information collected by the Site?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">we provide visitors and authorized customers with a mechanism to erase/deactivate personally identifiable information from the site’s database by contacting . nonetheless, because of backups and records of deletions, it may be impossible to delete a visitor’s entry without retaining some residual information. a person who requests to have personally identifiable information deactivated will have this information functionally deleted, and we won\'t sell, transfer, or use personally identifiable information relating to that individual in any way moving forward.</p></section><section id=\"changes\" class=\"section-block\" style=\"color: rgb(102, 102, 102); margin-bottom: 60px; font-family: Roboto, sans-serif; font-size: 16px;\"><h4 style=\"line-height: 34px; margin-bottom: 20px; font-size: 24px; color: var(--title-color); font-family: var(--title-font);\">What happens if the Privacy Policy Changes?</h4><p style=\"margin-bottom: 30px; line-height: 26px; text-transform: lowercase;\">we will tell our visitors and authorized customers know about changes to our privacy policy by posting such changes on the site. nonetheless, assuming that we are changing our privacy policy in a manner that might cause disclosure of personally identifiable information that a visitor or authorized customer has previously requested not be disclosed, we will contact such visitor or authorized customer to permit such visitor or authorized customer to prevent such exposure.</p></section>', 1, 'sa', '2023-04-08 08:32:56', '2023-04-08 08:32:56'),
(3, 'সম্পর্কিত', '<div class=\"page-primary-text pb-60\" style=\"list-style: none; font-family: Quicksand, sans-serif; line-height: 1.66; font-size: 18px;\"><div class=\"page-para-title h2\" style=\"list-style: none; margin-bottom: 20px; font-weight: 700; font-size: 36px; font-family: Spectral, serif;\">Wade Wilson</div><p style=\"list-style: none; padding: 0px; line-height: 1.6;\">ওহে! আমি সুইজারল্যান্ডের জুরিখে বসবাসকারী একজন ইউএক্স ডিজাইনার। আমি বর্তমানে জুরিখে ফ্রিল্যান্স কাজ করি। আমি কোম্পানিগুলিকে ব্যবহারকারী কেন্দ্রিক ডিজাইনের মাধ্যমে স্মরণীয় অভিজ্ঞতা তৈরি করতে সাহায্য করি। আমি একজন অভিজ্ঞ ইউএক্স ডিজাইনার যিনি ব্র্যান্ড তৈরি করতে ভালোবাসেন। আমার মূল্য যৌক্তিক এবং মানসিক ধারণা ছেদ করা হয়. আমি 5 বছর আগে কাজ শুরু করেছিলাম এবং তারপর থেকে আমি গ্রাফিক ডিজাইন, আর্ট ডিরেকশন, ফ্রন্ট-এন্ড ডেভেলপমেন্ট, ব্যবহারকারীর অভিজ্ঞতা এবং ইন্টারফেসের মতো বিভিন্ন বিষয়ে কাজ করার সুযোগ পেয়েছি।</p></div><div class=\"page-primary-text pb-40\" style=\"list-style: none; padding-bottom: 40px; font-family: Quicksand, sans-serif; line-height: 1.66; font-size: 18px; \"><div class=\"page-para-title h3\" style=\"list-style: none; margin-bottom: 20px; font-weight: 700; font-size: 26px; font-family: Spectral, serif;\">আমার শখ</div><p style=\"list-style: none; padding: 0px; line-height: 1.6;\">জীবের মধ্যে সবচেয়ে সম্পূর্ণতা মানুষের। কিন্তু সবচেয়ে অসম্পূর্ণ হয়ে সে জন্মগ্রহণ করে। বাঘ ভালুক তার জীবনযাত্রার পনেরো- আনা মূলধন নিয়ে আসে প্রকৃতির মালখানা থেকে। জীবরঙ্গভূমিতে মানুষ এসে দেখা দেয় দুই শূন্য হাতে মুঠো বেঁধে। মানুষ আসবার পূর্বেই জীবসৃষ্টিযজ্ঞে প্রকৃতির ভূরিব্যয়ের পালা শেষ হয়ে এসেছে। বিপুল মাংস, কঠিন বর্ম, প্রকাণ্ড লেজ নিয়ে জলে স্থলে পৃথুল দেহের যে অমিতাচার প্রবল হয়ে উঠেছিল তাতে ধরিত্রীকে দিলে ক্লান্ত করে।</p><p style=\"list-style: none; padding: 0px; line-height: 1.6;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <img src=\"/public/uploaded/page/content/page_content_image16830017261100569826.jpg\" style=\"\">&nbsp; &nbsp; &nbsp; &nbsp; <img src=\"/public/uploaded/page/content/page_content_image1683001749558926906.jpg\" style=\"\"></p><p style=\"list-style: none; padding: 0px; line-height: 1.6;\"><br></p><p style=\"list-style: none; padding: 0px;line-height: 1.6;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img src=\"/public/uploaded/page/content/page_content_image16830017642069861373.jpg\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img src=\"/public/uploaded/page/content/page_content_image16830017761941992328.jpg\"><br></p></div><div class=\"page-image-gallery\" style=\"list-style: none; font-family: Quicksand, sans-serif; font-size: 16px;\"><div class=\"row\" style=\"list-style: none;\"><div class=\"col-sm-6\" style=\"list-style: none; width: 462.5px;\"></div></div></div>', 9, 'bd', '2023-05-02 08:13:47', '2023-05-02 08:13:47'),
(4, 'عن', '<div class=\"page-primary-text pb-60\" style=\"list-style: none; font-family: Quicksand, sans-serif; line-height: 1.66; font-size: 18px;\"><div class=\"page-para-title h2\" style=\"list-style: none; margin-bottom: 20px; font-weight: 700; font-size: 36px; font-family: Spectral, serif;\">Wade Wilson</div><p style=\"list-style: none; padding: 0px; line-height: 1.6;\">أهلاً! أنا مصمم UX أعيش في زيورخ ، سويسرا. أعمل حاليًا بشكل مستقل في زيورخ. أساعد الشركات على إنشاء تجارب لا تُنسى من خلال التصميم الذي يركز على المستخدم. لدي خبرة في تصميم تجربة المستخدم وأحب تطوير العلامات التجارية. قيمتي تتقاطع مع المفاهيم المنطقية والعاطفية. بدأت العمل منذ 5 سنوات ومنذ ذلك الحين أتيحت لي الفرصة للعمل مع مختلف التخصصات مثل التصميم الجرافيكي والتوجيه الفني وتطوير الواجهة الأمامية وتجربة المستخدم والواجهة.</p></div><div class=\"page-primary-text pb-40\" style=\"list-style: none; padding-bottom: 40px; font-family: Quicksand, sans-serif; line-height: 1.66; font-size: 18px;\"><div class=\"page-para-title h3\" style=\"list-style: none; margin-bottom: 20px; font-weight: 700; font-size: 26px; font-family: Spectral, serif;\">هوايتي</div><p style=\"list-style: none; padding: 0px; line-height: 1.6;\">&nbsp;المستخدم. لدي خبرة في تصميم تجربة المستخدم وأحب تطوير العلامات التجارية. قيمتي تتقاطع مع المفاهيم المنطقية والعاطفية. بدأت العمل منذ 5 سنوات ومنذ ذلك الحين أتيحت لي الفرصة للعمل مع مختلف التخصصات مثل التصميم الجرافيكي والتوجيه الفني وتطوير الواجهة الأمامية وتجربة المستخدم والواجهة.<br></p><p style=\"list-style: none; padding: 0px; line-height: 1.6;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <img src=\"/public/uploaded/page/content/page_content_image16830017261100569826.jpg\" style=\"\">&nbsp; &nbsp; &nbsp; &nbsp; <img src=\"/public/uploaded/page/content/page_content_image1683001749558926906.jpg\" style=\"\"></p><p style=\"list-style: none; padding: 0px;  line-height: 1.6;\"><br></p><p style=\"list-style: none; padding: 0px;  line-height: 1.6;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img src=\"/public/uploaded/page/content/page_content_image16830017642069861373.jpg\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img src=\"/public/uploaded/page/content/page_content_image16830017761941992328.jpg\"><br></p></div>', 9, 'sa', '2023-05-02 08:14:45', '2023-05-02 08:14:45');

-- --------------------------------------------------------

--
-- Table structure for table `tl_plugins`
--

CREATE TABLE `tl_plugins` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `location` varchar(150) DEFAULT NULL,
  `author` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `version` varchar(11) NOT NULL DEFAULT '1',
  `unique_indentifier` text NOT NULL,
  `is_activated` int(10) NOT NULL,
  `namespace` varchar(150) NOT NULL,
  `url` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tl_sidebar_has_widgets`
--

CREATE TABLE `tl_sidebar_has_widgets` (
  `id` int(11) NOT NULL,
  `sidebar_id` int(11) DEFAULT NULL,
  `widget_id` bigint(20) DEFAULT NULL,
  `order` bigint(20) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_sidebar_has_widgets`
--

INSERT INTO `tl_sidebar_has_widgets` (`id`, `sidebar_id`, `widget_id`, `order`) VALUES
(763, 4, 79, 4),
(764, 4, 96, 2),
(765, 4, 97, 3),
(766, 4, 78, 1),
(767, 5, 83, 2),
(768, 5, 84, 1),
(771, 5, 96, 3),
(774, 6, 98, 1),
(775, 6, 99, 2),
(776, 6, 100, 5),
(777, 6, 101, 7),
(778, 6, 102, 6),
(779, 6, 104, 3),
(781, 6, 106, 4),
(790, 8, 98, 1),
(791, 8, 99, 2),
(792, 8, 100, 6),
(793, 8, 104, 3),
(794, 8, 106, 5),
(797, 8, 105, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tl_sidebar_widget_has_translate_values`
--

CREATE TABLE `tl_sidebar_widget_has_translate_values` (
  `id` int(11) NOT NULL,
  `value` longtext DEFAULT NULL,
  `sidebar_widget_has_values_id` int(11) DEFAULT NULL,
  `lang` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_sidebar_widget_has_translate_values`
--

INSERT INTO `tl_sidebar_widget_has_translate_values` (`id`, `value`, `sidebar_widget_has_values_id`, `lang`, `created_at`, `updated_at`) VALUES
(6, '{\"widget_title\":\"\\u09af\\u09cb\\u0997\\u09be\\u09af\\u09cb\\u0997 \\u0995\\u09b0\\u09c1\\u09a8\"}', 175, 'bd', '2023-02-11 21:57:31', '2023-02-11 21:57:31'),
(7, '{\"widget_title\":\"\\u0627\\u0628\\u0642\\u0649 \\u0639\\u0644\\u0649 \\u062a\\u0648\\u0627\\u0635\\u0644\"}', 175, 'sa', '2023-02-11 21:57:58', '2023-02-11 21:57:58'),
(8, '{\"widget_title\":\"\\u0633\\u064a\\u0627\\u0633\\u0627\\u062a\\u0646\\u0627\"}', 179, 'sa', '2023-02-11 21:58:23', '2023-02-11 21:58:23'),
(9, '{\"widget_title\":\"\\u0986\\u09ae\\u09be\\u09a6\\u09c7\\u09b0 \\u09a8\\u09c0\\u09a4\\u09bf\"}', 179, 'bd', '2023-02-11 21:58:37', '2023-02-11 21:58:37'),
(10, '{\"widget_title\":\"\\u09b8\\u09ae\\u09b0\\u09cd\\u09a5\\u09a8\"}', 180, 'bd', '2023-02-11 22:02:19', '2023-02-11 22:02:19'),
(11, '{\"widget_title\":\"\\u064a\\u062f\\u0639\\u0645\"}', 180, 'sa', '2023-02-11 22:02:32', '2023-02-11 22:02:32'),
(12, '{\"widget_title\":\"\\u0627\\u0646\\u0636\\u0645 \\u0625\\u0644\\u0649 \\u0627\\u0644\\u0646\\u0634\\u0631\\u0629 \\u0627\\u0644\\u0625\\u062e\\u0628\\u0627\\u0631\\u064a\\u0629\",\"newsletter_short_desc\":\"\\u0627\\u0634\\u062a\\u0631\\u0643 \\u0641\\u064a \\u0627\\u0644\\u0646\\u0634\\u0631\\u0629 \\u0627\\u0644\\u0625\\u062e\\u0628\\u0627\\u0631\\u064a\\u0629 \\u0644\\u062c\\u0645\\u064a\\u0639 \\u0622\\u062e\\u0631 \\u0627\\u0644\\u062a\\u062d\\u062f\\u064a\\u062b\\u0627\\u062a\"}', 176, 'sa', '2023-02-11 22:03:04', '2023-02-11 22:03:04'),
(13, '{\"widget_title\":\"\\u09a8\\u09bf\\u0989\\u099c\\u09b2\\u09c7\\u099f\\u09be\\u09b0 \\u09af\\u09cb\\u0997\\u09a6\\u09be\\u09a8\",\"newsletter_short_desc\":\"\\u09b8\\u09ac \\u09b8\\u09b0\\u09cd\\u09ac\\u09b6\\u09c7\\u09b7 \\u0986\\u09aa\\u09a1\\u09c7\\u099f\\u09c7\\u09b0 \\u099c\\u09a8\\u09cd\\u09af \\u09a8\\u09bf\\u0989\\u099c\\u09b2\\u09c7\\u099f\\u09be\\u09b0 \\u09b8\\u09a6\\u09b8\\u09cd\\u09af\\u09a4\\u09be\"}', 176, 'bd', '2023-02-11 22:05:41', '2023-02-11 22:05:41'),
(15, '{\"widget_title\":\"\\u09b8\\u09be\\u09ae\\u09cd\\u09aa\\u09cd\\u09b0\\u09a4\\u09bf\\u0995 \\u09ac\\u09cd\\u09b2\\u0997\"}', 181, 'bd', '2023-02-11 22:14:54', '2023-02-11 22:14:54'),
(16, '{\"widget_title\":\"\\u0645\\u062f\\u0648\\u0646\\u0629 \\u062d\\u062f\\u064a\\u062b\\u0629\"}', 181, 'sa', '2023-02-11 22:15:08', '2023-02-11 22:15:08'),
(17, '{\"widget_title\":\"\\u09ac\\u09c8\\u09b6\\u09bf\\u09b7\\u09cd\\u099f\\u09cd\\u09af\\u09af\\u09c1\\u0995\\u09cd\\u09a4 \\u09ac\\u09cd\\u09b2\\u0997\"}', 182, 'bd', '2023-02-11 22:15:22', '2023-02-11 22:15:22'),
(18, '{\"widget_title\":\"\\u0645\\u062f\\u0648\\u0646\\u0627\\u062a \\u0645\\u0645\\u064a\\u0632\\u0629\"}', 182, 'sa', '2023-02-11 22:15:35', '2023-02-11 22:15:35'),
(19, '{\"widget_title\":\"\\u09ac\\u09c8\\u09b6\\u09bf\\u09b7\\u09cd\\u099f\\u09cd\\u09af\\u09af\\u09c1\\u0995\\u09cd\\u09a4 \\u09ac\\u09cd\\u09b2\\u0997\"}', 193, 'bd', '2023-04-03 04:12:21', '2023-04-03 04:12:21'),
(20, '{\"title_placeholder\":\"\\u09ac\\u09bf\\u09ad\\u09be\\u0997 \\u09a8\\u09bf\\u09b0\\u09cd\\u09ac\\u09be\\u099a\\u09a8 \\u0995\\u09b0\\u09c1\\u09a8\"}', 195, 'bd', '2023-04-03 04:12:39', '2023-04-03 04:12:39'),
(21, '{\"widget_title\":\"\\u09a8\\u09bf\\u0989\\u099c\\u09b2\\u09c7\\u099f\\u09be\\u09b0\",\"newsletter_short_desc\":\"\\u09b8\\u09be\\u0987\\u09a8 \\u0986\\u09aa \\u0995\\u09b0\\u09c1\\u09a8 \\u098f\\u09ac\\u0982 \\u09aa\\u09cd\\u09b0\\u09a4\\u09bf \\u09b8\\u09aa\\u09cd\\u09a4\\u09be\\u09b9\\u09c7 \\u0986\\u09aa\\u09a8\\u09be\\u09b0 \\u0987\\u09a8\\u09ac\\u0995\\u09cd\\u09b8\\u09c7 \\u09b8\\u09be\\u09ae\\u09cd\\u09aa\\u09cd\\u09b0\\u09a4\\u09bf\\u0995 \\u09ac\\u09cd\\u09b2\\u0997 \\u098f\\u09ac\\u0982 \\u09a8\\u09bf\\u09ac\\u09a8\\u09cd\\u09a7 \\u0997\\u09cd\\u09b0\\u09b9\\u09a3 \\u0995\\u09b0\\u09c1\\u09a8\\u0964\",\"email_placeholder\":\"\\u0987\\u09ae\\u09c7\\u0987\\u09b2 \\u09aa\\u09cd\\u09b0\\u09a6\\u09be\\u09a8 \\u0995\\u09b0\\u09c1\\u09a8\",\"button_text\":\"\\u09b8\\u09be\\u09ac\\u09b8\\u09cd\\u0995\\u09cd\\u09b0\\u09be\\u0987\\u09ac\"}', 196, 'bd', '2023-04-03 04:13:11', '2023-04-03 04:27:56'),
(22, '{\"widget_title\":\"\\u09b8\\u09be\\u09ae\\u09cd\\u09aa\\u09cd\\u09b0\\u09a4\\u09bf\\u0995 \\u09ac\\u09cd\\u09b2\\u0997\"}', 194, 'bd', '2023-04-03 04:13:45', '2023-04-03 04:13:45'),
(23, '{\"widget_title\":\"\\u09b8\\u09b0\\u09cd\\u09ac\\u09be\\u09a7\\u09bf\\u0995 \\u09ae\\u09a8\\u09cd\\u09a4\\u09ac\\u09cd\\u09af \\u0995\\u09b0\\u09be \\u09ac\\u09cd\\u09b2\\u0997\"}', 197, 'bd', '2023-04-03 04:14:19', '2023-04-03 04:14:19'),
(24, '{\"widget_title\":\"\\u099f\\u09cd\\u09af\\u09be\\u0997\"}', 198, 'bd', '2023-04-03 04:14:46', '2023-04-03 04:14:46'),
(25, '{\"widget_title\":\"\\u09ac\\u09c8\\u09b6\\u09bf\\u09b7\\u09cd\\u099f\\u09cd\\u09af\\u09af\\u09c1\\u0995\\u09cd\\u09a4 \\u09ac\\u09cd\\u09b2\\u0997\"}', 185, 'bd', '2023-04-08 08:23:41', '2023-04-08 08:23:41'),
(26, '{\"widget_title\":\"\\u0645\\u062f\\u0648\\u0646\\u0627\\u062a \\u0645\\u0645\\u064a\\u0632\\u0629\"}', 185, 'sa', '2023-04-08 08:23:53', '2023-04-08 08:23:53'),
(27, '{\"widget_title\":\"\\u0645\\u062f\\u0648\\u0646\\u0627\\u062a \\u0645\\u0645\\u064a\\u0632\\u0629\"}', 193, 'sa', '2023-04-08 08:24:01', '2023-04-08 08:24:01'),
(28, '{\"title_placeholder\":\"\\u09ac\\u09bf\\u09ad\\u09be\\u0997 \\u09a8\\u09bf\\u09b0\\u09cd\\u09ac\\u09be\\u099a\\u09a8 \\u0995\\u09b0\\u09c1\\u09a8\"}', 189, 'bd', '2023-04-08 08:24:13', '2023-04-08 08:24:13'),
(29, '{\"title_placeholder\":\"\\u0627\\u062e\\u062a\\u0631 \\u0627\\u0644\\u0641\\u0626\\u0629\"}', 189, 'sa', '2023-04-08 08:24:45', '2023-04-08 08:24:45'),
(30, '{\"title_placeholder\":\"\\u0627\\u062e\\u062a\\u0631 \\u0627\\u0644\\u0641\\u0626\\u0629\"}', 195, 'sa', '2023-04-08 08:24:51', '2023-04-08 08:24:51'),
(31, '{\"widget_title\":\"\\u09a8\\u09bf\\u0989\\u099c\\u09b2\\u09c7\\u099f\\u09be\\u09b0\",\"newsletter_short_desc\":\"\\u09b8\\u09be\\u0987\\u09a8 \\u0986\\u09aa \\u0995\\u09b0\\u09c1\\u09a8 \\u098f\\u09ac\\u0982 \\u09aa\\u09cd\\u09b0\\u09a4\\u09bf \\u09b8\\u09aa\\u09cd\\u09a4\\u09be\\u09b9\\u09c7 \\u0986\\u09aa\\u09a8\\u09be\\u09b0 \\u0987\\u09a8\\u09ac\\u0995\\u09cd\\u09b8\\u09c7 \\u09b8\\u09be\\u09ae\\u09cd\\u09aa\\u09cd\\u09b0\\u09a4\\u09bf\\u0995 \\u09ac\\u09cd\\u09b2\\u0997 \\u098f\\u09ac\\u0982 \\u09a8\\u09bf\\u09ac\\u09a8\\u09cd\\u09a7 \\u0997\\u09cd\\u09b0\\u09b9\\u09a3 \\u0995\\u09b0\\u09c1\\u09a8\\u0964\",\"email_placeholder\":\"\\u0987\\u09ae\\u09c7\\u0987\\u09b2 \\u09aa\\u09cd\\u09b0\\u09a6\\u09be\\u09a8 \\u0995\\u09b0\\u09c1\\u09a8\",\"button_text\":\"\\u09b8\\u09be\\u09ac\\u09b8\\u09cd\\u0995\\u09cd\\u09b0\\u09be\\u0987\\u09ac\"}', 190, 'bd', '2023-04-08 08:26:00', '2023-04-08 08:26:00'),
(32, '{\"widget_title\":\"\\u0627\\u0644\\u0646\\u0634\\u0631\\u0629 \\u0627\\u0644\\u0625\\u062e\\u0628\\u0627\\u0631\\u064a\\u0629\",\"newsletter_short_desc\":\"\\u0642\\u0645 \\u0628\\u0627\\u0644\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0648\\u062a\\u0644\\u0642\\u064a \\u0627\\u0644\\u0645\\u062f\\u0648\\u0646\\u0629 \\u0648\\u0627\\u0644\\u0645\\u0642\\u0627\\u0644 \\u0627\\u0644\\u0623\\u062e\\u064a\\u0631 \\u0641\\u064a \\u0635\\u0646\\u062f\\u0648\\u0642 \\u0627\\u0644\\u0648\\u0627\\u0631\\u062f \\u0627\\u0644\\u062e\\u0627\\u0635 \\u0628\\u0643 \\u0643\\u0644 \\u0623\\u0633\\u0628\\u0648\\u0639.\",\"email_placeholder\":\"\\u0623\\u062f\\u062e\\u0644 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\",\"button_text\":\"\\u064a\\u0634\\u062a\\u0631\\u0643\"}', 190, 'sa', '2023-04-08 08:27:00', '2023-04-08 08:27:00'),
(33, '{\"widget_title\":\"\\u0627\\u0644\\u0646\\u0634\\u0631\\u0629 \\u0627\\u0644\\u0625\\u062e\\u0628\\u0627\\u0631\\u064a\\u0629\",\"newsletter_short_desc\":\"\\u0642\\u0645 \\u0628\\u0627\\u0644\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0648\\u062a\\u0644\\u0642\\u064a \\u0627\\u0644 \\u0627\\u0644\\u0623\\u062e\\u064a\\u0631 \\u0641\\u064a \\u0635\\u0646\\u062f\\u0648\\u0642 \\u0627\\u0644\\u0648\\u0627\\u0631\\u062f \\u0627\\u0644\\u062e\\u0627\\u0635\\u0645\\u062f\\u0648\\u0646\\u0629 \\u0648\\u0627\\u0644\\u0645\\u0642\\u0627\\u0644 \\u0628\\u0643 \\u0643\\u0644 \\u0623\\u0633\\u0628\\u0648\\u0639.\",\"email_placeholder\":\"\\u0623\\u062f\\u062e\\u0644 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\",\"button_text\":\"\\u064a\\u0634\\u062a\\u0631\\u0643\"}', 196, 'sa', '2023-04-08 08:27:47', '2023-04-08 08:27:47'),
(34, '{\"widget_title\":\"\\u09b8\\u09be\\u09ae\\u09cd\\u09aa\\u09cd\\u09b0\\u09a4\\u09bf\\u0995 \\u09ac\\u09cd\\u09b2\\u0997\"}', 186, 'bd', '2023-04-08 08:28:06', '2023-04-08 08:28:06'),
(35, '{\"widget_title\":\"\\u0627\\u0644\\u0645\\u062f\\u0648\\u0646\\u0627\\u062a \\u0627\\u0644\\u062d\\u062f\\u064a\\u062b\\u0629\"}', 186, 'sa', '2023-04-08 08:28:23', '2023-04-08 08:28:23'),
(36, '{\"widget_title\":\"\\u0627\\u0644\\u0645\\u062f\\u0648\\u0646\\u0627\\u062a \\u0627\\u0644\\u062d\\u062f\\u064a\\u062b\\u0629\"}', 194, 'sa', '2023-04-08 08:29:17', '2023-04-08 08:29:17'),
(37, '{\"widget_title\":\"\\u09b8\\u09b0\\u09cd\\u09ac\\u09be\\u09a7\\u09bf\\u0995 \\u09ae\\u09a8\\u09cd\\u09a4\\u09ac\\u09cd\\u09af \\u0995\\u09b0\\u09be \\u09ac\\u09cd\\u09b2\\u0997\"}', 188, 'bd', '2023-04-08 08:29:30', '2023-04-08 08:29:30'),
(38, '{\"widget_title\":\"\\u0627\\u0644\\u0645\\u062f\\u0648\\u0646\\u0627\\u062a \\u0627\\u0644\\u0623\\u0643\\u062b\\u0631 \\u062a\\u0639\\u0644\\u064a\\u0642\\u064b\\u0627\"}', 188, 'sa', '2023-04-08 08:29:45', '2023-04-08 08:29:45'),
(39, '{\"widget_title\":\"\\u0627\\u0644\\u0645\\u062f\\u0648\\u0646\\u0627\\u062a \\u0627\\u0644\\u0623\\u0643\\u062b\\u0631 \\u062a\\u0639\\u0644\\u064a\\u0642\\u064b\\u0627\"}', 197, 'sa', '2023-04-08 08:29:59', '2023-04-08 08:29:59'),
(40, '{\"widget_title\":\"\\u099f\\u09cd\\u09af\\u09be\\u0997\"}', 187, 'bd', '2023-04-08 08:30:14', '2023-04-08 08:30:14'),
(41, '{\"widget_title\":\"\\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a\"}', 187, 'sa', '2023-04-08 08:30:26', '2023-04-08 08:30:26'),
(42, '{\"widget_title\":\"\\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a\"}', 198, 'sa', '2023-04-08 08:30:33', '2023-04-08 08:30:33');

-- --------------------------------------------------------

--
-- Table structure for table `tl_sidebar_widget_has_values`
--

CREATE TABLE `tl_sidebar_widget_has_values` (
  `id` int(11) NOT NULL,
  `sidebar_has_widget_id` int(11) DEFAULT NULL,
  `widget_input_id` bigint(20) DEFAULT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_sidebar_widget_has_values`
--

INSERT INTO `tl_sidebar_widget_has_values` (`id`, `sidebar_has_widget_id`, `widget_input_id`, `value`) VALUES
(175, 766, NULL, '{\"widget_title\":\"Get in Touch\",\"mail\":\"support@rexeller.com\",\"mobile\":\"02 478 658 8936\",\"address\":\"53 Rain Road, Suite 41 Austin Greater NY, USA\"}'),
(176, 763, NULL, '{\"widget_title\":\"Join Newsletter\",\"newsletter_short_desc\":\"Subscribe to the newsletter for all the latest updates\"}'),
(179, 764, NULL, '{\"widget_title\":\"Our Policies\",\"menu_group_id\":\"21\"}'),
(180, 765, NULL, '{\"widget_title\":\"Support\",\"menu_group_id\":\"22\"}'),
(181, 768, NULL, '{\"widget_title\":\"Recent Blogs\",\"number_of_recent_blog\":\"3\"}'),
(182, 767, NULL, '{\"widget_title\":\"Featured Blogs\",\"number_of_featured_blog\":\"3\"}'),
(184, 774, NULL, '{\"author_id\":\"1\"}'),
(185, 775, NULL, '{\"widget_title\":\"Featured Blogs\",\"number_of_featured_blog\":\"3\"}'),
(186, 776, NULL, '{\"widget_title\":\"Recent Blogs\",\"number_of_recent_blog\":\"4\"}'),
(187, 777, NULL, '{\"widget_title\":\"Tags\",\"number_of_tags\":\"12\"}'),
(188, 778, NULL, '{\"widget_title\":\"Most Commented Blogs\",\"per_slide_number\":\"2\",\"total_blog_number\":\"6\"}'),
(189, 779, NULL, '{\"title_placeholder\":\"Select Category\"}'),
(190, 781, NULL, '{\"widget_title\":\"Newsletter\",\"newsletter_short_desc\":\"Sign up and receive recent blog and article in your inbox every week.\",\"email_placeholder\":\"Enter Email\",\"button_text\":\"Subscribe\"}'),
(191, 780, NULL, '{\"add_information\":\"<a href=\\\"\\/\\\"><img src=\\\"https:\\/\\/images.unsplash.com\\/photo-1618826411640-d6df44dd3f7a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80\\\" alt=\\\"ads\\\"><\\/a>\"}'),
(192, 790, NULL, '{\"author_id\":\"1\"}'),
(193, 791, NULL, '{\"widget_title\":\"Featured Blogs\",\"number_of_featured_blog\":\"3\"}'),
(194, 792, NULL, '{\"widget_title\":\"Recent Blog\",\"number_of_recent_blog\":\"4\"}'),
(195, 793, NULL, '{\"title_placeholder\":\"Select Category\"}'),
(196, 794, NULL, '{\"widget_title\":\"Newsletter\",\"newsletter_short_desc\":\"Sign up and receive recent blog and article in your inbox every week.\",\"email_placeholder\":\"Enter Email\",\"button_text\":\"Subscribe\"}'),
(197, 795, NULL, '{\"widget_title\":\"Most Commented Blog\",\"per_slide_number\":\"2\",\"total_blog_number\":\"6\"}'),
(198, 796, NULL, '{\"widget_title\":\"Tags\",\"number_of_tags\":\"12\"}'),
(199, 797, NULL, '{\"add_information\":\"<a href=\\\"\\/\\\"><img src=\\\"\\/public\\/storage\\/all_files\\/2023\\/May\\/dummy_350x300_000000_cccccc_1043.png\\\" alt=\\\"ads\\\"><\\/a>\"}'),
(200, 801, NULL, '{\"widget_title\":\"Featured Blogs\",\"per_slide_number\":null,\"total_blog_number\":null}');

-- --------------------------------------------------------

--
-- Table structure for table `tl_smtps`
--

CREATE TABLE `tl_smtps` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tl_smtp_configs`
--

CREATE TABLE `tl_smtp_configs` (
  `id` int(11) NOT NULL,
  `smtp_id` int(11) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tl_themes`
--

CREATE TABLE `tl_themes` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `location` varchar(200) NOT NULL,
  `author` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `version` varchar(150) NOT NULL DEFAULT '1.0',
  `unique_indentifier` text NOT NULL,
  `is_activated` int(11) NOT NULL DEFAULT 1,
  `namespace` varchar(150) NOT NULL,
  `url` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tl_themes`
--

INSERT INTO `tl_themes` (`id`, `name`, `location`, `author`, `description`, `version`, `unique_indentifier`, `is_activated`, `namespace`, `url`, `created_at`, `updated_at`) VALUES
(16, 'Default', 'default', 'Themelooks', 'CMS-Looks an Advanced Blogging Theme', '1.0', '54646548', 1, 'Theme\\Default\\', 'http://www.themelooks.com/', '2022-12-17 07:00:19', '2023-01-23 02:30:24');

-- --------------------------------------------------------

--
-- Table structure for table `tl_theme_default_home_page_sections`
--

CREATE TABLE `tl_theme_default_home_page_sections` (
  `id` int(11) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tl_theme_default_home_page_sections`
--

INSERT INTO `tl_theme_default_home_page_sections` (`id`, `ordering`, `status`, `created_at`, `updated_at`) VALUES
(63, 1, 1, '2023-03-19 04:51:59', '2023-03-21 00:27:25'),
(65, 4, 1, '2023-03-19 04:53:06', '2023-03-21 00:29:58'),
(70, 3, 1, '2023-03-20 02:51:01', '2023-03-21 00:29:39'),
(71, 2, 1, '2023-03-21 00:29:25', '2023-03-21 00:29:30'),
(72, 0, 1, '2023-04-13 04:42:45', '2023-04-13 04:42:45');

-- --------------------------------------------------------

--
-- Table structure for table `tl_theme_default_home_page_sections_properties`
--

CREATE TABLE `tl_theme_default_home_page_sections_properties` (
  `id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `key_name` text DEFAULT NULL,
  `key_value` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tl_theme_default_home_page_sections_properties`
--

INSERT INTO `tl_theme_default_home_page_sections_properties` (`id`, `section_id`, `key_name`, `key_value`, `created_at`, `updated_at`) VALUES
(9656, 72, 'layout', 'slider', '2023-04-13 04:42:45', '2023-04-13 04:42:45'),
(9657, 72, 'content', 'featured', '2023-04-13 04:42:45', '2023-04-13 04:42:45'),
(9658, 72, 'category', '274', '2023-04-13 04:42:45', '2023-04-13 04:42:45'),
(9659, 72, 'category_color', NULL, '2023-04-13 04:42:45', '2023-04-13 04:42:45'),
(9660, 72, 'title_color', NULL, '2023-04-13 04:42:45', '2023-04-13 04:42:45'),
(9661, 72, 'bg_color', NULL, '2023-04-13 04:42:45', '2023-04-13 04:42:45'),
(9662, 72, 'bg_image', NULL, '2023-04-13 04:42:45', '2023-04-13 04:42:45'),
(9663, 72, 'background_size', 'cover', '2023-04-13 04:42:45', '2023-04-13 04:42:45'),
(9664, 72, 'background_position', 'bottom', '2023-04-13 04:42:45', '2023-04-13 04:42:45'),
(9665, 72, 'background_repeat', 'no-repeat', '2023-04-13 04:42:45', '2023-04-13 04:42:45'),
(9666, 72, 'padding_top', NULL, '2023-04-13 04:42:45', '2023-04-13 04:42:45'),
(9667, 72, 'padding_right', NULL, '2023-04-13 04:42:45', '2023-04-13 04:42:45'),
(9668, 72, 'padding_bottom', NULL, '2023-04-13 04:42:45', '2023-04-13 04:42:45'),
(9669, 72, 'padding_left', NULL, '2023-04-13 04:42:45', '2023-04-13 04:42:45'),
(9670, 72, 'margin_top', NULL, '2023-04-13 04:42:45', '2023-04-13 04:42:45'),
(9671, 72, 'margin_right', NULL, '2023-04-13 04:42:45', '2023-04-13 04:42:45'),
(9672, 72, 'margin_bottom', NULL, '2023-04-13 04:42:45', '2023-04-13 04:42:45'),
(9673, 72, 'margin_left', NULL, '2023-04-13 04:42:45', '2023-04-13 04:42:45'),
(9767, 65, '1__image', NULL, '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9768, 65, '1__url', NULL, '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9769, 65, 'post_style', 's_four', '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9770, 65, 'category', '274', '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9771, 65, 'blog_colum', 'col-12', '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9772, 65, 'number_of_blogs', '2', '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9773, 65, 'title', 'Fashion Blogs', '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9774, 65, 'title_color', NULL, '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9775, 65, 'description_color', NULL, '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9776, 65, 'bg_color', NULL, '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9777, 65, 'bg_image', NULL, '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9778, 65, 'background_size', 'cover', '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9779, 65, 'background_position', 'bottom', '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9780, 65, 'background_repeat', 'no-repeat', '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9781, 65, 'btn_title', NULL, '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9782, 65, 'btn_color', NULL, '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9783, 65, 'btn_hover_color', NULL, '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9784, 65, 'btn_bg_color', NULL, '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9785, 65, 'btn_bg_hover_color', NULL, '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9786, 65, 'btn_border', NULL, '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9787, 65, 'btn_border_color', NULL, '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9788, 65, 'btn_border_hover_color', NULL, '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9789, 65, 'padding_top', NULL, '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9790, 65, 'padding_right', NULL, '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9791, 65, 'padding_bottom', NULL, '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9792, 65, 'padding_left', NULL, '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9793, 65, 'margin_top', NULL, '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9794, 65, 'margin_right', NULL, '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9795, 65, 'margin_bottom', NULL, '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9796, 65, 'margin_left', NULL, '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9797, 65, 'layout', 'category_wise', '2023-05-06 04:04:32', '2023-05-06 04:04:32'),
(9798, 63, '1__image', NULL, '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9799, 63, '1__url', NULL, '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9800, 63, 'post_style', 's_one', '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9801, 63, 'blog_colum', 'col-12', '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9802, 63, 'number_of_blogs', '3', '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9803, 63, 'title', 'Popular Posts', '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9804, 63, 'title_color', NULL, '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9805, 63, 'description_color', NULL, '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9806, 63, 'bg_color', NULL, '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9807, 63, 'bg_image', NULL, '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9808, 63, 'background_size', 'cover', '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9809, 63, 'background_position', 'revert-layer', '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9810, 63, 'background_repeat', 'repeat', '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9811, 63, 'btn_title', 'Read More', '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9812, 63, 'btn_color', NULL, '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9813, 63, 'btn_hover_color', NULL, '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9814, 63, 'btn_bg_color', NULL, '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9815, 63, 'btn_bg_hover_color', NULL, '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9816, 63, 'btn_border', NULL, '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9817, 63, 'btn_border_color', NULL, '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9818, 63, 'btn_border_hover_color', NULL, '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9819, 63, 'padding_top', NULL, '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9820, 63, 'padding_right', NULL, '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9821, 63, 'padding_bottom', NULL, '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9822, 63, 'padding_left', NULL, '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9823, 63, 'margin_top', NULL, '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9824, 63, 'margin_right', NULL, '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9825, 63, 'margin_bottom', NULL, '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9826, 63, 'margin_left', NULL, '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9827, 63, 'layout', 'most_viewed_blog', '2023-05-09 04:23:06', '2023-05-09 04:23:06'),
(9828, 71, '1__image', NULL, '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9829, 71, '1__url', NULL, '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9830, 71, 'post_style', 's_two', '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9831, 71, 'blog_colum', 'col-sm-6', '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9832, 71, 'number_of_blogs', '4', '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9833, 71, 'title', 'Most Viewed Posts', '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9834, 71, 'title_color', NULL, '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9835, 71, 'description_color', NULL, '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9836, 71, 'bg_color', NULL, '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9837, 71, 'bg_image', NULL, '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9838, 71, 'background_size', 'cover', '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9839, 71, 'background_position', 'bottom', '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9840, 71, 'background_repeat', 'no-repeat', '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9841, 71, 'btn_title', NULL, '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9842, 71, 'btn_color', NULL, '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9843, 71, 'btn_hover_color', NULL, '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9844, 71, 'btn_bg_color', NULL, '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9845, 71, 'btn_bg_hover_color', NULL, '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9846, 71, 'btn_border', NULL, '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9847, 71, 'btn_border_color', NULL, '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9848, 71, 'btn_border_hover_color', NULL, '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9849, 71, 'padding_top', NULL, '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9850, 71, 'padding_right', NULL, '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9851, 71, 'padding_bottom', NULL, '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9852, 71, 'padding_left', NULL, '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9853, 71, 'margin_top', NULL, '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9854, 71, 'margin_right', NULL, '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9855, 71, 'margin_bottom', NULL, '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9856, 71, 'margin_left', NULL, '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9857, 71, 'layout', 'most_viewed_blog', '2023-05-09 04:23:24', '2023-05-09 04:23:24'),
(9894, 70, '1_12_image', '1042', '2023-05-11 05:53:48', '2023-05-11 05:53:48'),
(9895, 70, '1_12_url', '/blogs', '2023-05-11 05:53:48', '2023-05-11 05:53:48'),
(9896, 70, 'content', '12', '2023-05-11 05:53:48', '2023-05-11 05:53:48'),
(9897, 70, 'title', 'Adds', '2023-05-11 05:53:48', '2023-05-11 05:53:48'),
(9898, 70, 'bg_color', NULL, '2023-05-11 05:53:48', '2023-05-11 05:53:48'),
(9899, 70, 'bg_image', NULL, '2023-05-11 05:53:48', '2023-05-11 05:53:48'),
(9900, 70, 'background_size', 'cover', '2023-05-11 05:53:48', '2023-05-11 05:53:48'),
(9901, 70, 'background_position', 'bottom', '2023-05-11 05:53:48', '2023-05-11 05:53:48'),
(9902, 70, 'background_repeat', 'no-repeat', '2023-05-11 05:53:48', '2023-05-11 05:53:48'),
(9903, 70, 'padding_top', '30', '2023-05-11 05:53:48', '2023-05-11 05:53:48'),
(9904, 70, 'padding_right', NULL, '2023-05-11 05:53:48', '2023-05-11 05:53:48'),
(9905, 70, 'padding_bottom', '30', '2023-05-11 05:53:48', '2023-05-11 05:53:48'),
(9906, 70, 'padding_left', NULL, '2023-05-11 05:53:48', '2023-05-11 05:53:48'),
(9907, 70, 'margin_top', NULL, '2023-05-11 05:53:48', '2023-05-11 05:53:48'),
(9908, 70, 'margin_right', NULL, '2023-05-11 05:53:48', '2023-05-11 05:53:48'),
(9909, 70, 'margin_bottom', NULL, '2023-05-11 05:53:48', '2023-05-11 05:53:48'),
(9910, 70, 'margin_left', NULL, '2023-05-11 05:53:48', '2023-05-11 05:53:48'),
(9911, 70, 'layout', 'ads', '2023-05-11 05:53:48', '2023-05-11 05:53:48');

-- --------------------------------------------------------

--
-- Table structure for table `tl_theme_option_settings`
--

CREATE TABLE `tl_theme_option_settings` (
  `id` bigint(20) NOT NULL,
  `theme_id` int(11) DEFAULT NULL,
  `option_name` text DEFAULT NULL,
  `field_name` text DEFAULT NULL,
  `field_value` longtext DEFAULT NULL,
  `field_reset_value` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_theme_option_settings`
--

INSERT INTO `tl_theme_option_settings` (`id`, `theme_id`, `option_name`, `field_name`, `field_value`, `field_reset_value`) VALUES
(4243, 16, 'social', 'social_field', '[{\"social_icon_title\":\"Facebook\",\"social_icon\":\"fa-facebook-official\",\"social_icon_url\":\"\\/\",\"order\":1},{\"social_icon_title\":\"Twitter\",\"social_icon\":\"fa-twitter-square\",\"social_icon_url\":\"\\/\",\"order\":2},{\"social_icon_title\":\"Instagram\",\"social_icon\":\"fa-instagram\",\"social_icon_url\":\"\\/\",\"order\":3},{\"social_icon_title\":\"LinkedIn\",\"social_icon\":\"fa-linkedin-square\",\"social_icon_url\":\"\\/\",\"order\":4}]', NULL),
(4244, 16, 'preloader', 'preloader_field', '1', NULL),
(4245, 16, 'preloader', 'preloader_style_type', 'default', NULL),
(4246, 16, 'preloader', 'preloader_item_color', NULL, NULL),
(4247, 16, 'preloader', 'preloader_item_color_transparent', '0', NULL),
(4248, 16, 'preloader', 'preloader_bgcolor', NULL, NULL),
(4249, 16, 'preloader', 'preloader_bgcolor_transparent', '0', NULL),
(4250, 16, 'blog', 'custom_blog_style', '0', NULL),
(4251, 16, 'blog', 'blog_layout', 'right_sidebar_layout', NULL),
(4252, 16, 'blog', 'blog_colum', 'blog_colum_2', NULL),
(4253, 16, 'blog', 'blog_post_style', 's_two', NULL),
(4254, 16, 'blog', 'blog_page_title', '1', NULL),
(4255, 16, 'blog', 'blog_posts_excerpt', '0', NULL),
(4256, 16, 'blog', 'blog_perpage', '8', NULL),
(4257, 16, 'blog', 'read_more_text_setting', 'default', NULL),
(4258, 16, 'blog', 'blog_pagination_setting', 'number', NULL),
(4259, 16, 'blog', 'blog_pagination_color', NULL, NULL),
(4260, 16, 'blog', 'blog_pagination_color_transparent', '0', NULL),
(4261, 16, 'blog', 'blog_pagination_bg_color', NULL, NULL),
(4262, 16, 'blog', 'blog_pagination_bg_color_transparent', '0', NULL),
(4263, 16, 'blog', 'blog_pagination_hover_color', NULL, NULL),
(4264, 16, 'blog', 'blog_pagination_hover_color_transparent', '0', NULL),
(4265, 16, 'blog', 'blog_pagination_hover_bg_color', NULL, NULL),
(4266, 16, 'blog', 'blog_pagination_hover_bg_color_transparent', '0', NULL),
(4267, 16, 'blog', 'blog_pagination_position', 'center', NULL),
(4268, 16, 'blog', 'blog_pagination_active_color', NULL, NULL),
(4269, 16, 'blog', 'blog_pagination_active_color_transparent', '0', NULL),
(4270, 16, 'blog', 'blog_pagination_active_bg_color', NULL, NULL),
(4271, 16, 'blog', 'blog_pagination_active_bg_color_transparent', '0', NULL),
(4272, 16, 'home_page', 'homepage_layout', 'right_sidebar_layout', NULL),
(4273, 16, 'back_to_top', 'back_to_top_button', '1', NULL),
(4274, 16, 'back_to_top', 'custom_back_to_top_button', '0', NULL),
(4275, 16, 'back_to_top', 'custom_back_to_top_button_icon', NULL, NULL),
(4276, 16, 'back_to_top', 'back_to_top_button_bgcolor', NULL, NULL),
(4277, 16, 'back_to_top', 'back_to_top_button_bgcolor_transparent', NULL, NULL),
(4278, 16, 'back_to_top', 'back_to_top_button_color', NULL, NULL),
(4279, 16, 'back_to_top', 'back_to_top_button_color_transparent', NULL, NULL),
(4280, 16, 'back_to_top', 'back_to_top_button_hover_color', NULL, NULL),
(4281, 16, 'back_to_top', 'back_to_top_button_hover_color_transparent', NULL, NULL),
(4282, 16, 'back_to_top', 'back_to_top_button_hover_bgcolor', NULL, NULL),
(4283, 16, 'back_to_top', 'back_to_top_button_hover_bgcolor_transparent', NULL, NULL),
(4284, 16, 'back_to_top', 'back_to_top_button_on_mobile', '1', NULL),
(4285, 16, 'subscribe', 'mailchimp_api_key', NULL, NULL),
(4286, 16, 'subscribe', 'mailchimp_list_id', NULL, NULL),
(4287, 16, 'subscribe', 'footer_subscribe_form', '1', NULL),
(4288, 16, 'subscribe', 'subscribe_form_title', 'Subscribe Our Newsletter', NULL),
(4289, 16, 'subscribe', 'subscribe_form_placeholder', 'Enter Your Email', NULL),
(4290, 16, 'subscribe', 'subscribe_form_button_text', 'Submit', NULL),
(4291, 16, 'subscribe', 'privacy_policy', '1', NULL),
(4292, 16, 'subscribe', 'privacy_policy_page', '1', NULL),
(4293, 16, 'subscribe', 'custom_footer_subscribe', '0', NULL),
(4294, 16, 'header', 'header_bg_color', NULL, NULL),
(4295, 16, 'header', 'header_bg_color_transparent', '0', NULL),
(4296, 16, 'header', 'sticky_header_bg_color', NULL, NULL),
(4297, 16, 'header', 'sticky_header_bg_color_transparent', '0', NULL),
(4298, 16, 'header', 'header_search_icon', '1', NULL),
(4299, 16, 'header', 'header_search_icon_color', NULL, NULL),
(4300, 16, 'header', 'header_search_icon_color_transparent', '0', NULL),
(4301, 16, 'header', 'sticky_header_search_icon_color', NULL, NULL),
(4302, 16, 'header', 'sticky_header_search_icon_color_transparent', '0', NULL),
(4303, 16, 'blog', 'blog_page_title_setting', 'default', NULL),
(4333, 16, 'page', 'custom_page_c', NULL, NULL),
(4334, 16, 'page', 'page_title_c', NULL, NULL),
(4335, 16, 'page', 'page_background-color', NULL, NULL),
(4336, 16, 'page', 'page_background-color-transparent_i', NULL, NULL),
(4337, 16, 'page', 'page_background-repeat', NULL, NULL),
(4338, 16, 'page', 'page_background-size', NULL, NULL),
(4339, 16, 'page', 'page_background-attachment', NULL, NULL),
(4340, 16, 'page', 'page_background-position', NULL, NULL),
(4341, 16, 'page', 'page_background-image', NULL, NULL),
(4342, 16, 'page', 'page_background_image_i', NULL, NULL),
(4343, 16, 'page', 'overlay_c', NULL, NULL),
(4344, 16, 'page', 'overlay_background-color', NULL, NULL),
(4345, 16, 'page', 'overlay_background-color-transparent_i', NULL, NULL),
(4346, 16, 'page', 'overlay_opacity', NULL, NULL),
(4347, 16, 'page', 'breadcrumb_hide_show_c', NULL, NULL),
(4375, 16, 'page_404', 'custom_404_page_c', '1', NULL),
(4376, 16, 'page_404', 'page_404_title_s', 'Error!', NULL),
(4377, 16, 'page_404', 'page_404_subtitle_s', 'Page Not Found', NULL),
(4378, 16, 'page_404', 'page_404_button_before_text_s', 'The page you are looking for was moved, removed, renamed, or never existed. Please check the URL or go to', NULL),
(4379, 16, 'page_404', 'page_404_button_text_s', 'Main Page', NULL),
(4380, 16, 'page_404', 'page_404_background-color', '#ffffff', NULL),
(4381, 16, 'page_404', 'page_404_background-color-transparent_i', '0', NULL),
(4382, 16, 'page_404', 'page_404_background-repeat', 'repeat', NULL),
(4383, 16, 'page_404', 'page_404_background-size', 'inherit', NULL),
(4384, 16, 'page_404', 'page_404_background-attachment', 'scroll', NULL),
(4385, 16, 'page_404', 'page_404_background-position', 'left top', NULL),
(4386, 16, 'page_404', 'page_404_background-image', NULL, NULL),
(4387, 16, 'page_404', 'page_404_background_image_i', NULL, NULL),
(4388, 16, 'page_404', 'background_overlay_c', '1', NULL),
(4389, 16, 'page_404', 'overlay_background-color', '#000000', NULL),
(4390, 16, 'page_404', 'overlay_background-color-transparent_i', '0', NULL),
(4391, 16, 'page_404', 'overlay_opacity', '0.5', NULL),
(4392, 16, 'page_404', 'title_color', '#000000', NULL),
(4393, 16, 'page_404', 'title_color-transparent_i', '0', NULL),
(4394, 16, 'page_404', 'subtitle_color', '#000000', NULL),
(4395, 16, 'page_404', 'subtitle_color-transparent_i', '0', NULL),
(4396, 16, 'page_404', 'before_button_text_color', '#000000', NULL),
(4397, 16, 'page_404', 'before_button_text_color-transparent_i', '0', NULL),
(4398, 16, 'page_404', 'before_button_color', '#ee9068', NULL),
(4399, 16, 'page_404', 'before_button_color-transparent_i', '0', NULL),
(4400, 16, 'page_404', 'before_button_hover_color', '#ec8a83', NULL),
(4401, 16, 'page_404', 'before_button_hover_color-transparent_i', '0', NULL),
(4402, 16, 'preloader', 'custom_preloader_type', 'text', NULL),
(4403, 16, 'preloader', 'preloader_html', '<h1 style=\'color:undefined\'>Loading.....</h1>', NULL),
(4404, 16, 'preloader', 'preloader_heading_tag', 'h1', NULL),
(4405, 16, 'preloader', 'preloader_text', 'Loading.....', NULL),
(4406, 16, 'single_blog_page', 'custom_single_blog_style', '1', NULL),
(4407, 16, 'single_blog_page', 'blog_post_title_position', 'below_thumbnail', NULL),
(4408, 16, 'single_blog_page', 'blog_details_custom_title', 'Blog Details Page', NULL),
(4409, 16, 'single_blog_page', 'author', '1', NULL),
(4410, 16, 'single_blog_page', 'date', '1', NULL),
(4411, 16, 'single_blog_page', 'reading_time', '1', NULL),
(4412, 16, 'single_blog_page', 'category', '1', NULL),
(4413, 16, 'single_blog_page', 'tags', '1', NULL),
(4414, 16, 'single_blog_page', 'comments', '1', NULL),
(4415, 16, 'single_blog_page', 'biography_info', '1', NULL),
(4416, 16, 'header', 'header_language_select', '1', NULL),
(4417, 16, 'contact', 'custom_contact_style', '0', NULL),
(4418, 16, 'contact', 'contact_image_show', '1', NULL),
(4419, 16, 'contact', 'contact_image_setting', '1', NULL),
(4420, 16, 'contact', 'custom_contact_image', '859', NULL),
(4421, 16, 'contact', 'contact_title', 'Contact Us', NULL),
(4422, 16, 'contact', 'contact_subtitle', 'Contact Us', NULL),
(4423, 16, 'contact', 'contact_name_placeholder', 'Your Name', NULL),
(4424, 16, 'contact', 'contact_email_placeholder', 'Your Email', NULL),
(4425, 16, 'contact', 'contact_subject_placeholder', 'Subject', NULL),
(4426, 16, 'contact', 'contact_message_placeholder', 'Your Message', NULL),
(4427, 16, 'contact', 'contact_button_text', 'Submit', NULL),
(4428, 16, 'contact', 'contact_sent_email', 'cmslooks.themelooks@gmail.com', NULL),
(4429, 16, 'contact', 'contact_header_menu', '1', NULL),
(4430, 16, 'contact', 'contact_header_text', 'Contact', NULL),
(4431, 16, 'footer', 'custom_footer_style', '0', NULL),
(4432, 16, 'footer', 'footer_language_select', '1', NULL),
(4433, 16, 'custom_css', 'custom_css_code', NULL, NULL),
(4434, 16, 'footer', 'footer_bg_color', NULL, NULL),
(4435, 16, 'footer', 'footer_bg_color_transparent', NULL, NULL),
(4436, 16, 'footer', 'custom_footer_padding_top', NULL, NULL),
(4437, 16, 'footer', 'custom_footer_padding_bottom', NULL, NULL),
(4438, 16, 'footer', 'custom_footer_padding_unit', NULL, NULL),
(4439, 16, 'footer', 'footer_social_enable', NULL, NULL),
(4440, 16, 'footer', 'footer_logo_enable', NULL, NULL),
(4441, 16, 'footer', 'footer_text_enable', NULL, NULL),
(4442, 16, 'footer', 'footer_social_color', NULL, NULL),
(4443, 16, 'footer', 'footer_social_color_transparent', NULL, NULL),
(4444, 16, 'footer', 'footer_social_hover_color', NULL, NULL),
(4445, 16, 'footer', 'footer_social_hover_color_transparent', NULL, NULL),
(4446, 16, 'footer', 'footer_logo_anchor_url', NULL, NULL),
(4447, 16, 'footer', 'footer_text_color', NULL, NULL),
(4448, 16, 'footer', 'footer_text_color_transparent', NULL, NULL),
(4449, 16, 'footer', 'footer_anchor_text_color', NULL, NULL),
(4450, 16, 'footer', 'footer_anchor_text_color_transparent', NULL, NULL),
(4451, 16, 'footer', 'footer_anchor_text_hover_color', NULL, NULL),
(4452, 16, 'footer', 'footer_anchor_text_hover_color_transparent', NULL, NULL),
(4453, 16, 'theme_color', 'theme_primary_color', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tl_theme_sidebars`
--

CREATE TABLE `tl_theme_sidebars` (
  `id` int(11) NOT NULL,
  `sidebar_name` varchar(255) DEFAULT NULL,
  `theme_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_theme_sidebars`
--

INSERT INTO `tl_theme_sidebars` (`id`, `sidebar_name`, `theme_id`, `created_at`, `updated_at`) VALUES
(4, 'Footer Sidebar', 15, NULL, NULL),
(5, 'Blog Sidebar', 15, '2023-01-03 05:17:16', '2023-01-03 05:17:16'),
(6, 'Blog Sidebar', 16, '2023-03-16 00:51:08', '2023-03-16 00:51:08'),
(7, 'Page Sidebar', 16, '2023-03-17 22:05:52', '2023-03-17 22:05:52'),
(8, 'Home Page Sidebar', 16, '2023-03-18 05:51:50', '2023-03-18 05:51:50');

-- --------------------------------------------------------

--
-- Table structure for table `tl_theme_translations`
--

CREATE TABLE `tl_theme_translations` (
  `id` int(11) NOT NULL,
  `lang` varchar(250) DEFAULT NULL,
  `lang_key` text DEFAULT NULL,
  `lang_value` longtext DEFAULT NULL,
  `theme` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tl_theme_translations`
--

INSERT INTO `tl_theme_translations` (`id`, `lang`, `lang_key`, `lang_value`, `theme`, `created_at`, `updated_at`) VALUES
(1429, 'en', 'Blog Details Page', 'Blog Details Page', 'default', '2023-04-02 09:06:41', '2023-04-02 09:06:41'),
(1430, 'en', 'Error!', 'Error!', 'default', '2023-04-02 09:15:34', '2023-04-02 09:15:34'),
(1431, 'en', 'Page Not Found', 'Page Not Found', 'default', '2023-04-02 09:15:34', '2023-04-02 09:15:34'),
(1432, 'en', 'What are you doing here all alone, don\'t go to dangerous to places.', 'What are you doing here all alone, don\'t go to dangerous to places.', 'default', '2023-04-02 09:15:34', '2023-04-02 09:15:34'),
(1433, 'en', 'Come Home', 'Come Home', 'default', '2023-04-02 09:15:34', '2023-04-02 09:15:34'),
(1434, 'en', 'View More', 'View More', 'default', '2023-04-02 09:30:20', '2023-04-02 09:30:20'),
(1435, 'en', 'Subscribe', 'Subscribe', 'default', '2023-04-02 09:30:20', '2023-04-02 09:30:20'),
(1436, 'en', 'Search Here', 'Search Here', 'default', '2023-04-02 09:30:20', '2023-04-02 09:30:20'),
(1437, 'en', 'Privacy Policy', 'Privacy Policy', 'default', '2023-04-02 09:30:20', '2023-04-02 09:30:20'),
(1438, 'en', 'Loading.....', 'Loading.....', 'default', '2023-04-02 09:30:32', '2023-04-02 09:30:32'),
(1439, 'bd', 'Blog Details Page', 'ব্লগ বিস্তারিত পৃষ্ঠা', 'default', '2023-04-03 03:42:15', '2023-04-03 04:03:56'),
(1440, 'bd', 'Error!', 'ত্রুটি!', 'default', '2023-04-03 03:42:15', '2023-04-03 04:03:56'),
(1441, 'bd', 'Page Not Found', 'পৃষ্ঠা খুঁজে পাওয়া যায়নি', 'default', '2023-04-03 03:42:15', '2023-04-03 04:03:56'),
(1442, 'bd', 'What are you doing here all alone, don\'t go to dangerous to places.', 'এখানে একা একা কি করছেন, বিপদজনক জায়গায় যাবেন না।', 'default', '2023-04-03 03:42:15', '2023-04-03 04:03:56'),
(1443, 'bd', 'Come Home', 'বাসায় আসুন', 'default', '2023-04-03 03:42:15', '2023-04-03 04:03:56'),
(1444, 'bd', 'View More', 'আরো দেখুন', 'default', '2023-04-03 03:42:16', '2023-04-03 04:03:56'),
(1445, 'bd', 'Subscribe', 'সাবস্ক্রাইব', 'default', '2023-04-03 03:42:16', '2023-04-03 04:03:56'),
(1446, 'bd', 'Search Here', 'এখানে অনুসন্ধান করুন', 'default', '2023-04-03 03:42:16', '2023-04-03 03:42:16'),
(1447, 'bd', 'Privacy Policy', 'গোপনীয়তা নীতি', 'default', '2023-04-03 03:42:16', '2023-04-03 04:03:56'),
(1448, 'bd', 'Loading.....', 'লোড হচ্ছে.....', 'default', '2023-04-03 03:42:16', '2023-04-03 04:03:56'),
(1449, 'en', 'Popular Posts', 'Popular Posts', 'default', '2023-04-03 04:05:36', '2023-04-03 04:05:36'),
(1450, 'en', 'Most Viewed Posts', 'Most Viewed Posts', 'default', '2023-04-03 04:05:36', '2023-04-03 04:05:36'),
(1451, 'en', 'Fashion Blogs', 'Fashion Blogs', 'default', '2023-04-03 04:05:36', '2023-04-03 04:05:36'),
(1452, 'en', 'Read More', 'Read More', 'default', '2023-04-03 04:06:12', '2023-04-03 04:06:12'),
(1453, 'bd', 'Popular Posts', 'জনপ্রিয় পোস্ট', 'default', '2023-04-03 04:07:15', '2023-04-03 04:07:15'),
(1454, 'bd', 'Most Viewed Posts', 'সর্বাধিক দেখা পোস্ট', 'default', '2023-04-03 04:07:15', '2023-04-03 04:07:15'),
(1455, 'bd', 'Fashion Blogs', 'ফ্যাশন ব্লগ', 'default', '2023-04-03 04:07:15', '2023-04-03 04:07:15'),
(1456, 'bd', 'Read More', 'আরও পড়ুন', 'default', '2023-04-03 04:07:15', '2023-04-03 04:07:15'),
(1457, 'en', 'Blog Details', 'Blog Details', 'default', '2023-04-03 04:09:20', '2023-04-03 04:09:20'),
(1458, 'en', 'Home', 'Home', 'default', '2023-04-03 04:09:20', '2023-04-03 04:09:20'),
(1459, 'en', 'This Blog is Password protected. Please Enter The Correct Password To Read The Blog Content.', 'This Blog is Password protected. Please Enter The Correct Password To Read The Blog Content.', 'default', '2023-04-03 04:09:20', '2023-04-03 04:09:20'),
(1460, 'en', 'Enter Blog Password', 'Enter Blog Password', 'default', '2023-04-03 04:09:20', '2023-04-03 04:09:20'),
(1461, 'en', 'Write your comment', 'Write your comment', 'default', '2023-04-03 04:09:20', '2023-04-03 04:09:20'),
(1462, 'en', 'Cancel Reply', 'Cancel Reply', 'default', '2023-04-03 04:09:20', '2023-04-03 04:09:20'),
(1463, 'en', 'You are Logged In.', 'You are Logged In.', 'default', '2023-04-03 04:09:20', '2023-04-03 04:09:20'),
(1464, 'en', 'Log Out?', 'Log Out?', 'default', '2023-04-03 04:09:20', '2023-04-03 04:09:20'),
(1465, 'en', 'Submit', 'Submit', 'default', '2023-04-03 04:09:20', '2023-04-03 04:09:20'),
(1466, 'en', 'Hide Comments', 'Hide Comments', 'default', '2023-04-03 04:09:22', '2023-04-03 04:09:22'),
(1467, 'en', 'Reply', 'Reply', 'default', '2023-04-03 04:09:22', '2023-04-03 04:09:22'),
(1468, 'en', 'See Replies', 'See Replies', 'default', '2023-04-03 04:09:22', '2023-04-03 04:09:22'),
(1469, 'en', 'See More Comments', 'See More Comments', 'default', '2023-04-03 04:09:23', '2023-04-03 04:09:23'),
(1470, 'en', 'No More Comments', 'No More Comments', 'default', '2023-04-03 04:09:40', '2023-04-03 04:09:40'),
(1471, 'en', 'Blog List', 'Blog List', 'default', '2023-04-03 04:19:18', '2023-04-03 04:19:18'),
(1472, 'en', 'Blogs', 'Blogs', 'default', '2023-04-03 04:19:18', '2023-04-03 04:19:18'),
(1473, 'en', 'Password protected', 'Password protected', 'default', '2023-04-03 04:19:19', '2023-04-03 04:19:19'),
(1474, 'en', 'View All', 'View All', 'default', '2023-04-03 04:30:18', '2023-04-03 04:30:18'),
(1475, 'bd', 'Blog Details', 'ব্লগ বিস্তারিত', 'default', '2023-04-03 04:32:39', '2023-04-03 04:32:39'),
(1476, 'bd', 'Home', 'বাড়ি', 'default', '2023-04-03 04:32:39', '2023-04-03 04:32:39'),
(1477, 'bd', 'This Blog is Password protected. Please Enter The Correct Password To Read The Blog Content.', 'এই ব্লগটি পাসওয়ার্ড সুরক্ষিত। ব্লগের বিষয়বস্তু পড়ার জন্য অনুগ্রহ করে সঠিক পাসওয়ার্ড দিন।', 'default', '2023-04-03 04:32:39', '2023-04-03 04:32:39'),
(1478, 'bd', 'Enter Blog Password', 'ব্লগ পাসওয়ার্ড লিখুন', 'default', '2023-04-03 04:32:39', '2023-04-03 04:32:39'),
(1479, 'bd', 'Write your comment', 'আপনার মন্তব্য লিখুন', 'default', '2023-04-03 04:32:39', '2023-04-03 04:32:39'),
(1480, 'bd', 'Cancel Reply', 'উত্তর বাতিল করুন', 'default', '2023-04-03 04:32:39', '2023-04-03 04:32:39'),
(1481, 'bd', 'You are Logged In.', 'আপনি সংযুক্ত আছেন.', 'default', '2023-04-03 04:34:40', '2023-04-03 04:34:40'),
(1482, 'bd', 'Log Out?', 'প্রস্থান?', 'default', '2023-04-03 04:34:40', '2023-04-03 04:34:40'),
(1483, 'bd', 'Submit', 'জমা দিন', 'default', '2023-04-03 04:34:40', '2023-04-03 04:34:40'),
(1484, 'bd', 'Hide Comments', 'মন্তব্য লুকান', 'default', '2023-04-03 04:34:40', '2023-04-03 04:34:40'),
(1485, 'bd', 'Reply', 'উত্তর দিন', 'default', '2023-04-03 04:34:40', '2023-04-03 04:34:40'),
(1486, 'bd', 'See Replies', 'উত্তর দেখুন', 'default', '2023-04-03 04:34:40', '2023-04-03 04:34:40'),
(1487, 'bd', 'See More Comments', 'আরো মন্তব্য দেখুন', 'default', '2023-04-03 04:34:40', '2023-04-03 04:34:40'),
(1488, 'bd', 'No More Comments', 'আর কোন মন্তব্য নেই', 'default', '2023-04-03 04:34:40', '2023-04-03 04:34:40'),
(1489, 'bd', 'Blog List', 'ব্লগ তালিকা', 'default', '2023-04-03 04:34:40', '2023-04-03 04:34:40'),
(1490, 'bd', 'Blogs', 'ব্লগ', 'default', '2023-04-03 04:34:40', '2023-04-03 04:34:40'),
(1491, 'bd', 'Password protected', 'পাসওয়ার্ড সুরক্ষিত', 'default', '2023-04-03 04:34:40', '2023-04-03 04:34:40'),
(1492, 'bd', 'View All', 'সব দেখ', 'default', '2023-04-03 04:34:40', '2023-04-03 04:34:40'),
(1493, 'en', 'Subscribe Our Newsletter', 'Subscribe Our Newsletter', 'default', '2023-04-03 05:36:34', '2023-04-03 05:36:34'),
(1494, 'en', 'Enter Your Email', 'Enter Your Email', 'default', '2023-04-03 05:36:34', '2023-04-03 05:36:34'),
(1495, 'en', 'I\'ve read and accept the', 'I\'ve read and accept the', 'default', '2023-04-03 05:36:34', '2023-04-03 05:36:34'),
(1496, 'bd', 'Subscribe Our Newsletter', 'আমাদের নিউজলেটার সদস্যতা', 'default', '2023-04-03 05:38:31', '2023-04-03 05:38:31'),
(1497, 'bd', 'Enter Your Email', 'আপনি ইমেইল প্রবেশ করান', 'default', '2023-04-03 05:38:31', '2023-04-03 05:38:31'),
(1498, 'bd', 'I\'ve read and accept the', 'আমি পড়েছি এবং গ্রহণ করেছি', 'default', '2023-04-03 05:38:31', '2023-04-03 05:38:31'),
(1499, 'en', 'On recommend tolerably my belonging or am. Mutual has cannot beauty indeed now sussex merely you. It possible no husbands jennings ye offended packages pleasant he.jennings ye offended packages pleasa', 'On recommend tolerably my belonging or am. Mutual has cannot beauty indeed now sussex merely you. It possible no husbands jennings ye offended packages pleasant he.jennings ye offended packages pleasa', 'default', '2023-04-03 06:13:45', '2023-04-03 06:13:45'),
(1500, 'bd', 'On recommend tolerably my belonging or am. Mutual has cannot beauty indeed now sussex merely you. It possible no husbands jennings ye offended packages pleasant he.jennings ye offended packages pleasa', 'সুপারিশ সহনশীলভাবে আমার একাত্মতা বা আমি. পারস্পরিক সৌন্দর্য সত্যিই এখন শুধু আপনি সাসেক্স করতে পারে না. এটা সম্ভব কোন স্বামী জেনিংস ইয়ে অফেন্ডেড প্যাকেজ প্লিজেন্ট হে জেনিংস ই অফেন্ডেড প্যাকেজ প্লিজ', 'default', '2023-04-03 06:23:45', '2023-04-03 06:23:45'),
(1502, 'en', 'Comment Loaded Successfully', 'Comment Loaded Successfully', 'default', '2023-04-03 06:41:53', '2023-04-03 06:41:53'),
(1503, 'en', 'Please Enter a Valid Email', 'Please Enter a Valid Email', 'default', '2023-04-03 06:41:58', '2023-04-03 06:41:58'),
(1504, 'en', 'Newsletter Subscribing Failed. Please Contact With Admin', 'Newsletter Subscribing Failed. Please Contact With Admin', 'default', '2023-04-03 06:44:02', '2023-04-03 06:44:02'),
(1505, 'bd', 'Newsletter Subscribing Failed. Please Contact With Admin', 'নিউজলেটার সদস্যতা ব্যর্থ হয়েছে. অ্যাডমিনের সাথে যোগাযোগ করুন', 'default', '2023-04-03 06:44:31', '2023-04-03 06:44:31'),
(1506, 'bd', 'Please Enter a Valid Email', 'একটি বৈধ ইমেইল প্রবেশ করুন', 'default', '2023-04-03 06:44:31', '2023-04-03 06:44:31'),
(1507, 'bd', 'Comment Loaded Successfully', 'মন্তব্য সফলভাবে লোড হয়েছে', 'default', '2023-04-03 06:44:31', '2023-04-03 06:44:31'),
(1508, 'en', 'Content Request Failed', 'Content Request Failed', 'default', '2023-04-03 06:54:10', '2023-04-03 06:54:10'),
(1509, 'en', 'Comment Request Failed', 'Comment Request Failed', 'default', '2023-04-03 06:54:10', '2023-04-03 06:54:10'),
(1510, 'en', 'Success!', 'Success!', 'default', '2023-04-03 06:54:10', '2023-04-03 06:54:10'),
(1511, 'en', 'Warning!', 'Warning!', 'default', '2023-04-03 06:54:10', '2023-04-03 06:54:10'),
(1512, 'en', 'Pending!', 'Pending!', 'default', '2023-04-03 06:54:10', '2023-04-03 06:54:10'),
(1513, 'en', 'Comment Submit Failed', 'Comment Submit Failed', 'default', '2023-04-03 06:54:10', '2023-04-03 06:54:10'),
(1514, 'en', 'Category', 'Category', 'default', '2023-04-03 07:41:22', '2023-04-03 07:41:22'),
(1516, 'en', 'No More Blogs', 'No More Blogs', 'default', '2023-04-03 07:41:22', '2023-04-03 07:41:22'),
(1517, 'en', 'Tag', 'Tag', 'default', '2023-04-03 08:21:41', '2023-04-03 08:21:41'),
(1518, 'en', 'Blog', 'Blog', 'default', '2023-04-03 08:21:41', '2023-04-03 08:21:41'),
(1519, 'bd', 'Blog', 'ব্লগ', 'default', '2023-04-03 08:31:15', '2023-04-03 08:34:56'),
(1520, 'bd', 'Tag', 'ট্যাগ', 'default', '2023-04-03 08:31:15', '2023-04-03 08:31:15'),
(1521, 'bd', 'No More Blogs', 'আর কোন ব্লগ নেই', 'default', '2023-04-03 08:31:15', '2023-04-03 08:31:15'),
(1522, 'bd', 'Category', 'শ্রেণী', 'default', '2023-04-03 08:31:15', '2023-04-03 08:31:15'),
(1523, 'bd', 'Comment Submit Failed', 'মন্তব্য জমা দিতে ব্যর্থ হয়েছে', 'default', '2023-04-03 08:31:15', '2023-04-03 08:31:15'),
(1524, 'bd', 'Pending!', 'বিচারাধীন!', 'default', '2023-04-03 08:31:15', '2023-04-03 08:31:15'),
(1525, 'bd', 'Warning!', 'সতর্কতা !', 'default', '2023-04-03 08:31:15', '2023-04-03 08:35:42'),
(1526, 'bd', 'Success!', 'সফলতার !', 'default', '2023-04-03 08:31:15', '2023-04-03 08:35:42'),
(1527, 'bd', 'Comment Request Failed', 'মন্তব্য অনুরোধ ব্যর্থ হয়েছে', 'default', '2023-04-03 08:31:15', '2023-04-03 08:35:42'),
(1528, 'bd', 'Content Request Failed', 'বিষয়বস্তুর অনুরোধ ব্যর্থ হয়েছে৷', 'default', '2023-04-03 08:31:15', '2023-04-03 08:35:42'),
(1529, 'en', 'Featured Blogs', 'Featured Blogs', 'default', '2023-04-03 08:33:30', '2023-04-03 08:33:30'),
(1530, 'en', 'featured', 'featured', 'default', '2023-04-03 08:34:24', '2023-04-03 08:34:24'),
(1531, 'bd', 'Featured Blogs', 'বৈশিষ্ট্যযুক্ত ব্লগ', 'default', '2023-04-03 08:34:56', '2023-04-03 08:35:42'),
(1532, 'bd', 'featured', 'বৈশিষ্ট্যযুক্ত', 'default', '2023-04-03 08:35:42', '2023-04-03 08:35:42'),
(1533, 'en', 'Search Result', 'Search Result', 'default', '2023-04-03 08:36:12', '2023-04-03 08:36:12'),
(1534, 'en', 'No Blogs Found', 'No Blogs Found', 'default', '2023-04-03 08:36:13', '2023-04-03 08:36:13'),
(1535, 'en', 'Search Result For', 'Search Result For', 'default', '2023-04-03 08:37:02', '2023-04-03 08:37:02'),
(1536, 'bd', 'Search Result For', 'জন্য অনুসন্ধান ফলাফল', 'default', '2023-04-03 08:38:06', '2023-04-03 08:38:06'),
(1537, 'bd', 'No Blogs Found', 'কোন ব্লগ পাওয়া যায়নি', 'default', '2023-04-03 08:38:06', '2023-04-03 08:38:06'),
(1538, 'bd', 'Search Result', 'অনুসন্ধান ফলাফল', 'default', '2023-04-03 08:38:06', '2023-04-03 08:38:06'),
(1541, 'en', 'Contact', 'Contact', 'default', '2023-04-03 09:25:38', '2023-04-03 09:25:38'),
(1542, 'bd', 'Contact', 'যোগাযোগ', 'default', '2023-04-03 09:27:35', '2023-04-03 09:27:35'),
(1545, 'en', 'Your Name', 'Your Name', 'default', '2023-04-04 05:35:35', '2023-04-04 05:35:35'),
(1546, 'en', 'Your Email', 'Your Email', 'default', '2023-04-04 05:35:35', '2023-04-04 05:35:35'),
(1547, 'en', 'Subject', 'Subject', 'default', '2023-04-04 05:35:35', '2023-04-04 05:35:35'),
(1548, 'en', 'Your Message', 'Your Message', 'default', '2023-04-04 05:35:35', '2023-04-04 05:35:35'),
(1549, 'bd', 'Your Message', 'তোমার বার্তা', 'default', '2023-04-04 05:36:25', '2023-04-04 05:36:25'),
(1550, 'bd', 'Subject', 'বিষয়', 'default', '2023-04-04 05:36:25', '2023-04-04 05:36:25'),
(1551, 'bd', 'Your Email', 'তোমার ইমেইল', 'default', '2023-04-04 05:36:25', '2023-04-04 05:36:25'),
(1552, 'bd', 'Your Name', 'তোমার নাম', 'default', '2023-04-04 05:36:25', '2023-04-04 05:36:25'),
(1555, 'en', 'Contact Us', 'Contact Us', 'default', '2023-04-04 05:37:44', '2023-04-04 05:37:44'),
(1556, 'bd', 'Contact Us', 'যোগাযোগ করুন', 'default', '2023-04-04 05:38:03', '2023-04-04 05:38:03'),
(1559, 'en', 'Get In Touch', 'Get In Touch', 'default', '2023-04-04 06:12:25', '2023-04-04 06:12:25'),
(1560, 'en', 'Whether you have a question, want to start a project or simply want to connect. Feel free to send me a message in the contact form', 'Whether you have a question, want to start a project or simply want to connect. Feel free to send me a message in the contact form', 'default', '2023-04-04 06:12:25', '2023-04-04 06:12:25'),
(1561, 'en', 'Email Sent Successfully', 'Email Sent Successfully', 'default', '2023-04-04 08:12:14', '2023-04-04 08:12:14'),
(1562, 'en', 'Email Sending Failed', 'Email Sending Failed', 'default', '2023-04-04 08:22:19', '2023-04-04 08:22:19'),
(1563, 'en', 'Please fill in all fields and ensure that the data entered is valid.', 'Please fill in all fields and ensure that the data entered is valid.', 'default', '2023-04-04 08:37:25', '2023-04-04 08:37:25'),
(1564, 'en', 'Email sending failed. Please contact with admin', 'Email sending failed. Please contact with admin', 'default', '2023-04-04 09:04:53', '2023-04-04 09:04:53'),
(1567, 'bd', 'Email sending failed. Please contact with admin', 'ইমেল পাঠানো ব্যর্থ হয়েছে. এডমিনের সাথে যোগাযোগ করুন', 'default', '2023-04-08 08:14:05', '2023-04-08 08:14:05'),
(1568, 'bd', 'Please fill in all fields and ensure that the data entered is valid.', 'অনুগ্রহ করে সমস্ত ক্ষেত্র পূরণ করুন এবং নিশ্চিত করুন যে প্রবেশ করা ডেটা বৈধ।', 'default', '2023-04-08 08:14:05', '2023-04-08 08:14:05'),
(1569, 'bd', 'Email Sending Failed', 'ইমেল পাঠানো ব্যর্থ হয়েছে', 'default', '2023-04-08 08:14:05', '2023-04-08 08:14:05'),
(1570, 'bd', 'Email Sent Successfully', 'ইমেল সফলভাবে পাঠানো হয়েছে', 'default', '2023-04-08 08:14:05', '2023-04-08 08:14:05'),
(1571, 'bd', 'Whether you have a question, want to start a project or simply want to connect. Feel free to send me a message in the contact form', 'আপনার একটি প্রশ্ন আছে কিনা, একটি প্রকল্প শুরু করতে চান বা কেবল সংযোগ করতে চান। আমাকে যোগাযোগ ফর্ম একটি বার্তা পাঠাতে নির্দ্বিধায়', 'default', '2023-04-08 08:14:05', '2023-04-08 08:14:05'),
(1572, 'bd', 'Get In Touch', 'যোগাযোগ করুন', 'default', '2023-04-08 08:14:05', '2023-04-08 08:14:05'),
(1573, 'sa', 'Email sending failed. Please contact with admin', 'يرجى التواصل مع المسؤول', 'default', '2023-04-08 08:17:41', '2023-04-08 08:17:41'),
(1574, 'sa', 'Please fill in all fields and ensure that the data entered is valid.', 'يرجى ملء جميع الحقول والتأكد من صحة البيانات المدخلة.', 'default', '2023-04-08 08:17:41', '2023-04-08 08:17:41'),
(1575, 'sa', 'Email Sending Failed', 'فشل إرسال البريد الإلكتروني', 'default', '2023-04-08 08:17:41', '2023-04-08 08:17:41'),
(1576, 'sa', 'Email Sent Successfully', 'تم إرسال البريد الإلكتروني بنجاح', 'default', '2023-04-08 08:17:41', '2023-04-08 08:17:41'),
(1577, 'sa', 'Whether you have a question, want to start a project or simply want to connect. Feel free to send me a message in the contact form', 'لا تتردد في إرسال رسالة إلي في نموذج الاتصال', 'default', '2023-04-08 08:17:41', '2023-04-08 08:17:41'),
(1578, 'sa', 'Get In Touch', 'ابقى على تواصل', 'default', '2023-04-08 08:17:41', '2023-04-08 08:17:41'),
(1579, 'sa', 'Contact Us', 'اتصل بنا', 'default', '2023-04-08 08:17:41', '2023-04-08 08:17:41'),
(1580, 'sa', 'Your Message', 'رسالتك', 'default', '2023-04-08 08:17:41', '2023-04-08 08:17:41'),
(1581, 'sa', 'Subject', 'موضوع', 'default', '2023-04-08 08:17:41', '2023-04-08 08:17:41'),
(1582, 'sa', 'Your Email', 'بريدك الالكتروني', 'default', '2023-04-08 08:17:41', '2023-04-08 08:17:41'),
(1583, 'sa', 'Your Name', 'اسمك', 'default', '2023-04-08 08:17:41', '2023-04-08 08:17:41'),
(1584, 'sa', 'Contact', 'اتصال', 'default', '2023-04-08 08:17:41', '2023-04-08 08:17:41'),
(1585, 'sa', 'Search Result For', 'نتيجة البحث عن', 'default', '2023-04-08 08:17:41', '2023-04-08 08:17:41'),
(1586, 'sa', 'No Blogs Found', 'لم يتم العثور على مدونات', 'default', '2023-04-08 08:17:41', '2023-04-08 08:17:41'),
(1587, 'sa', 'Search Result', 'نتيجة البحث', 'default', '2023-04-08 08:17:41', '2023-04-08 08:17:41'),
(1588, 'sa', 'featured', 'متميز', 'default', '2023-04-08 08:17:41', '2023-04-08 08:17:41'),
(1589, 'sa', 'Featured Blogs', 'مدونات مميزة', 'default', '2023-04-08 08:17:41', '2023-04-08 08:17:41'),
(1590, 'sa', 'Blog', 'مدونة', 'default', '2023-04-08 08:17:41', '2023-04-08 08:17:41'),
(1591, 'sa', 'Tag', 'بطاقة شعار', 'default', '2023-04-08 08:17:41', '2023-04-08 08:17:41'),
(1592, 'sa', 'No More Blogs', 'لا مزيد من المدونات', 'default', '2023-04-08 08:17:41', '2023-04-08 08:17:41'),
(1593, 'sa', 'Category', 'فئة', 'default', '2023-04-08 08:18:30', '2023-04-08 08:18:30'),
(1594, 'sa', 'Comment Submit Failed', 'التعليق فشل إرسال', 'default', '2023-04-08 08:18:30', '2023-04-08 08:18:30'),
(1595, 'sa', 'Pending!', 'قيد الانتظار!', 'default', '2023-04-08 08:18:30', '2023-04-08 08:18:30'),
(1596, 'sa', 'Warning!', 'تحذير!', 'default', '2023-04-08 08:18:30', '2023-04-08 08:18:30'),
(1597, 'sa', 'Success!', 'نجاح!', 'default', '2023-04-08 08:18:30', '2023-04-08 08:18:30'),
(1598, 'sa', 'Comment Request Failed', 'فشل طلب التعليق', 'default', '2023-04-08 08:18:30', '2023-04-08 08:18:30'),
(1599, 'sa', 'Content Request Failed', 'فشل طلب المحتوى', 'default', '2023-04-08 08:18:30', '2023-04-08 08:18:30'),
(1600, 'sa', 'Newsletter Subscribing Failed. Please Contact With Admin', 'يرجى التواصل مع المسؤول', 'default', '2023-04-08 08:18:30', '2023-04-08 08:18:30'),
(1601, 'sa', 'Please Enter a Valid Email', 'يرجى إدخال البريد الإلكتروني الصحيح', 'default', '2023-04-08 08:18:30', '2023-04-08 08:18:30'),
(1602, 'sa', 'Comment Loaded Successfully', 'تم تحميل التعليق بنجاح', 'default', '2023-04-08 08:18:30', '2023-04-08 08:18:30'),
(1603, 'sa', 'On recommend tolerably my belonging or am. Mutual has cannot beauty indeed now sussex merely you. It possible no husbands jennings ye offended packages pleasant he.jennings ye offended packages pleasa', 'من الممكن أن لا يكون هناك أي أزواج يسيئون إلى الطرود اللطيفة', 'default', '2023-04-08 08:18:30', '2023-04-08 08:18:30'),
(1604, 'sa', 'I\'ve read and accept the', 'لقد قرأت وقبلت', 'default', '2023-04-08 08:18:30', '2023-04-08 08:18:30'),
(1605, 'sa', 'Enter Your Email', 'أدخل بريدك الإلكتروني', 'default', '2023-04-08 08:18:30', '2023-04-08 08:18:30'),
(1606, 'sa', 'Subscribe Our Newsletter', 'اشترك في النشرة الإخبارية لدينا', 'default', '2023-04-08 08:18:30', '2023-04-08 08:18:30'),
(1607, 'sa', 'View All', 'مشاهدة الكل', 'default', '2023-04-08 08:18:30', '2023-04-08 08:18:30'),
(1608, 'sa', 'Password protected', 'محمية بكلمة مرور', 'default', '2023-04-08 08:18:30', '2023-04-08 08:18:30'),
(1609, 'sa', 'Blogs', 'المدونات', 'default', '2023-04-08 08:18:30', '2023-04-08 08:18:30'),
(1610, 'sa', 'Blog List', 'قائمة المدونة', 'default', '2023-04-08 08:18:30', '2023-04-08 08:18:30'),
(1611, 'sa', 'No More Comments', 'لا المزيد من التعليقات', 'default', '2023-04-08 08:18:30', '2023-04-08 08:18:30'),
(1612, 'sa', 'See More Comments', 'مشاهدة المزيد من التعليقات', 'default', '2023-04-08 08:18:30', '2023-04-08 08:18:30'),
(1613, 'sa', 'See Replies', 'انظر الردود', 'default', '2023-04-08 08:18:52', '2023-04-08 08:18:52'),
(1614, 'sa', 'Reply', 'رد', 'default', '2023-04-08 08:18:52', '2023-04-08 08:18:52'),
(1615, 'sa', 'Hide Comments', 'إخفاء التعليقات', 'default', '2023-04-08 08:18:52', '2023-04-08 08:18:52'),
(1616, 'sa', 'Submit', 'يُقدِّم', 'default', '2023-04-08 08:18:52', '2023-04-08 08:18:52'),
(1617, 'sa', 'Log Out?', 'تسجيل خروج؟', 'default', '2023-04-08 08:18:52', '2023-04-08 08:18:52'),
(1618, 'sa', 'You are Logged In.', 'لقد سجلت الدخول.', 'default', '2023-04-08 08:18:52', '2023-04-08 08:18:52'),
(1619, 'sa', 'Cancel Reply', 'إلغاء الرد', 'default', '2023-04-08 08:18:52', '2023-04-08 08:18:52'),
(1620, 'sa', 'Write your comment', 'اكتب تعليقك', 'default', '2023-04-08 08:18:52', '2023-04-08 08:18:52'),
(1621, 'sa', 'Enter Blog Password', 'أدخل كلمة مرور المدونة', 'default', '2023-04-08 08:18:52', '2023-04-08 08:18:52'),
(1622, 'sa', 'This Blog is Password protected. Please Enter The Correct Password To Read The Blog Content.', 'الرجاء إدخال كلمة المرور الصحيحة لقراءة محتوى المدونة.', 'default', '2023-04-08 08:18:52', '2023-04-08 08:18:52'),
(1623, 'sa', 'Home', 'بيت', 'default', '2023-04-08 08:18:52', '2023-04-08 08:18:52'),
(1624, 'sa', 'Blog Details', 'تفاصيل المدونة', 'default', '2023-04-08 08:18:52', '2023-04-08 08:18:52'),
(1625, 'sa', 'Read More', 'اقرأ أكثر', 'default', '2023-04-08 08:18:52', '2023-04-08 08:18:52'),
(1626, 'sa', 'Fashion Blogs', 'مدونات الموضة', 'default', '2023-04-08 08:18:52', '2023-04-08 08:18:52'),
(1627, 'sa', 'Most Viewed Posts', 'المشاركات الأكثر مشاهدة', 'default', '2023-04-08 08:18:52', '2023-04-08 08:18:52'),
(1628, 'sa', 'Popular Posts', 'منشورات شائعة', 'default', '2023-04-08 08:18:52', '2023-04-08 08:18:52'),
(1629, 'sa', 'Loading.....', 'تحميل.....', 'default', '2023-04-08 08:18:52', '2023-04-08 08:18:52'),
(1630, 'sa', 'Privacy Policy', 'سياسة الخصوصية', 'default', '2023-04-08 08:18:52', '2023-04-08 08:18:52'),
(1631, 'sa', 'Search Here', 'ابحث هنا', 'default', '2023-04-08 08:18:52', '2023-04-08 08:18:52'),
(1632, 'sa', 'Subscribe', 'يشترك', 'default', '2023-04-08 08:18:52', '2023-04-08 08:18:52'),
(1633, 'sa', 'View More', 'عرض المزيد', 'default', '2023-04-08 08:19:09', '2023-04-08 08:19:09'),
(1634, 'sa', 'Come Home', 'تعال الى المنزل', 'default', '2023-04-08 08:19:09', '2023-04-08 08:19:09'),
(1635, 'sa', 'What are you doing here all alone, don\'t go to dangerous to places.', 'ماذا تفعل هنا بمفردك ، لا تذهب إلى أماكن خطرة.', 'default', '2023-04-08 08:19:09', '2023-04-08 08:19:09'),
(1636, 'sa', 'Page Not Found', 'الصفحة غير موجودة', 'default', '2023-04-08 08:19:09', '2023-04-08 08:19:09'),
(1637, 'sa', 'Error!', 'خطأ!', 'default', '2023-04-08 08:19:09', '2023-04-08 08:19:09'),
(1638, 'sa', 'Blog Details Page', 'صفحة تفاصيل المدونة', 'default', '2023-04-08 08:19:10', '2023-04-08 08:19:10'),
(1639, 'en', 'min read', 'min read', 'default', '2023-04-08 09:00:12', '2023-04-08 09:00:12'),
(1640, 'en', 'Log In', 'Log In', 'default', '2023-04-09 04:34:36', '2023-04-09 04:34:36'),
(1641, 'en', 'Name', 'Name', 'default', '2023-04-09 04:34:36', '2023-04-09 04:34:36'),
(1642, 'en', 'Email', 'Email', 'default', '2023-04-09 04:34:36', '2023-04-09 04:34:36'),
(1644, 'en', 'Comment Loading Failed', 'Comment Loading Failed', 'default', '2023-04-09 08:48:06', '2023-04-09 08:48:06'),
(1645, 'en', 'Adds', 'Adds', 'default', '2023-04-12 08:50:10', '2023-04-12 08:50:10'),
(2427, 'en', 'Page Preview', 'Page Preview', 'default', '2023-05-02 04:30:33', '2023-05-02 04:30:33'),
(2496, 'en', 'Incorrect Password', 'Incorrect Password', 'default', '2023-05-02 04:56:59', '2023-05-02 04:56:59'),
(2506, 'en', 'Leave a Reply to', 'Leave a Reply to', 'default', '2023-05-02 04:57:15', '2023-05-02 04:57:15'),
(2957, 'en', 'The page you are looking for was moved, removed, renamed, or never existed. Please check the URL or go to', 'The page you are looking for was moved, removed, renamed, or never existed. Please check the URL or go to', 'default', '2023-05-02 06:17:12', '2023-05-02 06:17:12'),
(2958, 'en', 'Main Page', 'Main Page', 'default', '2023-05-02 06:17:12', '2023-05-02 06:17:12'),
(2983, 'en', 'Author', 'Author', 'default', '2023-05-03 08:40:13', '2023-05-03 08:40:13'),
(2986, 'en', 'Date', 'Date', 'default', '2023-05-03 11:30:48', '2023-05-03 11:30:48'),
(2987, 'en', 'Featured', 'Featured', 'default', '2023-05-06 04:22:50', '2023-05-06 04:22:50'),
(2988, 'en', 'Website (optional)', 'Website (optional)', 'default', '2023-05-09 04:48:42', '2023-05-09 04:48:42'),
(2989, 'en', 'No Advertise', 'No Advertise', 'default', '2023-05-09 10:34:13', '2023-05-09 10:34:13'),
(2992, 'en', 'On recommend tolerably my belonging or am. Mutual has cannot beauty indeed now sussex merely you.', 'On recommend tolerably my belonging or am. Mutual has cannot beauty indeed now sussex merely you.', 'default', '2023-05-10 11:46:40', '2023-05-10 11:46:40'),
(2993, 'bd', 'On recommend tolerably my belonging or am. Mutual has cannot beauty indeed now sussex merely you.', 'সুপারিশ সহনশীলভাবে আমার একাত্মতা বা আমি. পারস্পরিক সৌন্দর্য সত্যিই এখন শুধু আপনি সাসেক্স করতে পারে না.', 'default', '2023-05-13 06:11:23', '2023-05-13 06:11:23'),
(2994, 'bd', 'No Advertise', 'বিজ্ঞাপন নেই', 'default', '2023-05-13 06:11:23', '2023-05-13 06:11:23'),
(2995, 'bd', 'Website (optional)', 'ওয়েবসাইট (ঐচ্ছিক)', 'default', '2023-05-13 06:11:23', '2023-05-13 06:11:23'),
(2996, 'bd', 'Date', 'তারিখ', 'default', '2023-05-13 06:11:23', '2023-05-13 06:11:23'),
(2997, 'bd', 'Author', 'লেখক', 'default', '2023-05-13 06:11:23', '2023-05-13 06:11:23'),
(2998, 'bd', 'Main Page', 'প্রধান পাতা', 'default', '2023-05-13 06:11:23', '2023-05-13 06:11:23'),
(2999, 'bd', 'The page you are looking for was moved, removed, renamed, or never existed. Please check the URL or go to', 'আপনি যে পৃষ্ঠাটি খুঁজছেন তা সরানো হয়েছে, সরানো হয়েছে, পুনঃনামকরণ করা হয়েছে বা কখনও বিদ্যমান ছিল না। ইউআরএল চেক করুন বা যান', 'default', '2023-05-13 06:11:23', '2023-05-13 06:11:23'),
(3000, 'bd', 'Leave a Reply to', 'একটি উত্তর ত্যাগ', 'default', '2023-05-13 06:11:23', '2023-05-13 06:11:23'),
(3001, 'bd', 'Incorrect Password', 'ভুল পাসওয়ার্ড', 'default', '2023-05-13 06:11:23', '2023-05-13 06:11:23'),
(3002, 'bd', 'Page Preview', 'পৃষ্ঠা পূর্বরূপ', 'default', '2023-05-13 06:11:23', '2023-05-13 06:11:23'),
(3003, 'bd', 'Adds', 'যোগ করে', 'default', '2023-05-13 06:11:23', '2023-05-13 06:11:23'),
(3004, 'bd', 'Comment Loading Failed', 'মন্তব্য লোড করা ব্যর্থ হয়েছে৷', 'default', '2023-05-13 06:11:23', '2023-05-13 06:11:23'),
(3005, 'bd', 'Email', 'ইমেইল', 'default', '2023-05-13 06:11:23', '2023-05-13 06:11:23'),
(3006, 'bd', 'Name', 'নাম', 'default', '2023-05-13 06:11:23', '2023-05-13 06:11:23'),
(3007, 'bd', 'Log In', 'প্রবেশ করুন', 'default', '2023-05-13 06:11:23', '2023-05-13 06:11:23'),
(3008, 'bd', 'min read', 'মিনিট পড়া', 'default', '2023-05-13 06:11:23', '2023-05-13 06:11:23'),
(3009, 'sa', 'On recommend tolerably my belonging or am. Mutual has cannot beauty indeed now sussex merely you.', 'على أوصي بشكل محتمل انتمائي أو أنا. لا يمكن لـ Mutual أن الجمال حقًا الآن ساسكس فقط أنت.', 'default', '2023-05-13 06:13:27', '2023-05-13 06:13:27'),
(3010, 'sa', 'No Advertise', 'لا اعلان', 'default', '2023-05-13 06:13:27', '2023-05-13 06:13:27'),
(3011, 'sa', 'Website (optional)', 'صفحة انترنت (اختياري)', 'default', '2023-05-13 06:13:27', '2023-05-13 06:13:27'),
(3012, 'sa', 'Date', 'تاريخ', 'default', '2023-05-13 06:13:27', '2023-05-13 06:13:27'),
(3013, 'sa', 'Author', 'مؤلف', 'default', '2023-05-13 06:13:27', '2023-05-13 06:13:27'),
(3014, 'sa', 'Main Page', 'الصفحة الرئيسية', 'default', '2023-05-13 06:13:27', '2023-05-13 06:13:27'),
(3015, 'sa', 'The page you are looking for was moved, removed, renamed, or never existed. Please check the URL or go to', 'الصفحة التي تبحث عنها تم نقلها أو إزالتها أو إعادة تسميتها أو عدم وجودها مطلقًا. يرجى التحقق من عنوان URL أو الانتقال إلى', 'default', '2023-05-13 06:13:27', '2023-05-13 06:13:27'),
(3016, 'sa', 'Leave a Reply to', 'اترك ردا ل', 'default', '2023-05-13 06:13:27', '2023-05-13 06:13:27'),
(3017, 'sa', 'Incorrect Password', 'كلمة سر خاطئة', 'default', '2023-05-13 06:13:27', '2023-05-13 06:13:27'),
(3018, 'sa', 'Page Preview', 'معاينة الصفحة', 'default', '2023-05-13 06:13:27', '2023-05-13 06:13:27'),
(3019, 'sa', 'Adds', 'يضيف', 'default', '2023-05-13 06:13:27', '2023-05-13 06:13:27'),
(3020, 'sa', 'Comment Loading Failed', 'التعليق فشل تحميل', 'default', '2023-05-13 06:13:27', '2023-05-13 06:13:27'),
(3021, 'sa', 'Email', 'بريد إلكتروني', 'default', '2023-05-13 06:13:27', '2023-05-13 06:13:27'),
(3022, 'sa', 'Name', 'اسم', 'default', '2023-05-13 06:13:27', '2023-05-13 06:13:27'),
(3023, 'sa', 'Log In', 'تسجيل الدخول', 'default', '2023-05-13 06:13:27', '2023-05-13 06:13:27'),
(3024, 'sa', 'min read', 'قراءة دقيقة', 'default', '2023-05-13 06:13:27', '2023-05-13 06:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `tl_translations`
--

CREATE TABLE `tl_translations` (
  `id` int(11) NOT NULL,
  `lang` text DEFAULT NULL,
  `lang_key` text DEFAULT NULL,
  `lang_value` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_translations`
--

INSERT INTO `tl_translations` (`id`, `lang`, `lang_key`, `lang_value`, `created_at`, `updated_at`) VALUES
(5206, 'en', 'cache_clear_successfully', 'Cache clear successfully', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5207, 'en', 'languages', 'Languages', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5208, 'en', 'add_new_language', 'Add New Language', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5209, 'en', 'name', 'Name', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5210, 'en', 'native_name', 'Native Name', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5211, 'en', 'code', 'Code', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5212, 'en', 'flag', 'Flag', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5213, 'en', 'rtl', 'RTL', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5214, 'en', 'status', 'Status', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5215, 'en', 'actions', 'Actions', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5216, 'en', 'backend_translations', 'Backend Translations', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5217, 'en', 'frontend_translations', 'Frontend Translations', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5218, 'en', 'edit', 'Edit', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5219, 'en', 'delete', 'Delete', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5220, 'en', 'delete_confirmation', 'Delete Confirmation', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5221, 'en', 'are_you_sure_to_delete_this', 'Are you sure to delete this', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5222, 'en', 'cencel', 'Cencel', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5223, 'en', 'my_profile', 'My Profile', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5224, 'en', 'log_out', 'Log Out', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5225, 'en', 'clear_cache', 'Clear Cache', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5226, 'en', 'notifications', 'Notifications', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5227, 'en', 'clear_all', 'Clear all', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5228, 'en', 'dashboard', 'Dashboard', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5229, 'en', 'media', 'Media', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5230, 'en', 'blog', 'Blog', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5231, 'en', 'all_blogs', 'All Blogs', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5232, 'en', 'add_new_blog', 'Add New Blog', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5233, 'en', 'categories', 'Categories', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5234, 'en', 'tags', 'Tags', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5235, 'en', 'comments', 'Comments', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5236, 'en', 'settings', 'Settings', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5237, 'en', 'comment_settings', 'Comment Settings', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5238, 'en', 'pages', 'Pages', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5239, 'en', 'all_pages', 'All Pages', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5240, 'en', 'add_new_page', 'Add New Page', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5241, 'en', 'appearances', 'Appearances', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5242, 'en', 'themes', 'Themes', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5243, 'en', 'menus', 'Menus', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5244, 'en', 'theme_options', 'Theme Options', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5245, 'en', 'general_settings', 'General Settings', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5246, 'en', 'home_page_builder', 'Home Page Builder', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5247, 'en', 'widgets', 'Widgets', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5248, 'en', 'plugins', 'Plugins', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5249, 'en', 'email_settings', 'Email settings', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5250, 'en', 'email_templates', 'Email Templates', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5251, 'en', 'media_settings', 'Media settings', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5252, 'en', 'seo_settings', 'SEO settings', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5253, 'en', 'users', 'Users', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5254, 'en', 'roles', 'Roles', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5255, 'en', 'permissions', 'Permissions', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5256, 'en', 'activity_logs', 'Activity Logs', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5257, 'en', 'login_activity', 'Login activity', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5258, 'en', 'you_have_no_unread_notification', 'You have no unread notification', '2023-04-02 08:16:59', '2023-04-02 08:16:59'),
(5259, 'en', 'key', 'Key', '2023-04-02 08:17:04', '2023-04-02 08:17:04'),
(5260, 'en', 'value', 'Value', '2023-04-02 08:17:04', '2023-04-02 08:17:04'),
(5261, 'en', 'save', 'Save', '2023-04-02 08:17:04', '2023-04-02 08:17:04'),
(5262, 'en', 'page_not_found', 'Page Not Found!', '2023-04-02 08:22:15', '2023-04-02 08:22:15'),
(5263, 'en', 'the_page_you_are_looking_for_was_moved_removed_renamed_or_never_existed_please_check_the_url_or_go_to', 'The page you are looking for was moved, removed, renamed or never existed. Please check the url or go to', '2023-04-02 08:22:15', '2023-04-02 08:22:15'),
(5264, 'en', 'main_page', 'Main Page.', '2023-04-02 08:22:15', '2023-04-02 08:22:15'),
(5265, 'en', 'search_here', 'Search Here', '2023-04-02 08:22:15', '2023-04-02 08:22:15'),
(5266, 'en', 'save_changes', 'Save Changes', '2023-04-02 08:23:24', '2023-04-02 08:23:24'),
(5267, 'en', 'comment_loaded_successfully', 'Comment Loaded Successfully', '2023-04-02 08:23:46', '2023-04-02 08:23:46'),
(5268, 'en', 'homepage_builder', 'Homepage Builder', '2023-04-02 08:26:13', '2023-04-02 08:26:13'),
(5269, 'en', 'home_page_sections', 'Home Page Sections', '2023-04-02 08:26:14', '2023-04-02 08:26:14'),
(5270, 'en', 'add_new_section', 'Add New Section', '2023-04-02 08:26:14', '2023-04-02 08:26:14'),
(5271, 'en', 'banner_slider', 'Banner Slider', '2023-04-02 08:26:14', '2023-04-02 08:26:14'),
(5272, 'en', 'manage_slider', 'Manage Slider', '2023-04-02 08:26:14', '2023-04-02 08:26:14'),
(5273, 'en', 'are_you_sure_to_delete_this_section', 'Are you sure to delete this section', '2023-04-02 08:26:14', '2023-04-02 08:26:14'),
(5274, 'en', 'cancel', 'cancel', '2023-04-02 08:26:14', '2023-04-02 08:26:14'),
(5275, 'en', 'new_section', 'New Section', '2023-04-02 08:26:17', '2023-04-02 08:26:17'),
(5276, 'en', 'select_section', 'Select Section', '2023-04-02 08:26:17', '2023-04-02 08:26:17'),
(5277, 'en', 'select_layout', 'Select Layout', '2023-04-02 08:26:17', '2023-04-02 08:26:17'),
(5278, 'en', 'ads', 'Ads', '2023-04-02 08:26:17', '2023-04-02 08:26:17'),
(5279, 'en', 'latest_blogs', 'Latest Blogs', '2023-04-02 08:26:17', '2023-04-02 08:26:17'),
(5280, 'en', 'featured_product', 'Featured Product', '2023-04-02 08:26:17', '2023-04-02 08:26:17'),
(5281, 'en', 'most_viewed_blog', 'Most Viewed Blog', '2023-04-02 08:26:17', '2023-04-02 08:26:17'),
(5282, 'en', 'trending_blog', 'Trending Blog', '2023-04-02 08:26:17', '2023-04-02 08:26:17'),
(5283, 'en', 'category_wise', 'Category Wise', '2023-04-02 08:26:17', '2023-04-02 08:26:17'),
(5284, 'en', 'please_select_a_style', 'Please select a style', '2023-04-02 08:26:17', '2023-04-02 08:26:17'),
(5285, 'en', 'section_properties', 'Section Properties', '2023-04-02 08:26:17', '2023-04-02 08:26:17'),
(5286, 'en', 'media_library', 'Media Library', '2023-04-02 08:26:17', '2023-04-02 08:26:17'),
(5287, 'en', 'upload_files', 'Upload Files', '2023-04-02 08:26:17', '2023-04-02 08:26:17'),
(5288, 'en', 'click_or_drop_files_here_to_upload', 'Click or Drop files here to upload', '2023-04-02 08:26:17', '2023-04-02 08:26:17'),
(5289, 'en', 'filter_media', 'Filter media', '2023-04-02 08:26:17', '2023-04-02 08:26:17'),
(5290, 'en', 'all_file_type', 'All File Type', '2023-04-02 08:26:18', '2023-04-02 08:26:18'),
(5291, 'en', 'all_dates', 'All dates', '2023-04-02 08:26:18', '2023-04-02 08:26:18'),
(5292, 'en', 'load_more', 'Load more', '2023-04-02 08:26:18', '2023-04-02 08:26:18'),
(5293, 'en', 'insert', 'Insert', '2023-04-02 08:26:18', '2023-04-02 08:26:18'),
(5294, 'en', 'attachment_details', 'ATTACHMENT DETAILS', '2023-04-02 08:26:18', '2023-04-02 08:26:18'),
(5295, 'en', 'alt________________________text_', 'Alt                        Text :', '2023-04-02 08:26:18', '2023-04-02 08:26:18'),
(5296, 'en', 'title_', 'Title :', '2023-04-02 08:26:18', '2023-04-02 08:26:18'),
(5297, 'en', 'caption_', 'Caption :', '2023-04-02 08:26:18', '2023-04-02 08:26:18'),
(5298, 'en', 'description_', 'Description :', '2023-04-02 08:26:18', '2023-04-02 08:26:18'),
(5299, 'en', 'content', 'Content', '2023-04-02 08:26:21', '2023-04-02 08:26:21'),
(5300, 'en', 'background', 'Background', '2023-04-02 08:26:21', '2023-04-02 08:26:21'),
(5301, 'en', 'advanced', 'Advanced', '2023-04-02 08:26:21', '2023-04-02 08:26:21'),
(5302, 'en', 'select_layouts', 'Select Layouts', '2023-04-02 08:26:21', '2023-04-02 08:26:21'),
(5303, 'en', 'title', 'Title', '2023-04-02 08:26:21', '2023-04-02 08:26:21'),
(5304, 'en', 'type_title', 'Type title', '2023-04-02 08:26:21', '2023-04-02 08:26:21'),
(5305, 'en', 'title_is_not_visible_in_homepage', 'Title is not visible in homepage', '2023-04-02 08:26:21', '2023-04-02 08:26:21'),
(5306, 'en', 'background_color', 'Background Color', '2023-04-02 08:26:21', '2023-04-02 08:26:21'),
(5307, 'en', 'background_image', 'Background Image', '2023-04-02 08:26:21', '2023-04-02 08:26:21'),
(5308, 'en', 'choose_file', 'Choose File', '2023-04-02 08:26:21', '2023-04-02 08:26:21'),
(5309, 'en', 'background_size', 'Background Size', '2023-04-02 08:26:21', '2023-04-02 08:26:21'),
(5310, 'en', 'background_position', 'Background Position', '2023-04-02 08:26:21', '2023-04-02 08:26:21'),
(5311, 'en', 'background_repeat', 'Background Repeat', '2023-04-02 08:26:21', '2023-04-02 08:26:21'),
(5312, 'en', 'padding', 'Padding', '2023-04-02 08:26:21', '2023-04-02 08:26:21'),
(5313, 'en', 'top', 'Top', '2023-04-02 08:26:21', '2023-04-02 08:26:21'),
(5314, 'en', 'right', 'Right', '2023-04-02 08:26:21', '2023-04-02 08:26:21'),
(5315, 'en', 'bottom', 'Bottom', '2023-04-02 08:26:21', '2023-04-02 08:26:21'),
(5316, 'en', 'left', 'Left', '2023-04-02 08:26:21', '2023-04-02 08:26:21'),
(5317, 'en', 'margin', 'Margin', '2023-04-02 08:26:21', '2023-04-02 08:26:21'),
(5318, 'en', 'button', 'Button', '2023-04-02 08:26:26', '2023-04-02 08:26:26'),
(5319, 'en', 'blog_post_style', 'Blog Post Style', '2023-04-02 08:26:26', '2023-04-02 08:26:26'),
(5320, 'en', 'select_style', 'Select Style', '2023-04-02 08:26:26', '2023-04-02 08:26:26'),
(5321, 'en', 'style_1', 'Style 1', '2023-04-02 08:26:26', '2023-04-02 08:26:26'),
(5322, 'en', 'style_2', 'Style 2', '2023-04-02 08:26:26', '2023-04-02 08:26:26'),
(5323, 'en', 'style_3', 'Style 3', '2023-04-02 08:26:26', '2023-04-02 08:26:26'),
(5324, 'en', 'style_4', 'Style 4', '2023-04-02 08:26:26', '2023-04-02 08:26:26'),
(5325, 'en', 'style_5', 'Style 5', '2023-04-02 08:26:26', '2023-04-02 08:26:26'),
(5326, 'en', 'blog_colum', 'Blog Colum', '2023-04-02 08:26:26', '2023-04-02 08:26:26'),
(5327, 'en', 'number_of_blogs', 'Number of Blogs', '2023-04-02 08:26:26', '2023-04-02 08:26:26'),
(5328, 'en', 'title_is_visible_in_homepage_transalate_to_another_language', 'Title is visible in homepage. Transalate to another language', '2023-04-02 08:26:26', '2023-04-02 08:26:26'),
(5329, 'en', 'click_here', 'click here', '2023-04-02 08:26:26', '2023-04-02 08:26:26'),
(5330, 'en', 'title_color', 'Title Color', '2023-04-02 08:26:26', '2023-04-02 08:26:26'),
(5331, 'en', 'description_color', 'Description Color', '2023-04-02 08:26:26', '2023-04-02 08:26:26'),
(5332, 'en', 'button_title', 'Button Title', '2023-04-02 08:26:26', '2023-04-02 08:26:26'),
(5333, 'en', 'button_title_is_visible_in_homepage_transalate_to_another_language', 'Button title is visible in homepage. Transalate to another language', '2023-04-02 08:26:26', '2023-04-02 08:26:26'),
(5334, 'en', 'button_color', 'Button Color', '2023-04-02 08:26:26', '2023-04-02 08:26:26'),
(5335, 'en', 'button_hover_color', 'Button Hover Color', '2023-04-02 08:26:26', '2023-04-02 08:26:26'),
(5336, 'en', 'button_background_color', 'Button Background Color', '2023-04-02 08:26:26', '2023-04-02 08:26:26'),
(5337, 'en', 'button_background_hover_color', 'Button Background Hover Color', '2023-04-02 08:26:26', '2023-04-02 08:26:26'),
(5338, 'en', 'button_border', 'Button Border', '2023-04-02 08:26:26', '2023-04-02 08:26:26'),
(5339, 'en', 'button_border_color', 'Button Border Color', '2023-04-02 08:26:26', '2023-04-02 08:26:26'),
(5340, 'en', 'button_border_hover_color', 'Button Border Hover Color', '2023-04-02 08:26:26', '2023-04-02 08:26:26'),
(5341, 'en', 'select_category', 'Select Category', '2023-04-02 08:26:45', '2023-04-02 08:26:45'),
(5342, 'en', 'update_section', 'Update Section', '2023-04-02 08:27:31', '2023-04-02 08:27:31'),
(5343, 'en', 'section', 'Section', '2023-04-02 08:27:31', '2023-04-02 08:27:31'),
(5344, 'en', 'image', 'Image', '2023-04-02 08:27:31', '2023-04-02 08:27:31'),
(5345, 'en', 'url', 'Url', '2023-04-02 08:27:31', '2023-04-02 08:27:31'),
(5346, 'en', 'cover', 'cover', '2023-04-02 08:27:31', '2023-04-02 08:27:31'),
(5347, 'en', 'auto', 'auto', '2023-04-02 08:27:31', '2023-04-02 08:27:31'),
(5348, 'en', 'contain', 'contain', '2023-04-02 08:27:32', '2023-04-02 08:27:32'),
(5349, 'en', 'initial', 'initial', '2023-04-02 08:27:32', '2023-04-02 08:27:32'),
(5350, 'en', 'revert', 'revert', '2023-04-02 08:27:32', '2023-04-02 08:27:32'),
(5351, 'en', 'inherit', 'inherit', '2023-04-02 08:27:32', '2023-04-02 08:27:32'),
(5352, 'en', 'revertlayer', 'revert-layer', '2023-04-02 08:27:32', '2023-04-02 08:27:32'),
(5353, 'en', 'unset', 'unset', '2023-04-02 08:27:32', '2023-04-02 08:27:32'),
(5354, 'en', 'center', 'center', '2023-04-02 08:27:32', '2023-04-02 08:27:32'),
(5355, 'en', 'section_updated_successfully', 'Section updated successfully', '2023-04-02 08:27:37', '2023-04-02 08:27:37'),
(5356, 'en', 'translations_updated_successfully', 'Translations updated successfully', '2023-04-02 08:30:02', '2023-04-02 08:30:02'),
(5357, 'en', 'reset_section', 'Reset Section', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5358, 'en', 'reset_all', 'Reset All', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5359, 'en', 'general', 'General', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5360, 'en', 'back_to_top', 'Back To Top', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5361, 'en', 'preloader', 'Preloader', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5362, 'en', 'typography', 'Typography', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5363, 'en', 'body_typography', 'Body Typography', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5364, 'en', 'paragraph_typography', 'Paragraph Typography', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5365, 'en', 'heading_typography', 'Heading Typography', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5366, 'en', 'menu_typography', 'Menu Typography', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5367, 'en', 'button_typography', 'Button Typography', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5368, 'en', 'custom_fonts', 'Custom Fonts', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5369, 'en', 'header', 'Header', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5370, 'en', 'header_option', 'Header Option', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5371, 'en', 'header_logo', 'Header Logo', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5372, 'en', 'menu', 'Menu', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5373, 'en', 'mobile_menu', 'Mobile Menu', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5374, 'en', 'home_page_layout', 'Home Page Layout', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5375, 'en', 'blog_option', 'Blog Option', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5376, 'en', 'single_blog_page', 'Single Blog Page', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5377, 'en', 'sidebar_options', 'Sidebar Options', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5378, 'en', 'page', 'Page', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5379, 'en', '404_page', '404 Page', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5380, 'en', 'subscribe', 'Subscribe', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5381, 'en', 'social', 'Social', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5382, 'en', 'footer', 'Footer', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5383, 'en', 'custom_css', 'Custom Css', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5384, 'en', 'importexport', 'Import/Export', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5385, 'en', 'reset_confirmation', 'Reset Confirmation', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5386, 'en', 'are_you_sure_to_want_to_reset', 'Are you sure to want to reset', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5387, 'en', 'action_failed', 'Action Failed', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5388, 'en', 'select_font_subsets', 'Select Font Subsets', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5389, 'en', 'select_weight__style', 'Select Weight & Style', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5390, 'en', 'new_slide', 'New Slide', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5391, 'en', 'iconexample_fa_fafacebook', 'Icon(example: fa fa-facebook)', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5392, 'en', 'copied', 'Copied', '2023-04-02 08:31:45', '2023-04-02 08:31:45'),
(5393, 'en', 'import_options_json', 'Import Options Json', '2023-04-02 08:31:46', '2023-04-02 08:31:46'),
(5394, 'en', 'import_from_clipboard', 'Import From Clipboard', '2023-04-02 08:31:47', '2023-04-02 08:31:47'),
(5395, 'en', 'uploade_file', 'Uploade File', '2023-04-02 08:31:47', '2023-04-02 08:31:47'),
(5396, 'en', 'paste_your_clipboard_data_here', 'Paste your clipboard data here.', '2023-04-02 08:31:47', '2023-04-02 08:31:47'),
(5397, 'en', 'import', 'Import', '2023-04-02 08:31:47', '2023-04-02 08:31:47'),
(5398, 'en', 'warning_this_will_overwrite_all_existing_option_values_please_proceed_with_caution', 'WARNING! This will overwrite all existing option values, please proceed with caution!', '2023-04-02 08:31:47', '2023-04-02 08:31:47'),
(5399, 'en', 'export_options_json', 'Export Options Json', '2023-04-02 08:31:47', '2023-04-02 08:31:47'),
(5400, 'en', 'here_you_can_copydownload_your_current_option_settings_keep_this_safe_as_you_can_use_it_as_a_backup_should_anything_go_wrong_or_you_can_use_it_to_restore_your_settings_on_this_site_or_any_other_site', 'Here you can copy/download your current option settings. Keep this safe as you can use it as a backup should anything go wrong, or you can use it to restore your settings on this site (or any other site).', '2023-04-02 08:31:47', '2023-04-02 08:31:47'),
(5401, 'en', 'copy_to_clipboard', 'Copy to Clipboard', '2023-04-02 08:31:47', '2023-04-02 08:31:47'),
(5402, 'en', 'export_file', 'Export File', '2023-04-02 08:31:47', '2023-04-02 08:31:47'),
(5403, 'en', 'custom_footer_style', 'Custom Footer Style', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5404, 'en', 'set_custom_footer_style', 'Set custom footer style', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5405, 'en', 'footer_background_color', 'Footer Background Color', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5406, 'en', 'set_footer_background_color', 'Set Footer Background Color', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5407, 'en', 'select_color', 'Select Color', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5408, 'en', 'transparent', 'Transparent', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5409, 'en', 'custom_footer_padding', 'Custom Footer Padding.', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5410, 'en', 'set_footer_padding', 'Set Footer Padding.', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5411, 'en', 'footer_social_enabledisable', 'Footer Social Enable/Disable', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5412, 'en', 'set_enable_to_show_footer_social', 'Set Enable to show Footer Social', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5413, 'en', 'footer_social_color', 'Footer Social Color', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5414, 'en', 'set_footer_social_color', 'Set Footer Social Color', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5415, 'en', 'footer_social_hover_color', 'Footer Social Hover Color', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5416, 'en', 'footer_social_alignment', 'Footer Social Alignment', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5417, 'en', 'set_footer_social_alignment_position', 'Set Footer Social Alignment Position', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5418, 'en', 'footer_logo_enabledisable', 'Footer Logo Enable/Disable', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5419, 'en', 'set_enable_to_show_footer_logo_header_logo_will_be_set_as_footer_logo', 'Set Enable to show Footer Logo (Header Logo will be set as Footer Logo).', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5420, 'en', 'footer_logo_anchor_url', 'Footer Logo Anchor URL', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5421, 'en', 'set_footer_logo_anchor_urldefault_is_home_url', 'Set Footer Logo Anchor URL(default is home url)', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5422, 'en', 'footer_logo_alignment', 'Footer Logo Alignment', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5423, 'en', 'set_enable_to_show_footer_logo_alignment', 'Set Enable to show Footer Logo Alignment', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5424, 'en', 'footer_text_enabledisable', 'Footer Text Enable/Disable', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5425, 'en', 'set_enable_to_show_footer_copyright_text', 'Set Enable to show Footer Copyright Text', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5426, 'en', 'footer_copyright_text_alignment', 'Footer Copyright Text Alignment', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5427, 'en', 'set_enable_to_show_footer_text_alignment', 'Set Enable to show Footer Text Alignment', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5428, 'en', 'footer_copyright_text_color', 'Footer Copyright Text Color', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5429, 'en', 'set_footer_text_color', 'Set Footer Text Color', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5430, 'en', 'footer_copyright_anchor_text_color', 'Footer Copyright Anchor Text Color', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5431, 'en', 'set_footer_anchor_text_color', 'Set Footer Anchor Text Color', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5432, 'en', 'footer_copyright_anchor_text_hover_color', 'Footer Copyright Anchor Text Hover Color', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5433, 'en', 'set_footer_anchor_text_hover_color', 'Set Footer Anchor Text Hover Color', '2023-04-02 08:31:53', '2023-04-02 08:31:53'),
(5434, 'en', 'mailchimp_api_key', 'Mailchimp API Key', '2023-04-02 08:31:54', '2023-04-02 08:31:54'),
(5435, 'en', 'set_mailchimp_api_key', 'Set mailchimp api key', '2023-04-02 08:31:55', '2023-04-02 08:31:55'),
(5436, 'en', 'mailchimp_list_id', 'Mailchimp List ID', '2023-04-02 08:31:55', '2023-04-02 08:31:55'),
(5437, 'en', 'set_mailchimp_list_id', 'Set mailchimp list id.', '2023-04-02 08:31:55', '2023-04-02 08:31:55'),
(5438, 'en', 'footer_subscribe_form', 'Footer Subscribe Form', '2023-04-02 08:31:55', '2023-04-02 08:31:55'),
(5439, 'en', 'set_enable_to_display_subscribe_form_in_footer', 'Set Enable to display Subscribe form in footer.', '2023-04-02 08:31:55', '2023-04-02 08:31:55'),
(5440, 'en', 'form_title', 'Form Title', '2023-04-02 08:31:55', '2023-04-02 08:31:55'),
(5441, 'en', 'form_placeholder', 'Form Placeholder', '2023-04-02 08:31:55', '2023-04-02 08:31:55'),
(5442, 'en', 'form_button_text', 'Form Button Text', '2023-04-02 08:31:55', '2023-04-02 08:31:55'),
(5443, 'en', 'privacy_policy', 'Privacy Policy', '2023-04-02 08:31:55', '2023-04-02 08:31:55'),
(5444, 'en', 'set_enable_to_display_privacy_policy_button', 'Set Enable to display Privacy Policy Button.', '2023-04-02 08:31:55', '2023-04-02 08:31:55'),
(5445, 'en', 'privacy_policy_page', 'Privacy Policy Page', '2023-04-02 08:31:55', '2023-04-02 08:31:55'),
(5446, 'en', 'select_privacy_policy_page', 'Select Privacy Policy Page.', '2023-04-02 08:31:55', '2023-04-02 08:31:55'),
(5447, 'en', 'custom_footer_subscribe_style', 'Custom Footer Subscribe Style', '2023-04-02 08:31:55', '2023-04-02 08:31:55'),
(5448, 'en', 'set_custom_footer_subscribe_style', 'Set custom footer subscribe style', '2023-04-02 08:31:55', '2023-04-02 08:31:55'),
(5449, 'en', 'form_privacy_text_color', 'Form Privacy Text Color', '2023-04-02 08:31:55', '2023-04-02 08:31:55'),
(5450, 'en', 'if_privacy_policy_switch_is_enabled', 'If privacy policy switch is enabled', '2023-04-02 08:31:55', '2023-04-02 08:31:55'),
(5451, 'en', 'form_privacy_text_anchor_color', 'Form Privacy Text Anchor Color', '2023-04-02 08:31:55', '2023-04-02 08:31:55'),
(5452, 'en', 'form_background_color', 'Form Background Color', '2023-04-02 08:31:55', '2023-04-02 08:31:55'),
(5453, 'en', 'form_title_color', 'Form Title Color', '2023-04-02 08:31:55', '2023-04-02 08:31:55'),
(5454, 'en', 'form_input_background_color', 'Form Input Background Color', '2023-04-02 08:31:55', '2023-04-02 08:31:55'),
(5455, 'en', 'form_submit_button_color', 'Form Submit Button Color', '2023-04-02 08:31:55', '2023-04-02 08:31:55'),
(5456, 'en', 'form_submit_button_background_color', 'Form Submit Button Background Color', '2023-04-02 08:31:55', '2023-04-02 08:31:55'),
(5457, 'en', 'switch_enabled_to_display_preloader', 'Switch Enabled to Display Preloader.', '2023-04-02 08:53:50', '2023-04-02 08:53:50'),
(5458, 'en', 'preloader_style_type', 'Preloader Style Type', '2023-04-02 08:53:50', '2023-04-02 08:53:50'),
(5459, 'en', 'control_preloader_style_type_if_you_use_this_option_then_you_will_able_to_set_lot_of_preloader_style', 'Control preloader style type. If you use this option then you will able to set lot of preloader style', '2023-04-02 08:53:50', '2023-04-02 08:53:50'),
(5460, 'en', 'custom_preloader_type', 'Custom Preloader Type', '2023-04-02 08:53:50', '2023-04-02 08:53:50'),
(5461, 'en', 'image_type__text_type', 'Image Type - Text Type', '2023-04-02 08:53:50', '2023-04-02 08:53:50'),
(5462, 'en', 'set_custom_preloader_type', 'Set Custom Preloader Type.', '2023-04-02 08:53:50', '2023-04-02 08:53:50'),
(5463, 'en', 'preloader_image', 'Preloader Image', '2023-04-02 08:53:50', '2023-04-02 08:53:50'),
(5464, 'en', 'set_preloader_image', 'Set Preloader Image.', '2023-04-02 08:53:50', '2023-04-02 08:53:50'),
(5465, 'en', 'preloader_heading_tag', 'Preloader Heading Tag', '2023-04-02 08:53:50', '2023-04-02 08:53:50'),
(5466, 'en', 'set_preloader_heading_tag', 'Set Preloader Heading Tag.', '2023-04-02 08:53:50', '2023-04-02 08:53:50'),
(5467, 'en', 'preloader_text', 'Preloader Text', '2023-04-02 08:53:50', '2023-04-02 08:53:50'),
(5468, 'en', 'set_preloader_text', 'Set Preloader Text.', '2023-04-02 08:53:50', '2023-04-02 08:53:50'),
(5469, 'en', 'preloader_item_color', 'Preloader Item Color', '2023-04-02 08:53:50', '2023-04-02 08:53:50'),
(5470, 'en', 'set_preloader_item_color', 'Set Preloader Item Color.', '2023-04-02 08:53:50', '2023-04-02 08:53:50'),
(5471, 'en', 'preloader_background_color', 'Preloader Background Color', '2023-04-02 08:53:50', '2023-04-02 08:53:50'),
(5472, 'en', 'set_preloader_background_color', 'Set Preloader Background Color.', '2023-04-02 08:53:50', '2023-04-02 08:53:50'),
(5473, 'en', 'theme_option_saved', 'Theme Option Saved', '2023-04-02 08:55:02', '2023-04-02 08:55:02'),
(5474, 'en', 'custom_blog_style', 'Custom Blog Style', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5475, 'en', 'set_custom_blog_style', 'set custom blog style.', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5476, 'en', 'layout', 'Layout', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5477, 'en', 'choose_blog_layout_from_here_if_you_use_this_option_then_you_will_able_to_change_three_type_of_blog_layout__default_right_sidebar_layout_', 'Choose blog layout from here. If you use this option then you will able to change three type of blog layout ( Default Right Sidebar Layout ).', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5478, 'en', 'blog_column', 'Blog Column', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5479, 'en', 'select_your_blog_post_column_from_here_if_you_use_this_option_then_you_will_able_to_select_three_type_of_blog_colum_layout__default_one_column_', 'Select your blog post column from here. If you use this option then you will able to select three type of blog colum layout ( Default One Column ).', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5480, 'en', 'select_blog_post_style', 'Select Blog Post Style.', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5481, 'en', 'blog_page_title', 'Blog Page Title', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5482, 'en', 'control_blog_page_title_show__hide_if_you_use_this_option_then_you_will_able_to_show__hide_your_blog_page_title__default_setting_show_', 'Control blog page title show / hide. If you use this option then you will able to show / hide your blog page title ( Default Setting Show ).', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5483, 'en', 'blog_page_title_setting', 'Blog Page Title Setting', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5484, 'en', 'control_blog_page_title_setting_if_you_use_this_option_then_you_can_able_to_show_default_or_custom_blog_page_title__default_blog_', 'Control blog page title setting. If you use this option then you can able to show default or custom blog page title ( Default Blog ).', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5485, 'en', 'blog_custom_title', 'Blog Custom Title', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5486, 'en', 'set_blog_page_custom_title_form_here_if_you_use_this_option_then_you_will_able_to_set_your_won_title_text', 'Set blog page custom title form here. If you use this option then you will able to set your won title text.', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5487, 'en', 'blog_posts_excerpt', 'Blog Posts Excerpt', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5488, 'en', 'control_the_number_of_characters_you_want_to_show_in_the_blog_page_for_each_post_if_you_use_this_option_then_you_can_able_to_control_your_blog_post_characters_from_heredefault_50_character', 'Control the number of characters you want to show in the blog page for each post.. If you use this option then you can able to control your blog post characters from here.(default 50 character)', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5489, 'en', 'blog_perpage_number', 'Blog PerPage Number', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5490, 'en', 'control_the_number_blogs_to_show_on_each_page__default_show_10_', 'Control the number blogs to show on each page ( Default show 10 ).', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5491, 'en', 'read_more_text_setting', 'Read More Text Setting', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5492, 'en', 'control_read_more_text_from_here', 'Control read more text from here.', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5493, 'en', 'read_more_text', 'Read More Text', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5494, 'en', 'set_read_moer_text_here_if_you_use_this_option_then_you_will_able_to_set_your_won_text', 'Set read moer text here. If you use this option then you will able to set your won text.', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5495, 'en', 'blog_pagination_settings', 'Blog Pagination Settings', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5496, 'en', 'set_blog_pagination_number_pagination_or_link_pagination', 'Set blog pagination. Number Pagination or Link Pagination', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5497, 'en', 'blog_pagination_position', 'Blog Pagination Position', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5498, 'en', 'set_blog_pagination_position', 'Set blog pagination Position.', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5499, 'en', 'blog_pagination_active_color', 'Blog Pagination Active Color', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5500, 'en', 'set_blog_pagination_active_color', 'Set Blog Pagination Active Color.', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5501, 'en', 'blog_pagination_active_background_color', 'Blog Pagination Active Background Color', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5502, 'en', 'set_blog_pagination_active_background_color', 'Set Blog Pagination Active Background Color.', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5503, 'en', 'blog_pagination_color', 'Blog Pagination Color', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5504, 'en', 'set_blog_pagination_color', 'Set Blog Pagination Color.', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5505, 'en', 'blog_pagination_background_color', 'Blog Pagination Background Color', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5506, 'en', 'set_blog_pagination_background_color', 'Set Blog Pagination Background Color.', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5507, 'en', 'blog_pagination_hover_color', 'Blog Pagination Hover Color', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5508, 'en', 'set_blog_pagination_hover_color', 'Set Blog Pagination Hover Color.', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5509, 'en', 'blog_pagination_hover_background_color', 'Blog Pagination Hover Background Color', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5510, 'en', 'set_blog_pagination_hover_background_color', 'Set Blog Pagination Hover Background Color.', '2023-04-02 08:55:25', '2023-04-02 08:55:25'),
(5511, 'en', 'custom_single_blog_page', 'Custom Single Blog page', '2023-04-02 09:04:14', '2023-04-02 09:04:14'),
(5512, 'en', 'set_custom_single_blog_style', 'set custom single blog style.', '2023-04-02 09:04:14', '2023-04-02 09:04:14'),
(5513, 'en', 'choose_blog_single_page_layout_from_here_if_you_use_this_option_then_you_will_able_to_change_three_type_of_blog_single_page_layout__default_right_sidebar_layout_', 'Choose blog single page layout from here. If you use this option then you will able to change three type of blog single page layout ( Default Right Sidebar Layout ).', '2023-04-02 09:04:14', '2023-04-02 09:04:14'),
(5514, 'en', 'blog_post_title_position', 'Blog Post Title Position', '2023-04-02 09:04:14', '2023-04-02 09:04:14'),
(5515, 'en', 'control_blog_post_title_position_from_here', 'Control blog post title position from here.', '2023-04-02 09:04:14', '2023-04-02 09:04:14'),
(5516, 'en', 'blog_details_custom_title', 'Blog Details Custom Title', '2023-04-02 09:04:14', '2023-04-02 09:04:14'),
(5517, 'en', 'this_title_will_show_in_breadcrumb_title', 'This title will show in Breadcrumb title.', '2023-04-02 09:04:14', '2023-04-02 09:04:14'),
(5518, 'en', 'author', 'Author', '2023-04-02 09:04:14', '2023-04-02 09:04:14'),
(5519, 'en', 'switch_on_to_display_author', 'Switch On to Display Author.', '2023-04-02 09:04:14', '2023-04-02 09:04:14'),
(5520, 'en', 'date', 'Date', '2023-04-02 09:04:14', '2023-04-02 09:04:14'),
(5521, 'en', 'switch_on_to_display_date', 'Switch On to Display Date.', '2023-04-02 09:04:14', '2023-04-02 09:04:14'),
(5522, 'en', 'reading_time', 'Reading Time', '2023-04-02 09:04:14', '2023-04-02 09:04:14'),
(5523, 'en', 'switch_on_to_display_reading_time', 'Switch On to Display Reading Time.', '2023-04-02 09:04:14', '2023-04-02 09:04:14'),
(5524, 'en', 'category', 'Category', '2023-04-02 09:04:14', '2023-04-02 09:04:14'),
(5525, 'en', 'switch_on_to_display_category', 'Switch On to Display Category.', '2023-04-02 09:04:14', '2023-04-02 09:04:14'),
(5526, 'en', 'switch_on_to_display_tags', 'Switch On to Display Tags.', '2023-04-02 09:04:14', '2023-04-02 09:04:14'),
(5527, 'en', 'switch_on_to_display_comments', 'Switch On to Display Comments.', '2023-04-02 09:04:14', '2023-04-02 09:04:14'),
(5528, 'en', 'biography_info', 'Biography Info', '2023-04-02 09:04:14', '2023-04-02 09:04:14'),
(5529, 'en', 'control_biography_info_from_here_if_you_use_this_option_then_you_will_able_to_show_ro_hide_biography_info', 'Control biography info from here. If you use this option then you will able to show ro hide biography info', '2023-04-02 09:04:14', '2023-04-02 09:04:14'),
(5530, 'en', 'custom_sidebar_style', 'Custom Sidebar Style', '2023-04-02 09:07:00', '2023-04-02 09:07:00'),
(5531, 'en', 'switch_on_for_custom_sidebar_style', 'Switch on for custom Sidebar style.', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5532, 'en', 'widgets_background_color', 'Widgets Background Color', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5533, 'en', 'box_shadow', 'Box Shadow', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5534, 'en', 'offset_x', 'Offset X', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5535, 'en', 'offset_y', 'Offset Y', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5536, 'en', 'blur_radius', 'Blur Radius', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5537, 'en', 'spread_radius', 'Spread Radius', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5538, 'en', 'opcacity_11', 'Opcacity .1-1', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5539, 'en', 'units', 'Units', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5540, 'en', 'shadow_color', 'Shadow Color', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5541, 'en', 'shadow_type', 'Shadow Type', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5542, 'en', 'widget_margin', 'Widget Margin', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5543, 'en', 'widget_padding', 'Widget Padding', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5544, 'en', 'widget_border', 'Widget Border', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5545, 'en', 'widget_title_tag', 'Widget Title Tag', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5546, 'en', 'widget_title_typography', 'Widget Title Typography', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5547, 'en', 'font_family', 'Font Family', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5548, 'en', 'select__fonts', 'Select  Fonts', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5549, 'en', 'custom_font_1', 'Custom Font 1', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5550, 'en', 'custom_font_2', 'Custom Font 2', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5551, 'en', 'google_web_fonts', 'Google Web Fonts', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5552, 'en', 'font_weight__style', 'Font Weight & Style', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5553, 'en', 'font_subsets', 'Font Subsets', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5554, 'en', 'text_align', 'Text Align', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5555, 'en', 'text_transform', 'Text Transform', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5556, 'en', 'font_size', 'Font Size', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5557, 'en', 'size', 'Size', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5558, 'en', 'line_height', 'Line Height', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5559, 'en', 'height', 'Height', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5560, 'en', 'word_spacing', 'Word Spacing', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5561, 'en', 'letter_spacing', 'Letter Spacing', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5562, 'en', 'the_quick_brown_fox_jumps_over_the_lazy_dog', 'The Quick Brown Fox Jumps Over The Lazy Dog', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5563, 'en', 'widget_title_margin', 'Widget Title Margin', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5564, 'en', 'widget_title_padding', 'Widget Title Padding', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5565, 'en', 'widget_title_color', 'Widget Title Color', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5566, 'en', 'set_widget_title_color', 'Set Widget Title Color.', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5567, 'en', 'widget_text_color', 'Widget Text Color', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5568, 'en', 'set_widget_text_color', 'Set Widget Text Color.', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5569, 'en', 'widget_anchor_color', 'Widget Anchor Color', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5570, 'en', 'set_widget_anchor_color', 'Set Widget Anchor Color.', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5571, 'en', 'widget_anchor_hover_color', 'Widget Anchor Hover Color', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5572, 'en', 'set_widget_anchor_hover_color', 'Set Widget Anchor Hover Color.', '2023-04-02 09:07:01', '2023-04-02 09:07:01'),
(5573, 'en', 'custom_page_style', 'Custom Page Style', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5574, 'en', 'set_custom_page_style', 'set custom page style.', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5575, 'en', 'choose_your_page_layout_if_you_use_this_option_then_you_will_able_to_choose_three_type_of_page_layout__default_no_sidebar_', 'Choose your page layout. If you use this option then you will able to choose three type of page layout ( Default no sidebar ).', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5576, 'en', 'sidebar_settings', 'Sidebar Settings', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5577, 'en', 'set_page_sidebar_if_you_use_this_option_then_you_will_able_to_set_three_type_of_sidebar__default_no_sidebar_', 'Set page sidebar. If you use this option then you will able to set three type of sidebar ( Default no sidebar ).', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5578, 'en', 'page_sidebar', 'Page Sidebar', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5579, 'en', 'blog_sidebar', 'Blog Sidebar', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5580, 'en', 'switch_enabled_to_display_page_title_fot_this_option_you_will_able_to_show__hide_page_title_default_setting_enabled', 'Switch enabled to display page title. Fot this option you will able to show / hide page title. Default setting Enabled', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5581, 'en', 'title_tag', 'Title Tag', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5582, 'en', 'select_page_title_tag_if_you_use_this_option_then_you_can_able_to_change_title_tag_h1__h6__default_tag_h1_', 'Select page title tag. If you use this option then you can able to change title tag H1 - H6 ( Default tag H1 )', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5583, 'en', 'font_settings', 'Font Settings', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5584, 'en', 'select_font_setting_for_page_title_if_you_use_this_options_then_you_will_able_to_change_font_weight_text_align_text_transform_font_size_line_height_word_spacing_letter_spacing', 'Select font setting for page title. If you use this options then you will able to change Font Weight, Text Align, Text Transform, Font Size, Line Height, Word Spacing, Letter Spacing.', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5585, 'en', 'setting_page_header_background_if_you_use_this_option_then_you_will_able_to_set_background_color_background_image_background_repeat_background_size_background_attachment_background_position', 'Setting page header background. If you use this option then you will able to set Background Color, Background Image, Background Repeat, Background Size, Background Attachment, Background Position.', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5586, 'en', 'select_background_repeat', 'Select Background Repeat', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5587, 'en', 'select_background_size', 'Select Background Size', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5588, 'en', 'background_attachment', 'Background Attachment', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5589, 'en', 'select_background_attachment', 'Select Background Attachment', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5590, 'en', 'select_background_position', 'Select Background Position', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5591, 'en', 'overlay', 'Overlay', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5592, 'en', 'check_this_check_box_to_use_overlay_if_you_use_this_option_then_you_will_able_to_use_background_overlay', 'Check this check box to use overlay. If you use this option then you will able to use background overlay.', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5593, 'en', 'overlay_background', 'Overlay Background', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5594, 'en', 'choose_overlay_background_color_if_you_user_this_option_then_you_will_able_to_choose_overlay_background_color', 'Choose overlay background color. If you user this option then you will able to choose overlay background color.', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5595, 'en', 'opacity', 'Opacity', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5596, 'en', 'setting_overlay_opacity_if_you_use_this_option_then_you_will_able_to_show_light_to_dark_overlay_background_color__default_opacity_05_', 'Setting overlay opacity. If you use this option then you will able to show light to dark overlay background color ( Default opacity 0.5 ).', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5597, 'en', 'breadcrumb_hideshow', 'Breadcrumb Hide/Show', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5598, 'en', 'hide__show_breadcrumb_from_all_pages_and_posts__default_settings_show_', 'Hide / Show breadcrumb from all pages and posts ( Default settings show ).', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5599, 'en', 'breadcrumb_color', 'Breadcrumb Color', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5600, 'en', 'choose_page_header_breadcrumb_text_color_hereif_you_user_this_option_then_you_will_able_to_set_page_breadcrumb_color', 'Choose page header breadcrumb text color here.If you user this option then you will able to set page breadcrumb color.', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5601, 'en', 'breadcrumb_active_color', 'Breadcrumb Active Color', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5602, 'en', 'choose_page_header_breadcrumb_text_active_color_hereif_you_user_this_option_then_you_will_able_to_set_page_breadcrumb_active_color', 'Choose page header breadcrumb text active color here.If you user this option then you will able to set page breadcrumb active color.', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5603, 'en', 'breadcrumb_divider_color', 'Breadcrumb Divider Color', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5604, 'en', 'choose_breadcrumb_divider_color_if_you_use_this_option_then_you_will_able_to_use_breadcrumb_color__default_color__', 'Choose breadcrumb divider color. If you use this option then you will able to use breadcrumb color ( Default color  )', '2023-04-02 09:07:10', '2023-04-02 09:07:10'),
(5605, 'en', 'custom_404_style', 'Custom 404 Style', '2023-04-02 09:07:47', '2023-04-02 09:07:47'),
(5606, 'en', 'set_custom_404', 'Set custom 404', '2023-04-02 09:07:47', '2023-04-02 09:07:47'),
(5607, 'en', 'page_title', 'Page Title', '2023-04-02 09:07:47', '2023-04-02 09:07:47'),
(5608, 'en', 'set_page_title', 'Set Page Title', '2023-04-02 09:07:47', '2023-04-02 09:07:47'),
(5609, 'en', 'page_subtitle', 'Page Subtitle', '2023-04-02 09:07:47', '2023-04-02 09:07:47'),
(5610, 'en', 'set_page_subtitle', 'Set Page Subtitle', '2023-04-02 09:07:47', '2023-04-02 09:07:47'),
(5611, 'en', 'button_before_text', 'Button Before Text', '2023-04-02 09:07:47', '2023-04-02 09:07:47'),
(5612, 'en', 'button_text', 'Button Text', '2023-04-02 09:07:47', '2023-04-02 09:07:47'),
(5613, 'en', 'page_background_with_image_color_etc', 'page background with image, color, etc.', '2023-04-02 09:07:47', '2023-04-02 09:07:47'),
(5614, 'en', 'background_overlay', 'Background Overlay', '2023-04-02 09:07:47', '2023-04-02 09:07:47'),
(5615, 'en', 'set_background_ovelay', 'Set background ovelay.', '2023-04-02 09:07:47', '2023-04-02 09:07:47'),
(5616, 'en', 'overlay_color', 'Overlay Color', '2023-04-02 09:07:47', '2023-04-02 09:07:47'),
(5617, 'en', 'set_overlay_color', 'Set overlay color.', '2023-04-02 09:07:47', '2023-04-02 09:07:47'),
(5618, 'en', 'overlay_opacity', 'Overlay Opacity', '2023-04-02 09:07:47', '2023-04-02 09:07:47'),
(5619, 'en', 'set_overlay_opacity', 'set overlay opacity.', '2023-04-02 09:07:47', '2023-04-02 09:07:47'),
(5620, 'en', 'pick_a_title_color', 'Pick a title color', '2023-04-02 09:07:47', '2023-04-02 09:07:47'),
(5621, 'en', 'subtitle_color', 'Subtitle Color', '2023-04-02 09:07:47', '2023-04-02 09:07:47'),
(5622, 'en', 'pick_a_subtitle_color', 'Pick a subtitle color', '2023-04-02 09:07:47', '2023-04-02 09:07:47'),
(5623, 'en', 'before_button_text_color', 'Before Button Text Color', '2023-04-02 09:07:47', '2023-04-02 09:07:47'),
(5624, 'en', 'pick_before_button_text_color', 'Pick Before Button Text Color', '2023-04-02 09:07:47', '2023-04-02 09:07:47'),
(5625, 'en', 'before_button_color', 'Before Button Color', '2023-04-02 09:07:47', '2023-04-02 09:07:47'),
(5626, 'en', 'pick_before_button_color', 'Pick Before Button Color', '2023-04-02 09:07:47', '2023-04-02 09:07:47'),
(5627, 'en', 'before_button_hover_color', 'Before Button Hover Color', '2023-04-02 09:07:47', '2023-04-02 09:07:47'),
(5628, 'en', 'pick_before_button_hover_color', 'Pick Before Button Hover Color', '2023-04-02 09:07:47', '2023-04-02 09:07:47'),
(5629, 'en', 'social_profile_links', 'Social Profile Links', '2023-04-02 09:12:12', '2023-04-02 09:12:12'),
(5630, 'en', 'add_social_icon_and_url', 'Add social icon and url.', '2023-04-02 09:12:12', '2023-04-02 09:12:12'),
(5631, 'en', 'add_slide', 'Add Slide', '2023-04-02 09:12:12', '2023-04-02 09:12:12'),
(5632, 'en', 'css_code', 'CSS Code', '2023-04-02 09:12:29', '2023-04-02 09:12:29'),
(5633, 'en', 'paste_your_css_code_here', 'Paste your CSS code here.', '2023-04-02 09:12:29', '2023-04-02 09:12:29'),
(5634, 'en', 'you_can_not_change_status_of_this_language', 'You can not change status of this language', '2023-04-02 10:08:49', '2023-04-02 10:08:49'),
(5635, 'en', 'language_status_updated_successfully', 'Language status updated successfully', '2023-04-02 10:08:52', '2023-04-02 10:08:52'),
(5636, 'en', 'login', 'Login', '2023-04-03 03:40:49', '2023-04-03 03:40:49'),
(5637, 'en', 'login_to', 'Login To', '2023-04-03 03:40:49', '2023-04-03 03:40:49'),
(5638, 'en', 'email', 'Email', '2023-04-03 03:40:49', '2023-04-03 03:40:49'),
(5639, 'en', 'email_address', 'Email Address', '2023-04-03 03:40:49', '2023-04-03 03:40:49'),
(5640, 'en', 'password', 'Password', '2023-04-03 03:40:49', '2023-04-03 03:40:49'),
(5641, 'en', '', '********', '2023-04-03 03:40:49', '2023-04-03 03:40:49'),
(5642, 'en', 'forgot_password', 'Forgot Password?', '2023-04-03 03:40:49', '2023-04-03 03:40:49');
INSERT INTO `tl_translations` (`id`, `lang`, `lang_key`, `lang_value`, `created_at`, `updated_at`) VALUES
(5643, 'en', 'log_in', 'Log In', '2023-04-03 03:40:49', '2023-04-03 03:40:49'),
(5644, 'en', 'email_is_required', 'Email is required', '2023-04-03 03:40:58', '2023-04-03 03:40:58'),
(5645, 'en', 'invalid_email_address', 'Invalid Email Address', '2023-04-03 03:40:58', '2023-04-03 03:40:58'),
(5646, 'en', 'password_is_required', 'Password is required', '2023-04-03 03:40:58', '2023-04-03 03:40:58'),
(5647, 'en', 'login_successful', 'Login successful', '2023-04-03 03:41:08', '2023-04-03 03:41:08'),
(5648, 'en', 'total_blogs', 'Total Blogs', '2023-04-03 03:41:08', '2023-04-03 03:41:08'),
(5649, 'en', 'total_pages', 'Total Pages', '2023-04-03 03:41:08', '2023-04-03 03:41:08'),
(5650, 'en', 'total_category', 'Total Category', '2023-04-03 03:41:08', '2023-04-03 03:41:08'),
(5651, 'en', 'total_comments', 'Total Comments', '2023-04-03 03:41:08', '2023-04-03 03:41:08'),
(5652, 'en', 'visitors_reports', 'Visitors Reports', '2023-04-03 03:41:08', '2023-04-03 03:41:08'),
(5653, 'en', 'monthly', 'Monthly', '2023-04-03 03:41:08', '2023-04-03 03:41:08'),
(5654, 'en', 'daily', 'Daily', '2023-04-03 03:41:08', '2023-04-03 03:41:08'),
(5655, 'en', 'blog_status', 'Blog Status', '2023-04-03 03:41:08', '2023-04-03 03:41:08'),
(5656, 'en', 'published', 'Published', '2023-04-03 03:41:08', '2023-04-03 03:41:08'),
(5657, 'en', 'scheduled', 'Scheduled', '2023-04-03 03:41:08', '2023-04-03 03:41:08'),
(5658, 'en', 'drafts', 'Drafts', '2023-04-03 03:41:08', '2023-04-03 03:41:08'),
(5659, 'en', 'pending', 'Pending', '2023-04-03 03:41:08', '2023-04-03 03:41:08'),
(5660, 'en', 'featured', 'Featured', '2023-04-03 03:41:08', '2023-04-03 03:41:08'),
(5661, 'en', 'recent_comments', 'Recent Comments', '2023-04-03 03:41:08', '2023-04-03 03:41:08'),
(5662, 'en', 'comment', 'Comment', '2023-04-03 03:41:08', '2023-04-03 03:41:08'),
(5663, 'en', 'submitted_on', 'Submitted on', '2023-04-03 03:41:08', '2023-04-03 03:41:08'),
(5664, 'en', 'in_reply_to', 'In reply to', '2023-04-03 03:41:08', '2023-04-03 03:41:08'),
(5665, 'en', 'popular_categories', 'Popular Categories', '2023-04-03 03:41:08', '2023-04-03 03:41:08'),
(5666, 'en', 'latest_pages', 'Latest Pages', '2023-04-03 03:41:08', '2023-04-03 03:41:08'),
(5667, 'en', 'manage_widgets', 'Manage Widgets', '2023-04-03 04:11:38', '2023-04-03 04:11:38'),
(5668, 'en', 'available_widgets', 'Available Widgets', '2023-04-03 04:11:38', '2023-04-03 04:11:38'),
(5669, 'en', 'add_widget', 'Add Widget', '2023-04-03 04:11:38', '2023-04-03 04:11:38'),
(5670, 'en', 'adding_widget_to_sidebar_failed', 'Adding Widget To Sidebar Failed', '2023-04-03 04:11:38', '2023-04-03 04:11:38'),
(5671, 'en', 'sidebar_widget_opening_failed', 'Sidebar Widget Opening Failed', '2023-04-03 04:11:38', '2023-04-03 04:11:38'),
(5672, 'en', 'widget_added_to_sidebar_failed', 'Widget Added To Sidebar Failed', '2023-04-03 04:11:38', '2023-04-03 04:11:38'),
(5673, 'en', 'widget_form_submit_failed_failed', 'Widget Form Submit Failed Failed', '2023-04-03 04:11:38', '2023-04-03 04:11:38'),
(5674, 'en', 'select_a_user_for_authur_widget', 'Select a User for Authur Widget', '2023-04-03 04:11:42', '2023-04-03 04:11:42'),
(5675, 'en', 'done', 'Done', '2023-04-03 04:11:42', '2023-04-03 04:11:42'),
(5676, 'en', 'widget_title', 'Widget Title', '2023-04-03 04:11:44', '2023-04-03 04:11:44'),
(5677, 'en', 'number_of_featured_blog', 'Number of Featured Blog', '2023-04-03 04:11:44', '2023-04-03 04:11:44'),
(5678, 'en', 'widget_form_saved', 'Widget Form Saved', '2023-04-03 04:12:21', '2023-04-03 04:12:21'),
(5679, 'en', 'title_placeholder', 'Title Placeholder', '2023-04-03 04:12:28', '2023-04-03 04:12:28'),
(5680, 'en', 'add_information', 'Add Information', '2023-04-03 04:12:46', '2023-04-03 04:12:46'),
(5681, 'en', 'newsletter_short_desc', 'Newsletter Short Desc', '2023-04-03 04:12:48', '2023-04-03 04:12:48'),
(5682, 'en', 'number_of_recent_blog', 'Number of Recent Blog', '2023-04-03 04:13:26', '2023-04-03 04:13:26'),
(5683, 'en', 'per_slide_number', 'Per Slide Number', '2023-04-03 04:13:55', '2023-04-03 04:13:55'),
(5684, 'en', 'total_blog_number', 'Total Blog Number', '2023-04-03 04:13:55', '2023-04-03 04:13:55'),
(5685, 'en', 'number_of_tags', 'Number of Tags', '2023-04-03 04:14:33', '2023-04-03 04:14:33'),
(5686, 'en', 'number_of_tag', 'Number of Tag', '2023-04-03 04:14:33', '2023-04-03 04:14:33'),
(5687, 'en', 'site_title', 'Site Title', '2023-04-03 04:15:52', '2023-04-03 04:15:52'),
(5688, 'en', 'site_motto', 'Site Motto', '2023-04-03 04:15:52', '2023-04-03 04:15:52'),
(5689, 'en', 'site_moto', 'Site Moto', '2023-04-03 04:15:52', '2023-04-03 04:15:52'),
(5690, 'en', 'logo', 'Logo', '2023-04-03 04:15:52', '2023-04-03 04:15:52'),
(5691, 'en', 'choose_image', 'Choose image', '2023-04-03 04:15:52', '2023-04-03 04:15:52'),
(5692, 'en', 'logo_mobile', 'Logo (Mobile)', '2023-04-03 04:15:52', '2023-04-03 04:15:52'),
(5693, 'en', 'dark_logo', 'Dark Logo', '2023-04-03 04:15:52', '2023-04-03 04:15:52'),
(5694, 'en', 'dark_logo_mobile', 'Dark Logo (Mobile)', '2023-04-03 04:15:52', '2023-04-03 04:15:52'),
(5695, 'en', 'sticky_logo', 'Sticky Logo', '2023-04-03 04:15:52', '2023-04-03 04:15:52'),
(5696, 'en', 'sticky_logo_mobile', 'Sticky Logo (Mobile)', '2023-04-03 04:15:52', '2023-04-03 04:15:52'),
(5697, 'en', 'dark_sticky_logo', 'Dark Sticky Logo', '2023-04-03 04:15:52', '2023-04-03 04:15:52'),
(5698, 'en', 'dark_sticky_logo_mobile', 'Dark Sticky Logo (Mobile)', '2023-04-03 04:15:52', '2023-04-03 04:15:52'),
(5699, 'en', 'admin_logo', 'Admin Logo', '2023-04-03 04:15:52', '2023-04-03 04:15:52'),
(5700, 'en', 'admin_logo_mobile', 'Admin Logo (Mobile)', '2023-04-03 04:15:52', '2023-04-03 04:15:52'),
(5701, 'en', 'admin_dark_logo', 'Admin Dark Logo', '2023-04-03 04:15:52', '2023-04-03 04:15:52'),
(5702, 'en', 'admin_dark_logo_mobile', 'Admin Dark Logo (Mobile)', '2023-04-03 04:15:52', '2023-04-03 04:15:52'),
(5703, 'en', 'favicon', 'Favicon', '2023-04-03 04:15:52', '2023-04-03 04:15:52'),
(5704, 'en', 'default_language', 'Default Language', '2023-04-03 04:15:52', '2023-04-03 04:15:52'),
(5705, 'en', 'select_default_language', 'Select default language', '2023-04-03 04:15:52', '2023-04-03 04:15:52'),
(5706, 'en', 'select_default_timezone', 'Select Default Timezone', '2023-04-03 04:15:52', '2023-04-03 04:15:52'),
(5707, 'en', 'copyright_text', 'Copyright Text', '2023-04-03 04:15:52', '2023-04-03 04:15:52'),
(5708, 'en', 'submit', 'Submit', '2023-04-03 04:15:52', '2023-04-03 04:15:52'),
(5709, 'en', 'site_seo__settings', 'Site Seo  Settings', '2023-04-03 04:16:03', '2023-04-03 04:16:03'),
(5710, 'en', 'meta_title', 'Meta title', '2023-04-03 04:16:03', '2023-04-03 04:16:03'),
(5711, 'en', 'meta_description', 'Meta description', '2023-04-03 04:16:03', '2023-04-03 04:16:03'),
(5712, 'en', 'meta_keywords', 'Meta keywords', '2023-04-03 04:16:03', '2023-04-03 04:16:03'),
(5713, 'en', 'meta_image', 'Meta image', '2023-04-03 04:16:03', '2023-04-03 04:16:03'),
(5714, 'en', 'email_placeholder', 'Email Placeholder', '2023-04-03 04:26:50', '2023-04-03 04:26:50'),
(5715, 'en', 'edit_language', 'Edit Language', '2023-04-03 05:27:27', '2023-04-03 05:27:27'),
(5716, 'en', 'update_language_information', 'Update Language Information', '2023-04-03 05:27:27', '2023-04-03 05:27:27'),
(5717, 'en', 'type_name', 'Type Name', '2023-04-03 05:27:27', '2023-04-03 05:27:27'),
(5718, 'en', 'type__native_name', 'Type  Native Name', '2023-04-03 05:27:27', '2023-04-03 05:27:27'),
(5719, 'en', 'update', 'Update', '2023-04-03 05:27:27', '2023-04-03 05:27:27'),
(5720, 'en', 'name_is_required', 'Name is required', '2023-04-03 05:28:09', '2023-04-03 05:28:09'),
(5721, 'en', 'code_is_required', 'Code is required', '2023-04-03 05:28:09', '2023-04-03 05:28:09'),
(5722, 'en', 'language_updated_successfully', 'Language updated successfully', '2023-04-03 05:28:09', '2023-04-03 05:28:09'),
(5723, 'en', 'add_page', 'Add Page', '2023-04-03 05:38:47', '2023-04-03 05:38:47'),
(5724, 'en', 'all', 'All', '2023-04-03 05:38:47', '2023-04-03 05:38:47'),
(5725, 'en', 'mine', 'Mine', '2023-04-03 05:38:47', '2023-04-03 05:38:47'),
(5726, 'en', 'trash', 'Trash', '2023-04-03 05:38:47', '2023-04-03 05:38:47'),
(5727, 'en', 'parent', 'Parent', '2023-04-03 05:38:47', '2023-04-03 05:38:47'),
(5728, 'en', 'showing', 'Showing', '2023-04-03 05:38:47', '2023-04-03 05:38:47'),
(5729, 'en', 'items_of', 'items of', '2023-04-03 05:38:47', '2023-04-03 05:38:47'),
(5730, 'en', 'bulk_action', 'Bulk Action', '2023-04-03 05:38:47', '2023-04-03 05:38:47'),
(5731, 'en', 'delete_selection', 'Delete selection', '2023-04-03 05:38:47', '2023-04-03 05:38:47'),
(5732, 'en', 'apply', 'Apply', '2023-04-03 05:38:47', '2023-04-03 05:38:47'),
(5733, 'en', 'no_action_selected', 'No Action Selected', '2023-04-03 05:38:47', '2023-04-03 05:38:47'),
(5734, 'en', 'no_item_selected', 'No Item Selected', '2023-04-03 05:38:47', '2023-04-03 05:38:47'),
(5735, 'en', 'edit_page', 'Edit Page', '2023-04-03 05:38:51', '2023-04-03 05:38:51'),
(5736, 'en', 'add_new', 'Add New', '2023-04-03 05:38:51', '2023-04-03 05:38:51'),
(5737, 'en', 'permalink', 'Permalink', '2023-04-03 05:38:51', '2023-04-03 05:38:51'),
(5738, 'en', 'type_here', 'Type here', '2023-04-03 05:38:51', '2023-04-03 05:38:51'),
(5739, 'en', 'seo_meta_tags', 'Seo Meta Tags', '2023-04-03 05:38:51', '2023-04-03 05:38:51'),
(5740, 'en', 'publish', 'Publish', '2023-04-03 05:38:51', '2023-04-03 05:38:51'),
(5741, 'en', 'draft', 'Draft', '2023-04-03 05:38:51', '2023-04-03 05:38:51'),
(5742, 'en', 'preview', 'Preview', '2023-04-03 05:38:51', '2023-04-03 05:38:51'),
(5743, 'en', 'visibility', 'Visibility', '2023-04-03 05:38:51', '2023-04-03 05:38:51'),
(5744, 'en', 'public', 'Public', '2023-04-03 05:38:51', '2023-04-03 05:38:51'),
(5745, 'en', 'password_protected', 'Password protected', '2023-04-03 05:38:51', '2023-04-03 05:38:51'),
(5746, 'en', 'if_password_field_is_remain_empty_then_visibility_will_be_saved_as_public', 'If Password Field is remain Empty then visibility will be saved as Public.', '2023-04-03 05:38:51', '2023-04-03 05:38:51'),
(5747, 'en', 'private', 'Private', '2023-04-03 05:38:51', '2023-04-03 05:38:51'),
(5748, 'en', 'page_attributes', 'Page Attributes', '2023-04-03 05:38:51', '2023-04-03 05:38:51'),
(5749, 'en', 'parents', 'Parents', '2023-04-03 05:38:51', '2023-04-03 05:38:51'),
(5750, 'en', 'select_a_parent_page', 'Select a Parent Page', '2023-04-03 05:38:51', '2023-04-03 05:38:51'),
(5751, 'en', 'featured_image', 'Featured Image', '2023-04-03 05:38:51', '2023-04-03 05:38:51'),
(5752, 'en', 'please_insert_page_title', 'Please Insert Page Title', '2023-04-03 05:39:15', '2023-04-03 05:39:15'),
(5753, 'en', 'this_title_is_already_available_please_insert_another', 'This Title is Already Available Please Insert Another', '2023-04-03 05:39:15', '2023-04-03 05:39:15'),
(5754, 'en', 'please_write_the_page_title_under_225_words', 'Please Write The Page Title under 225 words', '2023-04-03 05:39:15', '2023-04-03 05:39:15'),
(5755, 'en', 'this_permalink_is_already_available_please_insert_another', 'This Permalink is Already Available Please Insert Another', '2023-04-03 05:39:15', '2023-04-03 05:39:15'),
(5756, 'en', 'please_insert_a_valid_image', 'Please Insert A Valid Image', '2023-04-03 05:39:15', '2023-04-03 05:39:15'),
(5757, 'en', 'please_write_some_content', 'Please write some Content', '2023-04-03 05:39:15', '2023-04-03 05:39:15'),
(5758, 'en', 'please_select_a_valid_image', 'Please Select a Valid Image', '2023-04-03 05:39:15', '2023-04-03 05:39:15'),
(5759, 'en', 'something_went_wrong_please_select_visibility_again', 'Something went Wrong, Please Select Visibility Again', '2023-04-03 05:39:15', '2023-04-03 05:39:15'),
(5760, 'en', 'something_went_wrong_please_select_parent_again', 'Something went Wrong, Please Select Parent Again', '2023-04-03 05:39:15', '2023-04-03 05:39:15'),
(5761, 'en', 'page_updated_successfully', 'Page Updated Successfully', '2023-04-03 05:39:15', '2023-04-03 05:39:15'),
(5762, 'en', 'transalate_to_another_language', 'Transalate to another language', '2023-04-03 06:00:02', '2023-04-03 06:00:02'),
(5763, 'en', 'header_background_color', 'Header Background Color', '2023-04-03 06:00:15', '2023-04-03 06:00:15'),
(5764, 'en', 'set_header_background_color', 'Set Header Background Color.', '2023-04-03 06:00:15', '2023-04-03 06:00:15'),
(5765, 'en', 'sticky_header_background_color', 'Sticky Header Background Color', '2023-04-03 06:00:15', '2023-04-03 06:00:15'),
(5766, 'en', 'set_sticky_header_background_color', 'Set Sticky Header Background color.', '2023-04-03 06:00:15', '2023-04-03 06:00:15'),
(5767, 'en', 'header_search_icon', 'Header Search Icon', '2023-04-03 06:00:15', '2023-04-03 06:00:15'),
(5768, 'en', 'set_enable_to_display_search_icon', 'Set Enable to display search icon.', '2023-04-03 06:00:15', '2023-04-03 06:00:15'),
(5769, 'en', 'header_search_icon_color', 'Header Search Icon Color', '2023-04-03 06:00:15', '2023-04-03 06:00:15'),
(5770, 'en', 'set_search_icon_color', 'Set search icon color.', '2023-04-03 06:00:15', '2023-04-03 06:00:15'),
(5771, 'en', 'sticky_header_search_icon_color', 'Sticky Header Search Icon Color', '2023-04-03 06:00:15', '2023-04-03 06:00:15'),
(5772, 'en', 'set_sticky_header_search_icon_color', 'Set sticky header search icon color.', '2023-04-03 06:00:15', '2023-04-03 06:00:15'),
(5773, 'en', 'custom_header_style', 'Custom Header Style', '2023-04-03 06:00:18', '2023-04-03 06:00:18'),
(5774, 'en', 'custom_set_header_logo_style', 'custom set header logo style.', '2023-04-03 06:00:18', '2023-04-03 06:00:18'),
(5775, 'en', 'logo_dimensions_widthheight', 'Logo Dimensions (Width/Height).', '2023-04-03 06:00:18', '2023-04-03 06:00:18'),
(5776, 'en', 'set_logo_dimensions_to_choose_width_height_and_unit', 'Set logo dimensions to choose width, height, and unit.', '2023-04-03 06:00:18', '2023-04-03 06:00:18'),
(5777, 'en', 'width', 'Width', '2023-04-03 06:00:18', '2023-04-03 06:00:18'),
(5778, 'en', 'logo_top_and_bottom_margin', 'Logo Top and Bottom Margin.', '2023-04-03 06:00:18', '2023-04-03 06:00:18'),
(5779, 'en', 'set_logo_top_and_bottom_margin', 'Set logo top and bottom margin.', '2023-04-03 06:00:18', '2023-04-03 06:00:18'),
(5780, 'en', 'sticky_logo_dimensions_widthheight', 'Sticky Logo Dimensions (Width/Height).', '2023-04-03 06:00:18', '2023-04-03 06:00:18'),
(5781, 'en', 'set_sticky_logo_dimensions_to_choose_width_height_and_unit', 'Set Sticky logo dimensions to choose width, height, and unit.', '2023-04-03 06:00:18', '2023-04-03 06:00:18'),
(5782, 'en', 'sticky_logo_top_and_bottom_margin', 'Sticky Logo Top and Bottom Margin.', '2023-04-03 06:00:18', '2023-04-03 06:00:18'),
(5783, 'en', 'set_sticky_logo_top_and_bottom_margin', 'Set Sticky logo top and bottom margin.', '2023-04-03 06:00:18', '2023-04-03 06:00:18'),
(5784, 'en', 'home_page', 'Home Page', '2023-04-03 06:00:22', '2023-04-03 06:00:22'),
(5785, 'en', 'choose_home_page_layout_from_here_if_you_use_this_option_then_you_will_able_to_change_three_type_of_layout__default_right_sidebar_layout_', 'Choose home page layout from here. If you use this option then you will able to change three type of layout ( Default Right Sidebar Layout ).', '2023-04-03 06:00:22', '2023-04-03 06:00:22'),
(5786, 'en', 'custom_menu_style', 'Custom Menu Style', '2023-04-03 06:09:15', '2023-04-03 06:09:15'),
(5787, 'en', 'custom_set_menu_style', 'custom set menu style.', '2023-04-03 06:09:15', '2023-04-03 06:09:15'),
(5788, 'en', 'menu_color', 'Menu Color', '2023-04-03 06:09:15', '2023-04-03 06:09:15'),
(5789, 'en', 'set_header_menu_color', 'Set header menu color.', '2023-04-03 06:09:15', '2023-04-03 06:09:15'),
(5790, 'en', 'menu_hover_color', 'Menu Hover Color', '2023-04-03 06:09:15', '2023-04-03 06:09:15'),
(5791, 'en', 'set_header_menu_hover_color', 'Set header menu hover color.', '2023-04-03 06:09:15', '2023-04-03 06:09:15'),
(5792, 'en', 'menu_active_item_color', 'Menu Active Item Color', '2023-04-03 06:09:15', '2023-04-03 06:09:15'),
(5793, 'en', 'set_header_menu_active_item_color', 'Set header menu Active Item color.', '2023-04-03 06:09:15', '2023-04-03 06:09:15'),
(5794, 'en', 'sub_menu_color', 'Sub Menu Color', '2023-04-03 06:09:15', '2023-04-03 06:09:15'),
(5795, 'en', 'set_header_sub_menu_color', 'Set header sub menu color.', '2023-04-03 06:09:15', '2023-04-03 06:09:15'),
(5796, 'en', 'sub_menu_hover_color', 'Sub Menu Hover Color', '2023-04-03 06:09:15', '2023-04-03 06:09:15'),
(5797, 'en', 'set_header_sub_menu_hover_color', 'Set header sub menu hover color.', '2023-04-03 06:09:15', '2023-04-03 06:09:15'),
(5798, 'en', 'sub_menu_active_item_color', 'Sub Menu Active Item Color', '2023-04-03 06:09:15', '2023-04-03 06:09:15'),
(5799, 'en', 'set_header_sub_menu_active_item_color', 'Set header Sub menu Active Item color.', '2023-04-03 06:09:15', '2023-04-03 06:09:15'),
(5800, 'en', 'these_settings_control_the_typography_for_menu', 'These settings control the typography for menu.', '2023-04-03 06:09:21', '2023-04-03 06:09:21'),
(5801, 'en', 'submenu_typography', 'Submenu Typography', '2023-04-03 06:09:21', '2023-04-03 06:09:21'),
(5802, 'en', 'these_settings_control_the_typography_for_submenu', 'These settings control the typography for submenu.', '2023-04-03 06:09:22', '2023-04-03 06:09:22'),
(5803, 'en', 'update_user', 'Update User', '2023-04-03 06:09:52', '2023-04-03 06:09:52'),
(5804, 'en', 'update_profile', 'Update Profile', '2023-04-03 06:09:52', '2023-04-03 06:09:52'),
(5805, 'en', 'profile_picture', 'Profile Picture', '2023-04-03 06:09:52', '2023-04-03 06:09:52'),
(5806, 'en', 'give_your_name', 'Give your name', '2023-04-03 06:09:52', '2023-04-03 06:09:52'),
(5807, 'en', 'give_your_email_address', 'Give your email address', '2023-04-03 06:09:52', '2023-04-03 06:09:52'),
(5808, 'en', 'biography', 'Biography', '2023-04-03 06:09:52', '2023-04-03 06:09:52'),
(5809, 'en', 'not_more_than_200_characters', 'Not more than 200 characters', '2023-04-03 06:09:52', '2023-04-03 06:09:52'),
(5810, 'en', 'give_you_biography', 'Give you biography', '2023-04-03 06:09:52', '2023-04-03 06:09:52'),
(5811, 'en', 'old_password', 'Old Password', '2023-04-03 06:09:52', '2023-04-03 06:09:52'),
(5812, 'en', 'give_your_password', 'Give your password', '2023-04-03 06:09:52', '2023-04-03 06:09:52'),
(5813, 'en', 'confirm_password', 'Confirm Password', '2023-04-03 06:09:52', '2023-04-03 06:09:52'),
(5814, 'en', 'confirm_your_password', 'Confirm your password', '2023-04-03 06:09:52', '2023-04-03 06:09:52'),
(5815, 'en', 'social_info', 'Social Info', '2023-04-03 06:09:52', '2023-04-03 06:09:52'),
(5816, 'en', 'set_the_default_social_from_theme_option_or_make_custom_social', 'Set the default social from theme option or make custom social.', '2023-04-03 06:09:52', '2023-04-03 06:09:52'),
(5817, 'en', 'profile_pic_is_required', 'Profile pic is required', '2023-04-03 06:13:45', '2023-04-03 06:13:45'),
(5818, 'en', 'invalid_selection', 'Invalid selection', '2023-04-03 06:13:45', '2023-04-03 06:13:45'),
(5819, 'en', 'profile_updated_successfully', 'Profile updated successfully', '2023-04-03 06:13:45', '2023-04-03 06:13:45'),
(5820, 'en', 'clear_filter', 'Clear Filter', '2023-04-03 06:25:22', '2023-04-03 06:25:22'),
(5821, 'en', 'edit_menus', 'Edit Menus', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5822, 'en', 'manage_locations', 'Manage Locations', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5823, 'en', 'select_a_menu_to_edit', 'Select a menu to edit:', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5824, 'en', 'create_menu_', 'Create Menu ', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5825, 'en', 'translate_menu_into', 'Translate Menu Into:', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5826, 'en', 'custom_links', 'Custom Links', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5827, 'en', 'link_text', 'Link Text', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5828, 'en', 'add_to_menu', 'Add to Menu', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5829, 'en', 'most_recent', 'Most Recent', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5830, 'en', 'view_all', 'View All', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5831, 'en', 'search', 'Search', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5832, 'en', 'select_all', 'Select All', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5833, 'en', 'select_all_', 'Select All ', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5834, 'en', 'posts', 'Posts', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5835, 'en', 'menu_name', 'Menu Name', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5836, 'en', 'give_your_menu_a_name_then_click_save_menu', 'Give your menu a name, then click Save Menu.', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5837, 'en', 'menu_settings', 'Menu Settings', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5838, 'en', 'display_locations', 'Display Locations', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5839, 'en', 'currently_set_to__', 'Currently set to : ', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5840, 'en', 'save_menu', 'Save Menu', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5841, 'en', 'drag_the_items_into_the_order_you_prefer_click_the_arrow_on_the_right_of_the_item_to_reveal_additional_configuration_options', 'Drag the items into the order you prefer. Click the arrow on the right of the item to reveal additional configuration options.', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5842, 'en', 'delete_menu', 'Delete Menu', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5843, 'en', 'update_menu', 'Update Menu', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5844, 'en', 'your_theme_supports', 'Your theme supports', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5845, 'en', 'menus_select_which_menu_appears_in_each_location', 'menus. Select which menu appears in each location.', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5846, 'en', 'theme_location', 'Theme Location', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5847, 'en', 'assigned_menu', 'Assigned Menu', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5848, 'en', '_edit', ' Edit', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5849, 'en', 'use_new_menu', 'Use new menu', '2023-04-03 06:56:22', '2023-04-03 06:56:22'),
(5850, 'en', 'menu_list_updated_successfully', 'Menu list updated successfully', '2023-04-03 06:56:47', '2023-04-03 06:56:47'),
(5851, 'en', 'blog_category', 'Blog Category', '2023-04-03 08:17:48', '2023-04-03 08:17:48'),
(5852, 'en', 'blog_categories', 'Blog Categories', '2023-04-03 08:17:48', '2023-04-03 08:17:48'),
(5853, 'en', 'add_blog_category', 'Add Blog Category', '2023-04-03 08:17:48', '2023-04-03 08:17:48'),
(5854, 'en', 'edit_blog_category', 'Edit Blog Category', '2023-04-03 08:17:52', '2023-04-03 08:17:52'),
(5855, 'en', 'select_a_category', 'Select a Category', '2023-04-03 08:17:52', '2023-04-03 08:17:52'),
(5856, 'en', 'short_description', 'Short Description', '2023-04-03 08:17:52', '2023-04-03 08:17:52'),
(5857, 'en', 'please_insert_a_name', 'Please Insert a Name', '2023-04-03 08:18:32', '2023-04-03 08:18:32'),
(5858, 'en', 'this_name_is_already_available_please_insert_another', 'This Name is Already Available Please Insert Another', '2023-04-03 08:18:33', '2023-04-03 08:18:33'),
(5859, 'en', 'please_write_the_category_name_under_225_words', 'Please Write The Category Name under 225 words', '2023-04-03 08:18:33', '2023-04-03 08:18:33'),
(5860, 'en', 'blog_category_updated_successfully', 'Blog Category Updated Successfully', '2023-04-03 08:18:33', '2023-04-03 08:18:33'),
(5861, 'en', 'tag', 'Tag', '2023-04-03 08:21:59', '2023-04-03 08:21:59'),
(5862, 'en', 'add_tag', 'Add Tag', '2023-04-03 08:21:59', '2023-04-03 08:21:59'),
(5863, 'en', 'edit_tag', 'Edit Tag', '2023-04-03 08:22:05', '2023-04-03 08:22:05'),
(5864, 'en', 'please_write_the_tag_name_under_225_words', 'Please Write The Tag Name under 225 words', '2023-04-03 08:22:19', '2023-04-03 08:22:19'),
(5865, 'en', 'tag_updated_successfully', 'Tag Updated Successfully', '2023-04-03 08:22:19', '2023-04-03 08:22:19'),
(5866, 'en', 'header_language_select', 'Header Language Select', '2023-04-03 08:41:10', '2023-04-03 08:41:10'),
(5867, 'en', 'set_enable_to_display_multilanguage_select_in_header', 'Set Enable to display multi-language select in header.', '2023-04-03 08:41:10', '2023-04-03 08:41:10'),
(5868, 'en', 'contact', 'Contact', '2023-04-03 09:51:03', '2023-04-03 09:51:03'),
(5869, 'en', 'custom_contact_page_style', 'Custom Contact Page Style', '2023-04-03 09:51:10', '2023-04-03 09:51:10'),
(5870, 'en', 'set_custom_contact_page_style', 'set custom contact page style.', '2023-04-03 09:51:10', '2023-04-03 09:51:10'),
(5871, 'en', 'back_to_top_button', 'Back To Top Button', '2023-04-04 03:32:23', '2023-04-04 03:32:23'),
(5872, 'en', 'switch_on_to_display_back_to_top_button', 'Switch On to Display back to top button.', '2023-04-04 03:32:23', '2023-04-04 03:32:23'),
(5873, 'en', 'custom_back_to_top_button', 'Custom Back To Top Button', '2023-04-04 03:32:23', '2023-04-04 03:32:23'),
(5874, 'en', 'if_you_switch_it_off_it_will_show_default_design_for_back_to_top_button', 'If you switch it off, it will show default design for \"back to top\" button.', '2023-04-04 03:32:23', '2023-04-04 03:32:23'),
(5875, 'en', 'custom_back_to_top_button_icon', 'Custom Back To Top Button Icon', '2023-04-04 03:32:23', '2023-04-04 03:32:23'),
(5876, 'en', 'select_back_to_top_button_icon', 'Select Back To Top Button icon.', '2023-04-04 03:32:23', '2023-04-04 03:32:23'),
(5877, 'en', 'back_to_top_button_background_color', 'Back To Top Button Background Color', '2023-04-04 03:32:23', '2023-04-04 03:32:23'),
(5878, 'en', 'set_back_to_top_button_background_color', 'Set Back to top button Background Color.', '2023-04-04 03:32:23', '2023-04-04 03:32:23'),
(5879, 'en', 'back_to_top_button_color', 'Back To Top Button Color', '2023-04-04 03:32:23', '2023-04-04 03:32:23'),
(5880, 'en', 'set_back_to_top_button_color', 'Set Back to top button Color.', '2023-04-04 03:32:23', '2023-04-04 03:32:23'),
(5881, 'en', 'back_to_top_hover_button_color', 'Back To Top Hover Button Color', '2023-04-04 03:32:23', '2023-04-04 03:32:23'),
(5882, 'en', 'back_to_top_button_hover_background_color', 'Back To Top Button Hover Background Color', '2023-04-04 03:32:23', '2023-04-04 03:32:23'),
(5883, 'en', 'set_back_to_top_button_hover_background_color', 'Set Back to top button hover background Color.', '2023-04-04 03:32:23', '2023-04-04 03:32:23'),
(5884, 'en', 'keep_back_to_top_button_on_mobile', 'Keep Back To Top Button On Mobile', '2023-04-04 03:32:23', '2023-04-04 03:32:23'),
(5885, 'en', 'if_you_switch_it_on_it_will_show_in_mobile_devices', 'If you switch it on, it will show in mobile devices..', '2023-04-04 03:32:23', '2023-04-04 03:32:23'),
(5886, 'en', 'custom_mobile_menu_style', 'Custom Mobile Menu Style', '2023-04-04 03:32:42', '2023-04-04 03:32:42'),
(5887, 'en', 'custom_set_mobile_menu_style', 'custom set mobile menu style.', '2023-04-04 03:32:42', '2023-04-04 03:32:42'),
(5888, 'en', 'mobile_menu_icon_color', 'Mobile Menu Icon Color', '2023-04-04 03:32:42', '2023-04-04 03:32:42'),
(5889, 'en', 'set_mobile_menu_icon_color', 'Set Mobile menu Icon color.', '2023-04-04 03:32:42', '2023-04-04 03:32:42'),
(5890, 'en', 'sticky_header_mobile_menu_icon_color', 'Sticky Header Mobile Menu Icon Color', '2023-04-04 03:32:42', '2023-04-04 03:32:42'),
(5891, 'en', 'set_sticky_header_mobile_menu_icon_color', 'Set Sticky Header Mobile menu Icon color.', '2023-04-04 03:32:42', '2023-04-04 03:32:42'),
(5892, 'en', 'mobile_menu_color', 'Mobile Menu Color', '2023-04-04 03:32:42', '2023-04-04 03:32:42'),
(5893, 'en', 'set_mobile_menu_color', 'Set Mobile menu color.', '2023-04-04 03:32:42', '2023-04-04 03:32:42'),
(5894, 'en', 'mobile_menu_hover_color', 'Mobile Menu Hover Color', '2023-04-04 03:32:42', '2023-04-04 03:32:42'),
(5895, 'en', 'set_mobile_menu_hover_color', 'Set Mobile menu hover color.', '2023-04-04 03:32:42', '2023-04-04 03:32:42'),
(5896, 'en', 'mobile_menu_active_item_color', 'Mobile Menu Active Item Color', '2023-04-04 03:32:42', '2023-04-04 03:32:42'),
(5897, 'en', 'set_mobile_menu_active_item_color', 'Set Mobile menu Active Item color.', '2023-04-04 03:32:42', '2023-04-04 03:32:42'),
(5898, 'en', 'mobile_sub_menu_color', 'Mobile Sub Menu Color', '2023-04-04 03:32:42', '2023-04-04 03:32:42'),
(5899, 'en', 'set_mobile_sub_menu_color', 'Set Mobile sub menu color.', '2023-04-04 03:32:42', '2023-04-04 03:32:42'),
(5900, 'en', 'mobile_sub_menu_hover_color', 'Mobile Sub Menu Hover Color', '2023-04-04 03:32:42', '2023-04-04 03:32:42'),
(5901, 'en', 'set_mobile_sub_menu_hover_color', 'Set Mobile sub menu hover color.', '2023-04-04 03:32:42', '2023-04-04 03:32:42'),
(5902, 'en', 'mobile_sub_menu_active_item_color', 'Mobile Sub Menu Active Item Color', '2023-04-04 03:32:42', '2023-04-04 03:32:42'),
(5903, 'en', 'set_mobile_sub_menu_active_item_color', 'Set Mobile Sub menu Active Item color.', '2023-04-04 03:32:42', '2023-04-04 03:32:42'),
(5904, 'en', 'default', 'Default', '2023-04-04 04:07:09', '2023-04-04 04:07:09'),
(5905, 'en', 'custom', 'Custom', '2023-04-04 04:07:09', '2023-04-04 04:07:09'),
(5906, 'en', 'hide', 'Hide', '2023-04-04 04:07:09', '2023-04-04 04:07:09'),
(5907, 'en', 'show', 'Show', '2023-04-04 04:07:09', '2023-04-04 04:07:09'),
(5908, 'en', 'contact_image', 'Contact Image', '2023-04-04 04:14:40', '2023-04-04 04:14:40'),
(5909, 'en', 'showhide_contact_page_image', 'show/hide contact page image', '2023-04-04 04:14:40', '2023-04-04 04:14:40'),
(5910, 'en', 'contact_image_settig', 'Contact Image Settig', '2023-04-04 04:14:40', '2023-04-04 04:14:40'),
(5911, 'en', 'set_contact_image_default_or_custom', 'set contact image default or custom', '2023-04-04 04:14:40', '2023-04-04 04:14:40'),
(5912, 'en', 'custom_contact_image', 'Custom Contact Image', '2023-04-04 04:14:40', '2023-04-04 04:14:40'),
(5913, 'en', 'set_custom_contact_image', 'set custom contact image', '2023-04-04 04:14:40', '2023-04-04 04:14:40'),
(5914, 'en', 'disable', 'Disable', '2023-04-04 04:15:12', '2023-04-04 04:15:12'),
(5915, 'en', 'enable', 'Enable', '2023-04-04 04:15:12', '2023-04-04 04:15:12'),
(5916, 'en', 'contact_image_setting', 'Contact Image Setting', '2023-04-04 04:17:48', '2023-04-04 04:17:48'),
(5917, 'en', 'conatct_title', 'Conatct Title', '2023-04-04 04:44:59', '2023-04-04 04:44:59'),
(5918, 'en', 'set_title_for_contact_page', 'set title for contact page', '2023-04-04 04:44:59', '2023-04-04 04:44:59'),
(5919, 'en', 'contact_title', 'contact Title', '2023-04-04 04:44:59', '2023-04-04 04:44:59'),
(5920, 'en', 'conatct_subtitle', 'Conatct Subtitle', '2023-04-04 04:44:59', '2023-04-04 04:44:59'),
(5921, 'en', 'set_subtitle_for_contact_page', 'set subtitle for contact page', '2023-04-04 04:44:59', '2023-04-04 04:44:59'),
(5922, 'en', 'contact_name_placeholder', 'Contact Name Placeholder', '2023-04-04 05:00:15', '2023-04-04 05:00:15'),
(5923, 'en', 'set_placeholder_for_contact_form_name', 'set placeholder for contact form name', '2023-04-04 05:00:15', '2023-04-04 05:00:15'),
(5924, 'en', 'contact_email_placeholder', 'Contact Email Placeholder', '2023-04-04 05:00:15', '2023-04-04 05:00:15'),
(5925, 'en', 'set_placeholder_for_contact_form_email', 'set placeholder for contact form email', '2023-04-04 05:00:15', '2023-04-04 05:00:15'),
(5926, 'en', 'contact_subject_placeholder', 'Contact Subject Placeholder', '2023-04-04 05:00:15', '2023-04-04 05:00:15'),
(5927, 'en', 'set_placeholder_for_contact_form_subject', 'set placeholder for contact form subject', '2023-04-04 05:00:15', '2023-04-04 05:00:15'),
(5928, 'en', 'contact_message_placeholder', 'Contact Message Placeholder', '2023-04-04 05:00:15', '2023-04-04 05:00:15'),
(5929, 'en', 'contact_email_will_be_sent', 'Contact Email Will Be Sent', '2023-04-04 05:09:45', '2023-04-04 05:09:45'),
(5930, 'en', 'set_where_will_be_the_contact_email_will_be_sent', 'set where will be the contact email will be sent', '2023-04-04 05:09:45', '2023-04-04 05:09:45'),
(5931, 'en', 'contact_submit_button_text', 'Contact Submit Button Text', '2023-04-04 05:11:37', '2023-04-04 05:11:37'),
(5932, 'en', 'contact_submit_button_textr', 'Contact Submit Button Textr', '2023-04-04 05:11:37', '2023-04-04 05:11:37'),
(5933, 'en', 'set_placeholder_for_message_form_subject', 'set placeholder for message form subject', '2023-04-04 05:12:32', '2023-04-04 05:12:32'),
(5934, 'en', 'set_contact_form_buton_text', 'set contact form buton text', '2023-04-04 05:12:32', '2023-04-04 05:12:32'),
(5935, 'en', 'no', 'No.', '2023-04-04 07:54:26', '2023-04-04 07:54:26'),
(5936, 'en', 'template', 'Template', '2023-04-04 07:54:26', '2023-04-04 07:54:26'),
(5937, 'en', 'details', 'Details', '2023-04-04 07:54:26', '2023-04-04 07:54:26'),
(5938, 'en', 'enter_email_subject', 'Enter email subject', '2023-04-04 07:54:26', '2023-04-04 07:54:26'),
(5939, 'en', 'variables', 'Variables', '2023-04-04 07:54:26', '2023-04-04 07:54:26'),
(5940, 'en', 'smtp_configuration', 'Smtp Configuration', '2023-04-04 07:54:47', '2023-04-04 07:54:47'),
(5941, 'en', 'email_configuration', 'Email Configuration', '2023-04-04 07:54:47', '2023-04-04 07:54:47'),
(5942, 'en', 'type', 'Type', '2023-04-04 07:54:47', '2023-04-04 07:54:47'),
(5943, 'en', 'smtp', 'smtp', '2023-04-04 07:54:47', '2023-04-04 07:54:47'),
(5944, 'en', 'sendmail', 'Sendmail', '2023-04-04 07:54:47', '2023-04-04 07:54:47'),
(5945, 'en', 'mailgun', 'Mailgun', '2023-04-04 07:54:47', '2023-04-04 07:54:47'),
(5946, 'en', 'mail_host', 'MAIL HOST', '2023-04-04 07:54:47', '2023-04-04 07:54:47'),
(5947, 'en', 'mail_port', 'MAIL PORT', '2023-04-04 07:54:47', '2023-04-04 07:54:47'),
(5948, 'en', 'mail_username', 'MAIL USERNAME', '2023-04-04 07:54:47', '2023-04-04 07:54:47'),
(5949, 'en', 'mail_password', 'MAIL PASSWORD', '2023-04-04 07:54:47', '2023-04-04 07:54:47'),
(5950, 'en', 'mail_encryption', 'MAIL ENCRYPTION', '2023-04-04 07:54:47', '2023-04-04 07:54:47'),
(5951, 'en', 'mail_from_address', 'MAIL FROM ADDRESS', '2023-04-04 07:54:47', '2023-04-04 07:54:47'),
(5952, 'en', 'mail_from_name', 'MAIL FROM NAME', '2023-04-04 07:54:47', '2023-04-04 07:54:47'),
(5953, 'en', 'mailgun_domain', 'MAILGUN DOMAIN', '2023-04-04 07:54:47', '2023-04-04 07:54:47'),
(5954, 'en', 'mailgun_secret', 'MAILGUN SECRET', '2023-04-04 07:54:47', '2023-04-04 07:54:47'),
(5955, 'en', 'send_test_mail', 'Send Test Mail', '2023-04-04 07:54:47', '2023-04-04 07:54:47'),
(5956, 'en', 'subject', 'Subject', '2023-04-04 07:54:47', '2023-04-04 07:54:47'),
(5957, 'en', 'message', 'Message', '2023-04-04 07:54:47', '2023-04-04 07:54:47'),
(5958, 'en', 'send', 'Send', '2023-04-04 07:54:47', '2023-04-04 07:54:47'),
(5959, 'en', 'email_sent_successfully', 'Email Sent Successfully', '2023-04-04 08:12:15', '2023-04-04 08:12:15'),
(5960, 'en', 'email_sending_failed', 'Email Sending Failed', '2023-04-04 08:22:19', '2023-04-04 08:22:19'),
(5961, 'en', 'please_fill_in_all_fields_and_ensure_that_the_data_entered_is_valid', '\"Please fill in all fields and ensure that the data entered is valid.', '2023-04-04 08:37:25', '2023-04-04 08:37:25'),
(5962, 'en', 'email_sending_failed_please_contact_with_admin', 'Email sending failed. Please contact with admin', '2023-04-04 09:04:53', '2023-04-04 09:04:53'),
(5963, 'en', 'email_template_updated_successful', 'Email template updated successful', '2023-04-05 04:22:58', '2023-04-05 04:22:58'),
(5964, 'en', 'select_option', 'Select Option', '2023-04-05 09:39:18', '2023-04-05 09:39:18'),
(5965, 'en', 'featured_blogs', 'Featured Blogs', '2023-04-05 09:39:18', '2023-04-05 09:39:18'),
(5966, 'en', 'sub_title_color', 'Sub Title Color', '2023-04-05 09:39:18', '2023-04-05 09:39:18'),
(5967, 'en', 'slider_item_color', 'Slider Item Color', '2023-04-05 09:39:18', '2023-04-05 09:39:18'),
(5968, 'en', 'login_credentials_does_not_match', 'Login Credentials Does not Match', '2023-04-06 03:16:39', '2023-04-06 03:16:39'),
(5969, 'en', 'page_trashed_successfully', 'Page Trashed Successfully', '2023-04-06 05:29:10', '2023-04-06 05:29:10'),
(5970, 'en', 'restore', 'Restore', '2023-04-06 05:29:16', '2023-04-06 05:29:16'),
(5971, 'en', 'page_restored_successfully', 'Page Restored Successfully', '2023-04-06 05:29:20', '2023-04-06 05:29:20'),
(5972, 'en', 'last_modified', 'Last Modified', '2023-04-06 05:29:23', '2023-04-06 05:29:23'),
(5973, 'en', 'contact_in_header_menu', 'Contact In Header Menu', '2023-04-06 06:29:01', '2023-04-06 06:29:01'),
(5974, 'en', 'showhide_contact_link_in_header_menu', 'show/hide contact link in header menu', '2023-04-06 06:29:01', '2023-04-06 06:29:01'),
(5975, 'en', 'contact_in_header_menu_text', 'Contact In Header Menu Text', '2023-04-06 06:29:01', '2023-04-06 06:29:01'),
(5976, 'en', 'contact_header_text', 'Contact Header Text', '2023-04-06 06:29:01', '2023-04-06 06:29:01'),
(5977, 'en', 'set_text_for_contact_in_header_menu', 'set text for contact in header menu', '2023-04-06 06:30:12', '2023-04-06 06:30:12'),
(5978, 'en', 'set_text_for_contact_in_header_menu_if_no_text_is_set_default_contact_will_be_placed', 'set text for contact in header menu. if no text is set default \"Contact\" will be placed', '2023-04-06 06:36:52', '2023-04-06 06:36:52'),
(5979, 'en', 'these_settings_control_the_typography_for_body', 'These settings control the typography for body.', '2023-04-08 08:10:42', '2023-04-08 08:10:42'),
(5980, 'en', 'add_blog', 'Add Blog', '2023-04-08 08:54:15', '2023-04-08 08:54:15'),
(5981, 'en', 'stick_this_post_to_the_frontpage', 'Stick this post to the frontpage', '2023-04-08 08:54:50', '2023-04-08 08:54:50'),
(5982, 'en', 'blog_image', 'Blog Image', '2023-04-08 08:54:51', '2023-04-08 08:54:51'),
(5983, 'en', 'featured_status', 'Featured Status', '2023-04-08 08:54:51', '2023-04-08 08:54:51'),
(5984, 'en', 'no_option_selected', 'No Option Selected', '2023-04-08 08:54:51', '2023-04-08 08:54:51'),
(5985, 'en', 'only_active_categories', 'Only Active Categories', '2023-04-08 08:54:52', '2023-04-08 08:54:52'),
(5986, 'en', 'new_tag', 'New Tag', '2023-04-08 08:54:52', '2023-04-08 08:54:52'),
(5987, 'en', 'add', 'Add', '2023-04-08 08:54:52', '2023-04-08 08:54:52'),
(5988, 'en', 'add_new_tag', 'Add New Tag', '2023-04-08 08:54:52', '2023-04-08 08:54:52'),
(5989, 'en', 'new_category', 'New Category', '2023-04-08 08:54:52', '2023-04-08 08:54:52'),
(5990, 'en', 'select_parent', 'Select Parent', '2023-04-08 08:54:52', '2023-04-08 08:54:52'),
(5991, 'en', 'select_a_parent_category', 'Select a Parent Category', '2023-04-08 08:54:52', '2023-04-08 08:54:52'),
(5992, 'en', 'add_new_category', 'Add New Category', '2023-04-08 08:54:52', '2023-04-08 08:54:52'),
(5993, 'en', 'edit_blog', 'Edit Blog', '2023-04-08 08:55:03', '2023-04-08 08:55:03'),
(5994, 'en', 'please_insert_blog_name', 'Please Insert Blog Name', '2023-04-08 09:00:11', '2023-04-08 09:00:11'),
(5995, 'en', 'please_write_the_blog_name_under_225_words', 'Please Write The Blog Name under 225 words', '2023-04-08 09:00:12', '2023-04-08 09:00:12'),
(5996, 'en', 'something_went_wrong_please_select_category_again', 'Something went Wrong, Please Select Category Again', '2023-04-08 09:00:12', '2023-04-08 09:00:12'),
(5997, 'en', 'new_blog_saved', 'New Blog Saved', '2023-04-08 09:00:12', '2023-04-08 09:00:12'),
(5998, 'en', 'blog_updated_successfully', 'Blog Updated Successfully', '2023-04-08 09:00:53', '2023-04-08 09:00:53'),
(5999, 'en', 'by', 'By:', '2023-04-08 09:14:21', '2023-04-08 09:14:21'),
(6000, 'en', 'version', 'Version:', '2023-04-08 09:14:21', '2023-04-08 09:14:21'),
(6001, 'en', 'activated', 'Activated', '2023-04-08 09:14:21', '2023-04-08 09:14:21'),
(6002, 'en', 'activate_confirmation', 'activate Confirmation', '2023-04-08 09:14:21', '2023-04-08 09:14:21'),
(6003, 'en', 'are_you_sure_to_active_this_theme', 'Are you sure to active this theme', '2023-04-08 09:14:21', '2023-04-08 09:14:21'),
(6004, 'en', 'activate', 'Activate', '2023-04-08 09:14:21', '2023-04-08 09:14:21'),
(6005, 'en', 'footer_language_select', 'Footer Language Select', '2023-04-10 05:28:21', '2023-04-10 05:28:21'),
(6006, 'en', 'set_enable_to_display_multilanguage_select_in_footer', 'Set Enable to display multi-language select in footer.', '2023-04-10 05:28:21', '2023-04-10 05:28:21'),
(6007, 'en', 'plugings', 'Plugings', '2023-04-11 06:39:21', '2023-04-11 06:39:21'),
(6008, 'en', 'deactive_confirmation', 'Deactive Confirmation', '2023-04-11 06:39:22', '2023-04-11 06:39:22'),
(6009, 'en', 'are_you_sure_to_deactive_this_plugin', 'Are you sure to deactive this plugin', '2023-04-11 06:39:22', '2023-04-11 06:39:22'),
(6010, 'en', 'deactivate', 'Deactivate', '2023-04-11 06:39:22', '2023-04-11 06:39:22'),
(6011, 'en', 'are_you_sure_to_active_this_plugin', 'Are you sure to active this plugin', '2023-04-11 06:39:22', '2023-04-11 06:39:22'),
(6012, 'en', 'placeholder_image', 'Placeholder Image', '2023-04-11 06:39:27', '2023-04-11 06:39:27'),
(6013, 'en', 'watermark_settings', 'Watermark Settings', '2023-04-11 06:39:27', '2023-04-11 06:39:27'),
(6014, 'en', 'enabledisable_watermark', 'Enable/Disable Watermark', '2023-04-11 06:39:27', '2023-04-11 06:39:27'),
(6015, 'en', 'watermark_image', 'Watermark Image', '2023-04-11 06:39:27', '2023-04-11 06:39:27'),
(6016, 'en', 'watermark_image_position', 'Watermark Image Position', '2023-04-11 06:39:27', '2023-04-11 06:39:27'),
(6017, 'en', 'top_left', 'Top Left', '2023-04-11 06:39:27', '2023-04-11 06:39:27'),
(6018, 'en', 'top_right', 'Top Right', '2023-04-11 06:39:27', '2023-04-11 06:39:27'),
(6019, 'en', 'bottom_left', 'Bottom Left', '2023-04-11 06:39:27', '2023-04-11 06:39:27'),
(6020, 'en', 'watermarking_image_opacity_', 'Watermarking image opacity (%)', '2023-04-11 06:39:27', '2023-04-11 06:39:27'),
(6021, 'en', 'watermarking_image_opacity', 'Watermarking image opacity', '2023-04-11 06:39:27', '2023-04-11 06:39:27'),
(6022, 'en', 'media_thumbnails_sizes', 'Media Thumbnails Sizes', '2023-04-11 06:39:27', '2023-04-11 06:39:27'),
(6023, 'en', 'large_thumb_image_size', 'Large Thumb Image Size', '2023-04-11 06:39:27', '2023-04-11 06:39:27'),
(6024, 'en', 'large_thumb_image_width', 'Large thumb image width', '2023-04-11 06:39:27', '2023-04-11 06:39:27'),
(6025, 'en', 'large_thumb_image_height', 'Large thumb image height', '2023-04-11 06:39:27', '2023-04-11 06:39:27'),
(6026, 'en', 'medium_thumb_image_size', 'Medium Thumb Image Size', '2023-04-11 06:39:27', '2023-04-11 06:39:27'),
(6027, 'en', 'medium_thumb_image_width', 'Medium thumb image width', '2023-04-11 06:39:27', '2023-04-11 06:39:27'),
(6028, 'en', 'medium_thumb_image_height', 'Medium thumb image height', '2023-04-11 06:39:27', '2023-04-11 06:39:27'),
(6029, 'en', 'small_thumb_image_size', 'Small Thumb Image Size', '2023-04-11 06:39:27', '2023-04-11 06:39:27'),
(6030, 'en', 'small_thumb_image_width', 'Small thumb image width', '2023-04-11 06:39:27', '2023-04-11 06:39:27'),
(6031, 'en', 'small_thumb_image_height', 'Small thumb image height', '2023-04-11 06:39:27', '2023-04-11 06:39:27'),
(6032, 'en', 'select_image_applicable_folder', 'Select image applicable folder', '2023-04-11 06:39:27', '2023-04-11 06:39:27'),
(6033, 'en', 'delete_permanently', 'Delete Permanently', '2023-04-11 07:49:23', '2023-04-11 07:49:23'),
(6034, 'en', 'file_name', 'File Name:', '2023-04-11 07:49:24', '2023-04-11 07:49:24'),
(6035, 'en', 'file_url', 'File URL:', '2023-04-11 07:49:24', '2023-04-11 07:49:24'),
(6036, 'en', 'file_type', 'File Type:', '2023-04-11 07:49:24', '2023-04-11 07:49:24'),
(6037, 'en', 'file_size', 'File Size:', '2023-04-11 07:49:24', '2023-04-11 07:49:24'),
(6038, 'en', 'uploaded_by', 'Uploaded By:', '2023-04-11 07:49:24', '2023-04-11 07:49:24'),
(6039, 'en', 'created_at', 'Created At:', '2023-04-11 07:49:24', '2023-04-11 07:49:24'),
(6040, 'en', 'updated_at', 'Updated At:', '2023-04-11 07:49:24', '2023-04-11 07:49:24'),
(6041, 'en', 'download', 'Download', '2023-04-11 07:49:24', '2023-04-11 07:49:24'),
(6042, 'en', 'copy_url_to_clipboard', 'Copy URL to clipboard', '2023-04-11 07:49:24', '2023-04-11 07:49:24'),
(6043, 'en', 'alt________________________________________________________________________________________________________________________________text', 'Alt                                                                                                                                Text', '2023-04-11 07:49:24', '2023-04-11 07:49:24'),
(6044, 'en', 'caption', 'Caption', '2023-04-11 07:49:24', '2023-04-11 07:49:24'),
(6045, 'en', 'description', 'Description', '2023-04-11 07:49:24', '2023-04-11 07:49:24'),
(6046, 'en', 'media_file_uploaded_successful', 'Media file uploaded successful', '2023-04-11 07:49:33', '2023-04-11 07:49:33'),
(6047, 'en', 'media_file_deleted_successfully', 'Media file deleted successfully', '2023-04-11 07:51:42', '2023-04-11 07:51:42'),
(6048, 'en', 'media_settings_updated_successfully', 'Media settings updated successfully', '2023-04-11 08:38:58', '2023-04-11 08:38:58'),
(6049, 'en', 'blog_not_found', 'Blog not found', '2023-04-12 04:46:47', '2023-04-12 04:46:47'),
(6050, 'en', 'blog_featured_status_changed_successfully', 'Blog Featured Status Changed Successfully', '2023-04-12 04:53:12', '2023-04-12 04:53:12'),
(6051, 'en', 'unable_to_update_media_file', 'Unable to update media file', '2023-04-12 05:12:07', '2023-04-12 05:12:07'),
(6052, 'en', 'category_color', 'Category Color', '2023-04-13 04:34:09', '2023-04-13 04:34:09'),
(6053, 'en', 'new_section_added_successfully', 'New Section added successfully', '2023-04-13 04:42:45', '2023-04-13 04:42:45'),
(6054, 'en', 'a_new_comment_added', 'A New Comment Added.', '2023-04-13 08:14:20', '2023-04-13 08:14:20'),
(6055, 'en', 'your_comment_added', 'Your Comment Added', '2023-04-13 08:14:20', '2023-04-13 08:14:20'),
(6056, 'en', 'module_name', 'Module Name', '2023-04-13 08:15:21', '2023-04-13 08:15:21'),
(6057, 'en', 'permission_name', 'Permission Name', '2023-04-13 08:15:21', '2023-04-13 08:15:21'),
(6058, 'en', 'users_login_activity', 'Users login activity', '2023-04-13 08:20:04', '2023-04-13 08:20:04'),
(6059, 'en', 'user', 'User', '2023-04-13 08:20:04', '2023-04-13 08:20:04'),
(6060, 'en', 'login_at', 'Login At', '2023-04-13 08:20:04', '2023-04-13 08:20:04'),
(6061, 'en', 'logout_at', 'Logout At', '2023-04-13 08:20:04', '2023-04-13 08:20:04'),
(6062, 'en', 'ip', 'IP', '2023-04-13 08:20:04', '2023-04-13 08:20:04'),
(6063, 'en', 'operating_system', 'Operating System', '2023-04-13 08:20:04', '2023-04-13 08:20:04'),
(6064, 'en', 'browser', 'Browser', '2023-04-13 08:20:04', '2023-04-13 08:20:04'),
(6065, 'en', 'action', 'Action', '2023-04-13 08:20:04', '2023-04-13 08:20:04'),
(6066, 'en', '________________________bulk_action_', '                        Bulk Action ', '2023-04-13 08:20:04', '2023-04-13 08:20:04'),
(6067, 'en', '________________________delete_selection_', '                        Delete selection ', '2023-04-13 08:20:04', '2023-04-13 08:20:04'),
(6068, 'en', '________________________apply_', '                        Apply ', '2023-04-13 08:20:04', '2023-04-13 08:20:04'),
(6069, 'en', 'no_item_selected_', 'No Item Selected ', '2023-04-13 08:20:04', '2023-04-13 08:20:04'),
(6070, 'en', 'no_action_selected_', 'No Action Selected ', '2023-04-13 08:20:04', '2023-04-13 08:20:04'),
(6071, 'en', 'add_new_user', 'Add New User', '2023-04-13 08:20:07', '2023-04-13 08:20:07'),
(6072, 'en', 'uid', 'UID', '2023-04-13 08:20:07', '2023-04-13 08:20:07'),
(6073, 'en', 'assign_role', 'Assign Role', '2023-04-13 08:20:10', '2023-04-13 08:20:10'),
(6074, 'en', 'select_a_role', 'Select a Role', '2023-04-13 08:20:10', '2023-04-13 08:20:10'),
(6075, 'en', 'user_updated_successfully', 'User updated successfully', '2023-04-13 08:20:16', '2023-04-13 08:20:16'),
(6076, 'en', 'add_user', 'Add User', '2023-04-13 08:21:09', '2023-04-13 08:21:09'),
(6077, 'en', 'user_status_updated_successfully', 'User status updated successfully', '2023-04-13 08:21:36', '2023-04-13 08:21:36'),
(6078, 'en', 'comment_setting', 'Comment Setting', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6079, 'en', 'default_blog_settings', 'Default Blog settings', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6080, 'en', 'allow_people_to_submit_comments_on_new_blogs', 'Allow people to submit comments on new blogs', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6081, 'en', 'other_comment_settings', 'Other comment settings', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6082, 'en', 'comment_author_must_fill_out_name_and_email', 'Comment author must fill out name and email', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6083, 'en', 'users_must_be_registered_and_logged_in_to_comment', 'Users must be registered and logged in to comment', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6084, 'en', 'automatically_close_comments_on_blogs_older_than', 'Automatically close comments on blogs older than', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6085, 'en', 'days', 'days', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6086, 'en', 'enable_threaded_nested_comments', 'Enable threaded (nested) comments', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6087, 'en', 'levels_deep', 'levels deep', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6088, 'en', 'break_comments_into_pages_with', 'Break comments into pages with', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6089, 'en', 'top_level_comments_per_page_and', 'top level comments per page and', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6090, 'en', 'comments_should_be_displayed_with_the', 'Comments should be displayed with the', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6091, 'en', 'older', 'older', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6092, 'en', 'newer', 'newer', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6093, 'en', 'comments_at_the_top_of_each_page', 'comments at the top of each page', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6094, 'en', 'email_me_whenever', 'Email me whenever', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6095, 'en', 'anyone_posts_a_comment', 'Anyone posts a comment', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6096, 'en', 'a_comment_is_held_for_moderation', 'A comment is held for moderation', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6097, 'en', 'before_a_comment_appears', 'Before a comment appears', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6098, 'en', 'comment_must_be_manually_approved', 'Comment must be manually approved', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6099, 'en', 'comment_author_must_have_a_previously_approved_comment', 'Comment author must have a previously approved comment', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6100, 'en', 'comment_moderation', 'Comment Moderation', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6101, 'en', 'hold_a_comment_in_the_queue_if_it_contains', 'Hold a comment in the queue if it contains', '2023-04-13 08:46:41', '2023-04-13 08:46:41');
INSERT INTO `tl_translations` (`id`, `lang`, `lang_key`, `lang_value`, `created_at`, `updated_at`) VALUES
(6102, 'en', 'or_more_links_a_common_characteristic_of_comment_spam_is_a_large_number_of_hyperlinks', 'or more links. (A common characteristic of comment spam is a large number of hyperlinks.)', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6103, 'en', 'when_a_comment_contains_any_of_these_words_in_its_content_author_name_url_email_ip_address_or_browsers_user_agent_string_it_will_be_held_in_the_', 'When a comment contains any of these words in its content, author name, URL, email, IP address, or browser’s user agent string, it will be held in the ', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6104, 'en', 'pending_queue', 'pending queue', '2023-04-13 08:46:41', '2023-04-13 08:46:41'),
(6105, 'en', 'one_word_or_ip_address_per_line_it_will_match_inside_words_so_press_will_match_wordpress', 'One word or IP address per line. It will match inside words, so “press” will match “WordPress”.', '2023-04-13 08:46:42', '2023-04-13 08:46:42'),
(6106, 'en', 'disallowed_comment_keys', 'Disallowed Comment Keys', '2023-04-13 08:46:42', '2023-04-13 08:46:42'),
(6107, 'en', 'when_a_comment_contains_any_of_these_words_in_its_content_author_name_url_email_ip_address_or_browsers_user_agent_string_it_will_be_put_in_the_trash_one_word_or_ip_address_per_line_it_will_match_inside_words_so_press_will_match_wordpress', 'When a comment contains any of these words in its content, author name, URL, email, IP address, or browser’s user agent string, it will be put in the Trash. One word or IP address per line. It will match inside words, so “press” will match “WordPress”.', '2023-04-13 08:46:42', '2023-04-13 08:46:42'),
(6108, 'en', 'avatars', 'Avatars', '2023-04-13 08:46:42', '2023-04-13 08:46:42'),
(6109, 'en', 'an_avatar_is_an_image_that_can_be_associated_with_a_user_across_multiple_websites_in_this_area_you_can_choose_to_display_avatars_of_users_who_interact_with_the_site', 'An avatar is an image that can be associated with a user across multiple websites. In this area, you can choose to display avatars of users who interact with the site.', '2023-04-13 08:46:42', '2023-04-13 08:46:42'),
(6110, 'en', 'avatar_display', 'Avatar Display', '2023-04-13 08:46:42', '2023-04-13 08:46:42'),
(6111, 'en', 'show_avatars', 'Show Avatars', '2023-04-13 08:46:42', '2023-04-13 08:46:42'),
(6112, 'en', 'default_avatar', 'Default Avatar', '2023-04-13 08:46:42', '2023-04-13 08:46:42'),
(6113, 'en', 'for_users_without_a_custom_avatar_of_their_own_you_can_either_display_a_generic_logo_or_a_generated_one_based_on_their_email_address', 'For users without a custom avatar of their own, you can either display a generic logo or a generated one based on their email address.', '2023-04-13 08:46:42', '2023-04-13 08:46:42'),
(6114, 'en', 'mystery_person', 'Mystery Person', '2023-04-13 08:46:42', '2023-04-13 08:46:42'),
(6115, 'en', 'blank', 'Blank', '2023-04-13 08:46:42', '2023-04-13 08:46:42'),
(6116, 'en', 'gravatar_logo', 'Gravatar Logo', '2023-04-13 08:46:42', '2023-04-13 08:46:42'),
(6117, 'en', 'identicon_generated', 'Identicon (Generated)', '2023-04-13 08:46:42', '2023-04-13 08:46:42'),
(6118, 'en', 'wavatar_generated', 'Wavatar (Generated)', '2023-04-13 08:46:42', '2023-04-13 08:46:42'),
(6119, 'en', 'monsterid_generated', 'MonsterID (Generated)', '2023-04-13 08:46:42', '2023-04-13 08:46:42'),
(6120, 'en', 'retro_generated', 'Retro (Generated)', '2023-04-13 08:46:42', '2023-04-13 08:46:42'),
(6121, 'en', 'please_check_for_missing_field_or_invalid_data_and_try_again', 'Please check for missing field or invalid data and try again.', '2023-04-13 08:47:35', '2023-04-13 08:47:35'),
(6122, 'en', 'menu_deleted_successfully', 'Menu deleted successfully', '2023-04-13 09:11:21', '2023-04-13 09:11:21'),
(6123, 'en', 'add_title', 'Add Title', '2023-04-15 04:55:09', '2023-04-15 04:55:09'),
(6124, 'en', 'new_page_saved', 'New Page Saved', '2023-04-15 04:55:23', '2023-04-15 04:55:23'),
(6125, 'en', 'preferred_size_for_thumnail_image_is_1110__578_px', 'Preferred size for thumnail image is 1110 × 578 px', '2023-04-15 05:37:50', '2023-04-15 05:37:50'),
(6126, 'en', 'general_settings_updated_successfully', 'General settings updated successfully', '2023-04-15 06:03:52', '2023-04-15 06:03:52'),
(6127, 'en', 'alt_text', 'Alt Text', '2023-04-15 09:13:52', '2023-04-15 09:13:52'),
(6128, 'en', 'blog_deleted_successfully', 'Blog Deleted Successfully', '2023-04-29 06:42:56', '2023-04-29 06:42:56'),
(6129, 'en', 'add_role', 'Add Role', '2023-04-29 09:11:48', '2023-04-29 09:11:48'),
(6130, 'en', 'give_role_name', 'Give role name', '2023-04-29 09:11:48', '2023-04-29 09:11:48'),
(6131, 'en', 'module', 'Module', '2023-04-29 09:11:48', '2023-04-29 09:11:48'),
(6132, 'en', 'feature', 'Feature', '2023-04-29 09:11:48', '2023-04-29 09:11:48'),
(6133, 'en', 'create', 'Create', '2023-04-29 09:11:48', '2023-04-29 09:11:48'),
(6134, 'en', 'manage', 'Manage', '2023-04-29 09:11:48', '2023-04-29 09:11:48'),
(6135, 'en', 'show_', 'Show ', '2023-04-29 09:11:48', '2023-04-29 09:11:48'),
(6136, 'en', 'create_', 'Create ', '2023-04-29 09:11:48', '2023-04-29 09:11:48'),
(6137, 'en', 'edit_', 'Edit ', '2023-04-29 09:11:48', '2023-04-29 09:11:48'),
(6138, 'en', 'delete_', 'Delete ', '2023-04-29 09:11:48', '2023-04-29 09:11:48'),
(6139, 'en', 'manage_', 'Manage ', '2023-04-29 09:11:48', '2023-04-29 09:11:48'),
(6140, 'en', 'update_role', 'Update Role', '2023-04-29 09:11:49', '2023-04-29 09:11:49'),
(6141, 'en', 'sidebar_updated', 'Sidebar Updated', '2023-04-29 10:07:27', '2023-04-29 10:07:27'),
(6142, 'en', 'stick_this_post_to_the_front_of_blog_list_page', 'Stick this post to the front of blog list page', '2023-04-29 11:46:07', '2023-04-29 11:46:07'),
(6143, 'en', 'blog_comment', 'Blog Comment', '2023-04-30 04:52:31', '2023-04-30 04:52:31'),
(6144, 'en', 'approve', 'Approve', '2023-04-30 04:52:31', '2023-04-30 04:52:31'),
(6145, 'en', 'spam', 'Spam', '2023-04-30 04:52:31', '2023-04-30 04:52:31'),
(6146, 'en', 'in_response_to', 'In Response to', '2023-04-30 04:52:31', '2023-04-30 04:52:31'),
(6147, 'en', 'unapprove', 'Unapprove', '2023-04-30 04:52:31', '2023-04-30 04:52:31'),
(6148, 'en', 'reply', 'Reply', '2023-04-30 04:52:31', '2023-04-30 04:52:31'),
(6149, 'en', 'view_blog', 'View Blog', '2023-04-30 04:52:31', '2023-04-30 04:52:31'),
(6150, 'en', 'comment_delete_confirmation', 'Comment Delete Confirmation', '2023-04-30 04:52:31', '2023-04-30 04:52:31'),
(6151, 'en', 'are_you_sure_you_want_to_permanently_delete_this_comment', 'Are you sure you want to Permanently Delete This Comment', '2023-04-30 04:52:31', '2023-04-30 04:52:31'),
(6152, 'en', 'bulk_action_confirmation', 'Bulk Action Confirmation', '2023-04-30 04:52:31', '2023-04-30 04:52:31'),
(6153, 'en', 'are_you_sure_you_want_to_take_this_action', 'Are you sure you want to take this Action', '2023-04-30 04:52:31', '2023-04-30 04:52:31'),
(6154, 'en', 'comment_reply', 'Comment Reply', '2023-04-30 04:52:31', '2023-04-30 04:52:31'),
(6155, 'en', 'move_to_trash', 'Move to Trash', '2023-04-30 04:52:31', '2023-04-30 04:52:31'),
(6156, 'en', 'mark_as_spam', 'Mark as Spam', '2023-04-30 04:52:31', '2023-04-30 04:52:31'),
(6157, 'en', 'not_spam', 'Not Spam', '2023-04-30 04:52:31', '2023-04-30 04:52:31'),
(6158, 'en', 'delete_permanetly', 'Delete Permanetly', '2023-04-30 04:52:31', '2023-04-30 04:52:31'),
(6159, 'en', 'delete_all', 'Delete All', '2023-04-30 04:52:31', '2023-04-30 04:52:31'),
(6160, 'en', 'edit_comment', 'Edit Comment', '2023-04-30 05:03:12', '2023-04-30 05:03:12'),
(6161, 'en', 'please_enter_a_valid_number_for_comment_close_days', 'Please Enter a Valid Number for Comment Close Days.', '2023-04-30 05:12:30', '2023-04-30 05:12:30'),
(6162, 'en', 'the_minimum_number_for_comment_close_days_is_1', 'The Minimum Number for Comment Close Days is 1', '2023-04-30 05:12:30', '2023-04-30 05:12:30'),
(6163, 'en', 'please_select_a_valid_option_for_comment_threads_level', 'Please Select a valid option for Comment Threads Level', '2023-04-30 05:12:30', '2023-04-30 05:12:30'),
(6164, 'en', 'please_enter_a_valid_number_for_per_page_comment', 'Please Enter a Valid Number for Per Page Comment', '2023-04-30 05:12:30', '2023-04-30 05:12:30'),
(6165, 'en', 'the_minimum_comments_for_per_page_is_8', 'The Minimum Comments for per Page is 8', '2023-04-30 05:12:30', '2023-04-30 05:12:30'),
(6166, 'en', 'please_select_a_valid_option_for_default_comment_page', 'Please Select a valid option for Default Comment Page', '2023-04-30 05:12:30', '2023-04-30 05:12:30'),
(6167, 'en', 'please_select_a_valid_option_for_comment_order', 'Please Select a valid option for Comment order', '2023-04-30 05:12:30', '2023-04-30 05:12:30'),
(6168, 'en', 'please_enter_a_valid_number_for_comment_links', 'Please Enter a Valid Number for Comment links', '2023-04-30 05:12:30', '2023-04-30 05:12:30'),
(6169, 'en', 'the_minimum_comment_links_number_must_be_1', 'The Minimum Comment links number must be 1', '2023-04-30 05:12:30', '2023-04-30 05:12:30'),
(6170, 'en', 'please_select_a_valid_default_avatar', 'Please Select a valid Default Avatar', '2023-04-30 05:12:30', '2023-04-30 05:12:30'),
(6171, 'en', 'comment_settings_updated_successfully', 'Comment Settings Updated Successfully', '2023-04-30 05:12:31', '2023-04-30 05:12:31'),
(6172, 'en', 'seo_update_successfully', 'Seo update successfully', '2023-04-30 06:01:49', '2023-04-30 06:01:49'),
(6173, 'en', 'mail_driver_is_required', 'Mail driver is required', '2023-04-30 06:59:03', '2023-04-30 06:59:03'),
(6174, 'en', 'smtp_configuration_updated_successfully', 'SMTP configuration updated successfully', '2023-04-30 06:59:03', '2023-04-30 06:59:03'),
(6175, 'en', 'new_language', 'New Language', '2023-04-30 09:42:53', '2023-04-30 09:42:53'),
(6176, 'en', 'select_a_option', 'Select a option', '2023-04-30 09:42:53', '2023-04-30 09:42:53'),
(6177, 'en', 'section_deleted_successfully', 'Section deleted successfully', '2023-04-30 10:02:47', '2023-04-30 10:02:47'),
(6178, 'en', 'after_uploading_your_fonts_you_should_select_font_family_customfont1customfont2_from_dropdown_list_in_bodyparagraphheadingsmenublog_typography_section', 'After uploading your fonts, you should select font family (custom-font-1/custom-font-2 from dropdown list in (Body/Paragraph/Headings/Menu/Blog) Typography section.', '2023-04-30 11:32:29', '2023-04-30 11:32:29'),
(6179, 'en', 'custom_font1', 'Custom Font1', '2023-04-30 11:32:29', '2023-04-30 11:32:29'),
(6180, 'en', 'please_enable_this_option_to_use_custom_font_1', 'Please Enable this option to use Custom Font 1.', '2023-04-30 11:32:29', '2023-04-30 11:32:29'),
(6181, 'en', 'custom_font_1_woff', 'Custom font 1 .woff', '2023-04-30 11:32:29', '2023-04-30 11:32:29'),
(6182, 'en', 'remove', 'Remove', '2023-04-30 11:32:29', '2023-04-30 11:32:29'),
(6183, 'en', 'custom_font_1_ttf', 'Custom font 1 .ttf', '2023-04-30 11:32:29', '2023-04-30 11:32:29'),
(6184, 'en', 'custom_font_1_eot', 'Custom font 1 .eot', '2023-04-30 11:32:30', '2023-04-30 11:32:30'),
(6185, 'en', 'custom_font2', 'Custom Font2', '2023-04-30 11:32:30', '2023-04-30 11:32:30'),
(6186, 'en', 'please_enable_this_option_to_use_custom_font_2', 'Please Enable this option to use Custom Font 2.', '2023-04-30 11:32:30', '2023-04-30 11:32:30'),
(6187, 'en', 'custom_font_2_woff', 'Custom font 2 .woff', '2023-04-30 11:32:30', '2023-04-30 11:32:30'),
(6188, 'en', 'custom_font_2_ttf', 'Custom font 2 .ttf', '2023-04-30 11:32:30', '2023-04-30 11:32:30'),
(6189, 'en', 'custom_font_2_eot', 'Custom font 2 .eot', '2023-04-30 11:32:30', '2023-04-30 11:32:30'),
(6190, 'en', 'import_file_or_clipboard_text_is_required', 'Import File or Clipboard Text is Required', '2023-05-01 11:32:28', '2023-05-01 11:32:28'),
(6191, 'en', 'role_name_is_required', 'Role name is required', '2023-05-02 05:51:13', '2023-05-02 05:51:13'),
(6192, 'en', 'role_name_already_exists', 'Role name already exists', '2023-05-02 05:51:13', '2023-05-02 05:51:13'),
(6193, 'en', 'role_permission_required', 'Role permission required', '2023-05-02 05:51:13', '2023-05-02 05:51:13'),
(6194, 'en', 'role_updated_successful', 'Role updated successful', '2023-05-02 05:51:13', '2023-05-02 05:51:13'),
(6195, 'en', 'widget_removed_from_sidebar', 'Widget Removed From Sidebar', '2023-05-02 06:00:39', '2023-05-02 06:00:39'),
(6196, 'en', 'result_for', 'Result For', '2023-05-06 12:35:02', '2023-05-06 12:35:02'),
(6197, 'en', 'license_activate', 'License activate', '2023-05-10 09:17:24', '2023-05-10 09:17:24'),
(6198, 'en', 'license_key', 'License Key', '2023-05-10 09:17:24', '2023-05-10 09:17:24'),
(6199, 'en', 'enter_license_key', 'Enter License Key', '2023-05-10 09:17:24', '2023-05-10 09:17:24'),
(6200, 'en', 'welcome', 'Welcome', '2023-05-10 09:20:40', '2023-05-10 09:20:40'),
(6201, 'en', 'pages_bulk_delete_successful', 'Pages Bulk Delete Successful', '2023-05-10 11:08:47', '2023-05-10 11:08:47'),
(6202, 'en', 'page_deleted_successfully', 'Page Deleted Successfully', '2023-05-10 11:09:36', '2023-05-10 11:09:36'),
(6203, 'en', 'blogs_bulk_delete_successful', 'Blogs Bulk Delete Successful', '2023-05-10 12:09:31', '2023-05-10 12:09:31'),
(6204, 'en', 'tag_bulk_deleted_successfully', 'Tag Bulk Deleted Successfully', '2023-05-10 12:11:41', '2023-05-10 12:11:41'),
(6205, 'en', 'blog_category_bulk_deleting_failed', 'Blog Category Bulk Deleting Failed', '2023-05-10 12:12:44', '2023-05-10 12:12:44'),
(6206, 'en', 'blog_category_deleted_successfully', 'Blog Category Deleted Successfully', '2023-05-10 12:16:23', '2023-05-10 12:16:23'),
(6207, 'en', 'user_deleted_successfully', 'User deleted successfully', '2023-05-10 12:21:54', '2023-05-10 12:21:54'),
(6208, 'en', 'you_can_not_inactive_this_language', 'You can not inactive this language', '2023-05-10 12:32:52', '2023-05-10 12:32:52'),
(6210, 'en', 'nothing_found', 'Nothing found', '2023-05-11 03:45:46', '2023-05-11 03:45:46'),
(6211, 'en', 'role_deleted_successfully', 'Role deleted successfully', '2023-05-11 05:26:04', '2023-05-11 05:26:04'),
(6212, 'en', 'theme_color', 'Theme Color', '2023-05-13 03:37:08', '2023-05-13 03:37:08'),
(6213, 'en', 'theme_primary_color', 'Theme Primary Color', '2023-05-13 03:37:10', '2023-05-13 03:37:10'),
(6214, 'en', 'set_theme_primary_color', 'Set theme primary color', '2023-05-13 03:37:10', '2023-05-13 03:37:10'),
(6215, 'sa', 'cache_clear_successfully', 'تم مسح ذاكرة التخزين المؤقت بنجاح', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6216, 'sa', 'languages', 'اللغات', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6217, 'sa', 'add_new_language', 'أضف لغة جديدة', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6218, 'sa', 'name', 'اسم', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6219, 'sa', 'native_name', 'الاسم الأصلي', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6220, 'sa', 'code', 'شفرة', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6221, 'sa', 'flag', 'علَم', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6222, 'sa', 'rtl', 'RTL', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6223, 'sa', 'status', 'حالة', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6224, 'sa', 'actions', 'أجراءات', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6225, 'sa', 'backend_translations', 'ترجمات الخلفية', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6226, 'sa', 'frontend_translations', 'ترجمات الواجهة الأمامية', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6227, 'sa', 'edit', 'يحرر', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6228, 'sa', 'delete', 'يمسح', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6229, 'sa', 'delete_confirmation', 'تأكيد الحذف', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6230, 'sa', 'are_you_sure_to_delete_this', 'هل أنت متأكد من حذف هذا', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6231, 'sa', 'cencel', 'سينسل', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6232, 'sa', 'my_profile', 'ملفي', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6233, 'sa', 'log_out', 'تسجيل خروج', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6234, 'sa', 'clear_cache', 'مسح ذاكرة التخزين المؤقت', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6235, 'sa', 'notifications', 'إشعارات', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6236, 'sa', 'clear_all', 'امسح الكل', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6237, 'sa', 'dashboard', 'لوحة القيادة', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6238, 'sa', 'media', 'وسائط', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6239, 'sa', 'blog', 'مدونة', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6240, 'sa', 'all_blogs', 'كل المدونات', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6241, 'sa', 'add_new_blog', 'أضف مدونة جديدة', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6242, 'sa', 'categories', 'فئات', '2023-05-13 06:25:37', '2023-05-13 06:25:37'),
(6243, 'sa', 'tags', 'العلامات', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6244, 'sa', 'comments', 'تعليقات', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6245, 'sa', 'settings', 'إعدادات', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6246, 'sa', 'comment_settings', 'إعدادات التعليق', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6247, 'sa', 'pages', 'الصفحات', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6248, 'sa', 'all_pages', 'كل الصفحات', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6249, 'sa', 'add_new_page', 'أضف صفحة جديدة', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6250, 'sa', 'appearances', 'ظهور', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6251, 'sa', 'themes', 'ثيمات', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6252, 'sa', 'menus', 'القوائم', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6253, 'sa', 'theme_options', 'خيارات الموضوع', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6254, 'sa', 'general_settings', 'الاعدادات العامة', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6255, 'sa', 'home_page_builder', 'منشئ الصفحة الرئيسية', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6256, 'sa', 'widgets', 'الحاجيات', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6257, 'sa', 'plugins', 'الإضافات', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6258, 'sa', 'email_settings', 'إعدادات البريد الإلكتروني', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6259, 'sa', 'email_templates', 'قوالب البريد الإلكتروني', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6260, 'sa', 'media_settings', 'إعدادات الوسائط', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6261, 'sa', 'seo_settings', 'إعدادات تحسين محركات البحث', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6262, 'sa', 'users', 'المستخدمون', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6263, 'sa', 'roles', 'الأدوار', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6264, 'sa', 'permissions', 'أذونات', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6265, 'sa', 'activity_logs', 'سجلات النشاط', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6266, 'sa', 'login_activity', 'نشاط تسجيل الدخول', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6267, 'sa', 'you_have_no_unread_notification', 'ليس لديك إشعار غير مقروء', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6268, 'sa', 'key', 'مفتاح', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6269, 'sa', 'value', 'قيمة', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6270, 'sa', 'save', 'يحفظ', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6271, 'sa', 'page_not_found', 'الصفحة غير موجودة!', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6272, 'sa', 'the_page_you_are_looking_for_was_moved_removed_renamed_or_never_existed_please_check_the_url_or_go_to', 'يرجى التحقق من عنوان url أو الانتقال إلى', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6273, 'sa', 'main_page', 'الصفحة الرئيسية.', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6274, 'sa', 'search_here', 'ابحث هنا', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6275, 'sa', 'save_changes', 'حفظ التغييرات', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6276, 'sa', 'comment_loaded_successfully', 'تم تحميل التعليق بنجاح', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6277, 'sa', 'homepage_builder', 'منشئ الصفحة الرئيسية', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6278, 'sa', 'home_page_sections', 'أقسام الصفحة الرئيسية', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6279, 'sa', 'add_new_section', 'إضافة قسم جديد', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6280, 'sa', 'banner_slider', 'بانر سلايدر', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6281, 'sa', 'manage_slider', 'إدارة شريط التمرير', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6282, 'sa', 'are_you_sure_to_delete_this_section', 'هل أنت متأكد من حذف هذا القسم', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6283, 'sa', 'cancel', 'يلغي', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6284, 'sa', 'new_section', 'قسم جديد', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6285, 'sa', 'select_section', 'حدد القسم', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6286, 'sa', 'select_layout', 'حدد التخطيط', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6287, 'sa', 'ads', 'إعلانات', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6288, 'sa', 'latest_blogs', 'أحدث المدونات', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6289, 'sa', 'featured_product', 'المنتج المميز', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6290, 'sa', 'most_viewed_blog', 'المدونة الأكثر مشاهدة', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6291, 'sa', 'trending_blog', 'مدونة رائجة', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6292, 'sa', 'category_wise', 'فئة الحكمة', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6293, 'sa', 'please_select_a_style', 'الرجاء تحديد نمط', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6294, 'sa', 'section_properties', 'خصائص القسم', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6295, 'sa', 'media_library', 'مكتبة الوسائط', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6296, 'sa', 'upload_files', 'تحميل الملفات', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6297, 'sa', 'click_or_drop_files_here_to_upload', 'انقر أو أفلت الملفات هنا للتحميل', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6298, 'sa', 'filter_media', 'إعلام منقى', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6299, 'sa', 'all_file_type', 'كل أنواع الملفات', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6300, 'sa', 'all_dates', 'كل التواريخ', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6301, 'sa', 'load_more', 'تحميل المزيد', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6302, 'sa', 'insert', 'إدراج', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6303, 'sa', 'attachment_details', 'تفاصيل المرفقات', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6304, 'sa', 'alt________________________text_', 'نص بديل :', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6305, 'sa', 'title_', 'عنوان :', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6306, 'sa', 'caption_', 'التسمية التوضيحية :', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6307, 'sa', 'description_', 'وصف :', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6308, 'sa', 'content', 'محتوى', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6309, 'sa', 'background', 'خلفية', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6310, 'sa', 'advanced', 'متقدم', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6311, 'sa', 'select_layouts', 'حدد التخطيطات', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6312, 'sa', 'title', 'عنوان', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6313, 'sa', 'type_title', 'اكتب العنوان', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6314, 'sa', 'title_is_not_visible_in_homepage', 'العنوان غير مرئي في الصفحة الرئيسية', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6315, 'sa', 'background_color', 'لون الخلفية', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6316, 'sa', 'background_image', 'الصورة الخلفية', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6317, 'sa', 'choose_file', 'اختر ملف', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6318, 'sa', 'background_size', 'حجم الخلفية', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6319, 'sa', 'background_position', 'موقف الخلفية', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6320, 'sa', 'background_repeat', 'تكرار الخلفية', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6321, 'sa', 'padding', 'حشوة', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6322, 'sa', 'top', 'قمة', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6323, 'sa', 'right', 'يمين', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6324, 'sa', 'bottom', 'قاع', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6325, 'sa', 'left', 'غادر', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6326, 'sa', 'margin', 'هامِش', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6327, 'sa', 'button', 'زر', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6328, 'sa', 'blog_post_style', 'نمط وظيفة المدونة', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6329, 'sa', 'select_style', 'حدد النمط', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6330, 'sa', 'style_1', 'النمط 1', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6331, 'sa', 'style_2', 'النمط 2', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6332, 'sa', 'style_3', 'النمط 3', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6333, 'sa', 'style_4', 'النمط 4', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6334, 'sa', 'style_5', 'النمط 5', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6335, 'sa', 'blog_colum', 'مدونة Colum', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6336, 'sa', 'number_of_blogs', 'عدد المدونات', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6337, 'sa', 'title_is_visible_in_homepage_transalate_to_another_language', 'التحويل إلى لغة أخرى', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6338, 'sa', 'click_here', 'انقر هنا', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6339, 'sa', 'title_color', 'لون العنوان', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6340, 'sa', 'description_color', 'وصف اللون', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6341, 'sa', 'button_title', 'عنوان الزر', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6342, 'sa', 'button_title_is_visible_in_homepage_transalate_to_another_language', 'التحويل إلى لغة أخرى', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6343, 'sa', 'button_color', 'لون الزر', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6344, 'sa', 'button_hover_color', 'لون تحوم الزر', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6345, 'sa', 'button_background_color', 'لون خلفية الزر', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6346, 'sa', 'button_background_hover_color', 'لون خلفية زر التمرير', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6347, 'sa', 'button_border', 'حد الزر', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6348, 'sa', 'button_border_color', 'لون حدود الزر', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6349, 'sa', 'button_border_hover_color', 'زر تحوم لون الحدود', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6350, 'sa', 'select_category', 'اختر الفئة', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6351, 'sa', 'update_section', 'قسم التحديث', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6352, 'sa', 'section', 'قسم', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6353, 'sa', 'image', 'صورة', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6354, 'sa', 'url', 'عنوان Url', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6355, 'sa', 'cover', 'غطاء', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6356, 'sa', 'auto', 'آلي', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6357, 'sa', 'contain', 'يحتوي', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6358, 'sa', 'initial', 'أولي', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6359, 'sa', 'revert', 'يرجع', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6360, 'sa', 'inherit', 'انت ورثت', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6361, 'sa', 'revertlayer', 'عودة طبقة', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6362, 'sa', 'unset', 'غير محدد', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6363, 'sa', 'center', 'مركز', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6364, 'sa', 'section_updated_successfully', 'تم تحديث القسم بنجاح', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6365, 'sa', 'translations_updated_successfully', 'تم تحديث الترجمات بنجاح', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6366, 'sa', 'reset_section', 'قسم إعادة التعيين', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6367, 'sa', 'reset_all', 'إعادة ضبط الجميع', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6368, 'sa', 'general', 'عام', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6369, 'sa', 'back_to_top', 'العودة الى الأعلى', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6370, 'sa', 'preloader', 'محمل', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6371, 'sa', 'typography', 'الطباعة', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6372, 'sa', 'body_typography', 'طباعة الجسم', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6373, 'sa', 'paragraph_typography', 'طباعة الفقرة', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6374, 'sa', 'heading_typography', 'طباعة العنوان', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6375, 'sa', 'menu_typography', 'طباعة القائمة', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6376, 'sa', 'button_typography', 'طباعة الزر', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6377, 'sa', 'custom_fonts', 'خطوط عادية', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6378, 'sa', 'header', 'رأس', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6379, 'sa', 'header_option', 'خيار الرأس', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6380, 'sa', 'header_logo', 'رأس الشعار', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6381, 'sa', 'menu', 'قائمة طعام', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6382, 'sa', 'mobile_menu', 'قائمة المحمول', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6383, 'sa', 'home_page_layout', 'تخطيط الصفحة الرئيسية', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6384, 'sa', 'blog_option', 'خيار المدونة', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6385, 'sa', 'single_blog_page', 'صفحة مدونة واحدة', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6386, 'sa', 'sidebar_options', 'خيارات الشريط الجانبي', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6387, 'sa', 'page', 'صفحة', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6388, 'sa', '404_page', '404 صفحة', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6389, 'sa', 'subscribe', 'يشترك', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6390, 'sa', 'social', 'اجتماعي', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6391, 'sa', 'footer', 'تذييل', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6392, 'sa', 'custom_css', 'لغة تنسيق ويب حسب الطلب', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6393, 'sa', 'importexport', 'استيراد و تصدير', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6394, 'sa', 'reset_confirmation', 'إعادة التأكيد', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6395, 'sa', 'are_you_sure_to_want_to_reset', 'هل أنت متأكد أنك تريد إعادة تعيين', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6396, 'sa', 'action_failed', 'العمل: فشل', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6397, 'sa', 'select_font_subsets', 'حدد Font Subsets', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6398, 'sa', 'select_weight__style', 'حدد الوزن والشكل', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6399, 'sa', 'new_slide', 'شريحة جديدة', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6400, 'sa', 'iconexample_fa_fafacebook', 'الرمز (مثال: fa fa-facebook)', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6401, 'sa', 'copied', 'نسخ', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6402, 'sa', 'import_options_json', 'خيارات الاستيراد Json', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6403, 'sa', 'import_from_clipboard', 'استيراد من الحافظة', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6404, 'sa', 'uploade_file', 'رفع ملف', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6405, 'sa', 'paste_your_clipboard_data_here', 'الصق بيانات الحافظة الخاصة بك هنا.', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6406, 'sa', 'import', 'يستورد', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6407, 'sa', 'warning_this_will_overwrite_all_existing_option_values_please_proceed_with_caution', 'سيؤدي هذا إلى استبدال جميع قيم الخيارات الحالية ، يرجى المتابعة بحذر!', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6408, 'sa', 'export_options_json', 'خيارات التصدير Json', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6409, 'sa', 'here_you_can_copydownload_your_current_option_settings_keep_this_safe_as_you_can_use_it_as_a_backup_should_anything_go_wrong_or_you_can_use_it_to_restore_your_settings_on_this_site_or_any_other_site', 'حافظ على هذا آمنًا حيث يمكنك استخدامه كنسخة احتياطية في حالة حدوث أي خطأ ، أو يمكنك استخدامه لاستعادة إعداداتك على هذا الموقع (أو أي موقع آخر).', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6410, 'sa', 'copy_to_clipboard', 'نسخ إلى الحافظة', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6411, 'sa', 'export_file', 'ملف التصدير', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6412, 'sa', 'custom_footer_style', 'نمط تذييل مخصص', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6413, 'sa', 'set_custom_footer_style', 'تعيين نمط تذييل مخصص', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6414, 'sa', 'footer_background_color', 'لون خلفية التذييل', '2023-05-13 06:25:38', '2023-05-13 06:25:38'),
(6415, 'sa', 'set_footer_background_color', 'تعيين لون خلفية التذييل', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6416, 'sa', 'select_color', 'إختر لون', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6417, 'sa', 'transparent', 'شفاف', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6418, 'sa', 'custom_footer_padding', 'مساحة تذييل مخصصة.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6419, 'sa', 'set_footer_padding', 'تعيين مساحة التذييل.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6420, 'sa', 'footer_social_enabledisable', 'التذييل الاجتماعي تمكين / تعطيل', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6421, 'sa', 'set_enable_to_show_footer_social', 'قم بتعيين تمكين لإظهار التذييل الاجتماعي', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6422, 'sa', 'footer_social_color', 'اللون الاجتماعي للتذييل', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6423, 'sa', 'set_footer_social_color', 'تعيين اللون الاجتماعي للتذييل', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6424, 'sa', 'footer_social_hover_color', 'لون التمرير الاجتماعي للتذييل', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6425, 'sa', 'footer_social_alignment', 'محاذاة التذييل الاجتماعية', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6426, 'sa', 'set_footer_social_alignment_position', 'قم بتعيين موضع المحاذاة الاجتماعية للتذييل', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6427, 'sa', 'footer_logo_enabledisable', 'تمكين / تعطيل شعار التذييل', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6428, 'sa', 'set_enable_to_show_footer_logo_header_logo_will_be_set_as_footer_logo', 'قم بتعيين تمكين لإظهار شعار التذييل (سيتم تعيين شعار الرأس كشعار تذييل).', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6429, 'sa', 'footer_logo_anchor_url', 'عنوان URL لإرساء شعار التذييل', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6430, 'sa', 'set_footer_logo_anchor_urldefault_is_home_url', 'تعيين عنوان URL لربط شعار التذييل (الافتراضي هو عنوان URL الرئيسي)', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6431, 'sa', 'footer_logo_alignment', 'محاذاة شعار التذييل', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6432, 'sa', 'set_enable_to_show_footer_logo_alignment', 'قم بتعيين تمكين لإظهار محاذاة شعار التذييل', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6433, 'sa', 'footer_text_enabledisable', 'نص التذييل تمكين / تعطيل', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6434, 'sa', 'set_enable_to_show_footer_copyright_text', 'قم بتعيين تمكين لإظهار نص حقوق النشر في التذييل', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6435, 'sa', 'footer_copyright_text_alignment', 'محاذاة نص تذييل حقوق الطبع والنشر', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6436, 'sa', 'set_enable_to_show_footer_text_alignment', 'قم بتعيين تمكين لإظهار محاذاة نص التذييل', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6437, 'sa', 'footer_copyright_text_color', 'لون نص حقوق الطبع والنشر للتذييل', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6438, 'sa', 'set_footer_text_color', 'تعيين لون نص التذييل', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6439, 'sa', 'footer_copyright_anchor_text_color', 'لون نص رابط حقوق النشر التذييل', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6440, 'sa', 'set_footer_anchor_text_color', 'تعيين لون نص التذييل', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6441, 'sa', 'footer_copyright_anchor_text_hover_color', 'تذييل حقوق النشر والتأليف النص تحوم اللون', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6442, 'sa', 'set_footer_anchor_text_hover_color', 'تعيين لون تحوم نص التذييل', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6443, 'sa', 'mailchimp_api_key', 'مفتاح واجهة برمجة تطبيقات Mailchimp', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6444, 'sa', 'set_mailchimp_api_key', 'تعيين مفتاح واجهة برمجة تطبيقات mailchimp', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6445, 'sa', 'mailchimp_list_id', 'معرف قائمة Mailchimp', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6446, 'sa', 'set_mailchimp_list_id', 'تعيين معرف قائمة mailchimp.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6447, 'sa', 'footer_subscribe_form', 'نموذج الاشتراك في التذييل', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6448, 'sa', 'set_enable_to_display_subscribe_form_in_footer', 'قم بتعيين تمكين لعرض نموذج الاشتراك في التذييل.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6449, 'sa', 'form_title', 'عنوان النموذج', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6450, 'sa', 'form_placeholder', 'عنصر نائب للنموذج', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6451, 'sa', 'form_button_text', 'نص زر النموذج', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6452, 'sa', 'privacy_policy', 'سياسة الخصوصية', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6453, 'sa', 'set_enable_to_display_privacy_policy_button', 'قم بتعيين تمكين لعرض زر نهج الخصوصية.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6454, 'sa', 'privacy_policy_page', 'صفحة سياسة الخصوصية', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6455, 'sa', 'select_privacy_policy_page', 'حدد صفحة نهج الخصوصية.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6456, 'sa', 'custom_footer_subscribe_style', 'نمط اشتراك التذييل المخصص', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6457, 'sa', 'set_custom_footer_subscribe_style', 'تعيين نمط الاشتراك تذييل مخصص', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6458, 'sa', 'form_privacy_text_color', 'لون نص خصوصية النموذج', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6459, 'sa', 'if_privacy_policy_switch_is_enabled', 'إذا تم تمكين تبديل نهج الخصوصية', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6460, 'sa', 'form_privacy_text_anchor_color', 'لون رابط النص خصوصية النموذج', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6461, 'sa', 'form_background_color', 'لون خلفية النموذج', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6462, 'sa', 'form_title_color', 'لون عنوان النموذج', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6463, 'sa', 'form_input_background_color', 'لون خلفية إدخال النموذج', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6464, 'sa', 'form_submit_button_color', 'نموذج إرسال لون الزر', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6465, 'sa', 'form_submit_button_background_color', 'نموذج إرسال لون خلفية الزر', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6466, 'sa', 'switch_enabled_to_display_preloader', 'تم تمكين التبديل لعرض أداة التحميل المسبق.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6467, 'sa', 'preloader_style_type', 'نوع نمط المحمل المسبق', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6468, 'sa', 'control_preloader_style_type_if_you_use_this_option_then_you_will_able_to_set_lot_of_preloader_style', 'إذا كنت تستخدم هذا الخيار ، فستتمكن من تعيين الكثير من أسلوب التحميل المسبق', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6469, 'sa', 'custom_preloader_type', 'نوع المحمل المسبق المخصص', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6470, 'sa', 'image_type__text_type', 'نوع الصورة - نوع النص', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6471, 'sa', 'set_custom_preloader_type', 'قم بتعيين نوع المحمل المسبق المخصص.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6472, 'sa', 'preloader_image', 'صورة التحميل المسبق', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6473, 'sa', 'set_preloader_image', 'قم بتعيين صورة أداة التحميل المسبق.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6474, 'sa', 'preloader_heading_tag', 'علامة عنوان أداة التحميل المسبق', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6475, 'sa', 'set_preloader_heading_tag', 'تعيين علامة عنوان أداة التحميل المسبق.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6476, 'sa', 'preloader_text', 'نص التحميل المسبق', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6477, 'sa', 'set_preloader_text', 'تعيين نص التحميل المسبق.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6478, 'sa', 'preloader_item_color', 'لون عنصر التحميل المسبق', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6479, 'sa', 'set_preloader_item_color', 'تعيين لون عنصر التحميل المسبق.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6480, 'sa', 'preloader_background_color', 'لون خلفية أداة التحميل المسبق', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6481, 'sa', 'set_preloader_background_color', 'قم بتعيين لون خلفية أداة التحميل المسبق.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6482, 'sa', 'theme_option_saved', 'تم حفظ خيار الموضوع', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6483, 'sa', 'custom_blog_style', 'نمط مدونة مخصص', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6484, 'sa', 'set_custom_blog_style', 'تعيين نمط مدونة مخصص.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6485, 'sa', 'layout', 'تَخطِيط', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6486, 'sa', 'choose_blog_layout_from_here_if_you_use_this_option_then_you_will_able_to_change_three_type_of_blog_layout__default_right_sidebar_layout_', 'إذا كنت تستخدم هذا الخيار ، فستتمكن من تغيير ثلاثة أنواع من تخطيط المدونة (تخطيط الشريط الجانبي الأيمن الافتراضي).', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6487, 'sa', 'blog_column', 'عمود المدونة', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6488, 'sa', 'select_your_blog_post_column_from_here_if_you_use_this_option_then_you_will_able_to_select_three_type_of_blog_colum_layout__default_one_column_', 'إذا كنت تستخدم هذا الخيار ، فستتمكن من تحديد ثلاثة أنواع من تخطيط عمود المدونة (افتراضي عمود واحد).', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6489, 'sa', 'select_blog_post_style', 'حدد نمط منشور المدونة.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6490, 'sa', 'blog_page_title', 'عنوان صفحة المدونة', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6491, 'sa', 'control_blog_page_title_show__hide_if_you_use_this_option_then_you_will_able_to_show__hide_your_blog_page_title__default_setting_show_', 'إذا كنت تستخدم هذا الخيار ، فستتمكن من إظهار / إخفاء عنوان صفحة المدونة الخاصة بك (عرض الإعداد الافتراضي).', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6492, 'sa', 'blog_page_title_setting', 'إعداد عنوان صفحة المدونة', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6493, 'sa', 'control_blog_page_title_setting_if_you_use_this_option_then_you_can_able_to_show_default_or_custom_blog_page_title__default_blog_', 'إذا كنت تستخدم هذا الخيار ، فيمكنك إظهار عنوان صفحة المدونة الافتراضية أو المخصصة (المدونة الافتراضية).', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6494, 'sa', 'blog_custom_title', 'عنوان مخصص للمدونة', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6495, 'sa', 'set_blog_page_custom_title_form_here_if_you_use_this_option_then_you_will_able_to_set_your_won_title_text', 'إذا كنت تستخدم هذا الخيار ، فستتمكن من تعيين نص العنوان الفائز.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6496, 'sa', 'blog_posts_excerpt', 'مقتطفات من مشاركات المدونة', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6497, 'sa', 'control_the_number_of_characters_you_want_to_show_in_the_blog_page_for_each_post_if_you_use_this_option_then_you_can_able_to_control_your_blog_post_characters_from_heredefault_50_character', 'تحكم في عدد الأحرف التي تريد إظهارها في صفحة المدونة لكل منشور .. إذا كنت تستخدم هذا الخيار ، فيمكنك التحكم في أحرف منشور المدونة الخاصة بك من هنا. (افتراضيًا 50 حرفًا)', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6498, 'sa', 'blog_perpage_number', 'رقم المدونة لكل صفحة', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6499, 'sa', 'control_the_number_blogs_to_show_on_each_page__default_show_10_', 'التحكم في عدد المدونات التي سيتم عرضها في كل صفحة (العرض الافتراضي 10).', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6500, 'sa', 'read_more_text_setting', 'قراءة المزيد Text Setting', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6501, 'sa', 'control_read_more_text_from_here', 'تحكم بقراءة المزيد من النص من هنا.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6502, 'sa', 'read_more_text', 'قراءة المزيد Text', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6503, 'sa', 'set_read_moer_text_here_if_you_use_this_option_then_you_will_able_to_set_your_won_text', 'إذا كنت تستخدم هذا الخيار ، فستتمكن من تعيين نصك الفائز.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6504, 'sa', 'blog_pagination_settings', 'إعدادات ترقيم صفحات المدونة', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6505, 'sa', 'set_blog_pagination_number_pagination_or_link_pagination', 'ترقيم الصفحات أو ارتباط ترقيم الصفحات', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6506, 'sa', 'blog_pagination_position', 'موقف ترقيم صفحات المدونة', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6507, 'sa', 'set_blog_pagination_position', 'تعيين موضع ترقيم صفحات المدونة.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6508, 'sa', 'blog_pagination_active_color', 'مدونة ترقيم الصفحات النشطة اللون', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6509, 'sa', 'set_blog_pagination_active_color', 'قم بتعيين لون نشط لصفحات صفحات المدونة.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6510, 'sa', 'blog_pagination_active_background_color', 'مدونة ترقيم الصفحات النشطة لون الخلفية', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6511, 'sa', 'set_blog_pagination_active_background_color', 'تعيين لون الخلفية النشط لصفحات الصفحات في المدونة.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6512, 'sa', 'blog_pagination_color', 'مدونة ترقيم الصفحات اللون', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6513, 'sa', 'set_blog_pagination_color', 'تعيين لون ترقيم صفحات المدونة.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6514, 'sa', 'blog_pagination_background_color', 'لون خلفية ترقيم الصفحات في المدونة', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6515, 'sa', 'set_blog_pagination_background_color', 'تعيين لون خلفية ترقيم الصفحات في المدونة.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6516, 'sa', 'blog_pagination_hover_color', 'مدونة ترقيم الصفحات اللون', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6517, 'sa', 'set_blog_pagination_hover_color', 'قم بتعيين لون التمرير فوق صفحات المدونة.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6518, 'sa', 'blog_pagination_hover_background_color', 'لون خلفية ترقيم الصفحات في المدونة', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6519, 'sa', 'set_blog_pagination_hover_background_color', 'تعيين لون خلفية تمرير ترقيم الصفحات في المدونة.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6520, 'sa', 'custom_single_blog_page', 'صفحة مدونة فردية مخصصة', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6521, 'sa', 'set_custom_single_blog_style', 'تعيين نمط مدونة واحد مخصص.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6522, 'sa', 'choose_blog_single_page_layout_from_here_if_you_use_this_option_then_you_will_able_to_change_three_type_of_blog_single_page_layout__default_right_sidebar_layout_', 'إذا كنت تستخدم هذا الخيار ، فستتمكن من تغيير ثلاثة أنواع من تخطيط الصفحة الواحدة للمدونة (تخطيط الشريط الجانبي الأيمن الافتراضي).', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6523, 'sa', 'blog_post_title_position', 'وظيفة عنوان وظيفة المدونة', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6524, 'sa', 'control_blog_post_title_position_from_here', 'التحكم في موضع عنوان منشور المدونة من هنا.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6525, 'sa', 'blog_details_custom_title', 'تفاصيل المدونة عنوان مخصص', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6526, 'sa', 'this_title_will_show_in_breadcrumb_title', 'سيظهر هذا العنوان في عنوان مسار التنقل.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6527, 'sa', 'author', 'مؤلف', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6528, 'sa', 'switch_on_to_display_author', 'قم بالتبديل إلى Display Author.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6529, 'sa', 'date', 'تاريخ', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6530, 'sa', 'switch_on_to_display_date', 'قم بالتبديل إلى تاريخ العرض.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6531, 'sa', 'reading_time', 'وقت القراءة', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6532, 'sa', 'switch_on_to_display_reading_time', 'قم بالتبديل إلى عرض وقت القراءة.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6533, 'sa', 'category', 'فئة', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6534, 'sa', 'switch_on_to_display_category', 'قم بالتبديل إلى عرض الفئة.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6535, 'sa', 'switch_on_to_display_tags', 'قم بالتبديل إلى عرض العلامات.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6536, 'sa', 'switch_on_to_display_comments', 'قم بالتبديل إلى عرض التعليقات.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6537, 'sa', 'biography_info', 'معلومات السيرة الذاتية', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6538, 'sa', 'control_biography_info_from_here_if_you_use_this_option_then_you_will_able_to_show_ro_hide_biography_info', 'إذا كنت تستخدم هذا الخيار ، فستتمكن من إظهار معلومات إخفاء السيرة الذاتية', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6539, 'sa', 'custom_sidebar_style', 'نمط الشريط الجانبي المخصص', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6540, 'sa', 'switch_on_for_custom_sidebar_style', 'قم بالتبديل إلى نمط الشريط الجانبي المخصص.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6541, 'sa', 'widgets_background_color', 'الحاجيات لون الخلفية', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6542, 'sa', 'box_shadow', 'مربع الظل', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6543, 'sa', 'offset_x', 'تعويض X', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6544, 'sa', 'offset_y', 'تعويض Y', '2023-05-13 06:26:25', '2023-05-13 06:26:25');
INSERT INTO `tl_translations` (`id`, `lang`, `lang_key`, `lang_value`, `created_at`, `updated_at`) VALUES
(6545, 'sa', 'blur_radius', 'نصف القطر الضبابي', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6546, 'sa', 'spread_radius', 'انتشار الشعاع', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6547, 'sa', 'opcacity_11', 'العتامة .1-1', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6548, 'sa', 'units', 'الوحدات', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6549, 'sa', 'shadow_color', 'لون الظل', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6550, 'sa', 'shadow_type', 'نوع الظل', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6551, 'sa', 'widget_margin', 'هامش القطعة', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6552, 'sa', 'widget_padding', 'القطعة الحشو', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6553, 'sa', 'widget_border', 'القطعة الحدود', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6554, 'sa', 'widget_title_tag', 'القطعة عنوان العلامة', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6555, 'sa', 'widget_title_typography', 'القطعة عنوان الطباعة', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6556, 'sa', 'font_family', 'خط العائلة', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6557, 'sa', 'select__fonts', 'حدد الخطوط', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6558, 'sa', 'custom_font_1', 'الخط المخصص 1', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6559, 'sa', 'custom_font_2', 'الخط المخصص 2', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6560, 'sa', 'google_web_fonts', 'خطوط الويب من Google', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6561, 'sa', 'font_weight__style', 'وزن الخط ونمطه', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6562, 'sa', 'font_subsets', 'مجموعات الخطوط الفرعية', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6563, 'sa', 'text_align', 'محاذاة النص', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6564, 'sa', 'text_transform', 'تحويل النص', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6565, 'sa', 'font_size', 'حجم الخط', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6566, 'sa', 'size', 'مقاس', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6567, 'sa', 'line_height', 'ارتفاع خط', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6568, 'sa', 'height', 'ارتفاع', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6569, 'sa', 'word_spacing', 'تباعد الكلمات', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6570, 'sa', 'letter_spacing', 'تباعد الأحرف', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6571, 'sa', 'the_quick_brown_fox_jumps_over_the_lazy_dog', 'الثعلب البني السريع يقفز فوق الكلب الكسول', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6572, 'sa', 'widget_title_margin', 'هامش عنوان القطعة', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6573, 'sa', 'widget_title_padding', 'القطعة عنوان الحشو', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6574, 'sa', 'widget_title_color', 'القطعة عنوان اللون', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6575, 'sa', 'set_widget_title_color', 'تعيين لون عنوان القطعة.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6576, 'sa', 'widget_text_color', 'لون نص القطعة', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6577, 'sa', 'set_widget_text_color', 'تعيين لون نص القطعة.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6578, 'sa', 'widget_anchor_color', 'القطعة مرساة اللون', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6579, 'sa', 'set_widget_anchor_color', 'تعيين لون مرساة القطعة.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6580, 'sa', 'widget_anchor_hover_color', 'القطعة مرساة تحوم اللون', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6581, 'sa', 'set_widget_anchor_hover_color', 'تعيين لون القطعة مرساة تحوم.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6582, 'sa', 'custom_page_style', 'نمط الصفحة المخصص', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6583, 'sa', 'set_custom_page_style', 'تعيين نمط الصفحة المخصص.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6584, 'sa', 'choose_your_page_layout_if_you_use_this_option_then_you_will_able_to_choose_three_type_of_page_layout__default_no_sidebar_', 'إذا كنت تستخدم هذا الخيار ، فستتمكن من اختيار ثلاثة أنواع من تخطيط الصفحة (افتراضي بدون شريط جانبي).', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6585, 'sa', 'sidebar_settings', 'إعدادات الشريط الجانبي', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6586, 'sa', 'set_page_sidebar_if_you_use_this_option_then_you_will_able_to_set_three_type_of_sidebar__default_no_sidebar_', 'إذا كنت تستخدم هذا الخيار ، فستتمكن من تعيين ثلاثة أنواع من الشريط الجانبي (افتراضي بدون شريط جانبي).', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6587, 'sa', 'page_sidebar', 'الصفحة الشريط الجانبي', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6588, 'sa', 'blog_sidebar', 'مدونة الشريط الجانبي', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6589, 'sa', 'switch_enabled_to_display_page_title_fot_this_option_you_will_able_to_show__hide_page_title_default_setting_enabled', 'تم تمكين الإعداد الافتراضي', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6590, 'sa', 'title_tag', 'علامة العنوان', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6591, 'sa', 'select_page_title_tag_if_you_use_this_option_then_you_can_able_to_change_title_tag_h1__h6__default_tag_h1_', 'إذا كنت تستخدم هذا الخيار ، فيمكنك تغيير علامة العنوان H1 - H6 (العلامة الافتراضية H1)', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6592, 'sa', 'font_settings', 'إعدادات الخط', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6593, 'sa', 'select_font_setting_for_page_title_if_you_use_this_options_then_you_will_able_to_change_font_weight_text_align_text_transform_font_size_line_height_word_spacing_letter_spacing', 'إذا كنت تستخدم هذه الخيارات ، فستتمكن من تغيير وزن الخط ، ومحاذاة النص ، وتحويل النص ، وحجم الخط ، وارتفاع الخط ، وتباعد الكلمات ، وتباعد الأحرف.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6594, 'sa', 'setting_page_header_background_if_you_use_this_option_then_you_will_able_to_set_background_color_background_image_background_repeat_background_size_background_attachment_background_position', 'إذا كنت تستخدم هذا الخيار ، فستتمكن من تعيين لون الخلفية ، وصورة الخلفية ، وتكرار الخلفية ، وحجم الخلفية ، ومرفق الخلفية ، وموضع الخلفية.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6595, 'sa', 'select_background_repeat', 'حدد تكرار الخلفية', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6596, 'sa', 'select_background_size', 'حدد حجم الخلفية', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6597, 'sa', 'background_attachment', 'مرفق الخلفية', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6598, 'sa', 'select_background_attachment', 'حدد مرفق الخلفية', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6599, 'sa', 'select_background_position', 'حدد موضع الخلفية', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6600, 'sa', 'overlay', 'تراكب', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6601, 'sa', 'check_this_check_box_to_use_overlay_if_you_use_this_option_then_you_will_able_to_use_background_overlay', 'إذا كنت تستخدم هذا الخيار ، فستتمكن من استخدام تراكب الخلفية.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6602, 'sa', 'overlay_background', 'تراكب الخلفية', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6603, 'sa', 'choose_overlay_background_color_if_you_user_this_option_then_you_will_able_to_choose_overlay_background_color', 'إذا كنت تستخدم هذا الخيار ، فستتمكن من اختيار لون الخلفية المتراكب.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6604, 'sa', 'opacity', 'التعتيم', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6605, 'sa', 'setting_overlay_opacity_if_you_use_this_option_then_you_will_able_to_show_light_to_dark_overlay_background_color__default_opacity_05_', 'إذا كنت تستخدم هذا الخيار ، فستتمكن من إظهار لون الخلفية المتراكب الفاتح إلى الغامق (التعتيم الافتراضي 0.5).', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6606, 'sa', 'breadcrumb_hideshow', 'شريط التنقل إخفاء / إظهار', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6607, 'sa', 'hide__show_breadcrumb_from_all_pages_and_posts__default_settings_show_', 'إخفاء / إظهار مسار التنقل من جميع الصفحات والمشاركات (تظهر الإعدادات الافتراضية).', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6608, 'sa', 'breadcrumb_color', 'لون مسار التنقل', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6609, 'sa', 'choose_page_header_breadcrumb_text_color_hereif_you_user_this_option_then_you_will_able_to_set_page_breadcrumb_color', 'اختر لون نص مسار تنقل رأس الصفحة هنا ، إذا كنت تستخدم هذا الخيار ، فستتمكن من تعيين لون مسار تنقل الصفحة.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6610, 'sa', 'breadcrumb_active_color', 'لون مسار التنقل النشط', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6611, 'sa', 'choose_page_header_breadcrumb_text_active_color_hereif_you_user_this_option_then_you_will_able_to_set_page_breadcrumb_active_color', 'اختر اللون النشط لمسار تنقل رأس الصفحة هنا ، إذا كنت تستخدم هذا الخيار ، فستتمكن من تعيين اللون النشط لمسار تنقل الصفحة.', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6612, 'sa', 'breadcrumb_divider_color', 'لون مقسم مسار التنقل', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6613, 'sa', 'choose_breadcrumb_divider_color_if_you_use_this_option_then_you_will_able_to_use_breadcrumb_color__default_color__', 'إذا كنت تستخدم هذا الخيار ، فستتمكن من استخدام لون مسار التنقل (اللون الافتراضي)', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6614, 'sa', 'custom_404_style', 'نمط 404 مخصص', '2023-05-13 06:26:25', '2023-05-13 06:26:25'),
(6615, 'sa', 'set_custom_404', 'تعيين مخصص 404', '2023-05-13 06:27:25', '2023-05-13 06:28:15'),
(6616, 'sa', 'page_title', 'عنوان الصفحة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6617, 'sa', 'set_page_title', 'تعيين عنوان الصفحة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6618, 'sa', 'page_subtitle', 'العنوان الفرعي للصفحة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6619, 'sa', 'set_page_subtitle', 'تعيين العنوان الفرعي للصفحة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6620, 'sa', 'button_before_text', 'الزر قبل النص', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6621, 'sa', 'button_text', 'زر كتابة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6622, 'sa', 'page_background_with_image_color_etc', 'خلفية الصفحة مع الصورة واللون وما إلى ذلك.', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6623, 'sa', 'background_overlay', 'تراكب الخلفية', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6624, 'sa', 'set_background_ovelay', 'تعيين بيضوي الخلفية.', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6625, 'sa', 'overlay_color', 'لون التراكب', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6626, 'sa', 'set_overlay_color', 'تعيين لون التراكب.', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6627, 'sa', 'overlay_opacity', 'تراكب التعتيم', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6628, 'sa', 'set_overlay_opacity', 'تعيين التراكب التعتيم.', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6629, 'sa', 'pick_a_title_color', 'اختر لون العنوان', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6630, 'sa', 'subtitle_color', 'لون الترجمة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6631, 'sa', 'pick_a_subtitle_color', 'اختر لون الترجمة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6632, 'sa', 'before_button_text_color', 'قبل لون نص الزر', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6633, 'sa', 'pick_before_button_text_color', 'اختر قبل لون نص الزر', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6634, 'sa', 'before_button_color', 'قبل لون الزر', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6635, 'sa', 'pick_before_button_color', 'اختر قبل لون الزر', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6636, 'sa', 'before_button_hover_color', 'قبل لون الزر تحوم', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6637, 'sa', 'pick_before_button_hover_color', 'اختر قبل لون تمرير الزر', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6638, 'sa', 'social_profile_links', 'روابط الملف الشخصي الاجتماعية', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6639, 'sa', 'add_social_icon_and_url', 'أضف أيقونة اجتماعية و url.', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6640, 'sa', 'add_slide', 'أضف شريحة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6641, 'sa', 'css_code', 'كود CSS', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6642, 'sa', 'paste_your_css_code_here', 'الصق كود CSS الخاص بك هنا.', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6643, 'sa', 'you_can_not_change_status_of_this_language', 'لا يمكنك تغيير حالة هذه اللغة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6644, 'sa', 'language_status_updated_successfully', 'تم تحديث حالة اللغة بنجاح', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6645, 'sa', 'login', 'تسجيل الدخول', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6646, 'sa', 'login_to', 'تسجيل الدخول إلى', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6647, 'sa', 'email', 'بريد إلكتروني', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6648, 'sa', 'email_address', 'عنوان البريد الإلكتروني', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6649, 'sa', 'password', 'كلمة المرور', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6650, 'sa', 'forgot_password', 'هل نسيت كلمة السر؟', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6651, 'sa', 'log_in', 'تسجيل الدخول', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6652, 'sa', 'email_is_required', 'البريد الالكتروني مطلوب', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6653, 'sa', 'invalid_email_address', 'عنوان البريد الإلكتروني غير صالح', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6654, 'sa', 'password_is_required', 'كلمة المرور مطلوبة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6655, 'sa', 'login_successful', 'تم تسجيل الدخول بنجاح', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6656, 'sa', 'total_blogs', 'إجمالي المدونات', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6657, 'sa', 'total_pages', 'إجمالي الصفحات', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6658, 'sa', 'total_category', 'الفئة الإجمالية', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6659, 'sa', 'total_comments', 'إجمالي التعليقات', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6660, 'sa', 'visitors_reports', 'تقارير الزوار', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6661, 'sa', 'monthly', 'شهريا', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6662, 'sa', 'daily', 'يوميًا', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6663, 'sa', 'blog_status', 'حالة المدونة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6664, 'sa', 'published', 'نشرت', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6665, 'sa', 'scheduled', 'المقرر', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6666, 'sa', 'drafts', 'المسودات', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6667, 'sa', 'pending', 'قيد الانتظار', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6668, 'sa', 'featured', 'متميز', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6669, 'sa', 'recent_comments', 'احدث التعليقات', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6670, 'sa', 'comment', 'تعليق', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6671, 'sa', 'submitted_on', 'تم إرساله', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6672, 'sa', 'in_reply_to', 'ردا على', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6673, 'sa', 'popular_categories', 'الفئات الشعبية', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6674, 'sa', 'latest_pages', 'أحدث الصفحات', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6675, 'sa', 'manage_widgets', 'إدارة الحاجيات', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6676, 'sa', 'available_widgets', 'الحاجيات المتاحة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6677, 'sa', 'add_widget', 'إضافة القطعة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6678, 'sa', 'adding_widget_to_sidebar_failed', 'فشلت إضافة القطعة إلى الشريط الجانبي', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6679, 'sa', 'sidebar_widget_opening_failed', 'فشل فتح أداة الشريط الجانبي', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6680, 'sa', 'widget_added_to_sidebar_failed', 'فشل إضافة عنصر واجهة المستخدم إلى الشريط الجانبي', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6681, 'sa', 'widget_form_submit_failed_failed', 'فشل إرسال نموذج عنصر واجهة المستخدم', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6682, 'sa', 'select_a_user_for_authur_widget', 'حدد مستخدمًا لـ Authur Widget', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6683, 'sa', 'done', 'منتهي', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6684, 'sa', 'widget_title', 'عنوان الأداة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6685, 'sa', 'number_of_featured_blog', 'عدد المدونات المميزة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6686, 'sa', 'widget_form_saved', 'تم حفظ نموذج القطعة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6687, 'sa', 'title_placeholder', 'العنوان النائب', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6688, 'sa', 'add_information', 'اضف معلومات', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6689, 'sa', 'newsletter_short_desc', 'نشرة إخبارية وصف مختصر', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6690, 'sa', 'number_of_recent_blog', 'رقم المدونة الأخيرة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6691, 'sa', 'per_slide_number', 'رقم لكل شريحة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6692, 'sa', 'total_blog_number', 'إجمالي عدد المدونة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6693, 'sa', 'number_of_tags', 'عدد العلامات', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6694, 'sa', 'number_of_tag', 'رقم العلامة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6695, 'sa', 'site_title', 'عنوان الموقع', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6696, 'sa', 'site_motto', 'شعار الموقع', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6697, 'sa', 'site_moto', 'موقع موتو', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6698, 'sa', 'logo', 'شعار', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6699, 'sa', 'choose_image', 'اختر صورة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6700, 'sa', 'logo_mobile', 'شعار (جوال)', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6701, 'sa', 'dark_logo', 'شعار غامق', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6702, 'sa', 'dark_logo_mobile', 'شعار غامق (جوال)', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6703, 'sa', 'sticky_logo', 'شعار مثبت', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6704, 'sa', 'sticky_logo_mobile', 'شعار لاصق (جوال)', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6705, 'sa', 'dark_sticky_logo', 'شعار لاصق غامق', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6706, 'sa', 'dark_sticky_logo_mobile', 'شعار لاصق غامق (للجوال)', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6707, 'sa', 'admin_logo', 'شعار المسؤول', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6708, 'sa', 'admin_logo_mobile', 'شعار المسؤول (الجوال)', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6709, 'sa', 'admin_dark_logo', 'شعار المشرف الداكن', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6710, 'sa', 'admin_dark_logo_mobile', 'شعار المشرف الداكن (الجوال)', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6711, 'sa', 'favicon', 'فافيكون', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6712, 'sa', 'default_language', 'اللغة الافتراضية', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6713, 'sa', 'select_default_language', 'حدد اللغة الافتراضية', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6714, 'sa', 'select_default_timezone', 'حدد المنطقة الزمنية الافتراضية', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6715, 'sa', 'copyright_text', 'نص حقوق النشر', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6716, 'sa', 'submit', 'يُقدِّم', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6717, 'sa', 'site_seo__settings', 'إعدادات سيو الموقع', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6718, 'sa', 'meta_title', 'عنوان الفوقية', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6719, 'sa', 'meta_description', 'ميتا الوصف', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6720, 'sa', 'meta_keywords', 'كلمات دلالية', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6721, 'sa', 'meta_image', 'صورة ميتا', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6722, 'sa', 'email_placeholder', 'العنصر النائب للبريد الإلكتروني', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6723, 'sa', 'edit_language', 'تحرير اللغة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6724, 'sa', 'update_language_information', 'تحديث معلومات اللغة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6725, 'sa', 'type_name', 'أكتب اسم', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6726, 'sa', 'type__native_name', 'اكتب الاسم الأصلي', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6727, 'sa', 'update', 'تحديث', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6728, 'sa', 'name_is_required', 'مطلوب اسم', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6729, 'sa', 'code_is_required', 'الرمز مطلوب', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6730, 'sa', 'language_updated_successfully', 'تم تحديث اللغة بنجاح', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6731, 'sa', 'add_page', 'إضافة صفحة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6732, 'sa', 'all', 'الجميع', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6733, 'sa', 'mine', 'مِلكِي', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6734, 'sa', 'trash', 'نفاية', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6735, 'sa', 'parent', 'الأبوين', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6736, 'sa', 'showing', 'عرض', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6737, 'sa', 'items_of', 'من العناصر', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6738, 'sa', 'bulk_action', 'العمل الجماعي', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6739, 'sa', 'delete_selection', 'حذف التحديد', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6740, 'sa', 'apply', 'يتقدم', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6741, 'sa', 'no_action_selected', 'لم يتم تحديد أي إجراء', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6742, 'sa', 'no_item_selected', 'لم يتم تحديد أي عنصر', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6743, 'sa', 'edit_page', 'تعديل الصفحة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6744, 'sa', 'add_new', 'اضف جديد', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6745, 'sa', 'permalink', 'الرابط الثابت', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6746, 'sa', 'type_here', 'أكتب هنا', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6747, 'sa', 'seo_meta_tags', 'العلامات الوصفية سيو', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6748, 'sa', 'publish', 'ينشر', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6749, 'sa', 'draft', 'مسودة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6750, 'sa', 'preview', 'معاينة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6751, 'sa', 'visibility', 'الرؤية', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6752, 'sa', 'public', 'عام', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6753, 'sa', 'password_protected', 'محمية بكلمة مرور', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6754, 'sa', 'if_password_field_is_remain_empty_then_visibility_will_be_saved_as_public', 'إذا ظل حقل كلمة المرور فارغًا ، فسيتم حفظ الرؤية على أنها عامة.', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6755, 'sa', 'private', 'خاص', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6756, 'sa', 'page_attributes', 'سمات الصفحة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6757, 'sa', 'parents', 'آباء', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6758, 'sa', 'select_a_parent_page', 'حدد الصفحة الرئيسية', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6759, 'sa', 'featured_image', 'صورة مميزة', '2023-05-13 06:27:25', '2023-05-13 06:27:25'),
(6760, 'sa', 'please_insert_page_title', 'الرجاء إدخال عنوان الصفحة', '2023-05-13 06:27:26', '2023-05-13 06:28:16'),
(6761, 'sa', 'this_title_is_already_available_please_insert_another', 'هذا العنوان متاح بالفعل الرجاء إدخال عنوان آخر', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6762, 'sa', 'please_write_the_page_title_under_225_words', 'يرجى كتابة عنوان الصفحة تحت 225 كلمة', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6763, 'sa', 'this_permalink_is_already_available_please_insert_another', 'هذا الرابط الثابت متاح بالفعل الرجاء إدخال آخر', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6764, 'sa', 'please_insert_a_valid_image', 'الرجاء إدخال صورة صالحة', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6765, 'sa', 'please_write_some_content', 'الرجاء كتابة بعض المحتوى', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6766, 'sa', 'please_select_a_valid_image', 'الرجاء تحديد صورة صالحة', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6767, 'sa', 'something_went_wrong_please_select_visibility_again', 'حدث خطأ ما ، يرجى تحديد الرؤية مرة أخرى', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6768, 'sa', 'something_went_wrong_please_select_parent_again', 'حدث خطأ ما ، يرجى تحديد الأصل مرة أخرى', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6769, 'sa', 'page_updated_successfully', 'تم تحديث الصفحة بنجاح', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6770, 'sa', 'transalate_to_another_language', 'التحويل إلى لغة أخرى', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6771, 'sa', 'header_background_color', 'لون خلفية الرأس', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6772, 'sa', 'set_header_background_color', 'تعيين لون خلفية الرأس.', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6773, 'sa', 'sticky_header_background_color', 'لون خلفية الرأس اللاصق', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6774, 'sa', 'set_sticky_header_background_color', 'تعيين لون خلفية الرأس اللاصق.', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6775, 'sa', 'header_search_icon', 'أيقونة البحث في العنوان', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6776, 'sa', 'set_enable_to_display_search_icon', 'قم بتعيين تمكين لعرض رمز البحث.', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6777, 'sa', 'header_search_icon_color', 'لون رمز البحث في العنوان', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6778, 'sa', 'set_search_icon_color', 'تعيين لون رمز البحث.', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6779, 'sa', 'sticky_header_search_icon_color', 'لون رمز بحث رأس مثبت', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6780, 'sa', 'set_sticky_header_search_icon_color', 'تعيين لون رمز بحث رأس مثبت.', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6781, 'sa', 'custom_header_style', 'نمط رأس مخصص', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6782, 'sa', 'custom_set_header_logo_style', 'نمط شعار رأس مجموعة مخصصة.', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6783, 'sa', 'logo_dimensions_widthheight', 'أبعاد الشعار (العرض / الارتفاع).', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6784, 'sa', 'set_logo_dimensions_to_choose_width_height_and_unit', 'اضبط أبعاد الشعار لاختيار العرض والارتفاع والوحدة.', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6785, 'sa', 'width', 'عرض', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6786, 'sa', 'logo_top_and_bottom_margin', 'الهامش العلوي والسفلي للشعار.', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6787, 'sa', 'set_logo_top_and_bottom_margin', 'تعيين الهامش العلوي والسفلي للشعار.', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6788, 'sa', 'sticky_logo_dimensions_widthheight', 'أبعاد الشعار اللاصقة (العرض / الارتفاع).', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6789, 'sa', 'set_sticky_logo_dimensions_to_choose_width_height_and_unit', 'عيّن أبعاد الشعار اللاصقة لاختيار العرض والارتفاع والوحدة.', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6790, 'sa', 'sticky_logo_top_and_bottom_margin', 'شعار اللصق العلوي والهامش السفلي.', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6791, 'sa', 'set_sticky_logo_top_and_bottom_margin', 'ضع شعار Sticky على الهامش العلوي والسفلي.', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6792, 'sa', 'home_page', 'الصفحة الرئيسية', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6793, 'sa', 'choose_home_page_layout_from_here_if_you_use_this_option_then_you_will_able_to_change_three_type_of_layout__default_right_sidebar_layout_', 'إذا كنت تستخدم هذا الخيار ، فستتمكن من تغيير ثلاثة أنواع من التخطيط (تخطيط الشريط الجانبي الأيمن الافتراضي).', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6794, 'sa', 'custom_menu_style', 'نمط قائمة مخصص', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6795, 'sa', 'custom_set_menu_style', 'نمط قائمة مجموعة مخصصة.', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6796, 'sa', 'menu_color', 'لون القائمة', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6797, 'sa', 'set_header_menu_color', 'تعيين لون قائمة الرأس.', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6798, 'sa', 'menu_hover_color', 'لون تحوم القائمة', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6799, 'sa', 'set_header_menu_hover_color', 'تعيين لون التمرير لقائمة الرأس.', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6800, 'sa', 'menu_active_item_color', 'قائمة لون العنصر النشط', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6801, 'sa', 'set_header_menu_active_item_color', 'تعيين لون العنصر النشط لقائمة الرأس.', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6802, 'sa', 'sub_menu_color', 'لون القائمة الفرعية', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6803, 'sa', 'set_header_sub_menu_color', 'تعيين لون القائمة الفرعية للرأس.', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6804, 'sa', 'sub_menu_hover_color', 'لون تحوم القائمة الفرعية', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6805, 'sa', 'set_header_sub_menu_hover_color', 'تعيين لون تحويم القائمة الفرعية للرأس.', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6806, 'sa', 'sub_menu_active_item_color', 'القائمة الفرعية لون العنصر النشط', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6807, 'sa', 'set_header_sub_menu_active_item_color', 'تعيين لون العنصر النشط القائمة الفرعية للرأس.', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6808, 'sa', 'these_settings_control_the_typography_for_menu', 'تتحكم هذه الإعدادات في طباعة القائمة.', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6809, 'sa', 'submenu_typography', 'طباعة القائمة الفرعية', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6810, 'sa', 'these_settings_control_the_typography_for_submenu', 'تتحكم هذه الإعدادات في طباعة القائمة الفرعية.', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6811, 'sa', 'update_user', 'تحديث المستخدم', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6812, 'sa', 'update_profile', 'تحديث الملف', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6813, 'sa', 'profile_picture', 'الصوره الشخصيه', '2023-05-13 06:27:26', '2023-05-13 06:27:26'),
(6814, 'sa', 'give_your_name', 'ذكر اسمك', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6815, 'sa', 'give_your_email_address', 'أعط عنوان بريدك الإلكتروني', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6816, 'sa', 'biography', 'سيرة شخصية', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6817, 'sa', 'not_more_than_200_characters', 'لا يزيد عن 200 حرف', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6818, 'sa', 'give_you_biography', 'أعطيك السيرة الذاتية', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6819, 'sa', 'old_password', 'كلمة المرور القديمة', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6820, 'sa', 'give_your_password', 'أدخل كلمة المرور الخاصة بك', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6821, 'sa', 'confirm_password', 'تأكيد كلمة المرور', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6822, 'sa', 'confirm_your_password', 'أكد رقمك السري', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6823, 'sa', 'social_info', 'المعلومات الاجتماعية', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6824, 'sa', 'set_the_default_social_from_theme_option_or_make_custom_social', 'عيّن الخيار الاجتماعي الافتراضي من خيار السمة أو أنشئ اجتماعيًا مخصصًا.', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6825, 'sa', 'profile_pic_is_required', 'الملف الشخصي الموافقة المسبقة عن علم مطلوب', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6826, 'sa', 'invalid_selection', 'اختيار غير صحيح', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6827, 'sa', 'profile_updated_successfully', 'تم تحديث الملف الشخصي بنجاح', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6828, 'sa', 'clear_filter', 'مرشح واضح', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6829, 'sa', 'edit_menus', 'تحرير القوائم', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6830, 'sa', 'manage_locations', 'إدارة المواقع', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6831, 'sa', 'select_a_menu_to_edit', 'حدد قائمة لتعديلها:', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6832, 'sa', 'create_menu_', 'إنشاء قائمة', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6833, 'sa', 'translate_menu_into', 'قائمة الترجمة إلى:', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6834, 'sa', 'custom_links', 'روابط مخصصة', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6835, 'sa', 'link_text', 'نص الارتباط', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6836, 'sa', 'add_to_menu', 'أضف إلى القائمة', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6837, 'sa', 'most_recent', 'الأحدث', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6838, 'sa', 'view_all', 'مشاهدة الكل', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6839, 'sa', 'search', 'يبحث', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6840, 'sa', 'select_all', 'اختر الكل', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6841, 'sa', 'select_all_', 'اختر الكل', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6842, 'sa', 'posts', 'دعامات', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6843, 'sa', 'menu_name', 'اسم القائمة', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6844, 'sa', 'give_your_menu_a_name_then_click_save_menu', 'أدخل اسمًا لقائمتك ، ثم انقر فوق حفظ القائمة.', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6845, 'sa', 'menu_settings', 'إعدادات القائمة', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6846, 'sa', 'display_locations', 'عرض المواقع', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6847, 'sa', 'currently_set_to__', 'معين حاليًا على:', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6848, 'sa', 'save_menu', 'حفظ القائمة', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6849, 'sa', 'drag_the_items_into_the_order_you_prefer_click_the_arrow_on_the_right_of_the_item_to_reveal_additional_configuration_options', 'انقر فوق السهم الموجود على يمين العنصر للكشف عن خيارات التكوين الإضافية.', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6850, 'sa', 'delete_menu', 'قائمة الحذف', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6851, 'sa', 'update_menu', 'قائمة التحديث', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6852, 'sa', 'your_theme_supports', 'موضوعك يدعم', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6853, 'sa', 'menus_select_which_menu_appears_in_each_location', 'حدد القائمة التي تظهر في كل موقع.', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6854, 'sa', 'theme_location', 'موقع الموضوع', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6855, 'sa', 'assigned_menu', 'القائمة المعينة', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6856, 'sa', '_edit', 'يحرر', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6857, 'sa', 'use_new_menu', 'استخدم قائمة جديدة', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6858, 'sa', 'menu_list_updated_successfully', 'تم تحديث قائمة القائمة بنجاح', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6859, 'sa', 'blog_category', 'فئة المدونة', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6860, 'sa', 'blog_categories', 'فئات المدونة', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6861, 'sa', 'add_blog_category', 'أضف فئة المدونة', '2023-05-13 06:29:31', '2023-05-13 06:29:31'),
(6862, 'sa', 'edit_blog_category', 'تحرير فئة المدونة', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6863, 'sa', 'select_a_category', 'اختر تصنيف', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6864, 'sa', 'short_description', 'وصف قصير', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6865, 'sa', 'please_insert_a_name', 'الرجاء إدخال اسم', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6866, 'sa', 'this_name_is_already_available_please_insert_another', 'هذا الاسم متوفر بالفعل الرجاء إدخال اسم آخر', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6867, 'sa', 'please_write_the_category_name_under_225_words', 'يرجى كتابة اسم الفئة تحت 225 كلمة', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6868, 'sa', 'blog_category_updated_successfully', 'تم تحديث فئة المدونة بنجاح', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6869, 'sa', 'tag', 'بطاقة شعار', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6870, 'sa', 'add_tag', 'إضافة علامة', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6871, 'sa', 'edit_tag', 'تحرير العلامة', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6872, 'sa', 'please_write_the_tag_name_under_225_words', 'يرجى كتابة اسم العلامة تحت 225 كلمة', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6873, 'sa', 'tag_updated_successfully', 'تم تحديث العلامة بنجاح', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6874, 'sa', 'header_language_select', 'حدد لغة الرأس', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6875, 'sa', 'set_enable_to_display_multilanguage_select_in_header', 'قم بتعيين تمكين لعرض تحديد متعدد اللغات في الرأس.', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6876, 'sa', 'contact', 'اتصال', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6877, 'sa', 'custom_contact_page_style', 'نمط صفحة جهة اتصال مخصص', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6878, 'sa', 'set_custom_contact_page_style', 'تعيين نمط صفحة الاتصال المخصص.', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6879, 'sa', 'back_to_top_button', 'زر العودة الى اعلى', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6880, 'sa', 'switch_on_to_display_back_to_top_button', 'قم بالتبديل إلى زر عرض الرجوع إلى الأعلى.', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6881, 'sa', 'custom_back_to_top_button', 'مخصص زر العودة إلى الأعلى', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6882, 'sa', 'if_you_switch_it_off_it_will_show_default_design_for_back_to_top_button', 'إذا قمت بإيقاف تشغيله ، فسيظهر التصميم الافتراضي لزر \"الرجوع إلى الأعلى\".', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6883, 'sa', 'custom_back_to_top_button_icon', 'مخصص رمز زر الرجوع إلى الأعلى', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6884, 'sa', 'select_back_to_top_button_icon', 'حدد رمز Back To Top Button.', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6885, 'sa', 'back_to_top_button_background_color', 'العودة إلى الأعلى لون خلفية الزر', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6886, 'sa', 'set_back_to_top_button_background_color', 'تعيين لون الخلفية زر الرجوع إلى الأعلى.', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6887, 'sa', 'back_to_top_button_color', 'العودة إلى الأعلى لون الزر', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6888, 'sa', 'set_back_to_top_button_color', 'تعيين لون الزر العودة إلى الأعلى.', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6889, 'sa', 'back_to_top_hover_button_color', 'العودة إلى أعلى لون زر التحويم', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6890, 'sa', 'back_to_top_button_hover_background_color', 'العودة إلى الأعلى لون الخلفية تحوم فوق الزر', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6891, 'sa', 'set_back_to_top_button_hover_background_color', 'تعيين العودة إلى أعلى لون الخلفية تحوم الزر.', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6892, 'sa', 'keep_back_to_top_button_on_mobile', 'حافظ على زر العودة إلى الأعلى على الهاتف المحمول', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6893, 'sa', 'if_you_switch_it_on_it_will_show_in_mobile_devices', 'إذا قمت بتشغيله ، فسيظهر في الأجهزة المحمولة ..', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6894, 'sa', 'custom_mobile_menu_style', 'نمط قائمة المحمول المخصص', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6895, 'sa', 'custom_set_mobile_menu_style', 'مجموعة مخصصة نمط قائمة المحمول.', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6896, 'sa', 'mobile_menu_icon_color', 'لون رمز قائمة الجوال', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6897, 'sa', 'set_mobile_menu_icon_color', 'تعيين لون رمز قائمة الجوال.', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6898, 'sa', 'sticky_header_mobile_menu_icon_color', 'لون رمز قائمة رأس الهاتف المحمول اللاصقة', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6899, 'sa', 'set_sticky_header_mobile_menu_icon_color', 'تعيين لون أيقونة قائمة رأس الهاتف المحمول.', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6900, 'sa', 'mobile_menu_color', 'لون قائمة الجوال', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6901, 'sa', 'set_mobile_menu_color', 'تعيين لون قائمة الجوال.', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6902, 'sa', 'mobile_menu_hover_color', 'لون تحوم قائمة الجوال', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6903, 'sa', 'set_mobile_menu_hover_color', 'تعيين لون تحوم قائمة الجوال.', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6904, 'sa', 'mobile_menu_active_item_color', 'لون العنصر النشط لقائمة الجوال', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6905, 'sa', 'set_mobile_menu_active_item_color', 'تعيين لون العنصر النشط لقائمة الجوال.', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6906, 'sa', 'mobile_sub_menu_color', 'لون القائمة الفرعية للجوال', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6907, 'sa', 'set_mobile_sub_menu_color', 'تعيين لون القائمة الفرعية للجوال.', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6908, 'sa', 'mobile_sub_menu_hover_color', 'لون تحوم القائمة الفرعية للجوال', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6909, 'sa', 'set_mobile_sub_menu_hover_color', 'تعيين لون تحوم القائمة الفرعية للجوال.', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6910, 'sa', 'mobile_sub_menu_active_item_color', 'لون العنصر النشط للقائمة الفرعية للجوال', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6911, 'sa', 'set_mobile_sub_menu_active_item_color', 'تعيين لون العنصر النشط للقائمة الفرعية للجوال.', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6912, 'sa', 'default', 'تقصير', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6913, 'sa', 'custom', 'مخصص', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6914, 'sa', 'hide', 'يخفي', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6915, 'sa', 'show', 'يعرض', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6916, 'sa', 'contact_image', 'صورة جهة الاتصال', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6917, 'sa', 'showhide_contact_page_image', 'إظهار / إخفاء صورة صفحة الاتصال', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6918, 'sa', 'contact_image_settig', 'جهة الاتصال Image Settig', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6919, 'sa', 'set_contact_image_default_or_custom', 'تعيين صورة جهة الاتصال الافتراضية أو المخصصة', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6920, 'sa', 'custom_contact_image', 'صورة جهة اتصال مخصصة', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6921, 'sa', 'set_custom_contact_image', 'تعيين صورة جهة اتصال مخصصة', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6922, 'sa', 'disable', 'إبطال', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6923, 'sa', 'enable', 'يُمكَِن', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6924, 'sa', 'contact_image_setting', 'إعداد صورة جهة الاتصال', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6925, 'sa', 'conatct_title', 'عنوان الاتصال', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6926, 'sa', 'set_title_for_contact_page', 'تعيين عنوان لصفحة الاتصال', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6927, 'sa', 'contact_title', 'عنوان الاتصال', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6928, 'sa', 'conatct_subtitle', 'العنوان الفرعي Conatct', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6929, 'sa', 'set_subtitle_for_contact_page', 'تعيين العنوان الفرعي لصفحة الاتصال', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6930, 'sa', 'contact_name_placeholder', 'جهة الاتصال الاسم النائب', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6931, 'sa', 'set_placeholder_for_contact_form_name', 'تعيين عنصر نائب لاسم نموذج الاتصال', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6932, 'sa', 'contact_email_placeholder', 'جهة اتصال البريد الإلكتروني النائب', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6933, 'sa', 'set_placeholder_for_contact_form_email', 'تعيين عنصر نائب للبريد الإلكتروني لنموذج الاتصال', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6934, 'sa', 'contact_subject_placeholder', 'جهة اتصال الموضوع النائب', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6935, 'sa', 'set_placeholder_for_contact_form_subject', 'تعيين عنصر نائب لموضوع نموذج الاتصال', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6936, 'sa', 'contact_message_placeholder', 'جهة اتصال رسالة نائب', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6937, 'sa', 'contact_email_will_be_sent', 'سيتم إرسال البريد الإلكتروني لجهة الاتصال', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6938, 'sa', 'set_where_will_be_the_contact_email_will_be_sent', 'تعيين أين سيتم إرسال البريد الإلكتروني لجهة الاتصال', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6939, 'sa', 'contact_submit_button_text', 'الاتصال إرسال نص الزر', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6940, 'sa', 'contact_submit_button_textr', 'الاتصال إرسال زر Textr', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6941, 'sa', 'set_placeholder_for_message_form_subject', 'تعيين عنصر نائب لموضوع نموذج الرسالة', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6942, 'sa', 'set_contact_form_buton_text', 'تعيين نموذج الاتصال على النص', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6943, 'sa', 'no', 'لا.', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6944, 'sa', 'template', 'نموذج', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6945, 'sa', 'details', 'تفاصيل', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6946, 'sa', 'enter_email_subject', 'أدخل موضوع البريد الإلكتروني', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6947, 'sa', 'variables', 'المتغيرات', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6948, 'sa', 'smtp_configuration', 'تكوين SMTP', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6949, 'sa', 'email_configuration', 'تكوين البريد الإلكتروني', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6950, 'sa', 'type', 'يكتب', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6951, 'sa', 'smtp', 'بروتوكول SMTP', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6952, 'sa', 'sendmail', 'ارسل بريد', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6953, 'sa', 'mailgun', 'Mailgun', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6954, 'sa', 'mail_host', 'مضيف البريد', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6955, 'sa', 'mail_port', 'منفذ البريد', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6956, 'sa', 'mail_username', 'اسم المستخدم البريد', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6957, 'sa', 'mail_password', 'كلمة المرور البريدية', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6958, 'sa', 'mail_encryption', 'تشفير البريد', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6959, 'sa', 'mail_from_address', 'البريد من العنوان', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6960, 'sa', 'mail_from_name', 'البريد من الاسم', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6961, 'sa', 'mailgun_domain', 'المجال الرئيسي', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6962, 'sa', 'mailgun_secret', 'سر البريد', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6963, 'sa', 'send_test_mail', 'إرسال بريد تجريبي', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6964, 'sa', 'subject', 'موضوع', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6965, 'sa', 'message', 'رسالة', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6966, 'sa', 'send', 'يرسل', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6967, 'sa', 'email_sent_successfully', 'تم إرسال البريد الإلكتروني بنجاح', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6968, 'sa', 'email_sending_failed', 'فشل إرسال البريد الإلكتروني', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6969, 'sa', 'please_fill_in_all_fields_and_ensure_that_the_data_entered_is_valid', '\"يُرجى ملء جميع الحقول والتأكد من صحة البيانات المدخلة.', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6970, 'sa', 'email_sending_failed_please_contact_with_admin', 'يرجى التواصل مع المسؤول', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6971, 'sa', 'email_template_updated_successful', 'تم تحديث قالب البريد الإلكتروني بنجاح', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6972, 'sa', 'select_option', 'حدد خيار', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6973, 'sa', 'featured_blogs', 'مدونات مميزة', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6974, 'sa', 'sub_title_color', 'لون العنوان الفرعي', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6975, 'sa', 'slider_item_color', 'لون العنصر المنزلق', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6976, 'sa', 'login_credentials_does_not_match', 'بيانات اعتماد تسجيل الدخول غير متطابقة', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6977, 'sa', 'page_trashed_successfully', 'تم وضع الصفحة في المهملات بنجاح', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6978, 'sa', 'restore', 'يعيد', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6979, 'sa', 'page_restored_successfully', 'تمت استعادة الصفحة بنجاح', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6980, 'sa', 'last_modified', 'آخر تعديل', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6981, 'sa', 'contact_in_header_menu', 'اتصل في قائمة الرأس', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6982, 'sa', 'showhide_contact_link_in_header_menu', 'إظهار / إخفاء رابط الاتصال في قائمة الرأس', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6983, 'sa', 'contact_in_header_menu_text', 'جهة الاتصال في نص قائمة رأس الصفحة', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6984, 'sa', 'contact_header_text', 'نص رأس جهة الاتصال', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6985, 'sa', 'set_text_for_contact_in_header_menu', 'تعيين النص للاتصال في قائمة الرأس', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6986, 'sa', 'set_text_for_contact_in_header_menu_if_no_text_is_set_default_contact_will_be_placed', 'إذا لم يتم تعيين نص افتراضي ، فسيتم وضع \"جهة الاتصال\"', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6987, 'sa', 'these_settings_control_the_typography_for_body', 'تتحكم هذه الإعدادات في طباعة الجسم.', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6988, 'sa', 'add_blog', 'أضف مدونة', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6989, 'sa', 'stick_this_post_to_the_frontpage', 'إلصق هذا الإعلان في الصفحة الأولى', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6990, 'sa', 'blog_image', 'صورة المدونة', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6991, 'sa', 'featured_status', 'حالة مميزة', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6992, 'sa', 'no_option_selected', 'لا يوجد خيار محدد', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6993, 'sa', 'only_active_categories', 'الفئات النشطة فقط', '2023-05-13 06:29:32', '2023-05-13 06:29:32');
INSERT INTO `tl_translations` (`id`, `lang`, `lang_key`, `lang_value`, `created_at`, `updated_at`) VALUES
(6994, 'sa', 'new_tag', 'علامة جديدة', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6995, 'sa', 'add', 'يضيف', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6996, 'sa', 'add_new_tag', 'أضف علامة جديدة', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6997, 'sa', 'new_category', 'فئة جديدة', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6998, 'sa', 'select_parent', 'حدد الأصل', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(6999, 'sa', 'select_a_parent_category', 'حدد فئة الأصل', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(7000, 'sa', 'add_new_category', 'إضافة فئة جديدة', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(7001, 'sa', 'edit_blog', 'تحرير المدونة', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(7002, 'sa', 'please_insert_blog_name', 'الرجاء إدخال اسم المدونة', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(7003, 'sa', 'please_write_the_blog_name_under_225_words', 'الرجاء كتابة اسم المدونة تحت 225 كلمة', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(7004, 'sa', 'something_went_wrong_please_select_category_again', 'حدث خطأ ما ، يرجى تحديد الفئة مرة أخرى', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(7005, 'sa', 'new_blog_saved', 'تم حفظ مدونة جديدة', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(7006, 'sa', 'blog_updated_successfully', 'تم تحديث المدونة بنجاح', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(7007, 'sa', 'by', 'بواسطة:', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(7008, 'sa', 'version', 'إصدار:', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(7009, 'sa', 'activated', 'مفعل', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(7010, 'sa', 'activate_confirmation', 'تفعيل التأكيد', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(7011, 'sa', 'are_you_sure_to_active_this_theme', 'هل أنت متأكد من تنشيط هذا الموضوع', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(7012, 'sa', 'activate', 'تفعيل', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(7013, 'sa', 'footer_language_select', 'تحديد لغة التذييل', '2023-05-13 06:29:32', '2023-05-13 06:29:32'),
(7014, 'sa', 'set_enable_to_display_multilanguage_select_in_footer', 'قم بتعيين تمكين لعرض تحديد متعدد اللغات في التذييل.', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7015, 'sa', 'plugings', 'الوسادات', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7016, 'sa', 'deactive_confirmation', 'تأكيد غير نشط', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7017, 'sa', 'are_you_sure_to_deactive_this_plugin', 'هل أنت متأكد من إلغاء تنشيط هذا البرنامج المساعد', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7018, 'sa', 'deactivate', 'تعطيل', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7019, 'sa', 'are_you_sure_to_active_this_plugin', 'هل أنت متأكد من تنشيط هذا البرنامج المساعد', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7020, 'sa', 'placeholder_image', 'صورة العنصر النائب', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7021, 'sa', 'watermark_settings', 'إعدادات العلامة المائية', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7022, 'sa', 'enabledisable_watermark', 'تمكين / تعطيل العلامة المائية', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7023, 'sa', 'watermark_image', 'صورة العلامة المائية', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7024, 'sa', 'watermark_image_position', 'موقف صورة العلامة المائية', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7025, 'sa', 'top_left', 'أعلى اليسار', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7026, 'sa', 'top_right', 'اعلى اليمين', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7027, 'sa', 'bottom_left', 'أسفل اليسار', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7028, 'sa', 'watermarking_image_opacity_', 'عتامة صورة العلامة المائية (٪)', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7029, 'sa', 'watermarking_image_opacity', 'عتامة الصورة بالماء', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7030, 'sa', 'media_thumbnails_sizes', 'أحجام الصور المصغرة للوسائط', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7031, 'sa', 'large_thumb_image_size', 'حجم صورة الإبهام الكبير', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7032, 'sa', 'large_thumb_image_width', 'عرض صورة إبهام كبير', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7033, 'sa', 'large_thumb_image_height', 'ارتفاع صورة الإبهام الكبير', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7034, 'sa', 'medium_thumb_image_size', 'حجم صورة الإبهام المتوسط', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7035, 'sa', 'medium_thumb_image_width', 'عرض صورة إبهام متوسط', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7036, 'sa', 'medium_thumb_image_height', 'متوسط ​​ارتفاع صورة الإبهام', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7037, 'sa', 'small_thumb_image_size', 'حجم صورة الإبهام الصغير', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7038, 'sa', 'small_thumb_image_width', 'عرض صورة صغيرة بالإبهام', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7039, 'sa', 'small_thumb_image_height', 'ارتفاع صورة الإبهام الصغير', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7040, 'sa', 'select_image_applicable_folder', 'حدد مجلد مناسب للصورة', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7041, 'sa', 'delete_permanently', 'الحذف بشكل نهائي', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7042, 'sa', 'file_name', 'اسم الملف:', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7043, 'sa', 'file_url', 'URL الملف:', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7044, 'sa', 'file_type', 'نوع الملف:', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7045, 'sa', 'file_size', 'حجم الملف:', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7046, 'sa', 'uploaded_by', 'تم الرفع بواسطة:', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7047, 'sa', 'created_at', 'أنشئت في:', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7048, 'sa', 'updated_at', 'تم التحديث في:', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7049, 'sa', 'download', 'تحميل', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7050, 'sa', 'copy_url_to_clipboard', 'انسخ URL إلى الحافظة', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7051, 'sa', 'alt________________________________________________________________________________________________________________________________text', 'نص بديل', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7052, 'sa', 'caption', 'التسمية التوضيحية', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7053, 'sa', 'description', 'وصف', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7054, 'sa', 'media_file_uploaded_successful', 'تم تحميل ملف الوسائط بنجاح', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7055, 'sa', 'media_file_deleted_successfully', 'تم حذف ملف الوسائط بنجاح', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7056, 'sa', 'media_settings_updated_successfully', 'تم تحديث إعدادات الوسائط بنجاح', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7057, 'sa', 'blog_not_found', 'المدونة غير موجودة', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7058, 'sa', 'blog_featured_status_changed_successfully', 'تم تغيير حالة ظهور المدونة بنجاح', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7059, 'sa', 'unable_to_update_media_file', 'تعذر تحديث ملف الوسائط', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7060, 'sa', 'category_color', 'لون الفئة', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7061, 'sa', 'new_section_added_successfully', 'تمت إضافة قسم جديد بنجاح', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7062, 'sa', 'a_new_comment_added', 'تمت إضافة تعليق جديد.', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7063, 'sa', 'your_comment_added', 'تمت إضافة تعليقك', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7064, 'sa', 'module_name', 'اسم وحدة', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7065, 'sa', 'permission_name', 'اسم الإذن', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7066, 'sa', 'users_login_activity', 'نشاط تسجيل دخول المستخدمين', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7067, 'sa', 'user', 'مستخدم', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7068, 'sa', 'login_at', 'تسجيل الدخول في', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7069, 'sa', 'logout_at', 'تسجيل الخروج في', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7070, 'sa', 'ip', 'IP', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7071, 'sa', 'operating_system', 'نظام التشغيل', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7072, 'sa', 'browser', 'المستعرض', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7073, 'sa', 'action', 'فعل', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7074, 'sa', '________________________bulk_action_', 'العمل الجماعي', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7075, 'sa', '________________________delete_selection_', 'حذف التحديد', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7076, 'sa', '________________________apply_', 'يتقدم', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7077, 'sa', 'no_item_selected_', 'لم يتم تحديد أي عنصر', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7078, 'sa', 'no_action_selected_', 'لم يتم تحديد أي إجراء', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7079, 'sa', 'add_new_user', 'إضافة مستخدم جديد', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7080, 'sa', 'uid', 'المعرف الفريد', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7081, 'sa', 'assign_role', 'تعيين الدور', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7082, 'sa', 'select_a_role', 'حدد دورًا', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7083, 'sa', 'user_updated_successfully', 'تم تحديث المستخدم بنجاح', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7084, 'sa', 'add_user', 'إضافة مستخدم', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7085, 'sa', 'user_status_updated_successfully', 'تم تحديث حالة المستخدم بنجاح', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7086, 'sa', 'comment_setting', 'إعداد التعليق', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7087, 'sa', 'default_blog_settings', 'إعدادات المدونة الافتراضية', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7088, 'sa', 'allow_people_to_submit_comments_on_new_blogs', 'السماح للأشخاص بإرسال تعليقات على المدونات الجديدة', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7089, 'sa', 'other_comment_settings', 'إعدادات التعليقات الأخرى', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7090, 'sa', 'comment_author_must_fill_out_name_and_email', 'كاتب التعليق يجب أن يملأ الاسم والبريد الإلكتروني', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7091, 'sa', 'users_must_be_registered_and_logged_in_to_comment', 'المستخدمون يجب ان يسجلوا دخولهم للتعليق', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7092, 'sa', 'automatically_close_comments_on_blogs_older_than', 'إغلاق التعليقات تلقائيًا على المدونات الأقدم من', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7093, 'sa', 'days', 'أيام', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7094, 'sa', 'enable_threaded_nested_comments', 'تفعيل التعليقات المترابطة (المتداخلة)', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7095, 'sa', 'levels_deep', 'مستويات عميقة', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7096, 'sa', 'break_comments_into_pages_with', 'قسم التعليقات إلى صفحات باستخدام', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7097, 'sa', 'top_level_comments_per_page_and', 'أعلى مستوى من التعليقات في كل صفحة و', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7098, 'sa', 'comments_should_be_displayed_with_the', 'يجب عرض التعليقات بامتداد', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7099, 'sa', 'older', 'اكبر سنا', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7100, 'sa', 'newer', 'أحدث', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7101, 'sa', 'comments_at_the_top_of_each_page', 'من التعليقات أعلى كل صفحة', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7102, 'sa', 'email_me_whenever', 'راسلني في أي وقت', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7103, 'sa', 'anyone_posts_a_comment', 'أي شخص ينشر تعليق', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7104, 'sa', 'a_comment_is_held_for_moderation', 'يتم تعليق تعليق للاعتدال', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7105, 'sa', 'before_a_comment_appears', 'قبل أن يظهر التعليق', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7106, 'sa', 'comment_must_be_manually_approved', 'يجب الموافقة على التعليق يدويًا', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7107, 'sa', 'comment_author_must_have_a_previously_approved_comment', 'يجب أن يكون لدى مؤلف التعليق تعليق تمت الموافقة عليه مسبقًا', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7108, 'sa', 'comment_moderation', 'تعليق الاعتدال', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7109, 'sa', 'hold_a_comment_in_the_queue_if_it_contains', 'تعليق تعليق في قائمة الانتظار إذا كان يحتوي على', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7110, 'sa', 'or_more_links_a_common_characteristic_of_comment_spam_is_a_large_number_of_hyperlinks', '(من السمات الشائعة للتعليقات غير المرغوب فيها وجود عدد كبير من الارتباطات التشعبية.)', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7111, 'sa', 'when_a_comment_contains_any_of_these_words_in_its_content_author_name_url_email_ip_address_or_browsers_user_agent_string_it_will_be_held_in_the_', 'عندما يحتوي تعليق على أي من هذه الكلمات في محتواه ، أو اسم المؤلف ، أو عنوان URL ، أو البريد الإلكتروني ، أو عنوان IP ، أو سلسلة وكيل مستخدم المتصفح ، فسيتم تعليقه في', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7112, 'sa', 'pending_queue', 'قائمة انتظار معلقة', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7113, 'sa', 'one_word_or_ip_address_per_line_it_will_match_inside_words_so_press_will_match_wordpress', 'سيتطابق مع الكلمات الداخلية ، لذا فإن \"اضغط\" سيتطابق مع \"WordPress\".', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7114, 'sa', 'disallowed_comment_keys', 'مفاتيح التعليقات غير المسموح بها', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7115, 'sa', 'when_a_comment_contains_any_of_these_words_in_its_content_author_name_url_email_ip_address_or_browsers_user_agent_string_it_will_be_put_in_the_trash_one_word_or_ip_address_per_line_it_will_match_inside_words_so_press_will_match_wordpress', 'سيتطابق مع الكلمات الداخلية ، لذا فإن \"اضغط\" سيتطابق مع \"WordPress\".', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7116, 'sa', 'avatars', 'الآلهة', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7117, 'sa', 'an_avatar_is_an_image_that_can_be_associated_with_a_user_across_multiple_websites_in_this_area_you_can_choose_to_display_avatars_of_users_who_interact_with_the_site', 'في هذه المنطقة ، يمكنك اختيار عرض الصور الرمزية للمستخدمين الذين يتفاعلون مع الموقع.', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7118, 'sa', 'avatar_display', 'عرض الصورة الرمزية', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7119, 'sa', 'show_avatars', 'عرض الصور الرمزية', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7120, 'sa', 'default_avatar', 'الصورة الرمزية الافتراضية', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7121, 'sa', 'for_users_without_a_custom_avatar_of_their_own_you_can_either_display_a_generic_logo_or_a_generated_one_based_on_their_email_address', 'بالنسبة للمستخدمين الذين ليس لديهم صورة رمزية مخصصة خاصة بهم ، يمكنك إما عرض شعار عام أو شعار تم إنشاؤه بناءً على عنوان بريدهم الإلكتروني.', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7122, 'sa', 'mystery_person', 'شخص غامض', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7123, 'sa', 'blank', 'فارغ', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7124, 'sa', 'gravatar_logo', 'شعار Gravatar', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7125, 'sa', 'identicon_generated', 'رمز التعريف (تم إنشاؤه)', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7126, 'sa', 'wavatar_generated', 'وافاتار (ولدت)', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7127, 'sa', 'monsterid_generated', 'MonsterID (مُنشأ)', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7128, 'sa', 'retro_generated', 'رجعي (تم إنشاؤه)', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7129, 'sa', 'please_check_for_missing_field_or_invalid_data_and_try_again', 'يرجى التحقق من وجود حقل مفقود أو بيانات غير صالحة وحاول مرة أخرى.', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7130, 'sa', 'menu_deleted_successfully', 'تم حذف القائمة بنجاح', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7131, 'sa', 'add_title', 'أضف عنوانا', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7132, 'sa', 'new_page_saved', 'تم حفظ صفحة جديدة', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7133, 'sa', 'preferred_size_for_thumnail_image_is_1110__578_px', 'الحجم المفضل لصورة العمود هو 1110 × 578 بكسل', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7134, 'sa', 'general_settings_updated_successfully', 'تم تحديث الإعدادات العامة بنجاح', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7135, 'sa', 'alt_text', 'نص بديل', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7136, 'sa', 'blog_deleted_successfully', 'تم حذف المدونة بنجاح', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7137, 'sa', 'add_role', 'أضف دورًا', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7138, 'sa', 'give_role_name', 'أعط اسم الدور', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7139, 'sa', 'module', 'وحدة', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7140, 'sa', 'feature', 'ميزة', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7141, 'sa', 'create', 'يخلق', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7142, 'sa', 'manage', 'يدير', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7143, 'sa', 'show_', 'يعرض', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7144, 'sa', 'create_', 'يخلق', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7145, 'sa', 'edit_', 'يحرر', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7146, 'sa', 'delete_', 'يمسح', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7147, 'sa', 'manage_', 'يدير', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7148, 'sa', 'update_role', 'تحديث الدور', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7149, 'sa', 'sidebar_updated', 'تم تحديث الشريط الجانبي', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7150, 'sa', 'stick_this_post_to_the_front_of_blog_list_page', 'الصق هذا المنشور في مقدمة صفحة قائمة المدونة', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7151, 'sa', 'blog_comment', 'تعليق المدونة', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7152, 'sa', 'approve', 'يعتمد', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7153, 'sa', 'spam', 'رسائل إلكترونية مزعجة', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7154, 'sa', 'in_response_to', 'للإستجابة ل', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7155, 'sa', 'unapprove', 'غير موافق', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7156, 'sa', 'reply', 'رد', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7157, 'sa', 'view_blog', 'مشاهدة المدونة', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7158, 'sa', 'comment_delete_confirmation', 'تأكيد حذف التعليق', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7159, 'sa', 'are_you_sure_you_want_to_permanently_delete_this_comment', 'هل أنت متأكد من أنك تريد حذف هذا التعليق بشكل دائم', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7160, 'sa', 'bulk_action_confirmation', 'تأكيد الإجراء المجمع', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7161, 'sa', 'are_you_sure_you_want_to_take_this_action', 'هل أنت متأكد أنك تريد اتخاذ هذا الإجراء', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7162, 'sa', 'comment_reply', 'الرد على التعليق', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7163, 'sa', 'move_to_trash', 'ارسال الى سلة المحذوفات', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7164, 'sa', 'mark_as_spam', 'علامة كدعاية', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7165, 'sa', 'not_spam', 'ليس بريدا موذيا', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7166, 'sa', 'delete_permanetly', 'حذف نهائيًا', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7167, 'sa', 'delete_all', 'حذف الكل', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7168, 'sa', 'edit_comment', 'تعديل التعليق', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7169, 'sa', 'please_enter_a_valid_number_for_comment_close_days', 'الرجاء إدخال رقم صالح ليوم إغلاق التعليق.', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7170, 'sa', 'the_minimum_number_for_comment_close_days_is_1', 'الحد الأدنى لعدد أيام إغلاق التعليقات هو 1', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7171, 'sa', 'please_select_a_valid_option_for_comment_threads_level', 'يرجى تحديد خيار صالح لمستوى مواضيع التعليق', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7172, 'sa', 'please_enter_a_valid_number_for_per_page_comment', 'الرجاء إدخال رقم صحيح للتعليق على كل صفحة', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7173, 'sa', 'the_minimum_comments_for_per_page_is_8', 'الحد الأدنى من التعليقات لكل صفحة هو 8', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7174, 'sa', 'please_select_a_valid_option_for_default_comment_page', 'الرجاء تحديد خيار صالح لصفحة التعليق الافتراضية', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7175, 'sa', 'please_select_a_valid_option_for_comment_order', 'الرجاء تحديد خيار صالح لترتيب التعليق', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7176, 'sa', 'please_enter_a_valid_number_for_comment_links', 'الرجاء إدخال رقم صحيح لارتباطات التعليق', '2023-05-13 06:30:15', '2023-05-13 06:30:15'),
(7177, 'sa', 'the_minimum_comment_links_number_must_be_1', 'يجب أن يكون الحد الأدنى لرقم روابط التعليق هو 1', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7178, 'sa', 'please_select_a_valid_default_avatar', 'يرجى تحديد شخصية افتراضية صالحة', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7179, 'sa', 'comment_settings_updated_successfully', 'تم تحديث إعدادات التعليق بنجاح', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7180, 'sa', 'seo_update_successfully', 'تم تحديث SEO بنجاح', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7181, 'sa', 'mail_driver_is_required', 'مطلوب سائق البريد', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7182, 'sa', 'smtp_configuration_updated_successfully', 'تم تحديث تكوين SMTP بنجاح', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7183, 'sa', 'new_language', 'لغة جديدة', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7184, 'sa', 'select_a_option', 'حدد خيارًا', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7185, 'sa', 'section_deleted_successfully', 'تم حذف القسم بنجاح', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7186, 'sa', 'after_uploading_your_fonts_you_should_select_font_family_customfont1customfont2_from_dropdown_list_in_bodyparagraphheadingsmenublog_typography_section', 'بعد تحميل الخطوط الخاصة بك ، يجب عليك تحديد عائلة الخطوط (custom-font-1 / custom-font-2 من القائمة المنسدلة في (Body / Paragraph / Headings / Menu / Blog) قسم الطباعة.', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7187, 'sa', 'custom_font1', 'خط مخصص 1', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7188, 'sa', 'please_enable_this_option_to_use_custom_font_1', 'يرجى تمكين هذا الخيار لاستخدام Custom Font 1.', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7189, 'sa', 'custom_font_1_woff', 'الخط المخصص 1', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7190, 'sa', 'remove', 'يزيل', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7191, 'sa', 'custom_font_1_ttf', 'الخط المخصص 1 .ttf', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7192, 'sa', 'custom_font_1_eot', 'خط مخصص 1 .eot', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7193, 'sa', 'custom_font2', 'خط مخصص 2', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7194, 'sa', 'please_enable_this_option_to_use_custom_font_2', 'يرجى تمكين هذا الخيار لاستخدام Custom Font 2.', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7195, 'sa', 'custom_font_2_woff', 'الخط المخصص 2', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7196, 'sa', 'custom_font_2_ttf', 'الخط المخصص 2 .ttf', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7197, 'sa', 'custom_font_2_eot', 'الخط المخصص 2 .eot', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7198, 'sa', 'import_file_or_clipboard_text_is_required', 'مطلوب استيراد ملف أو نص الحافظة', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7199, 'sa', 'role_name_is_required', 'اسم الدور مطلوب', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7200, 'sa', 'role_name_already_exists', 'اسم الدور موجود بالفعل', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7201, 'sa', 'role_permission_required', 'مطلوب إذن الدور', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7202, 'sa', 'role_updated_successful', 'تم تحديث الدور بنجاح', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7203, 'sa', 'widget_removed_from_sidebar', 'القطعة إزالتها من الشريط الجانبي', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7204, 'sa', 'result_for', 'النتيجة لـ', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7205, 'sa', 'license_activate', 'تفعيل الترخيص', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7206, 'sa', 'license_key', 'مفتاح الترخيص', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7207, 'sa', 'enter_license_key', 'أدخل مفتاح الترخيص', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7208, 'sa', 'welcome', 'مرحباً', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7209, 'sa', 'pages_bulk_delete_successful', 'تم حذف مجموعة الصفحات بنجاح', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7210, 'sa', 'page_deleted_successfully', 'تم حذف الصفحة بنجاح', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7211, 'sa', 'blogs_bulk_delete_successful', 'تم حذف المدونات بالجملة بنجاح', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7212, 'sa', 'tag_bulk_deleted_successfully', 'تم حذف مجموعة العلامات بنجاح', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7213, 'sa', 'blog_category_bulk_deleting_failed', 'فشل الحذف المجمع لفئة المدونة', '2023-05-13 06:30:16', '2023-05-13 06:30:16'),
(7214, 'sa', 'blog_category_deleted_successfully', 'تم حذف فئة المدونة بنجاح', '2023-05-13 06:30:43', '2023-05-13 06:30:43'),
(7215, 'sa', 'user_deleted_successfully', 'تم حذف المستخدم بنجاح', '2023-05-13 06:30:43', '2023-05-13 06:30:43'),
(7216, 'sa', 'you_can_not_inactive_this_language', 'لا يمكنك تعطيل هذه اللغة', '2023-05-13 06:30:43', '2023-05-13 06:30:43'),
(7217, 'sa', 'nothing_found', 'لم يتم العثور على شيء', '2023-05-13 06:30:43', '2023-05-13 06:30:43'),
(7218, 'sa', 'role_deleted_successfully', 'تم حذف الدور بنجاح', '2023-05-13 06:30:43', '2023-05-13 06:30:43'),
(7219, 'sa', 'theme_color', 'لون الموضوع', '2023-05-13 06:30:43', '2023-05-13 06:30:43'),
(7220, 'sa', 'theme_primary_color', 'اللون الأساسي للسمة', '2023-05-13 06:30:43', '2023-05-13 06:30:43'),
(7221, 'sa', 'set_theme_primary_color', 'تعيين اللون الأساسي للسمة', '2023-05-13 06:30:43', '2023-05-13 06:30:43'),
(7222, 'bd', 'cache_clear_successfully', 'ক্যাশে সফলভাবে সাফ করা হয়েছে', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7223, 'bd', 'languages', 'ভাষা', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7224, 'bd', 'add_new_language', 'নতুন ভাষা যোগ করুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7225, 'bd', 'name', 'নাম', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7226, 'bd', 'native_name', 'স্থানীয় নাম', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7227, 'bd', 'code', 'কোড', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7228, 'bd', 'flag', 'পতাকা', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7229, 'bd', 'rtl', 'আরটিএল', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7230, 'bd', 'status', 'স্ট্যাটাস', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7231, 'bd', 'actions', 'কর্ম', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7232, 'bd', 'backend_translations', 'ব্যাকএন্ড অনুবাদ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7233, 'bd', 'frontend_translations', 'ফ্রন্টএন্ড অনুবাদ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7234, 'bd', 'edit', 'সম্পাদনা করুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7235, 'bd', 'delete', 'মুছে ফেলা', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7236, 'bd', 'delete_confirmation', 'নিশ্চিতকরণ মুছুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7237, 'bd', 'are_you_sure_to_delete_this', 'আপনি এই মুছে ফেলার জন্য নিশ্চিত', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7238, 'bd', 'cencel', 'সেন্সেল', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7239, 'bd', 'my_profile', 'আমার প্রোফাইল', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7240, 'bd', 'log_out', 'প্রস্থান', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7241, 'bd', 'clear_cache', 'ক্যাশে সাফ করুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7242, 'bd', 'notifications', 'বিজ্ঞপ্তি', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7243, 'bd', 'clear_all', 'সব পরিষ্কার করে দাও', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7244, 'bd', 'dashboard', 'ড্যাশবোর্ড', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7245, 'bd', 'media', 'মিডিয়া', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7246, 'bd', 'blog', 'ব্লগ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7247, 'bd', 'all_blogs', 'সমস্ত ব্লগ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7248, 'bd', 'add_new_blog', 'নতুন ব্লগ যোগ করুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7249, 'bd', 'categories', 'ক্যাটাগরি', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7250, 'bd', 'tags', 'ট্যাগ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7251, 'bd', 'comments', 'মন্তব্য', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7252, 'bd', 'settings', 'সেটিংস', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7253, 'bd', 'comment_settings', 'মন্তব্য সেটিংস', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7254, 'bd', 'pages', 'পাতা', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7255, 'bd', 'all_pages', 'সমস্ত পৃষ্ঠা', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7256, 'bd', 'add_new_page', 'নতুন পৃষ্ঠা যোগ করুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7257, 'bd', 'appearances', 'উপস্থিতি', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7258, 'bd', 'themes', 'থিম', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7259, 'bd', 'menus', 'মেনু', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7260, 'bd', 'theme_options', 'থিম অপশনগুলি', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7261, 'bd', 'general_settings', 'সাধারণ সেটিংস', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7262, 'bd', 'home_page_builder', 'হোম পেজ নির্মাতা', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7263, 'bd', 'widgets', 'উইজেট', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7264, 'bd', 'plugins', 'প্লাগইন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7265, 'bd', 'email_settings', 'ইমেল সেটিংস', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7266, 'bd', 'email_templates', 'ইমেল টেমপ্লেট', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7267, 'bd', 'media_settings', 'মিডিয়া সেটিংস', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7268, 'bd', 'seo_settings', 'এসইও সেটিংস', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7269, 'bd', 'users', 'ব্যবহারকারীদের', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7270, 'bd', 'roles', 'ভূমিকা', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7271, 'bd', 'permissions', 'অনুমতি', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7272, 'bd', 'activity_logs', 'কার্যকলাপ লগ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7273, 'bd', 'login_activity', 'লগইন কার্যকলাপ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7274, 'bd', 'you_have_no_unread_notification', 'আপনার কোন অপঠিত বিজ্ঞপ্তি নেই', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7275, 'bd', 'key', 'চাবি', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7276, 'bd', 'value', 'মান', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7277, 'bd', 'save', 'সংরক্ষণ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7278, 'bd', 'page_not_found', 'পৃষ্ঠা খুঁজে পাওয়া যায়নি!', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7279, 'bd', 'the_page_you_are_looking_for_was_moved_removed_renamed_or_never_existed_please_check_the_url_or_go_to', 'অনুগ্রহ করে ইউআরএল চেক করুন বা যান', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7280, 'bd', 'main_page', 'প্রধান পাতা.', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7281, 'bd', 'search_here', 'এখানে অনুসন্ধান করুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7282, 'bd', 'save_changes', 'পরিবর্তনগুলোর সংরক্ষন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7283, 'bd', 'comment_loaded_successfully', 'মন্তব্য সফলভাবে লোড হয়েছে', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7284, 'bd', 'homepage_builder', 'হোমপেজ নির্মাতা', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7285, 'bd', 'home_page_sections', 'হোম পেজ বিভাগ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7286, 'bd', 'add_new_section', 'নতুন বিভাগ যোগ করুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7287, 'bd', 'banner_slider', 'ব্যানার স্লাইডার', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7288, 'bd', 'manage_slider', 'স্লাইডার পরিচালনা করুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7289, 'bd', 'are_you_sure_to_delete_this_section', 'আপনি এই বিভাগটি মুছে ফেলার বিষয়ে নিশ্চিত?', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7290, 'bd', 'cancel', 'বাতিল', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7291, 'bd', 'new_section', 'নতুন বিভাগ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7292, 'bd', 'select_section', 'বিভাগ নির্বাচন করুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7293, 'bd', 'select_layout', 'লেআউট নির্বাচন করুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7294, 'bd', 'ads', 'বিজ্ঞাপন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7295, 'bd', 'latest_blogs', 'সর্বশেষ ব্লগ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7296, 'bd', 'featured_product', 'বৈশিষ্ট্যযুক্ত পণ্য', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7297, 'bd', 'most_viewed_blog', 'সর্বাধিক দেখা ব্লগ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7298, 'bd', 'trending_blog', 'ট্রেন্ডিং ব্লগ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7299, 'bd', 'category_wise', 'ক্যাটাগরি ওয়াইজ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7300, 'bd', 'please_select_a_style', 'একটি শৈলী নির্বাচন করুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7301, 'bd', 'section_properties', 'বিভাগ বৈশিষ্ট্য', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7302, 'bd', 'media_library', 'মিডিয়া লাইব্রেরি', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7303, 'bd', 'upload_files', 'ফাইল আপলোড', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7304, 'bd', 'click_or_drop_files_here_to_upload', 'আপলোড করতে এখানে ফাইলগুলি ক্লিক করুন বা ড্রপ করুন৷', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7305, 'bd', 'filter_media', 'পরিশোধক মাধ্যম', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7306, 'bd', 'all_file_type', 'সমস্ত ফাইল প্রকার', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7307, 'bd', 'all_dates', 'সব তারিখ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7308, 'bd', 'load_more', 'আর ঢুকাও', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7309, 'bd', 'insert', 'ঢোকান', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7310, 'bd', 'attachment_details', 'সংযুক্তি বিবরণ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7311, 'bd', 'alt________________________text_', 'বিকল্প পাঠ :', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7312, 'bd', 'title_', 'শিরোনাম :', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7313, 'bd', 'caption_', 'ক্যাপশন :', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7314, 'bd', 'description_', 'বর্ণনা:', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7315, 'bd', 'content', 'বিষয়বস্তু', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7316, 'bd', 'background', 'পটভূমি', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7317, 'bd', 'advanced', 'উন্নত', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7318, 'bd', 'select_layouts', 'লেআউট নির্বাচন করুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7319, 'bd', 'title', 'শিরোনাম', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7320, 'bd', 'type_title', 'শিরোনাম টাইপ করুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7321, 'bd', 'title_is_not_visible_in_homepage', 'শিরোনাম হোমপেজে দৃশ্যমান নয়', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7322, 'bd', 'background_color', 'পেছনের রং', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7323, 'bd', 'background_image', 'ব্যাকগ্রাউন্ড ইমেজ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7324, 'bd', 'choose_file', 'ফাইল পছন্দ কর', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7325, 'bd', 'background_size', 'ব্যাকগ্রাউন্ড সাইজ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7326, 'bd', 'background_position', 'ব্যাকগ্রাউন্ড পজিশন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7327, 'bd', 'background_repeat', 'পটভূমি পুনরাবৃত্তি', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7328, 'bd', 'padding', 'প্যাডিং', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7329, 'bd', 'top', 'শীর্ষ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7330, 'bd', 'right', 'ঠিক', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7331, 'bd', 'bottom', 'নীচে', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7332, 'bd', 'left', 'বাম', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7333, 'bd', 'margin', 'মার্জিন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7334, 'bd', 'button', 'বোতাম', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7335, 'bd', 'blog_post_style', 'ব্লগ পোস্ট শৈলী', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7336, 'bd', 'select_style', 'স্টাইল নির্বাচন করুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7337, 'bd', 'style_1', 'শৈলী ঘ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7338, 'bd', 'style_2', 'শৈলী 2', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7339, 'bd', 'style_3', 'শৈলী 3', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7340, 'bd', 'style_4', 'শৈলী 4', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7341, 'bd', 'style_5', 'শৈলী 5', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7342, 'bd', 'blog_colum', 'ব্লগ কলাম', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7343, 'bd', 'number_of_blogs', 'ব্লগের সংখ্যা', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7344, 'bd', 'title_is_visible_in_homepage_transalate_to_another_language', 'অন্য ভাষায় অনুবাদ করুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7345, 'bd', 'click_here', 'এখানে ক্লিক করুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7346, 'bd', 'title_color', 'শিরোনাম রঙ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7347, 'bd', 'description_color', 'বর্ণনার রঙ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7348, 'bd', 'button_title', 'বোতাম শিরোনাম', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7349, 'bd', 'button_title_is_visible_in_homepage_transalate_to_another_language', 'অন্য ভাষায় অনুবাদ করুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7350, 'bd', 'button_color', 'বোতামের রঙ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7351, 'bd', 'button_hover_color', 'বোতাম হোভার রঙ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7352, 'bd', 'button_background_color', 'বোতামের পটভূমির রঙ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7353, 'bd', 'button_background_hover_color', 'বোতাম পটভূমি হোভার রঙ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7354, 'bd', 'button_border', 'বোতাম বর্ডার', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7355, 'bd', 'button_border_color', 'বোতাম বর্ডার রঙ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7356, 'bd', 'button_border_hover_color', 'বোতাম বর্ডার হোভার রঙ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7357, 'bd', 'select_category', 'বিভাগ নির্বাচন করুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7358, 'bd', 'update_section', 'আপডেট বিভাগ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7359, 'bd', 'section', 'অধ্যায়', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7360, 'bd', 'image', 'ছবি', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7361, 'bd', 'url', 'ইউআরএল', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7362, 'bd', 'cover', 'আবরণ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7363, 'bd', 'auto', 'স্বয়ংক্রিয়', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7364, 'bd', 'contain', 'ধারণ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7365, 'bd', 'initial', 'প্রাথমিক', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7366, 'bd', 'revert', 'প্রত্যাবর্তন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7367, 'bd', 'inherit', 'আপনি উত্তরাধিকারী', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7368, 'bd', 'revertlayer', 'প্রত্যাবর্তন স্তর', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7369, 'bd', 'unset', 'আনসেট', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7370, 'bd', 'center', 'কেন্দ্র', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7371, 'bd', 'section_updated_successfully', 'বিভাগ সফলভাবে আপডেট করা হয়েছে', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7372, 'bd', 'translations_updated_successfully', 'অনুবাদ সফলভাবে আপডেট করা হয়েছে', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7373, 'bd', 'reset_section', 'বিভাগ রিসেট করুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7374, 'bd', 'reset_all', 'সব পুনরায় সেট করুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7375, 'bd', 'general', 'সাধারণ', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7376, 'bd', 'back_to_top', 'উপরে ফিরে যাও', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7377, 'bd', 'preloader', 'প্রিলোডার', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7378, 'bd', 'typography', 'টাইপোগ্রাফি', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7379, 'bd', 'body_typography', 'বডি টাইপোগ্রাফি', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7380, 'bd', 'paragraph_typography', 'অনুচ্ছেদ টাইপোগ্রাফি', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7381, 'bd', 'heading_typography', 'শিরোনাম টাইপোগ্রাফি', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7382, 'bd', 'menu_typography', 'মেনু টাইপোগ্রাফি', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7383, 'bd', 'button_typography', 'বোতাম টাইপোগ্রাফি', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7384, 'bd', 'custom_fonts', 'কাস্টম ফন্ট', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7385, 'bd', 'header', 'হেডার', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7386, 'bd', 'header_option', 'হেডার বিকল্প', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7387, 'bd', 'header_logo', 'হেডার লোগো', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7388, 'bd', 'menu', 'তালিকা', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7389, 'bd', 'mobile_menu', 'মোবাইল মেনু', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7390, 'bd', 'home_page_layout', 'হোম পেজ লেআউট', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7391, 'bd', 'blog_option', 'ব্লগ বিকল্প', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7392, 'bd', 'single_blog_page', 'একক ব্লগ পাতা', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7393, 'bd', 'sidebar_options', 'সাইডবার বিকল্প', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7394, 'bd', 'page', 'পাতা', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7395, 'bd', '404_page', '404 পৃষ্ঠা', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7396, 'bd', 'subscribe', 'সাবস্ক্রাইব', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7397, 'bd', 'social', 'সামাজিক', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7398, 'bd', 'footer', 'ফুটার', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7399, 'bd', 'custom_css', 'কাস্টম সিএসএস', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7400, 'bd', 'importexport', 'আমদানি রপ্তানি', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7401, 'bd', 'reset_confirmation', 'নিশ্চিতকরণ রিসেট করুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7402, 'bd', 'are_you_sure_to_want_to_reset', 'আপনি কি নিশ্চিত রিসেট করতে চান৷', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7403, 'bd', 'action_failed', 'অ্যাকশন ব্যর্থ হয়েছে৷', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7404, 'bd', 'select_font_subsets', 'ফন্ট সাবসেট নির্বাচন করুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7405, 'bd', 'select_weight__style', 'ওজন এবং শৈলী নির্বাচন করুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7406, 'bd', 'new_slide', 'নতুন স্লাইড', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7407, 'bd', 'iconexample_fa_fafacebook', 'আইকন (উদাহরণ: fa fa-facebook)', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7408, 'bd', 'copied', 'কপি করা হয়েছে', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7409, 'bd', 'import_options_json', 'আমদানি বিকল্প Json', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7410, 'bd', 'import_from_clipboard', 'ক্লিপবোর্ড থেকে আমদানি করুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7411, 'bd', 'uploade_file', 'ফাইল আপলোড করুন', '2023-05-13 06:34:42', '2023-05-13 06:34:42'),
(7412, 'bd', 'paste_your_clipboard_data_here', 'এখানে আপনার ক্লিপবোর্ড ডেটা আটকান।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7413, 'bd', 'import', 'আমদানি', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7414, 'bd', 'warning_this_will_overwrite_all_existing_option_values_please_proceed_with_caution', 'এটি সমস্ত বিদ্যমান বিকল্প মানগুলিকে ওভাররাইট করবে, দয়া করে সাবধানতার সাথে এগিয়ে যান!', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7415, 'bd', 'export_options_json', 'রপ্তানি বিকল্প Json', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7416, 'bd', 'here_you_can_copydownload_your_current_option_settings_keep_this_safe_as_you_can_use_it_as_a_backup_should_anything_go_wrong_or_you_can_use_it_to_restore_your_settings_on_this_site_or_any_other_site', 'এটিকে সুরক্ষিত রাখুন কারণ আপনি এটিকে ব্যাকআপ হিসাবে ব্যবহার করতে পারেন যদি কিছু ভুল হয়ে যায়, অথবা আপনি এই সাইটে (বা অন্য কোনো সাইটে) আপনার সেটিংস পুনরুদ্ধার করতে এটি ব্যবহার করতে পারেন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7417, 'bd', 'copy_to_clipboard', 'ক্লিপবোর্ডে কপি করুন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7418, 'bd', 'export_file', 'ফাইল রপ্তানি করুন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7419, 'bd', 'custom_footer_style', 'কাস্টম ফুটার শৈলী', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7420, 'bd', 'set_custom_footer_style', 'কাস্টম ফুটার শৈলী সেট করুন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7421, 'bd', 'footer_background_color', 'পাদচরণ পটভূমির রঙ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7422, 'bd', 'set_footer_background_color', 'ফুটারের পটভূমির রঙ সেট করুন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7423, 'bd', 'select_color', 'রঙ নির্বাচন করুন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7424, 'bd', 'transparent', 'স্বচ্ছ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7425, 'bd', 'custom_footer_padding', 'কাস্টম ফুটার প্যাডিং.', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7426, 'bd', 'set_footer_padding', 'ফুটার প্যাডিং সেট করুন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7427, 'bd', 'footer_social_enabledisable', 'ফুটার সামাজিক সক্ষম/অক্ষম করুন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7428, 'bd', 'set_enable_to_show_footer_social', 'ফুটার সোশ্যাল দেখাতে সক্ষম সেট করুন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7429, 'bd', 'footer_social_color', 'ফুটার সামাজিক রঙ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7430, 'bd', 'set_footer_social_color', 'ফুটার সামাজিক রঙ সেট করুন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7431, 'bd', 'footer_social_hover_color', 'পাদলেখ সামাজিক হোভার রঙ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7432, 'bd', 'footer_social_alignment', 'ফুটার সামাজিক প্রান্তিককরণ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7433, 'bd', 'set_footer_social_alignment_position', 'ফুটার সামাজিক প্রান্তিককরণ অবস্থান সেট করুন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7434, 'bd', 'footer_logo_enabledisable', 'ফুটার লোগো সক্ষম/অক্ষম করুন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7435, 'bd', 'set_enable_to_show_footer_logo_header_logo_will_be_set_as_footer_logo', 'ফুটার লোগো দেখানোর জন্য সক্ষম সেট করুন (হেডার লোগো ফুটার লোগো হিসাবে সেট করা হবে)।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7436, 'bd', 'footer_logo_anchor_url', 'ফুটার লোগো অ্যাঙ্কর URL', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7437, 'bd', 'set_footer_logo_anchor_urldefault_is_home_url', 'ফুটার লোগো অ্যাঙ্কর ইউআরএল সেট করুন (ডিফল্ট হল হোম ইউআরএল)', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7438, 'bd', 'footer_logo_alignment', 'ফুটার লোগো প্রান্তিককরণ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7439, 'bd', 'set_enable_to_show_footer_logo_alignment', 'ফুটার লোগো অ্যালাইনমেন্ট দেখানোর জন্য সক্ষম সেট করুন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7440, 'bd', 'footer_text_enabledisable', 'ফুটার টেক্সট সক্ষম/অক্ষম করুন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7441, 'bd', 'set_enable_to_show_footer_copyright_text', 'ফুটার কপিরাইট টেক্সট দেখানোর জন্য সক্ষম সেট করুন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7442, 'bd', 'footer_copyright_text_alignment', 'ফুটার কপিরাইট টেক্সট প্রান্তিককরণ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7443, 'bd', 'set_enable_to_show_footer_text_alignment', 'ফুটার টেক্সট অ্যালাইনমেন্ট দেখাতে সক্ষম সেট করুন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7444, 'bd', 'footer_copyright_text_color', 'ফুটার কপিরাইট টেক্সট রঙ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7445, 'bd', 'set_footer_text_color', 'ফুটার টেক্সট রঙ সেট করুন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7446, 'bd', 'footer_copyright_anchor_text_color', 'ফুটার কপিরাইট অ্যাঙ্কর টেক্সট রঙ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7447, 'bd', 'set_footer_anchor_text_color', 'ফুটার অ্যাঙ্কর টেক্সট রঙ সেট করুন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7448, 'bd', 'footer_copyright_anchor_text_hover_color', 'ফুটার কপিরাইট অ্যাঙ্কর টেক্সট হোভার রঙ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7449, 'bd', 'set_footer_anchor_text_hover_color', 'ফুটার অ্যাঙ্কর টেক্সট হোভার রঙ সেট করুন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7450, 'bd', 'mailchimp_api_key', 'Mailchimp API কী', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7451, 'bd', 'set_mailchimp_api_key', 'mailchimp api কী সেট করুন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7452, 'bd', 'mailchimp_list_id', 'Mailchimp তালিকা আইডি', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7453, 'bd', 'set_mailchimp_list_id', 'mailchimp তালিকা আইডি সেট করুন.', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7454, 'bd', 'footer_subscribe_form', 'পাদচরণ সাবস্ক্রাইব ফর্ম', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7455, 'bd', 'set_enable_to_display_subscribe_form_in_footer', 'সাবস্ক্রাইব ফর্ম ফুটারে প্রদর্শন করতে সক্ষম সেট করুন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7456, 'bd', 'form_title', 'ফর্ম শিরোনাম', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7457, 'bd', 'form_placeholder', 'ফর্ম স্থানধারক', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7458, 'bd', 'form_button_text', 'ফর্ম বোতাম পাঠ্য', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7459, 'bd', 'privacy_policy', 'গোপনীয়তা নীতি', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7460, 'bd', 'set_enable_to_display_privacy_policy_button', 'গোপনীয়তা নীতি বোতাম প্রদর্শন করতে সক্ষম সেট করুন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43');
INSERT INTO `tl_translations` (`id`, `lang`, `lang_key`, `lang_value`, `created_at`, `updated_at`) VALUES
(7461, 'bd', 'privacy_policy_page', 'গোপনীয়তা নীতি পৃষ্ঠা', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7462, 'bd', 'select_privacy_policy_page', 'গোপনীয়তা নীতি পৃষ্ঠা নির্বাচন করুন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7463, 'bd', 'custom_footer_subscribe_style', 'কাস্টম ফুটার সদস্যতা শৈলী', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7464, 'bd', 'set_custom_footer_subscribe_style', 'কাস্টম ফুটার সদস্যতা শৈলী সেট করুন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7465, 'bd', 'form_privacy_text_color', 'ফর্ম গোপনীয়তা টেক্সট রঙ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7466, 'bd', 'if_privacy_policy_switch_is_enabled', 'যদি গোপনীয়তা নীতি সুইচ সক্ষম করা থাকে', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7467, 'bd', 'form_privacy_text_anchor_color', 'ফর্ম গোপনীয়তা টেক্সট অ্যাঙ্কর রঙ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7468, 'bd', 'form_background_color', 'ফর্ম পটভূমির রঙ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7469, 'bd', 'form_title_color', 'ফর্ম শিরোনামের রঙ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7470, 'bd', 'form_input_background_color', 'ফর্ম ইনপুট পটভূমির রঙ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7471, 'bd', 'form_submit_button_color', 'ফর্ম জমা বোতাম রঙ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7472, 'bd', 'form_submit_button_background_color', 'ফর্ম জমা দেওয়ার বোতামের পটভূমির রঙ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7473, 'bd', 'switch_enabled_to_display_preloader', 'ডিসপ্লে প্রিলোডারে স্যুইচ সক্ষম।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7474, 'bd', 'preloader_style_type', 'প্রিলোডার স্টাইল টাইপ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7475, 'bd', 'control_preloader_style_type_if_you_use_this_option_then_you_will_able_to_set_lot_of_preloader_style', 'আপনি যদি এই বিকল্পটি ব্যবহার করেন তাহলে আপনি অনেক প্রিলোডার স্টাইল সেট করতে পারবেন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7476, 'bd', 'custom_preloader_type', 'কাস্টম প্রিলোডার টাইপ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7477, 'bd', 'image_type__text_type', 'ইমেজ টাইপ - টেক্সট টাইপ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7478, 'bd', 'set_custom_preloader_type', 'কাস্টম প্রিলোডার টাইপ সেট করুন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7479, 'bd', 'preloader_image', 'প্রিলোডার ইমেজ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7480, 'bd', 'set_preloader_image', 'প্রিলোডার ইমেজ সেট করুন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7481, 'bd', 'preloader_heading_tag', 'প্রিলোডার হেডিং ট্যাগ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7482, 'bd', 'set_preloader_heading_tag', 'প্রিলোডার হেডিং ট্যাগ সেট করুন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7483, 'bd', 'preloader_text', 'প্রিলোডার পাঠ্য', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7484, 'bd', 'set_preloader_text', 'প্রিলোডার টেক্সট সেট করুন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7485, 'bd', 'preloader_item_color', 'প্রিলোডার আইটেমের রঙ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7486, 'bd', 'set_preloader_item_color', 'প্রিলোডার আইটেমের রঙ সেট করুন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7487, 'bd', 'preloader_background_color', 'প্রিলোডার পটভূমির রঙ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7488, 'bd', 'set_preloader_background_color', 'প্রিলোডার ব্যাকগ্রাউন্ড কালার সেট করুন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7489, 'bd', 'theme_option_saved', 'থিম বিকল্প সংরক্ষিত', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7490, 'bd', 'custom_blog_style', 'কাস্টম ব্লগ শৈলী', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7491, 'bd', 'set_custom_blog_style', 'কাস্টম ব্লগ শৈলী সেট করুন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7492, 'bd', 'layout', 'লেআউট', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7493, 'bd', 'choose_blog_layout_from_here_if_you_use_this_option_then_you_will_able_to_change_three_type_of_blog_layout__default_right_sidebar_layout_', 'আপনি যদি এই বিকল্পটি ব্যবহার করেন তবে আপনি তিন ধরনের ব্লগ লেআউট পরিবর্তন করতে পারবেন (ডিফল্ট ডান সাইডবার লেআউট)।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7494, 'bd', 'blog_column', 'ব্লগ কলাম', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7495, 'bd', 'select_your_blog_post_column_from_here_if_you_use_this_option_then_you_will_able_to_select_three_type_of_blog_colum_layout__default_one_column_', 'আপনি যদি এই বিকল্পটি ব্যবহার করেন তবে আপনি তিন ধরনের ব্লগ কলাম বিন্যাস (ডিফল্ট ওয়ান কলাম) নির্বাচন করতে পারবেন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7496, 'bd', 'select_blog_post_style', 'ব্লগ পোস্ট শৈলী নির্বাচন করুন.', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7497, 'bd', 'blog_page_title', 'ব্লগ পাতা শিরোনাম', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7498, 'bd', 'control_blog_page_title_show__hide_if_you_use_this_option_then_you_will_able_to_show__hide_your_blog_page_title__default_setting_show_', 'আপনি যদি এই বিকল্পটি ব্যবহার করেন তাহলে আপনি আপনার ব্লগ পৃষ্ঠার শিরোনাম (ডিফল্ট সেটিং শো) দেখাতে/লুকাতে পারবেন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7499, 'bd', 'blog_page_title_setting', 'ব্লগ পৃষ্ঠার শিরোনাম সেটিং', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7500, 'bd', 'control_blog_page_title_setting_if_you_use_this_option_then_you_can_able_to_show_default_or_custom_blog_page_title__default_blog_', 'আপনি যদি এই বিকল্পটি ব্যবহার করেন তবে আপনি ডিফল্ট বা কাস্টম ব্লগ পৃষ্ঠার শিরোনাম (ডিফল্ট ব্লগ) দেখাতে পারবেন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7501, 'bd', 'blog_custom_title', 'ব্লগ কাস্টম শিরোনাম', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7502, 'bd', 'set_blog_page_custom_title_form_here_if_you_use_this_option_then_you_will_able_to_set_your_won_title_text', 'আপনি যদি এই বিকল্পটি ব্যবহার করেন তবে আপনি আপনার জয়ী শিরোনাম পাঠ্য সেট করতে সক্ষম হবেন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7503, 'bd', 'blog_posts_excerpt', 'ব্লগ পোস্ট উদ্ধৃতি', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7504, 'bd', 'control_the_number_of_characters_you_want_to_show_in_the_blog_page_for_each_post_if_you_use_this_option_then_you_can_able_to_control_your_blog_post_characters_from_heredefault_50_character', 'প্রতিটি পোস্টের জন্য ব্লগ পৃষ্ঠায় আপনি কতগুলি অক্ষর দেখাতে চান তা নিয়ন্ত্রণ করুন.. আপনি যদি এই বিকল্পটি ব্যবহার করেন তবে আপনি এখান থেকে আপনার ব্লগ পোস্টের অক্ষরগুলি নিয়ন্ত্রণ করতে পারবেন৷ (ডিফল্ট 50 অক্ষর)', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7505, 'bd', 'blog_perpage_number', 'ব্লগ PerPage নম্বর', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7506, 'bd', 'control_the_number_blogs_to_show_on_each_page__default_show_10_', 'প্রতিটি পৃষ্ঠায় দেখানোর জন্য সংখ্যা ব্লগ নিয়ন্ত্রণ করুন (ডিফল্ট দেখান 10)।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7507, 'bd', 'read_more_text_setting', 'আরও পাঠ্য সেটিং পড়ুন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7508, 'bd', 'control_read_more_text_from_here', 'এখান থেকে আরও পাঠ্য পড়ুন নিয়ন্ত্রণ করুন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7509, 'bd', 'read_more_text', 'আরও পাঠ্য পড়ুন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7510, 'bd', 'set_read_moer_text_here_if_you_use_this_option_then_you_will_able_to_set_your_won_text', 'আপনি যদি এই বিকল্পটি ব্যবহার করেন তবে আপনি আপনার জয়ী পাঠ্য সেট করতে সক্ষম হবেন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7511, 'bd', 'blog_pagination_settings', 'ব্লগ পেজিনেশন সেটিংস', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7512, 'bd', 'set_blog_pagination_number_pagination_or_link_pagination', 'সংখ্যা পাতাকরণ বা লিঙ্ক পেজিনেশন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7513, 'bd', 'blog_pagination_position', 'ব্লগ পেজিনেশন অবস্থান', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7514, 'bd', 'set_blog_pagination_position', 'ব্লগ পেজিনেশন অবস্থান সেট করুন.', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7515, 'bd', 'blog_pagination_active_color', 'ব্লগ পেজিনেশন সক্রিয় রঙ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7516, 'bd', 'set_blog_pagination_active_color', 'ব্লগ পেজিনেশন সক্রিয় রঙ সেট করুন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7517, 'bd', 'blog_pagination_active_background_color', 'ব্লগ পেজিনেশন সক্রিয় পটভূমির রঙ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7518, 'bd', 'set_blog_pagination_active_background_color', 'ব্লগ পেজিনেশন সক্রিয় পটভূমির রঙ সেট করুন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7519, 'bd', 'blog_pagination_color', 'ব্লগ পেজিনেশন রঙ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7520, 'bd', 'set_blog_pagination_color', 'ব্লগ পেজিনেশন রঙ সেট করুন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7521, 'bd', 'blog_pagination_background_color', 'ব্লগ পেজিনেশন ব্যাকগ্রাউন্ড কালার', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7522, 'bd', 'set_blog_pagination_background_color', 'ব্লগ পেজিনেশন ব্যাকগ্রাউন্ড কালার সেট করুন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7523, 'bd', 'blog_pagination_hover_color', 'ব্লগ পেজিনেশন হোভার রঙ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7524, 'bd', 'set_blog_pagination_hover_color', 'ব্লগ পেজিনেশন হোভার রঙ সেট করুন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7525, 'bd', 'blog_pagination_hover_background_color', 'ব্লগ পেজিনেশন হোভার ব্যাকগ্রাউন্ড কালার', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7526, 'bd', 'set_blog_pagination_hover_background_color', 'সেট ব্লগ পেজিনেশন হোভার ব্যাকগ্রাউন্ড কালার।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7527, 'bd', 'custom_single_blog_page', 'কাস্টম একক ব্লগ পাতা', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7528, 'bd', 'set_custom_single_blog_style', 'কাস্টম একক ব্লগ শৈলী সেট করুন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7529, 'bd', 'choose_blog_single_page_layout_from_here_if_you_use_this_option_then_you_will_able_to_change_three_type_of_blog_single_page_layout__default_right_sidebar_layout_', 'আপনি যদি এই বিকল্পটি ব্যবহার করেন তাহলে আপনি তিন ধরনের ব্লগ একক পৃষ্ঠার বিন্যাস (ডিফল্ট ডান সাইডবার লেআউট) পরিবর্তন করতে পারবেন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7530, 'bd', 'blog_post_title_position', 'ব্লগ পোস্ট শিরোনাম অবস্থান', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7531, 'bd', 'control_blog_post_title_position_from_here', 'এখান থেকে ব্লগ পোস্টের শিরোনামের অবস্থান নিয়ন্ত্রণ করুন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7532, 'bd', 'blog_details_custom_title', 'ব্লগ বিবরণ কাস্টম শিরোনাম', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7533, 'bd', 'this_title_will_show_in_breadcrumb_title', 'এই শিরোনাম ব্রেডক্রাম্ব শিরোনামে দেখাবে।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7534, 'bd', 'author', 'লেখক', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7535, 'bd', 'switch_on_to_display_author', 'ডিসপ্লে লেখকে স্যুইচ অন করুন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7536, 'bd', 'date', 'তারিখ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7537, 'bd', 'switch_on_to_display_date', 'প্রদর্শনের তারিখে স্যুইচ অন করুন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7538, 'bd', 'reading_time', 'পড়ার সময়', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7539, 'bd', 'switch_on_to_display_reading_time', 'রিডিং টাইম প্রদর্শনে স্যুইচ অন করুন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7540, 'bd', 'category', 'শ্রেণী', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7541, 'bd', 'switch_on_to_display_category', 'ডিসপ্লে ক্যাটাগরিতে স্যুইচ অন করুন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7542, 'bd', 'switch_on_to_display_tags', 'প্রদর্শন ট্যাগ চালু করুন.', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7543, 'bd', 'switch_on_to_display_comments', 'ডিসপ্লে কমেন্টে স্যুইচ অন করুন।', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7544, 'bd', 'biography_info', 'জীবনী তথ্য', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7545, 'bd', 'control_biography_info_from_here_if_you_use_this_option_then_you_will_able_to_show_ro_hide_biography_info', 'আপনি যদি এই অপশনটি ব্যবহার করেন তাহলে আপনি রো হাইড বায়োগ্রাফি ইনফো দেখাতে পারবেন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7546, 'bd', 'custom_sidebar_style', 'কাস্টম সাইডবার স্টাইল', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7547, 'bd', 'switch_on_for_custom_sidebar_style', 'কাস্টম সাইডবার শৈলী জন্য সুইচ অন.', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7548, 'bd', 'widgets_background_color', 'উইজেট পটভূমির রঙ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7549, 'bd', 'box_shadow', 'বক্স ছায়া', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7550, 'bd', 'offset_x', 'অফসেট এক্স', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7551, 'bd', 'offset_y', 'অফসেট Y', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7552, 'bd', 'blur_radius', 'ব্লার ব্যাসার্ধ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7553, 'bd', 'spread_radius', 'ব্যাসার্ধ ছড়িয়ে দিন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7554, 'bd', 'opcacity_11', 'অপাপ্যাসিটি .1-1', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7555, 'bd', 'units', 'ইউনিট', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7556, 'bd', 'shadow_color', 'ছায়া রঙ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7557, 'bd', 'shadow_type', 'ছায়ার ধরন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7558, 'bd', 'widget_margin', 'উইজেট মার্জিন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7559, 'bd', 'widget_padding', 'উইজেট প্যাডিং', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7560, 'bd', 'widget_border', 'উইজেট বর্ডার', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7561, 'bd', 'widget_title_tag', 'উইজেট শিরোনাম ট্যাগ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7562, 'bd', 'widget_title_typography', 'উইজেট শিরোনাম টাইপোগ্রাফি', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7563, 'bd', 'font_family', 'ফন্ট পরিবার', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7564, 'bd', 'select__fonts', 'ফন্ট নির্বাচন করুন', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7565, 'bd', 'custom_font_1', 'কাস্টম ফন্ট 1', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7566, 'bd', 'custom_font_2', 'কাস্টম ফন্ট 2', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7567, 'bd', 'google_web_fonts', 'গুগল ওয়েব ফন্ট', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7568, 'bd', 'font_weight__style', 'ফন্ট ওজন এবং শৈলী', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7569, 'bd', 'font_subsets', 'ফন্ট সাবসেট', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7570, 'bd', 'text_align', 'পাঠ্য সারিবদ্ধ', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7571, 'bd', 'text_transform', 'পাঠ্য রূপান্তর', '2023-05-13 06:34:43', '2023-05-13 06:34:43'),
(7573, 'bd', 'font_size', 'অক্ষরের আকার', '2023-05-13 06:36:37', '2023-05-13 06:37:40'),
(7574, 'bd', 'size', 'আকার', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7575, 'bd', 'line_height', 'লাইনের উচ্চতা', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7576, 'bd', 'height', 'উচ্চতা', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7577, 'bd', 'word_spacing', 'শব্দ ব্যবধান', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7578, 'bd', 'letter_spacing', 'অক্ষর ব্যবধান', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7579, 'bd', 'the_quick_brown_fox_jumps_over_the_lazy_dog', 'কুইক ব্রাউন ফক্স অলস কুকুরের উপর ঝাঁপ দেয়', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7580, 'bd', 'widget_title_margin', 'উইজেট শিরোনাম মার্জিন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7581, 'bd', 'widget_title_padding', 'উইজেট শিরোনাম প্যাডিং', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7582, 'bd', 'widget_title_color', 'উইজেট শিরোনামের রঙ', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7583, 'bd', 'set_widget_title_color', 'উইজেট শিরোনামের রঙ সেট করুন।', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7584, 'bd', 'widget_text_color', 'উইজেট পাঠ্যের রঙ', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7585, 'bd', 'set_widget_text_color', 'উইজেট পাঠ্যের রঙ সেট করুন।', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7586, 'bd', 'widget_anchor_color', 'উইজেট অ্যাঙ্কর রঙ', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7587, 'bd', 'set_widget_anchor_color', 'উইজেট অ্যাঙ্কর রঙ সেট করুন।', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7588, 'bd', 'widget_anchor_hover_color', 'উইজেট অ্যাঙ্কর হোভার রঙ', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7589, 'bd', 'set_widget_anchor_hover_color', 'উইজেট অ্যাঙ্কর হোভার রঙ সেট করুন।', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7590, 'bd', 'custom_page_style', 'কাস্টম পৃষ্ঠা শৈলী', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7591, 'bd', 'set_custom_page_style', 'কাস্টম পৃষ্ঠা শৈলী সেট করুন।', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7592, 'bd', 'choose_your_page_layout_if_you_use_this_option_then_you_will_able_to_choose_three_type_of_page_layout__default_no_sidebar_', 'আপনি যদি এই অপশনটি ব্যবহার করেন তাহলে আপনি তিন ধরনের পেজ লেআউট বেছে নিতে পারবেন (ডিফল্ট কোন সাইডবার নয়)।', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7593, 'bd', 'sidebar_settings', 'সাইডবার সেটিংস', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7594, 'bd', 'set_page_sidebar_if_you_use_this_option_then_you_will_able_to_set_three_type_of_sidebar__default_no_sidebar_', 'আপনি যদি এই বিকল্পটি ব্যবহার করেন তাহলে আপনি তিন ধরনের সাইডবার সেট করতে পারবেন (ডিফল্ট কোন সাইডবার)।', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7595, 'bd', 'page_sidebar', 'পৃষ্ঠা সাইডবার', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7596, 'bd', 'blog_sidebar', 'ব্লগ সাইডবার', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7597, 'bd', 'switch_enabled_to_display_page_title_fot_this_option_you_will_able_to_show__hide_page_title_default_setting_enabled', 'ডিফল্ট সেটিং সক্ষম', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7598, 'bd', 'title_tag', 'শিরোনাম ট্যাগ', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7599, 'bd', 'select_page_title_tag_if_you_use_this_option_then_you_can_able_to_change_title_tag_h1__h6__default_tag_h1_', 'আপনি যদি এই বিকল্পটি ব্যবহার করেন তবে আপনি শিরোনাম ট্যাগ H1 - H6 (ডিফল্ট ট্যাগ H1) পরিবর্তন করতে পারবেন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7600, 'bd', 'font_settings', 'ফন্ট সেটিংস', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7601, 'bd', 'select_font_setting_for_page_title_if_you_use_this_options_then_you_will_able_to_change_font_weight_text_align_text_transform_font_size_line_height_word_spacing_letter_spacing', 'আপনি যদি এই বিকল্পগুলি ব্যবহার করেন তবে আপনি ফন্টের ওজন, টেক্সট অ্যালাইন, টেক্সট ট্রান্সফর্ম, ফন্ট সাইজ, লাইন হাইট, ওয়ার্ড স্পেসিং, লেটার স্পেসিং পরিবর্তন করতে পারবেন।', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7602, 'bd', 'setting_page_header_background_if_you_use_this_option_then_you_will_able_to_set_background_color_background_image_background_repeat_background_size_background_attachment_background_position', 'আপনি যদি এই বিকল্পটি ব্যবহার করেন তবে আপনি ব্যাকগ্রাউন্ড কালার, ব্যাকগ্রাউন্ড ইমেজ, ব্যাকগ্রাউন্ড রিপিট, ব্যাকগ্রাউন্ড সাইজ, ব্যাকগ্রাউন্ড অ্যাটাচমেন্ট, ব্যাকগ্রাউন্ড পজিশন সেট করতে পারবেন।', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7603, 'bd', 'select_background_repeat', 'ব্যাকগ্রাউন্ড রিপিট নির্বাচন করুন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7604, 'bd', 'select_background_size', 'ব্যাকগ্রাউন্ড সাইজ সিলেক্ট করুন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7605, 'bd', 'background_attachment', 'পৃষ্ঠভূমি সংযুক্তি', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7606, 'bd', 'select_background_attachment', 'ব্যাকগ্রাউন্ড অ্যাটাচমেন্ট সিলেক্ট করুন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7607, 'bd', 'select_background_position', 'ব্যাকগ্রাউন্ড পজিশন সিলেক্ট করুন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7608, 'bd', 'overlay', 'ওভারলে', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7609, 'bd', 'check_this_check_box_to_use_overlay_if_you_use_this_option_then_you_will_able_to_use_background_overlay', 'আপনি যদি এই বিকল্পটি ব্যবহার করেন তাহলে আপনি ব্যাকগ্রাউন্ড ওভারলে ব্যবহার করতে পারবেন।', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7610, 'bd', 'overlay_background', 'ওভারলে পটভূমি', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7611, 'bd', 'choose_overlay_background_color_if_you_user_this_option_then_you_will_able_to_choose_overlay_background_color', 'আপনি যদি এই বিকল্পটি ব্যবহার করেন তবে আপনি ওভারলে পটভূমির রঙ চয়ন করতে পারবেন।', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7612, 'bd', 'opacity', 'অস্বচ্ছতা', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7613, 'bd', 'setting_overlay_opacity_if_you_use_this_option_then_you_will_able_to_show_light_to_dark_overlay_background_color__default_opacity_05_', 'আপনি যদি এই বিকল্পটি ব্যবহার করেন তবে আপনি আলো থেকে অন্ধকার ওভারলে পটভূমির রঙ দেখাতে সক্ষম হবেন (ডিফল্ট অপাসিটি 0.5)।', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7614, 'bd', 'breadcrumb_hideshow', 'ব্রেডক্রাম্ব লুকান/দেখান', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7615, 'bd', 'hide__show_breadcrumb_from_all_pages_and_posts__default_settings_show_', 'সমস্ত পৃষ্ঠা এবং পোস্ট থেকে ব্রেডক্রাম্ব লুকান / দেখান (ডিফল্ট সেটিংস দেখায়)।', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7616, 'bd', 'breadcrumb_color', 'ব্রেডক্রাম্ব রঙ', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7617, 'bd', 'choose_page_header_breadcrumb_text_color_hereif_you_user_this_option_then_you_will_able_to_set_page_breadcrumb_color', 'এখানে পেজ হেডার ব্রেডক্রাম্ব টেক্সট কালার বেছে নিন। আপনি যদি এই অপশনটি ব্যবহার করেন তাহলে আপনি পেজ ব্রেডক্রাম্ব কালার সেট করতে পারবেন।', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7618, 'bd', 'breadcrumb_active_color', 'ব্রেডক্রাম্ব সক্রিয় রঙ', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7619, 'bd', 'choose_page_header_breadcrumb_text_active_color_hereif_you_user_this_option_then_you_will_able_to_set_page_breadcrumb_active_color', 'এখানে পৃষ্ঠা হেডার ব্রেডক্রাম্ব টেক্সট সক্রিয় রঙ চয়ন করুন৷ আপনি যদি এই বিকল্পটি ব্যবহার করেন তবে আপনি পৃষ্ঠা ব্রেডক্রাম্ব সক্রিয় রঙ সেট করতে সক্ষম হবেন৷', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7620, 'bd', 'breadcrumb_divider_color', 'ব্রেডক্রাম্ব ডিভাইডার রঙ', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7621, 'bd', 'choose_breadcrumb_divider_color_if_you_use_this_option_then_you_will_able_to_use_breadcrumb_color__default_color__', 'আপনি যদি এই বিকল্পটি ব্যবহার করেন তবে আপনি ব্রেডক্রাম্ব রঙ ব্যবহার করতে পারবেন (ডিফল্ট রঙ)', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7622, 'bd', 'custom_404_style', 'কাস্টম 404 শৈলী', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7623, 'bd', 'set_custom_404', 'কাস্টম 404 সেট করুন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7624, 'bd', 'page_title', 'আমার স্নাতকের', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7625, 'bd', 'set_page_title', 'পৃষ্ঠার শিরোনাম সেট করুন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7626, 'bd', 'page_subtitle', 'পৃষ্ঠা সাবটাইটেল', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7627, 'bd', 'set_page_subtitle', 'পৃষ্ঠা সাবটাইটেল সেট করুন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7628, 'bd', 'button_before_text', 'টেক্সটের আগে বোতাম', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7629, 'bd', 'button_text', 'বোতাম পাঠ্য', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7630, 'bd', 'page_background_with_image_color_etc', 'ছবি, রঙ ইত্যাদি সহ পৃষ্ঠার পটভূমি', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7631, 'bd', 'background_overlay', 'ব্যাকগ্রাউন্ড ওভারলে', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7632, 'bd', 'set_background_ovelay', 'ব্যাকগ্রাউন্ড ওভলে সেট করুন।', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7633, 'bd', 'overlay_color', 'ওভারলে রঙ', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7634, 'bd', 'set_overlay_color', 'ওভারলে রঙ সেট করুন।', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7635, 'bd', 'overlay_opacity', 'ওভারলে অস্বচ্ছতা', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7636, 'bd', 'set_overlay_opacity', 'ওভারলে অস্বচ্ছতা সেট করুন।', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7637, 'bd', 'pick_a_title_color', 'একটি শিরোনাম রঙ চয়ন করুন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7638, 'bd', 'subtitle_color', 'সাবটাইটেল রঙ', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7639, 'bd', 'pick_a_subtitle_color', 'একটি সাবটাইটেল রঙ চয়ন করুন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7640, 'bd', 'before_button_text_color', 'বোতাম টেক্সট রঙের আগে', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7641, 'bd', 'pick_before_button_text_color', 'বোতাম পাঠ্যের রঙের আগে বাছুন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7642, 'bd', 'before_button_color', 'বোতাম রঙের আগে', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7643, 'bd', 'pick_before_button_color', 'বোতামের রঙের আগে বেছে নিন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7644, 'bd', 'before_button_hover_color', 'বোতাম হোভার রঙের আগে', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7645, 'bd', 'pick_before_button_hover_color', 'বোতাম হোভার রঙের আগে বেছে নিন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7646, 'bd', 'social_profile_links', 'সামাজিক প্রোফাইল লিঙ্ক', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7647, 'bd', 'add_social_icon_and_url', 'সামাজিক আইকন এবং ইউআরএল যোগ করুন।', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7648, 'bd', 'add_slide', 'স্লাইড যোগ করুন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7649, 'bd', 'css_code', 'CSS কোড', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7650, 'bd', 'paste_your_css_code_here', 'এখানে আপনার CSS কোড পেস্ট করুন।', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7651, 'bd', 'you_can_not_change_status_of_this_language', 'আপনি এই ভাষার অবস্থা পরিবর্তন করতে পারবেন না', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7652, 'bd', 'language_status_updated_successfully', 'ভাষার স্থিতি সফলভাবে আপডেট হয়েছে৷', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7653, 'bd', 'login', 'প্রবেশ করুন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7654, 'bd', 'login_to', 'লগ ইন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7655, 'bd', 'email', 'ইমেইল', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7656, 'bd', 'email_address', 'ইমেইল ঠিকানা', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7657, 'bd', 'password', 'পাসওয়ার্ড', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7658, 'bd', 'forgot_password', 'পাসওয়ার্ড ভুলে গেছেন?', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7659, 'bd', 'log_in', 'প্রবেশ করুন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7660, 'bd', 'email_is_required', 'ইমেল প্রয়োজন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7661, 'bd', 'invalid_email_address', 'অকার্যকর ইমেইল ঠিকানা', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7662, 'bd', 'password_is_required', 'পাসওয়ার্ড প্রয়োজন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7663, 'bd', 'login_successful', 'সফল লগইন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7664, 'bd', 'total_blogs', 'মোট ব্লগ', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7665, 'bd', 'total_pages', 'মোট পৃষ্ঠা', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7666, 'bd', 'total_category', 'মোট বিভাগ', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7667, 'bd', 'total_comments', 'মোট মন্তব্য', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7668, 'bd', 'visitors_reports', 'ভিজিটর রিপোর্ট', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7669, 'bd', 'monthly', 'মাসিক', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7670, 'bd', 'daily', 'দৈনিক', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7671, 'bd', 'blog_status', 'ব্লগের অবস্থা', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7672, 'bd', 'published', 'প্রকাশিত হয়েছে', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7673, 'bd', 'scheduled', 'তালিকাভুক্ত', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7674, 'bd', 'drafts', 'খসড়া', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7675, 'bd', 'pending', 'বিচারাধীন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7676, 'bd', 'featured', 'বৈশিষ্ট্যযুক্ত', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7677, 'bd', 'recent_comments', 'সাম্প্রতিক মন্তব্য', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7678, 'bd', 'comment', 'মন্তব্য করুন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7679, 'bd', 'submitted_on', 'জমা দেওয়া হয়', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7680, 'bd', 'in_reply_to', 'এর উত্তরে', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7681, 'bd', 'popular_categories', 'জনপ্রিয় বিভাগ', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7682, 'bd', 'latest_pages', 'সর্বশেষ পৃষ্ঠাগুলি', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7683, 'bd', 'manage_widgets', 'উইজেট পরিচালনা করুন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7684, 'bd', 'available_widgets', 'উপলব্ধ উইজেট', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7685, 'bd', 'add_widget', 'উইজেট যোগ করুন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7686, 'bd', 'adding_widget_to_sidebar_failed', 'সাইডবারে উইজেট যোগ করা ব্যর্থ হয়েছে৷', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7687, 'bd', 'sidebar_widget_opening_failed', 'সাইডবার উইজেট খোলা ব্যর্থ হয়েছে৷', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7688, 'bd', 'widget_added_to_sidebar_failed', 'সাইডবারে উইজেট যোগ করা ব্যর্থ হয়েছে৷', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7689, 'bd', 'widget_form_submit_failed_failed', 'উইজেট ফর্ম জমা দিতে ব্যর্থ হয়েছে', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7690, 'bd', 'select_a_user_for_authur_widget', 'Authur উইজেটের জন্য একজন ব্যবহারকারী নির্বাচন করুন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7691, 'bd', 'done', 'সম্পন্ন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7692, 'bd', 'widget_title', 'উইজেট শিরোনাম', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7693, 'bd', 'number_of_featured_blog', 'বৈশিষ্ট্যযুক্ত ব্লগের সংখ্যা', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7694, 'bd', 'widget_form_saved', 'উইজেট ফর্ম সংরক্ষিত', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7695, 'bd', 'title_placeholder', 'শিরোনাম স্থানধারক', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7696, 'bd', 'add_information', 'তথ্য যোগ করুন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7697, 'bd', 'newsletter_short_desc', 'নিউজলেটার সংক্ষিপ্ত বিবরণ', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7698, 'bd', 'number_of_recent_blog', 'সাম্প্রতিক ব্লগের সংখ্যা', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7699, 'bd', 'per_slide_number', 'প্রতি স্লাইড নম্বর', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7700, 'bd', 'total_blog_number', 'মোট ব্লগ সংখ্যা', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7701, 'bd', 'number_of_tags', 'ট্যাগের সংখ্যা', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7702, 'bd', 'number_of_tag', 'ট্যাগের সংখ্যা', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7703, 'bd', 'site_title', 'সাইট শিরোনাম', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7704, 'bd', 'site_motto', 'সাইটের নীতিবাক্য', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7705, 'bd', 'site_moto', 'সাইট মোটো', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7706, 'bd', 'logo', 'লোগো', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7707, 'bd', 'choose_image', 'ইমেজ চয়ন করুন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7708, 'bd', 'logo_mobile', 'লোগো (মোবাইল)', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7709, 'bd', 'dark_logo', 'গাঢ় লোগো', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7710, 'bd', 'dark_logo_mobile', 'গাঢ় লোগো (মোবাইল)', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7711, 'bd', 'sticky_logo', 'স্টিকি লোগো', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7712, 'bd', 'sticky_logo_mobile', 'স্টিকি লোগো (মোবাইল)', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7713, 'bd', 'dark_sticky_logo', 'গাঢ় স্টিকি লোগো', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7714, 'bd', 'dark_sticky_logo_mobile', 'গাঢ় স্টিকি লোগো (মোবাইল)', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7715, 'bd', 'admin_logo', 'অ্যাডমিন লোগো', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7716, 'bd', 'admin_logo_mobile', 'অ্যাডমিন লোগো (মোবাইল)', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7717, 'bd', 'admin_dark_logo', 'অ্যাডমিন ডার্ক লোগো', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7718, 'bd', 'admin_dark_logo_mobile', 'অ্যাডমিন ডার্ক লোগো (মোবাইল)', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7719, 'bd', 'favicon', 'ফেভিকন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7720, 'bd', 'default_language', 'নির্ধারিত ভাষা', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7721, 'bd', 'select_default_language', 'ডিফল্ট ভাষা নির্বাচন করুন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7722, 'bd', 'select_default_timezone', 'ডিফল্ট টাইমজোন নির্বাচন করুন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7723, 'bd', 'copyright_text', 'কপিরাইট টেক্সট', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7724, 'bd', 'submit', 'জমা দিন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7725, 'bd', 'site_seo__settings', 'সাইট এসইও সেটিংস', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7726, 'bd', 'meta_title', 'মেটা শিরোনাম', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7727, 'bd', 'meta_description', 'মেটা বর্ণনা', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7728, 'bd', 'meta_keywords', 'মেটা কীওয়ার্ড', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7729, 'bd', 'meta_image', 'মেটা ইমেজ', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7730, 'bd', 'email_placeholder', 'ইমেল স্থানধারক', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7731, 'bd', 'edit_language', 'ভাষা সম্পাদনা করুন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7732, 'bd', 'update_language_information', 'ভাষার তথ্য আপডেট করুন', '2023-05-13 06:36:37', '2023-05-13 06:36:37'),
(7733, 'bd', 'type_name', 'নাম টাইপ করুন', '2023-05-13 06:36:38', '2023-05-13 06:37:41'),
(7734, 'bd', 'type__native_name', 'নেটিভ নাম টাইপ করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7735, 'bd', 'update', 'হালনাগাদ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7736, 'bd', 'name_is_required', 'নাম আবশ্যক', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7737, 'bd', 'code_is_required', 'কোড প্রয়োজন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7738, 'bd', 'language_updated_successfully', 'ভাষা সফলভাবে আপডেট হয়েছে', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7739, 'bd', 'add_page', 'পাতা যোগ কর', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7740, 'bd', 'all', 'সব', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7741, 'bd', 'mine', 'আমার', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7742, 'bd', 'trash', 'আবর্জনা', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7743, 'bd', 'parent', 'অভিভাবক', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7744, 'bd', 'showing', 'দেখাচ্ছে', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7745, 'bd', 'items_of', 'এর আইটেম', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7746, 'bd', 'bulk_action', 'বাল্ক অ্যাকশন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7747, 'bd', 'delete_selection', 'নির্বাচন মুছুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7748, 'bd', 'apply', 'আবেদন করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7749, 'bd', 'no_action_selected', 'কোনো অ্যাকশন বেছে নেওয়া হয়নি', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7750, 'bd', 'no_item_selected', 'কোন আইটেম নির্বাচন করা হয়নি', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7751, 'bd', 'edit_page', 'সম্পাদনা পাতা', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7752, 'bd', 'add_new', 'নতুন যোগ করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7753, 'bd', 'permalink', 'পার্মালিঙ্ক', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7754, 'bd', 'type_here', 'এখানে লিখুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7755, 'bd', 'seo_meta_tags', 'এসইও মেটা ট্যাগ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7756, 'bd', 'publish', 'প্রকাশ করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7757, 'bd', 'draft', 'খসড়া', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7758, 'bd', 'preview', 'পূর্বরূপ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7759, 'bd', 'visibility', 'দৃশ্যমানতা', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7760, 'bd', 'public', 'পাবলিক', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7761, 'bd', 'password_protected', 'পাসওয়ার্ড সুরক্ষিত', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7762, 'bd', 'if_password_field_is_remain_empty_then_visibility_will_be_saved_as_public', 'যদি পাসওয়ার্ড ক্ষেত্রটি খালি থাকে তাহলে দৃশ্যমানতা সর্বজনীন হিসাবে সংরক্ষণ করা হবে।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7763, 'bd', 'private', 'ব্যক্তিগত', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7764, 'bd', 'page_attributes', 'পৃষ্ঠা বৈশিষ্ট্য', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7765, 'bd', 'parents', 'পিতামাতা', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7766, 'bd', 'select_a_parent_page', 'একটি অভিভাবক পৃষ্ঠা নির্বাচন করুন৷', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7767, 'bd', 'featured_image', 'বৈশিষ্ট্যযুক্ত ইমেজ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7768, 'bd', 'please_insert_page_title', 'পৃষ্ঠা শিরোনাম সন্নিবেশ করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7769, 'bd', 'this_title_is_already_available_please_insert_another', 'এই শিরোনামটি ইতিমধ্যেই উপলব্ধ অনুগ্রহ করে আরেকটি সন্নিবেশ করুন৷', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7770, 'bd', 'please_write_the_page_title_under_225_words', 'অনুগ্রহ করে 225 শব্দের নিচে পৃষ্ঠার শিরোনাম লিখুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7771, 'bd', 'this_permalink_is_already_available_please_insert_another', 'এই পার্মালিঙ্ক ইতিমধ্যেই উপলব্ধ অনুগ্রহ করে অন্য একটি সন্নিবেশ করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7772, 'bd', 'please_insert_a_valid_image', 'একটি বৈধ ছবি সন্নিবেশ করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7773, 'bd', 'please_write_some_content', 'কিছু বিষয়বস্তু লিখুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7774, 'bd', 'please_select_a_valid_image', 'একটি বৈধ ছবি নির্বাচন করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7775, 'bd', 'something_went_wrong_please_select_visibility_again', 'কিছু ভুল হয়েছে, দয়া করে আবার দৃশ্যমানতা নির্বাচন করুন৷', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7776, 'bd', 'something_went_wrong_please_select_parent_again', 'কিছু ভুল হয়েছে, অনুগ্রহ করে আবার অভিভাবক নির্বাচন করুন৷', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7777, 'bd', 'page_updated_successfully', 'পৃষ্ঠা সফলভাবে আপডেট করা হয়েছে', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7778, 'bd', 'transalate_to_another_language', 'অন্য ভাষায় অনুবাদ করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7779, 'bd', 'header_background_color', 'হেডার পটভূমির রঙ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7780, 'bd', 'set_header_background_color', 'হেডার ব্যাকগ্রাউন্ড কালার সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7781, 'bd', 'sticky_header_background_color', 'স্টিকি হেডার ব্যাকগ্রাউন্ড কালার', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7782, 'bd', 'set_sticky_header_background_color', 'স্টিকি হেডার ব্যাকগ্রাউন্ড কালার সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7783, 'bd', 'header_search_icon', 'হেডার সার্চ আইকন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7784, 'bd', 'set_enable_to_display_search_icon', 'সার্চ আইকন প্রদর্শন করতে সক্ষম সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7785, 'bd', 'header_search_icon_color', 'হেডার সার্চ আইকনের রঙ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7786, 'bd', 'set_search_icon_color', 'অনুসন্ধান আইকনের রঙ সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7787, 'bd', 'sticky_header_search_icon_color', 'স্টিকি হেডার সার্চ আইকনের রঙ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7788, 'bd', 'set_sticky_header_search_icon_color', 'স্টিকি হেডার সার্চ আইকনের রঙ সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7789, 'bd', 'custom_header_style', 'কাস্টম হেডার স্টাইল', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7790, 'bd', 'custom_set_header_logo_style', 'কাস্টম সেট হেডার লোগো শৈলী.', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7791, 'bd', 'logo_dimensions_widthheight', 'লোগোর মাত্রা (প্রস্থ/উচ্চতা)।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7792, 'bd', 'set_logo_dimensions_to_choose_width_height_and_unit', 'প্রস্থ, উচ্চতা এবং একক বেছে নিতে লোগোর মাত্রা সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7793, 'bd', 'width', 'প্রস্থ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7794, 'bd', 'logo_top_and_bottom_margin', 'লোগো টপ এবং বটম মার্জিন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7795, 'bd', 'set_logo_top_and_bottom_margin', 'লোগো উপরে এবং নীচের মার্জিন সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7796, 'bd', 'sticky_logo_dimensions_widthheight', 'স্টিকি লোগোর মাত্রা (প্রস্থ/উচ্চতা)।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7797, 'bd', 'set_sticky_logo_dimensions_to_choose_width_height_and_unit', 'প্রস্থ, উচ্চতা এবং ইউনিট বেছে নিতে স্টিকি লোগোর মাত্রা সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7798, 'bd', 'sticky_logo_top_and_bottom_margin', 'স্টিকি লোগো টপ এবং বটম মার্জিন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7799, 'bd', 'set_sticky_logo_top_and_bottom_margin', 'স্টিকি লোগো উপরে এবং নীচের মার্জিন সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7800, 'bd', 'home_page', 'হোম পেজ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7801, 'bd', 'choose_home_page_layout_from_here_if_you_use_this_option_then_you_will_able_to_change_three_type_of_layout__default_right_sidebar_layout_', 'আপনি যদি এই বিকল্পটি ব্যবহার করেন তাহলে আপনি তিন ধরনের লেআউট পরিবর্তন করতে পারবেন (ডিফল্ট ডান সাইডবার লেআউট)।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7802, 'bd', 'custom_menu_style', 'কাস্টম মেনু শৈলী', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7803, 'bd', 'custom_set_menu_style', 'কাস্টম সেট মেনু শৈলী.', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7804, 'bd', 'menu_color', 'মেনু রঙ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7805, 'bd', 'set_header_menu_color', 'হেডার মেনু রঙ সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7806, 'bd', 'menu_hover_color', 'মেনু হোভার রঙ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7807, 'bd', 'set_header_menu_hover_color', 'হেডার মেনু হোভার রঙ সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7808, 'bd', 'menu_active_item_color', 'মেনু সক্রিয় আইটেম রঙ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7809, 'bd', 'set_header_menu_active_item_color', 'হেডার মেনু সক্রিয় আইটেম রঙ সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7810, 'bd', 'sub_menu_color', 'সাব মেনু রঙ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7811, 'bd', 'set_header_sub_menu_color', 'হেডার সাব মেনু রঙ সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7812, 'bd', 'sub_menu_hover_color', 'সাব মেনু হোভার রঙ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7813, 'bd', 'set_header_sub_menu_hover_color', 'হেডার সাব মেনু হোভার রঙ সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7814, 'bd', 'sub_menu_active_item_color', 'সাব মেনু সক্রিয় আইটেম রঙ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7815, 'bd', 'set_header_sub_menu_active_item_color', 'হেডার সাব মেনু সক্রিয় আইটেম রঙ সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7816, 'bd', 'these_settings_control_the_typography_for_menu', 'এই সেটিংস মেনুর জন্য টাইপোগ্রাফি নিয়ন্ত্রণ করে।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7817, 'bd', 'submenu_typography', 'সাবমেনু টাইপোগ্রাফি', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7818, 'bd', 'these_settings_control_the_typography_for_submenu', 'এই সেটিংস সাবমেনুর জন্য টাইপোগ্রাফি নিয়ন্ত্রণ করে।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7819, 'bd', 'update_user', 'ব্যবহারকারী আপডেট করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7820, 'bd', 'update_profile', 'প্রফাইল হালনাগাদ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7821, 'bd', 'profile_picture', 'প্রোফাইল ছবি', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7822, 'bd', 'give_your_name', 'আপনার নাম দিন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7823, 'bd', 'give_your_email_address', 'আপনার ইমেইল ঠিকানা দিন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7824, 'bd', 'biography', 'জীবনী', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7825, 'bd', 'not_more_than_200_characters', '200 অক্ষরের বেশি নয়', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7826, 'bd', 'give_you_biography', 'জীবনী দিই', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7827, 'bd', 'old_password', 'পুরানো পাসওয়ার্ড', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7828, 'bd', 'give_your_password', 'আপনার পাসওয়ার্ড দিন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7829, 'bd', 'confirm_password', 'পাসওয়ার্ড নিশ্চিত করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7830, 'bd', 'confirm_your_password', 'আপনার পাসওয়ার্ড নিশ্চিত', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7831, 'bd', 'social_info', 'সামাজিক তথ্য', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7832, 'bd', 'set_the_default_social_from_theme_option_or_make_custom_social', 'থিম বিকল্প থেকে ডিফল্ট সামাজিক সেট করুন বা কাস্টম সামাজিক করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7833, 'bd', 'profile_pic_is_required', 'প্রোফাইল ছবি প্রয়োজন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7834, 'bd', 'invalid_selection', 'অবৈধ নির্বাচন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7835, 'bd', 'profile_updated_successfully', 'প্রোফাইল সফলভাবে আপডেট করা হয়েছে', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7836, 'bd', 'clear_filter', 'স্বচ্ছ ছাকুনী', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7837, 'bd', 'edit_menus', 'মেনু সম্পাদনা করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7838, 'bd', 'manage_locations', 'অবস্থানগুলি পরিচালনা করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7839, 'bd', 'select_a_menu_to_edit', 'সম্পাদনা করতে একটি মেনু নির্বাচন করুন:', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7840, 'bd', 'create_menu_', 'মেনু তৈরি করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7841, 'bd', 'translate_menu_into', 'এতে মেনু অনুবাদ করুন:', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7842, 'bd', 'custom_links', 'কাস্টম লিঙ্ক', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7843, 'bd', 'link_text', 'লিঙ্ক টেক্সট', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7844, 'bd', 'add_to_menu', 'মেনুতে যোগ করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7845, 'bd', 'most_recent', 'অতি সম্প্রতি', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7846, 'bd', 'view_all', 'সব দেখ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7847, 'bd', 'search', 'অনুসন্ধান করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7848, 'bd', 'select_all', 'সব নির্বাচন করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7849, 'bd', 'select_all_', 'সব নির্বাচন করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7850, 'bd', 'posts', 'পোস্ট', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7851, 'bd', 'menu_name', 'মেনু নাম', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7852, 'bd', 'give_your_menu_a_name_then_click_save_menu', 'আপনার মেনুকে একটি নাম দিন, তারপর সেভ মেনুতে ক্লিক করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7853, 'bd', 'menu_settings', 'মেনু সেটিংস', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7854, 'bd', 'display_locations', 'অবস্থান প্রদর্শন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7855, 'bd', 'currently_set_to__', 'বর্তমানে সেট করা হয়েছে:', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7856, 'bd', 'save_menu', 'মেনু সংরক্ষণ করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7857, 'bd', 'drag_the_items_into_the_order_you_prefer_click_the_arrow_on_the_right_of_the_item_to_reveal_additional_configuration_options', 'অতিরিক্ত কনফিগারেশন বিকল্পগুলি প্রকাশ করতে আইটেমের ডানদিকে তীরটিতে ক্লিক করুন৷', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7858, 'bd', 'delete_menu', 'মেনু মুছুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7859, 'bd', 'update_menu', 'আপডেট মেনু', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7860, 'bd', 'your_theme_supports', 'আপনার থিম সমর্থন করে', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7861, 'bd', 'menus_select_which_menu_appears_in_each_location', 'প্রতিটি অবস্থানে কোন মেনু প্রদর্শিত হবে তা নির্বাচন করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7862, 'bd', 'theme_location', 'থিম অবস্থান', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7863, 'bd', 'assigned_menu', 'নির্ধারিত মেনু', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7864, 'bd', '_edit', 'সম্পাদনা করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7865, 'bd', 'use_new_menu', 'নতুন মেনু ব্যবহার করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7866, 'bd', 'menu_list_updated_successfully', 'মেনু তালিকা সফলভাবে আপডেট করা হয়েছে', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7867, 'bd', 'blog_category', 'ব্লগ বিভাগ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7868, 'bd', 'blog_categories', 'ব্লগ বিভাগ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7869, 'bd', 'add_blog_category', 'ব্লগ বিভাগ যোগ করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7870, 'bd', 'edit_blog_category', 'ব্লগ বিভাগ সম্পাদনা করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7871, 'bd', 'select_a_category', 'একটি বিভাগ নির্বাচন করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7872, 'bd', 'short_description', 'ছোট বিবরণ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7873, 'bd', 'please_insert_a_name', 'একটি নাম সন্নিবেশ করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7874, 'bd', 'this_name_is_already_available_please_insert_another', 'এই নামটি ইতিমধ্যেই উপলব্ধ অনুগ্রহ করে আরেকটি সন্নিবেশ করুন৷', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7875, 'bd', 'please_write_the_category_name_under_225_words', 'অনুগ্রহ করে 225 শব্দের নিচে বিভাগের নাম লিখুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7876, 'bd', 'blog_category_updated_successfully', 'ব্লগ বিভাগ সফলভাবে আপডেট হয়েছে', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7877, 'bd', 'tag', 'ট্যাগ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7878, 'bd', 'add_tag', 'ট্যাগ যোগ করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7879, 'bd', 'edit_tag', 'ট্যাগ সম্পাদনা করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7880, 'bd', 'please_write_the_tag_name_under_225_words', 'অনুগ্রহ করে 225 শব্দের নিচে ট্যাগের নাম লিখুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7881, 'bd', 'tag_updated_successfully', 'ট্যাগ সফলভাবে আপডেট হয়েছে', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7882, 'bd', 'header_language_select', 'হেডার ভাষা নির্বাচন করুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7883, 'bd', 'set_enable_to_display_multilanguage_select_in_header', 'হেডারে বহু-ভাষা নির্বাচন প্রদর্শন করতে সক্ষম সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38');
INSERT INTO `tl_translations` (`id`, `lang`, `lang_key`, `lang_value`, `created_at`, `updated_at`) VALUES
(7884, 'bd', 'contact', 'যোগাযোগ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7885, 'bd', 'custom_contact_page_style', 'কাস্টম যোগাযোগ পৃষ্ঠা শৈলী', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7886, 'bd', 'set_custom_contact_page_style', 'কাস্টম যোগাযোগ পৃষ্ঠা শৈলী সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7887, 'bd', 'back_to_top_button', 'ব্যাক টু টপ বোতাম', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7888, 'bd', 'switch_on_to_display_back_to_top_button', 'উপরের বোতামে ফিরে প্রদর্শনে স্যুইচ অন করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7889, 'bd', 'custom_back_to_top_button', 'কাস্টম ব্যাক টু টপ বোতাম', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7890, 'bd', 'if_you_switch_it_off_it_will_show_default_design_for_back_to_top_button', 'আপনি যদি এটি বন্ধ করেন, এটি \"ব্যাক টু টপ\" বোতামের জন্য ডিফল্ট ডিজাইন দেখাবে।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7891, 'bd', 'custom_back_to_top_button_icon', 'কাস্টম ব্যাক টু টপ বাটন আইকন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7892, 'bd', 'select_back_to_top_button_icon', 'ব্যাক টু টপ বাটন আইকন নির্বাচন করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7893, 'bd', 'back_to_top_button_background_color', 'ব্যাক টু টপ বোতাম ব্যাকগ্রাউন্ড কালার', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7894, 'bd', 'set_back_to_top_button_background_color', 'উপরের বোতামে ফিরে যান পটভূমির রঙ।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7895, 'bd', 'back_to_top_button_color', 'উপরের বোতামের রঙে ফিরে যান', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7896, 'bd', 'set_back_to_top_button_color', 'উপরের বোতামের রঙে ফিরে যান।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7897, 'bd', 'back_to_top_hover_button_color', 'উপরে ফিরে যান বোতামের রঙ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7898, 'bd', 'back_to_top_button_hover_background_color', 'ব্যাক টু টপ বোতাম হোভার ব্যাকগ্রাউন্ড কালার', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7899, 'bd', 'set_back_to_top_button_hover_background_color', 'উপরের বোতাম হোভার ব্যাকগ্রাউন্ড রঙ সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7900, 'bd', 'keep_back_to_top_button_on_mobile', 'মোবাইলে ব্যাক টু টপ বোতাম রাখুন', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7901, 'bd', 'if_you_switch_it_on_it_will_show_in_mobile_devices', 'আপনি এটি চালু করলে, এটি মোবাইল ডিভাইসে দেখাবে..', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7902, 'bd', 'custom_mobile_menu_style', 'কাস্টম মোবাইল মেনু শৈলী', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7903, 'bd', 'custom_set_mobile_menu_style', 'কাস্টম সেট মোবাইল মেনু শৈলী.', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7904, 'bd', 'mobile_menu_icon_color', 'মোবাইল মেনু আইকনের রঙ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7905, 'bd', 'set_mobile_menu_icon_color', 'মোবাইল মেনু আইকনের রঙ সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7906, 'bd', 'sticky_header_mobile_menu_icon_color', 'স্টিকি হেডার মোবাইল মেনু আইকনের রঙ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7907, 'bd', 'set_sticky_header_mobile_menu_icon_color', 'স্টিকি হেডার মোবাইল মেনু আইকনের রঙ সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7908, 'bd', 'mobile_menu_color', 'মোবাইল মেনু রঙ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7909, 'bd', 'set_mobile_menu_color', 'মোবাইল মেনু রঙ সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7910, 'bd', 'mobile_menu_hover_color', 'মোবাইল মেনু হোভার রঙ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7911, 'bd', 'set_mobile_menu_hover_color', 'মোবাইল মেনু হোভার রঙ সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7912, 'bd', 'mobile_menu_active_item_color', 'মোবাইল মেনু সক্রিয় আইটেম রঙ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7913, 'bd', 'set_mobile_menu_active_item_color', 'মোবাইল মেনু সক্রিয় আইটেম রঙ সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7914, 'bd', 'mobile_sub_menu_color', 'মোবাইল সাব মেনু রঙ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7915, 'bd', 'set_mobile_sub_menu_color', 'মোবাইল সাব মেনু রঙ সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7916, 'bd', 'mobile_sub_menu_hover_color', 'মোবাইল সাব মেনু হোভার রঙ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7917, 'bd', 'set_mobile_sub_menu_hover_color', 'মোবাইল সাব মেনু হোভার রঙ সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7918, 'bd', 'mobile_sub_menu_active_item_color', 'মোবাইল সাব মেনু সক্রিয় আইটেম রঙ', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7919, 'bd', 'set_mobile_sub_menu_active_item_color', 'মোবাইল সাব মেনু সক্রিয় আইটেম রঙ সেট করুন।', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7920, 'bd', 'default', 'ডিফল্ট', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7921, 'bd', 'custom', 'কাস্টম', '2023-05-13 06:36:38', '2023-05-13 06:36:38'),
(7922, 'bd', 'hide', 'লুকান', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7923, 'bd', 'show', 'দেখান', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7924, 'bd', 'contact_image', 'যোগাযোগ ইমেজ', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7925, 'bd', 'showhide_contact_page_image', 'যোগাযোগ পৃষ্ঠার ছবি দেখান/লুকান', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7926, 'bd', 'contact_image_settig', 'ইমেজ সেটিংয়ের সাথে যোগাযোগ করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7927, 'bd', 'set_contact_image_default_or_custom', 'যোগাযোগ ইমেজ ডিফল্ট বা কাস্টম সেট করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7928, 'bd', 'custom_contact_image', 'কাস্টম যোগাযোগ ইমেজ', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7929, 'bd', 'set_custom_contact_image', 'কাস্টম যোগাযোগ ইমেজ সেট করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7930, 'bd', 'disable', 'নিষ্ক্রিয় করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7931, 'bd', 'enable', 'সক্ষম করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7932, 'bd', 'contact_image_setting', 'যোগাযোগ ইমেজ সেটিং', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7933, 'bd', 'conatct_title', 'যোগাযোগ শিরোনাম', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7934, 'bd', 'set_title_for_contact_page', 'যোগাযোগ পৃষ্ঠার জন্য শিরোনাম সেট করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7935, 'bd', 'contact_title', 'যোগাযোগ শিরোনাম', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7936, 'bd', 'conatct_subtitle', 'সাবটাইটেল যোগাযোগ করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7937, 'bd', 'set_subtitle_for_contact_page', 'যোগাযোগ পৃষ্ঠার জন্য সাবটাইটেল সেট করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7938, 'bd', 'contact_name_placeholder', 'যোগাযোগের নাম স্থানধারক', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7939, 'bd', 'set_placeholder_for_contact_form_name', 'যোগাযোগ ফর্ম নামের জন্য স্থানধারক সেট করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7940, 'bd', 'contact_email_placeholder', 'ইমেল প্লেসহোল্ডারের সাথে যোগাযোগ করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7941, 'bd', 'set_placeholder_for_contact_form_email', 'যোগাযোগ ফর্ম ইমেল জন্য স্থানধারক সেট', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7942, 'bd', 'contact_subject_placeholder', 'যোগাযোগ বিষয় স্থানধারক', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7943, 'bd', 'set_placeholder_for_contact_form_subject', 'যোগাযোগ ফর্ম বিষয়ের জন্য স্থানধারক সেট করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7944, 'bd', 'contact_message_placeholder', 'যোগাযোগ বার্তা স্থানধারক', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7945, 'bd', 'contact_email_will_be_sent', 'যোগাযোগ ইমেল পাঠানো হবে', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7946, 'bd', 'set_where_will_be_the_contact_email_will_be_sent', 'যেখানে যোগাযোগ ইমেল পাঠানো হবে সেট করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7947, 'bd', 'contact_submit_button_text', 'যোগাযোগ করুন জমা বোতাম পাঠ্য', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7948, 'bd', 'contact_submit_button_textr', 'যোগাযোগ করুন জমা বোতাম পাঠ্য', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7949, 'bd', 'set_placeholder_for_message_form_subject', 'বার্তা ফর্ম বিষয়ের জন্য স্থানধারক সেট করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7950, 'bd', 'set_contact_form_buton_text', 'যোগাযোগ ফর্ম বাটন টেক্সট সেট করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7951, 'bd', 'no', 'না.', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7952, 'bd', 'template', 'টেমপ্লেট', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7953, 'bd', 'details', 'বিস্তারিত', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7954, 'bd', 'enter_email_subject', 'ইমেইল বিষয় লিখুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7955, 'bd', 'variables', 'ভেরিয়েবল', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7956, 'bd', 'smtp_configuration', 'Smtp কনফিগারেশন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7957, 'bd', 'email_configuration', 'ইমেল কনফিগারেশন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7958, 'bd', 'type', 'টাইপ', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7959, 'bd', 'smtp', 'smtp', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7960, 'bd', 'sendmail', 'মেইল পাঠাও', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7961, 'bd', 'mailgun', 'মেইলগান', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7962, 'bd', 'mail_host', 'মেল হোস্ট', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7963, 'bd', 'mail_port', 'মেইল পোর্ট', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7964, 'bd', 'mail_username', 'ব্যবহারকারীর নাম মেইল ​​করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7965, 'bd', 'mail_password', 'মেইল পাসওয়ার্ড', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7966, 'bd', 'mail_encryption', 'মেল এনক্রিপশন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7967, 'bd', 'mail_from_address', 'ঠিকানা থেকে মেইল', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7968, 'bd', 'mail_from_name', 'নাম থেকে মেল', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7969, 'bd', 'mailgun_domain', 'মেইলগুন ডোমেইন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7970, 'bd', 'mailgun_secret', 'মেইলগান সিক্রেট', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7971, 'bd', 'send_test_mail', 'টেস্ট মেইল ​​পাঠান', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7972, 'bd', 'subject', 'বিষয়', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7973, 'bd', 'message', 'বার্তা', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7974, 'bd', 'send', 'পাঠান', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7975, 'bd', 'email_sent_successfully', 'ইমেল সফলভাবে পাঠানো হয়েছে', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7976, 'bd', 'email_sending_failed', 'ইমেল পাঠানো ব্যর্থ হয়েছে', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7977, 'bd', 'please_fill_in_all_fields_and_ensure_that_the_data_entered_is_valid', '\"দয়া করে সমস্ত ক্ষেত্র পূরণ করুন এবং নিশ্চিত করুন যে প্রবেশ করা ডেটা বৈধ।', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7978, 'bd', 'email_sending_failed_please_contact_with_admin', 'এডমিনের সাথে যোগাযোগ করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7979, 'bd', 'email_template_updated_successful', 'ইমেল টেমপ্লেট আপডেট করা সফল হয়েছে৷', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7980, 'bd', 'select_option', 'বিকল্প নির্বাচন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7981, 'bd', 'featured_blogs', 'বৈশিষ্ট্যযুক্ত ব্লগ', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7982, 'bd', 'sub_title_color', 'সাব টাইটেলের রঙ', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7983, 'bd', 'slider_item_color', 'স্লাইডার আইটেমের রঙ', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7984, 'bd', 'login_credentials_does_not_match', 'লগইন শংসাপত্র মেলে না', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7985, 'bd', 'page_trashed_successfully', 'পৃষ্ঠা সফলভাবে ট্র্যাশ করা হয়েছে৷', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7986, 'bd', 'restore', 'পুনরুদ্ধার করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7987, 'bd', 'page_restored_successfully', 'পৃষ্ঠা সফলভাবে পুনরুদ্ধার করা হয়েছে৷', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7988, 'bd', 'last_modified', 'সর্বশেষ পরিবর্তিত', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7989, 'bd', 'contact_in_header_menu', 'হেডার মেনুতে যোগাযোগ করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7990, 'bd', 'showhide_contact_link_in_header_menu', 'হেডার মেনুতে যোগাযোগের লিঙ্ক দেখান/লুকান', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7991, 'bd', 'contact_in_header_menu_text', 'হেডার মেনু টেক্সটে যোগাযোগ করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7992, 'bd', 'contact_header_text', 'যোগাযোগ শিরোনাম পাঠ্য', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7993, 'bd', 'set_text_for_contact_in_header_menu', 'হেডার মেনুতে যোগাযোগের জন্য পাঠ্য সেট করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7994, 'bd', 'set_text_for_contact_in_header_menu_if_no_text_is_set_default_contact_will_be_placed', 'কোন টেক্সট সেট না থাকলে ডিফল্ট \"যোগাযোগ\" স্থাপন করা হবে', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7995, 'bd', 'these_settings_control_the_typography_for_body', 'এই সেটিংস শরীরের জন্য টাইপোগ্রাফি নিয়ন্ত্রণ.', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7996, 'bd', 'add_blog', 'ব্লগ যোগ করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7997, 'bd', 'stick_this_post_to_the_frontpage', 'এই পোস্টটি ফ্রন্টপেজে আটকে দিন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7998, 'bd', 'blog_image', 'ব্লগ ইমেজ', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(7999, 'bd', 'featured_status', 'বৈশিষ্ট্যযুক্ত স্থিতি', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8000, 'bd', 'no_option_selected', 'কোন বিকল্প নির্বাচন করা হয়নি', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8001, 'bd', 'only_active_categories', 'শুধুমাত্র সক্রিয় বিভাগ', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8002, 'bd', 'new_tag', 'নতুন ট্যাগ', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8003, 'bd', 'add', 'যোগ করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8004, 'bd', 'add_new_tag', 'নতুন ট্যাগ যোগ করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8005, 'bd', 'new_category', 'নতুন বিভাগ', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8006, 'bd', 'select_parent', 'অভিভাবক নির্বাচন করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8007, 'bd', 'select_a_parent_category', 'একটি অভিভাবক বিভাগ নির্বাচন করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8008, 'bd', 'add_new_category', 'নতুন বিভাগ যোগ করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8009, 'bd', 'edit_blog', 'ব্লগ সম্পাদনা করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8010, 'bd', 'please_insert_blog_name', 'ব্লগ নাম সন্নিবেশ করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8011, 'bd', 'please_write_the_blog_name_under_225_words', 'অনুগ্রহ করে 225 শব্দের নিচে ব্লগের নাম লিখুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8012, 'bd', 'something_went_wrong_please_select_category_again', 'কিছু ভুল হয়েছে, অনুগ্রহ করে আবার বিভাগ নির্বাচন করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8013, 'bd', 'new_blog_saved', 'নতুন ব্লগ সংরক্ষিত', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8014, 'bd', 'blog_updated_successfully', 'ব্লগ সফলভাবে আপডেট হয়েছে', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8015, 'bd', 'by', 'দ্বারা:', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8016, 'bd', 'version', 'সংস্করণ:', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8017, 'bd', 'activated', 'সক্রিয়', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8018, 'bd', 'activate_confirmation', 'নিশ্চিতকরণ সক্রিয় করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8019, 'bd', 'are_you_sure_to_active_this_theme', 'আপনি এই থিম সক্রিয় করতে নিশ্চিত', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8020, 'bd', 'activate', 'সক্রিয় করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8021, 'bd', 'footer_language_select', 'ফুটার ভাষা নির্বাচন করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8022, 'bd', 'set_enable_to_display_multilanguage_select_in_footer', 'ফুটারে বহু-ভাষা নির্বাচন প্রদর্শন করতে সক্ষম সেট করুন।', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8023, 'bd', 'plugings', 'প্লাগিংস', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8024, 'bd', 'deactive_confirmation', 'নিষ্ক্রিয় নিশ্চিতকরণ', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8025, 'bd', 'are_you_sure_to_deactive_this_plugin', 'আপনি এই প্লাগইন নিষ্ক্রিয় করতে নিশ্চিত', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8026, 'bd', 'deactivate', 'নিষ্ক্রিয় করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8027, 'bd', 'are_you_sure_to_active_this_plugin', 'আপনি এই প্লাগইন সক্রিয় করতে নিশ্চিত', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8028, 'bd', 'placeholder_image', 'স্থানধারক চিত্র', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8029, 'bd', 'watermark_settings', 'ওয়াটারমার্ক সেটিংস', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8030, 'bd', 'enabledisable_watermark', 'ওয়াটারমার্ক সক্ষম/অক্ষম করুন', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8031, 'bd', 'watermark_image', 'ওয়াটারমার্ক ইমেজ', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8032, 'bd', 'watermark_image_position', 'ওয়াটারমার্ক ইমেজ অবস্থান', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8033, 'bd', 'top_left', 'উপরে বাঁদিকে', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8034, 'bd', 'top_right', 'উপরের ডানে', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8035, 'bd', 'bottom_left', 'নিচে বামে', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8036, 'bd', 'watermarking_image_opacity_', 'ওয়াটারমার্কিং ছবির অস্বচ্ছতা (%)', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8037, 'bd', 'watermarking_image_opacity', 'ওয়াটারমার্কিং ছবির অস্বচ্ছতা', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8038, 'bd', 'media_thumbnails_sizes', 'মিডিয়া থাম্বনেইল আকার', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8039, 'bd', 'large_thumb_image_size', 'বড় থাম্ব ইমেজ সাইজ', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8040, 'bd', 'large_thumb_image_width', 'বড় থাম্ব ইমেজ প্রস্থ', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8041, 'bd', 'large_thumb_image_height', 'বড় থাম্ব ছবির উচ্চতা', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8042, 'bd', 'medium_thumb_image_size', 'মাঝারি থাম্ব ইমেজ সাইজ', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8043, 'bd', 'medium_thumb_image_width', 'মাঝারি থাম্ব ছবির প্রস্থ', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8044, 'bd', 'medium_thumb_image_height', 'মাঝারি থাম্ব ছবির উচ্চতা', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8045, 'bd', 'small_thumb_image_size', 'ছোট থাম্ব ইমেজ সাইজ', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8046, 'bd', 'small_thumb_image_width', 'ছোট থাম্ব ইমেজ প্রস্থ', '2023-05-13 06:41:46', '2023-05-13 06:41:46'),
(8047, 'bd', 'small_thumb_image_height', 'ছোট থাম্ব ইমেজ উচ্চতা', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8048, 'bd', 'select_image_applicable_folder', 'ইমেজ প্রযোজ্য ফোল্ডার নির্বাচন করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8049, 'bd', 'delete_permanently', 'চিরতরে মুছে দাও', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8050, 'bd', 'file_name', 'ফাইলের নাম:', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8051, 'bd', 'file_url', 'ফাইল URL:', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8052, 'bd', 'file_type', 'ফাইলের ধরন:', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8053, 'bd', 'file_size', 'ফাইলের আকার:', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8054, 'bd', 'uploaded_by', 'আপলোড করেছে:', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8055, 'bd', 'created_at', 'এ নির্মিত:', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8056, 'bd', 'updated_at', 'এ আপডেট:', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8057, 'bd', 'download', 'ডাউনলোড করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8058, 'bd', 'copy_url_to_clipboard', 'ক্লিপবোর্ডে URL কপি করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8059, 'bd', 'alt________________________________________________________________________________________________________________________________text', 'বিকল্প পাঠ', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8060, 'bd', 'caption', 'ক্যাপশন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8061, 'bd', 'description', 'বর্ণনা', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8062, 'bd', 'media_file_uploaded_successful', 'মিডিয়া ফাইল আপলোড সফল হয়েছে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8063, 'bd', 'media_file_deleted_successfully', 'মিডিয়া ফাইল সফলভাবে মুছে ফেলা হয়েছে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8064, 'bd', 'media_settings_updated_successfully', 'মিডিয়া সেটিংস সফলভাবে আপডেট করা হয়েছে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8065, 'bd', 'blog_not_found', 'ব্লগ পাওয়া যায়নি', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8066, 'bd', 'blog_featured_status_changed_successfully', 'ব্লগের বৈশিষ্ট্যযুক্ত স্থিতি সফলভাবে পরিবর্তিত হয়েছে৷', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8067, 'bd', 'unable_to_update_media_file', 'মিডিয়া ফাইল আপডেট করতে অক্ষম', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8068, 'bd', 'category_color', 'ক্যাটাগরি কালার', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8069, 'bd', 'new_section_added_successfully', 'নতুন বিভাগ সফলভাবে যোগ করা হয়েছে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8070, 'bd', 'a_new_comment_added', 'একটি নতুন মন্তব্য যোগ করা হয়েছে.', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8071, 'bd', 'your_comment_added', 'আপনার মন্তব্য যোগ করা হয়েছে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8072, 'bd', 'module_name', 'মডিউল নাম', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8073, 'bd', 'permission_name', 'অনুমতির নাম', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8074, 'bd', 'users_login_activity', 'ব্যবহারকারীদের লগইন কার্যকলাপ', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8075, 'bd', 'user', 'ব্যবহারকারী', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8076, 'bd', 'login_at', 'লগইন করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8077, 'bd', 'logout_at', 'লগআউট এ', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8078, 'bd', 'ip', 'আইপি', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8079, 'bd', 'operating_system', 'অপারেটিং সিস্টেম', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8080, 'bd', 'browser', 'ব্রাউজার', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8081, 'bd', 'action', 'কর্ম', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8082, 'bd', '________________________bulk_action_', 'বাল্ক অ্যাকশন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8083, 'bd', '________________________delete_selection_', 'নির্বাচন মুছুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8084, 'bd', '________________________apply_', 'আবেদন করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8085, 'bd', 'no_item_selected_', 'কোন আইটেম নির্বাচন করা হয়নি', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8086, 'bd', 'no_action_selected_', 'কোনো অ্যাকশন বেছে নেওয়া হয়নি', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8087, 'bd', 'add_new_user', 'নতুন ব্যবহারকারী যোগ করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8088, 'bd', 'uid', 'ইউআইডি', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8089, 'bd', 'assign_role', 'ভূমিকা বরাদ্দ করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8090, 'bd', 'select_a_role', 'একটি ভূমিকা নির্বাচন করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8091, 'bd', 'user_updated_successfully', 'ব্যবহারকারী সফলভাবে আপডেট করা হয়েছে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8092, 'bd', 'add_user', 'ব্যবহারকারী যোগ করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8093, 'bd', 'user_status_updated_successfully', 'ব্যবহারকারীর স্থিতি সফলভাবে আপডেট করা হয়েছে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8094, 'bd', 'comment_setting', 'মন্তব্য সেটিং', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8095, 'bd', 'default_blog_settings', 'ডিফল্ট ব্লগ সেটিংস', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8096, 'bd', 'allow_people_to_submit_comments_on_new_blogs', 'লোকেদের নতুন ব্লগে মন্তব্য জমা দেওয়ার অনুমতি দিন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8097, 'bd', 'other_comment_settings', 'অন্যান্য মন্তব্য সেটিংস', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8098, 'bd', 'comment_author_must_fill_out_name_and_email', 'মন্তব্য লেখকের নাম এবং ইমেল পূরণ করতে হবে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8099, 'bd', 'users_must_be_registered_and_logged_in_to_comment', 'ব্যবহারকারীদের অবশ্যই নিবন্ধিত হতে হবে এবং মন্তব্য করতে লগ ইন করতে হবে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8100, 'bd', 'automatically_close_comments_on_blogs_older_than', 'এর চেয়ে পুরোনো ব্লগে স্বয়ংক্রিয়ভাবে মন্তব্য বন্ধ করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8101, 'bd', 'days', 'দিন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8102, 'bd', 'enable_threaded_nested_comments', 'থ্রেডেড (নেস্টেড) মন্তব্য সক্ষম করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8103, 'bd', 'levels_deep', 'গভীর স্তর', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8104, 'bd', 'break_comments_into_pages_with', 'সঙ্গে পৃষ্ঠায় মন্তব্য বিরতি', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8105, 'bd', 'top_level_comments_per_page_and', 'পৃষ্ঠা প্রতি শীর্ষ স্তরের মন্তব্য এবং', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8106, 'bd', 'comments_should_be_displayed_with_the', 'মন্তব্যের সাথে প্রদর্শন করা উচিত', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8107, 'bd', 'older', 'পুরোনো', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8108, 'bd', 'newer', 'নতুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8109, 'bd', 'comments_at_the_top_of_each_page', 'প্রতিটি পৃষ্ঠার শীর্ষে মন্তব্য', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8110, 'bd', 'email_me_whenever', 'যখনই আমাকে ইমেইল করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8111, 'bd', 'anyone_posts_a_comment', 'যে কেউ একটি মন্তব্য পোস্ট', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8112, 'bd', 'a_comment_is_held_for_moderation', 'একটি মন্তব্য সংযম জন্য রাখা হয়', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8113, 'bd', 'before_a_comment_appears', 'একটি মন্তব্য উপস্থিত হওয়ার আগে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8114, 'bd', 'comment_must_be_manually_approved', 'মন্তব্য ম্যানুয়ালি অনুমোদিত হতে হবে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8115, 'bd', 'comment_author_must_have_a_previously_approved_comment', 'মন্তব্য লেখক একটি পূর্বে অনুমোদিত মন্তব্য থাকতে হবে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8116, 'bd', 'comment_moderation', 'মন্তব্য সংযম', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8117, 'bd', 'hold_a_comment_in_the_queue_if_it_contains', 'সারিতে একটি মন্তব্য রাখুন যদি এটি থাকে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8118, 'bd', 'or_more_links_a_common_characteristic_of_comment_spam_is_a_large_number_of_hyperlinks', '(মন্তব্য স্প্যামের একটি সাধারণ বৈশিষ্ট্য হল বিপুল সংখ্যক হাইপারলিঙ্ক।)', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8119, 'bd', 'when_a_comment_contains_any_of_these_words_in_its_content_author_name_url_email_ip_address_or_browsers_user_agent_string_it_will_be_held_in_the_', 'যখন একটি মন্তব্যের বিষয়বস্তু, লেখকের নাম, ইউআরএল, ইমেল, আইপি ঠিকানা, বা ব্রাউজারের ব্যবহারকারী এজেন্ট স্ট্রিং-এ এই শব্দগুলির যেকোনো একটি থাকে, তখন এটি', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8120, 'bd', 'pending_queue', 'মুলতুবি সারি', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8121, 'bd', 'one_word_or_ip_address_per_line_it_will_match_inside_words_so_press_will_match_wordpress', 'এটি শব্দের ভিতরে মিলবে, তাই \"প্রেস\" \"ওয়ার্ডপ্রেস\" এর সাথে মিলবে।', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8122, 'bd', 'disallowed_comment_keys', 'অননুমোদিত মন্তব্য কী', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8123, 'bd', 'when_a_comment_contains_any_of_these_words_in_its_content_author_name_url_email_ip_address_or_browsers_user_agent_string_it_will_be_put_in_the_trash_one_word_or_ip_address_per_line_it_will_match_inside_words_so_press_will_match_wordpress', 'এটি শব্দের ভিতরে মিলবে, তাই \"প্রেস\" \"ওয়ার্ডপ্রেস\" এর সাথে মিলবে।', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8124, 'bd', 'avatars', 'অবতার', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8125, 'bd', 'an_avatar_is_an_image_that_can_be_associated_with_a_user_across_multiple_websites_in_this_area_you_can_choose_to_display_avatars_of_users_who_interact_with_the_site', 'এই এলাকায়, আপনি সাইটের সাথে ইন্টারঅ্যাক্ট করে এমন ব্যবহারকারীদের অবতার প্রদর্শন করতে বেছে নিতে পারেন।', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8126, 'bd', 'avatar_display', 'অবতার প্রদর্শন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8127, 'bd', 'show_avatars', 'অবতার দেখান', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8128, 'bd', 'default_avatar', 'ডিফল্ট অবতার', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8129, 'bd', 'for_users_without_a_custom_avatar_of_their_own_you_can_either_display_a_generic_logo_or_a_generated_one_based_on_their_email_address', 'তাদের নিজস্ব একটি কাস্টম অবতার ছাড়া ব্যবহারকারীদের জন্য, আপনি তাদের ইমেল ঠিকানার উপর ভিত্তি করে একটি জেনেরিক লোগো বা একটি জেনারেট করা প্রদর্শন করতে পারেন৷', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8130, 'bd', 'mystery_person', 'রহস্যময় ব্যক্তি', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8131, 'bd', 'blank', 'খালি', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8132, 'bd', 'gravatar_logo', 'Gravatar লোগো', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8133, 'bd', 'identicon_generated', 'আইডেন্টিকন (জেনারেট করা)', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8134, 'bd', 'wavatar_generated', 'Wavatar (উত্পন্ন)', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8135, 'bd', 'monsterid_generated', 'MonsterID (উত্পন্ন)', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8136, 'bd', 'retro_generated', 'বিপরীতমুখী (উৎপন্ন)', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8137, 'bd', 'please_check_for_missing_field_or_invalid_data_and_try_again', 'অনুপস্থিত ক্ষেত্র বা অবৈধ ডেটা চেক করুন এবং আবার চেষ্টা করুন।', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8138, 'bd', 'menu_deleted_successfully', 'মেনু সফলভাবে মুছে ফেলা হয়েছে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8139, 'bd', 'add_title', 'শিরোনাম যোগ করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8140, 'bd', 'new_page_saved', 'নতুন পৃষ্ঠা সংরক্ষিত', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8141, 'bd', 'preferred_size_for_thumnail_image_is_1110__578_px', 'থামনেল ছবির জন্য পছন্দসই আকার হল 1110 × 578 পিক্সেল৷', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8142, 'bd', 'general_settings_updated_successfully', 'সাধারণ সেটিংস সফলভাবে আপডেট করা হয়েছে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8143, 'bd', 'alt_text', 'বিকল্প পাঠ', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8144, 'bd', 'blog_deleted_successfully', 'ব্লগ সফলভাবে মুছে ফেলা হয়েছে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8145, 'bd', 'add_role', 'ভূমিকা যোগ করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8146, 'bd', 'give_role_name', 'ভূমিকার নাম দিন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8147, 'bd', 'module', 'মডিউল', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8148, 'bd', 'feature', 'বৈশিষ্ট্য', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8149, 'bd', 'create', 'সৃষ্টি', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8150, 'bd', 'manage', 'পরিচালনা করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8151, 'bd', 'show_', 'দেখান', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8152, 'bd', 'create_', 'সৃষ্টি', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8153, 'bd', 'edit_', 'সম্পাদনা করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8154, 'bd', 'delete_', 'মুছে ফেলা', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8155, 'bd', 'manage_', 'পরিচালনা করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8156, 'bd', 'update_role', 'ভূমিকা আপডেট করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8157, 'bd', 'sidebar_updated', 'সাইডবার আপডেট করা হয়েছে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8158, 'bd', 'stick_this_post_to_the_front_of_blog_list_page', 'ব্লগ তালিকা পৃষ্ঠার সামনে এই পোস্ট আটকান', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8159, 'bd', 'blog_comment', 'ব্লগ মন্তব্য', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8160, 'bd', 'approve', 'অনুমোদন করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8161, 'bd', 'spam', 'স্প্যাম', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8162, 'bd', 'in_response_to', 'জবাবে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8163, 'bd', 'unapprove', 'অনুমোদন না করা', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8164, 'bd', 'reply', 'উত্তর দিন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8165, 'bd', 'view_blog', 'ব্লগ দেখুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8166, 'bd', 'comment_delete_confirmation', 'মন্তব্য মুছুন নিশ্চিতকরণ', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8167, 'bd', 'are_you_sure_you_want_to_permanently_delete_this_comment', 'আপনি কি নিশ্চিত আপনি স্থায়ীভাবে এই মন্তব্য মুছে ফেলতে চান', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8168, 'bd', 'bulk_action_confirmation', 'বাল্ক অ্যাকশন নিশ্চিতকরণ', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8169, 'bd', 'are_you_sure_you_want_to_take_this_action', 'আপনি কি নিশ্চিত আপনি এই পদক্ষেপ নিতে চান', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8170, 'bd', 'comment_reply', 'মন্তব্য উত্তর', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8171, 'bd', 'move_to_trash', 'আবর্জনা সরান', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8172, 'bd', 'mark_as_spam', 'স্প্যাম হিসেবে চিহ্নিত করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8173, 'bd', 'not_spam', 'অস্ত্রোপচার', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8174, 'bd', 'delete_permanetly', 'স্থায়ীভাবে মুছুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8175, 'bd', 'delete_all', 'সব মুছে ফেলুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8176, 'bd', 'edit_comment', 'মন্তব্য সম্পাদনা করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8177, 'bd', 'please_enter_a_valid_number_for_comment_close_days', 'মন্তব্য বন্ধ দিন জন্য একটি বৈধ নম্বর লিখুন দয়া করে.', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8178, 'bd', 'the_minimum_number_for_comment_close_days_is_1', 'মন্তব্য বন্ধের দিনের জন্য ন্যূনতম সংখ্যা হল 1', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8179, 'bd', 'please_select_a_valid_option_for_comment_threads_level', 'মন্তব্য থ্রেড স্তরের জন্য একটি বৈধ বিকল্প নির্বাচন করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8180, 'bd', 'please_enter_a_valid_number_for_per_page_comment', 'প্রতি পৃষ্ঠা মন্তব্যের জন্য একটি বৈধ নম্বর লিখুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8181, 'bd', 'the_minimum_comments_for_per_page_is_8', 'প্রতি পৃষ্ঠার জন্য সর্বনিম্ন মন্তব্য 8', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8182, 'bd', 'please_select_a_valid_option_for_default_comment_page', 'ডিফল্ট মন্তব্য পৃষ্ঠার জন্য একটি বৈধ বিকল্প নির্বাচন করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8183, 'bd', 'please_select_a_valid_option_for_comment_order', 'মন্তব্য আদেশের জন্য একটি বৈধ বিকল্প নির্বাচন করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8184, 'bd', 'please_enter_a_valid_number_for_comment_links', 'মন্তব্য লিঙ্কের জন্য একটি বৈধ নম্বর লিখুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8185, 'bd', 'the_minimum_comment_links_number_must_be_1', 'সর্বনিম্ন মন্তব্য লিঙ্ক নম্বর 1 হতে হবে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8186, 'bd', 'please_select_a_valid_default_avatar', 'অনুগ্রহ করে একটি বৈধ ডিফল্ট অবতার নির্বাচন করুন৷', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8187, 'bd', 'comment_settings_updated_successfully', 'মন্তব্য সেটিংস সফলভাবে আপডেট করা হয়েছে৷', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8188, 'bd', 'seo_update_successfully', 'সফলভাবে এসইও আপডেট', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8189, 'bd', 'mail_driver_is_required', 'মেইল ড্রাইভার প্রয়োজন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8190, 'bd', 'smtp_configuration_updated_successfully', 'SMTP কনফিগারেশন সফলভাবে আপডেট হয়েছে৷', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8191, 'bd', 'new_language', 'নতুন ভাষা', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8192, 'bd', 'select_a_option', 'একটি বিকল্প নির্বাচন করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8193, 'bd', 'section_deleted_successfully', 'বিভাগ সফলভাবে মুছে ফেলা হয়েছে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8194, 'bd', 'after_uploading_your_fonts_you_should_select_font_family_customfont1customfont2_from_dropdown_list_in_bodyparagraphheadingsmenublog_typography_section', 'আপনার ফন্টগুলি আপলোড করার পরে, আপনাকে টাইপোগ্রাফি বিভাগে ড্রপডাউন তালিকা থেকে ফন্ট পরিবার (কাস্টম-ফন্ট-1/কাস্টম-ফন্ট-2) নির্বাচন করতে হবে।', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8195, 'bd', 'custom_font1', 'কাস্টম ফন্ট 1', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8196, 'bd', 'please_enable_this_option_to_use_custom_font_1', 'অনুগ্রহ করে কাস্টম ফন্ট 1 ব্যবহার করতে এই বিকল্পটি সক্ষম করুন৷', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8197, 'bd', 'custom_font_1_woff', 'কাস্টম ফন্ট 1 .woff', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8198, 'bd', 'remove', 'অপসারণ', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8199, 'bd', 'custom_font_1_ttf', 'কাস্টম ফন্ট 1 .ttf', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8200, 'bd', 'custom_font_1_eot', 'কাস্টম ফন্ট 1 .eot', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8201, 'bd', 'custom_font2', 'কাস্টম ফন্ট 2', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8202, 'bd', 'please_enable_this_option_to_use_custom_font_2', 'অনুগ্রহ করে কাস্টম ফন্ট 2 ব্যবহার করতে এই বিকল্পটি সক্ষম করুন৷', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8203, 'bd', 'custom_font_2_woff', 'কাস্টম ফন্ট 2 .woff', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8204, 'bd', 'custom_font_2_ttf', 'কাস্টম ফন্ট 2 .ttf', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8205, 'bd', 'custom_font_2_eot', 'কাস্টম ফন্ট 2 .eot', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8206, 'bd', 'import_file_or_clipboard_text_is_required', 'ফাইল বা ক্লিপবোর্ড পাঠ্য আমদানি প্রয়োজন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8207, 'bd', 'role_name_is_required', 'ভূমিকার নাম প্রয়োজন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8208, 'bd', 'role_name_already_exists', 'ভূমিকার নাম ইতিমধ্যেই বিদ্যমান৷', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8209, 'bd', 'role_permission_required', 'ভূমিকা অনুমতি প্রয়োজন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8210, 'bd', 'role_updated_successful', 'ভূমিকা সফলভাবে আপডেট করা হয়েছে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8211, 'bd', 'widget_removed_from_sidebar', 'সাইডবার থেকে উইজেট সরানো হয়েছে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8212, 'bd', 'result_for', 'এর জন্য ফলাফল', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8213, 'bd', 'license_activate', 'লাইসেন্স সক্রিয়', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8214, 'bd', 'license_key', 'লাইসেন্স কী', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8215, 'bd', 'enter_license_key', 'লাইসেন্স কী লিখুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8216, 'bd', 'welcome', 'স্বাগত', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8217, 'bd', 'pages_bulk_delete_successful', 'পৃষ্ঠাগুলি বাল্ক মুছে ফেলা সফল হয়েছে৷', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8218, 'bd', 'page_deleted_successfully', 'পৃষ্ঠা সফলভাবে মুছে ফেলা হয়েছে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8219, 'bd', 'blogs_bulk_delete_successful', 'ব্লগ বাল্ক মুছে ফেলা সফল', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8220, 'bd', 'tag_bulk_deleted_successfully', 'ট্যাগ বাল্ক সফলভাবে মুছে ফেলা হয়েছে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8221, 'bd', 'blog_category_bulk_deleting_failed', 'ব্লগ বিভাগ বাল্ক মুছে ফেলা ব্যর্থ হয়েছে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8222, 'bd', 'blog_category_deleted_successfully', 'ব্লগ বিভাগ সফলভাবে মুছে ফেলা হয়েছে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8223, 'bd', 'user_deleted_successfully', 'ব্যবহারকারী সফলভাবে মুছে ফেলা হয়েছে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8224, 'bd', 'you_can_not_inactive_this_language', 'আপনি এই ভাষা নিষ্ক্রিয় করতে পারবেন না', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8225, 'bd', 'nothing_found', 'কিছুই পাওয়া যায়নি', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8226, 'bd', 'role_deleted_successfully', 'ভূমিকা সফলভাবে মুছে ফেলা হয়েছে৷', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8227, 'bd', 'theme_color', 'থিম রঙ', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8228, 'bd', 'theme_primary_color', 'থিম প্রাথমিক রঙ', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8229, 'bd', 'set_theme_primary_color', 'থিমের প্রাথমিক রঙ সেট করুন', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8230, 'en', '____', 'অনুবাদ সফলভাবে আপডেট করা হয়েছে', '2023-05-13 06:41:47', '2023-05-13 06:41:47'),
(8231, 'en', 'open_ai_settings', 'Open AI Settings', '2023-05-21 06:30:53', '2023-05-21 06:30:53'),
(8232, 'en', 'ai_assistent', 'AI Assistent', '2023-05-21 06:50:31', '2023-05-21 06:50:31'),
(8233, 'en', 'language', 'Language', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8234, 'en', 'arabic', 'Arabic', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8235, 'en', 'bulgarian', 'Bulgarian', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8236, 'en', 'chinese_simplified', 'Chinese (Simplified)', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8237, 'en', 'chinese_traditional', 'Chinese (Traditional)', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8238, 'en', 'croatian', 'Croatian', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8239, 'en', 'czech', 'Czech', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8240, 'en', 'danish', 'Danish', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8241, 'en', 'dutch', 'Dutch', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8242, 'en', 'english', 'English', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8243, 'en', 'estonian', 'Estonian', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8244, 'en', 'finnish', 'Finnish', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8245, 'en', 'french', 'French', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8246, 'en', 'german', 'German', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8247, 'en', 'greek', 'Greek', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8248, 'en', 'hebrew', 'Hebrew', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8249, 'en', 'hindi', 'Hindi', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8250, 'en', 'hungarian', 'Hungarian', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8251, 'en', 'icelandic', 'Icelandic', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8252, 'en', 'indonesian', 'Indonesian', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8253, 'en', 'italian', 'Italian', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8254, 'en', 'japanese', 'Japanese', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8255, 'en', 'korean', 'Korean', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8256, 'en', 'lithuanian', 'Lithuanian', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8257, 'en', 'malay', 'Malay', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8258, 'en', 'norwegian', 'Norwegian', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8259, 'en', 'polish', 'Polish', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8260, 'en', 'portuguese', 'Portuguese', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8261, 'en', 'romanian', 'Romanian', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8262, 'en', 'russian', 'Russian', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8263, 'en', 'slovenian', 'Slovenian', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8264, 'en', 'spanish', 'Spanish', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8265, 'en', 'swahili', 'Swahili', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8266, 'en', 'swedish', 'Swedish', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8267, 'en', 'thai', 'Thai', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8268, 'en', 'turkish', 'Turkish', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8269, 'en', 'ukrainian', 'Ukrainian', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8270, 'en', 'vietnamese', 'Vietnamese', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8271, 'en', 'what_is_the_primary_focus_of_your_blog', 'What is the primary focus of your blog', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8272, 'en', 'primary_focus', 'Primary Focus', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8273, 'en', 'priority_keywords', 'Priority Keywords', '2023-05-21 06:50:32', '2023-05-21 06:50:32'),
(8274, 'en', 'give_priority_kewords_seperated_by_comma_', 'Give priority kewords seperated by comma (,)', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8275, 'en', 'level_of_creativity', 'Level of creativity', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8276, 'en', 'extra_ordinary', 'Extra Ordinary', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8277, 'en', 'ordinary', 'Ordinary', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8278, 'en', 'minimal', 'Minimal', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8279, 'en', 'editorial_tone', 'Editorial tone', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8280, 'en', 'formal', 'Formal', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8281, 'en', 'casual', 'Casual', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8282, 'en', 'humorous', 'Humorous', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8283, 'en', 'authoritative', 'Authoritative', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8284, 'en', 'persuasive', 'Persuasive', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8285, 'en', 'empathetic', 'Empathetic', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8286, 'en', 'inspirational', 'Inspirational', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8287, 'en', 'educational', 'Educational', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8288, 'en', 'witty', 'Witty', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8289, 'en', 'intimate', 'Intimate', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8290, 'en', 'choose_what_you_want_to_generate', 'Choose What You Want To Generate', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8291, 'en', 'blog_title', 'Blog Title', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8292, 'en', 'blog_short_description', 'Blog Short Description', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8293, 'en', 'blog_content', 'Blog Content', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8294, 'en', 'title_length', 'Title Length', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8295, 'en', 'short_details_length', 'Short Details Length', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8296, 'en', 'content_length', 'Content Length', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8297, 'en', 'generate', 'Generate', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8298, 'en', 'formate', 'Formate', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8299, 'en', 'standard', 'Standard', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8300, 'en', 'video', 'Video', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8301, 'en', 'audio', 'Audio', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8302, 'en', 'gallery', 'Gallery', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8303, 'en', 'preferred_size_for_gallery_images_is_1110__578_px', 'Preferred size for gallery images is 1110 × 578 px', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8304, 'en', 'choose_files', 'Choose Files', '2023-05-21 06:50:33', '2023-05-21 06:50:33'),
(8305, 'en', 'afrikaans', 'Afrikaans', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8306, 'en', 'albanian', 'Albanian', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8307, 'en', 'amharic', 'Amharic', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8308, 'en', 'armenian', 'Armenian', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8309, 'en', 'azerbaijani', 'Azerbaijani', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8310, 'en', 'basque', 'Basque', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8311, 'en', 'belarusian', 'Belarusian', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8312, 'en', 'bengali', 'Bengali', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8313, 'en', 'bosnian', 'Bosnian', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8314, 'en', 'burmese', 'Burmese', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8315, 'en', 'catalan', 'Catalan', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8316, 'en', 'filipino', 'Filipino', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8317, 'en', 'galician', 'Galician', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8318, 'en', 'georgian', 'Georgian', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8319, 'en', 'gujarati', 'Gujarati', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8320, 'en', 'haitian_creole', 'Haitian Creole', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8321, 'en', 'hausa', 'Hausa', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8322, 'en', 'igbo', 'Igbo', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8323, 'en', 'irish', 'Irish', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8324, 'en', 'javanese', 'Javanese', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8325, 'en', 'kannada', 'Kannada', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8326, 'en', 'kazakh', 'Kazakh', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8327, 'en', 'khmer', 'Khmer', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8328, 'en', 'kinyarwanda', 'Kinyarwanda', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8329, 'en', 'kurdish', 'Kurdish', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8330, 'en', 'kyrgyz', 'Kyrgyz', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8331, 'en', 'lao', 'Lao', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8332, 'en', 'latvian', 'Latvian', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8333, 'en', 'luxembourgish', 'Luxembourgish', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8334, 'en', 'macedonian', 'Macedonian', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8335, 'en', 'malagasy', 'Malagasy', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8336, 'en', 'malayalam', 'Malayalam', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8337, 'en', 'maltese', 'Maltese', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8338, 'en', 'maori', 'Maori', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8339, 'en', 'marathi', 'Marathi', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8340, 'en', 'mongolian', 'Mongolian', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8341, 'en', 'nepali', 'Nepali', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8342, 'en', 'nyanja', 'Nyanja', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8343, 'en', 'pashto', 'Pashto', '2023-05-21 06:50:47', '2023-05-21 06:50:47');
INSERT INTO `tl_translations` (`id`, `lang`, `lang_key`, `lang_value`, `created_at`, `updated_at`) VALUES
(8344, 'en', 'persian', 'Persian', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8345, 'en', 'punjabi', 'Punjabi', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8346, 'en', 'samoan', 'Samoan', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8347, 'en', 'scots_gaelic', 'Scots Gaelic', '2023-05-21 06:50:47', '2023-05-21 06:50:47'),
(8348, 'en', 'serbian', 'Serbian', '2023-05-21 06:50:48', '2023-05-21 06:50:48'),
(8349, 'en', 'sesotho', 'Sesotho', '2023-05-21 06:50:48', '2023-05-21 06:50:48'),
(8350, 'en', 'shona', 'Shona', '2023-05-21 06:50:48', '2023-05-21 06:50:48'),
(8351, 'en', 'sindhi', 'Sindhi', '2023-05-21 06:50:48', '2023-05-21 06:50:48'),
(8352, 'en', 'sinhala', 'Sinhala', '2023-05-21 06:50:48', '2023-05-21 06:50:48'),
(8353, 'en', 'slovak', 'Slovak', '2023-05-21 06:50:48', '2023-05-21 06:50:48'),
(8354, 'en', 'somali', 'Somali', '2023-05-21 06:50:48', '2023-05-21 06:50:48'),
(8355, 'en', 'sundanese', 'Sundanese', '2023-05-21 06:50:48', '2023-05-21 06:50:48'),
(8356, 'en', 'tajik', 'Tajik', '2023-05-21 06:50:48', '2023-05-21 06:50:48'),
(8357, 'en', 'tamil', 'Tamil', '2023-05-21 06:50:48', '2023-05-21 06:50:48'),
(8358, 'en', 'tatar', 'Tatar', '2023-05-21 06:50:48', '2023-05-21 06:50:48'),
(8359, 'en', 'telugu', 'Telugu', '2023-05-21 06:50:48', '2023-05-21 06:50:48'),
(8360, 'en', 'turkmen', 'Turkmen', '2023-05-21 06:50:48', '2023-05-21 06:50:48'),
(8361, 'en', 'urdu', 'Urdu', '2023-05-21 06:50:48', '2023-05-21 06:50:48'),
(8362, 'en', 'uyghur', 'Uyghur', '2023-05-21 06:50:48', '2023-05-21 06:50:48'),
(8363, 'en', 'uzbek', 'Uzbek', '2023-05-21 06:50:48', '2023-05-21 06:50:48'),
(8364, 'en', 'welsh', 'Welsh', '2023-05-21 06:50:48', '2023-05-21 06:50:48'),
(8365, 'en', 'xhosa', 'Xhosa', '2023-05-21 06:50:48', '2023-05-21 06:50:48'),
(8366, 'en', 'yiddish', 'Yiddish', '2023-05-21 06:50:48', '2023-05-21 06:50:48'),
(8367, 'en', 'yoruba', 'Yoruba', '2023-05-21 06:50:48', '2023-05-21 06:50:48'),
(8368, 'en', 'zulu', 'Zulu', '2023-05-21 06:50:48', '2023-05-21 06:50:48'),
(8369, 'en', 'setup_open_ai_settings', 'Setup Open AI Settings', '2023-05-21 08:31:50', '2023-05-21 08:31:50'),
(8370, 'en', 'default_openai_model', 'Default OpenAI Model', '2023-05-21 08:31:50', '2023-05-21 08:31:50'),
(8371, 'en', 'openai_secret_key', 'OpenAI Secret Key', '2023-05-21 08:31:50', '2023-05-21 08:31:50'),
(8372, 'en', 'enter_secret_key', 'Enter Secret Key', '2023-05-21 08:31:50', '2023-05-21 08:31:50'),
(8373, 'en', '_____', 'تم مسح ذاكرة التخزين المؤقت بنجاح', '2023-05-21 10:36:43', '2023-05-21 10:36:43'),
(8374, 'en', 'select_language', 'Select Language', '2023-06-01 18:48:00', '2023-06-01 18:48:00'),
(8375, 'en', 'blog_share_settings', 'Blog Share Settings', '2023-06-01 18:48:00', '2023-06-01 18:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `tl_translation_modules`
--

CREATE TABLE `tl_translation_modules` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tl_uploaded_files`
--

CREATE TABLE `tl_uploaded_files` (
  `id` int(11) NOT NULL,
  `media_type` int(11) NOT NULL DEFAULT 1,
  `name` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `alt` text DEFAULT NULL,
  `caption` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `path` text NOT NULL,
  `size` double DEFAULT NULL,
  `variant` text DEFAULT NULL,
  `file_type` varchar(150) DEFAULT NULL,
  `extension` varchar(150) DEFAULT NULL,
  `folder_name` varchar(200) DEFAULT NULL,
  `uploaded_by` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_uploaded_files`
--

INSERT INTO `tl_uploaded_files` (`id`, `media_type`, `name`, `title`, `alt`, `caption`, `description`, `path`, `size`, `variant`, `file_type`, `extension`, `folder_name`, `uploaded_by`, `created_at`, `updated_at`) VALUES
(1039, 3, 'dummy_1110x578_000000_bbbbbb', NULL, NULL, NULL, NULL, 'storage/all_files/2023/May/dummy_1110x578_000000_bbbbbb.png', 19024, '{\"large_size\":[\"700\",\"600\"],\"medium_size\":[\"500\",\"270\"],\"small_size\":[\"60\",\"60\"]}', 'image', 'png', 'storage/all_files/2023/May', 'Wade Wilson', '2023-05-10 11:02:52', '2023-05-10 11:02:52'),
(1040, 3, 'dummy_70x70_000000_bbbbbb_1040', NULL, NULL, NULL, NULL, 'storage/all_files/2023/May/dummy_70x70_000000_bbbbbb_1040.png', 1226, '{\"large_size\":[\"700\",\"600\"],\"medium_size\":[\"500\",\"270\"],\"small_size\":[\"60\",\"60\"]}', 'image', 'png', 'storage/all_files/2023/May', 'Wade Wilson', '2023-05-10 11:03:07', '2023-05-10 11:03:07'),
(1041, 3, 'img-demo_1041', NULL, NULL, NULL, NULL, 'storage/all_files/2023/May/img-demo_1041.jpg', 2972, '{\"large_size\":[\"700\",\"600\"],\"medium_size\":[\"500\",\"270\"],\"small_size\":[\"60\",\"60\"]}', 'image', 'jpg', 'storage/all_files/2023/May', 'Wade Wilson', '2023-05-10 11:04:29', '2023-05-10 11:04:30'),
(1042, 3, 'dummy_720x90_000000_cccccc_1042', NULL, NULL, NULL, NULL, 'storage/all_files/2023/May/dummy_720x90_000000_cccccc_1042.png', 5750, '{\"large_size\":[\"700\",\"600\"],\"medium_size\":[\"500\",\"270\"],\"small_size\":[\"60\",\"60\"]}', 'image', 'png', 'storage/all_files/2023/May', 'Demo Admin', '2023-05-11 05:44:51', '2023-05-11 05:44:51'),
(1043, 3, 'dummy_350x300_000000_cccccc_1043', NULL, NULL, NULL, NULL, 'storage/all_files/2023/May/dummy_350x300_000000_cccccc_1043.png', 7736, '{\"large_size\":[\"700\",\"600\"],\"medium_size\":[\"500\",\"270\"],\"small_size\":[\"60\",\"60\"]}', 'image', 'png', 'storage/all_files/2023/May', 'Demo Admin', '2023-05-11 05:45:59', '2023-05-11 05:45:59');

-- --------------------------------------------------------

--
-- Table structure for table `tl_users`
--

CREATE TABLE `tl_users` (
  `id` int(11) NOT NULL,
  `uid` varchar(150) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `remember_token` varchar(150) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_logged_in` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `user_type` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_users`
--

INSERT INTO `tl_users` (`id`, `uid`, `name`, `email`, `image`, `password`, `remember_token`, `email_verified_at`, `is_logged_in`, `status`, `user_type`, `created_at`, `updated_at`) VALUES
(1, 'DEMO-ADMIN-1230202', 'Demo Admin', 'demo@example.com', '1040', '$2y$10$a4fb9Lw2E44kYTviGQwIvOjeI2zCBz5b14YexFA.7G8n3bId/MDjy', NULL, NULL, NULL, 1, NULL, '2023-02-01 21:40:15', '2023-05-11 05:28:04');

-- --------------------------------------------------------

--
-- Table structure for table `tl_user_informations`
--

CREATE TABLE `tl_user_informations` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `custom_social` int(11) NOT NULL DEFAULT 0,
  `social` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_user_informations`
--

INSERT INTO `tl_user_informations` (`id`, `user_id`, `bio`, `custom_social`, `social`, `created_at`, `updated_at`) VALUES
(21, 1, 'On recommend tolerably my belonging or am. Mutual has cannot beauty indeed now sussex merely you.', 1, '[{\"social_icon_title\":\"Facebook\",\"social_icon\":\"fa-facebook\",\"social_icon_url\":\"facebook\",\"order\":1},{\"social_icon_title\":\"Twitter\",\"social_icon\":\"fa-twitter\",\"social_icon_url\":\"twitter\",\"order\":2},{\"social_icon_title\":\"Instagram\",\"social_icon\":\"fa-instagram\",\"social_icon_url\":\"instagram\",\"order\":3},{\"social_icon_title\":\"Linkedin\",\"social_icon\":\"fa-linkedin-square\",\"social_icon_url\":\"linked.com\",\"order\":4}]', '2023-05-10 11:46:37', '2023-05-10 11:46:37');

-- --------------------------------------------------------

--
-- Table structure for table `tl_user_types`
--

CREATE TABLE `tl_user_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tl_water_mark_image_applicable_folders`
--

CREATE TABLE `tl_water_mark_image_applicable_folders` (
  `id` int(11) NOT NULL,
  `image_type` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tl_widgets`
--

CREATE TABLE `tl_widgets` (
  `id` bigint(20) NOT NULL,
  `widget_name` varchar(255) DEFAULT NULL,
  `widget_short_desc` text DEFAULT NULL,
  `theme_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tl_widgets`
--

INSERT INTO `tl_widgets` (`id`, `widget_name`, `widget_short_desc`, `theme_id`, `created_at`, `updated_at`) VALUES
(78, 'Address Widget', 'Display address and contact', 15, '2022-12-18 18:18:25', '2022-12-18 18:18:25'),
(79, 'Newsletter Widget', 'Display Newsletter Box', 15, '2022-12-18 18:19:38', '2022-12-18 18:19:38'),
(83, 'Featured Blog Widget', NULL, 15, '2023-01-03 05:17:40', '2023-01-03 05:17:40'),
(84, 'Recent Blog Widget', NULL, 15, '2023-01-03 05:17:40', '2023-01-03 05:17:40'),
(96, 'Footer Left Menu', NULL, 15, '2023-01-08 01:00:22', '2023-01-08 01:00:22'),
(97, 'Footer Right Menu', NULL, 15, NULL, NULL),
(98, 'Author Widget', 'Display Author Information', 16, '2023-03-17 22:05:52', '2023-03-17 22:05:52'),
(99, 'Featured Blog Widget', 'Display Featured Blogs', 16, '2023-03-17 22:05:52', '2023-03-17 22:05:52'),
(100, 'Recent Blog Widget', 'Display Recent Blogs', 16, '2023-03-17 22:05:52', '2023-03-17 22:05:52'),
(101, 'Tag Widget', 'Display Tags', 16, '2023-03-17 22:05:52', '2023-03-17 22:05:52'),
(102, 'Most Commented Blog Widget', 'Display Most Commented Blogs', 16, '2023-03-17 22:05:52', '2023-03-17 22:05:52'),
(104, 'Category Widget', 'Display Category', 16, '2023-03-17 22:05:52', '2023-03-17 22:05:52'),
(105, 'Advertisement Widget', 'Display Ads', 16, '2023-03-17 22:05:52', '2023-03-17 22:05:52'),
(106, 'Newsletter Widget', 'Display Newsletter', 16, '2023-03-17 22:05:52', '2023-03-17 22:05:52');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` bigint(20) NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `visited_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `ip_address`, `user_agent`, `visited_at`) VALUES
(3420, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', '2023-05-21 16:35:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `admin_login_activity_log`
--
ALTER TABLE `admin_login_activity_log`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_admin_login_activity_log_tl_users` (`user_id`);

--
-- Indexes for table `blog_share_options`
--
ALTER TABLE `blog_share_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_tl_com_product_share_options_tl_all_status` (`status`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD KEY `FK_model_has_permissions_tl_users` (`model_id`),
  ADD KEY `FK_model_has_permissions_permissions` (`permission_id`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD KEY `FK_model_has_roles_tl_users` (`model_id`),
  ADD KEY `FK_model_has_roles_roles` (`role_id`);

--
-- Indexes for table `open_ai_settings`
--
ALTER TABLE `open_ai_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_permissions_permission_module` (`module_id`);

--
-- Indexes for table `permission_module`
--
ALTER TABLE `permission_module`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `timezones`
--
ALTER TABLE `timezones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tl_blogs`
--
ALTER TABLE `tl_blogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_tl_blogs_tl_users` (`user_id`);

--
-- Indexes for table `tl_blogs_categories`
--
ALTER TABLE `tl_blogs_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_tl_blogs_categories_tl_blogs` (`blog_id`),
  ADD KEY `FK_tl_blogs_categories_tl_blog_categories` (`category_id`);

--
-- Indexes for table `tl_blogs_tags`
--
ALTER TABLE `tl_blogs_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_tl_blogs_tags_tl_blogs` (`blog_id`),
  ADD KEY `FK_tl_blogs_tags_tl_blog_tags` (`tag_id`);

--
-- Indexes for table `tl_blog_categories`
--
ALTER TABLE `tl_blog_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_tl_blog_categories_tl_blog_categories` (`parent`);

--
-- Indexes for table `tl_blog_category_translations`
--
ALTER TABLE `tl_blog_category_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_tl_blog_category_translations_tl_blog_categories` (`category_id`);

--
-- Indexes for table `tl_blog_comments`
--
ALTER TABLE `tl_blog_comments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_tl_blog_comments_tl_blogs` (`blog_id`),
  ADD KEY `FK_tl_blog_comments_tl_blog_comments` (`parent`);

--
-- Indexes for table `tl_blog_tags`
--
ALTER TABLE `tl_blog_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tl_blog_tag_translations`
--
ALTER TABLE `tl_blog_tag_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_tl_blog_tag_translations_tl_blog_tags` (`tag_id`);

--
-- Indexes for table `tl_blog_translations`
--
ALTER TABLE `tl_blog_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_tl_blog_translations_tl_blogs` (`blog_id`);

--
-- Indexes for table `tl_email_templates`
--
ALTER TABLE `tl_email_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tl_email_template_properties`
--
ALTER TABLE `tl_email_template_properties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_tl_email_template_tl_notification_type` (`email_type`) USING BTREE;

--
-- Indexes for table `tl_email_template_variable`
--
ALTER TABLE `tl_email_template_variable`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tl_general_settings`
--
ALTER TABLE `tl_general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tl_general_settings_has_values`
--
ALTER TABLE `tl_general_settings_has_values`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_tl_general_settings_has_value_tl_general_settings` (`settings_id`);

--
-- Indexes for table `tl_languages`
--
ALTER TABLE `tl_languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_tl_language_tl_all_status` (`status`);

--
-- Indexes for table `tl_media_type`
--
ALTER TABLE `tl_media_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tl_menus`
--
ALTER TABLE `tl_menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_tl_menus_tl_menu_groups` (`menu_group_id`);

--
-- Indexes for table `tl_menu_groups`
--
ALTER TABLE `tl_menu_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tl_menu_groups_translations`
--
ALTER TABLE `tl_menu_groups_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_tl_menu_groups_translations_tl_menu_groups` (`menu_group_id`);

--
-- Indexes for table `tl_menu_group_has_positon`
--
ALTER TABLE `tl_menu_group_has_positon`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_tl_menu_group_has_positon_tl_menu_groups` (`menu_group_id`),
  ADD KEY `FK_tl_menu_group_has_positon_tl_menu_positions` (`menu_position_id`);

--
-- Indexes for table `tl_menu_items`
--
ALTER TABLE `tl_menu_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tl_menu_positions`
--
ALTER TABLE `tl_menu_positions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_tl_menu_positions_tl_themes` (`theme_id`);

--
-- Indexes for table `tl_menu_translations`
--
ALTER TABLE `tl_menu_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_tl_menu_translations_tl_menus` (`menu_id`);

--
-- Indexes for table `tl_pages`
--
ALTER TABLE `tl_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_tl_pages_tl_users` (`user_id`);

--
-- Indexes for table `tl_page_templates`
--
ALTER TABLE `tl_page_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tl_page_translations`
--
ALTER TABLE `tl_page_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_tl_page_translations_tl_pages` (`page_id`);

--
-- Indexes for table `tl_plugins`
--
ALTER TABLE `tl_plugins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tl_sidebar_has_widgets`
--
ALTER TABLE `tl_sidebar_has_widgets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_tl_sidebar_has_widgets_tl_theme_sidebars` (`sidebar_id`),
  ADD KEY `FK_tl_sidebar_has_widgets_tl_widgets` (`widget_id`);

--
-- Indexes for table `tl_sidebar_widget_has_translate_values`
--
ALTER TABLE `tl_sidebar_widget_has_translate_values`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `sidebar_widget_has_values_id` (`sidebar_widget_has_values_id`);

--
-- Indexes for table `tl_sidebar_widget_has_values`
--
ALTER TABLE `tl_sidebar_widget_has_values`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_tl_sidebar_widget_has_values_tl_sidebar_has_widgets` (`sidebar_has_widget_id`);

--
-- Indexes for table `tl_smtps`
--
ALTER TABLE `tl_smtps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tl_smtp_configs`
--
ALTER TABLE `tl_smtp_configs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_tl_smtp_configs_tl_smtps` (`smtp_id`);

--
-- Indexes for table `tl_themes`
--
ALTER TABLE `tl_themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tl_theme_default_home_page_sections`
--
ALTER TABLE `tl_theme_default_home_page_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tl_theme_default_home_page_sections_properties`
--
ALTER TABLE `tl_theme_default_home_page_sections_properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `tl_theme_option_settings`
--
ALTER TABLE `tl_theme_option_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `theme_id` (`theme_id`);

--
-- Indexes for table `tl_theme_sidebars`
--
ALTER TABLE `tl_theme_sidebars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `theme_id` (`theme_id`);

--
-- Indexes for table `tl_theme_translations`
--
ALTER TABLE `tl_theme_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tl_translations`
--
ALTER TABLE `tl_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tl_translation_modules`
--
ALTER TABLE `tl_translation_modules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tl_uploaded_files`
--
ALTER TABLE `tl_uploaded_files`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_tl_uploaded_files_tl_media_image_type` (`media_type`) USING BTREE;

--
-- Indexes for table `tl_users`
--
ALTER TABLE `tl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tl_user_informations`
--
ALTER TABLE `tl_user_informations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tl_user_types`
--
ALTER TABLE `tl_user_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tl_water_mark_image_applicable_folders`
--
ALTER TABLE `tl_water_mark_image_applicable_folders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_tl_water_mark_image_applicable_folders_tl_media_image_type` (`image_type`);

--
-- Indexes for table `tl_widgets`
--
ALTER TABLE `tl_widgets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `theme_id` (`theme_id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298;

--
-- AUTO_INCREMENT for table `admin_login_activity_log`
--
ALTER TABLE `admin_login_activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=319;

--
-- AUTO_INCREMENT for table `blog_share_options`
--
ALTER TABLE `blog_share_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=440;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  MODIFY `role_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `open_ai_settings`
--
ALTER TABLE `open_ai_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permission_module`
--
ALTER TABLE `permission_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  MODIFY `permission_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `timezones`
--
ALTER TABLE `timezones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tl_blogs`
--
ALTER TABLE `tl_blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `tl_blogs_categories`
--
ALTER TABLE `tl_blogs_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1080;

--
-- AUTO_INCREMENT for table `tl_blogs_tags`
--
ALTER TABLE `tl_blogs_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `tl_blog_categories`
--
ALTER TABLE `tl_blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

--
-- AUTO_INCREMENT for table `tl_blog_category_translations`
--
ALTER TABLE `tl_blog_category_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tl_blog_comments`
--
ALTER TABLE `tl_blog_comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tl_blog_tags`
--
ALTER TABLE `tl_blog_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `tl_blog_tag_translations`
--
ALTER TABLE `tl_blog_tag_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tl_blog_translations`
--
ALTER TABLE `tl_blog_translations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tl_email_templates`
--
ALTER TABLE `tl_email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tl_email_template_properties`
--
ALTER TABLE `tl_email_template_properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tl_email_template_variable`
--
ALTER TABLE `tl_email_template_variable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tl_general_settings`
--
ALTER TABLE `tl_general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=359;

--
-- AUTO_INCREMENT for table `tl_general_settings_has_values`
--
ALTER TABLE `tl_general_settings_has_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2152;

--
-- AUTO_INCREMENT for table `tl_languages`
--
ALTER TABLE `tl_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tl_media_type`
--
ALTER TABLE `tl_media_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tl_menus`
--
ALTER TABLE `tl_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=508;

--
-- AUTO_INCREMENT for table `tl_menu_groups`
--
ALTER TABLE `tl_menu_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tl_menu_groups_translations`
--
ALTER TABLE `tl_menu_groups_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tl_menu_group_has_positon`
--
ALTER TABLE `tl_menu_group_has_positon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `tl_menu_items`
--
ALTER TABLE `tl_menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tl_menu_positions`
--
ALTER TABLE `tl_menu_positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tl_menu_translations`
--
ALTER TABLE `tl_menu_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `tl_pages`
--
ALTER TABLE `tl_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tl_page_templates`
--
ALTER TABLE `tl_page_templates`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tl_page_translations`
--
ALTER TABLE `tl_page_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tl_plugins`
--
ALTER TABLE `tl_plugins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tl_sidebar_has_widgets`
--
ALTER TABLE `tl_sidebar_has_widgets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=826;

--
-- AUTO_INCREMENT for table `tl_sidebar_widget_has_translate_values`
--
ALTER TABLE `tl_sidebar_widget_has_translate_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tl_sidebar_widget_has_values`
--
ALTER TABLE `tl_sidebar_widget_has_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `tl_smtps`
--
ALTER TABLE `tl_smtps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tl_smtp_configs`
--
ALTER TABLE `tl_smtp_configs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tl_themes`
--
ALTER TABLE `tl_themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tl_theme_default_home_page_sections`
--
ALTER TABLE `tl_theme_default_home_page_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `tl_theme_default_home_page_sections_properties`
--
ALTER TABLE `tl_theme_default_home_page_sections_properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9912;

--
-- AUTO_INCREMENT for table `tl_theme_option_settings`
--
ALTER TABLE `tl_theme_option_settings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4454;

--
-- AUTO_INCREMENT for table `tl_theme_sidebars`
--
ALTER TABLE `tl_theme_sidebars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tl_theme_translations`
--
ALTER TABLE `tl_theme_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3025;

--
-- AUTO_INCREMENT for table `tl_translations`
--
ALTER TABLE `tl_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8376;

--
-- AUTO_INCREMENT for table `tl_translation_modules`
--
ALTER TABLE `tl_translation_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tl_uploaded_files`
--
ALTER TABLE `tl_uploaded_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1053;

--
-- AUTO_INCREMENT for table `tl_users`
--
ALTER TABLE `tl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tl_user_informations`
--
ALTER TABLE `tl_user_informations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tl_user_types`
--
ALTER TABLE `tl_user_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tl_water_mark_image_applicable_folders`
--
ALTER TABLE `tl_water_mark_image_applicable_folders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tl_widgets`
--
ALTER TABLE `tl_widgets`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3421;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_login_activity_log`
--
ALTER TABLE `admin_login_activity_log`
  ADD CONSTRAINT `FK_admin_login_activity_log_tl_users` FOREIGN KEY (`user_id`) REFERENCES `tl_users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `FK_model_has_permissions_permissions` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_model_has_permissions_tl_users` FOREIGN KEY (`model_id`) REFERENCES `tl_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `FK_model_has_roles_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_model_has_roles_tl_users` FOREIGN KEY (`model_id`) REFERENCES `tl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `FK_permissions_permission_module` FOREIGN KEY (`module_id`) REFERENCES `permission_module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `FK_role_has_permissions_permissions` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_role_has_permissions_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tl_blogs`
--
ALTER TABLE `tl_blogs`
  ADD CONSTRAINT `FK_tl_blogs_tl_users` FOREIGN KEY (`user_id`) REFERENCES `tl_users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tl_blogs_categories`
--
ALTER TABLE `tl_blogs_categories`
  ADD CONSTRAINT `FK_tl_blogs_categories_tl_blog_categories` FOREIGN KEY (`category_id`) REFERENCES `tl_blog_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tl_blogs_categories_tl_blogs` FOREIGN KEY (`blog_id`) REFERENCES `tl_blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tl_blogs_tags`
--
ALTER TABLE `tl_blogs_tags`
  ADD CONSTRAINT `FK_tl_blogs_tags_tl_blog_tags` FOREIGN KEY (`tag_id`) REFERENCES `tl_blog_tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tl_blogs_tags_tl_blogs` FOREIGN KEY (`blog_id`) REFERENCES `tl_blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tl_blog_categories`
--
ALTER TABLE `tl_blog_categories`
  ADD CONSTRAINT `FK_tl_blog_categories_tl_blog_categories` FOREIGN KEY (`parent`) REFERENCES `tl_blog_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tl_blog_category_translations`
--
ALTER TABLE `tl_blog_category_translations`
  ADD CONSTRAINT `FK_tl_blog_category_translations_tl_blog_categories` FOREIGN KEY (`category_id`) REFERENCES `tl_blog_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tl_blog_comments`
--
ALTER TABLE `tl_blog_comments`
  ADD CONSTRAINT `FK_tl_blog_comments_tl_blog_comments` FOREIGN KEY (`parent`) REFERENCES `tl_blog_comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tl_blog_comments_tl_blogs` FOREIGN KEY (`blog_id`) REFERENCES `tl_blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tl_blog_tag_translations`
--
ALTER TABLE `tl_blog_tag_translations`
  ADD CONSTRAINT `FK_tl_blog_tag_translations_tl_blog_tags` FOREIGN KEY (`tag_id`) REFERENCES `tl_blog_tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tl_blog_translations`
--
ALTER TABLE `tl_blog_translations`
  ADD CONSTRAINT `FK_tl_blog_translations_tl_blogs` FOREIGN KEY (`blog_id`) REFERENCES `tl_blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tl_theme_default_home_page_sections_properties`
--
ALTER TABLE `tl_theme_default_home_page_sections_properties`
  ADD CONSTRAINT `tl_theme_default_home_page_sections_properties_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `tl_theme_default_home_page_sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tl_user_informations`
--
ALTER TABLE `tl_user_informations`
  ADD CONSTRAINT `tl_user_informations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


--
-- Modification For 1.2.0 Update
--

ALTER TABLE tl_pages
  ADD COLUMN is_home BOOLEAN DEFAULT 0,
  ADD COLUMN page_type VARCHAR(250) COLLATE utf8mb4_general_ci DEFAULT 'default';


INSERT INTO `permission_module` (`id`, `parent_module`, `module_name`, `module_type`, `location`, `order`, `created_at`, `updated_at`) VALUES (NULL, 'Plugins', 'Plugins', 'base', NULL, '18', current_timestamp(), NULL);

INSERT INTO `permission_module` (`id`, `parent_module`, `module_name`, `module_type`, `location`, `order`, `created_at`, `updated_at`) VALUES (NULL, 'Page Builder', 'Page Builder', 'plugin', 'pagebuilder', '5', current_timestamp(), NULL);

INSERT INTO `permissions` (`id`, `name`, `module_id`, `guard_name`, `created_at`, `updated_at`) VALUES ('105', 'Manage Plugins', '84', 'web', NULL, NULL);

INSERT INTO `permissions` (`id`, `name`, `module_id`, `guard_name`, `created_at`, `updated_at`) VALUES ('106', 'Manage Page Builder', '85', 'web', NULL, NULL);

INSERT INTO `tl_plugins` (`id`, `name`, `location`, `author`, `description`, `version`, `unique_indentifier`, `is_activated`, `namespace`, `url`, `created_at`, `updated_at`) VALUES
(NULL, 'Demo Plugin', 'demo-plugin', 'Themelooks', 'Demo Plugin for CMSLooks', '1.0', 'HLbXRPYZMs', 1, 'Plugin\\DemoPlugin\\', 'http://www.themelooks.com/', '2023-07-13 11:11:36', '2023-07-13 11:11:36');

UPDATE `tl_themes` SET `version`='1.2.0' WHERE 1;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
