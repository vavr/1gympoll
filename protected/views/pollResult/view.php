<?php
/* @var $this PollResultController */
/* @var $model PollResult */

$this->breadcrumbs=array(
	'Poll Results'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PollResult', 'url'=>array('index')),
	array('label'=>'Create PollResult', 'url'=>array('create')),
	array('label'=>'Update PollResult', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PollResult', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PollResult', 'url'=>array('admin')),
);
?>

<h1>View PollResult #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'upd_time',
		'results',
	),
)); ?>
