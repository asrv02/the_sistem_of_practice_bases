<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\db\Query;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "student_practice".
 *
 * @property int $id
 * @property int $student_id
 * @property int $practice_group_id
 * @property int|null $place_enterprises_id
 * @property string|null $place_title
 * @property string $report
 * @property int $status_loading_id
 *
 * @property PlaceEnterprises $placeEnterprises
 * @property PracticeGroup $practiceGroup
 * @property User $student
 */
class StudentPractice extends \yii\db\ActiveRecord
{

    public $group_id;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_practice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'practice_group_id', 'status_loading_id'], 'required'],
            [['student_id', 'practice_group_id', 'organization_id', 'status_loading_id', 'group_id'], 'integer'],
            [[ 'report','place_title'], 'string'],
            [['practice_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => PracticeGroup::class, 'targetAttribute' => ['practice_group_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['student_id' => 'id']],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::class, 'targetAttribute' => ['organization_id' => 'id']],
            [['status_loading_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusLoading::class, 'targetAttribute' => ['status_loading_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'practice_group_id' => 'Practice Group ID',
            'organization_id' => 'Place Enterprises ID',
            'place_title' => 'Place Title',
            'report' => 'Report',
            'status_loading_id' => 'Status Loading ID',
        ];
    }

    /**
     * Gets query for [[PlaceEnterprises]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::class, ['id' => 'organization_id']);
    }

    /**
     * Gets query for [[PracticeGroup]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPracticeGroup()
    {
        return $this->hasOne(PracticeGroup::class, ['id' => 'practice_group_id']);
    }

     /**
     * Gets query for [[StatusLoading]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatusLoading()
    {
        return $this->hasOne(StatusLoading::class, ['id' => 'status_loading_id']);
    } 
    
    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(User::class, ['id' => 'student_id']);
    }

    public static function getStudentPracticCount($id_group,$id_practic_group)
    {/*
        select count(*)
from student_practice sp
where 
sp.practice_group_id = 1
AND
sp.student_id in (
SELECT
    `user`.id
FROM
    `user`
INNER JOIN `student_group` ON student_group.student_id = `user`.id
WHERE
    student_group.group_id = 1
)   

SELECT * 

FROM (SELECT `user`.`id` FROM `user` INNER JOIN `student_group` `st_g` ON st_g.student_id = `user`.id WHERE `st_g`.`group_id`='1') st
 
left join `student_practice` `sp` ON `sp`.`practice_group_id`='5' and  st.id = sp.student_id
WHERE  
`sp`.id is null  
    */


        $st = (new Query())
                    ->select('`user`.id')
                    ->from('user')
                    ->innerJoin(['st_g' => 'student_group'], 'st_g.student_id = `user`.id')
                    ->where(['st_g.group_id' => $id_group])                    
                    ;
                    // VarDumper::dump($st->createCommand()->rawSql, 10, true); 
                    
        $q = (new Query())
                    ->select('*')                    
                    ->from(['st' => $st])
                    ->leftJoin(['sp' => 'student_practice'], "`sp`.`practice_group_id`= {$id_practic_group} and  st.id = sp.student_id")
                    ->where(['sp.id' => null]) 
                    ->count()
                    ;
        
        // VarDumper::dump($q->createCommand()->rawSql, 10, true); die;

        return !(boolean)$q;
    }

    public static function addStudentPracticGroup($id_group,$id_practic_group)
    {
        $st = (new Query())
                    ->select('`user`.id')
                    ->from('user')
                    ->innerJoin(['st_g' => 'student_group'], 'st_g.student_id = `user`.id')
                    ->where(['st_g.group_id' => $id_group])                    
                    ;
                    $q = (new Query())
                    ->select(['st.id as student_id',  "CONCAT($id_practic_group) AS practice_group_id"])                    
                    ->from(['st' => $st])
                    ->leftJoin(['sp' => 'student_practice'], "`sp`.`practice_group_id`= {$id_practic_group} and  st.id = sp.student_id")
                    ->where(['sp.id' => null])                     
                    ;            
        $query = "insert into student_practice(student_id, practice_group_id) "
                    // . "SELECT `user`.id AS student_id,    CONCAT($id_practic_group) AS practice_group_id "
                    // . "FROM `user` "
                    // . "INNER JOIN `student_group` ON student_group.student_id = `user`.id "
                    // . "WHERE student_group.group_id = " . $id_group;       
                    . $q->createCommand()->rawSql;

        return Yii::$app->db->createCommand($query)->execute();
    }

    public static function getPracticGroupStat($id_practice_group) 
    {
        $query_no = (new Query())
                    ->from('student_practice')
                    ->where(['organization_id' => null])
                    ->andWhere(['or', ['place_title' => null], (new Expression('length(trim(place_title)) = 0')) ])
                    ->andWhere(['practice_group_id' => $id_practice_group])
                    ->count()
                    ;

        $query_yes =  (new Query())
                        ->from('student_practice')
                        ->where(['is not', 'organization_id', null])
                        ->orWhere(['or', ['is not', 'place_title', null], (new Expression('length(trim(place_title)) > 0')) ])
                        ->andWhere(['practice_group_id' => $id_practice_group])
                        ->count()
                        ;           
        return ['no' => $query_no, 'yes' => $query_yes];            
    }

}
