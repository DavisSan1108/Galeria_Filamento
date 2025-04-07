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
		<h5 class="page-title">Diseñador</h5>
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
						echo Html::a($mInicioGral, $url = ['disenador/index'], $options = ['class'=>'btn btn-primary btn-xs menuBotones active']);
					
						$mAltaGral = '<i class="icon-plus"></i> Agregar';
						echo Html::a($mAltaGral, $url = ['disenador/create'], $options = ['class'=>'btn btn-primary btn-xs menuBotones']);
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
							'filterModel' => $searchModel,
							'tableOptions' => ['class' => 'table table-striped table-bordered tblresponsive'],
							'columns' => [
								[
									'class' => 'yii\grid\SerialColumn',
									'contentOptions' => ['data-th' => '#'],
								],
								[
									'attribute' => 'nombreDisenador',
									'value' => function ($model) {
										return $model->nombreDisenador ? Html::encode($model->nombreDisenador) : null;
									},
									'contentOptions' => ['data-th' => $attributeLabels['nombreDisenador'] . ' : '],
									'filterOptions' => ['data-th' => $attributeLabels['nombreDisenador']],
									'format' => 'raw',
								],
								[
									'attribute' => 'activoDisenador',
									'value' => function ($model) {
										return $model->activoDisenador ? 'Sí' : 'No';
									},
									'contentOptions' => ['data-th' => $attributeLabels['activoDisenador'] . ' : '],
									'filterOptions' => ['data-th' => $attributeLabels['activoDisenador']],
									'filter' => [0 => 'No', 1 => 'Sí'],
									'format' => 'boolean',
								],
								[
									'class' => 'yii\grid\ActionColumn',
									'template' => '{update} {delete}',
									'buttons' => [
										'update' => function ($url, $model) {
											if ($model->disenadorID) {
												$url_group = 'index.php?r=disenador/update&id=' . $model->disenadorID;
												return Html::a(
													'<img src="' . Yii::$app->request->BaseUrl . '/images/icon-edit.png" width="25px" alt="editar"/>',
													$url_group,
													['title' => 'editar', 'data-pjax' => '0']
												);
											}
											return null;
										},
										'delete' => function ($url, $model) {
											if ($model->disenadorID) {
												$idEnc = Yii::$app->globals->encrypt_decrypt($model->disenadorID, 'encrypt');
												$rnd = rand(1, 2021);
												$url_group = 'javascript:confirmDelete("' . $idEnc . '", "' . $rnd . '")';
												return Html::a(
													'<img src="' . Yii::$app->request->BaseUrl . '/images/icon-del1.png" width="25px" alt="eliminar"/>',
													$url_group,
													['title' => 'eliminar', 'data-pjax' => '1']
												);
											}
											return null;
										},
									],
								],
							],
						]); 
					?>
				
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
                     url: "index.php?r=disenador/delete",
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
