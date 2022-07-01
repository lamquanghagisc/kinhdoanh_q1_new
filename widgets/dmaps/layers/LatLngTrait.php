<?php

namespace app\widgets\dmaps\layers;

use app\widgets\dmaps\types\LatLng;

trait LatLngTrait
{
    /**
     * @var LatLng holds the latitude and longitude values.
     */
    private $_latLon;

    /**
     * @param LatLng $latLon the position to render the marker
     */
    public function setLatLng(LatLng $latLon)
    {
        $this->_latLon = $latLon;
    }

    /**
     * @return LatLng
     */
    public function getLatLng()
    {
        return $this->_latLon;
    }
}
