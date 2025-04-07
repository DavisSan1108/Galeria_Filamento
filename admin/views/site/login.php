<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use app\assets\AppAsset;

$asset = AppAsset::register($this);
$baseUrl = $asset->baseUrl;

$this->title = 'Portal :: Login';
?>
<h3 class="text-center">Portal de administración</h3>
<br>
 <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',	
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>


<div class="login-form">
	
	<div class="form-group form-floating-label">
		<input  type="text" class="form-control input-border-bottom" id="loginform-username" required="required" name="LoginForm[username]" autofocus="" aria-required="true" autocomplete="off" aria-invalid="false">
		<label for="username" class="placeholder">Usuario</label>
	</div>
	<div class="form-group form-floating-label">
		 <input  type="password" id="loginform-password" autocomplete="off"  required="required" class="form-control input-border-bottom" name="LoginForm[password]"  aria-required="true" aria-invalid="false" >
		<label for="password" class="placeholder">Contraseña</label>
		<div class="show-password">
			<i class="icon-eye"></i>
		</div>
	</div>
	<div class="col-md-12" style="margin-top: 10px;">
	<?php
	if(Yii::$app->session->getFlash('failure')){
		if(Yii::$app->session->getFlash('failure') != ''){
			echo '<div class="alert alert-danger" role="alert">
			'.Yii::$app->session->getFlash('failure').'
			</div>';	
		}										
	}
	?>
	</div>
	<div class="form-group form-floating-label">
		 <input type="checkbox"  id="loginform-rememberme" name="LoginForm[rememberMe]" value="1" checked>
			<label style="color: #5A5A5A !important; font-size: 14px !important;" for="rememberme">Recuerdame</label>
	</div>
	
	<div class="form-action mb-3">
		<button class="btn btn-rounded btn-login" style="background: #890101; color: #FFFFFF; font-size: 16px;" > Ingresar ahora </button>
	</div>
	<div class="login-account">
		<span class="msg">Derechos reservados &copy; codyexpert.com</span>
	</div>
</div>

 <?php ActiveForm::end(); ?>