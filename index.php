<?php
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array(
	'debug'=>true
));

$app->hook('slim.before', function () use ($app) {
    $app->view()->appendData(array('baseUrl' => 'http://localhost/hireahusky'));
});

$app->get('/', function () use ($app) {
    $app->render('index.php');
});

$app->get('/login', function () use ($app) {
    $app->render('login.php');
});

$app->post('/login', function () use ($app){

});

$app->run();
?>