<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Disenador;
use app\models\DisenadorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;



/**
 * DisenadorController implements the CRUD actions for Disenador model.
 */
class DisenadorController extends Controller
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
     * Lists all Disenador models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DisenadorSearch();
      

		if(isset($_GET['clear'])){
			Yii::$app->session['DisenadorSearch'] = '';
			return $this->redirect(['index']);			
		}else{
			$params = Yii::$app->request->queryParams;

			if(count($params) <= 1){		  
				if(isset(Yii::$app->session['DisenadorSearch'])) {
					$params = Yii::$app->session['DisenadorSearch'];
				}else{
					Yii::$app->session['DisenadorSearch'] = $params;
				}
			}else{	
				if(isset(Yii::$app->request->queryParams['DisenadorSearch'])){
					Yii::$app->session['DisenadorSearch'] = $params;
				}else{
					$params = Yii::$app->session['DisenadorSearch'];
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
     * Displays a single Disenador model.
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
     * Creates a new Disenador model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Disenador();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['create', 'insert' => 'true', 'id' => $model->disenadorID]);
        }
		

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Disenador model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()){
			return $this->redirect(['update', 'id' => $model->disenadorID, 'update'=>'true']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Disenador model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
   
				
	public function actionDelete(){
		$idDec = Yii::$app->globals->encrypt_decrypt($_POST['key'], 'decrypt');
		 
        $model = $this->findModel($idDec);
					
		$model->load(Yii::$app->request->post());	        
		$model->estadoDisenador = '0';
		 
        if ($model->save()) {
            return true;
        }else{
			return false;
		}
    }

    /**
     * Finds the Disenador model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Disenador the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Disenador::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
