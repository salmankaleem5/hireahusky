<?PHP
include ('lib/database.php');
$mysql = $GLOBALS['mysql'];

function updateInfo($uname){
	$uname = '"'.$uname.'"';//adds quotes to variable $uname
	$mysql = $GLOBALS['mysql'];//needs to be here to work for some reason
	if (isset($mysql)) {
	$query = "SELECT * FROM user 
			  INNER JOIN state ON user.StateID=state.StateID
			  WHERE user.UNAME = $uname";
	$result = $mysql->query($query);
	if (!$result) {
    	throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
	}
	$dbField = $result->fetch_assoc();
	$presentUName = $dbField['UName'];
	//echo "<br><p>Username : <b>$presentUName</b></p>";
	
	$stateprep = $dbField['StateName'];
	
	echo "<form action='user_update_actions' method ='POST'><fieldset>
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
	//choose what shows first for the state drop down
	if($stateprep == ''){
		echo "<option selected='selected'>Select...</option>"; 
	}
	else{
		$key=$dbField['StateName'];
    	$value=$dbField['StateID'];
		echo "<option selected='selected' value=$value>$key</option>";
	}
	//template drop down code: http://www.phpsuperblog.com/php/html-form-drop-down-menu-with-data-from-mysql-datebase-as-options/
    $state_query= "SELECT StateID,StateName FROM state";
	$state_result = $mysql->query($state_query);
	if (!$state_result) {
    	throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
	}
    while ( $dbField2 = $state_result->fetch_assoc() ) {
    		$key=$dbField2['StateName'];
    		$value=$dbField2['StateID'];
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

	echo '<table><tr><p><td style="width: 200px"><button type="submit" class="btn btn-primary btn-sm">UPDATE</button></td>
	<td></p></td> </tr></table>';

	echo "</fieldset></form>";
	}
}
?>