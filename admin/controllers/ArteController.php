<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\Arte;

class ArteController extends Controller
{
    public function actionIndex()
    {
        $model = new Arte();

        if ($model->load(Yii::$app->request->post())) {
            $model->imagen = UploadedFile::getInstance($model, 'imagen');
            if ($model->save()) {
                if ($model->imagen) {
                    $model->imagen->saveAs('uploads/' . $model->imagen->baseName . '.' . $model->imagen->extension);
                }
                Yii::$app->session->setFlash('success', 'Obra de arte registrada con éxito.');
                return $this->refresh();
            }
        }
        // Recuperar todas las obras de arte desde la base de datos
        $artes = Arte::find()->all();

        return $this->render('index', [
            'model' => $model,
            'artes' => $artes, // Pasar las obras a la vista
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Arte::findOne($id);

        if (!$model) {
            throw new \yii\web\NotFoundHttpException('La obra de arte no existe.');
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->imagen = UploadedFile::getInstance($model, 'imagen');
            if ($model->save()) {
                if ($model->imagen) {
                    $model->imagen->saveAs('uploads/' . $model->imagen->baseName . '.' . $model->imagen->extension);
                }
                Yii::$app->session->setFlash('success', 'Obra de arte actualizada con éxito.');
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = Arte::findOne($id);

        if (!$model) {
            throw new \yii\web\NotFoundHttpException('La obra de arte no existe.');
        }

        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Obra de arte eliminada con éxito.');
        } else {
            Yii::$app->session->setFlash('error', 'No se pudo eliminar la obra de arte.');
        }

        return $this->redirect(['index']);
    }
}