<?php

namespace app\modules\contrib\widgets;

use yii\widgets\InputWidget;

class DualListboxWidget extends InputWidget
{
    public $items;
    public $displayProperty = 'name';
    public $valueProperty = 'id';
    public $value = [];

    public function run()
    {
        return $this->render('dualListboxWidget', [
            'items' => $this->items,
            'displayProperty' => $this->displayProperty,
            'valueProperty' => $this->valueProperty,
            'model' => $this->model,
            'attribute' => $this->attribute,
            'value' => $this->value
        ]);
    }
}
