<?php
	$username = "root";
	$password = "";
	$database = "team3";
	$address = "localhost";
	$select_customers = TRUE;
	// Create connection
    $mysqlConnection = new mysqli($address, $username, $password, $database);

    // Check connection
    if ($mysqlConnection->connect_error) {
        die("Connection failed: " . $mysqlConnection->connect_error);
    }
	
	if (isset($_GET['add_customer'])) {//if  add_customer is set
		
        $sqlNewcustomer = "INSERT INTO customers (name) VALUES ('" . $_GET['customer_name'] . "')";	
		$result = NULL;
		
        $result = $mysqlConnection->query($sqlNewcustomer);
        $recordId = $mysqlConnection->insert_id;	//	This will grab the primary key value sot hat we can use it as reference in case we need it
		
		echo $recordId;
		
	} else if (isset($_GET['remove_customer'])) {
		
		$sqlRemovecustomer = "DELETE FROM customers WHERE id = '" . $_GET['customer_id'] . "'";	
		$result = NULL;
		
        $result = $mysqlConnection->query($sqlRemovecustomer);
	}else if (isset($_GET['select_customers'])) {
		
		$sqlRemovecustomer = "SELECT* FROM seekers";	
		$result = NULL;
		
        $result = $mysqlConnection->query($sqlRemovecustomer);
	}

//
    $mysqlConnection->close();
	
	//$jsonResponseAllCustomers = http_get("http://localhost/sample_api/customers", array("timeout"=>1), $info);	//	Need PCL for this
	$jsonResponseAllCustomers = file_get_contents("http://localhost/sample_api/customers");
	$array = json_decode($jsonResponseAllCustomers);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title>sample gui</title>
</head>

<body>
	
<form name="add_customer">
	Add customer with name: 
	<input type="text" name="customer_name">
	<input type="hidden" name="add_customer" value="1">
	
	<input type="submit">	
</form>

<div id="doc2" class="yui-t7">
	<div id="inner">
		<div id="bd">
			<div id="yui-main">
				<div class="yui-b">
					<div class="yui-gf">
	
						<div class="yui-u first">
							<h2>customers</h2>
						</div><!--// .yui-u -->

						<div class="yui-u">

						<?php foreach ($array as $customer) { ?>
							<div class="job">
								<h4><li><?php echo $customer->name ?><a href="http://localhost/hireahusky/seekers.php?customer_id=<?php echo $customer['id']; ?>&remove_customer=1">remove customer</a></li></h4>																
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

