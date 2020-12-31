<?php

/* @var $this yii\web\View */

use yii\bootstrap\Html;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;

$this->title = 'TAD Task Tools';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <h2>Current Progress</h2>

                <?php

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
                    'dataProvider' => $provider,
                    'columns' => [
                        // ['class' => 'yii\grid\SerialColumn'],

                        // 'id',
                        // 'taskId',
                        [
                            'attribute' => 'taskId',
                            'value' => function ($model) {
                                return $model->task->name;
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
                        'taskDetail',
                        'updatedAt',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{detail}',
                            'header' => '',
                            'buttons' => [
                                'detail' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-arrow-right" title="Update Subtask"></span> ', ['work-in-progress/view', 'id' => $model->id]);
                                },
                            ]
                        ],
                        
                    ],
                ]); ?>

                <p><?php echo Html::a('View All &raquo;', ['work-in-progress/index'], ['class' => 'btn btn-default']) ?></p>
            </div>
        </div>

    </div>
</div>