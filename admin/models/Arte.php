<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Arte extends ActiveRecord
{
    public $imagen;

    public static function tableName()
    {
        return 'arte'; // Asegúrate de tener una tabla llamada 'arte' en tu base de datos
    }

    public function rules()
    {
        return [
            [['titulo', 'artista', 'anio'], 'required'],
            [['anio'], 'integer'],
            [['descripcion'], 'string'],
            [['titulo', 'artista'], 'string', 'max' => 255],
            [['imagen'], 'file', 'extensions' => 'png, jpg, jpeg'],
        ];
    }
}