<?php

use Project\Components\Router;
use Project\Components\Session;
use Project\Exceptions\Http\HttpForbiddenException;

require_once '../vendor/autoload.php';
require_once '../bootstrap/app.php';

$routes = require_once  '../routes.php';

$path = parse_url($_SERVER['REQUEST_URI'])['path'];

if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && $_POST['csrf'] !== Session::getInstance()->getCsrf()
    ) {
    // TODO move to before action?
        throw new Exception('Invalid CSRF');
    }

(new Router($routes, $path))->resolve();
