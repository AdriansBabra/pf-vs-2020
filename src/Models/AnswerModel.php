<?php


namespace Project\Models;


class AnswerModel
{
    public int $id;

    public string $questionId;

    public string $title;

    public bool $isCorrect;
}