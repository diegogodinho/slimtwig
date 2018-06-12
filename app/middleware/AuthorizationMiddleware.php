<?php

namespace App\Middleware;

use App\Domain\ErrorJson;

class AuthorizationMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        if (isset($_SESSION["user"]))
        {
            $response = $next($request, $response);
        }
        else
        {
            $headerValueString = $request->getHeaderLine('Accept');
            $this->container->flash->addMessage('message','Sessao expirada');

            if(strpos($headerValueString, 'application/json') !== false || $request->isXhr())
            {
                $response = $response->withStatus(403)->withJson(new ErrorJson("Conteudo Proibido"));
            }
            else
            {                
                $response = $response->withRedirect($this->container->router->pathFor('login'));
            }
        }

        return $response;
    }
}
