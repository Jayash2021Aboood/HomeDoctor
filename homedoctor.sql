-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 14, 2024 at 11:04 PM
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
-- Database: `homedoctor`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `nurse_id` int(11) DEFAULT NULL,
  `appointment_date` date NOT NULL,
  `price` int(11) NOT NULL,
  `state` varchar(50) NOT NULL DEFAULT 'request'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `name`, `phone`, `email`, `address`, `nationality`) VALUES
(1, 'Robert Steve', '', '', '', ''),
(2, 'Test Author', '11112222333', 'TestAuthor@gmail.com', 'Test Author', 'Test Author');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number_copies` int(11) NOT NULL,
  `publish_date` date NOT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `book_image` varchar(255) DEFAULT NULL,
  `book_file` varchar(255) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `name`, `number_copies`, `publish_date`, `detail`, `book_image`, `book_file`, `author_id`, `publisher_id`, `section_id`, `language_id`) VALUES
(1, 'C++ for dummies', 6, '2016-01-25', '', 'Screenshot_٢٠٢٠٠٧٠٩_٢٠٢٧١٦.jpg', '', 1, 1, 1, 1),
(2, 'Book 2', 2, '2020-05-15', 'Consectetur adipiscing elit', 'book2.jpg', 'book2.pdf', 1, 1, 1, 1),
(3, 'Book 3', 8, '2019-11-30', 'Sed do eiusmod tempor incididunt', 'book3.jpg', 'book3.pdf', 2, 1, 1, 2),
(4, 'Book 4', 2, '2022-03-10', 'Ut enim ad minim veniam', 'book4.jpg', 'book4.pdf', 2, 1, 1, 1),
(5, 'Book 5', 7, '2021-05-01', 'This is book 5', 'book5.jpg', 'book5.pdf', 1, 1, 1, 1),
(6, 'Book 6', 9, '2021-06-01', 'This is book 6', 'book6.jpg', 'book6.pdf', 1, 1, 1, 1),
(7, 'Book 7', 11, '2021-07-01', 'This is book 7', 'book7.jpg', 'book7.pdf', 1, 1, 1, 1),
(8, 'Book 8', 6, '2021-08-01', 'This is book 8', 'book8.jpg', 'book8.pdf', 1, 1, 1, 1),
(9, 'Book 9', 10, '2021-09-01', 'This is book 9', 'book9.jpg', 'book9.pdf', 1, 1, 1, 1),
(10, 'Book 10', 13, '2021-10-01', 'This is book 10', 'book10.jpg', 'book10.pdf', 1, 1, 1, 1),
(11, 'Book 11', 14, '2021-11-01', 'This is book 11', 'book11.jpg', 'book11.pdf', 1, 1, 1, 1),
(12, 'Book 12', 15, '2021-12-01', 'This is book 12', 'book12.jpg', 'book12.pdf', 1, 1, 1, 1),
(13, 'Book 13', 16, '2021-11-01', 'This is book 13', 'book13.jpg', 'book13.pdf', 1, 1, 1, 1),
(14, 'Book 14', 17, '2021-12-01', 'This is book 14', 'book14.jpg', 'book14.pdf', 1, 1, 1, 1),
(15, 'Book 15', 7, '2021-03-01', 'This is book 15', 'book15.jpg', 'book15.pdf', 1, 1, 1, 1),
(16, 'Book 16', 10, '2021-04-01', 'This is book 16', 'book16.jpg', 'book16.pdf', 1, 1, 1, 1),
(17, 'Book 17', 14, '2021-05-01', 'This is book 17', 'book17.jpg', 'book17.pdf', 1, 1, 1, 1),
(18, 'Book 18', 5, '2021-06-01', 'This is book 18', 'book18.jpg', 'book18.pdf', 1, 1, 1, 1),
(19, 'Book 19', 13, '2021-07-01', 'This is book 19', 'book19.jpg', 'book19.pdf', 1, 1, 1, 1),
(20, 'Book 20', 23, '2021-12-01', 'This is book 20', 'book20.jpg', 'book20.pdf', 1, 1, 1, 1),
(21, 'Book 21', 24, '2021-11-01', 'This is book 21', 'book21.jpg', 'book21.pdf', 1, 1, 1, 1),
(22, 'Book 22', 25, '2021-12-01', 'This is book 22', 'book22.jpg', 'book22.pdf', 1, 1, 1, 1),
(23, 'Book 23', 26, '2021-11-01', 'This is book 23', 'book23.jpg', 'book23.pdf', 1, 1, 1, 1),
(24, 'Book 24', 27, '2021-12-01', 'This is book 24', 'book24.jpg', 'book24.pdf', 1, 1, 1, 1),
(25, 'Book 25', 28, '2021-11-01', 'This is book 25', 'book25.jpg', 'book25.pdf', 1, 1, 1, 1),
(26, 'c++ fundmintails', 2, '2023-07-04', 'اي شيء اكتب هنا براحتك يااصل العرب', 'WhatsApp Image 2023-07-03 at 7.41.13 PM.jpeg', '', 2, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`id`, `name`) VALUES
(1, 'الهندسة وتكنولوجيا المعلومات'),
(2, 'التجارة والاقتصاد'),
(3, 'الشريعة والقانون'),
(4, 'الاعلام'),
(5, 'الزراعة'),
(6, 'التربية'),
(7, 'الطب البشري');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `college_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `college_id`, `name`) VALUES
(1, 1, 'تقنية معلومات'),
(2, 1, 'نظم معلومات'),
(3, 2, 'علوم مالية ومصرفية'),
(4, 2, 'محاسبة تكاليف'),
(5, 2, 'علوم ادارية');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `specialty` varchar(255) NOT NULL,
  `date_of_graduate` date NOT NULL,
  `experience_years` varchar(50) NOT NULL,
  `cv` varchar(255) NOT NULL,
  `state` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `first_name`, `last_name`, `phone`, `email`, `password`, `location`, `specialty`, `date_of_graduate`, `experience_years`, `cv`, `state`) VALUES
