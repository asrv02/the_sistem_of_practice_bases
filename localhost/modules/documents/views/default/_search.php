<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\DocumentsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="documents-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'practice_diary') ?>

    <?= $form->field($model, 'characteristic') ?>

    <?= $form->field($model, 'practical_task') ?>

    <?= $form->field($model, 'certification_sheet') ?>

    <?php // echo $form->field($model, 'contract') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
