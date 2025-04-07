<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productos".
 *
 * @property int $productoID
 * @property int $categoriaID
 * @property string $nombreProducto
 * @property string $descripcionProducto
 * @property string $precioProducto
 * @property string $urlImagenProducto
 * @property bool $activoProducto
 * @property bool $estadoProducto
 */
class Productos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productos';
    }

    /**
     * {@inheritdoc}
     */
	
	  
    public function rules()
    {
        return [
            [['categoriaID', 'urlImagenProducto'], 'required'],
            [['categoriaID'], 'integer'],
            [['activoProducto', 'estadoProducto'], 'boolean'],
            [['nombreProducto'], 'string', 'max' => 100],
            [['precioProducto'], 'string', 'max' => 45],
            [['urlImagenProducto'], 'string', 'max' => 200],
			 [['descripcionProducto',  'disenadorID', 'delPeriodo', 'lugarOrigen', 'yearManufactura', 'periodo', 'condicion', 'desgaste', 'dimension', 'diametro', 'material', 'desigActive', 'prodDest'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'productoID' => 'ID',
            'categoriaID' => 'Categoria',
            'nombreProducto' => 'Nombre',
            'descripcionProducto' => 'Descripción',
            'precioProducto' => 'Precio',
            'urlImagenProducto' => 'Imagen',
			'disenadorID' => 'Diseñador', 
			'delPeriodo' => 'Del Periodo', 
			'lugarOrigen' => 'Lugar origen', 
			'yearManufactura' => 'Año manufactura', 
			'periodo' => 'Periodo', 
			'condicion' => 'Condiciones', 
			'desgaste' => 'Desgaste', 
			'dimension' => 'Dimensiones', 
			'diametro' => 'Diametro', 
			'material' => 'Material', 
			'desigActive' => 'Producto diseñador', 
			'prodDest' => 'Producto destacado', 
            'activoProducto' => 'Activo',
            'estadoProducto' => 'Estado',
        ];
    }
	
	public function getIdCategoria(){
		return $this->hasOne(Categorias::className(), ['categoriaID' => 'categoriaID']);
	}
}
