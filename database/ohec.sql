-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2017 at 05:25 PM
-- Server version: 5.7.20
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ohec`
--

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `form_id` int(2) NOT NULL,
  `form_category` varchar(10) NOT NULL,
  `form_type` varchar(5) NOT NULL,
  `form_name` varchar(20) NOT NULL,
  `form_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`form_id`, `form_category`, `form_type`, `form_name`, `form_status`) VALUES
(1, 'fibre', 'am', 'fibre_am', 1),
(2, 'fibre', 'cm', 'fibre_cm', 1),
(3, 'fibre', 'pm', 'fibre_pm', 1),
(4, 'equip', 'am', 'equip_am', 1),
(5, 'equip', 'cm', 'equip_cm', 1),
(6, 'equip', 'pm', 'equip_pm', 1);

-- --------------------------------------------------------

--
-- Table structure for table `form_checklist`
--

CREATE TABLE `form_checklist` (
  `form_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `checklist_id` int(11) NOT NULL,
  `checklist_name` varchar(255) NOT NULL,
  `checklist_type` varchar(50) NOT NULL,
  `checklist_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `form_checklist`
--

INSERT INTO `form_checklist` (`form_id`, `section_id`, `checklist_id`, `checklist_name`, `checklist_type`, `checklist_status`) VALUES
(2, 1, 1, 'ความเรียบร้อยในการซ่อมแซมหน้างาน', 'radio', 1),
(2, 1, 2, 'วัสดุที่ใช้ในการซ่อมแซมเป็นไปตามข้อกำหนด', 'radio', 1),
(2, 1, 3, 'การซ่อมแซมเป็นไปตามความเหมาะสม', 'radio', 1),
(2, 1, 4, 'การเก็บวัสดุหลังดำเนินการซ่อมแซม', 'radio', 1),
(2, 2, 1, 'ภาพถ่ายหลังดำเนินการ พร้อมพิกัด', 'radio', 1),
(2, 3, 1, 'สาเกตุที่ขอพักดำเนินการ พร้อมเอกสารประกอบการหยุดเวลา', 'radio', 1),
(2, 3, 2, 'พื้นที่เสี่ยงภัยที่ได้รับการยกเว้นตามสัญญา', 'radio', 1),
(2, 3, 3, 'ภัยธรรมชาติ', 'radio', 1),
(2, 3, 4, 'บุคคลที่ 3', 'radio', 1),
(2, 4, 1, 'เจ้าหน้าที่เข้าใจถึงขั้นตอนการทำงานและคุณภาพของการให้บริการ', 'radio', 1),
(2, 4, 2, 'เจ้าหน้าที่แต่งกายเรียบร้อย (บัตรประจำตัว/ชุดยูนิฟอร์ม)', 'radio', 1),
(2, 5, 1, 'ข้อเสนอแนะอื่น ๆ', 'textarea', 1);

-- --------------------------------------------------------

--
-- Table structure for table `form_section`
--

CREATE TABLE `form_section` (
  `form_id` int(2) NOT NULL,
  `section_id` int(2) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `section_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `form_section`
--

INSERT INTO `form_section` (`form_id`, `section_id`, `section_name`, `section_status`) VALUES
(2, 1, 'การตรวจสถานที่เกิดเหตุ', 1),
(2, 2, 'เอกสารรายงานซ่อมแซม (Corrective Maintenance)', 1),
(2, 3, 'การขอหยุดเวลา', 1),
(2, 4, 'การตรวจเจ้าหน้าที่และบุคคลากร', 1),
(2, 5, 'ข้อเสนอแนะ', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD UNIQUE KEY `form_id` (`form_id`);

--
-- Indexes for table `form_section`
--
ALTER TABLE `form_section`
  ADD PRIMARY KEY (`form_id`,`section_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `form_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `form_section`
--
ALTER TABLE `form_section`
  MODIFY `form_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
