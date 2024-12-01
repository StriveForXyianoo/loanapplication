-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2024 at 01:07 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+08:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loan_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientbeneficiary`
--

CREATE TABLE `clientbeneficiary` (
  `ID` int(11) NOT NULL,
  `CLIENTID` int(11) NOT NULL,
  `BENEFICIARY` varchar(255) NOT NULL,
  `RELATIONSHIP` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientbeneficiary`
--

INSERT INTO `clientbeneficiary` (`ID`, `CLIENTID`, `BENEFICIARY`, `RELATIONSHIP`) VALUES
(1, 5, '1112', '12123'),
(2, 5, '123231', '132123'),
(3, 5, '12231', '123231'),
(4, 6, 'HAHAH', 'sdh'),
(5, 6, 'AHHAH', 'AHAHH'),
(6, 6, 'AHAHHA', 'AHHAHA');

-- --------------------------------------------------------

--
-- Table structure for table `clientimage`
--

CREATE TABLE `clientimage` (
  `ID` int(11) NOT NULL,
  `CLIENT_ID` int(11) NOT NULL,
  `TYPE` enum('VALIDID','USERPIC') NOT NULL,
  `FILEP` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientimage`
--

INSERT INTO `clientimage` (`ID`, `CLIENT_ID`, `TYPE`, `FILEP`) VALUES
(9, 5, 'VALIDID', 'WZi4AV1lsH.png'),
(10, 5, 'USERPIC', 'nuMOfJh78K.png'),
(11, 6, 'VALIDID', 'DhlWjGzYMA.png'),
(12, 6, 'USERPIC', 'C42VloDmAB.png');

-- --------------------------------------------------------

--
-- Table structure for table `clientinformation`
--

CREATE TABLE `clientinformation` (
  `ID` int(11) NOT NULL,
  `FIRSTNAME` varchar(255) NOT NULL,
  `MIDDLENAME` varchar(255) DEFAULT NULL,
  `LASTNAME` varchar(255) NOT NULL,
  `GENDER` varchar(255) NOT NULL,
  `BIRTHDATE` varchar(255) NOT NULL,
  `CIVILSTATUS` varchar(255) NOT NULL,
  `CONTACTNO` int(255) NOT NULL,
  `POSITION` varchar(255) NOT NULL,
  `SALARY` varchar(255) NOT NULL,
  `ADDRESS` text NOT NULL,
  `YEARS` varchar(255) NOT NULL,
  `DEPARTMENT` varchar(255) NOT NULL,
  `EMAIL` varchar(200) NOT NULL,
  `PASSWORD` varchar(200) NOT NULL,
  `REGISTRATIONSTATUS` enum('PENDING','APPROVED','DENIED','BANNED') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientinformation`
--

INSERT INTO `clientinformation` (`ID`, `FIRSTNAME`, `MIDDLENAME`, `LASTNAME`, `GENDER`, `BIRTHDATE`, `CIVILSTATUS`, `CONTACTNO`, `POSITION`, `SALARY`, `ADDRESS`, `YEARS`, `DEPARTMENT`, `EMAIL`, `PASSWORD`, `REGISTRATIONSTATUS`) VALUES
(5, 'Kent', 'Certiza', 'Cortiguerra', 'Male', '2001-02-11', 'Single', 2147483647, 'jk', '212', '2121', '2121', 'bhbj', 'yuukihan0523@gmail.com', '$2y$10$dQpEDLsJR6UbQaeZ/OYTr.H/owbWIvad2lz4h3Hxib4IyF0EQ49Ra', 'DENIED'),
(6, 'Kent', 'Certiza', 'Cortiguerra', 'Male', '2001-11-11', 'Single', 2147483647, '21', '212121', '212121', '2121', '212', 'kent.troubleshooter@gmail.com', '$2y$10$AMLMEixAG5KL9tv1iQuzNuq1huPXbMXAoFIwu4oyZrMjb9NMYGr/i', 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `clientloan`
--

CREATE TABLE `clientloan` (
  `ID` int(11) NOT NULL,
  `CLIENTID` int(11) NOT NULL,
  `LOANID` int(11) NOT NULL,
  `LOANAMOUNT` varchar(255) NOT NULL,
  `TERM` varchar(11) NOT NULL,
  `INTEREST` varchar(11) NOT NULL,
  `CBU` varchar(11) NOT NULL,
  `FILLING` varchar(11) NOT NULL,
  `INSURANCE` varchar(11) NOT NULL,
  `NETPRO` varchar(11) NOT NULL,
  `LOANDATE` varchar(255) NOT NULL,
  `STATUS` enum('PENDING','APPROVED','DECLINED','ONGOING','DONE') NOT NULL,
  `UPDATEBY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientloan`
--

INSERT INTO `clientloan` (`ID`, `CLIENTID`, `LOANID`, `LOANAMOUNT`, `TERM`, `INTEREST`, `CBU`, `FILLING`, `INSURANCE`, `NETPRO`, `LOANDATE`, `STATUS`, `UPDATEBY`) VALUES
(3, 5, 1, '45000', '24', '10800.00', '1800.00', '20', '624.80', '28605.20', '2024-11-24 19:55:39', 'PENDING', 0);

-- --------------------------------------------------------

--
-- Table structure for table `loanterms`
--

CREATE TABLE `loanterms` (
  `ID` int(11) NOT NULL,
  `LOANID` int(11) NOT NULL,
  `MINAM` varchar(255) NOT NULL,
  `MAXAM` varchar(255) NOT NULL,
  `TERMS` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loanterms`
--

INSERT INTO `loanterms` (`ID`, `LOANID`, `MINAM`, `MAXAM`, `TERMS`) VALUES
(1, 1, '5000', '29999', '12'),
(2, 1, '30000', '59999', '24'),
(3, 1, '60000', '99999', '36'),
(4, 1, '100000 ', '149999', '24'),
(5, 1, '15000', '299999', '36'),
(6, 2, '10000', '10000', '12'),
(7, 3, '10000', '10000', '12'),
(8, 3, '5000', '19999', '12'),
(9, 3, '20000', '25000', '24'),
(10, 4, '150000', '150000', '36'),
(11, 7, '2000', '2000', '6'),
(12, 8, '2000', '2000', '6'),
(13, 9, '2000', '2000', '6'),
(14, 10, '2000', '2000', '6'),
(15, 11, '2000', '2000', '6');

-- --------------------------------------------------------

--
-- Table structure for table `loantype`
--

CREATE TABLE `loantype` (
  `ID` int(11) NOT NULL,
  `TPID` enum('Regular Loan','Special Loan') NOT NULL,
  `LOANTYPE` varchar(255) NOT NULL,
  `MINAM` varchar(255) NOT NULL,
  `MAXAM` varchar(255) NOT NULL,
  `FITT` enum('FIXED','NOT') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loantype`
--

INSERT INTO `loantype` (`ID`, `TPID`, `LOANTYPE`, `MINAM`, `MAXAM`, `FITT`) VALUES
(1, 'Regular Loan', 'Salary Loan', '5000', '500000', 'NOT'),
(2, 'Regular Loan', 'Emergency Loan', '10000', '10000', 'FIXED'),
(3, 'Regular Loan', 'Appliance Loan', '1000', '25000', 'NOT'),
(4, 'Regular Loan', 'Motorcycle Loan ', '50000', '150000', 'NOT'),
(7, 'Special Loan', 'MID Year Bonus', '2000', '2000', 'FIXED'),
(8, 'Special Loan', 'Year End Bonus ', '2000', '2000', 'FIXED'),
(9, 'Special Loan', 'Cash Gift', '5000', '5000', 'FIXED'),
(10, 'Special Loan', 'Clothing', '5000', '5000', 'FIXED'),
(11, 'Special Loan', 'Extra Bonus ', '20000', '20000 ', 'FIXED');

-- --------------------------------------------------------

--
-- Table structure for table `paymentloan`
--

CREATE TABLE `paymentloan` (
  `ID` int(11) NOT NULL,
  `LOANID` int(11) NOT NULL,
  `DATEPAYMENT` varchar(255) NOT NULL,
  `AMOUNT` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `LASTNAME` varchar(191) NOT NULL,
  `FIRSTNAME` varchar(191) NOT NULL,
  `MIDDLENAME` varchar(191) DEFAULT NULL,
  `EMAILADDRESS` varchar(191) NOT NULL,
  `PASSWORD` varchar(191) NOT NULL,
  `IMG` text DEFAULT NULL,
  `ROLES` enum('ADMIN','EMPLOYEE') NOT NULL,
  `CONTACTNUMBER` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `LASTNAME`, `FIRSTNAME`, `MIDDLENAME`, `EMAILADDRESS`, `PASSWORD`, `IMG`, `ROLES`, `CONTACTNUMBER`) VALUES
(4, 'Cortiguerra', 'Kent', 'Certiza', 'kentcortiguerra.troubleshouter@gmail.com', '$2y$10$s3dPvUvwaFTMXUTG/DwkE.mtaEvLGlKTwohjsEI3nZhsEJV76LdX2', NULL, 'ADMIN', '54654756');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientbeneficiary`
--
ALTER TABLE `clientbeneficiary`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CLIENTID` (`CLIENTID`);

--
-- Indexes for table `clientimage`
--
ALTER TABLE `clientimage`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CLIENT_ID` (`CLIENT_ID`);

--
-- Indexes for table `clientinformation`
--
ALTER TABLE `clientinformation`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `clientloan`
--
ALTER TABLE `clientloan`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `CLIENTID` (`CLIENTID`),
  ADD UNIQUE KEY `LOANID` (`LOANID`),
  ADD KEY `UPDATEBY` (`UPDATEBY`);

--
-- Indexes for table `loanterms`
--
ALTER TABLE `loanterms`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `LOANID` (`LOANID`);

--
-- Indexes for table `loantype`
--
ALTER TABLE `loantype`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `paymentloan`
--
ALTER TABLE `paymentloan`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `LOANID` (`LOANID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientbeneficiary`
--
ALTER TABLE `clientbeneficiary`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clientimage`
--
ALTER TABLE `clientimage`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `clientinformation`
--
ALTER TABLE `clientinformation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clientloan`
--
ALTER TABLE `clientloan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loanterms`
--
ALTER TABLE `loanterms`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `loantype`
--
ALTER TABLE `loantype`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `paymentloan`
--
ALTER TABLE `paymentloan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clientbeneficiary`
--
ALTER TABLE `clientbeneficiary`
  ADD CONSTRAINT `clientbeneficiary_ibfk_1` FOREIGN KEY (`CLIENTID`) REFERENCES `clientinformation` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `clientloan`
--
ALTER TABLE `clientloan`
  ADD CONSTRAINT `clientloan_ibfk_1` FOREIGN KEY (`CLIENTID`) REFERENCES `clientinformation` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `clientloan_ibfk_2` FOREIGN KEY (`LOANID`) REFERENCES `loantype` (`ID`) ON DELETE NO ACTION;

--
-- Constraints for table `loanterms`
--
ALTER TABLE `loanterms`
  ADD CONSTRAINT `loanterms_ibfk_1` FOREIGN KEY (`LOANID`) REFERENCES `loantype` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
