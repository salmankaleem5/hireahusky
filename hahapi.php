<?PHP
	
	function makePostedJobsTable($dbResults,$fields){
		
		//html for generating table header the way we want
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
	function makeJobTable($dbResults,$fields){
		
		//html for generating table header the way we want
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
	function makeResumeTable($dbResults,$fields){
		
		//html for generating table header the way we want
		while ( $dbField = $dbResults->fetch_assoc() ) {
			echo "<tr>";
			for ($i = 0; $i < count($fields); $i++) {
				if( $i == 0 ){
					echo '<td><a href="http://localhost/hireahusky/job/'.$dbField[$fields[$i]].'">Resume'.($i+1).'</a></td>';
				} else {
					echo '<td>'.$dbField[$fields[$i]].'</td>';	
				}
			}
			echo "</tr>";
		}
	}
	//need this to generate state abbreviations for representation in editing pages when DB gives a stateid
	function id2State($id){
		$array = array('1'=>"AL",
						'2'=>"AK",
						'4'=>"AZ",
						'5'=>"AR",
						'6'=>"CA",
						'7'=>"CO",
						'8'=>"CT",
						'9'=>"DE",
						'10'=>"DC",
						'12'=>"FL",
						'13'=>"GA",
						'15'=>"HI",
						'16'=>"ID",
						'17'=>"IL",
						'18'=>"IN",
						'19'=>"IA",
						'20'=>"KS",
						'21'=>"KY",
						'22'=>"LA",
						'23'=>"ME",
						'25'=>"MD",
						'26'=>"MA",
						'27'=>"MI",
						'28'=>"MN",
						'29'=>"MS",
						'30'=>"MO",
						'31'=>"MT",
						'32'=>"NE",
						'33'=>"NV",
						'34'=>"NH",
						'35'=>"NJ",
						'36'=>"NM",
						'37'=>"NY",
						'38'=>"NC",
						'39'=>"ND",
						'41'=>"OH",
						'42'=>"OK",
						'43'=>"OR",
						'45'=>"PA",
						'47'=>"RI",
						'48'=>"SC",
						'49'=>"SD",
						'50'=>"TN",
						'51'=>"TX",
						'52'=>"UT",
						'53'=>"VT",
						'55'=>"VA",
						'56'=>"WA",
						'57'=>"WV",
						'58'=>"WI",
						'59'=>"WY");
		$abbr = $array["$id"];
		return $abbr;
	}
	//http://www.allembru.com/blog/us-states-dropdown-list-php-function/
	function statesList() {
		$states = array('AL'=> 1,
						'AK'=> 2,
						'AZ'=> 4,
						'AR'=> 5,
						'CA'=> 6,
						'CO'=> 7,
						'CT'=> 8,
						'DE'=> 9,
						'DC'=> 10,
						'FL'=> 12,
						'GA'=> 13,
						'HI'=> 15,
						'ID'=> 16,
						'IL'=> 17,
						'IN'=> 18,
						'IA'=> 19,
						'KS'=> 20,
						'KY'=> 21,
						'LA'=> 22,
						'ME'=> 23,
						'MD'=> 25,
						'MA'=> 26,
						'MI'=> 27,
						'MN'=> 28,
						'MS'=> 29,
						'MO'=> 30,
						'MT'=> 31,
						'NE'=> 32,
						'NV'=> 33,
						'NH'=> 34,
						'NJ'=> 35,
						'NM'=> 36,
						'NY'=> 37,
						'NC'=> 38,
						'ND'=> 39,
						'OH'=> 41,
						'OK'=> 42,
						'OR'=> 43,
						'PA'=> 45,
						'RI'=> 47,
						'SC'=> 48,
						'SD'=> 49,
						'TN'=> 50,
						'TX'=> 51,
						'UT'=> 52,
						'VT'=> 53,
						'VA'=> 55,
						'WA'=> 56,
						'WV'=> 57,
						'WI'=> 58,
						'WY'=> 59);
		return $states;
}
?>

