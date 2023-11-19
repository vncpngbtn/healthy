-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2023 at 12:50 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dssh_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `patient_users`
--

CREATE TABLE `patient_users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `address` varchar(200) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `p_number` int(100) NOT NULL,
  `gmail` varchar(100) NOT NULL,
  `patient_password` varchar(255) NOT NULL,
  `registration_date` datetime NOT NULL,
  `id_path` varchar(500) NOT NULL,
  `verified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `patient_users`
--

INSERT INTO `patient_users` (`id`, `first_name`, `middle_name`, `last_name`, `address`, `zip_code`, `p_number`, `gmail`, `patient_password`, `registration_date`, `id_path`, `verified_at`) VALUES
(4, 'Crystal Kaye', 'P', 'Pronda', 'E.Garcia St. Purok5 Brgy Alua', 3106, 2147483647, 'crystalkayepronda088@gmail.com', '$2y$10$CK.RCnBizUWypOQEji4d3.s4ZeFeyHkKvbrt1WAAob1jGyUerHqXO', '0000-00-00 00:00:00', '', '2023-11-19 10:29:24'),
(5, 'Crystal Kaye', 'K', 'Pronda', 'E.Garcia St. Purok5 Brgy Alua', 3106, 2147483647, 'crystalkayepronda08@gmail.com', '$2y$10$zQY8XpNKo.wDr.u5DovpreCJ62hLSoC.S0nB.W1Y/ITm.asjn/4.C', '0000-00-00 00:00:00', '', '2023-11-19 09:29:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patient_users`
--
ALTER TABLE `patient_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patient_users`
--
ALTER TABLE `patient_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
