<?php

use app\modules\auth\services\AuthService;

$controller = Yii::$app->controller;
$module = $controller->module;
$params = Yii::$app->params;
?>


<div class="js-sidebar-scroll" data-simplebar="init">
    <div class="simplebar-wrapper" style="margin: 0px;">
        <div class="simplebar-height-auto-observer-wrapper">
            <div class="simplebar-height-auto-observer"></div>
        </div>
        <div class="simplebar-mask">
            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                    <div class="simplebar-content" style="padding: 0px;">
                        <div class="content-side">
                            <ul class="nav-main">
                                <li class="nav-main-item">
                                    <a class="nav-main-link <?= $controller->id == 'dashboard' ? 'active' : '' ?>"
                                       href="https:\\cnty.hcmgis.vn\gis-dashboard\">
                                        <i class="nav-main-link-icon fa fa-map-marked-alt"></i>
                                        <span class="nav-main-link-name">Bản đồ</span>
                                    </a>
                                </li>

                                <!--Quản lý Người dùng-->
                                <?php if(AuthService::hasGroup(Yii::$app->user->id,'7')) :?>
                                <li class="nav-main-item open">
                                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                                        <i class="nav-main-link-icon fa fa-wrench"></i>
                                        <span class="nav-main-link-name"><?= $params['adminSidebar'][0]['name']?></span>
                                    </a>
                                    <ul class="nav-main-submenu">
                                    <?php foreach($params['adminSidebar'][0]['items'] as $sb):?>
                                        <li class="nav-main-item">
                                            <a class="nav-main-link"
                                               href="<?= Yii::$app->urlManager->createUrl($sb['url']) ?>">
                                                <i class="nav-main-link-icon <?= $sb['icon']?>"></i>
                                                <span class="nav-main-link-name"><?= $sb['name']?></span>
                                            </a>
                                        </li>
                                    <?php endforeach;?>
                                    </ul>
                                </li>
                                <?php endif;?>
                                <!--End quản lý người dùng-->

                                <?php foreach($params['sidebarContent'] as $sb):?>
                                <li class="nav-main-item">
                                    <a class="nav-main-link"
                                       href="<?= Yii::$app->urlManager->createUrl($sb['url']) ?>">
                                        <i class="nav-main-link-icon <?= $sb['icon']?>"></i>
                                        <span class="nav-main-link-name"><?= $sb['name']?></span>
                                    </a>
                                </li>
                                <?php endforeach;?>

                                <li class="nav-main-item">
                                    <a class="nav-main-link <?= $controller->id == 'dashboard' ? 'active' : '' ?>"
                                       href="<?= Yii::$app->urlManager->createUrl('qldanhmuc/site/index') ?>">
                                        <i class="nav-main-link-icon fa fa-list"></i>
                                        <span class="nav-main-link-name">Danh mục</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="simplebar-placeholder" style="width: auto; height: 760px;"></div>
    </div>
    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
        <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
    </div>
    <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
        <div class="simplebar-scrollbar"
             style="height: 190px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
    </div>
</div>