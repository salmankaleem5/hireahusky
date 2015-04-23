<?php
include ('lib/database.php');
include('hahapi.php');

function myjobs(){
	$mysql = $GLOBALS['mysql'];
	$field_array = array( 'DateApplied','JobTitle','CName','JCity','StateID');
	//standard DB connection
	if (isset($mysql)) {
		//structure the query based on defined variables
		
		//do the stuff
		$query = "SELECT DateApplied, JobTitle,CName,JCity,StateID FROM applies INNER JOIN job on applies.JobID=job.JobID WHERE UName = 'bfry'";
		$result = $mysql->query($query);
		if (!$result) {
    		throw new Exception("Database Error [{$this->database->errno}] {$this->database->error}");
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
		getTable($result, $field_array);
		echo "</tbody></table>";
	}
	else {
		print "ERROR: Database NOT Found ";
	}
}

function myresume(){
	$mysql = $GLOBALS['mysql'];
	$field_array = array( 'DateApplied','JobTitle','CName','JCity','StateID');
	//standard DB connection
	if (isset($mysql)) {
		//structure the query based on defined variables
		
		//do the stuff
		$query = "SELECT DateApplied, JobTitle,CName,JCity,StateID FROM applies INNER JOIN job on applies.JobID=job.JobID WHERE UName = 'bfry'";
		$result = $mysql->query($query);
		if (!$result) {
    		throw new Exception("Database Error [{$this->database->errno}] {$this->database->error}");
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
		getTable($result, $field_array);
		echo "</tbody></table>";
	}
	else {
		print "ERROR: Database NOT Found ";
	}
}
?>