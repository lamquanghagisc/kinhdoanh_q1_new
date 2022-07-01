<?php

use app\modules\contrib\widgets\DualListboxWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\auth\models\AuthGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-group-form" id="app" v-cloak>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'roleIds')->widget(DualListboxWidget::class, [
        'items' => $roles
    ]) ?>


    <div class="form-group">
        <?= Html::submitButton('Lưu', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>