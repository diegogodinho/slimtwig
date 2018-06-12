<?php

$app->get('/',function($request, $response) use ($container){
    return $container->view->render($response, 'public.twig');
})->setName('public');

$app->get('/restrict', 'HomeController:Index')->setName('home');
$app->get('/restrict/login', 'LoginController:Index')->setName('login');
$app->post('/restrict/login', 'LoginController:Login');

$app->group('/restrict', function() {
    //usuario
    $this->get('/usuario', 'UsuarioController:IndexView')->setName('usuario.indexview');
    $this->post('/usuario', 'UsuarioController:All')->setName('usuario');
    $this->get('/usuario/new', 'UsuarioController:CreateView')->setName('usuario.createview');
    $this->post('/usuario/new', 'UsuarioController:Create')->setName('usuario.create');
    $this->get('/usuario/{id}', 'UsuarioController:EditView')->setName('usuario.editview');
    $this->post('/usuario/{id}', 'UsuarioController:Update')->setName('usuario.edit');
    $this->post('/usuario/actdeact/{id}', 'UsuarioController:ActivateDeactivate')->setName('usuario.actdeact');
    $this->get('/logout', 'LoginController:LogOut')->setName('logout');    
    //Foto    
    $this->get('/foto', 'FotoController:IndexView')->setName('foto.indexview');
    $this->post('/foto', 'FotoController:All')->setName('foto');
    $this->get('/foto/new', 'FotoController:CreateView')->setName('foto.createview');
    $this->post('/foto/new', 'FotoController:Create')->setName('foto.create');
    $this->post('/foto/del/{id}', 'FotoController:Delete')->setName('foto.del');    
    $this->post('/foto/setwatermark', 'FotoController:SetWaterMark')->setName('foto.setwatermark');    
    //Tags
    $this->get('/tag', 'TagController:IndexView')->setName('tag.indexview');
    $this->post('/tag', 'TagController:All')->setName('tag');
    $this->get('/tag/new', 'TagController:CreateView')->setName('tag.createview');
    $this->post('/tag/new', 'TagController:Create')->setName('tag.create');
    $this->get('/tag/{id}', 'TagController:EditView')->setName('tag.editview');
    $this->post('/tag/{id}', 'TagController:Update')->setName('tag.edit');
    $this->post('/tag/actdeact/{id}', 'TagController:ActivateDeactivate')->setName('tag.actdeact');
})->add(new App\Middleware\AuthorizationMiddleware($container));
$app->add(new App\Middleware\ValidationErrorsMiddleware($container));
$app->add(new App\Middleware\OldMiddleware($container));