-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 22, 2020 at 03:58 AM
-- Server version: 10.3.21-MariaDB-log-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invention_autoComplete`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_table`
--

CREATE TABLE `customer_table` (
  `customer_id` int(11) NOT NULL,
  `customer_first_name` varchar(200) NOT NULL,
  `customer_last_name` varchar(200) NOT NULL,
  `customer_email` varchar(300) NOT NULL,
  `customer_gender` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_table`
--

INSERT INTO `customer_table` (`customer_id`, `customer_first_name`, `customer_last_name`, `customer_email`, `customer_gender`) VALUES
(1, 'dfdf', 'dfdfs', 'dfdff@gmail.com', 'm'),
(2, 'perjpewj', 'lajdfljq', 'qaefajfeo@gmail.com', 'm'),
(3, 'eaosfashd', ';j;sa;;a', 'soajdfjols@gmail.com', 'm'),
(4, 'weieoroe', 'erieoroe', 'olsdfsd@gmail.com', 'f'),
(5, 'a;aa;;a difjdf', 'dfsaf', 'fdfsaf@gmail.com', 'f'),
(6, 'oerwe0whdvcnh', 'dvnaohetf', 'fnaeaof@gmail.com', 'f'),
(7, '[qweruef', 'vnoaFOWE', 'DFVNAEWL@gmail.com', 'M'),
(8, 'a;ldf;i', 'a;oefjew9', 'aojfheodfg@gmail.com', 'f'),
(9, 'a;lidfj', 'dfopasf', 'hto4ew0rf@gmail.com', 'f'),
(10, 'qpwreo0i', 'pqweri0', 'cmepow9@gmail.com', 'f'),
(11, 'vneior', 'vneiowa', 'vnieowa@gmail.com', 'm'),
(12, 'oertg', 'angvoqa', 'dveow@gmail.com', 'm'),
(13, 'akldinfg', 'aojg', 'hgoas@gmail.com', 'f'),
(14, 'thoeaw', 'topwqa', 'aoetg@gmail.com', 'm'),
(15, 'reuiqo', 'pweujet', 'gofiva@gmail.com', 'f'),
(16, 'qpowuroew', 'pA0FFAJ', 'mcojefj@gmail.com', 'F'),
(17, 'rurururur', 'totototo', 'cvjvjvj@gmail.com', 'f'),
(18, 'qpqpqpqeo', 'fvnvnvnvnv', 'dkde@gmail.com', 'm'),
(19, 'akifdfn', 'itfhaai', 'hgdifhe@gmail.com', 'm'),
(20, 'eotreout', 'gpoafja', 'mcveojreo@gmail.com', 'm'),
(21, 'aoifajf', 'ohgraojg', 'foasjfpo@gmail.com', 'f'),
(22, 'sfjsajfja', 'cmoewjfepw', 'cmoewjfopj@gmail.com', 'm'),
(23, 'ao;idjfjdf', 'vjoasjfopa', 'pqwrtfjv@gmail.com', 'f'),
(24, 'cmeofjeo', 'alaldlfj', 'apooasdoi@gmail.com', 'm'),
(25, 'owerjeoro', 'vnieofoi', 'wiorjeoih@gmail.com', 'm'),
(26, 'cieojfjf', 'pwtfejfo', 'urioweqerf@gmail.com', 'f'),
(27, 'ldsfjled', 'gboaehojf', 'fdvcnv@@gmail.com', 'm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_table`
--
ALTER TABLE `customer_table`
  ADD PRIMARY KEY (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_table`
--
ALTER TABLE `customer_table`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
