<?php

use Project\Components\View;
use Project\Models\UserModel;

/**
 * @var View $this
 * @var UserModel $user
 */

$this->title = 'Dashboard';
// e = htmlspecialchars
?>

<h1>Welcome to Dashboard, <?= e($user->name); ?></h1>

<quiz-main :user-name="'<?= e($user->name); ?>'"></quiz-main>