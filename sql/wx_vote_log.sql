/*
Navicat MySQL Data Transfer

Source Server         : wx.fnying.com
Source Server Version : 50633
Source Host           : localhost:3306
Source Database       : wx

Target Server Type    : MYSQL
Target Server Version : 50633
File Encoding         : 65001

Date: 2018-11-12 11:10:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for wx_vote_log
-- ----------------------------
DROP TABLE IF EXISTS `wx_vote_log`;
CREATE TABLE `wx_vote_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '投票日志ID',
  `option_id` int(11) NOT NULL DEFAULT '0' COMMENT '选项ID',
  `vote_id` int(11) NOT NULL DEFAULT '0' COMMENT '投票ID',
  `is_void` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否无效',
  `voter_name` varchar(50) DEFAULT NULL COMMENT '投票人名称',
  `voter_unionid` varchar(50) CHARACTER SET ascii NOT NULL COMMENT '投票人微信统一标识',
  `voter_avate` varchar(255) CHARACTER SET ascii DEFAULT '' COMMENT '投票人微信头像',
  `ctime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微信投票记录表';
