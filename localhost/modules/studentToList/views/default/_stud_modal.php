<?php
    use yii\bootstrap4\Modal;
    use kartik\date\DatePicker;
    use yii\bootstrap5\Html;
    /* @var $model app\models\UserSearch */
    use yii\widgets\ActiveForm; 
?>
        <?php
            Modal::begin([
                    'title' => 'Введите дату практики и подтвердите выбор',
                    'toggleButton' => ['label' => 'Разрешить практику', 'class' => 'btn btn-primary'],
                ]);
        ?>
            <div class="row" style="margin-bottom: 8px">
                <?php
                     $form = ActiveForm::begin([
                        'id' => 'move-form_'.$model->id,
                        'options' => [
                            'class'  => 'form-horizontal',
                        ],
                        'action' => Yii::$app->urlManager->createUrl(['/student-to-list/default/move', 'id' => $model->id])
                    ])
                ?>   
                <div class="form-group">
                    <label class="form-label">Начало практики</label>
                        <?= DatePicker::widget(
                                [
                                    'name' => 'date_from',
                                    'removeButton' => false,
                                     'options' => [
                                        'placeholder' => 'Выберите дату...',
                                        'required' => 'required'
                                    ], 
                                    'pluginOptions' => ['autoclose' => true]
                                ]);
                            ?>
                        </div>
                </div>   
                <div class="form-group">
                <label class="form-label">Конец практики</label>
                    <?= DatePicker::widget(
                        [
                            'name' => 'date_to',
                            'removeButton' => false,
                                'options' => [
                                'placeholder' => 'Выберите дату...',
                                'required' => 'required'
                            ], 
                            'pluginOptions' => ['autoclose' => true]
                        ]);
                    ?>
                </div>  
                <?= $form->field($model, 'name')->textInput(['disabled' => 'disabled'])->label('Имя'); ?>
                <?= $form->field($model, 'surname')->textInput(['disabled' => 'disabled']); ?>
                <?= $form->field($model, 'patronymic')->textInput(['disabled' => 'disabled']); ?>
                <?# $form->field($model, 'group_id')->textInput(['disabled' => 'disabled']); ?>
                <?= $form->field($model, 'course')->textInput(['disabled' => 'disabled']); ?>
                <?= $form->field($model, 'specialization_id')->textInput(['disabled' => 'disabled']); ?>

                <div class="form-group">
                    <div class="col-lg-offset-1 col-lg-11">
                        <?= Html::submitButton('Разрешить практику', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
                
                <?php ActiveForm::end() ?>

            </div>
        <?php Modal::end(); ?>
