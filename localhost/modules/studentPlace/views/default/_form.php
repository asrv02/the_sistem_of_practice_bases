<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\StudentPlace $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="student-place-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'student_practice_id')->textInput() ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
