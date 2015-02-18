-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2015 at 01:45 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ulimsportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesslist`
--

CREATE TABLE IF NOT EXISTS `accesslist` (
`id` int(11) NOT NULL,
  `label` varchar(10) NOT NULL,
  `url` varchar(50) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accesslist`
--

INSERT INTO `accesslist` (`id`, `label`, `url`) VALUES
(1, 'Lab', '/lab/request/admin'),
(2, 'Cashier', '/cashier/receipt/admin'),
(3, 'LEIS', '/pmis/equipment/admin'),
(4, 'Accounting', '/accounting/orderofpayment/admin'),
(5, 'Referral', '/ref/referral/admin');

-- --------------------------------------------------------

--
-- Table structure for table `authassignment`
--

CREATE TABLE IF NOT EXISTS `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authassignment`
--

INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('Admin', '1', NULL, NULL),
('Lab - System Manager', '70', NULL, 'N;'),
('Cashier', '21', NULL, 'N;'),
('Lab - System Manager', '4', NULL, 'N;'),
('Lab - System Manager', '24', NULL, 'N;'),
('System Manager', '17', NULL, 'N;'),
('Cashier', '20', NULL, 'N;'),
('Lab - System Manager', '23', NULL, 'N;'),
('Lab - System Manager', '3', NULL, 'N;'),
('Lab - System Manager', '31', NULL, 'N;'),
('Lab - System Manager', '32', NULL, 'N;'),
('Lab - System Manager', '28', NULL, 'N;'),
('Lab - System Manager', '22', NULL, 'N;'),
('Lab - System Manager', '27', NULL, 'N;'),
('Lab - System Manager', '26', NULL, 'N;'),
('Lab - System Manager', '25', NULL, 'N;'),
('Lab - System Manager', '30', NULL, 'N;'),
('Lab - System Manager', '29', NULL, 'N;'),
('Lab - System Manager', '17', NULL, 'N;'),
('Lab - System Manager', '19', NULL, 'N;'),
('Lab - System Manager', '33', NULL, 'N;'),
('Lab - System Manager', '34', NULL, 'N;'),
('Lab - System Manager', '35', NULL, 'N;'),
('Lab - System Manager', '36', NULL, 'N;'),
('Lab - System Manager', '37', NULL, 'N;'),
('Lab - System Manager', '38', NULL, 'N;'),
('Lab - System Manager', '39', NULL, 'N;'),
('Lab - System Manager', '40', NULL, 'N;'),
('Lab - System Manager', '41', NULL, 'N;'),
('Lab - System Manager', '42', NULL, 'N;'),
('Lab - System Manager', '43', NULL, 'N;'),
('Lab - System Manager', '44', NULL, 'N;'),
('Cashier', '45', NULL, 'N;'),
('Cashier', '46', NULL, 'N;'),
('Cashier', '47', NULL, 'N;'),
('Cashier', '48', NULL, 'N;'),
('Cashier', '49', NULL, 'N;'),
('Cashier', '50', NULL, 'N;'),
('Cashier', '51', NULL, 'N;'),
('Cashier', '52', NULL, 'N;'),
('Cashier', '53', NULL, 'N;'),
('Cashier', '54', NULL, 'N;'),
('Cashier', '55', NULL, 'N;'),
('Cashier', '56', NULL, 'N;'),
('Cashier', '57', NULL, 'N;'),
('Cashier', '58', NULL, 'N;'),
('Cashier', '59', NULL, 'N;'),
('Cashier', '60', NULL, 'N;'),
('Cashier', '61', NULL, 'N;'),
('Cashier', '62', NULL, 'N;'),
('Cashier', '63', NULL, 'N;'),
('Cashier', '64', NULL, 'N;'),
('Cashier', '65', NULL, 'N;'),
('Cashier', '66', NULL, 'N;'),
('Cashier', '67', NULL, 'N;'),
('Accounting - Manager', '69', NULL, 'N;'),
('Lab - User', '18', NULL, 'N;'),
('Lab - System Manager', '71', NULL, 'N;'),
('Lab - System Manager', '72', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `AuthItem`
--

CREATE TABLE IF NOT EXISTS `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `AuthItem`
--

INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('Admin', 2, 'Admin', NULL, 'N;'),
('Guest', 2, 'Guest', NULL, 'N;'),
('Agency Head', 2, 'Agency Head', NULL, 'N;'),
('ActiveRecordLog.*', 1, NULL, NULL, 'N;'),
('Lab.Package.Index', 0, NULL, NULL, 'N;'),
('Site.*', 1, NULL, NULL, 'N;'),
('User.Activation.*', 1, NULL, NULL, 'N;'),
('User.Admin.*', 1, NULL, NULL, 'N;'),
('User.Default.*', 1, NULL, NULL, 'N;'),
('User.Login.*', 1, NULL, NULL, 'N;'),
('User.Logout.*', 1, NULL, NULL, 'N;'),
('User.Profile.*', 1, NULL, NULL, 'N;'),
('User.ProfileField.*', 1, NULL, NULL, 'N;'),
('User.Recovery.*', 1, NULL, NULL, 'N;'),
('User.Registration.*', 1, NULL, NULL, 'N;'),
('User.User.*', 1, NULL, NULL, 'N;'),
('ActiveRecordLog.View', 0, NULL, NULL, 'N;'),
('ActiveRecordLog.Create', 0, NULL, NULL, 'N;'),
('ActiveRecordLog.Update', 0, NULL, NULL, 'N;'),
('ActiveRecordLog.Delete', 0, NULL, NULL, 'N;'),
('ActiveRecordLog.Index', 0, NULL, NULL, 'N;'),
('ActiveRecordLog.Admin', 0, NULL, NULL, 'N;'),
('Lab.Package.Update', 0, NULL, NULL, 'N;'),
('Lab.Package.Create', 0, NULL, NULL, 'N;'),
('Lab.Package.View', 0, NULL, NULL, 'N;'),
('Lab.Initializecode.Admin', 0, NULL, NULL, 'N;'),
('Lab.Initializecode.Update', 0, NULL, NULL, 'N;'),
('Lab.Initializecode.Create', 0, NULL, NULL, 'N;'),
('Site.Index', 0, NULL, NULL, 'N;'),
('Site.Status', 0, NULL, NULL, 'N;'),
('Site.Error', 0, NULL, NULL, 'N;'),
('Site.Contact', 0, NULL, NULL, 'N;'),
('Site.Login', 0, NULL, NULL, 'N;'),
('Site.Logout', 0, NULL, NULL, 'N;'),
('User.Activation.Activation', 0, NULL, NULL, 'N;'),
('User.Admin.Admin', 0, NULL, NULL, 'N;'),
('User.Admin.View', 0, NULL, NULL, 'N;'),
('User.Admin.Create', 0, NULL, NULL, 'N;'),
('User.Admin.Update', 0, NULL, NULL, 'N;'),
('User.Admin.Delete', 0, NULL, NULL, 'N;'),
('User.Default.Index', 0, NULL, NULL, 'N;'),
('User.Login.Login', 0, NULL, NULL, 'N;'),
('User.Logout.Logout', 0, NULL, NULL, 'N;'),
('User.Profile.Profile', 0, NULL, NULL, 'N;'),
('User.Profile.Edit', 0, NULL, NULL, 'N;'),
('User.Profile.Changepassword', 0, NULL, NULL, 'N;'),
('User.ProfileField.View', 0, NULL, NULL, 'N;'),
('User.ProfileField.Create', 0, NULL, NULL, 'N;'),
('User.ProfileField.Update', 0, NULL, NULL, 'N;'),
('User.ProfileField.Delete', 0, NULL, NULL, 'N;'),
('User.ProfileField.Admin', 0, NULL, NULL, 'N;'),
('User.Recovery.Recovery', 0, NULL, NULL, 'N;'),
('User.Registration.Registration', 0, NULL, NULL, 'N;'),
('User.User.View', 0, NULL, NULL, 'N;'),
('User.User.Index', 0, NULL, NULL, 'N;'),
('Lab.Initializecode.View', 0, NULL, NULL, 'N;'),
('Lab.Lab.Admin', 0, NULL, NULL, 'N;'),
('Lab.Lab.Update', 0, NULL, NULL, 'N;'),
('Lab.Lab.Create', 0, NULL, NULL, 'N;'),
('Lab.Lab.View', 0, NULL, NULL, 'N;'),
('Cashier.Lastor.Admin', 0, NULL, NULL, 'N;'),
('Cashier.Lastor.Update', 0, NULL, NULL, 'N;'),
('Cashier.Lastor.Create', 0, NULL, NULL, 'N;'),
('Cashier.Lastor.View', 0, NULL, NULL, 'N;'),
('Lab.Customer.getBarangay', 1, 'Lab.Customer.getBarangay', NULL, 'N;'),
('Lab.Customer.getProvince', 1, 'Lab.Customer.getProvince', NULL, 'N;'),
('Lab.Customer.getMunicipalityCity', 1, 'Lab.Customer.getMunicipalityCity', NULL, 'N;'),
('Cashier.Deposit.exportCashReceiptsRecord', 1, 'Cashier.Deposit.exportCashReceiptsRecord', NULL, 'N;'),
('Cashier.Deposit.getFirstOr', 1, 'Cashier.Deposit.getFirstOr', NULL, 'N;'),
('Cashier.Deposit.updateDropdown', 1, 'Cashier.Deposit.updateDropdown', NULL, 'N;'),
('Cashier.Deposit.orTotal', 1, 'Cashier.Deposit.orTotal', NULL, 'N;'),
('Cashier.Receipt.exportReportOfCollection', 1, 'Cashier.Receipt.exportReportOfCollection', NULL, 'N;'),
('Cashier.Receipt.printExcel', 1, 'Cashier.Receipt.printExcel', NULL, 'N;'),
('Cashier.Receipt.searchPayor', 1, 'Cashier.Receipt.searchPayor', NULL, 'N;'),
('Cashier.Reportcashier.Admin', 0, NULL, NULL, 'N;'),
('Cashier.Reportcashier.Index', 0, NULL, NULL, 'N;'),
('Cashier.Reportcashier.Delete', 0, NULL, NULL, 'N;'),
('Cashier.Reportcashier.Update', 0, NULL, NULL, 'N;'),
('Cashier.Reportcashier.Create', 0, NULL, NULL, 'N;'),
('Cashier.Reportcashier.View', 0, NULL, NULL, 'N;'),
('Cashier.Receipt.ReportOfCollection', 0, NULL, NULL, 'N;'),
('Cashier.Receipt.Admin', 0, NULL, NULL, 'N;'),
('Cashier.Receipt.Cancel', 0, NULL, NULL, 'N;'),
('Cashier.Receipt.Index', 0, NULL, NULL, 'N;'),
('Cashier.Receipt.Delete', 0, NULL, NULL, 'N;'),
('Cashier.Receipt.Update', 0, NULL, NULL, 'N;'),
('Cashier.Receipt.Create', 0, NULL, NULL, 'N;'),
('Cashier.Receipt.View', 0, NULL, NULL, 'N;'),
('Cashier.Deposit.CashReceiptsRecord', 0, NULL, NULL, 'N;'),
('Cashier.Deposit.Admin', 0, NULL, NULL, 'N;'),
('Cashier.Deposit.Index', 0, NULL, NULL, 'N;'),
('Cashier.Deposit.Delete', 0, NULL, NULL, 'N;'),
('Lab - System Manager', 2, 'Lab - System Manager', NULL, 'N;'),
('Lab - User', 2, 'Lab - User', NULL, 'N;'),
('Cashier.Deposit.Create', 0, NULL, NULL, 'N;'),
('Cashier.Deposit.Update', 0, NULL, NULL, 'N;'),
('Cashier.Deposit.View', 0, NULL, NULL, 'N;'),
('Cashier.Collection.SearchRequest', 0, NULL, NULL, 'N;'),
('Cashier.Collection.Admin', 0, NULL, NULL, 'N;'),
('Cashier.Collection.Index', 0, NULL, NULL, 'N;'),
('Cashier.Collection.Delete', 0, NULL, NULL, 'N;'),
('Cashier.Collection.Update', 0, NULL, NULL, 'N;'),
('Cashier.Collection.Create', 0, NULL, NULL, 'N;'),
('Cashier.Check.Admin', 0, NULL, NULL, 'N;'),
('Cashier.Collection.View', 0, NULL, NULL, 'N;'),
('Cashier.Check.Index', 0, NULL, NULL, 'N;'),
('Cashier.Check.Delete', 0, NULL, NULL, 'N;'),
('Cashier.Check.Update', 0, NULL, NULL, 'N;'),
('Cashier.Check.Create', 0, NULL, NULL, 'N;'),
('Cashier.Check.View', 0, NULL, NULL, 'N;'),
('Cashier', 2, 'Cashier - Manager', NULL, 'N;'),
('Lab.Analysis.getPackageDetails', 1, 'Lab.Analysis.getPackageDetails', NULL, 'N;'),
('Lab.Analysis.getPackages', 1, 'Lab.Analysis.getPackages', NULL, 'N;'),
('Lab.Analysis.Package', 0, NULL, NULL, 'N;'),
('Lab.Request.searchCustomer', 1, 'Lab.Request.searchCustomer', NULL, 'N;'),
('Lab.Request.searchSample', 1, 'Lab.Request.searchSample', NULL, 'N;'),
('Lab.Sample.confirm', 1, 'Lab.Sample.confirm', NULL, 'N;'),
('Lab.Analysis.getAnalysisdetails', 1, 'Lab.Analysis.getAnalysisdetails', NULL, 'N;'),
('Lab.Analysis.getAnalysis', 1, 'Lab.Analysis.getAnalysis', NULL, 'N;'),
('Lab.Analysis.getCategorytype', 1, 'Lab.Analysis.getCategorytype', NULL, 'N;'),
('Lab.Analysis.getSampletype', 1, 'Lab.Analysis.getSampletype', NULL, 'N;'),
('Lab.Accomplishments.ExportSummary', 1, 'Lab.Accomplishments.ExportSummary', NULL, 'N;'),
('Lab.Accomplishments.ExportConso', 1, 'Lab.Accomplishments.ExportConso', NULL, 'N;'),
('Lab.Request.genRequestExcel', 1, 'Lab.Request.genRequestExcel', NULL, 'N;'),
('Lab.Sample.searchSample', 1, 'Lab.Sample.searchSample', NULL, 'N;'),
('Phaddress.Default.Index', 0, NULL, NULL, 'N;'),
('Lab.Test.SampleType', 0, NULL, NULL, 'N;'),
('Lab.Test.Admin', 0, NULL, NULL, 'N;'),
('Lab.Test.Index', 0, NULL, NULL, 'N;'),
('Lab.Test.Delete', 0, NULL, NULL, 'N;'),
('Lab.Test.Update', 0, NULL, NULL, 'N;'),
('Lab.Test.Create', 0, NULL, NULL, 'N;'),
('Lab.Test.View', 0, NULL, NULL, 'N;'),
('Lab.Statistic.Customer', 0, NULL, NULL, 'N;'),
('Lab.Statistic.Index', 0, NULL, NULL, 'N;'),
('Lab.Sample.GenerateSampleCode', 0, NULL, NULL, 'N;'),
('Lab.Sample.Admin', 0, NULL, NULL, 'N;'),
('Lab.Sample.Index', 0, NULL, NULL, 'N;'),
('LEIS - System Manager', 2, 'LEIS - System Manager', NULL, 'N;'),
('LEIS - User', 2, 'LEIS - User', NULL, 'N;'),
('Leis.Default.*', 1, NULL, NULL, 'N;'),
('Leis.Equipment.*', 1, NULL, NULL, 'N;'),
('Leis.Default.Index', 0, NULL, NULL, 'N;'),
('Leis.Equipment.View', 0, NULL, NULL, 'N;'),
('Leis.Equipment.Create', 0, NULL, NULL, 'N;'),
('Leis.Equipment.Update', 0, NULL, NULL, 'N;'),
('Leis.Equipment.Delete', 0, NULL, NULL, 'N;'),
('Leis.Equipment.Index', 0, NULL, NULL, 'N;'),
('Leis.Equipment.Admin', 0, NULL, NULL, 'N;'),
('Lab.Sample.Cancel', 0, NULL, NULL, 'N;'),
('Lab.Sample.Delete', 0, NULL, NULL, 'N;'),
('Lab.Sample.Update', 0, NULL, NULL, 'N;'),
('Lab.Sample.Create', 0, NULL, NULL, 'N;'),
('Lab.Sample.View', 0, NULL, NULL, 'N;'),
('Lab.Request.Admin', 0, NULL, NULL, 'N;'),
('Lab.Request.Index', 0, NULL, NULL, 'N;'),
('Lab.Request.Cancel', 0, NULL, NULL, 'N;'),
('Lab.Request.Delete', 0, NULL, NULL, 'N;'),
('Lab.Request.Update', 0, NULL, NULL, 'N;'),
('Lab.Request.Create', 0, NULL, NULL, 'N;'),
('Lab.Request.View', 0, NULL, NULL, 'N;'),
('Lab.Default.Index', 0, NULL, NULL, 'N;'),
('Lab.Customer.Admin', 0, NULL, NULL, 'N;'),
('Lab.Customer.Index', 0, NULL, NULL, 'N;'),
('Lab.Customer.Delete', 0, NULL, NULL, 'N;'),
('Lab.Customer.Update', 0, NULL, NULL, 'N;'),
('Lab.Customer.Create', 0, NULL, NULL, 'N;'),
('Lab.Customer.View', 0, NULL, NULL, 'N;'),
('Lab.Analysis.Admin', 0, NULL, NULL, 'N;'),
('Lab.Analysis.Index', 0, NULL, NULL, 'N;'),
('Lab.Analysis.Cancel', 0, NULL, NULL, 'N;'),
('Lab.Analysis.Delete', 0, NULL, NULL, 'N;'),
('Lab.Analysis.Update', 0, NULL, NULL, 'N;'),
('Lab.Analysis.Create', 0, NULL, NULL, 'N;'),
('Lab.Analysis.View', 0, NULL, NULL, 'N;'),
('Lab.Accomplishments.Summary', 0, NULL, NULL, 'N;'),
('Lab.Accomplishments.UpdateConso', 0, NULL, NULL, 'N;'),
('Lab.Accomplishments.Consolidated', 0, NULL, NULL, 'N;'),
('Lab.Accomplishments.Indexes', 0, NULL, NULL, 'N;'),
('Lab.Accomplishments.Index', 0, NULL, NULL, 'N;'),
('Phaddress.Default.*', 1, NULL, NULL, 'N;'),
('Lab.Test.*', 1, NULL, NULL, 'N;'),
('Lab.Statistic.*', 1, NULL, NULL, 'N;'),
('Lab.Sample.*', 1, NULL, NULL, 'N;'),
('Lab.Request.*', 1, NULL, NULL, 'N;'),
('Lab.Default.*', 1, NULL, NULL, 'N;'),
('Lab.Customer.*', 1, NULL, NULL, 'N;'),
('Lab.Analysis.*', 1, NULL, NULL, 'N;'),
('Lab.Accomplishments.*', 1, NULL, NULL, 'N;'),
('Lab.Package.Admin', 0, NULL, NULL, 'N;'),
('Lab.Package.UpdateTestGrid', 0, NULL, NULL, 'N;'),
('Lab.Package.getSampletype', 1, 'Lab.Package.getSampletype', NULL, 'N;'),
('Lab.Package.getTest', 1, 'Lab.Package.getTest', NULL, 'N;'),
('Lab.Sampletype.View', 0, NULL, NULL, 'N;'),
('Lab.Sampletype.Create', 0, NULL, NULL, 'N;'),
('Lab.Sampletype.Update', 0, NULL, NULL, 'N;'),
('Lab.Sampletype.Index', 0, NULL, NULL, 'N;'),
('Lab.Sampletype.Admin', 0, NULL, NULL, 'N;'),
('Lab.Testcategory.View', 0, NULL, NULL, 'N;'),
('Lab.Testcategory.Create', 0, NULL, NULL, 'N;'),
('Lab.Testcategory.Update', 0, NULL, NULL, 'N;'),
('Lab.Testcategory.Index', 0, NULL, NULL, 'N;'),
('Lab.Testcategory.Admin', 0, NULL, NULL, 'N;'),
('Lab.Requestcode.Create', 0, NULL, NULL, 'N;'),
('Lab.Requestcode.Update', 0, NULL, NULL, 'N;'),
('Lab.Requestcode.Delete', 0, NULL, NULL, 'N;'),
('Lab.Requestcode.Admin', 0, NULL, NULL, 'N;'),
('Lab.Requestcode.Test', 0, NULL, NULL, 'N;'),
('Lab.Config.Index', 0, NULL, NULL, 'N;'),
('Config.Index', 0, NULL, NULL, 'N;'),
('Config.Admin', 0, NULL, NULL, 'N;'),
('Cashier - User', 2, 'Cashier - User', NULL, 'N;'),
('Accounting - Manager', 2, 'Accountant', NULL, 'N;'),
('Accounting - User', 2, 'Accounting Clerk', NULL, 'N;'),
('Accounting.Orderofpayment.View', 0, NULL, NULL, 'N;'),
('Accounting.Orderofpayment.Create', 0, NULL, NULL, 'N;'),
('Accounting.Orderofpayment.Update', 0, NULL, NULL, 'N;'),
('Accounting.Orderofpayment.Delete', 0, NULL, NULL, 'N;'),
('Accounting.Orderofpayment.Index', 0, NULL, NULL, 'N;'),
('Accounting.Orderofpayment.Admin', 0, NULL, NULL, 'N;'),
('Accounting.Orderofpayment.searchPayor', 1, 'Accounting.Orderofpayment.searchPayor', NULL, 'N;'),
('Cashier.Orcategory.View', 0, NULL, NULL, 'N;'),
('Cashier.Orcategory.Create', 0, NULL, NULL, 'N;'),
('Cashier.Orcategory.Update', 0, NULL, NULL, 'N;'),
('Cashier.Orcategory.Delete', 0, NULL, NULL, 'N;'),
('Cashier.Orcategory.Index', 0, NULL, NULL, 'N;'),
('Cashier.Orcategory.Admin', 0, NULL, NULL, 'N;'),
('Cashier.Orcategory.Manage', 0, NULL, NULL, 'N;'),
('Cashier.Orseries.View', 0, NULL, NULL, 'N;'),
('Cashier.Orseries.Create', 0, NULL, NULL, 'N;'),
('Cashier.Orseries.Update', 0, NULL, NULL, 'N;'),
('Cashier.Orseries.Delete', 0, NULL, NULL, 'N;'),
('Cashier.Orseries.Index', 0, NULL, NULL, 'N;'),
('Cashier.Receipt.NextOR', 0, NULL, NULL, 'N;'),
('Cashier.Orseries.Admin', 0, NULL, NULL, 'N;'),
('Accounting.Paymentitem.View', 0, NULL, NULL, 'N;'),
('Accounting.Paymentitem.Create', 0, NULL, NULL, 'N;'),
('Accounting.Paymentitem.Update', 0, NULL, NULL, 'N;'),
('Accounting.Paymentitem.Index', 0, NULL, NULL, 'N;'),
('Accounting.Paymentitem.Admin', 0, NULL, NULL, 'N;'),
('Accounting.Paymentitem.SearchRequest', 0, NULL, NULL, 'N;'),
('Accounting.Orderofpayment.printExcel', 1, 'Accounting.Orderofpayment.printExcel', NULL, 'N;'),
('Cashier.Orderofpayment.View', 0, NULL, NULL, 'N;'),
('Cashier.Orderofpayment.Admin', 0, NULL, NULL, 'N;'),
('Cashier.Receipt.CreateReceiptFromOP', 0, NULL, NULL, 'N;'),
('Lab.Request.CreateOP', 0, NULL, NULL, 'N;'),
('Lab.Request.UpdateRequestGrid', 0, NULL, NULL, 'N;'),
('Lab.Request.SearchRequests', 0, NULL, NULL, 'N;'),
('Accounting.Orderofpayment.CreateOPFromRequests', 0, NULL, NULL, 'N;'),
('Accounting.Orderofpayment.SearchRequests', 0, NULL, NULL, 'N;'),
('Cashier.Orderofpayment.Create', 0, NULL, NULL, 'N;'),
('Lab.Orderofpayment.View', 0, NULL, NULL, 'N;'),
('Lab.Orderofpayment.Create', 0, NULL, NULL, 'N;'),
('Lab.Orderofpayment.Admin', 0, NULL, NULL, 'N;'),
('Lab.Orderofpayment.SearchRequests', 0, NULL, NULL, 'N;'),
('Lab.Orderofpayment.PrintExcel', 0, NULL, NULL, 'N;'),
('Lab.Cancelledrequest.Create', 0, NULL, NULL, 'N;'),
('Lab.Cancelledrequest.Update', 0, NULL, NULL, 'N;'),
('Lab.Cancelledrequest.Admin', 0, NULL, NULL, 'N;'),
('Lab.Samplename.View', 0, NULL, NULL, 'N;'),
('Lab.Samplename.Create', 0, NULL, NULL, 'N;'),
('Lab.Samplename.Update', 0, NULL, NULL, 'N;'),
('Lab.Samplename.Delete', 0, NULL, NULL, 'N;'),
('Lab.Samplename.Admin', 0, NULL, NULL, 'N;'),
('Lab.Request.PaymentDetail', 0, NULL, NULL, 'N;'),
('Lab.Referral.Admin', 0, NULL, NULL, 'N;'),
('Lab.Referral.View', 0, NULL, NULL, 'N;'),
('Lab.Referral.Create', 0, NULL, NULL, 'N;'),
('Lab.Referral.Update', 0, NULL, NULL, 'N;'),
('Lab.Orderofpayment.UpdateAmount', 0, NULL, NULL, 'N;'),
('Lab.Request.Import', 0, NULL, NULL, 'N;'),
('Lab.Request.ImportRequestDetail', 0, NULL, NULL, 'N;'),
('Lab.Request.ImportRequest', 0, NULL, NULL, 'N;'),
('Lab.Request.LoadFile', 0, NULL, NULL, 'N;'),
('Ref.Referral.View', 0, NULL, NULL, 'N;'),
('Ref.Referral.Create', 0, NULL, NULL, 'N;'),
('Ref.Referral.Update', 0, NULL, NULL, 'N;'),
('Ref.Referral.Admin', 0, NULL, NULL, 'N;'),
('Ref.Sample.Create', 0, NULL, NULL, 'N;'),
('Ref.Sample.Update', 0, NULL, NULL, 'N;'),
('Ref.Client.View', 0, NULL, NULL, 'N;'),
('Ref.Client.Create', 0, NULL, NULL, 'N;'),
('Ref.Client.Update', 0, NULL, NULL, 'N;'),
('Ref.Client.Delete', 0, NULL, NULL, 'N;'),
('Ref.Client.Admin', 0, NULL, NULL, 'N;'),
('Ref.Sample.Delete', 0, NULL, NULL, 'N;'),
('Ref.Testconducted.View', 0, NULL, NULL, 'N;'),
('Ref.Testconducted.Create', 0, NULL, NULL, 'N;'),
('Ref.Testconducted.Update', 0, NULL, NULL, 'N;'),
('Ref.Testconducted.Delete', 0, NULL, NULL, 'N;'),
('Ref.Testlist.View', 0, NULL, NULL, 'N;'),
('Ref.Testlist.Create', 0, NULL, NULL, 'N;'),
('Ref.Testlist.Update', 0, NULL, NULL, 'N;'),
('Ref.Testlist.Delete', 0, NULL, NULL, 'N;'),
('Ref.Testlist.Admin', 0, NULL, NULL, 'N;'),
('Lab.Request.ImportData', 0, NULL, NULL, 'N;'),
('Ref.Referral.SearchAgency', 0, NULL, NULL, 'N;'),
('Ref.Referral.Send', 0, NULL, NULL, 'N;'),
('Ref.Analysis.View', 0, NULL, NULL, 'N;'),
('Ref.Analysis.Create', 0, NULL, NULL, 'N;'),
('Ref.Analysis.Update', 0, NULL, NULL, 'N;'),
('Ref.Analysis.Delete', 0, NULL, NULL, 'N;'),
('Ref.Analysis.GetTestName', 0, NULL, NULL, 'N;'),
('Ref.Analysis.GetMethodReference', 0, NULL, NULL, 'N;'),
('Ref.Analysis.GetAnalysisdetails', 0, NULL, NULL, 'N;'),
('Ref.Customer.View', 0, NULL, NULL, 'N;'),
('Ref.Customer.Create', 0, NULL, NULL, 'N;'),
('Ref.Customer.Update', 0, NULL, NULL, 'N;'),
('Ref.Customer.Admin', 0, NULL, NULL, 'N;'),
('Ref.Customer.getBarangay', 1, 'Ref.Customer.getBarangay', NULL, 'N;'),
('Ref.Customer.getProvince', 1, 'Ref.Customer.getProvince', NULL, 'N;'),
('Ref.Customer.getMunicipalityCity', 1, 'Ref.Customer.getMunicipalityCity', NULL, 'N;'),
('Ref.LabService.Admin', 0, NULL, NULL, 'N;'),
('Ref.LabService.ActivateService', 0, NULL, NULL, 'N;'),
('Ref.LabService.DeactivateService', 0, NULL, NULL, 'N;'),
('Ref.Referralstatus.Create', 0, NULL, NULL, 'N;'),
('Ref.Referralstatus.Update', 0, NULL, NULL, 'N;'),
('Ref.Referralstatus.UpdateStatus', 0, NULL, NULL, 'N;'),
('Cashier.Orderofpayment.Update', 0, NULL, NULL, 'N;'),
('Lab.Orderofpayment.Update', 0, NULL, NULL, 'N;'),
('Ref.Customer.SearchLocalCustomer', 0, NULL, NULL, 'N;'),
('Ref.Orderofpayment.View', 0, NULL, NULL, 'N;'),
('Ref.Orderofpayment.Create', 0, NULL, NULL, 'N;'),
('Ref.Orderofpayment.Admin', 0, NULL, NULL, 'N;'),
('Ref.Orderofpayment.SearchRequests', 0, NULL, NULL, 'N;'),
('Ref.Orderofpayment.UpdateAmount', 0, NULL, NULL, 'N;'),
('Ref.Orderofpayment.SearchReferrals', 0, NULL, NULL, 'N;'),
('Ref.Result.View', 0, NULL, NULL, 'N;'),
('Ref.Result.Create', 0, NULL, NULL, 'N;'),
('Ref.Result.Update', 0, NULL, NULL, 'N;'),
('Ref.Result.Index', 0, NULL, NULL, 'N;'),
('Ref.Result.Admin', 0, NULL, NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `AuthItemChild`
--

CREATE TABLE IF NOT EXISTS `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `AuthItemChild`
--

INSERT INTO `AuthItemChild` (`parent`, `child`) VALUES
('Accounting - Manager', 'Accounting.Orderofpayment.Admin'),
('Accounting - Manager', 'Accounting.Orderofpayment.Create'),
('Accounting - Manager', 'Accounting.Orderofpayment.Index'),
('Accounting - Manager', 'Accounting.Orderofpayment.printExcel'),
('Accounting - Manager', 'Accounting.Orderofpayment.searchPayor'),
('Accounting - Manager', 'Accounting.Orderofpayment.Update'),
('Accounting - Manager', 'Accounting.Orderofpayment.View'),
('Accounting - Manager', 'Accounting.Paymentitem.Create'),
('Accounting - Manager', 'Accounting.Paymentitem.SearchRequest'),
('Accounting - Manager', 'Accounting.Paymentitem.Update'),
('Accounting - User', 'Accounting.Orderofpayment.Admin'),
('Accounting - User', 'Accounting.Orderofpayment.Create'),
('Accounting - User', 'Accounting.Orderofpayment.Index'),
('Accounting - User', 'Accounting.Orderofpayment.printExcel'),
('Accounting - User', 'Accounting.Orderofpayment.searchPayor'),
('Accounting - User', 'Accounting.Orderofpayment.Update'),
('Accounting - User', 'Accounting.Orderofpayment.View'),
('Accounting - User', 'Accounting.Paymentitem.SearchRequest'),
('Accounting - User', 'Accounting.Paymentitem.Update'),
('Cashier', 'Cashier.Check.Admin'),
('Cashier', 'Cashier.Check.Create'),
('Cashier', 'Cashier.Check.Index'),
('Cashier', 'Cashier.Check.Update'),
('Cashier', 'Cashier.Check.View'),
('Cashier', 'Cashier.Collection.Admin'),
('Cashier', 'Cashier.Collection.Create'),
('Cashier', 'Cashier.Collection.Index'),
('Cashier', 'Cashier.Collection.SearchRequest'),
('Cashier', 'Cashier.Collection.Update'),
('Cashier', 'Cashier.Collection.View'),
('Cashier', 'Cashier.Deposit.Admin'),
('Cashier', 'Cashier.Deposit.CashReceiptsRecord'),
('Cashier', 'Cashier.Deposit.Create'),
('Cashier', 'Cashier.Deposit.exportCashReceiptsRecord'),
('Cashier', 'Cashier.Deposit.getFirstOr'),
('Cashier', 'Cashier.Deposit.Index'),
('Cashier', 'Cashier.Deposit.orTotal'),
('Cashier', 'Cashier.Deposit.Update'),
('Cashier', 'Cashier.Deposit.updateDropdown'),
('Cashier', 'Cashier.Deposit.View'),
('Cashier', 'Cashier.Lastor.Admin'),
('Cashier', 'Cashier.Lastor.Create'),
('Cashier', 'Cashier.Lastor.View'),
('Cashier', 'Cashier.Orcategory.Admin'),
('Cashier', 'Cashier.Orcategory.Create'),
('Cashier', 'Cashier.Orcategory.Delete'),
('Cashier', 'Cashier.Orcategory.Index'),
('Cashier', 'Cashier.Orcategory.Manage'),
('Cashier', 'Cashier.Orcategory.Update'),
('Cashier', 'Cashier.Orcategory.View'),
('Cashier', 'Cashier.Orderofpayment.Admin'),
('Cashier', 'Cashier.Orderofpayment.View'),
('Cashier', 'Cashier.Orseries.Admin'),
('Cashier', 'Cashier.Orseries.Create'),
('Cashier', 'Cashier.Orseries.Index'),
('Cashier', 'Cashier.Orseries.Update'),
('Cashier', 'Cashier.Orseries.View'),
('Cashier', 'Cashier.Receipt.Admin'),
('Cashier', 'Cashier.Receipt.Cancel'),
('Cashier', 'Cashier.Receipt.Create'),
('Cashier', 'Cashier.Receipt.CreateReceiptFromOP'),
('Cashier', 'Cashier.Receipt.exportReportOfCollection'),
('Cashier', 'Cashier.Receipt.Index'),
('Cashier', 'Cashier.Receipt.NextOR'),
('Cashier', 'Cashier.Receipt.printExcel'),
('Cashier', 'Cashier.Receipt.ReportOfCollection'),
('Cashier', 'Cashier.Receipt.searchPayor'),
('Cashier', 'Cashier.Receipt.Update'),
('Cashier', 'Cashier.Receipt.View'),
('Cashier', 'Lab.Orderofpayment.Update'),
('Cashier - User', 'Cashier.Orderofpayment.Admin'),
('Cashier - User', 'Cashier.Orderofpayment.View'),
('Cashier - User', 'Cashier.Receipt.CreateReceiptFromOP'),
('Lab - System Manager', 'Accounting.Orderofpayment.CreateOPFromRequests'),
('Lab - System Manager', 'Accounting.Orderofpayment.SearchRequests'),
('Lab - System Manager', 'Config.Admin'),
('Lab - System Manager', 'Config.Index'),
('Lab - System Manager', 'Lab.Accomplishments.*'),
('Lab - System Manager', 'Lab.Accomplishments.Consolidated'),
('Lab - System Manager', 'Lab.Accomplishments.ExportConso'),
('Lab - System Manager', 'Lab.Accomplishments.ExportSummary'),
('Lab - System Manager', 'Lab.Accomplishments.Index'),
('Lab - System Manager', 'Lab.Accomplishments.Indexes'),
('Lab - System Manager', 'Lab.Accomplishments.Summary'),
('Lab - System Manager', 'Lab.Accomplishments.UpdateConso'),
('Lab - System Manager', 'Lab.Analysis.Admin'),
('Lab - System Manager', 'Lab.Analysis.Cancel'),
('Lab - System Manager', 'Lab.Analysis.Create'),
('Lab - System Manager', 'Lab.Analysis.Delete'),
('Lab - System Manager', 'Lab.Analysis.getAnalysis'),
('Lab - System Manager', 'Lab.Analysis.getAnalysisdetails'),
('Lab - System Manager', 'Lab.Analysis.getCategorytype'),
('Lab - System Manager', 'Lab.Analysis.getPackageDetails'),
('Lab - System Manager', 'Lab.Analysis.getPackages'),
('Lab - System Manager', 'Lab.Analysis.getSampletype'),
('Lab - System Manager', 'Lab.Analysis.Index'),
('Lab - System Manager', 'Lab.Analysis.Package'),
('Lab - System Manager', 'Lab.Analysis.Update'),
('Lab - System Manager', 'Lab.Analysis.View'),
('Lab - System Manager', 'Lab.Cancelledrequest.Admin'),
('Lab - System Manager', 'Lab.Cancelledrequest.Create'),
('Lab - System Manager', 'Lab.Cancelledrequest.Update'),
('Lab - System Manager', 'Lab.Customer.Admin'),
('Lab - System Manager', 'Lab.Customer.Create'),
('Lab - System Manager', 'Lab.Customer.getBarangay'),
('Lab - System Manager', 'Lab.Customer.getMunicipalityCity'),
('Lab - System Manager', 'Lab.Customer.getProvince'),
('Lab - System Manager', 'Lab.Customer.Index'),
('Lab - System Manager', 'Lab.Customer.Update'),
('Lab - System Manager', 'Lab.Customer.View'),
('Lab - System Manager', 'Lab.Default.Index'),
('Lab - System Manager', 'Lab.Initializecode.Admin'),
('Lab - System Manager', 'Lab.Initializecode.Create'),
('Lab - System Manager', 'Lab.Initializecode.Update'),
('Lab - System Manager', 'Lab.Lab.Admin'),
('Lab - System Manager', 'Lab.Lab.Create'),
('Lab - System Manager', 'Lab.Lab.Update'),
('Lab - System Manager', 'Lab.Lab.View'),
('Lab - System Manager', 'Lab.Orderofpayment.Admin'),
('Lab - System Manager', 'Lab.Orderofpayment.Create'),
('Lab - System Manager', 'Lab.Orderofpayment.PrintExcel'),
('Lab - System Manager', 'Lab.Orderofpayment.SearchRequests'),
('Lab - System Manager', 'Lab.Orderofpayment.Update'),
('Lab - System Manager', 'Lab.Orderofpayment.UpdateAmount'),
('Lab - System Manager', 'Lab.Orderofpayment.View'),
('Lab - System Manager', 'Lab.Package.Admin'),
('Lab - System Manager', 'Lab.Package.Create'),
('Lab - System Manager', 'Lab.Package.getSampletype'),
('Lab - System Manager', 'Lab.Package.getTest'),
('Lab - System Manager', 'Lab.Package.Index'),
('Lab - System Manager', 'Lab.Package.Update'),
('Lab - System Manager', 'Lab.Package.UpdateTestGrid'),
('Lab - System Manager', 'Lab.Package.View'),
('Lab - System Manager', 'Lab.Referral.Admin'),
('Lab - System Manager', 'Lab.Referral.Create'),
('Lab - System Manager', 'Lab.Referral.Update'),
('Lab - System Manager', 'Lab.Referral.View'),
('Lab - System Manager', 'Lab.Request.Admin'),
('Lab - System Manager', 'Lab.Request.Cancel'),
('Lab - System Manager', 'Lab.Request.Create'),
('Lab - System Manager', 'Lab.Request.CreateOP'),
('Lab - System Manager', 'Lab.Request.genRequestExcel'),
('Lab - System Manager', 'Lab.Request.Import'),
('Lab - System Manager', 'Lab.Request.ImportData'),
('Lab - System Manager', 'Lab.Request.ImportRequest'),
('Lab - System Manager', 'Lab.Request.ImportRequestDetail'),
('Lab - System Manager', 'Lab.Request.Index'),
('Lab - System Manager', 'Lab.Request.LoadFile'),
('Lab - System Manager', 'Lab.Request.PaymentDetail'),
('Lab - System Manager', 'Lab.Request.searchCustomer'),
('Lab - System Manager', 'Lab.Request.SearchRequests'),
('Lab - System Manager', 'Lab.Request.searchSample'),
('Lab - System Manager', 'Lab.Request.Update'),
('Lab - System Manager', 'Lab.Request.View'),
('Lab - System Manager', 'Lab.Requestcode.Admin'),
('Lab - System Manager', 'Lab.Requestcode.Create'),
('Lab - System Manager', 'Lab.Requestcode.Test'),
('Lab - System Manager', 'Lab.Requestcode.Update'),
('Lab - System Manager', 'Lab.Sample.Admin'),
('Lab - System Manager', 'Lab.Sample.Cancel'),
('Lab - System Manager', 'Lab.Sample.confirm'),
('Lab - System Manager', 'Lab.Sample.Create'),
('Lab - System Manager', 'Lab.Sample.Delete'),
('Lab - System Manager', 'Lab.Sample.GenerateSampleCode'),
('Lab - System Manager', 'Lab.Sample.Index'),
('Lab - System Manager', 'Lab.Sample.searchSample'),
('Lab - System Manager', 'Lab.Sample.Update'),
('Lab - System Manager', 'Lab.Sample.View'),
('Lab - System Manager', 'Lab.Samplename.Admin'),
('Lab - System Manager', 'Lab.Samplename.Create'),
('Lab - System Manager', 'Lab.Samplename.Delete'),
('Lab - System Manager', 'Lab.Samplename.Update'),
('Lab - System Manager', 'Lab.Samplename.View'),
('Lab - System Manager', 'Lab.Sampletype.Admin'),
('Lab - System Manager', 'Lab.Sampletype.Create'),
('Lab - System Manager', 'Lab.Sampletype.Index'),
('Lab - System Manager', 'Lab.Sampletype.Update'),
('Lab - System Manager', 'Lab.Sampletype.View'),
('Lab - System Manager', 'Lab.Statistic.*'),
('Lab - System Manager', 'Lab.Statistic.Customer'),
('Lab - System Manager', 'Lab.Test.Admin'),
('Lab - System Manager', 'Lab.Test.Create'),
('Lab - System Manager', 'Lab.Test.Index'),
('Lab - System Manager', 'Lab.Test.SampleType'),
('Lab - System Manager', 'Lab.Test.Update'),
('Lab - System Manager', 'Lab.Test.View'),
('Lab - System Manager', 'Lab.Testcategory.Admin'),
('Lab - System Manager', 'Lab.Testcategory.Create'),
('Lab - System Manager', 'Lab.Testcategory.Index'),
('Lab - System Manager', 'Lab.Testcategory.Update'),
('Lab - System Manager', 'Lab.Testcategory.View'),
('Lab - System Manager', 'Las.Package.getTest'),
('Lab - System Manager', 'Lms.Package.getTest'),
('Lab - System Manager', 'Phaddress.Default.*'),
('Lab - System Manager', 'Ref.Analysis.Create'),
('Lab - System Manager', 'Ref.Analysis.Delete'),
('Lab - System Manager', 'Ref.Analysis.GetAnalysisdetails'),
('Lab - System Manager', 'Ref.Analysis.GetMethodReference'),
('Lab - System Manager', 'Ref.Analysis.GetTestName'),
('Lab - System Manager', 'Ref.Analysis.Update'),
('Lab - System Manager', 'Ref.Analysis.View'),
('Lab - System Manager', 'Ref.Client.Admin'),
('Lab - System Manager', 'Ref.Client.Create'),
('Lab - System Manager', 'Ref.Client.Delete'),
('Lab - System Manager', 'Ref.Client.Update'),
('Lab - System Manager', 'Ref.Client.View'),
('Lab - System Manager', 'Ref.Customer.Admin'),
('Lab - System Manager', 'Ref.Customer.Create'),
('Lab - System Manager', 'Ref.Customer.getBarangay'),
('Lab - System Manager', 'Ref.Customer.getMunicipalityCity'),
('Lab - System Manager', 'Ref.Customer.getProvince'),
('Lab - System Manager', 'Ref.Customer.SearchLocalCustomer'),
('Lab - System Manager', 'Ref.Customer.Update'),
('Lab - System Manager', 'Ref.Customer.View'),
('Lab - System Manager', 'Ref.LabService.ActivateService'),
('Lab - System Manager', 'Ref.LabService.Admin'),
('Lab - System Manager', 'Ref.LabService.DeactivateService'),
('Lab - System Manager', 'Ref.Orderofpayment.Admin'),
('Lab - System Manager', 'Ref.Orderofpayment.Create'),
('Lab - System Manager', 'Ref.Orderofpayment.SearchReferrals'),
('Lab - System Manager', 'Ref.Orderofpayment.SearchRequests'),
('Lab - System Manager', 'Ref.Orderofpayment.UpdateAmount'),
('Lab - System Manager', 'Ref.Orderofpayment.View'),
('Lab - System Manager', 'Ref.Referral.Admin'),
('Lab - System Manager', 'Ref.Referral.Create'),
('Lab - System Manager', 'Ref.Referral.SearchAgency'),
('Lab - System Manager', 'Ref.Referral.Send'),
('Lab - System Manager', 'Ref.Referral.Update'),
('Lab - System Manager', 'Ref.Referral.View'),
('Lab - System Manager', 'Ref.Referralstatus.Create'),
('Lab - System Manager', 'Ref.Referralstatus.Update'),
('Lab - System Manager', 'Ref.Referralstatus.UpdateStatus'),
('Lab - System Manager', 'Ref.Result.Admin'),
('Lab - System Manager', 'Ref.Result.Create'),
('Lab - System Manager', 'Ref.Result.Index'),
('Lab - System Manager', 'Ref.Result.Update'),
('Lab - System Manager', 'Ref.Result.View'),
('Lab - System Manager', 'Ref.Sample.Create'),
('Lab - System Manager', 'Ref.Sample.Delete'),
('Lab - System Manager', 'Ref.Sample.Update'),
('Lab - System Manager', 'Ref.Testconducted.Create'),
('Lab - System Manager', 'Ref.Testconducted.Delete'),
('Lab - System Manager', 'Ref.Testconducted.Update'),
('Lab - System Manager', 'Ref.Testconducted.View'),
('Lab - System Manager', 'Ref.Testlist.Admin'),
('Lab - System Manager', 'Ref.Testlist.Create'),
('Lab - System Manager', 'Ref.Testlist.Delete'),
('Lab - System Manager', 'Ref.Testlist.Update'),
('Lab - System Manager', 'Ref.Testlist.View'),
('Lab - User', 'Accounting.Orderofpayment.CreateOPFromRequests'),
('Lab - User', 'Accounting.Orderofpayment.SearchRequests'),
('Lab - User', 'Config.Index'),
('Lab - User', 'Lab.Accomplishments.*'),
('Lab - User', 'Lab.Accomplishments.Consolidated'),
('Lab - User', 'Lab.Accomplishments.ExportConso'),
('Lab - User', 'Lab.Accomplishments.ExportSummary'),
('Lab - User', 'Lab.Accomplishments.Index'),
('Lab - User', 'Lab.Accomplishments.Indexes'),
('Lab - User', 'Lab.Accomplishments.Summary'),
('Lab - User', 'Lab.Accomplishments.UpdateConso'),
('Lab - User', 'Lab.Analysis.Admin'),
('Lab - User', 'Lab.Analysis.Create'),
('Lab - User', 'Lab.Analysis.Delete'),
('Lab - User', 'Lab.Analysis.getAnalysis'),
('Lab - User', 'Lab.Analysis.getAnalysisdetails'),
('Lab - User', 'Lab.Analysis.getCategorytype'),
('Lab - User', 'Lab.Analysis.getPackageDetails'),
('Lab - User', 'Lab.Analysis.getPackages'),
('Lab - User', 'Lab.Analysis.getSampletype'),
('Lab - User', 'Lab.Analysis.Index'),
('Lab - User', 'Lab.Analysis.Package'),
('Lab - User', 'Lab.Analysis.Update'),
('Lab - User', 'Lab.Analysis.View'),
('Lab - User', 'Lab.Customer.Admin'),
('Lab - User', 'Lab.Customer.Create'),
('Lab - User', 'Lab.Customer.getBarangay'),
('Lab - User', 'Lab.Customer.getMunicipalityCity'),
('Lab - User', 'Lab.Customer.getProvince'),
('Lab - User', 'Lab.Customer.Index'),
('Lab - User', 'Lab.Customer.Update'),
('Lab - User', 'Lab.Customer.View'),
('Lab - User', 'Lab.Default.Index'),
('Lab - User', 'Lab.Orderofpayment.Admin'),
('Lab - User', 'Lab.Orderofpayment.Create'),
('Lab - User', 'Lab.Orderofpayment.PrintExcel'),
('Lab - User', 'Lab.Orderofpayment.SearchRequests'),
('Lab - User', 'Lab.Orderofpayment.Update'),
('Lab - User', 'Lab.Orderofpayment.UpdateAmount'),
('Lab - User', 'Lab.Orderofpayment.View'),
('Lab - User', 'Lab.Package.Admin'),
('Lab - User', 'Lab.Package.getSampletype'),
('Lab - User', 'Lab.Package.getTest'),
('Lab - User', 'Lab.Package.Index'),
('Lab - User', 'Lab.Package.UpdateTestGrid'),
('Lab - User', 'Lab.Package.View'),
('Lab - User', 'Lab.Referral.Admin'),
('Lab - User', 'Lab.Referral.Create'),
('Lab - User', 'Lab.Referral.Update'),
('Lab - User', 'Lab.Referral.View'),
('Lab - User', 'Lab.Request.Admin'),
('Lab - User', 'Lab.Request.Create'),
('Lab - User', 'Lab.Request.CreateOP'),
('Lab - User', 'Lab.Request.genRequestExcel'),
('Lab - User', 'Lab.Request.ImportData'),
('Lab - User', 'Lab.Request.ImportRequest'),
('Lab - User', 'Lab.Request.ImportRequestDetail'),
('Lab - User', 'Lab.Request.Index'),
('Lab - User', 'Lab.Request.LoadFile'),
('Lab - User', 'Lab.Request.PaymentDetail'),
('Lab - User', 'Lab.Request.searchCustomer'),
('Lab - User', 'Lab.Request.SearchRequests'),
('Lab - User', 'Lab.Request.searchSample'),
('Lab - User', 'Lab.Request.Update'),
('Lab - User', 'Lab.Request.View'),
('Lab - User', 'Lab.Sample.Admin'),
('Lab - User', 'Lab.Sample.confirm'),
('Lab - User', 'Lab.Sample.Create'),
('Lab - User', 'Lab.Sample.Delete'),
('Lab - User', 'Lab.Sample.GenerateSampleCode'),
('Lab - User', 'Lab.Sample.Index'),
('Lab - User', 'Lab.Sample.searchSample'),
('Lab - User', 'Lab.Sample.Update'),
('Lab - User', 'Lab.Sample.View'),
('Lab - User', 'Lab.Samplename.Admin'),
('Lab - User', 'Lab.Samplename.Create'),
('Lab - User', 'Lab.Samplename.Update'),
('Lab - User', 'Lab.Samplename.View'),
('Lab - User', 'Lab.Sampletype.Admin'),
('Lab - User', 'Lab.Sampletype.Index'),
('Lab - User', 'Lab.Sampletype.View'),
('Lab - User', 'Lab.Statistic.*'),
('Lab - User', 'Lab.Statistic.Customer'),
('Lab - User', 'Lab.Statistic.Index'),
('Lab - User', 'Lab.Test.Admin'),
('Lab - User', 'Lab.Test.Create'),
('Lab - User', 'Lab.Test.Index'),
('Lab - User', 'Lab.Test.SampleType'),
('Lab - User', 'Lab.Test.View'),
('Lab - User', 'Lab.Testcategory.Admin'),
('Lab - User', 'Lab.Testcategory.Index'),
('Lab - User', 'Las.Package.getTest'),
('Lab - User', 'Lms.Package.getTest'),
('Lab - User', 'Phaddress.Default.*'),
('Lab - User', 'Ref.Analysis.Create'),
('Lab - User', 'Ref.Analysis.Delete'),
('Lab - User', 'Ref.Analysis.GetAnalysisdetails'),
('Lab - User', 'Ref.Analysis.GetMethodReference'),
('Lab - User', 'Ref.Analysis.GetTestName'),
('Lab - User', 'Ref.Analysis.Update'),
('Lab - User', 'Ref.Analysis.View'),
('Lab - User', 'Ref.Client.Admin'),
('Lab - User', 'Ref.Client.Create'),
('Lab - User', 'Ref.Client.Delete'),
('Lab - User', 'Ref.Client.Update'),
('Lab - User', 'Ref.Client.View'),
('Lab - User', 'Ref.Customer.Admin'),
('Lab - User', 'Ref.Customer.Create'),
('Lab - User', 'Ref.Customer.getBarangay'),
('Lab - User', 'Ref.Customer.getMunicipalityCity'),
('Lab - User', 'Ref.Customer.getProvince'),
('Lab - User', 'Ref.Customer.SearchLocalCustomer'),
('Lab - User', 'Ref.Customer.Update'),
('Lab - User', 'Ref.Customer.View'),
('Lab - User', 'Ref.LabService.ActivateService'),
('Lab - User', 'Ref.LabService.Admin'),
('Lab - User', 'Ref.LabService.DeactivateService'),
('Lab - User', 'Ref.Orderofpayment.Admin'),
('Lab - User', 'Ref.Orderofpayment.Create'),
('Lab - User', 'Ref.Orderofpayment.SearchReferrals'),
('Lab - User', 'Ref.Orderofpayment.SearchRequests'),
('Lab - User', 'Ref.Orderofpayment.UpdateAmount'),
('Lab - User', 'Ref.Orderofpayment.View'),
('Lab - User', 'Ref.Referral.Admin'),
('Lab - User', 'Ref.Referral.Create'),
('Lab - User', 'Ref.Referral.SearchAgency'),
('Lab - User', 'Ref.Referral.Send'),
('Lab - User', 'Ref.Referral.Update'),
('Lab - User', 'Ref.Referral.View'),
('Lab - User', 'Ref.Referralstatus.Create'),
('Lab - User', 'Ref.Referralstatus.Update'),
('Lab - User', 'Ref.Referralstatus.UpdateStatus'),
('Lab - User', 'Ref.Result.Admin'),
('Lab - User', 'Ref.Result.Create'),
('Lab - User', 'Ref.Result.Index'),
('Lab - User', 'Ref.Result.Update'),
('Lab - User', 'Ref.Result.View'),
('Lab - User', 'Ref.Sample.Create'),
('Lab - User', 'Ref.Sample.Delete'),
('Lab - User', 'Ref.Sample.Update'),
('Lab - User', 'Ref.Testconducted.Create'),
('Lab - User', 'Ref.Testconducted.Delete'),
('Lab - User', 'Ref.Testconducted.Update'),
('Lab - User', 'Ref.Testconducted.View'),
('Lab - User', 'Ref.Testlist.Admin'),
('Lab - User', 'Ref.Testlist.Create'),
('Lab - User', 'Ref.Testlist.Delete'),
('Lab - User', 'Ref.Testlist.Update'),
('Lab - User', 'Ref.Testlist.View');

-- --------------------------------------------------------

--
-- Table structure for table `industry`
--

CREATE TABLE IF NOT EXISTS `industry` (
`id` int(11) NOT NULL,
  `classification` varchar(250) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `industry`
--

INSERT INTO `industry` (`id`, `classification`, `active`) VALUES
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
-- Table structure for table `partner`
--

CREATE TABLE IF NOT EXISTS `partner` (
`id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `code` varchar(20) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `partner`
--

INSERT INTO `partner` (`id`, `name`, `code`) VALUES
(1, 'Regional Information Technology and Electronic Commerce Committee - IX', 'RITECC-IX'),
(2, 'Zamboanga Information and Communication Technology Council', 'ZICT'),
(3, 'Department of Health', 'DOH'),
(4, 'Advanced Science and Technology Institute', 'ASTI');

-- --------------------------------------------------------

--
-- Table structure for table `period`
--

CREATE TABLE IF NOT EXISTS `period` (
`id` int(11) NOT NULL,
  `periodQuarter` varchar(11) NOT NULL,
  `periodMonth` varchar(22) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `period`
--

INSERT INTO `period` (`id`, `periodQuarter`, `periodMonth`) VALUES
(1, '1st Quarter', 'January - March'),
(2, '2nd Quarter', 'April - June'),
(3, '3rd Quarter', 'July - September'),
(4, '4th Quarter', 'October - December');

-- --------------------------------------------------------

--
-- Table structure for table `personnel`
--

CREATE TABLE IF NOT EXISTS `personnel` (
`id` int(11) NOT NULL,
  `module` varchar(25) NOT NULL,
  `designation` varchar(30) NOT NULL,
  `designationAlias` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`id`, `module`, `designation`, `designationAlias`, `name`) VALUES
(1, 'cashier, accounting', 'Cashier V', 'collectingOfficer', ''),
(2, 'accounting', 'Accountant III', 'accountant', '');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
`user_id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `pstc` int(11) NOT NULL DEFAULT '1',
  `accesslist2` varchar(25) NOT NULL DEFAULT '1',
  `mi` varchar(255) NOT NULL DEFAULT '',
  `rstlid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`user_id`, `lastname`, `firstname`, `pstc`, `accesslist2`, `mi`, `rstlid`) VALUES
(1, 'Admin', 'Ulims', 11, '1', 'D', 0);

-- --------------------------------------------------------

--
-- Table structure for table `profiles_fields`
--

CREATE TABLE IF NOT EXISTS `profiles_fields` (
`id` int(10) NOT NULL,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` varchar(15) NOT NULL DEFAULT '0',
  `field_size_min` varchar(15) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profiles_fields`
--

INSERT INTO `profiles_fields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES
(1, 'lastname', 'Last Name', 'VARCHAR', '50', '3', 1, '', '', 'Incorrect Last Name (length between 3 and 50 characters).', '', '', '', '', 0, 3),
(2, 'firstname', 'First Name', 'VARCHAR', '50', '3', 1, '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', 0, 3),
(3, 'pstc', 'PSTC', 'INTEGER', '11', '1', 1, '', '1==DOST-RO;2==PSTC-ZS;3==PSTC-ZDS;4==PSTC-ZDN', '', '', '1', '', '', 0, 0),
(5, 'accesslist2', 'Access List', 'VARCHAR', '25', '1', 1, '', '1==SCIMS;2==LMS;3==PMIS;4==PPAMS;5==SPMIS', '', '', '', '', '', 0, 0),
(6, 'mi', 'Middle Initial', 'VARCHAR', '255', '1', 2, '', '', '', '', '', '', '', 0, 3),
(7, 'rstlid', 'RSTL', 'INTEGER', '11', '1', 1, '', '1==DOST-RO;2==PSTC-ZS;3==PSTC-ZDS;4==PSTC-ZDN', '', '', '0', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE IF NOT EXISTS `program` (
`id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `systems` varchar(11) NOT NULL,
  `imageIcon` varchar(100) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `code`, `name`, `description`, `systems`, `imageIcon`) VALUES
(1, 'SETUP', 'Small Enterprise Technology Upgrading Program', 'is a nationwide strategy to encourage and assist small and medium enterprises (SMEs) to adopt technology innovations to improve their operations and expand the reach of their businesses.\r\n\r\nThe program focuses on the following six (6) priority sectors: 1. Food Processing; 2. Furniture; 3. Gifts, Decors & Handicrafts; 4. Marine and Aquatic Resources; 5. Horticulture (Cut flowers, fruits, high value crops); and 6. Metals and Engineering.', 'PMIS', 'SETUP_logo.png'),
(2, 'GIA', 'Grants-In-Aid Program', 'Grants-in-ad program of DOST', 'PMIS', 'dost-gia.png'),
(3, 'SCHOLARSHIP', 'S&T Scholarships Program', 'The Undergraduate Scholarship Programs of the Department of Science and Technology implemented by the Science Education Institute (DOST-SEI) are open yearly to talented and deserving students who wish to pursue 4- or 5- year courses in priority science and technology fields. The RA 7687 Scholarships and the Merit Scholarships both aim to produce and develop high quality human resources who will man the Science and Technology (S&T) and Research Development (R&D) efforts in the country.', '', 's&t-scholarship.png');

-- --------------------------------------------------------

--
-- Table structure for table `Rights`
--

CREATE TABLE IF NOT EXISTS `Rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Rights`
--

INSERT INTO `Rights` (`itemname`, `type`, `weight`) VALUES
('ActiveRecordLog.*', 1, 13),
('Payment.*', 1, 14),
('Project.*', 1, 15),
('Site.*', 1, 16),
('User.Activation.*', 1, 17),
('User.Admin.*', 1, 18),
('User.Default.*', 1, 19),
('User.Login.*', 1, 20),
('User.Logout.*', 1, 21),
('User.Profile.*', 1, 22),
('User.ProfileField.*', 1, 23),
('User.Recovery.*', 1, 24),
('User.Registration.*', 1, 25),
('User.User.*', 1, 26),
('Customerprofile.*', 1, 27),
('Pmis.Customerassistancelist.*', 1, 28),
('Pmis.Customer.*', 1, 29),
('Pmis.Customerpotential.*', 1, 30),
('Pmis.Customerprofile.*', 1, 31),
('Pmis.Project.*', 1, 32),
('Pmis.Technicalassistance.*', 1, 33),
('Lms.Default.*', 1, 34),
('Lms.Request.*', 1, 35),
('Lms.Sample.*', 1, 37),
('Lms.Request.searchSample', 1, 36),
('Lms.Request.searchCustomer', 1, 38),
('Lms.Analysis.*', 1, 39),
('Lms.Analysis.getCategorytype', 1, 9),
('Lms.Analysis.getSampletype', 1, 8),
('Lms.Analysis.getAnalysis', 1, 10),
('Lms.Analysis.getAnalysisdetails', 1, 11),
('Lms.Sample.confirm', 1, 12),
('Lms.Request.genRequestExcel', 1, 0),
('Lms.Accomplishment.*', 1, 1),
('Lms.Accomplishments.*', 1, 2),
('Lms.Accomplishments.ExportConso', 1, 3),
('Lms.Accomplishments.ExportSummary', 1, 4),
('Lms.Sample.searchSample', 1, 5),
('Lms.Customer.*', 1, 6),
('Lms.Statistic.*', 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `rstl`
--

CREATE TABLE IF NOT EXISTS `rstl` (
`id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(10) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rstl`
--

INSERT INTO `rstl` (`id`, `region_id`, `name`, `code`) VALUES
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
(17, 17, 'DOST-CARAGA', 'R13'),
(18, 18, 'DOST-ARMM', 'ARMM'),
(25, 6, 'DOST-IVA-L3', 'R4AL3'),
(19, 19, 'DOST-FNRI', 'FNRI'),
(20, 20, 'DOST-FPRDI', 'FPRDI'),
(21, 21, 'DOST-ITDI', 'ITDI'),
(22, 22, 'DOST-MIRDC', 'MIRDC'),
(23, 23, 'DOST-PTRI', 'PTRI'),
(24, 24, 'DOST-PNRI', 'PNRI'),
(26, 6, 'DOST-IVA-L4', 'R4AL4'),
(27, 21, 'DOST-ADMATEL', 'ADMATEL');

-- --------------------------------------------------------

--
-- Table structure for table `search_index`
--

CREATE TABLE IF NOT EXISTS `search_index` (
`id` int(11) NOT NULL,
  `association_key` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `data` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
`id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `type`) VALUES
(1, 'On-going'),
(2, 'Graduated/ Completed'),
(3, 'Terminated'),
(4, 'Withdrawn'),
(5, 'Non-Compliance'),
(6, 'Duplicate');

-- --------------------------------------------------------

--
-- Table structure for table `status_sub`
--

CREATE TABLE IF NOT EXISTS `status_sub` (
`id` int(11) NOT NULL,
  `statusId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_sub`
--

INSERT INTO `status_sub` (`id`, `statusId`, `name`) VALUES
(1, 1, 'Good Standing'),
(2, 1, 'Suspended'),
(3, 1, 'Leave Of Absence'),
(4, 1, 'No Report'),
(5, 2, 'Graduated'),
(6, 3, 'Terminated'),
(7, 4, 'Withdrawn'),
(8, 5, 'Non-Compliance');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisit_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `activkey`, `create_at`, `lastvisit_at`, `superuser`, `status`) VALUES
(1, 'admin', 'd9a007c98d8a5bf4430cec2e13385cd7', 'red_x88@yahoo.com', '18b4b06c40cca28656f527e4b77f2e54', '2013-09-18 06:53:35', '0000-00-00 00:00:00', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesslist`
--
ALTER TABLE `accesslist`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authassignment`
--
ALTER TABLE `authassignment`
 ADD PRIMARY KEY (`itemname`,`userid`);

--
-- Indexes for table `AuthItem`
--
ALTER TABLE `AuthItem`
 ADD PRIMARY KEY (`name`);

--
-- Indexes for table `AuthItemChild`
--
ALTER TABLE `AuthItemChild`
 ADD PRIMARY KEY (`parent`,`child`), ADD KEY `child` (`child`);

--
-- Indexes for table `industry`
--
ALTER TABLE `industry`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partner`
--
ALTER TABLE `partner`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `period`
--
ALTER TABLE `period`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personnel`
--
ALTER TABLE `personnel`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `profiles_fields`
--
ALTER TABLE `profiles_fields`
 ADD PRIMARY KEY (`id`), ADD KEY `varname` (`varname`,`widget`,`visible`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Rights`
--
ALTER TABLE `Rights`
 ADD PRIMARY KEY (`itemname`);

--
-- Indexes for table `rstl`
--
ALTER TABLE `rstl`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `search_index`
--
ALTER TABLE `search_index`
 ADD PRIMARY KEY (`id`), ADD KEY `association_key` (`association_key`,`model`), ADD FULLTEXT KEY `data` (`data`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_sub`
--
ALTER TABLE `status_sub`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `email` (`email`), ADD KEY `status` (`status`), ADD KEY `superuser` (`superuser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesslist`
--
ALTER TABLE `accesslist`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `industry`
--
ALTER TABLE `industry`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `partner`
--
ALTER TABLE `partner`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `period`
--
ALTER TABLE `period`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `personnel`
--
ALTER TABLE `personnel`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `profiles_fields`
--
ALTER TABLE `profiles_fields`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `rstl`
--
ALTER TABLE `rstl`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `search_index`
--
ALTER TABLE `search_index`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `status_sub`
--
ALTER TABLE `status_sub`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
ADD CONSTRAINT `user_profile_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
