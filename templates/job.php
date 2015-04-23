<?PHP

	include ('lib/database.php');//for the global
	include('header.php');
	include ('hahapi.php');
	
	$field_array = array( 'JobTitle','CName','JYRSExperience','JCity','StateID','JDuties');
	$name_array = array( 'Job Title','Company Name','Req Experience (years)','City','State','Job Description');
	
	if(array_key_exists('jobid', $_GET)){
		$jobid = $_GET['jobid'];
		//print $jobid;
	}
	
	
	if (isset($mysql)) {
		//print "Database Found!". "<BR>";
		
		//structure the query based on defined variables
		if(isset($jobid)){
			$suffix = " WHERE JobID="."$jobid";
			$query = "SELECT * FROM job".$suffix;
			$result = $mysql->query($query);
			if (!$result) {
    			throw new Exception("Database Error [{$this->database->errno}] {$this->database->error}");
			}
			buildJobTable($result,$field_array,$name_array);
		}
		else{
			print $jobid." is not a valid Job ID.";
			
		}		
		//do the stuff
	}
	
	function buildJobTable($results,$keys,$names){
		
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
		echo '</table>
		<p><a class="btn btn-primary btn-sm" href="#" role="button">Apply Now</a></p>';
	}
	?>