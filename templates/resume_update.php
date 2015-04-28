<?PHP
include ('lib/database.php');
$mysql = $GLOBALS['mysql'];

function updateInfo($uname){
	$uname = '"'.$uname.'"';//adds quotes to variable $uname
	$mysql = $GLOBALS['mysql'];//needs to be here to work for some reason
	if (isset($mysql)) {
	$res_query = "SELECT  
			  FROM resume 
			  INNER JOIN user on user.UName=resume.UName
			  INNER JOIN education on resume.ResumeID=eudcation.ResumeID
			  INNER JOIN skillset on skillset.ResumeID=resume.ResumeID
			  INNER JOIN skill on skillset.SSkillID=skill.SSkillID
			  WHERE user.UNAME = $uname";
	$deg_query = "SELECT  
			  FROM resume 
			  INNER JOIN user on user.UName=resume.UName
			  INNER JOIN education on resume.ResumeID=eudcation.ResumeID
			  INNER JOIN skillset on skillset.ResumeID=resume.ResumeID
			  INNER JOIN skill on skillset.SSkillID=skill.SSkillID
			  WHERE user.UNAME = $uname";
	$skill_query = "SELECT  
			  FROM resume 
			  INNER JOIN user on user.UName=resume.UName
			  INNER JOIN education on resume.ResumeID=eudcation.ResumeID
			  INNER JOIN skillset on skillset.ResumeID=resume.ResumeID
			  INNER JOIN skill on skillset.SSkillID=skill.SSkillID
			  WHERE user.UNAME = $uname";
			  
	$res_result = $mysql->query($res_query);
	if (!$result) {
    	throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
	}
	$deg_result = $mysql->query($deg_query);
	if (!$result) {
    	throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
	}
	$skill_result = $mysql->query($skill_query);
	if (!$result) {
    	throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
	}
	
	
	$resField = $result->fetch_assoc();
	$degField = $result->fetch_assoc();
	$skillField = $result->fetch_assoc();
	//print "Username : $dbField['UName']<br>";
	
	$stateprep = $dbField['StateID'];
	
	echo "<form action='user_update_actions' method ='POST'><fieldset>
	
	User Name:
	<br><input type='text' name='UName' value='".$dbField['UName']."'><br>
	First name:
	<br><input type='text' name='UFName' value='".$dbField['UFName']."'><br>
	Last name:<br><input type='text' name='ULName' value='".$dbField['ULName']."'><br>
	Adress Line 1:
	<br><input type='text' name='UStreet1' value='".$dbField['UStreet1']."'><br>
	Adress Line 2:
	<br><input type='text' name='UStreet2' value='".$dbField['UStreet2']."'><br>
	City:
	<br><input type='text' name='UCity' value='".$dbField['UCity']."'><br>
	
	State:
	<br><select name='StateID'>";
	
	if($stateprep == ''){

		echo "<option selected='selected'>Select...</option>"; 
	}
	else{
		
		$convert = id2State($stateprep);
		echo "<option selected='selected' value=$stateprep>$convert</option>";
	}
	
    $states = statesList();
	
    //php code
    foreach($states as $key=>$value){
		echo "<option value = $value> $key </option>";
		}
	//end php code
	
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

	echo '<table><tr><p><td style="width: 200px"><button type="submit" class="btn btn-primary btn-sm">Submit</button></td>
	<td><button type="reset" class="btn btn-primary btn-sm">Reset</button></p></td> </tr></table>';

	echo "</fieldset></form>";
	}
}
?>