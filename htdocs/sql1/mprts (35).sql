-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 30, 2017 at 05:42 AM
-- Server version: 5.7.17-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mprts`
--

-- --------------------------------------------------------

--
-- Table structure for table `mprts_buildings`
--

CREATE TABLE `mprts_buildings` (
  `image_url` varchar(100) NOT NULL DEFAULT 'images/property1.jpg',
  `building_id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `building_name` varchar(100) NOT NULL,
  `building_type` varchar(40) NOT NULL,
  `building_units` int(4) NOT NULL,
  `building_locality` varchar(100) NOT NULL,
  `building_city` varchar(100) NOT NULL,
  `building_state` varchar(100) NOT NULL,
  `building_pincode` varchar(6) NOT NULL,
  `building_phno` varchar(12) NOT NULL,
  `building_phno2` varchar(12) NOT NULL,
  `building_email` varchar(100) NOT NULL,
  `building_current_meter` varchar(20) NOT NULL,
  `building_water_meter` varchar(20) NOT NULL,
  `building_access_code` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mprts_buildings`
--

INSERT INTO `mprts_buildings` (`image_url`, `building_id`, `building_name`, `building_type`, `building_units`, `building_locality`, `building_city`, `building_state`, `building_pincode`, `building_phno`, `building_phno2`, `building_email`, `building_current_meter`, `building_water_meter`, `building_access_code`) VALUES
('images/property1.jpg', 0001, 'Maa Building 1', 'Appartment', 40, 'Madhapur', 'Hyderabad', 'Telangana', '500002', '9100000001', '', 'testaa1@email.com', 'CM1234', 'WM1234', 'AA00010000'),
('images/property1.jpg', 0002, 'Maa Building 2', 'Appartment', 0, 'Panjagutta', 'Hyderabad', 'Telangana', '500004', '9000090002', '', 'testaa2@email.com', 'CM1234', 'WM1234', 'AA00020000');

-- --------------------------------------------------------

--
-- Table structure for table `mprts_expenses`
--

CREATE TABLE `mprts_expenses` (
  `expense_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `expense_date` varchar(20) NOT NULL,
  `expense_amount` varchar(10) NOT NULL,
  `expense_cause` varchar(100) NOT NULL,
  `expense_description` varchar(400) NOT NULL,
  `expense_access_code` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mprts_expenses`
--

INSERT INTO `mprts_expenses` (`expense_id`, `expense_date`, `expense_amount`, `expense_cause`, `expense_description`, `expense_access_code`) VALUES
(000001, '1 September, 2017', '10000', 'Miscellaneous', 'CC TV Setup in Apartment', 'AA00020000'),
(000002, '1 September, 2017', '10000', 'Electric Work', 'Motor Repair in Pump House', 'AA00010000');

-- --------------------------------------------------------

--
-- Table structure for table `mprts_notes`
--

CREATE TABLE `mprts_notes` (
  `notes_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `notes_category` varchar(50) NOT NULL DEFAULT 'Others',
  `notes_description` text NOT NULL,
  `notes_date` varchar(30) NOT NULL,
  `notes_access_code` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mprts_notes`
--

INSERT INTO `mprts_notes` (`notes_id`, `notes_category`, `notes_description`, `notes_date`, `notes_access_code`) VALUES
(000001, 'Owners', 'Sample Owner Details', 'Sep 19 2017 ', 'MM00000000'),
(000002, 'null', '', 'Sep 20 2017 ', 'MM00000000'),
(000003, 'null', '', 'Sep 20 2017 ', 'MM00000000');

-- --------------------------------------------------------

--
-- Table structure for table `mprts_owner`
--

CREATE TABLE `mprts_owner` (
  `owner_id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `owner_name` varchar(50) NOT NULL,
  `owner_mobile` varchar(12) NOT NULL,
  `owner_photo` varchar(100) NOT NULL DEFAULT 'images/house_owner.PNG',
  `owner_address` varchar(300) NOT NULL,
  `owner_email` varchar(100) NOT NULL,
  `owner_id_proof` varchar(100) NOT NULL DEFAULT 'uploads/OwnerIds/aadhaar_sample.jpg',
  `access_code` varchar(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mprts_owner`
--

INSERT INTO `mprts_owner` (`owner_id`, `owner_name`, `owner_mobile`, `owner_photo`, `owner_address`, `owner_email`, `owner_id_proof`, `access_code`) VALUES
(0001, 'TestOwner1', '9200090001', 'images/house_owner.PNG', 'Test Owner 1 Address', 'testowner1@email.com', 'uploads/OwnerIds/aadhaar_sample.jpg', 'OO0001000'),
(0002, 'TestOwner2', '9200090002', 'images/house_owner.PNG', 'Test Owner 2 Address', 'testowner2@email.com', 'uploads/OwnerIds/aadhaar_sample.jpg', 'OO00010002'),
(0003, 'TestOwner3', '9200090003', 'images/house_owner.PNG', 'Test Owner 3 Address', 'testowner3@email.com', 'uploads/OwnerIds/aadhaar_sample.jpg', 'OO00020001'),
(0004, 'TestOwner4', '9200090004', 'uploads/maa_logo_dark.png', 'Test Owner 4 Address', 'testowner4@email.com', 'uploads/OwnerIds/aadhaar_sample.jpg', 'OO00020002'),
(0005, 'TestOwner1709', '9170991798', 'uploads/Sight_2015_08_02_133955_892.jpg', 'Test Owner 1709 Address', 'testowner1709@email.com', 'uploads/OwnerIds/aadhaar_sample.jpg', 'OO00000001'),
(0006, 'TestOwner17092', '9170929298', 'uploads/maa_logo_dark.png', 'TestOwner 17092 Address', 'testowner17092@email.com', 'uploads/OwnerIds/aadhaar_sample.jpg', 'OO00000002'),
(0007, 'TestOwner17093', '9170930298', 'images/house_owner.PNG', 'Test Owner 17093 Address', 'testowner17093@email.com', 'uploads/OwnerIds/aadhaar_sample.jpg', 'OO00000003'),
(0008, 'TestOwner18091', '9180919298', 'uploads/house_owner_2.png', 'Test Owner 18091 Address', 'testowner18091@email.com', 'uploads/OwnerIds/aadhaar_sample.jpg', 'OO00000004'),
(0010, 'Riya', '9299996222', 'uploads/riya-1.jpg', 'Kukatpally', 'ramakrishnap123@gmail.com', 'uploads/OwnerIds/Rishitha Aadharcard.jpg', 'OO00010003');

-- --------------------------------------------------------

--
-- Table structure for table `mprts_payments`
--

CREATE TABLE `mprts_payments` (
  `mprts_pmt_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `mprts_pmt_tnt` varchar(4) NOT NULL,
  `mprts_pmt_asset` varchar(4) NOT NULL,
  `mprts_pmt_cause` varchar(200) NOT NULL,
  `mprts_pmt_from_date` varchar(20) NOT NULL,
  `mprts_pmt_to_date` varchar(20) NOT NULL,
  `mprts_pmt_act_amt` varchar(20) NOT NULL,
  `mprts_pmt_paid_amt` varchar(20) NOT NULL,
  `mprts_pmt_due` varchar(20) NOT NULL,
  `mprts_receipt_no` varchar(20) NOT NULL,
  `mprts_access_code` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mprts_payments`
--

INSERT INTO `mprts_payments` (`mprts_pmt_id`, `mprts_pmt_tnt`, `mprts_pmt_asset`, `mprts_pmt_cause`, `mprts_pmt_from_date`, `mprts_pmt_to_date`, `mprts_pmt_act_amt`, `mprts_pmt_paid_amt`, `mprts_pmt_due`, `mprts_receipt_no`, `mprts_access_code`) VALUES
(000001, '0004', '0005', 'Paintings Work', '1 September, 2017', '30 September, 2017', '40000', '40000', '0', '170912000400010', 'AA00020000'),
(000002, '0006', '0004', 'Monthly Rent', '1 September, 2017', '30 September, 2017', '15000', '10000', '5000', '170912000600021', 'AA00020000'),
(000003, '0001', '0001', 'Monthly Maintenance', '1 September, 2017', '30 September, 2017', '10000', '10000', '0', '170912000100030', 'AA00010000'),
(000004, '0001', '0001', 'Monthly Rent', '1 September, 2017', '30 September, 2017', '10000', '5000', '5000', '170913000100041', 'AA00010000'),
(000005, '0001', '0001', 'Sample Payment', '1 September, 2017', '30 September, 2017', '5000', '4500', '500', '170924000100050', 'MM00000000'),
(000006, '0002', '0003', 'Payment Test Owner 2409', '1 September, 2017', '30 September, 2017', '10000', '10000', '0', '170924000200060', 'AA00010000'),
(000007, '0003', '0004', 'Payment Test Owner2 2409', '1 September, 2017', '30 September, 2017', '10000', '10000', '0', '170924000300070', 'AA00010000'),
(000008, '0002', '0002', 'Sample Payment TT1', '1 September, 2017', '30 September, 2017', '5000', '5000', '0', '170924000200081', 'AA00010000'),
(000009, '0007', '', 'rent', '1 August, 2017', '31 August, 2017', '14000', '14000', '0', '170926000700090', 'AA00010000'),
(000010, '0007', '', 'Rent', '1 August, 2017', '31 August, 2017', '14000', '14000', '0', '170926000700100', 'AA00010000'),
(000011, '0007', '', 'rent', '1 September, 2017', '30 September, 2017', '15000', '15000', '0', '170926000700110', 'MM00000000'),
(000012, '0007', '', 'Gym', '1 September, 2017', '30 September, 2017', '1500', '1500', '0', '170926000700120', 'AA00010000'),
(000013, '0104', '0007', 'Gym', '1 August, 2017', '30 September, 2017', '600', '600', '0', '170926010400131', 'AA00010000'),
(000014, '0007', '', 'Hall Bookong', '1 September, 2017', '30 September, 2017', '5000', '5000', '0', '170926000700140', 'AA00010000'),
(000015, '0003', '0004', '', '1 September, 2017', '30 September, 2017', '555', '555', '0', '170926000300150', 'AA00010000'),
(000016, '0001', '0001', 'gym', '1 September, 2017', '30 September, 2017', '555', '555', '0', '170926000100160', 'AA00010000'),
(000017, '0002', '0003', 'GYM', '1 September, 2017', '30 September, 2017', '666', '666', '0', '170926000200170', 'AA00010000'),
(000018, '0003', '0004', 'GYM', '1 September, 2017', '30 September, 2017', '777', '777', '0', '170926000300180', 'AA00010000'),
(000019, '0007', '', 'GYM', '1 September, 2017', '30 September, 2017', '888', '888', '0', '170926000700190', 'AA00010000'),
(000020, '0104', '0007', 'GYM', '1 September, 2017', '30 September, 2017', '999', '999', '0', '170926010400201', 'AA00010000'),
(000021, '0007', '', 'Gym', '1 September, 2017', '30 September, 2017', '1111', '1111', '0', '170926000700210', 'AA00010000'),
(000022, '0003', '0004', 'Test Payment Mobile', '1 September, 2017', '30 September, 2017', '12000', '10000', '2000', '170928000300220', 'MM00000000'),
(000023, '0007', '0007', 'Test Payment DT2', '1 September, 2017', '30 September, 2017', '12000', '10000', '2000', '170928000700230', 'AA00010000'),
(000024, '0007', '', 'Test Payment Dt2', '1 September, 2017', '30 September, 2017', '10000', '5000', '5000', '170928000700240', 'AA00010000'),
(000025, '0', '', 'Test Payment DT3', '1 September, 2017', '30 September, 2017', '5000', '4500', '500', '170928000700250', 'AA00010000'),
(000026, '0010', '0007', 'Test Payment DT4', '1 September, 2017', '30 September, 2017', '5000', '4500', '500', '170928000700260', 'AA00010000'),
(000027, '0104', '0007', 'Test Tenant PMT DT1', '1 September, 2017', '30 September, 2017', '6000', '5000', '1000', '170928010400271', 'AA00010000'),
(000028, '0002', '0003', 'Test Payment Owner DT6', '1 October, 2017', '31 October, 2017', '4500', '4000', '500', '170928000300280', 'AA00010000'),
(000029, '0104', '0007', 'Rent', '1 October, 2017', '31 October, 2017', '6500', '6000', '500', '170928010400291', 'AA00010000'),
(000030, '0010', '0007', 'Monthly Maintenance', '1 August, 2017', '31 August, 2017', '5000', '5000', '0', '170928000700300', 'AA00010000'),
(000031, '0010', '0007', 'Test Payment 22', '1 September, 2017', '30 September, 2017', '11000', '10000', '1000', '170929000800310', 'AA00010000'),
(000032, '0002', '0003', 'iiiiiiiiiiiiiiiiiiiiiii', '1 September, 2017', '30 September, 2017', '9889', '8787', '1102', '170929000300320', 'AA00010000'),
(000033, '0010', '0007', 'ghgjghjghjhgjg', '1 September, 2017', '30 September, 2017', '33442', '23344', '10098', '170929000800330', 'AA00010000');

-- --------------------------------------------------------

--
-- Table structure for table `mprts_property`
--

CREATE TABLE `mprts_property` (
  `prty_id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `prty_image` varchar(200) NOT NULL DEFAULT 'images/home.png',
  `prty_location` varchar(100) NOT NULL,
  `prty_owner` varchar(100) NOT NULL,
  `prty_address` varchar(300) NOT NULL,
  `prty_no` varchar(6) NOT NULL,
  `prty_type` varchar(20) NOT NULL,
  `prty_current_meter` varchar(20) NOT NULL,
  `prty_building_id` varchar(6) NOT NULL,
  `prty_rent` varchar(6) NOT NULL,
  `prty_rooms` int(2) NOT NULL DEFAULT '2',
  `access_code` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mprts_property`
--

INSERT INTO `mprts_property` (`prty_id`, `prty_image`, `prty_location`, `prty_owner`, `prty_address`, `prty_no`, `prty_type`, `prty_current_meter`, `prty_building_id`, `prty_rent`, `prty_rooms`, `access_code`) VALUES
(0001, 'images/home.png', 'Madhapur', '0001', '0001,Madhapur,Hyderabad,Telangana,500002', '1A', 'Flat', 'USC12345', '0001', '10000', 2, 'AA00010001'),
(0002, 'images/home.png', 'Madhapur', '0001', '0001,Madhapur,Hyderabad,Telangana,500002', '1B', 'Flat', 'USC12345', '0001', '10000', 2, 'AA00010001'),
(0003, 'images/home.png', 'Madhapur', '0002', '0001,Madhapur,Hyderabad,Telangana,500002', '1C', 'Flat', 'USC12345', '0001', '10000', 2, 'AA00010002'),
(0004, 'images/home.png', 'Panjagutta', '0003', '0002,Panjagutta,Hyderabad,Telangana,500004', '2A', 'Flat', 'USC12345', '0002', '10000', 3, 'AA00020001'),
(0005, 'images/home.png', 'Panjagutta', '0004', '0002,Panjagutta,Hyderabad,Telangana,500004', '2B', 'Flat', 'USC12345', '0002', '10000', 3, 'AA00020002'),
(0006, 'images/home.png', 'Panjagutta', '0004', '0002,Panjagutta,Hyderabad,Telangana,500004', '2C', 'Flat', 'USC12345', '0002', '10000', 2, 'MM00000002'),
(0007, 'images/home.png', 'Madhapur', '0010', '0001,Madhapur,Hyderabad,Telangana,500002', '101', 'Flat', '564879', '0001', '10000', 3, 'AA00010003'),
(0008, 'images/home.png', 'Madhapur', '0010', '0001,Madhapur,Hyderabad,Telangana,500002', '1D', 'Flat', 'USC2314', '0001', '10000', 3, 'AA00010003'),
(0009, 'images/home.png', 'Madhapur', '2', '0001,Madhapur,Hyderabad,Telangana,500002', '1E', 'Flat', 'USC5214', '0001', '15001', 3, 'AA00010002');

-- --------------------------------------------------------

--
-- Table structure for table `mprts_tenants`
--

CREATE TABLE `mprts_tenants` (
  `tenant_id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `tenant_image` varchar(100) NOT NULL DEFAULT 'images/house_owner.PNG',
  `tenant_name` varchar(100) NOT NULL,
  `tenant_propid` varchar(100) NOT NULL,
  `tenant_owner_id` varchar(100) NOT NULL,
  `tenant_mobile` varchar(12) NOT NULL,
  `tenant_address` varchar(200) NOT NULL,
  `tenant_email` varchar(50) NOT NULL,
  `tenant_id_type` varchar(100) NOT NULL,
  `tenant_id_no` varchar(100) NOT NULL DEFAULT 'uploads/OwnerIds/aadhaar_sample.jpg	',
  `tenant_joining_date` varchar(100) NOT NULL,
  `tenant_vacating_date` varchar(100) NOT NULL,
  `tenant_advance` varchar(10) NOT NULL,
  `access_code` varchar(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mprts_tenants`
--

INSERT INTO `mprts_tenants` (`tenant_id`, `tenant_image`, `tenant_name`, `tenant_propid`, `tenant_owner_id`, `tenant_mobile`, `tenant_address`, `tenant_email`, `tenant_id_type`, `tenant_id_no`, `tenant_joining_date`, `tenant_vacating_date`, `tenant_advance`, `access_code`) VALUES
(0001, 'images/house_owner.PNG', 'TestTenant1', '0001', '0001', '9300090001', 'TestTenant1 Permanent Address', 'testtenant1@email.com', 'null', 'uploads/OwnerIds/aadhaar_sample.jpg', '1 September, 2017', '1 September, 2018', '10000', 'AA00010000'),
(0002, 'images/house_owner.PNG', 'TestTenant2', '0002', '0001', '9300090002', 'TestTenant2 Permanent Address', 'testtenant2@email.com', 'Aadhar Card', 'uploads/OwnerIds/aadhaar_sample.jpg', '1 September, 2017', '1 September, 2018', '10000', 'AA00010000'),
(0003, 'images/house_owner.PNG', 'TestTenant3', '0001', '0001', '9300090003', 'TestTenant3 Permanent Address', 'testtenant3@email.com', 'Aadhar Card', 'uploads/OwnerIds/aadhaar_sample.jpg', '1 September, 2017', '1 September, 2018', '10000', 'AA00010000'),
(0004, 'images/house_owner.PNG', 'TestTenant4', '0004', '0003', '9300090004', 'Test Tenant4 Permanent Address', 'testtenant4@email.com', 'Aadhar Card', 'uploads/OwnerIds/aadhaar_sample.jpg', '1 September, 2017', '1 September, 2018', '10000', 'AA00020000'),
(0005, 'images/house_owner.PNG', 'TestTenant5', '0005', '0004', '9300090005', 'Test Tenant5 Permanent Address', 'testtenant5@email.com', 'Aadhar Card', 'uploads/OwnerIds/aadhaar_sample.jpg', '1 September, 2017', '1 September, 2018', '15000', 'AA00020000'),
(0104, 'uploads/TenantIDs/Rishitha photo.jpg', 'rishitha', '0007', '0010', '9299996111', 'Mothinagar', 'rama@gmail.com', '', 'uploads/TenantIDs/Aadhar for Rk.jpg', '1 August, 2017', '30 June, 2017', '28000', 'AA00010000'),
(0105, 'uploads/TenantIDs/Sight_2015_08_02_133955_892.jpg', 'SG Tenant1', '0008', '0010', '9887777898', 'SG Tenant1 Permanent Address', 'sgtenant1@email.com', '', 'uploads/TenantIDs/sampledashboard.PNG', '1 September, 2017', '1 September, 2018', '10000', 'AA00010000');

-- --------------------------------------------------------

--
-- Table structure for table `mprts_users`
--

CREATE TABLE `mprts_users` (
  `user_type` varchar(4) NOT NULL,
  `user_id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_pass` varchar(200) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_mobile` varchar(20) NOT NULL,
  `user_usc_no` varchar(20) NOT NULL,
  `user_access_code` varchar(10) NOT NULL,
  `user_status` varchar(20) NOT NULL DEFAULT 'Initial'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mprts_users`
--

INSERT INTO `mprts_users` (`user_type`, `user_id`, `user_name`, `user_pass`, `user_email`, `user_mobile`, `user_usc_no`, `user_access_code`, `user_status`) VALUES
('MM', 0000, 'MasterAdmin1', 'masterpass1', 'masteradmin1@email.com', '9000090000', 'USC0000', 'MM00000000', 'Activated'),
('AA', 0002, 'testaa1', 'passaa1', 'testaa1@email.com', '9100000001', 'USC0001', 'AA00010000', 'Activated'),
('OO', 0003, 'testowner1', 'pass1234', 'testowner1@email.com', '9200090001', '', 'OO00010001', 'Initial'),
('OO', 0004, 'TestOwner2', 'pass1234', 'testowner2@email.com', '9200090002', '', 'OO00010002', 'Initial'),
('AA', 0005, 'Testaa2', 'passaa2', 'testaa2@email.com', '9000090002', 'USC0002', 'AA00020000', 'Activated'),
('OO', 0006, 'TestOwner3', 'pass1234', 'testowner3@email.com', '9200090003', '', 'OO00020001', 'Initial'),
('OO', 0007, 'TestOwner4', 'pass1234', 'testowner4@email.com', '9200090004', '', 'OO00020002', 'Initial'),
('OO', 0008, 'TestOwner1709', 'pass1234', 'testowner1709@email.com', '9170991798', '', 'OO00000001', 'Initial'),
('OO', 0009, 'TestOwner17092', 'pass1234', 'testowner17092@email.com', '9170929298', '', 'OO00000002', 'Initial'),
('OO', 0010, 'TestOwner17093', 'pass1234', 'testowner17093@email.com', '9170930298', '', 'OO00000003', 'Initial'),
('OO', 0011, 'TestOwner18091', 'pass1234', 'testowner18091@email.com', '9180919298', '', 'OO00000004', 'Initial'),
('OO', 0012, 'ldknb', 'pass1234', 'dfn@kg.com', '7898988989', '', 'OO00000005', 'Initial'),
('OO', 0013, 'Riya', 'pass1234', 'ramakrishnap123@gmail.com', '9299996222', '', 'OO00010003', 'Initial');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mprts_buildings`
--
ALTER TABLE `mprts_buildings`
  ADD PRIMARY KEY (`building_id`);

--
-- Indexes for table `mprts_expenses`
--
ALTER TABLE `mprts_expenses`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `mprts_notes`
--
ALTER TABLE `mprts_notes`
  ADD PRIMARY KEY (`notes_id`);

--
-- Indexes for table `mprts_owner`
--
ALTER TABLE `mprts_owner`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `mprts_payments`
--
ALTER TABLE `mprts_payments`
  ADD PRIMARY KEY (`mprts_pmt_id`),
  ADD UNIQUE KEY `mprts_receipt_no` (`mprts_receipt_no`);

--
-- Indexes for table `mprts_property`
--
ALTER TABLE `mprts_property`
  ADD PRIMARY KEY (`prty_id`);

--
-- Indexes for table `mprts_tenants`
--
ALTER TABLE `mprts_tenants`
  ADD PRIMARY KEY (`tenant_id`),
  ADD UNIQUE KEY `tenant_email` (`tenant_email`);

--
-- Indexes for table `mprts_users`
--
ALTER TABLE `mprts_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD UNIQUE KEY `user_mobile` (`user_mobile`),
  ADD UNIQUE KEY `user_access_code` (`user_access_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mprts_buildings`
--
ALTER TABLE `mprts_buildings`
  MODIFY `building_id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mprts_expenses`
--
ALTER TABLE `mprts_expenses`
  MODIFY `expense_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mprts_notes`
--
ALTER TABLE `mprts_notes`
  MODIFY `notes_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `mprts_owner`
--
ALTER TABLE `mprts_owner`
  MODIFY `owner_id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `mprts_payments`
--
ALTER TABLE `mprts_payments`
  MODIFY `mprts_pmt_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `mprts_property`
--
ALTER TABLE `mprts_property`
  MODIFY `prty_id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `mprts_tenants`
--
ALTER TABLE `mprts_tenants`
  MODIFY `tenant_id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT for table `mprts_users`
--
ALTER TABLE `mprts_users`
  MODIFY `user_id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
