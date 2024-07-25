<?php $this->layout('master', ['title' => $title]) ?>

<?= getFlash('upload_error') ?? getFlash('upload_success', 'success') ?>
<?= getFlash('updated_error') ?? getFlash('updated_success', 'success') ?>


<form class="row g-3" method="post" action="/user/<?= $user->id ?>">
    <div class="col-auto">
        <input type="text" name="firstName" class="form-control" placeholder="Nome" value="<?= $user->firstName ?>">
        <?= getFlash('firstName') ?>
    </div>

    <div class="col-auto">
        <input type="text" name="lastName" class="form-control" placeholder="Sobrenome" value="<?= $user->lastName ?>">
        <?= getFlash('lastName') ?>
    </div>

    <div class="col-auto">
        <input type="email" name="email" class="form-control" placeholder="Email" value="<?= $user->email ?>">
        <?= getFlash('email') ?>
    </div>

    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Atualizar</button>
    </div>
</form>

<hr>

<?= getFlash('different_password') ?>
<?= getFlash('error_updated_password') ?? getFlash('success_updated_password', 'success') ?>

<form class="row g-3" method="post" action="/user/password/<?= $user->id ?>">
    <?= getCsrf() ?>

    <div class="col-auto">
        <input type="password" name="password" class="form-control" placeholder="Senha">
        <?= getFlash('password') ?>
    </div>

    <div class="col-auto">
        <input type="password" name="confirm_password" class="form-control" placeholder="Confirme a senha">
        <?= getFlash('confirm_password') ?>
    </div>

    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Atualizar</button>
    </div>
</form>

<hr>

<?php if ($user->path) : ?>
    <img class="img-thumbnail" src="/<?= $user->path ?>" alt="Foto-de-perfil">
<?php endif ?>


<form action="/user/image/update" method="post" enctype="multipart/form-data">

    <div class="mb-3">
        <label for="file" class="form-label">Clique para alterar a foto do perfil</label>
        <input class="form-control" type="file" name="file" accept="image/jpeg, image/png">
    </div>

    <input type="submit" class="btn btn-primary" value="Alterar foto">
</form>