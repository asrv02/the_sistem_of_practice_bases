<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserInterprise $model */

$this->title = 'Update User Interprise: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Interprises', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-interprise-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
