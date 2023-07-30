<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "training_form".
 *
 * @property int $id
 * @property string $title
 *
 * @property Resume[] $resumes
 */
class TrainingForm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'training_form';
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
        return $this->hasMany(Resume::class, ['training_form_id' => 'id']);
    }

    public static function getTrainingFormList() 
    {
        return static::find()->select(['title'])->indexBy('id')->column();
    }
}
