<?php

/**
 * @var string $error;
 * @var View $this;
 */

use Project\Components\Session;

$this->title = 'Login'
?>
<?php if ($error): ?>
    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
<?php endif; ?>

<form action="/login" method="post">
    <input type="hidden" name="csrf" value="<?= e(Session::getInstance()->getCsrf()) ?>">
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <small id="emailHelp" class="form-text text-muted">We will always share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
    </div>
    <button type="submit" class="btn btn-primary">Sign in</button>
</form>
