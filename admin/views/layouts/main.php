<?php
use app\widgets\Alert;
use yii\helpers\Html;
use app\assets\AppAsset;

$asset = AppAsset::register($this);
$baseUrl = $asset->baseUrl; 

$usName = "";
$usTipo = "";
$usNick = "";

if(isset(Yii::$app->user->identity->usuarioID) && !empty(Yii::$app->user->identity->usuarioID)) {
	$usName = Yii::$app->user->identity->nombrecomercialUsuario;
	$usTipo = Yii::$app->user->identity->Tipo_user;
	$usNick = Yii::$app->user->identity->usuario;
}else{
	Yii::$app->user->logout();
	Yii::$app->response->redirect(['site/login']);
}

//Yii::$app->user->identity->User_admin;
$pName = explode(" ", $usName);

$fName = "";
$sName = "";

if(isset($pName[0])){
	$fName = strtoupper(substr($pName[0],0,1));
	
}

if(isset($pName[1])){
	$sName = strtoupper(substr($pName[1],0,1));
}


$this->beginPage() 
?>
<!DOCTYPE html>
<html lang="ES-es">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Panel :: <?= $usName  ?> </title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" type="image/png" href="<?= $baseUrl; ?>/require/img/favicon.png" />
	<!-- Fonts and icons -->

	<!-- CSS Files -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900">
	<?php $this->registerCsrfMetaTags() ?>
	<!-- plugins css -->
    <?php $this->head() ?>
	<link rel="stylesheet" href="<?= $baseUrl; ?>/require/css/demo.css"/>
	<link rel="stylesheet" href="<?= $baseUrl; ?>/require/css/alertif.min.css"/>
	
</head>
<body data-background-color="bg3">
	<?php $this->beginBody() ?>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="red">
				
				<a href="index.html" class="logo" style="margin-top: 15px;">
					<img src="<?php echo $baseUrl; ?>/require/img/logo_white.png" style="max-height: 30px;">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="red2">
				
				<div class="container-fluid">
					
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="<?php echo $baseUrl; ?>/require/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="<?php echo $baseUrl; ?>/require/img/profile.jpg" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4><?= $usNick  ?></h4>
												<p class="text-muted" style="font-size: 9px; color: #E1E1E1;">Usuario</p>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<div class="dropdown-divider"></div>
										<?php
										  $stLogout = '<i class="ti-layout-sidebar-left"></i>
										  Salir';
										  echo Html::a($stLogout, ['site/logout'], ['class'=>'dropdown-item', 'data' => ['method' => 'post']]);
										?>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2" >			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="<?php echo $baseUrl; ?>/require/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<?= $usNick  ?>
									<span class="user-level" style="font-size: 9px; color: #E1E1E1;">Usuario</span>
								</span>
							</a>
							<div class="clearfix"></div>
						</div>
					</div>
					
					<?php
					$menuPrincipal = array(
						array("tipo"=>"item", "vistas" => 'productos,imagenes', "icon" => 'flaticon-price-tag', "permiso" => 'Usuarios,Administrador', "texto" => "Productos", 	"url" => "productos/index"),
	
						array("tipo"=>"item", "vistas" => 'sliders', "icon" => 'flaticon-picture', "permiso" => 'Usuarios,Administrador', "texto" => "Sliders", 	"url" => "sliders/index"),
	
						array("tipo"=>"item", "vistas" => 'nosotros', "icon" => 'flaticon-interface-6', "permiso" => 'Usuarios,Administrador', "texto" => "Nosotros", 	"url" => "nosotros/update&id=1"),
						
																		
						array("tipo"=>"section", "vista" => '', "icon" => '', "permiso" => 'Administrador', "texto" => "Configuraciones", 	"url" => ""),
						array("tipo"=>"item", "vistas" => 'usuarios', "icon" => 'flaticon-user-5', "permiso" => 'Administrador', "texto" => "Usuarios", 	"url" => "usuarios/index"),
	
						array("tipo"=>"item", "vistas" => 'categorias', "icon" => 'flaticon-list', "permiso" => 'Administrador', "texto" => "Categorias", 	"url" => "categorias/index"),
	
						array("tipo"=>"item", "vistas" => 'disenador', "icon" => 'flaticon-users', "permiso" => 'Administrador', "texto" => "Diseñadores", 	"url" => "disenador/index"),

						array(
							"tipo" => "item",
							"vistas" => 'arte', // Vista asociada
							"icon" => 'flaticon-paint-brush', // Icono representativo
							"permiso" => 'Usuarios,Administrador', // Permisos necesarios
							"texto" => "Arte", // Texto del menú
							"url" => "arte/index" // URL de la vista
						),
	
					);
					
					$viewSelect = "";
					if(isset($_GET['r'])){
						$viewActual = explode("/", $_GET['r']);
						if(isset($viewActual[0])){
							$viewSelect = $viewActual[0];
						}
					}
					
					echo '<ul class="nav nav-primary">';
					foreach($menuPrincipal as $rmpl){
						$permisoUser = explode(",", $rmpl['permiso']);
						if(count($permisoUser) != 0){
							if(in_array(Yii::$app->user->identity->Tipo_user, $permisoUser)) {
								if($rmpl['tipo'] == "item"){
									$viewSelectArray = explode(",", $rmpl['vistas']);
									if(in_array($viewSelect, $viewSelectArray)) {
										echo '<li class="nav-item active">';
									}else{
										echo '<li class="nav-item">';
									}
									echo Html::a('<i class="'.$rmpl['icon'].'"></i><p>'.$rmpl['texto'].'</p>', $url = [$rmpl['url']]); 
									echo '</li>';
									
								}

								if($rmpl['tipo'] == "section"){
									echo '<li class="nav-section">
												<span class="sidebar-mini-icon">
													<i class="fa fa-ellipsis-h"></i>
												</span>
												<h4 class="text-section">'.$rmpl['texto'].'</h4>
										  </li>';
								}
							}
						}
					}
					echo '</ul>';
					?>
				
				</div>
			</div>
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="container">				
				<?= $content; ?> 
			</div>
			
			<footer class="footer">
				<div class="container-fluid">
					
					<div class="copyright ml-auto">
						<?= date('Y') ?>, desarrollado por <a href="http://codyexpert.com/">CodyExpert.com</a>
					</div>				
				</div>
			</footer>
		</div>
		
	</div>
	<!--   Core JS Files   -->
	<script src="<?= $baseUrl; ?>/require/js/jquery/jquery.min.js"></script>	
	<script src="<?= $baseUrl; ?>/require/js/alertif.min.js"></script>
	<script src="<?= $baseUrl; ?>/require/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
    <?php $this->endBody() ?>
	
</body>
</html>
<?php $this->endPage() ?>