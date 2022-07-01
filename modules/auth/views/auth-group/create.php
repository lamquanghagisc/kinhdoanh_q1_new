<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\auth\models\AuthGroup */

$this->title = 'Thêm mới nhóm quyền';
$this->params['breadcrumbs'][] = ['label' => 'Nhóm quyền', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-body">

    <h5><?= Html::encode($this->title) ?></h5>

    <?= $this->render('_form', compact('model', 'roles')) ?>

</div>