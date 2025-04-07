<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "recetas".
 *
 * @property int $recetaID
 * @property string $imagenReceta
 * @property string $tituloReceta
 * @property string $descripcionReceta
 * @property bool $activoReceta
 * @property bool $estadoReceta
 */
class Recetas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'recetas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imagenReceta', 'tituloReceta', 'descripcionReceta'], 'required'],
            [['descripcionReceta'], 'string'],
            [['activoReceta', 'estadoReceta'], 'boolean'],
            [['imagenReceta'], 'string', 'max' => 250],
            [['tituloReceta'], 'string', 'max' => 500],
			[['urlPdf'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'recetaID' => 'ID',
            'imagenReceta' => 'Imagen',
            'tituloReceta' => 'Titulo',
            'descripcionReceta' => 'Descripción',
			'urlPdf' => 'PDF Url',
            'activoReceta' => 'Activo',
            'estadoReceta' => 'Estado',
        ];
    }
}
