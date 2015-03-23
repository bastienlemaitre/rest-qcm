<?php

use Ovide\Libs\Mvc\Rest\App;

require __DIR__.'/../vendor/autoload.php';

$loader = new \Phalcon\Loader();

//Register dirs
$loader->registerDirs(
	array(
		"./../app/controllers",
		"./../app/models"
	)
)->register();

//Create app
$app = App::instance();

//Set up the database service
$app->di->set('db', function(){
	return new \Phalcon\Db\Adapter\Pdo\Mysql(
		array(
			"host" => "localhost",
			"username" => "root",
			"password" => "",
			"dbname" => "rest-qcm",
			"options" => array(
					PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
			)
		)
	);
});

$app->di->setShared('session', function() {
	$session = new Phalcon\Session\Adapter\Files();
	$session->start();
	return $session;
});
$app->addResources([Domaines::class, Rangs::class, Questionnaires::class, Groupes::class, Reponses::class, Questions::class]);

$app->get("/Users/check/{login}/{password}", array(new UsersController(),"checkConnectionAction"));
$app->get("/Users/check", array(new UsersController(),"checkConnectedAction"));
$app->post("/Users/add", array(new UsersController(),"userAddAction"));
$app->post("/Users/connect", array(new UsersController(),"connectAction"));
$app->get("/Users/disconnect", array(new UsersController(),"disconnectAction"));
$app->get("/Users/exists", array(new UsersController(),"checkUserExistsAction"));

$app->handle();