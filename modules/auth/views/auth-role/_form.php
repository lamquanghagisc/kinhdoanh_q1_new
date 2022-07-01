<?php

use app\modules\contrib\gxassets\GxVueDualListboxAsset;
use app\modules\contrib\widgets\DualListboxWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\auth\models\AuthRole */
/* @var $form yii\widgets\ActiveForm */

GxVueDualListboxAsset::register($this);
?>

<div class="auth-role-form" id="app">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desciption')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'actionIds')->widget(DualListboxWidget::class, [
        'items' => $actions
    ]) ?>


    <div class="form-group">
        <?= Html::submitButton('Lưu', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>