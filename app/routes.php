<?php

$app->get('/', 'HomeController:Index')->setName('home');

$app->get('/login', 'LoginController:Index')->setName('login');

$app->get('/signup', 'UserController:SignUp')->setName('signup');
$app->post('/signup', 'UserController:Create');

$app->get('/user', 'UserController:Index')->setName('user.index');
$app->post('/user/list', 'UserController:All')->setName('user.list');

$app->add(new App\Middleware\ValidationErrorsMiddleware($container));
$app->add(new App\Middleware\OldMiddleware($container));
