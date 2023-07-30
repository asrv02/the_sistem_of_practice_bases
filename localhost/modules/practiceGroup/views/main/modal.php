<?php
    use yii\bootstrap4\Modal;
    use kartik\date\DatePicker;
    use yii\bootstrap5\Html;
    /* @var $model app\models\UserSearch */
    use yii\bootstrap4\ActiveForm; 
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
                        'action' => Yii::$app->urlManager->createUrl(['/practice-group/main/set', 'id' => $model->id])
                    ])
                ?>   
                

                <?# $form->field(ViewPractice::findOne($model->group_id)->title)->textInput(['disabled' => 'disabled']); ?>
                <?= $form->field($model, 'group_id')->textInput(['disabled' => 'disabled', 'value' => $model->group->title]); ?>                
                <?= $form->field($model, 'view_practice_id')->textInput(['disabled' => 'disabled', 'value' => $model->viewPractice->title]); ?>                
                <?= $form->field($model, 'organization_id')->dropdownList( $organization, ['prompt' => 'выберите место практики', 'required' => true])->label('Предприятие'); ?>
                <?# $form->field($model, 'view_practice_id')->dropdownList($viewPractice, ['prompt' => 'выберите вид практики']) ?>
                

                <div class="form-group">
                    <div class="col-lg-offset-1 col-lg-11">
                        <?= Html::submitButton('Отправить на предприятие', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
                
                <?php ActiveForm::end() ?>

            </div>
        <?php Modal::end(); ?>
