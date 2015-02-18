-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2015 at 01:31 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ulimslab`
--

-- --------------------------------------------------------

--
-- Table structure for table `analysis`
--

CREATE TABLE IF NOT EXISTS `analysis` (
`id` int(11) NOT NULL,
  `rstl_id` int(11) NOT NULL,
  `requestId` varchar(50) NOT NULL,
  `sample_id` int(11) NOT NULL,
  `sampleCode` varchar(20) NOT NULL,
  `testName` varchar(200) NOT NULL,
  `method` varchar(150) NOT NULL,
  `references` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `fee` float NOT NULL,
  `testId` int(11) NOT NULL,
  `analysisMonth` int(11) NOT NULL,
  `analysisYear` int(11) NOT NULL,
  `package` int(11) NOT NULL,
  `cancelled` tinyint(1) NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `businessnature`
--

CREATE TABLE IF NOT EXISTS `businessnature` (
`id` int(11) NOT NULL,
  `nature` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `businessnature`
--

INSERT INTO `businessnature` (`id`, `nature`) VALUES
(1, 'Raw and Processed Food'),
(2, 'Marine Products'),
(3, 'Canned / Bottled Fish'),
(4, 'Fishmeal'),
(5, 'Seaweads'),
(6, 'Petroleum Products / Haulers'),
(7, 'Mining'),
(8, 'Hospitals'),
(9, 'Academe / Students'),
(10, 'Beverage and Juices'),
(11, 'Government / LGUs'),
(12, 'Construction'),
(13, 'Water Refilling / Bottled Water'),
(14, 'Students'),
(15, 'Private Individual'),
(16, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `cancelledrequest`
--

CREATE TABLE IF NOT EXISTS `cancelledrequest` (
`id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `requestRefNum` varchar(50) NOT NULL,
  `reason` varchar(50) NOT NULL,
  `cancelDate` date NOT NULL,
  `cancelledBy` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `configlab`
--

