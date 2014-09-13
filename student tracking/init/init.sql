
CREATE TABLE castes (
                caste_id BIGINT AUTO_INCREMENT NOT NULL,
                caste VARCHAR(50) NOT NULL,
                PRIMARY KEY (caste_id)
);


CREATE TABLE sports (
                sport_id INT AUTO_INCREMENT NOT NULL,
                sport_name VARCHAR(10) NOT NULL,
                PRIMARY KEY (sport_id)
);


CREATE TABLE occupations (
                occupation_id INT AUTO_INCREMENT NOT NULL,
                occupation VARCHAR(20) NOT NULL,
                PRIMARY KEY (occupation_id)
);


CREATE TABLE education (
                edu_qual_id INT AUTO_INCREMENT NOT NULL,
                edu_qual VARCHAR(20) NOT NULL,
                PRIMARY KEY (edu_qual_id)
);


CREATE TABLE countries (
                country_id INT AUTO_INCREMENT NOT NULL,
                country VARCHAR(30) NOT NULL,
                PRIMARY KEY (country_id)
);


CREATE TABLE religions (
                religion_id INT AUTO_INCREMENT NOT NULL,
                religion VARCHAR(15) NOT NULL,
                PRIMARY KEY (religion_id)
);


CREATE TABLE banks (
                bank_id INT AUTO_INCREMENT NOT NULL,
                bank_name VARCHAR(100) NOT NULL,
                PRIMARY KEY (bank_id)
);


CREATE TABLE persons (
                person_id BIGINT AUTO_INCREMENT NOT NULL,
                type VARCHAR(10) NOT NULL,
                first_name VARCHAR(100) NOT NULL,
                last_name VARCHAR(100) NOT NULL,
                middle_name VARCHAR(100),
                gender CHAR(1) NOT NULL,
                title VARCHAR(20),
                PRIMARY KEY (person_id)
);


CREATE TABLE states (
                state_id INT AUTO_INCREMENT NOT NULL,
                state VARCHAR(50) NOT NULL,
                code VARCHAR(5) NOT NULL,
                PRIMARY KEY (state_id)
);


CREATE TABLE districts (
                district_id INT AUTO_INCREMENT NOT NULL,
                district_state_id INT NOT NULL,
                district VARCHAR(100) NOT NULL,
                PRIMARY KEY (district_id)
);


CREATE TABLE addresses (
                address_id BIGINT AUTO_INCREMENT NOT NULL,
                line1 VARCHAR(250) NOT NULL,
                line2 VARCHAR(250),
                city_vpo VARCHAR(150) NOT NULL,
                pin_code INT NOT NULL,
                home_phone INT,
                address_district_id INT NOT NULL,
                PRIMARY KEY (address_id)
);


CREATE TABLE students (
                student_id BIGINT AUTO_INCREMENT NOT NULL,
                first_name VARCHAR(50) NOT NULL,
                last_name VARCHAR(50) NOT NULL,
                middle_name VARCHAR(50),
                dob_day INT NOT NULL,
                dob_month INT NOT NULL,
                dob_year INT NOT NULL,
                uid_no VARBINARY(20),
                father_first_name VARCHAR(50) NOT NULL,
                father_last_name VARCHAR(50) NOT NULL,
                father_middle_name VARCHAR(50),
                father_phone INT,
                father_emailid VARCHAR(50),
                father_occupation_id INT NOT NULL,
                father_edu_qual_id INT NOT NULL,
                mother_first_name VARCHAR(50) NOT NULL,
                mother_last_name VARCHAR(50) NOT NULL,
                mother_middle_name VARCHAR(50),
                mother_phone INT,
                mother_emailid VARCHAR(50),
                mother_occupation_id INT NOT NULL,
                mother_edu_qual_id INT NOT NULL,
                bank_acc_no BIGINT NOT NULL,
                student_bank_id INT NOT NULL,
                bank_ifsc_code VARCHAR(50),
                bank_branch VARCHAR(100) NOT NULL,
                curr_address_id BIGINT NOT NULL,
                perm_address_id BIGINT NOT NULL,
                height DECIMAL NOT NULL,
                weight DECIMAL NOT NULL,
                sex CHAR(1) NOT NULL,
                category CHAR(2) NOT NULL,
                locality BOOLEAN NOT NULL,
                is_handicapped BOOLEAN DEFAULT 0 NOT NULL,
                type_handicap VARCHAR(100),
                student_religion_id INT NOT NULL,
                student_caste_id BIGINT NOT NULL,
                student_country_id INT NOT NULL,
                co_curricular_activity VARCHAR(200),
                parents_income BIGINT NOT NULL,
                last_school_name VARCHAR(100) NOT NULL,
                last_school_med INT NOT NULL,
                last_school_type BOOLEAN NOT NULL,
                last_class INT NOT NULL,
                dist_from_home DECIMAL NOT NULL,
                PRIMARY KEY (student_id)
);

