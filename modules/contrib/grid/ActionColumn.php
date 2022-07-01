<?php

namespace app\modules\contrib\grid;

class ActionColumn extends \kartik\grid\ActionColumn
{
    public $noWrap = true;

    public $viewOptions = [
        'class' => 'btn btn-info btn-sm'
    ];

    public $updateOptions = [
        'class' => 'btn btn-warning btn-sm'
    ];

    public $deleteOptions = [
        'class' => 'btn btn-danger btn-sm'
    ];
}
