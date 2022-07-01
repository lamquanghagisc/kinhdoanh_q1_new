<?php

namespace app\widgets\dmaps\types;

use yii\base\Component;

abstract class Type extends Component
{
    abstract public function encode();
}
