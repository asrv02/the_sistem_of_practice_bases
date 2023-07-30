<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property int $id
 * @property string $title
 * @property int $specialization_id
 *
 * @property SemesterDate[] $semesterDates
 * @property Specialization $specialization
 * @property StudentGroup[] $studentGroups
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'specialization_id'], 'required'],
            [['specialization_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['specialization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Specialization::className(), 'targetAttribute' => ['specialization_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'specialization_id' => 'Specialization ID',
        ];
    }

    /**
     * Gets query for [[SemesterDates]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemesterDates()
    {
        return $this->hasMany(SemesterDate::className(), ['group_id' => 'id']);
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
     * Gets query for [[StudentGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentGroups()
    {
        return $this->hasMany(StudentGroup::class, ['group_id' => 'id']);
    }

    public static function getGroupList() 
    {
        return static::find()->select('title')->indexBy('id')->column();
    }
}
