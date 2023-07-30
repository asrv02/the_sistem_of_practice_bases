<?php

use yii\bootstrap5\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Resume */

$this->title = 'Резюме студента:';
?>
<div class="resume-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'specialization' => $specialization,
        'trainingForm' => $trainingForm,
        'educationalInstitution' => $educationalInstitution,
        'educationReceived' => $educationReceived,
    ]) ?>

</div>
