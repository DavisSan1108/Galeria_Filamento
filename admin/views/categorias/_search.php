<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CategoriasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categorias-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'categoriaID') ?>

    <?= $form->field($model, 'nombreCategoria') ?>

    <?= $form->field($model, 'abreviatura') ?>

    <?= $form->field($model, 'descripcionCategoria') ?>

    <?= $form->field($model, 'activoCategoria')->checkbox() ?>

    <?php // echo $form->field($model, 'estadoCategoria')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
