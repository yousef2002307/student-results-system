-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2022 at 08:43 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `srms2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admintable`
--

CREATE TABLE `admintable` (
  `id` int(11) NOT NULL,
  `adimnname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admintable`
--

INSERT INTO `admintable` (`id`, `adimnname`, `password`, `email`, `fullname`) VALUES
(1, 'yousef', '2e8c0277e396fabf683e56c8b7fa7e6dad68c679', 'mmnwat6@gmail.com', 'yousef ahmed');

-- --------------------------------------------------------

--
-- Table structure for table `classess`
--

CREATE TABLE `classess` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `adding_date` date NOT NULL,
  `numofclass` int(11) NOT NULL,
  `sectionofclass` char(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classess`
--

INSERT INTO `classess` (`class_id`, `class_name`, `adding_date`, `numofclass`, `sectionofclass`, `status`) VALUES
(2, 'first', '2021-12-20', 2, 'a', 1),
(9, 'sixth', '2021-12-20', 12, 'e', 1),
(10, 'seconed', '2021-12-20', 10, 'b', 1),
(11, 'third', '2022-01-04', 7, 'b', 1);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `classid` int(11) NOT NULL,
  `subjectid` int(11) NOT NULL,
  `marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `studentid`, `classid`, `subjectid`, `marks`) VALUES
(9, 5, 9, 4, 54),
(10, 5, 9, 7, 45),
(37, 1, 2, 1, 34),
(38, 1, 2, 7, 100),
(39, 1, 2, 8, 88),
(40, 1, 2, 4, 99),
(49, 3, 10, 7, 92),
(54, 4, 2, 1, 21),
(55, 4, 2, 7, 33),
(56, 4, 2, 8, 100),
(57, 4, 2, 4, 87),
(70, 7, 10, 7, 66),
(71, 6, 2, 1, 55),
(72, 6, 2, 7, 55),
(73, 6, 2, 8, 55),
(74, 6, 2, 4, 55);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `Rollid` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `classid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `Rollid`, `email`, `gender`, `classid`, `status`) VALUES
(1, 'yousef', 3332, 'mmnwat@gmail.com', 'male', 2, 1),
(3, 'samira', 34345, 'yousif20022008@yahoo.com', 'female', 10, 0),
(4, 'sami', 32234, 'yousif20022008@yahoo.com', 'male', 2, 1),
(5, 'weal', 454611, 'yousif20022008@yahoo.com', 'female', 9, 1),
(6, 'samier2', 23456, 'yousif20022008@yahoo.com', 'female', 2, 1),
(7, 'elsayed', 53443, 'yousif20022008@yahoo.com', 'male', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjectcombination`
--

CREATE TABLE `subjectcombination` (
  `id` int(11) NOT NULL,
  `subjectid` int(11) NOT NULL,
  `classid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `adding_date` date NOT NULL,
  `updating_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjectcombination`
--

INSERT INTO `subjectcombination` (`id`, `subjectid`, `classid`, `status`, `adding_date`, `updating_date`) VALUES
(1, 1, 2, 0, '2022-01-02', '0000-00-00'),
(2, 4, 9, 1, '2022-01-15', '0000-00-00'),
(3, 7, 10, 1, '2022-01-15', '0000-00-00'),
(4, 2, 11, 1, '2022-01-15', '0000-00-00'),
(5, 7, 2, 1, '2022-01-15', '0000-00-00'),
(6, 8, 2, 1, '2022-01-15', '0000-00-00'),
(7, 4, 2, 1, '2022-01-15', '0000-00-00'),
(8, 7, 9, 1, '2022-01-30', '0000-00-00'),
(88, 2, 11, 1, '2022-01-10', '2022-01-12');

-- --------------------------------------------------------

--
-- Table structure for table `subjecttable`
--

CREATE TABLE `subjecttable` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `adding_date` date NOT NULL,
  `updated_date` date NOT NULL,
  `subjectcode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjecttable`
--

INSERT INTO `subjecttable` (`subject_id`, `subject_name`, `status`, `adding_date`, `updated_date`, `subjectcode`) VALUES
(1, 'math2', 1, '2022-01-03', '2022-01-14', 'HRE32453'),
(2, 'arabic', 1, '2022-01-07', '2022-01-14', 'FGH5644'),
(4, 'logic design', 1, '2022-01-07', '0000-00-00', 'HHH2'),
(7, 'music', 1, '2022-01-07', '0000-00-00', 'FHFJ5'),
(8, 'logic', 1, '2022-01-08', '0000-00-00', 'SDA5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admintable`
--
ALTER TABLE `admintable`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `adimnname` (`adimnname`);

--
-- Indexes for table `classess`
--
ALTER TABLE `classess`
  ADD PRIMARY KEY (`class_id`),
  ADD UNIQUE KEY `34erre4e` (`numofclass`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`,`Rollid`);

--
-- Indexes for table `subjectcombination`
--
ALTER TABLE `subjectcombination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjecttable`
--
ALTER TABLE `subjecttable`
  ADD PRIMARY KEY (`subject_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admintable`
--
ALTER TABLE `admintable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `classess`
--
ALTER TABLE `classess`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subjectcombination`
--
ALTER TABLE `subjectcombination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `subjecttable`
--
ALTER TABLE `subjecttable`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
