-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2021 at 08:42 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `attributeId` int(11) NOT NULL,
  `attributeName` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`attributeId`, `attributeName`, `status`) VALUES
(1, 'Color', 'Active'),
(3, 'Display', 'Inactive'),
(11, 'TestForRecycleBin', 'Inactive'),
(12, 'Storage', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `attributes_value`
--

CREATE TABLE `attributes_value` (
  `attvalueId` int(11) NOT NULL,
  `attvalueName` varchar(100) DEFAULT NULL,
  `parentId` int(10) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attributes_value`
--

INSERT INTO `attributes_value` (`attvalueId`, `attvalueName`, `parentId`, `status`) VALUES
(1, 'Black', 1, 'Active'),
(2, '5.8 inches', 3, 'Active'),
(5, 'Red', 1, 'Active'),
(6, '6.1 inches', 3, 'Active'),
(7, 'White', 1, 'Active'),
(11, 'Blue', 1, 'Inactive'),
(21, 'Graphite', 1, 'Active'),
(22, '6.7 inches', 3, 'Active'),
(23, '64GB', 12, 'Active'),
(24, '128GB', 12, 'Active'),
(25, '256GB', 12, 'Active'),
(26, '512GB', 12, 'Active'),
(27, '1TB', 12, 'Active'),
(28, 'Space Grey', 1, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `backup`
--

CREATE TABLE `backup` (
  `backupId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dateTime` varchar(255) NOT NULL,
  `users` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `backup`
--

INSERT INTO `backup` (`backupId`, `name`, `dateTime`, `users`) VALUES
(82, 'Backup_01-11-2021_(17-22-09).sql', '01 Nov 2021 17:22:09', '6');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brandId` int(11) NOT NULL,
  `brandName` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brandId`, `brandName`, `status`) VALUES
(1, 'Apple', 'Active'),
(3, 'Vivo', 'Active'),
(4, 'Huawei', 'Active'),
(10, 'Asus', 'Active'),
(11, 'Klipsch', 'Active'),
(12, 'hgf', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(100) DEFAULT NULL,
  `categoryStatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `categoryName`, `categoryStatus`) VALUES
(1, 'Tablet', 'Active'),
(2, 'ACC', 'Active'),
(4, 'Mobile', 'Active'),
(14, 'Second-hand', 'Inactive'),
(15, 'Laptop', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `companyId` int(11) NOT NULL,
  `companyName` varchar(100) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `postcode` varchar(20) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`companyId`, `companyName`, `address1`, `address2`, `postcode`, `city`, `state`, `country`, `contact`, `email`) VALUES
(1, 'Mobile Shop', '3, Jalan Perai 5', 'Bandar Perai Jaya', '13700', 'Perai', 'Penang', 'Malaysia', '0169696969', 'mobilestore@demo.com');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerId` int(11) NOT NULL,
  `customerName` varchar(100) DEFAULT NULL,
  `customerEmail` varchar(100) DEFAULT NULL,
  `customerContact` varchar(20) DEFAULT NULL,
  `customerGender` varchar(10) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `AddedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerId`, `customerName`, `customerEmail`, `customerContact`, `customerGender`, `status`, `AddedBy`) VALUES
(1, 'cust1', 'cust@cust.com', '0123456788', 'Female', 'Active', 6),
(5, 'cust3', 'cust3@cust.com', '0123547988', 'Female', 'Active', 10),
(6, 'cust2', 'cust20@cust.com', '9123829002', 'Male', 'Active', 6),
(7, 'cust4', 'cust4@cust.com', '0128971123', 'Male', 'Active', 7),
(8, 'cust5', 'cust5@cust.com', '0129990000', 'Female', 'Inactive', 6),
(18, 'cust10', 'cust10@cust.com', '01290878900', 'Male', 'Active', 6),
(20, 'cust12', 'cust12@cust.com', '0126789902', 'Female', 'Active', 16),
(28, 'cust13', 'cust13@cust.com', '0123445571', 'Male', 'Active', 6),
(29, 'cust14', 'cust14@cust.com', '0123445521', 'Male', 'Active', 6),
(30, 'cust16', 'cust16@cust16.com', '0199382346', 'Male', 'Active', 6),
(31, 'cust15', 'cust15@cust15.com', '0152242223', 'Female', 'Active', 6),
(32, 'cust17', 'cust17@cust.com', '0192890097', 'Male', 'Active', 32),
(33, 'cust18', 'cust18@cust.com', '0124453321', 'Male', 'Inactive', 6),
(34, 'cust19', 'cust19@cust.com', '0124562271', 'Female', 'Inactive', 6);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `Id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `date` varchar(100) NOT NULL,
  `userId` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`Id`, `title`, `description`, `date`, `userId`) VALUES
