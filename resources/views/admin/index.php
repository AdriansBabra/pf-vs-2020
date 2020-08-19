<?php

use Project\Components\View;
use \Project\Models\UserModel;
use \Project\Models\QuizModel;
/**
 * @var View $this
 * @var UserModel[] $users
 * @var QuizModel[] $quizzes
 */

$this->title = 'Admin panel';
?>

<h1>Admin panel</h1>

<h2>All users</h2>
<table class="table">
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
<h2>All quizzes</h2>
<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Question count</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($quizzes as $quiz): ?>
        <tr>
            <td><?= $quiz->id; ?></td>
            <td><?= e($quiz->name); ?></td>
            <td><?= $quiz->questions()->count(); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

