/*
SQLyog Ultimate v11.24 (32 bit)
MySQL - 5.5.47 : Database - 2016_yii2test
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `yii_admin` */

DROP TABLE IF EXISTS `yii_admin`;

CREATE TABLE `yii_admin` (
  `admin_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(15) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(60) NOT NULL DEFAULT '' COMMENT '密码',
  `email` char(32) NOT NULL DEFAULT '' COMMENT '邮箱',
  `auth_key` char(32) NOT NULL DEFAULT '',
  `lastloginip` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录ip',
  `lastlogintime` int(10) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `salt` char(6) NOT NULL DEFAULT '' COMMENT '盐',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '管理员类型',
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='管理员';

/*Data for the table `yii_admin` */

insert  into `yii_admin`(`admin_id`,`username`,`password`,`email`,`auth_key`,`lastloginip`,`lastlogintime`,`salt`,`type`) values (1,'admin','$2y$13$7c8pisntD/zI3dWEyKVbiuqM79SfsXQmWgN/K7acolzt9I.X.UlpC','','',0,0,'',100),(2,'admin2','$2y$13$7c8pisntD/zI3dWEyKVbiuqM79SfsXQmWgN/K7acolzt9I.X.UlpC','','',0,0,'',100),(3,'author1','$2y$13$7c8pisntD/zI3dWEyKVbiuqM79SfsXQmWgN/K7acolzt9I.X.UlpC','','',0,0,'',2),(4,'author2','$2y$13$7c8pisntD/zI3dWEyKVbiuqM79SfsXQmWgN/K7acolzt9I.X.UlpC','','',0,0,'',2);

/*Table structure for table `yii_user` */

DROP TABLE IF EXISTS `yii_user`;

CREATE TABLE `yii_user` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(15) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(60) NOT NULL DEFAULT '' COMMENT '密码',
  `mobile` char(15) NOT NULL DEFAULT '' COMMENT '手机/电话',
  `email` char(32) NOT NULL DEFAULT '' COMMENT '邮箱',
  `auth_key` char(32) NOT NULL DEFAULT '',
  `regip` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册ip',
  `regdate` int(10) NOT NULL DEFAULT '0' COMMENT '注册时间',
  `lastloginip` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录ip',
  `lastlogintime` int(10) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `salt` char(6) NOT NULL DEFAULT '' COMMENT '盐',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '用户类型：1,2',
  `bind_qq` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否绑定qq:0未绑定，1已绑定',
  `bind_wb` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否绑定微博:0未绑定，1已绑定',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `mobile_UNIQUE` (`mobile`),
  KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户表';

/*Data for the table `yii_user` */

insert  into `yii_user`(`user_id`,`username`,`password`,`mobile`,`email`,`auth_key`,`regip`,`regdate`,`lastloginip`,`lastlogintime`,`salt`,`type`,`bind_qq`,`bind_wb`) values (1,'test01','$2y$13$7c8pisntD/zI3dWEyKVbiuqM79SfsXQmWgN/K7acolzt9I.X.UlpC','15800000000','','',0,1465801046,0,0,'',0,0,0),(2,'test02','$2y$13$7c8pisntD/zI3dWEyKVbiuqM79SfsXQmWgN/K7acolzt9I.X.UlpC','15854569301','','',0,1466480748,0,0,'',0,0,0),(3,'test03','$2y$13$7c8pisntD/zI3dWEyKVbiuqM79SfsXQmWgN/K7acolzt9I.X.UlpC','123','','',0,1466487776,0,0,'',0,0,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
