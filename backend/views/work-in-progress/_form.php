<?php

use common\models\Employee;
use common\models\MasterTask;
use common\models\SubTask;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WorkInProgress */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="work-in-progress-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
        $form->field($model, 'taskId')->dropDownList(
            ArrayHelper::map(MasterTask::find()->all(), 'id', 'name'),
            [
                'prompt' => '-Choose Task-',
                'onchange' => '
				$.post( "' . Yii::$app->urlManager->createUrl('sub-task/ajax-for-wip') . '&id="+$(this).val(), function( data ) {
				  $( "#workinprogress-currentprogressid" ).html( data );
				});'
            ]
        )
    ?>

    <?= $form->field($model, 'employeeId')->dropDownList(
            ArrayHelper::map(Employee::find()->all(), 'id', 'name')
        ) ?>

    <?php
    if ($model->taskId != null) {
        echo $form->field($model, 'currentProgressId')->dropDownList(
            ArrayHelper::map(SubTask::findAll(['taskId' => $model->taskId]), 'id', 'name')
        );
    } else {
        echo $form->field($model, 'currentProgressId')->dropDownList(['' => '-Please Select Task-']);
    }
    ?>

    <?= $form->field($model, 'taskDetail')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'note1')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'note2')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'note3')->textarea(['maxlength' => true]) ?>

    <?php
    echo $form->field($model, 'deadline')->widget(DatePicker::classname(), [
        //'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ])
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>