<?php 

$container['view'] = function($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/views', [
        'cache' => false,
    ]);
    
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));   

    return $view;
};

$ontainer['db'] = function($container) use ($capsule) {
    return $capsule;
};


$container['HomeController'] = function($container) {
    return new App\Controllers\HomeController($container);
};