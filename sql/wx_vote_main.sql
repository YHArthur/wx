/*
Navicat MySQL Data Transfer

Source Server         : wx.fnying.com
Source Server Version : 50633
Source Host           : localhost:3306
Source Database       : wx

Target Server Type    : MYSQL
Target Server Version : 50633
File Encoding         : 65001

Date: 2018-11-12 11:11:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for wx_vote_main
-- ----------------------------
DROP TABLE IF EXISTS `wx_vote_main`;
CREATE TABLE `wx_vote_main` (
  `vote_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '投票ID',
  `vote_title` varchar(255) NOT NULL COMMENT '投票标题',
  `owner_name` varchar(50) DEFAULT NULL COMMENT '创建人名称',
  `vote_info` text COMMENT '投票描述',
  `limit_time` int(11) NOT NULL DEFAULT '0' COMMENT '截止时间',
  `is_multi` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否多选',
  `is_anonymous` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否匿名',
  `owner_unionid` varchar(50) CHARACTER SET ascii NOT NULL COMMENT '创建人微信统一标识',
  `owner_avate` varchar(255) CHARACTER SET ascii DEFAULT '' COMMENT '创建人微信头像',
  `ctime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`vote_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微信投票主表';
