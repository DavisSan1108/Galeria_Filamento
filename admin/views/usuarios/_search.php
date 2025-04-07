<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsuariosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'usuarioID') ?>

    <?= $form->field($model, 'Tipo_user') ?>

    <?= $form->field($model, 'nombrecomercialUsuario') ?>

    <?= $form->field($model, 'razonSocialUsuario') ?>

    <?= $form->field($model, 'rfcUsuario') ?>

    <?php // echo $form->field($model, 'tipoPersonaUsuario') ?>

    <?php // echo $form->field($model, 'telefonoUsuario') ?>

    <?php // echo $form->field($model, 'emailUsuario') ?>

    <?php // echo $form->field($model, 'usuario') ?>

    <?php // echo $form->field($model, 'contrasena') ?>

    <?php // echo $form->field($model, 'codigoRecuperacion') ?>

    <?php // echo $form->field($model, 'fechaGeneracionCodigoRecuperacion') ?>

    <?php // echo $form->field($model, 'intentosValidos') ?>

    <?php // echo $form->field($model, 'AuthKey') ?>

    <?php // echo $form->field($model, 'activoUsuario')->checkbox() ?>

    <?php // echo $form->field($model, 'estadoUsuario')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
