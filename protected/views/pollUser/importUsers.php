<?php
/**
 * Created by PhpStorm.
 * User: vavr
 * Date: 12.05.14
 * Time: 22:01
 * @var $this PollController
 */
if ($info) {
    var_dump($info);
}

?>
<form enctype="multipart/form-data" action="" method="post">

    CSV файл с первой колонкой email, второй именем пользователя: <input type="file" name="users">
    <input type="submit" name="import" value="import">

</form>