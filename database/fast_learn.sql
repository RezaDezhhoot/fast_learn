-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2022 at 11:06 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test3`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'default', 'updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"name\":\"\\u0631\\u0636\\u0627 \\u062f\\u0698\\u0647\\u0648\\u062a\",\"email\":\"rdezhhoot@gmail.com\",\"phone\":\"1234\",\"email_verified_at\":null,\"status\":\"confirmed\",\"image\":\"storage\\/profiles\\/mpuSDulXqovUJE3a1KP1QYeprwB7KYyizrKsVAE8.jpg\",\"password\":\"$2y$10$txRP5OJOEoXzsGJM6xZnceaZBHY5GEdJJHYsBO0W.SkYyqxh8l71C\",\"ip\":\"62d87a310cfe4\",\"otp\":\"$2y$10$V0h5ozaTDd8Yk4xVCs.TkepptV9ZsQfntauh.GyyKKWE1qEECgwGS\",\"remember_token\":\"A8zcVoi11urAnALtgB9aIKozscaKGSYmn7fxEORHDL2pii1T3fsaevtfwNrO\",\"created_at\":\"2022-07-01T12:37:38.000000Z\",\"updated_at\":\"2022-11-16T15:40:27.000000Z\"},\"old\":{\"id\":1,\"name\":\"\\u0631\\u0636\\u0627 \\u062f\\u0698\\u0647\\u0648\\u062a\",\"email\":\"rdezhhoot@gmail.com\",\"phone\":\"1234\",\"email_verified_at\":null,\"status\":\"confirmed\",\"image\":\"storage\\/profiles\\/mpuSDulXqovUJE3a1KP1QYeprwB7KYyizrKsVAE8.jpg\",\"password\":\"$2y$10$txRP5OJOEoXzsGJM6xZnceaZBHY5GEdJJHYsBO0W.SkYyqxh8l71C\",\"ip\":\"62d87a310cfe4\",\"otp\":\"$2y$10$8MWDouUElcgshPG5LKyUBuGC7fgYLJLJFhGDZ2H1hZQ5yx\\/4ioKLq\",\"remember_token\":\"A8zcVoi11urAnALtgB9aIKozscaKGSYmn7fxEORHDL2pii1T3fsaevtfwNrO\",\"created_at\":\"2022-07-01T12:37:38.000000Z\",\"updated_at\":\"2022-08-22T18:25:37.000000Z\"}}', NULL, '2022-11-16 15:40:27', '2022-11-16 15:40:27'),
(2, 'default', 'created', 'App\\Models\\Setting', 'created', 101, 'App\\Models\\User', 1, '[]', NULL, '2022-11-16 15:48:14', '2022-11-16 15:48:14'),
(3, 'default', 'created', 'App\\Models\\Setting', 'created', 102, 'App\\Models\\User', 1, '[]', NULL, '2022-11-16 15:48:14', '2022-11-16 15:48:14'),
(4, 'default', 'created', 'App\\Models\\Setting', 'created', 103, 'App\\Models\\User', 1, '[]', NULL, '2022-11-16 15:48:14', '2022-11-16 15:48:14'),
(5, 'default', 'created', 'App\\Models\\Setting', 'created', 104, 'App\\Models\\User', 1, '[]', NULL, '2022-11-16 15:48:14', '2022-11-16 15:48:14'),
(6, 'default', 'created', 'App\\Models\\Setting', 'created', 105, 'App\\Models\\User', 1, '[]', NULL, '2022-11-16 15:48:14', '2022-11-16 15:48:14'),
(7, 'default', 'updated', 'App\\Models\\Setting', 'updated', 105, 'App\\Models\\User', 1, '[]', NULL, '2022-11-16 15:53:49', '2022-11-16 15:53:49'),
(8, 'default', 'updated', 'App\\Models\\Setting', 'updated', 105, 'App\\Models\\User', 1, '[]', NULL, '2022-11-16 15:53:59', '2022-11-16 15:53:59'),
(9, 'default', 'updated', 'App\\Models\\Setting', 'updated', 105, 'App\\Models\\User', 1, '[]', NULL, '2022-11-16 16:00:54', '2022-11-16 16:00:54'),
(10, 'default', 'updated', 'App\\Models\\Setting', 'updated', 105, 'App\\Models\\User', 1, '[]', NULL, '2022-11-16 16:01:06', '2022-11-16 16:01:06'),
(11, 'default', 'updated', 'App\\Models\\Setting', 'updated', 14, 'App\\Models\\User', 1, '[]', NULL, '2022-11-16 16:42:33', '2022-11-16 16:42:33'),
(12, 'default', 'updated', 'App\\Models\\Setting', 'updated', 27, 'App\\Models\\User', 1, '[]', NULL, '2022-11-16 16:42:50', '2022-11-16 16:42:50'),
(13, 'default', 'created', 'App\\Models\\Order', 'created', 33, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":33,\"user_id\":1,\"user_ip\":\"127.0.0.1\",\"price\":\"100000.00\",\"total_price\":\"100000.00\",\"reduction_code\":null,\"reductions_value\":\"0.00\",\"discount\":\"0.00\",\"wallet_pay\":0,\"transactionId\":\"21f2d3cefa725b176b75b7ff1879f872\",\"deleted_at\":null,\"created_at\":\"2022-11-16T16:43:01.000000Z\",\"updated_at\":\"2022-11-16T16:43:01.000000Z\"}}', NULL, '2022-11-16 16:43:01', '2022-11-16 16:43:01'),
(14, 'default', 'created', 'App\\Models\\Payment', 'created', 15, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":15,\"amount\":100000,\"payment_gateway\":\"idpay\",\"payment_token\":\"21f2d3cefa725b176b75b7ff1879f872\",\"payment_ref\":null,\"model_type\":\"App\\\\Models\\\\Order\",\"model_id\":33,\"status_code\":null,\"json\":null,\"status_message\":null,\"user_id\":1,\"call_back_url\":\"\",\"ip\":\"127.0.0.1\",\"created_at\":\"2022-11-16T16:43:01.000000Z\",\"updated_at\":\"2022-11-16T16:43:01.000000Z\"}}', NULL, '2022-11-16 16:43:01', '2022-11-16 16:43:01');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_keywords` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `slug`, `title`, `body`, `user_id`, `category_id`, `status`, `image`, `seo_keywords`, `seo_description`, `created_at`, `updated_at`) VALUES
(1, '6-راه-برای-بهبود-فوری-طراحی-رابط-کاربری', '6 راه برای بهبود فوری طراحی رابط کاربری', '<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد</p>\n\n<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.</p>\n\n<div class=\"pb-3 row\">\n<div class=\"col-lg-6\">\n<h3>محتوا</h3>\n\n<ul>\n	<li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>\n	<li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>\n	<li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>\n	<li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>\n	<li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>\n	<li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>\n</ul>\n</div>\n\n<div class=\"col-lg-6\">\n<div class=\"mt-3\"><img alt=\"وبلاگ-img\" class=\"img-fluid lazy rounded-rounded\" src=\"https://rezaprojects.ir/storage/files/articles/img8.jpg\" /></div>\n</div>\n</div>\n\n<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.</p>\n', 1, 7, 'published', '/storage/files/articles/img8.jpg', 'رابط کاربری', 'رابط کاربری', '2022-07-03 21:31:07', '2022-07-27 00:00:01'),
(2, 'آموزش-نهایی-فتوشاپ-از-مبتدی', 'آموزش نهایی فتوشاپ: از مبتدی', '<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد</p>\n\n<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.</p>\n\n<div class=\"pb-3 row\">\n<div class=\"col-lg-6\">\n<h3>محتوا</h3>\n\n<ul>\n	<li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>\n	<li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>\n	<li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>\n	<li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>\n	<li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>\n	<li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>\n</ul>\n</div>\n\n<div class=\"col-lg-6\">\n<div class=\"mt-3\"><img alt=\"وبلاگ-img\" class=\"img-fluid lazy rounded-rounded\" src=\"https://rezaprojects.ir/storage/files/articles/img1.jpg\" /></div>\n</div>\n</div>\n\n<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.</p>\n', 1, 7, 'published', '/storage/files/articles/img1.jpg', 'فتوشاپ', 'فتوشاپ', '2022-07-03 21:37:07', '2022-07-26 23:59:47'),
(3, 'آموزش-فروش-تکنیک-های-عملی', 'آموزش فروش: تکنیک های عملی', '<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد</p>\n\n<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.</p>\n\n<div class=\"pb-3 row\">\n<div class=\"col-lg-6\">\n<h3>محتوا</h3>\n\n<ul>\n	<li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>\n	<li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>\n	<li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>\n	<li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>\n	<li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>\n	<li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</li>\n</ul>\n</div>\n\n<div class=\"col-lg-6\">\n<div class=\"mt-3\"><img alt=\"وبلاگ-img\" class=\"img-fluid lazy rounded-rounded\" src=\"https://rezaprojects.ir/storage/files/articles/img1.jpg\" /></div>\n</div>\n</div>\n\n<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.</p>\n', 1, 7, 'published', '/storage/files/articles/img1.jpg', 'آموزش فروش', 'آموزش فروش', '2022-07-03 21:38:20', '2022-07-26 23:59:29'),
(4, 'مقاله-تست', 'مقاله تست', '<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.<br />\nلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.<br />\nلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.<br />\nلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.<br />\nلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.<br />\n&nbsp;</p>\n', 1, 7, 'published', '/storage/UX-Designer.jpg', 'تست ، کلمه ، کلیدی', 'سئوتوضیحات', '2022-08-16 06:52:25', '2022-08-16 06:52:25');

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `card_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sheba_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `user_id`, `card_number`, `sheba_number`, `status`, `title`, `created_at`, `updated_at`) VALUES
(1, 1, '1', '1', 'available', 'test', '2022-11-16 16:44:46', '2022-11-16 16:46:11');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_keywords` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `title`, `parent_id`, `image`, `seo_keywords`, `seo_description`, `type`, `created_at`, `updated_at`) VALUES
(1, 'برنامه-نویسی', 'برنامه نویسی', NULL, '/storage/files/img3.jpg', 'برنامه نویسی', 'برنامه نویسی', 'course', '2022-07-02 19:30:06', '2022-07-02 19:30:06'),
(2, 'برنامه-نویسی-وب', 'برنامه نویسی وب', 1, '/storage/files/img3.jpg', 'برنامه نویسی وب', 'برنامه نویسی وب', 'course', '2022-07-02 19:31:10', '2022-07-02 19:31:10'),
(3, 'برنامه-نویسی-موبایل', 'برنامه نویسی موبایل', 1, '/storage/files/img3.jpg', 'تست , تست3', 'برنامه نویسی موبایل', 'course', '2022-07-02 19:31:46', '2022-07-11 18:18:24'),
(4, 'برنامه-نویسی-ویندوز', 'برنامه نویسی ویندوز', 1, '/storage/files/img3.jpg', 'برنامه نویسی ویندوز', 'برنامه نویسی ویندوز', 'course', '2022-07-02 19:32:17', '2022-07-02 19:32:17'),
(5, 'گرافیک', 'گرافیک', NULL, '/storage/files/img2.jpg', 'گرافیک', 'گرافیک', 'course', '2022-07-02 19:33:09', '2022-07-02 19:33:09'),
(6, 'سوالات-html', 'سوالات html', NULL, '/storage/files/html-basic.png', 'سوالات html', 'سوالات html', 'question', '2022-07-02 19:33:52', '2022-07-02 19:33:52'),
(7, 'مقالات', 'مقالات', NULL, '/storage/files/img1.jpg', 'مقالات', 'مقالات', 'article', '2022-07-02 19:34:14', '2022-07-02 19:34:14'),
(8, 'برنامه-نویسی2', 'برنامه نویسی2', 7, '/storage/files/img1.jpg', 'برنامه نویسی', 'برنامه نویسی', 'article', '2022-07-02 19:34:37', '2022-07-17 19:25:04');

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bg_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `autograph_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `border_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `name`, `title`, `logo`, `bg_image`, `autograph_image`, `border_image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'گواهینامه', 'فست لرن', '/storage/files/imgbin_education-logo-pre-school-png.png', '/storage/files/asd.png', '', '/storage/files/61d5f8c4ce74c.png', '2022-07-03 22:11:19', '2022-07-26 22:33:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `choices`
--

CREATE TABLE `choices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_true` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `choices`
--

INSERT INTO `choices` (`id`, `question_id`, `title`, `score`, `is_true`, `created_at`, `updated_at`) VALUES
(1, 1, 'گزینه اول', '100', 1, '2022-07-03 21:41:33', '2022-07-10 11:33:19'),
(2, 1, 'گزینه دوم', '100', 0, '2022-07-03 21:41:33', '2022-07-10 11:33:19'),
(3, 1, 'گزینه سوم', '0', 0, '2022-07-03 21:41:33', '2022-07-10 09:42:32'),
(4, 1, 'گزینه چهارم', '-15', 0, '2022-07-03 21:41:33', '2022-07-10 11:23:15'),
(10, 4, 'گزینه اول', '100', 1, '2022-07-10 11:24:30', '2022-07-10 11:24:30'),
(11, 4, 'گزینه دوم', '0', 0, '2022-07-10 11:24:30', '2022-07-10 11:24:30'),
(12, 4, 'گزینه سوم', '0', 0, '2022-07-10 11:24:30', '2022-07-10 11:24:30');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_student` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_at` timestamp NULL DEFAULT NULL,
  `ended_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_accesses`
--

CREATE TABLE `class_accesses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `status`, `content`, `commentable_type`, `commentable_id`, `parent_id`, `created_at`, `updated_at`) VALUES
(14, 1, 'confirmed', 'مواد اصلی جاوا که برای یادگیری توسعه جاوا نیاز دارید در هفت بخش اول (در مجموع حدود 14 ساعت) پوشش داده شده است. اصول جاوا در آن بخش ها پوشش داده شده است. بقیه دوره شامل مطالب متوسط، پیشرفته و اختیاری است که از نظر فنی نیازی به گذراندن آنها ندارید.', 'App\\Models\\Course', 6, NULL, '2022-07-13 21:25:02', '2022-07-13 21:25:02'),
(15, 1, 'confirmed', 'این نه تنها پنج قرن زنده مانده است، بلکه جهشی به حروفچینی الکترونیکی نیز باقی مانده است و اساساً بدون تغییر باقی مانده است. لورم ایپسوم صرفاً متن ساختگی صنعت چاپ و حروفچینی است. لورم ایپسوم ساختگی استاندارد این صنعت بوده است', 'App\\Models\\Course', 6, 14, '2022-07-13 21:26:20', '2022-07-13 21:26:20'),
(17, 1, 'confirmed', 'sadasdsad', 'App\\Models\\Course', 1, NULL, '2022-07-20 20:59:39', '2022-08-22 08:28:06'),
(18, 1, 'confirmed', 'sadasdsad', 'App\\Models\\Course', 1, NULL, '2022-07-20 21:00:02', '2022-08-22 08:28:04'),
(19, 1, 'confirmed', 'sadasdasd', 'App\\Models\\Course', 1, NULL, '2022-07-20 21:00:09', '2022-08-22 08:27:54'),
(20, 1, 'confirmed', 'asdasdasd', 'App\\Models\\Course', 1, NULL, '2022-07-20 21:00:13', '2022-08-22 08:27:53'),
(21, 1, 'confirmed', 'بسیار عالی مقاله خوبی بود.', 'App\\Models\\Article', 2, NULL, '2022-07-23 20:06:58', '2022-07-23 20:06:58'),
(22, 1, 'confirmed', 'مواد اصلی جاوا که برای یادگیری توسعه جاوا نیاز دارید در هفت بخش اول (در مجموع حدود 14 ساعت) پوشش داده شده است. اصول جاوا در آن بخش ها پوشش داده شده است. بقیه دوره شامل مطالب متوسط، پیشرفته و اختیاری است که از نظر فنی نیازی به گذراندن آنها ندارید. ', 'App\\Models\\Course', 6, NULL, '2022-07-23 20:08:48', '2022-07-23 20:08:48'),
(23, 8623, 'confirmed', 'پیام  تست', 'App\\Models\\Article', 4, NULL, '2022-08-16 06:53:01', '2022-08-16 06:53:13'),
(24, 1, 'confirmed', '5+65+65', 'App\\Models\\Course', 5, NULL, '2022-08-22 08:08:44', '2022-08-22 08:08:44'),
(26, 1, 'confirmed', '41414141414114', 'App\\Models\\Article', 4, NULL, '2022-08-22 08:18:51', '2022-08-22 08:18:51'),
(27, 1, 'confirmed', 'دیدگاه جدید', 'App\\Models\\Article', 4, NULL, '2022-08-22 08:19:35', '2022-08-22 08:19:35'),
(28, 8623, 'confirmed', '11111111111111111111111111111111', 'App\\Models\\Course', 1, NULL, '2022-08-22 08:22:30', '2022-08-22 08:22:42'),
(29, 8625, 'confirmed', 'برنامه نویسی اندروید کامنت', 'App\\Models\\Course', 1, NULL, '2022-08-22 08:27:18', '2022-08-22 08:27:42'),
(30, 1, 'confirmed', 'کامنت تست ادمین', 'App\\Models\\Course', 1, NULL, '2022-08-22 08:41:30', '2022-08-22 08:41:30'),
(31, 8625, 'not_confirmed', 'کامنت تست کاربر جدید', 'App\\Models\\Course', 1, NULL, '2022-08-22 08:42:13', '2022-08-22 08:42:13'),
(32, 8625, 'not_confirmed', 'پاسخ کامنت تست', 'App\\Models\\Course', 1, 30, '2022-08-22 08:50:31', '2022-08-22 08:50:31'),
(33, 8625, 'not_confirmed', 'پاسخ کامنت تست sisi', 'App\\Models\\Course', 1, 28, '2022-08-22 08:51:02', '2022-08-22 08:51:02'),
(34, 8625, 'not_confirmed', 'شسیشسیشسیشسیش', 'App\\Models\\Course', 1, NULL, '2022-08-22 08:52:25', '2022-08-22 08:52:25'),
(35, 8625, 'confirmed', 'ضشظشظظظظظظظظظظظظظظظظظظظظظظظظ', 'App\\Models\\Course', 1, NULL, '2022-08-22 08:52:37', '2022-08-23 09:43:35');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_action` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `result` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `full_name`, `email`, `phone`, `body`, `answer`, `status`, `answer_action`, `result`, `created_at`, `updated_at`) VALUES
(5, 'admin', 'rdezhhoot@gmail.com', '09336332901', 'sadasdasd', NULL, 'failed', NULL, 'Failed to authenticate on SMTP server with username \"test3@rezadezhhoot.ir\" using the following authenticators: \"LOGIN\", \"PLAIN\". Authenticator \"LOGIN\" returned \"Expected response code \"235\" but got code \"535\", with message \"535 Incorrect authentication data\".\". Authenticator \"PLAIN\" returned \"Expected response code \"235\" but got code \"535\", with message \"535 Incorrect authentication data\".\".', '2022-07-20 20:57:07', '2022-07-20 21:38:19'),
(6, 'admin', 'rdezhhoot@gmail.com', '09336332901', 'sadad', 'asdsadad', 'checked', 'email_action', NULL, '2022-07-20 20:57:26', '2022-07-20 21:32:26'),
(7, 'admin', 'rdezhhoot@gmail.com', '09336332901', 'sadsadas', 'asdasdasdasd', 'checked', 'email_action', NULL, '2022-07-20 20:57:29', '2022-07-20 21:33:21');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reduction_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reduction_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_keywords` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expire_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `const_price` decimal(55,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `views` bigint(20) NOT NULL DEFAULT 0,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `incoming_method_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `slug`, `title`, `sub_title`, `short_body`, `long_body`, `level`, `image`, `category_id`, `quiz_id`, `teacher_id`, `status`, `reduction_type`, `reduction_value`, `seo_keywords`, `seo_description`, `start_at`, `expire_at`, `const_price`, `created_at`, `updated_at`, `views`, `type`, `incoming_method_id`) VALUES
(1, 'برنامه-نویسی-اندروید-android-programming', 'برنامه نویسی اندروید | android programming', 'در این دوره جاوا را یاد بگیرید و یک برنامه نویس کامپیوتر شوید. مهارت های با ارزش جاوا و گواهی جاوا را دریافت کنید', '<p>مهارت هایی که برای تبدیل شدن به یک تحلیلگر BI نیاز دارید - آمار، نظریه پایگاه داده، SQL، جدول - همه چیز گنجانده شده است</p>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>در آمار، SQL، جدول و حل مسئله متخصص شوید</li>\n	<li>رزومه خود را با مهارت های مورد تقاضا تقویت کنید</li>\n	<li>جمع آوری، سازماندهی، تجزیه و تحلیل و تجسم داده</li>\n</ul>\n\n<p>&nbsp;</p>\n', '<div class=\"course-overview-card\">\n<h3>شرح</h3>\n\n<p>لورم ایپسوم از دهه 1500، زمانی که یک چاپگر ناشناخته یک گالری از نوع را گرفت و آن را به هم زد تا یک کتاب نمونه تایپ بسازد، متن ساختگی استاندارد صنعت بوده است. این نه تنها پنج قرن زنده مانده است، بلکه لورم ایپسوم متن ساختگی استاندارد صنعت از دهه 1500 بوده است، زمانی که یک چاپگر ناشناخته یک گالی از نوع را برداشت و آن را به هم زد تا یک کتاب نمونه بسازد.</p>\n\n<p>&nbsp;</p>\n\n<p>این نه تنها پنج قرن زنده مانده است، بلکه جهشی به حروفچینی الکترونیکی نیز باقی مانده است و اساساً بدون تغییر باقی مانده است. لورم ایپسوم صرفاً متن ساختگی صنعت چاپ و حروفچینی است. لورم ایپسوم ساختگی استاندارد این صنعت بوده است</p>\n\n<p>&nbsp;</p>\n\n<h5><strong>آیا قصد دارید اولین شغل برنامه نویسی جاوا خود را به دست آورید</strong></h5>\n\n<p>این دوره آموزشی به گونه ای طراحی شده است که مهارت های جاوا را برای به دست آوردن شغل به عنوان توسعه دهنده جاوا به شما بدهد. در پایان دوره، جاوا را به خوبی درک خواهید کرد و می توانید برنامه های جاوای خود را بسازید و به عنوان یک توسعه دهنده نرم افزار سازنده باشید.</p>\n\n<div class=\"collapse show\" id=\"collapseMore\">\n<p>مواد اصلی جاوا که برای یادگیری توسعه جاوا نیاز دارید در هفت بخش اول (در مجموع حدود 14 ساعت) پوشش داده شده است. اصول جاوا در آن بخش ها پوشش داده شده است. بقیه دوره شامل مطالب متوسط، پیشرفته و اختیاری است که از نظر فنی نیازی به گذراندن آنها ندارید.</p>\n\n<h4>این دوره برای چه کسانی است:</h4>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n</ul>\n</div>\n</div>\n', 'all_level', '/storage/files/20-Ways-To-Learn-Android-Programming-For-Free.png', 3, NULL, 1, 'holding', NULL, '0', 'اموزش برنامه نویسی اندرید , اندرید ', 'اموزش برنامه نویسی اندرید', NULL, NULL, '325000.00', '2022-07-02 19:44:14', '2022-08-22 08:52:41', 46, 'offline', NULL),
(2, 'اموزش-برنامه-نویسی-php-programming-php', 'اموزش برنامه نویسی php programming | php', 'در این دوره جاوا را یاد بگیرید و یک برنامه نویس کامپیوتر شوید. مهارت های با ارزش جاوا و گواهی جاوا را دریافت کنید', '<p>مهارت هایی که برای تبدیل شدن به یک تحلیلگر BI نیاز دارید - آمار، نظریه پایگاه داده، SQL، جدول - همه چیز گنجانده شده است</p>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>در آمار، SQL، جدول و حل مسئله متخصص شوید</li>\n	<li>رزومه خود را با مهارت های مورد تقاضا تقویت کنید</li>\n	<li>جمع آوری، سازماندهی، تجزیه و تحلیل و تجسم داده</li>\n</ul>\n\n<p>&nbsp;</p>\n', '<div class=\"course-overview-card\">\n<h3>شرح</h3>\n\n<p>لورم ایپسوم از دهه 1500، زمانی که یک چاپگر ناشناخته یک گالری از نوع را گرفت و آن را به هم زد تا یک کتاب نمونه تایپ بسازد، متن ساختگی استاندارد صنعت بوده است. این نه تنها پنج قرن زنده مانده است، بلکه لورم ایپسوم متن ساختگی استاندارد صنعت از دهه 1500 بوده است، زمانی که یک چاپگر ناشناخته یک گالی از نوع را برداشت و آن را به هم زد تا یک کتاب نمونه بسازد.</p>\n\n<p>&nbsp;</p>\n\n<p>این نه تنها پنج قرن زنده مانده است، بلکه جهشی به حروفچینی الکترونیکی نیز باقی مانده است و اساساً بدون تغییر باقی مانده است. لورم ایپسوم صرفاً متن ساختگی صنعت چاپ و حروفچینی است. لورم ایپسوم ساختگی استاندارد این صنعت بوده است</p>\n\n<p>&nbsp;</p>\n\n<h5><strong>آیا قصد دارید اولین شغل برنامه نویسی جاوا خود را به دست آورید</strong></h5>\n\n<p>این دوره آموزشی به گونه ای طراحی شده است که مهارت های جاوا را برای به دست آوردن شغل به عنوان توسعه دهنده جاوا به شما بدهد. در پایان دوره، جاوا را به خوبی درک خواهید کرد و می توانید برنامه های جاوای خود را بسازید و به عنوان یک توسعه دهنده نرم افزار سازنده باشید.</p>\n\n<div class=\"collapse show\" id=\"collapseMore\">\n<p>مواد اصلی جاوا که برای یادگیری توسعه جاوا نیاز دارید در هفت بخش اول (در مجموع حدود 14 ساعت) پوشش داده شده است. اصول جاوا در آن بخش ها پوشش داده شده است. بقیه دوره شامل مطالب متوسط، پیشرفته و اختیاری است که از نظر فنی نیازی به گذراندن آنها ندارید.</p>\n\n<h4>این دوره برای چه کسانی است:</h4>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n</ul>\n</div>\n</div>\n', 'medium', '/storage/files/php-programming-language(1).jpg', 2, NULL, 1, 'holding', 'amount', '75000', 'اموزش برنامه نویسی php', 'اموزش برنامه نویسی php', NULL, NULL, '423000.00', '2022-07-02 19:53:08', '2022-08-07 14:19:45', 23, 'offline', NULL),
(3, 'اموزش-برنامه-نویسی-ویندوز-c-programming', 'اموزش برنامه نویسی ویندوز | c# programming', 'در این دوره جاوا را یاد بگیرید و یک برنامه نویس کامپیوتر شوید. مهارت های با ارزش جاوا و گواهی جاوا را دریافت کنید', '<p>مهارت هایی که برای تبدیل شدن به یک تحلیلگر BI نیاز دارید - آمار، نظریه پایگاه داده، SQL، جدول - همه چیز گنجانده شده است</p>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>در آمار، SQL، جدول و حل مسئله متخصص شوید</li>\n	<li>رزومه خود را با مهارت های مورد تقاضا تقویت کنید</li>\n	<li>جمع آوری، سازماندهی، تجزیه و تحلیل و تجسم داده</li>\n</ul>\n', '<div class=\"course-overview-card\">\n<h3>شرح</h3>\n\n<p>لورم ایپسوم از دهه 1500، زمانی که یک چاپگر ناشناخته یک گالری از نوع را گرفت و آن را به هم زد تا یک کتاب نمونه تایپ بسازد، متن ساختگی استاندارد صنعت بوده است. این نه تنها پنج قرن زنده مانده است، بلکه لورم ایپسوم متن ساختگی استاندارد صنعت از دهه 1500 بوده است، زمانی که یک چاپگر ناشناخته یک گالی از نوع را برداشت و آن را به هم زد تا یک کتاب نمونه بسازد.</p>\n\n<p>&nbsp;</p>\n\n<p>این نه تنها پنج قرن زنده مانده است، بلکه جهشی به حروفچینی الکترونیکی نیز باقی مانده است و اساساً بدون تغییر باقی مانده است. لورم ایپسوم صرفاً متن ساختگی صنعت چاپ و حروفچینی است. لورم ایپسوم ساختگی استاندارد این صنعت بوده است</p>\n\n<p>&nbsp;</p>\n\n<h5><strong>آیا قصد دارید اولین شغل برنامه نویسی جاوا خود را به دست آورید</strong></h5>\n\n<p>این دوره آموزشی به گونه ای طراحی شده است که مهارت های جاوا را برای به دست آوردن شغل به عنوان توسعه دهنده جاوا به شما بدهد. در پایان دوره، جاوا را به خوبی درک خواهید کرد و می توانید برنامه های جاوای خود را بسازید و به عنوان یک توسعه دهنده نرم افزار سازنده باشید.</p>\n\n<div class=\"collapse show\" id=\"collapseMore\">\n<p>مواد اصلی جاوا که برای یادگیری توسعه جاوا نیاز دارید در هفت بخش اول (در مجموع حدود 14 ساعت) پوشش داده شده است. اصول جاوا در آن بخش ها پوشش داده شده است. بقیه دوره شامل مطالب متوسط، پیشرفته و اختیاری است که از نظر فنی نیازی به گذراندن آنها ندارید.</p>\n\n<h4>این دوره برای چه کسانی است:</h4>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n</ul>\n</div>\n</div>\n', 'beginner', '/storage/files/b8ba300b.png', 4, NULL, 1, 'coming_soon', NULL, '0', 'c# programming', 'c# programming', NULL, NULL, '150000.00', '2022-07-02 20:01:02', '2022-08-22 08:15:47', 63, 'offline', NULL),
(4, 'اموزش-زبان-سالیدیتی', 'اموزش زبان سالیدیتی  ', 'در این دوره جاوا را یاد بگیرید و یک برنامه نویس کامپیوتر شوید. مهارت های با ارزش جاوا و گواهی جاوا را دریافت کنید', '<p>مهارت هایی که برای تبدیل شدن به یک تحلیلگر BI نیاز دارید - آمار، نظریه پایگاه داده، SQL، جدول - همه چیز گنجانده شده است</p>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>در آمار، SQL، جدول و حل مسئله متخصص شوید</li>\n	<li>رزومه خود را با مهارت های مورد تقاضا تقویت کنید</li>\n	<li>جمع آوری، سازماندهی، تجزیه و تحلیل و تجسم داده</li>\n</ul>\n', '<div class=\"course-overview-card\">\n<h3>شرح</h3>\n\n<p>لورم ایپسوم از دهه 1500، زمانی که یک چاپگر ناشناخته یک گالری از نوع را گرفت و آن را به هم زد تا یک کتاب نمونه تایپ بسازد، متن ساختگی استاندارد صنعت بوده است. این نه تنها پنج قرن زنده مانده است، بلکه لورم ایپسوم متن ساختگی استاندارد صنعت از دهه 1500 بوده است، زمانی که یک چاپگر ناشناخته یک گالی از نوع را برداشت و آن را به هم زد تا یک کتاب نمونه بسازد.</p>\n\n<p>&nbsp;</p>\n\n<p>این نه تنها پنج قرن زنده مانده است، بلکه جهشی به حروفچینی الکترونیکی نیز باقی مانده است و اساساً بدون تغییر باقی مانده است. لورم ایپسوم صرفاً متن ساختگی صنعت چاپ و حروفچینی است. لورم ایپسوم ساختگی استاندارد این صنعت بوده است</p>\n\n<p>&nbsp;</p>\n\n<h5><strong>آیا قصد دارید اولین شغل برنامه نویسی جاوا خود را به دست آورید</strong></h5>\n\n<p>این دوره آموزشی به گونه ای طراحی شده است که مهارت های جاوا را برای به دست آوردن شغل به عنوان توسعه دهنده جاوا به شما بدهد. در پایان دوره، جاوا را به خوبی درک خواهید کرد و می توانید برنامه های جاوای خود را بسازید و به عنوان یک توسعه دهنده نرم افزار سازنده باشید.</p>\n\n<div class=\"collapse show\" id=\"collapseMore\">\n<p>مواد اصلی جاوا که برای یادگیری توسعه جاوا نیاز دارید در هفت بخش اول (در مجموع حدود 14 ساعت) پوشش داده شده است. اصول جاوا در آن بخش ها پوشش داده شده است. بقیه دوره شامل مطالب متوسط، پیشرفته و اختیاری است که از نظر فنی نیازی به گذراندن آنها ندارید.</p>\n\n<h4>این دوره برای چه کسانی است:</h4>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n</ul>\n</div>\n</div>\n', 'beginner', '/storage/files/Understanding-Ethereums-Solidity-Programming-Language.jpg', 1, NULL, 1, 'finished', NULL, '0', 'solidity programming', 'solidity programming', NULL, NULL, '0.00', '2022-07-02 20:05:14', '2022-08-22 08:15:24', 51, 'in_person', NULL),
(5, 'اموزش-جامع-لاراول', 'اموزش جامع لاراول', 'در این دوره جاوا را یاد بگیرید و یک برنامه نویس کامپیوتر شوید. مهارت های با ارزش جاوا و گواهی جاوا را دریافت کنید', '<p>مهارت هایی که برای تبدیل شدن به یک تحلیلگر BI نیاز دارید - آمار، نظریه پایگاه داده، SQL، جدول - همه چیز گنجانده شده است</p>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>در آمار، SQL، جدول و حل مسئله متخصص شوید</li>\n	<li>رزومه خود را با مهارت های مورد تقاضا تقویت کنید</li>\n	<li>جمع آوری، سازماندهی، تجزیه و تحلیل و تجسم داده</li>\n</ul>\n', '<div class=\"course-overview-card\">\n<h3>شرح</h3>\n\n<p>لورم ایپسوم از دهه 1500، زمانی که یک چاپگر ناشناخته یک گالری از نوع را گرفت و آن را به هم زد تا یک کتاب نمونه تایپ بسازد، متن ساختگی استاندارد صنعت بوده است. این نه تنها پنج قرن زنده مانده است، بلکه لورم ایپسوم متن ساختگی استاندارد صنعت از دهه 1500 بوده است، زمانی که یک چاپگر ناشناخته یک گالی از نوع را برداشت و آن را به هم زد تا یک کتاب نمونه بسازد.</p>\n\n<p>&nbsp;</p>\n\n<p>این نه تنها پنج قرن زنده مانده است، بلکه جهشی به حروفچینی الکترونیکی نیز باقی مانده است و اساساً بدون تغییر باقی مانده است. لورم ایپسوم صرفاً متن ساختگی صنعت چاپ و حروفچینی است. لورم ایپسوم ساختگی استاندارد این صنعت بوده است</p>\n\n<p>&nbsp;</p>\n\n<h5><strong>آیا قصد دارید اولین شغل برنامه نویسی جاوا خود را به دست آورید</strong></h5>\n\n<p>این دوره آموزشی به گونه ای طراحی شده است که مهارت های جاوا را برای به دست آوردن شغل به عنوان توسعه دهنده جاوا به شما بدهد. در پایان دوره، جاوا را به خوبی درک خواهید کرد و می توانید برنامه های جاوای خود را بسازید و به عنوان یک توسعه دهنده نرم افزار سازنده باشید.</p>\n\n<div class=\"collapse show\" id=\"collapseMore\">\n<p>مواد اصلی جاوا که برای یادگیری توسعه جاوا نیاز دارید در هفت بخش اول (در مجموع حدود 14 ساعت) پوشش داده شده است. اصول جاوا در آن بخش ها پوشش داده شده است. بقیه دوره شامل مطالب متوسط، پیشرفته و اختیاری است که از نظر فنی نیازی به گذراندن آنها ندارید.</p>\n\n<h4>این دوره برای چه کسانی است:</h4>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n</ul>\n</div>\n</div>\n', 'all_level', '/storage/files/Why_Laravel.jpg', 2, NULL, 1, 'finished', NULL, '0', 'اموزش جامع لاراول', 'اموزش جامع لاراول', NULL, NULL, '720000.00', '2022-07-02 20:30:30', '2022-08-22 08:16:04', 21, 'offline', NULL),
(6, 'اموزش-جامع-nodeJS', 'اموزش جامع nodeJS', 'در این دوره جاوا را یاد بگیرید و یک برنامه نویس کامپیوتر شوید. مهارت های با ارزش جاوا و گواهی جاوا را دریافت کنید', '<p>مهارت هایی که برای تبدیل شدن به یک تحلیلگر BI نیاز دارید - آمار، نظریه پایگاه داده، SQL، جدول - همه چیز گنجانده شده است</p>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>در آمار، SQL، جدول و حل مسئله متخصص شوید</li>\n	<li>رزومه خود را با مهارت های مورد تقاضا تقویت کنید</li>\n	<li>جمع آوری، سازماندهی، تجزیه و تحلیل و تجسم داده</li>\n</ul>\n', '<div class=\"course-overview-card\">\n<h3>شرح</h3>\n\n<p>لورم ایپسوم از دهه 1500، زمانی که یک چاپگر ناشناخته یک گالری از نوع را گرفت و آن را به هم زد تا یک کتاب نمونه تایپ بسازد، متن ساختگی استاندارد صنعت بوده است. این نه تنها پنج قرن زنده مانده است، بلکه لورم ایپسوم متن ساختگی استاندارد صنعت از دهه 1500 بوده است، زمانی که یک چاپگر ناشناخته یک گالی از نوع را برداشت و آن را به هم زد تا یک کتاب نمونه بسازد.</p>\n\n<p>&nbsp;</p>\n\n<p>این نه تنها پنج قرن زنده مانده است، بلکه جهشی به حروفچینی الکترونیکی نیز باقی مانده است و اساساً بدون تغییر باقی مانده است. لورم ایپسوم صرفاً متن ساختگی صنعت چاپ و حروفچینی است. لورم ایپسوم ساختگی استاندارد این صنعت بوده است</p>\n\n<p>&nbsp;</p>\n\n<h5><strong>آیا قصد دارید اولین شغل برنامه نویسی جاوا خود را به دست آورید</strong></h5>\n\n<p>این دوره آموزشی به گونه ای طراحی شده است که مهارت های جاوا را برای به دست آوردن شغل به عنوان توسعه دهنده جاوا به شما بدهد. در پایان دوره، جاوا را به خوبی درک خواهید کرد و می توانید برنامه های جاوای خود را بسازید و به عنوان یک توسعه دهنده نرم افزار سازنده باشید.</p>\n\n<div class=\"collapse show\" id=\"collapseMore\">\n<p>مواد اصلی جاوا که برای یادگیری توسعه جاوا نیاز دارید در هفت بخش اول (در مجموع حدود 14 ساعت) پوشش داده شده است. اصول جاوا در آن بخش ها پوشش داده شده است. بقیه دوره شامل مطالب متوسط، پیشرفته و اختیاری است که از نظر فنی نیازی به گذراندن آنها ندارید.</p>\n\n<h4>این دوره برای چه کسانی است:</h4>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n</ul>\n</div>\n</div>\n', 'professional', '/storage/files/uyE3YnQqGkfSCHrgBEkicAhQ.png', 2, 1, 1, 'holding', 'percent', '50', 'nodeJS , nodeJS', 'اموزش جامع nodeJS', '2022-07-14', NULL, '780000.00', '2022-07-02 20:34:23', '2022-08-21 18:28:40', 308, 'offline', NULL),
(10, 'دوره-اموزشی-جاوا-java-programming', 'دوره اموزشی جاوا | java programming', 'در این دوره جاوا را یاد بگیرید و یک برنامه نویس کامپیوتر شوید. مهارت های با ارزش جاوا و گواهی جاوا را دریافت کنید', '<p>مهارت هایی که برای تبدیل شدن به یک تحلیلگر BI نیاز دارید - آمار، نظریه پایگاه داده، SQL، جدول - همه چیز گنجانده شده است</p>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>در آمار، SQL، جدول و حل مسئله متخصص شوید</li>\n	<li>رزومه خود را با مهارت های مورد تقاضا تقویت کنید</li>\n	<li>جمع آوری، سازماندهی، تجزیه و تحلیل و تجسم داده</li>\n</ul>\n', '<div class=\"course-overview-card\">\n<h3>شرح</h3>\n\n<p>لورم ایپسوم از دهه 1500، زمانی که یک چاپگر ناشناخته یک گالری از نوع را گرفت و آن را به هم زد تا یک کتاب نمونه تایپ بسازد، متن ساختگی استاندارد صنعت بوده است. این نه تنها پنج قرن زنده مانده است، بلکه لورم ایپسوم متن ساختگی استاندارد صنعت از دهه 1500 بوده است، زمانی که یک چاپگر ناشناخته یک گالی از نوع را برداشت و آن را به هم زد تا یک کتاب نمونه بسازد.</p>\n\n<p>&nbsp;</p>\n\n<p>این نه تنها پنج قرن زنده مانده است، بلکه جهشی به حروفچینی الکترونیکی نیز باقی مانده است و اساساً بدون تغییر باقی مانده است. لورم ایپسوم صرفاً متن ساختگی صنعت چاپ و حروفچینی است. لورم ایپسوم ساختگی استاندارد این صنعت بوده است</p>\n\n<p>&nbsp;</p>\n\n<h5><strong>آیا قصد دارید اولین شغل برنامه نویسی جاوا خود را به دست آورید</strong></h5>\n\n<p>این دوره آموزشی به گونه ای طراحی شده است که مهارت های جاوا را برای به دست آوردن شغل به عنوان توسعه دهنده جاوا به شما بدهد. در پایان دوره، جاوا را به خوبی درک خواهید کرد و می توانید برنامه های جاوای خود را بسازید و به عنوان یک توسعه دهنده نرم افزار سازنده باشید.</p>\n\n<div class=\"collapse show\" id=\"collapseMore\">\n<p>مواد اصلی جاوا که برای یادگیری توسعه جاوا نیاز دارید در هفت بخش اول (در مجموع حدود 14 ساعت) پوشش داده شده است. اصول جاوا در آن بخش ها پوشش داده شده است. بقیه دوره شامل مطالب متوسط، پیشرفته و اختیاری است که از نظر فنی نیازی به گذراندن آنها ندارید.</p>\n\n<h4>این دوره برای چه کسانی است:</h4>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n</ul>\n</div>\n</div>\n', 'professional', '/storage/java-programming-wallpaper1.jpg', 3, NULL, 1, 'holding', NULL, '0', 's', 's', NULL, NULL, '325000.00', '2022-07-21 11:22:56', '2022-08-03 05:11:43', 8, 'offline', NULL),
(11, 'اموزش-کاتلین-kotlin-programming', 'اموزش کاتلین | kotlin programming', 'در این دوره جاوا را یاد بگیرید و یک برنامه نویس کامپیوتر شوید. مهارت های با ارزش جاوا و گواهی جاوا را دریافت کنید', '<p>مهارت هایی که برای تبدیل شدن به یک تحلیلگر BI نیاز دارید - آمار، نظریه پایگاه داده، SQL، جدول - همه چیز گنجانده شده است</p>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>در آمار، SQL، جدول و حل مسئله متخصص شوید</li>\n	<li>رزومه خود را با مهارت های مورد تقاضا تقویت کنید</li>\n	<li>جمع آوری، سازماندهی، تجزیه و تحلیل و تجسم داده</li>\n</ul>\n', '<div class=\"course-overview-card\">\n<h3>شرح</h3>\n\n<p>لورم ایپسوم از دهه 1500، زمانی که یک چاپگر ناشناخته یک گالری از نوع را گرفت و آن را به هم زد تا یک کتاب نمونه تایپ بسازد، متن ساختگی استاندارد صنعت بوده است. این نه تنها پنج قرن زنده مانده است، بلکه لورم ایپسوم متن ساختگی استاندارد صنعت از دهه 1500 بوده است، زمانی که یک چاپگر ناشناخته یک گالی از نوع را برداشت و آن را به هم زد تا یک کتاب نمونه بسازد.</p>\n\n<p>&nbsp;</p>\n\n<p>این نه تنها پنج قرن زنده مانده است، بلکه جهشی به حروفچینی الکترونیکی نیز باقی مانده است و اساساً بدون تغییر باقی مانده است. لورم ایپسوم صرفاً متن ساختگی صنعت چاپ و حروفچینی است. لورم ایپسوم ساختگی استاندارد این صنعت بوده است</p>\n\n<p>&nbsp;</p>\n\n<h5><strong>آیا قصد دارید اولین شغل برنامه نویسی جاوا خود را به دست آورید</strong></h5>\n\n<p>این دوره آموزشی به گونه ای طراحی شده است که مهارت های جاوا را برای به دست آوردن شغل به عنوان توسعه دهنده جاوا به شما بدهد. در پایان دوره، جاوا را به خوبی درک خواهید کرد و می توانید برنامه های جاوای خود را بسازید و به عنوان یک توسعه دهنده نرم افزار سازنده باشید.</p>\n\n<div class=\"collapse show\" id=\"collapseMore\">\n<p>مواد اصلی جاوا که برای یادگیری توسعه جاوا نیاز دارید در هفت بخش اول (در مجموع حدود 14 ساعت) پوشش داده شده است. اصول جاوا در آن بخش ها پوشش داده شده است. بقیه دوره شامل مطالب متوسط، پیشرفته و اختیاری است که از نظر فنی نیازی به گذراندن آنها ندارید.</p>\n\n<h4>این دوره برای چه کسانی است:</h4>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n</ul>\n</div>\n</div>\n', 'beginner', '/storage/07.23.20-Kotlin-for-Android-1024x576.jpg', 3, NULL, 1, 'finished', NULL, '0', 'a', 'a', NULL, NULL, '120000.00', '2022-07-21 11:39:30', '2022-08-05 04:21:38', 9, 'offline', NULL),
(12, 'اموزش-برنامه-نویسی-basic-for-android', 'اموزش برنامه نویسی basic for android', 'در این دوره جاوا را یاد بگیرید و یک برنامه نویس کامپیوتر شوید. مهارت های با ارزش جاوا و گواهی جاوا را دریافت کنید', '<p>مهارت هایی که برای تبدیل شدن به یک تحلیلگر BI نیاز دارید - آمار، نظریه پایگاه داده، SQL، جدول - همه چیز گنجانده شده است</p>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>در آمار، SQL، جدول و حل مسئله متخصص شوید</li>\n	<li>رزومه خود را با مهارت های مورد تقاضا تقویت کنید</li>\n	<li>جمع آوری، سازماندهی، تجزیه و تحلیل و تجسم داده</li>\n</ul>\n', '<div class=\"course-overview-card\">\n<h3>شرح</h3>\n\n<p>لورم ایپسوم از دهه 1500، زمانی که یک چاپگر ناشناخته یک گالری از نوع را گرفت و آن را به هم زد تا یک کتاب نمونه تایپ بسازد، متن ساختگی استاندارد صنعت بوده است. این نه تنها پنج قرن زنده مانده است، بلکه لورم ایپسوم متن ساختگی استاندارد صنعت از دهه 1500 بوده است، زمانی که یک چاپگر ناشناخته یک گالی از نوع را برداشت و آن را به هم زد تا یک کتاب نمونه بسازد.</p>\n\n<p>&nbsp;</p>\n\n<p>این نه تنها پنج قرن زنده مانده است، بلکه جهشی به حروفچینی الکترونیکی نیز باقی مانده است و اساساً بدون تغییر باقی مانده است. لورم ایپسوم صرفاً متن ساختگی صنعت چاپ و حروفچینی است. لورم ایپسوم ساختگی استاندارد این صنعت بوده است</p>\n\n<p>&nbsp;</p>\n\n<h5><strong>آیا قصد دارید اولین شغل برنامه نویسی جاوا خود را به دست آورید</strong></h5>\n\n<p>این دوره آموزشی به گونه ای طراحی شده است که مهارت های جاوا را برای به دست آوردن شغل به عنوان توسعه دهنده جاوا به شما بدهد. در پایان دوره، جاوا را به خوبی درک خواهید کرد و می توانید برنامه های جاوای خود را بسازید و به عنوان یک توسعه دهنده نرم افزار سازنده باشید.</p>\n\n<div class=\"collapse show\" id=\"collapseMore\">\n<p>مواد اصلی جاوا که برای یادگیری توسعه جاوا نیاز دارید در هفت بخش اول (در مجموع حدود 14 ساعت) پوشش داده شده است. اصول جاوا در آن بخش ها پوشش داده شده است. بقیه دوره شامل مطالب متوسط، پیشرفته و اختیاری است که از نظر فنی نیازی به گذراندن آنها ندارید.</p>\n\n<h4>این دوره برای چه کسانی است:</h4>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n</ul>\n</div>\n</div>\n', 'beginner', '/storage/fvand9702-png.png', 3, NULL, 1, 'holding', NULL, '0', 'aa', 'aa', NULL, NULL, '99000.00', '2022-07-21 11:49:33', '2022-08-03 04:58:13', 9, 'online', NULL),
(13, 'اموزش-زبان-برنامه-نویسی-c', 'اموزش زبان برنامه نویسی c++', 'در این دوره جاوا را یاد بگیرید و یک برنامه نویس کامپیوتر شوید. مهارت های با ارزش جاوا و گواهی جاوا را دریافت کنید', '<p>مهارت هایی که برای تبدیل شدن به یک تحلیلگر BI نیاز دارید - آمار، نظریه پایگاه داده، SQL، جدول - همه چیز گنجانده شده است</p>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>در آمار، SQL، جدول و حل مسئله متخصص شوید</li>\n	<li>رزومه خود را با مهارت های مورد تقاضا تقویت کنید</li>\n	<li>جمع آوری، سازماندهی، تجزیه و تحلیل و تجسم داده</li>\n</ul>\n', '<div class=\"course-overview-card\">\n<h3>شرح</h3>\n\n<p>لورم ایپسوم از دهه 1500، زمانی که یک چاپگر ناشناخته یک گالری از نوع را گرفت و آن را به هم زد تا یک کتاب نمونه تایپ بسازد، متن ساختگی استاندارد صنعت بوده است. این نه تنها پنج قرن زنده مانده است، بلکه لورم ایپسوم متن ساختگی استاندارد صنعت از دهه 1500 بوده است، زمانی که یک چاپگر ناشناخته یک گالی از نوع را برداشت و آن را به هم زد تا یک کتاب نمونه بسازد.</p>\n\n<p>&nbsp;</p>\n\n<p>این نه تنها پنج قرن زنده مانده است، بلکه جهشی به حروفچینی الکترونیکی نیز باقی مانده است و اساساً بدون تغییر باقی مانده است. لورم ایپسوم صرفاً متن ساختگی صنعت چاپ و حروفچینی است. لورم ایپسوم ساختگی استاندارد این صنعت بوده است</p>\n\n<p>&nbsp;</p>\n\n<h5><strong>آیا قصد دارید اولین شغل برنامه نویسی جاوا خود را به دست آورید</strong></h5>\n\n<p>این دوره آموزشی به گونه ای طراحی شده است که مهارت های جاوا را برای به دست آوردن شغل به عنوان توسعه دهنده جاوا به شما بدهد. در پایان دوره، جاوا را به خوبی درک خواهید کرد و می توانید برنامه های جاوای خود را بسازید و به عنوان یک توسعه دهنده نرم افزار سازنده باشید.</p>\n\n<div class=\"collapse show\" id=\"collapseMore\">\n<p>مواد اصلی جاوا که برای یادگیری توسعه جاوا نیاز دارید در هفت بخش اول (در مجموع حدود 14 ساعت) پوشش داده شده است. اصول جاوا در آن بخش ها پوشش داده شده است. بقیه دوره شامل مطالب متوسط، پیشرفته و اختیاری است که از نظر فنی نیازی به گذراندن آنها ندارید.</p>\n\n<h4>این دوره برای چه کسانی است:</h4>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n</ul>\n</div>\n</div>\n', 'beginner', '/storage/6038586442907648.png', 4, NULL, 1, 'holding', NULL, '0', 'a', 'a', NULL, NULL, '50000.00', '2022-07-21 12:03:20', '2022-08-16 07:02:08', 9, 'offline', NULL),
(14, 'اموزش-طراحی-UIX', 'اموزش طراحی UIX', 'در این دوره جاوا را یاد بگیرید و یک برنامه نویس کامپیوتر شوید. مهارت های با ارزش جاوا و گواهی جاوا را دریافت کنید', '<p>مهارت هایی که برای تبدیل شدن به یک تحلیلگر BI نیاز دارید - آمار، نظریه پایگاه داده، SQL، جدول - همه چیز گنجانده شده است</p>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>در آمار، SQL، جدول و حل مسئله متخصص شوید</li>\n	<li>رزومه خود را با مهارت های مورد تقاضا تقویت کنید</li>\n	<li>جمع آوری، سازماندهی، تجزیه و تحلیل و تجسم داده</li>\n</ul>\n', '<div class=\"course-overview-card\">\n<h3>شرح</h3>\n\n<p>لورم ایپسوم از دهه 1500، زمانی که یک چاپگر ناشناخته یک گالری از نوع را گرفت و آن را به هم زد تا یک کتاب نمونه تایپ بسازد، متن ساختگی استاندارد صنعت بوده است. این نه تنها پنج قرن زنده مانده است، بلکه لورم ایپسوم متن ساختگی استاندارد صنعت از دهه 1500 بوده است، زمانی که یک چاپگر ناشناخته یک گالی از نوع را برداشت و آن را به هم زد تا یک کتاب نمونه بسازد.</p>\n\n<p>&nbsp;</p>\n\n<p>این نه تنها پنج قرن زنده مانده است، بلکه جهشی به حروفچینی الکترونیکی نیز باقی مانده است و اساساً بدون تغییر باقی مانده است. لورم ایپسوم صرفاً متن ساختگی صنعت چاپ و حروفچینی است. لورم ایپسوم ساختگی استاندارد این صنعت بوده است</p>\n\n<p>&nbsp;</p>\n\n<h5><strong>آیا قصد دارید اولین شغل برنامه نویسی جاوا خود را به دست آورید</strong></h5>\n\n<p>این دوره آموزشی به گونه ای طراحی شده است که مهارت های جاوا را برای به دست آوردن شغل به عنوان توسعه دهنده جاوا به شما بدهد. در پایان دوره، جاوا را به خوبی درک خواهید کرد و می توانید برنامه های جاوای خود را بسازید و به عنوان یک توسعه دهنده نرم افزار سازنده باشید.</p>\n\n<div class=\"collapse show\" id=\"collapseMore\">\n<p>مواد اصلی جاوا که برای یادگیری توسعه جاوا نیاز دارید در هفت بخش اول (در مجموع حدود 14 ساعت) پوشش داده شده است. اصول جاوا در آن بخش ها پوشش داده شده است. بقیه دوره شامل مطالب متوسط، پیشرفته و اختیاری است که از نظر فنی نیازی به گذراندن آنها ندارید.</p>\n\n<h4>این دوره برای چه کسانی است:</h4>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n</ul>\n</div>\n</div>\n', 'medium', '/storage/UX-Designer.jpg', 5, NULL, 1, 'holding', NULL, '0', 's', 's', NULL, NULL, '55000.00', '2022-07-21 12:15:32', '2022-08-07 20:36:36', 10, 'in_person', NULL),
(15, 'اموزش-فوتوشاپ-photoshop', 'اموزش فوتوشاپ | photoshop', 'در این دوره جاوا را یاد بگیرید و یک برنامه نویس کامپیوتر شوید. مهارت های با ارزش جاوا و گواهی جاوا را دریافت کنید', '<p>مهارت هایی که برای تبدیل شدن به یک تحلیلگر BI نیاز دارید - آمار، نظریه پایگاه داده، SQL، جدول - همه چیز گنجانده شده است</p>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>در آمار، SQL، جدول و حل مسئله متخصص شوید</li>\n	<li>رزومه خود را با مهارت های مورد تقاضا تقویت کنید</li>\n	<li>جمع آوری، سازماندهی، تجزیه و تحلیل و تجسم داده</li>\n</ul>\n', '<div class=\"course-overview-card\">\n<h3>شرح</h3>\n\n<p>لورم ایپسوم از دهه 1500، زمانی که یک چاپگر ناشناخته یک گالری از نوع را گرفت و آن را به هم زد تا یک کتاب نمونه تایپ بسازد، متن ساختگی استاندارد صنعت بوده است. این نه تنها پنج قرن زنده مانده است، بلکه لورم ایپسوم متن ساختگی استاندارد صنعت از دهه 1500 بوده است، زمانی که یک چاپگر ناشناخته یک گالی از نوع را برداشت و آن را به هم زد تا یک کتاب نمونه بسازد.</p>\n\n<p>&nbsp;</p>\n\n<p>این نه تنها پنج قرن زنده مانده است، بلکه جهشی به حروفچینی الکترونیکی نیز باقی مانده است و اساساً بدون تغییر باقی مانده است. لورم ایپسوم صرفاً متن ساختگی صنعت چاپ و حروفچینی است. لورم ایپسوم ساختگی استاندارد این صنعت بوده است</p>\n\n<p>&nbsp;</p>\n\n<h5><strong>آیا قصد دارید اولین شغل برنامه نویسی جاوا خود را به دست آورید</strong></h5>\n\n<p>این دوره آموزشی به گونه ای طراحی شده است که مهارت های جاوا را برای به دست آوردن شغل به عنوان توسعه دهنده جاوا به شما بدهد. در پایان دوره، جاوا را به خوبی درک خواهید کرد و می توانید برنامه های جاوای خود را بسازید و به عنوان یک توسعه دهنده نرم افزار سازنده باشید.</p>\n\n<div class=\"collapse show\" id=\"collapseMore\">\n<p>مواد اصلی جاوا که برای یادگیری توسعه جاوا نیاز دارید در هفت بخش اول (در مجموع حدود 14 ساعت) پوشش داده شده است. اصول جاوا در آن بخش ها پوشش داده شده است. بقیه دوره شامل مطالب متوسط، پیشرفته و اختیاری است که از نظر فنی نیازی به گذراندن آنها ندارید.</p>\n\n<h4>این دوره برای چه کسانی است:</h4>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n</ul>\n</div>\n</div>\n', 'medium', '/storage/images.png', 5, NULL, 1, 'coming_soon', 'percent', '15', 's', 's', NULL, NULL, '330000.00', '2022-07-21 12:21:33', '2022-08-16 07:10:27', 8, 'offline', NULL),
(16, 'اموزش-figma', 'اموزش figma ', 'در این دوره جاوا را یاد بگیرید و یک برنامه نویس کامپیوتر شوید. مهارت های با ارزش جاوا و گواهی جاوا را دریافت کنید', '<p>مهارت هایی که برای تبدیل شدن به یک تحلیلگر BI نیاز دارید - آمار، نظریه پایگاه داده، SQL، جدول - همه چیز گنجانده شده است</p>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>در آمار، SQL، جدول و حل مسئله متخصص شوید</li>\n	<li>رزومه خود را با مهارت های مورد تقاضا تقویت کنید</li>\n	<li>جمع آوری، سازماندهی، تجزیه و تحلیل و تجسم داده</li>\n</ul>\n', '<div class=\"course-overview-card\">\n<h3>شرح</h3>\n\n<p>لورم ایپسوم از دهه 1500، زمانی که یک چاپگر ناشناخته یک گالری از نوع را گرفت و آن را به هم زد تا یک کتاب نمونه تایپ بسازد، متن ساختگی استاندارد صنعت بوده است. این نه تنها پنج قرن زنده مانده است، بلکه لورم ایپسوم متن ساختگی استاندارد صنعت از دهه 1500 بوده است، زمانی که یک چاپگر ناشناخته یک گالی از نوع را برداشت و آن را به هم زد تا یک کتاب نمونه بسازد.</p>\n\n<p>&nbsp;</p>\n\n<p>این نه تنها پنج قرن زنده مانده است، بلکه جهشی به حروفچینی الکترونیکی نیز باقی مانده است و اساساً بدون تغییر باقی مانده است. لورم ایپسوم صرفاً متن ساختگی صنعت چاپ و حروفچینی است. لورم ایپسوم ساختگی استاندارد این صنعت بوده است</p>\n\n<p>&nbsp;</p>\n\n<h5><strong>آیا قصد دارید اولین شغل برنامه نویسی جاوا خود را به دست آورید</strong></h5>\n\n<p>این دوره آموزشی به گونه ای طراحی شده است که مهارت های جاوا را برای به دست آوردن شغل به عنوان توسعه دهنده جاوا به شما بدهد. در پایان دوره، جاوا را به خوبی درک خواهید کرد و می توانید برنامه های جاوای خود را بسازید و به عنوان یک توسعه دهنده نرم افزار سازنده باشید.</p>\n\n<div class=\"collapse show\" id=\"collapseMore\">\n<p>مواد اصلی جاوا که برای یادگیری توسعه جاوا نیاز دارید در هفت بخش اول (در مجموع حدود 14 ساعت) پوشش داده شده است. اصول جاوا در آن بخش ها پوشش داده شده است. بقیه دوره شامل مطالب متوسط، پیشرفته و اختیاری است که از نظر فنی نیازی به گذراندن آنها ندارید.</p>\n\n<h4>این دوره برای چه کسانی است:</h4>\n\n<p>&nbsp;</p>\n\n<ul>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n	<li>هر کسی که می خواهد یک برنامه نویس کامپیوتر شود</li>\n</ul>\n</div>\n</div>\n', 'professional', '/storage/FIgma-logo.png', 5, NULL, 1, 'coming_soon', NULL, '0', 'asda', 's', NULL, NULL, '100000.00', '2022-07-21 12:24:22', '2022-11-16 16:42:09', 10, 'offline', 1);

-- --------------------------------------------------------

--
-- Table structure for table `episodes`
--

CREATE TABLE `episodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `local_video` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allow_show_local_video` tinyint(4) NOT NULL DEFAULT 0,
  `api_bucket` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` time DEFAULT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `free` tinyint(4) NOT NULL DEFAULT 0,
  `file_storage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `video_storage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `show_api_video` tinyint(4) NOT NULL DEFAULT 1,
  `downloadable_local_video` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `can_homework` int(11) NOT NULL,
  `homework_storage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `episodes`
--

INSERT INTO `episodes` (`id`, `title`, `file`, `link`, `local_video`, `allow_show_local_video`, `api_bucket`, `time`, `view`, `course_id`, `free`, `file_storage`, `video_storage`, `show_api_video`, `downloadable_local_video`, `created_at`, `updated_at`, `description`, `can_homework`, `homework_storage`) VALUES
(1, 'مفدمه', '', NULL, '', 0, NULL, '00:00:00', 0, 1, 1, '1', '1', 1, 1, '2022-07-02 19:44:14', '2022-07-23 19:09:11', 'توضیحات ابتدایی', 0, '0'),
(2, 'مقدمه', '', NULL, '', 0, NULL, '00:00:00', 0, 2, 1, '1', '1', 1, 1, '2022-07-02 19:53:08', '2022-07-23 19:09:18', 'توضیحات ابتدایی', 0, '0'),
(3, 'مقدمه', '', NULL, '', 0, NULL, '00:00:00', 0, 3, 1, '1', '1', 1, 1, '2022-07-02 20:01:02', '2022-07-23 19:09:23', 'توضیحات ابتدایی', 0, '0'),
(4, 'مقدمه', '', NULL, '', 0, NULL, '00:00:00', 0, 4, 1, '1', '1', 1, 1, '2022-07-02 20:05:14', '2022-07-23 19:09:30', 'توضیحات ابتدایی', 0, '0'),
(5, 'مقدمه', '', NULL, '', 0, NULL, '00:00:00', 0, 5, 1, '1', '1', 1, 1, '2022-07-02 20:30:30', '2022-07-23 19:09:37', 'توضیحات ابتدایی', 0, '0'),
(6, 'مقدمه', '/files/20220711/jfEqMipAUt6Pp6M67TyVUmQ1JiQiueBfcDM96VnK.pptx', 'http://127.0.0.1:8000/admin/episodes', '/videos/a.mp4', 1, '<style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style><div class=\"h_iframe-aparat_embed_frame\"><span style=\"display: block;padding-top: 57%\"></span><iframe src=\"https://www.aparat.com/video/video/embed/videohash/3IFeA/vt/frame\" allowFullScreen=\"true\" webkitallowfullscreen=\"true\" mozallowfullscreen=\"true\"></iframe></div>', '00:03:00', 0, 6, 1, '1', '1', 1, 1, '2022-07-02 20:34:23', '2022-07-17 07:50:41', 'متن تستی متن تستی متن تستی متن تستیمتن تستی متن تستی', 1, '1'),
(12, 'درس اول', '/files/20220711/jfEqMipAUt6Pp6M67TyVUmQ1JiQiueBfcDM96VnK.pptx', NULL, '', 0, NULL, '00:20:00', 1, 6, 0, '1', '1', 1, 1, '2022-07-23 17:51:20', '2022-07-23 17:51:20', 'توضیحات درس اول', 1, '1'),
(13, 'درس دوم', '', 'https://www.google.com/', '/videos/a.mp4', 0, NULL, '00:20:00', 2, 6, 0, '1', '1', 1, 0, '2022-07-23 18:16:26', '2022-07-23 19:47:47', 'توضیحات درس دوم', 0, '1'),
(14, 'درس سوم', '', NULL, '/videos/a.mp4', 1, NULL, '00:10:00', 3, 6, 0, '1', '1', 1, 1, '2022-07-23 18:21:56', '2022-07-23 18:21:56', 'توضیحات درس سوم', 0, '1'),
(15, 'درس چهارم', '', NULL, '', 0, '<style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style><div class=\"h_iframe-aparat_embed_frame\"><span style=\"display: block;padding-top: 57%\"></span><iframe src=\"https://www.aparat.com/video/video/embed/videohash/vQkrX/vt/frame\" allowFullScreen=\"true\" webkitallowfullscreen=\"true\" mozallowfullscreen=\"true\"></iframe></div>', '00:00:00', 4, 6, 0, '1', '1', 1, 1, '2022-07-23 18:24:58', '2022-07-23 19:48:50', 'توضیحات درس چهارم', 0, '1'),
(16, 'درس اول', '/files/20220711/jfEqMipAUt6Pp6M67TyVUmQ1JiQiueBfcDM96VnK.pptx', NULL, '', 0, NULL, '00:20:00', 1, 4, 0, '1', '1', 1, 1, '2022-07-23 17:51:20', '2022-07-23 17:51:20', 'توضیحات درس اول', 1, '1'),
(17, 'درس دوم', '', 'https://www.google.com/', '/videos/a.mp4', 1, NULL, '00:20:00', 2, 4, 0, '1', '1', 1, 1, '2022-07-23 18:16:26', '2022-07-23 18:16:26', 'توضیحات درس دوم', 0, '1'),
(18, 'درس سوم', '', NULL, '/videos/a.mp4', 1, NULL, '00:10:00', 3, 4, 0, '1', '1', 1, 1, '2022-07-23 18:21:56', '2022-07-23 18:21:56', 'توضیحات درس سوم', 0, '1'),
(19, 'درس چهارم جدید', '', NULL, '', 0, '<style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style><div class=\"h_iframe-aparat_embed_frame\"><span style=\"display: block;padding-top: 57%\"></span><iframe src=\"https://www.aparat.com/video/video/embed/videohash/vQkrX/vt/frame\" allowFullScreen=\"true\" webkitallowfullscreen=\"true\" mozallowfullscreen=\"true\"></iframe></div>', '00:00:00', 4, 4, 0, '1', '1', 1, 1, '2022-07-23 18:24:58', '2022-08-22 08:14:34', 'توضیحات درس چهارم', 0, '1'),
(20, 'درس اول', '/files/20220711/jfEqMipAUt6Pp6M67TyVUmQ1JiQiueBfcDM96VnK.pptx', NULL, '', 0, NULL, '00:20:00', 1, 5, 0, '1', '1', 1, 1, '2022-07-23 17:51:20', '2022-07-23 17:51:20', 'توضیحات درس اول', 1, '1'),
(21, 'درس دوم', '', 'https://www.google.com/', '/videos/a.mp4', 1, NULL, '00:20:00', 2, 5, 0, '1', '1', 1, 1, '2022-07-23 18:16:26', '2022-07-23 18:16:26', 'توضیحات درس دوم', 0, '1'),
(22, 'درس سوم', '', NULL, '/videos/a.mp4', 1, NULL, '00:10:00', 3, 5, 0, '1', '1', 1, 1, '2022-07-23 18:21:56', '2022-07-23 18:21:56', 'توضیحات درس سوم', 0, '1'),
(23, 'درس چهارم', '', NULL, '', 0, '<style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style><div class=\"h_iframe-aparat_embed_frame\"><span style=\"display: block;padding-top: 57%\"></span><iframe src=\"https://www.aparat.com/video/video/embed/videohash/vQkrX/vt/frame\" allowFullScreen=\"true\" webkitallowfullscreen=\"true\" mozallowfullscreen=\"true\"></iframe></div>', '00:00:00', 4, 5, 0, '1', '1', 1, 1, '2022-07-23 18:24:58', '2022-07-23 18:24:58', 'توضیحات درس چهارم', 0, '1'),
(24, 'درس اول', '/files/20220711/jfEqMipAUt6Pp6M67TyVUmQ1JiQiueBfcDM96VnK.pptx', NULL, '', 0, NULL, '00:20:00', 1, 10, 0, '1', '1', 1, 1, '2022-07-23 17:51:20', '2022-07-23 17:51:20', 'توضیحات درس اول', 1, '1'),
(25, 'درس دوم', '', 'https://www.google.com/', '/videos/a.mp4', 1, NULL, '00:20:00', 2, 10, 0, '1', '1', 1, 1, '2022-07-23 18:16:26', '2022-07-23 18:16:26', 'توضیحات درس دوم', 0, '1'),
(26, 'درس سوم', '', NULL, '/videos/a.mp4', 1, NULL, '00:10:00', 3, 10, 0, '1', '1', 1, 1, '2022-07-23 18:21:56', '2022-07-23 18:21:56', 'توضیحات درس سوم', 0, '1'),
(27, 'درس چهارم', '', NULL, '', 0, '<style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style><div class=\"h_iframe-aparat_embed_frame\"><span style=\"display: block;padding-top: 57%\"></span><iframe src=\"https://www.aparat.com/video/video/embed/videohash/vQkrX/vt/frame\" allowFullScreen=\"true\" webkitallowfullscreen=\"true\" mozallowfullscreen=\"true\"></iframe></div>', '00:00:00', 4, 10, 0, '1', '1', 1, 1, '2022-07-23 18:24:58', '2022-07-23 18:24:58', 'توضیحات درس چهارم', 0, '1'),
(28, 'درس اول', '/files/20220711/jfEqMipAUt6Pp6M67TyVUmQ1JiQiueBfcDM96VnK.pptx', NULL, '', 0, NULL, '00:20:00', 1, 11, 0, '1', '1', 1, 1, '2022-07-23 17:51:20', '2022-07-23 17:51:20', 'توضیحات درس اول', 1, '1'),
(29, 'درس دوم', '', 'https://www.google.com/', '/videos/a.mp4', 1, NULL, '00:20:00', 2, 11, 0, '1', '1', 1, 1, '2022-07-23 18:16:26', '2022-07-23 18:16:26', 'توضیحات درس دوم', 0, '1'),
(30, 'درس سوم', '', NULL, '/videos/a.mp4', 1, NULL, '00:10:00', 3, 11, 0, '1', '1', 1, 1, '2022-07-23 18:21:56', '2022-07-23 18:21:56', 'توضیحات درس سوم', 0, '1'),
(32, 'درس چهارم', '', NULL, '', 0, '<style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style><div class=\"h_iframe-aparat_embed_frame\"><span style=\"display: block;padding-top: 57%\"></span><iframe src=\"https://www.aparat.com/video/video/embed/videohash/vQkrX/vt/frame\" allowFullScreen=\"true\" webkitallowfullscreen=\"true\" mozallowfullscreen=\"true\"></iframe></div>', '00:00:00', 4, 11, 0, '1', '1', 1, 1, '2022-07-23 18:24:58', '2022-07-23 18:24:58', 'توضیحات درس چهارم', 0, '1'),
(33, 'درس اول', '/files/20220711/jfEqMipAUt6Pp6M67TyVUmQ1JiQiueBfcDM96VnK.pptx', NULL, '', 0, NULL, '00:20:00', 1, 12, 0, '1', '1', 1, 1, '2022-07-23 17:51:20', '2022-07-23 17:51:20', 'توضیحات درس اول', 1, '1'),
(34, 'درس دوم', '', 'https://www.google.com/', '/videos/a.mp4', 1, NULL, '00:20:00', 2, 12, 0, '1', '1', 1, 1, '2022-07-23 18:16:26', '2022-07-23 18:16:26', 'توضیحات درس دوم', 0, '1'),
(35, 'درس سوم', '', NULL, '/videos/a.mp4', 1, NULL, '00:10:00', 3, 12, 0, '1', '1', 1, 1, '2022-07-23 18:21:56', '2022-07-23 18:21:56', 'توضیحات درس سوم', 0, '1'),
(36, 'درس چهارم', '', NULL, '', 0, '<style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style><div class=\"h_iframe-aparat_embed_frame\"><span style=\"display: block;padding-top: 57%\"></span><iframe src=\"https://www.aparat.com/video/video/embed/videohash/vQkrX/vt/frame\" allowFullScreen=\"true\" webkitallowfullscreen=\"true\" mozallowfullscreen=\"true\"></iframe></div>', '00:00:00', 4, 12, 0, '1', '1', 1, 1, '2022-07-23 18:24:58', '2022-07-23 18:24:58', 'توضیحات درس چهارم', 0, '1'),
(37, 'درس اول', '/files/20220711/jfEqMipAUt6Pp6M67TyVUmQ1JiQiueBfcDM96VnK.pptx', NULL, '', 0, NULL, '00:20:00', 1, 13, 0, '1', '1', 1, 1, '2022-07-23 17:51:20', '2022-07-23 17:51:20', 'توضیحات درس اول', 1, '1'),
(38, 'درس دوم', '', 'https://www.google.com/', '/videos/a.mp4', 1, NULL, '00:20:00', 2, 13, 0, '1', '1', 1, 1, '2022-07-23 18:16:26', '2022-07-23 18:16:26', 'توضیحات درس دوم', 0, '1'),
(39, 'درس سوم', '', NULL, '/videos/a.mp4', 1, NULL, '00:10:00', 3, 13, 0, '1', '1', 1, 1, '2022-07-23 18:21:56', '2022-07-23 18:21:56', 'توضیحات درس سوم', 0, '1'),
(40, 'درس چهارم', '', NULL, '', 0, '<style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style><div class=\"h_iframe-aparat_embed_frame\"><span style=\"display: block;padding-top: 57%\"></span><iframe src=\"https://www.aparat.com/video/video/embed/videohash/vQkrX/vt/frame\" allowFullScreen=\"true\" webkitallowfullscreen=\"true\" mozallowfullscreen=\"true\"></iframe></div>', '00:00:00', 4, 13, 0, '1', '1', 1, 1, '2022-07-23 18:24:58', '2022-07-23 18:24:58', 'توضیحات درس چهارم', 0, '1'),
(41, 'درس اول', '/files/20220711/jfEqMipAUt6Pp6M67TyVUmQ1JiQiueBfcDM96VnK.pptx', NULL, '', 0, NULL, '00:20:00', 1, 14, 0, '1', '1', 1, 1, '2022-07-23 17:51:20', '2022-07-23 17:51:20', 'توضیحات درس اول', 1, '1'),
(42, 'درس دوم', '', 'https://www.google.com/', '/videos/a.mp4', 1, NULL, '00:20:00', 2, 14, 0, '1', '1', 1, 1, '2022-07-23 18:16:26', '2022-07-23 18:16:26', 'توضیحات درس دوم', 0, '1'),
(43, 'درس سوم', '', NULL, '/videos/a.mp4', 1, NULL, '00:10:00', 3, 14, 0, '1', '1', 1, 1, '2022-07-23 18:21:56', '2022-07-23 18:21:56', 'توضیحات درس سوم', 0, '1'),
(44, 'درس چهارم', '', NULL, '', 0, '<style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style><div class=\"h_iframe-aparat_embed_frame\"><span style=\"display: block;padding-top: 57%\"></span><iframe src=\"https://www.aparat.com/video/video/embed/videohash/vQkrX/vt/frame\" allowFullScreen=\"true\" webkitallowfullscreen=\"true\" mozallowfullscreen=\"true\"></iframe></div>', '00:00:00', 4, 14, 0, '1', '1', 1, 1, '2022-07-23 18:24:58', '2022-07-23 18:24:58', 'توضیحات درس چهارم', 0, '1'),
(45, 'درس اول', '/files/20220711/jfEqMipAUt6Pp6M67TyVUmQ1JiQiueBfcDM96VnK.pptx', NULL, '', 0, NULL, '00:20:00', 1, 15, 0, '1', '1', 1, 1, '2022-07-23 17:51:20', '2022-07-23 17:51:20', 'توضیحات درس اول', 1, '1'),
(46, 'درس دوم', '', 'https://www.google.com/', '/videos/a.mp4', 1, NULL, '00:20:00', 2, 15, 0, '1', '1', 1, 1, '2022-07-23 18:16:26', '2022-07-23 18:16:26', 'توضیحات درس دوم', 0, '1'),
(47, 'درس سوم', '', NULL, '/videos/a.mp4', 1, NULL, '00:10:00', 3, 15, 0, '1', '1', 1, 1, '2022-07-23 18:21:56', '2022-07-23 18:21:56', 'توضیحات درس سوم', 0, '1'),
(48, 'درس چهارم', '', NULL, '', 0, '<style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style><div class=\"h_iframe-aparat_embed_frame\"><span style=\"display: block;padding-top: 57%\"></span><iframe src=\"https://www.aparat.com/video/video/embed/videohash/vQkrX/vt/frame\" allowFullScreen=\"true\" webkitallowfullscreen=\"true\" mozallowfullscreen=\"true\"></iframe></div>', '00:00:00', 4, 15, 0, '1', '1', 1, 1, '2022-07-23 18:24:58', '2022-07-23 18:24:58', 'توضیحات درس چهارم', 0, '1'),
(49, 'درس اول', '/files/20220711/jfEqMipAUt6Pp6M67TyVUmQ1JiQiueBfcDM96VnK.pptx', NULL, '', 0, NULL, '00:20:00', 1, 16, 0, '1', '1', 1, 1, '2022-07-23 17:51:20', '2022-07-23 17:51:20', 'توضیحات درس اول', 1, '1'),
(50, 'درس دوم', '', 'https://www.google.com/', '/videos/a.mp4', 1, NULL, '00:20:00', 2, 16, 0, '1', '1', 1, 1, '2022-07-23 18:16:26', '2022-07-23 18:16:26', 'توضیحات درس دوم', 0, '1'),
(51, 'درس سوم', '', NULL, '/videos/a.mp4', 1, NULL, '00:10:00', 3, 16, 0, '1', '1', 1, 1, '2022-07-23 18:21:56', '2022-07-23 18:21:56', 'توضیحات درس سوم', 0, '1'),
(52, 'درس چهارم', '', NULL, '', 0, '<style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style><div class=\"h_iframe-aparat_embed_frame\"><span style=\"display: block;padding-top: 57%\"></span><iframe src=\"https://www.aparat.com/video/video/embed/videohash/vQkrX/vt/frame\" allowFullScreen=\"true\" webkitallowfullscreen=\"true\" mozallowfullscreen=\"true\"></iframe></div>', '00:00:00', 4, 16, 0, '1', '1', 1, 1, '2022-07-23 18:24:58', '2022-07-23 18:24:58', 'توضیحات درس چهارم', 0, '1'),
(53, 'درس اول', '/files/20220711/jfEqMipAUt6Pp6M67TyVUmQ1JiQiueBfcDM96VnK.pptx', NULL, '', 0, NULL, '00:20:00', 1, 3, 0, '1', '1', 1, 1, '2022-07-23 17:51:20', '2022-07-23 17:51:20', 'توضیحات درس اول', 1, '1'),
(54, 'درس دوم', '', 'https://www.google.com/', '/videos/a.mp4', 1, NULL, '00:20:00', 2, 3, 0, '1', '1', 1, 1, '2022-07-23 18:16:26', '2022-07-23 18:16:26', 'توضیحات درس دوم', 0, '1'),
(55, 'درس سوم', '', NULL, '/videos/a.mp4', 1, NULL, '00:10:00', 3, 3, 0, '1', '1', 1, 1, '2022-07-23 18:21:56', '2022-07-23 18:21:56', 'توضیحات درس سوم', 0, '1'),
(56, 'درس چهارم', '', NULL, '', 0, '<style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style><div class=\"h_iframe-aparat_embed_frame\"><span style=\"display: block;padding-top: 57%\"></span><iframe src=\"https://www.aparat.com/video/video/embed/videohash/vQkrX/vt/frame\" allowFullScreen=\"true\" webkitallowfullscreen=\"true\" mozallowfullscreen=\"true\"></iframe></div>', '00:00:00', 4, 3, 0, '1', '1', 1, 1, '2022-07-23 18:24:58', '2022-07-23 18:24:58', 'توضیحات درس چهارم', 0, '1'),
(57, 'درس اول', '/files/20220711/jfEqMipAUt6Pp6M67TyVUmQ1JiQiueBfcDM96VnK.pptx', NULL, '', 0, NULL, '00:20:00', 1, 2, 0, '1', '1', 1, 1, '2022-07-23 17:51:20', '2022-07-23 17:51:20', 'توضیحات درس اول', 1, '1'),
(58, 'درس دوم', '', 'https://www.google.com/', '/videos/a.mp4', 1, NULL, '00:20:00', 2, 2, 0, '1', '1', 1, 1, '2022-07-23 18:16:26', '2022-07-23 18:16:26', 'توضیحات درس دوم', 0, '1'),
(59, 'درس سوم', '', NULL, '/videos/a.mp4', 1, NULL, '00:10:00', 3, 2, 0, '1', '1', 1, 1, '2022-07-23 18:21:56', '2022-07-23 18:21:56', 'توضیحات درس سوم', 0, '1'),
(60, 'درس چهارم', '', NULL, '', 0, '<style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style><div class=\"h_iframe-aparat_embed_frame\"><span style=\"display: block;padding-top: 57%\"></span><iframe src=\"https://www.aparat.com/video/video/embed/videohash/vQkrX/vt/frame\" allowFullScreen=\"true\" webkitallowfullscreen=\"true\" mozallowfullscreen=\"true\"></iframe></div>', '00:00:00', 4, 2, 0, '1', '1', 1, 1, '2022-07-23 18:24:58', '2022-07-23 18:24:58', 'توضیحات درس چهارم', 0, '1'),
(61, 'درس اول', '/files/20220711/jfEqMipAUt6Pp6M67TyVUmQ1JiQiueBfcDM96VnK.pptx', NULL, '', 0, NULL, '00:20:00', 1, 1, 0, '1', '1', 1, 1, '2022-07-23 17:51:20', '2022-07-23 17:51:20', 'توضیحات درس اول', 1, '1'),
(62, 'درس دوم', '', 'https://www.google.com/', '/videos/a.mp4', 1, NULL, '00:20:00', 2, 1, 0, '1', '1', 1, 1, '2022-07-23 18:16:26', '2022-07-23 18:16:26', 'توضیحات درس دوم', 0, '1'),
(63, 'درس سوم', '', NULL, '/videos/a.mp4', 1, NULL, '00:10:00', 3, 1, 0, '1', '1', 1, 1, '2022-07-23 18:21:56', '2022-07-23 18:21:56', 'توضیحات درس سوم', 0, '1'),
(64, 'درس چهارم test', '', NULL, '', 0, '<style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style><div class=\"h_iframe-aparat_embed_frame\"><span style=\"display: block;padding-top: 57%\"></span><iframe src=\"https://www.aparat.com/video/video/embed/videohash/vQkrX/vt/frame\" allowFullScreen=\"true\" webkitallowfullscreen=\"true\" mozallowfullscreen=\"true\"></iframe></div>', '00:00:00', 4, 1, 0, '1', '1', 1, 1, '2022-07-23 18:24:58', '2022-11-16 16:34:21', 'توضیحات درس چهارم', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `episode_transcripts`
--

CREATE TABLE `episode_transcripts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `local_video` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allow_show_local_video` tinyint(4) NOT NULL DEFAULT 0,
  `api_bucket` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` time DEFAULT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `episode_id` bigint(20) UNSIGNED DEFAULT NULL,
  `free` tinyint(4) NOT NULL DEFAULT 0,
  `file_storage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `video_storage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `show_api_video` tinyint(4) NOT NULL DEFAULT 1,
  `downloadable_local_video` tinyint(4) NOT NULL DEFAULT 1,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `can_homework` int(11) NOT NULL,
  `homework_storage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_confirmed` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `episode_transcripts`
--

INSERT INTO `episode_transcripts` (`id`, `status`, `message`, `title`, `file`, `link`, `local_video`, `allow_show_local_video`, `api_bucket`, `time`, `view`, `course_id`, `episode_id`, `free`, `file_storage`, `video_storage`, `show_api_video`, `downloadable_local_video`, `description`, `can_homework`, `homework_storage`, `is_confirmed`, `created_at`, `updated_at`) VALUES
(1, 'confirmed_status', '<p>testststset</p>\n', 'درس چهارم test', '', NULL, '', 0, '<style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style><div class=\"h_iframe-aparat_embed_frame\"><span style=\"display: block;padding-top: 57%\"></span><iframe src=\"https://www.aparat.com/video/video/embed/videohash/vQkrX/vt/frame\" allowFullScreen=\"true\" webkitallowfullscreen=\"true\" mozallowfullscreen=\"true\"></iframe></div>', '00:00:00', 4, 1, 64, 0, '1', '1', 1, 1, 'توضیحات درس چهارم', 0, '', 1, '2022-11-16 16:31:34', '2022-11-16 16:34:21');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `result` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `errors` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `users_count` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `body`, `result`, `errors`, `event`, `status`, `user_id`, `created_at`, `updated_at`, `users_count`, `order_by`) VALUES
(34, 'ارسال ایمیل تستی', 'ارسال ایمیل تستی', NULL, NULL, 'email', 'pending', 1, '2022-08-21 18:08:13', '2022-08-21 18:08:13', '10 درصد اول', 'asc'),
(35, 'ارسال ایمیل تستی', 'ارسال ایمیل تستی', 'خطایی در هنگام انجام عملیات رخ داده است لطفا شارژ پنل پیامکی یا ایمیل خود را بررسی نمایید سپس مجدد امتحان کنید.', 'Symfony\\Component\\Mailer\\Exception\\TransportException: Connection could not be established with host \"ssl://rezadezhhoot.ir:465\": stream_socket_client(): Unable to connect to ssl://rezadezhhoot.ir:465 (Connection refused) in /home/rezaproj/fast_lean2/vendor/symfony/mailer/Transport/Smtp/Stream/SocketStream.php:154\nStack trace:\n#0 [internal function]: Symfony\\Component\\Mailer\\Transport\\Smtp\\Stream\\SocketStream->Symfony\\Component\\Mailer\\Transport\\Smtp\\Stream\\{closure}(2, \'stream_socket_c...\', \'/home/rezaproj/...\', 157)\n#1 /home/rezaproj/fast_lean2/vendor/symfony/mailer/Transport/Smtp/Stream/SocketStream.php(157): stream_socket_client(\'ssl://rezadezhh...\', 0, \'\', 60.0, 4, Resource id #4828)\n#2 /home/rezaproj/fast_lean2/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(253): Symfony\\Component\\Mailer\\Transport\\Smtp\\Stream\\SocketStream->initialize()\n#3 /home/rezaproj/fast_lean2/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(192): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->start()\n#4 /home/rezaproj/fast_lean2/vendor/symfony/mailer/Transport/AbstractTransport.php(68): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->doSend(Object(Symfony\\Component\\Mailer\\SentMessage))\n#5 /home/rezaproj/fast_lean2/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(136): Symfony\\Component\\Mailer\\Transport\\AbstractTransport->send(Object(Symfony\\Component\\Mailer\\SentMessage), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#6 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Symfony\\Component\\Mailer\\Transport\\Smtp\\SmtpTransport->send(Object(Symfony\\Component\\Mime\\Email), Object(Symfony\\Component\\Mailer\\DelayedEnvelope))\n#7 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(285): Illuminate\\Mail\\Mailer->sendSymfonyMessage(Object(Symfony\\Component\\Mime\\Email))\n#8 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(211): Illuminate\\Mail\\Mailer->send(\'emails.event\', Array, Object(Closure))\n#9 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\\Mail\\Mailable->Illuminate\\Mail\\{closure}()\n#10 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(212): Illuminate\\Mail\\Mailable->withLocale(NULL, Object(Closure))\n#11 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(307): Illuminate\\Mail\\Mailable->send(Object(Illuminate\\Mail\\Mailer))\n#12 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(253): Illuminate\\Mail\\Mailer->sendMailable(Object(App\\Mail\\EventMail))\n#13 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Mail/PendingMail.php(124): Illuminate\\Mail\\Mailer->send(Object(App\\Mail\\EventMail))\n#14 /home/rezaproj/fast_lean2/app/Jobs/ProcessEvent.php(56): Illuminate\\Mail\\PendingMail->send(Object(App\\Mail\\EventMail))\n#15 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Jobs\\ProcessEvent->handle()\n#16 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#17 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#18 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#19 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#20 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\\Container\\Container->call(Array)\n#21 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\ProcessEvent))\n#22 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\ProcessEvent))\n#23 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#24 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(123): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\ProcessEvent), false)\n#25 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\ProcessEvent))\n#26 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\ProcessEvent))\n#27 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(125): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#28 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(69): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\ProcessEvent))\n#29 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#30 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(428): Illuminate\\Queue\\Jobs\\Job->fire()\n#31 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(378): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#32 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(172): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#33 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(130): Illuminate\\Queue\\Worker->daemon(\'database\', \'35\', Object(Illuminate\\Queue\\WorkerOptions))\n#34 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(114): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'35\')\n#35 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#36 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#37 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#38 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#39 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Container/Container.php(651): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#40 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Console/Command.php(136): Illuminate\\Container\\Container->call(Array)\n#41 /home/rezaproj/fast_lean2/vendor/symfony/console/Command/Command.php(308): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\StringInput), Object(Illuminate\\Console\\OutputStyle))\n#42 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Console/Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\StringInput), Object(Illuminate\\Console\\OutputStyle))\n#43 /home/rezaproj/fast_lean2/vendor/symfony/console/Application.php(998): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\StringInput), Object(Symfony\\Component\\Console\\Output\\BufferedOutput))\n#44 /home/rezaproj/fast_lean2/vendor/symfony/console/Application.php(299): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\StringInput), Object(Symfony\\Component\\Console\\Output\\BufferedOutput))\n#45 /home/rezaproj/fast_lean2/vendor/symfony/console/Application.php(171): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\StringInput), Object(Symfony\\Component\\Console\\Output\\BufferedOutput))\n#46 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\StringInput), Object(Symfony\\Component\\Console\\Output\\BufferedOutput))\n#47 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Console/Application.php(194): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\StringInput), Object(Symfony\\Component\\Console\\Output\\BufferedOutput))\n#48 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(263): Illuminate\\Console\\Application->call(\'queue:work\', Array, NULL)\n#49 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php(337): Illuminate\\Foundation\\Console\\Kernel->call(\'queue:work --qu...\')\n#50 /home/rezaproj/fast_lean2/app/Http/Controllers/Admin/Events/IndexEvent.php(96): Illuminate\\Support\\Facades\\Facade::__callStatic(\'call\', Array)\n#51 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): App\\Http\\Controllers\\Admin\\Events\\IndexEvent->workSingle(35)\n#52 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#53 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#54 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#55 /home/rezaproj/fast_lean2/vendor/livewire/livewire/src/ComponentConcerns/HandlesActions.php(149): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array)\n#56 /home/rezaproj/fast_lean2/vendor/livewire/livewire/src/HydrationMiddleware/PerformActionCalls.php(38): Livewire\\Component->callMethod(\'workSingle\', Array, Object(Closure))\n#57 /home/rezaproj/fast_lean2/vendor/livewire/livewire/src/LifecycleManager.php(89): Livewire\\HydrationMiddleware\\PerformActionCalls::hydrate(Object(App\\Http\\Controllers\\Admin\\Events\\IndexEvent), Object(Livewire\\Request))\n#58 /home/rezaproj/fast_lean2/vendor/livewire/livewire/src/Connection/ConnectionHandler.php(13): Livewire\\LifecycleManager->hydrate()\n#59 /home/rezaproj/fast_lean2/vendor/livewire/livewire/src/Controllers/HttpConnectionHandler.php(20): Livewire\\Connection\\ConnectionHandler->handle(Array)\n#60 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Routing/ControllerDispatcher.php(48): Livewire\\Controllers\\HttpConnectionHandler->__invoke(\'admin.events.in...\')\n#61 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Routing/Route.php(268): Illuminate\\Routing\\ControllerDispatcher->dispatch(Object(Illuminate\\Routing\\Route), Object(Livewire\\Controllers\\HttpConnectionHandler), \'__invoke\')\n#62 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Routing/Route.php(211): Illuminate\\Routing\\Route->runController()\n#63 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Routing/Router.php(725): Illuminate\\Routing\\Route->run()\n#64 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Routing\\Router->Illuminate\\Routing\\{closure}(Object(Illuminate\\Http\\Request))\n#65 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Routing/Middleware/SubstituteBindings.php(50): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#66 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Routing\\Middleware\\SubstituteBindings->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#67 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/View/Middleware/ShareErrorsFromSession.php(49): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#68 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\View\\Middleware\\ShareErrorsFromSession->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#69 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php(121): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#70 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php(64): Illuminate\\Session\\Middleware\\StartSession->handleStatefulRequest(Object(Illuminate\\Http\\Request), Object(Illuminate\\Session\\Store), Object(Closure))\n#71 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Session\\Middleware\\StartSession->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#72 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/AddQueuedCookiesToResponse.php(37): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#73 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#74 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php(67): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#75 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Cookie\\Middleware\\EncryptCookies->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#76 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#77 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Routing/Router.php(726): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#78 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Routing/Router.php(703): Illuminate\\Routing\\Router->runRouteWithinStack(Object(Illuminate\\Routing\\Route), Object(Illuminate\\Http\\Request))\n#79 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Routing/Router.php(667): Illuminate\\Routing\\Router->runRoute(Object(Illuminate\\Http\\Request), Object(Illuminate\\Routing\\Route))\n#80 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Routing/Router.php(656): Illuminate\\Routing\\Router->dispatchToRoute(Object(Illuminate\\Http\\Request))\n#81 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php(167): Illuminate\\Routing\\Router->dispatch(Object(Illuminate\\Http\\Request))\n#82 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\\Foundation\\Http\\Kernel->Illuminate\\Foundation\\Http\\{closure}(Object(Illuminate\\Http\\Request))\n#83 /home/rezaproj/fast_lean2/vendor/livewire/livewire/src/DisableBrowserCache.php(19): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#84 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Livewire\\DisableBrowserCache->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#85 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/ConvertEmptyStringsToNull.php(27): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#86 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#87 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/TrimStrings.php(36): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#88 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#89 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#90 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#91 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/PreventRequestsDuringMaintenance.php(86): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#92 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#93 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Http/Middleware/HandleCors.php(49): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#94 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Http\\Middleware\\HandleCors->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#95 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Http/Middleware/TrustProxies.php(39): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#96 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(180): Illuminate\\Http\\Middleware\\TrustProxies->handle(Object(Illuminate\\Http\\Request), Object(Closure))\n#97 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(Illuminate\\Http\\Request))\n#98 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php(142): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#99 /home/rezaproj/fast_lean2/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php(111): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter(Object(Illuminate\\Http\\Request))\n#100 /home/rezaproj/public_html/index.php(52): Illuminate\\Foundation\\Http\\Kernel->handle(Object(Illuminate\\Http\\Request))\n#101 {main}', 'email', 'failed', 1, '2022-08-21 18:09:19', '2022-08-23 09:55:09', '10 درصد دوم', 'asc');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `homeworks`
--

