<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property int $status_id
 * @property int $student_lists_id
 * @property int $student_id
 * @property int $employer_id
 * @property int $organization_id
 *
 * @property User $employer
 * @property Organization $organization
 * @property Status $status
 * @property User $student
 * @property StudentLists $studentLists
 */
class Application extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_id','student_id', 'employer_id', 'organization_id'], 'required'],
            [['status_id',  'student_id', 'employer_id', 'organization_id'], 'integer'],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['student_id' => 'id']],
            [['employer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['employer_id' => 'id']],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::class, 'targetAttribute' => ['organization_id' => 'id']],
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
            'student_id' => 'Student ID',
            'employer_id' => 'Employer ID',
            'organization_id' => 'Organization ID',
        ];
    }

        /**
     * Gets query for [[Employer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployer()
    {
        return $this->hasOne(User::class, ['id' => 'employer_id']);
    }


    /**
     * Gets query for [[Organization]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::class, ['id' => 'organization_id']);
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

    /**
     * Gets query for [[StudentLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentLists()
    {
        return $this->hasOne(StudentLists::className(), ['id' => 'student_lists_id']);
    }
        /**
     * Gets query for [[AuthAssignment]].
     *
     * @return \yii\db\ActiveQuery
     */
    
     public function getAuthAssignment()
     {
         return $this->hasMany(AuthAssignment::className(), ['user_id' => 'id']);
     }
}
