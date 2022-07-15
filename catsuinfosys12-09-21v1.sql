-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2021 at 07:54 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catsuinfosys`
--

-- --------------------------------------------------------

--
-- Table structure for table `catsu_academicyr`
--

CREATE TABLE `catsu_academicyr` (
  `acad_yearid` int(10) NOT NULL,
  `year_start` varchar(200) DEFAULT NULL,
  `year_end` varchar(200) DEFAULT NULL,
  `semester` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catsu_academicyr`
--

INSERT INTO `catsu_academicyr` (`acad_yearid`, `year_start`, `year_end`, `semester`) VALUES
(5, '2021', '2022', '1st'),
(6, '2021', '2022', '2nd'),
(7, '2021', '2022', '1st');

-- --------------------------------------------------------

--
-- Table structure for table `catsu_admin`
--

CREATE TABLE `catsu_admin` (
  `admin_id` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `admin_username` varchar(100) DEFAULT NULL,
  `admin_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catsu_admin`
--

INSERT INTO `catsu_admin` (`admin_id`, `firstname`, `lastname`, `admin_username`, `admin_password`) VALUES
(1, 'CatSU', 'Admin', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918');

-- --------------------------------------------------------

--
-- Table structure for table `catsu_colleges`
--

CREATE TABLE `catsu_colleges` (
  `college_name` varchar(20) NOT NULL,
  `college_desc` varchar(200) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `facultyID` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catsu_colleges`
--

INSERT INTO `catsu_colleges` (`college_name`, `college_desc`, `student_id`, `facultyID`) VALUES
('CAF', 'College of Agriculture and Fisheries', NULL, NULL),
('CAS', 'College of Arts and Sciences', NULL, NULL),
('CBA', 'College of Business and Accountancy', NULL, NULL),
('CHS', 'College of Health Sciences', NULL, NULL),
('CICT', 'College of Information and Communications Technology', NULL, NULL),
('CIT', 'College of Industrial Technology', NULL, NULL),
('COE', 'College of Engineering', NULL, NULL),
('CoEd', 'College of Education', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `catsu_courses`
--

CREATE TABLE `catsu_courses` (
  `course_id` int(11) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `course_college` varchar(20) NOT NULL,
  `course_csccode` varchar(20) NOT NULL,
  `course_desc` varchar(255) NOT NULL,
  `course_level` int(11) NOT NULL,
  `course_sem` int(11) DEFAULT NULL,
  `course_program` int(11) NOT NULL,
  `course_unit` int(11) NOT NULL,
  `course_student` int(11) DEFAULT NULL,
  `course_faculty` int(11) DEFAULT NULL,
  `status` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catsu_courses`
--

INSERT INTO `catsu_courses` (`course_id`, `course_code`, `course_college`, `course_csccode`, `course_desc`, `course_level`, `course_sem`, `course_program`, `course_unit`, `course_student`, `course_faculty`, `status`) VALUES
(1, 'CC101', 'CICT', '', 'Introduction to Computing', 1, 1, 1, 0, NULL, NULL, 1),
(2, 'CC102', 'CICT', '', 'Computer Programming 1', 1, 1, 1, 0, NULL, NULL, 1),
(3, 'GEC1', '', '', 'Understanding the Self', 1, 1, 1, 0, NULL, NULL, 1),
(4, 'GEC4', '', '', 'Mathematics in the Modern World', 1, 1, 1, 0, NULL, NULL, 1),
(5, 'GEC7', '', '', 'Science, Technology and Society', 1, 1, 1, 0, NULL, NULL, 1),
(6, 'GEC10', '', '', 'Kontekstwalisadong Komunikasyon sa Filipino (KOMFIL)', 1, 1, 1, 0, NULL, NULL, 1),
(7, 'PE1', '', '', 'Wellness and Fitness', 1, 1, 1, 0, NULL, NULL, 1),
(8, 'NSTP1', '', '', 'National Science Training Program 1', 1, 1, 1, 0, NULL, NULL, 1),
(9, 'CC103', 'CICT', '', 'Computer Programming 2', 1, 2, 1, 0, NULL, NULL, 1),
(10, 'ITP112', 'CICT', '', 'Discrete Mathematics', 1, 2, 1, 0, NULL, NULL, 1),
(11, 'ITP212', 'CICT', '', 'Introduction to Human Computer Interaction', 1, 2, 1, 0, NULL, NULL, 1),
(12, 'GEC2', '', '', 'Readings in Philippine History', 1, 2, 1, 0, NULL, NULL, 1),
(13, 'GEC6', '', '', 'Art Appreciation', 1, 2, 1, 0, NULL, NULL, 1),
(14, 'GEC11', '', '', 'Masining na Pagpapahayag', 1, 2, 1, 0, NULL, NULL, 1),
(15, 'PE2', '', '', 'Self-Defense', 1, 2, 1, 0, NULL, NULL, 1),
(16, 'NSTP2', '', '', 'National Science Training Program 2', 1, 2, 1, 0, NULL, NULL, 1),
(17, 'CC104', 'CICT', '', 'Data Structures and Algorithms', 2, 1, 1, 0, NULL, NULL, 1),
(18, 'ITRACKA1', 'CICT', '', 'Platform Technologies: Advanced Operating', 2, 1, 1, 0, NULL, NULL, 1),
(19, 'ITRACKB1', 'CICT', '', 'Web Systems and Technologies: Web Design', 2, 1, 1, 0, NULL, NULL, 1),
(20, 'ITP322', 'CICT', '', 'Integrative Programming and Technologies 1', 2, 1, 1, 0, NULL, NULL, 1),
(21, 'GEC5', '', '', 'Purposive Communication', 2, 1, 1, 0, NULL, NULL, 1),
(22, 'GEC8', '', '', 'Ethics', 2, 1, 1, 0, NULL, NULL, 1),
(23, 'GEC12', '', '', 'Panitikan ng Pilipinas', 2, 1, 1, 0, NULL, NULL, 1),
(24, 'PE3', '', '', 'Swimming', 2, 1, 1, 0, NULL, NULL, 1),
(25, 'CC105', 'CICT', '', 'Information Management', 2, 2, 1, 0, NULL, NULL, 1),
(26, 'ITP422', 'CICT', '', 'Networking 1', 2, 2, 1, 0, NULL, NULL, 1),
(27, 'ITP522', 'CICT', '', 'Quantitative Methods', 2, 2, 1, 0, NULL, NULL, 1),
(28, 'ITP622', 'CICT', '', 'Systems Integration and Architecture', 2, 2, 1, 0, NULL, NULL, 1),
(29, 'ITRACKC1', 'CICT', '', 'Integrative Programming and Technologies', 2, 2, 1, 0, NULL, NULL, 1),
(30, 'GEC9', '', '', 'The Life and Works of Rizal', 2, 2, 1, 0, NULL, NULL, 1),
(31, 'GEC3', '', '', 'The Contemporary World', 2, 2, 1, 0, NULL, NULL, 1),
(32, 'PE4', '', '', 'Team Games and Sports', 2, 2, 1, 0, NULL, NULL, 1),
(33, 'ITP731', 'CICT', '', 'Advanced Database Systems', 3, 1, 1, 0, NULL, NULL, 1),
(34, 'ITP831', 'CICT', '', 'Networking 2', 3, 1, 1, 0, NULL, NULL, 1),
(35, 'ITP931', 'CICT', '', 'Seminar on Special Topics in Information', 3, 1, 1, 0, NULL, NULL, 1),
(36, 'ITP1031', 'CICT', '', 'Research Methods', 3, 1, 1, 0, NULL, NULL, 1),
(37, 'ITRACKA2', 'CICT', '', 'Platform Technologies: Mobile Application Development', 3, 1, 1, 0, NULL, NULL, 1),
(38, 'ITRACKB2', 'CICT', '', 'Web Systems and Technologies: E-commerce', 3, 1, 1, 0, NULL, NULL, 1),
(39, 'ITRACKC2', 'CICT', '', 'Integrative Programming and Technologies 2: Events-Driven Programming', 3, 1, 1, 0, NULL, NULL, 1),
(40, 'CC106', 'CICT', '', 'Application Development and Emerging Technologies', 3, 2, 1, 0, NULL, NULL, 1),
(41, 'ITP1132', 'CICT', '', 'Social and Professional Issues', 3, 2, 1, 0, NULL, NULL, 1),
(42, 'ITP1232', 'CICT', '', 'Information Assurance and Security 1', 3, 2, 1, 0, NULL, NULL, 1),
(43, 'CAP101', 'CICT', '', 'Capstone Project 1', 3, 2, 1, 0, NULL, NULL, 1),
(44, 'ITRACKA3', 'CICT', '', 'Platform Technologies: Data-Driven Mobile Application', 3, 2, 1, 0, NULL, NULL, 1),
(45, 'ITRACKB3', 'CICT', '', 'Web Systems and Technologies', 3, 2, 1, 0, NULL, NULL, 1),
(46, 'ITP1333', 'CICT', 'ITP1333', 'Information Assurance and Security 2', 4, 1, 1, 0, NULL, NULL, 1),
(47, 'ITP1441', 'CICT', '', 'Systems Administration and Maintenance', 4, 1, 1, 0, NULL, NULL, 1),
(48, 'CAP102', 'CICT', '', 'Capstone Project 2', 4, 1, 1, 0, NULL, NULL, 1),
(49, 'ITRACKA4', 'CICT', '', 'Platform Technologies: Emerging Trends in Mobile Technology', 4, 1, 1, 0, NULL, NULL, 1),
(50, 'ITRACKB4', 'CICT', '', 'Web Systems and Technologies: Web Programming 2', 4, 1, 1, 0, NULL, NULL, 1),
(51, 'INT420', 'CICT', '', 'Internship/On-The-Job Training (486 hrs. required)', 4, 2, 1, 0, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `catsu_faculty`
--

CREATE TABLE `catsu_faculty` (
  `facultyID` int(20) NOT NULL,
  `faculty_fname` varchar(200) NOT NULL,
  `faculty_mname` varchar(200) NOT NULL,
  `faculty_lname` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_role` varchar(200) NOT NULL,
  `faculty_level` varchar(200) NOT NULL,
  `college_name` varchar(20) NOT NULL,
  `status` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catsu_faculty`
--

INSERT INTO `catsu_faculty` (`facultyID`, `faculty_fname`, `faculty_mname`, `faculty_lname`, `username`, `user_pass`, `user_role`, `faculty_level`, `college_name`, `status`) VALUES
(12, 'Erickson', 'T.', 'Salazar', 'Erickson', '$2y$10$DM8Zr5Ix7pA0mfLpKqpk/OIz/2kk54nivDpJtDJsLpSQm/D9H1G3u', 'faculty', 'Instructor 1', 'CICT', 1),
(13, 'Romeo', 'S.', 'Camano', 'Romeo', '$2y$10$RqyISqSmliK09HvdOiDfRewhW34cc5.zTlK.GW8/xBXYJ53hcd46C', 'faculty', 'Instructor 1', 'CICT', 1),
(14, 'Arejay', 'O.', 'Tabirara', 'Arejay', '$2y$10$VrqwbFINQ0OzoSD/hSMSTO.PPKphwcW85OS6X5ZocEjzRwZ2/3mFG', 'faculty', 'Instructor 1', 'CICT', 0),
(15, 'Gemma', 'G.', 'Acedo', 'Gemma', '$2y$10$nm8bdZhCTTC9s9khiT6k5OgnDQXB86en6XIAPeNWYP5v23eZiRQ6O', 'faculty', 'Associate Professor 3', 'CICT', 0),
(16, 'Aster Vivien', 'C.', 'Vargas', 'Aster Vivien', '$2y$10$rLVGbzMskU6AspqOsk1UoubT.nkjUbYZxo3AC88SNzwVVq7DSTRoe', 'faculty', 'Instructor 3', 'CICT', 0),
(24, 'Charles', 'C.', 'Tresmanio', 'Charles', '$2y$10$NmkTzyAqbJqvk/Hh8pSjWurimZmEzXWeLIeGMJdKNZ4tQpSiOkMxi', 'faculty', 'Instructor 1', 'CoEd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `catsu_programs`
--

CREATE TABLE `catsu_programs` (
  `program_id` int(11) NOT NULL,
  `program_code` varchar(100) NOT NULL,
  `program_name` varchar(100) NOT NULL,
  `program_college` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catsu_programs`
--

INSERT INTO `catsu_programs` (`program_id`, `program_code`, `program_name`, `program_college`) VALUES
(1, 'BSINFOTECH', 'Bachelor of Science in Information Technology', 'CICT'),
(2, 'BSINFOSYS', 'Bachelor of Science in Information System', 'CICT'),
(3, 'BSCOMSCI', 'Bachelor of Science in Computer Science', 'CICT');

-- --------------------------------------------------------

--
-- Table structure for table `catsu_semester`
--

CREATE TABLE `catsu_semester` (
  `sem_id` int(10) NOT NULL,
  `sem_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catsu_semester`
--

INSERT INTO `catsu_semester` (`sem_id`, `sem_name`) VALUES
(1, '1st'),
(2, '2nd');

-- --------------------------------------------------------

--
-- Table structure for table `catsu_student`
--

CREATE TABLE `catsu_student` (
  `student_id` int(11) NOT NULL,
  `student_no` varchar(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `gender` varchar(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `program` int(11) NOT NULL,
  `block` int(11) DEFAULT NULL,
  `yearlevel` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catsu_student`
--

INSERT INTO `catsu_student` (`student_id`, `student_no`, `firstname`, `lastname`, `gender`, `address`, `program`, `block`, `yearlevel`, `password`, `status`) VALUES
(1, '2018-00762', 'Mel Carlos', 'Timbreza', 'Male', 'Cabcab/San Andres/Catanduanes', 1, 3, 4, '$2y$10$kvCYb0saBgOU0Q.msM41Weydg.v8kXxHwEKkG5F1EzbKmoBOcYbhK', 1),
(2, '2018-00757', 'Khalil Gibran', 'Coral', 'Male', 'Lictin/San Andres/Catanduanes', 1, 3, 4, '$2y$10$oC9P0xo/kMYOrQJ0vZMKyO3CEdE.fjRryyCb6/ryQ.8bP5sclyE.W', 1),
(3, '2018-02117', 'Elerey Joyce Marie', 'Toledana', 'Female', '', 1, 3, 4, '$2y$10$B38DDjRvryrahlB/oXUb0uDaYmDe6xsBkJTRTM4XItTGIFXrHc1Sa', 1),
(4, '2018-01054', 'John Robert', 'Bozar', 'Male', '', 1, 3, 4, '$2y$10$/i5uvbSG9ll7qfyJvns7Oen7AUvkO4FWy81x/CzAZwr21JmWch1ay', 1),
(5, '2018-00685', 'Leo Charlie', 'Chavez', 'Male', '', 1, 3, 4, '$2y$10$pCSzMieQ5G2SbKCdut1ZkufsNYr6Ct4dbGklLK8QX9k5yHttad9rG', 1),
(6, '2018-00675', 'Keziah Marie', 'Rodriguez', 'Female', '', 1, 3, 4, '$2y$10$sduCZFg2gSm829DoY2jeVuGV8Nwm4zCpAGiY8TU1LCvJ2f/0Ky3fK', 1),
(7, '2018-00852', 'Lowen Andrei', 'Bognot', 'Male', '', 1, 3, 4, '$2y$10$YkzQSNM1u9rGBTGak.oEmeN7VFIVWbYwaJGVoDgFeEHfcURkP764e', 1),
(8, '2018-01073', 'Frank Lee', 'Tayo', 'Male', '', 1, 3, 4, '$2y$10$qDZ35FbBf9Exdc9quXzH0ebXadal8NW/KizUnANUyu0ZScQOOti6y', 1),
(9, '2018-00391', 'Paul Kevin', 'Panti', 'Male', '', 1, 3, 4, '$2y$10$90GPxVtVH5q47CNv8G6aEedz6rdrRnohLwwlVH2zacLWWt7dz96y.', 1),
(10, '2077-00420', 'Felix', 'Kjelberg', 'Male', 'Cabcab/San Andres/Catanduanes', 1, NULL, 3, '$2y$10$PTIQHV8Jml3.Yn6L5amNdekQPCl9p0gUe/kK0Q6SI/eSllrGSVhke', 0),
(13, '2018-00758', 'Karen', 'Temporado', 'Female', 'Lictin/San Andres/ Catanduanes', 2, 1, 4, '$2y$10$1G4ZsaFc98fsFBziD67Oy.3ksozSD/T9Oi5ciAceoBfaQJTN3S9oK', 0);

-- --------------------------------------------------------

--
-- Table structure for table `course_sched`
--

CREATE TABLE `course_sched` (
  `sched_id` int(11) NOT NULL,
  `schedule` varchar(20) NOT NULL,
  `sched_courseid` int(11) NOT NULL,
  `sched_programid` int(11) NOT NULL,
  `sched_facultyid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_assigned`
--

CREATE TABLE `faculty_assigned` (
  `assign_id` int(11) NOT NULL,
  `faculty_id` int(10) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `program` int(10) NOT NULL,
  `year` int(10) NOT NULL,
  `block` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty_assigned`
--

INSERT INTO `faculty_assigned` (`assign_id`, `faculty_id`, `course_code`, `program`, `year`, `block`) VALUES
(1, 13, 'ITP1441', 1, 4, 'C'),
(3, 13, 'ITP1333', 1, 4, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_profileimg`
--

CREATE TABLE `faculty_profileimg` (
  `id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty_profileimg`
--

INSERT INTO `faculty_profileimg` (`id`, `faculty_id`, `status`) VALUES
(10, 12, 1),
(11, 13, 1),
(12, 14, 1),
(13, 15, 1),
(14, 16, 1),
(15, 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_blocking`
--

CREATE TABLE `student_blocking` (
  `block_id` int(11) NOT NULL,
  `block_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_blocking`
--

INSERT INTO `student_blocking` (`block_id`, `block_name`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D'),
(5, 'E'),
(6, 'F'),
(7, 'G'),
(8, 'H'),
(9, 'I'),
(10, 'J'),
(11, 'K'),
(12, 'L'),
(13, 'M'),
(14, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `student_grade`
--

CREATE TABLE `student_grade` (
  `grade_id` int(11) NOT NULL,
  `grade_midterm` double NOT NULL,
  `grade_final` double NOT NULL,
  `grade_programid` int(11) NOT NULL,
  `grade_courseid` int(11) NOT NULL,
  `grade_yearlevel` int(11) NOT NULL,
  `sem_id` int(10) DEFAULT NULL,
  `grade_studentid` int(11) DEFAULT NULL,
  `grade_facultyid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_grade`
--

INSERT INTO `student_grade` (`grade_id`, `grade_midterm`, `grade_final`, `grade_programid`, `grade_courseid`, `grade_yearlevel`, `sem_id`, `grade_studentid`, `grade_facultyid`) VALUES
(0, 2, 2.3, 1, 47, 4, NULL, 9, 12),
(1, 1, 1, 1, 49, 4, NULL, 2, 12),
(2, 3, 1, 1, 48, 4, NULL, 2, 12),
(3, 1.5, 1, 1, 46, 4, NULL, 2, 12),
(4, 1.2, 1, 1, 47, 4, NULL, 2, 12),
(5, 1.8, 1, 1, 50, 4, NULL, 2, 12),
(6, 1, 1, 1, 51, 4, NULL, 2, 12),
(7, 2, 2.3, 1, 50, 4, NULL, 7, 12);

-- --------------------------------------------------------

--
-- Table structure for table `student_profileimg`
--

CREATE TABLE `student_profileimg` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_profileimg`
--

INSERT INTO `student_profileimg` (`id`, `student_id`, `status`) VALUES
(18, 1, 1),
(19, 2, 1),
(20, 3, 1),
(21, 4, 1),
(22, 5, 1),
(23, 6, 1),
(24, 7, 1),
(25, 8, 1),
(26, 9, 1),
(28, 10, 1),
(29, 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_yearlevel`
--

CREATE TABLE `student_yearlevel` (
  `year_id` int(11) NOT NULL,
  `year_level` varchar(11) NOT NULL,
  `year_name` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_yearlevel`
--

INSERT INTO `student_yearlevel` (`year_id`, `year_level`, `year_name`) VALUES
(1, '1st', 'First'),
(2, '2nd', 'Second'),
(3, '3rd', 'Third'),
(4, '4th', 'Fourth');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catsu_academicyr`
--
ALTER TABLE `catsu_academicyr`
  ADD PRIMARY KEY (`acad_yearid`);

--
-- Indexes for table `catsu_admin`
--
ALTER TABLE `catsu_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `catsu_colleges`
--
ALTER TABLE `catsu_colleges`
  ADD PRIMARY KEY (`college_name`),
  ADD KEY `studentID` (`student_id`),
  ADD KEY `facultyID` (`facultyID`);

--
-- Indexes for table `catsu_courses`
--
ALTER TABLE `catsu_courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `courselevel_key` (`course_level`),
  ADD KEY `courseprogram_key` (`course_program`),
  ADD KEY `coursesemester_key` (`course_sem`),
  ADD KEY `course_student_key` (`course_student`),
  ADD KEY `coursefaculty_key` (`course_faculty`),
  ADD KEY `course_collegekey` (`course_college`) USING BTREE,
  ADD KEY `course_code` (`course_code`);

--
-- Indexes for table `catsu_faculty`
--
ALTER TABLE `catsu_faculty`
  ADD PRIMARY KEY (`facultyID`),
  ADD KEY `college_name` (`college_name`);

--
-- Indexes for table `catsu_programs`
--
ALTER TABLE `catsu_programs`
  ADD PRIMARY KEY (`program_id`),
  ADD KEY `programcollege_key` (`program_college`),
  ADD KEY `program_code` (`program_code`);

--
-- Indexes for table `catsu_semester`
--
ALTER TABLE `catsu_semester`
  ADD PRIMARY KEY (`sem_id`);

--
-- Indexes for table `catsu_student`
--
ALTER TABLE `catsu_student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `program_key` (`program`),
  ADD KEY `block_key` (`block`),
  ADD KEY `yearLvl_key` (`yearlevel`);

--
-- Indexes for table `course_sched`
--
ALTER TABLE `course_sched`
  ADD PRIMARY KEY (`sched_id`);

--
-- Indexes for table `faculty_assigned`
--
ALTER TABLE `faculty_assigned`
  ADD PRIMARY KEY (`assign_id`),
  ADD KEY `faculty_id` (`faculty_id`),
  ADD KEY `course_code` (`course_code`),
  ADD KEY `program` (`program`),
  ADD KEY `year` (`year`),
  ADD KEY `block` (`block`);

--
-- Indexes for table `faculty_profileimg`
--
ALTER TABLE `faculty_profileimg`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `student_blocking`
--
ALTER TABLE `student_blocking`
  ADD PRIMARY KEY (`block_id`),
  ADD KEY `block_name` (`block_name`);

--
-- Indexes for table `student_grade`
--
ALTER TABLE `student_grade`
  ADD PRIMARY KEY (`grade_id`),
  ADD KEY `gradefaculty_key` (`grade_facultyid`),
  ADD KEY `gradestudent_key` (`grade_studentid`),
  ADD KEY `gradeprogram_key` (`grade_programid`),
  ADD KEY `gradeyear_key` (`grade_yearlevel`),
  ADD KEY `gradecourse_key` (`grade_courseid`),
  ADD KEY `sem_id` (`sem_id`);

--
-- Indexes for table `student_profileimg`
--
ALTER TABLE `student_profileimg`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_key` (`student_id`);

--
-- Indexes for table `student_yearlevel`
--
ALTER TABLE `student_yearlevel`
  ADD PRIMARY KEY (`year_id`),
  ADD KEY `year_level` (`year_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catsu_academicyr`
--
ALTER TABLE `catsu_academicyr`
  MODIFY `acad_yearid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `catsu_admin`
--
ALTER TABLE `catsu_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `catsu_courses`
--
ALTER TABLE `catsu_courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `faculty_assigned`
--
ALTER TABLE `faculty_assigned`
  MODIFY `assign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_yearlevel`
--
ALTER TABLE `student_yearlevel`
  MODIFY `year_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `faculty_assigned`
--
ALTER TABLE `faculty_assigned`
  ADD CONSTRAINT `faculty_assigned_ibfk_1` FOREIGN KEY (`block`) REFERENCES `student_blocking` (`block_name`),
  ADD CONSTRAINT `faculty_assigned_ibfk_2` FOREIGN KEY (`course_code`) REFERENCES `catsu_courses` (`course_code`),
  ADD CONSTRAINT `faculty_assigned_ibfk_3` FOREIGN KEY (`faculty_id`) REFERENCES `catsu_faculty` (`facultyID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
