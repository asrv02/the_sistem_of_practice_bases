<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "education_received".
 *
 * @property int $id
 * @property string $title
 *
 * @property Resume[] $resumes
 */
class EducationReceived extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'education_received';
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
     * Gets query for [[Resumes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResumes()
    {
        return $this->hasMany(Resume::class, ['education_received_id' => 'id']);
    }

    public static function getEducationReceivedList() 
    {
        return static::find()->select(['title'])->indexBy('id')->column();
    }
}
