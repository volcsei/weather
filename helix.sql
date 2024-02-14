/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : helix

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 14/02/2024 16:22:13
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cities
-- ----------------------------
DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `longitude` double NULL DEFAULT NULL,
  `latitude` double NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cities
-- ----------------------------
INSERT INTO `cities` VALUES (3, 'London', -0.2664031, 51.5287398, '2024-02-12 20:07:22', '2024-02-13 09:49:19', NULL);
INSERT INTO `cities` VALUES (6, 'Budapest', 19.0407, 47.4983, '2024-02-13 07:54:33', '2024-02-14 08:54:59', NULL);
INSERT INTO `cities` VALUES (7, 'Koppenhága', 12.5114242, 55.6713366, '2024-02-13 08:48:32', '2024-02-13 08:48:32', NULL);
INSERT INTO `cities` VALUES (8, 'Stockholm', 17.8172496, 59.3262131, '2024-02-14 08:55:35', '2024-02-14 09:58:28', NULL);

-- ----------------------------
-- Table structure for weathers
-- ----------------------------
DROP TABLE IF EXISTS `weathers`;
CREATE TABLE `weathers`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `city_id` int NULL DEFAULT NULL,
  `temperature` double NULL DEFAULT NULL,
  `humidity` double NULL DEFAULT NULL,
  `windspeed` double NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 48 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of weathers
-- ----------------------------
INSERT INTO `weathers` VALUES (22, 3, 12.09, 94, 5.14, '2024-02-14 08:58:30', '2024-02-14 08:58:30', NULL);
INSERT INTO `weathers` VALUES (23, 6, 7.44, 63, 2.24, '2024-02-14 08:58:30', '2024-02-14 08:58:30', NULL);
INSERT INTO `weathers` VALUES (24, 7, 4.03, 94, 4.12, '2024-02-14 08:58:30', '2024-02-14 08:58:30', NULL);
INSERT INTO `weathers` VALUES (25, 8, -1.98, 98, 1.54, '2024-02-14 08:58:30', '2024-02-14 08:58:30', NULL);
INSERT INTO `weathers` VALUES (26, 3, 12.12, 94, 5.66, '2024-02-14 09:09:45', '2024-02-14 09:09:45', NULL);
INSERT INTO `weathers` VALUES (27, 6, 7.24, 62, 3.6, '2024-02-14 09:09:45', '2024-02-14 09:09:45', NULL);
INSERT INTO `weathers` VALUES (28, 7, 4.04, 94, 4.12, '2024-02-14 09:09:45', '2024-02-14 09:09:45', NULL);
INSERT INTO `weathers` VALUES (29, 8, -1.56, 94, 1.54, '2024-02-14 09:09:46', '2024-02-14 09:09:46', NULL);
INSERT INTO `weathers` VALUES (30, 3, 13.4, 91, 5.66, '2024-02-14 14:55:48', '2024-02-14 14:55:48', NULL);
INSERT INTO `weathers` VALUES (31, 6, 9.56, 56, 4.63, '2024-02-14 14:55:48', '2024-02-14 14:55:48', NULL);
INSERT INTO `weathers` VALUES (32, 7, 4.7, 89, 2.57, '2024-02-14 14:55:49', '2024-02-14 14:55:49', NULL);
INSERT INTO `weathers` VALUES (33, 8, 0.81, 97, 2.06, '2024-02-14 14:55:49', '2024-02-14 14:55:49', NULL);
INSERT INTO `weathers` VALUES (34, 3, 13.4, 91, 5.66, '2024-02-14 15:56:33', '2024-02-14 15:56:52', NULL);
INSERT INTO `weathers` VALUES (35, 6, 9.56, 56, 4.63, '2024-02-14 15:56:33', '2024-02-14 15:56:56', NULL);
INSERT INTO `weathers` VALUES (36, 7, 4.7, 89, 2.57, '2024-02-14 15:56:33', '2024-02-14 15:56:58', NULL);
INSERT INTO `weathers` VALUES (37, 8, 0.81, 97, 2.06, '2024-02-14 15:56:33', '2024-02-14 15:56:59', NULL);
INSERT INTO `weathers` VALUES (38, 3, 13.4, 91, 5.66, '2024-02-14 16:56:35', '2024-02-14 15:57:09', NULL);
INSERT INTO `weathers` VALUES (39, 6, 9.56, 56, 4.63, '2024-02-14 16:56:35', '2024-02-14 15:57:10', NULL);
INSERT INTO `weathers` VALUES (40, 7, 4.7, 89, 2.57, '2024-02-14 16:56:35', '2024-02-14 15:57:14', NULL);
INSERT INTO `weathers` VALUES (41, 8, 0.81, 97, 2.06, '2024-02-14 16:56:35', '2024-02-14 15:57:18', NULL);
INSERT INTO `weathers` VALUES (42, 3, 13.4, 91, 5.66, '2024-02-14 17:59:28', '2024-02-14 15:59:35', NULL);
INSERT INTO `weathers` VALUES (43, 6, 9.56, 56, 4.63, '2024-02-14 17:59:28', '2024-02-14 15:59:39', NULL);
INSERT INTO `weathers` VALUES (44, 7, 4.7, 89, 2.57, '2024-02-14 17:59:28', '2024-02-14 15:59:40', NULL);
INSERT INTO `weathers` VALUES (45, 8, 0.81, 97, 2.06, '2024-02-14 17:59:29', '2024-02-14 15:59:43', NULL);
INSERT INTO `weathers` VALUES (47, 3, 12.12, 94, 5.66, '2024-02-14 09:15:45', '2024-02-14 09:09:45', NULL);

SET FOREIGN_KEY_CHECKS = 1;
