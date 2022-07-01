<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 5/29/2020
 * Time: 3:46 PM
 */

namespace app\widgets\dmaps\plugins\prunecluster;


use app\services\DebugService;
use app\widgets\dmaps\Leaflet;
use app\widgets\dmaps\plugins\Plugin;
use app\widgets\dmaps\layers\Marker;
use app\widgets\dmaps\types\DivIcon;
use app\widgets\dmaps\types\Point;
use yii\web\JsExpression;

class PruneCluster extends Plugin
{
    public $name = 'prunecluster';

    public $markers = 'markers';

    public $geojsonUrl = null;

    public $itemUrl = null;


    public $ajaxResData = 'data';

    public $url = false;


    public $var = false;

    public $data = false;

    public $pluginName;

    public $mapObject;

    public $homeUrl = "../";

    private $_markers = [];

    /**
     * @return array the markers added
     */
    public function getMarkers()
    {
        return $this->_markers;
    }

    /**
     * Returns the name of the plugin
     * @return string
     */
    public function getPluginName()
    {
        return 'plugin:prunecluster';
    }

    /**
     * Registers plugin asset bundle
     *
     * @param \yii\web\View $view
     *
     * @return static the plugin
     * @codeCoverageIgnore
     */
    public function registerAssetBundle($view)
    {
        PruneClusterAsset::register($view);
        return $this;
    }

    /**
     * @param Marker $marker
     *
     * @return static the plugin
     */

    public function addMarker(Marker $marker)
    {
        $marker->name = $marker->map = null;
        $this->_markers[] = $marker;
        return $this;
    }

    public function encode()
    {

        $js = [];
        $map = Leaflet::GLOBAL_VARIABLES['map'];
        $pruneclusterJS = <<< JS
var {$this->name} = new PruneClusterForLeaflet();
{$this->name}.PrepareLeafletMarker = function(leafletMarker, data){
    var popupid = 'marker-popup-' + data.id;
    leafletMarker.bindPopup('<div id="' + popupid + '"></div>',{minWidth: 300});
    leafletMarker.on('click', function(e){
        $.ajax({
            url: '{$this->itemUrl}?id=' + data.id,
            success: function (html) {
                $('#' + popupid).empty().append(html);
            }
        })
    })
};
var data = {$this->ajaxResData}.features;
data.map(function(item){
    var marker = new PruneCluster.Marker(item.geo_y, item.geo_x);
    marker.data = item;
    {$this->name}.RegisterMarker(marker);
});
  
{$this->markers} = {$this->name};
{$map}.addLayer({$this->markers});
JS;

        $js[] = $pruneclusterJS;
        return new JsExpression(implode("\n", $js));
    }
}