-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 08, 2021 at 03:06 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id15928782_hr_ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `APPLICANTS`
--

CREATE TABLE `APPLICANTS` (
  `applicantID` int(7) UNSIGNED ZEROFILL NOT NULL,
  `image` varchar(500) NOT NULL,
  `file` varchar(500) NOT NULL,
  `affiliateCode` varchar(50) NOT NULL,
  `DOA` varchar(10) NOT NULL,
  `passportNumber` varchar(255) NOT NULL,
  `firstName` varchar(250) NOT NULL,
  `lastName` varchar(250) NOT NULL,
  `selectGenderType` varchar(10) NOT NULL,
  `DOB` varchar(10) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `languages` varchar(250) NOT NULL,
  `positionCategory` varchar(50) NOT NULL,
  `positionTitle` text NOT NULL,
  `paymentID` varchar(50) NOT NULL,
  `DOS` varchar(10) NOT NULL,
  `customerType` varchar(7) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `currentAddress` varchar(250) NOT NULL,
  `postalCodeC` varchar(30) NOT NULL,
  `areaC` varchar(50) NOT NULL,
  `stateC` varchar(30) NOT NULL,
  `currentCountry` varchar(30) NOT NULL,
  `permanentAddress` varchar(250) NOT NULL,
  `postalCodeP` varchar(30) NOT NULL,
  `areaP` varchar(50) NOT NULL,
  `stateP` varchar(30) NOT NULL,
  `permanentCountry` varchar(30) NOT NULL,
  `applicationStatus` varchar(30) NOT NULL,
  `visaStatus` varchar(30) NOT NULL,
  `missingDocumentsList` varchar(250) NOT NULL,
  `missingDocumentsListOthers` varchar(200) NOT NULL,
  `DOE` varchar(10) NOT NULL,
  `DOG` varchar(10) NOT NULL,
  `educationType` text NOT NULL,
  `educationTypeOthers` varchar(200) NOT NULL,
  `educationTitle` text NOT NULL,
  `instituitionName` varchar(250) NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `APPLICANTS`
--

INSERT INTO `APPLICANTS` (`applicantID`, `image`, `file`, `affiliateCode`, `DOA`, `passportNumber`, `firstName`, `lastName`, `selectGenderType`, `DOB`, `nationality`, `languages`, `positionCategory`, `positionTitle`, `paymentID`, `DOS`, `customerType`, `phoneNumber`, `email`, `currentAddress`, `postalCodeC`, `areaC`, `stateC`, `currentCountry`, `permanentAddress`, `postalCodeP`, `areaP`, `stateP`, `permanentCountry`, `applicationStatus`, `visaStatus`, `missingDocumentsList`, `missingDocumentsListOthers`, `DOE`, `DOG`, `educationType`, `educationTypeOthers`, `educationTitle`, `instituitionName`, `remarks`) VALUES
(0000001, '2021_01_21_13_45_37_images.jpg', '2021_02_04_09_22_36_download.zip', 'HRS', '01/21/2021', 'KL923422', 'JOHN', 'BRIAN', 'M', '06/15/1994', 'Malaysia', 'Chinese , English , ', 'MIGRATION', '', 'PY83324334', '01/04/2021', 'PAID', '+601121676040', 'test@gmail.com', 'SUNWAY PYRAMID', '47500', 'SUBANG JAYA', 'SELANGOR', 'Afghanistan', 'SUNWAY PYRAMID', '47500', 'SUBANG JAYA', 'SELANGOR', 'Malaysia', 'ACCEPTED', 'VISA APPROVED', 'Internship Letter , Passport Copy , Others , ', 'PILOT', '01/04/2021', '01/06/2021', 'BACHELOR\'S', '', 'BACHELOR\'S', 'UOW', 'ok 2   						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					'),
(0000002, '2021_02_04_09_31_45_download.jpg', '2021_02_04_09_32_20_download.zip', 'MSG041-1004.aps', '01/21/2021', 'KO999999', 'MARIA', 'RICH', 'F', '07/12/1994', 'United Kingdom', 'English , German , ', 'JOB', 'MARKETEER', '', '02/22/2021', 'PAID', '+601121676040', 'test@gmail.com', 'SUNWAY PYRAMID', '47500', '', '', 'Malaysia', 'SUNWAY PYRAMID', '', '', '', 'Afghanistan', 'ACCEPTED', 'VISA APPROVED', 'Academic Transcript , Internship Letter , ', '', '01/13/2021', '01/11/2021', 'MASTER\'S', '', '', 'NOTTINGHAM', '    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					'),
(0000003, '2021_02_04_22_03_19_22.jpg', '', 'HRS', '02/04/2021', 'OP234324', 'RICHARD', 'BLISS', 'M', '06/04/1985', 'United Kingdom', 'English , French , ', 'JOB', 'JOB', 'PY8989223', '02/09/2021', 'PAID', '+601121676040', 'b20toto@gmail.com', 'SUNWAY PYRAMID', '47500', '', '', 'Malaysia', 'SUNWAY PYRAMID', '', '', '', 'Afghanistan', 'NONE', 'NONE', '', '', '02/01/2021', '02/02/2021', 'BACHELOR\'S', '', 'OK', 'UOW', 'ok    						\r\n    					    						\r\n    					'),
(0000004, '2021_02_05_16_13_51_images (2).jpg', '', 'N075-1001.aps', '02/05/2021', 'JK23423423', 'DRAKE', 'BELL', 'M', '07/11/1985', 'New Zealand', 'English , French , ', 'PROGRAM', 'JAPANESE PROGRAM', 'PY7887687', '02/08/2021', 'PAID', '+601121676040', 'b20toto@gmail.com', 'SUNWAY PYRAMID', '47500', 'SS', 'SS', 'Malaysia', 'SUNWAY PYRAMID', '47500', 'SS', 'SS', 'Malaysia', 'ACCEPTED', 'NONE', 'Highest Education Certificate , Internship Letter , Passport Copy , ', '', '06/13/2017', '02/03/2021', 'BACHELOR\'S', '', 'BACHELOR\'S PF MARKETING ', 'HAVARD UNIVERSITY', 'The passport copy is not clear.    						\r\n    					    						\r\n    					    						\r\n    					'),
(0000005, '2021_02_05_16_20_28_IMG_3348-pp-b.jpg', '', 'N075-1001.aps', '02/05/2021', 'BA2334234', 'MARIANA', 'LEE', 'F', '03/16/1994', 'Japan', 'Chinese , English , Malay , ', 'JOB', 'MARKETING JOB', 'PY12938324', '02/23/2021', 'PAID', '+601121676040', 'b20toto@gmail.com', 'SUNWAY PYRAMID', '47500', 'SS', 'SS', 'Malaysia', 'SUNWAY PYRAMID', '47500', 'SS', 'SS', 'Malaysia', 'ACCEPTED', 'NONE', 'Academic Transcript , Internship Letter , Passport Copy , ', '', '07/18/2017', '02/03/2021', 'BACHELOR\'S', '', 'BACHELOR\'S OF MARKETING', 'CALTECH', 'everything is ok    						\r\n    					    						\r\n    					    						\r\n    					    						\r\n    					'),
(0000006, '2021_02_06_11_18_05_22.jpg', '', 'N075-1001.aps', '02/06/2021', 'KJ123213', 'RICHARD', 'BLISS', 'M', '06/21/1995', 'Belgium', 'Chinese , English , German , ', 'JOB', 'JOB FOR SOFTWARE ENGINEERING', 'PY2321321', '02/02/2021', 'PAID', '+601121676040', 'b20toto@gmail.com', 'SUNWAY PYRAMID', '47500', 'SS', 'SS', 'Malaysia', 'SUNWAY PYRAMID', '', 'SS', 'SS', 'Malaysia', 'KIV', 'NONE', 'Academic Transcript , Passport Copy , Others , ', 'CISCO CERTIFICATE', '05/10/2017', '11/18/2020', 'BACHELOR\'S', '', 'BACHELOR\'S OF COMPUTER SCIENCE', 'HAVARD UNIVERSITY', ' the passport copy submitted is not clear  \r\n');

-- --------------------------------------------------------

--
-- Table structure for table `USERS`
--

CREATE TABLE `USERS` (
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `affiliateCode` varchar(50) CHARACTER SET utf8 NOT NULL,
  `userType` varchar(20) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `USERS`
--

INSERT INTO `USERS` (`username`, `affiliateCode`, `userType`, `password`) VALUES
('admin', 'HRS', 'Admin', '$2y$10$JzZsB9rUQxrQxjay1PgN/uSW1fUFkKvgIbRvtAH3EiU8InpTR1/Wm'),
('affiliate_ECI', 'MSG041-1004.aps', 'Assessment Staff', '$2y$10$NE/EE6grRJGWBp.AN6.fvOTf4Yxuqz9kz5ojuU0BuaLEucoc2ySNu'),
('affiliate_rose', 'N075-1001.aps', 'Assessment Staff', '$2y$10$jxPn9208AsAWbQJGkiJBDOYhZJL3o1E7uAFvUx7bA4WX3vYiR5ymy'),
('assessment_hrs', 'HRS', 'Assessment Staff', '$2y$10$3/vHxmEUfBKnRfHKVqvQXej4fWsQAUfZSWL6Q6IPczOptbl5ZhtZC'),
('manager_hrs', 'HRS', 'Manager', '$2y$10$94/feNcbJOsWUd.TsnobgO57qW2crY4ho4dADAvMhHszsUkumnpgS'),
('vadvisor_hrs', 'HRS', 'Visa Advisor', '$2y$10$iDramhtptVe/oP.KinzYb.uEQSvlYVe8.72DWqx8uCr6bIrAmINRG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `APPLICANTS`
--
ALTER TABLE `APPLICANTS`
  ADD PRIMARY KEY (`applicantID`),
  ADD UNIQUE KEY `passportNumber` (`passportNumber`);

--
-- Indexes for table `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `APPLICANTS`
--
ALTER TABLE `APPLICANTS`
  MODIFY `applicantID` int(7) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
