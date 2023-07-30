<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StudentLists */

$this->title = 'Create Student Lists';
$this->params['breadcrumbs'][] = ['label' => 'Student Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-lists-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        // 'studentLists' => $studentLists,
    ]) ?>

</div>
