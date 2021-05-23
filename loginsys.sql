-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2021 at 03:42 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loginsys`
--

-- --------------------------------------------------------

--
-- Table structure for table `adeia`
--

CREATE TABLE `adeia` (
  `ST_DATE` date NOT NULL,
  `E_DATE` date NOT NULL,
  `REA` text NOT NULL,
  `DT` datetime NOT NULL,
  `CL_ID` int(11) NOT NULL,
  `ACP` int(11) NOT NULL DEFAULT 0,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adeia`
--

INSERT INTO `adeia` (`ST_DATE`, `E_DATE`, `REA`, `DT`, `CL_ID`, `ACP`, `ID`) VALUES
('2021-05-11', '2021-05-19', 'Test', '2021-05-23 15:37:32', 36, 1, 32),
('2020-12-04', '2021-01-06', 'Test', '2021-05-23 15:38:32', 36, -1, 33),
('2021-06-21', '2021-06-30', 'Test', '2021-05-23 15:39:51', 36, 0, 34),
('2021-05-11', '2021-05-24', 'Test2', '2021-05-23 15:40:09', 37, 1, 35),
('2021-05-01', '2021-05-10', 'Test2', '2021-05-23 15:40:44', 37, -1, 36),
('2021-05-03', '2021-08-20', 'Test2', '2021-05-23 15:41:25', 37, 0, 37);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `create_datetime` datetime NOT NULL,
  `AUTH` tinyint(1) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `create_datetime`, `AUTH`, `fname`, `lname`) VALUES
(1, 'ageorge884@gmail.com', '202cb962ac59075b964b07152d234b70', '2021-05-18 18:56:35', 1, 'Georgios', 'Alexandris'),
(36, 'livadeias2@gmail.com', '202cb962ac59075b964b07152d234b70', '2021-05-23 15:35:59', 0, 'Employee', 'Two'),
(37, 'livadeias3@gmail.com', '202cb962ac59075b964b07152d234b70', '2021-05-23 15:37:02', 0, 'Employee', 'Three');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adeia`
--
ALTER TABLE `adeia`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adeia`
--
ALTER TABLE `adeia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
