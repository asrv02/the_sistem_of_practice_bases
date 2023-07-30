<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "year".
 *
 * @property int $id
 * @property string $title
 * @property int $begin_date
 * @property int $end_date
 *
 * @property Holiday[] $holidays
 * @property SemesterYear[] $semesterYears
 */
class Year extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'year';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'begin_date', 'end_date'], 'required'],
            [['begin_date', 'end_date'], 'integer'],
            [['title'], 'string', 'max' => 255],
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
            'begin_date' => 'Begin Date',
            'end_date' => 'End Date',
        ];
    }

    /**
     * Gets query for [[Holidays]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHolidays()
    {
        return $this->hasMany(Holiday::className(), ['year_id' => 'id']);
    }

    /**
     * Gets query for [[SemesterYears]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemesterYears()
    {
        return $this->hasMany(SemesterYear::className(), ['year_id' => 'id']);
    }
}
