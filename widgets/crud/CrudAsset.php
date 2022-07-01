<?php
/**
 * Created by PhpStorm.
 * User: Duc
 * Date: 9/24/2021
 * Time: 10:43 AM
 */

namespace app\widgets\crud;


use yii\web\AssetBundle;

class CrudAsset extends AssetBundle
{
    public $sourcePath = '@app/widgets/crud/assets';

    public $css = [
        'ajaxcrud.css'
    ];

    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
//        'yii\bootstrap\BootstrapPluginAsset',
        'kartik\grid\GridViewAsset',
    ];

    public function init() {
        // In dev mode use non-minified javascripts
        $this->js = YII_DEBUG ? [
            'ModalRemote.js',
            'ajaxcrud.js',
        ]:[
            'ModalRemote.min.js',
            'ajaxcrud.min.js',
        ];
        parent::init();
    }
}