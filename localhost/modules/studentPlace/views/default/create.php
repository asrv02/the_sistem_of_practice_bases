<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\StudentPlace $model */

$this->title = 'Create Student Place';
$this->params['breadcrumbs'][] = ['label' => 'Student Places', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-place-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
