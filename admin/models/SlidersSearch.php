<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sliders;

/**
 * SlidersSearch represents the model behind the search form of `app\models\Sliders`.
 */
class SlidersSearch extends Sliders
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sliderID'], 'integer'],
            [['tituloSlider', 'textSlider', 'descripcionSlider', 'urlImagenSlader', 'urlSlader'], 'safe'],
            [['activoSlider', 'estadoSlider'], 'boolean'],
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
        $query = Sliders::find();

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
            'sliderID' => $this->sliderID,
            'activoSlider' => $this->activoSlider,
            'estadoSlider' => $this->estadoSlider,
        ]);

        $query->andFilterWhere(['like', 'tituloSlider', $this->tituloSlider])
            ->andFilterWhere(['like', 'textSlider', $this->textSlider])
            ->andFilterWhere(['like', 'descripcionSlider', $this->descripcionSlider])
            ->andFilterWhere(['like', 'urlImagenSlader', $this->urlImagenSlader])
            ->andFilterWhere(['like', 'urlSlader', $this->urlSlader]);
		
		$query->andWhere(['=', 'estadoSlider', '1']);

        return $dataProvider;
    }
}
