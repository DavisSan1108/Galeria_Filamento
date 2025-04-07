<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Productos;

/**
 * ProductosSearch represents the model behind the search form of `app\models\Productos`.
 */
class ProductosSearch extends Productos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['productoID'], 'integer'],
            [['nombreProducto', 'descripcionProducto', 'precioProducto', 'urlImagenProducto', 'categoriaID', 'disenadorID', 'delPeriodo', 'lugarOrigen', 'yearManufactura', 'periodo', 'condicion', 'desgaste', 'dimension', 'diametro', 'material'], 'safe'],
            [['activoProducto', 'estadoProducto', 'desigActive', 'prodDest'], 'boolean'],
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
	public $idCategoria;
    public function search($params)
    {
        $query = Productos::find();
		$query->joinWith(['idCategoria']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		
		$dataProvider->sort->attributes['idCategoria'] = [
							'asc' => ['categorias.nombreCategoria' => SORT_ASC],
							'desc' => ['categorias.nombreCategoria' => SORT_DESC],
						];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'productoID' => $this->productoID,
            //'categoriaID' => $this->categoriaID,
			'desigActive' => $this->desigActive,
			'prodDest' => $this->prodDest,
            'activoProducto' => $this->activoProducto,
            'estadoProducto' => $this->estadoProducto,
        ]);

        $query->andFilterWhere(['like', 'nombreProducto', $this->nombreProducto])
            ->andFilterWhere(['like', 'descripcionProducto', $this->descripcionProducto])
            ->andFilterWhere(['like', 'precioProducto', $this->precioProducto])
            ->andFilterWhere(['like', 'urlImagenProducto', $this->urlImagenProducto]);
		
		$query->andFilterWhere(['=', 'estadoProducto', '1']);
		$query->andFilterWhere(['like', 'categorias.nombreCategoria', $this->categoriaID]);

        return $dataProvider;
    }
}
