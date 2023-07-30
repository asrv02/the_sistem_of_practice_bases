<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Applicationstud */

$this->title = 'Create Applicationstud';
$this->params['breadcrumbs'][] = ['label' => 'Applicationstuds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="applicationstud-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'organizationName' => $organizationName,
    ]) ?>

</div>
