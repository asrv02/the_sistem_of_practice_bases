<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status_loading".
 *
 * @property int $id
 * @property string $title
 *
 * @property PracticeGroup[] $practiceGroups
 * @property StudentPractice[] $studentPractices
 */
class StatusLoading extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status_loading';
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
     * Gets query for [[PracticeGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPracticeGroups()
    {
        return $this->hasMany(PracticeGroup::class, ['status_loading_id' => 'id']);
    }

    /**
     * Gets query for [[StudentPractices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentPractices()
    {
        return $this->hasMany(StudentPractice::class, ['status_loading_id' => 'id']);
    }

    public static function getStatusLoading()
    {
        return static::find()->select('title')->indexBy('id')->column();
    }
}
