<?php

namespace app\widgets\dmaps\layers;

use app\widgets\dmaps\Leaflet;
use yii\helpers\Json;
use yii\web\JsExpression;

class Polygon extends PolyLine
{

    /**
     * @var bool whether to insert the layer at the bottom most position (z-index) on the map in reference to other
     * ui layers.
     */
    public $insertAtTheBottom = false;

    /**
     * Returns the javascript ready code for the object to render on the map.
     * To add a Polygon to the map, you need to use the special method [[LetLeaf::addPolygon]].
     * @return string
     */
    public function encode()
    {
        $latLngs = Json::encode($this->getLatLngstoArray(), Leaflet::JSON_OPTIONS);
        $options = $this->getOptions();
        $name = $this->name;
        $map = $this->map;
        $js = $this->bindPopupContent("L.polygon($latLngs, $options)") . ($map !== null ? ".addTo($map);" : "");
        if (!empty($name)) {
            $js = "var $name = $js" . ($map !== null ? "" : ";");
        }
        return new JsExpression($js);
    }

}
