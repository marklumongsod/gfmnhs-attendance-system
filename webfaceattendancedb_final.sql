-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 02:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webfaceattendancedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendances`
--

CREATE TABLE `tbl_attendances` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL,
  `attendance_uid` varchar(100) NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_attendances`
--

INSERT INTO `tbl_attendances` (`id`, `student_id`, `time_in`, `time_out`, `attendance_uid`, `updated_at`, `created_at`) VALUES
(2, 4, '08:12:00', '20:12:00', 'asd', '2024-02-17 00:27:57', '2023-11-17 08:11:01'),
(3, 4, '08:06:00', '20:06:00', 'D8BBC1DBA239', '2024-02-17 00:27:53', '2024-02-17 08:27:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class`
--

CREATE TABLE `tbl_class` (
  `id` int(11) NOT NULL,
  `facId` int(11) NOT NULL,
  `grade` varchar(50) NOT NULL,
  `section` text NOT NULL,
  `subject` varchar(255) NOT NULL DEFAULT 'Science',
  `start` text NOT NULL,
  `end` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `classyr` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_class`
--

INSERT INTO `tbl_class` (`id`, `facId`, `grade`, `section`, `subject`, `start`, `end`, `status`, `classyr`) VALUES
(7, 2, 'Grade 10', 'Aguinaldo', 'English', '07:00', '08:00', 'Active', '2024'),
(8, 11, 'Grade 7', 'Kamagong', 'Filipino', '09:00', '10:00', 'Active', '2024'),
(9, 2, 'Grade 10', 'Rizal', 'English', '09:00', '10:00', 'Active', '2024'),
(10, 13, 'Grade 9', 'Mangga', 'English', '10:00', '11:00', 'Active', '2024'),
(12, 2, 'Grade 10', 'Rizal', 'Math', '07:00', '08:00', 'Active', '2023'),
(15, 11, 'Grade 7', 'Acasia', 'English', '07:00', '08:00', 'Active', '2023'),
(16, 14, 'Grade 7', 'Molave', 'Math', '08:00', '09:00', 'Active', '2023'),
(19, 13, 'Grade 10', 'Rizal', 'Math', '10:00', '11:00', 'Active', '2023');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_classstudent`
--

CREATE TABLE `tbl_classstudent` (
  `id` int(11) NOT NULL,
  `classId` int(11) NOT NULL,
  `studId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_classstudent`
--

INSERT INTO `tbl_classstudent` (`id`, `classId`, `studId`) VALUES
(5, 7, 13),
(8, 8, 8),
(9, 9, 11),
(7, 9, 12),
(14, 11, 20),
(94, 11, 23),
(104, 11, 24),
(25, 12, 12),
(26, 12, 17),
(163, 12, 25),
(176, 12, 567),
(184, 12, 609),
(185, 12, 610),
(189, 12, 623),
(32, 13, 11),
(122, 15, 21),
(157, 19, 12),
(158, 19, 17),
(166, 19, 25);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inout`
--

CREATE TABLE `tbl_inout` (
  `id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `classId` int(11) NOT NULL,
  `xdate` date DEFAULT NULL,
  `xtime` time DEFAULT NULL,
  `status` varchar(50) NOT NULL COMMENT 'In,Out',
  `details` varchar(255) NOT NULL,
  `io_uid` varchar(100) NOT NULL,
  `attendance_uid` varchar(100) NOT NULL,
  `class_status` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_inout`
--

INSERT INTO `tbl_inout` (`id`, `stud_id`, `classId`, `xdate`, `xtime`, `status`, `details`, `io_uid`, `attendance_uid`, `class_status`, `created_at`) VALUES
(69, 17, 12, '2024-04-20', '11:42:21', 'PRESENT', '202312340004', 'E00AF6BE1245', '', '', '2024-04-20 11:42:21'),
(70, 12, 12, '2024-04-20', '11:42:49', 'LATE', '202312340002', 'E00AF6BE1245', '', '', '2024-04-20 11:42:49'),
(73, 621, 0, '2024-04-29', '00:30:03', 'PRESENT', '123456789012', '3C970E6F893D', '', '', '2024-04-29 00:30:03'),
(78, 11, 0, '2024-04-29', '00:43:34', 'PRESENT', '202312340003', '3C970E6F893D', '', '', '2024-04-29 00:43:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings_constants`
--

CREATE TABLE `tbl_settings_constants` (
  `id` int(11) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  `sub_value` varchar(100) DEFAULT NULL,
  `adviser` varchar(250) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_settings_constants`
--

INSERT INTO `tbl_settings_constants` (`id`, `category`, `value`, `sub_value`, `adviser`, `description`) VALUES
(1, 'Status', 'Pending', NULL, '', ''),
(2, 'Status', 'Cancelled', NULL, '', ''),
(3, 'Status', 'Completed', NULL, '', ''),
(4, 'Status', 'Approved', NULL, '', ''),
(6, 'User Type', 'Admin', NULL, '', ''),
(11, 'Gender', 'Male', NULL, '', ''),
(12, 'Gender', 'Female', '', '', ''),
(14, 'Report Type', 'Students', NULL, '', ''),
(15, 'User Type1', 'Student', '', '', ''),
(23, 'Section', 'Kamagong', 'Grade 7', '', ''),
(24, 'Section', 'Narra', 'Grade 7', '', ''),
(25, 'User Type', 'Teacher', NULL, '', ''),
(34, 'Subject', 'Math', '', '', ''),
(35, 'Section', 'Acasia', 'Grade 7', '', ''),
(36, 'Subject', 'Science', '', '', ''),
(37, 'Subject', 'English', '', '', ''),
(38, 'Subject', 'Filipino', '', '', ''),
(39, 'Subject', 'MAPEH', '', '', ''),
(40, 'Section', 'Abokado', 'Grade 8', '', ''),
(41, 'Section', 'Langka', 'Grade 8', '', ''),
(42, 'Section', 'Mangga', 'Grade 8', '', ''),
(43, 'Section', 'Mabait', 'Grade 9', '', ''),
(44, 'Section', 'Magalang', 'Grade 9', '', ''),
(45, 'Section', 'Mapagmahal', 'Grade9', '', ''),
(46, 'Section', 'Rizal', 'Grade 10', 'Ella Garcia', ''),
(47, 'Section', 'Aguinaldo', 'Grade 10', '', ''),
(48, 'Section', 'Mabini', 'Grade 10', '', ''),
(49, 'Grade', 'Grade 7', '', '', ''),
(50, 'Grade', 'Grade 8', '', '', ''),
(51, 'Grade', 'Grade 9', '', '', ''),
(52, 'Grade', 'Grade 10', '', '', ''),
(53, 'Section', 'Molave', 'Grade 7', 'Mulawin Angular', ''),
(57, 'Section ', 'Manggahan', 'Grade 10', 'Anna M', ''),
(58, 'Section', 'Saging', 'Grade 10', 'Mark Lumongsod', ''),
(59, 'Section ', 'Santol', 'Grade 10', 'George William', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

CREATE TABLE `tbl_students` (
  `id` int(11) NOT NULL,
  `studNo` text NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `mname` text NOT NULL,
  `bday` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `contact` text NOT NULL,
  `address` text NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `section` text NOT NULL,
  `gr_yr` varchar(50) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `pic` varchar(255) NOT NULL DEFAULT 'default.png',
  `trackFace` varchar(255) NOT NULL DEFAULT '0',
  `TrainedFaces` varchar(255) NOT NULL,
  `logStatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_students`
--

INSERT INTO `tbl_students` (`id`, `studNo`, `fname`, `lname`, `mname`, `bday`, `age`, `username`, `password`, `email`, `contact`, `address`, `gender`, `section`, `gr_yr`, `status`, `pic`, `trackFace`, `TrainedFaces`, `logStatus`) VALUES
(11, '202312340003', 'Juan', 'Dela Cruz', 'S.', '', 0, 'juandelacruz@yahoo.com', 'd3f@auLt2023', 'juandelacruz@yahoo.com', '09123456789', 'Cavite', 'Male', 'Mangga', 'Grade 8', 'Active', 'default.png', 'System.Byte[]', '15', 'PRESENT'),
(12, '202312340002', 'Rachel', 'Salera', 'Monahan', '', 0, 'rachelmaesalera@yahoo.com', 'd3f@auLt2023', 'rachelmaesalera@yahoo.com', '091112223333', 'cavite', 'Female', 'Rizal', 'Grade 10', 'Active', 'default.png', 'System.Byte[]', '6', 'PRESENT'),
(13, '202312340001', 'Josh Carl Anthony', 'Javier', 'Rovelo', '', 0, 'joshcarl@yahoo.com', 'd3f@auLt2023', 'joshcarl@yahoo.com', '09111223440', '115 POOC II SILANG CAVITE', 'Male', 'Aguinaldo', 'Grade 10', 'Active', 'default.png', '', '0', 'IN'),
(17, '202312340004', 'Mary Rose', 'Magdaraog', 'Aco', '', 0, 'maryrosemagdaraog@yahoo.com', 'd3f@auLt2023', 'maryrosemagdaraog@yahoo.com', '09121111111', 'Cavite', 'Female', 'Rizal', 'Grade 10', 'Active', 'default.png', 'System.Byte[]', '3', 'PRESENT'),
(20, '202312340005', 'John', 'Santos', 'Garcia', '', 0, 'johnsantos@yahoo.com', 'd3f@auLt2023', 'johnsantos@yahoo.com', '09111223444', 'Cavite', 'Male', 'Kamagong', 'Grade 7', 'Active', 'default.png', '', '0', ''),
(21, '202312340006', 'Lyza', 'Hernandez', 'Santos', '', 0, 'lyzahernandez@yahoo.com', 'd3f@auLt2023', 'lyzahernandez@yahoo.com', '09111223447', 'Cavite', 'Female', 'Acasia', 'Grade 7', 'Active', 'default.png', '0', '', ''),
(22, '202312340007', 'Remy', 'Reyes', 'Santos', '', 0, 'remyreyes@yahoo.com', 'd3f@auLt2023', 'remyreyes@yahoo.com', '09111223423', 'Cavite', 'Female', 'Abokado', 'Grade 8', 'Active', 'default.png', '0', '', ''),
(23, '202312340008', 'Arthur', 'Reyes', 'Mendoza', '', 0, 'arthurreyes@yahoo.com', 'd3f@auLt2023', 'arthurreyes@yahoo.com', '09135725782', 'Cavite', 'Male', 'Kamagong', 'Grade 7', 'Active', 'default.png', '0', '', ''),
(24, '202312340009', 'Rey', 'Mendoza', 'Garcia', '', 0, 'reymendoza@yahoo.com', 'd3f@auLt2023', 'reymendoza@yahoo.com', '09876544333', 'Cavite', 'Male', 'Kamagong', 'Grade 7', 'Active', 'default.png', '0', '', ''),
(25, '202312340010', 'Mikha', 'Lopez', 'Mendoza', '', 0, 'mikhalopez@gmail.com', 'd3f@auLt2023', 'mikhalopez@gmail.com', '09785372736', 'Cavite', 'Female', 'Rizal', 'Grade 10', 'Active', 'default.png', '0', '', ''),
(622, '230001', 'test', 'test', 'mna', '1/11/1993', 26, 'mikhalopez@gmail.com', 'd3f@auLt2023', 'testmail', '965653234', 'address123', 'Male', 'Mangga', 'Grade 8', 'Active', 'default.png', '0', '', ''),
(623, '23', 'teste3', 'test3', 'sss', '1/11/1993', 22, 'mikhalopez@gmail.com', 'd3f@auLt2023', 'testmail', '965653234', 'asasas', 'Female', 'Rizal', 'Grade 10', 'Active', 'default.png', '0', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ualt`
--

CREATE TABLE `tbl_ualt` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` text NOT NULL,
  `action` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_ualt`
--

INSERT INTO `tbl_ualt` (`id`, `user_id`, `type`, `action`, `created_at`) VALUES
(1, 1, 'Admin', 'Logout', '2023-11-17 06:53:46'),
(2, 10, 'Student', 'Login', '2023-11-17 07:07:28'),
(3, 1, 'Admin', 'Login', '2023-11-17 07:10:17'),
(4, 1, 'Admin', 'Login', '2023-11-17 07:19:21'),
(5, 1, 'Admin', 'Logout', '2023-11-17 07:39:15'),
(6, 1, 'Admin', 'Login', '2023-11-17 07:39:21'),
(7, 1, 'Admin', 'Logout', '2023-11-17 08:15:18'),
(8, 2, 'Teacher', 'Login', '2023-11-17 08:15:24'),
(9, 1, 'Admin', 'Logout', '2023-11-17 08:21:49'),
(10, 2, 'Teacher', 'Login', '2023-11-17 08:21:57'),
(11, 2, 'Teacher', 'Logout', '2023-11-17 08:23:10'),
(12, 1, 'Admin', 'Login', '2023-11-17 08:23:12'),
(13, 2, 'Teacher', 'Logout', '2023-11-17 08:23:22'),
(14, 1, 'Admin', 'Login', '2023-11-17 08:23:28'),
(15, 1, 'Admin', 'Logout', '2023-11-17 08:31:18'),
(16, 1, 'Admin', 'Login', '2023-11-17 08:31:32'),
(17, 1, 'Admin', 'Logout', '2023-11-17 08:31:34'),
(18, 1, 'Admin', 'Login', '2023-11-17 00:43:58'),
(19, 1, 'Admin', 'Login', '2023-11-17 04:36:05'),
(20, 1, 'Admin', 'Logout', '2023-11-17 04:39:35'),
(21, 2, 'Teacher', 'Login', '2023-11-17 04:39:45'),
(22, 10, 'Student', 'Logout', '2023-11-17 04:42:56'),
(23, 1, 'Admin', 'Login', '2023-11-17 04:43:15'),
(24, 1, 'Admin', 'Login', '2023-11-17 04:51:14'),
(25, 10, 'Student', 'Logout', '2023-11-17 04:53:08'),
(26, 2, 'Teacher', 'Login', '2023-11-17 04:53:45'),
(27, 1, 'Admin', 'Login', '2023-11-20 07:30:35'),
(28, 1, 'Admin', 'Login', '2023-12-19 03:06:30'),
(29, 2, 'Teacher', 'Login', '2023-12-19 03:08:12'),
(30, 2, 'Teacher', 'Logout', '2023-12-19 03:08:44'),
(31, 1, 'Admin', 'Login', '2023-12-19 03:08:51'),
(32, 1, 'Admin', 'Login', '2023-12-22 16:26:02'),
(33, 1, 'Admin', 'Login', '2023-12-27 15:20:32'),
(34, 1, 'Admin', 'Login', '2024-01-04 05:25:55'),
(35, 1, 'Admin', 'Login', '2024-01-07 08:20:32'),
(36, 1, 'Admin', 'Logout', '2024-01-07 08:50:43'),
(37, 2, 'Teacher', 'Login', '2024-01-07 08:50:59'),
(38, 2, 'Teacher', 'Logout', '2024-01-07 08:57:55'),
(39, 12, 'Student', 'Login', '2024-01-07 08:59:08'),
(40, 12, 'Student', 'Logout', '2024-01-07 09:03:25'),
(41, 1, 'Admin', 'Login', '2024-01-07 09:03:50'),
(42, 1, 'Admin', 'Login', '2024-01-08 17:28:10'),
(43, 1, 'Admin', 'Login', '2024-01-09 03:41:19'),
(44, 1, 'Admin', 'Login', '2024-01-09 12:28:45'),
(45, 1, 'Admin', 'Logout', '2024-01-09 12:31:23'),
(46, 2, 'Teacher', 'Login', '2024-01-09 12:31:34'),
(47, 2, 'Teacher', 'Logout', '2024-01-09 12:32:03'),
(48, 1, 'Admin', 'Login', '2024-01-09 12:32:07'),
(49, 1, 'Admin', 'Login', '2024-01-09 13:25:58'),
(50, 1, 'Admin', 'Logout', '2024-01-09 13:31:07'),
(51, 2, 'Teacher', 'Login', '2024-01-09 13:31:23'),
(52, 12, 'Student', 'Login', '2024-01-09 13:32:23'),
(53, 1, 'Admin', 'Login', '2024-01-10 01:28:45'),
(54, 1, 'Admin', 'Login', '2024-01-10 01:33:27'),
(55, 1, 'Admin', 'Login', '2024-01-10 01:34:08'),
(56, 1, 'Admin', 'Login', '2024-01-10 02:00:15'),
(57, 12, 'Student', 'Login', '2024-01-10 02:00:55'),
(58, 2, 'Teacher', 'Login', '2024-01-10 02:02:42'),
(59, 1, 'Admin', 'Login', '2024-01-10 02:03:25'),
(60, 1, 'Admin', 'Login', '2024-01-10 08:01:25'),
(61, 1, 'Admin', 'Login', '2024-01-11 08:01:23'),
(62, 2, 'Teacher', 'Login', '2024-01-11 08:01:52'),
(63, 2, 'Teacher', 'Logout', '2024-01-11 08:02:13'),
(64, 1, 'Admin', 'Login', '2024-01-11 08:02:28'),
(65, 1, 'Admin', 'Login', '2024-01-11 11:53:12'),
(66, 10, 'Student', 'Logout', '2024-01-11 12:00:45'),
(67, 1, 'Admin', 'Login', '2024-01-15 04:32:06'),
(68, 1, 'Admin', 'Logout', '2024-01-15 05:25:03'),
(69, 1, 'Admin', 'Login', '2024-01-15 05:25:10'),
(70, 1, 'Admin', 'Login', '2024-01-15 05:46:28'),
(71, 1, 'Admin', 'Login', '2024-01-15 09:45:23'),
(72, 1, 'Admin', 'Login', '2024-01-15 09:46:20'),
(73, 1, 'Admin', 'Login', '2024-01-15 12:07:20'),
(74, 1, 'Admin', 'Logout', '2024-01-15 12:09:09'),
(75, 1, 'Admin', 'Login', '2024-01-15 12:13:05'),
(76, 1, 'Admin', 'Logout', '2024-01-15 12:13:43'),
(77, 1, 'Admin', 'Login', '2024-01-15 12:16:18'),
(78, 1, 'Admin', 'Login', '2024-01-15 13:29:12'),
(79, 1, 'Admin', 'Login', '2024-01-15 13:56:51'),
(80, 1, 'Admin', 'Login', '2024-01-15 23:07:45'),
(81, 1, 'Admin', 'Login', '2024-01-17 03:01:54'),
(82, 1, 'Admin', 'Logout', '2024-01-17 03:53:02'),
(83, 1, 'Admin', 'Login', '2024-01-17 03:53:07'),
(84, 1, 'Admin', 'Login', '2024-01-23 02:44:56'),
(85, 1, 'Admin', 'Login', '2024-01-23 04:40:46'),
(86, 1, 'Admin', 'Login', '2024-01-23 11:34:36'),
(87, 1, 'Admin', 'Logout', '2024-01-23 12:49:14'),
(88, 2, 'Teacher', 'Login', '2024-01-23 12:49:21'),
(89, 2, 'Teacher', 'Logout', '2024-01-23 13:01:49'),
(90, 1, 'Admin', 'Login', '2024-01-23 13:01:56'),
(91, 1, 'Admin', 'Login', '2024-02-06 14:07:29'),
(92, 1, 'Admin', 'Login', '2024-02-15 00:01:56'),
(93, 1, 'Admin', 'Login', '2024-02-15 00:02:27'),
(94, 1, 'Admin', 'Login', '2024-03-05 15:15:45'),
(95, 1, 'Admin', 'Login', '2024-03-11 07:20:55'),
(96, 1, 'Admin', 'Login', '2024-03-11 13:05:36'),
(97, 1, 'Admin', 'Login', '2024-03-12 12:37:12'),
(98, 1, 'Admin', 'Login', '2024-03-12 13:27:11'),
(99, 1, 'Admin', 'Login', '2024-03-13 13:19:47'),
(100, 1, 'Admin', 'Login', '2024-03-13 22:13:20'),
(101, 1, 'Admin', 'Login', '2024-03-15 19:54:48'),
(102, 1, 'Admin', 'Login', '2024-03-16 11:54:20'),
(103, 2, 'Teacher', 'Login', '2024-03-16 12:10:36'),
(104, 1, 'Admin', 'Login', '2024-03-16 12:11:23'),
(105, 1, 'Admin', 'Login', '2024-03-16 12:24:21'),
(106, 13, 'Teacher', 'Login', '2024-03-16 12:26:51'),
(107, 1, 'Admin', 'Login', '2024-03-16 12:29:06'),
(108, 1, 'Admin', 'Login', '2024-03-16 12:31:03'),
(109, 1, 'Admin', 'Login', '2024-03-16 12:48:59'),
(110, 1, 'Admin', 'Login', '2024-03-18 21:34:44'),
(111, 1, 'Admin', 'Logout', '2024-03-18 22:00:23'),
(112, 2, 'Teacher', 'Login', '2024-03-18 22:00:39'),
(113, 2, 'Teacher', 'Logout', '2024-03-18 22:09:17'),
(114, 1, 'Admin', 'Login', '2024-03-18 22:11:53'),
(115, 1, 'Admin', 'Login', '2024-03-18 22:48:45'),
(116, 1, 'Admin', 'Login', '2024-03-18 23:27:24'),
(117, 1, 'Admin', 'Login', '2024-03-19 00:00:58'),
(118, 1, 'Admin', 'Logout', '2024-03-19 00:26:40'),
(119, 13, 'Teacher', 'Login', '2024-03-19 00:27:12'),
(120, 13, 'Teacher', 'Logout', '2024-03-19 00:27:53'),
(121, 2, 'Teacher', 'Login', '2024-03-19 00:28:18'),
(122, 1, 'Admin', 'Login', '2024-03-19 00:29:52'),
(123, 1, 'Admin', 'Login', '2024-03-19 19:52:13'),
(124, 1, 'Admin', 'Logout', '2024-03-19 19:56:40'),
(125, 2, 'Teacher', 'Login', '2024-03-19 19:56:47'),
(126, 2, 'Teacher', 'Logout', '2024-03-19 20:00:26'),
(127, 1, 'Admin', 'Login', '2024-03-19 20:05:13'),
(128, 1, 'Admin', 'Login', '2024-03-19 21:58:47'),
(129, 12, 'Student', 'Login', '2024-03-19 22:00:46'),
(130, 12, 'Student', 'Logout', '2024-03-19 22:03:25'),
(131, 2, 'Teacher', 'Login', '2024-03-19 22:03:40'),
(132, 2, 'Teacher', 'Logout', '2024-03-19 22:11:11'),
(133, 2, 'Teacher', 'Login', '2024-03-19 22:11:39'),
(134, 12, 'Student', 'Login', '2024-03-19 22:23:59'),
(135, 12, 'Student', 'Logout', '2024-03-19 22:30:01'),
(136, 1, 'Admin', 'Login', '2024-03-19 22:30:08'),
(137, 2, 'Teacher', 'Login', '2024-03-19 23:24:57'),
(138, 1, 'Admin', 'Login', '2024-03-19 23:26:11'),
(139, 1, 'Admin', 'Logout', '2024-03-19 23:31:19'),
(140, 13, 'Teacher', 'Login', '2024-03-19 23:31:44'),
(141, 13, 'Teacher', 'Logout', '2024-03-19 23:32:58'),
(142, 1, 'Admin', 'Login', '2024-03-19 23:33:05'),
(143, 1, 'Admin', 'Logout', '2024-03-19 23:36:18'),
(144, 14, 'Teacher', 'Login', '2024-03-19 23:36:29'),
(145, 14, 'Teacher', 'Logout', '2024-03-19 23:36:44'),
(146, 1, 'Admin', 'Login', '2024-03-19 23:36:51'),
(147, 1, 'Admin', 'Logout', '2024-03-20 00:04:16'),
(148, 11, 'Student', 'Login', '2024-03-20 00:04:46'),
(149, 11, 'Student', 'Logout', '2024-03-20 00:05:11'),
(150, 1, 'Admin', 'Login', '2024-03-20 00:05:29'),
(151, 1, 'Admin', 'Login', '2024-03-20 00:14:41'),
(152, 1, 'Admin', 'Login', '2024-03-20 10:13:23'),
(153, 1, 'Admin', 'Login', '2024-03-20 10:24:19'),
(154, 1, 'Admin', 'Logout', '2024-03-20 10:36:13'),
(155, 1, 'Admin', 'Login', '2024-03-20 10:36:52'),
(156, 1, 'Admin', 'Logout', '2024-03-20 10:42:47'),
(157, 1, 'Admin', 'Login', '2024-03-20 10:44:07'),
(158, 1, 'Admin', 'Logout', '2024-03-20 10:55:54'),
(159, 11, 'Teacher', 'Login', '2024-03-20 10:57:04'),
(160, 1, 'Admin', 'Login', '2024-03-20 11:01:44'),
(161, 1, 'Admin', 'Login', '2024-03-20 11:02:44'),
(162, 1, 'Admin', 'Logout', '2024-03-20 11:07:25'),
(163, 2, 'Teacher', 'Login', '2024-03-20 11:07:32'),
(164, 2, 'Teacher', 'Logout', '2024-03-20 11:27:39'),
(165, 1, 'Admin', 'Login', '2024-03-20 11:27:49'),
(166, 1, 'Admin', 'Login', '2024-03-23 12:55:49'),
(167, 1, 'Admin', 'Logout', '2024-03-23 12:56:56'),
(168, 1, 'Admin', 'Login', '2024-03-23 12:59:12'),
(169, 1, 'Admin', 'Login', '2024-03-23 13:03:25'),
(170, 1, 'Admin', 'Login', '2024-03-23 13:04:27'),
(171, 1, 'Admin', 'Logout', '2024-03-23 13:24:08'),
(172, 12, 'Student', 'Login', '2024-03-23 13:24:40'),
(173, 12, 'Student', 'Logout', '2024-03-23 13:25:40'),
(174, 1, 'Admin', 'Login', '2024-03-23 13:25:53'),
(175, 1, 'Admin', 'Logout', '2024-03-23 14:15:42'),
(176, 1, 'Admin', 'Login', '2024-03-23 14:17:15'),
(177, 1, 'Admin', 'Logout', '2024-03-23 14:17:22'),
(178, 1, 'Admin', 'Login', '2024-03-23 14:17:34'),
(179, 1, 'Admin', 'Login', '2024-04-01 18:02:42'),
(180, 1, 'Admin', 'Logout', '2024-04-01 18:09:27'),
(181, 2, 'Teacher', 'Login', '2024-04-01 18:09:38'),
(182, 2, 'Teacher', 'Logout', '2024-04-01 18:10:13'),
(183, 1, 'Admin', 'Login', '2024-04-01 18:10:18'),
(184, 1, 'Admin', 'Login', '2024-04-01 22:19:53'),
(185, 1, 'Admin', 'Login', '2024-04-09 22:04:55'),
(186, 1, 'Admin', 'Login', '2024-04-15 19:07:15'),
(187, 1, 'Admin', 'Login', '2024-04-15 19:13:18'),
(188, 1, 'Admin', 'Login', '2024-04-17 21:20:34'),
(189, 1, 'Admin', 'Login', '2024-04-17 21:31:07'),
(190, 1, 'Admin', 'Login', '2024-04-17 22:05:06'),
(191, 1, 'Admin', 'Login', '2024-04-17 23:25:08'),
(192, 1, 'Admin', 'Login', '2024-04-17 23:25:45'),
(193, 1, 'Admin', 'Login', '2024-04-18 21:31:52'),
(194, 1, 'Admin', 'Logout', '2024-04-18 21:32:01'),
(195, 1, 'Admin', 'Login', '2024-04-18 21:32:06'),
(196, 1, 'Admin', 'Login', '2024-04-18 22:47:21'),
(197, 1, 'Admin', 'Login', '2024-04-18 22:50:25'),
(198, 1, 'Admin', 'Login', '2024-04-18 23:42:49'),
(199, 1, 'Admin', 'Logout', '2024-04-18 23:55:10'),
(200, 2, 'Teacher', 'Login', '2024-04-18 23:55:17'),
(201, 2, 'Teacher', 'Logout', '2024-04-18 23:56:15'),
(202, 1, 'Admin', 'Login', '2024-04-18 23:56:21'),
(203, 1, 'Admin', 'Login', '2024-04-20 11:15:30'),
(204, 1, 'Admin', 'Login', '2024-04-20 11:19:04'),
(205, 1, 'Admin', 'Login', '2024-04-21 23:14:22'),
(206, 1, 'Admin', 'Logout', '2024-04-21 23:22:00'),
(207, 1, 'Admin', 'Login', '2024-04-21 23:22:33'),
(208, 1, 'Admin', 'Logout', '2024-04-22 00:04:20'),
(209, 1, 'Admin', 'Login', '2024-04-22 00:04:24'),
(210, 1, 'Admin', 'Login', '2024-04-22 03:19:46'),
(211, 2, 'Teacher', 'Login', '2024-04-28 23:52:08'),
(212, 2, 'Teacher', 'Logout', '2024-04-28 23:58:57'),
(213, 1, 'Admin', 'Login', '2024-04-28 23:59:02'),
(214, 1, 'Admin', 'Logout', '2024-04-29 00:13:52'),
(215, 1, 'Admin', 'Login', '2024-04-29 00:13:57'),
(216, 1, 'Admin', 'Logout', '2024-04-29 00:27:08'),
(217, 2, 'Teacher', 'Login', '2024-04-29 00:27:13'),
(218, 2, 'Teacher', 'Logout', '2024-04-29 00:35:11'),
(219, 1, 'Admin', 'Login', '2024-04-29 00:35:59'),
(220, 1, 'Admin', 'Logout', '2024-04-29 00:39:36'),
(221, 2, 'Teacher', 'Login', '2024-04-29 00:39:44'),
(222, 2, 'Teacher', 'Logout', '2024-04-29 01:20:53'),
(223, 1, 'Admin', 'Login', '2024-04-29 01:21:09'),
(224, 1, 'Admin', 'Logout', '2024-04-29 01:21:21'),
(225, 12, 'Student', 'Login', '2024-04-29 01:28:14'),
(226, 12, 'Student', 'Logout', '2024-04-29 01:41:32'),
(227, 2, 'Teacher', 'Login', '2024-04-29 01:41:51'),
(228, 2, 'Teacher', 'Logout', '2024-04-29 01:44:14'),
(229, 1, 'Admin', 'Login', '2024-04-29 01:44:21'),
(230, 1, 'Admin', 'Logout', '2024-04-29 02:06:11'),
(231, 2, 'Teacher', 'Login', '2024-04-29 23:21:08'),
(232, 2, 'Teacher', 'Logout', '2024-04-29 23:28:14'),
(233, 1, 'Admin', 'Login', '2024-04-29 23:28:25'),
(234, 1, 'Admin', 'Logout', '2024-04-29 23:30:21'),
(235, 2, 'Teacher', 'Login', '2024-04-29 23:30:29'),
(236, 2, 'Teacher', 'Login', '2024-04-29 23:42:23'),
(237, 2, 'Teacher', 'Logout', '2024-04-29 23:43:40'),
(238, 2, 'Teacher', 'Login', '2024-04-29 23:43:50'),
(239, 2, 'Teacher', 'Logout', '2024-04-30 00:09:14'),
(240, 1, 'Admin', 'Login', '2024-04-30 00:09:20'),
(241, 1, 'Admin', 'Logout', '2024-04-30 00:16:31'),
(242, 2, 'Teacher', 'Login', '2024-04-30 00:16:38'),
(243, 2, 'Teacher', 'Logout', '2024-04-30 00:17:44'),
(244, 1, 'Admin', 'Login', '2024-04-30 00:17:53'),
(245, 1, 'Admin', 'Logout', '2024-04-30 00:19:12'),
(246, 1, 'Admin', 'Login', '2024-04-30 00:25:04'),
(247, 1, 'Admin', 'Logout', '2024-04-30 00:27:33'),
(248, 1, 'Admin', 'Login', '2024-04-30 00:35:37'),
(249, 1, 'Admin', 'Login', '2024-05-03 14:59:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `role` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `pic` varchar(255) DEFAULT 'default.png',
  `status` enum('Active','Deleted') NOT NULL DEFAULT 'Active',
  `uid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `fname`, `lname`, `role`, `username`, `password`, `pic`, `status`, `uid`) VALUES
(1, 'TACTICS', 'DCS', 'Admin', 'admin', 'admin', 'default.png', 'Active', 'D8BBC1DBA239'),
(2, 'Ann', 'Del Mundo', 'Teacher', 'teacher', 'teacher', '20375760_100322983998342_735423667786893839_n.jpg', 'Active', 'D8BBC1DBA239'),
(11, 'Regielyn', 'Chavez', 'Teacher', 'rchavez', 'd3f@auLt2023', 'default.png', 'Active', 'D8BBC1DBA239'),
(12, 'Cherry Mae', 'Barrientos', 'Teacher', 'cbarrientos', 'd3f@auLt2023', 'default.png', 'Active', 'D8BBC1DBA239'),
(13, 'Kathryn', 'Reyes', 'Teacher', 'kreyes', 'd3f@auLt2023', 'default.png', 'Active', ''),
(14, 'Junnie', 'Hernandez', 'Teacher', 'jhernandez', 'd3f@auLt2023', 'default.png', 'Active', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_attendances`
--
ALTER TABLE `tbl_attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_class`
--
ALTER TABLE `tbl_class`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `facId` (`facId`,`section`,`subject`,`classyr`) USING HASH;

--
-- Indexes for table `tbl_classstudent`
--
ALTER TABLE `tbl_classstudent`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `classId` (`classId`,`studId`);

--
-- Indexes for table `tbl_inout`
--
ALTER TABLE `tbl_inout`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `stud_id` (`stud_id`,`xdate`);

--
-- Indexes for table `tbl_settings_constants`
--
ALTER TABLE `tbl_settings_constants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category` (`category`,`value`);

--
-- Indexes for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ualt`
--
ALTER TABLE `tbl_ualt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_attendances`
--
ALTER TABLE `tbl_attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_class`
--
ALTER TABLE `tbl_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_classstudent`
--
ALTER TABLE `tbl_classstudent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `tbl_inout`
--
ALTER TABLE `tbl_inout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `tbl_settings_constants`
--
ALTER TABLE `tbl_settings_constants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `tbl_students`
--
ALTER TABLE `tbl_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=624;

--
-- AUTO_INCREMENT for table `tbl_ualt`
--
ALTER TABLE `tbl_ualt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
