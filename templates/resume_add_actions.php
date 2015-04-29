<?php
	include ('lib/database.php');//for the global
	include('header.php');
	include ('hahapi.php');
	$mysql = $GLOBALS['mysql'];
	$uname = '"'.$_SESSION['user'].'"';//friendly ver for queries
	if (!$mysql) {
    	die("Connection failed: " . mysqli_connect_error());
	}
	//generates a new Resume ID
	$ResID_query = "SELECT max(last_insert_id(EducationID)) AS answer FROM `education`";
	$ResID_result = $mysql->query($ResID_query);
	$ResID_field = $ResID_result->fetch_assoc();
	$ResID = $ResID_field['answer'];
	$ResumeID = $ResID+1;
	//generates a new education ID
	$lastID_query = "SELECT max(last_insert_id(EducationID)) AS answer FROM `education`";
	$lastID_result = $mysql->query($lastID_query);
	$lastID_field = $lastID_result->fetch_assoc();
	$lastID = $lastID_field['answer'];
	$EduID = $lastID+1;
	//updates Eudcation Profile 1
	$university = $_POST['University'];
	$egpa = $_POST['EGPA'];
	$estart = $_POST['EstartDate'];
	$egrad = $_POST['EGradDate'];
	$degtype = $_POST['DegreeType'];
	$degarea = $_POST['DegreeArea'];
	
	//resumeID is left NULL. It is defined when a resume is made.
	$edu1_insert = "INSERT INTO education (EducationID, EUniversityID, EGPA, EstartDate,EGradDate,DegreeTypeID, DegreeAreaID) 
	VALUES ('$EduID','$university','$egpa','$estart','$egrad','$degtype','$degarea')";
	//updates Eudcation Profile 2
	$EduID2 = $lastID+2;
	
	$university2 = $_POST['University2'];
	$egpa2 = $_POST['EGPA2'];
	$estart2 = $_POST['EstartDate2'];
	$egrad2 = $_POST['EGradDate2'];
	$degtype2 = $_POST['DegreeType2'];
	$degarea2 = $_POST['DegreeArea2'];
	
	//resumeID is left NULL. It is defined when a resume is made.
	$edu2_insert = "INSERT INTO education (EducationID, EUniversityID, EGPA, EstartDate,EGradDate,DegreeTypeID, DegreeAreaID) 
	VALUES ('$EduID2','$university2','$egpa2','$estart2','$egrad2','$degtype2','$degarea2')";
	
					
	
	if (!mysqli_query($mysql, $edu1_insert)) {
	    echo "Error updating Education Profile 1" . mysqli_error($mysql);
	}
	if (!mysqli_query($mysql, $edu2_insert)) {
	    echo "Error updating Education Profile 2" . mysqli_error($mysql);
	}
	echo "Our records have been updated. Thank you.";
	
?>
