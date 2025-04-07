<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DisenadorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="disenador-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'disenadorID') ?>

    <?= $form->field($model, 'nombreDisenador') ?>

    <?= $form->field($model, 'activoDisenador')->checkbox() ?>

    <?= $form->field($model, 'estadoDisenador')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
