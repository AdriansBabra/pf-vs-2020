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

$this->title = 'All users';
?>
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