<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Disenador;

/**
 * DisenadorSearch represents the model behind the search form of `app\models\Disenador`.
 */
class DisenadorSearch extends Disenador
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['disenadorID'], 'integer'],
            [['nombreDisenador'], 'safe'],
            [['activoDisenador', 'estadoDisenador'], 'boolean'],
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
        $query = Disenador::find();

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
            'disenadorID' => $this->disenadorID,
            'activoDisenador' => $this->activoDisenador,
            'estadoDisenador' => $this->estadoDisenador,
        ]);

        $query->andFilterWhere(['like', 'nombreDisenador', $this->nombreDisenador]);
		$query->andWhere(['=', 'estadoDisenador', '1']);

        return $dataProvider;
    }
}
