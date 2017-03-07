-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 07, 2017 at 06:06 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `capstone`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99'),
(2, 'admin2', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand`, `category`) VALUES
(2, ' J. Gonzales, Â R. Nocon', '24'),
(3, 'Rodibelle F. Leona, Â RodellaÂ F. Salas, Â Henry T', '25'),
(4, 'Joanna Lynn L. Mercado', '26'),
(5, 'Erika S. Farshid Mehr,  Frederic D. Yulo', '25');

-- --------------------------------------------------------

--
-- Table structure for table `cacel_order`
--

CREATE TABLE IF NOT EXISTS `cacel_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `txn_id` varchar(50) NOT NULL,
  `payer_email` varchar(50) NOT NULL,
  `now` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(40) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(23, 'Match'),
(24, 'Math'),
(25, 'Computer'),
(26, 'Marketing'),
(27, 'asdasdas');

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE IF NOT EXISTS `inbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`id`, `name`, `subject`, `email`, `message`, `date`) VALUES
(1, 'Russell James', 'sample subject', 'rje.mindo@gmail.com', 'sample message', '2017-02-15');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE IF NOT EXISTS `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `pname` varchar(35) NOT NULL,
  `lessted_value` int(11) NOT NULL,
  `current_stock` int(11) NOT NULL,
  `previous stock` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `outbox`
--

CREATE TABLE IF NOT EXISTS `outbox` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `subject` varchar(60) NOT NULL,
  `message` longtext NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_option`
--

CREATE TABLE IF NOT EXISTS `payment_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` varchar(255) NOT NULL,
  `merchant` varchar(255) NOT NULL,
  `base_url` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `payment_option`
--

INSERT INTO `payment_option` (`id`, `option`, `merchant`, `base_url`, `active`) VALUES
(1, 'https://www.sandbox.paypal.com/cgi-bin/webscr', 'fritzlicda1-facilitator-1@gmail.com', 'http://localhost/copstone/', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `price` varchar(16) NOT NULL,
  `details` text NOT NULL,
  `stock` int(11) NOT NULL,
  `category` varchar(16) NOT NULL,
  `sub_category` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `timestamp` varchar(10) NOT NULL,
  `date_added` date NOT NULL,
  `ext` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `details`, `stock`, `category`, `sub_category`, `status`, `timestamp`, `date_added`, `ext`) VALUES
(9, 'Essential Statistics', '550', 'There are so many books about statistics out there written both by local and foreign authors. So why come up with yet another one? This book makes use of the same format adopted for an earlier, similar book in Algebra found useful by many students and teachers. It utilizes step-by-step procedures, includes lots of exercises, and worksheets, offers opportunities for student reflection and real-world connections, highlights the use of technology-based tools, requires student projects, presents chapter highlights, and provides students preparatory materials for major examinations.. It also has materials on integrating student portfolios and learning papers into the course.', 100, '24', ' J. Gonzales, Â R. Nocon', 'active', '2017-02-11', '2017-02-11', 'png'),
(10, 'Practical Approach to Information Communication Technology (ICT)', '123', 'SAMPLE DESCRIPTION', 123, '25', 'Erika S. Farshid Mehr,  Frederic D. Yulo', 'active', '2017-02-15', '2017-02-15', 'png'),
(11, 'Basic Marketing', '50', 'The marketing world today is very much different from it was years ago. Today, market enterprises use modem communication technologies such as email, fax machines, Internet. World Wide Web in their marketing transactions to help making them cross boundaries with ease_ With globalization and applications of quantitative tools in marketing as the trend, modern marketing managers, marketing instructors and students have to equip themselves with modem know- how of the basic principles of marketing for them to meet the challenges in this rapid changing world of marketing.', 223, '23', ' J. Gonzales, Â R. Nocon', 'unactive', '2017-02-15', '2017-02-15', 'png'),
(12, 'sdasdasd', '12312312', 'dasdasdasd', 213123123, '23', ' J. Gonzales, Â R. Nocon', 'unactive', '2017-03-02', '2017-03-02', 'jpg'),
(13, 'sdasdasd', '12312312', 'dasdasdasd', 213123123, '23', ' J. Gonzales, Â R. Nocon', 'unactive', '2017-03-02', '2017-03-02', 'jpg'),
(14, 'dsasdasd2', '1', 'asdasd', 1, '23', ' J. Gonzales, Â R. Nocon', 'unactive', '2017-03-06', '2017-03-06', 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_type` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `contact_num` varchar(20) NOT NULL,
  `reason` text NOT NULL,
  `product` varchar(30) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `request_type`, `email`, `full_name`, `contact_num`, `reason`, `product`, `status`) VALUES
