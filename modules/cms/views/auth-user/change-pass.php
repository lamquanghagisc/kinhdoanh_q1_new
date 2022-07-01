<?php

/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 8/29/2018
 * Time: 9:32 AM
 */
use kartik\form\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

$this->title = (isset($const['title'])) ? $const['title'] : 'Thay đổi mật khẩu';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin() ?>

<?php $successpass = Yii::$app->session->getFlash('updatedpass') ?>
<?php if (isset($successpass)): ?>
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <div class="flex-00-auto">
            <i class="fa fa-fw fa-check"></i>
        </div>
        <div class="flex-fill ml-3">
            <p class="mb-0">Cập nhật mật khẩu thành công!</p>
        </div>
    </div>
<?php endif; ?>
<?php $error = Yii::$app->session->getFlash('error_password') ?>
<?php if (isset($error)): ?>
    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <div class="flex-00-auto">
            <i class="fa fa-fw fa-warning"></i>
        </div>
        <div class="flex-fill ml-3">
            <p class="mb-0">Mật khẩu cũ không đúng!</p>
        </div>
    </div>
<?php endif; ?>

<div class="block block-themed ">
    <div class="block-header block-header-default">

        <h3 class="block-title text-uppercase">
            <i class="fa fa-info-circle"></i> Thay đổi mật khẩu
        </h3>

    </div>
    <div class="block-content block-content-full bg-image text-center" style="background-image: url('assets/media/photos/photo15.jpg');">
        <img class="img-avatar img-avatar-thumb" src="<?= Yii::$app->homeUrl ?>resources/images/user.png" alt="">
    </div>
    <div class="block-content block-content-full block-content-sm bg-body-light">
        <div class="font-w600 text-center"><?= $model['tai-khoan']->username ?></div>
        <div class="font-size-sm text-muted text-center"><?= $model['tai-khoan']->fullname ?></div>
    </div>
    <div class="block-content block-content-full">
        <?= $form->field($model['doimatkhau'], 'password')->input('password')->label('Mật khẩu cũ') ?>
        <?= $form->field($model['doimatkhau'], 'newpassword')->input('password')->label('Mật khẩu mới') ?>
        <?= $form->field($model['doimatkhau'], 'confirm')->input('password')->label('Nhập lại mật khẩu mới') ?>
        <?=
        $form->field($model['doimatkhau'], 'verifyCode')->widget(Captcha::classname(), [
            'template' => '<div class="row"> <div class="col-lg-6 ">{image} <a href="javascript:;" id="fox"><i class="fa fa-retweet"></i></a>{input}</div></div>',
        ])->label(false);
        ?> 
        <div class=" text-center">
            <?= Html::submitButton('Đổi mật khẩu', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
</div>




<?php ActiveForm::end() ?>
<script>
    $("#fox").on('click', function (e) {
        //#testimonials-captcha-image is my captcha image id
        $("img[id$='-verifycode-image']").trigger('click');
        e.preventDefault();
    });

</script>
