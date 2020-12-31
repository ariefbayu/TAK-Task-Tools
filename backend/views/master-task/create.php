<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MasterTask */

$this->title = 'Create Master Task';
$this->params['breadcrumbs'][] = ['label' => 'Master Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-task-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
