<?php
/**
 * Created by PhpStorm.
 * User: vavr
 * Date: 12.05.14
 * Time: 1:31
 *
 * @var Poll $model
 */
$results = $model->results;

$summaryYes = $summaryNo = 0;

foreach ($results as $result) {
    $data = json_decode($result->results, true);

    if (isset($data['choise']) && $data['choise'] == 'yes') {
        $summaryYes++;
    } else {
        $summaryNo++;
    }
}

?>

Из них:<br><br>
<strong>ЗА</strong>: <?=$summaryYes?><br>
<strong>Против</strong>: <?=$summaryNo?><br>
