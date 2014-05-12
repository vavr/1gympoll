<?php
/* @var $this PollUserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Poll Users',
);

$this->menu=array(
	array('label'=>'Create PollUser', 'url'=>array('create')),
	array('label'=>'Manage PollUser', 'url'=>array('admin')),
);
?>

<h1>Poll Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
