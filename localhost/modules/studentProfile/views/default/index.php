<?php

use app\models\StudentPractice;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\StudentPracticeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

// $this->title = 'Данные';
?>
<div class="student-practice-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h2>Добро пожаловать, <?= Yii::$app->user->identity->name ?></h2>

    <!-- <p>
        <?= Html::a('Create Student Practice', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'id' => 'student-profile-grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Вид практики',
                'value' => fn($model) => $view_practice[$model->practiceGroup->view_practice_id],
            ],
            [
                'label' => 'Место прохождения',
                'value' => fn($model) => !empty($model->organization_id) 
                                         ? $organization[$model->organization_id] 
                                         : ( !empty($model->place_title) ? $model->place_title : '')
                                         ,
            ],
            [
                'label' => 'Начало практики',
                'format' =>  ['date', 'dd.MM.Y'],
                'value' => fn($model) => $model->practiceGroup->begin_date,
            ],
            [
                'label' => 'Окончание практики',
                'format' =>  ['date', 'dd.MM.Y'],
                'value' => fn($model) => $model->practiceGroup->end_date,
            ],
            [
                'label' => 'Документы на практику',
                'format' => 'raw',
                'value' => fn($model) =>
                
                     Html::a('Документ', ['download', 'url' => $model->practiceGroup->documents->doki] )
                ,
                
            ],

            [
                'label' => 'Отчет по практике',
                'format' => 'raw',
                'value' => fn($model) =>
                    Html::a('Загрузить', ['create', 'id' => $model->id], ['class' => 'btn btn-primary m-1 d-block text-center'] ) 
                    . ( $model->report ? Html::a('Отчет', ['download-report', 'url' => '/uploads/' . $model->report , 'id' => $model->id] , ['class' => 'd-block text-center mt-3 btn-report-download', 'data-url' => $model->report ] ) : '')
                ,
                
            ],


           
            
           
            // 'report',
            // 'status_loading_id',
           
            // [
            //     'class' => ActionColumn::className(),
            //     'urlCreator' => function ($action, StudentPractice $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id' => $model->id]);
            //      }
            // ],
        ],
    ]); ?>


</div>

<?php
    $this->registerJsFile('@web/js/report-download.js',	['depends' => [\yii\web\JqueryAsset::class]]);	
