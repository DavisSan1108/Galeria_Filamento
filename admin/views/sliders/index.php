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
		<h5 class="page-title">Sliders</h5>
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
						echo Html::a($mInicioGral, $url = ['sliders/index'], $options = ['class'=>'btn btn-primary btn-xs menuBotones active']);
					
						$mAltaGral = '<i class="icon-plus"></i> Agregar';
						echo Html::a($mAltaGral, $url = ['sliders/create'], $options = ['class'=>'btn btn-primary btn-xs menuBotones']);
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
					'summary' => Html::a('<i class="fa fa-minus-square" aria-hidden="true"></i> Limpiar filtro', $url = ['sliders/index&clear=true'], $options = ['style'=>'color:#003e59;']).' | Viendo {count} de {totalCount} resultados.', 
					'filterModel' => $searchModel,    
					'tableOptions' => ['class' => 'table table-striped table-bordered tblresponsive'],
					'columns' => [
						[
							'class' => 'yii\grid\SerialColumn',
							'contentOptions' => ['data-th' => '#'],
							'filterOptions' => ['data-th' => 'Buscar por : '],
						],
						[ 
							 'attribute'=>'urlImagenSlader',
							 "value" => function($row, $data) { return "<img src='sliders/".$row['urlImagenSlader']."' style='max-width:250px; margin-top: 5px;'>"; },
							 'contentOptions'=> ['data-th' => $attributeLabels['urlImagenSlader'].' : '],
							 'filterOptions'=> ['data-th' => $attributeLabels['urlImagenSlader']],
							 'format'=>'raw',
						],
						
						[ 
							 'attribute'=>'tituloSlider',
							 'value'=>'tituloSlider',
							 'contentOptions'=> ['data-th' => $attributeLabels['tituloSlider'].' : '],
							 'filterOptions'=> ['data-th' => $attributeLabels['tituloSlider']],
							 'format'=>'raw',
						],
						[ 
							 'attribute'=>'textSlider',
							 'value'=>'textSlider',
							 'contentOptions'=> ['data-th' => $attributeLabels['textSlider'].' : '],
							 'filterOptions'=> ['data-th' => $attributeLabels['textSlider']],
							 'format'=>'raw',
						],
						[ 
							 'attribute'=>'activoSlider',
							 'value'=>'activoSlider',
							 'contentOptions'=> ['data-th' => $attributeLabels['activoSlider'].' : '],
							 'filterOptions'=> ['data-th' => $attributeLabels['activoSlider']],
							 'format'=>'raw',
							 'filter'=> [0=>'No',1=>'Si'],
							 'format'=> 'boolean',
						],
        //'urlSlader',
        //'activoSlider:boolean',
        //'estadoSlider:boolean',
						

						['class' => 'yii\grid\ActionColumn',
							'options' => ['style' => 'width:100px;'],
									'template' => '{update} {delete}',
									'buttons' => [
										'update' => function ($url, $model) {
											$url_group = 'index.php?r=sliders/update&id='.$model->sliderID;
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
											$idEnc = Yii::$app->globals->encrypt_decrypt($model->sliderID, 'encrypt');
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
                     url: "index.php?r=sliders/delete",
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
