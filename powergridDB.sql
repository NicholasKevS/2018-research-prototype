-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2018 at 10:33 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `powergrid`
--
CREATE DATABASE IF NOT EXISTS `powergrid` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `powergrid`;

-- --------------------------------------------------------

--
-- Table structure for table `batteries`
--

CREATE TABLE `batteries` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name` text NOT NULL,
  `code` text NOT NULL,
  `capacity` int(11) NOT NULL,
  `topthreshold` int(11) NOT NULL,
  `bottomthreshold` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `batteries`
--

INSERT INTO `batteries` (`id`, `userid`, `name`, `code`, `capacity`, `topthreshold`, `bottomthreshold`) VALUES
(1, 1, 'Admin Battery', 'qwe123asd', 100, 100, 50),
(2, 2, 'User1 Battery', 'qwe123asd', 100, 100, 50),
(3, 3, 'User2 Battery', 'qwe123asd', 100, 100, 50);

-- --------------------------------------------------------

--
-- Table structure for table `battery_acts`
--

CREATE TABLE `battery_acts` (
  `batteryid` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 = use, 2 = charge',
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `battery_sums`
--

CREATE TABLE `battery_sums` (
  `batteryid` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 = buy, 2 = discharge',
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('0l6m1qhlturm9k4jcdbj98clsthudogn', '::1', 1528188195, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383138383139353b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('2pquhqj28j6b0ntshh2cfagb18vtgrk5', '::1', 1528200371, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383230303337313b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('2qes7kfsm9odj4sj5jmnh67ciqfonkka', '::1', 1528195774, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383139353737343b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('38dqhlcqfr5hluadkaaear1f31uvm7m1', '::1', 1528185277, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383138353237373b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('3m6d586sudj2m095asbquavgqck6jl4s', '::1', 1528197805, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383139373830353b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('4gm3tufc5e1uvvbe0inm8lvh7kv8bhmu', '::1', 1528186216, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383138363231363b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('7lrqvcj8u22rpd7q5alnli16vfdhljl8', '::1', 1528199199, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383139393139393b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('aptabdgi040gdpk0f82gc1266k4upveg', '::1', 1528184611, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383138343631313b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('b0odugiosrpq0qj36lk39o42h169ur4u', '::1', 1528188790, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383138383739303b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('co0utl3ef5qinic646koq2llvnt2msnh', '::1', 1528201394, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383230313339343b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('do1s5sulompkpad1gfr8rmvjekcsd5oc', '::1', 1528194329, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383139343332393b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('e0i9a0jclchl2s0jev0oosv4580soi25', '::1', 1528185586, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383138353538363b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('efd6k8n11uc3sj6s01v38e9c6kh7pmmv', '::1', 1528189808, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383138393830383b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('evab2nnkj3bju4tcnuiva9e9lrkh1n9o', '::1', 1528180395, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383138303339353b),
('h0igrob153pm19bd32vvdnk681jh1lua', '::1', 1528193374, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383139333337343b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('imqjp3hjgoohbnqhmdjlu29gietg09jn', '::1', 1528192551, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383139323535313b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('jual7k2lid7rjjhv30qgogme50jgt5kr', '::1', 1528201900, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383230313930303b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('k7f7ipce2arqh7bpqmc1vgnh6l7gu9im', '::1', 1528198107, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383139383130373b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('mdiog2p8hk6ippfd82gdo108nvl11vgk', '::1', 1528184269, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383138343236393b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('min64cjcdm28i3acf190ekf6q8ak8um7', '::1', 1528184952, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383138343935323b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('neobbul8lmda13te311llggi7gjgsp3n', '::1', 1528195442, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383139353434323b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('np0kcpguk273nkvpjteqsvpo0mhnm41u', '::1', 1528201900, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383230313930303b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('obfqq5pgpfnlnv3i3eqlvada4vebuhfr', '::1', 1528198512, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383139383531323b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('ofmna7mar0h01g7i8u5v3simcdjgo1oo', '::1', 1528192969, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383139323936393b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('rq009d9sbna9gf80odsmjl72kh9e9efg', '::1', 1528196398, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383139363339383b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('rs3qup0ensh6og6qcqv2fdq5qcj13igm', '::1', 1528192077, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383139323037373b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('u4hem37o3o3bab3ujpphgupd2n1lpg7k', '::1', 1528200047, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383230303034373b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('uip8220umt3cffv84gp3spoktblbgq7o', '::1', 1528190546, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383139303534363b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('uqu3v532naev4svkhu9v0gngs9gcb42k', '::1', 1528198819, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383139383831393b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b),
('v23rep0qobgnr5qo4qdsenctfqt6mf3o', '::1', 1528197112, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383139373131323b69647c733a313a2232223b66756c6c6e616d657c733a393a22746573747573657231223b697341646d696e7c623a303b69734c6f67696e7c733a333a22796573223b),
('v4qgntg9efg4qnb5ddo47nqvhcd7gmas', '::1', 1528193703, 0x5f5f63695f6c6173745f726567656e65726174657c693a313532383139333730333b69647c733a313a2231223b66756c6c6e616d657c733a31333a2261646d696e6973747261746f72223b697341646d696e7c623a313b69734c6f67696e7c733a333a22796573223b);

-- --------------------------------------------------------

--
-- Table structure for table `forecast_today`
--

CREATE TABLE `forecast_today` (
  `userid` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 = usage, 2 = production',
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `forecast_tomorrow`
--

CREATE TABLE `forecast_tomorrow` (
  `userid` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 = usage, 2 = production',
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `today` text NOT NULL,
  `tomorrow` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `today`, `tomorrow`) VALUES
(1, 'Eastwood', 'Sunny', 'Clear'),
(2, 'Haymarket', 'Shower', 'Rain'),
(3, 'Redfern', 'Cloudy', 'Rain'),
(4, 'Strathfield', 'Sunny', 'Cloudy'),
(5, 'Wynyard', 'Clear', 'Shower');

-- --------------------------------------------------------

--
-- Table structure for table `nodes`
--

CREATE TABLE `nodes` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name` text NOT NULL,
  `code` text NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 = off, 1 = on'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nodes`
