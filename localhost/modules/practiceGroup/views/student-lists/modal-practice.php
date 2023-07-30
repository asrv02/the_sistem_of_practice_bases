<?php
    use yii\bootstrap5\Html;
    use yii\bootstrap5\ActiveForm; 
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
        <input type="text" class="form-control" name="StudentPractice[org]" aria-required="true"
            disabled="disabled"
        value="<?= $model->viewPractice->title ?>" 
        >
    </div>
    
    <?= $form->field($model, 'tmp_organization_id')->dropdownList($organization, ['id' => 'id-org', 'prompt' => 'выберите место практики'])->label('Предприятие'); ?>
    <?= $form->field($model, 'tmp_place_title')->textInput(['id' => 'place-practice'])->label('Место прохождения') ?>
    <?= Html::textInput('student-list', json_encode($student_practice_id), ['type'=>'hidden', 'class' => 'student-list']) ?>


    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::a('Отправить на практику','', ['class' => 'btn btn-primary modal-practice-send',
                'data' => [
                    // 'student_id' => $model->student_id,
                    // 'student_practice_id' => $model->id,
                    'practice_group_id' => $id_practice_group,
                    // 'student_practice_id' => 
                ]
            ]) ?>
        </div>
    </div>
    
    <?php ActiveForm::end() ?>
</div>