<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\auth\models\AuthRole */

$this->title = 'Cập nhật quyền truy cập: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Quyền truy cập', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="card card-body">

    <h5><?= Html::encode($this->title) ?></h5>

    <?= $this->render('_form', compact('model', 'actions')) ?>

</div>