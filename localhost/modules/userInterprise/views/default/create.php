<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserInterprise $model */

$this->title = 'Create User Interprise';

?>
<div class="user-interprise-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
