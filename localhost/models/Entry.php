<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entry".
 *
 * @property int $id
 * @property int $specialization_id
 * @property int $organization_name_id
 * @property int $quantity
 * @property string $contacts
 *
 * @property OrganizationName $organizationName
 * @property Specialization $specialization
 */
class Entry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entry';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['specialization_id', 'organization_name_id', 'quantity', 'contacts'], 'required'],
            [['specialization_id', 'organization_name_id', 'quantity'], 'integer'],
            [['contacts'], 'string', 'max' => 255],
            [['organization_name_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationName::className(), 'targetAttribute' => ['organization_name_id' => 'id']],
            [['specialization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Specialization::className(), 'targetAttribute' => ['specialization_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'specialization_id' => 'Специализация',
            'organization_name_id' => 'Наименование организации',
            'quantity' => 'Количество',
            'contacts' => 'Контакты',
        ];
    }

    /**
     * Gets query for [[OrganizationName]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizationName()
    {
        return $this->hasOne(OrganizationName::className(), ['id' => 'organization_name_id']);
    }

    /**
     * Gets query for [[Specialization]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialization()
    {
        return $this->hasOne(Specialization::className(), ['id' => 'specialization_id']);
    }
}
