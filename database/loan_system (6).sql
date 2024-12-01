-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2024 at 12:34 PM
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
(7, 31, '12', '211'),
(8, 31, '12', '12'),
(9, 31, '12', '2121');

-- --------------------------------------------------------

--
-- Table structure for table `clientface`
--

CREATE TABLE `clientface` (
  `ID` int(11) NOT NULL,
  `CLIENT_ID` int(11) NOT NULL,
  `FACE_DESCRIPTOR` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`FACE_DESCRIPTOR`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientface`
--

INSERT INTO `clientface` (`ID`, `CLIENT_ID`, `FACE_DESCRIPTOR`) VALUES
(9, 31, '{\"0\":-0.22354555130004883,\"1\":0.05604414641857147,\"2\":0.08761309087276459,\"3\":-0.013963771983981133,\"4\":0.03388618305325508,\"5\":-0.1390422284603119,\"6\":0.016970880329608917,\"7\":-0.1366475224494934,\"8\":0.0974898636341095,\"9\":-0.07874973118305206,\"10\":0.2816354036331177,\"11\":-0.07910554856061935,\"12\":-0.15981952846050262,\"13\":-0.12268853187561035,\"14\":-0.0010486978571861982,\"15\":0.11001189053058624,\"16\":-0.21613672375679016,\"17\":-0.10262583196163177,\"18\":-0.0032586902379989624,\"19\":-0.0841393694281578,\"20\":0.13337403535842896,\"21\":-0.028425876051187515,\"22\":0.012034348212182522,\"23\":0.05769975855946541,\"24\":-0.14784234762191772,\"25\":-0.3037796914577484,\"26\":-0.08457580953836441,\"27\":-0.14373311400413513,\"28\":0.023442864418029785,\"29\":-0.07898873090744019,\"30\":-0.013710244558751583,\"31\":0.03610891476273537,\"32\":-0.16244594752788544,\"33\":0.00600694352760911,\"34\":-0.0456806905567646,\"35\":0.06999612599611282,\"36\":0.050461750477552414,\"37\":0.01028772909194231,\"38\":0.15403831005096436,\"39\":-0.020171266049146652,\"40\":-0.1586897373199463,\"41\":-0.07841110229492188,\"42\":0.03352736309170723,\"43\":0.3021028935909271,\"44\":0.14884065091609955,\"45\":0.0669652596116066,\"46\":-0.024873534217476845,\"47\":-0.030329706147313118,\"48\":0.08323334157466888,\"49\":-0.2092932015657425,\"50\":0.04206031188368797,\"51\":0.10426520556211472,\"52\":0.15163175761699677,\"53\":0.024494977667927742,\"54\":0.059607040137052536,\"55\":-0.1362762451171875,\"56\":0.0023416776675730944,\"57\":-0.01833626814186573,\"58\":-0.1376623511314392,\"59\":0.08805769681930542,\"60\":0.06835465133190155,\"61\":-0.09549044072628021,\"62\":0.019273722544312477,\"63\":-0.056684866547584534,\"64\":0.22826004028320312,\"65\":0.046753574162721634,\"66\":-0.17006319761276245,\"67\":0.01219501905143261,\"68\":0.08858396857976913,\"69\":-0.1215457171201706,\"70\":-0.0451461598277092,\"71\":0.02659321203827858,\"72\":-0.10809522122144699,\"73\":-0.2255180925130844,\"74\":-0.3342438042163849,\"75\":0.026396457105875015,\"76\":0.37604352831840515,\"77\":0.09504836797714233,\"78\":-0.19461765885353088,\"79\":0.006775419693440199,\"80\":-0.11325488984584808,\"81\":-0.003070462727919221,\"82\":0.15160641074180603,\"83\":0.0939655750989914,\"84\":-0.07757904380559921,\"85\":0.06403700262308121,\"86\":-0.1444474458694458,\"87\":0.014012514613568783,\"88\":0.18112881481647491,\"89\":-0.05388711020350456,\"90\":-0.03466544672846794,\"91\":0.20953284204006195,\"92\":-0.06805072724819183,\"93\":0.05151134729385376,\"94\":-0.03199738264083862,\"95\":0.03373923525214195,\"96\":-0.04614430293440819,\"97\":0.027725044637918472,\"98\":-0.05687958002090454,\"99\":0.04683467373251915,\"100\":0.017239511013031006,\"101\":-0.10839758813381195,\"102\":-0.023405909538269043,\"103\":0.07274007052183151,\"104\":-0.20206959545612335,\"105\":0.06631487607955933,\"106\":0.0735282450914383,\"107\":0.009367472492158413,\"108\":-0.033083878457546234,\"109\":0.04440748691558838,\"110\":-0.16509860754013062,\"111\":-0.07678034901618958,\"112\":0.07055920362472534,\"113\":-0.25043347477912903,\"114\":0.15935076773166656,\"115\":0.24895446002483368,\"116\":0.03401576355099678,\"117\":0.17618365585803986,\"118\":0.05606216937303543,\"119\":0.04630366712808609,\"120\":-0.019473597407341003,\"121\":-0.022959275171160698,\"122\":-0.09974078834056854,\"123\":-0.011280326172709465,\"124\":0.07054257392883301,\"125\":0.008240360766649246,\"126\":0.03423414006829262,\"127\":0.03353077918291092}'),
(13, 35, '{\"0\":-0.22472375631332397,\"1\":0.06148681417107582,\"2\":0.096395343542099,\"3\":-0.014384433627128601,\"4\":-0.000451081054052338,\"5\":-0.13089406490325928,\"6\":0.011256549507379532,\"7\":-0.16436417400836945,\"8\":0.10785220563411713,\"9\":-0.0808967798948288,\"10\":0.2440645545721054,\"11\":-0.0927247405052185,\"12\":-0.16983363032341003,\"13\":-0.13003800809383392,\"14\":-0.001195437740534544,\"15\":0.1048080325126648,\"16\":-0.20288938283920288,\"17\":-0.11348019540309906,\"18\":0.03077584132552147,\"19\":-0.08108652383089066,\"20\":0.10966672748327255,\"21\":-0.024772722274065018,\"22\":0.03197861462831497,\"23\":0.04592740908265114,\"24\":-0.14383865892887115,\"25\":-0.3116617202758789,\"26\":-0.07897908240556717,\"27\":-0.12288931757211685,\"28\":0.020875869318842888,\"29\":-0.062423527240753174,\"30\":-0.056123845279216766,\"31\":0.052813708782196045,\"32\":-0.18297816812992096,\"33\":-0.030596207827329636,\"34\":-0.0435093492269516,\"35\":0.10507931560277939,\"36\":0.05340670421719551,\"37\":0.0020945072174072266,\"38\":0.13155117630958557,\"39\":-0.0302762258797884,\"40\":-0.1669793725013733,\"41\":-0.09620654582977295,\"42\":0.03538810461759567,\"43\":0.2887803316116333,\"44\":0.15173174440860748,\"45\":0.055553048849105835,\"46\":-0.04296991974115372,\"47\":-0.03417219966650009,\"48\":0.1006380096077919,\"49\":-0.2058878391981125,\"50\":0.025187477469444275,\"51\":0.10743756592273712,\"52\":0.09513455629348755,\"53\":0.015316248871386051,\"54\":0.04292868450284004,\"55\":-0.12906508147716522,\"56\":0.019321296364068985,\"57\":-0.021109655499458313,\"58\":-0.12778455018997192,\"59\":0.07738158851861954,\"60\":0.0815640240907669,\"61\":-0.09771022945642471,\"62\":0.02751069702208042,\"63\":-0.05240457132458687,\"64\":0.23115424811840057,\"65\":0.03998330608010292,\"66\":-0.1295691579580307,\"67\":-0.020196393132209778,\"68\":0.07271239161491394,\"69\":-0.13814564049243927,\"70\":-0.051476359367370605,\"71\":0.028412053361535072,\"72\":-0.10161533951759338,\"73\":-0.21063794195652008,\"74\":-0.33957409858703613,\"75\":0.018376288935542107,\"76\":0.3624802231788635,\"77\":0.09841379523277283,\"78\":-0.18640001118183136,\"79\":0.023191101849079132,\"80\":-0.10855720937252045,\"81\":-0.00465833256021142,\"82\":0.17424820363521576,\"83\":0.09881560504436493,\"84\":-0.05827169865369797,\"85\":0.10660365223884583,\"86\":-0.16677290201187134,\"87\":-0.013173975050449371,\"88\":0.2038952261209488,\"89\":-0.053169261664152145,\"90\":-0.03716558963060379,\"91\":0.23548725247383118,\"92\":-0.05812181904911995,\"93\":0.07234172523021698,\"94\":0.00984513945877552,\"95\":0.045346569269895554,\"96\":-0.060765765607357025,\"97\":0.028133627027273178,\"98\":-0.09694202989339828,\"99\":0.019855579361319542,\"100\":0.057496577501297,\"101\":-0.12394378334283829,\"102\":-0.020083321258425713,\"103\":0.09746801108121872,\"104\":-0.21365855634212494,\"105\":0.06634146720170975,\"106\":0.05186339095234871,\"107\":0.029178481549024582,\"108\":-0.020391156896948814,\"109\":0.005118620116263628,\"110\":-0.15079762041568756,\"111\":-0.08499553799629211,\"112\":0.08254624903202057,\"113\":-0.23726125061511993,\"114\":0.1444961130619049,\"115\":0.2433205097913742,\"116\":0.03445778042078018,\"117\":0.1802678257226944,\"118\":0.06755498051643372,\"119\":0.03907233849167824,\"120\":-0.023791145533323288,\"121\":-0.011832362040877342,\"122\":-0.07524751871824265,\"123\":-0.015492627397179604,\"124\":0.07237178087234497,\"125\":-0.003932546824216843,\"126\":0.03307724371552467,\"127\":0.04466598108410835}');

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
(61, 31, 'VALIDID', '674bd04b3025f.png'),
(62, 31, 'USERPIC', '674bd04b30265.png'),
(63, 32, 'VALIDID', '674c33fc073ea.png'),
(64, 32, 'USERPIC', '674c33fc073ed.png'),
(65, 33, 'VALIDID', '674c35cb88b15.png'),
(66, 33, 'USERPIC', '674c35cb88b18.png'),
(67, 34, 'VALIDID', '674c37f2331fd.webp'),
(68, 34, 'USERPIC', '674c37f233202.png'),
(69, 35, 'VALIDID', '674c3824b4045.png'),
(70, 35, 'USERPIC', '674c3824b4048.png');

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
(31, 'Kent', 'Certiza', 'Cortiguerra', 'Male', '2001-11-11', 'Single', 2147483647, 'Mayor', '21000', 'Bangin', '21', 'Mayor', 'yuukihan0523@gmail.com', '$2y$10$s3dPvUvwaFTMXUTG/DwkE.mtaEvLGlKTwohjsEI3nZhsEJV76LdX2', 'APPROVED'),
(35, 'sdsad', 'asdas', 'asdasdsa', 'Male', '2001-11-11', 'Single', 2147483647, 'wqe4qw', '123213123', 'etyuiopoigf', '123', 'asewq2', 'kentcortiguerra.21formore@gmail.com', '$2y$10$9FVNMhWuRCVZbUiVkUD3bONTT3wWhPcAsKfUeaWxc5qfkY31MNddC', 'BANNED');

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
  `STATUS` enum('PENDING','APPROVED','DECLINED','ONGOING','DONE','CANCELLED') NOT NULL,
  `UPDATEBY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientloan`
--

INSERT INTO `clientloan` (`ID`, `CLIENTID`, `LOANID`, `LOANAMOUNT`, `TERM`, `INTEREST`, `CBU`, `FILLING`, `INSURANCE`, `NETPRO`, `LOANDATE`, `STATUS`, `UPDATEBY`) VALUES
(29, 31, 1, '45000', '24', '10800.00', '1800.00', '20', '624.80', '28605.20', '2024-12-01 11:36:48', 'APPROVED', 1),
(32, 31, 1, '45000', '24', '10800.00', '1800.00', '20', '624.80', '28605.20', '2024-12-01 19:28:03', 'CANCELLED', 0);

-- --------------------------------------------------------

--
-- Table structure for table `clientloanpresubmit`
--

CREATE TABLE `clientloanpresubmit` (
  `ID` int(11) NOT NULL,
  `SPECIALORDER` varchar(255) NOT NULL,
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
-- Dumping data for table `clientloanpresubmit`
--

INSERT INTO `clientloanpresubmit` (`ID`, `SPECIALORDER`, `CLIENTID`, `LOANID`, `LOANAMOUNT`, `TERM`, `INTEREST`, `CBU`, `FILLING`, `INSURANCE`, `NETPRO`, `LOANDATE`, `STATUS`, `UPDATEBY`) VALUES
(6, 'XC7bBcXwN4', 31, 1, '20000', '12', '2400.00', '800.00', '20', '154.40', '15225.60', '2024-12-01 19:26:43', 'PENDING', 0);

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
  `AMOUNT` varchar(255) NOT NULL,
  `REMARK` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paymentloan`
--

INSERT INTO `paymentloan` (`ID`, `LOANID`, `DATEPAYMENT`, `AMOUNT`, `REMARK`) VALUES
(1, 29, '2024-01-01', '2000', ''),
(2, 29, '2024-01-02', '2000', ''),
(6, 29, '2024-12-03', '5000', ''),
(7, 29, '2024-10-22', '3000', 'HAHHA');

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
(4, 'Cortiguerra', 'Kent', 'Certiza', 'kentcortiguerra.troubleshouter@gmail.com', '$2y$10$s3dPvUvwaFTMXUTG/DwkE.mtaEvLGlKTwohjsEI3nZhsEJV76LdX2', NULL, 'ADMIN', '09297966745');

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
-- Indexes for table `clientface`
--
ALTER TABLE `clientface`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CLIENT_ID` (`CLIENT_ID`);

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
  ADD KEY `UPDATEBY` (`UPDATEBY`);

--
-- Indexes for table `clientloanpresubmit`
--
ALTER TABLE `clientloanpresubmit`
  ADD PRIMARY KEY (`ID`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `clientface`
--
ALTER TABLE `clientface`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `clientimage`
--
ALTER TABLE `clientimage`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `clientinformation`
--
ALTER TABLE `clientinformation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `clientloan`
--
ALTER TABLE `clientloan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `clientloanpresubmit`
--
ALTER TABLE `clientloanpresubmit`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clientbeneficiary`
--
ALTER TABLE `clientbeneficiary`
  ADD CONSTRAINT `clientbeneficiary_ibfk_1` FOREIGN KEY (`CLIENTID`) REFERENCES `clientinformation` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `clientface`
--
ALTER TABLE `clientface`
  ADD CONSTRAINT `clientface_ibfk_1` FOREIGN KEY (`CLIENT_ID`) REFERENCES `clientinformation` (`ID`) ON DELETE CASCADE;

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
