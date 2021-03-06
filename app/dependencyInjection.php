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
$container['ItemImovelController'] = function($container) {
    return new App\Controllers\ItemImovelController($container);
};

$container['ClienteController'] = function($container) {
    return new App\Controllers\ClienteController($container);
};

$container['TipoImovelController'] = function($container) {
    return new App\Controllers\TipoImovelController($container);
};

$container['GrupoController'] = function($container) {
    return new App\Controllers\GrupoController($container);
};

$container['EstadoController'] = function($container) {
    return new App\Controllers\EstadoController($container);
};

$container['CidadeController'] = function($container) {
    return new App\Controllers\CidadeController($container);
};

$container['BairroController'] = function($container) {
    return new App\Controllers\BairroController($container);
};

$container['ConstrutoraController'] = function($container) {
    return new App\Controllers\ConstrutoraController($container);
};

$container['ProprietarioController'] = function($container) {
    return new App\Controllers\ProprietarioController($container);
};

$container['MidiaController'] = function($container) {
    return new App\Controllers\MidiaController($container);
};

$container['PropagandaVitrineController'] = function($container) {
    return new App\Controllers\PropagandaVitrineController($container);
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

    $view->getEnvironment()->addGlobal('foto', $container->FotoController);

    return $view;
};
