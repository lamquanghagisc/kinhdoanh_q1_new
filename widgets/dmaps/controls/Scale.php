<?php

namespace app\widgets\dmaps\controls;

use yii\web\JsExpression;

class Scale extends Control
{
    /**
     * Returns the javascript ready code for the object to render
     * @return \yii\web\JsExpression
     */
    public $scale_position = 'bottomleft';

    public function encode()
    {
        $this->clientOptions['position'] = $this->scale_position;
        $options = $this->getOptions();
        $name = $this->getName();
        $map = $this->map;
        $js = "L.control.scale($options)" . ($map !== null ? ".addTo($map);" : "");
        if (!empty($name)) {
            $js = "var $name = $js" . ($map !== null ? "" : ";");
        }
        return new JsExpression($js);
    }

}
