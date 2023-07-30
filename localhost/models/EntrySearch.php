<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Entry;

/**
 * EntrySearch represents the model behind the search form of `app\models\Entry`.
 */
class EntrySearch extends Entry
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'specialization_id', 'organization_name_id', 'quantity'], 'integer'],
            [['contacts'], 'safe'],
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
        $query = Entry::find();

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
            'specialization_id' => $this->specialization_id,
            'organization_name_id' => $this->organization_name_id,
            'quantity' => $this->quantity,
        ]);

        $query->andFilterWhere(['like', 'contacts', $this->contacts]);

        return $dataProvider;
    }
}
