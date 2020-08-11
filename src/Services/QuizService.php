<?php
declare(strict_types=1);

namespace Project\Services;

use Project\Models\QuizModel;
class QuizService
{
    public function addQuiz(string $name): QuizModel
    {
        $quiz = new QuizModel();
        $quiz->name = $name;
        return $quiz;
    }
}


