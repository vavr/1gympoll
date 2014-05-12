<?php
/* @var $this PollUserController */
/* @var $model PollUser */

$this->breadcrumbs=array(
	'Poll Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PollUser', 'url'=>array('index')),
	array('label'=>'Manage PollUser', 'url'=>array('admin')),
);
?>

<h1>Create PollUser</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>