CREATE TABLE IF NOT EXISTS `configlab` (
`id` int(11) NOT NULL,
  `rstl_id` int(11) NOT NULL,
  `lab` varchar(25) NOT NULL DEFAULT '1,2,3'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
`id` int(11) NOT NULL,
  `rstl_id` int(11) NOT NULL,
  `customerName` varchar(200) NOT NULL,
  `head` varchar(100) NOT NULL,
  `municipalitycity_id` int(11) NOT NULL,
  `barangay_id` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `typeId` int(11) NOT NULL,
  `natureId` int(11) NOT NULL,
  `industryId` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customertype`
--

CREATE TABLE IF NOT EXISTS `customertype` (
`id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customertype`
--

INSERT INTO `customertype` (`id`, `type`) VALUES
(1, 'SETUP CORE'),
(2, 'NON SETUP'),
(3, 'SETUP NON-CORE');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE IF NOT EXISTS `discount` (
`id` int(11) NOT NULL,
  `type` varchar(25) NOT NULL,
  `rate` float(11,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `type`, `rate`, `status`) VALUES
(1, 'Students / Researchers ', 25.00, 1),
(2, 'In-House', 20.00, 1),
(3, 'Senior Citizen', 20.00, 0),
(4, 'Person with Disability', 20.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `generatedrequest`
--

CREATE TABLE IF NOT EXISTS `generatedrequest` (
`id` int(11) NOT NULL,
  `rstl_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `labId` tinyint(1) NOT NULL,
  `year` int(11) NOT NULL,
  `number` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `industrytype`
--

CREATE TABLE IF NOT EXISTS `industrytype` (
`id` int(11) NOT NULL,
  `industry` varchar(50) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `industrytype`
--

INSERT INTO `industrytype` (`id`, `industry`) VALUES
(1, 'Food Processing'),
(2, 'Furniture'),
(3, 'GTHD'),
(4, 'Aquatic and Marine'),
(5, 'Horticulture'),
(6, 'Metals and Engineering'),
(7, 'Information and Communcations Technology'),
(8, 'Health Products and Services'),
(9, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `initializecode`
--

CREATE TABLE IF NOT EXISTS `initializecode` (
`id` int(11) NOT NULL,
  `rstl_id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `codeType` int(11) NOT NULL,
  `startCode` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lab`
--

CREATE TABLE IF NOT EXISTS `lab` (
`id` int(11) NOT NULL,
  `labName` varchar(50) NOT NULL,
  `labCode` varchar(10) NOT NULL,
  `labCount` int(11) NOT NULL,
  `nextRequestCode` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab`
--

INSERT INTO `lab` (`id`, `labName`, `labCode`, `labCount`, `nextRequestCode`, `status`) VALUES
(1, 'Chemical Laboratory', 'CHE', 0, '', 1),
(2, 'Microbiological Laboratory', 'MIC', 0, '', 1),
(3, 'Metrology and Calibration Laboratory', 'MET', 0, '', 1),
(4, 'Physical Laboratory', 'PHY', 0, '', 0),
(5, 'Formula of Manufacture', 'FOC', 0, '', 0),
(6, 'Shelf Life Testing', 'SHL', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `labmanager`
--

CREATE TABLE IF NOT EXISTS `labmanager` (
`id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `labmanager`
--

INSERT INTO `labmanager` (`id`, `lab_id`, `user_id`) VALUES
(1, 1, 0),
(2, 2, 0),
(3, 3, 0),
(4, 4, 0),
(5, 5, 0),
(6, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE IF NOT EXISTS `package` (
`id` int(11) NOT NULL,
  `rstl_id` int(11) NOT NULL,
  `testcategory_id` int(11) NOT NULL,
  `sampletype_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `rate` float(11,2) NOT NULL,
  `tests` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
-- Table structure for table `paymenttype`
--

CREATE TABLE IF NOT EXISTS `paymenttype` (
`id` int(11) NOT NULL,
  `type` varchar(25) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymenttype`
--

INSERT INTO `paymenttype` (`id`, `type`) VALUES
(1, 'Paid'),
(2, 'Fully Subsidized');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
`id` int(11) NOT NULL,
  `requestRefNum` varchar(50) NOT NULL,
  `requestId` varchar(50) NOT NULL,
  `requestDate` date NOT NULL,
  `requestTime` varchar(25) NOT NULL,
  `rstl_id` int(11) NOT NULL,
  `labId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `paymentType` int(11) NOT NULL,
  `discount` tinyint(1) NOT NULL,
  `orId` int(11) NOT NULL,
  `total` float(11,2) NOT NULL,
  `reportDue` date NOT NULL,
  `conforme` varchar(50) NOT NULL,
  `receivedBy` varchar(50) NOT NULL,
  `cancelled` tinyint(1) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `requestcode`
--

CREATE TABLE IF NOT EXISTS `requestcode` (
`id` int(11) NOT NULL,
  `requestRefNum` varchar(50) NOT NULL,
  `rstl_id` int(11) NOT NULL,
  `labId` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `cancelled` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sample`
--

CREATE TABLE IF NOT EXISTS `sample` (
`id` int(11) NOT NULL,
  `rstl_id` int(11) NOT NULL,
  `sampleCode` varchar(20) NOT NULL,
  `sampleName` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `remarks` varchar(150) NOT NULL,
  `requestId` varchar(50) NOT NULL,
  `request_id` int(11) NOT NULL,
  `sampleMonth` int(11) NOT NULL,
  `sampleYear` int(11) NOT NULL,
  `cancelled` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `samplecode`
--

CREATE TABLE IF NOT EXISTS `samplecode` (
`id` int(11) NOT NULL,
  `rstl_id` int(11) NOT NULL,
  `requestId` varchar(50) NOT NULL,
  `labId` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `cancelled` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `samplename`
--

CREATE TABLE IF NOT EXISTS `samplename` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sampletype`
--

CREATE TABLE IF NOT EXISTS `sampletype` (
`id` int(11) NOT NULL,
  `sampleType` varchar(75) NOT NULL,
  `testCategoryId` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sampletype`
--

INSERT INTO `sampletype` (`id`, `sampleType`, `testCategoryId`) VALUES
(1, 'Fish and Marine Products', 1),
(2, 'Meat and Meat Products', 1),
(3, 'Milk (powder)', 1),
(4, 'Milk (liquid)', 1),
(5, 'Baked Products', 1),
(6, 'Coffee, Tea and Cacao', 1),
(7, 'Flour', 1),
(8, 'Infant Formula', 1),
(9, 'Sugar and Sugar-based Products, and Juices', 1),
(10, 'Other Analyses of Food Products and Raw Materials', 2),
(11, 'Fruit and Processed Fruit Products', 3),
(12, 'Feeds / Fishmeal and Dried Fish', 4),
(13, 'Vinegar', 5),
(14, 'Soy Sauce', 5),
(15, 'Salt', 5),
(16, 'Minerals in Food Samples', 6),
(17, 'Trace Metals in Food Samples', 7),
(18, 'Fats and Oils', 8),
(19, 'Plants', 9),
(20, 'Seaweeds', 10),
(21, 'Fertilizer', 11),
(22, 'Coal / Charcoal', 12),
(23, 'Food Products', 13),
(24, 'Water', 13),
(25, 'Static Electronic Balance', 14),
(26, 'Mass Standard', 14),
(27, 'Test Measure', 15),
(28, 'Proving Tank', 15),
(29, 'FlowMeter', 15),
(30, 'Road and Trailer Tank', 15),
(31, 'Water', 17),
(32, 'Seawater', 17),
(33, 'Wastewater', 17),
(34, 'Electronic Scale', 14),
(35, 'Mechanical Scale', 14),
(36, 'Spring Scale', 14),
(37, 'Truck Scale', 14),
(38, 'Swab Sample', 13),
(39, 'Others', 18),
(40, 'Air Microbial', 13),
(41, 'Dial/Hanging Scale', 14),
(42, 'Toploading Balance', 14),
(43, 'Triple Beam Balance', 14),
(44, 'Precision Balance', 14),
(45, 'Solution Balance', 14),
(46, 'Analytical Balance', 14),
(47, 'Platform Scale', 14),
(48, 'Crane Scale', 14),
(49, 'Batching Plant Scale', 14),
(50, 'Batch Weigher', 14),
(51, 'Graduated Cylinder', 15),
(52, 'Volumetric Pipette', 15),
(53, 'Volumetric Flask', 15),
(54, 'Erlenmeyer Flask', 15),
(55, 'Beaker', 15),
(56, 'Calibrating Buckets', 15),
(57, 'Storage and Mixing Tanks', 15),
(58, 'Vernier Caliper', 19),
(59, 'Digimatic Caliper', 19),
(60, 'Outside Micrometer', 19),
(61, 'Depth Micrometer', 19),
(62, 'Dial Gauge', 19),
(63, 'Step Gauge', 19),
(64, 'Go - No Go Gauge', 19),
(65, 'Feeler Gauge', 19);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
`id` int(11) NOT NULL,
  `rstl_id` int(11) NOT NULL,
  `testName` varchar(200) NOT NULL,
  `method` varchar(150) NOT NULL,
  `references` varchar(100) NOT NULL,
  `fee` float NOT NULL,
  `duration` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `sampleType` int(11) NOT NULL,
  `labId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `testcategory`
--

CREATE TABLE IF NOT EXISTS `testcategory` (
`id` int(11) NOT NULL,
  `categoryName` varchar(200) NOT NULL,
  `labId` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testcategory`
--

INSERT INTO `testcategory` (`id`, `categoryName`, `labId`) VALUES
(1, 'Proximate Analyses of Food Products and Raw Materials', 1),
(2, 'Other Analyses of Food Products and Raw Materials', 1),
(3, 'Fruit and Processed Fruit Products', 1),
(4, 'Feeds / Fishmeal / Dried Fish', 1),
(5, 'Spices and Other Condiments', 1),
(6, 'Minerals in Food Samples', 1),
(7, 'Trace Metals in Food Samples', 1),
(8, 'Fats and Oils', 1),
(9, 'Plants', 1),
(10, 'Seaweeds', 1),
(11, 'Fertilizer', 1),
(12, 'Coal / Charcoal', 1),
(13, 'Microbiological Analyses', 2),
(14, 'Mass Calibration', 3),
(15, 'Volumetric Calibration', 3),
(17, 'Water and Wastewater', 1),
(18, 'Others', 1),
(19, 'Length Calibration', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analysis`
--
ALTER TABLE `analysis`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `businessnature`
--
ALTER TABLE `businessnature`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cancelledrequest`
--
ALTER TABLE `cancelledrequest`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configlab`
--
ALTER TABLE `configlab`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customertype`
--
ALTER TABLE `customertype`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `generatedrequest`
--
ALTER TABLE `generatedrequest`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `industrytype`
--
ALTER TABLE `industrytype`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `initializecode`
--
ALTER TABLE `initializecode`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab`
--
ALTER TABLE `lab`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labmanager`
--
ALTER TABLE `labmanager`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentmode`
--
ALTER TABLE `paymentmode`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymenttype`
--
ALTER TABLE `paymenttype`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `requestRefNum` (`requestRefNum`,`requestId`);

--
-- Indexes for table `requestcode`
--
ALTER TABLE `requestcode`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sample`
--
ALTER TABLE `sample`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `samplecode`
--
ALTER TABLE `samplecode`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `samplename`
--
ALTER TABLE `samplename`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sampletype`
--
ALTER TABLE `sampletype`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testcategory`
--
ALTER TABLE `testcategory`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analysis`
--
ALTER TABLE `analysis`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `businessnature`
--
ALTER TABLE `businessnature`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `cancelledrequest`
--
ALTER TABLE `cancelledrequest`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `configlab`
--
ALTER TABLE `configlab`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customertype`
--
ALTER TABLE `customertype`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `generatedrequest`
--
ALTER TABLE `generatedrequest`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `industrytype`
--
ALTER TABLE `industrytype`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `initializecode`
--
ALTER TABLE `initializecode`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lab`
--
ALTER TABLE `lab`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `labmanager`
--
ALTER TABLE `labmanager`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `paymentmode`
--
ALTER TABLE `paymentmode`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `paymenttype`
--
ALTER TABLE `paymenttype`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `requestcode`
--
ALTER TABLE `requestcode`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sample`
--
ALTER TABLE `sample`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `samplecode`
--
ALTER TABLE `samplecode`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `samplename`
--
ALTER TABLE `samplename`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sampletype`
--
ALTER TABLE `sampletype`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `testcategory`
--
ALTER TABLE `testcategory`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
