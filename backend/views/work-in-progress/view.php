<?php

use common\helpers\DateHelper;
use common\models\General;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\WorkInProgress */

$this->title = 'WIP for ' . $model->task->name;
$this->params['breadcrumbs'][] = $model->task->name;
\yii\web\YiiAsset::register($this);
?>
<div class="work-in-progress-view">

    <h1><?= Html::encode(ucwords($model->task->name)) . ($model->isActive == '0' ? ' <em class="h4">--COMPLETED--</em>' : '') ?></h1>

    <p>
        <?= (Yii::$app->user->isGuest) ? '' : Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php 
        if($model->isActive == '1')
        {
            echo (Yii::$app->user->isGuest) ? '' : Html::a('Mark As Completed', ['mark-as-completed', 'id' => $model->id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => 'Are you sure you want to mark this item as "COMPLETED"?',
                    'method' => 'post',
                ],
            ]);
        }
        if($model->isActive == '0')
        {
            echo (Yii::$app->user->isGuest) ? '' : Html::a('Reactivate Task', ['mark-as-active', 'id' => $model->id], [
                'class' => 'btn btn-default',
                'data' => [
                    'confirm' => 'Are you sure you want to mark this item as "ACTIVE"?',
                    'method' => 'post',
                ],
            ]);
        }
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'taskId',
                'value' => function ($model) {
                    return $model->task->name;
                }
            ],
            [
                'attribute' => 'employeeId',
                'value' => function ($model) {
                    return $model->employee->name;
                }
            ],
            [
                'attribute' => 'currentProgressId',
                'value' => function ($model) {
                    return $model->currentProgress->name;
                }
            ],
            'taskDetail',
            'note1',
            'note2',
            'note3',
            [
                'attribute' => 'isActive',
                'value' => function ($model) {
                    return General::$isActiveLabel[$model->isActive];
                }
            ],
        ],
    ]) ?>

<h2>Task Histories</h2>

<?php

$provider = new ArrayDataProvider([
    'allModels' => $histories,
    'pagination' => [
        'pageSize' => 50,
    ],
]);

echo GridView::widget([
    'dataProvider' => $provider,
    'columns' => [
        [
            'attribute' => 'createdAt',
            'header' => 'Last Update',
            'value' => function ($model) {
                return DateHelper::timeToElapsedString($model->createdAt);
            }
        ],
        [
            'attribute' => 'taskId',
            'value' => function ($model) {
                return $model->task->name;
            }
        ],
        [
            'attribute' => 'currentWipId',
            'value' => function ($model) {
                return $model->currentWip->name;
            }
        ],
        [
            'attribute' => 'employeeId',
            'value' => function ($model) {
                return $model->employee->name;
            }
        ],
        [
            'class' => 'yii\grid\Column',
            'header' => Yii::t('app', 'Additional Notes'),
            'content' => function ($model) {
                $html  = '<strong>Detail</strong><br>';
                $html .= \yii\helpers\Html::encode($model->taskDetail) . '<br>';
                $html .= '<strong>Note 1</strong><br>';
                $html .= \yii\helpers\Html::encode($model->note1) . '<br>';
                $html .= '<strong>Note 2</strong><br>';
                $html .= \yii\helpers\Html::encode($model->note2) . '<br>';
                $html .= '<strong>Note 3</strong><br>';
                $html .= \yii\helpers\Html::encode($model->note3);
              return $html;
            }
          ],
    ],
]); ?>

</div>