<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Categorias */
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
					 <i class="fa fa-check-square-o" aria-hidden="true"></i>  Registro guardado con exito! ('.Html::a("Ver categorias", $url = ['categorias/update&id='.$_GET['id']], $options = ['class'=>'']).')
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

				<div class="col-sm-4 float-left  pleft-0">
					<?= $form->field($model, 'nombreCategoria')->textInput(['maxlength' => true]) ?>
				</div>
				<div class="col-sm-4 float-left  pleft-0">
					<?= $form->field($model, 'abreviatura')->textInput(['maxlength' => true]) ?>
				</div>
				<div class="col-sm-4 float-left  pleft-0">
					<?= $form->field($model, 'activoCategoria')->checkbox() ?>
				</div>
	<div style="clear: both;"></div>  
			<div class="col-sm-12 float-left  pleft-0">
					<?php echo $form->field($model, 'descripcionCategoria')->textarea(['rows' => 6]); ?>
				</div>

<div style="clear: both;"></div>    
<div class="col-sm-12  pleft-0">
    <div class="form-group">
		<?= Html::submitButton('<i class="fa fa-check"></i> &nbsp; Guardar', ['class' => 'btn btn-primary ']) ?>
    </div>
</div>

 <?php ActiveForm::end(); ?>

