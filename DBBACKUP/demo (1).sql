-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2021 at 04:01 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `like` int(11) DEFAULT NULL,
  `album_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `album_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `name`, `user_id`, `like`, `album_image`, `album_date`, `created_at`, `updated_at`) VALUES
(1, 'car', 1, 2, 'bmw01.png,bmw02.png,bmw03.jpg,bmw04.png', '2021-02-03', NULL, '2021-02-10 02:15:15'),
(2, 'new car', 1, 2, 'l01.png,l02.png,l03.png', '2021-02-01', NULL, '2021-02-10 02:20:47'),
(3, 'audi', 1, 1, 'audi01.png,audi02.png,audi03.png', '2021-01-05', NULL, '2021-02-10 02:37:01'),
(6, 'bmw', 2, 1, 'bmw01.png,bmw03.jpg,bmw04.png', '2021-02-03', NULL, '2021-02-10 02:36:59'),
(7, 'car', 2, NULL, 'bmw01.png,bmw04.png,bmwicon.png', '2020-02-04', NULL, NULL),
(8, 'logo', 2, NULL, 'audi.png,avengers.png,bmwcar.png,chevrolet.png', '2020-06-23', NULL, NULL),
(9, 'Natural', 2, 1, 'n1.jpg,n2.jpg,n3.jpg,n4.jpg,n5.jpg', '2020-06-25', NULL, '2021-02-10 06:00:44'),
(10, 'parrot', 3, 1, 'parrot1.png,parrot2.jpg,parrot3.jpg,parrot5.jpg', '2020-09-08', NULL, '2021-02-10 03:25:26'),
(12, 'Birds', 3, 2, 'b1.jpg,b2.jpg,bir3.jpg,bir4.jpg,bir5.jpg', '2020-11-11', NULL, '2021-02-10 20:45:38'),
(13, 'Animals', 3, 2, 'a1.jpg,a2.gif,a3.jpg,a4.jpg,a5.jpg', '2020-09-25', NULL, '2021-02-10 20:45:33');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `album_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `album_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2021-02-10 02:12:57', '2021-02-10 02:12:57'),
(2, 1, 2, '2021-02-10 02:14:01', '2021-02-10 02:14:01'),
(3, 2, 1, '2021-02-10 02:15:14', '2021-02-10 02:15:14'),
(4, 2, 2, '2021-02-10 02:20:47', '2021-02-10 02:20:47'),
(5, 2, 6, '2021-02-10 02:36:59', '2021-02-10 02:36:59'),
(6, 2, 3, '2021-02-10 02:37:01', '2021-02-10 02:37:01'),
(7, 3, 10, '2021-02-10 03:25:26', '2021-02-10 03:25:26'),
(8, 3, 9, '2021-02-10 06:00:44', '2021-02-10 06:00:44'),
(9, 3, 11, '2021-02-10 06:00:51', '2021-02-10 06:00:51'),
(10, 3, 12, '2021-02-10 09:58:12', '2021-02-10 09:58:12'),
(11, 3, 13, '2021-02-10 09:58:15', '2021-02-10 09:58:15'),
(12, 7, 14, '2021-02-10 20:45:30', '2021-02-10 20:45:30'),
(13, 7, 13, '2021-02-10 20:45:33', '2021-02-10 20:45:33'),
(14, 7, 12, '2021-02-10 20:45:38', '2021-02-10 20:45:38');

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
(2, '2021_01_21_075848_create_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `profile_image`, `created_at`, `updated_at`) VALUES
(1, 'jay', 'nakum', 'jay@gmail.com', '$2y$10$dt3MLafVJTiTZauwqzILDu2cXLWXyPlVfohm78.VenfJfkIvn5JnO', NULL, '2021-02-10 01:47:43', '2021-02-10 01:47:43'),
(2, 'vishal', 'patel', 'vishal@gmail.com', '$2y$10$FjWtmaG97it4ssWDzMbhFevio.4aJANXLZB6n4ivo/pyPNwVPuZsq', NULL, '2021-02-10 02:14:57', '2021-02-10 02:14:57'),
(3, 'vijay', 'patel', 'vijay@gmail.com', '$2y$10$7cuN5W7sWI1kv/v6qFLtde6.hfeC3ZCbTj5srJHi.BsMsDfYXYYMi', NULL, '2021-02-10 03:22:17', '2021-02-10 03:22:17'),
(4, 'HIren', 'Parmar', 'hiren@gmail.com', '$2y$10$wU9GHo144WvjgXPHQvj4YO1dyEBa/p8DRYzsAzaavAam7DxJ/mpMi', 'b2.jpg', '2021-02-10 11:15:34', '2021-02-10 11:15:34'),
(5, 'kavya', 'niin', 'kavya@gmail.com', '$2y$10$PTAvMaQ.tLAIvPhIfmVwHempnil1Ql.mI8ou5iVJcuiX7lQ1MAGXW', 'bir5.jpg', '2021-02-10 11:18:55', '2021-02-10 11:18:55'),
(6, 'Chirag', 'Kanzaria', 'chirag@gmail.com', '$2y$10$kbgItq6FiPK2kKIfDyFWdO480TijWEOZACcSF0qo9c9dXsWy8.v06', 'n1.jpg', '2021-02-10 11:21:47', '2021-02-10 11:21:47'),
(7, 'ketan', 'jain', 'ketan@gmail.com', '$2y$10$GAK8eBaj/Pa2jhqTPUL59uwtN2esgFj93Ozvangt/PtjztMNY1MfS', 'n4.jpg', '2021-02-10 20:43:36', '2021-02-10 20:43:36'),
(8, 'testing', 'test', 'test894@gmail.com', '$2y$10$Zsz4lWGEGw9n3w5wUOIg9.wsxxDjgKs3erKLm4ZDYS.V2C8OwTMXS', NULL, '2021-02-10 21:04:37', '2021-02-10 21:04:37'),
(9, 'test', 'test', 'test652@gmail.com', '$2y$10$YAy4HkgRICvZC0o3CkVxQua3jGE45ijYfTenLL/WTomBMbkyt.7km', NULL, '2021-02-10 21:06:25', '2021-02-10 21:06:25'),
(10, 'test', 'test', 'test966@gmail.com', '$2y$10$ILKRLMwkKap9I7A/8jHLzu/o1vetdz4FaKXlVbkuuQ/DdyG6Zh1vq', NULL, '2021-02-10 21:07:56', '2021-02-10 21:07:56'),
(11, 'testing', 'testing', 'testing3@gmail.com', '$2y$10$Jd1BQYPPvfipiZeH/x/QCug2//t02R/lTBCe3Ly5JXnGoiUsbvjqu', NULL, '2021-02-10 21:11:57', '2021-02-10 21:11:57'),
(12, 'hiya', 'chopda', 'hiya@gmail.com', '$2y$10$VKzf1xaw5qQ3at/pPRa6AeXIpY3wNQfXeiIuGz7C/n/omiZKWeE9i', NULL, '2021-02-10 21:16:52', '2021-02-10 21:16:52'),
(13, 'jay', 'kee', 'jay55@gmail.com', '$2y$10$1h7b33TUorhysi1S47ZbqOhncO/pwFxhRtKUc91sZt9zYt.I55YqK', NULL, '2021-02-10 21:22:22', '2021-02-10 21:22:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
