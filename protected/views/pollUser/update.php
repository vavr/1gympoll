<?php
/* @var $this PollUserController */
/* @var $model PollUser */

$this->breadcrumbs=array(
	'Poll Users'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PollUser', 'url'=>array('index')),
	array('label'=>'Create PollUser', 'url'=>array('create')),
	array('label'=>'View PollUser', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PollUser', 'url'=>array('admin')),
);
?>

<h1>Update PollUser <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>