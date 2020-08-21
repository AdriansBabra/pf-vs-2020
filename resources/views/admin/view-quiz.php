<?php

use Project\Components\ActiveUser;
use Project\Components\Session;
use Project\Components\View;
use Project\Models\AnswerModel;
use Project\Models\QuestionModel;
use Project\Models\QuizModel;
use Project\Models\UserModel;

/**
 * @var View $this
 * @var UserModel $user
 * @var QuizModel $quiz
 * @var AnswerModel $answers
 * @var QuestionModel $question
 */

$this->title = "Quiz: " . e($quiz->name);

?>
<h2 class="mt-3 align-items-center">
    Quiz name:
    <?= e($quiz->name); ?>
</h2>
<h3>All questions</h3>
<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Question title</th>
        <th>Answers</th>
        <th>Correct answer</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($quiz->questions as $question): ?>
        <tr>
            <td><?= $question->id; ?></td>
            <td><?= e($question->title); ?></td>
            <td><?php
                foreach ($answers as $answer){
                  if($answer->question_id === $question->id){
                    echo $answer->title;
                    echo(" / ");
                  }
                }
                ?></td>
            <td><?php
                foreach ($answers as $answer){
                if($answer->question_id === $question->id){
                    if($answer->is_correct === 1)
                        echo $answer->title;
                }
                }
                ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<hr class="my-4">

<h4>Danger zone:</h4>

<form action="/admin/delete-quiz" method="post">
    <input type="hidden" name="csrf" value="<?= e(Session::getInstance()->getCsrf()); ?>">
    <input type="hidden" name="id" value="<?= $quiz->id ?>">
    <button type="submit" class="btn btn-danger">
        Delete quiz
    </button>
</form>