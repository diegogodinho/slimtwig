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
        
        //var_dump($request->getUri()->getPath());
        $response = $next($request, $response);
        return $response;
    }
}