CREATE TABLE `homeworks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `episode_id` bigint(20) UNSIGNED NOT NULL,
  `episode_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `result` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score` int(11) NOT NULL DEFAULT 2,
  `storage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homeworks`
--

INSERT INTO `homeworks` (`id`, `user_id`, `episode_id`, `episode_title`, `file`, `description`, `result`, `score`, `storage`, `created_at`, `updated_at`) VALUES
(3, 1, 6, 'مقدمه', 'homeworks/3YZqoHbZlIvjMnl1TfKWTFaIPidLa5iZTQ66URJI.jpg', 'توضیحات از طرف کاربر می باشد', '<p>شیشسیسش</p>', 4, '1', '2022-07-13 15:26:20', '2022-07-13 16:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `incoming_methods`
--

CREATE TABLE `incoming_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expire_limit` int(11) DEFAULT NULL,
  `count_limit` int(11) DEFAULT NULL,
  `formula` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incoming_methods`
--

INSERT INTO `incoming_methods` (`id`, `title`, `type`, `value`, `expire_limit`, `count_limit`, `formula`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'test', 'percent_type', '10', NULL, 15, NULL, NULL, '2022-11-16 16:41:26', '2022-11-16 16:41:26');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `last_activities`
--

CREATE TABLE `last_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `last_activities`
--

INSERT INTO `last_activities` (`id`, `user_id`, `subject`, `url`, `icon`, `created_at`, `updated_at`) VALUES
(1, 1, 'تعریف دوره جدید  tes2', 'http://127.0.0.1:8000/teacher/courses', 'fab fa-product-hunt', '2022-11-16 16:27:56', '2022-11-16 16:27:56'),
(2, 1, 'بروزرسانی درس  درس چهارم test', 'http://127.0.0.1:8000/teacher/episodes/edit/64', 'flaticon2-open-text-book', '2022-11-16 16:31:34', '2022-11-16 16:31:34'),
(3, 1, 'تعریف نمونه سوال  test', 'http://127.0.0.1:8000/teacher/samples/edit/1', 'fa fa-question', '2022-11-16 16:36:27', '2022-11-16 16:36:27'),
(4, 1, 'تعریف حساب بانکی جدید  test', 'http://127.0.0.1:8000/teacher/bank-accounts', 'fa fa-piggy-bank', '2022-11-16 16:44:46', '2022-11-16 16:44:46'),
(5, 1, 'درخواست تسویه حساب  به شماره کارت 6219861036883428', 'http://127.0.0.1:8000/teacher/checkouts', 'fab fa-cc-amazon-pay', '2022-11-16 16:46:58', '2022-11-16 16:46:58');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_08_08_100000_create_telescope_entries_table', 1),
(4, '2018_11_06_222923_create_transactions_table', 1),
(5, '2018_11_07_192923_create_transfers_table', 1),
(6, '2018_11_15_124230_create_wallets_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2021_11_02_202021_update_wallets_uuid_table', 1),
(10, '2022_04_04_053953_create_categories_table', 1),
(11, '2022_04_04_054036_create_articles_table', 1),
(12, '2022_04_04_054222_create_courses_table', 1),
(13, '2022_04_04_054414_create_episodes_table', 1),
(14, '2022_04_04_054458_create_reductions_table', 1),
(15, '2022_04_04_054521_create_reduction_metas_table', 1),
(16, '2022_04_04_054536_create_orders_table', 1),
(17, '2022_04_04_054548_create_order_details_table', 1),
(18, '2022_04_04_054602_create_order_notes_table', 1),
(19, '2022_04_04_054621_create_quizzes_table', 1),
(20, '2022_04_04_054629_create_questions_table', 1),
(21, '2022_04_04_054703_create_choices_table', 1),
(22, '2022_04_04_054737_create_quizzes_has_questions_table', 1),
(23, '2022_04_04_055106_create_certificates_table', 1),
(24, '2022_04_04_055216_create_transcripts_table', 1),
(25, '2022_04_04_055250_create_settings_table', 1),
(26, '2022_04_04_055303_create_comments_table', 1),
(27, '2022_04_04_055343_create_payments_table', 1),
(28, '2022_04_04_055430_create_tags_table', 1),
(29, '2022_04_04_055657_create_taggables_table', 1),
(30, '2022_04_04_055734_create_classes_table', 1),
(31, '2022_04_04_055817_create_class_accesses_table', 1),
(32, '2022_04_04_055837_create_tickets_table', 1),
(33, '2022_04_04_060019_create_teachers_table', 1),
(34, '2022_04_04_103432_create_notifications_table', 1),
(35, '2022_04_04_110234_create_users_certificates_table', 1),
(36, '2022_04_04_114238_create_permission_tables', 1),
(37, '2022_04_07_052322_create_user_details_table', 1),
(38, '2022_04_07_061534_add_user_id_to_articles_table', 1),
(39, '2022_04_07_063054_add_softdeletes_to_certificates_table', 1),
(40, '2022_04_15_202827_create_user_answers_table', 1),
(41, '2022_05_27_015143_create_events_table', 1),
(42, '2022_05_27_120050_create_jobs_table', 1),
(43, '2022_07_08_210141_add_certificate_code_and_certificate_date_to_transcripts', 2),
(44, '2022_07_10_151302_add_views_to_courses_table', 3),
(45, '2022_07_10_171727_add_softdeletes_to_teachers_table', 4),
(54, '2022_07_11_203205_drop_file_upload_method_and_video_upload_method_from_episodes_table', 5),
(55, '2022_07_12_160055_add_can_homework_and_description_to_episodes_table', 5),
(58, '2022_07_12_160150_create_homeworks_table', 6),
(59, '2022_07_12_162211_add_homework_storage_to_episodes_table', 6),
(65, '2016_06_01_000001_create_oauth_auth_codes_table', 7),
(66, '2016_06_01_000002_create_oauth_access_tokens_table', 7),
(67, '2016_06_01_000003_create_oauth_refresh_tokens_table', 7),
(68, '2016_06_01_000004_create_oauth_clients_table', 7),
(69, '2016_06_01_000005_create_oauth_personal_access_clients_table', 7),
(73, '2022_07_20_180309_create_contact_us_table', 8),
(74, '2022_07_21_011921_create_activity_log_table', 9),
(75, '2022_07_21_011922_add_event_column_to_activity_log_table', 9),
(76, '2022_07_21_011923_add_batch_uuid_column_to_activity_log_table', 9),
(77, '2022_07_23_234231_add_show_api_video_and_downloadable_local_video_to_episodes_table', 10),
(78, '2022_07_24_182812_add_ip_to_payments_table', 11),
(79, '2022_07_26_210222_add_type_to_courses_table', 12),
(80, '2022_07_27_154214_add_users_count_to_events_table', 13),
(81, '2022_07_27_162225_add_order_by_to_events_table', 13),
(82, '2022_09_18_140510_create_samples_table', 14),
(83, '2022_09_24_114544_create_storages_table', 14),
(84, '2022_09_25_105628_change_file_storage_and_video_storage_and_homework_storage_to_string_from_episodes_table', 14),
(85, '2022_09_25_105939_change_storage_to_string_from_homeworks_table', 14),
(86, '2022_10_05_025520_create_bank_accounts_table', 15),
(87, '2022_10_06_023759_create_teacher_requests_table', 15),
(88, '2022_10_06_023912_create_new_course_requests_table', 15),
(89, '2022_10_06_024138_create_incoming_methods_table', 15),
(90, '2022_10_06_024329_create_teacher_checkouts_table', 15),
(91, '2022_10_06_024551_add_incoming_method_id_to_courses_table', 15),
(92, '2022_10_15_001740_create_storage_permissions_table', 15),
(93, '2022_10_16_172415_last_activities', 15),
(94, '2022_10_23_155929_create_new_course_chats', 15),
(95, '2022_10_28_043227_change_can_homework_to_tinyinteger_and_homework_storage_to_string_from_episodes_table', 15),
(96, '2022_10_28_124410_create_episode_transcripts_table', 15),
(97, '2022_10_31_124835_add_incoming_method_id_to_order_details_table', 15),
(98, '2022_11_03_051728_drop_bank_account_id_from_teacher_checkouts_table', 15),
(99, '2022_11_10_004921_make_seo_keywords_and_seo_description_nullable_from_samples_table', 15),
(100, '2022_11_13_030443_add_teacher_amount_to_order_details_table', 15),
(101, '2022_11_13_154724_add_panel_status_to_teachers_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 1),
(6, 'App\\Models\\User', 4),
(7, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `new_course_chats`
--

CREATE TABLE `new_course_chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `new_course_request_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `files` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `new_course_chats`
--

INSERT INTO `new_course_chats` (`id`, `new_course_request_id`, `user_id`, `message`, `files`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'testestsets', '[]', '2022-11-16 16:29:02', '2022-11-16 16:29:02'),
(2, 1, 1, 'dsssssssssssssssss', '[]', '2022-11-16 16:29:16', '2022-11-16 16:29:16'),
(3, 1, 1, 'asdfasfasfas', '[\"new_courses\\/tes2\\/0WdTHhjMWWamyZVVdoiBJWavAzsqOX8Dpj3CDOq2.png\",\"new_courses\\/tes2\\/ba8N4rLQ1ZTMhnO6Tjb3DGeMIw2JTNoiRudkym0S.jpg\"]', '2022-11-16 16:29:31', '2022-11-16 16:29:31');

-- --------------------------------------------------------

--
-- Table structure for table `new_course_requests`
--

CREATE TABLE `new_course_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriptions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `files` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `result` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `new_course_requests`
--