ALTER TABLE students MODIFY COLUMN sex CHAR(1) COMMENT '0 male
1 female
2 other';

ALTER TABLE students MODIFY COLUMN category CHAR(2) COMMENT '0 Gen
1 OBC
2 SC/ST';

ALTER TABLE students MODIFY COLUMN locality BOOLEAN COMMENT '0 urban
1 rural';

ALTER TABLE students MODIFY COLUMN is_handicapped BOOLEAN COMMENT '0 not handicapped
1 handicapped';


CREATE TABLE sport_activity (
                sport_activity_id BIGINT AUTO_INCREMENT NOT NULL,
                sport_activity_student_id BIGINT NOT NULL,
                sport_activity_sport_id INT NOT NULL,
                sport_activity_level VARCHAR(10) NOT NULL,
                PRIMARY KEY (sport_activity_id)
);


CREATE TABLE schools (
                school_id INT AUTO_INCREMENT NOT NULL,
                registered_name VARCHAR(150) NOT NULL,
                estab_date DATE NOT NULL,
                is_residential BOOLEAN NOT NULL,
                is_coed BOOLEAN NOT NULL,
                address_id BIGINT NOT NULL,
                type BOOLEAN NOT NULL,
                highest_class VARCHAR(10) NOT NULL,
                medium CHAR(2) NOT NULL,
                PRIMARY KEY (school_id)
);

ALTER TABLE schools MODIFY COLUMN type BOOLEAN COMMENT 'gov/private
0 gov
1 priv';

ALTER TABLE schools MODIFY COLUMN medium CHAR(2) COMMENT '0 - english
1- hindi
2 - punjabi
3 - urdu';


CREATE TABLE previous_qual (
                qual_id BIGINT AUTO_INCREMENT NOT NULL,
                qual_type VARCHAR(5) NOT NULL,
                roll_no VARCHAR(25) NOT NULL,
                max_marks INT NOT NULL,
                marks_obtained DECIMAL NOT NULL,
                yesr VARCHAR(10) NOT NULL,
                subject VARCHAR(20) NOT NULL,
                school_id INT NOT NULL,
                student_id BIGINT NOT NULL,
                PRIMARY KEY (qual_id)
);

ALTER TABLE previous_qual MODIFY COLUMN subject VARCHAR(20) COMMENT 'Arts, Commerce, Non-Med, Medical, Med-NonMed';


CREATE TABLE enrollments (
                enrollment_id BIGINT AUTO_INCREMENT NOT NULL,
                enrollment_student_id BIGINT NOT NULL,
                enrollment_school_id INT NOT NULL,
                entry_date DATE NOT NULL,
                exit_date DATE,
                entry_no VARCHAR(50) NOT NULL,
                reg_no VARCHAR(50),
                PRIMARY KEY (enrollment_id)
);


