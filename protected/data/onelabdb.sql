-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2015 at 04:45 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `onelabdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `agency`
--

CREATE TABLE IF NOT EXISTS `agency` (
`id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `agency`
--

INSERT INTO `agency` (`id`, `region_id`, `name`, `code`) VALUES
(1, 3, 'DOST-I', 'R1'),
(2, 4, 'DOST-II', 'R2'),
(3, 5, 'DOST-III', 'R3'),
(4, 6, 'DOST-IVA-L1', 'R4AL1'),
(5, 6, 'DOST-IVA-L2', 'R4AL2'),
(6, 7, 'DOST-IVB', 'R4B'),
(7, 8, 'DOST-V', 'R5'),
(8, 9, 'DOST-VI', 'R6'),
(9, 10, 'DOST-VII', 'R7'),
(10, 11, 'DOST-VIII', 'R8'),
(11, 12, 'DOST-IX', 'R9'),
(12, 13, 'DOST-X', 'R10'),
(13, 14, 'DOST-XI', 'R11'),
(14, 15, 'DOST-XII-L1', 'R12L1'),
(15, 15, 'DOST-XII-L2', 'R12L2'),
(16, 2, 'DOST-CAR', 'CAR'),
(17, 16, 'DOST-CARAGA', 'R13'),
(18, 17, 'DOST-ARMM', 'ARMM'),
(19, 1, 'DOST-FNRI', 'FNRI'),
(20, 6, 'DOST-FPRDI', 'FPRDI'),
(21, 1, 'DOST-ITDI', 'ITDI'),
(22, 1, 'DOST-MIRDC', 'MIRDC'),
(23, 1, 'DOST-PTRI', 'PTRI'),
(24, 1, 'DOST-PNRI', 'PNRI'),
(25, 6, 'DOST-IVA-L3', 'R4AL3'),
(26, 6, 'DOST-IVA-L4', 'R4AL4'),
(27, 21, 'DOST-ADMATEL', 'ADMATEL');

-- --------------------------------------------------------

--
-- Table structure for table `agencythreshold`
--