INSERT INTO `new_course_requests` (`id`, `user_id`, `title`, `descriptions`, `level`, `files`, `status`, `result`, `created_at`, `updated_at`) VALUES
(1, 1, 'tes2', '<p>testst</p>', 'medium', '', 'new_course_teacher_answered', NULL, '2022-11-16 16:27:56', '2022-11-16 16:29:16');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `subject`, `content`, `type`, `user_id`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 'Auth', 'ورود به ناحیه کاربری admin ', 'private', 1, 0, '2022-07-06 05:40:06', '2022-07-06 05:40:06'),
(2, 'Order', 'سلام admin دوره های شما : برنامه نویسی اندروید | android programming  به مبلغ 0.00  تومان اوکی شد', 'private', 1, 0, '2022-07-06 06:04:42', '2022-07-06 06:04:42'),
(3, 'Order', 'سلام admin دوره های شما : برنامه نویسی اندروید | android programming  به مبلغ 0.00  تومان اوکی شد', 'private', 1, 0, '2022-07-06 06:05:07', '2022-07-06 06:05:07'),
(4, 'Ticket', '1', 'private', 1, 0, '2022-07-06 06:52:59', '2022-07-06 06:52:59'),
(5, 'Ticket', '1', 'private', 1, 0, '2022-07-06 06:55:03', '2022-07-06 06:55:03'),
(6, 'Ticket', '{exam_name}  {exam_name} زیاد admin', 'private', 1, 0, '2022-07-06 07:00:00', '2022-07-06 07:00:00'),
(7, 'Ticket', '{exam_name}  {exam_name} زیاد admin', 'private', 1, 0, '2022-07-06 07:01:38', '2022-07-06 07:01:38'),
(8, 'Ticket', '{exam_name}  {exam_name} زیاد admin', 'private', 1, 0, '2022-07-06 07:01:58', '2022-07-06 07:01:58'),
(9, 'Ticket', '{exam_name}  {exam_name} زیاد admin', 'private', 1, 0, '2022-07-06 07:03:33', '2022-07-06 07:03:33'),
(11, 'Auth', 'ورود به ناحیه کاربری admin ', 'private', 1, 0, '2022-07-06 14:45:01', '2022-07-06 14:45:01'),
(12, 'Auth', 'ورود به ناحیه کاربری admin ', 'private', 1, 0, '2022-07-06 14:45:07', '2022-07-06 14:45:07'),
(13, 'Ticket', 'متوسط admin', 'private', 1, 0, '2022-07-06 15:09:33', '2022-07-06 15:09:33'),
(14, 'Auth', 'ورود به ناحیه کاربری admin ', 'private', 1, 0, '2022-07-07 16:34:33', '2022-07-07 16:34:33'),
(15, 'Auth', 'ورود به ناحیه کاربری admin ', 'private', 1, 0, '2022-07-07 16:37:52', '2022-07-07 16:37:52'),
(16, 'Auth', 'ورود به ناحیه کاربری admin ', 'private', 1, 0, '2022-07-08 06:27:40', '2022-07-08 06:27:40'),
(17, 'Auth', 'ورود به ناحیه کاربری admin ', 'private', 1, 0, '2022-07-08 06:31:44', '2022-07-08 06:31:44'),
(18, 'Auth', 'ورود به ناحیه کاربری admin ', 'private', 1, 0, '2022-07-08 09:14:00', '2022-07-08 09:14:00'),
(19, 'Auth', 'ورود به ناحیه کاربری رضا دژهوت ', 'private', 1, 0, '2022-07-08 10:09:47', '2022-07-08 10:09:47'),
(20, 'Auth', 'ورود به ناحیه کاربری admin ', 'private', 1, 0, '2022-07-09 07:38:24', '2022-07-09 07:38:24'),
(21, 'Auth', 'ورود به ناحیه کاربری admin ', 'private', 1, 0, '2022-07-09 08:59:28', '2022-07-09 08:59:28'),
(22, 'Auth', 'ورود به ناحیه کاربری admin ', 'private', 1, 0, '2022-07-09 16:04:25', '2022-07-09 16:04:25'),
(23, 'Quiz', '1', 'private', 1, 0, '2022-07-10 11:37:34', '2022-07-10 11:37:34'),
(24, 'Ticket', '1', 'private', 1, 0, '2022-07-13 17:31:27', '2022-07-13 17:31:27'),
(25, 'User', '<p>کاربر گرامی حساب کاربری شما تایید.</p>\n', 'private', 1, 0, '2022-07-13 17:34:04', '2022-07-13 17:34:04'),
(26, 'Ticket', 'زیاد admin', 'private', 1, 0, '2022-07-13 17:42:35', '2022-07-13 17:42:35'),
(27, 'Ticket', '1', 'private', 1, 0, '2022-07-13 21:20:13', '2022-07-13 21:20:13'),
(28, 'Ticket', '1', 'private', 1, 0, '2022-07-13 21:20:33', '2022-07-13 21:20:33'),
(30, 'Order', 'سلام admin دوره های شما : asdasdasd  به مبلغ 0.00  تومان اوکی شد', 'private', 1, 0, '2022-07-13 21:33:26', '2022-07-13 21:33:26'),
(31, 'Order', 'سلام admin دوره های شما : asdasd  به مبلغ 0.00  تومان اوکی شد', 'private', 1, 0, '2022-07-13 22:04:23', '2022-07-13 22:04:23'),
(32, 'Order', 'سلام admin دوره های شما : اموزش جامع nodeJS  به مبلغ 780000.00  تومان اوکی شد', 'private', 1, 0, '2022-07-13 22:51:01', '2022-07-13 22:51:01'),
(33, 'Order', 'سلام admin دوره های شما : اموزش جامع nodeJS,اموزش برنامه نویسی ویندوز | c# programming,اموزش جامع لاراول  به مبلغ 1134000.00  تومان اوکی شد', 'private', 1, 0, '2022-07-13 22:53:04', '2022-07-13 22:53:04'),
(34, 'Order', 'سلام admin دوره های شما : اموزش زبان سالیدیتی  ,اموزش جامع nodeJS,اموزش جامع لاراول,اموزش برنامه نویسی ویندوز | c# programming  به مبلغ 1134000.00  تومان اوکی شد', 'private', 1, 0, '2022-07-13 23:11:16', '2022-07-13 23:11:16'),
(38, 'Auth', 'ورود به ناحیه کاربری admin ', 'private', 1, 0, '2022-07-14 11:12:25', '2022-07-14 11:12:25'),
(39, 'Auth', 'ورود به ناحیه کاربری admin ', 'private', 1, 0, '2022-07-14 12:31:23', '2022-07-14 12:31:23'),
(40, 'Auth', 'ورود به ناحیه کاربری admin ', 'private', 1, 0, '2022-07-15 08:14:48', '2022-07-15 08:14:48'),
(41, 'Quiz', '1', 'private', 1, 0, '2022-07-15 16:45:39', '2022-07-15 16:45:39'),
(42, 'Auth', 'ورود به ناحیه کاربری admin ', 'private', 1, 0, '2022-07-17 15:18:58', '2022-07-17 15:18:58'),
(43, 'Auth', 'ورود به ناحیه کاربری admin ', 'private', 1, 0, '2022-07-20 12:08:24', '2022-07-20 12:08:24'),
(44, 'Auth', 'ورود به ناحیه کاربری رضا دژهوت ', 'private', 1, 0, '2022-07-21 14:12:12', '2022-07-21 14:12:12'),
(45, 'Auth', 'ورود به ناحیه کاربری رضا دژهوت ', 'private', 1, 0, '2022-07-21 14:14:13', '2022-07-21 14:14:13'),
(46, 'Auth', 'ورود به ناحیه کاربری رضا دژهوت ', 'private', 1, 0, '2022-07-21 14:14:53', '2022-07-21 14:14:53'),
(47, 'Auth', 'ورود به ناحیه کاربری رضا دژهوت ', 'private', 1, 0, '2022-07-21 14:29:26', '2022-07-21 14:29:26'),
(48, 'Auth', 'ورود به ناحیه کاربری رضا دژهوت ', 'private', 1, 0, '2022-07-21 15:30:50', '2022-07-21 15:30:50'),
(49, 'Auth', 'ورود به ناحیه کاربری رضا دژهوت ', 'private', 1, 0, '2022-07-21 15:30:59', '2022-07-21 15:30:59'),
(50, 'Auth', 'ورود به ناحیه کاربری رضا دژهوت ', 'private', 1, 0, '2022-07-22 00:14:04', '2022-07-22 00:14:04'),
(51, 'Auth', 'ورود به ناحیه کاربری رضا دژهوت ', 'private', 1, 0, '2022-07-27 03:47:17', '2022-07-27 03:47:17'),
(52, 'Auth', 'ورود به ناحیه کاربری رضا دژهوت ', 'private', 1, 0, '2022-07-27 03:48:00', '2022-07-27 03:48:00'),
(53, 'Auth', 'ورود به ناحیه کاربری رضا دژهوت ', 'private', 1, 0, '2022-07-27 13:46:20', '2022-07-27 13:46:20'),
(54, 'Auth', 'ورود به ناحیه کاربری رضا دژهوت ', 'private', 1, 0, '2022-08-16 06:37:02', '2022-08-16 06:37:02'),
(55, 'Auth', 'ورود به ناحیه کاربری sisi ', 'private', 8623, 0, '2022-08-16 06:39:32', '2022-08-16 06:39:32'),
(56, 'Order', 'سلام رضا دژهوت دوره های شما : اموزش جامع nodeJS  به مبلغ 390000.00  تومان اوکی شد', 'private', 1, 0, '2022-08-16 07:00:24', '2022-08-16 07:00:24'),
(57, 'Order', 'سلام رضا دژهوت دوره های شما : اموزش جامع nodeJS  به مبلغ 390000.00  تومان اوکی شد', 'private', 1, 0, '2022-08-16 07:00:29', '2022-08-16 07:00:29'),
(58, 'Order', 'سلام sisi دوره های شما : اموزش برنامه نویسی ویندوز | c# programming  به مبلغ 0.00  تومان اوکی شد', 'private', 8623, 0, '2022-08-16 07:09:49', '2022-08-16 07:09:49'),
(59, 'Auth', 'ورود به ناحیه کاربری رضا دژهوت ', 'private', 1, 0, '2022-08-22 08:21:32', '2022-08-22 08:21:32'),
(60, 'Auth', 'ورود به ناحیه کاربری aliali ', 'private', 8625, 0, '2022-08-22 08:26:45', '2022-08-22 08:26:45'),
(61, 'Auth', 'ورود به ناحیه کاربری رضا دژهوت ', 'private', 1, 0, '2022-08-22 18:25:37', '2022-08-22 18:25:37'),
(63, 'Auth', 'ورود به ناحیه کاربری رضا دژهوت ', 'private', 1, 0, '2022-11-16 15:40:27', '2022-11-16 15:40:27'),
(64, 'fee', 'واریز حق التدرس بابت دوره اموزشی اموزش figma   به مبلغ 10,000 تومان ', 'private', 1, 0, '2022-11-16 16:43:10', '2022-11-16 16:43:10'),
(65, 'Order', 'سلام رضا دژهوت دوره های شما : اموزش figma   به مبلغ 100000.00  تومان اوکی شد', 'private', 1, 0, '2022-11-16 16:43:10', '2022-11-16 16:43:10'),
(66, 'teacher', '  مدرس گرامی حساب بانکی شما با شماره کارت   6219861036883428 تایید شد ', 'private', 1, 0, '2022-11-16 16:46:11', '2022-11-16 16:46:11'),
(67, 'teacher', ' مدرس گرامی تسویه حساب شما به شماره 1 با موفیت انجام شد ', 'private', 1, 0, '2022-11-16 16:47:53', '2022-11-16 16:47:53');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `total_price` decimal(25,2) NOT NULL,
  `reduction_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reductions_value` decimal(25,2) DEFAULT NULL,
  `discount` decimal(25,2) DEFAULT NULL,
  `wallet_pay` int(10) UNSIGNED NOT NULL,
  `transactionId` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `user_ip`, `price`, `total_price`, `reduction_code`, `reductions_value`, `discount`, `wallet_pay`, `transactionId`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, '127.0.0.1', '780000.00', '780000.00', NULL, '0.00', '0.00', 0, 'afa949c08e3102aa1842479bea9040d2', NULL, '2022-07-03 22:15:05', '2022-07-03 22:15:05'),
