<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Resume */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resume-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'education_received_id')->dropdownList($educationReceived, ['prompt' => 'Выберите получаемое образование']) ?>

    <?= $form->field($model, 'educational_institution_id')->dropdownList($educationalInstitution, ['prompt' => 'Выберите учебное заведение']) ?>

    <?= $form->field($model, 'specialization_id')->dropdownList($specialization, ['prompt' => 'Выберите специальность']) ?>

    <?# $form->field($model, 'specialization_id')->textarea(['rows' => 6]) ?>

    <?# $form->field($model, 'specialization')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'training_form_id')->dropdownList($trainingForm, ['prompt' => 'Выберите форму обучения']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
