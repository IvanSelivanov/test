<?php

echo 'Добро пожаловать, '.$user->name;
echo '
<form action="/users/sign_out">
    <input type="submit" value="Выход">
</form>
<a href="/account">Личный кабинет</a>';