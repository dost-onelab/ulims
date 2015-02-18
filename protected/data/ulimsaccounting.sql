-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2015 at 01:57 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ulimsaccounting`
--

-- --------------------------------------------------------

--
-- Table structure for table `bankaccount`
--

CREATE TABLE IF NOT EXISTS `bankaccount` (
`id` int(11) NOT NULL,
  `bankName` varchar(50) NOT NULL,
  `accountNumber` varchar(25) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bankaccount`
--

INSERT INTO `bankaccount` (`id`, `bankName`, `accountNumber`) VALUES
(1, 'LBP', '-');

-- --------------------------------------------------------

--
-- Table structure for table `orderofpayment`
--

CREATE TABLE IF NOT EXISTS `orderofpayment` (
`id` int(11) NOT NULL,
  `rstl_id` int(11) NOT NULL,
  `transactionNum` varchar(50) NOT NULL,
  `collectiontype_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customerName` varchar(250) NOT NULL,
  `address` varchar(200) NOT NULL,
  `amount` float(11,2) NOT NULL,
  `purpose` tinytext NOT NULL,
  `createdReceipt` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paymentitem`
--

CREATE TABLE IF NOT EXISTS `paymentitem` (
`id` int(11) NOT NULL,
  `rstl_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `orderofpayment_id` int(11) NOT NULL,
  `details` varchar(50) NOT NULL,
  `amount` float(11,2) NOT NULL,
  `cancelled` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bankaccount`
--
ALTER TABLE `bankaccount`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderofpayment`
--
ALTER TABLE `orderofpayment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentitem`
--
ALTER TABLE `paymentitem`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bankaccount`
--
ALTER TABLE `bankaccount`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `orderofpayment`
--
ALTER TABLE `orderofpayment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `paymentitem`
--
ALTER TABLE `paymentitem`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
