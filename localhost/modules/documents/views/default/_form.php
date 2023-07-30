<?php

use app\models\ViewPractice;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Documents $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="documents-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<!--    --><?php //= $form->field($model, 'file[]')->fileInput(['multiple' => true]) ?>

    <?= $form->field($model, 'files[]')->fileInput(['multiple' => true])->label('Загрузите файл')  ?>

    <?= $form->field($model, 'view_practice_id')->dropDownList(ViewPractice::getViewPracticeList())->label('Вид практики')   ?>



    <div class="form-group">

        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
