<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "place_enterprises".
 *
 * @property int $id
 * @property string $title
 */
class PlaceEnterprises extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'place_enterprises';
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
            'title' => 'Наименование предприятия',
        ];
    }

    public static function getEnterprises()
    {
        return static::find()->indexBy('id')->select('title')->column();
    }

     /**
     * Gets query for [[UserInterprises]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserInterprises()
    {
        return $this->hasMany(UserInterprise::class, ['place_interprise_id' => 'id']);
    }
}
