-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2024 at 04:12 PM
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
  `PASSWORD` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clientloan`
--

CREATE TABLE `clientloan` (
  `ID` int(11) NOT NULL,
  `CLIENTID` int(11) NOT NULL,
  `LOANID` int(11) NOT NULL,
  `LOANAMOUNT` varchar(255) NOT NULL,
  `LOANDATE` varchar(255) NOT NULL,
  `LOANDATEF` varchar(255) NOT NULL,
  `PAYMENTTYPE` enum('INSTALLMENT','BULK') NOT NULL,
  `STATUS` enum('PENDING','APPROVED','DECLINED','ONGOING','DONE') NOT NULL,
  `UPDATEBY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loantype`
--

CREATE TABLE `loantype` (
  `ID` int(11) NOT NULL,
  `TPID` enum('Regular Loan','Special Loan') NOT NULL,
  `LOANTYPE` varchar(255) NOT NULL,
  `MINAM` varchar(255) NOT NULL,
  `MAXAM` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clientimage`
--
ALTER TABLE `clientimage`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clientinformation`
--
ALTER TABLE `clientinformation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clientloan`
--
ALTER TABLE `clientloan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loantype`
--
ALTER TABLE `loantype`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymentloan`
--
ALTER TABLE `paymentloan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
