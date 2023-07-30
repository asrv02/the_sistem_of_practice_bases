<?php

use app\models\Resume;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\StudentLists;
use app\models\Student;
use app\models\StudentResume;
use yii\helpers\VarDumper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentListsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список студентов';
?>
<div class="student-lists-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <p>
        <?= Html::a('Create Student Lists', ['create'], ['class' => 'btn btn-success']) ?>
    </p>   -->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            //'student_id',
            // [
            //     'attribute' => 'student_id',
            //     'value' => function($model){
            //         return Student::findOne($model->student_id)->name . ' ' . Student::findOne($model->student_id)->surname . ' ' . Student::findOne($model->student_id)->patronymic;
            //         // return $model->student_id->name . ' ' . $model->student_id->surname . ' ' . $model->student_id->patronymic;
            //     },              
            //     'label' => 'ФИО студента',
            //     'filter' => false,
            // ],
            // 'specialization_id',
            [
                'attribute' => 'student_id',
                'format' => 'raw',
                'value' => function ($model) {
                    $text = '';
                    $resume = StudentResume::findOne(['student_id' => $model->student->id]);
                    
                    if ($resume) {
                        $text .= Html::a($model->student->fullName, '/icons/default/view?id=' . $resume->resume->id);
                    } else {
                        $text .= $model->student->fullName;
                    }
                    return $text;
                },
            ],
            [
                'attribute' => 'specialization_id',
                'value' => function($model){
                    // return Specialization::findOne($model->specialization_id)->title;
                    return $model->specialization->title;
                },              
                'label' => 'Специализация',
                'filter' => $specializations,
            ],
            
            [
                'label' => 'Начало практики',
                'value' => function ($model) {
                    return date('d.m.Y',strtotime($model->practice_date_from) );
                },
            ],
            [
                'label' => 'Конец практики',
                'value' => function ($model) {
                    return date('d.m.Y',strtotime($model->practice_date_to) );
                },
                // 'format' => ['date', 'd.m.Y'],
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{toApplication}',
                'buttons' => [
                    'toApplication' => function ($url, $model) {
                        return Html::a('Отправить заявку', $url, [
                            'title' => Yii::t('app', 'Отправить'),
                        ]);
                    }
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'toApplication') {
                        return Url::to(['/student_lists/default/move', 'id' => $model->id]);
                    }
                }
            ],
        ],
    ]); ?>


</div>
