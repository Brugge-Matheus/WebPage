<ul id="menu-list">
    <li><a href="/">
            Home</a>
    </li>

    <li><a href="/login">
            Login</a>
    </li>

    <li>
        <a href="/user/create">Create</a>
    </li>
</ul>

<div id="status-login">
    Bem vindo,
    <?php if(logged()): ?>
    <?= user()->firstName .' '. user()->lastName?> | <a href="/logout">Logout</a>
    <?php else: ?>
    visitante
    <?php endif ?>
</div>