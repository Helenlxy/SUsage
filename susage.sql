-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-05-25 06:23:11
-- 服务器版本： 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `susage`
--

-- --------------------------------------------------------

--
-- 表的结构 `bill_list`
--

CREATE TABLE `bill_list` (
  `billid` int(11) NOT NULL,
  `BillName` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '账单名称',
  `Content` varchar(300) COLLATE utf8_unicode_ci NOT NULL COMMENT '账单内容',
  `Cost` varchar(8) COLLATE utf8_unicode_ci NOT NULL COMMENT '支出',
  `Income` varchar(8) COLLATE utf8_unicode_ci NOT NULL COMMENT '收入',
  `Registrant` varchar(5) COLLATE utf8_unicode_ci NOT NULL COMMENT '账单登记人'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `bill_list`
--

INSERT INTO `bill_list` (`billid`, `BillName`, `Content`, `Cost`, `Income`, `Registrant`) VALUES
(1, '测试', '测试', '100', '200', 'root');

-- --------------------------------------------------------

--
-- 表的结构 `bill_money`
--

CREATE TABLE `bill_money` (
  `id` int(11) NOT NULL,
  `pay` decimal(10,2) NOT NULL,
  `income` decimal(10,2) NOT NULL,
  `surplus` decimal(10,2) NOT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `bill_money`
--

INSERT INTO `bill_money` (`id`, `pay`, `income`, `surplus`, `ip`, `updatetime`) VALUES
(1, '666.00', '233.00', '0.00', '127.0.0.1', '2016-08-19 16:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `login_token`
--

CREATE TABLE `login_token` (
  `id` int(11) NOT NULL,
  `SessionID` text COLLATE utf8_unicode_ci NOT NULL,
  `LoginTime` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `ErrorCount` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `login_token`
--

INSERT INTO `login_token` (`id`, `SessionID`, `LoginTime`, `ErrorCount`) VALUES
(2, 'pfdsikro5cvcf6kraqip3i7th0', '20170524 17:48', 1);

-- --------------------------------------------------------

--
-- 表的结构 `sys_login_log`
--

CREATE TABLE `sys_login_log` (
  `id` int(11) NOT NULL,
  `UserName` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `Password` text COLLATE utf8_unicode_ci NOT NULL,
  `UserAgent` text COLLATE utf8_unicode_ci NOT NULL,
  `SessionID` text COLLATE utf8_unicode_ci NOT NULL,
  `IPAddress` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `LoginTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isSuccess` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `sys_user`
--

CREATE TABLE `sys_user` (
  `id` int(11) NOT NULL,
  `stuid` varchar(20) NOT NULL COMMENT '登录ID，昵称',
  `tname` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '真实名字',
  `headimg` varchar(300) DEFAULT '../avatar/avatar.jpg' COMMENT '头像路径',
  `pw` text NOT NULL COMMENT '密码',
  `dep` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '所在部门',
  `job` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '普通用户' COMMENT '职称',
  `isLock` varchar(1) NOT NULL DEFAULT '0',
  `Phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户 - 数据表';

--
-- 转存表中的数据 `sys_user`
--

INSERT INTO `sys_user` (`id`, `stuid`, `tname`, `headimg`, `pw`, `dep`, `job`, `isLock`, `Phone`) VALUES
(1, 'root', '根管理员', '/SUsage/avatar/avatar.jpg', '7c4a8d09ca3762af61e59520943dc26494f8941b', '主席团,电脑部', '根管理员', '0', 0),
(2, 'super', '超级管理员', '/SUsage/avatar/avatar.jpg', '7c4a8d09ca3762af61e59520943dc26494f8941b', '电脑部', '超级管理员', '0', 0),
(3, 'admin', '管理员', '/SUsage/avatar/avatar.jpg', '7c4a8d09ca3762af61e59520943dc26494f8941b', '电脑部', '管理员', '0', 0),
(4, 'master', '组长', '/SUsage/avatar/avatar.jpg', '7c4a8d09ca3762af61e59520943dc26494f8941b', '电脑部', '组长', '0', 0),
(5, 'user', '用户', '/SUsage/avatar/avatar.jpg', '7c4a8d09ca3762af61e59520943dc26494f8941b', '电脑部', '普通用户', '0', 0);

-- --------------------------------------------------------

--
-- 表的结构 `sys_user_purv`
--

CREATE TABLE `sys_user_purv` (
  `id` int(11) NOT NULL,
  `Userid` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `isMaster` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `isAdmin` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `isSuper` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `isRoot` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `CanSee` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `sys_user_purv`
--

INSERT INTO `sys_user_purv` (`id`, `Userid`, `isMaster`, `isAdmin`, `isSuper`, `isRoot`, `CanSee`) VALUES
(1, '1', '1', '1', '1', '1', '1'),
(2, '2', '1', '1', '1', '0', '1'),
(3, '3', '1', '1', '0', '0', '1'),
(4, '4', '1', '0', '0', '0', '0'),
(5, '5', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- 表的结构 `task_complete`
--

CREATE TABLE `task_complete` (
  `id` int(11) NOT NULL,
  `Taskid` varchar(4) COLLATE utf8_unicode_ci NOT NULL COMMENT '任务ID，与任务表关联',
  `Userid` varchar(4) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户ID，与用户表关联',
  `isComplete` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '是否完成，0未完成，1已完成'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='任务 - 完成情况记录表';

-- --------------------------------------------------------

--
-- 表的结构 `task_list`
--

CREATE TABLE `task_list` (
  `Taskid` int(11) NOT NULL,
  `pubman` varchar(5) COLLATE utf8_unicode_ci NOT NULL COMMENT '发布人的真实姓名',
  `pubdep` varchar(4) COLLATE utf8_unicode_ci NOT NULL COMMENT '发布人的部门',
  `redep` text COLLATE utf8_unicode_ci NOT NULL COMMENT '接收部门 用英文,隔开',
  `ct` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '任务内容',
  `pubtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='任务 - 数据表';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill_list`
--
ALTER TABLE `bill_list`
  ADD PRIMARY KEY (`billid`);

--
-- Indexes for table `bill_money`
--
ALTER TABLE `bill_money`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_token`
--
ALTER TABLE `login_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_login_log`
--
ALTER TABLE `sys_login_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_user`
--
ALTER TABLE `sys_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `stuid` (`stuid`);

--
-- Indexes for table `sys_user_purv`
--
ALTER TABLE `sys_user_purv`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Userid` (`Userid`);

--
-- Indexes for table `task_complete`
--
ALTER TABLE `task_complete`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_list`
--
ALTER TABLE `task_list`
  ADD PRIMARY KEY (`Taskid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `bill_list`
--
ALTER TABLE `bill_list`
  MODIFY `billid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `bill_money`
--
ALTER TABLE `bill_money`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `login_token`
--
ALTER TABLE `login_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `sys_login_log`
--
ALTER TABLE `sys_login_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `sys_user`
--
ALTER TABLE `sys_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `sys_user_purv`
--
ALTER TABLE `sys_user_purv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `task_complete`
--
ALTER TABLE `task_complete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- 使用表AUTO_INCREMENT `task_list`
--
ALTER TABLE `task_list`
  MODIFY `Taskid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
