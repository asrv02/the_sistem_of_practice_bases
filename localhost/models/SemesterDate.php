<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "semester_date".
 *
 * @property int $id
 * @property int $begin_date
 * @property int $end_date
 * @property int $group_id
 * @property int $semester_id
 *
 * @property Group $group
 * @property SemesterYear $semester
 */
class SemesterDate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'semester_date';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['begin_date', 'end_date', 'group_id', 'semester_id'], 'required'],
            [['begin_date', 'end_date', 'group_id', 'semester_id'], 'integer'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['semester_id'], 'exist', 'skipOnError' => true, 'targetClass' => SemesterYear::className(), 'targetAttribute' => ['semester_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'begin_date' => 'Begin Date',
            'end_date' => 'End Date',
            'group_id' => 'Group ID',
            'semester_id' => 'Semester ID',
        ];
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    /**
     * Gets query for [[Semester]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemester()
    {
        return $this->hasOne(SemesterYear::className(), ['id' => 'semester_id']);
    }
}
