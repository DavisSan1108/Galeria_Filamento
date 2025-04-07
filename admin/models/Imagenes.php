<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "imagenesproductos".
 *
 * @property int $imagenproductoID
 * @property int $productoID
 * @property string $nombreImagen
 * @property string $urlImagen
 * @property bool $activoImagen
 * @property bool $estadoImagen
 */
class Imagenes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'imagenesproductos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['productoID', 'nombreImagen', 'urlImagen'], 'required'],
            [['productoID'], 'integer'],
            [['activoImagen', 'estadoImagen'], 'boolean'],
            [['nombreImagen', 'urlImagen'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'imagenproductoID' => 'ID',
            'productoID' => 'Producto',
            'nombreImagen' => 'Nombre',
            'urlImagen' => 'Url',
            'activoImagen' => 'Activo',
            'estadoImagen' => 'Estado',
        ];
    }
}
