<?php
	include ('lib/database.php');//for the global
	include('header.php');
	include ('hahapi.php');
	$mysql = $GLOBALS['mysql'];
	$uname = '"'.$_SESSION['user'].'"';//friendly ver for queries
	if (!$mysql) {
    	die("Connection failed: " . mysqli_connect_error());
	}
	
	echo "This page is still under construcion.";
	
?>
