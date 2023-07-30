<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "practice_group".
 *
 * @property int $id
 * @property int $view_practice_id
 * @property int $group_id
 * @property string $begin_date
 * @property string $end_date
 * @property int $documents_id
 *
 * @property Group $group
 * @property ViewPractice $viewPractice
 */
class PracticeGroup extends \yii\db\ActiveRecord
{
    public $organization_id;
    public $tmp_organization_id;
    public $tmp_place_title;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'practice_group';
    }

    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['view_practice_id', 'group_id', 'documents_id'], 'required'],
            [['view_practice_id', 'group_id', 'documents_id', 'organization_id'], 'integer'],
            [['begin_date', 'end_date'], 'safe'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::class, 'targetAttribute' => ['group_id' => 'id']],
            [['view_practice_id'], 'exist', 'skipOnError' => true, 'targetClass' => ViewPractice::class, 'targetAttribute' => ['view_practice_id' => 'id']],
            [['documents_id'], 'exist', 'skipOnError' => true, 'targetClass' => Documents::class, 'targetAttribute' => ['documents_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'view_practice_id' => 'Вид практики',
            'group_id' => 'Группа',
            'begin_date' => 'Начало практики',
            'end_date' => 'Конец практики',
            'documents_id' => 'Документы по практике',
        ];
    }

    /**
     * Gets query for [[Documents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasOne(Documents::class, ['id' => 'documents_id']);
    }



    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::class, ['id' => 'group_id']);
    }
    
        /**
     * Gets query for [[StudentPractices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentPractices()
    {
        return $this->hasMany(StudentPractice::class, ['practice_group_id' => 'id']);
    }


    /**
     * Gets query for [[ViewPractice]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getViewPractice()
    {
        return $this->hasOne(ViewPractice::class, ['id' => 'view_practice_id']);
    }

    public static function getGroupList() 
    {
        return static::find()->select(['CONCAT(group.title,\': \',view_practice.title)'])
        ->join('INNER JOIN', 'group', 'group_id = group.id')
        ->join('INNER JOIN', 'view_practice', 'view_practice_id = view_practice.id')
        ->indexBy('id')->column();
    }

    
}
