<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Sliders;
use app\models\SlidersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;



/**
 * SlidersController implements the CRUD actions for Sliders model.
 */
class SlidersController extends Controller
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
     * Lists all Sliders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SlidersSearch();
      

		if(isset($_GET['clear'])){
			Yii::$app->session['SlidersSearch'] = '';
			return $this->redirect(['index']);			
		}else{
			$params = Yii::$app->request->queryParams;

			if(count($params) <= 1){		  
				if(isset(Yii::$app->session['SlidersSearch'])) {
					$params = Yii::$app->session['SlidersSearch'];
				}else{
					Yii::$app->session['SlidersSearch'] = $params;
				}
			}else{	
				if(isset(Yii::$app->request->queryParams['SlidersSearch'])){
					Yii::$app->session['SlidersSearch'] = $params;
				}else{
					$params = Yii::$app->session['SlidersSearch'];
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
     * Displays a single Sliders model.
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
     * Creates a new Sliders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sliders();
        
		if($model->load(Yii::$app->request->post())) {
			$post = Yii::$app->request->post();	
			$model->urlImagenSlader = 'na';
			if($model->save()){
				if(is_uploaded_file($_FILES['file']['tmp_name'])){
					$valida = array('JPG', 'jpg', 'JPGE', 'jpge', 'png', 'PNG');
					$fileUpload = Yii::$app->globals->addFile('sliders', 'slide', $model->sliderID, $_FILES['file'], $valida);
					
					if($fileUpload != "na"){	
						Yii::$app->db->createCommand("UPDATE sliders SET urlImagenSlader='".$fileUpload."' WHERE sliderID ='".$model->sliderID."'")->execute(); 
					}					
				}
				
				return $this->redirect(['create', 'insert' => 'true', 'id' => $model->sliderID]);
			}				
		}
		

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Sliders model.
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
					$valida = array('JPG', 'jpg', 'JPEG', 'jpeg', 'png', 'PNG');
					$fileUpload = Yii::$app->globals->addFile('sliders', 'slide', $model->sliderID, $_FILES['file'], $valida);
					
					if($fileUpload != "na"){	
						Yii::$app->db->createCommand("UPDATE sliders SET urlImagenSlader='".$fileUpload."' WHERE sliderID ='".$model->sliderID."'")->execute(); 
					}
					
				}
				
				return $this->redirect(['update', 'id' => $model->sliderID, 'update'=>'true']);
			}				
		}

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Sliders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
   
				
	public function actionDelete(){
		$idDec = Yii::$app->globals->encrypt_decrypt($_POST['key'], 'decrypt');
		 
        $model = $this->findModel($idDec);
					
		$model->load(Yii::$app->request->post());	        
		$model->estadoSlider = '0';
		 
        if ($model->save()) {
            return true;
        }else{
			return false;
		}
    }

    /**
     * Finds the Sliders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sliders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sliders::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
