<!-- filepath: c:\wamp64\www\admin\views\arte\update.php -->
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Editar Obra de Arte';
?>
<div class="arte-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'artista')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anio')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'imagen')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar Cambios', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>