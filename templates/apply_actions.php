<?PHP
	include ('lib/database.php');
	include('header.php');
	include ('hahapi.php');
	$mysql = $GLOBALS['mysql'];
	$uname = $_SESSION['user'];
	$jobid = $_POST['jobid'];
	
	$date = getdate();
	$month = $date['mon'];
	$day = $date['mday'];
	$year = $date['year'];
	$fulldate = "$month/$day/$year";
	
	$uname = $uname;//adds quotes to variable $uname
	$mysql = $GLOBALS['mysql'];//needs to be here to work for some reason
	if (!$mysql) {
    	die("Connection failed: " . mysqli_connect_error());
	}
	
	//generates a new ApplicationID
	$app_query = "SELECT max(ApplicationID) AS answer FROM `applies`";
	$app_result = $mysql->query($app_query);
	$app_field = $app_result->fetch_assoc();
	$oldAppID = $app_field['answer'];
	$newAppID = $oldAppID+1;
	
	
	
	$res_insert = "INSERT INTO applies (JobID, ApplicationID, DateApplied,Uname) 
	VALUES ('$jobid','$newAppID','$fulldate','$uname')";
	
	if (!mysqli_query($mysql, $res_insert)) {
	    echo "Could not process application:" . mysqli_error($mysql);
	}
	else{
		echo "Your application has been processed. Thank you!";
	}
?>