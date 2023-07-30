<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\StudentPlace $model */

$this->title = 'Update Student Place: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Student Places', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-place-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
