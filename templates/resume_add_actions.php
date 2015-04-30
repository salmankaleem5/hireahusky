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
	$ResID_query = "SELECT max(ResumeID) AS answer FROM `resume`";
	$ResID_result = $mysql->query($ResID_query);
	$ResID_field = $ResID_result->fetch_assoc();
	$ResID = $ResID_field['answer'];
	$ResumeID = $ResID+1;
	//adds a resume to the Database-----------------------------------
	$salarymin = $_POST['salarymin'];
	$objective = $_POST['objective'];
	
	$res_insert = "INSERT INTO resume (ResumeID, RObjective, RSalaryMin,Uname) 
	VALUES ('$ResumeID','$objective','$salarymin',$uname)";
	if (!mysqli_query($mysql, $res_insert)) {
	    echo "Error adding Resume" . mysqli_error($mysql);
	}
	//add prior job 1-----------------------------------
	$pj1_query = "SELECT max(PjobID) AS answer FROM `priorjobs`";
	$pj1_result = $mysql->query($pj1_query);
	$pj1_field = $pj1_result->fetch_assoc();
	$oldpjID = $pj1_field['answer'];
	$pj1ID = $oldpjID+1;	
	$pjcompany1 = $_POST['pjcompany1'];
	$pjtitle1 = $_POST['pjtitle1'];
	$pjduties1 = $_POST['pjduties1'];
	$pjcity1 = $_POST['pjcity1'];
	$pjstate1 = $_POST['pjstate1'];
	$pjstart1 = $_POST['pjstart1'];
	$pjend1 = $_POST['pjend1'];
	$pj1_insert = "INSERT INTO priorjobs (PjobID,PJCompanyName, PJJobTitle, PJDuties, PJCity, StateID, PJStartDate, PJEndDate, ResumeID) 
	VALUES ('$pj1ID','$pjcompany1','$pjtitle1','$pjduties1','$pjcity1','$pjstate1','$pjstart1','$pjend1','$ResumeID')";
	if (!mysqli_query($mysql, $pj1_insert)) {
	    echo "Error updating Prior Job Profile 1" . mysqli_error($mysql);
	}
	//add prior job 2-----------------------------------
	$pj2ID = $oldpjID+2;
	$pjcompany2 = $_POST['pjcompany2'];
	$pjtitle2 = $_POST['pjtitle2'];
	$pjduties2 = $_POST['pjduties2'];
	$pjcity2 = $_POST['pjcity2'];
	$pjstate2 = $_POST['pjstate2'];
	$pjstart2 = $_POST['pjstart2'];
	$pjend2 = $_POST['pjend2'];
	$pj2_insert = "INSERT INTO priorjobs (PjobID,PJCompanyName, PJJobTitle, PJDuties, PJCity, StateID, PJStartDate, PJEndDate, ResumeID) 
	VALUES ('$pj2ID','$pjcompany2','$pjtitle2','$pjduties2','$pjcity2','$pjstate2','$pjstart2','$pjend2','$ResumeID')";
	if (!mysqli_query($mysql, $pj2_insert)) {
	    echo "Error updating Prior Job Profile 2" . mysqli_error($mysql);
	}
	//end pj2--------------------------------------------------------
	//generate a new education ID
	$lastID_query = "SELECT max(EducationID) AS answer FROM `education`";
	$lastID_result = $mysql->query($lastID_query);
	$lastID_field = $lastID_result->fetch_assoc();
	$lastID = $lastID_field['answer'];
	//updates Eudcation Profile 1-------------------------------------
	$EduID = $lastID+1;
	$university = $_POST['University'];
	$egpa = $_POST['EGPA'];
	$estart = $_POST['EstartDate'];
	$egrad = $_POST['EGradDate'];
	$degtype = $_POST['DegreeType'];
	$degarea = $_POST['DegreeArea'];
	$edu1_insert = "INSERT INTO education (EducationID, EUniversityID, EGPA, EstartDate,EGradDate,DegreeTypeID, DegreeAreaID,ResumeID) 
	VALUES ('$EduID','$university','$egpa','$estart','$egrad','$degtype','$degarea',$ResumeID)";
	//updates Eudcation Profile 2-------------------------------------
	$EduID2 = $lastID+2;
	$university2 = $_POST['University2'];
	$egpa2 = $_POST['EGPA2'];
	$estart2 = $_POST['EstartDate2'];
	$egrad2 = $_POST['EGradDate2'];
	$degtype2 = $_POST['DegreeType2'];
	$degarea2 = $_POST['DegreeArea2'];
	$edu2_insert = "INSERT INTO education (EducationID, EUniversityID, EGPA, EstartDate,EGradDate,DegreeTypeID, DegreeAreaID,ResumeID) 
	VALUES ('$EduID2','$university2','$egpa2','$estart2','$egrad2','$degtype2','$degarea2','$ResumeID')";
	if (!mysqli_query($mysql, $edu1_insert)) {
	    echo "Error updating Education Profile 1" . mysqli_error($mysql);
	}
	if (!mysqli_query($mysql, $edu2_insert)) {
	    echo "Error updating Education Profile 2" . mysqli_error($mysql);
	}
	//Skill profile Begin!-------------------------------------
	$skill1 = $_POST['skill1'];
	if($skill1!=0){
		$sk1_insert = "INSERT INTO skillset (ResumeID, SSkillID) VALUES ('$ResumeID','$skill1')";
		if (!mysqli_query($mysql, $sk1_insert)) {
	    echo "Error updating Skill 1" . mysqli_error($mysql);
		}
	}
	$skill2 = $_POST['skill2'];
	if($_POST['skill2']!=0){
		$sk2_insert = "INSERT INTO skillset (ResumeID, SSkillID) VALUES ('$ResumeID','$skill2')";
		if (!mysqli_query($mysql, $sk2_insert)) {
	    echo "Error updating Skill 2" . mysqli_error($mysql);
		}
	}
	$skill3 = $_POST['skill3'];
	if($skill3!=0){
		$sk3_insert = "INSERT INTO skillset (ResumeID, SSkillID) VALUES ('$ResumeID','$skill3')";
		if (!mysqli_query($mysql, $sk3_insert)) {
	    echo "Error updating Skill 3" . mysqli_error($mysql);
		}
	}
	$skill4 = $_POST['skill4'];
	if($skill4!=0){
		$sk4_insert = "INSERT INTO skillset (ResumeID, SSkillID) VALUES ('$ResumeID','$skill4')";
		if (!mysqli_query($mysql, $sk4_insert)) {
	    echo "Error updating Skill 4" . mysqli_error($mysql);
		}
	}
		
	
	echo "Our records have been updated. Thank you.";
	
?>
