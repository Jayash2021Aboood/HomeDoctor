-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 11, 2024 at 06:08 AM
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
  `appointment_time` text NOT NULL,
  `price` int(11) NOT NULL,
  `state` varchar(50) NOT NULL DEFAULT 'request',
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `detail`, `patient_id`, `doctor_id`, `nurse_id`, `appointment_date`, `appointment_time`, `price`, `state`, `created_date`) VALUES
(1, 's', 8, 4, 5, '2024-04-26', '4', 200, 'accept', '2024-04-19 00:00:00'),
(2, 'سحب دم وقياس الضغط', 8, 4, 5, '2024-04-26', 'الساعة 4 العصر', 200, 'accept', '2024-04-19 00:00:00'),
(3, 'e', 8, 4, 4, '2024-04-26', 'الساعة 4 العصر', 200, 'reject', '2024-05-11 00:00:00'),
(4, 'r', 8, 4, 3, '2024-04-26', 'الساعة 4 العصر', 200, 'request', '2024-04-19 00:00:00'),
(6, 'a', 8, 4, NULL, '2024-04-27', 'الساعة 4 العصر', 200, 'request', '2024-04-19 00:00:00'),
(7, 'a', 8, 4, NULL, '2024-04-26', 'الساعة 4 العصر', 200, 'request', '2024-04-19 00:00:00'),
(8, 's', 8, NULL, 5, '2024-04-29', '8:40 PM', 200, 'reject', '2024-04-27 00:00:00'),
(9, 'gfd', 8, NULL, NULL, '2024-04-20', '5:pm', 200, 'request', '2024-04-20 00:00:00'),
(10, 'any description', 8, 1, NULL, '2024-05-03', '9 in morning', 200, 'request', '2024-04-20 00:00:00'),
(11, 'any data', 8, NULL, 3, '2024-04-30', 'الساعة 4 العصر', 200, 'request', '2024-04-20 02:17:18'),
(12, 'any', 9, 4, NULL, '2024-05-28', '8:40 PM', 200, 'accept', '2024-05-02 03:31:26'),
(13, 'سحب دم وقياس الضغط', 9, NULL, 5, '2024-05-24', '2:40 PM', 200, 'accept', '2024-05-06 20:20:55'),
(14, 'مجارحة وتنظيف جرح في القدم اليسرى', 9, 4, NULL, '2024-05-11', 'الساعة 2 بعد الظهر ', 250, 'accept', '2024-05-11 02:19:19');

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
(3, 'dd', 'dd', '09876777', 'dd@gmail.com', 'dd', 'جدة الشارع العام - جوار الحديقة', 'dd', '2024-04-15', '3', 'SimpleInvoc.pdf', 'request'),
(4, 'doc1', 'doc122', '098765', 'doc1@gmail.com', 'doc1', 'doc122', '11doc1', '2024-04-26', '1', 'invoice1.pdf', 'accept');

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

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`id`, `appointment_id`, `name`, `detail`) VALUES
(1, 12, 'Panadol', '1*2*7 حبتين في اليوم لمدة اسبوعين بعد الصبوح والعشاء'),
(2, 12, 'Voltarine 25mg', 'amp 1*2 after lunch'),
(3, 12, 'ceaftricson', '1*2*15'),
(4, 1, 'Voltarine 25mg', 'amp 1*2 after lunch'),
(5, 1, 'كورتيزول', 'صباح ومساء حبتين بعد كل وجبه'),
(6, 13, 'Actifed', 'seab 1*2 '),
(7, 14, 'sss', ';lkjhg');

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
(3, '12', '12', '12', '12@gmail.com', '12', 'جدة الشارع العام - جوار الحديقة', '12', '2024-04-01', '12', 'SimpleInvoc.pdf', 'request'),
(4, 'nono', 'nono', 'nono', 'nono@gmail.com', 'nono', 'nono', 'nono', '2024-04-16', '3', 'SimpleInvoc1.pdf', 'request'),
(5, 'nur1', 'nur1', '098765', 'nur1@gmail.com', 'nur1', 'nur1', 'nur1', '2024-04-19', '2', 'invoice1.pdf', 'accept');

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
(7, 'hola', '', '876543', 'ssaa3002012@gmail.com', 'hola', '', '0000-00-00', 0, 0, 0, NULL, 0, NULL),
(8, 'p', 'p', 'p', 'p@gmail.com', 'p', 'p', '2024-04-19', 170, 45, 1, '', 1, 'Fish'),
(9, 'popop', 'jjjpopo', '0987', 'po@gmail.com', 'po', 'po', '2024-04-21', 189, 34, 1, '', 1, '');

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
(4, 250);

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
(10, 'ssaa3002012@gmail.com', 's'),
(11, 'nono@gmail.com', 'n'),
(12, 'nur1@gmail.com', 'n'),
(13, 'doc1@gmail.com', 'd'),
(14, 'p@gmail.com', 'p'),
(15, 'po@gmail.com', 'p');

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
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
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
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nurse`
--
ALTER TABLE `nurse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `webuser`
--
ALTER TABLE `webuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
-- Constraints for table `medicine`
--
ALTER TABLE `medicine`
  ADD CONSTRAINT `fk_appointment_medicine` FOREIGN KEY (`appointment_id`) REFERENCES `appointment` (`id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_appointment_payment` FOREIGN KEY (`appointment_id`) REFERENCES `appointment` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
