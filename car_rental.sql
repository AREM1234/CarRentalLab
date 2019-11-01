-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 19, 2019 at 02:03 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `AdminID` int(11) NOT NULL AUTO_INCREMENT,
  `AdminName` varchar(45) NOT NULL,
  `AdminPassword` varchar(255) NOT NULL,
  PRIMARY KEY (`AdminID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`AdminID`, `AdminName`, `AdminPassword`) VALUES
(1, 'Admin', '$2y$10$u4auTjeHu.0wVHI.MuGS3.xdwfe4.37tN3hd7LUTSQwoIe8/IjQ4C');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `CarID` int(11) NOT NULL AUTO_INCREMENT,
  `CarModel` int(11) NOT NULL,
  `CarName` varchar(45) NOT NULL,
  `Seats` varchar(10) NOT NULL,
  `Available` tinyint(1) NOT NULL,
  `ImageName` varchar(255) NOT NULL,
  `TotalMileage` double NOT NULL,
  PRIMARY KEY (`CarID`),
  KEY `Model` (`CarModel`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`CarID`, `CarModel`, `CarName`, `Seats`, `Available`, `ImageName`, `TotalMileage`) VALUES
(1, 1, 'Car1', '2', 1, 'test.jpg', 352),
(2, 3, 'Car2', '4', 1, 'test2.jpg', 404.4),
(3, 2, 'Car3', '4', 1, 'car3.jpg', 50),
(4, 2, 'Car4', '4', 1, 'car4.jpg', 592.2),
(5, 3, 'Car5', '9', 1, 'Car5.jpg', 2000),
(6, 1, 'Car6', '2', 1, 'Car6.jpg\r\n', 5000),
(7, 3, 'Car7', '2', 1, 'car-49278__340.jpg', 10),
(8, 1, 'Yellow Car', '2', 1, 'car42.jpg', 234),
(9, 2, 'White Car', '6', 1, 'whitecar.jpg', 200);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `CustomerID` int(11) NOT NULL AUTO_INCREMENT,
  `FName` varchar(45) NOT NULL,
  `LName` varchar(45) NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  PRIMARY KEY (`CustomerID`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `FName`, `LName`, `PhoneNumber`) VALUES
(12, 'Bob', 'Due', '892-3212'),
(13, 'Bob', 'Due', '892-3212'),
(14, 'Bob', 'Due', '892-3212'),
(15, 'Bob', 'Due', '892-3212'),
(16, 'Elijah', 'Trim', '342-2323'),
(17, 'Bob', 'Due', '342-2323'),
(18, 'Elijah', 'Due', '342-2323'),
(19, 'Bob', 'Trim', '892-3212'),
(20, 'Elijah', 'Due', '342-2323'),
(21, 'Elijah', 'Trim', '892-3212'),
(22, 'Bob', 'Trim', '892-3212'),
(23, 'Elijah', 'Due', '892-3212'),
(24, 'Elijah', 'Due', '892-3212'),
(25, 'Bob', 'Trim', '342-2323'),
(27, 'Bob', 'Due', '892-3212');

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

DROP TABLE IF EXISTS `models`;
CREATE TABLE IF NOT EXISTS `models` (
  `ModelID` int(11) NOT NULL AUTO_INCREMENT,
  `ModelType` varchar(10) NOT NULL,
  `ModelCost` double NOT NULL,
  PRIMARY KEY (`ModelID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`ModelID`, `ModelType`, `ModelCost`) VALUES
(1, 'Compact', 19.95),
(2, 'Standard', 24.95),
(3, 'Luxury', 39);

-- --------------------------------------------------------

--
-- Table structure for table `rentalreturns`
--

