-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 14, 2023 at 08:00 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `crud`
--

CREATE TABLE `crud` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `age` int(5) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `image_name` blob NOT NULL,
  `resume_name` blob NOT NULL,
  `dob` date DEFAULT NULL,
  `nationality` varchar(255) NOT NULL,
  `languages` varchar(255) NOT NULL,
  `skills` text NOT NULL,
  `work_experience` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `social_profiles` varchar(255) NOT NULL,
  `portfolio_url` varchar(255) NOT NULL,
  `availability` varchar(255) NOT NULL,
  `salary_expectation` varchar(255) NOT NULL,
  `interests` text NOT NULL,
  `certifications` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crud`
--

INSERT INTO `crud` (`id`, `name`, `phone`, `email`, `qualification`, `age`, `gender`, `address`, `image_name`, `resume_name`, `dob`, `nationality`, `languages`, `skills`, `work_experience`, `reference`, `social_profiles`, `portfolio_url`, `availability`, `salary_expectation`, `interests`, `certifications`) VALUES
(25, 'badman', '7896545678', 'batman@gmail.com', 'BCA', 19, 'Male', 'banglore', '', '', NULL, '', '', '', '', '', '', '', '', '', '', ''),
(26, 'kiana', '7896789678', 'kiana@gmail.com', 'NURSARY', 3, 'Female', 'kolar', '', '', NULL, '', '', '', '', '', '', '', '', '', '', ''),
(28, 'eleven', '7897689786', 'eleven@gmail.com', 'LLB', 24, 'Female', 'usa', '', '', NULL, '', '', '', '', '', '', '', '', '', '', ''),
(41, 'aishwarya', '8431367478', 'aishwarya.ms46@gmail.com', 'be', 22, 'Female', 'Amaravathi nagar  bangarpet', 0x70686f746f2e6a706567, 0x63762e706466, NULL, '', '', '', '', '', '', '', '', '', '', ''),
(42, 'aishwarya', '8431367478', 'aishwarya.ms46@gmail.com', 'be', 22, 'Female', 'Amaravathi nagar  bangarpet', 0x6d792070686f746f2e6a7067, 0x4356312e706466, '2001-06-06', 'Indian', 'hindi,english,kannada,telugu,tamil', 'python, html ,css, mysql ,php ', 'fresher', 'na', '-', '-', 'Full-time', '4lpa', 'swimming, sketching, workout', 'complete python bootcamp from zero to hero from udemy'),
(44, 'tokyo', '5678907890', 'tokyo@gmail.com', 'money heist', 24, 'Female', 'tokyo', 0x70686f746f2e6a706567, 0x616468617220636172642e6a7067, '2000-09-09', 'british', 'english', 'piracy', 'NA', 'im my own boss', 'NA', 'NA', 'Full-time', '1cr', 'NA', 'NA'),
(45, 'doraemon', '7897678999', 'doraemon@gmail.com', 'robotics', 6, 'Male', 'japan', 0x646f7261656d6f6e2e706e67, 0x64726573756d652e706466, '2005-07-07', 'robot', 'multi languages', 'gadgets experiments', '1year', 'scientist', 'doraemon.com', 'www.doaremon.com', 'Full-time', '20CR', 'like to eat Doracakes', 'course: How to not fear from mouse'),
(46, 'shinchan', '8907678909', 'shinchan@gmail.com', 'school', 5, 'Male', 'japan', 0x7368696e6368616e2e706e67, 0x7368696e6368616e2e706e67, '2015-05-05', 'japanese', 'japanese', 'art', 'fresher', 'NA', 'NA', 'NA', 'Full-time', '4lpa', 'sleeping', 'na');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirmpassword` varchar(255) NOT NULL,
  `user_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`username`, `email`, `password`, `confirmpassword`, `user_type`) VALUES
('eleven', 'eleven@gmail.com', 'eleven1234', 'eleven1234', 'user'),
('Aishwarya', 'aishwarya@gmail.com', 'Aish1234', 'Aish1234', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crud`
--
ALTER TABLE `crud`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crud`
--
ALTER TABLE `crud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
