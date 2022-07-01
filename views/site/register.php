<?php

use kartik\form\ActiveForm;
use yii\authclient\widgets\AuthChoice;
?>

<style>
    .navbar,
    footer {
        display: none !important;
    }

    .input-group-addon {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        right: .5rem;
        color: #999;
        font-size: .75rem !important;
    }
</style>

<div class="row g-0 bg-primary-op">
    <div class="hero-static col-md-6 d-flex align-items-center bg-body-light">
        <div class="p-3 w-100">
            <div class="mb-3 text-center">
                <a href="<?= Yii::$app->homeUrl ?>">
                    <img src="<?= Yii::$app->homeUrl ?>resources/images/logo.png" style="max-width: 120px">
                </a>
                <p class="text-uppercase fw-bold fs-sm text-muted">REGISTER NEW ACCOUNT</p>
            </div>
            <div class="row g-0 justify-content-center">
                <div class="col-sm-8 col-xl-6">
                    <?php
                    $form = ActiveForm::begin([
                                'id' => 'register-form',
                                'options' => [
                                    'class' => 'js-validation-signup'
                                ]
                    ]);
                    ?>
                    <div class="py-3">
                        <div class="mb-4">
                            <?= $form->field($model, 'fullname')->textInput(['placeholder' => 'Fullname'])->label(false) ?>               
                        </div>
                         <div class="mb-4">
                            <?= $form->field($model, 'username')->textInput(['placeholder' => 'Username'])->label(false) ?>
                        </div>
                        <div class="mb-4">
                            <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email'])->label(false) ?>
                        </div>
                        <div class="mb-4">
                            <?=
                            $form->field($model, 'password', [
                                'addon' => ['append' => ['content' => '6 - 15 characters']]
                            ])->textInput(['placeholder' => 'Password', 'type' => 'password'])->label(false)
                            ?>
                        </div>
                        <div class="mb-4">
                            <?= $form->field($model, 'cpassword')->textInput(['placeholder' => 'Confirm password', 'type' => 'password'])->label(false) ?>
                        </div>
                    </div>
                    <div class="mb-4">
                        <button type="submit" class="btn w-100 btn-lg btn-hero btn-primary">
                            <i class="fa fa-fw fa-plus opacity-50 me-1"></i> Sign Up
                        </button>
                         <p class="mt-3 mb-0 d-lg-flex left-content-lg-between">
                             <span> You have an account ? </span>
                            <a class="btn btn-sm btn-alt-secondary d-block d-lg-inline-block mb-1" href="login">
                               <i class="fa fa-sign-in-alt opacity-50 me-1"></i> Sign in
                            </a>
                           
                        </p>
                        </div>
                    <div class="mb-4 ">
                        <p class="mt-3 mb-0 d-lg-flex justify-content-lg-between ">
                            <?php
                            $authChoice = AuthChoice::begin([
                                        'baseAuthUrl' => ['site/auth']
                            ]);
                            ?>
                            <?php foreach ($authChoice->getClients() as $client) : ?>
                                <a href="<?= $authChoice->createClientUrl($client) ?>" 
                                   class="btn btn-icon rounded-round border-2  <?= $client->getName() === 'google' ? 'btn-outline-danger' : 'btn-outline-primary' ?>"
                                 >
                                    <i class="fab <?= $client->getName() === 'google' ? 'fa-google' : 'fa-facebook' ?>"></i>
                                </a>
                            <?php endforeach; ?>
                            <?php AuthChoice::end() ?>

                        </p>
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
