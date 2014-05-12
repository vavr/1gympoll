<?php
/* @var $this PollResultController */
/* @var $data PollResult */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('upd_time')); ?>:</b>
	<?php echo CHtml::encode($data->upd_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('results')); ?>:</b>
	<?php echo CHtml::encode($data->results); ?>
	<br />


</div>