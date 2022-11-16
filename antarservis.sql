-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2022 at 06:01 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `antarservis`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingId` int(11) NOT NULL,
  `facilityId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `reserveDate` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Waiting for approval',
  `startTime` time NOT NULL,
  `endTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingId`, `facilityId`, `userId`, `reserveDate`, `status`, `startTime`, `endTime`) VALUES
(1, 1, 2, '2021-12-02', 'Waiting for approval', '10:00:00', '13:00:00'),
(2, 1, 3, '2021-12-10', 'Rejected', '16:00:00', '18:00:00'),
(3, 2, 2, '2021-12-10', 'Waiting for approval', '18:00:00', '19:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE `facility` (
  `facilityId` int(11) NOT NULL,
  `facilityName` varchar(300) NOT NULL,
  `facilityImg` varchar(255) NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`facilityId`, `facilityName`, `facilityImg`, `description`) VALUES
(1, 'AI Laboratory', 'Lab-AI.jpg', 'Laboratorium ini merupakan kerjasama UMN dengan RIIxGRID Jepang. Server dapat diakses tanpa batas dan memfasilitasi komputasi untuk pembelajaran machine learning dan deep learning. Dilengkapi dengan ruang Image Processing, Voice Identification dan ruang diskusi, mahasiswa UMN dilatih menjadi tenaga ahli Data Scientist yang siap bekerja di industri teknologi terdepan.                                    '),
(2, 'Lecture Theatre', 'Lecture-Theatre-New-Media-Tower.jpg', 'Ruang teater yang modern ini memiliki kapasitas hingga 200 orang. Ruangan ini sering digunakan untuk seminar, workshop, perkuliahan dengan dosen tamu, dan pertunjukan UKM (Unit Kegiatan Mahasiswa).'),
(3, 'Game Dev Lab', 'game-dev-lab2.jpg', 'Laboratorium ini digunakan untuk pengembangan game berbasis mobile dan desktop. Untuk meningkatkan interaktivitas hasil karya mahasiswa, UMN menyediakan perangkat input berbasis sensor pengenal gerakan tangan (Leap Motion), gerakan seluruh tubuh (Kinect V2) dan device head-mount VR headset (Occulus Rift) yang dilengkapi dengan teknologi hand-tracking device. Tidak hanya memiliki teknologi hardware yang mendukung, lab ini juga memiliki software pengembangan konten permainan digital, seperti game engine, sound and graphics editing software.'),
(8, '\'Greenscreen Lab\'', 'greenscreen2.jpg', '\'Studio ini dirancang khusus untuk membuat film dan animasi. Perekaman suatu adegan dapat diambil dari 3 angle yang berbeda dengan memanfaatkan berbagai fasilitas, seperti towing (alat untuk mengangkat orang), lampu, kostum, sensor titik motion, dan green screen.\'');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `userType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`userType`) VALUES
('Admin'),
('Management'),
('User');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` mediumtext NOT NULL,
  `userType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `username`, `email`, `password`, `userType`) VALUES
(1, 'Admin', 'admin@admin.com', 'c484731969b767820934f6fb74a803f05b382e4b5b10383f6819a5374fcda0fb8d0d7e14f9cf6ef8f76d406669c081821fc6f32d068e98b3f831b163c8a0f84b', 'Admin'),
(2, 'User', 'user@user.com', '584222f5fcc844297d56261f377514ac3e9042fd66c345d67ff189e30bd6180c0d6f71b7f54acf38e7a500c077de81776006a249d731a61ca6e80a1514f60da8', 'User'),
(3, 'Management', 'mene@management.com', 'fdafe01bb895cba31b3ac997f78a5d38c7d9030a85cd27c1f7861ff3ddec1e841528abfeeb303c662f5368c29c31107c810db48d634ec4965090b0303851a534', 'Management');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `facilityId` (`facilityId`);

--
-- Indexes for table `facility`
--
ALTER TABLE `facility`
  ADD PRIMARY KEY (`facilityId`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`userType`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `userType` (`userType`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bookingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `facility`
--
ALTER TABLE `facility`
  MODIFY `facilityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`userType`) REFERENCES `roles` (`userType`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
