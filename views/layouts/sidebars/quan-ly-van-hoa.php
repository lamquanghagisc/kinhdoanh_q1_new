<li class="nav-main-item">
    <a class="nav-main-link <?= $controller->id == 'dashboard' ? 'active' : '' ?>"
       href="<?= Yii::$app->urlManager->createUrl('quan-ly-van-hoa') ?>">
        <i class="nav-main-link-icon fa fa-chart-bar"></i>
        <span class="nav-main-link-name">Trang chủ</span>
    </a>
</li>
<li class="nav-main-heading">Quản lý</li>

<li class="nav-main-item">
    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
       aria-haspopup="true" aria-expanded="false">
        <i class="nav-main-link-icon fa fa-building"></i>
        <span class="nav-main-link-name">Cơ sở lưu trú</span>
    </a>
    <ul class="nav-main-submenu">
        <li class="nav-main-item">
            <a href="<?= Yii::$app->urlManager->createUrl('quan-ly-van-hoa/co-so-luu-tru/index') ?>"
               class="nav-main-link">
                <i class="nav-main-link-icon fa fa-list"></i> <span
                    class="nav-main-link-name">Danh sách</span>
            </a>
        </li>
        <li class="nav-main-item">
            <a href="<?= Yii::$app->urlManager->createUrl('quan-ly-van-hoa/co-so-luu-tru/create') ?>"
               class="nav-main-link">
                <i class="nav-main-link-icon fa fa-plus"></i> <span
                        class="nav-main-link-name">Thêm mới</span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-main-item">
    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
       aria-haspopup="true" aria-expanded="false">
        <i class="nav-main-link-icon fa fa-star"></i>
        <span class="nav-main-link-name">Cơ sở tôn giáo</span>
    </a>
    <ul class="nav-main-submenu">
        <li class="nav-main-item">
            <a href="<?= Yii::$app->urlManager->createUrl('quan-ly-van-hoa/co-so-ton-giao/index') ?>"
               class="nav-main-link">
                <i class="nav-main-link-icon fa fa-list"></i> <span
                        class="nav-main-link-name">Danh sách</span>
            </a>
        </li>
        <li class="nav-main-item">
            <a href="<?= Yii::$app->urlManager->createUrl('quan-ly-van-hoa/co-so-ton-giao/create') ?>"
               class="nav-main-link">
                <i class="nav-main-link-icon fa fa-plus"></i> <span
                        class="nav-main-link-name">Thêm mới</span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-main-item">
    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
       aria-haspopup="true" aria-expanded="false">
        <i class="nav-main-link-icon fa fa-place-of-worship"></i>
        <span class="nav-main-link-name">Di sản</span>
    </a>
    <ul class="nav-main-submenu">
        <li class="nav-main-item">
            <a href="<?= Yii::$app->urlManager->createUrl('quan-ly-van-hoa/di-san/index') ?>"
               class="nav-main-link">
                <i class="nav-main-link-icon fa fa-list"></i> <span
                        class="nav-main-link-name">Danh sách</span>
            </a>
        </li>
        <li class="nav-main-item">
            <a href="<?= Yii::$app->urlManager->createUrl('quan-ly-van-hoa/di-san/create') ?>"
               class="nav-main-link">
                <i class="nav-main-link-icon fa fa-plus"></i> <span
                        class="nav-main-link-name">Thêm mới</span>
            </a>
        </li>
    </ul>
</li>