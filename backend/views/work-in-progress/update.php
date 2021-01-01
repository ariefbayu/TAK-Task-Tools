<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WorkInProgress */

$this->title = 'Update WIP: ' . $model->task->name;
$this->params['breadcrumbs'][] = ['label' => 'WIP: ' . $model->task->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="work-in-progress-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
