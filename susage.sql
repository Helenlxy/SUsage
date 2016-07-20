-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-07-10 10:15:45
-- 服务器版本： 10.1.10-MariaDB
-- PHP Version: 5.6.19


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `susage`
--

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
  `headimg` varchar(200) NOT NULL COMMENT '头像图像的绝对路径',
  `pw` varchar(32) NOT NULL,
  `dep` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(6) NOT NULL,
  `job` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `isMaster` varchar(1) NOT NULL DEFAULT '0',
  `isAdmin` varchar(1) NOT NULL DEFAULT '0',
  `isSuper` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sys_user`
--

INSERT INTO `sys_user` (`id`, `stuid`, `tname`, `headimg`, `pw`, `dep`, `salt`, `job`, `isMaster`, `isAdmin`, `isSuper`) VALUES
(1, 'jerry', '张镜濠', '/SUsage/storage/avatar/avatar-zjh.png', '020763a7cb41ef19fbbf89abc8ebc496', '电视台', '4S2N7S', '超级管理员', '1', '1', '1'),
(2, 'ghost', '谭震荡', '/SUsage/storage/avatar/avatar-tan.jpg', 'be0965fac5813089178e0ed4dfbd839a', '电视台', 'QG11L1', '用户', '0', '0', '0'),
(3, 'Enatsu', '夏酱', '/SUsage/storage/avatar/avatar-5117.jpg', 'eda023d1967a2b7afadc15e138576dbd', '电视台', 'BEGW54', '管理员', '1', '1', '0');

-- --------------------------------------------------------

--
-- 表的结构 `task_list`
--

CREATE TABLE `task_list` (
  `Taskid` int(11) NOT NULL,
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

INSERT INTO `task_list` (`Taskid`, `pubman`, `pubgroup`, `regroup`, `topic`, `content`, `pubtime`) VALUES
(1, '张镜濠', 'App组', '视频组', '任务标题', '我们组需要一条宣传片子', '2016-05-16 19:01:00'),
(2, '夏酱', 'App组', '主席团', '任务标题', '你们有一个好 全世界跑到什么地方……', '2016-05-28 01:44:08');

--
-- Indexes for table `sys_user`
--
ALTER TABLE `sys_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_list`
--
ALTER TABLE `task_list`
  ADD PRIMARY KEY (`Taskid`);

--
-- 使用表AUTO_INCREMENT `sys_user`
--
ALTER TABLE `sys_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `task_list`
--
ALTER TABLE `task_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;