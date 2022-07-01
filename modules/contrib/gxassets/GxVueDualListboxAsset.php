<?php

namespace app\modules\contrib\gxassets;

class GxVueDualListboxAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@app/modules/contrib/gxassets/assets/vue-dual-listbox';

    public $css = [
        'vue-multi-select-listbox.css'
    ];

    public $js = [
        'vue-multi-select-listbox.js'
    ];

    public $depends = [
        '\app\modules\contrib\gxassets\GxVueAsset',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}
