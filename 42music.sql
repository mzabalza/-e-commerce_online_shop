-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 13, 2019 at 12:11 PM
-- Server version: 5.7.24
-- PHP Version: 7.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `42music`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'all'),
(2, 'piano'),
(3, 'guitar'),
(4, 'keyboard'),
(5, 'drums'),
(6, 'strings'),
(7, 'wind');

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `id` int(11) NOT NULL,
  `ID_category` int(11) NOT NULL,
  `ID_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`id`, `ID_category`, `ID_product`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 4, 1),
(4, 1, 2),
(5, 7, 2),
(6, 1, 3),
(7, 3, 3),
(8, 1, 4),
(9, 5, 4),
(10, 1, 5),
(11, 6, 5),
(12, 1, 6),
(13, 2, 6),
(14, 1, 7),
(15, 4, 7),
(16, 1, 8),
(17, 1, 9),
(18, 1, 10),
(19, 8, 10);

-- --------------------------------------------------------

--
-- Table structure for table `order_archive`
--

CREATE TABLE `order_archive` (
  `id` int(11) NOT NULL,
  `ID_user` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `id` int(11) NOT NULL,
  `ID_order` int(11) NOT NULL,
  `ID_product` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `price` float NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `img`, `quantity`) VALUES
(1, 'Alesis Recital Pro', 400, 'http://www.rock.ma/10077-thickbox_default/alesis-recital-pro.jpg', 20),
(2, 'Yamaha YCL-650II', 300, 'https://www.woodbrass.com/images/SQUARE400/woodbrass/YAMAHA+YCL650II.JPG', 20),
(3, 'Fender Stratocaster', 1000, 'https://d1aeri3ty3izns.cloudfront.net/media/26/269364/1200/preview.jpg', 20),
(4, 'Ludwig', 5000000, 'https://media.musiciansfriend.com/is/image/MMGS7/Junior-Outfit-Drum-Set-Blue/447702000004000-00-500x500.jpg', 20),
(5, 'Basswood', 200, 'https://cdn.shopify.com/s/files/1/1710/1447/products/Violin9.jpeg?v=1521557750', 20),
(6, 'Roland Grand Piano', 18000, 'https://d1aeri3ty3izns.cloudfront.net/media/12/120144/1200/preview.jpg', 20),
(7, 'Yamaha Y40', 150, 'https://media.cultura.com/media/catalog/product/cache/1/image/1000x1000/9df78eab33525d08d6e5fb8d27136e95/c/l/clavier-arrangeur-61-touches-385-sonorites-100-styles-usb-to-host-4957812527354_0.jpg?t=1509500344', 20);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `zip` int(11) NOT NULL,
  `city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `admin`, `email`, `passwd`, `name`, `first_name`, `adress`, `zip`, `city`) VALUES
(4, 1, 'tom@gmail.com', '0cb62d201b3e9761ebb2f20b11627011a09539d5fc65dc98d2bd24d3c71fec3e27ad475091d107a14660cd3982f5609e756e08ad3ac2282bfae0903095e24bbe', '1', '1', '1', 1, '1'),
(5, 1, 'mikel@gmail.com', '2f9959b230a44678dd2dc29f037ba1159f233aa9ab183ce3a0678eaae002e5aa6f27f47144a1a4365116d3db1b58ec47896623b92d85cb2f191705daf11858b8', '1', '1', '1', 1, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_archive`
--
ALTER TABLE `order_archive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_archive`
--
ALTER TABLE `order_archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
