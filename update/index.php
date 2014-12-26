<?php
header("Content-type: text/html; charset=utf-8");

$arr = require("../data/Conf/db.php");
$dbpre=$arr['DB_PREFIX'];
$conn =mysql_connect($arr['DB_HOST'],$arr['DB_USER'],$arr['DB_PWD']) or die("连接数据库失败!");
mysql_select_db($arr['DB_NAME'],$conn);
mysql_query("set names utf8");

echo '更新开始...<br>';

if(existTable("{$dbpre}users")){
	if(!pdo_fieldexists("{$dbpre}users","dqdz")){
		$sql=mysql_query("ALTER TABLE `{$dbpre}users` ADD `dqdz` tinyint(1) NOT NULL COMMENT '点球大战';");
		if($sql){         
			echo 'users 数据表 增加 字段 成功...<br>';
		}else{
			echo 'users 数据表 增加 字段 失败...<br>';
		}
	}else{
		echo 'users 表字段已存在 增加 字段 失败...,请自行比对处理...<br>';	
	}
}

if(existTable("{$dbpre}yuyue_order")){
	if(!pdo_fieldexists("{$dbpre}yuyue_order","or_date1")){
		$sql=mysql_query("ALTER TABLE `{$dbpre}yuyue_order` ADD `or_date1` DATE NULL ;");
		if($sql){
			echo 'yuyue_order 数据表 增加 字段 成功...<br>';
		}else{
			echo 'yuyue_order 数据表 增加 字段 失败...<br>';
		}
	}else{
		echo 'yuyue_order 表字段已存在 增加 字段 失败...,请自行比对处理...<br>';	
	}
}
if(existTable("{$dbpre}yuyue_order")){
	if(!pdo_fieldexists("{$dbpre}yuyue_order","time1")){
		$sql=mysql_query("ALTER TABLE `{$dbpre}yuyue_order`  ADD `time1` VARCHAR(50) NULL;");
		if($sql){
			echo 'yuyue_order 数据表 增加 字段 成功...<br>';
		}else{
			echo 'yuyue_order 数据表 增加 字段 失败...<br>';
		}
	}else{
		echo 'yuyue_order 表字段已存在 增加 字段 失败...,请自行比对处理...<br>';	
	}
}
if(existTable("{$dbpre}yuyue")){
	if(!pdo_fieldexists("{$dbpre}yuyue","payonline")){
		$sql=mysql_query("ALTER TABLE `{$dbpre}yuyue` ADD `payonline` TINYINT(1) NULL DEFAULT '0';");
		if($sql){         
			echo 'yuyue 数据表 增加 字段 成功...<br>';
		}else{
			echo 'yuyue 数据表 增加 字段 失败...<br>';
		}
	}else{
		echo 'yuyue 表字段已存在...,请自行比对处理...<br>';	
	}
}
if(existTable("{$dbpre}yuyue_order")){
	if(!pdo_fieldexists("{$dbpre}yuyue_order","paymode")){
		$sql=mysql_query("ALTER TABLE `{$dbpre}yuyue_order` ADD `paymode` TINYINT(1) NULL DEFAULT '0';");
		if($sql){         
			echo 'yuyue_order 数据表 增加 字段 成功...<br>';
		}else{
			echo 'yuyue_order 数据表 增加 字段 失败...<br>';
		}
	}else{
		echo 'yuyue_order 表字段已存在...,请自行比对处理...<br>';	
	}
}
if(existTable("{$dbpre}yuyue_order")){
	if(!pdo_fieldexists("{$dbpre}yuyue_order","orderid")){
		$sql=mysql_query("ALTER TABLE `{$dbpre}yuyue_order` ADD `orderid` VARCHAR(40) NOT NULL;");
		if($sql){         
			echo 'yuyue_order 数据表 增加 字段 成功...<br>';
		}else{
			echo 'yuyue_order 数据表 增加 字段 失败...<br>';
		}
	}else{
		echo 'yuyue_order 表字段已存在...,请自行比对处理...<br>';	
	}
}
if(existTable("{$dbpre}yuyue_order")){
	if(!pdo_fieldexists("{$dbpre}yuyue_order","paid")){
		$sql=mysql_query("ALTER TABLE `{$dbpre}yuyue_order` ADD `paid` TINYINT(1) NULL DEFAULT '0' ;");
		if($sql){         
			echo 'yuyue_order 数据表 增加 字段 成功...<br>';
		}else{
			echo 'yuyue_order 数据表 增加 字段 失败...<br>';
		}
	}else{
		echo 'yuyue_order 表字段已存在...,请自行比对处理...<br>';	
	}
}
if(existTable("{$dbpre}yuyue_order")){
	if(!pdo_fieldexists("{$dbpre}yuyue_order","paytype")){
		$sql=mysql_query("ALTER TABLE `{$dbpre}yuyue_order` ADD `paytype` VARCHAR(10) NOT NULL;");
		if($sql){         
			echo 'yuyue_order 数据表 增加 字段 成功...<br>';
		}else{
			echo 'yuyue_order 数据表 增加 字段 失败...<br>';
		}
	}else{
		echo 'yuyue_order 表字段已存在...,请自行比对处理...<br>';	
	}
}
if(existTable("{$dbpre}yuyue_order")){
	if(!pdo_fieldexists("{$dbpre}yuyue_order","transaction_id")){
		$sql=mysql_query("ALTER TABLE `{$dbpre}yuyue_order` ADD `transaction_id` VARCHAR(100) NOT NULL;");
		if($sql){         
			echo 'yuyue_order 数据表 增加 字段 成功...<br>';
		}else{
			echo 'yuyue_order 数据表 增加 字段 失败...<br>';
		}
	}else{
		echo 'yuyue_order 表字段已存在...,请自行比对处理...<br>';	
	}
}
if(existTable("{$dbpre}estate_saler")){
	if(!pdo_fieldexists("{$dbpre}estate_saler","sms_status")){
		$sql=mysql_query("ALTER TABLE `{$dbpre}estate_saler` ADD `sms_status` TINYINT(1) NOT NULL;");
		if($sql){         
			echo 'estate_saler 数据表 增加 字段 成功...<br>';
		}else{
			echo 'estate_saler 数据表 增加 字段 失败...<br>';
		}
	}else{
		echo 'estate_saler 表字段已存在...,请自行比对处理...<br>';	
	}
}


