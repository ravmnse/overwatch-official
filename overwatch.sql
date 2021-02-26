-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Feb 26, 2021 at 03:28 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `overwatch`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `USER_ID` int(11) NOT NULL,
  `ROLE_ID` int(2) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PSWORD` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`USER_ID`, `ROLE_ID`, `USERNAME`, `PSWORD`) VALUES
(1, 2, 'Juan', '123'),
(2, 1, 'Michael', 'admin');

--
-- Triggers `accounts`
--
DELIMITER $$
CREATE TRIGGER `NEWACCOUNT` AFTER INSERT ON `accounts` FOR EACH ROW INSERT INTO account_audit (USERNAME,ACTION_ID,AUD_DATE)
VALUES (NEW.USERNAME,1,CURRENT_TIMESTAMP)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `account_audit`
--

CREATE TABLE `account_audit` (
  `USERNAME` varchar(50) NOT NULL,
  `ACTION_ID` int(3) NOT NULL,
  `AUD_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_audit`
--

INSERT INTO `account_audit` (`USERNAME`, `ACTION_ID`, `AUD_DATE`) VALUES
('Juan', 1, '2021-02-17 13:23:24'),
('Michael', 1, '2021-02-22 03:49:45');

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE `audit_trail` (
  `ACTION_ID` int(3) NOT NULL,
  `ACTION_NAME` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audit_trail`
--

INSERT INTO `audit_trail` (`ACTION_ID`, `ACTION_NAME`) VALUES
(1, 'CREATED A NEW ACCOUNT'),
(2, 'LOGGED IN'),
(3, 'LOGGED OUT'),
(4, 'ADDED ITEM TO CART'),
(5, 'REMOVED AN ITEM FROM CART'),
(6, 'PLACED AN ORDER'),
(7, 'UPDATED ACCOUNT DETAILS'),
(8, 'CREATED NEW ADMIN ACCOUNT'),
(9, 'COMPLETED AN ORDER'),
(10, 'ADDED NEW ITEM'),
(11, 'UPDATED ITEM DETAILS'),
(12, 'DELETED AN ITEM'),
(13, 'DELETED AN ACCOUNT');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `USERNAME` varchar(50) NOT NULL,
  `ITEM_ID` int(3) NOT NULL,
  `QUANTITY` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `cart`
--
DELIMITER $$
CREATE TRIGGER `ADDCART` AFTER INSERT ON `cart` FOR EACH ROW INSERT INTO account_audit (USERNAME,ACTION_ID,AUD_DATE)
VALUES (NEW.USERNAME,4,CURRENT_TIMESTAMP)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `ITEM_ID` int(3) NOT NULL,
  `ITEM_NAME` varchar(30) NOT NULL,
  `ITEM_DESC` varchar(150) NOT NULL,
  `ITEM_IMG_NAME` varchar(50) NOT NULL,
  `PRICE` decimal(7,2) NOT NULL,
  `STOCK` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ITEM_ID`, `ITEM_NAME`, `ITEM_DESC`, `ITEM_IMG_NAME`, `PRICE`, `STOCK`) VALUES
(1, 'Motion Detector', 'Top of the line motion sensors that can detect up to 800 meters distance.', 'motionsensor.jpeg', '4500.00', 300),
(2, 'Biometric Lock', 'High accuracy biometric scanners with fail-safe & tamper resistant feature.', 'biolock.jpg', '13000.00', 300),
(3, 'RFID Lock', 'Unlock your door using your prefered top of the line RFID security card.', 'rfid.jpeg', '9300.00', 300),
(4, 'Smart CCTV Camera', 'Top of the line HD Smart CCTV Cameras that runs through a secured wireless network.', 'cctv.jpeg', '6700.00', 300),
(5, 'AI Identification Camera', 'High accuracy Artificial Intelligence Cameras that detects human.', 'AIcamera.jpg', '8800.00', 300),
(6, 'Smart Siren', 'An advance smart security siren that will help you prevent intruders in your home', 'smart-siren.jpg', '3500.00', 300);

-- --------------------------------------------------------

--
-- Table structure for table `item_orders`
--

CREATE TABLE `item_orders` (
  `ORDER_ID` int(11) NOT NULL,
  `ITEM_ID` int(3) NOT NULL,
  `QUANTITY` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ORDER_ID` int(11) NOT NULL,
  `ORDER_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ORDER_STATUS` varchar(15) NOT NULL,
  `USERNAME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `ROLE_ID` int(2) NOT NULL,
  `ROLE_NAME` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`ROLE_ID`, `ROLE_NAME`) VALUES
(1, 'Admin'),
(2, 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `USER_ID` int(11) NOT NULL,
  `USER_LNAME` varchar(30) NOT NULL,
  `USER_FNAME` varchar(60) NOT NULL,
  `USER_MNAME` varchar(30) NOT NULL,
  `USER_ADDRESS` varchar(150) NOT NULL,
  `USER_EMAIL` varchar(100) NOT NULL,
  `USER_CONTACTNO` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USER_ID`, `USER_LNAME`, `USER_FNAME`, `USER_MNAME`, `USER_ADDRESS`, `USER_EMAIL`, `USER_CONTACTNO`) VALUES
(1, 'Dela Cruz', 'Juan', 'Reyes', '01 Sampaguita St. Comembo Makati City', 'juan@gmail.com', '09181234567'),
(2, 'Marzan', 'Michael', '', 'Taguig City', 'michael@yahoo.com', '09271236548');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`USERNAME`),
  ADD UNIQUE KEY `USER_ID` (`USER_ID`),
  ADD KEY `ROLE_ID` (`ROLE_ID`);

--
-- Indexes for table `account_audit`
--
ALTER TABLE `account_audit`
  ADD PRIMARY KEY (`USERNAME`,`ACTION_ID`,`AUD_DATE`),
  ADD KEY `ACTION_ID` (`ACTION_ID`);

--
-- Indexes for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD PRIMARY KEY (`ACTION_ID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`USERNAME`,`ITEM_ID`),
  ADD KEY `ITEM_ID` (`ITEM_ID`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`ITEM_ID`);

--
-- Indexes for table `item_orders`
--
ALTER TABLE `item_orders`
  ADD PRIMARY KEY (`ORDER_ID`,`ITEM_ID`),
  ADD KEY `ITEM_ID` (`ITEM_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ORDER_ID`),
  ADD KEY `USERNAME` (`USERNAME`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ROLE_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ORDER_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`ROLE_ID`) REFERENCES `roles` (`ROLE_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `accounts_ibfk_2` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`USER_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `account_audit`
--
ALTER TABLE `account_audit`
  ADD CONSTRAINT `account_audit_ibfk_1` FOREIGN KEY (`ACTION_ID`) REFERENCES `audit_trail` (`ACTION_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `account_audit_ibfk_2` FOREIGN KEY (`USERNAME`) REFERENCES `accounts` (`USERNAME`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`USERNAME`) REFERENCES `accounts` (`USERNAME`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`ITEM_ID`) REFERENCES `item` (`ITEM_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_orders`
--
ALTER TABLE `item_orders`
  ADD CONSTRAINT `item_orders_ibfk_1` FOREIGN KEY (`ORDER_ID`) REFERENCES `orders` (`ORDER_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_orders_ibfk_2` FOREIGN KEY (`ITEM_ID`) REFERENCES `item` (`ITEM_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`USERNAME`) REFERENCES `accounts` (`USERNAME`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
