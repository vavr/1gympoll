<?php
/* @var $this PollUserController */
/* @var $model PollUser */

$this->breadcrumbs=array(
	'Poll Users'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List PollUser', 'url'=>array('index')),
	array('label'=>'Create PollUser', 'url'=>array('create')),
	array('label'=>'Update PollUser', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PollUser', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PollUser', 'url'=>array('admin')),
);
?>

<h1>View PollUser #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'email',
	),
)); ?>
