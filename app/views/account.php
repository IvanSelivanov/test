<?php
/**
 * Created by PhpStorm.
 * User: zversus
 * Date: 30.11.17
 * Time: 21:42
 */
echo 'Осталось денег: ', $user->account()->amount;
?>
<form action="/account/withdraw/" method="post">
    <label>Сумма для снятия<input type="text" name="amount"></label>
    <input type="submit" value="Снять">
</form>
