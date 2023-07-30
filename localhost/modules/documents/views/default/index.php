<?php

use app\models\Documents;
use app\models\ViewPractice;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\DocumentsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Документы';
?>
<div class="documents-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (  Yii::$app->user->can('admin')) :?> 
    <p>
        <?= Html::a('Добавить документы', ['create'], ['class' => 'btn btn-primary']) ?>
        <?# Html::a('Заполнить автоматическую запись', ['/site/word/'], ['class' => 'btn btn-outline-primary']) ?>
    </p>
    <?php endif; ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // [
            //     'attribute' => 'link',
            //     'format' => 'raw',
            //     'value' => function($model){
            //         return Html::a('Практика', $model->link, ['class' => 'link-primary']) ;
            //     }
            // ],
            // 'id',
            [
                'attribute' => 'doki',
                'format' => 'raw',
                'value' => function($model){
                    return  Html::a('Документ', $model->doki   );
                },
                'label' => 'Документы',

            ],
            [
                'attribute' => 'view_practice_id',
                'label' => 'Вид практики',
                'format' => 'raw',
                'value' => function($model){
                    return  ViewPractice::findOne($model->view_practice_id)->title;
                // Specialization::findOne($model->specialization_id)->title;
                },
            ],
            // 'view_practice_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Documents $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
