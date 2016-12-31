-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 31, 2016 at 10:48 PM
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
  `description` varchar(1000) DEFAULT NULL,
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

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `additional_features`, `os`, `ui`, `availability`, `battery_standbytime`, `battery_talktime`, `battery_type`, `camera_flash`, `camera_video`, `camera_primary`, `connectivity_bluetooth`, `connectivity_cell`, `connectivity_gps`, `connectivity_infrared`, `connectivity_wifi`, `description`, `display_resolution`, `display_size`, `display_touchscreen`, `hardware_accelerometer`, `hardware_audiojack`, `hardware_cpu`, `hardware_fmradio`, `hardware_physicalkeyboard`, `hardware_usb`, `image_0`, `image_1`, `image_2`, `image_3`, `image_4`, `name`, `price`, `dimensions_w`, `dimensions_h`, `dimensions_l`, `weight_grams`, `storage_flash`, `storage_ram`, `added`, `last_modified`) VALUES
(45, 'Front-facing 1.3MP camera', 'Android 2.2', 'Dell Stage', 'T-Mobile', '375 hours', '6 hours', 'Lithium Ion (Li-Ion) (2780 mAH)', 1, 1, '5.0 megapixels', 'Bluetooth 2.1', 'T-mobile HSPA+ @ 2100/1900/AWS/850 MHz', '1', '0', '802.11 b/g', 'Introducing Dell Streak 7. Share photos, videos and movies together. It''s small enough to carry around, big enough to gather around. Android 2.2-based tablet with over-the-air upgrade capability for future OS releases. A vibrant 7-inch, multitouch monstrosity, it''s actually demoralising just how badly designed this piece of crap is. You couldn''t trade it for a packet of cigarettes. It''s the kind of phone a heroin addict carries.', 'WVGA (800 x 480)', '7.0 inches', 1, 1, '3.5mm', 'nVidia Tegra T20', 0, 0, 'USB 2.0', 'img/phones/dell-streak-7.0.jpg', 'img/phones/dell-streak-7.1.jpg', 'img/phones/dell-streak-7.2.jpg', 'img/phones/dell-streak-7.3.jpg', 'img/phones/dell-streak-7.4.jpg', 'Dell Streak 7', '129.99', 199.9, 119.8, 12.4, 450, '16000MB', '512MB', '2016-12-31 13:08:22', '0000-00-00 00:00:00'),
(46, 'Gorilla Glass display, Dedicated Camera Key, Ring Silence Switch, Swype keyboard.', 'Android 2.2', 'Dell Stage', 'AT&T, KT, T-Mobile', '400 hours', '7 hours', 'Lithium Ion (Li-Ion) (1400 mAH)', 1, 1, '8.0 megapixels', 'Bluetooth 2.1', '850/1900/2100 3G; 850/900/1800/1900 GSM/GPRS/EDGE900/1700/2100 3G; 850/900/1800/1900 GSM/GPRS/EDGE', '1', '0', '802.11 b/g', 'The Venue is the perfect one-touch, Smart Phone providing instant access to everything you love. All of Venue''s features make it perfect for on-the-go students, mobile professionals, dull-witted hipsters, and active social communicators who love style, posturing, and grindingly slow performance, not to mention poor battery life and an incomprehensible warranty. In the words of Kojak, ''Who loves ya baby!''', 'WVGA (800 x 480)', '4.1 inches', 1, 1, '3.5mm', '1 Ghz processor', 0, 0, 'USB 2.0', 'img/phones/dell-venue.0.jpg', 'img/phones/dell-venue.1.jpg', 'img/phones/dell-venue.2.jpg', 'img/phones/dell-venue.3.jpg', 'img/phones/dell-venue.4.jpg', 'Dell Venue', '192.74', 64, 121, 12.9, 164, '1000MB', '512MB', '2016-12-31 13:08:22', '0000-00-00 00:00:00'),
(47, 'Adobe Flash Player 10, Quadband GSM Worldphone, Advance Business Security, Complex Password Secure, \n	Review & Edit Documents with Quick Office, Personal 3G Mobile Hotspot for up to 5 WiFi enabled Devices, \n	Advanced Social Networking brings all soci', 'Android 2.2', '', 'Verizon', '230 hours', '8 hours', 'Lithium Ion (Li-Ion) (1400 mAH)', 1, 1, '5.0 megapixels', 'Bluetooth 2.1', 'WCDMA 850/1900/2100, CDMA 800/1900, GSM 850/900/1800/1900, HSDPA 10.2 Mbps \n        (Category 9/10), CDMA EV-DO Release A, EDGE Class 12, GPRS Class 12, HSUPA 1.8 Mbps', '1', '0', '802.11 b/g/n', 'With Quad Band GSM, the DROID 2 Global can send email and make and receive calls from more than 200 countries. It features an improved QWERTY keyboard, super-fast 1.2 GHz processor and enhanced security for all your business needs. But, because you''ve bought it for inscrutable hipster reasons, with no regard for the specs, it will grossly disappoint you, your friends and your loved ones, idlers at the dole office, and other strangers.', 'FWVGA (854 x 480)', '3.7 inches', 1, 1, '3.5mm', '1.2 GHz TI OMAP', 0, 1, 'USB 2.0', 'img/phones/droid-2-global-by-motorola.0.jpg', 'img/phones/droid-2-global-by-motorola.1.jpg', 'img/phones/droid-2-global-by-motorola.2.jpg', 'img/phones/droid-2-global-by-motorola.0.jpg', '', 'DROID 2 Global', '159.75', 60.5, 116.3, 13.7, 169, '8192MB', '512MB', '2016-12-31 13:08:22', '0000-00-00 00:00:00'),
(48, 'Multiple messaging options, including text with threaded messaging for organized, \n  easy-to-follow text; Social Community support, including Facebook and MySpace; \n  Next generation Address book; Visual Voice Mail, 3.0 megapixel camera, and more', 'Android 2.2', 'MOTOBLUR', 'AT&T', '400 hours', '5 hours', 'Lithium Ion (Li-Ion) (1930 mAH)', 1, 1, '3.0 megapixels', 'Bluetooth 2.1', 'WCDMA 850/1900/2100, GSM 850/900/1800/1900, HSDPA 14Mbps (Category 10) Edge Class 12, \n   GPRS Class 12, eCompass, AGPS', '1', '0', '802.11 a/b/g/n', 'Motorola Atrix 4G gives you dual-core processing power and the revolutionary webtop application. With webtop and a compatible Motorola docking station, sold separately, you can surf the Internet with a full Firefox browser, create and edit messages, emails, dumb-ass selfies, notes about nothing, to no-one, for no reason! Just buy it, ok!', 'QHD (960 x 540)', '4.0 inches', 1, 1, '3.5mm', '1 GHz Dual Core', 0, 1, 'USB 2.0', 'img/phones/motorola-atrix-4g.0.jpg', 'img/phones/motorola-atrix-4g.1.jpg', 'img/phones/motorola-atrix-4g.2.jpg', 'img/phones/motorola-atrix-4g.3.jpg', '', 'Motorola Atrix 4G', '272.77', 63.5, 117.75, 10.95, 135, '8192MB', '1024MB', '2016-12-31 13:08:22', '0000-00-00 00:00:00'),
(49, '3.2 Full touch screen with Advanced anti smudge, anti \n  reflective and anti scratch glass; Swype text input for easy and fast message creation; \n  multiple messaging options, including text with threaded messaging for organized, \n  easy-to-follow te', 'Android 2.1', 'TouchWiz', 'Cellular South', '800 hours', '7 hours', 'Nickel Cadmium (NiCd) (1500 mAH)', 1, 1, '3.0 megapixels', 'Bluetooth 3.0', '3G/CDMA : 850MHz/1900MHz', '1', '0', '802.11 b/g', 'The Samsung Gem maps a route to a smarter mobile experience. By pairing one of the fastest processors in the category with the Android platform, the Gem delivers maximum multitasking speed and social networking capabilities to let you explore the dreadful existential nightmare that is your abysmal life!', 'WQVGA (400 x 240)', '3.2 inches', 1, 1, '3.5mm', '800 MHz', 0, 1, 'USB 2.0', 'img/phones/samsung-gem.0.jpg', 'img/phones/samsung-gem.1.jpg', 'img/phones/samsung-gem-2.jpg', 'img/phones/samsung-gem-2.jpg', '', 'Samsung Gem', '169.80', 55.5, 113, 12.4, 110, '1024MB', '1024MB', '2016-12-31 13:08:22', '0000-00-00 00:00:00'),
(50, 'Contour Display, Near Field Communications (NFC), \n  Three-axis gyroscope, Anti-fingerprint display coating, Internet Calling support \n  (VoIP/SIP)', 'Android 2.3', 'Android', 'O2, Orange, Vodafone', '428 hours', '6 hours', 'Lithium Ion (Li-Ion) (1500 mAH)', 1, 1, '5.0 megapixels', 'Bluetooth 2.1', '3GQuad-band GSM: 850, 900, 1800, 1900 Tri-band HSPA: 900, 2100, \n        1700 HSPA type: HSDPA (7.2Mbps) HSUPA (5.76Mbps)', '1', '0', '802.11 b/g/n', 'Nexus S is the next generation of Nexus devices, co-developed by Google and Samsung. The latest Android platform (Gingerbread), paired with a 1 GHz Hummingbird processor and 16GB of memory, makes Nexus S one of the fastest phones on the hipster market, making it slower than the average consumer grade handset. What''s wrong with you?', 'WVGA (800 x 480)', '4.0 inches', 1, 1, '3.5mm', '1GHz Cortex A8 (Hummingbird) processor', 0, 0, 'USB 2.0', 'img/phones/nexus-s.0.jpg', 'img/phones/nexus-s.1.jpg', 'img/phones/nexus-s.2.jpg', 'img/phones/nexus-s.3.jpg', '', 'Nexus S', '372.79', 63, 123.9, 10.88, 129, '16384MB', '1024MB', '2016-12-31 13:08:22', '0000-00-00 00:00:00');

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
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user_contact`
--
ALTER TABLE `user_contact`
  MODIFY `user_contact_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `_order`
--
ALTER TABLE `_order`
  MODIFY `_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `_order_product`
--
ALTER TABLE `_order_product`
  MODIFY `_order_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;
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
