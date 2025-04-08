<?php
require_once('conn/conexion.php');

$num_paginas = 20;
$pagina_actual= 1;
		  
if(isset($_GET["pagina"])){
	if($_GET['pagina'] != ''){
		 if(is_numeric($_GET["pagina"])){
		 	$pagina = $_GET["pagina"];
		 	$pagina_actual= $pagina;
		 }else{
			$pagina = 1; 
		 }
	}else{
		$pagina = 1;
	}	
}else{
	$pagina = 1;
}

$pagina_ini = ($pagina-1) * $num_paginas;
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
	$menu = "shop";
	require_once('header.php');
   ?>

    <!-- Header Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
									<?php
									  $pSel = 0;
									  $strCat = "select * from categorias where activoCategoria = 1 and estadoCategoria=1";
									  $resultCat = $conn->query($strCat);
									  $total_cat =  $resultCat->num_rows;
									  
									  if($total_cat == 0){
										  echo '<li><a href="shop.php">All</a></li>';
									  }else{
										  $selP = "td";
										  if(isset($_GET['p'])){
											  $selP = $_GET['p'];
											  if($selP  == 'td'){
												   echo '<li><a href="shop.php">All</a></li>';
											  }else{
												   echo '<li><a href="shop.php">All</a></li>';
											  }
										  }else{
											   echo '<li><a href="shop.php">All</a></li>';
										  }
										 while($rowP = mysqli_fetch_assoc($resultCat)){
											 if($selP == $rowP['abreviatura']){
												 echo ' <li><a href="shop.php?cat='.$rowP['abreviatura'].'">'.$rowP['nombreCategoria'].'</a></li>';
												 $pSel = 1;
											 }else{
												 echo ' <li><a href="shop.php?cat='.$rowP['abreviatura'].'">'.$rowP['nombreCategoria'].'</a></li>';
											 }											
										 }
										  
									  }
									?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseTwo">Designers</a>
                                    </div>
                                    <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__brand">
                                                <ul>
                                       <?php
									  $pSel = 0;
									  $strCat = "select * from disenador where activoDisenador = 1 and estadoDisenador=1";
									  $resultCat = $conn->query($strCat);
									  $total_cat =  $resultCat->num_rows;
									  
									  if($total_cat == 0){
										  echo '<li><a href="shop.php">All</a></li>';
									  }else{
										  $selP = "td";
										  if(isset($_GET['p'])){
											  $selP = $_GET['p'];
											  if($selP  == 'td'){
												   echo '<li><a href="shop.php">All</a></li>';
											  }else{
												   echo '<li><a href="shop.php">All</a></li>';
											  }
										  }else{
											   echo '<li><a href="shop.php">All</a></li>';
										  }
										 while($rowP = mysqli_fetch_assoc($resultCat)){
											 if($selP == $rowP['abreviatura']){
												 echo ' <li><a href="shop.php?dis='.$rowP['abreviatura'].'">'.$rowP['nombreDisenador'].'</a></li>';
												 $pSel = 1;
											 }else{
												 echo ' <li><a href="shop.php?dis='.$rowP['abreviatura'].'">'.$rowP['nombreDisenador'].'</a></li>';
											 }											
										 }
										  
									  }
									?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
			
					
					
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    <!-- <p>Showing 1–12 of 126 results</p> -->
									Products List
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
								<!--
                                <div class="shop__product__option__right">
                                    <p>Sort by Price:</p>
                                    <select>
                                        <option value="">Low To High</option>
                                        <option value="">$0 - $55</option>
                                        <option value="">$55 - $100</option>
                                    </select>
                                </div>
								-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                       
						
						
		<?php		
		$qry_p = "select * from  productos where activoProducto = 1 and estadoProducto=1 order by nombreProducto ASC";
		
		if(isset($_GET['cat'])){			
			$qry_p = "select productos.* from  productos 
			inner join categorias on categorias.categoriaID = productos.categoriaID
			where abreviatura='".$_GET['cat']."' and activoProducto = 1 and estadoProducto=1 order by nombreProducto ASC";
		}
						
		if(isset($_GET['dis'])){			
			$qry_p = "select * from  productos 
			inner join disenador on disenador.disenadorID = productos.disenadorID
			where abreviatura='".$_GET['dis']."' and activoProducto = 1 and estadoProducto=1 order by nombreProducto ASC";
		}
		
					
		
		$qr_p = $conn->query($qry_p);
		$p_total =  $qr_p->num_rows;
		
		$total_paginas = ceil($p_total / $num_paginas); 
						
		$qry_f = "select * from  productos where activoProducto = 1 and estadoProducto=1 order by nombreProducto ASC LIMIT ".$pagina_ini.", ".$num_paginas."";
		
		if(isset($_GET['cat'])){				
			$qry_f = "select * from  productos
		    inner join categorias on categorias.categoriaID = productos.categoriaID
			where abreviatura='".$_GET['cat']."' and activoProducto = 1 and estadoProducto=1 order by nombreProducto ASC LIMIT ".$pagina_ini.", ".$num_paginas."";
		}
						
		if(isset($_GET['dis'])){			
			$qry_f = "select * from  productos 
			inner join disenador on disenador.disenadorID = productos.disenadorID
			where abreviatura='".$_GET['dis']."' and activoProducto = 1 and estadoProducto=1 order by nombreProducto ASC LIMIT ".$pagina_ini.", ".$num_paginas."";
		}
						
						
		$con_res = $conn->query($qry_f);
						
		if($p_total != 0){
			$numberMd = 1;
			echo '<div class="row">';
			while($row = mysqli_fetch_assoc($con_res)){				
				if($row['urlImagenProducto'] != ''){
								$url_img = '/Galeria_Filamento/admin/web/productos/'.$row['urlImagenProducto'];
							}else{
								$url_img = '/Galeria_Filamento/admin/web/productos/no_img.png';
							}

							
				
                            echo '<div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item sale">
                                        <div class="product__item__pic" style="width: 100%; height: 250px; overflow: hidden;">
                                            <img src="'.$url_img.'" alt="'.$row['nombreProducto'].'" style="width: 100%; height: 100%; object-fit: contain; object-position: center;">
                                        </div>
                                        <div class="product__item__text">
                                            <h6>'.$row['nombreProducto'].'</h6>
                                            <a href="shop-details.php?pdto='.$row['productoID'].'" class="add-cart">+ Show More</a>
                                        </div>
                                    </div>
                                </div>';
			}
			echo '</div>';
		}else{
			echo '<div class="col-sm-12 text-center"><br><br><br><br>
			<div class="alert alert-danger" role="alert">
				 <strong> Oopp!</strong> No encontramos productos en la categoria seleccionada, intente más tarde.
			</div>
			</div><br><br><br><br>';
		}
					echo '<div class="clearfix"><br></div>';
					echo '<div style="clear: both;"></div><br>';
					if($total_paginas > 1){
					?>
					<br><br>
						
						
					<div class="clearfix" id="page"></div>
						
					<div class="row d-none">
                        <div class="col-lg-12">
                            <div class="product__pagination">
								<?php
								for ($i=1; $i<=$total_paginas; $i++) {
									//En el bucle, muestra la paginación
									echo '<li><a href="productos.php?pagina='.$i.$qryPag.'">'.$i.'</a></li>';
									echo ' <a href="productos.php?pagina='.$i.$qryPag.'">'.$i.'</a>';
									
								}; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product__pagination">
                                <ul class="pagination">
                                    <?php
                                    $url_actual = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                                    $url_base = strtok($url_actual, '?'); // Esto elimina cualquier cosa después de ?
                                    parse_str(parse_url($url_actual, PHP_URL_QUERY), $query_params); // Obtiene los parámetros GET
                    
                                    // Eliminar el parámetro de la página actual
                                    unset($query_params['pagina']); 
                    
                                    // Reconstruir la base de la URL con los parámetros que quieres conservar
                                    $qryPag = http_build_query($query_params);
                                    for ($i = 1; $i <= $total_paginas; $i++) {
                                        // Muestra los enlaces de paginación
                                        $active_class = ($i == $pagina_actual) ? 'active' : ''; // Página actual
                                        echo '<li class="' . $active_class . '"><a href="' . $url_base . '?' . $qryPag . '&pagina=' . $i . '">' . $i . '</a></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>

						
										
					 
					<?php
						}
					?>
                        
						
					<style>
					    /* Estilo general para la paginación */
                        .product__pagination .pagination {
                            display: flex;
                            justify-content: center; /* Centra la paginación */
                            list-style-type: none; /* Elimina los puntos de lista predeterminados */
                            padding: 0;
                            margin: 0;
                        }
                        
                        .product__pagination .pagination li {
                            margin: 0 5px; /* Espacio entre los botones de la paginación */
                        }
                        
                        .product__pagination .pagination a {
                            display: block;
                            padding: 0 10 10px 15px;
                            text-decoration: none;
                            color: #333; /* Color de texto */
                            border: 1px solid #ddd; /* Borde de los botones */
                            border-radius: 5px; /* Bordes redondeados */
                            transition: background-color 0.3s ease; /* Transición suave para el cambio de color */
                        }
                        
                        .product__pagination .pagination a:hover {
                            background-color: #007bff; /* Color de fondo al pasar el ratón */
                            color: white; /* Color del texto al pasar el ratón */
                        }
                        
                        .product__pagination .pagination .active a {
                            background-color: #007bff; /* Fondo para la página activa */
                            color: white; /* Texto blanco en la página activa */
                            pointer-events: none; /* Evita que el enlace de la página activa sea clickeable */
                        }


                        .product__item__pic {
                            position: relative;
                            width: 100%;
                            height: 250px; /* Ajusta la altura según tus necesidades */
                            overflow: hidden;
                            background-size: cover;
                            background-position: center;
                        }

                        .product__item__pic img {
                            width: 100%;
                            height: 100%;
                            object-fit: cover; /* Cambia a 'contain' si quieres que la imagen se ajuste completamente sin recortarse */
                            object-position: center;
                        }


					</style>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

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
	
