<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StudentLists */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-lists-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'student_id')->textInput() ?>

    <?= $form->field($model, 'specialization_id')->textInput() ?>

    <?= $form->field($model, 'practice_date_from')->textInput() ?>

    <?= $form->field($model, 'practice_date_to')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
