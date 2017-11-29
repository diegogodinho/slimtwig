<?php

$app->get('/', 'HomeController:Index')->setName('home');

$app->get('/login', 'LoginController:Index')->setName('login');
$app->post('/login', 'LoginController:Login');

$app->get('/login/logout', 'LoginController:LogOut')->setName('logout');

$app->get('/signup', 'UserController:SignUp')->setName('signup');
$app->post('/signup', 'UserController:Create');

$app->get('/user', 'UserController:Index')->setName('user.index');

$app->post('/user/list', 'UserController:All')->setName('user.list');

$app->get('/user/{id}', 'UserController:Edit')->setName('user.edit');
$app->post('/user/{id}', 'UserController:Update');

$app->post('/user/del/{id}', 'UserController:Delete')->setName('user.del');

$app->add(new App\Middleware\AuthorizationMiddleware($container));
$app->add(new App\Middleware\ValidationErrorsMiddleware($container));
$app->add(new App\Middleware\OldMiddleware($container));
