-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 24, 2021 at 06:43 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Project`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `thread_id` int(15) NOT NULL,
  `comment_id` int(15) NOT NULL,
  `comment` text NOT NULL,
  `user_id` int(15) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`thread_id`, `comment_id`, `comment`, `user_id`, `timestamp`) VALUES
(1, 1, 'i think you should concentrate on classes from now', 10906, '2021-07-17 17:34:19'),
(1, 2, 'good said @shubham 😂', 10914, '2021-07-17 18:32:52'),
(5, 8, 'ask pankaj sir', 10909, '2021-07-17 19:29:46'),
(21, 9, 'type the question completely', 10909, '2021-07-17 19:33:12'),
(7, 10, 'hello everyone', 10909, '2021-07-17 22:48:18'),
(22, 19, 'hello everyone', 10909, '2021-07-17 23:29:54'),
(17, 22, 'even i have problem in graphics', 10909, '2021-07-18 14:25:29'),
(22, 23, 'same doubt anyone pls help', 10909, '2021-07-19 11:48:52'),
(56, 24, 'we can ', 10913, '2021-07-20 16:36:01');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `feedback_id` int(10) NOT NULL,
  `rating` varchar(10) NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`feedback_id`, `rating`, `feedback`) VALUES
(1, 'excellent', 'Loved this work'),
(2, 'very good', 'nice work '),
(3, 'good', 'improve to it to better level'),
(4, 'Bad', 'you need to improve it much');

-- --------------------------------------------------------

--
-- Table structure for table `subforum`
--

CREATE TABLE `subforum` (
  `yr` varchar(3) NOT NULL,
  `sub_id` varchar(3) NOT NULL,
  `sub_name` text NOT NULL,
  `sub_descp` text NOT NULL,
  `sub_color` varchar(15) NOT NULL,
  `sub_icon` varchar(20) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subforum`
--

INSERT INTO `subforum` (`yr`, `sub_id`, `sub_name`, `sub_descp`, `sub_color`, `sub_icon`, `timestamp`) VALUES
('1', '01', 'Engineering Mathematics-I', 'To make the students familiarize with concepts and techniques in Calculus, Fourier series and Matrices.', 'blue', 'fa-square-root-alt', '2021-07-15 21:23:37'),
('1', '02', 'Engineering Chemistry', 'Course objectives are to understand technology involved in analysis and improving quality of water as commodity and much more.', 'orange', 'fa-atom', '2021-07-15 21:26:53'),
('1', '03', 'Systems in Mechanical Engineering', 'On completion of the course, learner will be able to describe and compare the conversion of energy, explain basic laws of thermodynamics and much more.', 'green', 'fa-car', '2021-07-15 21:30:01'),
('1', '04', 'Basic Electronics Engineering', 'Course objectives are to explain the principle of electronics and working principle of PN junction diode and special purpose diodes.', 'yellow', 'fa-plug', '2021-07-15 21:35:18'),
('1', '05', 'Programming and Problem Solving', 'Prime objective is to give students a basic introduction to programming and problem solving with computer language Python.', 'purple', 'fa-code', '2021-07-15 21:39:07'),
('1', '06', 'Engineering Mathematics-II', 'The aim is to equip them with the techniques to understand advanced level mathematics and its applications that would enhance thinking power, useful in their disciplines.', 'blue', 'fa-square-root-alt', '2021-07-15 21:40:56'),
('1', '07', 'Engineering Physics', 'To teach students basic concepts and principles of physics, relate them to laboratory experiments and their applications', 'orange', 'fa-atom', '2021-07-15 21:42:42'),
('1', '08', 'Basic Electrical Engineering', 'This course aims at enabling students of all Engineering Branches to understand the basic concepts of electrical engineering.', 'yellow', 'fa-plug', '2021-07-15 21:44:21'),
('1', '09', 'Engineering Mechanics', 'Course objectives are to impart knowledge about force systems and methods to determine resultant centroid and moment of inertia and much more.', 'green', 'fa-car', '2021-07-15 21:45:37'),
('1', '10', 'Engineering Graphics', 'Course objectives are to acquire basic knowledge about engineering drawing language, line types, dimension methods, and simple geometrical construction and much more.', 'orange', 'fa-drafting-compass', '2021-07-15 21:48:57'),
('1', '11', 'Project Based Learning', 'Course objectives are to emphasizes learning activities that are long-term, interdisciplinary and student-centric and much more.', 'purple', 'fa-chart-bar', '2021-07-15 21:52:07'),
('1', '12', 'Workshop', 'Course objectives are to understand the construction and working of machine tools and functions of its parts and much more.', 'blue', 'fa-tools', '2021-07-15 21:54:40'),
('1', '13', 'Environmental Studies', 'Course objectives are to explain the concepts and strategies related to sustainable development and various components of environment and much more.', 'green', 'fa-tree', '2021-07-15 21:56:04'),
('1', '14', 'Physical Education-Exercise and Field Activities', 'Physical Education (PE) develops students\' competence and confidence to take part in a range of physical activities .', 'orange', 'fa-dumbbell', '2021-07-15 22:01:14');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `thread_id` int(15) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(30) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`thread_id`, `tag_id`, `tag_name`, `timestamp`) VALUES
(2, 0, 'Not added yet', '2021-07-19 21:25:47'),
(1, 1, 'Maclaurian theorem', '2021-07-19 17:38:56'),
(28, 2, 'lathe machine', '2021-07-19 17:57:06'),
(46, 4, 'EVS', '2021-07-19 18:05:22'),
(47, 5, 'interference and diffraction', '2021-07-19 18:07:28'),
(48, 6, 'EMOSFET', '2021-07-19 19:08:38');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `sub_id` int(15) NOT NULL,
  `thread_id` int(15) NOT NULL,
  `thread` varchar(300) NOT NULL,
  `thread_desc` text NOT NULL,
  `tag_id` int(15) NOT NULL,
  `user_id` int(15) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`sub_id`, `thread_id`, `thread`, `thread_desc`, `tag_id`, `user_id`, `timestamp`) VALUES
