<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sliders".
 *
 * @property int $sliderID
 * @property string $tituloSlider
 * @property string $textSlider
 * @property string $descripcionSlider
 * @property string $urlImagenSlader
 * @property string $urlSlader
 * @property bool $activoSlider
 * @property bool $estadoSlider
 */
class Sliders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sliders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tituloSlider'], 'required'],
            [['activoSlider', 'estadoSlider'], 'boolean'],
            [['tituloSlider'], 'string', 'max' => 200],
            [['textSlider'], 'string', 'max' => 350],
            [['descripcionSlider'], 'string', 'max' => 250],
            [['urlImagenSlader'], 'string', 'max' => 300],
            [['urlSlader'], 'string', 'max' => 800],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sliderID' => 'ID',
            'tituloSlider' => 'Titulo rojo',
            'textSlider' => 'Titulo en grande',
            'descripcionSlider' => 'Descripcion breve (max 250)',
            'urlImagenSlader' => 'Imagen',
            'urlSlader' => 'Url redirección',
            'activoSlider' => 'Activo',
            'estadoSlider' => 'Estado',
        ];
    }
}
