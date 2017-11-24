<?php

$app->get('/', 'HomeController:Index')->setName('home');

$app->get('/login', 'LoginController:Index')->setName('login');

$app->get('/signup', 'UserController:SignUp')->setName('signup');
$app->post('/signup', 'UserController:Create');