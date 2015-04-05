<?php
	$username = "root";
	$password = "";
	$database = "trogdor";
	$address = "localhost";
	
	 // Create connection
    $mysqlConnection = new mysqli($address, $username, $password, $database);

    // Check connection
    if ($mysqlConnection->connect_error) {
        die("Connection failed: " . $mysqlConnection->connect_error);
    }
	
	if (isset($_GET['add_employee'])) {
		
        $sqlNewEmployee = "INSERT INTO employees (name) VALUES ('" . $_GET['employee_name'] . "')";	
		$result = NULL;
		
        $result = $mysqlConnection->query($sqlNewEmployee);
        $recordId = $mysqlConnection->insert_id;	//	This will grab the primary key value sot hat we can use it as reference in case we need it
		
		echo $recordId;
		
	} else if (isset($_GET['remove_employee'])) {
		
		$sqlRemoveEmployee = "DELETE FROM employees WHERE id = '" . $_GET['employee_id'] . "'";	
		$result = NULL;
		
        $result = $mysqlConnection->query($sqlRemoveEmployee);
	}

    $mysqlConnection->close();
	
	$jsonResponseAllEmployees = http_get("http://localhost/sample_api/employees", array("timeout"=>1), $info);	//	Need PCL for this
	$array = json_decode($jsonResponseAllEmployees);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title>sample gui</title>
</head>

<body>
	
<form name="add_employee">
	Add employee with name: 
	<input type="text" name="employee_name">
	<input type="hidden" name="add_employee" value="1">
	
	<input type="submit">	
</form>

<div id="doc2" class="yui-t7">
	<div id="inner">
		<div id="bd">
			<div id="yui-main">
				<div class="yui-b">
					<div class="yui-gf">
	
						<div class="yui-u first">
							<h2>Employees</h2>
						</div><!--// .yui-u -->

						<div class="yui-u">

						<?php foreach ($array as $employee) { ?>
							<div class="job">
								<h4><li><?php echo $employee['name'] ?> (<a href="http://localhost/sample_gui/employees.php?employee_id=<?php echo $employee['id']; ?>&remove_employee=1">remove employee</a>)</li></h4>																
							</div>
						<?php } ?>

						</div><!--// .yui-u -->
					</div><!--// .yui-gf -->
				</div>
			</div>
		</div>
	</div>
</div>

</body>
</html>

