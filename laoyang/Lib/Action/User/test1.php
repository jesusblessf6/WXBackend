<?php
require_once('nusoap.php');
header('Content-type: text/html; charset=utf-8');
$wsdl = "http://140.206.95.61:8069/admin/services/mobileClient?wsdl";
$client->soap_defencoding = 'utf-8';   
$client->decode_utf8 = false;   
$client->xml_encoding = 'utf-8';
$client = new SoapClient($wsdl);
$param = array('orgId' =>'42');
$result = $client->call('getClientInfoByorgId',array('paramters'=>$param));
echo "<pre>";
print_r($result);
echo "</pre>";
?>