DROP TABLE IF EXISTS `rentalreturns`;
CREATE TABLE IF NOT EXISTS `rentalreturns` (
  `ReturnID` int(11) NOT NULL AUTO_INCREMENT,
  `Rental` int(11) NOT NULL,
  `Mileage` int(11) NOT NULL,
  `TotalCost` double NOT NULL,
  PRIMARY KEY (`ReturnID`),
  KEY `Rental` (`Rental`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rentalreturns`
--

INSERT INTO `rentalreturns` (`ReturnID`, `Rental`, `Mileage`, `TotalCost`) VALUES
(1, 8, 10, 102.95),
(2, 9, 200, 123.85),
(3, 10, 200, 183.7),
(4, 11, 100, 281.5),
(5, 12, 100, 605.85),
(6, 13, 100, 71.9),
(7, 14, 98, 91.114),
(8, 16, 0, 39.9),
(9, 17, 999, 397.616),
(10, 18, 52, 56.54),
(11, 19, 139, 144.166),
(12, 20, 34, 409.88),
(13, 15, 30, 59.468),
(14, 22, 648, 606.36);

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

DROP TABLE IF EXISTS `rentals`;
CREATE TABLE IF NOT EXISTS `rentals` (
  `RentalID` int(11) NOT NULL AUTO_INCREMENT,
  `RentalCustomer` int(11) NOT NULL,
  `RentalCar` int(11) NOT NULL,
  `RentalDays` int(11) NOT NULL,
  `InitialCost` double NOT NULL,
  `RentalCode` varchar(255) NOT NULL,
  PRIMARY KEY (`RentalID`),
  KEY `Customer` (`RentalCustomer`),
  KEY `Car` (`RentalCar`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`RentalID`, `RentalCustomer`, `RentalCar`, `RentalDays`, `InitialCost`, `RentalCode`) VALUES
(8, 13, 1, 5, 99.75, '$2y$10$YiO6UiT3NXg9U8bKRTUzLeXpLu1mmzsrAvnbU1f0gnwAx4FPBO3/i'),
(9, 14, 1, 3, 59.85, '$2y$10$w2WnFdDVJK.95LckY1eswOMDlIwJ81ZAlhRBLFkUoEw.FeCCJrZsW'),
(10, 15, 1, 6, 119.7, '$2y$10$ydPZqVHCU14ZS77oHGlx8.lalLbUJg2h.O9kkhILsPCD.glVnGei.'),
(11, 16, 3, 10, 249.5, '$2y$10$BBbsz/jpkrQY6YEDzCBye.fHAIWIN93rsw/DiwiMYdupKDORNNTNS'),
(12, 17, 3, 23, 573.85, '$2y$10$EyVTQ5znk8vUbVsMyTFI8ekdEHeszFDT2bUYl49NfhtzkzL6o8sBm'),
(13, 18, 6, 2, 39.9, '$2y$10$0tD7hHGZXWvCibb0uMKnIODvdVEU0a3MLkALDFyTcDM.nevtUx/BW'),
(14, 19, 1, 3, 59.85, '$2y$10$Nw8so2ExHNezUIvsKXjZjOHf5lpHfELRugRENR8Tc4ADKbrnBZHGC'),
(15, 20, 3, 2, 49.9, '$2y$10$GkWnoGwJC8gjw33ANvlfi.AIx68o/Y7I2F1OpakGBBEhBrNpk5GVq'),
(16, 21, 8, 2, 39.9, '$2y$10$BWPbTgsVi6E3xAAMKDpZIO46K18Ewowod1r.ybhQrwbFMQEVD3WRe'),
(17, 22, 5, 2, 78, '$2y$10$P3bAmg28VUZ/DA/jysy7hemIsar407BogC1FRi7OKxk/6p3Op6S6G'),
(18, 23, 1, 2, 39.9, '$2y$10$o3JNv5yIQMrvLWYgaHp/ueeDEGyoQHtdum1W/T8GHIKOLtFMbb9de'),
(19, 24, 6, 5, 99.75, '$2y$10$e046BVoMQ2vV6g0XfCkbrOEv7BaUdEXAWZ00k0Zh5ukfs4/4YcLVW'),
(20, 25, 8, 2, 399, '$2y$10$ZnZmo1N1vGttfvpXuPN8Ve3Dhzy3GsnIQlbnxr/Fb1L/Z2WFlCuma'),
(22, 27, 6, 2, 399, '$2y$10$5KZB3rEB.C4sWrOoEiB0BeiNlvSdYqsTMoGexXVtP8xdL7RuJyJAK');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`CarModel`) REFERENCES `models` (`ModelID`);

--
-- Constraints for table `rentalreturns`
--
ALTER TABLE `rentalreturns`
  ADD CONSTRAINT `rentalreturns_ibfk_1` FOREIGN KEY (`Rental`) REFERENCES `rentals` (`RentalID`);

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`RentalCar`) REFERENCES `cars` (`CarID`),
  ADD CONSTRAINT `rentals_ibfk_2` FOREIGN KEY (`RentalCustomer`) REFERENCES `customer` (`CustomerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
