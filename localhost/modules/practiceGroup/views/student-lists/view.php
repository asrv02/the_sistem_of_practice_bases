<?php


use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\bootstrap5\Modal;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\PracticeGroupSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Студеты группы на практику';

?>
<div class="practice-group-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Отправить на практику', ['#'], [
            'class' => 'btn btn-primary btn-send-students',
            'data' => [                
                'practice_group_id' => $practice_group_id
            ]
        ]) ?>
        <?= Html::a('Группы на практику', ['/practice-group/main/index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(['id' => 'students-pjax', 'linkSelector' => '.pagination a',]) ?>
        <?= GridView::widget([
            'id' => 'grid-students',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'class' => 'yii\grid\CheckboxColumn',
                    // 'checkboxOptions' => function(){
                    //     return [
                    //         'onchange' => '
                    //            var keys = $("#grid-students").yiiGridView("getSelectedRows");
                    //            $(this).parent().parent().toggleClass("select")
                    //         '
                    //     ];
                    // }
                    // you may configure additional properties here
                ],
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' => 'ФИО студента',
                    'value' => fn($model) => $model->student->fullName,
                ],
                [
                    'label' => 'Место прохождения практики',
                    'format' => 'raw',
                    'value' => function($model) use( $organization ) {
                        $text = '';

                        if( empty($model->organization_id) && empty($model->place_title) ) {
                            $text =  "<div class='p-2 bg-danger text-light fs-5' >Место не выбрано</div>"; 
                        } else {
                            $text = !empty($model->place_title) 
                                    ? $model->place_title
                                    : $organization[$model->organization_id]
                                    ;
                        }

                        return $text;
                    }
                ],
                [                
                    'label' => 'Назначение практики',
                    'value' => fn ($model) =>
                        // $this->render('modal.php', ['model' => $model, 'organization' => $organization,]),
                        Html::a('Отправить на предприятие', '', [
                            'class' => 'btn btn-primary btn-student-set',                        
                            'data' => [
                                // 'student_id' => $model->student_id,
                                'student_practice_id' => $model->id, 
                                'pjax' => '0'                           
                            ]
                        ]), 
                    'format' => 'raw',
                ],
            
                
            ],
        ]); ?>
    <?php Pjax::end(); ?>
    
    <?php
        Modal::begin([
                'id' => 'modal-practice',
                'title' => 'Выберите место практики для группы',
            ]);
    ?>        
        <div id = 'modal-practice-body' 
            data-practice_group_id ="<?= $practice_group_id ?>"   
            data-id_group ="<?= $id_group ?>"   

        >
        </div>       
        
    <?php  Modal::end(); ?>



    <?php   Modal::begin([
                'id' => 'modal-error',
                'title' => 'Ошибка',
                'size' => 'modal-lg',
                'headerOptions' => ['class' => 'bg-danger text-light'],

            ]);
    ?>        
        <div>
            <div id='error-text' class='text-danger '></div>
            <div class= 'mt-5 text-end'>
                <span class="btn btn-primary" data-bs-dismiss="modal">Закрыть</span>
            </div>
        </div>
      
        
    <?php Modal::end(); ?>

    <?php $this->registerJsFile('/js/my.js', [
        'depends' => [
            'yii\web\YiiAsset',
            'yii\bootstrap5\BootstrapAsset'
        ]
    ]) ?>

</div>
