<?php

class class_correo
{
	public  $empresa_mail = 'contacto@galeriafilamento.com';
	public  $url_empresa  = 'http://galeriafilamento.com';
	public $h_mail = 'mail.galeriafilamento.com';
	public $f_name    = "Filamento Galeria";
	public $add_name    = "Filamento Galeria";
	public $from_name    = "Filamento Galeria";
	
	var $mail_empresa = 'contacto@galeriafilamento.com';
	
		
	public function mail_contacto($nombre, $correo, $mensaje){

		$mail = new PHPMailer();

		$mail->Host = $this->h_mail;
		$mail->From = $this->empresa_mail;
		$mail->FromName = $this->from_name;
		//confirmacion de correo
		$mail->Subject = "Contacto Filamento Galeria";
		$mail->AddAddress($correo, $this->add_name);


		$logo = 'images/logo.png';

		$body_function  = 'Le enviamos un coordial saludo '.$nombre.' y le agradecemos por contactarnos, Si su mensaje lo requiere un asesor se pondra en contacto con usted.
		<br><br>
		Gracias !!
		<br><br>';
		
		$body = $this->gral_correo("Contacto Filamento Galeria", $body_function);
		
		$mail->IsHTML(true);
		$mail->Body = $body;
		$exito = $mail->Send();	
		
		if($exito){
			$mail->ClearAddresses();
			$mensaje_carta="<br>Nombre:  ".$nombre;
			$mensaje_carta.="<br>Asunto:  Contacto Filamento Galeria";	 
			$mensaje_carta.="<br>Correo Electronico:  ".$correo;
			$mensaje_carta.="<br>Mensaje: ".$mensaje;
			//$cabecera="From:".$correo."\n";
			$cabeceras  = 'MIME-Version: 1.0'."\r\n";
			$cabeceras .= 'Content-type: text/html; charset=utf-8'."\r\n";
			$cabecera  .="From:".$correo."\n";

			$seenvio= mail($this->mail_empresa, "Filamento Galeria", $mensaje_carta, $cabecera);
			return true;
		}else{
			return false;
		}
	}
	
	public function mail_rpass($nombre, $pass,  $correo){

		$mail = new PHPMailer();

				
		$mail->Host = $this->h_mail;
		$mail->From = $this->empresa_mail;
		$mail->FromName = $this->from_name;
		//confirmacion de correo
		$mail->Subject = "Recuperacion de datos Filamento Galeria";
		$mail->AddAddress($correo, $this->add_name);


		$logo = 'images/logo.png';

		$body_function  = 'Le enviamos un coordial saludo '.$nombre.', recientemente solicito sus datos de acceso para la tienda en linea.
		<br><br>
		<div style="text-align:left;">
		Correo : '.$correo.'<br>
		Contrase&ntilde;a : '.$pass.'
		</div>
		<br><br><br><br>';
		
		$body = $this->gral_correo("Datos para acceso Filamento Galeria", $body_function);
		
		$mail->IsHTML(true);
		$mail->Body = $body;
		$exito = $mail->Send();	
		
		if($exito){
			return true;
		}else{
			return false;
		}
	}
	
	public function registro_mailuser($correo, $nombre, $usuario, $key){

		$mail = new PHPMailer();

			
		$mail->Host = $this->h_mail;
		$mail->From = $this->empresa_mail;
		$mail->FromName = $this->from_name;
		//confirmacion de correo
		$mail->Subject = "Contacto Filamento Galeria";
		$mail->AddAddress($correo, $this->add_name);
		
		$body = '<html>
				<head>
				<meta charset="utf-8">
				<title>Filamento Galeria</title>
				<style>
					body{
						font-family: Helvetica, " sans-serif"; 
					}
					.btn_registro{
						padding: 10px 40px 10px 40px; 
						border-radius:30px; 
						background: transparent; 
						border:2px solid #000; 
						color: #000; 
						text-decoration: none;
						font-weight: bold;
					}

					.btn_registro:hover, .btn_registro:active{
						padding: 10px 40px 10px 40px; 
						border-radius:30px; 
						background: #000; 
						border:2px solid #000; 
						color: #FFF; 
						text-decoration: none;
						font-weight: bold;
					}
				</style>
				</head>
				<body>
				<div style="text-align: center; width: 100%; height: 65px; padding-top: 10px; padding-bottom: 5px;">
					<img src="'.$this->url_empresa.'img/logo.png" width="100px" alt="Logo" />
				</div>
				<img src="'.$this->url_empresa.'correo/shadow-basica.png" width="100%"  alt="Logo" />
				<br><br>
				<div style="text-align: center;">
					<span style="font-size:22px; color: #2c2d2d;"> '.$titulo.'</span>
					<br><br>	
					Le enviamos un coordial saludo '.$nombre.' y agradecemos su registro, para continuar presione el bot&oacute;n "Finalizar Registro" para validar su correo.
					<br><br>
					<br><br>
					<a href="'.$this->url_empresa.'valida_user.php?key='.md5($key).'&user='.md5($usuario).'" target="_blank" class="btn_registro" rel="noopener noreferrer">Finalizar Registro</a>
					<br><br>
					Gracias !!
					<br><br>
					<br><br><br><br><br>
					<span style="color: #BBBBBB; font-size: 12px;">Mexico &copy; '.date('Y').' Filamento Galeria. Todos los derechos reservados.</span>
				</div>

				<script type="text/javascript">	
						var d = new Date();
						 document.getElementById("date_year").innerHTML = d.getFullYear();
				</script>
				</body>
				</html>';
		
		
		$mail->IsHTML(true);
		$mail->Body = $body;
		$exito = $mail->Send();		
	}

	 function gral_correo($titulo, $contenido){
		
		return '<!doctype html>
				<html>
				<head>
				<meta charset="utf-8">
				<title>Filamento Galeria</title>
				<style>
					body{
						font-family: Helvetica, " sans-serif"; 
					}
					.btn_registro{
						padding: 10px 40px 10px 40px; 
						border-radius:30px; 
						background: transparent; 
						border:2px solid #000; 
						color: #000; 
						text-decoration: none;
						font-weight: bold;
					}

					.btn_registro:hover, .btn_registro:active{
						padding: 10px 40px 10px 40px; 
						border-radius:30px; 
						background: #000; 
						border:2px solid #000; 
						color: #FFF; 
						text-decoration: none;
						font-weight: bold;
					}
				</style>
				</head>
				<body>
				<div style="text-align: center; width: 100%; height: 65px; padding-top: 10px; padding-bottom: 5px;">
					<img src="'.$this->url_empresa.'img/logo.png" width="100px" alt="Logo Filamento Galeria" />
				</div>
				<img src="'.$this->url_empresa.'correo/shadow-basica.png" width="100%"  alt="btn" />
				<br><br>
				<div style="text-align: center;">
					<span style="font-size:22px; color: #2c2d2d;"> '.$titulo.'</span>
					<br><br>	
					'.$contenido.'
					<br><br><br><br><br>
					<span style="color: #BBBBBB; font-size: 12px;">Mexico &copy; 2017 Filamento Galeria. Todos los derechos reservados.</span>
				</div>
				</body>
				</html>';
	}
	
	
}
?>