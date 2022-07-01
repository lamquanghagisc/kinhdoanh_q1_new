<?php
/* @var $this View */

/* @var $content string */

use app\assets\AppAsset;
use app\modules\contrib\gxassets\GxDashmixAsset;
use app\modules\contrib\gxassets\GxVueAsset;
use app\modules\contrib\widgets\FlashMessageWidget;
use yii\helpers\Html;
use yii\web\View;

GxDashmixAsset::register($this);
GxVueAsset::register($this);
$asset = AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title>Ứng dụng GIS quản lý Chăn nuôi & Thú y</title>
        <?php $this->head() ?>
    </head>

    <body>
        <?php $this->beginBody() ?>
        <div id="page-container" >
            <main id="main-container">
                <div class="bg-image" style="overflow: hidden;background-image: url('<?= $asset->baseUrl ?>/resources/images/cloud.png');">
                    <?= FlashMessageWidget::widget() ?>
                    <?= $content ?>
                </div>
            </main>
        </div>

        <?php $this->endBody() ?>
    </body>

</html>
<?php $this->endPage() ?>