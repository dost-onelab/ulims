-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2015 at 01:59 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ulimscashiering`
--

-- --------------------------------------------------------

--
-- Table structure for table `cancelledor`
--

CREATE TABLE IF NOT EXISTS `cancelledor` (
`id` int(11) NOT NULL,
  `receiptId` int(11) NOT NULL,
  `reason` tinytext NOT NULL,
  `cancelDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `check`
--

CREATE TABLE IF NOT EXISTS `check` (
`id` int(11) NOT NULL,
  `receipt_id` int(11) NOT NULL,
  `bank` varchar(25) NOT NULL,
  `checknumber` varchar(25) NOT NULL,
  `checkdate` date NOT NULL,
  `amount` float(11,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

CREATE TABLE IF NOT EXISTS `collection` (
`id` int(11) NOT NULL,
  `rstl_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `receipt_id` int(11) NOT NULL,
  `nature` varchar(50) NOT NULL,
  `amount` float(11,2) NOT NULL,
  `receiptid` varchar(50) NOT NULL,
  `cancelled` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `collectiontype`
--

CREATE TABLE IF NOT EXISTS `collectiontype` (
`id` int(11) NOT NULL,
  `natureOfCollection` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collectiontype`
--

INSERT INTO `collectiontype` (`id`, `natureOfCollection`, `status`) VALUES
(1, 'Analysis / Calibration', 1),
(2, 'Calibration Fee', 0),
(3, 'SETUP Project Payment', 1),
(4, 'Refund of Travel', 1),
(5, 'Bidder''s Bond', 1),
(6, 'Bidding Paper', 1),
(7, 'Performance Bond', 1),
(8, 'Exam Fee', 1),
(9, 'Photocopy Fee', 1),
(10, 'Internet Fee', 1),
(11, 'Analysis / Calibration', 0),
(12, 'Scholarship Assistance', 1),
(13, 'Others', 1),
(14, 'Customer Wallet', 1);

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE IF NOT EXISTS `deposit` (
`id` int(11) NOT NULL,
  `rstl_id` int(11) NOT NULL,
  `orseries_id` tinyint(10) NOT NULL,
  `startOr` int(11) NOT NULL,
  `endOr` int(11) NOT NULL,
  `depositDate` date NOT NULL,
  `amount` float(11,2) NOT NULL,
  `depositType` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lastor`
--

CREATE TABLE IF NOT EXISTS `lastor` (
`id` int(11) NOT NULL,
  `rstl_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `display` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orcategory`
--

CREATE TABLE IF NOT EXISTS `orcategory` (
`id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `code` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orcategory`
--

INSERT INTO `orcategory` (`id`, `name`, `code`) VALUES
(1, 'General Fund', 'Fund 101'),
(2, 'Trust Fund', 'TF');

-- --------------------------------------------------------

--
-- Table structure for table `orseries`
--

CREATE TABLE IF NOT EXISTS `orseries` (
`id` int(11) NOT NULL,
  `orcategory_id` int(11) NOT NULL,
  `rstl_id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `startor` varchar(50) NOT NULL,
  `nextor` varchar(50) NOT NULL,
  `endor` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orseries`
--

INSERT INTO `orseries` (`id`, `orcategory_id`, `rstl_id`, `name`, `startor`, `nextor`, `endor`, `status`) VALUES
(1, 1, 11, 'General', '2437933', '2437938', '2900000', 1),
(2, 2, 11, 'TF', '5000000', '5000001', '6000000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ortype`
--

CREATE TABLE IF NOT EXISTS `ortype` (
`id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ortype`
--

INSERT INTO `ortype` (`id`, `type`) VALUES
(1, 'Analysis'),
(2, 'Calibration'),
(3, 'Exam Fee'),
(4, 'Photcopy fee'),
(5, 'Rental for the SETUP Project');

-- --------------------------------------------------------

--
-- Table structure for table `paymentmode`
--

CREATE TABLE IF NOT EXISTS `paymentmode` (
`id` int(11) NOT NULL,
  `mode` varchar(12) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymentmode`
--

INSERT INTO `paymentmode` (`id`, `mode`) VALUES
(1, 'Cash'),
(2, 'Check'),
(3, 'Money Order');

-- --------------------------------------------------------

--
-- Table structure for table `payor`
--

CREATE TABLE IF NOT EXISTS `payor` (
`id` int(11) NOT NULL,
  `payor` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE IF NOT EXISTS `receipt` (
`id` int(11) NOT NULL,
  `rstl_id` int(11) NOT NULL,
  `receiptId` varchar(50) NOT NULL,
  `receiptDate` date NOT NULL,
  `paymentModeId` int(11) NOT NULL,
  `payor` varchar(100) NOT NULL,
  `collectionType` int(11) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `check_money_number` varchar(50) NOT NULL,
  `checkdate` date NOT NULL,
  `total` float(11,2) NOT NULL,
  `project` tinyint(1) NOT NULL,
  `orseries_id` tinyint(10) NOT NULL,
  `orderofpayment_id` int(11) NOT NULL,
  `cancelled` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE IF NOT EXISTS `report` (
`id` int(11) NOT NULL,
  `reportId` int(11) NOT NULL,
  `description` varchar(40) NOT NULL,
  `fileName` varchar(40) NOT NULL,
  `reportYear` int(11) NOT NULL,
  `reportMonth` int(11) NOT NULL,
  `reportDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reportcashier`
--

CREATE TABLE IF NOT EXISTS `reportcashier` (
`id` int(11) NOT NULL,
  `date` date NOT NULL,
  `receiptId` int(11) NOT NULL,
  `payor` varchar(100) NOT NULL,
  `collectionType` int(11) NOT NULL,
  `collectionBtr` float(11,2) NOT NULL,
  `collectionProject` float(11,2) NOT NULL,
  `cancelled` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reporttype`
--

CREATE TABLE IF NOT EXISTS `reporttype` (
`id` int(11) NOT NULL,
  `Type` varchar(40) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reporttype`
--

INSERT INTO `reporttype` (`id`, `Type`) VALUES
(1, 'lab'),
(2, 'cashier');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE IF NOT EXISTS `wallet` (
`id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `balance` float(11,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wallettransaction`
--

CREATE TABLE IF NOT EXISTS `wallettransaction` (
`id` int(11) NOT NULL,
  `wallet_id` int(11) NOT NULL,
  `transactioncode` varchar(25) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `date` date NOT NULL,
  `reference` int(11) NOT NULL,
  `receipt` int(11) NOT NULL,
  `amount` float(11,2) NOT NULL,
  `balance` float(11,2) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wallettransaction`
--

INSERT INTO `wallettransaction` (`id`, `wallet_id`, `transactioncode`, `type`, `date`, `reference`, `receipt`, `amount`, `balance`) VALUES
(1, 1, '', 1, '2014-09-08', 0, 123456, 25000.00, 25000.00),
(2, 1, '', 2, '2014-09-08', 5, 0, 3000.00, 22000.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cancelledor`
--
ALTER TABLE `cancelledor`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `check`
--
ALTER TABLE `check`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collection`
--
ALTER TABLE `collection`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collectiontype`
--
ALTER TABLE `collectiontype`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lastor`
--
ALTER TABLE `lastor`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orcategory`
--
ALTER TABLE `orcategory`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orseries`
--
ALTER TABLE `orseries`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ortype`
--
ALTER TABLE `ortype`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentmode`
--
ALTER TABLE `paymentmode`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payor`
--
ALTER TABLE `payor`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reportcashier`
--
ALTER TABLE `reportcashier`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reporttype`
--
ALTER TABLE `reporttype`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallettransaction`
--
ALTER TABLE `wallettransaction`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cancelledor`
--
ALTER TABLE `cancelledor`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `check`
--
ALTER TABLE `check`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `collectiontype`
--
ALTER TABLE `collectiontype`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lastor`
--
ALTER TABLE `lastor`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orcategory`
--
ALTER TABLE `orcategory`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `orseries`
--
ALTER TABLE `orseries`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ortype`
--
ALTER TABLE `ortype`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `paymentmode`
--
ALTER TABLE `paymentmode`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `payor`
--
ALTER TABLE `payor`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reportcashier`
--
ALTER TABLE `reportcashier`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reporttype`
--
ALTER TABLE `reporttype`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wallettransaction`
--
ALTER TABLE `wallettransaction`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
