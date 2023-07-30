<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "semester_year".
 *
 * @property int $id
 * @property int $year_id
 * @property int $semester_id
 * @property int $begin_date
 * @property int $end_date
 *
 * @property Practice[] $practices
 * @property Semester $semester
 * @property SemesterDate[] $semesterDates
 * @property Year $year
 */
class SemesterYear extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'semester_year';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year_id', 'semester_id', 'begin_date', 'end_date'], 'required'],
            [['year_id', 'semester_id', 'begin_date', 'end_date'], 'integer'],
            [['year_id'], 'exist', 'skipOnError' => true, 'targetClass' => Year::className(), 'targetAttribute' => ['year_id' => 'id']],
            [['semester_id'], 'exist', 'skipOnError' => true, 'targetClass' => Semester::className(), 'targetAttribute' => ['semester_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year_id' => 'Year ID',
            'semester_id' => 'Semester ID',
            'begin_date' => 'Begin Date',
            'end_date' => 'End Date',
        ];
    }

    /**
     * Gets query for [[Practices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPractices()
    {
        return $this->hasMany(Practice::className(), ['semester_id' => 'id']);
    }

    /**
     * Gets query for [[Semester]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemester()
    {
        return $this->hasOne(Semester::className(), ['id' => 'semester_id']);
    }

    /**
     * Gets query for [[SemesterDates]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemesterDates()
    {
        return $this->hasMany(SemesterDate::className(), ['semester_id' => 'id']);
    }

    /**
     * Gets query for [[Year]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getYear()
    {
        return $this->hasOne(Year::className(), ['id' => 'year_id']);
    }
}