(1, 1, 'What is maclaurian theorem', 'Pls help me!', 1, 10903, '2021-07-16 14:25:50'),
(2, 2, 'What are different types hardness in water', 'someone explain me types hardness in water.', 0, 0, '2021-07-16 14:34:07'),
(3, 3, 'How to solve ques of thermodynamics', 'how to apply formulaes of thermodynamics', 0, 0, '2021-07-16 14:38:53'),
(4, 4, 'Someone explain me about BJT', 'i have doubts in BJT pls help me', 0, 0, '2021-07-16 16:27:23'),
(1, 5, 'What is Fourier sine series', 'can someone tell formula of fourier sine series', 0, 10909, '2021-07-16 16:31:32'),
(3, 6, 'chasis in vehicle', 'what is chasis in vehicle ', 0, 10909, '2021-07-16 16:52:14'),
(1, 7, 'Help me in learning diffrential eqn', '123 check', 0, 10909, '2021-07-17 08:42:13'),
(5, 8, 'list in python', 'tell me how to cover list in python', 0, 10909, '2021-07-17 09:03:27'),
(6, 9, 'how to cover curve tracing ', 'help me to cover curve tracing', 0, 10909, '2021-07-17 09:04:22'),
(7, 10, 'explain malus law', 'someone pls explain me about malus law', 0, 10909, '2021-07-17 09:05:38'),
(8, 11, 'which book is best to learn BEE', 'any idea related to this', 0, 10909, '2021-07-17 09:06:31'),
(9, 12, 'is reading techneo good for mechanics', 'someone help me', 0, 10909, '2021-07-17 09:07:14'),
(14, 13, 'any one have about assignments of PE', 'someone pls help me', 0, 10909, '2021-07-17 09:08:02'),
(13, 14, 'how to give presentation in es', 'someone pls help me', 0, 10909, '2021-07-17 09:08:52'),
(12, 15, 'what are the rules to follow in lab', 'someone pls help me', 0, 10909, '2021-07-17 09:09:42'),
(11, 16, 'from where should i learn about php', 'someone pls help me', 0, 10909, '2021-07-17 09:10:37'),
(10, 17, 'how to draw cycloid ', 'someone pls help me', 0, 10909, '2021-07-17 09:11:09'),
(1, 18, 'how to solve questions based on partial derivative', 'someone pls help me', 0, 10914, '2021-07-17 10:32:42'),
(9, 19, 'what is torque', 'someone pls help', 0, 10903, '2021-07-17 10:53:02'),
(3, 20, 'what is heat', 'someone help me', 0, 10909, '2021-07-17 11:43:44'),
(1, 21, 'jacobian theorem', '1234', 0, 10909, '2021-07-17 14:07:06'),
(1, 22, 'jacobian theorem', '1234', 0, 10906, '2021-07-17 16:22:32'),
(8, 23, 'what is transformer', '123', 0, 10906, '2021-07-17 16:23:34'),
(1, 24, 'what is determinant', 'help me', 0, 10909, '2021-07-19 11:09:44'),
(1, 25, 'what is matrix', 'help me', 0, 10909, '2021-07-19 11:10:24'),
(11, 26, 'how to pyaudio', 'help me', 0, 10909, '2021-07-19 11:11:34'),
(5, 27, 'how to use pyaudio', 'help me', 0, 10909, '2021-07-19 11:23:45'),
(5, 28, 'tuples in python', 'tell me how to cover list in python', 0, 10909, '2021-07-19 11:27:25'),
(6, 44, 'No doubts for now', 'thanks ', 0, 10903, '2021-07-19 17:59:25'),
(12, 45, 'how to use lathe machine', 'help me pls', 2, 10909, '2021-07-19 18:00:25'),
(13, 46, 'when is our last ppt taken away', 'help me to note this', 4, 10909, '2021-07-19 18:05:22'),
(7, 47, 'what is the use of interference and diffraction', 'help me pls', 5, 10909, '2021-07-19 18:07:28'),
(4, 48, 'how EMOSFET works', 'Help me pls', 6, 10909, '2021-07-19 19:08:38'),
(4, 49, 'full form of EMOSFET', 'help me pls', 6, 10909, '2021-07-19 19:09:29'),
(4, 50, 'how EMOSFET works as a device', 'help me pls', 6, 10909, '2021-07-19 19:11:11'),
(4, 51, 'definations in emosfet', 'help me pls', 6, 10909, '2021-07-19 19:12:33'),
(1, 56, 'how to solve this question ', 'pls help me', 1, 10913, '2021-07-20 16:35:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Status` varchar(5) NOT NULL,
  `Id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `last_login` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Status`, `Id`, `username`, `user_id`, `user_pass`, `last_login`, `timestamp`) VALUES
