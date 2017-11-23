<?php

$app->get('/', 'HomeController:Index');

$app->get('/user', 'UserController:Index')->setName('user.signUp');