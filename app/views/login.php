<?php $this->layout('master', ['title' => $title]) ?>

<h2>Login</h2>

<?= getFlash('message') ?>
<?php if (!logged()) : ?>
<form action="/login" method="post">
    <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control">
    </div>

    <input type="submit" class="btn btn-primary" value="Login">
</form>
<?php else : ?>
<?php redirect() ?>
<?php endif ?>