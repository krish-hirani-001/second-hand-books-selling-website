-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2025 at 05:54 AM
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
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$Y8t3sK8cYOa6LLbxCpZErexzb8IwoXQh0tZxkw2tvlsAPa8ymob4a');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `price` int(20) NOT NULL,
  `img` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`title`, `author`, `price`, `img`, `email`, `id`) VALUES
(' Air Pollution and Control', 'Dr. Ravikant Pagnis, Nameeta S. Sane', 430, 'b-15.jpg', 'krishhirani8@gmail.com', 24),
('The Vanishing Half', 'Brit Bennett', 370, '7.jpg', 'krishhirani8@gmail.com', 25),
('The Institute', 'Stephen King', 100, '23.jpg', 'krishhirani8@gmail.com', 26);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `total_products` varchar(1000) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `placed_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_email`, `name`, `phone`, `email`, `address`, `city`, `state`, `postal_code`, `payment_method`, `status`, `total_products`, `total_price`, `placed_on`) VALUES
(1, 'krishhirani8@gmail.com', 'krish hirani', '8320376419', 'krishhirani8@gmail.com', 'fgytfy tdrtdrtdt t drt rt rt rt rt rt ', 'rajkot', 'ratanpar', '360003', 'cod', 'Pending', ' Air Pollution and Control (₹430)', 520.00, '2025-10-05 09:15:27'),
(2, 'krishhirani8@gmail.com', 'krish hirani', '8320376419', 'krishhirani8@gmail.com', 'xdgfdrtdrtdrt drt drt drt rt rt rt rt', 'rajkot', 'ratanpar', '360003', 'upi', 'Cancelled', 'The Silent Patient (₹460)', 550.00, '2025-10-05 10:05:07');

-- --------------------------------------------------------

--
-- Table structure for table `sellbook`
--

CREATE TABLE `sellbook` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `book_condition` varchar(255) DEFAULT NULL,
  `price` int(20) NOT NULL,
  `bimage` varchar(255) NOT NULL,
  `bdescription` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sellbook`
--

INSERT INTO `sellbook` (`id`, `title`, `author`, `category`, `book_condition`, `price`, `bimage`, `bdescription`, `email`) VALUES
(97, 'Cryptography and Network Security ', 'Pravin Goyal', 'Fiction', 'Good', 500, 'b--1.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.', 'yash23@gmail.com'),
(98, 'Essence of Indian Knowledge System and Tradition', ' Sandeep Kamble, Vijendra Gupta', 'Fiction', 'Fair', 700, 'b-2.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.\r\n', 'yash23@gmail.com'),
(99, 'Communicative English ', 'Dr. Arpita Palchoudhury', 'Fiction', 'Fair', 300, 'B-3.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.\r\n', 'yash23@gmail.com'),
(100, 'Basic Electronics', 'J. S. Katre ', 'Fiction', 'Like New', 700, 'b-4.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.\r\n', 'yash23@gmail.com'),
(101, 'Data Structures', 'Dr. Bhakti Raul-Palkar', 'Fiction', 'Good', 600, 'b-5.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.\r\n', 'yash23@gmail.com'),
(102, 'Water Resources Engineering', 'Nishant A. Upadhye', 'Fiction', 'Fair', 350, 'b-6.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.\r\n', 'yash23@gmail.com'),
(103, 'Electric Vehicles', ' Prof. Shyam M. Ramnani', 'Non-Fiction', 'Good', 450, 'b-7.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.\r\n', 'yash23@gmail.com'),
(104, ' Basic Mathematics', 'Sameer Shah', 'Education', 'Good', 470, 'b-8.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.\r\n', 'yash23@gmail.com'),
(105, ' Database Management System ', ' Dr. Mahesh Malia', 'Fiction', 'Good', 770, 'b-9.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.\r\n', 'krishhirani8@gmail.com'),
(106, 'Operation Research', ' Girish G. Phatak', 'Non-Fiction', 'Good', 450, 'b-10.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.', 'krishhirani8@gmail.com'),
(107, 'Communication Skills', 'Shital Bhandari, Dr. Arpita Palchoudhury', 'Education', 'Good', 570, 'b-11.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.', 'jenish12@gmail.com'),
(108, 'Essence of Indian Knowledge System and Tradition', 'Sandeep Kamble, Vijendra Gupta', 'Comics', 'Good', 680, 'b-12.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.', 'jenish12@gmail.com'),
(109, 'Project Management ', ' Kundan K. Gautam', 'Novel', 'Fair', 490, 'b-13.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.', 'jenish12@gmail.com'),
(110, 'Environmental Engineering ', ' Dr. Ravikant Pagnis,J.S.Kadagaonkar', 'Education', 'Like New', 820, 'b-14.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.', 'jenish12@gmail.com'),
(111, ' Air Pollution and Control', 'Dr. Ravikant Pagnis, Nameeta S. Sane', 'Comics', 'Fair', 430, 'b-15.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.', 'jenish12@gmail.com'),
(113, 'The Vanishing Half', 'Brit Bennett', 'Comics', 'Fair', 370, '7.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.', 'ayush123@gmail.com'),
(114, 'The Great Gatsby', 'F. Scott Fitzgerald', 'Non-Fiction', 'Good', 460, '13.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.', 'ayush123@gmail.com'),
(115, 'The Martian', 'Andy Weir', 'Novel', 'Fair', 370, '15.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.', 'ayush123@gmail.com'),
(116, 'A Shadow in the Ember', 'A Shadow in the Ember', 'Novel', 'Like New', 720, '16.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.', 'ayush123@gmail.com'),
(117, 'The Guest List', 'Lucy Fokley', 'Non-Fiction', 'Good', 620, '17.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.', 'ayush123@gmail.com'),
(119, 'The Lincoln Highway', 'The Lincoln Highway', 'Novel', 'Like New', 600, '30.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.\r\n', 'krishhirani8@gmail.com'),
(120, 'The Only Good Indians', 'Stephen Graham Jones', 'Novel', 'Like New', 520, '34.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.\r\n', 'krishhirani8@gmail.com'),
(121, 'The Untold Chapters', 'Selene Ashbourne', 'Non-Fiction', 'Good', 540, '42.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.\r\n', 'krishhirani8@gmail.com'),
(122, 'Echoes of Forgotten Worlds', 'Dorian Graves', 'Novel', 'Like New', 730, '41.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.\r\n', 'krishhirani8@gmail.com'),
(123, 'The Cursed Crown', 'Damian Blackthorn', 'Non-Fiction', 'Good', 610, '45.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.\r\n', 'krishhirani8@gmail.com'),
(125, 'The Institute', 'Stephen King', 'Comics', 'Good', 100, '23.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.\r\n', 'krishhirani8@gmail.com'),
(127, 'Recursion', 'Blake Crouch', 'Comics', 'Fair', 740, '21.jpg', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis culpa corporis magnam sunt laboriosam vero.\r\n', 'krishhirani8@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `upassword` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `upassword`) VALUES
(1, 'krishhirani', 'krishhirani8@gmail.com', '25d55ad283aa400af464c76d713c07ad'),
(2, 'jenish', 'jenish12@gmail.com', '202cb962ac59075b964b07152d234b70'),
(3, 'yash', 'yash23@gmail.com', '8d5e957f297893487bd98fa830fa6413'),
(4, 'Ayush', 'ayush123@gmail.com', '202cb962ac59075b964b07152d234b70'),
(6, 'dharmang', 'dharmang12@gmail.com', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellbook`
--
ALTER TABLE `sellbook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sellbook`
--
ALTER TABLE `sellbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
