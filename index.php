<?php
//session_start();

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/app/references.php';




$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;
$config['determineRouteBeforeAppMiddleware'] = true;

$config['db']['host']   = "localhost";
$config['db']['username']   = "root";
$config['db']['password']   = "";
$config['db']['database'] = "diego";

/*
$config['db']['host']   = "localhost";
$config['db']['username']   = "id3142383_diego";
$config['db']['password']   = "diego";
$config['db']['database'] = "id3142383_diego";
*/

$config['db']['driver'] = "mysql";
$config['db']['charset'] = "utf8";
$config['db']['collation'] = "utf8_unicode_ci";
$config['db']['prefix'] = "";
$config['cookies.lifetime'] = '1 minute';

$app = new \Slim\App(['settings' => $config]);

$container = $app->getContainer();

$container['view'] = function($container) {
    $view = new \Slim\View\Twig('/app/views/');
};

$container['upload_directory'] = __DIR__ . '/uploads/';
$container['upload_directory_relative'] = '/uploads/';

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($config['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();


require __DIR__ . '/app/routes.php';
require __DIR__ . '/app/dependencyInjection.php';

$app->run();