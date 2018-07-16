/*
Navicat MySQL Data Transfer

Source Server         : www.fnying.com
Source Server Version : 50173
Source Host           : bdm25986977.my3w.com:3306
Source Database       : bdm25986977_db

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2018-06-15 14:59:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for wx_user_vote_main
-- ----------------------------
DROP TABLE IF EXISTS `wx_user_vote_main`;
CREATE TABLE `wx_user_vote_main` (
  `vote_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '投票ID',
  `vote_title` varchar(255) NOT NULL COMMENT '投票标题',
  `owner_name` varchar(50) NOT NULL COMMENT '创建人名称',
  `vote_info` text COMMENT '投票描述',
  `limit_time` int(11) DEFAULT NULL COMMENT '投票截止时间',
  `is_multi` tinyint(1) DEFAULT '0' COMMENT '是否多选',
  `is_anonymous` tinyint(1) DEFAULT NULL COMMENT '是否匿名',
  `owner_unionid` varchar(50) CHARACTER SET ascii NOT NULL COMMENT '微信统一标识',
  `ctime` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`vote_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微信用户投票主表';
