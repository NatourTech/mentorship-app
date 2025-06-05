-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 25, 2025 at 09:34 AM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mentors_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `settings_extra`
--

CREATE TABLE `settings_extra` (
  `id` int(11) NOT NULL,
  `lang_id` varchar(155) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `site_name` varchar(255) DEFAULT NULL,
  `site_title` varchar(255) DEFAULT NULL,
  `site_title_mentor` varchar(255) DEFAULT NULL,
  `site_desc_mentor` text,
  `about` text,
  `keywords` varchar(255) DEFAULT NULL,
  `description` text,
  `footer_about` varchar(255) DEFAULT NULL,
  `copyright` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings_extra`
--

INSERT INTO `settings_extra` (`id`, `lang_id`, `user_id`, `site_name`, `site_title`, `site_title_mentor`, `site_desc_mentor`, `about`, `keywords`, `description`, `footer_about`, `copyright`) VALUES
(1, '1', 0, 'Mentorship', 'Learn and grow with help from world-class mentors', 'Teach and grow with help to a learner for world wide', 'Build confidence as a leader, grow your network, and define your legacy.', NULL, 'saas,appointment,booking,services', 'Build an epic career with expert mentors from all over the word, let\'s start today.', '', '© 2025 All rights reserved.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings_extra`
--
ALTER TABLE `settings_extra`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings_extra`
--
ALTER TABLE `settings_extra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