--

INSERT INTO `nodes` (`id`, `userid`, `name`, `code`, `status`) VALUES
(1, 1, 'Admin Fridge', '123123123', 1),
(2, 1, 'Admin Computer', '321321321', 1),
(3, 1, 'Admin Standing Lamp', '456456456', 1),
(4, 1, 'Admin Electric Blanket', '654654654', 1),
(5, 1, 'Admin TV', '789789789', 1),
(6, 1, 'Admin Playstation', '987987987', 1),
(7, 2, 'User1 Fridge', '123123123', 1),
(8, 2, 'User1 Computer', '321321321', 1),
(9, 2, 'User1 Standing Lamp', '456456456', 1),
(10, 2, 'User1 Electric Blanket', '654654654', 1),
(11, 2, 'User1 TV', '789789789', 1),
(12, 2, 'User1 Playstation', '987987987', 1),
(13, 3, 'User2 Fridge', '123123123', 1),
(14, 3, 'User2 Computer', '321321321', 1),
(15, 3, 'User2 Standing Lamp', '456456456', 1),
(16, 3, 'User2 Electric Blanket', '654654654', 1),
(17, 3, 'User2 TV', '789789789', 1),
(18, 3, 'User2 Playstation', '987987987', 1);

-- --------------------------------------------------------

--
-- Table structure for table `node_schedules`
--

