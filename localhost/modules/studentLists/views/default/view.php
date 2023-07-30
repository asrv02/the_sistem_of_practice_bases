<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\StudentLists */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Student Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="student-lists-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'student_id',
            [
                'attribute' => 'student_id',
                'value' => function($model){
                    return $model->user->name . ' ' . $model->user->surname . ' ' . $model->user->patronymic;
                },              
                'label' => 'ФИО заказчика',
                'filter' => false,
            ],
            // 'specialization_id',
            [
                'attribute' => 'specialization_id',
                'value' => function($model){
                    return $model->specialization->title;
                },              
                'label' => 'Специальность',
            ],
            'practice_date_from',
            'practice_date_to',
        ],
    ]) ?>
    

</div>
