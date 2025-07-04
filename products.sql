-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2025 at 09:02 AM
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
-- Database: `product-crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`) VALUES
(1, 'chair123', 'a piece of furniture for one person to sit on, with a seat, a back and four legs', 1500000, 'Screenshot (32).png'),
(2, 'sofa', 'A sofa is defined as an upholstered bench or seat featuring arms and a back, allowing people to sit comfortably.', 1452, ''),
(3, 'table', 'this table description', 14587, ''),
(4, 'table', 'fdsfdsafsagf', 14558, ''),
(5, 'realme mobile', 'mobile', 23000, ''),
(6, 'realme mobile', 'dfasfsdfndsjfjsdhjffhjhj', 147852, ''),
(7, 'sofa', 'fdskjfjsd', 14785, ''),
(8, 'wasder', 'kfjdsfdskjafjkashjk', 132545454, ''),
(9, 'bottle', 'this is good bottle ', 147, 'Screenshot 2025-06-26 183707.png'),
(10, 'bottle2', 'also good', 852, 'Screenshot (32).png'),
(11, 'sport product', 'best one sport product', 500, 'Screenshot 2025-06-26 183707.png'),
(12, 'man', 'fjkjadsfs', 450, 'Screenshot 2025-06-30 123735.png'),
(16, 'Dining table', 'Dining table are good.', 500, 'Screenshot (32).png'),
(17, 'laptop', 'laptop is best device nowadays ', 250, 'Screenshot (32).png'),
(18, 'ball2', 'this is ball outside', 40, 'Screenshot 2025-06-30 123735.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
