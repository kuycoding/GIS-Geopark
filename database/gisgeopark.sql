-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 27, 2019 at 03:45 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gisgeopark`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `nama`, `email`, `pesan`) VALUES
(1, 'Anti Hoax', 'mail.antihoax@gmail.com', 'Test\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `data_geo`
--

CREATE TABLE `data_geo` (
  `id_geo` int(11) NOT NULL,
  `nama_geo` varchar(128) NOT NULL,
  `deskripsi` varchar(158) NOT NULL,
  `info` varchar(128) NOT NULL,
  `lat` varchar(128) NOT NULL,
  `longitude` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_geo`
--

INSERT INTO `data_geo` (`id_geo`, `nama_geo`, `deskripsi`, `info`, `lat`, `longitude`, `image`, `date_created`) VALUES
(1, 'Geopark Gunung Sewu', 'Patuk, Kabupaten Gunung Kidul, Daerah Istimewa Yogyakarta 55862', '5F2H+XR Kabregan, Kabrengan, Srimulyo, Bantul, Daerah Istimewa Yogyakarta', '-7.831384', '110.547657', '175210geopark_gunung_sewu.jpg', 1553694392),
(2, 'Bukit Panenjoan untuk Geopark Ciletuh', 'Jl. Cicukang, Mekarjaya, Ciemas, Sukabumi, Jawa Barat 43177', 'QGW6+JP Tjiateul, Ciemas, Sukabumi, Jawa Barat', '-7.203377', '106.511844', '832217Curug-Sodong-ciletuh.jpg', 1553694934),
(3, 'Geopark Teksas Wonocolo', 'Desa, RT.1/RW.1, Margoasri, Kedewan, Kabupaten Bojonegoro, Jawa Timur 62164', '0852-3293-5400', '-7.0353411', '111.6338571', '419029teksas1.jpg', 1553700574),
(4, 'Etalase Taman Batu', 'Jl. Baron KM.6, Mulo, Wonosari, Kabupaten Gunung Kidul, Daerah Istimewa Yogyakarta 55851', '0813-2864-4776', '-8.0264962', '110.5873339', '3584920170205082334_IMG_0763.JPG', 1553700987),
(5, 'Geopark Kaldera Danau Toba', 'Sigulatti, Sarimarrihit, Sianjur Mula Mula, Kabupaten Samosir, Sumatera Utara 22396', 'Kaldera Danau Toba memiliki panorama yang indah. Pulau vulkanik yang berada di tengah Danau Toba ini terbentuk dari letusan dahs', '2.5935519', '98.6329828', '524562toba-geopark.jpg', 1558915034);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id_request` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_geo` varchar(128) NOT NULL,
  `deskripsi` text NOT NULL,
  `info` text NOT NULL,
  `lat` varchar(128) NOT NULL,
  `lon` varchar(128) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id_request`, `id_user`, `nama_geo`, `deskripsi`, `info`, `lat`, `lon`, `gambar`) VALUES
(3, 0, 'aaa', '-7.0352112', '121211', 'sa', 'sda', '732159diagram.jpg'),
(4, 1, 'Coba', 'sa', 'sa', 'sa', 'sa', '30959SPK DFD Level0.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `password`, `image`, `date_created`) VALUES
(1, 'Afif', 'a@kuycoding.com', 'b56776aa98086825550ff0c3fe260907', 'default', 1554650685);

-- --------------------------------------------------------

--
-- Table structure for table `user_admin`
--

CREATE TABLE `user_admin` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `is_active` varchar(20) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_admin`
--

INSERT INTO `user_admin` (`id_user`, `nama`, `email`, `password`, `image`, `is_active`, `date_created`) VALUES
(27, 'Afif Nor Yusuf', 'a@kuycoding.com', 'afif', 'default', 'Admin', 1553524567),
(29, 'Afmin', 'admin@admin.com', 'admin', '554225', 'Admin', 1558110045);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_geo`
--
ALTER TABLE `data_geo`
  ADD PRIMARY KEY (`id_geo`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id_request`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_geo`
--
ALTER TABLE `data_geo`
  MODIFY `id_geo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id_request` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
