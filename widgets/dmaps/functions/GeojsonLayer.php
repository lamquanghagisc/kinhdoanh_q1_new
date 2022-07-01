<?php
/**
 * Created by PhpStorm.
 * User: Duc
 * Date: 7/16/2021
 * Time: 8:39 AM
 */

namespace app\widgets\dmaps\functions;


use app\services\DebugService;
use app\widgets\dmaps\Leaflet;
use app\widgets\dmaps\plugins\prunecluster\PruneCluster;
use yii\web\JsExpression;

class GeojsonLayer extends JsFunction
{
    public $var = 'geojsonLayerVar';
    public $name = 'GeojsonLayer';
    public $geojsonUrl;
    public $itemUrl;
    public $usingPruneCluster = true;

    public function encode()
    {
        $data = 'data';
        $js = "function init$this->name()\n{";
        $js .= "
$.ajax({
            url: '$this->geojsonUrl',
            dataType: 'json',
            success: function ($data) {
";

        if ($this->usingPruneCluster) {

            $prunecluster = new PruneCluster();
            $prunecluster->itemUrl = $this->itemUrl;
            $prunecluster->ajaxResData = $data;
            $prunecluster->markers = Leaflet::GLOBAL_VARIABLES['markers'];
            $js .= $prunecluster->encode();
        } else {

        }


        $js .= "\n}})";
        $js .= "\n$this->map.invalidateSize();";
        $js .= "\n};";
        return new JsExpression($js);
    }


}