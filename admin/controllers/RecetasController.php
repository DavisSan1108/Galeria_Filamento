<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Recetas;
use app\models\RecetasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;



/**
 * RecetasController implements the CRUD actions for Recetas model.
 */
class RecetasController extends Controller
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
     * Lists all Recetas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RecetasSearch();
      

		if(isset($_GET['clear'])){
			Yii::$app->session['RecetasSearch'] = '';
			return $this->redirect(['index']);			
		}else{
			$params = Yii::$app->request->queryParams;

			if(count($params) <= 1){		  
				if(isset(Yii::$app->session['RecetasSearch'])) {
					$params = Yii::$app->session['RecetasSearch'];
				}else{
					Yii::$app->session['RecetasSearch'] = $params;
				}
			}else{	
				if(isset(Yii::$app->request->queryParams['RecetasSearch'])){
					Yii::$app->session['RecetasSearch'] = $params;
				}else{
					$params = Yii::$app->session['RecetasSearch'];
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
     * Displays a single Recetas model.
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
     * Creates a new Recetas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Recetas();

       		
		if($model->load(Yii::$app->request->post())) {
			$post = Yii::$app->request->post();	
			$model->imagenReceta = 'na';
			if($model->save()){
				if(is_uploaded_file($_FILES['file']['tmp_name'])){
					$valida = array('JPG', 'jpg', 'JPGE', 'jpge', 'png', 'PNG');
					$fileUpload = Yii::$app->globals->addFile('recetas', 'recetas', $model->recetaID, $_FILES['file'], $valida);
					
					if($fileUpload != "na"){	
						Yii::$app->db->createCommand("UPDATE recetas SET imagenReceta ='".$fileUpload."' WHERE recetaID ='".$model->recetaID."'")->execute(); 
					}					
				}
				
				return $this->redirect(['create', 'insert' => 'true', 'id' => $model->recetaID]);
			}				
		}
		

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Recetas model.
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
					$fileUpload = Yii::$app->globals->addFile('recetas', 'receta', $model->recetaID, $_FILES['file'], $valida);
					
					if($fileUpload != "na"){	
						Yii::$app->db->createCommand("UPDATE recetas SET imagenReceta ='".$fileUpload."' WHERE recetaID ='".$model->recetaID."'")->execute(); 
					}					
				}
				
				return $this->redirect(['update', 'id' => $model->recetaID, 'update'=>'true']);
			}				
		}

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Recetas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
   
				
	public function actionDelete(){
		$idDec = Yii::$app->globals->encrypt_decrypt($_POST['key'], 'decrypt');
		 
        $model = $this->findModel($idDec);
					
		$model->load(Yii::$app->request->post());	        
		$model->estadoReceta = '0';
		 
        if ($model->save()) {
            return true;
        }else{
			return false;
		}
    }

    /**
     * Finds the Recetas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Recetas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Recetas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
