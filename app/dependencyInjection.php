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


$container['HomeController'] = function($container) {
    return new App\Controllers\HomeController($container);
};