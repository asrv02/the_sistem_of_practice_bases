<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\EducationReceived;
use app\models\Specialization;
use app\models\EducationalInstitution;
use app\models\TrainingForm;

/* @var $this yii\web\View */
/* @var $model app\models\Resume */

$this->title = $model->name;
\yii\web\YiiAsset::register($this);
?>
<div class="resume-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Документы на практику', ['/documents/', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'specialization_id',
            'surname',
            'name',
            'patronymic',
            'phone',
            'email:email',
            // 'education_received_id',
            [
                'attribute' => 'education_received_id',
                'value' => function($model){
                    // return $model->education_received_id->title;
                    return EducationReceived::findOne($model->education_received_id)->title;
                },              
                'label' => 'Получаемое образование',
            ],
            // 'educational_institution_id',
            [
                'attribute' => 'educational_institution_id',
                'value' => function($model){
                    return EducationalInstitution::findOne($model->educational_institution_id)->title;
                },              
                'label' => 'Учебное заведение',
            ],
            // 'faculty:ntext',
            // 'specialization_id',
            [
                'attribute' => 'specialization_id',
                'value' => function($model){
                    return Specialization::findOne($model->specialization_id)->title;
                },              
                'label' => 'Специальность',
            ],

            // 'specialization:ntext',
            // 'training_form_id',
            [
                'attribute' => 'training_form_id',
                'value' => function($model){
                    return TrainingForm::findOne($model->training_form_id)->title;
                },              
                'label' => 'Форма обучения',
            ],
        ],
    ]) ?>

</div>