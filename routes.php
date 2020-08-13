<?php
use Project\Components\Route;
use Project\Controllers\IndexController;

return [
    '/' =>new Route(\Project\Controllers\IndexController::class, 'index'),
    '/login' =>new Route(\Project\Controllers\AuthController::class, 'login'),
    '/register' =>new Route(\Project\Controllers\AuthController::class, 'register'),
    '/logout' =>new Route(\Project\Controllers\AuthController::class, 'logout'),

];