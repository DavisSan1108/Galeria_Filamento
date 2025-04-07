<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Nosotros;
use app\models\NosotrosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;



/**
 * NosotrosController implements the CRUD actions for Nosotros model.
 */
class NosotrosController extends Controller
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
						//'create', 'delete', 'index' 
                        'actions' => ['update'],
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
     * Lists all Nosotros models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NosotrosSearch();
      

		if(isset($_GET['clear'])){
			Yii::$app->session['NosotrosSearch'] = '';
			return $this->redirect(['index']);			
		}else{
			$params = Yii::$app->request->queryParams;

			if(count($params) <= 1){		  
				if(isset(Yii::$app->session['NosotrosSearch'])) {
					$params = Yii::$app->session['NosotrosSearch'];
				}else{
					Yii::$app->session['NosotrosSearch'] = $params;
				}
			}else{	
				if(isset(Yii::$app->request->queryParams['NosotrosSearch'])){
					Yii::$app->session['NosotrosSearch'] = $params;
				}else{
					$params = Yii::$app->session['NosotrosSearch'];
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
     * Displays a single Nosotros model.
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
     * Creates a new Nosotros model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Nosotros();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['create', 'insert' => 'true', 'id' => $model->nosotrosID]);
        }
		

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Nosotros model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()){
			return $this->redirect(['update', 'id' => $model->nosotrosID, 'update'=>'true']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Nosotros model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
   
				
	public function actionDelete(){
		$idDec = Yii::$app->globals->encrypt_decrypt($_POST['key'], 'decrypt');
		 
        $model = $this->findModel($idDec);
					
		$model->load(Yii::$app->request->post());	        
		$model->estadoNosotros = '0';
		 
        if ($model->save()) {
            return true;
        }else{
			return false;
		}
    }

    /**
     * Finds the Nosotros model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Nosotros the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Nosotros::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
