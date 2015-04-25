<?php
	include ('lib/database.php');//for the global
	include('header.php');
	include ('hahapi.php');
	$mysql = $GLOBALS['mysql'];
	$uname = '"'.$_SESSION['user'].'"';
	//http://www.w3schools.com/php/php_mysql_update.asp [modified some concepts]
	if (!$mysql) {
    die("Connection failed: " . mysqli_connect_error());
	}
	
	$UStreet2 = $_POST['UStreet2'];
	
	$query = "UPDATE user SET UStreet2 = '$UStreet2'". " WHERE Uname = $uname";

	if (mysqli_query($mysql, $query)) {
    echo "Our records have been updated. Thank you.";
	}
	else {
    echo "Error updating record: " . mysqli_error($mysql);
	}

?>
