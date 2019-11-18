/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50725
 Source Host           : localhost:3306
 Source Schema         : siamprojectmanage

 Target Server Type    : MySQL
 Target Server Version : 50725
 File Encoding         : 65001

 Date: 18/11/2019 18:12:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for siam_abnormals
-- ----------------------------
DROP TABLE IF EXISTS `siam_abnormals`;
CREATE TABLE `siam_abnormals`  (
  `ab_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL COMMENT '所属项目id',
  `ab_class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `ab_date` date NOT NULL COMMENT '日期 用来索引统计数量',
  `ab_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '数据 如get post head cookie等',
  `ab_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '异常文件',
  `ab_line` int(10) NOT NULL COMMENT '异常所在文件行数',
  `ab_stack` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'call stack',
  `ab_fileresources` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL COMMENT '文件资源 如果有的话',
  `ab_message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '异常消息',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  `update_time` datetime(0) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`ab_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for siam_api_log
-- ----------------------------
DROP TABLE IF EXISTS `siam_api_log`;
CREATE TABLE `siam_api_log`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `api_full` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'api路径 = api类目.\"/\".api方法',
  `api_category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'api类目',
  `api_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'api方法',
  `is_success` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '成功|失败 1|0',
  `consume_time` int(10) NOT NULL COMMENT '消耗时间 单位ms',
  `user_from` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '用户来源，可以填入ip、城市名、调用账号等类型',
  `create_date` int(10) NOT NULL COMMENT '记录日期  YYYYddmm',
  `create_time` datetime(0) NOT NULL COMMENT '记录时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for siam_projects
-- ----------------------------
DROP TABLE IF EXISTS `siam_projects`;
CREATE TABLE `siam_projects`  (
  `project_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`project_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