CREATE TABLE IF NOT EXISTS `agencythreshold` (
`id` int(11) NOT NULL,
  `agency_id` int(11) NOT NULL,
  `availableSlots` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `agencythreshold`
--

INSERT INTO `agencythreshold` (`id`, `agency_id`, `availableSlots`) VALUES
(1, 1, 10),
(2, 2, 10),
(3, 3, 10),
(4, 4, 10),
(5, 5, 10),
(6, 6, 10),
(7, 7, 10),
(8, 8, 10),
(9, 9, 10),
(10, 10, 10),
(11, 11, 10),
(12, 12, 10),
(13, 13, 10),
(14, 14, 10),
(15, 15, 10),
(16, 16, 10),
(17, 17, 10),
(18, 18, 10),
(19, 19, 10),
(20, 20, 10),
(21, 21, 10),
(22, 22, 10),
(23, 23, 10),
(24, 24, 10),
(25, 25, 10),
(26, 26, 10),
(27, 27, 10);

-- --------------------------------------------------------

--
-- Table structure for table `analysis`
--

CREATE TABLE IF NOT EXISTS `analysis` (
`id` int(11) NOT NULL,
  `sample_id` int(11) NOT NULL,
  `testName_id` int(11) NOT NULL,
  `methodReference_id` int(11) NOT NULL,
  `fee` float(11,2) NOT NULL,
  `status_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `analysis`
--

INSERT INTO `analysis` (`id`, `sample_id`, `testName_id`, `methodReference_id`, `fee`, `status_id`, `create_time`, `update_time`) VALUES
(1, 7, 1, 1, 100.00, 1, '0000-00-00 00:00:00', '2015-01-25 06:32:35'),
(2, 7, 1, 1, 100.00, 1, '2015-01-30 00:00:00', '2015-01-25 06:33:03'),
(3, 8, 2, 2, 2000.00, 0, '2015-01-30 00:00:00', '2015-01-25 06:37:14'),
(4, 10, 33, 7, 900.00, 0, '0000-00-00 00:00:00', '2015-02-06 22:55:38'),
(5, 11, 33, 7, 900.00, 0, '0000-00-00 00:00:00', '2015-02-08 06:40:19'),
(6, 12, 31, 5, 550.00, 0, '0000-00-00 00:00:00', '2015-02-12 02:36:09');

-- --------------------------------------------------------

--
-- Table structure for table `barangay`
--

CREATE TABLE IF NOT EXISTS `barangay` (
`id` int(11) NOT NULL,
  `municipalityCityId` int(11) NOT NULL,
  `district` int(11) DEFAULT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barangay`
--

INSERT INTO `barangay` (`id`, `municipalityCityId`, `district`, `name`) VALUES
(1, 1, 1, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `businessnature`
--

CREATE TABLE IF NOT EXISTS `businessnature` (
`id` int(11) NOT NULL,
  `nature` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

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
-- Table structure for table `collectiontype`
--

CREATE TABLE IF NOT EXISTS `collectiontype` (
  `id` int(11) NOT NULL,
  `natureOfCollection` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `collectiontype`
--

INSERT INTO `collectiontype` (`id`, `natureOfCollection`, `status`) VALUES
(1, 'Analysis / Calibration', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
`id` int(11) NOT NULL,
  `customerName` varchar(50) NOT NULL,
  `agencyHead` varchar(50) NOT NULL,
  `region_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `municipalityCity_id` int(11) NOT NULL,
  `barangay_id` int(11) NOT NULL,
  `houseNumber` varchar(200) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `type_id` int(11) NOT NULL,
  `nature_id` int(11) NOT NULL,
  `industry_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `customerName`, `agencyHead`, `region_id`, `province_id`, `municipalityCity_id`, `barangay_id`, `houseNumber`, `tel`, `fax`, `email`, `type_id`, `nature_id`, `industry_id`, `created_by`, `create_time`, `update_time`) VALUES
(3, 'Mega Fish Corporation', 'localCustomer', 11, 6, 2, 1, '1', '9911024', '9911024', 'admin@email.com', 2, 1, 1, 11, '2015-02-06 00:00:00', '2015-02-08 01:19:32');

-- --------------------------------------------------------

--
-- Table structure for table `customertype`
--

CREATE TABLE IF NOT EXISTS `customertype` (
`id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

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
  `id` int(11) NOT NULL DEFAULT '0',
  `type` varchar(50) NOT NULL,
  `rate` float(11,2) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `type`, `rate`, `status`) VALUES
(1, 'Students / Researchers', 25.00, 1),
(2, 'In-House', 20.00, 1),
(3, 'Senior Citizen', 20.00, 0),
(4, 'Person with Disability', 20.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `industrytype`
--

CREATE TABLE IF NOT EXISTS `industrytype` (
`id` int(11) NOT NULL,
  `classification` varchar(250) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `industrytype`
--

INSERT INTO `industrytype` (`id`, `classification`, `active`) VALUES
(1, 'Agriculture, forestry and fishing', 1),
(2, 'Mining and Quarrying', 1),
(3, 'Manufacturing', 1),
(4, 'Electricity, gas, steam and air-conditioning supply', 1),
(5, 'Water supply, sewerage, waste management and remediation activities', 1),
(6, 'Construction', 1),
(7, 'Wholesale and retail trade; repair of motor vehicles and motorcycles', 1),
(8, 'Transportation and Storage', 1),
(9, 'Accommodation and food service activities', 1),
(10, 'Information and Communication', 1),
(11, 'Financial and insurance activities', 1),
(12, 'Real estate activities', 1),
(13, 'Professional, scientific and technical services', 1),
(14, 'Administrative and support service activities', 1),
(15, 'Public administrative and defense; compulsory social security', 1),
(16, 'Education', 1),
(17, 'Human health and social work activities', 1),
(18, 'Arts, entertainment and recreation', 1),
(19, 'Other service activities', 1),
(20, 'Activities of private households as employers and undifferentiated goods and services and producing activities of households for own use', 1),
(21, 'Activities of extraterritorial organizations and bodies', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lab`
--

CREATE TABLE IF NOT EXISTS `lab` (
`id` int(11) NOT NULL,
  `labName` varchar(50) NOT NULL,
  `labCode` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab`
--

INSERT INTO `lab` (`id`, `labName`, `labCode`) VALUES
(1, 'Chemical Laboratory', 'CHE'),
(2, 'Microbiological Laboratory', 'MIC'),
(3, 'Metrology and Calibration Laboratory', 'MET'),
(4, 'Physical Laboratory', 'PHY'),
(5, 'Formula of Manufacture', 'FOC'),
(6, 'Shelf Life Testing', 'SHL'),
(7, 'Biological Laboratory', 'BIO');

-- --------------------------------------------------------

--
-- Table structure for table `lab_sampletype`
--

CREATE TABLE IF NOT EXISTS `lab_sampletype` (
`id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `sampletypeId` int(11) NOT NULL,
  `effective_date` date NOT NULL,
  `added_by` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_sampletype`
--

INSERT INTO `lab_sampletype` (`id`, `lab_id`, `sampletypeId`, `effective_date`, `added_by`) VALUES
(1, 7, 1, '2015-01-29', 'STG'),
(2, 1, 15, '2015-01-29', 'SBTG'),
(3, 1, 3, '2015-01-30', 'ADM'),
(4, 1, 2, '2015-01-30', 'ADM');

-- --------------------------------------------------------

--
-- Table structure for table `methodreference`
--

CREATE TABLE IF NOT EXISTS `methodreference` (
`id` int(11) NOT NULL,
  `testname_id` int(11) NOT NULL,
  `method` varchar(200) NOT NULL,
  `reference` varchar(200) NOT NULL,
  `fee` float(11,2) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=212 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `methodreference`
--

INSERT INTO `methodreference` (`id`, `testname_id`, `method`, `reference`, `fee`, `create_time`, `update_time`) VALUES
(1, 0, 'Pour plate', 'Standard Methods for the Examination of Water and Wastewater (SMEWW) 22nd Edition, 2012 APHA, AWWA, WEF', 550.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(2, 0, 'Most Probable Nuimber (MPN)', 'Standard Methods for the Examination of Water and Wastewater (SMEWW) 22nd Edition, 2012 APHA, AWWA, WEF', 550.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(3, 0, 'Multiple Tube Fermentation Techniques', 'Standard Methods for the Examination of Water and Wastewater (SMEWW) 22nd Edition, 2012 APHA, AWWA, WEF', 1000.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(4, 0, 'Multiple Tube Fermentation Techniques', 'Standard Methods for the Examination of Water and Wastewater (SMEWW) 22nd Edition, 2012 APHA, AWWA, WEF', 900.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(5, 0, 'Pour plate', 'Bacteriological  Analytical Manual, Online 2001 US Food and Drug Administration', 550.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(7, 0, 'Pour plate', 'Bacteriological  Analytical Manual, Online 2001 US Food and Drug Administration', 900.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(8, 0, 'Pour plate', 'Bacteriological  Analytical Manual, Online 2001 US Food and Drug Administration', 1200.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(9, 0, 'Multiple Tube Fermentation Techniques', 'Bacteriological  Analytical Manual, Online 2001 US Food and Drug Administration', 720.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(10, 0, 'Sterility Test', 'Bacteriological  Analytical Manual, Online 2001 US Food and Drug Administration', 2000.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(11, 0, 'Disc Diffusion Method', 'The US Pharmacopeia 30 NF 25, 2007', 600.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(12, 0, 'Ecometry Technique (Relative Growth Index (RGI)', 'The US Pharmacopeia 30 NF 25, 2007', 1600.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(13, 0, 'Modified OECD Guideline 401', 'OECD Manual 2004', 7900.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(15, 0, 'Lipschitz Method', 'OECD Manual 2007', 3800.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(16, 0, 'Modified OECD Guideline 401', 'OECD Manual 2008', 20000.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(17, 0, 'Modified OECD Guideline 404', 'OECD Manual 2009', 7250.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(18, 0, 'Modified OECD Guideline 404', 'OECD Manual 2010', 11750.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(19, 0, 'Modified OECD Guideline 405', 'OECD Manual 2011', 7250.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(20, 0, 'Modified OECD Guideline 405', 'OECD Manual 2012', 11750.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(21, 0, 'Modified OECD Guideline 406', 'OECD Manual 2013', 48500.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(22, 0, 'Modified OECD Guideline 401', 'OECD Manual 2014', 42500.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(23, 0, 'Modified OECD Guideline 402', 'OECD Manual 2015', 52500.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(24, 0, 'Modified OECD Guideline 404', 'OECD Manual 2016', 20000.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(25, 0, 'Modified OECD Guideline 405', 'OECD Manual 2017', 25000.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(26, 0, 'Modified OECD Guideline 401', 'OECD Manual 2019', 21200.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(27, 0, 'Modified OECD Guideline 402', 'OECD Manual 2020', 29000.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(28, 0, 'Glass Cylinder Method', 'ASTM WHO', 33000.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(29, 0, 'Probit Method', 'WHO 2005', 23000.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(30, 0, 'Arm in Cage Method', 'WHO 2009', 33000.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(31, 0, 'Ebeling Method', '', 33000.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(32, 0, '', 'WHO 2005', 35000.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(33, 0, 'Glass Cylinder Method', 'WHO 2005', 33000.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(34, 0, 'Glass Cylinder Method', 'WHO', 6000.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(35, 0, 'Probit Method', 'WHO', 5700.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(36, 0, 'Arm in Cage Method', 'WHO', 6000.00, '0000-00-00 00:00:00', '2015-01-26 23:41:21'),
(37, 0, 'Titrimetry', '', 500.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(38, 0, 'GF-AAS', '', 1500.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(39, 0, 'HVG-AAS', '', 1500.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(40, 0, 'AAS', '', 1200.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(41, 0, 'EDTA Titration', '', 700.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(42, 0, 'Argentometric titration', '', 750.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(43, 0, 'Iodometric', '', 750.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(44, 0, 'Platinum Standard', '', 700.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(45, 0, 'Electrical Conductivity Method', '', 350.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(46, 0, 'Titrimetry(Argentometric)', '', 1000.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(47, 0, 'IC', '', 1100.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(48, 0, 'EDTA-By difference', '', 700.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(49, 0, 'Cold Vapor AAS', '', 1500.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(50, 0, 'CV-AFS', '', 1550.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(51, 0, 'Distillation/Titration', '', 850.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(52, 0, 'Kjeldahl Titration', '', 950.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(53, 0, 'pH Potentionetry', '', 350.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(54, 0, 'Colorimetry', '', 700.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(55, 0, 'AAS/Flame Emission', '', 1200.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(56, 0, 'Gravimetry', '', 800.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(57, 0, 'UV-Vis', '', 800.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(58, 0, 'AAS', '', 800.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(59, 0, 'AAS/Flame Emission', '', 1200.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(60, 0, 'Turbidimetry/Gravimetry', '', 850.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(61, 0, 'EDTA Titration', '', 700.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(62, 0, 'Gravimetry', '', 600.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(63, 0, 'Gravimetry', '', 650.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(64, 0, 'Gravimetry', '', 700.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(65, 0, 'Turbidimetry', '', 300.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(66, 0, 'GF-AAS', '', 6400.00, '0000-00-00 00:00:00', '2015-01-26 23:42:06'),
(67, 0, 'Mercuric Bromide Stain', '', 800.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(68, 0, 'HVG-AAS', '', 1500.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(69, 0, 'Titrimetry', '', 650.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(70, 0, 'Titrimetry', '', 700.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(71, 0, 'Colorimetry', '', 800.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(72, 0, 'Gravimetric', '', 600.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(73, 0, 'ASTM E70', '', 400.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(74, 0, 'ASTM D891', '', 300.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(75, 0, 'ASTM D891', '', 500.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(76, 0, 'Turbidimetry', '', 850.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(77, 0, 'ASTM D2022', '', 700.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(78, 0, 'ASTM D2022', '', 650.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(79, 0, 'ASTM C110', '', 450.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(80, 0, 'pH Potentiometry', '', 400.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(81, 0, 'ASTM C110', '', 400.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(82, 0, 'ASTM C110', '', 230.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(83, 0, 'AOAC 925.55', '', 5000.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(84, 0, 'AOAC 925.55', '', 600.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(85, 0, 'ASTM E534', '', 700.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(86, 0, 'AOAC 925.56', '', 700.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(87, 0, 'ASTM E534', '', 700.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(88, 0, 'AOAC 925.55', '', 650.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(89, 0, 'Argentimetric Titration', '', 700.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(90, 0, 'AOAC 925.55', '', 800.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(91, 0, 'AOAC 925.55', '', 600.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(92, 0, 'HVG AAS', '', 1500.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(93, 0, 'JISM 5584', '', 6500.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(94, 0, 'JISM 5584', '', 850.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(95, 0, 'JISM 5584', '', 800.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(96, 0, 'JISM 5584', '', 700.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(97, 0, 'JISM 5584', '', 1100.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(98, 0, 'JISM 5584', '', 600.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(99, 0, 'JISM 5584', '', 1070.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(100, 0, 'AAS', '', 900.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(101, 0, 'Titrimetry ASTM 169-92', '', 1500.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(102, 0, 'ASTM C25', '', 4500.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(103, 0, 'ASTM C25', '', 1310.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(104, 0, 'ASTM C25', '', 500.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(105, 0, 'ASTM C25', '', 650.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(106, 0, 'ASTM C25', '', 800.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(107, 0, 'ASTM C25', '', 600.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(108, 0, 'ASTM C25', '', 1100.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(109, 0, 'ASTM C25', '', 800.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(110, 0, 'ASTM C25', '', 1320.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(111, 0, 'ASTM C471', '', 6500.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(112, 0, 'ASTM C471', '', 805.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(113, 0, 'ASTM C471', '', 800.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(114, 0, 'ASTM C471', '', 750.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(115, 0, 'ASTM C471', '', 500.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(116, 0, 'ASTM C471', '', 700.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(117, 0, 'ASTM C471', '', 850.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(118, 0, 'ASTM C471', '', 1100.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(119, 0, 'ASTM C471', '', 930.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(120, 0, 'Tech. Method of Analysis by Griffin', '', 600.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(121, 0, 'Tech. Method of Analysis by Griffin', '', 650.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(122, 0, 'Tech. Method of Analysis by Griffin', '', 1320.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(123, 0, 'Tech. Method of Analysis by Griffin', '', 1100.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(124, 0, 'Tech. Method of Analysis by Griffin', '', 930.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(125, 0, 'Tech. Method of Analysis by Griffin', '', 700.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(126, 0, 'Tech. Method of Analysis by Griffin', '', 800.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(127, 0, 'AOAC', '', 600.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(128, 0, 'Kjeldahl Titration', '', 1000.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(129, 0, 'Colorimetry', '', 1000.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(130, 0, 'AAS', '', 1000.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(131, 0, 'ASTM C114', '', 5800.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(132, 0, 'ASTM C114', '', 850.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(133, 0, 'ASTM C114', '', 800.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(134, 0, 'ASTM C114', '', 700.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(135, 0, 'ASTM C114', '', 1100.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(136, 0, 'ASTM C114', '', 930.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(137, 0, 'ASTM D4052/ASTM D1298', '', 700.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(138, 0, 'ASTM D 482', '', 670.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(139, 0, 'ASTM D 874', '', 840.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(140, 0, 'ASTM D1500', '', 360.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(141, 0, 'ASTM D130', '', 700.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(142, 0, 'ASTM D 92', '', 700.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(143, 0, 'ASTM D 93', '', 700.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(144, 0, 'ASTM D 56', '', 700.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(145, 0, 'ASTM D 445', '', 800.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(146, 0, 'ASTM D 974', '', 520.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(147, 0, 'ASTM D 2270', '', 1320.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(148, 0, 'ASTM D 1796/ASTM D2709', '', 840.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(149, 0, 'ASTM D 95', '', 840.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(150, 0, 'ASTM D 4740', '', 1300.00, '0000-00-00 00:00:00', '2015-01-26 23:42:53'),
(151, 0, 'ASTM D240', '', 1500.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(152, 0, 'ASTM D97', '', 1500.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(153, 0, 'ASTM D 1762', '', 1990.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(154, 0, 'ASTM D 1762', '', 840.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(155, 0, 'ASTM D 1762', '', 450.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(156, 0, 'ASTM D 1762', '', 700.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(157, 0, 'ASTM D 1762', '', 1990.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(158, 0, 'ASTM D 3286', '', 1500.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(159, 0, 'ASTM D 566', '', 600.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(160, 0, 'ASTM D 217', '', 650.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(161, 0, 'PNS 239', '', 480.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(162, 0, 'PNS 239', '', 2200.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(163, 0, 'PNS 239', '', 400.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(164, 0, 'ASTM D 1298', '', 700.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(165, 0, 'ASTM D 445', '', 800.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(166, 0, 'ASTM D 127', '', 720.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(167, 0, 'ASTM D 1321', '', 720.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(168, 0, 'ASTM D 5', '', 720.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(169, 0, 'ASTM D 36', '', 720.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(170, 0, 'USP 23, [561]', '', 1080.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(171, 0, 'AOAC 920.39', '', 960.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(172, 0, 'USP 23, [561]', '', 1380.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(173, 0, 'AOAC 955.04', '', 1120.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(174, 0, 'USP 23, [561]', '', 1080.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(175, 0, 'USP 23, [401]', '', 840.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(176, 0, 'USP 23, [921]', '', 600.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(177, 0, 'USP 23, [561]', '', 720.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(178, 0, 'BTD Manual Qualitative', '', 650.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(179, 0, 'TLC', '', 1200.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(180, 0, 'BTD Manual Qualitative', '', 600.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(181, 0, 'USP [401]', '', 600.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(182, 0, 'USP [831]', '', 400.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(183, 0, 'USP [401]', '', 800.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(184, 0, 'Titration', '', 600.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(185, 0, 'USP [841]', '', 500.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(186, 0, 'AOAC 932.11', '', 1080.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(187, 0, 'USP [401]', '', 840.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(188, 0, 'ASTM D 2556', '', 840.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(189, 0, 'Spectrophotometer', '', 3960.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(190, 0, 'Spectrophotometer', '', 1160.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(191, 0, 'HPLC', '', 2800.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(192, 0, 'AOAC 929.07', '', 1920.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(193, 0, 'AOAC 930.35', '', 1440.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(194, 0, 'AOAC 966.16', '', 1920.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(195, 0, 'HPLC', '', 4000.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(196, 0, 'HPLC', '', 3750.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(197, 0, 'HPLC', '', 3500.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(198, 0, 'HPLC', '', 3600.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(199, 0, 'GC', '', 1800.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(200, 0, 'GC', '', 1800.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(201, 0, 'USP 23', '', 325.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(202, 0, 'ASTM D 2556', '', 840.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(203, 0, 'USP 23', '', 600.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(204, 0, 'ASTM D 1308', '', 0.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(205, 0, 'ASTM D 1309', '', 400.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(206, 0, 'ASTM D 1310', '', 650.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(207, 0, 'ASTM D 1475', '', 515.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(208, 0, 'ASTM D 1640', '', 400.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(209, 0, 'ASTM D 1210', '', 380.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(210, 0, 'ASTM D  523', '', 500.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43'),
(211, 0, 'ASTM D 2371', '', 1000.00, '0000-00-00 00:00:00', '2015-01-26 23:44:43');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1418904609),
('m130524_201442_init', 1418904630);

-- --------------------------------------------------------

--
-- Table structure for table `municipality_city`
--

CREATE TABLE IF NOT EXISTS `municipality_city` (
`id` int(11) NOT NULL,
  `regionId` int(11) NOT NULL,
  `provinceId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `district` int(2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1633 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `municipality_city`
--

INSERT INTO `municipality_city` (`id`, `regionId`, `provinceId`, `name`, `district`) VALUES
(1, 1, 1, 'Manila', NULL),
(2, 1, 2, 'Mandaluyong', NULL),
(3, 1, 2, 'Marikina', NULL),
(4, 1, 2, 'Pasig', NULL),
(5, 1, 2, 'Quezon City', NULL),
(6, 1, 2, 'San Juan', NULL),
(7, 1, 3, 'Caloocan', NULL),
(8, 1, 3, 'Malabon', NULL),
(9, 1, 3, 'Navotas', NULL),
(10, 1, 3, 'Valenzuela', NULL),
(11, 1, 4, 'Las Piñas', NULL),
(12, 1, 4, 'Makati', NULL),
(13, 1, 4, 'Muntinlupa', NULL),
(14, 1, 4, 'Parañaque', NULL),
(15, 1, 4, 'Pasay', NULL),
(16, 1, 4, 'Pateros', NULL),
(17, 1, 4, 'Taguig', NULL),
(18, 2, 5, 'Bangued', 1),
(19, 2, 5, 'Boliney', 1),
(20, 2, 5, 'Bucay', 1),
(21, 2, 5, 'Bucloc', 1),
(22, 2, 5, 'Daguioman', 1),
(23, 2, 5, 'Danglas', 1),
(24, 2, 5, 'Dolores', 1),
(25, 2, 5, 'La Paz', 1),
(26, 2, 5, 'Lacub', 1),
(27, 2, 5, 'Lagangilang', 1),
(28, 2, 5, 'Lagayan', 1),
(29, 2, 5, 'Langiden', 1),
(30, 2, 5, 'Licuan-Baay (Licuan)', 1),
(31, 2, 5, 'Luba', 1),
(32, 2, 5, 'Malibcong', 1),
(33, 2, 5, 'Manabo', 1),
(34, 2, 5, 'Peñarrubia', 1),
(35, 2, 5, 'Pidigan', 1),
(36, 2, 5, 'Pilar', 1),
(37, 2, 5, 'Sallapadan', 1),
(38, 2, 5, 'San Isidro', 1),
(39, 2, 5, 'San Juan', 1),
(40, 2, 5, 'San Quintin', 1),
(41, 2, 5, 'Tayum', 1),
(42, 2, 5, 'Tineg', 1),
(43, 2, 5, 'Tubo', 1),
(44, 2, 5, 'Villaviciosa', 1),
(45, 2, 6, 'Calanasan (Bayag)', 1),
(46, 2, 6, 'Conner', 1),
(47, 2, 6, 'Flora', 1),
(48, 2, 6, 'Kabugao', 1),
(49, 2, 6, 'Luna (Macatel[3])', 1),
(50, 2, 6, 'Pudtol', 1),
(51, 2, 6, 'Santa Marcela', 1),
(52, 2, 7, 'Baguio City', 1),
(53, 2, 8, 'Atok', 1),
(54, 2, 8, 'Bakun', 1),
(55, 2, 8, 'Bokod', 1),
(56, 2, 8, 'Buguias', 1),
(57, 2, 8, 'Itogon', 1),
(58, 2, 8, 'Kabayan', 1),
(59, 2, 8, 'Kapangan', 1),
(60, 2, 8, 'Kibungan', 1),
(61, 2, 8, 'La Trinidad', 1),
(62, 2, 8, 'Mankayan', 1),
(63, 2, 8, 'Sablan', 1),
(64, 2, 8, 'Tuba', 1),
(65, 2, 8, 'Tublay', 1),
(66, 2, 9, 'Aguinaldo', 1),
(67, 2, 9, 'Alfonso Lista (Potia)', 1),
(68, 2, 9, 'Asipulo', 1),
(69, 2, 9, 'Banaue', 1),
(70, 2, 9, 'Hingyon', 1),
(71, 2, 9, 'Hungduan', 1),
(72, 2, 9, 'Kiangan', 1),
(73, 2, 9, 'Lagawe', 1),
(74, 2, 9, 'Lamut', 1),
(75, 2, 9, 'Mayoyao', 1),
(76, 2, 9, 'Tinoc', 1),
(77, 2, 10, 'Tabuk', 1),
(78, 2, 10, 'Balbalan', 1),
(79, 2, 10, 'Lubuagan', 1),
(80, 2, 10, 'Pasil', 1),
(81, 2, 10, 'Pinukpuk', 1),
(82, 2, 10, 'Rizal (Liwan)', 1),
(83, 2, 10, 'Tanudan', 1),
(84, 2, 10, 'Tinglayan', 1),
(85, 2, 11, 'Barlig', 1),
(86, 2, 11, 'Bauko', 1),
(87, 2, 11, 'Besao', 1),
(88, 2, 11, 'Bontoc', 1),
(89, 2, 11, 'Natonin', 1),
(90, 2, 11, 'Paracelis', 1),
(91, 2, 11, 'Sabangan', 1),
(92, 2, 11, 'Sadanga', 1),
(93, 2, 11, 'Sagada', 1),
(94, 2, 11, 'Tadian', 1),
(95, 3, 12, 'Adams', 1),
(96, 3, 12, 'Bacarra', 1),
(97, 3, 12, 'Badoc', 2),
(98, 3, 12, 'Bangui', 1),
(99, 3, 12, 'Banna (Espiritu)', 2),
(100, 3, 12, 'Batac City', 2),
(101, 3, 12, 'Burgos', 1),
(102, 3, 12, 'Carasi', 1),
(103, 3, 12, 'Currimao', 2),
(104, 3, 12, 'Dingras', 2),
(105, 3, 12, 'Dumalneg', 1),
(106, 3, 12, 'Laoag City', 1),
(107, 3, 12, 'Marcos', 2),
(108, 3, 12, 'Nueva Era', 2),
(109, 3, 12, 'Pagudpud', 1),
(110, 3, 12, 'Paoay', 2),
(111, 3, 12, 'Pasuquin', 1),
(112, 3, 12, 'Piddig', 1),
(113, 3, 12, 'Pinili', 2),
(114, 3, 12, 'San Nicolas', 2),
(115, 3, 12, 'Sarrat', 1),
(116, 3, 12, 'Solsona', 2),
(117, 3, 12, 'Vintar', 1),
(118, 3, 13, 'Vigan City', 1),
(119, 3, 13, 'Candon City', 2),
(120, 3, 13, 'Alilem', 2),
(121, 3, 13, 'Banayoyo', 2),
(122, 3, 13, 'Bantay', 1),
(123, 3, 13, 'Burgos', 2),
(124, 3, 13, 'Cabugao', 1),
(125, 3, 13, 'Caoayan', 1),
(126, 3, 13, 'Cervantes', 2),
(127, 3, 13, 'Galimuyod', 2),
(128, 3, 13, 'Gregorio del Pilar (Concepcion)', 2),
(129, 3, 13, 'Lidlidda', 2),
(130, 3, 13, 'Magsingal', 1),
(131, 3, 13, 'Nagbukel', 2),
(132, 3, 13, 'Narvacan', 2),
(133, 3, 13, 'Quirino (Angaki)', 2),
(134, 3, 13, 'Salcedo (Baugen)', 2),
(135, 3, 13, 'San Emilio', 2),
(136, 3, 13, 'San Esteban', 2),
(137, 3, 13, 'San Ildefonso', 1),
(138, 3, 13, 'San Juan (Lapog)', 1),
(139, 3, 13, 'San Vicente', 1),
(140, 3, 13, 'Santa', 2),
(141, 3, 13, 'Santa Catalina', 1),
(142, 3, 13, 'Santa Cruz', 2),
(143, 3, 13, 'Santa Lucia', 2),
(144, 3, 13, 'Santa Maria', 2),
(145, 3, 13, 'Santiago', 2),
(146, 3, 13, 'Santo Domingo', 1),
(147, 3, 13, 'Sigay', 2),
(148, 3, 13, 'Sinait', 1),
(149, 3, 13, 'Sugpon', 2),
(150, 3, 13, 'Suyo', 2),
(151, 3, 13, 'Tagudin', 2),
(152, 3, 14, 'San Fernando City, La Union', 1),
(153, 3, 14, 'Agoo', 2),
(154, 3, 14, 'Aringay', 2),
(155, 3, 14, 'Bacnotan', 1),
(156, 3, 14, 'Bagulin', 2),
(157, 3, 14, 'Balaoan', 1),
(158, 3, 14, 'Bangar', 1),
(159, 3, 14, 'Bauang', 2),
(160, 3, 14, 'Burgos', 2),
(161, 3, 14, 'Caba', 2),
(162, 3, 14, 'Luna', 1),
(163, 3, 14, 'Naguilian', 2),
(164, 3, 14, 'Pugo', 2),
(165, 3, 14, 'Rosario', 2),
(166, 3, 13, 'San Gabriel', 1),
(167, 3, 14, 'San Juan', 1),
(168, 3, 14, 'Sto. Tomas', 2),
(169, 3, 14, 'Santol', 1),
(170, 3, 14, 'Sudipen', 1),
(171, 3, 14, 'Tubao', 2),
(172, 3, 15, 'Alaminos', 1),
(173, 3, 15, 'Dagupan', 4),
(174, 3, 15, 'San Carlos', 3),
(175, 3, 15, 'Urdaneta City', 5),
(176, 3, 15, 'Agno', 1),
(177, 3, 15, 'Aguilar', 2),
(178, 3, 15, 'Alcala', 5),
(179, 3, 15, 'Anda', 1),
(180, 3, 15, 'Asingan', 6),
(181, 3, 15, 'Balungao', 6),
(182, 3, 15, 'Bani', 1),
(183, 3, 15, 'Basista', 2),
(184, 3, 15, 'Bautista', 5),
(185, 3, 15, 'Bayambang', 3),
(186, 3, 15, 'Binalonan', 5),
(187, 3, 15, 'Binmaley', 2),
(188, 3, 15, 'Bolinao', 1),
(189, 3, 15, 'Bugallon', 2),
(190, 3, 15, 'Burgos', 1),
(191, 3, 15, 'Calasiao', 3),
(192, 3, 15, 'Dasol', 1),
(193, 3, 15, 'Infanta', 1),
(194, 3, 15, 'Labrador', 2),
(195, 3, 15, 'Laoac', 5),
(196, 3, 15, 'Lingayen', 2),
(197, 3, 15, 'Mabini', 1),
(198, 3, 15, 'Malasiqui', 3),
(199, 3, 15, 'Manaoag', 4),
(200, 3, 15, 'Mangaldan', 4),
(201, 3, 15, 'Mangatarem', 2),
(202, 3, 15, 'Mapandan', 3),
(203, 3, 15, 'Natividad', 6),
(204, 3, 15, 'Pozorrubio', 5),
(205, 3, 15, 'Rosales', 6),
(206, 3, 15, 'San Fabian', 4),
(207, 3, 15, 'San Jacinto', 4),
(208, 3, 15, 'San Manuel', 6),
(209, 3, 15, 'San Nicolas', 6),
(210, 3, 15, 'San Quintin', 6),
(211, 3, 15, 'Santa Barbara', 3),
(212, 3, 15, 'Santa Maria', 6),
(213, 3, 15, 'Santo Tomas', 5),
(214, 3, 15, 'Sison', 5),
(215, 3, 15, 'Sual', 1),
(216, 3, 15, 'Tayug', 6),
(217, 3, 15, 'Umingan', 6),
(218, 3, 15, 'Urbiztondo', 2),
(219, 3, 15, 'Villasis', 5),
(220, 4, 16, 'Basco', 1),
(221, 4, 16, 'Itbayat', 1),
(222, 4, 16, 'Ivana', 1),
(223, 4, 16, 'Mahatao', 1),
(224, 4, 16, 'Sabtang', 1),
(225, 4, 16, 'Uyugan', 1),
(226, 4, 17, 'Tuguegarao City', 3),
(227, 4, 17, 'Abulug', 2),
(228, 4, 17, 'Alcala', 1),
(229, 4, 17, 'Allacapan', 2),
(230, 4, 17, 'Amulung', 3),
(231, 4, 17, 'Aparri', 1),
(232, 4, 17, 'Baggao', 1),
(233, 4, 17, 'Ballesteros', 2),
(234, 4, 17, 'Buguey', 1),
(235, 4, 17, 'Calayan', 2),
(236, 4, 17, 'Camalaniugan', 1),
(237, 4, 17, 'Claveria', 2),
(238, 4, 17, 'Enrile', 3),
(239, 4, 17, 'Gattaran', 1),
(240, 4, 17, 'Gonzaga', 1),
(241, 4, 17, 'Iguig', 3),
(242, 4, 17, 'Lal-Lo', 1),
(243, 4, 17, 'Lasam', 2),
(244, 4, 17, 'Pamplona', 2),
(245, 4, 17, 'Peñablanca', 3),
(246, 4, 17, 'Piat', 2),
(247, 4, 17, 'Rizal', 2),
(248, 4, 17, 'Sanchez-Mira', 2),
(249, 4, 17, 'Santa Ana', 1),
(250, 4, 17, 'Santa Praxedes', 2),
(251, 4, 17, 'Santa Teresita', 1),
(252, 4, 17, 'Santo Niño (Faire)', 2),
(253, 4, 17, 'Solana', 3),
(254, 4, 17, 'Tuao', 3),
(255, 4, 18, 'Cauayan City', 3),
(256, 4, 18, 'Ilagan City', 1),
(257, 4, 18, 'Alicia', 3),
(258, 4, 18, 'Angadanan', 3),
(259, 4, 18, 'Aurora', 2),
(260, 4, 18, 'Benito Soliven', 2),
(261, 4, 18, 'Burgos', 2),
(262, 4, 18, 'Cabagan', 1),
(263, 4, 18, 'Cabatuan', 3),
(264, 4, 18, 'Cordon', 4),
(265, 4, 18, 'Delfin Albano', 1),
(266, 4, 18, 'Dinapigue', 4),
(267, 4, 18, 'Divilican', 1),
(268, 4, 18, 'Echague', 4),
(269, 4, 18, 'Gamu', 2),
(270, 4, 18, 'Jones', 4),
(271, 4, 18, 'Luna', 3),
(272, 4, 18, 'Maconacon', 1),
(273, 4, 18, 'Mallig', 2),
(274, 4, 18, 'Naguilian', 2),
(275, 4, 18, 'Palanan', 1),
(276, 4, 18, 'Quezon', 2),
(277, 4, 18, 'Quirino', 2),
(278, 4, 18, 'Ramon', 4),
(279, 4, 18, 'Reina Mercedes', 3),
(280, 4, 18, 'Roxas', 2),
(281, 4, 18, 'San Agustin', 4),
(282, 4, 18, 'San Guillermo', 3),
(283, 4, 18, 'San Isidro', 4),
(284, 4, 18, 'San Manuel', 2),
(285, 4, 18, 'San Mariano', 2),
(286, 4, 18, 'San Mateo', 3),
(287, 4, 18, 'San Pablo', 1),
(288, 4, 18, 'Santa Maria', 1),
(289, 4, 18, 'Santo Tomas', 1),
(290, 4, 18, 'Tumauini', 1),
(291, 4, 19, 'Santiago City', 4),
(292, 4, 20, 'Alfonso Castañeda', 1),
(293, 4, 20, 'Ambaguio', 1),
(294, 4, 20, 'Aritao', 1),
(295, 4, 20, 'Bagabag', 1),
(296, 4, 20, 'Bambang', 1),
(297, 4, 20, 'Bayombong', 1),
(298, 4, 20, 'Diadi', 1),
(299, 4, 20, 'Dupax del Norte', 1),
(300, 4, 20, 'Dupax del Sur', 1),
(301, 4, 20, 'Kasibu', 1),
(302, 4, 20, 'Kayapa', 1),
(303, 4, 20, 'Quezon', 1),
(304, 4, 20, 'Santa Fe', 1),
(305, 4, 20, 'Solano', 1),
(306, 4, 20, 'Villaverde', 1),
(307, 5, 21, 'Aglipay', 1),
(308, 5, 21, 'Cabarroguis (capital)', 1),
(309, 5, 21, 'Diffun', 1),
(310, 5, 21, 'Maddela', 1),
(311, 5, 21, 'Nagtipunan', 1),
(312, 5, 22, 'Saguday', 1),
(313, 5, 22, 'Baler', 1),
(314, 5, 22, 'Casiguran', 1),
(315, 5, 22, 'Dilasag', 1),
(316, 5, 22, 'Dinalungan', 1),
(317, 5, 22, 'Dingalan', 1),
(318, 5, 22, 'Dipaculao', 1),
(319, 5, 22, 'Maria Aurora', 1),
(320, 5, 22, 'San Luis', 1),
(321, 5, 23, 'Balanga City', 2),
(322, 5, 23, 'Abucay', 1),
(323, 5, 23, 'Bagac', 2),
(324, 5, 23, 'Dinalupihan', 1),
(325, 5, 23, 'Hermosa', 1),
(326, 5, 23, 'Limay', 2),
(327, 5, 23, 'Mariveles', 2),
(328, 5, 23, 'Morong', 1),
(329, 5, 23, 'Orani', 1),
(330, 5, 23, 'Orion', 2),
(331, 5, 23, 'Pilar', 2),
(332, 5, 23, 'Samal', 1),
(333, 5, 24, 'Angat', 3),
(334, 5, 24, 'Balagtas (Bigaa)', 2),
(335, 5, 24, 'Baliuag', 2),
(336, 5, 24, 'Bocaue', 2),
(337, 5, 24, 'Bulakan', 1),
(338, 5, 24, 'Bustos', 2),
(339, 5, 24, 'Calumpit', 1),
(340, 5, 24, 'Doña Remedios Trinidad', 3),
(341, 5, 24, 'Guiguinto', 2),
(342, 5, 24, 'Hagonoy', 1),
(343, 5, 24, 'Malolos City', 1),
(344, 5, 24, 'Marilao', 4),
(345, 5, 24, 'Meycauayan City', 4),
(346, 5, 24, 'Norzagaray', 3),
(347, 5, 24, 'Obando', 4),
(348, 5, 24, 'Pandi', 2),
(349, 5, 24, 'Paombong', 1),
(350, 5, 24, 'Plaridel', 2),
(351, 5, 24, 'Pulilan', 1),
(352, 5, 24, 'San Ildefonso', 3),
(353, 5, 24, 'San Jose del Monte', 1),
(354, 5, 24, 'San Miguel', 3),
(355, 5, 24, 'San Rafael', 3),
(356, 5, 24, 'Santa Maria', 4),
(357, 5, 25, 'Cabanatuan City', 3),
(358, 5, 25, 'Gapan City', 4),
(359, 5, 25, 'Palayan City', 3),
(360, 5, 25, 'San Jose City', 2),
(361, 5, 25, 'Muñoz City', 2),
(362, 5, 25, 'Aliaga', 1),
(363, 5, 25, 'Bongabon', 3),
(364, 5, 25, 'Cabiao', 4),
(365, 5, 25, 'Carranglan', 2),
(366, 5, 25, 'Cuyapo', 1),
(367, 5, 25, 'Gabaldon', 3),
(368, 5, 25, 'Gen. Mamerto Natividad', 3),
(369, 5, 25, 'Guimba', 1),
(370, 5, 25, 'General Tinio', 4),
(371, 5, 25, 'Jaén', 4),
(372, 5, 25, 'Laur', 3),
(373, 5, 25, 'Licab', 1),
(374, 5, 25, 'Llanera', 2),
(375, 5, 25, 'Lupao', 2),
(376, 5, 25, 'Nampicuan', 1),
(377, 5, 25, 'Pantabangan', 2),
(378, 5, 25, 'Peñaranda', 4),
(379, 5, 25, 'Quezon', 1),
(380, 5, 25, 'Rizal', 2),
(381, 5, 25, 'San Antonio', 4),
(382, 5, 25, 'San Isidro', 4),
(383, 5, 25, 'San Leonardo', 4),
(384, 5, 25, 'Santa Rosa', 3),
(385, 5, 25, 'Santo Domingo', 1),
(386, 5, 25, 'Talavera', 1),
(387, 5, 25, 'Talugtug', 2),
(388, 5, 25, 'Zaragoza', 1),
(389, 5, 26, 'Angeles City', 1),
(390, 5, 27, 'San Fernando City', 3),
(391, 5, 27, 'Mabalacat City', 1),
(392, 5, 27, 'Apalit', 4),
(393, 5, 27, 'Arayat', 3),
(394, 5, 27, 'Bacolor', 3),
(395, 5, 27, 'Candaba', 4),
(396, 5, 27, 'Floridablanca', 2),
(397, 5, 27, 'Guagua', 2),
(398, 5, 27, 'Lubao', 2),
(399, 5, 27, 'Macabebe', 4),
(400, 5, 27, 'Magalang', 1),
(401, 5, 27, 'Masantol', 4),
(402, 5, 27, 'Mexico', 3),
(403, 5, 27, 'Minalin', 4),
(404, 5, 27, 'Porac', 2),
(405, 5, 27, 'San Luis', 4),
(406, 5, 27, 'San Simon', 4),
(407, 5, 27, 'Santa Ana', 3),
(408, 5, 27, 'Santa Rita', 2),
(409, 5, 27, 'Santo Tomas', 4),
(410, 5, 27, 'Sasmuan', 2),
(411, 5, 28, 'Tarlac City', 2),
(412, 5, 28, 'Concepcion', 3),
(413, 5, 28, 'Capas', 3),
(414, 5, 28, 'Paniqui', 1),
(415, 5, 28, 'Gerona', 2),
(416, 5, 28, 'Camiling', 1),
(417, 5, 28, 'Bamban', 3),
(418, 5, 28, 'La Paz', 3),
(419, 5, 28, 'Victoria', 2),
(420, 5, 28, 'Moncada', 1),
(421, 5, 28, 'Santa Ignacia', 1),
(422, 5, 28, 'San Jose', 2),
(423, 5, 28, 'Mayantoc', 1),
(424, 5, 28, 'San Manuel', 1),
(425, 5, 28, 'Pura', 1),
(426, 5, 28, 'Ramos', 1),
(427, 5, 28, 'San Clemente', 1),
(428, 5, 28, 'Anao', 1),
(429, 5, 29, 'Olongapo City', 1),
(430, 5, 30, 'Subic', 1),
(431, 5, 30, 'Castillejos', 1),
(432, 5, 30, 'San Marcelino', 1),
(433, 5, 30, 'San Antonio', 2),
(434, 5, 30, 'San Narciso', 2),
(435, 5, 30, 'San Felipe', 2),
(436, 5, 30, 'Cabangan', 2),
(437, 5, 30, 'Botolan', 2),
(438, 5, 30, 'Iba', 2),
(439, 5, 30, 'Palauig', 2),
(440, 5, 30, 'Masinloc', 2),
(441, 5, 30, 'Candelaria', 2),
(442, 5, 30, 'Santa Cruz', 2),
(443, 6, 31, 'Batangas City', 2),
(444, 6, 31, 'Lipa City', 4),
(445, 6, 31, 'Tanauan City', 3),
(446, 6, 31, 'Agoncillo', 3),
(447, 6, 31, 'Alitagtag', 3),
(448, 6, 31, 'Balayan', 1),
(449, 6, 31, 'Balete', 3),
(450, 6, 31, 'Bauan', 2),
(451, 6, 31, 'Calaca', 1),
(452, 6, 31, 'Calatagan', 1),
(453, 6, 31, 'Cuenca', 3),
(454, 6, 31, 'Ibaan', 4),
(455, 6, 31, 'Laurel', 3),
(456, 6, 31, 'Lemery', 1),
(457, 6, 31, 'Lian', 1),
(458, 6, 31, 'Lobo', 2),
(459, 6, 31, 'Mabini', 2),
(460, 6, 31, 'Malvar', 3),
(461, 6, 31, 'Mataasnakahoy', 3),
(462, 6, 31, 'Nasugbu', 1),
(463, 6, 31, 'Padre Garcia', 4),
(464, 6, 31, 'Rosario', 4),
(465, 6, 31, 'San Jose', 4),
(466, 6, 31, 'San Juan', 4),
(467, 6, 31, 'San Luis', 2),
(468, 6, 31, 'San Nicolas', 3),
(469, 6, 31, 'San Pascual', 2),
(470, 6, 31, 'Santa Teresita', 3),
(471, 6, 31, 'Santo Tomas', 3),
(472, 6, 31, 'Taal', 1),
(473, 6, 31, 'Talisay', 3),
(474, 6, 31, 'Taysan', 4),
(475, 6, 31, 'Tingloy', 2),
(476, 6, 31, 'Tuy', 1),
(477, 6, 32, 'Bacoor', 2),
(478, 6, 32, 'Cavite City', 1),
(479, 6, 32, 'Dasmariñas', 4),
(480, 6, 32, 'Imus', 3),
(481, 6, 32, 'Tagaytay', 5),
(482, 6, 32, 'Trece Martires', 6),
(483, 6, 32, 'Alfonso', 7),
(484, 6, 32, 'Amadeo', 6),
(485, 6, 32, 'Carmona', 5),
(486, 6, 32, 'General Emilio Aguinaldo', 7),
(487, 6, 32, 'General Mariano Alvarez', 5),
(488, 6, 32, 'General Trias', 6),
(489, 6, 32, 'Indang', 7),
(490, 6, 32, 'Kawit', 1),
(491, 6, 32, 'Magallanes', 7),
(492, 6, 32, 'Maragondon', 7),
(493, 6, 32, 'Mendez', 7),
(494, 6, 32, 'Naic', 6),
(495, 6, 32, 'Noveleta', 1),
(496, 6, 32, 'Rosario', 1),
(497, 6, 32, 'Silang', 5),
(498, 6, 32, 'Tanza', 6),
(499, 6, 32, 'Ternate', 7),
(500, 6, 33, 'Biñan', 1),
(501, 6, 33, 'Cabuyao', 2),
(502, 6, 33, 'Calamba', 2),
(503, 6, 33, 'San Pablo', 3),
(504, 6, 33, 'San Pedro', 1),
(505, 6, 33, 'Santa Rosa', 1),
(506, 6, 33, 'Alaminos', 3),
(507, 6, 33, 'Bay', 2),
(508, 6, 33, 'Calauan', 3),
(509, 6, 33, 'Cavinti', 4),
(510, 6, 33, 'Famy', 4),
(511, 6, 33, 'Kalayaan', 4),
(512, 6, 33, 'Liliw', 3),
(513, 6, 33, 'Los Baños 1', 2),
(514, 6, 33, 'Luisiana', 4),
(515, 6, 33, 'Lumban', 4),
(516, 6, 33, 'Mabitac', 4),
(517, 6, 33, 'Magdalena', 4),
(518, 6, 33, 'Majayjay', 4),
(519, 6, 33, 'Nagcarlan', 3),
(520, 6, 33, 'Paete', 4),
(521, 6, 33, 'Pagsanjan', 4),
(522, 6, 33, 'Pakil', 4),
(523, 6, 33, 'Pangil', 4),
(524, 6, 33, 'Pila', 4),
(525, 6, 33, 'Rizal', 3),
(526, 6, 33, 'Santa Cruz', 4),
(527, 6, 33, 'Santa Maria', 4),
(528, 6, 33, 'Siniloan', 4),
(529, 6, 33, 'Victoria', 3),
(530, 6, 34, 'Burdeos', 1),
(531, 6, 34, 'General Nakar', 1),
(532, 6, 34, 'Infanta', 1),
(533, 6, 34, 'Jomalig', 1),
(534, 6, 34, 'Lucban', 1),
(535, 6, 34, 'Mauban', 1),
(536, 6, 34, 'Pagbilao', 1),
(537, 6, 34, 'Panukulan', 1),
(538, 6, 34, 'Patnanungan', 1),
(539, 6, 34, 'Polillo', 1),
(540, 6, 34, 'Real', 1),
(541, 6, 34, 'Sampaloc', 1),
(542, 6, 34, 'Tayabas City', 1),
(543, 6, 34, 'Candelaria', 2),
(544, 6, 34, 'Dolores', 2),
(545, 6, 34, 'San Antonio', 2),
(546, 6, 34, 'Sariaya', 2),
(547, 6, 34, 'Tiaong', 2),
(548, 6, 34, 'Agdangan', 3),
(549, 6, 34, 'Buenavista', 3),
(550, 6, 34, 'Catanauan', 3),
(551, 6, 34, 'General Luna', 3),
(552, 6, 34, 'Macalelon', 3),
(553, 6, 34, 'Mulanay', 3),
(554, 6, 34, 'Padre Burgos', 3),
(555, 6, 34, 'Pitogo', 3),
(556, 6, 34, 'San Andres', 3),
(557, 6, 34, 'San Francisco', 3),
(558, 6, 34, 'San Narciso', 3),
(559, 6, 34, 'Unisan', 3),
(560, 6, 34, 'Alabat', 4),
(561, 6, 34, 'Atimonan', 4),
(562, 6, 34, 'Calauag', 4),
(563, 6, 34, 'Guinayangan', 4),
(564, 6, 34, 'Gumaca', 4),
(565, 6, 34, 'Lopez', 4),
(566, 6, 34, 'Perez', 4),
(567, 6, 34, 'Plaridel', 4),
(568, 6, 34, 'Quezon', 4),
(569, 6, 34, 'Tagkawayan', 4),
(570, 6, 35, 'Lucena City', 2),
(571, 6, 36, 'Angono', 1),
(572, 6, 36, 'Antipolo City', 1),
(573, 6, 36, 'Baras', 2),
(574, 6, 36, 'Binangonan', 1),
(575, 6, 36, 'Cainta', 1),
(576, 6, 36, 'Cardona', 2),
(577, 6, 36, 'Jalajala', 2),
(578, 6, 36, 'Morong', 2),
(579, 6, 36, 'Pililla', 2),
(580, 6, 36, 'Rodriguez (Montalban)', 2),
(581, 6, 36, 'San Mateo', 2),
(582, 6, 36, 'Tanay', 2),
(583, 6, 36, 'Taytay', 1),
(584, 6, 36, 'Teresa', 2),
(585, 7, 37, 'Boac', 1),
(586, 7, 37, 'Buenavista', 1),
(587, 7, 37, 'Gasan', 1),
(588, 7, 37, 'Mogpog', 1),
(589, 7, 37, 'Santa Cruz', 1),
(590, 7, 37, 'Torrijos', 1),
(591, 7, 38, 'Abra de Ilog', 1),
(592, 7, 38, 'Calintaan', 1),
(593, 7, 38, 'Looc', 1),
(594, 7, 38, 'Lubang', 1),
(595, 7, 38, 'Magsaysay', 1),
(596, 7, 38, 'Mamburao', 1),
(597, 7, 38, 'Paluan', 1),
(598, 7, 38, 'Rizal', 1),
(599, 7, 38, 'Sablayan', 1),
(600, 7, 38, 'San Jose', 1),
(601, 7, 38, 'Santa Cruz', 1),
(602, 7, 39, 'Calapan City', 1),
(603, 7, 39, 'Baco', 1),
(604, 7, 39, 'Bansud', 2),
(605, 7, 39, 'Bongabong', 2),
(606, 7, 39, 'Bulalacao', 2),
(607, 7, 39, 'Gloria', 2),
(608, 7, 39, 'Mansalay', 2),
(609, 7, 39, 'Naujan', 1),
(610, 7, 39, 'Pinamalayan', 2),
(611, 7, 39, 'Pola', 1),
(612, 7, 39, 'Puerto Galera', 1),
(613, 7, 39, 'Roxas', 2),
(614, 7, 39, 'San Teodoro', 1),
(615, 7, 39, 'Socorro', 1),
(616, 7, 39, 'Victoria', 1),
(617, 7, 40, 'Aborlan', 2),
(618, 7, 40, 'Agutaya', 1),
(619, 7, 40, 'Araceli', 1),
(620, 7, 40, 'Balabac', 2),
(621, 7, 40, 'Bataraza', 2),
(622, 7, 40, 'Brooke''s Point', 2),
(623, 7, 40, 'Busuanga', 1),
(624, 7, 40, 'Cagayancillo', 1),
(625, 7, 40, 'Coron', 1),
(626, 7, 40, 'Culion', 1),
(627, 7, 40, 'Cuyo', 1),
(628, 7, 40, 'Dumaran', 1),
(629, 7, 40, 'El Nido', 1),
(630, 7, 40, 'Kalayaan', 1),
(631, 7, 40, 'Linapacan', 1),
(632, 7, 40, 'Magsaysay', 1),
(633, 7, 40, 'Narra', 1),
(634, 7, 40, 'Quezon', 2),
(635, 7, 40, 'Rizal', 2),
(636, 7, 40, 'Roxas', 1),
(637, 7, 40, 'San Vicente', 1),
(638, 7, 40, 'Sofronio Española', 2),
(639, 7, 40, 'Taytay', 1),
(640, 7, 41, 'Puerto Princesa', 3),
(641, 7, 42, 'Alcantara', 1),
(642, 7, 42, 'Banton', 1),
(643, 7, 42, 'Cajidiocan', 1),
(644, 7, 42, 'Calatrava', 1),
(645, 7, 42, 'Concepcion', 1),
(646, 7, 42, 'Corcuera', 1),
(647, 7, 42, 'Ferrol', 1),
(648, 7, 42, 'Looc', 1),
(649, 7, 42, 'Magdiwang', 1),
(650, 7, 42, 'Odiongan', 1),
(651, 7, 42, 'Romblon', 1),
(652, 7, 42, 'San Agustin', 1),
(653, 7, 42, 'San Andres', 1),
(654, 7, 42, 'San Fernando', 1),
(655, 7, 42, 'San Jose', 1),
(656, 7, 42, 'Santa Fe', 1),
(657, 7, 42, 'Santa Maria', 1),
(658, 8, 43, 'Bacacay', 1),
(659, 8, 43, 'Camalig', 2),
(660, 8, 43, 'Daraga', 2),
(661, 8, 43, 'Guinobatan', 3),
(662, 8, 43, 'Jovellar', 3),
(663, 8, 43, 'Legazpi City', 2),
(664, 8, 43, 'Libon', 3),
(665, 8, 43, 'Ligao City', 3),
(666, 8, 43, 'Malilipot', 1),
(667, 8, 43, 'Malinao', 1),
(668, 8, 43, 'Manito', 2),
(669, 8, 43, 'Oas', 3),
(670, 8, 43, 'Pio Duran', 3),
(671, 8, 43, 'Polangui', 3),
(672, 8, 43, 'Rapu-Rapu', 2),
(673, 8, 43, 'Santo Domingo', 1),
(674, 8, 43, 'Tabaco City', 1),
(675, 8, 43, 'Tiwi', 1),
(676, 8, 44, 'Basud', 2),
(677, 8, 44, 'Capalonga', 1),
(678, 8, 44, 'Daet', 2),
(679, 8, 44, 'Jose Panganiban', 1),
(680, 8, 44, 'Labo', 1),
(681, 8, 44, 'Mercedes', 2),
(682, 8, 44, 'Paracale', 1),
(683, 8, 44, 'San Lorenzo Ruiz', 2),
(684, 8, 44, 'San Vicente', 2),
(685, 8, 44, 'Santa Elena', 1),
(686, 8, 44, 'Talisay', 2),
(687, 8, 44, 'Vinzons', 2),
(688, 8, 45, 'Baao', 5),
(689, 8, 45, 'Balatan', 5),
(690, 8, 45, 'Bato', 4),
(691, 8, 45, 'Bombon', 2),
(692, 8, 45, 'Buhi', 4),
(693, 8, 45, 'Bula', 5),
(694, 8, 45, 'Cabusao', 1),
(695, 8, 45, 'Calabanga', 3),
(696, 8, 45, 'Camaligan', 3),
(697, 8, 45, 'Canaman', 2),
(698, 8, 45, 'Caramoan', 3),
(699, 8, 45, 'Del Gallego', 1),
(700, 8, 45, 'Gainza', 2),
(701, 8, 45, 'Garchitorena', 3),
(702, 8, 45, 'Goa', 4),
(703, 8, 45, 'Iriga City', 4),
(704, 8, 45, 'Lagonoy', 3),
(705, 8, 45, 'Libmanan', 2),
(706, 8, 45, 'Lupi', 1),
(707, 8, 45, 'Magarao', 2),
(708, 8, 45, 'Milaor', 2),
(709, 8, 45, 'Minalabac', 2),
(710, 8, 45, 'Nabua', 4),
(711, 8, 45, 'Ocampo', 3),
(712, 8, 45, 'Pamplona', 2),
(713, 8, 45, 'Pasacao', 2),
(714, 8, 45, 'Pili', 3),
(715, 8, 45, 'Presentacion', 3),
(716, 8, 45, 'Ragay', 1),
(717, 8, 45, 'Sagñay', 3),
(718, 8, 45, 'San Fernando', 1),
(719, 8, 45, 'San Jose', 4),
(720, 8, 45, 'Sipocot', 1),
(721, 8, 45, 'Siruma', 3),
(722, 8, 45, 'Tigaon', 3),
(723, 8, 45, 'Tinambac', 3),
(724, 8, 46, 'Naga City', 3),
(725, 8, 47, 'Bagamanoc', 1),
(726, 8, 47, 'Baras', 1),
(727, 8, 47, 'Bato', 1),
(728, 8, 47, 'Caramoran', 1),
(729, 8, 47, 'Gigmoto', 1),
(730, 8, 47, 'Pandan', 1),
(731, 8, 47, 'Panganiban ', 1),
(732, 8, 47, 'San Andres ', 1),
(733, 8, 47, 'San Miguel', 1),
(734, 8, 47, 'Viga', 1),
(735, 8, 47, 'Virac', 1),
(736, 8, 48, 'Aroroy', 2),
(737, 8, 48, 'Baleno', 2),
(738, 8, 48, 'Balud', 2),
(739, 8, 48, 'Batuan', 1),
(740, 8, 48, 'Cataingan', 3),
(741, 8, 48, 'Cawayan', 3),
(742, 8, 48, 'Claveria', 1),
(743, 8, 48, 'Dimasalang', 3),
(744, 8, 48, 'Esperanza', 3),
(745, 8, 48, 'Mandaon', 2),
(746, 8, 48, 'Masbate City', 2),
(747, 8, 48, 'Milagros', 2),
(748, 8, 48, 'Mobo', 2),
(749, 8, 48, 'Monreal', 1),
(750, 8, 48, 'Palanas', 3),
(751, 8, 48, 'Pio V. Corpuz', 3),
(752, 8, 48, 'Placer', 3),
(753, 8, 48, 'San Fernando', 1),
(754, 8, 48, 'San Jacinto', 1),
(755, 8, 48, 'San Pascual', 1),
(756, 8, 48, 'Uson', 3),
(757, 8, 49, 'Barcelona', 2),
(758, 8, 49, 'Bulan', 2),
(759, 8, 49, 'Bulusan', 2),
(760, 8, 49, 'Casiguran', 1),
(761, 8, 49, 'Castilla', 1),
(762, 8, 49, 'Donsol', 1),
(763, 8, 49, 'Gubat', 2),
(764, 8, 49, 'Irosin', 2),
(765, 8, 49, 'Juban', 2),
(766, 8, 49, 'Magallanes', 1),
(767, 8, 49, 'Matnog', 2),
(768, 8, 49, 'Pilar', 1),
(769, 8, 49, 'Prieto Diaz', 2),
(770, 8, 49, 'Santa Magdalena', 2),
(771, 8, 49, 'Sorsogon City', 1),
(772, 9, 50, 'Altavas', 1),
(773, 9, 50, 'Balete', 1),
(774, 9, 50, 'Banga', 1),
(775, 9, 50, 'Batan', 1),
(776, 9, 50, 'Buruanga', 1),
(777, 9, 50, 'Ibajay', 1),
(778, 9, 50, 'Kalibo', 1),
(779, 9, 50, 'Lezo', 1),
(780, 9, 50, 'Libacao', 1),
(781, 9, 50, 'Madalag', 1),
(782, 9, 50, 'Makato', 1),
(783, 9, 50, 'Malay', 1),
(784, 9, 50, 'Malinao', 1),
(785, 9, 50, 'Nabas', 1),
(786, 9, 50, 'New Washington', 1),
(787, 9, 50, 'Numancia', 1),
(788, 9, 50, 'Tangalan', 1),
(789, 9, 51, 'Anini-y', 1),
(790, 9, 51, 'Barbaza', 1),
(791, 9, 51, 'Belison', 1),
(792, 9, 51, 'Bugasong', 1),
(793, 9, 51, 'Caluya', 1),
(794, 9, 51, 'Culasi', 1),
(795, 9, 51, 'Hamtic', 1),
(796, 9, 51, 'Laua-an', 1),
(797, 9, 51, 'Libertad', 1),
(798, 9, 51, 'Pandan', 1),
(799, 9, 51, 'Patnongon', 1),
(800, 9, 51, 'San Jose de Buenavista', 1),
(801, 9, 51, 'San Remigio', 1),
(802, 9, 51, 'Sebaste', 1),
(803, 9, 51, 'Sibalom', 1),
(804, 9, 51, 'Tibiao', 1),
(805, 9, 51, 'Tobias Fornier', 1),
(806, 9, 51, 'Valderrama', 1),
(807, 9, 52, 'Roxas City', 1),
(808, 9, 52, 'Cuartero', 2),
(809, 9, 52, 'Dao', 2),
(810, 9, 52, 'Dumalag', 2),
(811, 9, 52, 'Dumarao', 2),
(812, 9, 52, 'Ivisan', 2),
(813, 9, 52, 'Jamindan', 2),
(814, 9, 52, 'Maayon', 1),
(815, 9, 52, 'Mambusao', 2),
(816, 9, 52, 'Panay', 1),
(817, 9, 52, 'Panitan', 1),
(818, 9, 52, 'Pilar', 1),
(819, 9, 52, 'Pontevedra', 1),
(820, 9, 52, 'President Roxas', 1),
(821, 9, 52, 'Sapian', 2),
(822, 9, 52, 'Sigma', 2),
(823, 9, 52, 'Tapaz', 2),
(824, 9, 53, 'Buenavista', 1),
(825, 9, 53, 'Jordan', 1),
(826, 9, 53, 'Nueva Valencia', 1),
(827, 9, 53, 'San Lorenzo', 1),
(828, 9, 53, 'Sibunag', 1),
(829, 9, 54, 'Passi City', 4),
(830, 9, 54, 'Ajuy', 5),
(831, 9, 54, 'Alimodian', 2),
(832, 9, 54, 'Anilao', 4),
(833, 9, 54, 'Badiangan', 3),
(834, 9, 54, 'Balasan', 5),
(835, 9, 54, 'Banate', 4),
(836, 9, 54, 'Barotac Nuevo', 4),
(837, 9, 54, 'Barotac Viejo', 5),
(838, 9, 54, 'Batad', 5),
(839, 9, 54, 'Bingawan', 3),
(840, 9, 54, 'Cabatuan', 3),
(841, 9, 54, 'Calinog', 3),
(842, 9, 54, 'Carles', 5),
(843, 9, 54, 'Concepcion', 5),
(844, 9, 54, 'Dingle', 4),
(845, 9, 54, 'Dueñas', 4),
(846, 9, 54, 'Dumangas', 4),
(847, 9, 54, 'Estancia', 5),
(848, 9, 54, 'Guimbal', 1),
(849, 9, 54, 'Igbaras', 1),
(850, 9, 54, 'Janiuay', 3),
(851, 9, 54, 'Lambunao', 3),
(852, 9, 54, 'Leganes', 2),
(853, 9, 54, 'Lemery', 5),
(854, 9, 54, 'Leon', 2),
(855, 9, 54, 'Maasin', 3),
(856, 9, 54, 'Miagao', 1),
(857, 9, 54, 'Mina', 3),
(858, 9, 54, 'New Lucena', 2),
(859, 9, 54, 'Oton', 1),
(860, 9, 54, 'Pavia', 2),
(861, 9, 54, 'Pototan', 3),
(862, 9, 54, 'San Dionisio', 5),
(863, 9, 54, 'San Enrique', 4),
(864, 9, 54, 'San Joaquin', 1),
(865, 9, 54, 'San Miguel', 2),
(866, 9, 54, 'San Rafael', 5),
(867, 9, 54, 'Santa Barbara', 2),
(868, 9, 54, 'Sara', 5),
(869, 9, 54, 'Tigbauan', 1),
(870, 9, 54, 'Tubungan', 1),
(871, 9, 54, 'Zarraga', 2),
(872, 9, 55, 'Iloilo City', 1),
(873, 9, 56, 'Bago', 4),
(874, 9, 56, 'Cadiz', 2),
(875, 9, 56, 'Escalante', 1),
(876, 9, 56, 'Himamaylan', 5),
(877, 9, 56, 'Kabankalan', 6),
(878, 9, 56, 'La Carlota', 4),
(879, 9, 56, 'Sagay', 2),
(880, 9, 56, 'San Carlos', 1),
(881, 9, 56, 'Silay', 3),
(882, 9, 56, 'Sipalay', 6),
(883, 9, 56, 'Talisay', 3),
(884, 9, 56, 'Victorias', 3),
(885, 9, 56, 'Binalbagan', 5),
(886, 9, 56, 'Calatrava', 1),
(887, 9, 56, 'Candoni', 6),
(888, 9, 56, 'Cauayan', 6),
(889, 9, 56, 'Enrique B. Magalona', 3),
(890, 9, 56, 'Hinigaran', 5),
(891, 9, 56, 'Hinoba-an', 6),
(892, 9, 56, 'Ilog', 6),
(893, 9, 56, 'Isabela', 5),
(894, 9, 56, 'La Castellana', 5),
(895, 9, 56, 'Manapla', 2),
(896, 9, 56, 'Moises Padilla', 5),
(897, 9, 56, 'Murcia', 3),
(898, 9, 56, 'Pontevedra', 4),
(899, 9, 56, 'Pulupandan', 4),
(900, 9, 56, 'Salvador Benedicto', 1),
(901, 9, 56, 'San Enrique', 4),
(902, 9, 56, 'Toboso', 1),
(903, 9, 56, 'Valladolid', 4),
(904, 9, 57, 'Bacolod', 1),
(905, 10, 58, 'Tagbilaran City', 1),
(906, 10, 58, 'Alburquerque', 1),
(907, 10, 58, 'Antequera', 1),
(908, 10, 58, ' Baclayon', 1),
(909, 10, 58, ' Balilihan', 1),
(910, 10, 58, 'Calape', 1),
(911, 10, 58, ' Catigbian', 1),
(912, 10, 58, ' Corella', 1),
(913, 10, 58, 'Cortes', 1),
(914, 10, 58, 'Dauis', 1),
(915, 10, 58, ' Loon', 1),
(916, 10, 58, 'Maribojoc', 1),
(917, 10, 58, 'Panglao', 1),
(918, 10, 58, 'Sikatuna', 1),
(919, 10, 58, 'Tubigon', 1),
(920, 10, 58, 'Bien Unido', 2),
(921, 10, 58, ' Buenavista', 2),
(922, 10, 58, ' Clarin', 2),
(923, 10, 58, ' Dagohoy', 2),
(924, 10, 58, 'Danao', 2),
(925, 10, 58, ' Getafe', 2),
(926, 10, 58, 'Inabanga', 2),
(927, 10, 58, ' Pres. Carlos P. Garcia', 2),
(928, 10, 58, ' Sagbayan', 2),
(929, 10, 58, ' San Isidro', 2),
(930, 10, 58, 'San Miguel', 2),
(931, 10, 58, ' Talibon', 2),
(932, 10, 58, ' Trinidad', 2),
(933, 10, 58, 'Ubay', 2),
(934, 10, 58, 'Alicia', 3),
(935, 10, 58, ' Anda', 3),
(936, 10, 58, 'Batuan', 3),
(937, 10, 58, 'Bilar', 3),
(938, 10, 58, 'Candijay', 3),
(939, 10, 58, ' Carmen', 3),
(940, 10, 58, 'Dimiao', 3),
(941, 10, 58, ' Duero', 3),
(942, 10, 58, ' Garcia Hernandez', 3),
(943, 10, 58, ' Guindulman', 3),
(944, 10, 58, ' Jagna', 3),
(945, 10, 58, 'Lila', 3),
(946, 10, 58, ' Loay', 3),
(947, 10, 58, 'Loboc', 3),
(948, 10, 58, 'Mabini, Pilar', 3),
(949, 10, 58, 'Sevilla', 3),
(950, 10, 58, ' Sierra Bullones', 3),
(951, 10, 58, 'Valencia', 3),
(952, 10, 59, 'Danao City', 5),
(953, 10, 59, 'Talisay City', 1),
(954, 10, 59, 'Toledo City', 3),
(955, 10, 59, 'Bogo City', 4),
(956, 10, 59, 'Carcar City', 1),
(957, 10, 59, 'Naga City', 1),
(958, 10, 59, 'Alcantara', 2),
(959, 10, 59, 'Alcoy', 2),
(960, 10, 59, 'Alegria', 2),
(961, 10, 59, 'Aloguinsan', 3),
(962, 10, 59, 'Argao', 2),
(963, 10, 59, 'Asturias', 3),
(964, 10, 59, 'Badian', 2),
(965, 10, 59, 'Balamban', 3),
(966, 10, 59, 'Bantayan', 4),
(967, 10, 59, 'Barili', 3),
(968, 10, 59, 'Boljoon', 2),
(969, 10, 59, 'Borbon', 5),
(970, 10, 59, 'Carmen', 5),
(971, 10, 59, 'Catmon', 5),
(972, 10, 59, 'Compostela', 5),
(973, 10, 59, 'Consolacion', 6),
(974, 10, 59, 'Cordova', 6),
(975, 10, 59, 'Daanbantayan', 4),
(976, 10, 59, 'Dalaguete', 2),
(977, 10, 59, 'Dumanjug', 2),
(978, 10, 59, 'Ginatilan', 2),
(979, 10, 59, 'Liloan', 5),
(980, 10, 59, 'Madridejos', 4),
(981, 10, 59, 'Malabuyoc', 2),
(982, 10, 59, 'Medellin', 4),
(983, 10, 59, 'Minglanilla', 1),
(984, 10, 59, 'Moalboal', 2),
(985, 10, 59, 'Oslob', 2),
(986, 10, 59, 'Pilar', 5),
(987, 10, 59, 'Pinamungajan', 3),
(988, 10, 59, 'Poro', 5),
(989, 10, 59, 'Ronda', 2),
(990, 10, 59, 'Samboan', 2),
(991, 10, 59, 'San Fernando', 1),
(992, 10, 59, 'San Francisco', 5),
(993, 10, 59, 'San Remigio', 4),
(994, 10, 59, 'Santa Fe', 4),
(995, 10, 59, 'Santander', 2),
(996, 10, 59, 'Sibonga', 1),
(997, 10, 59, 'Sogod', 5),
(998, 10, 59, 'Tabogon', 4),
(999, 10, 59, 'Tabuelan', 4),
(1000, 10, 59, 'Tuburan', 3),
(1001, 10, 59, 'Tudela', 5),
(1002, 10, 60, 'Lapu-Lapu City', 1),
(1003, 10, 61, 'Mandaue City', 6),
(1004, 10, 62, 'Cebu City', NULL),
(1005, 10, 63, 'Bais City', 2),
(1006, 10, 63, 'Bayawan City', 2),
(1007, 10, 63, 'Canlaon City', 1),
(1008, 10, 63, 'Dumaguete City', 2),
(1009, 10, 63, 'Guihulngan City', 1),
(1010, 10, 63, 'Tanjay City', 2),
(1011, 10, 63, 'Amlan', 2),
(1012, 10, 63, 'Ayungon', 1),
(1013, 10, 63, 'Bacong', 3),
(1014, 10, 63, 'Basay', 3),
(1015, 10, 63, 'Bindoy', 1),
(1016, 10, 63, 'Dauin', 3),
(1017, 10, 63, 'Jimalalud', 1),
(1018, 10, 63, 'La Libertad', 1),
(1019, 10, 63, 'Mabinay', 2),
(1020, 10, 63, 'Manjuyod', 1),
(1021, 10, 63, 'Pamplona', 2),
(1022, 10, 63, 'San Jose', 2),
(1023, 10, 63, 'Santa Catalina', 3),
(1024, 10, 63, 'Siaton', 3),
(1025, 10, 63, 'Sibulan', 2),
(1026, 10, 63, 'Tayasan', 1),
(1027, 10, 63, 'Valencia', 3),
(1028, 10, 63, 'Vallehermoso', 1),
(1029, 10, 63, 'Zamboanguita', 3),
(1030, 10, 64, 'Enrique Villanueva', 1),
(1031, 10, 64, 'Larena', 1),
(1032, 10, 64, 'Lazi', 1),
(1033, 10, 64, 'Maria', 1),
(1034, 10, 64, 'San Juan', 1),
(1035, 10, 64, 'Siquijor', 1),
(1036, 11, 65, 'Almeria', 1),
(1037, 11, 65, 'Biliran', 1),
(1038, 11, 65, 'Cabucgayan', 1),
(1039, 11, 65, 'Caibiran', 1),
(1040, 11, 65, 'Culaba', 1),
(1041, 11, 65, 'Kawayan', 1),
(1042, 11, 65, 'Maripipi', 1),
(1043, 11, 65, 'Naval', 1),
(1044, 11, 66, 'Borongan City', 1),
(1045, 11, 66, 'Arteche', 1),
(1046, 11, 66, 'Balangiga', 1),
(1047, 11, 66, 'Balangkayan', 1),
(1048, 11, 66, 'Can-avid', 1),
(1049, 11, 66, 'Dolores', 1),
(1050, 11, 66, 'General MacArthur', 1),
(1051, 11, 66, 'Giporlos', 1),
(1052, 11, 66, 'Guiuan', 1),
(1053, 11, 66, 'Hernani', 1),
(1054, 11, 66, 'Jipapad', 1),
(1055, 11, 66, 'Lawaan', 1),
(1056, 11, 66, 'Llorente', 1),
(1057, 11, 66, 'Maslog', 1),
(1058, 11, 66, 'Maydolong', 1),
(1059, 11, 66, 'Mercedes', 1),
(1060, 11, 66, 'Oras', 1),
(1061, 11, 66, 'Quinapondan', 1),
(1062, 11, 66, 'Salcedo', 1),
(1063, 11, 66, 'San Julian', 1),
(1064, 11, 66, 'San Policarpo', 1),
(1065, 11, 66, 'Sulat', 1),
(1066, 11, 66, 'Taft', 1),
(1067, 11, 67, 'Baybay', 5),
(1068, 11, 67, 'Abuyog', 5),
(1069, 11, 67, 'Alangalang', 1),
(1070, 11, 67, 'Albuera', 4),
(1071, 11, 67, 'Babatngon', 1),
(1072, 11, 67, 'Barugo', 2),
(1073, 11, 67, 'Bato', 5),
(1074, 11, 67, 'Burauen', 2),
(1075, 11, 67, 'Calubian', 3),
(1076, 11, 67, 'Capoocan', 2),
(1077, 11, 67, 'Carigara', 2),
(1078, 11, 67, 'Dagami', 2),
(1079, 11, 67, 'Dulag', 2),
(1080, 11, 67, 'Hilongos', 5),
(1081, 11, 67, 'Hindang', 5),
(1082, 11, 67, 'Inopacan', 5),
(1083, 11, 67, 'Isabel', 4),
(1084, 11, 67, 'Jaro', 2),
(1085, 11, 67, 'Javier', 5),
(1086, 11, 67, 'Julita', 2),
(1087, 11, 67, 'Kananga', 4),
(1088, 11, 67, 'La Paz', 2),
(1089, 11, 67, 'Leyte', 3),
(1090, 11, 67, 'MacArthur', 2),
(1091, 11, 67, 'Mahaplag', 5),
(1092, 11, 67, 'Matag-ob', 4),
(1093, 11, 67, 'Matalom', 5),
(1094, 11, 67, 'Mayorga', 2),
(1095, 11, 67, 'Merida', 4),
(1096, 11, 67, 'Palo', 1),
(1097, 11, 67, 'Palompon', 4),
(1098, 11, 67, 'Pastrana', 2),
(1099, 11, 67, 'San Isidro', 3),
(1100, 11, 67, 'San Miguel', 1),
(1101, 11, 67, 'Santa Fe', 1),
(1102, 11, 67, 'Tabango', 3),
(1103, 11, 67, 'Tabontabon', 2),
(1104, 11, 67, 'Tanauan', 1),
(1105, 11, 67, 'Tolosa', 1),
(1106, 11, 67, 'Tunga', 2),
(1107, 11, 67, 'Villaba', 3),
(1108, 11, 68, 'Ormoc', 4),
(1109, 11, 69, 'Tacloban', 1),
(1110, 11, 70, 'Allen', 1),
(1111, 11, 70, 'Biri', 1),
(1112, 11, 70, 'Bobon', 1),
(1113, 11, 70, 'Capul', 1),
(1114, 11, 70, 'Catarman', 1),
(1115, 11, 70, 'Catubig', 2),
(1116, 11, 70, 'Gamay', 2),
(1117, 11, 70, 'Laoang', 2),
(1118, 11, 70, 'Lapinig', 2),
(1119, 11, 70, 'Las Navas', 2),
(1120, 11, 70, 'Lavezares', 1),
(1121, 11, 70, 'Lope de Vega', 1),
(1122, 11, 70, 'Mapanas', 2),
(1123, 11, 70, 'Mondragon', 1),
(1124, 11, 70, 'Palapag', 2),
(1125, 11, 70, 'Pambujan', 2),
(1126, 11, 70, 'Rosario', 1),
(1127, 11, 70, 'San Antonio', 1),
(1128, 11, 70, 'San Isidro', 1),
(1129, 11, 70, 'San Jose', 1),
(1130, 11, 70, 'San Roque', 2),
(1131, 11, 70, 'San Vicente', 1),
(1132, 11, 70, 'Silvino Lobos', 2),
(1133, 11, 70, 'Victoria', 1),
(1134, 11, 71, 'Calbayog', 1),
(1135, 11, 71, 'Catbalogan', 2),
(1136, 11, 71, 'Almagro', 1),
(1137, 11, 71, 'Basey', 2),
(1138, 11, 71, 'Calbiga', 2),
(1139, 11, 71, 'Daram', 2),
(1140, 11, 71, 'Gandara', 1),
(1141, 11, 71, 'Hinabangan', 2),
(1142, 11, 71, 'Jiabong', 2),
(1143, 11, 71, 'Marabut', 2),
(1144, 11, 71, 'Matuguinao', 1),
(1145, 11, 71, 'Motiong', 2),
(1146, 11, 71, 'Pagsanghan', 1),
(1147, 11, 71, 'Paranas', 2),
(1148, 11, 71, 'Pinabacdao', 2),
(1149, 11, 71, 'San Jorge', 1),
(1150, 11, 71, 'San Jose de Buan', 2),
(1151, 11, 71, 'San Sebastian', 2),
(1152, 11, 71, 'Santa Margarita', 1),
(1153, 11, 71, 'Santa Rita', 2),
(1154, 11, 71, 'Santo Niño', 1),
(1155, 11, 71, 'Tagapul-an', 1),
(1156, 11, 71, 'Talalora', 2),
(1157, 11, 71, 'Tarangnan', 1),
(1158, 11, 71, 'Villareal', 2),
(1159, 11, 71, 'Zumarraga', 2),
(1160, 11, 72, 'Anahawan', 1),
(1161, 11, 72, 'Bontoc', 1),
(1162, 11, 72, 'Hinunangan', 1),
(1163, 11, 72, 'Hinundayan', 1),
(1164, 11, 72, 'Libagon', 1),
(1165, 11, 72, 'Liloan', 1),
(1166, 11, 72, 'Limasawa', 1),
(1167, 11, 72, 'Maasin City', 1),
(1168, 11, 72, 'Macrohon', 1),
(1169, 11, 72, 'Malitbog', 1),
(1170, 11, 72, 'Padre Burgos', 1),
(1171, 11, 72, 'Pintuyan', 1),
(1172, 11, 72, 'Saint Bernard', 1),
(1173, 11, 72, 'San Francisco', 1),
(1174, 11, 72, 'San Juan', 1),
(1175, 11, 72, 'San Ricardo', 1),
(1176, 11, 72, 'Silago', 1),
(1177, 11, 72, 'Sogod', 1),
(1178, 11, 72, 'Tomas Oppus', 1),
(1179, 12, 73, 'Zamboanga City', 1),
(1180, 12, 74, 'Dipolog City', 2),
(1181, 12, 74, 'Baliguian', 3),
(1182, 12, 74, 'Godod', 3),
(1183, 12, 74, 'Gutalac', 3),
(1184, 12, 74, 'Jose Dalman (Ponot)', 2),
(1185, 12, 74, 'Kalawit', 3),
(1186, 12, 74, 'Katipunan', 2),
(1187, 12, 74, 'La Libertad', 1),
(1188, 12, 74, 'Labason', 3),
(1189, 12, 74, 'Leon B. Postigo (Bacungan)', 3),
(1190, 12, 74, 'Liloy', 3),
(1191, 12, 74, 'Manukan', 2),
(1192, 12, 74, 'Mutia', 1),
(1193, 12, 74, 'Piñan', 1),
(1194, 12, 74, 'Polanco', 1),
(1195, 12, 74, 'Pres. Manuel A. Roxas', 2),
(1196, 12, 74, 'Rizal', 1),
(1197, 12, 74, 'Salug', 3),
(1198, 12, 74, 'Sergio Osmeña Sr.', 1),
(1199, 12, 74, 'Siayan', 2),
(1200, 12, 74, 'Sibuco', 3),
(1201, 12, 74, 'Sibutad', 1),
(1202, 12, 74, 'Sindangan', 2),
(1203, 12, 74, 'Siocon', 3),
(1204, 12, 74, 'Sirawai', 3),
(1205, 12, 74, 'Tampilisan', 3),
(1206, 12, 75, 'Pagadian City', 1),
(1207, 12, 75, 'Aurora', 1),
(1208, 12, 75, 'Bayog', 2),
(1209, 12, 75, 'Dimataling', 2),
(1210, 12, 75, 'Dinas', 2),
(1211, 12, 75, 'Dumalinao', 2),
(1212, 12, 75, 'Dumingag', 1),
(1213, 12, 75, 'Guipos', 2),
(1214, 12, 75, 'Josefina', 1),
(1215, 12, 75, 'Kumalarang', 2),
(1216, 12, 75, 'Labangan', 1),
(1217, 12, 75, 'Lakewood', 2),
(1218, 12, 75, 'Lapuyan', 2),
(1219, 12, 75, 'Mahayag', 1),
(1220, 12, 75, 'Margosatubig', 2),
(1221, 12, 75, 'Midsalip', 1),
(1222, 12, 75, 'Molave', 1),
(1223, 12, 75, 'Pitogo', 2),
(1224, 12, 75, 'Ramon Magsaysay (Liargo)', 1),
(1225, 12, 75, 'San Miguel', 2),
(1226, 12, 75, 'San Pablo', 2),
(1227, 12, 75, 'Sominot (Don Mariano Marcos)', 1),
(1228, 12, 75, 'Tabina', 2),
(1229, 12, 75, 'Tambulig', 1),
(1230, 12, 75, 'Tigbao', 2),
(1231, 12, 75, 'Tukuran', 1),
(1232, 12, 75, 'Vincenzo A. Sagun', 2),
(1233, 12, 76, 'Alicia', 1),
(1234, 12, 76, 'Buug', 1),
(1235, 12, 76, 'Diplahan', 1),
(1236, 12, 76, 'Imelda', 1),
(1237, 12, 76, 'Ipil', 2),
(1238, 12, 76, 'Kabasalan', 2),
(1239, 12, 76, 'Mabuhay', 1),
(1240, 12, 76, 'Malangas', 1),
(1241, 12, 76, 'Naga', 2),
(1242, 12, 76, 'Olutanga', 1),
(1243, 12, 76, 'Payao', 1),
(1244, 12, 76, 'Roseller T. Lim', 2),
(1245, 12, 76, 'Siay', 2),
(1246, 12, 76, 'Talusan', 1),
(1247, 12, 76, 'Titay', 2),
(1248, 12, 76, 'Tungawan', 2),
(1249, 13, 77, 'Baungon', 1),
(1250, 13, 77, 'Cabanglasan', 2),
(1251, 13, 77, 'Damulog', 3),
(1252, 13, 77, 'Dangcagan', 3),
(1253, 13, 77, 'Don Carlos', 3),
(1254, 13, 77, 'Impasugong', 2),
(1255, 13, 77, 'Kadingilan', 3),
(1256, 13, 77, 'Kalilangan', 4),
(1257, 13, 77, 'Kibawe', 3),
(1258, 13, 77, 'Kitaotao', 3),
(1259, 13, 77, 'Lantapan', 2),
(1260, 13, 77, 'Libona', 1),
(1261, 13, 77, 'Malaybalay City', 2),
(1262, 13, 77, 'Malitbog', 1),
(1263, 13, 77, 'Manolo Fortich', 1),
(1264, 13, 77, 'Maramag', 3),
(1265, 13, 77, 'Pangantucan', 4),
(1266, 13, 77, 'Quezon', 3),
(1267, 13, 77, 'San Fernando', 2),
(1268, 13, 77, 'Sumilao', 1),
(1269, 13, 77, 'Talakag', 1),
(1270, 13, 77, 'Valencia City', 2),
(1271, 13, 78, 'Catarman', 1),
(1272, 13, 78, 'Guinsiliban', 1),
(1273, 13, 78, 'Mahinog', 1),
(1274, 13, 78, 'Mambajao', 1),
(1275, 13, 78, 'Sagay', 1),
(1276, 13, 79, 'Bacolod', 1),
(1277, 13, 79, 'Baloi', 1),
(1278, 13, 79, 'Baroy', 1),
(1279, 13, 79, 'Kapatagan', 2),
(1280, 13, 79, 'Kauswagan', 1),
(1281, 13, 79, 'Kolambugan', 1),
(1282, 13, 79, 'Lala', 2),
(1283, 13, 79, 'Linamon', 1),
(1284, 13, 79, 'Magsaysay', 2),
(1285, 13, 79, 'Maigo', 1),
(1286, 13, 79, 'Matungao', 1),
(1287, 13, 79, 'Munai', 2),
(1288, 13, 79, 'Nunungan', 2),
(1289, 13, 79, 'Pantao Ragat', 2),
(1290, 13, 79, 'Pantar', 1),
(1291, 13, 79, 'Poona Piagapo', 2),
(1292, 13, 79, 'Salvador', 2),
(1293, 13, 79, 'Sapad', 2),
(1294, 13, 79, 'Sultan Naga Dimaporo ', 2),
(1295, 13, 79, 'Tagoloan', 1),
(1296, 13, 79, 'Tangcal', 2),
(1297, 13, 79, 'Tubod ', 1),
(1298, 13, 80, 'Iligan City', 1),
(1299, 13, 81, 'Oroquieta City', 1),
(1300, 13, 81, 'Ozamiz City', 2),
(1301, 13, 81, 'Tangub City', 2),
(1302, 13, 81, 'Aloran', 1),
(1303, 13, 81, 'Baliangao', 1),
(1304, 13, 81, 'Bonifacio', 2),
(1305, 13, 81, 'Calamba', 1),
(1306, 13, 81, 'Clarin', 2),
(1307, 13, 81, 'Concepcion', 1),
(1308, 13, 81, 'Don Victoriano Chiongbian', 2),
(1309, 13, 81, 'Jimenez', 1),
(1310, 13, 81, 'Lopez Jaena', 1),
(1311, 13, 81, 'Panaon', 1),
(1312, 13, 81, 'Plaridel', 1),
(1313, 13, 81, 'Sapang Dalaga', 1),
(1314, 13, 81, 'Sinacaban', 2),
(1315, 13, 81, 'Tudela', 2),
(1316, 13, 82, 'El Salvador City', 2),
(1317, 13, 82, 'Gingoog City', 1),
(1318, 13, 82, 'Alubijid', 2),
(1319, 13, 82, 'Balingasag', 1),
(1320, 13, 82, 'Balingoan', 1),
(1321, 13, 82, 'Binuangan', 1),
(1322, 13, 82, 'Claveria', 2),
(1323, 13, 82, 'Gitagum', 2),
(1324, 13, 82, 'Initao', 2),
(1325, 13, 82, 'Jasaan', 2),
(1326, 13, 82, 'Kinoguitan', 1),
(1327, 13, 82, 'Lagonglong', 1),
(1328, 13, 82, 'Laguindingan', 2),
(1329, 13, 82, 'Libertad', 2),
(1330, 13, 82, 'Lugait', 2),
(1331, 13, 82, 'Magsaysay', 1),
(1332, 13, 82, 'Manticao', 2),
(1333, 13, 82, 'Medina', 1),
(1334, 13, 82, 'Naawan', 2),
(1335, 13, 82, 'Opol', 2),
(1336, 13, 82, 'Salay', 1),
(1337, 13, 82, 'Sugbongcogon', 1),
(1338, 13, 82, 'Tagoloan', 2),
(1339, 13, 82, 'Talisayan', 1),
(1340, 13, 82, 'Villanueva', 2),
(1341, 13, 83, 'Cagayan de Oro', NULL),
(1342, 14, 84, 'Compostela', 1),
(1343, 14, 84, 'Laak', 2),
(1344, 14, 84, 'Mabini', 2),
(1345, 14, 84, 'Maco', 2),
(1346, 14, 84, 'Maragusan', 1),
(1347, 14, 84, 'Mawab', 2),
(1348, 14, 84, 'Monkayo', 1),
(1349, 14, 84, 'Montevista', 1),
(1350, 14, 84, 'Nabunturan', 2),
(1351, 14, 84, 'New Bataan', 1),
(1352, 14, 84, 'Pantukan', 2),
(1353, 14, 85, 'Asuncion', 1),
(1354, 14, 85, 'Braulio E. Dujali', 2),
(1355, 14, 85, 'Carmen', 2),
(1356, 14, 85, 'Kapalong', 1),
(1357, 14, 85, 'New Corella', 1),
(1358, 14, 85, 'Panabo City', 2),
(1359, 14, 85, 'Samal City', 2),
(1360, 14, 85, 'San Isidro', 1),
(1361, 14, 85, 'Santo Tomas', 2),
(1362, 14, 85, 'Tagum City', 1),
(1363, 14, 85, 'Talaingod', 1),
(1364, 14, 86, 'Digos City', 1),
(1365, 14, 86, 'Bansalan', 1),
(1366, 14, 86, 'Hagonoy', 1),
(1367, 14, 86, 'Kiblawan', 1),
(1368, 14, 86, 'Magsaysay', 1),
(1369, 14, 86, 'Malalag', 1),
(1370, 14, 86, 'Matanao', 1),
(1371, 14, 86, 'Padada', 1),
(1372, 14, 86, 'Santa Cruz', 1),
(1373, 14, 86, 'Sulop', 1),
(1374, 14, 87, 'Davao City', 1),
(1375, 14, 88, 'Mati City', 2),
(1376, 14, 88, 'Baganga', 1),
(1377, 14, 88, 'Banaybanay', 2),
(1378, 14, 88, 'Boston', 1),
(1379, 14, 88, 'Caraga', 1),
(1380, 14, 88, 'Cateel', 1),
(1381, 14, 88, 'Governor Generoso', 2),
(1382, 14, 88, 'Lupon', 2),
(1383, 14, 88, 'Manay', 1),
(1384, 14, 88, 'San Isidro', 2),
(1385, 14, 88, 'Tarragona', 1),
(1386, 14, 89, 'Don Marcelino', 1),
(1387, 14, 89, 'Jose Abad Santos', 1),
(1388, 14, 89, 'Malita', 1),
(1389, 14, 89, 'Santa Maria', 1),
(1390, 14, 89, 'Sarangani', 1),
(1391, 15, 90, 'Alamada', 1),
(1392, 15, 90, 'Aleosan', 1),
(1393, 15, 90, 'Antipas', 2),
(1394, 15, 90, 'Arakan', 2),
(1395, 15, 90, 'Banisilan', 3),
(1396, 15, 90, 'Carmen', 3),
(1397, 15, 90, 'Kabacan', 3),
(1398, 15, 90, 'Kidapawan City', 2),
(1399, 15, 90, 'Libungan', 1),
(1400, 15, 90, 'Magpet', 2),
(1401, 15, 90, 'Makilala', 2),
(1402, 15, 90, 'Matalam', 3),
(1403, 15, 90, 'Midsayap', 1),
(1404, 15, 90, 'M''lang', 3),
(1405, 15, 90, 'Pigcawayan', 1),
(1406, 15, 90, 'Pikit', 1),
(1407, 15, 90, 'President Roxas', 2),
(1408, 15, 90, 'Tulunan', 3),
(1409, 15, 91, 'Alabel', 1),
(1410, 15, 91, 'Glan', 1),
(1411, 15, 91, 'Kiamba', 1),
(1412, 15, 91, 'Maasim', 1),
(1413, 15, 91, 'Maitum', 1),
(1414, 15, 91, 'Malapatan', 1),
(1415, 15, 91, 'Malungon', 1),
(1416, 15, 92, 'Banga', 1),
(1417, 15, 92, 'Koronadal', 2),
(1418, 15, 92, 'Lake Sebu', 2),
(1419, 15, 92, 'Norala', 2),
(1420, 15, 92, 'Polomolok', 1),
(1421, 15, 92, 'Sto. Niño', 2),
(1422, 15, 92, 'Surallah', 2),
(1423, 15, 92, 'Tampakan', 1),
(1424, 15, 92, 'Tantangan', 2),
(1425, 15, 92, 'T''Boli', 2),
(1426, 15, 92, 'Tupi', 1),
(1427, 15, 93, 'General Santos', 1),
(1428, 15, 94, 'Tacurong', 1),
(1429, 15, 94, 'Bagumbayan', 2),
(1430, 15, 94, 'Columbio', 1),
(1431, 15, 94, 'Esperanza', 2),
(1432, 15, 94, 'Isulan', 1),
(1433, 15, 94, 'Kalamansig', 2),
(1434, 15, 94, 'Lambayong ', 1),
(1435, 15, 94, 'Lebak', 2),
(1436, 15, 94, 'Lutayan', 1),
(1437, 15, 94, 'Palimbang', 2),
(1438, 15, 94, 'President Quirino', 1),
(1439, 15, 94, 'Sen. Ninoy Aquino', 2),
(1440, 16, 95, 'Cabadbaran City', 2),
(1441, 16, 95, 'Buenavista', 2),
(1442, 16, 95, 'Carmen', 2),
(1443, 16, 95, 'Jabonga', 2),
(1444, 16, 95, 'Kitcharao', 2),
(1445, 16, 95, 'Las Nieves', 1),
(1446, 16, 95, 'Magallanes', 2),
(1447, 16, 95, 'Nasipit', 2),
(1448, 16, 95, 'Remedios T. Romualdez', 2),
(1449, 16, 95, 'Santiago', 2),
(1450, 16, 95, 'Tubay', 2),
(1451, 16, 96, 'Butuan City', 1),
(1452, 16, 97, 'Bayugan City', 1),
(1453, 16, 97, 'Bunawan', 2),
(1454, 16, 97, 'Esperanza', 1),
(1455, 16, 97, 'La Paz', 2),
(1456, 16, 97, 'Loreto', 2),
(1457, 16, 97, 'Prosperidad', 1),
(1458, 16, 97, 'Rosario', 2),
(1459, 16, 97, 'San Francisco', 2),
(1460, 16, 97, 'San Luis', 1),
(1461, 16, 97, 'Santa Josefa', 2),
(1462, 16, 97, 'Sibagat', 1),
(1463, 16, 97, 'Talacogon', 1),
(1464, 16, 97, 'Trento', 2),
(1465, 16, 97, 'Veruela', 2),
(1466, 16, 98, 'Basilisa', 1),
(1467, 16, 98, 'Cagdianao', 1),
(1468, 16, 98, 'Dinagat', 1),
(1469, 16, 98, 'Libjo ', 1),
(1470, 16, 98, 'Loreto', 1),
(1471, 16, 98, 'Tubajon', 1),
(1472, 16, 98, 'San Jose', 1),
(1473, 16, 99, 'Surigao City', 2),
(1474, 16, 99, 'Alegria', 2),
(1475, 16, 99, 'Bacuag', 2),
(1476, 16, 99, 'Burgos', 1),
(1477, 16, 99, 'Claver', 2),
(1478, 16, 99, 'Dapa', 1),
(1479, 16, 99, 'Del Carmen', 1),
(1480, 16, 99, 'General Luna', 1),
(1481, 16, 99, 'Gigaquit', 2),
(1482, 16, 99, 'Mainit', 2),
(1483, 16, 99, 'Malimono', 2),
(1484, 16, 99, 'Pilar', 1),
(1485, 16, 99, 'Placer', 2),
(1486, 16, 99, 'San Benito', 1),
(1487, 16, 99, 'San Francisco ', 2),
(1488, 16, 99, 'San Isidro', 1),
(1489, 16, 99, 'Santa Monica ', 1),
(1490, 16, 99, 'Sison', 2),
(1491, 16, 99, 'Socorro', 1),
(1492, 16, 99, 'Tagana-an', 2),
(1493, 16, 99, 'Tubod', 2),
(1494, 16, 100, 'Tandag City', 1),
(1495, 16, 100, 'Bislig City', 2),
(1496, 16, 100, 'Barobo', 2),
(1497, 16, 100, 'Bayabas', 1),
(1498, 16, 100, 'Cagwait', 1),
(1499, 16, 100, 'Cantilan', 1),
(1500, 16, 100, 'Carmen', 1),
(1501, 16, 100, 'Carrascal', 1),
(1502, 16, 100, 'Cortes', 1),
(1503, 16, 100, 'Hinatuan', 2),
(1504, 16, 100, 'Lanuza', 1),
(1505, 16, 100, 'Lianga', 1),
(1506, 16, 100, 'Lingig', 2),
(1507, 16, 100, 'Madrid', 1),
(1508, 16, 100, 'Marihatag', 1),
(1509, 16, 100, 'San Agustin', 1),
(1510, 16, 100, 'San Miguel', 1),
(1511, 16, 100, 'Tagbina', 2),
(1512, 16, 100, 'Tago', 1),
(1513, 17, 101, 'Marawi City', 1),
(1514, 17, 101, 'Bacolod-Kalawi ', 2),
(1515, 17, 101, 'Balabagan', 2),
(1516, 17, 101, 'Balindong ', 2),
(1517, 17, 101, 'Bayang', 2),
(1518, 17, 101, 'Binidayan', 2),
(1519, 17, 101, 'Buadiposo-Buntong', 1),
(1520, 17, 101, 'Bubong', 1),
(1521, 17, 101, 'Bumbaran', 1),
(1522, 17, 101, 'Butig', 2),
(1523, 17, 101, 'Calanogas', 2),
(1524, 17, 101, 'Ditsaan-Ramain', 1),
(1525, 17, 101, 'Ganassi', 2),
(1526, 17, 101, 'Kapai', 1),
(1527, 17, 101, 'Kapatagan', 2),
(1528, 17, 101, 'Lumba-Bayabao', 1),
(1529, 17, 101, 'Lumbaca-Unayan', 2),
(1530, 17, 101, 'Lumbatan', 2),
(1531, 17, 101, 'Lumbayanague ', 2),
(1532, 17, 101, 'Madalum', 2),
(1533, 17, 101, 'Madamba ', 2),
(1534, 17, 101, 'Maguing', 1),
(1535, 17, 101, 'Malabang', 2),
(1536, 17, 101, 'Marantao ', 1),
(1537, 17, 101, 'Marogong', 2),
(1538, 17, 101, 'Masiu', 1),
(1539, 17, 101, 'Mulondo', 1),
(1540, 17, 101, 'Pagayawan', 2),
(1541, 17, 101, 'Piagapo', 1),
(1542, 17, 101, 'Picong', 2),
(1543, 17, 101, 'Poona Bayabao', 1),
(1544, 17, 101, 'Pualas', 2),
(1545, 17, 101, 'Saguiaran', 1),
(1546, 17, 101, 'Sultan Dumalondong', 2),
(1547, 17, 101, 'Tagoloan II', 1),
(1548, 17, 101, 'Tamparan', 1),
(1549, 17, 101, 'Taraka', 1),
(1550, 17, 101, 'Tubaran', 2),
(1551, 17, 101, 'Tugaya', 2),
(1552, 17, 101, 'Wao', 1),
(1553, 17, 102, 'Ampatuan', 2),
(1554, 17, 102, 'Barira', 1),
(1555, 17, 102, 'Buldon', 1),
(1556, 17, 102, 'Buluan', 2),
(1557, 17, 102, 'Datu Abdullah Sangki', 2),
(1558, 17, 102, 'Datu Anggal Midtimbang', 2),
(1559, 17, 102, 'Datu Blah T. Sinsuat', 1),
(1560, 17, 102, 'Datu Hoffer Ampatuan', 2),
(1561, 17, 102, 'Datu Odin Sinsuat', 1),
(1562, 17, 102, 'Datu Paglas', 2),
(1563, 17, 102, 'Datu Piang', 2),
(1564, 17, 102, 'Datu Salibo', 2),
(1565, 17, 102, 'Datu Saudi-Ampatuan', 2),
(1566, 17, 102, 'Datu Unsay', 2),
(1567, 17, 102, 'Gen. S. K. Pendatun', 2),
(1568, 17, 102, 'Guindulungan', 2),
(1569, 17, 102, 'Kabuntalan', 1),
(1570, 17, 102, 'Mamasapano', 2),
(1571, 17, 102, 'Mangudadatu', 2),
(1572, 17, 102, 'Matanog', 1),
(1573, 17, 102, 'Northern Kabuntalan', 1),
(1574, 17, 102, 'Pagagawan', 2),
(1575, 17, 102, 'Pagalungan', 2),
(1576, 17, 102, 'Paglat', 2),
(1577, 17, 102, 'Pandag', 2),
(1578, 17, 102, 'Parang', 1),
(1579, 17, 102, 'Rajah Buayan', 2),
(1580, 17, 102, 'Shariff Aguak (Maganoy)', 2),
(1581, 17, 102, 'Shariff Saydona Mustapha', 2),
(1582, 17, 102, 'South Upi', 2),
(1583, 17, 102, 'Sultan Kudarat ', 1),
(1584, 17, 102, 'Sultan Mastura', 1),
(1585, 17, 102, 'Sultan sa Barongis (Lambayong)', 2),
(1586, 17, 102, 'Sultan Sumagka (Talitay)', 2),
(1587, 17, 102, 'Talayan', 2),
(1588, 17, 102, 'Upi', 1),
(1589, 17, 103, 'Cotabato City', 1),
(1590, 17, 104, 'Banguingui', 2),
(1591, 17, 104, 'Hadji Panglima Tahil (Marunggas)', 1),
(1592, 17, 104, 'Indanan', 1),
(1593, 17, 104, 'Jolo', 1),
(1594, 17, 104, 'Kalingalan Caluang', 2),
(1595, 17, 104, 'Lugus', 2),
(1596, 17, 104, 'Luuk', 2),
(1597, 17, 104, 'Maimbung', 1),
(1598, 17, 104, 'Old Panamao', 2),
(1599, 17, 104, 'Omar', 2),
(1600, 17, 104, 'Pandami', 2),
(1601, 17, 104, 'Panglima Estino (New Panamao)', 2),
(1602, 17, 104, 'Pangutaran', 1),
(1603, 17, 104, 'Parang', 1),
(1604, 17, 104, 'Pata', 2),
(1605, 17, 104, 'Patikul', 1),
(1606, 17, 104, 'Siasi', 2),
(1607, 17, 104, 'Talipao', 1),
(1608, 17, 104, 'Tapul', 2),
(1609, 17, 105, 'Bongao', 1),
(1610, 17, 105, 'Languyan', 1),
(1611, 17, 105, 'Mapun ', 1),
(1612, 17, 105, 'Panglima Sugala', 1),
(1613, 17, 105, 'Sapa-Sapa', 1),
(1614, 17, 105, 'Sibutu', 1),
(1615, 17, 105, 'Simunul ', 1),
(1616, 17, 105, 'Sitangkai', 1),
(1617, 17, 105, 'South Ubian', 1),
(1618, 17, 105, 'Tandubas', 1),
(1619, 17, 105, 'Turtle Islands', 1),
(1620, 17, 106, 'Akbar', 1),
(1621, 17, 106, 'Al-Barka', 1),
(1622, 17, 106, 'Hadji Mohammad Ajul', 1),
(1623, 17, 106, 'Hadji Muhtamad', 1),
(1624, 17, 106, 'Lamitan City', 1),
(1625, 17, 106, 'Lantawan', 1),
(1626, 17, 106, 'Maluso', 1),
(1627, 17, 106, 'Sumisip', 1),
(1628, 17, 106, 'Tabuan-Lasa', 1),
(1629, 17, 106, 'Tipo-Tipo', 1),
(1630, 17, 106, 'Tuburan', 1),
(1631, 17, 106, 'Ungkaya Pukan', 1),
(1632, 17, 107, 'Isabela City', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderofpayment`
--

CREATE TABLE IF NOT EXISTS `orderofpayment` (
`id` int(11) NOT NULL,
  `agency_id` int(11) NOT NULL,
  `transactionNum` varchar(50) NOT NULL,
  `collectiontype_id` int(11) NOT NULL,
  `transactionDate` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount` float(11,2) NOT NULL,
  `purpose` tinytext NOT NULL,
  `createdReceipt` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderofpayment`
--

INSERT INTO `orderofpayment` (`id`, `agency_id`, `transactionNum`, `collectiontype_id`, `transactionDate`, `customer_id`, `amount`, `purpose`, `createdReceipt`) VALUES
(44, 11, 'R9-2015-02-0001', 1, '2015-02-11', 3, 0.00, 'testing', 0),
(45, 11, 'R9-2015-02-0002', 1, '2015-02-12', 3, 0.00, 'test', 0);

-- --------------------------------------------------------

--
-- Table structure for table `paymentitem`
--

CREATE TABLE IF NOT EXISTS `paymentitem` (
`id` int(11) NOT NULL,
  `referral_id` int(11) NOT NULL,
  `orderofpayment_id` int(11) NOT NULL,
  `details` varchar(50) NOT NULL,
  `amount` float(11,2) NOT NULL,
  `cancelled` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `paymentitem`
--

INSERT INTO `paymentitem` (`id`, `referral_id`, `orderofpayment_id`, `details`, `amount`, `cancelled`) VALUES
(12, 7, 44, 'R9-012015-CHE-0007', 250.00, 0),
(13, 9, 44, 'R9-022015-CHE-0009', 675.00, 0),
(14, 7, 45, 'R9-012015-CHE-0007', 175.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE IF NOT EXISTS `province` (
`id` int(11) NOT NULL,
  `regionId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`id`, `regionId`, `name`, `code`) VALUES
(1, 1, 'NCR - Capital District', ''),
(2, 1, 'NCR - Eastern Manila District', ''),
(3, 1, 'NCR - Northern Manila District (CAMANAVA)', ''),
(4, 1, 'NCR - Southern Manila District', ''),
(5, 2, 'Abra', ''),
(6, 2, 'Apayao', ''),
(7, 2, 'Baguio', ''),
(8, 2, 'Benguet', ''),
(9, 2, 'Ifugao', ''),
(10, 2, 'Kalinga', ''),
(11, 2, 'Mountain Province', ''),
(12, 3, 'Ilocos Norte', ''),
(13, 3, 'Ilocos Sur', ''),
(14, 3, 'La Union', ''),
(15, 3, 'Pangasinan', ''),
(16, 4, 'Batanes', ''),
(17, 4, 'Cagayan', ''),
(18, 4, 'Isabela', ''),
(19, 4, 'Santiago', ''),
(20, 4, 'Nueva Vizcaya', ''),
(21, 4, 'Quirino', ''),
(22, 5, 'Aurora', ''),
(23, 5, 'Bataan', ''),
(24, 5, 'Bulacan', ''),
(25, 5, 'Nueva Ecija', ''),
(26, 5, ' Angeles', ''),
(27, 5, 'Pampanga', ''),
(28, 5, 'Tarlac', ''),
(29, 5, 'Olongapo', ''),
(30, 5, 'Zambales', ''),
(31, 6, 'Batangas', ''),
(32, 6, 'Cavite', ''),
(33, 6, 'Laguna', ''),
(34, 6, 'Quezon', ''),
(35, 6, 'Lucena', ''),
(36, 6, 'Rizal', ''),
(37, 7, 'Marinduque', ''),
(38, 7, 'Occidental Mindoro', ''),
(39, 7, 'Oriental Mindoro', ''),
(40, 7, 'Palawan', ''),
(41, 7, 'Puerto Princesa', ''),
(42, 7, 'Romblon', ''),
(43, 8, 'Albay', ''),
(44, 8, 'Camarines Norte', ''),
(45, 8, 'Camarines Sur', ''),
(46, 8, 'Naga', ''),
(47, 8, 'Catanduanes', ''),
(48, 8, 'Masbate', ''),
(49, 8, 'Sorsogon', ''),
(50, 9, 'Aklan', ''),
(51, 9, 'Antique', ''),
(52, 9, 'Capiz', ''),
(53, 9, 'Guimaras', ''),
(54, 9, 'Iloilo', ''),
(55, 9, 'Iloilo City', ''),
(56, 9, 'Negros Occidental', ''),
(57, 9, 'Bacolod', ''),
(58, 10, 'Bohol', ''),
(59, 10, 'Cebu', ''),
(60, 10, 'Lapu-lapu City', ''),
(61, 10, 'Mandaue City', ''),
(62, 10, 'Cebu City', ''),
(63, 10, 'Negros Oriental', ''),
(64, 10, 'Siquijor', ''),
(65, 11, 'Biliran', ''),
(66, 11, 'Eastern Samar', ''),
(67, 11, 'Leyte', ''),
(68, 11, 'Ormoc', ''),
(69, 11, 'Tacloban', ''),
(70, 11, 'Northern Samar', ''),
(71, 11, 'Samar', ''),
(72, 11, 'Southern Leyte', ''),
(73, 12, 'Zamboanga City', ''),
(74, 12, 'Zamboanga del Norte', ''),
(75, 12, 'Zamboanga del Sur', ''),
(76, 12, 'Zamboanga Sibugay', ''),
(77, 13, 'Bukidnon', ''),
(78, 13, 'Camiguin', ''),
(79, 13, 'Lanao del Norte', ''),
(80, 13, ' Iligan City', ''),
(81, 13, 'Misamis Occidental', ''),
(82, 13, 'Misamis Oriental', ''),
(83, 13, 'Cagayan de Oro', ''),
(84, 14, 'Compostela Valley', ''),
(85, 14, 'Davao del Norte', ''),
(86, 14, 'Davao del Sur', ''),
(87, 14, 'Davao City', ''),
(88, 14, 'Davao Oriental', ''),
(89, 14, 'Davao Occidental', ''),
(90, 15, 'Cotabato', ''),
(91, 15, 'Sarangani', ''),
(92, 15, 'South Cotabato', ''),
(93, 15, 'General Santos', ''),
(94, 15, 'Sultan Kudarat', ''),
(95, 16, 'Agusan del Norte', ''),
(96, 16, 'Butuan', ''),
(97, 16, 'Agusan del Sur', ''),
(98, 16, 'Dinagat Islands', ''),
(99, 16, 'Surigao del Norte', ''),
(100, 16, 'Surigao del Sur', ''),
(101, 17, 'Lanao del Sur', ''),
(102, 17, 'Maguindanao', ''),
(103, 17, 'Cotabato City', ''),
(104, 17, 'Sulu', ''),
(105, 17, 'Tawi-Tawi', ''),
(106, 17, 'Basilan', ''),
(107, 17, 'Isabela City', '');

-- --------------------------------------------------------

--
-- Table structure for table `referral`
--

CREATE TABLE IF NOT EXISTS `referral` (
`id` int(11) NOT NULL,
  `referralCode` varchar(50) NOT NULL,
  `referralDate` date NOT NULL,
  `referralTime` varchar(10) NOT NULL,
  `receivingAgencyId` int(11) NOT NULL,
  `acceptingAgencyId` int(11) NOT NULL,
  `referred_by` int(11) NOT NULL,
  `referred_to` int(11) NOT NULL,
  `accepting_id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `paymentType_id` int(11) NOT NULL,
  `discount_id` int(11) NOT NULL,
  `sampleArrivalDate` date NOT NULL,
  `reportDue` date NOT NULL,
  `conforme` varchar(50) NOT NULL,
  `receivedBy` varchar(50) NOT NULL,
  `cancelled` tinyint(1) NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `referral`
--

INSERT INTO `referral` (`id`, `referralCode`, `referralDate`, `referralTime`, `receivingAgencyId`, `acceptingAgencyId`, `referred_by`, `referred_to`, `accepting_id`, `lab_id`, `customer_id`, `paymentType_id`, `discount_id`, `sampleArrivalDate`, `reportDue`, `conforme`, `receivedBy`, `cancelled`, `status`, `create_time`, `update_time`) VALUES
(1, 'R9-012015-CHE-0001', '2015-01-22', '1421929206', 11, 7, 0, 0, 0, 1, 1, 1, 1, '0000-00-00', '2015-01-22', 'Michael Lim', 'Sonora L. Bunag', 0, 0, '2015-01-22 20:20:06', '2015-01-22 14:35:59'),
(2, 'R9-012015-CHE-0002', '2015-01-22', '1421929206', 12, 4, 0, 0, 0, 1, 1, 1, 1, '0000-00-00', '2015-01-22', 'Michael Lim', 'Sonora L. Bunag', 0, 0, '2015-01-22 20:20:06', '2015-01-22 14:36:00'),
(3, 'R9-012015-CHE-0003', '2015-01-22', '1421929206', 9, 6, 0, 0, 0, 1, 1, 1, 1, '0000-00-00', '2015-01-22', 'Michael Lim', 'Sonora L. Bunag', 0, 0, '2015-01-22 20:20:06', '2015-01-22 13:40:00'),
(4, 'R9-012015-CHE-0004', '2015-01-22', '1421929206', 12, 10, 0, 0, 0, 1, 1, 1, 1, '0000-00-00', '2015-01-22', 'Michael Lim', 'Sonora L. Bunag', 0, 0, '2015-01-22 20:20:06', '2015-01-22 13:40:00'),
(5, 'R9-012015-CHE-0005', '2015-01-22', '1421929206', 11, 10, 0, 0, 0, 1, 1, 1, 1, '0000-00-00', '2015-01-22', 'Michael Lim', 'Sonora L. Bunag', 0, 0, '2015-01-22 20:20:06', '2015-01-22 13:40:00'),
(6, 'R9-012015-CHE-0006', '2015-01-22', '1421929206', 9, 11, 0, 0, 0, 1, 1, 1, 1, '0000-00-00', '2015-01-22', 'Michael Lim', 'Sonora L. Bunag', 0, 0, '2015-01-22 20:20:06', '2015-01-22 13:40:00'),
(7, 'R9-012015-CHE-0007', '2015-01-23', '1421983004', 11, 0, 0, 0, 0, 1, 3, 1, 1, '0000-00-00', '2015-01-23', 'Ronnel Gundoy', 'Sonora L. Bunag', 0, 0, '2015-01-23 11:16:44', '2015-01-23 03:16:44'),
(8, 'R9-012015-CHE-0008', '2015-01-23', '1422006742', 11, 21, 0, 0, 0, 1, 3, 1, 1, '0000-00-00', '2015-01-23', 'Aris D. Moratalla', 'Sonora L. Bunag', 0, 0, '2015-01-23 17:52:22', '2015-02-12 02:36:24'),
(9, 'R9-022015-CHE-0009', '2015-02-07', '1423263288', 11, 21, 0, 0, 0, 1, 3, 1, 1, '0000-00-00', '2015-02-07', 'Michael Lim', 'Sonora L. Bunag', 0, 0, '2015-02-07 06:54:48', '2015-02-06 22:56:41');

-- --------------------------------------------------------

--
-- Table structure for table `referralstatus`
--

CREATE TABLE IF NOT EXISTS `referralstatus` (
`id` int(11) NOT NULL,
  `referral_id` int(11) NOT NULL,
  `acceptingAgencyId` int(11) NOT NULL,
  `sampleArrivalDate` date NOT NULL,
  `shipmentDetails` text NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `referralstatus`
--

INSERT INTO `referralstatus` (`id`, `referral_id`, `acceptingAgencyId`, `sampleArrivalDate`, `shipmentDetails`, `status_id`) VALUES
(1, 1, 11, '2015-01-30', 'Testing', 1),
(2, 9, 21, '2015-02-12', 'JRS Chilled', 1),
(3, 8, 21, '2015-02-13', 'JRS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE IF NOT EXISTS `region` (
`id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `code`, `name`) VALUES
(1, 'NCR', 'National Capital Region'),
(2, 'CAR', 'Cordillera Administrative Region'),
(3, 'Region I', 'Ilocos Region'),
(4, 'Region II', 'Cagayan Valley'),
(5, 'Region III', 'Central Luzon'),
(6, 'Region IV-A', 'CALABARZON'),
(7, 'Region IV-B', 'MIMAROPA'),
(8, 'Region V', 'Bicol Region'),
(9, 'Region VI', 'Western Visayas'),
(10, 'Region VII', 'Central Visayas'),
(11, 'Region VIII', 'Eastern Visayas'),
(12, 'Region IX', 'Zamboanga Peninsula'),
(13, 'Region X', 'Northern Mindanao'),
(14, 'Region XI', 'Davao Region'),
(15, 'Region XII', 'SOCCSKSARGEN'),
(16, 'CARAGA', 'Caraga Region'),
(17, 'ARMM', 'Autonomous Region in Muslim Mindanao');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE IF NOT EXISTS `result` (
`id` int(11) NOT NULL,
  `referral_id` int(11) NOT NULL,
  `filename` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`id`, `referral_id`, `filename`) VALUES
(1, 1, 'report.pdf'),
(2, 1, 'report.pdf'),
(3, 2, 'report.pdf'),
(4, 2, 'report.pdf'),
(5, 2, 'report.pdf'),
(6, 2, 'report.pdf'),
(7, 2, '2014-01-033.pdf'),
(8, 2, '2014-01-033.pdf'),
(9, 2, '2014-01-033.pdf'),
(10, 2, '2014-01-033.pdf'),
(11, 32, 'text.text'),
(12, 1, '2'),
(13, 1, '3'),
(14, 1, '3'),
(15, 1, '2'),
(16, 1, 'C:\\xampp\\tmp\\php13FD.tmp'),
(17, 55, 'C:\\xampp\\tmp\\phpCF91.tmp'),
(18, 1, 'C:\\xampp\\tmp\\php4A68.tmp'),
(19, 4, 'streaming how to (2).pdf'),
(20, 4, 'hahaha'),
(21, 3, 'hahaha'),
(22, 6, 'C:\\xampp\\tmp\\phpDE72.tmp'),
(23, 4, '???f??i?`??j'),
(24, 6, 'C:\\xampp\\tmp\\phpE8D2.tmp'),
(25, 6, '???f??i?Am?'),
(26, 7, 'C:\\xampp\\tmp\\phpE379.tmp'),
(27, 3, '@C:\\xampp\\tmp\\phpBCBB.tmp');

-- --------------------------------------------------------

--
-- Table structure for table `sample`
--

CREATE TABLE IF NOT EXISTS `sample` (
`id` int(11) NOT NULL,
  `referral_id` int(11) NOT NULL,
  `sampleType_id` int(11) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `sampleName` varchar(50) NOT NULL,
  `sampleCode` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `status_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sample`
--

INSERT INTO `sample` (`id`, `referral_id`, `sampleType_id`, `barcode`, `sampleName`, `sampleCode`, `description`, `status_id`, `create_time`, `update_time`) VALUES
(7, 1, 1, 'C5QDVLCHE0C0', 'Fish in Stand-up Pouch (Sealed)', '', 'Mega Sardines in Tomato Sauce with chili added, Product Code: SCTAP1ADD7 BBAPR0716,  2 samples in stand-up pouch, approx. 110 g/each, with label.', 0, '0000-00-00 00:00:00', '2015-01-24 08:49:59'),
(8, 1, 1, 'ZN5OB0JCHE4T', 'Bottled Fish (Fried)', '', 'Premium Sardines Spanish Style in Corn Oil, PD: 03/22/2014 DS, Lot #: Na-03-30, Supplier: NFC/John Kyle-88, 2 bottle samples, with label.', 0, '0000-00-00 00:00:00', '2015-01-24 08:50:02'),
(9, 1, 1, 'JI9DJCHE88TH', ' Fish in Stand-up Pouch', '', 'Mega Sardines in Tomato Sauce, Product Code: SSTAP1ADDL BBAPR2116,  2 samples in stand-up pouch, approx. 110 g/each, with label.', 0, '0000-00-00 00:00:00', '2015-01-24 23:31:58'),
(10, 9, 15, 'ST9CMM3YCHE2', 'Bottled Fish', '', 'Spanish Syle Sardines in Tomato Sauce ', 0, '0000-00-00 00:00:00', '2015-02-06 22:55:26'),
(11, 7, 15, '7RF9JCHEDB1R', 'Clean Water', '', 'approx. 1.5 L sample, clear, in PET Bottle', 0, '0000-00-00 00:00:00', '2015-02-08 06:39:58'),
(12, 8, 15, 'ZP7ICHE0AJ6D', 'Deepwell Water ', '', 'Water in a sampling bottle labeled "Source: Deepwell 1; Date of Sampling: January 27, 2015; Time of Sampling: 8:30 AM"; 500 ml', 0, '0000-00-00 00:00:00', '2015-02-12 02:35:48'),
(13, 8, 15, 'R5LOPO29CHEY', 'Deepwell Water ', '', 'Water in a sampling bottle labeled "Source: Deepwell 1; Date of Sampling: January 27, 2015; Time of Sampling: 8:30 AM"; 500 ml', 0, '0000-00-00 00:00:00', '2015-02-12 02:35:59');

-- --------------------------------------------------------

--
-- Table structure for table `sampletemplate`
--

CREATE TABLE IF NOT EXISTS `sampletemplate` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sampletemplate`
--

INSERT INTO `sampletemplate` (`id`, `name`, `description`) VALUES
(1, 'Cuttlefish (fillet)', 'Cuttlefish (fillet)'),
(2, 'Fishmeal', 'Sardines OrdinaryVAN#'),
(10, 'Sample', 'Description'),
(13, 'test', 'test'),
(17, 'Fishmeal', 'Sardines Ordinary\r\nVAN#'),
(18, 'Fishmeal', 'Sardines Ordinary\r\nVAN#'),
(19, 'Sample Name', 'Description Name'),
(20, 'adfaf', 'asdfasdfsa'),
(21, 'asdasd', 'asdasdas'),
(22, 'asdsad', 'asdasdas'),
(23, 'asdasdasd', 'asdasdasd'),
(24, 'Fishmeal', 'Sardines Ordinary\r\nVAN#'),
(25, 'Fishmeal', 'Sardines Ordinary\r\nVAN#\r\nProduction Date'),
(26, 'Water', 'Sample A (Influent)'),
(27, 'Water', 'Water (STP)'),
(28, 'Weighing Scale', 'Weighing Scale'),
(29, '20, 000 L Truck', '20, 000 L Truck'),
(30, '10, 000 L Truck', '10, 000 L Truck'),
(31, 'Sardines Bones (Uncrushed)', 'Sardines Ordinary\r\nVAN# '),
(32, 'Dried Seaweeds', 'weight: approx 650 g\r\ncolor: brown & black\r\npackaging: plastic bag'),
(33, 'Water', 'Date and Time of Sampling: 06/27/2011 @1:30 PM'),
(34, 'Fishmeal', 'Head and Tail\r\nPD: 06/18-21/2011'),
(35, 'Canned Sardines', 'Spanish Style Sardines\r\nCodes:\r\nVSP 12 YST \r\nVSP 14 YST\r\nBB: 26 JUN 2012\r\nPD: 26 JUN 2012'),
(36, 'Water', 'Source: Deepwell\r\nDate and Time of Sampling: 06/27/2012 @10:20 AM'),
(37, 'Bottled Sardines', 'Bottled Sardines'),
(38, 'Bottled Sardines', 'Bottled Sardines'),
(39, 'Bottled Sardines', 'Bottled Sardines'),
(40, 'Deep Well', 'Sampling Time: 7:00 AM'),
(41, 'Deep Well', 'Sampling Time: 8:00 AM'),
(42, 'Dehydrated Guyabano Pulp', 'approx. 160 g., packed in plastic packaging'),
(43, 'Dehydrated Guyabano Pulp', 'approx. 160 g., packed in plastic packaging'),
(44, 'Dehydrated Guyabano Pulp', 'approx. 160 g., packed in plastic packaging'),
(45, 'Water', 'Sample is ~ 370 ml, clear, in glass bottle'),
(46, 'Octopus', 'Product Code: ZAM/BSF 12123000101 PTJSFO\r\n~ 900 g sample, frozen raw, packed in plastic packaging'),
(47, 'Cuttlefish', 'Product Code: ZAM/BSF 12123100101 PTJSCF\r\n~ 220 g sample, frozen raw, packed in plastic packaging'),
(48, 'Cuttlefish', 'Product Code: ZAM/BSF 12123100101 PTJSCF\r\n~ 220 g sample, frozen raw, packed in plastic packaging'),
(49, 'Squid', 'Product Code: ZAM/BSF 12123100101 PTJSSQ\r\n~ 600 g sample, frozen raw, packed in plastic packaging'),
(50, 'Wastewater', 'Source: Drainage at Campo Islam\r\nDate & Time: 1/2/13 @ 9:30 AM\r\nSample is ~ 350 ml, in wide mouth glass jar, turbid with sediments'),
(51, 'Water', 'Source: Deepwell, 95 feet deep\r\nDate-Time:1-2-13 @ 10:30 AM\r\nSample is ~ 1.5 liter, clear, in PET bottle'),
(52, 'Guyabano Juice Concentrate', 'Production Date: 12-4-12\r\nWeek 3\r\nSample is in 8 oz glass jar, white in color, sealed, no label, chilled'),
(53, 'Copra Meal Cookies', 'Production Date: 12-5-12, Week 2, Sample is ~ 100 g, packed in plastic packaging'),
(54, 'Cassava Chips', 'Production Date: 12-5-12, Week 2, Sample is ~ 100 g, packed in plastic packaging'),
(55, 'Water', 'Source: ZAGCOR 1\r\nDate-Time:1-2-13 @ 1:30 PM\r\nSample is ~ 375 ml, clear, in glass bottle'),
(56, 'Water', 'Source: ZAGCOR 2\r\nDate-Time:1-2-13 @ 1:30 PM\r\nSample is ~ 375 ml, clear, in glass bottle'),
(57, 'Ice Cubes', 'Source: ZAGCOR 1, Sample is ~ 500 g, clear, in plastic sampling bag'),
(58, 'Sweet Potato Flour', 'Production Date: 12-7-12, \r\nWeek 2, Sample is ~ 200 g, packed in cheeze cloth packaging'),
(59, ' Dehydrated Guyabano Pulp', 'Production Date:  12-11-12, Week 2, Sample is ~ 100 g, packed in plastic packaging'),
(60, ' Dehydrated Guyabano Pulp', 'Production Date:  12-11-13, Week 2, Sample is ~ 100 g, packed in plastic packaging'),
(61, ' Dehydrated Guyabano Pulp', 'Production Date:  12-11-13, Week 3, Sample is ~ 100 g, packed in plastic packaging'),
(62, 'Cookies Control', 'Day 0, P.D. 1-2-13, approx. 600 g, 56 pieces, chilled, in plastic container\r\n'),
(63, 'Cookies with seaweeds', 'Day o, P.D. 1-2-13, approx. 600 g, 52 pieces, chilled, in plastic container'),
(64, 'Water', 'Purified Water, Date and Time of Sampling: 01-04-13 @ 8:00 AM, 1.5 liter sample, clear, in PET bottle'),
(65, 'Dried Seaweeds', 'weight: approx 1.5 kg sample,\r\nbrown & yellow in color, in plastic packaging\r\n'),
(66, 'Water', 'Purified Water, Date and Time of Sampling: 01-07-13 @ 8:40 AM, 3.25 ml sample, clear, in glass bottle'),
(67, 'Water', 'Source: ZCWD,  Date and Time of Sampling: 01-07-13 @ 8:40 AM, 3.25 ml sample, clear, in glass bottle'),
(68, 'Water', 'Source: ZCWD,  Date and Time of Sampling: 01-07-13 @ 8:40 AM, 325 ml sample, clear, in glass bottle'),
(69, 'Water', 'Stn. 1: WESTMINCOM, Source: Deepwell, New Tank, Date-Time: 1-7-13 @ 11:20 AM'),
(70, 'Dirty Water', 'approx. 1.5 L sample, clear in PET bottle'),
(71, 'Clean Water', 'approx. 1.5 L sample, clear, in PET Bottle'),
(72, 'Wastewater', 'Source: Canelar Creek \r\n Stn 3- at the bridge of La ViÑa Hotel\r\nDate & Time: 1/11/13\r\nSample is ~ 1 liter, clear, in PET bottle'),
(73, 'Carrot Chips', 'approx. 100 g sample, orange brown in color, packed in plastic packaging'),
(74, 'Jack Fruit Seed Flour', 'Approx. 100 g sample, off-white in color, packed in cheese cloth'),
(75, 'Water', 'Source:Finished Product\r\nDate and Time of Sampling: 01-14-13 @ 9:20 AM, \r\nApprox. 2 liters sample, clear, in PET bottle, 4 bot @ 500 ml/bot'),
(76, 'Water', 'Source:Finished Product\r\nDate and Time of Sampling: 01-14-13 @ 10:00 AM, \r\nApprox. 1 liters sample, clear, in PET bottle'),
(77, 'Fishball', 'Day 0, Collection Date: 1/1/4/13\r\nSource: ZCHS Main, Supplier 2 (outside), approx. 160 g sample, packed in plastic container'),
(78, 'Sauce', 'Day 0, Collection Date: 1/14/13\r\nSource: ZCHS Main, Supplier 1 (Inside), approx. 217 g sample, in 8 oz glass jar'),
(79, 'Crepe Ginger Soap', 'approx. 42 g solid, in plastic packaging, off-white in color'),
(80, 'Banana Chips', 'Green Banana Chips, no flavor, approx. 50 g and 500 g sample, light yellow in color, in plastic packaging'),
(81, 'Banana Chips', 'Ripe Banana Chips, no flavor, approx. 50 g and 500 g sample, dark brown in color, in plastic packaging'),
(82, 'Wastewater', 'Source: Canelar Creek \r\n Stn 1- at San Ignacio bridge\r\nDate & Time: 1/16/13 @ 8:30 AM\r\nSample is ~ 1 liter, turbid, in PET container'),
(83, 'Wastewater', 'Source: Canelar Creek \r\n Stn 2- at Camino Nuevo bridge\r\nDate & Time: 1/16/13 @ 8:39 AM\r\nSample is ~ 1 liter, turbid, in PET container'),
(84, 'Wastewater', 'Source: Canelar Creek \r\n Stn 3- at  the bridge near La Viña Hotel\r\nDate & Time: 1/16/13 @ 8:47 AM\r\nSample is ~ 1 liter, turbid, in PET container'),
(85, 'Water', 'Source:Deepwell\r\nDate and Time of Sampling: 01-15-13 @ 10:30 AM, \r\nApprox.~320 sample, clear, in glass bottle, chilled'),
(86, 'Sisi ( Barnacles)', 'approx. 90 grams sample, dark brown in color, in ziplock bag'),
(87, 'Sasing ( Peanut Worm)', 'approx. 50 grams, light brown in color, in ziplock bag'),
(88, 'Cookies Control', 'Day 0, P.D. 1-2-13, approx. 300 g,  chilled, in plastic container\r\n'),
(89, 'Cookies with seaweeds', 'Day o, P.D. 1-2-13, approx. 300 g, chilled, in plastic container'),
(90, 'Fishmeal', 'Sample 1, Head and Tail, P.D. 01-17-13 DS Plant A, approx. 100g sample, brown in color, in plastic packaging'),
(91, 'Fishmeal', 'Sample 1, Head and Tail, P.D. 01-17-13 DS Plant A, approx. 100g sample, brown in color, in plastic packaging'),
(92, 'Fish Oil', 'Sample 1-P.D. Jan. 17, 2013 DS, approx. 50 ml each, in glasslite bottle, dark brown in color'),
(93, 'Fish Oil', 'Sample 2-P.D. Jan. 17, 2013 DS, approx. 50 ml sample, in glasslite bottle, dark brown in color'),
(94, 'Wastewater', 'Effluent (from Coir Fiber Filter), first feeding, Date & Time of Sampling: 1/23/13 @ 8:30 AM, ~ 1 liter sample, turbid, in PET bottle'),
(95, 'Water', 'Source: Raw Water, Deepwell\r\nDate and Time of Sampling: 01-23-13 @ 5:30 AM, \r\nApprox. 1 liters sample, clear, in PET bottle'),
(96, 'Mass Standard', '5 kg, Mild Steel, Cylindrical ,09000793'),
(97, 'Wastewater', 'Source: Canelar Creek \r\n Stn 1- at San Ignacio Bridge \r\nDate & Time: 1/25/13\r\nSample is ~ 1 liter, turbid, in PET bottle'),
(98, 'Proving Tank', '250 L, RX9-03, Stainless Steel'),
(99, 'Wastewater', 'Source: Effluent (from sand filter)\r\nDate & Time: 1/30/13 @ 8:15 AM\r\nSample is ~ 1 liter, turbid, in PET bottle'),
(100, 'Wastewater', 'Source: Effluent (from coir fiber filter)\r\nDate & Time: 1/30/13 @ 8:15 AM\r\nSample is ~ 1 liter, turbid, in PET bottle'),
(101, 'Water ( Station 3)', 'Source: Deepwell, 95 feet deep\r\nDate-Time:1-2-13 @ 10:30 AM\r\nSample is ~ 1.5 liter, clear, in PET bottle'),
(102, 'Water ( Station 3)', 'Source: Deepwell, 95 feet deep\r\nDate-Time:1-2-13 @ 10:30 AM\r\nSample is ~ 1.5 liter, clear, in PET bottle'),
(103, 'Water ( Station 3)', 'Source: Surface Water-Aboles\r\nDate-Time:1-30-13 @ 8:35 AM\r\nSample: ~ 1 liter  in PET bottle & 1 liter in wide mouth glass jar, clear, chilled'),
(104, 'Water ( Station 4)', 'Source: Surface Water-Limbong\r\nDate-Time:1-30-13 @ 9:30 AM\r\nSample: ~ 1 liter  in PET bottle & 1 liter in wide mouth glass jar, clear, chilled'),
(105, 'Water ( Station 2)', 'Source: Ground Water-Campo Uno\r\nDate-Time:1-30-13 @ 7:50 AM\r\nSample: ~ 1 liter  in PET bottle & 1 liter in wide mouth glass jar, clear, chilled'),
(106, 'Water ( Sample 2)', 'Source: River ( Lacasteville)\r\nDate & Time of Sampling:\r\n1/30/13 @ 1:35 PM\r\nSample:~ 1 L, clear with suspended solids, in PET container'),
(107, 'Water ( Sample 3)', 'Source: River with backwash ( Lacasteville)\r\nDate & Time of Sampling:\r\n1/30/13 @ 1:50 PM\r\nSample:~ 1 L, clear with suspended solids, in PET container'),
(108, 'Wastewater', 'Source: Canelar Creek \r\n Stn 1- at San Ignacio bridge\r\nDate & Time: 1/24/13 @ 8:14 AM\r\nSample is ~ 325 ml, turbid, in glass. chilled'),
(109, 'Wastewater', 'Source: Canelar Creek \r\n Stn 3- at the bridge near La Viña Hotel \r\nDate & Time: 1/14/13 @ 8:38 AM\r\nSample is ~ 325 ml, turbid, in glass. chilled'),
(110, 'Water', 'Source:Victoria Pipe line, Level II\r\nDate and Time of Sampling: 01-14-13 @ 7:58 AM, \r\nApprox. 370 ml sample, clear, in glass bottle'),
(111, 'Water', 'Sample is ~ 370 ml, clear, in glass bottle\r\nSource: Victoria Pipe Line, Level II\r\n01/14/13 @ 7:58 AM'),
(112, 'Water', 'Source: Raw Water\r\nDate and Time of Sampling: 1/15/13 @10:45 AM, ~ 1 liter sample, clear, in PET bottle'),
(113, 'Fish Tank', '10 gallon glass tank'),
(114, 'Tank', '10 gallons clear glass tank');

-- --------------------------------------------------------

--
-- Table structure for table `sampletype`
--

CREATE TABLE IF NOT EXISTS `sampletype` (
`id` int(11) NOT NULL,
  `type` varchar(75) NOT NULL,
  `status_id` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sampletype`
--

INSERT INTO `sampletype` (`id`, `type`, `status_id`) VALUES
(1, 'Water', 1),
(2, 'Food, Cosmetics, Extracts, Veterinary Products etc.', 1),
(3, 'Plant Extracts, Cosmetics, Disinfectants etc.', 1),
(4, 'Culture Media', 1),
(5, 'Plant Isolates/ Food Supplements', 1),
(6, 'Cosmetics', 1),
(7, 'Pesticides', 1),
(8, 'Household Pesticides', 1),
(9, 'Aerosols, EC Fumigants, Insect Sprays', 1),
(10, 'Larvicides', 1),
(11, 'Lotion, Spray, Soap, Mothballs', 1),
(12, 'Fumigants, Insect Spray, EC', 1),
(13, 'Mosquito Coil', 1),
(14, 'Plant extracts', 1),
(15, 'Water (Deepwell, Spring, Distilled, Deionized, Bottle) and Wastewater (Effl', 1),
(16, 'Pipes (uPVC, etc.)', 1),
(17, 'Chemical/Reagents\nKOH – Caustic potash\nNaOH – Caustic Soda\nNaHCO3 – Baking ', 1),
(18, 'Bleaching Powder/ Solution, Detergents, Sodium/Calcium Hyprochloride', 1),
(19, 'Powder Granules', 1),
(22, 'Salt/Sodium Chloride', 1),
(23, 'Soil, Sediments, Sludge', 1),
(24, 'Clay and Related Materials, Pozzalan Cement/Perlite/ Zeolite/Refractories/ ', 1),
(25, 'Limestone (CaCO3), Quicklime (CaO), Hydrated Lime (Ca(OH)2), Scales,  etc.\n', 1),
(26, 'Gypsum (CaSO4.2H2O) and Gypsum Products', 1),
(27, 'Boiler Scale', 1),
(28, 'Fertilizers and Related Materials\nOrganic Fertilizer', 1),
(29, 'Cement (Hydraulic, Portland) Aggregates', 1),
(30, 'Liquid Fuels/ Lubricants', 1),
(31, 'Solid Fuels (charcoal,wood biomass)', 1),
(32, 'Grease', 1),
(33, 'Brake Fluid', 1),
(34, 'Waxes', 1),
(35, 'Asphalt', 1),
(36, 'Proximate Composition of Plant & Plant Products and  Herbal Food Supplement', 1),
(37, 'Plant Components', 1),
(38, 'Plant Oils (Essential & Fixed Oil) Plant Extracts  ', 1),
(39, 'Alkaloids', 1),
(40, 'Tannins', 1),
(41, 'Liquid Nutritional Supplement', 1),
(42, 'Plant Products & Herbal Supplements  ', 1),
(43, 'Medicated Cosmetic Soaps', 1),
(44, 'Medicated Cosmetic Liquid Preparations', 1),
(45, 'Drug, Pharmaceuticals and Cosmetic Preparations', 1),
(46, 'Water-based Paints, Latex, White; Elastomeric; Acrylic Polymer, Copolymer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sampletype_testname`
--

CREATE TABLE IF NOT EXISTS `sampletype_testname` (
`id` int(11) NOT NULL,
  `sampletype_id` int(11) NOT NULL,
  `testname_id` int(11) NOT NULL,
  `added_by` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sampletype_testname`
--

INSERT INTO `sampletype_testname` (`id`, `sampletype_id`, `testname_id`, `added_by`) VALUES
(1, 1, 1, 'SBTG'),
(2, 1, 2, 'BBB'),
(3, 1, 3, 'SBTG'),
(4, 1, 4, 'SBTG'),
(5, 15, 31, 'SBTG'),
(6, 15, 32, 'BBB'),
(7, 15, 33, 'SBTG'),
(8, 15, 34, 'SBTG');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE IF NOT EXISTS `service` (
`id` int(11) NOT NULL,
  `agency_id` int(11) NOT NULL,
  `method_ref_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `agency_id`, `method_ref_id`) VALUES
(26, 10, 1),
(29, 10, 8),
(31, 11, 8),
(34, 11, 4),
(35, 11, 6),
(36, 11, 7),
(37, 11, 5),
(38, 11, 2),
(39, 21, 8),
(40, 21, 7),
(41, 21, 6),
(42, 21, 5);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
`id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`, `enabled`) VALUES
(1, 'RECEIVED', 1),
(2, 'SHIPPED', 1),
(3, 'ACCEPTED', 1),
(4, 'ONGOING', 1),
(5, 'NOT_COMPLETED', 1),
(6, 'COMPLETED', 1),
(7, 'RELEASED', 1);

-- --------------------------------------------------------

--
-- Table structure for table `testname`
--

CREATE TABLE IF NOT EXISTS `testname` (
`id` int(11) NOT NULL,
  `testName` varchar(200) NOT NULL,
  `status_id` tinyint(1) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=191 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testname`
--

INSERT INTO `testname` (`id`, `testName`, `status_id`, `create_time`, `update_time`) VALUES
(1, 'Heterotrophic Plate Count (HPC)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(2, 'Total Coliform Count', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(3, 'E. coli Count', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(4, 'Pseudomonas sp. Count', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(5, 'Aerobic / Total / Standard Plate Count', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(6, 'Molds and Yeast Count', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(7, 'Salmonella sp. Detection, Presumptive (Conventional)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(8, 'Staphylococcus aureus Count', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(9, 'Commercial Sterility (Low acid, pH more than 4.6)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(10, 'Antimicrobial Activity\n(E. coli, S. aureus, P. aeruginosa,  S. typhimurium, B. subtilis)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(11, 'Antifungal Activity (S. cerevisiae, C. albicans, A. niger, F. monoliforme,                             T. mentagrophytes, T. rubrum, Microsporum canis)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(12, 'Media Quality Control', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(13, 'Approximate Lethal Dose', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(14, 'Anti-inflammatory Test', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(15, 'Diuretic Test', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(16, 'Acute Oral Toxicity (LD50)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(17, 'Preliminary Dermal Irritation', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(18, 'Dermal Irritation', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(19, 'Preliminary Eye Irritation', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(20, 'Eye Irritation', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(21, 'Dermal Sensitization', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(22, 'Acute Dermal Toxicity', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(23, 'Knockdown and Mortality For Flying and Crawling Insects', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(24, 'Mosquito Larvicidal Test', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(25, 'Repellency Test for Mosquitoes', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(26, 'Repellency Test for Cockroaches', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(27, 'Residual Activity Test', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(28, 'Knockdown and Mortality Test', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(29, 'Mosquito Larvicides', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(30, 'Repellency Test', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(31, 'Acidity as CO2', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(32, 'Alkalinity as CaCO3', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(33, 'Aluminum', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(34, 'Arsenic', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(35, 'Bicarbonates', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(36, 'Cadmium', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(37, 'Calcium', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(38, 'Chloride', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(39, 'Chlorine (Residual)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(40, 'Chromium', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(41, 'Color', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(42, 'Conductivity', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(43, 'Copper', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(44, 'Extractable Chloride', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(45, 'Extractable Ions', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(46, 'Iron', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(47, 'Lead', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(48, 'Magnesium', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(49, 'Manganese', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(50, 'Mercury', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(51, 'Nickel', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(52, 'Nitrogen (Ammonia-Nitrogen)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(53, 'Nitrogen (Organic)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(54, 'pH', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(55, 'Phosphorus', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(56, 'Potassium', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(57, 'Silica', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(58, 'Silicon', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(59, 'Silver', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(60, 'Sodium', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(61, 'Sulfate', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(62, 'Total Hardness', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(63, 'Total Dissolved Solids', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(64, 'Total Suspended Solids', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(65, 'Total Solids', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(66, 'Turbidity', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(67, 'Zinc', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(68, 'Extractable Pb (First and Third Extraction)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(69, 'Assay', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(70, 'Heavy Metals as Pb', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(71, 'Insoluble Residue', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(72, 'pH (liquid)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(73, 'Specific Gravity, Hydrometer', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(74, 'Specific Gravity, Pycnometer', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(75, 'Available Chlorine', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(76, 'Alkalinity', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(77, 'Bulk/Packed Density', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(78, 'Sieve Analysis (one mesh)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(79, 'Sieve Analysis (succeeding mesh)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(80, 'Complete Chemical Analysis (NaCl. Moisture,, Water Insolubles, Ca, Mg, SO4)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(81, 'Acid Insolubles', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(82, 'Iodine (as received)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(83, 'Moisture', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(84, 'Assay, NaCl (as received)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(85, 'Water Insolubles', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(86, 'Complete Chemical Analysis\n(SiO2, Fe2O3, Al2O3, TiO2, CaO, MgO, Na2O, K2O, LOI)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(87, 'Alumina', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(88, 'Calcium Oxide', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(89, 'Iron Oxide', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(90, 'Loss on Ignition', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(91, 'Magnesium Oxide', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(92, 'Potassium Oxide', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(93, 'Sodium Oxide', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(94, 'Titania', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(95, 'Manganese Oxide', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(96, 'Boron Oxide', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(97, 'Complete Chemical Analysis (SiO2, Fe2O3, Al2O3, CaO, MgO, LOI', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(98, 'Available Lime Index', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(99, 'Phosphorous Pentoxide, (P2O3)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(100, 'Complete Chemical Analysis\n(CaSO4.2H2O, CaSO4, SIO2  and Insoluble, R2O3, CaO, MgO, SO3)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(101, 'Aluminum Oxide', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(102, 'Anhydrite (CaSO4)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(103, 'Combined Water', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(104, 'Free Water', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(105, 'Iron and Aluminum Oxides (mixed oxides)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(106, 'Purity as CaSO4.2H2O', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(107, 'Silica and Insoluble Matter', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(108, 'Sodium Chloride', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(109, 'Sulfate/Sulfur Trioxide', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(110, 'Organic & Volatile Matter', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(111, 'Iron & Aluminum Oxide', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(112, 'Lime (CaO)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(113, 'Magnesia (MgO)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(114, 'Sulfur Trioxide', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(115, 'Phosphate', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(116, 'Nitrogen', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(117, 'Complete Chemical Analysis (SiO2, Fe2O3, Al2O3, TiO2, CaO, MgO, SO3, LOI, Insoluble Residue)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(118, 'API Gravity/Specific Gravity/ Density', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(119, 'Ash, straight', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(120, 'Ash, Sulfated', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(121, 'Copper Corrosion test', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(122, 'Flashpoint', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(123, 'Cleveland Open Cup (COC)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(124, 'Penky Martens Closed Cup (PMCC)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(125, 'Tag Closed Tester (TCT)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(126, 'Kinematic viscosity', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(127, 'Total Acid Number', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(128, 'Viscosity index', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(129, 'Water & sediments', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(130, 'Water content', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(131, 'Compatibility Test', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(132, 'Heating value', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(133, 'Pour Point', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(134, 'Proximate Analysis', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(135, 'Ash', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(136, 'Volatile Combustible Matter', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(137, 'Fixed Carbon (by difference)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(138, 'Dropping Point', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(139, 'Penetration Worked', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(140, 'Dry ERBP', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(141, 'Loss on Evaporation', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(142, 'Specific Gravity', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(143, 'Kinematic viscosity @ 100 °C', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(144, 'Drop Melting Point', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(145, 'Penetration, Needle', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(146, 'Softening point', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(147, 'Acid insoluble ash', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(148, 'Crude Fat', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(149, 'Crude Fiber', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(150, 'Crude Protein', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(151, 'Essential Oil content', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(152, 'Fixed Oil content', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(153, 'Total Ash', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(154, 'Phytochemical (alkloids, flavonoids, glycosides   saponins, sterols, tannins,triterpenes', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(155, 'Alkaloids', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(156, 'Flavonoids', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(157, 'Glycosides', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(158, 'Hydrogen Cyanide', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(159, 'Sterols', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(160, 'Triterpenes', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(161, 'Iodine value', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(162, 'Refractive Index', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(163, 'Saponification Value', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(164, 'Acid Value', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(165, 'Total Essential oil Content', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(166, 'Total Fixed Oil Content', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(167, 'Viscosity (Brookfield)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(168, 'Scavenging activity of plant extracts', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(169, 'Antioxidant activity of plant extracts', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(170, 'Caffeine', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(171, 'Catechol', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(172, 'Pyrogallol', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(173, 'Phosphorous', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(174, 'ß-Carotene', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(175, 'Vitamin A', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(176, 'Vitamin B1', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(177, 'Vitamin B2', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(178, 'Vitamin B6', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(179, 'Vitamin E', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(180, 'Camphor', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(181, 'Menthol', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(182, 'Retinoic Acid (Tretinoin)', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(183, 'Chemical resistance', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(184, 'Spot Test', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(185, 'Immersion Test', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(186, 'Density', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(187, 'Dry/Cure time', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(188, 'Fineness of Grind', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(189, 'Gloss Measurement', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06'),
(190, 'Pigment and Vehicle content', 1, '0000-00-00 00:00:00', '2015-01-27 17:29:06');

-- --------------------------------------------------------

--
-- Table structure for table `testname_method`
--

CREATE TABLE IF NOT EXISTS `testname_method` (
`id` int(11) NOT NULL,
  `testname_id` int(11) NOT NULL,
  `method_id` int(11) NOT NULL,
  `create_time` date NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testname_method`
--

INSERT INTO `testname_method` (`id`, `testname_id`, `method_id`, `create_time`, `update_time`) VALUES
(1, 1, 1, '0000-00-00', '2015-01-28 22:48:05'),
(2, 2, 2, '0000-00-00', '2015-01-28 22:49:00'),
(3, 3, 3, '0000-00-00', '2015-01-28 22:49:56'),
(4, 4, 4, '0000-00-00', '2015-01-28 22:50:48'),
(5, 31, 37, '0000-00-00', '2015-01-28 22:58:03'),
(6, 32, 37, '0000-00-00', '2015-01-28 22:59:40'),
(7, 33, 38, '0000-00-00', '2015-01-28 23:01:04'),
(8, 34, 39, '0000-00-00', '2015-01-28 23:02:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agency`
--
ALTER TABLE `agency`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agencythreshold`
--
ALTER TABLE `agencythreshold`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `analysis`
--
ALTER TABLE `analysis`
 ADD PRIMARY KEY (`id`), ADD KEY `sample_id` (`sample_id`), ADD KEY `testName_id` (`testName_id`), ADD KEY `methodReference_id` (`methodReference_id`);

--
-- Indexes for table `barangay`
--
ALTER TABLE `barangay`
 ADD PRIMARY KEY (`id`), ADD KEY `municipalityCityId` (`municipalityCityId`);

--
-- Indexes for table `businessnature`
--
ALTER TABLE `businessnature`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collectiontype`
--
ALTER TABLE `collectiontype`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
 ADD PRIMARY KEY (`id`), ADD KEY `region_id` (`region_id`), ADD KEY `province_id` (`province_id`), ADD KEY `municipalityCity_id` (`municipalityCity_id`), ADD KEY `barangay_id` (`barangay_id`), ADD KEY `type_id` (`type_id`), ADD KEY `nature_id` (`nature_id`), ADD KEY `industry_id` (`industry_id`);

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
-- Indexes for table `industrytype`
--
ALTER TABLE `industrytype`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab`
--
ALTER TABLE `lab`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_sampletype`
--
ALTER TABLE `lab_sampletype`
 ADD PRIMARY KEY (`id`), ADD KEY `lab_id` (`lab_id`), ADD KEY `sampletypeId` (`sampletypeId`);

--
-- Indexes for table `methodreference`
--
ALTER TABLE `methodreference`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
 ADD PRIMARY KEY (`version`);

--
-- Indexes for table `municipality_city`
--
ALTER TABLE `municipality_city`
 ADD PRIMARY KEY (`id`), ADD KEY `regionId` (`regionId`), ADD KEY `provinceId` (`provinceId`);

--
-- Indexes for table `orderofpayment`
--
ALTER TABLE `orderofpayment`
 ADD PRIMARY KEY (`id`), ADD KEY `customer_id` (`customer_id`), ADD KEY `collectiontype_id` (`collectiontype_id`), ADD KEY `agency_id` (`agency_id`);

--
-- Indexes for table `paymentitem`
--
ALTER TABLE `paymentitem`
 ADD PRIMARY KEY (`id`), ADD KEY `referral_id` (`referral_id`), ADD KEY `orderofpayment_id` (`orderofpayment_id`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
 ADD PRIMARY KEY (`id`), ADD KEY `regionId` (`regionId`);

--
-- Indexes for table `referral`
--
ALTER TABLE `referral`
 ADD PRIMARY KEY (`id`), ADD KEY `lab_id` (`lab_id`), ADD KEY `paymentType_id` (`paymentType_id`), ADD KEY `discount_id` (`discount_id`), ADD KEY `status` (`status`), ADD KEY `customer_id` (`customer_id`), ADD KEY `accepting_id` (`accepting_id`), ADD KEY `referred_by` (`referred_by`), ADD KEY `referred_to` (`referred_to`), ADD KEY `receivingAgencyId` (`receivingAgencyId`), ADD KEY `acceptingAgencyId` (`acceptingAgencyId`);

--
-- Indexes for table `referralstatus`
--
ALTER TABLE `referralstatus`
 ADD PRIMARY KEY (`id`), ADD KEY `referral_id` (`referral_id`), ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sample`
--
ALTER TABLE `sample`
 ADD PRIMARY KEY (`id`), ADD KEY `referral_id` (`referral_id`), ADD KEY `sampleType_id` (`sampleType_id`);

--
-- Indexes for table `sampletemplate`
--
ALTER TABLE `sampletemplate`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sampletype`
--
ALTER TABLE `sampletype`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sampletype_testname`
--
ALTER TABLE `sampletype_testname`
 ADD PRIMARY KEY (`id`), ADD KEY `sampletype_id` (`sampletype_id`,`testname_id`), ADD KEY `testname_id` (`testname_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
 ADD PRIMARY KEY (`id`), ADD KEY `agency_id` (`agency_id`), ADD KEY `testname_method_id` (`method_ref_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testname`
--
ALTER TABLE `testname`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testname_method`
--
ALTER TABLE `testname_method`
 ADD PRIMARY KEY (`id`), ADD KEY `testname_id` (`testname_id`), ADD KEY `method_id` (`method_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agency`
--
ALTER TABLE `agency`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `agencythreshold`
--
ALTER TABLE `agencythreshold`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `analysis`
--
ALTER TABLE `analysis`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `barangay`
--
ALTER TABLE `barangay`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `businessnature`
--
ALTER TABLE `businessnature`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `customertype`
--
ALTER TABLE `customertype`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `industrytype`
--
ALTER TABLE `industrytype`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `lab`
--
ALTER TABLE `lab`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `lab_sampletype`
--
ALTER TABLE `lab_sampletype`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `methodreference`
--
ALTER TABLE `methodreference`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=212;
--
-- AUTO_INCREMENT for table `municipality_city`
--
ALTER TABLE `municipality_city`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1633;
--
-- AUTO_INCREMENT for table `orderofpayment`
--
ALTER TABLE `orderofpayment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `paymentitem`
--
ALTER TABLE `paymentitem`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `referral`
--
ALTER TABLE `referral`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `referralstatus`
--
ALTER TABLE `referralstatus`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `sample`
--
ALTER TABLE `sample`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `sampletemplate`
--
ALTER TABLE `sampletemplate`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT for table `sampletype`
--
ALTER TABLE `sampletype`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `sampletype_testname`
--
ALTER TABLE `sampletype_testname`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `testname`
--
ALTER TABLE `testname`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=191;
--
-- AUTO_INCREMENT for table `testname_method`
--
ALTER TABLE `testname_method`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `analysis`
--
ALTER TABLE `analysis`
ADD CONSTRAINT `analysis_ibfk_1` FOREIGN KEY (`sample_id`) REFERENCES `sample` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barangay`
--
ALTER TABLE `barangay`
ADD CONSTRAINT `barangay_ibfk_1` FOREIGN KEY (`municipalityCityId`) REFERENCES `municipality_city` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`nature_id`) REFERENCES `businessnature` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`industry_id`) REFERENCES `industrytype` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `customer_ibfk_3` FOREIGN KEY (`type_id`) REFERENCES `customertype` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `customer_ibfk_4` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `customer_ibfk_5` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `customer_ibfk_6` FOREIGN KEY (`municipalityCity_id`) REFERENCES `municipality_city` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `customer_ibfk_7` FOREIGN KEY (`barangay_id`) REFERENCES `barangay` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `lab_sampletype`
--
ALTER TABLE `lab_sampletype`
ADD CONSTRAINT `lab_sampletype_ibfk_1` FOREIGN KEY (`lab_id`) REFERENCES `lab` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `lab_sampletype_ibfk_2` FOREIGN KEY (`sampletypeId`) REFERENCES `sampletype` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `municipality_city`
--
ALTER TABLE `municipality_city`
ADD CONSTRAINT `municipality_city_ibfk_1` FOREIGN KEY (`regionId`) REFERENCES `region` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `municipality_city_ibfk_2` FOREIGN KEY (`provinceId`) REFERENCES `province` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `orderofpayment`
--
ALTER TABLE `orderofpayment`
ADD CONSTRAINT `orderofpayment_ibfk_1` FOREIGN KEY (`collectiontype_id`) REFERENCES `collectiontype` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `orderofpayment_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `orderofpayment_ibfk_3` FOREIGN KEY (`agency_id`) REFERENCES `agency` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `paymentitem`
--
ALTER TABLE `paymentitem`
ADD CONSTRAINT `paymentitem_ibfk_2` FOREIGN KEY (`referral_id`) REFERENCES `referral` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `paymentitem_ibfk_3` FOREIGN KEY (`orderofpayment_id`) REFERENCES `orderofpayment` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `province`
--
ALTER TABLE `province`
ADD CONSTRAINT `province_ibfk_1` FOREIGN KEY (`regionId`) REFERENCES `region` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `referral`
--
ALTER TABLE `referral`
ADD CONSTRAINT `referral_ibfk_1` FOREIGN KEY (`lab_id`) REFERENCES `lab` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `referral_ibfk_2` FOREIGN KEY (`discount_id`) REFERENCES `discount` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `referral_ibfk_3` FOREIGN KEY (`receivingAgencyId`) REFERENCES `agency` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `referralstatus`
--
ALTER TABLE `referralstatus`
ADD CONSTRAINT `referralstatus_ibfk_1` FOREIGN KEY (`referral_id`) REFERENCES `referral` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `referralstatus_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `sample`
--
ALTER TABLE `sample`
ADD CONSTRAINT `sample_ibfk_1` FOREIGN KEY (`referral_id`) REFERENCES `referral` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `sampletype_testname`
--
ALTER TABLE `sampletype_testname`
ADD CONSTRAINT `sampletype_testname_ibfk_1` FOREIGN KEY (`sampletype_id`) REFERENCES `sampletype` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `sampletype_testname_ibfk_2` FOREIGN KEY (`testname_id`) REFERENCES `testname` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `service`
--
ALTER TABLE `service`
ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`agency_id`) REFERENCES `agency` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `testname_method`
--
ALTER TABLE `testname_method`
ADD CONSTRAINT `testname_method_ibfk_1` FOREIGN KEY (`testname_id`) REFERENCES `testname` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `testname_method_ibfk_2` FOREIGN KEY (`method_id`) REFERENCES `methodreference` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
