<?php
/* @var $this PollResultController */
/* @var $model PollResult */

$this->breadcrumbs=array(
	'Poll Results'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PollResult', 'url'=>array('index')),
	array('label'=>'Manage PollResult', 'url'=>array('admin')),
);
?>

<h1>Create PollResult</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>