<li class="nav-main-item">
    <a class="nav-main-link <?= $controller->id == 'dashboard' ? 'active' : '' ?>"
       href="<?= Yii::$app->urlManager->createUrl('quan-ly-danh-muc') ?>">
        <i class="nav-main-link-icon fa fa-chart-bar"></i>
        <span class="nav-main-link-name">Trang chủ</span>
    </a>
</li>
<li class="nav-main-heading">Quản lý</li>
<li class="nav-main-item">
    <a href="<?= Yii::$app->urlManager->createUrl('quan-ly-danh-muc/dm-dantoc/index') ?>"
       class="nav-main-link">
        <i class="nav-main-link-icon fa fa-list"></i> <span
                class="nav-main-link-name">Dân tộc</span>
    </a>
</li>
<li class="nav-main-item">
    <a href="<?= Yii::$app->urlManager->createUrl('quan-ly-danh-muc/dm-dotuoi/index') ?>"
       class="nav-main-link">
        <i class="nav-main-link-icon fa fa-list"></i> <span
                class="nav-main-link-name">Độ tuổi</span>
    </a>
</li>
<li class="nav-main-item">
    <a href="<?= Yii::$app->urlManager->createUrl('quan-ly-danh-muc/dm-gioitinh/index') ?>"
       class="nav-main-link">
        <i class="nav-main-link-icon fa fa-list"></i> <span
                class="nav-main-link-name">Giới tính</span>
    </a>
</li>
<li class="nav-main-item">
    <a href="<?= Yii::$app->urlManager->createUrl('quan-ly-danh-muc/dm-loaibenh/index') ?>"
       class="nav-main-link">
        <i class="nav-main-link-icon fa fa-list"></i> <span
                class="nav-main-link-name">Loại bệnh</span>
    </a>
</li>
<li class="nav-main-item">
    <a href="<?= Yii::$app->urlManager->createUrl('quan-ly-danh-muc/dm-loaicutru/index') ?>"
       class="nav-main-link">
        <i class="nav-main-link-icon fa fa-list"></i> <span
                class="nav-main-link-name">Loại cư trú</span>
    </a>
</li>
<li class="nav-main-item">
    <a href="<?= Yii::$app->urlManager->createUrl('quan-ly-danh-muc/dm-quanhechuho/index') ?>"
       class="nav-main-link">
        <i class="nav-main-link-icon fa fa-list"></i> <span
                class="nav-main-link-name">Quan hệ với chủ hộ</span>
    </a>
</li>
<li class="nav-main-item">
    <a href="<?= Yii::$app->urlManager->createUrl('quan-ly-danh-muc/dm-tongiao/index') ?>"
       class="nav-main-link">
        <i class="nav-main-link-icon fa fa-list"></i> <span
                class="nav-main-link-name">Tôn giáo</span>
    </a>
</li>
<li class="nav-main-item">
    <a href="<?= Yii::$app->urlManager->createUrl('quan-ly-danh-muc/dm-vaxcin/index') ?>"
       class="nav-main-link">
        <i class="nav-main-link-icon fa fa-list"></i> <span
                class="nav-main-link-name">Vắc xin</span>
    </a>
</li>
<li class="nav-main-item">
    <a href="<?= Yii::$app->urlManager->createUrl('quan-ly-danh-muc/dm-tinhtranghoatdong/index') ?>"
       class="nav-main-link">
        <i class="nav-main-link-icon fa fa-list"></i> <span
                class="nav-main-link-name">Tình trạng hoạt động</span>
    </a>
</li>