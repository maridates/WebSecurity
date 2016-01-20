-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2016 at 01:16 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farmers_stock`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin` varchar(25) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `salt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin`, `pass`, `salt`) VALUES
('admin', 'password', 5643);

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `ID_ad` int(11) NOT NULL,
  `ID_field` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `ad_text` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`ID_ad`, `ID_field`, `id_user`, `ad_text`) VALUES
(1, 2, 10, 'I am selling potatoes'),
(2, 1, 12, 'I am selling reindeer meat.'),
(3, 2, 12, 'I am selling carrots.'),
(4, 1, 12, 'I want to sell chicken meat.'),
(5, 1, 12, 'Pork meat on sale..'),
(8, 1, 12, 'Test'),
(9, 1, 14, '&lt;script&gt;alert(&quot;test&quot;)&lt;/script&gt;\r\nTestez'),
(10, 1, 12, 'Selling &lt;script&gt;alert(&quot;test&quot;)&lt;/script&gt;\r\nall sorts of meat.');

-- --------------------------------------------------------

--
-- Table structure for table `field`
--

CREATE TABLE `field` (
  `ID_field` int(11) NOT NULL,
  `field_name` varchar(25) NOT NULL,
  `field_type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `field`
--

INSERT INTO `field` (`ID_field`, `field_name`, `field_type`) VALUES
(1, 'meat', '1'),
(2, 'plants', '2');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `ID_req` int(100) NOT NULL,
  `add` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `salt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID_user`, `username`, `password`, `address`, `phone`, `first_name`, `last_name`, `salt`) VALUES
(8, 'me', 'fb59b293855138e92936ddeb3446f233ef9c30f0beab9d73735d912a9263f5aa', 'bla bla', '0000000', 'not me', 'me', 2047),
(9, 'test1', '0517b2d84c919285791ef20455a3990695402d524ab0032b3ce0a59668faf4fe', 'Copenhagen', '52785035', 'My', 'Test', 5745),
(10, 'testez2', '52ee6ecf4d90822f068de31eb8af282c06398771def4a8e946c3e95330143b00', 'here', '5432', 'Seccond2', 'Seccond', 4267),
(11, 'test', 'b6ced776e685303366419bf7553c519397e077b0373bcd5b0aa1390ead737653', 'test', '12345', 'test', 'test', 1684),
(12, 'mary', '5e2727c252e9e4392fd98ff0afb5b320e083b30979970538f73592d5f09078cc', 'Copenhagen', '12345', 'mariana', 'dates', 6474),
(13, 'test12', '5e703c4df96a708cbc6ef7bbec46857ff5982bd7d0530f49f4fdd9aaba7eea45', 'test12', '23456', 'test12', 'test12', 7628),
(14, 'test13', '007ccb0c12510ea1b6919076cfd7e7e37c37f6628b34e8a83f308fc7f5c39f30', 'test13', '098754', 'test13', 'test13', 8566),
(15, '<script>alert("test"', '475c98551a9555676ccb00780a037b20a9d422e9dd938c5abdb67ae3562907a4', 'me', '23445', 'me', 'me', 1785);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD UNIQUE KEY `admin` (`admin`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`ID_ad`),
  ADD UNIQUE KEY `ID_ad` (`ID_ad`);

--
-- Indexes for table `field`
--
ALTER TABLE `field`
  ADD PRIMARY KEY (`ID_field`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`ID_req`),
  ADD UNIQUE KEY `ID_req` (`ID_req`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_user`),
  ADD UNIQUE KEY `ID_user` (`ID_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `ID_ad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `field`
--
ALTER TABLE `field`
  MODIFY `ID_field` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
