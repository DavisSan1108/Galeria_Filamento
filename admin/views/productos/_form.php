<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Productos */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\datetime\DateTimePicker;


use app\models\Categorias;
use app\models\Disenador;


use app\assets\AppAsset;
use yii\helpers\Url;
$asset = AppAsset::register($this);
$baseUrl = $asset->baseUrl;
$this->registerJsFile($baseUrl.'/require/js/jquery/jquery-2.1.4.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerJsFile($baseUrl.'/require/js/tinymce/tinymce.min.js', ['position' => \yii\web\View::POS_HEAD]);



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
					 <i class="fa fa-check-square-o" aria-hidden="true"></i>  Registro guardado con exito! ('.Html::a("Ver productos", $url = ['productos/update&id='.$_GET['id']], $options = ['class'=>'']).')
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
<div class="col-sm-4 float-left  pleft-0" >
    
    <!-- Contenedor donde se mostrarè´° la imagen -->
    <div id="imagen-container" style="margin-top: 10px; max-height:80px; text-align:center;">
        <?php
    	if($model->isNewRecord){
    			echo '<img src="'.$baseUrl.'/productos/no_img.png" class="img-fliud" style="max-width: 100px;" />';
    	}else{
    		if($model->urlImagenProducto != ''){
    			echo '<img src="'.$baseUrl.'/productos/'.$model->urlImagenProducto.'" class="img-fliud" style="max-width: 100px;" />';
    		}else{
    			echo '<img src="'.$baseUrl.'/productos/no_img.png" class="img-fliud" style="max-width: 100px;" />';
    		}
    	}
    	?>
    </div>
</div>
<div class="col-sm-4 float-left pleft-0">
    <div class="form-group">
        <label class="control-label" for="sliders-urlimagenslader">Imagen</label>
        <label class="file">
            <input type="file" id="file" name="file" aria-label="Seleccione un archivo" onchange="mostrarImagen(this)">
            <span class="file-custom"></span>
        </label>    
    </div>
</div>

<script>
    function mostrarImagen(input) {
        // Verifica si se seleccionè´— un archivo
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            // Cuando el archivo se ha cargado, se ejecuta esta funciè´—n
            reader.onload = function (e) {
                // Crea una imagen
                var img = document.createElement("img");
                img.src = e.target.result;
                //maxWidth
                img.style.maxHeight = '100px'; // Ajustar el tamaè´–o de la imagen

                // Borra cualquier imagen anterior y agrega la nueva
                var container = document.getElementById('imagen-container');
                container.innerHTML = ''; // Limpia el contenedor
                container.appendChild(img); // Aè´–ade la nueva imagen
            };

            // Lee el archivo seleccionado
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


<div style="clear: both;"></div>  
				<div class="col-sm-4 float-left  pleft-0">
					<?php echo $form->field($model, 'categoriaID')->widget(Select2::classname(), [   
							'data' => ArrayHelper::map(Categorias::find()->andWhere(['=', 'activoCategoria', '1'])->andWhere(['=', 'estadoCategoria', '1'])->orderBy('nombreCategoria')->all(), 'categoriaID', 'nombreCategoria'),
							'language' => 'es',
							'options' => ['placeholder' => ' --- Selecciona --- '],
							'pluginOptions' => ['allowClear' => true]]); ?>
				</div>

				<div class="col-sm-4 float-left d-none pleft-0">
					<?php echo $form->field($model, 'disenadorID')->widget(Select2::classname(), [   
							'data' => ArrayHelper::map(Disenador::find()->andWhere(['=', 'activoDisenador', '1'])->andWhere(['=', 'estadoDisenador', '1'])->orderBy('nombreDisenador')->all(), 'disenadorID', 'nombreDisenador'),
							'language' => 'es',
							'options' => ['placeholder' => ' --- Selecciona --- '],
							'pluginOptions' => ['allowClear' => true]]); ?>
				</div>


				<div class="col-sm-4 float-left  pleft-0">
					<?= $form->field($model, 'nombreProducto')->textInput(['maxlength' => true]) ?>
				</div>

				<!--
				<div style="clear: both;"></div> 
				<div class="col-sm-4 float-left  pleft-0">
					<?= $form->field($model, 'delPeriodo')->textInput(['maxlength' => true]) ?>
				</div>

				<div class="col-sm-4 float-left  pleft-0">
					<?= $form->field($model, 'lugarOrigen')->textInput(['maxlength' => true]) ?>
				</div>

				<div class="col-sm-4 float-left  pleft-0">
					<?= $form->field($model, 'yearManufactura')->textInput(['maxlength' => true]) ?>
				</div>
				<div style="clear: both;"></div> 

				<div class="col-sm-4 float-left  pleft-0">
					<?= $form->field($model, 'periodo')->textInput(['maxlength' => true]) ?>
				</div>

				<div class="col-sm-4 float-left  pleft-0">
					<?= $form->field($model, 'condicion')->textInput(['maxlength' => true]) ?>
				</div>

				<div class="col-sm-4 float-left  pleft-0">
					<?= $form->field($model, 'desgaste')->textInput(['maxlength' => true]) ?>
				</div>
				<div style="clear: both;"></div> 

				<div class="col-sm-4 float-left  pleft-0">
					<?= $form->field($model, 'dimension')->textInput(['maxlength' => true]) ?>
				</div>

				<div class="col-sm-4 float-left  pleft-0">
					<?= $form->field($model, 'diametro')->textInput(['maxlength' => true]) ?>
				</div>

				<div class="col-sm-4 float-left  pleft-0">
					<?= $form->field($model, 'material')->textInput(['maxlength' => true]) ?>
				</div>
				<div style="clear: both;"></div> 
								
				<div class="col-sm-2 float-left  pleft-0">
					<?php if($model->isNewRecord){
						echo $form->field($model, 'desigActive', ['labelOptions' => [ 'class' => 'checkLabel' ]])->checkbox(['checked' => 'checked', 'label' => '', 'data-toggle'=>'toggle', 'data-onstyle'=>'primary', 'data-on'=>'Si', 'data-off'=>'No', 'data-style'=>'margenLabel'])->label('Dise√±ador');
					}else{
						echo $form->field($model, 'desigActive', ['labelOptions' => [ 'class' => 'checkLabel' ]])->checkbox(['label' => '', 'data-toggle'=>'toggle', 'data-onstyle'=>'primary', 'data-on'=>'Si', 'data-off'=>'No', 'data-style'=>'margenLabel'])->label('Dise√±ador');
					} ?>
				</div>

				<div class="col-sm-2 float-left  pleft-0">
					<?php if($model->isNewRecord){
						echo $form->field($model, 'prodDest', ['labelOptions' => [ 'class' => 'checkLabel' ]])->checkbox(['checked' => 'checked', 'label' => '', 'data-toggle'=>'toggle', 'data-onstyle'=>'primary', 'data-on'=>'Si', 'data-off'=>'No', 'data-style'=>'margenLabel'])->label('Destacado');
					}else{
						echo $form->field($model, 'prodDest', ['labelOptions' => [ 'class' => 'checkLabel' ]])->checkbox(['label' => '', 'data-toggle'=>'toggle', 'data-onstyle'=>'primary', 'data-on'=>'Si', 'data-off'=>'No', 'data-style'=>'margenLabel'])->label('Destacado');
					} ?>
				</div>

				<div class="col-sm-2 float-left  pleft-0">
					<?php if($model->isNewRecord){
						echo $form->field($model, 'activoProducto', ['labelOptions' => [ 'class' => 'checkLabel' ]])->checkbox(['checked' => 'checked', 'label' => '', 'data-toggle'=>'toggle', 'data-onstyle'=>'primary', 'data-on'=>'Si', 'data-off'=>'No', 'data-style'=>'margenLabel'])->label('Activo');
					}else{
						echo $form->field($model, 'activoProducto', ['labelOptions' => [ 'class' => 'checkLabel' ]])->checkbox(['label' => '', 'data-toggle'=>'toggle', 'data-onstyle'=>'primary', 'data-on'=>'Si', 'data-off'=>'No', 'data-style'=>'margenLabel'])->label('Activo');
					} ?>
				</div>
                -->

<div style="clear: both;"></div>   
<div class="col-sm-12 float-left  pleft-0">
					<?= $form->field($model, 'descripcionProducto')->textarea(['rows' => 3]) ?>
				</div>
<div style="clear: both;"></div>    
<div class="col-sm-12  pleft-0">
    <div class="form-group">
		<?= Html::submitButton('<i class="fa fa-check"></i> &nbsp; Guardar', ['class' => 'btn btn-primary submitFormBtnBlock']) ?>
		<?= $form->field($model, 'precioProducto')->textInput(['type' =>'hidden', 'value'=>'0.0'])->label(false) ?>
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

	
tinymce.init({ 
	forced_root_block : "",
	selector:'textarea',
	plugins : "paste",
	external_plugins: {"nanospell": "<?php echo Url::base();?>/require/js/tinymce/nanospell/plugin.js"},
	nanospell_server: "php",
	nanospell_autostart: true,
	nanospell_dictionary: "es" ,
	menubar: false,
	toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | ',	
	paste_as_text: true
});
</script>

