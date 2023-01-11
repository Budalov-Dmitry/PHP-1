<?php if ($auth): ?>
    Добро пожаловать <?=$user?> <a href="/logout">[Выход]</a>
<?php else:?>
    <form action="/login" method="post">
        <input type="text" name="login">
        <input type="password" name="pass">
        Save? <input type='checkbox' name='save'>
        <input type="submit" name="ok">
    </form>
<?php endif;?><br>
<a href="/">Главная</a>
<a href="/catalog">товары</a>
<a href="/basket">корзина(<?=$count?>)</a>
<a href="/orders">заказы</a><br>