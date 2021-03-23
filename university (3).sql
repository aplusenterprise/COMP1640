-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2021 at 05:12 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `university`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `chat_message_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`chat_message_id`, `to_user_id`, `from_user_id`, `chat_message`, `timestamp`, `status`) VALUES
(1, 1003, 1008, 'sasda', '2021-03-01 03:41:11', 1),
(2, 1003, 1008, 'hello', '2021-03-01 03:41:36', 1),
(6, 1003, 1008, 'Hi sir\n', '2021-03-01 04:18:57', 1),
(12, 1007, 1003, 'Morning', '2021-03-01 04:31:09', 1),
(13, 1007, 1003, 'Please check grammar mistake and resend before the closure date. Thank you!', '2021-03-01 04:31:12', 1),
(14, 1008, 1003, 'sda', '2021-03-01 04:31:18', 1),
(15, 1003, 1007, 'Morning sir\n', '2021-03-01 04:43:17', 1),
(16, 1003, 1007, 'Alright sir will make changes and resend to you!', '2021-03-01 04:43:55', 1),
(17, 1003, 1007, ':)', '2021-03-01 04:46:41', 1),
(18, 1003, 1007, 's', '2021-03-01 05:08:02', 1),
(19, 1003, 1007, 'Sir..Ive updated and submitted to the portal ', '2021-03-01 05:30:15', 1),
(20, 1007, 1007, 'Noted', '2021-03-01 05:30:25', 1),
(21, 1007, 1003, 'Noted', '2021-03-01 05:31:31', 1),
(22, 1005, 1016, 'Hi', '2021-03-01 12:10:37', 1),
(23, 1003, 1007, ':)', '2021-03-02 04:10:19', 1),
(25, 1008, 1003, 'Hi\n', '2021-03-02 13:10:41', 1),
(26, 1014, 1004, 'Hi', '2021-03-03 00:33:31', 1),
(27, 1007, 1003, 'hi\n', '2021-03-03 04:07:32', 1),
(28, 1003, 1007, 'Hello', '2021-03-03 04:07:44', 1),
(29, 1007, 1003, 'hi', '2021-03-08 08:32:27', 1),
(30, 1003, 1007, 'hi', '2021-03-08 08:32:34', 1),
(31, 1002, 1012, 'Hi :)', '2021-03-09 03:52:41', 1),
(32, 1002, 1010, 'hello\n', '2021-03-09 13:22:51', 1),
(35, 1002, 1010, 'dfs', '2021-03-09 13:23:17', 1),
(36, 1003, 1007, 'hi', '2021-03-09 13:24:13', 1),
(37, 1007, 1003, 'ji', '2021-03-09 13:24:17', 1),
(38, 1003, 1007, 'hiiu', '2021-03-09 13:24:29', 1),
(39, 1003, 1007, 'jhuhi', '2021-03-09 13:24:47', 1),
(40, 1008, 1003, 'hi', '2021-03-09 13:50:39', 1),
(41, 1003, 1008, 'sa', '2021-03-09 13:50:42', 1),
(42, 1011, 1002, 'Hi', '2021-03-10 01:24:17', 1),
(43, 1002, 1011, 'Hi', '2021-03-10 01:24:44', 1),
(44, 1054, 1003, 'Hi\n', '2021-03-19 06:24:44', 1),
(45, 1074, 1003, 'Holla', '2021-03-19 06:24:51', 1),
(46, 101, 1003, 'Hello', '2021-03-20 11:40:35', 1),
(47, 101, 1003, 'Hello', '2021-03-20 11:40:35', 1),
(48, 101, 1003, 'das', '2021-03-20 11:40:37', 1),
(49, 101, 1003, 'sda', '2021-03-20 11:40:39', 1),
(50, 101, 1003, 'hi', '2021-03-20 11:40:46', 1),
(51, 1002, 1052, 'Hello', '2021-03-20 16:34:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `CommentID` int(11) NOT NULL,
  `CommentDetail` mediumtext NOT NULL,
  `CommentCreateTime` timestamp NULL DEFAULT current_timestamp(),
  `StudentSubmissionID` int(11) NOT NULL,
  `UserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`CommentID`, `CommentDetail`, `CommentCreateTime`, `StudentSubmissionID`, `UserId`) VALUES
