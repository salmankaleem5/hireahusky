<?PHP
	include ('lib/database.php');//for the global
	include('header.php');
	include ('hahapi.php');
	//$app->get($title);
	
	//include('templates/header.php');
	if(array_key_exists('jobTitle', $_GET)){
		$title = $_GET['jobTitle'];
		$title = '"'.$title.'"';//adds parentheses around the string
	}
	if(array_key_exists('jobLocation', $_GET)){
		$location = $_GET['jobLocation'];
		$location = '"'.$location.'"';//adds parentheses around the string
		//print $location;
	}	
	
	//here I define the names of the fields I am selecting (in the query)
	$field_array = array( 'JobTitle','CName','JYRSExperience','JCity','StateID');
	//var_dump($location);
	//standard DB connection
	if (isset($mysql)) {
		//print "Database Found!". "<BR>";
		
		//structure the query based on defined variables
		if($title == '""'){//if no jobtitle value is passed
			if($location == '""'){//if no joblocation is passed
				$suffix = "";
			}
			else{//if joblocation is set
				$suffix = " WHERE JCity=".$location;
			}
		}
		else{
			if($location == '""'){//have a jobtitle but no location
				$suffix = " WHERE JobTitle="."$title";
			}
			else{//have both title and location
				$suffix = " WHERE JobTitle=".$title."&& JCity =".$location;
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
		makeSearchTable($result, $field_array);
		echo "</tbody>
        </table>";

	}
	else {
		print "ERROR: Database NOT Found ";
	}
	
include('footer.php');
?>