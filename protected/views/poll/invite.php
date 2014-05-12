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

    Список доступных голосований: <?php echo CHtml::dropDownList('pollId', array(), CHtml::listData($polls, 'id', function($data) { return '#'.$data->id.' '.$data->name; } )) ?><br>
    <textarea name="message" style="width: 100%; height: 400px;"><?=$message?></textarea>
    <br>
    <input type="submit" name="invite" value="invite">

</form>