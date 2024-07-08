<ul id="menu-list">
    <li><a href="/">
            Home</a>
    </li>

    <?php if(!logged()): ?>
    <li><a href="/login">
            Login</a>
    </li>

    <li>
        <a href="/user/create">Create</a>
    </li>
    <?php endif; ?>
</ul>

<div id="status-login">
    Bem vindo,
    <?php if(logged()): ?>
    <?= user()->firstName .' '. user()->lastName?> | <a href="/logout">Logout</a>
    <?php else: ?>
    visitante
    <?php endif ?>
</div>