(27, 'Note1', 'Note1 Description', 'Fri, 15 Oct 2021, 19:18:49', '6'),
(28, 'Note2', 'Note2 Description', 'Fri, 15 Oct 2021, 19:19:03', '6'),
(29, 'Note3', 'Note3 Description\r\n', 'Fri, 15 Oct 2021, 19:19:38', '6'),
(30, 'Note4', 'Note4 Description', 'Fri, 15 Oct 2021, 19:19:49', '6'),
(31, 'Note5', 'Note5 Description5\r\n', 'Fri, 15 Oct 2021, 19:20:10', '6'),
(39, 'Note6', 'Description Note6', 'Tue, 02 Nov 2021, 09:38:51', '6'),
(40, 'Note7', 'Description Note7', 'Tue, 02 Nov 2021, 09:38:57', '6');

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE `orderitem` (
  `Id` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `unitAmount` varchar(50) NOT NULL,
  `sumAmount` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`Id`, `orderId`, `productId`, `quantity`, `unitAmount`, `sumAmount`) VALUES
(4, 7, 3, '2', '4599', '9198.00'),
(5, 7, 10, '2', '89', '178.00'),
(6, 8, 4, '1', '1099', '1099.00'),
(7, 8, 10, '2', '89', '178.00'),
(8, 9, 19, '2', '1299', '2598.00'),
(13, 10, 10, '2', '89', '178.00'),
(14, 10, 19, '1', '1299', '1299.00'),
(15, 11, 3, '1', '4599', '4599.00'),
(16, 11, 10, '1', '89', '89.00'),
(17, 11, 16, '1', '2499', '2499.00'),
(18, 11, 19, '1', '1299', '1299.00'),
(19, 12, 10, '2', '89', '178.00'),
(20, 13, 18, '1', '3299', '3299.00'),
(22, 19, 10, '3', '89', '267.00'),
(23, 20, 4, '1', '1099', '1099.00'),
(24, 21, 19, '6', '1299', '7794.00'),
(25, 22, 28, '1', '6599', '6599.00'),
(28, 24, 28, '1', '6599', '6599.00'),
(29, 24, 4, '2', '1099', '2198.00'),
(30, 27, 3, '1', '4599', '4599.00'),
(31, 27, 10, '1', '89', '89.00'),
(32, 27, 4, '1', '1099', '1099.00'),
(34, 29, 19, '1', '1299', '1299.00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `invoiceNo` varchar(100) NOT NULL,
  `orderCustName` varchar(255) NOT NULL,
  `orderCustContact` varchar(255) NOT NULL,
  `orderCustEmail` varchar(255) NOT NULL,
  `sales` varchar(50) NOT NULL,
  `discount` varchar(50) NOT NULL,
  `subtotal` varchar(100) NOT NULL,
  `subcost` varchar(100) NOT NULL,
  `method` varchar(100) NOT NULL,
  `orderStatus` varchar(50) NOT NULL,
  `orderDateTime` varchar(50) NOT NULL,
  `orderMonth` varchar(100) NOT NULL,
  `orderYear` varchar(100) NOT NULL,
  `orderDate` varchar(100) NOT NULL,
  `orderTime` varchar(100) NOT NULL,
  `profit` varchar(20) NOT NULL,
  `salesperson` varchar(10) NOT NULL,
  `orderNote` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `invoiceNo`, `orderCustName`, `orderCustContact`, `orderCustEmail`, `sales`, `discount`, `subtotal`, `subcost`, `method`, `orderStatus`, `orderDateTime`, `orderMonth`, `orderYear`, `orderDate`, `orderTime`, `profit`, `salesperson`, `orderNote`) VALUES
