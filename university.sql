-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2021 at 09:25 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
(33, 102, 1002, 'huhu', '2021-03-09 13:23:08', 1),
(34, 102, 1002, '', '2021-03-09 13:23:09', 1),
(35, 1002, 1010, 'dfs', '2021-03-09 13:23:17', 1),
(36, 1003, 1007, 'hi', '2021-03-09 13:24:13', 1),
(37, 1007, 1003, 'ji', '2021-03-09 13:24:17', 1),
(38, 1003, 1007, 'hiiu', '2021-03-09 13:24:29', 1),
(39, 1003, 1007, 'jhuhi', '2021-03-09 13:24:47', 1),
(40, 1008, 1003, 'hi', '2021-03-09 13:50:39', 1),
(41, 1003, 1008, 'sa', '2021-03-09 13:50:42', 1),
(42, 1011, 1002, 'Hi', '2021-03-10 01:24:17', 1),
(43, 1002, 1011, 'Hi', '2021-03-10 01:24:44', 1);

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
(16, 'Please change  different images', '2021-03-01 05:33:34', 7, 1003),
(17, 'Good job!', '2021-03-02 04:12:06', 8, 1003),
(22, 'You done well!', '2021-03-03 03:42:42', 7, 1003),
(23, 'Nice work.', '2021-03-12 12:17:23', 8, 1003),
(25, 'Good article and image', '2021-03-13 05:56:34', 242, 1005),
(26, 'Nice', '2021-03-13 06:02:35', 43, 1005);

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
(39, 3, 'Anis', 'student27@gmail.com', '$2y$10$vciYVoaphv1Y30ffZ8paCugkObR9242UbpUyaKRtO4eJBPjrwnubK', 166337353, 'student', '2021-03-16 02:16:15'),
(40, 2, 'asas', 'khav@gmail.com', '$2y$10$sWFdQDwUD/0BamLW5gvvsuzeXdEaGqKVGGO4G8hxKdkHxruYJKZb6', 163333333, 'student', '2021-03-16 02:28:11'),
(41, 2, 'asd', 'fer@yahoo.com', '$2y$10$0cR9yfwojJ426l2ApAgP7.agzwEoP8Y.NeRT/BAQoBMEnHF4vAVsi', 3234234, 'student', '2021-03-16 02:51:57'),
(42, 3, 'casa', 'fer@yahoo.com', '$2y$10$R.eXXomlMa54Qeb.dp28nuYe4EqPh4TQgaHBSXQ4fM4HqBloyCRsC', 166337353, 'student', '2021-03-16 03:17:40'),
(46, 1, 'George', 'fer@yahoo.com', '$2y$10$XbpwSox.h9An23BSFroaSeHylf.c1VXWfzTONa9qVJYPO1Ggc/PAS', 163333333, 'student', '2021-03-16 13:06:48');

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
(7, 'Article AA by Sarah', 'Computing is any goal-oriented activity requiring, benefiting from, or creating computing machinery. ', '2021-02-18 04:40:52', '0', 1007, 1, 'Doc_12225.docx,Doc_27542.docx', '1615190931random.jpg'),
(8, 'Article FVA', 't includes the study and experimentation of algorithmic processes and development of both hardware and software. It has scientific, engineering, mathematical, technological and social aspects.', '2021-02-18 09:00:41', '1', 1008, 1, 'Article1.docx,Article2.docx', 'img1.jpg,random2.jpg'),
(9, 'Article Computing CFE', 'Regardless of the context, doing computing well can be complicated and difficult. Because society needs people to do computing well, we must think of computing not only as a profession but also as a discipline.', '2021-02-21 05:17:57', '1', 1009, 1, 'Article15.docx,Article16.docx', 'random3.jpg,random7.jpg'),
(10, 'Business Article VC by William', 'Business accounting is the process of gathering and analyzing financial information on business activity, recording transactions, and producing financial statements.', '2021-02-21 05:24:24', '1', 1010, 2, 'Article9.docx,Article10.docx', 'Img_87593.jpg,Img_69094.jpg'),
(41, 'Article CD by Tommy', 'Business accounting is the process of gathering and analyzing financial information on business activity, recording transactions, and producing financial statements.', '2021-02-26 13:57:24', '1', 1012, 2, 'Doc_71144.docx,Doc_54464.docx', 'random2.jpg,random6.jpg'),
(42, 'Article about arts and ss', 'This article aims to give a brief outline on studying humanities and social sciences ', '2021-02-28 03:05:53', '0', 1014, 3, 'Doc_47153.docx,Doc_41935.docx', 'img2.jpg'),
(43, 'Article about eng ACS', 'The work of engineers forms the link between scientific discoveries and their subsequent applications to human and business needs and quality of life', '2021-02-28 03:06:59', '1', 1016, 4, 'Doc_84630.docx,Doc_57600.docx', 'random7.jpg'),
(200, 'Article XDA', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies.', '2020-02-07 20:40:52', '0', 101, 5, 'Dummy Data.docx', 'Screenshot 2021-02-18 113108.png,scrnli_2_18_2021_11-27-17 AM.png'),
(201, 'Article FVA', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna. Nunc viverra imperdiet enim. Fusce est.', '2020-02-08 01:00:41', '0', 102, 6, 'Article1.docx,Article2.docx', 'img1.jpg,random2.jpg'),
(202, 'Article Computing CFE', 'Article Computing aaa', '2020-02-07 21:17:57', '1', 106, 6, 'Article15.docx,Article16.docx', 'random3.jpg,random7.jpg'),
(203, 'Business Article ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget faucibus nisl. Morbi a dolor est. Aliquam auctor tempus turpis, vel pharetra nulla egestas nec. ', '2020-02-07 21:24:24', '0', 103, 7, 'Article9.docx,Article10.docx', 'img3.jpg,img4.jpg'),
(204, 'Article XCD ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget faucibus nisl. Morbi a dolor est. Aliquam auctor tempus turpis, vel pharetra nulla egestas nec. ', '2020-02-08 05:57:24', '0', 108, 7, 'Doc_71144.docx,Doc_54464.docx', 'random2.jpg,random6.jpg'),
(207, 'Article Computing CFE', 'Article Computing aaa', '2020-02-07 21:17:57', '1', 107, 8, 'Article15.docx,Article16.docx', 'random3.jpg,random7.jpg'),
(208, 'Article GGG', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget faucibus nisl. Morbi a dolor est. Aliquam auctor tempus turpis, vel pharetra nulla egestas nec. ', '2021-02-28 07:46:58', '', 1026, 3, 'Doc_10227.docx,Doc_48582.docx', 'peter-olexa-RYtiT3b7XW4-unsplash.jpg'),
(209, 'Updated Article GGG', 'The collective term ‘Arts’ is used to refer to university faculties that are home to these fields.', '2021-02-28 07:47:40', '1', 1026, 3, 'Doc_26233.docx,Doc_29155.docx', 'img8.png'),
(210, 'Article D', 'The work of engineers forms the link between scientific discoveries and their subsequent applications to human and business needs and quality of life.', '2021-03-01 08:44:00', '0', 1016, 4, 'Doc_17281.docx,Doc_82120.docx,Doc_32191.docx', 'random4.jpg'),
(216, 'Article CEER', 'The work of engineers forms the link between scientific discoveries and their subsequent applications to human and business needs and quality of life.', '2021-03-02 13:05:02', '0', 1016, 4, 'Doc_16355.docx,Doc_93491.docx', '1614690302random7.jpg,1614690302sky.jpg'),
(242, 'Article CSFs', 'The work of engineers forms the link between scientific discoveries and their subsequent applications to human and business needs and quality of life.', '2021-03-03 03:48:26', '1', 1013, 4, 'Doc_50632.docx,Doc_95199.docx,Doc_34769.docx', 'Img_43071.jpg'),
(251, 'Article NEW by Qujin', 'Through business accounting, you can better manage your finances to make informed financial decisions for your company. ', '2021-03-10 00:15:32', '', 1011, 2, 'Doc_59441.docx', 'Img_30490.jpg'),
(270, 'Tarnished Angels The', '\"Integer tincidunt ante vel ipsum Praesent blandit lacinia erat Vestibulum sed magna at nunc commodo placerat  Praesent blandit Nam nulla Integer pede justo lacinia eget tincidunt eget tempus vel pede  Morbi porttitor lorem id ligula Suspendisse ornare co', '2021-02-18 01:41:58', '1', 1082, 5, 'Doc_59441docx', 'random3.jpg,random7.jpg'),
(280, 'Delphine 1 Yvan 0', 'Aenean lectus Pellentesque eget nunc Donec quis orci eget orci vehicula condimentum', '2021-02-18 02:28:01', '0', 1084, 7, 'Doc_59441docx', 'random3.jpg,random7.jpg'),
(286, 'Bachelor Party', 'Sed sagittis Nam congue risus semper porta volutpat quam pede lobortis ligula sit amet eleifend pede libero quis orci Nullam molestie nibh in lectus', '2020-02-08 06:46:16', '0', 1094, 3, 'Doc_84630docxDoc_57600docx', 'img1.jpg,random2.jpg'),
(291, 'Harmonists The', '\"Fusce consequat Nulla nisl Nunc nisl  Duis bibendum felis sed interdum venenatis turpis enim blandit mi in porttitor pede justo eu massa Donec dapibus Duis at velit eu est congue elementum  In hac habitasse platea dictumst Morbi vestibulum velit id preti', '2020-02-08 09:22:38', '0', 1085, 3, 'Doc_59441docx', 'random3.jpg,random7.jpg'),
(296, 'The Harmonists', '\"Fusce consequat Nulla nisl Nunc nisl  Duis bibendum felis sed interdum venenatis turpis enim blandit mi in porttitor pede justo eu massa Donec dapibus Duis at velit eu est congue elementum  In hac habitasse platea dictumst Morbi vestibulum velit id preti', '2020-02-08 09:22:38', '0', 1085, 3, 'Doc_59441docx', 'random3.jpg,random7.jpg'),
(297, 'The Harmonists', '\"Fusce consequat Nulla nisl Nunc nisl  Duis bibendum felis sed interdum venenatis turpis enim blandit mi in porttitor pede justo eu massa Donec dapibus Duis at velit eu est congue elementum  In hac habitasse platea dictumst Morbi vestibulum velit id preti', '2020-02-08 09:22:38', '0', 1085, 3, 'Doc_59441docx', 'random3.jpg,random7.jpg'),
(299, 'The Harmonists', '\"Fusce consequat Nulla nisl Nunc nisl  Duis bibendum felis sed interdum venenatis turpis enim blandit mi in porttitor pede justo eu massa Donec dapibus Duis at velit eu est congue elementum  In hac habitasse platea dictumst Morbi vestibulum velit id preti', '2020-02-08 09:22:38', '0', 1085, 3, 'Doc_59441docx', 'random3.jpg,random7.jpg'),
(301, 'China O\'Brien', '\"In congue Etiam justo Etiam pretium iaculis justo  In hac habitasse platea dictumst Etiam faucibus cursus urna Ut tellus\"', '2021-02-17 17:14:25', '1', 1110, 6, 'Doc_50632docxDoc_95199docxDoc_34769docx', 'random4.jpg'),
(310, 'Reincarnated', 'Nam ultrices libero non mattis pulvinar nulla pede ullamcorper augue a suscipit nulla elit ac nulla Sed vel enim sit amet nunc viverra dapibus Nulla suscipit ligula in lacus', '2020-02-08 00:10:36', '1', 1082, 1, 'Doc_84630docxDoc_57600docx', 'img1.jpg,random2.jpg'),
(312, 'Paradise Road', '\"Quisque id justo sit amet sapien dignissim vestibulum Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est Donec odio justo sollicitudin ut suscipit a feugiat et eros  Vestibulum ac est lacin', '2021-02-17 17:39:11', '1', 1093, 6, 'Doc_59441docx', 'random3.jpg,random7.jpg'),
(315, 'Gardens of Stone', 'Donec diam neque vestibulum eget vulputate ut ultrices vel augue Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin mi sit amet lobortis sapien ', '2021-02-18 13:55:11', '0', 1116, 7, 'Doc_59441docx', 'random3.jpg,random7.jpg'),
(321, 'Human Experience The', '\"Pellentesque at nulla Suspendisse potenti Cras in purus eu magna vulputate luctus  Cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus Vivamus vestibulum sagittis sapien Cum sociis natoque penatibus et magnis dis parturien', '2020-02-07 22:41:33', '1', 1087, 4, 'Doc_84630docxDoc_57600docx', 'random3.jpg,random7.jpg'),
(329, 'Wrong Turn 5: Bloodlines', '\"Vestibulum ac est lacinia nisi venenatis tristique Fusce congue diam id ornare imperdiet sapien urna pretium nisl ut volutpat sapien arcu sed augue Aliquam erat volutpat  In congue Etiam justo Etiam pretium iaculis justo\"', '2020-02-08 05:04:00', '1', 1087, 4, 'Doc_59441docx', 'random3.jpg,random7.jpg'),
(330, 'Samson & Sally', '\"Phasellus in felis Donec semper sapien a libero Nam dui  Proin leo odio porttitor id consequat in consequat ut nulla Sed accumsan felis Ut at dolor quis odio consequat varius\"', '2020-02-08 08:16:12', '1', 1089, 1, 'Doc_59441docx', 'img3.jpg,img4.jpg'),
(331, 'High and Low (Tengoku to jigoku)', '\"In hac habitasse platea dictumst Morbi vestibulum velit id pretium iaculis diam erat fermentum justo nec condimentum neque sapien placerat ante Nulla justo  Aliquam quis turpis eget elit sodales scelerisque Mauris sit amet eros Suspendisse accumsan torto', '2021-02-18 13:54:45', '1', 1083, 5, 'Doc_59441docx', 'img8.png'),
(336, 'Changing Habits', '\"Duis aliquam convallis nunc Proin at turpis a pede posuere nonummy Integer non velit  Donec diam neque vestibulum eget vulputate ut ultrices vel augue Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra ', '2021-02-18 01:53:33', '0', 1083, 5, 'Doc_59441docx', 'img8.png'),
(343, 'Thank Your Lucky Stars', 'Nam ultrices libero non mattis pulvinar nulla pede ullamcorper augue a suscipit nulla elit ac nulla Sed vel enim sit amet nunc viverra dapibus Nulla suscipit ligula in lacus', '2021-02-18 05:23:19', '1', 1104, 5, 'Doc_84630docxDoc_57600docx', 'random3.jpg,random7.jpg'),
(344, 'Goddess (Devi)', '\"Duis bibendum felis sed interdum venenatis turpis enim blandit mi in porttitor pede justo eu massa Donec dapibus Duis at velit eu est congue elementum  In hac habitasse platea dictumst Morbi vestibulum velit id pretium iaculis diam erat fermentum justo n', '2020-02-08 12:36:59', '0', 1111, 4, 'Doc_84630docxDoc_57600docx', 'img1.jpg,random2.jpg'),
(345, 'Reign Over Me', '\"Cras non velit nec nisi vulputate nonummy Maecenas tincidunt lacus at velit Vivamus vel nulla eget eros elementum pellentesque  Quisque porta volutpat erat Quisque erat eros viverra eget congue eget semper rutrum nulla Nunc purus\"', '2020-02-08 01:55:49', '0', 1089, 1, 'Doc_71144docxDoc_54464docx', 'random3.jpg,random7.jpg'),
(348, 'Adam Had Four Sons', '\"Nullam sit amet turpis elementum ligula vehicula consequat Morbi a ipsum Integer a nibh  In quis justo Maecenas rhoncus aliquam lacus Morbi quis tortor id nulla ultrices aliquet  Maecenas leo odio condimentum id luctus nec molestie sed justo Pellentesque', '2020-02-08 03:57:19', '1', 1091, 2, 'Doc_84630docxDoc_57600docx', 'img1jpgrandom2jpg'),
(350, 'Disturbia', '\"Cras mi pede malesuada in imperdiet et commodo vulputate justo In blandit ultrices enim Lorem ipsum dolor sit amet consectetuer adipiscing elit  Proin interdum mauris non ligula pellentesque ultrices Phasellus id sapien in sapien iaculis congue Vivamus m', '2020-02-08 10:55:03', '1', 1101, 2, 'Doc_71144docxDoc_54464docx', 'img3.jpg,img4.jpg'),
(351, 'Johns', '\"Nullam porttitor lacus at turpis Donec posuere metus vitae ipsum Aliquam non mauris  Morbi non lectus Aliquam sit amet diam in magna bibendum imperdiet Nullam orci pede venenatis non sodales sed tincidunt eu felis\"', '2020-02-08 12:29:07', '0', 1099, 3, 'Doc_59441docx', 'img3.jpg,img4.jpg'),
(353, 'Johns', '\"Nullam porttitor lacus at turpis Donec posuere metus vitae ipsum Aliquam non mauris  Morbi non lectus Aliquam sit amet diam in magna bibendum imperdiet Nullam orci pede venenatis non sodales sed tincidunt eu felis\"', '2020-02-08 12:29:07', '0', 1099, 3, 'Doc_59441docx', 'img3.jpg,img4.jpg'),
(356, 'Dawn Rider The', 'Curabitur gravida nisi at nibh In hac habitasse platea dictumst Aliquam augue quam sollicitudin vitae consectetuer eget rutrum at lorem', '2020-02-08 06:53:24', '1', 1118, 2, 'Doc_71144docxDoc_54464docx', 'img3.jpg,img4.jpg'),
(359, 'The Search for Santa Paws', '\"Sed sagittis Nam congue risus semper porta volutpat quam pede lobortis ligula sit amet eleifend pede libero quis orci Nullam molestie nibh in lectus  Pellentesque at nulla Suspendisse potenti Cras in purus eu magna vulputate luctus  Cum sociis natoque pe', '2020-02-08 01:43:12', '1', 1117, 2, 'Doc_59441docx', 'img3.jpg,img4.jpg'),
(367, 'Zerophilia', '\"Mauris enim leo rhoncus sed vestibulum sit amet cursus id turpis Integer aliquet massa id lobortis convallis tortor risus dapibus augue vel accumsan tellus nisi eu orci Mauris lacinia sapien quis libero  Nullam sit amet turpis elementum ligula vehicula c', '2020-02-08 14:55:00', '1', 1114, 1, 'Doc_84630docxDoc_57600docx', 'img1.jpg,random2.jpg'),
(368, 'Conan the Barbarian', '\"Sed ante Vivamus tortor Duis mattis egestas metus  Aenean fermentum Donec ut mauris eget massa tempor convallis Nulla neque libero convallis eget eleifend luctus ultricies eu nibh  Quisque id justo sit amet sapien dignissim vestibulum Vestibulum ante ips', '2020-02-07 18:23:37', '0', 1101, 2, 'Doc_59441docx', 'random3.jpg,random7.jpg'),
(374, 'Hot Tub Time Machine 2', '\"Quisque id justo sit amet sapien dignissim vestibulum Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est Donec odio justo sollicitudin ut suscipit a feugiat et eros  Vestibulum ac est lacin', '2020-02-07 19:05:52', '0', 1100, 2, 'Doc_84630docxDoc_57600docx', 'random3.jpg,random7.jpg'),
(378, 'Johns', '\"Nullam porttitor lacus at turpis Donec posuere metus vitae ipsum Aliquam non mauris  Morbi non lectus Aliquam sit amet diam in magna bibendum imperdiet Nullam orci pede venenatis non sodales sed tincidunt eu felis\"', '2020-02-08 12:29:07', '0', 1099, 3, 'Doc_59441docx', 'img3.jpg,img4.jpg'),
(399, 'Romeo and Juliet', 'Praesent blandit Nam nulla Integer pede justo lacinia eget tincidunt eget tempus vel pede', '2020-02-08 04:20:11', '1', 1112, 1, 'Doc_71144docxDoc_54464docx', 'random3.jpg,random7.jpg'),
(991, 'The Harmonists', '\"Fusce consequat Nulla nisl Nunc nisl  Duis bibendum felis sed interdum venenatis turpis enim blandit mi in porttitor pede justo eu massa Donec dapibus Duis at velit eu est congue elementum  In hac habitasse platea dictumst Morbi vestibulum velit id preti', '2020-02-08 09:22:38', '0', 1085, 3, 'Doc_59441docx', 'random3.jpg,random7.jpg'),
(992, 'The Harmonists', '\"Fusce consequat Nulla nisl Nunc nisl  Duis bibendum felis sed interdum venenatis turpis enim blandit mi in porttitor pede justo eu massa Donec dapibus Duis at velit eu est congue elementum  In hac habitasse platea dictumst Morbi vestibulum velit id preti', '2020-02-08 09:22:38', '0', 1085, 3, 'Doc_59441docx', 'random3.jpg,random7.jpg'),
(994, 'Ethel', '\"Integer tincidunt ante vel ipsum Praesent blandit lacinia erat Vestibulum sed magna at nunc commodo placerat  Praesent blandit Nam nulla Integer pede justo lacinia eget tincidunt eget tempus vel pede  Morbi porttitor lorem id ligula Suspendisse ornare co', '2020-02-08 10:40:21', '1', 1084, 3, 'Doc_59441docx', 'random3.jpg,random7.jpg'),
(995, 'Ethel', '\"Integer tincidunt ante vel ipsum Praesent blandit lacinia erat Vestibulum sed magna at nunc commodo placerat  Praesent blandit Nam nulla Integer pede justo lacinia eget tincidunt eget tempus vel pede  Morbi porttitor lorem id ligula Suspendisse ornare co', '2020-02-08 10:40:21', '1', 1084, 3, 'Doc_59441docx', 'random3.jpg,random7.jpg'),
(996, 'Harmonists The', '\"Fusce consequat Nulla nisl Nunc nisl  Duis bibendum felis sed interdum venenatis turpis enim blandit mi in porttitor pede justo eu massa Donec dapibus Duis at velit eu est congue elementum  In hac habitasse platea dictumst Morbi vestibulum velit id preti', '2020-02-08 09:22:38', '0', 1085, 3, 'Doc_59441docx', 'random3.jpg,random7.jpg');

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
(1, '2021-02-06 13:00:00', '2021-05-30 15:07:00', '2021-03-20 13:00:00', 2021, 'Submission C', 'Articles on current issues in compliance or related fields.', '1', 1),
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
(1002, 2, 'CoorA', 'coordinator@uog.com', '$2y$10$ZGEwSj/XyeH/S7aiMKGG7e/saJfG7UNAHcIWcCFmx68aQGtNVR/Aa', 2147483647, 'coordinator'),
(1003, 1, 'CoorB', 'coordinatorB@uog.com', '$2y$10$ZGEwSj/XyeH/S7aiMKGG7e/saJfG7UNAHcIWcCFmx68aQGtNVR/Aa', 2147483647, 'coordinator'),
(1004, 3, 'CoorC', 'coordinatorC@uog.com', '$2y$10$ZGEwSj/XyeH/S7aiMKGG7e/saJfG7UNAHcIWcCFmx68aQGtNVR/Aa', 2147483647, 'coordinator'),
(1005, 4, 'CoorD', 'coordinatorD@uog.com', '$2y$10$ZGEwSj/XyeH/S7aiMKGG7e/saJfG7UNAHcIWcCFmx68aQGtNVR/Aa', 2147483647, 'coordinator'),
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
(1080, 4, 'Kayley', 'kschult0@google.ca', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1081, 3, 'Keelby', 'kbeinisch1@hugedomains.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1082, 1, 'Afton', 'abottini2@jugem.jp', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1083, 1, 'Saul', 'swhitebrook3@sakura.ne.jp', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1084, 3, 'Sabina', 'ssanz4@amazon.co.jp', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1085, 3, 'Calley', 'cmcowen5@unc.edu', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1086, 4, 'Fowler', 'fpaling6@springer.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1087, 4, 'Waly', 'wditchett7@squarespace.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1088, 1, 'Dorey', 'dtomisch8@tinyurl.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 1486925675, 'student'),
(1089, 1, 'Giustino', 'gclutton9@cdbaby.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 1918528713, 'student'),
(1090, 2, 'Toni', 'ttomasiana@ebay.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 1952162718, 'student'),
(1091, 2, 'Clevie', 'creutherb@discuz.net', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2072814701, 'student'),
(1092, 2, 'Tate', 'tchaffeyc@tuttocitta.it', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 1365167719, 'student'),
(1093, 2, 'Lesya', 'lfauschd@redcross.org', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1094, 3, 'Immanuel', 'ishackesbye@shinystat.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1095, 3, 'Sampson', 'stalesf@nasa.gov', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1096, 4, 'Kizzie', 'korisg@mozilla.org', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1097, 4, 'Edythe', 'efullh@globo.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1098, 2, 'Evie', 'emcevillyi@icq.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1099, 3, 'Diego', 'drickabyj@furl.net', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1100, 2, 'Penn', 'ppolamontaynek@spotify.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1101, 2, 'Tobias', 'tboichatl@privacy.gov.au', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1102, 3, 'Nicolis', 'nbourdelm@unicef.org', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1103, 3, 'Terri', 'tgrabenn@quantcast.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1104, 1, 'Shaw', 'sollivierreo@gnu.org', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1105, 2, 'Adelina', 'allorentep@hubpages.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1106, 4, 'Aguie', 'aashleeq@engadget.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1107, 3, 'Pauletta', 'pwindmillr@springer.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1108, 4, 'Artus', 'apetzolts@hhs.gov', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1109, 2, 'Cheslie', 'csemont@ebay.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1110, 2, 'Granville', 'gbaiseu@linkedin.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1111, 4, 'Erminie', 'epaulssonv@plala.or.jp', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1112, 1, 'Yvor', 'ymathousew@people.com.cn', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1113, 1, 'Glenna', 'ghuorticx@yahoo.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1114, 1, 'Lotta', 'ldrewesy@wix.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1115, 4, 'Brittney', 'bmcdoolz@wunderground.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1116, 3, 'Garrek', 'gstillert10@cnet.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1117, 2, 'Lavina', 'lblackmoor11@psu.edu', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1118, 2, 'Patric', 'pspary12@marriott.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1119, 1, 'Bartel', 'bjackways13@topsy.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1120, 4, 'Sigismondo', 'sfeatherstonhaugh14@ycombinator.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1121, 3, 'Cathrin', 'cramelet15@bigcartel.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1122, 2, 'Aymer', 'aosburn16@howstuffworks.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1123, 2, 'Chad', 'craubenheimer17@lycos.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1124, 3, 'Valle', 'vsharrard18@blogger.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1125, 1, 'Jermaine', 'jpadula19@miibeian.gov.cn', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2007155505, 'student'),
(1126, 1, 'Edan', 'eknotte1a@instagram.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1127, 2, 'Anthe', 'abullick1b@indiegogo.com', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1128, 2, 'Witty', 'wbignall1c@ftc.gov', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student'),
(1129, 4, 'Barb', 'bkippie1d@yahoo.co.jp', '$2y$10$Ms0.X/5nRXFXVWI/vzTgjepUg4avYXu3ep0T8Z3ynEN0mLrPLz2/W', 2147483647, 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_message_id`);

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
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `studentsubmission`
--
ALTER TABLE `studentsubmission`
  MODIFY `StudentSubmissionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=997;

--
-- AUTO_INCREMENT for table `submission`
--
ALTER TABLE `submission`
  MODIFY `SubmissionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1130;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`StudentSubmissionID`) REFERENCES `studentsubmission` (`StudentSubmissionID`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`FacultyID`) REFERENCES `faculty` (`FacultyID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
