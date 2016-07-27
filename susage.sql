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
-- 表的结构 `sys_user`
--

CREATE TABLE `sys_user` (
  `id` int(11) NOT NULL,
  `stuid` varchar(20) NOT NULL COMMENT '登录ID，昵称',
  `tname` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '真实名字',
  `headimg` varchar(300) DEFAULT NULL COMMENT '头像路径，须为绝对路径',
  `pw` varchar(32) NOT NULL COMMENT '密码',
  `dep` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '所在部门',
  `salt` varchar(6) NOT NULL,
  `job` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '普通用户' COMMENT '职称',
  `isMaster` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否组长，0不是，1是',
  `isAdmin` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否管理员，0不是，1是',
  `isSuper` varchar(1) NOT NULL DEFAULT '0' COMMENT '是否超管，0不是，1是'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户 - 数据表';

--
-- 转存表中的数据 `sys_user`
--

INSERT INTO `sys_user` (`id`, `stuid`, `tname`, `headimg`, `pw`, `dep`, `salt`, `job`, `isMaster`, `isAdmin`, `isSuper`) VALUES
(1, 'jerry', '小生蚝', '/SUsage/storage/avatar/avatar-zjh.png', '020763a7cb41ef19fbbf89abc8ebc496', '电视台', '4S2N7S', '超级管理员', '1', '1', '1'),
(2, 'ghost', '谭震荡', '/SUsage/storage/avatar/avatar-tan.jpg', 'be0965fac5813089178e0ed4dfbd839a', '电视台', 'QG11L1', '用户', '0', '0', '0'),
(3, 'Enatsu', '夏酱', '/SUsage/storage/avatar/avatar-5117.jpg', 'eda023d1967a2b7afadc15e138576dbd', '电视台', 'BEGW54', '管理员', '1', '1', '0');

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
  `ct` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT '任务内容',
  `pubtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='任务 - 数据表';

--
-- 转存表中的数据 `task_list`
--

INSERT INTO `task_list` (`Taskid`, `pubman`, `pubdep`, `redep`, `ct`, `pubtime`) VALUES
(1, '小生蚝', '主席团', '电视台', '我们需要一条宣传片子', '2016-05-16 19:01:00'),
(2, '夏酱', '电脑部', '主席团', '你们有一个好 全世界跑到什么地方……', '2016-05-28 01:44:08');

--
-- Indexes for table `sys_user`
--
ALTER TABLE `sys_user`
  ADD PRIMARY KEY (`id`);

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
-- 使用表AUTO_INCREMENT `sys_user`
--
ALTER TABLE `sys_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `task_complete`
--
ALTER TABLE `task_complete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `task_list`
--
ALTER TABLE `task_list`
  MODIFY `Taskid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;