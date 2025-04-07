<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Imagenes;
use app\models\ImagenesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;



/**
 * ImagenesController implements the CRUD actions for Imagenes model.
 */
class ImagenesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
			 'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'delete', 'index'],
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'delete', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className()
            ],
        ];
    }

    /**
     * Lists all Imagenes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImagenesSearch();
      

		if(isset($_GET['clear'])){
			Yii::$app->session['ImagenesSearch'] = '';
			return $this->redirect(['index&id='.$_GET['id']]);			
		}else{
			$params = Yii::$app->request->queryParams;

			if(count($params) <= 1){		  
				if(isset(Yii::$app->session['ImagenesSearch'])) {
					$params = Yii::$app->session['ImagenesSearch'];
				}else{
					Yii::$app->session['ImagenesSearch'] = $params;
				}
			}else{	
				if(isset(Yii::$app->request->queryParams['ImagenesSearch'])){
					Yii::$app->session['ImagenesSearch'] = $params;
				}else{
					$params = Yii::$app->session['ImagenesSearch'];
				}		
			}
		}
		
		if(isset($_POST['nombredocto'])){
			if(is_uploaded_file($_FILES['file']['tmp_name'])){
				$valida = array('PNG', 'png', 'jpg', 'JPG', 'jpge', 'JPGE', 'PDF'=>'PDF', 'pdf'=>'pdf');
				$fileUpload = Yii::$app->globals->addFile('productos', 'img', $_GET['id'], $_FILES['file'], $valida);
					
				if($fileUpload != "na"){	
					Yii::$app->db->createCommand("INSERT INTO imagenesproductos(productoID, nombreImagen, urlImagen, activoImagen, estadoImagen) VALUES ('".$_GET['id']."',  '".$_POST['nombredocto']."', '".$fileUpload."', 1, 1)")->query();	
					return $this->redirect(['index&id='.$_GET['id'].'&upload=true']);
				}else{
					return $this->redirect(['index&id='.$_GET['id'].'&format=false']);	
				}	
			}else{
				return $this->redirect(['index&id='.$_GET['id'].'&upload=false']);
			}
		}
		
		$dataProvider = $searchModel->search($params);
		$dataProvider->pagination->pageSize = Yii::$app->params['npag'];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Imagenes model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Imagenes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Imagenes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['create', 'insert' => 'true', 'id' => $model->imagenproductoID]);
        }
		

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Imagenes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()){
			return $this->redirect(['update', 'id' => $model->imagenproductoID, 'update'=>'true']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Imagenes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
   
				
	public function actionDelete(){
		$idDec = Yii::$app->globals->encrypt_decrypt($_POST['key'], 'decrypt');
		 
        $model = $this->findModel($idDec);
					
		$model->load(Yii::$app->request->post());	        
		$model->estadoImagen = '0';
		 
        if ($model->save()) {
            return true;
        }else{
			return false;
		}
    }

    /**
     * Finds the Imagenes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Imagenes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Imagenes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
