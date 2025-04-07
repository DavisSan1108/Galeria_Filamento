<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

use yii\widgets\ActiveForm;

$attributeLabels = $searchModel->attributeLabels();
if(isset($_GET['id'])){
	$producto = Yii::$app->db->createCommand('Select * from productos where productoID="'.$_GET['id'].'"')->queryOne();
	if(!isset($producto['nombreProducto'])){
		return Yii::$app->response->redirect(['productos/index']);
	}
	
}else{
	return Yii::$app->response->redirect(['productos/index']);
}
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
				<?php echo $producto['nombreProducto'];?>
			</li>
		</ul>
		<div class="ml-auto">
			<div class="page-header-breadcrumb">
				<?php 		
						$mInicioGral = '<i class="icon-menu"></i> Inicio';
						echo Html::a($mInicioGral, $url = ['productos/index'], $options = ['class'=>'btn btn-primary btn-xs  menuBotones']);
					
						$mAltaGral = '<i class="icon-plus"></i> Agregar';
						echo Html::a($mAltaGral, $url = ['productos/create'], $options = ['class'=>'btn btn-primary btn-xs menuBotones']);
					
						$mUpdateGral = '<i class="icon-note"></i>	Editar';
						echo Html::a($mUpdateGral, $url = ['productos/update&id='.$_GET['id']], $options = ['class'=>'btn btn-primary btn-xs menuBotones active']);
				
						$mImgGral = '<i class="icon-picture"></i>	Imagenes';
						echo Html::a($mImgGral, $url = ['imagenes/index&id='.$_GET['id']], $options = ['class'=>'btn btn-primary btn-xs menuBotones active']);
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
						<h5>Listado de registros</h5>
					</div>
					
					<div class="col-12">
                        <div class="card">
                            <div class="card-body">
					<?php
						if(isset($_GET['upload'])){
								if($_GET['upload'] == 'true'){
									echo '<div class="alert alert-success" role="alert">
											 <i class="fa fa-check-square-o" aria-hidden="true"></i>  Imagen agregada con exito! 
										 </div>';
								}else{
									echo '<div class="alert alert-danger" role="alert">
											 <i class="fa fa-check-square-o" aria-hidden="true"></i>  Ocurrio un error al tratar de guardar la imagen! 
										 </div>';
								}
							}

								
						?>
					
					<div style="clear: both;"></div>
						<?php 
						$form = ActiveForm::begin([
							'options' => [
								'enctype' => 'multipart/form-data',
								'method' => 'post',
							]
						]);		
						?>
						<div class="form-group col-sm-3 float-left  pleft-0">
								<label for="nombredocumentoasignacion">Nombre del archivo</label>
								<input type="text" id="nombredocumentoasignacion" class="form-control form-control-sm" name="nombredocto" maxlength="250" aria-required="true" aria-invalid="true" required>
						</div>
						<div class="form-group col-sm-3 float-left  pleft-0">
							<label class="control-label" for="tiposcontratos-urlformato">
								Archivo						
							</label><br>
							<div class="input-group mb-3">
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="file" name="file" required>
									<label class="custom-file-label" for="textoFile">Selecciona tu archivo</label>
								</div>
							</div>
						</div>
											
								
						<div class="form-group col-sm-3 float-left  pleft-0">
								<?= Html::submitButton('<i class="fas fa-save"></i> &nbsp; Guardar', ['style'=>'margin-top:22px;', 'name'=>'doctos', 'class' => 'btn btn-success btn-sm submitFormBtn']) ?>
						</div>
								
						<?php 
							ActiveForm::end(); 
						?>
								
							<div style="clear: both;"></div>
							</div>
							</div>
						</div>
					
					<div class="card-body" >
										<?= GridView::widget([
					'dataProvider' => $dataProvider,
					'pager' => [
						'firstPageLabel' => 'Primero',
						'lastPageLabel'  => 'Ultimo',
						'activePageCssClass' => 'paginate_button page-item active',
						'linkOptions' => ['class' => 'page-link'],
						'options' => ['class' => 'pagination', 'style'=>'margin-top:10px;'],
					],
					'summary' => Html::a('<i class="fa fa-minus-square" aria-hidden="true"></i> Limpiar filtro', $url = ['imagenes/index&clear=true'], $options = ['style'=>'color:#003e59;']).' | Viendo {count} de {totalCount} resultados.', 
					'filterModel' => $searchModel,    
					'tableOptions' => ['class' => 'table table-striped table-bordered tblresponsive'],
					'columns' => [
						[
							'class' => 'yii\grid\SerialColumn',
							'contentOptions' => ['data-th' => '#'],
							'filterOptions' => ['data-th' => 'Buscar por : '],
						],
						
						[ 
							 'header'=>'Img',
							 "value" => function($data) { 
								 if($data->urlImagen == 'na' or $data->urlImagen == ''){
									  return Html::img(Url::base()."/productos/no_producto.jpg", ["width"=>"45", "height"=>"50"]);
								 }else{
									  return Html::img(Url::base()."/productos/".$data->urlImagen, ["width"=>"45", "height"=>"50"]); 
									  
								 }
								 
							 },
							 'contentOptions'=> ['data-th' => $attributeLabels['urlImagen'].' : '],
							 'filterOptions'=> ['data-th' => $attributeLabels['urlImagen']],
							 'format'=>'raw',
							 'options' => ['style' => 'width:90px;'],
						],
						
						
						[ 
							 'attribute'=>'nombreImagen',
							 'value'=>'nombreImagen',
							 'contentOptions'=> ['data-th' => $attributeLabels['nombreImagen'].' : '],
							 'filterOptions'=> ['data-th' => $attributeLabels['nombreImagen']],
							 'format'=>'raw',
						],
												
        //'estadoImagen:boolean',
						

						['class' => 'yii\grid\ActionColumn',
							'options' => ['style' => 'width:100px;'],
									'template' => '{delete}',
									'buttons' => [
										'update' => function ($url, $model) {
											$url_group = 'index.php?r=imagenes/update&id='.$model->imagenproductoID;
											return Html::a(
												'<img src="'.Yii::$app->request->BaseUrl.'/images/icon-edit.png" width="25px"  alt="editar"/>',
												$url_group, 
												[
													'title' => 'editar',
													'data-pjax' => '0',
												]
											);
										},

										'delete' => function ($url, $model) {
											$idEnc = Yii::$app->globals->encrypt_decrypt($model->imagenproductoID, 'encrypt');
											$rnd = rand(1,2021);
											$url_group = 'javascript:confirmDelete("'.$idEnc.'", "'.$rnd.'")';
											return Html::a(
												'<img src="'.Yii::$app->request->BaseUrl.'/images/icon-del1.png" width="25px"  alt="eliminar"/>',
												$url_group, 
												[
													'title' => 'editar',
													'data-pjax' => '1',
												]
											);
										},
									],

						],
					],
				]); ?>
				
									</div>
				</div>
			</div>
		</div>
</div>

<script type="text/javascript">

    function confirmDelete(key, token){
        alertify.confirm('Confirmación', '¿Seguro que desea eliminar el registro?', 
            function(){
                $.ajax({
                     type: 'POST',
                     url: "index.php?r=imagenes/delete",
                     data:{key:key, token:token},
                     success:function(bool){
						 //console.log('success '+bool);
                        if (bool == true){
                            alertify.success('<span style="color: #FFFFFF;"><i class="fa fa-trash" aria-hidden="true"></i> &nbsp;&nbsp;Registro eliminado<br>espere un momento ...</span>', 2 , function (){location.reload(); }); 
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
