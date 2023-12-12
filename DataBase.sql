-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.28-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for computer_instruction
CREATE DATABASE IF NOT EXISTS `computer_instruction` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `computer_instruction`;

-- Dumping structure for table computer_instruction.course
CREATE TABLE IF NOT EXISTS `course` (
  `cou_id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(20) DEFAULT NULL,
  `cou_name` varchar(250) NOT NULL,
  `cou_class` int(2) NOT NULL DEFAULT 1,
  `cou_path` varchar(250) NOT NULL,
  PRIMARY KEY (`cou_id`),
  UNIQUE KEY `cou_name` (`cou_name`),
  KEY `FK_cou_identifier` (`identifier`),
  CONSTRAINT `FK_cou_identifier` FOREIGN KEY (`identifier`) REFERENCES `users` (`identifier`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table computer_instruction.quizs
CREATE TABLE IF NOT EXISTS `quizs` (
  `qu_id` int(11) NOT NULL AUTO_INCREMENT,
  `qu_name` varchar(250) NOT NULL,
  `cou_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `question` varchar(250) NOT NULL,
  `choice1` varchar(250) NOT NULL,
  `choice2` varchar(250) NOT NULL,
  `choice3` varchar(250) NOT NULL,
  `choice4` varchar(250) NOT NULL,
  `answer` varchar(250) NOT NULL,
  PRIMARY KEY (`qu_id`),
  KEY `FK_Type` (`type_id`),
  KEY `FK_Course` (`cou_id`),
  CONSTRAINT `FK_Course` FOREIGN KEY (`cou_id`) REFERENCES `course` (`cou_id`),
  CONSTRAINT `FK_Type` FOREIGN KEY (`type_id`) REFERENCES `types` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table computer_instruction.register_course
CREATE TABLE IF NOT EXISTS `register_course` (
  `reg_id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(20) DEFAULT NULL,
  `cou_id` int(11) DEFAULT NULL,
  `pretest` varchar(50) DEFAULT 'NaN',
  `test_during` varchar(50) DEFAULT 'NaN',
  `posttest` varchar(50) DEFAULT 'NaN',
  PRIMARY KEY (`reg_id`),
  KEY `FK_cou_id` (`cou_id`) USING BTREE,
  KEY `FK_identifier` (`identifier`) USING BTREE,
  CONSTRAINT `FK_cou_id` FOREIGN KEY (`cou_id`) REFERENCES `course` (`cou_id`),
  CONSTRAINT `FK_identifier` FOREIGN KEY (`identifier`) REFERENCES `users` (`identifier`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table computer_instruction.types
CREATE TABLE IF NOT EXISTS `types` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(100) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table computer_instruction.users
CREATE TABLE IF NOT EXISTS `users` (
  `identifier` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `profile` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `prefix` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT 'นาย',
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `group` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT 'student',
  `sex` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT 'ชาย',
  `old` int(2) DEFAULT NULL,
  `phone_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `class` int(1) DEFAULT 1,
  `room` int(2) DEFAULT 1,
  `number` int(5) DEFAULT 1,
  PRIMARY KEY (`identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
