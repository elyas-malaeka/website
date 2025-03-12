-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2025 at 10:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_registration_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_grades`
--

CREATE TABLE `academic_grades` (
  `grade_id` int(11) NOT NULL,
  `grade_name` varchar(50) NOT NULL,
  `grade_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academic_grades`
--

INSERT INTO `academic_grades` (`grade_id`, `grade_name`, `grade_number`) VALUES
(1, 'Grade 1', 1),
(2, 'Grade 2', 2),
(3, 'Grade 3', 3),
(4, 'Grade 4', 4),
(5, 'Grade 5', 5),
(6, 'Grade 6', 6),
(7, 'Grade 7', 7),
(8, 'Grade 8', 8),
(9, 'Grade 9', 9),
(10, 'Grade 10', 10),
(11, 'Grade 11', 11),
(12, 'Grade 12', 12);

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`log_id`, `user_id`, `action`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES
(1, 1, 'student_registration', 'Student registration completed: Teagan Daugherty', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', '2025-03-12 21:02:34'),
(2, 2, 'student_registration', 'Student registration completed: Wylie Hays', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', '2025-03-12 21:07:52'),
(3, 3, 'student_registration', 'Student registration completed: Caesar Eaton', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', '2025-03-12 21:25:49');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `priority` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country_name`, `priority`) VALUES
(1, 'Iran', 10),
(2, 'Afghanistan', 9),
(3, 'Tajikistan', 8),
(4, 'UAE', 7),
(5, 'Turkey', 6),
(6, 'Pakistan', 5),
(7, 'Iraq', 4);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `document_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `document_type` enum('emirates_id','passport','national_id','birth_certificate','academic_certificate') NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`document_id`, `student_id`, `document_type`, `file_path`, `upload_date`) VALUES
(1, 1, 'emirates_id', 'uploads/documents/67d1f66a67fe6_1741813354.png', '2025-03-12 21:02:34'),
(2, 1, 'passport', 'uploads/documents/67d1f66a68cab_1741813354.png', '2025-03-12 21:02:34'),
(3, 1, 'academic_certificate', 'uploads/documents/67d1f66a692b5_1741813354.png', '2025-03-12 21:02:34'),
(4, 2, 'passport', 'uploads/documents/67d1f7a8c1af4_1741813672.png', '2025-03-12 21:07:52'),
(5, 2, 'academic_certificate', 'uploads/documents/67d1f7a8c2202_1741813672.png', '2025-03-12 21:07:52'),
(6, 3, 'emirates_id', 'uploads/documents/67d1fbdd53ca8_1741814749.png', '2025-03-12 21:25:49'),
(7, 3, 'passport', 'uploads/documents/67d1fbdd54284_1741814749.jpg', '2025-03-12 21:25:49'),
(8, 3, 'national_id', 'uploads/documents/67d1fbdd5467f_1741814749.jpg', '2025-03-12 21:25:49'),
(9, 3, 'birth_certificate', 'uploads/documents/67d1fbdd550f9_1741814749.jpg', '2025-03-12 21:25:49');

-- --------------------------------------------------------

--
-- Table structure for table `fathers`
--

CREATE TABLE `fathers` (
  `father_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `national_id` varchar(20) DEFAULT NULL,
  `passport_number` varchar(20) DEFAULT NULL,
  `education` varchar(50) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `landline` varchar(20) DEFAULT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `whatsapp_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `work_address` text DEFAULT NULL,
  `employee_code` varchar(50) DEFAULT NULL,
  `has_medical_condition` tinyint(1) DEFAULT 0,
  `medical_condition_details` text DEFAULT NULL
) ;

--
-- Dumping data for table `fathers`
--

INSERT INTO `fathers` (`father_id`, `student_id`, `full_name`, `nationality`, `birthdate`, `national_id`, `passport_number`, `education`, `occupation`, `landline`, `mobile_number`, `whatsapp_number`, `email`, `work_address`, `employee_code`, `has_medical_condition`, `medical_condition_details`) VALUES
(1, 1, 'Sybill Gardner', 'Ethiopia', '2004-07-20', '1478523690', '', 'Master&#39;s', 'Fuga Enim occaecat ', '+1 (383) 974-8884', '+1 (398) 498-7744', '+1 (419) 148-7313', 'molop@mailinator.com', 'Necessitatibus sapie', 'Id qui dolores persp', 0, NULL),
(2, 2, 'Xaviera Pratt', 'Bahrain', '1987-10-15', 'شناسه امارات', '', 'High School', 'Nihil labore autem a', '+1 (831) 437-1787', '+1 (199) 187-8696', '+1 (707) 146-7605', 'moguqep@mailinator.com', 'Sed harum deserunt s', 'Tempore natus eu fu', 0, NULL),
(3, 3, 'Liberty Sampson', 'Luxembourg', '1995-10-06', '', '928', 'Master&#39;s', 'Excepteur quae neque', '+1 (326) 996-3437', '+1 (169) 414-7199', '+1 (247) 851-7473', 'pyxe@mailinator.com', 'Nobis occaecat ea ra', 'Cumque excepturi rer', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `major_id` int(11) NOT NULL,
  `major_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`major_id`, `major_name`) VALUES
