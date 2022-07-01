<?php

use app\assets\AppAsset;
use app\modules\contrib\gxassets\GxLaddaAsset;
use kartik\form\ActiveForm;

GxLaddaAsset::register($this);
AppAsset::register($this);
?>
<div class="row g-0 bg-primary-op" id="forgot-password-page">
    <div class="hero-static col-md-6 d-flex align-items-center bg-body-light">
        <div class="p-3 w-100">
            <div class="mb-3 text-center">
                <a href="<?= Yii::$app->homeUrl ?>">
                    <img src="<?= Yii::$app->homeUrl ?>resources/images/logo.png" style="max-width: 120px">
                </a>
                <p class="text-uppercase fw-bold fs-sm text-muted">FORGOT PASSWORD</p>
            </div>
            <div class="row g-0 justify-content-center">
                <div class="col-sm-8 col-xl-6">
                    <?php
                    $form = ActiveForm::begin([
                                'id' => 'forgot-password-form',
                    ]);
                    ?>
                    <div class="py-3">
                        <div class="mb-4">
                            <h6 class="text-muted">Please enter the email you have registered with the system. We will send instructions to reset your password to your email</h6>
                        </div>
                        <div class="mb-4">
                            <input type="email" name="email" class="form-control px-1" placeholder="Email">                        </div>
                    </div>
                    <div class="mb-4">
                        <button type="submit" class="btn w-100 btn-lg btn-hero btn-primary"id="btn-forgot-password" @click="confirmEmail"><i class="icon-spinner11 mr-2"></i> Submit</button>

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
    $(function () {
        var vm = new Vue({
            el: '#forgot-password-page',
            data: {},
            methods: {
                confirmEmail: function (e) {
                    e.preventDefault();
                    var ladda = Ladda.create($('#btn-forgot-password')[0]);
                    ladda.start();
                    $.ajax({
                        data: $('#forgot-password-form').serialize(),
                        type: 'POST',
                        success: function (resp) {
                            if (resp.status) {
                                toastMessage('success', resp.message);
                            } else {
                                toastMessage('error', resp.message);
                            }
                            ladda.stop();
                        },
                        error: function (msg) {
                            console.log(msg);
                            ladda.stop();
                        }
                    });
                }
            }
        })

        $('#forgot-password-form').on('keyup keypress', function (e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });
    });
</script>