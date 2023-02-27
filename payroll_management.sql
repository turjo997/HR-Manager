-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 23, 2023 at 05:35 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_fields`
--

CREATE TABLE `additional_fields` (
  `id` int(100) NOT NULL,
  `field` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `additional_fields`
--

INSERT INTO `additional_fields` (`id`, `field`) VALUES
(1, 'Bonus'),
(2, 'puja bonus'),
(3, 'Eid'),
(7, 'random1');

-- --------------------------------------------------------

--
-- Table structure for table `additional_fields_val`
--

CREATE TABLE `additional_fields_val` (
  `id` int(100) NOT NULL,
  `pay_id` int(100) NOT NULL,
  `emp_id` int(100) NOT NULL,
  `field` varchar(200) NOT NULL,
  `value` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `additional_fields_val`
--

INSERT INTO `additional_fields_val` (`id`, `pay_id`, `emp_id`, `field`, `value`) VALUES
(75, 57, 64, 'bonus', 2000),
(76, 57, 64, 'puja bonus', 4000),
(77, 58, 15, 'bonus', 1000),
(78, 58, 15, 'puja bonus', 3000),
(79, 58, 64, 'bonus', 2000),
(80, 58, 64, 'puja bonus', 4000),
(81, 59, 15, 'bonus', 1000),
(82, 59, 15, 'puja bonus', 3000),
(83, 59, 64, 'bonus', 2000),
(84, 59, 64, 'puja bonus', 4000),
(85, 60, 15, 'bonus', 1000),
(86, 60, 15, 'puja bonus', 3000),
(87, 60, 64, 'bonus', 2000),
(88, 60, 64, 'puja bonus', 4000),
(89, 61, 15, 'bonus', 1000),
(90, 61, 15, 'puja bonus', 3000),
(91, 61, 64, 'bonus', 2000),
(92, 61, 64, 'puja bonus', 4000),
(93, 62, 15, 'bonus', 1000),
(94, 62, 15, 'puja bonus', 3000),
(95, 62, 64, 'bonus', 2000),
(96, 62, 64, 'puja bonus', 4000),
(97, 63, 15, 'bonus', 1000),
(98, 63, 15, 'puja bonus', 3000),
(99, 63, 64, 'bonus', 2000),
(100, 63, 64, 'puja bonus', 4000),
(101, 64, 15, 'bonus', 1000),
(102, 64, 15, 'puja bonus', 3000),
(103, 64, 64, 'bonus', 2000),
(104, 64, 64, 'puja bonus', 4000),
(105, 65, 15, 'bonus', 1000),
(106, 65, 15, 'puja bonus', 3000),
(107, 65, 64, 'bonus', 2000),
(108, 65, 64, 'puja bonus', 4000),
(109, 64, 15, 'bonus', 1000),
(110, 64, 15, 'puja bonus', 3000),
(111, 64, 15, 'bonus', 1000),
(112, 64, 15, 'puja bonus', 3000),
(113, 101, 73, 'Bonus', 3000),
(114, 101, 73, 'puja bonus', 1000),
(115, 101, 73, 'Eid', 0),
(116, 99, 73, 'Bonus', 3000),
(117, 99, 73, 'puja bonus', 1000),
(118, 99, 73, 'Eid', 0),
(119, 103, 73, 'Bonus', 3000),
(120, 103, 73, 'puja bonus', 1000),
(121, 103, 73, 'Eid', 0),
(122, 104, 76, 'Bonus', 0),
(123, 104, 76, 'puja bonus', 1000),
(124, 104, 76, 'Eid', 0),
(125, 105, 76, 'Bonus', 0),
(126, 105, 76, 'puja bonus', 1000),
(127, 105, 76, 'Eid', 0),
(128, 106, 77, 'Bonus', 0),
(129, 106, 77, 'puja bonus', 10000),
(130, 106, 77, 'Eid', 0),
(131, 107, 78, 'Bonus', 20000),
(132, 107, 78, 'puja bonus', 1000),
(133, 107, 78, 'Eid', 0),
(134, 107, 78, 'random1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE `contract` (
  `id` int(200) NOT NULL,
  `emp_id` int(200) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `gross_salary` int(200) NOT NULL,
  `basic` int(200) DEFAULT NULL,
  `house_rent` int(200) DEFAULT NULL,
  `convergence` int(200) DEFAULT NULL,
  `medical` int(200) DEFAULT NULL,
  `probation_start_date` date NOT NULL,
  `probation_end_date` date NOT NULL,
  `working_days` int(200) DEFAULT NULL,
  `total_leave` int(200) NOT NULL,
  `deduction` int(200) DEFAULT NULL,
  `net_salary` int(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contract`
--

