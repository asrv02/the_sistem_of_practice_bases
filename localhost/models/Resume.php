<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resume".
 *
 * @property int $id
 * @property int $specialization_id
 * @property string $surname
 * @property string $name
 * @property string $patronymic
 * @property int $phone
 * @property string $email
 * @property string $education_received
 * @property string $educational_institution
 * @property string $faculty
 * @property string $specialization
 * @property string $training_form
 *
 * @property Specialization $specialization0
 * @property StudentResume[] $studentResume
 */
class Resume extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resume';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['specialization_id', 'surname', 'name', 'patronymic', 'phone', 'email', 'education_received_id', 'educational_institution_id', 'training_form_id'], 'required'],
            [['specialization_id', 'phone', 'education_received_id', 'educational_institution_id', 'training_form_id'], 'integer'],
            [['faculty', 'specialization'], 'string'],
            [['surname', 'name', 'patronymic', 'email'], 'string', 'max' => 255],
            [['specialization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Specialization::class, 'targetAttribute' => ['specialization_id' => 'id']],
            [['education_received_id'], 'exist', 'skipOnError' => true, 'targetClass' => EducationReceived::class, 'targetAttribute' => ['education_received_id' => 'id']],
            [['training_form_id'], 'exist', 'skipOnError' => true, 'targetClass' => TrainingForm::class, 'targetAttribute' => ['training_form_id' => 'id']],
            [['educational_institution_id'], 'exist', 'skipOnError' => true, 'targetClass' => EducationalInstitution::class, 'targetAttribute' => ['educational_institution_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            // 'specialization_id' => 'Specialization ID',
            'surname' => 'Фамилия',
            'name' => 'Имя',
            'patronymic' => 'Отчество',
            'phone' => 'Мобильный телефон',
            'email' => 'Email',
            'education_received_id' => 'Получаемое образование',
            'educational_institution_id' => 'Учебное заведение',
            'faculty' => 'Факультет',
            'specialization_id' => 'Специальность',
            'training_form_id' => 'Форма обучения',
        ];
    }


    /**
     * Gets query for [[EducationReceived]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEducationReceived()
    {
        return $this->hasOne(EducationReceived::className(), ['id' => 'education_received_id']);
    }

    /**
     * Gets query for [[EducationalInstitution]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEducationalInstitution()
    {
        return $this->hasOne(EducationalInstitution::class, ['id' => 'educational_institution_id']);
    }

    /**
     * Gets query for [[Specialization0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialization0()
    {
        return $this->hasOne(Specialization::className(), ['id' => 'specialization_id']);
    }

    /**
     * Gets query for [[TrainingForm]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingForm()
    {
        return $this->hasOne(TrainingForm::class, ['id' => 'training_form_id']);
    }

    /**
     * Gets query for [[StudentResumes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentResume()
    {
        return $this->hasOne(StudentResume::className(), ['resume_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ( $insert ) {
            $studentResume = new StudentResume();
            $studentResume->resume_id = $this->id;
            $studentResume->student_id = Yii::$app->user->id;
            // VarDumper::dump($this->save()); die();
            $studentResume->save();
        }
    }

    // public static function getSpecializationList()
    // {
    //     return static::find()->select(['title'])->indexBy('id')->column();
    // }
}