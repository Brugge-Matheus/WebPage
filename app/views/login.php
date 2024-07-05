<h2>Login</h2>
<?= getFlash('message')?>

<form action="/login" method="post">
    <input type="email" name="email" placeholder="Seu e-mail" value="matheusmilczwski@gmail.com">
    <input type="password" name="password" placeholder="Sua senha" value="">
    <input type="submit" value="Login">
</form>