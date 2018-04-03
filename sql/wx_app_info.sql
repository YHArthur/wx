/*
Navicat MySQL Data Transfer

Source Server         : wx.fnying.com
Source Server Version : 50637
Source Host           : localhost:3306
Source Database       : wx

Target Server Type    : MYSQL
Target Server Version : 50637
File Encoding         : 65001

Date: 2018-03-30 09:38:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for wx_app_info
-- ----------------------------
DROP TABLE IF EXISTS `wx_app_info`;
CREATE TABLE `wx_app_info` (
  `wxid` int(50) unsigned NOT NULL AUTO_INCREMENT COMMENT '微信ID',
  `appid` char(18) CHARACTER SET ascii NOT NULL COMMENT 'APPID',
  `appname` varchar(50) NOT NULL DEFAULT '' COMMENT 'APP名称',
  `secret` char(32) CHARACTER SET ascii NOT NULL DEFAULT '' COMMENT '凭证密钥',
  `token` varchar(512) CHARACTER SET ascii NOT NULL DEFAULT '' COMMENT 'AccessToken',
  `token_expire_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Token过期时间',
  `ticket` varchar(255) CHARACTER SET ascii NOT NULL DEFAULT '' COMMENT 'JsapiTicket',
  `ticket_expire_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Ticket过期时间',
  PRIMARY KEY (`wxid`),
  UNIQUE KEY `appid` (`appid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='微信APP信息表';
