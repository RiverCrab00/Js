-- 练习4模拟数据库

-- 创建项目库
CREATE DATABASE IF NOT EXISTS `ajax`;
USE ajax;
SET NAMES GBK;

-- 创建用户表
CREATE TABLE IF NOT EXISTS `record`(
`id` INT UNSIGNED AUTO_INCREMENT KEY COMMENT '自增长主键',
`title` VARCHAR(20) NOT NULL UNIQUE COMMENT '词条或博客标题,标题唯一',
`content` VARCHAR(255) NOT NULL COMMENT '词条或博客内容',
`click` INT UNSIGNED COMMENT '词条点击量'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 新增模拟用户记录
TRUNCATE record;
INSERT INTO `record` values(null,'php','我居然用sql写php是世界上最好的语言',1000);
INSERT INTO `record` values(null,'php入门','我居然在JavaScript作业中写php是世界上最好的语言',5000);
INSERT INTO `record` values(null,'php入门到精通','php是世界上最好的语言之一',300);
INSERT INTO `record` values(null,'javascript','我居然用sql写javascript是世界上最好的语言',10000);
INSERT INTO `record` values(null,'javascript入门','两链一包很重要',200);
INSERT INTO `record` values(null,'javascript入门到精通','javascript是世界上最好的语言之一',100);
