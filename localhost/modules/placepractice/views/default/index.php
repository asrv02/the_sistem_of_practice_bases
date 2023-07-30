<?php

use app\models\Placepractice;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\PlacepracticeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Место практики';
?>
<div class="placepractice-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить документ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'title',
            // 'link',
            [
                'attribute' => 'link',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a('Практика', $model->link, ['class' => 'link-primary']) ;
                }
            ],
            // 'date',
            [
                'attribute' => 'date',
                'format' =>  ['date', 'dd.MM.Y'],
            ],
            //'group_id',
            [
                'attribute' => 'group_id',
                'value' => function($model){
                    return $model->group->title;
                },              
                'label' => 'Группа',
                'filter' => $group,
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Placepractice $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
