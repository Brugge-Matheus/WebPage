<?php $this->layout('master', ['title' => $title]) ?>

<h2>Users</h2>

<?=getFlash('message', 'color:green')?>
<ul id="users-home">
    <?php if(logged()): ?>
    <?php foreach($users as $user): ?>

    <li><?=$user->firstName?> | <a href="/user/<?=$user->id?>">Detalhes</a> | <a href="editar/<?=$user->id?>">Editar</a>
    </li>

    <?php endforeach?>
    <?php else: ?>
    <h3>Faça Login para ver os usúarios</h3>
    <?php endif; ?>
</ul>