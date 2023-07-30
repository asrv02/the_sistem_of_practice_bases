<?php

use yii\bootstrap4\Modal;
use kartik\date\DatePicker;
use yii\bootstrap4\Html;
/* @var $model app\models\UserSearch */
use yii\bootstrap4\ActiveForm;
use app\models\ViewPractice;
?>
<?php
Modal::begin([
    'title' => 'Выберите место практики для группы',
    'toggleButton' => ['label' => 'Отправить на предприятие', 'class' => 'btn btn-primary'],
]);
?>

<div class="row" style="margin-bottom: 8px">
    <?php
    $form = ActiveForm::begin([
        'action' => Yii::$app->urlManager->createUrl(['/practice-group/student-lists/set', 'id' => $model->id])
    ])
    ?>

    <div class="form-group field-studentpractice-place_title required">
        <label for="studentpractice-group">Группа</label>
        <input type="text" id="studentpractice-group" class="form-control" name="StudentPractice[group]" aria-required="true" value="<?= $model->practiceGroup->group->title ?>" disabled="disabled">
    </div>

    <?= $form->field($model, 'view_practice_id')->textInput(['disabled' => 'disabled', 'value' => $model->practiceGroup->viewPractice->title])->label('Вид практики'); ?>
    <?= $form->field($model, 'organization_id')->dropdownList($organization, ['prompt' => 'выберите место практики'])->label('Предприятие'); ?>
    <?= $form->field($model, 'place_title')->textInput()->label('Место прохождения') ?>

    <? # $form->field($model, 'view_practice_id')->dropdownList($viewPractice, ['prompt' => 'выберите вид практики']) 
    ?>


    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Отправить на предприятие', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end() ?>

</div>
<?php Modal::end(); ?>