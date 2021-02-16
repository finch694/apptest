<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Apples;

/**
 * ApplesSearch represents the model behind the search form of `app\models\Apples`.
 */
class ApplesSearch extends Apples
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status_id', 'createAt', 'fallAt'], 'integer'],
            [['color'], 'safe'],
            [['integrity'], 'number'],
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
        $query = Apples::find();

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
            'status_id' => $this->status_id,
            'integrity' => $this->integrity,
            'createAt' => $this->createAt,
            'fallAt' => $this->fallAt,
        ]);

        $query->andFilterWhere(['ilike', 'color', $this->color]);

        return $dataProvider;
    }
}
