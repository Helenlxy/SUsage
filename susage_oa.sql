-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-07-10 10:15:45
-- 服务器版本： 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `susage_oa`
--

-- --------------------------------------------------------

--
-- 表的结构 `chat_content`
--

CREATE TABLE `chat_content` (
  `id` int(11) NOT NULL,
  `SenderID` varchar(3) NOT NULL,
  `RecipientID` varchar(3) NOT NULL,
  `whoID` varchar(7) NOT NULL,
  `isRead` varchar(1) NOT NULL,
  `content` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `sys_notice` (
  `id` int(11) NOT NULL,
  `topic` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(10000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `sys_user`
--

CREATE TABLE `sys_user` (
  `id` int(11) NOT NULL,
  `stuid` varchar(20) NOT NULL COMMENT '登录ID，昵称',
  `tname` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '真实名字',
  `sname` varchar(1) NOT NULL,
  `headimg` varchar(200) NOT NULL,
  `pw` varchar(32) NOT NULL,
  `dep` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `depgroup` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '所在组别',
  `status` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '未激活' COMMENT '账户激活状态',
  `salt` varchar(6) NOT NULL COMMENT '可以为空，用于后台登录',
  `job` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `isMaster` varchar(1) NOT NULL,
  `isAdmin` varchar(1) NOT NULL DEFAULT '0',
  `isSuper` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sys_user`
--

INSERT INTO `sys_user` (`id`, `stuid`, `tname`, `sname`, `headimg`, `pw`, `dep`, `depgroup`, `status`, `salt`, `job`, `isMaster`, `isAdmin`, `isSuper`) VALUES
(1, 'jerry', '张镜濠', 'z', '/SUsage/storage/avatar/avatar-zjh.png', '020763a7cb41ef19fbbf89abc8ebc496', '电视台', '电视台', '已激活', '4s2n7s', '超级管理员', '1', '1', '1'),
(2, 'ghost', '谭震荡', 'T', '/SUsage/storage/avatar/avatar-tan.jpg', 'be0965fac5813089178e0ed4dfbd839a', '电视台', '电脑部', '未激活', 'QG11L1', '用户', '0', '0', '0'),
(3, 'Enatsu', '夏酱', 'X', '/SUsage/storage/avatar/avatar-5117.jpg', 'eda023d1967a2b7afadc15e138576dbd', '电视台', '电视台', '已激活', 'BEGW54', '管理员', '1', '1', '0');

-- --------------------------------------------------------

--
-- 表的结构 `task_list`
--

CREATE TABLE `task_list` (
  `id` int(11) NOT NULL,
  `pubman` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `pubgroup` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `regroup` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `topic` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `pubtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `task_list`
--

INSERT INTO `task_list` (`id`, `pubman`, `pubgroup`, `regroup`, `topic`, `content`, `pubtime`) VALUES
(1, '张镜濠', '电脑部 DC组', '电视台', '任务标题', '<font color="red">Red Font</font><font color="green"><b>Big Green</b></font>', '2016-05-16 19:01:00'),
(3, '夏酱', '电脑部 网页组', '电视台', '任务标题', '你们有一个好 全世界跑到什么地方……', '2016-05-28 01:44:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sys_user`
--
ALTER TABLE `sys_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_list`
--
ALTER TABLE `task_list`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `sys_user`
--
ALTER TABLE `sys_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `task_list`
--
ALTER TABLE `task_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
