<?php

namespace App\Middleware;
use App\Domain\TipoUsuario;
use \App\Domain\ErrorJson;

class PermissionMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        $route = $request->getAttribute('route');
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
        //var_dump($route->getPattern());
        //die();
        if ($this->_usuarioTemPermissao($route->getPattern())) {
            $response = $next($request, $response);
        } else {
            $headerValueString = $request->getHeaderLine('Accept');
            if(strpos($headerValueString, 'application/json') !== false || $request->isXhr())
            {
                $response = $response->withStatus(406)->withJson(new ErrorJson("Desculpe, mas voce nao tem acesso a essa funcionalidade. 
                                                                               Por favor contate o administrador do sistema."));
            }
            else
            {                
                $this->container->flash->addMessage('message', 'Desculpe mas mas seu usuario nao possui acesso a essa funcionalidade');
                $response = $response->withRedirect($this->container->router->pathFor('home'));
            }            
        }
        return $response;
    }

    private function _usuarioTemPermissao($url)
    {
        $usuario = $_SESSION['user'];
        if ($usuario['tipousuario'] >= \App\Domain\TipoUsuario::Gerente)
        {
            return true;
        }        

        foreach ($_SESSION['user']['permissoes'] as $key => $value) {
            if ($url == $value['url']) {
                return true;
            }
        }

        return false;
    }
}
