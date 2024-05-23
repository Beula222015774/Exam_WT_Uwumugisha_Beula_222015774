-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 11:16 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wedding_planning`
--

-- --------------------------------------------------------

--
-- Table structure for table `budgets`
--

CREATE TABLE `budgets` (
  `budget_id` int(11) NOT NULL,
  `couple_id` int(11) DEFAULT NULL,
  `total_budget` decimal(10,2) NOT NULL,
  `spent_budget` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `budgets`
--

INSERT INTO `budgets` (`budget_id`, `couple_id`, `total_budget`, `spent_budget`) VALUES
(1, 2, 99999999.99, 1289000.00),
(8, 1, 4560000.00, 300000.00);

-- --------------------------------------------------------

--
-- Table structure for table `checklist`
--

CREATE TABLE `checklist` (
  `checklist_id` int(11) NOT NULL,
  `couple_id` int(11) DEFAULT NULL,
  `checklist_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checklist`
--

INSERT INTO `checklist` (`checklist_id`, `couple_id`, `checklist_name`) VALUES
(1, 1, 'forge'),
(2, 2, 'goth'),
(3, 4, 'hag'),
(4, 4, 'hag'),
(5, 4, 'hag');

-- --------------------------------------------------------

--
-- Table structure for table `couples`
--

CREATE TABLE `couples` (
  `couple_id` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `wedding_date` date DEFAULT NULL,
  `wedding_location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `couples`
--

INSERT INTO `couples` (`couple_id`, `id`, `wedding_date`, `wedding_location`) VALUES
(2, 2, '2024-06-08', 'Kicukiro'),
(3, 3, '2024-06-30', 'Gasabo');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `couple_id` int(11) DEFAULT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `couple_id`, `event_name`, `event_date`) VALUES
(1, 2, 'dowry', '2024-06-08'),
(2, 1, 'reception', '2024-05-30'),
(4, 3, 'dowry', '2024-07-03'),
(5, 3, 'civil', '2024-06-30'),
(6, 1, 'reception', '2024-06-10'),
(7, 2, 'dowry', '2024-06-23');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `guest_id` int(11) NOT NULL,
  `couple_id` int(11) DEFAULT NULL,
  `guest_name` varchar(100) NOT NULL,
  `guest_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`guest_id`, `couple_id`, `guest_name`, `guest_email`) VALUES
(1, 2, 'eillish', 'eish01@gmail.com'),
(2, 1, 'drake', 'dra342@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE `invitations` (
  `invitation_id` int(11) NOT NULL,
  `guest_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invitations`
--

INSERT INTO `invitations` (`invitation_id`, `guest_id`, `event_id`) VALUES
(1, 3, 2),
(3, 4, 7);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `couple_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `vendor_id`, `couple_id`, `amount`) VALUES
(1, 2, 2, 5000000.00),
(2, 1, 3, 670000.00),
(3, NULL, NULL, 0.00),
(4, 1, 3, 670000.00),
(5, 2, 1, 1340000.00);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `checklist_id` int(11) DEFAULT NULL,
  `task_name` varchar(100) NOT NULL,
  `due_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `checklist_id`, `task_name`, `due_date`) VALUES
(1, 2, 'fghgf', '2024-05-16'),
(2, 3, 'nbvcv', '2024-05-19'),
(3, 1, 'cfghg', '2024-05-06'),
(4, 1, 'cfghg', '2024-05-06'),
(5, 1, 'cfghg', '2024-05-06');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'David', 'Mugisha', 'david12', 'davidmugisha@gmail.com', '0787500702', '$2y$10$KHeIfSdBI9p/pvyrFNG10OmGrQUlFl0xChbt312WLHebkKWo91vD.', '2024-05-21 17:43:24', '234', 0),
(2, 'Uwumugisha', 'Beula', 'beula123', 'uwumugishabeula@gmail.com', '0787500702', '$2y$10$vLRHb2mqYC08UnuMsf5x2uryGPtvcOZbxkT/VqydNDyaxNDeTpsj.', '2024-05-21 17:48:10', '456', 0),
(3, 'Uwase', 'Aliane', 'aliane', 'uwasealiane@gmail.com', '0787100392', '$2y$10$.CCARHRsKS0WjBDaKrmYHepjrWIZSgfogZETVtrT/Pt.5t1wIUefy', '2024-05-21 17:49:45', '876', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendor_id` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `vendor_name` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `id`, `vendor_name`, `address`) VALUES
(1, 2, 'retw', 'huye'),
(2, 3, 'gogh', 'buh'),
(3, 3, 'gogh', 'buh'),
(4, 5, 'josh', 'kgl'),
(5, 5, 'josh', 'kgl');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budgets`
--
ALTER TABLE `budgets`
  ADD PRIMARY KEY (`budget_id`);

--
-- Indexes for table `checklist`
--
ALTER TABLE `checklist`
  ADD PRIMARY KEY (`checklist_id`);

--
-- Indexes for table `couples`
--
ALTER TABLE `couples`
  ADD PRIMARY KEY (`couple_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`guest_id`);

--
-- Indexes for table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`invitation_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `budgets`
--
ALTER TABLE `budgets`
  MODIFY `budget_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `checklist`
--
ALTER TABLE `checklist`
  MODIFY `checklist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `couples`
--
ALTER TABLE `couples`
  MODIFY `couple_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `guest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invitations`
--
ALTER TABLE `invitations`
  MODIFY `invitation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
