<?php
	require_once('conn/conexion.php');
?>
<!DOCTYPE html>
<html lang="EN">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Filamento Galería">
    <meta name="keywords" content="Filamento Galería, lamps">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Filamento Galería</title>
	<link rel="icon" type="image/png" href="img/favicon.png" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

   <?php
	$menu = "index";
	require_once('header.php');
   ?>

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="hero__slider owl-carousel" >
			
			<?php
			$strConsulta = "select * from sliders where activoSlider=1 and estadoSlider=1";
			$result = $conn->query($strConsulta);
			// echo "pepe". $conn->query($strConsulta);
			$total_prod =  $result->num_rows;
			
			if($total_prod != 0){
				while($row = mysqli_fetch_assoc($result)){
					//admin/web/sliders/'.$row['urlImagenSlader'].'
					echo '<div class="hero__items set-bg" data-setbg="img/slide/hero-2.jpg">
							<div class="container">
								<div class="row">
								<div class="col-sm-12">
									<div class="col-sm-6" style="float: left">
										<div class="hero__text">
											<h6>'.$row['tituloSlider'].'</h6>
											<h2>'.$row['textSlider'].'</h2>
											<p>'.$row['descripcionSlider'].'</p>';
					
							if($row['urlSlader'] != ""){
								echo '<a href="'.$row['urlSlader'].'" class="primary-btn">More Details<span class="arrow_right"></span></a>';
							}
											
											
					echo '				</div>
										
									</div>
									<div class="col-sm-6" style="float: left">
											<img src="admin/web/sliders/'.$row['urlImagenSlader'].'" class="img-fluid" />
									</div>
								</div>
								</div>
							</div>
						</div>';
				}
			}
			
			?>
            
        </div>
    </section>
    <!-- Hero Section End -->
	<section style="margin-top: 30px;">
		<div class="container">
            <div class="row">
				<div class="col-sm-6">
					<img src="img/about.png" class="img-fluid" />
				</div>
				<div class="col-sm-6" style="padding-top: 30px;">
					<?php
					$strNosotros = "select * from nosotros where nosotrosID=1";
					$resultNosotros = $conn->query($strNosotros);
					$totalNosotros =  $resultNosotros->num_rows;
					
					
					$tituloNosotros = "About";
					$contenidoNosotros = "";
					
					$rowNosotros = mysqli_fetch_assoc($resultNosotros);
					if(isset($rowNosotros['nosotrosID'])){
						$tituloNosotros = $rowNosotros['titulo'];
						$contenidoNosotros = $rowNosotros['descripcion'];
					}
					?>
					<h2><?php echo $tituloNosotros; ?></h2>	
					<br>
					<?php echo $contenidoNosotros; ?>
				</div>
			</div>
		</div>		
	</section>
    <!-- Banner Section Begin -->
    <section class="banner spad section-bg3" data-background="img/section_bg01.png" style="background-image: url('img/section_bg01.png'); margin-top: 30px;">
        <div class="container">
            <div class="row">
				<div class="col-sm-12 text-center" style="margin-bottom: 30px;">
					<h2>Designers</h2>
				</div>
				
				<?php
				$strDisenador = "SELECT productos.nombreProducto, disenador.abreviatura, disenador.nombreDisenador, productos.urlImagenProducto FROM productos inner join disenador on disenador.disenadorID = productos.disenadorID WHERE desigActive=1 and activoProducto=1 and estadoProducto =1 limit 3";
				$rDiseno = $conn->query($strDisenador);
				$totalDiseno =  $rDiseno->num_rows;

				if($totalDiseno != 0){
					$numDiseno = 1;
					while($rowDis = mysqli_fetch_assoc($rDiseno)){
						$nameDise = str_replace(" ", "<br>", $rowDis['nombreDisenador']);
						if($numDiseno == 1){
							echo '<div class="col-lg-7 offset-lg-4">
									<div class="banner__item">
										<div class="banner__item__pic">
											<img src="admin/web/productos/'.$rowDis['urlImagenProducto'].'" alt="" class="img-fluid" style="max-width: 450px;">
										</div>
										<div class="banner__item__text">
											<h2> '.$nameDise.' </h2>
											<a href="shop.php?dis='.$rowDis['abreviatura'].'">More Details</a>
										</div>
									</div>
								</div>';
						}
						
						
						if($numDiseno == 2){
							echo '<div class="col-lg-5">
									<div class="banner__item banner__item--middle">
										<div class="banner__item__pic">
											<img src="admin/web/productos/'.$rowDis['urlImagenProducto'].'" alt="" class="img-fluid" style="max-width: 450px;">
										</div>
										<div class="banner__item__text">
											<h2> '.$nameDise.' </h2>
											<a href="shop.php?dis='.$rowDis['abreviatura'].'">More Details</a>
										</div>
									</div>
								</div>';
						}
						
						if($numDiseno == 3){
							echo ' <div class="col-lg-7">
										<div class="banner__item banner__item--last">
											<div class="banner__item__pic">
												<img src="admin/web/productos/'.$rowDis['urlImagenProducto'].'" alt="" class="img-fluid" style="max-width: 450px;">
											</div>
											<div class="banner__item__text">
												<h2> '.$nameDise.' </h2>
												<a href="shop.php?dis='.$rowDis['abreviatura'].'">More Details</a>
											</div>
										</div>
									</div>';
						}
						$numDiseno++;
					}
				}
				?>
               
            </div>
        </div>
    </section>
	
	
	
    <!-- Banner Section End -->
	<section class="latest spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>nuestra lista de</span>
                        <h2>Productos destacados</h2>
                    </div>
                </div>
            </div>
            <div class="row">
				
				<?php
				$strDestacado = "SELECT nombreProducto, urlImagenProducto, abreviatura  FROM productos inner join categorias on categorias.categoriaID=productos.categoriaID WHERE activoProducto=1 and estadoProducto=1 limit 3";
				$rDestacado = $conn->query($strDestacado);
				$totalDestacado =  $rDestacado->num_rows;

				if($totalDestacado != 0){
					while($rowDes = mysqli_fetch_assoc($rDestacado)){
						echo '<div class="col-lg-4 col-md-6 col-sm-6">
									<div class="blog__item">
										<div class="blog__item__pic set-bg" data-setbg="admin/web/productos/'.$rowDes['urlImagenProducto'].'" style="max-width: 360px;"></div>
										<div class="blog__item__text">

											<h5>'.$rowDes['nombreProducto'].'</h5>
											<a href="shop.php?cat='.$rowDes['abreviatura'].'">Read More</a>
										</div>
									</div>
								</div>';
					}
				}
				?>
                
            </div>
        </div>
    </section>
    <!-- Latest Blog Section End -->
	
	

   

   

    <!-- Footer Section Begin -->
   <?php
	require_once('footer.php');
   ?>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>