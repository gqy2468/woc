-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2011 年 02 月 06 日 13:16
-- 服务器版本: 5.0.89
-- PHP 版本: 5.2.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `test`
--

-- --------------------------------------------------------

--
-- 表的结构 `data`
--

CREATE TABLE IF NOT EXISTS `data` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL,
  `admin` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `provider` varchar(64) NOT NULL,
  `status` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `data`
--


-- --------------------------------------------------------

--
-- 表的结构 `domain`
--

CREATE TABLE IF NOT EXISTS `domain` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL,
  `admin` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `provider` varchar(64) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `domain`
--


-- --------------------------------------------------------

--
-- 表的结构 `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL,
  `admin` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `provider` varchar(64) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `email`
--


-- --------------------------------------------------------

--
-- 表的结构 `function`
--

CREATE TABLE IF NOT EXISTS `function` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `function`
--

INSERT INTO `function` (`id`, `name`) VALUES
(1, '网站管理'),
(2, '域名管理'),
(3, '主机管理'),
(4, '数据管理'),
(5, '邮箱管理'),
(6, '用户管理'),
(7, '角色管理'),
(8, '分类管理'),
(9, '功能管理');

-- --------------------------------------------------------

--
-- 表的结构 `host`
--

CREATE TABLE IF NOT EXISTS `host` (
  `id` int(11) NOT NULL auto_increment,
  `ip` varchar(64) NOT NULL,
  `admin` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `provider` varchar(64) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `host`
--


-- --------------------------------------------------------

--
-- 表的结构 `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `pid` int(10) unsigned NOT NULL auto_increment,
  `rid` int(11) NOT NULL,
  `perm` longtext,
  PRIMARY KEY  (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `permission`
--

INSERT INTO `permission` (`pid`, `rid`, `perm`) VALUES
(16, 363064, '0'),
(17, 293066, '邮箱管理,数据管理,主机管理,域名管理,网站管理');

-- --------------------------------------------------------

--
-- 表的结构 `rnum`
--

CREATE TABLE IF NOT EXISTS `rnum` (
  `id` int(11) NOT NULL auto_increment,
  `sname` varchar(64) NOT NULL,
  `onum` int(11) default NULL,
  `cnum` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `rnum`
--


-- --------------------------------------------------------

--
-- 表的结构 `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL auto_increment,
  `rid` int(10) unsigned NOT NULL default '0',
  `name` varchar(64) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `role`
--

INSERT INTO `role` (`id`, `rid`, `name`) VALUES
(1, 363064, '管理员'),
(2, 293066, '普通用户');

-- --------------------------------------------------------

--
-- 表的结构 `site`
--

CREATE TABLE IF NOT EXISTS `site` (
  `sid` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL,
  `admin` varchar(64) NOT NULL,
  `username` varchar(30) default NULL,
  `password` varchar(30) default NULL,
  `method` varchar(30) default NULL,
  `status` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `dmid` int(11) NOT NULL,
  `hid` int(11) NOT NULL,
  `dbid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  PRIMARY KEY  (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `site`
--


-- --------------------------------------------------------

--
-- 表的结构 `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL auto_increment,
  `tid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `type`
--

INSERT INTO `type` (`id`, `tid`, `name`) VALUES
(2, 24155, '商城');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(60) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `email` varchar(64) default NULL,
  `telphone` varchar(20) default NULL,
  `status` tinyint(4) NOT NULL,
  `created` int(11) NOT NULL,
  `access` int(11) NOT NULL,
  `login` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `rid` int(11) NOT NULL,
  `rname` varchar(64) NOT NULL,
  `ptid` int(11) NOT NULL,
  `pname` varchar(64) NOT NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`uid`, `name`, `pass`, `email`, `telphone`, `status`, `created`, `access`, `login`, `ip`, `rid`, `rname`, `ptid`, `pname`) VALUES
(1, 'admin', '123456', 'test@163.com', '123456', 1, 1296646925, 1296646925, 1296646925, '127.0.0.1', 363064, '管理员', 0, 'All Product'),
(2, 'test', '123456', 'test@163.com', '123456', 1, 1296647117, 1296647117, 1296647117, '127.0.0.1', 293066, '普通用户', 0, 'All Product');
