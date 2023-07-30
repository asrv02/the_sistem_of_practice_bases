<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Applicationstud;

/**
 * ApplicationstudSearch represents the model behind the search form of `app\models\Applicationstud`.
 */
class ApplicationstudSearch extends Applicationstud
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'employer_id', 'employer_lists_id', 'specialization_id', 'status_id'], 'integer'],
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
        $query = Applicationstud::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'employer_id' => $this->employer_id,
            'employer_lists_id' => $this->employer_lists_id,
            'specialization_id' => $this->specialization_id,
            'status_id' => $this->status_id,
        ]);

        return $dataProvider;
    }
}
