/*
 Navicat Premium Data Transfer

 Source Server         : mysql.local
 Source Server Type    : MySQL
 Source Server Version : 80012
 Source Host           : localhost:3306
 Source Schema         : test

 Target Server Type    : MySQL
 Target Server Version : 80012
 File Encoding         : 65001

 Date: 24/03/2019 11:39:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `order_sn` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `total_price` decimal(10, 2) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `operated_at` datetime(0) NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT NULL,
  `is_delete` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
