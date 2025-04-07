<?php
use app\widgets\Alert;
use yii\helpers\Html;
use app\assets\AppAsset;

$asset = AppAsset::register($this);
$baseUrl = $asset->baseUrl; 

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ES-es">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Panel</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" type="image/png" href="<?= $baseUrl; ?>/require/img/favicon.png" />
	<!-- Fonts and icons -->
	<!--
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	-->
	<!-- CSS Files -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900">
	<?php $this->registerCsrfMetaTags() ?>
	<!-- plugins css -->
    <?php $this->head() ?>  
</head>
<body class="login">
<?php $this->beginBody() ?>
	<div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn">
			 <?= $content; ?>	
		</div>
	</div>
	<script src="<?= $baseUrl; ?>/require/js/jquery/jquery.min.js"></script>	  
	<?php $this->endBody() ?>
</body>
</html>

<?php $this->endPage() ?>