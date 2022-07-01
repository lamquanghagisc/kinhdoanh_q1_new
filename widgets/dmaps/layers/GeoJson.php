<?php

namespace app\widgets\dmaps\layers;

use app\widgets\dmaps\Leaflet;
use yii\helpers\Json;
use yii\web\JsExpression;

class GeoJson extends Layer
{

    use PopupTrait;

    public $geojson;

    public function init()
    {
        parent::init();
//        if (empty($this->latLng)) {
//            throw new InvalidConfigException("'latLng' attribute cannot be empty.");
//        }
    }

    public function encode()
    {
//        $latLngs = Json::encode($this->getLatLngstoArray(), Leaflet::JSON_OPTIONS);
//        $options = $this->getOptions();
        $name = $this->name;
        $map = $this->map;
        $js = $this->bindPopupContent("L.geoJSON($this->geojson)") . ($map !== null ? ".addTo($map);" : "");
        if (!empty($name)) {
            $js = "var $name = $js" . ($map !== null ? "" : ";");
        }
        return new JsExpression($js);
    }

}
