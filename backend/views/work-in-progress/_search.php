<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\WorkInProgressSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="work-in-progress-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'taskId') ?>

    <?= $form->field($model, 'employeeId') ?>

    <?= $form->field($model, 'currentProgressId') ?>

    <?= $form->field($model, 'taskDetail') ?>

    <?php // echo $form->field($model, 'note1') ?>

    <?php // echo $form->field($model, 'note2') ?>

    <?php // echo $form->field($model, 'note3') ?>

    <?php // echo $form->field($model, 'isActive') ?>

    <?php // echo $form->field($model, 'createdAt') ?>

    <?php // echo $form->field($model, 'updatedAt') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
