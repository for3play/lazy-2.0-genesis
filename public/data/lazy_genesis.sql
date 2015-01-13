/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50622
Source Host           : localhost:3306
Source Database       : lazy_genesis

Target Server Type    : MYSQL
Target Server Version : 50622
File Encoding         : 65001

Date: 2015-01-13 02:06:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tbl_books`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_books`;
CREATE TABLE `tbl_books` (
  `book_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `book_title` varchar(255) NOT NULL,
  `book_author` varchar(255) NOT NULL,
  `book_date_published` varchar(255) DEFAULT NULL,
  `book_pages` int(11) DEFAULT NULL,
  `book_author_email` varchar(255) DEFAULT NULL,
  `book_fk_gen_id` bigint(20) NOT NULL DEFAULT '1',
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_books
-- ----------------------------
INSERT INTO `tbl_books` VALUES ('1', 'The Bible', 'Christianity', null, '400', 'bible@christianity.com', '1');
INSERT INTO `tbl_books` VALUES ('2', 'The Koran', 'Islam', null, '300', 'koran@islam.com', '1');
INSERT INTO `tbl_books` VALUES ('3', 'Bhagavad Gita', 'Hindu', null, '200', 'bg@hindu.com', '1');
INSERT INTO `tbl_books` VALUES ('4', 'Art of War', 'Sun Tzu', null, '700', 'aow@suntzu.com', '1');
INSERT INTO `tbl_books` VALUES ('5', 'Go Rin No Sho', 'Miyamoto Musashi', null, '200', 'miyamoto@fiverings.com', '1');
INSERT INTO `tbl_books` VALUES ('6', 'Clear and Present Danger', 'Tom Clancy', null, '600', 'tom@clancy.com', '4');
INSERT INTO `tbl_books` VALUES ('7', 'The Sphere', 'Michael Crichton', null, '200', 'michael@chrichton.com', '1');
INSERT INTO `tbl_books` VALUES ('8', 'Bourne Identity', 'Robert Ludlum', null, '700', 'robert@ludlum.com', '4');
INSERT INTO `tbl_books` VALUES ('9', 'Call of the Wild', 'Rudyard Kipling', null, '400', 'rudyard@kipling.com', '1');
INSERT INTO `tbl_books` VALUES ('10', 'Inferno', 'Dante Alighieri', null, '500', 'dante@alegheiri.com', '1');
INSERT INTO `tbl_books` VALUES ('11', 'Paradise Lost', 'John Milton', null, '900', 'john@milton.com', '1');
INSERT INTO `tbl_books` VALUES ('12', 'Richard VI', 'William Shakespeare', null, '600', 'william@shakespear.com', '1');
