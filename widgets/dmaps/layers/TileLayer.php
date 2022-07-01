<?php

namespace app\widgets\dmaps\layers;


use app\services\DebugService;
use yii\base\InvalidConfigException;
use yii\web\JsExpression;

class TileLayer extends Layer
{
    public $urlTemplate;

    const WMS = 'wms';

    public $service;

    public $layerName = null;

    public function init()
    {
        parent::init();
        if (empty($this->urlTemplate)) {
            throw new InvalidConfigException("'urlTemplate' cannot be empty.");
        }
    }

    /**
     * @return \yii\web\JsExpression the marker constructor string
     */
    public function encode()
    {
        $options = $this->getOptions();
        $name = $this->getName();
        $map = $this->map;
        $js = "L.tileLayer". (($this->service != null) ? '.'.$this->service : '')  ."('$this->urlTemplate', $options)" . ($map !== null ? ".addTo($map);" : "");
        if (!empty($name)) {
            $js = "var $name = $js" . ($map !== null ? "" : ";");
            $js .= $this->getEvents();
        }

        return new JsExpression($js);
    }

    public function encodeJS(){
        $options = $this->getOptions();
        $map = $this->map;
        $js = "('$this->urlTemplate', $options)" . ($map !== null ? ".addTo($map);" : "");
        return $js;
    }
}
