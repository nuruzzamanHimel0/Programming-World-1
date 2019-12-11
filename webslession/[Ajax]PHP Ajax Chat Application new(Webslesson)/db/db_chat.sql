-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2019 at 07:07 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `chat_message_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` mediumtext COLLATE utf8mb4_bin NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`chat_message_id`, `to_user_id`, `from_user_id`, `chat_message`, `timestamp`, `status`) VALUES
(15, 8, 4, 'hi\n', '2019-11-13 06:21:46', 0),
(39, 8, 4, 'and u', '2019-11-13 11:02:14', 0),
(49, 4, 8, 'hi himel', '2019-11-14 09:40:19', 0),
(50, 8, 4, 'what up', '2019-11-16 17:48:08', 0),
(51, 0, 4, 'my name is himekl', '2019-11-16 20:13:18', 1),
(52, 0, 4, 'hi', '2019-11-16 20:19:38', 1),
(53, 0, 4, 'hi ddd', '2019-11-16 20:19:49', 1),
(54, 0, 4, 'ddfd', '2019-11-16 20:22:25', 1),
(55, 0, 4, 'gd n8', '2019-11-16 20:22:48', 1),
(56, 0, 4, 'lotif', '2019-11-16 20:38:12', 1),
(57, 8, 4, 'hi kaniz', '2019-11-17 12:59:55', 0),
(58, 4, 8, 'hello, how are yuou', '2019-11-17 13:00:28', 2),
(59, 0, 8, 'hello evbery one', '2019-11-17 13:37:55', 1),
(60, 4, 8, 'hi', '2019-11-20 05:58:24', 0),
(61, 8, 4, 'how are you', '2019-11-20 05:58:49', 0),
(62, 8, 4, 'hi\n\n', '2019-11-25 03:42:17', 0),
(63, 8, 4, 'god mor\nðŸ˜…\n', '2019-11-25 03:42:53', 2),
(64, 8, 4, 'dd', '2019-11-25 03:43:16', 2),
(65, 8, 4, 'edfdfdf', '2019-11-25 04:24:53', 0),
(66, 8, 4, 'dfdfd', '2019-11-25 04:25:04', 2),
(67, 0, 8, 'good noon\n', '2019-11-25 04:47:18', 1),
(68, 0, 4, 'hiiiii', '2019-11-25 05:58:24', 2);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_id`, `username`, `password`) VALUES
(4, 'himel', 'e6053eb8d35e02ae40beeeacef203c1a'),
(5, 'lisa', 'e6053eb8d35e02ae40beeeacef203c1a'),
(8, 'kaniz', 'e6053eb8d35e02ae40beeeacef203c1a'),
(9, 'chadni', 'e6053eb8d35e02ae40beeeacef203c1a');

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_type` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`login_details_id`, `user_id`, `last_activity`, `is_type`) VALUES
(27, 5, '2019-11-12 04:52:15', 'no'),
(28, 5, '2019-11-12 05:01:37', 'no'),
(39, 8, '2019-11-12 19:47:37', 'no'),
(40, 4, '2019-11-13 19:02:32', 'no'),
(41, 8, '2019-11-13 19:02:41', 'no'),
(42, 8, '2019-11-14 04:19:54', 'no'),
(44, 4, '2019-11-14 05:29:52', 'no'),
(45, 8, '2019-11-14 05:47:23', 'no'),
(46, 4, '2019-11-14 07:18:05', 'no'),
(47, 8, '2019-11-14 07:18:27', 'no'),
(48, 4, '2019-11-14 21:04:38', 'no'),
(49, 8, '2019-11-14 21:04:45', 'no'),
(50, 4, '2019-11-16 20:41:01', 'no'),
(51, 8, '2019-11-16 20:48:46', 'no'),
(52, 8, '2019-11-17 18:29:11', 'no'),
(53, 4, '2019-11-17 13:40:48', 'no'),
(54, 4, '2019-11-19 10:52:29', 'no'),
(55, 4, '2019-11-20 11:04:09', 'no'),
(56, 8, '2019-11-20 11:04:22', 'no'),
(57, 4, '2019-11-23 19:36:44', 'yes'),
(58, 4, '2019-11-24 19:31:16', 'no'),
(59, 4, '2019-11-25 06:07:02', 'no'),
(60, 8, '2019-11-25 06:07:00', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`login_details_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
