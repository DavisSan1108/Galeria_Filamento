<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sliders */
/* @var $form yii\widgets\ActiveForm */


use app\assets\AppAsset;
use yii\helpers\Url;
$asset = AppAsset::register($this);
$baseUrl = $asset->baseUrl;
$this->registerJsFile($baseUrl.'/require/js/jquery/jquery-2.1.4.js', ['position' => \yii\web\View::POS_HEAD]);


	$form = ActiveForm::begin([
        'options' => [
			'enctype' => 'multipart/form-data'
        ]
    ]); 

?>




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
					 <i class="fa fa-check-square-o" aria-hidden="true"></i>  Registro guardado con exito! ('.Html::a("Ver sliders", $url = ['sliders/update&id='.$_GET['id']], $options = ['class'=>'']).')
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

				
				
				
				

<?php
			$imagenslider="sin_foto.jpg";
			if(!$model->isNewRecord){//editar
				$imagenslider = $model->urlImagenSlader;
			}else{
				$imagenslider = "no_img.png";
			}
			?>
			<div class="col-sm-5 float-left pleft-0">
				<div class="col-sm-12 float-left pleft-0" style="height: 240px; border: solid 0px;" align="center">
					<div class="" style="position:absolute; bottom: 0px; border: solid 0px; width: 100%;">
						<div class="file-select" id="file">
						  <input type="file" name="file" id="file" aria-label="Archivo">
							<span id="spanSelected" style="border: solid 0px; left: 0; position: absolute;  bottom: 130px; max-height:90px;"><img id="selectedImg1" width="270" style="max-height:190px;" src='sliders/<?= $imagenslider; ?>' /></span>
						</div>
						<br />
						<span style="color:#AAA9A9">(Imágen del banner sitio web)</span>
					</div>
				</div>
				<div style="clear: both;"></div> 
				<div class="col-sm-12 float-left  pleft-0" style="display: none;">
					<div class="form-group ">
					<label class="control-label" for="sliders-urlimagenslader">Imagen</label>
					<label class="file">
						<input type="file" id="file2" name="file2" aria-label="Seleccione un archivo" >
						<span class="file-custom"></span>
					</label>	
					</div>
				</div>
			</div>
			<div class="col-sm-4 float-left pleft-0">
				
				<div class="col-sm-12 float-left  pleft-0">
					<?php echo $form->field($model, 'tituloSlider')->textInput(['maxlength' => true]); ?>
				</div>
				
				<div class="col-sm-12 float-left  pleft-0">
					<?= $form->field($model, 'textSlider')->textInput(['maxlength' => true]) ?>
				</div>
				
				<div class="col-sm-12 float-left  pleft-0">
					<?php echo $form->field($model, 'urlSlader')->textInput(['maxlength' => true]); ?>
				</div>
				
				
				<div class="col-sm-6 float-left  pleft-0">
					<?php if($model->isNewRecord){
						echo $form->field($model, 'activoSlider', ['labelOptions' => [ 'class' => 'checkLabel' ]])->checkbox(['checked' => 'checked', 'label' => '', 'data-toggle'=>'toggle', 'data-onstyle'=>'primary', 'data-on'=>'Si', 'data-off'=>'No', 'data-style'=>'margenLabel'])->label('Activo');
					}else{
						echo $form->field($model, 'activoSlider', ['labelOptions' => [ 'class' => 'checkLabel' ]])->checkbox(['label' => '', 'data-toggle'=>'toggle', 'data-onstyle'=>'primary', 'data-on'=>'Si', 'data-off'=>'No', 'data-style'=>'margenLabel'])->label('Activo');
					} ?>
				</div>
			</div>

	<div style="clear: both;"></div>  			

				
				<div class="col-sm-12 float-left  pleft-0">
					<?php echo $form->field($model, 'descripcionSlider')->textarea(['rows' => 6]); ?>
				</div>
<div style="clear: both;"></div>    
<div class="col-sm-12  pleft-0">
    <div class="form-group">
		<?= Html::submitButton('<i class="fa fa-check"></i> &nbsp; Guardar', ['class' => 'btn btn-primary submitFormBtn']) ?>
    </div>
</div>

 <?php ActiveForm::end(); ?>

<script>	
$(document).ready(function(){
	
	 $('.submitFormBtn').click(function(){
		
		
        var $this = $(this);
        var $next = $this.next();
        if($next.hasClass('submitFormBtnBlock')) {
            $blockBtn = $next;
        } else {
			
			var form = document.getElementById('w0');			
			var dtClear = 0;
			for(var i=0; i < form.elements.length; i++){
				if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
					dtClear ++;
				 }
			}
			
			if(dtClear == 0){				
				$blockBtn = $this.clone();
				$blockBtn.attr('type', 'button');
				$blockBtn.html('Espere un momento ...'); 
				$blockBtn.addClass('submitFormBtnBlock');
				$blockBtn.removeClass('submitFormBtn');
				$blockBtn.insertAfter($this);
				$blockBtn.attr('disabled', 'disabled');
				
				$this.hide();
		 		$blockBtn.show();
			}				 
        }
		
       
    });
	
	
    $('.submitFormBtn').parents('form').on('afterValidate', function (event, messages, errorAttributes) {				
        if(errorAttributes.length > 0) {
            $('.submitFormBtn').show();
            $('.submitFormBtnBlock').hide();
        }
    });
	
});

$("#file").change(function(){
	//alert($('input[type=file]').val());
	var tmppath = URL.createObjectURL(event.target.files[0]);
    $("#selectedImg1").fadeIn("fast").attr('src',tmppath);  
	
});
</script>