(7, 'PO-P270707', 'cust1', '0123456788', 'cust@cust.com', '9376.00', '0', '9376.00', '8736.00', 'Cash', 'Cancelled', '12 Oct 2021 12:26:52', 'Oct', '2021', '12 Oct 2021', '12:26:52', '640.00', '6', 'bbbbb'),
(8, 'PO-8853059', 'cust3', '0123547988', 'cust3@cust.com', '1267.00', '10', '1277.00', '1137.00', 'Card', 'Completed', '12 Oct 2021 12:55:36', 'Oct', '2021', '12 Oct 2021', '12:55:36', '130.00', '6', 'Paid'),
(9, 'PO-7097914', 'cust12', '0126789902', 'cust12@cust.com', '2598.00', '0', '2598.00', '1998.00', 'Transfer', 'Completed', '12 Oct 2021 13:46:09', 'Oct', '2021', '12 Oct 2021', '13:46:09', '600.00', '6', 'Take it on 5pm 12/10/2021'),
(10, 'PO-9271112', 'cust10', '01290878900', 'cust10@cust.com', '1477.00', '0', '1477.00', '1137.00', 'Card', 'Completed', '12 Oct 2021 21:43:23', 'Oct', '2021', '12 Oct 2021', '21:43:23', '340.00', '6', 'hththt'),
(11, 'PO-2570315', 'cust1', '0123456788', 'cust@cust.com', '8486.00', '0', '8486.00', '7666.00', 'Cash', 'Completed', '12 Oct 2021 21:48:33', 'Oct', '2021', '12 Oct 2021', '21:48:33', '820.00', '6', 'SomeNoteHere'),
(12, 'PO-1673859', 'cust13', '0123445571', 'cust13@cust.com', '178.00', '0', '178.00', '138.00', 'Cash', 'Completed', '12 Oct 2021 21:50:07', 'Oct', '2021', '12 Oct 2021', '21:50:07', '40.00', '7', 'noNote'),
(13, 'PO-5339841', 'cust16', '0199382346', 'cust16@cust16.com', '3299.00', '0', '3299.00', '2999.00', 'Cash', 'Pending', '13 Oct 2021 12:33:47', 'Oct', '2021', '13 Oct 2021', '12:33:47', '300.00', '6', 'frrfv'),
(19, 'PO-9835809', 'cust15', '0152242223', 'cust15@cust15.com', '267.00', '0', '267.00', '207.00', 'Cash', 'Completed', '13 Oct 2021 23:39:38', 'Oct', '2021', '13 Oct 2021', '23:39:38', '60.00', '10', 'NoteHere'),
(20, 'PO-9670554', 'cust3', '0123547988', 'cust3@cust.com', '1099.00', '0', '1099.00', '999.00', 'Cash', 'Pending', '14 Oct 2021 11:14:53', 'Oct', '2021', '14 Oct 2021', '11:14:53', '100.00', '6', 'cdc'),
(21, 'PO-1310561', 'cust12', '0126789902', 'cust12@cust.com', '7794.00', '0', '7794.00', '5994.00', 'Cash', 'Completed', '14 Oct 2021 16:57:45', 'Oct', '2021', '14 Oct 2021', '16:57:45', '1800.00', '7', 'ecd'),
(22, 'PO-4936286', 'cust12', '0126789902', 'cust12@cust.com', '6599.00', '0', '6599.00', '6299.00', 'Cash', 'Completed', '14 Oct 2021 17:02:33', 'Oct', '2021', '14 Oct 2021', '17:02:33', '300.00', '16', 'Blabla'),
(24, 'PO-1571943', 'cust15', '0152242223', 'cust15@cust15.com', '8797.00', '0', '8797.00', '8297.00', 'Cash', 'Completed', '14 Oct 2021 21:43:38', 'Oct', '2021', '14 Oct 2021', '21:43:38', '500.00', '10', 'BlahBlahBlah'),
(27, 'PO-4849174', 'cust17', '0192890097', 'cust17@cust.com', '5787.00', '0', '5787.00', '5367.00', 'Cash', 'Completed', '18 Oct 2021 23:44:31', 'Oct', '2021', '18 Oct 2021', '23:44:31', '420.00', '6', 'qqqq'),
(29, 'PO-7155862', 'cust12', '0126789902', 'cust12@cust.com', '1299.00', '0', '1299.00', '999.00', 'Cash', 'Completed', '05 Nov 2021 15:52:39', 'Nov', '2021', '05 Nov 2021', '15:52:39', '300.00', '6', 'fbfbf');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `Id` int(11) NOT NULL,
  `email` text NOT NULL,
  `selector` text NOT NULL,
  `token` longtext NOT NULL,
  `expires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`Id`, `email`, `selector`, `token`, `expires`) VALUES
(111, 'junxian010729@gmail.com', 'ee7798d37ea612bc', '$2y$10$tRXj69DcaBwhk/kPSKIF9eP4z/Z/mfpcuKVy7cveWSN6Jv0zDdpOq', '1636099780');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productId` int(11) NOT NULL,
  `productSKU` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `productName` text CHARACTER SET utf8 DEFAULT NULL,
  `productImage` text CHARACTER SET utf8 DEFAULT NULL,
  `productQuantity` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `productPrice` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `productCost` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `productDescription` longtext CHARACTER SET utf8 DEFAULT NULL,
  `brandId` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `categoryId` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `attvalueId` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `supplierId` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `availability` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `addDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productId`, `productSKU`, `productName`, `productImage`, `productQuantity`, `productPrice`, `productCost`, `productDescription`, `brandId`, `categoryId`, `attvalueId`, `supplierId`, `availability`, `status`, `addDate`) VALUES
