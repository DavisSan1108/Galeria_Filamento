<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "disenador".
 *
 * @property int $disenadorID
 * @property string $nombreDisenador
 * @property bool $activoDisenador
 * @property bool $estadoDisenador
 */
class Disenador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'disenador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombreDisenador'], 'required'],
            [['activoDisenador', 'estadoDisenador'], 'boolean'],
            [['nombreDisenador'], 'string', 'max' => 350],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'disenadorID' => 'ID',
            'nombreDisenador' => 'Nombre',
            'activoDisenador' => 'Activo',
            'estadoDisenador' => 'Estado',
        ];
    }
}
