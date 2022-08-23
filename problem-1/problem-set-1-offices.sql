/*
 Navicat Premium Data Transfer

 Source Server         : GODHOOD
 Source Server Type    : MySQL
 Source Server Version : 100424
 Source Host           : localhost:3306
 Source Schema         : problem-set-1-offices

 Target Server Type    : MySQL
 Target Server Version : 100424
 File Encoding         : 65001

 Date: 23/08/2022 12:40:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for office
-- ----------------------------
DROP TABLE IF EXISTS `office`;
CREATE TABLE `office`  (
  `office-id` int NOT NULL AUTO_INCREMENT,
  `documentery` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `section-id` int NOT NULL,
  `whattodo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`office-id`) USING BTREE,
  INDEX `wherebelongsto-id`(`section-id`) USING BTREE,
  CONSTRAINT `office_ibfk_1` FOREIGN KEY (`section-id`) REFERENCES `section` (`section-id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for section
-- ----------------------------
DROP TABLE IF EXISTS `section`;
CREATE TABLE `section`  (
  `section-id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `age` int NULL DEFAULT NULL,
  PRIMARY KEY (`section-id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for workers
-- ----------------------------
DROP TABLE IF EXISTS `workers`;
CREATE TABLE `workers`  (
  `person-id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `office-id` int NOT NULL,
  `salary` decimal(10, 2) NOT NULL,
  PRIMARY KEY (`person-id`) USING BTREE,
  INDEX `workers_ibfk_1`(`office-id`) USING BTREE,
  CONSTRAINT `workers_ibfk_1` FOREIGN KEY (`office-id`) REFERENCES `office` (`office-id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 147 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
