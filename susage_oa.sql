-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-05-29 02:46:40
-- 服务器版本： 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+08:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `susage_oa`
--
CREATE DATABASE IF NOT EXISTS `susage_oa` DEFAULT CHARACTER SET latin1 COLLATE utf8_unicode_ci;
USE `susage_oa`;

-- --------------------------------------------------------

--
-- 表的结构 `chat_content`
--

CREATE TABLE IF NOT EXISTS `chat_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SenderID` varchar(3) NOT NULL,
  `RecipientID` varchar(3) NOT NULL,
  `whoID` varchar(7) NOT NULL,
  `isRead` varchar(1) NOT NULL,
  `content` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `chat_content`
--

INSERT INTO `chat_content` (`id`, `SenderID`, `RecipientID`, `whoID`, `isRead`, `content`) VALUES
(1, '2', '1', '1,2', '0', '欢迎你步入崇德瀹智之门！'),
(2, '1', '2', '1,2', '1', '校长你真的很帅！'),
(3, '2', '1', '1,2', '0', '谢谢你对校长的评价！'),
(4, '1', '1', '1,1', '1', '光头强自己发给自己'),
(5, '4', '1', '1,4', '', '学姐很粗暴的说到：“测试标点符号！”'),
(6, '1', '3', '1,3', '', '我发给组长的'),
(10, '1', '4', '1,4', '', '人与人炎热亿元'),
(11, '1', '4', '1,4', '', '哈哈哈'),
(12, '1', '3', '1,3', '', 'ajax测试'),
(13, '1', '2', '1,2', '', 'ajax再次测试'),
(15, '2', '1', '1,2', '', 'headmaster ^^^');

-- --------------------------------------------------------

--
-- 表的结构 `sys_notice`
--

CREATE TABLE IF NOT EXISTS `sys_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '全局通知标题',
  `content` varchar(10000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '全局通知内容，仅为文字',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- 表的结构 `sys_user`
--

CREATE TABLE IF NOT EXISTS `sys_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stuid` varchar(20) NOT NULL COMMENT '登录ID，昵称',
  `tname` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '真实名字',
  `sname` varchar(1) NOT NULL COMMENT '姓氏拼音首字母',
  `headimg` varchar(200) NOT NULL COMMENT '头像路径，须为绝对路径',
  `pw` varchar(32) NOT NULL COMMENT '密码',
  `dep` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '所在部门',
  `depgroup` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '所在组别',
  `salt` varchar(6) NOT NULL,
  `job` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '职称',
  `isMaster` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否组长，0不是，1是',
  `isAdmin` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否管理员，0不是，1是',
  `isSuper` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否超管，0不是，1是',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sys_user`
--

INSERT INTO `sys_user` (`id`, `stuid`, `tname`, `sname`, `headimg`, `pw`, `dep`, `depgroup`, `salt`, `job`, `isMaster`, `isAdmin`, `isSuper`) VALUES
(1, 'super', '超管', 'C', '/SUsage/storage/avatar/avatar-zjh.png', '742ac5d658b1bc6ee73a014998e4b438', '电脑部', '网页组', 'L4S4QX', '超级管理员', '1', '1', '1'),
(2, 'Enatsu', '学姐', 'X', '/SUsage/storage/avatar/avatar-5117.jpg', '56b9d20d2f442bc27bd1c9d5a62c3148', '电视台', '电视台', 'RR5V9E', '超级管理员', '1', '0', '0');

-- --------------------------------------------------------

--
-- 表的结构 `task_list`
--

CREATE TABLE IF NOT EXISTS `task_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pubman` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `pubgroup` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `regroup` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `topic` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `pubtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `task_list`
--

INSERT INTO `task_list` (`id`, `pubman`, `pubgroup`, `regroup`, `topic`, `content`, `pubtime`) VALUES
(1, '张镜濠', '电脑部 DC组', '电视台', '任务标题', '<font color="red">Red Font</font><font color="green"><b>Big Green</b></font>', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

