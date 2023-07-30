<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegisterForm */
/* @var $form ActiveForm */

$this->title = 'Регистрация';
?>
<div class="site-register">
<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(['id' => 'register-form']); ?>

        <?= $form->field($model, 'surname')->textInput(['autofocus' => true])->label('Фамилия'); ?>
        <?= $form->field($model, 'name')->textInput(['autofocus' => true])->label('Имя'); ?>
        <?= $form->field($model, 'patronymic')->textInput(['autofocus' => true])->label('Отчество'); ?>

        <?# $form->field($model, 'address')->textInput(['autofocus' => true])->label('Адрес'); ?>

        <?# $form->field($model, 'phone')->label('Номер телефона'); ?>
        
        <?= $form->field($model, 'login', ['enableAjaxValidation'=>true])->label('Логин'); ?>
        <?= $form->field($model, 'email', ['enableAjaxValidation'=>true])->label('Email'); ?>

        <?= $form->field($model, 'password')->passwordInput(['autofocus' => true])->label('Пароль (минимум 6 симвалов)'); ?>
        <?= $form->field($model, 'password_repeat')->passwordInput(['autofocus' => true])->label('Повторите пароль'); ?>

        <?= $form->field($model, 'organization_id')->dropdownList($organization, ['prompt' => 'Выберите предприятие'])->label('Предприятие'); ?>
        <?= $form->field($model, 'post_id')->dropdownList($post, ['prompt' => 'Выберите должность'])->label('Должность'); ?>
        
        <div class="form-group">
            <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-register -->
