<header id="page-header" class="bg-primary-darker">
    <div class="content-header">
        <div>
            <button type="button" class="btn btn-light" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <button type="button" class="btn btn-light" data-toggle="layout" data-action="header_search_on">
                <i class="fa fa-fw fa-search"></i> <span class="ml-1 d-none d-sm-inline-block">Tìm kiếm</span>
            </button>
        </div>
        <div>
            <div class="dropdown d-inline-block">
                <?php if(!Yii::$app->user->isGuest):?>
                <button type="button" class="btn btn-light" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-user d-sm-none"></i>

                    <span class="d-none d-sm-inline-block"><?= (!Yii::$app->user->isGuest) ? Yii::$app->user->identity->fullname : 'Đăng nhập' ?></span>
                    <i class="fa fa-fw fa-angle-down ml-1 d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="page-header-user-dropdown">
                    <div class="p-2">
                        <a class="dropdown-item" href="<?= Yii::$app->urlManager->createUrl(['cms/auth-user/view','id'=>Yii::$app->user->id]) ?>">
                            <i class="fas fa-user mr-1"></i> Thông tin cá nhân
                        </a>
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= Yii::$app->urlManager->createUrl(['site/logout']) ?>">
                            <i class="fas fa-arrow-alt-circle-left mr-1"></i> Đăng xuất
                        </a>
                    </div>
                </div>
                <?php else:?>
                    <a href="<?= Yii::$app->urlManager->createUrl(['site/login']) ?>" class="btn btn-alt-secondary">Đăng nhập</a>
                <?php endif;?>
            </div>
        </div>
    </div>
    <div id="page-header-search" class="overlay-header bg-primary-darker">
        <div class="bg-white-10">
            <div class="content-header">
                <?php

                use kartik\form\ActiveForm; ?>
                <?php $form = ActiveForm::begin([
                    'options' => [
                        'class' => 'w-100',
                        'method' => 'post',
                    ],
                    'action' => Yii::$app->urlManager->createUrl('quan-ly-dan-cu/search/index'),


                ]); ?>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-alt-primary" data-toggle="layout" data-action="header_search_off">
                            <i class="fa fa-fw fa-times-circle"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control border-0" placeholder="Tìm kiếm..." id="page-header-search-input" name="q">
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    <div id="page-header-loader" class="overlay-header bg-header-dark">
        <div class="bg-white-10">
            <div class="content-header">
                <div class="w-100 text-center">
                    <i class="fa fa-fw fa-sun fa-spin text-white"></i>
                </div>
            </div>
        </div>
    </div>
</header>