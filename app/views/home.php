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

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.js"
    integrity="sha512-vHNHepeQWwAggJlhEk932jRS5sNdn/Nn4F+w4TpXW5dA+04qnd3e7YpfXo6auWhFG6z3FVhmScG4ovtF+qYeZw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
axios.defaults.headers = {
    HTTP_X_REQUESTED_WITH: "XMLHttpRequest",
}
async function loadUser() {

    try {
        const {
            data
        } = await axios.get('/users');
        console.log(data);

    } catch (error) {
        console.log(error);
    }
}

loadUser();
</script>

<?php $this->stop() ?>