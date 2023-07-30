<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "placepractice".
 *
 * @property int $id
 * @property string $title
 * @property string $link
 * @property string $date
 * @property int $group_id
 */
class Placepractice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'placepractice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'link', 'date', 'group_id'], 'required'],
            [['date'], 'safe'],
            [['group_id'], 'integer'],
            [['title', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Наименование практики',
            'link' => 'Ссылка на запись',
            'date' => 'Дата добавления',
            'group_id' => 'ID группы',
        ];
    }

    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }
}