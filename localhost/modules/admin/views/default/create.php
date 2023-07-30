<?php

use yii\bootstrap5\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Создание пользователей';
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