(1, 'supplier', 'mendozalaxus@gmail.com', '0', '09067224096', 'Wala lang!', 'Wala lang!', 'accepted'),
(2, 'supplier', 'roxelrollmendoza@gmail.com', 'Roxel Roll Mendoza', '09067224096', 'wala lang ulit!', 'Papel de liha', 'accepted'),
(3, 'author', 'natsumendoza@gmail.com', 'natsu', '09078463744', 'asdasdasdsad', NULL, 'accepted'),
(4, 'author', 'sdasd', 'aadasdas', '21312312312', 'asdasdasd', NULL, 'pending'),
(5, 'author', 'sdasd', 'aadasdas', '21312312312', 'asdasdasd', NULL, 'pending'),
(6, 'author', 'mendozalaxus@gmail.com', 'roro', '123456778', 'reason 3', NULL, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `product` varchar(40) NOT NULL,
  `contract` varchar(10) NOT NULL,
  `valid_until` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `product`, `contract`, `valid_until`) VALUES
(1, '0', 'Wala lang!', 'valid', '2017-04-30 05:23:10'),
(2, 'Roxel Roll Mendoza', 'Papel de liha', 'valid', '2017-07-31 05:23:10'),
(4, 'Roxel', 'papel', 'invalid', '2017-07-31 05:31:34');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id_array` varchar(255) NOT NULL,
  `payer_email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `month` varchar(4) NOT NULL,
  `day` varchar(4) NOT NULL,
  `year` varchar(4) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mc_gross` varchar(255) NOT NULL,
  `payment_currency` varchar(255) NOT NULL,
  `receiver_email` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `txn_type` varchar(255) NOT NULL,
  `payer_status` varchar(255) NOT NULL,
  `address_street` varchar(255) NOT NULL,
  `address_city` varchar(255) NOT NULL,
  `address_state` varchar(255) NOT NULL,
  `address_zip` varchar(255) NOT NULL,
  `address_country` varchar(255) NOT NULL,
  `address_status` varchar(255) NOT NULL,
  `notify_version` varchar(255) NOT NULL,
  `verify_sign` varchar(255) NOT NULL,
  `payer_id` varchar(255) NOT NULL,
  `mc_currency` varchar(255) NOT NULL,
  `mc_fee` varchar(255) NOT NULL,
  `txn_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usn` varchar(50) NOT NULL,
  `fname` varchar(120) NOT NULL,
  `lname` varchar(120) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(60) NOT NULL,
  `contact` int(11) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(128) NOT NULL,
  `activate` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `date` date NOT NULL,
  `block` int(11) NOT NULL,
  `pic` int(11) NOT NULL,
  `ext` varchar(5) NOT NULL,
  `admin` int(11) NOT NULL,
  `user_type` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usn`, `fname`, `lname`, `birthday`, `address`, `contact`, `email`, `password`, `activate`, `code`, `date`, `block`, `pic`, `ext`, `admin`, `user_type`) VALUES
(1, 'rjemindo', 'Russell James', 'Mindo', '1955-10-15', 'Antipolo', 3934875, 'rje.mindo@gmail.com', '4794b24d2508fd381736b30aa4e3a886', 1, 67591688, '2013-11-28', 0, 0, '', 0, 0),
(3, 'rr', 'Roxel', 'Mendoza', '1994-03-03', 'Tarlac', 2147483647, 'mendozalaxus@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 0, '2017-03-06', 0, 0, '', 0, 1),
(4, 'jeydah1231', 'Jedidiah Ysis', 'Gutierrez', '1993-06-20', '9 Agnes St., Sta. Teresita Village Marikina', 2147483647, 'jeydahgutierrez0910@gmail.com', '16f26d92e4c585a66ed58f7bb2d0f919', 1, 97629123, '2017-02-11', 0, 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name`) VALUES
(1, 'client'),
(2, 'accountant'),
(3, 'author'),
(4, 'supplier'),
(5, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_uploads`
--

CREATE TABLE IF NOT EXISTS `user_uploads` (
  `upload_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` text,
  `user_id_fk` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`upload_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