(2, 1, '127.0.0.1', '780000.00', '780000.00', NULL, '0.00', '0.00', 0, '4b9d9d369cf0759875479debb41bd0c3', NULL, '2022-07-03 22:55:57', '2022-07-03 22:55:57'),
(3, 1, '127.0.0.1', '325000.00', '0.00', NULL, '0.00', '0.00', 325000, NULL, NULL, '2022-07-06 05:54:07', '2022-07-06 05:54:07'),
(4, 1, '127.0.0.1', '325000.00', '0.00', NULL, '0.00', '0.00', 325000, NULL, NULL, '2022-07-06 05:54:13', '2022-07-06 05:54:13'),
(5, 1, '127.0.0.1', '325000.00', '0.00', NULL, '0.00', '0.00', 325000, NULL, '2022-07-13 22:24:13', '2022-07-06 05:54:40', '2022-07-13 22:24:13'),
(14, 1, '127.0.0.1', '1650000.00', '1134000.00', 'test', '516000.00', '390000.00', 0, 'ad2421888e1b8ba7736322422269ba8e', '2022-07-13 22:55:49', '2022-07-13 22:52:51', '2022-07-13 22:55:49'),
(18, 1, '127.0.0.1', '1650000.00', '1134000.00', 'test', '516000.00', '390000.00', 0, '34b6b56d0d25eea8f6d17ec880ebf94b', '2022-07-24 14:32:34', '2022-07-13 23:10:54', '2022-07-24 14:32:34'),
(19, 1, '127.0.0.1', '1650000.00', '1260000.00', NULL, '390000.00', '390000.00', 0, 'a05e42da82df0d549352f32aedfe06b9', NULL, '2022-07-14 12:56:12', '2022-07-14 12:56:12'),
(20, 1, '127.0.0.1', '423000.00', '348000.00', NULL, '75000.00', '75000.00', 0, '41ff72ab073d381250e9dbdd72638bf7', NULL, '2022-07-21 01:06:53', '2022-07-21 01:06:53'),
(22, 1, '127.0.0.1', '423000.00', '348000.00', NULL, '75000.00', '75000.00', 0, 'b2de7ad854038d6671084cc4c60112a3', '2022-07-21 01:56:24', '2022-07-21 01:31:57', '2022-07-21 01:56:24'),
(23, 1, '127.0.0.1', '150000.00', '150000.00', NULL, '0.00', '0.00', 0, '178e7e02c82767b0c9dd304b9424fede', NULL, '2022-07-24 14:07:53', '2022-07-24 14:07:53'),
(24, 1, '127.0.0.1', '0.00', '0.00', NULL, '0.00', '0.00', 0, NULL, '2022-07-24 14:36:59', '2022-07-24 14:33:11', '2022-07-24 14:36:59'),
(25, 1, '127.0.0.1', '0.00', '0.00', NULL, '0.00', '0.00', 0, NULL, '2022-07-24 14:54:04', '2022-07-24 14:38:19', '2022-07-24 14:54:04'),
(26, 1, '5.126.184.207', '780000.00', '390000.00', NULL, '390000.00', '390000.00', 0, 'c965dac8e61fadf90f7c5130ec96f893', NULL, '2022-08-16 06:56:34', '2022-08-16 06:56:34'),
(27, 8623, '86.57.12.58', '325000.00', '324000.00', NULL, '0.00', '0.00', 1000, 'b16091b68e0d42c371c672094a0d877e', NULL, '2022-08-16 06:59:04', '2022-08-16 06:59:04'),
(28, 8623, '86.57.12.58', '0.00', '0.00', NULL, '0.00', '0.00', 0, NULL, NULL, '2022-08-16 07:07:36', '2022-08-16 07:07:36'),
(29, 8623, '86.57.12.58', '150000.00', '0.00', NULL, '0.00', '0.00', 150000, NULL, NULL, '2022-08-16 07:09:48', '2022-08-16 07:09:48'),
(30, 8623, '86.57.12.58', '330000.00', '252450.00', 'cod11', '77550.00', '49500.00', 0, '559708b3c15723b26211f5879e51a897', NULL, '2022-08-16 07:10:44', '2022-08-16 07:10:44'),
(31, 1, '86.57.3.208', '150000.00', '150000.00', NULL, '0.00', '0.00', 0, 'yvjbibmdpbgn48lkipugatsb3odcbqbx', NULL, '2022-08-22 08:07:51', '2022-08-22 08:07:51'),
(32, 1, '86.57.3.208', '0.00', '0.00', NULL, '0.00', '0.00', 0, NULL, NULL, '2022-08-22 08:15:28', '2022-08-22 08:15:28'),
(33, 1, '127.0.0.1', '100000.00', '100000.00', NULL, '0.00', '0.00', 0, '21f2d3cefa725b176b75b7ff1879f872', NULL, '2022-11-16 16:43:01', '2022-11-16 16:43:01');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_data` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` bigint(20) UNSIGNED NOT NULL,
  `reduction_amount` decimal(40,2) NOT NULL,
  `wallet_amount` decimal(40,2) NOT NULL,
  `teacher_amount` decimal(40,3) DEFAULT NULL,
  `total_price` bigint(20) UNSIGNED NOT NULL,
  `quantity` mediumint(8) UNSIGNED NOT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `incoming_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `course_id`, `product_data`, `price`, `reduction_amount`, `wallet_amount`, `teacher_amount`, `total_price`, `quantity`, `order_id`, `status`, `incoming_method_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 6, '{\"id\":6,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u062c\\u0627\\u0645\\u0639 nodeJS\"}', 780000, '0.00', '0.00', NULL, 780000, 1, 1, 'wc-completed', NULL, NULL, '2022-07-03 22:15:05', '2022-07-03 22:15:13'),
