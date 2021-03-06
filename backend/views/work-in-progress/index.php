<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\WorkInProgressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Work In Progresses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-in-progress-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Work In Progress', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'taskId',
            'employeeId',
            'currentProgressId',
            'taskDetail',
            //'note1',
            //'note2',
            //'note3',
            //'isActive',
            //'createdAt',
            //'updatedAt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
