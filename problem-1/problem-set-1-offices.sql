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

--------------------------------------
-- inserts
--------------------------------------
INSERT INTO `office` (`office-id`, `documentery`, `section-id`, `whattodo`) VALUES (1, 'esfehan1', 1, 'eating');
INSERT INTO `office` (`office-id`, `documentery`, `section-id`, `whattodo`) VALUES (2, 'esfehan2', 1, 'sleeping');
INSERT INTO `office` (`office-id`, `documentery`, `section-id`, `whattodo`) VALUES (3, 'esfehan3', 1, 'speaking');
INSERT INTO `office` (`office-id`, `documentery`, `section-id`, `whattodo`) VALUES (4, 'esfehan4', 1, 'exercising');
INSERT INTO `office` (`office-id`, `documentery`, `section-id`, `whattodo`) VALUES (5, 'rey1', 2, 'watching');
INSERT INTO `office` (`office-id`, `documentery`, `section-id`, `whattodo`) VALUES (7, 'rey2', 2, 'laughing');
INSERT INTO `office` (`office-id`, `documentery`, `section-id`, `whattodo`) VALUES (8, 'rey3', 2, 'smiling');
INSERT INTO `office` (`office-id`, `documentery`, `section-id`, `whattodo`) VALUES (9, 'mashhad1', 3, 'encouraging');
INSERT INTO `office` (`office-id`, `documentery`, `section-id`, `whattodo`) VALUES (10, 'gonbad-e-kavus1', 4, 'fooling');
INSERT INTO `office` (`office-id`, `documentery`, `section-id`, `whattodo`) VALUES (11, 'mashhad2', 3, 'rubbing');
INSERT INTO `office` (`office-id`, `documentery`, `section-id`, `whattodo`) VALUES (12, 'mashhad3', 3, 'rocking');
INSERT INTO `office` (`office-id`, `documentery`, `section-id`, `whattodo`) VALUES (13, 'rey4', 2, 'burning');
INSERT INTO `office` (`office-id`, `documentery`, `section-id`, `whattodo`) VALUES (14, 'gonbad-e-kavus2', 4, 'buring');
INSERT INTO `office` (`office-id`, `documentery`, `section-id`, `whattodo`) VALUES (15, 'rey5', 2, 'triping');
INSERT INTO `office` (`office-id`, `documentery`, `section-id`, `whattodo`) VALUES (16, 'esfehan5', 1, NULL);
INSERT INTO `section` (`section-id`, `name`, `city`, `age`) VALUES (0, 'zebra', 'goldenBridge', 3000);
INSERT INTO `section` (`section-id`, `name`, `city`, `age`) VALUES (1, 'alpha', 'esfehan', 1990);
INSERT INTO `section` (`section-id`, `name`, `city`, `age`) VALUES (2, 'bravo', 'rey', 1980);
INSERT INTO `section` (`section-id`, `name`, `city`, `age`) VALUES (3, 'charlie', 'mashhad', 1780);
INSERT INTO `section` (`section-id`, `name`, `city`, `age`) VALUES (4, 'delta', 'gonbad-e-kavus', 1955);
INSERT INTO `workers` (`person-id`, `name`, `office-id`, `salary`) VALUES (1, 'ali', 1, 1000000.00);
INSERT INTO `workers` (`person-id`, `name`, `office-id`, `salary`) VALUES (2, 'ali', 2, 70000.00);
INSERT INTO `workers` (`person-id`, `name`, `office-id`, `salary`) VALUES (3, 'reza', 1, 786544.00);
INSERT INTO `workers` (`person-id`, `name`, `office-id`, `salary`) VALUES (4, 'john', 2, 70000.00);
INSERT INTO `workers` (`person-id`, `name`, `office-id`, `salary`) VALUES (5, 'meysam', 1, 665544.00);
INSERT INTO `workers` (`person-id`, `name`, `office-id`, `salary`) VALUES (6, 'moghtada', 2, 789000.00);
INSERT INTO `workers` (`person-id`, `name`, `office-id`, `salary`) VALUES (7, 'alireza', 1, 665544.00);
INSERT INTO `workers` (`person-id`, `name`, `office-id`, `salary`) VALUES (8, 'Clarke Alford', 3, 7251095.00);
INSERT INTO `workers` (`person-id`, `name`, `office-id`, `salary`) VALUES (9, 'Luke Sheppard', 4, 4823129.00);
INSERT INTO `workers` (`person-id`, `name`, `office-id`, `salary`) VALUES (10, 'Alford', 3, 23095.00);
INSERT INTO `workers` (`person-id`, `name`, `office-id`, `salary`) VALUES (11, 'Sheppard', 3, 5623129.00);
INSERT INTO `workers` (`person-id`, `name`, `office-id`, `salary`) VALUES (12, 'Clarke Alf', 3, 6251095.00);
INSERT INTO `workers` (`person-id`, `name`, `office-id`, `salary`) VALUES (13, 'Luke', 9, 8823129.00);
INSERT INTO `workers` (`person-id`, `name`, `office-id`, `salary`) VALUES (14, 'Rajah Stone', 4, 2035653.00);
INSERT INTO `workers` (`person-id`, `name`, `office-id`, `salary`) VALUES (15, 'Judah Compton', 2, 9080979.00);
INSERT INTO `workers` (`person-id`, `name`, `office-id`, `salary`) VALUES (16, 'Clarke Alf', 5, 6245095.00);
INSERT INTO `workers` (`person-id`, `name`, `office-id`, `salary`) VALUES (17, 'Luke', 5, 8123129.00);
INSERT INTO `workers` (`person-id`, `name`, `office-id`, `salary`) VALUES (18, 'Rajah Stone', 5, 20343.00);
INSERT INTO `workers` (`person-id`, `name`, `office-id`, `salary`) VALUES (19, 'Irene Kramer', 1, 5567101.00);
INSERT INTO `workers` (`person-id`, `name`, `office-id`, `salary`) VALUES (20, 'Karyn Macdonald', 2, 6859347.00);
INSERT INTO `workers` (`person-id`, `name`, `office-id`, `salary`) VALUES (21, 'Wyatt Castro', 7, 7800429.00);
INSERT INTO `workers` (`person-id`, `name`, `office-id`, `salary`) VALUES (22, 'Lillian Blevins', 2, 5208145.00);
INSERT INTO `workers` (`person-id`, `name`, `office-id`, `salary`) VALUES (23, 'Cyrus Dejesus', 4, 6063357.00);
INSERT INTO `workers` (`person-id`, `name`, `office-id`, `salary`) VALUES (24, 'dun-paye', 4, 100.00);

