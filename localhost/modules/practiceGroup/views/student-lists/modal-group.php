<?php
    use yii\bootstrap4\Html;
    use yii\bootstrap4\ActiveForm; 
?>

            <div style="margin-bottom: 8px">
                <?php $form = ActiveForm::begin() ?>   

                <div class="form-group field-studentpractice-place_title required">
                    <label for="studentpractice-group">Группа</label>
                    <input type="text" id="studentpractice-group" class="form-control" name="StudentPractice[group]" aria-required="true"
                     disabled="disabled"
                    value="<?= $model->group->title ?>" 
                    >
                </div>
                <div class="form-group field-practice-place_title required">
                    <label for="practice">Практика</label>
                    <input type="text" id="org" class="form-control" name="StudentPractice[org]" aria-required="true"
                     disabled="disabled"
                    value="<?= $model->viewPractice->title ?>" 
                    >
                </div>
                
                
                <?# $form->field($model, 'view_practice_id')->dropdownList($viewPractice, ['prompt' => 'выберите вид практики']) ?>              
                <?# $form->field($model, 'tmp_organization_id')->dropdownList($organization, ['id' => 'id-org', 'prompt' => 'выберите место практики'])->label('Предприятие'); ?>
                <?# $form->field($model, 'tmp_place_title')->textInput(['id' => 'place-practice'])->label('Место прохождения') ?>
                

                <div class="form-group">
                    <div class="col-lg-offset-1 col-lg-11">
                        <?= Html::a('Отправить на практику','', ['class' => 'btn btn-primary students-send',
                            'data' => [
                                // 'student_id' => $model->student_id,
                                // 'student_practice_id' => $model->id,
                                // 'practice_group_id' => $model->practice_group_id,
                                // 'student_practice_id' => $student_practice_id
                            ]
                        ]) ?>
                    </div>
                </div>
                
                <?php ActiveForm::end() ?>
            </div>