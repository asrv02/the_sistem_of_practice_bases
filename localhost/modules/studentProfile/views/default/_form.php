<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\StudentPractice $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="student-practice-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reportFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
