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
    '/admin/delete-quiz' => new Route(AdminController::class, 'deleteQuiz', [Route::METHOD_POST]),
    '/admin/view-user' => new Route(AdminController::class, 'viewUser'),
    '/admin/view-quiz' => new Route(AdminController::class, 'viewQuiz'),
    '/admin/view-attempt' => new Route(AdminController::class, 'viewAttempt'),
    '/quiz-rpc/get-all' => new Route(QuizRpcController::class, 'getAll'),
    '/quiz-rpc/start' => new Route(QuizRpcController::class, 'startQuiz'),
    '/quiz-rpc/get-question' => new Route(QuizRpcController::class, 'getQuestion'),
    '/quiz-rpc/save-answer' => new Route(QuizRpcController::class, 'saveAnswer'),
    '/quiz-rpc/get-results' => new Route(QuizRpcController::class, 'getResults'),
];