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
		<h5 class="page-title">Recetas</h5>
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
						echo Html::a($mInicioGral, $url = ['recetas/index'], $options = ['class'=>'btn btn-primary btn-xs menuBotones active']);
					
						$mAltaGral = '<i class="icon-plus"></i> Agregar';
						echo Html::a($mAltaGral, $url = ['recetas/create'], $options = ['class'=>'btn btn-primary btn-xs menuBotones']);
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
					'summary' => Html::a('<i class="fa fa-minus-square" aria-hidden="true"></i> Limpiar filtro', $url = ['recetas/index&clear=true'], $options = ['style'=>'color:#003e59;']).' | Viendo {count} de {totalCount} resultados.', 
					'filterModel' => $searchModel,    
					'tableOptions' => ['class' => 'table table-striped table-bordered tblresponsive'],
					'columns' => [
						[
							'class' => 'yii\grid\SerialColumn',
							'contentOptions' => ['data-th' => '#'],
							'filterOptions' => ['data-th' => 'Buscar por : '],
						],
						
							[ 
         'attribute'=>'recetaID',
         'value'=>'recetaID',
         'contentOptions'=> ['data-th' => $attributeLabels['recetaID'].' : '],
         'filterOptions'=> ['data-th' => $attributeLabels['recetaID']],
         'format'=>'raw',
	],
	[ 
         'attribute'=>'imagenReceta',
         'value'=>'imagenReceta',
         'contentOptions'=> ['data-th' => $attributeLabels['imagenReceta'].' : '],
         'filterOptions'=> ['data-th' => $attributeLabels['imagenReceta']],
         'format'=>'raw',
	],
	[ 
         'attribute'=>'tituloReceta',
         'value'=>'tituloReceta',
         'contentOptions'=> ['data-th' => $attributeLabels['tituloReceta'].' : '],
         'filterOptions'=> ['data-th' => $attributeLabels['tituloReceta']],
         'format'=>'raw',
	],
	[ 
         'attribute'=>'descripcionReceta:ntext',
         'value'=>'descripcionReceta',
         'contentOptions'=> ['data-th' => $attributeLabels['descripcionReceta'].' : '],
         'filterOptions'=> ['data-th' => $attributeLabels['descripcionReceta']],
         'format'=>'raw',
	],
	[ 
         'attribute'=>'activoReceta:boolean',
         'value'=>'activoReceta',
         'contentOptions'=> ['data-th' => $attributeLabels['activoReceta'].' : '],
         'filterOptions'=> ['data-th' => $attributeLabels['activoReceta']],
         'format'=>'raw',
		 'filter'=> [0=>'No',1=>'Si'],
		 'format'=> 'boolean',
	],
        //'estadoReceta:boolean',
						

						['class' => 'yii\grid\ActionColumn',
							'options' => ['style' => 'width:100px;'],
									'template' => '{update} {delete}',
									'buttons' => [
										'update' => function ($url, $model) {
											$url_group = 'index.php?r=recetas/update&id='.$model->recetaID;
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
											$idEnc = Yii::$app->globals->encrypt_decrypt($model->recetaID, 'encrypt');
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
                     url: "index.php?r=recetas/delete",
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