(2, 6, '{\"id\":6,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u062c\\u0627\\u0645\\u0639 nodeJS\"}', 780000, '0.00', '0.00', NULL, 780000, 1, 2, 'wc-completed', NULL, NULL, '2022-07-03 22:55:57', '2022-07-13 22:51:14'),
(3, 1, '{\"id\":1,\"title\":\"\\u0628\\u0631\\u0646\\u0627\\u0645\\u0647 \\u0646\\u0648\\u06cc\\u0633\\u06cc \\u0627\\u0646\\u062f\\u0631\\u0648\\u06cc\\u062f | android programming\"}', 325000, '0.00', '325000.00', NULL, 0, 1, 3, 'wc-pending', NULL, NULL, '2022-07-06 05:54:07', '2022-07-06 05:54:07'),
(4, 1, '{\"id\":1,\"title\":\"\\u0628\\u0631\\u0646\\u0627\\u0645\\u0647 \\u0646\\u0648\\u06cc\\u0633\\u06cc \\u0627\\u0646\\u062f\\u0631\\u0648\\u06cc\\u062f | android programming\"}', 325000, '0.00', '325000.00', NULL, 0, 1, 4, 'wc-pending', NULL, NULL, '2022-07-06 05:54:13', '2022-07-06 05:54:13'),
(5, 1, '{\"id\":1,\"title\":\"\\u0628\\u0631\\u0646\\u0627\\u0645\\u0647 \\u0646\\u0648\\u06cc\\u0633\\u06cc \\u0627\\u0646\\u062f\\u0631\\u0648\\u06cc\\u062f | android programming\"}', 325000, '0.00', '325000.00', NULL, 0, 1, 5, 'wc-completed', NULL, '2022-07-13 22:24:13', '2022-07-06 05:54:40', '2022-07-13 22:24:13'),
(11, 6, '{\"id\":6,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u062c\\u0627\\u0645\\u0639 nodeJS\"}', 780000, '39000.00', '0.00', NULL, 351000, 1, 14, 'wc-completed', NULL, '2022-07-13 22:55:49', '2022-07-13 22:52:51', '2022-07-13 22:55:49'),
(12, 3, '{\"id\":3,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u0628\\u0631\\u0646\\u0627\\u0645\\u0647 \\u0646\\u0648\\u06cc\\u0633\\u06cc \\u0648\\u06cc\\u0646\\u062f\\u0648\\u0632 | c# programming\"}', 150000, '15000.00', '0.00', NULL, 135000, 1, 14, 'wc-completed', NULL, '2022-07-13 22:55:49', '2022-07-13 22:52:51', '2022-07-13 22:55:49'),
(13, 5, '{\"id\":5,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u062c\\u0627\\u0645\\u0639 \\u0644\\u0627\\u0631\\u0627\\u0648\\u0644\"}', 720000, '72000.00', '0.00', NULL, 648000, 1, 14, 'wc-completed', NULL, '2022-07-13 22:55:49', '2022-07-13 22:52:51', '2022-07-13 22:55:49'),
(14, 4, '{\"id\":4,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u0632\\u0628\\u0627\\u0646 \\u0633\\u0627\\u0644\\u06cc\\u062f\\u06cc\\u062a\\u06cc  \"}', 0, '0.00', '0.00', NULL, 0, 1, 15, 'wc-completed', NULL, NULL, '2022-07-13 23:00:52', '2022-07-13 23:00:52'),
(15, 4, '{\"id\":4,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u0632\\u0628\\u0627\\u0646 \\u0633\\u0627\\u0644\\u06cc\\u062f\\u06cc\\u062a\\u06cc  \"}', 0, '0.00', '0.00', NULL, 0, 1, 16, 'wc-completed', NULL, NULL, '2022-07-13 23:00:55', '2022-07-13 23:00:55'),
(16, 4, '{\"id\":4,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u0632\\u0628\\u0627\\u0646 \\u0633\\u0627\\u0644\\u06cc\\u062f\\u06cc\\u062a\\u06cc  \"}', 0, '0.00', '0.00', NULL, 0, 1, 17, 'wc-completed', NULL, NULL, '2022-07-13 23:01:14', '2022-07-13 23:01:14'),
(17, 4, '{\"id\":4,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u0632\\u0628\\u0627\\u0646 \\u0633\\u0627\\u0644\\u06cc\\u062f\\u06cc\\u062a\\u06cc  \"}', 0, '0.00', '0.00', NULL, 0, 1, 18, 'wc-completed', NULL, '2022-07-24 14:32:34', '2022-07-13 23:10:54', '2022-07-24 14:32:34'),
(18, 6, '{\"id\":6,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u062c\\u0627\\u0645\\u0639 nodeJS\"}', 780000, '429000.00', '0.00', NULL, 351000, 1, 18, 'wc-completed', NULL, '2022-07-24 14:32:34', '2022-07-13 23:10:54', '2022-07-24 14:32:34'),
(19, 5, '{\"id\":5,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u062c\\u0627\\u0645\\u0639 \\u0644\\u0627\\u0631\\u0627\\u0648\\u0644\"}', 720000, '72000.00', '0.00', NULL, 648000, 1, 18, 'wc-completed', NULL, '2022-07-24 14:32:34', '2022-07-13 23:10:54', '2022-07-24 14:32:34'),
(20, 3, '{\"id\":3,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u0628\\u0631\\u0646\\u0627\\u0645\\u0647 \\u0646\\u0648\\u06cc\\u0633\\u06cc \\u0648\\u06cc\\u0646\\u062f\\u0648\\u0632 | c# programming\"}', 150000, '15000.00', '0.00', NULL, 135000, 1, 18, 'wc-completed', NULL, '2022-07-24 14:32:34', '2022-07-13 23:10:54', '2022-07-24 14:32:34'),
(21, 5, '{\"id\":5,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u062c\\u0627\\u0645\\u0639 \\u0644\\u0627\\u0631\\u0627\\u0648\\u0644\"}', 720000, '0.00', '0.00', NULL, 720000, 1, 19, 'wc-pending', NULL, NULL, '2022-07-14 12:56:12', '2022-07-14 12:56:12'),
(22, 6, '{\"id\":6,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u062c\\u0627\\u0645\\u0639 nodeJS\"}', 780000, '390000.00', '0.00', NULL, 390000, 1, 19, 'wc-pending', NULL, NULL, '2022-07-14 12:56:12', '2022-07-14 12:56:12'),
(23, 3, '{\"id\":3,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u0628\\u0631\\u0646\\u0627\\u0645\\u0647 \\u0646\\u0648\\u06cc\\u0633\\u06cc \\u0648\\u06cc\\u0646\\u062f\\u0648\\u0632 | c# programming\"}', 150000, '0.00', '0.00', NULL, 150000, 1, 19, 'wc-processing', NULL, NULL, '2022-07-14 12:56:12', '2022-07-20 23:12:11'),
(24, 2, '{\"id\":2,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u0628\\u0631\\u0646\\u0627\\u0645\\u0647 \\u0646\\u0648\\u06cc\\u0633\\u06cc php programming | php\"}', 423000, '75000.00', '0.00', NULL, 348000, 1, 20, 'wc-pending', NULL, NULL, '2022-07-21 01:06:53', '2022-07-21 01:06:53'),
(25, 2, '{\"id\":2,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u0628\\u0631\\u0646\\u0627\\u0645\\u0647 \\u0646\\u0648\\u06cc\\u0633\\u06cc php programming | php\"}', 423000, '75000.00', '0.00', NULL, 348000, 1, 22, 'wc-pending', NULL, '2022-07-21 01:56:24', '2022-07-21 01:31:57', '2022-07-21 01:56:24'),
(26, 3, '{\"id\":3,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u0628\\u0631\\u0646\\u0627\\u0645\\u0647 \\u0646\\u0648\\u06cc\\u0633\\u06cc \\u0648\\u06cc\\u0646\\u062f\\u0648\\u0632 | c# programming\"}', 150000, '0.00', '0.00', NULL, 150000, 1, 23, 'wc-pending', NULL, NULL, '2022-07-24 14:07:53', '2022-07-24 14:07:53'),
(27, 4, '{\"id\":4,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u0632\\u0628\\u0627\\u0646 \\u0633\\u0627\\u0644\\u06cc\\u062f\\u06cc\\u062a\\u06cc  \"}', 0, '0.00', '0.00', NULL, 0, 1, 24, 'wc-completed', NULL, '2022-07-24 14:36:59', '2022-07-24 14:33:11', '2022-07-24 14:36:59'),
(28, 4, '{\"id\":4,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u0632\\u0628\\u0627\\u0646 \\u0633\\u0627\\u0644\\u06cc\\u062f\\u06cc\\u062a\\u06cc  \"}', 0, '0.00', '0.00', NULL, 0, 1, 25, 'wc-completed', NULL, '2022-07-24 14:54:04', '2022-07-24 14:38:19', '2022-07-24 14:54:04'),
(29, 6, '{\"id\":6,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u062c\\u0627\\u0645\\u0639 nodeJS\"}', 780000, '390000.00', '0.00', NULL, 390000, 1, 26, 'wc-completed', NULL, NULL, '2022-08-16 06:56:34', '2022-08-16 07:00:24'),
(30, 1, '{\"id\":1,\"title\":\"\\u0628\\u0631\\u0646\\u0627\\u0645\\u0647 \\u0646\\u0648\\u06cc\\u0633\\u06cc \\u0627\\u0646\\u062f\\u0631\\u0648\\u06cc\\u062f | android programming\"}', 325000, '0.00', '1000.00', NULL, 324000, 1, 27, 'wc-pending', NULL, NULL, '2022-08-16 06:59:04', '2022-08-16 06:59:04'),
(31, 4, '{\"id\":4,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u0632\\u0628\\u0627\\u0646 \\u0633\\u0627\\u0644\\u06cc\\u062f\\u06cc\\u062a\\u06cc  \"}', 0, '0.00', '0.00', NULL, 0, 1, 28, 'wc-completed', NULL, NULL, '2022-08-16 07:07:36', '2022-08-16 07:07:36'),
(32, 3, '{\"id\":3,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u0628\\u0631\\u0646\\u0627\\u0645\\u0647 \\u0646\\u0648\\u06cc\\u0633\\u06cc \\u0648\\u06cc\\u0646\\u062f\\u0648\\u0632 | c# programming\"}', 150000, '0.00', '150000.00', NULL, 0, 1, 29, 'wc-completed', NULL, NULL, '2022-08-16 07:09:48', '2022-08-16 07:09:49'),
(33, 15, '{\"id\":15,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u0641\\u0648\\u062a\\u0648\\u0634\\u0627\\u067e | photoshop\"}', 330000, '77550.00', '0.00', NULL, 252450, 1, 30, 'wc-pending', NULL, NULL, '2022-08-16 07:10:44', '2022-08-16 07:10:44'),
(34, 3, '{\"id\":3,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u0628\\u0631\\u0646\\u0627\\u0645\\u0647 \\u0646\\u0648\\u06cc\\u0633\\u06cc \\u0648\\u06cc\\u0646\\u062f\\u0648\\u0632 | c# programming\"}', 150000, '0.00', '0.00', NULL, 150000, 1, 31, 'wc-pending', NULL, NULL, '2022-08-22 08:07:51', '2022-08-22 08:07:51'),
(35, 4, '{\"id\":4,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u0632\\u0628\\u0627\\u0646 \\u0633\\u0627\\u0644\\u06cc\\u062f\\u06cc\\u062a\\u06cc  \"}', 0, '0.00', '0.00', NULL, 0, 1, 32, 'wc-completed', NULL, NULL, '2022-08-22 08:15:28', '2022-08-22 08:15:28'),
(36, 16, '{\"id\":16,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 figma \"}', 100000, '0.00', '0.00', '10000.000', 100000, 1, 33, 'wc-completed', 1, NULL, '2022-11-16 16:43:01', '2022-11-16 16:43:10');

-- --------------------------------------------------------

--
-- Table structure for table `order_notes`
--

CREATE TABLE `order_notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_user_note` tinyint(1) NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_notes`
--

INSERT INTO `order_notes` (`id`, `note`, `is_user_note`, `order_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'سفارش KV-897880 باموفقیت ثبت شد', 1, 1, NULL, '2022-07-03 22:15:05', '2022-07-03 22:15:05'),
(2, 'پرداخت با موفقیت انجام شد. کد پیگیری درگاه: 766943', 1, 1, NULL, '2022-07-03 22:15:13', '2022-07-03 22:15:13'),
(3, 'سفارش KV-897881 باموفقیت ثبت شد', 1, 2, NULL, '2022-07-03 22:55:57', '2022-07-03 22:55:57'),
(4, 'پرداخت با موفقیت انجام شد. کد پیگیری درگاه: 766959', 1, 2, NULL, '2022-07-03 22:56:04', '2022-07-03 22:56:04'),
(5, 'سفارش KV-897882 باموفقیت ثبت شد', 1, 3, NULL, '2022-07-06 05:54:07', '2022-07-06 05:54:07'),
(6, 'سفارش KV-897883 باموفقیت ثبت شد', 1, 4, NULL, '2022-07-06 05:54:13', '2022-07-06 05:54:13'),
(7, 'سفارش KV-897884 باموفقیت ثبت شد', 1, 5, NULL, '2022-07-06 05:54:40', '2022-07-06 05:54:40'),
(10, 'سلام admin دوره های شما : برنامه نویسی اندروید | android programming  به مبلغ 0.00  تومان اوکی شد', 1, 5, NULL, '2022-07-06 06:05:07', '2022-07-06 06:05:07'),
(15, 'سلام admin دوره های شما : اموزش جامع nodeJS  به مبلغ 780000.00  تومان اوکی شد', 1, 2, NULL, '2022-07-13 22:51:01', '2022-07-13 22:51:01'),
(16, 'سفارش KV-897893 باموفقیت ثبت شد', 1, 14, NULL, '2022-07-13 22:52:51', '2022-07-13 22:52:51'),
(17, 'پرداخت با موفقیت انجام شد. کد پیگیری درگاه: 772401', 1, 14, NULL, '2022-07-13 22:53:04', '2022-07-13 22:53:04'),
(18, 'سلام admin دوره های شما : اموزش جامع nodeJS,اموزش برنامه نویسی ویندوز | c# programming,اموزش جامع لاراول  به مبلغ 1134000.00  تومان اوکی شد', 1, 14, NULL, '2022-07-13 22:53:04', '2022-07-13 22:53:04'),
(19, 'سفارش KV-897897 باموفقیت ثبت شد', 1, 18, NULL, '2022-07-13 23:10:54', '2022-07-13 23:10:54'),
(20, 'پرداخت با موفقیت انجام شد. کد پیگیری درگاه: 772405', 1, 18, NULL, '2022-07-13 23:11:16', '2022-07-13 23:11:16'),
(21, 'سلام admin دوره های شما : اموزش زبان سالیدیتی  ,اموزش جامع nodeJS,اموزش جامع لاراول,اموزش برنامه نویسی ویندوز | c# programming  به مبلغ 1134000.00  تومان اوکی شد', 1, 18, NULL, '2022-07-13 23:11:16', '2022-07-13 23:11:16'),
(22, 'سفارش KV-897898 باموفقیت ثبت شد', 1, 19, NULL, '2022-07-14 12:56:12', '2022-07-14 12:56:12'),
(23, 'سفارش FL-897899 باموفقیت ثبت شد', 1, 20, NULL, '2022-07-21 01:06:53', '2022-07-21 01:06:53'),
(24, 'سفارش FL-897901 باموفقیت ثبت شد', 1, 22, NULL, '2022-07-21 01:31:57', '2022-07-21 01:31:57'),
(25, 'سفارش FL-897902 باموفقیت ثبت شد', 1, 23, NULL, '2022-07-24 14:07:53', '2022-07-24 14:07:53'),
(26, 'سفارش FL-897905 باموفقیت ثبت شد', 1, 26, NULL, '2022-08-16 06:56:34', '2022-08-16 06:56:34'),
(27, 'سفارش FL-897906 باموفقیت ثبت شد', 1, 27, NULL, '2022-08-16 06:59:04', '2022-08-16 06:59:04'),
(28, 'پرداخت با موفقیت انجام شد. کد پیگیری درگاه: 790357', 1, 26, NULL, '2022-08-16 07:00:24', '2022-08-16 07:00:24'),
(29, 'سلام رضا دژهوت دوره های شما : اموزش جامع nodeJS  به مبلغ 390000.00  تومان اوکی شد', 1, 26, NULL, '2022-08-16 07:00:24', '2022-08-16 07:00:24'),
(30, 'سلام رضا دژهوت دوره های شما : اموزش جامع nodeJS  به مبلغ 390000.00  تومان اوکی شد', 1, 26, NULL, '2022-08-16 07:00:29', '2022-08-16 07:00:29'),
(31, 'سفارش FL-897908 باموفقیت ثبت شد', 1, 29, NULL, '2022-08-16 07:09:48', '2022-08-16 07:09:48'),
(32, 'سلام sisi دوره های شما : اموزش برنامه نویسی ویندوز | c# programming  به مبلغ 0.00  تومان اوکی شد', 1, 29, NULL, '2022-08-16 07:09:49', '2022-08-16 07:09:49'),
(33, 'سفارش FL-897909 باموفقیت ثبت شد', 1, 30, NULL, '2022-08-16 07:10:44', '2022-08-16 07:10:44'),
(34, 'سفارش FL-897910 باموفقیت ثبت شد', 1, 31, NULL, '2022-08-22 08:07:51', '2022-08-22 08:07:51'),
(35, 'سفارش FL-897912 باموفقیت ثبت شد', 1, 33, NULL, '2022-11-16 16:43:01', '2022-11-16 16:43:01'),
(36, 'پرداخت با موفقیت انجام شد. کد پیگیری درگاه: 830343', 1, 33, NULL, '2022-11-16 16:43:10', '2022-11-16 16:43:10'),
(37, 'سلام رضا دژهوت دوره های شما : اموزش figma   به مبلغ 100000.00  تومان اوکی شد', 1, 33, NULL, '2022-11-16 16:43:10', '2022-11-16 16:43:10');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(10) UNSIGNED NOT NULL,
  `payment_gateway` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_ref` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `status_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `json` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `call_back_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `amount`, `payment_gateway`, `payment_token`, `payment_ref`, `model_type`, `model_id`, `status_code`, `json`, `status_message`, `user_id`, `call_back_url`, `ip`, `created_at`, `updated_at`) VALUES
(1, 780000, 'idpay', 'afa949c08e3102aa1842479bea9040d2', '766943', 'App\\Models\\Order', 1, '100', NULL, 'پرداخت با موفقیت انجام شد', 1, '', NULL, '2022-07-03 22:15:05', '2022-07-03 22:15:13'),
(2, 780000, 'idpay', '4b9d9d369cf0759875479debb41bd0c3', '766959', 'App\\Models\\Order', 2, '100', NULL, 'پرداخت با موفقیت انجام شد', 1, '', NULL, '2022-07-03 22:55:57', '2022-07-03 22:56:03'),
(3, 1134000, 'idpay', 'ad2421888e1b8ba7736322422269ba8e', '772401', 'App\\Models\\Order', 14, '100', NULL, 'پرداخت با موفقیت انجام شد', 1, '', NULL, '2022-07-13 22:52:51', '2022-07-13 22:53:04'),
(4, 1134000, 'idpay', '34b6b56d0d25eea8f6d17ec880ebf94b', '772405', 'App\\Models\\Order', 18, '100', NULL, 'پرداخت با موفقیت انجام شد', 1, '', NULL, '2022-07-13 23:10:54', '2022-07-13 23:11:16'),
(5, 1260000, 'idpay', 'a05e42da82df0d549352f32aedfe06b9', NULL, 'App\\Models\\Order', 19, NULL, NULL, NULL, 1, '', NULL, '2022-07-14 12:56:12', '2022-07-14 12:56:12'),
(6, 10000, 'idpay', '33a522893ab3d156452eaeced7a02441', NULL, 'user', 1, NULL, NULL, NULL, 1, '', NULL, '2022-07-20 23:17:18', '2022-07-20 23:17:18'),
(7, 348000, 'idpay', '41ff72ab073d381250e9dbdd72638bf7', NULL, 'App\\Models\\Order', 20, NULL, NULL, NULL, 1, '', NULL, '2022-07-21 01:06:53', '2022-07-21 01:06:53'),
(8, 348000, 'idpay', 'b2de7ad854038d6671084cc4c60112a3', NULL, 'App\\Models\\Order', 22, NULL, NULL, NULL, 1, '', NULL, '2022-07-21 01:31:57', '2022-07-21 01:31:57'),
(9, 150000, 'idpay', '178e7e02c82767b0c9dd304b9424fede', NULL, 'App\\Models\\Order', 23, NULL, NULL, NULL, 1, '', '127.0.0.1', '2022-07-24 14:07:53', '2022-07-24 14:07:53'),
(10, 10000000, 'idpay', '4b9f38ffbea9841b3cc05aafcd673a17', NULL, 'App\\Models\\User', 8623, '0', NULL, 'تایید پرداخت امکان پذیر نیست.', 8623, '', '86.57.12.58', '2022-08-16 06:40:18', '2022-08-16 06:40:26'),
(11, 390000, 'idpay', 'c965dac8e61fadf90f7c5130ec96f893', '790357', 'App\\Models\\Order', 26, '100', NULL, 'پرداخت با موفقیت انجام شد', 1, '', '5.126.184.207', '2022-08-16 06:56:34', '2022-08-16 07:00:24'),
(12, 324000, 'idpay', '5dfdca44af323d52d3d90f0f7463bfd1', NULL, 'App\\Models\\Order', 27, '0', NULL, 'تایید پرداخت امکان پذیر نیست.', 8623, '', '86.57.12.58', '2022-08-16 06:59:04', '2022-08-16 07:01:01'),
(13, 252450, 'idpay', '559708b3c15723b26211f5879e51a897', NULL, 'App\\Models\\Order', 30, NULL, NULL, NULL, 8623, '', '86.57.12.58', '2022-08-16 07:10:44', '2022-08-16 07:10:44'),
(14, 150000, 'idpay', 'yvjbibmdpbgn48lkipugatsb3odcbqbx', NULL, 'App\\Models\\Order', 31, NULL, NULL, NULL, 1, '', '86.57.3.208', '2022-08-22 08:07:51', '2022-08-22 08:07:51'),
(15, 100000, 'idpay', '21f2d3cefa725b176b75b7ff1879f872', '830343', 'App\\Models\\Order', 33, '100', NULL, 'پرداخت با موفقیت انجام شد', 1, '', '127.0.0.1', '2022-11-16 16:43:01', '2022-11-16 16:43:10');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'show_dashboard', 'web', NULL, NULL),
(2, 'show_orders', 'web', NULL, NULL),
(3, 'edit_orders', 'web', NULL, NULL),
(4, 'delete_orders', 'web', NULL, NULL),
(5, 'show_events', 'web', NULL, NULL),
(6, 'edit_events', 'web', NULL, NULL),
(7, 'delete_events', 'web', NULL, NULL),
(8, 'show_courses', 'web', NULL, NULL),
(9, 'edit_courses', 'web', NULL, NULL),
(10, 'cancel_courses', 'web', NULL, NULL),
(11, 'show_tickets', 'web', NULL, NULL),
(12, 'edit_tickets', 'web', NULL, NULL),
(13, 'delete_tickets', 'web', NULL, NULL),
(14, 'show_notifications', 'web', NULL, NULL),
(15, 'edit_notifications', 'web', NULL, NULL),
(16, 'delete_notifications', 'web', NULL, NULL),
(17, 'show_reductions', 'web', NULL, NULL),
(18, 'edit_reductions', 'web', NULL, NULL),
(19, 'delete_reductions', 'web', NULL, NULL),
(20, 'show_teachers', 'web', NULL, NULL),
(22, 'delete_teachers', 'web', NULL, NULL),
(23, 'show_transcripts', 'web', NULL, NULL),
(24, 'edit_transcripts', 'web', NULL, NULL),
(25, 'delete_transcripts', 'web', NULL, NULL),
(26, 'show_comments', 'web', NULL, NULL),
(27, 'edit_comments', 'web', NULL, NULL),
(28, 'delete_comments', 'web', NULL, NULL),
(29, 'show_users', 'web', NULL, NULL),
(30, 'edit_users', 'web', NULL, NULL),
(31, 'delete_users', 'web', NULL, NULL),
(32, 'show_certificates', 'web', NULL, NULL),
(33, 'edit_certificates', 'web', NULL, NULL),
(34, 'delete_certificates', 'web', NULL, NULL),
(35, 'show_categories', 'web', NULL, NULL),
(36, 'edit_categories', 'web', NULL, NULL),
(37, 'delete_categories', 'web', NULL, NULL),
(38, 'show_articles', 'web', NULL, NULL),
(39, 'edit_articles', 'web', NULL, NULL),
(40, 'delete_articles', 'web', NULL, NULL),
(41, 'show_questions', 'web', NULL, NULL),
(42, 'edit_questions', 'web', NULL, NULL),
(43, 'delete_questions', 'web', NULL, NULL),
(44, 'show_quizzes', 'web', NULL, NULL),
(45, 'edit_quizzes', 'web', NULL, NULL),
(46, 'delete_quizzes', 'web', NULL, NULL),
(47, 'show_payments', 'web', NULL, NULL),
(48, 'delete_payments', 'web', NULL, NULL),
(49, 'show_tags', 'web', NULL, NULL),
(50, 'edit_tags', 'web', NULL, NULL),
(51, 'delete_tags', 'web', NULL, NULL),
(52, 'edit_tasks', 'web', NULL, NULL),
(53, 'delete_tasks', 'web', NULL, NULL),
(54, 'show_tasks', 'web', NULL, NULL),
(55, 'show_roles', 'web', NULL, NULL),
(56, 'edit_roles', 'web', NULL, NULL),
(57, 'delete_roles', 'web', NULL, NULL),
(58, 'show_settings', 'web', NULL, NULL),
(59, 'show_settings_base', 'web', NULL, NULL),
(60, 'edit_settings_base', 'web', NULL, NULL),
(61, 'show_settings_home', 'web', NULL, NULL),
(62, 'edit_settings_home', 'web', NULL, NULL),
(63, 'show_settings_sms', 'web', NULL, NULL),
(64, 'edit_settings_sms', 'web', NULL, NULL),
(65, 'show_settings_aboutUs', 'web', NULL, NULL),
(66, 'edit_settings_aboutUs', 'web', NULL, NULL),
(67, 'show_settings_contactUs', 'web', NULL, NULL),
(68, 'edit_settings_contactUs', 'web', NULL, NULL),
(69, 'show_settings_fag', 'web', NULL, NULL),
(70, 'edit_settings_fag', 'web', NULL, NULL),
(71, 'show_organizations', 'web', NULL, NULL),
(72, 'edit_organizations', 'web', NULL, NULL),
(73, 'delete_organizations', 'web', NULL, NULL),
(74, 'show_episodes', 'web', NULL, NULL),
(75, 'edit_episodes', 'web', NULL, NULL),
(76, 'delete_episodes', 'web', NULL, NULL),
(77, 'public_driver', 'web', NULL, NULL),
(78, 'private_driver', 'web', NULL, NULL),
(79, 'ftp_driver', 'web', NULL, NULL),
(80, 'sftp_driver', 'web', NULL, NULL),
(81, 's3_driver', 'web', NULL, NULL),
(82, 'show_contacts', 'web', NULL, NULL),
(83, 'edit_contacts', 'web', NULL, NULL),
(84, 'delete_contacts', 'web', NULL, NULL),
(85, 'show_logs', 'web', NULL, NULL),
(86, 'show_samples', 'web', NULL, NULL),
(87, 'edit_samples', 'web', NULL, NULL),
(88, 'delete_samples', 'web', NULL, NULL),
(89, 'show_storages', 'web', NULL, NULL),
(90, 'edit_storages', 'web', NULL, NULL),
(91, 'delete_storages', 'web', NULL, NULL),
(92, 'show_teacher_requests', 'web', NULL, NULL),
(93, 'edit_teacher_requests', 'web', NULL, NULL),
(94, 'delete_teacher_requests', 'web', NULL, NULL),
(95, 'show_new_courses', 'web', NULL, NULL),
(96, 'edit_new_courses', 'web', NULL, NULL),
(97, 'delete_new_courses', 'web', NULL, NULL),
(98, 'show_checkouts', 'web', NULL, NULL),
(99, 'edit_checkouts', 'web', NULL, NULL),
(100, 'show_bank_accounts', 'web', NULL, NULL),
(101, 'edit_bank_accounts', 'web', NULL, NULL),
(102, 'delete_bank_accounts', 'web', NULL, NULL),
(103, 'show_incoming_methods', 'web', NULL, NULL),
(104, 'edit_incoming_methods', 'web', NULL, NULL),
(105, 'delete_incoming_methods', 'web', NULL, NULL),
(112, 'custom_storage-1', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `score` double NOT NULL DEFAULT 0,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `difficulty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `name`, `text`, `category_id`, `score`, `source`, `difficulty`, `created_at`, `updated_at`) VALUES
(1, 'سوال اول', '<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باش.<img alt=\"cheeky\" src=\"https://cdn.ckeditor.com/4.13.0/full/plugins/smiley/images/tongue_smile.png\" style=\"height:23px; width:23px\" title=\"cheeky\" /></p>\n', 6, 15, NULL, 'middle', '2022-07-03 21:41:33', '2022-07-10 11:23:15'),
(4, 'سوال دوم', '<h3><u><strong>متن سوال دوم</strong></u></h3>\n', 6, 20, NULL, 'middle', '2022-07-10 11:24:30', '2022-07-10 11:24:30');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriptions` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` double NOT NULL,
  `certificate_id` bigint(20) DEFAULT NULL,
  `accept_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_score` double NOT NULL,
  `rand` int(11) NOT NULL DEFAULT 0,
  `enter_count` int(11) NOT NULL DEFAULT 1,
  `question_count` int(11) NOT NULL DEFAULT 1,
  `show_choices_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `name`, `image`, `descriptions`, `time`, `certificate_id`, `accept_type`, `min_score`, `rand`, `enter_count`, `question_count`, `show_choices_type`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'برنامه نویسی', '/storage/files/html-basic.png', '<p>توضیحات ازمون</p>\n', 35, 1, 'percent', 50, 1, 1, 1, 'show_side_by_side', NULL, '2022-07-03 22:04:48', '2022-07-08 17:26:23'),
(2, 'ازمون جدید', '/storage/1176261.jpg', '<p>ازمون جدیدازمون جدیدازمون جدیدازمون جدیدازمون جدیدازمون جدیدازمون جدیدازمون جدیدازمون جدیدازمون جدیدازمون جدیدازمون جدیدازمون جدیدازمون جدیدازمون جدیدازمون جدیدازمون جدیدازمون جدیدازمون جدیدازمون جدید</p>\n', 13, 1, 'percent', 60, 1, 1, 1, 'show_side_by_side', NULL, '2022-08-22 08:13:40', '2022-08-22 08:13:40');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes_has_questions`
--

CREATE TABLE `quizzes_has_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quizzes_has_questions`
--

INSERT INTO `quizzes_has_questions` (`id`, `quiz_id`, `question_id`) VALUES
(1, 1, 1),
(2, 1, 4),
(3, 2, 1),
(4, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `reductions`
--

CREATE TABLE `reductions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(10) UNSIGNED NOT NULL,
  `starts_at` date DEFAULT NULL,
  `expires_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reductions`
--

INSERT INTO `reductions` (`id`, `code`, `description`, `type`, `amount`, `starts_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'test', NULL, 'percent', 10, NULL, NULL, '2022-07-13 22:52:38', '2022-07-13 22:52:38'),
(2, 'testtttt', NULL, 'percent', 25, '2022-07-19', NULL, '2022-07-14 12:40:46', '2022-07-20 13:27:49'),
(3, 'cod11', NULL, 'percent', 10, NULL, NULL, '2022-08-16 07:03:36', '2022-08-16 07:03:36');

-- --------------------------------------------------------

--
-- Table structure for table `reduction_metas`
--

CREATE TABLE `reduction_metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reduction_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reduction_metas`
--

