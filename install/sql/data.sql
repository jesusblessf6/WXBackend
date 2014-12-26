-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2014-12-13 12:46:27
-- 服务器版本： 5.5.40
-- PHP Version: 5.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `1213`
--

-- --------------------------------------------------------

--
-- 表的结构 `wy_access`
--

CREATE TABLE IF NOT EXISTS `wy_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wy_activity`
--

CREATE TABLE IF NOT EXISTS `wy_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `joinnum` int(11) NOT NULL COMMENT '参与人数',
  `click` int(11) NOT NULL,
  `token` varchar(30) NOT NULL,
  `keyword` varchar(10) NOT NULL,
  `starpicurl` varchar(100) NOT NULL COMMENT '活动开始图片',
  `title` varchar(60) NOT NULL COMMENT '活动名称',
  `txt` varchar(60) NOT NULL COMMENT '兑奖信息',
  `sttxt` varchar(200) NOT NULL COMMENT '活动主题',
  `statdate` int(11) NOT NULL COMMENT '活动开始时间',
  `enddate` int(11) NOT NULL COMMENT '活动结束时间',
  `info` varchar(200) NOT NULL COMMENT '活动说明',
  `aginfo` varchar(200) NOT NULL COMMENT '活动规则',
  `endtite` varchar(60) NOT NULL COMMENT '结束公告',
  `endpicurl` varchar(100) NOT NULL COMMENT '结束图片地址',
  `endinfo` varchar(60) NOT NULL,
  `fist` varchar(50) NOT NULL COMMENT '一等奖奖品',
  `fistnums` int(4) NOT NULL COMMENT '一等奖奖品数量',
  `fistlucknums` int(1) NOT NULL COMMENT '一等奖中奖人数',
  `second` varchar(50) NOT NULL COMMENT '二等奖奖品',
  `type` tinyint(1) NOT NULL,
  `secondnums` int(4) NOT NULL COMMENT '二等奖奖品数量',
  `secondlucknums` int(1) NOT NULL COMMENT '三等奖中奖人数',
  `third` varchar(50) NOT NULL,
  `thirdnums` int(4) NOT NULL,
  `thirdlucknums` int(1) NOT NULL,
  `allpeople` int(11) NOT NULL COMMENT '预计参与人数',
  `canrqnums` int(2) NOT NULL COMMENT '个人抽奖次数限制',
  `parssword` int(15) NOT NULL,
  `renamesn` varchar(50) NOT NULL DEFAULT '',
  `renametel` varchar(60) NOT NULL,
  `displayjpnums` int(1) NOT NULL,
  `createtime` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `four` varchar(50) NOT NULL COMMENT '四等奖奖品',
  `fournums` int(11) NOT NULL COMMENT '四等奖奖品数量',
  `fourlucknums` int(11) NOT NULL COMMENT '四等奖中奖人数',
  `five` varchar(50) NOT NULL COMMENT '五等奖奖品',
  `fivenums` int(11) NOT NULL COMMENT '5奖品数量',
  `fivelucknums` int(11) NOT NULL COMMENT '5中间人数',
  `six` varchar(50) NOT NULL COMMENT '六等奖奖品',
  `sixnums` int(11) NOT NULL COMMENT '6奖品数量',
  `sixlucknums` int(11) NOT NULL COMMENT '6中奖人数',
  `zjpic` varchar(150) NOT NULL DEFAULT '',
  `daynums` mediumint(4) NOT NULL DEFAULT '0',
  `maxgetprizenum` mediumint(4) NOT NULL DEFAULT '1',
  `needreg` tinyint(1) NOT NULL DEFAULT '0',
  `backmp3` varchar(100) NOT NULL COMMENT '背景音乐',
  `hpic` varchar(150) NOT NULL COMMENT '首页背景图片',
  `xpic` varchar(150) NOT NULL COMMENT '兑奖页面宣传图片',
  `mpic` varchar(150) NOT NULL COMMENT '我的盒子背景图片',
  `optime` int(11) NOT NULL COMMENT '需要分享的次数',
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_adma`
--

CREATE TABLE IF NOT EXISTS `wy_adma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `token` varchar(60) NOT NULL,
  `url` varchar(100) NOT NULL,
  `copyright` varchar(50) NOT NULL,
  `info` varchar(120) NOT NULL,
  `title` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_agent`
--

