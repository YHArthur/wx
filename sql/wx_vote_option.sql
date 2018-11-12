/*
Navicat MySQL Data Transfer

Source Server         : wx.fnying.com
Source Server Version : 50633
Source Host           : localhost:3306
Source Database       : wx

Target Server Type    : MYSQL
Target Server Version : 50633
File Encoding         : 65001

Date: 2018-11-12 11:11:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for wx_vote_option
-- ----------------------------
DROP TABLE IF EXISTS `wx_vote_option`;
CREATE TABLE `wx_vote_option` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '选项ID',
  `vote_id` int(11) NOT NULL DEFAULT '0' COMMENT '投票ID',
  `option_title` varchar(255) NOT NULL COMMENT '投票选项内容',
  `option_sort` tinyint(1) NOT NULL COMMENT '选项顺序',
  `ctime` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微信投票选项表';
