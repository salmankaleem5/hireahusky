<?php
/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new \Slim\Slim();

/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */

// GET route
$app->get('/', function () {
	echo phpinfo();       
});


//	Get all names
$app->get('/employees', function() {
	$sql = "SELECT names FROM Employee";
	
	$dbServerName = "localhost";
    $dbUser = "username";
    $dbPassword = "password";
    $dbName = "sample";
	
	$result = NULL;
    
	// Create connection
    $conn = new mysqli($dbServerName, $dbUser, $dbPassword, $dbName);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
	    $result = $mysqlConnection->query($sql);
		
		if (!$result) {
		    throw new Exception("Database Error [{$this->database->errno}] {$this->database->error}");
		} else {
		    $array = array();
		    while($row = $result->fetch_assoc()) $array[] = $row;
			
			echo json_encode($array);	//	Echo result in JSON
		}
		
		$mysqlConnection->close();
    }
});

$app->get('/customers', function() {
	$sql = "SELECT names FROM Customer";
	
	$dbServerName = "localhost";
    $dbUser = "username";
    $dbPassword = "password";
    $dbName = "sample";
	
	$result = NULL;
    
	// Create connection
    $conn = new mysqli($dbServerName, $dbUser, $dbPassword, $dbName);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
	    $result = $mysqlConnection->query($sql);
		
		if (!$result) {
		    throw new Exception("Database Error [{$this->database->errno}] {$this->database->error}");
		} else {
		    $array = array();
		    while($row = $result->fetch_assoc()) $array[] = $row;
			
			echo json_encode($array);	//	Echo result in JSON
		}
		
		$mysqlConnection->close();
    }
});


/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();
