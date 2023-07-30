<?php

use app\models\PracticeGroup;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Group;
use app\models\StatusLoading;
use app\models\ViewPractice;


/** @var yii\web\View $this */
/** @var app\models\PracticeGroupSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Группы на практику';

?>
<div class="practice-group-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Practice Group', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
                'filter' => $group,
            ],
            // 'group_id',
            [
                'attribute' => 'group_id',
                'value' => function($model){
                    return Group::findOne($model->group_id)->title;
                },              
                'label' => 'Группа',
                'filter' => $group,

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
                'label' => 'Назначение практики',
                'value' => function ($model) {
                    return $this->render('modal.php', ['model' => $model]);
                },
                'format' => 'raw',
            ],

            [
                'attribute' => 'status_loading_id',
                'value' => function($model){
                    return StatusLoading::findOne($model->status_loading_id)->title;

                },              
                'label' => 'Статус',
                'filter' => false,
            ],
            // [
            //     'attribute' => 'practice_diary',
            //     'format' => 'raw',
            //     'value' => function($model){
            //         return  Html::a('Документ', $model->practice_diary   );
            //     },
            //     'label' => 'Дневник по практике',

            // ],
            // [
            //     'attribute' => 'documents_id',
            //     'format' => 'raw',
            //     'value' => function($model){
            //         return Html::a($model->documents->practice_diary . '_' . $model->documents->characteristic . '_' . $model->documents->practical_task . '_' . $model->documents->certification_sheet . '_' . $model->documents->contract);

            //     },              
            //     'label' => 'Документы',
            //     // 'filter' => false,
            // ],

            [
                
                'label' => 'Список группы',
                'value' => fn ($model) => Html::a('Список группы', ['student-lists/view', 'id_group' => $model->group_id, 'id_practice_group' => $model->id], ['class' => 'btn btn-info']),
                'format' => 'raw',
            ],

            
        ],
    ]); ?>

</div>
