<?php 
  error_reporting(0);
   /* ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);   */ 
session_start(); 
require_once "system/db.php"; 
function getDatabase(){ 
        $HOSTNAME = "localhost";
		$USERNAME = "root";
		$PASSWORD = ""; 	
		$DATABASE = "assignment";
        return  $db = new Database($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);
}
$db = getDatabase(); 

require_once "system/routing.php"; 
require_once "system/ALPDO.php";
require_once "system/global.php"; 
require_once "system/auto_load.php"; 


 ?>