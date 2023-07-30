<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Applicationstud */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="applicationstud-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'employer_id')->textInput() ?>

    <?= $form->field($model, 'employer_lists_id')->textInput() ?>

    <?= $form->field($model, 'specialization_id')->textInput() ?>

    <?= $form->field($model, 'organization_name_id')->textInput() ?>

    <?= $form->field($model, 'status_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
