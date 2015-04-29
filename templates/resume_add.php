<?PHP
include ('lib/database.php');
$mysql = $GLOBALS['mysql'];

function addResume($uname){
	$uname = '"'.$uname.'"';//adds quotes to variable $uname
	$mysql = $GLOBALS['mysql'];//needs to be here to work for some reason
	if (isset($mysql)) {
	//need to add prior jobs stuff
	$deg_query = "SELECT DegreeTypeID, DegreeType FROM degreetype";
	$uni_query = "SELECT UniversityID ,UniversityName FROM university";
	$skill_query= "SELECT SSkillID, SSkillName FROM Skill";
	$skill_query= "SELECT SSkillID, SSkillName FROM Skill";
	$deg_result = $mysql->query($deg_query);
	$uni_result = $mysql->query($uni_query);
	$skill_result = $mysql->query($skill_query);
	if (!($deg_result||$uni_result||$skill_result) ){
    	throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
	}
	
	echo "<form action='resume_add_actions' method ='POST'><fieldset>
	
	Desired Salary Minimum:<br>
	<input type='text' name='RSalaryMin'><br>
	Objective:<br>
	<input type='text' name='RObjective'><br>
	<b>Education</b><br>";
	
	$state_result = $mysql->query($state_query);
	if (!$state_result) {
    	throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
	}
    while ( $dbField = $state_result->fetch_assoc() ) {
    		$key=$dbField['StateName'];
    		$value=$dbField['StateID'];
			echo "<option value = $value> $key </option>";
			}
	
	
	//end php code
	
	
	
	echo "GPA:<br>
		<input type='text' name='EGPA'><br>";
	
	
	
	/*
	Last name:<br><input type='text' name='ULName' value='".$dbField['ULName']."'><br>
	Adress Line 1:
	<br><input type='text' name='UStreet1' value='".$dbField['UStreet1']."'><br>
	Adress Line 2:
	<br><input type='text' name='UStreet2' value='".$dbField['UStreet2']."'><br>
	City:
	<br><input type='text' name='UCity' value='".$dbField['UCity']."'><br>";
	
	
	
    
	
	
	
	echo "</select><br>
	Zip:
	<br><input type='text' name='Zipcode' value='".$dbField['Zipcode']."'><br>
	Email:
	<br><input type='text' name='UEmail' value='".$dbField['UEmail']."'><br>
	Phone:
	<br><input type='text' name='UPhone' value='".$dbField['UPhone']."'><br>
	Cell:
	<br><input type='text' name='UCell' value='".$dbField['UCell']."'><br>
	Fax:
	<br><input type='text' name='UFax' value='".$dbField['UFax']."'><br>
	Website:
	<br><input type='text' name='UHomePage' value='".$dbField['UHomePage']."'><br>";
*/
	echo '<table><tr><p><td style="width: 200px"><button type="submit" class="btn btn-primary btn-sm">Submit</button></td>
	<td><button type="reset" class="btn btn-primary btn-sm">Reset</button></p></td> </tr></table>';

	echo "</fieldset></form>";
	}
}
?>