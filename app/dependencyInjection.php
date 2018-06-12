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

$container['UsuarioController'] = function($container) {
    return new App\Controllers\UsuarioController($container);
};

$container['FotoController'] = function($container) {
    return new App\Controllers\FotoController($container);
};
$container['TagController'] = function($container) {
    return new App\Controllers\TagController($container);
};

$container['ClienteController'] = function($container) {
    return new App\Controllers\ClienteController($container);
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
