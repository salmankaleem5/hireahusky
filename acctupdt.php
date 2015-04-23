<?PHP


$query = "SELECT * FROM user";
		$result = mysql_query($query);

?>

<form action="action_page.php" method ="POST">
<fieldset>
<legend>Personal information:</legend>



User Name:<br>
<input type="text" name="username" value="MMouse2015">
<br>
First name:<br>
<input type="text" name="firstname" value="Mickey">
<br>
Last name:<br>
<input type="text" name="lastname" value="Mouse">
<br>
Adress Line 1:<br>
<input type="text" name="address1" value="1600 Ear Curve">
<br>
Adress Line 2:<br>
<input type="text" name="address2" value="Ste 99">
<br>
City:<br>
<input type="text" name="city" value="Orlando">
<br>
State:<br>
<input type="text" name="state" value="FL">
<br>
Zip:<br>
<input type="text" name="zip" value="32830">
<br>

<br>
<input type="submit" value="Submit">
</fieldset>
</form>

