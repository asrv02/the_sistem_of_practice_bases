<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\StudentPracticeSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="student-practice-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'student_id') ?>

    <?= $form->field($model, 'practice_group_id') ?>

    <?= $form->field($model, 'organization_id') ?>

    <?= $form->field($model, 'place_title') ?>

    <?php // echo $form->field($model, 'report') ?>

    <?php // echo $form->field($model, 'status_loading_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>