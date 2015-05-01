<?php
	include ('lib/database.php');//for the global
	include('header.php');
	include ('hahapi.php');
	$mysql = $GLOBALS['mysql'];
	$uname = '"'.$_SESSION['user'].'"';//friendly ver for queries
	if (!$mysql) {
    	die("Connection failed: " . mysqli_connect_error());
	}

	//adds a resume to the Database-----------------------------------
	$title	 	= $_POST['JobTitle'];
	$city		= $_POST['JCity'];
	$stateID	= $_POST['StateID'];
	$Zipcode 	= $_POST['Zipcode'];
	$exp_yrs	= $_POST['JYRSExperience'];
	$salarymin 	= $_POST['JLowRange'];
	$salarymax  = $_POST['JHighRange'];
	$company  	= $_POST['CName'];
	$duties     = $_POST['JDuties']; // heh
	$jobid		= $_POST['JobID']; // heh
	

	$res_insert = "UPDATE INTO job (JobTitle, JCity,StateID, Zipcode, JDuties, JYRSExperience, JLowRange, JHighRange, CName) 
	VALUES ('$title','$city','$sateID', '$Zipcode', '$duties', '$exp_yrs', '$salaymin', '$salarymax', '$company') WHERE job.JobID = '$jobid'";
	if (!mysqli_query($mysql, $res_insert)) {
	    echo "Error adding Resume" . mysqli_error($mysql);
	}

	echo "Our records have been updated. Thank you.";
	
?>