ALTER TABLE students ADD CONSTRAINT castes_students_fk
FOREIGN KEY (student_caste_id)
REFERENCES castes (caste_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE sport_activity ADD CONSTRAINT sport_activity_sports_fk
FOREIGN KEY (sport_activity_sport_id)
REFERENCES sports (sport_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE students ADD CONSTRAINT occupations_students_fk
FOREIGN KEY (mother_occupation_id)
REFERENCES occupations (occupation_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE students ADD CONSTRAINT occupations_students_fk1
FOREIGN KEY (father_occupation_id)
REFERENCES occupations (occupation_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE students ADD CONSTRAINT education_students_fk
FOREIGN KEY (mother_edu_qual_id)
REFERENCES education (edu_qual_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE students ADD CONSTRAINT education_students_fk1
FOREIGN KEY (father_edu_qual_id)
REFERENCES education (edu_qual_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE students ADD CONSTRAINT countries_students_fk
FOREIGN KEY (student_country_id)
REFERENCES countries (country_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE students ADD CONSTRAINT religions_students_fk
FOREIGN KEY (student_religion_id)
REFERENCES religions (religion_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE students ADD CONSTRAINT banks_students_fk
FOREIGN KEY (student_bank_id)
REFERENCES banks (bank_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE districts ADD CONSTRAINT states_districts_fk
FOREIGN KEY (district_state_id)
REFERENCES states (state_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE addresses ADD CONSTRAINT districts_addresses_fk
FOREIGN KEY (address_district_id)
REFERENCES districts (district_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE schools ADD CONSTRAINT addresses_schools_fk
FOREIGN KEY (address_id)
REFERENCES addresses (address_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE students ADD CONSTRAINT addresses_students_fk
FOREIGN KEY (curr_address_id)
REFERENCES addresses (address_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE students ADD CONSTRAINT addresses_students_fk1
FOREIGN KEY (perm_address_id)
REFERENCES addresses (address_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE enrollments ADD CONSTRAINT students_student_school_fk
FOREIGN KEY (enrollment_student_id)
REFERENCES students (student_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE previous_qual ADD CONSTRAINT students_previous_qual_fk
FOREIGN KEY (student_id)
REFERENCES students (student_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE sport_activity ADD CONSTRAINT students_sport_activity_fk
FOREIGN KEY (sport_activity_student_id)
REFERENCES students (student_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE enrollments ADD CONSTRAINT schools_student_school_fk
FOREIGN KEY (enrollment_school_id)
REFERENCES schools (school_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE previous_qual ADD CONSTRAINT schools_previous_qual_fk
FOREIGN KEY (school_id)
REFERENCES schools (school_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;
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
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(50) NOT NULL,
  `code` varchar(5) NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state_id`, `state`, `code`) VALUES
(1, 'Punjab', ''),
(2, 'Haryana', ''),
(3, 'Delhi', ''),
(4, 'Rajasthan', '');

-- Table structure for table `religions`
--

CREATE TABLE IF NOT EXISTS `religions` (
  `religion_id` int(11) NOT NULL AUTO_INCREMENT,
  `religion` varchar(15) NOT NULL,
  PRIMARY KEY (`religion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `religions`
--

INSERT INTO `religions` (`religion_id`, `religion`) VALUES
(1, 'Hindu'),
(2, 'Sikh'),
(3, 'Muslim'),
(4, 'Christian'),
(5, 'Jain'),
(6, 'Parsi'),
(7, 'Buddhist'),
(8, 'No Religion'),
(9, 'Other');

CREATE TABLE IF NOT EXISTS `castes` (
  `caste_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `caste` varchar(50) NOT NULL,
  PRIMARY KEY (`caste_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `castes`
--

INSERT INTO `castes` (`caste_id`, `caste`) VALUES
(1, 'Agarwal'),
(2, 'Arora'),
(3, 'Rajput'),
(4, 'Khatri'),
(5, 'Jat'),
(6, 'Bhatia'),
(7, 'Other');


CREATE TABLE IF NOT EXISTS `banks` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(100) NOT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`bank_id`, `bank_name`) VALUES
(1, 'State Bank of India'),
(2, 'HDFC Bank'),
(3, 'Punjab National Bank'),
(4, 'ICICI Bank'),
(5, 'Yes Bank'),
(6, 'Bank of India'),
(7, 'Axis Bank'),
(8, 'Allahabad Bank'),
(9, 'Andhra Bank'),
(10, 'Canara Bank'),
(11, 'Syndicate Bank'),
(12, 'Co-operative Bank');


CREATE TABLE IF NOT EXISTS `countries` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(30) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country`) VALUES
(1, 'india'),
(2, 'pakistan'),
(3, 'other');



CREATE TABLE IF NOT EXISTS `education` (
  `edu_qual_id` int(11) NOT NULL AUTO_INCREMENT,
  `edu_qual` varchar(20) NOT NULL,
  PRIMARY KEY (`edu_qual_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`edu_qual_id`, `edu_qual`) VALUES
(1, 'Primary'),
(2, 'Metric'),
(3, 'Secondary'),
(4, 'Diploma'),
(5, 'Graduate'),
(6, 'PostGraduate');

-- Table structure for table `occupations`
--

CREATE TABLE IF NOT EXISTS `occupations` (
  `occupation_id` int(11) NOT NULL AUTO_INCREMENT,
  `occupation` varchar(20) NOT NULL,
  PRIMARY KEY (`occupation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `occupations`
--

INSERT INTO `occupations` (`occupation_id`, `occupation`) VALUES
(1, 'BusinessMan'),
(2, 'Doctor'),
(3, 'Engineer'),
(4, 'Farmer'),
(5, 'Govt. Employee'),
(6, 'Lawyer'),
(7, 'Shopkeeper'),
(8, 'Other'),
(9, 'BusinessWoman'),
(10, 'HouseWife');


-- Table structure for table `districts`
--

CREATE TABLE IF NOT EXISTS `districts` (
  `district_id` int(11) NOT NULL AUTO_INCREMENT,
  `district_state_id` int(11) NOT NULL,
  `district` varchar(100) NOT NULL,
  PRIMARY KEY (`district_id`),
  KEY `states_districts_fk` (`district_state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`district_id`, `district_state_id`, `district`) VALUES
(1, 1, 'Sangrur'),
(2, 1, 'Ropar');

--
-- Constraints for dumped tables
--

CREATE TABLE IF NOT EXISTS `addresses` (
  `address_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `line1` varchar(250) NOT NULL,
  `line2` varchar(250) DEFAULT NULL,
  `city_vpo` varchar(150) NOT NULL,
  `pin_code` int(11) NOT NULL,
  `home_phone` int(11) DEFAULT NULL,
  `address_district_id` int(11) NOT NULL,
  PRIMARY KEY (`address_id`),
  KEY `districts_addresses_fk` (`address_district_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`address_id`, `line1`, `line2`, `city_vpo`, `pin_code`, `home_phone`, `address_district_id`) VALUES
(1, 'Near railway Crossing', NULL, 'Sangrur', 148001, NULL, 1);

--
-- Constraints for dumped tables
--

--
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
  `medium` char(2) DEFAULT NULL COMMENT '0 - english\r\n1- hindi\r\n2 - punjabi\r\n3 - urdu',
  PRIMARY KEY (`school_id`),
  KEY `addresses_schools_fk` (`address_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`school_id`, `registered_name`, `estab_date`, `is_residential`, `is_coed`, `address_id`, `type`, `highest_class`, `medium`) VALUES
(1, 'Government Sn. Sec. School, RoopNagar', '2010-08-07', 0, 1, 1, 1, '12', '0');

--
-- Constraints for dumped tables
--
