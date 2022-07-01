<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\quanly\models\HoKinhDoanh */
?>
<div class="ho-kinh-doanh-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_hkd',
            'ten_hkd',
            'dien_thoai',
            'fax',
            'email:email',
            'nganh_nghe:ntext',
            'website',
            'von_kd',
            'dai_dien',
            'dan_toc',
            'ngay_sinh',
            'quoc_tich',
            'cmnd',
            'ngay_cap',
            'noi_cap',
            'hokhau_thuongtru',
            'noisong_hientai',
            'so_nha',
            'ten_duong',
            'ten_phuong',
            'vi_tri',
            'giayphep_so',
            'ghi_chu',
            'tinh_trang',
            'geom',
            'id_nn',
            'giayphep_ngay',
            'ten_quan',
            'gioi_tinh',
            'tu_ngay',
            'den_ngay',
            'ma_thue',
            'nha',
            'cap1',
            'cap2',
            'cap3',
            'cap4',
            'cap5',
            'tinhtrang_thue',
        ],
    ]) ?>

</div>
