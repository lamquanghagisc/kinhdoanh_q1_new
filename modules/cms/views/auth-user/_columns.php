<?php

use yii\helpers\Html;
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'username',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'email',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'fullname',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'status',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'active',
    ],
     [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'confirmed',
    ],
    [
        'class' => 'app\modules\contrib\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
        },
                  'template' => '{view} {update} {active} {update-pass} {delete}',
                'buttons' => [
                    'active' => function($url, $model) {
                        return Html::a("<span class='fa fa-lock'></span>", $url, ['class' => 'btn btn-warning btn-sm','title'=>'Khoá tài khoản', 'role' => 'modal-remote']);
                    },
                             'update-pass' => function($url, $model) {
                        return Html::a("<span class='fa fa-key'></span>", $url, ['class' => 'btn btn-success btn-sm','title'=>'Cập nhật mật khẩu']);
                    },
                        ],
                    ],
                ];
                