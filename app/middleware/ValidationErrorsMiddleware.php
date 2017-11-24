<?php

namespace App\Middleware;

class ValidationErrorsMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        if (isset($_SESSION['validation_erros']))
        {
            $this->container->view->getEnvironment()->addGlobal('errors', $_SESSION['validation_erros']);
            unset($_SESSION['validation_erros']);
        }
        $response = $next($request, $response);
        return $response;
    }
}
