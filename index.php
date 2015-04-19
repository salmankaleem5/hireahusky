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

function authenticate(){
	$app = \Slim\Slim::getInstance();
	if( !isset($_SESSION['user']) ){
		$request = $app->request();
		$_SESSION['urlRedirect'] = $request->getRootUri().$request->getPathInfo();
		$app->flash('error', 'Login required');
		$app->redirect('http://localhost/hireahusky/login');
	}
}

function login($UName, $UPasswd){
	require('lib/database.php');
	$sql = 'SELECT UName FROM user WHERE UName = "'.$UName.'"';
	echo('query = ' .$sql);
	$result = $mysql->query($sql);
	echo('\nresult = ');
	var_dump($result);
	if($UName == $result) {
		$sql = ('SELECT UPasswd FROM user WHERE UName == "' .$UName. '"');
		var_dump($sql);
		$result = $mysql->query($sql);
		if($UPasswd == $result){
			return 0;
		}else{
			return 1; // UPasswd doesn't match
		}
	}else{
		return 2; //UName doesn't exist.
	}
}

$app->get('/', function () use ($app) {
    $app->render('index.php');
});

$app->get('/login', function () use ($app) {
    $app->render('login.php');
});

$app->get('/logout', function () use ($app){
	unset($_SESSION['user']);
	$app->view()->setData('user', null);
	$app->render('logout.php');
});

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

$app->post('/signup', function () use ($app){
	$email = $app->request()->post('email');
	$fname = $app->request()->post('fname');
	$lname = $app->request()->post('lname');
	$username = $app->request()->post('username');
	$password = $app->request()->post('password');

	if( !empty($email) && !empty($fname) && !empty($lname) && !empty($username) && !empty($password) ){
		require('lib/database.php');

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
			var_dump($result);
			/*$app->flash('signup', 'There was an error, please try again');			
			$app->redirect('http://localhost/hireahusky/signup');*/
		}
	} else {
		$app->flash('signup', 'Please fill out all fields');			
		$app->redirect('http://localhost/hireahusky/signup');
	}
});

$app->get('/private', 'authenticate', function() use ($app){
	echo 'hi';
});

$app->run();
?>