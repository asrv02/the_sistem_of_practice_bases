<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_practice".
 *
 * @property int $id
 * @property string $title
 *
 * @property PracticeGroup[] $practiceGroups
 */
class ViewPractice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_practice';
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
        return $this->hasMany(PracticeGroup::class, ['view_practice_id' => 'id']);
    }

    public static function getViewPractice() 
    {
        return static::find()->select(['title'])->indexBy('id')->column();
    }

        public static function getViewPracticeList() 
    {
        return static::find()->select(['title'])->indexBy('id')->column();
    }


}
