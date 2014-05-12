<?php
/* @var $this PollController */
/* @var $model Poll */

$this->breadcrumbs=array(
	'Polls'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Poll', 'url'=>array('index')),
	array('label'=>'Create Poll', 'url'=>array('create')),
	array('label'=>'View Poll', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Poll', 'url'=>array('admin')),
);
?>

<h1>Update Poll <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>