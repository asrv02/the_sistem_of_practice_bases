<?php

use app\models\UserInterprise;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\UserInterpriseSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Списки работодателей';
?>
<div class="user-interprise-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <!-- <p>
        <?= Html::a('Create User Interprise', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           
            [ 
                'attribute' => 'user_id',
                'label' => 'ФИО',
                'value' => fn($model) => $model->user->fullName,

            ],
            [
                'attribute' => 'organization_id',
                'label' => 'Организация',
                'value' => fn($model) => $model->organization->title,
            ],
            [
                'attribute' => 'post_id',
                'label' => 'Должность',
                'value' => fn($model) => $model->post->title,
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{toApplication}',
                'buttons' => [
                    'toApplication' => function ($url, $model) {
                        return Html::a('Отправить заявку', $url, [
                            'title' => Yii::t('app', 'Отправить'), 'data-method' => 'post'
                        ]);
                    }
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'toApplication') {
                        return Url::to(['/user-interprise/default/move', 'id' => $model->id]);
                    }
                }
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, UserInterprise $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