(1, 'Ali', 'Naser', '0987654321', 'ali@gmail.com', 'ali', 'Jeddah', 'Interior designer / supervisor', '2019-01-18', '3 years', 'h1.jpg', 'accept'),
(2, 'q', 'q', 'q', 'q@gmail.com', 'q', 'q', 'q', '2023-02-19', '6 years', 'h3.jpg', 'request'),
(3, 'dd', 'dd', '09876777', 'dd@gmail.com', 'dd', 'جدة الشارع العام - جوار الحديقة', 'dd', '2024-04-15', '3', 'SimpleInvoc.pdf', 'request');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `phone`, `email`, `password`, `address`) VALUES
(1, 'huda', '778866554', 'huda@gmail.com', 'huda', ''),
(2, 'q', '77885533', 'q@gmail.com', 'q', 'bayda radaa'),
(3, 'Ali', '778844332', 'ali@gmail.com', 'ali', 'Bayda radaa'),
(4, 'خالد الملاحي', '776655446', 'k@gmail.com', 'k', 'رداع - الشارع العام - جوار محل الشبس'),
(5, 'gg', '5533', 'gg@gmail.com', '', 'gg');

-- --------------------------------------------------------

--
-- Table structure for table `fine`
--

CREATE TABLE `fine` (
  `id` int(11) NOT NULL,
  `issue_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `state` varchar(255) NOT NULL DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `fine`
--

INSERT INTO `fine` (`id`, `issue_id`, `student_id`, `amount`, `state`) VALUES
(1, 2, 1, 2, 'draft'),
(2, 11, 3, 360, 'deported'),
(3, 12, 3, 240, 'canceled'),
(4, 9, 3, 360, 'draft');

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE `issue` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `fine_per_day` int(11) NOT NULL,
  `total_fine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `issue`
--

INSERT INTO `issue` (`id`, `book_id`, `student_id`, `issue_date`, `due_date`, `return_date`, `fine_per_day`, `total_fine`) VALUES
(1, 1, 2, '2023-12-31', '2023-01-08', '0000-00-00', 200, 1),
(2, 1, 1, '2023-05-01', '2023-05-05', '0000-00-00', 100, 100),
(3, 1, 2, '2023-06-13', '2023-06-13', '2023-06-13', 120, 120),
(4, 25, 2, '2023-06-27', '2023-06-30', '0001-01-31', 200, 10),
(5, 20, 2, '2023-06-27', '2023-06-30', '2023-07-01', 100, 100),
(6, 9, 1, '2023-06-29', '2023-07-04', '2023-07-03', 400, 0),
(7, 6, 2, '2023-06-29', '2023-07-02', '0000-00-00', 120, 0),
(8, 24, 2, '2023-06-29', '2023-07-02', '0000-00-00', 120, 0),
(9, 2, 3, '2023-06-29', '2023-07-02', '2023-07-05', 120, 360),
(10, 2, 1, '2023-06-29', '2023-07-02', '2023-06-30', 120, 0),
(11, 10, 3, '2023-06-30', '2023-07-03', '2023-06-30', 120, 360),
(12, 9, 3, '2023-06-25', '2023-06-28', '2023-06-30', 120, 240),
(13, 9, 3, '2023-07-03', '2023-07-06', '0000-00-00', 120, 0);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `name`, `code`) VALUES
(1, 'Arabic', 'ar'),
(2, 'English', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `name`) VALUES
(1, 'بكالوريوس'),
(2, 'ماجستير'),
(3, 'دكتوراه');

