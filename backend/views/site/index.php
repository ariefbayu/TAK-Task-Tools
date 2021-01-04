<?php

/* @var $this yii\web\View */

use common\helpers\DateHelper;
use yii\bootstrap\Html;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;

$this->title = 'TAK Task Tools';
?>
<div class="site-index">

    <div class="row">
        <div class="col-lg-12">
            <h2>Current Progress</h2>

            <p>
                <?= (Yii::$app->user->isGuest) ? '' : Html::a('Add Task', ['work-in-progress/create'], ['class' => 'btn btn-primary']) ?>
            </p>

            <?php

            if (Yii::$app->user->isGuest) {
                echo "Please login to see works in progress.";
            } else {


                $provider = new ArrayDataProvider([
                    'allModels' => $wip,
                    'pagination' => [
                        'pageSize' => 50,
                    ],
                    'sort' => [
                        'attributes' => ['id', 'name'],
                    ],
                ]);

                echo GridView::widget([
                    'rowOptions' => function ($model) {
                        if ($model->deadline != "" && $model->deadline < date('Y-m-d')) {
                            return ['class' => 'danger'];
                        }
                    },
                    'tableOptions' => [
                        'class' => 'table table-striped',
                    ],
                    'options' => [
                        'class' => 'table-responsive',
                    ],
                    'dataProvider' => $provider,
                    'columns' => [
                        [
                            'attribute' => 'taskId',
                            'value' => function ($model) {
                                return ucwords($model->task->name);
                            }
                        ],
                        [
                            'attribute' => 'currentProgressId',
                            'value' => function ($model) {
                                return $model->currentProgress->name;
                            }
                        ],
                        [
                            'attribute' => 'employeeId',
                            'value' => function ($model) {
                                return $model->employee->name;
                            }
                        ],
                        [
                            'attribute' => 'updatedAt',
                            'header' => 'Update/Deadline',
                            'format' => 'raw',
                            'value' => function ($model) {
                                $response  = DateHelper::timeToElapsedString($model->updatedAt);
                                $response .= "<br>" . ($model->deadline != "" ? $model->deadline : 'N/A');
                                return $response;
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{detail}',
                            'header' => '',
                            'buttons' => [
                                'detail' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-arrow-right" title="View Progress"></span> ', ['work-in-progress/view', 'id' => $model->id]);
                                },
                            ]
                        ],

                    ],
                ]);
            }
            ?>
        </div>
    </div>

</div>