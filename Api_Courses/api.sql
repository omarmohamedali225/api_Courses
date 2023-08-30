-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 18, 2023 at 06:50 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `4365800_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `img` varchar(500) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `states` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `img`, `title`, `price`, `discount`, `owner`, `states`, `type`, `code`) VALUES
(1, 'programming.jpg', 'دبلومة تطوير الويب بشكل احترافي من الصفر', '1800', '2199', 'عمر محمد', 'مدفوع', 'تيكنولوجي', '120039021'),
(2, 'graf.webp', 'دبلومة جرافيك ديزاين من الصفر', '1499', '1699', 'جرافينكو', 'مدفوع', 'فوتوشوب', '120039022'),
(3, 'icdl.jpg', 'دبلومة icdl تعرف علي الكمبيوتر', '400', '650', 'اكاديمي', 'مدفوع', 'كمبيوتر', '120039023'),
(4, 'en.jpg', 'English Course', '1200', '1500', 'اكاديمية en', 'مدفوع', 'لغات اجنبية', '120039024');

-- --------------------------------------------------------

--
-- Table structure for table `subscibe`
--

CREATE TABLE `subscibe` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `courseid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subscibe`
--

INSERT INTO `subscibe` (`id`, `uid`, `courseid`) VALUES
(1, 'e88b8a610b61a0c36c1a44d5d4d45ec8', '120039021'),
(2, 'e88b8a610b61a0c36c1a44d5d4d45ec8', '12003902');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(400) NOT NULL,
  `code` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `img`, `code`, `token`, `time`, `role`) VALUES
(5, 'omar', 'omar@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'https://metalloid-clerk.000webhostapp.com/images/img_default.webp', 'e88b8a610b61a0c36c1a44d5d4d45ec8', '5c3301dd582e897667374d445085c484', '2023-07-24 19:15:14', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `video` varchar(400) NOT NULL,
  `img` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `state` varchar(100) NOT NULL,
  `time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `video`, `img`, `uid`, `state`, `time`) VALUES
(1, 'انواع الأستضافات والسيرفر', 'https://metalloid-clerk.000webhostapp.com/videos/video.mp4', '2.jpg', 1, 'free', '2023-06-14'),
(2, 'ازاي ترفع موقعك علي جيتهاب', 'https://metalloid-clerk.000webhostapp.com/videos/video.mp4', '2.jpg', 1, 'pro', '2023-07-16'),
(5, 'اساسيات برامج الفوتوشوب', 'https://metalloid-clerk.000webhostapp.com/videos/video.mp4', '2.jpg', 2, 'free', '2023-07-17'),
(6, 'تصميم لوجو شركة فودافون', 'https://metalloid-clerk.000webhostapp.com/videos/video.mp4', '2.jpg', 2, 'pro', '2023-07-17'),
(7, 'ازاي الكمبيوتر بيشتغل؟', 'https://metalloid-clerk.000webhostapp.com/videos/video.mp4', '2.jpg', 3, 'free', '2023-07-18'),
(8, 'التعرف علي أوامر cmd', 'https://metalloid-clerk.000webhostapp.com/videos/video.mp4', '2.jpg', 3, 'pro', '2023-07-18'),
(9, 'التعرف علي نطق اللغة مثل الأجانب', 'https://metalloid-clerk.000webhostapp.com/videos/video.mp4', '2.jpg', 4, 'free', '2023-07-19'),
(10, 'الدرس الاول جرامر والكلمات مهم', 'https://metalloid-clerk.000webhostapp.com/videos/video.mp4', '2.jpg', 4, 'pro', '2023-07-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscibe`
--
ALTER TABLE `subscibe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscibe`
--
ALTER TABLE `subscibe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
