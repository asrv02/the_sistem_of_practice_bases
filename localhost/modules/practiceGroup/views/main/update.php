<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\models\PracticeGroup $model */

$this->title = 'Update Practice Group: ' . $model->id;

?>
<div class="practice-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'group' => $group,
        'viewPractice' => $viewPractice,
        'documents' => $documents,
    ]) ?>

</div>
