<?php
/**
 * @var $this SiteController
 * @var Poll[] $polls
 */

$this->pageTitle=Yii::app()->name;
?>

<h1>Список голосований:</h1>

<?php foreach ($polls as $poll) {

    $isEnded = !$poll->isActive();

    echo '#'.$poll['id']. ' ' .CHtml::link($poll['name'], array('poll/'.($isEnded ? 'view' : 'vote'), 'id'=> $poll['id'])). ($isEnded ? '&nbsp;&nbsp;&nbsp;(голосование закончено)' : '&nbsp;&nbsp;&nbsp;'.CHtml::link('текущие результаты', array('poll/view', 'id' => $poll->id)).'&nbsp;&nbsp;&nbsp;(Дата окончания: '.$poll->untill_date).')<br>';
}