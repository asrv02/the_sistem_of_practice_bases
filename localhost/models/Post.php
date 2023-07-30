<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $title
 *
 * @property UserInterprise[] $userInterprises
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
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
     * Gets query for [[UserInterprises]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserInterprises()
    {
        return $this->hasMany(UserInterprise::class, ['post_id' => 'id']);
    }

    public static function getPostTitle()
    {
        return static::find()->select('title')->indexBy('id')->column();
    }
}
