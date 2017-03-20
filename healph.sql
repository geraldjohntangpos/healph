-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2016 at 06:33 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `healph`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `ACCT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(30) NOT NULL,
  `PASSWORD` varchar(30) NOT NULL,
  `STATUS` varchar(30) NOT NULL DEFAULT 'ACTIVE',
  `TYPE` varchar(10) NOT NULL,
  PRIMARY KEY (`ACCT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`ACCT_ID`, `USERNAME`, `PASSWORD`, `STATUS`, `TYPE`) VALUES
(1, 'admin01', 'anjon', 'ACTIVE', 'Admin'),
(2, 'admin02', 'liam', 'ACTIVE', 'Admin'),
(3, 'admin03', 'gerald', 'ACTIVE', 'Admin'),
(20, 'spcahm', 'footrefelex', 'ACTIVE', 'Healer'),
(21, 'gerald', '12312', 'ACTIVE', 'Client'),
(22, 'faithholistic', '022696', 'ACTIVE', 'Healer'),
(23, 'byron', '12345', 'ACTIVE', 'Client'),
(24, 'anjon', '12312', 'ACTIVE', 'Client'),
(25, 'wocampo', '12312', 'ACTIVE', 'Client');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `ADMIN_ID` int(3) NOT NULL AUTO_INCREMENT,
  `ACCT_ID` int(3) NOT NULL,
  `FIRSTNAME` varchar(30) NOT NULL,
  `LASTNAME` varchar(30) NOT NULL,
  PRIMARY KEY (`ADMIN_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ADMIN_ID`, `ACCT_ID`, `FIRSTNAME`, `LASTNAME`) VALUES
(1, 1, 'Anjon Franz', 'Perez'),
(2, 2, 'John William', 'Ocampo'),
(3, 3, 'Gerald John', 'Tangpos');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE IF NOT EXISTS `appointment` (
  `APPOINTMENT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `HEALER_ID` int(11) NOT NULL,
  `DATEADDED` varchar(30) NOT NULL,
  `CLIENT_ID` int(11) NOT NULL,
  `APPOINTEDDATE` varchar(30) NOT NULL,
  `APPOINTEDTIME` varchar(20) NOT NULL,
  `FEEDBACK` varchar(3000) NOT NULL,
  `STATUS` varchar(100) NOT NULL DEFAULT 'ACTIVE',
  `DATECONFIRMED` varchar(20) NOT NULL,
  PRIMARY KEY (`APPOINTMENT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`APPOINTMENT_ID`, `HEALER_ID`, `DATEADDED`, `CLIENT_ID`, `APPOINTEDDATE`, `APPOINTEDTIME`, `FEEDBACK`, `STATUS`, `DATECONFIRMED`) VALUES
(1, 20, '2016-09-26 05:19:19', 21, '2016-09-29', '10:00', '', 'ACTIVE', ''),
(2, 20, '2016-09-28 06:42:30', 24, '2016-09-30', '10:50 - 11:40', '', 'ACTIVE', '');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `BOOKING_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CLIENT_ID` int(11) NOT NULL,
  `HEALER_ID` int(11) NOT NULL,
  `SERVICE_ID` int(11) NOT NULL,
  `DATEADDED` varchar(20) NOT NULL,
  `BOOKINGDATE` varchar(20) NOT NULL,
  `BOOKINGTIME` varchar(20) NOT NULL,
  `FEEDBACK` varchar(3000) NOT NULL,
  `STATUS` varchar(15) NOT NULL DEFAULT 'ACTIVE',
  `DATECONFIRMED` varchar(20) NOT NULL,
  PRIMARY KEY (`BOOKING_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`BOOKING_ID`, `CLIENT_ID`, `HEALER_ID`, `SERVICE_ID`, `DATEADDED`, `BOOKINGDATE`, `BOOKINGTIME`, `FEEDBACK`, `STATUS`, `DATECONFIRMED`) VALUES
(3, 21, 20, 1, '2016-09-28 05:11:21', '2016-09-30', '17:30 - 18:20', '', 'ACTIVE', '');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `CLIENT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ACCT_ID` int(11) NOT NULL,
  `FIRSTNAME` varchar(30) NOT NULL,
  `LASTNAME` varchar(30) NOT NULL,
  `ADDRESS` varchar(60) NOT NULL,
  `EMAIL_ADDRESS` varchar(30) NOT NULL,
  `MOBILE` varchar(15) NOT NULL,
  `PICTURE` varchar(50) NOT NULL DEFAULT 'face.jpg',
  `STATUS` varchar(20) NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`CLIENT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`CLIENT_ID`, `ACCT_ID`, `FIRSTNAME`, `LASTNAME`, `ADDRESS`, `EMAIL_ADDRESS`, `MOBILE`, `PICTURE`, `STATUS`) VALUES
