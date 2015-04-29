<?php
include ('lib/database.php');
include('hahapi.php');

function myjobs($uname){
	$mysql = $GLOBALS['mysql'];
	$field_array = array( 'DateApplied','JobTitle','CName','JCity','StateID');
	$uname = '"'.$uname.'"';
	//standard DB connection
	if (isset($mysql)) {
		//structure the query based on defined variables
		
		/*
		 * NOTE!! job.JobID is necessary as an ambiguity error is triggered
		 * since there is a JobID column in both tables (I think this is the reason)
		 */
		$query = "SELECT DateApplied, JobTitle,CName,JCity,StateID,job.JobID FROM applies INNER JOIN job on applies.JobID=job.JobID WHERE UName = $uname";
		$result = $mysql->query($query);
		if (!$result) {
    		throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
		}
		print $result->num_rows." results found...";
		//we define the table header
		echo "<table class='table' cellpadding='7' style='border: 1px solid black; border-collapse:collapse;'>
        <thead style='background-color:black; color: white; font-weight:bold; text-align:left;'>
        <tr>
        <th>Application Date</th>
        <th>Job Title</th>
        <th>Company Name</th>
        <th>City</th>
        <th>State</th>
        </tr>
        </thead>
        <tbody>";
		//makes the remaining table body from the query results and categorizes by the field names
		makeJobTable($result, $field_array);
		echo "</tbody></table>";
	}
	else {
		print "ERROR: Database NOT Found ";
	}
}

function myresumes($uname){
	$uname = '"'.$uname.'"';
	$mysql = $GLOBALS['mysql'];
	$field_array = array( 'ResumeID');
	//standard DB connection
	if (isset($mysql)) {
		//structure the query based on defined variables
		$query = "SELECT ResumeID FROM resume INNER JOIN user on resume.UName=user.UName WHERE user.UName = $uname";
		$result = $mysql->query($query);
		if (!$result) {
    		throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
		}
		print $result->num_rows." results found...";
		//we define the table header
		echo "<table class='table' cellpadding='7' style='border: 1px solid black; border-collapse:collapse;'>
        <thead style='background-color:black; color: white; font-weight:bold; text-align:left;'>
        <tr><th>Resume</th></tr>
        </thead>
        <tbody>";
		//makes the remaining table body from the query results and categorizes by the field names
		makeResumeTable($result, $field_array);
		echo "</tbody></table>";
	}
	else {
		print "ERROR: Database NOT Found ";
	}
}


function myposts($uname){
	$mysql = $GLOBALS['mysql'];
	$field_array = array( 'JListDate','JobTitle','CName','JCity','StateID');
	$uname = '"'.$uname.'"';
	//standard DB connection
	if (isset($mysql)) {
		//structure the query based on defined variables
		
		/*
		 * NOTE!! job.JobID is necessary as an ambiguity error is triggered
		 * since there is a JobID column in both tables (I think this is the reason)
		 */
		$query = "SELECT JListDate,JobTitle,CName,JCity,StateID, job.JobID FROM job INNER JOIN postandpay on job.JobID=postandpay.JobID WHERE postandpay.UName = $uname";
		// the simplest connection b/t poster and job is through postandpay
		$result = $mysql->query($query);
		if (!$result) {
    		throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
		}
		print $result->num_rows." results found...";
		//we define the table header
		echo "<table class='table' cellpadding='7' style='border: 1px solid black; border-collapse:collapse;'>
        <thead style='background-color:black; color: white; font-weight:bold; text-align:left;'>
        <tr>
        <th>Date Listed</th>
        <th>Job Title</th>
        <th>Company Name</th>
        <th>City</th>
        <th>State</th>
        </tr>
        </thead>
        <tbody>";
		//makes the remaining table body from the query results and categorizes by the field names
		makePostedJobsTable($result, $field_array);
		echo "</tbody></table>";
	}
	else {
		print "ERROR: Database NOT Found ";
	}
}
?>