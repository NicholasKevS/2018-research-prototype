-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2018 at 05:32 PM
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
(1, 2, 'My Battery', 'qwe123asd', 100, 100, 50);

-- --------------------------------------------------------

--
-- Table structure for table `battery_acts`
--

CREATE TABLE `battery_acts` (
  `batteryid` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 = buy, 1 = discharge',
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `battery_acts`
--

INSERT INTO `battery_acts` (`batteryid`, `date`, `status`, `amount`) VALUES
(2, '2018-05-14', 1, 50),
(2, '2018-05-15', 0, 20),
(2, '2018-05-16', 1, 50);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`) VALUES
(1, 'Eastwood'),
(2, 'Haymarket'),
(3, 'Redfern'),
(4, 'Strathfield'),
(5, 'Wynyard');

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
(1, 2, 'Fridge', '123123123', 1),
(2, 2, 'Computer', '321321321', 1),
(3, 2, 'Standing Lamp', '456456456', 1),
(4, 2, 'Electric Blanket', '654654654', 0),
(5, 2, 'TV', '789789789', 0),
(6, 2, 'Playstation', '987987987', 1);

-- --------------------------------------------------------

--
-- Table structure for table `node_schedules`
--

CREATE TABLE `node_schedules` (
  `id` int(11) NOT NULL,
  `nodeid` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 = off, 1 = on',
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `node_schedules`
--

INSERT INTO `node_schedules` (`id`, `nodeid`, `day`, `status`, `start`, `end`) VALUES
(1, 2, 0, 1, 17, 23),
(2, 3, 0, 1, 17, 22),
(3, 4, 0, 1, 1, 6),
(4, 5, 0, 1, 15, 17),
(5, 6, 0, 0, 3, 16),
(6, 6, 0, 1, 17, 23);

-- --------------------------------------------------------

--
-- Table structure for table `node_usages`
--

CREATE TABLE `node_usages` (
  `nodeid` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` int(11) NOT NULL,
  `amount` float NOT NULL
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
(1, 'EnergyAustralia'),
(2, 'Origin Energy'),
(3, 'Red Energy');

-- --------------------------------------------------------

--
-- Table structure for table `solars`
--

CREATE TABLE `solars` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name` text NOT NULL,
  `area` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `power` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `solars`
--

INSERT INTO `solars` (`id`, `userid`, `name`, `area`, `quantity`, `power`) VALUES
(1, 2, 'My Solar Panel', 30, 100, 10);

-- --------------------------------------------------------

--
-- Table structure for table `solar_productions`
--

CREATE TABLE `solar_productions` (
  `solarid` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` int(11) NOT NULL,
  `amount` float NOT NULL
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
(1, 'admin', 'admin', 'admin@admin.com', 'administrator', 2, 1, 'qweasdzxc', 1),
(2, 'user1', 'user1', 'user1@user.com', 'testuser1', 4, 2, 'asdasdasd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `weathers`
--

CREATE TABLE `weathers` (
  `locationid` int(11) NOT NULL,
  `today` text NOT NULL,
  `tomorrow` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `weathers`
--

INSERT INTO `weathers` (`locationid`, `today`, `tomorrow`) VALUES
(1, 'Sunny', 'Clear'),
(2, 'Shower', 'Rain'),
(3, 'Cloudy', 'Rain'),
(4, 'Sunny', 'Cloudy'),
(5, 'Clear', 'Shower');

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
  ADD UNIQUE KEY `batteryid` (`batteryid`,`date`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
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
-- Indexes for table `weathers`
--
ALTER TABLE `weathers`
  ADD PRIMARY KEY (`locationid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batteries`
--
ALTER TABLE `batteries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nodes`
--
ALTER TABLE `nodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `node_schedules`
--
ALTER TABLE `node_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `providers`
--
ALTER TABLE `providers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `solars`
--
ALTER TABLE `solars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
