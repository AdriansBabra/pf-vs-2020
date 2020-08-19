<?php
use Project\Components\Route;
use Project\Controllers\IndexController;
use Project\Controllers\AdminController;
use Project\Controllers\AuthController;
use Project\Controllers\QuizRpcController;

return [
    '/' =>new Route(IndexController::class, 'index'),
    '/login' =>new Route(\Project\Controllers\AuthController::class, 'login'),
    '/register' =>new Route(\Project\Controllers\AuthController::class, 'register'),
    '/logout' =>new Route(\Project\Controllers\AuthController::class, 'logout'),
    '/dashboard' => new Route(IndexController::class, 'dashboard'),
    '/admin' => new Route(\Project\Controllers\AdminController::class, 'index'),
    '/admin/toggle-user-admin' => new Route(AdminController::class, 'toggleUserAdmin', [Route::METHOD_POST]),
    '/admin/delete-user' => new Route(AdminController::class, 'deleteUser', [Route::METHOD_POST]),
    '/admin/view-user' => new Route(AdminController::class, 'viewUser'),
    '/quiz-rpc/get-all' => new Route(QuizRpcController::class, 'getAll')
];