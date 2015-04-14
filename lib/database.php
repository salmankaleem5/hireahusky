<?php
global $mysql;
if( isset($mysql) ){
	return; //don't need to redefine if its already set
}

$mysql = new mysqli('localhost','root','','team3');
if ($mysql->connect_errno) {
    die(sprintf("Failed to connect to MySQL: (%s) %s",$mysql->connect_errno, $mysql->connect_error));
}

?>