('PICT', '0', 'Default user', 'defaultuser@pict.edu', '$2y$10$GL22V2rTtRjZLeOcAWwWZuAA05TEtLIQ.fZDh2EflJ3T69rGJKry2', 1, '2021-07-16 14:27:20'),
('Other', '01', 'Tanu', 'tanu@gmail.com', '$2y$10$8xJtUWqVcosuNyBMX47U7Oj6wiOuEXpkycFfSVrqbk9GVod1vDUuy', 0, '2021-07-12 17:45:13'),
('Other', '02', 'Nita', 'nita@gmail.com', '$2y$10$fxKpPhpKVU0qjkXf.n3buuQv8P0JSVZ0M13Sf1g9Sx0jYsypzGKOC', 0, '2021-07-15 23:26:36'),
('Other', '03', 'naresh', 'naresh@gmail.com', '$2y$10$RoS7b7t0CwZ4cg7FKDVIdeqK/IOkmRgwP90gao8CNoPS24QehII92', 0, '2021-07-15 23:30:24'),
('Other', '04', 'aditya', 'aditya@gmail.com', '$2y$10$Ou7GL7JzDjuK.o8xje8Clem44JFTiounehYFhgeQHmt8p8UtXxiSS', 0, '2021-07-17 00:26:18'),
('Other', '05', 'Nita', 'nita1@gmail.com', '$2y$10$a6t4gHL3bV2ZVQfBavNt0.5TIFBvrrprnlcme/nWgLrHv9BHS9ZQG', 0, '2021-07-19 11:22:23'),
('PICT', '10903', 'Sunandan Gupta', 'sunandan@gmail.com', '$2y$10$GL22V2rTtRjZLeOcAWwWZuAA05TEtLIQ.fZDh2EflJ3T69rGJKry2', 1627136906, '2021-07-17 10:42:53'),
('PICT', '10906', 'Shubham Pitle', 'shubham@gmail.com', '$2y$10$GL22V2rTtRjZLeOcAWwWZuAA05TEtLIQ.fZDh2EflJ3T69rGJKry2', 1627141769, '2021-07-17 10:44:05'),
('PICT', '10909', 'Tanmay Thanvi', 'tanmay@gmail.com', '$2y$10$GL22V2rTtRjZLeOcAWwWZuAA05TEtLIQ.fZDh2EflJ3T69rGJKry2', 1627144990, '2021-07-12 15:50:55'),
('PICT', '10913', 'Tanvi Khare', 'tanvi@gmail.com', '$2y$10$GL22V2rTtRjZLeOcAWwWZuAA05TEtLIQ.fZDh2EflJ3T69rGJKry2', 1627145027, '2021-07-17 10:44:54'),
('PICT', '10914', 'Sejal Khillari', 'sejal@gmail.com', '$2y$10$GL22V2rTtRjZLeOcAWwWZuAA05TEtLIQ.fZDh2EflJ3T69rGJKry2', 1627143436, '2021-07-17 09:33:07'),
('PICT', '20909', 'Tanmay 2nd yr', 'tanmay2@gmail.com', '$2y$10$8xJtUWqVcosuNyBMX47U7Oj6wiOuEXpkycFfSVrqbk9GVod1vDUuy', 0, '2021-07-15 22:59:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);
ALTER TABLE `comments` ADD FULLTEXT KEY `comment` (`comment`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `subforum`
--
ALTER TABLE `subforum`
  ADD PRIMARY KEY (`sub_id`);
ALTER TABLE `subforum` ADD FULLTEXT KEY `sub_name` (`sub_name`,`sub_descp`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`thread_id`);
ALTER TABLE `threads` ADD FULLTEXT KEY `thread` (`thread`,`thread_desc`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `feedback_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `thread_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
