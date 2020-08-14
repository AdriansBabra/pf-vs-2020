<?php


namespace Project\Repositories;


use Project\Models\QuizModel;

class QuizRepository
{

    public function getQuiz(string $name): QuizModel
    {

    }

    /**
     * @return QuizModel[]
     */
    public function getAll(): array
    {
        return QuizModel::query()->get()->all();
    }
}