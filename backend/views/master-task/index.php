<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MasterTaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Master Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Master Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?php
    $dataProvider->pagination->pageSize = 50;
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'name',

            // ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {subtask} {delete}',
                'header' => '',
                'buttons' => [
                    'subtask' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-list-alt" title="Sub Task"></span> ', ['master-task/subtask', 'id' => $model->id]);
                    },
                ]
            ]
        ],
    ]); ?>


</div>