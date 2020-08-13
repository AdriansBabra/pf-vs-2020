<?php


namespace Project\Components;


use Exception;
use Project\Controllers\ErrorController;

class Router
{
    /** @var Route[] $routes */
    private array $routes;
    private string $path;

    public function __construct(array $routes, string $path)
    {

        $this->routes = $routes;
        $this->path = $path;
    }

    /**
     * @throws Exception
     */
    public function resolve(): void
    {
        $route = $this->routes[$this->path] ?? new Route(ErrorController::class, 'notFound');
        if (!method_exists($route->getControllerClass(), $route->getAction())) {
            throw new Exception("Action '{$route->getAction()}' not found in '{$route->getControllerClass()}'");
        }

        echo call_user_func([$route->getControllerClass(), $route->getAction()]);
    }
}