if(existTable("{$dbpre}yuyue")){
	if(!pdo_fieldexists("{$dbpre}yuyue","deviceNo2")){
		$sql=mysql_query("ALTER TABLE `{$dbpre}yuyue` ADD `deviceNo2` varchar(20) DEFAULT NULL;");
		if($sql){
			echo 'yuyue 数据表 增加 字段 成功...<br>';
		}else{
			echo 'yuyue 数据表 增加 字段 失败...<br>';
		}
	}else{
		echo 'yuyue 表字段已存在...,请自行比对处理...<br>';	
	}
}
if(existTable("{$dbpre}yuyue")){
	if(!pdo_fieldexists("{$dbpre}yuyue","deviceNo1")){
		$sql=mysql_query("ALTER TABLE `{$dbpre}yuyue` ADD `deviceNo1` varchar(20) DEFAULT NULL;");
		if($sql){
			echo 'yuyue 数据表 增加 字段 成功...<br>';
		}else{
			echo 'yuyue 数据表 增加 字段 失败...<br>';
		}
	}else{
		echo 'yuyue 表字段已存在...,请自行比对处理...<br>';	
	}
}
if(existTable("{$dbpre}yuyue")){
	if(!pdo_fieldexists("{$dbpre}yuyue","print_status")){
		$sql=mysql_query("ALTER TABLE `{$dbpre}yuyue` ADD `print_status` int(1) NOT NULL;");
		if($sql){
			echo 'yuyue 数据表 增加 字段 成功...<br>';
		}else{
			echo 'yuyue 数据表 增加 字段 失败...<br>';
		}
	}else{
		echo 'yuyue 表字段已存在...,请自行比对处理...<br>';	
	}
}
if(existTable("{$dbpre}yuyue")){
	if(!pdo_fieldexists("{$dbpre}yuyue","pringNum")){
		$sql=mysql_query("ALTER TABLE `{$dbpre}yuyue` ADD `pringNum` int(1) NOT NULL;");
		if($sql){
			echo 'yuyue 数据表 增加 字段 成功...<br>';
		}else{
			echo 'yuyue 数据表 增加 字段 失败...<br>';
		}
	}else{
		echo 'yuyue 表字段已存在...,请自行比对处理...<br>';	
	}
}
if(existTable("{$dbpre}yuyue")){
	if(!pdo_fieldexists("{$dbpre}yuyue","feiyin_key")){
		$sql=mysql_query("ALTER TABLE `{$dbpre}yuyue` ADD `feiyin_key` varchar(32) NOT NULL;");
		if($sql){
			echo 'yuyue 数据表 增加 字段 成功...<br>';
		}else{
			echo 'yuyue 数据表 增加 字段 失败...<br>';
		}
	}else{
		echo 'yuyue 表字段已存在...,请自行比对处理...<br>';	
	}
}
if(existTable("{$dbpre}yuyue")){
	if(!pdo_fieldexists("{$dbpre}yuyue","memberCode")){
		$sql=mysql_query("ALTER TABLE `{$dbpre}yuyue` ADD `memberCode` varchar(32) NOT NULL;");
		if($sql){
			echo 'yuyue 数据表 增加 字段 成功...<br>';
		}else{
			echo 'yuyue 数据表 增加 字段 失败...<br>';
		}
	}else{
		echo 'yuyue 表字段已存在...,请自行比对处理...<br>';	
	}
}
if(existTable("{$dbpre}yuyue")){
	if(!pdo_fieldexists("{$dbpre}yuyue","bwdeviceNo")){
		$sql=mysql_query("ALTER TABLE `{$dbpre}yuyue` ADD `bwdeviceNo` varchar(20) NOT NULL;");
		if($sql){
			echo 'yuyue 数据表 增加 字段 成功...<br>';
		}else{
			echo 'yuyue 数据表 增加 字段 失败...<br>';
		}
	}else{
		echo 'yuyue 表字段已存在...,请自行比对处理...<br>';	
	}
}
if(existTable("{$dbpre}yuyue")){
	if(!pdo_fieldexists("{$dbpre}yuyue","deviceNo")){
		$sql=mysql_query("ALTER TABLE `{$dbpre}yuyue` ADD `deviceNo` varchar(20) NOT NULL;");
		if($sql){
			echo 'yuyue 数据表 增加 字段 成功...<br>';
		}else{
			echo 'yuyue 数据表 增加 字段 失败...<br>';
		}
	}else{
		echo 'yuyue 表字段已存在...,请自行比对处理...<br>';	
	}
}
if(existTable("{$dbpre}yuyue")){
	if(!pdo_fieldexists("{$dbpre}yuyue","printpage")){
		$sql=mysql_query("ALTER TABLE `{$dbpre}yuyue` ADD `printpage` int(2) NOT NULL;");
		if($sql){
			echo 'yuyue 数据表 增加 字段 成功...<br>';
		}else{
			echo 'yuyue 数据表 增加 字段 失败...<br>';
		}
	}else{
		echo 'yuyue 表字段已存在...,请自行比对处理...<br>';	
	}
}
if(existTable("{$dbpre}yuyue")){
	if(!pdo_fieldexists("{$dbpre}yuyue","printtype")){
		$sql=mysql_query("ALTER TABLE `{$dbpre}yuyue` ADD `printtype` varchar(10) NOT NULL;");
		if($sql){
			echo 'yuyue 数据表 增加 字段 成功...<br>';
		}else{
			echo 'yuyue 数据表 增加 字段 失败...<br>';
		}
	}else{
		echo 'yuyue 表字段已存在...,请自行比对处理...<br>';	
	}
}
if(existTable("{$dbpre}yuyue")){
	if(!pdo_fieldexists("{$dbpre}yuyue","email_status")){
		$sql=mysql_query("ALTER TABLE `{$dbpre}yuyue` ADD `email_status` int(1) NOT NULL;");
		if($sql){
			echo 'yuyue 数据表 增加 字段 成功...<br>';
		}else{
			echo 'yuyue 数据表 增加 字段 失败...<br>';
		}
	}else{
		echo 'yuyue 表字段已存在...,请自行比对处理...<br>';	
	}
}
if(existTable("{$dbpre}yuyue")){
	if(!pdo_fieldexists("{$dbpre}yuyue","email")){
		$sql=mysql_query("ALTER TABLE `{$dbpre}yuyue` ADD  `email` varchar(20) NOT NULL;");
		if($sql){
			echo 'yuyue 数据表 增加 字段 成功...<br>';
		}else{
			echo 'yuyue 数据表 增加 字段 失败...<br>';
		}
	}else{
		echo 'yuyue 表字段已存在...,请自行比对处理...<br>';	
	}
}
if(existTable("{$dbpre}yuyue")){
	if(!pdo_fieldexists("{$dbpre}yuyue","tel_status")){
		$sql=mysql_query("ALTER TABLE `{$dbpre}yuyue` ADD `tel_status` INT(1) NOT NULL ;");
		if($sql){
			echo 'yuyue 数据表 增加 字段 成功...<br>';
		}else{
			echo 'yuyue 数据表 增加 字段 失败...<br>';
		}
	}else{
		echo 'yuyue 表字段已存在...,请自行比对处理...<br>';	
	}
}
if(existTable("{$dbpre}yuyue")){
	if(!pdo_fieldexists("{$dbpre}yuyue","tel")){
		$sql=mysql_query("ALTER TABLE `{$dbpre}yuyue` ADD `tel` VARCHAR(20) NOT NULL;");
		if($sql){
			echo 'yuyue 数据表 增加 字段 成功...<br>';
		}else{
			echo 'yuyue 数据表 增加 字段 失败...<br>';
		}
	}else{
		echo 'yuyue 表字段已存在...,请自行比对处理...<br>';	
	}
}
if(existTable("{$dbpre}yuyue_order")){
	if(!pdo_fieldexists("{$dbpre}yuyue_order","printed")){
		$sql=mysql_query("ALTER TABLE `{$dbpre}yuyue_order` ADD `printed` INT(1) NOT NULL DEFAULT '0' ;");
		if($sql){         
			echo 'yuyue_order 数据表 增加 字段 成功...<br>';
		}else{
			echo 'yuyue_order 数据表 增加 字段 失败...<br>';
		}
	}else{
		echo 'yuyue_order 表字段已存在...,请自行比对处理...<br>';	
	}
}





