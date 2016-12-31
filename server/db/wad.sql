-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 31, 2016 at 12:21 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wad`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `addr_line1` varchar(120) DEFAULT NULL,
  `addr_line2` varchar(120) DEFAULT NULL,
  `addr_line3` varchar(120) DEFAULT NULL,
  `city` varchar(120) DEFAULT NULL,
  `cnty` varchar(120) DEFAULT NULL,
  `zip` varchar(7) DEFAULT NULL,
  `tel` varchar(120) DEFAULT NULL,
  `mobile` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `alt_email` varchar(120) DEFAULT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `delivery_id` int(11) NOT NULL,
  `_order_id` int(11) NOT NULL,
  `delivery_firstname` varchar(250) NOT NULL,
  `delivery_surname` varchar(250) NOT NULL,
  `addr_line1` varchar(250) NOT NULL,
  `addr_line2` varchar(250) NOT NULL,
  `addr_line3` varchar(250) NOT NULL,
  `city` varchar(120) NOT NULL,
  `cnty` varchar(120) NOT NULL,
  `zip` varchar(7) NOT NULL,
  `tel` varchar(120) NOT NULL,
  `mobile` varchar(120) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `_order_id` int(11) NOT NULL,
  `payment_due_date` date NOT NULL,
  `vat` decimal(10,2) NOT NULL,
  `deductions` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(120) NOT NULL,
  `authorised` tinyint(1) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `additional_features` varchar(250) DEFAULT NULL,
  `os` varchar(250) DEFAULT NULL,
  `ui` varchar(250) DEFAULT NULL,
  `availability` varchar(250) DEFAULT NULL,
  `battery_standbytime` varchar(250) DEFAULT NULL,
  `battery_talktime` varchar(250) DEFAULT NULL,
  `battery_type` varchar(250) DEFAULT NULL,
  `camera_flash` tinyint(1) DEFAULT NULL,
  `camera_video` tinyint(1) DEFAULT NULL,
  `camera_primary` varchar(250) DEFAULT NULL,
  `connectivity_bluetooth` varchar(250) DEFAULT NULL,
  `connectivity_cell` varchar(250) DEFAULT NULL,
  `connectivity_gps` varchar(250) DEFAULT NULL,
  `connectivity_infrared` varchar(250) DEFAULT NULL,
  `connectivity_wifi` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `display_resolution` varchar(250) DEFAULT NULL,
  `display_size` varchar(250) DEFAULT NULL,
  `display_touchscreen` tinyint(1) DEFAULT NULL,
  `hardware_accelerometer` tinyint(1) DEFAULT NULL,
  `hardware_audiojack` varchar(250) DEFAULT NULL,
  `hardware_cpu` varchar(250) DEFAULT NULL,
  `hardware_fmradio` tinyint(1) DEFAULT NULL,
  `hardware_physicalkeyboard` tinyint(1) DEFAULT NULL,
  `hardware_usb` varchar(250) DEFAULT NULL,
  `image_0` varchar(250) DEFAULT NULL,
  `image_1` varchar(250) DEFAULT NULL,
  `image_2` varchar(250) DEFAULT NULL,
  `image_3` varchar(250) DEFAULT NULL,
  `image_4` varchar(250) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `dimensions_w` float DEFAULT NULL,
  `dimensions_h` float DEFAULT NULL,
  `dimensions_l` float DEFAULT NULL,
  `weight_grams` float DEFAULT NULL,
  `storage_flash` varchar(250) DEFAULT NULL,
  `storage_ram` varchar(250) DEFAULT NULL,
  `added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='\n';

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `firstname` varchar(120) DEFAULT NULL,
  `middle_name` varchar(120) DEFAULT NULL,
  `surname` varchar(120) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `cc_number` varchar(19) DEFAULT NULL,
  `cc_cvv` varchar(3) DEFAULT NULL,
  `cc_expires` date DEFAULT NULL,
  `dc_number` varchar(19) DEFAULT NULL,
  `dc_cvv` varchar(3) DEFAULT NULL,
  `dc_expires` date DEFAULT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_contact`
--

CREATE TABLE `user_contact` (
  `user_contact_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `_order`
--

CREATE TABLE `_order` (
  `_order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reference_id` varchar(250) DEFAULT NULL,
  `complete` tinyint(1) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `_order_product`
--

CREATE TABLE `_order_product` (
  `_order_product_id` int(11) NOT NULL,
  `_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_id`),
  ADD KEY `_order_delivery` (`_order_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `_order_invoice` (`_order_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `invoice_payment` (`invoice_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_contact`
--
ALTER TABLE `user_contact`
  ADD PRIMARY KEY (`user_contact_id`),
  ADD KEY `contact_customer_contact` (`contact_id`),
  ADD KEY `customer_customer_contact` (`user_id`);

--
-- Indexes for table `_order`
--
ALTER TABLE `_order`
  ADD PRIMARY KEY (`_order_id`),
  ADD KEY `customer_order` (`user_id`);

--
-- Indexes for table `_order_product`
--
ALTER TABLE `_order_product`
  ADD PRIMARY KEY (`_order_product_id`),
  ADD KEY `_order_order_product` (`_order_id`),
  ADD KEY `product_order_product` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `user_contact`
--
ALTER TABLE `user_contact`
  MODIFY `user_contact_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `_order`
--
ALTER TABLE `_order`
  MODIFY `_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `_order_product`
--
ALTER TABLE `_order_product`
  MODIFY `_order_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `_order_delivery` FOREIGN KEY (`_order_id`) REFERENCES `_order` (`_order_id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `_order_invoice` FOREIGN KEY (`_order_id`) REFERENCES `_order` (`_order_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `invoice_payment` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`invoice_id`);

--
-- Constraints for table `user_contact`
--
ALTER TABLE `user_contact`
  ADD CONSTRAINT `contact_customer_contact` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`contact_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_customer_contact` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `_order`
--
ALTER TABLE `_order`
  ADD CONSTRAINT `customer_order` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `_order_product`
--
ALTER TABLE `_order_product`
  ADD CONSTRAINT `_order_order_product` FOREIGN KEY (`_order_id`) REFERENCES `_order` (`_order_id`),
  ADD CONSTRAINT `product_order_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
