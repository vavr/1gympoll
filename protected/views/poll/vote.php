<?php
/* @var $this PollController */
/* @var $poll Poll */

$this->breadcrumbs=array(
	$poll->name,
);
?>
<h1>Голосование</h1>

<h2>#<?=$poll->id; ?> <?=$poll->name; ?></h2>

<?php
$this->renderPartial('vote/poll_'.$poll->id, array('poll' => $poll, 'user' => $user));

