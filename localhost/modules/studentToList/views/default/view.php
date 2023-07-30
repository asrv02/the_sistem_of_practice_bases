<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->name;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

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
            // 'id',
            // 'name',
            // 'surname',
            // 'patronymic',
            // 'login',
            // 'email:email',
            // 'password',
            [
                'attribute' => 'surname',
                'label' => 'Фамилия',
            ],
            [
                'attribute' => 'name',
                'label' => 'Имя',
            ],
            [
                'attribute' => 'patronymic',
                'label' => 'Отчество',
            ],
            [
                'attribute' => 'login',
                'label' => 'Логин',
            ],
            [
                'attribute' => 'email',
                'label' => 'Email',
            ],
            [
                'attribute' => 'course',
                'label' => 'Курс',
            ],
            [ 
                'attribute' => 'group_id',
                'value' => $group[$model_st_gr->group_id],
                'label' => 'Группа',
            ],
            // [
            //     'attribute' => 'group_id',
            //     'value' => fn($model)group_id} 

            // ]
            // 'course',
            

        ],
    ]) ?>

</div>
