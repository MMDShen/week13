/*
 Navicat Premium Data Transfer

 Source Server         : GODHOOD
 Source Server Type    : MySQL
 Source Server Version : 100424
 Source Host           : localhost:3306
 Source Schema         : chatroom

 Target Server Type    : MySQL
 Target Server Version : 100424
 File Encoding         : 65001

 Date: 25/08/2022 00:10:00
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for chats
-- ----------------------------
DROP TABLE IF EXISTS `chats`;
CREATE TABLE `chats`  (
  `orders` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `comment` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`orders`) USING BTREE,
  INDEX `userid`(`userid`) USING BTREE,
  CONSTRAINT `chats_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of chats
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `userid` int NOT NULL AUTO_INCREMENT,
  `username` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `blocked` tinyint(1) NOT NULL,
  PRIMARY KEY (`userid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', 'admin@google.com', 'admin', 'admin', 0);
INSERT INTO `users` VALUES (9, 'adminweew', 'wewr@gmail.com', '1234', 'adere', 0);

SET FOREIGN_KEY_CHECKS = 1;