(2, 'TESTSKU', 'TestProductName', 'am.jpg', '0', '99', '50', 'This is Testing Product Description.', '1', '[\"2\",\"4\"]', '[\"1\",\"7\",\"23\"]', '[\"1\",\"7\"]', 'Unavailable', 'Active', '2021-09-06 11:34:04'),
(3, 'IPHN12P', 'Apple IPhone 12 Pro', 'p1.jpg', '1', '4599', '4299', 'Color : Black , 512GB. Warranty 1 year at Apple Service Center.', '1', '[\"2\"]', '[\"1\"]', '[\"1\"]', 'Available', 'Active', '2021-09-06 11:58:03'),
(4, 'APPRO', 'Apple AirPods Pro', 'p3.jpg', '3', '1099', '999', 'Color : White, Noise Cancellation. Warranty 6 months in Apple Service Center.', '1', '[\"4\"]', '[\"7\"]', '[]', 'Available', 'Active', '2021-09-06 12:20:04'),
(6, 'IPHN12', 'Apple IPhone 12', 'p2.jpg', '1', '3599', '3399', 'Color : Red, 256GB. Warranty 1 year in Apple Service Center.', '1', '[\"2\"]', '[\"5\",\"25\"]', '[\"7\"]', 'Available', 'Active', '2021-09-06 13:44:50'),
(10, 'IPHCABLE', 'Apple IPhone Lightning Cable', 'p5.jpg', '9', '89', '69', 'Apple Original Charging Cable. Warranty 3 months.', '1', '[\"4\"]', '[\"7\"]', '[\"7\"]', 'Available', 'Active', '2021-09-06 18:34:01'),
(16, 'ASROG', 'Asus ROG', 'asusrog.jpg', '4', '2499', '2299', 'Processor: speed-binned 2.96GHz Qualcomm Snapdragon 845.&nbsp;RAM &amp; Storage: 512GB / 1TB, 12 GB RAM', '10', '[\"4\"]', '[\"1\",\"7\"]', '[\"12\"]', 'Unavailable', 'Active', '2021-09-21 03:50:25'),
(17, 'HWMATE', 'Huawei Mate 30 Pro', 'huaweimate30pro.png', '5', '2999', '2799', '8GB RAM 128GB Storage.', '4', '[\"4\"]', '[\"5\",\"24\"]', '[\"7\"]', 'Available', 'Inactive', '2021-09-21 03:52:04'),
(18, 'VVNEX', 'Vivo Nex 3', 'vivonex3.png', '0', '3299', '2999', '8GB RAM 128GB Storage.', '3', '[\"4\"]', '[\"1\"]', '[\"16\"]', 'Available', 'Active', '2021-09-21 03:53:12'),
(19, 'KPSMC', 'Klipsch T5 II True Wireless Sport McLaren Edition Earphones', 'klipsch.jpg', '4', '1299', '999', 'It designed for the harshest, loudest conditions on the planet. Engineered for extreme performance and reliability. Forged with premium materials and advanced technology. Created in concert with McLaren for the ultimate in fidelity, fit and finish. #SPEEDOFSOUND', '11', '[\"2\"]', '[\"1\"]', '[\"1\"]', 'Available', 'Active', '2021-09-27 13:52:28'),
(20, 'IPH13PM', 'IPhone 13 Pro Max', 'iphone-13-pro-max-graphite.png', '0', '7599', '7299', '', '1', '[\"4\"]', '[\"21\"]', '[\"16\"]', 'Available', 'Active', '2021-09-28 14:43:40'),
(28, 'APPMACBPRO', 'Apple Macbook Pro 13 inches 2020', 'macbookpro1.jpg', '3', '6599', '6299', 'Apple Macbook Pro 2020 256GB.', '1', '[\"15\"]', '[\"28\",\"25\"]', '[\"16\"]', 'Available', 'Active', '2021-10-12 14:28:09');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplierId` int(11) NOT NULL,
  `supplierName` varchar(100) DEFAULT NULL,
  `supplierEmail` varchar(100) DEFAULT NULL,
  `supplierContact` varchar(20) DEFAULT NULL,
  `supplierStatus` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplierId`, `supplierName`, `supplierEmail`, `supplierContact`, `supplierStatus`) VALUES
