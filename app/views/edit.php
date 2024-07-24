<?php $this->layout('master', ['title' => $title]) ?>
<?= getFlash('upload_error') ?? getFlash('upload_success', 'success') ?>

<form action="/user/image/update" method="post" enctype="multipart/form-data">

    <div class="mb-3">
        <label for="file" class="form-label">Clique para alterar a foto do perfil</label>
        <input class="form-control" type="file" name="file" accept="image/jpeg, image/png">
    </div>

    <input type="submit" class="btn btn-primary" value="Alterar foto">
</form>