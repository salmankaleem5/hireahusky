<?php
	include ('lib/database.php');//for the global
	include('header.php');
	include ('hahapi.php');
	$mysql = $GLOBALS['mysql'];
	$uname = '"'.$_SESSION['user'].'"';//friendly ver for queries
	$applicationID=$_POST['applicationID'];
	
	//generates the needed queries

	//removes a applies row from the Database-----------------------------------
	
	$remove = "DELETE FROM applies WHERE applicationid=$applicationID";
	
	if (!mysqli_query($mysql, $remove)) {
	    echo "Error removing your application, please contact the administrator:" . mysqli_error($mysql);
	}
	
	// end removals
	
	echo "Your application has been withdrawn.";
?>
