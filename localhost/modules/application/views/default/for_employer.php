<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Application;
use app\models\Status;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ApplicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки';
?>
<div class="application-index">

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
            [
                'attribute' => 'student_id',
                'value' => function($model){
                    return $model->student->fullName;
                },              
                'label' => 'ФИО студента',
                'filter' => false,
            ],
            [
                'attribute' => 'organization_id',
                'value' => function ($model) {
                    return $model->organization->title;
                },
                'label' => 'Наименование организации',
            ],
            // 'employer_id',
            [
                'attribute' => 'status_id',
                'value' => function($model){
                    return $model->status->title;
                },              
                'label' => 'Статус',
                'filter' => $status,
            ],
            [
                'format' => 'raw',
                'value' => function($model){
                    $text = '';
                    //if ($model->status_id == Status::STATUS_ACTIVE) {
                        $text .= Html::a('Согласиться', '/application/default/approve_employer?id=' . $model->id) .
                        ' | ' . Html::a('Отклонить', '/application/default/decline_employer?id=' . $model->id);
                    //}

                    return $text;
                },
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