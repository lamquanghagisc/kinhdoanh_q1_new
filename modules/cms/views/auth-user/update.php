<?php

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model app\modules\quanly\models\PgVungnuoi */
$this->title = (isset($const['title'])) ? $const['title'] : 'Cập nhật';
$this->params['breadcrumbs'][] = ['label' => 'Tài khoàn người dùng', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="auth-user-update">
    <div class="col-lg-12">
        <div class="block block-themed">
            <div class="block-header">
                <h3 class="block-title text-uppercase">
                    <?= $this->title ?>
                </h3>
            </div>
            <div class="block-content padding-tb-05">
                <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                    </div>

                </div>
                 <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                    </div>
                     <div class="col-lg-3">
                         <?= $form->field($model, 'confirmed')->widget(\kartik\switchinput\SwitchInput::classname(), [
                             'value' => ($model->confirmed == 0) ? false : true,
                             'pluginOptions'=>[
                                 'handleWidth'=>60,
                                 'onText'=>'Kích hoạt',
                                 'offText'=>'không'
                             ]
                         ]);?>
                     </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-lg-8 col-xl-5">
                        <div class="mb-4">
                            <label class="form-label">Quyền truy cập</label>
                            <div class="space-y-2">
                                <?php foreach ($groups as $role) : ?>
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" value="<?= $role['id'] ?>"  name="roles[]" <?= in_array($role['id'], $userGroups) ? 'checked' : '' ?>  >
                                        <label class="form-check-label" > <?= $role['description'] ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div> 
                    </div>
                </div>
                <?php if (!Yii::$app->request->isAjax) { ?>
                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        <a href="<?= Yii::$app->urlManager->createUrl(['cms/auth-user/index']) ?>"
                           class="btn btn-light float-right"><i class="fa fa-arrow-left"></i> Quay lại</a>
                    </div>
                <?php } ?>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>

