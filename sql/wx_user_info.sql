/*
Navicat MySQL Data Transfer

Source Server         : wx.fnying.com
Source Server Version : 50633
Source Host           : localhost:3306
Source Database       : wx

Target Server Type    : MYSQL
Target Server Version : 50633
File Encoding         : 65001

Date: 2018-11-12 11:10:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for wx_user_info
-- ----------------------------
DROP TABLE IF EXISTS `wx_user_info`;
CREATE TABLE `wx_user_info` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `wxid` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '微信ID',
  `openid` varchar(50) CHARACTER SET ascii NOT NULL COMMENT '微信唯一标识',
  `nickname` varchar(100) CHARACTER SET utf8mb4 DEFAULT '' COMMENT '用户昵称',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户性别',
  `language` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT '' COMMENT '国家',
  `province` varchar(50) DEFAULT '' COMMENT '省份',
  `city` varchar(50) DEFAULT '' COMMENT '城市',
  `headimgurl` varchar(255) CHARACTER SET ascii DEFAULT '' COMMENT '用户头像',
  `privilege` varchar(255) CHARACTER SET ascii DEFAULT '' COMMENT '用户特权',
  `unionid` varchar(50) CHARACTER SET ascii DEFAULT '' COMMENT '微信统一标识',
  `subscribe_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '关注时间戳',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `groupid` int(11) DEFAULT '0' COMMENT '分组ID',
  `utime` int(11) DEFAULT '0' COMMENT '更新时间',
  `ctime` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `openid` (`openid`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='微信用户信息表';
