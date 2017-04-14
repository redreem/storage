SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `phone`
-- ----------------------------
DROP TABLE IF EXISTS `phone`;
CREATE TABLE `phone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone_encrypted` varchar(256) NOT NULL COMMENT 'Encrypted phone number',
  `email_hash` varchar(40) NOT NULL COMMENT 'SHA-1 e-mail hash',
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash_unique` (`email_hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phone
-- ----------------------------
