<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ImagenesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="imagenes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'imagenproductoID') ?>

    <?= $form->field($model, 'productoID') ?>

    <?= $form->field($model, 'nombreImagen') ?>

    <?= $form->field($model, 'urlImagen') ?>

    <?= $form->field($model, 'activoImagen')->checkbox() ?>

    <?php // echo $form->field($model, 'estadoImagen')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
