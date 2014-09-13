
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
                father_phone BIGINT NOT NULL,
                father_emailid VARCHAR(50),
                father_occupation_id INT NOT NULL,
                father_edu_qual_id INT NOT NULL,
                mother_first_name VARCHAR(50) NOT NULL,
                mother_last_name VARCHAR(50) NOT NULL,
                mother_middle_name VARCHAR(50),
                mother_phone BIGINT NOT NULL,
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


CREATE TABLE results (
                result_id BIGINT AUTO_INCREMENT NOT NULL,
                result_student_id BIGINT NOT NULL,
                class INT NOT NULL,
                session_year INT NOT NULL,
                status INT DEFAULT -1 NOT NULL,
                score DECIMAL DEFAULT -1 NOT NULL,
                PRIMARY KEY (result_id)
);


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


CREATE TABLE users (
                user_id BIGINT AUTO_INCREMENT NOT NULL,
                user_school_id INT NOT NULL,
                user_emailid VARCHAR(50) NOT NULL,
                pwd_hash VARCHAR(255) NOT NULL,
                PRIMARY KEY (user_id)
);


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

ALTER TABLE sport_activity ADD CONSTRAINT students_sport_activity_fk
FOREIGN KEY (sport_activity_student_id)
REFERENCES students (student_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE results ADD CONSTRAINT results_students_fk
FOREIGN KEY (result_student_id)
REFERENCES students (student_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE enrollments ADD CONSTRAINT schools_student_school_fk
FOREIGN KEY (enrollment_school_id)
REFERENCES schools (school_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE users ADD CONSTRAINT users_schools_fk
FOREIGN KEY (user_school_id)
REFERENCES schools (school_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;


--
-- data entry starts here
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



CREATE TABLE IF NOT EXISTS `castes` (
  `caste_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `caste` varchar(50) NOT NULL,
  PRIMARY KEY (`caste_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

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


CREATE TABLE IF NOT EXISTS `religions` (
  `religion_id` int(11) NOT NULL AUTO_INCREMENT,
  `religion` varchar(15) NOT NULL,
  PRIMARY KEY (`religion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`address_id`, `line1`, `line2`, `city_vpo`, `pin_code`, `home_phone`, `address_district_id`) VALUES
(1, 'Near railway Crossing', NULL, 'Sangrur', 148001, NULL, 1),
(2, 'Near Bus Stand', NULL, 'Ropar', 140001, 1672245587, 2),
(3, 'Flat no 232', 'sai apartment', 'Sangrur', 148001, NULL, 1),
(4, '5/597, lane no.2', 'Farid Nagar', 'Sangrur', 148001, 1672245587, 1);

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
(1, 'Government Sn. Sec. School, RoopNagar', '2010-08-07', 0, 1, 1, 1, '12', '0'),
(2, 'Springdales Public School', '2014-01-20', 0, 1, 2, 0, '11', '0');

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_school_id` int(11) NOT NULL,
  `user_emailid` varchar(50) NOT NULL,
  `pwd_hash` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `users_schools_fk` (`user_school_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_school_id`, `user_emailid`, `pwd_hash`) VALUES
(1, 1, 'abc@example.com', '$2a$08$.dZDuq728ylceuPFnsK1vOIOiRPB/MfmfgvZSb0FWFu6oDH8wHOka'),
(2, 2, 'xyz@example.com', '$2a$08$mz74Ygifk.FAHI12IhuxcOa/bPmT7LMAzfCfSOJ2svFynVtkrHxt2');



CREATE TABLE IF NOT EXISTS `students` (
  `student_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `dob_day` int(11) NOT NULL,
  `dob_month` int(11) NOT NULL,
  `dob_year` int(11) NOT NULL,
  `uid_no` varbinary(20) DEFAULT NULL,
  `father_first_name` varchar(50) NOT NULL,
  `father_last_name` varchar(50) NOT NULL,
  `father_middle_name` varchar(50) DEFAULT NULL,
  `father_phone` bigint(20) NOT NULL,
  `father_emailid` varchar(50) DEFAULT NULL,
  `father_occupation_id` int(11) NOT NULL,
  `father_edu_qual_id` int(11) NOT NULL,
  `mother_first_name` varchar(50) NOT NULL,
  `mother_last_name` varchar(50) NOT NULL,
  `mother_middle_name` varchar(50) DEFAULT NULL,
  `mother_phone` bigint(20) NOT NULL,
  `mother_emailid` varchar(50) DEFAULT NULL,
  `mother_occupation_id` int(11) NOT NULL,
  `mother_edu_qual_id` int(11) NOT NULL,
  `bank_acc_no` bigint(20) NOT NULL,
  `student_bank_id` int(11) NOT NULL,
  `bank_ifsc_code` varchar(50) DEFAULT NULL,
  `bank_branch` varchar(100) NOT NULL,
  `curr_address_id` bigint(20) NOT NULL,
  `perm_address_id` bigint(20) NOT NULL,
  `height` decimal(10,0) NOT NULL,
  `weight` decimal(10,0) NOT NULL,
  `sex` char(1) DEFAULT NULL COMMENT '0 male\r\n1 female\r\n2 other',
  `category` char(2) DEFAULT NULL COMMENT '0 Gen\r\n1 OBC\r\n2 SC/ST',
  `locality` tinyint(1) DEFAULT NULL COMMENT '0 urban\r\n1 rural',
  `is_handicapped` tinyint(1) DEFAULT NULL COMMENT '0 not handicapped\r\n1 handicapped',
  `type_handicap` varchar(100) DEFAULT NULL,
  `student_religion_id` int(11) NOT NULL,
  `student_caste_id` bigint(20) NOT NULL,
  `student_country_id` int(11) NOT NULL,
  `co_curricular_activity` varchar(200) DEFAULT NULL,
  `parents_income` bigint(20) NOT NULL,
  `last_school_name` varchar(100) NOT NULL,
  `last_school_med` int(11) NOT NULL,
  `last_school_type` tinyint(1) NOT NULL,
  `last_class` int(11) NOT NULL,
  `dist_from_home` decimal(10,0) NOT NULL,
  PRIMARY KEY (`student_id`),
  KEY `castes_students_fk` (`student_caste_id`),
  KEY `occupations_students_fk` (`mother_occupation_id`),
  KEY `occupations_students_fk1` (`father_occupation_id`),
  KEY `education_students_fk` (`mother_edu_qual_id`),
  KEY `education_students_fk1` (`father_edu_qual_id`),
  KEY `countries_students_fk` (`student_country_id`),
  KEY `religions_students_fk` (`student_religion_id`),
  KEY `banks_students_fk` (`student_bank_id`),
  KEY `addresses_students_fk` (`curr_address_id`),
  KEY `addresses_students_fk1` (`perm_address_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `last_name`, `middle_name`, `dob_day`, `dob_month`, `dob_year`, `uid_no`, `father_first_name`, `father_last_name`, `father_middle_name`, `father_phone`, `father_emailid`, `father_occupation_id`, `father_edu_qual_id`, `mother_first_name`, `mother_last_name`, `mother_middle_name`, `mother_phone`, `mother_emailid`, `mother_occupation_id`, `mother_edu_qual_id`, `bank_acc_no`, `student_bank_id`, `bank_ifsc_code`, `bank_branch`, `curr_address_id`, `perm_address_id`, `height`, `weight`, `sex`, `category`, `locality`, `is_handicapped`, `type_handicap`, `student_religion_id`, `student_caste_id`, `student_country_id`, `co_curricular_activity`, `parents_income`, `last_school_name`, `last_school_med`, `last_school_type`, `last_class`, `dist_from_home`) VALUES
(1, 'Chaman', 'Lal', NULL, 2, 2, 1993, '', 'Ram', 'Verma', 'Prasad', 9458745879, 'ramprasad@gmail.com', 6, 4, 'Rekha', 'Rani', '', 9145284685, 'adfffdf@sdd.ccom', 5, 3, 323232332322, 12, '4545', 'Ropar', 3, 3, '148', '75', '0', '0', 0, 1, '', 5, 4, 1, 'secy', 0, 'GGS', 4, 0, 6, '10'),
(2, 'Prakhar', 'Asthana', '', 1, 2, 1991, '', 'Arun', 'Asthana', 'Kumar', 9458745879, 'pasdas@dsfs.com', 4, 4, 'Deepti', 'Asthana', '', 9463716695, 'adfffdf@sdd.ccom', 4, 2, 31867904953, 1, '4545', 'Sangrur', 4, 4, '166', '80', '1', '0', 0, 1, '', 2, 3, 1, '', 121221, 'GGS', 1, 0, 4, '5');
