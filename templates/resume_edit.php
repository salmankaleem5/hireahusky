<?PHP
	include ('lib/database.php');
	include('header.php');
	$mysql = $GLOBALS['mysql'];
	$uname = $_SESSION['user'];
	$uname = '"'.$uname.'"';//adds quotes to variable $uname
	if( !empty($id) ){//get[]
		$resumeID = $id;
	}
	echo"<div class='span12 hero-unit black'><h1>Edit Resume</h1></div>";
	if (isset($mysql)) {
		$deg_query = "SELECT DegreeTypeID, DegreeType FROM degreetype";
		$deg_result = $mysql->query($deg_query);
		$uni_query = "SELECT UniversityID ,UniversityName FROM university";
		$uni_result = $mysql->query($uni_query);
		$area_query = "SELECT DegreeAreaID ,DegreeArea FROM degreearea";
		$area_result = $mysql->query($area_query);
	
	if (!($deg_result||$uni_result||$area_result) ){
    	throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
	}
	
	//queries for editable info
	$edu_query = "SELECT degreetype.degreetypeid,degreetype.DegreeType,education.EGPA,education.estartdate,education.egraddate,
				  university.universityname,university.universityid,degreearea.degreearea,degreearea.degreeareaid
				  FROM degreetype INNER JOIN education on degreetype.degreetypeID=education.degreetypeID 
				  INNER JOIN degreearea on education.degreeareaID=degreearea.degreeareaID 
				  INNER JOIN resume on education.ResumeID=resume.ResumeID 
				  INNER JOIN university on education.EuniversityID=university.universityID WHERE resume.ResumeID=$resumeID 
				  GROUP BY degreetype.degreetypeID";
	$edu_result = $mysql->query($edu_query);
	
	$prior_query = "SELECT pjobid,pjcompanyname,pjjobtitle,pjduties,pjcity,priorjobs.stateid,
					pjstartdate,pjenddate,resumeID,state.statename
					FROM priorjobs INNER JOIN state on state.stateid=priorjobs.stateid 
					WHERE ResumeID=$resumeID GROUP BY pjobid";
					
	$prior_result = $mysql->query($prior_query);

	$res_query = "SELECT robjective,rsalarymin 
					FROM resume 
					WHERE ResumeID=$resumeID";
	$res_result = $mysql->query($res_query);
	
	$skill_query = "SELECT skillset.sskillID, skill.sskillname 
					FROM skillset INNER JOIN skill on skill.sskillid=skillset.sskillid 
					WHERE ResumeID=4 	GROUP BY sskillid";
	$skill_result = $mysql->query($skill_query);
	
	
	if (!($edu_result||$prior_query||$res_query||$skill_result) ){
    	throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
	}
	//return arrays
	$edufield1 = $edu_result->fetch_assoc();
	$edufield2 = $edu_result->fetch_assoc();
	$priorfield1 = $prior_result->fetch_assoc();
	$priorfield2 = $prior_result->fetch_assoc();
	$resfield = $res_result->fetch_assoc();
	
	echo "<form action='resume_edit_actions' method ='POST'><fieldset>";
	//begin Resume information------------------------------------------------
	echo "<br><b><u>Objective Profile</u></b><br>";
	$key=$resfield['robjective'];
	$key2=$resfield['rsalarymin'];
	echo "<br>Statement: <input type='text' name='objective' value='$key'><br>
	<br>Salary Minimum*: <input type='text' name='salarymin' value='$key2'><br><br>";
		
	//end Resume information-------------------------------------------------
	//DEGREE INPUT 1
	echo "<b><u>Education Field 1</u></b><br>";
	//Degree Drop Down
	
	$key=$edufield1['DegreeType'];
    $value=$edufield1['degreetypeid'];
	echo "<br>Degree Type* <select name='DegreeType'><option selected='selected' value='$value'>$key</option>"; 
    while ( $dbField2 = $deg_result->fetch_assoc() ) {
    		$key=$dbField2['DegreeType'];
    		$value=$dbField2['DegreeTypeID'];
			echo "<option value = $value> $key </option>";
			}
	echo"</select>";
	//Degree Area Drop Down
	$key=$edufield1['degreearea'];
    $value=$edufield1['degreeareaid'];
	echo "<br><br>Degree Area* <select name='DegreeArea'><option selected='selected' value='$value'>$key</option>"; 
    while ( $dbField3 = $area_result->fetch_assoc() ) {
    		$key=$dbField3['DegreeArea'];
    		$value=$dbField3['DegreeAreaID'];
			echo "<option value = $value> $key </option>";
			}
	echo"</select>";
	//University Drop Down
	$key=$edufield1['universityname'];
    $value=$edufield1['universityid'];
	echo "<br><br>University* <select select name='University'><option selected='selected' value='$value'>$key</option>"; 
    while ( $dbField2 = $uni_result->fetch_assoc() ) {
    		$key=$dbField2['UniversityName'];
    		$value=$dbField2['UniversityID'];
			echo "<option value = $value> $key </option>";
			}
	echo"</select>";
	
	$key=$edufield1['EGPA'];
	$key2=$edufield1['estartdate'];
	$key3=$edufield1['egraddate'];
	echo 
	"<br><br>GPA*: <input type='text' name='EGPA' value='$key'><br>
	<br>Start Date (MM/DD/YYYY)*: <input type='text' name='EstartDate'value='$key2']'><br>
	<br>Graduation Date (MM/DD/YYYY)*: <input type='text' name='EGradDate' value='$key3'><br>
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
	$key=$edufield2['DegreeType'];
    $value=$edufield2['degreetypeid'];
	echo "<br>Degree Type*<select name='DegreeType2'><option selected='selected' value='$value'>$key</option>"; 
    while ( $dbField2 = $deg_result->fetch_assoc() ) {
    		$key=$dbField2['DegreeType'];
    		$value=$dbField2['DegreeTypeID'];
			echo "<option value = $value> $key </option>";
			}
	echo"</select>";
	//Degree Area Drop Down
	$key=$edufield2['degreearea'];
    $value=$edufield2['degreeareaid'];
	echo "<br><br>Degree Area* <select name='DegreeArea2'><option selected='selected' value='$value'>$key</option>"; 
    while ( $dbField3 = $area_result->fetch_assoc() ) {
    		$key=$dbField3['DegreeArea'];
    		$value=$dbField3['DegreeAreaID'];
			echo "<option value = $value> $key </option>";
			}
	echo"</select>";
	//University Drop Down
	$key=$edufield2['universityname'];
    $value=$edufield2['universityid'];
	echo "<br><br>University* <select select name='University2'><option selected='selected' value='$value'>$key</option>"; 
    while ( $dbField2 = $uni_result->fetch_assoc() ) {
    		$key=$dbField2['UniversityName'];
    		$value=$dbField2['UniversityID'];
			echo "<option value = $value> $key </option>";
			}
	echo"</select>";
	$key=$edufield2['EGPA'];
	$key2=$edufield2['estartdate'];
	$key3=$edufield2['egraddate'];
	echo "<br><br>GPA*: <input type='text' name='EGPA2' value='$key'><br>
	<br>Start Date (MM/DD/YYYY)*: <input type='text' name='EstartDate2' value='$key2'><br>
	<br>Graduation Date (MM/DD/YYYY)*: <input type='text' name='EGradDate2' value='$key3'><br>";
	//end of Degree Input 2
	//begin prior jobs profile 1------------------------------------------------
	echo "<br><b><u>Prior Job Field 1</u></b><br>";
	$key=$priorfield1['pjcompanyname'];
	$key2=$priorfield1['pjjobtitle'];
	$key3=$priorfield1['pjduties'];
	$key4=$priorfield1['pjcity'];
	//value='$key'
	echo "<br>Company Name*: <input type='text' name='pjcompany1' value='$key'><br>
	<br>Job Title*: <input type='text' name='pjtitle1' value='$key2'><br>
	<br>Duties*: <input type='text' name='pjduties1' value='$key3'><br>
	<br>City*: <input type='text' name='pjcity1' value='$key4'><br>";
	$pj1state_query= "SELECT StateID,StateName FROM state";
	$pj1state_result = $mysql->query($pj1state_query);
	if (!$pj1state_result) {
    	throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
	}
	$key=$priorfield1['stateid'];
    $value=$priorfield1['statename'];
	echo "<br>State* <select select name='pjstate1'><option selected='selected' value='$value'>$key</option>";
	while ( $pj1dbField = $pj1state_result->fetch_assoc() ) {
    		$key=$pj1dbField['StateName'];
    		$value=$pj1dbField['StateID'];
			echo "<option value = $value> $key </option>";
			}
	echo"</select>";
	$key=$priorfield1['pjstartdate'];
	$key2=$priorfield1['pjenddate'];
	echo "
	<br><br>Start Date (MM/DD/YYYY)*: <input type='text' name='pjstart1' value='$key'><br>
	<br>End Date (MM/DD/YYYY)*: <input type='text' name='pjend1' value='$key2'><br>";
	
	//end prior jobs profile 1-------------------------------------------------
	//begin prior jobs profile 2------------------------------------------------
	echo "<br><b><u>Prior Job Field 2</u></b><br>";
	$key=$priorfield2['pjcompanyname'];
	$key2=$priorfield2['pjjobtitle'];
	$key3=$priorfield2['pjduties'];
	$key4=$priorfield2['pjcity'];
	echo "<br>Company Name*: <input type='text' name='pjcompany2' value='$key'><br>
	<br>Job Title*: <input type='text' name='pjtitle2' value='$key2'><br>
	<br>Duties*: <input type='text' name='pjduties2' value='$key3'><br>
	<br>City*: <input type='text' name='pjcity2' value='$key4'><br>";
	$key=$priorfield2['stateid'];
    $value=$priorfield2['statename'];
	$pj2state_query= "SELECT StateID,StateName FROM state";
	$pj2state_result = $mysql->query($pj2state_query);
	if (!$pj2state_result) {
    	throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
	}
	echo "<br>State* <select select name='pjstate2'><option selected='selected' value='$value'>$key</option>";
	while ( $pj2dbField = $pj2state_result->fetch_assoc() ) {
    		$key=$pj2dbField['StateName'];
    		$value=$pj2dbField['StateID'];
			echo "<option value = $value> $key </option>";
			}
	echo"</select>";
	$key=$priorfield2['pjstartdate'];
	$key2=$priorfield2['pjenddate'];
	echo "
	<br><br>Start Date (MM/DD/YYYY)*: <input type='text' name='pjstart2' value='$key'><br>
	<br>End Date (MM/DD/YYYY)*: <input type='text' name='pjend2' value='$key2'><br>";
	
	//end prior jobs profile 2-------------------------------------------------

	//end the form
	echo '<br><br><button type="submit" class="btn btn-primary btn-sm">Submit</button>';
	echo "</fieldset></form>";
	}

?>