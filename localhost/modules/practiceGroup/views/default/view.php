<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\PracticeGroup $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Practice Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="practice-group-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
       
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'view_practice_id',
            'group_id',
            //'begin_date',
            //'end_date',
                        [
                 'attribute' => 'begin_date',
                 'format' =>  ['date', 'dd.MM.Y'],
            ],
            // 'end_date',
            [
                 'attribute' => 'end_date',
                 'format' =>  ['date', 'dd.MM.Y'],
            ],
        ],
    ]) ?>

</div>
