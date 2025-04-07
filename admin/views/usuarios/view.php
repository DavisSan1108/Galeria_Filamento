<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = $model->usuarioID;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="usuarios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->usuarioID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->usuarioID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'usuarioID',
            'Tipo_user',
            'nombrecomercialUsuario',
            'razonSocialUsuario',
            'rfcUsuario',
            'tipoPersonaUsuario',
            'telefonoUsuario',
            'emailUsuario:email',
            'usuario',
            'contrasena',
            'codigoRecuperacion',
            'fechaGeneracionCodigoRecuperacion',
            'intentosValidos',
            'AuthKey',
            'activoUsuario:boolean',
            'estadoUsuario:boolean',
        ],
    ]) ?>

</div>
