<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */
?>



 <?php $form = ActiveForm::begin(); ?>

<div class="col-sm-12 pleft-0">
<?php $tterror = count($model->getErrors());
if($tterror != 0){
	echo '<div class="alert alert-danger" role="alert">
			<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			'.$form->errorSummary($model).'
	</div>';
}else{
	if(isset($_GET['insert'])){
		if($_GET['insert'] == 'true'){
			echo '<div class="alert alert-success" role="alert">
					 <i class="fa fa-check-square-o" aria-hidden="true"></i>  Registro guardado con exito! ('.Html::a("Ver usuarios", $url = ['usuarios/update&id='.$_GET['id']], $options = ['class'=>'']).')
				 </div>';
		}
	}
	
	if(isset($_GET['update'])){
		if($_GET['update'] == 'true'){
			echo '<div class="alert alert-success" role="alert">
					 <i class="fa fa-check-square-o" aria-hidden="true"></i>  Registro actualizado con exito!
				 </div>';
		}
	}
}
?>
</div>
<div style="clear: both;"></div>
<div class="col-sm-4 float-left pleft-0">  
	<?= $form->field($model, 'Tipo_user')->dropDownList(['Administrador'=>'Administrador', 'Usuario'=>'Usuario']) ?>
</div>

				
				<div class="col-sm-4 float-left  pleft-0">
					<?= $form->field($model, 'nombrecomercialUsuario')->textInput(['maxlength' => true]) ?>
				</div>
				<div class="col-sm-4 float-left  pleft-0">
					<?= $form->field($model, 'telefonoUsuario')->textInput(['maxlength' => true]) ?>
				</div>
				<div class="col-sm-4 float-left  pleft-0">
					<?= $form->field($model, 'emailUsuario')->textInput(['maxlength' => true]) ?>
				</div>
				<div class="col-sm-4 float-left  pleft-0">
					<?= $form->field($model, 'usuario')->textInput(['maxlength' => true]) ?>
				</div>
								
				<div class="col-sm-4 float-left  pleft-0">
					<?= $form->field($model, 'activoUsuario')->checkbox(['checked'=>'checked']) ?>
				</div>


				<?= $form->field($model, 'razonSocialUsuario')->textInput(['maxlength' => true, 'type'=>'hidden', 'value'=>'na'])->label(false) ?>
				<?= $form->field($model, 'rfcUsuario')->textInput(['maxlength' => true, 'type'=>'hidden', 'value'=>'na'])->label(false) ?>
				<?= $form->field($model, 'tipoPersonaUsuario')->textInput(['maxlength' => true, 'type'=>'hidden', 'value'=>'N'])->label(false) ?>
<div style="clear: both;"></div>    
<div class="col-sm-12  pleft-0">
    <div class="form-group">
		<?= Html::submitButton('<i class="fa fa-check"></i> &nbsp; Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

 <?php ActiveForm::end(); ?>



