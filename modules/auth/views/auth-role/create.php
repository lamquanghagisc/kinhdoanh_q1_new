<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\auth\models\AuthRole */

$this->title = 'Thêm mới quyền truy cập';
$this->params['breadcrumbs'][] = ['label' => 'Quyền truy cập', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-body">

    <h5><?= Html::encode($this->title) ?></h5>

    <?= $this->render('_form', compact('model', 'actions')) ?>

</div>