(1, 'Supplier1', 'supplier1@demo.com', '01987765633', 'Active'),
(7, 'Supplier2', 'supplier2@demo.com', '0198787666', 'Active'),
(12, 'Supplier4', 'supplier4@demo.com', '0165526652', 'Active'),
(16, 'Supplier5', 'supplier5@demo.com', '0123212232', 'Active'),
(18, 'Supplier3', 'supplier3@supplier.com', '0123451132', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(100) DEFAULT NULL,
  `userEmail` varchar(100) DEFAULT NULL,
  `userContact` varchar(20) DEFAULT NULL,
  `userGender` varchar(10) DEFAULT NULL,
  `userBirthDate` date DEFAULT NULL,
  `userRoles` varchar(10) DEFAULT NULL,
  `userPassword` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `lastLogin` varchar(50) DEFAULT NULL,
  `currentStatus` varchar(20) DEFAULT NULL,
  `profileImg` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userContact`, `userGender`, `userBirthDate`, `userRoles`, `userPassword`, `status`, `lastLogin`, `currentStatus`, `profileImg`) VALUES
(6, 'Jun Xian', 'junxian010729@gmail.com', '0124293014', 'Male', '2001-07-29', 'SuperUser', '$2y$10$F4cPSTpZqsGizPCcp1PqTOvvMoTnGx/7MIJqZAWGANcl7OKxRh1SK', 'Active', 'Mon 15:37:25 08/11/2021', 'Online', 'heartPirates.jpg'),
(7, 'demo2', 'demo2@demo.com', '0124925526', 'Male', '1998-06-24', 'Admin', '$2y$10$LoxFUC0UlzuGkPgA2gskKOykdqBqqH6j5EdwBZ5JNVwd5Pbpdzvie', 'Active', 'Fri 22:44:13 05/11/2021', 'Offline', 'demon.jpg'),
(10, 'demo3', 'demo3@demo.com', '0124355621', 'Female', '1999-02-16', 'Staff', '$2y$10$jxt/xqog2S0UMSTAFfiXA.5GZK6bCabofyWpTf0jX6IiMZ/54HBuC', 'Active', 'Mon 16:09:36 01/11/2021', 'Offline', 'jisoo.jpg'),
(11, 'demo4', 'demo4@demo.com', '01234567655', 'Female', '2002-03-13', 'Staff', '$2y$10$R1pcDTC7FaTEL9.YCSEzoOjUWGVF2P62CgInng4aF6nxUKsQ206Gm', 'Banned', 'Sun 23:23:30 22/08/2021', 'Offline', ''),
(13, 'demo5', 'demo5@demo.com', '0124556789', 'Male', '1994-08-15', 'Staff', '$2y$10$ZJNKlbXdDl930.na8oSqAu.FeUctLmZMfoU6bbaD.xRlPYImQE38a', 'Banned', 'Sun 23:23:44 22/08/2021', 'Offline', ''),
(16, 'demo6', 'demo6@demo.com', '01243356798', 'Female', '1997-05-07', 'Staff', '$2y$10$XUzQ5zMqMCXAu4xxAXJgAeLs9pYbIWYT3j38snRQIcDQlDYBRm6Ga', 'Active', 'Thu 17:02:13 14/10/2021', 'Offline', ''),
(31, 'demo100', 'demo100@demo.com', '01288735422', 'Male', '2021-09-06', 'Admin', '$2y$10$ZnmWkHGfXTl/omJiCPwzfu2Cv0A/XbC6Q.XoFGDKKH8bjo4EgbBJ2', 'Closed', '', 'Offline', 'ap.jpg'),
(32, 'leejx', 'leejx-pm19@student.tarc.edu.my', '0123425512', 'Male', '2021-09-09', 'Staff', '$2y$10$tH5oEHZNefbWyoYIOA2jkenyPcTgd/xmDhyx6t1FdUtQzPo9VGrIi', 'Active', 'Mon 00:41:58 18/10/2021', 'Offline', 'jisoo3.jpg'),
(35, 'Superuser1', 'demo@demo.com', '0124595526', 'Male', '2001-07-29', 'SuperUser', '$2y$10$phKqCrURy0LTbGlV4ZA7QOr9JP4yWXeOxbVQoAkHRF83KAaMwEVNa', 'Active', 'Tue 16:39:48 05/10/2021', 'Offline', 'law.JPG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`attributeId`);

--
-- Indexes for table `attributes_value`
--
ALTER TABLE `attributes_value`
  ADD PRIMARY KEY (`attvalueId`);

--
-- Indexes for table `backup`
--
ALTER TABLE `backup`
  ADD PRIMARY KEY (`backupId`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brandId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`companyId`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplierId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `attributeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `attributes_value`
--
ALTER TABLE `attributes_value`
  MODIFY `attvalueId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `backup`
--
ALTER TABLE `backup`
  MODIFY `backupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `companyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplierId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
