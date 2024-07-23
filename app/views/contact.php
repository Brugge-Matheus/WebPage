<?php $this->layout('master', ['title' => $title]); ?>

<?= getFlash('contact_sucess', 'success') ?? getFlash('contact_error') ?>

<h2>Contato</h2>

<form action="/contact" method="post">
    <?= getCsrf() ?>
    <div class="mb-3">
        <label for="name" class="form-label">Nome:</label>
        <input type="text" class="form-control" name="name" aria-describedby="emailHelp" value="<?= getOld('name') ?>">
        <?= getFlash('name') ?>
    </div>

    <div class="mb-3">
        <label class="form-label">E-mail:</label>
        <input type="email" class="form-control" name='email' value="<?= getOld('email') ?>">
        <?= getFlash('email') ?>
    </div>

    <div class="mb-3">
        <label class="form-label">Assunto:</label>
        <input type="text" class="form-control" name='subject' value="<?= getOld('subject') ?>">
        <?= getFlash('subject') ?>
    </div>

    <div class="form-floating">
        <textarea class="form-control" name="message" style="height: 150px"><?= getOld('subject') ?></textarea>
        <label for="floatingTextarea2">Escreva a mensagem do e-mail</label>
    </div>
    <?php getFlash('message') ?>
    <br>

    <input type="submit" class="btn btn-primary" value="Enviar">
</form>