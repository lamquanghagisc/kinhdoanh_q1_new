<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
        'js/vue-component.js',
        'js/site.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'app\modules\contrib\gxassets\GxJqueryAsset',
//        'app\modules\contrib\gxassets\GxBootstrapAsset',
        'app\modules\contrib\gxassets\GxVueAsset',
        'app\modules\contrib\gxassets\GxDashmixAsset',
    ];


    public $jsOptions = ['position' => \yii\web\View::POS_END];
}
