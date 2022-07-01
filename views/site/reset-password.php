<?php

use app\assets\AppAsset;
use app\modules\contrib\gxassets\GxLaddaAsset;
use kartik\form\ActiveForm;

GxLaddaAsset::register($this);
AppAsset::register($this);
?>
<div class="row g-0 bg-primary-op" id="reset-password-page">
    <div class="hero-static col-md-6 d-flex align-items-center bg-body-light">
        <div class="p-3 w-100">
            <div class="mb-3 text-center">
                <a href="<?= Yii::$app->homeUrl ?>">
                    <img src="<?= Yii::$app->homeUrl ?>resources/images/logo.png" style="max-width: 120px">
                </a>
                <p class="text-uppercase fw-bold fs-sm text-muted">RESET PASSWORD</p>
            </div>
            <div class="row g-0 justify-content-center">
                <div class="col-sm-8 col-xl-6">
                    <?php
                    $form = ActiveForm::begin([
                                'id' => 'reset-password-form',
                    ]);
                    ?>
                    <div class="py-3">
                        <div class="mb-4">
                            <h6 class="text-muted">Enter and confirm your new password</h6>
                        </div>
                        <div class="mb-4">
                            <input type="password" name="AuthUser[password]" class="form-control px-1" placeholder="Password">
                        </div>
                        <div class="mb-4">
                            <input type="password" name="AuthUser[cpassword]" class="form-control px-1" placeholder="Confirm Password">

                        </div>
                    </div>
                    <div class="mb-4">
                        <input type="hidden" name="token" value="<?= $token ?>">
                        <input type="hidden" name="auth" value="<?= $auth ?>">
                        <button type="submit" class="btn w-100 btn-lg btn-hero btn-primary"id="btn-reset-password" @click="resetPassword"><i class="icon-spinner11 mr-2"></i> Submit</button>

                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-static col-md-6 d-none d-md-flex align-items-md-center justify-content-md-center text-md-center">
        <div class="p-3">
            <p class="display-4 fw-bold text-white mb-3">
                Ứng dụng GIS cấp Quận/Huyện
            </p>
            <p class="fs-lg fw-semibold text-white-75 mb-0">
                Copyright © <span data-toggle="year-copy" class="js-year-copy-enabled">2021 HCMGIS</span>
            </p>
        </div>
    </div>

</div>




<script>
    $(function(){
    var vm = new Vue({
    el: '#reset-password-form',
            data: {},
            methods: {
            resetPassword: function(e) {
            e.preventDefault();
            var api = '<?= Yii::$app->homeUrl . 'site/set-new-password' ?>',
                    data = $('#reset-password-form').serialize(),
                    ladda = Ladda.create($('#btn-reset-password')[0]);
            ladda.start();
            sendAjax(api, data, (resp) => {
            if (resp.status) {
            window.location.assign('<?= Yii::$app->homeUrl . 'site/login' ?>');
            } else {
            toastMessage('error', resp.message);
            }
            ladda.stop();
            }, 'POST');
            }
            }
    })

            $('#reset-password-form').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
    e.preventDefault();
    return false;
    }
    });
    })
</script>