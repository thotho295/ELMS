-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2020 at 07:39 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leaverequest`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'thaonguyen', 'ed24c188e3f2b96f260a3fb52ce48056', '2020-08-21 00:59:41'),
(2, 'quynh', '81dc9bdb52d04dc20036dbd8313ed055', '2020-08-25 16:28:02');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `EmpId` varchar(100) NOT NULL,
  `FullName` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `EmailId` varchar(200) NOT NULL,
  `Password` varchar(180) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `Dob` varchar(100) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Phonenumber` char(11) NOT NULL,
  `Status` int(1) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `EmpId`, `FullName`, `EmailId`, `Password`, `Gender`, `Dob`, `Address`, `Phonenumber`, `Status`, `RegDate`) VALUES
(1, '18001200', 'Nguyen Thu Thao', 'thaonguyen@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Female', '29 May, 2000', 'Thai Binh', '0882658686', 1, '2020-08-18 11:29:59'),
(2, '18001122', 'Nguyễn Thị Thu Hà', 'ha@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Female', '21 October, 2000', 'Gia Loc, Hai Duong', '0853529612', 1, '2020-08-19 11:40:02'),
(3, '18001181', 'Nghiem Thuy Quynh', 'quynh@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Female', '04 August, 2000', 'Minh Tan, Yen Lac, Vinh Phuc', '097567893', 1, '2020-08-19 12:51:31'),
(4, '18001111', 'Nguyen Thi Ha', 'haa@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Female', '13 August, 2020', 'Ha Noi', '098372818', 1, '2020-08-25 16:27:04');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `Id` int(11) NOT NULL,
  `LeaveType` varchar(110) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `EndDate` datetime NOT NULL,
  `StartDate` datetime NOT NULL,
  `Reason` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `AdminRemark` mediumtext DEFAULT NULL,
  `AdminRemarkDate` varchar(120) DEFAULT NULL,
  `Status` int(1) NOT NULL,
  `IsRead` int(1) NOT NULL,
  `empid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`Id`, `LeaveType`, `EndDate`, `StartDate`, `Reason`, `PostingDate`, `AdminRemark`, `AdminRemarkDate`, `Status`, `IsRead`, `empid`) VALUES
(13, 'Medical Leave Test', '2020-08-27 00:00:00', '2020-08-26 08:00:00', 'Benh dau da day tai phat nen toi can di kham', '2020-08-25 15:45:00', 'Ok, Please take care of yourself!', '2020-08-25 21:32:23 ', 1, 1, 3),
(14, 'Casual Leave', '2020-08-27 17:00:00', '2020-08-27 13:00:00', 'toi co viec ca nhan can giai quyet', '2020-08-25 16:12:36', 'ban nghi da qua so buoi cho phep', '2020-08-25 21:47:57 ', 2, 1, 2),
(15, 'Casual Leave', '2020-09-08 17:00:00', '2020-09-08 20:00:00', 'hom nay toi met', '2020-08-25 16:15:07', NULL, NULL, 0, 0, 2),
(16, 'Medical Leave Test', '2020-09-23 17:00:00', '2020-09-23 08:00:00', 'toi di tu vung dich ve nen can kiem tra y te', '2020-08-25 16:17:03', NULL, NULL, 0, 0, 1),
(17, 'Casual Leave', '2020-09-17 00:00:00', '2020-09-16 13:00:00', 'gia dinh co viec ơ que can ve gap', '2020-08-25 16:20:37', NULL, NULL, 0, 0, 3),
(18, 'Medical Leave Test', '2020-08-27 17:00:00', '2020-08-26 00:00:00', 'hom nay toi cam thay khong khoe, toi can di kiem tra y te', '2020-08-25 16:24:05', 'ok, hay giu gin suc khoe', '2020-08-25 21:55:44 ', 1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `leavetype`
--

CREATE TABLE `leavetype` (
  `id` int(11) NOT NULL,
  `LeaveType` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Description` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leavetype`
--

INSERT INTO `leavetype` (`id`, `LeaveType`, `Description`, `CreationDate`) VALUES
(1, 'Casual Leave', 'Nghi co luong', '2020-08-20 00:08:56'),
(2, 'Medical Leave Test', 'Nghi co luong', '2020-08-20 00:10:09'),
(3, 'Restricted Holiday', 'Nghi phep khong luong', '2020-08-20 00:11:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UserEmail` (`empid`);

--
-- Indexes for table `leavetype`
--
ALTER TABLE `leavetype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `leavetype`
--
ALTER TABLE `leavetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