(6, 'Nice', '2021-02-25 15:18:29', 10, 1002),
(10, 'Well written articles and I like the images.', '2021-02-26 13:53:11', 9, 1003),
(13, 'Great job', '2021-02-28 07:48:39', 42, 1004),
(14, 'Love it!', '2021-02-28 07:49:08', 209, 1004),
(15, 'Very good article!', '2021-02-28 15:02:30', 41, 1002),
(16, 'Cool!', '2021-03-01 05:33:34', 7, 1003),
(17, 'Good job!', '2021-03-02 04:12:06', 8, 1003),
(25, 'Good article and image', '2021-03-13 05:56:34', 242, 1005),
(26, 'Nice', '2021-03-13 06:02:35', 43, 1005),
(29, 'Nice!', '2021-03-20 07:12:34', 251, 1002);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `FacultyID` int(11) NOT NULL,
  `FacultyName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`FacultyID`, `FacultyName`) VALUES
(1, 'Computing'),
(2, 'Business and Accounting'),
(3, 'Art and Social Science'),
(4, 'Engineering'),
(5, 'All');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `RequestID` int(11) NOT NULL,
  `FacultyID` int(11) DEFAULT NULL,
  `UserName` varchar(255) NOT NULL,
  `UserEmail` varchar(255) NOT NULL,
  `UserPassword` varchar(255) NOT NULL,
  `UserPhone` int(50) NOT NULL,
  `UserRole` varchar(50) DEFAULT NULL,
  `DateTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`RequestID`, `FacultyID`, `UserName`, `UserEmail`, `UserPassword`, `UserPhone`, `UserRole`, `DateTime`) VALUES
(39, 3, 'Anis', 'student27@gmail.com', '$2y$10$vciYVoaphv1Y30ffZ8paCugkObR9242UbpUyaKRtO4eJBPjrwnubK', 166337353, 'student', '2021-03-16 02:16:15');

-- --------------------------------------------------------

--
-- Table structure for table `studentsubmission`
--

