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
			echo "<table class='table' cellpadding='7' style='border: 1px solid black; border-collapse:collapse;'>
			<thead style='background-color:black; color: white; font-weight:bold; text-align:left;'>
			<tr>
			<th>User Name</th>
			<th>Date Applied</th>
			</tr>
			</thead>
			<tbody>";
			buildApplicantsTable($result,$fields);
			echo "</tbody></thead>";
		}
		else{
			print $jobid." is not a valid Job ID.";
		}		
	}
	else {
		print "ERROR: Database NOT Found ";
	}
	
	function buildApplicantsTable($result,$fields){
		
		echo "<table class='table' cellpadding='7' style='width: 200px border: 1px solid black; border-collapse:collapse;'>
        ";
		//makes the remaining table body from the query results and categorizes by the field names
		echo "<tr>";
		$numApplicants = $result->num_rows;
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			for ($i = 0; $i < count($fields); $i++) {
				echo '<td>'.$row[$fields[$i]].'</td>';	
			}
			echo "</tr>";
		}
	}
	?>