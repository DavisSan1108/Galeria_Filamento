<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Usuarios;
use app\models\UsuariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


use app\components\AccessRule;
/**
 * UsuariosController implements the CRUD actions for Usuarios model.
 */
class UsuariosController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
			 'access' => [
                'class' => AccessControl::className(),
				'ruleConfig' => [
                	'class' => AccessRule::className(),
                ],
                'only' => ['create', 'update', 'delete', 'index'],
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'delete', 'index', 'pass'],
                        'allow' => true,
                        'roles' => [
                               Usuarios::ROLE_ADMIN 
                        ],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className()
            ],
        ];
    }

    /**
     * Lists all Usuarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuariosSearch();
      

		if(isset($_GET['clear'])){
			Yii::$app->session['UsuariosSearch'] = '';
			return $this->redirect(['index']);			
		}else{
			$params = Yii::$app->request->queryParams;

			if(count($params) <= 1){		  
				if(isset(Yii::$app->session['UsuariosSearch'])) {
					$params = Yii::$app->session['UsuariosSearch'];
				}else{
					Yii::$app->session['UsuariosSearch'] = $params;
				}
			}else{	
				if(isset(Yii::$app->request->queryParams['UsuariosSearch'])){
					Yii::$app->session['UsuariosSearch'] = $params;
				}else{
					$params = Yii::$app->session['UsuariosSearch'];
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
     * Displays a single Usuarios model.
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
     * Creates a new Usuarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuarios();

		if($model->load(Yii::$app->request->post())) {
			$post = Yii::$app->request->post();
			$model->intentosValidos = 0;
			$model->AuthKey = '36'.rand(5,99).'s7';
			$model->contrasena = password_hash($post['Usuarios']['contrasena'], PASSWORD_DEFAULT);
			
			if($model->save()){
				return $this->redirect(['create', 'insert' => 'true', 'id' => $model->usuarioID]);
			}
		}
		

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Usuarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()){
			return $this->redirect(['update', 'id' => $model->usuarioID, 'update'=>'true']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
	
	
	 public function actionPass($id)
    {
        $model = $this->findModel($id);

		if($model->load(Yii::$app->request->post())) {
			$post = Yii::$app->request->post();
			$model->contrasena = password_hash($post['Usuarios']['contrasena'], PASSWORD_DEFAULT);
			
			if($model->save()){
				return $this->redirect(['pass', 'id' => $model->usuarioID, 'update'=>'true']);
			}
		}

        return $this->render('pass', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Usuarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
   
				
	public function actionDelete(){
		$idDec = Yii::$app->globals->encrypt_decrypt($_POST['key'], 'decrypt');
		 
        $model = $this->findModel($idDec);
					
		$model->load(Yii::$app->request->post());	        
		$model->estadoUsuario = '0';
		 
        if ($model->save()) {
            return true;
        }else{
			return false;
		}
    }

    /**
     * Finds the Usuarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuarios::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