(1, 'Technical & Vocational'),
(2, 'Mathematics & Physics'),
(3, 'Experimental Sciences'),
(4, 'Humanities');

-- --------------------------------------------------------

--
-- Table structure for table `mothers`
--

CREATE TABLE `mothers` (
  `mother_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `national_id` varchar(20) DEFAULT NULL,
  `passport_number` varchar(20) DEFAULT NULL,
  `education` varchar(50) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `landline` varchar(20) DEFAULT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `whatsapp_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `work_address` text DEFAULT NULL,
  `employee_code` varchar(50) DEFAULT NULL,
  `has_medical_condition` tinyint(1) DEFAULT 0,
  `medical_condition_details` text DEFAULT NULL
) ;

--
-- Dumping data for table `mothers`
--

INSERT INTO `mothers` (`mother_id`, `student_id`, `full_name`, `nationality`, `birthdate`, `national_id`, `passport_number`, `education`, `occupation`, `landline`, `mobile_number`, `whatsapp_number`, `email`, `work_address`, `employee_code`, `has_medical_condition`, `medical_condition_details`) VALUES
(1, 1, 'Clarke Andrews', 'Slovenia', '2012-03-10', '1478523690', '', 'Master&#39;s', 'Saepe rerum iure vel', '+1 (422) 566-5341', '+1 (816) 169-5223', '+1 (544) 703-4637', 'rinyto@mailinator.com', 'Ipsa sint omnis mol', 'Velit placeat in ex', 0, NULL),
(2, 2, 'Ray Murray', 'Bosnia', '1982-03-28', '1478523690', '', 'Other', 'Aliquid ea quia non ', '+1 (745) 466-2201', '+1 (344) 302-1965', '+1 (744) 496-4559', 'pekoneb@mailinator.com', 'Et quia deleniti ani', 'Nihil molestias veni', 0, NULL),
(3, 3, 'Amity West', 'Libya', '2017-12-22', '', '471', 'Master&#39;s', 'Dolorum et id recus', '+1 (518) 494-6387', '+1 (149) 221-6148', '+1 (901) 447-1756', 'keqe@mailinator.com', 'Quia earum et in sed', 'Laboriosam tempor d', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `registration_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `special_notes` text DEFAULT NULL,
  `disciplinary_rules_agreement` tinyint(1) DEFAULT 0,
  `terms_conditions_agreement` tinyint(1) DEFAULT 0,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `registration_status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`registration_id`, `student_id`, `special_notes`, `disciplinary_rules_agreement`, `terms_conditions_agreement`, `registration_date`, `registration_status`) VALUES
