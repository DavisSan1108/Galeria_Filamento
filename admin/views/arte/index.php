<!-- filepath: c:\wamp64\www\admin\views\arte\index.php -->
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Registrar Obra de Arte';
?>
<div class="arte-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'artista')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anio')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'imagen')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Registrar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<hr>

<div class="arte-list">
    <h2>Obras de Arte Registradas</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Artista</th>
                <th>Año</th>
                <th>Descripción</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($artes as $index => $arte): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= Html::encode($arte->titulo) ?></td>
                    <td><?= Html::encode($arte->artista) ?></td>
                    <td><?= Html::encode($arte->anio) ?></td>
                    <td><?= Html::encode($arte->descripcion) ?></td>
                    <td>
                        <?php if ($arte->imagen): ?>
                            <img src="<?= Yii::getAlias('@web/uploads/' . $arte->imagen) ?>" alt="<?= Html::encode($arte->titulo) ?>" style="max-height: 100px;">
                        <?php else: ?>
                            No disponible
                        <?php endif; ?>
                    </td>
                    <td>
                        <!-- Botón para editar -->
                        <?= Html::a('Editar', ['arte/update', 'id' => $arte->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        
                        <!-- Botón para eliminar -->
                        <?= Html::a('Eliminar', ['arte/delete', 'id' => $arte->id], [
                            'class' => 'btn btn-danger btn-sm',
                            'data' => [
                                'confirm' => '¿Estás seguro de que deseas eliminar esta obra?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>