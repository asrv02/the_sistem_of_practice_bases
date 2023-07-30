<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "semester".
 *
 * @property int $id
 * @property string $title
 *
 * @property SemesterYear[] $semesterYears
 */
class Semester extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'semester';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
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
        ];
    }

    /**
     * Gets query for [[SemesterYears]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemesterYears()
    {
        return $this->hasMany(SemesterYear::className(), ['semester_id' => 'id']);
    }
}
