<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $usuarioID
 * @property string $Tipo_user
 * @property string $nombrecomercialUsuario
 * @property string $razonSocialUsuario
 * @property string $rfcUsuario
 * @property string $tipoPersonaUsuario
 * @property string $telefonoUsuario
 * @property string $emailUsuario
 * @property string $usuario
 * @property string $contrasena
 * @property string $codigoRecuperacion
 * @property string $fechaGeneracionCodigoRecuperacion
 * @property int $intentosValidos
 * @property string $AuthKey
 * @property bool $activoUsuario
 * @property bool $estadoUsuario
 */
class Usuarios extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
	
  	const ROLE_ADMIN = 'Administrador';
	const ROLE_USUARIO = 'Usuario';
	
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Tipo_user', 'usuario', 'contrasena', 'intentosValidos', 'AuthKey'], 'required'],
            [['fechaGeneracionCodigoRecuperacion'], 'safe'],
            [['intentosValidos'], 'integer'],
            [['activoUsuario', 'estadoUsuario'], 'boolean'],
            [['Tipo_user'], 'string', 'max' => 45],
            [['nombrecomercialUsuario', 'razonSocialUsuario'], 'string', 'max' => 255],
            [['rfcUsuario'], 'string', 'max' => 13],
            [['tipoPersonaUsuario'], 'string', 'max' => 1],
            [['telefonoUsuario', 'emailUsuario'], 'string', 'max' => 100],
            [['usuario', 'codigoRecuperacion', 'AuthKey'], 'string', 'max' => 250],
            [['contrasena'], 'string', 'max' => 450],
			['usuario', 'unique', 'message' => 'El nombre de usuario ya esta en uso.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'usuarioID' => 'ID',
            'Tipo_user' => 'Tipo Usuario',
            'nombrecomercialUsuario' => 'Nombre',
            'razonSocialUsuario' => 'Razon Social',
            'rfcUsuario' => 'RFC',
            'tipoPersonaUsuario' => 'Tipo Persona',
            'telefonoUsuario' => 'Telefono',
            'emailUsuario' => 'Email',
            'usuario' => 'Usuario',
            'contrasena' => 'Contraseña',
            'codigoRecuperacion' => 'Codigo Recuperacion',
            'fechaGeneracionCodigoRecuperacion' => 'Fecha Generacion Codigo',
            'intentosValidos' => 'Intentos Validos',
            'AuthKey' => 'Auth Key',
            'activoUsuario' => 'Activo',
            'estadoUsuario' => 'Estado',
        ];
    }
	
	public function getAuthKey()
    {
        return $this->AuthKey;
    }
	
	public function validateAuthKey($authKey)
    {
        return $this->AuthKey === $authKey;
    }
	
	public function getId()
    {
        return $this->usuarioID;
    }
	
	 public function getacceso()
    {
        return $this->Tipo_user;
    }
	
	public static function findIdentity($id)
    {
		return self::findOne($id);
    }
	
	public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new \yii\base\NoSupportedException();
    }
	
	public static function findByUsername($username)
    {        
        return self::findOne(['usuario'=>$username]);
    }
	
	public function validatePassword($password)
    {
		if(password_verify($password, $this->contrasena)) {
			return true;
		} else {
			return false;
		}
    }
}
