<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "applicationstud".
 *
 * @property int $id
 * @property int $employer_id
 * @property int $employer_lists_id
 * @property int $specialization_id
 * @property int $status_id
 * @property int $student_id
 *
 * @property User $employer
 * @property EmployerLists $employerLists
 * @property Specialization $specialization
 * @property Status $status
 * @property User $student
 */
class Applicationstud extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'applicationstud';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_id', 'employer_id', 'employer_lists_id', 'specialization_id', 'student_id', 'organization_name_id'], 'required'],
            [['status_id', 'employer_id', 'employer_lists_id', 'specialization_id', 'student_id', 'organization_name_id'], 'integer'],
            [['employer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['employer_id' => 'id']],
            [['employer_lists_id'], 'exist', 'skipOnError' => true, 'targetClass' => EmployerLists::class, 'targetAttribute' => ['employer_lists_id' => 'id']],
            [['specialization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Specialization::class, 'targetAttribute' => ['specialization_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['student_id' => 'id']],
            [['organization_name_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationName::class, 'targetAttribute' => ['organization_name_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status_id' => 'Status ID',
            'employer_id' => 'Employer ID',
            'employer_lists_id' => 'Employer Lists ID',
            'specialization_id' => 'Specialization ID',
            'student_id' => 'Student ID',
            'organization_name_id' => 'Organization Name ID',
        ];
    }

    /**
     * Gets query for [[Employer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployer()
    {
        return $this->hasOne(User::className(), ['id' => 'employer_id']);
    }

    /**
     * Gets query for [[EmployerLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployerLists()
    {
        return $this->hasOne(EmployerLists::className(), ['id' => 'employer_lists_id']);
    }

    /**
     * Gets query for [[OrganizationName]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizationName()
    {
        return $this->hasOne(OrganizationName::class, ['id' => 'organization_name_id']);
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

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(User::className(), ['id' => 'student_id']);
    }
}
