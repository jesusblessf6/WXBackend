<?php
header("Content-type: text/html; charset=utf-8");

$arr = require("../data/Conf/db.php");
$dbpre=$arr['DB_PREFIX'];
$conn =mysql_connect($arr['DB_HOST'],$arr['DB_USER'],$arr['DB_PWD']) or die("连接数据库失败!");
mysql_select_db($arr['DB_NAME'],$conn);
mysql_query("set names utf8");

echo '更新开始...<br>';


echo '创建数据表开始...<br>';
$sqlfile = 'update.sql';
$sqls = _get_sql($sqlfile);
foreach ($sqls as $sql) {
	//替换前缀
	$sql = str_replace('`wy_', '`' . $dbpre, $sql);
	$run = mysql_query($sql, $conn);
	//获得表名
	if (substr($sql, 0, 12) == 'CREATE TABLE') {
		$table_name = $dbpre . preg_replace("/CREATE TABLE IF NOT EXISTS `" . $dbpre . "([a-z0-9_]+)` .*/is", "\\1", $sql);
		echo $table_name.'创建成功...<br>';
	}
	if (substr($sql, 0, 11) == 'INSERT INTO') {
		$table_name = $dbpre . preg_replace("/INSERT INTO `" . $dbpre . "([a-z0-9_]+)` .*/is", "\\1", $sql);
		echo $table_name.'创建成功...<br>';
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