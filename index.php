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

$authenticateUser = function($uname){ //Make sure logged-in user can only request his own resume, applications, etc
	return function () use ($uname){
		$app = \Slim\Slim::getInstance();
		if( !isset($_SESSION['user']) ){
			returntoSession($app);
		} else if( isset($_SESSION['user']) && $_SESSION['user'] != $uname ){
			$app->flash('errorMsg', 'Access denied');
			$app->redirect('http://localhost/hireahusky/');
		}
	};
};

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

$app->get('/test', function () use ($app) {
    $app->render('test.php');
});

$app->post('/user_update_actions', function () use ($app) {
    $app->render('user_update_actions.php');
});

$app->get('/welcome', function () use ($app) {
    $app->render('welcome.php');
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

	/*
	$result = login($username, $password);
	validate username and password and check if they're in database
	
	if($result==2){
		$errors['username'] = 'Username is not valid';
		$app->flash('errors',$errors);
		//$app->redirect('/login');
		echo('wrong user');
	}else if ($result ==1){
		$errors['password'] = 'Password is not valid';
		$app->flash('errors',$errors);
		//$app->redirect('/login');
		echo('wrong password');

	}else{
		echo('success');
		$_SESSION['user'] = $username;
		if( isset($_SESSION['urlRedirect']) ){
			$tmp = $_SESSION['urlRedirect'];
			unset($_SESSION['urlRedirect']);
			$app->redirect($tmp);
		}
	}
	$_SESSION['user'] = $username;
	if( isset($_SESSION['urlRedirect']) ){
		$tmp = $_SESSION['urlRedirect'];
		unset($_SESSION['urlRedirect']);
		$app->redirect($tmp);
	}
	$app->redirect('http://localhost/hireahusky/');
	*/
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

	if( !empty($email) && !empty($fname) && !empty($lname) && !empty($username) && !empty($password) ){
		require('lib/database.php');

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
		if( $result = $mysql->query($sql) ){
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
	$app->render('welcome.php');
});

/*$app->get('/account/myresume/:user', $authenticateUser($uname), function($uname) use ($app){
	
	Use $uname to get ResumeID of $user in Resume table
	Use retrieved ResumeID to retrieve education info in Education table
	Also use ResumeID to retrieve SSkillID in Skillset table. SSkillID corresponds to skills in Skill table

	Pull resume information into editable fields. 
	 
	$app->render('resume.php', array('uname'=>$uname));
});*/

$app->run();
?>