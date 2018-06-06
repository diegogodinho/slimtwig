<?php

$app->get('/', 'HomeController:Index')->setName('home');

$app->get('/login', 'LoginController:Index')->setName('login');
$app->post('/login', 'LoginController:Login');
$app->get('/Picture/Test', 'PictureController:CreateImageTest');
$app->post('/Picture/SavePicture', 'PictureController:SaveImage');
$app->get('/Picture', 'PictureController:Index');

$app->group('', function() {
    $this->get('/login/logout', 'LoginController:LogOut')->setName('logout');
    
    $this->get('/signup', 'UserController:SignUp')->setName('signup');
    $this->post('/signup', 'UserController:Create');
    
    $this->get('/user', 'UserController:Index')->setName('user.index');
    
    $this->post('/user/list', 'UserController:All')->setName('user.list');
    
    $this->get('/user/{id}', 'UserController:Edit')->setName('user.edit');
    $this->post('/user/{id}', 'UserController:Update');
    
    $this->post('/user/del/{id}', 'UserController:Delete')->setName('user.del');

})->add(new App\Middleware\AuthorizationMiddleware($container));
$app->add(new App\Middleware\ValidationErrorsMiddleware($container));
$app->add(new App\Middleware\OldMiddleware($container));
