<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?= $_SERVER['REQUEST_URI'] == "/" ? 'active' : '' ?>" aria-current="page" href="/">Home</a>
    </li>
    <?php if (!logged()) : ?>
    <li class="nav-item">
        <a class="nav-link <?= $_SERVER['REQUEST_URI'] == "/login" ? 'active' : '' ?>" href="/login">Login</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= $_SERVER['REQUEST_URI'] == "/user/create" ? 'active' : '' ?>"
            href="/user/create">Create</a>
    </li>
    <?php endif; ?>
</ul>

<div id="status-login">
    Bem vindo,
    <?php if (logged()) : ?>
    <?= user()->firstName . ' ' . user()->lastName ?> | <a href="/logout">Logout</a>
    <?php else : ?>
    visitante
    <?php endif ?>
</div>