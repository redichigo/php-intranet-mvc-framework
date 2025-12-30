/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : intranet

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-12-26 19:40:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `accesos`
-- ----------------------------
DROP TABLE IF EXISTS `accesos`;
CREATE TABLE `accesos` (
  `IDENTIFICADOR` varchar(60) NOT NULL,
  `PASS` varchar(128) DEFAULT NULL,
  `ESTADO` varchar(15) DEFAULT '',
  `CREADOR` varchar(60) DEFAULT '',
  `FECHA_CREACION` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`IDENTIFICADOR`),
  KEY `IDENTIFICADOR` (`IDENTIFICADOR`,`PASS`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of accesos (pass testeo 123456)
-- ----------------------------
INSERT INTO `accesos` VALUES ('admin1', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'ACTIVO', 'admin1', '2024-12-26 19:32:50');
INSERT INTO `accesos` VALUES ('admin2', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'ACTIVO', 'admin1', '2024-12-26 19:33:05');

-- ----------------------------
-- Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ROL` varchar(50) DEFAULT NULL,
  `IDENTIFICADOR` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`,`ROL`,`IDENTIFICADOR`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'admin', 'admin1');
INSERT INTO `roles` VALUES ('2', 'admin', 'admin2');
