<?php 

$container['LoginController'] = function($container) {
    return new App\Controllers\LoginController($container);
};

$container["flash"] = function($c){
    return new Slim\Flash\Messages;
};


$ontainer['db'] = function($container) use ($capsule) {
    return $capsule;
};

$container["validator"] = function($c){
    return new App\Validation\Validator;
};

$container['HomeController'] = function($container) {
    return new App\Controllers\HomeController($container);
};

$container['UserController'] = function($container) {
    return new App\Controllers\UserController($container);
};

$container['view'] = function($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/views', [
        'cache' => false,
    ]);
    
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    $view->getEnvironment()->addGlobal('user', $container->LoginController);
    
    $view->getEnvironment()->addGlobal('flash', $container->flash);

    return $view;
};
