-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 18, 2022 at 05:17 PM
-- Server version: 10.3.20-MariaDB-log
-- PHP Version: 8.0.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sql_wangmai_eng_`
--

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `equipment_id` int(11) NOT NULL,
  `room_id` int(4) NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reserve_id` varchar(15) NOT NULL,
  `cmuitaccount_name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `cmuitaccount_name2` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `cmuitaccount_name3` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `cmuitaccount_name4` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `room_id` int(4) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `reservation_time` datetime NOT NULL,
  `notification_check` int(2) NOT NULL,
  `approvenoti_check` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(4) NOT NULL,
  `name_EN` varchar(255) DEFAULT NULL,
  `name_TH` varchar(255) DEFAULT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `name_EN`, `name_TH`, `status`) VALUES
(401, 'Lecture room', 'ห้องบรรยายใหญ่', 2),
(402, 'Conference room', 'ห้องประชุมใหญ่', 2),
(411, 'Computer Simulation and Computation Laboratory room', 'ห้องวิจัยการจำลองทางคอมพิวเตอร์และการคำนวน', 2),
(412, 'Laboratory room', 'ห้องปฏิบัติการ', 2),
(413, 'Computational Intelligence Laboratory room', 'ห้องวิจัยความฉลาดทางการคำนวน', 2),
(422, 'Master students room', 'ห้องนักศึกษาปริญญาโท', 2),
(501, 'Lecture room', 'ห้องบรรยาย', 2),
(508, 'Teacher\'s room', 'ห้องพักอาจารย์', 2),
(509, 'Teacher\'s room', 'ห้องพักอาจารย์', 2),
(516, 'Computer Laboratory room', 'ห้องปฏิบัติการคอมพิวเตอร์', 0),
(517, 'Optimization theory and Applications for *-SYStems (OASYSLab)', 'ห้องปฏิบัติการคอมพิวเตอร์', 0),
(518, 'Computer Laboratory room', 'ห้องปฏิบัติการคอมพิวเตอร์', 2),
(521, 'Computer Laboratory room', 'ห้องปฏิบัติการคอมพิวเตอร์', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sensors`
--

CREATE TABLE `sensors` (
  `data_id` int(15) NOT NULL,
  `room_id` int(4) NOT NULL,
  `board_id` varchar(5) NOT NULL,
  `light` int(4) NOT NULL,
  `temp` float NOT NULL,
  `sound` int(4) NOT NULL,
  `uploadtime` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `timetable_id` int(3) NOT NULL,
  `room_id` int(4) NOT NULL,
  `course_code` int(6) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `lecturer_name` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `cmuitaccount_name` varchar(255) NOT NULL,
  `cmuitaccount` varchar(255) NOT NULL,
  `prename_id` varchar(100) NOT NULL,
  `firstname_EN` varchar(255) NOT NULL,
  `lastname_EN` varchar(255) NOT NULL,
  `organization_code` varchar(3) NOT NULL,
  `organization_name_EN` varchar(255) NOT NULL,
  `itaccounttype_EN` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `imageprofile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`equipment_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reserve_id`),
  ADD KEY `cmuitaccount_name` (`cmuitaccount_name`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `cmuitaccount_name2` (`cmuitaccount_name2`),
  ADD KEY `cmuitaccount_name3` (`cmuitaccount_name3`),
  ADD KEY `cmuitaccount_name4` (`cmuitaccount_name4`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `sensors`
--
ALTER TABLE `sensors`
  ADD PRIMARY KEY (`data_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`timetable_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`cmuitaccount_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `equipment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sensors`
--
ALTER TABLE `sensors`
  MODIFY `data_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `timetable_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `equipment_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`cmuitaccount_name`) REFERENCES `users` (`cmuitaccount_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`cmuitaccount_name2`) REFERENCES `users` (`cmuitaccount_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_4` FOREIGN KEY (`cmuitaccount_name3`) REFERENCES `users` (`cmuitaccount_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_5` FOREIGN KEY (`cmuitaccount_name4`) REFERENCES `users` (`cmuitaccount_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sensors`
--
ALTER TABLE `sensors`
  ADD CONSTRAINT `sensors_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE;

--
-- Constraints for table `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `timetable_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
