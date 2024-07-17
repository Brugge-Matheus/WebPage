<?php $this->layout('master', ['title' => $title]) ?>

<h2>Create</h2>

<?= getFlash('message') ?>

<form action="/user/action" method="post">
    <?= getCsrf() ?>

    <input type="text" name="firstName" placeholder="Seu nome" value="<?= getOld('firstName') ?>">
    <?= getFlash('firstName') ?>
    <br>
    <input type="text" name="lastName" placeholder="Seu sobrenome" value="<?= getOld('lastName') ?>">
    <?= getFlash('lastName') ?>
    <br>
    <input type=" text" name="email" placeholder="Seu email" value="<?= getOld('email') ?>">
    <?= getFlash('email') ?>
    <br>
    <input type=" password" name="password" placeholder="Sua senha">
    <?= getFlash('password') ?>
    <br>

    <input type="submit" value="Criar">
</form>