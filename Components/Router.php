<?php

namespace Components;

class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT.'/Routes/api.php';
        $this->routes = include($routesPath);
    }

    public function run(){
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path){
            if (preg_match("~$uriPattern~", $uri)){

                $segments = explode('/', $path);

                $controllerName = array_shift($segments).'Controller';
                $controllerName = "App\\Controllers\\". ucfirst($controllerName);
                $actionName = 'action'.ucfirst(array_shift($segments));

                $controllerObject = new $controllerName;
                $result = $controllerObject->$actionName();
                if ($result != null){
                    break;
                }
            }
        }
    }

    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

}