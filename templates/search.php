<?PHP
	include ('lib/database.php');//for the global
	include('header.php');
	include ('hahapi.php');

	/*if(array_key_exists('title', $_GET)){
		$title = $_GET['title'];
		//print $title;
	}
	if(array_key_exists('location', $_GET)){
		$location = $_GET['location'];
		//print $location;
	}*/

	if( !empty($jobTitle) ){
		$title = $jobTitle;
	}
	if( !empty($jobLocation) ){
		$location = $jobLocation;
	}
	
	//here I define the names of the fields I am selecting (in the query)
	$field_array = array( 'JobTitle','CName','JYRSExperience','JCity','StateID');
	
	//standard DB connection
	if (isset($mysql)) {
		//print "Database Found!". "<BR>";
		
		//structure the query based on defined variables
		if(isset($title)){
			if(isset($location)){
				
				$suffix = " WHERE JobTitle=".$title."&& JCity =".$location;
			}
			else{
				$suffix = " WHERE JobTitle="."$title";
			}
		}
		else{
			
			if(isset($location)){
				$suffix = " WHERE JCity=".$location;
			}
			else{
				$suffix = "";
			}
		}
		
		//do the stuff
		$query = "SELECT * FROM job".$suffix;
		$result = $mysql->query($query);
		if (!$result) {
    		throw new Exception("Database Error [{$this->database->errno}] {$this->database->error}");
		}
		print $result->num_rows." results found...";
		//we define the table header
		
		echo "<table class='table' cellpadding='7' style='border: 1px solid black; border-collapse:collapse;'>
        <thead style='background-color:black; color: white; font-weight:bold; text-align:left;'>
        <tr>
        <th>Job Title</th>
        <th>Company Name</th>
        <th>Reqd Yrs Exp</th>
        <th>City</th>
        <th>State</th>
        </tr>
        </thead>
        <tbody>";
		//makes the remaining table body from the query results and categorizes by the field names
		getTable($result, $field_array);
		echo "</tbody>
        </table>";

	}
	else {
		print "ERROR: Database NOT Found ";
	}
	
include('footer.php');
?>