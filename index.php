<?php
session_start();
require 'vendor/autoload.php';


$app = new \Slim\Slim(array(
			'debug' => 'true'
		)
	);

use Illuminate\Database\Capsule\Manager as Capsule;
 
$capsule = new Capsule; 
$capsule->addConnection(array(
 
	'driver'    => 'mysql',		 
	'host'      => 'localhost',		 
	'database'  => 'test',		 
	'username'  => 'universal',		 
	'password'  => 'demo123',		 
	'charset'   => 'utf8',		 
	'collation' => 'utf8_unicode_ci',		 
	'prefix'    => ''
 
));
$capsule->setAsGlobal();
$capsule->bootEloquent();

$app->get('/',function(){
	echo 'Welcome to API';
})->name('home');


$app->group('/api', function() use($app){
	$app->group('/usuarios', function() use($app){
		$app->response->headers->set('Content-Type','application/json');
		$app->get('/all', function() use($app){
			$alluser = Usuarios::all();
			echo $alluser->toJson();
		});
	});
});

$app->run();
