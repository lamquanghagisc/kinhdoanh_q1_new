<?php

namespace app\widgets\dmaps\plugins\prunecluster;


use yii\web\AssetBundle;

class PruneClusterAsset extends AssetBundle
{
    public $sourcePath = '@app/widgets/dmaps/assets';

    public $css = [
        'css/LeafletStyleSheet.css',
    ];

    public $js = [
        'js/PruneCluster.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'app\widgets\maps\LeafLetMapAsset',
    ];

//    public $js = [
//        'https://unpkg.com/leaflet.markercluster@1.0.0/dist/leaflet.markercluster.js'
//    ];

//    public function init()
//    {
//        $this->sourcePath = __DIR__ . '/assets';
//        $this->js = YII_DEBUG ? ['js/leaflet.markercluster-src.js'] : ['js/leaflet.markercluster.js'];
//    }
}
