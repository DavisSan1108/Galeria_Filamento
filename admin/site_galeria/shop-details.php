<?php
require_once('conn/conexion.php');
?>

<!DOCTYPE html>
<html lang="En">

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

    <!-- Offcanvas Menu Begin -->
   <?php
	$menu = "";
	require_once('header.php');
   ?>
    <!-- Header Section End -->

    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
                <div class="row">
					<?php
						$info = 0;
						$arryImg = array();
					
					$ofperiod = "";
					$period = "";
					$dimension = "";
					$place = "";
					$condition = "";
					$diameter = "";
					$manufacture = "";
					$wear = "";
					$techniques = "";
					
					$nombreProd = "";
					$descProd = "";
					$categoria = "";
					
					
							if(isset($_GET['pdto'])){
								$qry_p = "SELECT (SELECT nombreCategoria FROM categorias WHERE categoriaID=productos.categoriaID) as Categoria, productos.* FROM productos where productoID='".$_GET['pdto']."'";
								$qr_p = $conn->query($qry_p);
								$p_total =  $qr_p->num_rows;
								
								if($p_total == 1){
									//echo "entro datos";
									$row = mysqli_fetch_assoc($qr_p);
									//print_r($row);
									if(isset($row['productoID'])){
										$nombreProd = $row['nombreProducto'];
										$descProd = $row['descripcionProducto'];
										$categoria = $row['Categoria'];
										
										$ofperiod = $row['delPeriodo'];
										$period = $row['periodo'];
										$dimension = $row['dimension'];
										$place = $row['lugarOrigen'];
										$condition = $row['condicion'];
										$diameter = $row['diametro'];
										$manufacture = $row['yearManufactura'];
										$wear = $row['desgaste'];
										$techniques = $row['material'];
										//echo "entro";
										$info = 1;
										$img = "SELECT * FROM imagenesproductos where productoID = '".$row['productoID']."' and activoImagen=1 and estadoImagen=1";
										$qr_img = $conn->query($img);
										
										
										
										while($rowImg = mysqli_fetch_assoc($qr_img)){	
											$arryImg[] = array('nombre'=>$rowImg['nombreImagen'], 'url'=>$rowImg['urlImagen']);
										}
									}
								}
							}else{
								echo '<div class="col-lg-12"><div class="text-cente"> Producto no disponible</div></div>';
							}
							
							?>
                    <div class="col-lg-3 col-md-3">
						
                        <ul class="nav nav-tabs" role="tablist">
							
							<?php
							$num = 1;
							foreach($arryImg as $rimg){
								$active = "";
								if($num == 1){
									$active = "active";
								}
								echo '
								<li class="nav-item">
									<a class="nav-link '.$active.'" data-toggle="tab" href="#tabs-'.$num.'" role="tab">
										<div class="product__thumb__pic set-bg" data-setbg="admin/web/productos/'.$rimg['url'].'">
										</div>
									</a>
								</li>';
								$num++;
							}
							?>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
							<h4><?php echo $nombreProd; ?></h4>
							<?php
							$num = 1;
							foreach($arryImg as $rimg){
								$active = "";
								if($num == 1){
									$active = "active";
								}
								echo '
								<div class="tab-pane '.$active.'" id="tabs-'.$num.'" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="admin/web/productos/'.$rimg['url'].'" alt="">
                                </div>
                            </div>';
								$num++;
							}
							?>
							
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
               
                <div class="row">
                    <div class="col-lg-12">
						<?php 
						echo "<b>-(".$categoria.")</b><br />";
						echo "<b>".$nombreProd."</b><br />";
						echo $descProd;
						?>
                        <div class="product__details__tab d-none" style="border:solid 2px #ff0000;">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                    role="tab">Details</a>
                                </li>
								<!--
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                                    Previews(5)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Additional
                                    information</a>
                                </li>
								-->

                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="col-sm-4" style="float: left;"><span style="color: #5B210B; font-size: 20px; font-weight: 800;">Of the Period </span><br> <?php echo $ofperiod; ?></div>
										<div class="col-sm-4" style="float: left;"><span style="color: #5B210B; font-size: 20px; font-weight: 800;">Period</span><br> <?php echo $period; ?></div>
										<div class="col-sm-4" style="float: left;"><span style="color: #5B210B; font-size: 20px; font-weight: 800;">Dimension</span><br> <?php echo $period; ?></div>
										
										<div style="clear: both;"></div><br><br>
										
										<div class="col-sm-4" style="float: left;"><span style="color: #5B210B; font-size: 20px; font-weight: 800;">Place of Origin</span><br> <?php echo $place; ?></div>
										<div class="col-sm-4" style="float: left;"><span style="color: #5B210B; font-size: 20px; font-weight: 800;">Condition</span><br> <?php echo $condition; ?></div>
										<div class="col-sm-4" style="float: left;"><span style="color: #5B210B; font-size: 20px; font-weight: 800;">Diameter</span><br> <?php echo $diameter; ?></div>
										
										<div style="clear: both;"></div><br><br>
										
										<div class="col-sm-4" style="float: left;"><span style="color: #5B210B; font-size: 20px; font-weight: 800;">Date of Manufacture</span><br> <?php echo $manufacture; ?></div>
										<div class="col-sm-4" style="float: left;"><span style="color: #5B210B; font-size: 20px; font-weight: 800;">Wear</span><br> <?php echo $wear; ?></div>
										<div class="col-sm-4" style="float: left;"><span style="color: #5B210B; font-size: 20px; font-weight: 800;">Materials and Techniques</span><br> <?php echo $techniques; ?></div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>A Pocket PC is a handheld computer, which features many of the same
                                                capabilities as a modern PC. These handy little devices allow
                                                individuals to retrieve and store e-mail messages, create a contact
                                                file, coordinate appointments, surf the internet, exchange text messages
                                                and more. Every product that is labeled as a Pocket PC must be
                                                accompanied with specific software to operate the unit and must feature
                                            a touchscreen and touchpad.</p>
                                            <p>As is the case with any new technology product, the cost of a Pocket PC
                                                was substantial during it’s early release. For approximately $700.00,
                                                consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                These days, customers are finding that prices have become much more
                                                reasonable now that the newness is wearing off. For approximately
                                            $350.00, a new Pocket PC can now be purchased.</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                            worn all year round.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-7" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                                            solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                            ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                        pharetras loremos.</p>
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>A Pocket PC is a handheld computer, which features many of the same
                                                capabilities as a modern PC. These handy little devices allow
                                                individuals to retrieve and store e-mail messages, create a contact
                                                file, coordinate appointments, surf the internet, exchange text messages
                                                and more. Every product that is labeled as a Pocket PC must be
                                                accompanied with specific software to operate the unit and must feature
                                            a touchscreen and touchpad.</p>
                                            <p>As is the case with any new technology product, the cost of a Pocket PC
                                                was substantial during it’s early release. For approximately $700.00,
                                                consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                These days, customers are finding that prices have become much more
                                                reasonable now that the newness is wearing off. For approximately
                                            $350.00, a new Pocket PC can now be purchased.</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                            worn all year round.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->
	<div style="clear: both;"></div>
	<br><br><br><br>
    <!-- Related Section End -->

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