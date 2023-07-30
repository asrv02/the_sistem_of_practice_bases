<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Placepractice $model */

$this->title = 'Добавление документа';
?>
<div class="placepractice-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'group' => $group,
        'view_practice' => $view_practice,
    ]) ?>

</div>
