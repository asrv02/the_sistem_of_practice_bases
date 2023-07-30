<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Application;
use app\models\OrganizationName;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ApplicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки';
?>
<div class="applicationstud-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <p>
        <?= Html::a('Create Application', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'student_id',
            [
                'attribute' => 'student_id',
                'value' => function($model){
                    return $model->student->name . ' ' . $model->student->surname . ' ' . $model->student->patronymic;
                },              
                'label' => 'ФИО студента',
                'filter' => false,
            ],
            [
                'attribute' => 'employer_id',
                'value' => function($model){
                    return $model->employer->name . ' ' . $model->employer->surname . ' ' . $model->employer->patronymic;
                },              
                'label' => 'ФИО работодателя',
                'filter' => false,
            ],
            // 'employer_lists_id',
            // 'specialization_id',
            // [
            //     'attribute' => 'organization_name_id',
            //     'value' => function($model){
            //         return OrganizationName::findOne($model->organization_name)->title;
            //     },              
            //     'label' => 'Организация рабтодателя',
            //     'filter' => $organization_name,
            // ],

            // [
            //     'attribute' => 'view_practice_id',
            //     'value' => function($model){
            //         return ViewPractice::findOne($model->group_id)->title;
            //     },              
            //     'label' => 'Вид практики',
            //     'filter' => $group,
            // ],
            // [
            //     'attribute' => 'specialization_id',
            //     'value' => function($model){
            //         return $model->specialization->title;
            //     },              
            //     'label' => 'Специальность',
            //     'filter' => $specialization,
            // ],
            // 'status_id',
            [
                'attribute' => 'status_id',
                'value' => function($model){
                    return $model->status->title;
                },              
                'label' => 'Статус',
                'filter' => $status,
            ],
            // [
            //     'class' => ActionColumn::className(),
            //     'urlCreator' => function ($action, Application $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id' => $model->id]);
            //      }
            // ],
        ],
    ]); ?>



</div>