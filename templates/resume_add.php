<?PHP
include ('lib/database.php');
$mysql = $GLOBALS['mysql'];

function addResume($uname){
	$uname = '"'.$uname.'"';//adds quotes to variable $uname
	$mysql = $GLOBALS['mysql'];//needs to be here to work for some reason
	if (isset($mysql)) {
	//need to add prior jobs stuff
	

	$deg_query = "SELECT DegreeTypeID, DegreeType FROM degreetype";
	$deg_result = $mysql->query($deg_query);
	$uni_query = "SELECT UniversityID ,UniversityName FROM university";
	$uni_result = $mysql->query($uni_query);
	$area_query = "SELECT DegreeAreaID ,DegreeArea FROM degreearea";
	$area_result = $mysql->query($area_query);
	
	if (!($deg_result||$uni_result||$area_result) ){
    	throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
	}
	
	echo "<form action='resume_add_actions' method ='POST'><fieldset>";
	//DEGREE INPUT 1
	echo "<b><u>Education Field 1</u></b><br>";
	//Degree Drop Down
	echo "<br>Degree Type* <select name='DegreeType'><option selected='selected' value='0'>Select...</option>"; 
    while ( $dbField2 = $deg_result->fetch_assoc() ) {
    		$key=$dbField2['DegreeType'];
    		$value=$dbField2['DegreeTypeID'];
			echo "<option value = $value> $key </option>";
			}
	echo"</select>";
	//Degree Area Drop Down
	echo "<br><br>Degree Area* <select name='DegreeArea'><option selected='selected' value='0'>Select... </option>"; 
    while ( $dbField3 = $area_result->fetch_assoc() ) {
    		$key=$dbField3['DegreeArea'];
    		$value=$dbField3['DegreeAreaID'];
			echo "<option value = $value> $key </option>";
			}
	echo"</select>";
	//University Drop Down
	echo "<br><br>University* <select select name='University'><option selected='selected' value='0'>Select...</option>"; 
    while ( $dbField2 = $uni_result->fetch_assoc() ) {
    		$key=$dbField2['UniversityName'];
    		$value=$dbField2['UniversityID'];
			echo "<option value = $value> $key </option>";
			}
	echo"</select>";
	
	echo 
	"<br><br>GPA*: <input type='text' name='EGPA'><br>
	<br>Start Date (MM/DD/YYYY)*: <input type='text' name='EstartDate'><br>
	<br>Graduation Date (MM/DD/YYYY)*: <input type='text' name='EGradDate'><br>
	";
	
	//DEGREE INPUT 2
	$deg_query = "SELECT DegreeTypeID, DegreeType FROM degreetype";
	$deg_result = $mysql->query($deg_query);
	$uni_query = "SELECT UniversityID ,UniversityName FROM university";
	$uni_result = $mysql->query($uni_query);
	$area_query = "SELECT DegreeAreaID ,DegreeArea FROM degreearea";
	$area_result = $mysql->query($area_query);
	
	if (!($deg_result||$uni_result||$area_result) ){
    	throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
	}
	echo "<br><b><u>Education Field 2</u></b><br>";
	//Degree Drop Down
	echo "<br>Degree Type*<select name='DegreeType2'><option selected='selected' value='0'>Select...</option>"; 
    while ( $dbField2 = $deg_result->fetch_assoc() ) {
    		$key=$dbField2['DegreeType'];
    		$value=$dbField2['DegreeTypeID'];
			echo "<option value = $value> $key </option>";
			}
	echo"</select>";
	//Degree Area Drop Down
	echo "<br><br>Degree Area* <select name='DegreeArea2'><option selected='selected' value='0'>Select... </option>"; 
    while ( $dbField3 = $area_result->fetch_assoc() ) {
    		$key=$dbField3['DegreeArea'];
    		$value=$dbField3['DegreeAreaID'];
			echo "<option value = $value> $key </option>";
			}
	echo"</select>";
	//University Drop Down
	echo "<br><br>University* <select select name='University2'><option selected='selected' value='0'>Select...</option>"; 
    while ( $dbField2 = $uni_result->fetch_assoc() ) {
    		$key=$dbField2['UniversityName'];
    		$value=$dbField2['UniversityID'];
			echo "<option value = $value> $key </option>";
			}
	echo"</select>";
	
	echo 
	"<br><br>GPA*: <input type='text' name='EGPA2'><br>
	<br>Start Date (MM/DD/YYYY)*: <input type='text' name='EstartDate2'><br>
	<br>Graduation Date (MM/DD/YYYY)*: <input type='text' name='EGradDate2'><br>
	";
	//end of Degree Input 2
	
	
	
	//end the form
	echo '<br><button type="submit" class="btn btn-primary btn-sm">Submit</button>';
	echo "</fieldset></form>";
	}
}
?>