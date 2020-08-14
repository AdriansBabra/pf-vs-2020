<?php
use Project\Components\Route;
use Project\Controllers\IndexController;
use Project\Controllers\AdminController;
use Project\Controllers\AuthController;

return [
    '/' =>new Route(IndexController::class, 'index'),
    '/login' =>new Route(\Project\Controllers\AuthController::class, 'login'),
    '/register' =>new Route(\Project\Controllers\AuthController::class, 'register'),
    '/logout' =>new Route(\Project\Controllers\AuthController::class, 'logout'),
    '/dashboard' => new Route(IndexController::class, 'dashboard'),
    '/admin' => new Route(\Project\Controllers\AdminController::class, 'index')
];