INSERT INTO `reduction_metas` (`id`, `reduction_id`, `name`, `value`) VALUES
(10, 3, 'minimum_amount', '0');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2022-07-01 12:37:37', '2022-07-01 12:37:37'),
(2, 'super_admin', 'web', '2022-07-01 12:37:37', '2022-07-01 12:37:37'),
(3, 'administrator', 'web', '2022-07-01 12:37:37', '2022-07-01 12:37:37'),
(4, 'teacher', 'web', '2022-07-01 12:37:37', '2022-07-01 12:37:37'),
(6, 'پشتیبان', 'web', '2022-07-13 23:45:05', '2022-07-13 23:45:05'),
(7, 'نویسنده', 'web', '2022-07-13 23:45:54', '2022-07-13 23:45:54');

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
(1, 2),
(1, 3),
(2, 2),
(2, 3),
(2, 6),
(3, 2),
(3, 3),
(3, 6),
(4, 2),
(4, 3),
(5, 2),
(5, 3),
(6, 2),
(6, 3),
(7, 2),
(7, 3),
(8, 2),
(8, 3),
(9, 2),
(9, 3),
(10, 2),
(10, 3),
(11, 2),
(11, 3),
(11, 6),
(12, 2),
(12, 3),
(12, 6),
(13, 2),
(13, 3),
(13, 6),
(14, 2),
(14, 3),
(14, 6),
(15, 2),
(15, 3),
(15, 6),
(16, 2),
(16, 3),
(16, 6),
(17, 2),
(17, 3),
(18, 2),
(18, 3),
(19, 2),
(19, 3),
(20, 2),
(20, 3),
(22, 2),
(22, 3),
(23, 2),
(23, 3),
(24, 2),
(24, 3),
(25, 2),
(25, 3),
(26, 2),
(26, 3),
(27, 2),
(27, 3),
(28, 2),
(28, 3),
(29, 2),
(29, 3),
(30, 2),
(30, 3),
(31, 2),
(31, 3),
(32, 2),
(32, 3),
(33, 2),
(33, 3),
(34, 2),
(34, 3),
(35, 2),
(35, 3),
(36, 2),
(36, 3),
(37, 2),
(37, 3),
(38, 2),
(38, 3),
(38, 7),
(39, 2),
(39, 3),
(39, 7),
(40, 2),
(40, 3),
(40, 7),
(41, 2),
(41, 3),
(42, 2),
(42, 3),
(43, 2),
(43, 3),
(44, 2),
(44, 3),
(45, 2),
(45, 3),
(46, 2),
(46, 3),
(47, 2),
(47, 3),
(48, 2),
(48, 3),
(49, 2),
(49, 3),
(50, 2),
(50, 3),
(51, 2),
(51, 3),
(52, 2),
(52, 3),
(53, 2),
(53, 3),
(54, 2),
(54, 3),
(55, 2),
(55, 3),
(56, 2),
(56, 3),
(57, 2),
(57, 3),
(58, 2),
(58, 3),
(59, 2),
(59, 3),
(60, 2),
(60, 3),
(61, 2),
(61, 3),
(62, 2),
(62, 3),
(63, 2),
(63, 3),
(64, 2),
(64, 3),
(65, 2),
(65, 3),
(66, 2),
(66, 3),
(67, 2),
(67, 3),
(68, 2),
(68, 3),
(69, 2),
(69, 3),
(70, 2),
(70, 3),
(71, 2),
(71, 3),
(72, 2),
(72, 3),
(73, 2),
(73, 3),
(74, 2),
(74, 3),
(75, 2),
(75, 3),
(76, 2),
(76, 3),
(77, 3),
(77, 7),
(78, 3),
(79, 3),
(80, 3),
(81, 3),
(82, 2),
(82, 3),
(83, 2),
(83, 3),
(84, 2),
(84, 3),
(85, 3),
(86, 3),
(87, 3),
(88, 3),
(89, 3),
(90, 3),
(91, 3),
(92, 3),
(93, 3),
(94, 3),
(95, 3),
(96, 3),
(97, 3),
(98, 3),
(99, 3),
(100, 3),
(101, 3),
(102, 3),
(103, 3),
(104, 3),
(105, 3),
(112, 2);

-- --------------------------------------------------------

--
-- Table structure for table `samples`
--

CREATE TABLE `samples` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `downloads` int(11) NOT NULL DEFAULT 0,
  `course_id` bigint(20) DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `samples`
--

INSERT INTO `samples` (`id`, `slug`, `title`, `driver`, `status`, `type`, `downloads`, `course_id`, `file`, `seo_keywords`, `seo_description`, `description`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', 'cs-1', 'demo', 'public', 0, 11, '/test/Bikin-–-Free-Simple-Landing-Page-Template.png', NULL, NULL, '<p>setse</p>\n', '2022-11-16 16:36:27', '2022-11-16 16:36:27');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_key', '6LflAoMhAAAAAIpHnWz9bGW5tvx4FHSzkJS21MKT', '2022-07-01 13:46:54', '2022-08-17 09:30:55'),
(2, 'secret_key', '6LflAoMhAAAAADa5CIOldMaznUm_j5Qeb3kwkQMR', '2022-07-01 13:46:54', '2022-08-17 09:30:55'),
(3, 'auth_type', 'none', '2022-07-01 13:46:54', '2022-07-21 15:52:30'),
(4, 'send_type', 'none', '2022-07-01 13:46:54', '2022-07-21 15:52:30'),
(5, 'email_host', 'rezadezhhoot.ir', '2022-07-01 13:46:54', '2022-07-15 07:30:38'),
(6, 'email_username', 'test3@rezadezhhoot.ir', '2022-07-01 13:46:54', '2022-07-15 07:30:38'),
(7, 'email_password', '2123456', '2022-07-01 13:46:54', '2022-07-20 21:38:00'),
(8, 'faraz_apiKey', '1', '2022-07-01 13:46:54', '2022-07-10 10:53:59'),
(9, 'faraz_password', '1', '2022-07-01 13:46:54', '2022-07-02 09:26:07'),
(10, 'faraz_username', '1', '2022-07-01 13:46:54', '2022-07-02 09:26:07'),
(11, 'faraz_line', '3000505', '2022-07-01 13:46:54', '2022-07-09 08:38:07'),
(12, 'faraz_pattern', '1', '2022-07-01 13:46:54', '2022-07-10 10:53:59'),
(13, 'faraz_var', '1', '2022-07-01 13:46:54', '2022-07-10 10:53:59'),
(14, 'gateway', '[\"idpay\"]', '2022-07-01 13:46:54', '2022-11-16 16:42:33'),
(15, 'zarinpal_merchantId', '1', '2022-07-01 13:46:54', '2022-07-03 22:20:02'),
(16, 'zarinpal_title', 'زرین پال', '2022-07-01 13:46:54', '2022-07-01 13:46:54'),
(17, 'zarinpal_mode', 'sandbox', '2022-07-01 13:46:54', '2022-07-03 22:20:02'),
(18, 'zarinpal_logo', 'storage/files/gateways/unnamed.png', '2022-07-01 13:46:54', '2022-07-03 22:20:02'),
(19, 'zarinpal_unit', '1', '2022-07-01 13:46:54', '2022-07-03 22:20:02'),
(20, 'payir_merchantId', '', '2022-07-01 13:46:54', '2022-07-01 13:46:54'),
(21, 'payir_title', 'پی', '2022-07-01 13:46:54', '2022-07-01 13:46:54'),
(22, 'payir_logo', '', '2022-07-01 13:46:54', '2022-07-01 13:46:54'),
(23, 'payir_unit', '', '2022-07-01 13:46:54', '2022-07-01 13:46:54'),
(24, 'idpay_logo', 'storage/files/gateways/idpay.png', '2022-07-01 13:46:54', '2022-07-03 22:13:32'),
(25, 'idpay_title', 'ای دی پی', '2022-07-01 13:46:54', '2022-07-01 13:46:54'),
(26, 'idpay_merchantId', '77249e63-43e9-44ec-accb-a2e10adb71a0', '2022-07-01 13:46:54', '2022-08-17 08:59:57'),
(27, 'idpay_sandbox', '1', '2022-07-01 13:46:54', '2022-11-16 16:42:50'),
(28, 'idpay_unit', '10', '2022-07-01 13:46:54', '2022-07-03 22:13:32'),
(29, 'sftp_root', 'dasdas', '2022-07-01 13:46:54', '2022-07-11 20:40:53'),
(30, 'sftp_privateKey', 'asda', '2022-07-01 13:46:54', '2022-07-11 20:40:53'),
(31, 'sftp_hostFingerprint', 'asdasd', '2022-07-01 13:46:54', '2022-07-11 20:40:53'),
(32, 'sftp_maxTries', '2', '2022-07-01 13:46:54', '2022-07-11 20:40:53'),
(33, 'sftp_port', '22', '2022-07-01 13:46:54', '2022-07-01 13:46:54'),
(34, 'sftp_passphrase', 'asd', '2022-07-01 13:46:54', '2022-07-11 20:40:53'),
(35, 'sftp_host', 'sad', '2022-07-01 13:46:54', '2022-07-11 20:40:53'),
(36, 'sftp_username', 'asd', '2022-07-01 13:46:54', '2022-07-11 20:40:53'),
(37, 'sftp_password', 'dasd', '2022-07-01 13:46:54', '2022-07-11 20:40:53'),
(38, 'sftp_useAgent', '', '2022-07-01 13:46:54', '2022-07-01 13:46:54'),
(39, 'sftp_available', '', '2022-07-01 13:46:54', '2022-07-11 20:49:00'),
(40, 's3_key', '', '2022-07-01 13:46:54', '2022-07-01 13:46:54'),
(41, 's3_secret', '', '2022-07-01 13:46:54', '2022-07-01 13:46:54'),
(42, 's3_region', '', '2022-07-01 13:46:54', '2022-07-01 13:46:54'),
(43, 's3_bucket', '', '2022-07-01 13:46:54', '2022-07-01 13:46:54'),
(44, 's3_url', '', '2022-07-01 13:46:54', '2022-07-01 13:46:54'),
(45, 's3_endpoint', '', '2022-07-01 13:46:54', '2022-07-01 13:46:54'),
(46, 's3_use_path_style_endpoint', '', '2022-07-01 13:46:54', '2022-07-01 13:46:54'),
(47, 's3_available', '', '2022-07-01 13:46:54', '2022-07-01 13:46:54'),
(48, 'autographs', '{\"0\":\"<script src=\\\"https:\\/\\/static.idpay.ir\\/trust.js?id=98045117&width=64\\\"><\\/script> \",\"2\":\"<img src=\\\"https:\\/\\/rezaprojects.ir\\/storage\\/files\\/enamad.png\\\" alt=\\\"\\u0644\\u0648\\u06af\\u0648\\\">\",\"3\":\"<img src=\\\"https:\\/\\/rezaprojects.ir\\/storage\\/files\\/enamad.png\\\" alt=\\\"\\u0644\\u0648\\u06af\\u0648\\\">\"}', '2022-07-01 13:46:54', '2022-08-17 09:01:19'),
(49, 'copyRight', '© 1401 فست لرن. کلیه حقوق محفوظ است.', '2022-07-01 13:46:54', '2022-07-01 13:52:37'),
(50, 'logo', 'storage/Fast-Learn-Icon.png', '2022-07-01 13:46:54', '2022-08-15 19:31:59'),
(51, 'title', 'فست لرن', '2022-07-01 13:46:54', '2022-07-01 13:46:54'),
(52, 'name', 'فست لرن', '2022-07-01 13:46:54', '2022-07-01 13:46:54'),
(53, 'notification', '', '2022-07-01 13:46:54', '2022-07-01 13:46:54'),
(54, 'seoDescription', 'توضیحات سئو', '2022-07-01 13:46:54', '2022-07-01 13:46:54'),
(55, 'seoKeyword', 'توضیحات سئو', '2022-07-01 13:46:54', '2022-07-01 13:46:54'),
(56, 'registerGift', '1000', '2022-07-01 13:46:54', '2022-07-08 10:24:52'),
(57, 'footerText', 'متن فوتر', '2022-07-01 13:46:54', '2022-07-01 13:46:54'),
(58, 'storage', '2', '2022-07-01 13:46:54', '2022-07-12 07:16:04'),
(59, 'ftp_root', '/', '2022-07-01 13:46:54', '2022-07-11 13:46:21'),
(60, 'ftp_ip', '1', '2022-07-01 13:46:54', '2022-07-14 13:36:49'),
(62, 'ftp_password', '1', '2022-07-01 13:46:54', '2022-07-14 13:36:49'),
(63, 'ftp_ssl', '', '2022-07-01 13:46:54', '2022-07-10 14:57:56'),
(64, 'ftp_port', '21', '2022-07-01 13:46:54', '2022-07-11 13:46:21'),
(65, 'ftp_available', '1', '2022-07-01 13:46:54', '2022-07-13 15:20:25'),
(66, 'homeContent', '{\"0\":{\"title\":\"\\u062c\\u062f\\u06cc\\u062f \\u062a\\u0631\\u06cc\\u0646 \\u062f\\u0648\\u0631\\u0647 \\u0647\\u0627\",\"view\":\"1\",\"width\":\"12\",\"category\":\"courses\",\"type\":\"slider\",\"widthCase\":\"3\",\"moreLink\":\"\",\"contentCase\":[\"1\",\"2\",\"3\",\"4\"]},\"1\":{\"title\":\"\\u067e\\u0631\\u0641\\u0631\\u0648\\u0634 \\u062a\\u0631\\u06cc\\u0646 \\u062f\\u0648\\u0631\\u0647 \\u0647\\u0627\",\"view\":\"2\",\"width\":\"12\",\"category\":\"courses\",\"type\":\"grid\",\"widthCase\":\"4\",\"moreLink\":\"\",\"contentCase\":[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\"]},\"3\":{\"title\":\"\\u062f\\u0633\\u062a\\u0647 \\u0628\\u0646\\u062f\\u06cc \\u0647\\u0627\",\"view\":\"0\",\"width\":\"12\",\"category\":\"categories\",\"type\":\"grid\",\"widthCase\":\"3\",\"moreLink\":\"\",\"contentCase\":[\"1\",\"2\",\"3\",\"4\"]},\"4\":{\"title\":\"\\u0645\\u0642\\u0627\\u0644\\u0627\\u062a\",\"view\":\"55\",\"width\":\"12\",\"category\":\"articles\",\"type\":\"grid\",\"widthCase\":\"4\",\"moreLink\":null,\"contentCase\":[\"1\",\"2\",\"3\"]}}', '2022-07-02 09:29:04', '2022-07-26 22:49:17'),
(67, 'slider', '<div class=\"section-heading\">\n<h1 style=\"text-align:center\"><span style=\"font-size:26px\"><span style=\"color:#ffffcc\"><strong>&nbsp;یادگیری نیرومندترین سلاحی است که می توان با آن جهان را دگرگون کرد</strong></span></span></h1>\n\n<h2 style=\"text-align:center\"><span style=\"color:#ffffcc\"><span style=\"font-size:18px\">فست لرن یک اسکریپت آموزش آنلاین با حداکثر امکانات می باشد که به شما امکان راه اندازی یک وب سایت آموزشی در کمترین زمان در می دهد.</span></span></h2>\n</div>\n\n<p>&nbsp;</p>\n', '2022-07-02 09:29:04', '2022-08-16 08:34:07'),
(68, 'sliderImage', 'storage/1176261.jpg', '2022-07-02 09:29:04', '2022-08-22 08:48:13'),
(69, 'sliderLink', '01313131321321', '2022-07-02 09:29:04', '2022-08-22 08:28:42'),
(70, 'aboutUsImages', 'storage/files/slider-img5.jpg,storage/files/img3.jpg,storage/files/img2.jpg,storage/files/img1.jpg', '2022-07-02 09:32:46', '2022-07-08 09:17:18'),
(71, 'aboutUs', '<div class=\"container\">\n<div class=\"row\">\n<div class=\"col-lg-6\">\n<div class=\"about-content pb-5\">\n<h3>لورم ایپسوم از دهه 1500، زمانی که یک چاپگر ناشناخته یک گالری از نوع را گرفت</h3>\n\n<p>&nbsp;</p>\n\n<p>صنعت بوده است. این نه تنها پنج قرن زنده مانده است، بلکه لورم ایپسوم متن ساختگی استاندارد صنعت از دهه 1500 بوده است، زمانی که یک چاپگر ناشناخته یک گالی از نوع را برداشت و آن را به هم زد تا یک کتاب نمونه بسازد.</p>\n\n<p>&nbsp;</p>\n\n<p>این نه تنها پنج قرن زنده مانده است، بلکه جهشی به حروفچینی الکترونیکی نیز باقی مانده است و اساساً بدون تغییر باقی مانده است. لورم ایپسوم صرفاً متن ساختگی صنعت چاپ و حروفچینی است. لورم ایپسوم ساختگی استاندارد این صنعت بوده است</p>\n\n<p>&nbsp;</p>\n\n<p>- لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده</p>\n\n<p>- لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده</p>\n\n<p>- لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده</p>\n\n<p>&nbsp;</p>\n\n<p>آیا قصد دارید اولین شغل برنامه نویسی جاوا خود را به دست آورید اما در تلاش هستید که بدانید کارفرمایان چه مهارت هایی می خواهند</p>\n\n<p>&nbsp;</p>\n\n<p>و کدام دوره به شما این مهارت ها را می دهد؟</p>\n\n<p>این دوره آموزشی به گونه ای طراحی شده است که مهارت های جاوا را برای به دست آوردن شغل به عنوان توسعه دهنده جاوا به شما بدهد. در پایان دوره، جاوا را به خوبی درک خواهید کرد و می توانید برنامه های جاوای خود را بسازید و به عنوان یک توسعه دهنده نرم افزار سازنده باشید.</p>\n</div>\n</div>\n\n<div class=\"col-lg-6\">\n<div class=\"pb-5 row\">\n<div class=\"col-lg-6 py-2 responsive-column-half\">\n<div class=\"img-box\"><img alt=\"درباره ما\" class=\"img-fluid lazy rounded-rounded\" src=\"storage/files/slider-img5.jpg\" /></div>\n</div>\n\n<div class=\"col-lg-6 py-2 responsive-column-half\">\n<div class=\"img-box\"><img alt=\"درباره ما\" class=\"img-fluid lazy rounded-rounded\" src=\"storage/files/img3.jpg\" /></div>\n</div>\n\n<div class=\"col-lg-6 py-2 responsive-column-half\">\n<div class=\"img-box\"><img alt=\"درباره ما\" class=\"img-fluid lazy rounded-rounded\" src=\"storage/files/img2.jpg\" /></div>\n</div>\n\n<div class=\"col-lg-6 py-2 responsive-column-half\">\n<div class=\"img-box\"><img alt=\"درباره ما\" class=\"img-fluid lazy rounded-rounded\" src=\"storage/files/img1.jpg\" /></div>\n</div>\n</div>\n</div>\n</div>\n</div>\n\n<p>&nbsp;</p>\n', '2022-07-02 09:32:46', '2022-07-14 13:19:56'),
(72, 'googleMap', '1', '2022-07-02 09:35:17', '2022-07-02 09:35:17'),
(73, 'contactText', '<div class=\"section-heading\">\n<h2>ما از اینکه ازت خبر داشته باشیم خوشحال میشویم</h2>\n\n<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله</p>\n</div>\n\n<p>&nbsp;</p>\n', '2022-07-02 09:35:17', '2022-07-02 09:37:13'),
(74, 'instagram', '#', '2022-07-02 09:35:17', '2022-07-02 09:35:17'),
(75, 'twitter', '#', '2022-07-02 09:35:17', '2022-07-02 09:35:17'),
(76, 'youtube', '#', '2022-07-02 09:35:17', '2022-07-02 09:35:17'),
(77, 'telegram', '#', '2022-07-02 09:35:17', '2022-07-02 09:35:17'),
(78, 'tel', '1', '2022-07-02 09:35:17', '2022-07-02 09:35:17'),
(79, 'email', 'example@gmil.com', '2022-07-02 09:35:17', '2022-07-02 09:35:17'),
(80, 'address', 'ادرس', '2022-07-02 09:35:17', '2022-07-02 09:35:17'),
(81, 'subject', '[\"\\u0645\\u0648\\u0636\\u0648\\u0639 1\",\"\\u0645\\u0648\\u0636\\u0648\\u0639 2\",\"\\u0645\\u0648\\u0636\\u0648\\u0639 3\"]', '2022-07-02 09:35:17', '2022-07-04 22:53:08'),
(82, 'question', '{\"question\":\"<p>\\u0686\\u0631\\u0627 \\u067e\\u0631\\u062f\\u0627\\u062e\\u062a \\u0645\\u0646 \\u0627\\u0646\\u062c\\u0627\\u0645 \\u0646\\u0645\\u06cc \\u0634\\u0648\\u062f\\u061f<\\/p>\\n\",\"answer\":\"<p>\\u0644\\u0648\\u0631\\u0645 \\u0627\\u06cc\\u067e\\u0633\\u0648\\u0645 \\u0645\\u062a\\u0646 \\u0633\\u0627\\u062e\\u062a\\u06af\\u06cc \\u0628\\u0627 \\u062a\\u0648\\u0644\\u06cc\\u062f \\u0633\\u0627\\u062f\\u06af\\u06cc \\u0646\\u0627\\u0645\\u0641\\u0647\\u0648\\u0645 \\u0627\\u0632 \\u0635\\u0646\\u0639\\u062a \\u0686\\u0627\\u067e \\u0648 \\u0628\\u0627 \\u0627\\u0633\\u062a\\u0641\\u0627\\u062f\\u0647 \\u0627\\u0632 \\u0637\\u0631\\u0627\\u062d\\u0627\\u0646 \\u06af\\u0631\\u0627\\u0641\\u06cc\\u06a9 \\u0627\\u0633\\u062a. \\u0686\\u0627\\u067e\\u06af\\u0631\\u0647\\u0627 \\u0648 \\u0645\\u062a\\u0648\\u0646 \\u0628\\u0644\\u06a9\\u0647 \\u0631\\u0648\\u0632\\u0646\\u0627\\u0645\\u0647 \\u0648 \\u0645\\u062c\\u0644\\u0647 \\u062f\\u0631 \\u0633\\u062a\\u0648\\u0646 \\u0648 \\u0633\\u0637\\u0631\\u0622\\u0646\\u0686\\u0646\\u0627\\u0646 \\u06a9\\u0647 \\u0644\\u0627\\u0632\\u0645 \\u0627\\u0633\\u062a \\u0648 \\u0628\\u0631\\u0627\\u06cc \\u0634\\u0631\\u0627\\u06cc\\u0637 \\u0641\\u0639\\u0644\\u06cc \\u062a\\u06a9\\u0646\\u0648\\u0644\\u0648\\u0698\\u06cc \\u0645\\u0648\\u0631\\u062f \\u0646\\u06cc\\u0627\\u0632 \\u0648 \\u06a9\\u0627\\u0631\\u0628\\u0631\\u062f\\u0647\\u0627\\u06cc \\u0645\\u062a\\u0646\\u0648\\u0639 \\u0628\\u0627 \\u0647\\u062f\\u0641 \\u0628\\u0647\\u0628\\u0648\\u062f \\u0627\\u0628\\u0632\\u0627\\u0631\\u0647\\u0627\\u06cc \\u06a9\\u0627\\u0631\\u0628\\u0631\\u062f\\u06cc \\u0645\\u06cc \\u0628\\u0627\\u0634\\u062f. \\u06a9\\u062a\\u0627\\u0628\\u0647\\u0627\\u06cc \\u0632\\u06cc\\u0627\\u062f\\u06cc \\u062f\\u0631 \\u0634\\u0635\\u062a \\u0648 \\u0633\\u0647 \\u062f\\u0631\\u0635\\u062f \\u06af\\u0630\\u0634\\u062a\\u0647\\u060c \\u062d\\u0627\\u0644 \\u0648 \\u0622\\u06cc\\u0646\\u062f\\u0647 \\u0634\\u0646\\u0627\\u062e\\u062a \\u0641\\u0631\\u0627\\u0648\\u0627\\u0646 \\u062c\\u0627\\u0645\\u0639\\u0647 \\u0648 \\u0645\\u062a\\u062e\\u0635\\u0635\\u0627\\u0646 \\u0631\\u0627 \\u0645\\u06cc \\u0637\\u0644\\u0628\\u062f<\\/p>\\n\",\"category\":\"test\",\"order\":\"1\"}', '2022-07-02 09:38:39', '2022-07-02 09:38:39'),
(83, 'question', '{\"question\":\"<p>\\u0686\\u06af\\u0648\\u0646\\u0647 \\u0645\\u06cc \\u062a\\u0648\\u0627\\u0646\\u0645 \\u0628\\u0627\\u0632\\u067e\\u0631\\u062f\\u0627\\u062e\\u062a \\u062f\\u0631\\u06cc\\u0627\\u0641\\u062a \\u06a9\\u0646\\u0645\\u061f<\\/p>\\n\",\"answer\":\"<p>\\u0644\\u0648\\u0631\\u0645 \\u0627\\u06cc\\u067e\\u0633\\u0648\\u0645 \\u0645\\u062a\\u0646 \\u0633\\u0627\\u062e\\u062a\\u06af\\u06cc \\u0628\\u0627 \\u062a\\u0648\\u0644\\u06cc\\u062f \\u0633\\u0627\\u062f\\u06af\\u06cc \\u0646\\u0627\\u0645\\u0641\\u0647\\u0648\\u0645 \\u0627\\u0632 \\u0635\\u0646\\u0639\\u062a \\u0686\\u0627\\u067e \\u0648 \\u0628\\u0627 \\u0627\\u0633\\u062a\\u0641\\u0627\\u062f\\u0647 \\u0627\\u0632 \\u0637\\u0631\\u0627\\u062d\\u0627\\u0646 \\u06af\\u0631\\u0627\\u0641\\u06cc\\u06a9 \\u0627\\u0633\\u062a. \\u0686\\u0627\\u067e\\u06af\\u0631\\u0647\\u0627 \\u0648 \\u0645\\u062a\\u0648\\u0646 \\u0628\\u0644\\u06a9\\u0647 \\u0631\\u0648\\u0632\\u0646\\u0627\\u0645\\u0647 \\u0648 \\u0645\\u062c\\u0644\\u0647 \\u062f\\u0631 \\u0633\\u062a\\u0648\\u0646 \\u0648 \\u0633\\u0637\\u0631\\u0622\\u0646\\u0686\\u0646\\u0627\\u0646 \\u06a9\\u0647 \\u0644\\u0627\\u0632\\u0645 \\u0627\\u0633\\u062a \\u0648 \\u0628\\u0631\\u0627\\u06cc \\u0634\\u0631\\u0627\\u06cc\\u0637 \\u0641\\u0639\\u0644\\u06cc \\u062a\\u06a9\\u0646\\u0648\\u0644\\u0648\\u0698\\u06cc \\u0645\\u0648\\u0631\\u062f \\u0646\\u06cc\\u0627\\u0632 \\u0648 \\u06a9\\u0627\\u0631\\u0628\\u0631\\u062f\\u0647\\u0627\\u06cc \\u0645\\u062a\\u0646\\u0648\\u0639 \\u0628\\u0627 \\u0647\\u062f\\u0641 \\u0628\\u0647\\u0628\\u0648\\u062f \\u0627\\u0628\\u0632\\u0627\\u0631\\u0647\\u0627\\u06cc \\u06a9\\u0627\\u0631\\u0628\\u0631\\u062f\\u06cc \\u0645\\u06cc \\u0628\\u0627\\u0634\\u062f. \\u06a9\\u062a\\u0627\\u0628\\u0647\\u0627\\u06cc \\u0632\\u06cc\\u0627\\u062f\\u06cc \\u062f\\u0631 \\u0634\\u0635\\u062a \\u0648 \\u0633\\u0647 \\u062f\\u0631\\u0635\\u062f \\u06af\\u0630\\u0634\\u062a\\u0647\\u060c \\u062d\\u0627\\u0644 \\u0648 \\u0622\\u06cc\\u0646\\u062f\\u0647 \\u0634\\u0646\\u0627\\u062e\\u062a \\u0641\\u0631\\u0627\\u0648\\u0627\\u0646 \\u062c\\u0627\\u0645\\u0639\\u0647 \\u0648 \\u0645\\u062a\\u062e\\u0635\\u0635\\u0627\\u0646 \\u0631\\u0627 \\u0645\\u06cc \\u0637\\u0644\\u0628\\u062f<\\/p>\\n\",\"category\":\"test\",\"order\":\"2\"}', '2022-07-02 09:39:14', '2022-07-02 09:39:14'),
(84, 'order_completed', 'سلام {order_name} دوره های شما : {order_courses}  به مبلغ {order_total_price}  تومان اوکی شد', '2022-07-06 05:34:46', '2022-07-06 05:34:46'),
(85, 'order_processing', '', '2022-07-06 05:34:46', '2022-07-06 05:34:46'),
(86, 'order_cancelled', '', '2022-07-06 05:34:46', '2022-07-06 05:34:46'),
(87, 'order_refunded', '', '2022-07-06 05:34:46', '2022-07-06 05:34:46'),
(88, 'ticket_new', '{ticket_priority} {ticket_name}', '2022-07-06 05:34:46', '2022-07-06 07:07:33'),
(89, 'ticket_answer', '1', '2022-07-06 05:34:46', '2022-07-06 06:15:44'),
(90, 'auth_login', 'ورود به ناحیه کاربری {auth_name} ', '2022-07-06 05:34:46', '2022-07-06 05:39:41'),
(91, 'auth_register', '', '2022-07-06 05:34:46', '2022-07-06 05:34:46'),
(92, 'exam_passed', '1', '2022-07-06 05:34:46', '2022-07-06 06:15:44'),
(93, 'exam_rejected', '1', '2022-07-06 05:34:46', '2022-07-06 06:15:44'),
(94, 'question', '{\"question\":\"<p>\\u0686\\u06af\\u0648\\u0646\\u0647 \\u0645\\u06cc \\u062a\\u0648\\u0627\\u0646\\u0645 \\u0628\\u0627\\u0632\\u067e\\u0631\\u062f\\u0627\\u062e\\u062a \\u062f\\u0631\\u06cc\\u0627\\u0641\\u062a \\u06a9\\u0646\\u0645\\u061f<\\/p>\\n\",\"answer\":\"<p>\\u0644\\u0648\\u0631\\u0645 \\u0627\\u06cc\\u067e\\u0633\\u0648\\u0645 \\u0645\\u062a\\u0646 \\u0633\\u0627\\u062e\\u062a\\u06af\\u06cc \\u0628\\u0627 \\u062a\\u0648\\u0644\\u06cc\\u062f \\u0633\\u0627\\u062f\\u06af\\u06cc \\u0646\\u0627\\u0645\\u0641\\u0647\\u0648\\u0645 \\u0627\\u0632 \\u0635\\u0646\\u0639\\u062a \\u0686\\u0627\\u067e \\u0648 \\u0628\\u0627 \\u0627\\u0633\\u062a\\u0641\\u0627\\u062f\\u0647 \\u0627\\u0632 \\u0637\\u0631\\u0627\\u062d\\u0627\\u0646 \\u06af\\u0631\\u0627\\u0641\\u06cc\\u06a9 \\u0627\\u0633\\u062a. \\u0686\\u0627\\u067e\\u06af\\u0631\\u0647\\u0627 \\u0648 \\u0645\\u062a\\u0648\\u0646 \\u0628\\u0644\\u06a9\\u0647 \\u0631\\u0648\\u0632\\u0646\\u0627\\u0645\\u0647 \\u0648 \\u0645\\u062c\\u0644\\u0647 \\u062f\\u0631 \\u0633\\u062a\\u0648\\u0646 \\u0648 \\u0633\\u0637\\u0631\\u0622\\u0646\\u0686\\u0646\\u0627\\u0646 \\u06a9\\u0647 \\u0644\\u0627\\u0632\\u0645 \\u0627\\u0633\\u062a \\u0648 \\u0628\\u0631\\u0627\\u06cc \\u0634\\u0631\\u0627\\u06cc\\u0637 \\u0641\\u0639\\u0644\\u06cc \\u062a\\u06a9\\u0646\\u0648\\u0644\\u0648\\u0698\\u06cc \\u0645\\u0648\\u0631\\u062f \\u0646\\u06cc\\u0627\\u0632 \\u0648 \\u06a9\\u0627\\u0631\\u0628\\u0631\\u062f\\u0647\\u0627\\u06cc \\u0645\\u062a\\u0646\\u0648\\u0639 \\u0628\\u0627 \\u0647\\u062f\\u0641 \\u0628\\u0647\\u0628\\u0648\\u062f \\u0627\\u0628\\u0632\\u0627\\u0631\\u0647\\u0627\\u06cc \\u06a9\\u0627\\u0631\\u0628\\u0631\\u062f\\u06cc \\u0645\\u06cc \\u0628\\u0627\\u0634\\u062f. \\u06a9\\u062a\\u0627\\u0628\\u0647\\u0627\\u06cc \\u0632\\u06cc\\u0627\\u062f\\u06cc \\u062f\\u0631 \\u0634\\u0635\\u062a \\u0648 \\u0633\\u0647 \\u062f\\u0631\\u0635\\u062f \\u06af\\u0630\\u0634\\u062a\\u0647\\u060c \\u062d\\u0627\\u0644 \\u0648 \\u0622\\u06cc\\u0646\\u062f\\u0647 \\u0634\\u0646\\u0627\\u062e\\u062a \\u0641\\u0631\\u0627\\u0648\\u0627\\u0646 \\u062c\\u0627\\u0645\\u0639\\u0647 \\u0648 \\u0645\\u062a\\u062e\\u0635\\u0635\\u0627\\u0646 \\u0631\\u0627 \\u0645\\u06cc \\u0637\\u0644\\u0628\\u062f<\\/p>\\n\",\"category\":\"test\",\"order\":\"2\"}', '2022-07-02 09:39:14', '2022-07-02 09:39:14'),
(95, 'question', '{\"question\":\"<p>\\u0686\\u06af\\u0648\\u0646\\u0647 \\u0645\\u06cc \\u062a\\u0648\\u0627\\u0646\\u0645 \\u0628\\u0627\\u0632\\u067e\\u0631\\u062f\\u0627\\u062e\\u062a \\u062f\\u0631\\u06cc\\u0627\\u0641\\u062a \\u06a9\\u0646\\u0645\\u061f<\\/p>\\n\",\"answer\":\"<p>\\u0644\\u0648\\u0631\\u0645 \\u0627\\u06cc\\u067e\\u0633\\u0648\\u0645 \\u0645\\u062a\\u0646 \\u0633\\u0627\\u062e\\u062a\\u06af\\u06cc \\u0628\\u0627 \\u062a\\u0648\\u0644\\u06cc\\u062f \\u0633\\u0627\\u062f\\u06af\\u06cc \\u0646\\u0627\\u0645\\u0641\\u0647\\u0648\\u0645 \\u0627\\u0632 \\u0635\\u0646\\u0639\\u062a \\u0686\\u0627\\u067e \\u0648 \\u0628\\u0627 \\u0627\\u0633\\u062a\\u0641\\u0627\\u062f\\u0647 \\u0627\\u0632 \\u0637\\u0631\\u0627\\u062d\\u0627\\u0646 \\u06af\\u0631\\u0627\\u0641\\u06cc\\u06a9 \\u0627\\u0633\\u062a. \\u0686\\u0627\\u067e\\u06af\\u0631\\u0647\\u0627 \\u0648 \\u0645\\u062a\\u0648\\u0646 \\u0628\\u0644\\u06a9\\u0647 \\u0631\\u0648\\u0632\\u0646\\u0627\\u0645\\u0647 \\u0648 \\u0645\\u062c\\u0644\\u0647 \\u062f\\u0631 \\u0633\\u062a\\u0648\\u0646 \\u0648 \\u0633\\u0637\\u0631\\u0622\\u0646\\u0686\\u0646\\u0627\\u0646 \\u06a9\\u0647 \\u0644\\u0627\\u0632\\u0645 \\u0627\\u0633\\u062a \\u0648 \\u0628\\u0631\\u0627\\u06cc \\u0634\\u0631\\u0627\\u06cc\\u0637 \\u0641\\u0639\\u0644\\u06cc \\u062a\\u06a9\\u0646\\u0648\\u0644\\u0648\\u0698\\u06cc \\u0645\\u0648\\u0631\\u062f \\u0646\\u06cc\\u0627\\u0632 \\u0648 \\u06a9\\u0627\\u0631\\u0628\\u0631\\u062f\\u0647\\u0627\\u06cc \\u0645\\u062a\\u0646\\u0648\\u0639 \\u0628\\u0627 \\u0647\\u062f\\u0641 \\u0628\\u0647\\u0628\\u0648\\u062f \\u0627\\u0628\\u0632\\u0627\\u0631\\u0647\\u0627\\u06cc \\u06a9\\u0627\\u0631\\u0628\\u0631\\u062f\\u06cc \\u0645\\u06cc \\u0628\\u0627\\u0634\\u062f. \\u06a9\\u062a\\u0627\\u0628\\u0647\\u0627\\u06cc \\u0632\\u06cc\\u0627\\u062f\\u06cc \\u062f\\u0631 \\u0634\\u0635\\u062a \\u0648 \\u0633\\u0647 \\u062f\\u0631\\u0635\\u062f \\u06af\\u0630\\u0634\\u062a\\u0647\\u060c \\u062d\\u0627\\u0644 \\u0648 \\u0622\\u06cc\\u0646\\u062f\\u0647 \\u0634\\u0646\\u0627\\u062e\\u062a \\u0641\\u0631\\u0627\\u0648\\u0627\\u0646 \\u062c\\u0627\\u0645\\u0639\\u0647 \\u0648 \\u0645\\u062a\\u062e\\u0635\\u0635\\u0627\\u0646 \\u0631\\u0627 \\u0645\\u06cc \\u0637\\u0644\\u0628\\u062f<\\/p>\\n\",\"category\":\"test\",\"order\":\"2\"}', '2022-07-02 09:39:14', '2022-07-02 09:39:14'),
(96, 'ftp_username', '1', '2022-07-11 15:05:39', '2022-07-14 13:36:49'),
(97, 'update_email', 're@gmail.com', '2022-07-15 10:33:57', '2022-07-15 10:33:57'),
(98, 'update_phone', '12345678998', '2022-07-15 10:33:57', '2022-07-15 10:33:57'),
(99, 'homeBox', '[{\"title\":\"\\u062f\\u0648\\u0631\\u0647 \\u0647\\u0627\\u06cc \\u0622\\u0641\\u0644\\u0627\\u06cc\\u0646\",\"link\":\"https:\\/\\/rezaprojects.ir\\/courses?property=offline\",\"image\":\"https:\\/\\/rezaprojects.ir\\/storage\\/small-img-3.jpg\",\"description\":\"\\u0627\\u06cc\\u062c\\u0627\\u062f \\u0634\\u062f\\u0647 \\u062a\\u0648\\u0633\\u0637 \\u06a9\\u0627\\u0631\\u0634\\u0646\\u0627\\u0633\\u0627\\u0646\\u060c \\u06a9\\u062a\\u0627\\u0628\\u0635\\u0641\\u062d\\u0647 \\u0627\\u0635\\u0644\\u06cc \\u062f\\u0648\\u0631\\u0647 \\u0627\\u0632 \\u062a\\u0645\\u0631\\u06cc\\u0646\\u0627\\u062a \\u0648 \\u062f\\u0631\\u0633 \\u0647\\u0627\\u06cc \\u0645\\u0648\\u0631\\u062f \\u0627\\u0639\\u062a\\u0645\\u0627\\u062f \\u0631\\u06cc\\u0627\\u0636\\u06cc\\u060c \\u0639\\u0644\\u0648\\u0645 \\u0648 \\u0645\\u0648\\u0627\\u0631\\u062f \\u062f\\u06cc\\u06af\\u0631 \\u0631\\u0627 \\u067e\\u0648\\u0634\\u0634 \\u0645\\u06cc \\u062f\\u0647\\u062f.\",\"width\":\"4\"},{\"title\":\"\\u062f\\u0648\\u0631\\u0647 \\u0647\\u0627\\u06cc \\u0622\\u0646\\u0644\\u0627\\u06cc\\u0646\",\"link\":\"https:\\/\\/rezaprojects.ir\\/courses?property=online\",\"image\":\"https:\\/\\/rezaprojects.ir\\/storage\\/small-img-3.jpg\",\"description\":\"\\u0627\\u06cc\\u062c\\u0627\\u062f \\u0634\\u062f\\u0647 \\u062a\\u0648\\u0633\\u0637 \\u06a9\\u0627\\u0631\\u0634\\u0646\\u0627\\u0633\\u0627\\u0646\\u060c \\u06a9\\u062a\\u0627\\u0628\\u0635\\u0641\\u062d\\u0647 \\u0627\\u0635\\u0644\\u06cc \\u062f\\u0648\\u0631\\u0647 \\u0627\\u0632 \\u062a\\u0645\\u0631\\u06cc\\u0646\\u0627\\u062a \\u0648 \\u062f\\u0631\\u0633 \\u0647\\u0627\\u06cc \\u0645\\u0648\\u0631\\u062f \\u0627\\u0639\\u062a\\u0645\\u0627\\u062f \\u0631\\u06cc\\u0627\\u0636\\u06cc\\u060c \\u0639\\u0644\\u0648\\u0645 \\u0648 \\u0645\\u0648\\u0627\\u0631\\u062f \\u062f\\u06cc\\u06af\\u0631 \\u0631\\u0627 \\u067e\\u0648\\u0634\\u0634 \\u0645\\u06cc \\u062f\\u0647\\u062f.\",\"width\":\"4\"},{\"title\":\"\\u062f\\u0648\\u0631\\u0647 \\u0647\\u0627\\u06cc \\u062d\\u0636\\u0648\\u0631\\u06cc\",\"link\":\"https:\\/\\/rezaprojects.ir\\/courses?property=in_person\",\"image\":\"https:\\/\\/rezaprojects.ir\\/storage\\/small-img-3.jpg\",\"description\":\"\\u0627\\u06cc\\u062c\\u0627\\u062f \\u0634\\u062f\\u0647 \\u062a\\u0648\\u0633\\u0637 \\u06a9\\u0627\\u0631\\u0634\\u0646\\u0627\\u0633\\u0627\\u0646\\u060c \\u06a9\\u062a\\u0627\\u0628\\u0635\\u0641\\u062d\\u0647 \\u0627\\u0635\\u0644\\u06cc \\u062f\\u0648\\u0631\\u0647 \\u0627\\u0632 \\u062a\\u0645\\u0631\\u06cc\\u0646\\u0627\\u062a \\u0648 \\u062f\\u0631\\u0633 \\u0647\\u0627\\u06cc \\u0645\\u0648\\u0631\\u062f \\u0627\\u0639\\u062a\\u0645\\u0627\\u062f \\u0631\\u06cc\\u0627\\u0636\\u06cc\\u060c \\u0639\\u0644\\u0648\\u0645 \\u0648 \\u0645\\u0648\\u0627\\u0631\\u062f \\u062f\\u06cc\\u06af\\u0631 \\u0631\\u0627 \\u067e\\u0648\\u0634\\u0634 \\u0645\\u06cc \\u062f\\u0647\\u062f.\",\"width\":\"4\"}]', '2022-07-26 22:59:28', '2022-07-26 23:53:38'),
(100, 'question', '{\"question\":\"<p>\\u062a\\u0633\\u062a<\\/p>\\n\",\"answer\":\"<p>\\u062a\\u0633\\u062a\\u062a\\u0633\\u062a\\u062a\\u0633\\u062a\\u062a\\u0633\\u062a\\u062a\\u0633\\u062a\\u062a\\u0633\\u062a\\u062a\\u0633\\u062a\\u062a\\u0633\\u062a\\u062a\\u0633\\u062a<\\/p>\\n\",\"category\":\"\\u062a\\u0633\\u062a\",\"order\":\"2\"}', '2022-08-22 08:49:13', '2022-08-22 08:49:13'),
(101, 'private_storage_file_types', '', '2022-11-16 15:48:14', '2022-11-16 15:48:14'),
(102, 'private_max_file_size', '', '2022-11-16 15:48:14', '2022-11-16 15:48:14'),
(103, 'public_storage_file_types', '', '2022-11-16 15:48:14', '2022-11-16 15:48:14'),
(104, 'public_max_file_size', '', '2022-11-16 15:48:14', '2022-11-16 15:48:14'),
(105, 'users_can_send_teacher_request', '1', '2022-11-16 15:48:14', '2022-11-16 16:01:06');

