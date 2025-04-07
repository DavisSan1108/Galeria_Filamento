<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Recetas */
/* @var $form yii\widgets\ActiveForm */
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\datetime\DateTimePicker;


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
					 <i class="fa fa-check-square-o" aria-hidden="true"></i>  Registro guardado con exito! ('.Html::a("Ver recetas", $url = ['recetas/update&id='.$_GET['id']], $options = ['class'=>'']).')
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
	<div class="form-group ">
	<label class="control-label" for="sliders-urlimagenslader">Imagen</label>
	<label class="file">
		<input type="file" id="file" name="file" aria-label="Seleccione un archivo" >
		<span class="file-custom"></span>
	</label>	
	</div>
</div>

<div style="clear: both;"></div> 

				<div class="col-sm-4 float-left  pleft-0">
					<?= $form->field($model, 'tituloReceta')->textInput(['maxlength' => true]) ?>
				</div>
				<div class="col-sm-2 float-left  pleft-0">
					<?php if($model->isNewRecord){
						echo $form->field($model, 'activoReceta', ['labelOptions' => [ 'class' => 'checkLabel' ]])->checkbox(['checked' => 'checked', 'label' => '', 'data-toggle'=>'toggle', 'data-onstyle'=>'primary', 'data-on'=>'Si', 'data-off'=>'No', 'data-style'=>'margenLabel'])->label('Activo');
					}else{
						echo $form->field($model, 'activoReceta', ['labelOptions' => [ 'class' => 'checkLabel' ]])->checkbox(['label' => '', 'data-toggle'=>'toggle', 'data-onstyle'=>'primary', 'data-on'=>'Si', 'data-off'=>'No', 'data-style'=>'margenLabel'])->label('Activo');
					} ?>
				</div>
				<div style="clear: both;"></div>   
<div class="col-sm-12 float-left  pleft-0">
					<?= $form->field($model, 'urlPdf')->textInput(['maxlength' => true]) ?>
				</div>
<div style="clear: both;"></div>  
				<div class="col-sm-12 float-left  pleft-0">
					<?= $form->field($model, 'descripcionReceta')->textarea(['rows' => 3]) ?>
				</div>
				
				
<div style="clear: both;"></div>    
<div class="col-sm-12  pleft-0">
    <div class="form-group">
		<?= Html::submitButton('<i class="fa fa-check"></i> &nbsp; Guardar', ['class' => 'btn btn-success submitFormBtnBlock']) ?>
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
            $blockBtn = $this.clone();
            $blockBtn.attr('type', 'button');
			$blockBtn.html('Espere un momento ...'); 
            $blockBtn.addClass('submitFormBtnBlock');
            $blockBtn.removeClass('submitFormBtn');
            $blockBtn.insertAfter($this);
            $blockBtn.attr('disabled', 'disabled');
        }
        $this.hide();
        $blockBtn.show();
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

