<?PHP
	include ('lib/database.php');//for the global
	include('header.php');
	include ('hahapi.php');
	
	$fields = array( 'UName','DateApplied');	
	if( !empty($id) ){
		$jobid = $id;
	}
	if (isset($mysql)) {
		//structure the query based on defined variables
		if(isset($jobid)){
			$suffix = " WHERE JobID="."$jobid";
			$query = "SELECT UName, DateApplied FROM applies".$suffix;
			$result = $mysql->query($query);
			if (!$result) {
    			throw new Exception("Database Error [{$this->database->errno}] {$this->database->error}");
			}
		    if( isset($_SESSION['user']) ){
		    	$user = $_SESSION['user'];
				addResume($user, $jobid);
		    }
		}
		else{
			print $jobid." is not a valid Job ID.";
		}		
	}
	else {
		print "ERROR: Database NOT Found ";
	}
	
function addResume($uname, $jobid){
	$uname = '"'.$uname.'"';//adds quotes to variable $uname
	$mysql = $GLOBALS['mysql'];//needs to be here to work for some reason
	if (isset($mysql)) {
	//need to add prior jobs stuff
	 $_POST['$JobID'] = $jobid;
	
	echo "<form action='edit_job_actions' method ='POST'><fieldset>";

	echo "<br><b><u>Job Title</u></b><br>";
	echo "<br>Title: <input type='text' name='JobTitle'><br>
	<br>Salary Low Range: <input type='text' name='JLowRange'><br><br>
	<br>Salary High Range: <input type='text' name='JHighRange'><br><br>";

	//Experience Req.
	echo "<b><u>Required Experience</u></b><br>";
	echo 
	"<br><br>Years of Experience: <input type='text' name='JYRSExperience'><br>
	";
	
	//Location
	echo "<br><b><u>Location</u></b><br>";
	echo "<br>Company Name: <input type='text' name='CName'><br>
	<br>Zipcode: <input type='text' name='Zipcode'><br>
	<br>City: <input type='text' name='JCity'><br>";
	$state_query= "SELECT StateID,StateName FROM state";
	$state_result = $mysql->query($state_query);
	if (!$state_result) {
    	throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
	}
	echo "<br>State* <select select name='StateID'><option selected='selected' value='0'>Select...</option>";
	while ( $row = $state_result->fetch_assoc() ) {
    		$key=$row['StateName'];
    		$value=$row['StateID'];
			echo "<option value = $value> $key </option>";
			}
	echo"</select>";
	
	//Job Description
	echo "<br><b><u>Job Description</u></b><br>";
	echo "<br>Duties: <input type='text' name='JDuties'><br>";

	
	//end the form
	echo '<br><br><button type="submit" class="btn btn-primary btn-sm">Submit</button>';
	echo "</fieldset></form>";
	}
}
?>	