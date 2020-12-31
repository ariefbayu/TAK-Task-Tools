<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WorkInProgress */

$this->title = 'Create Work In Progress';
$this->params['breadcrumbs'][] = ['label' => 'Work In Progresses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-in-progress-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