CREATE TABLE `studentsubmission` (
  `StudentSubmissionID` int(11) NOT NULL,
  `StudentSubmissionName` varchar(255) NOT NULL,
  `StudentSubmissionDescription` varchar(255) DEFAULT NULL,
  `StudentSubmissionTime` timestamp NULL DEFAULT current_timestamp(),
  `StudentSubmissionStatus` varchar(255) NOT NULL,
  `UserId` int(11) NOT NULL,
  `SubmissionID` int(11) NOT NULL,
  `Document_url` varchar(255) NOT NULL,
  `Image_url` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentsubmission`
--

INSERT INTO `studentsubmission` (`StudentSubmissionID`, `StudentSubmissionName`, `StudentSubmissionDescription`, `StudentSubmissionTime`, `StudentSubmissionStatus`, `UserId`, `SubmissionID`, `Document_url`, `Image_url`) VALUES
(7, 'Article AssddA by Sarah', 'This article aim to discuss about Computing. Computing is any goal-oriented activity requiring, benefiting from, or creating computing machinery. ', '2021-02-18 04:40:52', '0', 1007, 1, 'Doc_12225.docx,Doc_27542.docx', 'Img_19817.jpg'),
(8, 'Article FVA', 't includes the study and experimentation of algorithmic processes and development of both hardware and software. It has scientific, engineering, mathematical, technological and social aspects.', '2021-02-18 09:00:41', '1', 1008, 1, 'Article1.docx,Article2.docx', 'Img_11968.jpg,Img_12459.jpg'),
(9, 'Article Computing CFE', 'Regardless of the context, doing computing well can be complicated and difficult. Because society needs people to do computing well, we must think of computing not only as a profession but also as a discipline.', '2021-02-21 05:17:57', '1', 1009, 1, 'Article15.docx,Article16.docx', 'Img_14734.jpg,Img_19470.jpg'),
(10, 'Business Article VC by William', 'Business accounting is the process of gathering and analyzing financial information on business activity, recording transactions, and producing financial statements.', '2021-02-21 05:24:24', '1', 1010, 2, 'Article9.docx,Article10.docx', 'Img_87593.jpg,Img_69094.jpg'),
(41, 'Article CD by Tommy', 'Business accounting is the process of gathering and analyzing financial information on business activity, recording transactions, and producing financial statements.', '2021-02-26 13:57:24', '1', 1012, 2, 'Doc_71144.docx,Doc_54464.docx', 'Img_43071.jpg,Img_44088.jpg'),
(42, 'Article about arts and ss', 'This article aims to give a brief outline on studying humanities and social sciences ', '2021-02-28 03:05:53', '0', 1014, 3, 'Doc_47153.docx,Doc_41935.docx', 'Img_97327.jpg'),
(43, 'Article about eng ACS', 'The work of engineers forms the link between scientific discoveries and their subsequent applications to human and business needs and quality of life', '2021-02-28 03:06:59', '1', 1016, 4, 'Doc_84630.docx,Doc_57600.docx', 'Img_19444.jpg'),
(200, 'Article XDA', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies.', '2020-02-07 20:40:52', '0', 101, 5, 'Dummy Data.docx', 'Img_71713.jpg,Img_72654.jpg,Img_80153.jpg'),
(201, 'Article FVA', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna. Nunc viverra imperdiet enim. Fusce est.', '2020-02-08 01:00:41', '0', 102, 6, 'Article1.docx,Article2.docx', 'Img_79399.jpg'),
(202, 'Article Computing CFE', 'Article Computing aaa', '2020-02-07 21:17:57', '1', 106, 6, 'Article15.docx,Article16.docx', 'Img_19432.jpg,Img_40023.jpg'),
(203, 'Business Article ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget faucibus nisl. Morbi a dolor est. Aliquam auctor tempus turpis, vel pharetra nulla egestas nec. ', '2020-02-07 21:24:24', '0', 103, 7, 'Article9.docx,Article10.docx', 'Img_31866.jpg,Img_15416.jpg'),
(204, 'Article XCD ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget faucibus nisl. Morbi a dolor est. Aliquam auctor tempus turpis, vel pharetra nulla egestas nec. ', '2020-02-08 05:57:24', '0', 108, 7, 'Doc_71144.docx,Doc_54464.docx', 'Img_20013.jpg,Img_64232.jpg'),
(207, 'Article Computing CFE', 'Article Computing aaa', '2020-02-07 21:17:57', '1', 107, 8, 'Article15.docx,Article16.docx', 'Img_33975.jpg,Img_41608.jpg'),
(208, 'Article GGG', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget faucibus nisl. Morbi a dolor est. Aliquam auctor tempus turpis, vel pharetra nulla egestas nec. ', '2021-02-28 07:46:58', '', 1026, 3, 'Doc_10227.docx,Doc_48582.docx', 'Img_11201.jpg'),
(209, 'Updated Article GGG', 'The collective term ‘Arts’ is used to refer to university faculties that are home to these fields.', '2021-02-28 07:47:40', '1', 1026, 3, 'Doc_26233.docx,Doc_29155.docx', 'Img_15303.jpg'),
(210, 'Article D', 'The work of engineers forms the link between scientific discoveries and their subsequent applications to human and business needs and quality of life.', '2021-03-01 08:44:00', '0', 1016, 4, 'Doc_17281.docx,Doc_82120.docx,Doc_32191.docx', 'Img_11869.jpg'),
(216, 'Article CEER', 'The work of engineers forms the link between scientific discoveries and their subsequent applications to human and business needs and quality of life.', '2021-03-02 13:05:02', '', 1016, 4, 'Doc_16355.docx,Doc_93491.docx', 'Img_99955.jpg'),
(242, 'Article CSFs', 'The work of engineers forms the link between scientific discoveries and their subsequent applications to human and business needs and quality of life.', '2021-03-03 03:48:26', '1', 1013, 4, 'Doc_50632.docx,Doc_95199.docx,Doc_34769.docx', 'Img_21677.jpg'),
(251, 'Article NEW by Qujin', 'Through business accounting, you can better manage your finances to make informed financial decisions for your company. ', '2021-03-10 00:15:32', '', 1011, 2, 'Doc_59441.docx', 'Img_30490.jpg'),
(256, 'Article Computing WWW', 'In this article, I has discuss in detail what is a computer system , technical features of the computer system and other important topics related to the Computer system. ', '2021-03-20 15:44:59', '', 1054, 1, 'Doc_40629.doc,Doc_71343.docx', 'Img_11287.jpg'),
(257, 'Article for Business and Acc By Poopy', 'In this article, I have discussed about the relationship of BX and Y in ZZZ.', '2021-03-20 15:52:04', '', 1052, 2, 'Doc_19596.docx', 'Img_97388.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE `submission` (
  `SubmissionID` int(11) NOT NULL,
  `SubmissionStartDate` datetime NOT NULL,
  `SubmissionClosureDate` datetime NOT NULL,
  `SubmissionFinalDate` datetime NOT NULL,
  `AcademicYear` year(4) NOT NULL,
  `SubmissionName` varchar(255) NOT NULL,
  `SubmissionDescription` varchar(255) NOT NULL,
  `SubmissionStatus` varchar(255) NOT NULL,
  `FacultyID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submission`
--

INSERT INTO `submission` (`SubmissionID`, `SubmissionStartDate`, `SubmissionClosureDate`, `SubmissionFinalDate`, `AcademicYear`, `SubmissionName`, `SubmissionDescription`, `SubmissionStatus`, `FacultyID`) VALUES
(1, '2021-03-03 13:00:00', '2021-03-25 15:07:00', '2021-03-26 13:00:00', 2021, 'Submission C', 'Articles on current issues in compliance or related fields.', '1', 1),
(2, '2021-03-06 13:00:00', '2021-03-27 13:00:00', '2021-03-29 13:00:00', 2021, 'Submission A', 'Articles featuring personal achievements ', '1', 2),
(3, '2021-02-06 13:00:00', '2021-02-28 13:00:00', '2021-03-30 00:00:00', 2021, 'Submission B', 'Articles featuring personal achievements ', '1', 3),
(4, '2021-02-06 13:00:00', '2021-03-03 13:00:00', '2021-03-22 13:00:00', 2021, 'Submission D', 'Articles featuring personal achievements ', '1', 4),
(5, '2020-02-06 13:00:00', '2020-02-26 23:00:00', '2020-02-29 13:00:00', 2020, 'Submission VA', 'Articles featuring personal achievements ', '1', 1),
(6, '2020-02-06 13:00:00', '2020-02-27 13:00:00', '2020-02-29 13:00:00', 2020, 'Submission VB', 'Articles featuring personal achievements ', '1', 2),
(7, '2020-02-06 13:00:00', '2020-02-06 13:00:00', '2020-02-06 13:00:00', 2020, 'Submission VC', 'Article about current art trend', '1', 3),
(8, '2020-02-06 13:00:00', '2020-02-14 16:00:00', '2020-02-29 13:00:00', 2020, 'Submission VD', 'Articles featuring personal achievements ', '1', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserId` int(11) NOT NULL,
  `FacultyID` int(11) DEFAULT NULL,
  `UserName` varchar(255) NOT NULL,
  `UserEmail` varchar(255) NOT NULL,
  `UserPassword` varchar(255) NOT NULL,
  `UserPhone` int(50) NOT NULL,
  `UserRole` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserId`, `FacultyID`, `UserName`, `UserEmail`, `UserPassword`, `UserPhone`, `UserRole`) VALUES
(101, 1, 'Ave', 'st1@uog.com', '$2y$10$vfTprfGTLFncxB/fq8Gww.PqHMmmzQIQ6c2wzjhG39sPBXw2k.GwC', 2147483647, 'student'),
(102, 2, 'Lunna', 'st2@uog.com', '$2y$10$ZGEwSj/XyeH/S7aiMKGG7e/saJfG7UNAHcIWcCFmx68aQGtNVR/Aa', 3242342, 'student'),
(103, 3, 'Olive', 'st3@uog.com', '$2y$10$ZGEwSj/XyeH/S7aiMKGG7e/saJfG7UNAHcIWcCFmx68aQGtNVR/Aa', 2147483647, 'student'),
(104, 4, 'Gan', 'st4@uog.com', '$2y$10$ZGEwSj/XyeH/S7aiMKGG7e/saJfG7UNAHcIWcCFmx68aQGtNVR/Aa', 2147483647, 'student'),
(105, 4, 'Veronica', 'st5@uog.com', '$2y$10$ZGEwSj/XyeH/S7aiMKGG7e/saJfG7UNAHcIWcCFmx68aQGtNVR/Aa', 2147483647, 'student'),
(106, 2, 'Paul', 'st6@uog.com', '$2y$10$ZGEwSj/XyeH/S7aiMKGG7e/saJfG7UNAHcIWcCFmx68aQGtNVR/Aa', 2147483647, 'student'),
(107, 4, 'Aster', 'st7@uog.com', '$2y$10$ZGEwSj/XyeH/S7aiMKGG7e/saJfG7UNAHcIWcCFmx68aQGtNVR/Aa', 2147483647, 'student'),
(108, 3, 'Auther', 'st8@uog.com', '$2y$10$kg16zm69KsZ1wrcADa4GGe4Iv85YQmoPjO4fg2f8i.auwxrSl79FO', 163903300, 'student'),
(1000, 1, 'Guest', 'guest@uog.com', '$2y$10$ZGEwSj/XyeH/S7aiMKGG7e/saJfG7UNAHcIWcCFmx68aQGtNVR/Aa', 12112121, 'guest'),
(1001, 5, 'admin', 'admin@uog.com', '$2y$10$vvVGMoDEab6VF/DhLN0B9OCP77UcaLfUDs1cIdg3MofdMZDYcIGJq', 2147483647, 'admin'),
(1002, 2, 'CoorA', 'coordinator@uog.com', '$2y$10$ZGEwSj/XyeH/S7aiMKGG7e/saJfG7UNAHcIWcCFmx68aQGtNVR/Aa', 1247483647, 'coordinator'),
(1003, 1, 'CoorB', 'coordinatorB@uog.com', '$2y$10$0TEga3dbSoC7.xkzRStbTO/fcUo5qwZKbQQh69uns8qx6v1SezI3u', 176774001, 'coordinator'),
(1004, 3, 'CoorC', 'coordinatorC@uog.com', '$2y$10$ZGEwSj/XyeH/S7aiMKGG7e/saJfG7UNAHcIWcCFmx68aQGtNVR/Aa', 198220019, 'coordinator'),
(1005, 4, 'CoorD', 'coordinatorD@uog.com', '$2y$10$ZGEwSj/XyeH/S7aiMKGG7e/saJfG7UNAHcIWcCFmx68aQGtNVR/Aa', 1211003930, 'coordinator'),
(1006, 1, 'UOG Manager', 'mm@uog.com', '$2y$10$ZGEwSj/XyeH/S7aiMKGG7e/saJfG7UNAHcIWcCFmx68aQGtNVR/Aa', 2147483647, 'marketingmanager'),
(1007, 1, 'Sarah', 'student1@uog.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1008, 1, 'Minnie', 'student2@uog.com', '$2y$10$ZGEwSj/XyeH/S7aiMKGG7e/saJfG7UNAHcIWcCFmx68aQGtNVR/Aa', 3242342, 'student'),
(1009, 1, 'Greg', 'student3@uog.com', '$2y$10$ZGEwSj/XyeH/S7aiMKGG7e/saJfG7UNAHcIWcCFmx68aQGtNVR/Aa', 2147483647, 'student'),
(1010, 2, 'William', 'student4@uog.com', '$2y$10$ZGEwSj/XyeH/S7aiMKGG7e/saJfG7UNAHcIWcCFmx68aQGtNVR/Aa', 2147483647, 'student'),
(1011, 2, 'Qujin', 'student5@uog.com', '$2y$10$ZGEwSj/XyeH/S7aiMKGG7e/saJfG7UNAHcIWcCFmx68aQGtNVR/Aa', 2147483647, 'student'),
(1012, 2, 'Tommy', 'student6@uog.com', '$2y$10$ZGEwSj/XyeH/S7aiMKGG7e/saJfG7UNAHcIWcCFmx68aQGtNVR/Aa', 2147483647, 'student'),
(1013, 4, 'Bently', 'student30@uog.com', '$2y$10$q6L3UbE9kfJnMZmAEpMoHO8HilL0UF84.nYM2DWDj1IdebLStpmWO', 166337353, 'student'),
(1014, 3, 'Callisa', 'student9@uog.com', '$2y$10$q6L3UbE9kfJnMZmAEpMoHO8HilL0UF84.nYM2DWDj1IdebLStpmWO', 34234234, 'student'),
(1016, 4, 'Kate', 'student8@uog.com', '$2y$10$eAHoXovIeC.PIZh8zr706.8gcfEqmjfTelG9PvRtDgr2YygNPOoeS', 192222131, 'student'),
(1026, 3, 'Kelly', 'student29@uog.com', '$2y$10$kg16zm69KsZ1wrcADa4GGe4Iv85YQmoPjO4fg2f8i.auwxrSl79FO', 163903300, 'student'),
(1037, 2, 'Guest2', 'guest2@uog.com', '$2y$10$ZGEwSj/XyeH/S7aiMKGG7e/saJfG7UNAHcIWcCFmx68aQGtNVR/Aa', 12112121, 'guest'),
(1038, 3, 'Guest3', 'guest3@uog.com', '$2y$10$ZGEwSj/XyeH/S7aiMKGG7e/saJfG7UNAHcIWcCFmx68aQGtNVR/Aa', 12112121, 'guest'),
(1039, 4, 'Guest4', 'guest4@uog.com', '$2y$10$ZGEwSj/XyeH/S7aiMKGG7e/saJfG7UNAHcIWcCFmx68aQGtNVR/Aa', 12112121, 'guest'),
(1042, 4, 'Mary', 'student7@uog.com', '$2y$10$MDBAw6cn98OYfqaGLqtN1e05kRAzaqw9cZPid.Mnm/mfwW9Z/lX9G', 163333333, 'student'),
(1046, 3, 'Janet', 'student10@uog.com', '$2y$10$94wLYaJZ9z8QJ2FLcLDVbuKIx/S7uyEAHihXWrJgVo3MeWp8cfqnK', 163333333, 'student'),
(1048, 3, 'Elyseen', 'student11@uog.com', '$2y$10$XLSIDxuhpQcShacl6UvlQ.eH1q43HYun/cn2ZnZU.ovcN9LEMqC6y', 3234234, 'student'),
(1049, 3, 'Oscar', 'student12@uog.com', '$2y$10$1p3WabZBIOaHxVvBsQ1wkuTyXrJDXVQYQuR2jYgF6t8bErTvJaRqK', 163333333, 'student'),
(1050, 3, 'Omar', 'student13@uog.com', '$2y$10$vEsw58FrhYSZVetisRSlGuQymmFB42IcloFnnqBq6FSkY1JkATXxS', 166337353, 'student'),
(1051, 4, 'Eden', 'student14@uog.com', '$2y$10$vtED3G81jjz17fxxbPJC1uqRyYTzDHLs0gPvXjfn2BkO5qUpKfoG.', 166337353, 'student'),
(1052, 2, 'Poppy', 'student15@uog.com', '$2y$10$vb5So0xM/ElakiE.VS6nWeZ9HEjGILOKSck3a2hPum3t0ijzu9yMm', 163333333, 'student'),
(1054, 1, 'Shuhada', 'student28@uog.com', '$2y$10$oPmcAg/TK/ONTt9EXf4Ggebxekc3ysLrJt1lMT7eDi9lsfF5/1Bkq', 163333333, 'student'),
(1065, 3, 'Farah', 'student26@uog.com', '$2y$10$ANKO8a.nUQSncl74uaLcWeK2.tq6jNXzW.7KAr.cj7vgtG2eZW6k6', 2147483647, 'student'),
(1073, 1, 'Divya', 'student22@uog.com', '$2y$10$ilGABH9pwMhiE8E9lVwzN.sgMsttNrkFKsAgjo.xTZwcdirEFuqs.', 166337353, 'student'),
(1074, 1, 'Shally', 'student44@uog.com', '$2y$10$5uz/ku7ocz1J/zXAiHl43.eiwVEDp1eC5LUlRkVUNHe4TuW49LfjK', 163364711, 'student'),
(1075, 2, 'Janx', 'khavirnamanjaari@yahoo.com', '$2y$10$rl9CvCj/b4MYY94rTkD50uvqUJGQ6IMHFJPE08/rjHFJj4Zkjql2e', 1212312381, 'student'),
(1076, 2, 'Kamala', 'student40@uog.com', '$2y$10$5ddNBz8Ahl2Mal7SViF8mezl3opsEdmWIbrTgldoyq/K9ekxO7gPi', 163333333, 'student'),
(1077, 3, 'Amirul', 'fer@yahoo.com', '$2y$10$dM.4xoV0K2ApuwewwESvAO6ZKhSrdUcF58oEMv.YCUQT3iznvoMkW', 1231231231, 'student'),
(1078, 1, 'khavirnamanjaari', 'khav@gmail.com', '$2y$10$wWfkBO/oxJeOtDLjk7pgrukpzlZF.InN1bcupbbub.Ggy6jJbiEay', 123223232, 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_message_id`),
  ADD KEY `to_user_id` (`to_user_id`),
  ADD KEY `from_user_id` (`from_user_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `StudentSubmissionID` (`StudentSubmissionID`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`FacultyID`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `studentsubmission`
--
ALTER TABLE `studentsubmission`
  ADD PRIMARY KEY (`StudentSubmissionID`),
  ADD KEY `UserId` (`UserId`),
  ADD KEY `SubmissionID` (`SubmissionID`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`SubmissionID`),
  ADD KEY `FacultyID` (`FacultyID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserId`),
  ADD KEY `FacultyID` (`FacultyID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `studentsubmission`
--
ALTER TABLE `studentsubmission`
  MODIFY `StudentSubmissionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

--
-- AUTO_INCREMENT for table `submission`
--
ALTER TABLE `submission`
  MODIFY `SubmissionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1084;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD CONSTRAINT `chat_message_ibfk_1` FOREIGN KEY (`to_user_id`) REFERENCES `user` (`UserId`),
  ADD CONSTRAINT `chat_message_ibfk_2` FOREIGN KEY (`from_user_id`) REFERENCES `user` (`UserId`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`StudentSubmissionID`) REFERENCES `studentsubmission` (`StudentSubmissionID`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`);

--
-- Constraints for table `studentsubmission`
--
ALTER TABLE `studentsubmission`
  ADD CONSTRAINT `studentsubmission_ibfk_1` FOREIGN KEY (`SubmissionID`) REFERENCES `submission` (`SubmissionID`),
  ADD CONSTRAINT `studentsubmission_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`FacultyID`) REFERENCES `faculty` (`FacultyID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
