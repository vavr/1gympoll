<?php
/* @var $this PollController */
/* @var $model Poll */

$this->breadcrumbs=array(
	$model->name,
);
?>
<h1>Просмотр результатов голосования</h1>

<h3>#<?=$model->id; ?> <?=$model->name; ?></h3>

<p>
    <?php if ($model->isActive()) {?>
        Голосование продлиться до <strong><?=$model->untill_date?></strong>
    <?php } else {?>
        <strong>Голосование не активно.</strong>
        <?php if ($model->is_ended) {?>
            Остановлено модератором.
        <?php } else {?>
            Закончилось <strong><?=$model->untill_date?></strong>
        <?php } ?>
<?php } ?>
</p>

<?php

$results = $model->results;

if ($results) {

    echo 'Всего проголосовало: <strong>'.count($results).'</strong> из <strong>'.count($pollUsers).'</strong><br><br>';

    $this->renderPartial('results/result_'.$model->id, array('model' => $model));
} else {
    echo "Пока никто не проголосовал";
}

