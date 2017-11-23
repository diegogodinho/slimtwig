<?php

namespace App\Controllers;

use App\Domain\Question;

class HomeController extends BaseController
{
    public function Index($request, $response)
    {

        // echo 'diego';
        // die();
        return $this->view->render($response, 'home/home.twig');
    }
}