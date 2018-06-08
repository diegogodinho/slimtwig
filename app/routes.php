<?php

$app->get('/', 'HomeController:Index')->setName('home');

$app->get('/login', 'LoginController:Index')->setName('login');
$app->post('/login', 'LoginController:Login');


$app->group('', function() {
    //TODO: Define Patter to Routes
    $this->get('/login/logout', 'LoginController:LogOut')->setName('logout');
    
    $this->get('/signup', 'UserController:SignUp')->setName('signup');
    $this->post('/signup', 'UserController:Create');
    
    $this->get('/user', 'UserController:Index')->setName('user.index');
    
    $this->post('/user/list', 'UserController:All')->setName('user.list');
    
    $this->get('/user/{id}', 'UserController:Edit')->setName('user.edit');
    $this->post('/user/{id}', 'UserController:Update');
    
    $this->post('/user/del/{id}', 'UserController:Delete')->setName('user.del');
    $this->post('/Foto/Save', 'FotoController:Create')->setName('fotosave');
    $this->get('/Foto', 'FotoController:Index')->setName('foto');
    $this->get('/Foto/NoCropper', 'FotoController:IndexNoCropper')->setName('uploadImageNoCropper');

})->add(new App\Middleware\AuthorizationMiddleware($container));
$app->add(new App\Middleware\ValidationErrorsMiddleware($container));
$app->add(new App\Middleware\OldMiddleware($container));
