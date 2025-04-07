<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Productos;
use app\models\ProductosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;



/**
 * ProductosController implements the CRUD actions for Productos model.
 */
class ProductosController extends Controller
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
     * Lists all Productos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductosSearch();
      

		if(isset($_GET['clear'])){
			Yii::$app->session['ProductosSearch'] = '';
			return $this->redirect(['index']);			
		}else{
			$params = Yii::$app->request->queryParams;

			if(count($params) <= 1){		  
				if(isset(Yii::$app->session['ProductosSearch'])) {
					$params = Yii::$app->session['ProductosSearch'];
				}else{
					Yii::$app->session['ProductosSearch'] = $params;
				}
			}else{	
				if(isset(Yii::$app->request->queryParams['ProductosSearch'])){
					Yii::$app->session['ProductosSearch'] = $params;
				}else{
					$params = Yii::$app->session['ProductosSearch'];
				}		
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
     * Displays a single Productos model.
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
     * Creates a new Productos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Productos();
		
		if($model->load(Yii::$app->request->post())) {
			$post = Yii::$app->request->post();	
			$model->urlImagenProducto = 'na';
			if($model->save()){
				if(is_uploaded_file($_FILES['file']['tmp_name'])){
					$valida = array('JPG', 'jpg', 'JPGE', 'jpge', 'png', 'PNG');
					//productos/prefijo_ymdhis-id
					$fileUpload = Yii::$app->globals->addFile('productos', 'prod', $model->productoID, $_FILES['file'], $valida);
					
					if($fileUpload != "na"){	
						Yii::$app->db->createCommand("UPDATE productos SET urlImagenProducto ='".$fileUpload."' WHERE productoID ='".$model->productoID."'")->execute(); 
					}					
				}
				
				return $this->redirect(['update', 'insert' => 'true', 'id' => $model->productoID]);
			}				
		}
		

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Productos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
     public function actionUpdate($id)
    {
        $model = $this->findModel($id);
       		
		if($model->load(Yii::$app->request->post())) {
			$post = Yii::$app->request->post();	
			if($model->save()){
				if(is_uploaded_file($_FILES['file']['tmp_name'])){
					$valida = array('JPG', 'jpg', 'JPGE', 'jpge', 'png', 'PNG');
					$fileUpload = Yii::$app->globals->addFile('productos', 'prod', $model->productoID, $_FILES['file'], $valida);
					
					if($fileUpload != "na"){	
						Yii::$app->db->createCommand("UPDATE productos SET urlImagenProducto ='".$fileUpload."' WHERE productoID ='".$model->productoID."'")->execute(); 
					}					
				}
				
				return $this->redirect(['update', 'id' => $model->productoID, 'update'=>'true']);
			}				
		}

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Productos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
   
				
	public function actionDelete(){
		$idDec = Yii::$app->globals->encrypt_decrypt($_POST['key'], 'decrypt');
		 
        $model = $this->findModel($idDec);
					
		$model->load(Yii::$app->request->post());	        
		$model->estadoProducto = '0';
		 
        if ($model->save()) {
            return true;
        }else{
			return false;
		}
    }

    /**
     * Finds the Productos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Productos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Productos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
