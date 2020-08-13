<?php
use Project\Components\Route;
use Project\Controllers\IndexController;

return [
    '/' =>new Route(\Project\Controllers\IndexController::class, 'index'),
    '/auth/login' =>new Route(\Project\Controllers\AuthController::class, 'login'),
];