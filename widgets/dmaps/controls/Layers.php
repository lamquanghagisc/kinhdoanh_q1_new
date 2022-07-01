<?php

namespace app\widgets\dmaps\controls;


use app\services\DebugService;
use app\widgets\dmaps\layers\Layer;
use app\widgets\dmaps\layers\TileLayer;
use app\widgets\dmaps\layers\LayerGroup;
use app\widgets\dmaps\Leaflet;
use yii\base\InvalidParamException;
use yii\helpers\Json;
use yii\web\JsExpression;

class Layers extends Control
{
    /**
     * @var TileLayer[]
     */
    private $_baseLayers = [];

    /**
     * @param mixed $baseLayers
     *
     * @throws \yii\base\InvalidParamException
     */
    public function setBaseLayers(array $baseLayers)
    {
        foreach ($baseLayers as $key => $layer) {
//            if (!($layer instanceof TileLayer)) {
//                throw new InvalidParamException("All baselayers should be of type TileLayer ");
//            }
            $this->_baseLayers[$key] = $layer;
        }
    }

    /**
     * @return TileLayer[]
     */
    public function getBaseLayers()
    {
        return $this->_baseLayers;
    }

    /**
     * @return array of encoded base layers
     */
    public function getEncodedBaseLayers()
    {
        $layers = [];
        foreach ($this->getBaseLayers() as $key => $layer) {
            $layer->name = null;
            $layers[($layer->layerName == null) ? $key : $layer->layerName] = new JsExpression(str_replace(";", "", $layer->encode()));
        }

        return $layers;
    }

    /**
     * @var Layer[]
     */
    private $_overlays = [];

    /**
     * @param LayerGroup[] $overlays
     *
     * @throws \yii\base\InvalidParamException
     */
    public function setOverlays($overlays)
    {
        foreach ($overlays as $key => $overlay) {
            if (!($overlay instanceof LayerGroup)) {
                throw new InvalidParamException("All overlays should be of type LayerGroup");
            }
            $this->_overlays[$key] = $overlay;
        }
    }

    /**
     * @return Layer[]
     */
    public function getOverlays()
    {
        return $this->_overlays;
    }

    /**
     * @return array of encoded overlays
     */
    public function getEncodedOverlays()
    {
        $overlays = [];
        /**
         * @var LayerGroup $overlay
         */
        foreach ($this->getOverlays() as $key => $overlay) {
            $overlays[$overlay->layerName] = $overlay->oneLineEncode();
        }
        return $overlays;
    }

    /**
     * Returns the javascript ready code for the object to render
     * @return \yii\web\JsExpression
     */
    public function encode()
    {
        $this->clientOptions['position'] = $this->position;
        $layers = $this->getEncodedBaseLayers();
        $overlays = $this->getEncodedOverlays();
        $options = $this->getOptions();
        $name = $this->name;
        $map = $this->map;

        $layers = empty($layers) ? '{}' : Json::encode($layers, Leaflet::JSON_OPTIONS);
        $overlays = empty($overlays) ? '{}' : Json::encode($overlays, Leaflet::JSON_OPTIONS);
        $js = "L.control.layers($layers, $overlays, $options)" . ($map !== null ? ".addTo($map);" : "");

        if (!empty($name)) {
            $js = "var $name = $js" . ($map !== null ? "" : ";");
        }
        return new JsExpression($js);
    }
}
