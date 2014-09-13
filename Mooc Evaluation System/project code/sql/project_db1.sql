-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 18, 2013 at 09:46 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project_db`
--
CREATE DATABASE IF NOT EXISTS `project_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `project_db`;

-- --------------------------------------------------------

--
-- Table structure for table `course_table`
--

CREATE TABLE IF NOT EXISTS `course_table` (
  `course_id` int(255) NOT NULL AUTO_INCREMENT,
  `instructor_id` int(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `current_version` int(255) NOT NULL DEFAULT '1',
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exam_table`
--

CREATE TABLE IF NOT EXISTS `exam_table` (
  `exam_id` int(255) NOT NULL AUTO_INCREMENT,
  `master_id` int(255) NOT NULL,
  `exam_key` varchar(255) NOT NULL,
  `num_questions` int(255) NOT NULL DEFAULT '0',
  `complete` tinyint(1) NOT NULL DEFAULT '0',
  `maximum_marks` int(255) NOT NULL DEFAULT '0',
  `highest_marks` int(255) NOT NULL DEFAULT '0',
  `average_marks` int(255) NOT NULL DEFAULT '0',
  `deadline` datetime NOT NULL,
  `timelimit` time NOT NULL,
  `num_students` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`exam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `instructor_table`
--

CREATE TABLE IF NOT EXISTS `instructor_table` (
  `instructor_id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `qualifications` text NOT NULL,
  `areas_of_interest` text NOT NULL,
  PRIMARY KEY (`instructor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_table`
--

CREATE TABLE IF NOT EXISTS `master_table` (
  `master_id` int(255) NOT NULL AUTO_INCREMENT,
  `course_id` int(255) NOT NULL,
  `course_version` int(255) NOT NULL,
  PRIMARY KEY (`master_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `question_table`
--

CREATE TABLE IF NOT EXISTS `question_table` (
  `question_id` int(255) NOT NULL AUTO_INCREMENT,
  `exam_id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `option4` varchar(255) NOT NULL,
  `option1_flag` tinyint(1) NOT NULL DEFAULT '0',
  `option2_flag` tinyint(1) NOT NULL DEFAULT '0',
  `option3_flag` tinyint(1) NOT NULL DEFAULT '0',
  `option4_flag` tinyint(1) NOT NULL DEFAULT '0',
  `tf_flag` tinyint(1) NOT NULL,
  `numerical_answer` float NOT NULL,
  `positive_marks` int(255) NOT NULL DEFAULT '4',
  `negative_marks` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `result_table`
--

CREATE TABLE IF NOT EXISTS `result_table` (
  `result_id` int(255) NOT NULL AUTO_INCREMENT,
  `exam_id` int(255) NOT NULL,
  `master_id` int(255) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `obtained_marks` int(255) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`result_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
