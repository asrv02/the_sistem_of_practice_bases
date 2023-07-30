<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StudentLists;
use app\models\Specialization;
use Yii;


/**
 * StudentListsSearch represents the model behind the search form of `app\models\StudentLists`.
 */
class StudentListsSearch extends StudentLists
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'student_id', 'specialization_id'], 'integer'],
            [['practice_date_from', 'practice_date_to'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = StudentLists::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // $user = User::findOne(Yii::$app->user->id);
        // if(!$user->organization){
        //    return $dataProvider;
        // }

        /*$query->leftJoin('application',
            'application.organization_name_id = :org AND application.student_lists_id =student_lists.id',
            ['org' => $user->organization->id]
        );

        $query->andWhere(['is', 'application.id', null ]);*/
        //$query->andWhere(['is not', 'student_lists.id', null ]);

        // $org_id = EmployerLists::findOne(['employer_id' => Yii::$app->user->identity->id])->information->organization_name_id;

        // $query->leftJoin('application',
        //     'application.student_lists_id =student_lists.id and application.organization_name_id = :org',
        //     ['org' => $org_id]
        // )->where('application.id IS NULL');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'student_id' => $this->student_id,
            'specialization_id' => $this->specialization_id,
            // 'practice_date_from' => $this->practice_date_from,
        ]);

        return $dataProvider;
    }

    public function getSpecialization()
    {
        return $this->hasOne(Specialization::className(), ['specialization_id' => 'id']);
    }


}
