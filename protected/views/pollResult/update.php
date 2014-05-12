<?php
/* @var $this PollResultController */
/* @var $model PollResult */

$this->breadcrumbs=array(
	'Poll Results'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PollResult', 'url'=>array('index')),
	array('label'=>'Create PollResult', 'url'=>array('create')),
	array('label'=>'View PollResult', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PollResult', 'url'=>array('admin')),
);
?>

<h1>Update PollResult <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>