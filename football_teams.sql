-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2023 at 12:55 PM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `football_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `football_teams`
--

CREATE TABLE `football_teams` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `money_balance` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `players` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `football_teams`
--

INSERT INTO `football_teams` (`id`, `name`, `country`, `money_balance`, `players`) VALUES
(1, 'Barcelona', 'Spain', '4000332193', 'Gerard Pique,Cesc Fabregas,Javier Mascherano,Dani Alves,Carles Puyol,Lionel Messi,Andres Iniesta,Jordi Alba,Pedro'),
(2, 'Juventus', 'Italy', '1170600200', 'Andrea Pirlo,Gianluigi Buffon,Giorgio Chiellini,Arturo Vidal,Kwadwo Asamoah,Leonardo Bonucci,Carlo Pinsoglio,Bremer,Alessandro Del Piero,Stefano Tacconi,Gianluca Vialli'),
(3, 'Bayern Munich', 'Germany', '2700600900', 'Bastian Schweinsteiger,Philipp Lahm,Franck Ribery,Manuel Neuer,Thomas Muller,Toni Kroos,Mario Gomez,Arjen Robben,Mario Mandžukić,Javi Martinez,Norbert Eder,Rainer Zobel,Alan McInally'),
(4, 'Zimbru', 'Moldova', '737606', 'Ivan Drago,Xavi,Sergio Busquets');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `football_teams`
--
ALTER TABLE `football_teams`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `football_teams`
--
ALTER TABLE `football_teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
