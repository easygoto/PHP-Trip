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

 Date: 24/03/2019 11:40:01
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for order_goods
-- ----------------------------
DROP TABLE IF EXISTS `order_goods`;
CREATE TABLE `order_goods`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `goods_id` bigint(20) UNSIGNED NOT NULL,
  `goods_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `wholesale` decimal(10, 2) NOT NULL,
  `selling_price` decimal(10, 2) NOT NULL,
  `market_price` decimal(10, 2) NOT NULL,
  `goods_num` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
