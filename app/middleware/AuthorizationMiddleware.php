<?php

namespace App\Middleware;

use App\Domain\ErrorJson;

class AuthorizationMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        $openUrls = array("/","login");

        $_url = $request->getUri()->getPath();        

        if (in_array($_url, $openUrls) || isset($_SESSION["user"]))
        {
            $response = $next($request, $response);
        }
        else
        {
            $headerValueString = $request->getHeaderLine('Accept');            
            
            if(strpos($headerValueString, 'application/json') !== false || $request->isXhr())
            {
                $response = $response->withStatus(403)->withJson(new ErrorJson("Content Forbiden"));
            }
            else
            {
                $response = $response->withRedirect($this->container->router->pathFor('login'));
            }
        }

        return $response;
    }
}
