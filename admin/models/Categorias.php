<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categorias".
 *
 * @property int $categoriaID
 * @property string $nombreCategoria
 * @property string $abreviatura
 * @property string $descripcionCategoria
 * @property bool $activoCategoria
 * @property bool $estadoCategoria
 */
class Categorias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categorias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombreCategoria'], 'required'],
            [['activoCategoria', 'estadoCategoria'], 'boolean'],
            [['nombreCategoria'], 'string', 'max' => 200],
            [['abreviatura'], 'string', 'max' => 15],
            [['descripcionCategoria'], 'string', 'max' => 800],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'categoriaID' => 'ID',
            'nombreCategoria' => 'Nombre',
            'abreviatura' => 'Abreviatura',
            'descripcionCategoria' => 'Descripcion',
            'activoCategoria' => 'Activo',
            'estadoCategoria' => 'Estado',
        ];
    }
}
