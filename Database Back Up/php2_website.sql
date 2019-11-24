-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2019 at 02:39 PM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php2_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `answer_id` int(4) NOT NULL,
  `answer` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `answer_votes` int(4) NOT NULL,
  `poll_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`answer_id`, `answer`, `answer_votes`, `poll_id`) VALUES
(1, 'Space', 11, 1),
(2, 'Vintage', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(2) NOT NULL,
  `category_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Animals', '2017-09-01', NULL),
(2, 'Nature', '2017-09-01', NULL),
(3, 'Objects', '2017-09-01', NULL),
(4, 'People', '2017-09-01', NULL),
(5, 'Places', '2017-09-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(4) NOT NULL,
  `comment_text` text COLLATE utf8_unicode_ci NOT NULL,
  `picture_id` int(4) NOT NULL,
  `user_id` int(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_text`, `picture_id`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 'Ovo je odgovor.', 2, 2, '2018-03-06 03:20:09', NULL),
(6, 'Proba, proba.', 4, 1, '2018-03-01 04:11:08', NULL),
(7, 'Administrator kuca.', 1, 2, '2018-03-05 03:10:09', '2018-03-11 23:24:04'),
(8, 'Pazi sad ovako.', 1, 3, '2018-02-21 02:14:09', '2018-03-11 23:22:30'),
(11, 'Dobra slika.', 11, 4, '2018-03-01 04:07:06', NULL),
(16, 'Kako je?', 2, 1, '2018-03-07 22:55:16', NULL),
(17, 'Pazi proba.', 4, 1, '2018-03-07 22:56:07', NULL),
(19, 'Коментар на ћирилици.', 9, 1, '2018-03-10 11:42:54', NULL),
(20, 'Test.', 10, 1, '2018-03-11 16:42:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `navigation`
--

CREATE TABLE `navigation` (
  `navigation_id` int(1) NOT NULL,
  `navigation_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `navigation_path` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `navigation_icon` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `navigation`
--

INSERT INTO `navigation` (`navigation_id`, `navigation_name`, `navigation_path`, `navigation_icon`, `created_at`, `updated_at`) VALUES
(1, 'Home', 'home', 'fa-home', '2017-09-01', NULL),
(2, 'Gallery', 'gallery', 'fa-camera-retro', '2017-09-01', NULL),
(3, 'Share', 'share', 'fa-upload', '2017-09-01', NULL),
(4, 'Admin Panel', 'admin-panel/users', 'fa-cogs', '2017-09-01', NULL),
(5, 'Information', 'information', 'fa-file-text-o', '2017-09-01', NULL),
(6, 'Logout', 'logout', 'fa-power-off', '2017-09-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE `picture` (
  `picture_id` int(4) NOT NULL,
  `picture_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `picture_show` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `picture_path` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(2) NOT NULL,
  `user_id` int(4) NOT NULL,
  `shared_at` date NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`picture_id`, `picture_name`, `picture_show`, `picture_path`, `category_id`, `user_id`, `shared_at`, `updated_at`) VALUES
(1, 'Asian House', 'images/thumbs/asian house.jpg', 'images/fulls/asian house.jpg', 5, 3, '2018-01-10', '2018-03-11'),
(2, 'Asian Road', 'images/thumbs/asian road.jpg', 'images/fulls/asian road.jpg', 5, 4, '2017-12-05', NULL),
(3, 'Bag', 'images/thumbs/bag.jpg', 'images/fulls/bag.jpg', 3, 5, '2017-11-15', '2018-03-11'),
(4, 'Bike', 'images/thumbs/bike.jpg', 'images/fulls/bike.jpg', 3, 5, '2018-02-07', NULL),
(5, 'Car', 'images/thumbs/car.jpg', 'images/fulls/car.jpg', 3, 2, '2017-12-22', NULL),
(6, 'City', 'images/thumbs/city.jpg', 'images/fulls/city.jpg', 5, 4, '2018-02-12', '2018-03-11'),
(7, 'Friend', 'images/thumbs/friend.jpg', 'images/fulls/friend.jpg', 4, 2, '2018-02-05', NULL),
(8, 'Girlfriend', 'images/thumbs/girlfriend.jpg', 'images/fulls/girlfriend.jpg', 4, 3, '2017-11-20', NULL),
(9, 'Lock', 'images/thumbs/lock.jpg', 'images/fulls/lock.jpg', 3, 3, '2018-02-05', NULL),
(10, 'Machu Picchu', 'images/thumbs/machu picchu.jpg', 'images/fulls/machu picchu.jpg', 5, 5, '2018-01-17', NULL),
(11, 'Smoking', 'images/thumbs/smoking.jpg', 'images/fulls/smoking.jpg', 4, 2, '2018-01-22', NULL),
(12, 'Woman', 'images/thumbs/woman.jpg', 'images/fulls/woman.jpg', 4, 4, '2018-02-14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE `poll` (
  `poll_id` int(2) NOT NULL,
  `poll_question` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `poll_active` tinyint(1) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`poll_id`, `poll_question`, `poll_active`, `created_at`, `updated_at`) VALUES
(1, 'What category should we add next?', 1, '2018-01-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(1) NOT NULL,
  `role_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'administrator', '2017-09-01', NULL),
(2, 'user', '2017-09-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(4) NOT NULL,
  `user_mail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_pass` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(1) NOT NULL,
  `registered_at` date NOT NULL,
  `changed_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_mail`, `user_name`, `user_pass`, `role_id`, `registered_at`, `changed_at`) VALUES
(1, 'admin@admin.com', 'admin', '0192023a7bbd73250516f069df18b500', 1, '2017-10-01', '2018-03-11'),
(2, 'user@user.com', 'user', '6ad14ba9986e3615423dfca256d04e3f', 2, '2017-12-20', '2018-03-11'),
(3, 'pera@pera.com', 'pera', 'bf676ed1364b5857fba69b5623c81b64', 2, '2017-11-01', '2018-03-11'),
(4, 'ana@ana.com', 'ana', '5390489da3971cbbcd22c159d54d24da', 2, '2017-12-01', NULL),
(5, 'mika@mika.com', 'mika', 'e471a891c22fb1b5b722f57bed71de32', 2, '2017-11-10', '2018-03-10');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `views_id` int(7) NOT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `picture_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`views_id`, `ip`, `picture_id`) VALUES
(1, '::1', 4),
(2, '::1', 5),
(3, '::1', 4),
(4, '::1', 3),
(5, '::1', 4),
(6, '::1', 5),
(7, '::1', 6),
(8, '::1', 5),
(9, '::1', 4),
(10, '::1', 3),
(11, '::1', 2),
(12, '::1', 3),
(13, '::1', 3),
(14, '::1', 3),
(15, '::1', 3),
(16, '::1', 3),
(17, '::1', 2),
(18, '::1', 3),
(19, '::1', 2),
(20, '::1', 1),
(21, '::1', 2),
(22, '::1', 3),
(23, '::1', 9),
(24, '::1', 9),
(25, '::1', 9),
(26, '::1', 9),
(27, '::1', 9),
(28, '::1', 9),
(29, '::1', 9),
(30, '::1', 9),
(31, '::1', 9),
(32, '::1', 9),
(33, '::1', 12),
(34, '::1', 9),
(35, '::1', 10),
(36, '::1', 10),
(37, '::1', 1),
(38, '::1', 1),
(39, '::1', 1),
(40, '::1', 9),
(41, '::1', 9),
(42, '::1', 9),
(43, '::1', 9),
(44, '::1', 9),
(45, '::1', 9),
(46, '::1', 9),
(47, '::1', 9),
(48, '::1', 9),
(49, '::1', 9),
(50, '::1', 9),
(51, '::1', 9),
(52, '::1', 9),
(53, '::1', 9),
(54, '::1', 9),
(55, '::1', 9),
(56, '::1', 9),
(57, '::1', 9),
(58, '::1', 9),
(59, '::1', 9),
(60, '::1', 9),
(61, '::1', 9),
(62, '::1', 9),
(63, '::1', 9),
(64, '::1', 9),
(65, '::1', 9),
(66, '::1', 9),
(67, '::1', 9),
(68, '::1', 9),
(69, '::1', 9),
(70, '::1', 9),
(71, '::1', 9),
(72, '::1', 9),
(73, '::1', 9),
(74, '::1', 9),
(75, '::1', 9),
(76, '::1', 9),
(77, '::1', 7),
(78, '::1', 6),
(79, '::1', 7),
(80, '::1', 8),
(81, '::1', 9),
(82, '::1', 1),
(83, '::1', 1),
(84, '::1', 1),
(85, '::1', 1),
(86, '::1', 1),
(87, '::1', 1),
(88, '::1', 1),
(89, '::1', 1),
(90, '::1', 1),
(91, '::1', 1),
(92, '::1', 1),
(93, '::1', 1),
(94, '::1', 1),
(95, '::1', 1),
(96, '::1', 1),
(97, '::1', 1),
(98, '::1', 1),
(99, '::1', 1),
(100, '::1', 1),
(101, '::1', 1),
(102, '::1', 1),
(103, '::1', 1),
(104, '::1', 1),
(105, '::1', 1),
(106, '::1', 1),
(107, '::1', 1),
(108, '::1', 1),
(109, '::1', 2),
(110, '::1', 2),
(111, '::1', 2),
(112, '::1', 2),
(113, '::1', 2),
(114, '::1', 2),
(115, '::1', 2),
(116, '::1', 2),
(117, '::1', 1),
(118, '::1', 5),
(119, '::1', 5),
(120, '::1', 5),
(121, '::1', 5),
(122, '::1', 5),
(123, '::1', 5),
(124, '::1', 5),
(125, '::1', 5),
(126, '::1', 5),
(127, '::1', 5),
(128, '::1', 5),
(129, '::1', 5),
(130, '::1', 5),
(131, '::1', 5),
(132, '::1', 5),
(133, '::1', 5),
(134, '::1', 5),
(135, '::1', 5),
(136, '::1', 5),
(137, '::1', 1),
(138, '::1', 1),
(139, '::1', 1),
(140, '::1', 1),
(141, '::1', 1),
(142, '::1', 1),
(143, '::1', 1),
(144, '::1', 1),
(145, '::1', 124),
(146, '::1', 1),
(147, '::1', 1),
(148, '::1', 5),
(149, '::1', 5),
(150, '::1', 5),
(151, '::1', 5),
(152, '::1', 5),
(153, '::1', 5),
(154, '::1', 5),
(155, '::1', 5),
(156, '::1', 5),
(157, '::1', 5),
(158, '::1', 1),
(159, '::1', 1),
(160, '::1', 1),
(161, '::1', 1),
(162, '::1', 1),
(163, '::1', 1),
(164, '::1', 1),
(165, '::1', 1),
(166, '::1', 1),
(167, '::1', 1),
(168, '::1', 1),
(169, '::1', 1),
(170, '::1', 5),
(171, '::1', 1),
(172, '::1', 2),
(173, '::1', 3),
(174, '::1', 4),
(175, '::1', 5),
(176, '::1', 5),
(177, '::1', 5),
(178, '::1', 5),
(179, '::1', 1),
(180, '::1', 1),
(181, '::1', 1),
(182, '::1', 1),
(183, '::1', 1),
(184, '::1', 2),
(185, '::1', 2),
(186, '::1', 2),
(187, '::1', 2),
(188, '::1', 1),
(189, '::1', 1),
(190, '::1', 1),
(191, '::1', 1),
(192, '::1', 1),
(193, '::1', 1),
(194, '::1', 1),
(195, '::1', 1),
(196, '::1', 1),
(197, '::1', 2),
(198, '::1', 2),
(199, '::1', 2),
(200, '::1', 2),
(201, '::1', 2),
(202, '::1', 2),
(203, '::1', 2),
(204, '::1', 2),
(205, '::1', 2),
(206, '::1', 2),
(207, '::1', 2),
(208, '::1', 2),
(209, '::1', 2),
(210, '::1', 2),
(211, '::1', 1),
(212, '::1', 1),
(213, '::1', 1),
(214, '::1', 8),
(215, '::1', 7),
(216, '::1', 6),
(217, '::1', 5),
(218, '::1', 4),
(219, '::1', 4),
(220, '::1', 4),
(221, '::1', 2),
(222, '::1', 1),
(223, '::1', 8),
(224, '::1', 12),
(225, '::1', 1),
(226, '::1', 1),
(227, '::1', 1),
(228, '::1', 1),
(229, '::1', 1),
(230, '::1', 1),
(231, '::1', 1),
(232, '::1', 1),
(233, '::1', 1),
(234, '::1', 1),
(235, '::1', 8),
(236, '::1', 8),
(237, '::1', 2),
(238, '::1', 2),
(239, '::1', 12),
(240, '::1', 8),
(241, '::1', 8),
(242, '::1', 12),
(243, '::1', 12),
(244, '::1', 8),
(245, '::1', 8),
(246, '::1', 8),
(247, '::1', 11),
(248, '::1', 1),
(249, '::1', 1),
(250, '::1', 1),
(251, '::1', 1),
(252, '::1', 1),
(253, '::1', 6),
(254, '::1', 10),
(255, '::1', 10),
(256, '::1', 10),
(257, '::1', 10),
(258, '::1', 7),
(259, '::1', 6),
(260, '::1', 6),
(261, '::1', 8);

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `vote_id` int(7) NOT NULL,
  `poll_id` int(2) NOT NULL,
  `user_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`vote_id`, `poll_id`, `user_id`) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 1, 1),
(4, 1, 1),
(5, 1, 1),
(6, 1, 1),
(7, 1, 1),
(8, 1, 1),
(9, 1, 1),
(10, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `navigation`
--
ALTER TABLE `navigation`
  ADD PRIMARY KEY (`navigation_id`);

--
-- Indexes for table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`picture_id`);

--
-- Indexes for table `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`poll_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`views_id`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`vote_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `answer_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `navigation`
--
ALTER TABLE `navigation`
  MODIFY `navigation_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `picture`
--
ALTER TABLE `picture`
  MODIFY `picture_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `poll`
--
ALTER TABLE `poll`
  MODIFY `poll_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `views_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `vote_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
