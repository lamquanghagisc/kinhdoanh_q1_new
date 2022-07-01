<?php

use app\assets\AppAsset;
use yii\authclient\widgets\AuthChoice;
use yii\bootstrap\ActiveForm;

AppAsset::register($this);
?>

<div class="row g-0 bg-primary-op">
    <div class="hero-static col-md-6 d-flex align-items-center bg-body-light">
        <div class="p-3 w-100">
            <div class="mb-3 text-center">
                <a href="<?= Yii::$app->homeUrl ?>">
                    <img src="<?= Yii::$app->homeUrl ?>resources/images/logo.png" style="max-width: 120px">
                </a>
                <p class="text-uppercase fw-bold fs-sm text-muted">Sign In</p>
            </div>
            <div class="row g-0 justify-content-center">
                <div class="col-sm-8 col-xl-6">
                    <?php if ($referrer == 'register'): ?>
                        <div class="alert alert-primary border-0">
                            <?= Yii::t('app', 'Register account successfully. We have sent a confirmation email. Please check and follow the instructions to confirm your registration.') ?>
                        </div>
                    <?php elseif ($referrer == 'confirm-email'): ?>
                        <div class="alert alert-primary border-0">
                            <?= Yii::t('app', 'Congratulations on your successful registration. You can login and experience HCMGIS System now.') ?>
                        </div>
                    <?php endif; ?>
                    <?php
                    $form = ActiveForm::begin([
                                'id' => 'login-form',
                                'options' => [
                                    'class' => 'js-validation-signin'
                                ]
                    ]);
                    ?>
                    <div class="py-3">
                        <div class="mb-4">
                            <?= $form->field($model, 'username')->textInput(['placeholder' => 'Username', 'class' => 'form-control form-control-lg form-control-alt'])->label(false) ?>
                        </div>
                        <div class="mb-4">
                            <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password', 'class' => 'form-control form-control-lg form-control-alt'])->label(false) ?>
                        </div>
                    </div>
                    <div class="mb-4">
                        <button type="submit" class="btn w-100 btn-lg btn-hero btn-primary">
                            <i class="fa fa-fw fa-sign-in-alt opacity-50 me-1"></i> Sign In
                        </button>
                        <p class="mt-3 mb-0 d-lg-flex justify-content-lg-between">
                            <a class="btn btn-sm btn-alt-secondary d-block d-lg-inline-block mb-1" href="<?= Yii::$app->homeUrl . 'site/forgot-password' ?>">
                                <i class="fa fa-exclamation-triangle opacity-50 me-1"></i> Forgot password
                            </a>
                            <a class="btn btn-sm btn-alt-secondary d-block d-lg-inline-block mb-1" href="register">
                                <i class="fa fa-plus opacity-50 me-1 text-primary"></i>  Register new account
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
                                   class="btn btn-icon rounded-round border-2 <?= $client->getName() === 'google' ? 'btn-outline-danger' : 'btn-outline-primary' ?>">
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
                Ứng dụng GIS quản lý </br>Chăn nuôi & Thú y
            </p>
            <p class="fs-lg fw-semibold text-white-75 mb-0">
                Copyright © <span data-toggle="year-copy" class="js-year-copy-enabled">2022 HCMGIS</span>
            </p>
        </div>
    </div>

</div>