<?php

namespace app\widgets\dmaps\types;

use app\widgets\dmaps\Leaflet;
use yii\base\InvalidConfigException;
use yii\helpers\Json;
use yii\web\JsExpression;

class Point extends Type implements ArrayableInterface
{
    /**
     * @var float x coordinate
     */
    public $x;
    /**
     * @var float y coordinate
     */
    public $y;
    /**
     * @var bool if round is set to true, LetLeaf will round the x and y values.
     */
    public $round = false;

    /**
     * Initializes the class
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        if (empty($this->x) || empty($this->y)) {
            throw new InvalidConfigException("'x' or 'y' cannot be empty.");
        }
    }

    /**
     * @return \yii\web\JsExpression the js initialization code of the object
     */
    public function encode()
    {
        $x = $this->x;
        $y = $this->y;
        return new JsExpression("L.point($x, $y)"); // no semicolon
    }

    /**
     * Returns the point values as array
     *
     * @param bool $encode whether to return the array json_encoded or raw
     *
     * @return array|JsExpression
     */
    public function toArray($encode = false)
    {
        $point = [$this->x, $this->y];
        return $encode ? new JsExpression(Json::encode($point, Leaflet::JSON_OPTIONS)) : $point;
    }
}
