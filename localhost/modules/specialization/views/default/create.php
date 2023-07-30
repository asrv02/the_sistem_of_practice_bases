<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Specialization */

$this->title = 'Добавление специальности:';

?>
<div class="specialization-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
