<?php
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array(
	'debug'=>true
));

$app->hook('slim.before', function () use ($app) {
	$user = null;
    if( isset($_SESSION['user']) ){
    	$user = $_SESSION['user'];
    }
    $app->view()->setData(array('baseUrl' => 'http://localhost/hireahusky', 'user' => $user));
});

$app->add(new \Slim\Middleware\SessionCookie(array('secret' => 'testsecret')));

function returntoSession($app){
	$request = $app->request();
	$_SESSION['urlRedirect'] = $request->getRootUri().$request->getPathInfo();
	$app->flash('errorMsg', 'Login required');
	$app->redirect('http://localhost/hireahusky/login');
}

function authenticate(){
	$app = \Slim\Slim::getInstance();
	if( !isset($_SESSION['user']) ){
		returntoSession($app);
	}
}

// make sure only posters can view applicants for the jobs they've posted. 
function authenticatePoster($username, $jobid){
	require('lib/database.php');

	$suffix = "UName= '$username' AND JobID='$jobid'";
	$sql = "SELECT Uname FROM postandpay WHERE ".$suffix;
	$result = $mysql->query($sql); 
	if (!$result){
    	throw new Exception("Database Error [{$mysql->errno}] {$mysql->error}");
	}   
	if( $result->fetch_assoc()==NULL ){
		return 0;
	}
	return 1;
}

$app->get('/', function () use ($app) {
    $app->render('index.php');
});

$app->get('/login', function () use ($app) {
    $app->render('login.php');
});
//added for lynn's search.php-----------------------------
$app->get('/search', function () use ($app) {
	$jobTitle = $app->request->get('jobTitle');
	$jobLocation = $app->request->get('jobLocation');
    $app->render('search.php', array( 'jobTitle'=>$jobTitle, 'jobLocation'=>$jobLocation) );
});

$app->get('/job/:jobid', function ($jobid) use ($app) {
    $app->render('job.php', array('id'=>$jobid));
});

$app->get('/applicants/:jobid', function ($jobid) use ($app) {
	$username = $_SESSION['user'];
	if(authenticatePoster($username, $jobid)){
    	$app->render('applicants.php', array('id'=>$jobid));
	}else {
		echo ('you are not authorized to view this page. Please sign in with a Job Poster account');
	}
});

$app->get('/newposting', 'authenticate', function() use ($app){
	require('lib/database.php');
	$username = $_SESSION['user'];
	$sql = "SELECT UStatusID FROM user WHERE UName='$username' ";
	if( $result = $mysql->query($sql) ){
		$row = $result->fetch_assoc();
		$UStatusID = $row['UStatusID'];
		// check the user's UStatusID, 0=seeker, 1=poster, 2=admin
		if ($UStatusID == 1) {
			$app->render('newposting.php');
		} else if($UStatusID == 1) {
			echo('Please log in with a poster account to create a new job posting, or upgrade your current account');
			$app->render('welcome.php');
		}
	} else {
		echo('query error in app->get/account');
	}
});

$app->post('/user_update_actions', function () use ($app) {
    $app->render('user_update_actions.php');
});

$app->post('/resume_add_actions', function () use ($app) {
    $app->render('resume_add_actions.php');
});


//------------------------------------------------------
$app->get('/logout', function () use ($app){
	unset($_SESSION['user']);
	$app->view()->setData('user', null);
	$app->render('logout.php');
});

//Cases: Empty username or password, username invalid or password doesn't match
$app->post('/login', function () use ($app){
	$username = $app->request()->post('username');
	$password = $app->request()->post('password');

	if( !empty($username) && !empty($password) ){
		require('lib/database.php');

		$sql = "SELECT UName, UPasswd FROM user WHERE UName='$username' ";
		if ($result = $mysql->query($sql)) {
			$numRows = $result->num_rows;
			if( $numRows == 0 ){ //Username invalid
				$app->flash('errorMsg', 'Invalid username');
				$app->redirect('http://localhost/hireahusky/login');
			}
			$row = $result->fetch_row();

			$sqlPass = $row[1];
			if( $password == $sqlPass ){ //Does the input password match the retrieved password
				$_SESSION['user'] = $username;
				if( isset($_SESSION['urlRedirect']) ){
					$tmp = $_SESSION['urlRedirect'];
					unset($_SESSION['urlRedirect']);
					$app->redirect($tmp);
				}
				$app->redirect('http://localhost/hireahusky/');
			} else { //Invalid password
				$app->flash('errorMsg', 'Invalid username or password');
				$app->redirect('http://localhost/hireahusky/login');
			}
		    $result->close();
		}
	} else {
		$app->flash('errorMsg', 'Please enter a username and password');
		$app->redirect('http://localhost/hireahusky/login');		
	}
});

