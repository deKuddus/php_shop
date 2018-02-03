-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2018 at 11:08 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `email`, `password`, `level`) VALUES
(1, 'kuddus', 'admin', 'kuddus@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 0);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand_name`) VALUES
(1, 'samsung'),
(2, 'Acer'),
(4, 'Apple'),
(5, 'Canon');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `sessionId` varchar(255) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `sessionId`, `productId`, `productName`, `quantity`, `price`, `image`) VALUES
(6, '4d02a2up907f9c63d279dbqo06', 5, 'DSLR mini', 1, 1000.00, 'upload/70f0ad9653.jpg'),
(7, '4d02a2up907f9c63d279dbqo06', 1, 'Mac book', 1, 555.00, 'upload/249f77c9d0.png');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `cat_name`) VALUES
(1, 'Camera'),
(4, 'Mobile Phones'),
(5, 'Desktop'),
(6, 'Laptop'),
(7, 'Accessories'),
(8, 'Software'),
(9, 'Sports &amp; Fitness'),
(10, 'Footwear'),
(11, 'Jewellery'),
(12, 'Clothing'),
(13, 'Home Decor &amp; Kitchen'),
(14, 'Beauty &amp; Healthcare');

-- --------------------------------------------------------

--
-- Table structure for table `compare`
--

CREATE TABLE `compare` (
  `id` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `phone`, `message`) VALUES
(1, 'md kuddus', 'mdkuddus@gmail.com', '01834444444', 'a quick brown fox jumps over the lazy dog');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `city` text NOT NULL,
  `zip` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `city`, `zip`, `address`, `country`, `phone`, `password`) VALUES
(1, 'md kuddus munsi', 'kuddus@gmail.com', 'sonimury,noakhali', '3336', 'amin bazar', 'bangladesh', '01834776137', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `id` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`id`, `customerId`, `productId`, `productName`, `quantity`, `price`, `image`, `date`, `status`) VALUES
(16, 1, 5, 'DSLR mini', 1, 1000.00, 'upload/70f0ad9653.jpg', '2018-01-27 17:11:48', 0),
(17, 1, 2, 'Samsung j7', 1, 100.00, 'upload/d1a16aa039.png', '2018-01-27 17:11:48', 0),
(18, 1, 8, 'Speaker 55HZ', 2, 500.00, 'upload/1f61668a11.jpg', '2018-01-27 17:12:47', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `catId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `body` varchar(2000) NOT NULL,
  `price` float(10,3) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `catId`, `brandId`, `body`, `price`, `image`, `type`) VALUES
(1, 'Mac book', 6, 4, 'This is Mac book probide by apple company.&amp;nbsp;This is Mac book probide by apple company.&amp;nbsp;This is Mac book probide by apple company.&amp;nbsp;This is Mac book probide by apple company.&amp;nbsp;This is Mac book probide by apple company.&amp;nbsp;This is Mac book probide by apple company.&amp;nbsp;This is Mac book probide by apple company.&amp;nbsp;This is Mac book probide by apple company.&amp;nbsp;This is Mac book probide by apple company', 555.000, 'upload/249f77c9d0.png', 0),
(2, 'Samsung j7', 4, 1, '&lt;p&gt;It is samsung j7&amp;nbsp; model mobile phone probided by samsung.It is samsung j7&amp;nbsp; model mobile phone probided by samsung.It is samsung j7&amp;nbsp; model mobile phone probided by samsung.It is samsung j7&amp;nbsp; model mobile phone probided by samsung.It is samsung j7&amp;nbsp; model mobile phone probided by samsung.&lt;/p&gt;', 100.000, 'upload/d1a16aa039.png', 0),
(4, 'Pentium 4', 5, 2, '&lt;p&gt;A quick brown fox jumps over the lazy dog.A quick brown fox jumps over the lazy dog.A quick brown fox jumps over the lazy dog.A quick brown fox jumps over the lazy dog.A quick brown fox jumps over the lazy dog.A quick brown fox jumps over the lazy dog.&lt;/p&gt;', 1200.000, 'upload/15156bdea1.png', 1),
(5, 'DSLR mini', 1, 1, '&lt;p&gt;Shop BestBuy.com for&amp;nbsp;DSLR cameras. We\'ll help you find the right digital single lens reflex camera to capture a lifetime of memoriesShop BestBuy.com for&amp;nbsp;DSLR cameras. We\'ll help you find the right digital single lens reflex camera to capture a lifetime of memoriesShop BestBuy.com for&amp;nbsp;DSLR cameras. We\'ll help you find the right digital single lens reflex camera to capture a lifetime of memories&lt;/p&gt;\r\n&lt;p&gt;Shop BestBuy.com for&amp;nbsp;DSLR cameras. We\'ll help you find the right digital single lens reflex camera to capture a lifetime of memoriesShop BestBuy.com for&amp;nbsp;DSLR cameras. We\'ll help you find the right digital single lens reflex camera to capture a lifetime of memoriesShop BestBuy.com for&amp;nbsp;DSLR cameras. We\'ll help you find the right digital single lens reflex camera to capture a lifetime of memories&lt;/p&gt;', 1000.000, 'upload/70f0ad9653.jpg', 0),
(7, 'Blander Machine', 13, 1, '&lt;p&gt;This is a Blander machine provided by sumsang which is an korean company.&amp;nbsp;This is a Blander machine provided by sumsang which is an korean company.&amp;nbsp;This is a Blander machine provided by sumsang which is an korean company.&amp;nbsp;This is a Blander machine provided by sumsang which is an korean company.&amp;nbsp;&lt;/p&gt;', 200.000, 'upload/3f29fe7c39.png', 1),
(8, 'Speaker 55HZ', 7, 5, '&lt;p&gt;This is an speaker which is made by cannon accessories company.This is an speaker which is made by cannon accessories company.This is an speaker which is made by cannon accessories company.This is an speaker which is made by cannon accessories company.&lt;/p&gt;', 250.000, 'upload/1f61668a11.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `customerId`, `productId`, `productName`, `price`, `image`) VALUES
(1, 1, 5, 'DSLR mini', 1000.00, 'upload/70f0ad9653.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compare`
--
ALTER TABLE `compare`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `compare`
--
ALTER TABLE `compare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
