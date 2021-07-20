<?php
function my_autoloader($class_name) {
require_once 'application/modules/'.$class_name.'.php';
}
spl_autoload_register('my_autoloader');



$rest = substr($request_url,0,4); 
$resti = substr($request_url,0,6); 
$modulename = substr($request_url,7,strlen($request_url)); 
if($rest=='AJAX' || $resti=='MODULE'){	 
	if($rest=='AJAX'){
		require_once 'application/ajax/'.$request_url.'.php';
	}ELSE{
		require_once 'application/modules/'.$modulename.'.php';
	}
}else{
	if(in_array($request_url,$login_array))					  {require_once('application/views/login/'.$request_url.'.php');}
	elseif(in_array($request_url,$product_array))		      {require_once('application/views/product/'.$request_url.'.php');}
	else 														  {require_once('application/views/login/file_not_found.php');}
} 
?>