echo "<br>执行更新结束！";

function _get_sql($sql_file) {
	$contents = file_get_contents($sql_file);
	$contents = str_replace("\r\n", "\n", $contents);
	$contents = trim(str_replace("\r", "\n", $contents));
	$return_items = $items = array();
	$items = explode(";\n", $contents);

	foreach ($items as $item) {
		$return_item = '';
		$item = trim($item);
		$lines = explode("\n", $item);
		foreach ($lines as $line) {
			if (isset($line[1]) && $line[0] . $line[1] == '--') {
				continue;
			}
			$return_item .= $line;
		}
		if ($return_item) {
			$return_items[] = $return_item; //.";";
		}
	}
	return $return_items;
}

//验证数据字段
function pdo_fieldexists($tablename, $fieldname = '') {
	$isexists = mysql_query("DESCRIBE ".$tablename." `".$fieldname."`");
	$isexists = mysql_fetch_array($isexists);
	return !empty($isexists) ? true : false;
}
//判断属性值是否存在
function db_fieldvalue($tablename, $fieldname = '',$value='') {
	$isexists = mysql_query("select count(*) from ".$tablename." where ".$fieldname." = '".$value."'");
	return !empty($isexists) ? true : false;
}
//检测表是否存在
function existTable($table){
	return mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$table."'"))?true:false;
}
?>	