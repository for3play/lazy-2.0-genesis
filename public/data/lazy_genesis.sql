/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50622
Source Host           : localhost:3306
Source Database       : lazy_genesis

Target Server Type    : MYSQL
Target Server Version : 50622
File Encoding         : 65001

Date: 2015-02-11 16:25:13
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_books
-- ----------------------------
INSERT INTO `tbl_books` VALUES ('1', 'The Bible', 'Christianity', null, '400', 'bible@christianity.com', '1');
INSERT INTO `tbl_books` VALUES ('2', 'The Koran', 'Islam', null, '300', 'koran@islam.com', '4');
INSERT INTO `tbl_books` VALUES ('3', 'Bhagavad Gita', 'Hindu', null, '200', 'bg@hindu.com', '1');
INSERT INTO `tbl_books` VALUES ('4', 'Art of War', 'Tzu Sun', '', '700', 'aow@suntzu.com', '2');
INSERT INTO `tbl_books` VALUES ('5', 'Go Rin No Sho', 'Miyamoto Musashi', '', '200', 'miyamoto@fiverings.com', '1');
INSERT INTO `tbl_books` VALUES ('6', 'Clear and Present Danger', 'Tom Clancy', null, '600', 'tom@clancy.com', '4');
INSERT INTO `tbl_books` VALUES ('7', 'The Sphere', 'Michael Crichton', '', '200', 'michael@chrichton.com', '1');
INSERT INTO `tbl_books` VALUES ('8', 'Bourne Identity', 'Robert Ludlum', '', '700', 'robert@ludlum.com', '4');
INSERT INTO `tbl_books` VALUES ('9', 'Call of the Wild', 'Rudyard Kipling', '', '400', 'rudyard@kipling.com', '3');
INSERT INTO `tbl_books` VALUES ('10', 'Inferno', 'Dante Alighieri', '', '500', 'dante@alegheiri.com', '1');
INSERT INTO `tbl_books` VALUES ('11', 'Paradise Lost', 'John Milton', '', '900', 'john@milton.com', '1');
INSERT INTO `tbl_books` VALUES ('12', 'Romeo and Juliet', 'William Shakespeare', null, '600', 'william@shakespear.com', '1');
INSERT INTO `tbl_books` VALUES ('13', 'Kama Sutra', 'Indian', '', '12', 'kama@sutra.com', '2');
INSERT INTO `tbl_books` VALUES ('14', 'The Arabian Nights', 'Some Arab Guy', null, '300', 'thousandandone@arabia.com', '1');
INSERT INTO `tbl_books` VALUES ('15', 'The Prince', 'Nicollo Machiavelli', null, '200', 'nicollo@theprince.com', '1');
INSERT INTO `tbl_books` VALUES ('16', 'This War of Mine', '11bit Studios', null, '300', 'game@11bit.com', '1');
INSERT INTO `tbl_books` VALUES ('17', 'Book of Life', 'life book', '', '100', 'life@book.com', '2');
INSERT INTO `tbl_books` VALUES ('18', 'The Sum of all Fears', 'Tom Clancy', '', '300', 'tom@clancy.com', '3');
INSERT INTO `tbl_books` VALUES ('19', 'Lord of the Rings', 'Tolkien', '', '0', 'jj@tolkien.com', '4');
INSERT INTO `tbl_books` VALUES ('20', 'Paradise Gained', 'John Milton', '', '123', 'milton@paradise.com', '5');
INSERT INTO `tbl_books` VALUES ('21', 'Paradise Regained', 'John Milton', null, '123', 'milton@paradise.com', '5');
INSERT INTO `tbl_books` VALUES ('22', 'The Little Prince', 'Exupery', '2015/01/01', '123', 'little@prince.com', '5');
INSERT INTO `tbl_books` VALUES ('23', 'Without Remorse', 'Tom Clancy', '2015/01/06', '123', 'tom@clancy.com', '6');
INSERT INTO `tbl_books` VALUES ('24', 'Hello World', 'developer', '2015/01/01', '333', 'dev@developer.com', '3');
INSERT INTO `tbl_books` VALUES ('25', 'Man of Steel', 'DC Comics', '2015/01/01', '0', 'dc@comics.com', '14');
INSERT INTO `tbl_books` VALUES ('26', 'Batman Beyond', 'DC comics', '2015/01/07', '123', 'batman@dc.com', '14');

-- ----------------------------
-- Table structure for `tbl_genres`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_genres`;
CREATE TABLE `tbl_genres` (
  `gen_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `gen_name` varchar(255) NOT NULL,
  `gen_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`gen_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_genres
-- ----------------------------
INSERT INTO `tbl_genres` VALUES ('1', 'Not Categorized', null);
INSERT INTO `tbl_genres` VALUES ('2', 'Non-Fiction', null);
INSERT INTO `tbl_genres` VALUES ('3', 'Science Fiction', null);
INSERT INTO `tbl_genres` VALUES ('4', 'Action', 'Action packed');
INSERT INTO `tbl_genres` VALUES ('5', 'Fantasy', 'this is fantasy');
INSERT INTO `tbl_genres` VALUES ('6', 'History', 'historical');
INSERT INTO `tbl_genres` VALUES ('7', 'Biography', 'Bio dude');
INSERT INTO `tbl_genres` VALUES ('8', 'Children\'s', '');
INSERT INTO `tbl_genres` VALUES ('9', 'Kid\'s books', '');
INSERT INTO `tbl_genres` VALUES ('10', 'Self-learn', '');
INSERT INTO `tbl_genres` VALUES ('11', 'Religious', '');
INSERT INTO `tbl_genres` VALUES ('12', 'Tutorial', '');
INSERT INTO `tbl_genres` VALUES ('13', 'Occult', '');
INSERT INTO `tbl_genres` VALUES ('14', 'Based on Movie', '');
