<?php

$app->get('/', 'HomeController:Index')->setName('home');

$app->get('/login', 'LoginController:Index')->setName('login');
$app->post('/login', 'LoginController:Login');


$app->group('', function() {
    //User
    $this->get('/user', 'UserController:IndexView')->setName('user.indexview');
    $this->post('/user', 'UserController:All')->setName('user');
    $this->get('/user/new', 'UserController:CreateView')->setName('user.createview');
    $this->post('/user/new', 'UserController:Create')->setName('user.create');
    $this->get('/user/{id}', 'UserController:EditView')->setName('user.editview');
    $this->post('/user/{id}', 'UserController:Update')->setName('user.edit');
    $this->post('/user/del/{id}', 'UserController:Delete')->setName('user.del');
    $this->get('/logout', 'LoginController:LogOut')->setName('logout');    
    //Foto    
    $this->get('/foto', 'FotoController:IndexView')->setName('foto.indexview');
    $this->post('/foto', 'FotoController:All')->setName('foto');
    $this->get('/foto/new', 'FotoController:CreateView')->setName('foto.createview');
    $this->post('/foto/new', 'FotoController:Create')->setName('foto.create');
    $this->post('/foto/del/{id}', 'FotoController:Delete')->setName('foto.del');
    $this->get('/foto/watermark', 'FotoController:Watermark')->setName('foto.watermarkview');
    $this->post('/foto/watermark', 'FotoController:WatermarkCreate')->setName('foto.watermark.create');
})->add(new App\Middleware\AuthorizationMiddleware($container));
$app->add(new App\Middleware\ValidationErrorsMiddleware($container));
$app->add(new App\Middleware\OldMiddleware($container));
