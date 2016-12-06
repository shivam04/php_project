-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2016 at 11:17 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sns`
--

-- --------------------------------------------------------

--
-- Table structure for table `cmnt`
--

CREATE TABLE IF NOT EXISTS `cmnt` (
`cmnt_id` int(11) NOT NULL,
  `cmnt_val` varchar(200) NOT NULL,
  `user_name_fk` varchar(20) NOT NULL,
  `reply_count` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `post_id_fk` int(11) NOT NULL,
  `created` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cmnt`
--

INSERT INTO `cmnt` (`cmnt_id`, `cmnt_val`, `user_name_fk`, `reply_count`, `likes`, `post_id_fk`, `created`) VALUES
(3, 'yo yo', 'ipg_2014099', 1, 2, 4, 1460962402),
(4, 'waah', 'vaibhavk77', 0, 0, 4, 1460965127),
(5, 'gud', 'vaibhavk77', 0, 1, 4, 1460965275);

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE IF NOT EXISTS `friend` (
`id` int(11) NOT NULL,
  `friend1` varchar(20) NOT NULL,
  `friend2` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friend`
--

INSERT INTO `friend` (`id`, `friend1`, `friend2`, `status`, `time`) VALUES
(1, 'ipg_2014082', 'vaibhavk77', 'accept', 1460969730),
(2, 'ipg_2014099', 'vaibhavk77', 'accept', 1460970233),
(3, 'chahes', 'ipg_2014082', 'accept', 1460970939);

-- --------------------------------------------------------

--
-- Table structure for table `like_cmnt`
--

CREATE TABLE IF NOT EXISTS `like_cmnt` (
`id` int(11) NOT NULL,
  `cmnt_id_fk` int(11) NOT NULL,
  `user_name_fk` varchar(20) NOT NULL,
  `created` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `like_cmnt`
--

INSERT INTO `like_cmnt` (`id`, `cmnt_id_fk`, `user_name_fk`, `created`) VALUES
(1, 3, 'ipg_2014082', 1460962417),
(2, 3, 'vaibhavk77', 1460965114),
(3, 5, 'chahes', 1460970973);

-- --------------------------------------------------------

--
-- Table structure for table `like_post`
--

CREATE TABLE IF NOT EXISTS `like_post` (
`id` int(11) NOT NULL,
  `post_id_fk` int(11) NOT NULL,
  `user_name_fk` varchar(20) NOT NULL,
  `created` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `like_post`
--

INSERT INTO `like_post` (`id`, `post_id_fk`, `user_name_fk`, `created`) VALUES
(1, 4, 'ipg_2014099', 1460962404),
(2, 4, 'vaibhavk77', 1460965113),
(3, 4, 'chahes', 1460970971);

-- --------------------------------------------------------

--
-- Table structure for table `like_reply`
--

CREATE TABLE IF NOT EXISTS `like_reply` (
`id` int(11) NOT NULL,
  `reply_id_fk` int(11) NOT NULL,
  `user_name_fk` varchar(20) NOT NULL,
  `created` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `like_reply`
--

INSERT INTO `like_reply` (`id`, `reply_id_fk`, `user_name_fk`, `created`) VALUES
(2, 1, 'ipg_2014099', 1460963176);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`post_id` int(11) NOT NULL,
  `post` text NOT NULL,
  `user_name_fk` varchar(20) NOT NULL,
  `created` int(20) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post`, `user_name_fk`, `created`, `likes`) VALUES
(4, 'Hi there', 'ipg_2014082', 1460962394, 3),
(5, 'love is enough!!\r\n', 'vaibhavk77', 1460965102, 0),
(6, 'hey how r u guys ?', 'ipg_2014099', 1460970119, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE IF NOT EXISTS `reply` (
`reply_id` int(11) NOT NULL,
  `reply_val` varchar(200) NOT NULL,
  `cmnt_id_fk` int(11) NOT NULL,
  `user_name_fk` varchar(20) NOT NULL,
  `r_like` int(20) NOT NULL,
  `created` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`reply_id`, `reply_val`, `cmnt_id_fk`, `user_name_fk`, `r_like`, `created`) VALUES
(1, 'how r u ?', 3, 'ipg_2014082', 1, 1460962623);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(20) NOT NULL,
  `place` varchar(20) NOT NULL,
  `pic` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `fname`, `lname`, `password`, `gender`, `email`, `place`, `pic`) VALUES
(1, 'ipg_2014082', 'Shivam', 'Sinha', '8960709251', 'male', 'sinhashivam04@gmail.', 'Kanpur', '82.jpg'),
(2, 'ipg_2014099', 'Vaibhav ', 'Khandelwal', '8960709251', 'male', 'vk@gmail.com', 'Jaipur', '87.jpg'),
(3, 'ipg_2014085', 'Shubham', 'Jaroli', 'donj', 'Male', 'jaroli@jaroli.com', 'Udaipur', ''),
(4, 'vaibhavk77', 'vaibhav', 'khandelwal', 'vaibhav', 'Male', 'vaibhavkhandelwal77@', 'jaipur', ''),
(5, 'chahes', 'chahes', 'chopra', 'chahes', 'Male', 'chahes@gmail.com', 'udaipur', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cmnt`
--
ALTER TABLE `cmnt`
 ADD PRIMARY KEY (`cmnt_id`);

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_cmnt`
--
ALTER TABLE `like_cmnt`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_post`
--
ALTER TABLE `like_post`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_reply`
--
ALTER TABLE `like_reply`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
 ADD PRIMARY KEY (`reply_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cmnt`
--
ALTER TABLE `cmnt`
MODIFY `cmnt_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `friend`
--
ALTER TABLE `friend`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `like_cmnt`
--
ALTER TABLE `like_cmnt`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `like_post`
--
ALTER TABLE `like_post`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `like_reply`
--
ALTER TABLE `like_reply`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
