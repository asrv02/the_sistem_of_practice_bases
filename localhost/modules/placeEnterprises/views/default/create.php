<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PlaceEnterprises $model */

$this->title = 'Create Place Enterprises';
?>
<div class="place-enterprises-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
