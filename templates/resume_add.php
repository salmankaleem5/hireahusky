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
	//begin Resume information------------------------------------------------
	echo "<br><b><u>Objective Profile</u></b><br>";
	echo "<br>Statement: <input type='text' name='objective'><br>
	<br>Salary Minimum*: <input type='text' name='salarymin'><br><br>";
		
	//end Resume information-------------------------------------------------
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
	
	echo "<br><br>GPA*: <input type='text' name='EGPA2'><br>
	<br>Start Date (MM/DD/YYYY)*: <input type='text' name='EstartDate2'><br>
	<br>Graduation Date (MM/DD/YYYY)*: <input type='text' name='EGradDate2'><br>";
	//end of Degree Input 2
	//begin prior jobs profile 1------------------------------------------------
	echo "<br><b><u>Prior Job Field 1</u></b><br>";
	echo "<br>Company Name*: <input type='text' name='pjcompany1'><br>
	<br>Job Title*: <input type='text' name='pjtitle1'><br>
	<br>Duties*: <input type='text' name='pjduties1'><br>
	<br>City*: <input type='text' name='pjcity1'><br>";
	$pj1state_query= "SELECT StateID,StateName FROM state";
	$pj1state_result = $mysql->query($pj1state_query);
	if (!$pj1state_result) {
    	throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
	}
	echo "<br>State* <select select name='pjstate1'><option selected='selected' value='0'>Select...</option>";
	while ( $pj1dbField = $pj1state_result->fetch_assoc() ) {
    		$key=$pj1dbField['StateName'];
    		$value=$pj1dbField['StateID'];
			echo "<option value = $value> $key </option>";
			}
	echo"</select>";
	echo "
	<br><br>Start Date (MM/DD/YYYY)*: <input type='text' name='pjstart1'><br>
	<br>End Date (MM/DD/YYYY)*: <input type='text' name='pjend1'><br>";
	
	//end prior jobs profile 1-------------------------------------------------
	//begin prior jobs profile 2------------------------------------------------
	echo "<br><b><u>Prior Job Field 2</u></b><br>";
	echo "<br>Company Name*: <input type='text' name='pjcompany2'><br>
	<br>Job Title*: <input type='text' name='pjtitle2'><br>
	<br>Duties*: <input type='text' name='pjduties2'><br>
	<br>City*: <input type='text' name='pjcity2'><br>";
	$pj2state_query= "SELECT StateID,StateName FROM state";
	$pj2state_result = $mysql->query($pj2state_query);
	if (!$pj2state_result) {
    	throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
	}
	echo "<br>State* <select select name='pjstate2'><option selected='selected' value='0'>Select...</option>";
	while ( $pj2dbField = $pj2state_result->fetch_assoc() ) {
    		$key=$pj2dbField['StateName'];
    		$value=$pj2dbField['StateID'];
			echo "<option value = $value> $key </option>";
			}
	echo"</select>";
	echo "
	<br><br>Start Date (MM/DD/YYYY)*: <input type='text' name='pjstart2'><br>
	<br>End Date (MM/DD/YYYY)*: <input type='text' name='pjend2'><br>";
	
	//end prior jobs profile 2-------------------------------------------------
	//begin skill drop downs
	
	$skill_query = "SELECT SSkillID, SSkillName FROM skill";
	$skill_result = $mysql->query($skill_query);
	if (!$skill_result){
    	throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
	}
	$skill_query2 = "SELECT SSkillID, SSkillName FROM skill";
	$skill_result2 = $mysql->query($skill_query2);
	if (!$skill_result2){
    	throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
	}
	$skill_query3 = "SELECT SSkillID, SSkillName FROM skill";
	$skill_result3 = $mysql->query($skill_query3);
	if (!$skill_result3){
    	throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
	}
	$skill_query4 = "SELECT SSkillID, SSkillName FROM skill";
	$skill_result4 = $mysql->query($skill_query4);
	if (!$skill_result4){
    	throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
	}

	echo "<br><b><u>Skill Field</u></b><br>";
	echo "<br><br>Skill 1* <select select name='skill1'><option selected='selected' value='0'>Select...</option>"; 
    while ( $dbField4 = $skill_result->fetch_assoc() ) {
    		$key=$dbField4['SSkillName'];
    		$value=$dbField4['SSkillID'];
			echo "<option value = $value> $key </option>";
			}
	echo"</select>";
	echo "<br><br>Skill 2* <select select name='skill2'><option selected='selected' value='0'>Select...</option>"; 
    while ( $dbField4 = $skill_result2->fetch_assoc() ) {
    		$key=$dbField4['SSkillName'];
    		$value=$dbField4['SSkillID'];
			echo "<option value = $value> $key </option>";
			}
	echo"</select>";
	echo "<br><br>Skill 3* <select select name='skill3'><option selected='selected' value='0'>Select...</option>"; 
    while ( $dbField4 = $skill_result3->fetch_assoc() ) {
    		$key=$dbField4['SSkillName'];
    		$value=$dbField4['SSkillID'];
			echo "<option value = $value> $key </option>";
			}
	echo"</select>";
	echo "<br><br>Skill 4* <select select name='skill4'><option selected='selected' value='0'>Select...</option>"; 
    while ( $dbField4 = $skill_result4->fetch_assoc() ) {
    		$key=$dbField4['SSkillName'];
    		$value=$dbField4['SSkillID'];
			echo "<option value = $value> $key </option>";
			}
	echo"</select>";
	//end skill drop downs
	
	//end the form
	echo '<br><br><button type="submit" class="btn btn-primary btn-sm">Submit</button>';
	echo "</fieldset></form>";
	}
}
?>