<?php

namespace App\Controllers;

use App\Domain\Question;

class HomeController extends BaseController
{
    public function Index($request, $response)
    {              
        

        // foreach ($_SESSION['user']["permissoes"] as $key => $value) {            
        //     var_dump($value['url']);
        // }
        
        // die();




        return $this->view->render($response, 'home/home.twig');
    }
}