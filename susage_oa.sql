-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-05-26 12:29:23
-- 服务器版本： 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `susage_oa`
--

-- --------------------------------------------------------

--
-- 表的结构 `chat_content`
--

CREATE TABLE IF NOT EXISTS `chat_content` (
`id` int(11) NOT NULL,
  `SenderID` varchar(3) NOT NULL,
  `RecipientID` varchar(3) NOT NULL,
  `whoID` varchar(7) NOT NULL,
  `isRead` varchar(1) NOT NULL,
  `content` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `chat_content`
--

INSERT INTO `chat_content` (`id`, `SenderID`, `RecipientID`, `whoID`, `isRead`, `content`) VALUES
(1, '2', '1', '1,2', '0', '欢迎你步入崇德瀹智之门！'),
(2, '1', '2', '1,2', '1', '校长你真的很帅！'),
(3, '2', '1', '1,2', '0', '这是校长发给你的。'),
(4, '1', '1', '1,1', '1', '光头强自己发给自己'),
(5, '4', '1', '1,4', '', '学姐很粗暴的说到：“测试标点符号！”'),
(6, '1', '3', '1,3', '', '我发给组长的');

-- --------------------------------------------------------

--
-- 表的结构 `user_list`
--

CREATE TABLE IF NOT EXISTS `user_list` (
`uid` int(11) NOT NULL,
  `stuid` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tname` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '真实姓名',
  `sname` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pw` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `headimg` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `susage-key` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dep` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `depgroup` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `qx` varchar(5) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `user_list`
--

INSERT INTO `user_list` (`uid`, `stuid`, `tname`, `sname`, `pw`, `headimg`, `susage-key`, `dep`, `depgroup`, `qx`) VALUES
(1, 'admin', '光头强', 'z', '9b5852a88ff96df09523dbcbefb2242e', '../storage/avatar/avatar-zjh.png', '', '', '', '100'),
(2, 'headmaster', '校长', 'x', '', '../storage/avatar/avatar_supc.jpg', '', '', '', ''),
(3, '123456', '杨组长', 'Y', '', '../storage/avatar/avatar-yang.png', '', '', '', ''),
(4, 'Enatsu', '学姐', 'J', '14e1b600b1fd579f47433b88e8d85291', '../storage/avatar/avatar-5117.jpg', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_content`
--
ALTER TABLE `chat_content`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `user_list`
--
ALTER TABLE `user_list`
 ADD PRIMARY KEY (`uid`), ADD UNIQUE KEY `uid` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_content`
--
ALTER TABLE `chat_content`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_list`
--
ALTER TABLE `user_list`
MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
