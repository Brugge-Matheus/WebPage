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
    <?=
        $_SESSION['logged'] ? 'Bem-vindo - ' .$_SESSION['logged']['firstName'] .' '. $_SESSION['logged']['lastName'] : 'Bem-vindo Visitante';
    ?>
    <!-- Bem vindo, Visitante! -->
</div>