CREATE TABLE `node_schedules` (
  `id` int(11) NOT NULL,
  `nodeid` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 = off, 1 = on',
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `node_schedules`
--

INSERT INTO `node_schedules` (`id`, `nodeid`, `day`, `status`, `start`, `end`) VALUES
(1, 2, 0, 0, 1, 6),
(2, 3, 0, 1, 17, 22),
(3, 4, 0, 1, 1, 6),
(4, 5, 0, 1, 15, 17),
(5, 6, 0, 0, 3, 16),
(6, 6, 0, 1, 17, 23),
(7, 8, 0, 1, 17, 23),
(8, 9, 0, 1, 17, 22),
(9, 10, 0, 1, 1, 6),
(10, 11, 0, 1, 15, 17),
(11, 12, 0, 0, 3, 16),
(12, 12, 0, 1, 17, 23);

-- --------------------------------------------------------

--
-- Table structure for table `node_usages`
--

CREATE TABLE `node_usages` (
  `nodeid` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` int(11) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `providers`
--

CREATE TABLE `providers` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `providers`
--

INSERT INTO `providers` (`id`, `name`) VALUES
(1, 'AGL'),
(2, 'Origin Energy'),
(3, 'Red Energy');

-- --------------------------------------------------------

--
-- Table structure for table `provider_price`
--

CREATE TABLE `provider_price` (
  `providerid` int(11) NOT NULL,
  `peak` double NOT NULL,
  `shoulder` double NOT NULL,
  `offpeak` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `provider_price`
--

INSERT INTO `provider_price` (`providerid`, `peak`, `shoulder`, `offpeak`) VALUES
(1, 54, 23, 15),
(2, 53.01, 23.79, 14.42),
(3, 54.57, 24.69, 16.43);

-- --------------------------------------------------------

--
-- Table structure for table `solars`
--

CREATE TABLE `solars` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name` text NOT NULL,
  `code` text NOT NULL,
  `area` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `solars`
--

INSERT INTO `solars` (`id`, `userid`, `name`, `code`, `area`, `quantity`, `size`) VALUES
(1, 1, 'Admin Solar Roof', '321321321', 30.25, 100, 10),
(2, 2, 'User1 Solar Roof', '321321321', 30.25, 100, 10),
(3, 3, 'User2 Solar Roof', '321321321', 30.25, 100, 10);

-- --------------------------------------------------------

--
-- Table structure for table `solar_productions`
--

CREATE TABLE `solar_productions` (
  `solarid` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` int(11) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `fullname` text NOT NULL,
  `locationid` int(11) NOT NULL,
  `providerid` int(11) NOT NULL,
  `providercode` text NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '0 = user, 1 = admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `fullname`, `locationid`, `providerid`, `providercode`, `type`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', 'administrator', 2, 2, 'qweqwe', 1),
(2, 'user1', 'user1', 'user1@user.com', 'testuser1', 4, 2, 'asdasdasd', 0),
(3, 'user2', 'user2', 'user2@user.com', 'testuser2', 4, 2, 'asdasdasd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name` text NOT NULL,
  `code` text NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `userid`, `name`, `code`, `capacity`) VALUES
(1, 1, 'Admin Electric Vehicle', '456456456', 30),
(2, 2, 'User1 Electric Vehicle', '456456456', 30),
(3, 3, 'User2 Electric Vehicle', '456456456', 30);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_bats`
--

CREATE TABLE `vehicle_bats` (
  `vehicleid` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` int(11) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batteries`
--
ALTER TABLE `batteries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `battery_acts`
--
ALTER TABLE `battery_acts`
  ADD UNIQUE KEY `batteryid` (`batteryid`,`date`,`time`);

--
-- Indexes for table `battery_sums`
--
ALTER TABLE `battery_sums`
  ADD UNIQUE KEY `batteryid` (`batteryid`,`date`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`,`ip_address`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `forecast_today`
--
ALTER TABLE `forecast_today`
  ADD UNIQUE KEY `userid` (`userid`,`time`,`status`);

--
-- Indexes for table `forecast_tomorrow`
--
ALTER TABLE `forecast_tomorrow`
  ADD UNIQUE KEY `userid` (`userid`,`time`,`status`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nodes`
--
ALTER TABLE `nodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `node_schedules`
--
ALTER TABLE `node_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `node_usages`
--
ALTER TABLE `node_usages`
  ADD UNIQUE KEY `nodeid` (`nodeid`,`date`,`time`);

--
-- Indexes for table `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_price`
--
ALTER TABLE `provider_price`
  ADD PRIMARY KEY (`providerid`);

--
-- Indexes for table `solars`
--
ALTER TABLE `solars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `solar_productions`
--
ALTER TABLE `solar_productions`
  ADD UNIQUE KEY `solarid` (`solarid`,`date`,`time`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_bats`
--
ALTER TABLE `vehicle_bats`
  ADD UNIQUE KEY `vehicleid` (`vehicleid`,`date`,`time`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batteries`
--
ALTER TABLE `batteries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nodes`
--
ALTER TABLE `nodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `node_schedules`
--
ALTER TABLE `node_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `providers`
--
ALTER TABLE `providers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `solars`
--
ALTER TABLE `solars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
