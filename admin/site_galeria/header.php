<?php
$index = "";
$msp1 = "";
$msp2 = "";
$msp3 = "";
$msp4 = "";
$msp5 = "";

if($menu == "index"){
	$index = 'class="active"';
}elseif($menu == "shop"){
	if(isset($_GET['cat'])){
		if($_GET['cat'] == "wl"){
			$msp1 = 'class="active"';
		}
		
		
		if($_GET['cat'] == "cp"){
			$msp2 = 'class="active"';
		}
		
		if($_GET['cat'] == "tl" or $_GET['cat'] == "fl" or $_GET['cat'] == "0l"){
			$msp3 = 'class="active"';
		}
		
		if($_GET['cat'] == "di" or $_GET['cat'] == "sdi"){
			$msp4 = 'class="active"';
		}
		
		if($_GET['cat'] == "mc"){
			$msp5 = 'class="active"';
		}
	}
}else{
	
}
?>
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>The Largest Variety Of Decorative Lamps For Your Home.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header" id="navmenu">
        <div class="header__top" id="redMenu">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>The Largest Variety Of Decorative Lamps For Your Home.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
								<a href="contact.php">Contact us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" >
            <div class="row ">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="index.php"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <nav class="header__menu mobile-menu">
                        <ul>
							<li <?php echo $index; ?>><a href="index.php">Home</a></li>
                            <li <?php echo $msp1; ?>><a href="shop.php?cat=wl">Wall Lights</a></li>
                            <li <?php echo $msp2; ?>><a href="shop.php?cat=cp">Chandeliers & Pendats</a></li>
                            <li <?php echo $msp3; ?>><a href="#">Lamps</a>
                                <ul class="dropdown">
                                    <li><a href="shop.php?cat=tl">Table Lamps</a></li>
                                    <li><a href="shop.php?cat=fl">Floor Lamps</a></li>
                                    <li><a href="shop.php?cat=ol">Other Lighting</a></li>
                                </ul>
                            </li>
							 <li <?php echo $msp4; ?>><a href="#">Items</a>
                                <ul class="dropdown">
                                    <li><a href="shop.php?cat=di">Decorative Items</a></li>
                                    <li><a href="shop.php?cat=sdi">Sold Items</a></li>
                                </ul>
                            </li>
                            <!-- <li <?php echo $msp5; ?>><a href="shop.php?cat=mc">My Collections</a></li> -->
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->

<script>
document.addEventListener("DOMContentLoaded", function(){
  window.addEventListener('scroll', function() {
      if (window.scrollY > 50) {
        document.getElementById('navmenu').classList.add('fixed-top');
		  $(".header__top").hide();
      } else {
        document.getElementById('navmenu').classList.remove('fixed-top');
		 $(".header__top").show();
         // remove padding top from body
        document.body.style.paddingTop = '0';
      } 
  });
});

</script>
