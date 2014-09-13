-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 17, 2014 at 12:02 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE IF NOT EXISTS `schools` (
  `school_id` int(11) NOT NULL AUTO_INCREMENT,
  `registered_name` varchar(150) NOT NULL,
  `estab_date` date NOT NULL,
  `is_residential` tinyint(1) NOT NULL,
  `is_coed` tinyint(1) NOT NULL,
  `address_id` bigint(20) NOT NULL,
  `type` tinyint(1) DEFAULT NULL COMMENT 'gov/private\r\n0 gov\r\n1 priv',
  `highest_class` varchar(10) NOT NULL,
  `medium` char(2) DEFAULT NULL COMMENT '0 - english\r\n1- hindi\r\n2 - punjabi',
  PRIMARY KEY (`school_id`),
  KEY `addresses_schools_fk` (`address_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`school_id`, `registered_name`, `estab_date`, `is_residential`, `is_coed`, `address_id`, `type`, `highest_class`, `medium`) VALUES
(1, 'Government Sn. Sec. School, RoopNagar', '2010-08-07', 0, 1, 3, 1, '12', '0');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `schools`
--
ALTER TABLE `schools`
  ADD CONSTRAINT `addresses_schools_fk` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`address_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
