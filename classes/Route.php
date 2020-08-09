<?php

class Route
{

    public static $validRoutes = array();

    public static function set($route, $function, $request)
    {
        if ($request === $_SERVER['REQUEST_METHOD']) {
            self::$validRoutes[] = $route;
            if (isset($_GET['url'])) {
                if ($_GET['url'] == $route) {
                    $function();
                }
            }
        }
    }
}

?>