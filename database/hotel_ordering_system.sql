-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2026 at 06:06 PM
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
-- Database: `hotel_ordering_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Drinks'),
(2, 'Breakfast'),
(3, 'Lunch'),
(4, 'Dinner'),
(5, 'Desserts');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(50) NOT NULL,
  `location_type` enum('room','pool') NOT NULL,
  `qr_token` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `location_name`, `location_type`, `qr_token`, `created_at`) VALUES
(1, 'Room 101', 'room', 'room101', '2026-06-23 11:44:24'),
(2, 'Room 102', 'room', 'room102', '2026-06-23 11:44:24'),
(3, 'Pool A1', 'pool', 'poola1', '2026-06-23 11:44:24');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `item_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('available','unavailable') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`item_id`, `category_id`, `item_name`, `description`, `price`, `image`, `status`) VALUES
(1, 1, 'Mango Juice', 'Fresh mango juice', 300.00, 'mango_juice.jpg', 'available'),
(2, 1, 'Passion Juice', 'Fresh passion juice', 300.00, 'passion_juice.jpg', 'available'),
(3, 3, 'Chicken Burger', 'Burger with fries', 850.00, 'burger.jpg', 'available'),
(4, 1, 'Apple Juice', 'Sweet', 200.00, 'apple_juice.jpg', 'available'),
(5, 5, 'Chicken Burger', 'Delicious', 650.00, 'burger.jpg', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `guest_name` varchar(100) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT 0.00,
  `status` enum('pending','accepted','preparing','ready','delivered') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `location_id`, `guest_name`, `total_amount`, `status`, `created_at`) VALUES
(1, 1, NULL, 2600.00, 'delivered', '2026-06-23 12:08:46'),
(2, 1, NULL, 300.00, 'delivered', '2026-06-23 17:20:57'),
(3, 1, NULL, 300.00, 'delivered', '2026-06-23 17:30:57'),
(4, 1, NULL, 300.00, 'delivered', '2026-06-26 14:00:16'),
(5, 1, NULL, 650.00, 'delivered', '2026-07-02 12:22:59'),
(6, 1, NULL, 300.00, 'delivered', '2026-07-02 13:46:14'),
(7, 1, NULL, 600.00, 'delivered', '2026-07-02 13:47:13'),
(8, 1, NULL, 200.00, 'delivered', '2026-07-06 12:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `item_id`, `quantity`, `price`) VALUES
(1, 1, 1, 2, 300.00),
(2, 1, 2, 1, 300.00),
(3, 1, 3, 2, 850.00),
(4, 2, 1, 1, 300.00),
(5, 3, 1, 1, 300.00),
(6, 4, 1, 1, 300.00),
(7, 5, 5, 1, 650.00),
(8, 6, 1, 1, 300.00),
(9, 7, 2, 1, 300.00),
(10, 7, 1, 1, 300.00),
(11, 8, 4, 1, 200.00);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','chef','waiter') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `fullname`, `username`, `password`, `role`) VALUES
(1, 'Kitchen Chef', 'chef', '$2y$10$WZMaJYguSmW6v8HESLfcIOXetwHViMGiQ8W9EIqDePJ..buiVMF8i', 'chef'),
(2, 'Pool Waiter', 'waiter', '$2y$10$PeQg0IJ2HrayGhFgeciYO.6G182pp9zbDgV1cB8TJhFzF/JhCrmhG', 'waiter'),
(3, 'System Administrator', 'admin', '$2y$10$sHTAM/bV7158B4GnoxwbSuf5Mqw.Azrnw1Somqy4I6aNLCGpWWkp6', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`),
  ADD UNIQUE KEY `qr_token` (`qr_token`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `menu_items` (`item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
