<?PHP
include ('lib/database.php');
include('header.php');
include ('hahapi.php');
$mysql = $GLOBALS['mysql'];
	$uname = $_SESSION['user'];
	$uname = '"'.$uname.'"';//adds quotes to variable $uname
	$mysql = $GLOBALS['mysql'];//needs to be here to work for some reason
	if( !empty($id) ){
		$jobid = $id;
	}
	
	if (isset($mysql)) {
	
	$query = "SELECT * FROM resume WHERE UName = $uname";
	$result = $mysql->query($query);
	if (!$result) {
    	throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
	}
	$res_query= "SELECT ResumeID,RObjective FROM resume WHERE UName = $uname";
	$res_result = $mysql->query($res_query);
	if (!$res_result) {
    	throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
	}
	echo"<div class='span12 hero-unit black'><h1>Choose A Resume</h1></div>";
	
	
	echo "<br><form action='apply_actions' method ='POST'><fieldset>";
	
	echo "<select style padding='50px' name='ResumeID'><option selected='selected' value='0'>Select...</option>";
	
    while ( $dbField = $res_result->fetch_assoc() ) {
		$key=$dbField['RObjective'];
    	$value=$dbField['ResumeID'];
		echo "<option value = $value> Objective: $key</option>";
	}
	
	echo "</select><br><br>";
	
	echo "<input type='hidden' name='jobid' value='$jobid'>";
  	
	echo '<table><tr><p><td style="width: 200px"><button type="submit" class="btn btn-primary btn-sm">Submit</button></td>
	</p></tr></table>';

	echo "</fieldset></form>";
	}

?>