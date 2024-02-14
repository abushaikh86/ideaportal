-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 17, 2023 at 12:08 PM
-- Server version: 5.7.40
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parasigh_jmbaxi`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `activity_log_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(200) DEFAULT NULL,
  `session_id` text,
  `module` varchar(200) DEFAULT NULL,
  `action` varchar(200) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`activity_log_id`, `user_id`, `user_name`, `session_id`, `module`, `action`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(54, 1, 'admin admin user', 'LQq6lGEVrEAI6uZwgucJRBwH84hsJSIgBZTX8bT8', 'External Users', 'Add User', 'External User Added : Test1 Test1', '2022-12-14 05:54:25', '2022-12-14 05:54:25', NULL),
(55, 1, 'admin admin user', 'LQq6lGEVrEAI6uZwgucJRBwH84hsJSIgBZTX8bT8', 'External Users', 'Edit User', 'External User Edited  : Test1 Test1 : ( name=\"Test1 2\" , last_name=\"Test1 2\" , Location=\"Mumbai\" , Department=\"Business Development\" , Company=\"Arya Offshore\" , Designation=\"Asst. Manager\")', '2022-12-14 05:54:57', '2022-12-14 05:54:57', NULL),
(56, 1, 'admin admin user', 'VZZIki1E4XyXf0m5cQGWqVZUHsqjjU6fNP9iAhjM', 'Roles', 'Role Updated', 'Role Updated : Role Name : Demo User', '2023-01-03 10:32:37', '2023-01-03 10:32:37', NULL),
(57, 1, 'admin admin user', '0fpAD2sYBzAXCWEHkLdKc9sNhTyGIbiiEdvwOCFl', 'Internal Users', 'Add User', 'Internal User added : Admin Dummy', '2023-01-04 07:24:11', '2023-01-04 07:24:11', NULL),
(58, 1, 'admin admin user', '0fpAD2sYBzAXCWEHkLdKc9sNhTyGIbiiEdvwOCFl', 'Internal Users', 'Add User', 'Internal User added : New admin', '2023-01-04 07:26:43', '2023-01-04 07:26:43', NULL),
(59, 1, 'admin admin user', '0fpAD2sYBzAXCWEHkLdKc9sNhTyGIbiiEdvwOCFl', 'Internal Users', 'Edit User', 'Internal User Edited  : New admin : ( first_name=\"New 3\" , last_name=\"admin 3\" , email=\"admisn3@gmail.com\" , mobile_no=\"2222222333\" , Department=\"Sales\" , Company=\"Arya Offshore\" , Location=\"Chennai\" , Designation=\"Asst. Manager\")', '2023-01-04 07:27:19', '2023-01-04 07:27:19', NULL),
(60, 1, 'admin admin user', '0fpAD2sYBzAXCWEHkLdKc9sNhTyGIbiiEdvwOCFl', 'Internal User', 'Delete User', 'User Deleted : New 3 admin 3', '2023-01-04 07:28:15', '2023-01-04 07:28:15', NULL),
(61, 1, 'admin admin user', '0fpAD2sYBzAXCWEHkLdKc9sNhTyGIbiiEdvwOCFl', 'Internal User', 'Delete User', 'User Deleted : Admin Dummy', '2023-01-04 07:28:41', '2023-01-04 07:28:41', NULL),
(62, 1, 'admin admin user', '0fpAD2sYBzAXCWEHkLdKc9sNhTyGIbiiEdvwOCFl', 'External Users', 'Add User', 'External User Added : Nova Apex', '2023-01-04 07:30:35', '2023-01-04 07:30:35', NULL),
(63, 1, 'admin admin user', '0fpAD2sYBzAXCWEHkLdKc9sNhTyGIbiiEdvwOCFl', 'External Users', 'Edit User', 'External User Edited  : Nova Apex : ( name=\"Nova e\" , last_name=\"Apex e\" , email=\"enova@gmail.com\" , mobile_no=\"6549873212\" , Location=\"Delhi\" , Department=\"Business Development\" , Company=\"Arya Offshore\" , Designation=\"Asst. Manager\")', '2023-01-04 07:31:20', '2023-01-04 07:31:20', NULL),
(64, 1, 'admin admin user', '0fpAD2sYBzAXCWEHkLdKc9sNhTyGIbiiEdvwOCFl', 'External Users', 'Edit Status and Role', 'External User Status and Role Edited  : Nova e Apex e : ( role=\"User\" , Account Status=\"Active\")', '2023-01-04 07:31:52', '2023-01-04 07:31:52', NULL),
(65, 1, 'admin admin user', '0fpAD2sYBzAXCWEHkLdKc9sNhTyGIbiiEdvwOCFl', 'External Users', 'Edit Status and Role', 'External User Status and Role Edited  : Nova e Apex e : ( role=\"Approving Authority\" , Centralized/Decentralized Type=\"Centralized\")', '2023-01-04 07:32:24', '2023-01-04 07:32:24', NULL),
(66, 1, 'admin admin user', '0fpAD2sYBzAXCWEHkLdKc9sNhTyGIbiiEdvwOCFl', 'Internal Users', 'Edit Status and Role', 'Internal User Status and Role Edited  : JMB Admin : ( Account Status=\"Inactive\" , Role=\"Manager\")', '2023-01-04 07:33:04', '2023-01-04 07:33:04', NULL),
(67, 1, 'admin admin user', '0fpAD2sYBzAXCWEHkLdKc9sNhTyGIbiiEdvwOCFl', 'Internal Users', 'Edit Status and Role', 'Internal User Status and Role Edited  : JMB Admin : ( Account Status=\"Active\" , Role=\"Admin\")', '2023-01-04 07:33:31', '2023-01-04 07:33:31', NULL),
(68, 1, 'admin admin user', '0fpAD2sYBzAXCWEHkLdKc9sNhTyGIbiiEdvwOCFl', 'Edit Profile', 'Edit Profile', 'Profile Edited  : admin admin user : ( first_name=\"admin e\" , last_name=\"admin user e\" , mobile_no=\"9879879873\" , Department=\"IT\" , Company=\"BLIP\" , Location=\"Chennai\" , Designation=\"AGM\")', '2023-01-04 07:47:28', '2023-01-04 07:47:28', NULL),
(69, 1, 'admin e admin user e', '0fpAD2sYBzAXCWEHkLdKc9sNhTyGIbiiEdvwOCFl', 'Edit Profile', 'Edit Profile', 'Profile Edited  : admin e admin user e : ( first_name=\"Admin\" , last_name=\"User\" , mobile_no=\"9879879875\" , Department=\"Business Development\" , Company=\"KSA\" , Location=\"Mumbai\" , Designation=\"Senior Manager\")', '2023-01-04 07:48:34', '2023-01-04 07:48:34', NULL),
(70, 1, 'Admin User', '0fpAD2sYBzAXCWEHkLdKc9sNhTyGIbiiEdvwOCFl', 'Change Password', 'Change Password', 'Account Password Changed ', '2023-01-04 07:49:50', '2023-01-04 07:49:50', NULL),
(71, 1, 'Admin User', 'MCQBGfIgPuSt3gs0MjMe0pRwFOOvSk2NrZ97UKju', 'Change Password', 'Change Password', 'Account Password Changed ', '2023-01-04 07:50:22', '2023-01-04 07:50:22', NULL),
(72, 1, 'Admin User', 'MCQBGfIgPuSt3gs0MjMe0pRwFOOvSk2NrZ97UKju', 'Roles', 'Role Updated', 'Role Updated : Role Name : Demo User', '2023-01-04 07:51:10', '2023-01-04 07:51:10', NULL),
(73, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Department Master', 'Department Created', 'New Department Created : Test Department', '2023-01-04 08:08:49', '2023-01-04 08:08:49', NULL),
(74, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Department Master', 'Department Updated', 'Department Updated : Test Department to Test Department edited', '2023-01-04 08:08:58', '2023-01-04 08:08:58', NULL),
(75, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Company Master', 'Company Created', 'New Company Created : test Company', '2023-01-04 08:09:17', '2023-01-04 08:09:17', NULL),
(76, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Company Master', 'Company Updated', 'Company Updated : test Company to test Company edited', '2023-01-04 08:09:28', '2023-01-04 08:09:28', NULL),
(77, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Location Master', 'Location Created', 'New Location Created : test location', '2023-01-04 08:09:41', '2023-01-04 08:09:41', NULL),
(78, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Location Master', 'Location Updated', 'Location Updated : test location to test location edited', '2023-01-04 08:09:50', '2023-01-04 08:09:50', NULL),
(79, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Designation Master', 'Designation Created', 'New Designation Created : Test Designation', '2023-01-04 08:10:10', '2023-01-04 08:10:10', NULL),
(80, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Designation Master', 'Designation Updated', 'Designation Updated : Test Designation to Test Designation edited', '2023-01-04 08:10:21', '2023-01-04 08:10:21', NULL),
(81, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Category Master', 'Category Created', 'New Category Created : test category', '2023-01-04 08:10:45', '2023-01-04 08:10:45', NULL),
(82, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Category Master', 'Category Updated', 'Category Updated : test category to test category edited', '2023-01-04 08:10:59', '2023-01-04 08:10:59', NULL),
(83, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Category Master', 'Category Deleted', 'Category Deleted : test category edited', '2023-01-04 08:11:05', '2023-01-04 08:11:05', NULL),
(84, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Designation Master', 'Designation Deleted', 'Designation Deleted : Test Designation edited', '2023-01-04 08:11:13', '2023-01-04 08:11:13', NULL),
(85, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Location Master', 'Location Deleted', 'Location Deleted : test location edited', '2023-01-04 08:11:21', '2023-01-04 08:11:21', NULL),
(86, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Company Master', 'Company Deleted', 'Company Deleted : test Company edited', '2023-01-04 08:11:29', '2023-01-04 08:11:29', NULL),
(87, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Department Master', 'Department Deleted', 'Department Deleted : Test Department edited', '2023-01-04 08:11:39', '2023-01-04 08:11:39', NULL),
(88, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Company Master', 'Company Created', 'New Company Created : adsf', '2023-01-04 08:20:45', '2023-01-04 08:20:45', NULL),
(89, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Company Master', 'Company Deleted', 'Company Deleted : adsf', '2023-01-04 08:20:53', '2023-01-04 08:20:53', NULL),
(90, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Location Master', 'Location Created', 'New Location Created : f', '2023-01-04 08:21:21', '2023-01-04 08:21:21', NULL),
(91, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Location Master', 'Location Created', 'New Location Created : 2', '2023-01-04 09:19:13', '2023-01-04 09:19:13', NULL),
(92, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Location Master', 'Location Deleted', 'Location Deleted : 2', '2023-01-04 09:19:27', '2023-01-04 09:19:27', NULL),
(93, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Location Master', 'Location Deleted', 'Location Deleted : f', '2023-01-04 09:19:30', '2023-01-04 09:19:30', NULL),
(94, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Designation Master', 'Designation Created', 'New Designation Created : Designation dummy 1212', '2023-01-04 09:20:28', '2023-01-04 09:20:28', NULL),
(95, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Designation Master', 'Designation Deleted', 'Designation Deleted : Designation dummy 1212', '2023-01-04 09:20:33', '2023-01-04 09:20:33', NULL),
(96, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Category Master', 'Category Created', 'New Category Created : Category 98 edited', '2023-01-04 09:20:57', '2023-01-04 09:20:57', NULL),
(97, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Category Master', 'Category Deleted', 'Category Deleted : Category 98 edited', '2023-01-04 09:21:10', '2023-01-04 09:21:10', NULL),
(98, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Activity_log', 'Email Config Updated', 'Emails configured : Implementation Team : meetm@parasightsolutions.com to meetm@parasightsolutions.com,dummy@gmail.com, Assessment Team : meetm@parasightsolutions.com to meetm@parasightsolutions.com,dummy@gmail.com', '2023-01-04 09:31:01', '2023-01-04 09:31:01', NULL),
(99, 1, 'Admin User', 'y75y3VzC8KGPwc4GHvmAgS3FTPp3eDdmo2AMMIdK', 'Activity_log', 'Email Config Updated', 'Emails configured : Implementation Team : meetm@parasightsolutions.com,dummy@gmail.com to meetm@parasightsolutions.com, Assessment Team : meetm@parasightsolutions.com,dummy@gmail.com to meetm@parasightsolutions.com', '2023-01-04 09:31:22', '2023-01-04 09:31:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `admin_user_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(50) DEFAULT NULL,
  `account_status` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `department` varchar(200) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`admin_user_id`, `first_name`, `last_name`, `email`, `password`, `mobile_no`, `account_status`, `remember_token`, `department`, `role`, `company_id`, `location_id`, `designation_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'User', 'admin@gmail.com', '$2y$10$7eB8em.N0/cwuJJU8CTyOO2ApKn7DzuEx/ZJTtDnwI/bdNwNHMf6S', '9879879875', 1, 'J3SmoLhS0AtQn7WLVkAEpaaTX3uOZ0oSCJSDBzYxnFpC0NvHZd1VnOxXOZ68', '6', '1', 1, 7, 4, '2022-09-01 04:07:56', '2023-01-04 07:50:22', NULL),
(3, 'aaab', 'last nmc', 'dhumal1@gmail.comq', '$2y$10$Z6s6ZMT2u/./EYjJFeZCVOhiM0Xr6fRGEzte3i6i60TNhh5Nansva', NULL, 1, NULL, NULL, '1', NULL, NULL, NULL, '2022-09-06 22:55:58', '2022-09-06 23:11:48', NULL),
(7, 'naresh', 'dhumal', 'nareshdhumal263@gmail.com', '$2y$10$XeRslZNVAKETqhnZjCd9o.NxYQQhUgUqAzFnRZVB5fIaHArZRBa6i', NULL, 1, NULL, NULL, '5', NULL, NULL, NULL, '2022-09-06 23:30:47', '2022-10-01 04:36:38', '2022-10-01 04:36:38'),
(12, 'rahul', 'yadav', 'rahulyadav@gmail.com', '$2y$10$s0.5YLDM7c/185m..Foopuc4Odwp0HjzPtKX.M6340o3v5kMKv4y.', NULL, 1, NULL, 'packing dept', '5', NULL, NULL, NULL, '2022-09-30 11:40:37', '2022-10-10 08:53:01', NULL),
(13, 'JMB', 'Admin', 'neetap@jmbaxi.com', '$2y$10$07ixpv/tyc.XOjd0H/jA5OTcYJojo98l3OswNxvWJ.LjS0Gth9ayi', NULL, 1, NULL, 'IT', '1', NULL, NULL, NULL, '2022-10-19 06:09:36', '2023-01-04 07:33:31', NULL),
(14, 'Admin', 'Dummy', 'admin2@gmail.com', '$2y$10$o1gPRh9ylX7MFXTif8eJ7eeHZ9DCKUlOZ7FFWfYfmsiRSev42ldP6', '1234567895', 1, NULL, '1', '1', 5, 5, 5, '2023-01-04 07:24:11', '2023-01-04 07:28:41', '2023-01-04 07:28:41'),
(15, 'New 3', 'admin 3', 'admisn3@gmail.com', '$2y$10$a2VY4QxDYZn365BpFAXj8.3dPAUHLWOWZj/3FwpcM7THwAfpOziqG', '2222222333', 1, NULL, '3', '1', 7, 1, 6, '2023-01-04 07:26:43', '2023-01-04 07:28:15', '2023-01-04 07:28:15');

-- --------------------------------------------------------

--
-- Table structure for table `backend_menubar`
--

CREATE TABLE `backend_menubar` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(50) DEFAULT NULL,
  `menu_controller_name` varchar(50) DEFAULT NULL,
  `menu_action_name` varchar(50) DEFAULT NULL,
  `has_submenu` tinyint(4) DEFAULT '0',
  `menu_icon` varchar(200) DEFAULT NULL,
  `permissions` varchar(200) DEFAULT NULL,
  `visibility` tinyint(4) DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `backend_menubar`
--

INSERT INTO `backend_menubar` (`menu_id`, `menu_name`, `menu_controller_name`, `menu_action_name`, `has_submenu`, `menu_icon`, `permissions`, `visibility`, `sort_order`, `created_at`, `updated_at`) VALUES
(6, 'Roles', 'admin.roles', NULL, 0, NULL, '6,7,8,9', 1, 9, '2020-11-05 23:16:01', '2022-09-02 22:57:33'),
(22, 'User Management', '#', NULL, 1, 'users', NULL, 1, 10, '2021-09-14 18:12:49', '2021-11-02 02:39:19'),
(30, 'Masters', '#', NULL, 1, '#', NULL, 1, 12, '2022-10-19 23:46:31', '2022-11-11 09:28:34'),
(31, 'Settings', '#', NULL, 1, '#', NULL, 1, 12, '2022-10-19 23:46:31', '2022-11-11 09:28:34'),
(32, 'Idea Management', 'admin.ideaManagement', NULL, 0, 'users', NULL, 1, 10, '2021-09-14 18:12:49', '2021-11-02 02:39:19');

-- --------------------------------------------------------

--
-- Table structure for table `backend_submenubar`
--

CREATE TABLE `backend_submenubar` (
  `submenu_id` int(11) NOT NULL,
  `submenu_name` varchar(50) DEFAULT NULL,
  `submenu_controller_name` varchar(50) DEFAULT NULL,
  `submenu_action_name` varchar(50) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `sub_parent_id` int(11) DEFAULT NULL,
  `submenu_permissions` varchar(200) DEFAULT NULL,
  `visibility` tinyint(4) DEFAULT '1',
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `backend_submenubar`
--

INSERT INTO `backend_submenubar` (`submenu_id`, `submenu_name`, `submenu_controller_name`, `submenu_action_name`, `menu_id`, `sub_parent_id`, `submenu_permissions`, `visibility`, `sort_order`, `created_at`, `updated_at`) VALUES
(24, 'Internal Users', 'admin.users', 'grid', 22, NULL, '6,7,8,9', 1, NULL, '2021-09-14 12:44:11', '2022-09-06 01:53:48'),
(44, 'External Users', 'admin.externalusers', NULL, 22, NULL, NULL, 1, NULL, '2022-09-30 11:54:12', '2022-09-30 12:45:00'),
(46, 'Department Management', 'admin.departmentManagement', NULL, 30, NULL, NULL, 1, NULL, '2022-09-30 11:54:12', '2022-09-30 12:45:00'),
(47, 'Company Master', 'admin.company', NULL, 30, NULL, NULL, 1, NULL, '2022-09-30 11:54:12', '2022-09-30 12:45:00'),
(48, 'Location Master', 'admin.location', NULL, 30, NULL, NULL, 1, NULL, '2022-09-30 11:54:12', '2022-09-30 12:45:00'),
(49, 'Designation Master', 'admin.designation', NULL, 30, NULL, NULL, 1, NULL, '2022-09-30 11:54:12', '2022-09-30 12:45:00'),
(50, 'Category Master', 'admin.category', NULL, 30, NULL, NULL, 1, NULL, '2022-09-30 11:54:12', '2022-09-30 12:45:00'),
(51, 'Email Configuration', 'admin.email_config', NULL, 31, NULL, NULL, 1, NULL, '2022-09-30 11:54:12', '2022-09-30 12:45:00'),
(52, 'Activity Log', 'admin.activity_log', NULL, 31, NULL, NULL, 1, NULL, '2022-09-30 11:54:12', '2022-09-30 12:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `sub_category` int(11) DEFAULT NULL,
  `visibility` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `sub_category`, `visibility`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'test', 1, 1, '2022-09-13 05:57:38', '2022-09-13 05:57:38', NULL),
(7, 'adds', 1, 1, '2022-09-13 06:07:11', '2022-09-13 06:07:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Infrastructue', '2022-11-16 06:47:27', '2022-12-12 06:48:27', NULL),
(2, 'A New Category to Edit (edited)', '2022-11-16 06:47:46', '2022-11-16 06:48:02', '2022-11-16 06:48:02'),
(3, 'A new category 2 deleted', '2022-11-16 06:48:47', '2022-11-16 06:49:35', '2022-11-16 06:49:35'),
(4, 'New Activity', '2022-11-16 06:50:07', '2022-12-12 06:47:27', NULL),
(5, 'New Business Development', '2022-11-16 06:50:14', '2022-12-12 06:46:54', NULL),
(6, 'Process Change', '2022-11-16 06:50:34', '2022-12-12 06:46:34', NULL),
(7, 'Cost Saving', '2022-11-18 05:42:27', '2022-12-12 06:44:02', NULL),
(8, 'test category edited', '2023-01-04 08:10:45', '2023-01-04 08:11:05', '2023-01-04 08:11:05'),
(9, 'Category 98 edited', '2023-01-04 09:20:57', '2023-01-04 09:21:10', '2023-01-04 09:21:10');

-- --------------------------------------------------------

--
-- Table structure for table `category_details`
--

CREATE TABLE `category_details` (
  `category_details_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `category_details` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'KSA', '2022-11-13 23:58:32', '2022-12-12 06:42:32', NULL),
(2, 'dummy Company', '2022-11-14 00:14:04', '2022-11-14 00:14:42', '2022-11-14 00:14:42'),
(3, 'BLIP', '2022-11-14 00:15:08', '2022-12-12 06:42:04', NULL),
(4, 'PICT', '2022-11-16 04:11:24', '2022-12-12 06:40:25', NULL),
(5, 'JMBPL', '2022-11-16 04:11:29', '2022-12-12 06:40:10', NULL),
(6, 'CMT', '2022-11-18 05:41:07', '2022-12-12 06:39:42', NULL),
(7, 'Arya Offshore', '2022-11-18 05:41:19', '2022-12-12 06:39:17', NULL),
(8, 'test Company edited', '2023-01-04 08:09:17', '2023-01-04 08:11:29', '2023-01-04 08:11:29'),
(9, 'adsf', '2023-01-04 08:20:45', '2023-01-04 08:20:53', '2023-01-04 08:20:53');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'IT', '2022-10-13 07:26:27', '2022-10-13 07:26:27', NULL),
(2, 'Finance', '2022-10-13 07:26:27', '2022-10-13 07:26:27', NULL),
(3, 'Sales', '2022-10-13 07:26:54', '2022-10-13 07:26:54', NULL),
(4, 'Digital Marketing', '2022-10-13 07:26:54', '2022-10-13 07:26:54', NULL),
(5, 'Operations', '2022-11-18 05:40:45', '2022-12-12 06:38:36', NULL),
(6, 'Business Development', '2022-11-18 05:44:49', '2022-12-12 06:38:09', NULL),
(7, 'Test Department edited', '2023-01-04 08:08:49', '2023-01-04 08:11:39', '2023-01-04 08:11:39');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `designation_id` int(11) NOT NULL,
  `designation_name` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`designation_id`, `designation_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'GM', '2022-11-14 02:53:38', '2022-12-12 06:37:37', NULL),
(2, 'AGM', '2022-11-14 02:54:01', '2022-12-12 06:36:52', NULL),
(3, 'Third Designation', '2022-11-14 02:54:20', '2022-11-14 02:54:25', '2022-11-14 02:54:25'),
(4, 'Senior Manager', '2022-11-16 04:11:06', '2022-12-12 06:36:32', NULL),
(5, 'Manager', '2022-11-16 04:11:14', '2022-12-12 06:36:16', NULL),
(6, 'Asst. Manager', '2022-11-18 05:41:59', '2022-12-12 06:35:56', NULL),
(7, 'Test Designation edited', '2023-01-04 08:10:10', '2023-01-04 08:11:13', '2023-01-04 08:11:13'),
(8, 'Designation dummy 1212', '2023-01-04 09:20:28', '2023-01-04 09:20:33', '2023-01-04 09:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `email_config`
--

CREATE TABLE `email_config` (
  `email_config_id` int(11) NOT NULL,
  `team` varchar(255) DEFAULT NULL,
  `emails` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `active_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_config`
--

INSERT INTO `email_config` (`email_config_id`, `team`, `emails`, `created_at`, `updated_at`, `deleted_at`, `active_status`) VALUES
(1, 'Assessment Team', 'meetm@parasightsolutions.com', '2022-10-27 05:32:42', '2023-01-04 09:31:22', NULL, NULL),
(2, 'Approving Authority', 'meetm@parasightsolutions.com', '2022-10-27 05:32:42', '2022-12-31 04:56:34', NULL, NULL),
(3, 'Implementation Team', 'meetm@parasightsolutions.com', '2022-10-27 05:32:42', '2023-01-04 09:31:22', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ideas`
--

CREATE TABLE `ideas` (
  `idea_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `idea_uni_id` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `image_path` varchar(255) DEFAULT NULL,
  `certificate` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `active_status` varchar(50) DEFAULT 'pending',
  `assessment_team_approval` int(11) DEFAULT '0',
  `approving_authority_approval` int(11) DEFAULT '0',
  `implemented` int(11) DEFAULT '0',
  `rejected` int(11) DEFAULT '0',
  `category_id` int(11) DEFAULT NULL,
  `reject_reason` varchar(255) DEFAULT NULL,
  `resubmit_reason` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ideas`
--

INSERT INTO `ideas` (`idea_id`, `user_id`, `idea_uni_id`, `title`, `description`, `image_path`, `certificate`, `created_at`, `updated_at`, `deleted_at`, `active_status`, `assessment_team_approval`, `approving_authority_approval`, `implemented`, `rejected`, `category_id`, `reject_reason`, `resubmit_reason`) VALUES
(19, 9, NULL, 'Test Idea', 'Test Description', NULL, NULL, '2022-11-04 05:40:06', '2022-11-21 10:31:27', NULL, 'under_approving_authority', 1, 1, 0, 0, NULL, NULL, NULL),
(17, 16, NULL, 'Last Idea Title', 'Last idea Description', NULL, NULL, '2022-11-02 13:03:59', '2022-11-02 13:08:03', '2022-11-02 13:08:03', 'pending', 0, 0, 0, 0, NULL, NULL, NULL),
(18, 16, NULL, 'Final Idea Title', 'Final Idea Description', 'uploads/1667394288_1666169006_file-sample_100kB.doc', NULL, '2022-11-02 13:04:48', '2022-11-03 12:17:32', NULL, 'in_assessment', 1, 0, 0, 0, NULL, NULL, NULL),
(16, 16, NULL, 'Title of the Second Idea', 'Description of the Second idea', NULL, NULL, '2022-11-02 13:03:37', '2022-11-02 13:19:45', NULL, 'in_assessment', 1, 0, 0, 0, NULL, NULL, NULL),
(15, 16, NULL, 'Title of the First Idea by Kenny Ackerman', 'Description of the First Idea by Kenny Ackerman', 'uploads/1667394161_1662053761631.jpg', NULL, '2022-11-02 13:02:41', '2022-12-28 08:29:41', NULL, 'resubmit', 1, 0, 0, 0, NULL, NULL, 'test'),
(40, 33, NULL, 'Pict Idea', 'Pict Idea revised', 'uploads/1670829190_image(7).png', 1, '2022-12-12 07:13:11', '2022-12-19 09:24:40', NULL, 'implemented', 1, 1, 1, 0, 1, NULL, 'pls ask user to revise the request'),
(14, 9, NULL, 'My First Idea', 'Test idea\r\nModified as per the Assessment teams\'s instructions.\r\n\r\nThis should get approved now', NULL, NULL, '2022-11-01 09:48:14', '2022-12-05 07:27:41', NULL, 'under_approving_authority', 1, 1, 0, 0, NULL, NULL, NULL),
(36, 23, NULL, 'Testing 888', 'Testing 888', 'uploads/1670402144_1662089829671.pdf', 1, '2022-12-07 08:30:46', '2022-12-07 08:38:34', NULL, 'implemented', 1, 1, 1, 0, 7, NULL, 'upload a pdf'),
(37, 11, NULL, 'test12131212', 'Test', NULL, NULL, '2022-12-07 12:13:32', '2022-12-07 12:14:50', NULL, 'pending', 0, 0, 0, 0, 1, NULL, NULL),
(38, 29, NULL, 'First idea by Vijay', 'test description', 'uploads/1670476937_Screenshot (41).png', 1, '2022-12-08 05:22:17', '2022-12-08 05:34:35', NULL, 'implemented', 1, 1, 1, 0, 1, NULL, NULL),
(39, 29, NULL, 'My Second Idea', 'test', 'uploads/1670480801_Screenshot (1).png', 1, '2022-12-08 06:26:42', '2022-12-08 07:15:31', NULL, 'implemented', 1, 1, 1, 0, 1, NULL, NULL),
(24, 19, NULL, 'New Idea from Meet Mewada title', 'New Idea from Meet Mewada description', 'uploads/1668755609_index.jpeg', 1, '2022-11-18 07:13:29', '2022-12-05 11:00:07', NULL, 'implemented', 1, 1, 1, 0, 7, NULL, NULL),
(35, 23, NULL, 'Testing 333 Title', 'Testing 333 Description', 'uploads/1670397570_testing.jpg', 1, '2022-12-07 07:19:30', '2022-12-19 08:40:36', NULL, 'implemented', 1, 1, 1, 0, 5, NULL, 'submit proper image'),
(26, 21, NULL, 'A first Idea by Rock', 'testing testing', 'uploads/1669201455_testing.jpg', NULL, '2022-11-23 11:04:15', '2022-11-23 11:29:40', NULL, 'implementation', 1, 1, 1, 0, 5, NULL, NULL),
(27, 21, NULL, 'Latest idea Testing', 'testing testing 2', 'uploads/1669202036_street_night_wet_155637_1280x1024.jpg', NULL, '2022-11-23 11:05:04', '2022-11-23 11:24:43', '2022-11-23 11:24:43', 'reject', 1, 0, 0, 1, 6, 'Just Testing', 'Just testing'),
(28, 23, NULL, 'asdf', 'asdf', NULL, 1, '2022-11-23 11:10:19', '2022-12-14 09:19:42', NULL, 'implemented', 1, 1, 1, 0, 6, NULL, NULL),
(29, 23, NULL, 'Testing 1 edited', 'Testing 1 edited', 'uploads/1669719212_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', NULL, '2022-11-29 10:29:44', '2022-11-29 10:58:21', NULL, 'reject', 1, 0, 0, 1, 7, 'Not preferred', 'Kindly provide the proper Image'),
(30, 23, NULL, 'Testing 18', 'Testing 18', 'uploads/1669784121_Middleware@2x.png', NULL, '2022-11-30 04:55:22', '2022-11-30 05:14:46', NULL, 'reject', 0, 0, 0, 1, 5, 'Idea is not preferable by the company', NULL),
(31, 23, NULL, 'Testing 19', 'The standard Lorem Ipsum passage, used since the 1500s\r\n\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\r\n\r\nSection 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC\r\n\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"\r\n\r\n1914 translation by H. Rackham\r\n\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\"\r\n\r\nSection 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC\r\n\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"\r\n\r\n1914 translation by H. Rackham\r\n\"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.\"', 'uploads/1669787331_Laravel Notes.pdf', 1, '2022-11-30 05:22:17', '2022-12-05 10:47:10', NULL, 'implemented', 1, 1, 1, 0, 6, NULL, 'upload a pdf file'),
(32, 23, NULL, 'Testing 22', 'Testing 22', 'uploads/1669787696_5650530.png', 1, '2022-11-30 05:54:56', '2022-11-30 05:56:49', NULL, 'implemented', 1, 1, 1, 0, 5, NULL, NULL),
(33, 11, NULL, 'My idea', 'Idea Description', 'uploads/1670215956_20221201_150543.jpg', NULL, '2022-12-05 04:51:19', '2022-12-05 04:52:40', NULL, 'pending', 0, 0, 0, 0, 4, NULL, NULL),
(34, 23, NULL, 'Testing 29', 'Testing 29', 'uploads/1670305001_image.png', 1, '2022-12-06 05:36:42', '2022-12-06 06:02:14', NULL, 'implemented', 1, 1, 1, 0, 4, NULL, NULL),
(41, 33, NULL, 'Process Change', 'Process to be changed', NULL, 1, '2022-12-13 05:04:34', '2022-12-16 08:04:30', NULL, 'implemented', 1, 1, 1, 0, 6, NULL, NULL),
(42, 23, NULL, 'Testing 102', 'Testing 102', 'uploads/1671086748_Java programs for practice with solutions.pdf', NULL, '2022-12-15 06:44:39', '2022-12-16 07:52:16', NULL, 'in_assessment', 0, 0, 0, 0, 1, NULL, 'Not Proper'),
(43, 23, NULL, 'Testing 105', 'Testing 105', 'uploads/1671109960_image.png', NULL, '2022-12-15 13:12:41', '2022-12-15 13:23:10', NULL, 'implementation', 1, 1, 0, 0, 5, NULL, NULL),
(44, 11, NULL, 'cost saving', 'cost saving', NULL, NULL, '2022-12-16 07:47:31', '2022-12-16 07:47:31', NULL, 'pending', 0, 0, 0, 0, 7, NULL, NULL),
(45, 33, NULL, 'cost saving', 'cost saving in admin exps', NULL, 1, '2022-12-16 07:49:08', '2022-12-30 09:22:42', NULL, 'implemented', 1, 1, 1, 0, 7, NULL, NULL),
(46, 23, NULL, 'My First Idea', 'asdfasdf', 'uploads/1671177293_Screenshot (1).png', NULL, '2022-12-16 07:54:53', '2022-12-16 07:55:57', NULL, 'resubmit', 0, 0, 0, 0, 1, NULL, 'Still not proper'),
(47, 39, NULL, 'Idea Testing 01', 'Idea Testing 01', 'uploads/1671278278_Laravel+Migrations@2x.png', NULL, '2022-12-17 11:57:58', '2022-12-17 12:07:56', NULL, 'reject', 1, 0, 0, 1, 5, 'Against company\'s Rules', NULL),
(48, 39, NULL, 'Idea Testing 02', 'Idea Testing 02', 'uploads/1671278961_Laravel Notes.pdf', 1, '2022-12-17 12:09:21', '2022-12-17 12:11:45', NULL, 'implemented', 1, 1, 1, 0, 5, NULL, NULL),
(49, 23, NULL, 'Idea 222', 'Idea 222', 'uploads/1671446895_3506754.jpg', NULL, '2022-12-19 10:48:16', '2022-12-19 10:48:16', NULL, 'pending', 0, 0, 0, 0, 5, NULL, NULL),
(50, 39, NULL, 'Idea 33', 'Idea 33', 'uploads/1671510992_image.png', NULL, '2022-12-20 04:36:33', '2022-12-20 04:36:33', NULL, 'pending', 0, 0, 0, 0, 4, NULL, NULL),
(51, 39, NULL, 'Idea 34 testing', 'Idea 34 testing', 'uploads/1671511232_Dirt-3-HD-1280-x-1024-Wallpaper-620x496.jpg', NULL, '2022-12-20 04:40:32', '2022-12-20 04:40:32', NULL, 'pending', 0, 0, 0, 0, 5, NULL, NULL),
(52, 33, NULL, 'Cost Saving for ITV running in Terminals', 'If we add GPS system in ITV and their running is crosschecked with the Report of the Fuel Consumed then we can get the actual efficiency and guide the ITV with most optimal Path.', 'uploads/1671516893_image (7).png', NULL, '2022-12-20 06:04:33', '2023-01-08 13:01:24', NULL, 'implementation', 1, 1, 0, 0, 7, NULL, NULL),
(53, 23, 'tHAjFVzAnZ1672205680', 'Testing multiple image upload', 'Testing multiple image upload', NULL, NULL, '2022-12-28 05:34:43', '2022-12-28 05:34:43', NULL, 'pending', 0, 0, 0, 0, 1, NULL, NULL),
(54, 23, 'xzryBkxibc1672205861', 'Testing multiple files upload 2', 'Testing multiple files upload 2', NULL, NULL, '2022-12-28 05:37:44', '2022-12-28 05:37:44', NULL, 'pending', 0, 0, 0, 0, 4, NULL, NULL),
(55, 23, 'PiNKRHeUOd1672206076', 'Testing multiple files upload 3', 'Testing multiple files upload 3', NULL, NULL, '2022-12-28 05:41:19', '2022-12-28 05:41:19', NULL, 'pending', 0, 0, 0, 0, 5, NULL, NULL),
(56, 9, 'kVEqgluQSx1672209740', 'test', 'test', NULL, NULL, '2022-12-28 06:42:20', '2022-12-28 06:42:20', NULL, 'pending', 0, 0, 0, 0, 5, NULL, NULL),
(57, 23, 'fgzeyJUSAn1672214628', 'test 22', 'test 22', NULL, NULL, '2022-12-28 08:03:48', '2022-12-28 08:03:48', NULL, 'pending', 0, 0, 0, 0, 5, NULL, NULL),
(58, 23, 'uFXewlwYOi1672216720', 'Test doc', 'Test doc', NULL, NULL, '2022-12-28 08:38:40', '2022-12-28 08:38:40', NULL, 'pending', 0, 0, 0, 0, 5, NULL, NULL),
(59, 33, 'OrbkCiWQqX1672392041', 'change  in      process', 'change  in      process', NULL, NULL, '2022-12-30 09:20:41', '2022-12-30 09:21:01', '2022-12-30 09:21:01', 'pending', 0, 0, 0, 0, 6, NULL, NULL),
(60, 33, 'RMWDCfOsBj1672393501', 'cost saving in IT Expenses', 'using open softwares to reduce cost', NULL, NULL, '2022-12-30 09:45:01', '2023-01-02 07:06:30', NULL, 'resubmit', 1, 0, 0, 0, 7, NULL, 'attachment not clear'),
(61, 23, 'fPXOggIOCA1672651690', 'Test Idea 9999', 'Test Idea 9999', NULL, NULL, '2023-01-02 09:28:10', '2023-01-02 09:28:10', NULL, 'pending', 0, 0, 0, 0, 7, NULL, NULL),
(62, 23, 'DNAQEaalYM1672653453', 'Testing Text', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, NULL, '2023-01-02 09:57:33', '2023-01-02 09:57:33', NULL, 'pending', 0, 0, 0, 0, 5, NULL, NULL),
(63, 23, 'bmCtzlHIxv1672653698', 'Hello World', 'Hello World', NULL, NULL, '2023-01-02 10:01:38', '2023-01-02 10:05:42', NULL, 'implemented', 1, 1, 1, 0, 1, NULL, NULL),
(64, 23, 'HmvmXJooyB1672745944', 'Test 999', 'Test 999', NULL, NULL, '2023-01-03 11:39:04', '2023-01-03 11:39:04', NULL, 'pending', 0, 0, 0, 0, 6, NULL, NULL),
(65, 23, 'opkTDYRfqG1672746045', 'Idea testing 9999', 'Idea testing 9999', NULL, NULL, '2023-01-03 11:40:45', '2023-01-03 11:40:45', NULL, 'pending', 0, 0, 0, 0, 5, NULL, NULL),
(66, 23, 'nEeHnoozWj1672829040', 'new Idea For testing 001', 'new Idea For testing 001', NULL, 1, '2023-01-04 10:44:00', '2023-01-04 10:57:04', NULL, 'implemented', 1, 1, 1, 0, 5, NULL, 'Kindly provide detailed description'),
(67, 23, 'CqjKvdAIKl1673326027', 'Testing 01', 'Testing 01', NULL, NULL, '2023-01-10 04:47:07', '2023-01-10 04:47:07', NULL, 'pending', 0, 0, 0, 0, 6, NULL, NULL),
(68, 23, 'cYlxQCdyGx1673326078', 'Testing 02', 'Testing 02', NULL, NULL, '2023-01-10 04:47:58', '2023-01-10 04:50:33', NULL, 'implemented', 1, 1, 1, 0, 5, NULL, NULL),
(69, 23, 'HgrnGfompN1673347334', 'idea Test with No files', 'idea Test with No files', NULL, NULL, '2023-01-10 10:42:14', '2023-01-10 10:42:14', NULL, 'pending', 0, 0, 0, 0, 5, NULL, NULL),
(70, 23, 'okpwBHjydg1673500675', 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in magna a sapien condimentum tincidunt vitae sed quam. Donec eget sodales urna, ac ultrices turpis. Aliquam posuere non diam eget rutrum. Integer magna lorem, vehicula vel lorem eget, convallis sodales est. Curabitur odio dolor, ullamcorper eget dui sit amet, molestie tincidunt turpis. Sed eget eros euismod elit faucibus pharetra non ac sem. Mauris a semper leo, nec tincidunt ipsum. Proin id laoreet odio. Morbi ornare a augue id aliquam.\r\n\r\nDonec scelerisque a turpis id mollis. Nunc vehicula sollicitudin sagittis. Aliquam velit lectus, aliquam vitae sagittis ut, laoreet sit amet tellus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quam magna, scelerisque eget elementum sed, vestibulum at neque. Mauris id quam nec ipsum rhoncus sollicitudin. In non leo vel neque dapibus commodo. Suspendisse mollis dui massa, in semper justo cursus id. Sed dignissim ipsum at hendrerit interdum. Proin non fermentum ipsum. In hac habitasse platea dictumst. Pellentesque tristique augue id tortor lobortis tristique.\r\n\r\nPhasellus tincidunt auctor felis, eu iaculis augue molestie eget. Vestibulum a justo aliquam, mollis ante ut, pretium elit. Sed id nunc maximus, accumsan lectus quis, tincidunt eros. Integer a felis convallis, fermentum leo ut, eleifend magna. Praesent congue laoreet turpis quis auctor. Quisque vel posuere nibh. Suspendisse libero sem, efficitur a ipsum in, rutrum luctus tellus. Integer a ipsum in mi egestas auctor. Ut in tellus sit amet neque tempor lobortis eget vel felis. Nullam consequat placerat justo id dignissim. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque non tincidunt lectus. Vivamus vulputate vitae libero nec scelerisque. Pellentesque aliquam ex vitae auctor sagittis.\r\n\r\nAliquam lacinia nunc quis varius tempus. Praesent ac ligula ut massa posuere cursus sit amet at elit. Curabitur vehicula tortor odio, ut condimentum mauris luctus ac. Vivamus auctor velit non efficitur tempor. Morbi non turpis sed nunc eleifend volutpat eu vel leo. Suspendisse feugiat non ante at semper. Cras nec justo posuere, lobortis est et, condimentum arcu. Mauris sit amet interdum massa. Nam ornare tristique velit nec pellentesque. Integer auctor dolor non pulvinar accumsan.', NULL, NULL, '2023-01-12 05:17:55', '2023-01-12 05:25:49', NULL, 'in_assessment', 1, 0, 0, 0, 5, NULL, 'Submit a clear Image file');

-- --------------------------------------------------------

--
-- Table structure for table `idea_active_status`
--

CREATE TABLE `idea_active_status` (
  `idea_active_status_id` int(11) NOT NULL,
  `idea_active_status` varchar(200) DEFAULT NULL,
  `idea_active_status_value` varchar(200) DEFAULT NULL,
  `assessment_team` int(11) DEFAULT NULL,
  `approving_authority` int(11) DEFAULT NULL,
  `implementation_team` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `idea_active_status`
--

INSERT INTO `idea_active_status` (`idea_active_status_id`, `idea_active_status`, `idea_active_status_value`, `assessment_team`, `approving_authority`, `implementation_team`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pending', 'pending', 1, 0, 0, '2022-11-24 06:24:59', NULL, NULL),
(2, 'Under Assessment', 'in_assessment', 1, 1, 0, '2022-11-24 06:24:59', NULL, NULL),
(3, 'Under Approval', 'under_approving_authority', 0, 1, 1, '2022-11-24 06:24:59', NULL, NULL),
(4, 'Rejected', 'reject', 1, 1, 0, '2022-11-24 06:24:59', NULL, NULL),
(5, 'Implementation', 'implementation', 0, 0, 1, '2022-11-24 06:24:59', NULL, NULL),
(6, 'On-hold', 'on_hold', 1, 1, 0, '2022-11-24 06:24:59', NULL, NULL),
(7, 'Revise Request', 'resubmit', 1, 1, 0, '2022-11-24 06:24:59', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `idea_feedback`
--

CREATE TABLE `idea_feedback` (
  `feedback_id` int(11) NOT NULL,
  `idea_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `feedback` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `active_status` int(11) DEFAULT NULL,
  `user_role` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `idea_feedback`
--

INSERT INTO `idea_feedback` (`feedback_id`, `idea_id`, `user_id`, `feedback`, `created_at`, `updated_at`, `deleted_at`, `active_status`, `user_role`) VALUES
(1, 3, 1, 'Hello user', '2022-10-28 11:18:54', '2022-10-28 11:18:54', NULL, NULL, 'admin'),
(2, 3, 8, 'Hello Aa', '2022-10-29 05:48:38', '2022-10-29 05:48:38', NULL, NULL, 'Assessment Team'),
(3, 3, 1, 'Hello', '2022-10-29 05:50:24', '2022-10-29 05:50:24', NULL, NULL, 'admin'),
(4, 6, 8, 'Hello Rahul', '2022-10-29 09:58:53', '2022-10-29 09:58:53', NULL, NULL, 'Assessment Team'),
(5, 6, 16, 'Hello mam', '2022-10-29 10:07:07', '2022-10-29 10:07:07', NULL, NULL, 'User'),
(6, 6, 1, 'Hello Rahul', '2022-10-29 10:10:08', '2022-10-29 10:10:08', NULL, NULL, 'admin'),
(7, 6, 1, 'Hello Everyone', '2022-10-29 10:26:17', '2022-10-29 10:26:17', NULL, NULL, 'Assessment Team'),
(8, 6, 16, 'Hello Sir', '2022-10-29 10:29:22', '2022-10-29 10:29:22', NULL, NULL, 'User'),
(9, 4, 1, 'Hello Rahul', '2022-10-29 12:55:00', '2022-10-29 12:55:00', NULL, NULL, 'Assessment Team'),
(10, 4, 16, 'Hello sir how are you ?', '2022-10-29 12:56:36', '2022-10-29 12:56:36', NULL, NULL, 'User'),
(11, 4, 1, 'I liked your idea', '2022-10-29 12:58:32', '2022-10-29 12:58:32', NULL, NULL, 'Assessment Team'),
(12, 4, 1, 'Lily has submitted it for approval to Approving authority', '2022-10-29 12:59:03', '2022-10-29 12:59:03', NULL, NULL, 'Assessment Team'),
(13, 4, 1, 'I am fine by the way thank you for asking Rahul', '2022-10-29 12:59:53', '2022-10-29 12:59:53', NULL, NULL, 'Assessment Team'),
(14, 4, 16, 'Okay sir', '2022-10-29 13:00:02', '2022-10-29 13:00:02', NULL, NULL, 'User'),
(15, 4, 16, 'When the status is going to change of my Idea?', '2022-10-29 13:00:28', '2022-10-29 13:00:28', NULL, NULL, 'User'),
(16, 4, 8, 'Hello Rahul\r\nThe status will be changed soon by the Approving Authority', '2022-10-29 13:02:15', '2022-10-29 13:02:15', NULL, NULL, 'Assessment Team'),
(17, 4, 16, 'Okay mam, thank you', '2022-10-29 13:02:52', '2022-10-29 13:02:52', NULL, NULL, 'User'),
(18, 4, 1, 'Hello Rahul', '2022-10-29 13:04:07', '2022-10-29 13:04:07', NULL, NULL, 'admin'),
(19, 4, 1, 'Can you describe more about the Idea you have posted?', '2022-10-29 13:08:19', '2022-10-29 13:08:19', NULL, NULL, 'admin'),
(20, 4, 16, 'Yes sir, Why not', '2022-10-29 13:09:20', '2022-10-29 13:09:20', NULL, NULL, 'User'),
(21, 4, 16, 'I will send a document here which contains the explanation of this Idea', '2022-10-29 13:10:12', '2022-10-29 13:10:12', NULL, NULL, 'User'),
(22, 4, 16, 'Give me one day I will share the document', '2022-10-29 13:10:54', '2022-10-29 13:10:54', NULL, NULL, 'User'),
(23, 4, 16, 'okay?', '2022-10-29 13:11:14', '2022-10-29 13:11:14', NULL, NULL, 'User'),
(24, 4, 1, 'Yeah, It will be okay', '2022-10-29 13:11:34', '2022-10-29 13:11:34', NULL, NULL, 'admin'),
(25, 4, 16, 'okay sir', '2022-10-29 13:12:00', '2022-10-29 13:12:00', NULL, NULL, 'User'),
(26, 7, 16, 'Hello Assessment Team', '2022-11-01 05:46:27', '2022-11-01 05:46:27', NULL, NULL, 'User'),
(27, 7, 1, 'Hello Rahul', '2022-11-01 05:50:29', '2022-11-01 05:50:29', NULL, NULL, 'Assessment Team'),
(28, 7, 1, 'Hello Rahul', '2022-11-01 05:50:50', '2022-11-01 05:50:50', NULL, NULL, 'admin'),
(29, 7, 16, 'Can you review my Idea?', '2022-11-01 06:03:37', '2022-11-01 06:03:37', NULL, NULL, 'User'),
(30, 7, 1, 'Yes soon we will change its status to in-assessment', '2022-11-01 06:04:16', '2022-11-01 06:04:16', NULL, NULL, 'Assessment Team'),
(31, 7, 16, 'Okay sir', '2022-11-01 06:04:32', '2022-11-01 06:04:32', NULL, NULL, 'User'),
(32, 7, 1, 'I coordinated with my team members and Everyone seems to like your Idea', '2022-11-01 06:06:01', '2022-11-01 06:06:01', NULL, NULL, 'Assessment Team'),
(33, 7, 1, 'We will send it for approval to approving authority', '2022-11-01 06:06:33', '2022-11-01 06:06:33', NULL, NULL, 'Assessment Team'),
(34, 7, 16, 'Thankyou very much sir', '2022-11-01 06:06:53', '2022-11-01 06:06:53', NULL, NULL, 'User'),
(35, 10, 103, 'Hello Annie', '2022-11-01 08:06:49', '2022-11-01 08:06:49', NULL, NULL, 'Assessment Team'),
(36, 10, 102, 'Hello Sir', '2022-11-01 08:06:58', '2022-11-01 08:06:58', NULL, NULL, 'User'),
(37, 10, 103, 'Your Idea seems good', '2022-11-01 08:07:19', '2022-11-01 08:07:19', NULL, NULL, 'Assessment Team'),
(38, 10, 102, 'Thank you sir', '2022-11-01 08:07:27', '2022-11-01 08:07:27', NULL, NULL, 'User'),
(39, 10, 103, 'I am sending it for the further approval', '2022-11-01 08:07:43', '2022-11-01 08:07:43', NULL, NULL, 'Assessment Team'),
(40, 10, 102, 'Thank you sir', '2022-11-01 08:07:53', '2022-11-01 08:07:53', NULL, NULL, 'User'),
(41, 10, 1, 'Very good Idea, \r\nGood work Annie', '2022-11-01 08:08:33', '2022-11-01 08:08:33', NULL, NULL, 'admin'),
(42, 10, 103, 'Done, Now approving authority will look at your Idea and decide what should be done', '2022-11-01 08:10:04', '2022-11-01 08:10:04', NULL, NULL, 'Assessment Team'),
(43, 10, 102, 'Thank you Admin', '2022-11-01 08:10:18', '2022-11-01 08:10:18', NULL, NULL, 'User'),
(44, 10, 102, 'Okay sir', '2022-11-01 08:10:26', '2022-11-01 08:10:26', NULL, NULL, 'User'),
(45, 12, 103, 'Sorry this idea cannot be approved, \r\nAppreciate your efforts, \r\nkeep suggesting', '2022-11-01 08:28:30', '2022-11-01 08:28:30', NULL, NULL, 'Assessment Team'),
(46, 12, 102, 'Okay sir no problem', '2022-11-01 08:28:57', '2022-11-01 08:28:57', NULL, NULL, 'User'),
(47, 14, 15, 'Please change the idea', '2022-11-01 10:07:34', '2022-11-01 10:07:34', NULL, NULL, 'Assessment Team'),
(48, 14, 9, 'I have changed the idea, kindly check', '2022-11-01 10:08:33', '2022-11-01 10:08:33', NULL, NULL, 'User'),
(49, 14, 15, 'Ok, thank you for the updates. I will recheck it and let you know if any further changes are required.', '2022-11-01 10:10:26', '2022-11-01 10:10:26', NULL, NULL, 'Assessment Team'),
(50, 14, 15, 'Thank You Vijay, your idea is perfect now. I am submitting it further for approval.', '2022-11-01 10:13:39', '2022-11-01 10:13:39', NULL, NULL, 'Assessment Team'),
(51, 14, 9, 'Thank You very much', '2022-11-01 10:15:22', '2022-11-01 10:15:22', NULL, NULL, 'User'),
(52, 15, 17, 'Hello Kenny', '2022-11-02 13:11:58', '2022-11-02 13:11:58', NULL, NULL, 'Assessment Team'),
(53, 15, 16, 'Hello', '2022-11-02 13:12:14', '2022-11-02 13:12:14', NULL, NULL, 'User'),
(54, 15, 17, 'I reviewed your Idea and it seems good', '2022-11-02 13:12:47', '2022-11-02 13:12:47', NULL, NULL, 'Assessment Team'),
(55, 15, 16, 'Thank you', '2022-11-02 13:13:11', '2022-11-02 13:13:11', NULL, NULL, 'User'),
(56, 15, 17, 'I am sending it for the approval to the approving authority', '2022-11-02 13:13:56', '2022-11-02 13:13:56', NULL, NULL, 'Assessment Team'),
(57, 15, 16, 'Okay', '2022-11-02 13:14:08', '2022-11-02 13:14:08', NULL, NULL, 'User'),
(58, 19, 17, 'Hello User', '2022-11-04 05:44:28', '2022-11-04 05:44:28', NULL, NULL, 'Assessment Team'),
(59, 19, 9, 'Hello Assessment team', '2022-11-04 05:44:51', '2022-11-04 05:44:51', NULL, NULL, 'User'),
(60, 19, 20, 'Test', '2022-11-21 10:27:25', '2022-11-21 10:27:25', NULL, NULL, 'Approving Authority'),
(61, 27, 22, 'Please upload the Clear Image', '2022-11-23 11:13:20', '2022-11-23 11:13:20', NULL, NULL, 'Assessment Team'),
(62, 27, 21, 'Okay sir', '2022-11-23 11:13:30', '2022-11-23 11:13:30', NULL, NULL, 'User'),
(63, 27, 21, 'done sir', '2022-11-23 11:14:27', '2022-11-23 11:14:27', NULL, NULL, 'User'),
(64, 27, 22, 'Okay let me check', '2022-11-23 11:14:49', '2022-11-23 11:14:49', NULL, NULL, 'Assessment Team'),
(65, 27, 21, 'We have sent the Idea for the Approval to approving authority', '2022-11-23 11:16:06', '2022-11-23 11:16:06', NULL, NULL, 'User'),
(66, 27, 21, 'They will soon change the status of the Idea', '2022-11-23 11:16:24', '2022-11-23 11:16:24', NULL, NULL, 'User'),
(67, 27, 21, 'Okay sir', '2022-11-23 11:16:44', '2022-11-23 11:16:44', NULL, NULL, 'User'),
(68, 24, 19, 'testingg', '2022-11-24 05:14:33', '2022-11-24 05:14:33', NULL, NULL, 'Assessment Team'),
(69, 14, 19, 'testinggggggg', '2022-11-24 11:52:04', '2022-11-24 11:52:04', NULL, NULL, 'Assessment Team'),
(70, 29, 22, 'Hello Ken', '2022-11-29 10:51:38', '2022-11-29 10:51:38', NULL, NULL, 'Assessment Team'),
(71, 29, 23, 'Hello sir', '2022-11-29 10:51:50', '2022-11-29 10:51:50', NULL, NULL, 'User'),
(72, 29, 23, 'done sir', '2022-11-29 10:54:04', '2022-11-29 10:54:04', NULL, NULL, 'User'),
(73, 29, 22, 'Okay', '2022-11-29 10:54:25', '2022-11-29 10:54:25', NULL, NULL, 'Assessment Team'),
(74, 29, 25, 'Sorry but I think this is idea is not preferable', '2022-11-29 10:58:58', '2022-11-29 10:58:58', NULL, NULL, 'Approving Authority'),
(75, 31, 22, 'Hello', '2022-11-30 05:24:22', '2022-11-30 05:24:22', NULL, NULL, 'Assessment Team'),
(76, 31, 22, 'Kindly upload an Image explaining your Idea visually', '2022-11-30 05:24:52', '2022-11-30 05:24:52', NULL, NULL, 'Assessment Team'),
(77, 31, 22, 'Doc or Pdf is also acceptable', '2022-11-30 05:25:08', '2022-11-30 05:25:08', NULL, NULL, 'Assessment Team'),
(78, 31, 23, 'Okay sir', '2022-11-30 05:25:29', '2022-11-30 05:25:29', NULL, NULL, 'User'),
(79, 31, 25, 'can you please resubmit the Idea with proper pdf file', '2022-11-30 05:43:07', '2022-11-30 05:43:07', NULL, NULL, 'Approving Authority'),
(80, 31, 23, 'Yes sure', '2022-11-30 05:43:25', '2022-11-30 05:43:25', NULL, NULL, 'User'),
(81, 31, 23, 'done', '2022-11-30 05:49:06', '2022-11-30 05:49:06', NULL, NULL, 'User'),
(82, 31, 25, 'okay', '2022-11-30 05:49:46', '2022-11-30 05:49:46', NULL, NULL, 'Approving Authority'),
(83, 32, 27, 'can be implementd with modification', '2022-12-05 07:20:16', '2022-12-05 07:20:16', NULL, NULL, 'Approving Authority'),
(84, 32, 27, 'can be implementd with modification', '2022-12-05 07:20:17', '2022-12-05 07:20:17', NULL, NULL, 'Approving Authority'),
(85, 38, 30, 'Test Comment', '2022-12-08 05:27:36', '2022-12-08 05:27:36', NULL, NULL, 'Assessment Team'),
(86, 39, 30, 'test', '2022-12-08 06:38:20', '2022-12-08 06:38:20', NULL, NULL, 'Assessment Team'),
(87, 39, 29, 'yes', '2022-12-08 06:38:37', '2022-12-08 06:38:37', NULL, NULL, 'User'),
(88, 41, 36, 'Approvers Comments', '2022-12-13 05:54:59', '2022-12-13 05:54:59', NULL, NULL, 'Approving Authority'),
(89, 41, 36, 'to be processed', '2022-12-13 05:58:07', '2022-12-13 05:58:07', NULL, NULL, 'Approving Authority'),
(90, 40, 35, 'can be implemented', '2022-12-13 06:00:46', '2022-12-13 06:00:46', NULL, NULL, 'Implementation'),
(91, 28, 23, 'Leaf Hurricane', '2022-12-14 09:08:41', '2022-12-14 09:08:41', NULL, NULL, 'User'),
(92, 28, 21, 'Guy Sensei', '2022-12-14 09:09:02', '2022-12-14 09:09:02', NULL, NULL, 'Assessment Team'),
(93, 41, 33, 'to be implemented', '2022-12-16 07:35:29', '2022-12-16 07:35:29', NULL, NULL, 'User'),
(94, 45, 34, 'to be processed', '2022-12-16 07:51:10', '2022-12-16 07:51:10', NULL, NULL, 'Assessment Team'),
(95, 45, 36, 'to be processed', '2022-12-16 07:52:10', '2022-12-16 07:52:10', NULL, NULL, 'Approving Authority'),
(96, 65, 1, 'Hello user', '2023-01-04 08:08:19', '2023-01-04 08:08:19', NULL, NULL, 'admin'),
(97, 66, 21, 'Idea seems good to me', '2023-01-04 10:45:18', '2023-01-04 10:45:18', NULL, NULL, 'Assessment Team'),
(98, 66, 23, 'I have updated the idea with detailed description', '2023-01-04 10:48:25', '2023-01-04 10:48:25', NULL, NULL, 'User'),
(99, 66, 25, 'I am approving the Idea', '2023-01-04 10:53:06', '2023-01-04 10:53:06', NULL, NULL, 'Approving Authority'),
(100, 70, 21, 'Hello Ken', '2023-01-12 05:19:42', '2023-01-12 05:19:42', NULL, NULL, 'Assessment Team'),
(101, 70, 21, 'Your Idea seems good to me', '2023-01-12 05:19:57', '2023-01-12 05:19:57', NULL, NULL, 'Assessment Team'),
(102, 70, 23, 'Hello', '2023-01-12 05:20:27', '2023-01-12 05:20:27', NULL, NULL, 'User'),
(103, 70, 23, 'Thank you sir', '2023-01-12 05:20:38', '2023-01-12 05:20:38', NULL, NULL, 'User'),
(104, 70, 21, 'can you please upload a clear image', '2023-01-12 05:21:24', '2023-01-12 05:21:24', NULL, NULL, 'Assessment Team'),
(105, 70, 23, 'done sir', '2023-01-12 05:24:43', '2023-01-12 05:24:43', NULL, NULL, 'User'),
(106, 70, 21, 'Okay', '2023-01-12 05:24:59', '2023-01-12 05:24:59', NULL, NULL, 'Assessment Team');

-- --------------------------------------------------------

--
-- Table structure for table `idea_images`
--

CREATE TABLE `idea_images` (
  `image_id` int(11) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `idea_uni_id` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `idea_images`
--

INSERT INTO `idea_images` (`image_id`, `file_name`, `idea_uni_id`, `image_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1672205680_image.png', 'tHAjFVzAnZ1672205680', 'uploads/1672205680_image.png', '2022-12-28 05:34:40', '2022-12-28 05:34:40', NULL),
(2, '1672205680_1667291140_1666169006_file-sample_100kB.doc', 'tHAjFVzAnZ1672205680', 'uploads/1672205680_1667291140_1666169006_file-sample_100kB.doc', '2022-12-28 05:34:40', '2022-12-28 05:34:40', NULL),
(3, '1672205680_1662053761631.jpg', 'tHAjFVzAnZ1672205680', 'uploads/1672205680_1662053761631.jpg', '2022-12-28 05:34:40', '2022-12-28 05:34:40', NULL),
(4, '1672205680_g-h.ghd.jpg', 'tHAjFVzAnZ1672205680', 'uploads/1672205680_g-h.ghd.jpg', '2022-12-28 05:34:40', '2022-12-28 05:34:40', NULL),
(5, '1672205680_street_night_wet_155637_1280x1024.jpg', 'tHAjFVzAnZ1672205680', 'uploads/1672205680_street_night_wet_155637_1280x1024.jpg', '2022-12-28 05:34:40', '2022-12-28 05:34:40', NULL),
(6, '1672205681_1662089829671.pdf', 'tHAjFVzAnZ1672205680', 'uploads/1672205681_1662089829671.pdf', '2022-12-28 05:34:43', '2022-12-28 05:34:43', NULL),
(7, '1672205861_testing.jpg', 'xzryBkxibc1672205861', 'uploads/1672205861_testing.jpg', '2022-12-28 05:37:41', '2022-12-28 05:37:41', NULL),
(8, '1672205861_1672122674_1667370956_1666169006_file-sample_100kB (2).doc', 'xzryBkxibc1672205861', 'uploads/1672205861_1672122674_1667370956_1666169006_file-sample_100kB (2).doc', '2022-12-28 05:37:41', '2022-12-28 05:37:41', NULL),
(9, '1672205861_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', 'xzryBkxibc1672205861', 'uploads/1672205861_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', '2022-12-28 05:37:41', '2022-12-28 05:37:41', NULL),
(10, '1672205861_1662053761631.jpg', 'xzryBkxibc1672205861', 'uploads/1672205861_1662053761631.jpg', '2022-12-28 05:37:41', '2022-12-28 05:37:41', NULL),
(11, '1672205861_1662089829671.pdf', 'xzryBkxibc1672205861', 'uploads/1672205861_1662089829671.pdf', '2022-12-28 05:37:44', '2022-12-28 05:37:44', NULL),
(12, '1672206076_1667291140_1666169006_file-sample_100kB.doc', 'PiNKRHeUOd1672206076', 'uploads/1672206076_1667291140_1666169006_file-sample_100kB.doc', '2022-12-28 05:41:16', '2022-12-28 05:41:16', NULL),
(13, '1672206076_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', 'PiNKRHeUOd1672206076', 'uploads/1672206076_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', '2022-12-28 05:41:16', '2022-12-28 05:41:16', NULL),
(14, '1672206076_street_night_wet_155637_1280x1024.jpg', 'PiNKRHeUOd1672206076', 'uploads/1672206076_street_night_wet_155637_1280x1024.jpg', '2022-12-28 05:41:16', '2022-12-28 05:41:16', NULL),
(18, '1672206334_Dirt-3-HD-1280-x-1024-Wallpaper-620x496.jpg', 'PiNKRHeUOd1672206076', 'uploads/1672206334_Dirt-3-HD-1280-x-1024-Wallpaper-620x496.jpg', '2022-12-28 05:45:34', '2022-12-28 05:45:34', NULL),
(16, '1672206077_g-h.ghd.jpg', 'PiNKRHeUOd1672206076', 'uploads/1672206077_g-h.ghd.jpg', '2022-12-28 05:41:17', '2022-12-28 05:41:17', NULL),
(17, '1672206077_1662089829671.pdf', 'PiNKRHeUOd1672206076', 'uploads/1672206077_1662089829671.pdf', '2022-12-28 05:41:19', '2022-12-28 05:41:19', NULL),
(19, '1672206334_5650530.png', 'PiNKRHeUOd1672206076', 'uploads/1672206334_5650530.png', '2022-12-28 05:45:34', '2022-12-28 05:45:34', NULL),
(23, '1672212872_signature.jpg', 'kVEqgluQSx1672209740', 'uploads/1672212872_signature.jpg', '2022-12-28 07:34:32', '2022-12-28 07:34:32', NULL),
(26, '1672215642_PIM_feature_release_page_Copy.docx', 'kVEqgluQSx1672209740', 'uploads/1672215642_PIM_feature_release_page_Copy.docx', '2022-12-28 08:20:42', '2022-12-28 08:20:42', NULL),
(25, '1672214628_Laravel_Notes.pdf', 'fgzeyJUSAn1672214628', 'uploads/1672214628_Laravel_Notes.pdf', '2022-12-28 08:03:48', '2022-12-28 08:03:48', NULL),
(27, '1672216720_1667291140_1666169006_file-sample_100kB.doc', 'uFXewlwYOi1672216720', 'uploads/1672216720_1667291140_1666169006_file-sample_100kB.doc', '2022-12-28 08:38:40', '2022-12-28 08:38:40', NULL),
(35, '1672653453_fusion.png', 'DNAQEaalYM1672653453', 'uploads/1672653453_fusion.png', '2023-01-02 09:57:35', '2023-01-02 09:57:35', NULL),
(34, '1672642050_unnamed.png', 'RMWDCfOsBj1672393501', 'uploads/1672642050_unnamed.png', '2023-01-02 06:47:31', '2023-01-02 06:47:31', NULL),
(36, '1672653455_Gogeta_&_Broly.png', 'DNAQEaalYM1672653453', 'uploads/1672653455_Gogeta_&_Broly.png', '2023-01-02 09:57:35', '2023-01-02 09:57:35', NULL),
(37, '1672653455_fusion_2.png', 'DNAQEaalYM1672653453', 'uploads/1672653455_fusion_2.png', '2023-01-02 09:57:38', '2023-01-02 09:57:38', NULL),
(38, '1672653698_Screenshot_20221230_120413.png', 'bmCtzlHIxv1672653698', 'uploads/1672653698_Screenshot_20221230_120413.png', '2023-01-02 10:01:38', '2023-01-02 10:01:38', NULL),
(39, '1672653698_exchange-dollar-line.png', 'bmCtzlHIxv1672653698', 'uploads/1672653698_exchange-dollar-line.png', '2023-01-02 10:01:38', '2023-01-02 10:01:38', NULL),
(40, '1672653698_linkedin-app_2.png', 'bmCtzlHIxv1672653698', 'uploads/1672653698_linkedin-app_2.png', '2023-01-02 10:01:38', '2023-01-02 10:01:38', NULL),
(41, '1672653698_home-gear-line.png', 'bmCtzlHIxv1672653698', 'uploads/1672653698_home-gear-line.png', '2023-01-02 10:01:39', '2023-01-02 10:01:39', NULL),
(42, '1672653699_Location.png', 'bmCtzlHIxv1672653698', 'uploads/1672653699_Location.png', '2023-01-02 10:01:39', '2023-01-02 10:01:39', NULL),
(43, '1672745944_street_night_wet_155637_1280x1024.jpg', 'HmvmXJooyB1672745944', 'uploads/1672745944_street_night_wet_155637_1280x1024.jpg', '2023-01-03 11:39:05', '2023-01-03 11:39:05', NULL),
(44, '1672745945_g-h.ghd.jpg', 'HmvmXJooyB1672745944', 'uploads/1672745945_g-h.ghd.jpg', '2023-01-03 11:39:05', '2023-01-03 11:39:05', NULL),
(45, '1672745945_testing.jpg', 'HmvmXJooyB1672745944', 'uploads/1672745945_testing.jpg', '2023-01-03 11:39:07', '2023-01-03 11:39:07', NULL),
(46, '1672745973_photo_2022-09-05_14-26-07.jpg', 'HmvmXJooyB1672745944', 'uploads/1672745973_photo_2022-09-05_14-26-07.jpg', '2023-01-03 11:39:33', '2023-01-03 11:39:33', NULL),
(47, '1672745973_1662053761631.jpg', 'HmvmXJooyB1672745944', 'uploads/1672745973_1662053761631.jpg', '2023-01-03 11:39:33', '2023-01-03 11:39:33', NULL),
(48, '1672746045_fff&text=+1280x1024+.png', 'opkTDYRfqG1672746045', 'uploads/1672746045_fff&text=+1280x1024+.png', '2023-01-03 11:40:45', '2023-01-03 11:40:45', NULL),
(49, '1672829040_1672122674_1667370956_1666169006_file-sample_100kB_(2).doc', 'nEeHnoozWj1672829040', 'uploads/1672829040_1672122674_1667370956_1666169006_file-sample_100kB_(2).doc', '2023-01-04 10:44:01', '2023-01-04 10:44:01', NULL),
(50, '1672829041_testing.jpg', 'nEeHnoozWj1672829040', 'uploads/1672829041_testing.jpg', '2023-01-04 10:44:01', '2023-01-04 10:44:01', NULL),
(51, '1672829041_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', 'nEeHnoozWj1672829040', 'uploads/1672829041_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', '2023-01-04 10:44:01', '2023-01-04 10:44:01', NULL),
(52, '1672829041_Dirt-3-HD-1280-x-1024-Wallpaper-620x496.jpg', 'nEeHnoozWj1672829040', 'uploads/1672829041_Dirt-3-HD-1280-x-1024-Wallpaper-620x496.jpg', '2023-01-04 10:44:01', '2023-01-04 10:44:01', NULL),
(53, '1672829041_street_night_wet_155637_1280x1024.jpg', 'nEeHnoozWj1672829040', 'uploads/1672829041_street_night_wet_155637_1280x1024.jpg', '2023-01-04 10:44:03', '2023-01-04 10:44:03', NULL),
(54, '1672829043_g-h.ghd.jpg', 'nEeHnoozWj1672829040', 'uploads/1672829043_g-h.ghd.jpg', '2023-01-04 10:44:03', '2023-01-04 10:44:03', NULL),
(55, '1672829043_1662053761631.jpg', 'nEeHnoozWj1672829040', 'uploads/1672829043_1662053761631.jpg', '2023-01-04 10:44:03', '2023-01-04 10:44:03', NULL),
(56, '1672829043_1662089829671.pdf', 'nEeHnoozWj1672829040', 'uploads/1672829043_1662089829671.pdf', '2023-01-04 10:44:07', '2023-01-04 10:44:07', NULL),
(57, '1673326027_testing.jpg', 'CqjKvdAIKl1673326027', 'uploads/1673326027_testing.jpg', '2023-01-10 04:47:07', '2023-01-10 04:47:07', NULL),
(58, '1673326027_1667291140_1666169006_file-sample_100kB.doc', 'CqjKvdAIKl1673326027', 'uploads/1673326027_1667291140_1666169006_file-sample_100kB.doc', '2023-01-10 04:47:08', '2023-01-10 04:47:08', NULL),
(59, '1673326028_g-h.ghd.jpg', 'CqjKvdAIKl1673326027', 'uploads/1673326028_g-h.ghd.jpg', '2023-01-10 04:47:08', '2023-01-10 04:47:08', NULL),
(60, '1673326028_1662053761631.jpg', 'CqjKvdAIKl1673326027', 'uploads/1673326028_1662053761631.jpg', '2023-01-10 04:47:08', '2023-01-10 04:47:08', NULL),
(61, '1673326028_Dirt-3-HD-1280-x-1024-Wallpaper-620x496.jpg', 'CqjKvdAIKl1673326027', 'uploads/1673326028_Dirt-3-HD-1280-x-1024-Wallpaper-620x496.jpg', '2023-01-10 04:47:08', '2023-01-10 04:47:08', NULL),
(62, '1673326028_street_night_wet_155637_1280x1024.jpg', 'CqjKvdAIKl1673326027', 'uploads/1673326028_street_night_wet_155637_1280x1024.jpg', '2023-01-10 04:47:09', '2023-01-10 04:47:09', NULL),
(63, '1673326029_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', 'CqjKvdAIKl1673326027', 'uploads/1673326029_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', '2023-01-10 04:47:09', '2023-01-10 04:47:09', NULL),
(64, '1673326029_1280-x-1024-Space-Wallpaper.jpg', 'CqjKvdAIKl1673326027', 'uploads/1673326029_1280-x-1024-Space-Wallpaper.jpg', '2023-01-10 04:47:11', '2023-01-10 04:47:11', NULL),
(65, '1673326031_5650530.png', 'CqjKvdAIKl1673326027', 'uploads/1673326031_5650530.png', '2023-01-10 04:47:11', '2023-01-10 04:47:11', NULL),
(66, '1673326031_3053649.jpg', 'CqjKvdAIKl1673326027', 'uploads/1673326031_3053649.jpg', '2023-01-10 04:47:11', '2023-01-10 04:47:11', NULL),
(67, '1673326031_1662089829671.pdf', 'CqjKvdAIKl1673326027', 'uploads/1673326031_1662089829671.pdf', '2023-01-10 04:47:15', '2023-01-10 04:47:15', NULL),
(68, '1673500675_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', 'okpwBHjydg1673500675', 'uploads/1673500675_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', '2023-01-12 05:17:55', '2023-01-12 05:17:55', NULL),
(69, '1673500675_1667370956_1666169006_file-sample_100kB.doc', 'okpwBHjydg1673500675', 'uploads/1673500675_1667370956_1666169006_file-sample_100kB.doc', '2023-01-12 05:17:55', '2023-01-12 05:17:55', NULL),
(70, '1673500675_Dirt-3-HD-1280-x-1024-Wallpaper-620x496.jpg', 'okpwBHjydg1673500675', 'uploads/1673500675_Dirt-3-HD-1280-x-1024-Wallpaper-620x496.jpg', '2023-01-12 05:17:56', '2023-01-12 05:17:56', NULL),
(71, '1673500676_5650530.png', 'okpwBHjydg1673500675', 'uploads/1673500676_5650530.png', '2023-01-12 05:17:56', '2023-01-12 05:17:56', NULL),
(72, '1673500676_street_night_wet_155637_1280x1024.jpg', 'okpwBHjydg1673500675', 'uploads/1673500676_street_night_wet_155637_1280x1024.jpg', '2023-01-12 05:17:56', '2023-01-12 05:17:56', NULL),
(77, '1673501052_image.png', 'okpwBHjydg1673500675', 'uploads/1673501052_image.png', '2023-01-12 05:24:12', '2023-01-12 05:24:12', NULL),
(74, '1673500676_Laravel_Notes.pdf', 'okpwBHjydg1673500675', 'uploads/1673500676_Laravel_Notes.pdf', '2023-01-12 05:17:57', '2023-01-12 05:17:57', NULL),
(75, '1673500677_3053649.jpg', 'okpwBHjydg1673500675', 'uploads/1673500677_3053649.jpg', '2023-01-12 05:17:57', '2023-01-12 05:17:57', NULL),
(76, '1673500677_1661532207960.jpg', 'okpwBHjydg1673500675', 'uploads/1673500677_1661532207960.jpg', '2023-01-12 05:17:58', '2023-01-12 05:17:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `idea_revision`
--

CREATE TABLE `idea_revision` (
  `idea_revision_id` int(11) NOT NULL,
  `idea_id` int(11) DEFAULT NULL,
  `idea_uni_id` varchar(255) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `description` text,
  `category_id` varchar(200) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `active_status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `idea_revision`
--

INSERT INTO `idea_revision` (`idea_revision_id`, `idea_id`, `idea_uni_id`, `title`, `description`, `category_id`, `image_path`, `created_at`, `updated_at`, `deleted_at`, `active_status`) VALUES
(1, 3, NULL, 'Hello This is my thid Idea', 'Hello this is description of the third idea', NULL, 'uploads/1667020460_Databases@2x.png', '2022-10-29 05:14:20', '2022-10-29 05:14:20', NULL, NULL),
(2, 2, NULL, 'Hello This is my second Idea', 'Hello this is description of the second idea', NULL, 'uploads/1667020471_1662053761631.jpg', '2022-10-29 05:14:31', '2022-10-29 05:14:31', NULL, NULL),
(3, 1, NULL, 'Meet\'s first Idea', 'Meet\'s first Idea', NULL, 'uploads/1667020492_photo_2022-09-05_14-26-07.jpg', '2022-10-29 05:14:52', '2022-10-29 05:14:52', NULL, NULL),
(4, 4, NULL, 'Rahul\'s first Idea edited', 'Rahul\'s first Idea description edited', NULL, 'uploads/1667023158_Laravel Notes.pdf', '2022-10-29 05:59:18', '2022-10-29 05:59:18', NULL, NULL),
(5, 10, NULL, 'New Idea for testing title Checking Edit', 'New Idea for testing description Checking Edit', NULL, 'uploads/1667290315_face (1).jpg', '2022-11-01 08:11:55', '2022-11-01 08:11:55', NULL, NULL),
(6, 10, NULL, 'New Idea for testing title Checking Edit', 'New Idea for testing description Checking Edit', NULL, 'uploads/1667291040_Laravel Notes.pdf', '2022-11-01 08:24:00', '2022-11-01 08:24:00', NULL, NULL),
(7, 10, NULL, 'New Idea for testing title Checking Edit', 'New Idea for testing description Checking Edit', NULL, 'uploads/1667291140_1666169006_file-sample_100kB.doc', '2022-11-01 08:25:40', '2022-11-01 08:25:40', NULL, NULL),
(8, 14, NULL, 'My First Idea', 'Test idea\r\nModified as per the Assessment teams\'s instructions.\r\n\r\nThis should get approved now', NULL, NULL, '2022-11-01 10:09:15', '2022-11-01 10:09:15', NULL, NULL),
(9, 15, NULL, 'Title of the First Idea by Kenny Ackerman', 'Description of the First Idea by Kenny Ackerman', NULL, 'uploads/1667394161_1662053761631.jpg', '2022-11-02 13:02:41', '2022-11-02 13:02:41', NULL, NULL),
(10, 16, NULL, 'Title of the Second Idea', 'Description of the Second idea', NULL, NULL, '2022-11-02 13:03:37', '2022-11-02 13:03:37', NULL, NULL),
(11, 17, NULL, 'Last Idea Title', 'Last idea Description', NULL, NULL, '2022-11-02 13:03:59', '2022-11-02 13:03:59', NULL, NULL),
(12, 18, NULL, 'Final Idea Title', 'Final Idea Description', NULL, 'uploads/1667394288_1666169006_file-sample_100kB.doc', '2022-11-02 13:04:48', '2022-11-02 13:04:48', NULL, NULL),
(13, 19, NULL, 'Test Idea', 'Test Description', NULL, NULL, '2022-11-04 05:40:06', '2022-11-04 05:40:06', NULL, NULL),
(14, 20, NULL, 'New Idea from Meet Mewada Title', 'New Idea from Meet Mewada Description', NULL, 'uploads/1668751261_EuUJqbe.jpg', '2022-11-18 06:01:01', '2022-11-18 06:01:01', NULL, NULL),
(15, 21, NULL, 'New Idea from Meet Mewada Title', 'New Idea from Meet Mewada Description', NULL, 'uploads/1668751724_EuUJqbe.jpg', '2022-11-18 06:08:44', '2022-11-18 06:08:44', NULL, NULL),
(16, 22, NULL, 'New Idea from Meet Mewada Title', 'New Idea from Meet Mewada Description', NULL, 'uploads/1668751975_EuUJqbe.jpg', '2022-11-18 06:12:55', '2022-11-18 06:12:55', NULL, NULL),
(17, 23, NULL, 'New Idea from Meet Mewada title', 'New Idea from Meet Mewada description', NULL, 'uploads/1668752028_index.jpeg', '2022-11-18 06:13:48', '2022-11-18 06:13:48', NULL, NULL),
(18, 24, NULL, 'New Idea from Meet Mewada title', 'New Idea from Meet Mewada description', NULL, 'uploads/1668755609_index.jpeg', '2022-11-18 07:13:29', '2022-11-18 07:13:29', NULL, NULL),
(19, 25, NULL, 'A first Idea by Rock', 'testing testing', NULL, 'uploads/1669201232_testing.jpg', '2022-11-23 11:00:32', '2022-11-23 11:00:32', NULL, NULL),
(20, 26, NULL, 'A first Idea by Rock', 'testing testing', NULL, 'uploads/1669201455_testing.jpg', '2022-11-23 11:04:15', '2022-11-23 11:04:15', NULL, NULL),
(21, 27, NULL, 'Latest idea Testing', 'testing testing 2', NULL, 'uploads/1669201504_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', '2022-11-23 11:05:04', '2022-11-23 11:05:04', NULL, NULL),
(22, 28, NULL, 'asdf', 'asdf', NULL, NULL, '2022-11-23 11:10:19', '2022-11-23 11:10:19', NULL, NULL),
(23, 27, NULL, 'Latest idea Testing', 'testing testing 2', NULL, 'uploads/1669202036_street_night_wet_155637_1280x1024.jpg', '2022-11-23 11:13:56', '2022-11-23 11:13:56', NULL, NULL),
(24, 29, NULL, 'Testing 1', 'Testing 1', NULL, 'uploads/1669717784_g-h.ghd.jpg', '2022-11-29 10:29:44', '2022-11-29 10:29:44', NULL, NULL),
(25, 29, NULL, 'Testing 1 edited', 'Testing 1 edited', NULL, 'uploads/1669719212_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', '2022-11-29 10:53:32', '2022-11-29 10:53:32', NULL, NULL),
(26, 30, NULL, 'Testing 18', 'Testing 18', NULL, 'uploads/1669784121_Middleware@2x.png', '2022-11-30 04:55:22', '2022-11-30 04:55:22', NULL, NULL),
(27, 31, NULL, 'Testing 19', 'The standard Lorem Ipsum passage, used since the 1500s\r\n\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\r\n\r\nSection 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC\r\n\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"\r\n\r\n1914 translation by H. Rackham\r\n\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\"\r\n\r\nSection 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC\r\n\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"\r\n\r\n1914 translation by H. Rackham\r\n\"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.\"', NULL, NULL, '2022-11-30 05:22:17', '2022-11-30 05:22:17', NULL, NULL),
(28, 31, NULL, 'Testing 19', 'The standard Lorem Ipsum passage, used since the 1500s\r\n\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\r\n\r\nSection 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC\r\n\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"\r\n\r\n1914 translation by H. Rackham\r\n\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\"\r\n\r\nSection 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC\r\n\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"\r\n\r\n1914 translation by H. Rackham\r\n\"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.\"', NULL, 'uploads/1669785951_1662053761631.jpg', '2022-11-30 05:25:51', '2022-11-30 05:25:51', NULL, NULL),
(29, 31, NULL, 'Testing 19', 'The standard Lorem Ipsum passage, used since the 1500s\r\n\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\r\n\r\nSection 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC\r\n\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"\r\n\r\n1914 translation by H. Rackham\r\n\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\"\r\n\r\nSection 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC\r\n\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"\r\n\r\n1914 translation by H. Rackham\r\n\"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.\"', NULL, 'uploads/1669786766_1667291140_1666169006_file-sample_100kB.doc', '2022-11-30 05:39:26', '2022-11-30 05:39:26', NULL, NULL),
(30, 31, NULL, 'Testing 19', 'The standard Lorem Ipsum passage, used since the 1500s\r\n\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\r\n\r\nSection 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC\r\n\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"\r\n\r\n1914 translation by H. Rackham\r\n\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\"\r\n\r\nSection 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC\r\n\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"\r\n\r\n1914 translation by H. Rackham\r\n\"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.\"', NULL, 'uploads/1669787331_Laravel Notes.pdf', '2022-11-30 05:48:51', '2022-11-30 05:48:51', NULL, NULL),
(31, 32, NULL, 'Testing 22', 'Testing 22', NULL, 'uploads/1669787696_5650530.png', '2022-11-30 05:54:56', '2022-11-30 05:54:56', NULL, NULL),
(32, 33, NULL, 'My idea', 'Idea Description', NULL, NULL, '2022-12-05 04:51:19', '2022-12-05 04:51:19', NULL, NULL),
(33, 33, NULL, 'My idea', 'Idea Description', NULL, 'uploads/1670215956_20221201_150543.jpg', '2022-12-05 04:52:40', '2022-12-05 04:52:40', NULL, NULL),
(34, 34, NULL, 'Testing 29', 'Testing 29', NULL, 'uploads/1670305001_image.png', '2022-12-06 05:36:42', '2022-12-06 05:36:42', NULL, NULL),
(35, 35, NULL, 'Testing 333 Title', 'Testing 333 Description', NULL, 'uploads/1670397570_testing.jpg', '2022-12-07 07:19:30', '2022-12-07 07:19:30', NULL, NULL),
(36, 36, NULL, 'Testing 888', 'Testing 888', NULL, 'uploads/1670401846_1661532207960.jpg', '2022-12-07 08:30:46', '2022-12-07 08:30:46', NULL, NULL),
(37, 36, NULL, 'Testing 888', 'Testing 888', NULL, 'uploads/1670401900_1667370956_1666169006_file-sample_100kB.doc', '2022-12-07 08:31:40', '2022-12-07 08:31:40', NULL, NULL),
(38, 36, NULL, 'Testing 888', 'Testing 888', NULL, 'uploads/1670401930_street_night_wet_155637_1280x1024.jpg', '2022-12-07 08:32:10', '2022-12-07 08:32:10', NULL, NULL),
(39, 36, NULL, 'Testing 888', 'Testing 888', NULL, 'uploads/1670402144_1662089829671.pdf', '2022-12-07 08:35:50', '2022-12-07 08:35:50', NULL, NULL),
(40, 37, NULL, 'test', 'Test', NULL, NULL, '2022-12-07 12:13:32', '2022-12-07 12:13:32', NULL, NULL),
(41, 37, NULL, 'test12131212', 'Test', NULL, NULL, '2022-12-07 12:14:50', '2022-12-07 12:14:50', NULL, NULL),
(42, 38, NULL, 'First idea by Vijay', 'test description', NULL, 'uploads/1670476937_Screenshot (41).png', '2022-12-08 05:22:17', '2022-12-08 05:22:17', NULL, NULL),
(43, 39, NULL, 'My Second Idea', 'test', NULL, 'uploads/1670480801_Screenshot (1).png', '2022-12-08 06:26:42', '2022-12-08 06:26:42', NULL, NULL),
(44, 40, NULL, 'Pict Idea', 'Pict Idea', NULL, 'uploads/1670829190_image(7).png', '2022-12-12 07:13:11', '2022-12-12 07:13:11', NULL, NULL),
(45, 40, NULL, 'Pict Idea', 'Pict Idea revised', NULL, 'uploads/1670829190_image(7).png', '2022-12-12 07:30:11', '2022-12-12 07:30:11', NULL, NULL),
(46, 41, NULL, 'Process Change', 'Process to be changed', NULL, NULL, '2022-12-13 05:04:34', '2022-12-13 05:04:34', NULL, NULL),
(47, 42, NULL, 'Testing 102', 'Testing 102', NULL, 'uploads/1671086678_Laravel-Environment-Variable@2x.png', '2022-12-15 06:44:39', '2022-12-15 06:44:39', NULL, NULL),
(48, 42, NULL, 'Testing 102', 'Testing 102', NULL, 'uploads/1671086748_Java programs for practice with solutions.pdf', '2022-12-15 06:45:49', '2022-12-15 06:45:49', NULL, NULL),
(49, 43, NULL, 'Testing 105', 'Testing 105', NULL, 'uploads/1671109960_image.png', '2022-12-15 13:12:41', '2022-12-15 13:12:41', NULL, NULL),
(50, 44, NULL, 'cost saving', 'cost saving', NULL, NULL, '2022-12-16 07:47:31', '2022-12-16 07:47:31', NULL, NULL),
(51, 45, NULL, 'cost saving', 'cost saving', NULL, NULL, '2022-12-16 07:49:08', '2022-12-16 07:49:08', NULL, NULL),
(52, 46, NULL, 'My First Idea', 'asdfasdf', NULL, 'uploads/1671177293_Screenshot (1).png', '2022-12-16 07:54:53', '2022-12-16 07:54:53', NULL, NULL),
(53, 47, NULL, 'Idea Testing 01', 'Idea Testing 01', NULL, 'uploads/1671278278_Laravel+Migrations@2x.png', '2022-12-17 11:57:58', '2022-12-17 11:57:58', NULL, NULL),
(54, 48, NULL, 'Idea Testing 02', 'Idea Testing 02', NULL, 'uploads/1671278961_Laravel Notes.pdf', '2022-12-17 12:09:21', '2022-12-17 12:09:21', NULL, NULL),
(55, 49, NULL, 'Idea 222', 'Idea 222', NULL, 'uploads/1671446895_3506754.jpg', '2022-12-19 10:48:16', '2022-12-19 10:48:16', NULL, NULL),
(56, 49, NULL, 'Idea 222', 'Idea 222', NULL, 'uploads/1671446895_3506754.jpg', '2022-12-19 10:48:30', '2022-12-19 10:48:30', NULL, NULL),
(57, 49, NULL, 'Idea 222', 'Idea 222', NULL, 'uploads/1671446895_3506754.jpg', '2022-12-19 10:49:23', '2022-12-19 10:49:23', NULL, NULL),
(58, 50, NULL, 'Idea 33', 'Idea 33', NULL, 'uploads/1671510992_image.png', '2022-12-20 04:36:33', '2022-12-20 04:36:33', NULL, NULL),
(59, 50, NULL, 'Idea 33', 'Idea 33', NULL, 'uploads/1671510992_image.png', '2022-12-20 04:36:49', '2022-12-20 04:36:49', NULL, NULL),
(60, 51, NULL, 'Idea 34 testing', 'Idea 34 testing', NULL, 'uploads/1671511232_Dirt-3-HD-1280-x-1024-Wallpaper-620x496.jpg', '2022-12-20 04:40:32', '2022-12-20 04:40:32', NULL, NULL),
(61, 52, NULL, 'Cost Saving for ITV running in Terminal', 'If we add GPS system in ITV and their running is crosschecked with the Report of the Fuel Consumed then we can get the actual efficiency and guide the ITV with most optimal Path.', NULL, NULL, '2022-12-20 06:04:34', '2022-12-20 06:04:34', NULL, NULL),
(62, 52, NULL, 'Cost Saving for ITV running in Terminal', 'If we add GPS system in ITV and their running is crosschecked with the Report of the Fuel Consumed then we can get the actual efficiency and guide the ITV with most optimal Path.', NULL, 'uploads/1671516495_image(8).png', '2022-12-20 06:08:15', '2022-12-20 06:08:15', NULL, NULL),
(63, 52, NULL, 'Cost Saving for ITV running in Terminal', 'If we add GPS system in ITV and their running is crosschecked with the Report of the Fuel Consumed then we can get the actual efficiency and guide the ITV with most optimal Path.', NULL, 'uploads/1671516893_image (7).png', '2022-12-20 06:14:53', '2022-12-20 06:14:53', NULL, NULL),
(64, 52, NULL, 'Cost Saving for ITV running in Terminals', 'If we add GPS system in ITV and their running is crosschecked with the Report of the Fuel Consumed then we can get the actual efficiency and guide the ITV with most optimal Path.', NULL, 'uploads/1671516893_image (7).png', '2022-12-20 06:33:51', '2022-12-20 06:33:51', NULL, NULL),
(65, NULL, 'xzryBkxibc1672205861', 'Testing multiple files upload 2', 'Testing multiple files upload 2', NULL, NULL, '2022-12-28 05:37:44', '2022-12-28 05:37:44', NULL, NULL),
(66, NULL, 'PiNKRHeUOd1672206076', 'Testing multiple files upload 3', 'Testing multiple files upload 3', NULL, NULL, '2022-12-28 05:41:19', '2022-12-28 05:41:19', NULL, NULL),
(67, 55, NULL, 'Testing multiple files upload 3', 'Testing multiple files upload 3', NULL, NULL, '2022-12-28 05:45:34', '2022-12-28 05:45:34', NULL, NULL),
(68, NULL, 'kVEqgluQSx1672209740', 'test', 'test', NULL, NULL, '2022-12-28 06:42:20', '2022-12-28 06:42:20', NULL, NULL),
(69, 56, NULL, 'test', 'test', NULL, NULL, '2022-12-28 07:34:32', '2022-12-28 07:34:32', NULL, NULL),
(70, 56, NULL, 'test', 'test', NULL, NULL, '2022-12-28 07:35:37', '2022-12-28 07:35:37', NULL, NULL),
(71, NULL, 'fgzeyJUSAn1672214628', 'test 22', 'test 22', NULL, NULL, '2022-12-28 08:03:48', '2022-12-28 08:03:48', NULL, NULL),
(72, 56, NULL, 'test', 'test', NULL, NULL, '2022-12-28 08:20:42', '2022-12-28 08:20:42', NULL, NULL),
(73, NULL, 'uFXewlwYOi1672216720', 'Test doc', 'Test doc', NULL, NULL, '2022-12-28 08:38:40', '2022-12-28 08:38:40', NULL, NULL),
(74, NULL, 'OrbkCiWQqX1672392041', 'change  in      process', 'change  in      process', NULL, NULL, '2022-12-30 09:20:41', '2022-12-30 09:20:41', NULL, NULL),
(75, 45, NULL, 'cost saving', 'cost saving in admin exps', NULL, NULL, '2022-12-30 09:22:42', '2022-12-30 09:22:42', NULL, NULL),
(76, 45, NULL, 'cost saving', 'cost saving in admin exps', NULL, NULL, '2022-12-30 09:30:43', '2022-12-30 09:30:43', NULL, NULL),
(77, 45, NULL, 'cost saving', 'cost saving in admin exps', NULL, NULL, '2022-12-30 09:31:22', '2022-12-30 09:31:22', NULL, NULL),
(78, NULL, 'RMWDCfOsBj1672393501', 'cost saving in IT Expenses', 'using open softwares to reduce cost', NULL, NULL, '2022-12-30 09:45:01', '2022-12-30 09:45:01', NULL, NULL),
(79, 45, NULL, 'cost saving', 'cost saving in admin exps', NULL, NULL, '2023-01-02 06:19:30', '2023-01-02 06:19:30', NULL, NULL),
(80, 45, NULL, 'cost saving', 'cost saving in admin exps', NULL, NULL, '2023-01-02 06:37:52', '2023-01-02 06:37:52', NULL, NULL),
(81, 60, NULL, 'cost saving in IT Expenses', 'using open softwares to reduce cost', NULL, NULL, '2023-01-02 06:38:30', '2023-01-02 06:38:30', NULL, NULL),
(82, 45, NULL, 'cost saving', 'cost saving in admin exps', NULL, NULL, '2023-01-02 06:38:44', '2023-01-02 06:38:44', NULL, NULL),
(83, 52, NULL, 'Cost Saving for ITV running in Terminals', 'If we add GPS system in ITV and their running is crosschecked with the Report of the Fuel Consumed then we can get the actual efficiency and guide the ITV with most optimal Path.', NULL, NULL, '2023-01-02 06:39:08', '2023-01-02 06:39:08', NULL, NULL),
(84, 60, NULL, 'cost saving in IT Expenses', 'using open softwares to reduce cost', NULL, NULL, '2023-01-02 06:44:48', '2023-01-02 06:44:48', NULL, NULL),
(85, 60, NULL, 'cost saving in IT Expenses', 'using open softwares to reduce cost', NULL, NULL, '2023-01-02 06:47:31', '2023-01-02 06:47:31', NULL, NULL),
(86, 62, 'DNAQEaalYM1672653453', 'Testing Text', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, NULL, '2023-01-02 09:57:38', '2023-01-02 09:57:38', NULL, NULL),
(87, 63, 'bmCtzlHIxv1672653698', 'Hello World', 'Hello World', NULL, NULL, '2023-01-02 10:01:39', '2023-01-02 10:01:39', NULL, NULL),
(88, 64, 'HmvmXJooyB1672745944', 'Test 999', 'Test 999', NULL, NULL, '2023-01-03 11:39:07', '2023-01-03 11:39:07', NULL, NULL),
(89, 64, 'jhzVcXoPqH1672745973', 'Test 999', 'Test 999', '6', NULL, '2023-01-03 11:39:33', '2023-01-03 11:39:33', NULL, NULL),
(90, 65, 'opkTDYRfqG1672746045', 'Idea testing 9999', 'Idea testing 9999', NULL, NULL, '2023-01-03 11:40:45', '2023-01-03 11:40:45', NULL, NULL),
(91, 66, 'nEeHnoozWj1672829040', 'new Idea For testing 001', 'new Idea For testing 001', NULL, NULL, '2023-01-04 10:44:07', '2023-01-04 10:44:07', NULL, NULL),
(92, 66, 'PsnZtYHlMT1672829254', 'new Idea For testing 001', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras felis metus, euismod aliquam felis hendrerit, malesuada luctus neque. Integer rutrum euismod purus ullamcorper imperdiet. Nulla bibendum, dolor molestie semper posuere, odio ligula tincidunt sem, feugiat cursus tortor sem ut magna. Maecenas ut odio porta, tempus est quis, sodales justo. Duis egestas purus eget sagittis varius. Etiam dapibus aliquam elit, ut elementum mi vulputate eget. Nullam ullamcorper mi sit amet erat sollicitudin, nec auctor nisi vulputate. Vestibulum sapien magna, rhoncus vitae facilisis at, viverra feugiat ante. Vivamus accumsan nunc nec lectus blandit accumsan.\r\n\r\nNulla volutpat sem vel malesuada dignissim. Maecenas purus lorem, ultrices ac lacus nec, maximus dignissim nisl. Etiam suscipit ullamcorper leo vel aliquet. Suspendisse sodales nunc interdum sem porttitor ullamcorper. Nulla pulvinar tempus posuere. Morbi felis tortor, commodo venenatis tristique vel, posuere quis dui. Aenean nibh sem,', '5', NULL, '2023-01-04 10:47:34', '2023-01-04 10:47:34', NULL, NULL),
(93, 67, 'CqjKvdAIKl1673326027', 'Testing 01', 'Testing 01', NULL, NULL, '2023-01-10 04:47:15', '2023-01-10 04:47:15', NULL, NULL),
(94, 68, 'cYlxQCdyGx1673326078', 'Testing 02', 'Testing 02', NULL, NULL, '2023-01-10 04:47:58', '2023-01-10 04:47:58', NULL, NULL),
(95, 69, 'HgrnGfompN1673347334', 'idea Test with No files', 'idea Test with No files', '5', NULL, '2023-01-10 10:42:14', '2023-01-10 10:42:14', NULL, NULL),
(96, 70, 'okpwBHjydg1673500675', 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in magna a sapien condimentum tincidunt vitae sed quam. Donec eget sodales urna, ac ultrices turpis. Aliquam posuere non diam eget rutrum. Integer magna lorem, vehicula vel lorem eget, convallis sodales est. Curabitur odio dolor, ullamcorper eget dui sit amet, molestie tincidunt turpis. Sed eget eros euismod elit faucibus pharetra non ac sem. Mauris a semper leo, nec tincidunt ipsum. Proin id laoreet odio. Morbi ornare a augue id aliquam.\r\n\r\nDonec scelerisque a turpis id mollis. Nunc vehicula sollicitudin sagittis. Aliquam velit lectus, aliquam vitae sagittis ut, laoreet sit amet tellus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quam magna, scelerisque eget elementum sed, vestibulum at neque. Mauris id quam nec ipsum rhoncus sollicitudin. In non leo vel neque dapibus commodo. Suspendisse mollis dui massa, in semper justo cursus id. Sed dignissim ipsum at hendrerit interdum. Proin non fermentum ipsum. In hac habitasse platea dictumst. Pellentesque tristique augue id tortor lobortis tristique.\r\n\r\nPhasellus tincidunt auctor felis, eu iaculis augue molestie eget. Vestibulum a justo aliquam, mollis ante ut, pretium elit. Sed id nunc maximus, accumsan lectus quis, tincidunt eros. Integer a felis convallis, fermentum leo ut, eleifend magna. Praesent congue laoreet turpis quis auctor. Quisque vel posuere nibh. Suspendisse libero sem, efficitur a ipsum in, rutrum luctus tellus. Integer a ipsum in mi egestas auctor. Ut in tellus sit amet neque tempor lobortis eget vel felis. Nullam consequat placerat justo id dignissim. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque non tincidunt lectus. Vivamus vulputate vitae libero nec scelerisque. Pellentesque aliquam ex vitae auctor sagittis.\r\n\r\nAliquam lacinia nunc quis varius tempus. Praesent ac ligula ut massa posuere cursus sit amet at elit. Curabitur vehicula tortor odio, ut condimentum mauris luctus ac. Vivamus auctor velit non efficitur tempor. Morbi non turpis sed nunc eleifend volutpat eu vel leo. Suspendisse feugiat non ante at semper. Cras nec justo posuere, lobortis est et, condimentum arcu. Mauris sit amet interdum massa. Nam ornare tristique velit nec pellentesque. Integer auctor dolor non pulvinar accumsan.', '5', NULL, '2023-01-12 05:17:58', '2023-01-12 05:17:58', NULL, NULL),
(97, 70, 'yDSarWaWPQ1673501052', 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in magna a sapien condimentum tincidunt vitae sed quam. Donec eget sodales urna, ac ultrices turpis. Aliquam posuere non diam eget rutrum. Integer magna lorem, vehicula vel lorem eget, convallis sodales est. Curabitur odio dolor, ullamcorper eget dui sit amet, molestie tincidunt turpis. Sed eget eros euismod elit faucibus pharetra non ac sem. Mauris a semper leo, nec tincidunt ipsum. Proin id laoreet odio. Morbi ornare a augue id aliquam.\r\n\r\nDonec scelerisque a turpis id mollis. Nunc vehicula sollicitudin sagittis. Aliquam velit lectus, aliquam vitae sagittis ut, laoreet sit amet tellus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quam magna, scelerisque eget elementum sed, vestibulum at neque. Mauris id quam nec ipsum rhoncus sollicitudin. In non leo vel neque dapibus commodo. Suspendisse mollis dui massa, in semper justo cursus id. Sed dignissim ipsum at hendrerit interdum. Proin non fermentum ipsum. In hac habitasse platea dictumst. Pellentesque tristique augue id tortor lobortis tristique.\r\n\r\nPhasellus tincidunt auctor felis, eu iaculis augue molestie eget. Vestibulum a justo aliquam, mollis ante ut, pretium elit. Sed id nunc maximus, accumsan lectus quis, tincidunt eros. Integer a felis convallis, fermentum leo ut, eleifend magna. Praesent congue laoreet turpis quis auctor. Quisque vel posuere nibh. Suspendisse libero sem, efficitur a ipsum in, rutrum luctus tellus. Integer a ipsum in mi egestas auctor. Ut in tellus sit amet neque tempor lobortis eget vel felis. Nullam consequat placerat justo id dignissim. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque non tincidunt lectus. Vivamus vulputate vitae libero nec scelerisque. Pellentesque aliquam ex vitae auctor sagittis.\r\n\r\nAliquam lacinia nunc quis varius tempus. Praesent ac ligula ut massa posuere cursus sit amet at elit. Curabitur vehicula tortor odio, ut condimentum mauris luctus ac. Vivamus auctor velit non efficitur tempor. Morbi non turpis sed nunc eleifend volutpat eu vel leo. Suspendisse feugiat non ante at semper. Cras nec justo posuere, lobortis est et, condimentum arcu. Mauris sit amet interdum massa. Nam ornare tristique velit nec pellentesque. Integer auctor dolor non pulvinar accumsan.', '5', NULL, '2023-01-12 05:24:12', '2023-01-12 05:24:12', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `idea_revision_images`
--

CREATE TABLE `idea_revision_images` (
  `image_id` int(11) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `idea_uni_id` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `image_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `idea_revision_images`
--

INSERT INTO `idea_revision_images` (`image_id`, `file_name`, `idea_uni_id`, `image_path`, `image_link`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1672474186_1672216720_1667291140_1666169006_file-sample_100kB.doc', 'lvmqxmLrUN1672474186', 'uploads/idea_revision/1672474186_1672216720_1667291140_1666169006_file-sample_100kB.doc', 'ZbobwcrXaY1672474186', '2022-12-31 08:09:46', '2022-12-31 08:09:46', NULL),
(9, '1672475427_Laravel-Environment-Variable@2x.png', 'yDTCesfDRw1672475427', 'uploads/idea_revision/1672475427_Laravel-Environment-Variable@2x.png', 'kbYoewhNXi1672475427', '2022-12-31 08:30:27', '2022-12-31 08:30:27', NULL),
(3, '1672474186_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', 'lvmqxmLrUN1672474186', 'uploads/idea_revision/1672474186_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', 'DKPClUyJEC1672474186', '2022-12-31 08:09:46', '2022-12-31 08:09:46', NULL),
(10, '1672475427_Laravel-Resource-Controller@2x.png', 'yDTCesfDRw1672475427', 'uploads/idea_revision/1672475427_Laravel-Resource-Controller@2x.png', 'OGeCCOtUfg1672475427', '2022-12-31 08:30:27', '2022-12-31 08:30:27', NULL),
(8, '1672475427_Laravel+Migrations@2x.png', 'yDTCesfDRw1672475427', 'uploads/idea_revision/1672475427_Laravel+Migrations@2x.png', 'oqBsyJyWBk1672475427', '2022-12-31 08:30:27', '2022-12-31 08:30:27', NULL),
(6, '1672474186_Laravel_Notes.pdf', 'lvmqxmLrUN1672474186', 'uploads/idea_revision/1672474186_Laravel_Notes.pdf', 'YhqGWdQdnb1672474186', '2022-12-31 08:09:46', '2022-12-31 08:09:46', NULL),
(7, '1672474186_1662053761631.jpg', 'lvmqxmLrUN1672474186', 'uploads/idea_revision/1672474186_1662053761631.jpg', 'QHYmLOQgYh1672474186', '2022-12-31 08:09:46', '2022-12-31 08:09:46', NULL),
(11, '1672475798_testing.jpg', 'bPmUgYAAJr1672475798', 'uploads/idea_revision/1672475798_testing.jpg', 'XiWIXkzYwv1672475798', '2022-12-31 08:36:38', '2022-12-31 08:36:38', NULL),
(12, '1672475798_street_night_wet_155637_1280x1024.jpg', 'bPmUgYAAJr1672475798', 'uploads/idea_revision/1672475798_street_night_wet_155637_1280x1024.jpg', 'BUtdDtbyCz1672475798', '2022-12-31 08:36:38', '2022-12-31 08:36:38', NULL),
(13, '1672475798_g-h.ghd.jpg', 'bPmUgYAAJr1672475798', 'uploads/idea_revision/1672475798_g-h.ghd.jpg', 'YqxvucGCUK1672475798', '2022-12-31 08:36:38', '2022-12-31 08:36:38', NULL),
(14, '1672475819_5650530.png', 'SNaGucnQAm1672475819', 'uploads/idea_revision/1672475819_5650530.png', NULL, '2022-12-31 08:36:59', '2022-12-31 08:36:59', NULL),
(15, '1672475819_3053649.jpg', 'SNaGucnQAm1672475819', 'uploads/idea_revision/1672475819_3053649.jpg', NULL, '2022-12-31 08:36:59', '2022-12-31 08:36:59', NULL),
(16, '1672481060_testing.jpg', 'fRMRCuLrRQ1672481060', 'uploads/idea_revision/1672481060_testing.jpg', 'FwAONzKYjk1672481060', '2022-12-31 10:04:20', '2022-12-31 10:04:20', NULL),
(17, '1672481060_1280-x-1024-Space-Wallpaper.jpg', 'fRMRCuLrRQ1672481060', 'uploads/idea_revision/1672481060_1280-x-1024-Space-Wallpaper.jpg', 'CJxndwsOQG1672481060', '2022-12-31 10:04:20', '2022-12-31 10:04:20', NULL),
(18, '1672481060_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', 'fRMRCuLrRQ1672481060', 'uploads/idea_revision/1672481060_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', 'HmDsBLHLyd1672481060', '2022-12-31 10:04:20', '2022-12-31 10:04:20', NULL),
(19, '1672481060_Dirt-3-HD-1280-x-1024-Wallpaper-620x496.jpg', 'fRMRCuLrRQ1672481060', 'uploads/idea_revision/1672481060_Dirt-3-HD-1280-x-1024-Wallpaper-620x496.jpg', 'tSBTaFfPiA1672481060', '2022-12-31 10:04:20', '2022-12-31 10:04:20', NULL),
(20, '1672481335_Databases@2x.png', 'sBibKRGHDM1672481335', 'uploads/idea_revision/1672481335_Databases@2x.png', 'WVxIJfeUkp1672481335', '2022-12-31 10:08:55', '2022-12-31 10:08:55', NULL),
(21, '1672481335_Laravel+Migrations@2x.png', 'sBibKRGHDM1672481335', 'uploads/idea_revision/1672481335_Laravel+Migrations@2x.png', 'QMuXoPEsYr1672481335', '2022-12-31 10:08:55', '2022-12-31 10:08:55', NULL),
(22, '1672481335_Laravel-Environment-Variable@2x.png', 'sBibKRGHDM1672481335', 'uploads/idea_revision/1672481335_Laravel-Environment-Variable@2x.png', 'tCFtaddoiH1672481335', '2022-12-31 10:08:55', '2022-12-31 10:08:55', NULL),
(23, '1672481335_Laravel-Resource-Controller@2x.png', 'sBibKRGHDM1672481335', 'uploads/idea_revision/1672481335_Laravel-Resource-Controller@2x.png', 'lbZoalpeZh1672481335', '2022-12-31 10:08:55', '2022-12-31 10:08:55', NULL),
(24, '1672481975_1280-x-1024-Space-Wallpaper.jpg', 'NgiQVMaNWJ1672481975', 'uploads/idea_revision/1672481975_1280-x-1024-Space-Wallpaper.jpg', 'YgMHJiHFZk1672481975', '2022-12-31 10:19:35', '2022-12-31 10:19:35', NULL),
(25, '1672481975_street_night_wet_155637_1280x1024.jpg', 'NgiQVMaNWJ1672481975', 'uploads/idea_revision/1672481975_street_night_wet_155637_1280x1024.jpg', 'MzvQVavRYB1672481975', '2022-12-31 10:19:35', '2022-12-31 10:19:35', NULL),
(26, '1672481975_g-h.ghd.jpg', 'NgiQVMaNWJ1672481975', 'uploads/idea_revision/1672481975_g-h.ghd.jpg', 'JOViVJzpHU1672481975', '2022-12-31 10:19:35', '2022-12-31 10:19:35', NULL),
(27, '1672481975_fff&text=+1280x1024+.png', 'NgiQVMaNWJ1672481975', 'uploads/idea_revision/1672481975_fff&text=+1280x1024+.png', 'KaXFlDMNYw1672481975', '2022-12-31 10:19:35', '2022-12-31 10:19:35', NULL),
(28, '1672481975_1280-x-1024-Space-Wallpaper.jpg', 'hQGCnLOTYK1672482062', 'uploads/idea_revision/1672481975_1280-x-1024-Space-Wallpaper.jpg', NULL, '2022-12-31 10:21:03', '2022-12-31 10:21:03', NULL),
(29, '1672481975_street_night_wet_155637_1280x1024.jpg', 'hQGCnLOTYK1672482062', 'uploads/idea_revision/1672481975_street_night_wet_155637_1280x1024.jpg', NULL, '2022-12-31 10:21:03', '2022-12-31 10:21:03', NULL),
(30, '1672481975_g-h.ghd.jpg', 'hQGCnLOTYK1672482062', 'uploads/idea_revision/1672481975_g-h.ghd.jpg', NULL, '2022-12-31 10:21:03', '2022-12-31 10:21:03', NULL),
(31, NULL, NULL, NULL, NULL, '2022-12-31 10:22:03', '2022-12-31 10:22:03', NULL),
(32, NULL, NULL, NULL, NULL, '2022-12-31 10:22:03', '2022-12-31 10:22:03', NULL),
(33, NULL, NULL, NULL, NULL, '2022-12-31 10:22:03', '2022-12-31 10:22:03', NULL),
(34, NULL, NULL, NULL, NULL, '2022-12-31 10:22:03', '2022-12-31 10:22:03', NULL),
(35, '1672481975_1280-x-1024-Space-Wallpaper.jpg', 'udqZziTCpi1672482123', 'uploads/idea_revision/1672481975_1280-x-1024-Space-Wallpaper.jpg', NULL, '2022-12-31 10:22:03', '2022-12-31 10:22:03', NULL),
(36, '1672482123_1667370956_1666169006_file-sample_100kB.doc', 'udqZziTCpi1672482123', 'uploads/idea_revision/1672482123_1667370956_1666169006_file-sample_100kB.doc', NULL, '2022-12-31 10:22:03', '2022-12-31 10:22:03', NULL),
(37, '1672481975_g-h.ghd.jpg', 'udqZziTCpi1672482123', 'uploads/idea_revision/1672481975_g-h.ghd.jpg', NULL, '2022-12-31 10:22:03', '2022-12-31 10:22:03', NULL),
(38, '1672482123_Laravel_Notes.pdf', 'udqZziTCpi1672482123', 'uploads/idea_revision/1672482123_Laravel_Notes.pdf', NULL, '2022-12-31 10:22:03', '2022-12-31 10:22:03', NULL),
(39, '1672482123_1662053761631.jpg', 'udqZziTCpi1672482123', 'uploads/idea_revision/1672482123_1662053761631.jpg', NULL, '2022-12-31 10:22:03', '2022-12-31 10:22:03', NULL),
(40, '1672482123_3053649.jpg', 'udqZziTCpi1672482123', 'uploads/idea_revision/1672482123_3053649.jpg', NULL, '2022-12-31 10:22:03', '2022-12-31 10:22:03', NULL),
(41, NULL, NULL, NULL, NULL, '2022-12-31 10:33:44', '2022-12-31 10:33:44', NULL),
(42, NULL, NULL, NULL, NULL, '2022-12-31 10:33:44', '2022-12-31 10:33:44', NULL),
(43, NULL, NULL, NULL, NULL, '2022-12-31 10:33:44', '2022-12-31 10:33:44', NULL),
(44, '1672482824_image.png', 'IWpFdQJRkG1672482824', 'uploads/idea_revision/4282842761_1672482824_image.png', NULL, '2022-12-31 10:33:44', '2022-12-31 10:33:44', NULL),
(45, '1672482824_Laravel+Migrations@2x.png', 'IWpFdQJRkG1672482824', 'uploads/idea_revision/4282842761_1672482824_Laravel+Migrations@2x.png', NULL, '2022-12-31 10:33:44', '2022-12-31 10:33:44', NULL),
(46, '1672482123_1667370956_1666169006_file-sample_100kB.doc', 'IWpFdQJRkG1672482824', 'uploads/idea_revision/4282842761_1672482123_1667370956_1666169006_file-sample_100kB.doc', NULL, '2022-12-31 10:33:44', '2022-12-31 10:33:44', NULL),
(47, '1672481975_g-h.ghd.jpg', 'IWpFdQJRkG1672482824', 'uploads/idea_revision/4282842761_1672481975_g-h.ghd.jpg', NULL, '2022-12-31 10:33:44', '2022-12-31 10:33:44', NULL),
(48, '1672482123_Laravel_Notes.pdf', 'IWpFdQJRkG1672482824', 'uploads/idea_revision/4282842761_1672482123_Laravel_Notes.pdf', NULL, '2022-12-31 10:33:44', '2022-12-31 10:33:44', NULL),
(49, '1672482123_3053649.jpg', 'IWpFdQJRkG1672482824', 'uploads/idea_revision/4282842761_1672482123_3053649.jpg', NULL, '2022-12-31 10:33:44', '2022-12-31 10:33:44', NULL),
(50, '1672482824_Laravel-Environment-Variable@2x.png', 'IWpFdQJRkG1672482824', 'uploads/idea_revision/4282842761_1672482824_Laravel-Environment-Variable@2x.png', NULL, '2022-12-31 10:33:44', '2022-12-31 10:33:44', NULL),
(51, NULL, NULL, NULL, NULL, '2022-12-31 11:18:33', '2022-12-31 11:18:33', NULL),
(52, NULL, NULL, NULL, NULL, '2022-12-31 11:18:33', '2022-12-31 11:18:33', NULL),
(53, NULL, NULL, NULL, NULL, '2022-12-31 11:18:33', '2022-12-31 11:18:33', NULL),
(54, '1672485513_Dirt-3-HD-1280-x-1024-Wallpaper-620x496.jpg', 'xTibOiJskh1672485513', 'uploads/idea_revision/3155842761_1672485513_Dirt-3-HD-1280-x-1024-Wallpaper-620x496.jpg', NULL, '2022-12-31 11:18:33', '2022-12-31 11:18:33', NULL),
(55, '1672485513_testing.jpg', 'xTibOiJskh1672485513', 'uploads/idea_revision/3155842761_1672485513_testing.jpg', NULL, '2022-12-31 11:18:33', '2022-12-31 11:18:33', NULL),
(56, '1672485513_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', 'xTibOiJskh1672485513', 'uploads/idea_revision/3155842761_1672485513_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', NULL, '2022-12-31 11:18:33', '2022-12-31 11:18:33', NULL),
(57, '1672633781_transistor.jpeg', 'PpacnOTVJn1672633781', 'uploads/idea_revision/1672633781_transistor.jpeg', 'adthvwcrMn1672633781', '2023-01-02 04:29:41', '2023-01-02 04:29:41', NULL),
(58, '1672633782_rain_transport_city_135952_1280x1024.jpg', 'PpacnOTVJn1672633781', 'uploads/idea_revision/1672633782_rain_transport_city_135952_1280x1024.jpg', 'hBlppbhcnR1672633782', '2023-01-02 04:29:42', '2023-01-02 04:29:42', NULL),
(59, '1672633782_phoenix-valorant-4k-2020-3t-1280x1024.jpg', 'PpacnOTVJn1672633781', 'uploads/idea_revision/1672633782_phoenix-valorant-4k-2020-3t-1280x1024.jpg', 'vvvBDgTmeQ1672633782', '2023-01-02 04:29:42', '2023-01-02 04:29:42', NULL),
(60, '1672633782_wallpapersden.com_purple-sunrise-4k-vaporwave_1280x1024.jpg', 'PpacnOTVJn1672633781', 'uploads/idea_revision/1672633782_wallpapersden.com_purple-sunrise-4k-vaporwave_1280x1024.jpg', 'WPBioDmxrj1672633782', '2023-01-02 04:29:42', '2023-01-02 04:29:42', NULL),
(61, NULL, NULL, NULL, NULL, '2023-01-02 04:46:31', '2023-01-02 04:46:31', NULL),
(62, NULL, NULL, NULL, NULL, '2023-01-02 04:46:32', '2023-01-02 04:46:32', NULL),
(63, NULL, NULL, NULL, NULL, '2023-01-02 04:46:32', '2023-01-02 04:46:32', NULL),
(64, '1672633781_transistor.jpeg', 'PJLkKprqCo1672634791', 'uploads/idea_revision/2974362761_1672633781_transistor.jpeg', NULL, '2023-01-02 04:46:32', '2023-01-02 04:46:32', NULL),
(65, '1672633782_rain_transport_city_135952_1280x1024.jpg', 'PJLkKprqCo1672634791', 'uploads/idea_revision/2974362761_1672633782_rain_transport_city_135952_1280x1024.jpg', NULL, '2023-01-02 04:46:32', '2023-01-02 04:46:32', NULL),
(66, '1672633782_phoenix-valorant-4k-2020-3t-1280x1024.jpg', 'PJLkKprqCo1672634791', 'uploads/idea_revision/2974362761_1672633782_phoenix-valorant-4k-2020-3t-1280x1024.jpg', NULL, '2023-01-02 04:46:32', '2023-01-02 04:46:32', NULL),
(67, '1672634791_3506754.jpg', 'PJLkKprqCo1672634791', 'uploads/idea_revision/2974362761_1672634791_3506754.jpg', NULL, '2023-01-02 04:46:32', '2023-01-02 04:46:32', NULL),
(68, '1672634792_1666169006_file-sample_100kB.doc', 'PJLkKprqCo1672634791', 'uploads/idea_revision/2974362761_1672634792_1666169006_file-sample_100kB.doc', NULL, '2023-01-02 04:46:32', '2023-01-02 04:46:32', NULL),
(69, '1672634792_6.pdf', 'PJLkKprqCo1672634791', 'uploads/idea_revision/2974362761_1672634792_6.pdf', NULL, '2023-01-02 04:46:32', '2023-01-02 04:46:32', NULL),
(70, NULL, NULL, NULL, NULL, '2023-01-02 08:41:06', '2023-01-02 08:41:06', NULL),
(71, '1672648866_index.jpeg', 'leahUaDawV1672648866', 'uploads/idea_revision/6688462761_1672648866_index.jpeg', NULL, '2023-01-02 08:41:06', '2023-01-02 08:41:06', NULL),
(72, NULL, NULL, NULL, NULL, '2023-01-02 09:12:41', '2023-01-02 09:12:41', NULL),
(73, NULL, NULL, NULL, NULL, '2023-01-02 09:12:41', '2023-01-02 09:12:41', NULL),
(74, '1672650761_rain_transport_city_135952_1280x1024.jpg', 'YjRTIjUIRO1672650786', 'uploads/idea_revision/6870562761_1672650761_rain_transport_city_135952_1280x1024.jpg', NULL, '2023-01-02 09:13:06', '2023-01-02 09:13:06', NULL),
(75, '1672650761_phoenix-valorant-4k-2020-3t-1280x1024.jpg', 'YjRTIjUIRO1672650786', 'uploads/idea_revision/7870562761_1672650761_phoenix-valorant-4k-2020-3t-1280x1024.jpg', NULL, '2023-01-02 09:13:07', '2023-01-02 09:13:07', NULL),
(76, NULL, NULL, NULL, NULL, '2023-01-02 09:13:57', '2023-01-02 09:13:57', NULL),
(77, '1672650837_mat-napo-lsOEFt9YgeY-unsplash.jpg', 'WlZegHlkvX1672650837', 'uploads/idea_revision/7380562761_1672650837_mat-napo-lsOEFt9YgeY-unsplash.jpg', NULL, '2023-01-02 09:13:57', '2023-01-02 09:13:57', NULL),
(78, '1672650761_rain_transport_city_135952_1280x1024.jpg', 'WlZegHlkvX1672650837', 'uploads/idea_revision/7380562761_1672650761_rain_transport_city_135952_1280x1024.jpg', NULL, '2023-01-02 09:13:57', '2023-01-02 09:13:57', NULL),
(79, '1672650761_phoenix-valorant-4k-2020-3t-1280x1024.jpg', 'WlZegHlkvX1672650837', 'uploads/idea_revision/7380562761_1672650761_phoenix-valorant-4k-2020-3t-1280x1024.jpg', NULL, '2023-01-02 09:13:57', '2023-01-02 09:13:57', NULL),
(80, '1672651690_1666169006_file-sample_100kB.doc', 'fPXOggIOCA1672651690', 'uploads/idea_revision/1672651690_1666169006_file-sample_100kB.doc', 'LRhBjpbrLU1672651690', '2023-01-02 09:28:10', '2023-01-02 09:28:10', NULL),
(81, '1672653453_fusion.png', 'DNAQEaalYM1672653453', 'uploads/idea_revision/1672653453_fusion.png', NULL, '2023-01-02 09:57:35', '2023-01-02 09:57:35', NULL),
(82, '1672653455_Gogeta_&_Broly.png', 'DNAQEaalYM1672653453', 'uploads/idea_revision/1672653455_Gogeta_&_Broly.png', NULL, '2023-01-02 09:57:35', '2023-01-02 09:57:35', NULL),
(83, '1672653455_fusion_2.png', 'DNAQEaalYM1672653453', 'uploads/idea_revision/1672653455_fusion_2.png', NULL, '2023-01-02 09:57:38', '2023-01-02 09:57:38', NULL),
(84, '1672653698_Screenshot_20221230_120413.png', 'bmCtzlHIxv1672653698', 'uploads/idea_revision/1672653698_Screenshot_20221230_120413.png', NULL, '2023-01-02 10:01:38', '2023-01-02 10:01:38', NULL),
(85, '1672653698_exchange-dollar-line.png', 'bmCtzlHIxv1672653698', 'uploads/idea_revision/1672653698_exchange-dollar-line.png', NULL, '2023-01-02 10:01:38', '2023-01-02 10:01:38', NULL),
(86, '1672653698_linkedin-app_2.png', 'bmCtzlHIxv1672653698', 'uploads/idea_revision/1672653698_linkedin-app_2.png', NULL, '2023-01-02 10:01:38', '2023-01-02 10:01:38', NULL),
(87, '1672653698_home-gear-line.png', 'bmCtzlHIxv1672653698', 'uploads/idea_revision/1672653698_home-gear-line.png', NULL, '2023-01-02 10:01:39', '2023-01-02 10:01:39', NULL),
(88, '1672653699_Location.png', 'bmCtzlHIxv1672653698', 'uploads/idea_revision/1672653699_Location.png', NULL, '2023-01-02 10:01:39', '2023-01-02 10:01:39', NULL),
(89, '1672745944_street_night_wet_155637_1280x1024.jpg', 'HmvmXJooyB1672745944', 'uploads/idea_revision/1672745944_street_night_wet_155637_1280x1024.jpg', NULL, '2023-01-03 11:39:05', '2023-01-03 11:39:05', NULL),
(90, '1672745945_g-h.ghd.jpg', 'HmvmXJooyB1672745944', 'uploads/idea_revision/1672745945_g-h.ghd.jpg', NULL, '2023-01-03 11:39:05', '2023-01-03 11:39:05', NULL),
(91, '1672745945_testing.jpg', 'HmvmXJooyB1672745944', 'uploads/idea_revision/1672745945_testing.jpg', NULL, '2023-01-03 11:39:07', '2023-01-03 11:39:07', NULL),
(92, NULL, NULL, NULL, NULL, '2023-01-03 11:39:33', '2023-01-03 11:39:33', NULL),
(93, NULL, NULL, NULL, NULL, '2023-01-03 11:39:33', '2023-01-03 11:39:33', NULL),
(94, '1672745944_street_night_wet_155637_1280x1024.jpg', 'jhzVcXoPqH1672745973', 'uploads/idea_revision/3795472761_1672745944_street_night_wet_155637_1280x1024.jpg', NULL, '2023-01-03 11:39:33', '2023-01-03 11:39:33', NULL),
(95, '1672745945_g-h.ghd.jpg', 'jhzVcXoPqH1672745973', 'uploads/idea_revision/3795472761_1672745945_g-h.ghd.jpg', NULL, '2023-01-03 11:39:33', '2023-01-03 11:39:33', NULL),
(96, '1672745945_testing.jpg', 'jhzVcXoPqH1672745973', 'uploads/idea_revision/3795472761_1672745945_testing.jpg', NULL, '2023-01-03 11:39:33', '2023-01-03 11:39:33', NULL),
(97, '1672745973_photo_2022-09-05_14-26-07.jpg', 'jhzVcXoPqH1672745973', 'uploads/idea_revision/3795472761_1672745973_photo_2022-09-05_14-26-07.jpg', NULL, '2023-01-03 11:39:33', '2023-01-03 11:39:33', NULL),
(98, '1672745973_1662053761631.jpg', 'jhzVcXoPqH1672745973', 'uploads/idea_revision/3795472761_1672745973_1662053761631.jpg', NULL, '2023-01-03 11:39:33', '2023-01-03 11:39:33', NULL),
(99, '1672746045_fff&text=+1280x1024+.png', 'opkTDYRfqG1672746045', 'uploads/idea_revision/1672746045_fff&text=+1280x1024+.png', NULL, '2023-01-03 11:40:45', '2023-01-03 11:40:45', NULL),
(100, '1672829040_1672122674_1667370956_1666169006_file-sample_100kB_(2).doc', 'nEeHnoozWj1672829040', 'uploads/idea_revision/1672829040_1672122674_1667370956_1666169006_file-sample_100kB_(2).doc', NULL, '2023-01-04 10:44:01', '2023-01-04 10:44:01', NULL),
(101, '1672829041_testing.jpg', 'nEeHnoozWj1672829040', 'uploads/idea_revision/1672829041_testing.jpg', NULL, '2023-01-04 10:44:01', '2023-01-04 10:44:01', NULL),
(102, '1672829041_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', 'nEeHnoozWj1672829040', 'uploads/idea_revision/1672829041_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', NULL, '2023-01-04 10:44:01', '2023-01-04 10:44:01', NULL),
(103, '1672829041_Dirt-3-HD-1280-x-1024-Wallpaper-620x496.jpg', 'nEeHnoozWj1672829040', 'uploads/idea_revision/1672829041_Dirt-3-HD-1280-x-1024-Wallpaper-620x496.jpg', NULL, '2023-01-04 10:44:01', '2023-01-04 10:44:01', NULL),
(104, '1672829041_street_night_wet_155637_1280x1024.jpg', 'nEeHnoozWj1672829040', 'uploads/idea_revision/1672829041_street_night_wet_155637_1280x1024.jpg', NULL, '2023-01-04 10:44:03', '2023-01-04 10:44:03', NULL),
(105, '1672829043_g-h.ghd.jpg', 'nEeHnoozWj1672829040', 'uploads/idea_revision/1672829043_g-h.ghd.jpg', NULL, '2023-01-04 10:44:03', '2023-01-04 10:44:03', NULL),
(106, '1672829043_1662053761631.jpg', 'nEeHnoozWj1672829040', 'uploads/idea_revision/1672829043_1662053761631.jpg', NULL, '2023-01-04 10:44:03', '2023-01-04 10:44:03', NULL),
(107, '1672829043_1662089829671.pdf', 'nEeHnoozWj1672829040', 'uploads/idea_revision/1672829043_1662089829671.pdf', NULL, '2023-01-04 10:44:07', '2023-01-04 10:44:07', NULL),
(108, '1672829040_1672122674_1667370956_1666169006_file-sample_100kB_(2).doc', 'PsnZtYHlMT1672829254', 'uploads/idea_revision/4529282761_1672829040_1672122674_1667370956_1666169006_file-sample_100kB_(2).doc', NULL, '2023-01-04 10:47:34', '2023-01-04 10:47:34', NULL),
(109, '1672829041_testing.jpg', 'PsnZtYHlMT1672829254', 'uploads/idea_revision/4529282761_1672829041_testing.jpg', NULL, '2023-01-04 10:47:34', '2023-01-04 10:47:34', NULL),
(110, '1672829041_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', 'PsnZtYHlMT1672829254', 'uploads/idea_revision/4529282761_1672829041_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', NULL, '2023-01-04 10:47:34', '2023-01-04 10:47:34', NULL),
(111, '1672829041_Dirt-3-HD-1280-x-1024-Wallpaper-620x496.jpg', 'PsnZtYHlMT1672829254', 'uploads/idea_revision/4529282761_1672829041_Dirt-3-HD-1280-x-1024-Wallpaper-620x496.jpg', NULL, '2023-01-04 10:47:34', '2023-01-04 10:47:34', NULL),
(112, '1672829041_street_night_wet_155637_1280x1024.jpg', 'PsnZtYHlMT1672829254', 'uploads/idea_revision/4529282761_1672829041_street_night_wet_155637_1280x1024.jpg', NULL, '2023-01-04 10:47:34', '2023-01-04 10:47:34', NULL),
(113, '1672829043_g-h.ghd.jpg', 'PsnZtYHlMT1672829254', 'uploads/idea_revision/4529282761_1672829043_g-h.ghd.jpg', NULL, '2023-01-04 10:47:34', '2023-01-04 10:47:34', NULL),
(114, '1672829043_1662053761631.jpg', 'PsnZtYHlMT1672829254', 'uploads/idea_revision/4529282761_1672829043_1662053761631.jpg', NULL, '2023-01-04 10:47:34', '2023-01-04 10:47:34', NULL),
(115, '1672829043_1662089829671.pdf', 'PsnZtYHlMT1672829254', 'uploads/idea_revision/4529282761_1672829043_1662089829671.pdf', NULL, '2023-01-04 10:47:37', '2023-01-04 10:47:37', NULL),
(116, '1673326027_testing.jpg', 'CqjKvdAIKl1673326027', 'uploads/idea_revision/1673326027_testing.jpg', NULL, '2023-01-10 04:47:07', '2023-01-10 04:47:07', NULL),
(117, '1673326027_1667291140_1666169006_file-sample_100kB.doc', 'CqjKvdAIKl1673326027', 'uploads/idea_revision/1673326027_1667291140_1666169006_file-sample_100kB.doc', NULL, '2023-01-10 04:47:08', '2023-01-10 04:47:08', NULL),
(118, '1673326028_g-h.ghd.jpg', 'CqjKvdAIKl1673326027', 'uploads/idea_revision/1673326028_g-h.ghd.jpg', NULL, '2023-01-10 04:47:08', '2023-01-10 04:47:08', NULL),
(119, '1673326028_1662053761631.jpg', 'CqjKvdAIKl1673326027', 'uploads/idea_revision/1673326028_1662053761631.jpg', NULL, '2023-01-10 04:47:08', '2023-01-10 04:47:08', NULL),
(120, '1673326028_Dirt-3-HD-1280-x-1024-Wallpaper-620x496.jpg', 'CqjKvdAIKl1673326027', 'uploads/idea_revision/1673326028_Dirt-3-HD-1280-x-1024-Wallpaper-620x496.jpg', NULL, '2023-01-10 04:47:08', '2023-01-10 04:47:08', NULL),
(121, '1673326028_street_night_wet_155637_1280x1024.jpg', 'CqjKvdAIKl1673326027', 'uploads/idea_revision/1673326028_street_night_wet_155637_1280x1024.jpg', NULL, '2023-01-10 04:47:09', '2023-01-10 04:47:09', NULL),
(122, '1673326029_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', 'CqjKvdAIKl1673326027', 'uploads/idea_revision/1673326029_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', NULL, '2023-01-10 04:47:09', '2023-01-10 04:47:09', NULL),
(123, '1673326029_1280-x-1024-Space-Wallpaper.jpg', 'CqjKvdAIKl1673326027', 'uploads/idea_revision/1673326029_1280-x-1024-Space-Wallpaper.jpg', NULL, '2023-01-10 04:47:11', '2023-01-10 04:47:11', NULL),
(124, '1673326031_5650530.png', 'CqjKvdAIKl1673326027', 'uploads/idea_revision/1673326031_5650530.png', NULL, '2023-01-10 04:47:11', '2023-01-10 04:47:11', NULL),
(125, '1673326031_3053649.jpg', 'CqjKvdAIKl1673326027', 'uploads/idea_revision/1673326031_3053649.jpg', NULL, '2023-01-10 04:47:11', '2023-01-10 04:47:11', NULL),
(126, '1673326031_1662089829671.pdf', 'CqjKvdAIKl1673326027', 'uploads/idea_revision/1673326031_1662089829671.pdf', NULL, '2023-01-10 04:47:15', '2023-01-10 04:47:15', NULL),
(127, '1673500675_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', 'okpwBHjydg1673500675', 'uploads/idea_revision/1673500675_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', NULL, '2023-01-12 05:17:55', '2023-01-12 05:17:55', NULL),
(128, '1673500675_1667370956_1666169006_file-sample_100kB.doc', 'okpwBHjydg1673500675', 'uploads/idea_revision/1673500675_1667370956_1666169006_file-sample_100kB.doc', NULL, '2023-01-12 05:17:55', '2023-01-12 05:17:55', NULL),
(129, '1673500675_Dirt-3-HD-1280-x-1024-Wallpaper-620x496.jpg', 'okpwBHjydg1673500675', 'uploads/idea_revision/1673500675_Dirt-3-HD-1280-x-1024-Wallpaper-620x496.jpg', NULL, '2023-01-12 05:17:56', '2023-01-12 05:17:56', NULL),
(130, '1673500676_5650530.png', 'okpwBHjydg1673500675', 'uploads/idea_revision/1673500676_5650530.png', NULL, '2023-01-12 05:17:56', '2023-01-12 05:17:56', NULL),
(131, '1673500676_street_night_wet_155637_1280x1024.jpg', 'okpwBHjydg1673500675', 'uploads/idea_revision/1673500676_street_night_wet_155637_1280x1024.jpg', NULL, '2023-01-12 05:17:56', '2023-01-12 05:17:56', NULL),
(132, '1673500676_1662053761631.jpg', 'okpwBHjydg1673500675', 'uploads/idea_revision/1673500676_1662053761631.jpg', NULL, '2023-01-12 05:17:56', '2023-01-12 05:17:56', NULL),
(133, '1673500676_Laravel_Notes.pdf', 'okpwBHjydg1673500675', 'uploads/idea_revision/1673500676_Laravel_Notes.pdf', NULL, '2023-01-12 05:17:57', '2023-01-12 05:17:57', NULL),
(134, '1673500677_3053649.jpg', 'okpwBHjydg1673500675', 'uploads/idea_revision/1673500677_3053649.jpg', NULL, '2023-01-12 05:17:57', '2023-01-12 05:17:57', NULL),
(135, '1673500677_1661532207960.jpg', 'okpwBHjydg1673500675', 'uploads/idea_revision/1673500677_1661532207960.jpg', NULL, '2023-01-12 05:17:58', '2023-01-12 05:17:58', NULL),
(136, NULL, NULL, NULL, NULL, '2023-01-12 05:24:12', '2023-01-12 05:24:12', NULL),
(137, '1673500675_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', 'yDSarWaWPQ1673501052', 'uploads/idea_revision/2501053761_1673500675_Golden-Bridge-1280-x-1024-HD-Wallpaper-620x496.jpg', NULL, '2023-01-12 05:24:12', '2023-01-12 05:24:12', NULL),
(138, '1673500675_1667370956_1666169006_file-sample_100kB.doc', 'yDSarWaWPQ1673501052', 'uploads/idea_revision/2501053761_1673500675_1667370956_1666169006_file-sample_100kB.doc', NULL, '2023-01-12 05:24:12', '2023-01-12 05:24:12', NULL),
(139, '1673500675_Dirt-3-HD-1280-x-1024-Wallpaper-620x496.jpg', 'yDSarWaWPQ1673501052', 'uploads/idea_revision/2501053761_1673500675_Dirt-3-HD-1280-x-1024-Wallpaper-620x496.jpg', NULL, '2023-01-12 05:24:12', '2023-01-12 05:24:12', NULL),
(140, '1673500676_5650530.png', 'yDSarWaWPQ1673501052', 'uploads/idea_revision/2501053761_1673500676_5650530.png', NULL, '2023-01-12 05:24:12', '2023-01-12 05:24:12', NULL),
(141, '1673500676_street_night_wet_155637_1280x1024.jpg', 'yDSarWaWPQ1673501052', 'uploads/idea_revision/2501053761_1673500676_street_night_wet_155637_1280x1024.jpg', NULL, '2023-01-12 05:24:12', '2023-01-12 05:24:12', NULL),
(142, '1673501052_image.png', 'yDSarWaWPQ1673501052', 'uploads/idea_revision/2501053761_1673501052_image.png', NULL, '2023-01-12 05:24:12', '2023-01-12 05:24:12', NULL),
(143, '1673500676_Laravel_Notes.pdf', 'yDSarWaWPQ1673501052', 'uploads/idea_revision/2501053761_1673500676_Laravel_Notes.pdf', NULL, '2023-01-12 05:24:12', '2023-01-12 05:24:12', NULL),
(144, '1673500677_3053649.jpg', 'yDSarWaWPQ1673501052', 'uploads/idea_revision/2501053761_1673500677_3053649.jpg', NULL, '2023-01-12 05:24:12', '2023-01-12 05:24:12', NULL),
(145, '1673500677_1661532207960.jpg', 'yDSarWaWPQ1673501052', 'uploads/idea_revision/2501053761_1673500677_1661532207960.jpg', NULL, '2023-01-12 05:24:14', '2023-01-12 05:24:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `idea_status`
--

CREATE TABLE `idea_status` (
  `idea_status_id` int(11) NOT NULL,
  `idea_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_role` varchar(100) DEFAULT NULL,
  `idea_status` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `idea_status`
--

INSERT INTO `idea_status` (`idea_status_id`, `idea_id`, `user_id`, `user_role`, `idea_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 8, NULL, NULL, '2022-10-28 10:33:41', '2022-10-28 10:33:41', NULL),
(4, 2, 15, NULL, NULL, '2022-10-28 10:51:43', '2022-10-28 10:51:43', NULL),
(5, 4, 8, NULL, NULL, '2022-10-29 06:11:36', '2022-10-29 06:11:36', NULL),
(6, 6, 1, NULL, NULL, '2022-10-29 12:42:15', '2022-10-29 12:42:15', NULL),
(7, 7, 1, NULL, NULL, '2022-11-01 06:07:04', '2022-11-01 06:07:04', NULL),
(8, 8, 1, NULL, NULL, '2022-11-01 06:16:29', '2022-11-01 06:16:29', NULL),
(9, 8, 1, NULL, NULL, '2022-11-01 06:16:42', '2022-11-01 06:16:42', NULL),
(10, 8, 1, NULL, NULL, '2022-11-01 06:16:44', '2022-11-01 06:16:44', NULL),
(11, 8, 1, NULL, NULL, '2022-11-01 06:16:45', '2022-11-01 06:16:45', NULL),
(12, 8, 1, NULL, NULL, '2022-11-01 06:16:45', '2022-11-01 06:16:45', NULL),
(13, 8, 1, NULL, NULL, '2022-11-01 06:16:52', '2022-11-01 06:16:52', NULL),
(14, 8, 1, NULL, NULL, '2022-11-01 06:17:00', '2022-11-01 06:17:00', NULL),
(15, 8, 1, NULL, NULL, '2022-11-01 06:17:06', '2022-11-01 06:17:06', NULL),
(16, 8, 1, NULL, NULL, '2022-11-01 06:17:14', '2022-11-01 06:17:14', NULL),
(17, 8, 1, NULL, NULL, '2022-11-01 06:17:21', '2022-11-01 06:17:21', NULL),
(18, 9, 1, NULL, NULL, '2022-11-01 06:23:08', '2022-11-01 06:23:08', NULL),
(19, 10, 103, NULL, NULL, '2022-11-01 08:09:14', '2022-11-01 08:09:14', NULL),
(20, 12, 103, NULL, NULL, '2022-11-01 08:27:07', '2022-11-01 08:27:07', NULL),
(21, 14, 15, NULL, NULL, '2022-11-01 10:13:56', '2022-11-01 10:13:56', NULL),
(22, 15, 17, NULL, NULL, '2022-11-02 13:14:30', '2022-11-02 13:14:30', NULL),
(23, 15, 17, NULL, NULL, '2022-11-02 13:14:44', '2022-11-02 13:14:44', NULL),
(24, 16, 17, NULL, NULL, '2022-11-02 13:19:45', '2022-11-02 13:19:45', NULL),
(25, 18, 17, NULL, NULL, '2022-11-03 12:17:31', '2022-11-03 12:17:31', NULL),
(26, 19, 17, NULL, NULL, '2022-11-04 05:46:12', '2022-11-04 05:46:12', NULL),
(27, 19, 20, NULL, NULL, '2022-11-21 10:31:27', '2022-11-21 10:31:27', NULL),
(28, 27, 22, NULL, NULL, '2022-11-23 11:15:35', '2022-11-23 11:15:35', NULL),
(29, 27, 25, NULL, NULL, '2022-11-23 11:23:28', '2022-11-23 11:23:28', NULL),
(30, 26, 22, NULL, NULL, '2022-11-23 11:24:17', '2022-11-23 11:24:17', NULL),
(31, 26, 25, NULL, NULL, '2022-11-23 11:25:31', '2022-11-23 11:25:31', NULL),
(32, 26, 26, 'Implementation', 'implemented', '2022-11-23 11:29:40', '2022-11-23 11:29:40', NULL),
(33, 29, 22, 'Assessment Team', 'assessment_team_approved', '2022-11-29 10:55:43', '2022-11-29 10:55:43', NULL),
(34, 29, 25, 'Approving Authority', 'rejected', '2022-11-29 10:58:21', '2022-11-29 10:58:21', NULL),
(35, 30, 22, 'Assessment Team', 'rejected', '2022-11-30 05:14:46', '2022-11-30 05:14:46', NULL),
(36, 31, 22, 'Assessment Team', 'assessment_team_approved', '2022-11-30 05:41:13', '2022-11-30 05:41:13', NULL),
(37, 31, 25, 'Approving Authority', 'approving_authority_approved', '2022-11-30 05:51:55', '2022-11-30 05:51:55', NULL),
(38, 31, 26, 'Implementation', 'implemented', '2022-11-30 05:53:38', '2022-11-30 05:53:38', NULL),
(39, 32, 22, 'Assessment Team', 'assessment_team_approved', '2022-11-30 05:55:32', '2022-11-30 05:55:32', NULL),
(40, 32, 25, 'Approving Authority', 'approving_authority_approved', '2022-11-30 05:55:48', '2022-11-30 05:55:48', NULL),
(41, 32, 26, 'Implementation', 'implemented', '2022-11-30 05:56:49', '2022-11-30 05:56:49', NULL),
(42, 14, 27, 'Approving Authority', 'approving_authority_approved', '2022-12-05 07:27:41', '2022-12-05 07:27:41', NULL),
(43, 24, 21, 'Assessment Team', 'assessment_team_approved', '2022-12-05 10:55:18', '2022-12-05 10:55:18', NULL),
(44, 24, 25, 'Approving Authority', 'approving_authority_approved', '2022-12-05 10:57:47', '2022-12-05 10:57:47', NULL),
(45, 24, 26, 'Implementation', 'implemented', '2022-12-05 10:59:12', '2022-12-05 10:59:12', NULL),
(46, 34, 21, 'Assessment Team', 'assessment_team_approved', '2022-12-06 05:40:10', '2022-12-06 05:40:10', NULL),
(47, 34, 25, 'Approving Authority', 'approving_authority_approved', '2022-12-06 05:40:43', '2022-12-06 05:40:43', NULL),
(48, 34, 26, 'Implementation', 'implemented', '2022-12-06 06:01:26', '2022-12-06 06:01:26', NULL),
(49, 35, 21, 'Assessment Team', 'assessment_team_approved', '2022-12-07 07:20:44', '2022-12-07 07:20:44', NULL),
(50, 35, 25, 'Approving Authority', 'approving_authority_approved', '2022-12-07 07:49:32', '2022-12-07 07:49:32', NULL),
(51, 35, 26, 'Implementation', 'implemented', '2022-12-07 07:50:08', '2022-12-07 07:50:08', NULL),
(52, 36, 21, 'Assessment Team', 'assessment_team_approved', '2022-12-07 08:33:39', '2022-12-07 08:33:39', NULL),
(53, 36, 25, 'Approving Authority', 'approving_authority_approved', '2022-12-07 08:36:50', '2022-12-07 08:36:50', NULL),
(54, 36, 26, 'Implementation', 'implemented', '2022-12-07 08:37:47', '2022-12-07 08:37:47', NULL),
(55, 38, 30, 'Assessment Team', 'assessment_team_approved', '2022-12-08 05:28:00', '2022-12-08 05:28:00', NULL),
(56, 38, 32, 'Implementation', 'approving_authority_approved', '2022-12-08 05:31:39', '2022-12-08 05:31:39', NULL),
(57, 38, 32, 'Implementation', 'implemented', '2022-12-08 05:32:59', '2022-12-08 05:32:59', NULL),
(58, 39, 30, 'Assessment Team', 'assessment_team_approved', '2022-12-08 06:44:29', '2022-12-08 06:44:29', NULL),
(59, 39, 31, 'Approving Authority', 'approving_authority_approved', '2022-12-08 06:58:31', '2022-12-08 06:58:31', NULL),
(60, 39, 32, 'Implementation', 'implemented', '2022-12-08 07:14:30', '2022-12-08 07:14:30', NULL),
(61, 40, 34, 'Assessment Team', 'assessment_team_approved', '2022-12-12 07:20:29', '2022-12-12 07:20:29', NULL),
(62, 40, 36, 'Approving Authority', 'approving_authority_approved', '2022-12-12 07:35:37', '2022-12-12 07:35:37', NULL),
(63, 40, 35, 'Implementation', 'implemented', '2022-12-12 07:36:33', '2022-12-12 07:36:33', NULL),
(64, 41, 34, 'Assessment Team', 'assessment_team_approved', '2022-12-13 05:13:51', '2022-12-13 05:13:51', NULL),
(66, 41, 36, 'Approving Authority', 'approving_authority_approved', '2022-12-13 09:37:31', '2022-12-13 09:37:31', NULL),
(67, 28, 21, 'Assessment Team', 'assessment_team_approved', '2022-12-14 09:07:20', '2022-12-14 09:07:20', NULL),
(68, 28, 25, 'Approving Authority', 'approving_authority_approved', '2022-12-14 09:12:23', '2022-12-14 09:12:23', NULL),
(69, 28, 26, 'Implementation', 'implemented', '2022-12-14 09:16:57', '2022-12-14 09:16:57', NULL),
(70, 43, 21, 'Assessment Team', 'assessment_team_approved', '2022-12-15 13:22:13', '2022-12-15 13:22:13', NULL),
(71, 43, 25, 'Approving Authority', 'approving_authority_approved', '2022-12-15 13:23:10', '2022-12-15 13:23:10', NULL),
(72, 41, 35, 'Implementation', 'implemented', '2022-12-16 07:37:08', '2022-12-16 07:37:08', NULL),
(73, 45, 34, 'Assessment Team', 'assessment_team_approved', '2022-12-16 07:50:24', '2022-12-16 07:50:24', NULL),
(74, 45, 36, 'Approving Authority', 'approving_authority_approved', '2022-12-16 07:58:58', '2022-12-16 07:58:58', NULL),
(75, 45, 35, 'Implementation', 'implemented', '2022-12-16 08:00:34', '2022-12-16 08:00:34', NULL),
(76, 47, 21, 'Assessment Team', 'assessment_team_approved', '2022-12-17 12:06:06', '2022-12-17 12:06:06', NULL),
(77, 47, 25, 'Approving Authority', 'rejected', '2022-12-17 12:07:55', '2022-12-17 12:07:55', NULL),
(78, 48, 21, 'Assessment Team', 'assessment_team_approved', '2022-12-17 12:09:57', '2022-12-17 12:09:57', NULL),
(79, 48, 25, 'Approving Authority', 'approving_authority_approved', '2022-12-17 12:10:15', '2022-12-17 12:10:15', NULL),
(80, 48, 26, 'Implementation', 'implemented', '2022-12-17 12:11:12', '2022-12-17 12:11:12', NULL),
(81, 60, 34, 'Assessment Team', 'assessment_team_approved', '2023-01-02 06:46:48', '2023-01-02 06:46:48', NULL),
(82, 63, 21, 'Assessment Team', 'assessment_team_approved', '2023-01-02 10:02:06', '2023-01-02 10:02:06', NULL),
(83, 63, 25, 'Approving Authority', 'approving_authority_approved', '2023-01-02 10:03:33', '2023-01-02 10:03:33', NULL),
(84, 63, 26, 'Implementation', 'implemented', '2023-01-02 10:05:42', '2023-01-02 10:05:42', NULL),
(85, 66, 21, 'Assessment Team', 'assessment_team_approved', '2023-01-04 10:49:38', '2023-01-04 10:49:38', NULL),
(86, 66, 25, 'Approving Authority', 'approving_authority_approved', '2023-01-04 10:53:21', '2023-01-04 10:53:21', NULL),
(87, 66, 26, 'Implementation', 'implemented', '2023-01-04 10:55:02', '2023-01-04 10:55:02', NULL),
(88, 52, 34, 'Assessment Team', 'assessment_team_approved', '2023-01-08 12:53:59', '2023-01-08 12:53:59', NULL),
(89, 52, 36, 'Approving Authority', 'approving_authority_approved', '2023-01-08 13:01:24', '2023-01-08 13:01:24', NULL),
(90, 68, 21, 'Assessment Team', 'assessment_team_approved', '2023-01-10 04:48:34', '2023-01-10 04:48:34', NULL),
(91, 68, 25, 'Approving Authority', 'approving_authority_approved', '2023-01-10 04:49:59', '2023-01-10 04:49:59', NULL),
(92, 68, 26, 'Implementation', 'implemented', '2023-01-10 04:50:33', '2023-01-10 04:50:33', NULL),
(93, 70, 21, 'Assessment Team', 'assessment_team_approved', '2023-01-12 05:25:49', '2023-01-12 05:25:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `location_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Chennai', '2022-11-14 01:19:48', '2022-12-12 06:43:35', NULL),
(2, 'New Location 2 edited', '2022-11-14 01:20:12', '2022-11-14 01:31:20', '2022-11-14 01:31:20'),
(3, 'New Location 3 edited', '2022-11-14 01:48:27', '2022-11-14 01:48:45', '2022-11-14 01:48:45'),
(4, 'New location 4', '2022-11-14 01:48:55', '2022-11-14 01:48:59', '2022-11-14 01:48:59'),
(5, 'Kolkatta', '2022-11-16 04:10:47', '2022-12-12 06:43:24', NULL),
(6, 'Delhi', '2022-11-16 04:10:55', '2022-12-12 06:43:08', NULL),
(7, 'Mumbai', '2022-11-18 05:41:36', '2022-12-12 06:42:55', NULL),
(8, 'test location edited', '2023-01-04 08:09:41', '2023-01-04 08:11:21', '2023-01-04 08:11:21'),
(9, 'f', '2023-01-04 08:21:21', '2023-01-04 09:19:30', '2023-01-04 09:19:30'),
(10, '2', '2023-01-04 09:19:13', '2023-01-04 09:19:27', '2023-01-04 09:19:27');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL,
  `idea_uni_id` varchar(200) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `description` text,
  `receiver_id` varchar(255) DEFAULT NULL,
  `notification_read` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification_id`, `idea_uni_id`, `title`, `description`, `receiver_id`, `notification_read`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'New Idea', NULL, '15,119', 1, '2022-12-27 11:41:20', '2022-12-28 04:23:20', NULL),
(2, NULL, 'New Idea', 'New Idea has been created :Testing idea 04', '15,119', 1, '2022-12-27 11:42:48', '2022-12-28 04:23:20', NULL),
(3, NULL, 'New Idea', 'New Idea has been created : Est deleniti consequ', '15,119', 1, '2022-12-27 13:29:18', '2022-12-28 04:23:20', NULL),
(4, NULL, 'New Idea', 'New Idea has been created : Sapiente amet vitae', '15,119', 0, '2022-12-28 05:15:03', '2022-12-28 05:15:03', NULL),
(5, NULL, 'New Idea', 'New Idea has been created : Testing multiple files upload 3', '19,21,22', 0, '2022-12-28 05:41:19', '2022-12-28 05:41:19', NULL),
(6, NULL, 'New Idea', 'New Idea has been created : test', '19,21,22', 0, '2022-12-28 06:42:21', '2022-12-28 06:42:21', NULL),
(7, NULL, 'New Idea', 'New Idea has been created : test 22', '19,21,22', 0, '2022-12-28 08:03:48', '2022-12-28 08:03:48', NULL),
(8, NULL, 'New Idea', 'New Idea has been created : Test doc', '19,21,22', 0, '2022-12-28 08:38:40', '2022-12-28 08:38:40', NULL),
(9, NULL, 'New Idea', 'New Idea has been created : change  in      process', '34', 0, '2022-12-30 09:20:41', '2022-12-30 09:20:41', NULL),
(10, NULL, 'New Idea', 'New Idea has been created : cost saving in IT Expenses', '34', 0, '2022-12-30 09:45:01', '2022-12-30 09:45:01', NULL),
(11, 'DNAQEaalYM1672653453', 'New Idea', 'New Idea has been created : Testing Text', '19', 0, '2023-01-02 09:57:38', '2023-01-02 09:57:38', NULL),
(12, 'DNAQEaalYM1672653453', 'New Idea', 'New Idea has been created : Testing Text', '21', 1, '2023-01-02 09:57:38', '2023-01-02 09:58:01', NULL),
(13, 'DNAQEaalYM1672653453', 'New Idea', 'New Idea has been created : Testing Text', '22', 0, '2023-01-02 09:57:38', '2023-01-02 09:57:38', NULL),
(14, 'bmCtzlHIxv1672653698', 'New Idea', 'New Idea has been created : Hello World', '19', 0, '2023-01-02 10:01:39', '2023-01-02 10:01:39', NULL),
(15, 'bmCtzlHIxv1672653698', 'New Idea', 'New Idea has been created : Hello World', '21', 1, '2023-01-02 10:01:39', '2023-01-02 10:01:47', NULL),
(16, 'bmCtzlHIxv1672653698', 'New Idea', 'New Idea has been created : Hello World', '22', 0, '2023-01-02 10:01:39', '2023-01-02 10:01:39', NULL),
(17, 'bmCtzlHIxv1672653698', 'The status of the Idea has been changed to Under Assessment by Rock Lee (Assessment Team)', 'Idea Title : Hello World', '23', 1, '2023-01-02 10:02:01', '2023-01-02 10:02:04', NULL),
(18, 'bmCtzlHIxv1672653698', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : Hello World', '23', 1, '2023-01-02 10:02:06', '2023-01-02 10:02:17', NULL),
(19, 'bmCtzlHIxv1672653698', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : Hello World', '20', 0, '2023-01-02 10:02:06', '2023-01-02 10:02:06', NULL),
(20, 'bmCtzlHIxv1672653698', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : Hello World', '24', 0, '2023-01-02 10:02:06', '2023-01-02 10:02:06', NULL),
(21, 'bmCtzlHIxv1672653698', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : Hello World', '25', 1, '2023-01-02 10:02:06', '2023-01-02 10:02:47', NULL),
(22, 'bmCtzlHIxv1672653698', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : Hello World', '27', 0, '2023-01-02 10:02:06', '2023-01-02 10:02:06', NULL),
(23, 'bmCtzlHIxv1672653698', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : Hello World', '31', 0, '2023-01-02 10:02:06', '2023-01-02 10:02:06', NULL),
(24, 'bmCtzlHIxv1672653698', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : Hello World', '36', 0, '2023-01-02 10:02:06', '2023-01-02 10:02:06', NULL),
(25, 'bmCtzlHIxv1672653698', 'The status of the Idea has been changed to Under Approval by Harish Yadav (Approving Authority)', 'Idea Title : Hello World', '23', 1, '2023-01-02 10:03:29', '2023-01-03 10:23:21', NULL),
(26, 'bmCtzlHIxv1672653698', 'Idea has been approved by Harish Yadav (Approving Authority)', 'Idea Title : Hello World', '23', 1, '2023-01-02 10:03:33', '2023-01-03 10:23:13', NULL),
(27, 'bmCtzlHIxv1672653698', 'Idea has been approved by Harish Yadav (Approving Authority)', 'Idea Title : Hello World', '26', 1, '2023-01-02 10:03:33', '2023-01-04 10:54:44', NULL),
(28, 'bmCtzlHIxv1672653698', 'Idea has been Implemented by Max McMan (Implementation Team)', 'Idea Title : Hello World', '23', 1, '2023-01-02 10:05:42', '2023-01-02 10:07:14', NULL),
(29, 'HmvmXJooyB1672745944', 'New Idea', 'New Idea has been created : Test 999', '19', 0, '2023-01-03 11:39:07', '2023-01-03 11:39:07', NULL),
(30, 'HmvmXJooyB1672745944', 'New Idea', 'New Idea has been created : Test 999', '21', 1, '2023-01-03 11:39:07', '2023-01-04 10:56:53', NULL),
(31, 'HmvmXJooyB1672745944', 'New Idea', 'New Idea has been created : Test 999', '22', 0, '2023-01-03 11:39:07', '2023-01-03 11:39:07', NULL),
(32, 'opkTDYRfqG1672746045', 'New Idea', 'New Idea has been created : Idea testing 9999', '19', 0, '2023-01-03 11:40:45', '2023-01-03 11:40:45', NULL),
(33, 'opkTDYRfqG1672746045', 'New Idea', 'New Idea has been created : Idea testing 9999', '21', 1, '2023-01-03 11:40:45', '2023-01-03 11:41:17', NULL),
(34, 'opkTDYRfqG1672746045', 'New Idea', 'New Idea has been created : Idea testing 9999', '22', 0, '2023-01-03 11:40:45', '2023-01-03 11:40:45', NULL),
(35, 'nEeHnoozWj1672829040', 'New Idea', 'New Idea has been created : new Idea For testing 001', '19', 0, '2023-01-04 10:44:07', '2023-01-04 10:44:07', NULL),
(36, 'nEeHnoozWj1672829040', 'New Idea', 'New Idea has been created : new Idea For testing 001', '21', 1, '2023-01-04 10:44:07', '2023-01-04 10:44:46', NULL),
(37, 'nEeHnoozWj1672829040', 'New Idea', 'New Idea has been created : new Idea For testing 001', '22', 0, '2023-01-04 10:44:07', '2023-01-04 10:44:07', NULL),
(38, 'nEeHnoozWj1672829040', 'Comment has been posted by  Rock Lee (Assessment Team)', 'Idea Title : new Idea For testing 001 <br> Comment : Idea seems good to me', '23', 1, '2023-01-04 10:45:18', '2023-01-04 10:45:26', NULL),
(39, 'nEeHnoozWj1672829040', 'The status of the Idea has been changed to On-hold by Rock Lee (Assessment Team)', 'Idea Title : new Idea For testing 001', '23', 1, '2023-01-04 10:45:40', '2023-01-04 10:45:47', NULL),
(40, 'nEeHnoozWj1672829040', 'The status of the Idea has been changed to Revise Request(Reason : Kindly provide detailed description ) by Rock Lee (Assessment Team)', 'Idea Title : new Idea For testing 001', '23', 1, '2023-01-04 10:46:55', '2023-01-04 10:47:07', NULL),
(41, 'nEeHnoozWj1672829040', 'The status of the Idea has been changed to On-hold by Rock Lee (Assessment Team)', 'Idea Title : new Idea For testing 001', '23', 1, '2023-01-04 10:48:57', '2023-01-04 10:49:02', NULL),
(42, 'nEeHnoozWj1672829040', 'The status of the Idea has been changed to Under Assessment by Rock Lee (Assessment Team)', 'Idea Title : new Idea For testing 001', '23', 1, '2023-01-04 10:49:35', '2023-01-04 10:49:48', NULL),
(43, 'nEeHnoozWj1672829040', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : new Idea For testing 001', '23', 1, '2023-01-04 10:49:38', '2023-01-04 10:49:51', NULL),
(44, 'nEeHnoozWj1672829040', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : new Idea For testing 001', '20', 0, '2023-01-04 10:49:38', '2023-01-04 10:49:38', NULL),
(45, 'nEeHnoozWj1672829040', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : new Idea For testing 001', '24', 0, '2023-01-04 10:49:38', '2023-01-04 10:49:38', NULL),
(46, 'nEeHnoozWj1672829040', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : new Idea For testing 001', '25', 1, '2023-01-04 10:49:38', '2023-01-04 10:52:52', NULL),
(47, 'nEeHnoozWj1672829040', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : new Idea For testing 001', '27', 0, '2023-01-04 10:49:38', '2023-01-04 10:49:38', NULL),
(48, 'nEeHnoozWj1672829040', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : new Idea For testing 001', '31', 0, '2023-01-04 10:49:38', '2023-01-04 10:49:38', NULL),
(49, 'nEeHnoozWj1672829040', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : new Idea For testing 001', '36', 0, '2023-01-04 10:49:38', '2023-01-04 10:49:38', NULL),
(50, 'nEeHnoozWj1672829040', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : new Idea For testing 001', '40', 0, '2023-01-04 10:49:38', '2023-01-04 10:49:38', NULL),
(51, 'nEeHnoozWj1672829040', 'Comment has been posted by  Harish Yadav (Approving Authority)', 'Idea Title : new Idea For testing 001 <br> Comment : I am approving the Idea', '23', 1, '2023-01-04 10:53:06', '2023-01-04 10:56:32', NULL),
(52, 'nEeHnoozWj1672829040', 'The status of the Idea has been changed to Under Approval by Harish Yadav (Approving Authority)', 'Idea Title : new Idea For testing 001', '23', 1, '2023-01-04 10:53:12', '2023-01-04 10:56:26', NULL),
(53, 'nEeHnoozWj1672829040', 'Idea has been approved by Harish Yadav (Approving Authority)', 'Idea Title : new Idea For testing 001', '23', 1, '2023-01-04 10:53:21', '2023-01-04 10:53:52', NULL),
(54, 'nEeHnoozWj1672829040', 'Idea has been approved by Harish Yadav (Approving Authority)', 'Idea Title : new Idea For testing 001', '26', 1, '2023-01-04 10:53:21', '2023-01-04 10:54:50', NULL),
(55, 'nEeHnoozWj1672829040', 'Idea has been Implemented by Max McMan (Implementation Team)', 'Idea Title : new Idea For testing 001', '23', 1, '2023-01-04 10:55:02', '2023-01-04 10:55:07', NULL),
(56, NULL, 'The status of the Idea has been changed to Under Assessment by pict asmt (Assessment Team)', 'Idea Title : Cost Saving for ITV running in Terminals', '33', 0, '2023-01-08 12:53:48', '2023-01-08 12:53:48', NULL),
(57, NULL, 'Idea has been approved by pict asmt (Assessment Team)', 'Idea Title : Cost Saving for ITV running in Terminals', '33', 0, '2023-01-08 12:53:59', '2023-01-08 12:53:59', NULL),
(58, NULL, 'Idea has been approved by pict asmt (Assessment Team)', 'Idea Title : Cost Saving for ITV running in Terminals', '20', 0, '2023-01-08 12:53:59', '2023-01-08 12:53:59', NULL),
(59, NULL, 'Idea has been approved by pict asmt (Assessment Team)', 'Idea Title : Cost Saving for ITV running in Terminals', '24', 0, '2023-01-08 12:53:59', '2023-01-08 12:53:59', NULL),
(60, NULL, 'Idea has been approved by pict asmt (Assessment Team)', 'Idea Title : Cost Saving for ITV running in Terminals', '25', 1, '2023-01-08 12:53:59', '2023-01-10 04:48:58', NULL),
(61, NULL, 'Idea has been approved by pict asmt (Assessment Team)', 'Idea Title : Cost Saving for ITV running in Terminals', '27', 0, '2023-01-08 12:53:59', '2023-01-08 12:53:59', NULL),
(62, NULL, 'Idea has been approved by pict asmt (Assessment Team)', 'Idea Title : Cost Saving for ITV running in Terminals', '31', 0, '2023-01-08 12:53:59', '2023-01-08 12:53:59', NULL),
(63, NULL, 'Idea has been approved by pict asmt (Assessment Team)', 'Idea Title : Cost Saving for ITV running in Terminals', '36', 0, '2023-01-08 12:53:59', '2023-01-08 12:53:59', NULL),
(64, NULL, 'Idea has been approved by pict asmt (Assessment Team)', 'Idea Title : Cost Saving for ITV running in Terminals', '40', 0, '2023-01-08 12:53:59', '2023-01-08 12:53:59', NULL),
(65, NULL, 'The status of the Idea has been changed to Under Approval by pict appr (Approving Authority)', 'Idea Title : Cost Saving for ITV running in Terminals', '33', 0, '2023-01-08 12:55:09', '2023-01-08 12:55:09', NULL),
(66, NULL, 'Idea has been approved by pict appr (Approving Authority)', 'Idea Title : Cost Saving for ITV running in Terminals', '33', 0, '2023-01-08 13:01:24', '2023-01-08 13:01:24', NULL),
(67, NULL, 'Idea has been approved by pict appr (Approving Authority)', 'Idea Title : Cost Saving for ITV running in Terminals', '35', 0, '2023-01-08 13:01:24', '2023-01-08 13:01:24', NULL),
(68, 'CqjKvdAIKl1673326027', 'New Idea', 'New Idea has been created : Testing 01', '19', 0, '2023-01-10 04:47:15', '2023-01-10 04:47:15', NULL),
(69, 'CqjKvdAIKl1673326027', 'New Idea', 'New Idea has been created : Testing 01', '21', 1, '2023-01-10 04:47:15', '2023-01-10 04:47:27', NULL),
(70, 'CqjKvdAIKl1673326027', 'New Idea', 'New Idea has been created : Testing 01', '22', 0, '2023-01-10 04:47:15', '2023-01-10 04:47:15', NULL),
(71, 'cYlxQCdyGx1673326078', 'New Idea', 'New Idea has been created : Testing 02', '19', 0, '2023-01-10 04:47:58', '2023-01-10 04:47:58', NULL),
(72, 'cYlxQCdyGx1673326078', 'New Idea', 'New Idea has been created : Testing 02', '21', 1, '2023-01-10 04:47:58', '2023-01-10 04:48:13', NULL),
(73, 'cYlxQCdyGx1673326078', 'New Idea', 'New Idea has been created : Testing 02', '22', 0, '2023-01-10 04:47:58', '2023-01-10 04:47:58', NULL),
(74, 'cYlxQCdyGx1673326078', 'The status of the Idea has been changed to Under Assessment by Rock Lee (Assessment Team)', 'Idea Title : Testing 02', '23', 1, '2023-01-10 04:48:30', '2023-01-12 05:26:58', NULL),
(75, 'cYlxQCdyGx1673326078', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : Testing 02', '23', 1, '2023-01-10 04:48:34', '2023-01-12 05:27:03', NULL),
(76, 'cYlxQCdyGx1673326078', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : Testing 02', '20', 0, '2023-01-10 04:48:34', '2023-01-10 04:48:34', NULL),
(77, 'cYlxQCdyGx1673326078', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : Testing 02', '24', 0, '2023-01-10 04:48:34', '2023-01-10 04:48:34', NULL),
(78, 'cYlxQCdyGx1673326078', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : Testing 02', '25', 1, '2023-01-10 04:48:34', '2023-01-10 04:49:56', NULL),
(79, 'cYlxQCdyGx1673326078', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : Testing 02', '27', 0, '2023-01-10 04:48:34', '2023-01-10 04:48:34', NULL),
(80, 'cYlxQCdyGx1673326078', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : Testing 02', '31', 0, '2023-01-10 04:48:34', '2023-01-10 04:48:34', NULL),
(81, 'cYlxQCdyGx1673326078', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : Testing 02', '36', 0, '2023-01-10 04:48:34', '2023-01-10 04:48:34', NULL),
(82, 'cYlxQCdyGx1673326078', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : Testing 02', '40', 0, '2023-01-10 04:48:34', '2023-01-10 04:48:34', NULL),
(83, 'cYlxQCdyGx1673326078', 'The status of the Idea has been changed to Under Approval by Harish Yadav (Approving Authority)', 'Idea Title : Testing 02', '23', 1, '2023-01-10 04:49:43', '2023-01-12 05:27:08', NULL),
(84, 'cYlxQCdyGx1673326078', 'Idea has been approved by Harish Yadav (Approving Authority)', 'Idea Title : Testing 02', '23', 1, '2023-01-10 04:49:59', '2023-01-12 05:26:47', NULL),
(85, 'cYlxQCdyGx1673326078', 'Idea has been approved by Harish Yadav (Approving Authority)', 'Idea Title : Testing 02', '26', 1, '2023-01-10 04:49:59', '2023-01-10 04:50:07', NULL),
(86, 'cYlxQCdyGx1673326078', 'Idea has been Implemented by Max McMan (Implementation Team)', 'Idea Title : Testing 02', '23', 1, '2023-01-10 04:50:33', '2023-01-12 05:26:38', NULL),
(87, 'HgrnGfompN1673347334', 'New Idea', 'New Idea has been created : idea Test with No files', '19', 0, '2023-01-10 10:42:14', '2023-01-10 10:42:14', NULL),
(88, 'HgrnGfompN1673347334', 'New Idea', 'New Idea has been created : idea Test with No files', '21', 1, '2023-01-10 10:42:14', '2023-01-10 10:42:22', NULL),
(89, 'HgrnGfompN1673347334', 'New Idea', 'New Idea has been created : idea Test with No files', '22', 0, '2023-01-10 10:42:14', '2023-01-10 10:42:14', NULL),
(90, 'okpwBHjydg1673500675', 'New Idea', 'New Idea has been created : Lorem Ipsum', '19', 0, '2023-01-12 05:17:58', '2023-01-12 05:17:58', NULL),
(91, 'okpwBHjydg1673500675', 'New Idea', 'New Idea has been created : Lorem Ipsum', '21', 1, '2023-01-12 05:17:58', '2023-01-12 05:18:15', NULL),
(92, 'okpwBHjydg1673500675', 'New Idea', 'New Idea has been created : Lorem Ipsum', '22', 0, '2023-01-12 05:17:58', '2023-01-12 05:17:58', NULL),
(93, 'okpwBHjydg1673500675', 'Comment has been posted by  Rock Lee (Assessment Team)', 'Idea Title : Lorem Ipsum <br> Comment : Hello Ken', '23', 1, '2023-01-12 05:19:42', '2023-01-12 05:26:33', NULL),
(94, 'okpwBHjydg1673500675', 'Comment has been posted by  Rock Lee (Assessment Team)', 'Idea Title : Lorem Ipsum <br> Comment : Your Idea seems good to me', '23', 1, '2023-01-12 05:19:57', '2023-01-12 05:20:17', NULL),
(95, 'okpwBHjydg1673500675', 'Comment has been posted by  Rock Lee (Assessment Team)', 'Idea Title : Lorem Ipsum <br> Comment : can you please upload a clear image', '23', 1, '2023-01-12 05:21:24', '2023-01-12 05:26:27', NULL),
(96, 'okpwBHjydg1673500675', 'The status of the Idea has been changed to On-hold by Rock Lee (Assessment Team)', 'Idea Title : Lorem Ipsum', '23', 1, '2023-01-12 05:21:32', '2023-01-12 05:26:23', NULL),
(97, 'okpwBHjydg1673500675', 'The status of the Idea has been changed to Revise Request(Reason : Submit a clear Image file ) by Rock Lee (Assessment Team)', 'Idea Title : Lorem Ipsum', '23', 1, '2023-01-12 05:22:53', '2023-01-12 05:24:23', NULL),
(98, 'okpwBHjydg1673500675', 'Comment has been posted by  Rock Lee (Assessment Team)', 'Idea Title : Lorem Ipsum <br> Comment : Okay', '23', 1, '2023-01-12 05:24:59', '2023-01-12 05:26:18', NULL),
(99, 'okpwBHjydg1673500675', 'The status of the Idea has been changed to Under Assessment by Rock Lee (Assessment Team)', 'Idea Title : Lorem Ipsum', '23', 1, '2023-01-12 05:25:15', '2023-01-12 05:25:34', NULL),
(100, 'okpwBHjydg1673500675', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : Lorem Ipsum', '23', 1, '2023-01-12 05:25:49', '2023-01-12 05:26:03', NULL),
(101, 'okpwBHjydg1673500675', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : Lorem Ipsum', '20', 0, '2023-01-12 05:25:49', '2023-01-12 05:25:49', NULL),
(102, 'okpwBHjydg1673500675', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : Lorem Ipsum', '24', 0, '2023-01-12 05:25:49', '2023-01-12 05:25:49', NULL),
(103, 'okpwBHjydg1673500675', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : Lorem Ipsum', '25', 1, '2023-01-12 05:25:49', '2023-01-12 05:33:43', NULL),
(104, 'okpwBHjydg1673500675', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : Lorem Ipsum', '27', 0, '2023-01-12 05:25:49', '2023-01-12 05:25:49', NULL),
(105, 'okpwBHjydg1673500675', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : Lorem Ipsum', '31', 0, '2023-01-12 05:25:49', '2023-01-12 05:25:49', NULL),
(106, 'okpwBHjydg1673500675', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : Lorem Ipsum', '36', 0, '2023-01-12 05:25:49', '2023-01-12 05:25:49', NULL),
(107, 'okpwBHjydg1673500675', 'Idea has been approved by Rock Lee (Assessment Team)', 'Idea Title : Lorem Ipsum', '40', 0, '2023-01-12 05:25:49', '2023-01-12 05:25:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `base_permission_id` int(11) DEFAULT NULL,
  `base_permission_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `submenu_id` int(11) DEFAULT NULL,
  `is_sub` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `base_permission_id`, `base_permission_name`, `menu_id`, `submenu_id`, `is_sub`, `created_at`, `updated_at`) VALUES
(5, 'Update Backend Menu', 'admin', 8, 'Update', 2, NULL, 0, '2021-01-03 23:46:32', '2021-01-12 19:10:17'),
(7, 'View Admin Users', 'admin', 7, 'View', 22, 32, 0, '2021-01-03 23:47:00', '2021-11-02 02:30:50'),
(8, 'Update Admin Users', 'admin', 8, 'Update', 22, 32, 0, '2021-01-03 23:47:00', '2021-11-02 02:30:50'),
(11, 'View Backend Menu', 'admin', 7, 'View', 2, NULL, 0, '2021-01-04 11:57:42', '2021-01-12 19:10:17'),
(12, 'View Categories', 'admin', 7, 'View', 4, NULL, 0, '2021-01-04 11:57:51', '2021-01-12 19:10:35'),
(13, 'Update Categories', 'admin', 8, 'Update', 4, NULL, 0, '2021-01-04 11:57:51', '2021-01-12 19:10:35'),
(16, 'View Sub Categories', 'admin', 7, 'View', 7, NULL, 0, '2021-01-04 11:59:04', '2021-01-12 19:16:14'),
(17, 'Update Sub Categories', 'admin', 8, 'Update', 7, NULL, 0, '2021-01-04 11:59:04', '2021-01-12 19:16:14'),
(22, 'Create test my menu', 'admin', 6, 'Create', NULL, NULL, 0, '2021-01-05 12:54:59', '2021-01-05 13:09:19'),
(23, 'View test my menu', 'admin', 7, 'View', NULL, NULL, 0, '2021-01-05 12:54:59', '2021-01-05 13:09:19'),
(24, 'Update test my menu', 'admin', 8, 'Update', NULL, NULL, 0, '2021-01-05 12:54:59', '2021-01-05 13:09:19'),
(25, 'Delete test my menu', 'admin', 9, 'Delete', NULL, NULL, 0, '2021-01-05 12:54:59', '2021-01-05 13:09:19'),
(31, 'Create ', 'admin', 6, 'Create', 11, 21, 0, '2021-01-05 14:50:39', '2021-05-26 00:22:53'),
(32, 'View ', 'admin', 7, 'View', 11, 21, 0, '2021-01-05 14:50:39', '2021-05-26 00:22:53'),
(36, 'Create Sellers', 'admin', 6, 'Create', 11, 6, 0, '2021-01-05 14:58:28', '2021-01-21 14:15:05'),
(37, 'View Sellers', 'admin', 7, 'View', 11, 6, 0, '2021-01-05 14:58:29', '2021-01-21 14:15:05'),
(44, 'Create Admin Users', 'admin', 6, 'Create', 22, 32, 0, '2021-01-05 17:13:25', '2021-11-02 02:30:50'),
(45, 'Delete Admin Users', 'admin', 9, 'Delete', 22, 32, 0, '2021-01-05 17:16:22', '2021-11-02 02:30:50'),
(46, 'Delete Permissions', 'admin', 9, 'Delete', 1, NULL, 0, '2021-01-12 19:10:10', '2021-02-04 15:15:24'),
(47, 'Create Backend Menu', 'admin', 6, 'Create', 2, NULL, 0, '2021-01-12 19:10:17', '2021-01-12 19:10:17'),
(48, 'Delete Backend Menu', 'admin', 9, 'Delete', 2, NULL, 0, '2021-01-12 19:10:17', '2021-01-12 19:10:17'),
(49, 'Create Categories', 'admin', 6, 'Create', 4, NULL, 0, '2021-01-12 19:10:30', '2021-01-12 19:10:35'),
(50, 'Delete Categories', 'admin', 9, 'Delete', 4, NULL, 0, '2021-01-12 19:10:30', '2021-01-12 19:10:35'),
(52, 'Delete Roles', 'admin', 9, 'Delete', 6, NULL, 0, '2021-01-12 19:16:08', '2021-02-04 15:15:57'),
(53, 'Create Sub Categories', 'admin', 6, 'Create', 7, NULL, 0, '2021-01-12 19:16:14', '2021-01-12 19:16:14'),
(54, 'Delete Sub Categories', 'admin', 9, 'Delete', 7, NULL, 0, '2021-01-12 19:16:14', '2021-01-12 19:16:14'),
(55, 'Create Products', 'admin', 6, 'Create', 12, NULL, 0, '2021-01-18 12:09:31', '2021-01-18 12:09:31'),
(56, 'View Products', 'admin', 7, 'View', 12, NULL, 0, '2021-01-18 12:09:31', '2021-01-18 12:09:31'),
(57, 'Update Products', 'admin', 8, 'Update', 12, NULL, 0, '2021-01-18 12:09:31', '2021-01-18 12:09:31'),
(58, 'Delete Products', 'admin', 9, 'Delete', 12, NULL, 0, '2021-01-18 12:09:32', '2021-01-18 12:09:32'),
(59, 'Update Sellers', 'admin', 8, 'Update', 11, 6, 0, '2021-01-21 14:15:05', '2021-01-21 14:15:05'),
(60, 'Delete Sellers', 'admin', 9, 'Delete', 11, 6, 0, '2021-01-21 14:15:05', '2021-01-21 14:15:05'),
(61, 'Update ', 'admin', 8, 'Update', 11, 21, 0, '2021-01-21 14:36:03', '2021-05-26 00:22:53'),
(62, 'Delete ', 'admin', 9, 'Delete', 11, 21, 0, '2021-01-21 14:36:03', '2021-05-26 00:22:53'),
(63, 'Create Packers', 'admin', 6, 'Create', 11, 8, 0, '2021-01-21 14:48:47', '2021-01-21 14:48:47'),
(64, 'View Packers', 'admin', 7, 'View', 11, 8, 0, '2021-01-21 14:48:47', '2021-01-21 14:48:47'),
(65, 'Update Packers', 'admin', 8, 'Update', 11, 8, 0, '2021-01-21 14:48:47', '2021-01-21 14:48:47'),
(66, 'Delete Packers', 'admin', 9, 'Delete', 11, 8, 0, '2021-01-21 14:48:47', '2021-01-21 14:48:47'),
(67, 'Create Importers', 'admin', 6, 'Create', 11, 10, 0, '2021-01-21 14:58:16', '2021-01-21 14:58:16'),
(68, 'View Importers', 'admin', 7, 'View', 11, 10, 0, '2021-01-21 14:58:16', '2021-01-21 14:58:16'),
(69, 'Update Importers', 'admin', 8, 'Update', 11, 10, 0, '2021-01-21 14:58:16', '2021-01-21 14:58:16'),
(70, 'Delete Importers', 'admin', 9, 'Delete', 11, 10, 0, '2021-01-21 14:58:16', '2021-01-21 14:58:16'),
(71, 'Create Product Images', 'admin', 6, 'Create', 13, NULL, 0, '2021-01-27 15:20:39', '2021-01-28 14:21:20'),
(72, 'View Product Images', 'admin', 7, 'View', 13, NULL, 0, '2021-01-27 15:20:40', '2021-01-28 14:21:20'),
(73, 'Update Product Images', 'admin', 8, 'Update', 13, NULL, 0, '2021-01-27 15:20:40', '2021-01-28 14:21:21'),
(74, 'Create Filters', 'admin', 6, 'Create', 29, 11, 0, '2021-02-03 15:58:48', '2022-02-07 23:07:42'),
(75, 'View Filters', 'admin', 7, 'View', 29, 11, 0, '2021-02-03 15:58:48', '2022-02-07 23:07:42'),
(76, 'Update Filters', 'admin', 8, 'Update', 29, 11, 0, '2021-02-03 15:58:49', '2022-02-07 23:07:42'),
(77, 'Delete Filters', 'admin', 9, 'Delete', 29, 11, 0, '2021-02-03 15:58:49', '2022-02-07 23:07:42'),
(78, 'Create Manufacturers', 'admin', 6, 'Create', 11, 7, 0, '2021-02-04 15:13:57', '2021-02-04 15:13:57'),
(79, 'View Manufacturers', 'admin', 7, 'View', 11, 7, 0, '2021-02-04 15:13:57', '2021-02-04 15:13:57'),
(80, 'Update Manufacturers', 'admin', 8, 'Update', 11, 7, 0, '2021-02-04 15:13:57', '2021-02-04 15:13:57'),
(81, 'Delete Manufacturers', 'admin', 9, 'Delete', 11, 7, 0, '2021-02-04 15:13:57', '2021-02-04 15:13:57'),
(82, 'Create Permissions', 'admin', 6, 'Create', 1, NULL, 0, '2021-02-04 15:15:24', '2021-02-04 15:15:24'),
(83, 'View Permissions', 'admin', 7, 'View', 1, NULL, 0, '2021-02-04 15:15:24', '2021-02-04 15:15:24'),
(84, 'Update Permissions', 'admin', 8, 'Update', 1, NULL, 0, '2021-02-04 15:15:24', '2021-02-04 15:15:24'),
(85, 'Create Roles', 'admin', 6, 'Create', 6, NULL, 0, '2021-02-04 15:15:57', '2021-02-04 15:15:57'),
(86, 'View Roles', 'admin', 7, 'View', 6, NULL, 0, '2021-02-04 15:15:57', '2021-02-04 15:15:57'),
(87, 'Update Roles', 'admin', 8, 'Update', 6, NULL, 0, '2021-02-04 15:15:57', '2021-02-04 15:15:57'),
(88, 'Create Colors', 'admin', 6, 'Create', 11, 12, 0, '2021-02-07 18:14:59', '2021-02-07 18:14:59'),
(89, 'View Colors', 'admin', 7, 'View', 11, 12, 0, '2021-02-07 18:14:59', '2021-02-07 18:14:59'),
(90, 'Update Colors', 'admin', 8, 'Update', 11, 12, 0, '2021-02-07 18:14:59', '2021-02-07 18:14:59'),
(91, 'Delete Colors', 'admin', 9, 'Delete', 11, 12, 0, '2021-02-07 18:15:00', '2021-02-07 18:15:00'),
(92, 'Create Sizes', 'admin', 6, 'Create', 11, 13, 0, '2021-02-07 18:15:18', '2021-02-07 18:15:18'),
(93, 'View Sizes', 'admin', 7, 'View', 11, 13, 0, '2021-02-07 18:15:18', '2021-02-07 18:15:18'),
(94, 'Update Sizes', 'admin', 8, 'Update', 11, 13, 0, '2021-02-07 18:15:18', '2021-02-07 18:15:18'),
(95, 'Delete Sizes', 'admin', 9, 'Delete', 11, 13, 0, '2021-02-07 18:15:18', '2021-02-07 18:15:18'),
(96, 'Create CMS Pages', 'admin', 6, 'Create', 14, NULL, 0, '2021-02-23 18:50:43', '2021-02-23 18:50:43'),
(97, 'View CMS Pages', 'admin', 7, 'View', 14, NULL, 0, '2021-02-23 18:50:44', '2021-02-23 18:50:44'),
(98, 'Update CMS Pages', 'admin', 8, 'Update', 14, NULL, 0, '2021-02-23 18:50:44', '2021-02-23 18:50:44'),
(99, 'Delete CMS Pages', 'admin', 9, 'Delete', 14, NULL, 0, '2021-02-23 18:50:44', '2021-02-23 18:50:44'),
(100, 'Create Size Charts', 'admin', 6, 'Create', 11, 14, 0, '2021-03-08 17:49:59', '2021-03-08 17:49:59'),
(101, 'View Size Charts', 'admin', 7, 'View', 11, 14, 0, '2021-03-08 17:50:00', '2021-03-08 17:50:00'),
(102, 'Update Size Charts', 'admin', 8, 'Update', 11, 14, 0, '2021-03-08 17:50:00', '2021-03-08 17:50:00'),
(103, 'Delete Size Charts', 'admin', 9, 'Delete', 11, 14, 0, '2021-03-08 17:50:00', '2021-03-08 17:50:00'),
(104, 'Create FAQs', 'admin', 6, 'Create', 11, 15, 0, '2021-03-15 12:15:17', '2021-03-15 12:15:17'),
(105, 'View FAQs', 'admin', 7, 'View', 11, 15, 0, '2021-03-15 12:15:18', '2021-03-15 12:15:18'),
(106, 'Update FAQs', 'admin', 8, 'Update', 11, 15, 0, '2021-03-15 12:15:18', '2021-03-15 12:15:18'),
(107, 'Delete FAQs', 'admin', 9, 'Delete', 11, 15, 0, '2021-03-15 12:15:18', '2021-03-15 12:15:18'),
(108, 'Create Size Chart Types', 'admin', 6, 'Create', 11, 16, 0, '2021-03-17 17:33:50', '2021-03-17 17:33:50'),
(109, 'View Size Chart Types', 'admin', 7, 'View', 11, 16, 0, '2021-03-17 17:33:50', '2021-03-17 17:33:50'),
(110, 'Update Size Chart Types', 'admin', 8, 'Update', 11, 16, 0, '2021-03-17 17:33:50', '2021-03-17 17:33:50'),
(111, 'Delete Size Chart Types', 'admin', 9, 'Delete', 11, 16, 0, '2021-03-17 17:33:50', '2021-03-17 17:33:50'),
(112, 'Create Home Page', 'admin', 6, 'Create', 15, NULL, 0, '2021-03-18 13:27:58', '2021-03-18 19:04:35'),
(113, 'View Home Page', 'admin', 7, 'View', 15, NULL, 0, '2021-03-18 13:27:58', '2021-03-18 19:04:35'),
(114, 'Update Home Page', 'admin', 8, 'Update', 15, NULL, 0, '2021-03-18 13:27:58', '2021-03-18 19:04:35'),
(115, 'Delete Home Page', 'admin', 9, 'Delete', 15, NULL, 0, '2021-03-18 13:27:58', '2021-03-18 19:04:35'),
(120, 'Create Home Page Sections', 'admin', 6, 'Create', 15, NULL, 0, '2021-03-18 19:05:12', '2021-03-18 19:05:12'),
(121, 'View Home Page Sections', 'admin', 7, 'View', 15, NULL, 0, '2021-03-18 19:05:12', '2021-03-18 19:05:12'),
(122, 'Update Home Page Sections', 'admin', 8, 'Update', 15, NULL, 0, '2021-03-18 19:05:12', '2021-03-18 19:05:12'),
(123, 'Delete Home Page Sections', 'admin', 9, 'Delete', 15, NULL, 0, '2021-03-18 19:05:12', '2021-03-18 19:05:12'),
(124, 'Create Home Page Section Types', 'admin', 6, 'Create', 11, 18, 0, '2021-03-19 14:56:32', '2021-03-19 14:56:32'),
(125, 'View Home Page Section Types', 'admin', 7, 'View', 11, 18, 0, '2021-03-19 14:56:32', '2021-03-19 14:56:32'),
(126, 'Update Home Page Section Types', 'admin', 8, 'Update', 11, 18, 0, '2021-03-19 14:56:32', '2021-03-19 14:56:32'),
(127, 'Delete Home Page Section Types', 'admin', 9, 'Delete', 11, 18, 0, '2021-03-19 14:56:33', '2021-03-19 14:56:33'),
(128, 'Create Footer Content', 'admin', 6, 'Create', 16, NULL, 0, '2021-03-22 13:13:41', '2021-03-23 18:51:35'),
(129, 'View Footer Content', 'admin', 7, 'View', 16, NULL, 0, '2021-03-22 13:13:41', '2021-03-23 18:51:35'),
(130, 'Update Footer Content', 'admin', 8, 'Update', 16, NULL, 0, '2021-03-22 13:13:41', '2021-03-23 18:51:35'),
(131, 'Delete Footer Content', 'admin', 9, 'Delete', 16, NULL, 0, '2021-03-22 13:13:41', '2021-03-23 18:51:35'),
(132, 'Create Featured Products', 'admin', 6, 'Create', 11, 19, 0, '2021-03-23 18:52:24', '2021-03-23 18:52:24'),
(133, 'View Featured Products', 'admin', 7, 'View', 11, 19, 0, '2021-03-23 18:52:24', '2021-03-23 18:52:24'),
(134, 'Update Featured Products', 'admin', 8, 'Update', 11, 19, 0, '2021-03-23 18:52:24', '2021-03-23 18:52:24'),
(135, 'Delete Featured Products', 'admin', 9, 'Delete', 11, 19, 0, '2021-03-23 18:52:25', '2021-03-23 18:52:25'),
(136, 'Create Footer', 'admin', 6, 'Create', 11, 20, 0, '2021-04-19 20:15:36', '2021-04-19 20:15:36'),
(137, 'View Footer', 'admin', 7, 'View', 11, 20, 0, '2021-04-19 20:15:36', '2021-04-19 20:15:36'),
(138, 'Update Footer', 'admin', 8, 'Update', 11, 20, 0, '2021-04-19 20:15:36', '2021-04-19 20:15:36'),
(139, 'Delete Footer', 'admin', 9, 'Delete', 11, 20, 0, '2021-04-19 20:15:38', '2021-04-19 20:15:38'),
(140, 'Create Header Note', 'admin', 6, 'Create', 11, 21, 0, '2021-05-26 00:23:29', '2021-05-26 00:23:29'),
(141, 'View Header Note', 'admin', 7, 'View', 11, 21, 0, '2021-05-26 00:23:30', '2021-05-26 00:23:30'),
(142, 'Update Header Note', 'admin', 8, 'Update', 11, 21, 0, '2021-05-26 00:23:30', '2021-05-26 00:23:30'),
(143, 'Delete Header Note', 'admin', 9, 'Delete', 11, 21, 0, '2021-05-26 00:23:32', '2021-05-26 00:23:32'),
(144, 'Create Coupons', 'admin', 6, 'Create', 17, NULL, 0, '2021-05-26 00:28:01', '2021-05-26 00:28:01'),
(145, 'View Coupons', 'admin', 7, 'View', 17, NULL, 0, '2021-05-26 00:28:01', '2021-05-26 00:28:01'),
(146, 'Update Coupons', 'admin', 8, 'Update', 17, NULL, 0, '2021-05-26 00:28:01', '2021-05-26 00:28:01'),
(147, 'Delete Coupons', 'admin', 9, 'Delete', 17, NULL, 0, '2021-05-26 00:28:02', '2021-05-26 00:28:02'),
(148, 'Create Orders', 'admin', 6, 'Create', 18, NULL, 0, '2021-08-03 18:58:02', '2021-08-03 18:58:02'),
(149, 'View Orders', 'admin', 7, 'View', 18, NULL, 0, '2021-08-03 18:58:02', '2021-08-03 18:58:02'),
(150, 'Update Orders', 'admin', 8, 'Update', 18, NULL, 0, '2021-08-03 18:58:02', '2021-08-03 18:58:02'),
(151, 'Delete Orders', 'admin', 9, 'Delete', 18, NULL, 0, '2021-08-03 18:58:04', '2021-08-03 18:58:04'),
(152, 'Create Missing Payments', 'admin', 6, 'Create', 19, NULL, 0, '2021-08-03 18:59:42', '2021-08-03 18:59:42'),
(153, 'View Missing Payments', 'admin', 7, 'View', 19, NULL, 0, '2021-08-03 18:59:43', '2021-08-03 18:59:43'),
(154, 'Update Missing Payments', 'admin', 8, 'Update', 19, NULL, 0, '2021-08-03 18:59:43', '2021-08-03 18:59:43'),
(155, 'Delete Missing Payments', 'admin', 9, 'Delete', 19, NULL, 0, '2021-08-03 18:59:44', '2021-08-03 18:59:44'),
(156, 'Create Reviews', 'admin', 6, 'Create', 20, NULL, 0, '2021-08-03 19:01:38', '2021-08-03 19:01:38'),
(157, 'View Reviews', 'admin', 7, 'View', 20, NULL, 0, '2021-08-03 19:01:38', '2021-08-03 19:01:38'),
(158, 'Update Reviews', 'admin', 8, 'Update', 20, NULL, 0, '2021-08-03 19:01:38', '2021-08-03 19:01:38'),
(159, 'Delete Reviews', 'admin', 9, 'Delete', 20, NULL, 0, '2021-08-03 19:01:40', '2021-08-03 19:01:40'),
(160, 'Create Newsletters', 'admin', 6, 'Create', 21, NULL, 0, '2021-08-03 19:03:36', '2021-08-03 19:03:36'),
(161, 'View Newsletters', 'admin', 7, 'View', 21, NULL, 0, '2021-08-03 19:03:37', '2021-08-03 19:03:37'),
(162, 'Update Newsletters', 'admin', 8, 'Update', 21, NULL, 0, '2021-08-03 19:03:37', '2021-08-03 19:03:37'),
(163, 'Delete Newsletters', 'admin', 9, 'Delete', 21, NULL, 0, '2021-08-03 19:03:38', '2021-08-03 19:03:38'),
(164, 'Create COD Management', 'admin', 6, 'Create', 11, 22, 0, '2021-09-14 17:40:12', '2021-09-14 17:40:12'),
(165, 'View COD Management', 'admin', 7, 'View', 11, 22, 0, '2021-09-14 17:40:12', '2021-09-14 17:40:12'),
(166, 'Update COD Management', 'admin', 8, 'Update', 11, 22, 0, '2021-09-14 17:40:12', '2021-09-14 17:40:12'),
(167, 'Delete COD Management', 'admin', 9, 'Delete', 11, 22, 0, '2021-09-14 17:40:14', '2021-09-14 17:40:14'),
(168, 'Create Order Return Management', 'admin', 6, 'Create', 30, 28, 0, '2021-09-14 18:11:52', '2022-03-30 20:37:26'),
(169, 'View Order Return Management', 'admin', 7, 'View', 30, 28, 0, '2021-09-14 18:11:53', '2022-03-30 20:37:26'),
(170, 'Update Order Return Management', 'admin', 8, 'Update', 30, 28, 0, '2021-09-14 18:11:53', '2022-03-30 20:37:26'),
(171, 'Delete Order Return Management', 'admin', 9, 'Delete', 30, 28, 0, '2021-09-14 18:11:54', '2022-03-30 20:37:26'),
(172, 'Create External Users', 'admin', 6, 'Create', 22, 24, 0, '2021-09-14 18:13:36', '2021-09-14 18:14:11'),
(173, 'View External Users', 'admin', 7, 'View', 22, 24, 0, '2021-09-14 18:13:36', '2021-09-14 18:14:11'),
(174, 'Update External Users', 'admin', 8, 'Update', 22, 24, 0, '2021-09-14 18:13:38', '2021-09-14 18:14:11'),
(175, 'Delete External Users', 'admin', 9, 'Delete', 22, 24, 0, '2021-09-14 18:13:39', '2021-09-14 18:14:11'),
(176, 'Create Suggestions', 'admin', 6, 'Create', 24, NULL, 0, '2021-09-14 18:14:44', '2021-09-14 18:14:44'),
(177, 'View Suggestions', 'admin', 7, 'View', 24, NULL, 0, '2021-09-14 18:14:44', '2021-09-14 18:14:44'),
(178, 'Update Suggestions', 'admin', 8, 'Update', 24, NULL, 0, '2021-09-14 18:14:45', '2021-09-14 18:14:45'),
(179, 'Delete Suggestions', 'admin', 9, 'Delete', 24, NULL, 0, '2021-09-14 18:14:46', '2021-09-14 18:14:46'),
(180, 'Create Special Deals', 'admin', 6, 'Create', 11, 25, 0, '2021-09-15 15:09:49', '2021-09-15 15:09:49'),
(181, 'View Special Deals', 'admin', 7, 'View', 11, 25, 0, '2021-09-15 15:09:49', '2021-09-15 15:09:49'),
(182, 'Update Special Deals', 'admin', 8, 'Update', 11, 25, 0, '2021-09-15 15:09:51', '2021-09-15 15:09:51'),
(183, 'Delete Special Deals', 'admin', 9, 'Delete', 11, 25, 0, '2021-09-15 15:09:51', '2021-09-15 15:09:51'),
(184, 'Create Report', 'admin', 6, 'Create', 25, NULL, 0, '2021-09-15 15:26:17', '2021-09-15 15:26:17'),
(185, 'View Report', 'admin', 7, 'View', 25, NULL, 0, '2021-09-15 15:26:17', '2021-09-15 15:26:17'),
(186, 'Update Report', 'admin', 8, 'Update', 25, NULL, 0, '2021-09-15 15:26:19', '2021-09-15 15:26:19'),
(187, 'Delete Report', 'admin', 9, 'Delete', 25, NULL, 0, '2021-09-15 15:26:19', '2021-09-15 15:26:19'),
(188, 'Create Order Cancel Management', 'admin', 6, 'Create', 30, 26, 0, '2021-10-13 14:26:15', '2022-02-17 23:39:20'),
(189, 'View Order Cancel Management', 'admin', 7, 'View', 30, 26, 0, '2021-10-13 14:26:15', '2022-02-17 23:39:20'),
(190, 'Update Order Cancel Management', 'admin', 8, 'Update', 30, 26, 0, '2021-10-13 14:26:17', '2022-02-17 23:39:20'),
(191, 'Delete Order Cancel Management', 'admin', 9, 'Delete', 30, 26, 0, '2021-10-13 14:26:17', '2022-02-17 23:39:20'),
(192, 'Create Company Master', 'admin', 6, 'Create', 11, 27, 0, '2021-10-13 21:17:52', '2021-10-13 21:17:52'),
(193, 'View Company Master', 'admin', 7, 'View', 11, 27, 0, '2021-10-13 21:17:52', '2021-10-13 21:17:52'),
(194, 'Update Company Master', 'admin', 8, 'Update', 11, 27, 0, '2021-10-13 21:17:54', '2021-10-13 21:17:54'),
(195, 'Delete Company Master', 'admin', 9, 'Delete', 11, 27, 0, '2021-10-13 21:17:54', '2021-10-13 21:17:54'),
(196, 'Create GST', 'admin', 6, 'Create', 27, NULL, 0, '2021-10-13 22:12:25', '2021-10-13 22:12:25'),
(197, 'View GST', 'admin', 7, 'View', 27, NULL, 0, '2021-10-13 22:12:25', '2021-10-13 22:12:25'),
(198, 'Update GST', 'admin', 8, 'Update', 27, NULL, 0, '2021-10-13 22:12:27', '2021-10-13 22:12:27'),
(199, 'Delete GST', 'admin', 9, 'Delete', 27, NULL, 0, '2021-10-13 22:12:27', '2021-10-13 22:12:27'),
(200, 'Create Order Delivery Management', 'admin', 6, 'Create', 30, 23, 0, '2021-11-01 20:40:29', '2022-03-30 20:37:20'),
(201, 'View Order Delivery Management', 'admin', 7, 'View', 30, 23, 0, '2021-11-01 20:40:30', '2022-03-30 20:37:20'),
(202, 'Update Order Delivery Management', 'admin', 8, 'Update', 30, 23, 0, '2021-11-01 20:40:31', '2022-03-30 20:37:20'),
(203, 'Delete Order Delivery Management', 'admin', 9, 'Delete', 30, 23, 0, '2021-11-01 20:40:31', '2022-03-30 20:37:20'),
(204, 'Create HSN Codes', 'admin', 6, 'Create', 28, NULL, 0, '2021-11-01 20:53:43', '2021-11-01 21:27:11'),
(205, 'View HSN Codes', 'admin', 7, 'View', 28, NULL, 0, '2021-11-01 20:53:44', '2021-11-01 21:27:11'),
(206, 'Update HSN Codes', 'admin', 8, 'Update', 28, NULL, 0, '2021-11-01 20:53:46', '2021-11-01 21:27:11'),
(207, 'Delete HSN Codes', 'admin', 9, 'Delete', 28, NULL, 0, '2021-11-01 20:53:46', '2021-11-01 21:27:11'),
(208, 'Create Materials', 'admin', 6, 'Create', 11, 30, 0, '2021-11-01 20:55:30', '2021-11-01 20:55:30'),
(209, 'View Materials', 'admin', 7, 'View', 11, 30, 0, '2021-11-01 20:55:32', '2021-11-01 20:55:32'),
(210, 'Update Materials', 'admin', 8, 'Update', 11, 30, 0, '2021-11-01 20:55:32', '2021-11-01 20:55:32'),
(211, 'Delete Materials', 'admin', 9, 'Delete', 11, 30, 0, '2021-11-01 20:55:33', '2021-11-01 20:55:33'),
(212, 'Create Shiping Charges', 'admin', 6, 'Create', 11, 31, 0, '2021-11-02 02:21:46', '2021-11-02 02:21:46'),
(213, 'View Shiping Charges', 'admin', 7, 'View', 11, 31, 0, '2021-11-02 02:21:47', '2021-11-02 02:21:47'),
(214, 'Update Shiping Charges', 'admin', 8, 'Update', 11, 31, 0, '2021-11-02 02:21:48', '2021-11-02 02:21:48'),
(215, 'Delete Shiping Charges', 'admin', 9, 'Delete', 11, 31, 0, '2021-11-02 02:21:48', '2021-11-02 02:21:48'),
(216, 'Create Filter Assign', 'admin', 6, 'Create', 29, 33, 0, '2021-11-02 19:07:36', '2022-02-07 23:07:56'),
(217, 'View Filter Assign', 'admin', 7, 'View', 29, 33, 0, '2021-11-02 19:07:37', '2022-02-07 23:07:56'),
(218, 'Update Filter Assign', 'admin', 8, 'Update', 29, 33, 0, '2021-11-02 19:07:38', '2022-02-07 23:07:56'),
(219, 'Delete Filter Assign', 'admin', 9, 'Delete', 29, 33, 0, '2021-11-02 19:07:38', '2022-02-07 23:07:56'),
(220, 'Create Filters & Values', 'admin', 6, 'Create', 29, 11, 0, '2022-02-07 23:08:10', '2022-02-07 23:08:10'),
(221, 'View Filters & Values', 'admin', 7, 'View', 29, 11, 0, '2022-02-07 23:08:11', '2022-02-07 23:08:11'),
(222, 'Update Filters & Values', 'admin', 8, 'Update', 29, 11, 0, '2022-02-07 23:08:11', '2022-02-07 23:08:11'),
(223, 'Delete Filters & Values', 'admin', 9, 'Delete', 29, 11, 0, '2022-02-07 23:08:15', '2022-02-07 23:08:15'),
(224, 'Create Order Cancel Reasons', 'admin', 6, 'Create', 30, 34, 0, '2022-02-17 23:40:12', '2022-02-17 23:40:12'),
(225, 'View Order Cancel Reasons', 'admin', 7, 'View', 30, 34, 0, '2022-02-17 23:40:13', '2022-02-17 23:40:13'),
(226, 'Update Order Cancel Reasons', 'admin', 8, 'Update', 30, 34, 0, '2022-02-17 23:40:13', '2022-02-17 23:40:13'),
(227, 'Delete Order Cancel Reasons', 'admin', 9, 'Delete', 30, 34, 0, '2022-02-17 23:40:16', '2022-02-17 23:40:16'),
(228, 'Create Order Return Reasons', 'admin', 6, 'Create', 30, 35, 0, '2022-02-17 23:41:39', '2022-02-17 23:41:55'),
(229, 'View Order Return Reasons', 'admin', 7, 'View', 30, 35, 0, '2022-02-17 23:41:39', '2022-02-17 23:41:55'),
(230, 'Update Order Return Reasons', 'admin', 8, 'Update', 30, 35, 0, '2022-02-17 23:41:42', '2022-02-17 23:41:55'),
(231, 'Delete Order Return Reasons', 'admin', 9, 'Delete', 30, 35, 0, '2022-02-17 23:41:42', '2022-02-17 23:41:55'),
(232, 'Create Frontend Images', 'admin', 6, 'Create', 11, 36, 0, '2022-03-09 01:42:48', '2022-03-09 01:49:05'),
(233, 'View Frontend Images', 'admin', 7, 'View', 11, 36, 0, '2022-03-09 01:42:49', '2022-03-09 01:49:05'),
(234, 'Update Frontend Images', 'admin', 8, 'Update', 11, 36, 0, '2022-03-09 01:42:49', '2022-03-09 01:49:05'),
(235, 'Delete Frontend Images', 'admin', 9, 'Delete', 11, 36, 0, '2022-03-09 01:42:52', '2022-03-09 01:49:05'),
(236, 'Create Hot Offers', 'admin', 6, 'Create', 31, NULL, 0, '2022-04-06 18:51:16', '2022-04-06 18:51:16'),
(237, 'View Hot Offers', 'admin', 7, 'View', 31, NULL, 0, '2022-04-06 18:51:16', '2022-04-06 18:51:16'),
(238, 'Update Hot Offers', 'admin', 8, 'Update', 31, NULL, 0, '2022-04-06 18:51:19', '2022-04-06 18:51:19'),
(239, 'Delete Hot Offers', 'admin', 9, 'Delete', 31, NULL, 0, '2022-04-06 18:51:19', '2022-04-06 18:51:19'),
(240, 'Create Download App', 'admin', 6, 'Create', 11, 37, 0, '2022-05-23 20:44:47', '2022-05-23 20:44:47'),
(241, 'View Download App', 'admin', 7, 'View', 11, 37, 0, '2022-05-23 20:44:48', '2022-05-23 20:44:48'),
(242, 'Update Download App', 'admin', 8, 'Update', 11, 37, 0, '2022-05-23 20:44:48', '2022-05-23 20:44:48'),
(243, 'Delete Download App', 'admin', 9, 'Delete', 11, 37, 0, '2022-05-23 20:44:52', '2022-05-23 20:44:52'),
(244, 'Create Login Management', 'admin', 6, 'Create', 11, 38, 0, '2022-06-29 19:26:06', '2022-06-29 19:26:06'),
(245, 'View Login Management', 'admin', 7, 'View', 11, 38, 0, '2022-06-29 19:26:07', '2022-06-29 19:26:07'),
(246, 'Update Login Management', 'admin', 8, 'Update', 11, 38, 0, '2022-06-29 19:26:08', '2022-06-29 19:26:08'),
(247, 'Delete Login Management', 'admin', 9, 'Delete', 11, 38, 0, '2022-06-29 19:26:09', '2022-06-29 19:26:09'),
(250, 'View Down', 'admin', 7, 'View', 32, 39, 0, '2022-07-07 01:41:18', '2022-07-07 01:41:18'),
(251, 'Update Down', 'admin', 8, 'Update', 32, 39, 0, '2022-07-07 01:41:20', '2022-07-07 01:41:20'),
(252, 'View Up', 'admin', 7, 'View', 32, 40, 0, '2022-07-07 01:41:47', '2022-07-07 01:41:47'),
(253, 'Update Up', 'admin', 8, 'Update', 32, 40, 0, '2022-07-07 01:41:48', '2022-07-07 01:41:48');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_ids` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `submenu_ids` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_sub` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `menu_ids`, `submenu_ids`, `is_sub`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', '6,22,32,30,31', '24,44,46,47,48,49,50,51,52', 1, '2020-11-19 13:17:45', '2022-12-14 05:37:16'),
(5, 'Manager', 'admin', '23', NULL, 0, '2020-11-20 12:48:41', '2022-09-12 10:43:11'),
(9, 'Demo User', 'admin', '6,22,32,30,31', '24,44,46,47,48,49,50,52', 1, '2021-02-04 15:11:08', '2023-01-04 07:51:10'),
(10, 'Approver', 'admin', NULL, NULL, 0, '2022-12-05 06:56:25', '2022-12-05 06:56:25'),
(11, 'Implementation', 'admin', NULL, NULL, 0, '2022-12-05 06:59:54', '2022-12-05 06:59:54');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) DEFAULT NULL,
  `submenu_id` bigint(20) DEFAULT NULL,
  `is_sub` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`, `menu_id`, `submenu_id`, `is_sub`) VALUES
(52, 1, NULL, NULL, NULL),
(52, 9, NULL, NULL, NULL),
(85, 1, NULL, NULL, NULL),
(85, 9, NULL, NULL, NULL),
(85, 10, NULL, NULL, NULL),
(85, 11, NULL, NULL, NULL),
(86, 1, NULL, NULL, NULL),
(86, 9, NULL, NULL, NULL),
(87, 1, NULL, NULL, NULL),
(87, 9, NULL, NULL, NULL),
(172, 1, NULL, NULL, NULL),
(172, 9, NULL, NULL, NULL),
(173, 1, NULL, NULL, NULL),
(173, 9, NULL, NULL, NULL),
(174, 1, NULL, NULL, NULL),
(174, 9, NULL, NULL, NULL),
(175, 1, NULL, NULL, NULL),
(175, 9, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `sub_category_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_name` varchar(255) DEFAULT NULL,
  `visibility` int(11) DEFAULT NULL,
  `units_assigned` varchar(255) DEFAULT NULL,
  `subcategory_details` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`sub_category_id`, `category_id`, `sub_category_name`, `visibility`, `units_assigned`, `subcategory_details`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 'print paper', 1, '50', 1, '2022-09-11 04:50:37', '2022-09-13 06:04:38', NULL),
(3, 3, 'poster', 1, '100', 1, '2022-09-13 06:06:55', '2022-09-13 06:06:55', NULL),
(5, 3, 'hording', 1, '1', 1, '2022-09-13 06:06:41', '2022-09-13 06:06:41', NULL),
(7, 7, 'google+', 1, '1', 1, '2022-09-13 06:07:51', '2022-09-13 06:09:13', NULL),
(8, 7, 'instagram', 1, '1', 1, '2022-09-13 06:08:04', '2022-09-13 06:08:04', NULL),
(9, 7, 'news paper', 1, '1', 1, '2022-09-13 06:08:16', '2022-09-13 06:08:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `centralized_decentralized_type` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `active_status` int(11) DEFAULT '0',
  `token` varchar(50) DEFAULT NULL,
  `verify_token` varchar(50) DEFAULT NULL,
  `email_verification` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `last_name`, `email`, `mobile_no`, `password`, `role`, `centralized_decentralized_type`, `created_at`, `updated_at`, `deleted_at`, `location`, `department`, `company_id`, `designation_id`, `active_status`, `token`, `verify_token`, `email_verification`) VALUES
(9, 'Vijay', 'Sutar', 'vijay@parasightsolutions.com', '8888999955', '$2y$10$1iCJsCr.FZeHRytpCPBRL.EIHWnlQM7u5rTc6b.B5YRU8TUEsjO6e', 'User', NULL, '2022-10-18 11:26:32', '2022-11-18 08:06:55', NULL, '6', '4', 5, 5, 1, NULL, NULL, NULL),
(11, 'JMB', 'Admin', 'neetap@jmbaxi.com', '9967530295', '$2y$10$J8aBgtfEXIZG0NXlEVBxNukuzQhIuyTvW4moLhZjZ.fUqekuFryEm', 'User', NULL, '2022-10-19 06:10:55', '2022-11-01 09:38:34', NULL, '1', '1', NULL, NULL, 1, NULL, NULL, NULL),
(14, 'Preeti', 'K', 'info@parasightsolutions.com', '9819885311', '$2y$10$BRJW5hY5VGHeKis25VdRkeiQew2a8vC.7MZZ3l3S22LHTjgu18e1e', 'User', NULL, '2022-10-19 12:16:05', '2022-11-01 09:38:40', NULL, '1', '1', NULL, NULL, 1, NULL, NULL, NULL),
(15, 'Assessment', 'Team', 'assessment@jmbaxi.com', '3333222233', '$2y$10$TAPD.ZWBQGaJAUxx/aCCLO.3y4oMUYuwTtpTQvpjz715b4cGJ1KGe', 'Assessment Team', NULL, '2022-11-01 10:06:36', '2022-11-01 10:06:50', NULL, '1', '1', NULL, NULL, 1, NULL, NULL, NULL),
(16, 'Kenny', 'Ackerman', 'kenny@gmail.com', '3216549875', '$2y$10$8JDzHU2snIvFRqLkVvh6AuUCzQjFX07/cRNf.FJm..XQ56IxbDbxi', 'User', NULL, '2022-11-02 12:57:23', '2022-11-02 13:08:39', NULL, '1', '1', NULL, NULL, 1, NULL, NULL, NULL),
(17, 'Annie', 'Tiwari', 'annie@gmail.com', '3216549875', '$2y$10$5rHH8lsLlk0F50kwdDc6K.gkweCb2R1K7G4QFuEqU6HUbAjWj1.cu', 'Assessment Team', NULL, '2022-11-02 13:10:08', '2022-11-02 13:11:04', NULL, '1', '1', NULL, NULL, 1, NULL, NULL, NULL),
(18, 'Dummy2', 'User2', 'dummy2@gmail.com', '3216549875', '$2y$10$4yGGhPWVXY5.S1TojkpAYe64FABgUd75HW3W3VdLdpbYab.1Lab3q', 'Assessment Team', NULL, '2022-11-18 05:49:07', '2022-11-18 05:50:53', NULL, '1', '1', 7, 6, 1, NULL, NULL, NULL),
(19, 'Meet', 'Mewada', 'meet@gmail.com', '3216549875', '$2y$10$6bRV90gnZ208fOnk8EbBs./0Kvzmmolfxv5nLNhrHtaee9LMRQ8yG', 'Assessment Team', NULL, '2022-11-18 05:54:40', '2022-12-02 10:09:19', NULL, '1', '1', 5, 6, 1, NULL, NULL, NULL),
(20, 'Approving', 'Authority User', 'approving@gmail.com', '8888999988', '$2y$10$fbn2xX1LwRnCPzGOZqYUbeZz9qQDUzZZ4bVijUzswPpeTZY0/.NYG', 'Approving Authority', NULL, '2022-11-21 10:23:34', '2022-11-21 10:23:54', NULL, '1', '1', 3, 1, 1, NULL, NULL, NULL),
(21, 'Rock', 'Lee', 'rock@gmail.com', '123456798', '$2y$10$mZOAosc9qU8Bl7QRah9YZOlbQPaMmzo2KZ4G.28cAlBz/iio1E4LG', 'Assessment Team', NULL, '2022-11-23 10:20:29', '2022-11-29 10:46:54', NULL, '1', '5', 5, 5, 1, NULL, NULL, NULL),
(22, 'John', 'Doe', 'john@gmail.com', '123456789', '$2y$10$ZB4lw5kDE7zcPJfRJPLj.udY4Y69Y70OTrfnFbh5GkCErjuZ64HP2', 'Assessment Team', NULL, '2022-11-23 11:07:54', '2022-12-03 09:07:46', NULL, '5', '4', 5, 5, 1, NULL, NULL, NULL),
(23, 'Ken', 'Miles', 'ken@gmail.com', '123456789', '$2y$10$AUzkFdQ9Wmw3RfDUoV1Iw.uEJ1PVPpeSuV5tas8dFDbOPWtlnsWRq', 'User', NULL, '2022-11-23 11:09:50', '2022-12-05 10:48:10', NULL, '6', '4', 5, 4, 1, NULL, NULL, NULL),
(24, 'Jen', 'Lee', 'len@gmail.com', '123456789', '$2y$10$Wmc8SCRpcy.Jc7As5LhvLuHb8dm0k5SIel8wHkbxKaCmOft/pKG1u', 'Approving Authority', '1', '2022-11-23 11:18:31', '2022-11-23 11:19:49', NULL, '6', '3', 5, 2, 1, NULL, NULL, NULL),
(25, 'Harish', 'Yadav', 'harish@gmail.com', '9785461325', '$2y$10$Q7vTeBmzON/g6KkN3u1HIeymuHhOxPxzKqryku4EdSjVTDr7lQ2DG', 'Approving Authority', '2', '2022-11-23 11:21:25', '2022-12-07 07:47:58', NULL, '7', '1', 5, 4, 1, NULL, NULL, NULL),
(26, 'Max', 'McMan', 'max@gmail.com', '7412589635', '$2y$10$qTnb3QocLaVPpt7wGu9LBeGF7rwYNghLy1jjRNR629k.KGrVeYMp6', 'Implementation', NULL, '2022-11-23 11:27:52', '2022-11-30 05:13:38', NULL, '7', '3', 5, 4, 1, NULL, NULL, NULL),
(27, 'Approver', 'Admin', 'neetappr@jmbaxi.com', '9967530295', '$2y$10$xTxMWHGfu4RP9FezvYPOJu8Qllb2x6Oxc/PArJR4u4ZF5b1zfNyRu', 'Approving Authority', NULL, '2022-12-05 07:05:30', '2022-12-05 07:11:15', NULL, '6', '1', 3, 4, 1, NULL, NULL, NULL),
(28, 'Implementation', 'Admin', 'neetaImpl@jmbaxi.com', '9967530295', '$2y$10$XoPzS0.hxPuM4vREjQGMvO5jOBpmdu8rLqr4Vm7B7a4R0bq/y0YH6', 'Implementation', NULL, '2022-12-05 07:06:48', '2022-12-05 07:10:50', NULL, '7', '1', 7, 4, 1, NULL, NULL, NULL),
(29, 'Vijay', 'User', 'vijayuser@parasightsolutions.com', '8888888888', '$2y$10$uM4l64tImWYBBLAFb8GJCueTtafxWNTJLNKJ2vdOwSIGPOZfdWsuu', 'User', NULL, '2022-12-08 05:02:29', '2022-12-08 05:08:28', NULL, '1', '1', 3, 1, 1, NULL, NULL, NULL),
(30, 'Vijay', 'Assessment', 'vijayassessment@gmail.com', '8888888888', '$2y$10$nO62lLzbrjWrdZznigvPOu8uktkSNs5FDeXr7J0CBYQgmWvfzNNre', 'Assessment Team', NULL, '2022-12-08 05:03:33', '2022-12-08 05:08:11', NULL, '1', '1', 3, 1, 1, NULL, NULL, NULL),
(31, 'Vijay', 'Approver', 'vijayapprover@gmail.com', '3333333333', '$2y$10$kNcHGp8DFWndtsDw2maN5eWtQEQs6BpGqmBj3K1tbPDXmf94Nc8lS', 'Approving Authority', '1', '2022-12-08 05:04:23', '2022-12-08 05:07:55', NULL, '1', '1', 3, 1, 1, NULL, NULL, NULL),
(32, 'Vijay', 'Implementation', 'vijayimplementation@parasightsolutions.com', '4444444444', '$2y$10$u9f8IKid3PVv7D/O8JEExuabl4FMDwlGZx/MRez8mv.6IBlxjtCau', 'Implementation', NULL, '2022-12-08 05:05:18', '2022-12-08 05:07:34', NULL, '1', '1', 3, 1, 1, NULL, NULL, NULL),
(33, 'pict', 'usr', 'pictusr@jmbaxi.com', '12347567890', '$2y$10$70STpwseAMIYdKnlHBV0R.c3bGg/0tNauBSEfTbD3GfXGpEngq1LK', 'User', NULL, '2022-12-12 06:51:31', '2022-12-12 06:58:06', NULL, '5', '1', 4, 5, 1, NULL, NULL, NULL),
(34, 'pict', 'asmt', 'pictasmt@jmbaxi.com', '1122334455', '$2y$10$eMSMVR0q8OdlSEKoHUzDFOeDgw39lBO/SGjM6wwEobCM4SlX4y.z6', 'Assessment Team', NULL, '2022-12-12 06:53:03', '2022-12-12 06:57:14', NULL, '7', '2', 4, 2, 1, NULL, NULL, NULL),
(35, 'pict', 'impl', 'pictimpl@jmbaxi.com', '1233345567', '$2y$10$R2v86FZo2GkvfqGdeAaeRe38s0X12SZd3NdgjAnNOGBBIfgmeD2La', 'Implementation', NULL, '2022-12-12 06:56:31', '2022-12-12 06:57:38', NULL, '1', '2', 4, 2, 1, NULL, NULL, NULL),
(36, 'pict', 'appr', 'pictappr@jmbaxi.com', '1212323434', '$2y$10$zrhO2qBeWtvZxerFsJTPMOhTdI8XA6q/QJvo4pFjXvXR4RJjJz0qi', 'Approving Authority', '2', '2022-12-12 06:59:35', '2022-12-12 07:22:26', NULL, '6', '6', 4, 2, 1, NULL, NULL, NULL),
(37, 'Test1', 'Test1', 'test1@gmail.com', '3216549875', '$2y$10$9ttMvLQNJy12U4Bgu3rBmeA7JXTVXpORjZx/yMaaIGbKV5itLulZa', NULL, NULL, '2022-12-14 05:47:12', '2022-12-14 05:47:12', NULL, '1', '1', 5, 5, 0, NULL, NULL, NULL),
(38, 'Test1 2', 'Test1 2', 'test11@gmail.com', '3216549875', '$2y$10$ysfyjAnMaIjpzXpcO2AefeiBfZW04opREtorhvIsHOcxse8RYZ1n.', NULL, NULL, '2022-12-14 05:54:25', '2022-12-14 05:54:57', NULL, '7', '6', 7, 6, 0, NULL, NULL, NULL),
(39, 'Meet', 'M', 'meetm@parasightsolutions.com', '123456789', '$2y$10$oabBg7Upn2UMgaywjORlJO6djaSZ8CtSSM5U42dt5.4ecv/JFWM4W', 'User', NULL, '2022-12-17 11:51:17', '2022-12-20 04:35:19', NULL, '6', '2', 5, 2, 1, 'zCQRqSvsXR', 'cUIlCqKevM', 1),
(40, 'Nova e', 'Apex e', 'enova@gmail.com', '6549873212', '$2y$10$Tcl9y3nwp7ksMdDyielvUuc1kKhk1iLaAcv.qnrCM6u.edn5MI8qq', 'Approving Authority', '1', '2023-01-04 07:30:35', '2023-01-04 07:32:24', NULL, '6', '6', 7, 6, 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`activity_log_id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`admin_user_id`);

--
-- Indexes for table `backend_menubar`
--
ALTER TABLE `backend_menubar`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `backend_submenubar`
--
ALTER TABLE `backend_submenubar`
  ADD PRIMARY KEY (`submenu_id`),
  ADD KEY `submenu_id` (`submenu_id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `sub_parent_id` (`sub_parent_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `category_details`
--
ALTER TABLE `category_details`
  ADD PRIMARY KEY (`category_details_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `email_config`
--
ALTER TABLE `email_config`
  ADD PRIMARY KEY (`email_config_id`);

--
-- Indexes for table `ideas`
--
ALTER TABLE `ideas`
  ADD PRIMARY KEY (`idea_id`);

--
-- Indexes for table `idea_active_status`
--
ALTER TABLE `idea_active_status`
  ADD PRIMARY KEY (`idea_active_status_id`);

--
-- Indexes for table `idea_feedback`
--
ALTER TABLE `idea_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `idea_images`
--
ALTER TABLE `idea_images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `idea_revision`
--
ALTER TABLE `idea_revision`
  ADD PRIMARY KEY (`idea_revision_id`);

--
-- Indexes for table `idea_revision_images`
--
ALTER TABLE `idea_revision_images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `idea_status`
--
ALTER TABLE `idea_status`
  ADD PRIMARY KEY (`idea_status_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`sub_category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `activity_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `admin_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `backend_menubar`
--
ALTER TABLE `backend_menubar`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `backend_submenubar`
--
ALTER TABLE `backend_submenubar`
  MODIFY `submenu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category_details`
--
ALTER TABLE `category_details`
  MODIFY `category_details_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `email_config`
--
ALTER TABLE `email_config`
  MODIFY `email_config_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ideas`
--
ALTER TABLE `ideas`
  MODIFY `idea_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `idea_active_status`
--
ALTER TABLE `idea_active_status`
  MODIFY `idea_active_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `idea_feedback`
--
ALTER TABLE `idea_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `idea_images`
--
ALTER TABLE `idea_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `idea_revision`
--
ALTER TABLE `idea_revision`
  MODIFY `idea_revision_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `idea_revision_images`
--
ALTER TABLE `idea_revision_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `idea_status`
--
ALTER TABLE `idea_status`
  MODIFY `idea_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `sub_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
