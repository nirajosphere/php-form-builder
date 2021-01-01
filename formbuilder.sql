-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2019 at 04:37 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `formbuilder`
--

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `id` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` mediumtext,
  `form_object` longtext,
  `meta` longtext,
  `activity` longtext,
  `status` varchar(256) NOT NULL DEFAULT 'inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `username`, `title`, `description`, `form_object`, `meta`, `activity`, `status`) VALUES
('3kJQQZrML12Z', 'niraj.gohel', 'Sample Form 3', 'This is a test description for Sample Form 3', '{\"aRw38UbBzAAr\":{\"type\":\"short_answer\",\"label\":\"Last Name\"},\"fDv8CZmqnMm2\":{\"type\":\"long_answer\",\"is_required\":\"on\",\"label\":\"Desc\"},\"oPxGGpjK0iOP\":{\"type\":\"short_answer\",\"label\":\"First Name\"},\"PtMHYxtcJwvH\":{\"type\":\"multiple_choice\",\"is_required\":\"on\",\"label\":\"sdf\",\"options\":{\"1lriTbneBRvy\":{\"label\":\"sd\"},\"akFRwmZrz6mv\":{\"label\":\"sf\"}}}}', NULL, '', 'active'),
('5p96OJr61JC3', 'niraj.gohel', 'Untitled Form nnnn', 'short desc', '{\"kMdpHPy9tYFp\":{\"type\":\"short_answer\",\"is_required\":\"on\",\"label\":\"asd\"}}', NULL, '', 'inactive'),
('6NPYIy5PXs3S', 'niraj.gohel', 'Untitled Form', '', '[]', NULL, '', 'inactive'),
('9CJQldjLQmbe', 'niraj.gohel', 'Untitled Form', '', '[]', NULL, NULL, 'inactive'),
('BohQxcLmOsAm', 'niraj.gohel', 'Untitled Form', '', '[]', NULL, NULL, 'inactive'),
('HPLppnsSYlum', 'niraj.gohel', 'Untitled Form', '', '[]', NULL, '', 'inactive'),
('INEdN1vtVHKs', 'niraj.gohel', 'US Travel', '', '{\"f1h5NBl87xgO\":{\"type\":\"short_answer\",\"is_required\":\"on\",\"label\":\"Email Address\"},\"NgCQAE3NHomg\":{\"type\":\"short_answer\",\"is_required\":\"on\",\"label\":\"Consultant ID\"},\"fssyrhZxb4tT\":{\"type\":\"short_answer\",\"label\":\"Consultant Name\"},\"3mrt0df1ncNJ\":{\"type\":\"multiple_choice\",\"label\":\"Do you have B1 Visa - US\",\"options\":{\"i39RNZiXJh4T\":{\"label\":\"Yes\"},\"GgosItJZ4rC6\":{\"label\":\"No\"}}},\"nCYo493KwE6w\":{\"type\":\"short_answer\",\"label\":\"Current Role (Eg. Developer , Architect , QA)\"},\"2WaEiQVnbpdO\":{\"type\":\"long_answer\",\"is_required\":\"on\",\"label\":\"Please mention your competency (eg Java , .Net , BI )\"},\"1zoRfRGvMBId\":{\"type\":\"multiple_choice\",\"label\":\"Willing to Travel US\",\"options\":{\"Iv0ex3kGkktk\":{\"label\":\"Yes\"},\"PHm2SoeevjB0\":{\"label\":\"No\"}}}}', NULL, NULL, 'active'),
('stAl7UO7ZKz3', 'niraj.gohel', 'Untitled Form', '', '[]', NULL, '', 'inactive'),
('yW17koYwklD1', 'niraj.gohel', 'Untitled Form', '', '[]', NULL, '', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `response`
--

CREATE TABLE `response` (
  `id` bigint(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `form_id` varchar(256) NOT NULL,
  `response` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `response`
--

INSERT INTO `response` (`id`, `timestamp`, `form_id`, `response`) VALUES
(1, '2019-08-02 09:42:13', '3kJQQZrML12Z', '{\"dXD4lXfBPD1y\":\"Gohel\",\"oPxGGpjK0iOP\":\"Niraj\",\"fDv8CZmqnMm2\":\"Sample Desc\"}'),
(2, '2019-08-02 09:46:22', '3kJQQZrML12Z', '{\"dXD4lXfBPD1y\":\"Gohel\",\"oPxGGpjK0iOP\":\"Niraj\",\"fDv8CZmqnMm2\":\"Sample Desc\"}'),
(3, '2019-08-02 09:47:50', '3kJQQZrML12Z', '{\"dXD4lXfBPD1y\":\"Gohel\",\"oPxGGpjK0iOP\":\"Niraj\",\"fDv8CZmqnMm2\":\"Sample Desc\"}'),
(4, '2019-08-02 09:48:09', '3kJQQZrML12Z', '{\"dXD4lXfBPD1y\":\"Gohel\",\"oPxGGpjK0iOP\":\"Niraj\",\"fDv8CZmqnMm2\":\"Sample Desc\"}'),
(5, '2019-08-02 09:48:18', '3kJQQZrML12Z', '{\"dXD4lXfBPD1y\":\"Gohel\",\"oPxGGpjK0iOP\":\"Niraj\",\"fDv8CZmqnMm2\":\"Sample Desc\"}'),
(6, '2019-08-02 09:48:19', '3kJQQZrML12Z', '{\"dXD4lXfBPD1y\":\"Gohel\",\"oPxGGpjK0iOP\":\"Niraj\",\"fDv8CZmqnMm2\":\"Sample Desc\"}'),
(7, '2019-08-02 09:48:31', '3kJQQZrML12Z', '{\"dXD4lXfBPD1y\":\"Gohel\",\"oPxGGpjK0iOP\":\"Niraj\",\"fDv8CZmqnMm2\":\"Sample Desc\"}'),
(8, '2019-08-02 09:48:53', '3kJQQZrML12Z', '{\"dXD4lXfBPD1y\":\"Gohel\",\"oPxGGpjK0iOP\":\"Niraj\",\"fDv8CZmqnMm2\":\"Sample Desc\"}'),
(9, '2019-08-02 09:49:01', '3kJQQZrML12Z', '{\"dXD4lXfBPD1y\":\"Gohel\",\"oPxGGpjK0iOP\":\"Niraj\",\"fDv8CZmqnMm2\":\"Sample Desc\"}'),
(10, '2019-08-02 09:49:08', '3kJQQZrML12Z', '{\"dXD4lXfBPD1y\":\"Gohel\",\"oPxGGpjK0iOP\":\"Niraj\",\"fDv8CZmqnMm2\":\"Sample Desc\"}'),
(11, '2019-08-02 09:49:21', '3kJQQZrML12Z', '{\"dXD4lXfBPD1y\":\"Gohel\",\"oPxGGpjK0iOP\":\"Niraj\",\"fDv8CZmqnMm2\":\"Sample Desc\"}'),
(12, '2019-08-19 13:15:59', '3kJQQZrML12Z', '{\"aRw38UbBzAAr\":\"Gohel\",\"fDv8CZmqnMm2\":\"Sample Description\",\"oPxGGpjK0iOP\":\"Niraj\"}'),
(13, '2019-08-20 08:31:05', '3kJQQZrML12Z', '{\"aRw38UbBzAAr\":\"Malvi\",\"fDv8CZmqnMm2\":\"Test Desc\",\"oPxGGpjK0iOP\":\"Pratik\",\"PtMHYxtcJwvH\":\"sd\"}'),
(14, '2019-08-20 08:32:46', '3kJQQZrML12Z', '{\"aRw38UbBzAAr\":\"Malvi\",\"fDv8CZmqnMm2\":\"Sample Description\",\"oPxGGpjK0iOP\":\"Pratik\"}'),
(15, '2019-08-20 09:50:54', '3kJQQZrML12Z', '{\"aRw38UbBzAAr\":\"\",\"fDv8CZmqnMm2\":\"\",\"oPxGGpjK0iOP\":\"\",\"PtMHYxtcJwvH\":\"sf\"}'),
(16, '2019-08-27 12:08:51', 'INEdN1vtVHKs', '{\"f1h5NBl87xgO\":\"vishal.valand@spec-india.com\",\"NgCQAE3NHomg\":\"772\",\"fssyrhZxb4tT\":\"Vishal\",\"3mrt0df1ncNJ\":\"No\",\"nCYo493KwE6w\":\"Designer\",\"2WaEiQVnbpdO\":\"Java\",\"1zoRfRGvMBId\":\"Yes\"}'),
(17, '2019-08-27 12:08:56', 'INEdN1vtVHKs', '{\"f1h5NBl87xgO\":\"pratik.malvi@spec-india.com\",\"NgCQAE3NHomg\":\"781\",\"fssyrhZxb4tT\":\"Pratik Malvi\",\"3mrt0df1ncNJ\":\"No\",\"nCYo493KwE6w\":\"Design Executive\",\"2WaEiQVnbpdO\":\"Design\",\"1zoRfRGvMBId\":\"Yes\"}'),
(18, '2019-08-27 12:20:42', 'INEdN1vtVHKs', '{\"f1h5NBl87xgO\":\"\",\"NgCQAE3NHomg\":\"\",\"fssyrhZxb4tT\":\"\",\"3mrt0df1ncNJ\":\"No\",\"nCYo493KwE6w\":\"\",\"2WaEiQVnbpdO\":\"\",\"1zoRfRGvMBId\":\"Yes\"}');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(256) NOT NULL,
  `fname` varchar(256) NOT NULL,
  `lname` varchar(256) NOT NULL,
  `password` varbinary(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `registered_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `fname`, `lname`, `password`, `email`, `registered_on`, `updated_on`) VALUES
('niraj.gohel', 'Niraj', 'Gohel', 0x0ff2d126242c6236b0247632aa7f1163, 'niraj.gohel@spec-india.com', '2019-07-31 06:52:23', '2019-07-31 06:52:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `response`
--
ALTER TABLE `response`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
