-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2025 at 06:54 PM
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
-- Database: `hmsproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admintb`
--

CREATE TABLE `admintb` (
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admintb`
--

INSERT INTO `admintb` (`username`, `password`) VALUES
('admin', 'test1234');

-- --------------------------------------------------------

--
-- Table structure for table `appointmenttb`
--

CREATE TABLE `appointmenttb` (
  `pid` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `doctor` varchar(30) NOT NULL,
  `docFees` int(5) NOT NULL,
  `appdate` date NOT NULL,
  `apptime` time NOT NULL,
  `userStatus` int(5) NOT NULL,
  `doctorStatus` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointmenttb`
--

INSERT INTO `appointmenttb` (`pid`, `ID`, `fname`, `lname`, `gender`, `email`, `contact`, `doctor`, `docFees`, `appdate`, `apptime`, `userStatus`, `doctorStatus`) VALUES
(4, 1, 'Kishan', 'Lal', 'Male', 'kishansmart0@gmail.com', '8838489464', 'Ganesh', 550, '2025-01-16', '10:00:00', 0, 0),
(4, 2, 'Kishan', 'Lal', 'Male', 'kishansmart0@gmail.com', '8838489464', 'Dinesh', 700, '2025-04-26', '10:00:00', 0, 1),
(4, 3, 'Kishan', 'Lal', 'Male', 'kishansmart0@gmail.com', '8838489464', 'Amit', 1000, '2025-05-13', '03:00:00', 0, 1),
(11, 4, 'Shraddha', 'Kapoor', 'Female', 'shraddha@gmail.com', '9768946252', 'ashok', 500, '2025-05-27', '20:00:00', 1, 0),
(4, 5, 'Kishan', 'Lal', 'Male', 'kishansmart0@gmail.com', '8838489464', 'Dinesh', 700, '2025-05-22', '12:00:00', 1, 1),
(4, 6, 'Kishan', 'Lal', 'Male', 'kishansmart0@gmail.com', '8838489464', 'Ganesh', 550, '2025-02-20', '15:00:00', 0, 1),
(2, 8, 'Alia', 'Bhatt', 'Female', 'alia@gmail.com', '8976897689', 'Ganesh', 550, '2025-05-22', '10:00:00', 1, 1),
(5, 9, 'Gautam', 'Shankararam', 'Male', 'gautam@gmail.com', '9070897653', 'Ganesh', 550, '2025-04-23', '20:00:00', 1, 0),
(4, 10, 'Kishan', 'Lal', 'Male', 'kishansmart0@gmail.com', '8838489464', 'Ganesh', 550, '2025-04-30', '14:00:00', 1, 0),
(4, 11, 'Kishan', 'Lal', 'Male', 'kishansmart0@gmail.com', '8838489464', 'Dinesh', 700, '2025-07-18', '15:00:00', 1, 1),
(9, 12, 'William', 'Blake', 'Male', 'william@gmail.com', '8683619153', 'Kumar', 800, '2025-07-24', '12:00:00', 1, 1),
(9, 13, 'William', 'Blake', 'Male', 'william@gmail.com', '8683619153', 'Tiwary', 450, '2025-08-14', '14:00:00', 1, 1),
(12, 15, 'Manideep', 'Gannamaneni', 'Male', 'gm@gmail.com', '7878554411', 'ashok', 500, '2025-04-25', '10:00:00', 1, 0),
(12, 16, 'Manideep', 'Gannamaneni', 'Male', 'gm@gmail.com', '7878554411', 'Arun', 600, '2025-04-25', '14:00:00', 1, 0),
(22, 17, 'Shah ', 'Khan', 'Male', 'shahkhan@gmail.com', '123456789', 'Arun', 600, '2025-04-29', '12:00:00', 1, 1),
(12, 18, 'Manideep', 'Gannamaneni', 'Male', 'gm@gmail.com', '7878554411', 'DrAvailable', 200, '2025-04-30', '16:00:00', 1, 1),
(12, 19, 'Manideep', 'Gannamaneni', 'Male', 'gm@gmail.com', '7878554411', 'DrAvailable', 200, '2025-05-02', '14:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cabins`
--

CREATE TABLE `cabins` (
  `cabin_no` int(11) NOT NULL,
  `status` enum('Available','Occupied') DEFAULT 'Available',
  `patient_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cabins`
--

INSERT INTO `cabins` (`cabin_no`, `status`, `patient_id`) VALUES
(101, 'Occupied', 3),
(102, 'Available', NULL),
(103, 'Occupied', 2),
(104, 'Available', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(30) NOT NULL,
  `email` text NOT NULL,
  `contact` varchar(10) NOT NULL,
  `message` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`name`, `email`, `contact`, `message`) VALUES
('Anu', 'anu@gmail.com', '7896677554', 'Hey Admin'),
(' Viki', 'viki@gmail.com', '9899778865', 'Good Job, Pal'),
('Ananya', 'ananya@gmail.com', '9997888879', 'How can I reach you?'),
('Aakash', 'aakash@gmail.com', '8788979967', 'Love your site'),
('Mani', 'mani@gmail.com', '8977768978', 'Want some coffee?'),
('Karthick', 'karthi@gmail.com', '9898989898', 'Good service'),
('Abbis', 'abbis@gmail.com', '8979776868', 'Love your service'),
('Asiq', 'asiq@gmail.com', '9087897564', 'Love your service. Thank you!'),
('Jane', 'jane@gmail.com', '7869869757', 'I love your service!');

-- --------------------------------------------------------

--
-- Table structure for table `doctb`
--

CREATE TABLE `doctb` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `spec` varchar(50) NOT NULL,
  `docFees` int(10) NOT NULL,
  `is_visiting` tinyint(1) DEFAULT 0,
  `basic_pay` int(11) DEFAULT 30000
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctb`
--

INSERT INTO `doctb` (`username`, `password`, `email`, `spec`, `docFees`, `is_visiting`, `basic_pay`) VALUES
('Abbis', 'abbis123', 'abbis@gmail.com', 'Neurologist', 1500, 0, 30000),
('Amit', 'amit123', 'amit@gmail.com', 'Cardiologist', 1000, 0, 30000),
('Ashok', 'ashok123', 'ashok@gmail.com', 'General', 500, 0, 30000),
('Dinesh', 'dinesh123', 'dinesh@gmail.com', 'General', 700, 0, 30000),
('DrAvailable', 'doctor123', 'avail@gmail.com', 'General', 200, 0, 30000),
('Ganesh', 'ganesh123', 'ganesh@gmail.com', 'Pediatrician', 550, 0, 30000),
('Kumar', 'kumar123', 'kumar@gmail.com', 'Pediatrician', 800, 0, 30000),
('Tiwary', 'tiwary123', 'tiwary@gmail.com', 'Pediatrician', 450, 0, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_roster`
--

CREATE TABLE `doctor_roster` (
  `id` int(11) NOT NULL,
  `doctor_username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date` date NOT NULL,
  `shift` enum('Morning','Evening','Night') NOT NULL,
  `consultation_room` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor_roster`
--

INSERT INTO `doctor_roster` (`id`, `doctor_username`, `date`, `shift`, `consultation_room`) VALUES
(121102, 'Amit', '2025-04-26', 'Evening', '101'),
(121117, 'Ashok', '2025-04-27', 'Morning', '103'),
(121125, 'Abbis', '2025-04-26', 'Morning', '100'),
(121230, 'Tiwary', '2025-04-27', 'Morning', '107'),
(121342, 'Dinesh', '2025-04-27', 'Evening', '104'),
(122122, 'Amit', '2025-04-25', 'Morning', '108'),
(123123, 'Kumar', '2025-04-26', 'Morning', '106'),
(123132, 'Ganesh', '2025-04-27', 'Night', '105'),
(123412, 'Amit', '2025-04-25', 'Morning', '101'),
(123413, 'Abbis', '2025-04-25', 'Morning', '100'),
(123414, 'DrAvailable', '2025-04-30', 'Night', '120'),
(123415, 'Ashok', '2025-05-01', 'Night', '103'),
(123416, 'Ganesh', '2025-05-06', 'Evening', '105');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_salary`
--

CREATE TABLE `doctor_salary` (
  `id` int(11) NOT NULL,
  `doctor_username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `month` varchar(20) NOT NULL,
  `basic_pay` int(11) NOT NULL,
  `variable_pay` int(11) NOT NULL,
  `total_pay` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor_salary`
--

INSERT INTO `doctor_salary` (`id`, `doctor_username`, `month`, `basic_pay`, `variable_pay`, `total_pay`) VALUES
(121102, 'Amit', 'January 2020', 30000, 0, 30000),
(121117, 'Ashok', 'January 2020', 30000, 0, 30000),
(121125, 'Abbis', 'April 2025', 30000, 0, 30000),
(121230, 'Tiwary', 'April 2025', 30000, 0, 30000),
(121232, 'Ashok', 'April 2025', 30000, 0, 30000),
(121342, 'Dinesh', 'April 2025', 30000, 0, 30000),
(122122, 'Amit', 'May 2025', 30000, 100, 30100),
(123123, 'Kumar', 'April 2025', 30000, 0, 30000),
(123132, 'Ganesh', 'April 2025', 30000, 0, 30000),
(123412, 'Amit', 'April 2025', 30000, 0, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `nursetb`
--

CREATE TABLE `nursetb` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `shift` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Active',
  `salary` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nursetb`
--

INSERT INTO `nursetb` (`id`, `username`, `email`, `password`, `shift`, `status`, `salary`) VALUES
(1, 'Nurse.Lina', 'lina@example.com', 'lina123', 'Morning', 'Active', 9000),
(2, 'Nurse.Sonu', 'sonu@example.com', 'sonu123', 'Evening', 'Active', 3000),
(3, 'Nurse.Zara', 'zara@example.com', 'zara123', 'Night', 'Active', 3000),
(4, 'Nurse.Kina', NULL, NULL, NULL, 'Active', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `nurse_roster`
--

CREATE TABLE `nurse_roster` (
  `id` int(11) NOT NULL,
  `nurse_username` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `shift` enum('Morning','Evening','Night') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nurse_roster`
--

INSERT INTO `nurse_roster` (`id`, `nurse_username`, `date`, `shift`) VALUES
(14, 'Nurse.Lina', '2025-04-25', 'Morning'),
(15, 'Nurse.Zara', '2025-04-25', 'Morning'),
(16, 'Nurse.Sonu', '2025-04-25', 'Night'),
(17, 'Nurse.Zara', '2025-04-25', 'Evening'),
(18, 'Nurse.Sonu', '2025-04-25', 'Evening'),
(19, 'Nurse.Lina', '2025-04-26', 'Evening'),
(20, 'Nurse.Sonu', '2025-04-26', 'Night'),
(21, 'Nurse.Kina', '2025-05-06', 'Morning');

-- --------------------------------------------------------

--
-- Table structure for table `patreg`
--

CREATE TABLE `patreg` (
  `pid` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `password` varchar(30) NOT NULL,
  `cpassword` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `patreg`
--

INSERT INTO `patreg` (`pid`, `fname`, `lname`, `gender`, `email`, `contact`, `password`, `cpassword`) VALUES
(1, 'Ram', 'Kumar', 'Male', 'ram@gmail.com', '9876543210', 'ram123', 'ram123'),
(2, 'Alia', 'Bhatt', 'Female', 'alia@gmail.com', '8976897689', 'alia123', 'alia123'),
(3, 'Shahrukh', 'khan', 'Male', 'shahrukh@gmail.com', '8976898463', 'shahrukh123', 'shahrukh123'),
(4, 'Kishan', 'Lal', 'Male', 'kishansmart0@gmail.com', '8838489464', 'kishan123', 'kishan123'),
(5, 'Gautam', 'Shankararam', 'Male', 'gautam@gmail.com', '9070897653', 'gautam123', 'gautam123'),
(6, 'Sushant', 'Singh', 'Male', 'sushant@gmail.com', '9059986865', 'sushant123', 'sushant123'),
(7, 'Nancy', 'Deborah', 'Female', 'nancy@gmail.com', '9128972454', 'nancy123', 'nancy123'),
(8, 'Kenny', 'Sebastian', 'Male', 'kenny@gmail.com', '9809879868', 'kenny123', 'kenny123'),
(9, 'William', 'Blake', 'Male', 'william@gmail.com', '8683619153', 'william123', 'william123'),
(10, 'Peter', 'Norvig', 'Male', 'peter@gmail.com', '9609362815', 'peter123', 'peter123'),
(11, 'Shraddha', 'Kapoor', 'Female', 'shraddha@gmail.com', '9768946252', 'shraddha123', 'shraddha123'),
(12, 'Manideep', 'Gannamaneni', 'Male', 'gm@gmail.com', '7878554411', 'gm2005', 'gm2005'),
(18, 'rithwik', 'bairu', 'Male', 'bg@gmail.com', '8855669477', '987654', '987654'),
(20, 'niketh', 'k', 'Male', 'nk@gmail.com', '7878554433', '123456', '123456'),
(21, 'Sher', 'Khan', 'Male', 'sherkhan@gmail.com', '1234512345', '12345', '12345'),
(22, 'Shah ', 'Khan', 'Male', 'shahkhan@gmail.com', '123456789', '12345', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `prestb`
--

CREATE TABLE `prestb` (
  `doctor` varchar(50) NOT NULL,
  `pid` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `appdate` date NOT NULL,
  `apptime` time NOT NULL,
  `disease` varchar(250) NOT NULL,
  `allergy` varchar(250) NOT NULL,
  `prescription` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `prestb`
--

INSERT INTO `prestb` (`doctor`, `pid`, `ID`, `fname`, `lname`, `appdate`, `apptime`, `disease`, `allergy`, `prescription`) VALUES
('Dinesh', 4, 11, 'Kishan', 'Lal', '2020-03-27', '15:00:00', 'Cough', 'Nothing', 'Just take a teaspoon of Benadryl every night'),
('Ganesh', 2, 8, 'Alia', 'Bhatt', '2020-03-21', '10:00:00', 'Severe Fever', 'Nothing', 'Take bed rest'),
('Kumar', 9, 12, 'William', 'Blake', '2020-03-26', '12:00:00', 'Sever fever', 'nothing', 'Paracetamol -> 1 every morning and night'),
('Tiwary', 9, 13, 'William', 'Blake', '2020-03-26', '14:00:00', 'Cough', 'Skin dryness', 'Intake fruits with more water content'),
('ashok', 20, 14, 'niketh', 'k', '2025-04-25', '08:00:00', 'Cold', 'None', 'Rest'),
('ashok', 12, 15, 'Manideep', 'Gannamaneni', '2025-04-25', '10:00:00', 'Fever', 'None', 'Rest'),
('Arun', 12, 16, 'Manideep', 'Gannamaneni', '2025-04-25', '14:00:00', 'fever', 'none', 'dolo 650');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointmenttb`
--
ALTER TABLE `appointmenttb`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cabins`
--
ALTER TABLE `cabins`
  ADD PRIMARY KEY (`cabin_no`),
  ADD KEY `fk_patient_in_cabin` (`patient_id`);

--
-- Indexes for table `doctb`
--
ALTER TABLE `doctb`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `doctor_roster`
--
ALTER TABLE `doctor_roster`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_username` (`doctor_username`);

--
-- Indexes for table `doctor_salary`
--
ALTER TABLE `doctor_salary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_username` (`doctor_username`);

--
-- Indexes for table `nursetb`
--
ALTER TABLE `nursetb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `nurse_roster`
--
ALTER TABLE `nurse_roster`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nurse_username` (`nurse_username`);

--
-- Indexes for table `patreg`
--
ALTER TABLE `patreg`
  ADD PRIMARY KEY (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointmenttb`
--
ALTER TABLE `appointmenttb`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `doctor_roster`
--
ALTER TABLE `doctor_roster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123417;

--
-- AUTO_INCREMENT for table `doctor_salary`
--
ALTER TABLE `doctor_salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123413;

--
-- AUTO_INCREMENT for table `nursetb`
--
ALTER TABLE `nursetb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nurse_roster`
--
ALTER TABLE `nurse_roster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `patreg`
--
ALTER TABLE `patreg`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cabins`
--
ALTER TABLE `cabins`
  ADD CONSTRAINT `fk_patient_in_cabin` FOREIGN KEY (`patient_id`) REFERENCES `patreg` (`pid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `doctor_roster`
--
ALTER TABLE `doctor_roster`
  ADD CONSTRAINT `doctor_roster_ibfk_1` FOREIGN KEY (`doctor_username`) REFERENCES `doctb` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor_salary`
--
ALTER TABLE `doctor_salary`
  ADD CONSTRAINT `doctor_salary_ibfk_1` FOREIGN KEY (`doctor_username`) REFERENCES `doctb` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nurse_roster`
--
ALTER TABLE `nurse_roster`
  ADD CONSTRAINT `nurse_roster_ibfk_1` FOREIGN KEY (`nurse_username`) REFERENCES `nursetb` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
