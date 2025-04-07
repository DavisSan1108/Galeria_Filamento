<?php
if(isset($_GET['grafica'])){
	echo '<div class="card">
				<div class="card-body">
					<h4 class="card-title">Graficas de grupo ('.$_GET['grafica'].')</h4>		
					<iframe id="iframeGraff" src="http://nms.aitelecom.net:3002/d/BCuL775tti/graficas-grupo?orgId=2&refresh=5m&from=1569906000000&to=1571421354307&var-ngrupo='.$_GET['grafica'].'&var-hosts=All&var-dhost=All&kiosk=tv" style="width: 100%; border: none; height:5000px;" scrolling="no"></iframe>   				 
				</div>
		 </div>';
}else{
		echo '<div class="card">
				<div class="card-body">
					<h4 class="card-title">Graficas de consumo</h4>		
					<br><br><br>
					<div class="text-center">Grafica No disponible, intente seleccionando un sitio de la lista.</div>
					<br><br><br>
				</div>
			</div>';
}

?>   



