<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "organization".
 *
 * @property int $id
 * @property string $title
 * @property string $address
 * @property string $email
 * @property int $phone
 *
 * @property StudentPractice[] $studentPractices
 * @property UserInterprise[] $userInterprises
 */
class Organization extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'organization';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'address', 'email', 'phone'], 'required'],
            [['phone'], 'integer'],
            [['title', 'address', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Наименование организации',
            'address' => 'Адрес',
            'email' => 'Email',
            'phone' => 'Номер телефона',
        ];
    }

        /**
     * Gets query for [[Applications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplications()
    {
        return $this->hasMany(Application::class, ['organization_id' => 'id']);
    }
    
    /**
     * Gets query for [[StudentPractices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentPractices()
    {
        return $this->hasMany(StudentPractice::class, ['organization_id' => 'id']);
    }

    /**
     * Gets query for [[UserInterprises]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserInterprises()
    {
        return $this->hasMany(UserInterprise::class, ['organization_id' => 'id']);
    }

    public static function getOrganization()
    {
        return static::find()->indexBy('id')->select('title')->column();
    }

}
