<?php

use yii\bootstrap5\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Resume */

$this->title = 'Редактировать резюме: ' . $model->name;

?>
<div class="resume-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'specialization' => $specialization,
        'trainingForm' => $trainingForm,
        'educationalInstitution' => $educationalInstitution,
        'educationReceived' => $educationReceived,
    ]) ?>

</div>
