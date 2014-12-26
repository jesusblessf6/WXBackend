<?php
/**
 *项目公共配置
 *@package laoyang
 *@author laoyang
 **/
return array(
	'LOAD_EXT_CONFIG' 		=> 'db,info,email,safe,upfile,cache,route,app,alipay,tenpay,sms,Heartbeat,rippleos_key',		
	'APP_AUTOLOAD_PATH'     =>'@.ORG',
	'OUTPUT_ENCODE'         =>  true, 			
	'PAGE_NUM'				=> 15,
	'COOKIE_PATH'           => '/',     		
    'COOKIE_PREFIX'         => '',      		
	'TMPL_L_DELIM'   		=>'{laoyang:',			
	'TMPL_R_DELIM'			=>'}',				
);
?>