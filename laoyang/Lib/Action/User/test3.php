<?
/******************************************************************************/
/*  �ļ��� : soapclient.php
/*  ˵  �� : WebService�ӿڿͻ�������
/******************************************************************************/
include('nusoap.php');
// ����һ��soapclient���󣬲�����server��WSDL 
$client = new soapclient('http://140.206.95.61:8069/admin/services/mobileClient?wsdl', 'wsdl');
$client->soap_defencoding = 'utf-8';   
$client->decode_utf8 = false;   
$client->xml_encoding = 'utf-8';
// ����תΪ������ʽ����
$aryPara = array('orgId'=>'42');
// ����Զ�̺���
$aryResult = $client->call('getClientInfoByorgId',$aryPara);
echo $client->debug_str;

if (!$err=$client->getError()) {
  print_r($aryResult); 
} else { 
  print "ERROR: $err"; 
}

/* $document=$client->document;
echo <<<SoapDocument
<?xml version="1.0" encoding="GB2312"?>
 <SOAP-ENV:Envelope SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" xmlns:si="http://soapinterop.org/xsd">
   <SOAP-ENV:Body>
   $document
   </SOAP-ENV:Body>
 </SOAP-ENV:Envelope>
SoapDocument; */
?>