INSERT INTO `contract` (`id`, `emp_id`, `start_date`, `end_date`, `gross_salary`, `basic`, `house_rent`, `convergence`, `medical`, `probation_start_date`, `probation_end_date`, `working_days`, `total_leave`, `deduction`, `net_salary`) VALUES
(5, 17, '2023-02-21', '2023-03-02', 20000, 12000, 4000, 2000, 2000, '2023-02-06', '2023-02-13', 0, 0, 0, 0),
(7, 39, '2023-02-20', '2023-02-07', 50000, 0, 0, 0, 0, '2023-02-07', '2023-02-06', 0, 0, 0, 0),
(9, 42, '2023-02-06', '2023-02-14', 50000, 0, 0, 0, 0, '2023-02-14', '2023-02-20', 0, 0, 0, 0),
(10, 64, '2023-02-14', '2023-02-07', 50000, 0, 0, 0, 0, '2023-02-22', '2023-02-28', 0, 0, 0, 0),
(11, 65, '2023-02-01', '2023-05-24', 70000, 0, 0, 0, 0, '2023-02-22', '2023-02-23', 0, 0, 0, 0),
(12, 66, '2023-02-01', '2023-02-25', 50000, 0, 0, 0, 0, '2023-02-13', '2023-02-18', 0, 0, 0, 0),
(13, 67, '2023-02-22', '2023-02-23', 50000, 0, 0, 0, 0, '2023-02-28', '2023-02-23', 0, 0, 0, 0),
(14, 68, '2023-02-22', '2023-02-25', 50000, 0, 0, 0, 0, '2023-02-02', '2023-02-22', 0, 0, 0, 0),
(15, 73, '2023-02-06', '2023-02-16', 50000, 0, 0, 0, 0, '2023-02-16', '2023-02-16', 0, 0, 0, 0),
(16, 74, '2023-02-06', '2023-02-24', 40000, 24000, 8000, 4000, 4000, '2023-02-08', '2023-02-22', 0, 0, 0, 0),
(17, 76, '2023-02-09', '2023-02-09', 40000, 24000, 8000, 4000, 4000, '2023-02-09', '2023-02-24', 0, 0, 0, 0),
(18, 77, '2023-02-01', '2023-02-09', 50000, 30000, 10000, 5000, 5000, '2023-01-31', '2023-02-10', 0, 0, 0, 0),
(19, 78, '2023-02-08', '2023-02-17', 50000, 30000, 10000, 5000, 5000, '2023-01-31', '2023-02-16', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(200) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL,
  `photos` varchar(255) NOT NULL,
  `employee_id_code` varchar(255) NOT NULL,
  `joining_date` date NOT NULL,
  `dob` date NOT NULL,
  `status` tinyint(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `email`, `password`, `photos`, `employee_id_code`, `joining_date`, `dob`, `status`) VALUES
(17, 'Ullash Bh', 'ullash123@gmail.com ', '', '1.png', '#1111', '2023-02-23', '2023-02-22', 1),
(39, 'Ullash Bhattacharjee', 'ullasj6as78@gmail.com ', '', '1.png', '12345', '2023-02-14', '2023-02-13', 1),
(41, 'Ullash Bhattacharjee', 'tuerjert9uu8737@gmail.com ', '', '1.png', '2323', '2023-02-13', '2023-02-13', 1),
(42, 'Ullash Bhattacharjee', 'tuerjert9uu8as737@gmail.com ', '', 'fruit2.jpg', '2323', '2023-02-13', '2023-02-13', 1),
(64, 'juta', 'jutssadfaa@gmail.com ', '', 'book5.jpeg', '1222', '2023-02-27', '2023-02-14', 1),
(65, 'harun', 'harun@gmail.com', '', 'module_table_bottom.png', '12321', '2023-02-06', '2023-02-13', 1),
(66, 'Ratan Ghosh', 'ratan767@gmail.com ', '', '1.png', '#1233', '2023-02-01', '1998-04-14', 1),
(67, 'jasim', 'jasim@gmail.com ', '', 'fruit2.jpg', '1222', '2023-02-22', '2023-02-14', 1),
(68, 'jiad', 'jiad12@gmail.com ', '', 'yulia.jpg', '1233', '2023-02-16', '2023-02-24', 1),
(72, 'aniss', 'aniss@gmail.com', '', '../images/fruit2.jpg', '122211', '2023-02-22', '2023-02-21', 1),
(73, 'kishan', 'kishan@gmail.com ', '', '../images/first.png', '1222', '2023-02-15', '2023-02-08', 1),
(74, 'joinul', 'joinul@gmail.com ', '', '../images/favIcon.png', '1222', '2023-02-23', '2023-02-22', 1),
(75, 'karun', 'karun@gmail.com ', 'e10adc3949ba59abbe56e057f20f883e', '../images/user.jpg', '1233', '2023-02-17', '2023-02-10', 1),
(76, 'Asish', 'asish@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '../images/fruit3.jpg', '123322', '2023-02-10', '2023-02-10', 1),
(77, 'jishan', 'jishan@gmail.com ', 'e10adc3949ba59abbe56e057f20f883e', '../images/bar.png', '12345', '2023-02-16', '2023-02-08', 1),
(78, 'Jony', 'jony@gmail.com ', 'e10adc3949ba59abbe56e057f20f883e', '../images/fruit2.jpg', '12345', '2023-02-15', '2023-02-15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id` int(200) NOT NULL,
  `month` text NOT NULL,
  `year` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`id`, `month`, `year`) VALUES
(53, 'january', '2029'),
(54, 'november', '2029'),
(55, 'may', '2029'),
(56, 'june', '2024'),
(57, 'march', '2025'),
(58, 'september', '2026'),
(59, 'august', '2027'),
(60, 'february', '2028'),
(61, 'august', '2028'),
(62, 'april', '2026'),
(63, 'june', '2026'),
(98, 'december', '2020'),
(102, 'january', '2020'),
(103, 'january', '2031'),
(104, 'august', '2040'),
(105, 'april', '2031'),
(106, 'january', '2033'),
(107, 'january', '2032');

-- --------------------------------------------------------

--
-- Table structure for table `payroll_details`
--

CREATE TABLE `payroll_details` (
  `id` int(100) NOT NULL,
  `pay_id` int(100) NOT NULL,
  `emp_id` int(100) NOT NULL,
  `basic` int(100) NOT NULL,
  `house_rent` int(100) NOT NULL,
  `convergence` int(100) NOT NULL,
  `medical` int(100) NOT NULL,
  `working_days` int(100) NOT NULL,
  `tot_leave` int(100) NOT NULL,
  `deduction` int(100) NOT NULL,
  `net` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll_details`
--

INSERT INTO `payroll_details` (`id`, `pay_id`, `emp_id`, `basic`, `house_rent`, `convergence`, `medical`, `working_days`, `tot_leave`, `deduction`, `net`) VALUES
(544, 58, 64, 30000, 10000, 5000, 5000, 30, 0, 0, 8023),
(545, 59, 15, 30000, 10000, 5000, 5000, 30, 0, 0, 54000),
(546, 59, 64, 30000, 10000, 5000, 5000, 30, 0, 0, 56000),
(547, 60, 15, 30000, 10000, 5000, 5000, 30, 0, 0, 54000),
(548, 60, 64, 30000, 10000, 5000, 5000, 30, 0, 0, 56000),
(549, 61, 15, 30000, 10000, 5000, 5000, 30, 0, 0, 54000),
(550, 61, 64, 30000, 10000, 5000, 5000, 30, 0, 0, 56000),
(551, 62, 15, 30000, 10000, 5000, 5000, 30, 0, 0, 54000),
(552, 62, 64, 30000, 10000, 5000, 5000, 30, 0, 0, 56000),
(553, 63, 15, 30000, 10000, 5000, 5000, 30, 0, 0, 54000),
(554, 63, 64, 30000, 10000, 5000, 5000, 30, 0, 0, 56000),
(555, 64, 15, 30000, 10000, 5000, 5000, 30, 0, 0, 54000),
(556, 64, 64, 30000, 10000, 5000, 5000, 30, 0, 0, 56000),
(557, 65, 15, 30000, 10000, 5000, 5000, 30, 0, 0, 54000),
(558, 65, 64, 30000, 10000, 5000, 5000, 30, 0, 0, 56000),
(559, 64, 15, 30000, 10000, 5000, 5000, 30, 0, 0, 54000),
(560, 64, 15, 30000, 10000, 5000, 5000, 30, 0, 0, 54000),
(561, 99, 14, 30000, 10000, 5000, 5000, 30, 0, 0, 50000),
(562, 99, 39, 30000, 10000, 5000, 5000, 30, 5, 8333, 41667),
(563, 99, 14, 30000, 10000, 5000, 5000, 30, 0, 0, 50000),
(564, 99, 39, 30000, 10000, 5000, 5000, 30, 5, 8333, 41667),
(565, 101, 73, 30000, 10000, 5000, 5000, 30, 0, 0, 54000),
(566, 99, 73, 30000, 10000, 5000, 5000, 30, 0, 0, 54000),
(567, 103, 73, 30000, 10000, 5000, 5000, 30, 0, 0, 54000),
(568, 104, 76, 30000, 10000, 5000, 5000, 30, 0, 0, 51000),
(569, 105, 76, 24000, 8000, 4000, 4000, 30, 0, 0, 41000),
(570, 106, 77, 30000, 10000, 5000, 5000, 30, 0, 0, 60000),
(571, 107, 78, 30000, 10000, 5000, 5000, 30, 0, 0, 71000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_fields`
--
ALTER TABLE `additional_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `additional_fields_val`
--
ALTER TABLE `additional_fields_val`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll_details`
--
ALTER TABLE `payroll_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional_fields`
--
ALTER TABLE `additional_fields`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `additional_fields_val`
--
ALTER TABLE `additional_fields_val`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contract`
--
ALTER TABLE `contract`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `payroll_details`
--
ALTER TABLE `payroll_details`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=572;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contract`
--
ALTER TABLE `contract`
  ADD CONSTRAINT `contract_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
