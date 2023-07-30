<?php

use app\models\PracticeGroup;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Group;
use app\models\StatusLoading;
use app\models\StudentPractice;
use app\models\ViewPractice;
use yii\helpers\VarDumper;

/** @var yii\web\View $this */
/** @var app\models\PracticeGroupSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Группы на практику';

?>
<div class="practice-group-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (  Yii::$app->user->can('admin')) :?> 
    <p>
        <?= Html::a('Отправить группу на практику', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?php endif; ?> 
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'view_practice_id',
            [
                'attribute' => 'view_practice_id',
                'value' => function($model){
                    return ViewPractice::findOne($model->group_id)->title;
                },              
                'label' => 'Вид практики',
                'filter' => false,
            ],
            // 'group_id',
            [
                'attribute' => 'group_id',
                'value' => function($model){
                    return Group::findOne($model->group_id)->title;
                },              
                'label' => 'Группа',
                'filter' => false,

                // if ($group) {
                //     $text .= Html::a($model->group->fullName, '/group/default/view?id=' . $resume->group->id);
                // } else {
                //     $text .= $model->group->fullName;
                // }
                // return $text;
            ],
            // 'begin_date',
            [
                 'attribute' => 'begin_date',
                 'format' =>  ['date', 'dd.MM.Y'],
            ],
            // 'end_date',
            [
                 'attribute' => 'end_date',
                 'format' =>  ['date', 'dd.MM.Y'],
            ],
            //[
             //    'class' => ActionColumn::className(),
             //    'urlCreator' => function ($action, PracticeGroup $model, $key, $index, $column) {
             //        return Url::toRoute([$action, 'id' => $model->id]);
            //     }
            //],

            [                
                'label' => 'Статистика',
                'value' => function ($model) { 
                    if( !StudentPractice::getStudentPracticCount($model->group_id,$model->id) ) {
                        StudentPractice::addStudentPracticGroup($model->group_id,$model->id);
                    }

                    $stat = StudentPractice::getPracticGroupStat($model->id);
                    return "<div class='text-center'>Кол-во распределенных: <div class='text-center text-success p-2 fw-bold fs-4'>{$stat['yes']}</div></div>"
                            . "<div class='text-center'>Кол-во нераспределенных: <div class='text-center text-danger  p-2 fw-bold fs-4'>{$stat['no']}</div></div>"
                            ;
                },
                    
                'format' => 'raw',
            ],
            // if (  Yii::$app->user->can('admin'));
            [                
                'label' => 'Назначение практики',
                'value' => fn ($model) =>
                    $this->render('modal.php', ['model' => $model, 'organization' => $organization,]),
                    
                'format' => 'raw',
            ],
            // endif; 
            [
                
                'label' => 'Список группы',
                'value' => fn ($model) => Html::a('Список группы', ['student-lists/view', 'group_id' => $model->group_id, 'practice_group_id' => $model->id], ['class' => 'btn btn-primary']),
                'format' => 'raw',
            ],
            // [
            //     'attribute' => 'status_loading_id',
            //     'value' => function($model){
            //         return StatusLoading::findOne($model->status_loading_id)->title;

            //     },              
            //     'label' => 'Статус',
            //     'filter' => false,
            // ],
            [
                'attribute' => 'doki',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a('Документы', '/practice-group/main/download?url=' . $model->documents->doki);
                },              
                'label' => 'Документы',
                // 'filter' => false,
            ],
            [
                'class' => ActionColumn::class,
                'template' => '{update} {delete}',
                'urlCreator' => function ($action, PracticeGroup $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],

            
        ],
    ]); ?>




</div>
