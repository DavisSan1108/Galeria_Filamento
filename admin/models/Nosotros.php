<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nosotros".
 *
 * @property int $nosotrosID
 * @property string $titulo
 * @property string $descripcion
 * @property bool $activoNosotros
 * @property bool $estadoNosotros
 */
class Nosotros extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nosotros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'descripcion'], 'required'],
            [['descripcion'], 'string'],
            [['activoNosotros', 'estadoNosotros'], 'boolean'],
            [['titulo'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nosotrosID' => 'ID',
            'titulo' => 'Titulo',
            'descripcion' => 'Descripcion',
            'activoNosotros' => 'Activo',
            'estadoNosotros' => 'Estado',
        ];
    }
}
