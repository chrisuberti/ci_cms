-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2017 at 09:23 PM
-- Server version: 5.5.53-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ubercms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `category_name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `category_name`) VALUES
(1, 'tutorial', 'Tutorial'),
(2, 'freebie', 'Freebie'),
(3, 'codeigniter', 'CodeIgniter'),
(4, 'joomla', 'Joomla'),
(5, 'wordpress', 'Wordpress'),
(6, 'damn', 'damnit'),
(7, '', 'tewst'),
(8, '', 'tester'),
(9, '', 'teer'),
(10, '', ' alsdkfj;l o oog laksdjlfkads.23423097854');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `comment_name` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_body` text NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `comment_name`, `comment_email`, `comment_body`, `comment_date`, `user_id`) VALUES
(1, 1, 'administrator', 'admin@admin.com', 'Test comment. Continually matrix process-centric markets via web-enabled niche markets.', '2012-02-09 03:39:48', 1),
(2, 1, 'Tester 1', 'a@a.com', 'Vestibulum venenatis. Nulla vel ipsum. Proin rutrum, urna sit amet bibendum pellentesque.', '2012-02-09 03:40:39', 0),
(222, 3, 'person', 'person@gmail.com', 'this is a sample comment', '2016-12-26 17:51:40', 0),
(2346, 3, 'Sucker John', 'lkj@lkj.com', 'asldkgj;laskhg;klasgiojas \r\nlasjkdfn\r\ndfklj', '2016-12-29 18:58:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) DEFAULT NULL,
  `content` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `date`, `author_id`) VALUES
(1, 'Codeigniter Tutorial', '<p>Synergistically e-enable sticky synergy for future-proof technology. Quickly enhance resource maximizing meta-services with intermandated methods of empowerment. Interactively network user-centric interfaces without empowered users. Holisticly procrastinate bricks-and-clicks core competencies and progressive channels. Globally repurpose next-generation resources and premier e-services.</p>\r\n\r\n<p>Continually matrix process-centric markets via web-enabled niche markets. Dramatically impact orthogonal methods of empowerment vis-a-vis sustainable mindshare. Efficiently leverage existing bleeding-edge value with parallel quality vectors. Continually visualize end-to-end intellectual capital before multifunctional e-tailers. Collaboratively aggregate 2.0 markets through front-end human capital.</p>', '2016-12-30 16:38:55', 2),
(2, 'Download free theme!', '<p>Holisticly customize reliable intellectual capital with magnetic infomediaries. Quickly customize multidisciplinary potentialities without end-to-end users. Intrinsicly build global applications vis-a-vis reliable expertise. Completely engage focused experiences rather than professional networks. Seamlessly actualize customer directed methods of empowerment for impactful platforms.</p>\r\n\r\n<p>Compellingly re-engineer leading-edge meta-services with progressive architectures. Efficiently harness an expanded array of materials without strategic e-markets. Conveniently harness enabled portals with e-business platforms. Synergistically e-enable B2C strategic theme areas after interdependent e-commerce. Interactively network bricks-and-clicks leadership whereas high standards in e-business.</p>', '2012-02-08 15:51:47', 1),
(3, 'asdf', 'asdfasdf', '2017-02-08 06:32:13', 0),
(4, 'asdf', 'asdfasdf', '0000-00-00 00:00:00', 0),
(5, 'Another TEST', 'fuck you flsdkjaflksjdgk;jasdkjgsdfnglksjdflsdfasdf', '0000-00-00 00:00:00', 0),
(6, 'Post Title', 'asdfasdfasdf', '0000-00-00 00:00:00', 0),
(9, 'Post Title', '', '0000-00-00 00:00:00', 0),
(10, 'Post Title', '', '0000-00-00 00:00:00', 0),
(11, 'Post Title', '', '0000-00-00 00:00:00', 0),
(12, 'Post Title', 'asdfasdf', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_category_relations`
--

CREATE TABLE IF NOT EXISTS `post_category_relations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `post_category_relations`
--

INSERT INTO `post_category_relations` (`id`, `post_id`, `category_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 2, 1),
(4, 2, 4),
(5, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, 'pENTtHCi9660zTP5D6Xpze', 1268889823, 1483298399, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '10.240.0.189', 'Chris', '$2y$08$OsGxIzPr.yZh1WkaSLhhyOuv/UrxcZCJDdXGSdFbVotMS6Q7R.hai', NULL, 'info@radical-design.us', NULL, NULL, NULL, NULL, 1454416892, NULL, 1, 'Chris', 'Uberti', 'lkj', '234325235');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(10, 1, 1),
(11, 1, 2),
(9, 2, 1),
(4, 2, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
