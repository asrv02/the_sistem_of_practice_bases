<?php

use yii\bootstrap5\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Documents $model */

$this->title = $model->id;
\yii\web\YiiAsset::register($this);
?>
<div class="documents-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'practice_diary',

            [
                'attribute' => 'doki',
                'format' => 'raw',
                'value' => function($model){
                    return  Html::a($model->doki  );
                },
                'label' => 'Дневник по практике',

            ],
            [
                'attribute' => 'view_practice_id',
                'label' => 'Вид практики',

            ],
            // 'view_practice_id',
            
        ],
    ]) ?>

</div>
