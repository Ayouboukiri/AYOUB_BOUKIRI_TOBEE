-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2024 at 11:45 AM
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
-- Database: `test_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `id_comm` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `comm_date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `prod_price` double NOT NULL,
  `total_price` float NOT NULL,
  `product` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` varchar(200) NOT NULL,
  `id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`name`, `email`, `message`, `id`, `user_name`) VALUES
('ayoub', 'boukiriboukiri1@gmail.com', 'hi admin', 9, 'ayoub1');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `title` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `categorie` varchar(20) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`title`, `price`, `quantity`, `image`, `categorie`, `id`) VALUES
('2 BEEWAX TAPERS', 60, 100, '\"image\\2 BEEWAX TAPERS.jpg\"', 'beewax', 1),
('ALOE VERA GEL', 43, 400, '\"image/Aloe Vera Gel.jpg\"', 'beauty', 2),
('BASSWOOD HONEY', 13, 100, '\"image/basswood.jpg\"', 'honey', 3),
('BEARD BALM', 30, 100, '\"image/BEARD BALM.jpg\"', 'beewax', 4),
('BEE BARS', 40, 100, '\"image/BEE BARS.jpg\"', 'beewax', 5),
('BEERX', 53, 500, '\"image/images.jpg\"', 'beauty', 6),
('BEEWAX CANDLE', 50, 100, '\"image/Beeswax-Candle.jpg\"', 'beewax', 7),
('BEEWAX LIP PALM', 60, 100, '\"image/Beewax lip balm.jpg\"', 'beewax', 8),
('BEEWAX PILLAR', 70, 100, '\"image/BEEWAX PILLAR.jpg\"', 'beewax', 9),
('BEEWAX TEALIGHTS', 80, 100, '\"image/BEEWAX TEALIGHTS.jpg\"', 'beewax', 10),
('BLACK_BERRY HONEY', 23, 243, '\"image/blackberry honey.jpg\"', 'honey', 11),
('BLUE_BERRY HONEY', 33, 300, '\"image/blueberry.jpg\"', 'honey', 12),
('BODY OIL', 13, 100, '\"image/body oil.jpg\"', 'beauty', 13),
('BUCKWHEAT HONEY', 43, 400, '\"image/buckwheat.jpg\"', 'honey', 14),
('EMERGENCY CANDLE', 20, 123, '\"image/EMERGENCY CANDLE.jpg\"', 'beewax', 15),
('F&B CREAM', 73, 700, '\"image/pr1.png\"', 'beauty', 16),
('GOLDENROD HONEY', 83, 800, '\"image/goldenrod.jpg\"', 'honey', 17),
('HONEY HALO', 23, 200, '\"image/honey halo.jpg\"', 'beauty', 18),
('HONEY POTION', 33, 300, '\"image/honey-potion.webp\"', 'beauty', 19),
('LUXURY SOAP', 63, 600, '\"image/luxury soap.webp\"', 'beauty', 20),
('MEADON BLOSSOM', 53, 500, '\"image/meadow blossom.jpg\"', 'honey', 21),
('ORANGE BLOSSOM', 63, 60, '\"image/orange blossom.jpg\"', 'honey', 22),
('SERUM', 83, 800, '\"image/serum.webp\"', 'beauty', 23),
('test2', 10, 10, '\"image/raw wildflower.jpg\"', 'honey', 222);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_name` varchar(40) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_name`, `name`, `password`) VALUES
('admin', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_comm`),
  ADD KEY `userName` (`userName`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`title`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_comm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
