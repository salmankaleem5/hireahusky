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
	
	$errors = array();

	require('lib/database.php');
	//validate username and password and check if they're in database
	/*if(  ){
		$errors['username'] = 'Username is not valid';
		$app->flash('errors',$errors);
		$app->redirect('/login');
	} else if(  ){
		$errors['password'] = 'Password is not valid';
		$app->flash('errors',$errors);
		$app->redirect('/login');
	}*/
	$_SESSION['user'] = $username;
	if( isset($_SESSION['urlRedirect']) ){
		$tmp = $_SESSION['urlRedirect'];
		unset($_SESSION['urlRedirect']);
		$app->redirect($tmp);
	}
	$app->redirect('http://localhost/hireahusky/');
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

	$errors = array();

	require('lib/database.php');

	//validate all info above and add user
	/*if(  ){
		$errors['username'] = 'Username is not valid';
		$app->flash('errors',$errors);
		$app->redirect('/login');
	} else if(  ){
		$errors['password'] = 'Password is not valid';
		$app->flash('errors',$errors);
		$app->redirect('/login');
	}*/

	$_SESSION['user'] = $username;
	/*if( isset($_SESSION['urlRedirect']) ){
		$tmp = $_SESSION['urlRedirect'];
		unset($_SESSION['urlRedirect']);
		$app->redirect($tmp);
	}*/
	$app->redirect('http://localhost/hireahusky/'); // redirect to account page?
});

$app->get('/private', 'authenticate', function() use ($app){
	echo 'hi';
});

$app->run();
?>