-- --------------------------------------------------------

--
-- Table structure for table `library`
--

CREATE TABLE `library` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `library`
--

INSERT INTO `library` (`id`, `name`) VALUES
(1, 'Bayda Library');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `detail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nurse`
--

CREATE TABLE `nurse` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `specialty` varchar(255) NOT NULL,
  `date_of_graduate` date NOT NULL,
  `experience_years` varchar(50) NOT NULL,
  `cv` varchar(255) NOT NULL,
  `state` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nurse`
--

INSERT INTO `nurse` (`id`, `first_name`, `last_name`, `phone`, `email`, `password`, `location`, `specialty`, `date_of_graduate`, `experience_years`, `cv`, `state`) VALUES
(1, 'Ali', 'Naser', '0987654321', 'ali@gmail.com', 'ali', 'Jeddah', 'Interior designer / supervisor', '2019-01-18', '3 years', 'h1.jpg', 'accept'),
(2, 'q', 'q', 'q', 'q@gmail.com', 'q', 'q', 'q', '2023-02-19', '6 years', 'h3.jpg', 'request'),
(3, '12', '12', '12', '12@gmail.com', '12', 'جدة الشارع العام - جوار الحديقة', '12', '2024-04-01', '12', 'SimpleInvoc.pdf', 'request');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `height` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `has_chronic_disease` tinyint(1) NOT NULL DEFAULT 0,
  `what_are_diseases` varchar(255) DEFAULT NULL,
  `has_allergic_to_anything` tinyint(1) NOT NULL DEFAULT 0,
  `what_are_things` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `first_name`, `last_name`, `phone`, `email`, `password`, `location`, `date_of_birth`, `height`, `weight`, `has_chronic_disease`, `what_are_diseases`, `has_allergic_to_anything`, `what_are_things`) VALUES
(1, 'hadeel', '', '77665555', 'hadeel@gmail.com', 'hadeel', '', '0000-00-00', 0, 0, 0, NULL, 0, NULL),
(2, 'bushra', '', '778899009', 'bushra@gmail.com', 'bushra', '', '0000-00-00', 0, 0, 0, NULL, 0, NULL),
(3, 'محمد خالد ', 'عبدالرؤف', '7766554434', 'm@gmail.com', 'm', 'جدة الشارع العام - جوار الحديقة', '2024-04-15', 160, 60, 1, '', 1, ''),
(5, 't', '', '00', 't@gmail.com', '', '', '0000-00-00', 0, 0, 0, NULL, 0, NULL),
(7, 'hola', '', '876543', 'ssaa3002012@gmail.com', 'hola', '', '0000-00-00', 0, 0, 0, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `paid_price` int(11) NOT NULL,
  `payment_method` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`id`, `name`, `phone`, `email`, `address`) VALUES
(1, 'Golden House ', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `number` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `parent_id`, `number`, `name`) VALUES
(1, NULL, '000', 'الاعمال العامة'),
(10, NULL, '200', 'الديانات'),
(11, NULL, '100', ' الفلسفة والعلوم المتصلة بها'),
(12, NULL, '300', 'العلوم الاجتماعية'),
(13, NULL, '400', ' اللغات'),
(14, NULL, '500', ' العلوم البحتة'),
(15, NULL, '600', ' التكنولوجيا (العلوم التطبيقية)'),
(16, NULL, '700', ' الآداب'),
(17, NULL, '800', 'الجغرافية العامة والتاريخ '),
(18, NULL, '900', 'قسم رقم 9'),
(19, NULL, '1000', 'قسم رقم 1000'),
(20, 13, '400', 'اللغات'),
(21, 20, '400', ' مقارنة اللغات'),
(22, 1, '000', 'الاعدادات العامة'),
(23, 22, '000', 'الاعدادات العامة');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `appointment_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `appointment_price`) VALUES
(4, 200);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `state` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `phone`, `email`, `password`, `department_id`, `level_id`, `state`, `active`) VALUES
(1, 'hadeel', '77665555', 'hadeel@gmail.com', 'hadeel', 1, 1, 'any', 1),
(2, 'bushra', '778899009', 'bushra@gmail.com', 'bushra', 3, 1, 'any', 0),
(3, 'محمد خالد عبدالرؤف', '7766554434', 'm@gmail.com', 'm', 1, 1, 'Any', 1),
(5, 't', '00', 't@gmail.com', '', 5, 1, 'any', 1),
(7, 'hola', '876543', 'ssaa3002012@gmail.com', 'hola', 4, 1, 'any', 1);

