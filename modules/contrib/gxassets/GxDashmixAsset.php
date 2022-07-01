<?php

namespace app\modules\contrib\gxassets;

class GxDashmixAsset extends \yii\web\AssetBundle
{

    public $sourcePath = '@app/modules/contrib/gxassets/assets/dashmix';
    public $css = [
        'css/dashmix.min-5.0.css',
        'css/custom.css',
    ];
    public $js = [
        'js/dashmix.app.min-5.1.js',
        //'js/jquery.easypiechart.min.js',
        //'js/jquery.sparkline.min.js',
        //'js/chart.min.js',
        //'js/be_comp_charts.min.js',
    ];

    public $depends = [
        'app\modules\contrib\gxassets\GxBootstrapAsset',
    ];

//    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

}
