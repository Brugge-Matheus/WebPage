<?php $this->layout('master', ['title' => $title]) ?>

<?php if (logged()) : ?>
<h2>Users (<?= $users->count ?>)</h2>
<hr>
<?php endif ?>


<?php if (logged()) : ?>
<form class="row g-3" action="/" method="get">
    <div class="col-auto">
        <label for="s" class="visually-hidden">Password</label>
        <input type="text" name="s" class="form-control" placeholder="Digite oque deseja pesquisar">
    </div>

    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Pesquisar</button>
    </div>
</form>
<?php endif ?>
<br>

<?= getFlash('message', 'success') ?>
<?php if (logged()) : ?>
<ul id="users-home">
    <?php foreach ($users->rows as $user) : ?>

    <li><?= $user->firstName ?> | <a href="/user/<?= $user->id ?>">Detalhes</a> | <a
            href="editar/<?= $user->id ?>">Editar</a> | <a href="excluir/<?= $user->id ?>"
            onclick="return confirm('Deseja realmente apagar esse usúario')">Excluir</a>
    </li>

    <?php endforeach ?>
</ul>
<?php else : ?>
<h3>Faça Login para ver os usúarios</h3>
<?php endif; ?>


<?= (logged()) ? $links : '' ?>