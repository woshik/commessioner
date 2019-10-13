-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2019 at 02:38 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `commissioneroffice`
--

-- --------------------------------------------------------

--
-- Table structure for table `bulk_sms`
--

DROP TABLE IF EXISTS `bulk_sms`;
CREATE TABLE `bulk_sms` (
  `bulk_sms_id` tinyint(4) NOT NULL,
  `id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bulk_sms`
--

INSERT INTO `bulk_sms` (`bulk_sms_id`, `id`, `password`) VALUES
(1, '01941257203', '33698');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image_src` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `recover_code` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `name`, `image_src`, `email`, `username`, `password`, `recover_code`) VALUES
(1, 'Admin', 'upload/profilePicture/e06a36a858529d8ec1245dba220a8d94.jpg', 'woshikuzzaman@gmail.com', 'admin', '25d55ad283aa400af464c76d713c07ad', 'cd02c033a7c546ca58b3ea40d787fe1b');

-- --------------------------------------------------------

--
-- Table structure for table `login_img`
--

DROP TABLE IF EXISTS `login_img`;
CREATE TABLE `login_img` (
  `login_img_id` int(11) NOT NULL,
  `login_img_src` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_img`
--

INSERT INTO `login_img` (`login_img_id`, `login_img_src`) VALUES
(49, 'upload/loginPicture/C4E611213C27F78F17E001FDC2448B06.jpg'),
(50, 'upload/loginPicture/C4E611213C27F78F17E001FDC2448B061.jpg'),
(51, 'upload/loginPicture/C4E611213C27F78F17E001FDC2448B062.jpg'),
(52, 'upload/loginPicture/C4E611213C27F78F17E001FDC2448B063.jpg'),
(53, 'upload/loginPicture/C4E611213C27F78F17E001FDC2448B064.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mamla`
--

DROP TABLE IF EXISTS `mamla`;
CREATE TABLE `mamla` (
  `mamla_id` int(11) NOT NULL,
  `mamlaNo` varchar(100) NOT NULL,
  `apilkarirNam` varchar(100) NOT NULL,
  `apilkarirTikana` varchar(200) NOT NULL,
  `apilkarirPhone` varchar(100) NOT NULL,
  `protipokherNam` varchar(100) NOT NULL,
  `protipokherTikana` varchar(200) NOT NULL,
  `protipokherPhone` varchar(100) NOT NULL,
  `jaharAdese` varchar(300) NOT NULL,
  `jeAdese` varchar(300) NOT NULL,
  `apilerTarik` date NOT NULL,
  `porobortiTarik` date NOT NULL,
  `adaloterAdesh` varchar(1000) NOT NULL,
  `mamlarBiboron` varchar(1000) NOT NULL,
  `send_sms` tinyint(4) NOT NULL,
  `send_sms_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mamla`
--

INSERT INTO `mamla` (`mamla_id`, `mamlaNo`, `apilkarirNam`, `apilkarirTikana`, `apilkarirPhone`, `protipokherNam`, `protipokherTikana`, `protipokherPhone`, `jaharAdese`, `jeAdese`, `apilerTarik`, `porobortiTarik`, `adaloterAdesh`, `mamlarBiboron`, `send_sms`, `send_sms_date`) VALUES
(7, 'j', 'nj', 'nj', 'n', 'kjn', 'kjn', 'kjn', 'kj', 'nkj', '2018-12-17', '2019-01-05', 'nj', 'n', 2, '2018-12-29'),
(8, 'jkn', 'lk', 'mkl', 'nmo', 'jn', 'ujn', 'jn', 'jn', 'ju', '2018-12-17', '2019-01-10', '', '', 2, '2018-12-17'),
(9, 'kn', 'lkm', '', 'nb', 'hb', 'ub', 'ub', 'uy', 'bu', '2018-12-17', '2019-01-24', '', '', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `mamla_tarik_adesh`
--

DROP TABLE IF EXISTS `mamla_tarik_adesh`;
CREATE TABLE `mamla_tarik_adesh` (
  `mamla_tarik_adesh_id` int(11) NOT NULL,
  `mamla_id` int(11) NOT NULL,
  `porobortiTarik` date NOT NULL,
  `adaloterAdesh` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mamla_tarik_adesh`
--

INSERT INTO `mamla_tarik_adesh` (`mamla_tarik_adesh_id`, `mamla_id`, `porobortiTarik`, `adaloterAdesh`) VALUES
(13, 7, '2019-01-05', 'nj'),
(14, 8, '2019-01-10', ''),
(15, 9, '2019-01-24', '');

-- --------------------------------------------------------

--
-- Table structure for table `send_sms`
--

DROP TABLE IF EXISTS `send_sms`;
CREATE TABLE `send_sms` (
  `send_sms_id` int(11) NOT NULL,
  `mamla_id` int(11) NOT NULL,
  `is_send` tinyint(4) NOT NULL,
  `send_sms_date` date NOT NULL,
  `sms_model_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `send_sms`
--

INSERT INTO `send_sms` (`send_sms_id`, `mamla_id`, `is_send`, `send_sms_date`, `sms_model_id`) VALUES
(7, 7, 2, '2018-12-29', 4),
(8, 8, 2, '2018-12-17', 5),
(9, 9, 0, '0000-00-00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `sms_error_log`
--

DROP TABLE IF EXISTS `sms_error_log`;
CREATE TABLE `sms_error_log` (
  `sms_error_log_id` int(11) NOT NULL,
  `sms_error_log` varchar(250) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sms_model`
--

DROP TABLE IF EXISTS `sms_model`;
CREATE TABLE `sms_model` (
  `sms_model_id` int(11) NOT NULL,
  `sms_model_name` varchar(100) NOT NULL,
  `send_sms_day` smallint(6) NOT NULL,
  `masking_name` varchar(100) NOT NULL,
  `sms` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_model`
--

INSERT INTO `sms_model` (`sms_model_id`, `sms_model_name`, `send_sms_day`, `masking_name`, `sms`) VALUES
(1, 'Model 1', 0, '', '&lt;div&gt;মামলা নং : [মামলা নং]&lt;/div&gt;&lt;div&gt;আপীলকারীর নাম : [আপীলকারীর নাম]&lt;/div&gt;&lt;div&gt;প্রতিপক্ষের নাম : [প্রতিপক্ষের নাম]&lt;/div&gt;&lt;div&gt;পরবর্তী তারিখ : [পরবর্তী তারিখ]&lt;/div&gt;'),
(2, 'Model 2', 0, '', '&lt;p&gt;মামলা নং : [মামলা নং]&lt;/p&gt;&lt;p&gt;আপীলকারীর নাম : [আপীলকারীর নাম]&lt;/p&gt;'),
(4, 'Model 3', 7, '', '&lt;p&gt;মামলা নং : [মামলা নং]&lt;/p&gt;&lt;p&gt;আপীলকারীর নাম : [আপীলকারীর নাম]&lt;/p&gt;&lt;p&gt;প্রতিপক্ষের নাম : [প্রতিপক্ষের নাম]&lt;br&gt;আপীলদায়ের তারিখ : [আপীলদায়ের তারিখ]&lt;/p&gt;&lt;p&gt;পরবর্তী তারিখ : [পরবর্তী তারিখ]&lt;/p&gt;'),
(5, 'Model 4', 0, '', '&lt;p&gt;মামলা নং : [মামলা নং]&lt;/p&gt;&lt;p&gt;আপীলকারীর নাম : [আপীলকারীর নাম]&lt;/p&gt;&lt;p&gt;প্রতিপক্ষের নাম : [প্রতিপক্ষের নাম]&lt;br&gt;আপীলদায়ের তারিখ : [আপীলদায়ের তারিখ]&lt;/p&gt;&lt;p&gt;পরবর্তী তারিখ : [পরবর্তী তারিখ]&lt;/p&gt;'),
(6, 'Model 5', 4, '', '&lt;p&gt;মামলা নং : [মামলা নং]&lt;/p&gt;&lt;p&gt;আপীলকারীর নাম : [আপীলকারীর নাম]&lt;/p&gt;&lt;p&gt;প্রতিপক্ষের নাম : [প্রতিপক্ষের নাম]&lt;br&gt;আপীলদায়ের তারিখ : [আপীলদায়ের তারিখ]&lt;/p&gt;&lt;p&gt;পরবর্তী তারিখ : [পরবর্তী তারিখ]&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `stuff`
--

DROP TABLE IF EXISTS `stuff`;
CREATE TABLE `stuff` (
  `stuff_id` int(11) NOT NULL,
  `stuff_priture` varchar(300) NOT NULL,
  `stuff_name` varchar(100) NOT NULL,
  `stuff_address` varchar(200) NOT NULL,
  `stuff_phone` varchar(50) NOT NULL,
  `stuff_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stuff`
--

INSERT INTO `stuff` (`stuff_id`, `stuff_priture`, `stuff_name`, `stuff_address`, `stuff_phone`, `stuff_email`) VALUES
(2, 'assets/images/default_avatar.png', 'Anik', 'jkasdf', '01521410552', 'woshikuzzaman@gmail.com'),
(3, 'assets/images/default_avatar.png', 'anirban', 'asdf', '01947738405', 'mypassingdays@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `stuff_email`
--

DROP TABLE IF EXISTS `stuff_email`;
CREATE TABLE `stuff_email` (
  `stuff_email_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `stuff_email_address` text NOT NULL,
  `stuff_email_subject` varchar(500) NOT NULL,
  `stuff_email_body` longtext NOT NULL,
  `stuff_email_file` text NOT NULL,
  `sender_email_id` varchar(200) NOT NULL,
  `sender_name` varchar(200) NOT NULL,
  `is_send` tinyint(4) NOT NULL DEFAULT '0',
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stuff_email`
--

INSERT INTO `stuff_email` (`stuff_email_id`, `user_id`, `stuff_email_address`, `stuff_email_subject`, `stuff_email_body`, `stuff_email_file`, `sender_email_id`, `sender_name`, `is_send`, `dateTime`) VALUES
(1, 1, 'woshikuzzaman@gmail.com', 'pic', '&lt;p&gt;Picture&lt;br&gt;&lt;/p&gt;', 'D:/xampp/htdocs/project/new/upload/email/1776BBC94DC10DF921073560EA93C57D.jpg, D:/xampp/htdocs/project/new/upload/email/1776BBC94DC10DF921073560EA93C57D1.jpg, D:/xampp/htdocs/project/new/upload/email/1776BBC94DC10DF921073560EA93C57D2.jpg, D:/xampp/htdocs/project/new/upload/email/1776BBC94DC10DF921073560EA93C57D3.jpg, D:/xampp/htdocs/project/new/upload/email/1776BBC94DC10DF921073560EA93C57D4.jpg', 'woshikuzzaman@gmail.com', 'Admin', 1, '2018-12-17 19:19:45'),
(2, 1, 'mypassingdays@gmail.com', 'pic', '&lt;p&gt;Picture&lt;br&gt;&lt;/p&gt;', 'D:/xampp/htdocs/project/new/upload/email/1776BBC94DC10DF921073560EA93C57D.jpg, D:/xampp/htdocs/project/new/upload/email/1776BBC94DC10DF921073560EA93C57D1.jpg, D:/xampp/htdocs/project/new/upload/email/1776BBC94DC10DF921073560EA93C57D2.jpg, D:/xampp/htdocs/project/new/upload/email/1776BBC94DC10DF921073560EA93C57D3.jpg, D:/xampp/htdocs/project/new/upload/email/1776BBC94DC10DF921073560EA93C57D4.jpg', 'woshikuzzaman@gmail.com', 'Admin', 0, '2018-12-17 19:18:39');

-- --------------------------------------------------------

--
-- Table structure for table `stuff_sms`
--

DROP TABLE IF EXISTS `stuff_sms`;
CREATE TABLE `stuff_sms` (
  `stuff_sms_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `stuff_sms_phone` mediumtext NOT NULL,
  `stuff_sms_mask` varchar(200) NOT NULL,
  `stuff_sms_body` text NOT NULL,
  `is_send` tinyint(4) NOT NULL DEFAULT '0',
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bulk_sms`
--
ALTER TABLE `bulk_sms`
  ADD PRIMARY KEY (`bulk_sms_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `login_img`
--
ALTER TABLE `login_img`
  ADD PRIMARY KEY (`login_img_id`);

--
-- Indexes for table `mamla`
--
ALTER TABLE `mamla`
  ADD PRIMARY KEY (`mamla_id`);

--
-- Indexes for table `mamla_tarik_adesh`
--
ALTER TABLE `mamla_tarik_adesh`
  ADD PRIMARY KEY (`mamla_tarik_adesh_id`);

--
-- Indexes for table `send_sms`
--
ALTER TABLE `send_sms`
  ADD PRIMARY KEY (`send_sms_id`);

--
-- Indexes for table `sms_error_log`
--
ALTER TABLE `sms_error_log`
  ADD PRIMARY KEY (`sms_error_log_id`);

--
-- Indexes for table `sms_model`
--
ALTER TABLE `sms_model`
  ADD PRIMARY KEY (`sms_model_id`);

--
-- Indexes for table `stuff`
--
ALTER TABLE `stuff`
  ADD PRIMARY KEY (`stuff_id`);

--
-- Indexes for table `stuff_email`
--
ALTER TABLE `stuff_email`
  ADD PRIMARY KEY (`stuff_email_id`);

--
-- Indexes for table `stuff_sms`
--
ALTER TABLE `stuff_sms`
  ADD PRIMARY KEY (`stuff_sms_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bulk_sms`
--
ALTER TABLE `bulk_sms`
  MODIFY `bulk_sms_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_img`
--
ALTER TABLE `login_img`
  MODIFY `login_img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `mamla`
--
ALTER TABLE `mamla`
  MODIFY `mamla_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mamla_tarik_adesh`
--
ALTER TABLE `mamla_tarik_adesh`
  MODIFY `mamla_tarik_adesh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `send_sms`
--
ALTER TABLE `send_sms`
  MODIFY `send_sms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sms_error_log`
--
ALTER TABLE `sms_error_log`
  MODIFY `sms_error_log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_model`
--
ALTER TABLE `sms_model`
  MODIFY `sms_model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stuff`
--
ALTER TABLE `stuff`
  MODIFY `stuff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stuff_email`
--
ALTER TABLE `stuff_email`
  MODIFY `stuff_email_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stuff_sms`
--
ALTER TABLE `stuff_sms`
  MODIFY `stuff_sms_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
