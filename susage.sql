CREATE TABLE IF NOT EXISTS `bill_list` (
  `billid` int(11) NOT NULL AUTO_INCREMENT,
  `BillName` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '账单名称',
  `Content` varchar(300) COLLATE utf8_unicode_ci NOT NULL COMMENT '账单内容',
  `Cost` varchar(8) COLLATE utf8_unicode_ci NOT NULL COMMENT '支出',
  `Income` varchar(8) COLLATE utf8_unicode_ci NOT NULL COMMENT '收入',
  `Registrant` varchar(5) COLLATE utf8_unicode_ci NOT NULL COMMENT '账单登记人',
  PRIMARY KEY (`billid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `bill_list` (`billid`, `BillName`, `Content`, `Cost`, `Income`, `Registrant`) VALUES
(1, '测试', '测试', '100', '200', '夏酱');

CREATE TABLE IF NOT EXISTS `bill_money` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pay` decimal(10,2) NOT NULL,
  `income` decimal(10,2) NOT NULL,
  `surplus` decimal(10,2) NOT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `bill_money` (`id`, `pay`, `income`, `surplus`, `ip`, `updatetime`) VALUES
(1, '666.00', '233.00', '0.00', '127.0.0.1', '2016-08-20 00:00:00');

CREATE TABLE IF NOT EXISTS `login_token` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`SessionID` TEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`LoginTime` VARCHAR(14) NOT NULL COLLATE 'utf8_unicode_ci',
	`ErrorCount` INT(1) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
) COLLATE='utf8_unicode_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `sys_login_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `Password` text COLLATE utf8_unicode_ci NOT NULL,
  `UserAgent` text COLLATE utf8_unicode_ci NOT NULL,
  `SessionID` text COLLATE utf8_unicode_ci NOT NULL,
  `IPAddress` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `LoginTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `sys_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stuid` varchar(20) NOT NULL COMMENT '登录ID，昵称',
  `tname` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '真实名字',
  `headimg` varchar(300) DEFAULT '../avatar/avatar.jpg' COMMENT '头像路径',
  `pw` text NOT NULL COMMENT '密码',
  `dep` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '所在部门',
  `job` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '普通用户' COMMENT '职称',
  `isLock` varchar(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `stuid` (`stuid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户 - 数据表';

INSERT INTO `sys_user` (`id`, `stuid`, `tname`, `headimg`, `pw`, `dep`, `job`, `isLock`) VALUES
(1, 'super', '小生蚝', '/SUsage/storage/avatar/avatar-zjh.png', '7c4a8d09ca3762af61e59520943dc26494f8941b', '主席团,电脑部', '超级管理员', '0'),
(2, 'Enatsu', '夏酱', '/SUsage/storage/avatar/avatar-5117.jpg', '7c4a8d09ca3762af61e59520943dc26494f8941b', '电脑部', '管理员', '0');

CREATE TABLE IF NOT EXISTS `sys_user_purv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Userid` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `isMaster` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `isAdmin` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `isSuper` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `isRoot` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `CanSee` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Userid` (`Userid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `sys_user_purv` (`id`, `Userid`, `isMaster`, `isAdmin`, `isSuper`, `isRoot`, `CanSee`) VALUES
(1, '1', '1', '1', '0', '0', '1'),
(2, '2', '1', '1', '1', '1', '1');

CREATE TABLE IF NOT EXISTS `task_complete` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Taskid` varchar(4) COLLATE utf8_unicode_ci NOT NULL COMMENT '任务ID，与任务表关联',
  `Userid` varchar(4) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户ID，与用户表关联',
  `isComplete` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '是否完成，0未完成，1已完成',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='任务 - 完成情况记录表';

CREATE TABLE IF NOT EXISTS `task_list` (
  `Taskid` int(11) NOT NULL AUTO_INCREMENT,
  `pubman` varchar(5) COLLATE utf8_unicode_ci NOT NULL COMMENT '发布人的真实姓名',
  `pubdep` varchar(4) COLLATE utf8_unicode_ci NOT NULL COMMENT '发布人的部门',
  `redep` text COLLATE utf8_unicode_ci NOT NULL COMMENT '接收部门 用英文,隔开',
  `ct` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '任务内容',
  `pubtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Taskid`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='任务 - 数据表';