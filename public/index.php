<?php

use Dotenv\Dotenv;
use Illuminate\Database\Capsule\Manager as Capsule;
use Project\Models\QuizModel;

require_once '../vendor/autoload.php';

Dotenv::createImmutable(dirname(__DIR__))->load();

$capsule = new Capsule();
$capsule->addConnection(
    [
        "driver" => "mysql",
        "host" => env('DB_HOST'),
        "database" => env('DB_NAME'),
        "username" => env('DB_USER'),
        "password" => env('DB_PASS'),
    ]
);

//Make this Capsule instance available globally.
$capsule->setAsGlobal();

// Setup the Eloquent ORM.
$capsule->bootEloquent();

/** @var QuizModel $quiz */
$quiz = QuizModel::query()->where('id', '=', 1)->first();
echo "<h1>$quiz->name</h1>";
foreach ($quiz->questions as $question) {
    echo "$question->title {$question->quiz->name}<br/>";
}