-- --------------------------------------------------------

--
-- Table structure for table `storages`
--

CREATE TABLE `storages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `config` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_file_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_types` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `folder_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `storages`
--

INSERT INTO `storages` (`id`, `name`, `driver`, `config`, `status`, `description`, `max_file_size`, `file_types`, `folder_name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'test', '1', '{\"driver\":\"local\",\"root\":\"C:\\\\xampp\\\\htdocs\\\\fast_learn\\\\storage\\\\app\\/custom_storage_63750ad8ed29b\",\"url\":\"\",\"visibility\":\"private\",\"throw\":false}', 'available', NULL, NULL, NULL, 'custom_storage_63750ad8ed29b', NULL, '2022-11-16 16:07:52', '2022-11-16 16:07:52');

-- --------------------------------------------------------

--
-- Table structure for table `storage_permissions`
--

CREATE TABLE `storage_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `storage_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `path` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `storage_permissions`
--

INSERT INTO `storage_permissions` (`id`, `storage_id`, `user_id`, `path`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '{\"0\":{\"path\":\"test\\/*\",\"access\":\"2\"},\"2\":{\"path\":\"\\/\",\"access\":\"1\"},\"3\":{\"path\":\"test\",\"access\":\"1\"}}', '2022-11-16 16:12:18', '2022-11-16 16:24:04');

-- --------------------------------------------------------

--
-- Table structure for table `taggables`
--

CREATE TABLE `taggables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `taggable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taggable_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taggables`
--

INSERT INTO `taggables` (`id`, `tag_id`, `taggable_type`, `taggable_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'App\\Models\\Course', 1, NULL, NULL),
(2, 2, 'App\\Models\\Course', 1, NULL, NULL),
(3, 4, 'App\\Models\\Course', 1, NULL, NULL),
(4, 1, 'App\\Models\\Course', 2, NULL, NULL),
(5, 3, 'App\\Models\\Course', 2, NULL, NULL),
(6, 1, 'App\\Models\\Course', 3, NULL, NULL),
(7, 5, 'App\\Models\\Course', 3, NULL, NULL),
(8, 1, 'App\\Models\\Course', 4, NULL, NULL),
(9, 3, 'App\\Models\\Course', 5, NULL, NULL),
(10, 1, 'App\\Models\\Course', 5, NULL, NULL),
(11, 1, 'App\\Models\\Course', 6, NULL, NULL),
(12, 3, 'App\\Models\\Course', 6, NULL, NULL),
(13, 6, 'App\\Models\\Article', 1, NULL, NULL),
(14, 1, 'App\\Models\\Article', 1, NULL, NULL),
(15, 1, 'App\\Models\\Article', 2, NULL, NULL),
(16, 6, 'App\\Models\\Article', 2, NULL, NULL),
(17, 6, 'App\\Models\\Article', 3, NULL, NULL),
(18, 2, 'App\\Models\\Course', 7, NULL, NULL),
(19, 1, 'App\\Models\\Course', 7, NULL, NULL),
(20, 1, 'App\\Models\\Course', 9, NULL, NULL),
(21, 1, 'App\\Models\\Course', 10, NULL, NULL),
(22, 4, 'App\\Models\\Course', 10, NULL, NULL),
(23, 4, 'App\\Models\\Course', 11, NULL, NULL),
(24, 1, 'App\\Models\\Course', 11, NULL, NULL),
(25, 1, 'App\\Models\\Course', 12, NULL, NULL),
(26, 4, 'App\\Models\\Course', 12, NULL, NULL),
(27, 1, 'App\\Models\\Course', 13, NULL, NULL),
(28, 2, 'App\\Models\\Course', 13, NULL, NULL),
(29, 3, 'App\\Models\\Course', 13, NULL, NULL),
(30, 6, 'App\\Models\\Course', 14, NULL, NULL),
(31, 6, 'App\\Models\\Course', 15, NULL, NULL),
(32, 6, 'App\\Models\\Course', 16, NULL, NULL),
(33, 4, 'App\\Models\\Article', 4, NULL, NULL),
(34, 7, 'App\\Models\\Article', 4, NULL, NULL),
(35, 3, 'App\\Models\\Article', 4, NULL, NULL),
(36, 2, 'App\\Models\\Article', 4, NULL, NULL),
(37, 6, 'App\\Models\\Article', 4, NULL, NULL),
(38, 5, 'App\\Models\\Article', 4, NULL, NULL),
(39, 1, 'App\\Models\\Article', 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'برنامه نویسی', '2022-07-02 19:38:51', '2022-07-02 19:38:51'),
(2, 'اموزش برنامه نویسی', '2022-07-02 19:39:01', '2022-07-02 19:39:01'),
(3, 'برنامه نویسی وب', '2022-07-02 19:39:07', '2022-07-02 19:39:07'),
(4, 'برنامه نویسی اندروید', '2022-07-02 19:39:21', '2022-07-02 19:39:21'),
(5, 'برنامه نویسی ویندوز', '2022-07-02 19:39:30', '2022-07-02 19:39:30'),
(6, 'گرافیک', '2022-07-02 19:39:43', '2022-07-02 19:39:43'),
(7, 'aaaaa', '2022-07-10 14:18:41', '2022-07-10 14:18:41');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `panel_status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `user_id`, `sub_title`, `body`, `panel_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'توسعه دهنده وب، طراح و مدرس', '<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد.</p><p>&nbsp;</p><p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته</p><p>&nbsp;</p>', 1, '2022-07-10 13:20:34', '2022-07-26 23:58:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_checkouts`
--

CREATE TABLE `teacher_checkouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(35,2) NOT NULL,
  `result` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_account_info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_checkouts`
--

INSERT INTO `teacher_checkouts` (`id`, `user_id`, `price`, `result`, `status`, `bank_account_info`, `created_at`, `updated_at`) VALUES
(1, 1, '75000.00', '', 'done', '{\"card_number\":\"1\",\"sheba_number\":\"1\"}', '2022-11-16 16:46:58', '2022-11-16 16:47:53');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_requests`
--

CREATE TABLE `teacher_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `descriptions` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `files` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `result` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_requests`
--

INSERT INTO `teacher_requests` (`id`, `user_id`, `descriptions`, `url`, `files`, `status`, `result`, `created_at`, `updated_at`) VALUES
(1, 1, '<p>test</p>', 'http://127.0.0.1:8000/apply', '', 'confirmed', '<p>test</p>\n', '2022-11-16 15:49:13', '2022-11-16 16:05:06'),
(2, 1, '<p>test</p>', NULL, 'applies/admin/MMql8RFZ6lIaIgT5dagofhX6ijrU5qgBL4ahP7r9.png', 'pending', '', '2022-11-16 17:30:30', '2022-11-16 17:30:30');

-- --------------------------------------------------------

--
-- Table structure for table `telescope_entries`
--

CREATE TABLE `telescope_entries` (
  `sequence` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `family_hash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `should_display_on_index` tinyint(1) NOT NULL DEFAULT 1,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `telescope_entries_tags`
--

CREATE TABLE `telescope_entries_tags` (
  `entry_uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `telescope_monitoring`
--

CREATE TABLE `telescope_monitoring` (
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `priority` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `subject`, `user_id`, `content`, `file`, `parent_id`, `sender_id`, `priority`, `status`, `sender_type`, `created_at`, `updated_at`) VALUES
(14, 'موضوع 1', 1, '<p>sadsad</p>\n', '', NULL, 1, 'normal', 'admin_sent', 'admin', '2022-07-06 15:09:30', '2022-07-06 15:09:30'),
(15, 'موضوع 2', 1, '<p>با سلام</p><p>برای شرکت در امزون مشکلی وجود دارد</p>', 'storage/tickets/zlqZ7lak3kyNidyxQCskEGs4WRYzkh5Jbpk11Ayv.jpg', NULL, 1, 'high', 'admin_sent', 'admin', '2022-07-13 17:30:20', '2022-07-13 17:32:25'),
(16, 'موضوع 1', 1, '<p>سلام مشکل در حال بررسی می باشد</p>\n', '/storage/files/bootstrap.jpg', 15, 1, 'normal', 'answered', 'admin', '2022-07-13 17:31:27', '2022-07-13 17:31:27'),
(17, 'موضوع 2', 1, '<p>sadasdasdasdasd</p>\n', '', NULL, 1, 'high', 'admin_sent', 'admin', '2022-07-13 17:42:35', '2022-07-13 17:42:35'),
(18, 'موضوع 1', 1, '<p>سلام درخواست پشتیبانی را دارم.</p>', 'storage/tickets/HE1IHXCjFu0DcDzGr8TYLYhX0tVGut2JjIfaDIEW.jpg', NULL, 1, 'normal', 'admin_sent', 'admin', '2022-07-13 21:18:20', '2022-07-20 21:18:01'),
(19, 'موضوع 1', 1, '<p>با سلام پاسخ ارسال شذ.</p>\n', '/storage/jfEqMipAUt6Pp6M67TyVUmQ1JiQiueBfcDM96VnK.pptx', 18, 1, 'normal', 'answered', 'admin', '2022-07-13 21:20:13', '2022-07-13 21:20:13'),
(20, 'موضوع 1', 1, '<p>سلام درخواست پشتیبانی را دارم.</p>', '', 18, 1, 'normal', 'answered', 'user', '2022-07-13 21:20:33', '2022-07-13 21:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payable_id` bigint(20) UNSIGNED NOT NULL,
  `wallet_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('deposit','withdraw') COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(64,0) NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `payable_type`, `payable_id`, `wallet_id`, `type`, `amount`, `confirmed`, `meta`, `uuid`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 1, 'deposit', '10000000', 1, '{\"description\":\"<p>test<\\/p>\\n\",\"from_admin\":true}', '87a6f35c-fda7-4cc5-ab5c-40a2aea12b57', '2022-07-06 05:53:50', '2022-07-06 05:53:50'),
(2, 'App\\Models\\User', 1, 1, 'withdraw', '-325000', 1, '{\"description\":\"\\u0628\\u0627\\u0628\\u062a \\u0633\\u0641\\u0627\\u0631\\u0634 KV-897885\"}', 'c7f1a32f-000f-43d6-a411-6ca1ff441199', '2022-07-06 06:01:18', '2022-07-06 06:01:18'),
(3, 'App\\Models\\User', 1, 1, 'withdraw', '-325000', 1, '{\"description\":\"\\u0628\\u0627\\u0628\\u062a \\u0633\\u0641\\u0627\\u0631\\u0634 KV-897885\"}', '2c480414-2004-4494-877c-cf5a24218dfc', '2022-07-06 06:02:40', '2022-07-06 06:02:40'),
(4, 'App\\Models\\User', 1, 1, 'withdraw', '-325000', 1, '{\"description\":\"\\u0628\\u0627\\u0628\\u062a \\u0633\\u0641\\u0627\\u0631\\u0634 KV-897885\"}', 'f7a0336e-af4c-4c87-be17-7dd7e5d69142', '2022-07-06 06:04:12', '2022-07-06 06:04:12'),
(5, 'App\\Models\\User', 1, 1, 'withdraw', '-325000', 1, '{\"description\":\"\\u0628\\u0627\\u0628\\u062a \\u0633\\u0641\\u0627\\u0631\\u0634 KV-897885\"}', 'c1fca22f-dbc6-42f1-935a-3586f3247b75', '2022-07-06 06:04:40', '2022-07-06 06:04:40'),
(6, 'App\\Models\\User', 1, 1, 'withdraw', '-325000', 1, '{\"description\":\"\\u0628\\u0627\\u0628\\u062a \\u0633\\u0641\\u0627\\u0631\\u0634 KV-897884\"}', 'fa6b1dc6-b4d3-4951-b35c-bb1d88a729a2', '2022-07-06 06:05:05', '2022-07-06 06:05:05'),
(7, 'App\\Models\\User', 1, 1, 'withdraw', '-150000', 1, '{\"description\":\"\\u0628\\u0627\\u0628\\u062a \\u0633\\u0641\\u0627\\u0631\\u0634 KV-897891\"}', '13cb8297-8fc7-4288-9a3c-3844dce0f5b8', '2022-07-13 21:33:26', '2022-07-13 21:33:26'),
(8, 'App\\Models\\User', 1, 1, 'withdraw', '-110000', 1, '{\"description\":\"\\u0628\\u0627\\u0628\\u062a \\u0633\\u0641\\u0627\\u0631\\u0634 KV-897892\"}', '7095849a-d6a4-4067-97dd-911587730fa0', '2022-07-13 22:04:23', '2022-07-13 22:04:23'),
(9, 'App\\Models\\User', 1, 1, 'withdraw', '-5000000', 1, '{\"description\":\"<p>\\u0628\\u0631\\u062f\\u0627\\u0634\\u062a<\\/p>\\n\",\"from_admin\":true}', '13eb0b98-1a34-4795-a31a-bab3584bf9d8', '2022-07-13 23:15:30', '2022-07-13 23:15:30'),
(10, 'App\\Models\\User', 3, 3, 'deposit', '1000', 1, '{\"description\":\"\\u0647\\u062f\\u06cc\\u0647 \\u062b\\u0628\\u062a \\u0646\\u0627\\u0645\",\"from_admin\":true}', '303d9db0-dca3-48e5-a3f7-f9489008efec', '2022-07-13 23:27:37', '2022-07-13 23:27:37'),
(11, 'App\\Models\\User', 4, 4, 'deposit', '1000', 1, '{\"description\":\"\\u0647\\u062f\\u06cc\\u0647 \\u062b\\u0628\\u062a \\u0646\\u0627\\u0645\",\"from_admin\":true}', 'ac143d5d-43b7-4726-92da-3a6bed07b61b', '2022-07-13 23:47:10', '2022-07-13 23:47:10'),
(12, 'App\\Models\\User', 8623, 31, 'deposit', '1000', 1, '{\"description\":\"\\u0647\\u062f\\u06cc\\u0647 \\u062b\\u0628\\u062a \\u0646\\u0627\\u0645\",\"from_admin\":true}', '66c52470-f1af-4e0b-8860-77a1f01fe856', '2022-08-16 06:39:11', '2022-08-16 06:39:11'),
(13, 'App\\Models\\User', 8623, 31, 'deposit', '200000', 1, '{\"description\":null,\"from_admin\":true}', 'e28fa33a-a61f-41a9-8664-bd04b00d0516', '2022-08-16 07:09:27', '2022-08-16 07:09:27'),
(14, 'App\\Models\\User', 8623, 31, 'withdraw', '-150000', 1, '{\"description\":\"\\u0628\\u0627\\u0628\\u062a \\u0633\\u0641\\u0627\\u0631\\u0634 FL-897908\"}', '3d58e68c-a1b5-419b-9418-727a40037355', '2022-08-16 07:09:49', '2022-08-16 07:09:49'),
(15, 'App\\Models\\User', 8624, 51, 'deposit', '1000', 1, '{\"description\":\"\\u0647\\u062f\\u06cc\\u0647 \\u062b\\u0628\\u062a \\u0646\\u0627\\u0645\",\"from_admin\":true}', '33e58ebf-3d40-4283-8312-7b2c96a74030', '2022-08-22 08:25:40', '2022-08-22 08:25:40'),
(16, 'App\\Models\\User', 8625, 52, 'deposit', '1000', 1, '{\"description\":\"\\u0647\\u062f\\u06cc\\u0647 \\u062b\\u0628\\u062a \\u0646\\u0627\\u0645\",\"from_admin\":true}', '1b438a3d-6a2c-4886-ba6e-39eab74f16ed', '2022-08-22 08:26:31', '2022-08-22 08:26:31'),
(17, 'App\\Models\\User', 8626, 53, 'deposit', '1000', 1, '{\"description\":\"\\u0647\\u062f\\u06cc\\u0647 \\u062b\\u0628\\u062a \\u0646\\u0627\\u0645\",\"from_admin\":true}', '6c9c7cf7-2ec2-4a7b-8ac7-e6664024f2b0', '2022-08-23 09:36:29', '2022-08-23 09:36:29'),
(18, 'App\\Models\\User', 1, 1, 'deposit', '10000', 1, '{\"description\":\"\\u0648\\u0627\\u0631\\u06cc\\u0632 \\u062d\\u0642 \\u0627\\u0644\\u062a\\u062f\\u0631\\u0633 \\u0628\\u0627\\u0628\\u062a \\u062f\\u0648\\u0631\\u0647 \\u0627\\u0645\\u0648\\u0632\\u0634\\u06cc \\u0627\\u0645\\u0648\\u0632\\u0634 figma   \\u0628\\u0647 \\u0645\\u0628\\u0644\\u063a 10,000 \\u062a\\u0648\\u0645\\u0627\\u0646 \",\"from_admin\":true}', '9096a8d6-0c96-488b-ac53-41e1c6514fd3', '2022-11-16 16:43:10', '2022-11-16 16:43:10'),
(19, 'App\\Models\\User', 1, 1, 'withdraw', '-75000', 1, '{\"description\":\"\\u062f\\u0631\\u062e\\u0648\\u0627\\u0633\\u062a \\u062a\\u0633\\u0648\\u06cc\\u0647 \\u062d\\u0633\\u0627\\u0628\",\"from_admin\":true}', '8e574218-2181-46ea-be34-bfa17835efac', '2022-11-16 16:46:58', '2022-11-16 16:46:58');

-- --------------------------------------------------------

--
-- Table structure for table `transcripts`
--

CREATE TABLE `transcripts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) DEFAULT NULL,
  `course_id` bigint(20) DEFAULT NULL,
  `course_data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `result` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timer` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `certificate_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transcripts`
--