$app->get('/signup', function () use ($app){
	$app->render('signup.php');
});

// Cases: Duplicate username or email
$app->post('/signup', function () use ($app){
	$email = $app->request()->post('email');
	$fname = $app->request()->post('fname');
	$lname = $app->request()->post('lname');
	$username = $app->request()->post('username');
	$password = $app->request()->post('password');
	$isPoster = $app->request()->post('isPoster');
	$cname = $app->request()->post('cname');
	$cposition = $app->request()->post('cposition');
	
	if( $isPoster != 'true' && !empty($cname) ){  //If user is not a poster but company name is set, reject
		$app->flash('signup', 'There was an error, please try again');			
		$app->redirect('http://localhost/hireahusky/signup');		
	}
	if( $isPoster == 'true' && empty($cname) ){
		$app->flash('signup', 'If you are a poster, please enter your company name');			
		$app->redirect('http://localhost/hireahusky/signup');	
	}
	require('lib/database.php');
	if( !empty($cname) && $result = $mysql->query("SELECT CName FROM company WHERE CName='$cname'") ){
		$rowCount = $result->num_rows;
		if( $rowCount < 1 ){
			$app->flash('signup', "I'm sorry that company doesn't exist in our database");			
			$app->redirect('http://localhost/hireahusky/signup');	
		}
	}
	if( !empty($email) && !empty($fname) && !empty($lname) && !empty($username) && !empty($password) ){
		$duplicateUNameSql = "SELECT UName FROM user WHERE UName='$username'";
		if( $result = $mysql->query($duplicateUNameSql) ){
			$rowCount = $result->num_rows;
			if( $rowCount != 0 ){
				$app->flash('signup', 'This username is already in use, please choose a different one');			
				$app->redirect('http://localhost/hireahusky/signup');				
			}
		}
		
		$duplicateEmailSql = "SELECT UEmail FROM user WHERE UEmail='$email'";
		if( $result = $mysql->query($duplicateEmailSql) ){
			$rowCount = $result->num_rows;
			if( $rowCount != 0 ){
				$app->flash('signup', 'This email address already exists, please choose a different one or recover your password');			
				$app->redirect('http://localhost/hireahusky/signup');				
			}
		}

		$sql = "INSERT INTO user SET UName='$username', UPasswd='$password', UFName='$fname', ULName='$lname', UEmail='$email'";

		if( $isPoster == 'true' ){
			$sql = "INSERT INTO user SET UName='$username', UPasswd='$password', UFName='$fname', ULName='$lname', UEmail='$email', UStatusID='1' ";			
		}

		if( $result = $mysql->query($sql) ){
			if( $isPoster == 'true' ){
				$sqlPoster = "INSERT INTO poster SET UName='$username', PPosition='$cposition', PContactEmail='$email', CName='$cname'";
				if( $result = $mysql->query($sqlPoster) ){
					$_SESSION['user'] = $username;
					if( isset($_SESSION['urlRedirect']) ){
						$tmp = $_SESSION['urlRedirect'];
						unset($_SESSION['urlRedirect']);
						$app->redirect($tmp);
					}
					$app->redirect('http://localhost/hireahusky/');
				} else {
					$app->flash('signup', 'There was an error, please try again');			
					$app->redirect('http://localhost/hireahusky/signup');
				}
			}

			$_SESSION['user'] = $username;
			if( isset($_SESSION['urlRedirect']) ){
				$tmp = $_SESSION['urlRedirect'];
				unset($_SESSION['urlRedirect']);
				$app->redirect($tmp);
			}
			$app->redirect('http://localhost/hireahusky/');
		} else {
			$app->flash('signup', 'There was an error, please try again');			
			$app->redirect('http://localhost/hireahusky/signup');
		}
	} else {
		$app->flash('signup', 'Please fill out all fields');			
		$app->redirect('http://localhost/hireahusky/signup');
	}
});

$app->get('/account', 'authenticate', function() use ($app){
	require('lib/database.php');
	$username = $_SESSION['user'];
	$sql = "SELECT UStatusID FROM user WHERE UName='$username' ";
	if( $result = $mysql->query($sql) ){
		$row = $result->fetch_assoc();
		$UStatusID = $row['UStatusID'];
		// check the user's UStatusID, 0=seeker, 1=poster, 2=admin
		if ($UStatusID == 0) {
			$app->render('welcome.php');
		} else if($UStatusID == 1) {
			$app->render('welcome_poster.php');
		}
	} else {
		echo('query error in app->get/account');
	}
});
$app->run();
?>