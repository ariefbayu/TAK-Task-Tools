<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WorkInProgress */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="work-in-progress-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'taskId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'employeeId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currentProgressId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'taskDetail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isActive')->textInput() ?>

    <?= $form->field($model, 'createdAt')->textInput() ?>

    <?= $form->field($model, 'updatedAt')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
