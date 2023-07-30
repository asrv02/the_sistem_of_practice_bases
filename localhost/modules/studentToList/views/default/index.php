<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\User;
use app\models\Group;
use kartik\date\DatePicker;
use app\models\Specialization;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Списки студентов';
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить студента', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'name',
            // 'surname',
            // 'patronymic',
            // 'login',
            // 'course',
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
                'attribute' => 'course',
                'label' => 'Курс',
            ],
            // 'specialization_id',
            // [
            //     'attribute' => 'specialization_id',
            //     'value' => function($model){
            //         return Specialization::findOne($model->specialization_id)->title;
            //     },              
            //     'label' => 'Специальность',
            //     'filter' => $specialization,
            // ],
            [
                'attribute' => 'group_id',
                'label' => 'Группа',
                'value' => fn($model) => !empty($model->studentGroup) ? $model->studentGroup->group->title : '',
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>
</div>