<?php
    use yii\bootstrap4\Modal;
    use kartik\date\DatePicker;
    use yii\bootstrap5\Html;
    /* @var $model app\models\UserSearch */
    use yii\widgets\ActiveForm; 
    use app\models\ViewPractice;
?>
        <?php
            Modal::begin([
                    'title' => 'Выберите место практики для группы',
                    'toggleButton' => ['label' => 'Отправить на предприятие', 'class' => 'btn btn-primary'],
                ]);
        ?>
            <div class="row" style="margin-bottom: 8px">
                <?php
                     $form = ActiveForm::begin([
                        'id' => 'move-form_'.$model->id,
                        'options' => [
                            'class'  => 'form-horizontal',
                        ],
                        'action' => Yii::$app->urlManager->createUrl(['/student-practice/default/move', 'id' => $model->id])
                    ])
                ?>   
                

                <?# $form->field(ViewPractice::findOne($model->group_id)->title)->textInput(['disabled' => 'disabled']); ?>
                <?= $form->field($model, 'group_id')->textInput(['disabled' => 'disabled']); ?>
                <?= $form->field($model, 'view_practice_id')->textInput(['disabled' => 'disabled']); ?>
                <?# $form->field($model, 'view_practice_id')->dropdownList($viewPractice, ['prompt' => 'выберите вид практики']) ?>
                

                <div class="form-group">
                    <div class="col-lg-offset-1 col-lg-11">
                        <?= Html::submitButton('Отправить на предприятие', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
                
                <?php ActiveForm::end() ?>

            </div>
        <?php Modal::end(); ?>
