ALTER TABLE `wy_dining_company` ADD `memberCode` VARCHAR(50) NOT NULL , ADD `feiyin_key` VARCHAR(50) NOT NULL , ADD `deviceNo` VARCHAR(20) NOT NULL , ADD `print_status` INT(1) NOT NULL , ADD `phone` VARCHAR(20) NOT NULL , ADD `email` VARCHAR(255) NOT NULL , ADD `phone_status` INT(1) NOT NULL , ADD `email_status` INT(1) NOT NULL ;
ALTER TABLE `wy_home` ADD `photourl` VARCHAR(255) NOT NULL ;
ALTER TABLE `wy_reply_info` ADD `apiurl` VARCHAR(200) NOT NULL , ADD `homepic` VARCHAR(200) NOT NULL , ADD `keyword` VARCHAR(50) NOT NULL ;
ALTER TABLE `wy_userinfo` ADD `getcardtime` BIGINT(20) NOT NULL , ADD `expensetotal` INT(10) NOT NULL , ADD `account` FLOAT NOT NULL ;
ALTER TABLE `wy_home` ADD `logo` VARCHAR(255) NOT NULL ;
ALTER TABLE `wy_userinfo` ADD `portrait` VARCHAR(255) NOT NULL ;
ALTER TABLE `wy_product` ADD `sort` INT(10) NOT NULL , ADD `vprice` FLOAT NOT NULL , ADD `mailprice` FLOAT NOT NULL , ADD `num` INT(10) NOT NULL ;
ALTER TABLE  `wy_product_cart` ADD  `transactionid` VARCHAR( 100 ) NOT NULL ,ADD  `paytype` VARCHAR( 30 ) NOT NULL ,ADD  `productid` INT( 10 ) NOT NULL ,ADD  `code` VARCHAR( 50 ) NOT NULL ,ADD  `handledtime` INT( 10 ) NOT NULL ,ADD  `handleduid` INT( 10 ) NOT NULL ,ADD  `score` INT( 10 ) NOT NULL ,ADD  `paymode` TINYINT( 1 ) NOT NULL ,ADD `ordertype` MEDIUMINT(2) NOT NULL ;
ALTER TABLE `wy_product_cat` ADD `norms` VARCHAR(100) NOT NULL , ADD `color` VARCHAR(100) NOT NULL ;
ALTER TABLE `wy_classify` ADD `path` VARCHAR(3000) NOT NULL , ADD `tpid` TINYINT(4) NOT NULL , ADD `conttpid` TINYINT(4) NOT NULL ;
ALTER TABLE `wy_home` ADD `radiogroup` MEDIUMINT(4) NOT NULL ;
ALTER TABLE `wy_img` ADD `usort` INT(11) NOT NULL ;
ALTER TABLE `wy_users` ADD `cy` TINYINT(2) NOT NULL DEFAULT '0',ADD `wy` TINYINT(2) NOT NULL DEFAULT '0',ADD `yy` TINYINT(2) NOT NULL DEFAULT '0',ADD `fc` TINYINT(2) NOT NULL DEFAULT '0',ADD `jd` TINYINT(2) NOT NULL DEFAULT '0',ADD `yl` TINYINT(2) NOT NULL DEFAULT '0',ADD `qc` TINYINT(2) NOT NULL DEFAULT '0',ADD `dy` TINYINT(2) NOT NULL DEFAULT '0',ADD `mr` TINYINT(2) NOT NULL DEFAULT '0',ADD `jb` TINYINT(2) NOT NULL DEFAULT '0',ADD `jy` TINYINT(2) NOT NULL DEFAULT '0',ADD `hd` TINYINT(2) NOT NULL DEFAULT '0',ADD `zw` TINYINT(2) NOT NULL DEFAULT '0',ADD `js` TINYINT(2) NOT NULL DEFAULT '0',ADD `ly` TINYINT(2) NOT NULL DEFAULT '0',ADD `sp` TINYINT(2) NOT NULL DEFAULT '0',ADD `ktv` TINYINT(2) NULL DEFAULT '0' 
ALTER TABLE `wy_wxuser` CHANGE `tpltypeid` `tpltypeid` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1' COMMENT '默认首页模版ID', CHANGE `tpllistid` `tpllistid` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '列表模版ID', CHANGE `tplcontentid` `tplcontentid` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '内容模版ID';
INSERT INTO `wy_car_utility` (`id`, `name`, `url`, `status`) VALUES
(1, '车贷计算器', 'http://car.m.yiche.com/qichedaikuanjisuanqi/', 1),
(2, '保险计算', 'http://car.m.yiche.com/qichebaoxianjisuan/', 1),
(3, '全款计算', 'http://car.m.yiche.com/gouchejisuanqi/', 1),
(4, '车型比较', 'http://car.m.yiche.com/chexingduibi/?carIDs=102501', 1),
(5, '违章查询', 'http://wap.bjjtgl.gov.cn/wimframework/portal/wwwroot/bjjgj/xxcx.psml?contentType=%E8%BF%9D%E6%B3%95%', 0);
ALTER TABLE  `wy_reservation` ADD  `addtype` VARCHAR( 15 ) NOT NULL AFTER  `picurl`;
ALTER TABLE `wy_payment` CHANGE `pay_config` `pay_config` VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `wy_classify` CHANGE `tpid` `tpid` INT(4) NOT NULL;
ALTER TABLE `wy_wxuser` ADD `appid` VARCHAR(50) NOT NULL , ADD `appsecret` VARCHAR(50) NOT NULL ;
ALTER TABLE `wy_printer_set` ADD `bwdeviceNo` VARCHAR(20) NOT NULL , ADD `printpage` INT(2) NOT NULL DEFAULT '1' , ADD `printtype` VARCHAR(10) NOT NULL ;
ALTER TABLE `wy_dining_company` ADD `bwdeviceNo` VARCHAR(20) NOT NULL , ADD `printpage` INT(2) NOT NULL DEFAULT '1' , ADD `printtype` VARCHAR(10) NOT NULL ;
ALTER TABLE `wy_member_card_vip` ADD `usetime` INT(10) NOT NULL ;
ALTER TABLE `wy_vote_record` ADD `token` VARCHAR(50) NOT NULL ;
ALTER TABLE `wy_wxuser` ADD `smsid` INT(10) NOT NULL AFTER `smspassword`;
ALTER TABLE  `wy_vote` CHANGE  `display`  `display` TINYINT( 4 ) NULL ;
ALTER TABLE `wy_userinfo` ADD `wallopen` TINYINT(1) NOT NULL DEFAULT '0' , ADD `bornyear` VARCHAR(4) NOT NULL , ADD `bornmonth` VARCHAR(4) NOT NULL , ADD `bornday` VARCHAR(4) NOT NULL ;
ALTER TABLE `wy_product_cart` ADD `beizhu` VARCHAR(500) NOT NULL ;
ALTER TABLE `wy_wxuser` ADD `wxun` VARCHAR(64) NULL , ADD `wxpwd` VARCHAR(32) NOT NULL , ADD `binok` TINYINT(1) NOT NULL ;