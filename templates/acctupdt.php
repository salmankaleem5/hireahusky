<?PHP
include ('lib/database.php');
$mysql = $GLOBALS['mysql'];

function updateInfo($uname){
	$mysql = $GLOBALS['mysql'];//needs to be here to work for some reason
	if (isset($mysql)) {
	$query = "SELECT * FROM user WHERE user.UNAME = $uname";
	$result = $mysql->query($query);
	if (!$result) {
    	throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
	}
	$dbField = $result->fetch_assoc();
	echo "<form action='action_page.php' method ='POST'><fieldset>

	User Name:
	<br><input type='text' name='username' value='".$dbField['UName']."'><br>
	First name:
	<br><input type='text' name='firstname' value='".$dbField['UFName']."'><br>
	Last name:<br><input type='text' name='lastname' value='".$dbField['ULName']."'><br>
	Adress Line 1:
	<br><input type='text' name='address1' value='".$dbField['UStreet1']."'><br>
	Adress Line 2:
	<br><input type='text' name='address2' value='".$dbField['UStreet2']."'><br>
	City:
	<br><input type='text' name='city' value='".$dbField['UCity']."'><br>
	State:
	<br><input type='text' name='state' value='".$dbField['StateID']."'><br>
	Zip:
	<br><input type='text' name='zip' value='".$dbField['Zipcode']."'><br>
	Email:
	<br><input type='text' name='Email' value='".$dbField['UEmail']."'><br>
	Phone:
	<br><input type='text' name='Phone' value='".$dbField['UPhone']."'><br>
	Cell:
	<br><input type='text' name='Cell' value='".$dbField['UCell']."'><br>
	Fax:
	<br><input type='text' name='Fax' value='".$dbField['UFax']."'><br>
	Website:
	<br><input type='text' name='Website' value='".$dbField['UHomePage']."'><br>";

	echo '<table><tr><td style="width: 200px"><p><button type="submit" class="btn btn-primary btn-sm">Submit</button></p></td>
	<td><p><button type="reset" class="btn btn-primary btn-sm">Reset</button></p></td> </tr></table>';

	echo "</fieldset></form>";
	}
}
?>