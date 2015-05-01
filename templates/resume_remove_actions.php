<?php
	include ('lib/database.php');//for the global
	include('header.php');
	include ('hahapi.php');
	$mysql = $GLOBALS['mysql'];
	$uname = '"'.$_SESSION['user'].'"';//friendly ver for queries
	$resumeID=$_POST['resumeID'];
	
	//generates the needed queries

	//removes a resume row from the Database-----------------------------------
	
	$res_remove = "DELETE FROM resume WHERE resumeid=$resumeID";
	
	if (!mysqli_query($mysql, $res_remove)) {
	    echo "Error removing resume row" . mysqli_error($mysql);
	}
	
	//removes all associated education rows from the Database-----------------------------------
	
	
	$edu_remove = "DELETE FROM education WHERE resumeid=$resumeID";
	if (!mysqli_query($mysql, $edu_remove)) {
	    echo "Error removing education profile row(s)" . mysqli_error($mysql);
	}
	
	//removes all associated priorjob rows from the Database-----------------------------------
	
	$pj_remove = "DELETE FROM priorjobs WHERE resumeid=$resumeID";
	if (!mysqli_query($mysql, $pj_remove)) {
	    echo "Error removing prior job row(s)" . mysqli_error($mysql);
	}
	//removes all associated skillset rows from the Database-----------------------------------
	
	
	$skill_remove = "DELETE FROM skillset WHERE resumeid=$resumeID";
	
	
	if (!mysqli_query($mysql, $skill_remove)) {
	    echo "Error removing skill row(s)" . mysqli_error($mysql);
	}
	// end removals
	
	echo "Your resume has been removed.";
?>