INSERT INTO `transcripts` (`id`, `user_id`, `quiz_id`, `course_id`, `course_data`, `score`, `result`, `token`, `timer`, `created_at`, `updated_at`, `certificate_code`, `certificate_date`) VALUES
(1, 1, 1, 6, '{\"id\":6,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u062c\\u0627\\u0645\\u0639 nodeJS\"}', '15', 'accepted', 'eyJpdiI6IkRyajkzYlpGcW80dEYwY092QXQ4S2c9PSIsInZhbHVlIjoiU2FPM3lUZW1kcUVyWndpdTVSc0w0TU5tbkIvNjlNNHVKTDNvSmJEMVpYVTc4djZqTDFnZ0pSRWhwRGkxa2NpZCIsIm1hYyI6ImIzYTJhODVmMzUzNjFiYjg5YWQ2MmIzYTA1ODBkODNkZGI2YzYxYmNmYzA1NmM1M2E3ZWJjNDM4MThhYzliY2EiLCJ0YWciOiIifQ==', '2022-07-03 23:10:03', '2022-07-03 22:15:13', '2022-07-03 22:37:28', NULL, NULL),
(2, 1, 1, 6, '{\"id\":6,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u062c\\u0627\\u0645\\u0639 nodeJS\"}', '15', 'accepted', 'eyJpdiI6Im1jM1gwU09RNDhFTmJhck53MFFralE9PSIsInZhbHVlIjoiVHlPenMyeXdBV1BqNi9xTlNVbyt5ZFBDQldITXZpdXB4QTVoTklwK2QrSDlXZ09maHk1VUQxM2RRWmtEVEpLWSIsIm1hYyI6ImViMTQyNzM1MjA0ZTY3MDdkMDJjZGEwMjg1MDRmODg1MTZmNmNlZWJkMGMwNDQzYmQ5NzZjZjAzYzQ4MDMxZDYiLCJ0YWciOiIifQ==', '2022-07-03 23:31:27', '2022-07-03 22:56:04', '2022-07-08 17:31:34', '123', '1378/07/02'),
(3, 1, 1, 6, '{\"id\":\"6\",\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u062c\\u0627\\u0645\\u0639 nodeJS\"}', '30', 'accepted', 'eyJpdiI6IllmLzhZV2dUeUxnMTlleWdwNkI4b0E9PSIsInZhbHVlIjoicGRtaUtMVGhUZGYwc1VjQ20yZlhFUEJoa0hlMk9LTjhld0VwWDBWc1h3R0s0VVplN2hHMGgrdnFvalM1WEw4RiIsIm1hYyI6IjEwNzMyNzI0YTE2YmMzNDA0ZDE1Zjk0ZjViOWQ1OWFjNzVjMTNjODFjODYyMmZjZTIxN2RiOThhYjQwMzU3ZTkiLCJ0YWciOiIifQ==', '2022-07-10 12:11:51', '2022-07-10 11:35:54', '2022-07-10 14:08:04', '12345', '1401/04/19'),
(4, 1, 1, 5, '{\"id\":\"5\",\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u062c\\u0627\\u0645\\u0639 \\u0644\\u0627\\u0631\\u0627\\u0648\\u0644\"}', NULL, 'pending', NULL, NULL, '2022-07-10 11:42:18', '2022-07-10 11:42:18', NULL, NULL),
(5, 1, 1, 6, '{\"id\":6,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u062c\\u0627\\u0645\\u0639 nodeJS\"}', NULL, 'pending', NULL, NULL, '2022-07-13 22:53:04', '2022-07-13 22:53:04', NULL, NULL),
(6, 1, 1, 6, '{\"id\":6,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u062c\\u0627\\u0645\\u0639 nodeJS\"}', '0', 'rejected', 'eyJpdiI6ImhObWxYTDk0Z1hOVjdRcnpRV0JQT1E9PSIsInZhbHVlIjoiNnNka1BnMkRjejM4b24xSkwvVTBsTVVIVmR3bDZndHA2QlFqMTc1aFdVbmxxNys0bVVCQ1JRMWhtOUFnNlY2TyIsIm1hYyI6ImJlYzdmNDE5MzUyNzM1MjZmNDE2ZTMyZjBjZjUzN2QxMWI5ZGRmNTUwMTBlM2JmNTJmNTM0YTE0MmRiM2U0YjEiLCJ0YWciOiIifQ==', '2022-07-15 17:20:19', '2022-07-13 23:11:16', '2022-07-20 13:31:55', NULL, '۱۴۰۱/۰۳/۱۰'),
(7, 1, 1, 6, '{\"id\":6,\"title\":\"\\u0627\\u0645\\u0648\\u0632\\u0634 \\u062c\\u0627\\u0645\\u0639 nodeJS\"}', NULL, 'pending', NULL, NULL, '2022-08-16 07:00:24', '2022-08-16 07:00:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint(20) UNSIGNED NOT NULL,
  `to_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('exchange','transfer','paid','refund','gift') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'transfer',
  `status_last` enum('exchange','transfer','paid','refund','gift') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit_id` bigint(20) UNSIGNED NOT NULL,
  `withdraw_id` bigint(20) UNSIGNED NOT NULL,
  `discount` decimal(64,0) NOT NULL DEFAULT 0,
  `fee` decimal(64,0) NOT NULL DEFAULT 0,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `status`, `image`, `password`, `ip`, `otp`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'rdezhhoot@gmail.com', '1234', NULL, 'confirmed', 'storage/profiles/mpuSDulXqovUJE3a1KP1QYeprwB7KYyizrKsVAE8.jpg', '$2y$10$txRP5OJOEoXzsGJM6xZnceaZBHY5GEdJJHYsBO0W.SkYyqxh8l71C', '62d87a310cfe4', '$2y$10$V0h5ozaTDd8Yk4xVCs.TkepptV9ZsQfntauh.GyyKKWE1qEECgwGS', 'A8zcVoi11urAnALtgB9aIKozscaKGSYmn7fxEORHDL2pii1T3fsaevtfwNrO', '2022-07-01 12:37:38', '2022-11-16 15:40:27'),
(8623, 'sisi', 'sisi@sisi.sisi', '11123456789', NULL, 'not_confirmed', 'storage/profiles/1eErGZopW42IVmYVoyM0k2ply1U2UMJC4DEfSpg5.jpg', '$2y$10$kh20M4qm74bC1dvh/V24meX1aSR8WO5ZOo.xg7ZKCHLAoVbj40Lha', '86.57.12.58', '$2y$10$RFpLfcCXR2pkvX4LIQ4lie4TNAIfdRLgzUkwvVXqoBxnP3XR47.36', '3292a6SbeW932XssAZTjnBh6JusiR1HHqO661Qpwlc6wdx4ONA7AXwIbn66L', '2022-08-16 06:39:11', '2022-08-16 06:40:03'),
(8624, 'ali', 'alialialialialialialialiali@gamil.com', '96587441256', NULL, 'not_confirmed', NULL, '$2y$10$S/igC5QuQIZXUYUf/9CXgu9x2iuNFlQ6n2uJqW1pjvvHtAkQPfzDu', '86.57.3.208', '$2y$10$Z4cm1VqAdQoThIH06gBq/O1DAJIgYFJ5uQNfgumvVhxACOHIfZCQ2', NULL, '2022-08-22 08:25:40', '2022-08-22 08:25:40'),
(8625, 'aliali', 'aaa@aaa.aaa', '12345678912', NULL, 'not_confirmed', NULL, '$2y$10$i9D0sQinil5n72gBDdeLL.jA7rlNMqhFtwu3VFUSXD0J4b5Je4gQG', '86.57.3.208', '$2y$10$gDgffD6yI6nWl0R30q14Buots1zRcPGGltMyycnegZQ5KyBHV2kP.', 'm0sfnVI9ggSRCEeoL1JxaR05J0NSLD1qgjTu7vLNw1SIefVJuvnRxRgGbSji', '2022-08-22 08:26:31', '2022-08-22 08:26:45');

-- --------------------------------------------------------

--
-- Table structure for table `users_certificates`
--

CREATE TABLE `users_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `certificate_id` bigint(20) UNSIGNED NOT NULL,
  `transcript_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_certificates`
--

INSERT INTO `users_certificates` (`id`, `user_id`, `certificate_id`, `transcript_id`) VALUES
(1, 1, 1, 0),
(3, 1, 1, 2),
(4, 1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_answers`
--

CREATE TABLE `user_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transcript_id` bigint(20) UNSIGNED NOT NULL,
  `choice_id` bigint(20) DEFAULT NULL,
  `choice_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `true_choice_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score_received` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_score` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_answers`
--

INSERT INTO `user_answers` (`id`, `transcript_id`, `choice_id`, `choice_value`, `true_choice_value`, `score_received`, `question_score`, `question_text`, `question_id`) VALUES
(1, 1, 2, 'گزینه دوم', 'گزینه دوم', '15', '15', '<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.</p>\n', 1),
(2, 2, 2, 'گزینه دوم', 'گزینه دوم', '15', '15', '<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.</p>\n', 1),
(3, 3, 1, 'گزینه اول', 'گزینه اول', '15', '15', '<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باش.<img alt=\"cheeky\" src=\"https://cdn.ckeditor.com/4.13.0/full/plugins/smiley/images/tongue_smile.png\" style=\"height:23px; width:23px\" title=\"cheeky\" /></p>\n', 1),
(4, 3, 12, 'گزینه سوم', 'گزینه اول', '0', '20', '<h3><u><strong>متن سوال دوم</strong></u></h3>\n', 4),
(6, 6, 11, 'گزینه دوم', 'گزینه اول', '0', '20', '<h3><u><strong>متن سوال دوم</strong></u></h3>\n', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `code_id` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `code_id`, `father_name`, `birthday`, `province`, `city`, `created_at`, `updated_at`) VALUES
(3, 1, NULL, NULL, NULL, NULL, NULL, '2022-07-10 12:05:12', '2022-07-10 12:05:12');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `holder_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `holder_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `balance` decimal(64,0) NOT NULL DEFAULT 0,
  `decimal_places` smallint(5) UNSIGNED NOT NULL DEFAULT 2,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `holder_type`, `holder_id`, `name`, `slug`, `uuid`, `description`, `meta`, `balance`, `decimal_places`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'Default Wallet', 'default', '41023a78-28ff-4906-bb75-30b575a96e31', NULL, '[]', '3050000', 2, '2022-07-01 13:10:35', '2022-11-16 16:46:58'),
(2, 'App\\Models\\User', 2, 'Default Wallet', 'default', 'a8a2d21a-215c-44a2-b23f-92f2b60477b1', NULL, '[]', '0', 2, '2022-07-03 22:58:00', '2022-07-03 22:58:00'),
(3, 'App\\Models\\User', 3, 'Default Wallet', 'default', 'f5903ea3-dd8e-4ddd-a638-2a49d19289eb', NULL, '[]', '1000', 2, '2022-07-13 23:27:37', '2022-07-13 23:27:37'),
(4, 'App\\Models\\User', 4, 'Default Wallet', 'default', 'a7da5707-50b9-4c74-bb9e-b4af83acf631', NULL, '[]', '1000', 2, '2022-07-13 23:47:10', '2022-07-13 23:47:10'),
(5, 'App\\Models\\User', 6, 'Default Wallet', 'default', 'fb8cd76c-38b8-4d6e-874f-051fe9d72dfc', NULL, '[]', '0', 2, '2022-07-14 00:15:32', '2022-07-14 00:15:32'),
(6, 'App\\Models\\User', 5, 'Default Wallet', 'default', '0dc703f0-db4b-4811-80e6-2acb79a1efd1', NULL, '[]', '0', 2, '2022-07-14 00:15:32', '2022-07-14 00:15:32'),
(7, 'App\\Models\\User', 8622, 'Default Wallet', 'default', '3ccda4a9-e5ad-437f-858a-38598fb02661', NULL, '[]', '0', 2, '2022-07-27 02:03:15', '2022-07-27 02:03:15'),
(8, 'App\\Models\\User', 8621, 'Default Wallet', 'default', '481130cd-924d-4864-ab58-9916571e6c78', NULL, '[]', '0', 2, '2022-07-27 02:03:15', '2022-07-27 02:03:15'),
(9, 'App\\Models\\User', 8620, 'Default Wallet', 'default', 'a19bba75-9dc0-4ba2-b920-35f459296189', NULL, '[]', '0', 2, '2022-07-27 02:03:15', '2022-07-27 02:03:15'),
(10, 'App\\Models\\User', 8619, 'Default Wallet', 'default', '1485234d-ac0e-4e41-9f80-c012ffd826be', NULL, '[]', '0', 2, '2022-07-27 02:03:15', '2022-07-27 02:03:15'),
(11, 'App\\Models\\User', 8618, 'Default Wallet', 'default', '7da8c19a-0689-4b55-b497-957cc571afd9', NULL, '[]', '0', 2, '2022-07-27 02:03:15', '2022-07-27 02:03:15'),
(12, 'App\\Models\\User', 8617, 'Default Wallet', 'default', '80015182-2aed-437b-acf0-f26189163ecf', NULL, '[]', '0', 2, '2022-07-27 02:03:15', '2022-07-27 02:03:15'),
(13, 'App\\Models\\User', 8616, 'Default Wallet', 'default', '0ed8639b-05b1-4404-bba4-fa940597af4f', NULL, '[]', '0', 2, '2022-07-27 02:03:15', '2022-07-27 02:03:15'),
(14, 'App\\Models\\User', 8615, 'Default Wallet', 'default', 'c2617921-91c0-479c-aca4-43ead60fbd58', NULL, '[]', '0', 2, '2022-07-27 02:03:15', '2022-07-27 02:03:15'),
(15, 'App\\Models\\User', 8614, 'Default Wallet', 'default', 'df8cbd77-b63f-448f-8bb9-99f4d8c1c688', NULL, '[]', '0', 2, '2022-07-27 02:03:15', '2022-07-27 02:03:15'),
(16, 'App\\Models\\User', 8613, 'Default Wallet', 'default', 'eaf0b085-2d8c-4c74-9c4e-118fc734a222', NULL, '[]', '0', 2, '2022-07-27 02:03:15', '2022-07-27 02:03:15'),
(17, 'App\\Models\\User', 10, 'Default Wallet', 'default', '596e75cc-133a-4738-a5fb-4b37a0a0eb5a', NULL, '[]', '0', 2, '2022-07-27 03:14:49', '2022-07-27 03:14:49'),
(18, 'App\\Models\\User', 9, 'Default Wallet', 'default', '61ebe1fb-9d18-464e-8fee-287635943ed0', NULL, '[]', '0', 2, '2022-07-27 03:14:49', '2022-07-27 03:14:49'),
(19, 'App\\Models\\User', 8, 'Default Wallet', 'default', '1f949431-f0fc-4634-ba1e-caa9bb5a95c3', NULL, '[]', '0', 2, '2022-07-27 03:14:49', '2022-07-27 03:14:49'),
(20, 'App\\Models\\User', 7, 'Default Wallet', 'default', 'c9b3f3ea-4c9b-4f37-bd1b-2ae88bc26110', NULL, '[]', '0', 2, '2022-07-27 03:14:49', '2022-07-27 03:14:49'),
(21, 'App\\Models\\User', 20, 'Default Wallet', 'default', '90b3e8c6-2277-4ef5-9399-ffe076e5586a', NULL, '[]', '0', 2, '2022-07-27 03:14:53', '2022-07-27 03:14:53'),
(22, 'App\\Models\\User', 19, 'Default Wallet', 'default', 'e011eb4d-fb06-4155-a2f7-669a4dc6a8c4', NULL, '[]', '0', 2, '2022-07-27 03:14:53', '2022-07-27 03:14:53'),
(23, 'App\\Models\\User', 18, 'Default Wallet', 'default', 'e67142b3-dd0c-4d4f-8612-60a0ec305ccb', NULL, '[]', '0', 2, '2022-07-27 03:14:53', '2022-07-27 03:14:53'),
(24, 'App\\Models\\User', 17, 'Default Wallet', 'default', 'e345b436-fcd1-4115-b4ce-869e916a96fa', NULL, '[]', '0', 2, '2022-07-27 03:14:53', '2022-07-27 03:14:53'),
(25, 'App\\Models\\User', 16, 'Default Wallet', 'default', '8ac30a30-b3a2-4914-9391-1ce4018860b6', NULL, '[]', '0', 2, '2022-07-27 03:14:53', '2022-07-27 03:14:53'),
(26, 'App\\Models\\User', 15, 'Default Wallet', 'default', 'dc6a260f-19cc-48cb-989b-65e495d4f18a', NULL, '[]', '0', 2, '2022-07-27 03:14:53', '2022-07-27 03:14:53'),
(27, 'App\\Models\\User', 14, 'Default Wallet', 'default', '467797a7-c060-4936-9549-16625ac2ae75', NULL, '[]', '0', 2, '2022-07-27 03:14:53', '2022-07-27 03:14:53'),
(28, 'App\\Models\\User', 13, 'Default Wallet', 'default', 'bdeba7fb-b793-41de-b5c7-dd920647e634', NULL, '[]', '0', 2, '2022-07-27 03:14:53', '2022-07-27 03:14:53'),
(29, 'App\\Models\\User', 12, 'Default Wallet', 'default', '12ff3b7a-c9a2-4410-9a96-0f835e9905c5', NULL, '[]', '0', 2, '2022-07-27 03:14:53', '2022-07-27 03:14:53'),
(30, 'App\\Models\\User', 11, 'Default Wallet', 'default', '2a1c7dcb-14f5-4b5a-ad93-30e3e8fdb1e6', NULL, '[]', '0', 2, '2022-07-27 03:14:53', '2022-07-27 03:14:53'),
(31, 'App\\Models\\User', 8623, 'Default Wallet', 'default', 'a1771c48-9ae0-46c5-b169-23674dc79bb5', NULL, '[]', '51000', 2, '2022-08-16 06:39:11', '2022-08-16 07:09:49'),
(32, 'App\\Models\\User', 8196, 'Default Wallet', 'default', '91564950-bec9-427b-b9a7-957cb5f767e2', NULL, '[]', '0', 2, '2022-08-16 06:54:52', '2022-08-16 06:54:52'),
(33, 'App\\Models\\User', 8195, 'Default Wallet', 'default', 'ac0b3f17-c99a-4615-ba70-73261633f245', NULL, '[]', '0', 2, '2022-08-16 06:54:52', '2022-08-16 06:54:52'),
(34, 'App\\Models\\User', 8139, 'Default Wallet', 'default', '87aad316-2b85-47b6-9f5e-7f88275f96d8', NULL, '[]', '0', 2, '2022-08-16 06:54:52', '2022-08-16 06:54:52'),
(35, 'App\\Models\\User', 7924, 'Default Wallet', 'default', '5d3f3a53-334b-4e8f-9b82-e0b5029b77e5', NULL, '[]', '0', 2, '2022-08-16 06:54:52', '2022-08-16 06:54:52'),
(36, 'App\\Models\\User', 7797, 'Default Wallet', 'default', '3c834f16-45db-4afa-ab46-cdf97f194bc8', NULL, '[]', '0', 2, '2022-08-16 06:54:52', '2022-08-16 06:54:52'),
(37, 'App\\Models\\User', 7480, 'Default Wallet', 'default', '6c98dd81-37c4-4001-bdb2-21f7b5727113', NULL, '[]', '0', 2, '2022-08-16 06:54:52', '2022-08-16 06:54:52'),
(38, 'App\\Models\\User', 7410, 'Default Wallet', 'default', 'd34a0d5f-0cb8-4cc0-a809-db69d0afd886', NULL, '[]', '0', 2, '2022-08-16 06:54:52', '2022-08-16 06:54:52'),
(39, 'App\\Models\\User', 7395, 'Default Wallet', 'default', 'df54ab07-f676-4a1c-8acc-19272b208c26', NULL, '[]', '0', 2, '2022-08-16 06:54:52', '2022-08-16 06:54:52'),
(40, 'App\\Models\\User', 7387, 'Default Wallet', 'default', '55b97152-0542-43f2-b380-10ab08e83ed7', NULL, '[]', '0', 2, '2022-08-16 06:54:52', '2022-08-16 06:54:52'),
(41, 'App\\Models\\User', 7354, 'Default Wallet', 'default', '0c273eb2-268f-4113-9f7c-ab5909eb9a14', NULL, '[]', '0', 2, '2022-08-16 06:54:52', '2022-08-16 06:54:52'),
(42, 'App\\Models\\User', 8595, 'Default Wallet', 'default', '0376a42b-05e2-4719-8b9a-3e801e33940c', NULL, '[]', '0', 2, '2022-08-16 06:54:56', '2022-08-16 06:54:56'),
(43, 'App\\Models\\User', 7987, 'Default Wallet', 'default', '14ed2075-ca7b-4d6a-ae2a-1b2fb4f6e92e', NULL, '[]', '0', 2, '2022-08-16 06:54:56', '2022-08-16 06:54:56'),
(44, 'App\\Models\\User', 7742, 'Default Wallet', 'default', '74865b15-54d5-48e3-a740-b495c1f516c3', NULL, '[]', '0', 2, '2022-08-16 06:54:56', '2022-08-16 06:54:56'),
(45, 'App\\Models\\User', 7554, 'Default Wallet', 'default', 'eb6f7dce-66f7-43c2-87e6-c31c1e882722', NULL, '[]', '0', 2, '2022-08-16 06:54:56', '2022-08-16 06:54:56'),
(46, 'App\\Models\\User', 7144, 'Default Wallet', 'default', '4284a20e-6d8c-4873-9273-a08f3e0963a0', NULL, '[]', '0', 2, '2022-08-16 06:54:56', '2022-08-16 06:54:56'),
(47, 'App\\Models\\User', 7139, 'Default Wallet', 'default', 'bc84b7ba-3886-4e5f-8cbe-65649cc7b211', NULL, '[]', '0', 2, '2022-08-16 06:54:56', '2022-08-16 06:54:56'),
(48, 'App\\Models\\User', 6882, 'Default Wallet', 'default', '7e6238e5-c57c-4b9e-abfe-80024a48a222', NULL, '[]', '0', 2, '2022-08-16 06:54:56', '2022-08-16 06:54:56'),
(49, 'App\\Models\\User', 6873, 'Default Wallet', 'default', 'a9b8a098-237d-49fa-b890-7432863b333e', NULL, '[]', '0', 2, '2022-08-16 06:54:56', '2022-08-16 06:54:56'),
(50, 'App\\Models\\User', 6784, 'Default Wallet', 'default', '83eeb2a9-2bbf-47ae-8197-334b388697b6', NULL, '[]', '0', 2, '2022-08-16 06:54:56', '2022-08-16 06:54:56'),
(51, 'App\\Models\\User', 8624, 'Default Wallet', 'default', '1ad61cb7-7c57-4342-91e7-8c58fa8cf7f1', NULL, '[]', '1000', 2, '2022-08-22 08:25:40', '2022-08-22 08:25:40'),
(52, 'App\\Models\\User', 8625, 'Default Wallet', 'default', '931760ee-69ef-4f1c-ad57-17107bacff89', NULL, '[]', '1000', 2, '2022-08-22 08:26:31', '2022-08-22 08:26:31'),
(53, 'App\\Models\\User', 8626, 'Default Wallet', 'default', 'eb288200-19a1-46b6-baba-270b907a04da', NULL, '[]', '1000', 2, '2022-08-23 09:36:29', '2022-08-23 09:36:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `articles_slug_unique` (`slug`),
  ADD KEY `articles_user_id_foreign` (`user_id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_accounts_user_id_foreign` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `choices`
--
ALTER TABLE `choices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `choices_question_id_foreign` (`question_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `classes_name_unique` (`name`),
  ADD KEY `classes_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `class_accesses`
--
ALTER TABLE `class_accesses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_accesses_class_id_foreign` (`class_id`),
  ADD KEY `class_accesses_course_id_foreign` (`course_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_commentable_type_commentable_id_index` (`commentable_type`,`commentable_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courses_slug_unique` (`slug`),
  ADD KEY `courses_incoming_method_id_index` (`incoming_method_id`);

--
-- Indexes for table `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `episodes_course_id_foreign` (`course_id`);

--
-- Indexes for table `episode_transcripts`
--
ALTER TABLE `episode_transcripts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `episode_transcripts_course_id_foreign` (`course_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `homeworks`
--
ALTER TABLE `homeworks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `homeworks_user_id_foreign` (`user_id`),
  ADD KEY `homeworks_episode_id_foreign` (`episode_id`);

--
-- Indexes for table `incoming_methods`
--
ALTER TABLE `incoming_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `last_activities`
--
ALTER TABLE `last_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `last_activities_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `new_course_chats`
--
ALTER TABLE `new_course_chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `new_course_chats_new_course_request_id_foreign` (`new_course_request_id`),
  ADD KEY `new_course_chats_user_id_foreign` (`user_id`);

--
-- Indexes for table `new_course_requests`
--
ALTER TABLE `new_course_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `new_course_requests_user_id_foreign` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_notes`
--
ALTER TABLE `order_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_notes_order_id_index` (`order_id`),
  ADD KEY `order_notes_user_id_index` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payments_payment_token_unique` (`payment_token`),
  ADD UNIQUE KEY `payments_payment_ref_unique` (`payment_ref`),
  ADD KEY `payments_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `quizzes_name_unique` (`name`);

--
-- Indexes for table `quizzes_has_questions`
--
ALTER TABLE `quizzes_has_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quizzes_has_questions_quiz_id_foreign` (`quiz_id`),
  ADD KEY `quizzes_has_questions_question_id_foreign` (`question_id`);

--
-- Indexes for table `reductions`
--
ALTER TABLE `reductions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reductions_code_unique` (`code`);

--
-- Indexes for table `reduction_metas`
--
ALTER TABLE `reduction_metas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reduction_metas_reduction_id_foreign` (`reduction_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `samples`
--
ALTER TABLE `samples`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `samples_slug_unique` (`slug`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storages`
--
ALTER TABLE `storages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `storages_name_unique` (`name`),
  ADD UNIQUE KEY `storages_folder_name_unique` (`folder_name`);

--
-- Indexes for table `storage_permissions`
--
ALTER TABLE `storage_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `storage_permissions_storage_id_foreign` (`storage_id`),
  ADD KEY `storage_permissions_user_id_foreign` (`user_id`);

--
-- Indexes for table `taggables`
--
ALTER TABLE `taggables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taggables_tag_id_foreign` (`tag_id`),
  ADD KEY `taggables_taggable_type_taggable_id_index` (`taggable_type`,`taggable_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_name_unique` (`name`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teachers_user_id_unique` (`user_id`);

--
-- Indexes for table `teacher_checkouts`
--
ALTER TABLE `teacher_checkouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_checkouts_user_id_foreign` (`user_id`);

--
-- Indexes for table `teacher_requests`
--
ALTER TABLE `teacher_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_requests_user_id_foreign` (`user_id`);

--
-- Indexes for table `telescope_entries`
--
ALTER TABLE `telescope_entries`
  ADD PRIMARY KEY (`sequence`),
  ADD UNIQUE KEY `telescope_entries_uuid_unique` (`uuid`),
  ADD KEY `telescope_entries_batch_id_index` (`batch_id`),
  ADD KEY `telescope_entries_family_hash_index` (`family_hash`),
  ADD KEY `telescope_entries_created_at_index` (`created_at`),
  ADD KEY `telescope_entries_type_should_display_on_index_index` (`type`,`should_display_on_index`);

--
-- Indexes for table `telescope_entries_tags`
--
ALTER TABLE `telescope_entries_tags`
  ADD KEY `telescope_entries_tags_entry_uuid_tag_index` (`entry_uuid`,`tag`),
  ADD KEY `telescope_entries_tags_tag_index` (`tag`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_user_id_foreign` (`user_id`),
  ADD KEY `tickets_parent_id_foreign` (`parent_id`),
  ADD KEY `tickets_sender_id_foreign` (`sender_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_uuid_unique` (`uuid`),
  ADD KEY `transactions_payable_type_payable_id_index` (`payable_type`,`payable_id`),
  ADD KEY `payable_type_payable_id_ind` (`payable_type`,`payable_id`),
  ADD KEY `payable_type_ind` (`payable_type`,`payable_id`,`type`),
  ADD KEY `payable_confirmed_ind` (`payable_type`,`payable_id`,`confirmed`),
  ADD KEY `payable_type_confirmed_ind` (`payable_type`,`payable_id`,`type`,`confirmed`),
  ADD KEY `transactions_type_index` (`type`),
  ADD KEY `transactions_wallet_id_foreign` (`wallet_id`);

--
-- Indexes for table `transcripts`
--
ALTER TABLE `transcripts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transcripts_certificate_code_unique` (`certificate_code`),
  ADD KEY `transcripts_user_id_foreign` (`user_id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transfers_uuid_unique` (`uuid`),
  ADD KEY `transfers_from_type_from_id_index` (`from_type`,`from_id`),
  ADD KEY `transfers_to_type_to_id_index` (`to_type`,`to_id`),
  ADD KEY `transfers_deposit_id_foreign` (`deposit_id`),
  ADD KEY `transfers_withdraw_id_foreign` (`withdraw_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `users_certificates`
--
ALTER TABLE `users_certificates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_certificates_user_id_foreign` (`user_id`),
  ADD KEY `users_certificates_certificate_id_foreign` (`certificate_id`);

--
-- Indexes for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_answers_transcript_id_foreign` (`transcript_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_details_user_id_unique` (`user_id`),
  ADD UNIQUE KEY `user_details_code_id_unique` (`code_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wallets_holder_type_holder_id_slug_unique` (`holder_type`,`holder_id`,`slug`),
  ADD UNIQUE KEY `wallets_uuid_unique` (`uuid`),
  ADD KEY `wallets_holder_type_holder_id_index` (`holder_type`,`holder_id`),
  ADD KEY `wallets_slug_index` (`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `choices`
--
ALTER TABLE `choices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class_accesses`
--
ALTER TABLE `class_accesses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `episode_transcripts`
--
ALTER TABLE `episode_transcripts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homeworks`
--
ALTER TABLE `homeworks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `incoming_methods`
--
ALTER TABLE `incoming_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `last_activities`
--
ALTER TABLE `last_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `new_course_chats`
--
ALTER TABLE `new_course_chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `new_course_requests`
--
ALTER TABLE `new_course_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `order_notes`
--
ALTER TABLE `order_notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quizzes_has_questions`
--
ALTER TABLE `quizzes_has_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reductions`
--
ALTER TABLE `reductions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reduction_metas`
--
ALTER TABLE `reduction_metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `samples`
--
ALTER TABLE `samples`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `storages`
--
ALTER TABLE `storages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `storage_permissions`
--
ALTER TABLE `storage_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `taggables`
--
ALTER TABLE `taggables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `teacher_checkouts`
--
ALTER TABLE `teacher_checkouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacher_requests`
--
ALTER TABLE `teacher_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `telescope_entries`
--
ALTER TABLE `telescope_entries`
  MODIFY `sequence` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `transcripts`
--
ALTER TABLE `transcripts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8627;

--
-- AUTO_INCREMENT for table `users_certificates`
--
ALTER TABLE `users_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD CONSTRAINT `bank_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `choices`
--
ALTER TABLE `choices`
  ADD CONSTRAINT `choices_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `class_accesses`
--
ALTER TABLE `class_accesses`
  ADD CONSTRAINT `class_accesses_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_accesses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `episodes`
--
ALTER TABLE `episodes`
  ADD CONSTRAINT `episodes_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `episode_transcripts`
--
ALTER TABLE `episode_transcripts`
  ADD CONSTRAINT `episode_transcripts_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `homeworks`
--
ALTER TABLE `homeworks`
  ADD CONSTRAINT `homeworks_episode_id_foreign` FOREIGN KEY (`episode_id`) REFERENCES `episodes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `homeworks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `last_activities`
--
ALTER TABLE `last_activities`
  ADD CONSTRAINT `last_activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `new_course_chats`
--
ALTER TABLE `new_course_chats`
  ADD CONSTRAINT `new_course_chats_new_course_request_id_foreign` FOREIGN KEY (`new_course_request_id`) REFERENCES `new_course_requests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `new_course_chats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `new_course_requests`
--
ALTER TABLE `new_course_requests`
  ADD CONSTRAINT `new_course_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_notes`
--
ALTER TABLE `order_notes`
  ADD CONSTRAINT `order_notes_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `quizzes_has_questions`
--
ALTER TABLE `quizzes_has_questions`
  ADD CONSTRAINT `quizzes_has_questions_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quizzes_has_questions_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reduction_metas`
--
ALTER TABLE `reduction_metas`
  ADD CONSTRAINT `reduction_metas_reduction_id_foreign` FOREIGN KEY (`reduction_id`) REFERENCES `reductions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `storage_permissions`
--
ALTER TABLE `storage_permissions`
  ADD CONSTRAINT `storage_permissions_storage_id_foreign` FOREIGN KEY (`storage_id`) REFERENCES `storages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `storage_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `taggables`
--
ALTER TABLE `taggables`
  ADD CONSTRAINT `taggables_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teacher_checkouts`
--
ALTER TABLE `teacher_checkouts`
  ADD CONSTRAINT `teacher_checkouts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teacher_requests`
--
ALTER TABLE `teacher_requests`
  ADD CONSTRAINT `teacher_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `telescope_entries_tags`
--
ALTER TABLE `telescope_entries_tags`
  ADD CONSTRAINT `telescope_entries_tags_entry_uuid_foreign` FOREIGN KEY (`entry_uuid`) REFERENCES `telescope_entries` (`uuid`) ON DELETE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transcripts`
--
ALTER TABLE `transcripts`
  ADD CONSTRAINT `transcripts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transfers`
--
ALTER TABLE `transfers`
  ADD CONSTRAINT `transfers_deposit_id_foreign` FOREIGN KEY (`deposit_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transfers_withdraw_id_foreign` FOREIGN KEY (`withdraw_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_certificates`
--
ALTER TABLE `users_certificates`
  ADD CONSTRAINT `users_certificates_certificate_id_foreign` FOREIGN KEY (`certificate_id`) REFERENCES `certificates` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_certificates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD CONSTRAINT `user_answers_transcript_id_foreign` FOREIGN KEY (`transcript_id`) REFERENCES `transcripts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
