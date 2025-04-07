<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RecetasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recetas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'recetaID') ?>

    <?= $form->field($model, 'imagenReceta') ?>

    <?= $form->field($model, 'tituloReceta') ?>

    <?= $form->field($model, 'descripcionReceta') ?>

    <?= $form->field($model, 'activoReceta')->checkbox() ?>

    <?php // echo $form->field($model, 'estadoReceta')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
