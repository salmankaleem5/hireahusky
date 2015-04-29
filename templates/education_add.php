<?PHP
include ('lib/database.php');
$mysql = $GLOBALS['mysql'];

function addEducation($uname){
	$uname = '"'.$uname.'"';//adds quotes to variable $uname
	$mysql = $GLOBALS['mysql'];//needs to be here to work for some reason
	if (isset($mysql)) {
	//need to add prior jobs stuff
	
	$deg_query = "SELECT DegreeTypeID, DegreeType FROM degreetype";
	$uni_query = "SELECT UniversityID ,UniversityName FROM university";
	$deg_result = $mysql->query($deg_query);
	$uni_result = $mysql->query($uni_query);
	if (!($deg_result||$uni_result) ){
    	throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
	}
	
	echo "<form action='education_add_actions' method ='POST'><fieldset>
	
	Desired Salary Minimum:<br><input type='text' name='RSalaryMin'><br>
	
	Objective:<br>	<input type='text' name='RObjective'><br>
	
	<br><b>Education</b><br>";
	
	//Degree Drop Down
	echo "<br>Degree Type<br><select name='Degree'><option selected='selected' value='0'>Select...</option>"; 
    while ( $dbField2 = $deg_result->fetch_assoc() ) {
    		$key=$dbField2['DegreeType'];
    		$value=$dbField2['DegreeTypeID'];
			echo "<option value = $value> $key </option>";
			}
	echo"</select>";
	//University Drop Down
	echo "<br><br>University<br><select><option selected='selected' value='0'>Select...</option>"; 
    while ( $dbField2 = $uni_result->fetch_assoc() ) {
    		$key=$dbField2['UniversityName'];
    		$value=$dbField2['UniversityID'];
			echo "<option value = $value> $key </option>";
			}
	echo"</select>";
	
	echo 
	"<br><br>GPA:<br><input type='text' name='EGPA'><br>
	<br>Start Date MM/DD/YYYY:<br><input type='text' name='EstartDate'><br>
	<br>Graduation Date MM/DD/YYYY:<br><input type='text' name='EGradDate'><br>
	";
	
	echo '<br><button type="submit" class="btn btn-primary btn-sm">Submit</button>';
	echo "</fieldset></form>";
	}
}
?>