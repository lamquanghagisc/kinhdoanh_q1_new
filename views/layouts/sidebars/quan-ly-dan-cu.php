<li class="nav-main-item">
    <a class="nav-main-link <?= $controller->id == 'dashboard' ? 'active' : '' ?>"
       href="<?= Yii::$app->urlManager->createUrl('quan-ly-dan-cu') ?>">
        <i class="nav-main-link-icon fa fa-chart-bar"></i>
        <span class="nav-main-link-name">Trang chủ</span>
    </a>
</li>
<li class="nav-main-item">
    <a class="nav-main-link <?= $controller->id == 'search' ? 'active' : '' ?>"
       href="<?= Yii::$app->urlManager->createUrl('quan-ly-dan-cu/search/index') ?>">
        <i class="nav-main-link-icon fa fa-search"></i>
        <span class="nav-main-link-name">Tìm kiếm</span>
    </a>
</li>
<li class="nav-main-heading">Quản lý</li>

<li class="nav-main-item">
    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
       aria-haspopup="true" aria-expanded="false">
        <i class="nav-main-link-icon fa fa-user"></i>
        <span class="nav-main-link-name">Công dân</span>
    </a>
    <ul class="nav-main-submenu">
        <li class="nav-main-item">
            <a href="<?= Yii::$app->urlManager->createUrl('quan-ly-dan-cu/cong-dan/index') ?>"
               class="nav-main-link">
                <i class="nav-main-link-icon fa fa-list"></i> <span
                    class="nav-main-link-name">Danh sách</span>
            </a>
        </li>
        <li class="nav-main-item">
            <a href="<?= Yii::$app->urlManager->createUrl('quan-ly-dan-cu/cong-dan/statistic') ?>"
               class="nav-main-link">
                <i class="nav-main-link-icon fa fa-chart-bar"></i> <span
                    class="nav-main-link-name">Thống kê</span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-main-item">
    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
       aria-haspopup="true" aria-expanded="false">
        <i class="nav-main-link-icon fa fa-users"></i>
        <span class="nav-main-link-name">Hộ gia đình</span>
    </a>
    <ul class="nav-main-submenu">
        <li class="nav-main-item">
            <a href="<?= Yii::$app->urlManager->createUrl('quan-ly-dan-cu/ho-gia-dinh/index') ?>"
               class="nav-main-link">
                <i class="nav-main-link-icon fa fa-list"></i> <span
                    class="nav-main-link-name">Danh sách</span>
            </a>
        </li>
        <li class="nav-main-item">
            <a href="<?= Yii::$app->urlManager->createUrl('quan-ly-dan-cu/ho-gia-dinh/statistic') ?>"
               class="nav-main-link">
                <i class="nav-main-link-icon fa fa-chart-bar"></i> <span
                    class="nav-main-link-name">Thống kê</span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-main-item">
    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
       aria-haspopup="true" aria-expanded="false">
        <i class="nav-main-link-icon fa fa-home"></i>
        <span class="nav-main-link-name">Nóc gia</span>
    </a>
    <ul class="nav-main-submenu">
        <li class="nav-main-item">
            <a href="<?= Yii::$app->urlManager->createUrl('quan-ly-dan-cu/noc-gia/index') ?>"
               class="nav-main-link">
                <i class="nav-main-link-icon fa fa-list"></i> <span
                    class="nav-main-link-name">Danh sách</span>
            </a>
        </li>
        <li class="nav-main-item">
            <a href="<?= Yii::$app->urlManager->createUrl('quan-ly-dan-cu/noc-gia/statistic') ?>"
               class="nav-main-link">
                <i class="nav-main-link-icon fa fa-chart-bar"></i> <span
                    class="nav-main-link-name">Thống kê</span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-main-item">
    <a class="nav-main-link <?= $controller->id == 'search' ? 'active' : '' ?>"
       href="<?= Yii::$app->urlManager->createUrl('quan-ly-dan-cu/todanpho/index') ?>">
        <i class="nav-main-link-icon fa fa-minus"></i>
        <span class="nav-main-link-name">Tổ dân phố</span>
    </a>
</li>

<li class="nav-main-item">
    <a class="nav-main-link <?= $controller->id == 'search' ? 'active' : '' ?>"
       href="<?= Yii::$app->urlManager->createUrl('quan-ly-dan-cu/khupho/index') ?>">
        <i class="nav-main-link-icon fa fa-minus"></i>
        <span class="nav-main-link-name">Khu phố</span>
    </a>
</li>

<li class="nav-main-item">
    <a class="nav-main-link <?= $controller->id == 'search' ? 'active' : '' ?>"
       href="<?= Yii::$app->urlManager->createUrl('quan-ly-dan-cu/phuongxa/index') ?>">
        <i class="nav-main-link-icon fa fa-minus"></i>
        <span class="nav-main-link-name">Phường</span>
    </a>
</li>