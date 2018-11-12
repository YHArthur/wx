/*
Navicat MySQL Data Transfer

Source Server         : wx.fnying.com
Source Server Version : 50633
Source Host           : localhost:3306
Source Database       : wx

Target Server Type    : MYSQL
Target Server Version : 50633
File Encoding         : 65001

Date: 2018-11-12 11:10:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for wx_count_share
-- ----------------------------
DROP TABLE IF EXISTS `wx_count_share`;
CREATE TABLE `wx_count_share` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分享日志ID',
  `open_id` varchar(50) CHARACTER SET ascii DEFAULT NULL COMMENT '分享用户OPENID',
  `from_id` int(36) DEFAULT NULL COMMENT '来源分享ID',
  `share_url` varchar(255) CHARACTER SET ascii DEFAULT NULL COMMENT '分享URL',
  `share_time` int(11) DEFAULT NULL COMMENT '分享时间',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='网站页面统计';
