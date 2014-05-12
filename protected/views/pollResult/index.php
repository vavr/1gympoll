<?php
/* @var $this PollResultController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Poll Results',
);

$this->menu=array(
	array('label'=>'Create PollResult', 'url'=>array('create')),
	array('label'=>'Manage PollResult', 'url'=>array('admin')),
);
?>

<h1>Poll Results</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
