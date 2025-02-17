-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2025 at 06:11 PM
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
-- Database: `online_courses2`
--
CREATE DATABASE IF NOT EXISTS `online_courses2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `online_courses2`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `user_name`, `password`) VALUES
(1, 'admin', 'main');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_title` varchar(50) NOT NULL,
  `number_of_lectures` int(11) DEFAULT NULL,
  `number_of_hours` int(11) DEFAULT NULL,
  `cover_picture_name` varchar(50) DEFAULT NULL,
  `category` varchar(50) NOT NULL,
  `number_of_enrollment` int(11) DEFAULT 0,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_title`, `number_of_lectures`, `number_of_hours`, `cover_picture_name`, `category`, `number_of_enrollment`, `description`) VALUES
(27, 'Imperative Programming', 25, 40, '27.jpg', 'programming', 0, 'Learn structured coding with variables, loops, and functions. This course covers step-by-step problem-solving using languages like C, Java, or Python.'),
(28, 'Analysis One', 30, 50, '28.jpg', 'mathematics', 3, 'Covers limits, derivatives, integrals, and sequences. A foundational course in calculus with real-world applications in science and engineering.'),
(29, 'Backend Development', 20, 35, '29.jpg', 'web development', 2, 'Learn server-side coding, databases, and APIs. Covers authentication, data management, and frameworks like PHP, Node.js, or Python.'),
(30, 'High School Biology', 18, 30, '30.jpg', 'biology', 0, 'Study cells, genetics, evolution, and ecosystems. This course introduces key biological concepts and their impact on life and the environment.'),
(31, 'Object-Oriented Programming', 25, 40, '31.jpg', 'programming', 0, 'Learn OOP concepts like classes, objects, inheritance, and polymorphism using Java or C++.'),
(32, 'Data Structures & Algorithms', 30, 50, '32.jpg', 'computer science', 3, 'Covers arrays, linked lists, trees, sorting, and searching algorithms for efficient coding.'),
(33, 'Web Development', 20, 35, '33.jpg', 'web technologies', 0, 'Learn HTML, CSS, and JavaScript to build interactive and responsive websites.'),
(34, 'Cybersecurity Fundamentals', 18, 30, '34.jpg', 'security', 0, 'Introduction to network security, encryption, and ethical hacking principles.'),
(35, 'Artificial Intelligence Basics', 22, 40, '35.jpg', 'artificial intelligence', 0, 'Explore AI concepts like machine learning, neural networks, and decision-making models.'),
(36, 'Cloud Computing', 15, 25, '36.jpg', 'cloud & devops', 0, 'Learn cloud platforms like AWS, Google Cloud, and Azure for scalable web applications.'),
(37, 'Database Management Systems', 24, 38, '37.jpg', 'databases', 1, 'Study SQL, normalization, indexing, and database security in MySQL and PostgreSQL.'),
(38, 'Software Engineering Principles', 20, 32, '38.jpg', 'software development', 0, 'Covers software development life cycle (SDLC), Agile, and version control.'),
(39, 'Mobile App Development', 20, 32, '39.jpg', 'mobile development', 0, 'Learn to build Android and iOS apps using Flutter or React Native.'),
(40, 'Game Development', 28, 45, '40.jpg', 'game design', 1, 'Introduction to game engines like Unity and Unreal for designing interactive games.'),
(41, 'Computer Networks', 22, 36, '41.jpg', 'networking', 0, 'Learn networking basics, protocols, and security principles to understand how data moves across systems.'),
(42, 'Operating Systems', 28, 45, '42.jpg', 'computer science', 0, 'Covers OS fundamentals like process management, memory allocation, and file systems using Linux and Windows.'),
(43, 'Software Testing & Quality Assurance', 18, 30, '43.jpg', 'software development', 2, 'Learn manual and automated testing techniques to ensure software reliability.'),
(44, 'Front-End Development', 24, 38, '44.jpg', 'web development', 0, 'Master JavaScript, React, and UI/UX principles to create interactive web applications.'),
(45, 'Ethical Hacking & Penetration Testing', 20, 35, '45.jpg', 'security', 0, 'Learn ethical hacking techniques to identify and fix security vulnerabilities.'),
(46, 'Machine Learning Fundamentals', 25, 40, '46.jpg', 'artificial intelligence', 14, 'Covers supervised and unsupervised learning, regression, and classification techniques.'),
(47, 'Big Data & Analytics', 22, 36, '47.jpg', 'data science', 0, 'Learn data processing, visualization, and tools like Hadoop and Spark for large-scale data analysis.'),
(48, 'Blockchain Technology', 18, 32, '48.jpg', 'blockchain', 0, 'Introduction to decentralized systems, smart contracts, and cryptocurrencies like Bitcoin and Ethereum.'),
(49, 'Embedded Systems', 26, 42, '49.jpg', 'embedded systems', 0, 'Learn microcontroller programming, IoT applications, and real-time operating systems.'),
(50, 'Quantum Computing Basics', 15, 28, '50.jpg', 'quantum computing', 0, 'Introduction to qubits, superposition, and quantum algorithms for next-gen computing.'),
(51, 'Internet of Things (IoT)', 20, 34, '51.jpg', 'iot', 0, 'Learn to connect and manage smart devices using IoT protocols and cloud integration.'),
(52, 'Human-Computer Interaction (HCI)', 18, 30, '52.jpg', 'design & ux', 0, 'Study UI/UX principles, usability testing, and user-centered design for better software experiences.'),
(53, '3D Modeling & Animation', 22, 38, '53.jpg', 'design & animation', 0, 'Learn Blender or Maya to create 3D assets for games, films, and virtual reality.'),
(54, 'Augmented & Virtual Reality Development', 24, 40, '54.jpg', 'ar / vr', 0, 'Covers AR/VR concepts, Unity, and interaction design for immersive experiences.'),
(55, 'Digital Marketing & SEO', 20, 32, '55.jpg', 'business & marketing', 0, 'Learn content marketing, social media strategies, and search engine optimization techniques.'),
(56, 'Technical Writing', 16, 28, '56.jpg', 'writing & documentation', 2, 'Develop skills in writing software documentation, API guides, and user manuals for developers and businesses.'),
(57, 'Robotics & Automation', 25, 40, '57.jpg', 'robotics', 0, 'Learn how to design, build, and program robots using AI and automation technologies. Covers robotic arms, autonomous systems, and real-world applications.'),
(58, 'Course full name', 22, 33, '58.jpg', 'computer science', 0, 'description...');

-- --------------------------------------------------------

--
-- Table structure for table `course_teachers`
--

CREATE TABLE `course_teachers` (
  `teacher_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_teachers`
--

INSERT INTO `course_teachers` (`teacher_id`, `course_id`) VALUES
(9, 27),
(9, 28),
(9, 29),
(9, 30),
(9, 31),
(9, 32),
(9, 33),
(9, 34),
(9, 35),
(10, 36),
(10, 37),
(10, 38),
(10, 39),
(10, 40),
(10, 41),
(10, 42),
(10, 43),
(10, 44),
(10, 45),
(10, 46),
(11, 47),
(11, 48),
(11, 49),
(11, 50),
(11, 51),
(11, 52),
(11, 53),
(11, 54),
(11, 55),
(11, 56),
(11, 57),
(14, 58);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `name`, `email`, `user_name`, `password`) VALUES
(9, 'Yasin Hamad', 'yasin.hamad27@gmail.com', 'yasin_hamad', 't1234'),
(10, 'Imad Rashad', 'imad.rashad.2002@gmail.com', 'imad_rashad', 'i1234'),
(11, 'Waseem Yousef', 'waseem.yousef27@gmail.com', 'waseem_yousef', 'w1234'),
(12, 'yasin yasin', 'yasin.hamad27@gmail.com', 'tyasin', 't1234'),
(14, 'Yasin Hamad', 'yasin.hamad27@gmail.com', 'tyasinn', 'passw');

-- --------------------------------------------------------

--
-- Table structure for table `temporary_courses`
--

CREATE TABLE `temporary_courses` (
  `course_id` int(11) NOT NULL,
  `course_title` varchar(50) NOT NULL,
  `number_of_lectures` int(11) DEFAULT NULL,
  `number_of_hours` int(11) DEFAULT NULL,
  `cover_picture_name` varchar(50) DEFAULT NULL,
  `category` varchar(50) NOT NULL,
  `number_of_enrollment` int(11) DEFAULT 0,
  `description` varchar(255) NOT NULL,
  `teacher_email` varchar(50) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `profile_picture_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `user_name`, `password`, `profile_picture_name`, `email`) VALUES
