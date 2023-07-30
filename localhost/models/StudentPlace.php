<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_place".
 *
 * @property int $id
 * @property int $student_practice_id
 * @property string $text
 *
 * @property StudentPractice $studentPractice
 */
class StudentPlace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_practice_id', 'text'], 'required'],
            [['student_practice_id'], 'integer'],
            [['text'], 'string'],
            [['student_practice_id'], 'exist', 'skipOnError' => true, 'targetClass' => StudentPractice::class, 'targetAttribute' => ['student_practice_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_practice_id' => 'Student Practice ID',
            'text' => 'Text',
        ];
    }

    /**
     * Gets query for [[StudentPractice]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentPractice()
    {
        return $this->hasOne(StudentPractice::class, ['id' => 'student_practice_id']);
    }
}