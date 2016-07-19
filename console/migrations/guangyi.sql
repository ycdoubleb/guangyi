/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50709
Source Host           : localhost:3306
Source Database       : guangyi

Target Server Type    : MYSQL
Target Server Version : 50709
File Encoding         : 65001

Date: 2016-07-19 22:27:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `guangyi_assess_log`
-- ----------------------------
DROP TABLE IF EXISTS `guangyi_assess_log`;
CREATE TABLE `guangyi_assess_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '考核记录id',
  `u_id` varchar(36) NOT NULL COMMENT '用户id',
  `result` tinyint(1) NOT NULL COMMENT '考核结果0/1(失败/成功)',
  `data` varchar(3000) DEFAULT NULL COMMENT '考核数据',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1022 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of guangyi_assess_log
-- ----------------------------
INSERT INTO `guangyi_assess_log` VALUES ('1010', '9', '0', '[{\"substepdata\":null,\"trainId\":0,\"pass\":true},{\"substepdata\":{\"subtiptool\":\"选择试剂：{reagent}\",\"data\":{\"reagent\":\"Ca153\"},\"doRight\":false},\"trainId\":2,\"pass\":false}]', '1468132411', '1468132411');
INSERT INTO `guangyi_assess_log` VALUES ('1013', '9', '0', '[{\"substepdata\":{\"subtiptool\":\"选择试剂：{reagent}\",\"data\":{\"reagent\":\"Ca125\"},\"doRight\":false},\"trainId\":2,\"pass\":false},{\"substepdata\":{\"subtiptool\":\"添加蒸馏水：{tube}ml<br/>放置时长：{timer}\",\"data\":{\"tube\":6,\"timer\":43200},\"doRight\":false},\"trainId\":5,\"pass\":false},{\"substepdata\":null,\"trainId\":4,\"pass\":false}]', '1468132579', '1468132579');
INSERT INTO `guangyi_assess_log` VALUES ('1014', '9', '1', '[{\"substepdata\":null,\"pass\":true,\"trainId\":0},{\"substepdata\":null,\"pass\":true,\"trainId\":3},{\"substepdata\":{\"subtiptool\":\"添加蒸馏水：{tube}ml<br/>放置时长：{timer}\",\"data\":{\"timer\":1800,\"tube\":1},\"doRight\":true},\"pass\":true,\"trainId\":4},{\"substepdata\":{\"subtiptool\":\"添加蒸馏水：{tube}ml<br/>放置时长：{timer}\",\"data\":{\"timer\":1800,\"tube\":5},\"doRight\":true},\"pass\":true,\"trainId\":5},{\"substepdata\":{\"subtiptool\":\"选择试剂：{reagent}\",\"data\":{\"reagent\":\"AFP\"},\"doRight\":true},\"pass\":true,\"trainId\":2},{\"substepdata\":null,\"pass\":true,\"trainId\":7},{\"substepdata\":null,\"pass\":true,\"trainId\":8},{\"substepdata\":null,\"pass\":true,\"trainId\":9},{\"substepdata\":{\"subtiptool\":\"质控值：<br/>低值：{lowValue}<br/>高值：{hightValue}\",\"data\":{\"hightValue\":104.433,\"lowValue\":8.861},\"doRight\":true},\"pass\":true,\"trainId\":10},{\"substepdata\":{\"subtiptool\":\"离心时间：{timer}<br/>转数：{rotaioin}转\",\"data\":{\"rotaioin\":3000,\"timer\":180},\"doRight\":true},\"pass\":true,\"trainId\":6},{\"substepdata\":null,\"pass\":true,\"trainId\":11},{\"substepdata\":null,\"pass\":true,\"trainId\":12},{\"substepdata\":{\"subtiptool\":\"\",\"data\":{},\"doRight\":true},\"pass\":true,\"trainId\":13},{\"substepdata\":null,\"pass\":true,\"trainId\":14},{\"substepdata\":null,\"pass\":true,\"trainId\":15},{\"substepdata\":null,\"pass\":true,\"trainId\":1},{\"substepdata\":null,\"pass\":true,\"trainId\":16}]', '1468134863', '1468134863');
INSERT INTO `guangyi_assess_log` VALUES ('1015', '9', '0', '[{\"substepdata\":null,\"pass\":true,\"trainId\":0},{\"substepdata\":null,\"pass\":true,\"trainId\":3},{\"substepdata\":{\"subtiptool\":\"选择试剂：{reagent}\",\"data\":{\"reagent\":\"AFP\"},\"doRight\":true},\"pass\":true,\"trainId\":2},{\"substepdata\":{\"subtiptool\":\"添加蒸馏水：{tube}ml<br/>放置时长：{timer}\",\"data\":{\"timer\":1800,\"tube\":1},\"doRight\":true},\"pass\":true,\"trainId\":4},{\"substepdata\":null,\"pass\":true,\"trainId\":7},{\"substepdata\":null,\"pass\":true,\"trainId\":8}]', '1468135409', '1468135409');
INSERT INTO `guangyi_assess_log` VALUES ('1019', '3', '0', '[{\"substepdata\":null,\"pass\":true,\"trainId\":0},{\"substepdata\":null,\"pass\":true,\"trainId\":3},{\"substepdata\":{\"doRight\":false,\"subtiptool\":\"选择试剂：{reagent}\",\"data\":{\"reagent\":\"CEA\"}},\"pass\":false,\"trainId\":2},{\"substepdata\":{\"doRight\":false,\"subtiptool\":\"添加蒸馏水：{tube}ml<br/>放置时长：{timer}\",\"data\":{\"timer\":13,\"tube\":6}},\"pass\":false,\"trainId\":5},{\"substepdata\":{\"doRight\":false,\"subtiptool\":\"离心时间：{timer}<br/>转数：{rotaioin}转\",\"data\":{\"rotaioin\":123,\"timer\":60}},\"pass\":false,\"trainId\":6},{\"substepdata\":{\"doRight\":false,\"subtiptool\":\"添加蒸馏水：{tube}ml<br/>放置时长：{timer}\",\"data\":{\"timer\":1800,\"tube\":5}},\"pass\":false,\"trainId\":4}]', '1468146061', '1468146061');
INSERT INTO `guangyi_assess_log` VALUES ('1020', '3', '0', '[{\"substepdata\":null,\"pass\":true,\"trainId\":3},{\"substepdata\":{\"doRight\":false,\"subtiptool\":\"选择试剂：{reagent}\",\"data\":{\"reagent\":\"Ca153\"}},\"pass\":false,\"trainId\":2},{\"substepdata\":{\"doRight\":false,\"subtiptool\":\"离心时间：{timer}<br/>转数：{rotaioin}转\",\"data\":{\"rotaioin\":100,\"timer\":1200}},\"pass\":false,\"trainId\":6},{\"substepdata\":{\"doRight\":false,\"subtiptool\":\"添加蒸馏水：{tube}ml<br/>放置时长：{timer}\",\"data\":{\"timer\":120,\"tube\":5}},\"pass\":false,\"trainId\":5},{\"substepdata\":null,\"pass\":false,\"trainId\":4}]', '1468146120', '1468146120');
INSERT INTO `guangyi_assess_log` VALUES ('1021', '3', '0', '[{\"substepdata\":null,\"pass\":true,\"trainId\":3},{\"substepdata\":{\"doRight\":false,\"subtiptool\":\"离心时间：{timer}<br/>转数：{rotaioin}转\",\"data\":{\"rotaioin\":44,\"timer\":1500}},\"pass\":false,\"trainId\":6},{\"substepdata\":{\"doRight\":false,\"subtiptool\":\"添加蒸馏水：{tube}ml<br/>放置时长：{timer}\",\"data\":{\"timer\":60,\"tube\":10}},\"pass\":false,\"trainId\":4},{\"substepdata\":null,\"pass\":true,\"trainId\":0}]', '1468146173', '1468146173');

-- ----------------------------
-- Table structure for `guangyi_auth_assignment`
-- ----------------------------
DROP TABLE IF EXISTS `guangyi_auth_assignment`;
CREATE TABLE `guangyi_auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(36) NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `fk_u_id_1` (`user_id`),
  CONSTRAINT `fk_item_name` FOREIGN KEY (`item_name`) REFERENCES `guangyi_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_u_id_1` FOREIGN KEY (`user_id`) REFERENCES `guangyi_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of guangyi_auth_assignment
-- ----------------------------
INSERT INTO `guangyi_auth_assignment` VALUES ('r_admin', '3', '1467613666');
INSERT INTO `guangyi_auth_assignment` VALUES ('r_admin', '3c376bb33b1d43128f3785c5d214cd5e', '1467613688');
INSERT INTO `guangyi_auth_assignment` VALUES ('r_admin', '9', '1447224856');
INSERT INTO `guangyi_auth_assignment` VALUES ('r_users', '4', '1467613705');
INSERT INTO `guangyi_auth_assignment` VALUES ('r_users', '5', '1467613738');
INSERT INTO `guangyi_auth_assignment` VALUES ('r_users', '6', '1467613748');
INSERT INTO `guangyi_auth_assignment` VALUES ('r_users', '8', '1467613755');

-- ----------------------------
-- Table structure for `guangyi_auth_item`
-- ----------------------------
DROP TABLE IF EXISTS `guangyi_auth_item`;
CREATE TABLE `guangyi_auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  CONSTRAINT `guangyi_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `guangyi_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of guangyi_auth_item
-- ----------------------------
INSERT INTO `guangyi_auth_item` VALUES ('p_guangyi_admin', '2', '管理用户、查看进度权限', null, null, '1467612962', '1467612962');
INSERT INTO `guangyi_auth_item` VALUES ('p_guangyi_user', '2', '普通数据提交权限', null, null, '1467613046', '1467613046');
INSERT INTO `guangyi_auth_item` VALUES ('r_admin', '1', '管理员', null, null, '1441858950', '1447220560');
INSERT INTO `guangyi_auth_item` VALUES ('r_guest', '1', '游客', null, null, '1446444475', '1447220577');
INSERT INTO `guangyi_auth_item` VALUES ('r_users', '1', '普通用户', null, null, '1467612657', '1467612657');

