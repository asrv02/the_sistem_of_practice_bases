<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_lists".
 *
 * @property int $id
 * @property int $student_id
 * @property int $specialization_id
 * @property string $practice_date_from
 * @property string $practice_date_to
 *
 * @property Application[] $applications
 * @property Specialization $specialization
 * @property User $student
 */
class StudentLists extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_lists';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'specialization_id', 'practice_date_to' , 'practice_date_from'], 'required'],
            [['student_id', 'specialization_id'], 'integer'],
            [['practice_date_from', 'practice_date_to'], 'safe'],
            [['specialization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Specialization::class, 'targetAttribute' => ['specialization_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'ФИО студента',
            'specialization_id' => 'Специальность',
            'practice_date_from' => 'Начало практики',
            'practice_date_to' => 'Конец практики',
        ];
    }

    /**
     * Gets query for [[Specialization]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialization()
    {
        return $this->hasOne(Specialization::className(), ['id' => 'specialization_id']);
    }
    public function getStudentLists()
    {
        return $this->hasOne(StudentLists::className(), ['id' => 'student_id']);
    }

    public function getAuthAssignment()
    {
        return $this->hasMany(AuthAssignment::className(), ['user_id' => 'id']);
    }

    public function getAplication()
    {
        return $this->hasMany(Application::className(), ['student_lists_id' => 'id']);
    }
    
    public static function getSpecializationList() 
    {
        return static::find()->select(['title'])->indexBy('id')->column();
    }

    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['student_id' => 'id']);
    }


    // public static function getStudentLists()
    // {
    //     return static::find()->select(['title'])->indexBy('id')->column();
    // }
    
	/**
    * Gets query for [[Student]].
    *
    * @return \yii\db\ActiveQuery
    */
    public function getStudent()
    {
        return $this->hasOne(User::class, ['id' => 'student_id']);
    }


}
