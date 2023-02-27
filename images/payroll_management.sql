-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 11, 2023 at 12:02 AM
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
(4, 14, '2023-02-13', '2023-02-13', 10000, 6000, 2000, 1000, 1000, '2023-02-14', '2023-02-20', 0, 0, 0, 0),
(5, 17, '2023-02-21', '2023-03-02', 20000, 12000, 4000, 2000, 2000, '2023-02-06', '2023-02-13', 0, 0, 0, 0),
(6, 15, '2023-02-28', '2023-02-11', 50000, 30000, 10000, 5000, 5000, '2023-02-15', '2023-02-13', 0, 0, 0, 0),
(7, 39, '2023-02-20', '2023-02-07', 50000, 0, 0, 0, 0, '2023-02-07', '2023-02-06', 0, 0, 0, 0),
(8, 43, '2023-02-15', '2023-02-28', 60000, 0, 0, 0, 0, '2023-02-22', '2023-02-20', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(200) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `photos` varchar(255) NOT NULL,
  `employee_id_code` varchar(255) NOT NULL,
  `joining_date` date NOT NULL,
  `dob` date NOT NULL,
  `status` tinyint(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `email`, `photos`, `employee_id_code`, `joining_date`, `dob`, `status`) VALUES
(14, 'karim ', 'karim@gmail.com ', '1.png', '#123', '2023-02-09', '2023-02-01', 1),
(15, 'ratan', 'ratan@gmail.com ', '1.png', '#1233', '2023-02-13', '2023-02-10', -1),
(17, 'Ullash Bh', 'ullash123@gmail.com ', '1.png', '#1111', '2023-02-23', '2023-02-22', 1),
(39, 'Ullash Bhattacharjee', 'ullasj6as78@gmail.com ', '1.png', '12345', '2023-02-14', '2023-02-13', 1),
(40, 'Ullash Bhattacharjee', 'ullasj67ss8@gmail.com ', '1.png', '12212', '2023-02-12', '2023-02-12', 1),
(41, 'Ullash Bhattacharjee', 'tuerjert9uu8737@gmail.com ', '1.png', '2323', '2023-02-13', '2023-02-13', 1),
(42, 'Ullash Bhattacharjee', 'tuerjert9uu8as737@gmail.com ', '1.png', '2323', '2023-02-13', '2023-02-13', 1),
(43, 'Ullash Bhattacharjee', 'tuerjert9uuas8as737@gmail.com ', '1.png', '2323', '2023-02-13', '2023-02-13', 1),
(64, 'juta', 'jutssadfaa@gmail.com ', 'book5.jpeg', '1222', '2023-02-27', '2023-02-14', 1),
(65, 'hkjshdajkdh', 'dasjlkdjasjd@gmail.com ', 'book4.jpeg', '12321', '2023-02-06', '2023-02-13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id` int(200) NOT NULL,
  `month` text NOT NULL,
  `year` text NOT NULL,
  `payroll_file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`id`, `month`, `year`, `payroll_file`) VALUES
(2, 'january', '2020', 'export2.xls'),
(3, 'february', '2020', 'export2.xls'),
(4, 'march', '2020', 'export.xls'),
(5, 'april', '2020', 'export2.xls'),
(6, 'july', '2020', 'export2.xls');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contract`
--
ALTER TABLE `contract`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
