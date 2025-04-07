<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
?>

<div class="page-navs bg-white py-3 pr-2">
	<div class="page-header">
		<h5 class="page-title">Usuarios</h5>
		<ul class="breadcrumbs">
			<li class="nav-home">				
				<i class="far fa-folder-open" style="font-size: 18px;"></i>
			</li>
			<li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				Editar registro
			</li>
		</ul>
		<div class="ml-auto">
			<div class="page-header-breadcrumb">
				<?php 		
						$mInicioGral = '<i class="icon-menu"></i> Inicio';
						echo Html::a($mInicioGral, $url = ['usuarios/index'], $options = ['class'=>'btn btn-primary btn-xs  menuBotones']);
					
						$mAltaGral = '<i class="icon-plus"></i> Agregar';
						echo Html::a($mAltaGral, $url = ['usuarios/create'], $options = ['class'=>'btn btn-primary btn-xs menuBotones']);
					
						$mUpdateGral = '<i class="icon-note"></i>	Editar';
						echo Html::a($mUpdateGral, $url = ['usuarios/update&id='.$_GET['id']], $options = ['class'=>'btn btn-primary btn-xs menuBotones ']);
				
						$mUpdateGral = '<i class="icon-lock"></i>	Contraseña';
						echo Html::a($mUpdateGral, $url = ['usuarios/pass&id='.$_GET['id']], $options = ['class'=>'btn btn-primary btn-xs menuBotones active']);
					?>
					<a class="btn btn-primary btn-xs menuBotones" href="#" onclick="confirmDelete()"><i class="icon-close"></i>	Eliminar</a>
			</div>
		</div>
	</div>	
</div>

<div class="page-inner">
	<!-- aqui inicia el contenido -->
	<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h5>Ingresa los datos solicitados</h5>
					</div>
					<div class="card-body" >
						<?php 						
						echo $this->render('_formPass', [
							'model' => $model,
						]); 
						?>
					</div>
				</div>
			</div>
		</div>
</div>

<script type="text/javascript">

    function confirmDelete(){
		var key = "<?php  echo Yii::$app->globals->encrypt_decrypt($_GET['id'], 'encrypt'); ?>"; 
		var token = "<?php  rand(1,2021); ?>";
		
        alertify.confirm('Confirmación', '¿Seguro que desea eliminar el registro?', 
            function(){
                $.ajax({
                     type: 'POST',
                     url: "index.php?r=usuarios/delete",
                     data:{key:key, token:token},
                     success:function(bool){
						 //console.log('success '+bool);
                        if (bool == true){
                            alertify.success('<span style="color: #FFFFFF;"><i class="fa fa-trash" aria-hidden="true"></i> &nbsp;&nbsp;Registro eliminado<br> espere un momento ...</span>', 2 , function (){
								window.location.href = "index.php?r=usuarios/index&del=true"; 
							}); 
                        }else{
							alertify.error('<span style="color: #FFFFFF;">Ocurrio un error, intenta de nuevo</span>', 2 , function (){location.reload(); }); 
						}
                     },
                     error: function(data){ 
                        // console.log('error '+data);
						alertify.error('<span style="color: #FFFFFF;">Ocurrio un error, intenta de nuevo</span>', 2 , function (){location.reload(); }); 
                     },
                });
            },
            function(){
            });
    }
</script>
