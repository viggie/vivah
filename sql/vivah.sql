-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 20, 2020 at 05:46 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vhosts_vivah`
--

-- --------------------------------------------------------

--
-- Table structure for table `param_communities`
--

CREATE TABLE `param_communities` (
  `commid` int(11) NOT NULL,
  `name_english` varchar(255) NOT NULL,
  `name_regional` varchar(255) NOT NULL,
  `parentid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Parameters - Communities';

-- --------------------------------------------------------

--
-- Table structure for table `param_educategory`
--

CREATE TABLE `param_educategory` (
  `eduid` int(11) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Parameters - Education Category';

-- --------------------------------------------------------

--
-- Table structure for table `param_jobcategory`
--

CREATE TABLE `param_jobcategory` (
  `jobid` int(11) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Parameters - Education Category';

-- --------------------------------------------------------

--
-- Table structure for table `param_mstatus`
--

CREATE TABLE `param_mstatus` (
  `statusid` int(11) NOT NULL,
  `status_eng` varchar(100) NOT NULL,
  `status_reg` varchar(100) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Parameters - Marital Status';

--
-- Dumping data for table `param_mstatus`
--

INSERT INTO `param_mstatus` (`statusid`, `status_eng`, `status_reg`, `updated_on`) VALUES
(1, 'Never Married', '', '2019-06-26 15:37:16'),
(2, 'Widow / Widower', '', '2019-06-26 15:37:16'),
(3, 'Divorced', '', '2019-06-26 15:37:47');

-- --------------------------------------------------------

--
-- Table structure for table `param_rashi`
--

CREATE TABLE `param_rashi` (
  `rashiid` int(11) NOT NULL,
  `rashi_eng` varchar(100) NOT NULL,
  `rashi_reg` varchar(100) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Parameters - Rashi Astrology';

--
-- Dumping data for table `param_rashi`
--

INSERT INTO `param_rashi` (`rashiid`, `rashi_eng`, `rashi_reg`, `updated_on`) VALUES
(1, 'Aries', '', '2019-06-27 06:52:26'),
(2, 'Taurus', '', '2019-06-27 06:52:26'),
(3, 'Gemini', '', '2019-06-27 06:52:47'),
(4, 'Cancer', '', '2019-06-27 06:52:47'),
(5, 'Leo', '', '2019-06-27 06:53:03'),
(6, 'Virgo', '', '2019-06-27 06:53:03'),
(7, 'Libra', '', '2019-06-27 06:53:24'),
(8, 'Scorpio', '', '2019-06-27 06:53:24'),
(9, 'Sagittarius', '', '2019-06-27 06:53:51'),
(10, 'Capricorn', '', '2019-06-27 06:53:51'),
(11, 'Aquarius', '', '2019-06-27 06:54:04'),
(12, 'Pisces', '', '2019-06-27 06:54:04');

-- --------------------------------------------------------

--
-- Table structure for table `param_religion`
--

CREATE TABLE `param_religion` (
  `religionid` int(3) NOT NULL,
  `religion_eng` varchar(150) NOT NULL,
  `religion_reg` varchar(150) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Parameters - Religion';

--
-- Dumping data for table `param_religion`
--

INSERT INTO `param_religion` (`religionid`, `religion_eng`, `religion_reg`, `updated_on`) VALUES
(1, 'HINDU', '', '2019-06-26 15:28:47'),
(2, 'CHRISTIAN', '', '2019-06-26 15:28:47'),
(3, 'MUSLIM', '', '2019-06-26 15:29:21'),
(4, 'BUDDHISM', '', '2019-06-26 15:29:21'),
(5, 'JAIN', '', '2019-06-26 15:29:37'),
(6, 'AGNOSTIC', '', '2019-06-26 15:29:37'),
(7, 'OTHERS', '', '2019-12-17 08:26:39');

-- --------------------------------------------------------

--
-- Table structure for table `param_stars`
--

CREATE TABLE `param_stars` (
  `starid` int(11) NOT NULL,
  `star_eng` varchar(100) NOT NULL,
  `star_reg` varchar(100) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Parameters - Stars Astrology';

--
-- Dumping data for table `param_stars`
--

INSERT INTO `param_stars` (`starid`, `star_eng`, `star_reg`, `updated_on`) VALUES
(1, 'Anusham', '', '2019-06-27 06:43:02'),
(2, 'Aswini', '', '2019-06-27 06:43:02'),
(3, 'Avittam', '', '2019-06-27 06:43:02'),
(4, 'Ayilyam', '', '2019-06-27 06:43:02'),
(5, 'Bharani', '', '2019-06-27 06:44:20'),
(6, 'Chithrai', '', '2019-06-27 06:44:20'),
(7, 'Hastham', '', '2019-06-27 06:44:20'),
(8, 'Kettai', '', '2019-06-27 06:44:20'),
(9, 'Krithigai', '', '2019-06-27 06:45:14'),
(10, 'Makam', '', '2019-06-27 06:45:14'),
(11, 'Moolam', '', '2019-06-27 06:45:14'),
(12, 'Mrigasirisham', '', '2019-06-27 06:45:14'),
(13, 'Poosam', '', '2019-06-27 06:46:27'),
(14, 'Punarpusam', '', '2019-06-27 06:46:27'),
(15, 'Puradam', '', '2019-06-27 06:46:27'),
(16, 'Puram', '', '2019-06-27 06:46:27'),
(17, 'Puratathi', '', '2019-06-27 06:46:27'),
(18, 'Revathi', '', '2019-06-27 06:47:21'),
(19, 'Rohini', '', '2019-06-27 06:47:21'),
(20, 'Sadayam', '', '2019-06-27 06:47:21'),
(21, 'Swathi', '', '2019-06-27 06:47:21'),
(22, 'Thiruvadirai', '', '2019-06-27 06:48:21'),
(23, 'Thiruvonam', '', '2019-06-27 06:48:21'),
(24, 'Uthradam', '', '2019-06-27 06:48:21'),
(25, 'Uthram', '', '2019-06-27 06:48:21'),
(26, 'Uthratadhi', '', '2019-06-27 06:48:51'),
(27, 'Visakam', '', '2019-06-27 06:48:51');

-- --------------------------------------------------------

--
-- Table structure for table `seekers`
--

CREATE TABLE `seekers` (
  `id` int(11) NOT NULL,
  `added_by` int(11) DEFAULT NULL COMMENT 'usrid',
  `name` varchar(255) NOT NULL,
  `lastname` varchar(150) DEFAULT NULL,
  `gender` enum('F','M') NOT NULL DEFAULT 'F',
  `dob` date DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `mobile` varchar(25) DEFAULT NULL,
  `address` text,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `eduid` int(3) NOT NULL,
  `commid` int(3) NOT NULL,
  `religionid` int(3) DEFAULT NULL,
  `starid` int(11) DEFAULT NULL,
  `rashiid` int(11) DEFAULT NULL,
  `statusid` int(11) NOT NULL DEFAULT '1',
  `astro_pic` varchar(255) DEFAULT NULL,
  `profile` text,
  `jobid` int(3) NOT NULL,
  `job_place` varchar(100) DEFAULT NULL,
  `job_title` varchar(150) DEFAULT NULL,
  `job_salary` varchar(255) DEFAULT NULL,
  `father_name` varchar(150) DEFAULT NULL,
  `father_job` varchar(150) DEFAULT NULL,
  `mother_name` varchar(150) DEFAULT NULL,
  `mother_job` varchar(150) DEFAULT NULL,
  `preferences` text,
  `status` enum('A','P','S','D','N') NOT NULL DEFAULT 'A' COMMENT 'Active, Pending, Suspend, Delete, New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Match Seekers Profile';

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `staffid` int(11) NOT NULL,
  `user` varchar(75) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `passwd` varchar(125) NOT NULL,
  `role` enum('A','E') NOT NULL DEFAULT 'E' COMMENT 'Admin, Employee',
  `status` enum('W','L') NOT NULL DEFAULT 'W' COMMENT 'Working, Left',
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Admin users';

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`staffid`, `user`, `name`, `passwd`, `role`, `status`, `added_on`) VALUES
(1, 'first', 'Admin', '$2y$10$fcwypYSr/nY8t1zsEx2hTu3md0MoLBnrYAc0JxnABIdu0m5mhRxc2', 'A', 'W', '2019-06-27 08:20:04');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `usrid` int(11) NOT NULL,
  `display_name` varchar(75) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `phone` bigint(12) NOT NULL,
  `passwd` varchar(130) DEFAULT NULL,
  `balance_points` int(5) DEFAULT NULL,
  `points_expire` date DEFAULT NULL,
  `status` enum('A','P','S','D') NOT NULL COMMENT 'Active, Pending, Suspend, Delete',
  `joined_on` date NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User Login & credits';

-- --------------------------------------------------------

--
-- Table structure for table `user_forgotpwd`
--

CREATE TABLE `user_forgotpwd` (
  `fpid` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `pwdtoken` varchar(150) NOT NULL,
  `request_from` varchar(25) DEFAULT NULL,
  `obtained_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `changed_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_paydata`
--

CREATE TABLE `user_paydata` (
  `payid` int(11) NOT NULL,
  `usrid` int(11) NOT NULL,
  `plan` varchar(75) DEFAULT NULL,
  `amount` int(5) DEFAULT NULL,
  `view_points` int(5) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `paid_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User credits';

-- --------------------------------------------------------

--
-- Table structure for table `user_viewlog`
--

CREATE TABLE `user_viewlog` (
  `viewlogid` int(11) NOT NULL,
  `usrid` int(11) NOT NULL,
  `seekerid` int(11) NOT NULL,
  `viewed_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `param_communities`
--
ALTER TABLE `param_communities`
  ADD PRIMARY KEY (`commid`);

--
-- Indexes for table `param_educategory`
--
ALTER TABLE `param_educategory`
  ADD PRIMARY KEY (`eduid`);

--
-- Indexes for table `param_jobcategory`
--
ALTER TABLE `param_jobcategory`
  ADD PRIMARY KEY (`jobid`) USING BTREE;

--
-- Indexes for table `param_mstatus`
--
ALTER TABLE `param_mstatus`
  ADD PRIMARY KEY (`statusid`);

--
-- Indexes for table `param_rashi`
--
ALTER TABLE `param_rashi`
  ADD PRIMARY KEY (`rashiid`);

--
-- Indexes for table `param_religion`
--
ALTER TABLE `param_religion`
  ADD PRIMARY KEY (`religionid`);

--
-- Indexes for table `param_stars`
--
ALTER TABLE `param_stars`
  ADD PRIMARY KEY (`starid`);

--
-- Indexes for table `seekers`
--
ALTER TABLE `seekers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`staffid`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`usrid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_forgotpwd`
--
ALTER TABLE `user_forgotpwd`
  ADD PRIMARY KEY (`fpid`);

--
-- Indexes for table `user_paydata`
--
ALTER TABLE `user_paydata`
  ADD PRIMARY KEY (`payid`);

--
-- Indexes for table `user_viewlog`
--
ALTER TABLE `user_viewlog`
  ADD PRIMARY KEY (`viewlogid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `param_communities`
--
ALTER TABLE `param_communities`
  MODIFY `commid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `param_educategory`
--
ALTER TABLE `param_educategory`
  MODIFY `eduid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `param_jobcategory`
--
ALTER TABLE `param_jobcategory`
  MODIFY `jobid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `param_mstatus`
--
ALTER TABLE `param_mstatus`
  MODIFY `statusid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `param_rashi`
--
ALTER TABLE `param_rashi`
  MODIFY `rashiid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `param_religion`
--
ALTER TABLE `param_religion`
  MODIFY `religionid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `param_stars`
--
ALTER TABLE `param_stars`
  MODIFY `starid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `seekers`
--
ALTER TABLE `seekers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `staffid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `usrid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_forgotpwd`
--
ALTER TABLE `user_forgotpwd`
  MODIFY `fpid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_paydata`
--
ALTER TABLE `user_paydata`
  MODIFY `payid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_viewlog`
--
ALTER TABLE `user_viewlog`
  MODIFY `viewlogid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
