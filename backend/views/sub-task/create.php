<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SubTask */

$this->title = 'Create Sub Task';
$this->params['breadcrumbs'][] = ['label' => 'Master Tasks', 'url' => ['master-task/index']];
$this->params['breadcrumbs'][] = ['label' => $model->task->name, 'url' => ['master-task/view', 'id' => $model->taskId]];
$this->params['breadcrumbs'][] = ['label' => 'Sub Tasks', 'url' => ['master-task/subtask', 'id' => $model->taskId]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-task-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