-- --------------------------------------------------------

--
-- Table structure for table `webuser`
--

CREATE TABLE `webuser` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usertype` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `webuser`
--

INSERT INTO `webuser` (`id`, `email`, `usertype`) VALUES
(1, 'admin@gmail.com', 'a'),
(2, 'ali@gmail.com', 'e'),
(3, 'q@gmail.com', 'e'),
(4, 'maryam@gmail.com', 'c'),
(5, 'bushra@gmail.com', 's'),
(6, 'hadeel@gmail.com', 's'),
(7, 'm@gmail.com', 's'),
(8, 't@gmail.com', 's'),
(9, 'gg@gmail.com', 'e'),
(10, 'ssaa3002012@gmail.com', 's');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patient_appointment` (`patient_id`),
  ADD KEY `fk_doctor_appointment` (`doctor_id`),
  ADD KEY `fk_nurse_appointment` (`nurse_id`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_book_author` (`author_id`),
  ADD KEY `fk_book_publisher` (`publisher_id`),
  ADD KEY `fk_book_section` (`section_id`),
  ADD KEY `fk_book_language` (`language_id`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_department_college` (`college_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fine`
--
ALTER TABLE `fine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fine_issue` (`issue_id`),
  ADD KEY `fk_fine_student` (`student_id`);

--
-- Indexes for table `issue`
--
ALTER TABLE `issue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_issue_book` (`book_id`),
  ADD KEY `fk_issue_student` (`student_id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `library`
--
ALTER TABLE `library`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_appointment_medicine` (`appointment_id`);

--
-- Indexes for table `nurse`
--
ALTER TABLE `nurse`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_appointment_payment` (`appointment_id`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_section_section` (`parent_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_student_department` (`department_id`),
  ADD KEY `fk_student_level` (`level_id`);

--
-- Indexes for table `webuser`
--
ALTER TABLE `webuser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fine`
--
ALTER TABLE `fine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `issue`
--
ALTER TABLE `issue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `library`
--
ALTER TABLE `library`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nurse`
--
ALTER TABLE `nurse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `webuser`
--
ALTER TABLE `webuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `fk_doctor_appointment` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`),
  ADD CONSTRAINT `fk_nurse_appointment` FOREIGN KEY (`nurse_id`) REFERENCES `nurse` (`id`),
  ADD CONSTRAINT `fk_patient_appointment` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`);

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `fk_book_author` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`),
  ADD CONSTRAINT `fk_book_language` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`),
  ADD CONSTRAINT `fk_book_publisher` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`id`),
  ADD CONSTRAINT `fk_book_section` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `fk_department_college` FOREIGN KEY (`college_id`) REFERENCES `college` (`id`);

--
-- Constraints for table `fine`
--
ALTER TABLE `fine`
  ADD CONSTRAINT `fk_fine_issue` FOREIGN KEY (`issue_id`) REFERENCES `issue` (`id`),
  ADD CONSTRAINT `fk_fine_student` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`);

--
-- Constraints for table `issue`
--
ALTER TABLE `issue`
  ADD CONSTRAINT `fk_issue_book` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`),
  ADD CONSTRAINT `fk_issue_student` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`);

--
-- Constraints for table `medicine`
--
ALTER TABLE `medicine`
  ADD CONSTRAINT `fk_appointment_medicine` FOREIGN KEY (`appointment_id`) REFERENCES `appointment` (`id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_appointment_payment` FOREIGN KEY (`appointment_id`) REFERENCES `appointment` (`id`);

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `fk_section_section` FOREIGN KEY (`parent_id`) REFERENCES `section` (`id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_student_department` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`),
  ADD CONSTRAINT `fk_student_level` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
