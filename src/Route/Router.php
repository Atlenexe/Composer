<?php

namespace Route;

class Router
{
    protected $routes = [];

    public function defineRoute(string $method, string $url, mixed $controller, string $methodName): void
    {
        if ($_SERVER['REQUEST_METHOD'] === $method && $_SERVER['REQUEST_URI'] === $url) {
            $this->executeAction($controller, $methodName);
        }
    }

    public function addRoute(string $method, string $url, mixed $controller, string $methodName): void
    {
        $this->routes[] = [
            'method' => $method,
            'url' => $url,
            'controller' => $controller,
            'methodName' => $methodName
        ];
    }

    private function executeAction(mixed $controller, string $methodName): void
    {
        $controllerInstance = new $controller();

        if (!method_exists($controllerInstance, $methodName)) {
            throw new \Exception("Method {$methodName} does not exist on {$controller}");
        }

        $controllerInstance->$methodName();
    }
}
