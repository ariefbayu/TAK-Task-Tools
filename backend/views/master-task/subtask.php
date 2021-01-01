<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SubTaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sub Task For [' . $model->name . ']';
$this->params['breadcrumbs'][] = ['label' => 'Master Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Sub Tasks';
?>
<div class="sub-task-index">

  <h1><?= Html::encode($this->title) ?></h1>

  <p>
    <?= Html::a('Create Sub Task', ['sub-task/create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
  </p>

  <?php // echo $this->render('_search', ['model' => $searchModel]); 
  ?>

  <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
      ['class' => 'yii\grid\SerialColumn'],

      // 'id',
      // 'taskId',
      // [
      //     'attribute' => 'taskId',
      //     'value' => function($model){
      //         return $model->task->name;
      //     }
      // ],
      'name',
      'taskOrder',
      'taskTime',

      [
        'class' => 'yii\grid\ActionColumn',
        // 'template' => '{update} {delete}',
        'template' => '{update}',
        'header' => '',
        'buttons' => [
          'update' => function ($url, $model) {
            return Html::a('<span class="glyphicon glyphicon-pencil" title="Update Subtask"></span> ', ['sub-task/update', 'id' => $model->id]);
          },
          // 'delete' => function ($url, $model) {
          //   return Html::a('<span class="glyphicon glyphicon-trash" title="Delete subtask"></span> ', ['sub-task/delete', 'id' => $model->id]);
          // }
        ]
      ]
    ],
  ]); ?>


</div>