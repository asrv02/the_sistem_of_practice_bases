<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Application;

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
                'label' => 'ФИО студента',
                'value' => function($model){
                    return $model->student->fullName;
                },
                'filter' => false,
            ],
            // 'employer_lists_id',
            // 'specialization_id',
            [
                'attribute' => 'specialization_id',
                'value' => function($model){
                    return $model->specialization->title;
                },              
                'label' => 'Специальность',
                'filter' => $specialization,
            ],
            [
                'attribute' => 'status_id',
                'value' => function($model){
                    return $model->status->title;
                },              
                'label' => 'Статус',
                'filter' => $status,
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{approve} | {decline}',
                'buttons' => [
                    'approve' => function ($url, $model) {
                        return Html::a('Согласиться', $url, [
                            'title' => Yii::t('app', 'Согласиться'),
                        ]);
                    },
                    'decline' => function ($url, $model) {
                        return Html::a('Отклонить', $url, [
                            'title' => Yii::t('app', 'Отклонить'),
                        ]);
                    }
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'approve') {
                        return Url::to(['/applicationstud/default/approve_employer', 'id' => $model->id]);
                    } else if ($action === 'decline') {
                        return Url::to(['/applicationstud/default/decline_employer', 'id' => $model->id]);
                    }
                }
            ],
        ],
    ]); ?>


</div>