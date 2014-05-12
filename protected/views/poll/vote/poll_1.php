<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h4>Согласны ли Вы с переходом на новый учебник по математике (автор Петерсон Людмила Георгиевна)</h4>

<form action="" method="post">

    <input type="radio" name="vote[choise]" value="yes" checked="checked">Да<br>
    <input type="radio" name="vote[choise]" value="no">Нет<br><br>
    <input type="submit" name="vote[submit]" value="Отправить">
</form>