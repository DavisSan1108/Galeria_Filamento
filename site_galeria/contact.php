<!DOCTYPE html>
<html lang="zxx">

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

    <!-- Map Begin -->
	<!--
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d111551.9926412813!2d-90.27317134641879!3d38.606612219170856!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited%20States!5e0!3m2!1sen!2sbd!4v1597926938024!5m2!1sen!2sbd" height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
	-->
    <!-- Map End -->
	<section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Contact Us</h4>
                        <div class="breadcrumb__links">
                            <a href="index.php">Home</a> send messaje
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
				<div class="col-sm-12">
									<?php
										if(isset($_GET['envio'])){
											if($_GET['envio'] == 'true'){
												echo '<div class="alert alert-success">
														  <strong>Correo enviado con exito!</strong> gracias por tu correo.
														</div>';
											}else{
												echo '<div class="alert alert-warning">
														  <strong>Servicio de correo no disponible!</strong> intente más tarde.
														</div>';
											}
										}
										?>
				</div>
				<div style="clear: both;"></div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <span>Information</span>
                            <h2>Contact Us</h2>
                            <p>As you might expect of a company that began as a high-end interiors contractor, we pay
                                strict attention.</p>
                        </div>
                        <ul>
                            <li>
                                <h4>E-mail</h4>
                                <p>contacto@galeriafilamento.com</p>
                            </li>
                            <li>
                                <!--<h4>Telephone</h4>
                                <p>+52 345-423-9893</p>-->
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__form">
                        <form  method="post" action="correo_contacto.php">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Name" name="nombre" id="nombre">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Email" name="correo" id="correo">
                                </div>
                                <div class="col-lg-12">
                                    <textarea placeholder="Message" name="mensaje"></textarea>
                                    <button type="submit" class="site-btn">Send Message</button>
                                </div>
								<div id="spam" style="display: none;">
									<label>Dejar esto en blanco</label>
									<input type="text" id="dejarenblanco" name="dejarenblanco" />
									<label>No cambiar esto</label>
									<input type="text" value="http://" name="nocambiar" />
								</div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

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