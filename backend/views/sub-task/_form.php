<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SubTask */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sub-task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'taskId')->hiddenInput(['maxlength' => true, 'value' => $model->taskId])->label(false) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'taskOrder')->textInput() ?>

    <?= $form->field($model, 'taskTime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