-- ----------------------------
-- Table structure for `guangyi_auth_item_child`
-- ----------------------------
DROP TABLE IF EXISTS `guangyi_auth_item_child`;
CREATE TABLE `guangyi_auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `guangyi_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `guangyi_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `guangyi_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `guangyi_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of guangyi_auth_item_child
-- ----------------------------
INSERT INTO `guangyi_auth_item_child` VALUES ('r_admin', 'p_guangyi_admin');
INSERT INTO `guangyi_auth_item_child` VALUES ('r_admin', 'p_guangyi_user');
INSERT INTO `guangyi_auth_item_child` VALUES ('r_users', 'p_guangyi_user');

-- ----------------------------
-- Table structure for `guangyi_auth_rule`
-- ----------------------------
DROP TABLE IF EXISTS `guangyi_auth_rule`;
CREATE TABLE `guangyi_auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of guangyi_auth_rule
-- ----------------------------
INSERT INTO `guangyi_auth_rule` VALUES ('myRule', 'O:25:\"common\\models\\rbac\\MyRule\":3:{s:4:\"name\";s:6:\"myRule\";s:9:\"createdAt\";i:1446630496;s:9:\"updatedAt\";i:1446630496;}', '1446630496', '1446630496');
INSERT INTO `guangyi_auth_rule` VALUES ('ShootOwnAppraiseRule', 'O:39:\"common\\models\\rbac\\ShootOwnAppraiseRule\":3:{s:4:\"name\";s:20:\"ShootOwnAppraiseRule\";s:9:\"createdAt\";i:1448243519;s:9:\"updatedAt\";i:1448243519;}', '1448243519', '1448243519');
INSERT INTO `guangyi_auth_rule` VALUES ('ShootOwnCancelRule', 'O:37:\"common\\models\\rbac\\ShootOwnCancelRule\":3:{s:4:\"name\";s:18:\"ShootOwnCancelRule\";s:9:\"createdAt\";N;s:9:\"updatedAt\";i:1448243519;}', '1448243469', '1448243519');
INSERT INTO `guangyi_auth_rule` VALUES ('ShootOwnRule', 'O:31:\"common\\models\\rbac\\ShootOwnRule\":3:{s:4:\"name\";s:12:\"ShootOwnRule\";s:9:\"createdAt\";N;s:9:\"updatedAt\";i:1448243519;}', '1446693924', '1448243519');

