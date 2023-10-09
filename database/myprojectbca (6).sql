-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2023 at 09:24 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myprojectbca`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(11) NOT NULL,
  `a_email` varchar(255) NOT NULL,
  `a_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `a_email`, `a_pass`) VALUES
(1, 'admin@prabhat.com', 'prabhat');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `b_id` int(11) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `preferred_date` date NOT NULL,
  `d_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`b_id`, `patient_name`, `email`, `preferred_date`, `d_id`) VALUES
(131, 'Sudip Sapkota', 'sudipsap43@gmail.com', '2023-08-25', 38),
(132, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-08-25', 1),
(134, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-08-26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `booking_history`
--

CREATE TABLE `booking_history` (
  `history_id` int(11) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `preferred_date` date NOT NULL,
  `completion_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('Completed','Absent') NOT NULL,
  `d_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_history`
--

INSERT INTO `booking_history` (`history_id`, `patient_name`, `email`, `preferred_date`, `completion_date`, `status`, `d_id`) VALUES
(34, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-08-18', '2023-08-14 08:24:15', 'Absent', 37),
(35, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-08-26', '2023-08-14 08:26:48', 'Absent', 37),
(37, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-08-25', '2023-08-14 08:34:14', 'Completed', 1),
(38, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-09-29', '2023-08-14 08:34:48', 'Absent', 37),
(39, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-08-17', '2023-08-14 08:35:58', 'Completed', 1),
(40, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-10-28', '2023-08-14 08:36:05', 'Absent', 37),
(41, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-09-30', '2023-08-14 08:36:12', 'Absent', 37),
(42, 'Sudip Sapkota', 'sudipsap43@gmail.com', '2023-08-18', '2023-08-14 08:40:06', 'Completed', 1),
(44, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-08-31', '2023-08-14 08:42:58', 'Absent', 37),
(45, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-08-24', '2023-08-14 08:48:37', 'Completed', 37),
(46, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-08-25', '2023-08-14 08:48:52', 'Completed', 37),
(47, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-08-26', '2023-08-14 08:49:08', 'Absent', 37),
(48, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-12-30', '2023-08-14 08:49:18', 'Absent', 37),
(49, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-08-14', '2023-08-14 08:50:53', 'Completed', 38),
(50, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-08-12', '2023-08-14 08:54:50', 'Completed', 38),
(51, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-08-26', '2023-08-14 08:55:23', 'Absent', 38),
(52, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-08-19', '2023-08-14 09:02:21', 'Completed', 37),
(53, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-08-25', '2023-08-14 09:06:15', 'Completed', 37),
(54, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-08-25', '2023-08-14 09:09:54', 'Absent', 37),
(55, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-08-30', '2023-08-14 09:11:53', 'Completed', 37),
(56, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2024-02-24', '2023-08-14 09:12:16', 'Completed', 38),
(57, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-08-19', '2023-08-14 09:14:09', 'Absent', 38),
(58, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-08-25', '2023-08-14 16:48:03', 'Absent', 37),
(59, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2024-01-04', '2023-08-14 21:13:29', 'Completed', 37),
(60, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-08-25', '2023-08-14 21:14:06', 'Completed', 38),
(61, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-09-08', '2023-08-14 21:14:13', 'Absent', 38),
(62, 'Sudip Sapkota', 'sudipsap43@gmail.com', '2023-08-24', '2023-08-20 11:13:53', 'Absent', 37),
(63, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-08-25', '2023-08-20 11:40:23', 'Completed', 37),
(64, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-08-31', '2023-08-20 13:13:26', 'Completed', 38),
(65, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', '2023-09-16', '2023-08-20 13:13:35', 'Absent', 38);

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_email` varchar(255) NOT NULL,
  `c_message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`c_id`, `c_name`, `c_email`, `c_message`) VALUES
(18, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', 'hello'),
(19, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', 'hello there'),
(20, 'Prabhat Ghimire', 'prabhatghimire77@gmail.com', 'hi'),
(22, 'Prabhat Ghimire', 'adboostingnepal@gmail.com', 'Hi'),
(27, 'Prabhat Ghimire', 'prabhatghimire99@gmail.co.', 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `d_id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `specialist` varchar(255) DEFAULT NULL,
  `doctor_password` varchar(255) DEFAULT NULL,
  `confirm_password` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`d_id`, `full_name`, `address`, `email`, `phone`, `specialist`, `doctor_password`, `confirm_password`, `image_path`) VALUES
(1, 'Subash Adhikari', 'Arunkhola-1', 'subadhikari1@gmail.com', '9787867834', 'Infectious Disease', '123', '123', '../doctor-images/subas.jpg'),
(37, 'Prabhat Ghimire', 'Bharatpur-25', 'prabhatghimire99@gmail.com', '9887892789', 'Dermatologist', '111', '111', '../doctor-images/20230106_153019.jpg'),
(38, 'Lalit Bhusal', 'Chitwan', 'labh_bca2077@lict.edu.np', '9742863845', 'Psychiatrist', '123', '123', '../doctor-images/129954249_379847489934659_927829944692388152_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `p_id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `confirm_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`p_id`, `full_name`, `address`, `email`, `phone`, `dob`, `password`, `confirm_password`) VALUES
(7, 'Ankit Marahatta', 'Bharatpur-11', 'ankitmarahatta90@gmail.com', '9867953160', '2001-12-23', '123', '123'),
(15, 'Prabhat Ghimire', 'Bharatpur', 'prabhatghimire77@gmail.com', '9742931621', '2023-05-01', '111', '111'),
(16, 'Sudip Sapkota', 'Gaindakot-15', 'sudipsap43@gmail.com', '9742353779', '2001-05-29', 'sudip123', 'sudip123'),
(18, 'Prabhat', 'Bharatpur, Narayani, Nepal', 'prgh_bca2077@lict.edu.np', '9742931621', '2002-05-04', '2002', '2002'),
(19, 'Bhojraj', 'Chitwan', 'bhojraj@gmail.com', '9898788221', '2023-04-05', '123', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`b_id`),
  ADD KEY `d_id` (`d_id`),
  ADD KEY `patient_name` (`patient_name`);

--
-- Indexes for table `booking_history`
--
ALTER TABLE `booking_history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`d_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`p_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `full_name` (`full_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `booking_history`
--
ALTER TABLE `booking_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
