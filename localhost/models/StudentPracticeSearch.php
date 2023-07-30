<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StudentPractice;
use Yii;
use yii\helpers\VarDumper;

/**
 * StudentPracticeSearch represents the model behind the search form of `app\models\StudentPractice`.
 */
class StudentPracticeSearch extends StudentPractice
{

    public $group_id;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'student_id', 'group_id','practice_group_id', 'organization_id', 'status_loading_id'], 'integer'],
            [['place_title', 'report'], 'safe'],
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
        $query = StudentPractice::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        $this->load($params, '');
       

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'practice_group_id' => $this->practice_group_id,
            'organization_id' => $this->organization_id,
            'status_loading_id' => $this->status_loading_id,
        ]);

        if( !Yii::$app->user->isGuest ) {
            if( Yii::$app->user->can('per_student') ) {
                $query->andWhere(['student_id' => Yii::$app->user->id]);
            }
        }

        $query->andFilterWhere(['like', 'place_title', $this->place_title])
            ->andFilterWhere(['like', 'report', $this->report]);

        //   VarDumper::dump($query->createCommand()->rawSql, 10, true); die;

        return $dataProvider;
    }
}