-- ----------------------------
-- Table structure for `guangyi_current_progress`
-- ----------------------------
DROP TABLE IF EXISTS `guangyi_current_progress`;
CREATE TABLE `guangyi_current_progress` (
  `uid` int(36) NOT NULL,
  `progress` tinyint(2) NOT NULL DEFAULT '-1' COMMENT '用户当前进度',
  `created_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of guangyi_current_progress
-- ----------------------------
INSERT INTO `guangyi_current_progress` VALUES ('9', '3', null, null);
INSERT INTO `guangyi_current_progress` VALUES ('3', '2', null, null);

-- ----------------------------
-- Table structure for `guangyi_step_result`
-- ----------------------------
DROP TABLE IF EXISTS `guangyi_step_result`;
CREATE TABLE `guangyi_step_result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` varchar(36) NOT NULL,
  `access_id` int(11) NOT NULL COMMENT '对应考核记录id',
  `step` tinyint(22) NOT NULL COMMENT '相关步骤',
  `result` tinyint(2) NOT NULL DEFAULT '0' COMMENT '操作步骤的结果0(错误)',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of guangyi_step_result
-- ----------------------------
INSERT INTO `guangyi_step_result` VALUES ('1', '9', '1013', '2', '0', null, null);
INSERT INTO `guangyi_step_result` VALUES ('2', '9', '1013', '5', '0', null, null);
INSERT INTO `guangyi_step_result` VALUES ('3', '9', '1013', '4', '0', null, null);
INSERT INTO `guangyi_step_result` VALUES ('4', '9', '1016', '5', '0', null, null);
INSERT INTO `guangyi_step_result` VALUES ('5', '9', '1018', '4', '0', null, null);
INSERT INTO `guangyi_step_result` VALUES ('6', '3', '1019', '2', '0', null, null);
INSERT INTO `guangyi_step_result` VALUES ('7', '3', '1019', '5', '0', null, null);
INSERT INTO `guangyi_step_result` VALUES ('8', '3', '1019', '6', '0', null, null);
INSERT INTO `guangyi_step_result` VALUES ('9', '3', '1019', '4', '0', null, null);
INSERT INTO `guangyi_step_result` VALUES ('10', '3', '1020', '2', '0', null, null);
INSERT INTO `guangyi_step_result` VALUES ('11', '3', '1020', '6', '0', null, null);
INSERT INTO `guangyi_step_result` VALUES ('12', '3', '1020', '5', '0', null, null);
INSERT INTO `guangyi_step_result` VALUES ('13', '3', '1020', '4', '0', null, null);
INSERT INTO `guangyi_step_result` VALUES ('14', '3', '1021', '6', '0', null, null);
INSERT INTO `guangyi_step_result` VALUES ('15', '3', '1021', '4', '0', null, null);

-- ----------------------------
-- Table structure for `guangyi_study_progress`
-- ----------------------------
DROP TABLE IF EXISTS `guangyi_study_progress`;
CREATE TABLE `guangyi_study_progress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(36) NOT NULL DEFAULT '' COMMENT '用户id',
  `index` tinyint(2) NOT NULL,
  `result` tinyint(2) NOT NULL DEFAULT '0' COMMENT '用户在指定环节进度0/1(未完成/完成)',
  `updated_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of guangyi_study_progress
-- ----------------------------
INSERT INTO `guangyi_study_progress` VALUES ('1', '9', '0', '1', null, null);
INSERT INTO `guangyi_study_progress` VALUES ('2', '9', '1', '1', null, null);
INSERT INTO `guangyi_study_progress` VALUES ('3', '9', '2', '1', null, null);
INSERT INTO `guangyi_study_progress` VALUES ('4', '9', '3', '0', null, null);
INSERT INTO `guangyi_study_progress` VALUES ('5', '3', '0', '1', null, null);
INSERT INTO `guangyi_study_progress` VALUES ('6', '3', '1', '1', null, null);
INSERT INTO `guangyi_study_progress` VALUES ('7', '3', '2', '1', null, null);
INSERT INTO `guangyi_study_progress` VALUES ('8', '3', '3', '1', null, null);
INSERT INTO `guangyi_study_progress` VALUES ('9', 'a1922b519c0830aec33de8e3c32994bd', '0', '1', '1468422245', '1468422232');
INSERT INTO `guangyi_study_progress` VALUES ('10', 'a1922b519c0830aec33de8e3c32994bd', '1', '1', '1468422252', '1468422252');
INSERT INTO `guangyi_study_progress` VALUES ('11', '5d95314f7607fd46473faf9c70ea139b', '0', '1', '1468938009', '1468938009');

-- ----------------------------
-- Table structure for `guangyi_system`
-- ----------------------------
DROP TABLE IF EXISTS `guangyi_system`;
CREATE TABLE `guangyi_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '模块id',
  `name` varchar(64) DEFAULT NULL COMMENT '模块名',
  `module_image` varchar(255) DEFAULT NULL COMMENT '模块图片',
  `module_link` varchar(255) DEFAULT '#' COMMENT '描述',
  `des` varchar(255) DEFAULT NULL COMMENT '模块链接',
  `isjump` tinyint(1) DEFAULT NULL COMMENT '是否跳转页面, 1:为是',
  `aliases` varchar(255) DEFAULT NULL COMMENT '模块别名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of guangyi_system
-- ----------------------------
INSERT INTO `guangyi_system` VALUES ('1', '课程项目管理', '/filedata/system/course_project.jpg', '/teamwork/default', '专门提供课程项目管理', '0', 'teamwork');
INSERT INTO `guangyi_system` VALUES ('2', '课程预约拍摄', '/filedata/system/shoot_bookdeta.jpg', '/shoot/bookdetail', '专门提供编导与摄影师拍摄任务预约工作', '0', 'shoot');
INSERT INTO `guangyi_system` VALUES ('3', '后期工作管理', '/filedata/system/post_work.jpg', '#', '专门提供多媒体制作', '0', null);
INSERT INTO `guangyi_system` VALUES ('4', '专家资源库', '/filedata/system/expert.jpg', '/expert/default', '专门提供专家库信息', '0', 'expert');
INSERT INTO `guangyi_system` VALUES ('8', '资源展示', '/filedata/system/u236_b.png', '/resource/default', '', '0', 'resource');
INSERT INTO `guangyi_system` VALUES ('9', '文档管理', '/filedata/system/icoa.jpg', '/filemanage/file', '', '0', 'filemanage');

-- ----------------------------
-- Table structure for `guangyi_user`
-- ----------------------------
DROP TABLE IF EXISTS `guangyi_user`;
CREATE TABLE `guangyi_user` (
  `id` varchar(36) NOT NULL,
  `username` varchar(32) NOT NULL COMMENT '用户名',
  `auth_key` varchar(32) DEFAULT NULL,
  `password` varchar(64) NOT NULL COMMENT '密码',
  `password_reset_token` varchar(255) DEFAULT NULL COMMENT '密码重置',
  `sex` tinyint(2) DEFAULT '1' COMMENT '性别',
  `email` varchar(255) DEFAULT NULL COMMENT '电子邮件',
  `status` int(2) DEFAULT '10' COMMENT '状态',
  `nickname` varchar(128) NOT NULL COMMENT '昵称',
  `avatar` varchar(255) DEFAULT '/filedata/avatars/wskeee.jpg' COMMENT '头像',
  `ee` varchar(255) DEFAULT NULL COMMENT 'ee号',
  `phone` varchar(255) DEFAULT NULL COMMENT '手机',
  `created_at` int(11) DEFAULT NULL COMMENT '创建于',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新于',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of guangyi_user
-- ----------------------------
INSERT INTO `guangyi_user` VALUES ('3', 'cy', '8hb7ziPfVr4a12X92RKVwIhpJXWYSeJP', 'E10ADC3949BA59ABBE56E057F20F883E', null, '2', 'cy@163.com', '10', '陈艳', '/filedata/avatars/cy.jpg', '', '', '1441614873', '1467613422');
INSERT INTO `guangyi_user` VALUES ('3c376bb33b1d43128f3785c5d214cd5e', 'admin', '3c376bb33b1d43128f3785c5d214cd5e', '21218CCA77804D2BA1922C33E0151105', '', '1', '123@qq.com', '10', '超级管理员', '', '', '88888888888', '1450409959', '1450409959');
INSERT INTO `guangyi_user` VALUES ('4', 'wb', 'BusRaEvek1p930gnd2m6osMOMJvnrEj0', 'E10ADC3949BA59ABBE56E057F20F883E', null, '1', 'wb@163.com', '10', '魏彬', '', '', '', '1441614900', '1449654963');
INSERT INTO `guangyi_user` VALUES ('5', 'cdd', '8TSmrqT76q8tAxPW1WvS2m8zoxhHqtTj', 'E10ADC3949BA59ABBE56E057F20F883E', null, '1', 'cdd@163.com', '10', '陈丹丹', '', '', '', '1441614926', '1446443658');
INSERT INTO `guangyi_user` VALUES ('5d95314f7607fd46473faf9c70ea139b', 'goo', 'YD21vh9dwZlE-AJ2MaX5NWJ1bqBNFTeM', 'E10ADC3949BA59ABBE56E057F20F883E', null, '1', 'goo@163.com', '10', 'goo', '/filedata/avatars/goo.jpg', '', '', '1468937915', '1468937978');
INSERT INTO `guangyi_user` VALUES ('6', 'lbk', 'YWQ1DlBuZBnzTAgm7J6l2BciOxfGiB6S', 'E10ADC3949BA59ABBE56E057F20F883E', null, '1', 'lbk@163.com', '10', '黎饼坤', '', '', '', '1441614957', '1446443679');
INSERT INTO `guangyi_user` VALUES ('8', 'ykb', '4hPmrNoMkbHUyhZlRrnbxfWFcCblJR3z', 'E10ADC3949BA59ABBE56E057F20F883E', null, '1', 'ykb@163.com', '10', '余克彬', '', null, null, '1442374028', '1442374028');
INSERT INTO `guangyi_user` VALUES ('9', 'wskeee', 'rgq5lSFeDMDtjf9wdLzIFGrywu0u5XD_', 'E10ADC3949BA59ABBE56E057F20F883E', null, '1', 'wskeee@163.com', '10', 'wskeee', '/filedata/avatars/wskeee.jpg', '101463731', '', '1442374107', '1461838976');
INSERT INTO `guangyi_user` VALUES ('a1922b519c0830aec33de8e3c32994bd', 'testA', 'iOrlMnR9_tw_DRgFf83McF--jFPGnplZ', 'E10ADC3949BA59ABBE56E057F20F883E', null, '1', '11@163.com', '10', 'testA', '/filedata/avatars/timg.jpg', '', '', '1468422183', '1468422183');
INSERT INTO `guangyi_user` VALUES ('e200ab17c3047b049d38981ccbc7d3b0', 'fee', 'MlgdyqZWdCnY4UZXdTt9Rhq5-QZ_Ij0Q', 'E10ADC3949BA59ABBE56E057F20F883E', null, '1', 'fee@163.com', '10', 'fee', '/filedata/avatars/fee.jpg', '', '', '1468938201', '1468938201');
