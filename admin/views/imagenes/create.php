<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
  

<div class="page-navs bg-white py-3 pr-2">
	<div class="page-header">
		<h5 class="page-title">Imagenes</h5>
		<ul class="breadcrumbs">
			<li class="nav-home">				
				<i class="far fa-folder-open" style="font-size: 18px;"></i>
			</li>
			<li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				Agregar registro
			</li>
		</ul>
		<div class="ml-auto">
			<div class="page-header-breadcrumb">
				<?php 		
						$mInicioGral = '<i class="icon-menu"></i> Inicio';
						echo Html::a($mInicioGral, $url = ['imagenes/index'], $options = ['class'=>'btn btn-primary btn-xs menuBotones']);
					
						$mAltaGral = '<i class="icon-plus"></i> Agregar';
						echo Html::a($mAltaGral, $url = ['imagenes/create'], $options = ['class'=>'btn btn-primary btn-xs menuBotones active']);
					?>
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
						echo $this->render('_form', [
							'model' => $model,
						]); 
						?>
					</div>
				</div>
			</div>
		</div>
</div>