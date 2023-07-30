<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PlaceEnterprises $model */

$this->title = 'Update Place Enterprises: ' . $model->title;

?>
<div class="place-enterprises-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
