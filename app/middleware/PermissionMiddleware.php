<?php

namespace App\Middleware;

class PermissionMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        // $route = $request->getAttribute('route');
        // $routeName = $route->getName();
        // $groups = $route->getGroups();
        // $methods = $route->getMethods();
        // $arguments = $route->getArguments();
        //var_dump($route);
        // var_dump("Route Info: " . print_r($route, true));
        // var_dump("Route Name: " . print_r($routeName, true));
        // var_dump("Route Groups: " . print_r($groups, true));
        // var_dump("Route Methods: " . print_r($methods, true));
        // var_dump("Route Arguments: " . print_r($arguments, true));
        //var_dump($request->isXhr());
        //var_dump($request->getUri()->getPath());
        //var_dump($_SESSION['user']['permissoes']);
        if ($this->_usuarioTemPermissao($request->getUri()->getPath())) {
            $response = $next($request, $response);
        } else {
            if(strpos($headerValueString, 'application/json') !== false || $request->isXhr())
            {
                $response = $response->withStatus(403)->withJson(new ErrorJson("Desculpe, mas voce nao tem acesso a essa funcionalidade. Por favor contate o administrador do sistema."));
            }
            else
            {                
                $response = $response->withRedirect($this->container->router->pathFor('home'));
            }            
        }
        return $response;
    }

    private function _usuarioTemPermissao($url)
    {
        foreach ($_SESSION['user']['permissoes'] as $key => $value) {
            //var_dump($value['url'] .' == '. $url);
            if ($value['url'] == $url) {
                return true;
            }
        }
        return false;
    }
}