(1, 1, '', 1, 1, '2025-03-12 21:02:34', 'pending'),
(2, 2, '', 1, 1, '2025-03-12 21:07:52', 'pending'),
(3, 3, '', 1, 1, '2025-03-12 21:25:49', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `religions`
--

CREATE TABLE `religions` (
  `religion_id` int(11) NOT NULL,
  `religion_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `religions`
--

INSERT INTO `religions` (`religion_id`, `religion_name`) VALUES
(1, 'Shia Islam'),
(2, 'Sunni Islam'),
(3, 'Christianity'),
(4, 'Judaism'),
(5, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `route_id` int(11) NOT NULL,
  `route_name` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `route_name`, `city`, `description`) VALUES
(6, 'Route 1', 'Sharjah', 'Qafiya - Sharjah School - First Al Taawun Roundabout'),
(7, 'Route 2', 'Sharjah', 'Al Muteena - Old Market - Iranian Bazaar - King Faisal Road'),
(8, 'Route 3', 'Sharjah', 'Al Majaz - Al Qasba - Al Rolla - Umm Khanour - Al Majaz 1 & 2'),
(9, 'Route 4', 'Sharjah', 'Al Nahda Park - Main Street Al Taawun - Ansar Mall'),
(10, 'Route 5', 'Sharjah', 'Al Nahda Sharjah 2 - Sahara Centre - Behind Etisalat Al Nahda'),
(11, 'Route 6', 'Dubai', 'Al Safa - Bur Dubai - Al Mankhool - Meena Bazaar'),
(12, 'Route 7', 'Dubai', 'Port Rashid - Jafliya Junction - Satwa Road - Al Wasl Junction'),
(13, 'Route 8', 'Dubai', 'Al Quoz 2 & 4 - Behind Spinneys, Jumeirah'),
(14, 'Route 9', 'Dubai', 'Abu Hail - Hor Al Anz - Al Muteena - Fish Roundabout'),
(15, 'Route 10', 'Dubai', 'Naif - Al Karama - Al Hamriya - Al Ras - Al Nahda 2'),
(16, 'Route 11', 'Dubai', 'Al Rashidiya - Mirdif - Al Warqa - Al Qusais - Mirdif City'),
(17, 'Route 12', 'Ajman', 'GMC Hospital - Kuwait Junction - Al Nuaimiya 2 & 3'),
(18, 'Route 13', 'Ajman', 'Al Ain Markets - Al Corniche - Al Rashidiya - Fish Market'),
(19, 'Route 14', 'Ajman', 'Al Khor Towers - Al Karama Area - Mushairif Park'),
(20, 'Route 15', 'Ajman', 'Industrial Area - Al Rawda 1 & 2 - Al Hamidiya'),
(21, 'Route 16', 'Ajman', 'Al Mowaihat - Al Jurf - Sheikh Bin Zayed Road - Al Yasmeen');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `father_name` varchar(50) NOT NULL,
  `national_id` varchar(20) DEFAULT NULL,
  `passport_number` varchar(20) DEFAULT NULL,
  `birthplace` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `religion` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `academic_grade` int(11) NOT NULL,
  `major` varchar(50) DEFAULT NULL,
  `residential_address` text NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `emergency_contact_name` varchar(100) NOT NULL,
  `emergency_contact_number` varchar(20) NOT NULL,
  `profile_photo_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `last_name`, `father_name`, `national_id`, `passport_number`, `birthplace`, `birthdate`, `religion`, `nationality`, `academic_grade`, `major`, `residential_address`, `contact_number`, `emergency_contact_name`, `emergency_contact_number`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Teagan', 'Daugherty', 'Graiden Herring', '1478523690', '', 'Expedita et autem co', '1979-02-16', 'Shia Islam', 'Uruguay', 10, 'Technical & Vocational', 'A iste numquam fugia', '+1 (723) 876-8981', 'Alexandra Harper', '+1 (288) 981-7083', 'uploads/profile_photos/67d1f66a66e42_1741813354.jpg', '2025-03-12 21:02:34', '2025-03-12 21:02:34'),
(2, 'Wylie', 'Hays', 'Madonna Huffman', '1478523690', '', 'Et quia voluptate qu', '1995-10-10', 'Judaism', 'Kenya', 2, '', 'Nihil autem sint at ', '+1 (235) 758-9493', 'Illana Buck', '+1 (113) 334-1856', NULL, '2025-03-12 21:07:52', '2025-03-12 21:07:52'),
(3, 'Caesar', 'Eaton', 'Theodore Riddle', '', 'P05630139', 'Dolorum dolor harum ', '1992-08-19', 'Christianity', 'Iran', 11, 'Humanities', 'Et incididunt et mol', '+1 (725) 176-6436', 'Minerva Collier', '+1 (672) 969-6395', 'uploads/profile_photos/67d1fbdd52ed5_1741814749.png', '2025-03-12 21:25:49', '2025-03-12 21:25:49');

-- --------------------------------------------------------

--
-- Stand-in structure for view `student_complete_info`
-- (See below for the actual view)
--
CREATE TABLE `student_complete_info` (
`student_id` int(11)
,`first_name` varchar(50)
,`last_name` varchar(50)
,`student_father_name` varchar(50)
,`student_national_id` varchar(20)
,`student_passport_number` varchar(20)
,`birthplace` varchar(100)
,`birthdate` date
,`religion` varchar(50)
,`nationality` varchar(50)
,`academic_grade` int(11)
,`major` varchar(50)
,`residential_address` text
,`contact_number` varchar(20)
,`emergency_contact_name` varchar(100)
,`emergency_contact_number` varchar(20)
,`father_full_name` varchar(100)
,`father_nationality` varchar(50)
,`father_mobile` varchar(20)
,`father_email` varchar(100)
,`mother_full_name` varchar(100)
,`mother_nationality` varchar(50)
,`mother_mobile` varchar(20)
,`mother_email` varchar(100)
,`registration_status` enum('pending','approved','rejected')
,`registration_date` timestamp
,`route_id` int(11)
,`transportation_location` varchar(100)
,`route_name` varchar(100)
,`city` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `setting_id` int(11) NOT NULL,
  `setting_name` varchar(100) NOT NULL,
  `setting_value` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`setting_id`, `setting_name`, `setting_value`, `created_at`, `updated_at`) VALUES
(1, 'max_file_size', '5', '2025-03-12 21:00:04', '2025-03-12 21:00:04'),
(2, 'allowed_file_types', 'jpeg,jpg,png,pdf', '2025-03-12 21:00:04', '2025-03-12 21:00:04'),
(3, 'default_language', 'en', '2025-03-12 21:00:04', '2025-03-12 21:00:04'),
(4, 'registration_open', 'true', '2025-03-12 21:00:04', '2025-03-12 21:00:04');

-- --------------------------------------------------------

--
-- Table structure for table `transportation`
--

CREATE TABLE `transportation` (
  `transportation_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transportation`
--

INSERT INTO `transportation` (`transportation_id`, `student_id`, `route_id`, `location`) VALUES
(1, 1, 4, ''),
(2, 3, 4, '');

-- --------------------------------------------------------

--
-- Structure for view `student_complete_info`
--
DROP TABLE IF EXISTS `student_complete_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_complete_info`  AS SELECT `s`.`student_id` AS `student_id`, `s`.`first_name` AS `first_name`, `s`.`last_name` AS `last_name`, `s`.`father_name` AS `student_father_name`, `s`.`national_id` AS `student_national_id`, `s`.`passport_number` AS `student_passport_number`, `s`.`birthplace` AS `birthplace`, `s`.`birthdate` AS `birthdate`, `s`.`religion` AS `religion`, `s`.`nationality` AS `nationality`, `s`.`academic_grade` AS `academic_grade`, `s`.`major` AS `major`, `s`.`residential_address` AS `residential_address`, `s`.`contact_number` AS `contact_number`, `s`.`emergency_contact_name` AS `emergency_contact_name`, `s`.`emergency_contact_number` AS `emergency_contact_number`, `f`.`full_name` AS `father_full_name`, `f`.`nationality` AS `father_nationality`, `f`.`mobile_number` AS `father_mobile`, `f`.`email` AS `father_email`, `m`.`full_name` AS `mother_full_name`, `m`.`nationality` AS `mother_nationality`, `m`.`mobile_number` AS `mother_mobile`, `m`.`email` AS `mother_email`, `r`.`registration_status` AS `registration_status`, `r`.`registration_date` AS `registration_date`, `t`.`route_id` AS `route_id`, `t`.`location` AS `transportation_location`, `rt`.`route_name` AS `route_name`, `rt`.`city` AS `city` FROM (((((`students` `s` left join `fathers` `f` on(`s`.`student_id` = `f`.`student_id`)) left join `mothers` `m` on(`s`.`student_id` = `m`.`student_id`)) left join `registrations` `r` on(`s`.`student_id` = `r`.`student_id`)) left join `transportation` `t` on(`s`.`student_id` = `t`.`student_id`)) left join `routes` `rt` on(`t`.`route_id` = `rt`.`route_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_grades`
--
ALTER TABLE `academic_grades`
  ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `fathers`
--
ALTER TABLE `fathers`
  ADD PRIMARY KEY (`father_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `idx_fathers_email` (`email`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`major_id`);

--
-- Indexes for table `mothers`
--
ALTER TABLE `mothers`
  ADD PRIMARY KEY (`mother_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `idx_mothers_email` (`email`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`registration_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `idx_registrations_status` (`registration_status`);

--
-- Indexes for table `religions`
--
ALTER TABLE `religions`
  ADD PRIMARY KEY (`religion_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `idx_students_national_id` (`national_id`),
  ADD KEY `idx_students_passport_number` (`passport_number`),
  ADD KEY `idx_students_academic_grade` (`academic_grade`),
  ADD KEY `idx_students_nationality` (`nationality`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `transportation`
--
ALTER TABLE `transportation`
  ADD PRIMARY KEY (`transportation_id`),
  ADD KEY `student_id` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_grades`
--
ALTER TABLE `academic_grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `fathers`
--
ALTER TABLE `fathers`
  MODIFY `father_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `major_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mothers`
--
ALTER TABLE `mothers`
  MODIFY `mother_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `registration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `religions`
--
ALTER TABLE `religions`
  MODIFY `religion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transportation`
--
ALTER TABLE `transportation`
  MODIFY `transportation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `fathers`
--
ALTER TABLE `fathers`
  ADD CONSTRAINT `fathers_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `mothers`
--
ALTER TABLE `mothers`
  ADD CONSTRAINT `mothers_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `transportation`
--
ALTER TABLE `transportation`
  ADD CONSTRAINT `transportation_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
