<?php


namespace Project\Components;


use Exception;
use Project\Controllers\ErrorController;
use Project\Exceptions\Http\HttpForbiddenException;
use Project\Exceptions\Http\HttpMethodNotAllowedException;
use Project\Exceptions\Http\HttpNotFoundException;

class Router
{
    /** @var Route[] $routes ['path/to/controller/action' => Route] */
    private array $routes;
    private string $path;
    /**
     * @param Route[] $routes
     * @param string $path
     */
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
        try {
            $this->handleRoute($this->resolveRouteFromPathOrFail());
        } catch (HttpForbiddenException $exception) {
            http_response_code($exception->getCode());
            $this->handleRoute(new Route(ErrorController::class, 'forbidden'));
        } catch (HttpNotFoundException $exception) {
            http_response_code($exception->getCode());
            $this->handleRoute(new Route(ErrorController::class, 'notFound'));
        } catch (HttpMethodNotAllowedException $exception) {
            http_response_code($exception->getCode());
            $this->handleRoute(new Route(ErrorController::class, 'methodNotAllowed'));
        } catch (\Throwable $exception) {
            http_response_code(500);

            throw $exception;
        }
    }
    /**
     * @return Route
     * @throws HttpNotFoundException In case path doesn't correspond to any defined routes
     */
    private function resolveRouteFromPathOrFail(): Route
    {
        $route = $this->routes[$this->path] ?? null;
        if (!$route) {
            throw new HttpNotFoundException();
        }
        return $route;
    }
    /**
     * @param Route $route
     * @throws Exception
     * @throws HttpForbiddenException
     * @throws HttpNotFoundException
     * @noinspection PhpDocRedundantThrowsInspection
     */
    private function handleRoute(Route $route): void
    {
        // If allowed methods are set, check whether the actual method matches the defined ones
        if ($route->getAllowedMethods()) {
            $currentMethod = $_SERVER['REQUEST_METHOD'];
            if (!in_array($currentMethod, $route->getAllowedMethods())) {
                throw new HttpMethodNotAllowedException();
            }
        }
        if (!method_exists($route->getControllerClass(), $route->getAction())) {
            throw new Exception("Action '{$route->getAction()}' not found in '{$route->getControllerClass()}'");
        }
        $controllerClass = $route->getControllerClass();
        $controller = new $controllerClass();
        echo call_user_func([$controller, $route->getAction()]);
    }
}