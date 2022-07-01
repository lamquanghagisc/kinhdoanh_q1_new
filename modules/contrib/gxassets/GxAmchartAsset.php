<?php

namespace app\modules\contrib\gxassets;

class GxAmchartAsset extends \yii\web\AssetBundle
{

    public $sourcePath = '@app/modules/contrib/gxassets/assets/amcharts4';
    public $css = [

    ];
    public $js = [
        'core.js',
        'charts.js',
        'themes/amcharts.js',
        'themes/kelly.js',
    ];

//    public $depends = [
//        'app\modules\contrib\gxassets\GxBootstrapAsset',
//    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

}