(1, 21, 'Gerald John', 'Tangpos', '', 'geraldjohnt@gmail.com', '09382781788', 'face.jpg', 'ACTIVE'),
(2, 23, 'Byron', 'Pacres', '', 'robynpacers@gmail.com', '09382938282', 'face.jpg', 'ACTIVE'),
(3, 24, 'Anjon Franz', 'Perez', '', 'stonerbashingtime@gmail.com', '09382738478', 'face.jpg', 'ACTIVE'),
(4, 25, 'John William', 'Ocampo', '', 'wocampo@gmail.com', '09382739288', 'face.jpg', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `client_feedback`
--

CREATE TABLE IF NOT EXISTS `client_feedback` (
  `FEEDBACK_ID` int(11) NOT NULL AUTO_INCREMENT,
  `COMMENT` varchar(32000) NOT NULL,
  `CLIENT_ID` int(11) NOT NULL,
  `LABEL` varchar(20) NOT NULL,
  `LABEL_ID` int(11) NOT NULL,
  `DATEADDED` varchar(30) NOT NULL,
  PRIMARY KEY (`FEEDBACK_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `clinic_schedule`
--

CREATE TABLE IF NOT EXISTS `clinic_schedule` (
  `SCHED_ID` int(11) NOT NULL AUTO_INCREMENT,
  `TIME` varchar(20) NOT NULL,
  PRIMARY KEY (`SCHED_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `healer`
--

CREATE TABLE IF NOT EXISTS `healer` (
  `HEALER_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ACCT_ID` int(11) NOT NULL,
  `FIRSTNAME` varchar(30) NOT NULL,
  `LASTNAME` varchar(30) NOT NULL,
  `ADDRESS` varchar(200) NOT NULL,
  `CONTACT` varchar(30) NOT NULL,
  `EMAIL_ADDRESS` varchar(45) NOT NULL,
  `LATITUDE` varchar(50) NOT NULL,
  `LONGITUDE` varchar(50) NOT NULL,
  `DETAILS` varchar(1000) NOT NULL,
  `SUBEXPIRY` varchar(20) NOT NULL,
  `PICTURE` varchar(50) NOT NULL DEFAULT 'face.jpg',
  `CLINICDAYS` varchar(200) NOT NULL,
  `CLINICHOURS` varchar(20) NOT NULL,
  `DAILYLIMIT` int(11) NOT NULL,
  `RATE` decimal(5,1) NOT NULL,
  `STATUS` varchar(15) NOT NULL DEFAULT 'UNCONFIRMED',
  PRIMARY KEY (`HEALER_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `healer`
--

INSERT INTO `healer` (`HEALER_ID`, `ACCT_ID`, `FIRSTNAME`, `LASTNAME`, `ADDRESS`, `CONTACT`, `EMAIL_ADDRESS`, `LATITUDE`, `LONGITUDE`, `DETAILS`, `SUBEXPIRY`, `PICTURE`, `CLINICDAYS`, `CLINICHOURS`, `DAILYLIMIT`, `RATE`, `STATUS`) VALUES
(1, 20, 'Kareena', 'Tejedor', 'Metro Colon, Cebu City, Cebu, Philippines', '09332243631', 'tkareenatanya@yahoo.com', '10.29622504439878', '123.89832615852356', '', '2016-10-20', 'face.jpg', 'Everyday', '10:00 - 19:30', 50, '0.0', 'ACTIVE'),
(2, 22, 'Faith', 'Arnado', 'Capitol Site, Cebu City, Cebu, Philippines', '09223762848', 'faith_arnado@yahoo.com', '10.312619510619067', '123.89233108609915', '', '2016-10-21', 'healer_22.jpg', 'Everyday', '13:00 - 18:00', 20, '0.0', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE IF NOT EXISTS `inquiries` (
  `INQUIRY_ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `REQUEST` varchar(1000) NOT NULL,
  `ADDED_AT` varchar(20) NOT NULL,
  `STATUS` varchar(20) NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`INQUIRY_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `like`
--

CREATE TABLE IF NOT EXISTS `like` (
  `LIKE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `LABEL` varchar(15) NOT NULL,
  `LABEL_ID` int(11) NOT NULL,
  `LIKER_ID` int(11) NOT NULL,
  `DATELIKED` varchar(20) NOT NULL,
  PRIMARY KEY (`LIKE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `NOTIF_ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOTIF_OWNER` int(11) NOT NULL,
  `NOTIFIER` int(11) NOT NULL,
  `TYPE` varchar(15) NOT NULL,
  `TYPE_ID` int(11) NOT NULL,
  `NOTIFDATE` varchar(20) NOT NULL,
  `STATUS` varchar(15) NOT NULL DEFAULT 'ACTIVE',
  `SEEN` varchar(10) NOT NULL DEFAULT 'UNSEEN',
  PRIMARY KEY (`NOTIF_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`NOTIF_ID`, `NOTIF_OWNER`, `NOTIFIER`, `TYPE`, `TYPE_ID`, `NOTIFDATE`, `STATUS`, `SEEN`) VALUES
(1, 20, 21, 'appointment', 1, '2016-09-26 05:19:19', 'ACTIVE', 'UNSEEN'),
(4, 20, 21, 'booking', 3, '2016-09-28 05:11:21', 'ACTIVE', 'UNSEEN'),
(5, 20, 24, 'appointment', 2, '2016-09-28 06:42:30', 'ACTIVE', 'UNSEEN');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `PRODUCT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PRODTYPE_ID` int(11) NOT NULL,
  `ACCT_ID` int(11) NOT NULL,
  `DESCRIPTION` varchar(60) NOT NULL,
  `RATE` decimal(5,1) NOT NULL,
  `NAME` varchar(60) NOT NULL,
  `QUANTITY` int(11) NOT NULL,
  `PRICE` decimal(10,2) NOT NULL,
  `UNIT` int(11) NOT NULL,
  `STATUS` varchar(20) NOT NULL DEFAULT 'ACTIVE',
  `PICTURE` varchar(60) NOT NULL,
  PRIMARY KEY (`PRODUCT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE IF NOT EXISTS `product_type` (
  `PRODTYPE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PRODTYPE` varchar(30) NOT NULL,
  PRIMARY KEY (`PRODTYPE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`PRODTYPE_ID`, `PRODTYPE`) VALUES
(1, 'Internal'),
(2, 'External');

-- --------------------------------------------------------

--
-- Table structure for table `reaction`
--

CREATE TABLE IF NOT EXISTS `reaction` (
  `LIKE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `LABEL` varchar(15) NOT NULL,
  `LABEL_ID` int(11) NOT NULL,
  `LIKER_ID` int(11) NOT NULL,
  `DATELIKED` varchar(20) NOT NULL,
  PRIMARY KEY (`LIKE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `reaction`
--

INSERT INTO `reaction` (`LIKE_ID`, `LABEL`, `LABEL_ID`, `LIKER_ID`, `DATELIKED`) VALUES
(1, 'service', 1, 21, '2016-09-21 11:49:16');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `REQUEST_ID` int(6) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(50) NOT NULL,
  `EMAIL` varchar(30) NOT NULL,
  `MESSAGE` varchar(500) NOT NULL,
  PRIMARY KEY (`REQUEST_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `RESERVE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CLIENT_ID` int(11) NOT NULL,
  `HEALER_ID` int(11) NOT NULL,
  `PRODUCT_ID` int(11) NOT NULL,
  `PROD_QTY` int(11) NOT NULL,
  `PRICE` decimal(10,2) NOT NULL,
  `DATEADDED` varchar(20) NOT NULL,
  `STATUS` varchar(15) NOT NULL DEFAULT 'ACTIVE',
  `DATECONFIRMED` varchar(20) NOT NULL,
  PRIMARY KEY (`RESERVE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `SERVICE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `SRVCTYPE_ID` int(11) NOT NULL,
  `ACCT_ID` int(11) NOT NULL,
  `NAME` varchar(60) NOT NULL,
  `DESCRIPTION` varchar(3000) NOT NULL,
  `PRICE` decimal(10,2) NOT NULL,
  `STATUS` varchar(100) NOT NULL DEFAULT 'ACTIVE',
  `PICTURE` varchar(60) NOT NULL,
  `RATE` decimal(5,1) NOT NULL,
  PRIMARY KEY (`SERVICE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`SERVICE_ID`, `SRVCTYPE_ID`, `ACCT_ID`, `NAME`, `DESCRIPTION`, `PRICE`, `STATUS`, `PICTURE`, `RATE`) VALUES
(1, 1, 20, 'Foot Reflexology', 'Like a foot massage that has 80 pressures points to be located and has a corresponding connected organ to your body.\r\n', '0.00', 'ACTIVE', 'service_20Foot Reflexology.png', '1.0');

-- --------------------------------------------------------

--
-- Table structure for table `service_type`
--

CREATE TABLE IF NOT EXISTS `service_type` (
  `SRVCTYPE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `SRVCTYPE` varchar(30) NOT NULL,
  PRIMARY KEY (`SRVCTYPE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `service_type`
--

INSERT INTO `service_type` (`SRVCTYPE_ID`, `SRVCTYPE`) VALUES
(1, 'Home Service'),
(2, 'Clinic Base');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `TRANSACTION_ID` int(11) NOT NULL AUTO_INCREMENT,
  `DATE` varchar(30) NOT NULL,
  `SRVC_CHARGE` decimal(10,0) NOT NULL,
  `HEALER_ID` int(11) NOT NULL,
  `CLIENT_ID` int(11) NOT NULL,
  `TRANS_AMOUNT` int(11) NOT NULL,
  PRIMARY KEY (`TRANSACTION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_detail`
--

CREATE TABLE IF NOT EXISTS `transaction_detail` (
  `TRANSDETAIL_ID` int(11) NOT NULL,
  `TRANSACTION_ID` int(11) NOT NULL,
  `SERVICE_ID` int(11) NOT NULL,
  `PRODUCT_ID` int(11) NOT NULL,
  `QUANTITY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
