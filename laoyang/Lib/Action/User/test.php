<?php
//header("Content-Type: text/html; charset=utf-8");
require_once('nusoap.php');
$client = new SoapClient("http://140.206.95.61:8069/admin/services/mobileClient?wsdl");
$client->soap_defencoding = 'utf-8';   
$client->decode_utf8 = false;   
$client->xml_encoding = 'utf-8';

/*
echo "<pre>";
var_dump($client->__getFunctions());
echo "</pre>";
*/

$param = array('orgId'=>"42");
$result = $client->Call('getClientInfoByorgId',array('paramters'=>$param));
echo $client->debug_str;
echo "<pre>";
print_r($result);
echo "</pre>";

?>