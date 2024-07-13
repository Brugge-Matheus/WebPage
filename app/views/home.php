<?php $this->layout('master', ['title' => $title]) ?>

<h2>Users</h2>

<?= getFlash('message', 'color:green') ?>
<ul id="users-home">
    <?php if (logged()) : ?>
    <?php foreach ($users as $user) : ?>

    <li><?= $user->firstName ?> | <a href="/user/<?= $user->id ?>">Detalhes</a> | <a
            href="editar/<?= $user->id ?>">Editar</a> | <a href="excluir/<?= $user->id ?>"
            onclick="return confirm('Deseja realmente apagar esse usúario')">Excluir</a>
    </li>

    <?php endforeach ?>
    <?php else : ?>
    <h3>Faça Login para ver os usúarios</h3>
    <?php endif; ?>
</ul>

<?php $this->start('scripts') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js"
    integrity="sha512-JSCFHhKDilTRRXe9ak/FJ28dcpOJxzQaCd3Xg8MyF6XFjODhy/YMCM8HW0TFDckNHWUewW+kfvhin43hKtJxAw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
async function loadUser() {

    try {
        const {data} = await axios.get('/users');

    } catch (error) {
        console.log(error);
    }
}
</script>

<?php $this->stop('scripts') ?>