(24, 'Yasin Hamad', 'yasin27', 'passw', 'yasin27.png', 'yasin.hamad27@gmail.com'),
(25, 'Imad Rashad', 'imad27', 'passw', NULL, 'yasin.hamad27@gmail.com'),
(26, 'Yasin Hamad', 'yasin29', 'passw', 'yasin29.png', 'yasin.hamad27@gmail.com'),
(27, 'Yasina Hamad', 'yasin25', 'passw', 'yasin25.png', 'yasin.hamad27@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_courses`
--

CREATE TABLE `user_courses` (
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `enroll_data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_courses`
--

INSERT INTO `user_courses` (`user_id`, `course_id`, `enroll_data`) VALUES
(25, 28, '2025-02-17'),
(25, 32, '2025-02-17'),
(25, 40, '2025-02-17'),
(25, 43, '2025-02-17'),
(27, 28, '2025-02-17'),
(27, 29, '2025-02-17'),
(27, 32, '2025-02-17'),
(27, 37, '2025-02-17'),
(27, 43, '2025-02-17'),
(27, 46, '2025-02-17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `course_teachers`
--
ALTER TABLE `course_teachers`
  ADD PRIMARY KEY (`teacher_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `temporary_courses`
--
ALTER TABLE `temporary_courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_courses`
--
ALTER TABLE `user_courses`
  ADD PRIMARY KEY (`user_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `temporary_courses`
--
ALTER TABLE `temporary_courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_teachers`
--
ALTER TABLE `course_teachers`
  ADD CONSTRAINT `course_teachers_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`),
  ADD CONSTRAINT `course_teachers_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `user_courses`
--
ALTER TABLE `user_courses`
  ADD CONSTRAINT `user_courses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `user_courses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
