<?php $this->layout('master', ['title' => $title]) ?>

<h2>Create</h2>
<hr>
<?= getFlash('message') ?>

<form action="/user/action" method="post">
    <?= getCsrf() ?>

    <div class="mb-3">
        <label for="firstName" class="form-label">Nome:</label>
        <input type="firstName" class="form-control" name="firstName" aria-describedby="emailHelp"
            value="<?= getOld('firstName') ?>" placeholder="Seu nome">
        <?= getFlash('firstName') ?>
    </div>

    <div class="mb-3">
        <label for="lastName" class="form-label">Sobrenome:</label>
        <input type="lastName" class="form-control" name='lastName' value="<?= getOld('lastName') ?>"
            placeholder="Seu sobrenome">
        <?= getFlash('lastName') ?>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">E-mail:</label>
        <input type="email" class="form-control" name='email' value="<?= getOld('email') ?>" placeholder="Seu E-mail">
        <?= getFlash('email') ?>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Senha:</label>
        <input type="password" name='password' class="form-control" placeholder="Sua senha">
        <?= getFlash('password') ?>
    </div>

    <input type="submit" class="btn btn-primary" value="Criar">
</form>