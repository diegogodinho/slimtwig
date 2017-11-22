<?php

session_start();

require __DIR__ . '/vendor/autoload.php';

$app = new \Slim\App([
    'settings'=>[
        'displayErrorDetails' => true
    ]
]);

$container = $app->getContainer();

$container['view'] = function($container) {
    $view = new \Slim\View\Twig('/app/views/');
};

require __DIR__ . '/app/routes.php';
require __DIR__ . '/app/dependencyInjection.php';
require __DIR__ . '/app/references.php';

$app->run();