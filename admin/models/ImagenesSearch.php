<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Imagenes;

/**
 * ImagenesSearch represents the model behind the search form of `app\models\Imagenes`.
 */
class ImagenesSearch extends Imagenes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imagenproductoID', 'productoID'], 'integer'],
            [['nombreImagen', 'urlImagen'], 'safe'],
            [['activoImagen', 'estadoImagen'], 'boolean'],
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
        $query = Imagenes::find();

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
            'imagenproductoID' => $this->imagenproductoID,
            'productoID' => $this->productoID,
            'activoImagen' => $this->activoImagen,
            //'estadoImagen' => $this->estadoImagen,
        ]);

        $query->andFilterWhere(['like', 'nombreImagen', $this->nombreImagen])
            ->andFilterWhere(['like', 'urlImagen', $this->urlImagen]);
		$query->andWhere(['=', 'imagenesproductos.productoID', $_GET['id']]);
		$query->andFilterWhere(['=', 'estadoImagen', '1']);

        return $dataProvider;
    }
}
