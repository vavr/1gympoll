<?php
/**
 * @var $this SiteController
 * @var $poll Poll
 */

$this->pageTitle=Yii::app()->name;

$this->breadcrumbs=array(
    $poll->name,
);
?>

Спасибо за голосование. : <?=CHtml::link('Посмотреть результаты', array('poll/view', 'id' => $poll->id))?>