<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PracticeGroup $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="practice-group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'view_practice_id')->dropdownList($viewPractice, ['prompt' => 'выберите вид практики']) ?>

    <?= $form->field($model, 'group_id')->dropdownList($group, ['prompt' => 'выберите группу']) ?>

    <?= $form->field($model, 'begin_date')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'end_date')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'documents_id')->dropdownList($documents, ['prompt' => 'Выберите документы']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
