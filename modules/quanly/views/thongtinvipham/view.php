<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\quanly\models\ThongtinVipham */
?>
<div class="thongtin-vipham-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_ttvp',
            'noidung_vipham',
            'quyetdinh_so',
            'quyetdinh_ngay',
            'hinhthuc_phat:ntext',
            'ghi_chu',
            'id_hkd',
            'bienban_so',
            'donvi_lap',
            'donvi_qd',
            'ngay_lap',
        ],
    ]) ?>

</div>
