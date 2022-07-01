<?php

namespace app\widgets\dmaps\types;

use app\widgets\dmaps\Leaflet;
use yii\base\InvalidConfigException;
use yii\helpers\Json;
use yii\web\JsExpression;

class LatLng extends Type implements ArrayableInterface
{
    /**
     * @var float the latitude in degrees.
     */
    public $lat;
    /**
     * @var float the longitude in degrees.
     */
    public $lng;

    /**
     * Initializes the object
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        if ($this->lat === null || $this->lng === null) {
            throw new InvalidConfigException("'lat' and 'lng' attributes cannot be empty.");
        }
    }

    /**
     * LatLng is and object to be used
     * @return \yii\web\JsExpression the js initialization code of the object
     */
    public function encode()
    {
        return new JsExpression("L.latLng($this->lat, $this->lng)"); // no semicolon
    }

    /**
     * Returns the lat and lng as array
     *
     * @param bool $encode whether to return the array json_encoded or raw
     *
     * @return array|JsExpression
     */
    public function toArray($encode = false)
    {
        $latLng = [$this->lat, $this->lng];

        return $encode
            ? new JsExpression(Json::encode($latLng, Leaflet::JSON_OPTIONS))
            : $latLng;
    }
}
