<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'productoID') ?>

    <?= $form->field($model, 'categoriaID') ?>

    <?= $form->field($model, 'nombreProducto') ?>

    <?= $form->field($model, 'descripcionProducto') ?>

    <?= $form->field($model, 'precioProducto') ?>

    <?php // echo $form->field($model, 'urlImagenProducto') ?>

    <?php // echo $form->field($model, 'activoProducto')->checkbox() ?>

    <?php // echo $form->field($model, 'estadoProducto')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
