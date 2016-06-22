-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 22, 2016 at 07:27 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pi`
--

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('Picture','Document','File','') NOT NULL,
  `name` varchar(200) NOT NULL,
  `ext` varchar(200) NOT NULL,
  `pname` text NOT NULL,
  `description` text NOT NULL,
  `folder_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `folder_id` (`folder_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id`, `type`, `name`, `ext`, `pname`, `description`, `folder_id`) VALUES
(5, 'Picture', '', 'jpg', 'uploads/user-2/Desert.jpg', 'aasdasdasd', 2),
(11, 'Picture', 'sadasdasdasdad', 'jpg', 'uploads/user-3/IMG_20160302_152631.jpg', 'asdasdsad', 3),
(12, 'Document', 'ss', 'docx', 'uploads/user-3/1._Contoh_Rangkuman_State_of_the_art_(Penelitian_yang_sebelumnya_sudah_dilakukan)_2.docx', 'qw', 3),
(13, 'Document', 'few', 'doc', 'uploads/user-3/FIX PRINT.doc', 'd', 3),
(14, 'Picture', 'asdasdad', 'jpg', 'uploads/user-3/IMG_20160302_152631.jpg', '', 3),
(15, 'Picture', 'asdasdad', 'jpg', 'uploads/user-3/IMG_20160302_152631.jpg', '', 3),
(16, 'Picture', 'asdasdad', 'jpg', 'uploads/user-3/IMG_20160302_152631.jpg', '', 3),
(17, 'File', 'nhbhkuhj', 'jpg', 'uploads/user-3/IMG_20160219_085029.jpg', '', 3),
(18, 'Picture', 'ew', 'jpg', 'uploads/user-3/IMG_20160302_152631.jpg', '', 3),
(19, 'File', 'aaa', 'jpg', 'uploads/user-3/IMG_20160302_152631.jpg', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `file_tag`
--

CREATE TABLE IF NOT EXISTS `file_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `file_id` (`file_id`,`tag_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `file_tag`
--

INSERT INTO `file_tag` (`id`, `file_id`, `tag_id`) VALUES
(1, 16, 1),
(2, 16, 2),
(3, 16, 3),
(4, 16, 4),
(6, 17, 1),
(5, 17, 3),
(8, 18, 2),
(7, 18, 5),
(9, 19, 1),
(10, 19, 2);

-- --------------------------------------------------------

--
-- Table structure for table `folder`
--

CREATE TABLE IF NOT EXISTS `folder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama` (`nama`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `folder`
--

INSERT INTO `folder` (`id`, `nama`, `description`, `user_id`) VALUES
(1, 'Invoice', '', 2),
(2, 'Gambar', '', 2),
(3, 'rima', 'coba', 3),
(4, 'attok', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `nama`) VALUES
(1, 'gambar'),
(2, 'foto'),
(3, 'bla'),
(4, 'blaaa'),
(5, 'nama');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `nama`, `password`) VALUES
(2, 'admin@gmail.com', 'Attok Rintawan', '21232f297a57a5a743894a0e4a801fc3'),
(3, 'rimaprawasti@gmail.com', 'Rima Prawasti', '805844467ef7b5d8580e1d88adf6fe2e');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `file_ibfk_1` FOREIGN KEY (`folder_id`) REFERENCES `folder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `file_tag`
--
ALTER TABLE `file_tag`
  ADD CONSTRAINT `file_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `file_tag_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `file` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `folder`
--
ALTER TABLE `folder`
  ADD CONSTRAINT `folder_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
