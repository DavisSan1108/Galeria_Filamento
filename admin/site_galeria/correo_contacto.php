<?php
/*
require_once('require/funciones_mail.php');
require("correo/class.phpmailer.php");

if(isset($_POST['nombre']) and isset($_POST['correo']) and isset($_POST['mensaje'])){
	$correo = new class_correo;
	$envio = $correo->mail_contacto($_POST['nombre'], $_POST['correo'], $_POST['mensaje']);
	if($envio){
		header('location:contact.php?envio=true');
	}else{
		header('location:contact.php?envio=false');
	}
}else{
	header('location:contact.php?envio=false');
}
*/


if(isset($_POST['nombre']) and isset($_POST['correo']) and isset($_POST['mensaje'])){
    
    $to = 'contacto@galeriafilamento.com';
    $firstname = $_POST["nombre"];
    $email= $_POST["correo"];
    $text= $_POST["mensaje"];
    //$asunto= $_POST["subject"];
    


    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= "From: " . $email . "\r\n"; // Sender's E-mail
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $message = '<table style="width:100%">
        <tr>
            <td><strong>Nombre:</strong> '.utf8_decode($firstname).' </td>
        </tr>
        <tr><td><strong>Email:</strong> '.$email.'</td></tr>
        <tr><td><strong>Asunto:</strong> Contacto de sitio web</td></tr>
        <tr><td><strong>Text:</strong> '.utf8_decode($text).'</td></tr>
        
    </table><br />
    Este es un mensaje creado desde el sitio web <k>galeriafilamento.com<k>';
    
    if (@mail($to, $email, $message, $headers))
    {
        header('location:contact.php?envio=true');
    }else{
        header('location:contact.php?envio=false');
    }
}else{
	header('location:contact.php?envio=false');
}
?>