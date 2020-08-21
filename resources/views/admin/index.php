<?php

use Project\Components\View;
use Project\Models\AnswerModel;
use \Project\Models\UserModel;
use \Project\Models\QuizModel;
use Project\Models\UserQuizAttemptModel;

/**
 * @var View $this
 * @var UserModel[] $users
 * @var QuizModel[] $quizzes
 * @var AnswerModel $answers
 * @var UserQuizAttemptModel $attempts
 */

$this->title = 'Admin panel';
?>
<body>
</body>
<h1 class="text center title">Admin panel</h1>

<h2 class="center text title">All users</h2>
<div class="table-wrapper">
    <table class="fl-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Name</th>
        <th>Joined at</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user->id; ?></td>
            <td><?= e($user->email); ?></td>
            <td><?= e($user->name); ?></td>
            <td><?= $user->created_at; ?></td>
            <td>
                <a class="btn btn-sm btn-success" href="/admin/view-user?id=<?= urlencode($user->id); ?>">
                    View
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
<h2 class="center text title">All quizzes</h2>
<div class="table-wrapper">
    <table class="fl-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Quiz title</th>
        <th>Question Count</th>
        <th></th>

    </tr>
    </thead>
    <tbody>
    <?php foreach ($quizzes as $quiz): ?>
        <tr>
            <td><?= $quiz->id; ?></td>
            <td><?= e($quiz->name); ?></td>
            <td><?= $quiz->questions()->count(); ?></td>
            <td>
            <a class="btn btn-sm btn-success" href="/admin/view-quiz?id=<?= urlencode($quiz->id); ?>">
                View
            </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>

</table>
<h2 class="center text title">All attempts</h2>
<div class="table-wrapper">
    <table class="fl-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>User</th>
        <th>Quiz</th>
        <th>Started at</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($attempts as $attempt): ?>
        <tr>
            <td><?= $attempt->id; ?></td>
            <td>
                <?php
                foreach ($users as $user){
                    if($user->id === $attempt->user_id){
                        echo $user->name;
                    }
                }
                ?>
            </td>
            <td>
                <?php
                foreach ($quizzes as $quiz){
                    if($quiz->id === $attempt->quiz_id){
                        echo $quiz->name;
                    }
                }
                ?>
            </td>
            <td><?= $attempt->started_at; ?></td>
            <td>
                <a class="btn btn-secondary" href="/admin/attempt-view?id=<?= urlencode($attempt->id); ?>">
                    View
                </a>
            </td>
        </tr>
    </tbody>
    <?php endforeach; ?>
</table>