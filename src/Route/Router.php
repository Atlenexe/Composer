<?php

namespace Route;

class Router
{
    public $routes = [];

    public function defineRoute(string $method, string $url, mixed $controller, string $methodName): void
    {
        if ($_SERVER['REQUEST_METHOD'] === $method && $_SERVER['REQUEST_URI'] === $url) {
            $this->executeAction($controller, $methodName);
            $this->addRoute($method, $url, $controller, $methodName);
        }
    }

    public function checkRoute(): void
    {
        if (count($this->routes) === 0) {
            echo "Error 404: Page not found";
        }
    }

    public function addRoute(string $url): void
    {
        $this->routes[] = $url;
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
