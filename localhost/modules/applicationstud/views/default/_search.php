<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ApplicationstudSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="applicationstud-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'employer_id') ?>

    <?= $form->field($model, 'employer_lists_id') ?>

    <?= $form->field($model, 'organization_name_id') ?>

    <?= $form->field($model, 'specialization_id') ?>

    <?= $form->field($model, 'status_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
