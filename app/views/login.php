<h2>Login</h2>
<?= getFlash('message')?>

<?php if(!logged()):?>
<form action="/login" method="post">
    <input type="email" name="email" placeholder="Seu e-mail" value="<?= logged() ? user()->email : '' ?>">
    <input type="password" name="password" placeholder="Sua senha" value="">
    <input type="submit" value="Login">
</form>
<?php else: ?>
<?php redirect()?>
<?php endif ?>