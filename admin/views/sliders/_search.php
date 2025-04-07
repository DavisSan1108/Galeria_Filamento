<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SlidersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sliders-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'sliderID') ?>

    <?= $form->field($model, 'tituloSlider') ?>

    <?= $form->field($model, 'textSlider') ?>

    <?= $form->field($model, 'descripcionSlider') ?>

    <?= $form->field($model, 'urlImagenSlader') ?>

    <?php // echo $form->field($model, 'urlSlader') ?>

    <?php // echo $form->field($model, 'activoSlider')->checkbox() ?>

    <?php // echo $form->field($model, 'estadoSlider')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
