-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2019-12-24 03:36:57
-- 服务器版本： 10.1.39-MariaDB
-- PHP 版本： 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `rongyi`
--

-- --------------------------------------------------------

--
-- 表的结构 `apply`
--

CREATE TABLE `apply` (
  `cid` int(11) NOT NULL,
  `things` int(11) DEFAULT NULL,
  `money` int(11) DEFAULT NULL,
  `service` text COLLATE utf8_bin,
  `tel` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `pid` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `chatown`
--

CREATE TABLE `chatown` (
  `oid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `applier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `feedback`
--

CREATE TABLE `feedback` (
  `name` varchar(11) NOT NULL,
  `email` varchar(32) NOT NULL,
  `message` text NOT NULL,
  `fid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `guanzhu`
--

CREATE TABLE `guanzhu` (
  `uid` smallint(5) UNSIGNED NOT NULL,
  `pid1` smallint(5) UNSIGNED DEFAULT NULL,
  `pid2` smallint(5) UNSIGNED DEFAULT NULL,
  `pid3` smallint(5) UNSIGNED DEFAULT NULL,
  `pid4` smallint(5) UNSIGNED DEFAULT NULL,
  `pid5` smallint(5) UNSIGNED DEFAULT NULL,
  `pid6` smallint(5) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE `message` (
  `id` int(10) NOT NULL COMMENT 'ID',
  `reciver_uid` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '接受者',
  `sender_uid` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '发生者',
  `content` varchar(1000) NOT NULL DEFAULT '' COMMENT '消息内容',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '发送时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='聊天信息表';

-- --------------------------------------------------------

--
-- 表的结构 `things`
--

CREATE TABLE `things` (
  `pid` int(64) NOT NULL,
  `class` varchar(64) COLLATE utf8_bin NOT NULL,
  `uid` int(64) NOT NULL,
  `obname` varchar(64) COLLATE utf8_bin NOT NULL,
  `descrip` text COLLATE utf8_bin NOT NULL,
  `new` varchar(64) COLLATE utf8_bin NOT NULL,
  `time` date NOT NULL,
  `pic` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `money` int(64) DEFAULT NULL,
  `tothings` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `toservices` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `userinformation`
--

CREATE TABLE `userinformation` (
  `uid` int(11) NOT NULL,
  `need` text COLLATE utf8_bin NOT NULL,
  `school` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `uid` int(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `gender` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `tel` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转储表的索引
--

--
-- 表的索引 `apply`
--
ALTER TABLE `apply`
  ADD PRIMARY KEY (`cid`);

--
-- 表的索引 `chatown`
--
ALTER TABLE `chatown`
  ADD PRIMARY KEY (`oid`);

--
-- 表的索引 `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`fid`);

--
-- 表的索引 `guanzhu`
--
ALTER TABLE `guanzhu`
  ADD PRIMARY KEY (`uid`);

--
-- 表的索引 `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reciver_uid` (`reciver_uid`);

--
-- 表的索引 `things`
--
ALTER TABLE `things`
  ADD PRIMARY KEY (`pid`);

--
-- 表的索引 `userinformation`
--
ALTER TABLE `userinformation`
  ADD PRIMARY KEY (`uid`);

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `tel` (`tel`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `apply`
--
ALTER TABLE `apply`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `chatown`
--
ALTER TABLE `chatown`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `feedback`
--
ALTER TABLE `feedback`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `guanzhu`
--
ALTER TABLE `guanzhu`
  MODIFY `uid` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `message`
--
ALTER TABLE `message`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID';

--
-- 使用表AUTO_INCREMENT `things`
--
ALTER TABLE `things`
  MODIFY `pid` int(64) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `userinformation`
--
ALTER TABLE `userinformation`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(64) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
