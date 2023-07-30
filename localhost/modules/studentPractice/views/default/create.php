<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\StudentPractice $model */

$this->title = 'Create Student Practice';
$this->params['breadcrumbs'][] = ['label' => 'Student Practices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-practice-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
