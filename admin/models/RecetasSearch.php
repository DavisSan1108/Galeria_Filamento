<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Recetas;

/**
 * RecetasSearch represents the model behind the search form of `app\models\Recetas`.
 */
class RecetasSearch extends Recetas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['recetaID'], 'integer'],
            [['imagenReceta', 'tituloReceta', 'descripcionReceta', 'urlPdf'], 'safe'],
            [['activoReceta', 'estadoReceta'], 'boolean'],
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
        $query = Recetas::find();

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
            'recetaID' => $this->recetaID,
            'activoReceta' => $this->activoReceta,
            'estadoReceta' => $this->estadoReceta,
        ]);

        $query->andFilterWhere(['like', 'imagenReceta', $this->imagenReceta])
            ->andFilterWhere(['like', 'tituloReceta', $this->tituloReceta])
            ->andFilterWhere(['like', 'descripcionReceta', $this->descripcionReceta]);

        return $dataProvider;
    }
}
