<?php
	include ('lib/database.php');//for the global
	include('header.php');
	include ('hahapi.php');
	$mysql = $GLOBALS['mysql'];
	print $_POST['StateID'];
	//$uname = '"' . $_SESSION['user'] . '"';
	$uname = '"'."bfry".'"';
	//http://www.w3schools.com/php/php_mysql_update.asp [modified]
	if (!$mysql) {
    	die("Connection failed: " . mysqli_connect_error());
	}
	
	$UFName = $_POST['UFName'];
	$query = "UPDATE user SET UFName = '$UFName'". " WHERE Uname = $uname";
	if (!mysqli_query($mysql, $query)) {
	    echo "Error updating UFName: " . mysqli_error($mysql);
	}
	
	$ULName = $_POST['ULName'];
	$query = "UPDATE user SET ULName = '$ULName'". " WHERE Uname = $uname";
	if (!mysqli_query($mysql, $query)) {
	    echo "Error updating ULName: " . mysqli_error($mysql);
	}
	
	$UStreet1 = $_POST['UStreet1'];
	$query = "UPDATE user SET UStreet1 = '$UStreet1'". " WHERE Uname = $uname";
	if (!mysqli_query($mysql, $query)) {
	    echo "Error updating UStreet1: " . mysqli_error($mysql);
	}
	$UStreet2 = $_POST['UStreet2'];
	$query = "UPDATE user SET UStreet2 = '$UStreet2'". " WHERE Uname = $uname";
	if (!mysqli_query($mysql, $query)) {
	    echo "Error updating UStreet2: " . mysqli_error($mysql);
	}
	$UCity = $_POST['UCity'];
	$query = "UPDATE user SET UCity = '$UCity'". " WHERE Uname = $uname";
	if (!mysqli_query($mysql, $query)) {
	    echo "Error updating UCity: " . mysqli_error($mysql);
	}
	$StateID = $_POST['StateID'];
	$query = "UPDATE user SET StateID = '$StateID'". " WHERE Uname = $uname";
	if (!mysqli_query($mysql, $query)) {
	    echo "Error updating StateID: " . mysqli_error($mysql);
	}
	
	$Zipcode = $_POST['Zipcode'];
	$query = "UPDATE user SET Zipcode = '$Zipcode'". " WHERE Uname = $uname";
	if (!mysqli_query($mysql, $query)) {
	    echo "Error updating Zipcode: " . mysqli_error($mysql);
	}
	$UEmail = $_POST['UEmail'];
	$query = "UPDATE user SET UEmail = '$UEmail'". " WHERE Uname = $uname";
	if (!mysqli_query($mysql, $query)) {
	    echo "Error updating UEmail: " . mysqli_error($mysql);
	}
	$UPhone = $_POST['UPhone'];
	$query = "UPDATE user SET UPhone = '$UPhone'". " WHERE Uname = $uname";
	if (!mysqli_query($mysql, $query)) {
	    echo "Error updating UPhone: " . mysqli_error($mysql);
	}
	$UCell = $_POST['UCell'];
	$query = "UPDATE user SET UCell = '$UCell'". " WHERE Uname = $uname";
	if (!mysqli_query($mysql, $query)) {
	    echo "Error updating UCell: " . mysqli_error($mysql);
	}
	$UFax = $_POST['UFax'];
	$query = "UPDATE user SET UFax = '$UFax'". " WHERE Uname = $uname";
	if (!mysqli_query($mysql, $query)) {
	    echo "Error updating UFax: " . mysqli_error($mysql);
	}
	$UHomePage = $_POST['UHomePage'];
	$query = "UPDATE user SET UHomePage = '$UHomePage'". " WHERE Uname = $uname";
	if (!mysqli_query($mysql, $query)) {
	    echo "Error updating UHomePage: " . mysqli_error($mysql);
	}
	echo "Our records have been updated. Thank you.";
	/*
	if (mysqli_query($mysql, $query)) {
    echo "Our records have been updated. Thank you.";
	}
	else {
    echo "Error updating record: " . mysqli_error($mysql);
	}
	*/
?>
