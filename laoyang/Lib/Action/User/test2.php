<?php
require_once('nusoap.php');
$client = new soapclient('http://140.206.95.61:8069/admin/services/mobileClient?wsdl',array('uri'=>'http://140.206.95.61:8069/admin/services/mobileClient'));
$client->soap_defencoding = 'utf-8';   
$client->decode_utf8 = false;   
$client->xml_encoding = 'utf-8';
$err = $client->getError();
if ($err) {
 echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
}
// Doc/lit parameters get wrapped
$param = array('orgId' => '42');
$result = $client->call('getClientInfoByorgId', array('parameters' => $param), '', '', false, true,'document','encoded');
// Check for a fault
if ($client->fault) {
 echo '<h2>Fault</h2><pre>';
 print_r($result);
 echo '</pre>';
} else {
 // Check for errors
 $err = $client->getError();
 if ($err) {
  // Display the error
  echo '<h2>Error</h2><pre>' . $err . '</pre>';
 } else {
  // Display the result
  echo '<h2>Result</h2><pre>';
  print_r($result);
  echo '</pre>';
 }
 }
echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
?>