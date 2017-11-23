<?php

$app->get('/', 'HomeController:Index');

$app->get('/login', 'LoginController:Index')->setName('user.signUp');