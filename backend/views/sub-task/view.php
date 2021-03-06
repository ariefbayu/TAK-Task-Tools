<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SubTask */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Master Tasks', 'url' => ['master-task/index']];
$this->params['breadcrumbs'][] = ['label' => $model->task->name, 'url' => ['master-task/view', 'id' => $model->taskId]];
$this->params['breadcrumbs'][] = ['label' => 'Sub Tasks', 'url' => ['master-task/subtask', 'id' => $model->taskId]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sub-task-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'taskId',
            'name',
            'taskOrder',
            'taskTime:datetime',
        ],
    ]) ?>

</div>
