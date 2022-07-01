<?php
/**
 * Created by PhpStorm.
 * User: Duc
 * Date: 7/15/2021
 * Time: 8:45 PM
 */

namespace app\widgets\dmaps;

use yii\web\AssetBundle;

class LeafletAsset extends AssetBundle
{
    public $sourcePath = '@app/widgets/dmaps/assets';

    public $css = [
        'leaflet.css'
    ];

    public $js = [
        'leaflet-src.js'
    ];
}