<?PHP
	

	function makeSearchTable($dbResults,$fields){
		
		//html for generating the search table body
		while ( $dbField = $dbResults->fetch_assoc() ) {
			echo "<tr>";
			for ($i = 0; $i < count($fields); $i++) {
				if( $i == 0 ){
					echo '<td><a href="http://localhost/hireahusky/job/'.$dbField["JobID"].'">'.$dbField[$fields[$i]].'</a></td>';
				} else {
					echo '<td>'.$dbField[$fields[$i]].'</td>';	
				}
			}
			echo "</tr>";
		}
	}	
	function getTable($dbResults,$fields){
		
		//html for generating table header the way we want
		//html for generating table body
		//$j = 0;
		while ( $dbField = $dbResults->fetch_assoc() ) {
			echo "<tr>";
			for ($i = 0; $i < count($fields); $i++) {
				if( $i == 0 ){
					echo '<td><a href="http://localhost/hireahusky/job/'.$dbField["JobID"].'">'.$dbField[$fields[$i]].'</a></td>';
				} else {
					echo '<td>'.$dbField[$fields[$i]].'</td>';	
				}
			}
			echo "</tr>";
		}
	}			
	function state2ID(){}
	//http://www.allembru.com/blog/us-states-dropdown-list-php-function/
	function statesList() {
		$states = array('AL'=>"Alabama",
						'AK'=>"Alaska",
						'AZ'=>"Arizona",
						'AR'=>"Arkansas",
						'CA'=>"California",
						'CO'=>"Colorado",
						'CT'=>"Connecticut",
						'DE'=>"Delaware",
						'DC'=>"District Of Columbia",
						'FL'=>"Florida",
						'GA'=>"Georgia",
						'HI'=>"Hawaii",
						'ID'=>"Idaho",
						'IL'=>"Illinois",
						'IN'=>"Indiana",
						'IA'=>"Iowa",
						'KS'=>"Kansas",
						'KY'=>"Kentucky",
						'LA'=>"Louisiana",
						'ME'=>"Maine",
						'MD'=>"Maryland",
						'MA'=>"Massachusetts",
						'MI'=>"Michigan",
						'MN'=>"Minnesota",
						'MS'=>"Mississippi",
						'MO'=>"Missouri",
						'MT'=>"Montana",
						'NE'=>"Nebraska",
						'NV'=>"Nevada",
						'NH'=>"New Hampshire",
						'NJ'=>"New Jersey",
						'NM'=>"New Mexico",
						'NY'=>"New York",
						'NC'=>"North Carolina",
						'ND'=>"North Dakota",
						'OH'=>"Ohio",
						'OK'=>"Oklahoma",
						'OR'=>"Oregon",
						'PA'=>"Pennsylvania",
						'RI'=>"Rhode Island",
						'SC'=>"South Carolina",
						'SD'=>"South Dakota",
						'TN'=>"Tennessee",
						'TX'=>"Texas",
						'UT'=>"Utah",
						'VT'=>"Vermont",
						'VA'=>"Virginia",
						'WA'=>"Washington",
						'WV'=>"West Virginia",
						'WI'=>"Wisconsin",
						'WY'=>"Wyoming");
		return $states;
}
?>

