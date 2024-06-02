-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2024 at 05:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `form_project`
--

CREATE TABLE `form_project` (
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `num_days` varchar(20) NOT NULL,
  `fromDate` date NOT NULL,
  `toDate` date NOT NULL,
  `becuse` varchar(255) NOT NULL,
  `status` enum('រង់ចាំការអនុញ្ញាត','អនុញ្ញាត','មិនអនុញ្ញាត','បោះបង់ការស្នើសុំ') NOT NULL,
  `status_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `department` varchar(100) NOT NULL,
  `id` int(11) NOT NULL,
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_project`
--

INSERT INTO `form_project` (`user_id`, `first_name`, `last_name`, `num_days`, `fromDate`, `toDate`, `becuse`, `status`, `status_date`, `department`, `id`, `comment`) VALUES
(63, 'MET2077', 'mohaheng', '13', '2024-03-01', '2024-03-13', 'go to home ', 'អនុញ្ញាត', '2024-03-13 10:54:26', 'វិទ្យាសាស្រ្តកុំព្យូទ័រ', 124, NULL),
(63, 'MET2077', 'mohaheng', '3', '2024-03-01', '2024-03-03', 'go to home ', 'មិនអនុញ្ញាត', '2024-03-13 10:54:27', 'វិទ្យាសាស្រ្តកុំព្យូទ័រ', 125, NULL),
(63, 'MET2077', 'mohaheng', '6', '2024-04-25', '2024-04-30', 'gowoowow', 'អនុញ្ញាត', '2024-03-13 10:54:28', 'វិទ្យាសាស្រ្តកុំព្យូទ័រ', 126, NULL),
(68, 'HOR', 'CHANTHA', '13', '2024-03-01', '2024-03-13', 'go to home ', 'មិនអនុញ្ញាត', '2024-03-13 10:54:29', 'វិទ្យាសាស្រ្តកុំព្យូទ័រ', 127, NULL),
(68, 'HOR', 'CHANTHA', '3', '2024-03-01', '2024-03-03', 'efsgdhfgn', 'អនុញ្ញាត', '2024-03-13 10:54:30', 'វិទ្យាសាស្រ្តកុំព្យូទ័រ', 128, NULL),
(68, 'HOR', 'CHANTHA', '27', '2024-04-25', '2024-03-30', 'dsfghjlk;\\\'', 'មិនអនុញ្ញាត', '2024-03-13 10:54:30', 'វិទ្យាសាស្រ្តកុំព្យូទ័រ', 129, NULL),
(68, 'HOR', 'CHANTHA', '2', '2024-03-13', '2024-03-14', 'go to home ', 'អនុញ្ញាត', '2024-03-18 14:31:02', 'វិទ្យាសាស្រ្តកុំព្យូទ័រ', 130, NULL),
(68, 'HOR', 'CHANTHA', '3', '2023-01-13', '2023-01-15', 'go home ', 'អនុញ្ញាត', '2024-03-18 14:31:02', 'វិទ្យាសាស្រ្តកុំព្យូទ័រ', 131, NULL),
(68, 'HOR', 'CHANTHA', '3', '2024-03-18', '2024-03-20', 'go to home ', 'អនុញ្ញាត', '2024-03-18 14:31:02', 'វិទ្យាសាស្រ្តកុំព្យូទ័រ', 132, NULL),
(68, 'HOR', 'CHANTHA', '6', '2024-03-17', '2024-03-22', 'asdfghjkl', 'អនុញ្ញាត', '2024-03-18 14:31:03', 'វិទ្យាសាស្រ្តកុំព្យូទ័រ', 133, NULL),
(68, 'HOR', 'CHANTHA', '16', '2024-03-09', '2024-03-24', 'rfd', 'អនុញ្ញាត', '2024-03-18 14:31:03', 'វិទ្យាសាស្រ្តកុំព្យូទ័រ', 134, NULL),
(68, 'HOR', 'CHANTHA', '16', '2024-03-09', '2024-03-24', 'rfd', 'អនុញ្ញាត', '2024-03-18 14:31:03', 'វិទ្យាសាស្រ្តកុំព្យូទ័រ', 135, NULL),
(68, 'HOR', 'CHANTHA', '16', '2024-03-09', '2024-03-24', 'rfd', 'អនុញ្ញាត', '2024-03-18 14:31:04', 'វិទ្យាសាស្រ្តកុំព្យូទ័រ', 136, NULL),
(68, 'HOR', 'CHANTHA', '16', '2024-03-09', '2024-03-24', 'rfd', 'អនុញ្ញាត', '2024-03-18 14:31:04', 'វិទ្យាសាស្រ្តកុំព្យូទ័រ', 137, NULL),
(68, 'HOR', 'CHANTHA', '16', '2024-03-09', '2024-03-24', 'rfd', 'អនុញ្ញាត', '2024-03-18 14:31:04', 'វិទ្យាសាស្រ្តកុំព្យូទ័រ', 138, NULL),
(68, 'HOR', 'CHANTHA', '16', '2024-03-09', '2024-03-24', 'rfd', 'អនុញ្ញាត', '2024-03-18 14:31:04', 'វិទ្យាសាស្រ្តកុំព្យូទ័រ', 139, NULL),
(68, 'HOR', 'CHANTHA', '16', '2024-03-09', '2024-03-24', 'rfd', 'អនុញ្ញាត', '2024-03-18 14:31:04', 'វិទ្យាសាស្រ្តកុំព្យូទ័រ', 140, NULL),
(68, 'HOR', 'CHANTHA', '16', '2024-03-09', '2024-03-24', 'rfd', 'អនុញ្ញាត', '2024-03-18 14:31:04', 'វិទ្យាសាស្រ្តកុំព្យូទ័រ', 141, NULL),
(68, 'HOR', 'CHANTHA', '16', '2024-03-09', '2024-03-24', 'rfd', 'អនុញ្ញាត', '2024-03-18 14:31:04', 'វិទ្យាសាស្រ្តកុំព្យូទ័រ', 142, NULL),
(68, 'HOR', 'CHANTHA', '16', '2024-03-09', '2024-03-24', 'rfd', 'អនុញ្ញាត', '2024-03-18 14:31:04', 'វិទ្យាសាស្រ្តកុំព្យូទ័រ', 143, NULL),
(68, 'HOR', 'CHANTHA', '16', '2024-03-09', '2024-03-24', 'rfd', 'អនុញ្ញាត', '2024-03-18 14:31:04', 'វិទ្យាសាស្រ្តកុំព្យូទ័រ', 144, NULL),
(68, 'HOR', 'CHANTHA', '16', '2024-03-09', '2024-03-24', 'rfd', 'អនុញ្ញាត', '2024-03-18 14:31:04', 'វិទ្យាសាស្រ្តកុំព្យូទ័រ', 145, NULL),
(68, 'HOR', 'CHANTHA', '16', '2024-03-09', '2024-03-24', 'rfd', 'អនុញ្ញាត', '2024-03-18 14:31:04', 'វិទ្យាសាស្រ្តកុំព្យូទ័រ', 146, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL CHECK (`role` in ('user','staff','admin')),
  `department` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `gmail` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `images` text DEFAULT NULL,
  `skills` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`first_name`, `last_name`, `role`, `department`, `username`, `password`, `gmail`, `phone_number`, `user_id`, `images`, `skills`) VALUES
('MET', 'TOLA', 'admin', 'computer', 'TOLA5', '$2y$10$GIe5rH2ge1l8B1Xf4LM7m.BPixFuH8iJaKBvyEvGliRsaQrgyqz4a', '123@fdasf', '1234', 5, 'profile_pictures/P1106418.JPG', 0),
('MET1234567890', 'TOLA1234567890-', 'user', 'computer', 'user2', '$2y$10$QLo2pP/pzRmaWEmEPF71dug97A2rPdhDdk4klyid5Z1O7C8IrngZe', '123@fdasf', '123', 58, 'uploads/1222232115c_HDR.jpg', 0),
('MET2077', 'mohaheng', 'user', 'វិទ្យាសាស្រ្តកុំព្យូទ័រ', 'user3', '$2y$10$tao5sV0bxOhvJuwIibn...Ro85g.XfpWNuht5c.uIl40qfHc17a0C', 'bongtola@gimal.com', '-098765432345678', 63, '../uploads/20231004_131008.jpg', 0),
('tola', 'staff', 'staff', 'computer', 'staff', '$2y$10$Fe/wBKKH8l7xksTj1F/A/unzvWjPx9iDYWfQ8yKoDnn7U2hpziSAe', 'bongtola@gimal.com', '09876543', 65, '', 0),
('HOR', 'CHANTHA', 'user', 'វិទ្យាសាស្រ្តកុំព្យូទ័រ', 'chantha', '$2y$10$4Trxd9RFkrYtxXq1CDMUh.1zsuq5WrPOi4vLncf1mlSeQzRx4674W', 'bongtola@gimal.com', '09876543', 68, '../uploads/WIN_20240312_12_34_47_Pro.jpg', 0),
('MET', 'TOLA', 'admin', 'computer', 'admin', '$2y$10$/0g9llYfXhhNmPXJ633vBu703TBrV2lPD1gc05cTAJrV7W8dPhfUC', 'admin123@gmail.com', '09876543', 74, '../uploads/P1106423.JPG', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form_project`
--
ALTER TABLE `form_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form_project`
--
ALTER TABLE `form_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