CREATE TABLE IF NOT EXISTS `wy_agent` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `intro` varchar(800) NOT NULL DEFAULT '',
  `mp` varchar(11) NOT NULL DEFAULT '',
  `usercount` int(10) NOT NULL DEFAULT '0',
  `wxusercount` int(10) NOT NULL DEFAULT '0',
  `sitename` varchar(50) NOT NULL DEFAULT '',
  `sitelogo` varchar(200) NOT NULL DEFAULT '',
  `qrcode` varchar(100) NOT NULL DEFAULT '',
  `sitetitle` varchar(60) NOT NULL DEFAULT '',
  `siteurl` varchar(100) NOT NULL DEFAULT '',
  `robotname` varchar(40) NOT NULL DEFAULT '',
  `connectouttip` varchar(50) NOT NULL DEFAULT '',
  `needcheckuser` tinyint(1) NOT NULL DEFAULT '0',
  `regneedmp` tinyint(1) NOT NULL DEFAULT '1',
  `reggid` int(10) NOT NULL DEFAULT '0',
  `regvaliddays` mediumint(4) NOT NULL DEFAULT '30',
  `qq` varchar(12) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `metades` varchar(300) NOT NULL DEFAULT '',
  `metakeywords` varchar(200) NOT NULL DEFAULT '',
  `statisticcode` varchar(300) NOT NULL DEFAULT '',
  `copyright` varchar(100) NOT NULL DEFAULT '',
  `alipayaccount` varchar(50) NOT NULL DEFAULT '',
  `alipaypid` varchar(100) NOT NULL DEFAULT '',
  `alipaykey` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(40) NOT NULL DEFAULT '',
  `salt` varchar(6) NOT NULL DEFAULT '',
  `money` int(10) NOT NULL DEFAULT '0',
  `moneybalance` int(10) NOT NULL DEFAULT '0',
  `time` int(10) NOT NULL DEFAULT '0',
  `endtime` int(11) NOT NULL DEFAULT '0',
  `lastloginip` varchar(26) NOT NULL DEFAULT '',
  `lastlogintime` int(11) NOT NULL DEFAULT '0',
  `wxacountprice` mediumint(4) NOT NULL DEFAULT '0',
  `monthprice` mediumint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_agent_expenserecords`
--

CREATE TABLE IF NOT EXISTS `wy_agent_expenserecords` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `agentid` int(10) NOT NULL DEFAULT '0',
  `amount` int(10) NOT NULL DEFAULT '0',
  `orderid` varchar(60) NOT NULL DEFAULT '',
  `des` varchar(200) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `agentid` (`agentid`,`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_agent_function`
--

CREATE TABLE IF NOT EXISTS `wy_agent_function` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` tinyint(3) NOT NULL,
  `usenum` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `funname` varchar(100) NOT NULL,
  `info` varchar(100) NOT NULL,
  `isserve` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `agentid` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `gid` (`gid`),
  KEY `agentid` (`agentid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_agent_price`
--

CREATE TABLE IF NOT EXISTS `wy_agent_price` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `agentid` int(10) NOT NULL DEFAULT '0',
  `minaccount` int(10) NOT NULL DEFAULT '0',
  `maxaccount` int(10) NOT NULL DEFAULT '0',
  `price` int(10) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `agentid` (`agentid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_api`
--

CREATE TABLE IF NOT EXISTS `wy_api` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `token` varchar(60) NOT NULL,
  `keyword` varchar(50) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `url` varchar(100) NOT NULL,
  `number` tinyint(1) NOT NULL,
  `order` tinyint(1) NOT NULL,
  `is_colation` tinyint(1) NOT NULL,
  `colation_keyword` text NOT NULL,
  `time` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `apitoken` varchar(100) NOT NULL,
  `noanswer` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_ap_authcode`
--

CREATE TABLE IF NOT EXISTS `wy_ap_authcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `authcode` int(4) DEFAULT NULL,
  `token` varchar(30) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_ap_nodes`
--

CREATE TABLE IF NOT EXISTS `wy_ap_nodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `token` varchar(30) DEFAULT NULL,
  `mac` varchar(30) DEFAULT NULL,
  `addr` varchar(30) DEFAULT NULL,
  `port` int(11) DEFAULT NULL,
  `usernum` int(11) NOT NULL,
  `deploy_status` tinyint(4) NOT NULL,
  `device_location` varchar(30) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `addtime` timestamp NULL DEFAULT NULL,
  `conntime` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_ap_policy`
--

CREATE TABLE IF NOT EXISTS `wy_ap_policy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `hotspot_whiteip` varchar(600) DEFAULT NULL,
  `forcetimeout` int(11) DEFAULT NULL,
  `timeout` int(11) DEFAULT NULL,
  `authtype` varchar(30) DEFAULT NULL,
  `hotspot_whiteurl` varchar(600) DEFAULT NULL,
  `hotspot_whitemac` varchar(255) DEFAULT NULL,
  `token` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_ap_users`
--

CREATE TABLE IF NOT EXISTS `wy_ap_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('offlline','online') DEFAULT NULL,
  `mac` varchar(30) DEFAULT NULL,
  `start` int(11) DEFAULT NULL,
  `used` int(11) DEFAULT NULL,
  `end` int(11) DEFAULT NULL,
  `apnode_id` int(11) DEFAULT NULL,
  `uiid` int(11) DEFAULT NULL,
  `uid` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `auth_type` enum('weixin','sms','sina','qq') DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `nick` varchar(30) DEFAULT NULL,
  `head` varchar(200) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `token` varchar(30) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_areply`
--

CREATE TABLE IF NOT EXISTS `wy_areply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `uid` int(11) NOT NULL,
  `uname` varchar(90) NOT NULL,
  `createtime` varchar(13) NOT NULL,
  `updatetime` varchar(13) NOT NULL,
  `token` char(30) NOT NULL,
  `home` varchar(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wy_areply`
--

INSERT INTO `wy_areply` (`id`, `keyword`, `content`, `uid`, `uname`, `createtime`, `updatetime`, `token`, `home`) VALUES
(1, '', '1.附近周边信息查询lbs\r\n2.音乐查询　音乐＋音乐名 例：音乐爱你一万年\r\n3.天气查询　城市名＋天气　例上海天气\r\n4.手机归属地查询(吉凶 运势) 手机＋手机号码　例：手机13917778912\r\n5.身份证查询　身份证＋号码　　例：身份证342423198803015568\r\n6.公交查询　公交＋城市＋公交编号　例：上海公交774\r\n7.火车查询　火车＋城市＋目的地　例火车上海南京\r\n8.翻译 支持 及时翻译，语音翻译　翻译＋关键词 例：翻译你好\r\n9.彩票查询　彩票＋彩票名 例如:彩票双色球\r\n10.周公解梦　梦见+关键词　例如:梦见父母\r\n11.聊天　直接输入聊天关键词即可\r\n12.藏头诗 藏头诗+关键词　例：藏头诗我爱你　\r\n13.笑话　直接发送笑话\r\n14.糗事　直接发送糗事\r\n15.快递 快递＋快递名＋快递号　例：快递顺丰117215889174\r\n16.健康指数查询　健康＋高，＋重　例：健康170,65\r\n17.朗读 朗读＋关键词　例：朗读多用户营销系统\r\n18.计算器 计算器使用方法　例：计算50-50　，计算100*100\r\n19.输入价格了解平台系统的价格\r\n20.输入服务了解平台系统的售后服务\r\n21.输入抽奖，即可玩幸运大抽奖\r\n22.输入会员即可填写会员资料', 1, '', '1418290990', '', '小小苏', '0');

-- --------------------------------------------------------

--
-- 表的结构 `wy_artical`
--

CREATE TABLE IF NOT EXISTS `wy_artical` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `info` varchar(5000) NOT NULL,
  `img` char(200) NOT NULL,
  `status` varchar(1) NOT NULL,
  `agentid` int(10) NOT NULL DEFAULT '0',
  `date` datetime DEFAULT NULL,
  `type` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_article`
--

CREATE TABLE IF NOT EXISTS `wy_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(90) NOT NULL,
  `description` char(255) NOT NULL,
  `author` varchar(15) NOT NULL,
  `form` varchar(30) NOT NULL,
  `updatetime` varchar(13) NOT NULL,
  `createtime` varchar(13) NOT NULL,
  `content` text NOT NULL,
  `imgs` char(40) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_attribute`
--

CREATE TABLE IF NOT EXISTS `wy_attribute` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `catid` int(10) unsigned NOT NULL COMMENT '分类ID',
  `name` varchar(100) NOT NULL COMMENT '属性名',
  `value` varchar(100) NOT NULL COMMENT '属性值',
  `cid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`,`catid`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wy_attribute`
--

INSERT INTO `wy_attribute` (`id`, `token`, `catid`, `name`, `value`, `cid`) VALUES
(1, 'ezjwzg1407237781', 12, '1', '2', 0);

-- --------------------------------------------------------

--
-- 表的结构 `wy_autumns_box`
--

CREATE TABLE IF NOT EXISTS `wy_autumns_box` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `token` varchar(50) NOT NULL,
  `bid` int(11) NOT NULL COMMENT '活动ID',
  `invite` int(11) NOT NULL,
  `boxdate` int(11) NOT NULL COMMENT '领取盒子的时间',
  `box` int(11) NOT NULL COMMENT '盒子样式',
  `wecha_id` varchar(60) NOT NULL,
  `prize` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `isprize` int(11) NOT NULL COMMENT '是否中奖',
  `isprizes` int(11) NOT NULL COMMENT '是否领奖',
  `prizedate` varchar(20) NOT NULL COMMENT '兑奖起始时间',
  `prizedates` varchar(20) NOT NULL COMMENT '兑奖结束时间',
  `lvprize` varchar(30) NOT NULL,
  `sn` varchar(13) NOT NULL,
  `sntime` int(11) NOT NULL COMMENT '奖品发放时间',
  `sendstutas` int(11) NOT NULL DEFAULT '0' COMMENT '是否发奖',
  `prtime` int(11) NOT NULL COMMENT '领奖时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_autumns_ip`
--

CREATE TABLE IF NOT EXISTS `wy_autumns_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) NOT NULL,
  `bid` int(11) NOT NULL COMMENT '盒子ID',
  `lid` int(11) NOT NULL COMMENT '活动ID',
  `token` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_autumns_open`
--

CREATE TABLE IF NOT EXISTS `wy_autumns_open` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `bid` int(11) NOT NULL COMMENT '盒子ID',
  `lid` int(11) NOT NULL COMMENT '活动ID',
  `time` int(11) NOT NULL COMMENT '分享次数',
  `isopen` int(11) NOT NULL COMMENT '是否打开',
  `wecha_id` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_baoming`
--

CREATE TABLE IF NOT EXISTS `wy_baoming` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `company` varchar(100) DEFAULT NULL,
  `info` varchar(500) DEFAULT NULL COMMENT '公司简介',
  `title` text NOT NULL,
  `jianjie` text NOT NULL,
  `tp` char(255) NOT NULL,
  `logo` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_baoming_list`
--

CREATE TABLE IF NOT EXISTS `wy_baoming_list` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `zhuti` varchar(100) NOT NULL,
  `feiyong` text,
  `time` text,
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `banner` varchar(200) NOT NULL,
  `info` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_baoming_order`
--

CREATE TABLE IF NOT EXISTS `wy_baoming_order` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `token` varchar(64) NOT NULL,
  `wecha_id` varchar(64) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `weixin` varchar(100) NOT NULL,
  `beizhu` text NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_behavior`
--

CREATE TABLE IF NOT EXISTS `wy_behavior` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL,
  `token` varchar(60) NOT NULL,
  `openid` varchar(60) NOT NULL,
  `date` varchar(11) NOT NULL,
  `enddate` int(11) NOT NULL,
  `model` varchar(60) NOT NULL,
  `num` int(11) NOT NULL,
  `keyword` varchar(60) NOT NULL,
  `type` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `openid` (`openid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=487 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_canyu`
--

CREATE TABLE IF NOT EXISTS `wy_canyu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `xid` int(11) NOT NULL,
  `wecha_id` varchar(60) NOT NULL,
  `token` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `number` int(11) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_car`
--

CREATE TABLE IF NOT EXISTS `wy_car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `www` varchar(50) NOT NULL DEFAULT '',
  `logo` varchar(200) NOT NULL DEFAULT '',
  `sort` int(11) DEFAULT NULL,
  `info` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_carmodel`
--

CREATE TABLE IF NOT EXISTS `wy_carmodel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `brand_serise` varchar(50) NOT NULL,
  `model_year` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `panorama_id` int(11) NOT NULL,
  `guide_price` decimal(10,3) NOT NULL,
  `dealer_price` decimal(10,3) NOT NULL,
  `emission` double NOT NULL,
  `stalls` tinyint(4) NOT NULL,
  `box` tinyint(4) NOT NULL,
  `pic_url` varchar(200) NOT NULL,
  `s_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_carnews`
--

CREATE TABLE IF NOT EXISTS `wy_carnews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `news_id` int(11) NOT NULL,
  `pre_id` int(11) NOT NULL,
  `usedcar_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_carowner`
--

CREATE TABLE IF NOT EXISTS `wy_carowner` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `keyword` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT '''''',
  `head_url` varchar(200) NOT NULL DEFAULT '''''',
  `info` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_carsaler`
--

CREATE TABLE IF NOT EXISTS `wy_carsaler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `mobile` char(13) NOT NULL,
  `sort` tinyint(4) NOT NULL,
  `salestype` tinyint(4) NOT NULL,
  `info` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_carseries`
--

CREATE TABLE IF NOT EXISTS `wy_carseries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `shortname` varchar(50) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `sort` int(11) NOT NULL,
  `info` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_carset`
--

CREATE TABLE IF NOT EXISTS `wy_carset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `keyword` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT '',
  `head_url` varchar(200) NOT NULL DEFAULT '',
  `url` varchar(200) NOT NULL,
  `title1` varchar(50) NOT NULL DEFAULT '',
  `title2` varchar(50) NOT NULL DEFAULT '',
  `title3` varchar(50) NOT NULL DEFAULT '',
  `title4` varchar(50) NOT NULL DEFAULT '',
  `title5` varchar(50) NOT NULL DEFAULT '',
  `title6` varchar(50) NOT NULL DEFAULT '',
  `head_url_1` varchar(200) NOT NULL DEFAULT '',
  `head_url_2` varchar(200) NOT NULL DEFAULT '',
  `head_url_3` varchar(200) NOT NULL DEFAULT '',
  `head_url_4` varchar(200) NOT NULL DEFAULT '',
  `head_url_5` varchar(200) NOT NULL DEFAULT '',
  `head_url_6` varchar(200) NOT NULL DEFAULT '',
  `url1` varchar(200) NOT NULL DEFAULT '',
  `url2` varchar(200) NOT NULL DEFAULT '',
  `url3` varchar(200) NOT NULL DEFAULT '',
  `url4` varchar(200) NOT NULL DEFAULT '',
  `url5` varchar(200) NOT NULL DEFAULT '',
  `url6` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_caruser`
--

CREATE TABLE IF NOT EXISTS `wy_caruser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `wecha_id` varchar(50) NOT NULL,
  `brand_serise` varchar(50) NOT NULL,
  `car_no` varchar(20) NOT NULL,
  `car_userName` varchar(50) NOT NULL,
  `car_startTime` varchar(50) NOT NULL,
  `car_insurance_lastDate` varchar(50) NOT NULL,
  `car_insurance_lastCost` decimal(10,2) NOT NULL,
  `car_care_mileage` int(11) NOT NULL,
  `user_tel` char(11) NOT NULL,
  `car_care_lastDate` varchar(50) NOT NULL,
  `car_care_lastCost` decimal(10,2) NOT NULL,
  `kfinfo` varchar(200) NOT NULL DEFAULT '',
  `insurance_Date` varchar(50) DEFAULT NULL,
  `insurance_Cost` decimal(10,2) DEFAULT NULL,
  `care_mileage` int(11) DEFAULT NULL,
  `car_care_Date` varchar(50) DEFAULT NULL,
  `car_care_Cost` decimal(10,2) DEFAULT NULL,
  `car_buyTime` varchar(50) NOT NULL DEFAULT '',
  `car_care_inspection` varchar(50) NOT NULL DEFAULT '',
  `care_next_mileage` int(11) NOT NULL DEFAULT '0',
  `next_care_inspection` varchar(50) NOT NULL DEFAULT '',
  `next_insurance_Date` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_car_utility`
--

CREATE TABLE IF NOT EXISTS `wy_car_utility` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `wy_car_utility`
--

INSERT INTO `wy_car_utility` (`id`, `name`, `url`, `status`) VALUES
(1, '车贷计算器', 'http://car.m.yiche.com/qichedaikuanjisuanqi/', 1),
(2, '保险计算', 'http://car.m.yiche.com/qichebaoxianjisuan/', 1),
(3, '全款计算', 'http://car.m.yiche.com/gouchejisuanqi/', 1),
(4, '车型比较', 'http://car.m.yiche.com/chexingduibi/?carIDs=102501', 1),
(5, '违章查询', 'http://wap.bjjtgl.gov.cn/wimframework/portal/wwwroot/bjjgj/xxcx.psml?contentType=%E8%BF%9D%E6%B3%95%', 1);

-- --------------------------------------------------------

--
-- 表的结构 `wy_case`
--

CREATE TABLE IF NOT EXISTS `wy_case` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `url` char(255) NOT NULL,
  `img` char(200) NOT NULL,
  `status` varchar(1) NOT NULL,
  `agentid` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_catemenu`
--

CREATE TABLE IF NOT EXISTS `wy_catemenu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fid` int(10) NOT NULL DEFAULT '0',
  `token` varchar(60) NOT NULL,
  `name` varchar(120) NOT NULL,
  `orderss` varchar(10) NOT NULL DEFAULT '0',
  `picurl` varchar(120) NOT NULL,
  `url` varchar(200) NOT NULL DEFAULT '0',
  `status` varchar(10) NOT NULL,
  `RadioGroup1` varchar(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_classify`
--

CREATE TABLE IF NOT EXISTS `wy_classify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `info` varchar(90) NOT NULL COMMENT '分类描述',
  `sorts` varchar(6) NOT NULL COMMENT '显示顺序',
  `img` char(255) NOT NULL,
  `url` char(255) NOT NULL,
  `status` varchar(1) NOT NULL,
  `token` varchar(30) NOT NULL,
  `icon` char(200) NOT NULL,
  `yanse` char(100) NOT NULL,
  `nameyanse` char(20) NOT NULL,
  `fid` int(11) NOT NULL DEFAULT '0',
  `path` varchar(3000) NOT NULL,
  `tpid` int(4) NOT NULL,
  `conttpid` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_company`
--

CREATE TABLE IF NOT EXISTS `wy_company` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `shortname` varchar(50) NOT NULL DEFAULT '',
  `mp` varchar(11) NOT NULL DEFAULT '',
  `tel` varchar(20) NOT NULL DEFAULT '',
  `address` varchar(200) NOT NULL DEFAULT '',
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `intro` text NOT NULL,
  `catid` mediumint(3) NOT NULL DEFAULT '0',
  `taxis` int(10) NOT NULL DEFAULT '0',
  `isbranch` tinyint(1) NOT NULL DEFAULT '0',
  `logourl` varchar(180) NOT NULL DEFAULT '',
  `area_id` int(11) DEFAULT NULL,
  `cate_id` int(11) DEFAULT NULL,
  `market_id` int(11) DEFAULT NULL,
  `mark_url` varchar(200) DEFAULT NULL,
  `add_time` char(10) DEFAULT NULL,
  `display` tinyint(1) DEFAULT '0',
  `username` varchar(60) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `site_url` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_company_staff`
--

CREATE TABLE IF NOT EXISTS `wy_company_staff` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `companyid` int(10) NOT NULL,
  `token` varchar(30) NOT NULL DEFAULT '',
  `name` varchar(30) NOT NULL DEFAULT '',
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(40) NOT NULL DEFAULT '',
  `tel` varchar(11) NOT NULL DEFAULT '',
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `companyid` (`companyid`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_dati`
--

CREATE TABLE IF NOT EXISTS `wy_dati` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL COMMENT '题目标题',
  `picurl` varchar(200) DEFAULT NULL COMMENT '图片地址',
  `info` varchar(300) DEFAULT NULL COMMENT '图文简介',
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 选择题 1 简答题 2 看图猜',
  `daan` varchar(200) NOT NULL COMMENT '答案',
  `score` int(11) NOT NULL DEFAULT '0' COMMENT '回答完全正确积分',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_dati_record`
--

CREATE TABLE IF NOT EXISTS `wy_dati_record` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(200) NOT NULL COMMENT 'token',
  `wecha_id` varchar(200) NOT NULL,
  `score` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `playtime` int(15) DEFAULT NULL COMMENT '第一次玩的时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_dianying`
--

CREATE TABLE IF NOT EXISTS `wy_dianying` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(31) NOT NULL,
  `title` varchar(100) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `picurl` varchar(200) NOT NULL,
  `name` varchar(100) NOT NULL,
  `toppicurl` varchar(200) NOT NULL,
  `roompicurl` varchar(200) NOT NULL,
  `address` varchar(500) NOT NULL,
  `lat` varchar(30) NOT NULL,
  `lng` varchar(30) NOT NULL,
  `contentt` varchar(2000) NOT NULL,
  `xmcontent` varchar(2000) NOT NULL,
  `jtcontent` varchar(2000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_dianyingcom`
--

CREATE TABLE IF NOT EXISTS `wy_dianyingcom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(31) NOT NULL,
  `title` varchar(100) NOT NULL,
  `sort` varchar(3) NOT NULL,
  `name` varchar(100) NOT NULL,
  `zw` varchar(100) NOT NULL,
  `picurl` varchar(200) NOT NULL,
  `contentt` varchar(2000) NOT NULL,
  `dpcontent` varchar(2000) NOT NULL,
  `subestatename` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_dianyingphoto`
--

CREATE TABLE IF NOT EXISTS `wy_dianyingphoto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(31) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sort` varchar(3) NOT NULL,
  `contentt` varchar(2000) NOT NULL,
  `picurl` varchar(200) NOT NULL,
  `namephoto` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_dianyingposter`
--

CREATE TABLE IF NOT EXISTS `wy_dianyingposter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(31) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `picurl` varchar(200) NOT NULL,
  `status` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `picurl1` varchar(100) NOT NULL,
  `picurl2` varchar(200) NOT NULL,
  `picurl3` varchar(200) NOT NULL,
  `picurl4` varchar(200) NOT NULL,
  `subestatename` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_dianyingsub`
--

CREATE TABLE IF NOT EXISTS `wy_dianyingsub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `token` varchar(31) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sort` varchar(3) NOT NULL,
  `contentt` varchar(2000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_dianyingunits`
--

CREATE TABLE IF NOT EXISTS `wy_dianyingunits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(31) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sub` varchar(30) NOT NULL,
  `lc` varchar(30) NOT NULL,
  `area` varchar(50) NOT NULL,
  `shi` varchar(30) NOT NULL,
  `ting` varchar(100) NOT NULL,
  `sort` varchar(3) NOT NULL,
  `contentt` varchar(2000) NOT NULL,
  `picurl` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_diaoyan`
--

CREATE TABLE IF NOT EXISTS `wy_diaoyan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `stime` date DEFAULT NULL,
  `etime` date DEFAULT NULL,
  `stat` tinyint(2) DEFAULT '0',
  `pic` varchar(200) DEFAULT NULL,
  `sinfo` varchar(500) DEFAULT NULL,
  `einfo` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_diaoyan_timu`
--

CREATE TABLE IF NOT EXISTS `wy_diaoyan_timu` (
  `tid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `optia` varchar(200) DEFAULT NULL,
  `optib` varchar(200) DEFAULT NULL,
  `optic` varchar(200) DEFAULT NULL,
  `optid` varchar(200) DEFAULT NULL,
  `optie` varchar(200) DEFAULT NULL,
  `max` smallint(2) DEFAULT NULL,
  `pid` int(11) NOT NULL,
  `perca` int(11) DEFAULT '0',
  `percb` int(11) DEFAULT '0',
  `percc` int(11) DEFAULT '0',
  `percd` int(11) DEFAULT '0',
  `perce` int(11) DEFAULT '0',
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_diaoyan_user`
--

CREATE TABLE IF NOT EXISTS `wy_diaoyan_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `diaoyan_id` int(11) DEFAULT NULL,
  `wecha_id` varchar(100) DEFAULT NULL,
  `qid` int(11) DEFAULT NULL,
  `ans` varchar(20) DEFAULT NULL,
  `jianyi` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_dining`
--

CREATE TABLE IF NOT EXISTS `wy_dining` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `catid` mediumint(4) NOT NULL DEFAULT '0',
  `storeid` mediumint(4) NOT NULL DEFAULT '0',
  `name` varchar(150) NOT NULL DEFAULT '',
  `price` float NOT NULL DEFAULT '0',
  `oprice` float NOT NULL DEFAULT '0',
  `discount` float NOT NULL DEFAULT '10',
  `intro` text NOT NULL,
  `token` varchar(50) NOT NULL,
  `keyword` varchar(100) NOT NULL DEFAULT '',
  `salecount` mediumint(4) NOT NULL DEFAULT '0',
  `logourl` varchar(150) NOT NULL DEFAULT '',
  `dining` tinyint(1) NOT NULL DEFAULT '0',
  `groupon` tinyint(1) NOT NULL DEFAULT '0',
  `endtime` int(10) NOT NULL DEFAULT '0',
  `fakemembercount` mediumint(4) NOT NULL DEFAULT '0',
  `time` int(10) NOT NULL DEFAULT '0',
  `unit` varchar(10) NOT NULL DEFAULT '盘',
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`,`storeid`),
  KEY `catid_2` (`catid`),
  KEY `storeid` (`storeid`),
  KEY `token` (`token`),
  KEY `price` (`price`),
  KEY `oprice` (`oprice`),
  KEY `discount` (`discount`),
  KEY `dining` (`dining`),
  KEY `groupon` (`groupon`,`endtime`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_dining_cat`
--

CREATE TABLE IF NOT EXISTS `wy_dining_cat` (
  `id` mediumint(4) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL,
  `des` varchar(500) NOT NULL DEFAULT '',
  `parentid` mediumint(4) NOT NULL,
  `logourl` varchar(100) NOT NULL,
  `dining` tinyint(1) NOT NULL DEFAULT '0',
  `time` int(10) NOT NULL,
  `storeid` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parentid` (`parentid`),
  KEY `token` (`token`),
  KEY `dining` (`dining`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_dining_company`
--

CREATE TABLE IF NOT EXISTS `wy_dining_company` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL DEFAULT '',
  `catid` mediumint(3) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL COMMENT '店铺状态',
  `category` varchar(10) NOT NULL COMMENT '店铺分类',
  `time` varchar(12) NOT NULL COMMENT '营业时间',
  `money` double(10,2) NOT NULL COMMENT '起送价格',
  `radius` varchar(10) NOT NULL COMMENT '服务半径',
  `scope` varchar(100) NOT NULL COMMENT '配送范围',
  `bulletin` text NOT NULL COMMENT '店铺公告',
  `memberCode` varchar(50) NOT NULL,
  `feiyin_key` varchar(50) NOT NULL,
  `deviceNo` varchar(20) NOT NULL,
  `print_status` int(1) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_status` int(1) NOT NULL,
  `email_status` int(1) NOT NULL,
  `bwdeviceNo` varchar(20) NOT NULL,
  `printpage` int(2) NOT NULL DEFAULT '1',
  `printtype` varchar(10) NOT NULL,
  `payonline` int(1) NOT NULL DEFAULT '0',
  `lydeviceNo` varchar(20) NOT NULL,
  `pringNum` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_dining_diningtable`
--

CREATE TABLE IF NOT EXISTS `wy_dining_diningtable` (
  `id` mediumint(4) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(60) NOT NULL DEFAULT '',
  `intro` varchar(500) NOT NULL DEFAULT '',
  `taxis` mediumint(4) NOT NULL DEFAULT '0',
  `storeid` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_dining_table`
--

CREATE TABLE IF NOT EXISTS `wy_dining_table` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `num` int(10) unsigned NOT NULL,
  `image` varchar(200) NOT NULL,
  `isbox` tinyint(1) unsigned NOT NULL,
  `isorder` tinyint(1) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`),
  KEY `isbox` (`isbox`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_dish`
--

CREATE TABLE IF NOT EXISTS `wy_dish` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `sid` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `unit` varchar(3) NOT NULL,
  `price` float NOT NULL,
  `ishot` tinyint(1) unsigned NOT NULL,
  `isopen` tinyint(1) unsigned NOT NULL,
  `image` varchar(200) NOT NULL COMMENT '片',
  `des` varchar(500) NOT NULL,
  `creattime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`),
  KEY `sid` (`sid`),
  KEY `isopen` (`isopen`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_dish_company`
--

CREATE TABLE IF NOT EXISTS `wy_dish_company` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(10) unsigned NOT NULL,
  `istakeaway` tinyint(1) unsigned NOT NULL,
  `price` float NOT NULL,
  `payonline` tinyint(1) unsigned NOT NULL,
  `phone` varchar(20) NOT NULL,
  `phone_status` int(1) NOT NULL,
  `email` varchar(20) NOT NULL,
  `email_status` int(1) NOT NULL,
  `printtype` varchar(10) NOT NULL,
  `printpage` int(2) NOT NULL,
  `deviceNo` varchar(20) NOT NULL,
  `bwdeviceNo` varchar(20) NOT NULL,
  `memberCode` varchar(32) NOT NULL,
  `feiyin_key` varchar(32) NOT NULL,
  `pringNum` int(1) NOT NULL,
  `print_status` int(1) NOT NULL,
  `lydeviceNo2` varchar(20) DEFAULT NULL,
  `deviceNo2` varchar(20) DEFAULT NULL,
  `lydeviceNo1` varchar(20) DEFAULT NULL,
  `deviceNo1` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_dish_like`
--

CREATE TABLE IF NOT EXISTS `wy_dish_like` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `did` int(10) unsigned NOT NULL,
  `cid` int(10) unsigned NOT NULL,
  `wecha_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`),
  KEY `wecha_id` (`wecha_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_dish_order`
--

CREATE TABLE IF NOT EXISTS `wy_dish_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(10) unsigned NOT NULL,
  `wecha_id` varchar(100) NOT NULL,
  `token` varchar(50) NOT NULL,
  `total` int(11) NOT NULL,
  `price` float NOT NULL,
  `nums` smallint(3) unsigned NOT NULL,
  `info` text NOT NULL,
  `name` varchar(100) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `tel` varchar(13) NOT NULL,
  `address` varchar(200) NOT NULL,
  `tableid` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `reservetime` int(11) NOT NULL,
  `isuse` tinyint(1) NOT NULL,
  `paid` tinyint(1) unsigned NOT NULL,
  `orderid` varchar(100) NOT NULL,
  `printed` tinyint(1) unsigned NOT NULL,
  `des` varchar(500) NOT NULL,
  `takeaway` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`,`wecha_id`),
  KEY `token` (`token`),
  KEY `orderid` (`orderid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_dish_sort`
--

CREATE TABLE IF NOT EXISTS `wy_dish_sort` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `des` varchar(500) NOT NULL,
  `image` varchar(200) NOT NULL,
  `num` smallint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_dish_table`
--

CREATE TABLE IF NOT EXISTS `wy_dish_table` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(10) unsigned NOT NULL,
  `tableid` int(10) unsigned NOT NULL,
  `wecha_id` varchar(50) NOT NULL,
  `reservetime` int(10) unsigned NOT NULL,
  `creattime` int(10) unsigned NOT NULL,
  `orderid` int(10) unsigned NOT NULL,
  `isuse` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`),
  KEY `wecha_id` (`wecha_id`,`reservetime`),
  KEY `tableid` (`tableid`),
  KEY `orderid` (`orderid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_diymen_class`
--

CREATE TABLE IF NOT EXISTS `wy_diymen_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `pid` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `keyword` varchar(30) NOT NULL,
  `url` varchar(250) NOT NULL,
  `is_show` tinyint(1) NOT NULL,
  `sort` tinyint(3) NOT NULL,
  `emoji_code` varchar(16) NOT NULL,
  `wxsys` char(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_diymen_set`
--

CREATE TABLE IF NOT EXISTS `wy_diymen_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `appid` varchar(18) NOT NULL,
  `appsecret` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_dream`
--

CREATE TABLE IF NOT EXISTS `wy_dream` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `content` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_estate`
--

CREATE TABLE IF NOT EXISTS `wy_estate` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `title` varchar(50) NOT NULL,
  `keyword` varchar(50) NOT NULL,
  `matchtype` tinyint(11) NOT NULL,
  `cover` varchar(200) NOT NULL,
  `panorama_id` int(11) NOT NULL,
  `classify_id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `banner` varchar(200) NOT NULL,
  `banner2` varchar(200) NOT NULL,
  `banner3` varchar(200) NOT NULL,
  `banner4` varchar(200) NOT NULL,
  `banner5` varchar(200) NOT NULL,
  `house_banner` varchar(200) NOT NULL,
  `place` varchar(300) NOT NULL,
  `lng` varchar(15) NOT NULL,
  `lat` varchar(15) NOT NULL,
  `estate_desc` text NOT NULL,
  `project_brief` text NOT NULL,
  `traffic_desc` text NOT NULL,
  `thetype` varchar(30) NOT NULL,
  `tel` bigint(12) NOT NULL,
  `phone` varchar(20) NOT NULL COMMENT ' 手机',
  `email` varchar(255) NOT NULL COMMENT ' 邮箱',
  `video` varchar(255) NOT NULL,
  `estate_name` varchar(30) NOT NULL,
  `project_name` varchar(30) NOT NULL,
  `diy_name` varchar(30) NOT NULL,
  `diy_desc` text NOT NULL,
  `path` varchar(3000) NOT NULL,
  `tpid` varchar(10) NOT NULL DEFAULT '1' COMMENT '默认首页模版ID',
  `conttpid` tinyint(4) NOT NULL,
  `menu1` varchar(50) NOT NULL,
  `menu2` varchar(50) NOT NULL,
  `menu3` varchar(50) NOT NULL,
  `menu4` varchar(50) NOT NULL,
  `menu5` varchar(50) NOT NULL,
  `menu6` varchar(50) NOT NULL,
  `menu7` varchar(50) NOT NULL,
  `menu8` varchar(50) NOT NULL,
  `picurl1` varchar(500) NOT NULL,
  `picurl2` varchar(500) NOT NULL,
  `picurl3` varchar(500) NOT NULL,
  `picurl4` varchar(500) NOT NULL,
  `picurl5` varchar(500) NOT NULL,
  `picurl6` varchar(500) NOT NULL,
  `picurl7` varchar(500) NOT NULL,
  `picurl8` varchar(500) NOT NULL,
  `www` varchar(10) NOT NULL DEFAULT '1' COMMENT '222222ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `token_2` (`token`),
  FULLTEXT KEY `token` (`token`),
  FULLTEXT KEY `title` (`title`),
  FULLTEXT KEY `keyword` (`keyword`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_estate_album`
--

CREATE TABLE IF NOT EXISTS `wy_estate_album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `poid` int(11) NOT NULL,
  `token` varchar(50) NOT NULL,
  `thetype` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_estate_expert`
--

CREATE TABLE IF NOT EXISTS `wy_estate_expert` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `token` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `sort` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `face` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `thetype` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_estate_housetype`
--

CREATE TABLE IF NOT EXISTS `wy_estate_housetype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `panorama_id` int(10) NOT NULL DEFAULT '0',
  `son_id` int(11) NOT NULL,
  `token` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `floor_num` varchar(20) NOT NULL,
  `area` varchar(50) NOT NULL,
  `fang` int(11) NOT NULL,
  `ting` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `abid` varchar(200) NOT NULL,
  `type1` varchar(200) NOT NULL,
  `type2` varchar(200) NOT NULL,
  `type3` varchar(200) NOT NULL,
  `type4` varchar(200) NOT NULL,
  `thetype` varchar(30) NOT NULL,
  `poid` int(11) NOT NULL,
  `tmpl_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_estate_housetype_360`
--

CREATE TABLE IF NOT EXISTS `wy_estate_housetype_360` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `panorama_id` int(11) NOT NULL,
  `floor` varchar(60) DEFAULT NULL,
  `house` varchar(60) DEFAULT NULL,
  `orderid` int(11) NOT NULL DEFAULT '0',
  `housetype_id` int(11) NOT NULL,
  `token` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_estate_impress`
--

CREATE TABLE IF NOT EXISTS `wy_estate_impress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `sort` int(11) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `is_show` int(11) NOT NULL,
  `thetype` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_estate_impress_add`
--

CREATE TABLE IF NOT EXISTS `wy_estate_impress_add` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imp_id` int(11) NOT NULL,
  `token` varchar(50) NOT NULL,
  `wecha_id` varchar(50) NOT NULL,
  `thetype` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_estate_room_redirect`
--

CREATE TABLE IF NOT EXISTS `wy_estate_room_redirect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `housetype_id` int(11) NOT NULL,
  `token` varchar(60) NOT NULL,
  `src_360_id` int(11) NOT NULL,
  `target_360_id` int(11) NOT NULL,
  `show_pic` varchar(200) NOT NULL,
  `location` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_estate_saler`
--

CREATE TABLE IF NOT EXISTS `wy_estate_saler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `mobile` char(13) NOT NULL,
  `sort` tinyint(4) NOT NULL,
  `salestype` tinyint(4) NOT NULL,
  `info` varchar(200) NOT NULL,
  `sms_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_estate_son`
--

CREATE TABLE IF NOT EXISTS `wy_estate_son` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `token` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `sort` tinyint(4) NOT NULL,
  `description` varchar(200) NOT NULL,
  `thetype` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_fang`
--

CREATE TABLE IF NOT EXISTS `wy_fang` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `topic` varchar(200) DEFAULT NULL,
  `lou_top_topic` varchar(200) DEFAULT NULL,
  `hu_top_topic` varchar(200) DEFAULT NULL COMMENT '户型头部图片',
  `lou_info` varchar(500) DEFAULT NULL COMMENT '楼盘简介',
  `hu_info` varchar(500) DEFAULT NULL COMMENT '项目简介',
  `jiao_info` varchar(500) DEFAULT NULL COMMENT '交通配套',
  `slide1` varchar(100) DEFAULT NULL,
  `slide2` varchar(100) DEFAULT NULL,
  `slide3` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_fangchan`
--

CREATE TABLE IF NOT EXISTS `wy_fangchan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `type` varchar(200) DEFAULT NULL,
  `houseType` varchar(200) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` varchar(5000) NOT NULL,
  `contacter` varchar(255) NOT NULL,
  `phone` char(11) NOT NULL,
  `valid_date` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `click` int(11) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `wecha_id` varchar(200) NOT NULL,
  `area` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_fangchan_reply`
--

CREATE TABLE IF NOT EXISTS `wy_fangchan_reply` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `info` varchar(500) DEFAULT NULL COMMENT '公司简介',
  `title` text NOT NULL,
  `tp` char(255) NOT NULL,
  `copyright` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_fang_dianping`
--

CREATE TABLE IF NOT EXISTS `wy_fang_dianping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `show_order` int(5) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `job` varchar(100) DEFAULT NULL,
  `topic` varchar(100) DEFAULT NULL,
  `info` varchar(300) DEFAULT NULL,
  `dianping` text,
  `pid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_fang_effect`
--

CREATE TABLE IF NOT EXISTS `wy_fang_effect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `show_order` int(5) DEFAULT NULL,
  `effect` int(10) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `show` int(1) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_fang_hu`
--

CREATE TABLE IF NOT EXISTS `wy_fang_hu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `area` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `fang_zi` varchar(100) DEFAULT NULL,
  `louceng` int(5) DEFAULT NULL,
  `show_order` int(10) DEFAULT NULL,
  `fang` varchar(5) DEFAULT NULL,
  `ting` varchar(5) DEFAULT NULL,
  `info` varchar(500) DEFAULT NULL,
  `topic1` varchar(100) DEFAULT NULL,
  `topic2` varchar(100) DEFAULT NULL,
  `topic3` varchar(100) DEFAULT NULL,
  `topic4` varchar(100) DEFAULT NULL,
  `topic5` varchar(100) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_fang_photo`
--

CREATE TABLE IF NOT EXISTS `wy_fang_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `show_order` int(5) DEFAULT NULL,
  `info` varchar(500) DEFAULT NULL,
  `topic1` varchar(100) DEFAULT NULL,
  `topic2` varchar(100) DEFAULT NULL,
  `topic3` varchar(100) DEFAULT NULL,
  `topic4` varchar(100) DEFAULT NULL,
  `topic5` varchar(100) DEFAULT NULL,
  `topic6` varchar(100) DEFAULT NULL,
  `topic7` varchar(100) DEFAULT NULL,
  `topic8` varchar(100) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_fang_zi`
--

CREATE TABLE IF NOT EXISTS `wy_fang_zi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `show_order` int(10) DEFAULT NULL,
  `info` varchar(500) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_fanyan`
--

CREATE TABLE IF NOT EXISTS `wy_fanyan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `timu` text NOT NULL,
  `answer1` text NOT NULL,
  `answer2` text NOT NULL,
  `answer3` text NOT NULL,
  `answer4` text NOT NULL,
  `score1` text NOT NULL,
  `score2` text NOT NULL,
  `score3` text NOT NULL,
  `score4` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_fanyan_reply`
--

CREATE TABLE IF NOT EXISTS `wy_fanyan_reply` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `info` varchar(500) DEFAULT NULL COMMENT '公司简介',
  `title` text NOT NULL,
  `tp` char(255) NOT NULL,
  `copyright` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `scorename` text NOT NULL,
  `tip1` text NOT NULL,
  `tip2` text NOT NULL,
  `tip3` text NOT NULL,
  `tip4` text NOT NULL,
  `tip5` text NOT NULL,
  `tip6` text NOT NULL,
  `tip7` text NOT NULL,
  `tip8` text NOT NULL,
  `gz` varchar(500) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_fanyan_setcin`
--

CREATE TABLE IF NOT EXISTS `wy_fanyan_setcin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `info` text,
  `tel` varchar(11) DEFAULT NULL,
  `messages` text,
  `banner` varchar(100) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `lng` varchar(30) NOT NULL,
  `lat` varchar(30) NOT NULL,
  `picurl1` varchar(100) NOT NULL,
  `picurl2` varchar(100) NOT NULL,
  `picurl3` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_fenlei`
--

CREATE TABLE IF NOT EXISTS `wy_fenlei` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `topic` varchar(200) DEFAULT NULL,
  `info` varchar(500) DEFAULT NULL,
  `sort` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_fenlei_flash`
--

CREATE TABLE IF NOT EXISTS `wy_fenlei_flash` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `picurl1` char(255) NOT NULL,
  `picurl2` char(255) NOT NULL,
  `picurl3` char(255) NOT NULL,
  `picurl4` char(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_fenlei_reply`
--

CREATE TABLE IF NOT EXISTS `wy_fenlei_reply` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `info` varchar(500) DEFAULT NULL COMMENT '公司简介',
  `title` text NOT NULL,
  `tp` char(255) NOT NULL,
  `copyright` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_fenlei_setcin`
--

CREATE TABLE IF NOT EXISTS `wy_fenlei_setcin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `info` text,
  `tel` varchar(11) DEFAULT NULL,
  `messages` text,
  `banner` varchar(100) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `lng` varchar(30) NOT NULL,
  `lat` varchar(30) NOT NULL,
  `picurl1` varchar(100) NOT NULL,
  `picurl2` varchar(100) NOT NULL,
  `picurl3` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_files`
--

CREATE TABLE IF NOT EXISTS `wy_files` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `token` varchar(30) NOT NULL DEFAULT '',
  `url` varchar(200) NOT NULL DEFAULT '',
  `size` int(10) NOT NULL DEFAULT '0',
  `type` varchar(20) NOT NULL DEFAULT '',
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=98 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_flash`
--

CREATE TABLE IF NOT EXISTS `wy_flash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `img` char(255) NOT NULL,
  `url` char(255) NOT NULL,
  `info` varchar(90) NOT NULL,
  `tip` smallint(2) NOT NULL,
  `fid` int(5) NOT NULL DEFAULT '0',
  `did` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_follow`
--

CREATE TABLE IF NOT EXISTS `wy_follow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `follow_form_id` varchar(100) NOT NULL,
  `follow_to_id` varchar(100) NOT NULL,
  `follow_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=162 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_forum_comment`
--

CREATE TABLE IF NOT EXISTS `wy_forum_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `uid` varchar(50) DEFAULT NULL,
  `uname` varchar(50) DEFAULT NULL,
  `content` varchar(3000) NOT NULL,
  `createtime` int(11) NOT NULL,
  `favourid` varchar(3000) DEFAULT NULL,
  `replyid` varchar(3000) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `token` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_forum_config`
--

CREATE TABLE IF NOT EXISTS `wy_forum_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bgurl` varchar(200) NOT NULL DEFAULT '',
  `picurl` varchar(200) NOT NULL DEFAULT '',
  `comcheck` varchar(4) NOT NULL DEFAULT '',
  `intro` varchar(600) NOT NULL DEFAULT '',
  `ischeck` tinyint(4) NOT NULL DEFAULT '0',
  `pv` float NOT NULL DEFAULT '0',
  `forumname` char(60) DEFAULT NULL,
  `logo` varchar(200) DEFAULT NULL,
  `token` varchar(50) NOT NULL,
  `isopen` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_forum_message`
--

CREATE TABLE IF NOT EXISTS `wy_forum_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(3000) NOT NULL,
  `createtime` int(11) NOT NULL,
  `fromuid` varchar(50) NOT NULL,
  `touid` varchar(40) NOT NULL,
  `fromuname` varchar(60) DEFAULT NULL,
  `touname` varchar(60) DEFAULT NULL,
  `tid` int(11) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `isread` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_forum_topics`
--

CREATE TABLE IF NOT EXISTS `wy_forum_topics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(300) NOT NULL,
  `content` varchar(1500) NOT NULL,
  `likeid` varchar(3000) DEFAULT NULL,
  `commentid` varchar(3000) DEFAULT NULL,
  `favourid` varchar(3000) DEFAULT NULL,
  `createtime` int(11) NOT NULL,
  `updatetime` int(11) DEFAULT NULL,
  `uid` varchar(50) DEFAULT NULL,
  `uname` varchar(50) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `photos` varchar(300) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_function`
--

CREATE TABLE IF NOT EXISTS `wy_function` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` tinyint(3) NOT NULL,
  `usenum` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `funname` varchar(100) NOT NULL,
  `info` varchar(100) NOT NULL,
  `isserve` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gid` (`gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=75 ;

--
-- 转存表中的数据 `wy_function`
--

INSERT INTO `wy_function` (`id`, `gid`, `usenum`, `name`, `funname`, `info`, `isserve`, `status`) VALUES
(3, 1, 0, '计算器', 'jishuan', '计算器使用方法　例：计算50-50　，计算100*100', 1, 1),
(4, 4, 0, '朗读', 'langdu', '朗读＋关键词　例：朗读lanrain多用户营销系统', 1, 1),
(5, 3, 0, '健康指数查询', 'jiankang', '健康指数查询　健康＋高，＋重　例：健康170,65', 1, 1),
(6, 1, 0, '快递查询', 'kuaidi', '快递＋快递名＋快递号　例：快递顺丰117215889174', 1, 1),
(7, 1, 0, '笑话', 'xiaohua', '笑话　直接发送笑话', 1, 1),
(8, 2, 0, '藏头诗', 'changtoushi', ' 藏头诗+关键词　例：藏头诗我爱你', 1, 1),
(9, 1, 0, '陪聊', 'peiliao', '聊天　直接输入聊天关键词即可', 1, 1),
(10, 1, 0, '聊天', 'liaotian', '聊天　直接输入聊天关键词即可', 1, 1),
(11, 3, 0, '周公解梦', 'mengjian', '周公解梦　梦见+关键词　例如:梦见父母', 1, 1),
(12, 2, 0, '语音翻译', 'yuyinfanyi', '翻译＋关键词 例：翻译你好', 1, 1),
(13, 2, 0, '火车查询', 'huoche', '火车查询　火车＋城市＋目的地　例火车上海南京', 1, 1),
(14, 2, 0, '公交查询', 'gongjiao', '公交＋城市＋公交编号　例：上海公交774', 1, 1),
(15, 2, 0, '身份证查询', 'shenfenzheng', '身份证＋号码　　例：身份证342423198803015568', 1, 1),
(16, 1, 0, '手机归属地查询', 'shouji', '手机归属地查询(吉凶 运势) 手机＋手机号码　例：手机13917778912', 1, 1),
(17, 3, 0, '音乐查询', 'yinle', '音乐＋音乐名  例：音乐爱你一万年', 1, 1),
(18, 1, 0, '附近周边信息查询', 'fujin', '附近周边信息查询(ＬＢＳ）', 1, 1),
(19, 4, 0, '幸运大转盘', 'choujiang', '输入抽奖　即可参加幸运大转盘抽奖活动', 2, 1),
(20, 3, 0, '淘宝店铺', 'taobao', '输入淘宝＋关键词　即可访问淘宝3g手机店铺', 2, 1),
(21, 4, 0, '会员资料管理', 'userinfo', '会员资料管理　输入会员　即可参与', 2, 1),
(22, 1, 0, '翻译', 'fanyi', '翻译＋关键词 例：翻译你好', 1, 1),
(23, 4, 0, '第三方接口', 'api', '第三方接口整合模块，请在管理平台下载接口文件并配置接口信息，', 1, 1),
(24, 1, 0, '姓名算命', 'suanming', '姓名算命 算命＋关键词　例：算命李白', 1, 1),
(25, 3, 0, '百度百科', 'baike', '百度百科　使用方法：百科＋关键词　例：百科北京', 2, 1),
(26, 2, 0, '彩票查询', 'caipiao', '回复内容:彩票+彩种即可查询彩票中奖信息,例：彩票双色球', 1, 1),
(27, 4, 0, '抽奖', 'choujiang', '抽奖,输入抽奖即可参加幸运大转盘', 1, 1),
(28, 4, 0, '刮刮卡', 'gua2', '刮刮卡抽奖活动', 1, 1),
(29, 1, 0, '3G首页', 'shouye', '输入首页,访问微3g 网站', 1, 1),
(30, 1, 0, 'DIY宣传页', 'adma', 'DIY宣传页,用于创建二维码宣传页权限开启', 1, 1),
(31, 4, 0, '会员卡', 'huiyuanka', '尊贵享受vip会员卡,回复会员卡即可领取会员卡', 1, 1),
(33, 4, 0, '官网帐号审核', 'shenhe', '官网帐号审核', 1, 1),
(34, 1, 0, '歌词查询', 'geci', '歌词查询 回复歌词＋歌名即可查询一首歌曲的歌词,例：歌词醉清风', 1, 1),
(35, 2, 0, '域名whois查询', '', '域名whois查询　回复域名＋域名 可查询网站备案信息,域名whois注册时间等等\r\n 例：域名lanrain.com', 1, 1),
(36, 4, 0, '通用预订系统', 'host_kev', '通用预订系统 可用于酒店预订，ktv订房，旅游预订等。', 2, 1),
(69, 4, 0, '微美容', 'meirong', '', 1, 1),
(38, 4, 0, '自定义表单', 'diyform', '自定义表单(用于报名，预约,留言)等', 1, 1),
(39, 2, 0, '无线网络订餐', 'dx', '无线网络订餐', 1, 1),
(40, 2, 0, '在线商城', 'shop', '在线商城,购买系统', 1, 1),
(41, 2, 0, '在线团购系统', 'etuan', '在线团购系统', 1, 1),
(42, 4, 0, '自定义菜单', 'diymen_set', '自定义菜单,一键生成轻app', 1, 1),
(43, 4, 0, '360全景', 'Panorama', '360全景', 2, 1),
(44, 4, 0, '微喜帖', 'WeiXitie', '微喜帖', 2, 1),
(45, 4, 0, '预约', 'Yuyue', '预约', 2, 1),
(47, 4, 0, '微医疗', 'Yiliao', '微医疗提供挂号预约服务', 2, 1),
(48, 4, 0, '微贺卡', 'Heka', '微贺卡', 2, 1),
(72, 1, 0, '微酒店', 'Jiudian', '微酒店', 2, 1),
(50, 4, 0, '微调研', 'Diaoyan', '微调研', 2, 1),
(51, 4, 0, '微房产', 'estate', '微房产', 2, 1),
(52, 4, 0, '微喜帖新', 'Xitienew', '微喜帖新', 2, 1),
(53, 4, 0, '会员资料管理', 'userinfo', '会员资料管理　输入会员　即可参与', 2, 1),
(54, 4, 0, 'Wifi密码', 'wifi', 'Wifi密码发放格式设定', 2, 1),
(59, 4, 0, '投票', 'vote', '', 1, 1),
(60, 4, 0, '3G相册', 'album', '', 1, 1),
(61, 4, 0, '优惠券', 'Coupon', '', 1, 1),
(62, 4, 0, '微花店', 'huadian', '', 1, 1),
(63, 4, 0, '微教育', 'jiaoyu', '', 1, 1),
(64, 4, 0, '微食品', 'shipin', '', 1, 1),
(65, 4, 0, '微健身', 'jianshen', '', 1, 1),
(66, 4, 0, '微政务', 'zhengwu', '', 1, 1),
(67, 4, 0, '微旅游', 'lvyou', '', 1, 1),
(68, 4, 0, '微汽车', 'car', '', 1, 1),
(70, 1, 0, '公众小秘书', 'Paper', '公众小秘书', 1, 1),
(73, 1, 0, '微众场景', 'Scene', '微众场景', 2, 1),
(74, 6, 0, '房产中介', 'Fangchan', '房产中介', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `wy_gamereply_info`
--

CREATE TABLE IF NOT EXISTS `wy_gamereply_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `title` varchar(30) NOT NULL DEFAULT '',
  `picurl` varchar(120) NOT NULL DEFAULT '',
  `picurls1` varchar(120) NOT NULL DEFAULT '',
  `info` varchar(120) NOT NULL DEFAULT '',
  `keyword` varchar(50) NOT NULL DEFAULT '',
  `copyright` text NOT NULL,
  `ad` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_games`
--

CREATE TABLE IF NOT EXISTS `wy_games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(40) NOT NULL DEFAULT '',
  `gameid` int(11) NOT NULL DEFAULT '0',
  `picurl` varchar(160) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `keyword` varchar(60) NOT NULL DEFAULT '',
  `intro` varchar(500) NOT NULL DEFAULT '',
  `selfinfo` varchar(5000) NOT NULL DEFAULT '',
  `token` varchar(20) NOT NULL DEFAULT '',
  `playcount` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_gametreply_info`
--

CREATE TABLE IF NOT EXISTS `wy_gametreply_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `title` varchar(30) NOT NULL DEFAULT '',
  `picurl` varchar(120) NOT NULL DEFAULT '',
  `picurls1` varchar(120) NOT NULL DEFAULT '',
  `info` varchar(120) NOT NULL DEFAULT '',
  `keyword` varchar(50) NOT NULL DEFAULT '',
  `copyright` text NOT NULL,
  `ad` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_gamettreply_info`
--

CREATE TABLE IF NOT EXISTS `wy_gamettreply_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `title` varchar(30) NOT NULL DEFAULT '',
  `picurl` varchar(120) NOT NULL DEFAULT '',
  `picurls1` varchar(120) NOT NULL DEFAULT '',
  `info` varchar(120) NOT NULL DEFAULT '',
  `keyword` varchar(50) NOT NULL DEFAULT '',
  `copyright` text NOT NULL,
  `ad` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_game_config`
--

CREATE TABLE IF NOT EXISTS `wy_game_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(30) NOT NULL DEFAULT '',
  `wxid` varchar(40) NOT NULL DEFAULT '',
  `wxname` varchar(50) NOT NULL DEFAULT '',
  `wxlogo` varchar(150) NOT NULL DEFAULT '',
  `link` varchar(150) NOT NULL DEFAULT '',
  `uid` int(11) NOT NULL DEFAULT '0',
  `key` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_game_records`
--

CREATE TABLE IF NOT EXISTS `wy_game_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gameid` int(11) NOT NULL DEFAULT '0',
  `token` varchar(30) NOT NULL DEFAULT '',
  `wecha_id` varchar(50) NOT NULL DEFAULT '',
  `score` varchar(30) NOT NULL DEFAULT '',
  `time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `gameid` (`gameid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_greeting_card`
--

CREATE TABLE IF NOT EXISTS `wy_greeting_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `num` int(11) NOT NULL,
  `click` int(11) NOT NULL,
  `keyword` varchar(60) NOT NULL,
  `title` varchar(60) NOT NULL,
  `picurl` varchar(200) NOT NULL,
  `bakcground_url` varchar(200) NOT NULL,
  `mp3` varchar(200) NOT NULL,
  `style` tinyint(2) NOT NULL,
  `name` varchar(60) NOT NULL,
  `zfname` varchar(60) NOT NULL,
  `copy` varchar(200) NOT NULL,
  `info` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_heka`
--

CREATE TABLE IF NOT EXISTS `wy_heka` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `token` varchar(100) NOT NULL,
  `bg_topic` varchar(100) DEFAULT NULL,
  `bg_music` varchar(100) DEFAULT NULL,
  `bg_action` int(2) DEFAULT NULL,
  `content` varchar(500) DEFAULT NULL,
  `sub` varchar(20) DEFAULT NULL,
  `show` int(1) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `banquan` varchar(100) DEFAULT NULL COMMENT '版权',
  `see` int(20) DEFAULT '0' COMMENT '查看次数',
  `forwards` int(20) DEFAULT '0' COMMENT '转发次数',
  `keyword` varchar(50) DEFAULT NULL,
  `topic` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_hforward`
--

CREATE TABLE IF NOT EXISTS `wy_hforward` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `keyword` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `picurl` varchar(500) NOT NULL,
  `info` text NOT NULL,
  `statdate` int(11) NOT NULL,
  `lj` varchar(255) DEFAULT NULL,
  `gz` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_hfor_item`
--

CREATE TABLE IF NOT EXISTS `wy_hfor_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `wecha_id` varchar(255) NOT NULL,
  `createtime` int(11) NOT NULL,
  `tongji` int(11) DEFAULT '0',
  `ip` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_home`
--

CREATE TABLE IF NOT EXISTS `wy_home` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `title` varchar(30) NOT NULL,
  `picurl` varchar(120) NOT NULL,
  `homeurl` varchar(150) NOT NULL DEFAULT '',
  `info` varchar(120) NOT NULL,
  `plugmenucolor` varchar(10) NOT NULL DEFAULT '',
  `indexdisplay` int(1) NOT NULL,
  `copyid` int(3) NOT NULL,
  `copyright` varchar(200) NOT NULL DEFAULT '',
  `advancetpl` tinyint(1) NOT NULL DEFAULT '0',
  `dianhua` char(200) NOT NULL,
  `musicurl` varchar(200) NOT NULL,
  `photourl` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `radiogroup` mediumint(4) NOT NULL,
  `gzhurl` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_host`
--

CREATE TABLE IF NOT EXISTS `wy_host` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `keyword` varchar(50) NOT NULL COMMENT '关键词',
  `title` varchar(50) NOT NULL COMMENT '商家名称',
  `address` varchar(50) NOT NULL COMMENT '商家地',
  `tel` varchar(13) NOT NULL COMMENT '商家电话',
  `tel2` varchar(13) NOT NULL COMMENT '手机号',
  `ppicurl` varchar(250) NOT NULL COMMENT '订房封面图片',
  `headpic` varchar(250) NOT NULL COMMENT '订单页头部图片',
  `name` varchar(50) NOT NULL COMMENT '文字描述',
  `sort` int(11) NOT NULL COMMENT '排序',
  `picurl` varchar(100) NOT NULL COMMENT '图片地址',
  `url` varchar(50) NOT NULL COMMENT '图片跳转地址以http',
  `info` text NOT NULL COMMENT '商家介绍：',
  `info2` text NOT NULL COMMENT '订房说明u',
  `creattime` int(11) NOT NULL COMMENT '创建日期',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `wy_host`
--

INSERT INTO `wy_host` (`id`, `token`, `keyword`, `title`, `address`, `tel`, `tel2`, `ppicurl`, `headpic`, `name`, `sort`, `picurl`, `url`, `info`, `info2`, `creattime`) VALUES
(1, 'nhpojt1406874718', '22224', '我要上网', '', '13223123123', '', 'http://weixin.fenxiangweb.com/tpl/static/attachment/icon/lovely/bill.png', './tpl/User/default/common/images/cart_info/online.jpg', '', 0, '', '', '会员卡会员卡', '会员卡会员卡', 1406877489),
(2, 'cmwpur1407242591', '2112', '121', '', '12121212', '', 'http://weixin.fenxiangweb.com/uploads/c/cmwpur1407242591/3/d/6/2/thumb_53f86e2b1bd8c.jpg', './tpl/User/default/common/images/cart_info/online.jpg', '', 0, '', '', '1212', '12', 1408940156);

-- --------------------------------------------------------

--
-- 表的结构 `wy_host_list_add`
--

CREATE TABLE IF NOT EXISTS `wy_host_list_add` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hid` int(11) NOT NULL COMMENT '商家id',
  `token` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL COMMENT '房间类型',
  `typeinfo` varchar(100) NOT NULL COMMENT '简要说明',
  `price` decimal(10,2) NOT NULL COMMENT '原价：',
  `yhprice` decimal(10,2) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '文字描述',
  `picurl` varchar(110) NOT NULL COMMENT '图片地址',
  `url` varchar(100) NOT NULL COMMENT '图片跳转地址以http',
  `info` text NOT NULL COMMENT '配套设施',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_host_order`
--

CREATE TABLE IF NOT EXISTS `wy_host_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `wecha_id` varchar(50) NOT NULL,
  `book_people` varchar(50) NOT NULL COMMENT '预订人',
  `tel` varchar(13) NOT NULL COMMENT '电话',
  `check_in` int(11) NOT NULL COMMENT '入住时间',
  `check_out` int(11) NOT NULL COMMENT '离开时间',
  `room_type` varchar(50) NOT NULL COMMENT '房间类型',
  `book_time` int(11) NOT NULL COMMENT '预订时间',
  `book_num` int(11) NOT NULL COMMENT '预订数量',
  `price` decimal(10,2) NOT NULL COMMENT ' 价格',
  `order_status` int(11) NOT NULL COMMENT '订单状态 1 成功,2 失败,3 未处理',
  `hid` int(11) NOT NULL COMMENT '订房商家id',
  `remarks` varchar(250) NOT NULL COMMENT '留言备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_img`
--

CREATE TABLE IF NOT EXISTS `wy_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `sortid` int(11) NOT NULL,
  `uname` varchar(90) NOT NULL,
  `keyword` char(255) NOT NULL,
  `type` varchar(1) NOT NULL COMMENT '关键词匹配类型',
  `text` text NOT NULL COMMENT '简介',
  `classid` int(11) NOT NULL,
  `classname` varchar(60) NOT NULL,
  `pic` char(255) NOT NULL COMMENT '封面图片',
  `showpic` varchar(1) NOT NULL COMMENT '图片是否显示封面',
  `info` text NOT NULL COMMENT '图文详细内容',
  `url` char(255) NOT NULL COMMENT '图文外链地址',
  `createtime` varchar(13) NOT NULL,
  `uptatetime` varchar(13) NOT NULL,
  `click` int(11) NOT NULL,
  `token` char(30) NOT NULL,
  `title` varchar(60) NOT NULL,
  `usort` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `classid` (`classid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_img_multi`
--

CREATE TABLE IF NOT EXISTS `wy_img_multi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `keywords` varchar(100) DEFAULT '',
  `imgs` varchar(100) DEFAULT '',
  `token` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_indent`
--

CREATE TABLE IF NOT EXISTS `wy_indent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `gid` tinyint(2) NOT NULL,
  `uname` varchar(60) NOT NULL,
  `title` varchar(60) NOT NULL,
  `info` int(11) NOT NULL,
  `indent_id` char(20) NOT NULL,
  `widtrade_no` int(20) NOT NULL,
  `price` float NOT NULL,
  `create_time` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_invites`
--

CREATE TABLE IF NOT EXISTS `wy_invites` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `title` varchar(60) NOT NULL,
  `keyword` varchar(30) NOT NULL,
  `picurl` varchar(120) NOT NULL,
  `type` int(3) NOT NULL,
  `brief` varchar(200) NOT NULL,
  `content` varchar(300) NOT NULL,
  `statdate` varchar(30) NOT NULL,
  `address` varchar(120) NOT NULL,
  `lng` double NOT NULL,
  `lat` double NOT NULL,
  `qr_code` varchar(120) NOT NULL,
  `copyrite` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_invites_info`
--

CREATE TABLE IF NOT EXISTS `wy_invites_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iid` int(11) NOT NULL,
  `token` varchar(60) NOT NULL,
  `username` varchar(20) NOT NULL,
  `telphone` varchar(15) NOT NULL,
  `rdo_go` int(2) NOT NULL,
  `content` varchar(200) NOT NULL,
  `type` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_jiejing`
--

CREATE TABLE IF NOT EXISTS `wy_jiejing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `keyword` varchar(60) NOT NULL,
  `title` varchar(50) NOT NULL,
  `picurl` varchar(200) NOT NULL,
  `pano` varchar(200) NOT NULL,
  `text` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_jikedati`
--

CREATE TABLE IF NOT EXISTS `wy_jikedati` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `timu` text NOT NULL,
  `answer1` text NOT NULL,
  `answer2` text NOT NULL,
  `answer3` text NOT NULL,
  `answer4` text NOT NULL,
  `score1` text NOT NULL,
  `score2` text NOT NULL,
  `score3` text NOT NULL,
  `score4` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_jikedati_flash`
--

CREATE TABLE IF NOT EXISTS `wy_jikedati_flash` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `picurl1` char(255) NOT NULL,
  `picurl2` char(255) NOT NULL,
  `picurl3` char(255) NOT NULL,
  `picurl4` char(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_jikedati_reply`
--

CREATE TABLE IF NOT EXISTS `wy_jikedati_reply` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `info` varchar(500) DEFAULT NULL COMMENT '公司简介',
  `title` text NOT NULL,
  `tp` char(255) NOT NULL,
  `copyright` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `scorename` text NOT NULL,
  `tip1` text NOT NULL,
  `tip2` text NOT NULL,
  `tip3` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_jikedati_setcin`
--

CREATE TABLE IF NOT EXISTS `wy_jikedati_setcin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `info` text,
  `tel` varchar(11) DEFAULT NULL,
  `messages` text,
  `banner` varchar(100) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `lng` varchar(30) NOT NULL,
  `lat` varchar(30) NOT NULL,
  `picurl1` varchar(100) NOT NULL,
  `picurl2` varchar(100) NOT NULL,
  `picurl3` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_jikedati_user`
--

CREATE TABLE IF NOT EXISTS `wy_jikedati_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `diaoyan_id` int(11) DEFAULT NULL,
  `wecha_id` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_jingcai_changci`
--

CREATE TABLE IF NOT EXISTS `wy_jingcai_changci` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `stime` int(11) NOT NULL COMMENT '赛事时间',
  `pid` int(11) NOT NULL COMMENT '赛事回复配置id',
  `type_id` int(11) NOT NULL COMMENT '赛事类型',
  `zhudui` int(11) NOT NULL COMMENT '主队',
  `kedui` int(11) NOT NULL COMMENT '客场',
  `speilv` int(11) NOT NULL COMMENT '主胜赔率',
  `ppeilv` int(11) NOT NULL COMMENT '平赔率',
  `fpeilv` int(11) NOT NULL COMMENT '主负赔率',
  `minlimit` int(11) NOT NULL DEFAULT '0' COMMENT '最小限额',
  `zhuduinum` int(11) NOT NULL DEFAULT '0' COMMENT '主队进球',
  `keduinum` int(11) NOT NULL DEFAULT '0' COMMENT '客队进球',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '比赛状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_jingcai_changci_record`
--

CREATE TABLE IF NOT EXISTS `wy_jingcai_changci_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `wecha_id` varchar(200) NOT NULL,
  `type_id` int(11) NOT NULL COMMENT '赛事类型',
  `changci_id` int(11) NOT NULL COMMENT '赛事id',
  `ycjg` int(1) NOT NULL DEFAULT '1' COMMENT '预测结果',
  `ctime` int(11) NOT NULL COMMENT '预测时间',
  `sjm` varchar(50) NOT NULL COMMENT '抽奖码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_jingcai_set`
--

CREATE TABLE IF NOT EXISTS `wy_jingcai_set` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `title` varchar(50) NOT NULL,
  `keyword` varchar(50) NOT NULL,
  `cover` varchar(200) NOT NULL,
  `bannerpic` varchar(500) NOT NULL,
  `info` varchar(500) DEFAULT NULL,
  `choujiang` int(1) DEFAULT '0',
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `token_2` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_jingcai_team`
--

CREATE TABLE IF NOT EXISTS `wy_jingcai_team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '赛事回复配置id',
  `type_id` int(11) NOT NULL COMMENT '赛事类型',
  `token` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '团体名字',
  `desc` varchar(500) NOT NULL COMMENT '团体描述',
  `team_logo` varchar(500) NOT NULL COMMENT '团体logo',
  `sort` tinyint(4) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '团队状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_jingcai_type`
--

CREATE TABLE IF NOT EXISTS `wy_jingcai_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `token` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `sort` tinyint(4) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_kefuonline`
--

CREATE TABLE IF NOT EXISTS `wy_kefuonline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `keyword` varchar(60) NOT NULL,
  `title` varchar(50) NOT NULL,
  `picurl` varchar(200) NOT NULL,
  `info` text NOT NULL,
  `info2` varchar(200) NOT NULL,
  `text` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `wy_kefuonline`
--

INSERT INTO `wy_kefuonline` (`id`, `token`, `keyword`, `title`, `picurl`, `info`, `info2`, `text`) VALUES
(4, 'yktzwl1394940967', '在线客服', '欢迎进入在线客服系统...', 'http://test.yckjx.com/uploads/y/yktzwl1394940967/2/4/7/c/thumb_5329cd3c2f3e6.jpg', '<script type="text/javascript" src="http://kefu6.kuaishang.com.cn/bs/ks.j?cI=811952&fI=9165&ism=1" charset="utf-8"></script>', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `wy_keyword`
--

CREATE TABLE IF NOT EXISTS `wy_keyword` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` char(255) NOT NULL,
  `pid` int(11) NOT NULL,
  `token` varchar(60) NOT NULL,
  `module` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=129 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_leave`
--

CREATE TABLE IF NOT EXISTS `wy_leave` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `wecha_id` varchar(60) NOT NULL,
  `checked` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(60) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `token` varchar(60) NOT NULL,
  `time` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_links`
--

CREATE TABLE IF NOT EXISTS `wy_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `url` char(255) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_liuyan`
--

CREATE TABLE IF NOT EXISTS `wy_liuyan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(30) NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `text` varchar(500) DEFAULT NULL,
  `createtime` int(20) DEFAULT NULL,
  `uptatetime` int(20) DEFAULT NULL,
  `token` varchar(30) NOT NULL,
  `re` varchar(500) DEFAULT NULL,
  `wecha_id` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_live`
--

CREATE TABLE IF NOT EXISTS `wy_live` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `show_company` enum('0','1') NOT NULL,
  `name` char(50) NOT NULL,
  `keyword` char(40) NOT NULL,
  `open_pic` char(120) NOT NULL,
  `is_masking` enum('0','1') NOT NULL,
  `masking_pic` char(120) NOT NULL,
  `intro` varchar(500) NOT NULL,
  `music` char(120) NOT NULL,
  `end_pic` char(120) NOT NULL,
  `share_bg` char(120) NOT NULL,
  `share_button` char(120) NOT NULL,
  `add_time` char(11) NOT NULL,
  `is_open` enum('0','1') NOT NULL,
  `token` char(25) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_live_company`
--

CREATE TABLE IF NOT EXISTS `wy_live_company` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` char(25) NOT NULL,
  `name` char(50) NOT NULL,
  `bg_pic` char(120) NOT NULL,
  `top_pic` char(120) NOT NULL,
  `company_id` int(10) unsigned NOT NULL,
  `live_id` int(10) unsigned NOT NULL,
  `sort` tinyint(3) unsigned NOT NULL,
  `is_show` enum('0','1') NOT NULL,
  `show_map` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_live_content`
--

CREATE TABLE IF NOT EXISTS `wy_live_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL,
  `bg_pic` char(120) NOT NULL,
  `movie_pic` char(120) NOT NULL,
  `movie_link` char(200) NOT NULL,
  `type` enum('1','2') NOT NULL,
  `sort` tinyint(4) unsigned NOT NULL,
  `is_show` enum('0','1') NOT NULL,
  `token` char(25) NOT NULL,
  `add_time` char(11) NOT NULL,
  `live_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_lottery`
--

CREATE TABLE IF NOT EXISTS `wy_lottery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `joinnum` int(11) NOT NULL COMMENT '参与人数',
  `click` int(11) NOT NULL,
  `token` varchar(30) NOT NULL,
  `keyword` varchar(10) NOT NULL,
  `starpicurl` varchar(100) NOT NULL COMMENT '填写活动开始图片网址',
  `title` varchar(60) NOT NULL COMMENT '活动名称',
  `txt` varchar(60) NOT NULL COMMENT '用户输入兑奖时候的显示信息',
  `sttxt` varchar(200) NOT NULL COMMENT '简介',
  `statdate` int(11) NOT NULL COMMENT '活动开始时间',
  `enddate` int(11) NOT NULL COMMENT '活动结束时间',
  `info` varchar(200) NOT NULL COMMENT '活动说明',
  `aginfo` varchar(200) NOT NULL COMMENT '重复抽奖回复',
  `endtite` varchar(60) NOT NULL COMMENT '活动结束公告主题',
  `endpicurl` varchar(100) NOT NULL,
  `endinfo` varchar(60) NOT NULL,
  `fist` varchar(50) NOT NULL COMMENT '一等奖奖品设置',
  `fistnums` int(4) NOT NULL COMMENT '一等奖奖品数量',
  `fistlucknums` int(1) NOT NULL COMMENT '一等奖中奖号码',
  `second` varchar(50) NOT NULL COMMENT '二等奖奖品设置',
  `type` tinyint(1) NOT NULL,
  `secondnums` int(4) NOT NULL,
  `secondlucknums` int(1) NOT NULL,
  `third` varchar(50) NOT NULL,
  `thirdnums` int(4) NOT NULL,
  `thirdlucknums` int(1) NOT NULL,
  `allpeople` int(11) NOT NULL,
  `canrqnums` int(2) NOT NULL COMMENT '个人限制抽奖次数',
  `parssword` int(15) NOT NULL,
  `renamesn` varchar(50) NOT NULL DEFAULT '',
  `renametel` varchar(60) NOT NULL,
  `displayjpnums` int(1) NOT NULL,
  `createtime` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `four` varchar(50) NOT NULL,
  `fournums` int(11) NOT NULL,
  `fourlucknums` int(11) NOT NULL,
  `five` varchar(50) NOT NULL,
  `fivenums` int(11) NOT NULL,
  `fivelucknums` int(11) NOT NULL,
  `six` varchar(50) NOT NULL COMMENT '六等奖',
  `sixnums` int(11) NOT NULL,
  `sixlucknums` int(11) NOT NULL,
  `zjpic` varchar(150) NOT NULL DEFAULT '',
  `daynums` mediumint(4) NOT NULL DEFAULT '0',
  `maxgetprizenum` mediumint(4) NOT NULL DEFAULT '1',
  `needreg` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_lottery_cheat`
--

CREATE TABLE IF NOT EXISTS `wy_lottery_cheat` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `lid` int(10) NOT NULL DEFAULT '0',
  `wecha_id` varchar(60) NOT NULL DEFAULT '',
  `mp` varchar(11) NOT NULL DEFAULT '',
  `prizetype` mediumint(4) NOT NULL DEFAULT '0',
  `intro` varchar(60) NOT NULL DEFAULT '',
  `code` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `lid` (`lid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_lottery_record`
--

CREATE TABLE IF NOT EXISTS `wy_lottery_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lid` int(11) NOT NULL,
  `usenums` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户使用次数',
  `wecha_id` varchar(60) NOT NULL COMMENT '微信唯一识别码',
  `token` varchar(30) NOT NULL,
  `islottery` int(1) NOT NULL COMMENT '是否中奖',
  `wecha_name` varchar(60) NOT NULL COMMENT '微信号',
  `phone` varchar(15) NOT NULL,
  `sn` varchar(13) NOT NULL COMMENT '中奖后序列号',
  `time` int(11) NOT NULL,
  `prize` varchar(50) NOT NULL DEFAULT '' COMMENT '已中奖项',
  `sendstutas` int(11) NOT NULL DEFAULT '0',
  `sendtime` int(11) NOT NULL,
  PRIMARY KEY (`id`,`lid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_market`
--

CREATE TABLE IF NOT EXISTS `wy_market` (
  `market_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL,
  `title` char(30) NOT NULL,
  `keyword` char(20) NOT NULL,
  `tel` char(25) NOT NULL,
  `address` varchar(100) NOT NULL,
  `longitude` char(20) NOT NULL,
  `latitude` char(20) NOT NULL,
  `line` varchar(100) NOT NULL,
  `intro` text NOT NULL,
  `logo_pic` char(100) NOT NULL,
  `token` char(20) NOT NULL,
  `market_index_tpl` mediumint(9) NOT NULL,
  `tenant_index_tpl` mediumint(9) NOT NULL,
  `tenant_list_tpl` mediumint(9) NOT NULL,
  PRIMARY KEY (`market_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_market_area`
--

CREATE TABLE IF NOT EXISTS `wy_market_area` (
  `area_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `area_name` char(35) NOT NULL,
  `manage` char(50) NOT NULL,
  `area_pic` char(100) NOT NULL,
  `area_intro` text NOT NULL,
  `is_use` enum('0','1') NOT NULL,
  `add_time` char(10) NOT NULL,
  `sort` tinyint(2) NOT NULL,
  `market_id` int(11) NOT NULL,
  `token` char(20) NOT NULL,
  PRIMARY KEY (`area_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_market_cate`
--

CREATE TABLE IF NOT EXISTS `wy_market_cate` (
  `cate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` char(35) NOT NULL,
  `cate_pic` char(100) NOT NULL,
  `cate_intro` varchar(200) NOT NULL,
  `cate_pid` int(11) NOT NULL,
  `path_info` varchar(255) NOT NULL,
  `is_show` enum('0','1') NOT NULL,
  `sort` tinyint(4) NOT NULL,
  `market_id` int(11) NOT NULL,
  `token` char(20) NOT NULL,
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `wy_market_cate`
--

INSERT INTO `wy_market_cate` (`cate_id`, `cate_name`, `cate_pic`, `cate_intro`, `cate_pid`, `path_info`, `is_show`, `sort`, `market_id`, `token`) VALUES
(1, '玩玩去', 'http://ceshi.fenxiangweb.com/tpl/static/attachment/icon/lovely/bookmark.png', '死死死死死死', 0, '', '1', 50, 1, 'nhpojt1406874718'),
(2, '衣服类', 'http://weixin.fenxiangweb.com/tpl/static/attachment/focus/default/6.jpg', '测试', 0, '', '1', 50, 2, 'svhotw1407124281'),
(3, '生活类', 'http://weixin.fenxiangweb.com/tpl/static/attachment/icon/lovely/backpack-2.png', '', 0, '', '1', 1, 8, 'fullfj1410511387'),
(4, '食品类', 'http://weixin.fenxiangweb.com/tpl/static/attachment/icon/lovely/car.png', '', 0, '', '1', 2, 8, 'fullfj1410511387'),
(5, '美容类', 'http://weixin.fenxiangweb.com/tpl/static/attachment/icon/lovely/open-letter.png', '', 0, '', '1', 3, 8, 'fullfj1410511387');

-- --------------------------------------------------------

--
-- 表的结构 `wy_market_nav`
--

CREATE TABLE IF NOT EXISTS `wy_market_nav` (
  `nav_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nav_name` char(35) NOT NULL,
  `nav_pic` varchar(200) NOT NULL,
  `nav_link` varchar(200) NOT NULL,
  `is_show` enum('0','1') NOT NULL,
  `sort` tinyint(4) NOT NULL,
  `market_id` int(11) NOT NULL,
  `token` char(20) NOT NULL,
  `is_system` enum('0','1') NOT NULL,
  PRIMARY KEY (`nav_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_market_park`
--

CREATE TABLE IF NOT EXISTS `wy_market_park` (
  `park_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `park_name` char(35) NOT NULL,
  `park_num` tinyint(4) NOT NULL,
  `park_intro` text NOT NULL,
  `is_use` enum('0','1') NOT NULL,
  `add_time` char(10) NOT NULL,
  `market_id` int(11) NOT NULL,
  `token` char(20) NOT NULL,
  PRIMARY KEY (`park_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_market_slide`
--

CREATE TABLE IF NOT EXISTS `wy_market_slide` (
  `slide_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slide_title` char(35) NOT NULL,
  `slide_url` char(100) NOT NULL,
  `slide_link` char(80) NOT NULL,
  `market_id` int(11) NOT NULL,
  PRIMARY KEY (`slide_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_member`
--

CREATE TABLE IF NOT EXISTS `wy_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `isopen` int(1) NOT NULL,
  `homepic` varchar(100) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_member_card_contact`
--

CREATE TABLE IF NOT EXISTS `wy_member_card_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `cname` varchar(30) NOT NULL,
  `tel` varchar(12) NOT NULL,
  `sort` tinyint(1) NOT NULL,
  `info` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_member_card_coupon`
--

CREATE TABLE IF NOT EXISTS `wy_member_card_coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cardid` int(10) NOT NULL DEFAULT '0',
  `token` varchar(60) NOT NULL,
  `title` varchar(60) NOT NULL,
  `group` tinyint(1) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `price` int(11) NOT NULL,
  `people` int(3) NOT NULL,
  `statdate` int(11) NOT NULL,
  `enddate` int(11) NOT NULL,
  `info` text NOT NULL,
  `usetime` int(10) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`),
  KEY `cardid` (`cardid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_member_card_create`
--

CREATE TABLE IF NOT EXISTS `wy_member_card_create` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cardid` int(10) NOT NULL DEFAULT '0',
  `token` varchar(60) NOT NULL,
  `number` varchar(20) NOT NULL,
  `wecha_id` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`),
  KEY `cardid` (`cardid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10820 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_member_card_custom`
--

CREATE TABLE IF NOT EXISTS `wy_member_card_custom` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` char(40) NOT NULL,
  `wechaname` tinyint(4) NOT NULL DEFAULT '1',
  `tel` tinyint(4) NOT NULL DEFAULT '1',
  `truename` tinyint(4) NOT NULL DEFAULT '0',
  `qq` tinyint(4) NOT NULL DEFAULT '0',
  `paypass` tinyint(4) NOT NULL DEFAULT '1',
  `portrait` tinyint(4) NOT NULL DEFAULT '0',
  `sex` tinyint(4) NOT NULL DEFAULT '0',
  `bornyear` tinyint(4) NOT NULL DEFAULT '0',
  `bornmonth` tinyint(4) NOT NULL DEFAULT '0',
  `bornday` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_member_card_exchange`
--

CREATE TABLE IF NOT EXISTS `wy_member_card_exchange` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cardid` mediumint(8) NOT NULL DEFAULT '0',
  `token` varchar(60) NOT NULL,
  `everyday` tinyint(4) NOT NULL,
  `continuation` tinyint(4) NOT NULL,
  `reward` tinyint(4) NOT NULL,
  `czreward` tinyint(4) NOT NULL,
  `cardinfo` varchar(200) NOT NULL,
  `cardinfo2` varchar(200) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`),
  KEY `cardid` (`cardid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_member_card_focus`
--

CREATE TABLE IF NOT EXISTS `wy_member_card_focus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `info` varchar(300) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `token` char(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_member_card_info`
--

CREATE TABLE IF NOT EXISTS `wy_member_card_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `info` varchar(200) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `description` varchar(12) NOT NULL,
  `class` tinyint(1) NOT NULL,
  `password` varchar(11) NOT NULL,
  `crate_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_member_card_integral`
--

CREATE TABLE IF NOT EXISTS `wy_member_card_integral` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cardid` int(10) NOT NULL DEFAULT '0',
  `token` varchar(60) NOT NULL,
  `title` varchar(60) NOT NULL,
  `integral` int(8) NOT NULL,
  `statdate` int(11) NOT NULL,
  `enddate` int(11) NOT NULL,
  `info` text NOT NULL,
  `usetime` int(10) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`),
  KEY `cardid` (`cardid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_member_card_notice`
--

CREATE TABLE IF NOT EXISTS `wy_member_card_notice` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cardid` int(10) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `endtime` int(10) NOT NULL DEFAULT '0',
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cardid` (`cardid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_member_card_pay_record`
--

CREATE TABLE IF NOT EXISTS `wy_member_card_pay_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderid` char(30) NOT NULL,
  `ordername` varchar(1000) NOT NULL,
  `transactionid` varchar(100) DEFAULT NULL,
  `paytype` char(30) DEFAULT NULL,
  `createtime` int(11) NOT NULL,
  `paytime` int(11) DEFAULT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  `price` double(10,2) unsigned NOT NULL DEFAULT '0.00',
  `token` char(50) NOT NULL,
  `wecha_id` char(50) NOT NULL,
  `module` varchar(30) NOT NULL DEFAULT 'Card',
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `operator` varchar(20) DEFAULT NULL,
  `intogold` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_member_card_set`
--

CREATE TABLE IF NOT EXISTS `wy_member_card_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `cardname` varchar(60) NOT NULL,
  `miniscore` int(10) NOT NULL DEFAULT '0',
  `logo` varchar(200) NOT NULL,
  `bg` varchar(100) NOT NULL,
  `diybg` varchar(200) NOT NULL,
  `msg` varchar(100) NOT NULL,
  `numbercolor` varchar(10) NOT NULL,
  `vipnamecolor` varchar(10) NOT NULL,
  `Lastmsg` varchar(100) NOT NULL,
  `vip` varchar(100) NOT NULL,
  `qiandao` varchar(100) NOT NULL,
  `shopping` varchar(100) NOT NULL,
  `memberinfo` varchar(100) NOT NULL,
  `membermsg` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `create_time` int(11) NOT NULL,
  `bornmonth_dis` tinyint(1) DEFAULT '1',
  `bornday_dis` tinyint(1) DEFAULT '1',
  `diyname1` varchar(20) DEFAULT NULL,
  `diyname2` varchar(20) DEFAULT NULL,
  `wechaname_dis` tinyint(1) DEFAULT '1',
  `tel_dis` tinyint(1) DEFAULT '1',
  `truename_dis` tinyint(1) DEFAULT '1',
  `qq_dis` tinyint(1) DEFAULT '1',
  `sex_dis` tinyint(1) DEFAULT '1',
  `bornyear_dis` tinyint(1) DEFAULT '1',
  `mobile_code_dis` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `token` (`token`),
  KEY `miniscore` (`miniscore`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_member_card_sign`
--

CREATE TABLE IF NOT EXISTS `wy_member_card_sign` (
  `id` int(11) NOT NULL,
  `token` varchar(50) NOT NULL,
  `wecha_id` varchar(50) NOT NULL,
  `sign_time` int(11) NOT NULL,
  `is_sign` int(11) NOT NULL,
  `score_type` int(11) NOT NULL,
  `expense` int(11) NOT NULL,
  `sell_expense` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wy_member_card_sign`
--

INSERT INTO `wy_member_card_sign` (`id`, `token`, `wecha_id`, `sign_time`, `is_sign`, `score_type`, `expense`, `sell_expense`) VALUES
(0, 'aujvne1405163386', 'oi4n8t1n-JSfVMVCvKrWYmVyIteM', 0, 0, 1, 0, 0),
(0, 'aujvne1405163386', 'oi4n8t1n-JSfVMVCvKrWYmVyIteM', 1405988579, 1, 1, 0, 0),
(0, 'lbatdt1406991458', 'o8KDyji3GEJObwyDmx2sAQUPNnJc', 0, 0, 1, 0, 0),
(0, 'lbatdt1406991458', 'o8KDyji3GEJObwyDmx2sAQUPNnJc', 1407077829, 1, 1, 10, 0),
(0, 'lbatdt1406991458', 'o8KDyji3GEJObwyDmx2sAQUPNnJc', 1407081776, 1, 1, 127, 0),
(0, 'nhpojt1406874718', '', 0, 0, 1, 0, 0),
(0, 'nhpojt1406874718', '', 1407136728, 1, 1, 0, 0),
(0, 'cexiko1408343607', 'ocMzSt6EAYvS7Ajn02fBAb_66_5c', 1408344006, 1, 1, 0, 0),
(0, 'cexiko1408343607', 'ocMzSt6EAYvS7Ajn02fBAb_66_5c', 0, 0, 1, 0, 0),
(0, 'lbatdt1406991458', 'o8KDyji3GEJObwyDmx2sAQUPNnJc', 1407696922, 1, 1, 127, 0),
(0, 'oupivz1409650584', '{wechat_id}', 1410350813, 1, 1, 0, 0),
(0, 'rknekh1410830007', 'o72HUtzk06B5-T_Ebgz1C4DdFiB4', 1410831045, 1, 1, 0, 0),
(0, 'nlbsit1417131405', 'oV60at1grK1gHf8WsgoxzFYhxys8', 1417135250, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `wy_member_card_use_record`
--

CREATE TABLE IF NOT EXISTS `wy_member_card_use_record` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `itemid` int(10) NOT NULL DEFAULT '0',
  `token` varchar(30) NOT NULL DEFAULT '',
  `wecha_id` varchar(50) NOT NULL DEFAULT '',
  `staffid` int(10) NOT NULL DEFAULT '0',
  `cat` smallint(4) NOT NULL DEFAULT '0',
  `expense` mediumint(4) NOT NULL DEFAULT '0',
  `score` mediumint(4) NOT NULL DEFAULT '0',
  `usecount` mediumint(4) NOT NULL DEFAULT '1',
  `time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `itemid` (`itemid`,`cat`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_member_card_vip`
--

CREATE TABLE IF NOT EXISTS `wy_member_card_vip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cardid` int(10) NOT NULL DEFAULT '0',
  `token` varchar(60) NOT NULL,
  `title` varchar(60) NOT NULL,
  `group` tinyint(1) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `statdate` int(11) NOT NULL,
  `enddate` int(11) NOT NULL,
  `info` varchar(200) NOT NULL,
  `create_time` int(11) NOT NULL,
  `usetime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`),
  KEY `cardid` (`cardid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_moopha_article`
--

CREATE TABLE IF NOT EXISTS `wy_moopha_article` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `channel_id` int(10) NOT NULL,
  `token` varchar(50) NOT NULL,
  `site` int(4) NOT NULL DEFAULT '1',
  `title` varchar(200) NOT NULL,
  `titles` varchar(400) NOT NULL DEFAULT '',
  `subtitle` varchar(200) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `externallink` tinyint(1) NOT NULL DEFAULT '0',
  `thumb` varchar(100) DEFAULT NULL,
  `content` longtext,
  `intro` varchar(2000) NOT NULL,
  `author` varchar(20) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `keywords` varchar(300) DEFAULT NULL,
  `uid` varchar(10) NOT NULL DEFAULT '0',
  `time` int(10) NOT NULL,
  `last_update` int(10) NOT NULL,
  `viewcount` int(10) NOT NULL DEFAULT '0',
  `template` varchar(50) DEFAULT NULL,
  `pagecount` tinyint(2) NOT NULL DEFAULT '1',
  `disagree` int(10) NOT NULL DEFAULT '0',
  `cancomment` tinyint(1) NOT NULL DEFAULT '1',
  `commentcount` int(10) NOT NULL DEFAULT '0',
  `agree` int(10) NOT NULL DEFAULT '0',
  `taxis` int(10) NOT NULL DEFAULT '0',
  `lastcreate` int(10) NOT NULL DEFAULT '1400000000',
  `sourcetype` smallint(2) NOT NULL DEFAULT '0',
  `ex` tinyint(1) DEFAULT '0',
  `pubed` tinyint(1) NOT NULL DEFAULT '1',
  `geoid` mediumint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `channel_id` (`channel_id`),
  KEY `channel_id_2` (`channel_id`,`thumb`),
  KEY `time` (`time`),
  KEY `taxis` (`taxis`),
  KEY `ex` (`ex`),
  KEY `geoid` (`geoid`),
  KEY `uid` (`uid`),
  KEY `keywords` (`keywords`),
  KEY `sourcetype` (`sourcetype`),
  KEY `pubed` (`pubed`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_moopha_attachement`
--

CREATE TABLE IF NOT EXISTS `wy_moopha_attachement` (
  `url` varchar(150) NOT NULL DEFAULT '',
  `pubid` smallint(3) NOT NULL DEFAULT '1',
  `filetype` varchar(10) NOT NULL DEFAULT 'picture',
  `cat` varchar(20) NOT NULL DEFAULT '',
  `catid` int(10) NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL DEFAULT '',
  `time` int(10) NOT NULL DEFAULT '0',
  KEY `cat` (`cat`,`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wy_moopha_channel`
--

CREATE TABLE IF NOT EXISTS `wy_moopha_channel` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `shortname` varchar(50) NOT NULL DEFAULT '',
  `isnav` tinyint(1) NOT NULL DEFAULT '1',
  `channeltype` tinyint(1) NOT NULL DEFAULT '1',
  `cindex` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL DEFAULT '',
  `link` varchar(200) NOT NULL,
  `externallink` tinyint(1) NOT NULL DEFAULT '0',
  `des` mediumtext NOT NULL,
  `thumb` varchar(100) DEFAULT NULL,
  `metatitle` varchar(100) DEFAULT NULL,
  `metakeyword` varchar(100) DEFAULT NULL,
  `metades` varchar(200) DEFAULT NULL,
  `thumbwidth` int(4) NOT NULL,
  `thumbheight` int(4) NOT NULL,
  `thumb2width` mediumint(4) NOT NULL DEFAULT '0',
  `thumb2height` mediumint(4) NOT NULL DEFAULT '0',
  `thumb3width` mediumint(4) NOT NULL DEFAULT '0',
  `thumb3height` mediumint(4) NOT NULL DEFAULT '0',
  `thumb4width` mediumint(4) NOT NULL DEFAULT '0',
  `thumb4height` mediumint(4) NOT NULL DEFAULT '0',
  `parentid` int(10) NOT NULL DEFAULT '0',
  `channeltemplate` int(10) DEFAULT '1',
  `contenttemplate` int(10) DEFAULT '1',
  `autotype` varchar(10) NOT NULL DEFAULT '',
  `ex` tinyint(1) NOT NULL DEFAULT '0',
  `iscity` tinyint(1) NOT NULL DEFAULT '0',
  `site` int(4) NOT NULL DEFAULT '0',
  `taxis` int(10) NOT NULL DEFAULT '0',
  `lastcreate` int(10) NOT NULL DEFAULT '1400000000',
  `pagesize` smallint(3) NOT NULL DEFAULT '30',
  `specialid` mediumint(4) NOT NULL DEFAULT '0',
  `homepicturechannel` tinyint(1) NOT NULL DEFAULT '0',
  `hometextchannel` tinyint(1) NOT NULL DEFAULT '0',
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parentid` (`parentid`),
  KEY `site` (`site`),
  KEY `taxis` (`taxis`),
  KEY `time` (`time`),
  KEY `specialid` (`specialid`),
  KEY `token` (`token`),
  KEY `isnav` (`isnav`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=216 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_moopha_channel_contentattribute`
--

CREATE TABLE IF NOT EXISTS `wy_moopha_channel_contentattribute` (
  `channelid` int(4) NOT NULL,
  `attributeid` int(4) NOT NULL,
  `taxis` int(4) NOT NULL DEFAULT '0',
  KEY `channelid` (`channelid`),
  KEY `taxis` (`taxis`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wy_moopha_keywords`
--

CREATE TABLE IF NOT EXISTS `wy_moopha_keywords` (
  `id` mediumint(4) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(60) NOT NULL DEFAULT '',
  `link` varchar(150) NOT NULL DEFAULT '',
  `title` varchar(150) NOT NULL DEFAULT '',
  `target` varchar(15) NOT NULL DEFAULT '_blank',
  `time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_moopha_picture`
--

CREATE TABLE IF NOT EXISTS `wy_moopha_picture` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `contentid` int(10) NOT NULL,
  `url` varchar(100) NOT NULL,
  `intro` text NOT NULL,
  `taxis` mediumint(4) NOT NULL DEFAULT '0',
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contentid` (`contentid`),
  KEY `taxis` (`taxis`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_moopha_site`
--

CREATE TABLE IF NOT EXISTS `wy_moopha_site` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `intro` varchar(600) NOT NULL DEFAULT '',
  `picurl` varchar(120) NOT NULL DEFAULT '',
  `token` varchar(50) NOT NULL DEFAULT '',
  `template` varchar(40) NOT NULL DEFAULT '',
  `logourl` varchar(120) NOT NULL DEFAULT '',
  `siteindex` varchar(50) NOT NULL,
  `taxis` int(4) NOT NULL,
  `main` int(1) NOT NULL,
  `abspath` tinyint(1) NOT NULL DEFAULT '0',
  `url` varchar(100) DEFAULT NULL,
  `statisticcode` varchar(600) NOT NULL DEFAULT '',
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `siteindex` (`siteindex`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_moopha_template`
--

CREATE TABLE IF NOT EXISTS `wy_moopha_template` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `path` varchar(200) NOT NULL,
  `generate_path` varchar(200) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1-index,2-channel,3-template,4-singlepage',
  `isdefault` tinyint(1) NOT NULL DEFAULT '0',
  `createhtml` tinyint(1) NOT NULL DEFAULT '1',
  `site` int(4) NOT NULL,
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `isdefault` (`isdefault`),
  KEY `site` (`site`),
  KEY `time` (`time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=561 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_moopha_user`
--

CREATE TABLE IF NOT EXISTS `wy_moopha_user` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `realname` varchar(50) DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `password` char(32) NOT NULL,
  `salt` char(6) NOT NULL,
  `mp` char(11) DEFAULT NULL,
  `qq` varchar(15) DEFAULT '',
  `isadmin` tinyint(1) NOT NULL DEFAULT '0',
  `regip` varchar(30) DEFAULT NULL,
  `regtime` int(10) DEFAULT NULL,
  `lastloginip` varchar(30) DEFAULT NULL,
  `lastlogintime` int(10) DEFAULT NULL,
  `time` int(10) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_nearby_user`
--

CREATE TABLE IF NOT EXISTS `wy_nearby_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(30) NOT NULL,
  `uid` varchar(32) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_node`
--

CREATE TABLE IF NOT EXISTS `wy_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '节点名称',
  `title` varchar(50) NOT NULL COMMENT '菜单名称',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否激活 1：是 2：否',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注说明',
  `pid` smallint(6) unsigned NOT NULL COMMENT '父ID',
  `level` tinyint(1) unsigned NOT NULL COMMENT '节点等级',
  `data` varchar(255) DEFAULT NULL COMMENT '附加参数',
  `sort` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '排序权重',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '菜单显示类型 0:不显示 1:导航菜单 2:左侧菜单',
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100 ;

--
-- 转存表中的数据 `wy_node`
--

INSERT INTO `wy_node` (`id`, `name`, `title`, `status`, `remark`, `pid`, `level`, `data`, `sort`, `display`) VALUES
(1, 'cms', '根节点', 1, '', 0, 1, NULL, 0, 0),
(2, 'Site', '站点管理', 1, '', 1, 0, NULL, 0, 1),
(3, 'User', '用户管理', 1, '', 1, 0, NULL, 0, 1),
(4, 'extent', '扩展管理', 1, '', 1, 0, NULL, 10, 1),
(5, 'article', '内容管理', 1, '', 1, 0, NULL, 0, 1),
(6, 'Site', '站点设置', 1, '', 2, 2, NULL, 0, 2),
(7, 'index', '基本信息设置', 1, '', 6, 3, NULL, 0, 2),
(8, 'safe', '安全设置', 1, '', 6, 3, NULL, 0, 2),
(9, 'email', '邮箱设置', 1, '', 6, 3, NULL, 0, 2),
(10, 'upfile', '附件设置', 1, '', 6, 3, NULL, 0, 2),
(11, 'Node', '节点管理', 1, NULL, 2, 2, NULL, 0, 2),
(12, 'add', '添加节点', 1, '', 11, 3, NULL, 0, 2),
(13, 'index', '节点列表', 1, '', 11, 3, NULL, 0, 2),
(14, 'insert', '写入', 1, '0', 11, 3, NULL, 0, 0),
(15, 'edit', '编辑节点', 1, '0', 11, 3, NULL, 0, 0),
(16, 'update', '更新节点', 1, '0', 11, 3, NULL, 0, 0),
(17, 'del', '删除节点', 1, '0', 11, 3, NULL, 0, 0),
(18, 'User', '用户中心', 1, '0', 3, 2, NULL, 0, 2),
(19, 'add', '添加用户', 1, '0', 18, 3, NULL, 0, 2),
(20, 'index', '用户列表', 1, '0', 18, 3, NULL, 0, 2),
(21, 'edit', '编辑用户', 1, '0', 18, 3, NULL, 0, 0),
(22, 'insert', '写入数据库', 1, '0', 18, 3, NULL, 0, 0),
(23, 'update', '更新用户', 1, '0', 18, 3, NULL, 0, 0),
(24, 'del', '删除用户', 1, '0', 18, 3, NULL, 0, 0),
(25, 'Group', '管理组', 1, '0', 3, 2, NULL, 0, 2),
(26, 'add', '创建用户组', 1, '0', 25, 3, NULL, 0, 2),
(27, 'index', '用户组列表', 1, '0', 25, 3, NULL, 0, 2),
(28, 'edit', '编辑用户组', 1, '0', 25, 3, NULL, 0, 0),
(29, 'del', '删除用户组', 1, '0', 25, 3, NULL, 0, 0),
(30, 'insert', '写入数据库', 1, '0', 25, 3, NULL, 0, 0),
(31, 'update', '更新用户组', 1, '0', 25, 3, NULL, 0, 0),
(32, 'insert', '保存测试', 1, '0', 6, 3, NULL, 0, 0),
(36, 'menu', '左侧栏', 1, '0', 35, 3, NULL, 0, 0),
(35, 'System', '首页', 1, '0', 2, 2, NULL, 0, 0),
(37, 'main', '右侧栏目', 1, '0', 35, 3, NULL, 0, 0),
(38, 'Article', '微信图文', 1, '0', 5, 2, NULL, 0, 2),
(39, 'index', '图文列表', 1, '0', 38, 3, NULL, 0, 2),
(40, 'add', '图文添加', 1, '0', 38, 3, NULL, 0, 2),
(41, 'edit', '微信图文编辑', 1, '0', 38, 3, NULL, 0, 0),
(42, 'del', '微信图文删除', 1, '0', 38, 3, NULL, 0, 0),
(45, 'Function', '功能模块', 1, '0', 1, 0, NULL, 0, 1),
(46, 'Function', '功能模块', 1, '0', 45, 2, NULL, 0, 2),
(47, 'add', '添加模块', 1, '0', 46, 3, NULL, 0, 2),
(48, 'User_group', '会员组', 1, '0', 3, 2, NULL, 0, 2),
(49, 'add', '添加会员组', 1, '0', 48, 3, NULL, 0, 2),
(50, 'Users', '前台用户', 1, '0', 3, 2, NULL, 0, 2),
(51, 'index', '用户列表', 1, '0', 50, 3, NULL, 0, 0),
(52, 'add', '添加用户', 1, '0', 50, 3, NULL, 0, 2),
(53, 'edit', '编辑用户', 1, '0', 50, 3, NULL, 0, 0),
(54, 'del', '删除用户', 1, '0', 50, 3, NULL, 0, 0),
(55, 'insert', '写入数据库', 1, '0', 50, 3, NULL, 0, 0),
(56, 'upsave', '更新用户', 1, '0', 50, 3, NULL, 0, 0),
(57, 'Text', '微信文本', 1, '0', 5, 2, NULL, 0, 2),
(58, 'index', '文本列表', 1, '0', 57, 3, NULL, 0, 2),
(59, 'del', '删除', 1, '0', 57, 3, NULL, 0, 0),
(60, 'Custom', '自定义页面', 1, '0', 5, 2, NULL, 0, 2),
(61, 'index', '列表', 1, '0', 60, 3, NULL, 0, 2),
(62, 'edit', '编辑', 1, '0', 60, 3, NULL, 0, 0),
(63, 'del', '删除', 1, '0', 60, 3, NULL, 0, 0),
(64, 'Records', '充值记录', 1, '0', 4, 2, NULL, 0, 2),
(65, 'index', '充值列表', 1, '0', 64, 3, NULL, 0, 2),
(66, 'Case', '用户案例', 1, '0', 4, 2, NULL, 0, 2),
(67, 'index', '案例列表', 1, '0', 66, 3, NULL, 0, 2),
(68, 'add', '添加案例', 1, '0', 66, 3, NULL, 0, 2),
(69, 'edit', '编辑案例', 1, '0', 66, 3, NULL, 0, 0),
(70, 'del', '删除案例', 1, '0', 66, 3, NULL, 0, 0),
(71, 'insert', '写入数据库', 1, '0', 66, 3, NULL, 0, 0),
(72, 'upsave', '更新数据库', 1, '0', 66, 3, NULL, 0, 0),
(73, 'Links', '友情链接', 1, '0', 4, 2, NULL, 0, 2),
(74, 'index', '友情链接', 1, '0', 73, 3, NULL, 0, 2),
(75, 'add', '添加链接', 1, '0', 73, 3, NULL, 0, 2),
(76, 'edit', '编辑链接', 1, '0', 73, 3, NULL, 0, 0),
(77, 'insert', '插入数据库', 1, '0', 73, 3, NULL, 0, 0),
(78, 'upsave', '更新数据库', 1, '0', 73, 3, NULL, 0, 0),
(79, 'del', '删除友情链接', 1, '0', 73, 3, NULL, 0, 0),
(80, 'token', '公众号管理', 1, '0', 1, 2, NULL, 0, 1),
(81, 'Token', '公众号管理', 1, '0', 80, 2, NULL, 0, 2),
(83, 'alipay', '在线支付接口', 1, '0', 6, 3, NULL, 0, 2),
(84, 'Agent', '代理商管理', 1, '0', 1, 2, NULL, 0, 1),
(85, 'Agent', '代理商管理', 1, '0', 84, 2, NULL, 0, 2),
(86, 'add', '添加', 1, '0', 85, 3, NULL, 0, 2),
(87, 'AgentPrice', '优惠套餐包', 1, '0', 84, 2, NULL, 0, 2),
(88, 'add', '添加', 1, '0', 87, 3, NULL, 0, 2),
(90, 'AgentBuyRecords', '消费记录', 1, '0', 84, 2, NULL, 0, 2),
(91, 'Heartbeat', '心跳设置', 1, NULL, 6, 3, NULL, 0, 2),
(92, 'rippleos_key', '微路由', 1, NULL, 6, 3, NULL, 0, 2),
(93, 'Temp', '认证模板', 1, NULL, 45, 2, NULL, 0, 2),
(94, 'add', '添加模板', 1, NULL, 93, 3, NULL, 0, 2),
(95, 'qianmoban', '模板管理', 1, '0', 6, 3, NULL, 0, 2),
(96, 'huiyuan', '会员模板', 1, '0', 6, 3, NULL, 0, 2),
(97, 'Sys', '系统', 1, '0', 1, 2, NULL, 0, 1),
(98, 'Clear', '清空缓存', 1, '0', 97, 2, NULL, 0, 2),
(99, 'Database', '数据库备份', 1, '0', 97, 2, NULL, 0, 2);

-- --------------------------------------------------------

--
-- 表的结构 `wy_norms`
--

CREATE TABLE IF NOT EXISTS `wy_norms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) unsigned NOT NULL COMMENT '产品参数分类',
  `catid` int(10) unsigned NOT NULL COMMENT '分类ID',
  `value` varchar(150) NOT NULL COMMENT '规格值',
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_ordering_class`
--

CREATE TABLE IF NOT EXISTS `wy_ordering_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `name` varchar(10) NOT NULL,
  `sort` tinyint(2) NOT NULL,
  `info` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_ordering_set`
--

CREATE TABLE IF NOT EXISTS `wy_ordering_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `keyword` varchar(10) NOT NULL,
  `title` varchar(60) NOT NULL,
  `info` varchar(120) NOT NULL,
  `picurl` varchar(100) NOT NULL,
  `flash` text NOT NULL,
  `create_time` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_other`
--

CREATE TABLE IF NOT EXISTS `wy_other` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `keyword` varchar(60) NOT NULL,
  `info` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_panorama`
--

CREATE TABLE IF NOT EXISTS `wy_panorama` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `intro` varchar(300) NOT NULL DEFAULT '',
  `music` varchar(100) NOT NULL DEFAULT '',
  `frontpic` varchar(100) NOT NULL DEFAULT '',
  `rightpic` varchar(100) NOT NULL DEFAULT '',
  `backpic` varchar(100) NOT NULL DEFAULT '',
  `leftpic` varchar(100) NOT NULL DEFAULT '',
  `toppic` varchar(100) NOT NULL DEFAULT '',
  `bottompic` varchar(100) NOT NULL DEFAULT '',
  `keyword` varchar(60) NOT NULL DEFAULT '',
  `time` int(10) NOT NULL DEFAULT '0',
  `taxis` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_paper`
--

CREATE TABLE IF NOT EXISTS `wy_paper` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `token` varchar(40) NOT NULL,
  `keyword` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `pic` varchar(100) DEFAULT NULL,
  `message` text NOT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_payment`
--

CREATE TABLE IF NOT EXISTS `wy_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `pay_name` varchar(40) NOT NULL DEFAULT '',
  `pay_code` varchar(40) NOT NULL DEFAULT '',
  `pay_config` varchar(300) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_photo`
--

CREATE TABLE IF NOT EXISTS `wy_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `title` varchar(20) NOT NULL,
  `picurl` varchar(100) NOT NULL,
  `isshoinfo` tinyint(1) NOT NULL,
  `num` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `create_time` int(11) NOT NULL,
  `info` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_photo_list`
--

CREATE TABLE IF NOT EXISTS `wy_photo_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `pid` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `sort` tinyint(3) NOT NULL,
  `picurl` varchar(100) NOT NULL,
  `create_time` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `info` varchar(120) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_pic_wall`
--

CREATE TABLE IF NOT EXISTS `wy_pic_wall` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `joinnum` int(11) NOT NULL,
  `click` int(11) NOT NULL,
  `token` varchar(30) NOT NULL,
  `keyword` varchar(10) NOT NULL,
  `starpicurl` varchar(100) NOT NULL,
  `title` varchar(60) NOT NULL,
  `sttxt` varchar(200) NOT NULL,
  `statdate` int(11) NOT NULL,
  `enddate` int(11) NOT NULL,
  `info` varchar(200) NOT NULL,
  `endtite` varchar(60) NOT NULL,
  `endpicurl` varchar(100) NOT NULL,
  `endinfo` varchar(60) NOT NULL,
  `status` int(1) NOT NULL,
  `createtime` int(11) NOT NULL,
  `ischeck` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_pic_walllog`
--

CREATE TABLE IF NOT EXISTS `wy_pic_walllog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `token` varchar(60) NOT NULL,
  `picurl` varchar(100) NOT NULL,
  `wecha_id` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `create_time` int(11) NOT NULL,
  `state` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_printer_set`
--

CREATE TABLE IF NOT EXISTS `wy_printer_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `token` varchar(60) NOT NULL,
  `memberCode` varchar(60) NOT NULL,
  `feiyin_key` varchar(60) NOT NULL,
  `deviceNo` varchar(60) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `bwdeviceNo` varchar(20) NOT NULL,
  `printpage` int(2) NOT NULL DEFAULT '1',
  `printtype` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_product`
--

CREATE TABLE IF NOT EXISTS `wy_product` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `catid` mediumint(4) NOT NULL DEFAULT '0',
  `storeid` mediumint(4) NOT NULL DEFAULT '0',
  `name` varchar(150) NOT NULL DEFAULT '',
  `price` float NOT NULL DEFAULT '0',
  `oprice` float NOT NULL DEFAULT '0',
  `discount` float NOT NULL DEFAULT '10',
  `intro` text NOT NULL,
  `token` varchar(50) NOT NULL,
  `keyword` varchar(100) NOT NULL DEFAULT '',
  `salecount` mediumint(4) NOT NULL DEFAULT '0',
  `logourl` varchar(150) NOT NULL DEFAULT '',
  `dining` tinyint(1) NOT NULL DEFAULT '0',
  `groupon` tinyint(1) NOT NULL DEFAULT '0',
  `endtime` int(10) NOT NULL DEFAULT '0',
  `starttime` int(10) NOT NULL,
  `fakemembercount` mediumint(4) NOT NULL DEFAULT '0',
  `time` int(10) NOT NULL DEFAULT '0',
  `sort` int(10) NOT NULL,
  `vprice` float NOT NULL,
  `mailprice` float NOT NULL,
  `num` int(10) NOT NULL,
  `cid` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `gid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`,`storeid`),
  KEY `catid_2` (`catid`),
  KEY `storeid` (`storeid`),
  KEY `token` (`token`),
  KEY `price` (`price`),
  KEY `oprice` (`oprice`),
  KEY `discount` (`discount`),
  KEY `dining` (`dining`),
  KEY `groupon` (`groupon`,`endtime`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_product_attribute`
--

CREATE TABLE IF NOT EXISTS `wy_product_attribute` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(10) unsigned NOT NULL COMMENT '属性ID',
  `pid` int(10) unsigned NOT NULL COMMENT '商品ID',
  `name` varchar(100) NOT NULL COMMENT '属性名',
  `value` varchar(100) NOT NULL COMMENT '属性值',
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_product_cart`
--

CREATE TABLE IF NOT EXISTS `wy_product_cart` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL DEFAULT '',
  `wecha_id` varchar(60) NOT NULL DEFAULT '',
  `info` longtext,
  `total` mediumint(4) NOT NULL DEFAULT '0',
  `price` float NOT NULL DEFAULT '0',
  `truename` varchar(20) NOT NULL DEFAULT '',
  `tel` varchar(14) NOT NULL DEFAULT '',
  `address` varchar(100) NOT NULL DEFAULT '',
  `diningtype` mediumint(2) NOT NULL DEFAULT '0',
  `tableid` mediumint(4) NOT NULL DEFAULT '0',
  `time` int(10) NOT NULL DEFAULT '0',
  `buytime` varchar(100) NOT NULL DEFAULT '',
  `groupon` tinyint(1) NOT NULL DEFAULT '0',
  `dining` tinyint(1) NOT NULL DEFAULT '0',
  `year` mediumint(4) NOT NULL DEFAULT '0',
  `month` mediumint(4) NOT NULL DEFAULT '0',
  `day` mediumint(4) NOT NULL DEFAULT '0',
  `hour` smallint(4) NOT NULL DEFAULT '0',
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  `orderid` varchar(40) NOT NULL DEFAULT '',
  `sent` tinyint(1) NOT NULL DEFAULT '0',
  `logistics` varchar(70) NOT NULL DEFAULT '',
  `logisticsid` varchar(50) NOT NULL DEFAULT '',
  `printed` tinyint(1) NOT NULL DEFAULT '0',
  `handled` tinyint(1) NOT NULL DEFAULT '0',
  `transactionid` varchar(100) NOT NULL,
  `paytype` varchar(30) NOT NULL,
  `productid` int(10) NOT NULL,
  `code` varchar(50) NOT NULL,
  `handledtime` int(10) NOT NULL,
  `handleduid` int(10) NOT NULL,
  `score` int(10) NOT NULL,
  `paymode` tinyint(1) NOT NULL,
  `ordertype` mediumint(2) NOT NULL,
  `beizhu` varchar(500) DEFAULT NULL,
  `phone` varchar(20) NOT NULL COMMENT ' 手机',
  `phone_status` int(1) NOT NULL COMMENT ' 电话开关',
  `email` varchar(255) NOT NULL COMMENT ' 邮箱',
  `email_status` int(1) NOT NULL COMMENT ' 邮箱开关',
  `diningshopid` int(3) NOT NULL,
  `cid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`,`time`),
  KEY `groupon` (`groupon`),
  KEY `dining` (`dining`),
  KEY `printed` (`printed`),
  KEY `year` (`year`,`month`,`day`,`hour`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_product_cart_list`
--

CREATE TABLE IF NOT EXISTS `wy_product_cart_list` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cartid` int(10) NOT NULL DEFAULT '0',
  `productid` int(10) NOT NULL DEFAULT '0',
  `price` float NOT NULL DEFAULT '0',
  `total` mediumint(4) NOT NULL DEFAULT '0',
  `wecha_id` varchar(60) NOT NULL DEFAULT '',
  `token` varchar(50) NOT NULL DEFAULT '',
  `time` int(10) NOT NULL DEFAULT '0',
  `cid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cartid` (`cartid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_product_cat`
--

CREATE TABLE IF NOT EXISTS `wy_product_cat` (
  `id` mediumint(4) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL,
  `des` varchar(500) NOT NULL DEFAULT '',
  `parentid` mediumint(4) NOT NULL,
  `logourl` varchar(100) NOT NULL,
  `dining` tinyint(1) NOT NULL DEFAULT '0',
  `time` int(10) NOT NULL,
  `norms` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `cid` int(10) unsigned NOT NULL,
  `isfinal` tinyint(1) NOT NULL DEFAULT '1',
  `sort` tinyint(3) NOT NULL DEFAULT '0',
  `recommended` tinyint(1) DEFAULT '0',
  `sorts` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parentid` (`parentid`),
  KEY `token` (`token`),
  KEY `dining` (`dining`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_product_comment`
--

CREATE TABLE IF NOT EXISTS `wy_product_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(10) unsigned NOT NULL,
  `token` varchar(50) NOT NULL,
  `cartid` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL,
  `detailid` int(10) unsigned NOT NULL,
  `wecha_id` varchar(60) NOT NULL,
  `truename` varchar(20) NOT NULL,
  `tel` varchar(14) NOT NULL,
  `content` varchar(500) NOT NULL,
  `productinfo` varchar(80) NOT NULL,
  `score` tinyint(1) unsigned NOT NULL,
  `dateline` int(10) unsigned NOT NULL,
  `isdelete` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `wecha_id` (`wecha_id`),
  KEY `token` (`token`),
  KEY `cartid` (`cartid`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_product_detail`
--

CREATE TABLE IF NOT EXISTS `wy_product_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '商品ID',
  `format` varchar(100) NOT NULL COMMENT '商品的规格（大小）',
  `color` varchar(100) NOT NULL COMMENT '颜色',
  `num` int(10) unsigned NOT NULL COMMENT '数量',
  `price` float NOT NULL COMMENT '价格',
  `vprice` float NOT NULL,
  `logo` varchar(200) NOT NULL COMMENT '图标',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_product_diningtable`
--

CREATE TABLE IF NOT EXISTS `wy_product_diningtable` (
  `id` mediumint(4) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(60) NOT NULL DEFAULT '',
  `intro` varchar(500) NOT NULL DEFAULT '',
  `taxis` mediumint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_product_group`
--

CREATE TABLE IF NOT EXISTS `wy_product_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_product_image`
--

CREATE TABLE IF NOT EXISTS `wy_product_image` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL COMMENT '商品ID',
  `image` varchar(200) NOT NULL COMMENT '图片地址',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_product_mail_price`
--

CREATE TABLE IF NOT EXISTS `wy_product_mail_price` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `price` float NOT NULL COMMENT '满多少元免邮费',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_product_relation`
--

CREATE TABLE IF NOT EXISTS `wy_product_relation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gid` int(10) unsigned NOT NULL,
  `cid` int(10) unsigned NOT NULL,
  `token` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gid` (`gid`),
  KEY `token` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_product_setting`
--

CREATE TABLE IF NOT EXISTS `wy_product_setting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `score` float NOT NULL,
  `paymode` tinyint(1) unsigned NOT NULL,
  `phone` varchar(20) NOT NULL COMMENT ' 手机',
  `phone_status` int(1) NOT NULL COMMENT ' 电话开关',
  `email` varchar(255) NOT NULL COMMENT ' 邮箱',
  `email_status` int(1) NOT NULL COMMENT ' 邮箱开关',
  `cid` int(10) NOT NULL,
  `headerbackgroud` text NOT NULL,
  `isgroup` tinyint(1) NOT NULL,
  `headerid` int(10) NOT NULL,
  `tpid` int(10) NOT NULL,
  `footerid` int(10) NOT NULL,
  `groupon` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_punish`
--

CREATE TABLE IF NOT EXISTS `wy_punish` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` char(25) NOT NULL,
  `title` char(40) NOT NULL,
  `keyword` char(20) NOT NULL,
  `pic` char(120) NOT NULL,
  `name` char(10) NOT NULL,
  `use_num` int(11) NOT NULL,
  `info` varchar(500) NOT NULL,
  `is_open` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_punish_item`
--

CREATE TABLE IF NOT EXISTS `wy_punish_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` char(25) NOT NULL,
  `pid` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `is_show` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_pyiliao`
--

CREATE TABLE IF NOT EXISTS `wy_pyiliao` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `topic` varchar(200) DEFAULT NULL,
  `info` varchar(500) DEFAULT NULL,
  `statdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_pyiliao_order`
--

CREATE TABLE IF NOT EXISTS `wy_pyiliao_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `token` varchar(40) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `memo` varchar(200) DEFAULT NULL,
  `type` smallint(4) NOT NULL DEFAULT '0',
  `wecha_id` varchar(200) DEFAULT NULL,
  `yuyuename` varchar(20) DEFAULT NULL,
  `bingzhong` varchar(100) DEFAULT NULL,
  `keshi` varchar(60) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_recognition`
--

CREATE TABLE IF NOT EXISTS `wy_recognition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `title` varchar(60) NOT NULL,
  `attention_num` int(5) NOT NULL,
  `keyword` varchar(60) NOT NULL,
  `code_url` varchar(200) NOT NULL,
  `scene_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_red_packet`
--

CREATE TABLE IF NOT EXISTS `wy_red_packet` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` char(25) NOT NULL,
  `title` char(40) NOT NULL,
  `keyword` char(30) NOT NULL,
  `msg_pic` char(120) NOT NULL,
  `desc` varchar(200) NOT NULL,
  `info` text NOT NULL,
  `start_time` char(11) NOT NULL,
  `end_time` char(11) NOT NULL,
  `ext_total` mediumint(8) unsigned NOT NULL,
  `get_number` smallint(5) unsigned NOT NULL,
  `value_count` mediumint(8) unsigned NOT NULL,
  `is_open` enum('0','1') NOT NULL,
  `item_num` mediumint(9) NOT NULL,
  `item_sum` mediumint(9) NOT NULL,
  `item_max` mediumint(9) NOT NULL,
  `item_unit` varchar(30) NOT NULL,
  `packet_type` enum('1','2') NOT NULL,
  `deci` smallint(6) NOT NULL,
  `people` mediumint(9) NOT NULL,
  `password` char(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_red_packet_exchange`
--

CREATE TABLE IF NOT EXISTS `wy_red_packet_exchange` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` char(25) NOT NULL,
  `wecha_id` char(50) NOT NULL,
  `packet_id` int(11) NOT NULL,
  `price` char(10) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `type_name` char(45) NOT NULL,
  `time` char(11) NOT NULL,
  `log_id` text NOT NULL,
  `mobile` char(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_red_packet_log`
--

CREATE TABLE IF NOT EXISTS `wy_red_packet_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `add_time` char(11) NOT NULL,
  `token` char(25) NOT NULL,
  `packet_id` int(11) NOT NULL,
  `prize_id` int(11) NOT NULL,
  `prize_name` char(40) NOT NULL,
  `worth` decimal(10,2) NOT NULL,
  `is_reward` enum('0','1','2') NOT NULL,
  `type` enum('1','2') NOT NULL,
  `code` char(40) NOT NULL,
  `wecha_id` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_red_packet_prize`
--

CREATE TABLE IF NOT EXISTS `wy_red_packet_prize` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` char(25) NOT NULL,
  `type` enum('1','2') NOT NULL,
  `name` char(40) NOT NULL,
  `worth` int(11) NOT NULL,
  `num` mediumint(9) NOT NULL,
  `odds` decimal(10,0) NOT NULL,
  `sue` mediumint(9) NOT NULL,
  `is_open` enum('0','1') NOT NULL,
  `packet_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_red_packet_reward`
--

CREATE TABLE IF NOT EXISTS `wy_red_packet_reward` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` char(25) NOT NULL,
  `wecha_id` char(50) NOT NULL,
  `mobile` char(11) NOT NULL,
  `wxname` char(40) NOT NULL,
  `packet_id` int(11) NOT NULL,
  `log_id` int(11) NOT NULL,
  `add_time` char(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_reply`
--

CREATE TABLE IF NOT EXISTS `wy_reply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `wecha_id` varchar(60) NOT NULL DEFAULT '',
  `differ` tinyint(1) NOT NULL DEFAULT '0',
  `checked` tinyint(1) NOT NULL DEFAULT '0',
  `message_id` int(11) NOT NULL,
  `reply` varchar(1000) NOT NULL,
  `time` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `message_id` (`message_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_reply_info`
--

CREATE TABLE IF NOT EXISTS `wy_reply_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `title` varchar(30) NOT NULL DEFAULT '',
  `picurl` varchar(120) NOT NULL DEFAULT '',
  `picurls1url` varchar(300) NOT NULL,
  `picurls1` varchar(300) NOT NULL,
  `picurls2url` varchar(300) NOT NULL,
  `picurls2` varchar(300) NOT NULL,
  `picurls3url` varchar(300) NOT NULL,
  `picurls3` varchar(300) NOT NULL,
  `info` varchar(120) NOT NULL DEFAULT '',
  `infotype` varchar(20) NOT NULL DEFAULT '',
  `diningyuding` tinyint(1) NOT NULL DEFAULT '1',
  `diningwaimai` tinyint(1) NOT NULL DEFAULT '1',
  `config` text NOT NULL,
  `apiurl` varchar(200) NOT NULL,
  `homepic` varchar(200) NOT NULL,
  `keyword` varchar(50) NOT NULL,
  `copyright` varchar(100) NOT NULL,
  `picurls` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_requestdata`
--

CREATE TABLE IF NOT EXISTS `wy_requestdata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `day` int(2) NOT NULL,
  `time` int(11) NOT NULL,
  `textnum` int(5) NOT NULL,
  `imgnum` int(5) NOT NULL,
  `videonum` int(5) NOT NULL,
  `other` int(5) NOT NULL,
  `follownum` int(5) NOT NULL,
  `unfollownum` int(5) NOT NULL,
  `3g` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=207 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_reservation`
--

CREATE TABLE IF NOT EXISTS `wy_reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `keyword` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `picurl` varchar(200) NOT NULL,
  `addtype` varchar(15) NOT NULL,
  `address` varchar(50) NOT NULL,
  `place` varchar(50) NOT NULL,
  `lng` varchar(13) NOT NULL,
  `lat` varchar(13) NOT NULL,
  `tel` varchar(13) NOT NULL,
  `headpic` varchar(200) NOT NULL,
  `info` varchar(200) NOT NULL,
  `typename` varchar(50) NOT NULL,
  `typename2` varchar(50) NOT NULL,
  `typename3` varchar(50) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `date` varchar(50) NOT NULL,
  `allnums` varchar(50) NOT NULL,
  `name_show` tinyint(4) NOT NULL DEFAULT '1',
  `time_show` tinyint(4) NOT NULL DEFAULT '1',
  `txt1` varchar(50) NOT NULL,
  `value1` varchar(50) NOT NULL,
  `txt2` varchar(50) NOT NULL,
  `value2` varchar(50) NOT NULL,
  `txt3` varchar(50) NOT NULL,
  `value3` varchar(50) NOT NULL,
  `txt4` varchar(50) NOT NULL,
  `value4` varchar(50) NOT NULL,
  `txt5` varchar(50) NOT NULL,
  `value5` varchar(50) NOT NULL,
  `select1` varchar(50) NOT NULL,
  `svalue1` varchar(100) NOT NULL,
  `select2` varchar(50) NOT NULL,
  `svalue2` varchar(100) NOT NULL,
  `select3` varchar(50) NOT NULL,
  `svalue3` varchar(100) NOT NULL,
  `select4` varchar(50) NOT NULL,
  `svalue4` varchar(100) NOT NULL,
  `select5` varchar(50) NOT NULL,
  `svalue5` varchar(100) NOT NULL,
  `datename` varchar(100) NOT NULL,
  `take` int(11) NOT NULL DEFAULT '1',
  `email` varchar(30) NOT NULL,
  `open_email` tinyint(4) NOT NULL DEFAULT '0',
  `sms` varchar(13) NOT NULL,
  `open_sms` tinyint(4) NOT NULL DEFAULT '0',
  `thetype` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_reservebook`
--

CREATE TABLE IF NOT EXISTS `wy_reservebook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) NOT NULL,
  `token` varchar(50) NOT NULL,
  `wecha_id` varchar(50) NOT NULL,
  `truename` varchar(50) NOT NULL,
  `tel` varchar(13) NOT NULL,
  `housetype` varchar(50) NOT NULL,
  `dateline` varchar(50) NOT NULL,
  `timepart` varchar(50) NOT NULL,
  `info` varchar(100) NOT NULL,
  `type` char(15) NOT NULL,
  `booktime` int(11) NOT NULL,
  `remate` tinyint(3) NOT NULL DEFAULT '0',
  `kfinfo` varchar(100) NOT NULL,
  `estate_saler` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`),
  KEY `wecha_id` (`wecha_id`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_role`
--

CREATE TABLE IF NOT EXISTS `wy_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '后台组名',
  `pid` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '是否激活 1：是 0：否',
  `sort` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '排序权重',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注说明',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `wy_role`
--

INSERT INTO `wy_role` (`id`, `name`, `pid`, `status`, `sort`, `remark`) VALUES
(5, '超级管理员', 0, 1, 0, ''),
(6, '演示组', 0, 1, 0, ''),
(9, '普通会员', 0, 1, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `wy_role_user`
--

CREATE TABLE IF NOT EXISTS `wy_role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` smallint(6) unsigned NOT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wy_scene`
--

CREATE TABLE IF NOT EXISTS `wy_scene` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `keyword` varchar(200) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `picurl` varchar(5000) NOT NULL,
  `info` varchar(255) NOT NULL,
  `name` char(11) NOT NULL,
  `ca` varchar(255) NOT NULL,
  `catp` varchar(255) NOT NULL,
  `tph` varchar(255) NOT NULL,
  `musicurl` varchar(255) NOT NULL,
  `share` varchar(255) NOT NULL,
  `sharean` varchar(255) NOT NULL,
  `sharetp` varchar(255) NOT NULL,
  `sharetstp` varchar(255) NOT NULL,
  `sharetitle` varchar(255) NOT NULL,
  `miaosu` varchar(255) NOT NULL,
  `click` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_scenepin`
--

CREATE TABLE IF NOT EXISTS `wy_scenepin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `keyword` varchar(200) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `picurl` varchar(5000) NOT NULL,
  `info` varchar(255) NOT NULL,
  `name` char(11) NOT NULL,
  `ca` varchar(255) NOT NULL,
  `catp` varchar(255) NOT NULL,
  `tph` varchar(255) NOT NULL,
  `musicurl` varchar(255) NOT NULL,
  `share` varchar(255) NOT NULL,
  `sharean` varchar(255) NOT NULL,
  `sharetp` varchar(255) NOT NULL,
  `sharetstp` varchar(255) NOT NULL,
  `sharetitle` varchar(255) NOT NULL,
  `miaosu` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_scenepin_addtp`
--

CREATE TABLE IF NOT EXISTS `wy_scenepin_addtp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `pid` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `sort` tinyint(3) NOT NULL,
  `picurl` varchar(100) NOT NULL,
  `create_time` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `info` varchar(120) NOT NULL,
  `style1` tinyint(1) NOT NULL DEFAULT '0',
  `cover` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `lng` double NOT NULL,
  `lat` double NOT NULL,
  `address` varchar(255) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `ad` varchar(255) NOT NULL,
  `wechat` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_scene_addtp`
--

CREATE TABLE IF NOT EXISTS `wy_scene_addtp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bd` int(11) NOT NULL,
  `token` varchar(60) NOT NULL,
  `pid` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `sort` tinyint(3) NOT NULL,
  `picurl` varchar(100) NOT NULL,
  `create_time` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `info` varchar(120) NOT NULL,
  `style1` tinyint(1) NOT NULL DEFAULT '0',
  `cover` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `lng` double NOT NULL,
  `lat` double NOT NULL,
  `address` varchar(255) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `ad` varchar(255) NOT NULL,
  `wechat` varchar(255) NOT NULL,
  `bdname` varchar(255) NOT NULL,
  `bdtitle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_selfform`
--

CREATE TABLE IF NOT EXISTS `wy_selfform` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `token` varchar(30) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `keyword` varchar(100) NOT NULL DEFAULT '',
  `intro` varchar(400) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `time` int(10) NOT NULL DEFAULT '0',
  `successtip` varchar(60) NOT NULL DEFAULT '',
  `failtip` varchar(60) NOT NULL DEFAULT '',
  `endtime` int(10) NOT NULL DEFAULT '0',
  `logourl` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `token` (`token`),
  KEY `endtime` (`endtime`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_selfform_input`
--

CREATE TABLE IF NOT EXISTS `wy_selfform_input` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `formid` int(10) NOT NULL DEFAULT '0',
  `displayname` varchar(30) NOT NULL DEFAULT '',
  `fieldname` varchar(30) NOT NULL DEFAULT '',
  `inputtype` varchar(20) NOT NULL DEFAULT '',
  `options` varchar(200) NOT NULL DEFAULT '',
  `require` tinyint(1) NOT NULL DEFAULT '0',
  `regex` varchar(100) NOT NULL DEFAULT '',
  `taxis` mediumint(4) NOT NULL DEFAULT '0',
  `errortip` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `formid` (`formid`,`taxis`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_selfform_value`
--

CREATE TABLE IF NOT EXISTS `wy_selfform_value` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `formid` int(10) NOT NULL DEFAULT '0',
  `wecha_id` varchar(50) NOT NULL DEFAULT '',
  `values` varchar(2000) NOT NULL DEFAULT '',
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `formid` (`formid`,`wecha_id`,`time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_send_message`
--

CREATE TABLE IF NOT EXISTS `wy_send_message` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `msg_id` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `token` varchar(30) NOT NULL DEFAULT '',
  `msgtype` varchar(30) NOT NULL DEFAULT '',
  `text` varchar(800) NOT NULL DEFAULT '',
  `imgids` varchar(200) NOT NULL DEFAULT '',
  `mediasrc` varchar(200) NOT NULL DEFAULT '',
  `mediaid` varchar(100) NOT NULL DEFAULT '',
  `reachcount` int(10) NOT NULL DEFAULT '0',
  `groupid` int(10) NOT NULL DEFAULT '0',
  `time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `token` (`token`,`time`),
  KEY `msg_id` (`msg_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_service_logs`
--

CREATE TABLE IF NOT EXISTS `wy_service_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `openid` varchar(60) NOT NULL,
  `enddate` int(11) NOT NULL,
  `keyword` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_service_user`
--

CREATE TABLE IF NOT EXISTS `wy_service_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `token` varchar(60) NOT NULL,
  `userName` varchar(60) NOT NULL,
  `userPwd` varchar(32) NOT NULL,
  `endJoinDate` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_setinfo`
--

CREATE TABLE IF NOT EXISTS `wy_setinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `value` varchar(200) DEFAULT NULL,
  `kind` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `memberCode` varchar(32) NOT NULL,
  `feiyin_key` varchar(32) NOT NULL,
  `pringNum` int(1) NOT NULL,
  `print_status` int(1) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `phone_status` int(1) NOT NULL,
  `email` varchar(20) NOT NULL,
  `email_status` int(1) NOT NULL,
  `printtype` varchar(10) NOT NULL,
  `printpage` int(2) NOT NULL,
  `deviceNo` varchar(20) NOT NULL,
  `deviceNo1` varchar(20) NOT NULL,
  `deviceNo2` varchar(20) NOT NULL,
  `bwdeviceNo` varchar(20) NOT NULL,
  `bwdeviceNo1` varchar(20) NOT NULL,
  `bwdeviceNo2` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_shake`
--

CREATE TABLE IF NOT EXISTS `wy_shake` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `isact` int(1) NOT NULL DEFAULT '0',
  `acttitle` varchar(40) NOT NULL,
  `isopen` int(1) NOT NULL DEFAULT '0',
  `clienttime` int(11) NOT NULL DEFAULT '3',
  `showtime` int(10) NOT NULL DEFAULT '3',
  `shownum` int(11) NOT NULL DEFAULT '10',
  `pass` varchar(150) DEFAULT NULL,
  `joinnum` int(11) DEFAULT NULL,
  `shaketype` int(11) NOT NULL DEFAULT '1',
  `token` varchar(40) NOT NULL,
  `createtime` varchar(13) NOT NULL,
  `endtime` varchar(13) DEFAULT NULL,
  `pass2` varchar(150) DEFAULT NULL,
  `pass3` varchar(150) DEFAULT NULL,
  `starttime` int(11) NOT NULL,
  `endshake` int(11) NOT NULL,
  `qrcode` varchar(150) DEFAULT NULL,
  `title` varchar(40) NOT NULL DEFAULT '0',
  `keyword` varchar(100) NOT NULL DEFAULT '0',
  `intro` varchar(400) NOT NULL DEFAULT '0',
  `thumb` varchar(200) NOT NULL DEFAULT '0',
  `background` varchar(150) DEFAULT '0',
  `backgroundmusic` varchar(150) DEFAULT '0',
  `music` varchar(150) DEFAULT '0',
  `usetime` int(10) NOT NULL DEFAULT '0',
  `rule` varchar(600) NOT NULL DEFAULT '0',
  `info` varchar(600) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_shakelog`
--

CREATE TABLE IF NOT EXISTS `wy_shakelog` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL,
  `token` varchar(40) NOT NULL,
  `mark` longtext,
  `endtime` int(15) NOT NULL,
  `joinnum` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_shake_rt`
--

CREATE TABLE IF NOT EXISTS `wy_shake_rt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wecha_id` varchar(60) NOT NULL DEFAULT '',
  `token` varchar(30) NOT NULL DEFAULT '',
  `phone` varchar(12) NOT NULL DEFAULT '',
  `count` int(10) NOT NULL DEFAULT '0',
  `shakeid` int(10) NOT NULL DEFAULT '0',
  `round` mediumint(9) NOT NULL,
  `is_scene` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shakeid` (`shakeid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_share`
--

CREATE TABLE IF NOT EXISTS `wy_share` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(30) NOT NULL DEFAULT '',
  `moduleid` int(10) NOT NULL DEFAULT '0',
  `token` varchar(30) NOT NULL DEFAULT '',
  `wecha_id` varchar(80) NOT NULL DEFAULT '',
  `to` varchar(30) NOT NULL DEFAULT '',
  `time` int(11) NOT NULL,
  `url` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `module` (`module`,`moduleid`,`token`,`time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_sharetalent`
--

CREATE TABLE IF NOT EXISTS `wy_sharetalent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `title` varchar(255) NOT NULL,
  `picurl` varchar(255) NOT NULL,
  `prize` varchar(255) NOT NULL,
  `rule` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `info` mediumtext NOT NULL,
  `statdate` int(11) NOT NULL,
  `date` date NOT NULL,
  `hdrules` mediumtext NOT NULL,
  `picurl1` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `click` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_sharetalent_record`
--

CREATE TABLE IF NOT EXISTS `wy_sharetalent_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `tel` varchar(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `statdate` int(11) NOT NULL,
  `wecha_id` varchar(100) NOT NULL,
  `pid` int(11) NOT NULL,
  `click` int(11) NOT NULL,
  `rule` int(11) NOT NULL,
  `prize` varchar(255) NOT NULL,
  `end` int(11) NOT NULL,
  `picurl` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `number` int(11) NOT NULL,
  `statu` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_sharetalent_reply`
--

CREATE TABLE IF NOT EXISTS `wy_sharetalent_reply` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `info` varchar(500) DEFAULT NULL COMMENT '公司简介',
  `title` text NOT NULL,
  `tp` char(255) NOT NULL,
  `copyright` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_sharetalent_sm`
--

CREATE TABLE IF NOT EXISTS `wy_sharetalent_sm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `info` mediumtext NOT NULL,
  `infos` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_sharetalent_user`
--

CREATE TABLE IF NOT EXISTS `wy_sharetalent_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `wecha_id` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tel` varchar(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_sharetalent_userip`
--

CREATE TABLE IF NOT EXISTS `wy_sharetalent_userip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `pid` int(11) NOT NULL,
  `enterdate` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_share_set`
--

CREATE TABLE IF NOT EXISTS `wy_share_set` (
  `token` varchar(40) NOT NULL DEFAULT '',
  `score` int(5) NOT NULL DEFAULT '0',
  `daylimit` int(5) NOT NULL DEFAULT '1',
  KEY `token` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wy_share_set`
--

INSERT INTO `wy_share_set` (`token`, `score`, `daylimit`) VALUES
('aujvne1405163386', 1, 111);

-- --------------------------------------------------------

--
-- 表的结构 `wy_sign_conf`
--

CREATE TABLE IF NOT EXISTS `wy_sign_conf` (
  `conf_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `use` enum('0','1') NOT NULL,
  `integral` tinyint(4) NOT NULL,
  `stair` tinyint(4) NOT NULL,
  `token` char(25) NOT NULL,
  PRIMARY KEY (`conf_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_sign_in`
--

CREATE TABLE IF NOT EXISTS `wy_sign_in` (
  `sign_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` char(40) NOT NULL,
  `wecha_id` char(60) NOT NULL,
  `user_name` char(50) NOT NULL,
  `integral` tinyint(4) NOT NULL,
  `time` char(11) NOT NULL,
  `continue` tinyint(2) NOT NULL,
  `phone` char(11) NOT NULL,
  `set_id` int(11) NOT NULL,
  PRIMARY KEY (`sign_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_sign_set`
--

CREATE TABLE IF NOT EXISTS `wy_sign_set` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `keywords` char(25) NOT NULL,
  `title` char(60) NOT NULL,
  `content` varchar(250) NOT NULL,
  `token` char(35) NOT NULL,
  `reply_img` char(150) NOT NULL,
  `top_pic` char(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_site_plugmenu`
--

CREATE TABLE IF NOT EXISTS `wy_site_plugmenu` (
  `token` varchar(60) NOT NULL DEFAULT '',
  `name` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(20) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `taxis` mediumint(4) NOT NULL DEFAULT '0',
  `display` tinyint(1) NOT NULL DEFAULT '0',
  KEY `token` (`token`,`taxis`,`display`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wy_site_plugmenu`
--

INSERT INTO `wy_site_plugmenu` (`token`, `name`, `title`, `url`, `taxis`, `display`) VALUES
('aujvne1405163386', 'tel', '', '', 0, 0),
('aujvne1405163386', 'memberinfo', '', '', 0, 0),
('aujvne1405163386', 'nav', '', '', 0, 0),
('aujvne1405163386', 'message', '', NULL, 0, 0),
('aujvne1405163386', 'share', '', '', 0, 0),
('aujvne1405163386', 'home', '', '', 0, 0),
('aujvne1405163386', 'album', '', '', 0, 0),
('aujvne1405163386', 'email', '', '', 0, 0),
('aujvne1405163386', 'shopping', '', '', 0, 0),
('aujvne1405163386', 'membercard', '', '', 0, 0),
('aujvne1405163386', 'activity', '', '', 0, 0),
('aujvne1405163386', 'weibo', '', '', 0, 0),
('aujvne1405163386', 'tencentweibo', '', '', 0, 0),
('aujvne1405163386', 'qqzone', '', '', 0, 0),
('aujvne1405163386', 'wechat', '', '', 0, 0),
('aujvne1405163386', 'music', '', '', 0, 0),
('aujvne1405163386', 'video', '', '', 0, 0),
('aujvne1405163386', 'recommend', '', '', 0, 0),
('aujvne1405163386', 'other', '', '', 0, 0),
('lbatdt1406991458', 'tel', '', '', 0, 0),
('lbatdt1406991458', 'memberinfo', '', '', 0, 0),
('lbatdt1406991458', 'nav', '', '', 0, 0),
('lbatdt1406991458', 'message', '', NULL, 0, 0),
('lbatdt1406991458', 'share', '', '', 0, 0),
('lbatdt1406991458', 'home', '', '', 0, 0),
('lbatdt1406991458', 'album', '', '', 0, 0),
('lbatdt1406991458', 'email', '', '', 0, 0),
('lbatdt1406991458', 'shopping', '', '', 0, 0),
('lbatdt1406991458', 'membercard', '', '', 0, 0),
('lbatdt1406991458', 'activity', '', '', 0, 0),
('lbatdt1406991458', 'weibo', '', '', 0, 0),
('lbatdt1406991458', 'tencentweibo', '', '', 0, 0),
('lbatdt1406991458', 'qqzone', '', '', 0, 0),
('lbatdt1406991458', 'wechat', '', '', 0, 0),
('lbatdt1406991458', 'music', '', '', 0, 0),
('lbatdt1406991458', 'video', '', '', 0, 0),
('lbatdt1406991458', 'recommend', '', '', 0, 0),
('lbatdt1406991458', 'other', '', '', 0, 0),
('mhrnmj1408192006', 'tel', '', '', 0, 0),
('mhrnmj1408192006', 'memberinfo', '', '', 0, 0),
('mhrnmj1408192006', 'nav', '', '', 0, 0),
('mhrnmj1408192006', 'message', '', '', 0, 0),
('mhrnmj1408192006', 'share', '', '', 0, 0),
('mhrnmj1408192006', 'home', '', '', 0, 0),
('mhrnmj1408192006', 'album', '', '', 0, 0),
('mhrnmj1408192006', 'email', '', '', 0, 0),
('mhrnmj1408192006', 'shopping', '', '', 0, 0),
('mhrnmj1408192006', 'membercard', '', '', 0, 0),
('mhrnmj1408192006', 'activity', '', '', 0, 0),
('mhrnmj1408192006', 'weibo', '', '', 0, 0),
('mhrnmj1408192006', 'tencentweibo', '', '', 0, 0),
('mhrnmj1408192006', 'qqzone', '', '', 0, 0),
('mhrnmj1408192006', 'wechat', '', '', 0, 0),
('mhrnmj1408192006', 'music', '', '', 0, 0),
('mhrnmj1408192006', 'video', '', '', 0, 0),
('mhrnmj1408192006', 'recommend', '', '', 0, 0),
('mhrnmj1408192006', 'other', '', '', 0, 0),
('piawnl1410399190', 'recommend', '', '', 0, 0),
('piawnl1410399190', 'video', '', '', 0, 0),
('piawnl1410399190', 'music', '', '', 0, 0),
('piawnl1410399190', 'wechat', '', '', 0, 0),
('piawnl1410399190', 'qqzone', '', '', 0, 0),
('piawnl1410399190', 'tencentweibo', '', '', 0, 0),
('piawnl1410399190', 'weibo', '', '', 0, 0),
('piawnl1410399190', 'activity', '', '', 0, 0),
('piawnl1410399190', 'membercard', '', '', 0, 0),
('piawnl1410399190', 'shopping', '', '', 0, 0),
('piawnl1410399190', 'email', '', '', 0, 0),
('piawnl1410399190', 'album', '', '', 0, 0),
('piawnl1410399190', 'home', '', '', 0, 0),
('piawnl1410399190', 'share', '', '', 0, 0),
('piawnl1410399190', 'message', '', '', 0, 0),
('piawnl1410399190', 'nav', '', '', 0, 0),
('piawnl1410399190', 'memberinfo', '', '', 0, 0),
('piawnl1410399190', 'tel', '', '', 0, 0),
('piawnl1410399190', 'other', '', '', 0, 0),
('wqdzsg1410169853', 'tel', '', '', 0, 0),
('wqdzsg1410169853', 'memberinfo', '', '', 0, 0),
('wqdzsg1410169853', 'nav', '', '', 0, 0),
('wqdzsg1410169853', 'message', '', '', 0, 0),
('wqdzsg1410169853', 'share', '', '', 0, 0),
('wqdzsg1410169853', 'home', '', '', 0, 0),
('wqdzsg1410169853', 'album', '', '', 0, 0),
('wqdzsg1410169853', 'email', '', '', 0, 0),
('wqdzsg1410169853', 'shopping', '', '', 0, 0),
('wqdzsg1410169853', 'membercard', '', '', 0, 0),
('wqdzsg1410169853', 'activity', '', '', 0, 0),
('wqdzsg1410169853', 'weibo', '', '', 0, 0),
('wqdzsg1410169853', 'tencentweibo', '', '', 0, 0),
('wqdzsg1410169853', 'qqzone', '', '', 0, 0),
('wqdzsg1410169853', 'wechat', '', '', 0, 0),
('wqdzsg1410169853', 'music', '', '', 0, 0),
('wqdzsg1410169853', 'video', '', '', 0, 0),
('wqdzsg1410169853', 'recommend', '', '', 0, 0),
('wqdzsg1410169853', 'other', '', '', 0, 0),
('zkceah1411372908', 'tel', '', '', 0, 0),
('zkceah1411372908', 'memberinfo', '', '', 0, 0),
('zkceah1411372908', 'nav', '', '', 0, 0),
('zkceah1411372908', 'message', '', '', 0, 0),
('zkceah1411372908', 'share', '', '', 0, 0),
('zkceah1411372908', 'home', '', '', 0, 0),
('zkceah1411372908', 'album', '', '', 0, 0),
('zkceah1411372908', 'email', '', '', 0, 0),
('zkceah1411372908', 'shopping', '', '', 0, 0),
('zkceah1411372908', 'membercard', '', '', 0, 0),
('zkceah1411372908', 'activity', '', '', 0, 0),
('zkceah1411372908', 'weibo', '', '', 0, 0),
('zkceah1411372908', 'tencentweibo', '', '', 0, 0),
('zkceah1411372908', 'qqzone', '', '', 0, 0),
('zkceah1411372908', 'wechat', '', '', 0, 0),
('zkceah1411372908', 'music', '', '', 0, 0),
('zkceah1411372908', 'video', '', '', 0, 0),
('zkceah1411372908', 'recommend', '', '', 0, 0),
('zkceah1411372908', 'other', '', '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `wy_sjmreply_info`
--

CREATE TABLE IF NOT EXISTS `wy_sjmreply_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `title` varchar(30) NOT NULL DEFAULT '',
  `picurl` varchar(120) NOT NULL DEFAULT '',
  `sharepicurl` varchar(120) NOT NULL DEFAULT '',
  `info` varchar(120) NOT NULL DEFAULT '',
  `keyword` varchar(50) NOT NULL DEFAULT '',
  `copyright` text NOT NULL,
  `ad` int(11) NOT NULL,
  `wxname` varchar(255) NOT NULL,
  `tip` varchar(255) NOT NULL,
  `url` char(255) NOT NULL,
  `shareurl` char(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_snccode`
--

CREATE TABLE IF NOT EXISTS `wy_snccode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `wechaname` varchar(60) NOT NULL,
  `caeatetime` int(11) NOT NULL,
  `phone` int(11) NOT NULL,
  `token` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_storeflash`
--

CREATE TABLE IF NOT EXISTS `wy_storeflash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `img` char(255) NOT NULL,
  `url` char(255) NOT NULL,
  `info` varchar(90) NOT NULL,
  `tip` smallint(11) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tip` (`tip`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_store_flash`
--

CREATE TABLE IF NOT EXISTS `wy_store_flash` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(10) unsigned NOT NULL,
  `token` varchar(32) NOT NULL,
  `img` varchar(300) NOT NULL,
  `url` varchar(300) NOT NULL,
  `info` varchar(90) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_system_info`
--

CREATE TABLE IF NOT EXISTS `wy_system_info` (
  `lastsqlupdate` int(10) NOT NULL,
  `version` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wy_taobao`
--

CREATE TABLE IF NOT EXISTS `wy_taobao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(64) NOT NULL,
  `keyword` varchar(200) NOT NULL,
  `title` varchar(100) NOT NULL,
  `picurl` varchar(100) NOT NULL,
  `homeurl` varchar(100) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `keyword` (`keyword`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_tempmsg`
--

CREATE TABLE IF NOT EXISTS `wy_tempmsg` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tempkey` char(50) NOT NULL,
  `name` char(100) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `topcolor` char(10) NOT NULL DEFAULT '#029700',
  `textcolor` char(10) NOT NULL DEFAULT '#000000',
  `token` char(40) NOT NULL,
  `tempid` char(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tempkey` (`tempkey`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_text`
--

CREATE TABLE IF NOT EXISTS `wy_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `uname` varchar(90) NOT NULL,
  `keyword` char(255) NOT NULL,
  `type` varchar(1) NOT NULL,
  `text` text NOT NULL,
  `createtime` varchar(13) NOT NULL,
  `updatetime` varchar(13) NOT NULL,
  `click` int(11) NOT NULL,
  `token` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_token_open`
--

CREATE TABLE IF NOT EXISTS `wy_token_open` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `token` varchar(60) NOT NULL,
  `queryname` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_toshake`
--

CREATE TABLE IF NOT EXISTS `wy_toshake` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `phone` varchar(15) NOT NULL,
  `token` varchar(20) NOT NULL,
  `wecha_id` varchar(30) DEFAULT NULL,
  `point` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_twitter_count`
--

CREATE TABLE IF NOT EXISTS `wy_twitter_count` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `twid` varchar(20) NOT NULL,
  `token` varchar(60) NOT NULL,
  `cid` int(10) unsigned NOT NULL,
  `total` float NOT NULL COMMENT '总金额',
  `remove` float NOT NULL COMMENT '提出的金额',
  PRIMARY KEY (`id`),
  KEY `twid` (`twid`),
  KEY `token` (`token`,`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_twitter_log`
--

CREATE TABLE IF NOT EXISTS `wy_twitter_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(10) unsigned NOT NULL,
  `token` varchar(60) NOT NULL,
  `twid` varchar(20) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `dateline` int(10) unsigned NOT NULL,
  `price` float NOT NULL,
  `fromsource` varchar(60) NOT NULL COMMENT '来自源',
  `param` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `twid` (`twid`),
  KEY `token` (`token`),
  KEY `fromsource` (`fromsource`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_twitter_remove`
--

CREATE TABLE IF NOT EXISTS `wy_twitter_remove` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(10) unsigned NOT NULL,
  `token` varchar(60) NOT NULL,
  `twid` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL COMMENT '提款人姓名',
  `tel` varchar(15) NOT NULL,
  `number` varchar(32) NOT NULL COMMENT '收款账号',
  `bank` varchar(30) NOT NULL COMMENT '银行名称',
  `address` varchar(60) NOT NULL COMMENT '开户行地址',
  `price` float NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `dateline` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`),
  KEY `token` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_twitter_set`
--

CREATE TABLE IF NOT EXISTS `wy_twitter_set` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(10) unsigned NOT NULL,
  `token` varchar(60) NOT NULL,
  `clickprice` float NOT NULL COMMENT '点击的价格',
  `clickmax` int(10) unsigned NOT NULL COMMENT '每天点击的上限',
  `registerprice` float NOT NULL COMMENT '注册的价格',
  `registermax` int(10) unsigned NOT NULL COMMENT '每天注册的上限',
  `percent` float NOT NULL COMMENT '商品总价的百分比',
  PRIMARY KEY (`id`),
  KEY `token` (`token`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_update_record`
--

CREATE TABLE IF NOT EXISTS `wy_update_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msg` varchar(600) NOT NULL DEFAULT '',
  `type` varchar(20) NOT NULL DEFAULT '',
  `time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_upyun_attachement`
--

CREATE TABLE IF NOT EXISTS `wy_upyun_attachement` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `url` varchar(160) NOT NULL,
  `code` varchar(10) NOT NULL,
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_user`
--

CREATE TABLE IF NOT EXISTS `wy_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `role` smallint(6) unsigned NOT NULL COMMENT '组ID',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态 1:启用 0:禁止',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注说明',
  `last_login_time` int(11) unsigned NOT NULL COMMENT '最后登录时间',
  `last_login_ip` varchar(15) DEFAULT NULL COMMENT '最后登录IP',
  `last_location` varchar(100) DEFAULT NULL COMMENT '最后登录位置',
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_userinfo`
--

CREATE TABLE IF NOT EXISTS `wy_userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `wecha_id` varchar(60) NOT NULL,
  `wechaname` varchar(60) DEFAULT NULL,
  `truename` varchar(60) DEFAULT NULL,
  `tel` varchar(11) DEFAULT NULL,
  `adnew` varchar(250) NOT NULL,
  `qq` int(11) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `age` int(3) NOT NULL,
  `birthday` varchar(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `info` varchar(200) DEFAULT NULL,
  `total_score` int(11) NOT NULL,
  `sign_score` int(11) NOT NULL,
  `expend_score` int(11) NOT NULL,
  `continuous` int(11) NOT NULL,
  `add_expend` int(11) NOT NULL,
  `add_expend_time` int(11) NOT NULL,
  `live_time` int(11) NOT NULL,
  `getcardtime` bigint(20) NOT NULL,
  `expensetotal` int(10) NOT NULL,
  `account` float NOT NULL,
  `portrait` varchar(255) NOT NULL,
  `wallopen` tinyint(1) NOT NULL DEFAULT '0',
  `bornyear` varchar(4) DEFAULT NULL,
  `bornmonth` varchar(4) DEFAULT NULL,
  `bornday` varchar(4) DEFAULT NULL,
  `balance` double(10,2) unsigned NOT NULL DEFAULT '0.00',
  `paypass` varchar(32) NOT NULL DEFAULT '0',
  `diy1_value` varchar(100) DEFAULT NULL,
  `diy2_value` varchar(100) DEFAULT NULL,
  `balance_bf` decimal(10,2) NOT NULL,
  `twid` varchar(20) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`),
  KEY `wecha_id` (`wecha_id`),
  KEY `wecha_id_2` (`wecha_id`),
  KEY `wecha_id_3` (`wecha_id`),
  KEY `wecha_id_4` (`wecha_id`),
  KEY `wecha_id_5` (`wecha_id`),
  KEY `wecha_id_6` (`wecha_id`),
  KEY `wecha_id_7` (`wecha_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_users`
--

CREATE TABLE IF NOT EXISTS `wy_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(90) NOT NULL,
  `createtime` varchar(13) NOT NULL,
  `lasttime` varchar(13) NOT NULL,
  `status` varchar(1) NOT NULL,
  `createip` varchar(30) NOT NULL,
  `lastip` varchar(30) NOT NULL,
  `diynum` int(11) NOT NULL,
  `activitynum` int(11) NOT NULL,
  `card_num` int(11) NOT NULL,
  `card_create_status` tinyint(1) NOT NULL,
  `wechat_card_num` tinyint(3) NOT NULL,
  `money` int(11) NOT NULL,
  `moneybalance` int(11) NOT NULL,
  `viptime` varchar(13) NOT NULL,
  `connectnum` int(11) NOT NULL DEFAULT '0',
  `lastloginmonth` smallint(2) NOT NULL DEFAULT '0',
  `attachmentsize` int(10) NOT NULL,
  `serviceUserNum` int(3) NOT NULL,
  `cy` tinyint(1) NOT NULL COMMENT '微餐饮',
  `wy` tinyint(1) NOT NULL COMMENT '微物业',
  `yy` tinyint(1) NOT NULL COMMENT '微预约',
  `fc` tinyint(1) NOT NULL COMMENT '微房产',
  `jd` tinyint(1) NOT NULL COMMENT '微酒店',
  `yl` tinyint(1) NOT NULL COMMENT '微医疗',
  `qc` tinyint(1) NOT NULL COMMENT '微汽车',
  `dy` tinyint(1) NOT NULL COMMENT '微电影',
  `mr` tinyint(1) NOT NULL COMMENT '微美容',
  `jb` tinyint(1) NOT NULL COMMENT '微酒吧',
  `jy` tinyint(1) NOT NULL COMMENT '微教育',
  `hd` tinyint(1) NOT NULL COMMENT '微花店',
  `zw` tinyint(1) NOT NULL COMMENT '微政务',
  `js` tinyint(1) NOT NULL COMMENT '微健身',
  `ly` tinyint(1) NOT NULL COMMENT '微旅游',
  `sp` tinyint(1) NOT NULL COMMENT '微食品',
  `ktv` tinyint(1) NOT NULL COMMENT '微ktv',
  `mp` varchar(11) DEFAULT '0',
  `zx` tinyint(1) NOT NULL COMMENT '微装修',
  `wf` tinyint(1) NOT NULL COMMENT '智能wifi',
  `ts` tinyint(1) NOT NULL COMMENT '微推送',
  `fs` tinyint(1) NOT NULL COMMENT '微粉丝',
  `hyk` tinyint(1) NOT NULL COMMENT '会员卡',
  `nc` tinyint(1) NOT NULL COMMENT '微邀请',
  `yq` tinyint(1) NOT NULL COMMENT '微名片',
  `qj` tinyint(1) NOT NULL COMMENT '360全景',
  `hq` tinyint(1) NOT NULL COMMENT '微婚庆',
  `kf` tinyint(1) NOT NULL COMMENT '微客服',
  `bbs` tinyint(1) NOT NULL COMMENT '微论坛',
  `tpl` tinyint(1) NOT NULL COMMENT '高级模板',
  `yx` tinyint(1) NOT NULL COMMENT '微营销',
  `agentid` int(10) NOT NULL DEFAULT '0',
  `openid` varchar(80) DEFAULT NULL,
  `remark` varchar(200) DEFAULT NULL,
  `lscy` tinyint(1) NOT NULL COMMENT '连锁餐饮',
  `wxt` tinyint(1) NOT NULL COMMENT '微喜帖',
  `cw` tinyint(1) NOT NULL COMMENT '微宠物',
  `jz` tinyint(1) NOT NULL COMMENT '微家政',
  `zp` tinyint(1) NOT NULL COMMENT '微租凭',
  `zthd` tinyint(1) NOT NULL COMMENT '主题活动',
  `jjdh` tinyint(1) NOT NULL COMMENT '街景导航',
  `wsm` tinyint(1) NOT NULL COMMENT '微商盟',
  `jkdtw` tinyint(1) NOT NULL COMMENT '极客答题王',
  `wzp` tinyint(1) NOT NULL COMMENT '微招聘',
  `xwfc` tinyint(1) NOT NULL COMMENT '房产中介',
  `wjc` tinyint(1) NOT NULL COMMENT '微竞猜',
  `bdzd` tinyint(1) NOT NULL COMMENT '百度直达号',
  `wyj` tinyint(1) NOT NULL COMMENT '摇奖',
  `wxcj` tinyint(1) NOT NULL COMMENT '微场景',
  `wzcj` tinyint(1) NOT NULL COMMENT '微众场景',
  `wpcj` tinyint(1) NOT NULL COMMENT '微品场景',
  `lyb` tinyint(1) NOT NULL COMMENT '留言板',
  `zxyl` tinyint(1) NOT NULL COMMENT '在线预览',
  `diy` tinyint(1) NOT NULL COMMENT '自定义菜单',
  `sq` tinyint(1) NOT NULL COMMENT '微商圈',
  `wsc` tinyint(1) NOT NULL COMMENT '微信商城',
  `tg` tinyint(1) NOT NULL COMMENT '微信团购',
  `tbtm` tinyint(1) NOT NULL COMMENT '淘宝天猫',
  `lh` tinyint(1) NOT NULL COMMENT '融合第三方',
  `dzp` tinyint(1) NOT NULL COMMENT '幸运大转盘',
  `yhq` tinyint(1) NOT NULL COMMENT '优惠券',
  `ggk` tinyint(1) NOT NULL COMMENT '刮刮卡',
  `sgj` tinyint(1) NOT NULL COMMENT '水果机',
  `zjd` tinyint(1) NOT NULL COMMENT '砸金蛋',
  `yzdd` tinyint(1) NOT NULL COMMENT '一站到底',
  `qd` tinyint(1) NOT NULL COMMENT '微信签到',
  `hk` tinyint(1) NOT NULL COMMENT '祝福贺卡',
  `yyl` tinyint(1) NOT NULL COMMENT '摇一摇',
  `zpq` tinyint(1) NOT NULL COMMENT '照片墙',
  `wxq` tinyint(1) NOT NULL COMMENT '微信墙',
  `fyks` tinyint(1) NOT NULL COMMENT '方言考试',
  `sim` tinyint(1) NOT NULL COMMENT '神经猫',
  `2048` tinyint(1) NOT NULL COMMENT '2048正常版',
  `2048nx` tinyint(1) NOT NULL COMMENT '2048虐心版',
  `flappy` tinyint(1) NOT NULL COMMENT 'Flappy 2048',
  `czz` tinyint(1) NOT NULL COMMENT '吃粽子',
  `zqq` tinyint(1) NOT NULL COMMENT '走鹊桥',
  `lovers` tinyint(1) NOT NULL COMMENT '摁死小情侣',
  `autumn` tinyint(1) NOT NULL COMMENT '中秋吃月饼',
  `wdy` tinyint(1) NOT NULL COMMENT '微调研',
  `wxc` tinyint(1) NOT NULL COMMENT '微相册',
  `wtp` tinyint(1) NOT NULL COMMENT '微投票',
  `360` tinyint(1) NOT NULL COMMENT '360°全景',
  `wnbd` tinyint(1) NOT NULL COMMENT '万能表单',
  `zxyd` tinyint(1) NOT NULL COMMENT '在线预定',
  `xwyy` tinyint(1) NOT NULL COMMENT '新微预约',
  `qsjk` tinyint(1) NOT NULL COMMENT '群发接口',
  `kfjk` tinyint(1) NOT NULL COMMENT '客服接口',
  `fsgl` tinyint(1) NOT NULL COMMENT '粉丝管理',
  `fzfl` tinyint(1) NOT NULL COMMENT '分组管理',
  `fsxw` tinyint(1) NOT NULL COMMENT '粉丝行为',
  `fsqd` tinyint(1) NOT NULL COMMENT '渠道',
  `fxgl` tinyint(1) NOT NULL COMMENT '分享管理',
  `gjgn` tinyint(1) NOT NULL COMMENT '高级功能',
  `cjyy` tinyint(1) NOT NULL COMMENT '场景应用',
  `wbhf` tinyint(1) NOT NULL COMMENT '文本回复',
  `twhf` tinyint(1) NOT NULL COMMENT '图文回复',
  `dthf` tinyint(1) NOT NULL COMMENT '多图文回复',
  `yyhf` tinyint(1) NOT NULL COMMENT '语音回复',
  `hdbsl` tinyint(1) NOT NULL COMMENT '回答不上来',
  `3g` tinyint(1) NOT NULL COMMENT '微官网',
  `wds` tinyint(1) NOT NULL COMMENT '微电商',
  `whd` tinyint(1) NOT NULL COMMENT '微互动',
  `why` tinyint(1) NOT NULL COMMENT '微行业',
  `game` tinyint(1) NOT NULL COMMENT '微游戏',
  `wyy` tinyint(1) NOT NULL COMMENT '微应用',
  `sjmf` tinyint(1) NOT NULL COMMENT '数据魔方',
  `dqdz` tinyint(1) NOT NULL COMMENT '点球大战',
  `chz` tinyint(1) NOT NULL COMMENT '拆盒子',
  `zfyl` tinyint(1) NOT NULL COMMENT '转发有礼',
  `fxdr` tinyint(1) NOT NULL COMMENT '分享达人',
  `chb` tinyint(1) NOT NULL COMMENT '拆红包',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_user_group`
--

CREATE TABLE IF NOT EXISTS `wy_user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `diynum` int(11) NOT NULL,
  `connectnum` int(11) NOT NULL,
  `iscopyright` tinyint(1) NOT NULL,
  `activitynum` int(3) NOT NULL,
  `price` int(11) NOT NULL,
  `statistics_user` int(11) NOT NULL,
  `create_card_num` int(4) NOT NULL,
  `wechat_card_num` tinyint(4) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `agentid` int(10) NOT NULL DEFAULT '0',
  `taxisid` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `wy_user_group`
--

INSERT INTO `wy_user_group` (`id`, `name`, `diynum`, `connectnum`, `iscopyright`, `activitynum`, `price`, `statistics_user`, `create_card_num`, `wechat_card_num`, `status`, `agentid`, `taxisid`) VALUES
(1, 'vip0', 2000, 1000, 1, 0, 0, 0, 10, 1, 1, 0, 1),
(2, 'VIP1', 3000, 3000, 1, 2, 1, 0, 50, 1, 1, 0, 2),
(3, 'vip2', 40000, 40000, 1, 4, 50, 0, 80, 1, 1, 0, 3),
(4, 'vip3', 50000, 50000, 1, 1000, 180, 0, 10000, 1, 1, 0, 4),
(5, 'SV2', 5000, 5000, 1, 100, 500, 0, 1000000, 2, 1, 0, 5),
(6, 'ower', 10000111, 2147483647, 1, 10000111, 10000, 0, 1000000, 127, 1, 0, 6);

-- --------------------------------------------------------

--
-- 表的结构 `wy_user_request`
--

CREATE TABLE IF NOT EXISTS `wy_user_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(30) NOT NULL,
  `uid` varchar(32) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `msgtype` varchar(15) NOT NULL DEFAULT 'text',
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `msgtype` (`msgtype`),
  KEY `token` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_vcard`
--

CREATE TABLE IF NOT EXISTS `wy_vcard` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `company` varchar(100) DEFAULT NULL,
  `company_tel` varchar(100) DEFAULT NULL,
  `baiduapi` varchar(100) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `info` varchar(500) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_vcard_list`
--

CREATE TABLE IF NOT EXISTS `wy_vcard_list` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `bgimage` varchar(300) DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `work` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `qq` varchar(100) DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_voiceresponse`
--

CREATE TABLE IF NOT EXISTS `wy_voiceresponse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `uname` varchar(90) NOT NULL,
  `createtime` varchar(13) NOT NULL,
  `uptatetime` varchar(13) NOT NULL,
  `keyword` char(255) NOT NULL,
  `title` varchar(60) NOT NULL,
  `musicurl` char(255) NOT NULL,
  `hqmusicurl` char(255) NOT NULL,
  `description` char(255) NOT NULL,
  `token` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_vote`
--

CREATE TABLE IF NOT EXISTS `wy_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `keyword` varchar(60) NOT NULL,
  `token` varchar(50) NOT NULL,
  `type` char(5) NOT NULL,
  `picurl` varchar(500) NOT NULL,
  `showpic` tinyint(4) NOT NULL,
  `info` varchar(500) NOT NULL,
  `statdate` int(11) NOT NULL,
  `enddate` int(11) NOT NULL,
  `display` tinyint(4) DEFAULT NULL,
  `cknums` tinyint(3) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL,
  `refresh` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  FULLTEXT KEY `title` (`title`),
  FULLTEXT KEY `keyword` (`keyword`),
  FULLTEXT KEY `token` (`token`),
  FULLTEXT KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_vote_item`
--

CREATE TABLE IF NOT EXISTS `wy_vote_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vid` int(11) NOT NULL COMMENT 'vote_id',
  `item` varchar(50) NOT NULL,
  `vcount` int(11) NOT NULL,
  `startpicurl` varchar(200) NOT NULL DEFAULT '',
  `tourl` varchar(200) NOT NULL DEFAULT '',
  `rank` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_vote_record`
--

CREATE TABLE IF NOT EXISTS `wy_vote_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` varchar(50) NOT NULL,
  `vid` int(11) NOT NULL,
  `wecha_id` varchar(100) NOT NULL,
  `touched` tinyint(4) NOT NULL,
  `touch_time` int(11) NOT NULL,
  `token` varchar(50) NOT NULL,
  `trueip` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_wall`
--

CREATE TABLE IF NOT EXISTS `wy_wall` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(20) NOT NULL DEFAULT '',
  `time` int(11) NOT NULL DEFAULT '0',
  `logo` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `startbackground` varchar(100) NOT NULL DEFAULT '',
  `background` varchar(100) NOT NULL DEFAULT '',
  `endbackground` varchar(100) NOT NULL DEFAULT '',
  `isopen` tinyint(1) NOT NULL DEFAULT '1',
  `firstprizename` varchar(50) NOT NULL DEFAULT '',
  `firstprizepic` varchar(100) NOT NULL DEFAULT '',
  `firstprizecount` mediumint(5) NOT NULL DEFAULT '0',
  `secondprizename` varchar(50) NOT NULL DEFAULT '',
  `secondprizecount` mediumint(4) NOT NULL DEFAULT '0',
  `secondprizepic` varchar(100) NOT NULL DEFAULT '',
  `thirdprizename` varchar(50) NOT NULL DEFAULT '',
  `thirdprizepic` varchar(100) NOT NULL DEFAULT '',
  `thirdprizecount` mediumint(4) NOT NULL DEFAULT '0',
  `fourthprizename` varchar(50) NOT NULL DEFAULT '',
  `fourthprizecount` mediumint(4) NOT NULL DEFAULT '0',
  `fourthprizepic` varchar(100) NOT NULL DEFAULT '',
  `fifthprizename` varchar(50) NOT NULL DEFAULT '',
  `fifthprizecount` mediumint(5) NOT NULL DEFAULT '0',
  `fifthprizepic` varchar(100) NOT NULL DEFAULT '',
  `sixthprizename` varchar(50) NOT NULL DEFAULT '',
  `sixthprizecount` mediumint(4) NOT NULL DEFAULT '0',
  `sixthprizepic` varchar(100) NOT NULL DEFAULT '',
  `keyword` varchar(60) NOT NULL DEFAULT '',
  `qrcode` varchar(100) NOT NULL DEFAULT '',
  `ck_msg` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_wall_member`
--

CREATE TABLE IF NOT EXISTS `wy_wall_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(20) NOT NULL DEFAULT '',
  `wecha_id` varchar(60) NOT NULL DEFAULT '',
  `portrait` varchar(150) NOT NULL DEFAULT '',
  `nickname` varchar(60) NOT NULL DEFAULT '',
  `mp` varchar(11) NOT NULL DEFAULT '',
  `time` int(10) NOT NULL DEFAULT '0',
  `wallid` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sex` tinyint(1) NOT NULL DEFAULT '0',
  `phone` varchar(11) NOT NULL,
  `act_id` int(11) NOT NULL,
  `act_type` enum('1','2','3') NOT NULL,
  `truename` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`,`wallid`),
  KEY `wecha_id` (`wecha_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_wall_message`
--

CREATE TABLE IF NOT EXISTS `wy_wall_message` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `wallid` int(10) NOT NULL DEFAULT '0',
  `token` varchar(20) NOT NULL DEFAULT '',
  `wecha_id` varchar(60) NOT NULL DEFAULT '',
  `content` varchar(500) NOT NULL DEFAULT '',
  `picture` varchar(150) NOT NULL DEFAULT '',
  `time` int(10) NOT NULL DEFAULT '0',
  `is_scene` tinyint(1) NOT NULL DEFAULT '0',
  `is_check` enum('0','1') NOT NULL,
  `check_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `wallid` (`wallid`,`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_wall_prize_record`
--

CREATE TABLE IF NOT EXISTS `wy_wall_prize_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `wallid` int(11) NOT NULL DEFAULT '0',
  `prize` mediumint(4) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL,
  `sceneid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `wallid` (`wallid`,`prize`,`time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_weather`
--

CREATE TABLE IF NOT EXISTS `wy_weather` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `code` char(9) NOT NULL,
  `name` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2502 ;

--
-- 转存表中的数据 `wy_weather`
--

INSERT INTO `wy_weather` (`id`, `code`, `name`) VALUES
(1, '101010100', '北京'),
(2, '101010200', '海淀'),
(3, '101010400', '顺义'),
(4, '101010500', '怀柔'),
(5, '101010600', '通州'),
(6, '101010700', '昌平'),
(7, '101010800', '延庆'),
(8, '101010900', '丰台'),
(9, '101011000', '石景山'),
(10, '101011100', '大兴'),
(11, '101011200', '房山'),
(12, '101011300', '密云'),
(13, '101011400', '门头沟'),
(14, '101011500', '平谷'),
(15, '101020100', '上海'),
(16, '101020200', '闵行'),
(17, '101020300', '宝山'),
(18, '101020500', '嘉定'),
(19, '101020600', '浦东南汇'),
(20, '101020700', '金山'),
(21, '101020800', '青浦'),
(22, '101020900', '松江'),
(23, '101021000', '奉贤'),
(24, '101021100', '崇明'),
(25, '101021300', '浦东'),
(26, '101030200', '武清'),
(27, '101030300', '宝坻'),
(28, '101030400', '东丽'),
(29, '101030500', '西青'),
(30, '101030600', '北辰'),
(31, '101030700', '宁河'),
(32, '101030800', '汉沽'),
(33, '101030900', '静海'),
(34, '101031000', '津南'),
(35, '101031100', '塘沽'),
(36, '101031200', '大港'),
(37, '101031400', '蓟县'),
(38, '101040100', '重庆'),
(39, '101040200', '永川'),
(40, '101040300', '合川'),
(41, '101040400', '南川'),
(42, '101040500', '江津'),
(43, '101040600', '万盛'),
(44, '101040700', '渝北'),
(45, '101040800', '北碚'),
(46, '101041000', '长寿'),
(47, '101041100', '黔江'),
(48, '101041300', '万州'),
(49, '101041400', '涪陵'),
(50, '101041500', '开县'),
(51, '101041600', '城口'),
(52, '101041700', '云阳'),
(53, '101041800', '巫溪'),
(54, '101041900', '奉节'),
(55, '101042000', '巫山'),
(56, '101042100', '潼南'),
(57, '101042200', '垫江'),
(58, '101042300', '梁平'),
(59, '101042400', '忠县'),
(60, '101042500', '石柱'),
(61, '101042600', '大足'),
(62, '101042700', '荣昌'),
(63, '101042800', '铜梁'),
(64, '101042900', '璧山'),
(65, '101043000', '丰都'),
(66, '101043100', '武隆'),
(67, '101043200', '彭水'),
(68, '101043300', '綦江'),
(69, '101043400', '酉阳'),
(70, '101043600', '秀山'),
(71, '101050101', '哈尔滨'),
(72, '101050102', '双城'),
(73, '101050103', '呼兰'),
(74, '101050104', '阿城'),
(75, '101050105', '宾县'),
(76, '101050106', '依兰'),
(77, '101050107', '巴彦'),
(78, '101050108', '通河'),
(79, '101050109', '方正'),
(80, '101050110', '延寿'),
(81, '101050111', '尚志'),
(82, '101050112', '五常'),
(83, '101050113', '木兰'),
(84, '101050201', '齐齐哈尔'),
(85, '101050202', '讷河'),
(86, '101050203', '龙江'),
(87, '101050204', '甘南'),
(88, '101050205', '富裕'),
(89, '101050206', '依安'),
(90, '101050207', '拜泉'),
(91, '101050208', '克山'),
(92, '101050209', '克东'),
(93, '101050210', '泰来'),
(94, '101050301', '牡丹江'),
(95, '101050302', '海林'),
(96, '101050303', '穆棱'),
(97, '101050304', '林口'),
(98, '101050305', '绥芬河'),
(99, '101050306', '宁安'),
(100, '101050307', '东宁'),
(101, '101050401', '佳木斯'),
(102, '101050402', '汤原'),
(103, '101050403', '抚远'),
(104, '101050404', '桦川'),
(105, '101050405', '桦南'),
(106, '101050406', '同江'),
(107, '101050407', '富锦'),
(108, '101050501', '绥化'),
(109, '101050502', '肇东'),
(110, '101050503', '安达'),
(111, '101050504', '海伦'),
(112, '101050505', '明水'),
(113, '101050506', '望奎'),
(114, '101050507', '兰西'),
(115, '101050508', '青冈'),
(116, '101050509', '庆安'),
(117, '101050510', '绥棱'),
(118, '101050601', '黑河'),
(119, '101050602', '嫩江'),
(120, '101050603', '孙吴'),
(121, '101050604', '逊克'),
(122, '101050605', '五大连池'),
(123, '101050606', '北安'),
(124, '101050701', '大兴安岭'),
(125, '101050702', '塔河'),
(126, '101050703', '漠河'),
(127, '101050704', '呼玛'),
(128, '101050801', '伊春'),
(129, '101050804', '铁力'),
(130, '101050805', '嘉荫'),
(131, '101050901', '大庆'),
(132, '101050902', '林甸'),
(133, '101050903', '肇州'),
(134, '101050904', '肇源'),
(135, '101050905', '杜蒙'),
(136, '101051002', '七台河'),
(137, '101051003', '勃利'),
(138, '101051101', '鸡西'),
(139, '101051102', '虎林'),
(140, '101051103', '密山'),
(141, '101051104', '鸡东'),
(142, '101051201', '鹤岗'),
(143, '101051202', '绥滨'),
(144, '101051203', '萝北'),
(145, '101051301', '双鸭山'),
(146, '101051302', '集贤'),
(147, '101051303', '宝清'),
(148, '101051304', '饶河'),
(149, '101051305', '友谊'),
(150, '101060101', '长春'),
(151, '101060102', '农安'),
(152, '101060103', '德惠'),
(153, '101060104', '九台'),
(154, '101060105', '榆树'),
(155, '101060201', '吉林'),
(156, '101060202', '舒兰'),
(157, '101060203', '永吉'),
(158, '101060204', '蛟河'),
(159, '101060205', '磐石'),
(160, '101060206', '桦甸'),
(161, '101060302', '敦化'),
(162, '101060303', '安图'),
(163, '101060304', '汪清'),
(164, '101060305', '和龙'),
(165, '101060307', '龙井'),
(166, '101060308', '珲春'),
(167, '101060309', '图们'),
(168, '101060312', '延吉'),
(169, '101060401', '四平'),
(170, '101060402', '双辽'),
(171, '101060403', '梨树'),
(172, '101060404', '公主岭'),
(173, '101060405', '伊通'),
(174, '101060501', '通化'),
(175, '101060502', '梅河口'),
(176, '101060503', '柳河'),
(177, '101060504', '辉南'),
(178, '101060505', '集安'),
(179, '101060601', '白城'),
(180, '101060602', '洮南'),
(181, '101060603', '大安'),
(182, '101060604', '镇赉'),
(183, '101060605', '通榆'),
(184, '101060701', '辽源'),
(185, '101060702', '东丰'),
(186, '101060703', '东辽'),
(187, '101060801', '松原'),
(188, '101060802', '乾安'),
(189, '101060803', '前郭'),
(190, '101060804', '长岭'),
(191, '101060805', '扶余'),
(192, '101060901', '白山'),
(193, '101060902', '靖宇'),
(194, '101060903', '临江'),
(195, '101060905', '长白'),
(196, '101060906', '抚松'),
(197, '101060907', '江源'),
(198, '101070101', '沈阳'),
(199, '101070103', '辽中'),
(200, '101070104', '康平'),
(201, '101070105', '法库'),
(202, '101070106', '新民'),
(203, '101070201', '大连'),
(204, '101070202', '瓦房店'),
(205, '101070204', '普兰店'),
(206, '101070206', '长海'),
(207, '101070207', '庄河'),
(208, '101070301', '鞍山'),
(209, '101070302', '台安'),
(210, '101070303', '岫岩'),
(211, '101070304', '海城'),
(212, '101070401', '抚顺'),
(213, '101070402', '新宾'),
(214, '101070403', '清原'),
(215, '101070501', '本溪'),
(216, '101070504', '桓仁'),
(217, '101070601', '丹东'),
(218, '101070602', '凤城'),
(219, '101070603', '宽甸'),
(220, '101070604', '东港'),
(221, '101070701', '锦州'),
(222, '101070702', '凌海'),
(223, '101070704', '义县'),
(224, '101070705', '黑山'),
(225, '101070706', '北镇'),
(226, '101070801', '营口'),
(227, '101070802', '大石桥'),
(228, '101070803', '盖州'),
(229, '101070901', '阜新'),
(230, '101070902', '彰武'),
(231, '101071001', '辽阳'),
(232, '101071003', '灯塔'),
(233, '101071004', '弓长岭'),
(234, '101071101', '铁岭'),
(235, '101071102', '开原'),
(236, '101071103', '昌图'),
(237, '101071104', '西丰'),
(238, '101071105', '调兵山'),
(239, '101071201', '朝阳'),
(240, '101071203', '凌源'),
(241, '101071204', '喀左'),
(242, '101071205', '北票'),
(243, '101071207', '建平'),
(244, '101071301', '盘锦'),
(245, '101071302', '大洼'),
(246, '101071303', '盘山'),
(247, '101071401', '葫芦岛'),
(248, '101071402', '建昌'),
(249, '101071403', '绥中'),
(250, '101071404', '兴城'),
(251, '101080101', '呼和浩特'),
(252, '101080102', '土左'),
(253, '101080103', '托克托'),
(254, '101080104', '和林格尔'),
(255, '101080105', '清水河'),
(256, '101080107', '武川'),
(257, '101080201', '包头'),
(258, '101080202', '白云鄂博'),
(259, '101080204', '土右'),
(260, '101080205', '固阳'),
(261, '101080206', '达茂'),
(262, '101080301', '乌海'),
(263, '101080401', '乌兰察布'),
(264, '101080402', '卓资'),
(265, '101080403', '化德'),
(266, '101080404', '商都'),
(267, '101080406', '兴和'),
(268, '101080407', '凉城'),
(269, '101080408', '察右前'),
(270, '101080409', '察右中'),
(271, '101080410', '察右后'),
(272, '101080411', '四子王'),
(273, '101080412', '丰镇'),
(274, '101080501', '通辽'),
(275, '101080503', '科左中'),
(276, '101080504', '科左后'),
(277, '101080506', '开鲁'),
(278, '101080507', '库伦'),
(279, '101080508', '奈曼'),
(280, '101080509', '扎鲁特'),
(281, '101080601', '赤峰'),
(282, '101080603', '阿鲁'),
(283, '101080605', '巴林左'),
(284, '101080606', '巴林右'),
(285, '101080607', '林西'),
(286, '101080608', '克什'),
(287, '101080609', '翁牛特'),
(288, '101080611', '喀喇沁'),
(289, '101080613', '宁城'),
(290, '101080614', '敖汉'),
(291, '101080701', '鄂尔多斯'),
(292, '101080703', '达拉特'),
(293, '101080704', '准格尔'),
(294, '101080706', '河南'),
(295, '101080708', '鄂托克'),
(296, '101080709', '杭锦'),
(297, '101080710', '乌审'),
(298, '101080711', '伊金霍洛'),
(299, '101080801', '巴彦淖尔'),
(300, '101080802', '五原'),
(301, '101080803', '磴口'),
(302, '101080804', '乌前'),
(303, '101080806', '乌中'),
(304, '101080807', '乌后'),
(305, '101080810', '杭锦后'),
(306, '101080901', '锡林浩特'),
(307, '101080903', '二连浩特'),
(308, '101080904', '阿巴嘎'),
(309, '101080906', '苏左'),
(310, '101080907', '苏右'),
(311, '101080909', '东乌'),
(312, '101080910', '西乌'),
(313, '101080911', '太仆寺'),
(314, '101080912', '镶黄'),
(315, '101080913', '正镶白'),
(316, '101080914', '正蓝'),
(317, '101080915', '多伦'),
(318, '101081000', '呼伦贝尔'),
(319, '101081001', '海拉尔'),
(320, '101081003', '阿荣'),
(321, '101081004', '莫力达瓦'),
(322, '101081005', '鄂伦春'),
(323, '101081006', '鄂温克'),
(324, '101081007', '陈巴尔虎'),
(325, '101081008', '新左'),
(326, '101081009', '新右'),
(327, '101081010', '满洲里'),
(328, '101081011', '牙克石'),
(329, '101081012', '扎兰屯'),
(330, '101081014', '额尔古纳'),
(331, '101081015', '根河'),
(332, '101081101', '乌兰浩特'),
(333, '101081102', '阿尔山'),
(334, '101081103', '科右中'),
(335, '101081105', '扎赉特'),
(336, '101081107', '突泉'),
(337, '101081108', '霍林郭勒'),
(338, '101081109', '科右前'),
(339, '101081201', '阿拉善'),
(340, '101081202', '阿右'),
(341, '101081203', '额济纳'),
(342, '101090101', '石家庄'),
(343, '101090102', '井陉'),
(344, '101090103', '正定'),
(345, '101090104', '栾城'),
(346, '101090105', '行唐'),
(347, '101090106', '灵寿'),
(348, '101090107', '高邑'),
(349, '101090108', '深泽'),
(350, '101090109', '赞皇'),
(351, '101090110', '无极'),
(352, '101090111', '平山'),
(353, '101090112', '元氏'),
(354, '101090113', '赵县'),
(355, '101090114', '辛集'),
(356, '101090115', '藁城'),
(357, '101090116', '晋州'),
(358, '101090117', '新乐'),
(359, '101090118', '鹿泉'),
(360, '101090201', '保定'),
(361, '101090202', '满城'),
(362, '101090203', '阜平'),
(363, '101090204', '徐水'),
(364, '101090205', '唐县'),
(365, '101090206', '高阳'),
(366, '101090207', '容城'),
(367, '101090209', '涞源'),
(368, '101090210', '望都'),
(369, '101090211', '安新'),
(370, '101090212', '易县'),
(371, '101090214', '曲阳'),
(372, '101090215', '蠡县'),
(373, '101090216', '顺平'),
(374, '101090217', '雄县'),
(375, '101090218', '涿州'),
(376, '101090219', '定州'),
(377, '101090220', '安国'),
(378, '101090221', '高碑店'),
(379, '101090222', '涞水'),
(380, '101090223', '定兴'),
(381, '101090224', '清苑'),
(382, '101090225', '博野'),
(383, '101090301', '张家口'),
(384, '101090302', '宣化'),
(385, '101090303', '张北'),
(386, '101090304', '康保'),
(387, '101090305', '沽源'),
(388, '101090306', '尚义'),
(389, '101090307', '蔚县'),
(390, '101090308', '阳原'),
(391, '101090309', '怀安'),
(392, '101090310', '万全'),
(393, '101090311', '怀来'),
(394, '101090312', '涿鹿'),
(395, '101090313', '赤城'),
(396, '101090314', '崇礼'),
(397, '101090402', '承德'),
(398, '101090404', '兴隆'),
(399, '101090405', '平泉'),
(400, '101090406', '滦平'),
(401, '101090407', '隆化'),
(402, '101090408', '丰宁'),
(403, '101090409', '宽城'),
(404, '101090410', '围场'),
(405, '101090501', '唐山'),
(406, '101090502', '丰南'),
(407, '101090503', '丰润'),
(408, '101090504', '滦县'),
(409, '101090505', '滦南'),
(410, '101090506', '乐亭'),
(411, '101090507', '迁西'),
(412, '101090508', '玉田'),
(413, '101090509', '唐海'),
(414, '101090510', '遵化'),
(415, '101090511', '迁安'),
(416, '101090512', '曹妃甸'),
(417, '101090601', '廊坊'),
(418, '101090602', '固安'),
(419, '101090603', '永清'),
(420, '101090604', '香河'),
(421, '101090605', '大城'),
(422, '101090606', '文安'),
(423, '101090607', '大厂'),
(424, '101090608', '霸州'),
(425, '101090609', '三河'),
(426, '101090701', '沧州'),
(427, '101090702', '青县'),
(428, '101090703', '东光'),
(429, '101090704', '海兴'),
(430, '101090705', '盐山'),
(431, '101090706', '肃宁'),
(432, '101090707', '南皮'),
(433, '101090708', '吴桥'),
(434, '101090709', '献县'),
(435, '101090710', '孟村'),
(436, '101090711', '泊头'),
(437, '101090712', '任丘'),
(438, '101090713', '黄骅'),
(439, '101090714', '河间'),
(440, '101090716', '沧县'),
(441, '101090801', '衡水'),
(442, '101090802', '枣强'),
(443, '101090803', '武邑'),
(444, '101090804', '武强'),
(445, '101090805', '饶阳'),
(446, '101090806', '安平'),
(447, '101090807', '故城'),
(448, '101090808', '景县'),
(449, '101090809', '阜城'),
(450, '101090810', '冀州'),
(451, '101090811', '深州'),
(452, '101090901', '邢台'),
(453, '101090902', '临城'),
(454, '101090905', '柏乡'),
(455, '101090906', '隆尧'),
(456, '101090907', '南和'),
(457, '101090908', '宁晋'),
(458, '101090909', '巨鹿'),
(459, '101090910', '新河'),
(460, '101090911', '广宗'),
(461, '101090912', '平乡'),
(462, '101090913', '威县'),
(463, '101090914', '清河'),
(464, '101090915', '临西'),
(465, '101090916', '南宫'),
(466, '101090917', '沙河'),
(467, '101090918', '任县'),
(468, '101090919', '内丘'),
(469, '101091001', '邯郸'),
(470, '101091002', '峰峰矿'),
(471, '101091003', '临漳'),
(472, '101091004', '成安'),
(473, '101091005', '大名'),
(474, '101091006', '涉县'),
(475, '101091007', '磁县'),
(476, '101091008', '肥乡'),
(477, '101091009', '永年'),
(478, '101091010', '邱县'),
(479, '101091011', '鸡泽'),
(480, '101091012', '广平'),
(481, '101091013', '馆陶'),
(482, '101091014', '魏县'),
(483, '101091015', '曲周'),
(484, '101091016', '武安'),
(485, '101091101', '秦皇岛'),
(486, '101091102', '青龙'),
(487, '101091103', '昌黎'),
(488, '101091104', '抚宁'),
(489, '101091105', '卢龙'),
(490, '101100101', '太原'),
(491, '101100102', '清徐'),
(492, '101100103', '阳曲'),
(493, '101100104', '娄烦'),
(494, '101100105', '古交'),
(495, '101100201', '大同'),
(496, '101100202', '阳高'),
(497, '101100204', '天镇'),
(498, '101100205', '广灵'),
(499, '101100206', '灵丘'),
(500, '101100207', '浑源'),
(501, '101100208', '左云'),
(502, '101100301', '阳泉'),
(503, '101100302', '盂县'),
(504, '101100303', '平定'),
(505, '101100401', '晋中'),
(506, '101100403', '榆社'),
(507, '101100404', '左权'),
(508, '101100405', '和顺'),
(509, '101100406', '昔阳'),
(510, '101100407', '寿阳'),
(511, '101100408', '太谷'),
(512, '101100409', '祁县'),
(513, '101100410', '平遥'),
(514, '101100411', '灵石'),
(515, '101100412', '介休'),
(516, '101100501', '长治'),
(517, '101100502', '黎城'),
(518, '101100503', '屯留'),
(519, '101100504', '潞城'),
(520, '101100505', '襄垣'),
(521, '101100506', '平顺'),
(522, '101100507', '武乡'),
(523, '101100508', '沁县'),
(524, '101100509', '长子'),
(525, '101100510', '沁源'),
(526, '101100511', '壶关'),
(527, '101100601', '晋城'),
(528, '101100602', '沁水'),
(529, '101100603', '阳城'),
(530, '101100604', '陵川'),
(531, '101100605', '高平'),
(532, '101100606', '泽州'),
(533, '101100701', '临汾'),
(534, '101100702', '曲沃'),
(535, '101100703', '永和'),
(536, '101100704', '隰县'),
(537, '101100705', '大宁'),
(538, '101100706', '吉县'),
(539, '101100707', '襄汾'),
(540, '101100708', '蒲县'),
(541, '101100709', '汾西'),
(542, '101100710', '洪洞'),
(543, '101100711', '霍州'),
(544, '101100712', '乡宁'),
(545, '101100713', '翼城'),
(546, '101100714', '侯马'),
(547, '101100715', '浮山'),
(548, '101100716', '安泽'),
(549, '101100717', '古县'),
(550, '101100801', '运城'),
(551, '101100802', '临猗'),
(552, '101100803', '稷山'),
(553, '101100804', '万荣'),
(554, '101100805', '河津'),
(555, '101100806', '新绛'),
(556, '101100807', '绛县'),
(557, '101100808', '闻喜'),
(558, '101100809', '垣曲'),
(559, '101100810', '永济'),
(560, '101100811', '芮城'),
(561, '101100812', '夏县'),
(562, '101100813', '平陆'),
(563, '101100901', '朔州'),
(564, '101100903', '山阴'),
(565, '101100904', '右玉'),
(566, '101100905', '应县'),
(567, '101100906', '怀仁'),
(568, '101101001', '忻州'),
(569, '101101002', '定襄'),
(570, '101101003', '五台'),
(571, '101101004', '河曲'),
(572, '101101005', '偏关'),
(573, '101101006', '神池'),
(574, '101101007', '宁武'),
(575, '101101008', '代县'),
(576, '101101009', '繁峙'),
(577, '101101011', '保德'),
(578, '101101012', '静乐'),
(579, '101101013', '岢岚'),
(580, '101101014', '五寨'),
(581, '101101015', '原平'),
(582, '101101100', '吕梁'),
(583, '101101101', '离石'),
(584, '101101102', '临县'),
(585, '101101103', '兴县'),
(586, '101101104', '岚县'),
(587, '101101105', '柳林'),
(588, '101101106', '石楼'),
(589, '101101107', '方山'),
(590, '101101108', '交口'),
(591, '101101109', '中阳'),
(592, '101101110', '孝义'),
(593, '101101111', '汾阳'),
(594, '101101112', '文水'),
(595, '101101113', '交城'),
(596, '101110101', '西安'),
(597, '101110102', '长安'),
(598, '101110104', '蓝田'),
(599, '101110105', '周至'),
(600, '101110106', '户县'),
(601, '101110107', '高陵'),
(602, '101110200', '咸阳'),
(603, '101110201', '三原'),
(604, '101110202', '礼泉'),
(605, '101110203', '永寿'),
(606, '101110204', '淳化'),
(607, '101110205', '泾阳'),
(608, '101110206', '武功'),
(609, '101110207', '乾县'),
(610, '101110208', '彬县'),
(611, '101110209', '长武'),
(612, '101110210', '旬邑'),
(613, '101110211', '兴平'),
(614, '101110300', '延安'),
(615, '101110401', '榆林'),
(616, '101110402', '府谷'),
(617, '101110403', '神木'),
(618, '101110404', '佳县'),
(619, '101110405', '定边'),
(620, '101110406', '靖边'),
(621, '101110407', '横山'),
(622, '101110408', '米脂'),
(623, '101110409', '子洲'),
(624, '101110410', '绥德'),
(625, '101110411', '吴堡'),
(626, '101110412', '清涧'),
(627, '101110501', '渭南'),
(628, '101110502', '华县'),
(629, '101110503', '潼关'),
(630, '101110504', '大荔'),
(631, '101110505', '白水'),
(632, '101110506', '富平'),
(633, '101110507', '蒲城'),
(634, '101110508', '澄城'),
(635, '101110509', '合阳'),
(636, '101110510', '韩城'),
(637, '101110511', '华阴'),
(638, '101110601', '商洛'),
(639, '101110602', '洛南'),
(640, '101110603', '柞水'),
(641, '101110604', '商州'),
(642, '101110605', '镇安'),
(643, '101110606', '丹凤'),
(644, '101110607', '商南'),
(645, '101110608', '山阳'),
(646, '101110701', '安康'),
(647, '101110702', '紫阳'),
(648, '101110703', '石泉'),
(649, '101110704', '汉阴'),
(650, '101110705', '旬阳'),
(651, '101110706', '岚皋'),
(652, '101110707', '平利'),
(653, '101110708', '白河'),
(654, '101110709', '镇坪'),
(655, '101110710', '宁陕'),
(656, '101110801', '汉中'),
(657, '101110802', '略阳'),
(658, '101110803', '勉县'),
(659, '101110804', '留坝'),
(660, '101110805', '洋县'),
(661, '101110806', '城固'),
(662, '101110807', '西乡'),
(663, '101110808', '佛坪'),
(664, '101110809', '宁强'),
(665, '101110810', '南郑'),
(666, '101110811', '镇巴'),
(667, '101110901', '宝鸡'),
(668, '101110903', '千阳'),
(669, '101110904', '麟游'),
(670, '101110905', '岐山'),
(671, '101110906', '凤翔'),
(672, '101110907', '扶风'),
(673, '101110908', '眉县'),
(674, '101110909', '太白'),
(675, '101110910', '凤县'),
(676, '101110911', '陇县'),
(677, '101111001', '铜川'),
(678, '101111003', '宜君'),
(679, '101111101', '杨凌'),
(680, '101120101', '济南'),
(681, '101120103', '商河'),
(682, '101120104', '章丘'),
(683, '101120105', '平阴'),
(684, '101120106', '济阳'),
(685, '101120201', '青岛'),
(686, '101120204', '即墨'),
(687, '101120205', '胶州'),
(688, '101120206', '胶南'),
(689, '101120207', '莱西'),
(690, '101120208', '平度'),
(691, '101120301', '淄博'),
(692, '101120304', '高青'),
(693, '101120306', '沂源'),
(694, '101120307', '桓台'),
(695, '101120401', '德州'),
(696, '101120402', '武城'),
(697, '101120403', '临邑'),
(698, '101120404', '陵县'),
(699, '101120405', '齐河'),
(700, '101120406', '乐陵'),
(701, '101120407', '庆云'),
(702, '101120408', '平原'),
(703, '101120409', '宁津'),
(704, '101120410', '夏津'),
(705, '101120411', '禹城'),
(706, '101120501', '烟台'),
(707, '101120502', '莱州'),
(708, '101120503', '长岛'),
(709, '101120504', '蓬莱'),
(710, '101120505', '龙口'),
(711, '101120506', '招远'),
(712, '101120507', '栖霞'),
(713, '101120510', '莱阳'),
(714, '101120511', '海阳'),
(715, '101120601', '潍坊'),
(716, '101120602', '青州'),
(717, '101120603', '寿光'),
(718, '101120604', '临朐'),
(719, '101120605', '昌乐'),
(720, '101120606', '昌邑'),
(721, '101120607', '安丘'),
(722, '101120608', '高密'),
(723, '101120609', '诸城'),
(724, '101120701', '济宁'),
(725, '101120702', '嘉祥'),
(726, '101120703', '微山'),
(727, '101120704', '鱼台'),
(728, '101120705', '兖州'),
(729, '101120706', '金乡'),
(730, '101120707', '汶上'),
(731, '101120708', '泗水'),
(732, '101120709', '梁山'),
(733, '101120710', '曲阜'),
(734, '101120711', '邹城'),
(735, '101120801', '泰安'),
(736, '101120802', '新泰'),
(737, '101120804', '肥城'),
(738, '101120805', '东平'),
(739, '101120806', '宁阳'),
(740, '101120901', '临沂'),
(741, '101120902', '莒南'),
(742, '101120903', '沂南'),
(743, '101120904', '苍山'),
(744, '101120905', '临沭'),
(745, '101120906', '郯城'),
(746, '101120907', '蒙阴'),
(747, '101120908', '平邑'),
(748, '101120909', '费县'),
(749, '101120910', '沂水'),
(750, '101121001', '菏泽'),
(751, '101121002', '鄄城'),
(752, '101121003', '郓城'),
(753, '101121004', '东明'),
(754, '101121005', '定陶'),
(755, '101121006', '巨野'),
(756, '101121007', '曹县'),
(757, '101121008', '成武'),
(758, '101121009', '单县'),
(759, '101121101', '滨州'),
(760, '101121102', '博兴'),
(761, '101121103', '无棣'),
(762, '101121104', '阳信'),
(763, '101121105', '惠民'),
(764, '101121106', '沾化'),
(765, '101121107', '邹平'),
(766, '101121201', '东营'),
(767, '101121203', '垦利'),
(768, '101121204', '利津'),
(769, '101121205', '广饶'),
(770, '101121301', '威海'),
(771, '101121302', '文登'),
(772, '101121303', '荣成'),
(773, '101121304', '乳山'),
(774, '101121401', '枣庄'),
(775, '101121405', '滕州'),
(776, '101121501', '日照'),
(777, '101121502', '五莲'),
(778, '101121503', '莒县'),
(779, '101121601', '莱芜'),
(780, '101121701', '聊城'),
(781, '101121702', '冠县'),
(782, '101121703', '阳谷'),
(783, '101121704', '高唐'),
(784, '101121705', '茌平'),
(785, '101121706', '东阿'),
(786, '101121707', '临清'),
(787, '101121709', '莘县'),
(788, '101130101', '乌鲁木齐'),
(789, '101130105', '达坂城'),
(790, '101130201', '克拉玛依'),
(791, '101130202', '乌尔禾'),
(792, '101130203', '白碱滩'),
(793, '101130301', '石河子'),
(794, '101130401', '昌吉'),
(795, '101130402', '呼图壁'),
(796, '101130403', '米泉'),
(797, '101130404', '阜康'),
(798, '101130405', '吉木萨尔'),
(799, '101130406', '奇台'),
(800, '101130407', '玛纳斯'),
(801, '101130408', '木垒'),
(802, '101130501', '吐鲁番'),
(803, '101130503', '克州'),
(804, '101130504', '鄯善'),
(805, '101130601', '库尔勒'),
(806, '101130602', '轮台'),
(807, '101130603', '尉犁'),
(808, '101130604', '若羌'),
(809, '101130605', '且末'),
(810, '101130606', '和静'),
(811, '101130607', '焉耆'),
(812, '101130608', '和硕'),
(813, '101130612', '博湖'),
(814, '101130701', '阿拉尔'),
(815, '101130801', '阿克苏'),
(816, '101130802', '乌什'),
(817, '101130803', '温宿'),
(818, '101130804', '拜城'),
(819, '101130805', '新和'),
(820, '101130806', '沙雅'),
(821, '101130807', '库车'),
(822, '101130808', '柯坪'),
(823, '101130809', '阿瓦提'),
(824, '101130901', '喀什'),
(825, '101130902', '英吉沙'),
(826, '101130903', '塔什库尔干'),
(827, '101130904', '麦盖提'),
(828, '101130905', '莎车'),
(829, '101130906', '叶城'),
(830, '101130907', '泽普'),
(831, '101130908', '巴楚'),
(832, '101130909', '岳普湖'),
(833, '101130910', '伽师'),
(834, '101130911', '疏附'),
(835, '101130912', '疏勒'),
(836, '101131001', '伊宁'),
(837, '101131002', '察布查尔'),
(838, '101131003', '尼勒克'),
(839, '101131005', '巩留'),
(840, '101131006', '新源'),
(841, '101131007', '昭苏'),
(842, '101131008', '特克斯'),
(843, '101131009', '霍城'),
(844, '101131011', '奎屯'),
(845, '101131101', '塔城'),
(846, '101131102', '裕民'),
(847, '101131103', '额敏'),
(848, '101131104', '和布克赛尔'),
(849, '101131105', '托里'),
(850, '101131106', '乌苏'),
(851, '101131107', '沙湾'),
(852, '101131201', '哈密'),
(853, '101131203', '巴里坤'),
(854, '101131204', '伊吾'),
(855, '101131301', '和田'),
(856, '101131302', '皮山'),
(857, '101131303', '策勒'),
(858, '101131304', '墨玉'),
(859, '101131305', '洛浦'),
(860, '101131306', '民丰'),
(861, '101131307', '于田'),
(862, '101131401', '阿勒泰'),
(863, '101131402', '哈巴河'),
(864, '101131405', '吉木乃'),
(865, '101131406', '布尔津'),
(866, '101131407', '福海'),
(867, '101131408', '富蕴'),
(868, '101131409', '青河'),
(869, '101131501', '阿图什'),
(870, '101131502', '乌恰'),
(871, '101131503', '阿克陶'),
(872, '101131504', '阿合奇'),
(873, '101131601', '博乐'),
(874, '101131602', '温泉'),
(875, '101131603', '精河'),
(876, '101140101', '拉萨'),
(877, '101140102', '当雄'),
(878, '101140103', '尼木'),
(879, '101140104', '林周'),
(880, '101140105', '堆龙德庆'),
(881, '101140106', '曲水'),
(882, '101140107', '达孜'),
(883, '101140108', '墨竹工卡'),
(884, '101140201', '日喀则'),
(885, '101140202', '拉孜'),
(886, '101140204', '聂拉木'),
(887, '101140205', '定日'),
(888, '101140206', '江孜'),
(889, '101140208', '仲巴'),
(890, '101140209', '萨嘎'),
(891, '101140210', '吉隆'),
(892, '101140211', '昂仁'),
(893, '101140212', '定结'),
(894, '101140213', '萨迦'),
(895, '101140214', '谢通门'),
(896, '101140215', '楠木林'),
(897, '101140216', '岗巴'),
(898, '101140217', '白朗'),
(899, '101140218', '亚东'),
(900, '101140219', '康马'),
(901, '101140220', '仁布'),
(902, '101140301', '山南'),
(903, '101140302', '贡嘎'),
(904, '101140303', '札囊'),
(905, '101140304', '加查'),
(906, '101140305', '浪卡子'),
(907, '101140306', '错那'),
(908, '101140307', '隆子'),
(909, '101140309', '乃东'),
(910, '101140310', '桑日'),
(911, '101140311', '洛扎'),
(912, '101140312', '措美'),
(913, '101140313', '琼结'),
(914, '101140314', '曲松'),
(915, '101140401', '林芝'),
(916, '101140402', '波密'),
(917, '101140403', '米林'),
(918, '101140404', '察隅'),
(919, '101140405', '工布江达'),
(920, '101140406', '朗县'),
(921, '101140407', '墨脱'),
(922, '101140501', '昌都'),
(923, '101140502', '丁青'),
(924, '101140503', '边坝'),
(925, '101140504', '洛隆'),
(926, '101140505', '左贡'),
(927, '101140506', '芒康'),
(928, '101140507', '类乌齐'),
(929, '101140508', '八宿'),
(930, '101140509', '江达'),
(931, '101140510', '察雅'),
(932, '101140511', '贡觉'),
(933, '101140601', '那曲'),
(934, '101140602', '尼玛'),
(935, '101140603', '嘉黎'),
(936, '101140604', '班戈'),
(937, '101140605', '安多'),
(938, '101140606', '索县'),
(939, '101140607', '聂荣'),
(940, '101140608', '巴青'),
(941, '101140609', '比如'),
(942, '101140610', '双湖'),
(943, '101140701', '阿里'),
(944, '101140702', '改则'),
(945, '101140703', '申扎'),
(946, '101140705', '普兰'),
(947, '101140706', '札达'),
(948, '101140707', '噶尔'),
(949, '101140708', '日土'),
(950, '101140709', '革吉'),
(951, '101140710', '措勤'),
(952, '101150101', '西宁'),
(953, '101150102', '大通'),
(954, '101150103', '湟源'),
(955, '101150104', '湟中'),
(956, '101150201', '海东'),
(957, '101150202', '乐都'),
(958, '101150203', '民和'),
(959, '101150204', '互助'),
(960, '101150205', '化隆'),
(961, '101150206', '循化'),
(962, '101150208', '平安'),
(963, '101150301', '黄南'),
(964, '101150302', '尖扎'),
(965, '101150303', '泽库'),
(966, '101150305', '同仁'),
(967, '101150401', '海南'),
(968, '101150404', '贵德'),
(969, '101150406', '兴海'),
(970, '101150407', '贵南'),
(971, '101150408', '同德'),
(972, '101150409', '共和'),
(973, '101150501', '果洛'),
(974, '101150502', '班玛'),
(975, '101150503', '甘德'),
(976, '101150504', '达日'),
(977, '101150505', '久治'),
(978, '101150506', '玛多'),
(979, '101150508', '玛沁'),
(980, '101150601', '玉树'),
(981, '101150602', '称多'),
(982, '101150603', '治多'),
(983, '101150604', '杂多'),
(984, '101150605', '囊谦'),
(985, '101150606', '曲麻莱'),
(986, '101150701', '海西'),
(987, '101150708', '天峻'),
(988, '101150709', '乌兰'),
(989, '101150716', '德令哈'),
(990, '101150801', '海北'),
(991, '101150802', '门源'),
(992, '101150803', '祁连'),
(993, '101150804', '海晏'),
(994, '101150806', '刚察'),
(995, '101150901', '格尔木'),
(996, '101150902', '都兰'),
(997, '101160101', '兰州'),
(998, '101160102', '皋兰'),
(999, '101160103', '永登'),
(1000, '101160104', '榆中'),
(1001, '101160201', '定西'),
(1002, '101160202', '通渭'),
(1003, '101160203', '陇西'),
(1004, '101160204', '渭源'),
(1005, '101160205', '临洮'),
(1006, '101160206', '漳县'),
(1007, '101160207', '岷县'),
(1008, '101160301', '平凉'),
(1009, '101160302', '泾川'),
(1010, '101160303', '灵台'),
(1011, '101160304', '崇信'),
(1012, '101160305', '华亭'),
(1013, '101160306', '庄浪'),
(1014, '101160307', '静宁'),
(1015, '101160401', '庆阳'),
(1016, '101160402', '西峰'),
(1017, '101160403', '环县'),
(1018, '101160404', '华池'),
(1019, '101160405', '合水'),
(1020, '101160406', '正宁'),
(1021, '101160407', '宁县'),
(1022, '101160408', '镇原'),
(1023, '101160409', '庆城'),
(1024, '101160501', '武威'),
(1025, '101160502', '民勤'),
(1026, '101160503', '古浪'),
(1027, '101160505', '天祝'),
(1028, '101160601', '金昌'),
(1029, '101160602', '永昌'),
(1030, '101160701', '张掖'),
(1031, '101160702', '肃南'),
(1032, '101160703', '民乐'),
(1033, '101160704', '临泽'),
(1034, '101160705', '高台'),
(1035, '101160706', '山丹'),
(1036, '101160801', '酒泉'),
(1037, '101160803', '金塔'),
(1038, '101160804', '阿克塞'),
(1039, '101160805', '瓜州'),
(1040, '101160806', '肃北'),
(1041, '101160807', '玉门'),
(1042, '101160808', '敦煌'),
(1043, '101160901', '天水'),
(1044, '101160903', '清水'),
(1045, '101160904', '秦安'),
(1046, '101160905', '甘谷'),
(1047, '101160906', '武山'),
(1048, '101160907', '张家川'),
(1049, '101161001', '陇南'),
(1050, '101161002', '成县'),
(1051, '101161003', '文县'),
(1052, '101161004', '宕昌'),
(1053, '101161005', '康县'),
(1054, '101161006', '西和'),
(1055, '101161007', '礼县'),
(1056, '101161008', '徽县'),
(1057, '101161009', '两当'),
(1058, '101161101', '临夏'),
(1059, '101161102', '康乐'),
(1060, '101161103', '永靖'),
(1061, '101161104', '广河'),
(1062, '101161105', '和政'),
(1063, '101161107', '积石山'),
(1064, '101161201', '合作'),
(1065, '101161202', '临潭'),
(1066, '101161203', '卓尼'),
(1067, '101161204', '舟曲'),
(1068, '101161205', '迭部'),
(1069, '101161206', '玛曲'),
(1070, '101161207', '碌曲'),
(1071, '101161208', '夏河'),
(1072, '101161301', '白银'),
(1073, '101161302', '靖远'),
(1074, '101161303', '会宁'),
(1075, '101161304', '平川'),
(1076, '101161305', '景泰'),
(1077, '101161401', '嘉峪关'),
(1078, '101170101', '银川'),
(1079, '101170102', '永宁'),
(1080, '101170103', '灵武'),
(1081, '101170104', '贺兰'),
(1082, '101170201', '石嘴山'),
(1083, '101170203', '平罗'),
(1084, '101170301', '吴忠'),
(1085, '101170302', '同心'),
(1086, '101170303', '盐池'),
(1087, '101170306', '青铜峡'),
(1088, '101170401', '固原'),
(1089, '101170402', '西吉'),
(1090, '101170403', '隆德'),
(1091, '101170404', '泾源'),
(1092, '101170406', '彭阳'),
(1093, '101170501', '中卫'),
(1094, '101170502', '中宁'),
(1095, '101170504', '海原'),
(1096, '101180101', '郑州'),
(1097, '101180102', '巩义'),
(1098, '101180103', '荥阳'),
(1099, '101180104', '登封'),
(1100, '101180105', '新密'),
(1101, '101180106', '新郑'),
(1102, '101180107', '中牟'),
(1103, '101180108', '上街'),
(1104, '101180201', '安阳'),
(1105, '101180202', '汤阴'),
(1106, '101180203', '滑县'),
(1107, '101180204', '内黄'),
(1108, '101180205', '林州'),
(1109, '101180301', '新乡'),
(1110, '101180302', '获嘉'),
(1111, '101180303', '原阳'),
(1112, '101180304', '辉县'),
(1113, '101180305', '卫辉'),
(1114, '101180306', '延津'),
(1115, '101180307', '封丘'),
(1116, '101180308', '长垣'),
(1117, '101180401', '许昌'),
(1118, '101180402', '鄢陵'),
(1119, '101180403', '襄城'),
(1120, '101180404', '长葛'),
(1121, '101180405', '禹州'),
(1122, '101180501', '平顶山'),
(1123, '101180502', '郏县'),
(1124, '101180503', '宝丰'),
(1125, '101180504', '汝州'),
(1126, '101180505', '叶县'),
(1127, '101180506', '舞钢'),
(1128, '101180507', '鲁山'),
(1129, '101180508', '石龙'),
(1130, '101180601', '信阳'),
(1131, '101180602', '息县'),
(1132, '101180603', '罗山'),
(1133, '101180604', '光山'),
(1134, '101180605', '新县'),
(1135, '101180606', '淮滨'),
(1136, '101180607', '潢川'),
(1137, '101180608', '固始'),
(1138, '101180609', '商城'),
(1139, '101180701', '南阳'),
(1140, '101180702', '南召'),
(1141, '101180703', '方城'),
(1142, '101180704', '社旗'),
(1143, '101180705', '西峡'),
(1144, '101180706', '内乡'),
(1145, '101180707', '镇平'),
(1146, '101180708', '淅川'),
(1147, '101180709', '新野'),
(1148, '101180710', '唐河'),
(1149, '101180711', '邓州'),
(1150, '101180712', '桐柏'),
(1151, '101180801', '开封'),
(1152, '101180802', '杞县'),
(1153, '101180803', '尉氏'),
(1154, '101180804', '通许'),
(1155, '101180805', '兰考'),
(1156, '101180901', '洛阳'),
(1157, '101180902', '新安'),
(1158, '101180903', '孟津'),
(1159, '101180904', '宜阳'),
(1160, '101180905', '洛宁'),
(1161, '101180906', '伊川'),
(1162, '101180907', '嵩县'),
(1163, '101180908', '偃师'),
(1164, '101180909', '栾川'),
(1165, '101180910', '汝阳'),
(1166, '101180911', '吉利'),
(1167, '101181001', '商丘'),
(1168, '101181003', '睢县'),
(1169, '101181004', '民权'),
(1170, '101181005', '虞城'),
(1171, '101181006', '柘城'),
(1172, '101181007', '宁陵'),
(1173, '101181008', '夏邑'),
(1174, '101181009', '永城'),
(1175, '101181101', '焦作'),
(1176, '101181102', '修武'),
(1177, '101181103', '武陟'),
(1178, '101181104', '沁阳'),
(1179, '101181106', '博爱'),
(1180, '101181107', '温县'),
(1181, '101181108', '孟州'),
(1182, '101181201', '鹤壁'),
(1183, '101181202', '浚县'),
(1184, '101181203', '淇县'),
(1185, '101181301', '濮阳'),
(1186, '101181302', '台前'),
(1187, '101181303', '南乐'),
(1188, '101181304', '清丰'),
(1189, '101181305', '范县'),
(1190, '101181401', '周口'),
(1191, '101181402', '扶沟'),
(1192, '101181403', '太康'),
(1193, '101181404', '淮阳'),
(1194, '101181405', '西华'),
(1195, '101181406', '商水'),
(1196, '101181407', '项城'),
(1197, '101181408', '郸城'),
(1198, '101181409', '鹿邑'),
(1199, '101181410', '沈丘'),
(1200, '101181501', '漯河'),
(1201, '101181502', '临颍'),
(1202, '101181503', '舞阳'),
(1203, '101181504', '临颖'),
(1204, '101181601', '驻马店'),
(1205, '101181602', '西平'),
(1206, '101181603', '遂平'),
(1207, '101181604', '上蔡'),
(1208, '101181605', '汝南'),
(1209, '101181606', '泌阳'),
(1210, '101181607', '平舆'),
(1211, '101181608', '新蔡'),
(1212, '101181609', '确山'),
(1213, '101181610', '正阳'),
(1214, '101181701', '三门峡'),
(1215, '101181702', '灵宝'),
(1216, '101181703', '渑池'),
(1217, '101181704', '卢氏'),
(1218, '101181705', '义马'),
(1219, '101181706', '陕县'),
(1220, '101181801', '济源'),
(1221, '101190101', '南京'),
(1222, '101190102', '溧水'),
(1223, '101190103', '高淳'),
(1224, '101190104', '江宁'),
(1225, '101190105', '六合'),
(1226, '101190107', '浦口'),
(1227, '101190201', '无锡'),
(1228, '101190202', '江阴'),
(1229, '101190203', '宜兴'),
(1230, '101190204', '锡山'),
(1231, '101190301', '镇江'),
(1232, '101190302', '丹阳'),
(1233, '101190303', '扬中'),
(1234, '101190304', '句容'),
(1235, '101190305', '丹徒'),
(1236, '101190401', '苏州'),
(1237, '101190402', '常熟'),
(1238, '101190403', '张家港'),
(1239, '101190404', '昆山'),
(1240, '101190405', '吴中'),
(1241, '101190407', '吴江'),
(1242, '101190408', '太仓'),
(1243, '101190501', '南通'),
(1244, '101190502', '海安'),
(1245, '101190503', '如皋'),
(1246, '101190504', '如东'),
(1247, '101190507', '启东'),
(1248, '101190508', '海门'),
(1249, '101190601', '扬州'),
(1250, '101190602', '宝应'),
(1251, '101190603', '仪征'),
(1252, '101190604', '高邮'),
(1253, '101190605', '江都'),
(1254, '101190606', '邗江'),
(1255, '101190701', '盐城'),
(1256, '101190702', '响水'),
(1257, '101190703', '滨海'),
(1258, '101190704', '阜宁'),
(1259, '101190705', '射阳'),
(1260, '101190706', '建湖'),
(1261, '101190707', '东台'),
(1262, '101190708', '大丰'),
(1263, '101190709', '盐都'),
(1264, '101190801', '徐州'),
(1265, '101190802', '铜山'),
(1266, '101190803', '丰县'),
(1267, '101190804', '沛县'),
(1268, '101190805', '邳州'),
(1269, '101190806', '睢宁'),
(1270, '101190807', '新沂'),
(1271, '101190901', '淮安'),
(1272, '101190902', '金湖'),
(1273, '101190903', '盱眙'),
(1274, '101190904', '洪泽'),
(1275, '101190905', '涟水'),
(1276, '101191001', '连云港'),
(1277, '101191002', '东海'),
(1278, '101191003', '赣榆'),
(1279, '101191004', '灌云'),
(1280, '101191005', '灌南'),
(1281, '101191101', '常州'),
(1282, '101191102', '溧阳'),
(1283, '101191103', '金坛'),
(1284, '101191104', '武进'),
(1285, '101191201', '泰州'),
(1286, '101191202', '兴化'),
(1287, '101191203', '泰兴'),
(1288, '101191204', '姜堰'),
(1289, '101191205', '靖江'),
(1290, '101191301', '宿迁'),
(1291, '101191302', '沭阳'),
(1292, '101191303', '泗阳'),
(1293, '101191304', '泗洪'),
(1294, '101191305', '宿豫'),
(1295, '101200101', '武汉'),
(1296, '101200102', '蔡甸'),
(1297, '101200103', '黄陂'),
(1298, '101200104', '新洲'),
(1299, '101200105', '江夏'),
(1300, '101200106', '东西湖'),
(1301, '101200201', '襄阳'),
(1302, '101200202', '襄州'),
(1303, '101200203', '保康'),
(1304, '101200204', '南漳'),
(1305, '101200205', '宜城'),
(1306, '101200206', '老河口'),
(1307, '101200207', '谷城'),
(1308, '101200208', '枣阳'),
(1309, '101200301', '鄂州'),
(1310, '101200302', '梁子湖'),
(1311, '101200401', '孝感'),
(1312, '101200402', '安陆'),
(1313, '101200403', '云梦'),
(1314, '101200404', '大悟'),
(1315, '101200405', '应城'),
(1316, '101200406', '汉川'),
(1317, '101200407', '孝昌'),
(1318, '101200501', '黄冈'),
(1319, '101200502', '红安'),
(1320, '101200503', '麻城'),
(1321, '101200504', '罗田'),
(1322, '101200505', '英山'),
(1323, '101200506', '浠水'),
(1324, '101200507', '蕲春'),
(1325, '101200508', '黄梅'),
(1326, '101200509', '武穴'),
(1327, '101200510', '团风'),
(1328, '101200601', '黄石'),
(1329, '101200602', '大冶'),
(1330, '101200603', '阳新'),
(1331, '101200604', '铁山'),
(1332, '101200605', '下陆'),
(1333, '101200606', '西塞山'),
(1334, '101200701', '咸宁'),
(1335, '101200702', '赤壁'),
(1336, '101200703', '嘉鱼'),
(1337, '101200704', '崇阳'),
(1338, '101200705', '通城'),
(1339, '101200706', '通山'),
(1340, '101200801', '荆州'),
(1341, '101200802', '江陵'),
(1342, '101200803', '公安'),
(1343, '101200804', '石首'),
(1344, '101200805', '监利'),
(1345, '101200806', '洪湖'),
(1346, '101200807', '松滋'),
(1347, '101200901', '宜昌'),
(1348, '101200902', '远安'),
(1349, '101200903', '秭归'),
(1350, '101200904', '兴山'),
(1351, '101200906', '五峰'),
(1352, '101200907', '当阳'),
(1353, '101200908', '长阳'),
(1354, '101200909', '宜都'),
(1355, '101200910', '枝江'),
(1356, '101201001', '恩施'),
(1357, '101201002', '利川'),
(1358, '101201003', '建始'),
(1359, '101201004', '咸丰'),
(1360, '101201005', '宣恩'),
(1361, '101201006', '鹤峰'),
(1362, '101201007', '来凤'),
(1363, '101201008', '巴东'),
(1364, '101201101', '十堰'),
(1365, '101201102', '竹溪'),
(1366, '101201103', '郧西'),
(1367, '101201104', '郧县'),
(1368, '101201105', '竹山'),
(1369, '101201106', '房县'),
(1370, '101201107', '丹江口'),
(1371, '101201108', '茅箭'),
(1372, '101201109', '张湾'),
(1373, '101201201', '神农架'),
(1374, '101201301', '随州'),
(1375, '101201302', '广水'),
(1376, '101201401', '荆门'),
(1377, '101201402', '钟祥'),
(1378, '101201403', '京山'),
(1379, '101201404', '掇刀'),
(1380, '101201405', '沙洋'),
(1381, '101201406', '沙市'),
(1382, '101201501', '天门'),
(1383, '101201601', '仙桃'),
(1384, '101201701', '潜江'),
(1385, '101210101', '杭州'),
(1386, '101210102', '萧山'),
(1387, '101210103', '桐庐'),
(1388, '101210104', '淳安'),
(1389, '101210105', '建德'),
(1390, '101210106', '余杭'),
(1391, '101210107', '临安'),
(1392, '101210108', '富阳'),
(1393, '101210201', '湖州'),
(1394, '101210202', '长兴'),
(1395, '101210203', '安吉'),
(1396, '101210204', '德清'),
(1397, '101210301', '嘉兴'),
(1398, '101210302', '嘉善'),
(1399, '101210303', '海宁'),
(1400, '101210304', '桐乡'),
(1401, '101210305', '平湖'),
(1402, '101210306', '海盐'),
(1403, '101210401', '宁波'),
(1404, '101210403', '慈溪'),
(1405, '101210404', '余姚'),
(1406, '101210405', '奉化'),
(1407, '101210406', '象山'),
(1408, '101210408', '宁海'),
(1409, '101210410', '北仑'),
(1410, '101210411', '鄞州'),
(1411, '101210501', '绍兴'),
(1412, '101210502', '诸暨'),
(1413, '101210503', '上虞'),
(1414, '101210504', '新昌'),
(1415, '101210505', '嵊州'),
(1416, '101210601', '台州'),
(1417, '101210603', '玉环'),
(1418, '101210604', '三门'),
(1419, '101210605', '天台'),
(1420, '101210606', '仙居'),
(1421, '101210607', '温岭'),
(1422, '101210610', '临海'),
(1423, '101210701', '温州'),
(1424, '101210702', '泰顺'),
(1425, '101210703', '文成'),
(1426, '101210704', '平阳'),
(1427, '101210705', '瑞安'),
(1428, '101210706', '洞头'),
(1429, '101210707', '乐清'),
(1430, '101210708', '永嘉'),
(1431, '101210709', '苍南'),
(1432, '101210801', '丽水'),
(1433, '101210802', '遂昌'),
(1434, '101210803', '龙泉'),
(1435, '101210804', '缙云'),
(1436, '101210805', '青田'),
(1437, '101210806', '云和'),
(1438, '101210807', '庆元'),
(1439, '101210808', '松阳'),
(1440, '101210809', '景宁'),
(1441, '101210901', '金华'),
(1442, '101210902', '浦江'),
(1443, '101210903', '兰溪'),
(1444, '101210904', '义乌'),
(1445, '101210905', '东阳'),
(1446, '101210906', '武义'),
(1447, '101210907', '永康'),
(1448, '101210908', '磐安'),
(1449, '101211001', '衢州'),
(1450, '101211002', '常山'),
(1451, '101211003', '开化'),
(1452, '101211004', '龙游'),
(1453, '101211005', '江山'),
(1454, '101211101', '舟山'),
(1455, '101211102', '嵊泗'),
(1456, '101211104', '岱山'),
(1457, '101220101', '合肥'),
(1458, '101220102', '长丰'),
(1459, '101220103', '肥东'),
(1460, '101220104', '肥西'),
(1461, '101220201', '蚌埠'),
(1462, '101220202', '怀远'),
(1463, '101220203', '固镇'),
(1464, '101220204', '五河'),
(1465, '101220301', '芜湖'),
(1466, '101220302', '繁昌'),
(1467, '101220304', '南陵'),
(1468, '101220401', '淮南'),
(1469, '101220402', '凤台'),
(1470, '101220403', '潘集'),
(1471, '101220501', '马鞍山'),
(1472, '101220502', '当涂'),
(1473, '101220601', '安庆'),
(1474, '101220602', '枞阳'),
(1475, '101220603', '太湖'),
(1476, '101220604', '潜山'),
(1477, '101220605', '怀宁'),
(1478, '101220606', '宿松'),
(1479, '101220607', '望江'),
(1480, '101220608', '岳西'),
(1481, '101220609', '桐城'),
(1482, '101220701', '宿州'),
(1483, '101220702', '砀山'),
(1484, '101220703', '灵璧'),
(1485, '101220704', '泗县'),
(1486, '101220705', '萧县'),
(1487, '101220801', '阜阳'),
(1488, '101220802', '阜南'),
(1489, '101220803', '颍上'),
(1490, '101220804', '临泉'),
(1491, '101220805', '界首'),
(1492, '101220806', '太和'),
(1493, '101220901', '亳州'),
(1494, '101220902', '涡阳'),
(1495, '101220903', '利辛'),
(1496, '101220904', '蒙城'),
(1497, '101221001', '黄山'),
(1498, '101221004', '祁门'),
(1499, '101221005', '黟县'),
(1500, '101221006', '歙县'),
(1501, '101221007', '休宁'),
(1502, '101221101', '滁州'),
(1503, '101221102', '凤阳'),
(1504, '101221103', '明光'),
(1505, '101221104', '定远'),
(1506, '101221105', '全椒'),
(1507, '101221106', '来安'),
(1508, '101221107', '天长'),
(1509, '101221201', '淮北'),
(1510, '101221202', '濉溪'),
(1511, '101221301', '铜陵'),
(1512, '101221401', '宣城'),
(1513, '101221402', '泾县'),
(1514, '101221403', '旌德'),
(1515, '101221404', '宁国'),
(1516, '101221405', '绩溪'),
(1517, '101221406', '广德'),
(1518, '101221407', '郎溪'),
(1519, '101221501', '六安'),
(1520, '101221502', '霍邱'),
(1521, '101221503', '寿县'),
(1522, '101221505', '金寨'),
(1523, '101221506', '霍山'),
(1524, '101221507', '舒城'),
(1525, '101221601', '巢湖'),
(1526, '101221602', '庐江'),
(1527, '101221603', '无为'),
(1528, '101221604', '含山'),
(1529, '101221605', '和县'),
(1530, '101221701', '池州'),
(1531, '101221702', '东至'),
(1532, '101221703', '青阳'),
(1533, '101221705', '石台'),
(1534, '101230101', '唐山'),
(1535, '101230102', '闽清'),
(1536, '101230103', '闽侯'),
(1537, '101230104', '罗源'),
(1538, '101230105', '连江'),
(1539, '101230107', '永泰'),
(1540, '101230108', '平潭'),
(1541, '101230110', '长乐'),
(1542, '101230111', '福清'),
(1543, '101230201', '厦门'),
(1544, '101230301', '宁德'),
(1545, '101230302', '古田'),
(1546, '101230303', '霞浦'),
(1547, '101230304', '寿宁'),
(1548, '101230305', '周宁'),
(1549, '101230306', '福安'),
(1550, '101230307', '柘荣'),
(1551, '101230308', '福鼎'),
(1552, '101230309', '屏南'),
(1553, '101230401', '莆田'),
(1554, '101230402', '仙游'),
(1555, '101230404', '涵江'),
(1556, '101230405', '秀屿'),
(1557, '101230406', '荔城'),
(1558, '101230407', '城厢'),
(1559, '101230501', '泉州'),
(1560, '101230502', '安溪'),
(1561, '101230504', '永春'),
(1562, '101230505', '德化'),
(1563, '101230506', '南安'),
(1564, '101230508', '惠安'),
(1565, '101230509', '晋江'),
(1566, '101230510', '石狮'),
(1567, '101230601', '漳州'),
(1568, '101230602', '长泰'),
(1569, '101230603', '南靖'),
(1570, '101230604', '平和'),
(1571, '101230605', '龙海'),
(1572, '101230606', '漳浦'),
(1573, '101230607', '诏安'),
(1574, '101230609', '云霄'),
(1575, '101230610', '华安'),
(1576, '101230701', '龙岩'),
(1577, '101230702', '长汀'),
(1578, '101230703', '连城'),
(1579, '101230704', '武平'),
(1580, '101230705', '上杭'),
(1581, '101230706', '永定'),
(1582, '101230707', '漳平'),
(1583, '101230801', '三明'),
(1584, '101230802', '宁化'),
(1585, '101230803', '清流'),
(1586, '101230804', '泰宁'),
(1587, '101230805', '将乐'),
(1588, '101230806', '建宁'),
(1589, '101230807', '明溪'),
(1590, '101230808', '沙县'),
(1591, '101230809', '尤溪'),
(1592, '101230810', '永安'),
(1593, '101230811', '大田'),
(1594, '101230901', '南平'),
(1595, '101230902', '顺昌'),
(1596, '101230903', '光泽'),
(1597, '101230904', '邵武'),
(1598, '101230905', '武夷山'),
(1599, '101230906', '浦城'),
(1600, '101230907', '建阳'),
(1601, '101230908', '松溪'),
(1602, '101230909', '政和'),
(1603, '101230910', '建瓯'),
(1604, '101231001', '钓鱼岛'),
(1605, '101240101', '南昌'),
(1606, '101240102', '新建'),
(1607, '101240104', '安义'),
(1608, '101240105', '进贤'),
(1609, '101240201', '九江'),
(1610, '101240202', '瑞昌'),
(1611, '101240204', '武宁'),
(1612, '101240205', '德安'),
(1613, '101240206', '永修'),
(1614, '101240207', '湖口'),
(1615, '101240208', '彭泽'),
(1616, '101240209', '星子'),
(1617, '101240210', '都昌'),
(1618, '101240212', '修水'),
(1619, '101240301', '上饶'),
(1620, '101240302', '鄱阳'),
(1621, '101240303', '婺源'),
(1622, '101240305', '余干'),
(1623, '101240306', '万年'),
(1624, '101240307', '德兴'),
(1625, '101240309', '弋阳'),
(1626, '101240310', '横峰'),
(1627, '101240311', '铅山'),
(1628, '101240312', '玉山'),
(1629, '101240313', '广丰'),
(1630, '101240401', '抚州'),
(1631, '101240402', '广昌'),
(1632, '101240403', '乐安'),
(1633, '101240404', '崇仁'),
(1634, '101240405', '金溪'),
(1635, '101240406', '资溪'),
(1636, '101240407', '宜黄'),
(1637, '101240408', '南城'),
(1638, '101240409', '南丰'),
(1639, '101240410', '黎川'),
(1640, '101240411', '东乡'),
(1641, '101240501', '宜春'),
(1642, '101240502', '铜鼓'),
(1643, '101240503', '宜丰'),
(1644, '101240504', '万载'),
(1645, '101240505', '上高'),
(1646, '101240506', '靖安'),
(1647, '101240507', '奉新'),
(1648, '101240508', '高安'),
(1649, '101240509', '樟树'),
(1650, '101240510', '丰城'),
(1651, '101240601', '吉安'),
(1652, '101240603', '吉水'),
(1653, '101240604', '新干'),
(1654, '101240605', '峡江'),
(1655, '101240606', '永丰'),
(1656, '101240607', '永新'),
(1657, '101240608', '井冈山'),
(1658, '101240609', '万安'),
(1659, '101240610', '遂川'),
(1660, '101240611', '泰和'),
(1661, '101240612', '安福'),
(1662, '101240701', '赣州'),
(1663, '101240702', '崇义'),
(1664, '101240703', '上犹'),
(1665, '101240704', '南康'),
(1666, '101240705', '大余'),
(1667, '101240706', '信丰'),
(1668, '101240707', '宁都'),
(1669, '101240708', '石城'),
(1670, '101240709', '瑞金'),
(1671, '101240710', '于都'),
(1672, '101240711', '会昌'),
(1673, '101240712', '安远'),
(1674, '101240713', '全南'),
(1675, '101240714', '龙南'),
(1676, '101240715', '定南'),
(1677, '101240716', '寻乌'),
(1678, '101240717', '兴国'),
(1679, '101240718', '赣县'),
(1680, '101240801', '景德镇'),
(1681, '101240802', '乐平'),
(1682, '101240803', '浮梁'),
(1683, '101240901', '萍乡'),
(1684, '101240902', '莲花'),
(1685, '101240903', '上栗'),
(1686, '101240905', '芦溪'),
(1687, '101240906', '湘东'),
(1688, '101241001', '新余'),
(1689, '101241002', '分宜'),
(1690, '101241101', '鹰潭'),
(1691, '101241102', '余江'),
(1692, '101241103', '贵溪'),
(1693, '101250101', '长沙'),
(1694, '101250102', '宁乡'),
(1695, '101250103', '浏阳'),
(1696, '101250105', '望城'),
(1697, '101250201', '湘潭'),
(1698, '101250202', '韶山'),
(1699, '101250203', '湘乡'),
(1700, '101250301', '株洲'),
(1701, '101250302', '攸县'),
(1702, '101250303', '醴陵'),
(1703, '101250305', '茶陵'),
(1704, '101250306', '炎陵'),
(1705, '101250401', '衡阳'),
(1706, '101250402', '衡山'),
(1707, '101250403', '衡东'),
(1708, '101250404', '祁东'),
(1709, '101250406', '常宁'),
(1710, '101250407', '衡南'),
(1711, '101250408', '耒阳'),
(1712, '101250501', '郴州'),
(1713, '101250502', '桂阳'),
(1714, '101250503', '嘉禾'),
(1715, '101250504', '宜章'),
(1716, '101250505', '临武'),
(1717, '101250507', '资兴'),
(1718, '101250508', '汝城'),
(1719, '101250509', '安仁'),
(1720, '101250510', '永兴'),
(1721, '101250511', '桂东'),
(1722, '101250512', '苏仙'),
(1723, '101250601', '常德'),
(1724, '101250602', '安乡'),
(1725, '101250603', '桃源'),
(1726, '101250604', '汉寿'),
(1727, '101250605', '澧县'),
(1728, '101250606', '临澧'),
(1729, '101250607', '石门'),
(1730, '101250608', '津市'),
(1731, '101250700', '益阳'),
(1732, '101250702', '南县'),
(1733, '101250703', '桃江'),
(1734, '101250704', '安化'),
(1735, '101250705', '沅江'),
(1736, '101250801', '娄底'),
(1737, '101250802', '双峰'),
(1738, '101250803', '冷水江'),
(1739, '101250805', '新化'),
(1740, '101250806', '涟源'),
(1741, '101250901', '邵阳'),
(1742, '101250902', '隆回'),
(1743, '101250903', '洞口');
INSERT INTO `wy_weather` (`id`, `code`, `name`) VALUES
(1744, '101250904', '新邵'),
(1745, '101250905', '邵东'),
(1746, '101250906', '绥宁'),
(1747, '101250907', '新宁'),
(1748, '101250908', '武冈'),
(1749, '101250909', '城步'),
(1750, '101251001', '岳阳'),
(1751, '101251002', '华容'),
(1752, '101251003', '湘阴'),
(1753, '101251004', '汨罗'),
(1754, '101251005', '平江'),
(1755, '101251006', '临湘'),
(1756, '101251101', '张家界'),
(1757, '101251102', '桑植'),
(1758, '101251103', '慈利'),
(1759, '101251104', '武陵源'),
(1760, '101251201', '怀化'),
(1761, '101251203', '沅陵'),
(1762, '101251204', '辰溪'),
(1763, '101251205', '靖州'),
(1764, '101251206', '会同'),
(1765, '101251207', '通道'),
(1766, '101251208', '麻阳'),
(1767, '101251209', '新晃'),
(1768, '101251210', '芷江'),
(1769, '101251211', '溆浦'),
(1770, '101251212', '中方'),
(1771, '101251213', '洪江'),
(1772, '101251401', '永州'),
(1773, '101251402', '祁阳'),
(1774, '101251403', '东安'),
(1775, '101251404', '双牌'),
(1776, '101251405', '道县'),
(1777, '101251406', '宁远'),
(1778, '101251407', '江永'),
(1779, '101251408', '蓝山'),
(1780, '101251409', '新田'),
(1781, '101251410', '江华'),
(1782, '101251501', '吉首'),
(1783, '101251502', '保靖'),
(1784, '101251503', '永顺'),
(1785, '101251504', '古丈'),
(1786, '101251505', '凤凰'),
(1787, '101251506', '泸溪'),
(1788, '101251507', '龙山'),
(1789, '101251508', '花垣'),
(1790, '101260101', '贵阳'),
(1791, '101260102', '白云'),
(1792, '101260103', '花溪'),
(1793, '101260104', '乌当'),
(1794, '101260105', '息烽'),
(1795, '101260106', '开阳'),
(1796, '101260107', '修文'),
(1797, '101260108', '清镇'),
(1798, '101260109', '小河'),
(1799, '101260110', '云岩'),
(1800, '101260111', '南明'),
(1801, '101260201', '遵义'),
(1802, '101260203', '仁怀'),
(1803, '101260204', '绥阳'),
(1804, '101260205', '湄潭'),
(1805, '101260206', '凤冈'),
(1806, '101260207', '桐梓'),
(1807, '101260208', '赤水'),
(1808, '101260209', '习水'),
(1809, '101260210', '道真'),
(1810, '101260211', '正安'),
(1811, '101260212', '务川'),
(1812, '101260213', '余庆'),
(1813, '101260214', '汇川'),
(1814, '101260215', '红花岗'),
(1815, '101260301', '安顺'),
(1816, '101260302', '普定'),
(1817, '101260303', '镇宁'),
(1818, '101260304', '平坝'),
(1819, '101260305', '紫云'),
(1820, '101260306', '关岭'),
(1821, '101260401', '都匀'),
(1822, '101260402', '贵定'),
(1823, '101260403', '瓮安'),
(1824, '101260404', '长顺'),
(1825, '101260405', '福泉'),
(1826, '101260406', '惠水'),
(1827, '101260407', '龙里'),
(1828, '101260408', '罗甸'),
(1829, '101260409', '平塘'),
(1830, '101260410', '独山'),
(1831, '101260411', '三都'),
(1832, '101260412', '荔波'),
(1833, '101260501', '凯里'),
(1834, '101260502', '岑巩'),
(1835, '101260503', '施秉'),
(1836, '101260504', '镇远'),
(1837, '101260505', '黄平'),
(1838, '101260507', '麻江'),
(1839, '101260508', '丹寨'),
(1840, '101260509', '三穗'),
(1841, '101260510', '台江'),
(1842, '101260511', '剑河'),
(1843, '101260512', '雷山'),
(1844, '101260513', '黎平'),
(1845, '101260514', '天柱'),
(1846, '101260515', '锦屏'),
(1847, '101260516', '榕江'),
(1848, '101260517', '从江'),
(1849, '101260601', '铜仁'),
(1850, '101260602', '江口'),
(1851, '101260603', '玉屏'),
(1852, '101260604', '万山特'),
(1853, '101260605', '思南'),
(1854, '101260607', '印江'),
(1855, '101260608', '石阡'),
(1856, '101260609', '沿河'),
(1857, '101260610', '德江'),
(1858, '101260611', '松桃'),
(1859, '101260701', '毕节'),
(1860, '101260702', '赫章'),
(1861, '101260703', '金沙'),
(1862, '101260704', '威宁'),
(1863, '101260705', '大方'),
(1864, '101260706', '纳雍'),
(1865, '101260707', '织金'),
(1866, '101260708', '黔西'),
(1867, '101260801', '水城'),
(1868, '101260802', '六枝特'),
(1869, '101260804', '盘县'),
(1870, '101260901', '兴义'),
(1871, '101260902', '晴隆'),
(1872, '101260903', '兴仁'),
(1873, '101260904', '贞丰'),
(1874, '101260905', '望谟'),
(1875, '101260907', '安龙'),
(1876, '101260908', '册亨'),
(1877, '101260909', '普安'),
(1878, '101270101', '成都'),
(1879, '101270103', '新都'),
(1880, '101270104', '温江'),
(1881, '101270105', '金堂'),
(1882, '101270106', '双流'),
(1883, '101270107', '郫县'),
(1884, '101270108', '大邑'),
(1885, '101270109', '蒲江'),
(1886, '101270110', '新津'),
(1887, '101270111', '都江堰'),
(1888, '101270112', '彭州'),
(1889, '101270113', '邛崃'),
(1890, '101270114', '崇州'),
(1891, '101270201', '攀枝花'),
(1892, '101270203', '米易'),
(1893, '101270204', '盐边'),
(1894, '101270301', '自贡'),
(1895, '101270302', '富顺'),
(1896, '101270303', '荣县'),
(1897, '101270401', '绵阳'),
(1898, '101270402', '三台'),
(1899, '101270403', '盐亭'),
(1900, '101270404', '安县'),
(1901, '101270405', '梓潼'),
(1902, '101270406', '北川'),
(1903, '101270407', '平武'),
(1904, '101270408', '江油'),
(1905, '101270501', '南充'),
(1906, '101270502', '南部'),
(1907, '101270503', '营山'),
(1908, '101270504', '蓬安'),
(1909, '101270505', '仪陇'),
(1910, '101270506', '西充'),
(1911, '101270507', '阆中'),
(1912, '101270601', '达州'),
(1913, '101270602', '宣汉'),
(1914, '101270603', '开江'),
(1915, '101270604', '大竹'),
(1916, '101270605', '渠县'),
(1917, '101270606', '万源'),
(1918, '101270608', '达县'),
(1919, '101270701', '遂宁'),
(1920, '101270702', '蓬溪'),
(1921, '101270703', '射洪'),
(1922, '101270801', '广安'),
(1923, '101270802', '岳池'),
(1924, '101270803', '武胜'),
(1925, '101270804', '邻水'),
(1926, '101270805', '华蓥'),
(1927, '101270901', '巴中'),
(1928, '101270902', '通江'),
(1929, '101270903', '南江'),
(1930, '101270904', '平昌'),
(1931, '101271001', '泸州'),
(1932, '101271003', '泸县'),
(1933, '101271004', '合江'),
(1934, '101271005', '叙永'),
(1935, '101271006', '古蔺'),
(1936, '101271101', '宜宾'),
(1937, '101271104', '南溪'),
(1938, '101271105', '江安'),
(1939, '101271106', '长宁'),
(1940, '101271107', '高县'),
(1941, '101271108', '珙县'),
(1942, '101271109', '筠连'),
(1943, '101271110', '兴文'),
(1944, '101271111', '屏山'),
(1945, '101271201', '内江'),
(1946, '101271203', '威远'),
(1947, '101271204', '资中'),
(1948, '101271205', '隆昌'),
(1949, '101271301', '资阳'),
(1950, '101271302', '安岳'),
(1951, '101271303', '乐至'),
(1952, '101271304', '简阳'),
(1953, '101271401', '乐山'),
(1954, '101271402', '犍为'),
(1955, '101271403', '井研'),
(1956, '101271404', '夹江'),
(1957, '101271405', '沐川'),
(1958, '101271406', '峨边'),
(1959, '101271407', '马边'),
(1960, '101271409', '峨眉山'),
(1961, '101271501', '眉山'),
(1962, '101271502', '仁寿'),
(1963, '101271503', '彭山'),
(1964, '101271504', '洪雅'),
(1965, '101271505', '丹棱'),
(1966, '101271506', '青神'),
(1967, '101271601', '凉山'),
(1968, '101271603', '木里'),
(1969, '101271604', '盐源'),
(1970, '101271605', '德昌'),
(1971, '101271606', '会理'),
(1972, '101271607', '会东'),
(1973, '101271608', '宁南'),
(1974, '101271609', '普格'),
(1975, '101271610', '西昌'),
(1976, '101271611', '金阳'),
(1977, '101271612', '昭觉'),
(1978, '101271613', '喜德'),
(1979, '101271614', '冕宁'),
(1980, '101271615', '越西'),
(1981, '101271616', '甘洛'),
(1982, '101271617', '雷波'),
(1983, '101271618', '美姑'),
(1984, '101271619', '布拖'),
(1985, '101271701', '雅安'),
(1986, '101271702', '名山'),
(1987, '101271703', '荥经'),
(1988, '101271704', '汉源'),
(1989, '101271705', '石棉'),
(1990, '101271706', '天全'),
(1991, '101271707', '芦山'),
(1992, '101271708', '宝兴'),
(1993, '101271801', '甘孜'),
(1994, '101271802', '康定'),
(1995, '101271803', '泸定'),
(1996, '101271804', '丹巴'),
(1997, '101271805', '九龙'),
(1998, '101271806', '雅江'),
(1999, '101271807', '道孚'),
(2000, '101271808', '炉霍'),
(2001, '101271809', '新龙'),
(2002, '101271810', '德格'),
(2003, '101271811', '白玉'),
(2004, '101271812', '石渠'),
(2005, '101271813', '色达'),
(2006, '101271814', '理塘'),
(2007, '101271815', '巴塘'),
(2008, '101271816', '乡城'),
(2009, '101271817', '稻城'),
(2010, '101271818', '得荣'),
(2011, '101271901', '阿坝'),
(2012, '101271902', '汶川'),
(2013, '101271903', '理县'),
(2014, '101271904', '茂县'),
(2015, '101271905', '松潘'),
(2016, '101271906', '九寨沟'),
(2017, '101271907', '金川'),
(2018, '101271908', '小金'),
(2019, '101271909', '黑水'),
(2020, '101271910', '马尔康'),
(2021, '101271911', '壤塘'),
(2022, '101271912', '若尔盖'),
(2023, '101271913', '红原'),
(2024, '101272001', '德阳'),
(2025, '101272002', '中江'),
(2026, '101272003', '广汉'),
(2027, '101272004', '什邡'),
(2028, '101272005', '绵竹'),
(2029, '101272006', '罗江'),
(2030, '101272101', '广元'),
(2031, '101272102', '旺苍'),
(2032, '101272103', '青川'),
(2033, '101272104', '剑阁'),
(2034, '101272105', '苍溪'),
(2035, '101280101', '广州'),
(2036, '101280102', '番禺'),
(2037, '101280103', '从化'),
(2038, '101280104', '增城'),
(2039, '101280105', '花都'),
(2040, '101280201', '韶关'),
(2041, '101280202', '乳源'),
(2042, '101280203', '始兴'),
(2043, '101280204', '翁源'),
(2044, '101280205', '乐昌'),
(2045, '101280206', '仁化'),
(2046, '101280207', '南雄'),
(2047, '101280208', '新丰'),
(2048, '101280209', '曲江'),
(2049, '101280210', '浈江'),
(2050, '101280211', '武江'),
(2051, '101280301', '惠州'),
(2052, '101280302', '博罗'),
(2053, '101280303', '惠阳'),
(2054, '101280304', '惠东'),
(2055, '101280305', '龙门'),
(2056, '101280401', '梅州'),
(2057, '101280402', '兴宁'),
(2058, '101280403', '蕉岭'),
(2059, '101280404', '大埔'),
(2060, '101280406', '丰顺'),
(2061, '101280407', '平远'),
(2062, '101280408', '五华'),
(2063, '101280409', '梅县'),
(2064, '101280501', '汕头'),
(2065, '101280502', '潮阳'),
(2066, '101280503', '澄海'),
(2067, '101280504', '南澳'),
(2068, '101280601', '深圳'),
(2069, '101280701', '珠海'),
(2070, '101280702', '斗门'),
(2071, '101280703', '金湾'),
(2072, '101280800', '佛山'),
(2073, '101280801', '顺德'),
(2074, '101280802', '三水'),
(2075, '101280803', '南海'),
(2076, '101280804', '高明'),
(2077, '101280901', '肇庆'),
(2078, '101280902', '广宁'),
(2079, '101280903', '四会'),
(2080, '101280905', '德庆'),
(2081, '101280906', '怀集'),
(2082, '101280907', '封开'),
(2083, '101280908', '高要'),
(2084, '101281001', '湛江'),
(2085, '101281002', '吴川'),
(2086, '101281003', '雷州'),
(2087, '101281004', '徐闻'),
(2088, '101281005', '廉江'),
(2089, '101281006', '赤坎'),
(2090, '101281007', '遂溪'),
(2091, '101281008', '坡头'),
(2092, '101281009', '霞山'),
(2093, '101281010', '麻章'),
(2094, '101281101', '江门'),
(2095, '101281103', '开平'),
(2096, '101281104', '新会'),
(2097, '101281105', '恩平'),
(2098, '101281106', '台山'),
(2099, '101281108', '鹤山'),
(2100, '101281109', '江海'),
(2101, '101281201', '河源'),
(2102, '101281202', '紫金'),
(2103, '101281203', '连平'),
(2104, '101281204', '和平'),
(2105, '101281205', '龙川'),
(2106, '101281206', '东源'),
(2107, '101281301', '清远'),
(2108, '101281302', '连南'),
(2109, '101281303', '连州'),
(2110, '101281304', '连山'),
(2111, '101281305', '阳山'),
(2112, '101281306', '佛冈'),
(2113, '101281307', '英德'),
(2114, '101281308', '清新'),
(2115, '101281401', '云浮'),
(2116, '101281402', '罗定'),
(2117, '101281403', '新兴'),
(2118, '101281404', '郁南'),
(2119, '101281406', '云安'),
(2120, '101281501', '潮州'),
(2121, '101281502', '饶平'),
(2122, '101281503', '潮安'),
(2123, '101281601', '东莞'),
(2124, '101281701', '中山'),
(2125, '101281801', '阳江'),
(2126, '101281802', '阳春'),
(2127, '101281803', '阳东'),
(2128, '101281804', '阳西'),
(2129, '101281901', '揭阳'),
(2130, '101281902', '揭西'),
(2131, '101281903', '普宁'),
(2132, '101281904', '惠来'),
(2133, '101281905', '揭东'),
(2134, '101282001', '茂名'),
(2135, '101282002', '高州'),
(2136, '101282003', '化州'),
(2137, '101282004', '电白'),
(2138, '101282005', '信宜'),
(2139, '101282006', '茂港'),
(2140, '101282101', '汕尾'),
(2141, '101282102', '海丰'),
(2142, '101282103', '陆丰'),
(2143, '101282104', '陆河'),
(2144, '101290101', '昆明'),
(2145, '101290103', '东川'),
(2146, '101290104', '寻甸'),
(2147, '101290105', '晋宁'),
(2148, '101290106', '宜良'),
(2149, '101290107', '石林'),
(2150, '101290108', '呈贡'),
(2151, '101290109', '富民'),
(2152, '101290110', '嵩明'),
(2153, '101290111', '禄劝'),
(2154, '101290112', '安宁'),
(2155, '101290201', '大理'),
(2156, '101290202', '云龙'),
(2157, '101290203', '漾濞'),
(2158, '101290204', '永平'),
(2159, '101290205', '宾川'),
(2160, '101290206', '弥渡'),
(2161, '101290207', '祥云'),
(2162, '101290208', '巍山'),
(2163, '101290209', '剑川'),
(2164, '101290210', '洱源'),
(2165, '101290211', '鹤庆'),
(2166, '101290212', '南涧'),
(2167, '101290301', '红河'),
(2168, '101290302', '石屏'),
(2169, '101290303', '建水'),
(2170, '101290304', '弥勒'),
(2171, '101290305', '元阳'),
(2172, '101290306', '绿春'),
(2173, '101290307', '开远'),
(2174, '101290308', '个旧'),
(2175, '101290309', '蒙自'),
(2176, '101290310', '屏边'),
(2177, '101290311', '泸西'),
(2178, '101290312', '金平'),
(2179, '101290313', '河口'),
(2180, '101290401', '曲靖'),
(2181, '101290402', '沾益'),
(2182, '101290403', '陆良'),
(2183, '101290404', '富源'),
(2184, '101290405', '马龙'),
(2185, '101290406', '师宗'),
(2186, '101290407', '罗平'),
(2187, '101290408', '会泽'),
(2188, '101290409', '宣威'),
(2189, '101290501', '保山'),
(2190, '101290503', '龙陵'),
(2191, '101290504', '施甸'),
(2192, '101290505', '昌宁'),
(2193, '101290506', '腾冲'),
(2194, '101290601', '文山'),
(2195, '101290602', '西畴'),
(2196, '101290603', '马关'),
(2197, '101290604', '麻栗坡'),
(2198, '101290605', '砚山'),
(2199, '101290606', '丘北'),
(2200, '101290607', '广南'),
(2201, '101290608', '富宁'),
(2202, '101290701', '玉溪'),
(2203, '101290702', '澄江'),
(2204, '101290703', '江川'),
(2205, '101290704', '通海'),
(2206, '101290705', '华宁'),
(2207, '101290706', '新平'),
(2208, '101290707', '易门'),
(2209, '101290708', '峨山'),
(2210, '101290709', '元江'),
(2211, '101290801', '楚雄'),
(2212, '101290802', '大姚'),
(2213, '101290803', '元谋'),
(2214, '101290804', '姚安'),
(2215, '101290805', '牟定'),
(2216, '101290806', '南华'),
(2217, '101290807', '武定'),
(2218, '101290808', '禄丰'),
(2219, '101290809', '双柏'),
(2220, '101290810', '永仁'),
(2221, '101290901', '普洱'),
(2222, '101290902', '景谷'),
(2223, '101290903', '景东'),
(2224, '101290904', '澜沧'),
(2225, '101290906', '墨江'),
(2226, '101290907', '江城'),
(2227, '101290908', '孟连'),
(2228, '101290909', '西盟'),
(2229, '101290911', '镇沅'),
(2230, '101290912', '宁洱'),
(2231, '101291001', '昭通'),
(2232, '101291002', '鲁甸'),
(2233, '101291003', '彝良'),
(2234, '101291004', '镇雄'),
(2235, '101291005', '威信'),
(2236, '101291006', '巧家'),
(2237, '101291007', '绥江'),
(2238, '101291008', '永善'),
(2239, '101291009', '盐津'),
(2240, '101291010', '大关'),
(2241, '101291011', '水富'),
(2242, '101291101', '临沧'),
(2243, '101291102', '沧源'),
(2244, '101291103', '耿马'),
(2245, '101291104', '双江'),
(2246, '101291105', '凤庆'),
(2247, '101291106', '永德'),
(2248, '101291107', '云县'),
(2249, '101291108', '镇康'),
(2250, '101291201', '怒江'),
(2251, '101291203', '福贡'),
(2252, '101291204', '兰坪'),
(2253, '101291205', '泸水'),
(2254, '101291207', '贡山'),
(2255, '101291301', '迪庆'),
(2256, '101291302', '德钦'),
(2257, '101291303', '维西'),
(2258, '101291401', '丽江'),
(2259, '101291402', '永胜'),
(2260, '101291403', '华坪'),
(2261, '101291404', '宁蒗'),
(2262, '101291501', '德宏'),
(2263, '101291503', '陇川'),
(2264, '101291504', '盈江'),
(2265, '101291506', '瑞丽'),
(2266, '101291507', '梁河'),
(2267, '101291508', '潞西'),
(2268, '101291601', '西双版纳'),
(2269, '101291603', '勐海'),
(2270, '101291605', '勐腊'),
(2271, '101300101', '南宁'),
(2272, '101300103', '邕宁'),
(2273, '101300104', '横县'),
(2274, '101300105', '隆安'),
(2275, '101300106', '马山'),
(2276, '101300107', '上林'),
(2277, '101300108', '武鸣'),
(2278, '101300109', '宾阳'),
(2279, '101300201', '崇左'),
(2280, '101300202', '天等'),
(2281, '101300203', '龙州'),
(2282, '101300204', '凭祥'),
(2283, '101300205', '大新'),
(2284, '101300206', '扶绥'),
(2285, '101300207', '宁明'),
(2286, '101300301', '柳州'),
(2287, '101300302', '柳城'),
(2288, '101300304', '鹿寨'),
(2289, '101300305', '柳江'),
(2290, '101300306', '融安'),
(2291, '101300307', '融水'),
(2292, '101300308', '三江'),
(2293, '101300401', '来宾'),
(2294, '101300402', '忻城'),
(2295, '101300403', '金秀'),
(2296, '101300404', '象州'),
(2297, '101300405', '武宣'),
(2298, '101300406', '合山'),
(2299, '101300501', '桂林'),
(2300, '101300503', '龙胜'),
(2301, '101300504', '永福'),
(2302, '101300505', '临桂'),
(2303, '101300506', '兴安'),
(2304, '101300507', '灵川'),
(2305, '101300508', '全州'),
(2306, '101300509', '灌阳'),
(2307, '101300510', '阳朔'),
(2308, '101300511', '恭城'),
(2309, '101300512', '平乐'),
(2310, '101300513', '荔浦'),
(2311, '101300514', '资源'),
(2312, '101300601', '梧州'),
(2313, '101300602', '藤县'),
(2314, '101300604', '苍梧'),
(2315, '101300605', '蒙山'),
(2316, '101300606', '岑溪'),
(2317, '101300701', '贺州'),
(2318, '101300702', '昭平'),
(2319, '101300703', '富川'),
(2320, '101300704', '钟山'),
(2321, '101300801', '贵港'),
(2322, '101300802', '桂平'),
(2323, '101300803', '平南'),
(2324, '101300901', '玉林'),
(2325, '101300902', '博白'),
(2326, '101300903', '北流'),
(2327, '101300904', '容县'),
(2328, '101300905', '陆川'),
(2329, '101300906', '兴业'),
(2330, '101301001', '百色'),
(2331, '101301002', '那坡'),
(2332, '101301003', '田阳'),
(2333, '101301004', '德保'),
(2334, '101301005', '靖西'),
(2335, '101301006', '田东'),
(2336, '101301007', '平果'),
(2337, '101301008', '隆林'),
(2338, '101301009', '西林'),
(2339, '101301010', '乐业'),
(2340, '101301011', '凌云'),
(2341, '101301012', '田林'),
(2342, '101301101', '钦州'),
(2343, '101301102', '浦北'),
(2344, '101301103', '灵山'),
(2345, '101301201', '河池'),
(2346, '101301202', '天峨'),
(2347, '101301203', '东兰'),
(2348, '101301204', '巴马'),
(2349, '101301205', '环江'),
(2350, '101301206', '罗城'),
(2351, '101301207', '宜州'),
(2352, '101301208', '凤山'),
(2353, '101301209', '南丹'),
(2354, '101301210', '都安'),
(2355, '101301211', '大化'),
(2356, '101301301', '北海'),
(2357, '101301302', '合浦'),
(2358, '101301303', '涠洲岛'),
(2359, '101301401', '防城港'),
(2360, '101301402', '上思'),
(2361, '101301403', '东兴'),
(2362, '101301405', '防城'),
(2363, '101310101', '海口'),
(2364, '101310201', '三亚'),
(2365, '101310202', '东方'),
(2366, '101310203', '临高'),
(2367, '101310204', '澄迈'),
(2368, '101310205', '儋州'),
(2369, '101310206', '昌江'),
(2370, '101310207', '白沙'),
(2371, '101310208', '琼中'),
(2372, '101310209', '定安'),
(2373, '101310210', '屯昌'),
(2374, '101310211', '琼海'),
(2375, '101310212', '文昌'),
(2376, '101310214', '保亭'),
(2377, '101310215', '万宁'),
(2378, '101310216', '陵水'),
(2379, '101310221', '乐东'),
(2380, '101310222', '五指山'),
(2381, '101320101', '香港'),
(2382, '101330101', '澳门'),
(2383, '101340101', '台北'),
(2384, '101340102', '桃园'),
(2385, '101340103', '新竹'),
(2386, '101340104', '宜兰'),
(2387, '101340201', '高雄'),
(2388, '101340202', '嘉义'),
(2389, '101340203', '台南'),
(2390, '101340204', '台东'),
(2391, '101340205', '屏东'),
(2392, '101340401', '台中'),
(2393, '101340402', '苗栗'),
(2394, '101340403', '彰化'),
(2395, '101340404', '南投'),
(2396, '101340405', '花莲'),
(2397, '101340406', '云林'),
(2398, '102010100', '首尔'),
(2399, '103010100', '东京'),
(2400, '103020100', '大阪'),
(2401, '103040100', '札幌'),
(2402, '103050100', '福冈'),
(2403, '103090100', '京都'),
(2404, '104010100', '新加坡'),
(2405, '105010100', '吉隆坡'),
(2406, '106010100', '曼谷'),
(2407, '107010100', '河内'),
(2408, '107020100', '胡志明市'),
(2409, '108010100', '仰光'),
(2410, '109010100', '万象'),
(2411, '111010100', '雅加达'),
(2412, '111080100', '登巴萨'),
(2413, '112010100', '德黑兰'),
(2414, '113010100', '新德里'),
(2415, '113030100', '孟买'),
(2416, '113090100', '斯利那加'),
(2417, '114010100', '伊斯兰堡'),
(2418, '114030100', '卡拉奇'),
(2419, '114040100', '白沙瓦'),
(2420, '115010100', '塔什干'),
(2421, '117010100', '科伦坡'),
(2422, '118010100', '喀布尔'),
(2423, '118030100', '坎大哈'),
(2424, '120010100', '斯里巴加湾'),
(2425, '121010100', '巴林'),
(2426, '124010100', '阿布扎比'),
(2427, '124020100', '迪拜'),
(2428, '127010100', '平壤'),
(2429, '130010100', '阿斯塔纳'),
(2430, '132010100', '乌兰巴托'),
(2431, '136010100', '马尼拉'),
(2432, '138010100', '利雅得'),
(2433, '139010100', '大马士革'),
(2434, '201010100', '伦敦'),
(2435, '201050100', '曼彻斯特'),
(2436, '202010100', '巴黎'),
(2437, '202100100', '马赛'),
(2438, '203010100', '柏林'),
(2439, '203020100', '法兰克福'),
(2440, '203050100', '汉堡'),
(2441, '204010100', '罗马'),
(2442, '204040100', '米兰'),
(2443, '205010100', '阿姆斯特丹'),
(2444, '206010100', '马德里'),
(2445, '206020100', '巴塞罗那'),
(2446, '207010100', '哥本哈根'),
(2447, '208010100', '莫斯科'),
(2448, '210020100', '日内瓦'),
(2449, '210030100', '苏黎世'),
(2450, '211010100', '斯德哥尔摩'),
(2451, '214010100', '里斯本'),
(2452, '215020100', '伊斯坦布尔'),
(2453, '216010100', '布鲁塞尔'),
(2454, '217010100', '维也纳'),
(2455, '218010100', '雅典'),
(2456, '222010100', '赫尔辛基'),
(2457, '301010100', '开罗'),
(2458, '302010100', '开普敦'),
(2459, '302020100', '约翰内斯堡'),
(2460, '303010100', '突尼斯'),
(2461, '304020100', '拉各斯'),
(2462, '305010100', '阿尔及尔'),
(2463, '311010100', '亚的斯亚贝巴'),
(2464, '317010100', '内罗毕'),
(2465, '321020100', '卡萨布兰卡'),
(2466, '327010100', '达喀尔'),
(2467, '332010100', '达累斯萨拉姆'),
(2468, '334010100', '卢萨卡'),
(2469, '401010100', '华盛顿'),
(2470, '401020101', '迈阿密'),
(2471, '401020104', '奥兰多'),
(2472, '401030101', '亚特兰大'),
(2473, '401040101', '洛杉矶'),
(2474, '401040102', '圣弗朗西斯科'),
(2475, '401060100', '波士顿'),
(2476, '401070101', '芝加哥'),
(2477, '401100101', '西雅图'),
(2478, '401110101', '纽约'),
(2479, '401120108', '休斯敦'),
(2480, '401370100', '拉斯维加斯'),
(2481, '401480100', '火奴鲁鲁'),
(2482, '404010100', '渥太华'),
(2483, '404030100', '温哥华'),
(2484, '404040100', '多伦多'),
(2485, '404130100', '埃德蒙顿'),
(2486, '404140100', '卡尔加里'),
(2487, '404220100', '温尼伯'),
(2488, '404230100', '魁北克'),
(2489, '404240100', '蒙特利尔'),
(2490, '406010100', '哈瓦那'),
(2491, '411010100', '墨西哥城'),
(2492, '416010100', '加拉加斯'),
(2493, '601020101', '悉尼'),
(2494, '601030101', '布里斯班'),
(2495, '601040101', '阿德来德'),
(2496, '601060101', '墨尔本'),
(2497, '601070101', '珀斯'),
(2498, '606010100', '惠灵顿'),
(2499, '606020100', '奥克兰'),
(2500, '606030100', '克莱斯特彻奇'),
(2501, '101030100', '天津');

-- --------------------------------------------------------

--
-- 表的结构 `wy_wechat_group`
--

CREATE TABLE IF NOT EXISTS `wy_wechat_group` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `wechatgroupid` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(60) NOT NULL DEFAULT '',
  `intro` varchar(200) NOT NULL DEFAULT '',
  `token` varchar(30) NOT NULL DEFAULT '',
  `fanscount` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `wechatgroupid` (`wechatgroupid`,`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_wechat_group_list`
--

CREATE TABLE IF NOT EXISTS `wy_wechat_group_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(60) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `province` varchar(20) NOT NULL DEFAULT '',
  `city` varchar(30) NOT NULL,
  `headimgurl` varchar(200) NOT NULL,
  `subscribe_time` int(11) NOT NULL,
  `token` varchar(30) NOT NULL,
  `openid` varchar(60) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `g_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_wecha_user`
--

CREATE TABLE IF NOT EXISTS `wy_wecha_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `wecha_id` varchar(60) NOT NULL,
  PRIMARY KEY (`token`,`wecha_id`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_wedding`
--

CREATE TABLE IF NOT EXISTS `wy_wedding` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `token` varchar(60) NOT NULL,
  `keyword` varchar(60) NOT NULL,
  `title` varchar(150) NOT NULL,
  `picurl` varchar(150) NOT NULL,
  `openpic` varchar(200) NOT NULL,
  `coverurl` varchar(200) NOT NULL,
  `woman` varchar(30) NOT NULL,
  `man` varchar(30) NOT NULL,
  `who_first` tinyint(1) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `time` int(11) NOT NULL,
  `place` varchar(200) NOT NULL,
  `lng` varchar(16) NOT NULL,
  `lat` varchar(16) NOT NULL,
  `video` varchar(200) NOT NULL,
  `mp3url` varchar(200) NOT NULL,
  `passowrd` int(20) NOT NULL,
  `word` varchar(200) NOT NULL,
  `qr_code` varchar(200) NOT NULL,
  `copyrite` varchar(150) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_wedding_info`
--

CREATE TABLE IF NOT EXISTS `wy_wedding_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `num` tinyint(2) NOT NULL,
  `info` varchar(200) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_wehcat_member_enddate`
--

CREATE TABLE IF NOT EXISTS `wy_wehcat_member_enddate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(60) NOT NULL,
  `enddate` int(11) NOT NULL,
  `joinUpDate` int(11) NOT NULL DEFAULT '0',
  `uid` int(11) NOT NULL DEFAULT '0',
  `token` varchar(40) NOT NULL DEFAULT '',
  `endJoinDate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_wewall`
--

CREATE TABLE IF NOT EXISTS `wy_wewall` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acttitle` varchar(40) NOT NULL COMMENT '活动标题',
  `isact` int(1) NOT NULL DEFAULT '0' COMMENT '活动开关',
  `ifcheck` int(1) NOT NULL DEFAULT '0' COMMENT '是否审核',
  `iflottery` int(1) NOT NULL DEFAULT '1',
  `showtime` int(11) NOT NULL COMMENT '前台页面刷新间隔',
  `background` varchar(300) DEFAULT NULL COMMENT '前台页面背景',
  `marklog` varchar(100) DEFAULT NULL COMMENT '成绩记录',
  `createtime` int(20) NOT NULL COMMENT '创建时间',
  `endtime` int(20) DEFAULT NULL COMMENT '结束时间',
  `token` varchar(40) NOT NULL,
  `bonu1` int(11) DEFAULT NULL COMMENT '一等奖数量',
  `bonu2` int(11) DEFAULT NULL COMMENT '二等奖数量',
  `bonu3` int(11) DEFAULT NULL COMMENT '三等奖数量',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_wewalllog`
--

CREATE TABLE IF NOT EXISTS `wy_wewalllog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(30) NOT NULL,
  `content` varchar(200) NOT NULL,
  `updatetime` varchar(13) NOT NULL,
  `token` varchar(30) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `sncode` varchar(20) DEFAULT NULL,
  `ifcheck` int(1) DEFAULT '0',
  `ifsent` int(1) DEFAULT '0',
  `ifscheck` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_wifipassword`
--

CREATE TABLE IF NOT EXISTS `wy_wifipassword` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `acc_bw` varchar(20) NOT NULL,
  `psw_bw` varchar(20) NOT NULL,
  `acc_wt` varchar(20) NOT NULL,
  `psw_wt` varchar(20) NOT NULL,
  `acc_ro` varchar(20) NOT NULL,
  `psw_ro` varchar(20) NOT NULL,
  `keyword` varchar(60) NOT NULL,
  `url` varchar(200) NOT NULL,
  `info` varchar(200) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'witown',
  `appid` varchar(20) DEFAULT NULL,
  `appkey` varchar(32) DEFAULT NULL,
  `nodeid` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_wifi_ads`
--

CREATE TABLE IF NOT EXISTS `wy_wifi_ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wifi_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `links` text,
  `pic` text NOT NULL,
  `hit` int(11) DEFAULT NULL,
  `type` int(2) NOT NULL,
  `info` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_wifi_count`
--

CREATE TABLE IF NOT EXISTS `wy_wifi_count` (
  `ads_id` int(11) NOT NULL,
  `user` varchar(255) DEFAULT NULL,
  `hittime` varchar(13) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wy_wifi_keyword`
--

CREATE TABLE IF NOT EXISTS `wy_wifi_keyword` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(200) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `shop_name` varchar(255) DEFAULT NULL,
  `wx_pic` varchar(255) DEFAULT NULL,
  `ewm` varchar(255) DEFAULT NULL,
  `shoplogo` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `node` varchar(255) DEFAULT NULL,
  `token` varchar(50) NOT NULL,
  `wx_id` varchar(50) NOT NULL,
  `wx` varchar(255) DEFAULT NULL,
  `otherinfo` varchar(255) DEFAULT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `about` text,
  `settime` int(11) DEFAULT NULL,
  `suc_id` int(11) DEFAULT NULL,
  `suc_url` text,
  `rz_id` int(11) DEFAULT NULL,
  `rz_url` text,
  `rz_bg` text,
  `suc_bg` text,
  `isdefault` int(11) DEFAULT NULL,
  `tmpl` varchar(255) DEFAULT '0',
  `suc_tmpl` text,
  `rztype` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_wifi_tmpl`
--

CREATE TABLE IF NOT EXISTS `wy_wifi_tmpl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `tpl` text,
  `status` int(1) DEFAULT '0',
  `info` varchar(255) DEFAULT NULL,
  `headpic` int(1) NOT NULL DEFAULT '1',
  `bgpic` int(1) NOT NULL DEFAULT '1',
  `spfont` int(1) NOT NULL DEFAULT '1',
  `menulink` int(1) NOT NULL DEFAULT '1',
  `ads` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_wifi_user`
--

CREATE TABLE IF NOT EXISTS `wy_wifi_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `phone` text,
  `use_time` varchar(11) DEFAULT NULL,
  `rptk_user_mac` varchar(255) DEFAULT NULL,
  `rptk_key` varchar(255) DEFAULT NULL,
  `rptk_user_ip` varchar(255) DEFAULT NULL,
  `exit_time` varchar(11) DEFAULT NULL,
  `wid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_wxq`
--

CREATE TABLE IF NOT EXISTS `wy_wxq` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '活动名称',
  `keyword` varchar(255) NOT NULL COMMENT '关键字',
  `enter_tips` varchar(300) NOT NULL DEFAULT '' COMMENT '进入提示',
  `quit_tips` varchar(300) NOT NULL DEFAULT '' COMMENT '退出提示',
  `send_tips` varchar(300) NOT NULL DEFAULT '' COMMENT '发表提示',
  `quit_command` varchar(10) NOT NULL DEFAULT '' COMMENT '退出指令',
  `description` text NOT NULL COMMENT '描述',
  `timeout` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '超时时间',
  `isshow` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否需要审核',
  `createtime` varchar(13) NOT NULL,
  `updatetime` varchar(13) NOT NULL,
  `qrcode` char(100) NOT NULL COMMENT '二维码',
  `background` char(100) NOT NULL COMMENT '墻背景',
  `showtime` int(11) NOT NULL COMMENT '每张墻轮换时间',
  `logourl` char(100) NOT NULL COMMENT 'logo',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_wxuser`
--

CREATE TABLE IF NOT EXISTS `wy_wxuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `wxname` varchar(60) NOT NULL COMMENT '公众号名称',
  `wxid` varchar(20) NOT NULL COMMENT '公众号原始ID',
  `weixin` char(20) NOT NULL COMMENT '微信号',
  `headerpic` char(255) NOT NULL COMMENT '头像地址',
  `token` char(255) NOT NULL,
  `province` varchar(30) NOT NULL COMMENT '省',
  `color_id` mediumint(4) NOT NULL DEFAULT '0',
  `city` varchar(60) NOT NULL COMMENT '市',
  `qq` char(25) NOT NULL COMMENT '公众号邮箱',
  `wxfans` int(11) NOT NULL COMMENT '微信粉丝',
  `typeid` int(11) NOT NULL COMMENT '分类ID',
  `winxintype` int(1) NOT NULL COMMENT '微信号种类',
  `typename` varchar(90) NOT NULL DEFAULT '0' COMMENT '分类名',
  `tongji` text NOT NULL,
  `allcardnum` int(11) NOT NULL,
  `cardisok` int(11) NOT NULL,
  `yetcardnum` int(11) NOT NULL,
  `totalcardnum` int(11) NOT NULL,
  `createtime` varchar(13) NOT NULL,
  `tpltypeid` varchar(10) NOT NULL DEFAULT '1' COMMENT '默认首页模版ID',
  `updatetime` varchar(13) NOT NULL,
  `tpltypename` varchar(20) NOT NULL COMMENT '首页模版名',
  `tpllistid` varchar(10) NOT NULL DEFAULT '1' COMMENT '默认首页模版ID',
  `tpllistname` varchar(20) NOT NULL COMMENT '列表模版名',
  `tplcontentid` varchar(2) NOT NULL COMMENT '内容模版ID',
  `tplcontentname` varchar(20) NOT NULL COMMENT '内容模版名',
  `phone` text NOT NULL,
  `smsstatus` text NOT NULL,
  `smsuser` text NOT NULL,
  `smspassword` text NOT NULL,
  `smsid` int(10) NOT NULL,
  `subfix` text NOT NULL,
  `email` text NOT NULL,
  `emailstatus` text NOT NULL,
  `emailuser` text NOT NULL,
  `emailpassword` text NOT NULL,
  `appid` varchar(50) NOT NULL,
  `appsecret` varchar(50) NOT NULL,
  `wxun` varchar(64) DEFAULT NULL,
  `wxpwd` varchar(32) NOT NULL,
  `binok` tinyint(1) NOT NULL,
  `shoptpltypeid` varchar(30) DEFAULT NULL,
  `shoptpltypename` varchar(30) DEFAULT NULL,
  `agentid` int(10) NOT NULL DEFAULT '0',
  `openphotoprint` tinyint(1) DEFAULT NULL,
  `freephotocount` mediumint(4) DEFAULT NULL,
  `transfer_customer_service` tinyint(1) NOT NULL DEFAULT '0',
  `printstatus` int(1) NOT NULL DEFAULT '0',
  `member_code` varchar(50) NOT NULL DEFAULT '0',
  `feiyin_key` varchar(50) NOT NULL DEFAULT '0',
  `device_no` varchar(30) NOT NULL DEFAULT '0',
  `oauth` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `uid_2` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_wxuser_message`
--

CREATE TABLE IF NOT EXISTS `wy_wxuser_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ToUserName` varchar(255) NOT NULL,
  `FromUserName` varchar(255) NOT NULL,
  `CreateTime` int(11) NOT NULL,
  `MsgType` varchar(255) NOT NULL,
  `Content` varchar(255) NOT NULL,
  `MsgId` varchar(255) NOT NULL,
  `PicUrl` varchar(255) NOT NULL,
  `MediaId` varchar(255) NOT NULL,
  `Format` varchar(255) NOT NULL,
  `ThumbMediaId` varchar(255) NOT NULL,
  `Location_X` varchar(255) NOT NULL,
  `Location_Y` varchar(255) NOT NULL,
  `Scale` varchar(255) NOT NULL,
  `Label` varchar(255) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Url` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `backcontent` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=390 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_wxwall_award`
--

CREATE TABLE IF NOT EXISTS `wy_wxwall_award` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wxq_id` int(10) unsigned NOT NULL,
  `from_user` varchar(50) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_wxwall_members`
--

CREATE TABLE IF NOT EXISTS `wy_wxwall_members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_user` varchar(50) NOT NULL COMMENT '用户的唯一身份ID',
  `nickname` varchar(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `avatar` varchar(100) NOT NULL DEFAULT '' COMMENT '头像',
  `wxq_id` int(10) unsigned NOT NULL COMMENT '用户当前所在的微信墙话题',
  `isjoin` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否正在加入话题',
  `isblacklist` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户是否是黑名单',
  `lastupdate` int(10) unsigned NOT NULL COMMENT '用户最后发表时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_wxwall_message`
--

CREATE TABLE IF NOT EXISTS `wy_wxwall_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wxq_id` int(10) unsigned NOT NULL COMMENT '规则ID',
  `from_user` varchar(50) NOT NULL COMMENT '用户的唯一ID',
  `content` varchar(1000) NOT NULL DEFAULT '' COMMENT '用户发表的内容',
  `type` varchar(10) NOT NULL COMMENT '发表内容类型',
  `isshow` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否显示',
  `createtime` int(10) unsigned NOT NULL,
  `isshowed` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示过了 1 是 0否',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_xitie`
--

CREATE TABLE IF NOT EXISTS `wy_xitie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(60) NOT NULL,
  `title` varchar(60) NOT NULL,
  `keyword` varchar(60) NOT NULL,
  `replypicurl` varchar(120) NOT NULL,
  `taxis` int(10) NOT NULL,
  `name_xl` varchar(20) NOT NULL,
  `name_xn` varchar(20) NOT NULL,
  `video` varchar(120) NOT NULL,
  `hua` varchar(200) NOT NULL,
  `time` varchar(60) NOT NULL,
  `address` varchar(120) NOT NULL,
  `tel` char(20) NOT NULL,
  `pic` varchar(120) NOT NULL,
  `pic1` varchar(120) NOT NULL,
  `pic2` varchar(120) NOT NULL,
  `copyright` varchar(60) NOT NULL,
  `bg_mp3` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_xitiebbs`
--

CREATE TABLE IF NOT EXISTS `wy_xitiebbs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `token` varchar(60) NOT NULL,
  `userName` varchar(60) NOT NULL,
  `telephone` char(20) NOT NULL,
  `content` varchar(200) NOT NULL,
  `count` int(5) NOT NULL,
  `type` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_xitienew`
--

CREATE TABLE IF NOT EXISTS `wy_xitienew` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(40) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `hqgs` varchar(100) DEFAULT '婚庆公司',
  `title` varchar(200) DEFAULT NULL,
  `pic` varchar(100) DEFAULT NULL,
  `opening_animation` varchar(100) DEFAULT NULL,
  `small_pic` varchar(100) DEFAULT NULL,
  `man_name` varchar(20) DEFAULT NULL,
  `girl_name` varchar(20) DEFAULT NULL,
  `time` varchar(30) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `video` varchar(100) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `background_music` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `site_map_2` varchar(100) DEFAULT NULL,
  `site_map_3` varchar(100) DEFAULT NULL,
  `site_map_4` varchar(100) DEFAULT NULL,
  `site_map_5` varchar(100) DEFAULT NULL,
  `site_map_1` varchar(100) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_yuyue`
--

CREATE TABLE IF NOT EXISTS `wy_yuyue` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `topic` varchar(200) DEFAULT NULL,
  `info` varchar(500) DEFAULT NULL,
  `statdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `copyright` varchar(30) DEFAULT NULL,
  `yuyue_type` tinyint(1) DEFAULT NULL,
  `tel` varchar(20) NOT NULL,
  `phone_status` int(1) NOT NULL,
  `email` varchar(20) NOT NULL,
  `email_status` int(1) NOT NULL,
  `printtype` varchar(10) NOT NULL,
  `printpage` int(2) NOT NULL,
  `deviceNo` varchar(20) NOT NULL,
  `deviceNo1` varchar(20) NOT NULL,
  `deviceNo2` varchar(20) NOT NULL,
  `bwdeviceNo` varchar(20) NOT NULL,
  `bwdeviceNo1` varchar(20) NOT NULL,
  `bwdeviceNo2` varchar(20) NOT NULL,
  `memberCode` varchar(32) NOT NULL,
  `feiyin_key` varchar(32) NOT NULL,
  `pringNum` int(1) NOT NULL,
  `print_status` int(1) NOT NULL,
  `payonline` tinyint(1) DEFAULT '0',
  `tel_status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_yuyue_order`
--

CREATE TABLE IF NOT EXISTS `wy_yuyue_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `token` varchar(40) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `memo` varchar(200) DEFAULT NULL,
  `type` smallint(4) NOT NULL DEFAULT '0',
  `wecha_id` varchar(200) NOT NULL,
  `or_date` date DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `nums` varchar(20) DEFAULT NULL,
  `fieldsigle` varchar(100) DEFAULT NULL,
  `fielddownload` varchar(100) DEFAULT NULL,
  `price` varchar(10) DEFAULT NULL,
  `kind` varchar(20) DEFAULT NULL,
  `memberCode` varchar(32) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `printtype` varchar(10) NOT NULL,
  `printpage` int(2) NOT NULL,
  `or_date1` date DEFAULT NULL,
  `time1` varchar(50) DEFAULT NULL,
  `paymode` tinyint(1) DEFAULT '0',
  `orderid` varchar(40) NOT NULL,
  `paid` tinyint(1) DEFAULT '0',
  `paytype` varchar(10) NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
  `printed` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `token` (`token`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_yuyue_setcin`
--

CREATE TABLE IF NOT EXISTS `wy_yuyue_setcin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `yuanjia` varchar(10) DEFAULT NULL,
  `youhui` varchar(10) DEFAULT NULL,
  `memo` varchar(100) DEFAULT NULL,
  `messages` text,
  `type` varchar(20) DEFAULT NULL,
  `pic1` varchar(100) DEFAULT NULL,
  `pic2` varchar(100) DEFAULT NULL,
  `pic3` varchar(100) DEFAULT NULL,
  `pic4` varchar(100) DEFAULT NULL,
  `pic5` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_zhaopin`
--

CREATE TABLE IF NOT EXISTS `wy_zhaopin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `gangwei` varchar(200) DEFAULT NULL,
  `xinzi` varchar(200) DEFAULT NULL,
  `yaoqiu` varchar(5000) DEFAULT NULL,
  `ren` varchar(255) NOT NULL,
  `zhize` varchar(5000) NOT NULL,
  `jigou` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `people` varchar(255) NOT NULL,
  `tell` char(11) NOT NULL,
  `longitude` char(11) NOT NULL DEFAULT '',
  `latitude` char(11) NOT NULL DEFAULT '',
  `leibie` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `click` int(11) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `wecha_id` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_zhaopin_jianli`
--

CREATE TABLE IF NOT EXISTS `wy_zhaopin_jianli` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `job` varchar(200) DEFAULT NULL,
  `salary` varchar(200) DEFAULT NULL,
  `introduce` varchar(5000) DEFAULT NULL,
  `education` varchar(255) NOT NULL,
  `workarea` varchar(255) NOT NULL,
  `phone` char(11) NOT NULL,
  `leibie` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `click` int(11) NOT NULL,
  `year` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `validTime` int(100) NOT NULL,
  `age` char(3) NOT NULL DEFAULT '',
  `wecha_id` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_zhaopin_reply`
--

CREATE TABLE IF NOT EXISTS `wy_zhaopin_reply` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `info` varchar(500) DEFAULT NULL COMMENT '公司简介',
  `title` text NOT NULL,
  `tp` char(255) NOT NULL,
  `copyright` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_zhida`
--

CREATE TABLE IF NOT EXISTS `wy_zhida` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(1000) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `token` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_zhufu`
--

CREATE TABLE IF NOT EXISTS `wy_zhufu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `xid` int(11) NOT NULL,
  `wecha_id` varchar(60) NOT NULL,
  `token` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `phone` varchar(30) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_zhu_menu`
--

CREATE TABLE IF NOT EXISTS `wy_zhu_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `order` int(5) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `picurl` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `display` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wy_zi_menu`
--

CREATE TABLE IF NOT EXISTS `wy_zi_menu` (
  `zid` int(11) NOT NULL AUTO_INCREMENT,
  `zhu_id` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `zorder` int(5) DEFAULT NULL,
  `zname` varchar(50) DEFAULT NULL,
  `zpicurl` varchar(100) DEFAULT NULL,
  `zurl` varchar(100) DEFAULT NULL,
  `zdisplay` int(1) DEFAULT NULL,
  PRIMARY KEY (`zid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
