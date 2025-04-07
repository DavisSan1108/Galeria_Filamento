<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

$attributeLabels = $searchModel->attributeLabels();
?>

<div class="page-navs bg-white py-3 pr-2">
	<div class="page-header">
		<h5 class="page-title">Productos</h5>
		<ul class="breadcrumbs">
			<li class="nav-home">				
				<i class="far fa-folder-open" style="font-size: 18px;"></i>
			</li>
			<li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				Inicio
			</li>
		</ul>
		<div class="ml-auto">
			<div class="page-header-breadcrumb">
				<?php 		
						$mInicioGral = '<i class="icon-menu"></i> Inicio';
						echo Html::a($mInicioGral, $url = ['productos/index'], $options = ['class'=>'btn btn-primary btn-xs menuBotones active']);
					
						$mAltaGral = '<i class="icon-plus"></i> Agregar';
						echo Html::a($mAltaGral, $url = ['productos/create'], $options = ['class'=>'btn btn-primary btn-xs menuBotones']);
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
					'summary' => Html::a('<i class="fa fa-minus-square" aria-hidden="true"></i> Limpiar filtro', $url = ['productos/index&clear=true'], $options = ['style'=>'color:#003e59;']).' | Viendo {count} de {totalCount} resultados.', 
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
								 if($data->urlImagenProducto == 'na' or $data->urlImagenProducto == ''){
									  return Html::img(Url::base()."/productos/no_producto.jpg", ["width"=>"35", "height"=>"40"]);
								 }else{
									  return Html::img(Url::base()."/productos/".$data->urlImagenProducto, ["width"=>"35", "height"=>"40"]); 
									  
								 }
								 
							 },
							 'contentOptions'=> ['data-th' => $attributeLabels['urlImagenProducto'].' : '],
							 'filterOptions'=> ['data-th' => $attributeLabels['urlImagenProducto']],
							 'format'=>'raw',
							 'options' => ['style' => 'width:60px;'],
						],
						
						[ 
							 'attribute'=>'categoriaID',
							 'value'=>'idCategoria.nombreCategoria',
							 'contentOptions'=> ['data-th' => $attributeLabels['categoriaID'].' : '],
							 'filterOptions'=> ['data-th' => $attributeLabels['categoriaID']],
							 'format'=>'raw',
						],
						
						
						[ 
							 'attribute'=>'nombreProducto',
							 'value'=>'nombreProducto',
							 'contentOptions'=> ['data-th' => $attributeLabels['nombreProducto'].' : '],
							 'filterOptions'=> ['data-th' => $attributeLabels['nombreProducto']],
							 'format'=>'raw',
						],
						[ 
							 'header' => 'Descripción',
							 'attribute'=>'descripcionProducto',
							 'value'=>'descripcionProducto',
							 'contentOptions'=> ['data-th' => $attributeLabels['descripcionProducto'].' : '],
							 'filterOptions'=> ['data-th' => $attributeLabels['descripcionProducto']],
							 'format'=>'raw',
						],
						/*[ 
							 'header' => 'Diseño',
							 'attribute'=>'desigActive',
							 'value'=>'desigActive',
							 'contentOptions'=> ['data-th' => $attributeLabels['desigActive'].' : '],
							 'filterOptions'=> ['data-th' => $attributeLabels['desigActive']],
							 'format'=>'raw',
							 'filter'=> [0=>'No',1=>'Si'],
							 'format'=> 'boolean',
						],
						[ 
							 'header' => 'Destacado',
							 'attribute'=>'prodDest',
							 'value'=>'prodDest',
							 'contentOptions'=> ['data-th' => $attributeLabels['prodDest'].' : '],
							 'filterOptions'=> ['data-th' => $attributeLabels['prodDest']],
							 'format'=>'raw',
							 'filter'=> [0=>'No',1=>'Si'],
							 'format'=> 'boolean',
						],*/
						[ 
							 'attribute'=>'activoProducto',
							 'value'=>'activoProducto',
							 'contentOptions'=> ['data-th' => $attributeLabels['activoProducto'].' : '],
							 'filterOptions'=> ['data-th' => $attributeLabels['activoProducto']],
							 'format'=>'raw',
							 'filter'=> [0=>'No',1=>'Si'],
							 'format'=> 'boolean',
						],
						
        //'urlImagenProducto',
        //'activoProducto:boolean',
        //'estadoProducto:boolean',
						

						['class' => 'yii\grid\ActionColumn',
							'options' => ['style' => 'width:100px;'],
									'template' => '{update} {delete}',
									'buttons' => [
										'update' => function ($url, $model) {
											$url_group = 'index.php?r=productos/update&id='.$model->productoID;
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
											$idEnc = Yii::$app->globals->encrypt_decrypt($model->productoID, 'encrypt');
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
                     url: "index.php?r=productos/delete",
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
