<?php
use yii\helpers\Url;
use yii\helpers\Html;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ten_hkd',
        'label'=>'Tên hộ kinh doanh'
    ],
       
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'giayphep_so',
         'label'=>'Giấy phép'
     ],
    [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'so_nha',
         'label'=>'Số nhà'
     ],
    [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'ten_duong',
        'label'=>'Tên đường'
     ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'ten_phuong',
         'label'=>'Tên phường'
     ],
    [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'dai_dien',
        'label'=>'Người đại diện'
     ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'dien_thoai',
        'label'=>'Số điện thoại'
    ],
    [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'tinh_trang',
         'label'=>'Tình trạng',
        'filter'=>["Chưa cập nhật"=>'Chưa cập nhật',"Đang hoạt động"=>'Đang hoạt động',"Ngưng hoạt động"=>'Ngưng hoạt động',"Tạm ngừng hoạt động"=>'Tạm ngừng hoạt động']
     ],
    
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'width' => '180px',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'buttons' => [
            'view' => function ($url, $model, $key) {
                return Html::a('<span class="fa fa-info"></span>',$url,['class' => 'btn btn-info btn-sm','data-pjax'=>0,'title'=>'Xem']);
            },
            'update' => function ($url, $model, $key) {
                return Html::a('<span class="fa fa-pen"></span>',$url,['class' => 'btn btn-warning btn-sm','data-pjax'=>0,'title'=>'Cập nhật']);
            },
            'delete' => function ($url, $model, $key) {
                return Html::a('<span class="fa fa-trash"></span>',$url,['class' => 'btn btn-danger btn-sm','role' => 'modal-remote','title'=>'Xóa']);
            },
        ],
    ],

];   