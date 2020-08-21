<?php

use Project\Components\Session;
use Project\Components\View;
use Project\Models\UserModel;

/**
 * @var View $this
 * @var UserModel $user
 */

$this->title = 'Dashboard';
// e = htmlspecialchars
$isQuizActive = (bool)Session::getInstance()->get(Session::KEY_CURRENT_ATTEMPT_ID);
?>;
<h1 class="text welcome center">Welcome to Dashboard, <?= e($user->name); ?></h1>
<?php if ($isQuizActive): ?>
<?php endif; ?>
<br/>
<quiz-main :user-name="'<?= e($user->name); ?>'" :p-is-quiz-active="<?= json_encode($isQuizActive); ?>">
</quiz-main>