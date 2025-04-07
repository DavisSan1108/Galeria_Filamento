<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use Dompdf\Dompdf;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'index', 'pdf'],
                'rules' => [
                    [
                        'actions' => ['logout', 'index', 'grupo', 'pdf'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
	
	
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
	
	public function actionPdf(){
		//echo "hola";
		
		//Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
  		//Yii::$app->response->headers->add('Content-Type', 'application/pdf');
		//Yii::$app->response->headers->add('"Content-Disposition: inline; filename=documento.pdf');
		$dompdf = new Dompdf(); 
		$css='<style>
		html {
			margin: 0px;
		}
		.tabla{
			width: 100%;
			border: solid 0px;
			background-image: url("require/img/banner_cotizacion.jpg");
			background-repeat: no-repeat;
			height: 170px;
		}
		.encabezado{
			padding: 10px 30px;
		}
		.titulo{
			padding-top: 70px;
		}
		.tablaFooter{
			width: 100%;
			height: 170px;
			border: solid 0px;
			background-image: url("require/img/banner_footer_cotizacion.jpg");
			background-position: right; /* Center the image */
			background-repeat: no-repeat; /* Do not repeat the image */
			background-size: cover;
			position:fixed;
			bottom:0;
		}
		.margenCuerpo{
			padding-left: 50px
			font-family: "Times New Roman", Times, serif;
			font-size: 16px;
		}
		.tituloProducto{
			color:orange;
			font-weight: bold;
		}
		.imagenProducto{
			padding-right: 65px;
		}
		.precioProducto{
			line-height: 25px;
			padding-right: 25px;
		}
		</style>';
		$html= $css.'
		<table class="tabla">
			<tr>
			<td class="encabezado titulo" align="center">
				<strong>COTIZACIÓN</strong>
			</td>
			</tr>
			<tr>
			<td class="encabezado" align="right">
				Mérida Yucatán a 07 de Septiembre de 2021
			</td>
			</tr>
			<tr>
				<td class="margenCuerpo">
					<strong>PRESENTE:</strong>
					<br />
					<br />
					<span style="font-family: Calibri">Ponemos a su disposición nuestra cotización de:</span>
				</td>
			</tr>
			<tr>
				<td class="margenCuerpo">
					<br />
					<span class="tituloProducto">NEBULIZADOR PORTATIL</span>

				</td>
			</tr>
			<tr>
				<td class="margenCuerpo">
					El nebulizador eléctrico portátil se puede usar con agua o productos a base de petróleo. 
					<br />
					<div style="padding-left:35px; line-height:25px;">
						•	Cuenta con tres boquillas de precisión que ofrecen tamaños de partículas de 5 a 50 micras. 
						<br />
						•	La válvula dosificadora ajustable se puede configurar para liberar hasta 5 galones por hora de salida.
						<br />
						•	Tiene un tanque transparente de un galón con tapón de drenaje para facilitar la limpieza. 
						<br />
						•	Funciona con corriente alterna de 110 voltios, 6.85 amperios, 20,000 rpm. 
						<br />
					</div>
				</td>
			</tr>
			</tr>
			<tr>
				<td class="margenCuerpo">
					<table width="100%">
						<tr>
							<td>
								<div style="padding-left:35px; padding-top:5px; line-height:22px;">
									Flujo ajustable: 0-17 litros / hora
									<br />
									Tamaño de partícula: 5.50 micras (VMD)
									<br />
									Capacidad del tanque: 3.8 litros
									<br />
									Longitud: 30,48 cm
									<br />
									Ancho: 30,48 cm
									<br />
									Altura: 35,6 cm
									<br />
									Peso (vacío): 3 kg
								</div>
							</td>
							<td align="right" class="imagenProducto">
								<img src="require/img/nebulizador.jpg" style="border: solid 0px;" />
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>

		<table width="100%" border="0">
			<tr>
				<td align="right">
					<strong>Cantidad:</strong> 
				</td>
				<td width="90" align="left" class="precioProducto">
					1 unidad
				</td>
			</tr>
			<tr>
				<td align="right">
					<strong>Precio:</strong> 
				</td>
				<td align="left" class="precioProducto">
					$15,560.00 mxn
				</td>
			</tr>
			<tr>
				<td align="right">
					<strong>Total I.V.A. Incluido:</strong> 
				</td>
				<td align="left" class="precioProducto">
					$18,044.96 mxn
				</td>
			</tr>
		</table>


		<table width="100%" border="0">
			<tr>
				<td class="margenCuerpo">
					<strong>Observaciones: </strong>
					<br />
					<div style="padding-left:35px; padding-top:5px; line-height:22px;">
						* Promoción vigente del 6 al 9 de septiembre de 2021
						<br />
						 Estos precios sólo aplican para compras en nuestra tienda en línea <a href="http://ecotecsureste.com/" target="_blank">http://ecotecsureste.com</a>
						<br />
						 Consulta artículos participantes en nuestras tiendas.
					</div>
				</td>
			</tr>
		</table>


		<table width="100%" border="0">
			<tr>
				<td class="margenCuerpo">
					<br />
					<strong style="color:blue;">CONDICIONES COMERCIALES: </strong>
					<br />
					<div style="padding-top:5px; line-height:22px;">
						Precios expresados en Moneda Nacional
						<br />
						 Tiempo de entrega: Equipos disponibles para entrega inmediata, más tiempo de envío de 7 a 10 días.
						<br />
						 Precio LAB MÉRIDA
						<br />
						Forma de pago: 100% anticipo
					</div>
				</td>
			</tr>
		</table>

		<table class="tablaFooter">
			<tr>
			<td align="center" style="color:#C1C1C1;">
				<div style="position:fixed; bottom:25px; font-size:14px;">
				Desde <a href="http://ecotecsureste.com/" target="_blank">ecotecsureste.com</a><strong></strong>
				</div>
			</td>
			</tr>
		</table>';
		$dompdf->loadHtml($html);
		$dompdf->setPaper('L', 'Letter');
		//$pdf = new PDF_HTML('L', 'mm', 'Letter');
		$dompdf->render();
		//$dompdf->set_option('defaultFont', 'Arial');
		//$dompdf->stream("mi_archivo.pdf");
		$dompdf->stream("",array("Attachment" => false));
		exit(0);
	}

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
	
	
	//grafica por grupos 
	public function actionGrupo(){
        return $this->render('grupo');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
		$this->layout = '/login';
				
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {			
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
	
	public function actionExit()
    {
		Yii::$app->user->logout();
      	return $this->render('site/login');
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
