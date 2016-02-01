-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 01, 2016 at 06:22 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `articles`
--

-- --------------------------------------------------------

--
-- Table structure for table `articleTable`
--

CREATE TABLE IF NOT EXISTS `articleTable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(70) NOT NULL,
  `sumary` tinytext NOT NULL,
  `article` text NOT NULL,
  `publishdate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `articleTable`
--

INSERT INTO `articleTable` (`id`, `title`, `sumary`, `article`, `publishdate`) VALUES
(1, 'New intern in DTT. Young talent', 'The well known company DTT multimedia is recruiting new interns from February and they pitch upon a young Spanish kid with great skills to be trained', 'The young talent aka Samuel R. Ferrero was interviewed the past 29th of January in Amsterdam. \r\n\r\nAfter a revealing chat with Rein van Strien, was time for the expert Kamil Hurajt to evaluate the code that the applicant was about to show. Kamil was straight forward and cutting making that evaluation. Far from the quality DTT require for interns that want to learn. Tough moments for the kid, and two options crossing his mind "Go big, or go home". And he was far from home, but even further of giving up on something he really wanted wanted. \r\n\r\nThe interview was over, but there was still a decision to make, deep inside Samuel knew that that was THE opportunity to bend the world to his will, and proof to the company, and himself, that the impossibles jut take a little bit longer. "Long enough is the weekend to catch up" That would be the tag for this young''s talent attitude facing the problem.', '2016-01-30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `name` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `password`) VALUES
('samuel', '$2y$10$GJNclAlOoPu.9mNlBJJ7C.6f4hdMDjSFkWJ3xuPjqcjJ./jQ2GSiy');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
