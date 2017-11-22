<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function Index($request, $response)
    {        
        return $this->view->render($response, 'home/home.twig');
    }
}