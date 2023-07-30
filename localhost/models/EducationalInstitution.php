<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "educational_institution".
 *
 * @property int $id
 * @property string $title
 *
 * @property Resume[] $resumes
 */
class EducationalInstitution extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'educational_institution';
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
        return $this->hasMany(Resume::class, ['educational_institution_id' => 'id']);
    }

    public static function getEducationalInstitutionList() 
    {
        return static::find()->select(['title'])->indexBy('id')->column();
    }
}
