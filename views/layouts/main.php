<?php
/**
 * Created by PhpStorm.
 * User: Duc
 * Date: 7/3/2021
 * Time: 9:00 PM
 */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

$appasset = AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-fixed side-trans-enabled">
        <div id="page-overlay"></div>
        <nav id="sidebar" aria-label="Main Navigation">
            <div class="bg-primary-darker">
                <div class="content-header bg-white-10">
                    <a class="font-w600 text-white tracking-wide" href="<?= Yii::$app->urlManager->createUrl('') ?>">
                        <img src="<?= $appasset->baseUrl ?>/images/logo/logo.png" alt="logo" width="100%"
                             class="logo-default">
                    </a>
                    <div>
                        <a class="d-lg-none text-white ml-2" data-toggle="layout" data-action="sidebar_close"
                           href="javascript:void(0)">
                            <i class="fa fa-times-circle"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php include('sidebar.php'); ?>
        </nav>
        <?php include('header.php'); ?>
        <main id="main-container">
            <div class="content">
                <?php if (isset($this->params['breadcrumbs'])): ?>
                    <div class="block">
                        <div class="col-lg-12 py-2">
                            <nav aria-label="breadcrumb">
                                <?=
                                Breadcrumbs::widget([
                                    'tag' => 'ol',
                                    'homeLink' => [
                                        'label' => Html::encode(Yii::t('yii', 'Trang chủ')),
                                        'url' => Yii::$app->homeUrl,
                                        'encode' => false,
                                    ],
                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                    'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>",
                                    'activeItemTemplate' => "<li class='active breadcrumb-item'>{link}</li>",
                                    'options' => [
                                        'class' => 'breadcrumb breadcrumb-alt',
                                    ]
                                ])
                                ?>
                            </nav>
                        </div>
                    </div>
                <?php endif; ?>
                <?= \app\modules\contrib\widgets\FlashMessageWidget::widget() ?>
                <?= $content ?>
            </div>
        </main>

        <?php include('footer.php'); ?>
    </div>


    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>