<?PHP
	include ('lib/database.php');//for the global
	include('header.php');
	include ('hahapi.php');
	
	$field_array = array( 'JobTitle','CName','JYRSExperience','JCity','StateID','JDuties');
	$name_array = array( 'Job Title','Company Name','Req Experience (years)','City','State','Job Description');
	
	if( !empty($id) ){
		$jobid = $id;
	}
	if (isset($mysql)) {
		//structure the query based on defined variables
		if(isset($jobid)){
			$suffix = " WHERE JobID="."$jobid";
			$query = "SELECT * FROM job".$suffix;
			$result = $mysql->query($query);
			if (!$result) {
    			throw new Exception("Database Error [{$this->database->errno}] {$this->database->error}");
			}
			buildJobTable($result,$field_array,$name_array, $jobid);
		}
		else{
			print $jobid." is not a valid Job ID.";
		}		
	}
	else {
		print "ERROR: Database NOT Found ";
	}
	
	function buildJobTable($results,$keys,$names, $jobid){
		
		echo "<table class='table' cellpadding='7' style='width: 200px border: 1px solid black; border-collapse:collapse;'>
        ";
		//makes the remaining table body from the query results and categorizes by the field names
		$dbField = $results->fetch_assoc();
		for ($i = 0; $i < count($keys); $i++) {
			echo "<tr>";
			echo '<td style="width: 200px"><b>'.$names[$i].':</b></td>';
			echo '<td>'.$dbField[$keys[$i]].'</td>';
			echo "</tr>";
    	}
    	echo "<tr><td></td><td></tr>";//padding for last line to show up
		//echo "</table><p><a class='btn btn-primary btn-sm' href='http://localhost/hireahusky/apply/$jobid' role='button'>Apply Now</a></p>";
		// check if the user is the poster of this job and present the following buttons. 
		// use the authenticatePoster(username, jobid) function in the index.php
		$username = $_SESSION['user'];
		$mysql = $GLOBALS['mysql'];
		$usertype = "SELECT UStatusID FROM user WHERE UName='$username' ";
		if( $result = $mysql->query($usertype) ){
			$dbresult = $result->fetch_assoc();
			$UStatusID = $dbresult['UStatusID'];
			if($UStatusID!=1){
				echo "</table><p><a class='btn btn-primary btn-sm' href='http://localhost/hireahusky/apply/$jobid' role='button'>Apply Now</a></p>";
	
			}
		}
			
		if( isset($_SESSION['user']) ){
    		$username = $_SESSION['user'];
			if (authenticatePoster($username, $jobid)) {
				//echo "$jobid";
				echo "</table>
				<p><a class='btn btn-primary btn-sm' href='http://localhost/hireahusky/edit_posting/$jobid' role='button'>Edit Details</a></p>
				<p><a class='btn btn-primary btn-sm' href='#' role='button'>Mark Position as Filled</a></p>
				<p><a class='btn btn-primary btn-sm' href='#' role='button'>Remove This Post</a></p>";
			}
			
    	}
	}
	?>