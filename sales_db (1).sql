-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2018 at 07:07 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sales_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_personnel`
--

CREATE TABLE `tbl_personnel` (
  `personnel_id` int(11) NOT NULL,
  `personnel_name` varchar(50) NOT NULL,
  `personnel_address` varchar(50) NOT NULL,
  `personnel_bdate` date NOT NULL,
  `personnel_type` int(1) NOT NULL,
  `personnel_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_personnel`
--

INSERT INTO `tbl_personnel` (`personnel_id`, `personnel_name`, `personnel_address`, `personnel_bdate`, `personnel_type`, `personnel_status`) VALUES
(1, 'Admin', 'cecec', '2018-02-06', 0, 1),
(10, 'sxsx', 'dsvfsdg', '2018-02-24', 1, 1),
(11, 'dd', 'hh', '2018-02-22', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `prod_id` int(11) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `prod_cat_id` int(11) NOT NULL,
  `prod_name` varchar(50) NOT NULL,
  `prod_desc` varchar(50) NOT NULL,
  `prod_img` varchar(110) NOT NULL,
  `cost` decimal(12,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `prod_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`prod_id`, `barcode`, `prod_cat_id`, `prod_name`, `prod_desc`, `prod_img`, `cost`, `price`, `prod_status`) VALUES
(10, 'MA054310', 6, 'max', 'Red black', '10_thumb-1920-638567.jpg', '9.15', '5.00', 1),
(38, 'VF081942', 2, 'vfvfv', 'fvfv', 'default.png', '0.00', '232.00', 1),
(39, 'CD081949', 2, 'cdcdc', 'dcdcdc', '39_ZsUWbl.jpg', '0.00', '3.00', 1),
(40, 'SD081956', 6, 'sdsd', 'sdsdsd', '40_unnamed.png', '0.00', '3.00', 1),
(41, 'GB084851', 5, 'gbfgb', 'gbgb', 'default.png', '0.00', '5.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_category`
--

CREATE TABLE `tbl_product_category` (
  `prod_cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `cat_desc` varchar(110) NOT NULL,
  `cat_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_category`
--

INSERT INTO `tbl_product_category` (`prod_cat_id`, `cat_name`, `cat_desc`, `cat_status`) VALUES
(2, 'Hog and Poultry', 'A', 1),
(5, 'xsx', 'd', 1),
(6, 'fds', 'dcdc', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receive`
--

CREATE TABLE `tbl_receive` (
  `rec_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `cost` decimal(10,0) NOT NULL,
  `date` date NOT NULL,
  `rec_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_receive`
--

INSERT INTO `tbl_receive` (`rec_id`, `prod_id`, `qty`, `cost`, `date`, `rec_status`) VALUES
(6, 10, 1000, '9', '2018-02-23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales_detail`
--

CREATE TABLE `tbl_sales_detail` (
  `sales_detail_id` int(11) NOT NULL,
  `sales_number` varchar(50) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `cost` decimal(14,3) NOT NULL,
  `qty` decimal(12,2) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `discount` decimal(12,2) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sales_detail`
--

INSERT INTO `tbl_sales_detail` (`sales_detail_id`, `sales_number`, `prod_id`, `cost`, `qty`, `price`, `discount`, `amount`, `status`) VALUES
(5, 'SS-02222018064355', 10, '4.000', '10.00', '5.00', '0.00', '50.00', 1),
(6, 'SS-02222018064517', 10, '4.000', '10.00', '5.00', '0.00', '50.00', 1),
(7, 'SS-02222018064517', 11, '5.000', '100.00', '10.00', '0.00', '1000.00', 1),
(8, 'SS-02222018065438', 10, '4.000', '5.00', '5.00', '0.00', '25.00', 1),
(9, 'SS-02222018071456', 10, '4.000', '5.00', '5.00', '0.00', '25.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales_header`
--

CREATE TABLE `tbl_sales_header` (
  `sales_header_id` int(11) NOT NULL,
  `sales_number` varchar(20) NOT NULL,
  `customer` varchar(50) NOT NULL,
  `sales_date` date NOT NULL,
  `remark` varchar(50) NOT NULL,
  `date_added` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `sales_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sales_header`
--

INSERT INTO `tbl_sales_header` (`sales_header_id`, `sales_number`, `customer`, `sales_date`, `remark`, `date_added`, `user_id`, `sales_status`) VALUES
(4, 'SS-02222018064355', 'vfv', '2018-02-22', '', '2018-02-22 05:44:00', 1, 1),
(5, 'SS-02222018064517', 'vfv', '2018-02-22', '', '2018-02-22 05:45:22', 1, 1),
(6, 'SS-02222018065438', 'fdvbdfvf', '2018-02-21', 'vfvfv', '2018-02-22 05:54:48', 1, 1),
(7, 'SS-02222018071456', 'xc xsc', '2018-02-22', 'xcxc', '2018-02-22 06:15:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_scan`
--

CREATE TABLE `tbl_scan` (
  `scan_id` int(11) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_scan`
--

INSERT INTO `tbl_scan` (`scan_id`, `barcode`, `user_id`, `status`) VALUES
(59, 'MA054310', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` int(1) NOT NULL,
  `account_id` int(11) NOT NULL,
  `user_status` int(1) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `username`, `password`, `user_type`, `account_id`, `user_status`, `date_added`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, 1, 1, '2018-02-14 06:31:34'),
(26, 'a', '0cc175b9c0f1b6a831c399e269772661', 1, 11, 0, '2018-02-24 02:47:03'),
(25, 'dfdf', 'eff7d5dba32b4da32d9a67a519434d3f', 1, 10, 1, '2018-02-24 02:46:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_personnel`
--
ALTER TABLE `tbl_personnel`
  ADD PRIMARY KEY (`personnel_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `tbl_product_category`
--
ALTER TABLE `tbl_product_category`
  ADD PRIMARY KEY (`prod_cat_id`);

--
-- Indexes for table `tbl_receive`
--
ALTER TABLE `tbl_receive`
  ADD PRIMARY KEY (`rec_id`);

--
-- Indexes for table `tbl_sales_detail`
--
ALTER TABLE `tbl_sales_detail`
  ADD PRIMARY KEY (`sales_detail_id`);

--
-- Indexes for table `tbl_sales_header`
--
ALTER TABLE `tbl_sales_header`
  ADD PRIMARY KEY (`sales_header_id`);

--
-- Indexes for table `tbl_scan`
--
ALTER TABLE `tbl_scan`
  ADD PRIMARY KEY (`scan_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_personnel`
--
ALTER TABLE `tbl_personnel`
  MODIFY `personnel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `tbl_product_category`
--
ALTER TABLE `tbl_product_category`
  MODIFY `prod_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_receive`
--
ALTER TABLE `tbl_receive`
  MODIFY `rec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_sales_detail`
--
ALTER TABLE `tbl_sales_detail`
  MODIFY `sales_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_sales_header`
--
ALTER TABLE `tbl_sales_header`
  MODIFY `sales_header_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_scan`
--
ALTER TABLE `tbl_scan`
  MODIFY `scan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
