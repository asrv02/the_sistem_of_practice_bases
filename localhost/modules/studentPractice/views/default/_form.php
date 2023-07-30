<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\StudentPractice $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="student-practice-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'student_id')->textInput() ?>

    <?= $form->field($model, 'practice_group_id')->textInput() ?>

    <?= $form->field($model, 'place_enterprises_id')->textInput() ?>

    <?= $form->field($model, 'place_title')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
