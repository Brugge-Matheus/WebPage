<h2>Users</h2>

<ul id="users-home">
    <?php foreach($users as $user): ?>

    <li><?=$user->firstName?> | <a href="/user/<?=$user->id?>">Detalhes</a></li>

    <?php endforeach?>
</ul>